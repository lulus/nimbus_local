<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends CI_Controller {
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

        $edit_groups = $this->m_data->MasterGetDataSelect('radgroupcheck','id',$id);
        $data_groups = $this->m_data->GetData('radgroupcheck','groupname','ASC');
        $data = array('data_groups' => $data_groups, 'edit_groups' => $edit_groups);
		
		$data_priority = $this->m_data->GetDataSelect('tbl_admin','username',$this->session->userdata('name'));
		$data_page = array('data_page' => $data_priority);

		$this->load->view('support/header',$data_page);
		$this->load->view('main/v_groups', $data);
		$this->load->view('support/footer');

		if(isset($_POST['delete_group'])){
			$key = $this->secure->decrypt_url($this->input->post('delete_group'));
			$this->m_data->DeleteData('radgroupcheck','id',$key);
			header('location: /groups');
		}

		if(isset($_POST['edit_group'])){
			$id = $this->input->post('edit_group');
			header('location: /groups?63dfc30e7ea9db920384c9f1edc8c6a2='.$id.'#edit');
		}
	}

	public function add(){
		$this->form_validation->set_rules('name', 'Enter Group Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('limit-device', 'Enter Limit Device', 'numeric');
		if($this->form_validation->run() != false){
			$name = $this->input->post('name');
			$limit = $this->input->post('limit-device');

			$data_group = $this->m_data->MasterGetDataSelect('radgroupcheck','groupname',$name);

			if(count($data_group) == 0){
				if($name != null && $limit != null){
					$data['groupname']	= $name;
					$data['attribute']	= 'Simultaneous-Use';
					$data['op']	= ':=';
					$data['value']	= $limit;
					$res = $this->m_data->MasterInputData('radgroupcheck',$data);
				}
				header('location: /groups');
			}else{
				header('location: /groups#fail');
			}
		}else{
			header('location: /groups#fail');
		}		
	}

	public function edit(){
		$this->form_validation->set_rules('id', 'id', 'required|alpha_numeric');
		$this->form_validation->set_rules('name', 'Group Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('limit-device', 'Enter Limit Device', 'required|alpha_numeric');
		if($this->form_validation->run() != false){
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$limit = $this->input->post('limit-device');

			//Check MD5 or New
			$where = array(
				'groupname' => $name,
				'value' => $limit
				);
			$cek = $this->m_data->cek_password("radgroupcheck",$where)->num_rows();
			if($cek == 0){
				if($id != null && $name != null && $limit != null){
					$where = array(
						'id' => $id,
						'groupname' => $name
					);
					$data = array(
						'value' => $limit
					);
					$this->m_data->MasterUpdataData($where,'radgroupcheck',$data);
					header('location: /groups#success');
				}else{
					header('location: /groups#fail');
				}
			}else{
				header('location: /groups');
			}	
		}else{
			header('location: /groups#fail');
		}		
		
	}
}
