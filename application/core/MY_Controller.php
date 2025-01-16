<?php

class MY_Controller extends CI_Controller{
	
	public $sessionData,$data;

	function __construct(){
		parent::__construct();
		$this->sessionData=new stdClass();
		if($this->session->userdata('LOGGED_USER')){
			$this->sessionData = $this->session->userdata('LOGGED_USER');
		}
		if($this->session->userdata('LOGGED_USER')){
			$this->sessionData = $this->session->userdata('LOGGED_USER');
		}
	}


	public function loginCheck($type=''){

		if(empty($this->session->userdata('LOGGED_USER')[0]['id'])){
		redirect('admin','refresh');
	    }
		//print_r($this->session->userdata('LOGGED_USER'));die();

		switch ($type) {
			case 'admin':
				if($this->session->userdata('LOGGED_USER')[0]['user_type'] != 1){redirect('admin','refresh');}
				break;

				case 'channel':
				if($this->session->userdata('LOGGED_USER')[0]['user_type'] != 2){redirect('admin','refresh');}
				break;

				case 'student':
				if($this->session->userdata('LOGGED_USER')[0]['user_type'] != 3){redirect('admin','refresh');}
				break;

			
			default:
				if(!$this->session->userdata('LOGGED_USER')){redirect('login','refresh');}
				break;
		}
	}



	public function authCheck(){
		$headers = apache_request_headers(); 
		$this->load->model('api/user','users');
		if(empty($headers['AUTH_KEY']) || empty($headers['USER'])){
			return false;
		}
		if($this->users->auth_check($headers['AUTH_KEY'],$headers['USER'])){
			return true;
		}
		else {
			return false;
		}
	}

	public function returnFailedResponse()
	{
		$result=array(
				'error'=>'3',
				'success'=>false,
				'msg'=>'Forbidden Access. Please provide valid AUTH_KEY and USER'
				);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($result);
	}

 

	function load_languages_api(){
			if($this->input->get_request_header('language') && $language=$this->common->get_language($this->input->get_request_header('language')) && $language->status==1){
				$this->lang->load('api/message',strtolower($language->name));
			} else {
				$this->lang->load('api/message','english');
			}
	}

	public function alertMessage($message,$type=''){
			switch ($type) {
				case 'success':
					$this->session->set_flashdata('response', '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.'</div>');
					break;
				case 'warning':
					$this->session->set_flashdata('response', '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.'</div>');
					break;
				case 'danger':
					$this->session->set_flashdata('response', '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.'</div>');
					break;
				default:
					$this->session->set_flashdata('response', '<div class="alert alert-info alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.'</div>');
					break;
			}
	}


public function showMessage($message,$type=''){
    $msg = '<div class="alert alert-'.$type.' alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.'</div>';
    return $msg;
}


	
	
	public function sendMail($to,$subject,$message,$from=FROM_EMAIL,$fromName=FROM_NAME,$debugger=FALSE)
	{ 
		$this->load->library('email');
		$email_config = array(
            'protocol'  => 'smtp',
            'smtp_host' => SMTP_HOST,
            'smtp_port' => SMTP_PORT,
            'smtp_user' => SMTP_USER,
            'smtp_pass' => SMTP_PASS,
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
        );
		$this->email->initialize($email_config);
		$this->load->library('email', $email_config);

		$this->email->from($from, $fromName);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->set_mailtype("html");
		if(!$this->email->send($to)){
		if($debugger){ echo $this->email->print_debugger(); }
			return false;
		}
		else{
			return true;
		}
	}



 
 




	
	

}