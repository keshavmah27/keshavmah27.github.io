<?php

class Certificate extends MY_Controller{
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
		if(!empty($session)){
			$data['view'] = 'admin/certificate/index';
			$data['data'] = $this->common_obj->getRows('certificate_create_detail', '*', $where = NULL, $returnArray = NULL, 'id desc'); 
			
			$this->load->view('admin/layouts/template',$data);
		}else{
			redirect('admin/Login');
		}
	}

	public function new(){
		$session = $this->session->userdata('admin_session');
		if(!empty($session)){
			// $data['view'] = 'admin/certificate/new';
			$this->load->view('admin/certificate/new');
		}else{
			redirect('admin/Login');
		}
	}

	public function create()
	{
		$session = $this->session->userdata('admin_session');
		if(!empty($session)){
			ini_set('memory_limit', '200M');
            ini_set('upload_max_filesize', '200M');  
            ini_set('post_max_size', '200M');  
            ini_set('max_input_time', 3600);  
            ini_set('max_execution_time', 3600);
            $users_folder = './uploads/custom_certifications';
            if (!file_exists($users_folder)) 
            {
                mkdir($users_folder, 0777, true);
            }
            $users_folder_thumb = './uploads/custom_certifications/thumb';
            if (!file_exists($users_folder_thumb)) 
            {
                mkdir($users_folder_thumb, 0777, true);
            }
         	$fileName = $_FILES['certi_image']['name'];
            if ($fileName != "") 
            {
            	/* First Parameter is image Name and second Parameter is path
				base path is => 'uploads/' */
                $image_name = $this->upload_image('certi_image','custom_certifications');
            }
            else
            {
            	$image_name = "";	
            }
			$data = [
				'cid' => $this->cidGenerator(6),
				'certi_name_size' =>  $this->input->post('certi_name_size'),
				'certi_name_to' => $this->input->post('certi_name_to'),
				'certi_name_left' => $this->input->post('certi_name_left'),
				'certi_name_color' => $this->input->post('certi_name_color'),
				'certi_name_font' => $this->input->post('certi_name_font'),
				'certi_name_align' => $this->input->post('certi_name_align'),
				'certi_url_size' => $this->input->post('certi_url_size'),
				'certi_url_top' => $this->input->post('certi_url_top'),
				'certi_url_left' => $this->input->post('certi_url_left'),
				'certi_url_color' => $this->input->post('certi_url_color'),
				'certi_url_font' => $this->input->post('certi_url_font'),
				'certi_id_size' => $this->input->post('certi_id_size'),
				'certi_id_top' => $this->input->post('certi_id_top'),
				'certi_id_left' => $this->input->post('certi_id_left'),
				'certi_id_color' => $this->input->post('certi_id_color'),
				'certi_id_font' => $this->input->post('certi_id_font'),
				'certi_class_size' => $this->input->post('certi_class_size'),
				'certi_class_top' => $this->input->post('certi_class_top'),
				'certi_class_left' => $this->input->post('certi_class_left'),
				'certi_class_color' => $this->input->post('certi_class_color'),
				'certi_class_font' => $this->input->post('certi_class_font'),
				'certi_class_align' => $this->input->post('certi_class_align'),
				'include_class' => $this->input->post('include_class') ?? '0',
				'certi_image' => $image_name
			];
			$this->common_obj->insertData('certificate_create_detail', $data);
			$this->session->set_flashdata('success', 'Certification Created successfully');
            redirect('admin/Certificate','refresh');
		}else{
			redirect('admin/Login');
		}
	}

	public function view($id){
		$data['data'] = $this->common_obj->getSingleRow('certificate_create_detail',['id' => $id], $cols = NULL, $orderby = NULL);
		if($data['data']->req_id){
				$data['data2'] = $this->common_obj->getRows('certficate_request', '*', ['id' => $data['data']->req_id], $returnArray = NULL, 'id desc'); 
			}
		$this->load->view('admin/certificate/view',$data);
	}	

	public function view2($id){
		$data['data'] = $this->common_obj->getSingleRow('certificate_create_detail',['id' => $id], $cols = NULL, $orderby = NULL);
		if($data['data']->req_id){
				$data['data2'] = $this->common_obj->getRows('certficate_request', '*', ['id' => $data['data']->req_id], $returnArray = NULL, 'id desc'); 
			}
		$this->load->view('admin/certificate/view2',$data);
	}	

	public function deleteCerty($id){
		$session = $this->session->userdata('admin_session');
		if(!empty($session)){
			$this->common_obj->deleteData('certificate_create_detail', ['id' => $id]);
			$this->session->set_flashdata('success', 'Certification deleted successfully');
            redirect('admin/Certificate','refresh');
		}else{
			redirect('admin/Login');
		}
	}

	public function cidGenerator($n){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $randomString = ''; 
	  
	    for ($i = 0; $i < $n; $i++) { 
	        $index = rand(0, strlen($characters) - 1); 
	        $randomString .= $characters[$index]; 
	    } 
	  	
	  	$check = $this->common_obj->countRows('certificate_create_detail', ['cid' => $randomString]);
	  	// die("fdsfsdf".$check);
	  	if($check > 0){
	  		$this->cidGenerator($n);
	  	}else{
	    	return $randomString;
	  	}
	}
}