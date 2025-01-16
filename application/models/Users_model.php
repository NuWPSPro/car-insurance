<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
	
	public function  __construct()
	{
		parent::__construct();
		$this->userTbl 		= 'tbl_user';
		$this->courseTbl 	= 'tbl_course';
		$this->countriesTbl 	= 'countries';
		$this->trainingTbl 	= 'tbl_training';
		$this->pcemsPlanTbl = 'tbl_professional_plan';
		$this->blogTbl 		= 'tbl_blog';
		$this->providerSetTargetTbl  = 'tbl_provider_set_target';
		$this->paymentTransactionTbl = 'tbl_payment_transaction';
		$this->allTaxTbl = 'tbl_all_tax';
		$this->userCertificate = 'tbl_user_certificate';
		$this->certificateTemplate = 'tbl_certificate_template';
		$this->bannerTbl = 'tbl_banner';
	}

	public function get_all_published_insurance_sale()
	{
		$name = isset($_GET['name'])?$_GET['name']:'';
		$ins_type = isset($_GET['insurance_type'])?$_GET['insurance_type']:'';
		$range = isset($_GET['range'])?$_GET['range']:'';
		$company = isset($_GET['company'])?$_GET['company']:'';

		$this->db->select('i.*,i.id insur_id,i.user_id broker_id,i.author_reference_id company_id,u.fname, u.lname, u.name, ci.name company_name');
		$this->db->from($this->courseTbl.' i');
		$this->db->join($this->userTbl.' u','u.id = i.user_id');
		$this->db->join($this->userTbl.' ci','ci.id = i.author_reference_id');
		$this->db->where('i.status',1);

		if($name!=''){
			$this->db->like('i.course_title',$name);
		}

		if($ins_type!=''){
			$this->db->where('i.insurance_type',$ins_type);
		}

		if($range!=''){
			if($range =='lt10'){
				$this->db->where('i.price <',10);
			}
			if($range =='gt10'){
				$this->db->where('i.price >',10);
			}
		}

		if($company!=''){
			$this->db->where('i.author_reference_id',$company);
		}
		$this->db->order_by('i.id','desc');
		$q = $this->db->get();
		$result = $q->result_array();
		return $result;
	}

	function getCarInsuranceCompany(){
		$this->db->where('role','2');
		$this->db->where('status',1);
		$this->db->order_by('name','ASC');
		return $this->db->get('tbl_user')->result_array();
	}

	function update_banner($data, $id = false){
		if($id){
			$this->db->where('bnr_id', $id);
		}
		//$this->db->set($data);
		return $this->db->update($this->bannerTbl, $data);
		// echo $this->db->last_query(); die;
	}
	function insert_banner($data){
		$this->db->set($data);
		$this->db->insert($this->bannerTbl);
		//echo $this->db->last_query(); die;
		return true;
	}
	function get_one_banner($id = false){
		$this->db->select('*');
		$this->db->from($this->bannerTbl);
		if($id){
			$this->db->where('bnr_id', $id);
		}
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}
	function get_banner_list(){
		$this->db->select('*');
		$this->db->from($this->bannerTbl);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function get_active_banner_list(){
		$this->db->select('*');
		$this->db->from($this->bannerTbl);
		$this->db->where('bnr_status','1');
		$this->db->order_by('display_position','ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	function get_countries()
	{
		return $this->db->select('countries_id,countries_name')->where('status',1)->order_by('countries_name','ASC')->get('countries')->result_array();
	}	

	function get_languages()
	{
		return $this->db->where('status',1)->get('tbl_languages')->result();
	}

	function get_all_languages()
	{
		return $this->db->get('tbl_languages')->result();
	}	

	function get_active_languages()
	{
		return $this->db->where('delete_flag',0)->get('tbl_languages')->result();
	}	

	function get_languages_name($lang_id)
	{
		return $this->db->where('id',$lang_id)->get('tbl_languages')->row()->name;
	}	


	function save($tbl_name,$data)
	{
		$this->db->insert($tbl_name,$data);
		// echo $this->db->last_query();die();
		return $this->db->insert_id();
	}


	function save1($tbl_name,$data)
	{
		$this->db->insert($tbl_name,$data);
		//echo $this->db->last_query();die();
		return $this->db->insert_id();
	}
	function insertcertificate($tbl_name,$insert)
	{
		// print_r($insert);die;		// $this->db->set($insert);
		$this->db->insert($tbl_name,$insert);
		// echo $this->db->last_query();die();
		// return $result;
		return $this->db->insert_id();
	}


	function update($tbl_name,$data,$where,$whereval)
	{
		$this->db->where($where,$whereval);
		$res = $this->db->update($tbl_name,$data);  
		//echo $this->db->last_query();die();
		
		if($res){
			return true;
		} else {
			return false;
		}

	}





	public function getusetdetails($table,$colum,$findvalue){ 
			$this->db->select('*'); 
			$this->db->from($table);
			$this->db->where($colum,$findvalue);
			$query = $this->db->get();
			$result = $query->row_object();
			//echo $this->db->last_query();
			return $result;
		}



	function updatemultiplecond($tbl_name,$data,$cond)
	{
		$this->db->where($cond);
	    $this->db->update($tbl_name,$data);  
		if($this->db->affected_rows()){
			return true;
		} else {
			return false;
		}

	}


	function delete($tbl_name,$where,$whereval)
	{
		$this->db->where($where, $whereval);
        $res = $this->db->delete($tbl_name);  
        // echo $this->db->last_query();die;
		if($res){
			return true;
		} else {
			return false;
		}
	}

	function get_miscellaneous()
	{
		return $this->db->get('tbl_site_contact')->row_array();
	}

	function get_testimonial()
	{
		return $this->db->get('tbl_testimonial')->result_array();
	}
	function get_enquiry()
	{
		return $this->db->order_by('id','desc')->get('tbl_enquiry')->result_array();
	}
	function get_notification()
	{
		return $this->db->order_by('id','desc')->get('tbl_notification')->result_array();
	}
	function get_record_by_field_name($tbl_name,$where,$whereval)
	{
		return $this->db->where($where,$whereval)->get($tbl_name)->row_array();
	} 
	
	function get_templete_all_record($tbl_name,$where,$whereval)
	{
		$datas = $this->db->where($where,$whereval)->get($tbl_name)->result();
		// echo"<pre>"; print_r($datas);die;
		// echo $this->db->last_query(); die;
		return $datas;		
	}
	function get_record_by_field_name_all_record($tbl_name,$where,$whereval)
	{
		$datas = $this->db->where($where,$whereval)->get($tbl_name)->result_array();
		// echo $this->db->last_query(); die;
		return $datas;		
	}
	function get_record_by_field_name_all_record_filter($tbl_name,$filterdata)
	{
		$datas = $this->db->where($filterdata)->get($tbl_name)->result_array();
		// echo $this->db->last_query(); die;
		return $datas;		
	}

	
	function get_user_record($tbl_name,$where,$whereval)
	{
		$datas = $this->db->where($where,$whereval)->get($tbl_name)->row_object();
		//echo $this->db->last_query(); die;
		return $datas;		
	}	


	function get_record_by_field_name_all_record111($tbl_name,$where,$whereval)
	{
		$datas = $this->db->where($where,$whereval)->get($tbl_name)->result_array();
		//echo $this->db->last_query(); die;
		return $datas;		
	}	




	function get_record_by_multi_field_name($tbl_name,$where)
	{
		$datas = $this->db->where($where)->get($tbl_name)->result_array();
		//echo $this->db->last_query(); die;
		return $datas;		
	}	


	function get_record_by_field_name_all_record11($tbl_name,$where)
	{
		$datas = $this->db->where($where)->get($tbl_name)->result_array();
	    //echo $this->db->last_query(); die;
	    return $datas;		
	}	


function get_reciepient($tid)
	{
		$this->db->select('*');
		$this->db->from('tbl_training_book');   
		$this->db->where('training_seminar_id',$tid);  
		$this->db->where('certificate_id',NULL);  
		$this->db->where('present_status',1);   
		$query = $this->db->get();
		$data = $query->result_array();  
		return $data;	
	}



function get_latest_training_date($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_provider_set_target_date');   
		$this->db->where('user_id',$uid);  
		$this->db->order_by('id','desc');
		$this->db->limit(1, 0);  
		//$this->db->where('present_status',1);   
		$query = $this->db->get();
		$data = $query->result_array();  
		//echo $this->db->last_query(); die;
		return $data;	
	}

 

 function getspeakers($tbl_name,$where,$whereval)
	{
		$limit = 4;
		$start = 0;
		$this->db->select('*');
		$this->db->from($tbl_name);   
		$this->db->where($where, $whereval); 
		//$this->db->limit($limit, $start);
		$this->db->order_by('position_order','ASC');
		$query = $this->db->get();
		$data = $query->result_array();  
		  
		return $data;	
	}



function getuniqecomments($tbl_name,$where)
	{
		$this->db->select('*');
		$this->db->from($tbl_name);   
		$this->db->where($where);    
		$this->db->group_by('comments');    
		$query = $this->db->get();
		
		$data = $query->result_array();  
		//echo $this->db->last_query(); die;
		return $data;	
	}



	function getschedule($tid)
	{
		$this->db->select('*');
		$this->db->from('tbl_training_schedule');   
		$this->db->where('training_id',$tid);  
		$this->db->group_by('schedule_date'); 
		$query = $this->db->get();
		$data = $query->result_array();  
		//echo $this->db->last_query(); die;
		return $data;	
	}



	function purchased_plan()
	{
		$uid = $this->session->userdata('logged_in')['id']; 

		$this->db->select('*');
		$this->db->from('tbl_adv_package_purchased');   
		$this->db->where('user_id',$uid);    
		$this->db->where('used_status',1);    
		$query = $this->db->get();
		$data = $query->result_array();  
		//echo $this->db->last_query(); die;
		return $data;	
	}


	


	function getscheduleAll($tid,$dt)
	{
		$this->db->select('*');
		$this->db->from('tbl_training_schedule');   
		$this->db->where('training_id',$tid);  
		$this->db->where('schedule_date',$dt);  
		//$this->db->group_by('schedule_date'); 
		$query = $this->db->get();
		$data = $query->result_array();  
		//echo $this->db->last_query(); die;
		return $data;	
	}



	function get_record_by_field_name_all_record_limit($tbl_name,$where,$whereval)
	{
		$limit = 4;
		$start = 0;
		$this->db->select('*');
		$this->db->from($tbl_name);   
		$this->db->where($where, $whereval); 
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		$data = $query->result_array();  
		  
		return $data;

		
	}


	function trainingFilter($user_id,$filter)
	{ 
		$this->db->select('*');
		$this->db->from('tbl_training');   
		$this->db->where('user_id', $user_id);  
		//$this->db->where('licence_applied', $filter);  
		$this->db->where('status', $filter);  
		$query = $this->db->get();
		$data = $query->result_array();  
		  
		return $data;
	}



	function get_record_by_field_name_all_record_order_by_id_desc($tbl_name,$where,$whereval)
	{
		$data =  $this->db->order_by('id','desc')->where($where,$whereval)->get($tbl_name)->result_array();
		//echo $this->db->last_query(); die;
		return $data;
	}

	function get_record_by_field_name_all_record_order_by_title_asc($tbl_name,$where,$whereval)
	{
		return $this->db->order_by('cat_name','ASC')->where($where,$whereval)->get($tbl_name)->result_array();
		
	}
 
	function get_record_by_field_name_all_record_delete_flag($tbl_name,$where,$whereval)
	{
		return $this->db->where($where,$whereval)->where('delete_flag',0)->get($tbl_name)->result_array();
	}



	function get_record_by_multiple_field_name_all_record($tbl_name,$cond)
	{
		return $this->db->order_by('id','desc')->where($cond)->get($tbl_name)->result_array();
	}


	function get_record_by_field_name_all_record_order_by_id_desc_page($tbl_name,$where,$whereval,$cat)
	{
		//return $this->db->order_by('id','desc')->where($where,$whereval)->get($tbl_name)->result_array();
		$this->db->select('*');
        $this->db->from($tbl_name); 
        if($cat){
        $this->db->where('course_category',$cat);
    	}
        
        $this->db->where($where, $whereval); 
        $query = $this->db->get();
        $data = $query->result_array(); 
       // echo $this->db->last_query(); die;
        return $data;
	}

   function get_courses($where)
	{
		
		$this->db->select('tbl_course.*, tbl_category.cat_name, tbl_course_promotion.added_on as Featured_from, tbl_course_promotion.no_of_day');
        $this->db->from('tbl_course'); 
		$this->db->join('tbl_category', 'tbl_course.course_category = tbl_category.id','left');
		$this->db->join('tbl_course_promotion', 'tbl_course.id = tbl_course_promotion.course_id','left');
        if(!empty($where)){
          $this->db->where($where);
    	} 
        $this->db->order_by('tbl_course_promotion.added_on','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        $data = $query->result_array(); 
      
        return $data;
	}



	 function get_courses1($user_id)
	{
		
		$this->db->select('tbl_course.*, tbl_category.cat_name');
        $this->db->from('tbl_course'); 
		$this->db->join('tbl_category', 'tbl_course.course_category = tbl_category.id',LEFT);
        //if(!empty($where)){
          $this->db->where('tbl_course.user_id',$user_id)->or_where('tbl_course.author_reference_id',$user_id);
    	//} author_reference_id
        
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        $data = $query->result_array(); 
      
        return $data;
	}


	 function get_courses_filter($user_id,$filter)
	{
		
		$this->db->select('tbl_course.*, tbl_category.cat_name');
        $this->db->from('tbl_course'); 
		$this->db->join('tbl_category', 'tbl_course.course_category = tbl_category.id',LEFT);
        //if(!empty($where)){
         
         // $this->db->where('tbl_course.user_id',$user_id)->or_where('tbl_course.author_reference_id',$user_id)->or_where('tbl_course.licence_applied',$filter);

          //$this->db->where('tbl_course.licence_applied',$filter);
          $this->db->where('tbl_course.status',$filter);
    	
          $this->db->where("(tbl_course.user_id=$user_id OR tbl_course.author_reference_id=$user_id)", NULL, FALSE);


    	//} author_reference_id
        
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        $data = $query->result_array(); 
      
        return $data;
	}


	
	function get_courses_like($where)
	{
		
		$this->db->select('tbl_course.*, tbl_category.cat_name');
        $this->db->from('tbl_course'); 
		$this->db->join('tbl_category', 'tbl_course.course_category = tbl_category.id');
      
    	if(!empty($where['course_title'])){
          $this->db->like('course_title', $where['course_title'], '%');
    	}
        
        $query = $this->db->get();
       	// echo $this->db->last_query();
        $data = $query->result_array(); 
      
        return $data;
	}

    function get_all_country()
	{ 
		$this->db->select('*');
        $this->db->from('countries'); 
        $query = $this->db->get();
        $data = $query->result_array();  
       	// echo $this->db->last_query(); die;
        return $data;
	}


	function get_record_course_by_country($tbl_name,$where)
	{ 
		$this->db->select('*');
        $this->db->from($tbl_name); 
         
        
        $this->db->where($where); 

        $query = $this->db->get();
        $data = $query->result_array();  
       // echo $this->db->last_query(); die;
        return $data;
	}

	function get_record_by_field_name_status($tbl_name)
	{
		//return $this->db->order_by('id','desc')->where($where,$whereval)->get($tbl_name)->result_array();
		$this->db->select('*');
        $this->db->from($tbl_name); 
        
        
        //$this->db->where($where, $whereval); 
        $query = $this->db->get();
        $data = $query->result_array(); 
       // echo $this->db->last_query(); die;
        return $data;
	}




	function get_record_by_field_name_all_record_order_by_id_desc_course($tbl_name,$where,$whereval,$cat)
	{
		//return $this->db->order_by('id','desc')->where($where,$whereval)->get($tbl_name)->result_array();
		$this->db->select('*');
        $this->db->from($tbl_name); 
        if($cat){
        $this->db->where('course_category',$cat);
    	}
        $this->db->where($where, $whereval); 
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        $data = $query->result_array(); 
       // echo $this->db->last_query(); die;
        return $data;
	}



	function seminarlist($tbl_name,$where,$whereval,$cat)
	{
		//return $this->db->order_by('id','desc')->where($where,$whereval)->get($tbl_name)->result_array();
		$this->db->select('*');
        $this->db->from($tbl_name); 
        
        if($cat){
        $this->db->where('course_category',$cat);
    	}
        $this->db->limit(20, 0);  
        
        $this->db->where($where, $whereval); 
        $query = $this->db->get();
        $data = $query->result_array(); 
        //echo $this->db->last_query(); die;
        return $data;
	}


	function courselisting($tbl_name,$where,$whereval,$cat)
	{
		//return $this->db->order_by('id','desc')->where($where,$whereval)->get($tbl_name)->result_array();
		$this->db->select('*');
        $this->db->from($tbl_name); 
        
        if($cat){
        $this->db->where('course_category',$cat);
    	}
        $this->db->limit(21, 0);  
        $this->db->order_by('id','desc');
        $this->db->where($where, $whereval); 
        $query = $this->db->get();
        $data = $query->result_array(); 
        //echo $this->db->last_query(); die;
        return $data;
	}



	function get_seminar($tbl_name,$where,$whereval,$date)
	{ 
		$this->db->select('*');
        $this->db->from($tbl_name); 
        $this->db->order_by('id','desc'); 
        
        if($date){
        $this->db->where('start_date',$date);
    	}
        
       // $this->db->where($where, $whereval); 
        $query = $this->db->get();
        $data = $query->result_array(); 
       // echo $this->db->last_query(); die;
        return $data;
	}


	function get_seminar11($tbl_name,$where,$whereval,$date)
	{ 
		$this->db->select('*');
        $this->db->from($tbl_name); 
        $this->db->order_by('id','desc'); 
        
        if($date){
        $this->db->where('start_date',$date);
    	}
        
        $this->db->where($where, $whereval); 
        $query = $this->db->get();
        $data = $query->result_array(); 
       // echo $this->db->last_query(); die;
        return $data;
	}
	
	
	function get_training($where)
	{ 
		$this->db->select('*');
        $this->db->from('tbl_training'); 
        
        if(!empty($where)){
        $this->db->where($where);
    	}
        $this->db->order_by('paid_status','desc');
        $query = $this->db->get();

        $data = array();
		if($query !== FALSE && $query->num_rows() > 0){
		    foreach ($query->result_array() as $row) {
		        $data[] = $row;
		    }
		}
		return $data;
	}

	function get_training_like($where)
	{ 
		$this->db->select('*');
        $this->db->from('tbl_training'); 
        $this->db->order_by('id','desc'); 
        
        if(!empty($where['title'])){
        $this->db->where('title',$where['title'],'%');
    	}
        

        $query = $this->db->get();
        $data = $query->result_array(); 
     
        return $data;
	}




	function get_seminar_category($tbl_name,$where,$whereval,$cat)
	{ 
		$this->db->select('*');
        $this->db->from($tbl_name); 
        $this->db->order_by('id','desc'); 
        
        if($cat){
        $this->db->where('category_id',$cat);
    	}
        
        $this->db->where($where, $whereval); 
        $query = $this->db->get();
        $data = $query->result_array(); 
       // echo $this->db->last_query(); die;
        return $data;
	}


	


	function get_staff($tbl_name,$cond)
	{
		return $this->db->order_by('first_name','ASC')->where($cond)->get($tbl_name)->result_array();
	}


	function get_records($tbl_name)
	{
		return $this->db->get($tbl_name)->result();
	}

	function get_records_in_array($tbl_name)
	{
		return $this->db->get($tbl_name)->result_array();
	}


	function get_training_centers($tbl_name,$filter)
	{
		
		$this->db->select('*'); 
		
		if($filter=="ongoing"){	
		  $date = date('Y-m-d');
		  $this->db->where('start_date',$date);
		}
		elseif($filter=="finished"){	
		  $date = date('Y-m-d');
		  $this->db->where('start_date < ',$date);
		}
		elseif($filter=="upcoming"){	
		   $date = date('Y-m-d');
		   $this->db->where('start_date > ',$date);
		}


		$this->db->from($tbl_name); 
		$query = $this->db->get()->result_array();
		return $query;
	}
	
	
	function getTrainingCenters($filter)
	{
		
		$this->db->select('tbl_training.*,countries.countries_name,tbl_user.name as cpname');
        $this->db->from('tbl_training');
        $this->db->join('countries', 'tbl_training.country_id = countries.countries_id','left'); 
        $this->db->join('tbl_user', 'tbl_training.user_id = tbl_user.id','left'); 
		$this->db->where('tbl_training.soft_delete','n');
        if(!empty($filter['country'])){
			$this->db->where('countries.countries_id',$filter['country']);
		}
		
		if(!empty($filter['ceprovider'])){
			$this->db->where('tbl_user.id',$filter['ceprovider']);
		}
		
		if(!empty($filter['institution'])){
			$this->db->where('tbl_training.insititution_id',$filter['institution']);
		}
		
		if(!empty($filter['date'])){
			$this->db->where('tbl_training.start_date',$filter['date']);
		}

       if($filter['status']=="ongoing"){	
		  $date = date('Y-m-d');
		  $this->db->where('tbl_training.start_date',$date);
		}elseif($filter['status']=="finished"){	
		  $date = date('Y-m-d');
		  $this->db->where('tbl_training.start_date < ',$date);
		}elseif($filter['status']=="upcoming"){	
		   $date = date('Y-m-d');
		   $this->db->where('tbl_training.start_date > ',$date);
		}elseif($filter['status']=="pending"){	
		   $this->db->where('tbl_training.status',0);
		}else{

		}
		
		$this->db->order_by('id','desc');
        $query = $this->db->get();
        return $data = $query->result_array(); 
		
		
	}

   function getCertificates($filter)
	{	
		$role = $this->session->userdata('logged_in')['role'];
		$ins_id = $this->session->userdata('logged_in')['insititution_id'];
		$this->db->select('tbl_training_book.*,
		                   tbl_training.start_date,tbl_training.title,tbl_training.units,tbl_training.insititution_id, 
		                   countries.countries_name,
						   tbl_user.name as cpname');
        $this->db->from('tbl_training_book');
        $this->db->join('tbl_training', 'tbl_training.id = tbl_training_book.training_seminar_id' ,'left'); 
		$this->db->join('countries', 'countries.countries_id = tbl_training.country_id','left'); 
        $this->db->join('tbl_user', 'tbl_user.id = tbl_training.user_id','left'); 

        if($role!=10){
        	if($role == 5){
				$this->db->where('tbl_training.insititution_id',$ins_id);
			}else{
        	$this->db->where('tbl_training_book.user_id',$this->session->userdata('logged_in')['id']);
        		}
        }

		if(!empty($filter['country']))
		{
			$this->db->where('countries.countries_id',$filter['country']);
		}
		
		if(!empty($filter['ceprovider']))
		{
			$this->db->where('tbl_user.id',$filter['ceprovider']);
		}
		
		if(!empty($filter['institution']))
		{
			$this->db->where('tbl_training.insititution_id',$filter['institution']);
		}
		
		if(!empty($filter['date']))
		{
			$this->db->where('tbl_training.start_date',$filter['date']);
		} 
		$this->db->group_start();
        $this->db->where('tbl_training_book.certificate_id !=','');
        $this->db->group_end();

        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $data = $query->result_array(); 
	}
		
		
	function getCourseCertificates($filter)
	{	
		$role = $this->session->userdata('logged_in')['role'];
		$ins_id = $this->session->userdata('logged_in')['insititution_id'];
		$this->db->select('e.*,e.added_on,c.units,c.course_title,tbl_user.insititution_id, 
		                   countries.countries_name,
						   tbl_user.name as cpname');
        $this->db->from('tbl_exam e','left');
        $this->db->join('tbl_course c', 'c.id = e.course_id', 'left'); 
        $this->db->join('tbl_user', 'tbl_user.id = e.user_id', 'left'); 
		$this->db->join('countries', 'countries.countries_id = tbl_user.country', 'left'); 

		$this->db->group_start();
        $this->db->where('e.certificate_id !=','');
        $this->db->group_end();

		if($role!=10){
			if($role == 5){
				$this->db->where('c.insititution_id',$ins_id);
			}else{
				$this->db->where('e.user_id',$this->session->userdata('logged_in')['id']);
			}
		}
		if(!empty($filter['country']))
		{
        	$this->db->where('countries.countries_id',$filter['country']);
		}
		
		if(!empty($filter['ceprovider']))
		{
			$this->db->where('tbl_user.id',$filter['ceprovider']);
		}
		
		if(!empty($filter['institution']))
		{
			$this->db->where('tbl_user.insititution_id',$filter['institution']);
		}
		
        $query = $this->db->get();
       	return $data = $query->result_array(); 
    }

	function get_all_modules()
	{
		return $this->db->get_where('tbl_permission_modules',array('status'=>1))->result();
	}
	function get_all_roles()
	{
		return $this->db->get_where('tbl_users_roles')->result();
	}
	function get_all_roles_by_user($userid)
	{
	return $this->db->order_by('role_title','ASC')->get_where('tbl_users_roles',array('member_id'=>$userid,'delete_flag'=>0))->result();
	}
	function get_all_users_by_role($role)
	{
	return $this->db->order_by('role_title','ASC')->get_where('tbl_user',array('role'=>$role))->result();
	}


	function get_record_by_multiple_field($tbl_name,$cond)
	{
		$this->db->select('*'); 
		$this->db->where($cond);
		$this->db->from($tbl_name); 
		$query = $this->db->get()->result();
		return $query;
	}	


 public function get_user_email($tbl_name,$uid,$old)
 {
	$this->db->where('id',$uid);
	$this->db->where('password',$old);
	$this->db->from($tbl_name);
	$query = $this->db->get()->row();
		return $query;
 }



function login($username, $password,$check=null)

	{

		if($check==1)
		{
		$query = $this -> db -> query("SELECT * FROM `tbl_user` WHERE password = '".$password."' AND (username_email = '$username') AND status=1 LIMIT 1");
		} else {
		$query = $this -> db -> query("SELECT * FROM `tbl_user` WHERE password = '".MD5($password)."' AND (username_email = '$username') AND status=1 LIMIT 1");
		}
		//echo $this -> db->last_query();
		//die();
		if($query -> num_rows() == 1){ return $query->row_array(); } else { return false; }
	}
	function login_for_id($user_id,$check=null)

	{

		if($check==1)
		{
		$query = $this -> db -> query("SELECT * FROM `tbl_user` WHERE  id = '$user_id' AND status=1 LIMIT 1");
		} else {
		$query = $this -> db -> query("SELECT * FROM `tbl_user` WHERE id = '$user_id' AND status=1 LIMIT 1");
		}
		//echo $this -> db->last_query();
		//die();
		if($query -> num_rows() == 1){ return $query->row_array(); } else { return false; }
	}

 

 	function get_lesson($uid)
	{
  	   $this->db->select('tbl_course.course_title,tbl_lesson.*');
        $this->db->from('tbl_lesson');
        $this->db->join('tbl_course', 'tbl_course.id = tbl_lesson.course_id'); 
        $this->db->where('tbl_lesson.status ', 1);
        $this->db->where('tbl_lesson.user_id ', $uid); 
        $query = $this->db->get();
        return $data = $query->result_array(); 
	}

	// function get_lesson_by_course($uid)
	// {
 //  	   $this->db->select('tbl_course.course_title,tbl_lesson.*');
 //        $this->db->from('tbl_lesson');
 //        $this->db->join('tbl_course', 'tbl_course.id = tbl_lesson.course_id'); 
 //        $this->db->where('tbl_lesson.status ', 1);
 //        $this->db->where('tbl_lesson.user_id ', $uid); 
 //        $query = $this->db->get();
 //        return $data = $query->result_array(); 
	// }

	function get_course($uid,$filter= false)
	{

  	    $this->db->select('tbl_course.*,tbl_user.name,');
        $this->db->from('tbl_course');
        $this->db->join('tbl_user', 'tbl_course.user_id = tbl_user.id');  
        $this->db->where('tbl_course.user_id ', $uid);
		if($filter == '1'){
			$this->db->where('tbl_course.status','1');
		}
		if($filter == '2'){
			$this->db->where('tbl_course.status','0');
		}
		if($filter == '3'){
			$this->db->where('tbl_course.status','3');
		}		
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        $data = $query->result_array(); 
		//echo $this->db->last_query(); die;
		return $data;
	}

	function get_all_course($filter){

  	    $this->db->select('tbl_course.*, tbl_user.name, tbl_user.address, c.countries_name');
        $this->db->from('tbl_course');
        $this->db->join('tbl_user', 'tbl_course.user_id = tbl_user.id','left');
        $this->db->join('countries c', 'c.countries_id = tbl_course.country_id','left'); 
		$this->db->where('tbl_course.soft_delete','n'); 
		
        if(!empty($filter['country'])){
			$this->db->where('c.countries_id',$filter['country']);
		}
		
		if(!empty($filter['ceprovider'])){
			$this->db->where('tbl_user.id',$filter['ceprovider']);
		}		
		 
		if(!empty($filter['institution'])){
			$this->db->where('tbl_course.insititution_id',$filter['institution']);
		} 
		 
        if(!empty($filter['date'])){
			$this->db->where('tbl_course.added_on', date('Y-m-d',strtotime($filter['date']))); 
		}			
      
        $query = $this->db->get();
        $data = $query->result_array(); 
		// echo $this->db->last_query();die;
		return $data;
	}
	


	function get_users()
	{
  	    $this->db->select('u.*,c.countries_name');
        $this->db->from('tbl_user u'); 
		$this->db->join('countries c','u.country=c.countries_id','left');
        $query = $this->db->get();
        $data = $query->result_array();  
		return $data;
	}



	

	function get_users_by_role($role)
	{
  	    $this->db->select('');
        $this->db->from('tbl_user'); 
        $this->db->where('tbl_user.role', $role);
        $query = $this->db->get();
        $data = $query->result_array();  
		return $data;
	}



	function get_users_by_role_profession($role,$profession)
	{
  	   $this->db->select('u.*,c.countries_name');
       $this->db->from('tbl_user u'); 
		$this->db->join('countries c','u.country=c.countries_id','left');
        $this->db->where('u.role', $role);
        if($profession !=""){
          $this->db->where('u.profession', $profession);
        }

        $query = $this->db->get();
        $data = $query->result_array();  
		return $data;
	}


	
	
	function get_exam_detail($cid,$uid)
	{

		$passing_marks = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();
		if(!empty($passing_marks)){

  	    $this->db->select('*');
        $this->db->from('tbl_exam'); 
        $this->db->where('user_id', $uid);
        $this->db->where('course_id', $cid);
        $this->db->where('archive','1');
        $this->db->where('percentages >=', $passing_marks['passing_marks']);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        $data = $query->result_array(); 
        // echo '<pre>';	print_r($data);
		return $data;
	  }
	}





function getpay($month,$year)
	{
		$uid = $this->session->userdata('logged_in')['id'];

  	    //$this->db->select('');quantity
  	    $this->db->select('tbl_purchase_llis.quantity,tbl_purchase_llis.user_id,tbl_purchase_llis.item_name,tbl_purchase_llis.amount,tbl_purchase_llis.txn_id,tbl_purchase_llis.txn_status,tbl_purchase_llis.added_on as added,tbl_course.*');
        $this->db->from('tbl_purchase_llis'); 
        //$this->db->where('user_id', $uid);

			$this->db->join('tbl_course', 'tbl_purchase_llis.item_name = tbl_course.id');
			//$this->db->where('tbl_course.user_id', $uid);


		if($month==""){

			$strtdate = $year.'-'.'01'.'-'.'01';
			$enddate  = $year.'-'.'12'.'-'.'31';

			$this->db->where('tbl_purchase_llis.added_on >',$strtdate);
			$this->db->where('tbl_purchase_llis.added_on <',$enddate);

		} else {

			$strtdate = $year.'-'.$month.'-'.'01';
			$enddate  = $year.'-'.$month.'-'.'31';

			$this->db->where('tbl_purchase_llis.added_on >',$strtdate);
			$this->db->where('tbl_purchase_llis.added_on <',$enddate);

		}	
		$this->db->where('tbl_purchase_llis.user_id',$uid);
		$this->db->group_by('tbl_purchase_llis.added_on');

        $query = $this->db->get();
        $data = $query->result_array();  

		return $data;
	}




function getpayadmin($month,$year,$uid)
	{
		//$uid = $this->session->userdata('logged_in')['id'];

  	    //$this->db->select('');quantity
  	    $this->db->select('tbl_purchase_llis.quantity,tbl_purchase_llis.user_id,tbl_purchase_llis.item_name,tbl_purchase_llis.amount,tbl_purchase_llis.txn_id,tbl_purchase_llis.txn_status,tbl_purchase_llis.added_on as added,tbl_course.*');
        $this->db->from('tbl_purchase_llis'); 
        //$this->db->where('user_id', $uid);

			$this->db->join('tbl_course', 'tbl_purchase_llis.item_name = tbl_course.id');
			//$this->db->where('tbl_course.user_id', $uid);


		if($month==""){

			$strtdate = $year.'-'.'01'.'-'.'01';
			$enddate  = $year.'-'.'12'.'-'.'31';

			$this->db->where('tbl_purchase_llis.added_on >',$strtdate);
			$this->db->where('tbl_purchase_llis.added_on <',$enddate);

		} else {

			$strtdate = $year.'-'.$month.'-'.'01';
			$enddate  = $year.'-'.$month.'-'.'31';

			$this->db->where('tbl_purchase_llis.added_on >',$strtdate);
			$this->db->where('tbl_purchase_llis.added_on <',$enddate);

		}	
		
		if($uid !=""){
		  $this->db->where('tbl_purchase_llis.user_id',$uid);
		}

		$this->db->group_by('tbl_purchase_llis.added_on');

        $query = $this->db->get();
        $data = $query->result_array();  

		return $data;
	}


function getpaydetails($datedata)
	{
		$uid = $this->session->userdata('logged_in')['id'];

  	    //$this->db->select('');quantity
  	    $this->db->select('tbl_purchase_llis.purchase_device,tbl_purchase_llis.quantity,tbl_purchase_llis.user_id,tbl_purchase_llis.item_name,tbl_purchase_llis.amount,tbl_purchase_llis.txn_id,tbl_purchase_llis.txn_status,tbl_purchase_llis.added_on as added,tbl_course.*,tbl_user.name,countries.countries_name');
        $this->db->from('tbl_purchase_llis'); 
        //$this->db->where('user_id', $uid);

			$this->db->join('tbl_course', 'tbl_purchase_llis.item_name = tbl_course.id');
			$this->db->join('tbl_user', 'tbl_purchase_llis.user_id = tbl_user.id');
			$this->db->join('countries', 'tbl_user.country = countries.countries_id');
			//$this->db->where('tbl_course.user_id', $uid);

        $this->db->where('tbl_purchase_llis.added_on',$datedata);
  
		$this->db->where('tbl_course.user_id',$uid);
		//$this->db->group_by('tbl_purchase_llis.added_on');

        $query = $this->db->get();
        $data = $query->result_array();  

// echo '<pre>';
// print_r($data); die;
        //echo $this->db->last_query();
        //die;

		return $data;
	}





function getpaydetailsAdmin($datedata)
	{
		$uid = $this->session->userdata('logged_in')['id'];

  	    //$this->db->select('');quantity
  	    $this->db->select('tbl_purchase_llis.quantity,tbl_purchase_llis.user_id,tbl_purchase_llis.item_name,tbl_purchase_llis.amount,tbl_purchase_llis.txn_id,tbl_purchase_llis.txn_status,tbl_purchase_llis.added_on as added,tbl_course.*');
        $this->db->from('tbl_purchase_llis'); 
        //$this->db->where('user_id', $uid);

			$this->db->join('tbl_course', 'tbl_purchase_llis.item_name = tbl_course.id');
			//$this->db->where('tbl_course.user_id', $uid);

        $this->db->where('tbl_purchase_llis.added_on',$datedata);
  
		//$this->db->where('tbl_purchase_llis.user_id',$uid);
		//$this->db->group_by('tbl_purchase_llis.added_on');

        $query = $this->db->get();
        $data = $query->result_array();  

// echo '<pre>';
// print_r($data); die;
        //echo $this->db->last_query();
        //die;

		return $data;
	}






function getpay1($month,$year)
	{
		$uid = $this->session->userdata('logged_in')['id'];

  	    $this->db->select('');
        $this->db->from('tbl_training_book'); 
        //$this->db->where('user_id', $uid);

		$this->db->join('tbl_training', 'tbl_training_book.training_seminar_id = tbl_training.id');
		$this->db->where('tbl_training.user_id', $uid);



	if($month==""){

		$strtdate = $year.'-'.'01'.'-'.'01';
		$enddate  = $year.'-'.'12'.'-'.'31';

		$this->db->where('tbl_training_book.added_on >',$strtdate);
		$this->db->where('tbl_training_book.added_on <',$enddate);

	} else {

		$strtdate = $year.'-'.$month.'-'.'01';
		$enddate  = $year.'-'.$month.'-'.'31';

		$this->db->where('tbl_training_book.added_on >',$strtdate);
		$this->db->where('tbl_training_book.aadded_on <',$enddate);

	}	
  

        $query = $this->db->get();
        $data = $query->result_array();  

        //echo $this->db->last_query();
        //die;

		return $data;
	}


function get_admin_pay($month,$year)
	{
		$uid = $this->session->userdata('logged_in')['id'];

  	    $this->db->select('');
        $this->db->from('tbl_purchase_llis'); 
        ///$this->db->where('user_id', $uid);

	if($month==""){

		$strtdate = $year.'-'.'01'.'-'.'01';
		$enddate  = $year.'-'.'12'.'-'.'31';

		$this->db->where('added_on >',$strtdate);
		$this->db->where('added_on <',$enddate);

	} else {

		$strtdate = $year.'-'.$month.'-'.'01';
		$enddate  = $year.'-'.$month.'-'.'31';

		$this->db->where('added_on >',$strtdate);
		$this->db->where('added_on <',$enddate);

	}	
  
        $query = $this->db->get();
        $data = $query->result_array();
		return $data;
	}


	

	function get_report($type,$uid)
	{
	    $this->db->select('');
        $this->db->from('tbl_purchase_llis'); 

		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('added_on',$today);		
		}

		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$strtdate = $year.'-'.$month.'-'.'01';
			$enddate  = $year.'-'.$month.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate);
		}

		if($type == "year"){
			$year  = date('Y');
			$month = date('m');
			$strtdate = $year.'-'.'01'.'-'.'01';
			$enddate  = $year.'-'.'12'.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate);

		}

		$this->db->where('user_id',$uid);
		$query = $this->db->get();
		$data = $query->result_array();  

		//echo $this->db->last_query(); die;
		return $data;
	}


 



function get_report1($type,$uid)
	{
	    $this->db->select('');
        $this->db->from('tbl_training_book'); 

		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('added_on',$today);		
		}

		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			/* $strtdate = $year.'-'.$month.'-'.'01';
			$enddate  = $year.'-'.$month.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate);*/
			$this->db->where('YEAR(added_on) =',$year); 
			$this->db->where('MONTH(added_on) =',$month); 
		}

		if($type == "year"){
			$year  = date('Y');
			/* $strtdate = $year.'-'.'01'.'-'.'01';
			$enddate  = $year.'-'.'12'.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate); */
			$this->db->where('YEAR(added_on) =',$year);

		}

		$this->db->where('user_id',$uid);
		$query = $this->db->get();
		$data = $query->result_array();  

		//echo $this->db->last_query(); die;
		return $data;
	}




