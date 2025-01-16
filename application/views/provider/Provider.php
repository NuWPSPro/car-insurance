<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Provider extends CI_Controller {

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
	
	public function  __construct(){
        parent::__construct();
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){
			redirect('users');
		}
		$this->load->model('Users_model','users_model'); 
		$this->load->model('provider_model');  
		$this->load->model('dashboards_model');
		$this->load->model('advertise_model');
	}

	public function advertisement(){
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
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',1);  
		$data['country'] = $countryllist;
		$this->load->frontAdmin('provider/add_advertise',$data);
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
			$this->load->frontAdmin('provider/advertise_list',$data);
		}
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
		$training_types = $this->session->userdata('training_types');

		if($training_types=="pro"){
			if($trid==""){
			// redirect('provider/upload_information');
			redirect('provider/training_center_pro');
			}
		}else
		{
			if($trid==""){
				redirect('provider/training_center_free');
			}

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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');		 
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
			$data['course_acceditation_number'] = $this->input->post('acceditation_no');
			$data['course_validity']       = $this->input->post('course_validity');
			$data['profession'] 		   = serialize($this->input->post('profession'));
			$data['cpdprovider'] 		   = $this->input->post('cpdprovider');
			$data['prc_acceditation_number'] = $this->input->post('prc_acceditation_no');
			$data['acceditation_validity'] = $this->input->post('acceditation_validity');
			$data['course_description']    = $this->input->post('course_description');
			$data['user_id']               = $this->session->userdata('logged_in')['id'];

			$data['course_category']    = $this->input->post('category');
			$data['price']        		= $this->input->post('price');
			
			$data['objective']    		= $this->input->post('objective');
			$data['status']       		= 1;
			$data['added_on']     		= date('Y-m-d');
			$data['expiry_on']    		= date('Y-m-d', strtotime("+30 days"));


			

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
		$uid = $this->session->userdata('logged_in')['id'];
		$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$parentdetails = $this->db->get_where('tbl_user',array('id'=>$udetails['parent_insititution']))->row_array();

		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('course_title', 'Course Title', 'trim|required');
		$this->form_validation->set_rules('units', 'Units', 'trim|required');
		$this->form_validation->set_rules('acceditation_no', 'Course Accreditation No', 'trim|required');
		$this->form_validation->set_rules('course_validity', 'Course Validity', 'trim|required');
		// $this->form_validation->set_rules('cpdprovider', 'CPD Provider', 'trim|required'); //type hidden in form
		// $this->form_validation->set_rules('course_description', 'Course Description', 'trim|required');
		if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ 
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
		}
		if (empty($_FILES['image']['name'])){
		 $this->form_validation->set_rules('image', 'Course Photo', 'trim|required');
		}
		if (empty($this->input->post('profession'))){
		 $this->form_validation->set_rules('profession', 'Profession', 'trim|required');
		}

		if($this->form_validation->run() == FALSE)
		{
		    $data['profession'] = $this->db->order_by('cat_name','ASC')->get_where('tbl_category',array('status'=>1))->result_array();
		    $data['userdetails'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			$this->load->frontAdmin('provider/overview',$data);
		
		}  else {

			if(isset($_FILES["video"]) && !empty($_FILES["video"]['name'])){
			$config1['upload_path'] = './assets/images/uploads/';
			$config1['allowed_types'] = 'mp4';
			$config1['max_size'] = '90000000000000';
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
			$data1['course_video'] = $imageName;
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
			$data1['course_photo'] = $imageName;
			}

			if($parentdetails['insititution_id']==''){
				$ins_id_for_course = 0;
			}else{
				$ins_id_for_course = $parentdetails['insititution_id'];
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
		
			$data1['course_title']          	= ucwords($this->input->post('course_title'));
			$data1['units']                 	= $this->input->post('units');
			$data1['course_acceditation_number'] = $this->input->post('acceditation_no');
			$data1['course_validity']       	= $this->input->post('course_validity');
			$data1['profession'] 		   		= implode(', ',(array)$this->input->post('profession'));
			$data1['cpdprovider'] 		   		= $this->input->post('cpdprovider');
			$data1['prc_acceditation_number']   = $this->input->post('prc_acceditation_no');
			$data1['acceditation_validity'] 	= $this->input->post('acceditation_validity');
			$data1['course_description']    	= $this->input->post('course_description');
			$data1['user_id']               	= $this->session->userdata('logged_in')['id'];

			$data1['course_category']    		= $category[0]['id'];
			$data1['price']        				= $price;
			
			$data1['objective']    				= $this->input->post('objective');
			$data1['status']       				= '3';
			$data1['course_for']       			= 'p'; //course for provider
			$data1['added_on']    				= date('Y-m-d');
			// $data['expiry_on']    			= date('Y-m-d', strtotime("+1825 days"));
			$data1['country_id']      			= $this->session->userdata('logged_in')['country'];
			$data1['insititution_id']   		= $ins_id_for_course;
			// echo'<pre>';print_r($data1);die;
			$result = $this->user->save('tbl_course',$data1);
			// echo'<pre>';print_r($this->db->last_query());die;
			// echo $result; die;			
			if($result){
				$this->session->set_userdata('current_course_id', $result);	
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
	 	$uid = $this->session->userdata('logged_in')['id'];
		$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$parentdetails = $this->db->get_where('tbl_user',array('id'=>$udetails['parent_insititution']))->row_array();

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('course_title', 'Course Title', 'trim|required');
		$this->form_validation->set_rules('units', 'Units', 'trim|required');
		$this->form_validation->set_rules('acceditation_no', 'Course Accreditation No', 'trim|required');
		$this->form_validation->set_rules('course_validity', 'Course Validity', 'trim|required');
		// $this->form_validation->set_rules('profession', 'Profession', 'trim|required');
		// $this->form_validation->set_rules('cpdprovider', 'CPD Provider', 'trim|required');
		
		/*if (empty($_FILES['image']['name'])){
		 $this->form_validation->set_rules('image', 'Course Photo', 'trim|required');
		}*/
		if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ 
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
		}
		if (empty($this->input->post('profession'))){
		 $this->form_validation->set_rules('profession', 'Profession', 'trim|required');
		}

		$this->form_validation->set_rules('course_description', 'Course Description', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
		    $data['profession'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
		    $data['userdetails'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		    $data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/edit_overview',$data);
		
		}  else {

			$this->load->library('upload');
			if($parentdetails['insititution_id']==''){
				$ins_id_for_course = 0;
			}else{
				$ins_id_for_course = $parentdetails['insititution_id'];
			}
			if(empty($this->input->post('price'))){
				$price = 0;
			}else{
				$price 			= $this->input->post('price');
				$data['tax'] 	= $this->input->post('tax');
				$data['total']  = $this->input->post('total');
			}
	      if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			// $config['max_width']  = '1500';
			// $config['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('image'))
			{  
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
				redirect('provider/course_edit/'.$cid.'');                     
			}  
			$data['course_photo'] = $imageName;
			}

            if(isset($_FILES["video"]) && !empty($_FILES["video"]['name'])){
				$config1['upload_path'] 	= './assets/images/uploads/';
				$config1['allowed_types'] 	= 'mp4';
				$config1['max_size'] 		= '90000000000';
			  
				$ext = explode('.',$_FILES["video"]["name"]);        
				$imageName = 'VID_'.time().'.'.end($ext);
				$config1['file_name'] = $imageName;
				$this->upload->initialize($config1);
				if ( ! $this->upload->do_upload('video'))
				{
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
					redirect('provider/course_edit/'.$cid.'');                    
				}  
				$data['course_video'] = $imageName;
				
			}

		    $course = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();
			// print_r(implode(', ',$this->input->post('profession')));die;
			$data['course_title']          		= ucwords($this->input->post('course_title'));
			$data['units']                 		= $this->input->post('units');
			
			$data['course_acceditation_number'] = $this->input->post('acceditation_no');
			$data['course_validity']       		= $this->input->post('course_validity');
			$data['profession'] 		   		= implode(', ',(array)$this->input->post('profession'));
			$data['cpdprovider'] 		  		= $this->input->post('cpdprovider');
			$data['prc_acceditation_number']   	= $this->input->post('prc_acceditation_no');
			$data['acceditation_validity'] 		= $this->input->post('acceditation_validity');
			$data['course_description']    		= $this->input->post('course_description');
			// $data['user_id']               	= $this->session->userdata('logged_in')['id'];

			$data['course_category']    		= $this->input->post('category');
			$data['price']    					= $price;
			
			$data['objective']    				= $this->input->post('objective');
			$data['insititution_id']   			= $ins_id_for_course;

			if($course['status'] != 1){
			$data['status']       				= 3; //save only
			}
		// echo'<pre>'; print_r($data);
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
			$this->load->frontAdmin('provider/lesson_edit',$data); 		
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
				redirect('provider/lesson_edit/'.$cid);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/lesson_edit/'.$cid.'/'.$lid.'');
			}
	    }
	}


	
   	public function course_listing()
	{
			$uid 			= $this->session->userdata('logged_in')['id'];
			$filter 		= $this->uri->segment(3);

			$data['course'] = $this->provider_model->courseListing($uid,$filter); 
			$this->db->where(array('c.course_for'=>'a','c.status'=>'3'));
			$data['coursewithsaveonly'] = $this->provider_model->courseListing($uid,$filter); 
			// echo $this->db->last_query();
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/course_listing',$data);
	}



	public function authors()
	{
		    $uid 			= $this->session->userdata('logged_in')['id'];
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$currentUser    = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		 	$this->db->where('role',6);
			$data['authors'] = $this->user->get_record_by_field_name_all_record('tbl_user','under_provider',$currentUser[0]['insititution_id']);
			$this->load->frontAdmin('provider/authors',$data);
	}




	public function course_view($id)
	{		
			$uid 			= $this->session->userdata('logged_in')['id'];
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
			// print_r($data['course'][0]['user_id']);
			$data['lesson'] = $this->user->get_record_by_field_name_all_record('tbl_lesson','course_id',$id);
			$data['quiz'] 	= $this->user->get_record_by_field_name_all_record('tbl_quiz_question','course_id',$id);
			$data['report'] 	= $this->user->get_record_by_field_name_all_record('tbl_abuse_report','course_id',$id);
			$this->db->where('tbl_exam.certificate_id !=',"");
			$data['exam'] 	= $this->user->get_record_by_field_name_all_record('tbl_exam','course_id',$id);
			
			$cid=$id;
			
			$fivestar = $this->db->query('SELECT AVG(star_mark)as star_mark  FROM tbl_course_review WHERE course_id = '.$cid.'');
			$data['star'] = $fivestar->result_array();
			// print_r($data['star']);
			// $data['star'] = $this->db->get_where('tbl_course_review',array('course_id'=>$cid))->result_array();
			// echo $this->db->last_query();die;

			$this->db->order_by('id', 'DESC');
			$this->db->from('tbl_course_review');
			$this->db->where('course_id',$cid);
			$this->db->limit(5);
			$data['evaluation'] = $this->db->get()->result_array();
			// echo $this->db->last_query().'<br>';
			// echo '<pre>';	print_r($data['evaluation']);die;
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/course_view',$data);
	}

	



	public function lesson()
	{

		$this->checkcourselogin(); 
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">','</p>');
		$this->form_validation->set_rules('summary', 'Summary', 'trim|required');  
		// $this->form_validation->set_rules('references', 'References', 'trim|required');  

		if($this->form_validation->run() == FALSE)
		{
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
			$data['lesson'] = $this->user->get_lesson($uid);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
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
				//$data['lesson_video'] 	= $this->input->post('lesson_video')[$i]; 
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
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
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
			// echo'<pre>'; print_r($data['quiz']);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/edit_quiz',$data);
		}  else {
			// echo '<pre>'; print_r($this->input->post('rational'));die;	
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
				redirect('provider/edit_quiz/'.$cid);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_quiz/'.$cid.'/'.$qid.'');
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
		$uid = $this->session->userdata('logged_in')['id'];
		$cid1 = $this->input->post('course_idd');
		if(!empty($cid1)){ $cid = $cid1; }
		//$this->checkcourselogin();

		// echo'<pre>';print_r($this->input->post());die;
		$this->form_validation->set_rules('rating', 'Rating', 'trim');  
		// $this->form_validation->set_rules('question','Question','required'); 

		if ($this->form_validation->run() == FALSE) 
		{
			$cid1 = $this->uri->segment(3);  
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid1);
			$data['evaluation'] = $this->user->get_record_by_field_name_all_record('tbl_evaluation','course_id',$cid1);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/edit_evaluation',$data);
		}else{

		// $result = $this->user->delete('tbl_evaluation','course_id',$cid); 
		// echo'<pre>';print_r($this->input->post());die;
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
		// echo $this->db->last_query();die;
			}
		} 
		} 

		$data1['rating'] =  $this->input->post('rating'); 
		$data1['course_evaluation_note'] =  $this->input->post('evaluation_description');
		$result1 = $this->user->update('tbl_course',$data1,'id',$cid); 
		//$data['prof_name'] 		= $this->input->post('prof_name');
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
		if($this->input->post('promote')=='0_1'){	
		$data2['paid_status'] 	= '1'; //regular promotion free
		$result = $this->user->update('tbl_course',$data2,'id',$cid);
		}

		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_rules('prof_name', 'Prof Name', 'trim|required');  
		if($this->form_validation->run() == FALSE)
		{
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course',array('id'=>$cid),'');
			// echo $this->db->last_query();
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/edit_promotion',$data);
		} else{ 
			$data['prof_name'] 		= $this->input->post('prof_name'); 
			$result = $this->user->update('tbl_course',$data,'id',$cid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('provider/edit_promotion/'.$cid.'');
			}else{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_promotion/'.$cid.'');
			} 

		}		
	}

