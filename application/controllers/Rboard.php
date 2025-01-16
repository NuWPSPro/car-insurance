<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rboard extends CI_Controller {

	public function  __construct(){
		parent::__construct();
		
		$this->load->model('provider_model');  
		$this->load->model('dashboards_model');  
		$this->load->model('Rboard_model','rboard');  
		$this->load->model('Users_model','users_model'); 
	}

	public function index(){
		$uid = $this->session->userdata('logged_in')['id'];
		$data['faq_rb_list'] 	= $this->user->get_record_by_multi_field_name('tbl_faq',array('role'=>'4','status'=>'1'));
		$data['rboards'] 		= $this->share->get_rboard();
		$this->db->distinct('tp.country_id'); 
		$data['countries'] 	 	= $this->share->get_professionals();
		// $data['countries'] 	= $this->user->get_countries();
		$data['professionals'] 	= $this->share->get_professionals();
		$data['regulatoryboard']= $this->dashboards_model->get_regulatoryboard();
		$data['regtutorials'] 	= $this->dashboards_model->get_tutorial('regulatoryBoard');
		//echo (count($data['regulatoryboard']));exit;
	    $this->load->view('rboard/rbplateform', $data);
	}

	public function get_insurance(){
		// $uid = $this->session->userdata('logged_in')['id'];
		// if($uid == ""){ redirect('users'); }
		$id 	= $this->input->post('id');
		$email 	= $this->input->post('email');
		$result = $this->provider_model->get_one_insurance($id);
		echo json_encode($result);
	}

	public function get_course(){
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		$cid = $this->input->post('cid');
		$email = $this->input->post('email');
		$result = $this->provider_model->get_one_course($cid,$email);
		 echo json_encode($result);
	 }

	public function get_training(){
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		$tid = $this->input->post('tid');
		$email = $this->session->userdata('logged_in')['username'];
		$uemail = array('user_email'=>$email);
		$result = $this->provider_model->get_row_array('tbl_training',array('id'=>$tid));
		$data = array_merge($result,$uemail);
		 echo json_encode($data);
	 }

	public function fill_rboard_details(){
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		$uid = $this->session->userdata('logged_in')['id'];
		$role = $this->session->userdata('logged_in')['role'];
		$res = $this->rboard->check_user($uid,$role);

		if($res > 0){
			$this->session->set_flashdata('message','You can not add more than one Regularity board.');
		}else{
			$post = $this->input->post();
			if($post['id']==''){
				$result = $this->rboard->save_rboard($post);
			}else{
				$result = $this->rboard->update_rboard($post);
			}

			if(count($result) > 0){
			$this->session->set_flashdata('message','You are successfully connected with Regularity board.');
			}else{
			$this->session->set_flashdata('message','Something went wrong, please try again!.');
			}
			redirect('provider/settings','refresh');
		}
	 }

	public function get_course_pdf(){
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		$cid = $this->input->post('cid');
		$uid = $this->input->post('uid');
		$data['details'] = $this->rboard->get_course($cid,$uid);
		// echo json_encode($cousre);
		// echo $this->db->last_query();
		$this->load->view('provider/course_pdf',$data);
	}
	
	public function dashboard(){
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		//$uid = $this->session->userdata('logged_in')['id'];
		// $data['userdata'] = $this->rboard->get_rboard_info($uid);
		$data = '';
		$this->load->front('rboard/dashboard',$data);
	}
	
	public function subscription_package(){
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		//$uid = $this->session->userdata('logged_in')['id'];
		$data['package_list'] = $this->rboard->subscription_package();
		$data['details'] = $this->rboard->get_rboard_subscription_details($uid);
		$this->load->front('rboard/subscription_package_listing',$data);
	}

	public function subscription_payment(){
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		//$uid = $this->session->userdata('logged_in')['id'];
		//print_r($_POST); exit;
		if($_POST['name'] != "" && $_POST['rbsp_id'] > 0 && $_POST['charge'] > 0){
			$paymentdetails = array();
			$paymentdetails['product_name'] = $_POST['name'];
			$paymentdetails['paid_amount'] 	= $_POST['charge'];
			$paymentdetails['product_id'] 	= $_POST['rbsp_id'];
			$paymentdetails['product_type'] = 'RBoard Subscription';
			$paymentdetails['user_id'] 		= $uid;
			$paymentdetails['currency'] 	= 'usd';
			$paymentdetails['payment_type'] = $_POST['subs_type'];
			$lastpayment_id 				= $this->rboard->insertpayment($paymentdetails);

			if($_POST['subs_type']=='n'){
				$item_name = $_POST['name'];
			}
			if($_POST['subs_type']=='r'){
				$item_name = 'Renewal of '.$_POST['name'];
			}
		echo '<p style="text-align:center;top:30px;">Please wait payment in process</p>';
				echo '<form action="'.PAYAPAL_URL.'" method="post" target="_top" id="paypalform"> 
					
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
				<input type="hidden" name="item_name_1" value="'.$item_name.'">
				<input type="hidden" name="item_number_1" value="'.$lastpayment_id.'">
				<input type="hidden" name="amount_1" id="amount_1"  value="'.$_POST['charge'].'">
				<input type="hidden" name="quantity_1" value="1"> 
				<input type="hidden" name="custom" value="">
				<input type="hidden" name="return" value="'.base_url('rboard/payment_sucess').'">
				<input type="hidden" name="cbt" value="Return to The Store">
				<input type="hidden" name="cancel_return" value="'.base_url('rboard/payment_cancel').'">
				<input type="hidden" name="lc" value="US">
				<input type="hidden" value="2" name="rm"> 	
				<input type="hidden" name="currency_code" value="USD">
				<!--<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">-->
				
				'.form_close();	
				//echo '<script> $("#paypalform").submit(); </script>';
				echo '<script> document.getElementById("paypalform").submit(); </script>';
		}else{
			redirect('rboard/subscription_package','refresh');
		}		
	}

	public function payment_sucess()
	{
		
		$payment_id = $this->rboard->updatpayment($_POST);
		if($payment_id > 0){
			$userid = $this->rboard->get_userid($payment_id);
			//echo $userid->user_id;
			// login section 
			
			$result = $this->users_model->login_for_id($userid->user_id);
			$row =	$result;
			if($result['logged_in']==0){
				$datas1['logged_in'] = 1;
			} else {
				//$datas1['logged_in'] = 2;
				$datas1['logged_in'] = $row['logged_in']+1;
			}
			
			$datas1['logged_in_status'] = 1;
			$this->users_model->update('tbl_user',$datas1,'id',$row['id']);
			$sess_array = array(
				'id' 		=> $row['id'],
				'username' 	=> $row['username_email'],
				'name' 		=> $row['name'],  
				'role' 		=> $row['role'],  
				'profession'=> $row['profession'],  
				'location' 	=> $row['location'],  
				'address' 	=> $row['address'],
				'country' 	=> $row['country'],
				'domain' 	=> $row['website'],
				'filepath' 	=> $row['registering_body'],
				'insititution_id' 	=> $row['insititution_id'],
				'under_insititution'=> $row['under_insititution'],
				'logged_in'=> $row['logged_in']
				);

			$this->session->set_userdata('logged_in', $sess_array);
			//end login
			if($userid->payment_type == 'n' ){
				$subscriptionkey = md5($userid->user_id.$userid->product_id.$this->session->userdata('logged_in')['name'].$this->session->userdata('logged_in')['username_email']);
				$rbcode = md5($userid->user_id.$this->session->userdata('logged_in')['name'].$this->session->userdata('logged_in')['username_email']);
				$insert = array();
				$insert['subscription_id'] 	= $userid->product_id;
				$insert['user_id'] 			= $userid->user_id;
				$insert['templete_id'] 		= '1';
				$insert['rb_name']  		= $this->session->userdata('logged_in')['name'];
				$insert['domain']  			= $this->session->userdata('logged_in')['domain'];
				$insert['filepath']  		= $this->session->userdata('logged_in')['filepath'];
				$insert['rb_email']  		= $this->session->userdata('logged_in')['username'];
				$insert['rb_password']  	= '';
				$insert['rb_contact']  		= '';
				$insert['rb_country_id']  	= $this->session->userdata('logged_in')['country'];
				$insert['rb_status']  		= '1';
				$insert['added_at'] 		= date('Y-m-d H:i:s');
				$insert['rb_sub_key'] 		= $subscriptionkey;
				$insert['rb_code'] 			= $rbcode;
				$adddetail_id = $this->rboard->insert_rboard_details($insert);
				if($adddetail_id){
					// $to = 'abhijeetkuma@gmail.com';
					$to = $this->session->userdata('logged_in')['username'];
					$subject = 'Subscription Purchase';
					$message = 'Thank you for purchase subscription<br> Activation key:'.$subscriptionkey.'<br>Code:'.$rbcode;
					
				}
			}
			
			if($userid->payment_type == 'r' ){
				
				$updat['subscription_id'] 		= $userid->product_id;
				$updated = $this->rboard->update_rboard_details($updat,$rb_id);
				
					$package = $this->rboard->get_one_subscription_package($userid->product_id);
					$subscription_details = $this->rboard->get_rboard_subscription_details($userid->user_id);

					$to = $this->session->userdata('logged_in')['username'];
					$subject = 'Renewal of Subscription Purchase';
					$message = 'Thank you for purchase subscription <br> new application is added on your tracker.';
			?><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<script>
					jQuery(document).ready(function($){
						var domain = '<?php echo $this->session->userdata('logged_in')['domain']; ?>';
						var admin_email = '<?php echo $this->session->userdata('logged_in')['username']; ?>';
						var rb_name = '<?php echo $subscription_details->rb_name; ?>';
						var subscription_id = '<?php echo $userid->product_id; ?>';
						var subscription_name = '<?php echo $package->subcription_name; ?>';
						var no_of_applications = '<?php echo $package->no_of_applications; ?>';
						var rb_sub_key = '<?php echo $subscription_details->rb_sub_key; ?>';
						var rb_code = '<?php echo $subscription_details->rb_code; ?>';
						var added_on = '<?php echo date('Y-m-d H:i:s'); ?>';
							$.ajax({
							type: "POST",
							url: domain+'admin/api/update_admin_subscription_package',
							// url: "https://ceonpoint.com/RBoard/admin/api/update_admin_subscription_package",
							data: JSON.stringify({
									"domain":domain,
									"admin_email":admin_email,
									"rb_name":rb_name,
									"subscription_id":subscription_id,
									"subscription_name":subscription_name,
									"no_of_application":no_of_applications,
									"rb_sub_key":rb_sub_key,
									"rb_code":rb_code,
									"added_on":added_on
								}),
								success: function(result){
									console.log(result)
								}
							});  
					});  
				</script><?php  
			}
			$notification = array(
				'subject'        	=> $subject,   
				'to' 				=> $userid->user_id,  
				'message' 			=> $message,  
				'status'     		=> 1,
				'added_on'     		=> date('Y-m-d H:i:s')
			); 
			$this->user->save('tbl_notification',$notification);
			$this->sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE);
			// $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Success.</div>');
			echo '<script>
				window.location.href = "'.base_url().'rboard/purchase_history";
			</script>';
			// redirect('rboard/purchase_history','refresh');
		}
		//echo '<pre>'; print_r($_POST); exit;
	}
		
	public function payment_cancel()
	{
		redirect('rboard/subscription_package','refresh');
		
	}
	public function purchase_history()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		//$uid = $this->session->userdata('logged_in')['id'];
		$data['purchase_history'] = $this->rboard->purchase_history($uid);
		$this->load->front('rboard/purchase_history',$data);
		
	}
	public function subscription_history()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		//$uid = $this->session->userdata('logged_in')['id'];
		$data['purchase_history'] = $this->rboard->subscription_history($uid);
		$this->load->front('rboard/subscription_history',$data);
		
	}
	public function terms()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		$data['terms']	= $this->dashboards_model->get_terms('rboard');
		$this->load->frontAdmin('rboard/terms',$data);
	}

	public function sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE)
	{ 
		$from = "mails@ceonpoint.com";
		$fromName = "Ceonpoint";
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
		    'Reply-To: '.$from."\r\n" .
		    'X-Mailer: PHP/' . phpversion();

		if(mail($to, $subject, $message, $headers)){ 
		    return true;
		} else{ 
		    return false;
		}
	}

	public function edit_profile()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
		$this->form_validation->set_rules('country_name', 'Country Name', 'trim|required'); 
		$this->form_validation->set_rules('representative', 'Representative Name', 'trim|required');  
		$this->form_validation->set_rules('position', 'Position', 'trim|required'); 
		$this->form_validation->set_rules('mobile', 'Contact Number', 'trim|required'); 
		
		if($this->form_validation->run() == FALSE)
		{

			$data['profile'] = $this->rboard->get_rboard_info($uid);
			$data['country'] = $this->user->get_countries();
			$this->load->frontAdmin('rboard/edit_profile',$data); 
		
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


			$data['name'] 			= $this->input->post('name'); 
			$data['country'] 		= $this->input->post('country_name');
			$data['state'] 			= $this->input->post('state'); 
			$data['city'] 			= $this->input->post('city'); 
			$data['street'] 		= $this->input->post('street'); 
			$data['representative'] = $this->input->post('representative'); 
			$data['position'] 		= $this->input->post('position'); 
			$data['mobile'] 		= $this->input->post('mobile'); 
			// $data['website'] 		= $this->input->post('website'); 
		    $result = $this->user->update('tbl_user',$data,'id',$uid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			} 
			redirect('rboard/edit_profile');
		}
	}

	public function change_password()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required'); 
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required'); 
		$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[new_password]');
		$this->form_validation->set_error_delimiters('<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">', '</div>');
		if($this->form_validation->run() == FALSE)
		{
			$data['profile'] = $this->rboard->get_rboard_info($uid);
			$this->load->frontAdmin('rboard/change_password',$data); 
		} else{
			$old = $this->input->post('old_password');
			$get_data = $this->rboard->get_rboard_info($uid);
			if($get_data->password == md5($old)){
				$data['password'] 		= md5($this->input->post('conf_password')); 
				$result = $this->user->update('tbl_user',$data,'id',$uid); 
				if($result){
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Password updated successfully.</div>');
				} else {
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				} 
			}else{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Wrong old Password.</div>');
			}

			redirect('rboard/change_password');
		}
	}

	public function settings(){
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){ redirect('users'); }

		if($this->input->post('submit')=='Submit'):
			$data['registering_body'] = $this->input->post('registering_body'); 
			$data['website'] 		  = $this->input->post('website'); 
			$result = $this->user->update('tbl_user',$data,'id',$uid); 
			if($result):
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
			else:
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			endif; 
			redirect('rboard/settings');
		else:
			$data['profile'] = $this->rboard->get_rboard_info($uid);
			$this->load->frontAdmin('rboard/settings',$data); 
		endif;

	}

	public function tutorials()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		$data['reg'] 	= $this->dashboards_model->get_tutorial('regulatoryBoard');
		$this->load->frontAdmin('rboard/tutorials',$data);
	}
}

?>