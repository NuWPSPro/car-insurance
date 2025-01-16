<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends CI_Controller {
  
	/** 
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function  __construct() 

	{
	        parent::__construct();
			$roll = $this->session->userdata('logged_in')['role'];
			// if($roll != "6"){ redirect('users'); }

			$this->load->model('Users_model','users_model'); 
			$this->load->model('provider_model'); 
            $this->load->model('dashboards_model'); 			
            $this->load->model('advertise_model'); 
			$this->load->model('Share_model','share');			
	}


	 
	public function index()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){ redirect('users'); }

		$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Dashboard</h3></div>';
		$this->load->frontAdmin('broker/dashboard',$data);
	}

	

	public function profile()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
		
		if($this->form_validation->run() == FALSE)
		{
			$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Dashboard</h3></div>';

			$data['country_list'] = $this->user->get_record_by_field_name_all_record('countries','status',1);
			$data['profession_list'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1); 
		    $this->load->frontAdmin('broker/profile',$data);
		
		}else{
			$imageName='';
				if(isset($_FILES["image"]['name']) && !empty($_FILES["image"]['name'])){
					$config['upload_path'] = './assets/images/uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '200000';
					//$config['max_width']  = '170';
					//$config['max_height']  = '170';        
					$ext = explode('.',$_FILES["image"]["name"]);        
					$imageName = $ext[0].time().'.'.end($ext);
					$config['file_name'] = $imageName;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('image'))
					{
					 $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'<br>Profile image sholud be width x height( '.$config['max_width'].'X'.$config['max_height'].')</div>');
					  redirect('author/profile');			
					} 
					  //$update['image'] = $imageName;
				}



			$update = array(
				'name' 					=> $this->input->post('name'), 
				// 'role' 	    			=> $this->input->post('profession'),  
				'location' 				=> $this->input->post('location'),  
				'mobile'				=> $this->input->post('mobile'),  
				'city'					=> $this->input->post('city'),  
				'state' 				=> $this->input->post('state'),  
				'country' 				=> $this->input->post('country'), 
				'address'				=> $this->input->post('address'),  
				'profession' 			=> $this->input->post('category'),  
				'skype'					=> $this->input->post('skype'),  
				'licence' 				=> $this->input->post('licence'),  
				'licence_issued' 		=> $this->input->post('licence_issued'),  
				'issuing_institution' 	=> $this->input->post('issuing_institution'),  
				'issuing_country' 		=> $this->input->post('issuing_country')); 
				if($imageName!='')
				{
					$update['image'] = $imageName;
				} 

				//print_r($update);exit;

		    $result = $this->user->update('tbl_user',$update,'id',$uid); 
		    // echo $this->db->last_query();
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
				redirect('author/profile');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/profile');
			} 
		}
	}

	public function insurance_for_sale($id = false)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){ redirect('users'); }

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('course_title', 'Insurance Name', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required');
		$this->form_validation->set_rules('course_description', 'Description', 'trim|required');
		
		if($this->form_validation->run() == FALSE):
			$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
			$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Insurance for Sale Listing</h3></div>';
			$data['listing'] = $this->provider_model->get_all_insurance_sale($uid);
			// print_r($data['listing']); die;
			$this->load->frontAdmin('broker/insurance_for_sale_listing',$data);
		else:
			
			$post = $this->input->post();
			if($id){
				$result = $this->provider_model->edit_insurance($id,$post);
			}else{
				$result = $this->provider_model->add_insurance($post);

			}
			if($result):
				$this->session->set_flashdata('response', '<div class="alert alert-success">Insurance added successfully.</div>');
			else:
				$this->session->set_flashdata('response', '<div class="alert alert-danger">Something went wrong.</div>');
			endif;
			redirect(base_url('author/insurance_for_sale?popup=true'));
		endif;
	}

	public function insurance_for_sale_add()
	{ 
		$uid = $this->session->userdata('logged_in')['id'];
	
		$this->session->unset_userdata('current_course_id');
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('course_title', 'Course Title', 'trim|required');
	
		if($this->form_validation->run() == FALSE)
		{
			$this->load->frontAdmin('author/insurance_for_sale_listing');
		}else{
				$this->load->library('upload'); 
				if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
					$config['upload_path'] 		= './assets/images/uploads/';
					$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
					$config['max_size'] 		= '500000';       
					$ext = explode('.',$_FILES["image"]["name"]);        
					$imageName = 'Ins_'.time().'.'.end($ext);
					$config['file_name'] 	= $imageName;
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('image'))
					{ 
						$this->session->set_flashdata('response', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}  
					$data['course_photo'] = $imageName;
				}

				$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
				$provider_id            = end(explode('-',$udetails['under_provider']));
				$data['author_reference_id'] = $provider_id;
				$data['course_title'] 	= $this->input->post('course_title');
				$data['price']        	= $this->input->post('price');
				$data['insurance_type'] = $this->input->post('insurance_type');
		        $data['status']  		= $this->input->post('status');
				$data['user_id']  		= $uid;
		        $data['added_on']  		= date('Y-m-d');

				$result = $this->user->save('tbl_course',$data);
				if($result){
					// $this->session->set_userdata('current_course_id', $result);
					$this->session->set_flashdata('response', '<div class="alert alert-success"> created successfully.</div>');
					redirect('author/insurance_for_sale');
				} else {
					$this->session->set_flashdata('response', '<div class="alert alert-danger">There is some error please try again.</div>');
					redirect('author/insurance_for_sale');
				}
	    }
	}

	public function buy_insurance_listing(){
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){ redirect('users'); }


		$data['body_heading']= '<div class="admin-titlebox"><h3 class="border-title text-left">Buy Insurance Listing (Request Applications)</h3></div>';
		$data['details'] 	 = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$data['application'] = $this->provider_model->buy_insurance_list($uid);
		$data['country_list'] = $this->db->order_by('countries_name', 'asc')->get_where('countries',array('status'=>1))->result_array();
		$this->load->frontAdmin('broker/buy_insurance_list',$data);
	}

	public function get_one_buy_insurance_details($bi_id){
		$result = $this->provider_model->get_buy_insurance_by_id($bi_id);
		echo json_encode($result);
	}
	public function get_one_insurance_package($id){
		$result = $this->provider_model->get_one_sale_insurance($id);
		echo json_encode($result);
	}

	public function sendInsurance($certificateTbl_id){
		$update['send_to_comp'] = 1 ; 
		$update['updated_at'] = date('Y-m-d'); 
		$this->user->update('tbl_existing_certificate',$update,'id',$certificateTbl_id);
		$insurance_info = $this->db->get_where('tbl_existing_certificate',array('id'=>$certificateTbl_id))->row();
		$company 	= $this->db->get_where('tbl_user',array('id'=>$insurance_info->company_id))->row();
		$email 		= $company->username_email;
		$auth_code 	= $insurance_info->auth_code;
		$this->sendMail($email,'Got new insurance','<p>Dear company,<br/> <br/> Here is the authentication code : <b>'.$auth_code.'</b> for Insurance number : <b>'.$insurance_info->certificate_id.'</b> <br/><br/> Thanks, <br/> Team Car Insurance </p>');

		$this->session->set_flashdata('response', ['class'=>'success','msg'=>'Digital Insurance & authentication code successfully sent to your car insurance comapny. For Testing: '.$auth_code]);
		redirect(base_url('author/digital_insurance_listing'));
	}
	/*public function testmail(){
		//echo 'hi';exit;
		$send = $this->sendMail('test166@yopmail.com','Got new insurance','<p>Dear company,<br/> <br/> Here is the authentication code : <b>Testing Mail</b> <br/><br/> Thanks, <br/> Team Car Insurance </p>');
		if($send){
			echo 'send';

		}else{
			echo 'not send';
		}
	}*/

	
	public function digital_insurance_listing()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){ redirect('users'); }
		
		$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$company_id = end(explode('-',$udetails['under_provider']));

		$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Insurance Listing</h3></div>';
		$data['listing'] = $this->provider_model->list_insurance($company_id);

		$this->load->frontAdmin('broker/insurance_listing',$data);
	}	

	public function insurance_listing()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){ redirect('users'); }

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
		$this->form_validation->set_rules('age', 'Age', 'trim|required');
		$this->form_validation->set_rules('sex', 'Sex', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('mmodel', 'Car Model', 'trim|required');
		$this->form_validation->set_rules('vin', 'VIN', 'trim|required');
		// $this->form_validation->set_rules('regdate', 'Registration Date', 'trim|required');
		$this->form_validation->set_rules('carmake', 'Car Brand', 'trim|required');
		$this->form_validation->set_rules('insurance_no', 'Insurance Number', 'trim|required');
		$this->form_validation->set_rules('issued', 'Issued Date', 'trim|required');
		$this->form_validation->set_rules('validity', 'Validity Date', 'trim|required');
		
		if($this->form_validation->run() == FALSE):
			$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
			$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Insurance Listing</h3></div>';
			$data['listing'] = $this->provider_model->list_insurance($uid);
			
			if(validation_errors()!=''):
				$this->session->set_flashdata('response', ['class'=>'danger','msg'=>validation_errors()]);
			endif;
			// redirect(base_url('author/buy_insurance_listing'));
			// $this->load->frontAdmin('broker/insurance_listing',$data);
		else:
			$post = $this->input->post();
			// echo '<pre>'; print_r($post['buyer_id']); die;
			$buyer_id  	=	$post['buyer_id'];
			
			$update['name'] 	= $post['name'];
			$update['fname'] 	= $post['fname'];
			$update['lname'] 	= $post['lname'];
			$update['address'] 	= $post['address'];
			$update['dob'] 		= $post['dob'];
			// $update['country'] 	= $post['nationality'];
			$update['country'] 	= 99;
			$update['mobile'] 	= $post['mobile'];
			$update['age'] 		= $post['age'];
			$update['sex'] 		= $post['sex'];
			$update['updated_at'] = date('Y-m-d');
			$this->user->update('tbl_user',$update,'id',$buyer_id);


			$insert['user_id'] 		= 	$buyer_id;
			$insert['company_id'] 	= 	$post['company_id'];
			// $insert['type'] 		= 	$post['company_id'];
			// $insert['certificate_id']= 	$post['insurance_id'];
			$insert['certificate_id'] 	= 	$post['insurance_no'];
			$insert['carmake'] 			= 	$post['carmake'];
			$insert['mmodel'] 			= 	$post['mmodel'];
			$insert['vin'] 				= 	$post['vin'];
			// $insert['regdate'] 			= 	$post['regdate'];
			$insert['certificate_img'] 	= 	$post['insurance_no'].'.pdf';
			$insert['issue_date'] 		= 	$post['issued'];
			$insert['validity'] 		= 	$post['validity'];
			$insert['bi_id'] 			= 	$post['bi_id'];
			$insert['auth_code'] 		= 	$post['auth_code'];
			$insert['status'] 			= 	1;
			$insert['send_to_rt'] 		= 	0;
			$insert['added_on'] 		= 	date('Y-m-d');

			$result = $this->provider_model->add_insurance($insert);
			
			if($result):
				$this->generate_insurance($insert);
				$updateIns['certificate_status'] = 1; 
				$updateIns['updated_at'] = date('Y-m-d'); 
				$this->user->update('tbl_buy_insurance',$updateIns,'bi_id',$post['bi_id']);
				$this->session->set_flashdata('response', ['class'=>'success','msg'=>'Digital Insurance Created Successfully.']);
			else:
				$this->session->set_flashdata('response', ['class'=>'danger','msg'=>'Something went wrong..']);
			endif;
		endif;
		redirect(base_url('author/buy_insurance_listing'));
	}
 	  
	function generate_insurance($pdfdata){
		// $pdfname = 'test'.time();
		$pdfname = $pdfdata['certificate_id'];
		$html = $this->get_insurance_pdf_html($pdfdata);
		$html.= $this->output->get_output();
		$this->load->library('Pdf');
		$this->dompdf = new DOMPDF();
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('letter','portrait');
		$this->dompdf->render();

		file_put_contents('assets/upload/pdf/'.$pdfname.'.pdf', $this->dompdf->output($html));
		// $this->dompdf->stream("school.pdf",array('Attachment'=>0)); die;
		//generate pdf end
		// echo '<div style="text-align:center;"><iframe src="'.base_url('assets/upload/pdf/'.$pdfname.'.pdf').'" style="height:800px;width:650px;" title="Iframe Example"></iframe></div>';
		
	}
	public function get_insurance_pdf_html($pdfdata){
		$uid = $this->session->userdata('logged_in')['id'];
		$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();

		$data['owner'] 		= $udetails['name'].' '.$udetails['fname'].' '.$udetails['lname'];
		$data['make'] 		= $pdfdata['carmake'];
		$data['model'] 		= $pdfdata['mmodel'];
		$data['vin'] 		= $pdfdata['vin'];
		$data['issue_date'] = $pdfdata['issue_date'];
		$data['validity'] 	= $pdfdata['validity'];
		$data['insurance_no'] = $pdfdata['certificate_id'];
		$result = $this->load->view('certificateoftitlepdf',$data, TRUE);
		return $result;
	}

	public function edit_insurance($id=false)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){ redirect('users'); }

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		// $this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('insurance_type', 'insurance_type', 'trim|required');
	
		
		if($this->form_validation->run() == FALSE):
			$data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
			$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Edit Insurance</h3></div>';
			$data['row'] = $this->provider_model->get_one_sale_insurance($id);
		// echo '<pre>'; print_r($data['row']); die;
			$this->load->frontAdmin('broker/edit_insurance',$data);
		else:
			
			$this->load->library('upload'); 
			if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
				$config['upload_path'] = './assets/images/uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2000000';       
				$ext = explode('.',$_FILES["image"]["name"]);        
				$imageName = 'Ins_'.time().'.'.end($ext);
				$config['file_name'] = $imageName;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('image'))
				{
					$this->session->set_flashdata('response', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}  
				$data['course_photo'] = $imageName;
			}
				
			$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
			$provider_id            = end(explode('-',$udetails['under_provider']));
			$data['author_reference_id'] = $provider_id;
			$data['course_title'] 	= $this->input->post('course_title');
			$data['price']        	= $this->input->post('price');
			$data['insurance_type'] = $this->input->post('insurance_type');
			$data['status']  		= $this->input->post('status');
			$data['user_id']  		= $uid;
			$data['expiry_on']  	= date('Y-m-d'); //expiry_on is used as updated date
			$id = $this->input->post('id');

			$result = $this->provider_model->update_insurance_sale($id,$data);
		
			if($result):
				$this->session->set_flashdata('response', '<div class="alert alert-success">updated successfully.</div>');
			else:
				$this->session->set_flashdata('response', '<div class="alert alert-danger">Something went wrong.</div>');
			endif;
			redirect(base_url('author/insurance_for_sale'));
		endif;
	}
 	  
	  
	public function delete_insurance($id)
	{
		$result = $this->provider_model->delete_sale($id);
		if($result):
			$this->session->set_flashdata('response', '<div class="alert alert-success">deleted successfully.</div>');
		else:
			$this->session->set_flashdata('response', '<div class="alert alert-danger">Something went wrong.</div>');
		endif;
		redirect(base_url('author/insurance_for_sale'));

	}

	public function checkcourselogin()
	{
		$courseid = $this->session->userdata('current_course_id');
		if($courseid=="" && $this->uri->segment(3)==""){
		redirect('author/overview');
		}
	}  
	  
	public function overview()
	{ 
		$uid = $this->session->userdata('logged_in')['id'];
		$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		if($udetails['under_insititution'] == 1){
			redirect('author/course_listing'); die();
		}
		$parentdetails = $this->db->get_where('tbl_user',array('id'=>$udetails['parent_insititution']))->row_array();
		// echo $this->db->last_query();
		$this->session->unset_userdata('current_course_id');
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('course_title', 'Course Title', 'trim|required');
		$this->form_validation->set_rules('units', 'Units', 'trim|required');
		// $this->form_validation->set_rules('acceditation_validity', 'Acceditation Validity', 'trim|required');
		//$this->form_validation->set_rules('acceditation_no', 'Course Acceditation No', 'trim|required');
		//$this->form_validation->set_rules('course_validity', 'Course Validity', 'trim|required');
		//$this->form_validation->set_rules('profession', 'Profession', 'trim|required');
		//$this->form_validation->set_rules('cpdprovider', 'CPD Provider', 'trim|required');
		//$this->form_validation->set_rules('prc_acceditation_no', 'PRC Acceditation No', 'trim|required');

		if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ 
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
		}
		if (empty($_FILES['image']['name'])){
		 $this->form_validation->set_rules('image', 'Course Photo', 'trim|required');
		}

		$this->form_validation->set_rules('course_description', 'Course Description', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
		    $data['profession'] = $this->db->order_by('cat_name','ASC')->get_where('tbl_category',array('status'=>1))->result_array();
		    $data['userdetails'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			$this->load->frontAdmin('author/overview',$data);
		}else{
				$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
				$provider_det = $this->db->get_where('tbl_user',array('id'=>$udetails['parent_insititution']))->row_array();
			
				if(isset($_FILES["video"]) && !empty($_FILES["video"]['name'])){
				$config1['upload_path'] = './assets/images/uploads/';
				$config1['allowed_types'] = 'mp4';
				$config1['max_size'] = '1000000000000000';
		//		$config['max_width']  = '1500';
		//		$config['max_height']  = '800';        
				$ext = explode('.',$_FILES["video"]["name"]);        
				$imageName = 'VID_'.time().'.'.end($ext);
				$config1['file_name'] = $imageName;
				$this->load->library('upload', $config1);
				$this->upload->initialize($config1);
				if ( ! $this->upload->do_upload('video'))
				{
				// $error = array('error' => $this->upload->display_errors());   
				// 	echo '<pre>'; print_r($error); die;                    
				}  
				$data['course_video'] = $imageName;
				}
			
		      if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
				$config['upload_path'] = './assets/images/uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '200000';
				$config['max_width']  = '15000';
				$config['max_height']  = '8000';        
				$ext = explode('.',$_FILES["image"]["name"]);        
				$imageName = 'IMG_'.time().'.'.end($ext);
				$config['file_name'] = $imageName;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('image')){
						$error = array('error' => $this->upload->display_errors());                       
					}  
				$data['course_photo'] = $imageName;
				}

				if($parentdetails['insititution_id']==''){
					$ins_id_for_author_course = 0;
				}else{
					$ins_id_for_author_course = $parentdetails['insititution_id'];
				}
				if(empty($this->input->post('price'))){
					$price = 0;
				}else{
					$price 			= $this->input->post('price');
					$data['tax'] 	= $this->input->post('tax');
					$data['total']  = $this->input->post('total');
				}

				$cat = $this->input->post('category');
				$category = $this->user->get_record_by_field_name_all_record('tbl_category','cat_name',$cat);
				
				$data['course_title']          		= ucwords($this->input->post('course_title'));
				$data['units']                 		= $this->input->post('units');
				// $data['course_acceditation_number'] = $this->input->post('acceditation_no');
				// $data['course_validity']       		= $this->input->post('course_validity');
				$data['profession'] 		   		= implode(', ',(array)$this->input->post('profession'));
				$data['cpdprovider'] 		   		= $this->input->post('cpdprovider');
				$data['prc_acceditation_number']    = $this->input->post('prc_acceditation_no');
				$data['acceditation_validity'] 		= $this->input->post('acceditation_validity');
				$data['course_description']    		= $this->input->post('course_description');
				$data['user_id']               		= $this->session->userdata('logged_in')['id'];

				$data['course_category']    		= $category[0]['id'];
				$data['price']        				= $price;
				$data['objective']   	 			= $this->input->post('objective');
				$data['status']       				= 3;
				$data['course_for']       			= 'a'; //course for author
				$data['added_on']     				= date('Y-m-d');
				$data['expiry_on']    				= date('Y-m-d', strtotime("+30 days"));
				$data['country_id']      			= $this->session->userdata('logged_in')['country'];
				$data['insititution_id']       		= $ins_id_for_author_course;
				
				$filterProId                     	= end(explode('-',$udetails['under_provider']));
				$data['author_reference_id']   		= $filterProId;
				// echo'<pre>';print_r($data);die;
				$result = $this->user->save('tbl_course',$data);
				// echo'<pre>';print_r($this->db->last_query());die;

				if($result){
					$this->session->set_userdata('current_course_id', $result);
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Overview created successfully.</div>');
					redirect('author/lesson');
				} else {
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
					redirect('author/overview');
				}
	    }
	}





	public function lesson()
	{ 
        $this->checkcourselogin(); 
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('summary', 'Summary', 'trim|required');  
		// $this->form_validation->set_rules('references', 'References', 'trim|required');  
		if($this->form_validation->run() == FALSE)
		{
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['lesson'] = $this->user->get_lesson($uid);

			 
			$this->load->frontAdmin('author/lesson',$data); 		
		}  else {


			$ldata = $this->input->post('lesson_title');
			$tot = count($ldata); 
		
			for ($i=0; $i < $tot; $i++) { 
				
			$data['course_id']          = $this->session->userdata('current_course_id');

			$data['user_id']            = $uid;


		  if(isset($_FILES["lesson_video"]['name'][$i]) && !empty($_FILES["lesson_video"]['name'][$i])){
			$config['upload_path'] = './assets/images/uploads/video/';
			$config['allowed_types'] = 'mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["lesson_video"]["name"][$i]);        
			$imageName = 'VID_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;


			
			$this->load->library('upload', $config);
			//if ( ! $this->upload->do_upload('lesson_video'))

		  foreach($_FILES['lesson_video'] as $attr => $values) {
            $_FILES[$fld][$attr] = $values[$i];
          }



			if (!$this->upload->do_upload($fld))	
			{
			   $error = array('error' => $this->upload->display_errors());  		         
			}  
			$data['lesson_video'] = $imageName;
			}



			$data['lesson_title'] 		= $this->input->post('lesson_title')[$i]; 
			//$data['lesson_video'] 		= $this->input->post('lesson_video')[$i]; 
			$data['lesson_content'] 	= $this->input->post('lesson_content')[$i]; 
			$data['case_study']         = $this->input->post('case_study')[$i]; 
			$data['summary'] 			= $this->input->post('summary'); 
			$data['course_references']  = $this->input->post('references'); 
			$data['added_on'] 			= date('Y-m-d H:i:s'); 

			$result = $this->user->save('tbl_lesson',$data);

			}	

			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Lesson created successfully.</div>');
				redirect('author/quiz');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/overview');
			}

	}
 

	}


	public function lesson_edit($cid,$lid=false)
	{

		//$this->checkcourselogin(); 
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('summary', 'Summary', 'trim|required');  
		// $this->form_validation->set_rules('references', 'References', 'trim|required');  

		if($this->form_validation->run() == FALSE)
		{
			//$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			$data['lesson'] = $this->db->get_where('tbl_lesson',array('user_id'=>$uid,'course_id'=>$cid))->result_array();
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('author/lesson_edit',$data); 		
		}else{
			// echo'<pre>'; print_r($this->input->post());die;
			$ldata = $this->input->post('lesson_title');
			$lid =  $this->input->post('lidd'); 
			$tot = count($ldata); 
		
		for ($i=0; $i < $tot; $i++) { 

		if(isset($_FILES["lesson_video"]['name'][$i]) && !empty($_FILES["lesson_video"]['name'][$i])){
			$config['upload_path'] = './assets/images/uploads/video/';
			$config['allowed_types'] = 'mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["lesson_video"]["name"][$i]);        
			$imageName = 'VID_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;

			$this->load->library('upload', $config);
			//if ( ! $this->upload->do_upload('lesson_video'))

			foreach($_FILES['lesson_video'] as $attr => $values) {
	            $_FILES[$fld][$attr] = $values[$i];
	        }

			if (!$this->upload->do_upload($fld))	
			{
			   $error = array('error' => $this->upload->display_errors());  		         
			}  
			$data['lesson_video'] = $imageName;
		}

			if($lid > 0){
			
			$lessionarr = array(
				'lesson_title' 		=> $this->input->post('lesson_title')[$i],
				// 'lesson_video' 		=> $data['lesson_video'],
				'lesson_content' 	=> $this->input->post('lesson_content')[$i],
				'case_study' 		=> $this->input->post('case_study')[$i],
				'summary' 			=> $this->input->post('summary'),
				'course_references' => $this->input->post('references')			);
				$this->user->update('tbl_lesson',$lessionarr,'id',$lid);	
				$result = $lid; 
			}else{
				$lessionarr = array(
				'course_id'			=> $cid,
				'user_id'			=> $uid,
				'lesson_title' 		=> $this->input->post('lesson_title')[$i],
				// 'lesson_video' 		=> $data['lesson_video'],
				'lesson_content' 	=> $this->input->post('lesson_content')[$i],
				'case_study' 		=> $this->input->post('case_study')[$i],
				'summary' 			=> $this->input->post('summary'),
				'course_references' => $this->input->post('references'),
				// 'status' 			=> '1',
				// 'added_on'			=> date('Y-m-d H:i:s')
				);
				$result = $this->user->save('tbl_lesson',$lessionarr);	
				// echo $this->db->last_query(); exit;
			}

			}
			// echo $this->db->last_query();
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Lesson updated successfully.</div>');
				redirect('author/lesson_edit/'.$cid);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/lesson_edit/'.$cid.'/'.$lid.'');
			}
	    }
	}


	public function lesson_edit_old($cid,$lid=false)
	{
		//$this->checkcourselogin(); 
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('summary', 'Summary', 'trim|required');  
		// $this->form_validation->set_rules('references', 'References', 'trim|required');  
	if($this->form_validation->run() == FALSE)
	{
		$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
		$data['lesson'] = $this->db->get_where('tbl_lesson',array('user_id'=>$uid,'course_id'=>$cid))->result_array();
		$this->load->frontAdmin('author/lesson_edit',$data); 		
	}else{
			$ldata = $this->input->post('lesson_title');
			$tot = count($ldata); 
		//for ($i=0; $i < $tot; $i++) { 		
		//	$data['course_id']          = $this->session->userdata('current_course_id');
		//	$data['user_id']            = $uid;
		if(isset($_FILES["lesson_video"]['name'][$i]) && !empty($_FILES["lesson_video"]['name'][$i])){
			$config['upload_path'] = './assets/images/uploads/video/';
			$config['allowed_types'] = 'mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["lesson_video"]["name"][$i]);        
			$imageName = 'VID_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;

			$this->load->library('upload', $config);
				if (!$this->upload->do_upload($fld))	
				{
				   $error = array('error' => $this->upload->display_errors());  		         
				}  
			$data['lesson_video'] = $imageName;
			}

			$data['lesson_title'] 		= $this->input->post('lesson_title'); 
			//$data['lesson_video'] 	= $this->input->post('lesson_video')[$i]; 
			$data['lesson_content'] 	= $this->input->post('lesson_content'); 
			$data['case_study']         = $this->input->post('case_study'); 
			$data['summary'] 			= $this->input->post('summary'); 
			$data['course_references']  = $this->input->post('references'); 
			//$data['added_on'] 			= date('y-m-d h:i:s'); 
			$lid =  $this->input->post('lidd'); 
			/*echo $lid;
			echo '<pre>';
			print_r($data);
			die;*/

			if(empty($lid)){
				$data['course_id']  = $cid; 
				$data['user_id']  	= $uid; 
				$result = $this->user->save('tbl_lesson',$data);
			}else{
				$result = $this->user->update('tbl_lesson',$data,'id',$lid);
			}

			//}				
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Lesson updated successfully.</div>');
				// redirect('author/lesson_edit/'.$cid.'/'.$lid.'');
				redirect('author/lesson_edit/'.$cid);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/lesson_edit/'.$cid.'/'.$lid.'');
			}
	    }
	}

	 public function lesson_delete($cid,$lid)
	{ 

		$result = $this->user->delete('tbl_lesson','id',$lid); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Lesson deleted successfully.</div>');
				redirect('author/lesson_edit/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/lesson_edit/'.$cid.'');
			}

		die;
	}

	public function quiz()
	{

		$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_rules('retek', 'Retek', 'trim|required');  
		$this->form_validation->set_rules('passing_marks', 'Passing Marks', 'trim|required');  

		if($this->form_validation->run() == FALSE)
		{
			 
		$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
		$data['lesson'] = $this->user->get_lesson($uid);
		$this->load->frontAdmin('author/quiz',$data);
		
		}  else {

			$ldata = $this->input->post('question_title');
			$tot = count($ldata); 


			$data1['quiz_retek'] 		= $this->input->post('retek'); 
			$data1['passing_marks'] 	= $this->input->post('passing_marks'); 
			$data1['course_exam_note'] 	= $this->input->post('quiz_description'); 
			$course_id                  = $this->session->userdata('current_course_id');
		    $this->user->update('tbl_course',$data1,'id',$course_id); 
		


			for ($i=0; $i < $tot; $i++) { 
			$data['question_title'] = $this->input->post('question_title')[$i];
			$data['answere1'] = $this->input->post('answere1')[$i];
			$data['answere2'] = $this->input->post('answere2')[$i];
			$data['answere3'] = $this->input->post('answere3')[$i];
			$data['answere4'] = $this->input->post('answere4')[$i];
			$data['correct_answere'] = $this->input->post('correct_answere')[$i];
			$data['rational'] = $this->input->post('rational')[$i];
			$data['status'] = 1;
			$data['course_id'] = $this->session->userdata('current_course_id');
				$result = $this->user->save('tbl_quiz_question',$data);
			}

			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Quiz created successfully.</div>');
				redirect('author/certificate');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/quiz');
			} 


		}

	}

	
	public function edit_quiz($cid,$qid=false)
	{	

		  $cid1 = $this->input->post('course_idd');
	 	  $cid = $cid1;
		//$this->checkcourselogin();
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_rules('retek', 'Retek', 'trim|required');   
		if($this->form_validation->run() == FALSE)
			{
					
		    $cid1 = $this->uri->segment(3);
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid1);
			$data['quiz'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_quiz_question','course_id',$cid1);
			
			$this->load->frontAdmin('author/edit_quiz',$data);
		}  else {
				
			$ldata = $this->input->post('question_title'); 

			$tot = count($ldata); 


			$data1['quiz_retek'] 	= $this->input->post('retek'); 
			$data1['passing_marks'] = $this->input->post('passing_marks'); 
			$data1['course_exam_note'] 	= $this->input->post('quiz_description'); 

			$course_id              = $cid;
		    $this->user->update('tbl_course',$data1,'id',$course_id); 
			/* 
			$result = $this->user->delete('tbl_quiz_question','course_id',$cid);  */
		if($qid == '')
		{

			for ($i=0; $i < $tot; $i++) { 
				if($this->input->post('question_title')[$i] !=""){
				$data11['question_title'] = $this->input->post('question_title')[$i];
				$data11['answere1'] = $this->input->post('answere1')[$i];
				$data11['answere2'] = $this->input->post('answere2')[$i];
				$data11['answere3'] = $this->input->post('answere3')[$i];
				$data11['answere4'] = $this->input->post('answere4')[$i];
				$data11['correct_answere'] = $this->input->post('correct_answere')[$i];
				$data11['rational'] = $this->input->post('rational')[$i];
				$data11['status'] = 1;
				$data11['course_id']          = $cid;
				$result = $this->user->save('tbl_quiz_question',$data11);
				}
			}
		}
			$quizeq['question_title'] = $this->input->post('uquestion_title');
			$quizeq['answere1'] = $this->input->post('uanswere1');
			$quizeq['answere2'] = $this->input->post('uanswere2');
			$quizeq['answere3'] = $this->input->post('uanswere3');
			$quizeq['answere4'] = $this->input->post('uanswere4');
			$quizeq['correct_answere'] = $this->input->post('ucorrect_answere');
			$quizeq['rational'] = $this->input->post('urational');
			$quizeq['course_id'] = $cid;
		
			$result = $this->user->update('tbl_quiz_question',$quizeq,'id',$qid);
		
			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('author/edit_quiz/'.$cid);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/edit_quiz/'.$cid.'/'.$qid.'');
			} 

		}		
	}

	public function update_quiz($cid,$qid)
	{
		$quizeq['question_title'] = $this->input->post('question_title');
		$quizeq['answere1'] = $this->input->post('answere1');
		$quizeq['answere2'] = $this->input->post('answere2');
		$quizeq['answere3'] = $this->input->post('answere3');
		$quizeq['answere4'] = $this->input->post('answere4');
		$quizeq['correct_answere'] = $this->input->post('correct_answere');
		$quizeq['rational'] = $this->input->post('rational');
		$quizeq['course_id'] = $cid;
		
		$result = $this->user->update('tbl_quiz_question',$quizeq,'id',$qid);
			redirect('author/edit_quiz/'.$cid.'');		
	}


	public function edit_evaluation($cid=false,$eid=false)
	{		
		$uid = $this->session->userdata('logged_in')['id'];
		$cid1 = $this->input->post('course_idd');
		if(!empty($cid1)){ $cid = $cid1; }
		//$this->checkcourselogin();
		$this->form_validation->set_rules('rating', 'Rating', 'trim'); 
		if($this->form_validation->run() == FALSE)
		{
			$cid1 = $this->uri->segment(3);  
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid1);
			$data['evaluation'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_evaluation','course_id',$cid1);
			$this->load->frontAdmin('author/edit_evaluation',$data);
		}else{ 
			// print_r($this->input->post());die;
		// $result = $this->user->delete('tbl_evaluation','course_id',$cid); 
			if($this->input->post('question_old') !=''){
				$question_old = $this->input->post('question_old');
				foreach ($question_old as $key => $value) {
				if($value !=""){
				$id = $this->input->post('id')[$key];
				$data['course_id']           = $cid;
				$data['evaluation_question'] = $value;
				$data['evaluation_type'] 	 = $this->input->post('evaluation_type_old')[$key];
				$data['status']              = 1;
				$result_old = $this->user->update('tbl_evaluation',$data,'id',$id); 
					}
				}
			} 

			if($this->input->post('question') !=''){
				$question = $this->input->post('question');
				foreach ($question as $key => $value) {
				if($value !=""){
				$data['course_id']           = $cid;
				$data['evaluation_question'] = $value;
				$data['evaluation_type'] 	 = $this->input->post('evaluation_type')[$key];
				$data['status']              = 1;
				$result = $this->user->save('tbl_evaluation',$data); 
					}
				} 
			} 
	

		$data1['rating'] =  $this->input->post('rating'); 
		$data1['course_evaluation_note'] =  $this->input->post('evaluation_description');
		$result1 = $this->user->update('tbl_course',$data1,'id',$cid); 


//	$data['prof_name'] 		= $this->input->post('prof_name'); 
			
			 //$result = $this->user->update('tbl_course',$data,'id',$cid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('author/edit_evaluation/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/edit_evaluation/'.$cid.'');
			} 

		}		
	}


