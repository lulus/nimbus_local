<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('session','url','secure','form_validation');
        $this->load->model('m_data');
		$this->load->helper(array('form'));

        if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}else{
            $priority = $this->m_data->GetDataSelect('tbl_admin','username',$this->session->userdata('name'));
            foreach($priority as $row);
            if($row['priority'] =='1'){
                redirect(base_url("dashboard"));
            }
        }

		// Turn on IE8-IE9 XSS prevention tools
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
		// Don't allow any pages to be framed - Defends against CSRF
		$this->output->set_header('X-Frame-Options: SAMEORIGIN');
		// prevent mime based attacks
		$this->output->set_header('X-Content-Type-Options: nosniff');
    }

	public function index(){
		
		// $data_list = $this->secure->decrypt_url($this->session->userdata('cfg'));
		// $data_company = $this->m_data->MasterGetDataSelect('tbl_login','id',$data_list);
		// foreach ($data_company as $key);
		
		$id = $this->secure->decrypt_url($this->input->get('63dfc30e7ea9db920384c9f1edc8c6a2'));
        // $data_admin = $this->m_data->MasterGetDataSelect('tbl_login','id_company',$key['id_company']);

        $edit_admin = $this->m_data->MasterGetDataSelect('tbl_admin','id',$id);
        $data_admin = $this->m_data->GetData('tbl_admin','username','ASC');
        $data = array('data_admin' => $data_admin, 'edit_admin' => $edit_admin);
		
		$data_priority = $this->m_data->GetDataSelect('tbl_admin','username',$this->session->userdata('name'));
		$data_page = array('data_page' => $data_priority);

		$this->load->view('support/header',$data_page);
		$this->load->view('main/v_admin', $data);
		$this->load->view('support/footer');

		if(isset($_POST['delete_user'])){
			$key = $this->secure->decrypt_url($this->input->post('delete_user'));
			$this->m_data->DeleteData('tbl_admin','id',$key);
			header('location: /admin');
		}

		if(isset($_POST['edit_user'])){
			$id = $this->input->post('edit_user');
			header('location: /admin?63dfc30e7ea9db920384c9f1edc8c6a2='.$id.'#edit');
		}
	}

	public function add(){
		$this->form_validation->set_rules('name', 'User Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric');
		if($this->form_validation->run() != false){
			$username = $this->input->post('name');
			$password = $this->input->post('password');
			$description = $this->input->post('description');

			$data_user = $this->m_data->MasterGetDataSelect('tbl_admin','username',$username);

			if(count($data_user) == 0){
				if($username != null && $password != null){
					$data['username']	= $username;
					$data['password']	= md5($password);
					$data['description']	= $description;
					$data['priority']	= '1';
					$res = $this->m_data->MasterInputData('tbl_admin',$data);
				}
				header('location: /admin');
			}else{
				header('location: /admin#fail');
			}
		}else{
			header('location: /admin#fail');
		}		
	}

	public function edit(){
		$this->form_validation->set_rules('id', 'id', 'required|alpha_numeric');
		$this->form_validation->set_rules('name', 'User Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric');
		if($this->form_validation->run() != false){
			$id = $this->input->post('id');
			$username = $this->input->post('name');
			$password = $this->input->post('password');
			$description = $this->input->post('description');

			//Check MD5 or New
			$where = array(
				'username' => $username,
				'password' => $password
				);
			$cek = $this->m_data->cek_password("tbl_admin",$where)->num_rows();
			if($cek == 0){
				if($id != null && $username != null && $password != null){
					$where = array(
						'id' => $id,
						'username' => $username
					);
					$data = array(
						'password' => md5($password),
						'description' => $description
					);
					$this->m_data->MasterUpdataData($where,'tbl_admin',$data);
					header('location: /admin#success');
				}else{
					header('location: /admin#fail');
				}
			}else{
				header('location: /admin');
			}	
		}else{
			header('location: /admin#fail');
		}		
		
	}
}
