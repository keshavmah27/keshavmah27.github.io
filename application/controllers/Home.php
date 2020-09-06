<?php

class Home extends CI_Controller {

	public function index(){
		$data['view'] = 'home/index';
		$this->load->view('layouts/template',$data);
	}


}

?>