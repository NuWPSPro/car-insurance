<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professional extends CI_Controller {


public function  __construct()
  {
        parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->model('Users_model','users_model');

		
		 header('Access-Control-Allow-Origin: *');
		// header('Content-type: application/json;');
		// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

		
  } 
	
/* -----------------------api-------------------------------- */

			public function dashboard()
			{
				
				
			 header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id'];	
			/* if($this->session->userdata('logged_in')['id'] == ''){
			redirect('api/users/login');
			} */
			
			
		

			//$data['purchase_list'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_exam',array('user_id'=>$sess_id));

		//	$data['course_list'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_purchase_llis',array('user_id'=>$user_id ));

			/* $data['previous_certificate'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$user_id,'archive'=>0));

			$data['specific'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'specific','archive'=>0));

			$data['general'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'general','archive'=>0));
 */
 

$this->db->select('tbl_purchase_llis.id ,tbl_purchase_llis.quantity as units , tbl_course.course_title');
$this->db->from('tbl_purchase_llis');
$this->db->join('tbl_course', 'tbl_purchase_llis.item_name = tbl_course.id', 'left');
$this->db->where('tbl_purchase_llis.user_id',$user_id );
$data['course_list']= $this->db->get()->result_array(); 

 
			//$data['all_ce_record'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$user_id,'archive'=>1));

			$data['specific_ce_record'] = $this->db->select('id ,course_name , units')->get_where('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'specific','archive'=>1))->result_array();
			$data['general_ce_record'] = $this->db->select('id ,course_name , units')->get_where('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'general','archive'=>1))->result_array();
			$data['card'] = $this->db->select('id ,card_name , card_no')->get_where('tbl_card',array('user_id'=>$user_id,'status'=>1))->result_array();

			echo json_encode($data);

		
	}
	
	public function savecard()
	{

       
			 header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			
			
          if(isset($_FILES["photos"]) && !empty($_FILES["photos"]['name']))
			{
            $config['upload_path'] = './assets/images/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docs';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["photos"]["name"]);        
            $imageName = 'CARD_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('photos'))
            {
            $error = array('error' => $this->upload->display_errors());         
                       
            }  
            $data['photo'] = $imageName;
            }

	        $data['user_id']         = $jsonvalue['user_id'] ; 
	        $data['card_no']         = $jsonvalue['card_no'] ; 
	        $data['card_name']       = $jsonvalue['card_name']; 
	        $data['date_issued']     = $jsonvalue['date_issued']; 
	        $data['expiry_date']     = $jsonvalue['expiry_date'];  
	        $data['status']          = 1; 
	        $data['added_on']        = date('Y-m-d h:i:s');  


       		$res = $this->users_model->save('tbl_card',$data); 

			if($res)
			{
				$result['success']='true';
				$result['error']="0";
				$result['msg']='Data Save Successfully'; 
			}
			else
			{
				$result['success']='false';
				$result['error']="1";
				$result['msg']='Unable to Save Data Information';

			}
			echo json_encode($result);
		
       
	}
	
	public function purchage_details()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$id     = $jsonvalue['id']; 
			
			 $this->db->select('*');
			$this->db->from('tbl_purchase_llis');
			$this->db->join('tbl_course', 'tbl_purchase_llis.item_name = tbl_course.id', 'left');
			$this->db->where('tbl_purchase_llis.id',$id  );
			$course_list= $this->db->get()->row_array();  
			
			//$course_list = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_purchase_llis',array('id'=>$id ));
 

			if(count($course_list)>0)
			{
				$result['data']=$course_list;
				$result['success']='true';
				$result['error']="0";
				$result['msg']='Data Found'; 
			}
			else
			{
				$result['success']='false';
				$result['error']="1";
				$result['msg']='Data Not Found';

			}
			echo json_encode($result);
			
	}
	
	public function card_details()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$id     = $jsonvalue['id']; 
			
			$course_list = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_card',array('id'=>$id ));
 

			if(count($course_list)>0)
			{
				$result['data']=$course_list[0];
				$result['success']='true';
				$result['error']="0";
				$result['msg']='Data Found'; 
			}
			else
			{
				$result['success']='false';
				$result['error']="1";
				$result['msg']='Data Not Found';

			}
			echo json_encode($result);
			
	}
	
	public function certificate_details()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$id     = $jsonvalue['id']; 
			
			$course_list = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('id'=>$id ));
 
			$course_lists="https://www.ceonpoint.com/assets/images/uploads/".$course_list[0]['certificate'];

			if(count($course_list)>0)
			{
				$result['certificat']=$course_lists;
				$result['success']='true';
				$result['error']="0";
				$result['msg']='Data Found'; 
			}
			else
			{
				$result['success']='false';
				$result['error']="1";
				$result['msg']='Data Not Found';

			}
			echo json_encode($result);
			
	}
	
	public function download_card()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$id     = $jsonvalue['id']; 
			
			$course_list = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_card',array('id'=>$id ));
 

			if(count($course_list)>0)
			{
				$result['data']=$course_list[0];
				$result['success']='true';
				$result['error']="0";
				$result['msg']='Data Found'; 
			}
			else
			{
				$result['success']='false';
				$result['error']="1";
				$result['msg']='Data Not Found';

			}
			echo json_encode($result);
			
	}
	
	public function delete_card()
	{
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		$id     = $jsonvalue['id']; 
		$res=$this->users_model->delete('tbl_card', 'id',$id);
		if($res)
		{
			
			$result['success']='true';
			$result['error']="0";
			$result['msg']='Data Deleted'; 
		}
		else
		{
			$result['success']='false';
			$result['error']="1";
			$result['msg']='Data Not Deleted';

		}
			echo json_encode($result);
	}		
	
	
	public function course_list()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id']; 
			$user=$this->db->get_where('tbl_user',array("id"=>$user_id));
			$course_lists = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course',array('profession'=>$user['profession'] ));
			//$course_list  = $this->db->select('id ,course_name , units')->order_by('id', 'DESC')->get_where('tbl_course',array('profession'=>$user['profession'] ))->result_array();