public function cancel_promotion($cid=false)
	{		
		//$this->checkcourselogin();
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_rules('prof_name', 'Prof Name', 'trim|required'); 
		$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Payment has been cancel. Please try Again!</div>');

		if(!empty($cid)){
			$this->load->frontAdmin('provider/promotion',$data);
		}else{
			$this->load->frontAdmin('provider/edit_promotion',$data);
		}
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
			
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/certificate',$data);
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
				redirect('provider/evaluation');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/certificate');
			} 
		}	
			
	
	}

	public function edit_certificate($cid)
	{		
				
		$this->checkcourselogin();

		$this->load->library('upload'); 
		$uid = $this->session->userdata('logged_in')['id'];
		$author = $this->db->select('id')->get_where('tbl_user',array('parent_insititution'=>$uid))->row_array();
			
		// $this->form_validation->set_rules('prof_name', 'Prof Name', 'trim|required');   

		if($this->form_validation->run() == FALSE)
		{
			 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
			//$data['templete'] = $this->user->get_templete_all_record('tbl_certificate_template','status','1');
			$data['profile'] = $this->db->get_where('tbl_user',array('id'=>$uid))->result_array();

			$this->db->where(array('user_id'=>$uid,'course_id'=>$cid));
			$this->db->or_where(array('user_id'=>$author['id'],'course_id'=>$cid));
			$query = $this->db->get('tbl_user_certificate');
			$data['certificate'] = $query->result_array();

			if(!empty($data['certificate']) && !empty($data['certificate'][0]['category'])){
				$this->db->where('category',$data['certificate'][0]['category']); 
				$this->db->where('numberofsignature',$data['certificate'][0]['num_signature']); 
			}
			$query = $this->db->where('status','1')->get('tbl_certificate_template');
			$data['templete'] = $query->result();

			// print_r($this->db->last_query());die;
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/edit_certificate',$data);
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
				}
				
			}
			
			$update['signature'] = implode('##',(array)$updatess);

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
			// print_r($this->input->post('templete_id'));die;
			if($id == ''){
				$certificate = $this->user->save('tbl_user_certificate',$update); 
			}else{
				$certificate = $this->user->update('tbl_user_certificate',$update,'id',$id); 
			}


			// echo $this->db->last_query();die;
			// print_r($update['signature']);die;
			if($certificate){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate successfully updated.</div>');
				redirect('provider/edit_certificate/'.$cid);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again nutan.</div>');
				redirect('provider/edit_certificate/'.$cid);
			}  
		}		
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
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course',array('id'=>$cid),'');
			$data['lesson'] = $this->user->get_lesson($uid);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/promotion',$data);

		}  else { 

			$stts1 	= $this->input->post('promote'); 
			$stts   = explode('_', $stts1);
			$data['paid_status'] 	= $stts[1];
			$course_id          = $this->session->userdata('current_course_id');
			
			$result = $this->user->update('tbl_course',$data,'id',$course_id); 
			if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promotion updated successfully.</div>');
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
		$cid = $this->session->userdata('current_course_id');
		if($this->input->post())
		{
			$data['status'] 	= 1;
			$data['added_on']   = date('Y-m-d');
			// $data['expiry_on']   = date('Y-m-d', strtotime("+1825 days"));
			$result = $this->user->update('tbl_course',$data,'id',$cid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('provider/success/'.$cid.'');
			}else{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/publish');
			} 
		}else{ 
				$data['course'] = $this->user
						->get_record_by_field_name_all_record('tbl_course',array('id'=>$cid,'user_id'=>$uid),'');
				$data['totalIncomeProvider'] = $this->provider_model
						->total_income($uid,'month');
		$this->load->frontAdmin('provider/publish',$data);
		}
	}	
	public function edit_publish($cid)
	{		
		//$this->checkcourselogin();
		$uid = $this->session->userdata('logged_in')['id'];
		
		if($this->input->post())
		{
			$update = array(
				'status'  	  => 1, //1 means Published
				'added_on'   => date('Y-m-d')
				// 'expiry_on'   => date('Y-m-d', strtotime("+1825 days"))
			);
			$result = $this->user->update('tbl_course',$update,'id',$cid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('provider/success/'.$cid.'');
			}else{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_publish/'.$cid.'');
			} 
		}else{ 
			$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course',array('id'=>$cid,'user_id'=>$uid),'');
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/edit_publish',$data);
			
		}		
	}


	public function onclickpublish($cid){
		$update = array('status'=> 1,'added_on'   => date('Y-m-d'));
		$result = $this->user->update('tbl_course',$update,'id',$cid); 
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Course Published successfully.</div>');
			redirect('provider/course_listing');
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('provider/course_listing');
		} 

	}

	public function success($cid)
	{	
		$uid = $this->session->userdata('logged_in')['id'];
		
		if(!empty($this->session->userdata('current_course_id'))){
			$course_id = $this->session->userdata('current_course_id');
		}else{
			$course_id = $cid;
		}
		$datas['cid'] = $cid;
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$this->load->frontAdmin('provider/success',$datas);
	}

	public function save($cid)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		// $data['cid'] = $cid;
		// $cid = $this->session->userdata('current_course_id');
		$data['status'] = '3';
		$result1 = $this->user->update('tbl_course',$data,'id',$cid);
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid ,'total');
		$this->load->frontAdmin('provider/save',$cid);
	}



	public function save_submit()
	{
		//$cid = $this->uri->segment(3);
		$cid = $this->session->userdata('current_course_id');
		$data['status'] = 0;
		$result1 = $this->user->update('tbl_course',$data,'id',$cid);
		$encrypted_course_id = base64_encode($cid);
		redirect(GOVT_URL.'course/profile/'.$encrypted_course_id);
		///$this->load->frontAdmin('provider/save',$cid);
	}

	public function training_save_submit() {
		$trid    = $this->session->userdata('current_training_id');
		$data1['status'] = 2;
		$data1['training_type'] = 1;
		$data1['paid_status'] = 2;
		$datas['trid'] = $trid;
		$result  = $this->user->update('tbl_training',$data1,'id',$trid); 
		$encrypted_course_id = base64_encode($trid);
		redirect(GOVT_URL.'training/profile/'.$encrypted_course_id);
    }



	public function evaluation()
	{
		$this->checkcourselogin();
		$uid = $this->session->userdata('logged_in')['id'];
		$is_uins = $this->session->userdata('logged_in')['under_insititution'];
		$this->form_validation->set_rules('rating', 'Rating', 'trim');   
		if($this->form_validation->run() == FALSE)
		{
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		    $this->load->frontAdmin('provider/evaluation',$data);
		}else{

		$question = $this->input->post('question');
		foreach ($question as $key => $value){
		 	$data['course_id']           = $this->session->userdata('current_course_id');
			$data['evaluation_question'] = $value;
			$data['evaluation_type'] 	 = $this->input->post('evaluation_type')[$key];
			$data['status']              = 1;
			$result = $this->user->save('tbl_evaluation',$data); 
		 } 
	 	    $data1['rating'] =  $this->input->post('rating'); 
	 	    $data1['course_evaluation_note'] =  $this->input->post('evaluation_description'); 
	 		$result1 = $this->user->update('tbl_course',$data1,'id',$this->session->userdata('current_course_id')); 
	 		
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Evaluation created successfully.</div>');
				if($is_uins==1){
					redirect('provider/publish');
				}else{
					redirect('provider/promotion');
				}


			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/evaluation');
			}


		}
	}


	public function users()
	{ 
		$data['users'] = $this->user->get_users_by_role('1');
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		$this->load->frontAdmin('provider/users',$data); 
	}



	public function training_center_plan()
	{
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		$this->load->frontAdmin('provider/training_center_plan',$data); 
	}
 		




	public function training_center_free_old()
	{

		$uid = $this->session->userdata('logged_in')['id'];
		$this->session->unset_userdata('current_training_id');

		$this->session->set_userdata('training_types', 'free');

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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
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
			$data['registration_limit'] = $this->input->post('registration_limit'); 
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
		$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$this->session->unset_userdata('current_training_id');

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required'); 
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required'); 
		$this->form_validation->set_rules('start_time', 'Start Time', 'trim|required'); 
		$this->form_validation->set_rules('end_time', 'End Time', 'trim|required');

		//$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
		// $this->form_validation->set_rules('speaker', 'Speaker', 'trim|required'); 

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
			$data['training'] = $this->user
							->get_record_by_field_name_all_record('tbl_training','user_id',$uid);
			$data['cat'] = $this->user
							->get_record_by_field_name_all_record('tbl_category','status',1);
			$data['purchase_plan'] = $this->user
							->get_record_by_field_name_all_record('tbl_provider_subscription','user_id',$uid);
			$data['plan'] = $this->user
							->get_record_by_field_name_all_record('tbl_provider_subscription_plan','status',1);
			$data['trainig_data'] = $this->user
							->get_record_by_field_name_all_record('tbl_training','id',$id);
			$data['totalIncomeProvider'] = $this->provider_model
							->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/training_center_edit',$data);
		
		}else{

			$this->load->library('upload');
		
			if(isset($_FILES["attach_logo"]) && !empty($_FILES["attach_logo"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			// $config['max_width']  = '1500';
			// $config['max_height']  = '800';        
			$ext = explode('.',$_FILES["attach_logo"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
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
			// $config1['max_width']  = '1500';
			// $config1['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName1 = 'IMGS_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName1;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('image'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['image'] = $imageName1;
			}

		if(isset($_FILES["venue_photo"]) && !empty($_FILES["venue_photo"]['name'])){
			$config1['upload_path'] = './assets/images/uploads/';
			$config1['allowed_types'] = 'gif|jpg|png|jpeg';
			$config1['max_size'] = '200000';
			// $config1['max_width']  = '1500';
			// $config1['max_height']  = '800';        
			$ext = explode('.',$_FILES["venue_photo"]["name"]);        
			$imageName1 = 'VP_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName1;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('venue_photo'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['venue_photo'] = $imageName1;
			}	



			if(isset($_FILES["bannerimage"]) && !empty($_FILES["bannerimage"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			// $config['max_size'] = '200000';
			// $config['max_width']  = '1500';
			// $config['max_height']  = '800';        
			$ext = explode('.',$_FILES["bannerimage"]["name"]);        
			$imageName = 'Ban_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('bannerimage'))
			{
				$error = array('error' => $this->upload->display_errors());                       
			}  
				$data['background_image'] = $imageName;
			}
			if($udetails['under_provider']==''){
				$ins_id_for_training = 0;
			}else{
				$ins_id_for_training = $udetails['under_provider'];
			}
			

			$data['user_id'] 	= $uid;
			$data['title'] 	    = ucwords($this->input->post('titles'));
			$data['sub_title'] 	= $this->input->post('sub_title');
			$data['speaker'] 	= $this->input->post('speaker'); 
			$data['video'] 		= $this->input->post('video'); 
			
			$data['price'] 		= $this->input->post('price'); 
			$data['tax'] 		= $this->input->post('tax'); 
			$data['total'] 		= $this->input->post('total'); 

			$data['location'] 	= $this->input->post('location'); 
			$data['start_date'] = $this->input->post('start_date'); 
			$data['end_date'] 	= $this->input->post('end_date'); 
			$data['start_time'] = $this->input->post('start_time'); 
			$data['end_time'] 	= $this->input->post('end_time'); 
			$data['contact_person'] = $this->input->post('c_person'); 
			$data['email'] 	    = $this->input->post('email'); 
			$data['phone'] 	    = $this->input->post('phone'); 
			$data['cp_number'] 	= $this->input->post('cp_number'); 
			$data['units'] 		= $this->input->post('units'); 
			$data['add_link'] 		= $this->input->post('add_link'); 
			$data['category_id'] = $this->input->post('category'); 
			$data['registration_limit'] = $this->input->post('registration_limit'); 
			// $data['status'] 	= 0;
			$data['host'] 		= $this->input->post('host_name'); 
			$data['about_host'] = $this->input->post('about_host');
			$data['insititution_id']   = $ins_id_for_training;
		    // $result = $this->user->update('tbl_training',$data,); 
		    $result = $this->user->update('tbl_training',$data,'id',$id);
		    echo $this->db->last_query(); 
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
		$this->checkTraininglogin();
		if($this->input->post()){
			$data1['status'] = 2;
			// $data1['paid_status'] = 1;
			$trid = $this->session->userdata('current_training_id');
		$result = $this->user->update('tbl_training',$data1,'id',$trid); 
		redirect('provider/training_success/'.$trid.'');
		}
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		$this->load->frontAdmin('provider/training_publish',$data);
	}	

	public function training_publish_edit($id)
	{
		$data['id'] = $id;
		$tt = $this->session->userdata('training_types');
		if($this->input->post('submit')=='Publish'){
			$data1['status'] = 2;
			if($tt == 1){ $data1['paid_status'] = 2; }
			$data['trid'] = $id;
			$trid = $id;
			$result = $this->user->update('tbl_training',$data1,'id',$trid); 
			$this->load->frontAdmin('provider/training_success',$data); 
		}
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		$this->load->frontAdmin('provider/training_publish_edit',$data);
	}		

	public function training_success($tid=false)
	{	
		// echo'<pre>'; print_r($_REQUEST);die();
		$user_id = $this->session->userdata('logged_in')['id'];	
		$tt = $this->session->userdata('training_types');
		$taxBase = explode('_', $_REQUEST['custom']);
		if($tt=='pro'){ $ttype=1; }else{ $ttype=0; }	
		$added = array(
			'user_id' 		=> $user_id,
			'training_id' 	=> $_REQUEST['item_number'],
			'training_types'=> $ttype, //free or pro 
			'tax'			=> $taxBase[0], 
			'base_price'	=> $taxBase[1], 
			'amount' 		=> $_REQUEST['payment_gross'],
			'txn_id' 		=> $_REQUEST['txn_id'],
			'txn_status' 	=> $_REQUEST['payment_status'],
			'txn_type' 		=> $_REQUEST['txn_type'],
			'status' 		=> 1,
			'added_on' 		=> $_REQUEST['payment_date'],
			'transaction_details' => json_encode($_REQUEST)
			);
		$result = $this->user->save('tbl_training_published',$added); 
		// echo $this->db->last_query();die;
		if($result){
		$trid = $_REQUEST['item_number'];
		$datas['trid'] = $trid;
		$data1['status'] = 2;
		$this->user->update('tbl_training',$data1,'id',$trid);

		$this->session->unset_userdata('current_course_id');
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success">Course Published!</div>');
		$datas['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		$this->load->frontAdmin('provider/training_success',$datas); 

		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			if(empty($tid)){
				redirect('provider/training_publish');
			}else{
				redirect('provider/training_publish_edit/'.$tid);
			}
		}
	}


	public function training_promote_cancel($tid=false)
	{
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		if(empty($tid)){
			redirect('provider/training_publish');
		}else{
			redirect('provider/training_publish_edit/'.$tid);
		}

	}


	public function training_save($tid=false)
	{
		//$this->checkTraininglogin();
		if(empty($tid)){
		$trid    = $this->session->userdata('current_training_id');
		}else{
		$trid    = $tid;
		}


		$data1['status'] = 1;
		// $data1['training_type'] = 1;
		$datas['trid'] = $trid;
		$result  = $this->user->update('tbl_training',$data1,'id',$trid); 
		$this->session->unset_userdata('current_training_id');
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/training_promotion',$data);

		}  else { 
			$stts1 	= $this->input->post('promote'); 	
			$stts   = explode('_', $stts1);
			$data['paid_status'] 	= $stts[1];
			$course_id          = $this->session->userdata('current_training_id');
			$result = $this->user->update('tbl_training',$data,'id',$course_id); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promotion updated successfully.</div>');
				 if($this->session->userdata('training_types')=="pro"){
	            	if($this->input->post('submit')=='Save_next'){ 
	            		$redirect = redirect('provider/training_sponsors'); 
            		}else{ 
            			$redirect = redirect('provider/training_promotion'); 
            		}
                	echo $redirect;
		    	} else {
		    		if($this->input->post('submit')=='Save_next'){ 
            			$redirect = redirect('provider/training_publish'); 
            		}else{ 
            			$redirect = redirect('provider/training_promotion'); 
            		}
                	echo $redirect;
		    	}
			// redirect('provider/training_publish');
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
		$id = $this->uri->segment(3);
		$this->form_validation->set_rules('promote', 'Promote', 'trim|required');  
		if($this->form_validation->run() == FALSE)
		{ 
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
			$this->load->frontAdmin('provider/training_promotion_edit',$data);
		}  else { 
			$stts1 	= $this->input->post('promote'); 
			$stts   = explode('_', $stts1);
			$data['paid_status'] 	= $stts[1];
			$course_id          = $this->session->userdata('current_training_id');
			$result = $this->user->update('tbl_training',$data,'id',$course_id); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
			if($this->session->userdata('training_types')=="pro"){
				if($this->input->post('submit')=='Save_next'){ 
					$redirect = redirect('provider/training_sponsors_edit/'.$id.''); 
				}else{ 
					$redirect = redirect('provider/training_promotion_edit/'.$id.''); 
				}
				echo $redirect;
			} else {
				if($this->input->post('submit')=='Save_next'){ 
					$redirect = redirect('provider/training_publish_edit/'.$id.''); 
				}else{ 
					$redirect = redirect('provider/training_promotion_edit/'.$id.''); 
				}
				echo $redirect;
			}
			} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('provider/training_promotion_edit/'.$id.'');
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
		

		/*if (!empty($_FILES['image']['name'])){
		$this->form_validation->set_rules('image', 'Image', 'trim|required'); 
		}
			if (!empty($_FILES['video']['name'])){
		$this->form_validation->set_rules('video', 'Video', 'trim|required'); 
		}*/
		if($this->form_validation->run() == FALSE)
		{	$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/training_overview',$data);
		}else{
			$this->load->library('upload');

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
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('video'))
				{
				$error = array('error' => $this->upload->display_errors());                       
				}  
				$data['video'] = $imageName;
			}

			if(isset($_FILES["background_image"]) && !empty($_FILES["background_image"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '20000000';
			// $config['max_width']  = '1500';
			// $config['max_height']  = '800';        
			$ext = explode('.',$_FILES["background_image"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
				$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('background_image'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['background_image'] = $imageName;
			}



			//$data['title'] 			= $this->input->post('title'); 
			$data['description'] 		= $this->input->post('description');
			$data['objectives'] 		= $this->input->post('objectives'); 
			$data['methodologies'] 		= $this->input->post('methodologies'); 
			$data['participants'] 		= implode(',', $this->input->post('participants')); 
			$data['item_to_bring'] 		= $this->input->post('item'); 
			// print_r($data);
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
		$userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
		$under_insititution = $userdata['under_insititution']; 

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('evaluation_name', 'Training Evaluation', 'trim|required'); 
 

		if($this->form_validation->run() == FALSE){ 
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/training_evaluation',$data);
		}else{
			if($this->input->post('evaluation_name') !=''){
				$question = $this->input->post('evaluation_name');
				foreach ($question as $key => $value) {
				if($value !=""){
					$data['training_id'] 	     = $trid; 
					$data['evaluation_question'] = $value;
					$data['evaluation_type'] 	 = $this->input->post('evaluation_question_type')[$key];
					$data['question_type'] 		 = $this->input->post('question_type')[$key];
					$data['status']              = 1;
					$result = $this->user->save('tbl_training_evaluation',$data); 
					// echo $this->db->last_query();die;
					}
				} 
			} 
			$data1['evaluation_note'] 		 = $this->input->post('evaluation_note'); 
			$this->user->update('tbl_training',$data1,'id',$trid);  
			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training evaluation added successfully.</div>');
				if($under_insititution == '0'){
	            if($this->session->userdata('training_types')=="pro"){
	            	if($this->input->post('submit')=='Save_next'){ 
            		$redirect = redirect('provider/training_promotion'); 
            		}else{ 
            		$redirect = redirect('provider/training_evaluation'); 
            		}
                	echo $redirect;
		    	} else {
		    		if($this->input->post('submit')=='Save_next'){ 
            		$redirect = redirect('provider/training_promotion'); 
            		}else{ 
            		$redirect = redirect('provider/training_evaluation'); 
            		}
                	echo $redirect;
		    	}
			    }else{
			    	redirect('provider/training_publish'); 	
			    }
		
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		
				redirect('provider/training_evaluation');
		
			} 
		}
	}
	
	public function training_certificate()
	{
		// $this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');

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
			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_training_certificate_lists','id',$idd);

			$data['training_types'] = $this->session->userdata('training_types');
			$data['templete'] = $this->user->get_templete_all_record('tbl_certificate_template','status','1');
			$this->db->where('training_id',$trid);
			$query = $this->db->get('tbl_training_certificate_lists');
			// echo $this->db->last_query();
			$data['certificate'] = $query->result_array();
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/training_certificate',$data);
			// $this->load->frontAdmin('provider/training_certificate');
		
		}
		else
		{
			if(isset($_FILES["files"]) && !empty($_FILES['files']['name'][$i]))
				{
				$datas = array();
			// Count total files 
				
				$countfiles = count($_FILES['files']['name']);
			// Looping all files
					for($i=0;$i<$countfiles;$i++)
					{ 
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
						$config['file_name'] = $_FILES["files"]["name"][$i];

						//Load upload library
						$this->load->library('upload',$config); 
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
					$datas['signature'] = implode('##',$updatess);
				}
		
			
			if(isset($_FILES["logo1"]) && !empty($_FILES["logo1"]['name']))
			{
	            $config['upload_path'] 		= './assets/upload/certificate/logo/';
	            $config['allowed_types'] 	= 'gif|jpg|png|jpeg';
	            $config['max_size'] 		= '200000';
	            $config['max_width']  		= '15000';
	            $config['max_height']  		= '8000';        
	            $ext = explode('.',$_FILES["logo1"]["name"]);        
	            $imageName = 'log1_'.date('Y').'.'.end($ext);
	            $config['file_name'] = $imageName;
	            $this->load->library('upload', $config);
		        if ( ! $this->upload->do_upload('logo1'))
		        {
		        	$error = array('error' => $this->upload->display_errors());                       
		        }  
	            	$datas['logo1'] = $imageName;
	        }

	        if(isset($_FILES["logo2"]) && !empty($_FILES["logo2"]['name']))
			{
	            $config['upload_path'] 		= './assets/upload/certificate/logo/';
	            $config['allowed_types'] 	= 'gif|jpg|png|jpeg';
	            $config['max_size'] 		= '200000';
	            $config['max_width']  		= '15000';
	            $config['max_height']  		= '8000';        
	            $ext = explode('.',$_FILES["logo2"]["name"]);        
	            $imageName = 'log2_'.time().'.'.end($ext);
	            $config['file_name'] = $imageName;
	            $this->load->library('upload', $config);
		        if ( ! $this->upload->do_upload('logo2'))
		        {
		        	$error = array('error' => $this->upload->display_errors());                       
		        }  
	            	$datas['logo2'] = $imageName;
	        }
	       
	        $cid = $this->input->post('training_id');
			// $data = array(); 
			$name = $this->input->post('name');
			$position = $this->input->post('position');

			$datas['user_id']			=  $this->input->post('user_id');  
			$datas['training_id']		=  $this->input->post('training_id');
			$datas['training_title']	=  $this->input->post('training_title');
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
			echo'<pre>';  
			// print_r($datas);

			 $this->db->insert('tbl_training_certificate_lists',$datas);
			 $result = $this->db->insert_id();
			 // print_r($result);die;
			 // echo $this->db->last_query();
			// $result = $this->user->insertcertificate('tbl_user_certificate',$datas); 
				
			
		    // $result = $this->user->save('tbl_training_certificate_lists',$datas); 
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
		// ini_set('display_startup_errors', 1);
		// ini_set('display_errors', 1);
		// error_reporting(-1);	
	/*	$this->checkTraininglogin();

		$trid = $this->session->userdata('current_training_id');

		$uid = $this->session->userdata('logged_in')['id'];*/


		$uid = $this->session->userdata('logged_in')['id'];
		$trid = $this->input->post('tid');

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('header_content', 'Header Content', 'trim|required'); 
		$this->form_validation->set_rules('signatory_name', 'Signatory Name', 'trim|required'); 
		$this->form_validation->set_rules('position', 'Position', 'trim|required'); 

		if($this->input->post('fileSubmit') != NULL )
		{
			$update = array();
			$countfiles = count($_FILES['files']['name']);
			for($i=0;$i<$countfiles;$i++)
			{
				if(!empty($_FILES['files']['name'][$i]))
				{
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = './assets/upload/certificate/signature/'; 
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '5000'; // max_size in kb
					$config['file_name'] = $_FILES['files']['name'][$i];

					$this->load->library('upload',$config); 
					if($this->upload->do_upload('file'))
						{
							$uploadData = $this->upload->data();
							$filename = $uploadData['file_name'];
							$updatess[] = $filename;
						}
				}
			}
			$update['signature'] = implode('##',$updatess);
		}

		if($this->form_validation->run() == FALSE)
		{ 	
			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_training_certificate_lists','id',$idd);
			$data['templete'] = $this->user->get_templete_all_record('tbl_certificate_template','status','1');
			$this->db->where('training_id',$trid);
			$query = $this->db->get('tbl_training_certificate_lists');
			// echo $this->db->last_query();
			$data['certificate'] = $query->result_array();
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/training_certificate_edit',$data);
		}  

		

		if($this->input->post())
		{

			if(!empty($_FILES['logo1']['name'])) {
				
						$config['upload_path']      = './assets/upload/certificate/logo/';
						$config['allowed_types']    = 'gif|jpg|png|jpeg';
						$ext 						= explode('.',$_FILES["logo1"]["name"]);        
						$logo1 						= 'logo1_'.time().'.'.end($ext);
						$config['file_name'] 		= $logo1;
						$config['max_size'] 		= '200000';
			            $config['max_width']  		= '15000';
			            $config['max_height']  		= '8000'; 
						$this->load->library('upload',$config);
						$this->upload->do_upload('logo1');
						$photo = $this->upload->data();
						$update['logo1'] = $logo1;
						// print_r($logo."yes");exit();
				}
			if(!empty($_FILES['logo2']['name'])) {
			
					$config['upload_path']      = './assets/upload/certificate/logo/';
					$config['allowed_types']    = 'gif|jpg|png|jpeg';
					$ext 						= explode('.',$_FILES["logo2"]["name"]);        
					$logo2 						= 'logo2_'.time().'.'.end($ext);
					$config['file_name'] 		= $logo2;
					$config['max_size'] 		= '200000';
		            $config['max_width']  		= '15000';
		            $config['max_height']  		= '8000'; 
					$this->load->library('upload',$config);
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
			// print_r($update);
			$idd            = $this->input->post('idd'); 
			// echo $this->db->last_query();die;
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
		$userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
		$under_insititution = $userdata['under_insititution']; 

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('evaluation_name', 'Training Evaluation', 'trim|required'); 
		if($this->form_validation->run() == FALSE)
		{ 
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$data['training'] = $this->db->get_where('tbl_training',array('id'=>$id))->row_array();
			$this->load->frontAdmin('provider/training_evaluation_edit',$data);

		}  else {

			$data['training_id'] 	     = $trid; 
			$data['evaluation_question'] = $this->input->post('evaluation_name'); 
			$data['question_type'] 		 = $this->input->post('question_type'); 
			$data['status'] 			 = 1;  
			
			$data1['evaluation_note'] 		 = $this->input->post('evaluation_note'); 
		    		$this->user->update('tbl_training',$data1,'id',$id); 
		    $result = $this->user->save('tbl_training_evaluation',$data); 

			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training evaluation updated successfully.</div>');
				if($under_insititution == '0'){
	            if($this->session->userdata('training_types')=="pro"){
	            	if($this->input->post('submit') =='Save_next'){ 
            		$redirect = redirect('provider/training_promotion_edit/'.$id.''); 
            		}else{ 
            		$redirect = redirect('provider/training_evaluation_edit/'.$id.''); 
            		}
                	echo $redirect;
		    	} else {
		    		if($this->input->post('submit') =='Save_next'){ 
            		$redirect = redirect('provider/training_promotion_edit/'.$id.''); 
            		}else{ 
            		$redirect = redirect('provider/training_evaluation_edit/'.$id.''); 
            		}
                	echo $redirect;
		    	}
		    	}else{
		    		if($this->input->post('submit') =='Save_next'){ 
		    			redirect('provider/training_publish_edit/'.$id.'');
		    		}else{
		    			redirect('provider/training_evaluation_edit/'.$id.'');
		    		}

		    	}
		
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		
				redirect('provider/training_evaluation_edit/'.$id.'');
		
			}  
		}
	}


	
	public function training_overview_edit($id)
	{
		//$this->checkTraininglogin();
		$trid = $id; 
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		// $this->form_validation->set_rules('title', 'Title', 'trim|required'); 
		$this->form_validation->set_rules('description', 'Description', 'trim|required'); 
		$this->form_validation->set_rules('objectives', 'Objectives', 'trim|required'); 
		$this->form_validation->set_rules('methodologies', 'Methodologies', 'trim|required'); 
		//$this->form_validation->set_rules('participants', 'Participants', 'trim|required'); 
		if($this->form_validation->run() == FALSE)
		{ 
			$data['trainig_data'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
			$this->load->frontAdmin('provider/training_overview_edit',$data);

		}  else {
			$this->load->library('upload');

			if(isset($_FILES["background_image"]) && !empty($_FILES["background_image"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '20000000';
			// $config['max_width']  = '1500';
			// $config['max_height']  = '800';        
			$ext = explode('.',$_FILES["background_image"]["name"]);        
			$imageName = 'ban_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('background_image'))
			{
				$error = array('error' => $this->upload->display_errors());                       
			}  
				$data['background_image'] = $imageName;
			}

			// $data['title'] 				= $this->input->post('title'); 
			$data['description'] 		= $this->input->post('description');
			$data['objectives'] 		= $this->input->post('objectives'); 
			$data['methodologies'] 		= $this->input->post('methodologies'); 
			$data['participants'] 		= implode(',', $this->input->post('participants')); 
			$data['item_to_bring'] 		= $this->input->post('item'); 

			// print_r($data);die;
		    $result = $this->user->update('tbl_training',$data,'id',$trid); 
			// echo $this->db->last_query(); die;

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
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
			$this->load->frontAdmin('provider/enquiry',$data);
		
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
				redirect('provider/enquiry');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/enquiry',$data);
			} 
		}
	}


	public function profile()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 

		/*if (empty($_FILES['image']['name'])){
		$this->form_validation->set_rules('image', 'Image', 'trim|required'); 
		}*/

		if($this->form_validation->run() == FALSE)
		{
			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			$ins_code = $data['profile'][0]['parent_insititution'];
			$data['ins_name'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$ins_code);
			$country_code = $data['profile'][0]['country'];
			$data['country_name'] = $this->db->get_where('countries',array('countries_id'=>$country_code))->result_array();
            $data['country'] = $this->user->get_record_by_field_name_all_record('countries','status',1);
			$data['cat'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1); 
                        		    
		    $this->load->frontAdmin('provider/profile',$data);
		
		}  else {

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
				  redirect('provider/profile',$data);			
				}else{   
					
					$update['image'] = $imageName;
				}
			}


			if(isset($_FILES["logo"]['name']) && !empty($_FILES["logo"]['name'])){
				$ext="";
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '20000000';
			// $config['max_width']  = '350';
			// $config['max_height']  = '350';        
			$ext = explode('.',$_FILES["logo"]["name"]);        
			$imageName = $ext[0].rand(9,99999999).'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('logo'))
			{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'
				.$this->upload->display_errors().'</div>');
			  redirect('provider/profile');		                       
			} 
		    	$update['logo'] = $imageName;
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
			  redirect('provider/profile');	                     
			} 
		    	$update['backimage'] = $imageName;
			}

			if(isset($_FILES["accreditation_doc"]) && !empty($_FILES["accreditation_doc"]['name'])){
			$config1['upload_path'] = './assets/images/uploads/';
			$config1['allowed_types'] = 'docx|doc|pdf';
			$config1['max_size'] = '2000000';       
			$ext = explode('.',$_FILES["accreditation_doc"]["name"]);        
			$imageName = 'Doc_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('accreditation_doc'))
			{
			$error = array('error' => $this->upload->display_errors());   
				/* echo '<pre>'; print_r($error); die;   */
				$this->session->set_flashdata('response', '<div class="alert alert-danger">'.$error['error'].'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
				
			}  
			$update['accreditation_doc'] = $imageName;
			// echo $update['accreditation_doc'];die;
			}
			// print_r($this->input->post());die;
			$update['name']					= $this->input->post('name');
			$update['profession'] 			= $this->input->post('category'); 
			$update['paypal_email'] 		= $this->input->post('paypal_email'); 
			// $update['location']				= $this->input->post('location');  
			$update['country']				= $this->input->post('country_name');  
			$update['address'] 				= $this->input->post('address'); 
			$update['state'] 				= $this->input->post('state'); 
			$update['city'] 				= $this->input->post('city'); 
			$update['street'] 				= $this->input->post('street'); 
			$update['representative'] 		= $this->input->post('representative'); 
			$update['position'] 			= $this->input->post('designation'); 
			$update['mobile'] 				= $this->input->post('mobile'); 
			
			$update['prc_acceditation_number'] 	= $this->input->post('accreditation_num'); 
			$update['accreditation_web'] 	= $this->input->post('website'); 
			$update['validity'] 			= $this->input->post('validity'); 
			$update['issuing_institution'] 	= $this->input->post('issuing_institution'); 

		    $result = $this->user->update('tbl_user',$update,'id',$uid);
		    // echo $this->db->last_query();
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
				redirect('provider/profile');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/profile');
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
			  redirect('provider/profile',$data);			
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
				redirect('provider/profile');	                     
			} 
			$update['backimage'] = $imageName;
		}
		$result = $this->user->update('tbl_user',$update,'id',$uid);
		if($result){ ?>
			<script>
			var can = confirm('Your CEP Webpage has been updated. Click OK to view CEP webpage.');

				if(can==true){
					window.location.href='https://www.ceonpoint.com/share/viewprofile/'+ <?=$uid; ?>;
				}else{
					window.location.href='profile';
				}
				</script>
				<?php
		} else {
			echo "<script>alert('Please Add new Profile Image  or Background Image!');
				window.location.href='profile';
				</script>";
		} 

	}


	public function settings_old()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
		$this->form_validation->set_rules('profession', 'Profession', 'trim|required');  

		if($this->form_validation->run() == FALSE)
		{
			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid); 
		    
		    $this->load->frontAdmin('provider/settings',$data);
		
		}  else {
			$data['name'] 		= $this->input->post('name'); 
			$data['role'] 	    = $this->input->post('profession');  
				
			//echo '<pre>'; print_r($data); exit;
			
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

		public function settings()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('provider_code', 'Provider Code', 'trim|required'); 

			if($this->form_validation->run() == FALSE)
			{
		 		$data['prov_details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
				
				$this->db->order_by('name','ASC');
				$data['institution_list'] = $this->db->get_where('tbl_user', array('role'=>5,'under_insititution'=>0,'parent_insititution'=>0,'status'=>1))->result_array();
				$this->db->order_by('name','ASC');
				$data['sub_institution_list'] = $this->db->get_where('tbl_user', array('role'=>5,'under_insititution'=>1,'parent_insititution !='=>0,'status'=>1))->result_array();
				$this->load->frontAdmin('provider/settings',$data);

			}else{

			$insid = $this->input->post('institution');
			$ins_code = $this->input->post('ins_code');
			$count = $this->db->get_where('tbl_user',array('id'=>$insid,'insititution_id'=>$ins_code))->num_rows();
				if($count > 0){
					$update = array('parent_insititution'=>$this->input->post('institution'));
					$result = $this->user->update('tbl_user',$update,'id',$uid);
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Institution successfully updated.</div>');
					redirect('provider/settings');
				}else{
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Wrong Institution Code!</div>');
					redirect('provider/settings');
				}
			}
	}


public function notification()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		if($this->form_validation->run() == FALSE)
		{
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$this->db->where('to',$uid);
		$data['notification'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_notification','status',1);
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  
			$this->load->frontAdmin('provider/notification',$data);
		}else{  
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
		$uid 	= $this->session->userdata('logged_in')['id'];
		$urole  = $this->session->userdata('logged_in')['role'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['course_promotion']  	 = $this->provider_model->get_active_course_promotion($uid);
		$data['training_promotion']  = $this->provider_model->get_active_training_promotion($uid);
		$data['training_publish']  	 = $this->provider_model->get_training_publish($uid);
		$data['staff_payment']  	 = $this->provider_model->get_result_array('tbl_institution_staff_payment',array('provider_id'=>$uid));
		$data['certificate_payment'] = $this->provider_model->get_result_array('tbl_training_certificate',array('user_id'=>$uid));
		// echo '<pre>'; print_r($data['certificate_payment']); die;
		$data['advertise'] 			 = $this->advertise_model->getAdvertiseAddsList($uid,$urole);
		$data['company_promotion'] 	 = $this->user->get_active_promoted_provider($uid,$urole);
		// echo $this->db->last_query();
		$this->load->frontAdmin('provider/purchase_list',$data);
	}
		
public function ads_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['advertise'] = $this->advertiseads->getAdvertiseAddsList($uid);
		$this->load->frontAdmin('provider/advertise',$data);
	}




 public function income_report(){
		
		$uid = $this->session->userdata('logged_in')['id'];	
		$report_type = $_REQUEST['otri'];
		// echo $_REQUEST['otri'];
	  if($report_type != 1){
	  
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['todayIncome'] = $this->provider_model->total_income($uid,'today');
		$data['monthIncome'] = $this->provider_model->total_income($uid,'month');
		$data['yearIncome']  = $this->provider_model->total_income($uid,'year');
		$data['totalIncome'] = $this->provider_model->total_income($uid,'total');
		
		//echo '<pre>'; print_r($data['todayIncome']); exit;
		/* $data['today'] = $this->user->get_report('today',$uid);
		$data['month'] = $this->user->get_report('month',$uid);
		$data['year']  = $this->user->get_report('year',$uid);
		$data['total'] = $this->user->get_report('total',$uid); */
		$this->load->frontAdmin('provider/income_report',$data);
	  } else {
	  
	  		
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['todayIncome'] = $this->provider_model->total_income($uid,'today');
		$data['monthIncome'] = $this->provider_model->total_income($uid,'month');
		$data['yearIncome']  = $this->provider_model->total_income($uid,'year');
		$data['totalIncome'] = $this->provider_model->total_income($uid,'total');
		/* $data['today'] = $this->user->get_report1('today',$uid);
		$data['month'] = $this->user->get_report1('month',$uid);
		$data['year']  = $this->user->get_report1('year',$uid);
		$data['total'] = $this->user->get_report1('total',$uid); */
		$this->load->frontAdmin('provider/income_report_otri',$data);
	  
	  }

	}

 public function training_registration()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['registration'] = $this->user->get_record_by_field_name_all_record('tbl_training_book','status',1);
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$this->load->frontAdmin('provider/training_registration',$data);
	
	}
	



 public function training_registration_view($tid)
	{ 
		$uid = $this->session->userdata('logged_in')['id'];
		$data['registration'] = $this->user->get_record_by_field_name_all_record('tbl_training_book','id',$tid);
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
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




 public function user_status($idd,$stts)
	{ 
		$uid = $this->session->userdata('logged_in')['id'];
		$user_info = $this->user->get_record_by_field_name_all_record('tbl_user','id',$idd);
		$data['user_info'] = $user_info;

		if($stts==1){
		 	$update['status'] = 0; 
		 	$text = 'Account Deactivated';
		 	$mail = $this->load->view('email/account_deactivation',$data,true);
		} else {
		  	$update['status'] =1;
		  	$update['approval_date'] = date('Y-m-d');
		 	$text = 'Account Activation';
		 	$mail = $this->load->view('email/account_activation',$data,true);
		}
		
		$result = $this->user->update('tbl_user',$update,'id',$idd); 
			if($result){
				$this->sendMail($user_info[0]['username_email'],$text,$mail);
				
				$notification = array(
				'subject'        	=> $text, 
				// 'user_id' 			=> $userid,  
				'to' 				=> $user_info[0]['id'],  
				'from' 				=> $uid,  
				'message' 			=> $mail,  
				'status'     		=> 1,
				'added_on'     		=> date('Y-m-d H:i:s')
				); 
				$this->user->save('tbl_notification',$notification);

				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Status updated successfully.</div>');
				redirect('provider/authors');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/authors');
			}
	}




 	public function presentstatus(){
 		$stts = $this->input->post('status'); 
 		$tid = $this->input->post('tid'); 
 		$idd = $this->input->post('tableid'); 
		
		$data['present_status'] = $stts; 
		$result = $this->user->update('tbl_training_book',$data,'id',$idd); 
		// echo $this->db->last_query();die;
		if($result){
			$this->session->set_flashdata('response-tl', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Attendance updated successfully.</div>');
			redirect('provider/training_view/'.$tid);
		} else {
			$this->session->set_flashdata('response-tl', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('provider/training_view/'.$tid);
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
 





 public function staff_delete($idd,$tid=false)
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
 


 public function target_delete($idd,$tid=false)
	{ 
	 
		$result = $this->user->delete('tbl_provider_set_target','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record deleted successfully.</div>');
				// redirect('provider/set_target/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				// redirect('provider/set_target/'.$tid.'');
			}
				redirect('provider/set_target');

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
		$uid = $this->session->userdata('logged_in')['id'];
		$ins = $this->session->userdata('logged_in')['under_insititution'];
		if($ins!=1){ $type = 'cepBusiness'; }else{ $type = 'cep institution'; }
		$data['cepbussinesss'] 	= $this->dashboards_model->get_tutorial($type);
		$data['tutorials'] 		= $this->dashboards_model->get_tutorial();
		$this->load->frontAdmin('provider/tutorials',$data);
	}



    public function terms()
	{	
		$ins = $this->session->userdata('logged_in')['under_insititution'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		if($ins!=1){ $type = 'cepBusiness'; }else{ $type = 'cepInstitution'; }
		$data['terms']	= $this->dashboards_model->get_terms($type);
		$data['misc'] 	= $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$this->load->frontAdmin('provider/terms',$data);
	}	


   	public function training_center_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		$filter = $this->uri->segment(3);
		if($filter==""){
			$data['training'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training','user_id',$uid); 
		} elseif($filter=="3") {
			$data['training'] = $this->user->trainingFilter($uid,0); 
		} else {
			$data['training'] = $this->user->trainingFilter($uid,$filter); 
		}		
		$this->load->frontAdmin('provider/training_center_list',$data);
	}

	public function training_center_list1()
	{
			$this->load->database();			//$uid = $this->session->userdata('logged_in')['id'];
			$this->db->where('id', $_REQUEST['id']);
			$this->db->where('status', 1);
			$data=$this->db->get('tbl_training')->row_array();
			
			// print_r($data);
			echo json_encode($data);
	}

   	public function training_center_view($idd)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
		$data['certificate'] = $this->db->order_by('id','DESC')->get_where('tbl_training_certificate_lists',array('training_id'=>$idd))->row_array();
		if(!empty($data['certificate']) && !empty($data['certificate']['category'])){
			$this->db->where('category',$data['certificate']['category']);
			$this->db->where('numberofsignature',$data['certificate']['num_signature']);  
		}
		$query = $this->db->where('status','1')->get('tbl_certificate_template');
		$data['templete'] = $query->result();
		// echo $this->db->last_query();die;
		$this->load->frontAdmin('provider/training_center_view',$data);
	}

   	public function training_view($idd){
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
		$data['certificate'] = $this->db->order_by('id','DESC')->get_where('tbl_training_certificate_lists',array('training_id'=>$idd))->row_array();
		if(!empty($data['certificate']) && !empty($data['certificate']['category'])){
			$this->db->where('category',$data['certificate']['category']);
			$this->db->where('numberofsignature',$data['certificate']['num_signature']);  
		}
		$query = $this->db->where('status','1')->get('tbl_certificate_template');
		$data['templete'] = $query->result();
		// echo $this->db->last_query();die;
		$data['registered'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training_book','training_seminar_id',$idd);
        $this->db->where(array('certificate_id !=' =>NULL,'present_status'=>1));
        $data['present'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training_book','training_seminar_id',$idd);
        $this->db->where(array('certificate_id' =>NULL,'present_status'=>0));
        $data['absent'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training_book','training_seminar_id',$idd);
        if($_REQUEST['filter']==1){ //present
        	$data['datas'] = $data['present'];
        }elseif($_REQUEST['filter']==2){ //absent
        	$data['datas'] = $data['absent'];
        }else{
        	$data['datas'] = $data['registered'];
        }
		$this->load->frontAdmin('provider/training_view',$data);
	}

	public function registraition_status(){
		$tid = $this->input->post('tid');
		$status = $this->input->post('status');

		$update['registration_status'] = $status;
		$this->db->where('id', $tid);
		$result = $this->db->update('tbl_training', $update);
		if($result){
			$this->session->set_flashdata('response-tl', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Registration status Updated.</div>');
		} else {
			$this->session->set_flashdata('response-tl', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		}
		redirect('provider/training_view/'.$tid);
	}




	public function training_evaluation_add(){  
		// echo'<pre>'; print_r($this->input->post('evaluation_name'));die;
		$uid = $this->session->userdata('logged_in')['id'];
		$userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
		$under_insititution = $userdata['under_insititution']; 

		$tid = $this->input->post('tid');
		if($this->input->post('evaluation_name') !=''){
			$question = $this->input->post('evaluation_name');
			foreach ($question as $key => $value) {
			if($value !=""){
			$data['training_id'] 	     = $tid; 
			$data['evaluation_question'] = $value;
			$data['evaluation_type'] 	 = $this->input->post('evaluation_question_type')[$key];
			$data['question_type'] 		 = $this->input->post('question_type')[$key];
			$data['status']              = 1;
			$result = $this->user->save('tbl_training_evaluation',$data); 
			// echo $this->db->last_query();die;
				}
			} 
		} 
		$data1['evaluation_note'] 		 = $this->input->post('evaluation_note'); 
	    		$this->user->update('tbl_training',$data1,'id',$tid); 
	    // echo $this->db->last_query();die;
			if($result){ 
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Evaluation added Successfully.</div>');
				if($under_insititution == '0'){
	            if($this->session->userdata('training_types')=="pro"){
	            	if($this->input->post('submit') =='Save_next'){ 
            		$redirect = redirect('provider/training_promotion_edit/'.$tid.''); 
            		}else{ 
            		$redirect = redirect('provider/training_evaluation_edit/'.$tid.''); 
            		}
                	echo $redirect;
		    	} else {
		    		if($this->input->post('submit') =='Save_next'){ 
            		$redirect = redirect('provider/training_promotion_edit/'.$itidd.''); 
            		}else{ 
            		$redirect = redirect('provider/training_evaluation_edit/'.$tid.''); 
            		}
                	echo $redirect;
		    	}
		    	}else{
					if($this->input->post('submit') =='Save_next'){ 
		    			redirect('provider/training_publish_edit/'.$tid.'');
		    		}else{ 
		    			redirect('provider/training_evaluation_edit/'.$tid.''); 
            		}
		    	}
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				 // redirect('provider/training_publish_edit/'.$tid.''); 
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
	public function evaluationdelete($idd,$tid)
	{ 
		
		$result = $this->user->delete('tbl_evaluation','id',$idd); 
		//echo $this->db->last_query(); die;
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training evaluation deleted successfully.</div>');
				redirect('provider/edit_evaluation/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_evaluation/'.$tid.'');
			}

		die;
	}





public function active_promotion()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['course_promotion'] 	 = $this->user->get_active_promoted_course($uid);
		$data['training_promotion']  = $this->provider_model->get_active_training_promotion($uid);
		$data['company_promotion']   = $this->user->get_active_promoted_provider($uid);
		// print_r($data['company_promotion']);die;
		$this->load->frontAdmin('provider/active_promotion',$data);
	}
public function exam_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['exam_list'] = $this->provider_model->exam_list($uid);
		$data['training_list'] = $this->provider_model->training_list($uid); 
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');		
		$this->load->frontAdmin('provider/exam_list',$data);
	}

public function subscription()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$data['subs_list'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription','user_id',$uid);
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
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



 

	public function course_promote_success($courseid=false)
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$addpromotion = array(
			'user_id' 		=> $uid,
			// 'item_name'    	=> 'Featured Courses',
			'plan_name'    	=> 'Featured Courses',
			'txn_id'        => $_REQUEST['txn_id'],
			'txn_status'    => $_REQUEST['payment_status'],
			'status'        => 1,
			'added_on'      => date('y-m-d'),
			'no_of_day' 	=> $_REQUEST['item_name'],//how many days are requiered for one time 
			'amount'        => $_REQUEST['payment_gross'],
			'course_id'     => $_REQUEST['item_number'],
			'transaction_details'=> json_encode($_REQUEST)
		);
// print_r($addpromotion);
		$result = $this->user->save('tbl_course_promotion',$addpromotion);

		// echo $result;die;

		if($result){
			$cid = $_REQUEST['item_number'];
			$data2['paid_status'] 	= 2;
			$this->user->update('tbl_course',$data2,'id',$cid);
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promote successfully.</div>');
			if(!empty($courseid)){
   	   	  		redirect('provider/edit_promotion/'.$cid.'');
			}else{
   	   	  		redirect('provider/publish');
			}

		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
   	   	  	if(!empty($courseid)){
   	   	  		redirect('provider/edit_promotion/'.$cid.'');
			}else{
   	   	  		redirect('provider/promotion');
			}
		}	
	}
				

	public function training_promote_success($trainingid=false)
	{
		// echo'<pre>'; print_r($_REQUEST);die;
		$uid = $this->session->userdata('logged_in')['id'];
		$t_type = $this->session->userdata('training_types');
		$dayPriceTax = explode('_',$_REQUEST['custom']);
		if($t_type == 1){ $training_types = 1; }else{ $training_types = 0; }
		
		$addpromotion = array(
			'user_id' 		=> $uid,
			'item_name'    	=> $_REQUEST['item_name'],
			'plan_name'    	=> $_REQUEST['item_name'],
			'training_id'   => $_REQUEST['item_number'],
			'training_types'=> $training_types,
			'txn_id'        => $_REQUEST['txn_id'],
			'txn_status'    => $_REQUEST['payment_status'],
			'status'        => 1,
			'added_on'      => date('y-m-d'),
			'txn_type' 		=> $_REQUEST['txn_type'],
			'no_of_day' 	=> $dayPriceTax[0], //how many days are requiered for one time 
			'base_price' 	=> $dayPriceTax[1], 
			'tax' 			=> $dayPriceTax[2], 
			'amount'        => $_REQUEST['payment_gross'],
			'transaction_details'=> json_encode($_REQUEST)
		);

		$result = $this->user->save('tbl_training_promotion',$addpromotion); 
		// echo $this->db->last_query();die;

		if($result){
			$tid = $_REQUEST['item_number'];
			$data2['paid_status'] 	= 2;
			$data2['featured_from'] = date('Y-m-d');
			$data2['featured_to'] 	= date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$dayTaxBase[0].' days'));
			$this->user->update('tbl_training',$data2,'id',$tid);
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training Promotion success.</div>');

			if($trainingid==''){
	   	   	  	redirect('provider/training_center_list');die;
			}
			if(!empty($t_type)=='pro'){
				if(!empty($trainingid)){
	   	   	  		redirect('provider/training_promotion_edit/'.$trainingid.'');
				}else{
	   	   	  		redirect('provider/training_sponsors');
				}
			}else{
				if(!empty($trainingid)){
	   	   	  		redirect('provider/training_promotion_edit/'.$trainingid.'');
				}else{
	   	   	  		redirect('provider/training_publish');
				}
			}
					
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			if(!empty($trainingid)){
   	   	  		redirect('provider/training_promotion_edit/'.$trainingid.'');
			}else{
   	   	  		redirect('provider/training_promotion');
			}
		}
	}



    public function training_promote_fail($tid=false)
	{		
		//$this->checkcourselogin();
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_rules('prof_name', 'Prof Name', 'trim|required'); 
		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$tid);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Payment has been cancel. Please try Again!</div>');

		if(!empty($tid)){
			$this->load->frontAdmin('provider/training_promotion',$data);
		}else{
			$this->load->frontAdmin('provider/training_promotion_edit',$data);
		}
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


	public function getFeatureDetails()
	{
		$uid = $this->input->post('uid');
		$u['user_id'] = $uid;
		$this->db->select('tbl_promoted_provider_transaction.id,tbl_promoted_provider_transaction.promoted_date,tbl_promoted_provider_transaction.user_id');
		$this->db->order_by('id','DESC');
		$result = $this->provider_model->get_row_array('tbl_promoted_provider_transaction',$u);
		echo json_encode($result);

	}

	public function dailypromoteprovider()
    {
     	$uid = $this->input->post('uid');
        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
        $this->form_validation->set_rules('dailyprice', 'daily price', 'trim|required');
        $this->form_validation->set_rules('day', 'day', 'trim|required');       
 
        if($this->form_validation->run() == FALSE){ 
            $this->load->view('provider/overview');
        }else{ 
        	// echo'<pre>';print_r($this->input->post());die;
            $dailyprice  = $this->input->post('dailyprice');
            $day    	 = $this->input->post('day');
            $tax    	 = $this->input->post('tax');
            $totalamunt  = $this->input->post('pricewithtax');
            $uname  	 = $this->input->post('uname');
            $item_name   =  $uname.'- Company Promotion';
           
            if($totalamunt){  ?>
			<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="promotecep" id="promotecep">
			<input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
			<input type="hidden" name="cmd" value="_xclick">
			<!-- <input type="hidden" name="item_name" id="item_name" value="Plan_<?php echo $day;?>"> -->
			<input type="hidden" name="item_name" value="<?php echo $item_name;?>">
			<input type="hidden" name="item_number" value="<?php echo $day; ?>">
			<input type="hidden" name="credits" value="510">
			<input type="hidden" name="userid" value="<?php echo $uid; ?>">
			<input type="hidden" name="amount" id="amount" value="<?php echo $totalamunt;?>">
			<input type="hidden" name="custom" id="custom" value="<?php echo $tax.'_'.$dailyprice;?>">
			<input type="hidden" name="quantity" value="1">
			<input type='hidden' name='rm' value='2'>
			<input type="hidden" name="no_shipping" value="1">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="handling" value="0">
			<input type="hidden" name="cancel_return" value="<?php echo site_url('provider/company_prmote_fail');?>">
			<input type="hidden" name="return" value="<?php echo site_url('provider/company_prmote_success')?>">
			</form>

			<script type="text/javascript">	
		     document.getElementById("promotecep").submit();
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
	public function coursepromote()
    {
    	// echo'<pre>';print_r($this->input->post());die;
     	$uid = $this->input->post('uid');
        $dailyprice  = $this->input->post('dailyprice');
        $day    	 = $this->input->post('course_day');
        $tax    	 = $this->input->post('tax');
        $totalamunt  = $this->input->post('pricewithtax');
        $item_name   = $this->input->post('item_name');
        $custom   	 = $this->input->post('custom');
       
        if($totalamunt){           	
        ?>
		<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="coursePromostion" id="coursePromostion">
		<input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="item_name" value="<?php echo $item_name;?>">
		<input type="hidden" name="item_number" value="<?php echo $day.'_'.$tax.'_'.$dailyprice; ?>">
		<input type="hidden" name="credits" value="510">
		<input type="hidden" name="userid" value="1">
		<input type="hidden" name="custom" id="custom" value="<?php echo $custom; ?>">
		<input type="hidden" name="amount" id="amount" value="<?php echo $totalamunt;?>">
		<input type="hidden" name="quantity" value="1">
		<input type='hidden' name='rm' value='2'>
		<input type="hidden" name="no_shipping" value="1">
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="handling" value="0">
		<input type="hidden" name="cancel_return" value="<?php echo site_url('provider/course_listing');?>">
		<input type="hidden" name="return" value="<?php echo site_url('provider/course_promotion_paypal')?>">
		</form>

		<script type="text/javascript">	
	     document.getElementById("coursePromostion").submit();
		</script>
		<?php die; ?>
		
        <?php  

            $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Promoted successfully.</div>');
            redirect('provider/course_listing');
        } else {
            $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
             redirect('provider/cource_listing');

        }
	}

	public function course_promotion_paypal()
	{
		// print_r($_REQUEST);die;
		$uid = $this->session->userdata('logged_in')['id'];
		$dayTaxBase = explode('_', $_REQUEST['item_number']);
		$addpromotion = array(
			'user_id' 		=> $uid,
			// 'item_name'    	=> 'Featured Courses',
			'plan_name'    	=> $_REQUEST['item_name'],
			'item_name'    	=> $_REQUEST['item_name'],
			'txn_id'        => $_REQUEST['txn_id'],
			'txn_status'    => $_REQUEST['payment_status'],
			'status'        => 1,
			'added_on'      => date('Y-m-d'),
			'no_of_day' 	=> $dayTaxBase[0], //how many days are requiered for one time 
			'tax'        	=> $dayTaxBase[1],
			'base_price'    => $dayTaxBase[2],
			'amount'        => $_REQUEST['payment_gross'],
			'course_id'     => $_REQUEST['custom'],
			'transaction_details'=> json_encode($_REQUEST)
		);
		$result = $this->user->save('tbl_course_promotion',$addpromotion);
		// echo $result;die;
		if($result){
			$cid = $_REQUEST['custom'];
			$data2['paid_status'] 	= 2;
			$data2['featured_from'] = date('Y-m-d'); 
			$data2['featured_to'] 	= date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$dayTaxBase[0].' days'));
			$this->user->update('tbl_course',$data2,'id',$cid);
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable"><h4>Your Course in now listed as fetured at the Course\'s Page.</h4></div>');
   	   	  	redirect('provider/active_promotion?id=done1');
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
   	   	  	redirect('provider/dashboard');
		}	
	}


public function company_prmote_success(){
	// print_r($_REQUEST);die;
	// $idd = explode('_', $_REQUEST['item_name']);	
	// $day = trim($idd[1]);		
	$day =  $_REQUEST['item_number'];		
	$taxAndBase = explode('_', $_REQUEST['custom']);
	$userid = $this->session->userdata('logged_in')['id'];
	$userrole = $this->session->userdata('logged_in')['role'];
		$promotedData = array(
			'user_id' 			=> $userid,
			'role' 				=> $userrole,
			'promoted_date' 	=> date('Y-m-d'),
			'promoted_day' 		=> $day,
			'tax' 			    => $taxAndBase[0],
			'base_price' 		=> $taxAndBase[1],
			'promoted_amount' 	=> $_REQUEST['payment_gross'],
			'txn_id' 			=> $_REQUEST['txn_id'],
			'transaction_details'=> json_encode($_REQUEST)
		);
	$promotresult = $this->user->save('tbl_promoted_provider_transaction',$promotedData);
		// echo'<pre>';echo $this->db->last_query();die;
	$featuredData['featured_from'] = date('Y-m-d');
	$featuredData['featured_to'] = date('Y-m-d', strtotime(date('Y-m-d') . '+ '.$day.'days'));
	// echo $featuredData['featured_from'].'/'.$featuredData['featured_to'];die;
	$result = $this->user->update('tbl_user',$featuredData,'id',$userid);
	if($result > 0 && $promotresult > 0){
		$this->session->set_flashdata('response', '<h4>Your company is now listed as fetured at the CE Provider\'s Page.</ch4>');
		 redirect('provider/active_promotion?id=done');
	} else {
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		 redirect('provider/dashboard');
	}

}

public function company_prmote_fail(){
	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
        redirect('provider/dashboard');
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
			$country = $this->db->get_where('countries',array('countries_id'=>$uname['country']))->row_array();
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
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
	   	}elseif($type=='Company Promotion'){
	   		$this->db->where('ppt.id',$idd);
			$dataArray = $this->user->get_active_promoted_provider($uid);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['user_id']))->row_array();
			$country = $this->db->get_where('countries',array('countries_id'=>$uname['country']))->row_array();
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
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 		= $returnarray;

		}elseif($type=='Course Promotion'){
			$this->db->where('cp.id',$idd);
			$dataArray = $this->provider_model->get_active_course_promotion($uid);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['user_id']))->row_array();
			$country = $this->db->get_where('countries',array('countries_id'=>$uname['country']))->row_array();
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
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
	   	}elseif($type=='Training Promotion'){
	   		$this->db->where('tp.id',$idd);
			$dataArray = $this->provider_model->get_active_training_promotion($uid);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['user_id']))->row_array();
			$country = $this->db->get_where('countries',array('countries_id'=>$uname['country']))->row_array();
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = round($json->payment_gross);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= 'Training Promotion';
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		}elseif($type=='Staff Payment'){
			$where = array('id'=>$idd);
			$dataArray = $this->provider_model->get_result_array('tbl_institution_staff_payment',$where);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['provider_id']))->row_array();
			$country = $this->db->get_where('countries',array('countries_id'=>$uname['country']))->row_array();
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = round($json->payment_gross);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= 'Staff Payment';
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
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
			$country = $this->db->get_where('countries',array('countries_id'=>$uname['country']))->row_array();
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
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
	   	}
	   		// echo $this->db->last_query();die;
	   $this->load->view('provider/receipt',$data);
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
		if($type=='Training'){
			$dataArray = $this->dashboards_model->receipt_tmss($idd);
			$returnarray = array();
				$json 		  = json_decode($dataArray['transaction_details']);
				$price 		  = round($json->payment_gross);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);
        
			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= $dataArray['course_title'];
			$returnarray['username'] 		= $dataArray['username'];
			$returnarray['countries_name'] 	= $dataArray['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
	   	}
	    // $datedata = $this->input->post('datedata');
	    // $data['totalData'] =  $this->user->getpaydetails($datedata);
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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/training_speaker',$data);
            
        }  else { 

				$this->load->library('upload'); 
            if(isset($_FILES["speaker_image"]["name"]))  
           {  
               	$config['upload_path'] = './assets/images/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; 

              	$this->upload->initialize($config); 
                if(!$this->upload->do_upload('speaker_image'))  
                {  
                    $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
                    redirect('provider/training_speaker');
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
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d'); 
                $result = $this->user->save('tbl_training_speaker',$data);

				// echo $this->db->last_query();die;
				// if(isset($_FILES["powerpoint"]) && !empty($_FILES["powerpoint"]['name']))
				// 		{
				//           $config1['upload_path'] 		= './assets/images/uploads/';
				//           $config1['allowed_types'] 	= 'gif|jpg|png|jpeg';
				//           $config1['max_size'] 		= '200000';
				//           $config1['max_width']  		= '15000';
				//           $config1['max_height']  		= '8000';        
				//           $ext = explode('.',$_FILES["powerpoint"]["name"]);        
				//           $imageName = 'log1_'.time().'.'.end($ext);
				//           $config1['file_name'] = $imageName;
				//           $this->load->library('upload', $config1);
				//        if ( ! $this->upload->do_upload('powerpoint'))
				//        {
				//        	$error = array('error' => $this->upload->display_errors());                       
				//        }   
					  
				//         $where1 = array('training_id'=>$tid,'speaker_id'=>$sid);
				//         $powerpoint= $this->user->get_record_by_multi_field_name('tbl_speaker_powerpoint',$where1);
				  
				//         if(empty($powerpoint)){

				// 		$data11 = $this->upload->data();
				// 		$imageName  =  $data11["file_name"]; 


				//         	$data2['images'] =  $imageName; 
				//         	$data2['speaker_id'] =  $result; 
				//         	$data2['training_id'] =  $trid; 
				//         	$data2['status'] =  1; 

				// 		$result = $this->user->save('tbl_speaker_powerpoint',$data2);
				//         } else {
				// 		$data2['images'] =  $imageName;    
				// 		$result = $this->user->updatemultiplecond('tbl_speaker_powerpoint',$data2,$where1);
				//         } 
				//       }

                if(isset($_FILES["powerpoint"]) && !empty($_FILES['powerpoint']['name']))
				{
				$datas = array();
				// Count total files 
				
				$countfiles = count($_FILES['powerpoint']['name']);
				// Looping all files
					for($i=0;$i<$countfiles;$i++)
					{ 
						$_FILES['file']['name'] 	= $_FILES['powerpoint']['name'][$i];
						$_FILES['file']['type'] 	= $_FILES['powerpoint']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['powerpoint']['tmp_name'][$i];
						$_FILES['file']['error'] 	= $_FILES['powerpoint']['error'][$i];
						$_FILES['file']['size'] 	= $_FILES['powerpoint']['size'][$i];
						// Set preference
						$config['upload_path'] 		= './assets/images/uploads/'; 
						$config['allowed_types'] 	= 'jpg|jpeg|png|gif';
						$config['max_size'] 		= '5000'; // max_size in kb
			            $ext = explode('.',$_FILES["powerpoint"]["name"][$i]);       
			            $imageName = 'sig_'.time().'.'.end($ext);
						$config['file_name'] = $imageName;

						//Load upload library
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

					//$data2['images'] = implode('##',$updatess);

			        $where1 = array('training_id'=>$tid,'speaker_id'=>$sid);
			        $powerpoint= $this->user->get_record_by_multi_field_name('tbl_speaker_powerpoint',$where1);

			        if(empty($powerpoint)){

					$data11 = $this->upload->data();
					$imageName  =  implode('##',(array)$updatess); 


		        	$data2['images'] =  $imageName; 
		        	$data2['speaker_id'] =  $result; 
		        	$data2['training_id'] =  $trid; 
		        	$data2['status'] =  1; 

					$result = $this->user->save('tbl_speaker_powerpoint',$data2);
			        } else {
					$data2['images'] =  $imageName;    
					$result = $this->user->updatemultiplecond('tbl_speaker_powerpoint',$data2,$where1);
			        } 
				}

 


            if($result){
            	if($this->input->post('submit')=='save_next'){ 
            		$redirect = redirect('provider/training_schedule'); 
            	}else{ 
            		$redirect = redirect('provider/training_speaker'); 
            	}
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker added successfully.</div>');
                echo $redirect;
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_speaker');
            } 

        }       
    }
}

public function training_speaker_edit($id=false)
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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/training_speaker_edit',$data);
            
        }  else { 
               
               $this->load->library('upload');

            if(isset($_FILES["speaker_image"]["name"]))  
           {  

               	$config['upload_path'] = './assets/images/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';    

              	$this->upload->initialize($config);   
                if(!$this->upload->do_upload('speaker_image'))  
                {  
                    $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
                    redirect('provider/training_speaker');
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
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d');  

                $result = $this->user->save('tbl_training_speaker',$data);
                if(isset($_FILES["powerpoint"]) && !empty($_FILES['powerpoint']['name']))
				{
				$datas = array();
				$countfiles = count($_FILES['powerpoint']['name']);
					for($i=0;$i<$countfiles;$i++)
					{ 
						$_FILES['file']['name'] 	= $_FILES['powerpoint']['name'][$i];
						$_FILES['file']['type'] 	= $_FILES['powerpoint']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['powerpoint']['tmp_name'][$i];
						$_FILES['file']['error'] 	= $_FILES['powerpoint']['error'][$i];
						$_FILES['file']['size'] 	= $_FILES['powerpoint']['size'][$i];
						// Set preference
						$config['upload_path'] 		= './assets/images/uploads/'; 
						$config['allowed_types'] 	= 'jpg|jpeg|png|gif';
						$config['max_size'] 		= '5000'; // max_size in kb
			            $ext = explode('.',$_FILES["powerpoint"]["name"][$i]);       
			            $imageName = 'sig_'.time().'.'.end($ext);
						$config['file_name'] = $imageName;

						//Load upload library
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

			        $where1 = array('training_id'=>$tid,'speaker_id'=>$sid);
			        $powerpoint= $this->user->get_record_by_multi_field_name('tbl_speaker_powerpoint',$where1);

			        if(empty($powerpoint)){

					$data11 = $this->upload->data();
					$imageName  =  implode('##',(array)$updatess); 


		        	$data2['images'] 		=  $imageName; 
		        	$data2['speaker_id'] 	=  $result; 
		        	$data2['training_id'] 	=  $trid; 
		        	$data2['status'] 		=  1; 

					$result = $this->user->save('tbl_speaker_powerpoint',$data2);
			        } else {
					$data2['images'] =  $imageName;    
					$result = $this->user->updatemultiplecond('tbl_speaker_powerpoint',$data2,$where1);
			        } 
				}

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

public function successedit()
	{
		
		$cid = $this->uri->segment(3);
		$data['status'] = 0;
		$result1 = $this->user->update('tbl_course',$data,'id',$cid); 
		$this->load->frontAdmin('provider/success',$cid);
	}

public function saveedit()
	{

		$cid = $this->uri->segment(3);
		
		$data['status'] = 3;
	
		$result1 = $this->user->update('tbl_course',$data,'id',$cid);
		$this->load->frontAdmin('provider/save',$cid);
	}

public function deletePowerpoint($pid,$key,$trid)
    {   
		$images = $this->db->get_where('tbl_speaker_powerpoint',array('id'=>$pid))->row_array()['images'];
    	$img = explode('##', $images);
    	unset($img[$key]);
    	// print_r($img);
    	$imgs = implode('##', $img);
    	$imageArr = array('images'=>$imgs); 
    	$this->db->where('id',$pid);
    	$this->db->update('tbl_speaker_powerpoint',$imageArr);
    	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker\'s Powerpoint deleted successfully.</div>');
    	redirect('provider/training_speaker_edit/'.$trid.'');
    }

public function training_speaker_update($id=false,$tid=false)
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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/training_speaker_update',$data);
        }  else { 
		$tid  = $this->input->post('tid');
		$sid  = $this->input->post('sid');
		     if(isset($_FILES["powerpoint"]) && !empty($_FILES['powerpoint']['name'][0]))
				{
				$datas = array(); 
				$countfiles = count($_FILES['powerpoint']['name']);
			// Looping all files
					for($i=0;$i<$countfiles;$i++)
					{ 
						$_FILES['file']['name'] = $_FILES['powerpoint']['name'][$i];
						$_FILES['file']['type'] = $_FILES['powerpoint']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['powerpoint']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['powerpoint']['error'][$i];
						$_FILES['file']['size'] = $_FILES['powerpoint']['size'][$i];
						// Set preference
						$config['upload_path'] = './assets/images/uploads/'; 
						$config['allowed_types'] = 'jpg|jpeg|png|gif';
						$config['max_size'] = '5000'; // max_size in kb
			            $ext = explode('.',$_FILES["powerpoint"]["name"][$i]);       
			            $imageName = 'sig_'.time().'.'.end($ext);
						$config['file_name'] = $imageName;

						//Load upload library
						$this->load->library('upload',$config); 
						// File upload
						if($this->upload->do_upload('file'))
							{
						// Get data about the file
							$uploadData = $this->upload->data();
							$filename = $uploadData['file_name'];
						// Initialize array

					$where11 = array('training_id'=>$tid,'speaker_id'=>$sid);
					$powerpoint1 = $this->user->get_record_by_multi_field_name('tbl_speaker_powerpoint',$where11);


					if($powerpoint1[0]['images']==""){
						$filename = $filename;
					} else {
						$filename = $powerpoint1[0]['images'].'##'.$filename;
					}
						$updatess[] = $filename;
						}
					}

					//$data2['images'] = implode('##',$updatess);

			        $where1 = array('training_id'=>$tid,'speaker_id'=>$sid);
			        $powerpoint= $this->user->get_record_by_multi_field_name('tbl_speaker_powerpoint',$where1);
			        $imageName  =  implode('##',$updatess); 
					$data2['images'] =  $imageName;    
					$result = $this->user->updatemultiplecond('tbl_speaker_powerpoint',$data2,$where1);
				}

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
	    $this->user->delete('tbl_speaker_powerpoint','training_id',$tid);
		$result = $this->user->delete('tbl_training_speaker','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker deleted successfully.</div>');
				redirect('provider/training_speaker_edit/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_speaker_edit'.$tid.'');
			}

		die;
	}

	public function speaker_delete_addtime($idd,$tid)
	{ 
	    $this->user->delete('tbl_speaker_powerpoint','training_id',$tid);
		$result = $this->user->delete('tbl_training_speaker','id',$idd); 
	
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Speaker deleted successfully.</div>');
				redirect('provider/training_speaker/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_speaker'.$tid.'');
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

        // $this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');     
        $this->form_validation->set_rules('schedule_date', 'Schedule Date', 'trim|required');     
        // $this->form_validation->set_rules('schedule_start_time', 'Schedule Start Time', 'trim|required');     
        // $this->form_validation->set_rules('schedule_end_time', 'Schedule End Time', 'trim|required');     
        // $this->form_validation->set_rules('topic', 'Topic', 'trim|required');     


        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$trid);
            //$this->load->frontAdmin('provider/training_center_list',$data);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
            $this->load->frontAdmin('provider/training_schedule',$data);
            
        }  else { 
        	// echo'<pre>';print_r($this->input->post());die;
        	$count = count($this->input->post('topic'));
        	$i = 0;
        	for($i;$i<$count;$i++){
                $data['topic']          	 =  $this->input->post('topic')[$i];  
                $data['training_id']         =  $trid;  
                $data['speaker_id']          =  $this->input->post('speaker')[$i];  
                $data['schedule_date']       =  $this->input->post('schedule_date');  
                $data['schedule_start_time'] =  $this->input->post('schedule_start_time')[$i];   
                $data['schedule_end_time']   =  $this->input->post('schedule_end_time')[$i];  
                $data['speaker_name']        =  $this->input->post('others')[$i];   
                $data['status']              =  1;  
                $data['added_on']            =  date('Y-m-d');  

               $result = $this->user->save('tbl_training_schedule',$data);
           	}
            if($result){
                if($this->input->post('submit')=='Save_next'){ 
            		$redirect = redirect('provider/training_evaluation'); 
            	}else{ 
            		$redirect = redirect('provider/training_schedule'); 
            	}
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Schedule added successfully.</div>');
                echo $redirect;
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_schedule');
            }               
       }
}
 







public function updatesettarget()
    {   
		$trid 		 = $this->input->post('cource_id'); 

        $data['cource_name']    =  $this->input->post('cource_name');  
        $data['category']       =  $this->input->post('category_name');  
        $data['total_staff']    =  $this->input->post('total_staff');   
        $data['target_number']  =  $this->input->post('target_number');   
        $data['implementation_date']  =  $this->input->post('implementation_date');  
        $data['added_on']  		=  date('Y-m-d H:i:s');  
       
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
                if($this->input->post('submit')=='Save_next'){ 
            		$redirect = redirect('provider/training_evaluation_edit/'.$training_id.''); 
            	}else{ 
            		$redirect = redirect('provider/training_schedule_edit/'.$training_id.''); 
            	}
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Schedule added successfully.</div>');
                echo $redirect;
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

        // $this->form_validation->set_rules('speaker', 'Speaker', 'trim|required');     
        $this->form_validation->set_rules('schedule_date', 'Schedule Date', 'required');     
        // $this->form_validation->set_rules('schedule_start_time', 'Schedule Start Time', 'trim|required');     
        // $this->form_validation->set_rules('schedule_end_time', 'Schedule End Time', 'trim|required');     
        // $this->form_validation->set_rules('topic', 'Topic', 'trim|required');     


        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$id);
            //$this->load->frontAdmin('provider/training_center_list',$data);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/training_schedule_edit',$data);
            
        }  else { 
		// echo'<pre>'; print_r($this->input->post());die;
        		$count = count($this->input->post('topic'));
        		// echo $count;
        		$i = 0;
        		for($i;$i<$count;$i++){
	                $data['topic']               =  $this->input->post('topic')[$i];  
	                $data['training_id']         =  $trid;  
	                $data['speaker_id']          =  $this->input->post('speaker')[$i];  
	                $data['schedule_date']       =  $this->input->post('schedule_date');  
	                $data['schedule_start_time'] =  $this->input->post('schedule_start_time')[$i];   
	                $data['schedule_end_time']   =  $this->input->post('schedule_end_time')[$i];   
	                $data['speaker_name']        =  $this->input->post('others')[$i];   
	                $data['status']              =  1;  
	                $data['added_on']            =  date('Y-m-d');  
	                $result = $this->user->save('tbl_training_schedule',$data);
	                // echo $this->db->last_query();die;
           		}

            if($i == $count){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Schedule added successfully.</div>');
            	if($this->input->post('submit')=='Save_next'){ 
            		$redirect = redirect('provider/training_evaluation_edit/'.$trid.''); 
            	}else{ 
            		$redirect = redirect('provider/training_schedule_edit/'.$trid.''); 
            	}
                echo $redirect;
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_schedule_edit/'.$trid.'');
            }               
       }
}







	public function saverating(){
		$evaluationRating = $this->input->post();
	   // echo '<pre>';print_r($evaluationRating);die;
	   $questionid=$evaluationRating['questionid'];
	   $reviewData=array();
	   foreach($questionid as $key => $id)
	   {
		   $item=array();
		   $item['training_id']   = $evaluationRating['tid'];
		   $item['speaker_id']    = $this->session->userdata('logged_in')['id'];
		   // $item['speaker_id'] = $this->session->userdata('logged_in')['id'];
		   $item['question_id'] = $id;
		   if($evaluationRating['question_type'][$key]==1){
		   $item['star_mark']   = $evaluationRating["rating$id"];
		   }
		   if($evaluationRating['comments'][$key]){
		   $item['comments']    = $evaluationRating['comments'][$key];
		   }
		  $reviewData[]         = $item;
		   $result = $this->user->save('tbl_training_review',$item);
	   // echo '<pre>'.$this->db->last_query();
	   }
		   // die;	
        if($result){
            $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Review submited successfully.</div>');
            redirect('pages/training_details_evaluation/'.$evaluationRating['tid'].'');
        } else {
            $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
            redirect('pages/training_details_evaluation/'.$evaluationRating['tid'].'');
        }    
	}



	public function savecourserating(){
	   $evaluationRating = $this->input->post();
	   // echo '<pre>';print_r($evaluationRating);die;
	   $questionid=$evaluationRating['questionid'];
	   $reviewData=array();
	   foreach($questionid as $key => $id)
	   {
		   $item=array();
		   $item['course_id']   = $evaluationRating['cid'];
		   $item['user_id']     = $this->session->userdata('logged_in')['id'];
		   $item['question_id'] = $id;
		   $item['star_mark']   = $evaluationRating["rating$id"];
		   if($evaluationRating['evaluation']){
		   $item['comments']    = $evaluationRating['evaluation'][$key];
		   }
		  $reviewData[]         = $item;
		   $result = $this->user->save('tbl_course_review',$item);
	   }
		   // echo $this->db->last_query();die;
        if($result){
            $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Review submited successfully.</div>');
            redirect('pages/evaluation/'.$evaluationRating['cid'].'');
        } else {
            $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
            redirect('pages/evaluation/'.$evaluationRating['cid'].'');
        }    
	}


public function invoice_list()
    {       
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['todayIncome'] = $this->provider_model->total_income($uid,'today');
		$data['monthIncome'] = $this->provider_model->total_income($uid,'month');
		$data['yearIncome']  = $this->provider_model->total_income($uid,'year');
		$data['totalIncome'] = $this->provider_model->total_income($uid,'total');
		$data['invoice_list']  = $this->provider_model->get_result_array('tbl_invoice',array('user_id' =>$uid));
		$this->load->frontAdmin('provider/invoice_list',$data);
 	}	

public function create_invoice()
    {       
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
             redirect('provider/invoice_list');
            
        }  else { 


                $data['month_name']          =  $this->input->post('invoice_date');  
                $data['user_id']             =  $this->session->userdata('logged_in')['id'];  
                $data['payment_method']      =  $this->input->post('payment_method');  
                $data['total_amount']        =  $this->input->post('total_amount');  
                $data['tax']        		 =  $this->input->post('tax');  
                $data['admin_amount']        =  $this->input->post('adminIncome');  
                $data['cpd_amount']          =  $this->input->post('cpdIncome');  
                $data['country']          	 =  $this->session->userdata('logged_in')['country']; 

                if($data['payment_method']=="paypal"){
                  $data['paypal_id']          =  $this->input->post('paypalId');  
                }

                if($data['payment_method']=="bank"){
                  $data['bank_account']       =  $this->input->post('bank_account');  
                  $data['bank_code']          =  $this->input->post('bank_code');  
                  $data['bank_name']          =  $this->input->post('branch_name');  
                  $data['swift_code']         =  $this->input->post('swift_code');  
                }
	              $data['status']              =  1;  
	              $data['added_on']            =  date('Y-m-d');  

               $result = $this->user->save('tbl_invoice',$data);
			// echo $this->db->last_query();die;
               $excludeDate = explode('-', $this->input->post('invoice_date'));

               $yy = $excludeDate[0];
               $mm = $excludeDate[1];


            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Invoice has been sent to admin.</div>');
                redirect('provider/invoice_list?month='.$mm.'&year='.$yy.'');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/invoice_list?month='.$mm.'&year='.$yy.'');
            }               
       }
}
 


public  function mypdf($cpdid,$cust_id){ 

	$this->load->model('Certificate_model','certificate_model'); 

	//echo $cpdid.'_'.$cust_id; die;
		include('./third_party/library/phpqrcode/qrlib.php'); 
			// $this->load->library('phpqrcode');
			$image_location = "./assets/images/uploads/";

			$image_name = date('d-m-Y-H-i-s').'.png';

			$filename = "CERTI".rand(9,9999999).time();

			$dataContent = $filename;
			$ecc  = 'H';
			$size = '5';
 
			QRcode::png($dataContent, $image_location.$image_name, $ecc, $size);  

			$data['certificate_no']  = $filename;
			$data['barcode']         = $image_name;
			$data1['certificate_id'] = $filename;
			$data1['barcode'] 		 = $image_name;	
			$this->user->update('tbl_training_book',$data1,'id',$cust_id);
			// echo $this->db->last_query();die;
			
	$data['cust_data'] = $this->user->get_record_by_field_name_all_record('tbl_training_book','id',$cust_id);
	$data['profile']  = $this->user->get_record_by_field_name_all_record('tbl_user','id',$data['cust_data'][0]['user_id']);
	$this->db->select('tr.user_id as cep_id,tr.location,tr.units,tr.start_date,tr.end_date,tr.title as training_title,ct.id,ct.bg_image,ct.template_no,ct.text_image,tcl.*');
	$this->db->from('tbl_training_certificate_lists tcl');
	$this->db->join('tbl_certificate_template ct', 'tcl.templete_id = ct.id');  
	$this->db->join('tbl_training tr', 'tr.id = tcl.training_id');  
	$this->db->where('tcl.training_id ', $data['cust_data'][0]['training_seminar_id']); 
	$query = $this->db->get();
	$data['certificate'] = $query->result_array(); 
	$data['owner'][0]['location'] = $data['certificate'][0]['location']; 
	$data['course_details'][0]['units'] = $data['certificate'][0]['units']; 
	$cepname = $this->db->get_where('tbl_user',array('id'=>$data['certificate'][0]['cep_id']))->row_array()['name'];
	// echo'<pre>'; print_r($data['cust_data'][0]['barcode']);die;

	if($data['cust_data'][0]['certificate_id'] ==""){		
	// if($data['cust_data'][0]['certificate_id'] =="2"){	?> 
		<div style="text-align: center;">
		<p style="font-size: 17px;">You have already generated the certificate for this professional.</p>
		<a href="<?php echo site_url('provider/training_center_list'); ?>">BACK</a>
		</div>
	<?php 
	} else {
		$insert = array(
			'user_id'		=>$data['cust_data'][0]['user_id'], 
			'certificate_id'=>$data1['certificate_id'], 
			'course_name'	=>$data['certificate'][0]['training_title'], 
			'units'			=>$data['certificate'][0]['units'], 
			'start_date'	=>$data['certificate'][0]['start_date'], 
			'end_date'		=>$data['certificate'][0]['end_date'],
			'certificate'	=>$data1['certificate_id'], 
			'issue_date'	=>$data['cust_data'][0]['added_on'], 
			'issue_from'	=>'Training', 
			'issue_by'		=>'CEonpoint', 
			'cep_name'		=> $cepname, 
			'status'		=>1, 
			'archive'		=>1, 
			'added_on'		=>date('Y-m-d') 
		);
		$this->user->save('tbl_existing_certificate',$insert);
	// echo $this->db->last_query();die;
	$category = $data['certificate'][0]['category'];
	$temp = $data['certificate'][0]['template_no'];
	$path = $this->certificate_model->select_certificate_template_pdf($category,$temp);
	// echo $path;die;
	$this->load->view($path,$data);

	// Get output html
	$html = $this->output->get_output();
	$this->load->library('Dompdf_gen');
	$this->dompdf->load_html($html);

	if($data['certificate'][0]['category']=='Portrait'){
		$this->dompdf->set_paper('letter','portrait');
	}else{
		$this->dompdf->set_paper('letter','landscape');
	}

	$this->dompdf->render();
	$this->dompdf->stream("Training-certificate.pdf");
	//$filename = rand(9,999999).time();
	// $this->dompdf->stream("certificate.pdf",array("Attachment" => true));
	file_put_contents('assets/upload/pdf/'.$filename.'.pdf', $this->dompdf->output($html));


	$subject = "Training Certificate";
	$data3['attch'] = $this->email->attach('assets/upload/pdf/'.$filename.'.pdf');
	$data3['user_name'] = $data['profile'][0]['name'];
	$this->sendMail($data['profile'][0]['username_email'],$subject,$this->load->view('email/get_certifiate_mail',$data3,true));
	echo" <script> window.location.href = <?php echo site_url('provider/training_center_view/'".$cpdid."); ?></script>";
	// $this->load->library('email', $config);
	// $this->email->set_newline("\r\n");
	// $this->email->from('mails@ceonpoint.com');
	// //$this->email->to('deepak.1999.kumar@gmail.com');
	// $this->email->to($data['cust_data'][0]['email']);
	// $this->email->subject($subject);
	// $this->email->message($message);
	// $this->email->attach('assets/upload/pdf/'.$filename.'.pdf');
	// 	if($this->email->send())
	// 	{ 
	// 		echo "<center><strong>Certificate generated successfully.</strong>
	// 		<br> You will redirect to previous page Automatically.</center>";
	// 		echo "<script>setTimeout(\"location.href = 'https://www.ceonpoint.com/provider/training_center_view'\",3500);</script>";
	// 	}
	// 	else
	// 	{
	// 		show_error($this->email->print_debugger());
	// 	}
	}

   }
public  function preview_certificate(){ 

	$this->load->model('Certificate_model','certificate_model'); 
	$userid = $_POST['uid'];
	$trainingid = $_POST['tid'];
	$data['profile'][0]['name'] =  $this->session->userdata('logged_in')['name'];
	$data['cust_data'][0]['barcode'] =  'scan.png';
	$data['cust_data'][0]['added_on'] =  date("F d, Y");
	$data['cust_data'][0]['certificate_id'] =  'CERTI987654321';
	
	$this->db->select('tt.title as training_title ,tt.units,tt.location,ct.id, ct.bg_image, ct.template_no, ct.text_image,tcl.*');
	$this->db->from('tbl_training_certificate_lists tcl');
	$this->db->join('tbl_certificate_template ct', 'tcl.templete_id = ct.id');
	$this->db->join('tbl_training tt', 'tcl.training_id = tt.id');
	$this->db->where('tcl.training_id',$trainingid);
	$this->db->where('tcl.user_id',$userid);  
	$query = $this->db->get();
	$data['certificate'] = $query->result_array();
	if(!empty($data['certificate'][0]['location'])){$data['certificate'][0]['location'] = $data['certificate'][0]['location'];  }else{$data['certificate'][0]['location'] = 'Mount Royal Auditorium, Delaware,USA'; }

	if(!empty($data['certificate'][0]['training_title'])){$data['certificate'][0]['training_title'] = $data['certificate'][0]['training_title'];  }else{$data['certificate'][0]['training_title'] = 'Professional Empowerment Training Course'; }

	if(!empty($data['certificate'][0]['units'])){$data['certificate'][0]['units'] = $data['certificate'][0]['units'];  }else{$data['certificate'][0]['units'] = '5'; }
	
	$category = $data['certificate'][0]['category'];
	$temp = $data['certificate'][0]['template_no'];
	$path = $this->certificate_model->select_certificate_template($category,$temp);
	// echo'<pre>';print_r($path);
	$html = $this->load->view($path,$data);
	return $html;

	
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
   
	public function success_provider_plan($id){ 
		$uid   = $this->session->userdata('logged_in')['id'];
		// echo'<pre>';print_r($_REQUEST);die;
		$num_of_participants = count(explode(',',$_REQUEST['item_number']));
		$taxBase = explode('_', $_REQUEST['custom']);
	    $datas['user_id']       = $uid;
	    $datas['training_id']   = $taxBase[2];
	    $datas['participate_cust_ids'] = $_REQUEST['item_number'];
	    $datas['num_of_participants'] = $num_of_participants;
	    $datas['tax'] 			= $taxBase[0];
	    $datas['base_price'] 	= $taxBase[1];
	    $datas['amount']        = $_REQUEST['payment_gross'];
	    $datas['txn_id']        = $_REQUEST['txn_id'];
	    $datas['status']        = 1;
	    $datas['added_on']      = date('Y-m-d');
	    $datas['transaction_details'] = json_encode($_REQUEST);
	    $datas['payment_status'] = 1;
	    $result = $this->user->save('tbl_training_certificate',$datas);
	    // echo $this->db->last_query();die;
		if($result > 0){
			$this->session->set_flashdata('response-res', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Payment has been completed successfully.</div>');
			// $this->session->set_flashdata('response-go', $result);
			redirect('provider/template/'.$id.'/'.$result.'');
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Payment has been completed successfully.</div>');
			redirect('provider/template/'.$id.'');	
		}
	}





public function direct_create_certificate($tid=""){
	//$items = explode('_', $_REQUEST['item_name']);
	$plan  = $items[0];
	$training_id  = $tid;
	$uid   = $this->session->userdata('logged_in')['id'];

	$certId = $this->session->userdata('current_certificate_id');

    $datas['status']       		= 1;
    $datas['payment_status']    = 1; //this one is free
    $datas['transaction_id']    = "free-".Rand(1000,99999);
    // print_r($training_id);die;
    if($training_id){
    	$result = $this->user->update('tbl_training_certificate',$datas,'id',$certId);
    }
    //$this->session->unset_userdata('current_certificate_id');
	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Payment has been completed successfully.</div>');
				redirect('provider/generate_certificate/'.$tid.'');
	}

	public function cancel_provider_plan($id)
	{	
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable"> Payment Has been canceled ! </div>');
   	   	redirect('provider/template/'.$id.'');
	}

 	public function template($idd,$id=false)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		
		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
		$data['temp'] = $this->db->get_where('tbl_training_certificate_lists',array('training_id'=>$idd,'user_id'=>$uid))->row_array();
		$data['templete'] = $this->db->get_where('tbl_certificate_template',array('status'=>1,'id'=>$data['temp']['templete_id']))->row_array();
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		// echo $this->db->last_query();die;
		$this->load->frontAdmin('provider/template',$data);
	}	

	public function recipients($idd)
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/recipients',$data);
	}

	public function total_bill($idd)
	{		
			
		if($_REQUEST['checked']){

			$data1['user_id']      = $this->session->userdata('logged_in')['id'];
			$data1['customer_id']  = serialize($_REQUEST['checked']);
			$data1['participate_cust_ids']  = (count($_REQUEST['checked'])>0)?implode(',',$_REQUEST['checked']):'';
			$data1['certificate_type']  = 'training';
			$data1['status']       = 1;
			$result = $this->user->save('tbl_training_certificate',$data1);
			$this->session->set_userdata('current_certificate_id', $result);
		  }
		    // echo '<pre>'; print_r($_REQUEST); die;
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/total_bill',$data);
	}	

	public function payment($idd)
	{	
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/payment',$data);
	}	

	public function generate_certificate($idd)
	{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/generate_certificate',$data);
	}


public function training_center_free($tid=false)
	{

		$uid = $this->session->userdata('logged_in')['id'];
		$this->session->unset_userdata('current_training_id');
		$this->session->set_userdata('training_types', 'free');

		if($tid){
    		$trainings = $this->user->get_record_by_field_name_all_record('tbl_training','id',$tid);
    		if($trainings[0]['training_type']==0){
    	       $this->session->set_userdata('training_types', 'free');
    		} else {
    	       $this->session->set_userdata('training_types', 'pro');
    		}
    	}
    	$this->form_validation->set_rules('select', 'Template', 'trim|required');  

        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/training_center_free',$data);
            
        }  
        else{ 

        	$_SESSION['templates'] = $this->input->post('select');
	        $data['templates']     = $this->input->post('select');
	        // print_r($_SESSION['templates']);die;
	        $this->session->set_userdata('current_template',$this->input->post('select'));
			
			$result = $this->db->order_by('id','DESC')->limit(1)->get('tbl_training')->row_array();
			$this->session->set_userdata('current_training_id',$result['id']+1);
	
 			if($tid != $this->uri->segment(3) || $this->uri->segment(3) == ''){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Template added successfully.</div>');
                redirect('provider/choose_certificate');
 			}else{
 				$this->user->update('tbl_training',$data,'id',$tid);
 				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Template added successfully.</div>');
                redirect('provider/choose_certificate_edit/'.$tid);
 			}
    	}
	}

/*   Pro Methods starts from here    */

	

public function training_center_pro($tid=false)
    {  
    	$uid = $this->session->userdata('logged_in')['id'];
		$this->session->unset_userdata('current_training_id');
    	$this->session->set_userdata('training_types', 'pro');

    	if($tid){
    		$trainings = $this->user->get_record_by_field_name_all_record('tbl_training','id',$tid);
    		if($trainings[0]['training_type']==0){
    	       $this->session->set_userdata('training_types', 'free');
    		} else {
    	       $this->session->set_userdata('training_types', 'pro');
    		}
    	}

        // $this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        $this->form_validation->set_rules('select', 'Template', 'trim|required');  

        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/training_center_pro',$data);
            
        }  
        else{ 

        	$_SESSION['templates'] = $this->input->post('select');
	        $data['templates']       = $this->input->post('select');
	        // print_r($_SESSION['templates']);die;
	        $this->session->set_userdata('current_template',$this->input->post('select'));
			
			$result = $this->db->order_by('id','DESC')->limit(1)->get('tbl_training')->row_array();
			$this->session->set_userdata('current_training_id',$result['id']+1);
			// echo'aksja';
				
 			if($tid != $this->uri->segment(3) || $this->uri->segment(3) == ''){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Template added successfully.</div>');
                redirect('provider/choose_certificate');
 			}else{
 				$this->user->update('tbl_training',$data,'id',$tid);
 				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Template added successfully.</div>');
                redirect('provider/choose_certificate_edit/'.$tid);
 			}
    }
} 



