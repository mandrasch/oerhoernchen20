<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appbase {

	public function __construct() {

		$this->CI = &get_instance();

	}

	private function store_entry_log_in_database($elastic_id, $oerhoernchen_id, $main_url, $json_object_data, $imgur_url, $imgur_delete_hash, $user_id, $time) {

		$data = array(
			// 2DO: add oerhoernchen_index
			'oerhoernchen_id' => $oerhoernchen_id,
			'elastic_id' => $elastic_id,
			'main_url'=>$main_url,
			'main_url_hash'=>md5($main_url),
			'imgur_url' => filter_var($imgur_url, FILTER_SANITIZE_STRING),
			'imgur_delete_hash' => filter_var($imgur_delete_hash, FILTER_SANITIZE_STRING),
			'user_id' => $user_id,
			'time' => $time,
			'json_object' => $json_object_data,
		);
		$this->CI->db->insert('oerh_log_submitted_entries', $data);
		// 2DO: error handling
	}

	// 2DO: Be careful ;-)
	public function flush_index($index){
		log_message('debug', "Flush index: ".$index);
		$curl = curl_init();

		$this->CI->config->load('appbase');

		// for security reasons we just flush crawltest by now
		switch ($index) {
		case 'highereducation-crawltest':
			$appbase_auth_string = $this->CI->config->item('appbase_auth_string_write_' . $index);
			$appbase_api_url = $this->CI->config->item('appbase_api_url_official') . '/' . $this->CI->config->item('appbase_app_name_' . $index) ;
			break;
		default:
			show_error('Unexpected index value', 500);
			break;
		}

		$request_params = array(
			'query'=> array(
				'match_all'=> (object)[]
				)
		);
		$query_fields = json_encode($request_params);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $appbase_api_url. '/_delete_by_query',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $query_fields,
			CURLOPT_HTTPHEADER => array(
				"Authorization: Basic " . base64_encode($appbase_auth_string) . "",
				"Content-Type: application/json",
			),
		));

		$responseAppbaseRaw = curl_exec($curl);
		$responseAppbaseDecoded = json_decode($responseAppbaseRaw);
		custom_log_message('CURL response: '.print_r($responseAppbaseDecoded,true));
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) {
			//echo "cURL Error #:" . $err;

			log_message('error', 'CURL ERROR' . print_r($responseAppbaseRaw, true));
			return false;

			/*return $this->output->
				set_content_type('application/json')->
				set_status_header(200)
				->set_output($responseAppbaseRaw);*/
			// 2DO: return response.success = false and log error internally!

		}

	} // eo flush_index

	public function publish_to_index_and_log_in_database($index, $sanitized_object_data, $user_id=null, $imgur_url=null, $imgur_delete_hash=null, $time=null) {

		log_message('debug', "Publish to index ".$index." start");

		$curl = curl_init();

		//$json = file_get_contents('import_data_multiple.json');
		// 2DO: better security, do not take post!
		//Decode JSON
		//$jsonObj = json_decode($json,true);

		// POST WITHOUT ID, autogenerated id

		$this->CI->config->load('appbase');

		switch ($index) {
		case 'official':
		case 'github':
		case 'playground':
		case 'highereducation':
		case 'highereducation-crawltest':
			$appbase_auth_string = $this->CI->config->item('appbase_auth_string_write_' . $index);
			$appbase_api_url = $this->CI->config->item('appbase_api_url_official') . '/' . $this->CI->config->item('appbase_app_name_' . $index) ;
			break;
		default:
			show_error('Unexpected index value', 500);
			break;
		}

		// add oerhoernchen_id to new entry object
		$object_without_oerhoernchen_id = $sanitized_object_data;
		$oerhoernchen_id = uniqid(rand(), true);
		$sanitized_object_data->oerhoernchen_id = $oerhoernchen_id;

		log_message('debug', 'Try to publish to index ' . $index);
		log_message('debug', 'URL: ' . $appbase_api_url);
		log_message('debug', 'Appbase auth string has length: ' . strlen($appbase_auth_string));

		if(strlen($appbase_auth_string) == 0){
			show_error('Auth string has zero characters, that won\'t work ;-)');
		}

		// check if url is already in index, so we can updated
		// import use .keyword, url is analyzed by elastic
		custom_log_message("check if url exists in index: ".$sanitized_object_data->main_url);
		$request_params = array(
			'query'=> array(
				'match'=>array(
					'main_url.keyword'=>$sanitized_object_data->main_url
				)
			)//,
			//'size'=>0
			// size 0 will not get any results
		);
		$query_fields = json_encode($request_params);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $appbase_api_url. '/_search/',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $query_fields,
			CURLOPT_HTTPHEADER => array(
				"Authorization: Basic " . base64_encode($appbase_auth_string) . "",
				"Content-Type: application/json",
			),
		));
		$responseAppbaseRaw = curl_exec($curl);
		custom_log_message("Result CURL: ".print_r($responseAppbaseRaw,true));

		// 2DO: check for errors
		// 2DO: analyze "hits":{"total":{"value":23,
		// "hits":{"total":{"value":23,"relation":"eq"},"max_score":7.765152,"hits":[{"_index":"oerhoernchen20-highereducation","_type":"_doc","_id":

		// 2DO: there should be only one item with main_url=main_url, but maybe something went wrong ;-)

		$responseObjectQueryForMainUrl = json_decode($responseAppbaseRaw);
		custom_log_message("Query result to check if url is already in index - value: ".@$responseObjectQueryForMainUrl->hits->total->value );
		custom_log_message("Curl response ".print_r($responseObjectQueryForMainUrl,true));
		// status 400 - new index, _search not possible
		if(!isset($responseObjectQueryForMainUrl->status) && $responseObjectQueryForMainUrl->hits->total->value > 0){
			custom_log_message("We update the document with id ".$responseObjectQueryForMainUrl->hits->hits[0]->_id);

			// update did not work as excepted
			// (problem with main_url field), so we just reindex now
			/*$urlIndexOrUpdate = $appbase_api_url. '/_update/'.$responseObjectQueryForMainUrl->hits->hits[0]->_id;
			$updateObject = array('doc'=>$sanitized_object_data);
			$jsonRequestData = json_encode($updateObject);*/

			$urlIndexOrUpdate = $appbase_api_url. '/_doc/'.$responseObjectQueryForMainUrl->hits->hits[0]->_id;
			$jsonRequestData = json_encode($sanitized_object_data);
			// "doc": { "name": "Jane Doe" }

		}
		else{
			// we index new document
			custom_log_message("We create a new document");
			$urlIndexOrUpdate = $appbase_api_url. '/_doc/';
			$jsonRequestData = json_encode($sanitized_object_data);
		}

		// index a new document / update it
		curl_setopt_array($curl, array(
			CURLOPT_URL => $urlIndexOrUpdate,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $jsonRequestData,
			CURLOPT_HTTPHEADER => array(
				"Authorization: Basic " . base64_encode($appbase_auth_string) . "",
				"Content-Type: application/json",
			),
		));

		$responseAppbaseRaw = curl_exec($curl);
		$responseAppbaseDecoded = json_decode($responseAppbaseRaw);
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) {
			//echo "cURL Error #:" . $err;

			log_message('error', 'CURL ERROR' . print_r($responseAppbaseRaw, true));
			return false;

			/*return $this->output->
				set_content_type('application/json')->
				set_status_header(200)
				->set_output($responseAppbaseRaw);*/
			// 2DO: return response.success = false and log error internally!

		} elseif (isset($responseAppbaseDecoded->_id)) {
			// json_decode($responseAppbase, true);

			log_message('debug', 'CURL SUCCESS, got back an id: ' . $responseAppbaseDecoded->_id);

			$elastic_id = $responseAppbaseDecoded->_id;

			//2DO: check if result == created
			// $response['result'] = $responseAppbaseDecoded->result;

			//$response = array();
			// 2DO: only return some fields due to security reasons?
			//$response['success'] = true;
			//$response['elastic_id'] = $responseAppbaseDecoded->_id;
			//$response['result'] = $responseAppbaseDecoded->result;
			// 2DO: check if this is created, otherwise error

			// store (private) data in our database
			// 2DO: we have to decide
			// 2DO: only on create?
			if($index == 'highereducation'){
			//if ($index == 'official' || $index == 'highereducation') {
				$this->store_entry_log_in_database(
					$elastic_id,
					$oerhoernchen_id,
					$sanitized_object_data->main_url,
					json_encode($object_without_oerhoernchen_id),
					$imgur_url,
					$imgur_delete_hash,
					$user_id,
					$time);
			}



			return $oerhoernchen_id;
			//return $elastic_id;

			/*return $this->output->
				set_content_type('application/json')->
				set_status_header(200)
				->set_output(json_encode($response));*/
		} else {
			log_message('error', 'Unexpected response from curl' . print_r($responseAppbaseRaw, true));
			return false;
		}

	}
}
