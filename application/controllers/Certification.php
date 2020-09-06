<?php

/**
 * 
 */
class Certification extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
        	$where = [
        		'user_id' => $session->id,
        		'user_email' => $session->email
        	];
        	$data['certies'] = $this->common_obj->getRows('tbl_certification', '*', $where, $returnArray = NULL, $orderby = 'id desc');
        	$data['view'] = 'certifications/view';
        	$data['title'] = 'Certification';
			$this->load->view('layouts/template',$data);
        }
        else
      	{
        	redirect('Home');
        }
	}

	public function upload()
	{
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
        	$data['view'] = 'certifications/upload';
        	$data['title'] = 'Certification-upload';
			$this->load->view('layouts/template',$data);
        }
        else
        {
        	redirect('Home');
        }
	}

	public function create()
	{
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
        	$name = $this->input->post('name');
        	$organization = $this->input->post('organization');
        	$issue = $this->input->post('issue');
        	$expire = $this->input->post('expire');
        	$cred_id = $this->input->post('cred_id');
        	$cred_url = $this->input->post('cred_url');
        	$user_id = $session->id;
        	$email = $session->email;
        	ini_set('memory_limit', '200M');
            ini_set('upload_max_filesize', '200M');  
            ini_set('post_max_size', '200M');  
            ini_set('max_input_time', 3600);  
            ini_set('max_execution_time', 3600);
            $users_folder = './uploads/user_certifications';
            if (!file_exists($users_folder)) 
            {
                mkdir($users_folder, 0777, true);
            }
            $users_folder_thumb = './uploads/user_certifications/thumb';
            if (!file_exists($users_folder_thumb)) 
            {
                mkdir($users_folder_thumb, 0777, true);
            }
         	$fileName = $_FILES['image']['name'];
            if ($fileName != "") 
            {
            	/* First Parameter is image Name and second Parameter is path
				base path is => 'uploads/' */
                $image = $this->upload_image('image','user_certifications');
            }
            else
            {
            	$image = "";	
            }
            $data = array(
            	'certi_name' => $name,
            	'organization' => $organization,
            	'issue' => $issue,
            	'expire' => $expire,
            	'cred_id' => $cred_id,
            	'cred_url' => $cred_url,
            	'image' => $image,
            	'user_id' => $user_id,
            	'user_email' => $email
            );
         	$this->common_obj->insertData('tbl_certification', $data);

            $this->session->set_flashdata('success', 'Certification added successfully');

            redirect('Certification','refresh');
        }
        else
        {
        	redirect('Home');
        }
	}


	public function edit($id)
	{
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
        	$where = [
        		'id' => $id
        	]; 
        	$data['certi'] = $this->common_obj->getSingleRow('tbl_certification', $where, $cols = NULL, $orderby = NULL);
        	$data['view'] = 'certifications/edit';
        	$data['title'] = 'Certification-Edit';
			$this->load->view('layouts/template',$data);
        }
        else
        {
        	redirect('Home');
        }
	}

	public function view($id)
	{
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
        	$where = [
        		'id' => $id
        	]; 
        	$data['certi'] = $this->common_obj->getSingleRow('tbl_certification', $where, $cols = NULL, $orderby = NULL);
        	$data['view'] = 'certifications/show';
        	$data['title'] = 'Certification';
			$this->load->view('layouts/template',$data);
        }
        else
        {
        	redirect('Home');
        }
	}

	public function delete($id)
	{
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
        	$this->common_obj->deleteData('tbl_certification', ['id' => $id]); 
        	$this->session->set_flashdata('success', 'Certification deleted successfully');

            redirect('Certification','refresh');
        }
        else
        {
        	redirect('Home');
        }
	}

	public function update()
	{
		$session = $this->session->userdata('user_session');
		if ($this->session->userdata('user_session')) 
        {
        	$id = $this->input->post('id');
        	$name = $this->input->post('name');
        	$organization = $this->input->post('organization');
        	$issue = $this->input->post('issue');
        	$expire = $this->input->post('expire');
        	$cred_id = $this->input->post('cred_id');
        	$cred_url = $this->input->post('cred_url');
        	$user_id = $session->id;
        	$email = $session->email;
        	$data = array(
            	'certi_name' => $name,
            	'organization' => $organization,
            	'issue' => $issue,
            	'expire' => $expire,
            	'cred_id' => $cred_id,
            	'cred_url' => $cred_url
            );
        	ini_set('memory_limit', '200M');
            ini_set('upload_max_filesize', '200M');  
            ini_set('post_max_size', '200M');  
            ini_set('max_input_time', 3600);  
            ini_set('max_execution_time', 3600);
            $users_folder = './uploads/user_certifications';
            if (!file_exists($users_folder)) 
            {
                mkdir($users_folder, 0777, true);
            }
            $users_folder_thumb = './uploads/user_certifications/thumb';
            if (!file_exists($users_folder_thumb)) 
            {
                mkdir($users_folder_thumb, 0777, true);
            }
         	$fileName = $_FILES['image']['name'];
            if (!empty($fileName)) 
            {
            	/* First Parameter is image Name and second Parameter is path
				base path is => 'uploads/' */
                $image = $this->upload_image('image','user_certifications');
                $this->common_obj->updateData('tbl_certification', ['id' => $id], ['image' => $image]);

            }
            $this->common_obj->updateData('tbl_certification', ['id' => $id], $data);
            // print_r($data);
         	// $this->common_obj->insertData('tbl_certification', $data);

            $this->session->set_flashdata('success', 'Certification updated successfully');

            redirect('Certification','refresh');
        }
        else
        {
        	redirect('Home');
        }
	}


    public function request()
    {
        $session = $this->session->userdata('user_session');
        if ($this->session->userdata('user_session')) 
        {
            $data['view'] = 'certifications/request';
            $data['title'] = 'Certification-request';
            $data['data']  = $this->common_obj->getRows('certficate_request', '*', $where=null, $returnArray = NULL, $orderby = 'id desc');
            $this->load->view('layouts/template',$data);
        }
        else
        {
            redirect('Home');
        }
    }

    public function newRequest()
    {   
        $session = $this->session->userdata('user_session');
        if ($this->session->userdata('user_session')) 
        {
            $data['view'] = 'certifications/new_request';
            $data['title'] = 'Certification-request';
            $this->load->view('layouts/template',$data);
        }
        else
        {
            redirect('Home');
        }
    }

    public function createRequest()
    {
        $session = $this->session->userdata('user_session');
        if ($this->session->userdata('user_session')) 
        {
            $sheetName = '';
            $certi_photo = '';
            ini_set('memory_limit', '200M');
            ini_set('upload_max_filesize', '200M');  
            ini_set('post_max_size', '200M');  
            ini_set('max_input_time', 3600);  
            ini_set('max_execution_time', 3600);
            $users_folder = './uploads/sheets';
            if (!file_exists($users_folder)) 
            {
                mkdir($users_folder, 0777, true);
            }
            $fileName = $_FILES['sheet']['name'];
            $type = $_FILES['sheet']['type'];
            if($type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            {
                $type = 'xlsx';
            }
            else
            {
                $type = 'csv';
            }
            // echo $type;die();
            if (!empty($fileName)) 
            {
                /* First Parameter is image Name and second Parameter is path
                base path is => 'uploads/' */
                $sheetName = $this->file_upload('sheet','sheets',$type);
            }
            $certi_name = $_FILES['certi_photo']['name'];
            if(!empty($certi_name)){
                $image = $this->upload_image('certi_photo','custom_certifications');
                $certi_photo = $image;
            }
            // echo $sheetName;   
            $message = $this->input->post('message');
            $user_id  = $session->id;
            $req_id =  $this->reqIdGenerator(6);
            $data = [
                'req_id' => $req_id,
                'user_id' => $user_id,
                'sheet' => $sheetName,
                'message' => $message,
                'certi_photo' => $certi_photo
            ];
            $this->common_obj->insertData('certficate_request', $data);

            $this->session->set_flashdata('success', 'Certification Request added successfully');

            redirect('Certification/request','refresh');
        }
        else
        {
            redirect('Home');
        }
    }

    public function cancelRequest($id){
        $session = $this->session->userdata('user_session');
        if ($this->session->userdata('user_session')) 
        {
            $this->common_obj->updateData('certficate_request', ['req_id' => $id], ['status'=> '3']);
            $this->session->set_flashdata('success', 'Certification Request Updated successfully');

            redirect('Certification/request','refresh');
        }
        else
        {
            redirect('Home');
        }
    }

    public function reqIdGenerator($n){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
      
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        
        $check = $this->common_obj->countRows('certficate_request', ['req_id' => $randomString]);
        // die("fdsfsdf".$check);
        if($check > 0){
            $this->reqIdGenerator($n);
        }else{
            return $randomString;
        }
    }
}