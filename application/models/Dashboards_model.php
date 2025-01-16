<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards_model extends CI_Model {
		function advs($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){	
			$this->db->select('app.id,app.tax,app.txn_id,app.no_of_view,app.transaction_details,app.purchased_on added_on, ap.package_name item_name,app.amount amount,u.role role,u.id user_id,u.name username,u.country,cty.countries_name,ap.package_name course_title,app.amount price');
			$this->db->from('tbl_adv_package_purchased app');
			$this->db->join('tbl_adv_package ap','app.package_id=ap.id','LEFT');
			$this->db->join('tbl_user u','app.user_id=u.id','LEFT');
			$this->db->join('countries cty','u.country=cty.countries_id','LEFT');
			$this->db->where('app.payment_status',1);
			if($country_id != ""){
				$this->db->where('u.country',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}

			if($day != ""){				
				$this->db->where('DAY(app.purchased_on) =',$day); 
			}

			if($month != ""){				
				$this->db->where('MONTH(app.purchased_on) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(app.purchased_on) =',$year);
			}
			$this->db->order_by('app.id','desc');
			$query = $this->db->get();
			$result = $query->result_array();
			// echo $this->db->last_query(); die;
			return $result;
		}	
		 function tmss($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){
			$this->db->select(' tb.id, tb.tax,tb.txn_id, t.title item_name,t.user_id owner, tb.transaction_details, tb.quantity quantity,tb.amount amount, tb.status,tb.added_on added_on, u.role role,u.id user_id,u.name username,u.location,cty.countries_name,t.title course_title,tb.amount price');
			$this->db->from('tbl_training_book tb');
			$this->db->join('tbl_user u','tb.user_id=u.id');
			$this->db->join('tbl_training t','tb.training_seminar_id=t.id');
			$this->db->join('countries cty','u.location=cty.countries_id');
			//$this->db->where('tb.payment_status',1);
			$this->db->where('tb.status',1);
			if($country_id != ""){
				$this->db->where('u.location',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}

			if($day != ""){				
				$this->db->where('DAY(tb.added_on) =',$day); 
			}

			if($month != ""){				
				$this->db->where('MONTH(tb.added_on) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(tb.added_on) =',$year);
			}
			$this->db->order_by('tb.id','desc');
			$query = $this->db->get();
			$data = $query->result_array();
			//echo $this->db->last_query(); die;
			return $data;
		}
		function courses($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){	

			$this->db->select('pl.id pid, pl.quantity quantity ,pl.txn_id, pl.tax, pl.amount amount,pl.status,pl.id receipt_id,pl.added_on added_on,u.role role,u.id user_id,u.name username,u.country,cty.countries_name,c.id,c.user_id owner,c.course_title item_name,c.course_title course_title,pl.amount price');
			$this->db->from('tbl_purchase_llis pl');
			$this->db->join('tbl_course c','pl.item_name=c.id');
			$this->db->join('tbl_user u','pl.user_id=u.id');
			$this->db->join('countries cty','u.country=cty.countries_id');
			$this->db->where('pl.status',1);
			
			if($country_id != ""){
				$this->db->where('u.country',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}
			if($day != ""){				
				$this->db->where('DAY(pl.added_on) =',$day); 
			}
			if($month != ""){				
				$this->db->where('MONTH(pl.added_on) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(pl.added_on) =',$year);
			}
			$this->db->order_by('pl.id','desc');
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			$data = $query->result_array();
			return $data;
		}
		function promotionscp($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){		
			$this->db->select('cp.id, cp.user_id owner, cp.tax, cp.txn_id, c.course_title item_name, cp.transaction_details, cp.amount amount,cp.status,cp.added_on added_on,u.role role,u.id user_id,u.name username,u.country,cty.countries_name,c.course_title course_title,cp.amount price');
			$this->db->from('tbl_course_promotion cp');
			$this->db->join('tbl_course c','cp.course_id = c.id','left');
			$this->db->join('tbl_user u','cp.user_id=u.id','left');
			$this->db->join('countries cty','u.country=cty.countries_id','left');
			$this->db->where('cp.status',1);
			if($country_id != ""){
				$this->db->where('u.country',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}
			if($day != ""){				
				$this->db->where('DAY(cp.added_on) =',$day); 
			}
			if($month != ""){				
				$this->db->where('MONTH(cp.added_on) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(cp.added_on) =',$year);
			}
			$this->db->order_by('cp.id','desc');
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			$data = $query->result_array();
			return $data;
		}
		function promotionUser($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){		
			$this->db->select('ppt.id, ppt.tax, ppt.user_id owner, ppt.transaction_details, ppt.promoted_amount amount,ppt.promoted_date added_on,u.role role,u.id user_id,u.name username,u.country,cty.countries_name,ppt.promoted_amount price');
			$this->db->from('tbl_promoted_provider_transaction ppt');
			$this->db->join('tbl_user u','ppt.user_id=u.id','left');
			$this->db->join('countries cty','u.country=cty.countries_id','left');
			// $this->db->where('ppt.status',1);
			if($country_id != ""){
				$this->db->where('u.country',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}
			if($day != ""){				
				$this->db->where('DAY(ppt.promoted_date) =',$day); 
			}
			if($month != ""){				
				$this->db->where('MONTH(ppt.promoted_date) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(ppt.promoted_date) =',$year);
			}
			$this->db->order_by('ppt.id','desc');
			$query = $this->db->get();
			$data = $query->result_array();
			// echo $this->db->last_query(); die;
			// echo'<pre>';print_r($data);die;
			return $data;
		}
		function promotionstp($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){		
			$this->db->select('t.title item_name, tp.id, tp.tax, tp.user_id owner, tp.txn_id, tp.transaction_details,tp.amount amount,tp.status,tp.added_on added_on,u.role role,u.id user_id,u.name username,u.country,cty.countries_name,t.title course_title,tp.amount price');
			$this->db->from('tbl_training_promotion tp');
			$this->db->join('tbl_user u','tp.user_id=u.id');
			$this->db->join('tbl_training t','tp.training_id = t.id');
			$this->db->join('countries cty','u.country=cty.countries_id');
			$this->db->where('tp.status',1);
			if($country_id != ""){
				$this->db->where('u.country',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}
			if($day != ""){				
				$this->db->where('DAY(tp.added_on) =',$day); 
			}
			if($month != ""){				
				$this->db->where('MONTH(tp.added_on) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(tp.added_on) =',$year);
			}
			$this->db->order_by('tp.id','desc');
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			$data = $query->result_array();
			return $data;
		}

		public function tmstraining_publish($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false)
		{  //tpub.quantity quantity,cty.countries_name,
			$this->db->select('tpub.id, tpub.tax, tpub.amount price, tpub.amount amount, tpub.status,tpub.added_on added_on, tpub.transaction_details,t.id tid,t.user_id owner_id, t.title item_name ,t.title course_title, u.role role,u.id user_id,u.name username,cty.countries_name, u.country');
	        $this->db->from('tbl_training_published tpub' ); 
			$this->db->join('tbl_training t', 'tpub.training_id = t.id','left');
			$this->db->join('tbl_user u','u.id = tpub.user_id');
			$this->db->join('countries cty','u.country=cty.countries_id');
			if($country_id != ""){
				$this->db->where('u.country',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}

			if($day != ""){				
				$this->db->where('DAY(tpub.added_on) =',$day); 
			}

			if($month != ""){				
				$this->db->where('MONTH(tpub.added_on) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(tpub.added_on) =',$year);
			}
			$this->db->order_by('tpub.id','desc');
			$query = $this->db->get();
			// $result = array();
			// if($query !== FALSE && $query->num_rows() > 0){
			//     foreach ($query->result_array() as $row) {
			//         $result[] = $row;
			//     }
			// }
			$data = $query->result_array();
			// echo $this->db->last_query(); die;
			return $data;
		}
			
		
		// function certificate($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){	
		// 	$this->db->select('tcl.title item_name,tc.id, tc.txn_id, tc.tax, tc.amount,tc.status,tc.added_on,tc.num_of_participants,u.role role,u.id user_id,u.name username,u.country,cty.countries_name,tcl.title course_title,tc.amount price');
		// 	$this->db->from('tbl_training_certificate tc');
		// 	$this->db->join('tbl_training tcl','tc.training_id = tcl.id','left');
		// 	// $this->db->join('tbl_training_certificate_lists tcl','tc.certificate_id=tcl.id','left');
		// 	$this->db->join('tbl_user u','tc.user_id=u.id','left'); 
		// 	$this->db->join('countries cty','u.country=cty.countries_id','left');
		// 	$this->db->where('tc.status',1); 
			
		// 	if($country_id != ""){
		// 		$this->db->where('u.country',$country_id); 
		// 	}
		// 	if($role != ""){
		// 		$this->db->where('u.role',$role); 
		// 	}
		// 	if($users != ""){
		// 		$this->db->where('u.id',$users); 
		// 	}
		// 	if($day != ""){				
		// 		$this->db->where('DAY(tc.added_on) =',$day); 
		// 	}
		// 	if($month != ""){				
		// 		$this->db->where('MONTH(tc.added_on) =',$month); 
		// 	}
		// 	if($year != ""){
		// 		$this->db->where('YEAR(tc.added_on) =',$year);
		// 	}
		// 	$this->db->order_by('tc.id','desc');
		// 	$query = $this->db->get();
		// 	$data = $query->result_array();
		// 	// echo $this->db->last_query(); die;
		// 	return $data;
		// }

		function certificate($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){	
			$this->db->select('pt.*, pt.id iid, pt.tax, pt.paid_amount price,pt.added_on added_on,pt.product_type item_name,pt.product_type course_title, u.role role,u.id user_id,u.name username,u.location,cty.countries_name');
			$this->db->from('tbl_payment_transaction pt'); 
			$this->db->join('tbl_user u','pt.user_id = u.id'); 
			$this->db->join('countries cty','u.country = cty.countries_id','left');
			$this->db->where('pt.product_type','Digital Certificate Subscription');
			$this->db->where('pt.txn_id !=','');
			if($country_id != ""){
				$this->db->where('u.location',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}
			if($day != ""){				
				$this->db->where('DAY(pt.added_on) =',$day); 
			}
			if($month != ""){				
				$this->db->where('MONTH(pt.added_on) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(pt.added_on) =',$year);
			}
			$this->db->order_by('pt.id','desc');
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			$data = $query->result_array();
			// echo'<pre>';print_r($data);die;
			return $data;
		}

		function pcems($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){	
			$this->db->select('pppph.pppph_id iid, pppph.tax, pppph.payment_transtion_id txn_id, pppph.pce_plan_name item_name,pppph.payment_amount price,pppph.payment_status status,pppph.payment_at added_on,u.role role,u.id user_id,u.name username,u.country,cty.countries_name');
			$this->db->from('professional_pce_plan_payment_history pppph');
			$this->db->join('tbl_user u','pppph.user_id=u.id','left'); 
			$this->db->join('countries cty','u.country=cty.countries_id','left');
			//$this->db->where('tc.status',1); 			
			if($country_id != ""){
				$this->db->where('u.country',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}
			if($day != ""){				
				$this->db->where('DAY(pppph.payment_at) =',$day); 
			}
			if($month != ""){				
				$this->db->where('MONTH(pppph.payment_at) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(pppph.payment_at) =',$year);
			}
			$this->db->order_by('pppph.pppph_id','desc');
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			$data = $query->result_array();
			
			return $data;
		}

		function staff($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){	
			$this->db->select('isp.*, isp.id iid, isp.tax, isp.amount price,isp.added_on added_on, u.role role,u.id user_id,u.name username,u.location,cty.countries_name');
			$this->db->from('tbl_institution_staff_payment isp');
			// $this->db->join('tbl_institution_staff is','isp.provider_id = is.insititution_id','left'); 
			$this->db->join('tbl_user u','isp.provider_id = u.id','left'); 
			$this->db->join('countries cty','u.country = cty.countries_id','left');
			// $this->db->where('is.status',1);
			// $this->db->where('is.activated',1);
			if($country_id != ""){
				$this->db->where('u.location',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}
			if($day != ""){				
				$this->db->where('DAY(isp.added_on) =',$day); 
			}
			if($month != ""){				
				$this->db->where('MONTH(isp.added_on) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(isp.added_on) =',$year);
			}
			$this->db->order_by('isp.id','desc');
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			$data = $query->result_array();
			// echo'<pre>';print_r($data);die;
			return $data;
		}

		function rboard($country_id=false,$role=false,$users=false,$month=false,$year=false,$day=false){	
			$this->db->select('pt.*, pt.id iid, pt.tax, pt.paid_amount price,pt.added_on added_on,pt.product_type item_name,pt.product_type course_title, u.role role,u.id user_id,u.name username,u.location,cty.countries_name');
			$this->db->from('tbl_payment_transaction pt'); 
			$this->db->join('tbl_user u','pt.user_id = u.id'); 
			$this->db->join('countries cty','u.country = cty.countries_id','left');
			$this->db->where('pt.product_type','RBoard Subscription');
			$this->db->where('pt.txn_id !=','');
			if($country_id != ""){
				$this->db->where('u.location',$country_id); 
			}
			if($role != ""){
				$this->db->where('u.role',$role); 
			}
			if($users != ""){
				$this->db->where('u.id',$users); 
			}
			if($day != ""){				
				$this->db->where('DAY(pt.added_on) =',$day); 
			}
			if($month != ""){				
				$this->db->where('MONTH(pt.added_on) =',$month); 
			}
			if($year != ""){
				$this->db->where('YEAR(pt.added_on) =',$year);
			}
			$this->db->order_by('pt.id','desc');
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			$data = $query->result_array();
			// echo'<pre>';print_r($data);die;
			return $data;
		}


		public function get_trail_days(){

			$this->db->select('tctd.*,c.countries_name');
			$this->db->from('tbl_countrywise_trail_days tctd');
			$this->db->join('countries c','c.countries_id = tctd.country_id');
			$this->db->order_by('tctd.ctry_id','DESC');
			$result = $this->db->get();
			$data = $result->result_array();
			return $data; 
		}

		public function get_trail_days_edit($id){

			$this->db->select('tctd.*,c.countries_name');
			$this->db->from('tbl_countrywise_trail_days tctd');
			$this->db->join('countries c','c.countries_id = tctd.country_id');
			$this->db->where('tctd.ctry_id',$id); 
			$this->db->order_by('tctd.ctry_id','DESC');
			$result = $this->db->get();
			$data = $result->row_array();
			return $data; 
		}

		public function get_tutorial($type=false){
			if(!empty($type))
			{
				$this->db->where('type',$type);
			}
			$this->db->order_by('added_on','DESC');
			$result = $this->db->get('tbl_tutorial')->result_array();
			return $result; 
		}

		public function get_terms($type=false){
			if(!empty($type))
			{
				$this->db->where('type',$type);
			}
			$this->db->order_by('type','ASC');
			$result = $this->db->get('tbl_terms_conditions')->row_array();
			return $result; 
		}
		function receipt_advs($id){	
			$this->db->select('app.id,app.tax,app.txn_id,app.no_of_view,app.transaction_details,app.purchased_on added_on, ap.package_name item_name,app.amount amount,u.role role,u.id user_id,u.name username,u.country,cty.countries_name,ap.package_name course_title,app.amount price');
			$this->db->from('tbl_adv_package_purchased app');
			$this->db->join('tbl_user u','app.user_id=u.id');
			$this->db->join('tbl_adv_package ap','app.package_id=ap.id');
			$this->db->join('countries cty','u.country=cty.countries_id');
			$this->db->where('app.id',$id);
			$query = $this->db->get();
			$result = $query->row_array();
			//echo $this->db->last_query(); die;
			return $result;
		}	
		 function receipt_tmss($id){
			$this->db->select('tb.id, t.title item_name, tb.transaction_details, tb.quantity quantity,tb.amount amount, tb.status,tb.added_on added_on, u.role role,u.id user_id,u.name username,u.location,cty.countries_name,t.title course_title,tb.amount price');
			$this->db->from('tbl_training_book tb');
			$this->db->join('tbl_user u','tb.user_id=u.id');
			$this->db->join('tbl_training t','tb.training_seminar_id=t.id');
			$this->db->join('countries cty','u.location=cty.countries_id');
			//$this->db->where('tb.payment_status',1);
			$this->db->where('tb.id',$id);
			$query = $this->db->get();
			$data = $query->row_array();
			//echo $this->db->last_query(); die;
			return $data;
		}

		
		function receipt_courses($id){	

			$this->db->select('pl.id pid, pl.quantity quantity ,pl.txn_id,pl.tax,pl.amount amount,pl.status,pl.id receipt_id,pl.added_on added_on,u.role role,u.id user_id,u.name username,u.location,cty.countries_name,c.id,c.course_title item_name,c.course_title course_title,pl.amount price');
			$this->db->from('tbl_purchase_llis pl');
			$this->db->join('tbl_user u','pl.user_id=u.id');
			$this->db->join('tbl_course c','pl.item_name=c.id');
			$this->db->join('countries cty','u.location=cty.countries_id');
			$this->db->where('pl.id',$id);
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			$data = $query->row_array();
			return $data;
		}
		function receipt_promotionscp($id){		
			$this->db->select('cp.id, c.course_title item_name, cp.transaction_details, cp.amount amount,cp.status,cp.added_on added_on,u.role role,u.id user_id,u.name username,u.location,cty.countries_name,c.course_title course_title,cp.amount price');
			$this->db->from('tbl_course_promotion cp');
			$this->db->join('tbl_user u','cp.user_id=u.id');
			$this->db->join('tbl_course c','cp.course_id = c.id');
			$this->db->join('countries cty','u.location=cty.countries_id');
			$this->db->where('cp.id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			$data = $query->row_array();
			return $data;
		}
		function receipt_promotionstp($id){		
			$this->db->select('t.title item_name,tp.id,tp.transaction_details,tp.amount amount,tp.status,tp.added_on added_on,u.role role,u.id user_id,u.name username,u.location,cty.countries_name,t.title course_title,tp.amount price');
			$this->db->from('tbl_training_promotion tp');
			$this->db->join('tbl_user u','tp.user_id=u.id');
			$this->db->join('tbl_training t','tp.training_id = t.id');
			$this->db->join('countries cty','u.location=cty.countries_id');
			$this->db->where('tp.id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			$data = $query->row_array();
			return $data;
		}
		
		function receipt_certificate($id){	
			$this->db->select('tcl.title item_name,tc.id,tc.tax, tc.txn_id txn_id, tc.amount amount,tc.status,tc.added_on added_on,u.role role,u.id user_id,u.name username,u.location,cty.countries_name,tcl.title course_title,tc.amount price');
			$this->db->from('tbl_training_certificate tc');
			$this->db->join('tbl_user u','tc.user_id=u.id'); 
			$this->db->join('tbl_training_certificate_lists tcl','tc.certificate_id=tcl.id');
			$this->db->join('countries cty','u.location=cty.countries_id');
			$this->db->where('tc.id',$id); 
			$query = $this->db->get();
			$data = $query->row_array();
			//echo $this->db->last_query(); die;
			return $data;
		}

		function receipt_pcems($id){	
			$this->db->select('pppph.pppph_id, pppph.tax, pppph.payment_transtion_id txn_id, pppph.pce_plan_name item_name,pppph.payment_amount price,pppph.payment_status status,pppph.payment_at added_on,u.role role,u.id user_id,u.name username,u.location,cty.countries_name');
			$this->db->from('professional_pce_plan_payment_history pppph');
			$this->db->join('tbl_user u','pppph.user_id=u.id'); 
			$this->db->join('countries cty','u.location=cty.countries_id');
			$this->db->where('pppph.pppph_id',$id); 		
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			$data = $query->row_array();
			
			return $data;
		}

		function receipt_staff($id){	
			$this->db->select('isp.*,isp.id, isp.amount price,isp.added_on added_on, is.*, u.role role,u.id user_id,u.name username,u.location,cty.countries_name');
			$this->db->from('tbl_institution_staff_payment isp');
			$this->db->join('tbl_institution_staff is','isp.provider_id = is.insititution_id'); 
			$this->db->join('tbl_user u','isp.provider_id = u.id'); 
			$this->db->join('countries cty','u.country = cty.countries_id');
			$this->db->where('isp.id',$id); 
			$query = $this->db->get();
			// echo $this->db->last_query(); die;
			$data = $query->row_array();
			// echo'<pre>';print_r($data);die;
			return $data;
		}

		function get_login_backend(){	
			$this->db->select('tlb.* , tc.cat_name profession_name');
			$this->db->from('tbl_login_backend tlb');
			$this->db->join('tbl_category tc','tlb.profession_id = tc.id','LEFT'); 
			$this->db->where('tlb.status','1'); 
			$query = $this->db->get();
			$data = $query->result_array();
			return $data;
		}

		function get_all_login_backend(){	
			$this->db->select('tlb.* , tc.cat_name profession_name');
			$this->db->from('tbl_login_backend tlb');
			$this->db->join('tbl_category tc','tlb.profession_id = tc.id','LEFT'); 
			$query = $this->db->get();
			$data = $query->result_array();
			return $data;
		}

		function get_all_professionals($filter){	
			$this->db->select('u.*,ppp.*,c.countries_name');
			$this->db->from('tbl_user u'); 
			$this->db->join('professional_pce_plan ppp','u.id=ppp.user_id','left');
			$this->db->join('countries c','u.country=c.countries_id','left');
			$this->db->where('u.role', 1);
			if($filter['profession'] !=""){
				$this->db->where('u.profession', $filter['profession']);
			}
			if($filter['filter'] !="" && $filter['filter'] != 4){
				$this->db->where('ppp.version_type', $filter['filter']);
			}elseif($filter['filter'] == 4){
				$this->db->where('ppp.version_type', '2');
				$this->db->where('ppp.payment_status', 'n');
				$this->db->where('ppp.plan_expiry_at >', date('Y-m-d'));
			}else{

			}
			$this->db->order_by('id','DESC');
			$query = $this->db->get();
			// echo $this->db->last_query();die;
			$data = $query->result_array();  
			return $data;

		}
		function get_regulatoryboard(){
			$this->db->select('u.*');
			$this->db->from('tbl_user u');
			$this->db->where('role', 7);
			$this->db->where('status',1);
			$q = $this->db->get();
			//echo $this->db->last_query();exit;
			$result = $q->result();
			return $result;
		}
		
	function get_dcpscriptions(){
		$this->db->from('digital_insurance_package');
		$this->db->order_by("disp_position", "ASC");
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	function get_one_dcpscription($id = false){
		$this->db->from('digital_insurance_package');
		if($id){
			$this->db->where('dcp_id', $id);
		}		
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}

	function dcpsubscription_update($data, $id = false){		
		$this->db->where('dcp_id', $id);
		$this->db->update('digital_insurance_package', $data);
		//echo $this->db->last_query(); die;
		return true;
	}

	function dcpsubscription_insert($data){
		$this->db->set($data);
		$this->db->insert('digital_insurance_package');	
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;	
	}

	function get_faq_list(){
		$role = isset($_GET['role'])?$_GET['role']:'';
		$question = isset($_GET['question'])?$_GET['question']:'';

		$this->db->from('tbl_faq');	
		$this->db->where('status','1');
		if($role != ''){
			$this->db->where('role',$role);
		}
		if($question != ''){
			$this->db->like('question',$question);
		}

		$this->db->order_by("id", "DESC");
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function get_all_training_income($type){
		$country_id = ($_GET['country_id']!='')?$_GET['country_id']:'';
		$cep_name = ($_GET['cep_name']!='')?$_GET['cep_name']:'';
		$training_name = ($_GET['training_name']!='')?$_GET['training_name']:'';
		$date = ($_GET['date']!='')?$_GET['date']:'';
		$month = ($_GET['month']!='')?$_GET['month']:'';
		$year = ($_GET['year']!='')?$_GET['year']:'';

		$this->db->select(' tb.id, tb.tax,tb.txn_id, t.title item_name,t.user_id owner, tb.transaction_details, tb.quantity quantity,tb.amount amount, tb.status,tb.added_on added_on, u.role role,u.id user_id,u.name username,u.location,cty.countries_name,t.title course_title,tb.amount price');
		$this->db->from('tbl_training_book tb');
		$this->db->join('tbl_user u','tb.user_id=u.id');
		$this->db->join('tbl_training t','tb.training_seminar_id=t.id');
		$this->db->join('countries cty','u.location=cty.countries_id');
		$this->db->where('tb.status',1);

		if($type != "" && $type == 'cep'){
			$this->db->where('t.insititution_id','0');
		}
		if($type != "" && $type == 'ins'){
			$this->db->where('t.insititution_id !=','');
		}

		if($country_id != ""){
			$this->db->where('u.location',$country_id); 
		}

		if($cep_name != ""){
			$this->db->like('u.name',$cep_name); 
		}

		if($training_name != ""){
			$this->db->like('t.title',$training_name); 
		}

		if($date != ""){				
			$this->db->where('DAY(tb.added_on) =',$date); 
		}

		if($month != ""){				
			$this->db->where('MONTH(tb.added_on) =',$month); 
		}
		if($year != ""){
			$this->db->where('YEAR(tb.added_on) =',$year);
		}
		$this->db->order_by('tb.id','desc');
		$query = $this->db->get();
		$data = $query->result_array();
		//echo $this->db->last_query(); die;
		return $data;
	}

}