public function evaluationdelete($idd,$tid)
	{ 
		
		$result = $this->user->delete('tbl_evaluation','id',$idd); 
		//echo $this->db->last_query(); die;
	   //  $result = $this->uri->segment(4);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training evaluation deleted successfully.</div>');
				redirect('author/edit_evaluation/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/edit_evaluation/'.$tid.'');
			}

		die;
	}

public function evaluation()
	{
		$this->checkcourselogin();

		$question = $this->input->post('question');
		if(count($question) > 0){
			foreach ($question as $key => $value) {
				if($value !=""){
				$data['course_id']           = $this->session->userdata('current_course_id');
				$data['evaluation_question'] = $value;
				$data['evaluation_type'] 	 = $this->input->post('evaluation_type')[$key];
				$data['status']              = 1;
				$result = $this->user->save('tbl_evaluation',$data); 
				}
			} 
		}
	
 	    $data1['rating'] =  $this->input->post('rating'); 
 	    $data1['course_evaluation_note'] =  $this->input->post('evaluation_description'); 
 		$result1 = $this->user->update('tbl_course',$data1,'id',$this->session->userdata('current_course_id')); 

		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Evaluation created successfully.</div>');

		$uid = $this->session->userdata('logged_in')['id']; 
	  	$uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
	  	$up_id = end(explode('-', $uprovider)); 
	  	$uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
	 		if($uins == '0'){
				redirect('author/promotion');
			}else{
				redirect('author/publish');
			}
		} 
	    $this->load->frontAdmin('author/evaluation');
	}

	public function get_certificate_temp(){
		$category = $_POST['category'];
		$signature = $_POST['signature'];
		if($_POST['category'] != ''){ 
			$this->db->where('category',$category); }
		if($_POST['signature'] != ''){
			$this->db->where('numberofsignature',$signature); }
			$this->db->where('status',1);
		$result = $this->db->get('tbl_certificate_template')->result();
		// echo $this->db->last_query();
		
		print_r(json_encode($result));
	}

	public function certificate()
	{	
		// ini_set('display_startup_errors', 1);
		// ini_set('display_errors', 1);
		// error_reporting(-1);	

		$this->checkcourselogin();
		$this->load->library('upload'); 
		$uid = $this->session->userdata('logged_in')['id'];
	
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('category', 'Category', 'trim|required'); 
		$this->form_validation->set_rules('numsignature', 'Number of Signature', 'trim|required'); 
		$this->form_validation->set_rules('templete_id', 'Template', 'trim|required');
		$this->form_validation->set_rules('header_line1', 'Header Content', 'trim|required');
		$this->form_validation->set_rules('certificatetitle', 'Certificate Title', 'trim|required');
		$this->form_validation->set_rules('introText', 'Intro Text', 'trim|required');

		if($this->form_validation->run() == FALSE)
		{
			$data['templete'] = $this->user->get_templete_all_record('tbl_certificate_template','status','1');
			$this->load->frontAdmin('author/certificate',$data);
		}
		if($this->input->post('fileSubmit') != NULL )
		{
			$datas = array();
		// Count total files
			$countfiles = count($_FILES['files']['name']);
		// Looping all files
			for($i=0;$i<$countfiles;$i++)
			{
				if(!empty($_FILES['files']['name'][$i]))
				{
					// Define new $_FILES array - $_FILES['file']
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					// Set preference
					$config['upload_path'] = './assets/upload/certificate/signature/'; 
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '5000'; // max_size in kb
		            $ext = explode('.',$_FILES["files"]["name"][$i]);        
		            $imageName = 'sig_'.time().'.'.end($ext);
					$config['file_name'] = $imageName;

					//Initialize config
					$this->upload->initialize($config);
					// File upload
					if($this->upload->do_upload('file'))
						{
						// Get data about the file
							$uploadData = $this->upload->data();
							$filename = $uploadData['file_name'];
						// Initialize array
							$updatess[] = $filename;
						}
				}
			}
			$datas['signature'] = implode('##',$updatess);
		}
		if($this->input->post()){

			if(isset($_FILES["logo1"]) && !empty($_FILES["logo1"]['name']))
			{
	            $config1['upload_path'] 		= './assets/upload/certificate/logo/';
	            $config1['allowed_types'] 	= 'gif|jpg|png|jpeg';
	            $config1['max_size'] 		= '200000';
	            $config1['max_width']  		= '15000';
	            $config1['max_height']  	= '8000';        
	            $ext = explode('.',$_FILES["logo1"]["name"]);        
	            $imageName = 'log1_'.date('Y').'.'.end($ext);
	            $config1['file_name'] = $imageName;
				$this->upload->initialize($config1);
		        if ( ! $this->upload->do_upload('logo1'))
		        {
		        	$error = array('error' => $this->upload->display_errors());                       
		        }  
	            	$datas['logo1'] = $imageName;
	        }

	        if(isset($_FILES["logo2"]) && !empty($_FILES["logo2"]['name']))
			{
	            $config2['upload_path'] 		= './assets/upload/certificate/logo/';
	            $config2['allowed_types'] 	= 'gif|jpg|png|jpeg';
	            $config2['max_size'] 		= '200000';
	            $config2['max_width']  		= '15000';
	            $config2['max_height']  	= '8000';        
	            $ext = explode('.',$_FILES["logo2"]["name"]);        
	            $imageName = 'log2_'.time().'.'.end($ext);
	            $config2['file_name'] = $imageName;
				$this->upload->initialize($config2);
		        if ( ! $this->upload->do_upload('logo2'))
		        {
		        	$error = array('error' => $this->upload->display_errors());                       
		        }  
	            	$datas['logo2'] = $imageName;
	        }
	        $cid = $this->input->post('course_id');
			// $data = array(); 
			$name = $this->input->post('name');
			$position = $this->input->post('position');

			$datas['user_id']			=  $this->input->post('user_id');  
			$datas['course_id']			=  $this->input->post('course_id');
			$datas['course_title']		=  $this->input->post('course_title');
			$datas['category']			=  $this->input->post('category'); 
			$datas['num_signature']		=  $this->input->post('numsignature'); 
			$datas['templete_id']		=  $this->input->post('templete_id'); 
			$datas['header_line1']		=  $this->input->post('header_line1'); 
			$datas['header_line2']		=  $this->input->post('header_line2'); 
			$datas['header_line3']		=  $this->input->post('header_line3'); 
			$datas['title']				=  $this->input->post('certificatetitle'); 
			$datas['intro_Text']		=  $this->input->post('introText'); 
			$datas['name']				=  implode('##',$name); 
			$datas['position']			=  implode('##',$position);
			$datas['added_at']			=  date('Y-m-d');
			// echo'<pre>'; print_r($datas);
			 $this->db->insert('tbl_user_certificate',$datas);
			 $certificate = $this->db->insert_id();
			
			if($certificate){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate successfully addedd.</div>');
				redirect('author/evaluation');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/certificate');
			} 
		}
	}



	public function publish($cid=fasle)
	{
		$this->checkcourselogin();
		if($cid==""){
		$cid = $this->session->userdata('current_course_id');
		}

		$uid = $this->session->userdata('logged_in')['id'];
		$this->load->frontAdmin('author/publish',$cid);
	}	



	public function successedit()
	{
		$cid = $this->uri->segment(3);
		$data['status'] = 0;
		$result1 = $this->user->update('tbl_course',$data,'id',$cid); 
		// echo $this->db->last_query();die;
		$this->load->frontAdmin('author/success',$cid);
	}
	public function saveedit()
	{

		$cid = $this->uri->segment(3);
		
		$data['status'] = 3;
	
		$result1 = $this->user->update('tbl_course',$data,'id',$cid);
		$this->load->frontAdmin('author/save',$cid);
	}

	public function success()
	{
		$cid = $this->session->userdata('current_course_id');
		$data['status'] = 0;
		$result1 = $this->user->update('tbl_course',$data,'id',$cid); 
		$this->load->frontAdmin('author/success',$cid);
	}

	public function save()
	{
		$cid = $this->session->userdata('current_course_id');
		
		$data['status'] = 3;
	
		$result1 = $this->user->update('tbl_course',$data,'id',$cid);
		$this->load->frontAdmin('author/save',$cid);
	}




   	public function course_listing()
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$filter 		= ($this->uri->segment(3) > 0 )?$this->uri->segment(3):'';
			$data['course'] = $this->user->get_course($uid,$filter); 
			$data['filter'] = $filter;
			$this->load->frontAdmin('author/course_listing',$data);
	}

	public function course_view($id)
	{		
			$uid 			= $this->session->userdata('logged_in')['id'];
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
			$data['lesson'] = $this->user->get_record_by_field_name_all_record('tbl_lesson','course_id',$id);
			$data['quiz'] 	= $this->user->get_record_by_field_name_all_record('tbl_quiz_question','course_id',$id);
			$data['report'] = $this->user->get_record_by_field_name_all_record('tbl_abuse_report','course_id',$id);
			$this->db->where('tbl_exam.certificate_id !=',"");
			$data['exam'] = $this->user->get_record_by_field_name_all_record('tbl_exam','course_id',$id);
			
			$cid=$id;
			$fivestar = $this->db->query('SELECT AVG(star_mark)as star_mark  FROM tbl_course_review WHERE course_id = '.$cid.'');
			$data['star'] = $fivestar->result_array();
		
			$this->db->order_by('id', 'DESC');
			$this->db->from('tbl_course_review');
			$this->db->where('course_id',$cid);
			$this->db->limit(5);
			$data['evaluation'] = $this->db->get()->result_array();
			
			$this->load->frontAdmin('author/course_view',$data);
	}

	


	 public function course_delete($idd)
	{ 
	 
		$result = $this->user->delete('tbl_course','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Course deleted successfully.</div>');
				redirect('author/course_listing');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/course_listing');
			}

		die;
	}





