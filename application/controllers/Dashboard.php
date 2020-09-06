<?php

class Dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// $this->load->library('encryption');
		// $this->load->model('UserModel','user_obj');
	}

	public function index()
	{
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
        	$data['certificate'] = $this->common_obj->countRows('tbl_certification', ['user_id' => $session->id]);
        	$data['view'] = 'pages/dashboard';
        	$data['title'] = 'Dashboard';
			$this->load->view('layouts/template',$data);
        } 
        else 
        {
            redirect('Home');
        }
	}

}

?>