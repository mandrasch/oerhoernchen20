<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/simple_dom_parser/simple_dom_parser.php';

/* html parsing with Simple DOM Parsr */
class HtmlAnalyzer
{

  // fields we try to retrieve :)
    // (these are our internal fields for the elastic index)
    private $md = array(
    'title'=>'',
    'description'=>'',
    'creator'=>'',
    'license_url'=>'',
    'license_type'=>'',
    'created_year'=>'',
    'educational_sectors'=>[],
    'thumbnail_url'
  );

    private function log($message, $type="debug")
    {
        if (is_cli()) {
            echo "{$message}".PHP_EOL;
        } else {
            log_message($type, $message);
        }
    }


    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function get_metadata(){
      return $this->md;
    }

    // standard method for retrieving schema.org metadata / LRMI
    public function analyze_html($htmlContent)
    {
      // 2DO: Copy from Community Bookmarks Controller
    }

    /* we need a special HOOU parser, because the portal has no schema.org data in the html source code currently :( */
    public function analyze_html_hoou($htmlContent)
    {
        $nodes_rel_license = array();

        $this->md['title'] = @$html->find('title', 0)->innertext;
        $this->log('title set to '.$$this->md['title']);
        $this->md['description'] = $html->find("meta[name='description']", 0)->content;

        // unfortunately no rel="license" on hoou.de, so we just parse all links
        foreach ($html->find('a') as $element) {
            if (strpos($element->href, "https://creativecommons.org/")) {
                $this->md['license_url'] = $element->href;
                return; // we just take the first one
            }
        }

        if ($this->md['license_url'] !== '') {
            $this->md['license_type'] = $this->get_license_type_by_url($this->md['license_url']);
        } else {
            $this->log('No license url found, type could not be set', "error");
        }

        // 2DO: parse author, etc. (later)

        array_push($this->md['educational_sectors'], "higher_education");
    } // eo if


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
