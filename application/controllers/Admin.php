<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class Admin extends CI_Controller {
	
   public function  __construct()
    {
        parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->model('Users_model','users_model'); 
		$this->load->model('Ice_subscription_model','ice_model'); 
		$this->load->model('dashboards_model'); 
		$this->load->model('Dashboards_model'); 
		$this->load->model('provider_model'); 
		 
		$this->load->model('professional_model'); 
		$this->load->model('advertise_model'); 
		$this->load->model('accreditationapi_model','accapi');
		$this->load->library('pagination');
		//$this->load->model('admin/categories_model');
   		$this->checklogin(10);
    }

  	public function checklogin($id){
  		if($id != $this->session->userdata('logged_in')['role']){
  			redirect('users');
  		}
  	}

	public function index(){
		$this->load->front('admin/admin');
	}

	public function dashboard(){ 
		//ini_set('display_startup_errors', 1);
		// ini_set('display_errors', 1);
		//error_reporting(-1); 
		
		$uid = (isset($_REQUEST['users']))?$_REQUEST['users']:'';
		//echo 'test'; exit;		
		$profession    = "";
		$data['users'] = $this->user->get_users_by_role_profession('2',$profession);
		$report_type   = (isset($_REQUEST['otri']))?$_REQUEST['otri']:'';
		
		if($report_type != 1){ 	
		//$uid = $this->session->userdata('logged_in')['id'];		
		$data['today'] = $this->user->dashboard_income_report('today','');
		$data['month'] = $this->user->dashboard_income_report('month','');
		$data['year']  = $this->user->dashboard_income_report('year','');
		$data['total'] = $this->user->dashboard_income_report('total',''); 
		$data['adstoday'] = $this->user->get_ads_report('today',$uid);
		$data['adsmonth'] = $this->user->get_ads_report('month',$uid);
		$data['adsyear']  = $this->user->get_ads_report('year',$uid);
		$data['adstotal'] = $this->user->get_ads_report('total',$uid);		
		//$this->load->frontAdmin('provider/income_report',$data);
		//$this->load->frontAdmin('admin/dashboard',$data); 
	  } else {
	  
	  	$uid = $this->session->userdata('logged_in')['id'];		
		$data['today'] = $this->user->get_report1('today',$uid);
		$data['month'] = $this->user->get_report1('month',$uid);
		$data['year']  = $this->user->get_report1('year',$uid);
		$data['total'] = $this->user->get_report1('total',$uid);
		//$this->load->frontAdmin('provider/income_report_otri',$data);
	  }
			
		/* $data['advs'] 		= $this->dashboards_model->advs();
		$data['tmss'] 		= $this->dashboards_model->tmss();
		$data['courses'] 	= $this->dashboards_model->courses();
		$data['promotions'] = $this->dashboards_model->promotions();
		$data['trainings'] 	= $this->dashboards_model->certificate(); */
		
		if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Filter"){
			$country_id = $_REQUEST['countrylist'];
			$role 		= $_REQUEST['role'];
			$users 		= $_REQUEST['users'];
			$day 		= $_REQUEST['day'];
			$month 		= $_REQUEST['month'];
			$year 		= $_REQUEST['year'];
			$data['advs'] 			= $this->dashboards_model->advs($country_id,$role,$users,$month,$year,$day);
			// $data['tmss'] 			= $this->dashboards_model->tmss($country_id,$role,$users,$month,$year,$day);
			$data['tmss'] 			= $this->dashboards_model->tmstraining_publish($country_id,$role,$users,$month,$year,$day);
			$data['courses'] 		= $this->dashboards_model->courses($country_id,$role,$users,$month,$year,$day);
			$data['promotionscp'] 	= $this->dashboards_model->promotionscp($country_id,$role,$users,$month,$year,$day);
			$data['promotionstp'] 	= $this->dashboards_model->promotionstp($country_id,$role,$users,$month,$year,$day);
			$data['promotion'] 		= $this->dashboards_model->promotionUser($country_id,$role,$users,$month,$year,$day);
			$data['certificate'] 	= $this->dashboards_model->certificate($country_id,$role,$users,$month,$year,$day);
			$data['pcems']       	= $this->dashboards_model->pcems($country_id,$role,$users,$month,$year,$day);
			$data['staff']       	= $this->dashboards_model->staff($country_id,$role,$users,$month,$year,$day);
			$data['rboard']       	= $this->dashboards_model->rboard($country_id,$role,$users,$month,$year,$day);
		}else{
			$data['advs'] 			= $this->dashboards_model->advs('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			// $data['tmss'] 			= $this->dashboards_model->tmss('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			$data['tmss'] 			= $this->dashboards_model->tmstraining_publish('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			$data['courses'] 		= $this->dashboards_model->courses('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			$data['promotionscp'] 	= $this->dashboards_model->promotionscp('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			$data['promotionstp'] 	= $this->dashboards_model->promotionstp('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			$data['promotion'] 		= $this->dashboards_model->promotionUser('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			$data['certificate'] 	= $this->dashboards_model->certificate('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			$data['pcems']      	= $this->dashboards_model->pcems('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			$data['staff']      	= $this->dashboards_model->staff('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
			$data['rboard']      	= $this->dashboards_model->rboard('','','',$_REQUEST['month'],$_REQUEST['year'],$day);
		}
		// echo'<pre>'; print_r($data['staff']);
		
		$data['parameter'] 	= $this->input->post();
		// echo'nk';print_r($data['tmspublish']); die;
		$this->load->frontAdmin('admin/dashboard',$data); 
	}

	/* public function incomeReportFilter()
	{
		if(isset($_REQUEST['submit'])){
				
		print_r($this->input->post());
		$user_id = $this->input->post('users');
		$role_id = $this->input->post('role');
		$country_id = $this->input->post('countrylist');
		/* $month = $this->input->post('month');
		$year = $this->input->post('year'); 
		$date = $this->input->post('date'); 		
		/* $strtdate = $date.'-'.$month.'-'.'01';
		$enddate  = $date.'-'.$month.'-'.'31';

			/* $this->db->select('tbl_user.name,tbl_user.role,tbl_user.profession,tbl_user.country,tbl_user.location,
			tbl_user.country,tbl_adv_package_purchased.*,tbl_purchase_llis.*'); 
			$this->db->select('*');
			$this->db->from('tbl_user');
			$this->db->join('tbl_adv_package_purchased','tbl_user.id = tbl_adv_package_purchased.user_id');
			$this->db->join('tbl_purchase_llis','tbl_user.id = tbl_purchase_llis.user_id');
			if(!empty($user_id)){$this->db->where('tbl_user.id',$user_id);}
			if(!empty($role_id)){$this->db->where('tbl_user.role',$role_id);}
			if(!empty($country_id)){$this->db->where('tbl_user.location',$country_id);}
			if(!empty($date)){$this->db->where('tbl_adv_package_purchased.purchased_on',$date);}
							  /* $this->db->where('tbl_adv_package_purchased.purchased_on',$enddate); 
			
			$query = $this->db->get();
			
			$data['filter'] = $query->result_array(); 
			
			//print_r($data.'nk'); 
		}
		else{
			$this->db->from('tbl_purchase_llis');
			$query = $this->db->get();
			$data['filter'] = $query->result_array(); 
			
			$this->db->from('tbl_adv_package_purchased');
			$query = $this->db->get();
			$data['filters'] = $query->result_array();
		}
		
 	     $this->load->frontAdmin('admin/dashboard',$data); 
		
	} */
	public function training_income(){
		
		$data['country']=$this->db->where('status',1)->get("countries")->result_array();
		$data['training_cep'] = $this->dashboards_model->get_all_training_income('cep');
		$data['training_ins'] = $this->dashboards_model->get_all_training_income('ins');
		$this->load->frontAdmin('admin/training_income',$data);
	}

	public function user_listing()
	{
			$data['country'] = $_GET['country'];
			// print_r(date('Y-m'));exit;
			$data['added_on'] = $_GET['date'];
			$data['added_on'] = $_GET['month'];
			$data['added_on'] = $_GET['year'];
		// print_r($data);die;
			$data['searchlist'] = $this->user->get_all_search($data); 
			// print_r($data['searchlist']);
			return redirect('admin/users'); 
			
	}

	public function ads_income_report()
	{ 

		$uid = $_REQUEST['users']; 

		$profession    = "";
		$data['users'] = $this->user->get_users_by_role_profession('2',$profession);


	  $report_type = $_REQUEST['otri'];
		
	  if($report_type != 1){
	  
		//$uid = $this->session->userdata('logged_in')['id'];		
	
		
		$data['today'] = $this->user->get_ads_report('today',$uid);
		$data['month'] = $this->user->get_ads_report('month',$uid);
		$data['year']  = $this->user->get_ads_report('year',$uid);
		$data['total'] = $this->user->get_ads_report('total',$uid);
	
		//$this->load->frontAdmin('provider/income_report',$data);
		$this->load->frontAdmin('admin/ads_incom_reoport',$data); 
	  } else {
	  
		$data['today'] = $this->user->get_ads_report('today',$uid);
		$data['month'] = $this->user->get_ads_report('month',$uid);
		$data['year']  = $this->user->get_ads_report('year',$uid);
		$data['total'] = $this->user->get_ads_report('total',$uid);
		//$this->load->frontAdmin('provider/income_report_otri',$data);
 	     $this->load->frontAdmin('admin/ads_incom_reoport'); 
	  }
		
	}

	public function filteruser($id)
	{ 
		$data= $this->db->get_where('tbl_user',array('role'=>$id))->result_array();
		  $res.="<option value=''>Select user</option>";
		foreach ($data as  $value) {
		
		 $res.="<option value=".$value['id'].">".$value['name']."</option>";

		}

		echo $res;

	}
	
	public function users()
	{ 
       if(isset($_POST['submit'])){
			$this->db->from('tbl_user'); 
			$this->db->where('role !=',10);
			$this->db->where('soft_delete','n');
			if($_POST['country']!='')
			{
				$this->db->where('country',$_POST['country']);
				$data['filter_country']=$_POST['country'];
			}
			if($_POST['date']!='')
			{
				$this->db->where('added_on',$_POST['date']);
				$data['filter_date']=$_POST['date'];
			}
			$query = $this->db->get();
			$data['users'] = $query->result_array(); 
			$data['country'] = $this->user->get_countries();
			$this->load->frontAdmin('admin/users',$data); 
		}else{
			$this->db->where('soft_delete','n');
			$this->db->where('role !=',10);
			$data['users'] = $this->user->get_users();
			$data['country'] = $this->user->get_countries();
			// echo'<pre>';print_r($data['users']);exit;
			$this->load->frontAdmin('admin/users',$data); 
		}
	}

	public function authors()
	{ 
       if(isset($_POST['submit'])){
				// $this->db->select('');
				$this->db->from('tbl_user'); 
			  
				if($_POST['country']!='')
				{
					$this->db->where('country',$_POST['country']);
					$data['filter_country']=$_POST['country'];
				}
				if($_POST['date']!='')
				{
					$this->db->where('added_on',$_POST['date']);
					$data['filter_date']=$_POST['date'];
				}
				
				if($_POST['role']!='')
				{
					$this->db->where('role',$_POST['role']);
					
				}
				
				$query = $this->db->get();
				$data['users'] = $query->result_array(); 
				$data['country'] = $this->user->get_countries();
				$this->load->frontAdmin('admin/users',$data); 
		}else
		{
			$data['users'] = $this->user->get_users();
			$data['country'] = $this->user->get_countries();
			// echo'<pre>';print_r($data['users']);exit;
			$this->load->frontAdmin('admin/authors',$data); 
		}
	}

	


	public function professional($profession=false)
	{ 
		$filter['profession'] =  urldecode($profession);
		$data['country'] = $this->user->get_countries();
		if($_REQUEST['filter']){
			$filter['filter'] = $_REQUEST['filter'];
		}else{
			$filter['filter'] = '';
		}
		// $data['users'] = $this->user->get_users_by_role_profession('1',$profession);
		$data['users'] = $this->dashboards_model->get_all_professionals($filter);
		$this->load->frontAdmin('admin/professional',$data); 
	}



	public function insititution($profession=false)
	{ 
		$profession =  urldecode($profession);
		$data['country'] = $this->user->get_countries();
		$this->db->order_by('id','DESC');
		$data['users'] = $this->user->get_users_by_role_profession('5',$profession);
		$this->load->frontAdmin('admin/insititution',$data); 
	}


	public function provider_isting($profession=false)
	{ 
		$profession 	 =  urldecode($profession);
		$data['country'] = $this->user->get_countries();
		$this->db->order_by('id','DESC');
		$data['users'] 	 = $this->user->get_users_by_role_profession('2',$profession);
		$this->load->frontAdmin('admin/provider_isting',$data); 
	}

	public function rboard($profession=false)
	{ 
		$profession =  urldecode($profession);
		$data['country'] = $this->user->get_countries();
		$this->db->order_by('id','DESC');
		$data['users'] = $this->user->get_users_by_role_profession('7',$profession);
		$this->load->frontAdmin('admin/rboard_listing',$data); 
	}
	
	public function advertisers($profession=false)
	{ 
		$profession =  urldecode($profession);
		$data['country'] = $this->user->get_countries();
		$this->db->order_by('id','DESC');
		$data['users'] = $this->user->get_users_by_role_profession('4',$profession);
		$this->load->frontAdmin('admin/advertiser_isting',$data); 
	}


public function promoted_professional()
	{ 
		$data['users'] = $this->user->get_users_by_role('1');

		$data['country'] = $this->user->get_countries();
		$data['pp'] = $this->user->get_record_by_field_name_all_record('tbl_professionals','status',1); 
		//echo '<pre>'; print_r($data); die;
		$this->load->frontAdmin('admin/promoted_professional',$data); 
	}

 	public function deletecourse($id){
		// $result = $this->user->delete('tbl_course','id',$id); 
		$id 	= $this->input->post('id');
		$name 	= $this->input->post('name');
		$email 	= $this->input->post('email');  
		$adminid = $this->session->userdata('logged_in')['id'];	 
		$data['status'] 	 = 0; 
		$data['disabled_by'] = $adminid; 
		$data['soft_delete'] = 'y'; 
		$result = $this->user->update('tbl_course',$data,'id',$id); 
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Course deleted.</div>');
			redirect('admin/course_listing');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('admin/course_listing');
		} 
	}

	public function deletetraining($id){
		// $result = $this->user->delete('tbl_training','id',$id);
		$id 	= $this->input->post('id');
		$name 	= $this->input->post('name');
		$email 	= $this->input->post('email');  
		$adminid = $this->session->userdata('logged_in')['id'];	 
		$data['status'] 	 = 0; 
		$data['disabled_by'] = $adminid; 
		$data['soft_delete'] = 'y'; 
		$result = $this->user->update('tbl_training',$data,'id',$id);  
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training deleted.</div>');
			redirect('admin/course_listing');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('admin/course_listing');
		} 
	}
 
 	public function delete_category($id)
	{
	 
		$result = $this->user->delete('tbl_category','id',$id); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Category deleted.</div>');
				redirect('admin/category');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/category');
			} 

	}
	
	public function delete_category_institution($id)
	{
	 
		$result = $this->user->delete('tbl_category_institution','id',$id); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Category deleted.</div>');
				redirect('admin/institution_category');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/institution_category');
			} 

	}


	public function category_edit($id)
	{

		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('cat_name', 'Category', 'trim|required');  
		$this->form_validation->set_rules('target_units', 'Target Units', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$data['category'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category','id',$id);
		$this->load->frontAdmin('admin/edit_category',$data);

		}  else { 
			$data['cat_name'] 			= $this->input->post('cat_name');   
			$data['target_units'] 			= $this->input->post('target_units');      
		//	print_r($data); echo $id; die;
		    $result = $this->user->update('tbl_category',$data,'id',$id); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Category updated.</div>');
				redirect('admin/category');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/category');
			} 
		}
	}
	
	public function category_institution_edit($id)
	{

		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('cat_name', 'Category', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$data['category'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category_institution','id',$id);
		$this->load->frontAdmin('admin/edit_category_institution',$data);

		}  else { 
			$data['cat_name'] 			= $this->input->post('cat_name');   
		//	print_r($data); echo $id; die;
		    $result = $this->user->update('tbl_category_institution',$data,'id',$id); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Category updated.</div>');
				redirect('admin/institution_category');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/institution_category');
			} 
		}
	}

 
	public function category()
	{

		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('cat_name', 'Category', 'trim|required|is_unique[tbl_category.cat_name]');  
		$this->form_validation->set_rules('target_units', 'Target Units', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$stts=1;
			$data['category'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',$stts); 
			$this->load->frontAdmin('admin/category',$data);

		}  else { 
			$data['cat_name'] 			= $this->input->post('cat_name');   
			$data['target_units'] 			= $this->input->post('target_units');   
			$data['status'] 			= 1;   
		    $result = $this->user->save('tbl_category',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Category added.</div>');
				redirect('admin/category');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/category');
			} 
		}
	}
	
	public function institution_category()
	{
        $uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('cat_name', 'Category', 'trim|required|is_unique[tbl_category_institution.cat_name]');

	 
		if($this->form_validation->run() == FALSE)
		{
			$stts=1;
			$data['category'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category_institution','status',$stts); 
			$this->load->frontAdmin('admin/institution-category',$data);

		}  else { 
			$data['cat_name'] 			= $this->input->post('cat_name');
			$data['status'] 			= 1;   
		    $result = $this->user->save('tbl_category_institution',$data); 
		    //echo $this->db->last_query(); die;
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Category added.</div>');
				redirect('admin/institution_category');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/institution_category');
			} 
		}
        //$this->load->frontAdmin('admin/institution-category');
	}

	public function getTermCondition(){
		$term = $this->input->post('tandc');
		if($term = 'ceon'){ $type = 'authorCeonpoint'; }
		elseif($term = 'cpd'){ $type = 'authorBusiness'; }
		elseif($term = 'tdept'){ $type = 'authorInstitution'; }
		else{ $term = ''; }
		$data = $this->dashboards_model->get_terms($type);
		echo $this->db->last_query();
		// echo json_encode($data);
	}

	public function terms()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['professionals'] 		= $this->dashboards_model->get_terms('professional');
		$data['authorCeonpoint'] 	= $this->dashboards_model->get_terms('authorCeonpoint');
		$data['authorBusiness'] 	= $this->dashboards_model->get_terms('authorBusiness');
		$data['authorInstitution'] 	= $this->dashboards_model->get_terms('authorInstitution');
		$data['cepBusiness'] 		= $this->dashboards_model->get_terms('cepBusiness');
		$data['cepInstitutions']	= $this->dashboards_model->get_terms('cepInstitution');
		$data['institutions'] 		= $this->dashboards_model->get_terms('institution');
		$data['advertiser'] 		= $this->dashboards_model->get_terms('advertiser');
		$data['rboard'] 			= $this->dashboards_model->get_terms('rboard');
		$data['tutorials'] 			= $this->dashboards_model->get_terms();
		$this->load->frontAdmin('admin/terms',$data);
	}

	public function editTerms()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_rules('title', 'Title', 'trim|required');  
		$this->form_validation->set_rules('discription', 'Description', 'trim|required');  
			 
		if($this->form_validation->run() == FALSE){
			$data['professionals'] 		= $this->dashboards_model->get_terms('professional');
			$data['authorCeonpoint'] 	= $this->dashboards_model->get_terms('authorCeonpoint');
			$data['authorBusiness'] 	= $this->dashboards_model->get_terms('authorBusiness');
			$data['authorInstitution'] 	= $this->dashboards_model->get_terms('authorInstitution');
			$data['cepBusiness'] 		= $this->dashboards_model->get_terms('cepBusiness');
			$data['cepInstitutions']	= $this->dashboards_model->get_terms('cepInstitution');
			$data['institutions'] 		= $this->dashboards_model->get_terms('institution');
			$data['advertiser'] 		= $this->dashboards_model->get_terms('advertiser');
			$data['tutorials'] 			= $this->dashboards_model->get_terms();
			$this->load->frontAdmin('admin/terms',$data);
		}else{
			// print_r($this->input->post());die;
			$id = $this->input->post('id');
			$update = array(
				'title'			=>  $this->input->post('title'),
				'discription'	=>  $this->input->post('discription'),
				'type'			=>  $this->input->post('type'),
				'status'		=>  $this->input->post('status'),
				'updated_at'	=>  date('Y-m-d')
			);

			$result = $this->user->update('tbl_terms_conditions',$update,'id',$id);
			if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Terms Updated successfully.</div>');
				redirect('admin/terms');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/terms');
			}
		}
		
	}

	public function setting()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		// $this->form_validation->set_rules('video', 'Video', 'trim|required'); 
		// $this->form_validation->set_rules('terms', 'Terms', 'trim|required');  
		$this->form_validation->set_rules('percentage', 'Percentage', 'trim|required');  
		$this->form_validation->set_rules('unit', 'Units', 'trim|required');  
		// $this->form_validation->set_rules('pvideo', 'Professional Video', 'trim|required');  
		// $this->form_validation->set_rules('pterms', 'Professional Terms', 'trim|required');  

		$this->form_validation->set_rules('template_price', 'Template Price', 'trim|required');  
		// $this->form_validation->set_rules('price_certificate', 'Price Certificate', 'trim|required');  
		// $this->form_validation->set_rules('training_publish_price', 'Training Publish Price', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$data['misc'] = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
			$this->load->frontAdmin('admin/setting',$data);
		
		}  else {  
			// $data['video'] 					= $this->input->post('video');  
			// $data['terms'] 					= $this->input->post('terms');
			$data['target_unit'] 			= $this->input->post('unit');
			$data['set_percentage'] 		= $this->input->post('percentage');
			// $data['professional_video'] 	= $this->input->post('pvideo');
			// $data['professional_terms'] 	= $this->input->post('pterms');
			$data['portfolio_video_price'] 	= $this->input->post('portfolio_video_price');

			$data['template_price'] 		= $this->input->post('template_price');
			// $data['price_certificate'] 		= $this->input->post('price_certificate');
			// $data['training_publish_price'] = $this->input->post('training_publish_price');


		    $result = $this->user->update('tbl_misc',$data,'id',1); 
			// echo $this->db->last_query();die;
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Information Updated.</div>');
				redirect('admin/setting');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/setting');
			} 
		}
	}


    public function daily_promoted_price()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		// $this->form_validation->set_rules('provider_daily_price', 'Provider Daily Price', 'trim|required');  
  //       $this->form_validation->set_rules('training_daily_price', 'Training Daily Price', 'trim|required');  
  //       $this->form_validation->set_rules('courses_daily_price', 'Courses Daily Price', 'trim|required');  
  //       $this->form_validation->set_rules('professional_daily_price', 'Professional Daily Price', 'trim|required');  
        // $this->form_validation->set_rules('proimage', 'image', 'required');  
		// if($this->form_validation->run() == FALSE)
		// {

	 
		if($this->input->post('submit') != 'submit')
		{

			$data['misc'] = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
			$this->load->frontAdmin('admin/daily_promoted_price',$data);
		
		}  else {  	
			$base_folder = FCPATH;
			$this->load->library('upload');

			// $upload_folder = $base_folder."assets/images/upload/";
			if(isset($_FILES["providerimage"]) && !empty($_FILES["providerimage"]['name']))
			{
				$config['upload_path'] = $base_folder.'/assets/images/uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '200000';
				$config['max_width']  = '15000';
				$config['max_height']  = '8000';        
				$ext1 = explode('.',$_FILES["providerimage"]["name"]);        
				$imageName1 = 'PRO_'.time().'.'.end($ext1);
				$config['file_name'] = $imageName1;
					$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('providerimage'))
				{
					$error = array('error' => $this->upload->display_errors());                     
				}  
					$data['image']  = $imageName1;
			}

			if(isset($_FILES["trainingimage"]) && !empty($_FILES["trainingimage"]['name']))
			{
				$config1['upload_path'] = $base_folder.'/assets/images/uploads/';
				$config1['allowed_types'] = 'gif|jpg|png|jpeg';
				$config1['max_size'] = '200000';
				$config1['max_width']  = '15000';
				$config1['max_height']  = '8000';        
				$ext2 = explode('.',$_FILES["trainingimage"]["name"]);        
				$imageName2 = 'TRA_'.time().'.'.end($ext2);
				$config1['file_name'] = $imageName2;
					$this->upload->initialize($config1);
				if ( ! $this->upload->do_upload('trainingimage'))
				{
					$error = array('error' => $this->upload->display_errors());                     
				}  
					$data['trainingimage']  = $imageName2;
			}

			if(isset($_FILES["coursesimage"]) && !empty($_FILES["coursesimage"]['name']))
			{
				$config2['upload_path'] = $base_folder.'/assets/images/uploads/';
				$config2['allowed_types'] = 'gif|jpg|png|jpeg';
				$config2['max_size'] = '200000';
				$config2['max_width']  = '15000';
				$config2['max_height']  = '8000';        
				$ext3 = explode('.',$_FILES["coursesimage"]["name"]);        
				$imageName3 = 'COR_'.time().'.'.end($ext3);
				$config2['file_name'] = $imageName3;
					$this->upload->initialize($config2);
				if ( ! $this->upload->do_upload('coursesimage'))
				{
					$error = array('error' => $this->upload->display_errors());                     
				}  
					$data['coursesimage']  = $imageName3;
			}

			if(isset($_FILES["professionalimage"]) && !empty($_FILES["professionalimage"]['name']))
			{
				$config3['upload_path'] = $base_folder.'/assets/images/uploads/';
				$config3['allowed_types'] = 'gif|jpg|png|jpeg';
				$config3['max_size'] = '200000';
				$config3['max_width']  = '15000';
				$config3['max_height']  = '8000';        
				$ext4 = explode('.',$_FILES["professionalimage"]["name"]);        
				$imageName4 = 'PROF_'.time().'.'.end($ext4);
				$config3['file_name'] = $imageName4;
					$this->upload->initialize($config3);
				if ( ! $this->upload->do_upload('professionalimage'))
				{
					$error = array('error' => $this->upload->display_errors());                     
				}  
					$data['professionalimage']  = $imageName4;
			}
			// print_r($imageName1.'<br>'.$imageName2.'<br>'.$imageName3.'<br>'.$imageName4);
			if(!empty($this->input->post('provider_daily_price'))){
			$data['total_amount'] 		= $this->input->post('provider_daily_price');  
			$data['base_price'] 		= $this->input->post('provider_base_price');  
			$data['tax_percentage'] 	= $this->input->post('tax_on_provider');  
			$data['text'] 				= $this->input->post('text_provider');  
			$data['tax_amount'] 		= $this->input->post('taxamount_on_provider'); 
			$result = $this->user->update('tbl_all_tax',$data,'id',1); 
			// echo $this->db->last_query();die; 
			}

			if(!empty($this->input->post('training_daily_price'))){
			$data['total_amount'] 		= $this->input->post('training_daily_price');
			$data['base_price'] 		= $this->input->post('training_base_price');  
			$data['tax_percentage'] 	= $this->input->post('tax_on_training');  
			$data['text'] 				= $this->input->post('text_training');  
			$data['tax_amount'] 		= $this->input->post('taxamount_on_training'); 
			$result = $this->user->update('tbl_all_tax',$data,'id',2); 
			}

			if(!empty($this->input->post('courses_daily_price'))){
			$data['total_amount'] 		= $this->input->post('courses_daily_price');
			$data['base_price'] 		= $this->input->post('course_base_price');  
			$data['tax_percentage'] 	= $this->input->post('tax_on_course');  
			$data['text'] 				= $this->input->post('text_course');  
			$data['tax_amount'] 		= $this->input->post('taxamount_on_course'); 
			$result = $this->user->update('tbl_all_tax',$data,'id',3); 
			}

			if(!empty($this->input->post('professional_daily_price'))){
			$data['total_amount'] 		= $this->input->post('professional_daily_price');
			$data['base_price'] 		= $this->input->post('prof_base_price');  
			$data['tax_percentage'] 	= $this->input->post('tax_on_professional');  
			$data['text'] 				= $this->input->post('text_professional');  
			$data['tax_amount'] 		= $this->input->post('taxamount_on_professional'); 
			$result = $this->user->update('tbl_all_tax',$data,'id',4); 
			}
		    // $result = $this->user->update('tbl_misc',$data,'id',1); 
			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Daily price updated.</div>');
				$data['misc'] = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
				$this->load->frontAdmin('admin/daily_promoted_price',$data);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				$data['misc'] = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
				$this->load->frontAdmin('admin/daily_promoted_price',$data);
			} 
		}
	}
 
	public function staff_fee(){
		$data['total_amount'] 		= $this->input->post('total_amount');
		$data['base_price'] 		= $this->input->post('base_price');  
		$data['tax_percentage'] 	= $this->input->post('tax_percentage');    
		$data['tax_amount'] 		= $this->input->post('tax_amount'); 
		$result = $this->user->update('tbl_all_tax',$data,'id',5); 
		
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Staff Activation Fee Updated.</div>');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect('admin/setting');
	}

	public function tmstemplate_fee(){
		$data['total_amount'] 		= $this->input->post('total_amount');
		$data['base_price'] 		= $this->input->post('base_price');  
		$data['tax_percentage'] 	= $this->input->post('tax_percentage');    
		$data['tax_amount'] 		= $this->input->post('tax_amount'); 
		$result = $this->user->update('tbl_all_tax',$data,'id',6); 
		
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">TMS Pro Template Fee Updated.</div>');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect('admin/setting');
	}

	public function price_certificate_fee(){
		$data['total_amount'] 		= $this->input->post('total_amount');
		$data['base_price'] 		= $this->input->post('base_price');  
		$data['tax_percentage'] 	= $this->input->post('tax_percentage');    
		$data['tax_amount'] 		= $this->input->post('tax_amount'); 
		$result = $this->user->update('tbl_all_tax',$data,'id',7); 
		
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Price Certificate Fee Updated.</div>');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect('admin/setting');
	}


	public function notification()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$data['notification'] = $this->user->get_notification();
			$this->load->frontAdmin('admin/notification',$data);
		
		}  else {  

			$uid = $this->session->userdata('logged_in')['id'];

			$data['subject'] 		= $this->input->post('subject');  
			$data['message'] 		= $this->input->post('message');  
			$data['user_id'] 		= $uid;  
			$data['added_on'] 		= date('y-m-d h:i:s');
			
		    $result = $this->user->save('tbl_notification',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Notification sent.</div>');
				redirect('admin/notification');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/notification');
			} 
		}
	}
	public function enquiry(){		
		$data['enquiry'] = $this->user->get_enquiry();
		$this->load->frontAdmin('admin/enquiry',$data);	
	}
	public function professionalplan()
	{
		$this->load->model('professional_model'); 
		$data['planlistingArr'] = $this->professional_model->planlisting();
		
		$this->load->frontAdmin('admin/professional_plan',$data);
	}
	public function professionalplan_edit($planid)
	{
		$this->load->model('professional_model'); 	
		if($_POST){
			//echo '<pre>'; print_r($_POST); exit;	
			$planupdate = array(
				'pro_package_name' 		=> $_POST['pro_package_name'],
				'tax' 					=> $_POST['tax_amount'],
				'base_price' 			=> $_POST['base_price'],
				'pro_package_amount' 	=> $_POST['pro_package_amount'],
				'pro_plan_type' 		=> $_POST['pro_plan_type'],
				'pro_plan_features' 	=> (count($_POST['pro_plan_features']) >0)?implode(',',$_POST['pro_plan_features']):'',
				'modified_at' 			=> date('Y-m-d H:i:s')
			);
			$result = $this->user->update('tbl_professional_plan',$planupdate,'propla_id',$_POST['propla_id']); 
				//echo $this->db->last_query();die();
				if($result){
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Plan updated successfully.</div>');
					redirect('admin/professionalplan');
				} else {
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
					redirect('admin/professionalplan_edit/'.$_POST['propla_id']);
				}
		} 
		
		$data['planleditArr'] = $this->professional_model->planprofessionaldetails($planid);
		
		$this->load->frontAdmin('admin/professionalplan_edit',$data);
	}




	
	public function profile()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
		$this->form_validation->set_rules('profession', 'Profession', 'trim|required'); 
		$this->form_validation->set_rules('location', 'Location', 'trim|required');  
		$this->form_validation->set_rules('address', 'Address', 'trim|required');  

		/*if (empty($_FILES['image']['name'])){
		$this->form_validation->set_rules('image', 'Image', 'trim|required'); 
		}*/

		if($this->form_validation->run() == FALSE)
		{

			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			
			$data['locationname'] = $this->user->get_record_by_field_name_all_record('countries','countries_id',$data['profile'][0]['location']);
		    $this->load->frontAdmin('admin/profile',$data); 
		
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


			$data['name'] 		= $this->input->post('name'); 
			$data['profession'] 	= $this->input->post('profession'); 
			//$data['price'] 		= $this->input->post('price'); 
			$data['location'] 	= $this->input->post('location');  
			$data['address'] 	= $this->input->post('address');  
			 
		    $result = $this->user->update('tbl_user',$data,'id',$uid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
				redirect('admin/profile');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/profile');
			} 
		}
	}



   	public function course_listing(){
		
		$uid = $this->session->userdata('logged_in')['id'];
		$filterdata=$this->input->post(); 
        $data['countries'] = $this->user->get_countries();
		$this->db->order_by('name','ASC');
		$data['cproviders'] = $this->user->get_record_by_field_name_all_record('tbl_user','role',2);
		$this->db->order_by('name','ASC');
		$data['insititutions'] = $this->user->get_record_by_field_name_all_record('tbl_user','role',5);
		$data['course'] = $this->user->get_all_course($filterdata);
		$this->load->frontAdmin('admin/course_listing',$data);
	}

	public function training_center_list($filter=false){

	    $filterdata=$this->input->post(); 		
		$uid = $this->session->userdata('logged_in')['id'];
		$data['countries'] = $this->user->get_countries();
		$this->db->order_by('name','ASC');
		$data['cproviders'] = $this->user->get_record_by_field_name_all_record('tbl_user','role',2);
		$this->db->order_by('name','ASC');
		$data['insititutions'] = $this->user->get_record_by_field_name_all_record('tbl_user','role',5);
		$data['training'] = $this->user->getTrainingCenters($filterdata);
		$this->load->frontAdmin('admin/training_center_list',$data);
	}

   	public function training_center_view($idd){
		$uid = $this->session->userdata('logged_in')['id'];
		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);
		$this->load->frontAdmin('admin/training_center_view',$data);
	}



	public function active_promotion()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$filterdata=$this->input->post(); 
		$data['countries'] = $this->user->get_countries();
		$data['purchase_list'] = $this->user->get_active_promotion_all($filterdata);
		$this->load->frontAdmin('admin/active_promotion',$data);
	}


	public function subscription()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['subs_list'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_provider_subscription','user_id',$uid);
		$this->load->frontAdmin('admin/subscription_list',$data);
	}

	public function rbsubscription()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['subs_list'] = $this->user->get_rbsubscriptions();
		$this->load->frontAdmin('admin/rbsubscription_list',$data);
	}

	public function rbsubedit($id= false)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		//print_r($_POST); exit;
		if($_POST){
			$subscripdata 							 = array();
			$subscripdata['subcription_name']  		 = $this->input->post('subcription_name');
			$subscripdata['no_of_applications']  	 = $this->input->post('no_of_applications');
			$subscripdata['subscription_details']  	 = $this->input->post('subscription_details');
			$subscripdata['charge_per_application']  = $this->input->post('charge_per_application');
			$subscripdata['total_charges']  		 = $this->input->post('total_charges');
			$subscripdata['disp_position']  		 = $this->input->post('disp_position');
			$subscripdata['rbsp_status']  			 = $this->input->post('rbsp_status');
			if($this->input->post('rbsp_id')) {
				$subscripdata['added_at']  			 = date('Y-m-d H:i:s');
				//print_r($subscripdata); exit;
				$inserted = $this->user->rbsubscription_update($subscripdata,$this->input->post('rbsp_id'));
			}else{
				$subscripdata['modified_at']  			 = date('Y-m-d H:i:s');
				$inserted = $this->user->rbsubscription_insert($subscripdata);
			}
			redirect('admin/rbsubscription');
		}
		if($id){
			$data['edit']			= $this->user->get_one_rbsubscription($id);
		}
		$this->load->frontAdmin('admin/rbsubedit',$data);
	}

	public function digital_insurance_package()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['subs_list'] = $this->dashboards_model->get_dcpscriptions();
		$this->load->frontAdmin('admin/digital_insurance_package',$data);
	}

	public function dcpackageedit($id= false)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		//print_r($_POST); exit;
		if($_POST){
			$subscripdata 							 = array();
			$subscripdata['subcription_name']  		 = $this->input->post('subcription_name');
			$subscripdata['no_of_certificates']  	 = $this->input->post('no_of_certificates');
			$subscripdata['subscription_details']  	 = $this->input->post('subscription_details');
			$subscripdata['charge_per_certificate']  = $this->input->post('charge_per_certificate');
			$subscripdata['total_charges']  		 = $this->input->post('total_charges');
			$subscripdata['disp_position']  		 = $this->input->post('disp_position');
			$subscripdata['dcp_status']  			 = $this->input->post('dcp_status');
			if($this->input->post('dcp_id')) {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Package Updated.</div>');
				$subscripdata['modified_at']  		 = date('Y-m-d H:i:s');
				$inserted = $this->dashboards_model->dcpsubscription_update($subscripdata,$this->input->post('dcp_id'));
			}else{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Package added.</div>');
				$subscripdata['added_at']  			 = date('Y-m-d H:i:s');
				$inserted = $this->dashboards_model->dcpsubscription_insert($subscripdata);
			}
			redirect('admin/digital_insurance_package');
		}
		if($id){
			$data['edit']			= $this->dashboards_model->get_one_dcpscription($id);
		}
		$this->load->frontAdmin('admin/dcpackageedit',$data);
	}

	public function dcpdelet($id="")
	{
		$result=$this->db->where('dcp_id',$id)->delete("digital_insurance_package");
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record added.</div>');
			redirect('admin/digital_insurance_package');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('admin/digital_insurance_package');
		} 
	}

	public function advertisment_listing()
	{
		$this->load->frontAdmin('admin/advertisment_listing');
	}

	public function job_listing()
	{
		$this->load->frontAdmin('admin/job_listing');
	}	

	public function course_analytics()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['course'] = $this->user->get_all_course($uid); 
		$this->load->frontAdmin('admin/course_analytics',$data);
	}


	public function changestatus()
	{
		$id          	= $this->input->post('id');
		$role          	= $this->input->post('role');
		$activation_id    = $this->input->post('activate_id');
		$userdetails = $this->users_model->getusetdetails('tbl_user','activation_id',$activation_id);
		
		if(isset($userdetails) && $userdetails->role == '1'){
			$data['status'] = 1;
			$data['activation_id'] = "";
			$result = $this->users_model->update('tbl_user',$data,'id',$userdetails->id);

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
			// echo $this->db->last_query();die;
		}else{
			if($this->input->post('status')==1){
				$data['status'] = $this->input->post('status');
				$data['approval_date'] = date('Y-m-d');
				$data['disabled_by'] = 0;
			}else{
				$data['status'] = $this->input->post('status');
				$data['disabled_by'] = $this->input->post('ins_name');
				$data['activation_id'] 	= ''; 
			}
			$result = $this->user->update('tbl_user',$data,'id',$id);
			$user_info = $this->user->get_record_by_field_name_all_record('tbl_user','id',$id);
		}

		if($result){
			if($this->input->post('status') == 0 ){ 
				$this->sendMail($user_info[0]['username_email'],'Account Deactivation',$this->load->view('email/account_deactivation',$datas,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Deactivated successfully.</div>');
			} else { 
				if($userdetails->role == '6'){
				$this->sendMail($user_info[0]['username_email'],'Account Activation',$this->load->view('email/author_account_activation',$datas,true));
				}else{
				$this->sendMail($user_info[0]['username_email'],'Account Activation',$this->load->view('email/account_activation',$datas,true));
				}
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Activated successfully.</div>');
			 }
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect($_SERVER['HTTP_REFERER']);
	}



	public function changeCepStatus(){
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
		$user_info = $this->user->get_record_by_field_name_all_record('tbl_user','id',$id);

		if($result){
			if($this->input->post('status') == 0 ){ 
				$this->sendMail($user_info[0]['username_email'],'Account Deactivation',$this->load->view('email/account_deactivation',$datas,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Deactivated successfully.</div>');
			} else { 
				$this->sendMail($user_info[0]['username_email'],'Account Activation',$this->load->view('email/account_activation',$datas,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Activated successfully.</div>');
			 }
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect($_SERVER['HTTP_REFERER']);
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
		$user_info = $this->user->get_record_by_field_name_all_record('tbl_user','id',$id);

		if($result){
			if($this->input->post('status') == 0 ){ 
				$this->sendMail($user_info[0]['username_email'],'Account Deactivation',$this->load->view('email/account_deactivation',$datas,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Deactivated successfully.</div>');
			} else { 
				$this->sendMail($user_info[0]['username_email'],'Account Activation',$this->load->view('email/account_activation',$datas,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Activated successfully.</div>');
			 }
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function changeRboardStatus(){
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
		$user_info = $this->user->get_record_by_field_name_all_record('tbl_user','id',$id);

		if($result){
			if($this->input->post('status') == 0 ){ 
				$this->sendMail($user_info[0]['username_email'],'Account Deactivation',$this->load->view('email/account_deactivation',$datas,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Deactivated successfully.</div>');
			} else { 
				$this->sendMail($user_info[0]['username_email'],'Account Activation',$this->load->view('email/account_activation',$datas,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Activated successfully.</div>');
			 }
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function changeAuthorStatus(){
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
		$user_info = $this->user->get_record_by_field_name_all_record('tbl_user','id',$id);

		if($result){
			if($this->input->post('status') == 0 ){ 
				$this->sendMail($user_info[0]['username_email'],'Account Activation',$this->load->view('email/account_activation',$datas,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Deactivated successfully.</div>');
			} else { 
				$this->sendMail($user_info[0]['username_email'],'Account Activation',$this->load->view('email/author_account_activation',$datas,true));
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User Account Activated successfully.</div>');
			 }
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function changecoursestatus(){

		$id = $this->input->post('id');
		$creater_id = $this->input->post('create');
		$course_name = $this->input->post('name');
		if($this->input->post('status')==1){
			$data['status'] = $this->input->post('status');
			$data['disabled_by'] = 0;
		}elseif($this->input->post('status')==3){
			$data['status'] = $this->input->post('status');
			$data['disabled_by'] = 0;
		}else{
			$data['status'] = $this->input->post('status');
			$data['disabled_by'] = $this->input->post('disabled_by');
		}
		$result = $this->user->update('tbl_course',$data,'id',$id);
		$user_info = $this->user->get_record_by_field_name_all_record('tbl_user','id',$creater_id);

		if($result){
			if($this->input->post('status') == 0 ){ 
				$this->sendMail($user_info[0]['username_email'],'Course Deactivation','Your course "'.$course_name.'" has been Deactivated by Admin.');
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Course Deactivated successfully.</div>');
			} else { 
				$this->sendMail($user_info[0]['username_email'],'Course Activation','Your course "'.$course_name.'" has been Activated by Admin.');
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Course Activated successfully.</div>');
			 }
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function changetrainingstatus(){

		$id = $this->input->post('id');
		$creater_id = $this->input->post('create');
		$course_name = $this->input->post('name');
		if($this->input->post('status')==2){
			$data['status'] = $this->input->post('status');
			$data['disabled_by'] = 0;
		}elseif($this->input->post('status')==1){
			$data['status'] = $this->input->post('status');
			$data['disabled_by'] = 0;
		}else{
			$data['status'] = $this->input->post('status');
			$data['disabled_by'] = $this->input->post('disabled_by');
		}
		$result = $this->user->update('tbl_training',$data,'id',$id);

		$user_info = $this->user->get_record_by_field_name_all_record('tbl_user','id',$creater_id);

		if($result){
			if($this->input->post('status') == 0 ){ 
				$this->sendMail($user_info[0]['username_email'],'Training Deactivation','Your course "'.$course_name.'" has been Deactivated by Admin.');
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training Deactivated successfully.</div>');
			} else { 
				$this->sendMail($user_info[0]['username_email'],'Training Activation','Your course "'.$course_name.'" has been Activated by Admin.');
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training Activated successfully.</div>');
			 }
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		} 
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function adstatus($idd,$status)
	{
	
		if($status==1){
			$stts = 0;
		} else {
			$stts = 1;
		}

		$data['status'] 	= $stts;  
			 
		    $result = $this->user->update('tbl_adv_package_purchased',$data,'id',$idd); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Ads status changed successfully.</div>');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect($_SERVER['HTTP_REFERER']);
			} 

	}




	public function change_course_status($idd,$status)
	{
	
		if($status==1){
			$stts = 0;
		} else {
			$stts = 1;
		}

		$data['status'] 	= $stts;  
			 
		    $result = $this->user->update('tbl_course',$data,'id',$idd); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User status changed successfully.</div>');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect($_SERVER['HTTP_REFERER']);
			} 

	}



	public function change_user_status($idd,$status)
	{
	
		if($status==1){
			$stts = 0;
		} else {
			$stts = 1;
		}

		$data['status'] 	= $stts;  
			 
		    $result = $this->user->update('tbl_user',$data,'id',$idd); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">User enabled successfully.</div>');
				redirect('admin/users');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/users');
			} 

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
		$this->load->frontAdmin('admin/income_report',$data);
	  } else {
	  
	  	$uid = $this->session->userdata('logged_in')['id'];		
		$data['today'] = $this->user->get_report2('today',$uid);
		$data['month'] = $this->user->get_report2('month',$uid);
		$data['year']  = $this->user->get_report2('year',$uid);
		$data['total'] = $this->user->get_report2('total',$uid);
		$this->load->frontAdmin('admin/income_report_otri',$data);
	  
	  }

	}






public function contactinfo()
    {       

    	$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');   
        $this->form_validation->set_rules('email', 'Email', 'trim|required');   
        $this->form_validation->set_rules('address', 'Address', 'trim|required');   

        if($this->form_validation->run() == FALSE)
        { 
            $data['contactinfo'] = $this->user->get_record_by_field_name_all_record('tbl_contact_info','id',1);
            $this->load->frontAdmin('admin/contactinfo',$data);
        }  else { 

            $data['phone']      = $this->input->post('phone');  
            $data['email']      = $this->input->post('email');  
            $data['email']      = $this->input->post('email');  
            $data['address']    = $this->input->post('address');  
            $data['status']     = 1;  
            $data['added_on']   = date('Y-m-d');  

             $result = $this->user->update('tbl_contact_info',$data,'id',1); 

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Contact info updated successfully.</div>');
                redirect('admin/contactinfo');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('admin/contactinfo');
            } 

        }       
    }




public function guide()
    {       
    	$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
        $this->form_validation->set_rules('type', 'Type', 'trim|required');   
        $this->form_validation->set_rules('title', 'Title', 'trim|required');   
        $this->form_validation->set_rules('description', 'Description', 'trim|required');   

        if($this->form_validation->run() == FALSE)
        {  
        	 $data['exam']  = $this->user->get_record_by_field_name_all_record_limit('tbl_guide','types','exam');
        	 $data['guide'] = $this->user->get_record_by_field_name_all_record_limit('tbl_guide','types','guide');
            $this->load->frontAdmin('admin/guide',$data);
        }  else { 

            $data['types']        = $this->input->post('type');  
            $data['title']       = $this->input->post('title');  
            $data['description'] = $this->input->post('description');    
            $data['status']      = 1;  
            $data['added_on']    = date('Y-m-d');  
           
             $result = $this->user->save('tbl_guide',$data); 

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record added successfully.</div>');
                redirect('admin/guide');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('admin/guide');
            } 

        }       
    }





public function purchasedetailsAdmin(){
	    $datedata = $this->input->post('datedata');
	    $data['totalData'] =  $this->user->getpaydetailsAdmin($datedata);
	    //print_r($data); die;
		$this->load->view('provider/purchsedetails',$data);
	   }


public function invoice_listing()
	{ 
		$data['users'] = $this->user->get_users_by_role('1');
		$data['countries'] = $this->user->get_countries();
		$this->db->where('under_insititution','0');
		$data['cproviders'] = $this->user->get_record_by_field_name_all_record('tbl_user','role',2);

		if($this->input->post()){
			if($this->input->post('added_on')){
				$date = explode('-', $this->input->post('added_on'));
				$this->db->where('YEAR(tbl_invoice.month_name) =',$date[0]); 
				$this->db->where('MONTH(tbl_invoice.month_name) =',$date[1]); 	
				// $filterdata['month_name'] = $this->input->post('added_on'); //date 
				$filterdata = array();
			}
			if($this->input->post('ceprovider')){
				$filterdata['user_id']  = $this->input->post('ceprovider'); //ce provider
			}
			if($this->input->post('country')){
				$filterdata['country']  = $this->input->post('country'); //country
			}
		$data['invoice'] = $this->user->get_record_by_field_name_all_record_filter('tbl_invoice',$filterdata);	
		}else{

		$data['invoice'] = $this->user->get_record_by_field_name_all_record('tbl_invoice','list_status',1); 
		}
		//echo '<pre>'; print_r($data); die;
		$this->load->frontAdmin('admin/invoice_listing',$data); 
	}

public function invoice_receipt($id)
		{	
		$data['invoice'] = $this->user->get_record_by_field_name_all_record('tbl_invoice','id',$id);		

			//print_r($data['invoice']);
		$this->load->frontAdmin('admin/invoice_receipt',$data);
		}

public function paynow()
	{ 
		$idd = $this->input->post('idd');
		$data['transaction_id'] = $this->input->post('transactions_id');
		$data['paid_amount']    = $this->input->post('amount');; 
		$data['status']         = 2; 

		//echo '<pre>';print_r($data); die;

		    $result = $this->user->update('tbl_invoice',$data,'id',$idd); 
			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Payment status updated successfully..</div>');
				redirect('admin/invoice_listing');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/invoice_listing');
			} 

	}




public function advertise()
	{

		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');  
		$this->form_validation->set_rules('target_units', 'Target Units', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$stts=1;
			$data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',$stts); 
			$data['locations'] = $this->user->get_record_by_field_name_all_record('tbl_location','status',1);
			$data['banner_size'] = $this->user->get_record_by_field_name_all_record('tbl_banner_size','status',1);
			$this->load->frontAdmin('admin/advertise',$data);

		}  else { 
			$data['cat_name'] 			= $this->input->post('cat_name');   
			$data['target_units'] 			= $this->input->post('target_units');   
			$data['status'] 			= 1;   
		    $result = $this->user->save('tbl_category',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Category added.</div>');
				redirect('admin/advertise');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/advertise');
			} 
		}
	}






public function addadvertise()
    {       
        $this->form_validation->set_rules('package_name', 'Package Name', 'trim|required');   
        $this->form_validation->set_rules('size', 'Size', 'trim|required');   
        $this->form_validation->set_rules('location', 'Location', 'trim|required');   
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
		$this->form_validation->set_rules('minimum_view', 'Minimum View', 'trim|required');   

        if (empty($_FILES['package_image']['name']))
        {
           $this->form_validation->set_rules('package_image', 'Package Image', 'trim|required');
        }

          

        if($this->form_validation->run() == FALSE)
        { 
            $this->load->view('addadvertise');
        }  else { 


            if(isset($_FILES["package_image"]) && !empty($_FILES["package_image"]['name'])){
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["package_image"]["name"]);        
            $imageName = 'IMG_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('package_image'))
            {
            $error = array('error' => $this->upload->display_errors());                       
            }  
            $data['package_image'] = $imageName;
            }



            $data['package_name']  = $this->input->post('package_name');  
             
            $data['location']      = $this->input->post('location');
            $data['size']      = $this->input->post('size');			
            $data['price']         = $this->input->post('price');
            $data['minimum_view']         = $this->input->post('minimum_view');			
            $data['status']     = 1;  
            $data['added_on']   = date('Y-m-d');  


             $result = $this->user->save('tbl_adv_package',$data); 
             //print_r($data); die;

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Advertise.</div>');
                redirect('admin/advertise');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('admin/advertise');
            } 

        }       
    }

	public function countrywebpagelist()
	{	
		if(!empty($this->uri->segment(3))){
			if($this->uri->segment(3)==1){
			$this->db->where('display','Yes');
			}
			if($this->uri->segment(3)==2){
				$this->db->where('display !=','Yes');
			}
		}

		$data['country']=$this->db->where('status',1)->get("countries")->result_array();
		$this->load->frontAdmin('admin/countrywebpagelist',$data);
	}

	public function countrywebpage()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
        $this->form_validation->set_rules('hedding', 'hedding', 'trim|required');   
        $this->form_validation->set_rules('sub_hedding', 'sub_hedding', 'trim|required');

		 if(isset($_FILES["image"]) && !empty($_FILES["image"]['name']))
		 {
            $config['upload_path'] = './assets/upload/country/';
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
            $data['banner_image'] = $imageName;
         }


	 
		if($this->form_validation->run() == FALSE)
		{
			
			redirect('admin/countrywebpage');

		}
		else 
		{ 
			
			$data['display'] 	    = $this->input->post('display');   
			$data['hedding'] 	    = $this->input->post('hedding');   
			$data['sub_hedding'] 	= $this->input->post('sub_hedding');   
			$data['name'] 			= $this->input->post('name');   
			$data['link'] 			= $this->input->post('link');   
			$data['photo_owner'] 	= $this->input->post('photo_owner');   
			 
		    $result = $this->db->where('countries_id',$this->input->post('cid'))->update('countries',$data); 
			
			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record added.</div>');
				redirect('admin/countrywebpagelist');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/countrywebpage'.$this->input->post('cid'));
			} 
		}
		}
		else
		{
			
			$this->load->frontAdmin('admin/countrywebpage',$data);
		}
	}


public function countrydelet($id="")
{
	$result=$this->db->where('id',$id)->delete("tbl_countywebpage");
	if($result){
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record added.</div>');
		redirect('admin/countrywebpage');
	} else {
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		redirect('admin/countrywebpage');
	} 
	
}


public function blog_list()
{
	$data['blog']=$this->db->get("tbl_blog")->result_array();
		
	$this->load->frontAdmin('admin/blog',$data);
}

public function blog()
{
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
			
			redirect('admin/blog');

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
			$data['under_ins'] 		= '0';   
		    $result = $this->db->insert('tbl_blog',$data); 
			
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record added.</div>');
				redirect('admin/blog_list');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/blog_list');
			} 
		}
	}
	else
	{
	$data['blog']=$this->db->where('status',1)->get("tbl_blog")->result_array();
	$data['country']=$this->db->where(array('status'=>1))->get("countries")->result_array();
	// echo $this->db->last_query();die;
	$this->load->frontAdmin('admin/add_blog',$data);
	}
}


	public function edit_blog($id){
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
		            if ( ! $this->upload->do_upload('image')){
		            	$error = array('error' => $this->upload->display_errors());                       
		            }  
	            $data['image'] = $imageName;
            }


	 
			if($this->form_validation->run() == FALSE){
				redirect('admin/edit_blog');
			}else{ 
				$data['title'] 			= $this->input->post('title');   
				$data['country'] 			= $this->input->post('country');   
			/* 	$data['image'] 			= $imageName;   */ 
				$data['st_desc'] 	    = $this->input->post('st_desc');   
				$data['des'] 			= $this->input->post('des');   
				$data['status'] 		= $this->input->post('status');   
			    $result = $this->user->update('tbl_blog',$data,'id',$id); 
				
				if($result){
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record added.</div>');
					redirect('admin/blog_list');
				} else {
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
					redirect('admin/blog_list');
				} 
			}
		}else{
			$data['blog']=$this->db->where(array('id'=>$id))->get("tbl_blog")->result_array();
			$data['country']=$this->db->where(array('status'=>1))->order_by('countries_name','ASC')->get("countries")->result_array();
			// echo $this->db->last_query();die;
			$this->load->frontAdmin('admin/edit_blog',$data);
		}
	}


	public function blog_delete($id){
		$result = $this->db->where('id',$id)->delete("tbl_blog");
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Blog Deleted Successfully!</div>');
			redirect('admin/blog_list');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again!</div>');
			redirect('admin/blog_list');
		} 
	}

	public function adslists(){
	    $param = $_REQUEST;           
	    $data['countries'] = $this->user->get_countries();
	    $where = array('role'=>4,'status'=>1);
		$data['advertisers'] = $this->user->get_record_by_field_name_all_record('tbl_user',$where,''); 
		$data['locations'] = $this->user->get_record_by_field_name_all_record('tbl_location','status',1); 
		$data['banner_size'] = $this->user->get_record_by_field_name_all_record('tbl_banner_size','status',1);
	    $data['adv'] = $this->user->getAdvertiseAddsList(); 
	    $this->load->frontAdmin('admin/adslists',$data);
	}

	public function certificate(){
		$stts=1;
		$st="";

		$data['category'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',$stts); 
		$data['adv'] = $this->user->get_record_by_field_name_status('tbl_adv_upload');		
		$data['countries'] = $this->user->get_countries();
		$data['cproviders'] = $this->user->get_record_by_field_name_all_record('tbl_user','role',2);
		$data['insititutions'] = $this->user->get_record_by_field_name_all_record('tbl_user','role',5);
		$filterdata = $this->input->post(); 		
		$data['certificates'] = $this->user->getCertificates($filterdata);
		$data['coursecertificates'] = $this->user->getCourseCertificates($filterdata);
		$this->load->frontAdmin('admin/certificate',$data);
	}

	public function certificate_templete(){
		// $uid = $this->session->userdata('logged_in')['id'];
		$configure['base_url'] = base_url('admin/certificate_templete');
		$configure['total_rows'] = 200;
		$configure['per_page'] = 50;
		$this->pagination->initialize($configure);

        $this->load->library('upload');
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');  
		$this->form_validation->set_rules('template_no', 'Template Number', 'trim|required');  
		$this->form_validation->set_rules('category', 'Category', 'trim|required');   
		$this->form_validation->set_rules('numberofsignature', 'Target Units', 'trim|required');  

		if(isset($_FILES["templetepreview"]) && !empty($_FILES["templetepreview"]['name']))
		{
            $config['upload_path'] = './assets/upload/certificate_templete';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["templetepreview"]["name"]);        
            $imageName = 'CT_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
	        $this->upload->initialize($config);  //this is very important, if we are adding multiple photos. 
	        if ( ! $this->upload->do_upload('templetepreview'))
	        {
	        	$error = array('error' => $this->upload->display_errors());                       
	        }  
            	$data['temppreview'] = $imageName;
        }

        if(isset($_FILES["bg_image"]) && !empty($_FILES["bg_image"]['name']))
		{
            $config1['upload_path'] = './assets/upload/certificate_templete';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg';
            $config1['max_size'] = '200000';
            $config1['max_width']  = '15000';
            $config1['max_height']  = '8000';        
            $ext = explode('.',$_FILES["bg_image"]["name"]);        
            $imageName = 'BG_'.time().'.'.end($ext);
            $config2['file_name'] = $imageName;
	        $this->upload->initialize($config2);
	        if ( ! $this->upload->do_upload('bg_image'))
	        {
	        	$error = array('error' => $this->upload->display_errors());                       
	        }  
            	$data['bg_image'] = $imageName;
        }

        if(isset($_FILES["text_image"]) && !empty($_FILES["text_image"]['name']))
		{
            $config3['upload_path'] = './assets/upload/certificate_templete';
            $config3['allowed_types'] = 'gif|jpg|png|jpeg';
            $config3['max_size'] = '200000';
            $config3['max_width']  = '15000';
            $config3['max_height']  = '8000';        
            $ext = explode('.',$_FILES["text_image"]["name"]);        
            $imageName = 'T_'.time().'.'.end($ext);
            $config3['file_name'] = $imageName;
	        $this->upload->initialize($config3);
	        if ( ! $this->upload->do_upload('text_image'))
	        {
	        	$error = array('error' => $this->upload->display_errors());                       
	        }  
            	$data['text_image'] = $imageName;
        }
	 
		if($this->form_validation->run() == FALSE)
		{
			// $data['ctemp'] = $this->user->getAllCertificateTemplate($configure['per_page'],$this->uri->segment(3));
			$data['ctemp'] = $this->user->getAllCertificateTemplate();
			$this->load->frontAdmin('admin/certificate_templete',$data);

		}else{
			
			$data['template_no'] 		= $this->input->post('template_no');   
			$data['category'] 			= $this->input->post('category');   
			$data['numberofsignature'] 	= $this->input->post('numberofsignature');     
			$data['status'] 			= 1;   
			$data['added_on'] 			= date('Y-m-d');

		    $result = $this->db->insert('tbl_certificate_template',$data);

		    // echo $this->db->last_query();
			// print_r($result);

			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate Template added.</div>');
				redirect('admin/certificate_templete');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/certificate_templete');
			} 
		}
	}

	public function certificate_templete_edit() //here id comeing from form.
	{
		$ctemp = $this->db->where('id',$_REQUEST['id'])->get('tbl_certificate_template')->row_array();
		echo json_encode($ctemp);

	}
	
			
	public function update_certificate_templete()
	{ 
		$id = $this->input->post('id');
		// print_r($this->input->post());

        $this->load->library('upload');
		if(isset($_FILES["templetepreview"]) && !empty($_FILES["templetepreview"]['name']))
		{
            $config['upload_path'] = './assets/upload/certificate_templete';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["templetepreview"]["name"]);        
            $imageName = 'CT_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('templetepreview'))
	        {
	        	$error = array('error' => $this->upload->display_errors());                       
	        }  
            	$data['temppreview'] = $imageName;
        }
	 
         if(isset($_FILES["bg_image"]) && !empty($_FILES["bg_image"]['name']))
		{
            $config1['upload_path'] = './assets/upload/certificate_templete';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg';
            $config1['max_size'] = '200000';
            $config1['max_width']  = '15000';
            $config1['max_height']  = '8000';        
            $ext = explode('.',$_FILES["bg_image"]["name"]);        
            $imageName = 'BG_'.time().'.'.end($ext);
            $config1['file_name'] = $imageName;
	        $this->upload->initialize($config1);
	        if ( ! $this->upload->do_upload('bg_image'))
	        {
	        	$error = array('error' => $this->upload->display_errors());                       
	        }  
            	$data['bg_image'] = $imageName;
        }
        // print_r($_FILES["text_image"]);die;
        if(isset($_FILES["text_image"]) && !empty($_FILES["text_image"]['name']))
		{
            $config2['upload_path'] = './assets/upload/certificate_templete';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg';
            $config2['max_size'] = '200000000';
            $config2['max_width']  = '15000';
            $config2['max_height']  = '8000';        
            $ext = explode('.',$_FILES["text_image"]["name"]);        
            $imageName = 'T_'.time().'.'.end($ext);
            $config2['file_name'] = $imageName;
	        $this->upload->initialize($config2);
	        if ( ! $this->upload->do_upload('text_image'))
	        {
	        	$error = array('error' => $this->upload->display_errors());                       
	        }  
            	$data['text_image'] = $imageName;
        }
			
			$data['template_no'] 		= $this->input->post('template_no');   
			$data['category'] 			= $this->input->post('category');   
			$data['numberofsignature'] 	= $this->input->post('numberofsignature');     
			$data['status'] 			= $this->input->post('status');
			$data['updated_on'] 		= date('Y-m-d');

		    $result = $this->user->update('tbl_certificate_template',$data,'id',$id);

		    // echo $this->db->last_query();
			// print_r($result);

			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate Template Updated Successfully.</div>');
				redirect('admin/certificate_templete');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/certificate_templete');
			} 
	}
		

	public function certificate_templete_delete($id){
   
   $result =  $this->user->delete('tbl_certificate_template','id',$id);
   
    if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate Templete deleted successfully.</div>');
                redirect('admin/certificate_templete');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('admin/certificate_templete');
        } 
}	


public function deleteadvertise($id){
   
   $result =  $this->user->delete('tbl_adv_package','id',$id);
   
    if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">advertise deleted successfully.</div>');
                redirect('admin/advertise');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('admin/advertise');
        } 
}




public function editadvertise($id)
    {       
        $this->form_validation->set_rules('package_name', 'Package Name', 'trim|required');   
        $this->form_validation->set_rules('size', 'Size', 'trim|required');   
        $this->form_validation->set_rules('location', 'Location', 'trim|required');   
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('minimum_view', 'Minimum view', 'trim|required');		


          

        if($this->form_validation->run() == FALSE)
        { 
            $data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','id',$id);
            $data['locations'] = $this->user->get_record_by_field_name_all_record('tbl_location','status',1);
            $data['banner_size'] = $this->user->get_record_by_field_name_all_record('tbl_banner_size','status',1);

            $this->load->frontAdmin('admin/editadvertise',$data);

        }  else { 


            if(isset($_FILES["package_image"]) && !empty($_FILES["package_image"]['name'])){
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["package_image"]["name"]);        
            $imageName = 'IMG_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('package_image'))
            {
            $error = array('error' => $this->upload->display_errors());                       
            }  
            $data['package_image'] = $imageName;
            }


            $data['package_name']  = $this->input->post('package_name');  
            $data['size']      = $this->input->post('size');  
            $data['location']      = $this->input->post('location');  
            $data['price']         = $this->input->post('price');  
            $data['minimum_view']         = $this->input->post('minimum_view');  

            $idd = $this->input->post('idd'); 
           
            


            $result = $this->user->update('tbl_adv_package',$data,'id',$idd); 

            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Contact info updated successfully.</div>');
                redirect('admin/editadvertise/'.$idd.'');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('admin/editadvertise/'.$idd.'');
            } 

        }       
    }
	
	
  public function banner_location()
	{
		$uid = $this->session->userdata('logged_in')['id'];		  
		$this->form_validation->set_rules('name', 'Location Name', 'trim|required');  
       	 
		if($this->form_validation->run() == FALSE)
		{

			$data['locations'] = $this->user->get_record_by_field_name_all_record('tbl_location','status',1);
			$this->load->frontAdmin('admin/banner_location',$data);
		
		}  else {  

			$data['location_name'] 		= $this->input->post('name');  
			$data['status'] 		= 1;					
		    $result = $this->user->save('tbl_location',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Location successfully added.</div>');
				redirect('admin/banner_location');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/banner_location');
			} 
		}
	}	
	
	public function deletebanner_location($id){
   
		   $result =  $this->user->delete('tbl_location','id',$id);
		   
			if($result){
						$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Location deleted successfully.</div>');
						redirect('admin/banner_location');
					} else {
						$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
						redirect('admin/banner_location');
				} 
		}


     public function banner_size()
		{
			$uid = $this->session->userdata('logged_in')['id'];		  
			$this->form_validation->set_rules('location', 'Location', 'trim|required');  
			 
			if($this->form_validation->run() == FALSE)
			{

				$data['locations'] = $this->user->get_record_by_field_name_all_record('tbl_location','status',1);
				$data['banner_size'] = $this->user->get_record_by_field_name_all_record('tbl_banner_size','status',1);
				$this->load->frontAdmin('admin/banner_size',$data);
			
			}  else {  

				$data['location'] 		= $this->input->post('location'); 
                $data['size_width'] 		= $this->input->post('size_width'); 
                $data['size_height'] 		= $this->input->post('size_height'); 				
				$data['status'] 		= 1;					
				$result = $this->user->save('tbl_banner_size',$data); 
				if($result){
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Size successfully added.</div>');
					redirect('admin/banner_size');
				} else {
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
					redirect('admin/banner_size');
				} 
			}
		}	
	
	public function deletebanner_size($id){
   
		   $result =  $this->user->delete('tbl_banner_size','id',$id);
		   
			if($result){
						$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Size deleted successfully.</div>');
						redirect('admin/banner_size');
					} else {
						$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
						redirect('admin/banner_size');
				} 
		}
		
		
		
	public function showMessage(){
	   $idd =  $this->input->post('idd');
	   $this->db->where('id',$idd);
	   $notification = $this->user->get_enquiry();
	   $message ='  <div class="order-receipt"><div class="row">
					    <div class="col-sm-12"><p>'.$notification[0]['message'].'</p></div>
						    <div class="col-sm-12">
							<center>
							<a href="'.site_url('admin/notification').'">
								<input type="button" value="REPLY" class="btn info">
							</a>
							</center>
						     </div>
					    </div>
				    </div> '; 
					
		echo $message;
}
	
	public function countrywise_trail_days($id=false)
	{ 
		
		$this->form_validation->set_rules('country', 'Country', 'trim|required|is_unique[tbl_countrywise_trail_days.country_id]');  
			 
		if($this->form_validation->run() == FALSE)
			{		
				$data['trail_days'] = $this->dashboards_model->get_trail_days();
				$data['country'] = $this->db->get_where('countries',array('status'=>1))->result_array(); 
				$this->load->frontAdmin('admin/trail_days',$data);
			}else{
				$add = array(
					'country_id'=>$this->input->post('country'),
					'trail_days'=>$this->input->post('trail_days')
				);
				$result = $this->user->save('tbl_countrywise_trail_days',$add);
			
				if($result){
					$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Trail Day Added successfully.</div>');
				}else{
					$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				}
		redirect('admin/countrywise_trail_days');
		}
		
	}

	public function trailedit($id){
		// echo $id;
		if($this->input->post()){
				$update = array(
					'trail_days'=>$this->input->post('trail_days')
				);
		$result = $this->user->update('tbl_countrywise_trail_days',$update,'ctry_id',$id);
		if($result){
			$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Trail Day Updated successfully.</div>');
			
		}else{
			$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		}
		redirect('admin/countrywise_trail_days');
		}
		$data['trail_edit'] = $this->dashboards_model->get_trail_days_edit($id);
		$data['trail_days'] = $this->dashboards_model->get_trail_days();
		$data['country'] = $this->db->get_where('countries',array('status'=>'1'))->result_array(); 
		$this->load->frontAdmin('admin/trail_days',$data);
		
	}
	public function traildelete($id){

		$result = $this->user->delete('tbl_countrywise_trail_days','ctry_id',$id);
		if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Trail Day Deleted successfully.</div>');
				redirect('admin/countrywise_trail_days');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/countrywise_trail_days');
			}
	}

	public function tutorials()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['professionals'] 		= $this->dashboards_model->get_tutorial('professional');
		$data['authorCeonpoints'] 	= $this->dashboards_model->get_tutorial('authorCeonpoint');
		$data['authorBussinesss'] 	= $this->dashboards_model->get_tutorial('authorBussiness');
		$data['authorInstitutions'] = $this->dashboards_model->get_tutorial('authorInstitution');
		$data['cepbussinesss'] 		= $this->dashboards_model->get_tutorial('cepBusiness');
		$data['cepinstitutions']	= $this->dashboards_model->get_tutorial('cepInstitution');
		$data['institutions'] 		= $this->dashboards_model->get_tutorial('institution');
		$data['advertiser'] 		= $this->dashboards_model->get_tutorial('advertiser');
		$data['reg'] 				= $this->dashboards_model->get_tutorial('regulatoryBoard');
		$data['tutorials'] 			= $this->dashboards_model->get_tutorial();
		$this->load->frontAdmin('admin/tutorials',$data);
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
			$data['professionals'] 		= $this->dashboards_model->get_tutorial('professional');
			$data['authorCeonpoints'] 	= $this->dashboards_model->get_tutorial('authorCeonpoint');
			$data['authorBusinesss'] 	= $this->dashboards_model->get_tutorial('authorBusiness');
			$data['authorInstitutions'] = $this->dashboards_model->get_tutorial('authorInstitution');
			$data['cepbussinesss'] 		= $this->dashboards_model->get_tutorial('cepBusiness');
			$data['cepinstitutions']	= $this->dashboards_model->get_tutorial('cepInstitution');
			$data['institutions'] 		= $this->dashboards_model->get_tutorial('institution');
			$data['advertiser'] 		= $this->dashboards_model->get_tutorial('advertiser');
			$data['reg'] 				= $this->dashboards_model->get_tutorial('regulatoryBoard');
			$data['tutorials'] 			= $this->dashboards_model->get_tutorial();
			$this->load->frontAdmin('admin/tutorials',$data);
		}else{
			$add = array(
				'subject'		=>  ucwords($this->input->post('subject')),
				'title'			=>  ucwords($this->input->post('title')),
				'discription'	=>  $this->input->post('discription'),
				'type'			=>  $this->input->post('type'),
				'url'			=>  $this->input->post('url'),
				'added_by'		=>  $uid,
				'added_by_role'	=>  $urole,
				'status'		=>  '1',
				'show_on_faq'	=>  '1',
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
				redirect('admin/addTutorialVideo');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/addTutorialVideo');
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
			$data['professionals'] 		= $this->dashboards_model->get_tutorial('professional');
			$data['authorCeonpoints'] 	= $this->dashboards_model->get_tutorial('authorCeonpoint');
			$data['authorBusinesss'] 	= $this->dashboards_model->get_tutorial('authorBusiness');
			$data['authorInstitutions'] = $this->dashboards_model->get_tutorial('authorInstitution');
			$data['cepbussinesss'] 		= $this->dashboards_model->get_tutorial('cepBusiness');
			$data['cepinstitutions']	= $this->dashboards_model->get_tutorial('cepInstitution');
			$data['institutions'] 		= $this->dashboards_model->get_tutorial('institution');
			$data['advertiser'] 		= $this->dashboards_model->get_tutorial('advertiser');
			$data['tutorials'] 			= $this->dashboards_model->get_tutorial();;
			$this->load->frontAdmin('admin/tutorials',$data);
		}else{
			$id = $this->input->post('id');
			$update = array(
				'subject'		=>  ucwords($this->input->post('subject')),
				'title'			=>  ucwords($this->input->post('title')),
				'discription'	=>  $this->input->post('discription'),
				'type'			=>  $this->input->post('type'),
				'url'			=>  $this->input->post('url'),
				'status'		=>  $this->input->post('status'),
				'show_on_faq'	=>  $this->input->post('show_on_faq')
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
			// echo $this->db->last_query();die;
			if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Video Updated successfully.</div>');
				redirect('admin/tutorials');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/tutorials');
			}
		}
		
	}

	public function tutorialdelete($id){

		$result = $this->user->delete('tbl_tutorial','id',$id);
		if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Tutorial Deleted successfully.</div>');
				redirect('admin/tutorials');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/tutorials');
			}
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
				redirect('admin/authors');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/authors');
			}
	}
	public function sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE)
	{ 


		$from = EMAIL;
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
	
	
	public function tax($id=false)
	{ 
		
		$this->form_validation->set_rules('countries_id', 'Country', 'trim|required');  
		$this->form_validation->set_rules('tax', 'Tax', 'trim|required');  
			 
		if($this->form_validation->run() == FALSE)
			{		
				//$data['trail_days'] = $this->dashboards_model->get_trail_days();
				$data['trail_days'] = $this->db->get_where('countries',array('status'=>'1','tax >'=>0))->result_array();
				// echo $this->db->last_query();
				$data['country'] = $this->db->get_where('countries',array('status'=>'1'))->result_array(); 
				$this->load->frontAdmin('admin/tax',$data);
			}else{
				$update = array(
					//'countries_id'=>$this->input->post('countries_id'),
					'tax'=>$this->input->post('tax')
				);
				//print_r($add); exit;
				//$result = $this->user->save('countries',$add);
				$result = $this->user->update('countries',$update,'countries_id',$this->input->post('countries_id'));		
				if($result){
					$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Trail Day Added successfully.</div>');
				}else{
					$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				}
			redirect('admin/tax');
		}
		
	}
	
	public function taxedit($id){
		//echo $id;
		if($this->input->post()){
					$update = array(
						'tax'=>$this->input->post('tax')
					);
			$result = $this->user->update('countries',$update,'countries_id',$this->input->post('countries_id'));		
			//$result = $this->user->update('tbl_countrywise_trail_days',$update,'id',$id);
			if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Trail Day Updated successfully.</div>');
				
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			}
			redirect('admin/tax');
		}
		//$data['tax_edit'] = $this->dashboards_model->get_trail_days_edit($id);
		$data['tax_edit'] = $this->db->get_where('countries',array('status'=>'1','tax >'=>0,'countries_id'=>$id))->row_array();
		//echo $this->db->last_query(); exit;
		$data['trail_days'] = $this->dashboards_model->get_trail_days();
		$data['country'] = $this->db->get_where('countries',array('status'=>'1'))->result_array(); 
		$this->load->frontAdmin('admin/tax',$data);
		
	}
	
	public function taxdelete($id){
		// we can not delete the row of tax because it will delete country too....
		$update['tax'] = "";
		$result = $this->user->update('countries',$update,'countries_id',$id); 
		// echo $this->db->last_query();die;
		if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Trail Day Deleted successfully.</div>');
				redirect('admin/tax');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/tax');
			}
	}




