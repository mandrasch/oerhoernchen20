<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/simple_dom_parser/simple_dom_parser.php';

class Community_bookmarks extends CI_Controller {

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function __construct() {
		parent::__construct();


		// 2DO: put in helper or custom controller?
		/* ion auth way */

		$logged_in = $this->ion_auth->logged_in();

		// protect controller
		if (!$logged_in)
		{
			 redirect('auth/login');
		}

		if ($logged_in) {
			$this->user_id = $this->ion_auth->user()->row()->id;
		} else {
			$this->user_id = null;
		}
		log_message('debug', 'USERID: ' . $this->user_id);

		// add data to views
		$data['logged_in'] = $logged_in;
		$this->load->vars($data);

		/* pro login */
		/*$this->load->model("user_model");
		if (!$this->user->loggedin) {
			redirect(site_url("login"));
		}*/

		// pro login $this->user_id = $this->user->info->ID;



		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->database();
		//$this->load->library('ion_auth');


		/*if ($this->ion_auth->logged_in()) {
			$this->user_id = $this->ion_auth->user()->row()->id;
		} else {
			$this->user_id = null;
		}*/

		// 2DO: Error handling!
		// 2DO: Use cache/better solution for this ;-)
		// 2DO:
		// file_get_contents caches anyway, we need to add time in url for dev purposes
		// 2DO: inf in ENV production, don't do this!
		/*$simpleOerTagsJsonFile = file_get_contents("https://raw.githubusercontent.com/programmieraffe/oerhoernchen20-react/master/src/data/simple_oer_tags.json"."?".time());*/

		// 2DO: resetOerTags=true
		// => otherwise, take cached version from data...

		// Create a curl handle to a non-existing location
		/*$ch = curl_init('https://raw.githubusercontent.com/programmieraffe/oerhoernchen20-react/master/src/data/simple_oer_tags.json');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = '';
		if (($simpleOerTagsJsonFile = curl_exec($ch)) === false) {
			echo 'Curl error: ' . curl_error($ch);
		} else {
			// 2DO: log_message
			// echo 'Operation completed without any errors';
			// var_dump(curl_getinfo($ch, CURLINFO_HTTP_CODE));
		}*/

		// Close handle
		//curl_close($ch);

		// 2DO: get it from external source & cache it?
		$simpleOerTagsJsonFile = file_get_contents(APPPATH . "/datacache/simple_oer_tags.cached.json");
		$simpleOerTags = json_decode($simpleOerTagsJsonFile);
		//var_dump($simpleOerTags);

		// 2DO: local backup cache

		$this->simpleOerTagsData['general_types'] = $simpleOerTags->general_types;
		$this->simpleOerTagsData['technical_formats'] = $simpleOerTags->technical_formats;
		$this->simpleOerTagsData['educational_sectors'] = $simpleOerTags->educational_sectors;
		$this->simpleOerTagsData['license_types'] = $simpleOerTags->license_types;
		$this->simpleOerTagsData['school_subjects'] = $simpleOerTags->school_subjects;
		$this->simpleOerTagsData['higher_education_subjects'] = $simpleOerTags->higher_education_subjects;
		$this->simpleOerTagsData['special_topics'] = $simpleOerTags->special_topics;
		//2DO: higher_education_topics

	}

	// show the official index
	public function index() {
		$this->config->load('appbase');
		$jsCssData['appbase_auth_string_read'] = $this->config->item('appbase_auth_string_read_official');
		$jsCssData['appbase_app_name'] = $this->config->item('appbase_app_name_official');
		//$jsCssData['appbase_api_url'] = $this->config->item('appbase_api_url');
		$jsCssData['css_files'] = array(base_url() . 'assets/css/oerhoernchen.community_bookmarks.css');
		$jsCssData['js_files'] = array(base_url() . 'assets/js/oerhoernchen.community_bookmarks.react.js');
		$jsCssData['header_title'] = 'Community Lesezeichen';
		$this->load->view('oerhoernchen/header.php', $jsCssData);
		$this->load->view('oerhoernchen/community_bookmarks.php');
		$this->load->view('oerhoernchen/footer.php');
	}

