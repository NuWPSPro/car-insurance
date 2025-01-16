<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider extends CI_Controller {

	public function  __construct()
	{
	        parent::__construct();
			$uid = $this->session->userdata('logged_in')['id'];
			if($uid==""){
				redirect('users');
			}
	}


	public function advertisement()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		  $data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',1);    	
		$this->load->frontAdmin('provider/add_advertise',$data);
	}
	
	public function checkcourselogin()
	{
		$courseid = $this->session->userdata('current_course_id');
		if($courseid=="" && $this->uri->segment(3)==""){
		redirect('provider/overview');
		}
	}  
	
	
	


	public function checkTraininglogin()
	{
		$trid = $this->session->userdata('current_training_id');

		if($trid==""){
			redirect('provider/upload_information');
		}
	}  



	public function index()
	{
		$this->load->view('provider/provider');
	}


	 

 	  
	public function dashboard()
	{
	 
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('course_title', 'Course Title', 'trim|required');
		$this->form_validation->set_rules('units', 'Units', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required');
		$this->form_validation->set_rules('acceditation_no', 'Course Acceditation No', 'trim|required');
		$this->form_validation->set_rules('course_validity', 'Course Validity', 'trim|required');
		//$this->form_validation->set_rules('profession', 'Profession', 'trim|required');
		$this->form_validation->set_rules('cpdprovider', 'CPD Provider', 'trim|required');
		$this->form_validation->set_rules('prc_acceditation_no', 'PRC Acceditation No', 'trim|required');
		$this->form_validation->set_rules('acceditation_validity', 'Acceditation Validity', 'trim|required');

		if (empty($_FILES['image']['name'])){
		 $this->form_validation->set_rules('image', 'Course Photo', 'trim|required');
		}

		$this->form_validation->set_rules('course_description', 'Course Description', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
		    $data['profession'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
		    $uid = $this->session->userdata('logged_in')['id'];
		    $data['userdetails'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			
		    
			 
			$this->load->frontAdmin('provider/overview',$data);
		
		}  else {



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
			$error = array('error' => $this->upload->display_errors());   
				// echo '<pre>'; print_r($error); die;                    
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
			if ( ! $this->upload->do_upload('image'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['course_photo'] = $imageName;
			}


			

			

			//print_r($this->input->post('profession')); die;

			$data['course_title']          = $this->input->post('course_title');
			$data['units']                 = $this->input->post('units');
			$data['course_acceditation_number']       = $this->input->post('acceditation_no');
			$data['course_validity']       = $this->input->post('course_validity');
			$data['profession'] 		   = serialize($this->input->post('profession'));
			$data['cpdprovider'] 		   = $this->input->post('cpdprovider');
			$data['prc_acceditation_number']   = $this->input->post('prc_acceditation_no');
			$data['acceditation_validity'] = $this->input->post('acceditation_validity');
			$data['course_description']    = $this->input->post('course_description');
			$data['user_id']               = $this->session->userdata('logged_in')['id'];

			$data['course_category']    = $this->input->post('category');
			$data['price']        = $this->input->post('price');
			
			$data['objective']    = $this->input->post('objective');
			$data['status']       = 1;
			$data['added_on']     = date('Y-m-d');
			$data['expiry_on']    = date('Y-m-d', strtotime("+30 days"));




			$result = $this->user->save('tbl_course',$data);
			$this->session->set_userdata('current_course_id', $result);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Overview created successfully.</div>');
				redirect('provider/lesson');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/overview');
			}
	  }
}


	  
	public function overview()
	{
		// if($this->input->post()){
		//  print_r($_FILES["video"]['name']);exit;
		// }
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('course_title', 'Course Title', 'trim|required');
		$this->form_validation->set_rules('units', 'Units', 'trim|required');
		// $this->form_validation->set_rules('price', 'Price', 'trim|required');
		$this->form_validation->set_rules('acceditation_no', 'Course Acceditation No', 'trim|required');
		$this->form_validation->set_rules('course_validity', 'Course Validity', 'trim|required');
		//$this->form_validation->set_rules('profession', 'Profession', 'trim|required');
		$this->form_validation->set_rules('cpdprovider', 'CPD Provider', 'trim|required');
		$this->form_validation->set_rules('prc_acceditation_no', 'PRC Acceditation No', 'trim|required');
		$this->form_validation->set_rules('acceditation_validity', 'Acceditation Validity', 'trim|required');

		if (empty($_FILES['image']['name'])){
		 $this->form_validation->set_rules('image', 'Course Photo', 'trim|required');
		}

		$this->form_validation->set_rules('course_description', 'Course Description', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
		    $data['profession'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
		    $uid = $this->session->userdata('logged_in')['id'];
		    $data['userdetails'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			
 
			$this->load->frontAdmin('provider/overview',$data);
		
		}  else {



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
			if ( ! $this->upload->do_upload('image'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['course_photo'] = $imageName;
			}


			
			//$uid = $this->session->userdata('logged_in')['id'];
			//$userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);


		$uid = $this->session->userdata('logged_in')['id'];
		$userdetails1 = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		$userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$userdetails1[0]['parent_insititution']);

			
 

			$data['course_title']          = $this->input->post('course_title');
			$data['units']                 = $this->input->post('units');
			$data['course_acceditation_number']       = $this->input->post('acceditation_no');
			$data['course_validity']       = $this->input->post('course_validity');
			$data['profession'] 		   = serialize($this->input->post('profession'));
			$data['cpdprovider'] 		   = $this->input->post('cpdprovider');
			$data['prc_acceditation_number']   = $this->input->post('prc_acceditation_no');
			$data['acceditation_validity'] = $this->input->post('acceditation_validity');
			$data['course_description']    = $this->input->post('course_description');
			$data['user_id']               = $this->session->userdata('logged_in')['id'];

			$data['course_category']    = $this->input->post('category');
			// $data['price']        = $this->input->post('price');
			
			$data['objective']    = $this->input->post('objective');
			$data['status']       = 1;
			$data['added_on']     = date('Y-m-d');
			$data['expiry_on']    = date('Y-m-d', strtotime("+30 days"));

			$data['country_id']      = $this->session->userdata('logged_in')['country'];


			$data['insititution_id']   = $userdetails[0]['insititution_id'];
			// echo '<pre>';
			// print_r($data);
			// die;


			$result = $this->user->save('tbl_course',$data);
			$this->session->set_userdata('current_course_id', $result);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Overview created successfully.</div>');
				redirect('provider/lesson');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/overview');
			}
	  }
}




public function course_edit($cid)
	{
	 
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('course_title', 'Course Title', 'trim|required');
		$this->form_validation->set_rules('units', 'Units', 'trim|required');
		// $this->form_validation->set_rules('price', 'Price', 'trim|required');
		$this->form_validation->set_rules('acceditation_no', 'Course Acceditation No', 'trim|required');
		$this->form_validation->set_rules('course_validity', 'Course Validity', 'trim|required');
		$this->form_validation->set_rules('profession', 'Profession', 'trim|required');
		$this->form_validation->set_rules('cpdprovider', 'CPD Provider', 'trim|required');
		$this->form_validation->set_rules('prc_acceditation_no', 'PRC Acceditation No', 'trim|required');
		$this->form_validation->set_rules('acceditation_validity', 'Acceditation Validity', 'trim|required');

		/*if (empty($_FILES['image']['name'])){
		 $this->form_validation->set_rules('image', 'Course Photo', 'trim|required');
		}*/

		$this->form_validation->set_rules('course_description', 'Course Description', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
		    $data['profession'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
		    $uid = $this->session->userdata('logged_in')['id'];
		    $data['userdetails'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		     $data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			$this->load->frontAdmin('provider/edit_overview',$data);
		
		}  else {


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
			$data['course_photo'] = $imageName;
			}

            if(isset($_FILES["video"]) && !empty($_FILES["video"]['name'])){
				$config1['upload_path'] = './assets/images/uploads/';
				$config1['allowed_types'] = 'mp4';
				$config1['max_size'] = '1000000000000000';
			  
				$ext = explode('.',$_FILES["video"]["name"]);        
				$imageName = 'VID_'.time().'.'.end($ext);
				$config1['file_name'] = $imageName;
				$this->load->library('upload', $config1);
				$this->upload->initialize($config1);
				if ( ! $this->upload->do_upload('video'))
				{
				$error = array('error' => $this->upload->display_errors());   
					echo '<pre>'; print_r($error); die;                    
				}  
				$data['course_video'] = $imageName;
				
			}
			
			$data['course_title']          = $this->input->post('course_title');
			$data['units']                 = $this->input->post('units');
			$data['course_acceditation_number']       = $this->input->post('acceditation_no');
			$data['course_validity']       = $this->input->post('course_validity');
			$data['profession'] 		   = $this->input->post('profession');
			$data['cpdprovider'] 		   = $this->input->post('cpdprovider');
			$data['prc_acceditation_number']   = $this->input->post('prc_acceditation_no');
			$data['acceditation_validity'] = $this->input->post('acceditation_validity');
			$data['course_description']    = $this->input->post('course_description');
			$data['user_id']               = $this->session->userdata('logged_in')['id'];

			$data['course_category']    = $this->input->post('category');
			$data['price']    = $this->input->post('price');
			
			$data['objective']    = $this->input->post('objective');
			//$data['status']       = 1;


		 

			$result = $this->user->update('tbl_course',$data,'id',$cid);
			$this->session->set_userdata('current_course_id', $result);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Course updated successfully.</div>');
				redirect('provider/course_edit/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/course_edit'.$cid.'');
			}
	  }
}


	
   	public function course_listing()
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['course'] = $this->user->get_course($uid); 
			$this->load->frontAdmin('provider/course_listing',$data);
	}

	public function course_view($id)
	{		
			$uid 			= $this->session->userdata('logged_in')['id'];
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
			$data['lesson'] = $this->user->get_record_by_field_name_all_record('tbl_lesson','course_id',$id);
			$data['quiz'] = $this->user->get_record_by_field_name_all_record('tbl_quiz_question','course_id',$id);
			$data['exam'] = $this->user->get_record_by_field_name_all_record('tbl_exam','course_id',$id);
			$cid=6;
			$data['fivestar'] = $this->db->get_where('tbl_course_review',array('course_id'=>$cid,'star_mark'=>5))->result();
			$data['fourstar'] = $this->db->get_where('tbl_course_review',array('course_id'=>$cid,'star_mark'=>4))->result();
			$data['threestar'] =$this->db->get_where('tbl_course_review',array('course_id'=>$cid,'star_mark'=>3))->result();
			$data['twostar'] = $this->db->get_where('tbl_course_review',array('course_id'=>$cid,'star_mark'=>2))->result();
			$data['onestar'] = $this->db->get_where('tbl_course_review',array('course_id'=>$cid,'star_mark'=>1))->result();
			$this->db->order_by('id', 'DESC');
			$this->db->from('tbl_course_review');
			$this->db->where('course_id',$cid);
			$data['evaluation'] = $this->db->get()->result();
			// echo $this->db->last_query().'<br>';
			// echo '<pre>';	print_r($data['evaluation']);die;
			$this->load->frontAdmin('provider/course_view',$data);
	}

	



	public function lesson()
	{

		$this->checkcourselogin(); 
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		
		$this->form_validation->set_rules('summary', 'Summary', 'trim|required');  
		$this->form_validation->set_rules('references', 'References', 'trim|required');  

		if($this->form_validation->run() == FALSE)
		{
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['lesson'] = $this->user->get_lesson($uid);
			$this->load->frontAdmin('provider/lesson',$data); 		
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
				redirect('provider/quiz');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/overview');
			}

	}

 

	}





	public function lesson_edit($cid,$lid=false)
	{

		//$this->checkcourselogin(); 
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		
		$this->form_validation->set_rules('summary', 'Summary', 'trim|required');  
		$this->form_validation->set_rules('references', 'References', 'trim|required');  

		if($this->form_validation->run() == FALSE)
		{

			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['lesson'] = $this->user->get_lesson($uid);
			$this->load->frontAdmin('provider/lesson_edit',$data); 		
		}  else {


			$ldata = $this->input->post('lesson_title');
			$tot = count($ldata); 
		
		//for ($i=0; $i < $tot; $i++) { 
				
		//	$data['course_id']          = $this->session->userdata('current_course_id');

		//	$data['user_id']            = $uid;


		if(isset($_FILES["lesson_video"]['name']) && !empty($_FILES["lesson_video"]['name'])){
			$config['upload_path'] = './assets/images/uploads/video/';
			$config['allowed_types'] = 'mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["lesson_video"]["name"]);        
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
			//$data['lesson_video'] 		= $this->input->post('lesson_video')[$i]; 
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


			$result = $this->user->update('tbl_lesson',$data,'id',$lid);

			//}	

			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Lesson updated successfully.</div>');
				redirect('provider/lesson_edit/'.$cid.'/'.$lid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/lesson_edit/'.$cid.'/'.$lid.'');
			}
	    }
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
		$this->load->frontAdmin('provider/quiz',$data);
		
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
				redirect('provider/certificate');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/quiz');
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
			
			$this->load->frontAdmin('provider/edit_quiz',$data);
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
				redirect('provider/edit_certificate/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_quiz/'.$cid.'');
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
			redirect('provider/edit_quiz/'.$cid.'');		
	}


	public function edit_evaluation($cid=false)
	{		

		  $cid1 = $this->input->post('course_idd');
		  if(!empty($cid1))
		  {
	 	  $cid = $cid1;
		  }
		//$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_rules('rating', 'Rating', 'trim');   

		if($this->form_validation->run() == FALSE)
		{
			$cid1 = $this->uri->segment(3);  
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid1);
			$data['evaluation'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_evaluation','course_id',$cid1);


			$this->load->frontAdmin('provider/edit_evaluation',$data);
		}  else { 

		$result = $this->user->delete('tbl_evaluation','course_id',$cid); 

		$question = $this->input->post('question');
		foreach ($question as $key => $value) {
		if($value !=""){
		$data['course_id']           = $cid;
		$data['evaluation_question'] = $value;
		$data['status']              = 1;
		$result = $this->user->save('tbl_evaluation',$data); 
		}
		} 

		$data1['rating'] =  $this->input->post('rating'); 
		$data1['course_evaluation_note'] =  $this->input->post('evaluation_description');
		$result1 = $this->user->update('tbl_course',$data1,'id',$cid); 


//	$data['prof_name'] 		= $this->input->post('prof_name'); 
			
			 //$result = $this->user->update('tbl_course',$data,'id',$cid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('provider/edit_evaluation/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_evaluation/'.$cid.'');
			} 

		}		
	}



	
public function edit_promotion($cid)
	{		

		//$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_rules('prof_name', 'Prof Name', 'trim|required');   

		if($this->form_validation->run() == FALSE)
		{
			 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			$this->load->frontAdmin('provider/edit_promotion',$data);
		}  else { 

			$data['prof_name'] 		= $this->input->post('prof_name'); 
			
			 $result = $this->user->update('tbl_course',$data,'id',$cid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('provider/edit_promotion/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_promotion/'.$cid.'');
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
			$this->load->frontAdmin('provider/edit_publish',$data);
		}  else { 

			$data['prof_name'] 		= $this->input->post('prof_name'); 
			
			 $result = $this->user->update('tbl_course',$data,'id',$cid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('provider/edit_publish/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_publish/'.$cid.'');
			} 
		}		
	}

	public function certificate()
	{			
		$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];

		// $this->form_validation->set_rules('certificate_description', 'Certificate Description', 'trim|required'); 
		$this->form_validation->set_rules('templete_id', 'Template', 'trim|required');
		$this->form_validation->set_rules('header_content', 'Header Content', 'trim|required');
		// $this->form_validation->set_rules('logo', 'Logo', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
		$this->form_validation->set_rules('position', 'Position', 'trim|required'); 
		// $this->form_validation->set_rules('signature', 'Signature', 'trim|required');   

		if($this->form_validation->run() == FALSE)
		{
			 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['templete'] = $this->user->get_templete_all_record('tbl_template_plan','status','1');
			$data['lesson'] = $this->user->get_lesson($uid);
			$this->load->frontAdmin('provider/certificate',$data);
		}  else { 
			// print_r($this->input->post());die;
			$data['prof_name'] 		         =  $this->input->post('prof_name'); 
			$data['certificate_description'] =  $this->input->post('certificate_description'); 
			$course_id          			 =  $this->session->userdata('current_course_id');

		$image = array();
		$ImageCount = count($_FILES['logo']['name']);
		for($i = 0; $i < $ImageCount; $i++){
		$_FILES['logo']['name']       = $_FILES['logo']['name'][$i];
		if(!empty($_FILES['logo']['name'])) {
				
						$config['upload_path']      = './assets/images/uploadscertificatelogo/';
						$config['allowed_types']    = 'gif|jpg|png|jpeg';
						$ext 						= explode('.',$_FILES["logo"]["name"]);        
						$logo 						= 'logo_'.time().'.'.end($ext);
						$config['file_name'] 		= $logo;
						$this->load->library('upload',$config);
						$this->upload->do_upload('logo');
						$photo = $this->upload->data();
						$logo = $logo;
						// print_r($logo."yes");exit();
				}
			}//print_r($image);
			if(!empty($_FILES['signature']['name'])) {
				
						$config['upload_path']      = './assets/images/uploads/certificatesignature/';
						$config['allowed_types']    = 'gif|jpg|png|jpeg';
						$ext 						= explode('.',$_FILES["signature"]["name"]);        
						$signature 					= 'logo_'.time().'.'.end($ext);
						$config['file_name'] 		= $signature;
						$this->load->library('upload',$config);
						$this->upload->do_upload('signature');
						$photo = $this->upload->data();
						$signature = $signature;
						// print_r($signature."yes");exit();
				}
		
			$insert = array(
			'user_id' 					=>  $this->input->post('user_id'),  
			'course_id'					=>  $course_id, 
			'prof_name'					=>  $this->input->post('prof_name'),  
			'course_title'				=>  $this->input->post('course_title'),   
			'templete_id'				=>  $this->input->post('templete_id'), 
			'certificate_description'	=>  $this->input->post('certificate_description'), 
			'header_content'			=>  $this->input->post('header_content'), 
			'logo'						=>  $logo,
			'position'					=>  $this->input->post('position'), 
			'name'						=>  $this->input->post('name'), 
			'signature'					=>  $signature,
			'added_at'					=>  date('Y-m-d')
			); 
			// print_r($insert);die;
			$certificate = $this->user->insertcertificate('tbl_user_certificate',$insert); 
			if($certificate > 0){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate successfully addedd.</div>');
				redirect('provider/evaluation');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again nutan.</div>');
				redirect('provider/certificate');
			}  
	

			$result = $this->user->update('tbl_course',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
				redirect('provider/evaluation');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again .</div>');
				redirect('provider/certificate');
			} 

		}		
	}

	public function edit_certificate($cid)
	{		

		$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];

		// $this->form_validation->set_rules('prof_name', 'Prof Name', 'trim|required');   

		if($this->form_validation->run() == FALSE)
		{
			 echo"<script></script>";
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			$data['templete'] = $this->user->get_templete_all_record('tbl_template_plan','status','1');
			$data['certificate'] = $this->user->get_record_by_field_name_all_record('tbl_user_certificate','user_id',$cid);
			$this->load->frontAdmin('provider/edit_certificate',$data);
		}  else { 

			$data['prof_name'] 		= $this->input->post('prof_name'); 
			$data['course_certificate_note'] =  $this->input->post('certificate_description'); 

			if(!empty($_FILES['logo']['name'])) {
				
						$config['upload_path']      = './assets/images/uploads/uploadscertificatelogo/';
						$config['allowed_types']    = 'gif|jpg|png|jpeg';
						$ext 						= explode('.',$_FILES["logo"]["name"]);        
						$logo 						= 'logo_'.time().'.'.end($ext);
						$config['file_name'] 		= $logo;
						$this->load->library('upload',$config);
						$this->upload->do_upload('logo');
						$photo = $this->upload->data();
						$logo = $logo;
						// print_r($logo."yes");exit();
				}
			if(!empty($_FILES['signature']['name'])) {
				
						$config['upload_path']      = './assets/images/uploads/certificatesignature/';
						$config['allowed_types']    = 'gif|jpg|png|jpeg';
						$ext 						= explode('.',$_FILES["signature"]["name"]);        
						$signature 					= 'logo_'.time().'.'.end($ext);
						$config['file_name'] 		= $signature;
						$this->load->library('upload',$config);
						$this->upload->do_upload('signature');
						$photo = $this->upload->data();
						$signature = $signature;
						// print_r($signature."yes");exit();
				}
			$update['upload'] = array(	   
			'logo'						=>  $logo,
			'signature'					=>  $signature
			);
			$id = $this->input->post('id');
		
			$update['data'] = array(
			'course_id'					=>  $course_id, 
			'user_id' 					=>  $this->input->post('user_id'),
			'prof_name'					=>  $this->input->post('prof_name'),  
			'course_title'				=>  $this->input->post('course_title'),   
			'templete_id'				=>  $this->input->post('templete_id'), 
			'certificate_description'	=>  $this->input->post('certificate_description'), 
			'header_content'			=>  $this->input->post('header_content'),
			'position'					=>  $this->input->post('position'), 
			'name'						=>  $this->input->post('name'), 
			'updated_at'				=>  date('Y-m-d')
			); 
			// print_r($insert);die;
			$certificate = $this->user->update('tbl_user_certificate',$update,'id',$id); 
			if($certificate > 0){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate successfully addedd.</div>');
				redirect('provider/evaluation');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again nutan.</div>');
				redirect('provider/certificate');
			}  
			
			//  $result = $this->user->update('tbl_course',$data,'id',$cid); 
			// if($result){
			// 	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
			// 	redirect('provider/edit_certificate/'.$cid.'');
			// } else {
			// 	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			// 	redirect('provider/edit_certificate/'.$cid.'');
			// } 

		}		
	}



	public function promotion()
	{

		$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_rules('promote', 'Promote', 'trim|required');   

		if($this->form_validation->run() == FALSE)
		{
			 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['lesson'] = $this->user->get_lesson($uid);
			$this->load->frontAdmin('provider/promotion',$data);

		}  else { 

			$stts1 	= $this->input->post('promote'); 
			
			$stts   = explode('_', $stts1);

			$data['paid_status'] 	= $stts[1];

			$course_id          = $this->session->userdata('current_course_id');

			$result = $this->user->update('tbl_course',$data,'id',$course_id); 
			if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promote updated successfully.</div>');
			redirect('provider/publish');
			} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('provider/promotion');
			} 
		}			
	}



	public function publish()
	{
		$this->checkcourselogin();

		$uid = $this->session->userdata('logged_in')['id'];
		$this->load->frontAdmin('provider/publish');
	}	


	public function success()
	{
		
		$cid = $this->uri->segment(3);
		
		$data['status'] = 1;
		$result1 = $this->user->update('tbl_course',$data,'id',$cid); 
		$this->load->frontAdmin('provider/success',$cid);
	}
	public function save()
	{

		$cid = $this->uri->segment(3);
		
		$data['status'] = 0;
	
		$result1 = $this->user->update('tbl_course',$data,'id',$cid);
		$this->load->frontAdmin('provider/save',$cid);
	}


	public function evaluation()
	{
		$this->checkcourselogin();

		$question = $this->input->post('question');
		foreach ($question as $key => $value) {
		 	$data['course_id']           = $this->session->userdata('current_course_id');
			$data['evaluation_question'] = $value;
			$data['status']              = 1;
			$result = $this->user->save('tbl_evaluation',$data); 
		 } 

		 	    $data1['rating'] =  $this->input->post('rating'); 
		 	    $data1['course_evaluation_note'] =  $this->input->post('evaluation_description'); 
		 		$result1 = $this->user->update('tbl_course',$data1,'id',$this->session->userdata('current_course_id')); 


			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Evaluation created successfully.</div>');
				redirect('provider/promotion');
			}  

		    $this->load->frontAdmin('provider/evaluation');
	}



	public function users()
	{ 
		$data['users'] = $this->user->get_users_by_role('1');
		$this->load->frontAdmin('provider/users',$data); 
	}



	public function training_center_plan()
	{
		$this->load->frontAdmin('provider/training_center_plan'); 
	}
 		




	public function training_center_free()
	{

		$uid = $this->session->userdata('logged_in')['id'];
		$this->session->unset_userdata('current_training_id');

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required'); 
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required'); 
		$this->form_validation->set_rules('start_time', 'Start Time', 'trim|required'); 
		$this->form_validation->set_rules('end_time', 'End Time', 'trim|required');

		//$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
		$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required'); 
		$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
		$this->form_validation->set_rules('location', 'Location', 'trim|required'); 
		$this->form_validation->set_rules('c_person', 'Contact Person', 'trim|required'); 
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_training.email]'); 
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required'); 
		$this->form_validation->set_rules('cp_number', 'CP Number', 'trim|required'); 
		$this->form_validation->set_rules('units', 'Units', 'trim|required'); 
		$this->form_validation->set_rules('category', 'Category', 'trim|required'); 
		 

		if($this->form_validation->run() == FALSE)
		{


			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','user_id',$uid);
			$data['cat'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
			$data['purchase_plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription','user_id',$uid);

			$data['plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','status',1);
			$this->load->frontAdmin('provider/training_center_free',$data);
		
		} 
		else
		{


			$data['user_id'] 	= $uid;
			$data['speaker'] 	= $this->input->post('speaker'); 
			$data['price'] 		= $this->input->post('price'); 
			$data['location'] 	= $this->input->post('location'); 
			$data['start_date'] = $this->input->post('start_date'); 
			$data['end_date'] 	= $this->input->post('end_date'); 
			$data['start_time'] = $this->input->post('start_time'); 
			$data['end_time'] 	= $this->input->post('end_time'); 

			$data['contact_person'] 	= $this->input->post('c_person'); 
			$data['email'] 	     = $this->input->post('email'); 
			$data['phone'] 	     = $this->input->post('phone'); 
			$data['cp_number'] 	 = $this->input->post('cp_number'); 
			$data['units']   	 = $this->input->post('units'); 
			$data['category_id'] = $this->input->post('category'); 
			$data['status'] 	 = 0;
			$data['templates'] 	 = $_SESSION['templates'];
			$data['country_id']  = $this->session->userdata('logged_in')['country'];
			
	
			
		    $result = $this->user->save('tbl_training',$data); 
			$this->session->set_userdata('current_training_id', $result);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">General Information created successfully.</div>');
				redirect('provider/training_overview');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_overview');
			} 
		}
	}




 




	public function training_center()
	{


		$uid = $this->session->userdata('logged_in')['id'];
		$this->session->unset_userdata('current_training_id');

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required'); 
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required'); 
		$this->form_validation->set_rules('start_time', 'Start Time', 'trim|required'); 
		$this->form_validation->set_rules('end_time', 'End Time', 'trim|required');

		//$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
		$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required'); 
		$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
		$this->form_validation->set_rules('location', 'Location', 'trim|required'); 
		$this->form_validation->set_rules('c_person', 'Contact Person', 'trim|required'); 
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_training.email]'); 
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required'); 
		$this->form_validation->set_rules('cp_number', 'CP Number', 'trim|required'); 
		$this->form_validation->set_rules('units', 'Units', 'trim|required'); 
		$this->form_validation->set_rules('category', 'Category', 'trim|required'); 
		 

		if($this->form_validation->run() == FALSE)
		{


			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','user_id',$uid);
			$data['cat'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
			$data['purchase_plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription','user_id',$uid);

			$data['plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','status',1);
			$this->load->frontAdmin('provider/training_center',$data);
		
		}  else {


			$data['user_id'] 	= $uid;
			$data['speaker'] 	= $this->input->post('speaker'); 
			$data['price'] 		= $this->input->post('price'); 
			$data['location'] 	= $this->input->post('location'); 
			$data['start_date'] = $this->input->post('start_date'); 
			$data['end_date'] 	= $this->input->post('end_date'); 
			$data['start_time'] = $this->input->post('start_time'); 
			$data['end_time'] 	= $this->input->post('end_time'); 

			$data['contact_person'] 	= $this->input->post('c_person'); 
			$data['email'] 	     = $this->input->post('email'); 
			$data['phone'] 	     = $this->input->post('phone'); 
			$data['cp_number'] 	 = $this->input->post('cp_number'); 
			$data['units']   	 = $this->input->post('units'); 
			$data['category_id'] = $this->input->post('category'); 
			$data['status'] 	 = 0;
			$data['templates'] 	 = $_SESSION['templates'];
			$data['country_id']  = $this->session->userdata('logged_in')['country'];
			
	
			
		    $result = $this->user->save('tbl_training',$data); 
			$this->session->set_userdata('current_training_id', $result);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">General Information created successfully.</div>');
				redirect('provider/training_overview');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_overview');
			} 
		}
	}





 		
	public function training_center_edit($id)
	{

		$uid = $this->session->userdata('logged_in')['id'];
		$this->session->unset_userdata('current_training_id');

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required'); 
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required'); 
		$this->form_validation->set_rules('start_time', 'Start Time', 'trim|required'); 
		$this->form_validation->set_rules('end_time', 'End Time', 'trim|required');

		//$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
		$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required'); 
		$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
		$this->form_validation->set_rules('location', 'Location', 'trim|required'); 
		$this->form_validation->set_rules('c_person', 'Contact Person', 'trim|required'); 
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'); 
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required'); 
		$this->form_validation->set_rules('cp_number', 'CP Number', 'trim|required'); 
		$this->form_validation->set_rules('units', 'Units', 'trim|required'); 
		$this->form_validation->set_rules('category', 'Category', 'trim|required'); 
		 

		if($this->form_validation->run() == FALSE)
		{


			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','user_id',$uid);
			$data['cat'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
			$data['purchase_plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription','user_id',$uid);

			$data['plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','status',1);


			$data['trainig_data'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);

			$this->load->frontAdmin('provider/training_center_edit',$data);
		
		}  else {


				 if(isset($_FILES["attach_logo"]) && !empty($_FILES["attach_logo"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["attach_logo"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('attach_logo'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['attach_logo'] = $imageName;
			}


		if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
			$config1['upload_path'] = './assets/images/uploads/';
			$config1['allowed_types'] = 'gif|jpg|png|jpeg';
			$config1['max_size'] = '200000';
			$config1['max_width']  = '1500';
			$config1['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName1 = 'IMGS_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName1;
			$this->load->library('upload', $config1);
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('image'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['venue_photo'] = $imageName1;
			}	

			$data['user_id'] 	= $uid;
			$data['title'] 	    = $this->input->post('titles');
			$data['sub_title'] 	    = $this->input->post('sub_title');
			$data['speaker'] 	= $this->input->post('speaker'); 
			$data['price'] 		= $this->input->post('price'); 
			$data['location'] 	= $this->input->post('location'); 
			$data['start_date'] = $this->input->post('start_date'); 
			$data['end_date'] 	= $this->input->post('end_date'); 
			$data['start_time'] = $this->input->post('start_time'); 
			$data['end_time'] 	= $this->input->post('end_time'); 

			$data['contact_person'] 	= $this->input->post('c_person'); 
			$data['email'] 	    = $this->input->post('email'); 
			$data['phone'] 	    = $this->input->post('phone'); 
			$data['cp_number'] 	= $this->input->post('cp_number'); 
			$data['units'] 	= $this->input->post('units'); 
			$data['category_id'] 	= $this->input->post('category'); 
			$data['status'] 	= 0;

			$data['host_name'] 	= $this->input->post('host_name'); 
			$data['about_host'] = $this->input->post('about_host'); 
			
			
		   // $result = $this->user->update('tbl_training',$data,); 
		    $result = $this->user->update('tbl_training',$data,'id',$id); 
			$this->session->set_userdata('current_training_id', $result);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('provider/training_center_edit/'.$id.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_center_edit/'.$id.'');
			} 
		}
	}









	public function training_publish()
	{
		$this->load->frontAdmin('provider/training_publish');
	}		

	public function training_publish_edit()
	{
		$this->load->frontAdmin('provider/training_publish');
	}	




	public function training_success()
	{
		//$this->checkTraininglogin();

		$trid = $this->session->userdata('current_training_id');
		$data1['status'] = 1;
		$data1['training_type'] = 1;
		$datas['trid'] = $trid;
		$result = $this->user->update('tbl_training',$data1,'id',$trid); 
		$this->session->unset_userdata('current_course_id');
		$this->load->frontAdmin('provider/training_success',$datas);
	}


	public function training_save()
	{
		//$this->checkTraininglogin();

		$trid    = $this->session->userdata('current_training_id');
		$data1['status'] = 2;
		$data1['training_type'] = 1;
		$data1['paid_status'] = 2;
		$datas['trid'] = $trid;
		$result  = $this->user->update('tbl_training',$data1,'id',$trid); 
		$this->session->unset_userdata('current_course_id');
		$this->load->frontAdmin('provider/training_save',$datas);
	}



	public function training_promotion()
	{

		$this->checkTraininglogin();


		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_rules('promote', 'Promote', 'trim|required');   
		 

		if($this->form_validation->run() == FALSE)
		{
			 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['lesson'] = $this->user->get_lesson($uid);
			$this->load->frontAdmin('provider/training_promotion',$data);

		}  else { 

			$stts1 	= $this->input->post('promote'); 
			
			$stts   = explode('_', $stts1);

			$data['paid_status'] 	= $stts[1];

			$course_id          = $this->session->userdata('current_training_id');

			$result = $this->user->update('tbl_training',$data,'id',$course_id); 
			if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promote updated successfully.</div>');
			redirect('provider/training_publish');
			} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('provider/training_promotion');
			} 
		}			
	}







	public function training_promotion_edit()
	{

		//$this->checkTraininglogin();


		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_rules('promote', 'Promote', 'trim|required');   
		 

		if($this->form_validation->run() == FALSE)
		{
			 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['lesson'] = $this->user->get_lesson($uid);
			$this->load->frontAdmin('provider/training_promotion_edit',$data);

		}  else { 

			$stts1 	= $this->input->post('promote'); 
			
			$stts   = explode('_', $stts1);

			$data['paid_status'] 	= $stts[1];

			$course_id          = $this->session->userdata('current_training_id');

			$result = $this->user->update('tbl_training',$data,'id',$course_id); 
			if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
			redirect('provider/training_promotion_edit');
			} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('provider/training_promotion_edit');
			} 
		}			
	}



	
	public function training_overview()
	{
		
	
		$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		//$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
		$this->form_validation->set_rules('description', 'Description', 'trim|required'); 

		$this->form_validation->set_rules('objectives', 'Objectives', 'trim|required'); 
		$this->form_validation->set_rules('methodologies', 'Methodologies', 'trim|required'); 
		//$this->form_validation->set_rules('participants', 'Participants', 'trim|required'); 
		$this->form_validation->set_rules('item', 'Item', 'trim|required'); 
		

		if (empty($_FILES['image']['name'])){
		$this->form_validation->set_rules('image', 'Image', 'trim|required'); 
		}

	/*	if (empty($_FILES['video']['name'])){
		$this->form_validation->set_rules('video', 'Video', 'trim|required'); 
		}*/


		if($this->form_validation->run() == FALSE)
		{

			$this->load->frontAdmin('provider/training_overview');
		
		}  else {


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



		    if(isset($_FILES["video"]) && !empty($_FILES["video"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["video"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('video'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['video'] = $imageName;
			}




			//$data['title'] 			= $this->input->post('title'); 
			$data['description'] 	= $this->input->post('description');

			$data['objectives'] 		= $this->input->post('objectives'); 
			$data['methodologies'] 		= $this->input->post('methodologies'); 
			$data['participants'] 		= implode(',', $this->input->post('participants')); 
			$data['item_to_bring'] 		= $this->input->post('item'); 
			
		    $result = $this->user->update('tbl_training',$data,'id',$trid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training created successfully.</div>');
				redirect('provider/training_speaker');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_overview');
			} 
		}
	}

	 



	
	public function training_evaluation()
	{
		
	
		$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('evaluation_name', 'Training Evaluation', 'trim|required'); 
 

		if($this->form_validation->run() == FALSE)
		{ 
			$this->load->frontAdmin('provider/training_evaluation');
		
		}  else {



			$data['training_id'] 	     = $trid; 
			$data['evaluation_type'] = $this->input->post('evaluation_question_type'); 
			$data['evaluation_question'] = $this->input->post('evaluation_name'); 
			$data['status'] 			 = 1;  
			
		    $result = $this->user->save('tbl_training_evaluation',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training evaluation added successfully.</div>');
				redirect('provider/training_evaluation');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_evaluation');
			} 
		}
	}








	
	public function training_certificate()
	{
		
	
		$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('header_content', 'Header Content', 'trim|required'); 
		$this->form_validation->set_rules('signatory_name', 'Signatory Name', 'trim|required'); 
		$this->form_validation->set_rules('position', 'Position', 'trim|required'); 
 

		if (empty($_FILES['logo']['name']))
		{
		 $this->form_validation->set_rules('logo', 'Logo', 'required');
		}	


		if($this->form_validation->run() == FALSE)
		{ 
			$this->load->frontAdmin('provider/training_certificate');
		
		}  else {



			if(isset($_FILES["logo"]) && !empty($_FILES["logo"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["logo"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('logo'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['logo'] = $imageName;
			}


			if(isset($_FILES["video"]) && !empty($_FILES["video"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["video"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('video'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['video'] = $imageName;
			}


			$data['training_id'] 	     = $trid; 
			$data['header_content']      = $this->input->post('header_content'); 
			$data['signatory_name']      = $this->input->post('signatory_name'); 
			$data['position']            = $this->input->post('position'); 
			$data['status'] 			 = 1;  

			
			
		    $result = $this->user->save('tbl_training_certificate_lists',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training certificate added successfully.</div>');

					if($_REQUEST['save']=="Add Signatory"){
						redirect('provider/training_certificate');
					} else {
						redirect('provider/training_sponsors');
					}

		
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_certificate');
			} 
		}
	}






public function training_certificate_edit($idd)
	{
		
	
		$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('header_content', 'Header Content', 'trim|required'); 
		$this->form_validation->set_rules('signatory_name', 'Signatory Name', 'trim|required'); 
		$this->form_validation->set_rules('position', 'Position', 'trim|required'); 
 
 


		if($this->form_validation->run() == FALSE)
		{ 	
			  $data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_training_certificate_lists','id',$idd);
			 $this->load->frontAdmin('provider/training_certificate_edit',$data);
		
		}  else {



			if(isset($_FILES["logo"]) && !empty($_FILES["logo"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["logo"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('logo'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['logo'] = $imageName;
			}


			if(isset($_FILES["video"]) && !empty($_FILES["video"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["video"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('video'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['video'] = $imageName;
			}

 
			$data['header_content']      = $this->input->post('header_content'); 
			$data['signatory_name']      = $this->input->post('signatory_name'); 
			$data['position']            = $this->input->post('position'); 
			
			$idd            = $this->input->post('idd'); 
				
	        $result = $this->user->update('tbl_training_certificate_lists',$data,'id',$idd); 

			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training certificate updated successfully.</div>');

						redirect('provider/training_certificate'); 
		
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_certificate');
			} 
		}
	}


	
	public function training_evaluation_edit($id)
	{
		
		//$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('evaluation_name', 'Training Evaluation', 'trim|required'); 
 

		if($this->form_validation->run() == FALSE)
		{ 
			$this->load->frontAdmin('provider/training_evaluation_edit');
		
		}  else {



			$data['training_id'] 	     = $trid; 
			$data['evaluation_question'] = $this->input->post('evaluation_name'); 
			$data['status'] 			 = 1;  
			
		    $result = $this->user->save('tbl_training_evaluation',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training evaluation updated successfully.</div>');
				redirect('provider/training_evaluation_edit/'.$id.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_evaluation_edit/'.$id.'');
			} 
		}
	}


	
	public function training_overview_edit($id)
	{
		
	
		//$this->checkTraininglogin();
		$trid = $this->input->post('training_id'); 

		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
		$this->form_validation->set_rules('description', 'Description', 'trim|required'); 

		$this->form_validation->set_rules('objectives', 'Objectives', 'trim|required'); 
		$this->form_validation->set_rules('methodologies', 'Methodologies', 'trim|required'); 
		//$this->form_validation->set_rules('participants', 'Participants', 'trim|required'); 
		


		if($this->form_validation->run() == FALSE)
		{ 
			
			$data['trainig_data'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);
			$this->load->frontAdmin('provider/training_overview_edit',$data);

		}  else {


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



		    if(isset($_FILES["video"]) && !empty($_FILES["video"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["video"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('video'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['video'] = $imageName;
			}

			$data['title'] 			= $this->input->post('title'); 
			$data['description'] 	= $this->input->post('description');
			$data['objectives'] 		= $this->input->post('objectives'); 
			$data['methodologies'] 		= $this->input->post('methodologies'); 
			$data['participants'] 		= implode(',', $this->input->post('participants')); 
			$data['item_to_bring'] 		= $this->input->post('item'); 


			
		    $result = $this->user->update('tbl_training',$data,'id',$trid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training overview updated successfully.</div>');
				redirect('provider/training_overview_edit/'.$trid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_overview_edit/'.$trid.'');
			} 
		}
	}







	public function enquiry()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('type', 'Type', 'trim|required'); 
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required'); 
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required'); 
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'); 
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{

			$this->load->frontAdmin('provider/enquiry');
		
		}  else { 


			$data['etype'] 			= $this->input->post('type'); 
			$data['first_name'] 	= $this->input->post('first_name');  
			$data['last_name'] 		= $this->input->post('last_name');  
			$data['email'] 			= $this->input->post('email');  
			$data['subject'] 		= $this->input->post('subject');  
			$data['message'] 		= $this->input->post('message');  
			
		    $result = $this->user->save('tbl_enquiry',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Thank you for your messgae.</div>');
				redirect('provider/enquiry');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/enquiry');
			} 
		}
	}



/*	public function profile()
	{
		$uid = $this->session->userdata('logged_in')['id'];
			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		$this->load->frontAdmin('provider/profile',$data);
	}*/





	public function profile()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
		$this->form_validation->set_rules('profession', 'Profession', 'trim|required'); 
		$this->form_validation->set_rules('location', 'Location', 'trim|required');  
		$this->form_validation->set_rules('address', 'Address', 'trim|required'); 

		$this->form_validation->set_rules('fb_url', 'Facebook Url', 'trim|required'); 
		$this->form_validation->set_rules('tw_url', 'Twitter Url', 'trim|required'); 
		$this->form_validation->set_rules('gpus_url', 'Google plus Url', 'trim|required'); 
		$this->form_validation->set_rules('insta_url', 'Instagram Url', 'trim|required'); 


		/*if (empty($_FILES['image']['name'])){
		$this->form_validation->set_rules('image', 'Image', 'trim|required'); 
		}*/

		if($this->form_validation->run() == FALSE)
		{

			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		    $this->load->frontAdmin('provider/profile',$data);
		
		}  else {


			if(isset($_FILES["image"]['name']) && !empty($_FILES["image"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName = $ext[0].time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
			{
			   $error = array('error' => $this->upload->display_errors());                       
			   echo '<pre>';print_r($error); die;		
			}   
			
			  $data['image'] = $imageName;
			
			}



			if(isset($_FILES["logo"]['name']) && !empty($_FILES["logo"]['name'])){
				$ext="";
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["logo"]["name"]);        
			$imageName = $ext[0].rand(9,99999999).'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('logo'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			} 
		    	$data['logo'] = $imageName;
			}
			
          if(isset($_FILES["backimage"]['name']) && !empty($_FILES["backimage"]['name'])){
				$ext="";
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '3000';
			$config['max_height']  = '1000';        
			$ext = explode('.',$_FILES["backimage"]["name"]);        
			$imageName = $ext[0].rand(9,99999999).'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('backimage'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			} 
		    	$data['backimage'] = $imageName;
			}

			$data['name'] 		= $this->input->post('name'); 
			$data['role'] 	    = $this->input->post('profession'); 
			$data['profession'] 	= $this->input->post('category'); 
			//$data['price'] 		= $this->input->post('price'); 
			$data['location'] 	= $this->input->post('location');  
			$data['address'] 	= $this->input->post('address');  

			$data['fb_url'] 	= $this->input->post('fb_url');  
			$data['tw_url'] 	= $this->input->post('tw_url');  
			$data['gpus_url'] 	= $this->input->post('gpus_url');  
			$data['insta_url'] 	= $this->input->post('insta_url');  


			
		    $result = $this->user->update('tbl_user',$data,'id',$uid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
				redirect('provider/profile');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/profile');
			} 
		}
	}




public function notification()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{

			$this->load->frontAdmin('provider/notification');
		
		}  else {  

			$uid = $this->session->userdata('logged_in')['id'];

			$data['subject'] 		= $this->input->post('subject');  
			$data['message'] 		= $this->input->post('message');  
			$data['user_id'] 		= $uid;  
			$data['added_on'] 		= date('y-m-d h:i:s');
			
		    $result = $this->user->save('tbl_notification',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Notification sent.</div>');
				redirect('provider/notification');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/notification');
			} 
		}
	}




public function purchase_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		
		 $data['advertise'] = $this->advertiseads->getAdvertiseAddsList($uid);
             	
		$this->load->frontAdmin('provider/advertise',$data);
		
	}




 public function income_report()
	{

		$report_type = $_REQUEST['otri'];
		
	  if($report_type != 1){
	  
		$uid = $this->session->userdata('logged_in')['id'];		
		$data['today'] = $this->user->get_report('today',$uid);
		$data['month'] = $this->user->get_report('month',$uid);
		$data['year']  = $this->user->get_report('year',$uid);
		$data['total'] = $this->user->get_report('total',$uid);
		$this->load->frontAdmin('provider/income_report',$data);
	  } else {
	  
	  	$uid = $this->session->userdata('logged_in')['id'];		
		$data['today'] = $this->user->get_report1('today',$uid);
		$data['month'] = $this->user->get_report1('month',$uid);
		$data['year']  = $this->user->get_report1('year',$uid);
		$data['total'] = $this->user->get_report1('total',$uid);
		$this->load->frontAdmin('provider/income_report_otri',$data);
	  
	  }

	}






 public function training_registration()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['registration'] = $this->user->get_record_by_field_name_all_record('tbl_training_book','status',1);
		$this->load->frontAdmin('provider/training_registration',$data);
	
	}
	



 public function training_registration_view($tid)
	{
		 
		$uid = $this->session->userdata('logged_in')['id'];
		$data['registration'] = $this->user->get_record_by_field_name_all_record('tbl_training_book','id',$tid);
		$this->load->frontAdmin('provider/training_registration_view',$data);
	
	}

	


 public function course_status($idd,$stts)
	{ 
		if($stts==1){
		 $data['status'] =0;
		} else {
		 $data['status'] =1;
		}

		$result = $this->user->update('tbl_course',$data,'id',$idd); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Status updated successfully.</div>');
				redirect('provider/course_listing');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/course_listing');
			}
	}



 public function presentstatus($stts,$idd,$tid)
	{ 
		if($stts==1){
		 $data['present_status'] = 0;
		} else {
		 $data['present_status'] = 1;
		}

		$result = $this->user->update('tbl_training_book',$data,'id',$idd); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Status updated successfully.</div>');
				redirect('provider/training_center_view/'.$tid);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_center_view/'.$tid);
			}
	}






 public function deletecerti($idd,$tid)
	{ 
	 
		$result = $this->user->delete('tbl_training_book','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record deleted successfully.</div>');
				redirect('provider/training_center_view/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_center_view/'.$tid.'');
			}

		die;
	}
 





 public function staff_delete($idd,$tid)
	{ 
	 
		$result = $this->user->delete('tbl_institution_staff','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record deleted successfully.</div>');
				redirect('provider/staffcerecords/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/staffcerecords/'.$tid.'');
			}

		die;
	}
 


 public function target_delete($idd,$tid)
	{ 
	 
		$result = $this->user->delete('tbl_provider_set_target','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record deleted successfully.</div>');
				redirect('provider/set_target/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/set_target/'.$tid.'');
			}

		die;
	}




 public function course_delete($idd)
	{ 
	 
		$result = $this->user->delete('tbl_course','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Course deleted successfully.</div>');
				redirect('provider/course_listing');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/course_listing');
			}

		die;
	}
 

  public function tutorials()
	{
		$data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$this->load->frontAdmin('provider/tutorials',$data);
	}

 public function terms()
	{
		$data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$this->load->frontAdmin('provider/terms',$data);
	}	


   	public function training_center_list()
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training','user_id',$uid);
			$this->load->frontAdmin('provider/training_center_list',$data);
	}
	public function training_center_list1()
	{
			$this->load->database();			//$uid = $this->session->userdata('logged_in')['id'];
			$this->db->where('id', $_REQUEST['id']);
			$data=$this->db->get('tbl_training')->row_array();
			
			// print_r($data);
			echo json_encode($data);
	}

   	public function training_center_view($idd)
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$this->load->frontAdmin('provider/training_center_view',$data);

		}





 public function training_evaluation_add()
	{  

		$data['evaluation_question'] = $this->input->post('evaluation_name');
		$data['training_id'] = $this->input->post('tid');
		$data['evaluation_type'] = $this->input->post('evaluation_question_type');
		$data['status']      = 1;
		 $tid = $this->input->post('tid');

		$result = $this->user->save('tbl_training_evaluation',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Status updated successfully.</div>');
				redirect('provider/training_evaluation_edit/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_evaluation_edit/'.$tid.'');
			}
	}




 public function taining_status($idd,$stts)
	{ 
		if($stts==1){
		 $data['status'] =0;
		} else {
		 $data['status'] =1;
		}

		$result = $this->user->update('tbl_training',$data,'id',$idd); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Status updated successfully.</div>');
				redirect('provider/training_center_list');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_center_list');
			}
	}



 public function training_delete($idd)
	{ 
	 
		$result = $this->user->delete('tbl_training','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training deleted successfully.</div>');
				redirect('provider/training_center_list');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_center_list');
			}

		die;
	}



 public function evaluation_delete($idd,$tid)
	{ 
	 
		$result = $this->user->delete('tbl_training_evaluation','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training evaluation deleted successfully.</div>');
				redirect('provider/training_evaluation_edit/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_evaluation_edit/'.$tid.'');
			}

		die;
	}





public function active_promotion()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['purchase_list'] = $this->user->get_active_promotion($uid);
		$data['previous_list'] = $this->user->get_previous_promotion($uid);
		//print_r($data['purchase_list']); die;
		$this->load->frontAdmin('provider/active_promotion',$data);
	}
public function exam_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->db->order_by('id','desc');
		$data['exam_list'] = $this->db->get('tbl_exam')->result_array();
		$this->load->frontAdmin('provider/exam_list',$data);
	}

public function subscription()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$data['subs_list'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription','user_id',$uid);

		$this->load->frontAdmin('provider/subscription_list',$data);
	}



public function subscription_buy()
	{

		    $uid = $this->session->userdata('logged_in')['id'];
     		$data['user_id']   = $uid;
     		$data['plan_id']   = $_REQUEST['item_name'];
     		$data['no_of_subscription']   = $_REQUEST['item_number'];
     		$data['txn_id']    = $_REQUEST['txn_id'];
     		$data['payment_status']   = $_REQUEST['payment_status'];
			$result = $this->user->save('tbl_course',$data);


			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Subscription purchse successfully.</div>');
				redirect('provider/subscription');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/subscription');
			}

	}


  public function cancel_subscription()
	{
			
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/subscription');
	}




 public function lesson_delete($cid,$lid)
	{ 

		$result = $this->user->delete('tbl_lesson','id',$lid); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Lesson deleted successfully.</div>');
				redirect('provider/lesson_edit/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/lesson_edit/'.$cid.'');
			}

		die;
	}

	public function delete_quiz($cid,$qid)
	{ 

		$result = $this->user->delete('tbl_quiz_question','id',$qid); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Lesson deleted successfully.</div>');
				redirect('provider/edit_quiz/'.$cid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_quiz/'.$cid.'');
			}

		die;
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
	       	   	  redirect('provider/course_listing');
				} else {
	       	   	  redirect('provider/publish/');
				}
				
			//redirect('provider/publish/');
			
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				if($_REQUEST['id']==1){
	       	   	  redirect('provider/course_listing');
				} else {
	       	   	  redirect('provider/publish/');
				}

			}	


	} else {
		echo "There is some error. Please try again.";
	}

	}











	public function training_promote_success()
	{
		//echo '<pre>';print_r($_REQUEST);
		//die;

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

 


		$data2['paid_status'] 	= $_REQUEST['item_name'];
		$data2['training_type'] 	= 1;
		$result = $this->user->update('tbl_training',$data2,'id',$_REQUEST['item_number']);


		

		if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promote successfully.</div>');
				if($_REQUEST['id']==1){
	       	   	  redirect('provider/course_listing');
				} else {
	       	   	  redirect('provider/publish/');
				}
				
			//redirect('provider/publish/');
			
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				if($_REQUEST['id']==1){
	       	   	  redirect('provider/course_listing');
				} else {
	       	   	  redirect('provider/publish/');
				}

			}	


	} else {
		echo "There is some error. Please try again.";
	}

	}















   public function course_promote_cancel()
	{
		echo '<pre>'; print_r($_REQUEST);
	}




public function promoteprovider()
    {
     
        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required'); 

        if (empty($_FILES['image']['name'])){
         $this->form_validation->set_rules('image', 'Course Photo', 'trim|required');
        }
 
        if($this->form_validation->run() == FALSE)
        { 
            $this->load->view('provider/overview');

        
        }  else {

          if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
           // $config['upload_path'] = './uploads/';
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

            //print_r($this->input->post('profession')); die;

            $data['title']          = $this->input->post('title');
            $data['description']    = $this->input->post('description');
            $data['user_id']        = 1;
            //$data['user_id']        = $this->session->userdata('logged_in')['id'];
            $data['status']         = 1;
            $data['added_on']         = date('Y-m-d');

            $panData1 = $this->input->post('promote_company');
            $panData  = explode('_', $panData1);

            $data['plan_amount']            = $panData[0];
            $data['plan_name']              = $panData[1];
            $data['payment_status']         = 0;


            $lastId = $this->user->save('tbl_promoted_provider',$data);
          
            if($lastId){
            if($panData[0] !=0){	
            ?>
			<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
			<input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="item_name" id="item_name" value="Plan_<?php echo $lastId;?>">
			<input type="hidden" name="item_number" value="1">
			<input type="hidden" name="credits" value="510">
			<input type="hidden" name="userid" value="1">
			<input type="hidden" name="amount" id="amount" value="<?php echo $panData[0];?>">
			<input type="hidden" name="tax" value="0">
			<input type='hidden' name='rm' value='2'>
			<input type="hidden" name="no_shipping" value="1">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="handling" value="0">
			<input type="hidden" name="cancel_return" value="<?php echo site_url()?>/provider/company_prmote_fail">
			<input type="hidden" name="return" value="<?php echo site_url()?>/provider/company_prmote_success">
			</form>

			<script type="text/javascript">	
		     document.getElementById("frmPayPal1").submit();
			</script>
			<?php die; ?>
			<?php 
			}
			?>
            <?php  

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promoted successfully.</div>');
                redirect('provider/dashboard');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                 redirect('provider/dashboard');

            }
      }
}


public function dailypromoteprovider()
    {
     
        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
        $this->form_validation->set_rules('dailyprice', 'daily price', 'trim|required');
        $this->form_validation->set_rules('day', 'day', 'trim|required');       
 
        if($this->form_validation->run() == FALSE)
        { 
            $this->load->view('provider/overview');

        
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
			<input type="hidden" name="cancel_return" value="<?php echo site_url()?>/provider/company_prmote_fail">
			<input type="hidden" name="return" value="<?php echo site_url()?>/provider/company_prmote_success">
			</form>

			<script type="text/javascript">	
		     document.getElementById("frmPayPal1").submit();
			</script>
			<?php die; ?>
			
            <?php  

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promoted successfully.</div>');
                redirect('provider/dashboard');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                 redirect('provider/dashboard');

            }
      }
}

/*public function company_prmote_success(){
	$idd = explode('_', $_REQUEST['item_name']);
	$data11['payment_status']  = 1;
	$result = $this->user->update('tbl_promoted_provider',$data11,'id',$idd[1]);

	$this->load->view('template/header_home');
	$this->load->view('pages/thanks');
	$this->load->view('template/footer_home');

}
*/

public function company_prmote_success(){
	$idd = explode('_', $_REQUEST['item_name']);	
	$day=trim($idd[1]);		
	$userid=$this->session->userdata('logged_in')['id'];
	$promotedData['provider_id']=$userid;
	$promotedData['promoted_date']=date('Y-m-d');
	$promotedData['promoted_day']=$day;
	$promotedData['promoted_amount']=$_REQUEST['amount'];
	$promotedData['transaction_detail']=json_encode($_REQUEST);
	$this->user->save('tbl_promoted_provider_transaction',$promotedData);
	
	$featuredData['featured_from']=date('Y-m-d');
	$featuredData['featured_to']=date('Y-m-d', strtotime("+$day days"));
	
	$result = $this->user->update('tbl_user',$featuredData,'id',$userid);

	$this->load->view('template/header_home');
	$this->load->view('pages/thanks');
	$this->load->view('template/footer_home');

}

public function company_prmote_fail(){
	echo "Payment failed please try again.";
}



public function showBill(){
	   $data['idd'] =  $this->input->post('idd');

	   $data['purschase_detais'] = $this->user->get_record_by_field_name_all_record('tbl_purchase_llis','id',$data['idd']);

	   $data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$data['purschase_detais'][0]['user_id']);
	 
	   $this->load->view('professional/receipt',$data);
}


public function purchasedetails(){
	    $datedata = $this->input->post('datedata');
	    $data['totalData'] =  $this->user->getpaydetails($datedata);
	    //print_r($data); die;
		$this->load->view('provider/purchsedetails',$data);
	   }







public function training_speaker()
    {       


    	$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];


        $this->form_validation->set_rules('position', 'Position', 'trim|required');   
        $this->form_validation->set_rules('insititution', 'Insititution', 'trim|required'); 

        $this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('description', 'Description', 'trim|required');  

        if (empty($_FILES['speaker_image']['name']))
        {
        $this->form_validation->set_rules('speaker_image', 'Speaker Image', 'required');
        } 

        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_speaker',$data);
            
        }  else { 



            if(isset($_FILES["speaker_image"]["name"]))  
           {  

               	$config['upload_path'] = './assets/images/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';    


                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload('speaker_image'))  
                {  
                     echo $this->upload->display_errors();   die;
                }  
                else  
                {  
                     $data1 = $this->upload->data();
                     $data['speaker_image']  =  $data1["file_name"];   
                } 


                $data['training_id']         =  $trid;  
                $data['speaker_name']        =  $this->input->post('speaker_name');  
                $data['position']            =  $this->input->post('position');  
                $data['insititution']        =  $this->input->post('insititution');  
                $data['speaker_description'] =  $this->input->post('description');   
               // $data['speaker_image']       =  $this->input->post('description');   
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d');  

                $result = $this->user->save('tbl_training_speaker',$data);

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker added successfully.</div>');
                redirect('provider/training_speaker');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_speaker');
            } 

        }       
    }
}







