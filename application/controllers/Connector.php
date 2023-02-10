<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connector extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session','url');
        $this->load->model('m_data');

        if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
    }

	public function index(){
		$this->load->view('support/header');
		$this->load->view('main/v_connector');
		$this->load->view('support/footer');
	}
}