	public function playground() {
		$this->config->load('appbase');
		$jsCssData['appbase_auth_string_read'] = $this->config->item('appbase_auth_string_read_playground');
		$jsCssData['appbase_app_name'] = $this->config->item('appbase_app_name_playground');
		//$jsCssData['appbase_api_url'] = $this->config->item('appbase_api_url_demo');
		$jsCssData['css_files'] = array(base_url() . 'assets/css/oerhoernchen.community_bookmarks.css');
		$jsCssData['js_files'] = array(base_url() . 'assets/js/oerhoernchen.community_bookmarks.react.js');
		$jsCssData['header_title'] = 'Community Lesezeichen';
		$this->load->view('oerhoernchen/header.php', $jsCssData);
		$this->load->view('oerhoernchen/community_bookmarks.php');
		$this->load->view('oerhoernchen/footer.php');
	}

	public function add() {
		$this->config->load('oerhoernchen');
		// prologin patchesoft
		//$jsCssData['is_editorial_staff'] = $this->user_model->check_user_in_group($this->user->info->ID, $this->config->item('oerhoernchen_group_id_editorial_staff'));
		// eo prologin patchesoft

		// Ion_auth
		// 2DO: Add role/group check
		$jsCssData['is_editorial_staff'] = $this->ion_auth->logged_in();

		$jsCssData['css_files'] = array(
			base_url() . 'assets/css/dropzone.css',
			base_url() . 'assets/css/jquery.tag-editor.css',
			base_url() . 'assets/css/oerhoernchen.community_bookmarks.css');
		$jsCssData['js_files'] = array(
			base_url() . 'assets/js/jquery.loadJSON.min.js',
			base_url() . 'assets/js/dropzone.js',
			base_url() . 'assets/js/jquery.caret.min.js',
			base_url() . 'assets/js/jquery.tag-editor.min.js',
			base_url() . 'assets/js/add_entry.js');

		$this->load->view('oerhoernchen/header.php', $jsCssData);
		$this->load->view('oerhoernchen/add_entry', $this->simpleOerTagsData);
		$this->load->view('oerhoernchen/footer.php');
	}

	/*
		2DO: We excluded this from csrf_protection by now
		$config['csrf_exclude_uris'] = array('invoice/view', 'ipn/process2', 'funds', 'ipn/stripe/[0-9]+', 'ipn/checkout2/[0-9]+', 'oerhoernchen/community_bookmarks/ajax_add_entry');
	*/

