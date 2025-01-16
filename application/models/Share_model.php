<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Share_model extends CI_Model {
	
	public function  __construct()
	{
		parent::__construct();
		$this->userTbl 		= 'tbl_user';
		$this->courseTbl 	= 'tbl_course';
		$this->trainingTbl 	= 'tbl_training';
		$this->trainingBookTbl 	= 'tbl_training_book';
		$this->countriesTbl = 'countries';
		$this->pcemsPlanTbl = 'tbl_professional_plan';
		$this->blogTbl 		= 'tbl_blog';
		$this->providerSetTargetTbl  = 'tbl_provider_set_target';
		$this->paymentTransactionTbl = 'tbl_payment_transaction';
		$this->allTaxTbl 	= 'tbl_all_tax';
		$this->userCertificate 		= 'tbl_user_certificate';
		$this->certificateTemplate 	= 'tbl_certificate_template';
		$this->trainingCertificate 	= 'tbl_training_certificate_lists';
	}

	public function get_result_array($tbl,$where,$uid){ 
 		$this->db->where($where,$uid);
 		$query = $this->db->get($tbl)->result_array();
		return $query;
	}

	public function get_row_array($tbl,$where,$uid){ 
 		$this->db->where($where,$uid);
		$query = $this->db->get($tbl)->row_array(); 
		return $query;
	}
	
	public function get_row_array_where($tbl,$where){ 
 		$this->db->where($where);
		$query = $this->db->get($tbl)->row_array(); 
		return $query;
	}

	public function getAdvertiseAddsList($advertiser_id = false,$advertiser_role = false)
    {
	    $this->db->select('app.*,
                           ap.package_name as title,
                           ap.duration,
						   ap.package_image');
        $this->db->from('tbl_adv_package_purchased app'); 
		$this->db->join('tbl_adv_package ap', 'app.package_id = ap.id','LEFT');
		$this->db->join('tbl_user u','u.id = app.user_id','LEFT');
		$this->db->join('countries cty','u.country=cty.countries_id','LEFT');
       
		if(!empty($advertiser_id)){
	    $this->db->where('app.user_id',$advertiser_id);
		}
		if(!empty($advertiser_role)){
		    $this->db->where('app.user_role',$advertiser_role);
		}
		$this->db->where('app.payment_status',1);
       
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        $data = $query->result_array(); 

        return $data;
    }

    public function get_active_promoted_provider($uid=false,$urole=false)
	{
		$this->db->select('tbl_user.name,ppt.*');
		$this->db->from('tbl_promoted_provider_transaction ppt');
		$this->db->join('tbl_user', 'tbl_user.id = ppt.user_id');  
		if($uid){
			$this->db->where('ppt.user_id ', $uid);
		} 
		if($urole){
			$this->db->where('ppt.role ', $urole); 
		} 
		$this->db->order_by('id','DESC'); 
		$query = $this->db->get();
		$data = $query->result_array(); 
		//echo $this->db->last_query(); die;
		return $data;
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
	public function get_active_training_promotion($uid = false,$idd=false)
	{
		$this->db->select('tp.*, t.title');
        $this->db->from('tbl_training_promotion tp' ); 
		$this->db->join('tbl_training t', 't.id = tp.training_id');
	   	$this->db->where('tp.id',$idd);
		if(!empty($uid)){
		$this->db->where('tp.user_id',$uid);
		}
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_training_publish($uid = false)
	{
		$this->db->select('tpub.*, t.title');
        $this->db->from('tbl_training_published tpub' ); 
		$this->db->join('tbl_training t', 't.id = tpub.training_id');
		if(!empty($uid)){
		$this->db->where('tpub.user_id',$uid);
		}
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function receipt_courses($id){	

		$this->db->select('pl.id pid, pl.quantity quantity ,pl.txn_id,pl.tax,pl.amount amount,pl.status,pl.id receipt_id,pl.added_on added_on,u.role role,u.id user_id,u.name username,u.country,cty.countries_name,c.id,c.course_title item_name,c.course_title course_title,pl.amount price');
		$this->db->from('tbl_purchase_llis pl');
		$this->db->join('tbl_user u','pl.user_id=u.id');
		$this->db->join('tbl_course c','pl.item_name=c.id');
		$this->db->join('countries cty','u.country=cty.countries_id');
		$this->db->where('pl.id',$id);
		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		$data = $query->row_array();
		return $data;
	}

	public function receipt_tmss($id){
		$this->db->select('tb.id,tb.tax,tb.txn_id, t.title item_name, tb.transaction_details, tb.quantity quantity,tb.amount amount, tb.status,tb.added_on added_on, u.role role,u.id user_id,u.name username,u.country,cty.countries_name,t.title course_title,tb.amount price');
		$this->db->from('tbl_training_book tb');
		$this->db->join('tbl_training t','tb.training_seminar_id=t.id');
		$this->db->join('tbl_user u','tb.user_id=u.id');
		$this->db->join('countries cty','u.country=cty.countries_id');
		//$this->db->where('tb.payment_status',1);
		$this->db->where('tb.id',$id);
		$query = $this->db->get();
		$data = $query->row_array();
		//echo $this->db->last_query(); die;
		return $data;
	}
	public function receipt_tmstraining_publish($id)
	{  //tpub.quantity quantity,cty.countries_name,
		$this->db->select('tpub.id,t.id tid, t.title item_name ,t.title course_title, tpub.transaction_details, tpub.amount amount, tpub.amount price, tpub.status,tpub.added_on added_on, u.role role,u.id user_id,u.name username,cty.countries_name, u.country');
        $this->db->from('tbl_training_published tpub' ); 
		$this->db->join('tbl_training t', 't.id = tpub.training_id','Right');
		$this->db->join('tbl_user u','u.id = tpub.user_id');
		$this->db->join('countries cty','u.country=cty.countries_id');
		$this->db->where('tpub.id',$id);
		$query = $this->db->get();
		$result = $query->row_array();
		// echo $this->db->last_query(); die;
		return $result;
	}

	public function receipt_certificate($id){	
		$this->db->select('tcl.title item_name,tc.id, tc.txn_id, tc.tax, tc.amount,tc.status,tc.added_on, tc.num_of_participants, u.role role,u.id user_id,u.name username,u.country,cty.countries_name,tcl.title course_title,tc.amount price');
		$this->db->from('tbl_training_certificate tc');
		$this->db->join('tbl_training tcl','tc.training_id=tcl.id');
		$this->db->join('tbl_user u','tc.user_id=u.id'); 
		// $this->db->join('tbl_training_certificate_lists tcl','tc.certificate_id=tcl.id');
		$this->db->join('countries cty','u.country=cty.countries_id');
		$this->db->where('tc.id',$id); 
		$query = $this->db->get();
		$data = $query->row_array();
		// echo $this->db->last_query(); die;
		return $data;
	}
	public function receipt_pcems($id){	
		$this->db->select('pppph.pppph_id, pppph.tax tax,pppph.base_price, pppph.payment_transtion_id txn_id, pppph.pce_plan_name item_name,pppph.payment_amount price,pppph.payment_status status,pppph.payment_at added_on,u.role role,u.id user_id,u.name username,u.country,cty.countries_name');
		$this->db->from('professional_pce_plan_payment_history pppph');
		$this->db->join('tbl_user u','pppph.user_id=u.id','left'); 
		$this->db->join('countries cty','u.country=cty.countries_id','left');
		$this->db->where('pppph.pppph_id',$id); 		
		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		$data = $query->row_array();
		
		return $data;
	}

	public function receipt_staff($id){	
		$this->db->select('isp.*,isp.id,isp.tax, isp.amount price,isp.added_on added_on, is.*, u.role role,u.id user_id,u.name username,u.country,cty.countries_name');
		$this->db->from('tbl_institution_staff_payment isp');
		$this->db->join('tbl_institution_staff is','isp.provider_id = is.insititution_id'); 
		$this->db->join('tbl_user u','isp.provider_id = u.id','left'); 
		$this->db->join('countries cty','u.country = cty.countries_id','left');
		$this->db->where('isp.id',$id); 
		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		$data = $query->row_array();
		// echo'<pre>';print_r($data);die;
		return $data;
	}

	public function receipt_rboard($id){	
		$this->db->select('pt.*, pt.tax tax, pt.paid_amount, pt.txn_id, pt.product_type item_name,pt.paid_amount price,pt.payment_status status,pt.added_on,u.role role,u.id user_id,u.name username,u.country,cty.countries_name');
		$this->db->from($this->paymentTransactionTbl.' pt');
		$this->db->join($this->userTbl.' u','pt.user_id=u.id','left'); 
		$this->db->join('countries cty','u.country=cty.countries_id','left');
		$this->db->where('pt.id',$id); 		
		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		$data = $query->row_array();
		
		return $data;
	}
	
	public function delete($tbl,$id){
		$this->db->where('id', $id);
		$data = $this->db->delete($tbl);
		return $data;
	}		
		
	public function get_blogs_by_same_cep($user_id,$id = false){
			
		if($id){
			$this->db->where('id !=', $id);
		}
		$this->db->where('user_id', $user_id);
		$this->db->where('status', 1);
		$data = $this->db->get('tbl_blog')->result_array();
		return $data;
	}	
		
	public function get_online_course($filter = false){
		$this->db->select('tco.*, tca.cat_name, tcp.added_on as Featured_from, tcp.no_of_day');
        $this->db->from('tbl_course tco'); 
		$this->db->join('tbl_category tca', 'tco.course_category = tca.id','left');
		$this->db->join('tbl_course_promotion tcp', 'tco.id = tcp.course_id','left');
        if(!empty($filter)){
          $this->db->where($filter);
    	} 
		$this->db->where('tco.course_validity >=',date('Y-m-d'));  
		$this->db->where('tco.insititution_id','0');  
		$this->db->where('tco.status',1);  
        $this->db->order_by('tco.paid_status','DESC');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        $data = $query->result_array();
		return $data;
	}		
		
	public function get_training($filter = false){
        $this->db->select('ttr.*, tca.cat_name, tcp.added_on as Featured_from, tcp.no_of_day');
        $this->db->from('tbl_training ttr'); 
		$this->db->join('tbl_category tca', 'ttr.category_id = tca.id','left');
		$this->db->join('tbl_training_promotion tcp', 'ttr.id = tcp.training_id','left');
        if(!empty($filter)){
          $this->db->where($filter);
    	} 
		$this->db->where('ttr.end_date >=',date('Y-m-d'));  
		$this->db->where('ttr.insititution_id','0');  
		$this->db->where('ttr.status',2);  
        $this->db->order_by('ttr.paid_status','DESC');
        $query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	public 	function get_professionals($filter = false){
		// $this->db->select('tp.*,'.str_to_date('ppt.promoted_date', "%d-%b-%Y").' date');
		$this->db->select('tp.*,tu.featured_from, tu.featured_to, ppt.promoted_date date');
        $this->db->from('tbl_professionals tp'); 
        $this->db->join('tbl_user tu','tp.user_id = tu.id','left'); 
        $this->db->join('tbl_promoted_provider_transaction ppt','tp.user_id = ppt.user_id','left'); 
		$this->db->where('tp.status','1');
		$this->db->where('tp.pro_status','1');
		$this->db->where('tp.user_type','1');
        if(!empty($filter)){
          $this->db->where($filter);
    	}
    	$this->db->order_by('tp.added_at','DESC');
    	// $this->db->order_by("str_to_date('date', '%d-%b-%Y')", "DESC");
    	$this->db->order_by('date','DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
      	// echo $this->db->last_query();
      	// echo count($data);
        return $data;
	}

	public 	function get_institutions($filter = false){
		$this->db->select('*');
        $this->db->from('tbl_user'); 
		$this->db->where('role',5);
		$this->db->where('status','1');
		$this->db->where('under_insititution',0);
		$this->db->where('parent_insititution',0);
        if(!empty($filter)){
          $this->db->where($filter);
    	}
    	$this->db->order_by('added_on','DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
      	// echo $this->db->last_query();
      	// echo count($data);
        return $data;
	}
	
	public function getuser_info($user_id,$role){
		$result = array();

		$this->db->where('id',$user_id);
		$this->db->where('role',$role);
		// $this->db->where('status','1');
        $query = $this->db->get($this->userTbl);
        $data = $query->row(); 

		if($query->num_rows() > 0){
        	$result['details'] = $data; 
			
			if($role==5){
				if($data->under_insititution==1){
					$info = $this->db->get_where($this->userTbl,array('id'=>$data->parent_insititution))->row();
					$result['parent_info'] = array('pid'=>$info->id, 'pname'=>$info->name, 'pemail'=>$info->username_email, 'pinsititution_id'=>$info->insititution_id); 					
					$insidArr = array($data->id);
				}
				if($data->under_insititution==0){
					$infoArr = $this->db->get_where($this->userTbl,array('parent_insititution'=>$data->id,'role'=>5))->result();
					$childArr = array();
					if($infoArr){
						foreach($infoArr as $value ){
							$childArr[] = array(
								'cid' =>	$value->id,
								'cname' =>	$value->name,
								'cemail' =>	$value->username_email,
								'cinsititution_id' =>	$value->insititution_id,
							);
						}
						$result['child_info'] = $childArr; 
						$insidArr = array_column($childArr,'cid');
					}
					$cepinfoArr = $this->db->get_where($this->userTbl,array('parent_insititution'=>$data->id,'role'=>2))->result();
					$cepchildArr = array();
					if($cepinfoArr){
						foreach($cepinfoArr as $value ){
							$cepchildArr[] = array(
								'cepid' =>	$value->id,
								'cepname' =>	$value->name,
								'cepemail' =>	$value->username_email,
								'cepinsititution_id' =>	$value->insititution_id,
							);
						}
						$result['cep_info'] = $cepchildArr;  // cep under main ins
						// $insidArr = array_column($cepchildArr,'cepid');
					}
					
					$authorArr = $this->get_author_under_institution($data->id);
					$autArr = array();
					if($authorArr){
						foreach($authorArr as $value ){
							$autArr[] = array(
								'auid' =>	$value['id'],
								'auname' =>	$value['name'],
								'auemail' =>	$value['username_email'],
								'auinsititution_id' =>	$value['insititution_id'],
							);
						}
						$result['author_info'] = $autArr; 
					}
						
					
				}
					if($insidArr){
						$ceproviderArr = $this->get_provider_under_institution($insidArr);
						if($ceproviderArr){
							$cepArr = array();
							foreach($ceproviderArr as $value ){
								$cepArr[] = array(
									'cepid' =>	$value['id'],
									'cepname' =>	$value['name'],
									'cepemail' =>	$value['username_email'],
									'cepinsititution_id' =>	$value['insititution_id'],
								);
							}
							$result['cep_info'] = $cepArr; 
						}
					}
					
					if($insidArr){
						$authorArr = $this->get_author_under_institution($insidArr);
						$autArr = array();
						if($authorArr){
							foreach($authorArr as $value ){
								$autArr[] = array(
									'auid' =>	$value['id'],
									'auname' =>	$value['name'],
									'auemail' =>	$value['username_email'],
									'auinsititution_id' =>	$value['insititution_id'],
								);
							}
							$result['author_info'] = $autArr; 
						}
					}
					
					if($cepArr){
						$cepidArr = array_column($cepArr,'cepid');
						$staffceArr = $this->get_staff_under_institution($cepidArr);
						$staffArr = array();
						if($staffceArr){
							// foreach($staffceArr as $value ){
							// 	$staffArr[] = array(
							// 		'auid' =>	$value['id'],
							// 		'auname' =>	$value['name'],
							// 		'auemail' =>	$value['username_email'],
							// 		'auinsititution_id' =>	$value['insititution_id'],
							// 	);
							// }
							$result['Staff_info'] = $staffceArr; 
						}
					}


			}

			if($role==2){
				if(isset($data->under_provider) && $data->under_provider != null ){
					$info = $this->db->get_where($this->userTbl,array('insititution_id'=>$data->under_provider))->row();
					$result['parent_info'] = array('pid'=>$info->id, 'pname'=>$info->name, 'pemail'=>$info->username_email, 'pinsititution_id'=>$info->insititution_id); 
				}
			}

			if($role==6){
				if(isset($data->under_provider) && $data->under_provider != null ){
					$info = $this->db->get_where($this->userTbl,array('insititution_id'=>$data->under_provider))->row();
					$result['parent_info'] = array('pid'=>$info->id, 'pname'=>$info->name, 'pemail'=>$info->username_email, 'pinsititution_id'=>$info->insititution_id); 
				}
			}
			
			return $result;
		
		}else{
		return false;
		}
	}

	public function getinstitution_tracker_data($insArr){
		$sum = array();
		$this->db->where_in('insititution_id',$insArr);
		$this->db->where('status',1);
		$query1 = $this->db->get($this->courseTbl);
        if($query1->num_rows()){ $data1 = $query1->num_rows(); } else{ $data1 = 0; }  
		
		$this->db->where_in('insititution_id',$insArr);
		$this->db->where('status',2);
		$query2 = $this->db->get($this->trainingTbl);
        if($query2->num_rows()){ $data2 = $query2->num_rows(); } else{ $data2 = 0; }  

		$sum['course'] = $data1; 
		$sum['training'] = $data2;
		return $sum;
	}

	public function provider_set_target_staff_to_be_trained($insidArr){
		$this->db->where_in('institution_id',$insidArr);
		$this->db->where('status',1);
		$query1 = $this->db->get($this->providerSetTargetTbl);
        if($query1->num_rows()){ 
			$data = $query1->result(); 
		} else{ 
			$data = false; 
		}  
		return $data;
	}

	public function get_course_under_institution($insArr){
		$this->db->where_in('insititution_id',$insArr);
		$this->db->where('status',1);
		$query = $this->db->get($this->courseTbl);
        if($query->num_rows() > 0){ 
			$data = $query->result_array(); 
		} else{ 
			$data = 0; 
		}  
		return $data;
	}
	
	public function get_training_under_institution($insArr){
		$this->db->where_in('insititution_id',$insArr);
		$this->db->where('status',2);
		$query = $this->db->get($this->trainingTbl);
		if($query->num_rows() > 0){ 
			$data = $query->result_array(); 
		} else{ 
			$data = 0; 
		}  
		return $data;
	}
	
	public function get_subinstitution_under_institution($insidArr){
		$this->db->where_in('parent_insititution',$insidArr);
		$this->db->where('role',5);
		$this->db->where('under_insititution',1);
		// $this->db->where('status',1);
		$query = $this->db->get($this->userTbl);
		if($query->num_rows() > 0){ 
			$data = $query->result_array(); 
		} else{ 
			$data = 0; 
		}  
		return $data;
	}
	
	public function get_provider_under_institution($insidArr){
		if(isset($_GET['subins'])&&$_GET['subins']!=''){
			$this->db->where('parent_insititution',$_GET['subins']);
		}
		$this->db->where_in('parent_insititution',$insidArr);
		$this->db->where('role',2);
		$this->db->where('under_insititution',1);
		// $this->db->where('status',1);
		$query = $this->db->get($this->userTbl);
		if($query->num_rows() > 0){ 
			$data = $query->result_array(); 
		} else{ 
			$data = 0; 
		}  
		return $data;
	}
	
	public function get_author_under_institution($insidArr){
		$this->db->where_in('parent_insititution',$insidArr);
		$this->db->where('role',6);
		$this->db->where('under_insititution',1);
		// $this->db->where('status',1);
		$query = $this->db->get($this->userTbl);
		if($query->num_rows() > 0){ 
			$data = $query->result_array(); 
		} else{ 
			$data = 0; 
		}  
		return $data;
	}

	function get_staff_under_institution($cepArr)
		{	
			$title 		 	= (isset($_GET['title']))?$_GET['title']:''; 
			$ceprovider 	= (isset($_GET['ceprovider']))?$_GET['ceprovider']:''; 
			$institution 	= (isset($_GET['institution']))?$_GET['institution']:''; 
			$this->db->select('is.*,u.profession,u.id as pid');
			$this->db->from('tbl_institution_staff is');
			$this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
			$this->db->where_in('is.insititution_id',$cepArr);
			
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

	function get_blog_under_institution($blogwhere)
		{	
			$this->db->where_in('user_id',$blogwhere);
			$this->db->where('status',1);
			$query = $this->db->get($this->blogTbl);
			return $query->result_array();
		}
	
	public function get_pcemsplan_details($planid){ 
		$this->db->where('propla_id',$planid);
	    $query = $this->db->get($this->pcemsPlanTbl);
	    $result = $query->row(); 
	    return $result;
   }
	
	public function get_rboard(){ 
		$rb_title = isset($_GET['rb_title'])?$_GET['rb_title']:'';
		$country = isset($_GET['country'])?$_GET['country']:'';
		$this->db->select('u.*, c.countries_name country_name');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->countriesTbl.' c','u.country = c.countries_id');

		if($rb_title != ''){
			$this->db->like('u.name',$rb_title);
		}
		if($country != ''){
			$this->db->where('u.country',$country);
		}
		$this->db->where('u.role',7);
		$this->db->where('u.status',1);
		$this->db->order_by('u.id','desc');
	    $query = $this->db->get();
	    $result = $query->result(); 
	    return $result;
   }

    public function get_all_tax($id){ 
		$this->db->from($this->allTaxTbl);
		$this->db->where('id',$id);
		$query = $this->db->get()->row_array();
		return $query;
	}
	
	public function getCourseDetails($cid){ 
		$this->db->where('id',$cid);
	    $query = $this->db->get($this->courseTbl)->row_array(); 
	    return $query;
    }
	
	public function getTrainingDetails($tid){ 
		$this->db->where('id',$tid);
	    $query = $this->db->get($this->trainingTbl)->row_array(); 
	    return $query;
    }
	public function getTrainingBookDetails($id){ 
		$this->db->where('id',$id);
	    $query = $this->db->get($this->trainingBookTbl)->row_array(); 
	    return $query;
    }
	
	public function getCourseCertificate($cid){ 
		$this->db->select('uc.*, ct.id, ct.template_no, ct.bg_image, ct.text_image');
		$this->db->from($this->userCertificate.' uc');
		$this->db->join($this->certificateTemplate.' ct','uc.templete_id = ct.id','LEFT');
		$this->db->where('uc.course_id',$cid);
		$query = $this->db->get()->row_array(); 
	    return $query;
    }
	
	
	public function getTrainingCertificate($tid){  
		$this->db->select('tr.user_id as cep_id,tr.location,tr.units,tr.start_date,tr.end_date,tr.title as training_title,tr.sub_title as training_sub_title,ct.id,ct.bg_image,ct.template_no,ct.text_image,tcl.*');
		$this->db->from($this->trainingCertificate.' tcl');
		$this->db->join($this->certificateTemplate.' ct', 'tcl.templete_id = ct.id');  
		$this->db->join($this->trainingTbl.' tr', 'tr.id = tcl.training_id');  
		$this->db->where('tcl.training_id ', $tid); 
		$query = $this->db->get()->row_array(); 
	    return $query;
    }
	
	
	public function getUserDetails($uid){ 
		$this->db->select('u.*, c.countries_name as location');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->countriesTbl.' c','c.countries_id = u.country','LEFT');
		$this->db->where('u.id',$uid);
		$query = $this->db->get($this->userTbl)->row_array(); 
		return $query;
	}

} 

?>