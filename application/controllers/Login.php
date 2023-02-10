<?php 

class Login extends CI_Controller{
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
		$this->load->library('secure');

		if($this->session->userdata('status') == "login"){
			redirect(base_url("dashboard"));
		}

        // Prevent some security threats
		// Turn on IE8-IE9 XSS prevention tools
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
		// Don't allow any pages to be framed - Defends against CSRF
		$this->output->set_header('X-Frame-Options: SAMEORIGIN');
		// prevent mime based attacks
		$this->output->set_header('X-Content-Type-Options: nosniff');
	}

	function index(){
		$this->load->view('main/v_login');
	}

	function aksi_login(){
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric');
		if($this->form_validation->run() != false){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$where = array(
				'username' => $username,
				'password' => $password
				// 'password' => md5($password)
				);
			$cek = $this->m_login->cek_login("tbl_admin",$where)->num_rows();
			if($cek > 0){

				$data_session = array(
					'name' => $username,
					'status' => "login"
					);

				$this->session->set_userdata($data_session);

				redirect(base_url("dashboard"));

			}else{
				redirect(base_url("login#fail"));
			}
		}else{
			redirect(base_url("login#fail"));
		}
	}
}