	public function ajax_add_entry() {

		if (isset($_POST["oerModuleJson"]) && !empty($_POST["oerModuleJson"])) {

			// index to post to, should be official or playground
			// 2DO: validate values properly
			$index = $this->input->post('index');
			// 2DO: is valiated in appbase library - generalize it!
			/*if ($index !== 'playground' && $index !== 'official' && $index !== 'github' && ) {
				show_error('Unexpected value for index', 500);
			}*/

			// retrieve it with codeigniter, should be sanitized?
			// 2DO: Explore this
			// https://www.codeigniter.com/user_guide/libraries/input.html
			//$jsonData = json_decode($_POST['oerModuleJson']);
			$jsonData = json_decode($this->input->post('oerModuleJson'));

			// write some sample data so that we can use it as json
			// 2DO: remove later - security issue?
			// 2DO: add JSON_UNESCAPED_UNICODE?
			$this->load->helper('file');
			if (!write_file(APPPATH . '/import_dumps/' . time() . '.json', $_POST['oerModuleJson'])) {
				log_message('error', 'Could not write file');
			} else {
				log_message('info', 'File written');
			}

			// store in database (see below), so we can delete it later
			$imgur_delete_hash = $jsonData->imgur_delete_hash;
			$imgur_url = $jsonData->imgur_url;

			// delete imagegur upload from temporary upload list
			$this->db->delete('oerh_log_imgur_uploads', array('imgur_delete_hash' => filter_var($jsonData->imgur_delete_hash, FILTER_SANITIZE_STRING)));

			// remove from jsonData Object
			unset($jsonData->imgur_delete_hash);
			unset($jsonData->imgur_url);

			$jsonData->entry_added = date("c"); // https://stackoverflow.com/questions/37528386/elasticsearch-date-format-mapping
			// ISO 8601

			$time_added = time(); // for internal database log

			// -----------------------
			// 2DO: validate all data server-side!
			// -----------------------

			if (!isset($jsonData->main_url)) {
				//show_error('Bitte die Pflichtfelder beachten', 500);
				$this->send_json_response_error(false, array('Bitte Pflichtfelder beachten'));
				return;
			}

			// 2DO -> MAP THE DATA AND VALIDATE IT?
			// 2DO: take it from JS and do not let user smuggle in some values
			// 2DO: sanitize input arrays
			// 2DO: match input values with allowed values from json file...

			$sanitizedObjectData = $jsonData;
			//$sanitizedObjectData['technical_formats'] = filter_var_array($jsonData->technical_formats, )

			/*$args = array(
					    'main_url'   => FILTER_SANITIZE_STRING,

				     'technical_formats'   => array(
				                            'filter' => FILTER_SANITIZE_STRING,
				                           ),

					    // 2DO: take from json

					    'component'    => array('filter'    => FILTER_VALIDATE_INT,
					                            'flags'     => FILTER_FORCE_ARRAY,
					                            'options'   => array('min_range' => 1, 'max_range' => 10)
					                           ),
					    'versions'     => FILTER_SANITIZE_ENCODED,
					    'doesnotexist' => FILTER_VALIDATE_INT,
					    'testscalar'   => array(
					                            'filter' => FILTER_VALIDATE_INT,
					                           ),
					    'testarray'    => array(
					                            'filter' => FILTER_VALIDATE_INT,
					                            'flags'  => FILTER_FORCE_ARRAY,
					                           )

					);

			*/

			// 2DO: this needs more logic if anonymous submissions are accepted!

			// FOR BETA WE USE THE APPROVAL PROCESS FOR THE OFFICIAL INDEX
			// UNCOMMENT THIS LATER MAYBE
			/*$this->config->load('oerhoernchen');
			if ($index == 'official' && $this->config->item('oerhoernchen_direct_submission_only_from_trusted_users') === TRUE) {
				$userIsAllowedToPublishDirectly = $this->user_model->check_user_in_group($this->user->info->ID, $this->config->item('oerhoernchen_direct_submission_trusted_users_group_ID'));
			} else {
				// this is the case for the playground by now
				$userIsAllowedToPublishDirectly = true;
			}*/

			if ($index == 'official') {
				$userIsAllowedToPublishDirectly = false;
			} else {
				// 2DO: check rights to publish to github? (only editorial staff)
				$userIsAllowedToPublishDirectly = true;
			}

			// STORE IN DB FOR APPROVAL (OFFICIAL INDEX)
			if (!$userIsAllowedToPublishDirectly) {
				// store in db for approval (This is only the case for the official index)
				$this->store_entry_awaiting_approval($imgur_url, $imgur_delete_hash, $sanitizedObjectData);
				$responseData['success'] = true;
				$responseData['is_awaiting_approval'] = true;
				return $this->output->
					set_content_type('application/json')->
					set_status_header(200)
					->set_output(json_encode($responseData));
			} else {
				$this->load->library('oerhoernchen/appbase');
				$resultElasticId = $this->appbase->publish_to_index_and_log_in_database($index, $sanitizedObjectData, $this->user_id, $imgur_url, $imgur_delete_hash, $time_added);

				if ($resultElasticId === false) {
					return $this->output->
						set_content_type('application/json')->
						set_status_header(200)
						->set_output(json_encode(array(
							'success' => false,
						)));

				} else {
					return $this->output->
						set_content_type('application/json')->
						set_status_header(200)
						->set_output(json_encode(array(
							'success' => true,
							'elastic_id' => $resultElasticId,
						)));
				}

			}

			/*$curl = curl_init();

					//$json = file_get_contents('import_data_multiple.json');
					// 2DO: better security, do not take post!
					//Decode JSON
					//$jsonObj = json_decode($json,true);

					// POST WITHOUT ID, autogenerated id

					curl_setopt_array($curl, array(
						CURLOPT_URL => "https://scalr.api.appbase.io/oerhoernchen20/module/",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => "",
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS => json_encode($jsonData),
						CURLOPT_HTTPHEADER => array(
							"Authorization: Basic " . base64_encode("LtPyJJdPy:6a37d2b4-1764-470b-8b07-714ce31a66f6") . "",
							"Content-Type: application/json",
						),
					));

					$responseAppbaseRaw = curl_exec($curl);
					$responseAppbaseDecoded = json_decode($responseAppbaseRaw);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
						//echo "cURL Error #:" . $err;

						return $this->output->
							set_content_type('application/json')->
							set_status_header(200)
							->set_output($responseAppbaseRaw);
						// 2DO: return response.success = false and log error internally!

					} else {
						// json_decode($responseAppbase, true);

						$response = array();
						// 2DO: only return some fields due to security reasons?
						$response['success'] = true;
						$response['_id'] = $responseAppbaseDecoded->_id;
						$response['result'] = $responseAppbaseDecoded->result;

						// store (private) data in our database
						$this->store_log_data_in_database($response['_id'], $imgur_url, $imgur_delete_hash);

						return $this->output->
							set_content_type('application/json')->
							set_status_header(200)
							->set_output(json_encode($response));
					}

				} // eo else - user can publish directly

				//$this->load->library('elastic_index');
			*/

		}

	}