public function choose_certificate()
    {  
    	$this->checkTraininglogin();
		$trid = $this->session->userdata('current_training_id');
		// echo $this->session->userdata('training_types');die;
		$uid = $this->session->userdata('logged_in')['id'];

		$this->load->library('upload'); 
        //$this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        // $this->form_validation->set_rules('select', 'Template', 'trim|required'); 
        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('category', 'Category', 'trim|required'); 
		$this->form_validation->set_rules('numsignature', 'Number of Signature', 'trim|required'); 
		$this->form_validation->set_rules('templete_id', 'Template', 'trim|required');
		$this->form_validation->set_rules('header_line1', 'Header Content', 'trim|required');
		$this->form_validation->set_rules('certificatetitle', 'Certificate Title', 'trim|required');
		$this->form_validation->set_rules('introText', 'Intro Text', 'trim|required'); 

        if($this->form_validation->run() == FALSE)
        {  
            // $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            $data['templete'] = $this->user->get_templete_all_record('tbl_certificate_template','status','1');
			$data['training_types'] = $this->session->userdata('training_types');
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/choose_certificate',$data);
            
        }  
        else 
        { 
			if(isset($_FILES["files"]) && !empty($_FILES['files']['name']))
				{
				$datas = array();
			// Count total files 
				
				$countfiles = count($_FILES['files']['name']);
			// Looping all files
					for($i=0;$i<$countfiles;$i++)
					{ 
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
						$config['file_name'] = $_FILES["files"]["name"][$i];

						//Load upload library
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
					$datas['signature'] = implode('##',$updatess);
				}
		
			
			if(isset($_FILES["logo1"]) && !empty($_FILES["logo1"]['name']))
			{
	            $config1['upload_path'] 		= './assets/upload/certificate/logo/';
	            $config1['allowed_types'] 	= 'gif|jpg|png|jpeg';
	            // $config1['max_size'] 		= '200000';
	            // $config1['max_width']  		= '15000';
	            // $config1['max_height']  	= '8000';        
	            $ext = explode('.',$_FILES["logo1"]["name"]);        
	            $imageName = 'log1_'.time().'.'.end($ext);
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
	            // $config2['max_size'] 		= '200000';
	            // $config2['max_width']  		= '15000';
	            // $config2['max_height']  	= '8000';        
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
	       
	       
			// $data = array(); 
			$name = $this->input->post('name');
			$position = $this->input->post('position');

			$datas['user_id'] 			=  $uid; 
	      // $datas['training_title'] 	=  $this->input->post('training_title'); 
	        $datas['training_id'] 		=  $trid; 
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
			$datas['status']			=  1;
			$datas['added_at']			=  date('Y-m-d');
			// echo'<pre>';  print_r($datas);die;

			$add = $this->db->get_where('tbl_training_certificate_lists',array('training_id'=>$trid,'user_id'=>$uid))->row_array();

			if($add['id'] == ''){
			 	$this->db->insert('tbl_training_certificate_lists',$datas);
			 	$result = $this->db->insert_id();
			}else{
	        	$this->user->update('tbl_training_certificate_lists',$datas,'id',$add['id']); 
			 	$result = $add['id'];
			}		        	
			 $this->session->set_userdata('current_templete_id', $result);
			 $this->session->set_userdata('current_temp_category', $this->input->post('category'));
			 // print_r($result);die;			
		    if($result){ 
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training certificate added successfully.</div>');
				redirect('provider/upload_information');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/choose_certificate');
			} 
		}   
	}

	public function choose_certificate_edit($tid)
    {  
    	
		// print_r($tid);die;
		$uid = $this->session->userdata('logged_in')['id'];
		$trid = $tid;
		$this->load->library('upload'); 

        //$this->form_validation->set_rules('speaker_name', 'Speaker Name', 'trim|required');   
        // $this->form_validation->set_rules('select', 'Template', 'trim|required'); 
        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('category', 'Category', 'trim|required'); 
		$this->form_validation->set_rules('numsignature', 'Number of Signature', 'trim|required'); 
		$this->form_validation->set_rules('templete_id', 'Template', 'trim|required');
		$this->form_validation->set_rules('header_line1', 'Header Content', 'trim|required');
		$this->form_validation->set_rules('certificatetitle', 'Certificate Title', 'trim|required');
		$this->form_validation->set_rules('introText', 'Intro Text', 'trim|required');

		
        if($this->form_validation->run() == FALSE)
        {  
            $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
            // $data['templete'] = $this->user->get_templete_all_record('tbl_certificate_template','status','1');
			$this->db->where('training_id',$trid);
			$query = $this->db->get('tbl_training_certificate_lists');
			$data['certificate'] = $query->result_array();
			if(!empty($data['certificate']) && !empty($data['certificate'][0]['category'])){
				$this->db->where('category',$data['certificate'][0]['category']);
				$this->db->where('numberofsignature',$data['certificate'][0]['num_signature']);  
			}
			$query = $this->db->where('status','1')->get('tbl_certificate_template');
			$data['templete'] = $query->result();
			$data['training_id'] = $tid;
			// print_r($data['certificate'][0]);die;
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/choose_certificate',$data);
            
        }  
        else 
        { 
			if(isset($_FILES["files"]) && !empty($_FILES['files']['name']))
				{
				$datas = array();
			// Count total files 
				
				$countfiles = count($_FILES['files']['name']);
			// Looping all files
					for($i=0;$i<$countfiles;$i++)
					{ 
						$_FILES['file']['name'] 	= $_FILES['files']['name'][$i];
						$_FILES['file']['type'] 	= $_FILES['files']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$_FILES['file']['error'] 	= $_FILES['files']['error'][$i];
						$_FILES['file']['size'] 	= $_FILES['files']['size'][$i];
						// Set preference
						$config['upload_path'] = './assets/upload/certificate/signature/'; 
						$config['allowed_types'] = 'jpg|jpeg|png|gif';
						$config['max_size'] = '5000'; // max_size in kb
			            $ext = explode('.',$_FILES["files"]["name"][$i]);       
			            $imageName = 'sig_'.time().'.'.end($ext);
						$config['file_name'] = $_FILES["files"]["name"][$i];

						//Load upload library
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
					$datas['signature'] = implode('##',(array)$updatess);
				}
		
			// print_r($_FILES["logo2"]);die;
			if(isset($_FILES["logo1"]) && !empty($_FILES["logo1"]['name']))
			{
	            $config1['upload_path'] 		= './assets/upload/certificate/logo/';
	            $config1['allowed_types'] 	= 'gif|jpg|png|jpeg';
	            // $config['max_size'] 		= '200000';
	            // $config['max_width']  		= '15000';
	            // $config['max_height']  		= '8000';        
	            $ext = explode('.',$_FILES["logo1"]["name"]);        
	            $imageName = 'log1_'.time().'.'.end($ext);
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
	            // $config['max_size'] 		= '2000000';
	            // $config['max_width']  		= '15000';
	            // $config['max_height']  		= '8000';        
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
	        // echo'<pre>';
	        // print_r($datas['logo2']);die;
			$name = $this->input->post('name');
			$position = $this->input->post('position');
			
		 	if($datas['signature']==''){
		 		unset($datas['signature']);
		 	}
			$datas['user_id']			=  $uid;  
			$datas['training_id']		=  $this->input->post('tid');
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
			$datas['updated_at']		=  date('Y-m-d');
			// echo '<pre>'; print_r($datas);
			 // echo'>>>'.$this->input->post('idd');die;
			$idd = $this->input->post('idd'); 

			if($idd == ''){
	        	$result = $this->user->save('tbl_training_certificate_lists',$datas); 
			}else{
	        	$result = $this->user->update('tbl_training_certificate_lists',$datas,'id',$idd); 
			}	

			// echo $this->db->last_query();die;
			 // $this->session->set_userdata('current_templete_id', $result);
			 // $this->session->set_userdata('current_temp_category', $this->input->post('category'));
			
		    if($result){

				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training certificate Updated successfully.</div>');
			// redirect('provider/upload_information/'.$trid);
			redirect('provider/choose_certificate_edit/'.$trid);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/choose_certificate_edit/'.$trid);
			} 
		}   
	}



	public function deletelogo($idd,$tid,$tbl)
	{ 
			$data = array('logo2'=>"");
			$this->db->where('id',$idd);
		if($tbl==1){
			$result = $this->db->update('tbl_training_certificate_lists',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record deleted successfully.</div>');
				redirect('provider/choose_certificate_edit/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/choose_certificate_edit/'.$tid.'');
			}
		}
		if($tbl==2){
			$result = $this->db->update('tbl_user_certificate',$data);

			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record deleted successfully.</div>');
				redirect('provider/edit_certificate/'.$tid.'');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/edit_certificate/'.$tid.'');
			} 
		}

		die;
	}








	public function upload_information()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$udetails = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		$this->session->unset_userdata('current_training_id');
		$t_type = $this->session->userdata('training_types');

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		
		$this->form_validation->set_rules('titles', 'Title', 'trim|required'); 
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required'); 
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required'); 
		$this->form_validation->set_rules('start_time', 'Start Time', 'trim|required'); 
		$this->form_validation->set_rules('end_time', 'End Time', 'trim|required');

		//$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
		// $this->form_validation->set_rules('speaker', 'Speaker', 'trim|required'); 

		$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
		$this->form_validation->set_rules('location', 'Location', 'trim|required'); 
		$this->form_validation->set_rules('c_person', 'Contact Person', 'trim|required'); 
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_training.email]'); 
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required'); 
		$this->form_validation->set_rules('cp_number', 'CP Number', 'trim|required'); 
		$this->form_validation->set_rules('units', 'Units', 'trim|required'); 
		$this->form_validation->set_rules('category', 'Category', 'trim|required'); 
		$this->form_validation->set_rules('host', 'Host', 'trim|required'); 
		// $this->form_validation->set_rules('about_host', 'About Host', 'trim|required'); 
		 

		if($this->form_validation->run() == FALSE)
		{


			$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','user_id',$uid);
			$data['cat'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
			$data['purchase_plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription','user_id',$uid);

			$data['plan'] = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','status',1);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
			$this->load->frontAdmin('provider/upload_information',$data);
		
		}  else {
   
			$this->load->library('upload');

		 if(isset($_FILES["attach_logo"]) && !empty($_FILES["attach_logo"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			// $config['max_width']  = '1500';
			// $config['max_height']  = '800';        
			$ext = explode('.',$_FILES["attach_logo"]["name"]);        
			$imageName = 'lo_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('attach_logo'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['attach_logo'] = $imageName;
			}


			if(isset($_FILES["bannerimage"]) && !empty($_FILES["bannerimage"]['name'])){
			$config1['upload_path'] = './assets/images/uploads/';
			$config1['allowed_types'] = 'gif|jpg|png|jpeg';
			$config1['max_size'] = '200000';
			// $config1['max_width']  = '1500';
			// $config1['max_height']  = '800';        
			$ext = explode('.',$_FILES["bannerimage"]["name"]);        
			$imageName = 'Ban_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('bannerimage'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['image'] = $imageName;
			}



		if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
			$config2['upload_path'] = './assets/images/uploads/';
			$config2['allowed_types'] = 'gif|jpg|png|jpeg';
			$config2['max_size'] = '200000';
			// $config2['max_width']  = '1500';
			// $config2['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName = 'IMGS_'.time().'.'.end($ext);
			$config2['file_name'] = $imageName;
			$this->upload->initialize($config2);
			if ( ! $this->upload->do_upload('image'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['image'] = $imageName;
			}

			if(isset($_FILES["venue_photo"]) && !empty($_FILES["venue_photo"]['name'])){
			$config3['upload_path'] = './assets/images/uploads/';
			$config3['allowed_types'] = 'gif|jpg|png|jpeg';
			$config3['max_size'] = '200000';
			// $config3['max_width']  = '1500';
			// $config3['max_height']  = '800';        
			$ext = explode('.',$_FILES["venue_photo"]["name"]);        
			$imageName1 = 'VP_'.time().'.'.end($ext);
			$config3['file_name'] = $imageName1;
			$this->load->library('upload', $config3);
			$this->upload->initialize($config3);
			if ( ! $this->upload->do_upload('venue_photo'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['venue_photo'] = $imageName1;
			}	
			if($udetails['under_provider']==''){
				$ins_id_for_training = 0;
			}else{
				$ins_id_for_training = $udetails['under_provider'];
			}

			$data['user_id'] 	= $uid;
			$data['title'] 	    = ucwords($this->input->post('titles')); 
			$data['sub_title'] 	= $this->input->post('sub_title'); 

			$data['host'] 		= $this->input->post('host'); 
			$data['about_host'] = $this->input->post('about_host'); 
			$data['video'] 		= $this->input->post('video'); 
			
			$data['speaker'] 	= $this->input->post('speaker'); 

			$data['price'] 		= $this->input->post('price'); 
			$data['tax'] 		= $this->input->post('tax'); 
			$data['total'] 		= $this->input->post('total');
			 
			$data['location'] 	= $this->input->post('location'); 
			$data['start_date'] = $this->input->post('start_date'); 
			$data['end_date'] 	= $this->input->post('end_date'); 
			$data['start_time'] = $this->input->post('start_time'); 
			$data['end_time'] 	= $this->input->post('end_time'); 

			$data['contact_person'] = $this->input->post('c_person'); 
			$data['email'] 	     = $this->input->post('email'); 
			$data['phone'] 	     = $this->input->post('phone'); 
			$data['cp_number'] 	 = $this->input->post('cp_number'); 
			$data['units']   	 = $this->input->post('units'); 
			$data['add_link']   	 = $this->input->post('add_link'); 
			$data['category_id'] = $this->input->post('category'); 
			$data['status'] 	 = 0;
			$data['certificate'] = $this->session->userdata('current_templete_id');
			
			if($this->session->userdata('training_types')=='pro'){
				$data['training_type'] = 1;
			}else{
				$data['training_type'] = 0;
			}

			$data['country_id']  = $this->session->userdata('logged_in')['country'];
			$data['templates']   = $this->session->userdata('current_template');
			//$uid = $this->session->userdata('logged_in')['id'];
			//$userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			
			$uid = $this->session->userdata('logged_in')['id'];
			$userdetails1 = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			$userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$userdetails1[0]['parent_insititution']);

			$data['insititution_id']   = $ins_id_for_training;
			
		    // print_r($data['training_type']);die;
		    $result = $this->user->save('tbl_training',$data); 
			$this->session->set_userdata('current_training_id', $result);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">General Information created successfully.</div>');
				redirect('provider/training_overview');
				
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				// redirect('provider/training_overview');
				redirect('provider/upload_information');

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

			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');	
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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
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
		  $data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
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
            	if($this->input->post('submit')=='save_next'){ 
            		$redirect = redirect('provider/training_publish'); 
            	}else{ 
            		$redirect = redirect('provider/training_committee'); 
            	}
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Committee added successfully</div>');
                echo $redirect;
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('provider/training_committee');
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
               if($this->input->post('submit')=='save_next'){ 
            		$redirect = redirect('provider/training_publish'); 
            	}else{ 
            		$redirect = redirect('provider/training_committee'); 
            	}
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Committee added successfully</div>');
                echo $redirect;
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
    		if($this->input->post('submit')=='save_next'){ 
            		$redirect = redirect('provider/training_publish_edit/'.$trid.''); 
            	}else{ 
            		$redirect = redirect('provider/training_committee_edit/'.$trid.''); 
            	}
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Committee added successfully</div>');
                echo $redirect;
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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
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
			$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/training_exam_edit',$data); 
}


 


 
public function training_sponsors_edit()
    {       
    	//$this->checkTraininglogin();
		  $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
		  $data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
            $this->load->frontAdmin('provider/training_sponsors_edit',$data);
} 



public function training_committee_edit()
    {       
    	//$this->checkTraininglogin();
		  $data['speaker'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',1);
		  $data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
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

		$data['sponsors_name'] 	= $this->input->post('sponsor_name')[$i];
		$data['urls'] 			= $this->input->post('sponsor_url')[$i];
		$data['sponsors_image'] = $dataInfo['file_name']; 
		$data['status'] 		= 1;
		$data['training_id']    = $trid;
		$data['added_on'] 		= date('Y-m-d');
		
		// echo '<pre>'; print_r($this->input->post()); die;
		$result = $this->user->save('tbl_training_sponsors',$data);
		// echo $this->db->last_query();die;
    }

    	if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Sponsor added successfully.</div>');
                if($this->input->post('submit')=='Save_next'){
                	redirect('provider/training_committee_edit/'.$trid);
                }else{
                	redirect('provider/training_sponsors_edit/'.$trid);
                }

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
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		$userid = $this->session->userdata('logged_in')['id'];
		$post = $this->input->post();
		// print_r($post);die;
		$data = array(
			'user_id' 		=> $userid,
			'amount' 		=> $post['total_amount'],
			'package_id' 	=> $post['advertise_id'],
			'no_of_view' 	=> $post['no_of_view'],
			'website_url' 	=> $post['website_url'],
			'payment_status' => 0,
			'status' 		=> 1,
			'country' 		=> $post['country'],
		);

		 if(isset($_FILES["banner_image"]) && !empty($_FILES["banner_image"]['name'])){
            $config['upload_path'] = './assets/upload/advertise/';
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
             $data['banner_image'] .= $imageName;
            }

			// $result = $this->user->save('tbl_adv_package_purchased',$data);	
			$this->db->insert('tbl_adv_package_purchased',$data);
			$result = $this->db->insert_id();
			// echo $result;die;
			$amount = $post['total_amount'];
			echo '<form action="'.PAYAPAL_URL.'" method="post" name="advertisement" id="advertisement">
				<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="item_name" id="item_name" value="provider">
				<input type="hidden" name="item_number" value="'.$result.'">
				<input type="hidden" name="credits" value="510">
				<input type="hidden" name="userid" value="'.$userid.'">
				<input type="hidden" name="amount" id="amount" value="'.$amount.'">
				<input type="hidden" name="rm" value="2">
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="handling" value="0">
				<input type="hidden" name="cancel_return" value="'.site_url('provider/fail_add_advertise').'">
				<input type="hidden" name="return" value="'.site_url('provider/success_add_advertise').'">
			</form>

				<script type="text/javascript">
					document.getElementById("advertisement").submit();
				</script>
			';
		
	}
	
	function success_add_advertise()
	{	
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		// echo $this->session->userdata('logged_in')['id'];
		// echo'<pre>';print_r($_REQUEST);exit;
		
			//$item_id 					= $_REQUEST['item_name'];
			$item_id 					= $_REQUEST['item_number'];
			$data['txn_id']             = $_REQUEST['txn_id'];
			$data['txn_status']         = $_REQUEST['payment_status'];
			$data['purchased_on']  		= date('Y-m-d H:i:s');
			$data['amount']             = $_REQUEST['payment_gross'];
			$data['payment_status']		= 1;
			$data['payment_details']	= json_encode($_REQUEST);

			$data1['adv_id'] = $this->advertiseads->update('tbl_adv_package_purchased',$data,'id',$item_id);
			// $this->session->set_flashdata('response','');
		if($data1['adv_id']){
			$this->load->frontAdmin('provider/thanku',$data1); 
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">There is some error. Please try again.</div>');
			$this->load->frontAdmin('provider/add_advertise',$data); 
		}

		
	}
	function fail_add_advertise()
	{
		$this->session->set_flashdata('response','<div class="alert alert-danger">There is some error. Please try again.</div>');
		$this->load->frontAdmin('provider/add_advertise'); 
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
			$uid = $this->session->userdata('logged_in')['id'];
			$item_id = $_REQUEST['item_name'];			 
			$data['total_view']=0;
			$result = $this->advertiseads->update('tbl_adv_package_purchased',$data,'id',$item_id);
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
			$this->load->frontAdmin('provider/thanku',$data); 
			
		} else {
			echo "There is some error. Please try again.";
		}
	}






	public function staffcerecords($id = false)
	{ 
		if($id){
			$uid = $id;
		}else{
	    	$uid = $this->session->userdata('logged_in')['id']; 
		}

	    $profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
	    $parent_insititution = $profile[0]['parent_insititution'];
	    $where =array('role'=>1,'parent_insititution'=>$parent_insititution);
	    $data['allprovider'] = $this->user->get_record_by_multi_field_name('tbl_user',$where); 
	    $data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
	    $data['profession'] = $this->db->get_where('tbl_category',array('status'=>1))->result_array();
	    $data['unit_staff'] = $this->db->get_where('tbl_unit_staff',array('status'=>'1','added_by'=>$uid))->result_array();
		$this->db->select('is.*,u.id as pid');
		$this->db->from('tbl_institution_staff is');
		$this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
		$this->db->where('is.insititution_code',$profile[0]['insititution_id']);
		$data['staff_list'] = $this->db->get()->result_array();
		// echo $this->db->last_query();

		$this->load->frontAdmin('provider/staffcerecords',$data); 
	}

	public function staffpayment()
	{ 
	    $uid = $this->session->userdata('logged_in')['id']; 
	    $profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
	    $parent_insititution = $profile[0]['parent_insititution'];
	   
		$this->db->select('is.*,u.id as pid');
		$this->db->from('tbl_institution_staff is');
		$this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
		$this->db->where('is.insititution_code',$profile[0]['insititution_id']);
		$this->db->where('is.status','1');
		$this->db->where('is.prof_id !=',0);
		$this->db->where('is.activated','0');
		$data['staff_list'] = $this->db->get()->result_array();

		// $this->db->select('is.*,u.id as pid');
		// $this->db->from('tbl_institution_staff is');
		// $this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
		// $this->db->where('is.insititution_code',$profile[0]['insititution_id']);
		// $this->db->where('is.status','1');
		// $this->db->where('is.prof_id !=',0);
		// $this->db->where('is.activated','1');
		// $data['staff_active_list'] = $this->db->get()->result_array();
		// echo $this->db->last_query();

		$this->load->frontAdmin('provider/staffpayment',$data); 
	}

	public function getstaff(){
		$id = $this->input->post('id');
		$result = $this->db->get_where('tbl_institution_staff',array('id'=>$id))->row_array();
		echo (json_encode($result));
	}

	public function registerstaff()
	{ 
		$uid 		 = $this->session->userdata('logged_in')['id']; 
		$profile 	 = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		$ins_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$profile[0]['parent_insititution']);
		
		$this->form_validation->set_rules('email', 'email', 'is_unique[tbl_institution_staff.email]|required');
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Email should be unique.</div>');
				redirect('provider/staffcerecords');
		}else{

		$data['ins_name'] 	   = $ins_details[0]['name']; 
		$data['ins_code'] 	   = $ins_details[0]['insititution_id']; 
		$data['code'] 		   = $this->input->post('code'); 
		$data['provider_name'] = $profile[0]['name']; 
		$data['provider_code'] = $profile[0]['insititution_id']; 
		$data['name'] 		   = $this->input->post('name'); 
		$data['email'] 		   = $this->input->post('email'); 

			$added = array(
				'staff_name'        => $data['name'], 
				'email' 			=> $data['email'], 
				'staff_code' 		=> $data['code'], 
				'insititution_id'   => $profile[0]['id'],  
				'insititution_code' => $data['provider_code'],  
				'status'     		=> 0,
				'startdate'     	=> $this->input->post('startdate'),
				'enddate'     		=> $this->input->post('enddate'),
				'added_on'     		=> date('Y-m-d')
			); 

			$result = $this->user->save('tbl_institution_staff',$added);
			
			$subject = 'Connect with CE Provider with below Code.'; 
			if($result){
				$user = $this->db->get_where('tbl_user',array('username_email'=>$data['email']))->row_array();
				if($user){ $userid = $user['id']; }else{ $userid = 0; }
				$notification = array(
				'subject'        	=> $subject, 
				// 'user_id' 			=> $userid,  
				'to' 				=> $userid,  
				'from' 				=> $uid,  
				'message' 			=> $this->load->view('email/invite_professional_mail',$data,true),  
				'status'     		=> 1,
				'added_on'     		=> date('Y-m-d H:i:s')
				); 
				$this->user->save('tbl_notification',$notification);
				
				$this->sendMail($data['email'],$subject,$this->load->view('email/invite_professional_mail',$data,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Staff Added Successfully and a mail sent to Professional.</div>');
				redirect('provider/staffcerecords');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/staffcerecords');
			}}
	}

	public function updatestaff()
	{ 
		$uid = $this->session->userdata('logged_in')['id']; 
		$id = $this->input->post('id');
			$update = array(
				'staff_name'  => $this->input->post('name'), 
				'email' 	  => $this->input->post('email'),   
				'startdate'   => $this->input->post('startdate'),   
				'enddate' 	  => $this->input->post('enddate'),   
				'status'      => $this->input->post('status'),
			); 

			$result = $this->user->update('tbl_institution_staff',$update,'id',$id); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Staff Updated Successfully.</div>');
				redirect('provider/staffcerecords');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/staffcerecords');
			}
	}
	

	public function set_target()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$user_ins = $this->session->userdata('logged_in')['insititution_id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$this->db->or_where(array('author_reference_id'=>$uid, 'user_id' => $uid));
		$data['courselist']   =	$this->user->get_record_by_field_name_all_record('tbl_course','user_id',$uid);
		$data['authors']   =	$this->user->get_record_by_field_name_all_record11('tbl_user',array('role'=>6,'under_provider'=>$user_ins,'status'=>1));
		// echo $this->db->last_query();
		$data['traininglist'] = $this->user->get_record_by_field_name_all_record('tbl_training','user_id',$uid);

		$where = array('user_id'=>$uid,'status'=>1);
		$data['userdetails'] = $this->user->get_record_by_field_name_all_record11('tbl_provider_set_target',$where);
		// echo $this->db->last_query();die;
		$where1 = array('user_id'=>$uid,'status'=>2);
		$data['userdetails1'] = $this->user->get_record_by_field_name_all_record11('tbl_provider_set_target',$where1);

		$this->load->frontAdmin('provider/set_target',$data); 
	}

	public function performance_report()
	{
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		$this->load->frontAdmin('provider/performance_report',$data); 
	}




	public function settarget()
	{ 
		$uid = $this->session->userdata('logged_in')['id']; 
		$profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		$parentid = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['parent_insititution']; 

		if($this->input->post('category_name')=="Course"){
			$data1['course_title'] = ucwords($this->input->post('cource_name'));

			if(empty($this->input->post('author'))){
			   $data1['user_id']      = $uid;
			   $data1['course_for']   = 'p';
			} else {
			   // $data['user_id']      = $uid;
			   $data1['author_reference_id	'] = $uid;
			   $data1['user_id']      	= $this->input->post('author');
			   $data1['course_for']   	= 'a';
			   $data['added_on'] 		= $this->input->post('implementation_date'); 
			}

			$data1['status']       = 3;
    		$courseId = $this->user->save('tbl_course',$data1); 
    		// echo $this->db->last_query();
		}

		if($this->input->post('category_name')=="Training"){
			$data2['title'] 	= ucwords($this->input->post('training_name'));
			$data2['user_id']   = $this->session->userdata('logged_in')['id'];
			$data2['status']    = 0;
			$data2['start_date'] = date('Y-m-d');
			$data2['end_date']   = date('Y-m-d');
    		$courseId = $this->user->save('tbl_training',$data2); 
		}



 		//$array = reset(array_filter($this->input->post('cource_name')));
 		$array = $courseId;
 		// $cname = key($array);
		$data['cource_name']    = $array; 
		$data['user_id']        = $uid; 
		$data['institution_id']	= $parentid; 
		$data['category']       = $this->input->post('category_name'); 
		$data['total_staff']    = $this->input->post('total_staff');
		$data['target_number']  = $this->input->post('target_number');
		$data['status']       	= 1;
		$data['implementation_date'] = $this->input->post('implementation_date'); 
		$data['added_on']     	= date('Y-m-d H:i:s'); 
	
		$result = $this->user->save('tbl_provider_set_target',$data); 
		
		if($result){
			$this->session->set_flashdata('training-name', $data['cource_name']);
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Set Target created successfully.</div>');
			redirect('provider/set_target?id=done');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('provider/set_target');
		}

	}



	public function staff_view($id)
	{
		$wheres = array('id'=>$id,'status'=>1);
		$prof_details = $this->provider_model->get_row_array('tbl_user',$wheres);

		$where = array('profession_name'=>$prof_details['profession'],'status'=>'1');
		$data['unit_staff_list'] = $this->provider_model->get_row_array('tbl_unit_staff',$where);
		$where1 = array('email'=>$prof_details['username_email']);
		$data['staff_date'] = $this->provider_model->get_row_array('tbl_institution_staff',$where1);
		// echo $this->db->last_query();

		$data['previous_certificate'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$id,'archive'=>1,'issue_by'=>'CEonpoint'),'');

		$data['specific'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$id,'category'=>'specific','issue_by'=>'CEonpoint'),'');

		$data['general'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$id,'category'=>'general','issue_by'=>'CEonpoint'),'');
		
		// echo $this->db->last_query();

	 	$sess_id = $id;
		$this->db->select('pl.*,co.id as cid,co.course_title,co.units units,co.passing_marks');
		$this->db->from('tbl_purchase_llis pl');
		$this->db->join('tbl_course co','co.id = pl.item_name');
		$this->db->where('pl.user_id',$sess_id);
		$this->db->where('pl.archive','0');
		$data['purchase_list'] = $this->db->get()->result_array();
		// echo $this->db->last_query();
		$this->db->select('tb.added_on added_on,tb.certificate_id certificate_id,tb.training_seminar_id tid,t.title course_title,t.units units');
		$this->db->from('tbl_training_book tb');
		$this->db->join('tbl_training t','t.id = tb.training_seminar_id');
		$this->db->where('tb.user_id',$sess_id);
		$this->db->where('tb.barcode',"");
		$data['training_list'] = $this->db->get()->result_array();
		

		$this->db->select('e.added_on start_date,e.certificate_id certificate_id,e.category_id category,e.id,co.course_title course_name,co.units units');
		$this->db->from('tbl_exam e');
		$this->db->join('tbl_course co','co.id = e.course_id');
		$this->db->where('e.user_id',$sess_id);
		$this->db->where('e.certificate_id !=',"");
		$data['course_certificate'] = $this->db->get()->result_array();

		$this->db->select('tb.added_on start_date,tb.certificate_id certificate_id,tb.category_id category,tb.id,t.title course_name,t.units units');
		$this->db->from('tbl_training_book tb');
		$this->db->join('tbl_training t','t.id = tb.training_seminar_id');
		$this->db->where('tb.user_id',$sess_id);
		$this->db->where('tb.certificate_id !=',"");
		$data['training_certificate'] = $this->db->get()->result_array();

		
		$this->load->frontAdmin('provider/staff_view',$data);
	}


	public function powerpoint()
	{ 

	  		$training_id     = $this->input->post('training_id'); 
	  		$speaker_id      = $this->input->post('speaker_id'); 
	  		 
	  		//$training_id     = 84; 
	  		//$speaker_id      = 44; 


            $datas = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_speaker_powerpoint',array('training_id'=>$training_id,'speaker_id'=>$speaker_id),'');
			//echo $datas[0]['images'];  
			  
			$explodedData = explode('##', $datas[0]['images']); 
			foreach ($explodedData as $key => $val1) {
			?>

			<div class="col-md-2">
			<div class="img-box">
				<a data-fancybox="images" href="<?php echo ASSETS_URL.'images/uploads/'.$val1; ?>">
				  <img class="img-fluid" src="<?php echo ASSETS_URL.'images/uploads/'.$val1; ?>?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
				<!-- <div class="caption">
					<p>JOne richerd</p>
				</div> -->
				</a>
			</div>
			</div>
		<!-- 	<div class="col-sm-3">
			<div class="banneritem Event-Sponsors">
			<a target="_blank" href="https://ceonpoint.com/assets/images/uploads/<?php echo $val1;?>"><img style="width: 250px; height: 250px;" src="https://ceonpoint.com/assets/images/uploads/<?php echo $val1;?>" alt=""></a>
			</div>
			</div> -->
			<?php 
			} 

	 }

	 	public function viewmypage($id)
	{	$data['profile'] = $this->db->get_where('tbl_user',array('id'=>$id))->row_array();
		$data['review'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_user_review','to_user',$id);

		$currentUser    = $this->user->get_record_by_field_name_all_record('tbl_user','id',$id);
		$data['authors'] = $this->user->get_record_by_field_name_all_record('tbl_user','under_provider',$currentUser[0]['insititution_id']);
        // echo $this->db->last_query(); die;
	 
		$this->db->where('user_id',$id);
		// $this->db->or_where('author_reference_id',$data['authors'][0]['id']);
		$data['allcourse'] = $this->user->seminarlist('tbl_course','status',1,$cat);
        
        $this->db->where('user_id',$id);
		$data['seminar'] = $this->user->get_seminar('tbl_training','status',1,$dt); 
		$data['og_description'] =  'Ceopoint provider profile for '.$data['profile']['name'];
		$data['og_title'] 		=  'Ceopoint provider profile for '.$data['profile']['name'];
		$data['og_image'] 		=  base_url('assets/images/uploads/'.$data['profile']['image']);
		$data['og_url'] 		=  base_url('provider/viewmypage/'.$data['profile']['id']);
		$data['og_type'] 		=  'Provider';
		$this->load->frontAdmin('provider/viewmypage',$data);
	 
	}

	public function accreditation()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['accreditation']  = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		$this->load->frontAdmin('provider/accreditation',$data);
	}
	 
	public function blog_list()
	{
		$uid = $this->session->userdata('logged_in')['id']; 	
		$data['blog']=$this->db->where(array('user_id'=>$uid))->get("tbl_blog")->result_array();
		$this->load->frontAdmin('provider/blog',$data);
	}

	public function blog(){
		$uins = $this->session->userdata('logged_in')['under_insititution'];

		if($this->input->server('REQUEST_METHOD') == 'POST'){
		$this->form_validation->set_rules('country', 'Country', 'trim|required');   
        $this->form_validation->set_rules('title', 'Title', 'trim|required');   
        
		 if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
            $config['upload_path'] = './assets/upload/blog/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
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

		if($this->form_validation->run() == FALSE){	
			redirect('admin/blog');
		}else { 

			$data['title'] 			= $this->input->post('title');   
			$data['country'] 		= $this->input->post('country');   
			$data['image'] 			= $imageName;   
			$data['st_desc'] 	    = $this->input->post('st_desc');   
			$data['des'] 			= $this->input->post('des');   
			$data['user_id'] 		= $this->session->userdata('logged_in')['id'];   
			$data['user_role'] 		= $this->session->userdata('logged_in')['role'];  
			$data['status'] 		= 1;   
			if($uins == 1){
				$data['under_ins'] 		= '1';  
			}else{
				$data['under_ins'] 		= '0';  
			}
			
		    $result = $this->db->insert('tbl_blog',$data); 
			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record added.</div>');
				redirect('provider/blog_list');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/blog_list');
			} 
		}
	}
	else
	{
	// $data['blog']=$this->db->where('status',1)->get("tbl_blog")->result_array();
	$data['country']=$this->db->where(array('status'=>1))->get("countries")->result_array();
	// echo $this->db->last_query();die;
	$this->load->frontAdmin('provider/add_blog',$data);
	}
}


	public function edit_blog($id) {
		$uins = $this->session->userdata('logged_in')['under_insititution'];
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{

		$this->form_validation->set_rules('country', 'Country', 'trim|required');   
        $this->form_validation->set_rules('title', 'Title', 'trim|required');   
        

		 if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
            $config['upload_path'] = './assets/upload/blog/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
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

	 
		if($this->form_validation->run() == FALSE)
		{
			redirect('provider/edit_blog');
		}
		else 
		{ 
			$data['title'] 			= $this->input->post('title');   
			$data['country'] 		= $this->input->post('country');   
		/* 	$data['image'] 			= $imageName;   */ 
			$data['st_desc'] 	    = $this->input->post('st_desc');   
			$data['des'] 			= $this->input->post('des');   
			$data['status'] 		= $this->input->post('status');  
			if($uins == 1){
				$data['under_ins'] 		= '1';  
			}else{
				$data['under_ins'] 		= '0';  
			}

		    $result = $this->user->update('tbl_blog',$data,'id',$id); 
			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record added.</div>');
				redirect('provider/blog_list');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/blog_list');
			} 
		}
	}
	else
	{
	$data['blog']=$this->db->where(array('id'=>$id))->get("tbl_blog")->result_array();
	$data['country']=$this->db->where(array('status'=>1))->get("countries")->result_array();
	// echo $this->db->last_query();die;	
	
	$this->load->frontAdmin('provider/edit_blog',$data);
	}
}


