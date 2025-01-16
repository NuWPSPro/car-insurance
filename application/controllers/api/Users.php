<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


public function  __construct()
  {
        parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->model('Users_model','users_model');
		$this->load->model('professional_model');

		
		 header('Access-Control-Allow-Origin: *');
		// header('Content-type: application/json;');
		// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

		
  }




	 	function login()
	    {		
			header('Content-type: application/json; charset=utf-8');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true);

            $email_address = $jsonvalue['email'];
            $password = $jsonvalue['password']; 
            $user_info = $this->users_model->login($email_address, $password);
            $result = [];

		if($user_info){
				if($user_info['status']==0){
					$result = array('msg' => 'Account Not Active or Email Verification Pending. Please verify your email to activate your account.','success'=>'false','error' => '2',
					'service'=>BASE_URL.'services/user/login');
				}
				else
				{
					$users = $this->db->get_where('tbl_user',array('username_email'=>$email_address))->row_array();
					$num_row = $this->db->get_where('tbl_units',array('user_id'=>$users['id']))->result_array();
					if(count($num_row) < 1)
					{
						$result['success'] ='true';
						$result['screen'] ='1';
						$result['msg']    = 'Profile Not Complete.';
					}
					elseif(empty($users['country']) || empty($users['image']))
					{
						$result['success']='true';
						$result['screen']='2';
						$result['msg']= 'Profile Not Complete.';
					}
					elseif(empty($users['licence']))
					{
						$result['success']='true';
						$result['screen']='3';
						$result['msg']= 'Profile Not Complete.';
					}
					else
					{
						$checkactiveplanArr = $this->professional_model->checkactiveplan($users['id']);
						if($checkactiveplanArr->version_type == 1){
							$result['plan'] = 'Basic';
						}else{
							$result['plan'] = 'Pro';
						}
    					//$this->member->updateDevice($row->id,$device_id,$device_type);	
    					$result['success']='true';
    					$result['screen']='4';
    					$result['msg']= 'Successfully Login.';
					} 
	        
					// print_r($result);
    	        $result['data'] = $this->users_model->get_user_data_api($users['id']); 
    	        $result['error'] = 0;
            	}

            }
            else
            { 
            	$result = array('msg' => 'Invalid Login Credentials','success'=>'false','error' => '1');
            } 
                //print_r($result);
                // die("json_encode fail: " . json_last_error_msg());
                // $show_json = json_encode($result , JSON_FORCE_OBJECT);
                // if ( json_last_error_msg()=="Malformed UTF-8 characters, possibly incorrectly encoded" ) {
                //     $show_json = json_encode($API_array, JSON_PARTIAL_OUTPUT_ON_ERROR );
                // }
                // if ( $show_json !== false ) {
                //     echo($show_json);
                // } else {
                //     die("json_encode fail: " . json_last_error_msg());
                // }
                
            echo json_encode($result);
        }

