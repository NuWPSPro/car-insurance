<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institution extends CI_Controller {
  
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
			$uid = $this->session->userdata('logged_in')['id'];
			if($uid==""){
				redirect('users');
			}
			$this->load->model('provider_model');  
			$this->load->model('institution_model','institution');  
			$this->load->model('dashboards_model');
	}

	public function advertisement()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->load->frontAdmin('institution/advertisement',$data);
	}

	
	public function checkcourselogin()
	{
		$courseid = $this->session->userdata('current_course_id');
		if($courseid=="" && $this->uri->segment(3)==""){
		redirect('Institution/overview');
		}
	}  


	public function checkTraininglogin()
	{
		$trid = $this->session->userdata('current_training_id');

		if($trid==""){
			redirect('Institution/upload_information');
		}
	}  



	public function index()
	{
		$this->load->view('Institution/Institution');
	}


	public function editwebpage()
	{
      /*  $where1 = array('role'=>5,'status'=>1);
		$subinstitution1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
		$data['totalSubInstitute'] = sprintf("%02d", count($subinstitution1));
		
		$where3 = array('role'=>5,'status'=>1);
		$authorlist = $this->user->get_record_by_multi_field_name('tbl_user',$where3);
		$data['totalAuthor'] = sprintf("%02d", count($authorlist));
		
		$where4 = array('role'=>1,'status'=>1);
		$professionallist = $this->user->get_record_by_multi_field_name('tbl_user',$where4);
		$data['totalProfessional'] = sprintf("%02d", count($professionallist));
		
		$where2 = array('role'=>2,'parent_insititution'=>$user_id);
        $ceproviderlist = $this->user->get_record_by_multi_field_name('tbl_user',$where2);
        $totalCeProvider = sprintf("%02d", count($ceproviderlist)); */
	   
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$uid = $this->session->userdata('logged_in')['id'];
		if($this->form_validation->run() == FALSE)
		   {
				
				$data['userdata'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
				$this->load->frontAdmin('institution/edit_webpage',$data);
				
		}  else {

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
			$data['backimage'] = $imageName;
			} 
			$data['name']          = $this->input->post('name');
			$data['tag_line']      = $this->input->post('tagline'); 
			$result = $this->user->update('tbl_user',$data,'id',$uid);
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Institution CE Webpage updated successfully.</div>');
				redirect('institution/editwebpage');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('institution/editwebpage');
			}
	  }

 }

	public function settarget()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		// $details = $this->provider_model->get_row_array('tbl_user',array('id'=>$uid));
		$data['ceplist'] 		= $this->institution->getcepUnderIns($uid);
		$data['insititutions'] 	= $this->institution->getsubInstitutions($uid);

		$data['fulldetails'] 	= $this->share->getuser_info($uid,5);
		if($data['fulldetails']['details']->under_insititution==0){ 
			$data['training_date'] 	= $this->institution->get_latest_training_date($uid);
		}else{
			$data['training_date'] 	= $this->institution->get_latest_training_date($data['fulldetails']['details']->parent_insititution);
		}

		if($data['fulldetails']['child_info']){
			$insidArr = array_column($data['fulldetails']['child_info'],'cid');
			array_push($insidArr ,$uid);
		}else{
			$insidArr = array($uid);
		}

		$data['set_target'] 	= $this->institution->get_set_target($insidArr,1);
		$data['archive_set_target'] 	= $this->institution->get_set_target($insidArr,2);
		// print_r($data['training_date']);die;
		$this->load->frontAdmin('institution/settarget',$data);
	}
	 
	public function staff_view($id)
	{ 
		$wheres = array('id'=>$id,'status'=>1);
		$prof_details = $this->provider_model->get_row_array('tbl_user',$wheres);

		$where = array('profession_name'=>$prof_details['profession'],'status'=>'1');
		$data['unit_staff_list'] = $this->provider_model->get_row_array('tbl_unit_staff',$where);
		
		$where1 = array('email'=>$prof_details['username_email']);
		$data['staff_date'] = $this->provider_model->get_row_array('tbl_institution_staff',$where1);

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

		$this->db->select('tb.added_on start_date,tb.certificate_id certificate_id,	tb.id, t.title course_name,	t.units units');
		$this->db->from('tbl_training_book tb');
		$this->db->join('tbl_training t','t.id = tb.training_seminar_id');
		$this->db->where('tb.user_id',$sess_id);
		$this->db->where('tb.certificate_id !=',"");
		$data['training_certificate'] = $this->db->get()->result_array();
		
		$this->load->frontAdmin('institution/staff_view',$data);
	}

	public function subinsititution()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		
		$fulldetails 	= $this->share->getuser_info($uid,5);
		$data['fulldetails'] 	= $fulldetails;

		if($fulldetails['child_info']){
			$insidArr = array_column($fulldetails['child_info'],'cid');
			array_push($insidArr ,$uid);
		}else{
			$insidArr = array($uid);
		}
		
    	$data['sub_ins'] = $fulldetails['child_info'];
		$data['subinss'] = $this->institution->getsubInstitutions($uid);
		$this->load->frontAdmin('institution/sub_insititution',$data);
	}
	
	public function approve($id)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$where1 = array('id'=>$id);
		$userdetail = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
		$data = $userdetail;
		$data['user_name'] = $userdetail[0]['name'];
		// print_r($data['user_name']);die;
		$where = array('status'=>1,'activation_id'=>'');
		$result = $this->user->update('tbl_user',$where,'id',$id);

		$this->sendMail($userdetail[0]['username_email'],'Approval from Instituition',$this->load->view('email/ins_approve',$data,true));
		if($result){
			$user = $this->db->get_where('tbl_user',array('username_email'=>$userdetail[0]['username_email']))->row_array();
				if($user){ $userid = $user['id']; }else{ $userid = 0; }
				$notification = array(
				'subject'        	=> 'Approval from Instituition', 
				// 'user_id' 			=> $userid,  
				'to' 				=> $userid,  
				'from' 				=> $uid,  
				'message' 			=> $this->load->view('email/ins_approve',$data,true),  
				'status'     		=> 1,
				'added_on'     		=> date('Y-m-d H:i:s')
				); 
				$this->user->save('tbl_notification',$notification);
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Status successfully changed.</div>');
			if($userdetail[0]['role']==5){
				redirect('institution/subinsititution');
			}
			if($userdetail[0]['role']==2){
				redirect('institution/ceproviders');
			}
			
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			if($userdetail[0]['role']==5){
				redirect('institution/subinsititution');
			}
			if($userdetail[0]['role']==2){
				redirect('institution/ceproviders');
			}
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

		if(mail($to, $subject, $message, $headers)){ 
		    return true;
		} else{ 
		    return false;
		}
	}


	public function ceproviders()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		
		$fulldetails 	= $this->share->getuser_info($uid,5);

		if($fulldetails['child_info']){
			$insidArr = array_column($fulldetails['child_info'],'cid');
			array_push($insidArr ,$uid);
		}else{
			$insidArr = array($uid);
		}

    	$data['sub_ins'] = $fulldetails['child_info'];
    	$data['ceproviders'] = $this->share->get_provider_under_institution($insidArr);
		// echo '<pre>'; print_r($data);die;
		$this->load->frontAdmin('institution/ceproviders',$data);
	}

	public function stafflicensestatus()
	{
		$this->load->frontAdmin('institution/stafflicensestatus');
	}

	public function mendetorytraining ()
	{
		$this->load->frontAdmin('institution/mendetorytraining');
	}

	public function staffcerecords()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$fulldetails 	= $this->share->getuser_info($uid,5);
		// echo '<pre>'; print_r($fulldetails); die;

		if($fulldetails['child_info']){
			$insidArr = array_column($fulldetails['child_info'],'cid');
			$insArr = array_column($fulldetails['child_info'],'cinsititution_id');
			$cepArr = array_column($fulldetails['cep_info'],'cepid');
			array_push($insidArr ,$uid);
			array_push($insArr ,$fulldetails['details']->insititution_id);
		}else{
			$insidArr = array($uid);
			$insArr   = array($fulldetails['details']->insititution_id);
			$cepArr   = isset($fulldetails['cep_info'])?array_column($fulldetails['cep_info'],'cepid'):0;
		}
		$data['sub_ins'] = $fulldetails['child_info'];
    	$data['ceplist'] = $this->share->get_provider_under_institution($insidArr);
    	$data['staff_list'] = $this->share->get_staff_under_institution($cepArr);
		$this->load->frontAdmin('institution/staffcerecords',$data);
	}

	public function cedepartmentreport()
	{
		$this->load->frontAdmin('institution/cedepartmentreport');
	}	

	public function courcelisting() 
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$fulldetails 	= $this->share->getuser_info($uid,5);
		$data['fulldetails'] 	= $fulldetails;
		if($fulldetails['child_info']){
			$insidArr = array_column($fulldetails['child_info'],'cid');
			array_push($insidArr ,$uid);
			$insArr = array_column($fulldetails['child_info'],'cinsititution_id');
			array_push($insArr ,$fulldetails['details']->insititution_id);
		}else{
			$insidArr = array($uid);
			$insArr = array($fulldetails['details']->insititution_id);
		}
		
		// $user_ins_id = $this->session->userdata('logged_in')['insititution_id'];
		// $data['ceplist'] 		= $this->institution->getcepUnderIns($uid);
		// $data['authorlist'] 	= $this->institution->getauthorUnderCep($data['ceplist'][0]['insititution_id']);

    	$data['ceplist']	   	= $this->share->get_provider_under_institution($insidArr);
		$data['insititutions'] 	= $this->institution->getsubInstitutions($uid);
		$data['authorlist']    	= $this->share->get_author_under_institution($insidArr);
		$data['course_list'] 	= $this->institution->getcourseUnderIns($insArr);
		$this->load->frontAdmin('institution/courcelisting',$data);
	}
	public function autherlisting()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$fulldetails 	= $this->share->getuser_info($uid,5);
		$data['fulldetails'] 	= $fulldetails;

		if($fulldetails['child_info']){
			$insidArr = array_column($fulldetails['child_info'],'cid');
			array_push($insidArr ,$uid);
		}else{
			$insidArr = array($uid);
		}
		$data['sub_ins'] = $fulldetails['child_info'];
    	$data['ceplist']	   = $this->share->get_provider_under_institution($insidArr);
		$data['authorlist']    = $this->share->get_author_under_institution($insidArr);
		$this->load->frontAdmin('institution/autherlisting',$data);
	}

	public function certificate()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$fulldetails 	= $this->share->getuser_info($uid,5);
		
		if($fulldetails['details']->under_insititution==0){ 
			$institutionId = $fulldetails['details']->insititution_id;
			$insuserId = $fulldetails['details']->id;
			if($fulldetails['child_info']){
				$insArr = array_column($fulldetails['child_info'],'cinsititution_id');
				array_push($insArr ,$institutionId);
				$insidArr = array_column($fulldetails['child_info'],'cid');
				array_push($insidArr ,$insuserId);
			}else{
				$insArr = array($institutionId);
				$insidArr = array($insuserId);
			}
		
		}else{
			$pinsid = $this->db->get_where('tbl_user',array('id'=>$uid))->row();
			$pdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$pinsid->parent_insititution); 
			// print_r($pdetails); die;
			$institutionId = $fulldetails['details']->insititution_id;
			$pinstitutionId = $fulldetails['parent_info']['pinsititution_id'];
			$insArr = array($institutionId);
			$insidArr = array($fulldetails['details']->id);
		}
		// $stts=1;
		// $data['category'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',$stts); 
		// $data['adv'] = $this->user->get_record_by_field_name_status('tbl_adv_upload');		
		// $data['countries'] = $this->user->get_countries();
		
		$data['cproviders'] = $this->user->get_record_by_field_name_all_record('tbl_user',array('parent_insititution'=>$uid,'role'=>2),'');
        $where3 = array('role'=>6,'under_provider'=>$data['cproviders'][0]['insititution_id']);
		$data['authorlist'] = $this->user->get_record_by_multi_field_name('tbl_user',$where3);
		$data['insititutions'] = $this->institution->getsubInstitutions($uid);
		
		
		// $filterdata = $this->input->post();
		// if($filterdata['certificatetype']=='oc'){
		// 	$data['coursecertificates'] = $this->institution->getCourseCertificates($filterdata);
		// }elseif($filterdata['certificatetype']=='tc'){
		// 	$data['certificates'] 		= $this->institution->getCertificates($filterdata);
		// }else{
		// 	$data['certificates'] 		= $this->institution->getCertificates($filterdata);
		// 	$data['coursecertificates'] = $this->institution->getCourseCertificates($filterdata);
		// }
		
		$coursecertificates = $this->provider_model->course_certificate_list($insArr);
		$trainingcertificates = $this->provider_model->training_certificate_list($insArr);
		$data['coursecertificates'] = $coursecertificates['data']; 
		$data['certificates'] = $trainingcertificates['data'];
		// echo'<pre>'; print_r($trainingcertificates);
		$this->load->frontAdmin('institution/certificate',$data);
	}

	public function traininglisting()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$fulldetails 	= $this->share->getuser_info($uid,5);
		$data['fulldetails'] 	= $fulldetails;
		if($fulldetails['child_info']){
			$insidArr = array_column($fulldetails['child_info'],'cid');
			array_push($insidArr ,$uid);
			$insArr = array_column($fulldetails['child_info'],'cinsititution_id');
			array_push($insArr ,$fulldetails['details']->insititution_id);
		}else{
			$insidArr = array($uid);
			$insArr = array($fulldetails['details']->insititution_id);
		}
		
    	$data['ceplist']	   	= $this->share->get_provider_under_institution($insidArr);
		$data['insititutions'] 	= $this->institution->getsubInstitutions($uid);
		$data['authorlist']    	= $this->share->get_author_under_institution($insidArr);
		$data['trainin_list'] 	= $this->institution->gettrainingUnderIns($insArr);
		$this->load->frontAdmin('institution/traininglisting',$data);
	}

	public function blog_list()
	{
		$uid = $this->session->userdata('logged_in')['id']; 	
		$data['ceplist'] 		= 	$this->institution->getcepUnderIns($uid);
		$data['insititutions'] 	= 	$this->institution->getsubInstitutions($uid);
		$data['blog']			=	$this->institution->getBlogUnderIns($uid);
		$this->load->frontAdmin('institution/blog_list',$data);
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


	 
		if($this->form_validation->run() == FALSE)
		{	
			
			redirect('institution/blog_list');

		}
		else 
		{ 
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
				redirect('institution/blog_list');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('institution/blog_list');
			} 
		}
	}
	else
	{
	$data['blog']=$this->db->where('status',1)->get("tbl_blog")->result_array();
	$data['country']=$this->db->where(array('status'=>1))->get("countries")->result_array();
	// echo $this->db->last_query();die;
	$this->load->frontAdmin('institution/add_blog',$data);
	}
}


	public function edit_blog($id){	
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


	 
		if($this->form_validation->run() == FALSE)
		{
			redirect('institution/edit_blog');
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
				redirect('institution/blog_list');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('institution/blog_list');
			} 
		}
	}
	else
	{
	$data['blog']=$this->db->where(array('id'=>$id))->get("tbl_blog")->result_array();
	// echo $this->db->last_query();die;	
	$data['country']=$this->db->where(array('status'=>1))->get("countries")->result_array();
	
	$this->load->frontAdmin('institution/edit_blog',$data);
	}
}