public function training_speaker_edit($id)
    {       

    	//$this->checkTraininglogin();
		$trid = $this->input->post('tid'); 
		$uid  = $this->session->userdata('logged_in')['id'];

        $this->form_validation->set_rules('position', 'Position', 'trim|required');   
        $this->form_validation->set_rules('insititution', 'Insititution', 'trim|required');   

        $this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('description', 'Description', 'trim|required');  

    
        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_speaker_edit',$data);
            
        }  else { 



            if(isset($_FILES["speaker_image"]["name"]))  
           {  

               	$config['upload_path'] = './assets/images/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';    


                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload('speaker_image'))  
                {  
                     echo $this->upload->display_errors();   die;
                }  
                else  
                {  
                     $data1 = $this->upload->data();
                     $data['speaker_image']  =  $data1["file_name"];   
                } 


                $data['training_id']         =  $trid;  
                $data['speaker_name']        =  $this->input->post('speaker_name');  
                $data['speaker_description'] =  $this->input->post('description');  

				$data['position']            =  $this->input->post('position');  
				$data['insititution']        =  $this->input->post('insititution');  

                // $data['speaker_image']       =  $this->input->post('description');   
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d');  

                $result = $this->user->save('tbl_training_speaker',$data);

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker added successfully.</div>');
                redirect('provider/training_speaker_edit/'.$trid.'');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_speaker_edit/'.$trid.'');
            } 

        }       
    }
}







