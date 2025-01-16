<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institution extends CI_Controller {


public function  __construct() {
    parent::__construct();
	$this->load->library('form_validation'); 
	$this->load->model('Users_model','users_model');
	
	header('Access-Control-Allow-Origin: *');
	// header('Content-type: application/json;');
	// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
} 
	
/* -----------------------api-------------------------------- */

public function institution_list() {
	header('Content-type: application/json');
	$json_file =file_get_contents('php://input');
	$jsonvalue = json_decode($json_file,true); 

	// filter course by
	$name      = $jsonvalue['name'];
	$category  = $jsonvalue['category'];
	$country   = $jsonvalue['country'];

	$this->db->select('u.id, u.name, u.street, u.state, u.city, u.backimage, u.insititution_id, c.countries_name country');
    $this->db->from('tbl_user u'); 
    $this->db->join('countries c','c.countries_id = u.country'); 
	$this->db->where(array('u.role'=>5,'u.status'=>1,'u.under_insititution'=>0,'u.parent_insititution'=>0));

	if($name!=""){ $this->db->like('u.name',$name); }
	if($category!=""){ $this->db->where('u.profession',$category); }
	if($country!=""){ $this->db->where('u.country',$country); }

    $this->db->order_by('u.added_on','DESC');
    $result['institutions'] = $this->db->get()->result_array();
    // echo $this->db->last_query();die;
	// $backimage = ASSETS_URL.'images/uploads/'.$value['backimage'];
   
    echo json_encode($result);
}

public function institution_category() { 
	$where = array('status'=>1);
	$this->db->order_by('cat_name','ASC');
    $cat = $this->user->get_record_by_multi_field_name('tbl_category_institution',$where);  
	echo json_encode(array('success'=>'true','msg'=>'Successfully data fetched','profession'=>$cat));
}

public function institution_profile() { 
//     header('Content-type: application/json');
// 	$json_file=file_get_contents('php://input');
// 	$jsonvalue= json_decode($json_file,true); 
// 	$user_id     = $jsonvalue['user_id'];
	
// 	$where = array('status'=>1);
//     $cat = $this->user->get_record_by_multi_field_name('tbl_category_institution',$where);  
// 	echo json_encode(array('success'=>'true','msg'=>'Successfully data fetched','profession'=>$cat));
}
		

















}

?>