function loginuser()
	    {		
			header('Content-type: application/json; charset=utf-8');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true);



			  $email_address = $jsonvalue['email'];
			  $password = $jsonvalue['password']; 
			  $user_info = $this->users_model->login($email_address, $password);



		if($user_info){
				if($user_info['status']==0){
					$result = array('msg' => 'Account Not Active or Email Verification Pending. Please verify your email to activate your account.','success'=>'false','error' => '2',
					'service'=>BASE_URL.'services/user/login');
				}
				else
				{
					$users=$this->db->get_where('tbl_user',array('username_email'=>$email_address))->row_array();
									
					$num_row=$this->db->get_where('tbl_units',array('user_id'=>$users['id']))->result_array();
					
					if(count($num_row) < 1)
					{
						/* $result['success']='true';
						$result['screen']='1';
						$result['msg']= 'Profile Not Complete.'; */
						
						$success ='true';
						$screen ='1';
						$msg = 'Profile Not Complete.';
					}
					elseif(empty($users['country']) || empty($users['address']) || empty($users['image']))
					{
						/* $result['success']='true';
						$result['screen']='2';
						$result['msg']= 'Profile Not Complete.'; */
						
						$success ='true';
						$screen ='2';
						$msg = 'Profile Not Complete.';
					}
					elseif(empty($users['licence']) || empty($users['licence_validity']) || empty($users['registering_body']))
					{
						/* $result['success']='true';
						$result['screen']='3';
						$result['msg']= 'Profile Not Complete.'; */
						$success ='true';
						$screen = '3';
						$msg = 'Profile Not Complete.';
					}
					else
					{
					//$this->member->updateDevice($row->id,$device_id,$device_type);	
					/* $result['success']='true';
					$result['screen']='4';
					$result['msg']= 'Successfully Login.'; */
					$success ='true';
					$screen ='4';
					$msg = 'Successfully Login.';
					} 

	        
	     /*   $result['data'] =$this->users_model->get_user_data_api($users['id']); 
	       $result['error']=0; */
		   $profiledatails  = $this->users_model->get_user_data_api($users['id']); 
		  //echo '<pre>'; print_r($profiledatails);
	       $error = 0;
	   }
		$result = array('msg' => $msg,'success'=>$success,'screen' => $screen,'error' => $error,'data' => $profiledatails);
}
else
{ 

	$result = array('msg' => 'Invalid Login Credentials','success'=>'false','error' => '1');
} 
//print_r($result);
echo json_encode($result);
}




function userDevice()
{		
	header('Content-type: application/json; charset=utf-8');
	$json_file=file_get_contents('php://input');
	$jsonvalue= json_decode($json_file,true);

	$member_id = $jsonvalue['member'];
	$device_type = $jsonvalue['device_type'];
	$device_id = $jsonvalue['device_id'];
	$this->member->updateDevice($member_id,$device_id,$device_type);	
	echo json_encode(array('success'=>'true','msg'=>'Device Details Updated Successfully','service'=>BASE_URL.'services/user/userDevice'));
}

   ######################## Working #######################

function logout()
{		
	header('Content-type: application/json; charset=utf-8');
	$json_file=file_get_contents('php://input');
	$jsonvalue= json_decode($json_file,true);

	$member_id = $jsonvalue['member'];
	$this->db->where('id',$member_id);
	$this->db->update('tbl_erg_users',array('device_type'=>'','device_id'=>''));
	echo json_encode(array('success'=>'true','msg'=>'Successfully Logout','service'=>BASE_URL.'services/user/logout'));
}

    ########################### Done ##########################






	public function profession()
	{ 
		$where = array('status'=>1);
		$this->db->order_by('cat_name','ASC');
	    $cat = $this->db->select()->order_by('cat_name', 'ASC')->get_where('tbl_category',array("status"=>1))->result_array();
    	echo json_encode(array('success'=>'true','msg'=>'Successfully data fetched','profession'=>$cat));
	}




	public function country()
	{ 
		$where = array('status'=>1,'display'=>'Yes');
	    $cat = $this->user->get_record_by_multi_field_name('countries',$where);  
    	echo json_encode(array('success'=>'true','msg'=>'Successfully data fetched','country'=>$cat));
	}

	public function all_country()
	{ 
		$where = array('status'=>1);
		$this->db->select("countries_id,countries_name");
		$this->db->order_by('countries_name', 'ASC');
	    $cat = $this->user->get_record_by_multi_field_name('countries',$where);  
    	echo json_encode(array('success'=>'true','msg'=>'Successfully data fetched','country'=>$cat));
	}


	public function userlists()
	{ 

		header('Content-type: application/json');	
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true);

		$where = array('role'=>$jsonvalue['user_type'],'status'=>1);
	    $cat = $this->user->get_record_by_multi_field_name('tbl_user',$where);  
    	echo json_encode(array('success'=>'true','msg'=>'Successfully data fetched','profession'=>$cat));
	}


