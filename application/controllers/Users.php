<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session','url');
        $this->load->model('m_data');

        if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

		// Turn on IE8-IE9 XSS prevention tools
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
		// Don't allow any pages to be framed - Defends against CSRF
		$this->output->set_header('X-Frame-Options: SAMEORIGIN');
		// prevent mime based attacks
		$this->output->set_header('X-Content-Type-Options: nosniff');
    }

	public function index(){
		$data2 = array(
			"dpicker" => "-----"
		);
		$this->load->model('m_data');		
		if(isset($_POST['submit'])){
			$sdate = $this->input->post('sdate');
			$edate = $this->input->post('edate');
			$data = $this->m_data->GetDataUserByDate($sdate,$edate);
		}else if(isset($_POST['dpicker'])){
			if ($this->input->post('dpicker') == 'Today'){
				$data2 = array(
					"dpicker" => "Today"
				);

				$sdate = date("Y-m-d");
				$edate = date("Y-m-d");
				$data = $this->m_data->GetDataUserByDate($sdate,$edate);
			}else if ($this->input->post('dpicker') == 'Last Week'){
				$data2 = array(
					"dpicker" => "Last Week"
				);

				$t = strtotime('-1 week', time());
				$sdate = date("Y-m-d",$t);
				$edate = date("Y-m-d");
				$data = $this->m_data->GetDataUserByDate($sdate,$edate);
			}else if ($this->input->post('dpicker') == 'Last Month'){
				$data2 = array(
					"dpicker" => "Last Month"
				);

				$t = strtotime('-1 month', time());
				$sdate = date("Y-m-d",$t);
				$edate = date("Y-m-d");
				$data = $this->m_data->GetDataUserByDate($sdate,$edate);
			}else if ($this->input->post('dpicker') == 'All Data'){
				$data2 = array(
					"dpicker" => "All Data"
				);

				$data = $this->m_data->GetData('radpostauth','id','DESC');
			}else{
				$data2 = array(
					"dpicker" => "-----"
				);
				$data = $this->m_data->GetData('radpostauth','id','DESC');
			}
		}else{
			$data = $this->m_data->GetData('radpostauth','id','DESC');
		}

		$data = array('data' => $data, 'data2' => $data2);            
        $data_priority = $this->m_data->GetDataSelect('tbl_admin','username',$this->session->userdata('name'));
        $data_page = array('data_page' => $data_priority);

        $this->load->view('support/header',$data_page);
		$this->load->view('main/v_users',$data);
		$this->load->view('support/footer');
	}
}