$courses=array();
foreach($course_lists as $course_list)
{
	$data['id']=$course_list['id'];
	$data['course_title']=$course_list[];
	$data['course_photo']="https://ceonpoint.com/assets/images/uploads/".$course_list['course_photo'];
	$data['price']=$course_list[];
	$data['by']=$this->db->get_where('tbl_user',array('id'=>$user_id))->row_array()['name'];
	$data['rating']=$course_list['rating'];
	$data['total_revew']=$this->db->get_where('tbl_user',array('course_id'=>$course_list['id']))->num_rows();
$courses[]=$data;
}

			if(count($course_list)>0)
			{
				$result['data']=$courses;
				$result['success']='true';
				$result['error']="0";
				$result['msg']='Data Found'; 
			}
			else
			{
				$result['success']='false';
				$result['error']="1";
				$result['msg']='Data Not Found';

			}
			echo json_encode($result);
			
	} 
	
/* -----------------------apt---------------- */
	public function users()
	{ 
		echo "working";
	}



	public function terms()
	{
		$data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$this->load->frontAdmin('professional/terms',$data);
	}	


	public function notification()
	{
		$data['notification'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_notification','status',1);
		 
		$this->load->frontAdmin('professional/notification',$data);
	}

 


	public function profile()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
		$this->form_validation->set_rules('profession', 'Profession', 'trim|required'); 
		$this->form_validation->set_rules('location', 'Location', 'trim|required');  
		$this->form_validation->set_rules('address', 'Address', 'trim|required');  
		$this->form_validation->set_rules('licence', 'Licence', 'trim|required');  

		/*if (empty($_FILES['image']['name'])){
		$this->form_validation->set_rules('image', 'Image', 'trim|required'); 
		}*/

		if($this->form_validation->run() == FALSE)
		{

			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		    $this->load->frontAdmin('professional/profile',$data); 
		
		}  else {




			$under_institution = $this->input->post('under_institution');
			//if($under_institution==1){
			 $institution      = $this->input->post('institution');
			 $institution_code = $this->input->post('institution_code');

				$where =array('id'=>$institution,'insititution_id'=>$institution_code);
				$insititution = $this->user->get_record_by_multi_field_name('tbl_user',$where); 
				
			 

				if(empty($insititution)){ 
					$this->session->set_flashdata('response', '<div class="alert alert-danger">Invalid institution code.</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');

				} else { 
					$data['parent_insititution'] = $institution;
					$data['under_insititution']  = 1;
				}
			//}


		 

			if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName = 'IMG_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			}  
			$data['image'] = $imageName;
			}


			$data['name'] 		= $this->input->post('name'); 
			$data['role'] 	= $this->input->post('profession'); 
			$data['profession'] 	= $this->input->post('category'); 
			//$data['price'] 		= $this->input->post('price'); 
			$data['country'] 	= $this->input->post('location');  
			$data['address'] 	= $this->input->post('address');  
			$data['licence'] 	= $this->input->post('licence');  
			 
		    $result = $this->user->update('tbl_user',$data,'id',$uid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
				redirect('professional/profile');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/profile');
			} 
		}
	}

		

	
	public function enquiry()
	{
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('type', 'Type', 'trim|required'); 
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required'); 
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required'); 
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'); 
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{

			$this->load->frontAdmin('professional/enquiry');
		
		}  else { 


			$data['etype'] 			= $this->input->post('type'); 
			$data['first_name'] 	= $this->input->post('first_name');  
			$data['last_name'] 		= $this->input->post('last_name');  
			$data['email'] 			= $this->input->post('email');  
			$data['subject'] 		= $this->input->post('subject');  
			$data['message'] 		= $this->input->post('message');  
			
		    $result = $this->user->save('tbl_enquiry',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Thank you for your messgae.</div>');
				redirect('professional/enquiry');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/enquiry');
			} 
		}
	}


   public function tutorials()
	{
		$data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$this->load->frontAdmin('professional/tutorials',$data);
	}
	public function detail($uid)
	{
		$data['uid'] = $uid;
		$this->load->frontAdmin('professional/detail',$data);
	}



	public function training_list($cat)
	{   
		$data['free']     = $this->user->get_seminar_category('tbl_training','paid_status',1,$cat); 
		$data['featured'] = $this->user->get_seminar_category('tbl_training','paid_status',2,$cat); 
		$data['toplist']  = $this->user->get_seminar_category('tbl_training','paid_status',3,$cat); 
		$data['premium']  = $this->user->get_seminar_category('tbl_training','paid_status',4,$cat); 

			    $data['category'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);


		$this->load->frontAdmin('professional/training_list',$data);
	}


  public function course_list($c_id=false)
	{
	    if($c_id==""){
	    	$data1 = $this->session->userdata('logged_in');
	    	$profession = $data1['profession'];
	    	$courseId   = $this->db->get_where('tbl_category',array('cat_name'=>$profession))->row_array();
	    	$cid = $courseId['id'];
	    } else {
	    	$cid = $c_id;
	    }

	   

	    if($c_id==""){

	 
	     $data['featured'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','paid_status',2);
	     $data['topist'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','paid_status',3);
	     $data['premium'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','paid_status',4);

	    } else {
	    $data['course_list_data'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','course_category',$cid);
	   }





        $cat = $cid;

	    $data['featured'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc_page('tbl_course','paid_status',2,$cat);
		$data['toplist'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc_page('tbl_course','paid_status',3,$cat);
		$data['premium'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc_page('tbl_course','paid_status',4,$cat);
		$data['freecourse'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc_course('tbl_course','paid_status',1,$cat);

	    $data['category'] = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);




	    $data['category'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
	    /*echo '<pre>';
	    print_r($data['course']);
	    die;*/
		$this->load->frontAdmin('professional/course_list',$data);
	}






  public function training_list1($c_id=false)
	{
	    if($c_id==""){
	    	$data1 = $this->session->userdata('logged_in');
	    	$profession = $data1['profession'];
	    	$courseId   = $this->db->get_where('tbl_category',array('cat_name'=>$profession))->row_array();
	    	$cid = $courseId['id'];
	    } else {
	    	$cid = $c_id;
	    }

	   

	    if($c_id==""){

	 
	     $data['featured'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','paid_status',2);
	     $data['topist'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','paid_status',3);
	     $data['premium'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','paid_status',4);

	    } else {
	    $data['course_list_data'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','course_category',$cid);
	   }

	    $data['category'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
	    /*echo '<pre>';
	    print_r($data['course']);
	    die;*/
		$this->load->frontAdmin('professional/training_list',$data);
	}

	


	public function purchase_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$data['purchase_list'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_purchase_llis','user_id',$uid);
		$this->load->frontAdmin('professional/purchase_list',$data);
	}
	public function advertise()
	{
		
		if($this->session->userdata('logged_in')['id'] == ''){
			redirect('users');
		}else{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['advertisepackages'] = $this->user->advertisepackages(array('adv_status'=>'1'));
			$data['buyadpack'] = $this->user->buyadpack(array('user_id'=>$uid));
			$data['memberadvertiselisting'] = $this->user->memberadvertiselisting(array('user_id'=>$uid));
			$this->load->frontAdmin('professional/advertise',$data);
		}
	}
	public function subscription()
	{
		
		if($this->session->userdata('logged_in')['id'] == ''){
			redirect('users');
		}else{
			$uid = $this->session->userdata('logged_in')['id'];
			$data['advertisepackages'] = $this->user->subscriptionslisting(array('subs_status'=>'1'));
			$this->load->frontAdmin('professional/subscription',$data);
		}
	}
	public function subscriptionpayment()
	{
		
		if($this->session->userdata('logged_in')['id'] == ''){
			redirect('users');
		}else{
			//print_r($_REQUEST);
			//print_r($_SESSION);
			//exit;
			$data['user_id']            = $this->session->userdata('logged_in')['id'];
			$data['subs_id']          = $_REQUEST['item_number'];
			//$data['quantity']           = $_REQUEST['quantity'];
			$data['paypal_trangaction_id']             = $_REQUEST['txn_id'];
			$data['paypal_trangaction_status']         = $_REQUEST['payment_status'];
			$data['sub_status']             = '1';
			$data['added_at']           = date('y-m-d h:i:s');
			$data['subscription_amount']             = $_REQUEST['payment_gross'];
			if($_REQUEST['payment_status'] == 'Pending'){
				$this->session->set_flashdata('subscriptionmsg', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Your payment pending.</div>');
					redirect('professional/subscription');	
			}else{
				$result = $this->user->save('tbl_user_subscription_buy',$data);
				if($result){
					$this->session->set_flashdata('subscriptionmsg', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Your payment successfully.</div>');
					redirect('professional/subscription');	
				}
			}	
		}
	}
	
	public function uplodadadvertise()
	{
		if($this->session->userdata('logged_in')['id'] == ''){
			redirect('users');
		}else{
			$uid = $this->session->userdata('logged_in')['id'];
			if($_POST){
				$adv_image = '';
				if(isset($_FILES["adv_image"]) && !empty($_FILES["adv_image"]['name'])){
				$config['upload_path'] = './assets/images/advertise/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '200000';
				$config['max_width']  = '2500';
				$config['max_height']  = '1800';         
				$ext = explode('.',$_FILES["adv_image"]["name"]);        
				$adv_image = 'IMG_'.time().'.'.end($ext);
				$config['file_name'] = $adv_image;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('adv_image'))
				{
					
				$error = array('error' => $this->upload->display_errors()); 
				//print_r($error); exit;
				$this->session->set_flashdata('imgupladerr', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
				redirect('professional/advertise');	
				}  
				$adv_image = $adv_image;
				}else{
					$adv_image = $this->input->post('adv_image_old');
				}
				$advddata = array(
					'user_id' 					=> $this->session->userdata('logged_in')['id'],
					'adv_title' 				=> $this->input->post('adv_title'),
					//'adv_pck_id' 				=> $this->input->post('adv_pck_id'),
					//'adv_url' 					=> $this->input->post('adv_url'),
					'adv_image'  				=> $adv_image,
					'adv_end_to'    			=> '',
					//'adv_display_postion'    	=> $this->input->post(''),
					'adv_status'     			=> '1',
					'added_at'     				=> date('Y-m-d H:i:s'),
				);
				if($this->input->post('advlist_id') > 0){
					$this->users_model->update('advertise_listing',$advddata,'advlist_id',$this->input->post('advlist_id'));
					$advlistid = $this->input->post('advlist_id');
				}else{
					$advlistid = $this->users_model->save('advertise_listing',$advddata);
				}
				$this->session->set_flashdata('dispmsg', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Successfully uploaded.</div>');
				redirect('professional/advertise');
				
			}
			$data['advlist_id'] = $this->uri->segment(3);
			if($this->uri->segment(3) >0){
			$data['editadv'] = $this->user->memberadvertiselisting(array('advlist_id'=>$this->uri->segment(3),'user_id'=>$uid));
			}else{
				$data['editadv'][0] = array('advlist_id'=>'','adv_image'=>'','adv_title'=>'');
			}
			$this->load->frontAdmin('professional/uplodadadvertise',$data);
		}
	}


public function delete_online_certificate($idd){
		$this->users_model->delete('tbl_purchase_llis', 'id',$idd);	
		  $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record Deleted successfully.</div>');
                redirect('professional/dashboard');
}

public function ecertificate_delete($idd){
		$this->users_model->delete('tbl_existing_certificate', 'id',$idd);	
		  $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record Deleted successfully.</div>');
                redirect('professional/dashboard');
}



public function ecertificate_delete_training($idd){
		$this->users_model->delete('tbl_training', 'id',$idd);	
		  $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record Deleted successfully.</div>');
                redirect('professional/dashboard');
}



public function ecertificate_delete_card($idd){
		$this->users_model->delete('tbl_card', 'id',$idd);	
		  $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record Deleted successfully.</div>');
                redirect('professional/dashboard');
}






  public function changecategory(){

  	$form_type   =  $this->input->post('form_type'); 
  	$form_id     =  $this->input->post('form_id'); 
  	$categoryid  =  $this->input->post('categoryid'); 
 

  	if($form_type==1){
		$data['category'] 	= $categoryid;  
		$result = $this->user->update('tbl_existing_certificate',$data,'id',$form_id); 
  	}


  	if($form_type==2){
  		
  		if($categoryid==""){
  			$categoryid = 0;
  			 
  		}

  		else if($categoryid=="general"){
  			$categoryid = 1;
  			 
  		}

  		else if($categoryid=="specific"){
  			$categoryid = 2;
  			 
  		}
 

		$data['category_id'] 	= $categoryid;  
		$result = $this->user->update('tbl_training_book',$data,'id',$form_id); 
  	}



  	 $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record has been updated successfully.</div>');
                redirect('professional/dashboard');


  	echo '<pre>';
  	print_r($_REQUEST);
  	die;
  }





  /* public function savecard()
	{

        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
        $this->form_validation->set_rules('card_no', 'Card No', 'required'); 
        $this->form_validation->set_rules('card_name', 'Card Name', 'required'); 
        $this->form_validation->set_rules('issued_date', 'Issued Date', 'required');  
        $this->form_validation->set_rules('expiry_date', 'Expiry Date', 'required');  

        if (empty($_FILES['photos']['name'])){
         $this->form_validation->set_rules('photos', 'Photo', 'trim|required');
        }

        if($this->form_validation->run() == FALSE)
        {  
        
        $data['purchase_list'] = $this->user->get_record_by_field_name_all_record('tbl_purchase_llis','user_id',$this->session->userdata('logged_in')['id']);

		$data['previous_certificate'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate','user_id',$this->session->userdata('logged_in')['id']);
		
		$this->load->frontAdmin('professional/dashboard',$data);


        } else { 
 

            if(isset($_FILES["photos"]) && !empty($_FILES["photos"]['name'])){
            $config['upload_path'] = './assets/images/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docs';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["photos"]["name"]);        
            $imageName = 'CARD_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('photos'))
            {
            $error = array('error' => $this->upload->display_errors());         
            echo '<pre>';
            print_r($error);
            die;              
            }  
            $data['photo'] = $imageName;
            }

	        $data['user_id']         = $this->session->userdata('logged_in')['id']; 
	        $data['card_no']         = $this->input->post('card_no'); 
	        $data['card_name']       = $this->input->post('card_name'); 
	        $data['date_issued']     = $this->input->post('issued_date'); 
	        $data['expiry_date']     = $this->input->post('expiry_date');  
	        $data['status']          = 1; 
	        $data['added_on']        = date('Y-m-d h:i:s');  


       		$result = $this->users_model->save('tbl_card',$data); 


            if($result){

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">1 Card added successfully to your lists.</div>');

                  redirect('professional/dashboard');


            } else {

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');

                 redirect('professional/dashboard');

            }
            
        }
	}
 */



  public function existing()
	{


        $this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
        $this->form_validation->set_rules('course_name', 'Course Name', 'required'); 
        $this->form_validation->set_rules('course_unit', 'Course Units', 'required'); 
        $this->form_validation->set_rules('course_start_date', 'Course Starts Date', 'required');  

        if (empty($_FILES['certificate']['name'])){
         $this->form_validation->set_rules('certificate', 'Certificate', 'trim|required');
        }

        if($this->form_validation->run() == FALSE)
        {  
            $data['purchase_list'] = $this->user->get_record_by_field_name_all_record('tbl_purchase_llis','user_id',$this->session->userdata('logged_in')['id']);

		$data['previous_certificate'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate','user_id',$this->session->userdata('logged_in')['id']);
		
		$this->load->frontAdmin('professional/dashboard',$data);


        } else { 


            if(isset($_FILES["certificate"]) && !empty($_FILES["certificate"]['name'])){
            $config['upload_path'] = './assets/images/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docs';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["certificate"]["name"]);        
            $imageName = 'CERTIFICATE_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('certificate'))
            {
            $error = array('error' => $this->upload->display_errors());         
            echo '<pre>';
            print_r($error);
            die;              
            }  
            $data['certificate'] = $imageName;
            }

	        $data['certificate_id']    = $this->input->post('certi_no'); 
	        $data['course_name']       = $this->input->post('course_name'); 
	        $data['units']             = $this->input->post('course_unit'); 
	        $data['start_date']        = $this->input->post('course_start_date'); 
	        $data['end_date']          = $this->input->post('course_end_date'); 
	        $data['category']          = $this->input->post('category'); 
	        $data['status']            = 1; 
	        $data['added_on']          = date('Y-m-d h:i:s'); 
	        $data['user_id']           = $this->session->userdata('logged_in')['id'];

       		$result = $this->users_model->save('tbl_existing_certificate',$data); 


            if($result){

                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">1 Certificate added successfully to your lists.</div>');

                if($_REQUEST['certi_popup']==1){


                	$exploded_data = explode('?', $_SERVER['HTTP_REFERER']);
 

                	if(empty($exploded_data[1])){
					 $url= $_SERVER['HTTP_REFERER'].'?p=3';
                	} else {
					 $url= $_SERVER['HTTP_REFERER'].'&p=3';
                	}
			
					redirect($url);

                } else {
                   redirect('professional/dashboard');
                }


            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');

                if($_REQUEST['certi_popup']==1){
					$url= $_SERVER['HTTP_REFERER'];
					redirect($url);
                } else {
                   redirect('professional/dashboard');
                }

            }
            
        }
	}





public function showBill(){
	   $data['idd'] =  $this->input->post('idd');

	   $data['purschase_detais'] = $this->user->get_record_by_field_name_all_record('tbl_purchase_llis','id',$data['idd']);

	   $data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$data['purschase_detais'][0]['user_id']);
	 
	   $this->load->view('professional/receipt',$data);
}



public function showMessage(){
	   $idd =  $this->input->post('idd');
	   $data['notification'] = $this->user->get_record_by_field_name_all_record('tbl_notification','id',$idd);
	  

	   $this->load->view('professional/notificationdata',$data);
}



public function updateunit(){
	 
	$promotedata['user_id']     = $this->session->userdata('logged_in')['id'];
	$promotedata['unit']        = $_REQUEST['units'];
	$promotedata['purpose']     = $_REQUEST['purpose'];
	$promotedata['added_on']    = date('Y-m-d');
	$promotedata['status']      = 1;
	
	$proinserted = $this->users_model->save('tbl_units',$promotedata);   


	$datas['archive'] = 1;
	$this->users_model->update('tbl_existing_certificate',$datas,'status',1);


	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">1 Certificate added successfully to your lists.</div>');

	redirect('professional/dashboard?id=success');

}





	public function staffcerecords()
	{
		$this->load->frontAdmin('professional/staffcerecords'); 
	}




	public function registerstaff()
	{ 


			$uid = $this->session->userdata('logged_in')['id']; 
			$profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			 
	 
			$data['staff_name']          = $this->input->post('name'); 
			$data['insititution_id']     = $profile[0]['id'];  
			$data['insititution_code']   = $profile[0]['insititution_id'];  
			$data['status']       = 1;
			$data['added_on']     = date('Y-m-d'); 


			$result = $this->user->save('tbl_institution_staff',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Overview created successfully.</div>');
				redirect('professional/staffcerecords');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/staffcerecords');
			}
}





	public function updatestaff()
	{ 


			$uid = $this->session->userdata('logged_in')['id']; 
			$profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
			 
	 
			$datas['staff_name']          = $this->input->post('name');   
			
			$result = $this->users_model->update('tbl_institution_staff',$datas,'id',$this->input->post('staff_id11'));
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Record updated successfully.</div>');
				redirect('provider/staffcerecords');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('provider/staffcerecords');
			}
}


public function exam_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$this->db->order_by('id','desc');
		$this->db->where('id',$uid);
		$data['exam_list'] = $this->db->get('tbl_exam')->result_array();
		$this->load->frontAdmin('professional/exam_list',$data);
	}

public function add_list()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		
		 $data['advertise'] = $this->advertiseads->getAdvertiseAddsList($uid);
             	
		$this->load->frontAdmin('professional/advertise',$data);
		
	}
	
	public function advertisement()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		  $data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',1);    	
		$this->load->frontAdmin('professional/add_advertise',$data);
	}	


	public function sendtoinstitution($idd)
	{
		 

		    $data['send_to_institution'] 	= 1;  
			 
		    $result = $this->user->update('tbl_existing_certificate',$data,'id',$idd); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate has been sent to Institution successfully.</div>');
				redirect('professional/dashboard');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('professional/dashboard');
			} 
	}




}
