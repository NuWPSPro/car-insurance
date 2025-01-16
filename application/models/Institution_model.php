<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Institution_model extends CI_Model {
	
	public function  __construct()
	{
		parent::__construct();
		$this->userTbl 		= 'tbl_user';
		$this->courseTbl 	= 'tbl_course';
		$this->trainingTbl 	= 'tbl_training';
		$this->providerSetTargetTbl = 'tbl_provider_set_target';
		$this->pcemsPlanTbl = 'tbl_professional_plan';
	}

	function get_latest_training_date($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_provider_set_target_date');   
		$this->db->where('user_id',$uid);  
		$this->db->order_by('id','DESC');
		$this->db->limit(1, 0);    
		$query = $this->db->get();
		$data = $query->row();  
		return $data;	
	}	

	function get_set_target($insidArr,$status)
	{
		$authorpresenter 	= (isset($_GET['authorpresenter']))?$_GET['authorpresenter']:''; 
		$institution 		= (isset($_GET['institution']))?$_GET['institution']:''; 
		$ceprovider 		= (isset($_GET['ceprovider']))?$_GET['ceprovider']:''; 
		$monthdate 		 	= (isset($_GET['monthdate']))?$_GET['monthdate']:''; 
		$this->db->select('p.*');
		$this->db->from('tbl_provider_set_target p');   
		// $this->db->where('p.institution_id',$uid);
		$this->db->where_in('p.institution_id',$insidArr);  

		if($status == 1){
			$this->db->where('p.status',1);  
		}

		if($status == 2){
			$this->db->where('p.status',2);  
		}

		if($authorpresenter != ""){
			if($authorpresenter=='a'){
				$this->db->where('p.category','Course');
			}
		}
		if($monthdate != ""){
			$this->db->where('year(p.added_on)',$monthdate);
			$this->db->where('month(p.added_on)',$monthdate);
		}
		if($ceprovider != ""){
			$this->db->where('p.user_id',$ceprovider);
		}
		if($institution != ""){
			$this->db->or_where('p.institution_id',$institution);
		}

		$query = $this->db->get();
		$data = $query->result_array();  
		return $data;	
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
			
			if(!empty($filter['author']))
			{
				$this->db->where('c.author_reference_id',$filter['author']);
			}
			
			if(!empty($filter['institution']))
			{
				$this->db->where('tbl_user.insititution_id',$filter['institution']);
			}
			
			$query = $this->db->get();
			   return $data = $query->result_array(); 
		}

		function getstaffcerecords($user_ins_id,$filter=false)
		{	
			$title 		 	= (isset($_GET['title']))?$_GET['title']:''; 
			$ceprovider 	= (isset($_GET['ceprovider']))?$_GET['ceprovider']:''; 
			$institution 	= (isset($_GET['institution']))?$_GET['institution']:''; 
			$this->db->select('is.*,u.profession,u.id as pid');
			$this->db->from('tbl_institution_staff is');
			$this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
			$this->db->where_in('is.insititution_code',$user_ins_id);
			
			if($title != ''){
				$this->db->like('u.name', $title,'%');
			}
			
			if($ceprovider !=''){
				$this->db->where('is.insititution_code',$ceprovider);
			}
			
			if($institution){
				$this->db->where('is.insititution_id',$institution);
			}

			$query = $this->db->get();
			return $query->result_array();
		}

		function getsubInstitutions($ins_id)
		{	
			$title 		 	= (isset($_GET['title']))?$_GET['title']:''; 
			$this->db->select('u.*');
			$this->db->from('tbl_user u');
			// $this->db->where('u.status','1');
			$this->db->where('u.role',5);
			$this->db->where('u.under_insititution','1');
			$this->db->where('u.parent_insititution',$ins_id);
			if($title != ''){
				$this->db->like('u.name', $title,'%');
			}
			$query = $this->db->get();
			return $query->result_array();
		}

		function getcepUnderIns($ins_id)
		{	
			$this->db->select('u.*');
			$this->db->from('tbl_user u');
			// $this->db->where('u.status','1');
			$this->db->where('u.role',2);
			$this->db->where('u.parent_insititution',$ins_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		function getauthorUnderCep($provider_id)
		{	
			
			$title 		 	= (isset($_GET['title']))?$_GET['title']:''; 
			$ceprovider 	= (isset($_GET['ceprovider']))?$_GET['ceprovider']:''; 
			$institution 	= (isset($_GET['institution']))?$_GET['institution']:''; 
			$this->db->select('u.*');
			$this->db->from('tbl_user u');
			// $this->db->where('u.status','1');
			$this->db->where('u.role',6);
			$this->db->where('u.under_provider',$provider_id);

				
			if($title != ''){
				$this->db->like('u.name', $title,'%');
			}
			
			if($ceprovider != ''){
				$this->db->where('u.under_provider',$ceprovider);
			}
			
			if($institution != ''){
				$this->db->where('u.insititution_id',$institution);
			}


			$query = $this->db->get();
			return $query->result_array();
		}

		function getcourseUnderIns($insArr)
		{	
			
			$title 		 	= (isset($_GET['title']))?$_GET['title']:''; 
			$ceprovider 	= (isset($_GET['ceprovider']))?$_GET['ceprovider']:''; 
			$institution 	= (isset($_GET['institution']))?$_GET['institution']:''; 
			$date 			= (isset($_GET['date']))?$_GET['date']:''; 
			$this->db->select('c.*');
			$this->db->from('tbl_course c');
			$this->db->where('c.status','1');
			$this->db->where_in('c.insititution_id',$insArr);

			if($title != ''){
				$this->db->like('c.course_title', $title,'%');
			}
			
			if($ceprovider != ''){
				$this->db->where('c.under_provider',$ceprovider);
			}
			
			if($institution != ''){
				$this->db->where('c.insititution_id',$institution);
			}

			if($date != ""){
				$this->db->where('year(c.added_on)',$date);
				$this->db->where('month(c.added_on)',$date);
			}
			$query = $this->db->get();
			return $query->result_array();
		}

		function gettrainingUnderIns($insArr)
		{	
			
			$title 		 	= (isset($_GET['title']))?$_GET['title']:''; 
			$ceprovider 	= (isset($_GET['ceprovider']))?$_GET['ceprovider']:''; 
			$institution 	= (isset($_GET['institution']))?$_GET['institution']:''; 
			$date 			= (isset($_GET['date']))?$_GET['date']:''; 
			$this->db->select('t.*');
			$this->db->from('tbl_training t');
			$this->db->where('t.status','2');
			$this->db->where_in('t.insititution_id',$insArr);

				
			if($title != ''){
				$this->db->like('t.title', $title,'%');
			}
			
			if($ceprovider != ''){
				$this->db->where('t.under_provider',$ceprovider);
			}
			
			if($institution != ''){
				$this->db->where('t.insititution_id',$institution);
			}

			if($date != ""){
				$this->db->where('year(t.added_on)',$date);
				$this->db->where('month(t.added_on)',$date);
			}
			$query = $this->db->get();
			return $query->result_array();
		}

		function getBlogUnderIns($uid)
		{	
			
			$title 		 	= (isset($_GET['title']))?$_GET['title']:''; 
			$ceprovider 	= (isset($_GET['ceprovider']))?$_GET['ceprovider']:''; 
			$institution 	= (isset($_GET['institution']))?$_GET['institution']:''; 
			$date 			= (isset($_GET['date']))?$_GET['date']:''; 
			$this->db->select('b.*');
			$this->db->from('tbl_blog b');
			// $this->db->where('b.status','1');
			$this->db->where('b.user_id',$uid);

			if($title != ''){
				$this->db->like('b.title', $title,'%');
			}
			
			if($ceprovider != ''){
				$this->db->where('bt.under_provider',$ceprovider);
			}
			
			if($institution != ''){
				$this->db->where('b.insititution_id',$institution);
			}

			if($date != ""){
				$this->db->where('year(b.date)',$date);
				$this->db->where('month(b.date)',$date);
			}
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_institution_details($uid){
			$this->db->where('id',$uid);
			$query = $this->db->get($this->userTbl);
			$result = $query->row(); 
			return $result;
		}
	
		public function getDemoInstitutions(){
			$this->db->where('role',5);
			$this->db->where('status','1');
			$this->db->where('under_insititution',0);
			$this->db->where('parent_insititution',0);
			$this->db->like('name','*');
			$query = $this->db->get($this->userTbl);
			$result = $query->result_array(); 
			return $result;
		}

}
?>