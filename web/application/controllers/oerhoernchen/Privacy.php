<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/simple_dom_parser/simple_dom_parser.php';

class Privacy extends CI_Controller
{

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    //var_dump($this->session);
  }

  function index(){
    $jsCssData['header_title'] = 'Datenschutzerklärung';
    // used for smaller headers
		$jsCssData['css_files'] = array(base_url() . 'assets/css/oerhoernchen.community_bookmarks.css');
    $jsCssData['privacy_notice_accepted'] = (bool)$this->session->privacy_notice_accepted;
    $this->load->view('oerhoernchen/header.php', $jsCssData);
    $this->load->view('oerhoernchen/privacy.php');
    $this->load->view('oerhoernchen/footer.php');
  }

  function accept_privacy_notice(){
      $this->session->set_userdata(array('privacy_notice_accepted'=>TRUE));
      redirect("oerhoernchen/higher_education"); // 2DO: maybe from other page redirected?
  }

  function remove_decision(){
    $this->session->unset_userdata('privacy_notice_accepted');
    redirect("oerhoernchen/privacy/index");
  }

}