public function course_edit($cid)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$parentdetails = $this->db->get_where('tbl_user',array('id'=>$udetails['parent_insititution']))->row_array();
		
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('course_title', 'Course Title', 'trim|required');
		// $this->form_validation->set_rules('units', 'Units', 'trim|required');
		// $this->form_validation->set_rules('course_validity', 'Course Validity', 'trim|required');
		// $this->form_validation->set_rules('acceditation_no', 'Course Acceditation No', 'trim|required');
		// $this->form_validation->set_rules('profession', 'Profession', 'trim|required');
		// $this->form_validation->set_rules('cpdprovider', 'CPD Provider', 'trim|required');
		// $this->form_validation->set_rules('prc_acceditation_no', 'PRC Acceditation No', 'trim|required');
		// $this->form_validation->set_rules('acceditation_validity', 'Acceditation Validity', 'trim|required');

		/*if (empty($_FILES['image']['name'])){
		 $this->form_validation->set_rules('image', 'Course Photo', 'trim|required');
		}*/
		if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ 
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
		}
		$this->form_validation->set_rules('course_description', 'Course Description', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
		    $data['profession'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
		    $data['userdetails'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		    $data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			$this->load->frontAdmin('author/edit_overview',$data);
		
		}  else {
			$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
			$provider_det = $this->db->get_where('tbl_user',array('id'=>$udetails['parent_insititution']))->row_array();
		
			$this->load->library('upload');
	      // print_r($this->input->post());die;
	      if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('image'))
			{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
					redirect('author/course_edit/'.$cid.'');                      
			}  
			$data['course_photo'] = $imageName;
			}
			if($parentdetails['insititution_id']==''){
				$ins_id_for_author_course = 0;
			}else{
				$ins_id_for_author_course = $parentdetails['insititution_id'];
			}
			if(empty($this->input->post('price'))){
				$price = 0;
			}else{
				$price 			= $this->input->post('price');
				$data['tax'] 	= $this->input->post('tax');
				$data['total']  = $this->input->post('total');
			}

            if(isset($_FILES["video"]) && !empty($_FILES["video"]['name'])){
				$config1['upload_path'] 	= './assets/images/uploads/';
				$config1['allowed_types'] 	= 'mp4';
				$config1['max_size'] 		= '9000000000';
			  
				$ext = explode('.',$_FILES["video"]["name"]);        
				$imageName = 'VID_'.time().'.'.end($ext);
				$config1['file_name'] = $imageName;
				$this->upload->initialize($config1);
				if ( ! $this->upload->do_upload('video'))
				{
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
					redirect('author/course_edit/'.$cid.'');
				}
				$data['course_video'] = $imageName;
				
			}
			$data['course_title']          		= ucwords($this->input->post('course_title'));
			$data['units']                 		= $this->input->post('units');
			// $data['course_acceditation_number'] = $this->input->post('acceditation_no');
			// $data['course_validity']       		= $this->input->post('course_validity');
			$data['profession'] 		   		= implode(', ',(array)$this->input->post('profession'));
			$data['cpdprovider'] 		   		= $this->input->post('cpdprovider');
			$data['prc_acceditation_number']    = $this->input->post('prc_acceditation_no');
			$data['acceditation_validity'] 		= $this->input->post('acceditation_validity');
			$data['course_description']    		= $this->input->post('course_description');
			$data['user_id']               		= $this->session->userdata('logged_in')['id'];

			$data['course_category']    		= $this->input->post('category');
			$data['price']    					= $price;
			
			$data['objective']    				= $this->input->post('objective');
			$data['insititution_id']       		= $ins_id_for_author_course;
			// echo '<pre>';print_r($data);die;
		 

			$result = $this->user->update('tbl_course',$data,'id',$cid);
			// echo $result;die;
			$this->session->set_userdata('current_course_id', $cid);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Course updated successfully.</div>');
				redirect('author/course_edit/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/course_edit'.$cid.'');
			}
	  }
}






