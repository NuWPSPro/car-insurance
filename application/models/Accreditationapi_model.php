<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accreditationapi_model extends CI_Model {
     
    public function  __construct()
	{
		parent::__construct();
		$this->userTbl 		= 'tbl_user';
		$this->accreditationTbl = 'tbl_accreditation';
		$this->countriesTbl = 'countries';
		$this->courseTbl 	= 'tbl_course';
		$this->trainingTbl 	= 'tbl_training';
	}

    public function isUserExists($email){
        $this->db->select('name, id, username_email email, profession, country, role');
        $this->db->where('username_email',$email);
        $this->db->from($this->userTbl);
        $query = $this->db->get();
		$data  = $query->row_array(); 
        return (isset($data)) ? $data : FALSE; 
    }

    function saveCepAccreditation($data){
		$this->db->set($data);
		$this->db->insert($this->accreditationTbl);	
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;	
	}
    
    function saveCarCompanyAccreditation($data){
		$this->db->set($data);
		$this->db->insert($this->accreditationTbl);	
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;	
	}
    
    function updateCepAccreditation($where,$data)
	{
        $this->db->where($where);
	    $this->db->update($this->accreditationTbl,$data);  
		$id = $this->db->affected_rows();
        return (isset($id)) ? $id : FALSE;	
	}

    public function isCourseExists($uid,$course_name){
        $this->db->select('*'); 
        $this->db->from($this->courseTbl);
        $this->db->where('user_id',$uid);
        $this->db->like('course_title',$course_name);
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row_array();
        return (isset($result)) ? $result : FALSE; 
    }

    public function isTrainingExists($uid,$training_name){
        $this->db->select('*'); 
        $this->db->from($this->trainingTbl);
        $this->db->where('user_id',$uid);
        $this->db->like('title',$training_name);
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row_array();
        return (isset($result)) ? $result : FALSE; 
    }

}