public function register1() {
    header('Content-type: application/json');
    $json_file=file_get_contents('php://input');
	$jsonvalue= json_decode($json_file,true);
	$name 		= $jsonvalue['name'];
	$role       = $jsonvalue['role'];
	$profession = $jsonvalue['profession'];
	$email 		= $jsonvalue['email'];
	$password 	= $jsonvalue['password'];
	
	if($name=="" || $email=="" || $password=="") {  
        $result = array('msg' => 'Please provide required','success'=>'false','error' => '1');
	} else {
	    $data['name'] 			= $name;
		$data['profession']     = $profession;
		$data['username_email'] = $email; 
		$data['role']           = $role; 
		$data['password'] 		= md5($password);
		$data['status']    	    = 0; 
		$data['added_on']    	= date('y-m-d h:i:s'); 
		$data['activation_id']  = time().rand(9,9999); 
        
        $existingUser = $this->user->get_record_by_field_name_all_record('tbl_user','username_email',$email);
        
		if(!empty($existingUser)){
			echo json_encode(array('success'=>'false','msg'=>'Email id is Already registered with us.'));
		} else {
		    $lastid = $this->users_model->save('tbl_user',$data);
		    if($lastid) {
		        $tolower = strtolower($name);
    			$replace = str_replace(" ","-",$tolower);  
    			$datas['insititution_id'] = $replace.'-'.$lastid;
    			$this->users_model->update('tbl_user',$datas,'id',$lastid);
    			$data['link'] = site_url('users/activate/').$data['activation_id'];
    
    			if($data['role']==2){
    				$msg = "Successfully registered. You will be ogin once the admin will approve your registration request.";
    				echo json_encode(array('success'=>'true','msg'=>$msg));
    			} else {
    				$this->sendMail($data['username_email'],'Registration Verification',$this->load->view('email/member_approve',$data,true));
    				$msg = "You are now successfully registered.  A verification email has been sent to ".$data['username_email'];
    			}
    			echo json_encode(array('success'=>'true','msg'=>$msg));
		    } else {
		        $msg = "Failed to Add New User.";
				echo json_encode(array('success'=>'false','msg'=>$msg));
		    }
		    // echo $lastid;
		}
	}
}




	public function register123()
	{
 		header('Content-type: application/json');	
// 		$json_file=file_get_contents('php://input');
// 		$jsonvalue= json_decode($json_file,true);
//header('Content-type: application/json; charset=utf-8');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true);

		$name 		= $jsonvalue['name'];
		$role       = $jsonvalue['role'];
		$profession = $jsonvalue['profession'];
		$email 		= $jsonvalue['email'];
		$password 	= $jsonvalue['password'];
		 
 
		if($name=="" || $email=="" || $password=="")
		{  

			 $result = array('msg' => 'Please provide required','success'=>'false','error' => '1');

		} else { 


		 
 
		$data['name'] 			= $name;
		$data['profession']     = $profession;
		$data['username_email'] = $email; 
		$data['role']           = $role; 
		$data['password'] 		= md5($password);
		$data['status']    	    = 0; 
		$data['added_on']    	= date('y-m-d h:i:s'); 
		$data['activation_id']  = time().rand(9,9999); 

	 

		

			$existingUser = $this->user->get_record_by_field_name_all_record('tbl_user','username_email',$email);


			if(!empty($existingUser)){
				echo json_encode(array('success'=>'false','msg'=>'Email id is Already registered with us.'));
			} else {

			$lastid = $this->users_model->save('tbl_user',$data);


			if($lastid){

			//echo $this->input->post('name');
			$tolower = strtolower($name);
			$replace = str_replace(" ","-",$tolower);  
			$datas['insititution_id'] = $replace.'-'.$lastid;
			$this->users_model->update('tbl_user',$datas,'id',$lastid);
			$data['link'] = site_url('users/activate/').$data['activation_id'];

			if($data['role']==2){
				$msg = "Successfully registered. You will be ogin once the admin will approve your registration request.";
				echo json_encode(array('success'=>'true','msg'=>$msg));
			} else {
				$this->sendMail($data['username_email'],'Registration Verification',$this->load->view('email/member_approve',$data,true));
				$msg = "Successfully registered a verification email has been sent on ".$data['username_email'];
			}
			echo json_encode(array('success'=>'true','msg'=>$msg));
			}
			else{
				
				$msg = "Failed to Add New User.";
				echo json_encode(array('success'=>'false','msg'=>$msg));

			}	
		}
		}		
	}

