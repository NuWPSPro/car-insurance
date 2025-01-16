<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Car_insurance_model extends CI_Model {
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
			$this->carInsuranceTbl = '	car_insurance';
			$this->carpurchaseTbl = 'tbl_buy_insurance';
		}

		

		public function get_all_car_insuracne(){
			$query = $this->db->get($this->carInsuranceTbl);
			$result = $query->result();
			return $result;
		}

		public function get_all_buy_insurance()
		{		
			$this->db->select('*');
			$this->db->from('tbl_buy_insurance'); 
			$query = $this->db->get();
			$data = $query->result_array(); 
		  
			return $data;
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
		
}