public function training_speaker_update($id,$tid)
    {       

    	//$this->checkTraininglogin();
		$trid = $tid; 
		$uid  = $this->session->userdata('logged_in')['id'];

        $this->form_validation->set_rules('position', 'Position', 'trim|required');   
        $this->form_validation->set_rules('insititution', 'Insititution', 'trim|required');   

        $this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('description', 'Description', 'trim|required');  

    
        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_speaker_update',$data);
            
        }  else { 
 

           if($_FILES["speaker_image"]["name"]!="")  
           {  

           

               	$config['upload_path'] = './assets/images/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';    


                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload('speaker_image'))  
                {  
                     echo $this->upload->display_errors();   die;
                }  
                else  
                {  
                     $data1 = $this->upload->data();
                     $data['speaker_image']  =  $data1["file_name"];   
                } 
            }


            	$tid  = $this->input->post('tid');
            	$sid  = $this->input->post('sid');

                
                $data['speaker_name']        =  $this->input->post('speaker_name');  
                $data['speaker_description'] =  $this->input->post('description');  

				$data['position']            =  $this->input->post('position');  
				$data['insititution']        =  $this->input->post('insititution');  

                $result = $this->user->update('tbl_training_speaker',$data,'id',$sid);

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker updated successfully.</div>');
                redirect('provider/training_speaker_edit/'.$tid.'');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_speaker_edit/'.$tid.'');
            } 

             
    }
}






 public function committee_delete($idd,$tid)
	{ 
	 
		$result = $this->user->delete('tbl_training_committee','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Committee deleted successfully.</div>');
				redirect('provider/training_committee_edit/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_committee_edit/'.$tid.'');
			}

		die;
	}




 public function sponsors_delete($idd,$tid)
	{ 
	 
		$result = $this->user->delete('tbl_training_sponsors','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker deleted successfully.</div>');
				redirect('provider/training_sponsors_edit/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_sponsors_edit/'.$tid.'');
			}

		die;
	}

 public function speaker_delete($idd,$tid)
	{ 
	 
		$result = $this->user->delete('tbl_training_speaker','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker deleted successfully.</div>');
				redirect('provider/training_speaker_edit/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_speaker_edit/'.$tid.'');
			}

		die;
	}



 public function speaker_delete_lists($idd,$tid)
	{ 
	 
		$result = $this->user->delete('tbl_training_certificate_lists','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker deleted successfully.</div>');
				redirect('provider/training_certificate/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_certificate/'.$tid.'');
			}

		die;
	}




 public function schedule_delete($idd,$tid)
	{ 
	 
		$result = $this->user->delete('tbl_training_schedule','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Schedule deleted successfully.</div>');
				redirect('provider/training_schedule_edit/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_schedule_edit/'.$tid.'');
			}

		die;
	}