public function profile_1()
{
 

	 header('Content-type: application/json');
	$json_file=file_get_contents('php://input');
	$jsonvalue= json_decode($json_file,true); 
	
	
 	$user_id     = $jsonvalue['user_id'];
	$total     = $jsonvalue['total'];
	$gernal = $jsonvalue['gernal']; 
	$specific     = $jsonvalue['specific']; 
	$to_date     = $jsonvalue['to_date']; 
	$from_date     = $jsonvalue['from_date']; 
	


	$data=array(
		'user_id'=>$user_id,
		'unit'=>$total,
		'gernal_target'=>$gernal,
		'specific_target'=>$specific,
		'to_date'=>$to_date,
		'from_date'=>$from_date
	);


 
		if($total !=($gernal+$specific ))
		{
			$result['success']='false';
			$result['error']="3";
			$result['msg']='Please Enter Less Then Total'; 
		}
		elseif($this->db->insert('tbl_units',$data))
		{
			$result['success']='true';
			$result['error']="1";
			$result['msg']='Data Saved'; 
		}
		else 
		{
			$result['success']='false';
			$result['error']="3";
			$result['msg']='Unable To Save Data';
			
		} 

		$result['data'] =$this->users_model->get_user_data_api($user_id);
		
	echo json_encode($result); 
}





public function profile_2()
{

	header('Content-type: application/json');
	if (isset($_FILES['image']['name']) || isset($_FILES['image']['name']) )
	{
		$json_file=$_REQUEST;
	} else {
		$json_file=file_get_contents('php://input');
	}
	$jsonvalue= json_decode($json_file,true);
	// $user_id     = $json_file['user_id'];
	// $nationality = $json_file['nationality'];
	$user_id     = $jsonvalue['user_id'];
	$nationality = $jsonvalue['nationality'];
	//$address     = $json_file['address']; 
 	

	$data=array(
		'country'=>$nationality,
		//'address'=>$address
	);



  if(isset($jsonvalue['image']) && !empty($jsonvalue['image'])){
	$config['upload_path'] = './assets/images/uploads/';
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size'] = '200000';
	$config['max_width']  = '15000';
	$config['max_height']  = '8000';        
	$ext = explode('.',$jsonvalue['image']);        
	$imageName = 'IMG_'.time().'.'.end($ext);
	$config['file_name'] = $imageName;
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	if ( ! $this->upload->do_upload('image'))
	{
		$error = array('error' => $this->upload->display_errors());                       
	}  
		$data['image'] = $imageName;
	}

	if($user_id !=''){
		$this->db->where('id',$user_id);
		$res = $this->db->update('tbl_user',$data);  
	}

		if($res != '')
		{
			$result['success']='true';
			$result['error']  ="1";
			$result['msg']    ='Data Update Successfully'; 
		}
		else {
			$result['success']='false';
			$result['error']="3";
			$result['msg']='Unable to Update Member Information';
			
		}
		
		$result['data'] =$this->users_model->get_user_data_api($user_id);
			

	echo json_encode($result);
}




