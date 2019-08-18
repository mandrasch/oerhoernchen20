<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		/* was: pro login */
		/*$this->load->model("user_model");
		if (!$this->user->loggedin) {
			redirect(site_url("login"));
		}*/

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

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		//$user = $this->ion_auth->user()->row(); #
		//$data['user_email'] = $user->email;
		//$this->load->view('welcome_message', $data);
		$headerData = array(
			'header_title' => 'Community-Lesezeichen',
			'header_subtitle' => 'Gemeinsam gute OER-Materialien sammeln',
		);
		$this->load->view('oerhoernchen/header.php', $headerData);
		$this->load->view('oerhoernchen/welcome');
		$this->load->view('oerhoernchen/footer.php');

	}
}