public function training_schedule()
    {       

    	$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];


        $this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');     
        $this->form_validation->set_rules('schedule_date', 'Schedule Date', 'trim|required');     
        $this->form_validation->set_rules('schedule_start_time', 'Schedule Start Time', 'trim|required');     
        $this->form_validation->set_rules('schedule_end_time', 'Schedule End Time', 'trim|required');     
        $this->form_validation->set_rules('topic', 'Topic', 'trim|required');     


        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$trid);
            //$this->load->frontAdmin('provider/training_center_list',$data);
            $this->load->frontAdmin('provider/training_schedule',$data);
            
        }  else { 


                $data['topic']          =  $this->input->post('topic');  
                $data['training_id']         =  $trid;  
                $data['speaker_id']          =  $this->input->post('speaker');  
                $data['schedule_date']       =  $this->input->post('schedule_date');  
                $data['schedule_start_time'] =  $this->input->post('schedule_start_time');   
                $data['schedule_end_time']   =  $this->input->post('schedule_end_time');   
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d');  

               $result = $this->user->save('tbl_training_schedule',$data);

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Schedule added successfully.</div>');
                redirect('provider/training_schedule');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_schedule');
            }               
       }
}
 







public function updatesettarget()
    {       

    	//$this->checkTraininglogin();
		$trid 		 = $this->input->post('cource_id'); 

  
                $data['cource_name']          =  $this->input->post('cource_name');  
                $data['category']        =  $this->input->post('category_name');  
                $data['total_staff']          =  $this->input->post('total_staff');   
                $data['target_number']        =  $this->input->post('target_number');   
                

               
               $result = $this->user->update('tbl_provider_set_target',$data,'id',$trid);

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
                redirect('provider/set_target/'.$training_id);
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/set_target/'.$training_id);
            }               
     
}
 





