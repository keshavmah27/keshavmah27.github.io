<?php

class User extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// $this->load->library('encryption');
		// $this->load->model('UserModel','user_obj');
	}

	public function register(){
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
            redirect('Home');
        } 
        else 
        {
			$data['title'] = 'Certification-Register';
			$this->load->view('session/register',$data);
		}
	}

	public function login(){
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
            redirect('Home');
        } 
        else 
        {
			$data['title'] = 'Certification-Login';
			$this->load->view('session/login',$data);
		}
	}

	public function createUser()
	{	
		$data = [
			'fname'=> $this->input->post('fname'),
			'lname'=> $this->input->post('lname'),
			'email'=> $this->input->post('email'),
			'password'=> md5($this->input->post('password')),
			'role' => '0'
		];
		if($this->check_email($this->input->post('email')) ){
			$to = $this->input->post('email');
			$template_data['NAME'] =$this->input->post('fname');
			$this->load->library('email');
	        $this->email->from(FROM_EMAIL, PROJECT_NAME);
	        $this->email->to($to);
	        $this->email->subject("Forgot Password - ".PROJECT_NAME);
	        $this->email->message($this->load->view('emails/register.php', $template_data, TRUE));
	        $this->email->send();
			// print_r($data);
			$create = $this->common_obj->insertData('tbl_users', $data);
			if(isset($create['insertedRowId'])){
				$this->session->set_flashdata('success', 'Account successfully created now you can login.');
				redirect('User/login');
			}else{
				$this->session->set_flashdata('error', 'Something wents wrong please try after sometime or contact to admin.');
				redirect('User/login');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Email is already used!.');
			redirect('User/register');
		}

	}

	function check_email($email)
	{
		
		
		$email_exists = $this->common_obj->countRows('tbl_users', array('email'=>$email));
		

		// echo $email_exists; exit;
		if ($email_exists > 0) {
			return false;
		} else {
			return true;
		}	
	}

	function createSession(){
		// print_r($_POST);
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
            redirect('Home');
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
            $res = $this->common_obj->getSingleRow('tbl_users', $where, $cols = NULL, $orderby = NULL);
            if (!empty($res) == '1') 
            {
            	unset($res->password);                    
                $this->session->set_userdata('user_session', $res);
                   if ($this->input->post("remember"))
               {
                   $this->input->set_cookie('email_certy', $email, 86500); 
                   $this->input->set_cookie('password_certy', $pass, 86500);
               }
               else{
                   delete_cookie('email_certy');
                   delete_cookie('password_certy');   
               }                    
                redirect('Home');
                
            }else{
            	$this->session->set_flashdata('error', 'Email Id password incorrect.');
				redirect('User/login');
            } 
        }
	}

	public function logout() 
    {
        $this->session->unset_userdata('user_session');
        $this->session->unset_userdata('app_data');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

        redirect('Home', 'refresh');
    }
}

?>