public function profile_3()
{
 

	header('Content-type: application/json');
	$json_file=file_get_contents('php://input');
	$jsonvalue= json_decode($json_file,true);


	$user_id     = $jsonvalue['user_id'];
	$licence     = $jsonvalue['licence_no'];
	$licence_validity = $jsonvalue['validity']; 
	$registering_body     = $jsonvalue['registering_body'];
	$country     = $jsonvalue['country'];
	$issuing_institution     = $jsonvalue['issuing_institution'];
	$issuing_country     = $jsonvalue['issuing_country'];
	$issuing_state     = $jsonvalue['issuing_state'];
 	
    $country_name = $this->db->get_where('countries', array('countries_id'=>$issuing_country))->row_array()['countries_name'];

	$data=array(
		'licence'=>$licence,
		'licence_validity'=>$licence_validity,
// 		'registering_body'=>$registering_body,
// 		'issuing_institution'=>$issuing_institution,
		'issuing_country'=>$country_name,
		'state'=>$issuing_state
	);


 


		if($this->users_model->update('tbl_user',$data,'id',$user_id))
		{
			$result['success']='true';
			$result['error']="1";
			$result['msg']='Data Update Successfully'; 
		}
		else {
			$result['success']='false';
			$result['error']="3";
			$result['msg']='Unable to Update Member Information';
			
		}
		
			$result['data'] =$this->users_model->get_user_data_api($user_id);



	echo json_encode($result);
}