public function training_schedule_update()
    {       

    	//$this->checkTraininglogin();
		$trid 		 = $this->input->post('tid1');
		$training_id = $this->input->post('training_id');
		$uid 		 = $this->session->userdata('logged_in')['id']; 


                $data['topic']               =  $this->input->post('topic1');  
                $data['training_id']         =  $training_id;  
                $data['speaker_id']          =  $this->input->post('speaker1');  
                $data['schedule_date']       =  $this->input->post('schedule_date1');  
                $data['schedule_start_time'] =  $this->input->post('schedule_start_time1');   
                $data['schedule_end_time']   =  $this->input->post('schedule_end_time1');   
                $data['speaker_name']        =  $this->input->post('others1');   
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d');  

               
               $result = $this->user->update('tbl_training_schedule',$data,'id',$trid);

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Schedule updated successfully.</div>');
                redirect('provider/training_schedule_edit/'.$training_id);
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_schedule_edit/'.$training_id);
            }               
     
}
 







public function training_schedule_edit($id)
    {       

    	//$this->checkTraininglogin();
		//$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];
		$trid = $this->input->post('tid');


        $this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');     
        $this->form_validation->set_rules('schedule_date', 'Schedule Date', 'trim|required');     
        $this->form_validation->set_rules('schedule_start_time', 'Schedule Start Time', 'trim|required');     
        $this->form_validation->set_rules('schedule_end_time', 'Schedule End Time', 'trim|required');     
        $this->form_validation->set_rules('topic', 'Topic', 'trim|required');     


        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$id);
            //$this->load->frontAdmin('provider/training_center_list',$data);
            $this->load->frontAdmin('provider/training_schedule_edit',$data);
            
        }  else { 


                $data['topic']               =  $this->input->post('topic');  
                $data['training_id']         =  $trid;  
                $data['speaker_id']          =  $this->input->post('speaker');  
                $data['schedule_date']       =  $this->input->post('schedule_date');  
                $data['schedule_start_time'] =  $this->input->post('schedule_start_time');   
                $data['schedule_end_time']   =  $this->input->post('schedule_end_time');   
                $data['speaker_name']        =  $this->input->post('others');   
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d');  

               $result = $this->user->save('tbl_training_schedule',$data);

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Schedule added successfully.</div>');
                redirect('provider/training_schedule_edit/'.$trid.'');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_schedule_edit/'.$trid.'');
            }               
       }
}







