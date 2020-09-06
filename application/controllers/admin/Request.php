<?php 

class Request extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->library('session');
	}

	function index() {
		$session = $this->session->userdata('admin_session');
		if(!empty($session)){
			$data['view'] = 'admin/request/index';
			$data['data']  = $this->common_obj->getRows('certficate_request', '*', $where=null, $returnArray = NULL, $orderby = 'id desc');
			$this->load->view('admin/layouts/template',$data);
		}else{
			redirect('admin/Login');
		}
	}

	function changeStatus(){
		$session = $this->session->userdata('admin_session');
		if(!empty($session)){
			// print_r($_POST);
			$id = $this->input->post('c_id');
			$status = $this->input->post('status');
			$where = ['id' => $id];
			$this->common_obj->updateData('certficate_request', $where, ['status' => $status]);
			$this->session->set_flashdata('success', 'Status changed successfully');
			redirect('admin/Request/index');
		}else{
			redirect('admin/Login');
		}
	}

	function view($id){
		$session = $this->session->userdata('admin_session');
		if(!empty($session)){
			$where= ['req_id' => $id];
			$data['data'] = $this->common_obj->getSingleRow('certficate_request', $where, '*', $orderby = NULL);
			// $data['view'] = 'admin/request/view';
			$this->load->view('admin/request/view',$data);
		}else{
			redirect('admin/Login');
		}
	}

	function processCreate(){
		// print_r($_POST);
		$session = $this->session->userdata('admin_session');
		if(!empty($session)){
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
				'req_id' => $this->input->post('req_id')
			];
			$this->common_obj->insertData('certificate_create_detail', $data);
			$this->session->set_flashdata('success', 'Certification Created successfully');
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