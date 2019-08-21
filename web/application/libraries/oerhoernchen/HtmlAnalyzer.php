<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/simple_dom_parser/simple_dom_parser.php';

/* html parsing with Simple DOM Parsr */
class HtmlAnalyzer
{

  // fields we try to retrieve :)
    // (these are our internal fields for the elastic index)
    private $md;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    private function clear_metadata()
    {
        // clear the fields
        $this->md = array(
        'title'=>'',
        'description'=>'',
        'creator'=>'',
        'license_url'=>'',
        'license_type'=>'',
        'created_year'=>'',
        'educational_sectors'=>[],
        'thumbnail_url'=>''
      );
    }

    public function get_metadata()
    {
        // convert to object
        return (object) $this->md;
    }

    // standard method for retrieving schema.org metadata / LRMI
    public function analyze_html($htmlContent, $projectHasMachineReadableLicense, $projectKey)
    {
        // 2DO: Copied from Community Bookmarks Controller
        // 2DO: USE IT THERE TOO, GENERALIZE IT!

        $html = str_get_html($htmlContent); // 2DO: can return false?

        if (is_bool($html)) {
            custom_log_message("Something went wrong, str_get_html returned ".print_r($html, true));
            return false; // we skip
        }

        $data = array();

        // 2DO: could there be more than one on a page?
        $ld_json_tag = @$html->find('[type*="ld+json"]', 0);
        log_message('debug', 'First - check for LRMI/JSON+LD... Result:' . var_export(@$ld_json_tag->innertext, true));
        // if not found, innertext is NULL
        if ($ld_json_tag !== null) {
            $md = json_decode($ld_json_tag->innertext); // metadata

            log_message('debug', 'Checking for @context, contains schema.org? - val: ' . print_r($md->{'@context'}, true));

            // perform tests to check if its schema.org
            if (is_object($md)
                        && is_int(strpos($md->{'@context'}, "schema.org"))
                        && isset($md->license)) {
                log_message('debug', 'Set data license to ' . $md->license);
                $data['license_url'] = $md->license;
            } // eo match license typ

            if (isset($md->name)) {
                $data['title'] = $md->name;
            }

            if (isset($md->description)) {
                $data['description'] = $md->description;
            }

            // https://stackoverflow.com/questions/51139969/schema-org-creator-vs-author-property
            // author, creator... can be ...
            /* "creator": {
                              "@type": "Person",
                              "givenName": "Andreas",
                              "familyName": "Barth"
*/
            // 2DO: parse author as well
            if (isset($md->creator)) {
                if (is_object($md->creator)) {
                    if (strtolower($md->creator->{'@type'}) == 'person') {
                        $data['license_attribution'] = $md->creator->givenName . " " . $md->creator->familyName;
                    } elseif (strtolower($md->creator->{'@type'} == 'organization')) {
                        $data['license_attribution'] = $md->creator->legalName;
                    }
                } elseif (is_array($md->creator)) {
                    $data['license_attribution'] = "";
                    $i = 0;
                    foreach ($md->creator as $creator) {
                        if ($i > 0) {
                            $data['license_attribution'] .= ", ";
                        }
                        if (strtolower($creator->{'@type'}) == 'person') {
                            $data['license_attribution'] .= $creator->givenName . " " . $creator->familyName;
                        } elseif (strtolower($creator->{'@type'} == 'organization')) {
                            $data['license_attribution'] .= $creator->legalName;
                        }
                        $i++;
                    }
                }
            }

            if (isset($md->dateCreated)) {
                $data['created_year'] = substr($md->dateCreated, 0, 4);
            }

            if (isset($md->thumbnailUrl)) {
                $data['thumbnail_url'] = $md->thumbnailUrl;
            }

            // send all data back to client

            $data["schema_org_metadata_json"] = json_encode($md);

            // 2DO: Map learning resource types?
                    // get author
                    // get free keywords?
                    // preview image!!
        } // EO LRMI

        // SECOND LICENSE CHECK - optional / RDFa check
        // if license was not found via ld+json/lrmi or is empty, we look for rdfa infos
        if (!isset($data['license_url'])) {
            // The * is important!! Otherwise "rel=license noopener" won't be match
            // 2DO: put in scrapy as well?? (operator * ensures that other values are possible as well next to it)
            // 2DO: license in head?
            /*$nodes_rel_license = array();
                foreach ($html->find('[rel*="license"]') as $element) {
                    $nodes_rel_license[] = array('html' => (string) $element, 'href' => $element->href, 'innertext' => $element->innertext);
            */
            $node_license = @$html->find('[rel*="license"]', 0)->href;

            // rdfa infos -> takes care of title as well
            $node_title = @$html->find('[property*="dct:title"]', 0)->innertext;
            if ($node_title === null) {
                $node_title = @$html->find('title', 0)->innertext;
            } else {
                $node_title = strip_tags($node_title);
            }

            $attribution_url_rdfa = @$html->find('[rel*="cc:attributionURL"]', 0);
            $node_attribution_url = array();
            if ($attribution_url_rdfa !== null) {
                $node_attribution_url = array('href' => $attribution_url_rdfa->href, 'innertext' => $attribution_url_rdfa->innertext);
            }
            $node_creator = @$html->find('[property*="cc:attributionName"]', 0)->innertext;

            $data['license_url'] = $node_license;
            $data['title'] = $node_title;
            $data['license_attribution'] = $node_creator;
        } // eo rdfa check

        // THIRD - Last try for license_url for websites, which have no LRMI + NO rdfa
        // This can go wrong if there is just a link to a CC license
        // e.g. unfortunately no rel="license" on hoou.de, so we just parse all links (a) and try to check if it is a license url to creativecommons
        if (!$projectHasMachineReadableLicense && !isset($data['license_url'])) {
          $allLinks = $html->find('a'); // 2DO: Use xpath with value/regexp
          custom_log_message('We try to manually find out the license, links (a) found: '.count($allLinks));
          foreach ($allLinks as $element) {
              //$this->log('Analyze link: '.$element->href);
              if (strpos($element->href, "creativecommons.org/") !== false) {
                  $lt = $this->get_license_type_by_url($element->href);
                  if($lt !== "other"){
                    // we found one :) (but maybe its just a cc image :()
                    $data['license_url'] = $element->href;
                    $data['license_type'] = $lt;
                    custom_log_message("We found a license link and a type ...: ".$data['license_url'].' / '.$data['license_type']);
                    break; // we just take the first one, it's fuzzy :(
                  }
              }
          }
        } // eo last try

        // check for preview thumbnail, e.g twitter

        // 2DO: clean this mess up ;-)

        // Thumbnail url, if not determined by LRMI/schema.org
        // Important [property=*], otherwise only exact match counts
        if(!isset($data['thumbnail_url'])){
          if(!is_null($html->find('meta[property*="og:image"]', 0))){
            $data['thumbnail_url'] = @$html->find('meta[property*="og:image"]', 0)->content;
          }
          if(!is_null($html->find('meta[name*="og:image"]', 0))){
            $data['thumbnail_url'] = @$html->find('meta[name*="og:image"]', 0)->content;
          }
          // for tibav
          if(!is_null($html->find('meta[property*="thumbnailUrl"]', 0))){
            $data['thumbnail_url'] = $html->find('meta[property*="thumbnailUrl"]', 0)->content;
          }
        }

        if(!isset($data['description'])){
          if(!is_null($html->find('meta[property*="description"]', 0))){
            $data['description'] = @$html->find('meta[property*="description"]', 0)->content;
          }
          if(!is_null($html->find('meta[name*="description"]', 0))){
            $data['description'] = @$html->find('meta[name*="description"]', 0)->content;
          }
        }

        // custom overwrite for hhu needed, we have to take og:description and og:title
        if($projectKey == 'hhu'){
          $data['description'] = @$html->find('meta[property*="og:description"]', 0)->content;
          $data['title'] = @$html->find('meta[property*="og:title"]', 0)->content;
        }




        // final checks

        if(!isset($data["license_url"])){
          custom_log_message("No open license found, we skip this URL ...");
          return false;
        }

        if(!isset($data["license_type"])){
          $data['license_type'] = $this->get_license_type_by_url($data['license_url']);
          if($data['license_type']=="other"){
            custom_log_message("License url was found, but no CC license, we skip by now... To complicated :/ ");
            return false;
          }
        }
        // FINALLY SET METADATA
        $this->md = $data;

        return true;
    }