public function edit_traget()
{
	header('Content-type: application/json');
	$json_file=file_get_contents('php://input');
	$jsonvalue= json_decode($json_file,true);
	$user_id= $jsonvalue['user_id'];

$resultdata =$this->db->where('user_id',$user_id)->order_by('id','DESC')->get('tbl_units')->row_array();

$resultdata['to_date']=date('Y-m-d',strtotime($resultdata['to_date']));
$resultdata['from_date']=date('Y-m-d',strtotime($resultdata['from_date']));
		if($resultdata)
		{
			$result['success']='true';
			$result['data']=$resultdata;
			$result['error']="0";
			$result['msg']='Data found'; 
		} else {
			$result['success']='false';
			$result['error']="2";
			$result['msg']='Data Not found';
			
		}
		
			echo json_encode($result);	

}

	public function update_target(){
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		
		
	 	$id     	= $jsonvalue['id'];
		$total     	= $jsonvalue['total'];
		$gernal 	= $jsonvalue['gernal']; 
		$specific   = $jsonvalue['specific']; 
		$to_date    = $jsonvalue['to_date']; 
		$from_date  = $jsonvalue['from_date'];

		$data=array(
			
			'unit'=>$total,
			'gernal_target'=>$gernal,
			'specific_target'=>$specific,
			'to_date'=>$to_date,
			'from_date'=>$from_date
		);
 
		if($total !=($gernal+$specific ))
		{
			$result['success']='false';
			$result['error']="3";
			$result['msg']='Please Enter Less Then Total'; 
		}elseif($this->db->where('id',$id)->update('tbl_units',$data)){
			$result['success']='true';
			$result['error']="0";
			$result['msg']='Data Updated'; 
		}else{
			$result['success']='false';
			$result['error']="1";
			$result['msg']='Unable To Update Data';
		} 	
		echo json_encode($result); 
	}
			
	public function get_user_data(){
		header('Content-type: application/json');
		$json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true);
		$user_id = $jsonvalue['user_id'];

		$resultdata = $this->users_model->get_user_data_api($user_id);
		$notification = $this->db->get_where('tbl_notification',array('to'=>$user_id,'status'=>1))->row_array();
		if($resultdata){
			$result['success']='true';
			$result['notification'] = count($notification);
			$result['data']=$resultdata;
			$result['error']="1";
			$result['msg']='Data Update Successfully'; 
		}else{
			$result['success']='false';
			$result['error']="3";
			$result['msg']='Unable to Update Member Information';
		}
		echo json_encode($result);
	}

	public function forgotpassword()
	{
		header('Content-type: application/json');
		$json_file  = file_get_contents('php://input');
		$jsonvalue  = json_decode($json_file,true);
		$email 		= $jsonvalue['email'];

		$results 	= $this->db->get_where('tbl_user',array('username_email'=>$email))->row_array();
		$new_password 		  = rand(100,99999);
		$data['new_password'] = $new_password;
		$data['email'] 		  = $email;
		$data['name']	 	  =	$results['name'];
		
		if($results > 0 ){
			$update['password'] =  md5($new_password); 
		 	$res = $this->users_model->update('tbl_user',$update,'username_email',$email);
			$this->sendMail($email,'Forgot Password',$this->load->view('email/forget_password_api',$data,true));
			if($res){ 	
				$result['success']	=	true;
				$result['msg']		=	'New Password sent to your mail, Please check your mail.'; 
				
			} else {
				$result['success']	=	false;
				$result['msg']		=	'Invalid email. Please check your email.';
			}
		}
		echo json_encode($result);		
	}
		
	public function changepassword()
    {	
    	header('Content-type: application/json');
		$json_file  	= file_get_contents('php://input');
		$jsonvalue  	= json_decode($json_file,true);
		$email  		= $jsonvalue['email'];
		$confpassword 	= $jsonvalue['confpassword'];

		$res = $this->db->get_where('tbl_user',array('username_email'=>$email))->num_rows();

		if($res > 0 ){
			$update['password']  	= md5($confpassword);
			$final = $this->users_model->update('tbl_user',$update,'username_email',$email);
			if($final > 0 ){
				$result['success']	=	true;
				$result['msg']		=	'New Password Successfully Changed.'; 
			}else{
				$result['success']	=	false;
				$result['msg']		=	'Something went wrong. Please try again!';
			}
		}else{
			$result['success']	=	false;
			$result['msg']		=	'Invalid email. Please check your email!';
		}
		echo json_encode($result);	
    }	

     ########################### Done ##########################

 




	public function sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE){ 
		$from = EMAIL;
		$fromName = "MYCPD";
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
		    'Reply-To: '.$from."\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		 
		// Compose a simple HTML email message
		// Sending email
		/*$to = "deepak.1999.kumar@gmail.com";
		$subject = "Registration";
		$message = "Registration Successfully";  */  
 
		if(mail($to, $subject, $message, $headers)){ 
		    return true;
		} else{ 
		    return false;
		}

		//$this->load->library('email');
		/*$email_config = array(
            'protocol'  => 'smtp',
            'smtp_host' => SMTP_HOST,
            'smtp_port' => SMTP_PORT,
            'smtp_user' => SMTP_USER,
            'smtp_pass' => SMTP_PASS,
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
        );*/
		//$this->email->initialize($email_config);
	/*	$to = "deepak.1999.kumar@gmai.com";
		$this->load->library('email');

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
		}*/
	}

	public function set_new_target(){

		header('Content-type: application/json');
		$json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true); 
		
	 	$uid     	= $jsonvalue['user_id'];

		$create['user_id']     	 	= $uid;
		$create['unit']        	 	= $jsonvalue['units'];
		// $create['purpose']     		= $jsonvalue['purpose'];
		$create['added_on']    	 	= date('Y-m-d');
		$create['status']    	 	= 1;
		$create['gernal_target'] 	= $jsonvalue['gernal'];
		$create['specific_target']  = $jsonvalue['specific'];
		$create['to_date']      	= $jsonvalue['to_date'];
		$create['from_date']      	= $jsonvalue['from_date'];

		$created = $this->users_model->save('tbl_units',$create);   

		$datas['archive'] = 2;
		$this->users_model->update('tbl_existing_certificate',$datas,array('status'=>1,'user_id'=>$uid),'');

		if($created > 0){
			$result['success'] = true;
			$result['error'] = 1;
			$result['msg'] = 'Data Saved'; 
		}else{
			$result['success'] = false;
			$result['error']   = 0;
			$result['msg']     = 'Unable To Save Data';
			
		} 

	}

	


}
