<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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
	    $query = "SELECT DATE(authdate) as tanggal,COUNT(*) as jumlah
                                    FROM radpostauth";

        $this->db->db_debug = false;
        if(!@$this->db->query($query))
        {
            $error = $this->db->error();
            header('location: /users');
        }else{
		$this->load->model('m_data');
        $data = $this->m_data->GetDataLimit('radpostauth','id','DESC','10');
        $data0 = $this->m_data->GetDataGraph();
        $data1 = $this->m_data->Total('radpostauth');
        $data2 = $this->m_data->Today('radpostauth');
        $data3 = $this->m_data->Week('radpostauth');
        $data4 = $this->m_data->Month('radpostauth');
        $data = array('data' => $data,'total' => $data1,'today' => $data2,'week' => $data3,'months' => $data4, 'graph' => $data0);
        
        // $data = array('data' => $data,'total' => $data1,'today' => $data2,'week' => $data3,'months' => $data4);
            
        $data_priority = $this->m_data->GetDataSelect('tbl_admin','username',$this->session->userdata('name'));
        $data_page = array('data_page' => $data_priority);

        $this->load->view('support/header',$data_page);
		$this->load->view('main/v_dashboard',$data);
		$this->load->view('support/footer');
        }
	}
}
