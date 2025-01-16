<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professional extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->model('Users_model','users_model'); 
		$this->load->model('Professional_model');
		$this->load->model('dashboards_model'); 
		$this->load->model('provider_model'); 
		$this->load->model('advertise_model'); 
		$this->load->model('Share_model','share');
		$this->load->model('Car_insurance_model'); 
		$roll = $this->session->userdata('logged_in')['role'];
		if($roll != '1'){ redirect('users'); }
	} 

	// public function index()
	// {
	// 	$this->load->front('professional/professional');
	// }
	public function purchase_list(){
		$sess_id = $this->session->userdata('logged_in')['id'];
		if($sess_id == ''){ redirect('users'); }
		$data['details'] = $this->db->get_where('tbl_user',array('id'=>$sess_id))->row_array();
		$data['transaction'] = $this->db->order_by('id','desc')->get_where('tbl_payment_transaction',array('user_id'=>$sess_id))->result_array();
		
		$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Purchase List</h3></div>';
		$this->load->frontAdmin('carowner/purchase_list',$data);
	}


	public function get_insurance_details($insure_id)
	{
		// $insure_id = $this->input->post('id');
		$result = $this->provider_model->get_one_insurance($insure_id);
		$comp_email = $this->db->get_where('tbl_user',array('id'=>$result->company_id))->row()->username_email;
		$result->company_email = $comp_email;
		// echo $this->db->last_query();
		echo json_encode($result);
	}

	public function insurance_sent_success($insurance_no,$ref_id)
	{ 
		$update = array(
			'send_to_rt_by_owner' => 1,
			'ref_id_for_owner' => $ref_id,
			'updated_by_owner' => date('Y-m-d')
		); 
		$result = $this->user->update('tbl_existing_certificate',$update,'certificate_id',$insurance_no); 
		// echo $insurance_no.' '.$ref_id.' '.$this->db->last_query();
		if($result){
			echo 1;
		} else {
			echo 0;
		}
	}

	public function payNowForInsurance()
	{ 
		$insurance_no = $_POST['certificate_no'];
		$uid = $this->session->userdata('logged_in')['id'];
		$email = $this->session->userdata('logged_in')['username'];
		$name = $this->session->userdata('logged_in')['name'];
		$insurance_info = $this->db->get_where('tbl_existing_certificate',array('certificate_id'=>$insurance_no))->row();
		
		$insert['user_id'] 			= $uid;
		$insert['product_name'] 	= 'Send Insurance by car owner';
		$insert['product_name'] 	= 'Insurance number: '.$insurance_no;
		$insert['product_id'] 		= $insurance_info->id;
		$insert['product_type']  	= 'Send insurance by car owner';
		$insert['buyer_name']   	= $name;
		$insert['buyer_email']   	= $email;
		// $insert['txn_id']   		= 'txn_'.$insurance_info->id.date('ymdhis');
		$insert['tax']   			= 0;
		$insert['paid_amount']   	= 1;
		$insert['currency']   		= 'usd';
		// $insert['payment_status']	= 'succeeded';
		$insert['added_on']			= date('Y-m-d H:i:s');
		$insert['transaction_details']= json_encode($insert);

		$result = $this->user->save('tbl_payment_transaction',$insert); 
		$last_id = $result;
		// $this->payForSendInsuranceToRT($insert,$last_id);
		
		if($result){
			// $_SESSION['insurance_no']  = $insurance_no;
			$_SESSION['insur_id']  = $insurance_info->id;
			$_SESSION['last_id'] = $result;
			$re['success'] = 1;
			$re['last_id'] = $result;
			// echo 1;
		} else {
			$re['success'] = 0;
			// echo 0;
		}
		echo json_encode($re);
	}


	public function updateInsurancePayment(){
		// echo '<pre>'; print_r($_POST); die;
		$update['txn_id']   		= 'txn_'.$_SESSION['insurance_no'].date('ymdhis');
		$update['payment_status']	= 'succeeded';
		 
		$result = $this->user->update('tbl_payment_transaction',$update,'id',$_SESSION['last_id']); 
		redirect('professional/car_insurance?srti=true');
		// $this->session->set_flashdata('response', '<div class="alert alert-success">Payment done successfully.</div>');
	}

	public function cancelInsurancePayment(){
		$this->session->set_flashdata('response', '<div class="alert alert-danger">You have cancelled the payment.</div>');
		redirect('professional/index');
	}
	
	public function dashboard()
	{
		$sess_id = $this->session->userdata('logged_in')['id'];
		if($sess_id == ''){ redirect('users'); }
		$data['details'] = $this->db->get_where('tbl_user',array('id'=>$sess_id))->row_array();
		// echo '<pre>'; print_r($data['details']); die;
		$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Dashboard</h3></div>';
		$this->load->frontAdmin('carowner/dashboard',$data);
	}


	
	public function profile()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('f_name', 'f_Name', 'trim|required'); 
		$this->form_validation->set_rules('m_name', 'm_Name', 'trim|required'); 
		$this->form_validation->set_rules('l_name', 'l_Name', 'trim|required'); 
		$this->form_validation->set_rules('country_name', 'Country Name', 'trim|required'); 
 
		if($this->form_validation->run() == FALSE)
		// if($this->input->post() == FALSE)
		{
			$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
			// echo '<pre>'; print_r($data['details']); die;
			$data['country_list'] = $this->user->get_record_by_field_name_all_record('countries','status',1);
			$data['cat'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1); 
			$this->load->frontAdmin('carowner/profile',$data); 
		
		}  else {
			$data = array();
			if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
				{
					$error = array('error' => $this->upload->display_errors());                       
				}  
					$data['image'] = $imageName;
				}


			$data['fname']  = $this->input->post('f_name'); 
			$data['name']  = $this->input->post('m_name'); 
			$data['lname']   = $this->input->post('l_name'); 
			$data['country'] 	= $this->input->post('country_name'); 
			// $data['location'] 		= $this->input->post('location'); 
			// echo'<pre>';
			// print_r($this->input->post());
			// print_r($data);die; 
		    $result = $this->user->update('tbl_user',$data,'id',$uid); 
		    // echo $this->db->last_query();
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
				redirect('professional/profile');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/profile');
			} 
		}
	}


	public function insurance_for_sale()
	{
		$sess_id = $this->session->userdata('logged_in')['id'];
		if($sess_id == ''){ redirect('users'); }
		$data['insurance'] = $this->user->get_all_published_insurance_sale();
		$data['details'] = $this->db->get_where('tbl_user',array('id'=>$sess_id))->row_array();
		$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Insurance for sale</h3></div>';
		$this->load->frontAdmin('carowner/insurance_for_sale_listing',$data);
	}

	public function purchase_listing()
	{
		$sess_id = $this->session->userdata('logged_in')['id'];
		if($sess_id == ''){ redirect('users'); }
		$data['details'] = $this->db->get_where('tbl_user',array('id'=>$sess_id))->row_array();
		$data['buy_insurance'] = $this->Professional_model->get_all_buy_insurance($sess_id);

		$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Purchase Insurance Listing</h3></div>';
		$this->load->frontAdmin('carowner/purchase_listing',$data);
	}

	public function car_insurance()
	{
		$sess_id = $this->session->userdata('logged_in')['id'];
		if($sess_id == ''){ redirect('users'); }
		$data['details'] = $this->db->get_where('tbl_user',array('id'=>$sess_id))->row_array();
		$data['buy_insurance'] = $this->Professional_model->get_all_insurance_by_user($sess_id);

		$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Car Insurance Listing</h3></div>';
		$this->load->frontAdmin('carowner/insurance_listing',$data);
	}
	
	private function set_upload_options()
	{   
		//upload an image options
		$config = array();
		$config['upload_path'] = './assets/images/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|mp4|3gp';
		$config['max_size']      = 500000;
		$config['overwrite']     = FALSE;
		$config['file_name']     = 'IMG_'.time().'.jpg';
		return $config;
	}
	

	public function update_report()
	{ 
		$uid = $this->session->userdata('logged_in')['id'];
		$certificate_no = $this->input->post('id');
		$report = $this->input->post('report');
		$domain = $this->input->post('domain');
		$result = $this->professional_model->update_report($certificate_no,$report);
		$connected_rboard = $this->professional_model->getConnnectedRboard($uid);
		if($result && !empty($connected_rboard->filepath)){
			$get = $this->professional_model->existing_certificate($result);
			$from = '/home1/n6fbcdjk/public_html/assets/images/uploads/'.$get->certificate;
			$to   = $connected_rboard->filepath.$get->certificate;
			copy($from,$to);
		
			echo 'Done';
		}else{
			echo 'Not Done';
		}
	}

	public function users()
	{ 
		echo "working";
	}


	public function terms()
	{
		// $data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$data['terms']	= $this->dashboards_model->get_terms('professional');
		$this->load->frontAdmin('professional/terms',$data);
	}	


	public function old_notification()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		// $this->db->where('to',$uid);
		// $data['notification'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_notification','to',$uid);
		
		$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$this->load->frontAdmin('professional/notification',$data);
	}

 

	public function add_notification()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}

		if($this->form_validation->run() == FALSE)
		{
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$this->db->where('to',$uid);
		$data['notification'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_notification','status',1);
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  
		
		$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Notification</h3></div>';
		// $this->load->frontAdmin('car_company/pre_paid_package_listing',$data);
			$this->load->frontAdmin('carowner/notification',$data);
		}else{  
			$uid = $this->session->userdata('logged_in')['id'];

			$data['subject'] 		= $this->input->post('subject');  
			$data['message'] 		= $this->input->post('message');  
			$data['user_id'] 		= $uid;  
			$data['added_on'] 		= date('y-m-d h:i:s');
			
			$result = $this->user->save('tbl_notification',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Notification sent.</div>');
				redirect('professional/notification');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/notification');
			} 
		}
	}

	public function notification(){
		$urole  = $this->session->userdata('logged_in')['role'];
		$uid 	= $this->session->userdata('logged_in')['id'];
		// echo $urole.'**'.$uid;die;
		if($urole !=10){
			$this->db->where('to',$uid);
		}
		$data['inbox'] = $this->share->get_result_array('tbl_notification','status',1);
		if($urole !=10){
			$this->db->where('to',$uid);
		}
		$data['read'] = $this->share->get_result_array('tbl_notification','status',0);
		if($urole==1){
			$redirect = 'professional';
		}elseif($urole==2){
			// $redirect = 'provider';
			$redirect = 'car_company';
			// $data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
			$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Notification</h3></div>';
			
		}elseif($urole==3){
			$redirect = 'placement';
		}elseif($urole==4){
			$redirect = 'advertise';
		}elseif($urole==5){
			$redirect = 'institution';
		}elseif($urole==6){
			$redirect = 'author';
		}elseif($urole==7){
			$redirect = 'rboard';
			$data['userdata'] = $this->rboard->get_rboard_info($uid);
		}elseif($urole==10){
			$redirect = 'admin';
		}
	    $this->load->frontAdmin('carowner/notification',$data); 
	}

	public function delete_notification($id){
		$result = $this->share->delete('tbl_notification',$id);
		if($result==true){
			$this->session->set_flashdata('response','<div class="alert alert-success">Notification deleted successfully!</div>');
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong please try again!</div>');
		}
		redirect('professional/notification');	
	}

	public function showMessage(){
		$idd =  $this->input->post('idd');

	    $data['notification'] = $this->share->get_row_array_where('tbl_notification',array('id'=>$idd));
	  
		$this->db->where('id',$idd);
		$this->db->update('tbl_notification',array('status'=>0));
	    $this->load->view('carowner/notificationdata',$data); 
	}

	public function change_password()
	{

		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		// print_r($this->input->post()); die;
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('confpassword', 'Confirm Password','required|matches[password]');
		if($this->form_validation->run() == FALSE){  
			$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		    $data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Change Password</h3></div>';
			$this->load->front('carowner/change_password',$data); 
	}else{ 
		$old_pass = $this->input->post('oldpassword');
		$customer = $this->user->get_user_email('tbl_user',$uid,md5($old_pass));
		// echo $this->db->last_query();
		// echo '<pre>';	print_r($customer); exit;
		if(!empty($customer)){
				$id = $customer->id;
				$data2['password']  = md5($this->input->post('confpassword'));
               if($this->user->update('tbl_user',$data2,'id',$id)){
    	            $this->session->set_flashdata('response','<div class="alert alert-success">Your password has been changed. Please Log-in with new Password.<a/></div>');
    	            redirect('professional/change_password');  
	            }else{
    	            $this->session->set_flashdata('response','<div class="alert alert-danger">Problem updating password</div>');
    	            redirect('professional/change_password');
	            }
		
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Old Password does not match your existing password</div>');
			redirect('professional/change_password');  
		}
	  
	 }
	}
	

	
	public function settings()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('staff_code', 'Staff Code', 'trim|required'); 

			if($this->form_validation->run() == FALSE)
			{
		 		$data['prof_details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
				$this->db->order_by('name','ASC');
				$data['provider_list'] = $this->db->get_where('tbl_user', array('role'=>2,'under_insititution'=>1,'status'=>1))->result_array();
				$this->db->order_by('name','ASC');
				$data['institution_list'] = $this->db->get_where('tbl_user', array('role'=>5,'status'=>1))->result_array();
				$data['connected_rboard'] = $this->professional_model->getConnnectedRboard($uid);
				$this->load->frontAdmin('professional/settings',$data);

			}else{
				$uid = $this->session->userdata('logged_in')['id'];
				$uemail = $this->session->userdata('logged_in')['username'];
				$uprovider_id = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider'];
				
				// Staff coding........................
				if($this->input->post('save')=='Update'){
					$dbStaffCode = $this->db->get_where('tbl_institution_staff',array('email'=>$uemail))->row_array()['staff_code'];
					$staffEncoded = $this->input->post('staff_code');
					
					// echo $this->db->last_query(); print_r($dbStaffCode);die;
					if($staffEncoded == $dbStaffCode){
					$staffDecoded = base64_decode($staffEncoded);
					$staffCodeArr = explode('/',$staffDecoded);
					// echo '<pre>'; print_r($staffCodeArr); die;
						if(!empty($staffCodeArr) && $staffCodeArr[0] == 'SC'){
							$update['insititution_id']   = $staffCodeArr[2]; /* under INS code */
							$update['under_insititution'] = 1;
							$update['under_provider']   = $staffCodeArr[3]; /* under CEP code */

							$status['status'] = '1'; //1 means connected with provider
							$status['prof_id'] = $uid; 
							$results = $this->user->update('tbl_institution_staff',$status,'email',$uemail);
							
						}else{
							$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Wrong CE Staff Code!</div>');
						}
					}else{
						$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">ERROR: Please check your Staff Code again!</div>');
					}
				}
	
				$result = $this->user->update('tbl_user',$update,'id',$uid);

				if($result){
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Settings successfully updated.</div>');
				}
				redirect('professional/settings');
				
			}
	                  
	}
		 

	
	public function enquiry()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('type', 'Type', 'trim|required'); 
		// $this->form_validation->set_rules('first_name', 'First Name', 'trim|required'); 
		// $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required'); 
		// $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'); 
		// $this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{

			$this->load->frontAdmin('professional/enquiry');
			
		
		}  else { 

			$enquirydata = array(
				'etype' 		=> $this->input->post('type'),
				'email' 		=> $this->input->post('email'),
				'first_name' 	=> $this->input->post('first_name'),
				'subject' 		=> $this->input->post('type'),
				'message' 		=> $this->input->post('message')
			);	
			
		    $result = $this->user->save('tbl_enquiry',$enquirydata); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Thank you for your message.</div>');
				redirect('professional/enquiry');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/enquiry');
			} 
		}
	}


   public function tutorials()
	{
		// $data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$data['professionals'] 	= $this->professional_model->get_tutorial('professional');
		
		$data['tutorials'] 		= $this->professional_model->get_tutorial();
		$this->load->frontAdmin('professional/tutorials',$data);
	}
	public function getTutorialVideo()
	{
		$id = $_POST['id'];
		$this->db->where('id',$id);
		$result = $this->db->get('tbl_tutorial')->row_array();
		echo (json_encode($result));
	}
		public function addTutorialVideo()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$urole = $this->session->userdata('logged_in')['role'];
		$this->load->library('upload');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');  
		$this->form_validation->set_rules('discription', 'Description', 'trim|required');  
			 
		if($this->form_validation->run() == FALSE){
			$data['professionals'] 	= $this->professional_model->get_tutorial('professional');
			
			$data['tutorials'] 		= $this->professional_model->get_tutorial();
			$this->load->frontAdmin('professional/tutorials',$data);
		}else{
			$add = array(
				'title'			=>  $this->input->post('title'),
				'discription'	=>  $this->input->post('discription'),
				'added_by'		=>  $uid,
				'added_by_role'	=>  $urole,
				'status'		=>  1,
				'added_on'		=>  date('Y-m-d')
			);

			if(isset($_FILES["uploadvideo"]) && !empty($_FILES["uploadvideo"]['name']))
			{
	            $config2['upload_path'] = './assets/upload/tutorial/';
	            $config2['allowed_types'] = 'avi|mp4|3gp|mpeg|mpg|mov|mp3|flv|wmv';
	            $config2['max_size'] = '200000000';
	            $config2['max_width']  = '15000';
	            $config2['max_height']  = '8000';        
	            $ext = explode('.',$_FILES["uploadvideo"]["name"]);        
	            $imageName = 'Tut_'.time().'.'.end($ext);
	            $config2['file_name'] = $imageName;
		        $this->upload->initialize($config2);
		        if ( ! $this->upload->do_upload('uploadvideo'))
		        {
		        	$error = array('error' => $this->upload->display_errors());                       
		        }  
	            	$add['uploadvideo'] = $imageName;
	        }

			$result = $this->user->save('tbl_tutorial',$add);
			if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Video Added successfully.</div>');
				redirect('professional/addTutorialVideo');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/addTutorialVideo');
			}
		}
		
	}
	
		public function editTutorialVideo()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$urole = $this->session->userdata('logged_in')['role'];
		$this->load->library('upload');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');  
		$this->form_validation->set_rules('discription', 'Description', 'trim|required');  
			 
		if($this->form_validation->run() == FALSE){
			$data['professionals'] 	= $this->dashboards_model->get_tutorial('professional');
			
			$data['tutorials'] 		= $this->dashboards_model->get_tutorial();
			$this->load->frontAdmin('professional/tutorials',$data);
		}else{
			$id = $this->input->post('id');
			$update = array(
				'title'			=>  $this->input->post('title'),
				'discription'	=>  $this->input->post('discription'),
				
			);

			if(isset($_FILES["uploadvideo"]) && !empty($_FILES["uploadvideo"]['name']))
			{
	            $config2['upload_path'] = './assets/upload/tutorial/';
	            $config2['allowed_types'] = 'avi|mp4|3gp|mpeg|mpg|mov|mp3|flv|wmv';
	            $config2['max_size'] = '200000000';
	            $config2['max_width']  = '15000';
	            $config2['max_height']  = '8000';        
	            $ext = explode('.',$_FILES["uploadvideo"]["name"]);        
	            $imageName = 'Tut_'.time().'.'.end($ext);
	            $config2['file_name'] = $imageName;
		        $this->upload->initialize($config2);
		        if ( ! $this->upload->do_upload('uploadvideo'))
		        {
		        	$error = array('error' => $this->upload->display_errors());                       
		        }  
	            	$update['uploadvideo'] = $imageName;
	        }

			$result = $this->user->update('tbl_tutorial',$update,'id',$id);
			if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Video Updated successfully.</div>');
				redirect('professional/tutorials');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/tutorials');
			}
		}
		
	}
	
	public function tutorialdelete($id){

		$result = $this->user->delete('tbl_tutorial','id',$id);
		if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Tutorial Deleted successfully.</div>');
				redirect('professional/tutorials');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/tutorials');
			}
	}

	
	public function detail($uid)
	{
		$data['uid'] = $uid;
		$data['profuserdata'] = $this->db->get_where('tbl_professionals',array('user_id'=>$uid))->row_array();
		$data['og_description'] =  'Ceopoint professional - '.$data['profuserdata']['name'];
		$data['og_title'] 		=  'Ceopoint professional - '.$data['profuserdata']['name'];
		$data['og_image'] 		=  base_url('assets/images/uploads/'.$data['profuserdata']['profile_photo']);
		$data['og_url'] 		=  base_url('professional/detail/'.$data['profuserdata']['user_id']);
		$data['og_type'] 		=  'Professional';
		$this->load->frontAdmin('professional/detail',$data);
	}



	public function training_list($cat_id= false)
	{   
		if($cat_id==""){
	    	$data1 = $this->session->userdata('logged_in');
	    	$profession = $data1['profession'];
	    	$categoryid   = $this->db->get_where('tbl_category',array('cat_name'=>$profession))->row_array();
	    	$cat = $categoryid['id'];
	    } else {
	    	$cat = $cat_id;
	    }

	  	if($cat_id==""){
			$data['latesttraining'] = $this->professional_model->get_latest_training_with_category('');
		    $data['featured'] = $this->professional_model->get_featured_training_with_category('');
			$data['freetraining'] = $this->professional_model->get_free_training_with_category(''); 
		} else {
			$data['latesttraining'] = $this->professional_model->get_latest_training_with_category('');
		    $data['featured'] = $this->professional_model->get_featured_training_with_category($cat);
			$data['freetraining'] = $this->professional_model->get_free_training_with_category($cat); 
			// echo $this->db->last_query();die;
	  	}
	  	$data['category'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);

		$this->load->frontAdmin('professional/training_list',$data);
	}


  public function course_list($cat_id=false)
	{ 
	    if($cat_id==""){
	    	$data1 = $this->session->userdata('logged_in');
	    	$profession = $data1['profession'];
	    	$courseId   = $this->db->get_where('tbl_category',array('cat_name'=>$profession))->row_array();
	    	$cat = $courseId['id'];
	    } else {
	    	$cat = $cat_id;
	    }

	  	if($cat_id==""){
			$data['latestcourse'] = $this->professional_model->get_latest_course_with_category('');
		    $data['featured'] = $this->professional_model->get_featured_course_with_category('');
			$data['freecourse'] = $this->professional_model->get_free_course_with_category(''); 
		} else {
			$data['latestcourse'] = $this->professional_model->get_latest_course_with_category('');
		    $data['featured'] = $this->professional_model->get_featured_course_with_category($cat);
			$data['freecourse'] = $this->professional_model->get_free_course_with_category($cat); 
	  	}
		    $data['category'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);

		$this->load->frontAdmin('professional/course_list',$data);
	}

	public function course_history()
	{ 
		$sess_id = $this->session->userdata('logged_in')['id'];
		$this->db->select('	e.added_on added_on,
							co.id cid,
							co.price amount,
							co.course_title course_name,
							co.passing_marks,
							e.certificate_id certificate_id,
							e.data,
							e.percentages,
							co.units units');
		$this->db->from('tbl_exam e');
		$this->db->join('tbl_course co','co.id = e.course_id');
		$this->db->where('e.user_id',$sess_id);
		// $this->db->where('e.archive','1');
		$this->db->group_by('e.certificate_id');
		$this->db->order_by('e.id','desc');
		$data['purchase_list'] = $this->db->get()->result_array();


		$this->db->select('	tb.added_on added_on,
							tb.training_seminar_id tid,
							tb.amount amount,
							t.title course_name,
							tb.certificate_id certificate_id,
							t.units units');
		$this->db->from('tbl_training_book tb');
		$this->db->join('tbl_training t','t.id = tb.training_seminar_id');
		$this->db->where('tb.user_id',$sess_id);
		$this->db->group_by('tb.certificate_id');
		$this->db->order_by('tb.id','desc');
		$data['training_list'] = $this->db->get()->result_array();
		

		
		$this->load->frontAdmin('professional/course_history',$data);
	}
	

  public function training_list1($c_id=false)
	{
	    if($c_id==""){
		    	$data1 = $this->session->userdata('logged_in');
		    	$profession = $data1['profession'];
		    	$courseId   = $this->db->get_where('tbl_category',array('cat_name'=>$profession))->row_array();
		    	$cid = $courseId['id'];
		    } else {
		    	$cid = $c_id;
		    }

	    if($c_id==""){
		    $data['featured'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','paid_status',2);
		    $data['topist'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','paid_status',3);
		    $data['premium'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','paid_status',4);
		}else{
	   		$data['course_list_data'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','course_category',$cid);
	   }

	    $data['category'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
		$this->load->frontAdmin('professional/training_list',$data);
	}

	

	public function purchase_list_old()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$urole = $this->session->userdata('logged_in')['role'];
		$this->db->where('archive','0');
		$data['purchase_list'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_purchase_llis','user_id',$uid);
		
		$this->db->where('txn_id !=','');
		$data['training_list'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training_book','user_id',$uid);
		
		$data['practise_promotion'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_promoted_provider_transaction',array('user_id'=>$uid,'role'=>$urole),"");
		
		$data['currentplanArr'] = $this->professional_model->checkactiveplan($uid);
		$data['advertise'] = $this->advertise_model->getAdvertiseAddsList($uid,$urole);
		$data['planpaymenthistoryArr'] = $this->professional_model->planpaymenthistory($uid,$data['currentplanArr']->payment_recieved_id);
			$this->db->select('pppph.*,ppp.*'); 
			$this->db->from('professional_pce_plan_payment_history pppph');
			$this->db->join('professional_pce_plan ppp','pppph.user_id = ppp.user_id');
			// $this->db->where('pppph.pppph_id =',$data['currentplanArr']->payment_recieved_id);
			$this->db->where('pppph.user_id',$uid);
			$this->db->where('ppp.payment_status','y');
			$this->db->order_by('pppph.pppph_id','desc');
			$query = $this->db->get();
		$data['planpaymenthistory'] = $query->row_object();		
		// echo '<pre>';print_r($data);die;
		$this->load->frontAdmin('professional/purchase_list',$data);
	}

	public function advertise_list()
	{
		if($this->session->userdata('logged_in')['id']==''){
			redirect('users');
		}else{
			$uid 	= $this->session->userdata('logged_in')['id'];
			$urole  = $this->session->userdata('logged_in')['role'];
			$data['advertise'] = $this->advertise_model->getAdvertiseAddsList($uid,$urole);
			// echo $this->db->last_query();
			$this->load->frontAdmin('professional/advertise_list',$data);
		}
	}

	public function subscription()
	{
		
		if($this->session->userdata('logged_in')['id'] == ''){
			redirect('users');
		}else{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['advertisepackages'] = $this->user->subscriptionslisting(array('subs_status'=>'1'));
			$this->load->frontAdmin('professional/subscription',$data);
		}
	}
	public function subscriptionpayment()
	{
		
		if($this->session->userdata('logged_in')['id'] == ''){
			redirect('users');
		}else{
			//print_r($_REQUEST);
			//print_r($_SESSION);
			//exit;
			$data['user_id']            = $this->session->userdata('logged_in')['id'];
			$data['subs_id']          = $_REQUEST['item_number'];
			//$data['quantity']           = $_REQUEST['quantity'];
			$data['paypal_trangaction_id']             = $_REQUEST['txn_id'];
			$data['paypal_trangaction_status']         = $_REQUEST['payment_status'];
			$data['sub_status']             = '1';
			$data['added_at']           = date('y-m-d h:i:s');
			$data['subscription_amount']             = $_REQUEST['payment_gross'];
			if($_REQUEST['payment_status'] == 'Pending'){
				$this->session->set_flashdata('subscriptionmsg', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Your payment pending.</div>');
					redirect('professional/subscription');	
			}else{
				$result = $this->user->save('tbl_user_subscription_buy',$data);
				if($result){
					$this->session->set_flashdata('subscriptionmsg', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Your payment successfully.</div>');
					redirect('professional/subscription');	
				}
			}	
		}
	}
	
	public function uplodadadvertise()
	{
		if($this->session->userdata('logged_in')['id'] == ''){
			redirect('users');
		}else{
			$uid = $this->session->userdata('logged_in')['id'];
			if($_POST){
				$adv_image = '';
				if(isset($_FILES["adv_image"]) && !empty($_FILES["adv_image"]['name'])){
				$config['upload_path'] = './assets/images/advertise/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '200000';
				$config['max_width']  = '2500';
				$config['max_height']  = '1800';         
				$ext = explode('.',$_FILES["adv_image"]["name"]);        
				$adv_image = 'IMG_'.time().'.'.end($ext);
				$config['file_name'] = $adv_image;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('adv_image'))
				{
					
				$error = array('error' => $this->upload->display_errors()); 
				//print_r($error); exit;
				$this->session->set_flashdata('imgupladerr', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
				redirect('professional/advertise');	
				}  
				$adv_image = $adv_image;
				}else{
					$adv_image = $this->input->post('adv_image_old');
				}
				$advddata = array(
					'user_id' 					=> $this->session->userdata('logged_in')['id'],
					'adv_title' 				=> $this->input->post('adv_title'),
					//'adv_pck_id' 				=> $this->input->post('adv_pck_id'),
					//'adv_url' 					=> $this->input->post('adv_url'),
					'adv_image'  				=> $adv_image,
					'adv_end_to'    			=> '',
					//'adv_display_postion'    	=> $this->input->post(''),
					'adv_status'     			=> '1',
					'added_at'     				=> date('Y-m-d H:i:s'),
				);
				if($this->input->post('advlist_id') > 0){
					$this->users_model->update('advertise_listing',$advddata,'advlist_id',$this->input->post('advlist_id'));
					$advlistid = $this->input->post('advlist_id');
				}else{
					$advlistid = $this->users_model->save('advertise_listing',$advddata);
				}
				$this->session->set_flashdata('dispmsg', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Successfully uploaded.</div>');
				redirect('professional/advertise');
				
			}
			$data['advlist_id'] = $this->uri->segment(3);
			if($this->uri->segment(3) >0){
			$data['editadv'] = $this->user->memberadvertiselisting(array('advlist_id'=>$this->uri->segment(3),'user_id'=>$uid));
			}else{
				$data['editadv'][0] = array('advlist_id'=>'','adv_image'=>'','adv_title'=>'');
			}
			$this->load->frontAdmin('professional/uplodadadvertise',$data);
		}
	}


public function delete_online_certificate($idd){
		$this->users_model->delete('tbl_purchase_llis', 'id',$idd);	
		  $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record Deleted successfully.</div>');
                redirect('professional/dashboard');
}

public function ecertificate_delete($idd){
		$this->users_model->delete('tbl_existing_certificate', 'id',$idd);	
		  $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record Deleted successfully.</div>');
                redirect('professional/dashboard');
}



public function ecertificate_delete_training($idd){
		$this->users_model->delete('tbl_training', 'id',$idd);	
		  $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record Deleted successfully.</div>');
                redirect('professional/dashboard');
}



public function ecertificate_delete_card($idd){
		$this->users_model->delete('tbl_card', 'id',$idd);	
		  $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record Deleted successfully.</div>');
                redirect('professional/dashboard');
}






	public function changecategory()
	{
		$form_type   =  $this->input->post('form_type'); 
		$form_id     =  $this->input->post('form_id'); 
		$categoryid  =  $this->input->post('categoryid'); 
	

		if($form_type == 1){
			if($categoryid == 1){
				$data['category'] 	=  'specific';
				
			}else{
				$data['category'] 	= 'general';
				
			}
			// $data['category'] 	= $categoryid;  
			$result = $this->user->update('tbl_existing_certificate',$data,'id',$form_id); 
		}
				
		if($form_type==2){
			$data['category_id'] 	= $categoryid;  
			$result = $this->user->update('tbl_exam',$data,'id',$form_id); 
			// echo $this->db->last_query();
		}

		if($form_type==3){
			$data['category_id'] 	= $categoryid;  
			$result = $this->user->update('tbl_training_book',$data,'id',$form_id); 
		}

		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record has been updated successfully.</div>');
		redirect('professional/dashboard');


		echo '<pre>';
		print_r($_REQUEST);
		die;
	}


  	public function savecard()
	{

        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
        // $this->form_validation->set_rules('card_no', 'Card No', 'required'); 
        $this->form_validation->set_rules('card_name', 'Card Name', 'required'); 
        $this->form_validation->set_rules('issued_date', 'Issued Date', 'required');  
        $this->form_validation->set_rules('expiry_date', 'Expiry Date', 'required');  
        $this->form_validation->set_rules('issue_by', 'Issue By Date', 'required');  

        if (empty($_FILES['photos']['name'])){
         $this->form_validation->set_rules('photos', 'Photo', 'trim|required');
        }

        if($this->form_validation->run() == FALSE)
        {  
        
        $data['purchase_list'] = $this->user->get_record_by_field_name_all_record('tbl_purchase_llis','user_id',$this->session->userdata('logged_in')['id']);

		$data['previous_certificate'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate','user_id',$this->session->userdata('logged_in')['id']);
		
		$this->load->frontAdmin('professional/completencycard',$data);


        } else { 
 

            if(isset($_FILES["photos"]) && !empty($_FILES["photos"]['name'])){
            $config['upload_path'] = './assets/images/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docs';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["photos"]["name"]);        
            $imageName = 'CARD_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('photos'))
            {
            $error = array('error' => $this->upload->display_errors());         
            echo '<pre>';
            print_r($error);
            die;              
            }  
            $data['photo'] = $imageName;
            }

	        $data['user_id']         = $this->session->userdata('logged_in')['id']; 
	        $data['card_no']         = $this->input->post('card_no'); 
	        $data['card_name']       = $this->input->post('card_name'); 
	        $data['date_issued']     = $this->input->post('issued_date'); 
	        $data['expiry_date']     = $this->input->post('expiry_date');  
	        $data['issue_by']     	 = $this->input->post('issue_by');  
	        $data['status']          = 1; 
	        $data['added_on']        = date('Y-m-d h:i:s');  


       		$result = $this->users_model->save('tbl_card',$data); 


            if($result){

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">1 Card added successfully to your list.</div>');

                  redirect('professional/completencycard');


            } else {

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');

                 redirect('professional/completencycard');

            }
            
        }
	}




  public function existing()
	{


        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
        $this->form_validation->set_rules('course_name', 'Course Name', 'required'); 
        $this->form_validation->set_rules('course_unit', 'Course Units', 'required'); 
        $this->form_validation->set_rules('course_start_date', 'Course Starts Date', 'required');  

        if (empty($_FILES['certificate']['name'])){
         $this->form_validation->set_rules('certificate', 'Certificate', 'trim|required');
        }

        if($this->form_validation->run() == FALSE)
        {  
            $data['purchase_list'] = $this->user->get_record_by_field_name_all_record('tbl_purchase_llis','user_id',$this->session->userdata('logged_in')['id']);

		$data['previous_certificate'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate','user_id',$this->session->userdata('logged_in')['id']);
		
		$this->load->frontAdmin('professional/dashboard',$data);


        } else { 


            if(isset($_FILES["certificate"]) && !empty($_FILES["certificate"]['name'])){
            $config['upload_path'] = './assets/images/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docs';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["certificate"]["name"]);        
            $imageName = 'CERTIFICATE_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('certificate'))
            {
            	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
				redirect('professional/dashboard',$data);              
            }  
            	$data['certificate'] = $imageName;
            }

	        $data['certificate_id']    = $this->input->post('certi_no'); 
	        $data['course_name']       = $this->input->post('course_name'); 
	        $data['units']             = $this->input->post('course_unit'); 
	        $data['start_date']        = $this->input->post('course_start_date'); 
	        $data['end_date']          = $this->input->post('course_end_date'); 
	        $data['category']          = $this->input->post('category'); 
	        $data['issue_from']        = $this->input->post('issue_from'); 
	        $data['issue_by']          = $this->input->post('issue_by'); 
	        $data['status']            = 1; 
  			$data['archive'] 		   = 1;
	        $data['added_on']          = date('Y-m-d h:i:s'); 
	        $data['user_id']           = $this->session->userdata('logged_in')['id'];

       		$result = $this->users_model->save('tbl_existing_certificate',$data); 


            if($result){

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">1 Certificate added successfully to your lists.</div>');

                if($_REQUEST['certi_popup']==1){


                	$exploded_data = explode('?', $_SERVER['HTTP_REFERER']);
 

                	if(empty($exploded_data[1])){
					 $url= $_SERVER['HTTP_REFERER'].'?p=3';
                	} else {
					 $url= $_SERVER['HTTP_REFERER'].'&p=3';
                	}
			
					redirect($url);

                } else {
                   redirect('professional/dashboard');
                }


            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');

                if($_REQUEST['certi_popup']==1){
					$url= $_SERVER['HTTP_REFERER'];
					redirect($url);
                } else {
                   redirect('professional/dashboard');
                }

            }
            
        }
	}


	public function new_notification(){
		$urole  = $this->session->userdata('logged_in')['role'];
		$uid 	= $this->session->userdata('logged_in')['id'];
		// echo $urole.'**'.$uid;die;
		if($urole !=10){
			$this->db->where('to',$uid);
		}
		$data['inbox'] = $this->share->get_result_array('tbl_notification','status',1);
		if($urole !=10){
			$this->db->where('to',$uid);
		}
		$data['read'] = $this->share->get_result_array('tbl_notification','status',0);
		if($urole==1){
			$redirect = 'professional';
		}elseif($urole==2){
			// $redirect = 'provider';
			$redirect = 'car_company';
			// $data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
			$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Notification</h3></div>';
			
		}elseif($urole==3){
			$redirect = 'placement';
		}elseif($urole==4){
			$redirect = 'advertise';
		}elseif($urole==5){
			$redirect = 'institution';
		}elseif($urole==6){
			$redirect = 'author';
		}elseif($urole==7){
			$redirect = 'rboard';
			$data['userdata'] = $this->rboard->get_rboard_info($uid);
		}elseif($urole==10){
			$redirect = 'admin';
		}
	    $this->load->frontAdmin(''.$redirect.'/notification',$data); 
	}




public function showBill(){
	$uid 	= $this->session->userdata('logged_in')['id'];
	$urole  = $this->session->userdata('logged_in')['role'];
	   	
	$idd =  $this->input->post('idd');
	$type =  $this->input->post('type');
	
		if($type=='Advertise'){
	    	$this->db->where('tbl_adv_package_purchased.id',$idd);
	    	$dataArray = $this->advertise_model->getAdvertiseAddsList($uid,$urole);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['user_id']))->row_array();
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = round($json->payment_gross);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);
			// $returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= $dataArray[0]['title'];
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['address'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;

	   	}elseif($type=='Promotion'){
			$this->db->where('ppt.id',$idd);
			$dataArray = $this->user->get_active_promoted_provider($uid);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['user_id']))->row_array();
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = round($json->payment_gross);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= $json->item_name;
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['address'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;

	   	}elseif($type=='Course'){
			$dataArray = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_purchase_llis','id',$idd);
			// echo'<pre>';print_r($dataArray[0]);die;
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['user_id']))->row_array();
			$course_name = $this->db->get_where('tbl_course',array('id'=>$dataArray[0]['item_name']))->row_array()['course_title'];
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = round($dataArray[0]['amount']);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray[0]['added_on']));
			$returnarray['course_title'] 	= $course_name;
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['address'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $dataArray[0]['txn_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;

	   	}elseif($type=='Training'){
			$dataArray = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training_book','id',$idd);
			// echo'<pre>';print_r($dataArray[0]);die;
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['user_id']))->row_array();
			$training_name = $this->db->get_where('tbl_training',array('id'=>$dataArray[0]['training_seminar_id']))->row_array()['title'];
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = round($json->payment_gross);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= $training_name;
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['address'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;

		}else{ //Training Publish
			$this->db->where('tpub.id',$idd);
			$dataArray = $this->provider_model->get_training_publish($uid);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['user_id']))->row_array();
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = round($json->payment_gross);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= $dataArray[0]['title'];
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['address'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
	   	}
	$this->load->view('professional/receipt',$data);
}



public function old_showMessage(){
	   $idd =  $this->input->post('idd');
	   $data['notification'] = $this->user->get_record_by_field_name_all_record('tbl_notification','id',$idd);
	  
		$this->db->where('id',$idd);
		$this->db->update('tbl_notification',array('status'=>0));
	   $this->load->view('professional/notificationdata',$data);
}



public function updateunit(){
	 
	// $promotedata['user_id']     = $this->session->userdata('logged_in')['id'];
	// $promotedata['unit']        = $_REQUEST['units'];
	// $promotedata['purpose']     = $_REQUEST['purpose'];
	// $promotedata['added_on']    = date('Y-m-d');
	// $promotedata['status']      = 1;
	
	$promotedata['user_id']     	 = $this->session->userdata('logged_in')['id'];
	$promotedata['unit']        	 = $_REQUEST['units'];
	$promotedata['purpose']     	 = $_REQUEST['purpose'];
	$promotedata['added_on']    	 = date('Y-m-d');
	$promotedata['status']    	 	 = 1;
	$promotedata['gernal_target']    = $_REQUEST['gernal_target'];
	$promotedata['specific_target']  = $_REQUEST['specific_target'];
	$promotedata['to_date']      	 = $_REQUEST['to_date'];
	$promotedata['from_date']      	 = $_REQUEST['from_date'];

	$proinserted = $this->users_model->save('tbl_units',$promotedata);   

	$datas['archive'] = 2;
	$uid = $this->session->userdata('logged_in')['id'];
	$this->users_model->update('tbl_existing_certificate',$datas,array('status'=>1,'user_id'=>$uid),'');

	if($proinserted){
		$updalogin['logged_in'] = 2;
		$this->users_model->update('tbl_user',$updalogin,array('status'=>1,'id'=>$uid),'');
	}


	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">You target has been successfully Added.</div>');

	redirect('professional/dashboard?id=success');

}


public function updateunits(){
	// $promotedata['user_id']     	 = $this->session->userdata('logged_in')['id'];
	$promotedata['unit']        	 = $_REQUEST['units'];
	$promotedata['purpose']     	 = $_REQUEST['purpose'];
	$promotedata['added_on']    	 = date('Y-m-d');
	$promotedata['status']    	 	 = 1;
	$promotedata['gernal_target']    = $_REQUEST['gernal_target'];
	$promotedata['specific_target']  = $_REQUEST['specific_target'];
	$promotedata['to_date']      	 = $_REQUEST['to_date'];
	$promotedata['from_date']      	 = $_REQUEST['from_date'];
	

	$this->db->where('id',$_REQUEST['editid']);
	$proinserted = $this->db->update('tbl_units',$promotedata);   





	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Required CE Units/Contact Hours Updated successfully.</div>');

	redirect('professional/dashboard');

}


	public function staffcerecords()
	{
		$this->load->frontAdmin('professional/staffcerecords'); 
	}




	public function registerstaff()
	{ 
		$uid = $this->session->userdata('logged_in')['id']; 
		$profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		
			$data = array(
				'staff_name'        => $this->input->post('name'), 
				'email' 			=> $this->input->post('email'), 
				'staff_code' 		=> $this->input->post('code'), 
				'insititution_id'   => $profile[0]['id'],  
				'insititution_code' => $profile[0]['insititution_id'],  
				'status'     		=> 1,
				'added_on'     		=> date('Y-m-d')
			); 

			$result = $this->user->save('tbl_institution_staff',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Overview created successfully.</div>');
				redirect('professional/staffcerecords');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/staffcerecords');
			}
}





	public function updatestaff()
	{ 


			$uid = $this->session->userdata('logged_in')['id']; 
			$profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			 
	 
			$datas['staff_name']          = $this->input->post('name');   
			
			$result = $this->users_model->update('tbl_institution_staff',$datas,'id',$this->input->post('staff_id11'));
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('provider/staffcerecords');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/staffcerecords');
			}
}


public function exam_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->db->order_by('id','desc');
		$this->db->where('id',$uid);
		$data['exam_list'] = $this->db->get('tbl_exam')->result_array();
		$this->load->frontAdmin('professional/exam_list',$data);
	}

public function add_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		
		 $data['advertise'] = $this->advertiseads->getAdvertiseAddsList($uid);
             	
		$this->load->frontAdmin('professional/advertise',$data);
		
	}
	
	public function advertisement()
	{
		$where1 = array('role'=>5,'status'=>1);
		$subinstitution1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
		$data['totalSubInstitute'] = sprintf("%02d", count($subinstitution1));

		
		$where4 = array('role'=>1,'status'=>1);
		$professionallist = $this->user->get_record_by_multi_field_name('tbl_user',$where4);
		$data['totalProfessional'] = sprintf("%02d", count($professionallist));
		
		$this->db->group_by('country'); 
		$countryllist =  $this->db->get_where('tbl_user',array('status'=>1,'country !='=> 0))->result_array();
		$data['totalCountries'] = sprintf("%02d", count($countryllist));
		
		$where = array('');
		$viewerlist = $this->user->get_record_by_multi_field_name('tbl_viewer_counter',$where);
		$data['totalViewers'] = sprintf("%02d", array_sum(array_column($viewerlist, 'count')));
		
		
		$uid = $this->session->userdata('logged_in')['id'];
		  $data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',1);    	
		$this->load->frontAdmin('professional/add_advertise',$data);
	}	


	public function sendtoinstitution($idd)
	{
		    $data['send_to_institution'] 	= 1;  
			 
		    $result = $this->user->update('tbl_existing_certificate',$data,'id',$idd); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate has been sent to Institution successfully.</div>');
				redirect('professional/dashboard');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/dashboard');
			} 
	}

	public function get_one_certificate(){
		$id = $this->input->post('id');
		$result = $this->professional_model->existing_certificate($id);
		echo json_encode($result);
		// echo $this->db->last_query();
	}
	

	public function completencycard(){
		if($this->session->userdata('logged_in')['id'] == ''){
					redirect('users');
		}else{
		    $this->load->frontAdmin('professional/completency_card');
		}
	}


	public function download_image ($file_path = "") {
		// load ci download helder
		$this->load->helper('download'); 
		// get download file path and store it in $data array
		$data['download_file'] = $file_path;    
		// load view file    
		$this->load->view("professional/download_view",$data);
		redirect(current_url(), "refresh");                       
	}

	public function promotepractise()
    {
        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
        $this->form_validation->set_rules('dailyprice', 'daily price', 'trim|required');
        $this->form_validation->set_rules('day', 'day', 'trim|required'); 
        if($this->form_validation->run() == FALSE)
        { 
            $this->load->view('professional/dashboard');

        }else{
            $dailyprice 	= $this->input->post('dailyprice');
            $day    		= $this->input->post('day');
            $idrole     	= $this->input->post('idrole');
            $uname      	= $this->input->post('uname');
		   	$totalamunt 	= $dailyprice * $day; 
          
            if($totalamunt){  ?>

			<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
				<input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="item_name" id="item_name" value="<?php echo $uname.' - Practice Promotion';?>">
				<input type="hidden" name="item_number" value="<?php echo $day;?>">
				<input type="hidden" name="credits" value="510">
				<input type="hidden" name="user_id" value="<?php echo $idrole;?>">
				<input type="hidden" name="custom" value="<?php echo $idrole;?>">
				<input type="hidden" name="amount" id="amount" value="<?php echo $totalamunt;?>">
				<input type="hidden" name="tax" value="0">
				<input type='hidden' name='rm' value='2'>
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="handling" value="0">
				<input type="hidden" name="cancel_return" value="<?php echo site_url('professional/promote_practise_fail'); ?>">
				<input type="hidden" name="return" value="<?php echo site_url('professional/promote_practise_success'); ?>">
			</form>

			<script type="text/javascript">	
		     document.getElementById("frmPayPal1").submit();
			</script>
			<?php die; ?>
			
            <?php  

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promoted successfully.</div>');
                redirect('professional/dashboard');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                 redirect('professional/dashboard');

            }
      }
}

	public function promote_practise_success(){
		// print_r($_REQUEST);die;
		// $idd = explode('_', $_REQUEST['item_name']);	
		// $day = trim($idd[1]);		
		$day 			= $_REQUEST['item_number'];		
		$idrole	 		= explode('_', $_REQUEST['custom']);	
		$uid 			= trim($idrole[0]);		
		$role 			= trim($idrole[1]);		
		$base_price 	= trim($idrole[2]);		
		$tax_amount 	= trim($idrole[3]);		
		// $userid = $this->session->userdata('logged_in')['id'];
		// $userrole = $this->session->userdata('logged_in')['role'];
		$promotedData = array(
			'user_id' 			=> $uid,
			'role' 				=> $role,
			'tax' 				=> $tax_amount,
			'base_price' 		=> $base_price,
			'promoted_date' 	=> date('Y-m-d'),
			'promoted_day' 		=> $_REQUEST['item_number'],
			'promoted_amount' 	=> $_REQUEST['payment_gross'],
			'transaction_details'=> json_encode($_REQUEST),
		);
		$result = $this->user->save('tbl_promoted_provider_transaction',$promotedData);
		// echo'<pre>'.$this->db->last_query();die;
		
		$featuredData['featured_from'] = date('Y-m-d');
		$featuredData['featured_to']   = date('Y-m-d',strtotime(date('Y-m-d') . '+ '.$day.'days'));
		
		$this->user->update('tbl_user',$featuredData,'id',$uid);
		if($result){
			$this->session->set_flashdata('response', '<h4>Your Profession in now listed as fetured at the Professional\'s Page.</h4>');
			 redirect('professional/purchase_list?id=done');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			 redirect('professional/dashboard');
		}
	}

	public function promote_practise_fail(){
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
        redirect('professional/dashboard');
	}

	public function promotion_list()
	{
		$userid = $this->session->userdata('logged_in')['id'];
		// $data['purchase_list'] 	= $this->user->get_active_promotion($uid);
		$data['promotion_practise'] = $this->professional_model->get_promotion_practise($userid);
		// print_r($data['promotion_practise']);die;
		$this->load->frontAdmin('professional/promotion_list',$data);
	}

	public function cestaff()
	{
		$userid = $this->session->userdata('logged_in')['id'];
		$uemail = $this->session->userdata('logged_in')['username'];
		if($this->input->post()){
			// echo 'Working';
			$staff_code = $this->input->post('staff_code');
			$if = $this->db->get_where('tbl_institution_staff',array('email'=>$uemail))->row_array();
			if($if['staff_code']==$staff_code){
			$update = array( 'status'=>1 );
			$this->user->update('tbl_institution_staff',$update,'id',$if['id']);
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Wait for Provider to Accept Your Request.</div>');
			}else{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Wrong Staff Code!!</div>');
			}
		}
		$this->load->frontAdmin('professional/cestaff',$data);
	}

	public function license_renewal_record()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['license']  = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		$this->load->frontAdmin('professional/license_renewal_record',$data);
	}

	public function paypal_payment_subscription(){
		$post = $this->input->post();
		$existingplandetails = $this->user->getusetdetails('professional_pce_plan','user_id',$post['user_id']);
		$userexpiryDate = $existingplandetails->plan_expiry_at;

		$propla_id = $post['item_number'];
		$plan_details = $this->share->get_pcemsplan_details($propla_id);
		$planid = $plan_details->plan_id;
		$duration = $plan_details->pro_plan_type;
		$expirydate = date('Y-m-d', strtotime("+".$duration." months", strtotime($userexpiryDate)));
		
			$requestupdate = array(
				'user_id' 				=> $post['user_id'],
				'tax' 					=> $post['tax'],
				'base_price' 			=> $post['base_price'],
				'payment_amount' 		=> $post['amount'],
				'pce_plan_name' 		=> $post['item_name'].'('.$duration.' month/s)',
				'pce_plan_id' 			=> $planid,
				'payment_at' 			=> date("Y-m-d H:i:s"),
				'plan_active_date' 		=> date("Y-m-d"),
				'plan_expiry_date' 		=> date("Y-m-d",strtotime($expirydate)),
			);
			$result = $this->user->save('professional_pce_plan_payment_history',$requestupdate);
			if($result){
				echo '<p style="text-align:center;top:30px;">Please wait payment in process</p>';

				echo '<form action="'.PAYAPAL_URL.'" method="post" target="_top" id="paypalform"> 	
						<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
						<input type="hidden" name="cmd" value="_xclick">
						<input type="hidden" name="item_name" value="PCE-MS Subscription for '.$post['item_name'].'">
						<input type="hidden" name="item_number" value="'.$result.'">
						<input type="hidden" name="credits" value="510">
						<input type="hidden" name="custom" value="'.$post['user_id'].'">
						<input type="hidden" name="amount" id="amount" value="'.$post['amount'].'">
						<input type="hidden" name="tax" value="0">
						<input type="hidden" name="rm" value="2">
						<input type="hidden" name="no_shipping" value="1">
						<input type="hidden" name="currency_code" value="USD">
						<input type="hidden" name="handling" value="0">
						<input type="hidden" name="cancel_return" value="'.site_url("professional/plancancel/").'">
						<input type="hidden" name="return" value="'.site_url('professional/plansuccess/').$post['user_id'].'">
						';
				echo '<script> document.getElementById("paypalform").submit(); </script>';
				exit;
			}else{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Something went wrong!</div>');
				redirect('professional/plan_subscription/'.$post['user_id'].'');
			}
	}	

	public function plansuccess(){	
		// echo '<pre>'; print_r($_REQUEST); die();
		$uemail = $this->db->get_where('tbl_user',array('id'=>$_REQUEST['custom']))->row_array()['username'];

		if($_REQUEST){
			$requestupdate = array(
				'payer_email' 			=> $_REQUEST['payer_email'],
				'payer_id' 				=> $_REQUEST['payer_id'],
				'payer_status' 			=> $_REQUEST['payer_status'],
				'first_name' 			=> $_REQUEST['first_name'],
				'last_name' 			=> $_REQUEST['last_name'],
				'payment_transtion_id' 	=> $_REQUEST['txn_id'],
				'mc_gross' 				=> $_REQUEST['mc_gross'],
				'payment_status' 		=> $_REQUEST['payment_status'],
				'payment_date' 			=> $_REQUEST['payment_date'],
				'verify_sign' 			=> $_REQUEST['verify_sign'],
			);
			// $result = $this->user->save('professional_pce_plan_payment_history',$requestupdate);
			$result = $this->user->update('professional_pce_plan_payment_history',$requestupdate,'pppph_id',$_REQUEST['item_number']);
			// echo $this->db->last_query(); echo $result; die;
			// $lastpaymentid = $this->db->insert_id();
			$pcehistory = $this->db->get_where('professional_pce_plan_payment_history',array('pppph_id'=>$_REQUEST['item_number']))->row();
			if($result){
				$upateplan = array(
				'version_type' 			=> $pcehistory->pce_plan_id,
				'plan_duration' 		=> $pcehistory->pce_plan_name,
				'payment_status' 		=> 'y',
				'plan_active_at' 		=> date('Y-m-d'),
				'plan_expiry_at' 		=> $pcehistory->plan_expiry_date,
				'payment_recieved_id' 	=> $_REQUEST['item_number'],
				'payment_recieved_at' 	=> date('Y-m-d')
				);
				$this->user->update('professional_pce_plan',$upateplan,'user_id',$_REQUEST['custom']);
				// echo $this->db->last_query();die;

			}
				
			$subject = "PCE-MC Plan Purchased.";
			$message .= "<br/><br/> Thank you, <br/> Team CEonpoint";

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('team@ceonpoint.com');
			$this->email->to($uemail);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->set_mailtype("html");	
			if($this->email->send())
			{ 
				//echo 'Sent'; 
				// echo "<center><strong>MAil  successfully.</strong></center>";
			}
			else
			{
				//echo'Not-Sent'; 
			// show_error($this->email->print_debugger());
			}
			
			$this->session->unset_userdata('logged_in');
			session_destroy();
			
			$row = $this->user->get_user_record('tbl_user','id',$_REQUEST['custom']);
			
			$sess_array = array(
				'id' 		=> $row->id,
				'username' 	=> $row->username_email,
				'name' 		=> $row->name,  
				'role' 		=> $row->role,  
				'profession'=> $row->profession,  
				'location' 	=> $row->location,  
				'address' 	=> $row->address,
				'country' 	=> $row->country,
				'insititution_id' 	=> $row->insititution_id,
				'under_insititution'=> $row->under_insititution,
				'logged_in'=> $row->logged_in
			);
			$this->session->set_userdata('logged_in', $sess_array);
			// print_r($this->session->userdata());die;		
			
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Your plan has been successfully updated.</div>');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		}
		$sess_id = $this->session->userdata('logged_in')['id'];	
		$data['currentplanArr'] 		= $this->professional_model->checkactiveplan($sess_id);
		$data['planpaymenthistoryArr'] 	= $this->professional_model->planpaymenthistory($sess_id,$data['currentplanArr']->payment_recieved_id);		
		$this->load->frontAdmin('professional/plan_subscription',$data);
	}


 	public function plancancel()
	{
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		redirect('professional/dashboard');
	}
	
	public function plan_subscription()
	{ 
		// echo '<pre>'; print_r($this->session);
		
		$sess_id = $this->session->userdata('logged_in')['id'];	
		$data['currentplanArr'] 		= $this->professional_model->checkactiveplan($sess_id);
		$data['planpaymenthistoryArr'] 	= $this->professional_model->planpaymenthistory($sess_id,$data['currentplanArr']->payment_recieved_id);		
		$this->load->frontAdmin('professional/plan_subscription',$data);
	}
	
	public function connectToRboard()
	{ 
		$uid = $this->session->userdata('logged_in')['id'];	
		$urole = $this->session->userdata('logged_in')['role'];	
		if($uid == ''){ redirect('users'); }
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger" style="color:red;">', '</p>');
		// $this->form_validation->set_rules('rboard_code', 'RBoard code', 'trim|required'); 
		
		if($this->form_validation->run() == FALSE)
		{
			$data['details'] = $this->user->get_user_record('tbl_user','id',$uid);	
			$this->db->where('role',7);
			$data['rboard_list']      = $this->user->get_record_by_field_name_all_record('tbl_user','status',1);	
			$data['connected_rboard'] = $this->professional_model->getConnnectedRboard($uid);
			$data['currentplanArr']   = $this->professional_model->checkactiveplan($uid);
			$this->load->frontAdmin('professional/connect_to_rboard',$data);
		} else{ 
			$rboard_id = $this->input->post('rboard_id');
			// $rboard_code = $this->input->post('rboard_code');
			// $domain = $this->input->post('domain');
			
			// $where = array('user_id'=>$rboard_id,'rb_code'=>$rboard_code);
			$where = array('user_id'=>$rboard_id);
			$match = $this->professional_model->matchRboardCode($where);
			// echo $this->db->last_query();die;
			if($match != ''){
				$where2 = array('user_id'=>$uid,'rboard_id'=>$rboard_id,'rboard_code'=>$match->rb_code);
				$already = $this->professional_model->alreadyConnnected($where2);
				if($already == ''){
					$save = array(
						'user_id'	=>$uid,
						'role'   	=>$urole,
						'rboard_id'	=>$rboard_id,
						'rboard_code'=>$match->rb_code,
						'status'	=>'1',
						'added_on'	=>date('Y-m-d H:i:s')
					);
					$result = $this->professional_model->saveUserRboardConnect($save);
					if($result){
						$this->session->set_flashdata('response', '<div class="alert alert-success">You are now connected With RBoard.</div>');
					}
				}else{
					$this->session->set_flashdata('response', '<div class="alert alert-danger alert-dismissable">You are already connected to one RBoard.</div>');
				}
			}else{
				$this->session->set_flashdata('response', '<div class="alert alert-danger alert-dismissable">Wrong RBoard code.</div>');
			}
			redirect('professional/connectToRboard');
		}
	}



} ?>