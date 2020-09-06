<?php

class User extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->library('session');
	}

	public function index()
	{
		$session = $this->session->userdata('admin_session');
		// print_r($session);die();
		if(!empty($session)){
			$data['view'] = 'admin/user/index';
			$data['data'] = $this->common_obj->getRows('tbl_users', '*', $where = NULL, $returnArray = NULL, 'id desc'); 
			$this->load->view('admin/layouts/template',$data);
		}else{
			redirect('admin/Login');
		}
	}
}

?>