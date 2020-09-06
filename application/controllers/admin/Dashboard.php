<?php
// echo CI_VERSION; exit;  

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->library('session');
	}

	function index(){
		$session = $this->session->userdata('admin_session');
		// print_r($session);die();
		if(!empty($session)){
			$data['view'] = 'admin/dashboard';
			$this->load->view('admin/layouts/template',$data);
		}else{
			redirect('admin/Login');
		}
	}
}