	// we have to keep track and delete unused pictures
	// 2DO: Delete image if user removes it via JS
	public function ajax_add_imgur_upload() {

		if (isset($_POST['imgur_url']) && isset($_POST['imgur_delete_hash'])) {

			if ($this->ion_auth->logged_in()) {
				$user_id = $this->ion_auth->user()->row()->id;
			} else {
				$user_id = null;
			}

			// 2DO: SANITIZE
			// 2DO: VALIDATE

			$data = array(
				'imgur_url' => filter_var($_POST['imgur_url'], FILTER_SANITIZE_STRING),
				'imgur_delete_hash' => filter_var($_POST['imgur_delete_hash'], FILTER_SANITIZE_STRING),
				'user_id' => $user_id,
				'time' => time(),
			);

			$this->db->insert('oerh_log_imgur_uploads', $data);
			// 2DO: send response json if success
		}

	}

	// imgur deletion is handled in client, this is just the method afterwards
	public function ajax_delete_imgur_upload_from_db() {
		$this->db->delete('oerh_log_imgur_uploads', array('imgur_delete_hash' => filter_var($_POST['imgur_delete_hash'], FILTER_SANITIZE_STRING)));
		// 2DO: send response json if success
	}

	public function ajax_url_check() {
		// https://www.oerbw.de/edu-sharing/components/render/8acf78da-eb7e-467d-bbac-e6cf7c687022
		// test in browser: http://____/entry/ajax_url_check?main_url=https%3A%2F%2Fwww.oerbw.de%2Fedu-sharing%2Fcomponents%2Frender%2F8acf78da-eb7e-467d-bbac-e6cf7c687022

		if (isset($_GET["main_url"])) {

			$url = ($_GET["main_url"]);
			$url = filter_var($url, FILTER_SANITIZE_URL);

			// 2DO: more sanitizing needed?
			// 2DO: check if valid url

			$ch = curl_init();
			$timeout = 5;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

			// Get URL content
			$response_html = curl_exec($ch);
			// close handle to release resources
			curl_close($ch);

			// 2DO: catch curl errors and show it

			// php simple dom
			//to parse a string as html code
			$html = str_get_html($response_html);

			//var_dump($html);

			$nodes_rel_license = array();

			if ($html !== false) {

				// FIRST: CHECK FOR LRMI via LD+JSON

				// LRMI (via JSON+LD)
				// example: view-source:https://www.oerbw.de/edu-sharing/components/render/a0d8ff10-7fd0-465b-b640-576947414d70
				// script type="application/ld+json"

				/* "identifier": "8acf78da-eb7e-467d-bbac-e6cf7c687022",
					                      "creator": {
					                        "@type": "Person",
					                        "givenName": "Andreas",
					                        "familyName": "Barth"
					                      },
					                      "keywords": [
					                        "Erdbebenverteilung",
					                        "Poisson-Verteilung",
					                        "Gutenberg-Richter-Verteilung",
					                        "Omoris Gesetz",
					                        "Oberrheingraben",
					                        "Magnitudenhäufigkeit",
					                        "Vorbeben",
					                        "Nachbeben"
					                      ],
					                      "@type": [
					                        "CreativeWork",
					                        "MediaObject"
					                      ],
					                      "description": "Wie lässt sich die zeitliche und räumliche Verteilung von Erdbeben beschreiben? Erklärung und Anwendung der drei wichtigsten statistischen Verteilungen in der Seismologie: Poissonverteilung, Gutenberg-Richter-Verteilung und Omori-Gesetz. ",
					                      "inLanguage": "de",
					                      "dateModified": "2019-07-19T10:30:31+02:00",
					                      "@context": "http://schema.org/",
					                      "version": "1.1",
					                      "url": "https://uni-tuebingen.oerbw.de/edu-sharing/components/render/8acf78da-eb7e-467d-bbac-e6cf7c687022",
					                      "datePublished": "2018-09-12T14:45:52+02:00",
					                      "license": "https://creativecommons.org/licenses/by-nd/4.0/deed.en",
					                      "dateCreated": "2018-03-29T16:36:44+02:00",
					                      "name": "Erdbebenstatistik",
					                      "learningResourceType": "video",
					                      "thumbnailUrl": "https://uni-tuebingen.oerbw.de/edu-sharing/preview?nodeId=8acf78da-eb7e-467d-bbac-e6cf7c687022&storeProtocol=workspace&storeId=SpacesStore&dontcache=1563788960402"
					                    }
				*/

				// we assume there is only one

				// 2DO: must be creative work or media object?

				// 2DO: could there be more than one on a page?
				$ld_json_tag = @$html->find('[type*="ld+json"]', 0);
				log_message('debug', 'First - check for LRMI/JSON+LD... Result:' . var_export(@$ld_json_tag->innertext, true));
				// if not found, innertext is NULL
				if ($ld_json_tag !== NULL) {
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

				// SECOND - optional / RDFa check
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
					if ($node_title === NULL) {
						$node_title = @$html->find('title', 0)->innertext;
					} else {
						$node_title = strip_tags($node_title);
					}

					$attribution_url_rdfa = @$html->find('[rel*="cc:attributionURL"]', 0);
					$node_attribution_url = array();
					if ($attribution_url_rdfa !== NULL) {
						$node_attribution_url = array('href' => $attribution_url_rdfa->href, 'innertext' => $attribution_url_rdfa->innertext);
					}
					$node_creator = @$html->find('[property*="cc:attributionName"]', 0)->innertext;

					$data['license_url'] = $node_license;
					$data['title'] = $node_title;
					$data['license_attribution'] = $node_creator;
				} // eo rdfa check

				// 2DO: check for preview thumbnail, e.g twitter
				if (!isset($data['thumbnail_url'])) {
					$data['thumbnail_url'] = @$html->find('meta[property*="og:image"]', 0)->content;
				} // eo preview image
				// 2DO: check if this was really successful

				if (!isset($data['description'])) {
					$data['description'] = @$html->find('meta[property*="description"]', 0)->content;
				}

				// match license to license_url

				// 2DO: match license type to license
				// server-side?
				// 2DO: make it nicer and use standard json file (use attribute "License-url-identifier/match" or something?)

				if (isset($data['license_url'])) {
					switch (true) {
					case is_int(strpos($data['license_url'], "creativecommons.org/publicdomain/zero/")):
						$data["license_type"] = 'cc0';
						break;
					case is_int(strpos($data['license_url'], "creativecommons.org/licenses/by/")):
						$data["license_type"] = 'ccby';
						break;
					case is_int(strpos($data['license_url'], "creativecommons.org/licenses/by-sa/")):
						$data["license_type"] = 'ccbysa';
						break;
					case is_int(strpos($data['license_url'], "creativecommons.org/licenses/by-nd/")):
						$data["license_type"] = 'ccbynd';
						break;
					case is_int(strpos($data['license_url'], "creativecommons.org/licenses/by-nc/")):
						$data["license_type"] = 'ccbync';
						break;
					case is_int(strpos($data['license_url'], "creativecommons.org/licenses/by-nc-nd/")):
						$data["license_type"] = 'ccbyncnd';
						break;
					case is_int(strpos($data['license_url'], "creativecommons.org/licenses/by-nc-sa/")):
						$data["license_type"] = 'ccbybyncsa';
						break;
					}
					// 2DO: public domain mark?
				} // eo if

				$this->send_json_response_success($data);

			} // eo if false
			else {
				// HTML was not found?

				$this->send_json_response_error(false);
			}

		}

	}

