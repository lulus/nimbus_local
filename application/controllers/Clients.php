<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {
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
        // $data_clients = $this->m_data->MasterGetDataSelect('tbl_login','id_company',$key['id_company']);

        $edit_clients = $this->m_data->MasterGetDataSelect('radcheck','id',$id);
        $edit_clients2 = $this->m_data->GetDataClient($id);
        $data_clients = $this->m_data->GetDataClients();
        $data_attribute = $this->m_data->GetData('radgroupcheck','groupname','ASC');
        $data = array('data_clients' => $data_clients, 'edit_clients' => $edit_clients2, 'data_attribute' => $data_attribute);
		
		$data_priority = $this->m_data->GetDataSelect('tbl_admin','username',$this->session->userdata('name'));
		$data_page = array('data_page' => $data_priority);

		$this->load->view('support/header',$data_page);
		$this->load->view('main/v_clients', $data);
		$this->load->view('support/footer');

		if(isset($_POST['delete_user'])){
			$key = $this->secure->decrypt_url($this->input->post('delete_user'));
			$this->m_data->DeleteData('radcheck','id',$key);
			header('location: /clients');
		}

		if(isset($_POST['edit_user'])){
			$id = $this->input->post('edit_user');
			header('location: /clients?63dfc30e7ea9db920384c9f1edc8c6a2='.$id.'#edit');
		}
	}

	public function add(){
		$this->form_validation->set_rules('name', 'User Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric');
		if($this->form_validation->run() != false){
			$username = $this->input->post('name');
			$password = $this->input->post('password');
			$group = $this->input->post('group');

			$data_user = $this->m_data->MasterGetDataSelect('radcheck','username',$username);

			if(count($data_user) == 0){
				if($username != null && $password != null){
					$data['username']	= $username;
					$data['attribute']	= 'Cleartext-Password';
					$data['op']	= ':=';
					$data['value']	= $password;
					$res = $this->m_data->MasterInputData('radcheck',$data);


					$data2['username']	= $username;
					$data2['groupname']	= $group;
					$res = $this->m_data->MasterInputData('radusergroup',$data2);
				}
				header('location: /clients');
			}else{
				header('location: /clients#fail');
			}
		}else{
			header('location: /clients#fail');
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
			$group = $this->input->post('group');

			//Check MD5 or New
				if($id != null && $username != null && $password != null){
					$where = array(
						'id' => $id,
						'username' => $username
					);
					$data = array(
						'value' => $password
					);
					$this->m_data->MasterUpdataData($where,'radcheck',$data);

					//Group Check
					$where2 = array(
						'username' => $username
					);
					$data2 = array(
						'groupname' => $group
					);
					$this->m_data->MasterUpdataData($where2,'radusergroup',$data2);

					header('location: /clients#success');
				}else{
					header('location: /clients#fail');
				}
		}else{
			header('location: /clients#fail');
		}		
		
	}
}