function get_report2($type,$uid)
	{
	    $this->db->select('');
        $this->db->from('tbl_training_book'); 

		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('added_on',$today);		
		}

		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
		/* 	$strtdate = $year.'-'.$month.'-'.'01';
			$enddate  = $year.'-'.$month.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate); */
			$this->db->where('YEAR(added_on) =',$year); 
			$this->db->where('MONTH(added_on) =',$month); 
		}

		if($type == "year"){
			$year  = date('Y');
			$month = date('m');
			/* $strtdate = $year.'-'.'01'.'-'.'01';
			$enddate  = $year.'-'.'12'.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate); */
			$this->db->where('YEAR(added_on) =',$year);

		}

		//$this->db->where('user_id',$uid);
		$query = $this->db->get();
		$data = $query->result_array();  

		//echo $this->db->last_query(); die;
		return $data;
	}


function adv_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(amount) as totalIncome');
        $this->db->from('tbl_adv_package_purchased');
		$this->db->where('payment_status',1);	
		if($date != ""){
			$this->db->where('DATE(purchased_on)',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(purchased_on) =',$year); 
			$this->db->where('MONTH(purchased_on) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('DATE(purchased_on)',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(purchased_on) =',$year);
			$this->db->where('MONTH(purchased_on) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');			
			$this->db->where('YEAR(purchased_on) =',$year);

		}
		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}		
		$query = $this->db->get();
		//$data = $query->row_object();  
		//echo $this->db->last_query(); die;
		$data = $query->result_array();  
		return $data;
	}
	/* here TMS only contain pro training published amount table name is 'tbl_training_published' */
	function tmss_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(amount) as totalIncome, SUM(tax) as totalTax ');
        // $this->db->from('tbl_training_book'); 
        $this->db->from('tbl_training_published'); 
		$this->db->where('status',1);
		if($date != ""){
			$this->db->where('added_on',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(added_on) =',$year); 
			$this->db->where('MONTH(added_on) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('added_on',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(added_on) =',$year);
			$this->db->where('MONTH(added_on) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');			
			$this->db->where('YEAR(added_on) =',$year);

		}
		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}		
		$query = $this->db->get();
		//$data = $query->row_object();  
		$data = $query->result_array();  

