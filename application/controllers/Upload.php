<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');

        // Turn on IE8-IE9 XSS prevention tools
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
		// Don't allow any pages to be framed - Defends against CSRF
		$this->output->set_header('X-Frame-Options: SAMEORIGIN');
		// prevent mime based attacks
		$this->output->set_header('X-Content-Type-Options: nosniff');
    }

    public function index() {
        $this->load->view('main/v_upload');
    }

    public function store() {
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1920;
        $config['max_height'] = 1280;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('main/v_upload', $error);
        } else {
            $data = array('image_metadata' => $this->upload->data());

            $this->load->view('main/v_upload_result', $data);
        }
    }

}