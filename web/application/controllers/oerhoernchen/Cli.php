<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/simple_dom_parser/simple_dom_parser.php';

class Cli extends CI_Controller {

	public function __construct() {
		parent::__construct();

		/* pro login */
		$this->load->model("user_model");
		if (!$this->user->loggedin) {
			redirect(site_url("login"));
		}

    // 2DO: put this in helper!
		// ID = 2 -> editorialstaff
		if (!$this->user_model->check_user_in_group($this->user->info->ID, 2)) {
			// 2DO: is show_error the best solution?
			show_error("You are not in the User Group Friends so you cannot view this page!");
		}

    // usage MAMP php --> ...
    // docs:
    // 2DO: how to add param via CLI?
    public function import_scrapy_json_results(){


    }
    // http://localhost/2019-oerhoernchen20-prologin/oerhoernchen/cli/parse_hoou/
    public function parse_hoou(){
      $htmlContent = file_get_contents("data/hoou_example.html");
      $this->load->library('oerhoernchen/html_analyzer');
      $this->html_analyzer->analyze_html_hoou($htmlContent);
      var_dump($this->html_analyzer->get_metadata());
    }
