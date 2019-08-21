<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// cd /Users/admin/webserver/2019-oerhoernchen20/web/
// 1. FLUSH
// /Applications/MAMP/bin/php/php7.2.1/bin/php index.php oerhoernchen/cli flush_crawltest
// 2. TRY Crawling (crawltest will be used)
// /Applications/MAMP/bin/php/php7.2.1/bin/php index.php oerhoernchen/cli crawl zoerr
// 3. Publish to official Index, append 1 as parameter:
//  /Applications/MAMP/bin/php/php7.2.1/bin/php index.php oerhoernchen/cli crawl zoerr 1

// FLUSH:
// Matthiass-Air:web admin$ /Applications/MAMP/bin/php/php7.2.1/bin/php index.php oerhoernchen/cli flush_crawltest

// BETTER CALL THIS FROM CLI
// cd /Users/admin/webserver/2019-oerhoernchen20/web/
// /Applications/MAMP/bin/php/php7.2.1/bin/php index.php oerhoernchen/cli crawl hoou
// /Applications/MAMP/bin/php/php7.2.1/bin/php index.php oerhoernchen/cli crawl zoerr
// FOR PRODUCTION INDEX USE crawl zoerr 1 (isTest = )


require_once APPPATH . 'third_party/simple_dom_parser/simple_dom_parser.php';

class Cli extends CI_Controller {

	public function __construct() {

		parent::__construct();

		if(!is_cli()){
			show_error("Should only be access from CLI");
		}
	}

    // usage MAMP php --> ...
    // docs:
    // 2DO: how to add param via CLI?
    public function import_scrapy_json_results(){

			$this->load->library('oerhoernchen/appbase');

			// 2DO: GET FILE NAME VIA post
			// 2DO: SANITIZE, NO BULLSHIT?
			$jsonFileString = file_get_contents("../scrapy/scraped_items.json");

			$results = json_decode($jsonFileString);
			custom_log_message("Last json error, right now there is an extra comma sometimes (error code 4): ".json_last_error());
			//var_dump($results);
			foreach($results as $item){
				// 2DO: if data source === HOOU -> parse hoou
				// 2DO: if data source === ZOERR -> normal parse function
				custom_log_message('Parse item: '.$item->page_url.' - '.$item->filename);

				$htmlResponse = file_get_contents("../scrapy/html_exports/".$item->filename);

				// 2DO: parse normal html, check if license is overriden from projects.json?

				if($item->project_key=='hoou'){

					custom_log_message('Start parsing for HOOU - '.$item->filename);

					$htmlResponse = file_get_contents("../scrapy/html_exports/".$item->filename);

					$resultData = $this->parse_hoou($htmlResponse);
					var_dump($resultData);
					// 2DO: check for errors
					custom_log_message("Result data: ".print_r($resultData,true));
					$index = "highereducation";

					$sanitizedObjectData = $resultData;
					//append url
					$resultData->main_url = $item->page_url;
					$resultElasticId = $this->appbase->publish_to_index_and_log_in_database($index, $sanitizedObjectData);

					// 2DO: check $resultElasticId for successful
					custom_log_message("Result id: ".$resultElasticId);

				}
				else{
					$this->parse($item->content);
				}

			}


    }

    // http://localhost/2019-oerhoernchen20-prologin/oerhoernchen/cli/parse_hoou/
    public function parse_hoou($htmlContent){
      //$htmlContent = file_get_contents("application/data/hoou_example.html");
      $this->load->library('oerhoernchen/htmlanalyzer');
      $this->htmlanalyzer->analyze_html_hoou($htmlContent);
      //var_dump($this->htmlanalyzer->get_metadata());
			return $this->htmlanalyzer->get_metadata();
    }

		public function flush_crawltest(){
			$this->load->library('oerhoernchen/appbase');
			custom_log_message("Flush the crawltest-index");
			$this->appbase->flush_index("highereducation-crawltest");
		}


