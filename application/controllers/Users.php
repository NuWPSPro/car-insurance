<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->model('Users_model','users_model'); 
		$this->load->model('Certificate_model','certificate_model'); 
	}

	public function profile($id)
	{
		$data['profile'] = $this->db->get_where('tbl_user',array('id'=>$id))->row_array();
		$data['review'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_user_review','to_user',$id);

		$currentUser    = $this->user->get_record_by_field_name_all_record('tbl_user','id',$id);
		$data['authors'] = $this->user->get_record_by_field_name_all_record('tbl_user','under_provider',$currentUser[0]['insititution_id']);
	 
		$this->db->where('user_id',$id);
		// $this->db->or_where('author_reference_id',$data['authors'][0]['id']);
		$data['allcourse'] = $this->user->seminarlist('tbl_course','status',1,$cat);
        
        $this->db->where('user_id',$id);
		$data['seminar'] = $this->user->get_seminar('tbl_training','status',1,$dt); 
		$data['og_description'] =  'Ceopoint author profile for '.$data['profile']['name'];
		$data['og_title'] 		=  'Ceopoint author profile for '.$data['profile']['name'];
		$data['og_image'] 		=  base_url('assets/images/uploads/'.$data['profile']['image']);
		$data['og_url'] 		=  base_url('users/profile/'.$data['profile']['id']);
		$data['og_type'] 		=  'Author';
		$this->load->frontAdmin('admin/user_profile',$data);
	}
  

	public function index()
	{
		if($this->session->userdata('logged_in')['id'] > 0){
			$role = $this->session->userdata('logged_in')['role'];
			$underins = $this->session->userdata('logged_in')['under_insititution'];
			if($role==10){
					redirect('admin/dashboard/?month=&year=2018', 'refresh');
				}

				if($role==1){
					redirect('professional/dashboard', 'refresh');
				}

				if($role==2){
					redirect('provider/index', 'refresh');
				}

				if($role==3){
					redirect('placement/dashboard', 'refresh');
				}

				if($role==4){
					redirect('advertise/advertise', 'refresh');
				}

				if($role==5){
				
					// redirect('institution/editwebpage', 'refresh');
					redirect('institution/settarget', 'refresh');
				}

				if($role==6){
					// if($underins =='0'){
					// 	redirect('author/overview', 'refresh');
					// }else{
					// 	redirect('author/course_listing', 'refresh');
					// }
					redirect('author/index', 'refresh');
				}
				if($role==7){
					redirect('rboard/subscription_package', 'refresh');
				}
		}
		// echo $_GET['location'].'<br>';die;
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('username', 'Email / Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');  
		if($this->form_validation->run() == FALSE){  
			if($_REQUEST['popups']==1){
				$url= $_SERVER['HTTP_REFERER'];
				redirect($url);
			}
			$data['adv'] = $this->user->get_advertisement('login');

			$this->load->front('users/login',$data); 
		}else{

		$username  		= trim($this->input->post('username')); 
		$password 		= $this->input->post('password');
 	
        $result = $this->users_model->login($username, $password);
        if($result){
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
				'fname' 		=> $row['fname'],  
				'name' 		=> $row['name'],  
				'lname' 		=> $row['lname'],  
				'role' 		=> $row['role'],  
				'profession'=> $row['profession'],  
				'location' 	=> $row['location'],  
				'address' 	=> $row['address'],
				'country' 	=> $row['country'],
				'mobile' 	=> $row['mobile'],
				'insititution_id' 	=> $row['insititution_id'],
				'under_insititution'=> $row['under_insititution'],
				'logged_in'=> $row['logged_in']
				);

			$this->session->set_userdata('logged_in', $sess_array);
			//$this->session->set_flashdata('response', '<div class="alert alert-success">Logged In</div>');
			
			if($_REQUEST['popups']==1){
				$url= $_SERVER['HTTP_REFERER'].'?p=1';
				redirect($url);
			}

			if($_REQUEST['popups']==2){
				$url= $_SERVER['HTTP_REFERER'].'?p=2';
				redirect($url);
			}
			if($_REQUEST['location']!=''){
				$url = htmlspecialchars($_REQUEST['location']);
				redirect($url);
			}

		 		$role = $row['role'];
				$uins = $row['under_insititution'];
				// print_r($uins);
				if($role==10){
					redirect('admin/dashboard/?month=&year='.date('Y'), 'refresh');
				}

				if($role==1){
					redirect('professional/dashboard', 'refresh');
				}

				if($role==2){
						redirect('provider/index', 'refresh');
					// if($uins =='0'){
					// 	redirect('provider/overview', 'refresh');
					// }else{
					// 	redirect('provider/set_target', 'refresh');
					// }
				}

				if($role==3){
					redirect('placement/dashboard', 'refresh');
				}

				if($role==4){
					redirect('advertise/advertise', 'refresh');
				}

				if($role==5){
					// redirect('institution/editwebpage', 'refresh');
					redirect('institution/settarget', 'refresh');
				}
				
				if($role==6){
					// if($uins =='0'){
					// 	redirect('author/overview', 'refresh');
					// }else{
					// 	redirect('author/course_listing', 'refresh');
					// }
						redirect('author/index', 'refresh');
				}
				
				if($role==7){
					redirect('rboard/subscription_package', 'refresh');
				}
		}else{
			$this->session->set_flashdata('response', '<div class="alert alert-danger">Failed to login.</div>');
				redirect('users', 'refresh');
		}
			
		}
	}
		
 
	public function captcha(){
		$this->load->helper('captcha');
		$vals = array(
			// 'word'          => 'Random word',
			'img_path'      => './assets/captcha-images/',
			'img_url'       => base_url().'/assets/captcha-images/',
			'font_path'     => './path/to/fonts/texb.ttf',
			'img_width'     => '280px',
			'img_height'    => '40px',
			'expiration'    => 7200,
			'word_length'   => 6,
			'font_size'     => 20,
			'img_id'        => 'Imageid',
			// 'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'pool'          => '0123456789876543210',
	
			// White background and border, black text and red grid
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		);
		
		$cap = create_captcha($vals);
		$captchaword = $cap['word'];
		$this->session->set_userdata('captchaword',$captchaword);
		return $cap['image'];
	}

	public function signup(){
		$signupformname = '';
		$this->load->library('upload');

		if($this->input->method()=="post"){		
			$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('con_password', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules('username', 'Email / Username', 'required|valid_email|is_unique[tbl_user.username_email]');
			$this->form_validation->set_message('is_unique', '<div class="alert alert-danger">Already Exist. Pls try with different email.</div>');

			if($this->form_validation->run() == FALSE)
			{ 
				$errors = $this->form_validation->error_array();
				$error=json_encode($errors);
				$this->session->set_flashdata('response', '<div class="alert alert-danger">'.validation_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}else{ 
				$captcha_text = $this->input->post('captcha_text');
				$captcha_session = $this->session->userdata('captchaword');
				
				if($captcha_text == $captcha_session){

				$under_institution = $this->input->post('under_institution');
				if($under_institution == 1){ 
					$institution      = $this->input->post('institution');
					$institution_code = $this->input->post('institution_code');
					
					$where =array('id'=>$institution,'insititution_id'=>$institution_code);
					$insititution = $this->user->get_record_by_multi_field_name('tbl_user',$where); 
					
					if(empty($insititution)){ 
						if($this->input->post('role') == 6){
							if($this->input->post('userType')=='authorCeonpoint'){
								
							}else{
								$this->session->set_flashdata('response', '<div class="alert alert-danger">Invalid provider code.</div>');
								redirect('users/signup/authors', 'refresh');
							}
						}else{ 
							$this->session->set_flashdata('response', '<div class="alert alert-danger">Invalid institution code.</div>');
							redirect('users/signup/provider', 'refresh');
						}		
					}else{ 
						if($this->input->post('role')== 2){
							$data['under_insititution']  = 1;
							$data['parent_insititution'] = $institution;
							$data['under_provider'] 	 = $this->input->post('institution_code'); 
						}else{
							if($this->input->post('role')== 5 && $insititution[0]['under_insititution'] == '0'){
								$data['under_insititution']  = 1 ;
								$data['parent_insititution'] = $institution; 
							}elseif($insititution[0]['under_insititution'] == '0'){
								$data['under_insititution']  = 0 ;
								$data['under_provider'] 	 = $this->input->post('institution_code'); 
							}else{
								if($this->input->post('role')==6){
									$data['parent_insititution'] = $insititution[0]['parent_insititution'];
								}else{
									$data['parent_insititution'] = $institution;
								}

								$data['under_insititution']  = 1 ;
								$data['under_provider'] 	 = $this->input->post('institution_code'); 
							}
						}
					}
				}else{
					$data['under_insititution']  = 0;
				}

			$data['name'] 				= ucwords(trim($this->input->post('name')));
			$data['fname'] 				= ucwords(trim($this->input->post('fname')));
			$data['lname'] 				= ucwords(trim($this->input->post('lname')));
			$data['role']    			= $this->input->post('role');
			$data['profession']     	= trim($this->input->post('profession'));
			$data['address']			= trim($this->input->post('address'));
			$data['username_email'] 	= trim($this->input->post('username')); 
			$data['country'] 			= trim($this->input->post('country_name')); 
			$data['location']			= trim($this->input->post('location'));
			$data['issuing_country'] 	= trim($this->input->post('issuing_country')); 

			$data['licence_validity'] 	= trim($this->input->post('validity')); 
			$data['licence_prc']    	= trim($this->input->post('licence_prc'));

			$data['licence']    		= trim($this->input->post('licence_no')); 
			$data['validity'] 			= trim($this->input->post('validity')); 
			
			$data['licence_issued'] 	= trim($this->input->post('licence_issued')); 
			$data['paypal_email']   	= trim($this->input->post('paypal_email')); 

			$data['state']  			= ucwords(trim($this->input->post('state'))); 
			$data['city']   			= ucwords(trim($this->input->post('city'))); 
			$data['street'] 			= trim($this->input->post('street'));

			$data['prc_acceditation_number']= trim($this->input->post('accreditation_num')); 
			$data['company_email'] 			= trim($this->input->post('company_email')); 
			$data['issuing_institution'] 	= trim($this->input->post('issuing_institution')); 
			$data['representative'] 		= ucwords(trim($this->input->post('representative'))); 
			$data['position'] 				= ucwords(trim($this->input->post('designation'))); 
			$data['accreditation_web'] 		= trim($this->input->post('accreditation_web')); 

			$data['mobile'] 			= trim($this->input->post('mobile')); 
			$data['skype']  			= trim($this->input->post('skype')); 
			$data['website']  			= trim($this->input->post('website')); 
			// $data['registering_body']= $this->input->post('registering_body'); 

			$data['password'] 		= md5($this->input->post('password'));
			$data['status']    	    = 0; 
			$data['added_on']    	= date('y-m-d h:i:s'); 
			$data['activation_id']  = time().rand(9,9999); 

		//$data['insititution_id']  = 'I-'.time().rand(9,9999); 

		if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){
			$config1['upload_path'] 	= './assets/images/uploads/';	
			$config1['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config1['max_size'] 		= '5000000';        
			$ext = explode('.',$_FILES["photo"]["name"]);        
			$imageName = 'VID_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('photo')) {
				$error = array('error' => $this->upload->display_errors());  
				$this->session->set_flashdata('response', '<div class="alert alert-danger">'.$error['error'].'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}  
			$data['image'] = $imageName;
		}

		if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
			$config1['upload_path'] 	= './assets/images/uploads/';
			$config1['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config1['max_size'] 		= '5000000';     
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName = 'VID_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('image')){
				$error = array('error' => $this->upload->display_errors());   
				$this->session->set_flashdata('response', '<div class="alert alert-danger">'.$error['error'].'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}  
			$data['image'] = $imageName;
		}

		if(isset($_FILES["accreditation_doc"]) && !empty($_FILES["accreditation_doc"]['name'])){
			$config1['upload_path'] = './assets/images/uploads/';
			$config1['allowed_types'] = 'docx|doc|pdf|gif|jpg|png|jpeg';
			$config1['max_size'] = '500000000000';     
			$ext = explode('.',$_FILES["accreditation_doc"]["name"]);        
			$imageName = 'Doc_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('accreditation_doc')){
				$error = array('error' => $this->upload->display_errors());   
				$this->session->set_flashdata('response', '<div class="alert alert-danger">'.$error['error'].'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}  
			$data['accreditation_doc'] = $imageName;
		}
		
		$lastid = $this->users_model->save('tbl_user',$data);

		if($lastid){
			unset($_SESSION['captchaword']);
			$tolower 					= strtolower($this->input->post('name'));
			$replace 					= str_replace(" ","-",$tolower);  
			$datas['insititution_id'] 	= $replace.'-'.$lastid;
			$this->users_model->update('tbl_user',$datas,'id',$lastid);
			$data['link'] 				= site_url('users/activate/').$data['activation_id'];
			if($_REQUEST['redirect']){
				$data['redirect'] 		= $_REQUEST['redirect']; //it helps to redirect to previous page.
			}

			if($data['role']==6){
				$this->authorUpdateInfo($lastid);
				$notification = array(
					'subject'        	=> 'Registration Verification',  
					'to' 				=> $lastid,  
					'message' 			=> $this->load->view('email/member_approve',$data,true),  
					'status'     		=> 1,
					'added_on'     		=> date('Y-m-d H:i:s')
				); 
				$this->user->save('tbl_notification',$notification);
				$this->session->set_flashdata('response','<div class="alert alert-success"><b>'.ucfirst($_REQUEST['name']).'</b><p>You are successfully registered!</p><p>Please wait for your Car Insurance Company to approve your account.<br> Please check your email to see the approval message and click the link to log-in.</p></div>');
			}elseif($data['role']==5 && $data['under_insititution']==1){
				$this->session->set_flashdata('response','<div class="alert alert-success"><b>'.ucfirst($_REQUEST['name']).'</b><p>You are successfully registered!</p><p>Please wait for your Institution to approve Your account.<br> Please check your email to see the approval message and click the link to log-in.</p></div>');
			}elseif($data['role']==2){
				if($data['under_insititution']==1){
					$this->session->set_flashdata('response','<b>'.ucfirst($_REQUEST['name']).'</b><p>You have successfully created your account at ceonpoint.com.</p><div class="alert alert-success"><p>Once approved by your institution, you will receive an e-mail. advising you to log in at your CEP account using your username (email) and Password.</p></div>');
				}else{
					$this->sendMail($data['username_email'],'Registration Verification',$this->load->view('email/member_approve',$data,true));
					$notification = array(
					'subject'        	=> 'Registration Verification', 
					'to' 				=> $lastid,  
					'message' 			=> $this->load->view('email/member_approve',$data,true),  
					'status'     		=> 1,
					'added_on'     		=> date('Y-m-d H:i:s')
					); 
					$this->user->save('tbl_notification',$notification);
					$this->session->set_flashdata('response', '<div class="alert alert-success"><b>'.ucfirst($_REQUEST['name']).'</b> <p> You are successfully registered.</p><p>A verification email has been sent to <b>'.$data['username_email'].'</b> <br><span style="color:red;">Please check your email to activate your account.</span></p></div>');
				}
			}else{
				$this->sendMail($data['username_email'],'Registration Verification',$this->load->view('email/member_approve',$data,true));
				$notification = array(
				'subject'        	=> 'Registration Verification', 
				'to' 				=> $lastid,  
				'message' 			=> $this->load->view('email/member_approve',$data,true),  
				'status'     		=> 1,
				'added_on'     		=> date('Y-m-d H:i:s')
				); 
				$this->user->save('tbl_notification',$notification);
				$this->session->set_flashdata('response', '<div class="alert alert-success"><b>'.ucfirst($_REQUEST['name']).'</b> <p> You are successfully registered.</p><p>A verification email has been sent to <b>'.$data['username_email'].'</b> <br><span style="color:red;">Please check your email to activate your account.</span></p></div>');
			}
				redirect('users/success', 'refresh');

		}else{
			$this->session->set_flashdata('response', '<div class="alert alert-danger">Failed to Add New User.</div>');
			redirect('users/success', 'refresh');
		}
			
		}else{
			$this->session->set_flashdata('response', '<div class="alert alert-danger">Wrong captcha code, Please try again.</div>');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
		}else{
			$this->db->order_by('cat_name','ASC');
			$data['profession'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
			$data['adv'] = $this->user->get_advertisement('Registration');
			$data['captcha_image'] =  $this->captcha();
			$this->load->front('users/signup',$data); 
		}
	}

    public function signupadvertisers()
	{
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'required');	
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('con_password', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('username', 'Email / Username', 'required|valid_email|is_unique[tbl_user.username_email]');
		$this->form_validation->set_message('is_unique', 'Already Exist. Pls try with different.');
		if($this->form_validation->run() == FALSE)
		{       			
			$data['adv'] = $this->user->get_advertisement('Registration');
			$this->session->set_flashdata('error', validation_errors());
			redirect('users/signup/advertisers');			
		} else { 

		$data['name'] 			= $this->input->post('name');
		$data['role']    		= 4;		
		
		$data['address']		= $this->input->post('address1');
		$data['username_email'] = $this->input->post('username'); 
		$data['country'] = $this->input->post('country_name'); 
		
		$data['mobile'] = $this->input->post('mobile'); 
		$data['skype']  = $this->input->post('skype'); 
		$data['watsup']  = $this->input->post('watsup'); 
        $data['position']  = $this->input->post('position'); 


		$data['password'] 		= md5($this->input->post('password'));
		$data['status']    	    = 0; 
		$data['added_on']    	= date('y-m-d h:i:s'); 

		$data['activation_id']  = time().rand(9,9999); 

		if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){
			$config1['upload_path'] = './assets/images/uploads/';
			$config1['allowed_types'] = 'gif|jpg|png|jpeg';
			$config1['max_size'] = '1000000000000000';
	//		$config['max_width']  = '1500';
	//		$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["photo"]["name"]);        
			$imageName = 'VID_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName;
			$this->load->library('upload', $config1);
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('photo'))
			{
			$error = array('error' => $this->upload->display_errors()); 
			$this->session->set_flashdata('response', '<div class="alert alert-danger">'.$error['error'].'</div>');
			redirect('users/success', 'refresh');                   
			}  
			$data['backimage'] = $imageName;
			}


/*if($under_institution==1){*/

			$lastid = $this->users_model->save('tbl_user',$data);

			if($lastid){
			//echo $this->input->post('name');
			$tolower = strtolower($this->input->post('name'));

			$replace = str_replace(" ","-",$tolower);  

			$datas['insititution_id'] = $replace.'-'.$lastid;
			$this->users_model->update('tbl_user',$datas,'id',$lastid);


				$data['link'] = site_url('users/activate/').$data['activation_id'];

				if($data['role']==2){

				$this->session->set_flashdata('response', '<div class="alert alert-success">New User '.$_REQUEST['name'].' Successfully registered. You will be ogin once the admin will approve your registration request.</div>');

				} else {

				$this->sendMail($data['username_email'],'Registration Verification',$this->load->view('email/member_approve',$data,true));

				$this->session->set_flashdata('response', '<div class="alert alert-success">New User '.$_REQUEST['name'].' Successfully registered a verification email has been sent to '.$data['username_email'].' <br><span style="color:red;">Please check your email to activate your account.</span></div>');
			}

				redirect('users/success', 'refresh');
			}
			else{
				$this->session->set_flashdata('response', '<div class="alert alert-danger">Failed to Add New User.</div>');
				redirect('users/success', 'refresh');

			}
			
		}

		
	}

	public function authorUpdateInfo($lastid)
	{
		$udetails = $this->user->get_record_by_field_name('tbl_user','id',$lastid);
		$this->load->library('upload');
		$promotedata['user_id'] 			= $lastid;
		$promotedata['country_id'] 			= $udetails['country'];
		$promotedata['name']    			= $this->input->post('name');
		$promotedata['profession']    		= $this->input->post('profession');
		$promotedata['years_of_practice']   = $this->input->post('years_of_practice');
		$promotedata['specialization']  	= $this->input->post('specialization');
		$promotedata['edu_elementary']  	= $this->input->post('edu_elementary');
		$promotedata['edu_elementary_s']	= $this->input->post('edu_elementary_s');
		$promotedata['edu_elementary_e']	= $this->input->post('edu_elementary_e');
		$promotedata['edu_high_school'] 	= $this->input->post('edu_high_school');
		$promotedata['edu_high_school_s'] 	= $this->input->post('edu_high_school_s');
		$promotedata['edu_high_school_e'] 	= $this->input->post('edu_high_school_e');
		$promotedata['edu_college']    		= $this->input->post('edu_college');
		$promotedata['edu_college_s']    	= $this->input->post('edu_college_s');
		$promotedata['edu_college_e']    	= $this->input->post('edu_college_e');
		$promotedata['edu_masteral']    	= $this->input->post('edu_masteral');
		$promotedata['edu_masteral_s']    	= $this->input->post('edu_masteral_s');
		$promotedata['edu_masteral_e']    	= $this->input->post('edu_masteral_e');
		$promotedata['edu_doctoral']    	= $this->input->post('edu_doctoral');
		$promotedata['edu_doctoral_s']    	= $this->input->post('edu_doctoral_s');
		$promotedata['edu_doctoral_e']    	= $this->input->post('edu_doctoral_e');
		// $promotedata['facebook']    		= $this->input->post('facebook');
		// $promotedata['linkedin']    		= $this->input->post('linkedin');
		// $promotedata['googleplus']    	= $this->input->post('googleplus');
		// $promotedata['twitter']    		= $this->input->post('twitter');
		// $promotedata['youtube']    		= $this->input->post('youtube');
		// $promotedata['instagram']    	= $this->input->post('instagram');
		// $promotedata['pinterest']    	= $this->input->post('pinterest');
		$promotedata['pro_status']   		= '1';
		$promotedata['added_at']    		= date('Y-m-d H:i:s');
		$promotedata['user_type']    		= 2;
		$proinserted = $this->users_model->save('tbl_professionals',$promotedata);	

		if($proinserted > 0){
			if(is_array($_POST['practice_title'])){
				for($i =0; $i<=count($_POST['practice_title']);$i++){
					
					if(isset($_POST['practice_title'][$i]) && $_POST['practice_title'][$i] != ""){
						$practiceitems = array(
							'pro_id' 				=> $proinserted,
							'practice_title' 		=> $_POST['practice_title'][$i],
							'practice_year_s' 		=> $_POST['practice_year_s'][$i],
							'practice_year_e' 		=> $_POST['practice_year_e'][$i],
							'practice_highlights' 	=> $_POST['practice_highlights'][$i],
							'added_at'     			=> date('Y-m-d H:i:s'),
						);
						$this->users_model->save('tbl_practice_list', $practiceitems);					
					}				
				}
			}

			for($i =0; $i<=count($_POST['citations_title']);$i++){
				if(isset($_POST['citations_title'][$i]) && $_POST['citations_title'][$i] != ""){
					$citationsitems = array(
						'pro_id' 		 => $proinserted,
						'citations_title'=> $_POST['citations_title'][$i],
						'cit_year_s' 	 => $_POST['cit_year_s'][$i],
						'cit_year_e' 	 => $_POST['cit_year_e'][$i],
						'cit_highlights' => $_POST['cit_highlights'][$i],
						'added_at'     	 => date('Y-m-d H:i:s'),
					);
					$this->users_model->save('tbl_citations_list', $citationsitems);					
				}				
			}

			for($i =0; $i<=count($_POST['aff_title']);$i++){
				if(isset($_POST['aff_title'][$i]) && $_POST['aff_title'][$i] != ""){
					$awarditems = array(
						'pro_id' 			=> $proinserted,
						'aff_title' 		=> $_POST['aff_title'][$i],
						'aff_year_s' 		=> $_POST['aff_year_s'][$i],
						'aff_year_e' 		=> $_POST['aff_year_e'][$i],
						'aff_highlights' 	=> $_POST['aff_highlights'][$i],
						'added_at'     		=> date('Y-m-d H:i:s'),
					);
					$this->users_model->save('tbl_affiliation_list', $awarditems);					
				}				
			}
			$name_array = array();
			$count = count($_FILES['portfolio']['tmp_name']);
			if($count > 0){
				$value = $_FILES['portfolio'];
				for($s=0; $s<=$count-1; $s++) {
					$_FILES['portfolio']['name']		= $value['name'][$s];
					$_FILES['portfolio']['type']    	= $value['type'][$s];
					$_FILES['portfolio']['tmp_name'] 	= $value['tmp_name'][$s];
					$_FILES['portfolio']['error']       = $value['error'][$s];
					$_FILES['portfolio']['size']    	= $value['size'][$s];   
						$config['upload_path'] 			= './assets/images/uploads/';
						$config['allowed_types'] 		= 'gif|jpg|png';
					$ext = explode('.',$value['name'][$s]);	
					$documentname = 'doc_'.time().'.'.end($ext);
					$config['file_name'] = $documentname;
					$this->upload->initialize($config);
					$this->upload->do_upload('portfolio');
					$data = $this->upload->data();
					$name_array[] = $data['file_name'];

					$portfolioarr = array(
							'user_id' 		=> $this->session->userdata('logged_in')['id'],
							'filetype' 		=> 'img',
							'filename' 		=> $data['file_name'],
							'added_at'     	=> date('Y-m-d H:i:s'),
						);
					$this->users_model->save('tbl_user_docutments', $portfolioarr);	
				}
			}
		}
		return true;
	}
	
	public function logout()
	{ 
		$uid = $this->session->userdata('logged_in')['id'];
		$datas1['logged_in_status'] = 0;
		$this->users_model->update('tbl_user',$datas1,'id',$uid);
		$this->session->unset_userdata('LOGGED_USER');
		session_destroy();
		redirect('users');
	} 

    public function changepassword()
    {
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('confpassword', 'Confirm Password','required|matches[password]');
        if($this->form_validation->run() == FALSE){  
				$this->load->front('users/changepassword',$data); 
		}else{ 
			$email  			 = $this->input->post('email');
			$forgot_password_key = $this->input->post('forgot_password_key');
			$result = $this->db->get_where('tbl_user',array('username_email'=>$email,'forgot_password_key'=>$forgot_password_key))->num_rows();
			// echo $result;
			if($result > 0 ){
			 
			 $data2['forgot_password_key']  	= '';
			 $data2['password']  	= md5($this->input->post('confpassword'));
			 $this->users_model->update('tbl_user',$data2,'username_email',$email);

			// $this->sendMail($email,'Forgot Password',$this->load->view('email/forget_password_success',$data2,true));

			$this->session->set_flashdata('response', '<div class="alert alert-success">Your password has been changed. Please Log-in with new Password.<a/></div>');
			 redirect('users/success', 'refresh');
			
			}else{
		    $this->session->set_flashdata('response', '<div class="alert alert-danger">Invalid link.Please try again!</div>'); 
		     $this->load->front('users/changepassword');
			}
		  
		 }
		 			 
    }

	public function forgotpassword()
	{
	    $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('email', 'Email / Username', 'required');  
		if($this->form_validation->run() == FALSE)
		{  
			$this->load->front('users/forgotpassword'); 
		}else{ 

		$result = $this->db->get_where('tbl_user',array('username_email'=>$this->input->post('email')))->num_rows();
        
        if($result > 0 ){
		 
		 $email  						= $this->input->post('email');
		 $data1['forgot_password_key']  = $this->input->post('forgot_key');
		 $data1['email']  				= $this->input->post('email');
		 $update = array(
		 	'forgot_password_key' => $this->input->post('forgot_key') 
		 );

		 $this->users_model->update('tbl_user',$update,'username_email',$email);

		 $this->sendMail($email,'Forgot Password',$this->load->view('email/forget_password_success',$data1,true));

		$this->session->set_flashdata('response', '<div class="alert alert-success">Password reset link sent to your mail.... Please check your mail.</div>');
			redirect('users/successmsg', 'refresh');
		}else
		{
	       $this->session->set_flashdata('response', '<div class="alert alert-danger"> Invalid email. Please check your email.</div>');
	       redirect('users/forgotpassword', 'refresh');
        }		
	  }
		
	}

	public function activate($activation_id){ 
		$userdetails = $this->users_model->getusetdetails('tbl_user','activation_id',$activation_id);
			if($userdetails->id > 0 && $userdetails->activation_id == $activation_id){
				$data['status'] = 1;
				$data['activation_id'] = "";
				$this->users_model->update('tbl_user',$data,'id',$userdetails->id);
				if($userdetails->role == '1'){

					if(!empty($userdetails->country) && $userdetails->country > 0){
						$countrydays = $this->db->get_where('tbl_countrywise_trail_days',array('country_id'=>$userdetails->country))->row_array();
						if(is_array($countrydays)){
							$traildays = $countrydays['trail_days']; 	
						}else{
							$traildays = 14;	
						}
						
					}else{
						$traildays = 14;
					}
					$planarr = array('user_id'=>$userdetails->id,'registration_date'=>date('Y-m-d'),'payment_status'=>'n','version_type'=>'2','plan_duration'=>$traildays.' days','plan_active_at'=>date('Y-m-d'),'plan_expiry_at'=>date('Y-m-d', strtotime("+$traildays days")),'payment_recieved_id'=>'','payment_recieved_at'=>'');
					$this->users_model->save('professional_pce_plan',$planarr);
				}
				
				$this->session->set_flashdata('response', '<div class="alert alert-success">Your account has been activated. </div>');
				redirect('users/activate_success?location="'.$_REQUEST['location'].'"', 'refresh');
			}else{
				$this->session->set_flashdata('response', '<div class="alert alert-danger">Activation failed.</div>');
				redirect('users', 'refresh');
			}
			
			
			/* if($this->users_model->update('tbl_user',$data1,'activation_id',$uid)){

			    $data2['activation_id'] = "";
				$this->users_model->update('tbl_user',$data2,'activation_id',$uid);
				$planarr = array('user_id'=>'','registration_date'=>date('Y-m-d'),'payment_status'=>'n','version_type'=>'2','plan_active_at'=>date('Y-m-d'),'plan_expiry_at'=>date('Y-m-d', strtotime("+14 days")),'payment_recieved_id'=>'','payment_recieved_at'=>'');
				$this->users_model->save('professional_pce_plan',$planarr);
				

				$this->session->set_flashdata('response', '<div class="alert alert-success">Your account has been activated. </div>');
				redirect('users', 'refresh');
			}
			else{
				$this->session->set_flashdata('response', '<div class="alert alert-danger">Activation failed.</div>');
				redirect('users', 'refresh');

			} */
	}

	public function activate_success(){ 
		$this->load->view('users/activated');
	}

	public function sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE){ 
		$from = EMAIL;
		$fromName = "Ceonpoint";
		 
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






	public function index1(){

		//$this->form_validation->set_rules('comment', 'Comment', 'trim|required'); 

		$userdetaisId = $this->input->post('idd');

		$uid = $this->session->userdata('logged_in')['id'];		

		$data['review']           = $this->input->post('comment');
		// $data['rate']             = $this->input->post('rating');
		$data['status']           = 1;
		$data['from_user']        = $uid;
		$data['to_user']          = $userdetaisId;
		$data['added_on']         = date('Y-m-d');

		$result = $this->users_model->save('tbl_user_review',$data);

		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Your review has been published.</div>');
			redirect('users/profile/'.$userdetaisId.'');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('users/profile/'.$userdetaisId.'');

		}

	
	}



public function certificate_download(){
	    
	   	$certificateNo  =  $this->input->post('certifiacte_no');

	    $certificateTrainingData = $this->user->get_record_by_field_name_all_record111('tbl_training_book','certificate_id',$certificateNo);
	 
	    if(!empty($certificateTrainingData)){
	    	// echo $certificateTrainingData;die;
	    	$data['cnumber'] = $certificateTrainingData[0]['certificate_id'];
	    	echo $this->load->view('pages/preview_certificate',$data);
	    }

	    $certificateData = $this->user->get_record_by_field_name_all_record('tbl_exam','certificate_id',$certificateNo);

	    if(!empty($certificateData)){

		    $id = $certificateData[0]['course_id']; 
		    $userid = $certificateData[0]['user_id']; 
		    $table_id = $certificateData[0]['id']; 

			
			$data['table_id'] = $table_id;		
			$uid = $userid;

			$course_id = $id;
	 		$data['course_details'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
	 		$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			
			$data['certificate'] = $this->certificate_model->get_template_info_by_course($id);

	 		$ownerid = $data['course_details'][0]['user_id'];
	 		$this->db->select('ct.countries_name as location,tu.address');
			$this->db->from('tbl_user tu');
			$this->db->join('countries ct', 'ct.countries_id = tu.location'); 
			$this->db->where('tu.id ', $ownerid); 
			$data['owner'] = $this->db->get()->result_array();
	 		$data['exam_details'] = $this->user->get_exam_detail($course_id,$uid);
	 		$data['cust_data'] = $data['exam_details'];
			$data['certificate'][0]['training_title'] =  $data['course_details'][0]['course_title'];
			$data['certificate'][0]['units'] =  $data['course_details'][0]['units'];

	 		//select path of template
	 		$category = $data['certificate'][0]['category'];
			$temp = $data['certificate'][0]['template_no'];

			//using certificate model
			$path = $this->certificate_model->select_certificate_template($category,$temp);
			// print_r($data['exam_details']);
			// echo $path;
		return $this->load->view($path,$data);
	}else{
			$error = '<div class="alert alert-danger">Wrong certificate id!</div>';
			echo $error; 
		}

}

 
        


public function certificate_show(){
	    
	    $certificateNo  =  $this->input->post('certifiacte_no');

	    $certificateTrainingData = $this->user->get_record_by_field_name_all_record111('tbl_training_book','certificate_id',$certificateNo);
	    
	 
	    if(!empty($certificateTrainingData)){
	    	//$data['cnumber'] = $certificateTrainingData[0]['certificate_id'];
	    	///echo $this->load->view('pages/preview_certificate',$data);
	    	if($certificateTrainingData[0]['certificate_id'] !=""){
     	    	echo $certificateTrainingData[0]['certificate_id'];
	    	} else {
	    		echo "";
	    	}

	    }

	    $certificateData = $this->user->get_record_by_field_name_all_record('tbl_exam','certificate_id',$certificateNo);

	    $id = $certificateData[0]['course_id']; 
	    // $cer_id = $certificateData[0]['certificate_id']; 
	     $cer_id = $certificateData[0]['id']; 

	   // echo '<pre>';  print_r($certificateData); die;
		
		$data['certificate_id'] = $cer_id;		

		$uid = $this->session->userdata('logged_in')['id'];
		$data['course_details'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
		$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		$ownerid = $data['course_details'][0]['user_id'];
		$data['owner']   = $this->user->get_record_by_field_name_all_record('tbl_user','id',$ownerid);
		// Load all views as normal
		//print_r($data); die;
		if($id==""){
			echo "";
		} else {
     		echo $cer_id;
		}
		//echo $this->load->view('pages/preview_certificate',$data);
	//die;
}




    public function success() 
	 {
	    $this->load->front('users/success'); 

     }
	public function successmsg() 
	 {
	    $this->load->front('users/successmsg'); 

     }

 

}