public function old_notification()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$this->db->where('to',$uid);
			$data['notification'] = $this->user->get_record_by_field_name_all_record('tbl_notification','status',1);
			
			$this->load->frontAdmin('author/notification',$data);
		
		}  else {  

			$uid = $this->session->userdata('logged_in')['id'];

			$data['subject'] 		= $this->input->post('subject');  
			$data['message'] 		= $this->input->post('message');  
			$data['user_id'] 		= $uid;  
			$data['added_on'] 		= date('y-m-d h:i:s');
			
		    $result = $this->user->save('tbl_notification',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Notification sent.</div>');
				redirect('author/notification');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/notification');
			} 
		}
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
			$this->load->front('car_company/change_password',$data); 
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
    	            redirect('author/change_password');  
	            }else{
    	            $this->session->set_flashdata('response','Problem updating password');
    	            redirect('author/change_password');
	            }
		
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Old Password does not match your existing password</div>');
			redirect('author/change_password');  
		}
	  
	 }
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
			$this->load->frontAdmin('broker/notification',$data);
		}else{  
			$uid = $this->session->userdata('logged_in')['id'];

			$data['subject'] 		= $this->input->post('subject');  
			$data['message'] 		= $this->input->post('message');  
			$data['user_id'] 		= $uid;  
			$data['added_on'] 		= date('y-m-d h:i:s');
			
			$result = $this->user->save('tbl_notification',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Notification sent.</div>');
				redirect('author/notification');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/notification');
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
	    $this->load->frontAdmin('broker/notification',$data); 
	}

	public function delete_notification($id){
		$result = $this->share->delete('tbl_notification',$id);
		if($result==true){
			$this->session->set_flashdata('response','<div class="alert alert-success">Notification deleted successfully!</div>');
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong please try again!</div>');
		}
		redirect('broker/notification');	
	}

	public function showMessage(){
		$idd =  $this->input->post('idd');

	    $data['notification'] = $this->share->get_row_array_where('tbl_notification',array('id'=>$idd));
	  
		$this->db->where('id',$idd);
		$this->db->update('tbl_notification',array('status'=>0));
	    $this->load->view('broker/notificationdata',$data); 
	}

 public function tutorials()
	{
		$ins = $this->session->userdata('logged_in')['under_insititution'];
		$provider = $this->session->userdata('logged_in')['under_provider'];
		if($ins==1){
		 	$type = 'authorInstitution'; 
		}elseif($ins!=1 && $provider!=''){
		 	$type = 'authorBusiness'; 
		}else{
			$type = 'authorCeonpoint'; 
		}
		$data['authors'] 	= $this->dashboards_model->get_tutorial($type);
		// $data['tutorials'] 		= $this->dashboards_model->get_tutorial();
		$this->load->frontAdmin('author/tutorials',$data);
	}
	
	
 public function terms()
	{
		$ins = $this->session->userdata('logged_in')['under_insititution'];
		$provider = $this->session->userdata('logged_in')['under_provider'];
		if($ins==1){
		 	$type = 'authorInstitution'; 
		}elseif($ins!=1 && $provider!=''){
		 	$type = 'authorBusiness'; 
		}else{
			$type = 'authorCeonpoint'; 
		}
		$data['terms']	= $this->dashboards_model->get_terms($type);
		// $data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$this->load->frontAdmin('author/terms',$data);
	}	

	public function enquiry()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');  
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{

			$this->load->frontAdmin('author/enquiry');
		
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
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Thank you for your messgae.</div>');
				redirect('author/enquiry');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/enquiry');
			} 
		}
	}







	public function editbg()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		// print_r($_FILES);
		$this->load->library('upload'); 
		$update = array();
		if(isset($_FILES["image"]['name']) && !empty($_FILES["image"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '20000000';
			// $config['max_width']  = '170';
			// $config['max_height']  = '170';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName = $ext[0].time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('image'))
			{
			$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
			  redirect('author/profile',$data);			
			}else{   
				
				$update['image'] = $imageName;
			}
		}

		if(isset($_FILES["backimage"]['name']) && !empty($_FILES["backimage"]['name'])){
			$ext="";
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2000000000';
			// $config['max_width']  = '1500';
			// $config['max_height']  = '540';
			$name = str_replace(' ','',$_FILES["backimage"]["name"]);        
			$ext = explode('.',$name);        
			$imageName = 'BG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('backimage'))
			{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
				redirect('author/profile');	                     
			} 
			$update['backimage'] = $imageName;
		}
		$result = $this->user->update('tbl_user',$update,'id',$uid);
		if($result){
			echo "<script>alert('Profile updated successfully.');
				window.location.href='profile';
				</script>";
		} else {
			echo "<script>alert('Please Add new Profile Image!');
				window.location.href='profile';
				</script>";
		} 

	}


	public function settings()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['author_details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$this->db->order_by('name','ASC');
		$data['provider_list'] = $this->db->get_where('tbl_user', array('role'=>2,'status'=>1))->result_array();
		$this->db->order_by('name','ASC');
		$data['institution_list'] = $this->db->get_where('tbl_user', array('role'=>5,'parent_insititution'=>0,'status'=>1))->result_array();
		$this->db->order_by('name','ASC');
		$data['sub_institution_list'] = $this->db->get_where('tbl_user', array('role'=>5,'parent_insititution !='=>0,'status'=>1))->result_array();
		
		if($this->input->post()){
			$update = array(
				'under_provider'=>$this->input->post('provider_code')
			);
		$result = $this->user->update('tbl_user',$update,'id',$uid);
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Provider successfully updated.</div>');
		}
                  
		$this->load->frontAdmin('author/settings',$data);
	 
	}



	public function edit_certificate($cid)
	{		
				
		$this->checkcourselogin();

		$this->load->library('upload'); 
		$uid = $this->session->userdata('logged_in')['id'];

		// $this->form_validation->set_rules('prof_name', 'Prof Name', 'trim|required');   

		if($this->form_validation->run() == FALSE)
		{
			 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			//$data['templete'] = $this->user->get_templete_all_record('tbl_certificate_template','status','1');
			$data['profile'] = $this->db->get_where('tbl_user',array('id'=>$uid))->result_array();
			$query = $this->db->get_where('tbl_user_certificate',array('user_id'=>$uid,'course_id'=>$cid));
			$data['certificate'] = $query->result_array();
			
			if(!empty($data['certificate']) && !empty($data['certificate'][0]['category'])){
				$this->db->where('category',$data['certificate'][0]['category']); 
				$this->db->where('numberofsignature',$data['certificate'][0]['num_signature']); 
			}
			$query = $this->db->where('status','1')->get('tbl_certificate_template');
			$data['templete'] = $query->result();

			// print_r($this->db->last_query());die;
			$this->load->frontAdmin('author/edit_certificate',$data);
		}  

		if($this->input->post('fileSubmit') != NULL )
		{
			$update = array();
		// Count total files
			$countfiles = count($_FILES['files']['name']);
		// Looping all files
			for($i=0;$i<$countfiles;$i++)
			{
				if(!empty($_FILES['files']['name'][$i]))
				{
					// Define new $_FILES array - $_FILES['file']
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					// Set preference
					$config['upload_path'] = './assets/upload/certificate/signature/'; 
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '5000'; // max_size in kb
		            $ext = explode('.',$_FILES["files"]["name"][$i]);        
		            $imageName = 'sig_'.time().'.'.end($ext);
					$config['file_name'] = $imageName;

					//Initialize config
					$this->upload->initialize($config);
					// File upload
					if($this->upload->do_upload('file'))
						{
						// Get data about the file
							$uploadData = $this->upload->data();
							$filename = $uploadData['file_name'];
						// Initialize array
							$updatess[] = $filename;
						}
					$update['signature'] = implode('##',$updatess);
				}
				
			}
			

		}

           
		if($this->input->post()){
			if(!empty($_FILES['logo1']['name'])) {				
						$config1['upload_path']      = './assets/upload/certificate/logo/';
						$config1['allowed_types']    = 'gif|jpg|png|jpeg';
						$ext 						= explode('.',$_FILES["logo1"]["name"]);        
						$logo1 						= 'logo1_'.time().'.'.end($ext);
						$config1['file_name'] 		= $logo1;
						$config1['max_size'] 		= '200000';
			            $config1['max_width']  		= '15000';
			            $config1['max_height']  	= '8000'; 

			            $this->upload->initialize($config1);
						$this->upload->do_upload('logo1');
						$photo = $this->upload->data();
						$update['logo1'] = $logo1;
				}
			if(!empty($_FILES['logo2']['name'])) {
			
					$config2['upload_path']      = './assets/upload/certificate/logo/';
					$config2['allowed_types']    = 'gif|jpg|png|jpeg';
					$ext 						= explode('.',$_FILES["logo2"]["name"]);        
					$logo2 						= 'logo2_'.time().'.'.end($ext);
					$config2['file_name'] 		= $logo2;
					$config2['max_size'] 		= '200000';
		            $config2['max_width']  		= '15000';
		            $config2['max_height']  	= '8000'; 
			        
			        $this->upload->initialize($config2);
					$this->upload->do_upload('logo2');
					$photo = $this->upload->data();
					$update['logo2'] = $logo2;
					// print_r($logo."yes");exit();
			}

			$name = $this->input->post('name');
			$position = $this->input->post('position');
			
			$id = $this->input->post('id');
			// $id = 27;
		 	if($update['signature']==''){
		 		unset($update['signature']);
		 	}
			$update['user_id']			=  $this->input->post('user_id');  
			$update['course_id']		=  $this->input->post('course_id');
			
			$update['course_title']		=  $this->input->post('course_title');
			$update['category']			=  $this->input->post('category'); 
			$update['num_signature']	=  $this->input->post('numsignature');
			$update['templete_id']		=  $this->input->post('templete_id'); 
			$update['header_line1']		=  $this->input->post('header_line1'); 
			$update['header_line2']		=  $this->input->post('header_line2'); 
			$update['header_line3']		=  $this->input->post('header_line3'); 
			$update['title']			=  $this->input->post('certificatetitle'); 
			$update['intro_Text']		=  $this->input->post('introText'); 
			$update['name']				=  implode('##',$name); 
			$update['position']			=  implode('##',$position);
			$update['updated_at']		=  date('Y-m-d');
			// print_r($update);die;
			if($id == ''){
				$certificate = $this->user->save('tbl_user_certificate',$update); 
			}else{
				$certificate = $this->user->update('tbl_user_certificate',$update,'id',$id); 
			}


			// echo $this->db->last_query();die;
			// print_r($update['signature']);die;
			if($certificate){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate successfully updated.</div>');
				redirect('author/edit_certificate/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again nutan.</div>');
				redirect('author/edit_certificate/'.$cid.'');
			}  
		}		
	}





public function edit_publish($cid)
	{
		//$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_rules('prof_name', 'Prof Name', 'trim|required');   

		if($this->form_validation->run() == FALSE)
		{
			 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			$this->load->frontAdmin('author/edit_publish',$data);
		}  else { 

			$data['prof_name'] 		= $this->input->post('prof_name'); 
			
			 $result = $this->user->update('tbl_course',$data,'id',$cid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('author/edit_publish/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/edit_publish/'.$cid.'');
			} 
		}		
	}






	public function author_profile($id)
	{
		$data['review'] = array();

		$this->db->where('user_id',$id);
		$data['allcourse'] = $this->user->seminarlist('tbl_course','status',1,$cat);

        // echo $this->db->last_query(); die;
        $this->db->where('user_id',$id);
		$data['seminar'] = $this->user->get_seminar('tbl_training','status',1,$dt); 
		//print_r($data);
		$this->load->frontAdmin('author/user_profile',$data);
	 
	}

	
 public function user_status($idd,$stts)
	{ 
		if($stts==1){
		 $data['status'] = 0; 
		} else {
		  $data['status'] =1;
		  $data['approval_date'] = date('Y-m-d');
		}
		
		$user_info = $this->user->get_record_by_field_name_all_record('tbl_user','id',$idd);

		$result = $this->user->update('tbl_user',$data,'id',$idd); 
			if($result){

				$this->sendMail($user_info[0]['username_email'],'Account Activation',$this->load->view('email/account_activation',$data,true));

				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Status updated successfully.</div>');
				redirect('provider/authors');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/authors');
			}
	}





	
	public function sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE)
	{ 


		$from = "mails@ceonpoint.com";
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


	public function updateinfo()
		{
			if($this->session->userdata('logged_in')['id'] == ''){
				redirect('users');
			}
			$this->load->library('upload');

			if($_POST){
				$profile_photo = '';
				if(isset($_FILES["profile_photo"]) && !empty($_FILES["profile_photo"]['name'])){
					$this->upload->initialize($this->set_upload_options()); 
					if(!$this->upload->do_upload('profile_photo'))  
					{  
					$this->session->set_flashdata('response',  '<div class="alert alert-danger"> Profile Photo:'.$this->upload->display_errors().'</div>');
					redirect('author/overview');
					}  
					//$profile_photo = $this->upload->data()['file_name'];
					$promotedata['profile_photo']    =  $this->upload->data()['file_name'];

				}

				$background_photo = '';
				if(isset($_FILES["background_photo"]) && !empty($_FILES["background_photo"]['name'])){
					$this->upload->initialize($this->set_upload_options()); 
					if(!$this->upload->do_upload('background_photo'))  
					{  
					$this->session->set_flashdata('response',  '<div class="alert alert-danger"> Background Photo:'.$this->upload->display_errors().'</div>');
					redirect('author/overview');
					}  
					//$profile_photo = $this->upload->data()['file_name'];
					$promotedata['background_photo']    = $this->upload->data()['file_name'];
					//$promotedata['profile_photo']    = $profile_photo;
					//$background_photo = $background_photo;
				}
 
				$vcount = count($_FILES['portfoliovideo']['tmp_name']);
				 
				if($vcount > 0){
					$vidvalue = $_FILES['portfoliovideo'];
					//foreach($_FILES['portfolio'] as $key=>$value){
					for($s=0; $s<=$vcount-1; $s++) {
						$_FILES['portfoliovideo']['name']		= $vidvalue['name'][$s];
						$_FILES['portfoliovideo']['type']    	= $vidvalue['type'][$s];
						$_FILES['portfoliovideo']['tmp_name'] 	= $vidvalue['tmp_name'][$s];
						$_FILES['portfoliovideo']['error']      = $vidvalue['error'][$s];
						$_FILES['portfoliovideo']['size']    	= $vidvalue['size'][$s];   
						$config['upload_path'] 			= './assets/images/uploads/';
						$config['allowed_types'] 		= 'mp4|3gp';
						//$config['max_size']    		= '20000';
						//$config['max_width']  		= '1024';
						//$config['max_height'] 	 	= '768';
						$ext = explode('.',$vidvalue['name'][$s]);	
						$videoname = 'video_'.time().'.'.end($ext);
						$config['file_name'] = $videoname;
						//$this->load->library('upload', $config);
						//$this->upload->do_upload('portfoliovideo');
						$this->load->library('upload', $config);
					
						foreach($_FILES['portfoliovideo'] as $attr => $values) {
							$_FILES[$fld][$attr] = $values[$i];
						}

						if (!$this->upload->do_upload($fld))
						{
							$error = array('error' => $this->upload->display_errors());                       
						} 
						
						$vdata = $this->upload->data();
						$name_array[] = $vdata['file_name']; 
						$vidoearr = array(
								'user_id' 		=> $this->session->userdata('logged_in')['id'],
								'filetype' 		=> 'video',
								'filename' 		=> $vdata['file_name'],
								'added_at'     	=> date('Y-m-d H:i:s'),
							);	
					}
					 
		        } 
		        $promotedata['user_id'] 		= $this->session->userdata('logged_in')['id'];
		        $promotedata['country_id'] 		= $this->session->userdata('logged_in')['country'];
		        $promotedata['name']    		= $this->input->post('name');
		        $promotedata['profession']    	= $this->input->post('profession');
		        $promotedata['years_of_practice']  = $this->input->post('years_of_practice');
		        $promotedata['specialization']  = $this->input->post('specialization');
		        // $promotedata['masteral']    	= $this->input->post('masteral');
		        // $promotedata['doctoral']    	= $this->input->post('doctoral');
				$promotedata['edu_elementary']  = $this->input->post('edu_elementary');
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
				$promotedata['facebook']    	= $this->input->post('facebook');
				$promotedata['linkedin']    	= $this->input->post('linkedin');
				$promotedata['googleplus']    	= $this->input->post('googleplus');
				$promotedata['twitter']    		= $this->input->post('twitter');
				$promotedata['youtube']    		= $this->input->post('youtube');
				$promotedata['instagram']    	= $this->input->post('instagram');
				$promotedata['pinterest']    	= $this->input->post('pinterest');
				$promotedata['pro_status']   	= '1';
				$promotedata['added_at']    	= date('Y-m-d H:i:s');
				$promotedata['user_type']    	= 2;

 			// echo $this->input->post('pro_id').'<pre>'; print_r($promotedata);die;

				if($this->input->post('pro_id') > 0){
					$this->users_model->update('tbl_professionals',$promotedata,'pro_id',$this->input->post('pro_id'));
					$proinserted = $this->input->post('pro_id');
					$promotedata1['logged_in'] = 2;
					$this->users_model->update('tbl_user',$promotedata1,'id',$this->session->userdata('logged_in')['id']);
				}else{
					$proinserted = $this->users_model->save('tbl_professionals',$promotedata);
					$promotedata1['logged_in'] = 2;
					$this->users_model->update('tbl_user',$promotedata1,'id',$this->session->userdata('logged_in')['id']);
				}
		        // echo '<pre>'; print_r($this->db->last_query()); die;
			if($proinserted > 0){
				$this->users_model->delete('tbl_practice_list', 'pro_id',$proinserted);	
				$this->users_model->delete('tbl_citations_list', 'pro_id',$proinserted);	
				$this->users_model->delete('tbl_affiliation_list', 'pro_id',$proinserted);	
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
							//print_r($purchagesitems);
							$this->users_model->save('tbl_practice_list', $practiceitems);					
						}				
					}
				}
				for($i =0; $i<=count($_POST['citations_title']);$i++){
					if(isset($_POST['citations_title'][$i]) && $_POST['citations_title'][$i] != ""){
						$citationsitems = array(
							'pro_id' 		 => $proinserted,
							'citations_title'=> $_POST['citations_title'][$i],
							'cit_year_s' 		 => $_POST['cit_year_s'][$i],
							'cit_year_e' 		 => $_POST['cit_year_e'][$i],
							'cit_highlights' => $_POST['cit_highlights'][$i],
							'added_at'     	 => date('Y-m-d H:i:s'),
						);
						//print_r($purchagesitems);
						$this->users_model->save('tbl_citations_list', $citationsitems);					
					}				
				}
				for($i =0; $i<=count($_POST['aff_title']);$i++){
					if(isset($_POST['aff_title'][$i]) && $_POST['aff_title'][$i] != ""){
						$awarditems = array(
							'pro_id' 			=> $proinserted,
							'aff_title' 		=> $_POST['aff_title'][$i],
							'aff_year_s' 			=> $_POST['aff_year_s'][$i],
							'aff_year_e' 			=> $_POST['aff_year_e'][$i],
							'aff_highlights' 	=> $_POST['aff_highlights'][$i],
							'added_at'     		=> date('Y-m-d H:i:s'),
						);
						//print_r($purchagesitems);
						$this->users_model->save('tbl_affiliation_list', $awarditems);					
					}				
				}
				////documents upload
				$name_array = array();
				// echo '<pre>';
				// print_r($_FILES['portfolio']); die;
				$count = count($_FILES['portfolio']['tmp_name']);
				if($count > 0){
				$value = $_FILES['portfolio'];
				//foreach($_FILES['portfolio'] as $key=>$value){
				for($s=0; $s<=$count-1; $s++) {
					$_FILES['portfolio']['name']		= $value['name'][$s];
					$_FILES['portfolio']['type']    	= $value['type'][$s];
					$_FILES['portfolio']['tmp_name'] 	= $value['tmp_name'][$s];
					$_FILES['portfolio']['error']       = $value['error'][$s];
					$_FILES['portfolio']['size']    	= $value['size'][$s];   
						$config['upload_path'] 			= './assets/images/uploads/';
						$config['allowed_types'] 		= 'gif|jpg|png';
						//$config['max_size']    = '20000';
						//$config['max_width']  = '1024';
						//$config['max_height']  = '768';
					$ext = explode('.',$value['name'][$s]);	
					$documentname = 'doc_'.time().'.'.end($ext);
					$config['file_name'] = $documentname;
					// $this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload('portfolio');
					$data = $this->upload->data();
					$name_array[] = $data['file_name'];
					// print_r($data['file_name']); die;

					$portfolioarr = array(
							'user_id' 		=> $this->session->userdata('logged_in')['id'],
							'filetype' 		=> 'img',
							'filename' 		=> $data['file_name'],
							'added_at'     	=> date('Y-m-d H:i:s'),
						);
						//print_r($purchagesitems);
						$this->users_model->save('tbl_user_docutments', $portfolioarr);	
				}
			}
				$this->session->set_flashdata('response', '<div class="alert alert-success">Successfully Added</div>');
				//exit;
				redirect('author/overview?id=success', 'refresh');
			}
		}

	 
	$this->load->frontAdmin('author/overview',$data);

	}