		public function crawl($projectkey,$publishToProduction = false){

			$this->load->library('oerhoernchen/appbase');
			$this->load->library('oerhoernchen/htmlanalyzer');

			if(!$publishToProduction){
				// 2DO: flush the whole index via API
				$appbaseIndex = "highereducation-crawltest";
			}else{
				$appbaseIndex = "highereducation";
			}

			custom_log_message("PUBLISH TO ".$appbaseIndex);

			switch($projectkey){
				case 'zoerr': // schema.org/LRMI/JSON/LD for the win :-))
					$sitemapUrl="https://www.oerbw.de/edu-sharing/eduservlet/sitemap?from=0";
					$urlStrPosValue="/render/";
					$projectHasMachineReadableLicense = true; // either LDJSON/schema.org or RDFa (rel=license)
					break;
				case 'hoou': // nothing
					$sitemapUrl="https://www.hoou.de/sitemap.xml";
					$urlStrPosValue="hoou.de/materials/";
					$projectHasMachineReadableLicense = false;
					break;
				case 'digill': // rdfa for the win
					$sitemapUrl="https://digill-nrw.de/kurs-sitemap.xml";
					$urlStrPosValue="kurs/";
					$projectHasMachineReadableLicense = true;
					break;
				case 'oncampus': // rdfa for the win
						$sitemapUrl="https://www.oncampus.de/sitemap.xml";
						$urlStrPosValue="";
						$projectHasMachineReadableLicense = true;
						break;
				case 'tibav': // nothing :/
						$sitemapUrl="https://av.tib.eu/sitemap.xml";
						$urlStrPosValue="/media/";
						$projectHasMachineReadableLicense = false;
						break;
				default:
					show_error("No project key provided");
					break;
			}


			custom_log_message("Start crawling");
			// 2DO: Get sitemap file via cURL
			$sitemapxml = file_get_contents($sitemapUrl); // 2DO: error handling
			$sitemapObject = simplexml_load_string($sitemapxml);
			//var_dump($sitemapObject);
			// get all links containing "materials/"
			$urls = [];
			foreach($sitemapObject as $entry){
				if($urlStrPosValue == "" || strpos($entry->loc,$urlStrPosValue) !== FALSE){
					$urls[] = (string) $entry->loc;
				}
			}
			custom_log_message("Found ".count($urls)." URLS with ".$urlStrPosValue);

			// 2DO: curl all urls
			foreach($urls as $url){

				// check if already in db, so we don't need to contact elastic
				// 2DO: add reindex/recrawl option, so that we crawl the page for updates
				if($publishToProduction){
					$this->db->where('main_url_hash', md5($url));
					$this->db->from('oerh_log_submitted_entries');
					$count = $this->db->count_all_results();
					if($count>0){
						custom_log_message("URL ".$url." is already in mysql database, we skip it ...");
						continue;
					}
				}

				custom_log_message("Sleep 5 seconds to be gentle to the server while curling... ;-)");
				// 2DO: use robots.txt throttle limit
				sleep(5);

				custom_log_message("Curling url: ".$url);

				$ch = curl_init();
				$timeout = 5;
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				curl_setopt($ch, CURLOPT_URL, $url);

				// Get URL content
				$responseHtml = curl_exec($ch);
				// close handle to release resources
				curl_close($ch);

				// 2DO: catch curl errors and show it (see ajax_add_entry in community_bookmarks)

				/*switch($projectkey){
					case 'hoou':
						$analyzeResult = $this->htmlanalyzer->analyze_html_hoou($responseHtml);
						break;
						case 'zoerr':
						$analyzeResult = $this->htmlanalyzer->analyze_html($responseHtml);
						break;
						default:
						$analyzeResult = $this->htmlanalyzer->analyze_html($responseHtml);
						break;
					}*/

				$analyzeResult = $this->htmlanalyzer->analyze_html($responseHtml,$projectHasMachineReadableLicense);



				if($analyzeResult===FALSE){
					continue; // no open license found, we skip
				}

	      //var_dump($this->htmlanalyzer->get_metadata());
				$sanitizedObjectData = $this->htmlanalyzer->get_metadata();
				$sanitizedObjectData->main_url = $url;
				// 2DO: Introduce field to buy just one appbase index?
				$sanitizedObjectData->oerhoernchen_index = "highereducation";
				// default value for prototype
				$sanitizedObjectData->educational_sectors = array("highereducation");
				//array_push(	$sanitizedObjectData->educational_sectors, "highereducation");
				$sanitizedObjectData->projectkey = filter_var($projectkey, FILTER_SANITIZE_STRING);
				custom_log_message("Sanitized object data: ".print_r($sanitizedObjectData,true));
				custom_log_message("Publish it to index ...");
				$resultElasticId = $this->appbase->publish_to_index_and_log_in_database($appbaseIndex, $sanitizedObjectData);
				custom_log_message("Elastic success id: ".$resultElasticId);



			} // eo foreach

			custom_log_message("Done :)");
			// 2DO: parse data with HtmlAnalyzer

			// done. :)
		}

		// tmp_function
		public function import_json(){
			$json = file_get_contents(APPPATH.'/data/data_oerhoernchen20-highereducation__doc_0_1283.json');
			$entries = json_decode($json);
			foreach($entries as $entry){
				$this->db->where('main_url_hash', md5($entry->main_url));
				$this->db->from('oerh_log_submitted_entries');
				$count = $this->db->count_all_results();

				if($count == 0){
					custom_log_message('Not in index, inserting url ... '.$entry->main_url);
					$array = array(
						'main_url'=>$entry->main_url,
						'main_url_hash'=>md5($entry->main_url),
						'oerhoernchen_id'=>'18411888225d5c2bd259c3c2.24188144',
						'json_object'=>json_encode($entry)
					);
					$this->db->set($array);
					$this->db->insert('oerh_log_submitted_entries');
				}
				else{
					custom_log_message('Url '.$entry->main_url.' is already in index');
				}
			}
		}

}
