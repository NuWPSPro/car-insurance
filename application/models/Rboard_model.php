<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Rboard_model extends CI_Model {

	public function  __construct()
	{
		parent::__construct();
		$this->userTbl 		 		 = 'tbl_user';
		$this->rboardDetailsTbl 	 = 'tbl_rboard_details';
		$this->subscrptionPackageTbl = 'tbl_rb_subscrption_package';
		$this->notificationTbl 		 = 'tbl_notification';
		$this->paymentTransactionTbl = 'tbl_payment_transaction';
		$this->countriesTbl = 'countries';
	}

	public function check_user($uid,$role){
		$this->db->where('user_id',$uid);
		$this->db->where('role',$role);
		$q = $this->db->get('tbl_user_rborad_details');
		$result = $q->num_rows();
		return $result;
	}

	public function save_rboard($post){
		$add = array(
			'accreditation_no' => $post['accreditation_no'],
			'user_id' 		=> $post['user_id'],
			'role' 			=> $post['role'],
			'date_issued' 	=> $post['date_issued'],
			'validity_date' => $post['validity_date'],
			'reg_board' 	=> $post['reg_board'],
			'status' 		=> 1,
			'added_on' 		=> date('Y-m-d')
		);
		$this->db->insert('tbl_user_rborad_details',$add);
		return $this->db->insert_id();
	}

	public function update_rboard($post){
		$update = array(
			'accreditation_no' => $post['accreditation_no'],
			'user_id' 		=> $post['user_id'],
			'role' 			=> $post['role'],
			'date_issued' 	=> $post['date_issued'],
			'validity_date' => $post['validity_date'],
			'reg_board' 	=> $post['reg_board'],
			'status' 		=> 1,
			'added_on' 		=> date('Y-m-d')
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_user_rborad_details',$update);
		return $id;
	}

	function get_course($cid,$uid){
		$this->db->where('id',$cid);
		$this->db->where('user_id',$uid);
		$q = $this->db->get('tbl_course');
		$result = $q->row();
		return $result;
	}

	function get_rboard_info($uid){
		$this->db->select('u.*,c.countries_name');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->countriesTbl.' c','u.country=c.countries_id','left');
		$this->db->where('id',$uid);
		$q = $this->db->get();
		$result = $q->row();
		return $result;
	}

	function get_rboard_notification($uid){
		$this->db->from($this->notificationTbl);
		$this->db->where('to',$uid);
		$this->db->where('status',1);
		$q = $this->db->get();
		$result = $q->result_array();
		return $result;
	}

	function subscription_package(){
		$this->db->from($this->subscrptionPackageTbl);
		$this->db->where('rbsp_status','1');
		$this->db->order_by('disp_position','ASC');
		$q = $this->db->get();
		$result = $q->result();
		return $result;
	}

	function get_one_subscription_package($id){
		$this->db->from($this->subscrptionPackageTbl);
		$this->db->where('rbsp_id',$id);
		$q = $this->db->get();
		$result = $q->row();
		return $result;
	}
	function purchase_history($uid){
		$this->db->from($this->paymentTransactionTbl);
		$this->db->where('user_id',$uid);
		$this->db->where('txn_id !=','');
		$this->db->order_by('id','desc');
		$q = $this->db->get();
		$result = $q->result();
		return $result;
	}
	function subscription_history($uid){
		$this->db->select('pt.*,sp.subcription_name,sp.no_of_applications');
		$this->db->from($this->paymentTransactionTbl. ' pt');
		$this->db->join($this->subscrptionPackageTbl.' sp', 'pt.product_id=sp.rbsp_id');
		$this->db->where('pt.user_id',$uid);
		$this->db->where('pt.txn_id !=','');
		$this->db->order_by('pt.id','desc');
		$q = $this->db->get();
		$result = $q->result();
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

	public function insert_rboard_details($data){
		$this->db->insert($this->rboardDetailsTbl,$data);
		return $this->db->insert_id();
	}
	
	public function update_rboard_details($update,$rb_id){
		$this->db->where('rb_id',$rb_id);
		$this->db->update($this->rboardDetailsTbl,$update);
		$update_id = $this->db->affected_rows();
		if($update_id > 0){
			$returnvalue = $rb_id;
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
	
	function get_rboard_subscription_details($uid){
		$this->db->from($this->rboardDetailsTbl);
		$this->db->where('user_id', $uid);
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;
	}
	
}
?>