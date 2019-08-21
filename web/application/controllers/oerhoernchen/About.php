<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/simple_dom_parser/simple_dom_parser.php';

class About extends CI_Controller
{

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    //var_dump($this->session);

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

  public function about_add_entry(){
    $jsCssData['header_title'] = 'Eintrag hinzufügen?';
    $jsCssData['css_files'] = array(
      base_url() . 'assets/css/oerhoernchen.community_bookmarks.css');
    $this->load->view('oerhoernchen/header.php', $jsCssData);
    $this->load->view('oerhoernchen/about_add_entry.php');
    $this->load->view('oerhoernchen/footer.php');
  }


}
