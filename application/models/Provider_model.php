<?php defined('BASEPATH') OR exit('No direct script access allowed');
	//public $tablecourse = 'tbl_course';
	
class Provider_model extends CI_Model {
	
	public function  __construct()
	{
		parent::__construct();
		$this->userTbl 				= 'tbl_user';
		$this->courseTbl 			= 'tbl_course';
		$this->trainingTbl 			= 'tbl_training';
		$this->providerSetTargetTbl = 'tbl_provider_set_target';
		$this->certificateTemplateTbl	= 'tbl_certificate_template';
		$this->trainingEvaluationTbl	= 'tbl_training_evaluation';
		$this->rboardDetailsTbl 		= 'tbl_rboard_details';
		$this->carInsuranceTbl 			= 'car_insurance';
		$this->userConnectRboardTbl 	= 'tbl_user_connect_rboard';
		$this->trainingCertificateListsTbl  = 'tbl_training_certificate_lists';
		$this->digitalCertificatePackageTbl = 'digital_insurance_package';
		$this->paymentTransactionTbl 		= 'tbl_payment_transaction';
		$this->usedInsuranceCertificate 	= 'tbl_used_insurance_certificate';
		$this->subscribedDigitalCertificateTbl = 'tbl_subscribed_digital_certificate';
		$this->institutionStaffTbl 			= 'tbl_institution_staff';
		$this->accreditationTbl 			= 'tbl_accreditation';
		$this->accreditationVerificationLogTbl = 'tbl_accreditation_verification_log';
		$this->insuranceTbl 		= 'tbl_existing_certificate'; //we will use this table for stoer insurance certificate
		$this->buyinsuranceTbl 		= 'tbl_buy_insurance';
	}

	function buy_insurance_list($uid)
	{
		$this->db->select('bi.*,ci.course_title insur_name,ui.name m_broker,ui.name middle_name,ui.fname first_name,ui.lname last_name,ci.price price_insurance');
		$this->db->from($this->buyinsuranceTbl.' bi'); 
		  $this->db->join($this->courseTbl.' ci','ci.id = bi.insurance_id');
		$this->db->join($this->userTbl.' ui','ui.id = bi.company_id');
		$this->db->where('bi.broker_id',$uid);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
	}

	function get_buy_insurance_by_id($bi_id)
	{ 
		$this->db->where('bi_id',$bi_id);
        $query = $this->db->get($this->buyinsuranceTbl); 
		$data = $query->row_array(); 
        return $data;
	} 

	function getInsuranceCompany_list()
	{
		$this->db->select('*');
        $this->db->from('tbl_user'); 
		$this->db->where('role',2);
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
        $query = $this->db->get();
        $data = $query->result_array(); 
      
        return $data;
	}

	function getBrokerList()
	{
		$this->db->select('*');
        $this->db->from('tbl_user'); 
		$this->db->where('role',6);
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
        $query = $this->db->get();
        $data = $query->result_array(); 
      
        return $data;
	}

