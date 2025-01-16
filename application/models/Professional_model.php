<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	//public $tablecourse = 'tbl_course';
	
class Professional_model extends CI_Model {
		public function  __construct()
		{
			parent::__construct();
			$this->userTbl 		= 'tbl_user';
			$this->courseTbl 	= 'tbl_course';
			$this->trainingTbl 	= 'tbl_training';
			$this->userCertificateTbl = 'tbl_user_certificate';
			$this->existingCertificateTbl = 'tbl_existing_certificate';
			$this->rboardDetailsTbl 	= 'tbl_rboard_details';
			$this->userConnectRboardTbl = 'tbl_user_connect_rboard';
			$this->buyinsuranceTbl = 'tbl_buy_insurance';
			$this->insuranceTbl 	= 'tbl_existing_certificate'; //we will use this table for stoer insurance certificate
		}

		public function planlisting($planid = false){
			$this->db->select('pp.*'); 
			$this->db->from('tbl_professional_plan pp');
			//$this->db->join('tbl_purchase_llis purl','c.id = purl.item_name');
			$this->db->order_by('pp.propla_id','asc');
			if($planid != ""){
			//$this->db->where_in('pp.plan_id',$planid);
			$this->db->where('pp.plan_id',$planid);
			}
			$this->db->where('pp.pro_plan_status','1');
			$query = $this->db->get();
			$result = $query->result_array();
			//echo $this->db->last_query();
			return $result;
		}
		public function plandetails($ids = false){
			$this->db->select('ppf.*'); 
			$this->db->from('tbl_professional_plan_features ppf');
			//$this->db->join('tbl_purchase_llis purl','c.id = purl.item_name');
			$this->db->where('ppf.features_status','1');
			if($ids != ""){
			$this->db->where_in('ppf.ppf_id',$ids,false);
			}
			$this->db->order_by('ppf.ppf_id','asc');
			$query = $this->db->get();
			$result = $query->result_array();
			//echo $this->db->last_query();
			return $result;
		}
		public function checkactiveplan($userid){
			$this->db->select('u.id,ppp.*'); 
			$this->db->from('tbl_user u');
			$this->db->join('professional_pce_plan ppp','u.id = ppp.user_id','left');
			$this->db->where('u.id',$userid);
			$query = $this->db->get();
			$result = $query->row_object();
			//echo $this->db->last_query();
			return $result;
		}
		public function planprofessionaldetails($planid){
			$this->db->select('*'); 
			$this->db->from('tbl_professional_plan');
			$this->db->where('propla_id',$planid);
			$query = $this->db->get();
			$result = $query->row_object();
			//echo $this->db->last_query();
			return $result;
		}
		public function planpaymenthistory($userid,$currentplanid){
			$this->db->select('pppph.*,ppp.*'); 
			$this->db->from('professional_pce_plan_payment_history pppph');
			$this->db->join('professional_pce_plan ppp','pppph.user_id = ppp.user_id');
			$this->db->where('pppph.pppph_id !=',$currentplanid);
			$this->db->where('pppph.user_id',$userid);
			$this->db->where('pppph.payment_transtion_id !=','');
			$this->db->where('ppp.payment_status','y');
			$this->db->order_by('pppph.pppph_id','desc');
			$query = $this->db->get();
			$result = $query->result_array();
			//echo $this->db->last_query();
			return $result;
		}
		