	// 2DO: not longer needed?
	private function store_entry_awaiting_approval($imgur_url, $imgur_delete_hash, $json_data) {

		// change to pro login
		if ($this->user->loggedin) {
			$user_id = $this->user->info->ID;
		} else {
			$user_id = null;
		}

		// 2DO: SANITIZE these strings!

		$data = array(
			'imgur_url' => filter_var($imgur_url, FILTER_SANITIZE_STRING),
			'imgur_delete_hash' => filter_var($imgur_delete_hash, FILTER_SANITIZE_STRING),
			'user_id' => $user_id,
			'time' => time(),
			'json_data' => $json_data,
		);

		$this->db->insert('oerh_entries_awaiting_approval', $data);

	}

	// 2DO: delete
	/*private function store_log_data_in_database($elastic_id, $imgur_url, $imgur_delete_hash) {

		if ($this->ion_auth->logged_in()) {
			$user_id = $this->ion_auth->user()->row()->id;
		} else {
			$user_id = null;
		}

		// 2DO: SANITIZE these strings!

		$data = array(
			'elastic_id' => $elastic_id,
			'imgur_url' => filter_var($imgur_url, FILTER_SANITIZE_STRING),
			'imgur_delete_hash' => filter_var($imgur_delete_hash, FILTER_SANITIZE_STRING),
			'user_id' => $user_id,
			'time' => time(),
		);

		$this->db->insert('oerh_log_submitted_entries', $data);

	}*/