public function blog_delete($id)
{
	$result = $this->db->where('id',$id)->delete("tbl_blog");
	if($result){
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Blog Deleted Successfully!</div>');
		redirect('provider/blog_list');
	} else {
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again!</div>');
		redirect('provider/blog_list');
	} 
	
}

	public function upgradetopro($tid)
	{
		$training_details = $this->user->get_record_by_field_name_all_record('tbl_training','id',$tid);
		// echo'<pre>'; print_r($training_details[0]);die;
		if($training_details[0]['training_type']!=1){
			$data['training_type'] = 1;
			$this->user->update('tbl_training',$data,'id',$tid); 
			$result = true;
		}

			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training Upgraded Successfully.</div>');
				 redirect('provider/training_center_pro/'.$tid);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/training_center_free/'.$tid);
			} 
	}
	
	public function send_to_author()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$logged_in = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
		if($this->input->post('submit') == 'Send Now!'){
			$emails = explode(',', $this->input->post('cepemail'));
			$count = count($emails);

			for($i=0;$i<$count;$i++){
				$data['email']   = $emails[$i];  
				$data['cepname'] = $this->input->post('cepname'); 
				$data['cepcode'] = $this->input->post('cepcode'); 
				$subject = 'CE Provider Code'; 
				$result = $this->sendMail($data['email'],$subject,$this->load->view('email/cepcode_for_author',$data,true));
				if($result){
					$user = $this->db->get_where('tbl_user',array('username_email'=>$data['email']))->row_array();
					if($user){ $userid = $user['id']; }else{ $userid = 0; }
					$notification = array(
					'subject'        	=> $subject, 
					// 'user_id' 			=> $userid,  
					'to' 				=> $userid,  
					'from' 				=> $uid,  
					'message' 			=> $this->load->view('email/cepcode_for_author',$data,true),  
					'status'     		=> 1,
					'added_on'     		=> date('Y-m-d H:i:s')
					); 
					$this->user->save('tbl_notification',$notification);
					if($logged_in['logged_in'] < 2){
					$updalogin['logged_in'] = 2;
					$this->users_model->update('tbl_user',$updalogin,array('status'=>1,'id'=>$uid),'');
					$this->session->set_flashdata('response-author', '<div style="margin-left:-1px;" class="alert alert-success">Mail sent to Author, Please set you annual Target.</div>');
					}
				}
			}

			if($logged_in['under_insititution'] > 0){
				redirect('provider/set_target?id=success');
			}else{
				$this->session->set_flashdata('response-a', '<div style="margin-left:-1px;" class="alert alert-success">Mail sent to Author.</div>');
				redirect('provider/overview?id=success');
			}

		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('provider/set_target');
		}
	}			 

	public function sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE)
	{ 
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
 		if(mail($to, $subject, $message, $headers)){ 
		    return true;
		} else{ 
		    return false;
		}
	}
	public function getstaffunit(){
		$id = $this->input->post('id');
		$result = $this->db->get_where('tbl_unit_staff',array('id'=>$id))->row_array();
		echo (json_encode($result));
	}

	public function unit_staff(){
		$p_id = $this->session->userdata('logged_in')['id'];
		$Profession = explode('-', $this->input->post('profession_id'));
		// $this->form_validation->set_rules('profession_id', 'Profession', 'is_unique[tbl_unit_staff.profession_id]|required');  
		
		if(!$this->input->post())
		{
			$this->session->set_flashdata('staff-response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">This profession already exists!</div>');
			redirect('provider/staffcerecords');
		}
		else 
		{ 
			$valid = $this->db->get_where('tbl_unit_staff',array('profession_id'=> $Profession[0],'added_by'=>$p_id))->row_array();
			// echo count($valid);die;
			if(!empty($valid)){
				$this->session->set_flashdata('staff-response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">This Profession is alredy Exists! </div>');
					redirect('provider/staffcerecords');
			}else{

				$add  = array();
				$add  = array(
					'profession_id'		=> $Profession[0],
					'profession_name'	=> $Profession[1],
					'unit'				=> $this->input->post('units'),
					'gernal_target'		=> $this->input->post('gernal_target'),
					'specific_target'	=> $this->input->post('specific_target'),
					'added_by'			=> $p_id,
					'status'			=> '1',
					'added_on'			=> date('Y-m-d'),
				);
				$result = $this->users_model->save('tbl_unit_staff',$add); 
				if($result){
					$this->session->set_flashdata('staff-response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Staff Unit Successfully Added.</div>');
					 redirect('provider/staffcerecords');
				} else {
					$this->session->set_flashdata('staff-response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
					redirect('provider/staffcerecords');
				} 
			}

		}
	}

	public function edit_unit_staff(){
		$id = $this->input->post('id');
		$update  = array();
		$update  = array(
			'unit'				=> $this->input->post('units'),
			'gernal_target'		=> $this->input->post('gernal_target'),
			'specific_target'	=> $this->input->post('specific_target'),
		);
		$result = $this->users_model->update('tbl_unit_staff',$update,'id',$id); 
		// echo $this->db->last_query();die;
		if($result){
			$this->session->set_flashdata('staff-response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Staff Unit Successfully Updated.</div>');
			 redirect('provider/staffcerecords');
		} else {
			$this->session->set_flashdata('staff-response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('provider/staffcerecords');
		} 

	}

	public function success_staffpayment($uid)
	{
		// echo'<pre>'; print_r($_REQUEST);die;
		// $uid = $this->session->userdata('logged_in')['id'];
		$taxStaff_id = explode('_',$_REQUEST['custom']);
		$num_of_prof = count(explode(',',$_REQUEST['item_number']));
		$add = array(
			'provider_id' 			=> $uid,
			'prof_id'   			=> $_REQUEST['item_number'],
			'num_of_prof'   		=> $num_of_prof,
			// 'staff_id'     		=> $_REQUEST['item_name'],
			'staff_id'     			=> $taxStaff_id[1],
			'tax'     				=> $taxStaff_id[0],
			'amount'        		=> $_REQUEST['payment_gross'],
			'transaction_details'	=> json_encode($_REQUEST),
			'added_on'      		=> date('Y-m-d H:i:s'),
		);
		// echo'<pre>';print_r($add);die;
		$result = $this->user->save('tbl_institution_staff_payment',$add);
		// echo $this->db->last_query();die;

		if($result){
			// $staffIds = $_REQUEST['item_name'];
			$staffIds = $taxStaff_id[1];
			$staffIdsArr = explode(',', $staffIds);
			// print_r($staffIdsArr);die;
			$count = count($staffIdsArr);

			for($i=0; $i<$count; $i++){
				$stid = $staffIdsArr[$i];
				$data2['activated'] 	= 1;
				$this->user->update('tbl_institution_staff',$data2,'id',$stid);
			}

			$this->session->set_flashdata('response-res', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Staff Payment successfully Done.</div>');
			redirect('provider/staffpayment?go='.$result.'');

		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
   	   	  	redirect('provider/staffpayment/'.$uid.'');
			}	
	}

	public function cancel_staffpayment(){	
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable"> Payment Has been canceled ! </div>');
   	   	redirect('provider/staffpayment');
	}

	public function set_registration_limit(){
		$tid = $this->input->post('tid');	
		$limit = $this->input->post('limit');
		$data['registration_limit'] = $limit;
		$this->db->where('id',$tid);
		$result = $this->db->update('tbl_training',$data);
		
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success">Registration limit set successfully.</div>');
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger">Something went wrong. Please try again!!!</div>');
		}	
   	   	redirect('provider/training_center_list');
	}
}