public function saverating(){
	echo "working fine";
	print_r($_REQUEST);
}



public function savecourserating(){
	
	   $evaluationRating = $this->input->post();
	   
	   $questionid=$evaluationRating['questionid'];
	   
	   $reviewData=array();
	   foreach($questionid as $id)
	   {
		   $item=array();
		   
		   $item['course_id']=$evaluationRating['cid'];
		   $item['user_id']=$this->session->userdata('logged_in')['id'];
		   $item['question_id']=$id;
		   $item['star_mark']=$evaluationRating["rating$id"];
		   $item['comments']=$evaluationRating['evaluation'];
		  $reviewData[]= $item;
		   $result = $this->user->save('tbl_course_review',$item);
	   }
	  
	    

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Review submited successfully.</div>');
                redirect('pages/evaluation/'.$evaluationRating['cid'].'');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('pages/evaluation/'.$evaluationRating['cid'].'');
            }    
}




public function create_invoice()
    {       

    	//$this->checkTraininglogin();
		//$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];

 

        if($_REQUEST['payment_method']=="paypal"){
          $this->form_validation->set_rules('paypalId', 'Paypal Id', 'trim|required');   
        } else {

        $this->form_validation->set_rules('bank_account', 'Bank Account', 'trim|required');     
        $this->form_validation->set_rules('bank_code', 'Bank Code', 'trim|required');     
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');     
        $this->form_validation->set_rules('swift_code', 'Swift Code', 'trim|required');     
        }

        if($this->form_validation->run() == FALSE)
        {  
        	 
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Please fill all the required fields.</div>');
                redirect('provider/income_report');
            
        }  else { 


                $data['month_name']          =  $this->input->post('invoice_date');  
                $data['user_id']             =  $this->session->userdata('logged_in')['id'];  
                $data['payment_method']      =  $this->input->post('payment_method');  
                $data['total_amount']        =  $this->input->post('total_amount');  
                $data['admin_amount']        =  $this->input->post('adminIncome');  
                $data['cpd_amount']          =  $this->input->post('cpdIncome');  

                if($data['payment_method']=="paypal"){
                  $data['paypal_id']          =  $this->input->post('paypalId');  
                }

                if($data['payment_method']=="bank"){
                  $data['bank_account']          =  $this->input->post('bank_account');  
                  $data['bank_code']             =  $this->input->post('bank_code');  
                  $data['bank_name']           =  $this->input->post('branch_name');  
                  $data['swift_code']            =  $this->input->post('swift_code');  
                }

                  
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d');  

               $result = $this->user->save('tbl_invoice',$data);

               $excludeDate = explode('-', $this->input->post('invoice_date'));

               $yy = $excludeDate[0];
               $mm = $excludeDate[1];


            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Invoice has been sent to admin.</div>');
                redirect('provider/income_report?month='.$mm.'&year='.$yy.'');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/income_report?month='.$mm.'&year='.$yy.'');
            }               
       }
}
 






public  function mypdf($cpdid,$cust_id){ 

	//echo $cpdid.'_'.$cust_id; die;
	 $data['cust_data'] = $this->user->get_record_by_field_name_all_record('tbl_training_book','id',$cust_id);
	 $data['cpd_data']  = $this->user->get_record_by_field_name_all_record('tbl_user','id',$cpdid);
	 $data['training_data']  = $this->user->get_record_by_field_name_all_record('tbl_training','id',$data['cust_data'][0]['training_seminar_id']);
	 
	 $filename = "CERTI".rand(9,9999999).time();

	 $data['certificate_no'] = $filename;


	if($data['cust_data'][0]['certificate_id'] =="2"){
		?>
		<div style="text-align: center;">
		<p style="font-size: 17px;">You have already generated the certificate for this professional.</p>
		<a href="<?php echo site_url('provider/training_center_list'); ?>">BACK</a>
		</div>
		<?php 
	} else {

	$data1['certificate_id'] = $data['certificate_no'];
	$this->user->update('tbl_training_book',$data1,'id',$cust_id);

	$this->load->view('templates/template1/template',$data);
	// Get output html
	$html = $this->output->get_output();
	$this->load->library('Dompdf_gen');
	$this->dompdf->load_html($html);
	$this->dompdf->render(); 
	//$filename = rand(9,999999).time();
	//$this->dompdf->stream($filename.".pdf");
	file_put_contents('assets/upload/pdf/'.$filename.'.pdf', $this->dompdf->output($html));
	//echo "Certificate generated successfully."; 


	$subject = "Certificate";
	$message = "Your certificate for the symposium in it to win it towards healthcare excellence is not issue.";

	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");
	$this->email->from('mails@ceonpoint.com');
	//$this->email->to('deepak.1999.kumar@gmail.com');
	$this->email->to($data['cust_data'][0]['email']);
	$this->email->subject($subject);
	$this->email->message($message);
	$this->email->attach('assets/upload/pdf/'.$filename.'.pdf');
	if($this->email->send())
	{
	}
	else
	{
	show_error($this->email->print_debugger());
	}
	}

   }


	public  function setdefault(){ 

		$default = $this->input->post('idd');
		$uid = $this->session->userdata('logged_in')['id'];
		$datas['default_template'] = $default;
		$result  = $this->user->update('tbl_user',$datas,'id',$uid);
		echo 1;
	}
   

	public  function setformdata(){ 

		$vals = $this->input->post('vals');
		$data['target'] = $this->user->get_record_by_field_name_all_record('tbl_provider_set_target','id',$vals);
        $this->load->view('provider/targetedit',$data);
		//echo 1;
	}
   