	private function send_json_response_success($data = array()) {
		$response['success'] = true;
		$response['data'] = $data;
		$this->output->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	// 2DO: replace this with show_error('message',500) --> https://stackoverflow.com/a/21786593
	private function send_json_response_error($success = false, $error_messages = array()) {
		$response['success'] = false;
		$response['error_messages'] = $error_messages;
		$this->output->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode($response));
		exit();
	}

	/**
	 * Store Data from this method.
	 *
	 * @return Response
	 */
	/*public function itemForm()
		   {
		        $this->form_validation->set_rules('first_name', 'First Name', 'required');
		        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
		        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		        $this->form_validation->set_rules('address', 'Address', 'required');

		        if ($this->form_validation->run() == FALSE){
		            $errors = validation_errors();
		            echo json_encode(['error'=>$errors]);
		        }else{
		           echo json_encode(['success'=>'Record added successfully.']);
		        }
	*/

	public function convert() {

		$json = json_decode('{"general_types": {
        "audio": "Audio",
        "video": "Video",
        "slides": "Präsentationsfolien",
        "worksheet": "Arbeitsblatt",
        "interactive": "Interaktiver Inhalt",
        "quiz": "Übungsaufgaben/Assesment",
        "coursemodule": "Kurseinheit/Mini-Kurs",
        "fullcourse": "Umfangreicher Kurs",
        "textbook": "Textbook/E-Book",
        "teachingconcept": "Unterricht-/Seminarverlauf"
    },
    "technical_formats": {
        "h5p": "h5p",
        "microsoftoffice": "Microsoft Office",
        "openlibreoffice": "Open/Libre Office",
        "googledocs": "Google Docs",
        "pdf": "PDF",
        "appleoffice": "Apple Keynote/Pages",
        "pressbooks": "Pressbooks",
        "reveal": "Reveal-Präsentation",
        "staticsitegenerator": "Static Site Generator",
        "markdown": "Markdown",
        "moodle": "Moodle (LMS)",
        "ilias": "ILIAS (LMS)",
        "tutory": "Tutory",
        "slidewiki": "Slidewiki",
        "opencourseware": "Open Course Ware (OCW)",
        "scorm": "SCORM"
    }}');

		$array = [];
		foreach ($json->technical_formats as $key => $label) {
			$obj = new stdClass;
			$obj->label = $label;
			$obj->value = $key;
			array_push($array, $obj);
		}

		var_dump(json_encode($array, JSON_UNESCAPED_UNICODE));

	}

}
