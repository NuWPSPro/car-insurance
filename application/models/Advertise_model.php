<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertise_model extends CI_Model {

	

	function save($tbl_name,$data)
	{
		$this->db->insert($tbl_name,$data);	
		return $this->db->insert_id();
	}
	
	function update($tbl_name,$data,$where,$whereval)
	{
		$this->db->where($where,$whereval);
		$res = $this->db->update($tbl_name,$data); 
		if($res){
			return true;
		} else {
			return false;
		}

	}


 	function get_advertisement($page)
	{

		$curdate = date('Y-m-d');

		$todate1 = strtotime("+7 day", strtotime($curdate));
		$todate  = date('Y-m-d', $todate1);
		//$todate  = date(); 

  	    $this->db->select();
        $this->db->from('tbl_adv_upload');
        $this->db->join('tbl_adv_package', 'tbl_adv_package.id = tbl_adv_upload.package_id'); 
        $this->db->where('tbl_adv_package.location = ',$page);

		$this->db->where('tbl_adv_upload.end_date >=', $curdate);
		$this->db->where('tbl_adv_upload.start_date <=', $todate);
		$this->db->order_by('rand()');
        //$this->db->where('tbl_lesson.user_id ', $uid); 
        $query = $this->db->get();
       // echo $this->db->last_query();die();
        return $data = $query->result_array(); 
	}

	function getadvertisement()
	{

		$curdate = date('Y-m-d');
  	    $this->db->select('*');
        $this->db->from('advertise_listing');      
		$this->db->where('adv_status', '1');
		$this->db->order_by('advlist_id','DESC'); 
	    $query = $this->db->get();    
		
        return $data = $query->result_array(); 
	}


   function getAdvertiseAddsList($advertiser_id,$advertiser_role = false)
   {
	    $this->db->select('tbl_adv_package_purchased.*,
                           tbl_adv_package.package_name as title,
                           tbl_adv_package.duration,
						   tbl_adv_package.package_image');
        $this->db->from('tbl_adv_package_purchased'); 
		$this->db->join('tbl_adv_package', 'tbl_adv_package_purchased.package_id = tbl_adv_package.id');
       
	    $this->db->where('tbl_adv_package_purchased.user_id',$advertiser_id);
	if(!empty($advertiser_role)){
	    $this->db->where('tbl_adv_package_purchased.user_role',$advertiser_role);
	}
		$this->db->where('tbl_adv_package_purchased.payment_status',1);
       
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        $data = $query->result_array(); 

        return $data;
   }
   
   
   function getActiveAdvertisement($userid)
   {
	    $this->db->select('*');
        $this->db->from('tbl_adv_package_purchased'); 		
	    $this->db->where('user_id',$userid);
		$this->db->where('no_of_view > total_view');
       
        $query = $this->db->get();
        $data = $query->result_array(); 
      
        return $data;
	   
   }
   
   function getAdvertiserBanner($location)
   {
	  	   
	     $this->db->select('tbl_adv_package_purchased.*,tbl_adv_package.size');
        $this->db->from('tbl_adv_package_purchased'); 
		$this->db->join('tbl_adv_package', 'tbl_adv_package_purchased.package_id = tbl_adv_package.id');
      
      /* if( $this->session->userdata('current_country')){
	     $this->db->where('tbl_adv_package.country', $this->db->where('tbl_adv_package.location',$location));} */

	    $this->db->where('tbl_adv_package.location',$location);
		$this->db->where('tbl_adv_package_purchased.payment_status',1);
        $this->db->where('tbl_adv_package_purchased.status',1);
        $this->db->where('no_of_view > total_view');
        $query = $this->db->get();
        $data = $query->result_array(); 
      
        return $data;
	   
   }
   
   function updateCount($id)
   {
	   $this->db->where('id', $id);
		$this->db->set('total_view', 'total_view+1', FALSE);
		$this->db->update('tbl_adv_package_purchased');
   }

}

/* End of file Common.php */
/* Location: ./application/models/Common.php */