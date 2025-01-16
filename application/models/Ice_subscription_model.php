<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ice_subscription_model extends CI_Model {

	function get_ice_subscription_package()
	{	
		// $title 		 	= (isset($_GET['title']))?$_GET['title']:''; 
		// $ceprovider 	= (isset($_GET['ceprovider']))?$_GET['ceprovider']:''; 
		// $institution 	= (isset($_GET['institution']))?$_GET['institution']:''; 
		$this->db->select('ice.*');
		$this->db->from('ice_subscription_package ice');
		
		// if($title != ''){
		// 	$this->db->like('u.name', $title,'%');
		// }
		
		// if($ceprovider !=''){
		// 	$this->db->where('is.insititution_code',$ceprovider);
		// }
		
		// if($institution){
		// 	$this->db->where('is.insititution_id',$institution);
		// }

		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function get_ice_one_subscription_package($id)
	{	
		$this->db->select('ice.*');
		$this->db->from('ice_subscription_package ice');
		$this->db->where('ice.ice_id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	function add_subscription_package($post){
		$uid = $this->session->userdata('logged_in')['id'];
		$data['ice_pakage_name'] = $post['ice_pakage_name'];   
		$data['num_of_staff'] 	 = $post['num_of_staff'];   
		$data['amount'] 		 = $post['amount'];   
		$data['ice_package_for'] = $post['ice_package_for'];   
		$data['status'] 		 = 1;  
		$data['diplay_position'] = 1;  
		$data['created_by'] 	 = $uid;  
		$data['added_on'] 	 	 = date('Y-m-d');  

		$this->db->insert('ice_subscription_package',$data); 
		$result = $this->db->insert_id(); 
		return $result;
	}
}
?>