public function success_provider_plan(){
	$items = explode('_', $_REQUEST['item_name']);
	$plan  = $items[0];
	$tid   = $_REQUEST['item_name'];
	$uid   = $this->session->userdata('logged_in')['id'];

	$certId = $this->session->userdata('current_certificate_id');

    $datas['payment_status']       = 1;
    $datas['payment_status']       = $_REQUEST['txn_id'];
    if($_REQUEST['item_name']){
    	$result = $this->user->update('tbl_training_certificate',$datas,'id',$uid);
    }
    //$this->session->unset_userdata('current_certificate_id');
	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Payment has been completed successfully.</div>');
				redirect('provider/generate_certificate/'.$tid.'');

}

public function direct_create_certificate($tid=""){
	//$items = explode('_', $_REQUEST['item_name']);
	$plan  = $items[0];
	//$tid   = $_REQUEST['item_name'];
	$uid   = $this->session->userdata('logged_in')['id'];

	$certId = $this->session->userdata('current_certificate_id');

    $datas['payment_status']       = 1;
    $datas['payment_status']       = "PRO-".Rand(1000,99999);
    if($_REQUEST['item_name']){
    	$result = $this->user->update('tbl_training_certificate',$datas,'id',$uid);
    }
    //$this->session->unset_userdata('current_certificate_id');
	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Payment has been completed successfully.</div>');
				redirect('provider/generate_certificate/'.$tid.'');

}



	public function cancel_provider_plan(){
		echo '<p>There is some error while making payment. 
		<a href="'.site_url('provider/training_center_list').'">Try again.</a></p>';
	}





 	public function template($idd)
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$traininghasacc = $this->user->get_accredition_detailsOC($idd);
			if(!empty($coursehasacc)):
				$data['has_acc'] = true;
				$data['acc_number'] = $traininghasacc['acc_number'];
			else:
				$data['has_acc'] = false;
				$data['acc_number'] = '0000000000';
			endif;
			echo '<pre>'; print_r($data);die;
			$this->load->frontAdmin('provider/template',$data);
	}	

	public function recipients($idd)
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$this->load->frontAdmin('provider/recipients',$data);
	}

	public function total_bill($idd)
	{		
			
		if($_REQUEST['checked']){

			$data1['user_id']      = $this->session->userdata('logged_in')['id'];
			$data1['customer_id']  = serialize($_REQUEST['checked']);
			$data1['status']       = 1;
			$result = $this->user->save('tbl_training_certificate',$data1);
			$this->session->set_userdata('current_certificate_id', $result);
		  }
		    //echo '<pre>'; print_r($_REQUEST); die;
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$this->load->frontAdmin('provider/total_bill',$data);
	}	

	public function payment($idd)
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$this->load->frontAdmin('provider/payment',$data);
	}	

	public function generate_certificate($idd)
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$this->load->frontAdmin('provider/generate_certificate',$data);
	}









/*   Pro Methods starts from here    */

	

public function training_center_pro()
    {       


    	//$this->checkTraininglogin();
		
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];


        //$this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('select', 'Template', 'trim|required');  

        

        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_center_pro',$data);
            
        }  else { 


        		$_SESSION['templates'] = $this->input->post('select');

	        	$data['templates']       = $this->input->post('select');
				//$result = $this->user->update('tbl_training',$data,'id',$trid);
 
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Template added successfully.</div>');
                redirect('provider/choose_certificate');
       
      


    }
}





public function choose_certificate()
    {       


    	//$this->checkTraininglogin();
		
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];


        //$this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('select', 'Template', 'trim|required');  

        

        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/choose_certificate',$data);
            
        }  else { 


        		$_SESSION['certificate']  = $this->input->post('select');

	        	$data['certificate']       = $this->input->post('select');
				//$result = $this->user->update('tbl_training',$data,'id',$trid);
 
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Template added successfully.</div>');
                redirect('provider/choose_certificate');
       
      


    }
}










	public function upload_information()
	{


		$uid = $this->session->userdata('logged_in')['id'];
		$this->session->unset_userdata('current_training_id');

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		
		$this->form_validation->set_rules('titles', 'Title', 'trim|required'); 
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required'); 
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required'); 
		$this->form_validation->set_rules('start_time', 'Start Time', 'trim|required'); 
		$this->form_validation->set_rules('end_time', 'End Time', 'trim|required');

		//$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
		$this->form_validation->set_rules('speaker', 'Speaker', 'trim|required'); 
		$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
		$this->form_validation->set_rules('location', 'Location', 'trim|required'); 
		$this->form_validation->set_rules('c_person', 'Contact Person', 'trim|required'); 
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_training.email]'); 
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required'); 
		$this->form_validation->set_rules('cp_number', 'CP Number', 'trim|required'); 
		$this->form_validation->set_rules('units', 'Units', 'trim|required'); 
		$this->form_validation->set_rules('category', 'Category', 'trim|required'); 
		$this->form_validation->set_rules('host', 'Host', 'trim|required'); 
		$this->form_validation->set_rules('about_host', 'About Host', 'trim|required'); 
		 

		if($this->form_validation->run() == FALSE)
		{


			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','user_id',$uid);
			$data['cat'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
			$data['purchase_plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription','user_id',$uid);

			$data['plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','status',1);
			$this->load->frontAdmin('provider/upload_information',$data);
		
		}  else {



		 if(isset($_FILES["attach_logo"]) && !empty($_FILES["attach_logo"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["attach_logo"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('attach_logo'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['attach_logo'] = $imageName;
			}


		if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
			$config1['upload_path'] = './assets/images/uploads/';
			$config1['allowed_types'] = 'gif|jpg|png|jpeg';
			$config1['max_size'] = '200000';
			$config1['max_width']  = '1500';
			$config1['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName1 = 'IMGS_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName1;
			$this->load->library('upload', $config1);
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('image'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['venue_photo'] = $imageName1;
			}	


			$data['user_id'] 	= $uid;
			$data['title'] 	    = $this->input->post('titles'); 
			$data['sub_title'] 	    = $this->input->post('sub_title'); 

			$data['host_name'] 	= $this->input->post('host_name'); 
			$data['about_host'] = $this->input->post('about_host'); 


			$data['speaker'] 	= $this->input->post('speaker'); 
			$data['price'] 		= $this->input->post('price'); 
			$data['location'] 	= $this->input->post('location'); 
			$data['start_date'] = $this->input->post('start_date'); 
			$data['end_date'] 	= $this->input->post('end_date'); 
			$data['start_time'] = $this->input->post('start_time'); 
			$data['end_time'] 	= $this->input->post('end_time'); 

			$data['contact_person'] 	= $this->input->post('c_person'); 
			$data['email'] 	     = $this->input->post('email'); 
			$data['phone'] 	     = $this->input->post('phone'); 
			$data['cp_number'] 	 = $this->input->post('cp_number'); 
			$data['units']   	 = $this->input->post('units'); 
			$data['category_id'] = $this->input->post('category'); 
			$data['status'] 	 = 0;
			$data['templates'] 	 = $_SESSION['templates'];
			$data['certificate'] = $_SESSION['certificate'];
			$data['country_id']  = $this->session->userdata('logged_in')['country'];
			
		
			//$uid = $this->session->userdata('logged_in')['id'];
			//$userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			

			$uid = $this->session->userdata('logged_in')['id'];
			$userdetails1 = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			$userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$userdetails1[0]['parent_insititution']);



			$data['insititution_id']   = $userdetails[0]['insititution_id'];
			
			
		    $result = $this->user->save('tbl_training',$data); 
			$this->session->set_userdata('current_training_id', $result);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">General Information created successfully.</div>');
				redirect('provider/training_overview');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_overview');
			} 
		}
	}







public function upload_information1()
    {       


    	//$this->checkTraininglogin();
		
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];


        //$this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('select', 'Template', 'trim|required');  

        

        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);


			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','user_id',$uid);
			$data['cat'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
			$data['purchase_plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription','user_id',$uid);

			$data['plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','status',1);

			
            $this->load->frontAdmin('provider/upload_information',$data);
            
        }  else { 


        		$_SESSION['certificate']  = $this->input->post('select');

	        	$data['certificate']       = $this->input->post('select');
				//$result = $this->user->update('tbl_training',$data,'id',$trid);
 
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Template added successfully.</div>');
                redirect('provider/upload_information');
       
      


    }
}




public function training_exam()
    {       


    	$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];


        $this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('description', 'Description', 'trim|required');  

        if (empty($_FILES['speaker_image']['name']))
        {
        $this->form_validation->set_rules('speaker_image', 'Speaker Image', 'required');
        } 

        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_exam',$data);
            
        }   
}





public function training_exam_save()
    {       

    	$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];



        	$ldata = $this->input->post('question_title');
			$tot = count($ldata); 


			for ($i=0; $i < $tot; $i++) { 
			
				$data['question_title'] = $this->input->post('question_title')[$i];
				$data['answere1'] = $this->input->post('answere1')[$i];
				$data['answere2'] = $this->input->post('answere2')[$i];
				$data['answere3'] = $this->input->post('answere3')[$i];
				$data['answere4'] = $this->input->post('answere4')[$i];
				$data['correct_answere'] = $this->input->post('correct_answere')[$i];
				$data['status'] = 1;
				$data['training_id']   = $trid;

				//echo '<pre>'; print_r($data); die;
				$result = $this->user->save('tbl_training_quiz_question',$data);
			
			}



            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Question added successfully.</div>');
                redirect('provider/training_sponsors');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_exam');
            } 



}




public function training_sponsors()
    {       
    	$this->checkTraininglogin();
		  $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_sponsors',$data);
}




/*
public function products()
{       
    $this->load->library('upload');
    $dataInfo = array();
    $files = $_FILES;
    $cpt = count($_FILES['userfile']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataInfo[] = $this->upload->data();
    }

    $data = array(
        'name' => $this->input->post('pd_name'),
        'prod_image' => $dataInfo[0]['file_name'],
        'prod_image1' => $dataInfo[1]['file_name'],
        'prod_image2' => $dataInfo[2]['file_name'],
        'created_time' => date('Y-m-d H:i:s')
     );
     $result_set = $this->tbl_products_model->insertUser($data);
}*/



private function set_upload_options()
{   
    //upload an image options
    $config = array();
   	$config['upload_path'] = './assets/images/uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    return $config;
}




   function training_sponsors_save() {
    
	$trid = $this->session->userdata('current_training_id');
	$uid = $this->session->userdata('logged_in')['id'];

    $this->load->library('upload');
    $dataInfo = array();
    $files = $_FILES;
    $cpt = count($_FILES['userfile']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataInfo = $this->upload->data();

        //echo '<pre>';print_r($dataInfo); die;

		$data['sponsors_name'] = $this->input->post('sponsor_name')[$i];
		$data['urls'] = $this->input->post('sponsor_url')[$i];
		
		$data['sponsors_image']      = $dataInfo['file_name']; 

		$data['status'] = 1;
		$data['training_id']   = $trid;
		$data['added_on'] = date('Y-m-d');

		//echo '<pre>'; print_r($data); die;
		$result = $this->user->save('tbl_training_sponsors',$data);

    }

    	if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Sponsor added successfully.</div>');
                redirect('provider/training_committee');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_sponsors');
            } 

 
    }



 