	public function get_all_published_insurance_sale()
	{
		$ins_type = isset($_GET['insurance_type'])?$_GET['insurance_type']:'';
		$range = isset($_GET['range'])?$_GET['range']:'';
		$company = isset($_GET['company'])?$_GET['company']:'';

		$this->db->select('i.*,i.id insur_id,i.user_id broker_id,i.author_reference_id company_id,u.fname, u.lname, u.name, ci.name company_name');
		$this->db->from($this->courseTbl.' i');
		$this->db->join($this->userTbl.' u','u.id = i.user_id');
		$this->db->join($this->userTbl.' ci','ci.id = i.author_reference_id');
		$this->db->where('i.status',1);

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

	public function get_all_insurance_list($uid){
		$this->db->select('uc.*,uc.id insur_id,u.fname, u.lname, u.name');
		$this->db->from($this->insuranceTbl.' uc');
		$this->db->join($this->userTbl.' u','uc.user_id=u.id');
		$this->db->where('uc.company_id',$uid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_one_insurance($id){
		$this->db->select('uc.*,uc.id insur_id,u.fname, u.lname, u.name,u.username_email email');
		$this->db->from($this->insuranceTbl.' uc');
		$this->db->join($this->userTbl.' u','uc.user_id=u.id');
		$this->db->where('uc.id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function get_published_insurance(){
		$this->db->where('status','2');
		$this->db->order_by('insure_id','DESC');
		$query = $this->db->get($this->carInsuranceTbl); //insuranceTbl
		$result = $query->result_array();
		return $result;
	}

	public function add_insurance($data){
		$this->db->insert($this->insuranceTbl,$data);
		$result = $this->db->insert_id();
		return $result;
	}
	
	public function list_insurance($company_id){

		$this->db->select('ec.*,ec.id insur_id,
		comp.fname comp_fname,comp.lname comp_lname,comp.name comp_name,
		buy.fname buy_fname,buy.lname buy_lname,buy.name buy_name,
		ins.course_title insurance_name');
		$this->db->from($this->insuranceTbl.' ec');
		$this->db->join($this->userTbl.' comp','comp.id = ec.company_id');
		$this->db->join($this->userTbl.' buy','buy.id = ec.user_id');
		$this->db->join($this->buyinsuranceTbl.' bi','bi.bi_id = ec.bi_id');
		$this->db->join($this->courseTbl.' ins','ins.id = bi.insurance_id');
		$this->db->where('ec.company_id',$company_id); //insuranceTbl = tbl_existing_certificate
		$this->db->order_by('ec.id','DESC');
		$query = $this->db->get(); 
		$result = $query->result_array();
		// echo $this->db->last_query(); die;
		return $result;
	}

	
	public function one_insurance($insure_id){
		$this->db->where('insure_id',$insure_id);
		$query = $this->db->get($this->carInsuranceTbl);
		$result = $query->row_array();
		return $result;
	}
	public function delete_insurance($insure_id){
		$this->db->where('insure_id',$insure_id);
		$query = $this->db->delete($this->carInsuranceTbl);
		return $query;
	}

	public function edit_insurance($insure_id,$post){
		$this->db->where('insure_id',$insure_id);
		return $this->db->update($this->carInsuranceTbl,$post);	
	}

	public function update_ins_user($profid,$pins_id){
		$pid = end(explode('-',$pins_id));
		$update['parent_insititution'] = $pid;
		$update['insititution_id'] = $pins_id;
		$this->db->where('id',$profid);
		$this->db->update($this->userTbl,$update);
		$update_id = $this->db->affected_rows();
		if($update_id > 0){
			$returnvalue = $profid;
		}else{
			$returnvalue = 0;
		}
		return $returnvalue;
	}

	public function activate_staff($id){
		$update['activated'] = 1;
		$this->db->where('id',$id);
		$this->db->update($this->institutionStaffTbl,$update);
		$update_id = $this->db->affected_rows();
		if($update_id > 0){
			$returnvalue = $id;
		}else{
			$returnvalue = 0;
		}
		return $returnvalue;
	}

	public function get_training_certificate_list($tid){
		$this->db->where('training_id',$tid);
		$this->db->from($this->trainingCertificateListsTbl);
		$query = $this->db->get();
		$result= $query->result_array();
		return $result;
	}

	public function course_income($userid,$reportType,$title = false,$date = false,$month=false,$year=false){
		// echo $userid.',re=>'.$reportType.',ti=>'.$title; die;
		$author = ($_GET['author']!='')?$_GET['author']:"";
		$this->db->select('u.name buyer, c.user_id, c.price, c.tax ctax, c.total,c.course_title,purl.id pid,purl.amount as unitprice,purl.quantity,purl.tax ,purl.txn_id,purl.added_on,(purl.quantity * purl.amount) amount'); 
		$this->db->from('tbl_course c');
		$this->db->join('tbl_purchase_llis purl','c.id = purl.item_name');
		$this->db->join('tbl_user u','u.id = purl.user_id');
		
		$this->db->where('purl.status',1);
		$this->db->where('purl.txn_id !=','');
		if($userid != ""){
			$this->db->group_start();
			$this->db->where('c.user_id',$userid);
			$this->db->or_where('c.author_reference_id',$userid); 
			$this->db->group_end();
		}
		if($title != ""){
			$this->db->like('c.course_title',$title);		
		}
		if($author != ""){
			$this->db->where('c.user_id',$author);		
		}
		if($date != ""){
			$this->db->where('purl.added_on',$date);		
		}
		if($month != "" && $year != ""){
			$this->db->where('YEAR(purl.added_on) =',$year); 
			$this->db->where('MONTH(purl.added_on) =',$month); 		
		}
		if($year != ""){
			$this->db->where('YEAR(purl.added_on) =',$year); 
		}
		if($reportType == "today"){
			$today = date('Y-m-d');
			$this->db->where('purl.added_on',$today);		
		}
		if($reportType == "month"){
			$year  = date('Y');
			$month = date('m');
			$this->db->where('YEAR(purl.added_on) =',$year); 
			$this->db->where('MONTH(purl.added_on) =',$month); 
		}
		if($reportType == "year"){
			$year  = date('Y');
			$this->db->where('YEAR(purl.added_on) =',$year);

		} 
		$this->db->order_by('purl.id','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		// echo $this->db->last_query();
		return $result;
		
	}
		public function training_income($userid,$reportType,$title = false,$date = false,$month=false,$year=false){
			// echo $userid.',re=>'.$reportType.',ti=>'.$title; die;
			$this->db->select('u.name buyer,u.country,t.user_id,t.title,tb.id tid,tb.amount,tb.tax,tb.added_on'); 
			$this->db->from('tbl_training_book tb');
			$this->db->join('tbl_training t','tb.training_seminar_id = t.id');
			$this->db->join('tbl_user u','tb.user_id = u.id');
			$this->db->where('t.user_id',$userid);

			if($title != ""){
				$this->db->like('t.title',$title);		
			}
			if($date != ""){
				$this->db->where('tb.added_on',$date);		
			}
			if($month != "" && $year != ""){
				$this->db->where('YEAR(tb.added_on) =',$year); 
				$this->db->where('MONTH(tb.added_on) =',$month); 		
			}
			if($reportType == "today"){
				$today = date('Y-m-d');
				$this->db->where('tb.added_on',$today);		
			}
			if($reportType == "month"){
				$year  = date('Y');
				$month = date('m');
				$this->db->where('YEAR(tb.added_on) =',$year); 
				$this->db->where('MONTH(tb.added_on) =',$month); 
			}
			if($reportType == "year"){
				$year  = date('Y');
				$this->db->where('YEAR(tb.added_on) =',$year);

			} 
			$this->db->order_by('tb.added_on','desc');
			$query = $this->db->get();
			$result = $query->result_array();
			// echo $this->db->last_query().'<br>';
			return $result;
		}
		public function total_income($userid,$reportType,$title = false){
			// echo $userid.',re=>'.$reportType.',ti=>'.$title; die;

			$courseIncome 		= 0;
			$trainingIncome 	= 0;
			$courseIncomeArr 	= $this->course_income($userid,$reportType,$title,'','','');
			$tratningArr 		= $this->training_income($userid,$reportType,$title,'','','');
			//print_r($courseIncomeArr);
			foreach($courseIncomeArr as $crsinc){
				// $courseIncome +=  ($crsinc['amount']*70)/100;
				$courseIncome +=  $crsinc['amount'];
			}
			// foreach($tratningArr as $trainc){
			// 	$trainingIncome +=  $trainc['amount'];
			// }
			//$trainingIncome 	= $this->training_income($userid);
			return $courseIncome + $trainingIncome;
		}
		public function total_tax($userid,$reportType){
			$courseTax 		= 0;
			$trainingTax 	= 0;
			$courseIncomeArr 	= $this->course_income($userid,$reportType,'','','','');
			$tratningArr 		= $this->training_income($userid,$reportType,'','','','');
			//print_r($courseIncomeArr);
			foreach($courseIncomeArr as $crsinc){
				$courseTax +=  ($crsinc['tax']*70)/100;
			}
			// foreach($tratningArr as $trainc){
			// 	$trainingTax +=  $trainc['tax'];
			// }
			//$trainingIncome 	= $this->training_income($userid);
			return $courseTax + $trainingTax;
		}
		public function getSum($userid,$date){
			$amount 			= 0;
			$courseIncomeArr 	= $this->course_income($userid,'','',$date,'','');
			//$tratningArr 		= $this->training_income($userid,'',$date,'','');
			foreach($courseIncomeArr as $crsinc){
				$amount +=  $crsinc['amount'];
			}
			/* foreach($tratningArr as $trainc){
				$amount +=  $trainc['amount'];
			} */
			$returnarray = array('amount'=>$amount);
			return $returnarray;
		} 
		public function daywiseTrainingIncome($userid,$date){
			$amount 			= 0;
			$tratningArr 		= $this->training_income($userid,'','',$date,'','');
			foreach($tratningArr as $trainc){
				$amount +=  $trainc['amount'];
			}
			$returnarray = array('amount'=>$amount);
			return $returnarray;
		} 
		public function courseIncomereport($userid,$month,$year){
			$amount 			= 0;
			$courseIncomeArr 	= $this->course_income($userid,'','','',$month,$year);
			foreach($courseIncomeArr as $crsinc){
				$amount +=  $crsinc['amount'];
			}
			
			$returnarray = array('amount'=>$amount);
			return $returnarray;
		} 
		public function traingIncomereport($userid,$month,$year){
			$amount 			= 0;
			$courseIncomeArr 	= $this->training_income($userid,'','','',$month,$year);
			foreach($courseIncomeArr as $crsinc){
				$amount +=  $crsinc['amount'];
			}
			$returnarray = array('amount'=>$amount);
			return $returnarray;
		} 
			
		public function exam_list($userid){
			$this->db->select('e.*,c.course_title,c.units,u.name,ctr.countries_name');
			$this->db->from('tbl_exam e');
			$this->db->join('tbl_course c' ,'e.course_id = c.id');	
			$this->db->join('tbl_user u' ,'e.user_id = u.id','left');	
			$this->db->join('countries ctr' ,'u.country = ctr.countries_id','left');	
			$this->db->where('c.user_id',$userid);
			$this->db->or_where('c.author_reference_id',$userid);

			$this->db->group_start();
			$this->db->where('e.certificate_id !=' ,"");
			$this->db->group_end();

			$this->db->order_by('e.id','desc');
			$query = $this->db->get();
			$result = array();
			if($query !== FALSE && $query->num_rows() > 0){
			    foreach ($query->result_array() as $row) {
			        $result[] = $row;
			    }
			}else{
				$result=0;
			}
			return $result;
		}

		public function author_exam_list($userid){
			$this->db->select('e.*,c.course_title,c.units,u.name,ctr.countries_name');
			$this->db->from('tbl_exam e');
			$this->db->join('tbl_course c' ,'e.course_id = c.id');	
			$this->db->join('tbl_user u' ,'e.user_id = u.id');	
			$this->db->join('countries ctr' ,'u.country = ctr.countries_id');
			$this->db->where('c.user_id',$userid);

			$this->db->group_start();
			$this->db->where('e.certificate_id !=' ,"");
			$this->db->group_end();
			
			$this->db->order_by('e.id','desc');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		} 
		public function training_list($userid){
			
			$this->db->select('t.id as tid,t.title,t.units,u.name,ctr.countries_name,tb.*');
			$this->db->from('tbl_training t');
			$this->db->join('tbl_training_book tb' ,'t.id = tb.training_seminar_id');
			$this->db->join('tbl_user u' ,'tb.user_id = u.id');	
			$this->db->join('countries ctr' ,'u.country = ctr.countries_id');	
			$this->db->where('t.user_id',$userid);
			
			$this->db->group_start();
			$this->db->where('tb.certificate_id !=' ,"");
			$this->db->group_end();
			
			$this->db->order_by('t.id','desc');
			$query = $this->db->get();
			$result = array();
			if($query !== FALSE && $query->num_rows() > 0){
			    foreach ($query->result_array() as $row) {
			        $result[] = $row;
			    }
			}else{
				$result=0;
			}
			return $result;
		}
		public function author_list($id){
			
			$this->db->select('*');
			$this->db->from('tbl_user');
			$this->db->where(array('under_provider'=>$id)); /*here parent is CE providers.*/
			$this->db->order_by('id','desc');
			$query = $this->db->get();
			$result = $query->result_array();
			//echo $this->db->last_query(); die;
			return $result;
		} 
		function courseListing($user_id,$filter = false){
		
		$this->db->select('c.*, cat.cat_name, u.name');
        $this->db->from('tbl_course c' ); 
        $this->db->from('tbl_user u', 'c.user_id = u.id'); 
		$this->db->join('tbl_category cat', 'c.course_category = cat.id');
		// $this->db->group_start();
		// $this->db->where('c.user_id',$user_id)->or_where('c.author_reference_id',$user_id);
		// $this->db->group_end();
		//$this->db->where('c.course_for','a');
		//$this->db->where('c.status !=','3');
    	/* if($filter != '' && $filter != '2'){
			$this->db->where('c.status',$filter);
		}
		if($filter != '' && $filter == '2'){
			$this->db->where('c.licence_applied','1');
		} 
		echo $filter;*/
		if($filter != "" && $filter == "1"){
			$this->db->where('c.status','1');
		}
		if($filter != "" && $filter == "2"){
			$this->db->where('c.status','0');
		}
		if($filter != "" && $filter == "3"){
			$this->db->where('c.status','3');
		}
		$this->db->order_by('id','desc');
        $query = $this->db->get();
		// echo $this->db->last_query();
        $result = $query->result_array();       
        return $result;
	}
		
	public function get_active_course_promotion($uid = false)
	{
		$this->db->select('cp.*, c.course_title as title');
        $this->db->from('tbl_course_promotion cp' ); 
		$this->db->join('tbl_course c', 'c.id = cp.course_id');
		$this->db->order_by('id','desc');
		if(!empty($uid)){
		$this->db->where('cp.user_id',$uid);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}	
	public function get_active_training_promotion($uid = false)
	{
		$this->db->select('tp.*, t.title');
        $this->db->from('tbl_training_promotion tp' ); 
		$this->db->join('tbl_training t', 't.id = tp.training_id');
		$this->db->order_by('id','desc');
		if(!empty($uid)){
		$this->db->where('tp.user_id',$uid);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function get_training_publish($uid = false)
	{
		$this->db->select('tpub.*, t.title');
        $this->db->from('tbl_training_published tpub' ); 
		$this->db->join('tbl_training t', 't.id = tpub.training_id');
		$this->db->order_by('id','desc');
		if(!empty($uid)){
		$this->db->where('tpub.user_id',$uid);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
		
	public function get_result_array($tbl,$where=false)
	{
		if($where){
			$this->db->where($where);
		}
		$query = $this->db->get($tbl);
		$result = $query->result_array();
		return $result;
	}

	public function get_row_array($tbl,$where=false)
	{
		if($where){
			$this->db->where($where);
		}
		$query = $this->db->get($tbl);
		$result = $query->row_array();
		return $result;
	}	
		
	public function course_certificate_list($insArr){
			$this->db->select('e.*,c.course_title,c.units,u.name,ctr.countries_name');
			$this->db->from('tbl_exam e');
			$this->db->join('tbl_course c' ,'e.course_id = c.id','left');	
			$this->db->join('tbl_user u' ,'e.user_id = u.id','left');	
			$this->db->join('countries ctr' ,'u.country = ctr.countries_id','left');	
			// $this->db->where('c.insititution_id',$ins_id);
			$this->db->where_in('c.insititution_id',$insArr);  
			$this->db->group_start();
			$this->db->where('e.certificate_id !=' ,"");
			$this->db->group_end();

			$query = $this->db->get();
			$result = array();
			if($query !== FALSE && $query->num_rows() > 0){
			    $result['data'] = $query->result_array();
				$result['num_rows'] = $query->num_rows();
			}else{
				$result['data'] = '';
				$result['num_rows'] = 0;
			}
			return $result;
		}

		public function exam_certificate_list($ins_id){
			$this->db->select('e.*,c.course_title,c.units,u.name,ctr.countries_name');
			$this->db->from('tbl_exam e');
			$this->db->join('tbl_course c' ,'e.course_id = c.id','left');	
			$this->db->join('tbl_user u' ,'e.user_id = u.id','left');	
			$this->db->join('countries ctr' ,'u.country = ctr.countries_id','left');	
			$this->db->where('c.insititution_id',$ins_id);

			$this->db->group_start();
			$this->db->where('e.certificate_id !=' ,"");
			$this->db->group_end();

			$query = $this->db->get();
			$result = $query->result_array();
			// echo $this->db->last_query(); die;
			return $result;
		}

		public function training_certificate_list($insArr){
			
			$this->db->select('t.id as tid,t.title,t.units,u.name,ctr.countries_name,tb.*');
			$this->db->from('tbl_training_book tb');
			$this->db->join('tbl_training t','tb.training_seminar_id = t.id','left');
			$this->db->join('tbl_user u' ,'tb.user_id = u.id','left');	
			$this->db->join('countries ctr' ,'u.country = ctr.countries_id','left');	
			// $this->db->where('t.insititution_id',$ins_id);
			$this->db->where_in('t.insititution_id',$insArr);  
			
			$this->db->group_start();
			$this->db->where('tb.certificate_id !=' ,"");
			$this->db->group_end();
			
			$query = $this->db->get();
			$result = array();
			if($query !== FALSE && $query->num_rows() > 0){
			    $result['data'] = $query->result_array();
				$result['num_rows'] = $query->num_rows();
			}else{
				$result['data'] = '';
				$result['num_rows'] = 0;
			}
			return $result;
		}	
		public function training1_certificate_list($ins_id){
			
			$this->db->select('t.id as tid,t.title,t.units,u.name,ctr.countries_name,tb.*');
			$this->db->from('tbl_training_book tb');
			$this->db->join('tbl_training t','tb.training_seminar_id = t.id','left');
			$this->db->join('tbl_user u' ,'tb.user_id = u.id','left');	
			$this->db->join('countries ctr' ,'u.country = ctr.countries_id','left');	
			$this->db->where('t.insititution_id',$ins_id);
			
			$this->db->group_start();
			$this->db->where('tb.certificate_id !=' ,"");
			$this->db->group_end();
			
			$query = $this->db->get();
			$result = $query->result_array();
			// echo'<pre>';print_r($result);die;
			// echo $this->db->last_query(); die;
			return $result;
		}
			
		public function training_demographics($tid){
			$this->db->select('tb.memberstatus,tc.cat_name profession,tb.institution,tb.position,tb.island,tb.other,co.countries_name');
            $this->db->from('tbl_training_book tb');
            $this->db->join('tbl_training t','tb.training_seminar_id = t.id','LEFT');
            $this->db->join('tbl_category tc','tb.profession_id = tc.id','LEFT');
            $this->db->join('countries co','tb.country = co.countries_id','LEFT');
            $this->db->where('tb.training_seminar_id',$tid);
            $query = $this->db->get();
            $result = $query->result_array();
			// echo $this->db->last_query(); die;
			return $result;
		}	
			
				
		public function training_demographics_others($tcat_id){
			$this->db->select('tc.*');
            $this->db->from('tbl_registration_category tc');
            $this->db->join('tbl_registration_option to','tc.id = to.category_id','LEFT');
            $this->db->where('tc.id',$tcat_id);
            $query = $this->db->get();
            $result = $query->result_array();
			// echo $this->db->last_query(); die;
			return $result;
		}	

		public function get_training_details($tid,$status=false){
			$this->db->select('tb.*,tb.memberstatus,tc.cat_name profession,tb.institution,tb.position,tb.island,tb.other,co.countries_name');
            $this->db->from('tbl_training_book tb');
            $this->db->join('tbl_training t','tb.training_seminar_id = t.id','LEFT');
            $this->db->join('tbl_category tc','tb.profession_id = tc.id','LEFT');
            $this->db->join('countries co','tb.country = co.countries_id','LEFT');
            $this->db->order_by('tb.id','desc');
            $this->db->where('tb.training_seminar_id',$tid);
            if($status != null){
            	 $this->db->where(array('tb.certificate_id' =>NULL,'tb.present_status'=>$status));
            }
            $query = $this->db->get();
            $result = $query->result_array();
			// echo $this->db->last_query(); die;
			return $result;
		}

		function get_selected_certificate($tid,$uid)
		{
			$this->db->select('tcl.*, ct.temppreview , ct.template_no');
			$this->db->from('tbl_training_certificate_lists tcl');
			$this->db->join('tbl_certificate_template ct','tcl.templete_id = ct.id');
			$this->db->where('tcl.training_id',$tid);
			$this->db->where('tcl.user_id',$uid);
			$query = $this->db->get();
			$result = $query->row_array();
			return $result;
		}	

		function get_stafflist_for_payment($pins_id)
		{
			$this->db->select('is.*,u.id as pid');
			$this->db->from('tbl_institution_staff is');
			$this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
			$this->db->where('is.insititution_code',$pins_id);
			$this->db->where('is.status','1');
			$this->db->where('is.prof_id !=',0);
			$this->db->where('is.activated','0');	
			$this->db->group_by('u.username_email');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}	

		function get_stafflist($pins_id)
		{
			$this->db->select('is.*,u.id as pid');
			$this->db->from('tbl_institution_staff is');
			$this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
			$this->db->where('is.insititution_code',$pins_id);
			$this->db->group_by('u.username_email');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}	

		function get_activated_stafflist($pins_id)
		{
			$this->db->select('is.*,u.id as pid');
			$this->db->from('tbl_institution_staff is');
			$this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
			$this->db->where('is.insititution_code',$pins_id);
			$this->db->group_by('u.username_email');
			$this->db->where('is.activated','1');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}	

		function provider_target_accomplishment($user_id,$status){
			$this->db->where('user_id',$user_id);
			$this->db->where('status',$status);
			$query1 = $this->db->get($this->providerSetTargetTbl);
			if($query1->num_rows() > 0){ 
				$result = $query1->result(); 
				
				$commonArr = array();
				foreach ($result as $key => $value){
					if($value->category=='Course'){
						$title = $this->db->get_where('tbl_course',array('id'=>$value->cource_name))->row_array()['course_title'];	
						
						$this->db->from('tbl_exam e');
						$this->db->join('tbl_course c' ,'e.course_id = c.id');		
						$this->db->where('e.course_id',$value->cource_name);
						$this->db->group_start();
						$this->db->where('e.certificate_id !=' ,"");
						$this->db->group_end();
						$query = $this->db->get();
						$achievements = $query->num_rows();
						
						$category = 'Online Course';
					}
					if($value->category=='Training'){
						$title = $this->db->get_where('tbl_training',array('id'=>$value->cource_name))->row_array()['title']; 
						$this->db->from('tbl_training t');
						$this->db->join('tbl_training_book tb' ,'t.id = tb.training_seminar_id');
						$this->db->where('tb.training_seminar_id',$value->cource_name);
						$this->db->group_start();
						$this->db->where('tb.certificate_id !=' ,"");
						$this->db->group_end();
						$query = $this->db->get();
						$achievements = $query->num_rows();
						
						$category = 'Training';
					}  
					$commonArr[] = array(
						'id'		=> $value->id,
						'user_id'	=> $value->user_id,
						'total_staff'=> $value->total_staff,
						'target_number'=> $value->target_number,
						'title' 	=> $title,
						'category' 	=> $category,
						'achievements' 	=> $achievements,
						'institution_id'=> $value->institution_id,
						'implementation_date'=> $value->implementation_date,
					);
				}
				$data = $commonArr;
				// echo '<pre>'; print_r($commonArr);die;
			} else{ 
				$data = false; 
			}  
			return $data;
		}
		
		function get_one_course($cid,$uid){
			$this->db->select('c.*,u.name,u.address,u.username_email,u.image,u.company_email');
			$this->db->from('tbl_course c');
			$this->db->join('tbl_user u' ,'c.user_id = u.id','left');
			$this->db->where('c.id',$cid);
			$this->db->where('c.user_id',$uid);
			$this->db->or_where('c.author_reference_id',$uid);
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			if($query !== FALSE && $query->num_rows() > 0){
			   $result = $query->row();
			}
			return $result;
		}
		
		// function get_one_insurance($cid,$uid = false){
		// 	$this->db->select('c.*,u.name,u.address,u.username_email,u.image,u.company_email');
		// 	$this->db->from('tbl_course c');
		// 	$this->db->join('tbl_user u' ,'c.user_id = u.id','left');
		// 	$this->db->where('c.id',$cid);
		// 	// $this->db->where('c.user_id',$uid);
		// 	// $this->db->or_where('c.author_reference_id',$uid);
		// 	$query = $this->db->get();
		// 	// echo $this->db->last_query(); die;
		// 	if($query !== FALSE && $query->num_rows() > 0){
		// 	   $result = $query->row();
		// 	}
		// 	return $result;
		// }

		function get_course_lesson($cid,$uid){
			$this->db->select('l.*,u.name,u.address,u.username_email,u.image,u.company_email');
			$this->db->from('tbl_lesson l');
			$this->db->join('tbl_user u' ,'l.user_id = u.id','left');
			$this->db->where('l.course_id',$cid);
			$this->db->where('l.user_id',$uid);
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			if($query !== FALSE && $query->num_rows() > 0){
			   $result = $query->result();
			}
			return $result;
		}

		function get_course_quiz($cid){
			$this->db->from('tbl_quiz_question');
			$this->db->where('course_id',$cid);
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			if($query !== FALSE && $query->num_rows() > 0){
			   $result = $query->result();
			}
			return $result;
		}

		function get_course_certificate($cid,$uid){
			$this->db->select('uc.*,ct.temppreview');
			$this->db->from('tbl_user_certificate uc');
			$this->db->join('tbl_certificate_template ct','uc.templete_id = ct.id','left');
			$this->db->where('uc.course_id',$cid);
			$this->db->where('uc.user_id',$uid);
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			if($query !== FALSE && $query->num_rows() > 0){
			   $result = $query->row();
			}
			return $result;
		}	

		function get_course_evaluation($cid){
			$this->db->select('e.*');
			$this->db->from('tbl_evaluation e');
			$this->db->where('e.course_id',$cid);
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			if($query !== FALSE && $query->num_rows() > 0){
			   $result = $query->result();
			}
			return $result;
		}	

		function get_one_training($cid,$uid){
			$this->db->select('t.*,u.name,u.address,u.username_email,u.image,u.company_email');
			$this->db->from($this->trainingTbl.' t');
			$this->db->join($this->userTbl.' u' ,'t.user_id = u.id','left');
			$this->db->where('t.id',$cid);
			$this->db->where('t.user_id',$uid);
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			if($query !== FALSE && $query->num_rows() > 0){
			   $result = $query->row();
			}
			return $result;
		}

		function get_training_evaluation($tid){
			$this->db->select('te.*');
			$this->db->from($this->trainingEvaluationTbl.' te');
			$this->db->where('te.training_id',$tid);
			$this->db->order_by('te.evaluation_type','ASC');
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			if($query !== FALSE && $query->num_rows() > 0){
			   $result = $query->result();
			}
			return $result;
		}

		function get_training_certificate($tid,$uid){
			$this->db->select('uc.*,ct.temppreview');
			$this->db->from($this->trainingCertificateListsTbl.' uc');
			$this->db->join($this->certificateTemplateTbl.' ct','uc.templete_id = ct.id','left');
			$this->db->where('uc.training_id',$tid);
			$this->db->where('uc.user_id',$uid);
			$query = $this->db->get();
			if($query !== FALSE && $query->num_rows() > 0){
			   $result = $query->row();
			}
			return $result;
		}
	
	public function matchRboardCode($where){
		$this->db->where($where);
		$query = $this->db->get($this->rboardDetailsTbl);
		if($query !== false)
		{
			$result = $query->row();
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function alreadyConnnected($data){
		$this->db->where($data);
		$query = $this->db->get($this->userConnectRboardTbl);
		$result = $query->row();
		return $result;
	}

	public function saveUserRboardConnect($data){
		$this->db->insert($this->userConnectRboardTbl,$data);
		$result = $this->db->insert_id();
		return $result;
	}

	public function getConnnectedRboard($uid){
		$this->db->select('ucr.*, u.name rboard_name');
		$this->db->from($this->userConnectRboardTbl.' ucr'); 
		$this->db->join($this->userTbl.' u', 'ucr.rboard_id = u.id');
		$this->db->where('ucr.user_id',$uid);
		$this->db->where('ucr.status','1');
		$this->db->where('ucr.role',2);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function getRBdetails($uid){
		$this->db->select('ucr.*, rbd.rb_name rboard_name, rbd.domain');
		$this->db->from($this->userConnectRboardTbl.' ucr'); 
		$this->db->join($this->rboardDetailsTbl.' rbd','ucr.rboard_id = rbd.user_id');
		$this->db->where('ucr.user_id',$uid);
		$this->db->where('ucr.status','1');
		$this->db->where('ucr.role',2);
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}

	public function getRBProfDetails($uid){
		$this->db->select('ucr.*, rbd.rb_name rboard_name, rbd.domain');
		$this->db->from($this->userConnectRboardTbl.' ucr'); 
		$this->db->join($this->rboardDetailsTbl.' rbd','ucr.rboard_id = rbd.user_id');
		$this->db->where('ucr.user_id',$uid);
		$this->db->where('ucr.status','1');
		$this->db->where('ucr.role',1);
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}
	
	public function getDigitalCertificatePackage()
	{
		$this->db->from($this->digitalCertificatePackageTbl);
		$this->db->where('dcp_status','1');
		$this->db->order_by('disp_position','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function insertpayment($data){
		$this->db->insert($this->paymentTransactionTbl,$data);
		return $this->db->insert_id();
	}

	public function updatpayment($post){
		$paymentid = $post['item_number1']; 
		$update = array(
			'buyer_name' 		=> $post['first_name'].' '.$post['last_name'],
			'buyer_email' 		=> $post['payer_email'],
			'txn_id' 			=> $post['txn_id'],
			'payment_status' 	=> $post['payment_status'],
			'transaction_details' => json_encode($post),
			'added_on' 			=> date('Y-m-d H:i:s')
		);
		$this->db->where('id',$paymentid);
		$this->db->update($this->paymentTransactionTbl,$update);
		$update_id = $this->db->affected_rows();
		if($update_id > 0){
			$returnvalue = $paymentid;
		}else{
			$returnvalue = 0;
		}
		return $returnvalue;
	}

	function get_userid($id){
		
		$this->db->from($this->paymentTransactionTbl.' pi');
		$this->db->where('pi.id', $id);
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}

	function insert_usedInsuranceCertificate($data){
		$this->db->insert($this->usedInsuranceCertificate,$data);
		return $this->db->insert_id();
	}

	function insert_usage_of_subscribed_digital_package($data){
		$this->db->insert($this->usedInsuranceCertificate,$data);
		return $this->db->insert_id();
	}

	function get_usage_of_subscribed_digital_package($uid){
		$this->db->from($this->usedInsuranceCertificate);
		$this->db->where('provider_id',$uid);
		$q = $this->db->get();
		$result['result'] = $q->result_array();
		$result['number'] = $q->num_rows();
		// echo $this->db->last_query(); die;
		return $result;
	}

	function get_one_dc_subscription_package($id){
		$this->db->from($this->digitalCertificatePackageTbl);
		$this->db->where('dcp_id',$id);
		$q = $this->db->get();
		$result = $q->row();
		return $result;
	}

	function current_subscription_package($uid){
		$this->db->from($this->subscribedDigitalCertificateTbl);
		$this->db->where('user_id',$uid);
		$this->db->order_by('sdc_id','DESC');
		$q = $this->db->get();
		$result = $q->row();
		return $result;
	}

	function subscriped_packages($uid){
		$this->db->select('sdc.*, dcp.subcription_name');
		$this->db->from($this->subscribedDigitalCertificateTbl.' sdc');
		$this->db->join($this->digitalCertificatePackageTbl.' dcp','sdc.dcp_id = dcp.dcp_id');
		$this->db->where('user_id',$uid);
		$this->db->where('sdc_status',1);
		$q = $this->db->get();
		$result = $q->result();
		return $result;
	}

	function getPurchseList($uid){
		$this->db->from($this->paymentTransactionTbl);
		$this->db->where('txn_id !=','');
		$this->db->where('user_id',$uid);
		$q = $this->db->get();
		$result = $q->result_array();
		return $result;
	}

	function validating_ocaccreditation($post){
		$this->db->from($this->accreditationTbl);
		$this->db->where('user_id',$post['provider_id']);
		$this->db->where('doc_id',$post['course_id']);
		$this->db->where('type','oc');
		$this->db->where('acc_number',$post['accreditation_num']);
		$this->db->where('validity',$post['accreditation_validity']);
		$q = $this->db->get();
		$result = $q->row_array();
		// echo $this->db->last_query();die;
		return $result;
	}

	
	public function update_ocaccreditation($data){
		$update = array(
					'course_acceditation_number' => $data['accreditation_num'],
					'course_validity' => $data['accreditation_validity']
				);
		$this->db->where(array(
								'id' => $data['course_id'],
								'user_id'=>$data['provider_id']
							)
						);
		return $this->db->update($this->courseTbl,$update);
		
		// echo $this->db->last_query();die;
		// $update_id = $this->db->affected_rows();
		// return ($update_id)?$update_id:0;
	}

	function validating_tcaccreditation($post){
		$this->db->from($this->accreditationTbl);
		$this->db->where('user_id',$post['provider_id']);
		$this->db->where('doc_id',$post['training_id']);
		$this->db->where('type','tc');
		$this->db->where('acc_number',$post['accreditation_num']);
		$this->db->where('validity',$post['accreditation_validity']);
		$q = $this->db->get();
		$result = $q->row_array();
		// echo $this->db->last_query();die;
		return $result;
	}

	
	public function update_tcaccreditation($data){
		$tid = $data['training_id'];
		$pid = $data['provider_id'];
		$update['accreditation_no'] = $data['accreditation_num'];
		$update['accreditation_validity'] = $data['accreditation_validity'];
		$this->db->where(['id'=>$tid, 'user_id'=>$pid]);
		return $this->db->update($this->trainingTbl,$update);
		// $update_id = $this->db->affected_rows();
		// return ($update_id)?$update_id:0;
	}
	
	public function update_accreditation_verification_doc_training($where,$data){
		$update = array(
					'accreditation_verification_doc' => $data['accreditation_verification_doc']
				);
		$this->db->where(array(
								'id' => $where['training_id'],
								'user_id'=>$where['provider_id']
							)
						);
		$this->db->update($this->trainingTbl,$update);
		$update_id = $this->db->affected_rows();
		
		if($update_id):
			$logData = array(
				'provider_id'=>$where['provider_id'],
				'doc_id' => $where['training_id'],
				'type' => 'tc',
				'status' => '0',
				'added_on' => date('Y-m-d')
			);
			$this->db->insert($this->accreditationVerificationLogTbl,$logData);
		endif;
		return ($update_id)?$update_id:0;
	}
	
	public function update_accreditation_verification_doc_course($where,$data){
		$update = array(
					'accreditation_verification_doc' => $data['accreditation_verification_doc']
				);
		$this->db->where(array(
								'id' => $where['course_id'],
								'user_id'=>$where['provider_id']
							)
						);
		$this->db->update($this->courseTbl,$update);
		$update_id = $this->db->affected_rows();
		
		if($update_id):
			$logData = array(
				'provider_id'=>$where['provider_id'],
				'doc_id' => $where['course_id'],
				'type' => 'oc',
				'status' => '0',
				'added_on' => date('Y-m-d')
			);
			$this->db->insert($this->accreditationVerificationLogTbl,$logData);
		endif;
		return ($update_id)?$update_id:0;
	}

	
	public function getAccreditationVerificationLog($tid,$pid){
		$this->db->where('doc_id',$tid);
		$this->db->where('provider_id',$pid);
		$this->db->from($this->accreditationVerificationLogTbl);
		$this->db->order_by('avl_id','desc');
		$query = $this->db->get();
		$result= $query->row_array();
		return $result;
	}

	public function updateAccreditationVerificationLog($avlid){
		$update = array( 'status' => '1', 'updated_at' => date('Y-m-d') );
		$this->db->where('avl_id',$avlid);
		$this->db->update($this->accreditationVerificationLogTbl,$update);
		$update_id = $this->db->affected_rows();
		return ($update_id)?$update_id:0;
	}

	public function publishTrainingAccreditationVerification($tid){
		$update = array('status' => '2');
		$this->db->where('id',$tid);
		$this->db->update($this->trainingTbl,$update);
		$update_id = $this->db->affected_rows();
		return ($update_id)?$update_id:0;
	}

	public function publishCourseAccreditationVerification($cid){
		$update = array('status' => '1');
		$this->db->where('id',$cid);
		$this->db->update($this->courseTbl,$update);
		$update_id = $this->db->affected_rows();
		return ($update_id)?$update_id:0;
	}

	public function get_all_insurance_sale($uid)
	{
		$this->db->from($this->courseTbl);
		$this->db->where('user_id',$uid);
		// $this->db->where('user_id',$uid);
		$q = $this->db->get();
		$result = $q->result_array();
		return $result;
	}

	public function get_all_insurance_sale_under_company($uid)
	{
		$this->db->select('i.*,i.id insur_id,i.user_id broker_id,i.author_reference_id company_id,u.fname, u.lname, u.name, ci.name company_name');
		$this->db->from($this->courseTbl.' i');
		$this->db->join($this->userTbl.' u','u.id = i.user_id');
		$this->db->join($this->userTbl.' ci','ci.id = i.author_reference_id');
		$this->db->where('i.author_reference_id',$uid);
		// $this->db->where('i.status',1);
		$q = $this->db->get();
		$result = $q->result_array();
		return $result;
	}

	public function get_one_sale_insurance($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get($this->courseTbl);
		$result = $query->row_array();
		return $result;
	}

	public function update_insurance_sale($id,$data){
		$this->db->where('id',$id);
		return $this->db->update($this->courseTbl,$data);	
	}

	public function delete_sale($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete($this->courseTbl);
		return $query;
	}
}
?>