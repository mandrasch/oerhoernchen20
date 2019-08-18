<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/simple_dom_parser/simple_dom_parser.php';

class Backoffice extends CI_Controller {

	public function __construct() {
		parent::__construct();

		/* pro login */
		/*$this->load->model("user_model");
		if (!$this->user->loggedin) {
			redirect(site_url("login"));
		}*/

		// ID = 2 -> editorialstaff
		/*if (!$this->user_model->check_user_in_group($this->user->info->ID, 2)) {
			// 2DO: is show_error the best solution?
			show_error("You are not in the User Group Friends so you cannot view this page!");
		}*/

		# single group (by id)
		/*$group = 1;
		if (!$this->ion_auth->in_group($group)) {
			$this->session->set_flashdata('message', 'You must be part of the group 1 to view this page');
			redirect('auth/login');
		}*/

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');

	}

	public function index() {
		redirect('backoffice/entries_awaiting_approval');
	}

	public function _backoffice_output($output = null) {
		$this->load->view('backoffice.php', (array) $output);
	}

	public function entries_awaiting_approval() {
		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('oerh_entries_awaiting_approval');
			//$crud->set_subject('Office');
			//$crud->required_fields('');
			//$crud->columns('city','country','phone','addressLine1','postalCode');

			$crud->add_action('Publish to index', '', 'backoffice/publish_from_database_to_index', 'el-book');

			$output = $crud->render();

			//$this->_backoffice_output($output);

			$this->load->view('oerhoernchen/header.php', $output); // first insert of data is enough?
			$this->load->view('oerhoernchen/backoffice');
			$this->load->view('oerhoernchen/footer.php');

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}

	public function log_submitted_entries() {
		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('oerh_log_submitted_entries');
			//$crud->set_subject('Office');
			//$crud->required_fields('');
			//$crud->columns('city','country','phone','addressLine1','postalCode');
			$output = $crud->render();

			//$this->_backoffice_output($output);

			$this->load->view('oerhoernchen/header.php', $output); // first insert of data is enough?
			$this->load->view('oerhoernchen/backoffice');
			$this->load->view('oerhoernchen/footer.php');

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}

	public function log_imgur_uploads() {
		try {
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('oerh_log_imgur_uploads');
			//$crud->set_subject('Office');
			//$crud->required_fields('');
			//$crud->columns('city','country','phone','addressLine1','postalCode');
			$output = $crud->render();

			//$this->_backoffice_output($output);

			$this->load->view('oerhoernchen/header.php', $output); // first insert of data is enough?
			$this->load->view('oerhoernchen/backoffice');
			$this->load->view('oerhoernchen/footer.php');

		} catch (Exception $e) {
			show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
		}
	}

	public function publish_from_database_to_index($id) {

		// 2DO: check if id is set
		if (!isset($id) && $id != '') {
			show_error('No id set', 500);
		}

		// 2DO: get data from db

		$query = $this->db->get_where('oerh_entries_awaiting_approval', array('id' => $id), 1);

		if ($query->num_rows() == 0) {
			show_error('No record for ID found'); // will exit
		}

		$row = $query->row();

		log_message('debug', 'Result row from db: ' . print_r($row, true));

		// 2DO: count if found
		// otherwise show error
		$jsonData = $row->json_data;
		$userId = $row->user_id;
		$imgurUrl = $row->imgur_url;
		$imgurDeleteHash = $row->imgur_delete_hash;
		$timeAdded = $row->time;

		$this->load->library('appbase');
		$resultElasticId = $this->appbase->publish_to_index_and_log_in_database($jsonData, $userId, $imgurUrl, $imgurDeleteHash, $timeAdded); // will exit if there is an error

		if ($resultElasticId === false) {
			show_error('Error while trying to publish to index.', 500);
		}

		$this->db->delete('oerh_entries_awaiting_approval', array('id' => $id));
		// if there is a query error, codeigniter will stop execution
		// Produces: // DELETE FROM mytable  // WHERE id = $id
		if ($this->db->affected_rows() == 0) {
			show_error('Delete query was not successful from entries_awaiting_approval, affected rows returned 0. Entry in index was created successful', 500);
		}

		$output = array(
			'output' => 'Entry created successfully: ' . $resultElasticId . ', deleted entry from entries_awaiting_approval table.',
			'js_files' => array(),
			'css_files' => array(),
		);

		$this->load->view('oerhoernchen/header.php', $output); // first insert of data is enough?
		$this->load->view('oerhoernchen/backoffice');
		$this->load->view('oerhoernchen/footer.php');

		// $this->_backoffice_output($output);

	}


	// 2DO: get all not submitted entries

	// 2DO: preview entry (> image file)

	// 2DO: submit entry to index

	// 2DO: delete imgur img

	// 2DO: delete entry from index

}