public function training_committee()
    {       


        $this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];


        $this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('description', 'Description', 'trim|required');  

        if (empty($_FILES['speaker_image']['name']))
        {
        $this->form_validation->set_rules('speaker_image', 'Speaker Image', 'required');
        } 

        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_committee',$data);
            
        }  else { 



            if(isset($_FILES["speaker_image"]["name"]))  
           {  

               	$config['upload_path'] = './assets/images/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';    


                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload('speaker_image'))  
                {  
                     echo $this->upload->display_errors();   die;
                }  
                else  
                {  
                     $data1 = $this->upload->data();
                     $data['speaker_image']  =  $data1["file_name"];   
                } 


                $data['training_id']         =  $trid;  
                $data['speaker_name']        =  $this->input->post('speaker_name');  
                $data['speaker_description'] =  $this->input->post('description');   
               // $data['speaker_image']       =  $this->input->post('description');   
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d');  

                $result = $this->user->save('tbl_training_speaker',$data);

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker added successfully.</div>');
                redirect('provider/training_speaker');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_speaker');
            } 

        }       
    }
}
	



	function training_committee_save() {

	$trid = $this->session->userdata('current_training_id');
	$uid = $this->session->userdata('logged_in')['id'];


    $this->load->library('upload');

    $dataInfo = array();
    $files = $_FILES;
    $cpt = count($_FILES['userfile']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataInfo = $this->upload->data();

        //echo '<pre>';print_r($dataInfo); die;

		$data['committee_name'] = $this->input->post('committee_name')[$i];
		
		$data['degination'] 	= $this->input->post('degination')[$i];

		$data['committee_image']      = $dataInfo['file_name']; 

		$data['status'] = 1;
		$data['training_id']   = $trid;
		$data['added_on'] = date('Y-m-d');

		//echo '<pre>'; print_r($data); die;
		$result = $this->user->save('tbl_training_committee',$data);

    }

    	if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Committee added successfully.</div>');
                redirect('provider/training_publish');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_committee');
            } 

 
    }






	function training_committee_edit_save() {

	$trid = $this->input->post('tidd');
	$uid = $this->session->userdata('logged_in')['id'];


    $this->load->library('upload');

    $dataInfo = array();
    $files = $_FILES;
    $cpt = count($_FILES['userfile']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataInfo = $this->upload->data();

        //echo '<pre>';print_r($dataInfo); die;

		$data['committee_name'] = $this->input->post('committee_name')[$i];
		
		$data['degination'] 	= $this->input->post('degination')[$i];

		$data['committee_image']      = $dataInfo['file_name']; 

		$data['status'] = 1;
		$data['training_id']   = $trid;
		$data['added_on'] = date('Y-m-d');

		//echo '<pre>'; print_r($data); die;
		$result = $this->user->save('tbl_training_committee',$data);

    }

    	if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Committee added successfully.</div>');
                redirect('provider/training_committee_edit/'.$trid);
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_committee_edit/'.$trid);
            } 

 
    }


/*   Pro Methods ends from here    */










public function training_propackage_edit()
    {       


    	//$this->checkTraininglogin();
		
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];

 
        //$this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('select', 'Template', 'trim|required');  

        

        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_propackage_edit',$data);
            
        }  else { 


        		$_SESSION['templates'] = $this->input->post('select');

	        	$data['templates']       = $this->input->post('select');

				$result = $this->user->update('tbl_training',$data,'id',$trid);

        

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Template updated successfully.</div>');
                redirect('provider/training_propackage_edit/'.$trid);
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_propackage_edit/'.$trid);
            } 
      


    }
}




 


public function training_exam_edit_save()
    {       

 
		$trid = $this->input->post('tidd');
		$uid = $this->session->userdata('logged_in')['id'];



        	$ldata = $this->input->post('question_title');
			$tot = count($ldata); 


			$this->user->delete('tbl_training_quiz_question','training_id',$trid); 


			for ($i=0; $i < $tot; $i++) { 
			
				$data['question_title'] = $this->input->post('question_title')[$i];
				$data['answere1'] = $this->input->post('answere1')[$i];
				$data['answere2'] = $this->input->post('answere2')[$i];
				$data['answere3'] = $this->input->post('answere3')[$i];
				$data['answere4'] = $this->input->post('answere4')[$i];
				$data['correct_answere'] = $this->input->post('correct_answere')[$i];
				$data['status'] = 1;
				$data['training_id']   = $trid;

				//echo '<pre>'; print_r($data); die;
				$result = $this->user->save('tbl_training_quiz_question',$data);
			
			}



            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Question added successfully.</div>');
                redirect('provider/training_exam_edit/'.$tid);
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_exam_edit/'.$tid);
            } 



}


public function training_exam_edit()
    {       


    	//$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');
		$uid = $this->session->userdata('logged_in')['id'];

 			$data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_exam_edit',$data); 
}


 


 
public function training_sponsors_edit()
    {       
    	//$this->checkTraininglogin();
		  $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_sponsors_edit',$data);
} 



public function training_committee_edit()
    {       
    	//$this->checkTraininglogin();
		  $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $this->load->frontAdmin('provider/training_committee_edit',$data);
}


public function updatespeaker()
    {       
    	//$this->checkTraininglogin();
    	$idd = $this->input->post('idd');
    	$tid = $this->input->post('tid');

    	 $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$tid);

    	 $data['training_id'] = $tid;

		$data['schedule'] = $this->user->get_record_by_field_name_all_record('tbl_training_schedule','id',$idd);
        $this->load->view('pages/speaker_edit',$data);
}





   function training_sponsors_edit_save() {
    
	$trid = $this->input->post('tidd');
	$uid = $this->session->userdata('logged_in')['id'];

    $this->load->library('upload');
    $dataInfo = array();
    $files = $_FILES;
    $cpt = count($_FILES['userfile']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataInfo = $this->upload->data();

        //echo '<pre>';print_r($dataInfo); die;

		$data['sponsors_name'] = $this->input->post('sponsor_name')[$i];
		$data['urls'] = $this->input->post('sponsor_url')[$i];
		
		$data['sponsors_image']      = $dataInfo['file_name']; 

		$data['status'] = 1;
		$data['training_id']   = $trid;
		$data['added_on'] = date('Y-m-d');

		//echo '<pre>'; print_r($data); die;
		$result = $this->user->save('tbl_training_sponsors',$data);

    }

    	if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Sponsor added successfully.</div>');
                redirect('provider/training_sponsors_edit/'.$trid);
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_sponsors_edit/'.$trid);
            } 

 
    }




   public function sequence() {
    
    
	$position = $this->input->post('position');

	 

	$i=1;
	foreach($position as $k=>$v){

	$data['position_order']  = $i;
	$result = $this->user->update('tbl_training_speaker',$data,'id',$v);
	
	//$sql = "Update sorting_items SET position_order=".$i." WHERE id=".$v;
	//$mysqli->query($sql);

	$i++;
	}


   }


   

  public function paynow()
	{
		$post=$this->input->post();
		$data['user_id']       =  $this->session->userdata('logged_in')['id'];
 		$data['package_id']  =  $post['advertise_id'];		
		$data['no_of_view']    =  $post['no_of_view'];
		$data['purchased_on']  =  date('y-m-d');
		$data['amount']  =  $post['total_amount'];
		$data['payment_status'] 	 =  0;
		$data['status']         =  1;

		 if(isset($_FILES["banner_image"]) && !empty($_FILES["banner_image"]['name'])){
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["banner_image"]["name"]);        
            $imageName = 'ADD_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('banner_image'))
            {
             $error = array('error' => $this->upload->display_errors());       
              die(  $error);          
            }  
             $data['banner_image'] = $imageName;
            }

		$result = $this->advertiseads->save('tbl_adv_package_purchased',$data);	
		?>
			<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
				<input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="item_name" id="item_name" value="<?php echo $result;?>">
				<input type="hidden" name="item_number" value="1">
				<input type="hidden" name="credits" value="510">
				<input type="hidden" name="userid" value="1">
				<input type="hidden" name="amount" id="amount" value="<?php echo $data['amount']; ?>">
				<input type='hidden' name='rm' value='2'>
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="handling" value="0">
				<input type="hidden" name="cancel_return" value="<?php echo site_url()?>/provider/advertisement">
				<input type="hidden" name="return" value="<?php echo site_url()?>/provider/success_add_advertise">
			</form>

				<script type="text/javascript">
					document.getElementById("frmPayPal1").submit();
				</script>

		<?php 
		 
		
	}
	
	
	function success_add_advertise()
	{	
			if(!empty($_REQUEST)){
			
			$item_id = $_REQUEST['item_name'];
			 
			$data['payment_status']=1;
			$result = $this->advertiseads->update('tbl_adv_package_purchased',$data,'id',$item_id);

			$this->load->frontAdmin('provider/thanku',$data); 
			
		} else {
			echo "There is some error. Please try again.";
		}

		
	}
	
	function updateimage()
	{
		if(isset($_FILES["banner_image"]) && !empty($_FILES["banner_image"]['name'])){
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["banner_image"]["name"]);        
            $imageName = 'ADD_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('banner_image'))
            {
             $error = array('error' => $this->upload->display_errors()); 
			      
            }  
             $data['banner_image'] = $imageName;
			 
			 $advertise_id=$this->input->post('advertise_id');
			 $result = $this->advertiseads->update('tbl_adv_package_purchased',$data,'id',$advertise_id);
               
			   $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Successfully updated.</div>');
               redirect('provider/purchase_list');
            }
		
	}
	
	
	 public function renew($id)
	{
		
		  $advertise = $this->user->get_record_by_field_name_all_record('tbl_adv_package_purchased','id',$id);
		 
		  if(count($advertise ))
		  {
		     $amount=$advertise[0]['amount'];
		 
		?>
			<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
				<input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="item_name" id="item_name" value="<?php echo $id;?>">
				<input type="hidden" name="item_number" value="1">
				<input type="hidden" name="credits" value="510">
				<input type="hidden" name="userid" value="1">
				<input type="hidden" name="amount" id="amount" value="<?php echo $amount; ?>">
				<input type='hidden' name='rm' value='2'>
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="handling" value="0">
				<input type="hidden" name="cancel_return" value="<?php echo site_url()?>/provider/purchase_list">
				<input type="hidden" name="return" value="<?php echo site_url()?>/provider/success_renew">
			</form>

				<script type="text/javascript">
					document.getElementById("frmPayPal1").submit();
				</script>           
		<?php 
		  }else
		  {
			  redirect('provider/purchase_list');
		  }
		 
		
	}
	
	
	function success_renew()
	{
		if(!empty($_REQUEST)){
			
			$item_id = $_REQUEST['item_name'];			 
			$data['total_view']=0;
			$result = $this->advertiseads->update('tbl_adv_package_purchased',$data,'id',$item_id);
			$this->load->frontAdmin('provider/thanku',$data); 
			
		} else {
			echo "There is some error. Please try again.";
		}
	}






	public function staffcerecords()
	{
		$this->load->frontAdmin('provider/staffcerecords'); 
	}



	public function set_target()
	{
		$this->load->frontAdmin('provider/set_target'); 
	}

	public function performance_report()
	{
		$this->load->frontAdmin('provider/performance_report'); 
	}




	public function settarget()
	{ 


			$uid = $this->session->userdata('logged_in')['id']; 
			$profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			 
	 
			$data['cource_name']          = $this->input->post('cource_name'); 
			$data['user_id']              = $uid; 
			$data['category']             = $this->input->post('category_name'); 
			$data['total_staff']          = $this->input->post('total_staff');
			$data['target_number']        = $this->input->post('target_number');
			$data['status']       = 1;
			$data['added_on']     = date('Y-m-d h:i:s'); 


			$result = $this->user->save('tbl_provider_set_target',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Set Target created successfully.</div>');
				redirect('provider/set_target');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/set_target');
			}
}





public function settargetdate()
	{ 


			$uid = $this->session->userdata('logged_in')['id']; 
	 
			$data['user_id']      = $uid; 
			$data['start_date']   = $this->input->post('start_date'); 
			$data['end_date']     = $this->input->post('end_date'); 
			$data['status']       = 1;
			$data['added_on']     = date('Y-m-d h:i:s'); 


			$result = $this->user->save('tbl_provider_set_target_date',$data); 



			$data2['status']   = 2;
			$result = $this->user->update('tbl_provider_set_target',$data2,'user_id',$uid);


			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Date has been created successfully.</div>');
				redirect('provider/set_target');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/set_target');
			}
}






	public function registerstaff()
	{ 


			$uid = $this->session->userdata('logged_in')['id']; 
			$profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			 
	 
			$data['staff_name']          = $this->input->post('name'); 
			$data['insititution_id']     = $profile[0]['id'];  
			$data['insititution_code']   = $profile[0]['insititution_id'];  
			$data['status']       = 1;
			$data['added_on']     = date('Y-m-d'); 


			$result = $this->user->save('tbl_institution_staff',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Overview created successfully.</div>');
				redirect('provider/staffcerecords');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/staffcerecords');
			}
}





	public function staff_view($id)
	{		 


	  $sess_id = $id;
	 

	$data['previous_certificate'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$sess_id,'archive'=>0));

	$data['specific'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$sess_id,'category'=>'specific','archive'=>0));

	$data['general'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$sess_id,'category'=>'general','archive'=>0));



	$data['previous_certificate1'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$sess_id,'archive'=>1));

	$data['specific1'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$sess_id,'category'=>'specific','archive'=>1));

	$data['general1'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$sess_id,'category'=>'general','archive'=>1));



			$this->load->frontAdmin('provider/staff_view',$data);
	}






}