    /* we need a special HOOU parser, because the portal has no schema.org data in the html source code currently :( */
    /*public function analyze_html_hoou($htmlContent)
    {
        $this->clear_metadata();
        $html = str_get_html($htmlContent);

        $this->md['title'] = @$html->find('title', 0)->innertext;
        custom_log_message('title set to '.$this->md['title']);
        $this->md['description'] = @$html->find("meta[property='description']", 0)->content;

        // unfortunately no rel="license" on hoou.de, so we just parse all links
        custom_log_message('Links found: '.count($html->find('a')));
        foreach ($html->find('a') as $element) {
            //$this->log('Analyze link: '.$element->href);
            if (strpos($element->href, "creativecommons.org/") !== false) {
                $this->md['license_url'] = $element->href;
                break; // we just take the first one
            }
        }
        custom_log_message('Set license url set to: '.$this->md['license_url']);

        if ($this->md['license_url'] !== '') {
            $this->md['license_type'] = $this->get_license_type_by_url($this->md['license_url']);
            custom_log_message('Set license type to: '.$this->md['license_type']);
        } else {
            custom_log_message('No license url found, type could not be set', "error");
        }

        $this->md['thumbnail_url'] = @$html->find("meta[property='og:image']", 0)->content;

        //<meta name="language" content="DE">
        // 2DO: parse author, etc. (later)

        // default values
        array_push($this->md['educational_sectors'], "highereducation");

        return true;
    } // eo if
*/

    private function get_license_type_by_url($license_url_parsed)
    {
        switch (true) {
          case is_int(strpos($license_url_parsed, "creativecommons.org/publicdomain/zero/")):
            return 'cc0';
            break;
          case is_int(strpos($license_url_parsed, "creativecommons.org/licenses/by/")):
            return 'ccby';
            break;
          case is_int(strpos($license_url_parsed, "creativecommons.org/licenses/by-sa/")):
            return 'ccbysa';
            break;
          case is_int(strpos($license_url_parsed, "creativecommons.org/licenses/by-nd/")):
            return 'ccbynd';
            break;
          case is_int(strpos($license_url_parsed, "creativecommons.org/licenses/by-nc/")):
            return 'ccbync';
            break;
          case is_int(strpos($license_url_parsed, "creativecommons.org/licenses/by-nc-nd/")):
            return 'ccbyncnd';
            break;
          case is_int(strpos($license_url_parsed, "creativecommons.org/licenses/by-nc-sa/")):
            return 'ccbybyncsa';
            break;
          }

        return "other"; // 2DO: log error?
    }
}
