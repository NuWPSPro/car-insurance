<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testpayment extends CI_Controller {

	
	public function  __construct()
	{
	        parent::__construct();
			$this->load->library('session');
			$uid = $this->session->userdata('logged_in')['id'];
			if($uid==""){
				redirect('users');
			}  
	}
	public function testpay(){
		
		$data['userid'] = $this->session->userdata('logged_in')['id'];
		$this->load->frontAdmin('advertise/testpay',$data); 
		
	}
	public function success(){
		echo $this->session->userdata('logged_in')['id'];
		print_r($this->session->userdata);
		 echo'<pre>';print_r($_REQUEST);
		 exit;
	}


	
	
}