		public function purchase_course($uid){
			$this->db->select('	e.*,co.*');
			$this->db->from('tbl_exam e');
			$this->db->join('tbl_course co','co.id = e.course_id');
			$this->db->where('e.user_id',$uid);
			$this->db->group_by('e.certificate_id');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function purchase_training($uid){
			$this->db->select('	tb.*,t.*');
			$this->db->from('tbl_training_book tb');
			$this->db->join('tbl_training t','t.id = tb.training_seminar_id');
			$this->db->where('tb.user_id',$uid);
			$this->db->group_by('tb.certificate_id');
			return $result;
		}

		public function get_tutorial($type=false){
			if(!empty($type))
			{
				$this->db->where('type',$type);
			}
			$this->db->where('status','1');
			$result = $this->db->get('tbl_tutorial')->result_array();
			return $result; 
		}

		public function get_promotion_practise($uid=false)
		{
			if(!empty($uid))
			{
				$this->db->where('user_id',$uid);
			}
			$result = $this->db->get('tbl_promoted_provider_transaction')->result_array();
			return $result; 
		}

		public function get_latest_course_with_category($cat=false)
		{
			$this->db->select('c.*, ca.cat_name');
        	$this->db->from('tbl_course c'); 
			$this->db->join('tbl_category ca', 'c.course_category = ca.id');
			if(!empty($cat))
			{
				$this->db->where('c.course_category',$cat);
			}
			$this->db->where('c.insititution_id','0');
			$this->db->where('c.course_validity >=',date('Y-m-d'));
			$this->db->where('c.status',1);
			$this->db->order_by('c.id','DESC');
			$this->db->limit(10);
			$result = $this->db->get()->result_array();
			return $result; 
		}
		public function get_featured_course_with_category($cat=false)
		{	
			$this->db->select('c.*, ca.cat_name');
        	$this->db->from('tbl_course c'); 
			$this->db->join('tbl_category ca', 'c.course_category = ca.id');
			if(!empty($cat))
			{
				$this->db->where('c.course_category',$cat);
			}
			$this->db->where('c.insititution_id','0');
			$this->db->where('c.course_validity >=',date('Y-m-d'));
			$this->db->where('c.status',1);
			$this->db->where('c.paid_status',2);
			$this->db->order_by('c.id','DESC');
			$result = $this->db->get()->result_array();
			return $result; 
		}
		public function get_free_course_with_category($cat=false)
		{
			$this->db->select('c.*, ca.cat_name');
        	$this->db->from('tbl_course c'); 
			$this->db->join('tbl_category ca', 'c.course_category = ca.id');
			if(!empty($cat))
			{
				$this->db->where('c.course_category',$cat);
			}
			$this->db->where('c.insititution_id','0');
			$this->db->where('c.course_validity >=',date('Y-m-d'));
			$this->db->where('c.status',1);
			$this->db->where('c.paid_status',1);
			$this->db->order_by('c.id','DESC');
			$result = $this->db->get()->result_array();
			return $result; 
		}
		public function get_latest_training_with_category($cat=false)
		{
			$this->db->select('t.*, ca.cat_name');
        	$this->db->from('tbl_training t'); 
			$this->db->join('tbl_category ca', 't.category_id = ca.id');
			if(!empty($cat))
			{
				$this->db->where('t.category_id',$cat);
			}
			$this->db->where('t.insititution_id','0');
			$this->db->where('t.end_date >=',date('Y-m-d'));
			$this->db->where('t.status',2);
			$this->db->order_by('t.id','DESC');
			$this->db->limit(10);
			$result = $this->db->get()->result_array();
			return $result; 
		}
		public function get_featured_training_with_category($cat=false)
		{	
			$this->db->select('t.*, ca.cat_name');
        	$this->db->from('tbl_training t'); 
			$this->db->join('tbl_category ca', 't.category_id = ca.id');
			if(!empty($cat))
			{
				$this->db->where('t.category_id',$cat);
			}
			$this->db->where('t.insititution_id','0');
			$this->db->where('t.end_date >=',date('Y-m-d'));
			$this->db->where('t.status',2);
			$this->db->where('t.paid_status',2);
			$this->db->order_by('t.id','DESC');
			$result = $this->db->get()->result_array();
			return $result; 
		}
		public function get_free_training_with_category($cat=false)
		{
			$this->db->select('t.*, ca.cat_name');
        	$this->db->from('tbl_training t'); 
			$this->db->join('tbl_category ca', 't.category_id = ca.id');
			if(!empty($cat))
			{
				$this->db->where('t.category_id',$cat);
			}
			$this->db->where('t.insititution_id','0');
			$this->db->where('t.end_date >=',date('Y-m-d'));
			$this->db->where('t.status',2);
			$this->db->where('t.paid_status',1);
			$this->db->order_by('t.id','DESC');
			$result = $this->db->get()->result_array();
			return $result; 
		}

		public function get_fetured_professionals($where = false)
		{
			$this->db->select('tp.*, u.featured_from, u.featured_to');
        	$this->db->from('tbl_professionals tp'); 
			$this->db->join('tbl_user u', 'tp.user_id = u.id','left');
			$this->db->where('tp.user_type','1');
			if($where){
			$this->db->where($where);
			}
			$this->db->where('tp.status',1);
			$this->db->order_by('u.featured_from','DESC');
			$result = $this->db->get()->result_array();
			return $result; 
		}

		public function existing_certificate($id){
			$this->db->where('id',$id);
			$query = $this->db->get($this->existingCertificateTbl);
			$result = $query->row();
			return $result;
		}
		
		public function update_report($certificate_id,$report_id){
			$data['report'] = $report_id;
			$this->db->where('certificate_id',$certificate_id);
			$query = $this->db->update($this->existingCertificateTbl,$data);
			if ($this->db->affected_rows() > 0){
				// return TRUE;
				return $this->db->affected_rows();
			}else{
				return FALSE;
			}
		}

		public function matchRboardCode($where){
			$this->db->where($where);
			$query = $this->db->get($this->rboardDetailsTbl);
			$result = $query->row();
			return $result;
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
			$this->db->select('ucr.*, u.rb_name rboard_name, u.domain');
        	$this->db->from($this->userConnectRboardTbl.' ucr'); 
			// $this->db->join($this->userTbl.' u', 'ucr.rboard_id = u.id');
			$this->db->join($this->rboardDetailsTbl.' u', 'ucr.rboard_id = u.user_id');
			$this->db->where('ucr.user_id',$uid);
			$this->db->where('ucr.status','1');
			$this->db->where('ucr.role',1);
			$query = $this->db->get();
			$result = $query->row();
			return $result;
		}

		public function get_all_buy_insurance($uid)
		{		
			$this->db->select('bi.*, ci.course_title insur_name,bri.name m_broker,bri.fname f_broker,bri.lname l_broker, ui.name middle_name,ui.fname first_name,ui.lname last_name,ci.price price_insurance');
			$this->db->from($this->buyinsuranceTbl.' bi'); 
		 	 $this->db->join($this->courseTbl.' ci','ci.id = bi.insurance_id');
		 	 $this->db->join($this->userTbl.' bri','bri.id = bi.broker_id');
			$this->db->join($this->userTbl.' ui','ui.id = bi.company_id');
			$this->db->where('bi.user_id',$uid);
			$query = $this->db->get();
			$data = $query->result_array(); 
		  
			return $data;
		}

		public function get_all_insurance_by_user($uid){
			$this->db->select('bi.*,uc.id insur_id,uc.certificate_id insurance_no, uc.issue_date, uc.validity, uc.status status, uc.ref_id_for_owner ref_id,uc.send_to_rt_by_owner sent_status, ci.course_title insur_name,bri.name m_broker,bri.fname f_broker,bri.lname l_broker, ui.name middle_name,ui.fname first_name,ui.lname last_name,ci.price price_insurance');
			$this->db->from($this->buyinsuranceTbl.' bi'); 
			$this->db->join($this->courseTbl.' ci','ci.id = bi.insurance_id');
			$this->db->join($this->insuranceTbl.' uc','uc.bi_id = bi.bi_id'); /* it is very important that insurance got digital certificate to so it will be open in isurance listing */
			$this->db->join($this->userTbl.' bri','bri.id = bi.broker_id');
			$this->db->join($this->userTbl.' ui','ui.id = bi.company_id');
			$this->db->where('bi.user_id',$uid);
			$this->db->order_by('bi.bi_id','desc');
			$query = $this->db->get();
			$data = $query->result_array(); 
		  
			return $data;
		}
		
}