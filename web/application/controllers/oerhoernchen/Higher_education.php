<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/simple_dom_parser/simple_dom_parser.php';

class Higher_education extends CI_Controller
{

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    //var_dump($this->session);
    if(is_null($this->session->userdata('privacy_notice_accepted'))){
      redirect('oerhoernchen/privacy');
    }

    $logged_in = $this->ion_auth->logged_in();

    if ($logged_in) {
      $this->user_id = $this->ion_auth->user()->row()->id;
    } else {
      $this->user_id = null;
    }
    log_message('debug', 'USERID: ' . $this->user_id);

    // add data to views
    $data['logged_in'] = $logged_in;
    $this->load->vars($data);
  }


// show the official index
    public function index()
    {
        $this->config->load('appbase');
        $jsCssData['appbase_auth_string_read'] = $this->config->item('appbase_auth_string_read_highereducation');
        $jsCssData['appbase_app_name'] = $this->config->item('appbase_app_name_highereducation');
        //$jsCssData['appbase_api_url'] = $this->config->item('appbase_api_url');
        $jsCssData['css_files'] = array(base_url() . 'assets/css/oerhoernchen.community_bookmarks.css');
        $jsCssData['js_files'] = array(base_url() . 'assets/js/oerhoernchen.higher_education.react.js');
        $jsCssData['header_title'] = 'Community Lesezeichen';
        $this->load->view('oerhoernchen/header.php', $jsCssData);
        $this->load->view('oerhoernchen/community_bookmarks.php');
        $this->load->view('oerhoernchen/footer.php');
    }
}