public function ajaxupdateinfo(){
	$returnajax = "";
	if($_POST){
			$profile_photo = '';
			if(isset($_FILES["profile_photo"]) && !empty($_FILES["profile_photo"]['name'])){
					$this->upload->initialize($this->set_upload_options()); 
					if(!$this->upload->do_upload('profile_photo'))  
					{  
					$this->session->set_flashdata('response',  '<div class="alert alert-danger"> Profile Photo:'.$this->upload->display_errors().'</div>');
					redirect('author/overview');
					}  
				    //$profile_photo = $this->upload->data()['file_name'];
				    $promotedata['profile_photo']    =  $this->upload->data()['file_name'];

			}

			$background_photo = '';
			if(isset($_FILES["background_photo"]) && !empty($_FILES["background_photo"]['name'])){
				$this->upload->initialize($this->set_upload_options()); 
					if(!$this->upload->do_upload('background_photo'))  
					{  
					$this->session->set_flashdata('response',  '<div class="alert alert-danger"> Background Photo:'.$this->upload->display_errors().'</div>');
					redirect('author/overview');
					}  
				        //$profile_photo = $this->upload->data()['file_name'];
						$promotedata['background_photo']    = $this->upload->data()['file_name'];
						//$promotedata['profile_photo']    = $profile_photo;
				    	//$background_photo = $background_photo;
			}
 

				$vcount = count($_FILES['portfoliovideo']['tmp_name']);
				 
				if($vcount >0){
					$vidvalue = $_FILES['portfoliovideo'];
					//foreach($_FILES['portfolio'] as $key=>$value){
					for($s=0; $s<=$vcount-1; $s++) {
						$_FILES['portfoliovideo']['name']		= $vidvalue['name'][$s];
						$_FILES['portfoliovideo']['type']    	= $vidvalue['type'][$s];
						$_FILES['portfoliovideo']['tmp_name'] 	= $vidvalue['tmp_name'][$s];
						$_FILES['portfoliovideo']['error']       = $vidvalue['error'][$s];
						$_FILES['portfoliovideo']['size']    	= $vidvalue['size'][$s];   
						$config['upload_path'] 			= './assets/images/uploads/';
						$config['allowed_types'] 		= 'mp4|3gp';
						//$config['max_size']    		= '20000';
						//$config['max_width']  		= '1024';
						//$config['max_height'] 	 	= '768';
						$ext = explode('.',$vidvalue['name'][$s]);	
						$videoname = 'video_'.time().'.'.end($ext);
						$config['file_name'] = $videoname;
						//$this->load->library('upload', $config);
						//$this->upload->do_upload('portfoliovideo');
						$this->load->library('upload', $config);

					
						foreach($_FILES['portfoliovideo'] as $attr => $values) {
						$_FILES[$fld][$attr] = $values[$i];
						}

						if (!$this->upload->do_upload($fld))
						{
						$error = array('error' => $this->upload->display_errors());                       
						} 
						//print_r($config);
						//print_r($error);
						//exit;
						$vdata = $this->upload->data();
						$name_array[] = $vdata['file_name']; 
						$vidoearr = array(
								'user_id' 		=> $this->session->userdata('logged_in')['id'],
								'filetype' 		=> 'video',
								'filename' 		=> $vdata['file_name'],
								'added_at'     	=> date('Y-m-d H:i:s'),
							);	
					}
					 
		        } 
		        $promotedata['user_id'] 		= $this->session->userdata('logged_in')['id'];
		        $promotedata['country_id'] 		= $this->session->userdata('logged_in')['country'];
		        $promotedata['name']    		= $this->input->post('name');
		        $promotedata['profession']    	= $this->input->post('profession');
		        $promotedata['years_of_practice']  = $this->input->post('years_of_practice');
		        $promotedata['specialization']  = $this->input->post('specialization');
		        // $promotedata['masteral']    	= $this->input->post('masteral');
		        // $promotedata['doctoral']    	= $this->input->post('doctoral');
				$promotedata['edu_elementary']  = $this->input->post('edu_elementary');
				$promotedata['edu_elementary_s']	= $this->input->post('edu_elementary_s');
				$promotedata['edu_elementary_e']	= $this->input->post('edu_elementary_e');
				$promotedata['edu_high_school'] = $this->input->post('edu_high_school');
				$promotedata['edu_high_school_s'] 	= $this->input->post('edu_high_school_s');
				$promotedata['edu_high_school_e'] 	= $this->input->post('edu_high_school_e');
				$promotedata['edu_college']    	= $this->input->post('edu_college');
				$promotedata['edu_college_s']    	= $this->input->post('edu_college_s');
				$promotedata['edu_college_e']    	= $this->input->post('edu_college_e');
				$promotedata['edu_masteral']    = $this->input->post('edu_masteral');
				$promotedata['edu_masteral_s']    	= $this->input->post('edu_masteral_s');
				$promotedata['edu_masteral_e']    	= $this->input->post('edu_masteral_e');
				$promotedata['edu_doctoral']    = $this->input->post('edu_doctoral');
				$promotedata['edu_doctoral_s']    	= $this->input->post('edu_doctoral_s');
				$promotedata['edu_doctoral_e']    	= $this->input->post('edu_doctoral_e');
				$promotedata['facebook']    	= $this->input->post('facebook');
				$promotedata['linkedin']    	= $this->input->post('linkedin');
				$promotedata['googleplus']    	= $this->input->post('googleplus');
				$promotedata['twitter']    		= $this->input->post('twitter');
				$promotedata['youtube']    		= $this->input->post('youtube');
				$promotedata['instagram']    	= $this->input->post('instagram');
				$promotedata['pinterest']    	= $this->input->post('pinterest');
				$promotedata['pro_status']   	= '1';
				$promotedata['added_at']    	= date('Y-m-d H:i:s');
				$promotedata['user_type']    	= 2;


 	// echo $this->input->post('pro_id').'<pre>'; print_r($promotedata);die;

				if($this->input->post('pro_id') > 0){
					 
					$returnajax = $this->users_model->update('tbl_professionals',$promotedata,'pro_id',$this->input->post('pro_id'));
					// echo $this->db->last_query(); die;
					$proinserted = $this->input->post('pro_id');
					$promotedata1['logged_in']    	= 2;
					$this->users_model->update('tbl_user',$promotedata1,'id',$this->session->userdata('logged_in')['id']);


				}else{
					$proinserted = $this->users_model->save('tbl_professionals',$promotedata);
					$datas['logged_in'] = 2;
					$this->users_model->update('tbl_user',$promotedata,'id',$this->session->userdata('logged_in')['id']);
				}
				
		        // echo '<pre>'; print_r($this->db->last_query()); die;
			if($proinserted > 0){
				$this->users_model->delete('tbl_practice_list', 'pro_id',$proinserted);	
				$this->users_model->delete('tbl_citations_list', 'pro_id',$proinserted);	
				$this->users_model->delete('tbl_affiliation_list', 'pro_id',$proinserted);	
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
							//print_r($purchagesitems);
							$this->users_model->save('tbl_practice_list', $practiceitems);					
						}				
					}
				}
				for($i =0; $i<=count($_POST['citations_title']);$i++){
					if(isset($_POST['citations_title'][$i]) && $_POST['citations_title'][$i] != ""){
						$citationsitems = array(
							'pro_id' 		 => $proinserted,
							'citations_title'=> $_POST['citations_title'][$i],
							'cit_year_s' 		 => $_POST['cit_year_s'][$i],
							'cit_year_e' 		 => $_POST['cit_year_e'][$i],
							'cit_highlights' => $_POST['cit_highlights'][$i],
							'added_at'     	 => date('Y-m-d H:i:s'),
						);
						//print_r($purchagesitems);
						$this->users_model->save('tbl_citations_list', $citationsitems);					
					}				
				}
				for($i =0; $i<=count($_POST['aff_title']);$i++){
					if(isset($_POST['aff_title'][$i]) && $_POST['aff_title'][$i] != ""){
						$awarditems = array(
							'pro_id' 			=> $proinserted,
							'aff_title' 		=> $_POST['aff_title'][$i],
							'aff_year_s' 			=> $_POST['aff_year_s'][$i],
							'aff_year_e' 			=> $_POST['aff_year_e'][$i],
							'aff_highlights' 	=> $_POST['aff_highlights'][$i],
							'added_at'     		=> date('Y-m-d H:i:s'),
						);
						//print_r($purchagesitems);
						$this->users_model->save('tbl_affiliation_list', $awarditems);					
					}				
				}
				////documents upload
				$name_array = array();
				//echo '<pre>';
				//print_r($_FILES);
				$count = count($_FILES['portfolio']['tmp_name']);
				if($count > 0){
				$value = $_FILES['portfolio'];
				//foreach($_FILES['portfolio'] as $key=>$value){
				for($s=0; $s<=$count-1; $s++) {
					$_FILES['portfolio']['name']		= $value['name'][$s];
					$_FILES['portfolio']['type']    	= $value['type'][$s];
					$_FILES['portfolio']['tmp_name'] 	= $value['tmp_name'][$s];
					$_FILES['portfolio']['error']       = $value['error'][$s];
					$_FILES['portfolio']['size']    	= $value['size'][$s];   
						$config['upload_path'] 			= './assets/images/uploads/';
						$config['allowed_types'] 		= 'gif|jpg|png';
						//$config['max_size']    = '20000';
						//$config['max_width']  = '1024';
						//$config['max_height']  = '768';
					$ext = explode('.',$value['name'][$s]);	
					$documentname = 'doc_'.time().'.'.end($ext);
					$config['file_name'] = $documentname;
					$this->load->library('upload', $config);
					$this->upload->do_upload('portfolio');
					$data = $this->upload->data();
					$name_array[] = $data['file_name'];
					$portfolioarr = array(
							'user_id' 		=> $this->session->userdata('logged_in')['id'],
							'filetype' 		=> 'img',
							'filename' 		=> $data['file_name'],
							'added_at'     	=> date('Y-m-d H:i:s'),
						);
						//print_r($purchagesitems);
						$this->users_model->save('tbl_user_docutments', $portfolioarr);	
				}}
				
			}
		}
		echo $returnajax; exit;
}




 public function income_report(){
		
		//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 


		$uid = $this->session->userdata('logged_in')['id'];	
		$report_type = $_REQUEST['otri'];
		
	  if($report_type != 1){
	  
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$data['todayIncome'] = $this->provider_model->total_income($uid,'today');
		$data['monthIncome'] = $this->provider_model->total_income($uid,'month');
		$data['yearIncome']  = $this->provider_model->total_income($uid,'year');
		$data['totalIncome'] = $this->provider_model->total_income($uid,'total');
		
		//echo '<pre>'; print_r($data['todayIncome']); exit;
		/* $data['today'] = $this->user->get_report('today',$uid);
		$data['month'] = $this->user->get_report('month',$uid);
		$data['year']  = $this->user->get_report('year',$uid);
		$data['total'] = $this->user->get_report('total',$uid); */
		$this->load->frontAdmin('author/income_report',$data);
	  } else {
	  
	  		
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$data['todayIncome'] = $this->provider_model->total_income($uid,'today');
		$data['monthIncome'] = $this->provider_model->total_income($uid,'month');
		$data['yearIncome']  = $this->provider_model->total_income($uid,'year');
		$data['totalIncome'] = $this->provider_model->total_income($uid,'total');
		/* $data['today'] = $this->user->get_report1('today',$uid);
		$data['month'] = $this->user->get_report1('month',$uid);
		$data['year']  = $this->user->get_report1('year',$uid);
		$data['total'] = $this->user->get_report1('total',$uid); */
		$this->load->frontAdmin('author/income_report_otri',$data);
	  
	  }

	}


	public function purchase_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$urole  = $this->session->userdata('logged_in')['role'];
		$data['course_promotion']  	 = $this->provider_model->get_active_course_promotion($uid);
		$data['advertise'] 			 = $this->advertise_model->getAdvertiseAddsList($uid,$urole);
		// echo $this->db->last_query();die;
		// $data['purchase_list'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_purchase_llis','user_id',$uid);
             	
		$this->load->frontAdmin('author/purchase_list',$data);
		
	}

	public function purchasedetails(){
		$uid 	= $this->session->userdata('logged_in')['id'];
		$urole  = $this->session->userdata('logged_in')['role'];
			
		$idd =  $this->input->post('id');
		$type =  $this->input->post('type');
		if($type =='Course'){
			$dataArray = $this->dashboards_model->receipt_courses($idd);
			// echo'<pre>';print_r($dataArray);die;
			  $returnarray = array();
				$price 		  = round($dataArray['amount']);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray['added_on']));
			$returnarray['course_title'] 	= $dataArray['course_title'];
			$returnarray['username'] 		= $dataArray['username'];
			$returnarray['countries_name'] 	= $dataArray['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $dataArray['txn_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		}
		
		$this->load->view('author/receipt',$data);
	   }

	public function exam_list()
	{
		$uid = $this->session->userdata('logged_in')['id']; 
		$data['exam_list'] = $this->provider_model->author_exam_list($uid); 
		// echo $this->db->last_query(); die;
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');		
		$this->load->frontAdmin('author/exam_list',$data);
	}



		public function advertisement()
	{
		$where1 = array('role'=>5,'status'=>1);
		$subinstitution1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
		$data['totalSubInstitute'] = sprintf("%02d", count($subinstitution1));

		
		$where3 = array('role'=>5,'status'=>1);
		$authorlist = $this->user->get_record_by_multi_field_name('tbl_user',$where3);
		$data['totalAuthor'] = sprintf("%02d", count($authorlist));
		
		
		$where4 = array('role'=>1,'status'=>1);
		$professionallist = $this->user->get_record_by_multi_field_name('tbl_user',$where4);
		$data['totalProfessional'] = sprintf("%02d", count($professionallist));

        $where5 = array('status'=>1,'display'=>'Yes');
		$countryllist = $this->user->get_record_by_multi_field_name('countries',$where5);
		$data['totalCountries'] = sprintf("%02d", count($countryllist));

		$where = array('');
		$viewerlist = $this->user->get_record_by_multi_field_name('tbl_viewer_counter',$where);
		$data['totalViewers'] = sprintf("%02d", array_sum(array_column($viewerlist, 'count')));
        
		
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',1);  
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$this->load->frontAdmin('author/add_advertise',$data);
	}



	public function adslist()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		
		 $data['advertise'] = $this->advertiseads->getAdvertiseAddsList($uid);
             	
		$this->load->frontAdmin('author/advertise',$data);
		
	}


