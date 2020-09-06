<?php
// echo CI_VERSION; exit;  

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
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
		if(empty($session)){
			$this->load->view('admin/login');
		}else{
			redirect('admin/Dashboard');
		}
	}

	function signIn()
	{
		$session = $this->session->userdata('admin_session');
		if ($this->session->userdata('admin_session')) 
    {
        redirect('admin/Dashboard');
    } 
    else 
    {
    	$email = @$_POST['email'];
        $pass = @$_POST['password'];
        $password = md5(@$_POST['password']);
        $where = array(
        	'email' => $email,
        	'password' => $password
        );
        $res = $this->common_obj->getSingleRow('tbl_admin', $where, $cols = NULL, $orderby = NULL);
        if (!empty($res) == '1') 
        {
        	unset($res->password);                    
            $this->session->set_userdata('admin_session', $res);
               if ($this->input->post("remember"))
           {
               $this->input->set_cookie('email_admin', $email, 86500); 
               $this->input->set_cookie('password_admin', $pass, 86500);
           }
           else{
               delete_cookie('email_certy');
               delete_cookie('password_certy');   
           }                    
            redirect('admin/Dashboard');
            
        }else{
        	$this->session->set_flashdata('error', 'Email Id password incorrect.');
		      redirect('admin/Login');
        } 
    }
	}


  public function logout(){
    $this->session->unset_userdata('admin_session');
        $this->session->unset_userdata('app_data');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->session->set_flashdata('success', 'Logout successfully!');
        redirect('admin/Dashboard', 'refresh');
  }
}