// echo $this->db->last_query();die;
		return $data;
	}

	function courses_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(amount) as totalIncome ,SUM(tax) as totalTax ');
        $this->db->from('tbl_purchase_llis'); 
		$this->db->where('status',1);
		if($date != ""){
			$this->db->where('added_on',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(added_on) =',$year); 
			$this->db->where('MONTH(added_on) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('added_on',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(added_on) =',$year);
			$this->db->where('MONTH(added_on) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');		
			$this->db->where('YEAR(added_on) =',$year);

		}
		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}		
		$query = $this->db->get();
		//$data = $query->row_object();  
		$data = $query->result_array(); 
		// echo '<pre>'; print_r($data);die; 
		return $data;
	}
	function promotionc_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(amount) as totalIncome,SUM(tax * no_of_day) as totalTax');
        $this->db->from('tbl_course_promotion'); 
		$this->db->where('status',1);
		if($date != ""){
			$this->db->where('added_on',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(added_on) =',$year); 
			$this->db->where('MONTH(added_on) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('added_on',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(added_on) =',$year);
			$this->db->where('MONTH(added_on) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');			
			$this->db->where('YEAR(added_on) =',$year);

		}
		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}		
		$query = $this->db->get();
		//$data = $query->row_object();  
		$data = $query->result_array();  
		return $data;
	}
	function promotiont_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(amount) as totalIncome,SUM(tax * no_of_day) as totalTax');
        $this->db->from('tbl_training_promotion'); 
		$this->db->where('status',1);
		if($date != ""){
			$this->db->where('added_on',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(added_on) =',$year); 
			$this->db->where('MONTH(added_on) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('added_on',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(added_on) =',$year);
			$this->db->where('MONTH(added_on) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');			
			$this->db->where('YEAR(added_on) =',$year);

		}
		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}		
		$query = $this->db->get();
		//$data = $query->row_object();  
		$data = $query->result_array();  
		return $data;
	}
	function promotionu_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(promoted_amount) as totalIncome,SUM(tax * promoted_day) as totalTax');
        $this->db->from('tbl_promoted_provider_transaction'); 
		// $this->db->where('status',1);
		if($date != ""){
			$this->db->where('promoted_date',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(promoted_date) =',$year); 
			$this->db->where('MONTH(promoted_date) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('promoted_date',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(promoted_date) =',$year);
			$this->db->where('MONTH(promoted_date) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');			
			$this->db->where('YEAR(promoted_date) =',$year);

		}
		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}		
		$query = $this->db->get();
		//$data = $query->row_object();  
		$data = $query->result_array();  
		return $data;
	}
	
	function certificate_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(tc.amount) as totalIncome, SUM(tc.tax) as totalTax, SUM(tc.num_of_participants) as totalParticipants');
        $this->db->from('tbl_training_certificate tc'); 
		// $this->db->join('tbl_training_certificate_lists tcl','tc.certificate_id=tcl.id');
		$this->db->where('tc.status',1);
		if($date != ""){
			$this->db->where('tc.added_on',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(tc.added_on) =',$year); 
			$this->db->where('MONTH(tc.added_on) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('tc.added_on',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(tc.added_on) =',$year);
			$this->db->where('MONTH(tc.added_on) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');			
			$this->db->where('YEAR(tc.added_on) =',$year);

		}
		if($uid !=""){
		 $this->db->where('tc.user_id',$uid);
		}		
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		//$data = $query->row_object();  
		$data = $query->result_array();  
		return $data;
	}
	function pcems_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(payment_amount) as totalIncome, SUM(tax) as totalTax');
        $this->db->from('professional_pce_plan_payment_history'); 
		//$this->db->where('tc.status',1);
		if($date != ""){
			$this->db->where('date(payment_at)',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(payment_at) =',$year); 
			$this->db->where('MONTH(payment_at) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('date(payment_at)',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(payment_at) =',$year);
			$this->db->where('MONTH(payment_at) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');			
			$this->db->where('YEAR(payment_at) =',$year);

		}
		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}		
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		//$data = $query->row_object();  
		$data = $query->result_array();  
		return $data;
	}

	function staff_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(amount) as totalIncome, SUM(tax) as totalTax');
        $this->db->from('tbl_institution_staff_payment'); 
		//$this->db->where('tc.status',1);
		if($date != ""){
			$this->db->where('date(added_on)',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(added_on) =',$year); 
			$this->db->where('MONTH(added_on) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('date(added_on)',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(added_on) =',$year);
			$this->db->where('MONTH(added_on) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');			
			$this->db->where('YEAR(added_on) =',$year);

		}
		if($uid !=""){
		 $this->db->where('provider_id',$uid);
		}		
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$data = $query->result_array();  
		return $data;
	}

	function rboard_income_report($type,$uid,$date = false,$month=false,$year=false)
	{
	    $this->db->select('SUM(paid_amount) as totalIncome');
        $this->db->from('tbl_payment_transaction'); 
		$this->db->where('product_type','RBoard Subscription');
		$this->db->where('txn_id !=','');
		if($date != ""){
			$this->db->where('date(added_on)',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(added_on) =',$year); 
			$this->db->where('MONTH(added_on) =',$month); 		
		}
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('date(added_on)',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(added_on) =',$year);
			$this->db->where('MONTH(added_on) =',$month); 
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');			
			$this->db->where('YEAR(added_on) =',$year);

		}
		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}		
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$data = $query->result_array();  
		return $data;
	}
	function dashboard_income_report($type,$uid){
		//echo $type.$uid;
		$course 		= $this->courses_income_report($type,$uid,'','','');
		$tmss 			= $this->tmss_income_report($type,$uid,'','',''); //course promotion
		$adv 			= $this->adv_income_report($type,$uid,'','','');
		$promotionc 	= $this->promotionc_income_report($type,$uid,'','',''); //course promotion
		$promotiont 	= $this->promotiont_income_report($type,$uid,'','',''); //training promotion
		$promotionu 	= $this->promotionu_income_report($type,$uid,'','',''); //user promotion
		$certificate 	= $this->certificate_income_report($type,$uid,'','','');
		$pcems 			= $this->pcems_income_report($type,$uid,'','','');
		$staff 			= $this->staff_income_report($type,$uid,'','','');
		$rboard 		= $this->rboard_income_report($type,$uid,'','','');
		
		$totalamt = 0;
		foreach($course as $crsinc){
			$totalamt +=  ($crsinc['totalIncome']*30)/100;
		}
		foreach($tmss as $trainc){
			$totalamt +=  $trainc['totalIncome'];
		}
		foreach($adv as $adver){
			$totalamt +=  $adver['totalIncome'];
		}
		foreach($promotionc as $promc){
			$totalamt +=  $promc['totalIncome'];
		}
		foreach($promotiont as $promt){
			$totalamt +=  $promt['totalIncome'];
		}
		foreach($promotionu as $promu){
			$totalamt +=  $promu['totalIncome'];
		}
		foreach($certificate as $cert){
			$totalamt +=  $cert['totalIncome'];
		}
		foreach($pcems as $pce){
			$totalamt +=  $pce['totalIncome'];
		}
		foreach($staff as $staf){
			$totalamt +=  $staf['totalIncome'];
		}
		foreach($rboard as $rb){
			$totalamt +=  $rb['totalIncome'];
		}

		return $totalamt;
	}
	function dashboard_income_tax($type,$uid){
		//echo $type.$uid;
		$course 		= $this->courses_income_report($type,$uid,'','','');
		$tmss 			= $this->tmss_income_report($type,$uid,'','',''); //course promotion
		$adv 			= $this->adv_income_report($type,$uid,'','','');
		$promotionc 	= $this->promotionc_income_report($type,$uid,'','',''); //course promotion
		$promotiont 	= $this->promotiont_income_report($type,$uid,'','',''); //training promotion
		$promotionu 	= $this->promotionu_income_report($type,$uid,'','',''); //user promotion
		$certificate 	= $this->certificate_income_report($type,$uid,'','','');
		$pcems 			= $this->pcems_income_report($type,$uid,'','','');
		$staff 			= $this->staff_income_report($type,$uid,'','','');
		
		$totaltax = 0;
		foreach($course as $crsinc){
			$totaltax +=  ($crsinc['totalTax']*30)/100;
		}
		foreach($tmss as $trainc){
			$totaltax +=  $trainc['totalTax'];
		}
		foreach($adv as $adver){
			$totaltax +=  $adver['totalTax'];
		}
		foreach($promotionc as $promc){
			$totaltax +=  $promc['totalTax'];
		}
		foreach($promotiont as $promt){
			$totaltax +=  $promt['totalTax'];
		}
		foreach($promotionu as $promu){
			$totaltax +=  $promu['totalTax'];
		}
		foreach($certificate as $cert){
			$tax +=  $cert['totalTax'];
			$participants +=  $cert['totalParticipants'];
			$totaltax = $tax * $participants;
		}
		foreach($pcems as $pce){
			$totaltax +=  $pce['totalTax'];
		}
		foreach($staff as $staf){
			$totaltax +=  $staf['totalTax'];
		}
		
		return $totaltax;
	}
	function getSumBetweenAdmin($day,$month,$year){
		//echo $type.$uid;
		$course 		= $this->courses_income_report('','',$day,$month,$year);
		$tmss 			= $this->tmss_income_report('','',$day,$month,$year); //training published income
		$adv 			= $this->adv_income_report('','',$day,$month,$year);
		// $promotions 	= $this->promotions_income_report('','',$day,$month,$year);
		$promotionc 	= $this->promotionc_income_report('','',$day,$month,$year); //course promotion
		$promotiont 	= $this->promotiont_income_report('','',$day,$month,$year); //training promotion
		$promotionu 	= $this->promotionu_income_report('','',$day,$month,$year); //user promotion
		$certificate 	= $this->certificate_income_report('','',$day,$month,$year);
		$pcems 			= $this->pcems_income_report('','',$day,$month,$year);
		
		$totalamt = 0;
		foreach($course as $crsinc){
			$totalamt +=  $crsinc['totalIncome'];
		}
		foreach($tmss as $trainc){
			$totalamt +=  $trainc['totalIncome'];
		}
		foreach($adv as $adver){
			$totalamt +=  $adver['totalIncome'];
		}
		// foreach($promotions as $prom){
		// 	$totalamt +=  $prom['totalIncome'];
		// }
		foreach($promotionc as $promc){
			$totalamt +=  $promc['totalIncome'];
		}
		foreach($promotiont as $promt){
			$totalamt +=  $promt['totalIncome'];
		}
		foreach($promotionu as $promu){
			$totalamt +=  $promu['totalIncome'];
		}
		foreach($certificate as $cert){
			$totalamt +=  $cert['totalIncome'];
		}
		foreach($pcems as $pce){
			$totalamt +=  $pce['totalIncome'];
		}
		
		//$totalamt 		= $course->totalIncome+$tmss->totalIncome+$adv->totalIncome+$promotions->totalIncome+$certificate->totalIncome;
		/* echo 'course:'.$course->totalIncome.'<br>';
		echo 'tmss:'.$tmss->totalIncome.'<br>';
		echo 'adv:'.$adv->totalIncome.'<br>';
		echo 'promotions:'.$promotions->totalIncome.'<br>';
		echo 'certificate:'.$certificate->totalIncome.'<br>'; */
		//return $totalamt;
		$returnarray = array('amount'=>$totalamt);
		return $returnarray;
	}
	function dashboard_income_reports($type,$uid)
	{
	    $this->db->select('SUM(amount*quantity) as totalIncome');
        $this->db->from('tbl_purchase_llis'); 
		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('added_on',$today);		
		}
		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			/* $strtdate = $year.'-'.$month.'-'.'01';
			$enddate  = $year.'-'.$month.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate); */
			$this->db->where('YEAR(added_on) =',$year);
			$this->db->where('MONTH(added_on) =',$month); 
			//YEAR(added_on)=2020 AND MONTH(added_on)=01
		}
		if($type == "year"){
			$year  = date('Y');
			$month = date('m');
			/* $strtdate = $year.'-'.'01'.'-'.'01';
			$enddate  = $year.'-'.'12'.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate); */
			$this->db->where('YEAR(added_on) =',$year);

		}
		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}		
		$query = $this->db->get();
		//$data = $query->result_array();  
		$data = $query->row_object();  

		//echo $this->db->last_query(); 
		return $data;
	}
	
	function get_report_admin($type,$uid)
	{
	    $this->db->select('');
        $this->db->from('tbl_purchase_llis'); 

		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('added_on',$today);		
		}

		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
			/* $strtdate = $year.'-'.$month.'-'.'01';
			$enddate  = $year.'-'.$month.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate); */
			$this->db->where('YEAR(added_on) =',$year);
			$this->db->where('MONTH(added_on) =',$month); 
			//YEAR(added_on)=2020 AND MONTH(added_on)=01
		}

		if($type == "year"){
			$year  = date('Y');
			$month = date('m');
			/* $strtdate = $year.'-'.'01'.'-'.'01';
			$enddate  = $year.'-'.'12'.'-'.'31';
			$this->db->where('added_on >',$strtdate);
			$this->db->where('added_on <',$enddate); */
			$this->db->where('YEAR(added_on) =',$year);

		}

		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}
		
		$query = $this->db->get();
		$data = $query->result_array();  

		//echo $this->db->last_query(); 
		return $data;
	}




