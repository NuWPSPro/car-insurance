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
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error pl