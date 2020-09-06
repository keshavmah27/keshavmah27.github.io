
<?php 
class CertificateCreate extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->library('session');
	}


	function index()
	{
		$session = $this->session->userdata('admin_session');
		if(!empty($session)){
			$data['view'] = 'admin/process/index';
			$this->load->view('admin/layouts/template',$data);
		}else{
			redirect('admin/Login');
		}
	}

	function processRequest(){
		$req_id = $this->input->post('req_id');
		// get req details
		$getReqData = $this->common_obj->getRows('certficate_request', '*',['req_id' => $req_id], $returnArray = NULL, $orderby = 'id desc');
		// print_r($getReqData);
		if(isset($getReqData))
		{	
			$reqest_id = $getReqData[0]->id;
			$file = 'uploads/sheets/'.$getReqData[0]->sheet;
			$getCertyData = $this->common_obj->getRows('certificate_create_detail', '*',['req_id' => $reqest_id], $returnArray = NULL, $orderby = 'id desc');
			$certiDetailId = $getCertyData[0]->id;
			$file = fopen($file, 'r');
			while(! feof($file))
			  {
			  	$data = fgetcsv($file);
			  	if(!empty($data[0]) && !empty($data[1])){
				  	$details = [
				  		'certi_detail_id' =>$certiDetailId ,
				  		'certi_id' => $this->cidGenerator(10),
				  		'name' => $data[0],
				  		'email' => $data[1],
				  		'class' => $data[2]
				  	];
				  	// print_r($details);
				  	$this->common_obj->insertData('certificates', $details);
			  	}
			  }
			fclose($file);
			$this->session->set_flashdata('success', 'Request Process successfully!');
			redirect('admin/CertificateCreate','refresh');

		}else{
			$this->session->set_flashdata('error', 'Request Id Not found!');
			redirect('admin/CertificateCreate','refresh');
		}
		die();
	}


	public function cidGenerator($n){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $randomString = ''; 
	  
	    for ($i = 0; $i < $n; $i++) { 
	        $index = rand(0, strlen($characters) - 1); 
	        $randomString .= $characters[$index]; 
	    } 
	  	
	  	$check = $this->common_obj->countRows('certificates', ['certi_id' => $randomString]);
	  	// die("fdsfsdf".$check);
	  	if($check > 0){
	  		$this->cidGenerator($n);
	  	}else{
	    	return $randomString;
	  	}
	}
}


?>