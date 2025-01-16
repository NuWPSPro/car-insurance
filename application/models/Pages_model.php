<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {
	
	public function save_professional($post, $image = false){ 

		$data['name'] 				= ucwords($post['name']);
		$data['role']    			= 1;
		$data['profession']     	= $post['profession'];
		$data['address']			= $post['address'];
		$data['username_email'] 	= $post['username']; 
		$data['country'] 			= $post['country_name']; 
		$data['issuing_institution']= $post['issuing_institution'];
		$data['issuing_country'] 	= $post['issuing_country']; 
		$data['state'] 				= ucwords($post['state']); 
		$data['password'] 			= md5($post['password']);
		$data['status']    	    	= 1; 
		$data['added_on']    		= date('y-m-d h:i:s'); 
		$data['under_insititution'] = 0;

		if($image){
			$data['image']  = $image;
		}
		$this->db->insert('tbl_user',$data);
		$lastid = $this->db->insert_id();
		$sess_array = array(
			'id' 		=> $lastid,
			'username' 	=> $data['username_email'],
			'name' 		=> $data['name'],  
			'role' 		=> $data['role'],  
			'profession'=> $data['profession'],  
			'location' 	=> $data['location'],  
			'address' 	=> $data['address'],
			'country' 	=> $data['country'],
			'insititution_id' 	=> $data['insititution_id'],
			'under_insititution'=> $data['under_insititution']
			);
		$this->session->set_userdata('logged_in', $sess_array);
		
		if(!empty($post['country_name']) && $post['country_name'] > 0){
			$countrydays = $this->db->get_where('tbl_countrywise_trail_days',array('country_id'=>$post['country_name']))->row_array();
			if(is_array($countrydays)){ $traildays = $countrydays['trail_days'];  }else{ $traildays = 14; }
		}else{ $traildays = 14; }
		$planarr = array('user_id'=>$lastid,'registration_date'=>date('Y-m-d'),'payment_status'=>'n','version_type'=>'2','plan_duration'=>$traildays.' days','plan_active_at'=>date('Y-m-d'),'plan_expiry_at'=>date('Y-m-d', strtotime("+$traildays days")),'payment_recieved_id'=>'','payment_recieved_at'=>'');
			$this->db->insert('professional_pce_plan',$planarr);
	
		$noti['user_info'][0]['name'] = ucwords($post['name']);
		$this->sendMail($post['username'],'Signup Successfully Done',$this->load->view('email/account_activation',$noti,true));
			$notification = array(
			'subject'        	=> 'Signup Successfully Done', 
			'to' 				=> $lastid,  
			'message' 			=> $this->load->view('email/account_activation',$noti,true),  
			'status'     		=> 1,
			'added_on'     		=> date('Y-m-d H:i:s')
			); 
			$this->db->insert('tbl_notification',$notification);
		return $lastid;
	}

	public function sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE){
		$from = EMAIL;	
		$fromName = "Ceonpoint Team";
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
		    'Reply-To: '.$from."\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		 
		if(mail($to, $subject, $message, $headers)){ 
		    return true;
		} else{ 
		    return false;
		}
	}

	function get_termandcondition($type){
		$this->db->where('type',$type);
		$this->db->from('tbl_terms_conditions');
		$q = $this->db->get();
		$result = $q->row();
		return $result;
	}
	
}

?>