public function active_promotion()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$data['purchase_list'] = $this->user->get_active_promotion($uid);
		$data['previous_list'] = $this->user->get_previous_promotion($uid);
		//print_r($data['purchase_list']); die;
		$this->load->frontAdmin('author/active_promotion',$data);
	}
	
	public function edit_promotion($cid)
	{		

		//$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_rules('prof_name', 'Prof Name', 'trim|required');   

		if($this->form_validation->run() == FALSE)
		{
			 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
			$this->load->frontAdmin('author/edit_promotion',$data);
		}  else { 

			$data['prof_name'] 		= $this->input->post('prof_name'); 
			
			 $result = $this->user->update('tbl_course',$data,'id',$cid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('author/edit_promotion/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/edit_promotion/'.$cid.'');
			} 

		}		
	}

public  function preview_course_certificate(){ 
	$this->load->model('Certificate_model','certificate_model'); 
	$userid = $_POST['uid'];
	$courseid = $_POST['cid'];

	$this->db->select('ct.countries_name as location,tu.address');
	$this->db->from('tbl_user tu');
	$this->db->join('countries ct', 'ct.countries_id = tu.location'); 
	$this->db->where('tu.id ', $userid); 
	$data['owner'] = $this->db->get()->result_array();
	// print_r($this->db->last_query());die;
	$data['profile'][0]['name'] =  $this->session->userdata('logged_in')['name'];
	$data['cust_data'][0]['barcode'] =  'scan.png';
	$data['cust_data'][0]['added_on'] =  date("F d, Y");
	$data['cust_data'][0]['certificate_id'] =  'CERTI987654321';
	
	$this->db->select('uc.*,tc.course_title as training_title,tc.units ,ct.id, ct.bg_image, ct.template_no, ct.text_image,ct.category');
	$this->db->from('tbl_user_certificate uc');
	$this->db->join('tbl_certificate_template ct', 'uc.templete_id = ct.id');
	$this->db->join('tbl_course tc', 'uc.course_id = tc.id');
	$this->db->where('uc.course_id',$courseid);
	$this->db->where('uc.user_id',$userid);  
	$query = $this->db->get();
	$data['certificate'] = $query->result_array();
	// echo $this->db->last_query();
	// echo'<pre>';print_r($data['certificate']);
	if(!empty($data['owner'][0]['address'])){$data['owner'][0]['address'] = $data['owner'][0]['address'];  }else{$data['owner'][0]['address'] = 'Mount Royal Auditorium'; }

	if(!empty($data['owner'][0]['location'])){$data['owner'][0]['location'] = $data['owner'][0]['location'];  }else{$data['owner'][0]['location'] = 'Delaware,USA'; }

	if(!empty($data['certificate'][0]['training_title'])){$data['certificate'][0]['training_title'] = $data['certificate'][0]['training_title'];  }else{$data['certificate'][0]['training_title'] = 'Online Courses Empower your Knowledge'; }

	if(!empty($data['certificate'][0]['units'])){$data['certificate'][0]['units'] = $data['certificate'][0]['units'];  }else{$data['certificate'][0]['units'] = '5'; }
	
	$category = $data['certificate'][0]['category'];
	$temp = $data['certificate'][0]['template_no'];
	$path = $this->certificate_model->select_certificate_template($category,$temp);
	//echo $path; //print_r($data);
	$html = $this->load->view($path,$data);
	 return $html;

	
   }
	
   public function deletelogo($idd,$tid,$tbl)
	{ 
			$data = array('logo2'=>"");
			$this->db->where('id',$idd);
		if($tbl==1){
			$result = $this->db->update('tbl_training_certificate_lists',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record deleted successfully.</div>');
				redirect('author/choose_certificate_edit/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/choose_certificate_edit/'.$tid.'');
			}
		}
		if($tbl==2){
			$result = $this->db->update('tbl_user_certificate',$data);

			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record deleted successfully.</div>');
				redirect('author/edit_certificate/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('author/edit_certificate/'.$tid.'');
			} 
		}

		die;
	}
	
	
	
	public function promotion()
	{

		$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];
		$cid = $this->uri->segment(3);

		$this->form_validation->set_rules('promote', 'Promote', 'trim|required');   

		if($this->form_validation->run() == FALSE)
		{
			 
			//$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			$data['lesson'] = $this->user->get_lesson($uid);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('author/promotion',$data);

		}  else { 

			$stts1 	= $this->input->post('promote'); 
			
			$stts   = explode('_', $stts1);

			$data['paid_status'] 	= $stts[1];

			$course_id          = $this->session->userdata('current_course_id');

			$result = $this->user->update('tbl_course',$data,'id',$course_id); 
			if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promote updated successfully.</div>');
			redirect('author/publish');
			} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('author/promotion');
			} 
		}			
	}
	
	
	public function course_promote_success()
	{
		/*echo '<pre>';print_r($_REQUEST);
		die;*/
		if(!empty($_REQUEST)){
			if($_REQUEST['item_name']=="1"){
			$item_name = "Free";
			}
			if($_REQUEST['item_name']=="2"){
			$item_name = "Featured Courses";
			}
			if($_REQUEST['item_name']=="3"){
			$item_name = "Top List Courses";
			}
			if($_REQUEST['item_name']=="4"){
			$item_name = "Premium List Courses";
			}

		$data['user_id']            = $this->session->userdata('logged_in')['id'];
		$data['plan_name']          = $item_name;
		//$data['quantity']           = $_REQUEST['quantity'];
		$data['txn_id']             = $_REQUEST['txn_id'];
		$data['txn_status']         = $_REQUEST['payment_status'];
		$data['status']             = 1;
		$data['added_on']           = date('y-m-d h:i:s');
		$data['amount']             = $_REQUEST['payment_gross'];
		$data['course_id']          = $_REQUEST['item_number'];

		$result = $this->user->save('tbl_course_promotion',$data);



		$data2['paid_status'] 	= $_REQUEST['item_name'];
		$result = $this->user->update('tbl_course',$data2,'id',$data['course_id']);


		

		if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promote successfully.</div>');
				if($_REQUEST['id']==1){
	       	   	  redirect('author/course_listing');
				} else {
	       	   	  redirect('author/publish/');
				}
				
			//redirect('provider/publish/');
			
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				if($_REQUEST['id']==1){
	       	   	  redirect('author/course_listing');
				} else {
	       	   	  redirect('author/publish/');
				}

			}	


	} else {
		echo "There is some error. Please try again.";
	}

	}
	
	
	public function old_showMessage(){
	    
	   $idd =  $this->input->post('idd');
	   $data['notification'] = $this->user->get_record_by_field_name_all_record('tbl_notification','id',$idd);
	  
		$this->db->where('id',$idd);
		$this->db->update('tbl_notification',array('status'=>0));
	   $this->load->view('author/notificationdata',$data);
}
 public function promotepractice()
    {
     
        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
        $this->form_validation->set_rules('dailyprice', 'daily price', 'trim|required');
        $this->form_validation->set_rules('day', 'day', 'trim|required');       
 
        if($this->form_validation->run() == FALSE)
        { 
            $this->load->view('author/overview');

        
        }  else {        

            $dailyprice          = $this->input->post('dailyprice');
            $day    = $this->input->post('day');
           
		   $totalamunt=$dailyprice*$day; 

          
            if($totalamunt){           	
            ?>
			<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
			<input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="item_name" id="item_name" value="Plan_<?php echo $day;?>">
			<input type="hidden" name="item_number" value="1">
			<input type="hidden" name="credits" value="510">
			<input type="hidden" name="userid" value="1">
			<input type="hidden" name="amount" id="amount" value="<?php echo $totalamunt;?>">
			<input type="hidden" name="tax" value="0">
			<input type='hidden' name='rm' value='2'>
			<input type="hidden" name="no_shipping" value="1">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="handling" value="0">
			<input type="hidden" name="cancel_return" value="<?php echo site_url('author/company_prmote_fail')?>">
			<input type="hidden" name="return" value="<?php echo site_url('author/company_prmote_success')?>">
			</form>

			<script type="text/javascript">	
		     document.getElementById("frmPayPal1").submit();
			</script>
			<?php die; ?>
			
            <?php  

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promoted successfully.</div>');
                redirect('author/dashboard');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                 redirect('author/dashboard');

            }
      }
}
 
public function company_prmote_success(){
	$idd = explode('_', $_REQUEST['item_name']);	
	$day=trim($idd[1]);		
	$userid=$this->session->userdata('logged_in')['id'];
	$userrole=$this->session->userdata('logged_in')['role'];
	$promotedData['user_id']=$userid;
	$promotedData['user_role']=$userrole;
	$promotedData['promoted_date']=date('Y-m-d');
	$promotedData['promoted_day']=$day;
	$promotedData['promoted_amount']=$_REQUEST['amount'];
	$promotedData['transaction_detail']=json_encode($_REQUEST);
	$this->user->save('tbl_promoted_provider_transaction',$promotedData);
	
	$featuredData['featured_from']=date('Y-m-d');
	$featuredData['featured_to']=date('Y-m-d', strtotime("+$day days"));
	
	$result = $this->user->update('tbl_user',$featuredData,'id',$userid);
	if($result){
				$this->session->set_flashdata('response', '<h4>Your company in now listed as fetured at the CE Provider\'s Page.</ch4>');
				 redirect('author/active_promotion?id=done');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				 redirect('author/dashboard');
			}

}





}