function get_ads_report($type,$uid)
	{
	    $this->db->select();
        $this->db->from('tbl_adv_package_purchased'); 

		if($type == "today"){
			$today = date('Y-m-d');
			$this->db->where('purchased_on',$today);		
		}

		if($type == "month"){
			$year  = date('Y');
			$month = date('m');
		/* 	$strtdate = $year.'-'.$month.'-'.'01';
			$enddate  = $year.'-'.$month.'-'.'31';
			$this->db->where('purchased_on >',$strtdate);
			$this->db->where('purchased_on <',$enddate); */
			$this->db->where('YEAR(purchased_on) =',$year);
			$this->db->where('MONTH(purchased_on) =',$month); 
		}

		if($type == "year"){
			$year  = date('Y');
			$month = date('m');
			/* $strtdate = $year.'-'.'01'.'-'.'01';
			$enddate  = $year.'-'.'12'.'-'.'31';
			$this->db->where('purchased_on >',$strtdate);
			$this->db->where('purchased_on <',$enddate); */
			$this->db->where('YEAR(purchased_on) =',$year);

		}

		if($uid !=""){
		 $this->db->where('user_id',$uid);
		}
		$this->db->where('payment_status','1');
		$query = $this->db->get();
		$data = $query->result_array();  

		//echo $this->db->last_query(); die;
		return $data;
	}



	function getSum($date)
	{
			$this->db->select('SUM(amount * quantity) AS amount', FALSE);
			$this->db->where('added_on', $date);
			$query = $this->db->get('tbl_purchase_llis');

			$data = $query->result_array();  
			return $data;

	}

	function getSumAdmin($date,$uid)
	{
			$this->db->select('SUM(amount * quantity) AS amount', FALSE);
			$this->db->where('added_on', $date);
			
			if($uid !=""){
			$this->db->where('user_id',$uid);
			}

			$query = $this->db->get('tbl_purchase_llis');

			$data = $query->result_array();  
			return $data;
	}



	function getSum1($date)
	{
			$this->db->select('SUM(amount) AS amount', FALSE);
			$this->db->where('added_on', $date);

			$uid = $this->session->userdata('logged_in')['id'];
	  	    $this->db->where('user_id', $uid);
	  	    
			$query = $this->db->get('tbl_training_book');

			$data = $query->result_array();  
			return $data;

	}


	function getSumBetween1($start_date,$end_date)
	{


			$this->db->select('SUM(amount) AS amount', FALSE);
			//$this->db->where('added_on', $date);
			$this->db->where('added_on >=', $start_date);
			$this->db->where('added_on <=', $end_date);


			$uid = $this->session->userdata('logged_in')['id'];
	  	    $this->db->where('user_id', $uid);

			$query = $this->db->get('tbl_training_book');
			//echo $this->db->last_query(); die;
			$data = $query->result_array();  
			return $data;

	}



	function getSumBetween($start_date,$end_date)
	{
			$this->db->select('SUM(amount * quantity) AS amount', FALSE);
			//$this->db->where('added_on', $date);
			$this->db->where('added_on >=', $start_date);
			$this->db->where('added_on <=', $end_date);
				$uid = $this->session->userdata('logged_in')['id'];
	  	    $this->db->where('user_id', $uid);
			$query = $this->db->get('tbl_purchase_llis');
			//echo $this->db->last_query(); die;
			$data = $query->result_array();  
			return $data;

	}
	


	function getSumBetweenAdmins($start_date,$end_date,$uid)
	{
			$this->db->select('SUM(amount * quantity) AS amount', FALSE);
			//$this->db->where('added_on', $date);
			$this->db->where('added_on >=', $start_date);
			$this->db->where('added_on <=', $end_date);
			//	$uid = $this->session->userdata('logged_in')['id'];
	  	
	  	    if($uid !=""){
	  	     $this->db->where('user_id', $uid);
	  	    } 

			$query = $this->db->get('tbl_purchase_llis');
			//echo $this->db->last_query(); die;
			$data = $query->result_array();  
			return $data;

	}

	function get_active_promotion($uid)
	{
		$this->db->select('tbl_user.name,tbl_course.*');
		$this->db->from('tbl_course');
		$this->db->join('tbl_user', 'tbl_user.id = tbl_course.user_id');  
		$this->db->where('tbl_course.user_id ', $uid); 
		$this->db->where('paid_status !=',1);
		$this->db->where('paid_status !=',0);
		$this->db->order_by('id','desc'); 
		$query = $this->db->get();
		$data = $query->result_array(); 
		//echo $this->db->last_query(); die;
		return $data;
	}

	function get_active_promoted_course($uid)
	{
		$this->db->select('tbl_user.name,tbl_course.course_title title,cp.*');
		$this->db->from('tbl_course_promotion cp');
		$this->db->join('tbl_user', 'tbl_user.id = cp.user_id');  
		$this->db->join('tbl_course', 'tbl_course.id = cp.course_id');  
		$this->db->where('cp.user_id ', $uid);
	
		$this->db->order_by('id','desc'); 
		$query = $this->db->get();
		$data = $query->result_array(); 
		//echo $this->db->last_query(); die;
		return $data;
	}


	function get_active_promoted_provider($uid,$urole=false)
	{
		$this->db->select('tbl_user.name,ppt.*');
		$this->db->from('tbl_promoted_provider_transaction ppt');
		$this->db->join('tbl_user', 'tbl_user.id = ppt.user_id');  
		$this->db->where('ppt.user_id ', $uid);
		if($urole){
		$this->db->where('ppt.role ', $urole); 
		} 
		$this->db->order_by('id','desc'); 
		$query = $this->db->get();
		$data = $query->result_array(); 
		//echo $this->db->last_query(); die;
		return $data;
	}



   function get_previous_promotion($uid)
	{
		
			$stdate = date('Y-m-d');

			$this->db->select('tbl_user.name,tbl_course.*');
			$this->db->from('tbl_course');
			$this->db->join('tbl_user', 'tbl_user.id = tbl_course.user_id');  
			$this->db->where('tbl_course.user_id ', $uid); 
			$this->db->where('paid_status !=',1);
			$this->db->where('paid_status !=',0);
			$this->db->where('expiry_on >',$stdate);
			$this->db->order_by('id','desc'); 
			$query = $this->db->get();
			$data = $query->result_array(); 
			//echo $this->db->last_query(); die;
			return $data;
	}


	

	function get_active_promotion_all($filterdata)
	{
			$this->db->select('tbl_user.name,tbl_course.*,countries.countries_name');
			$this->db->from('tbl_course');
			$this->db->join('tbl_user', 'tbl_user.id = tbl_course.user_id'); 
            $this->db->join('countries', 'countries.countries_id = tbl_course.country_id'); 
            if(!empty($filterdata['country']))
		    {
			   $this->db->where('tbl_course.country_id',$filterdata['country']);
		    }
		   	if(!empty($filterdata['date']))
		    {
			   $this->db->where('tbl_course.added_on',date('Y-m-d',strtotime($filterdata['date'])));
		    } 
		
			//$this->db->where('tbl_course.user_id ', $uid); 
			//$this->db->where('paid_status !=',1);
			$this->db->where('paid_status !=',0);
			$query = $this->db->get();
			$data = $query->result_array(); 
			//echo $this->db->last_query(); die;
			return $data;


	}

	function purchaselist($where = false)
	{
		$this->db->from('tbl_purchase_llis'); 
       if($where){
       	$this->db->where($where);
       }
        $query = $this->db->get();
        $data = $query->result(); 
        // echo $this->db->last_query();die;
 		return $data;
	}
	
	function advertisepackages($where)
	{
		$this->db->from('advertise_packages'); 
        $this->db->where($where);
        $query = $this->db->get();
        $data = $query->result_array(); 
		return $data;
	}
	function memberadvertiselisting($where)
	{
		$this->db->from('advertise_listing'); 
        $this->db->where($where);
        $query = $this->db->get();
        $data = $query->result_array(); 
		return $data;
	}
	function subscriptionslisting($where)
	{
		$this->db->from('tbl_user_subscription_packages'); 
        $this->db->where($where);
        $query = $this->db->get();
        $data = $query->result_array(); 
		return $data;
	}
	function buyadpack($where)
	{
		$this->db->select('tbl_buy_advertise_pack.buyadv_id,tbl_buy_advertise_pack.purchage_date,tbl_buy_advertise_pack.expry_date,advertise_packages.adv_id,advertise_packages.adv_pck,advertise_packages.no_of_adv,advertise_packages.adv_validity_days,advertise_packages.adv_charges');
		$this->db->from('tbl_buy_advertise_pack'); 
		$this->db->join('advertise_packages','tbl_buy_advertise_pack.adv_id =advertise_packages.adv_id', 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $data = $query->result_array(); 
		return $data;
	}



function get_professions($profession)
	{
		    $pro = unserialize($profession); 
			$this->db->select('cat_name');
			$this->db->from('tbl_category');  
			if($profession != ""){
				if(!empty($pro)){
					$this->db->where_in('id', $pro,false);
				}else{
					$this->db->where_in('id', $profession,false);
				} 
			
			}
				
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			$data = $query->result_array();  
			return $data;
			// print_r($data);
	}




 	function get_advertisement($page)
	{

		$curdate = date('Y-m-d');

		$todate1 = strtotime("+7 day", strtotime($curdate));
		$todate  = date('Y-m-d', $todate1);
		//die;

		//$todate  = date(); 

  	    // $this->db->select();
        $this->db->from('tbl_adv_upload');
        $this->db->join('tbl_adv_package', 'tbl_adv_package.id = tbl_adv_upload.package_id'); 
        $this->db->where('tbl_adv_package.location = ',$page);

		$this->db->where('tbl_adv_upload.end_date >=', $curdate);
		$this->db->where('tbl_adv_upload.start_date <=', $todate);
        //$this->db->where('tbl_lesson.user_id ', $uid); 
        $query = $this->db->get();
       // echo $this->db->last_query();die();
        return $data = $query->result_array(); 
	}

	function getadvertisement()
	{

		$curdate = date('Y-m-d');
  	    $this->db->select('*');
        $this->db->from('advertise_listing');      
		$this->db->where('adv_status', '1');
		$this->db->order_by('advlist_id','desc'); 
	    $query = $this->db->get();    
		
        return $data = $query->result_array(); 
	}

	function getadvertisementfilter()
	{

		$curdate = date('Y-m-d');
  	    $this->db->select('*');
        $this->db->from('advertise_listing');      
		$this->db->where('adv_status', '1');
		$this->db->order_by('advlist_id','desc'); 
	    $query = $this->db->get();    
		
        return $data = $query->result_array(); 
	}


  function getProviders($where)
	{
		
		$this->db->select('*');
        $this->db->from('tbl_user'); 
		$this->db->where('role',2);
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
        if(!empty($where)){
          $this->db->where($where);
		  
    	} 
        $query = $this->db->get();
      //  echo $this->db->last_query(); die;
        $data = $query->result_array(); 
      
        return $data;
	}

	function getProviders_like($wheres)
	{
		
		$this->db->select('*');
        $this->db->from('tbl_user'); 
		$this->db->where('role',2);
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
       
    	if(!empty($wheres['name'])){
          $this->db->like('name',$wheres['name'],'%');
		  
    	}      
       
        $query = $this->db->get();
         // echo $this->db->last_query(); die;
        $data = $query->result_array(); 
      
        return $data;
	}



	 function getAuthors($where)
	{
		
		$this->db->select('*');
        $this->db->from('tbl_user'); 
		$this->db->where('role',6);
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
        if(!empty($where)){
          $this->db->where($where);
		  
    	} 
        $query = $this->db->get();
         // echo $this->db->last_query(); die;
        $data = $query->result_array(); 
      
        return $data;
	}

	function getAuthors_like($wheres)
	{
		
		$this->db->select('*');
        $this->db->from('tbl_user'); 
		$this->db->where('role',6);
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
       
    	if(!empty($wheres['name'])){
          $this->db->like('name',$wheres['name'],'%');
		  
    	}      
       
        $query = $this->db->get();
         // echo $this->db->last_query(); die;
        $data = $query->result_array(); 
      
        return $data;
	}


	
	function getInstitutions($where = false)
	{
		
		$this->db->select('*');
        $this->db->from('tbl_user'); 
		$this->db->where('role',5);
		$this->db->where('status','1');
		$this->db->not_like('name','*');
		$this->db->where('under_insititution',0);
		$this->db->where('parent_insititution',0);
        
        if(!empty($where)){
          $this->db->where($where);
    	}
    	$this->db->order_by('added_on','desc');
        $query = $this->db->get();
        $data = $query->result_array(); 
      	// echo $this->db->last_query();
      	// echo count($data);
        return $data;
	}

	function getInstitutions_like($wheres)
	{
		$this->db->select('*');
        $this->db->from('tbl_user'); 
		$this->db->where('role',5);
		$this->db->where('status',1);
		$this->db->where('parent_insititution >',0);
		$this->db->where('name',$wheres['institution']);
    	$this->db->order_by('added_on','desc');
    	$query = $this->db->get();
        $data = $query->result_array(); 
       	// echo $this->db->last_query();die;	
        return $data;
	}
	
	function getAdvertiseAddsList($param=false)
	   {
	   		$this->db->select('app.*, ap.package_name, ap.location, ap.size, ap.package_image, u.name, c.countries_name');
		 	$this->db->from('tbl_adv_package_purchased app');
			$this->db->join('tbl_adv_package ap', 'app.package_id = ap.id'); 
		    $this->db->join('tbl_user u', 'app.user_id = u.id');
		   	$this->db->join('countries c', 'app.country = c.countries_id'); 
			$this->db->where('app.payment_status',1);
			  if(!empty($param['country']))
		   {
			   $this->db->where('app.contry',$param['country']);
		   }
		   
		   if(!empty($param['advertiser']))
		   {
			   $this->db->where('app.user_id',$param['advertiser']);
		   }  
		   
		   if(!empty($param['view']))
		   {
			   $this->db->where('app.total_view',$param['view']);
		   } 
		   if(!empty($param['date']))
		   {
			   $this->db->where('app.purchased_on',date('Y-m-d',strtotime($param['date'])));
		   } 

		   if(!empty($param['location']))
		   {
			   $this->db->where('ap.location',$param['location']);
		   }
		   if(!empty($param['size']))
		   {
			   $this->db->where('ap.size',$param['size']);
		   }

		 	$query = $this->db->get();
			$data = $query->result_array(); 
		  	// echo $this->db->last_query();
			return $data;
		   
	   }

	function get_user_data_api($user_id)
	{
		$this->db->select(
		'tbl_user.id,
		tbl_user.name,
		tbl_user.username_email,
		tbl_units.unit,
		tbl_units.gernal_target,
		tbl_units.specific_target,
		tbl_user.image,
		tbl_user.backimage,
		tbl_user.profession,
		tbl_user.country'
		);
		$this->db->from('tbl_user');
		$this->db->join('tbl_units', 'tbl_units.user_id = tbl_user.id', 'left');
		$this->db->where('tbl_user.id', $user_id);
		$result= $this->db->order_by('tbl_units.id','desc')->get()->row_array();
		
		$resultUnit = ($result['unit']) ? $result['unit'] : 0;
		//  print_r($result); die;
		
		$setificate =  $this->db->order_by('id','desc')->where(array('user_id'=>$user_id,'archive'=>1))->get('tbl_existing_certificate')->result_array();
		
		/* ------------get data from purchase course */
		$purchase =  $this->db->order_by('id','desc')->where(array('user_id'=>$user_id))->get('tbl_purchase_llis')->result_array();   
		$courseid=array_sum(array_column($purchase,'item_name'));
		$onlinecourses =  $this->db->where_in('id',$courseid)->get('tbl_course')->result_array();
		
		
		$onlinecourse=array_sum(array_column($onlinecourses,'units'));
		//echo $onlinecourse; die;
		
		/* -----------------end------------- */
		
		$allobtained=array_sum(array_column($setificate,'units'))+$onlinecourse;
		//echo $allobtained; die;
		
		
		$sobtaineds =  $this->db->order_by('id','desc')->where(array('user_id'=>$user_id,'category'=>'specific','archive'=>0))->get('tbl_existing_certificate')->result_array();

		$sobtained=array_sum(array_column($sobtaineds,'units'));

		$gobtaineds =  $this->db->order_by('id','desc')->where(array('user_id'=>$user_id,'category'=>'general','archive'=>0))->get('tbl_existing_certificate')->result_array();
		$gobtained=array_sum(array_column($gobtaineds,'units'))+$onlinecourse;

		if ($resultUnit) {
			$persant=(($allobtained*100)/$resultUnit);
		} else {
			$persant = 0;
		}
		
		//$country_name = $this->db->get_where('countries', array('countries_id'=>$result['country']))->row_array()['countries_name'];
		
		$percentage = is_nan($persant);
		$data['id']=$result['id'];
		$data['name']=$result['name'];
		$data['email']=$result['username_email'];
		$data['needed']=$result['unit']-$allobtained;
		$data['required']=$result['unit'];
		$data['obtained']=$allobtained;
		$data['persant']= ($percentage) ? 0 : round($persant);
		//echo $data['persant']; die;
		$data['profession']=$result['profession'];
		$data['general']=$result['gernal_target']-$gobtained;
		$data['specific']=$result['specific_target']-$sobtained;
		$data['image']=BASE_URL.'assets/images/uploads/'.$result['image'];
		$data['backimage']=BASE_URL.'assets/images/uploads/'.$result['backimage'];
		$data['country']=$result['country'];
		return $data; 
		//$results = array_merge($result,'image'=>BASE_URL.'/assets/images/uploads/'.$result['image']);
		//return $result; 
	}
	
	function getuniqecountryTraining()
	{
		$this->db->select('*');
		$this->db->from('tbl_training');   
		//$this->db->where($where);    
		$this->db->group_by('country_id');    
		$query = $this->db->get();
		
		$data = $query->result_array();  
		//echo $this->db->last_query(); die;
		return $data;	
	}
	
	function getuniqecountryCountry()
	{
		$this->db->select('*');
		$this->db->from('tbl_course');   
		//$this->db->where($where);    
		$this->db->group_by('country_id');    
		$query = $this->db->get();
		
		$data = $query->result_array();  
		//echo $this->db->last_query(); die;
		return $data;	
	} 

	function get_licence_status($tbl_name,$where,$type)
	{
		$currentDate = date('Y-m-d');

		$this->db->select('*');
		$this->db->from($tbl_name);   
		$this->db->where($where);  
		// $this->db->where('certificate_id',NULL);  
		//$this->db->where('present_status',1);

		if($type=="active"){
		  $this->db->where('licence_validity > ',$currentDate);
		}

		if($type=="expired"){
		  $this->db->where('licence_validity < ',$currentDate);
		}

		$query = $this->db->get();
		$data = $query->result_array();  
		//echo $this->db->last_query(); die;
		return $data;	
	}

	function get_rbsubscriptions(){
			$this->db->from('tbl_rb_subscrption_package');
			$this->db->order_by("rbsp_id", "desc");
			$query = $this->db->get();
			$result = $query->result();
			return $result;
	}

	function get_one_rbsubscription($id = false){
		$this->db->from('tbl_rb_subscrption_package');
		if($id){
			$this->db->where('rbsp_id', $id);
		}		
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}

	function rbsubscription_update($data, $id = false){		
		$this->db->where('rbsp_id', $id);
		$this->db->update('tbl_rb_subscrption_package', $data);
		//echo $this->db->last_query(); die;
		return true;
	}

	function rbsubscription_insert($data){
		$this->db->set($data);
		$this->db->insert('tbl_rb_subscrption_package');	
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;	
	}
	
	function get_accredition_list(){
		$type = isset($_REQUEST['type'])?$_REQUEST['type']:'';
		
		$this->db->select('a.*, u.name cepname');
		$this->db->from('tbl_accreditation a');
		$this->db->join('tbl_user u','u.id = a.user_id','left');
		if($type!=''){
			$this->db->where('a.type',$type);
		}
		$this->db->order_by('a.aid','desc');
		$query = $this->db->get();
		$result = $query->result_object();
		return $result;
	}
	
	function get_accredition_details($useremail){
		$this->db->select('a.*, u.name cepname');
		$this->db->from('tbl_accreditation a');
		$this->db->join('tbl_user u','u.id = a.user_id','left');
		$this->db->where('a.type','cep');
		$this->db->where('a.user_email',$useremail);
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}
	
	function get_accredition_detailsOC($cid){
		$this->db->select('a.*, u.name cepname');
		$this->db->from('tbl_accreditation a');
		$this->db->join('tbl_user u','u.id = a.user_id','left');
		$this->db->where('a.type','oc');
		$this->db->where('a.doc_id',$cid);
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}
	
	function get_accredition_detailsTC($tid){
		$this->db->select('a.*, u.name cepname');
		$this->db->from('tbl_accreditation a');
		$this->db->join('tbl_user u','u.id = a.user_id','left');
		$this->db->where('a.type','tc');
		$this->db->where('a.doc_id',$tid);
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}

	function getCpd($country=false,$uinsid=false){
		if($country){
			$this->db->where('country',$country);
		}
		if($uinsid){
			$this->db->where('under_insititution',$uinsid);
		}
		$this->db->where('role','2');
		$this->db->where('status',1);
		$this->db->order_by('name','ASC');
		return $this->db->get('tbl_user')->result_array();
	}

	function getAllCertificateTemplate($limit=false,$offset=false){
		$category = ($_GET['category'] !='')?$_GET['category']:'';
		if($category !=''){ 
			$this->db->where('category',$category); 
		}
		if($limit){
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('template_no ASC','category ASC');
		return $this->db->get('tbl_certificate_template')->result_array();
	}
}

/* End of file Common.php */
/* Location: ./application/models/Common.php */