public function showBill(){
	$uid 	= $this->session->userdata('logged_in')['id'];
	$urole  = $this->session->userdata('logged_in')['role'];
	   	
	$idd =  $this->input->post('idd');
	$type =  $this->input->post('type');
	// echo $idd.'***'. $type;die;
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
	   	}elseif($type=='Advertisment'){
	   		$dataArray = $this->dashboards_model->receipt_advs($idd);
	   		// echo'<pre>';print_r($dataArray);
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
	   	}elseif($type=='Course'){
			$dataArray = $this->dashboards_model->receipt_courses($idd);
			// echo'<pre>';print_r($dataArray);
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
	   	}elseif($type=='Promotionscp'){
			$dataArray = $this->dashboards_model->receipt_promotionscp($idd);
			// echo'<pre>';print_r($dataArray);
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
		}elseif($type=='Promotionstp'){
			$dataArray = $this->dashboards_model->receipt_promotionstp($idd);
			// echo'<pre>';print_r($dataArray);
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
		}elseif($type=='Certificate'){
			$dataArray = $this->dashboards_model->receipt_certificate($idd);
			// echo'<pre>';print_r($dataArray);
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
			$returnarray['txn_id'] 			= $dataArray['transaction_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		}elseif($type=='Staff'){ //staff
			$dataArray = $this->dashboards_model->receipt_staff($idd);
			// echo'<pre>';print_r($dataArray);
			$returnarray = array();
				$json 		  = json_decode($dataArray['transaction_details']);
				$price 		  = round($json->payment_gross);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= 'Staff Payment';
			$returnarray['username'] 		= $dataArray['username'];
			$returnarray['countries_name'] 	= $dataArray['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		}else{  //$type == Pcems
			$dataArray = $this->dashboards_model->receipt_pcems($idd);
			// echo'<pre>';print_r($dataArray);
			  $returnarray = array();
				$price 		  = round($dataArray['payment_amount']);
				$tax 		  = round((($price)*5)/100);
        		$unitPrice1   = $price - round($tax);
        		$paypalCharge = round(($unitPrice1*5)/100);
        		$netprice 	  = round($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray['payment_date']));
			$returnarray['course_title'] 	= $dataArray['course_title'];
			$returnarray['username'] 		= $dataArray['username'];
			$returnarray['countries_name'] 	= $dataArray['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $dataArray['payment_transtion_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		}
	   // print_r($data['purchase_details'][0]);		
	$this->load->view('admin/receipt',$data);
}

	public function faq($id=false)
	{	
		$data['faq_list'] = $this->dashboards_model->get_faq_list();
		if($this->input->post()){
			// print_r($this->input->post());die;
			if($this->input->post('id')){
				// $insert['id'] = $this->input->post('id');
				$insert['updated_at'] = date('Y-m-d');
			}else{
				$insert['added_on']   = date('Y-m-d');
			}

			$insert['role']  		= $this->input->post('role');
			$insert['question']  	= $this->input->post('question');
			$insert['answer']  		= $this->input->post('answer');
			$insert['status']  		= 1;
			
			// print_r($insert);die;
			if($this->input->post('id')){	
				$updated = $this->user->update('tbl_faq',$insert,'id',$this->input->post('id')); 
				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-success">Record added successfully.</div>');
				$inserted	=	$this->user->save('tbl_faq',$insert);
			}
			redirect('admin/faq', 'refresh');
		}
		if($id){ 
		$data['edit'] = $this->db->get_where('tbl_faq',array('id'=>$id,'status'=>'1'))->row_array();
		}
		$this->load->frontAdmin('admin/faq',$data);
	}

	public function faq_delete($id)
	{
		$result = $this->user->delete('tbl_faq','id',$id);
		if($result){
		$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">FAQ Deleted successfully.</div>');
		redirect('admin/faq', 'refresh');
		}else{
		$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		redirect('admin/faq', 'refresh');
		}
	}


	public function faq_search()
	{
		if($this->input->post('submit')=='Search'){
			$data['faq_list'] = $this->dashboards_model->get_faq_list();
			$this->load->frontAdmin('admin/faq',$data);
		}else{
			redirect('admin/faq', 'refresh');
		}
	}

	public function login_backend($id = false){

		$data['category'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1); 
		$data['login_backend_list'] = $this->dashboards_model->get_all_login_backend(); 
		$uid 	= $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');  
		$this->form_validation->set_rules('sub_title', 'Sub-Title', 'trim|required');  
		$this->form_validation->set_rules('profession', 'Profession', 'trim|required');   
		// $this->form_validation->set_rules('profession', 'Profession', 'trim|required|is_unique[tbl_login_backend.profession_id]');   
			 
		if($this->form_validation->run() == FALSE){	
			if($id){
				$data['lb_row'] = $this->db->get_where('tbl_login_backend',array('id'=>$id))->row_array(); 
			}

		}else{
			$this->load->library('upload');

			if(isset($_FILES["background_image"]) && !empty($_FILES["background_image"]['name']))
			{
	            $config['upload_path'] = './assets/upload/login_backend';
	            $config['allowed_types'] = 'gif|jpg|png|jpeg';
	            // $config['max_size'] = '200000';
	            // $config['max_width']  = '15000';
	            // $config['max_height']  = '8000';        
	            $ext = explode('.',$_FILES["background_image"]["name"]);        
	            $imageName = 'lb_'.time().'.'.end($ext);
	            $config['file_name'] = $imageName;
		        $this->upload->initialize($config);
		        if ( ! $this->upload->do_upload('background_image'))
		        {
		        	$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'. $this->upload->display_errors().'</div>');
		        	redirect('admin/login_backend');  exit;                 
		        }  
	            	$insert['background_image']  =  $imageName;
	        }
	        // print_r($this->input->post());die;
				$insert['title'] 			= 	$this->input->post('title');
				$insert['sub_title']		=	$this->input->post('sub_title');
				$insert['profession_id'] 	=	$this->input->post('profession');
				$insert['status'] 			=	$this->input->post('status');
				$insert['added_by'] 		=	$uid;

				if($this->input->post('lbid') > 0){
					$insert['updated_at'] 		=	date('Y-m-d');
					$inserted = $this->user->update('tbl_login_backend',$insert,'id',$this->input->post('lbid')); 
					// echo $this->db->last_query();
				}else{
					$insert['added_on'] 		=	date('Y-m-d');
					$inserted	=	$this->user->save('tbl_login_backend',$insert);
				}
			// echo $this->db->last_query();die;
			if($inserted){
				if($this->input->post('lbid') > 0){
					$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Login backend Details successfully Updated in the list.</div>');
					redirect('admin/login_backend', 'refresh');die;
				}else{
					$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Login backend Details successfully Added in the list.</div>');
					redirect('admin/login_backend', 'refresh');die;
				}

			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			}
		}
			$this->load->frontAdmin('admin/login_backend',$data);
	}	

	public function login_backend_delete($id){
		$result = $this->user->delete('tbl_login_backend','id',$id);
		if($result){
		$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Data Deleted successfully.</div>');
		}else{
		$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		}
		redirect('admin/login_backend', 'refresh');
	}


	public function client_invoice()
	{ 
		$data['client_invoice_list'] = $this->db->get('tbl_client_invoice')->result_array();
		$data['country_list'] = $this->db->get_where('countries',array('status'=>1))->result();
		$this->load->frontAdmin('admin/client_invoice',$data);
	}	

	public function add_client_invoice(){
		// print_r($this->input->post());die;
			$invoice_number =  $this->get_invoice_number();
			// $invoice_number =  '01-'.date('Y');
			// echo $invoice_number;die;
			$add = array(
				'invoice_number' => $invoice_number,
				'amount' 		 => $this->input->post('total_amount'),
				'tax' 		 	 => $this->input->post('tax'),
				'sub_total' 	 => $this->input->post('sub_total'),
				// 'tax_p' 		 => $this->input->post('tax_p'),
				'discount' 		 => $this->input->post('discount'),
				'date' 			 => $this->input->post('date'),
				'recipient' 	 => $this->input->post('recipient'),
				'company_name' 	 => $this->input->post('company_name'),
				'position' 	 	 => $this->input->post('position'),
				'address' 	 	 => $this->input->post('address'),
				'phone' 	 	 => $this->input->post('phone'),
				'due_date' 	 	 => $this->input->post('due_date'),
				'issued_to' 	 => $this->input->post('issued_to'),
				'added_on' 		 => date('Y-m-d'),
				'status' 		 => 0
				); 
			$result = $this->user->save('tbl_client_invoice',$add);	
			if($result){
				$count = count($this->input->post('item_description'));
				
				for($i = 1; $i <= $count; $i++){
				$additems = array(
					'invoice_number' => $invoice_number,
					'ci_id' 		 => $result,
					'item_description'=> $this->input->post('item_description')[$i],
					'unit' 	 		 => $this->input->post('unit')[$i],
					'unit_price' 	 => $this->input->post('unit_price')[$i],
					'quantity' 	 	 => $this->input->post('quantity')[$i],
					'amount' 	 	 => $this->input->post('amount')[$i],
					'added_on' 		 => date('Y-m-d'),
					'status' 		 => 1
				); 
				$res = $this->user->save('tbl_invoice_item_description',$additems);
				}	
			
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Invoice created successfully.</div>');
				}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				}
			redirect('admin/client_invoice');
	}

	public function edit_client_invoice(){
			$update = array(
				'amount' 		 => $this->input->post('total_amount'),
				// 'sub_total' 	 => $this->input->post('sub_total'),
				// 'tax' 		 => $this->input->post('tax'),
				// 'tax_p' 		 => $this->input->post('tax_p'),
				// 'discount' 		 => $this->input->post('discount'),
				'date' 			 => $this->input->post('date'),
				'recipient' 	 => $this->input->post('recipient'),
				'company_name' 	 => $this->input->post('company_name'),
				'position' 	 	 => $this->input->post('position'),
				'address' 	 	 => $this->input->post('address'),
				'phone' 	 	 => $this->input->post('phone'),
				'due_date' 	 	 => $this->input->post('due_date'),
				'issued_to' 	 => $this->input->post('issued_to'),
				'updated_at' 	 => date('Y-m-d')
				); 
			$result = $this->user->update('tbl_client_invoice',$update,'id',$this->input->post('client_invoice_id')); 
			if($result){
				$count = count($this->input->post('item_description'));
				
				for($i = 1; $i <= $count; $i++){
				$updateitems = array(
					'item_description'=> $this->input->post('item_description')[$i],
					'unit' 	 		 => $this->input->post('unit')[$i],
					'unit_price' 	 => $this->input->post('unit_price')[$i],
					'quantity' 	 	 => $this->input->post('quantity')[$i],
					'amount' 	 	 => $this->input->post('amount')[$i],
					'updated_at'     => date('Y-m-d')
				); 
				$res = $this->user->update('tbl_invoice_item_description',$updateitems,'id',$this->input->post('item_id')[$i]);
				}	
			
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Invoice updated successfully.</div>');
				}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				}
			redirect('admin/client_invoice');
	}

	private function get_invoice_number(){
		
		$this->db->order_by('id','DESC');
		$query = $this->db->get('tbl_client_invoice')->row();
		if($query){
			$appArr = explode('-',$query->invoice_number);
			$invoice_number = sprintf('%05d',$appArr[0]+1);
		}else{
			$invoice_number = sprintf('%05d',1);
		}	
		$invoice_no = $invoice_number.'-'.date('Y');
		return $invoice_no;
	}

	public function client_invoice_change_status(){
		$update = array(
			'date_paid' => $this->input->post('set_paid_date'),
			'status' => 1
		);
		$result = $this->user->update('tbl_client_invoice',$update,'id',$this->input->post('client_invoice_id')); 
		
		if($result){
		$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Paid successfully.</div>');
		}else{
		$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		}
		redirect('admin/client_invoice');
	}

	public function get_client_invoice(){
		$id = $this->input->post('id');
		$data['invoice'] = $this->db->get_where('tbl_client_invoice',array('id'=>$id))->row();
		$data['items'] = $this->db->get_where('tbl_invoice_item_description',array('ci_id'=>$id))->result();
		return $this->load->view('admin/view_invoice',$data);
	}

	public function get_client_receipt(){
		$id = $this->input->post('id');
		$data['invoice'] = $this->db->get_where('tbl_client_invoice',array('id'=>$id))->row();
		$data['items'] = $this->db->get_where('tbl_invoice_item_description',array('ci_id'=>$id))->result();
		return $this->load->view('admin/view_receipt',$data);
	}

	public function delete_client_invoice($id){
		$result = $this->user->delete('tbl_client_invoice','id',$id);
		if($result){
			$this->user->delete('tbl_invoice_item_description','ci_id',$id);
			$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Invoice and items deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		}
			redirect('admin/client_invoice', 'refresh');
	}

	public function delete_invoice_item($id){
		$result = $this->user->delete('tbl_invoice_item_description','id',$id);
		if($result){
			echo 'Items deleted successfully.';
		}else{
			echo 'There is some error please try again.';
		}
	}

	public function send_invoice_mail(){
		$to = $this->input->post('to');
		$subject = $this->input->post('subject');
		$content = $this->input->post('content');
		if($this->sendMail($to,$subject,$content)){
			echo 'Mail sent';
		}else{
			echo 'Something went wrong please try again!';
		}
	}

	public function get_one_invoice(){
		$id = $this->input->post('id');
		$data['invoice'] = $this->db->get_where('tbl_client_invoice',array('id'=>$id))->row();
		$data['items'] = $this->db->get_where('tbl_invoice_item_description',array('ci_id'=>$id))->result();
		echo json_encode($data);
	}

	function resetpassword(){
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$bytes 		= random_bytes(5); 
		$newpassword = bin2hex($bytes);  	 
		$data['password'] = md5($newpassword); 
		$result = $this->user->update('tbl_user',$data,'id',$id); 
		if($result){
			$content = array('name'=>$name,'email'=>$email,'password'=>$newpassword);
			$this->sendMail($email,'Password Reset',$this->load->view('email/password_reset',$content,true));
			echo '<script> alert("New Password Genrated Successfully and sent to the user\'s email.");
			window.location.href="'.base_url('admin/users').'";
			</script>';
		}
	}

	function softDelete(){
		$id 	= $this->input->post('id');
		$name 	= $this->input->post('name');
		$email 	= $this->input->post('email');  
		$adminid = $this->session->userdata('logged_in')['id'];	 
		$data['status'] 	 = 0; 
		$data['disabled_by'] = $adminid; 
		$data['soft_delete'] = 'y'; 
		$result = $this->user->update('tbl_user',$data,'id',$id); 
		if($result){
			$content = array('name'=>$name,'email'=>$email);
			// $this->sendMail($email,'Password Reset',$this->load->view('email/account_deleted',$content,true));
			echo '<script> alert("Account deleted Successfully.");
			window.location.href="'.base_url('admin/users').'";
			</script>';
		}
	}

	
	public function ice_subscription_package()
	{ 
		$data['package_list'] = $this->ice_model->get_ice_subscription_package();
		$this->load->frontAdmin('admin/ice_subscription/package_listing',$data);
	}	
	
	public function add_subscription_package()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('ice_pakage_name', 'Package Name', 'trim|required');  
		$this->form_validation->set_rules('num_of_staff', 'Number of Staff', 'trim|required');  
		$this->form_validation->set_rules('amount', 'Package Amount', 'trim|required');  
		$this->form_validation->set_rules('ice_package_for', 'Package For', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$data['package_list'] = $this->ice_model->get_ice_subscription_package();
			$this->load->frontAdmin('admin/ice_subscription/package_listing',$data);

		}  else { 
			$post = $this->input->post();   
		    $result = $this->ice_model->add_subscription_package($post); 
			if($result > 0){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Package added.</div>');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			} 
			redirect('admin/ice_subscription_package');
		}
	}

	public function delete_subscription_package($id){
		
		$uid = $this->session->userdata('logged_in')['id'];
		$this->db->where('created_by',$uid);
		$result = $this->user->delete('ice_subscription_package','ice_id',$id);
		if($result){
			$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Package deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		}
			redirect('admin/ice_subscription_package', 'refresh');
	}

	
	public function get_one_package(){
		$id = $this->input->post('id');
		$data['package'] = $this->ice_model->get_ice_one_subscription_package($id);
		echo json_encode($data);
	}
	
	
	public function accreditation_list()
	{
		$data['list'] = $this->users_model->get_accredition_list();
		$this->load->frontAdmin('admin/accreditation_listing',$data);
	}
	
	public function manualAccreditation()
	{
		$where = array('aid'=>$_POST['id']);
		$data = array('status'=>$_POST['status']);
		$result = $this->accapi->updateCepAccreditation($where,$data);
		if($result != ''){
			$this->session->set_flashdata('response','<div class="alert alert-success">Accreditation successfully updated.</div>');
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">There is some error please try again.</div>');
		}
			redirect('admin/accreditation_list', 'refresh');
	}
	
	public function verifingAccreditationDoc($tid,$pid)
	{
		$getdata = $this->provider_model->getAccreditationVerificationLog($tid,$pid);
		if(!empty($getdata)):
			$result = $this->provider_model->updateAccreditationVerificationLog($getdata['avl_id']);
			
			if($result):
				$this->provider_model->publishTrainingAccreditationVerification($tid);
				$this->session->set_flashdata('response','<div class="alert alert-success">Accreditation verification doc verified successfully.</div>');
			else:
				$this->session->set_flashdata('response','<div class="alert alert-danger">There is some error please try again.</div>');
			endif;
		else:
			$this->session->set_flashdata('response','<div class="alert alert-danger">No doc found!</div>');
		endif;
			redirect('admin/training_center_list', 'refresh');
	}
	
	public function verifingAccreditationCODoc($cid,$pid)
	{
		$getdata = $this->provider_model->getAccreditationVerificationLog($cid,$pid);
		if(!empty($getdata)):
			$result = $this->provider_model->updateAccreditationVerificationLog($getdata['avl_id']);
			
			if($result):
				$this->provider_model->publishCourseAccreditationVerification($cid);
				$this->session->set_flashdata('response','<div class="alert alert-success">Accreditation verification doc verified successfully.</div>');
			else:
				$this->session->set_flashdata('response','<div class="alert alert-danger">There is some error please try again.</div>');
			endif;
		else:
			$this->session->set_flashdata('response','<div class="alert alert-danger">No doc found!</div>');
		endif;
			redirect('admin/training_center_list', 'refresh');
	}
	
	public function banner(){
		$this->data = array(
			'title' => 'Banner',
			'page_title' => 'Banner Listing',
			'table_name' => ''
		);
		$this->data['cmss'] = $this->user->get_banner_list();
		$this->load->frontAdmin('admin/banner',$this->data);
	}

	public function bannerdelete($b_id){
		$this->user->delete('tbl_banner','bnr_id',$b_id);
		
		$this->session->set_flashdata('response', '<div class="alert alert-success">Banner deleted successfully</div>');
		redirect('admin/banner');
	}

	public function banneredit($id = false){
		$this->data = array(
			'title' => 'Banner Edit',
			'page_title' => 'Banner ',
			'table_name' => ''
		);
		if($this->input->post()) {
			$banner = '';
			if(isset($_FILES["banner"]) && !empty($_FILES["banner"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/images/banner/';
				$config['allowed_types'] 	= '*';      
				$ext 						= explode('.',$_FILES["banner"]["name"]);        
				$banner 					= 'banner_'.time().'.'.end($ext);
				$config['file_name'] 		= $banner;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('banner'))
				{
				$error = array('error' => $this->upload->display_errors());   
				}  
				$banner = $banner;
			}else{
				$banner = $this->input->post('old_banner');
			}
			
			
			if($this->input->post('bnr_id')) {
				$data['bnr_id'] = $this->input->post('bnr_id');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			$data['title']  			= $this->input->post('title');
			$data['sub_title']  		= $this->input->post('sub_title');
			$data['display_position']  	= $this->input->post('display_position');
			$data['banner']				= $banner;
			$data['bnr_status']			= $this->input->post('bnr_status');
			
			if($this->input->post('bnr_id')) {
				$updated = $this->user->update_banner($data, $this->input->post('bnr_id')); 
				 if($updated) { 
					$this->session->set_flashdata('response', '<div class="alert alert-success">Record updated successfully</div>');
				} else {
					 $this->session->set_flashdata('response', '<div class="alert alert-danger">please try again!</div>');
				 }
			} else {
				$inserted	=	$this->user->insert_banner($data);
			}
			
            redirect(base_url('admin/banner'), 'refresh');
		}
		
		if($id) {
			$this->data['cms'] = $this->user->get_one_banner($id);
			
            if(!$this->data['cms']) {
                redirect('admin/banner', 'refresh');
			}
		} else {

		}
		
		$this->load->frontAdmin('admin/banneredit',$this->data);
	}
}