public function blog_delete($id)
{
	$result = $this->db->where('id',$id)->delete("tbl_blog");
	if($result){
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Blog Deleted Successfully!</div>');
		redirect('institution/blog_list');
	} else {
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again!</div>');
		redirect('institution/blog_list');
	} 
	
}
	public function saleonline()
	{
		$this->load->frontAdmin('institution/saleonline');
	}

	public function registerstaff()
	{ 
		$uid = $this->session->userdata('logged_in')['id']; 
		$profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		 
 
		$data['staff_name']          = $this->input->post('name'); 
		$data['insititution_id']     = $profile[0]['id'];  
		$data['insititution_code']   = $profile[0]['insititution_id'];  
		$data['status']       		 = 1;
		$data['added_on']    		 = date('Y-m-d'); 


		$result = $this->user->save('tbl_institution_staff',$data); 
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Overview created successfully.</div>');
			redirect('institution/staffcerecords');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('institution/staffcerecords');
		}
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
			
		    
			 
			$this->load->frontAdmin('institution/dashboard',$data);
		
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
				echo '<pre>'; print_r($error); die;                    
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
	
	public function changeproviderstatus(){

		$id          	= $this->input->post('id');
		$role          	= $this->input->post('role');
		$where1 = array('id'=>$id);
		$userdetail = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
		$maildata = $userdetail;
		if($this->input->post('status')==1){
		$data['status'] = $this->input->post('status');
		$data['approval_date'] = date('Y-m-d');
		$data['disabled_by'] = 0;

		}else{
		$data['status'] = $this->input->post('status');
		$data['approval_date'] = date('Y-m-d');
		$data['disabled_by'] = $this->input->post('disabled_by');
		}

		$result = $this->user->update('tbl_user',$data,'id',$id);
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Status updated successfully.</div>');
			if($role == 6){
				redirect('institution/autherlisting');
			}else{
				$this->sendMail($userdetail[0]['username_email'],'Approval from Instituition',$this->load->view('email/ins_approve',$maildata,true));
				redirect('institution/ceproviders');
			}


		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('institution/ceproviders');
			if($role == 6){
				redirect('institution/autherlisting');
			}else{
				$this->sendMail($userdetail[0]['username_email'],'Approval from Instituition',$this->load->view('email/account_deactivation',$maildata,true));
				redirect('institution/ceproviders');
			}
		}

	}

	public function changeInsStatus(){
		$id          	= $this->input->post('id');
		$role          	= $this->input->post('role');
		$disabled_by    = $this->input->post('disabled_by');

		if($this->input->post('status')==1){
			$data['status'] = $this->input->post('status');
			$data['approval_date'] = date('Y-m-d');
			$data['disabled_by'] = 0;
			$data['activation_id'] 	= ''; 
		}else{
			$data['status'] = $this->input->post('status');
			$data['disabled_by'] = $disabled_by;
			$data['activation_id'] 	= ''; 
		}

		$result = $this->user->update('tbl_user',$data,'id',$id);
		$user_info = $this->institution->get_institution_details($id);

		if($result){
			if($this->input->post('status') == 0 ){ 
				$this->sendMail($user_info->username_email,'Account Deactivation',$this->load->view('email/account_deactivation',$user_info,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">User Account Deactivated successfully.</div>');
			} else { 
				$this->sendMail($user_info->username_email,'Account Activation',$this->load->view('email/account_activation',$user_info,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Activated successfully.</div>');
			 }
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect($_SERVER['HTTP_REFERER']);
	}
	     
public function add_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		
		 $data['advertise'] = $this->advertiseads->getAdvertiseAddsList($uid);
             	
		$this->load->frontAdmin('institution/advertise',$data);
		
	}




	public function advertisements()

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
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',1); 
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$this->load->frontAdmin('institution/add_advertise',$data);

	}






	public function purchase_lists()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->db->select('tbl_user.id');
		$providerUnderIns = $this->provider_model->get_result_array('tbl_user',array('role'=>2,'parent_insititution'=>$uid));

		// $count = count($providerUnderIns);
		// for($i=0;$i<$count;$i++){
		// 	$where['provider_id'] = $providerUnderIns[$i];
		// }
			$where = '';
			$data['staff_payment']  = $this->provider_model->get_result_array('tbl_institution_staff_payment',$where);
		// print_r($data['staff_payment']);die;
		// echo $this->db->last_query();
		$this->load->frontAdmin('institution/purchase_list',$data);
	}

	public function showBill()
	{
		$uid 	= $this->session->userdata('logged_in')['id'];
		$urole  = $this->session->userdata('logged_in')['role'];
	   	
	   	$idd =  $this->input->post('idd');
	   	$type =  $this->input->post('type');
	   	// echo $idd.'--'.$type;die;
		if($type=='Staff Payment'){
			$where = array('id'=>$idd);
			$dataArray = $this->provider_model->get_result_array('tbl_institution_staff_payment',$where);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->db->get_where('tbl_user',array('id'=>$dataArray[0]['provider_id']))->row_array();
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
			$returnarray['countries_name'] 	= $uname['address'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
	   	}
	   	$this->load->view('provider/receipt',$data);
	}



public function notification()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
			$this->db->where('to',$uid);
			$data['notification'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_notification','status',1);
			$this->load->frontAdmin('institution/notification',$data);
		}else{  
			$uid = $this->session->userdata('logged_in')['id'];

			$data['subject'] 		= $this->input->post('subject');  
			$data['message'] 		= $this->input->post('message');  
			$data['user_id'] 		= $uid;  
			$data['added_on'] 		= date('y-m-d h:i:s');
			
		    $result = $this->user->save('tbl_notification',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Notification sent.</div>');
				redirect('institution/notification');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('institution/notification');
			} 
		}
	}



 /*   public function tutorials()
	{
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		$data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$this->load->frontAdmin('institution/tutorials',$data);
	} */

 public function tutorials()
	{
		$ins = $this->session->userdata('logged_in')['under_insititution'];
	
		// $data['institutions'] 	= $this->dashboards_model->get_tutorial('institution');
		$data['tutorials'] 		= $this->dashboards_model->get_tutorial('institution');
		$this->load->frontAdmin('institution/tutorials',$data);
	}
	
	public function getTutorialVideo()
	{
		$id = $_POST['id'];
		$this->db->where('id',$id);
		$result = $this->db->get('tbl_tutorial')->row_array();
		echo (json_encode($result));
	}
		
	

    public function terms()
	{
		$data['terms']	= $this->dashboards_model->get_terms('institution');
		$data['totalIncomeProvider'] = $this->provider_model->total_income($this->session->userdata('logged_in')['id'],'total');
		// $data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$this->load->frontAdmin('institution/terms',$data);
	}

	public function enquiry()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('type', 'Type', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
			$this->load->frontAdmin('institution/enquiry',$data);
		
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
				redirect('institution/enquiry');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('institution/enquiry',$data);
			} 
		}
	}

	public function profile()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
		// $this->form_validation->set_rules('profession', 'Profession', 'trim|required'); 
		// $this->form_validation->set_rules('location', 'Location', 'trim|required');  
		// $this->form_validation->set_rules('address', 'Address', 'trim|required'); 

		if($this->form_validation->run() == FALSE)
		{
			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			$ins_code = $data['profile'][0]['parent_insititution'];
			$data['ins_name'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$ins_code);
			$country_code = $data['profile'][0]['country'];
			$data['country_name'] = $this->db->get_where('countries',array('countries_id'=>$country_code))->result_array();
		    
		    $this->load->frontAdmin('institution/profile',$data);
		
		}  else {

			$this->load->library('upload'); 
			$update = array();
			if(isset($_FILES["image"]['name']) && !empty($_FILES["image"]['name'])){
				$config['upload_path'] = './assets/images/uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '200000';
				//$config['max_width']  = '170';
				//$config['max_height']  = '170';        
				$ext = explode('.',$_FILES["image"]["name"]);        
				$imageName = $ext[0].time().'.'.end($ext);
				$config['file_name'] = $imageName;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('image'))
				{
				//echo 'not'.$this->upload->display_errors();
				 $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'<br>Profile image should be width x height( '.$config['max_width'].'X'.$config['max_height'].')</div>');
				  redirect('institution/profile',$data);			
				}else{   
					
					$update['image'] = $imageName;
				}
			}


			if(isset($_FILES["logo"]['name']) && !empty($_FILES["logo"]['name'])){
				$ext="";
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '350';
			$config['max_height']  = '350';        
			$ext = explode('.',$_FILES["logo"]["name"]);        
			$imageName = $ext[0].rand(9,99999999).'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('logo'))
			{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'<br>Logo should be width x height( '.$config['max_width'].'X'.$config['max_height'].')</div>');
			  redirect('institution/profile');		                       
			} 
		    	$update['logo'] = $imageName;
			}
			
          if(isset($_FILES["backimage"]['name']) && !empty($_FILES["backimage"]['name'])){
				$ext="";
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '540';        
			$ext = explode('.',$_FILES["backimage"]["name"]);        
			$imageName = $ext[0].rand(9,99999999).'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('backimage'))
			{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'<br>Background image should be width x height( '.$config['max_width'].'X'.$config['max_height'].')</div>');
			  redirect('institution/profile');	                     
			} 
		    	$update['backimage'] = $imageName;
			}

			$update['name']			= $this->input->post('name');
			// $update['role']    		= $this->input->post('role'); 
			$update['profession'] 	= $this->input->post('profession'); 
			$update['paypal_email'] = $this->input->post('paypal_email'); 
			$update['country']		= $this->input->post('country');  
			$update['address'] 		= $this->input->post('address'); 
			
			$update['accreditation_web'] 		= $this->input->post('website'); 
			 
			$update['fb_url'] 		= $this->input->post('fb_url');  
			$update['state'] 		= $this->input->post('state');  
			$update['city'] 		= $this->input->post('city');  
			$update['street'] 		= $this->input->post('street');  
			$update['representative'] = $this->input->post('representative');  
			$update['position'] 	= $this->input->post('designation');  
			$update['mobile'] 		= $this->input->post('mobile');  
			$update['skype'] 		= $this->input->post('skype');   
				
			// echo '<pre>'; print_r($update); exit;
		    $result = $this->user->update('tbl_user',$update,'id',$uid); 
			
		    // echo $this->db->last_query();
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
				redirect('institution/profile');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('institution/profile');
			} 
		}
	}


	public function settings()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'total');
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('ins_code', 'Institution Code', 'trim|required'); 

			if($this->form_validation->run() == FALSE)
			{
		 		$data['ins_details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
				$this->db->order_by('name','ASC');
				$data['provider_list'] = $this->db->get_where('tbl_user', array('role'=>2,'under_insititution'=>0,'status'=>1))->result_array();
				$this->db->order_by('name','ASC');
				$data['institution_list'] = $this->db->get_where('tbl_user', array('role'=>5,'under_insititution'=>0,'parent_insititution'=>0,'status'=>1))->result_array();
				$this->db->order_by('name','ASC');
				$data['sub_institution_list'] = $this->db->get_where('tbl_user', array('role'=>5,'under_insititution'=>1,'parent_insititution !='=>0,'status'=>1))->result_array();
				$this->load->frontAdmin('institution/settings',$data);

			}else{

			$ins_id = $this->input->post('institution');
			$ins_code = $this->input->post('ins_code');
			$count = $this->db->get_where('tbl_user',array('id'=>$ins_id,'insititution_id'=>$ins_code))->num_rows();
				if($count > 0){
					$update = array('under_provider'=>$this->input->post('ins_code'));
					$result = $this->user->update('tbl_user',$update,'id',$uid);
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">institution successfully updated.</div>');
					redirect('institution/settings');
				}else{
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Wrong Institution Code !!!</div>');
					redirect('institution/settings');
				}
			}
	}


	public function settargetdate()
	{ 
		$uid = $this->session->userdata('logged_in')['id']; 
		$id  = $this->input->post('training_periode_id'); 
		
		if(empty($id)){
			$added['user_id']     		= $uid; 
			$added['added_on']    		= date('Y-m-d h:i:s');
		}
			$added['start_date']  		= $this->input->post('start_date'); 
			$added['end_date']    		= $this->input->post('end_date'); 
			$added['status']      		= 1;
			
		if(!empty($id) && $id > 0){
			$result = $this->user->update('tbl_provider_set_target_date',$added,'id',$id); 
		}else{
			$result = $this->user->save('tbl_provider_set_target_date',$added); 
		}

		if($result){
			$data2['status']   = 2;
			$result = $this->user->update('tbl_provider_set_target',$data2,'institution_id',$uid);

			$this->session->set_flashdata('response-set', '<div class="alert alert-success alert-dismissable text-center"><span>Training Period has been updated successfully.</span><br><span>Start Date :'.$added['start_date'].'<span><br><span>End Date :'.$added['end_date'].' </span></div>');
			redirect('institution/settarget?id=target');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('institution/settarget');
		}
	}

	public function send_to_cep()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$logged_in = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['logged_in'];
		if($this->input->post('submit') == 'Send Now!'){
			$emails = explode(',', $this->input->post('cepemail'));
			$count = count($emails);

			for($i=0;$i<$count;$i++){
				$data['email']   = $emails[$i]; 
				$data['insname'] = $this->input->post('insname'); 
				$data['inscode'] = $this->input->post('inscode'); 
				$data['send_to'] = $this->input->post('send_to'); 
				$subject = 'Institution Code'; 
				$result = $this->sendMail($data['email'],$subject,$this->load->view('email/inscode_for_cep',$data,true));
				// print_r($result);
				$user = $this->db->get_where('tbl_user',array('username_email'=>$data['email']))->row_array();
				if($user){ $userid = $user['id']; }else{ $userid = 0; }
				$notification = array(
				'subject'        	=> $subject, 
				// 'user_id' 			=> $userid,  
				'to' 				=> $userid,  
				'from' 				=> $uid,  
				'message' 			=> $this->load->view('email/inscode_for_cep',$data,true),  
				'status'     		=> 1,
				'added_on'     		=> date('Y-m-d H:i:s')
				); 
				$this->user->save('tbl_notification',$notification);
				if($logged_in < 2){
					$updalogin['logged_in'] = 2;
					$this->user->update('tbl_user',$updalogin,array('status'=>1,'id'=>$uid),'');
				}
			}
			if($result){
				$training_date = $this->user->get_latest_training_date($uid);
				if(empty($training_date)){
					if($this->session->userdata('logged_in')['under_insititution']==0){ 
						redirect('institution/settarget?id=success');
					}else{
						redirect('institution/settarget');
					}
				}else{
					$this->session->set_flashdata('response-set', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Mail sent successfully.</div>');

					if($this->session->userdata('logged_in')['under_insititution']==0){ 
						redirect('institution/settarget?id=target');
					}else{
						redirect('institution/settarget');
					}
				}
			}else{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Mail not sent, please try again.</div>');
			redirect('institution/settarget');	
			}
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error, please try again.</div>');
			redirect('institution/settarget');
		}
	}			 

}
?>