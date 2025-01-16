<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professional extends CI_Controller {


	public function  __construct()
  	{
        parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->model('Users_model','users_model');
		$this->load->model('professional_model','professional_model');
		$this->load->model('provider_model','provider_model');
		$this->load->model('dashboards_model');

		header('Access-Control-Allow-Origin: *');
		// header('Content-type: application/json;');
		// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
  	} 

/* -----------------------api-------------------------------- */

	public function dashboard()
	{
		header('Content-type: application/json');
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true); 
		$user_id    = $jsonvalue['user_id'];	

		$this->db->select('tbl_course.id ,tbl_purchase_llis.quantity , tbl_course.course_title, tbl_course.units');
		$this->db->from('tbl_purchase_llis');
		$this->db->join('tbl_course', 'tbl_purchase_llis.item_name = tbl_course.id', 'left');
		$this->db->join('tbl_exam', 'tbl_purchase_llis.item_name = tbl_exam.course_id', 'left');
		$this->db->where('tbl_purchase_llis.user_id',$user_id );
		$this->db->where('tbl_exam.certificate_id !=' ,'' );
		$this->db->group_by('tbl_exam.course_id');
		
		$course_list= $this->db->get()->result_array();
		
		$this->db->select('t.title course_title, t.id, t.units, t.training_type');
		$this->db->from('tbl_training_book tb');
		$this->db->join('tbl_training t', 't.id = tb.training_seminar_id', 'left');
		$this->db->where(array('tb.user_id' => $user_id, 'tb.status' => 1, 'tb.certificate_id' => NULL));
		$training_list = $this->db->get()->result_array();
	
		
		$data['course_list'] = array_merge($course_list, $training_list);
		
		$data['currency']="$";
		$data['specific_ce_record'] = $this->db->select('id ,course_name , units')->get_where('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'specific','archive'=>1))->result_array();
		$data['general_ce_record'] = $this->db->select('id ,course_name , units')->get_where('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'general','archive'=>1))->result_array();
		$data['all_ce_record'] = $this->db->select('id ,course_name , units')->get_where('tbl_existing_certificate',array('user_id'=>$user_id,'archive'=>1))->result_array();
		$data['card'] = $this->db->select('id ,card_name , card_no')->get_where('tbl_card',array('user_id'=>$user_id,'status'=>1))->result_array();

		$course_obtained=array_sum(array_column($data['course_list'],'units'));
		$data['total_course']=$course_obtained;
		$allobtained=array_sum(array_column($data['all_ce_record'],'units'));
		$data['total_certificate']=$allobtained;			
		$gernal_obtained=array_sum(array_column($data['general_ce_record'],'units'));
		$data['total_gernal_certificate']=$gernal_obtained;
		$specific_obtained=array_sum(array_column($data['specific_ce_record'],'units'));
		$data['total_specific_certificate']=$specific_obtained;

		echo json_encode($data);
	}

	public function savecard()
	{
		$jsonvalue= $_POST;
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
	        $data['issue_by']     = $jsonvalue['issue_by'];  
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
	

	
	public function card_lists()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id']; 
			/* $this->db->select("CONCAT(https://ceonpoint.com/assets/images/uploads/,photo) AS photo", FALSE);
			$course_list = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_card',array('user_id'=>$user_id )); */
			 $this->db->select('
			 id,
			 card_no,
			 card_name, 
			 date_issued,
			 expiry_date,
			 issue_by,
			 added_on,
			 status,
			 CONCAT("https://ceonpoint.com/assets/images/uploads/",photo) AS photo'
			 , FALSE);
			$this->db->from('tbl_card');
			$course_list=$this->db->where('user_id',$user_id)->get()->result_array();

			if(count($course_list)>0)
			{
				$result['currency']="$";
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
			
			$course_list = $this->db->get_where('tbl_card',array('id'=>$id ))->row_array();
			$image = "https://ceonpoint.com/assets/images/uploads/".$course_list['photo'];

			if(count($course_list)>0)
			{
				$result['currency']="$";
				$result['data']=$image ;
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
		$json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true); 
		$id     = $jsonvalue['id']; 
		
		$course_list = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_card',array('id'=>$id ), '');

		if(count($course_list)>0)
		{
			$result['data']=$course_list[0];
			$result['success']='true';
			$result['error']="0";
			$result['msg']='Data Found'; 
		}else{
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
			$result['currency']="$";
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
	
		public function purchage_lists()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id']; 
			
			$this->db->select('
			tbl_purchase_llis.id,
			tbl_purchase_llis.amount,
			tbl_purchase_llis.txn_id,
			tbl_purchase_llis.txn_status,
			tbl_purchase_llis.added_on,
			tbl_course.course_title,
			tbl_course.units,
			');
			$this->db->from('tbl_purchase_llis');
			$this->db->join('tbl_course', 'tbl_purchase_llis.item_name = tbl_course.id', 'left');
			$this->db->where('tbl_purchase_llis.user_id',$user_id  );
			$course_list= $this->db->get()->result_array(); 
			
			
			$this->db->select('
			phs.pppph_id id,
			phs.payment_amount amount,
			phs.payment_transtion_id txn_id,
			phs.payment_at added_on,
			phs.pce_plan_name course_title,
			');
			$this->db->from('professional_pce_plan_payment_history phs');
			$this->db->where('phs.user_id',$user_id  );
			$subscription_list= $this->db->get()->result_array();
			
			$dataPay = array_merge($course_list, $subscription_list);
			
			
			
 

			if(count($dataPay)>0)
			{
				$result['currency']="$";
				$result['data']=$dataPay;
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
			
 

			if(count($course_list)>0)
			{
				
				$result['currency']="$";
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
	

	
	public function course_list()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id']; 
			if(isset($jsonvalue['cat_id']) && $jsonvalue['cat_id']!="")
			{
				$cat_id=$jsonvalue['cat_id'];
			}
			if(!empty($user_id) && $jsonvalue['cat_id']=="")
			{
				
				$user=$this->db->get_where('tbl_user',array("id"=>$user_id))->row_array();
				$category = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category',array('cat_name'=>$user['profession']), '');
				$cat_id=$category[0]['id'];
				
			
			} 
			$condition=array();
			
			if(isset($jsonvalue['contry_id']) && $jsonvalue['contry_id']!="")
			{
				$condition['country_id']=$jsonvalue['contry_id'];
			}
			
			if(isset($jsonvalue['course_name']) && $jsonvalue['course_name']!="")
			{
				$condition['course_title LIKE']='%'.$jsonvalue['course_name'].'%';
			}
			if( $cat_id>0)
			{
				$condition['course_category']=$cat_id;
			}
		
			$condition['insititution_id']="0";
			$condition['status']=1;
			
			$this->db->limit(10);
			$this->db->order_by('paid_status','DESC');
			$this->db->where($condition);
			$course_lists = $this->db->get('tbl_course')->result_array();
			
		 /* echo $this->db->last_query();
		exit;  */
			$category  = $this->db->select('id ,cat_name')->order_by('cat_name', 'ASC')->get_where('tbl_category',array("status"=>1))->result_array();
			$courses=array();

			
			foreach($course_lists as $course_list)
			{
				$data['id']=$course_list['id'];
				$data['course_title']=$course_list['course_title'];
				$data['course_photo']="https://ceonpoint.com/assets/images/uploads/".$course_list['course_photo'];
				$data['price']=$course_list['price'];
				
				$country_id = $course_list['country_id'];
				$data['country'] = $this->db->get_where('countries',array('status'=>1, 'countries_id'=>$country_id))->row_array()['countries_name'];
				
				$data['by']=$this->db->get_where('tbl_user',array('id'=>$course_list['user_id']))->row_array()['name'];
				$data['rating']=$course_list['rating'];
				$data['total_revew']=$this->db->get_where('tbl_course_review',array('course_id'=>$course_list['id']))->num_rows();
				$courses[]=$data;
			}
			

			if(count($course_lists)>0)
			{
				$result['courses']=$courses;
				$result['category']=$category;
				$result['success']=true;
				$result['currency']="$";
				$result['current_cat']=$cat_id;
				$result['error']=0;
				$result['msg']='Data Found'; 
			}
			else
			{
				$result['success']=false;
				$result['error']=1;
				$result['msg']='Data Not Found';

			}
			echo json_encode($result);
			 
	} 
	public function all_course_list()
	{
		
		
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id']; 
			if(isset($jsonvalue['cat_id']) && $jsonvalue['cat_id']!="")
			{
				$cat_id=$jsonvalue['cat_id'];
			}
			if(!empty($user_id) && $jsonvalue['cat_id']=="")
			{
				$user=$this->db->get_where('tbl_user',array("id"=>$user_id))->row_array();
				$category = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category',array('cat_name'=>$user['profession']), '');
				$cat_id=$category[0]['id'];
			
			} 
			$condition=array();
			
			if(isset($jsonvalue['contry_id']) && $jsonvalue['contry_id']!="")
			{
				$condition['country_id']=$jsonvalue['contry_id'];
			}
			
			if(isset($jsonvalue['course_name']) && $jsonvalue['course_name']!="")
			{
				$condition['course_title LIKE']='%'.$jsonvalue['course_name'].'%';
			}
			
			if($cat_id>0)
			{
				$condition['course_category'] = $cat_id;
			}
			
			$condition['insititution_id']='0';
			
			$this->db->where('status',1);
			$this->db->where($condition);
			$this->db->order_by('paid_status','DESC');
			$course_lists = $this->db->get('tbl_course')->result_array();
			
// 			echo $this->db->last_query();
// 			print_r($course_lists);
// 		die;
		
			$courses=array();

			
			foreach($course_lists as $course_list)
			{
				$data['id']=$course_list['id'];
				$data['course_title']=$course_list['course_title'];
				$data['course_photo']="https://ceonpoint.com/assets/images/uploads/".$course_list['course_photo'];
				$data['price']=$course_list['price'];
				$country_id = $course_list['country_id'];
				$data['country'] = $this->db->get_where('countries',array('status'=>1, 'countries_id'=>$country_id))->row_array()['countries_name'];
				
				$data['by']=$this->db->get_where('tbl_user',array('id'=>$course_list['user_id']))->row_array()['name'];
				$data['rating']=$course_list['rating'];
				$data['total_revew']=$this->db->get_where('tbl_course_review',array('course_id'=>$course_list['id']))->num_rows();
				$courses[]=$data;
			}
			

			if(count($course_lists)>0)
			{
				$result['courses']=$courses;
				$result['currency']="$";
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
	

/* ------------------------under instutitons course----------------------------- */

	public function course_list_under_institute()
	{
			header('Content-type: application/json');
			$json_file	 = file_get_contents('php://input');
			$jsonvalue	 = json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id']; 
			$ins_id    	 = $jsonvalue['insititution_id'];	//provider under insititution_id

			// filter course by
			$name     	 = $jsonvalue['name'];	
			$course_cat  = $jsonvalue['category'];	
			$country     = $jsonvalue['country'];	

			$user = $this->db->get_where('tbl_user',array('id'=>$user_id))->row_array(); //user under provider
			$category  = $this->db->select('id ,cat_name')->get_where('tbl_category',array("status"=>1))->result_array();
			
			$this->db->select('*');
			$this->db->from('tbl_institution_staff');
			$this->db->where('prof_id',$user_id);
			$this->db->where('insititution_code',$user['under_provider']);
			$user_uins = $this->db->get()->row_array();

			// $this->db->order_by('paid_status','DESC');
			$this->db->where('insititution_id',$ins_id);

			if($name != ""){  $this->db->like('tbl_course.course_title',$name); }
			if($course_cat != ""){  $this->db->like('tbl_course.course_category',$course_cat); }
			if($country != ""){  $this->db->like('tbl_course.country_id',$country); }

			$course_lists = $this->db->get('tbl_course')->result_array();
			// echo $this->db->last_query();die;
			
			$courses=array();
			
			foreach($course_lists as $course_list)
			{
				$data['id']=$course_list['id'];
				$data['course_title']=$course_list['course_title'];
				$data['course_photo']="https://ceonpoint.com/assets/images/uploads/".$course_list['course_photo'];
				$data['price']=$course_list['price'];
				
				$data['by']=$this->db->get_where('tbl_user',array('id'=>$course_list['user_id']))->row_array()['name'];
				$data['rating']=$course_list['rating'];
				$data['total_revew']=$this->db->get_where('tbl_course_review',array('course_id'=>$course_list['id']))->num_rows();
				$courses[]=$data;
			}
			
				if(count($course_lists)>0){
					$result['courses']=$courses;
					$result['category']=$category;
					$result['success']='true';
					$result['currency']="$";
					$result['current_cat']=$cat_id;
					$result['error']="0";
					$result['msg']='Data Found'; 
					
					if($user['insititution_id'] == $ins_id && $user_uins['activated'] == "1"){
						$result['paid']		= true;
					}else{
						$result['paid']		= false;
					} 
				}else{
					$result['success']='false';
					$result['error']="1";
					$result['msg']='Data Not Found';
				}
			echo json_encode($result);			 
	} 

	public function all_course_list_under_institute()
	{
		
		
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id']; 
			if(isset($jsonvalue['cat_id']) && $jsonvalue['cat_id']!="")
			{
				$cat_id=$jsonvalue['cat_id'];
			}
			if(!empty($user_id) && $jsonvalue['cat_id']=="")
			{
				$user=$this->db->get_where('tbl_user',array("id"=>$user_id))->row_array();
				$category = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category',array('cat_name'=>$user['profession']), '');
				$cat_id=$category[0]['id'];
			
			} 
			$condition=array();
			
			if(isset($jsonvalue['contry_id']) && $jsonvalue['contry_id']!="")
			{
				$condition['country_id']=$jsonvalue['contry_id'];
			}
			
			if(isset($jsonvalue['course_name']) && $jsonvalue['course_name']!="")
			{
				$condition['course_title LIKE']='%'.$jsonvalue['course_name'].'%';
			}

			
			if($cat_id>0)
			{
				
				$condition['course_category']=$cat_id;
			}
			
			$condition['insititution_id !=']='0';
			
			
			$this->db->where($condition);
			$this->db->order_by('paid_status','DESC');
			$course_lists = $this->db->get('tbl_course')->result_array();
		
			$courses=array();

			
			foreach($course_lists as $course_list)
			{
				$data['id']=$course_list['id'];
				$data['course_title']=$course_list['course_title'];
				$data['course_photo']="https://ceonpoint.com/assets/images/uploads/".$course_list['course_photo'];
				$data['price']=$course_list['price'];
				
				$data['by']=$this->db->get_where('tbl_user',array('id'=>$course_list['user_id']))->row_array()['name'];
				$data['rating']=$course_list['rating'];
				$data['total_revew']=$this->db->get_where('tbl_course_review',array('course_id'=>$course_list['id']))->num_rows();
				$courses[]=$data;
			}
			

			if(count($course_lists)>0)
			{
				$result['courses']=$courses;
				$result['currency']="$";
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

/* ----------------------------------end--------------------------------------- */

	
	
	
	
	public function course_overview()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$id     = $jsonvalue['id']; 
			$user_id     = $jsonvalue['user_id'];
			
			$purchase = $this->db->get_where('tbl_purchase_llis',array('user_id'=>$user_id ,'item_name'=>$id))->num_rows();

			if($purchase>0)
			{
			$result['purchase']=1;
			}
			else
			{
			$result['purchase']=0;
			}
			
			
			$course_lists = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course',array('id'=>$id), '');
			$course_list=$course_lists[0];
				
			if(count($course_list)>0)
			{
				
				$profession  = $this->user->get_professions($course_list['profession']);
                $stringddata = "";
                foreach ($profession as $key => $value) {
				$stringddata .= $value['cat_name'].',';
				}
				   
				$course['id']=$course_list['id'];
				$course['course_name']=$course_list['course_title'];
				$course['course_photo']="https://ceonpoint.com/assets/images/uploads/".$course_list['course_photo'];
				$course['course_acceditation_number']=$course_list['course_acceditation_number'];
				$course['units']=$course_list['units'];
				$course['tax']=$course_list['tax'];
				$course['course_validity']=date('F d, Y',strtotime($course_list['course_validity']));
				$course['who_can_use']=$stringddata;
				$course['couser_description']=$course_list['course_description'];
				$course['price']=$course_list['total'];
				$course['rating']=$course_list['rating'];
				$course['total_revew']=$this->db->get_where('tbl_course_review',array('course_id'=>$course_list['id']))->num_rows();
				$course['course_category']=$course_list['course_category'];
				
				$providerDetailList = $this->db->get_where('tbl_user',array('id'=>$course_list['user_id']))->row_array();
				
				$providerDetail['name'] = $providerDetailList['name'];
				$providerDetail['profession'] = $providerDetailList['profession'];
				$providerDetail['country'] = $providerDetailList['country'];
				$providerDetail['representative'] = $providerDetailList['representative'];
				$providerDetail['position'] = $providerDetailList['position'];
				$providerDetail['username_email'] = $providerDetailList['username_email'];
				$providerDetail['image'] = $providerDetailList['image'];
				
				$result['course_details']=$course;
				$result['provider_details']=$providerDetail;
				$result['currency']="$";
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
	
	public function course_lesson()
	{
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		$id     = $jsonvalue['id'];
		$user_id     = $jsonvalue['user_id'];
		
		$purchase = $this->db->get_where('tbl_purchase_llis',array('user_id'=>$user_id ,'item_name'=>$id ))->num_rows();

		if($purchase>0)
		{
			$result['purchase']=1;
		}
		else
		{
			$result['purchase']=0;
		}
		
		$lesson_list = $this->db->get_where('tbl_lesson',array('course_id'=>$id,'status'=>1))->result_array();
		
		$course_lists = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course',array('id'=>$id), '');
		$course_list=$course_lists[0];

		$lesson=array();
		$course=array();
		$course['id']=$course_list['id'];
		$course['by']=$this->db->get_where('tbl_user',array('id'=>$course_list['user_id']))->row_array()['name'];
		$course['rating']=$course_list['rating'];
		$course['total_revew']=$this->db->get_where('tbl_course_review',array('course_id'=>$course_list['id']))->num_rows();
		$course['price']=$course_list['price'];

	foreach($lesson_list as $lessons)
			{
				$data['id']=$lessons['id'];
				$data['lesson_video']=$lessons['lesson_video'];
				$data['lesson_title']=$lessons['lesson_title'];
				$data['lesson_content']=$lessons['lesson_content'];
				$data['summary']=$lessons['summary'];
				$data['course_references']=$lessons['course_references'];
				
				$lesson[]=$data;
			}


		if($lesson)
		{
			$result['course_lesson']=$lesson;
			$result['course']=$course;
			$result['currency']="$";
			$result['success']='true';
			$result['error']="0";
			$result['msg']='Data found'; 
		}
		else
		{
			$result['success']='false';
			$result['error']="1";
			$result['msg']='Data Not found';

		}
			echo json_encode($result);
	}		
	
	public function course_exam()
	{ 
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		$id     = $jsonvalue['id'];
		$user_id     = $jsonvalue['user_id'];
		
		$purchase = $this->db->get_where('tbl_purchase_llis',array('user_id'=>$user_id ,'item_name'=>$id/* ,'txn_status'=>'Completed' */))->num_rows();
	

		if($purchase>0)
		{
			$result['purchase']=1;
		}
		else
		{
			$result['purchase']=0;
		}
		
		$course_lists = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course',array('id'=>$id), '');
		$course_list=$course_lists[0];
	
		$pre_attempt = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_exam',array('user_id'=>$user_id ,'course_id'=>$id), '');
		
		$total_attemp=count($pre_attempt);
		$last_attemp=$pre_attempt[0];
			$pre_qus_id=array();
		$pre_data=(array) json_decode($last_attemp['data'],true);
		$pre_qus_id=array_column($pre_data,'qid');
		if(count($pre_data)>0)
		{
			
		$this->db->where_in('id',$pre_qus_id);
		$this->db->order_by("id", "desc");
		$ddd=$this->db->get('tbl_quiz_question')->result_array(); 
		}
		$result['pre_attempt']='0';
		if($total_attemp>0)
		{
			$result['pre_attempt']='1';
			$i=0;
			$$correctAns=1;
		foreach($ddd as $pre_exam)
			{
				if($pre_exam['correct_answere']==$pre_data[$i]['ans'])
				{
					$data['ansewer']="correct";
					$correctAns++;
				}
				else
				{
					$data['ansewer']="Incorrect";
				}
				$data['id']=$pre_exam['id'];
				$data['question_title']=$pre_exam['question_title'];
				$data['option1']=$pre_exam['answere1'];
				$data['option2']=$pre_exam['answere2'];
				$data['option3']=$pre_exam['answere3'];
				$data['option4']=$pre_exam['answere4'];
				$data['selected_option']=$pre_data[$i]['ans'];
				
				$i++;
				$pre_exam_qus[]=$data;
			}
			$total_question = $i;
			$total_correct_question = $correctAns;
			$result['pre_exam_qus']=$pre_exam_qus;
		}
		

		if($total_attemp>0 && $last_attemp['percentages']>=$course_list['passing_marks'])
		{
			$result['pre_attempt_msg']="<strong>Congratulations!</strong><br>
					You Pass the examination. <br>

					Percentage: ".$last_attemp['percentages']."% out of 100%<br>
					
					Required for Passing ".$course_list['passing_marks']."%";
					$result['pre_exam_result']="pass";
					$result['save_button'] = true;
		}
		elseif($total_attemp>0 && $last_attemp['percentages']<$course_list['passing_marks'])
		{
			//$result['pre_attempt_msg']="Sorry your previous ".$total_attemp." attempt is
					//failed. Please retake exam again. <br> Percentage:".$last_attemp['percentages']."% out of 100%";
			$result['pre_attempt_msg'] = '<h5><strong>Please take Exam Again!</strong></h5><h6 style="color: red;">Your Score : '.($total_correct_question ? $total_correct_question : 0 ) .' out of '.$total_question.' ( '.$last_attemp['percentages'].' % ) </h6><h6>Passing Marks : '.$course_list['passing_marks'].'%</h6><h6><strong>Note: </strong><p>Good luck in your examination.</p></h6><h6><strong>Rest Retake: </strong>'.($course_list['quiz_retek'] - $total_attemp).'</h6>';
			$result['pre_exam_result']="fail";
			
		}
		elseif($total_attemp>0 && $total_attemp>=$course_list['quiz_retek'])
		{
			$result['pre_attempt_msg']="Sorry !
					You Have already attempt ".$course_list['quiz_retek']." and exceed the Reteck.";
					$result['pre_exam_result']="exceed";
		}
		
		
		
		
		
		
		
		$exam_lists = $this->db->get_where('tbl_quiz_question',array('course_id'=>$id,'status'=>1))->result_array();
		
		$exam_qus=array();
		
		
		$course=array();
		
		
		$course['id']=$course_list['id'];
		$course['by']=$this->db->get_where('tbl_user',array('id'=>$course_list['user_id']))->row_array()['name'];
		$course['rating']=$course_list['rating'];
		$course['total_revew']=$this->db->get_where('tbl_course_review',array('course_id'=>$course_list['id']))->num_rows();
		$course['price']=$course_list['price'];
		
		
		foreach($exam_lists as $exam_list)
			{
				$data['id']=$exam_list['id'];
				$data['question_title']=$exam_list['question_title'];
				$data['option1']=$exam_list['answere1'];
				$data['option2']=$exam_list['answere2'];
				$data['option3']=$exam_list['answere3'];
				$data['option4']=$exam_list['answere4'];
				$data['currect_ansewer']=$exam_list['correct_answere'];
				$exam_qus[]=$data;
			}


		if($exam_lists)
		{
			$result['exam_qus']=$exam_qus;
			$result['course']=$course;
			$result['currency']="$";
			$result['success']='true';
			$result['error']="0";
			$result['msg']='Data found'; 
		}
		else
		{
			$result['success']='false';
			$result['error']="1";
			$result['msg']='Data Not found';

		}
			echo json_encode($result);
	}
	
	public function course_saveexam()
	{ 

		/* header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true);  */
		 $jsonvalue=$_POST;
		$id     = $jsonvalue['id'];
		$user_id     = $jsonvalue['user_id'];

		$correct = 0;
		$wrong   = 0;
		
		
	   
	
		$passmarrksData = $this->db->get_where('tbl_course',array('id'=>$id))->row_array();
		$passmarks = $passmarrksData['passing_marks'];

		
		$all_question = $this->user->get_record_by_field_name_all_record('tbl_quiz_question','course_id',$id);
	

		$qdata=array();
		
		foreach ($all_question as $key => $value)
		{
			$qdata[$key]['qid']=$value['id'];
			$qdata[$key]['ans']=$this->input->post('ans-'.$value['id']);
			
			if($this->input->post('ans-'.$value['id'])==$value['correct_answere'])
			{
				$correct++;
			} 
			else 
			{
				$wrong++;
			}	
		}

		$toalMarks = count($all_question)*100;
		$totalCorrect = $correct*100;
		$obtainedMarks = $totalCorrect * 100 / $toalMarks;
  		

		if($obtainedMarks >= $passmarks)
		{


			include('./third_party/library/phpqrcode/qrlib.php'); 

			$image_location = "./assets/images/uploads/";

			$image_name = date('d-m-Y-h-i-s').'.png';

			$certificateNo = 'CERTI'.rand(9,999999999);

			$dataContent = $certificateNo;
			$ecc  = 'H';
			$size = '5';
 
			QRcode::png($dataContent, $image_location.$image_name, $ecc, $size);  

			$data['certificate_id']  = $certificateNo;
			$data['barcode']         = $image_name;	
		}



		$data['user_id']            = $user_id;
		$data['course_id']          = $id;
		$data['status']             = 1;
		$data['percentages']        = $obtainedMarks;
  		$data['added_on']           = date('y-m-d h:i:s');
  		$data['data']           	= json_encode($qdata);
  		
		$res = $this->user->save('tbl_exam',$data);
		if($res)
		{
			
			$result['currency']="$";
			$result['success']='true';
			$result['error']="0";
			$result['msg']='Data Save'; 
		}
		else
		{
			$result['success']='false';
			$result['error']="1";
			$result['msg']='Data Not Save';

		}
			echo json_encode($result);
 
    }
	
	
	public function course_certificate()
	{ 
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		$id     = $jsonvalue['id'];
		$user_id     = $jsonvalue['user_id'];
		
		$purchase = $this->db->get_where('tbl_purchase_llis',array('user_id'=>$user_id ,'item_name'=>$id))->num_rows();
		if($purchase>0)
		{
			$result['purchase']=1;
		}
		else
		{
			$result['purchase']=0;
		}
		
		$pre_attempt = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_exam',array('user_id'=>$user_id ,'course_id'=>$id), '');
//  		print_r($pre_attempt);

		if(count($pre_attempt)>0)
		{
		$result['pre_attempt']='1';
		}
		else
		{
			$result['pre_attempt']='0';
		}
		
		$course_lists = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course',array('id'=>$id), '');	
		if($pre_attempt[0]['percentages']>=$course_lists[0]['passing_marks'])
		{
			$result['pre_exam_res']='1';
		}
		else
		{
			$result['pre_exam_res']='0';
		}
	
		
		if (count($pre_attempt) < 1) {
		    $result['attemptExam'] = 0;
		    
		    $result['success']=false;
			$result['error']="1";
			$result['msg']='Certificate Not Available';
		} else {
		    if (!empty($pre_attempt[0]['certificate_id'])) {
         		$evaluation = $this->db->get_where('tbl_course_review',array('user_id'=>$user_id ,'course_id'=>$id))->row_array();
        //  		echo $this->db->last_query(); die;
        //  		print_r($evaluation);
	       // 	echo $this->db->last_query(); die;
         		if(!empty($evaluation)) {
                	$result['certificate']= $pre_attempt[0]['certificate_id'];
        			$result['currency']="$";
        			$result['success']=true;
        			$result['error']="0";
        			$result['msg']='Certificate Available';
         		} else {
         		    $result['success']=false;
        			$result['error']= 0;
        			$result['noEvaluation']= 0;
        			$result['msg']='Please evaluate this course to see your Certificate';
         		}
    		}
		}
	
	// $data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$user_id);
 	// $data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);	
	// $data['certificate']= $this->db->get_where('tbl_user_certificate',array('course_id'=>$id))->result_array();
	// $data['ceprovider']= $this->db->get_where('tbl_user',array('id'=>$data['course'][0]['user_id']))->result_array();
	// $data['exam_details'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_exam',array('user_id'=>$user_id ,'course_id'=>$id));
	// $certificate=$this->load->view('api-html/certificate-preview',$data);
// 	if(!empty($exam_details) || !empty($certificate) || !empty($course)|| !empty($profile)  )
// 		{
// 			$result['certificate']=$certificate;
// 			$result['currency']="$";
// 			$result['success']='true';
// 			$result['error']="0";
// 			$result['msg']='Certificate Available'; 
// 		}
// 		else
// 		{
// 			$result['success']='false';
// 			$result['error']="1";
// 			$result['msg']='Certificate Not Available';

// 		}
			echo json_encode($result);
		
	}
	
	/* $certificate_data['logo1']=ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1'];
	$certificate_data['logo2']=ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2'];
	$certificate_data['header_line1']=$certificate[0]['header_line1'];
	$certificate_data['header_line2']=$certificate[0]['header_line2'];
	$certificate_data['header_line3']=$certificate[0]['header_line3'];
	$certificate_data['title']=$certificate[0]['title'];
	$certificate_data['user_name']=$profile[0]['name'];
	$certificate_data['intro_text']=$certificate[0]['intro_text'];
	$certificate_data['course_title']=$certificate[0]['course_title'];
	$certificate_data['pass_date']=date('F-d-Y',strtotime($exam_details[0]['added_on']));
	$certificate_data['units']=$course[0]['units'];
	$certificate_data['cetificate_title']=$certificate[0]['title'];
	$certificate_data['barcode']=ASSETS_URL .'images/uploads/'.$exam_details[0]['barcode'];
	$certificate_data['certificate_id']=$exam_details[0]['certificate_id'];
	$certificate_data['sign_name']= explode('##', $certificate[0]['name']);
    $certificate_data['sign_position']=   explode('##', $certificate[0]['position']);
	$filesarray = explode('##',$certificate[0]['signature']);
	
	foreach($filesarray as $files)
	{
		$certificate_data['sign_image'][]=ASSETS_URL.'upload/certificate/signature/'.$files;
	} */
	
	
	

public function payment()
{
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		
		$price     = $jsonvalue['price'];
		$user_id     = $jsonvalue['user_id'];
		$course_id     = $jsonvalue['course_id'];
		$txn_id     = $jsonvalue['txn_id'];
		$quantity     = $jsonvalue['quantity'];
		$txn_status     = $jsonvalue['txn_status'];
		
		
		$data['user_id']=$user_id;
		$data['item_name']=$course_id;
		$data['quantity']=$quantity;
		$data['amount']=$price ;
		$data['txn_id']=$txn_id;
		$data['txn_status']=$txn_status;
		$data['status']='1';
		$data['purchase_device']="mobile";
		$data['added_on']=date('Y-m-d');
		
		$res=$this->db->insert('tbl_purchase_llis',$data);
		
		
		if($res)
		{
			
			$result['currency']="$";
			$result['success']='true';
			$result['error']="0";
			$result['msg']='Data Save'; 
		}
		else
		{
			$result['success']='false';
			$result['error']="1";
			$result['msg']='Data Not Save';

		}
			echo json_encode($result);
		
}

	public function download_certificate()
	{	

		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		$id     = $jsonvalue['id'];
		$user_id     = $jsonvalue['user_id'];
		
 		$data['profile']= $this->user->get_record_by_field_name_all_record('tbl_user','id',$user_id);
 		$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);	
		$data['certificate']= $this->db->order_by('id','desc')->get_where('tbl_user_certificate',array('course_id'=>$id))->result_array();
		
		$data['exam_details'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_exam',array('user_id'=>$user_id ,'course_id'=>$id), '');
 		
		$html=$this->load->view('api-html/certificate-pdf-portat',$data, true);
		// Get output html
		//$html = $this->output->get_output();
		// print_r($html);die;
		$this->load->library('Dompdf_gen');
		
		$this->dompdf->load_html($html);
		
		$this->dompdf->render();
		
		$namepdf=str_replace(' ','-',$data['course'][0]['course_title']).time()."-certificate.pdf";
		$path='./assets/upload/course-pdf/'.$namepdf;
		$res=  file_put_contents($path, $this->dompdf->output());
		  $cetificate=ASSETS_URL.'upload/course-pdf/'.$namepdf;
		  
		
	
		if( $res)
		{
			$result['url']=$cetificate;
			$result['currency']="$";
			$result['success']='true';
			$result['error']="0";
			$result['msg']='certificate uploade successfully downloaded.';
		}
		else
		{
			
			$result['success']='false';
			$result['error']="1";
			$result['msg']='certificate could not download try latter.';

		}
			echo json_encode($result);
		
	}
	
	
	public function uploade_certificate()
	{
		header('Content-type: application/json');
		$json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true); 
		// echo $this->db->last();die;
		// $jsonvalue = $_POST;
		// $user_id   = $jsonvalue['user_id']; 
		// print_r($jsonvalue);die;
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
			$result['success']='false';
			$result['error']="1";
			$result['msg']=$error; 
			echo json_encode($result);
			die();
		}  
		$data['certificate'] = $imageName;
		}

		$data['certificate_id']    = $jsonvalue['certificate_id']; 
		$data['course_name']       = $jsonvalue['course_name'];
		$data['units']             = $jsonvalue['units']; 
		$data['issue_date']        = $jsonvalue['issue_date']; 
		$data['category']          = $jsonvalue['category']; 
		$data['status']            = 1; 
		$data['archive']            = 1;
		$data['issue_from']        = $jsonvalue['issue_from']; 
		$data['issue_by']          = $jsonvalue['issue_by']; 
		$data['added_on']          = date('Y-m-d h:i:s'); 
		$data['user_id']           = $jsonvalue['user_id'];

		$res = $this->users_model->save('tbl_existing_certificate',$data); 


		if( $res)
		{
			$result['currency']="$";
			$result['success']='true';
			$result['error']="0";
			$result['msg']='Certificate successfully uploaded.';
		}
		else
		{
			
			$result['success']='false';
			$result['error']="1";
			$result['msg']='Certificate could not uploade try latter.';

		}
			echo json_encode($result);
	
	}
	
	
	public function certificate_details()
	{
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		$id     = $jsonvalue['id']; 
		$course_list = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('id'=>$id ), '')[0];

		if(count($course_list)>0)
		{
			// $course_list['certificate']="https://www.ceonpoint.com/assets/upload/course-pdf/".$course_list['certificate'].".pdf";
			if ($course_list['issue_by'] == 'CEonpoint') {
				$result['manualUpload'] = true;    
			} else {
				$result['manualUpload'] = false;
			}
			
			$course_list['certificate']=$course_list['certificate'];
			$result['currency']="$";
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

	public function certificate_list()
	{
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		
		$uid     = $jsonvalue['user_id']; 
		$course_list = $this->db->order_by('id','desc')->get_where('tbl_existing_certificate',array('user_id'=>$uid))->result_array();
		// echo $this->db->last_query();die;
		if(count($course_list)>0)
		{
			if ($course_list['issue_by'] == 'CEonpoint') {
				$result['manualUpload'] = true;    
			} else {
				$result['manualUpload'] = false;
			}

			$result['currency']	= "$";
			$result['path']		= "https://www.ceonpoint.com/assets/images/uploads/";
			$result['data']		= $course_list;
			$result['success']  = true;
			$result['error']	= "0";
			$result['msg']		= 'Data Found'; 
		}
		else
		{
			$result['success']	= false;
			$result['error']	= "1";
			$result['msg']		= "Data Not Found";
		}
		echo json_encode($result);	
	}
	
	public function certificate_download()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$id     = $jsonvalue['id']; 
			
			$course_list = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('id'=>$id ), '');
 
			$course_lists="https://www.ceonpoint.com/assets/images/uploads/".$course_list[0]['certificate'];

			if(count($course_list)>0)
			{
				$result['currency']="$";
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
	
	public function update_certificate()
	{
		/*header('Content-type: application/json');
		 $json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		*/
		$jsonvalue=$_POST;
		
 


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
			$result['success']='false';
			$result['error']="1";
			$result['msg']=$error; 
			echo json_encode($result);
			exit();
			die();
		}  
		$data['certificate'] = $imageName;
		}

		$data['certificate_id']    = $jsonvalue['certificate_id']; 
		$data['course_name']       = $jsonvalue['course_name'];
		$data['units']             = $jsonvalue['units']; 
		$data['issue_date']        = $jsonvalue['issue_date']; 
		$data['category']          = $jsonvalue['category']; 
		$data['issue_from']        = $jsonvalue['issue_from']; 
		$data['issue_by']          = $jsonvalue['issue_by']; 
		
		$this->db->where('id',$jsonvalue['id']);
		$res = $this->db->update('tbl_existing_certificate',$data); 


		if($res)
		{
			$result['currency']="$";
			$result['success']='true';
			$result['error']="0";
			$result['msg']='certificate successfully  updated.';
		}
		else
		{
			
			$result['success']='false';
			$result['error']="1";
			$result['msg']='certificate could not updated try latter.';

		}
			echo json_encode($result); 
	
	}
	
	public function certificate_delete()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$id     = $jsonvalue['id']; 
			
			$this->db->where('id',$id );
			$res=$this->db->delete('tbl_existing_certificate');
			
 
			

			if($res)
			{
				
				$result['currency']="$";
				$result['success']='true';
				$result['error']="0";
				$result['msg']='Certificate successfully deleted!'; 
			}
			else
			{
				$result['success']='false';
				$result['error']="1";
				$result['msg']='Certificate not deleted. Try Again!';

			}
			
			echo json_encode($result);
			
	}
	
	
	
	
	
	public function get_profile()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id']; 
			
			$this->db->select('id,name,username_email,profession,added_on,location,country,image,backimage,licence,role,parent_insititution,licence_validity,under_insititution');
			$this->db->from('tbl_user');
			
			$this->db->where('tbl_user.id', $user_id);
			$data['user']= $this->db->get()->row_array();
			$data['user']['location']=$this->db->get_where('countries',array('countries_id'=>$data['user']['country']))->row_array()['countries_name'];
			$data['user']['image']="https://www.ceonpoint.com/assets/images/uploads/".$data['user']['image'];
			$data['user']['backimage']=$data['user']['backimage'];
			$data['user']['licence_validity']=$data['user']['licence_validity'];
			
				 
			$data['all_role']=array(
			'1'=> 'Professional',
			'2'=> 'CPD Provider'
			);
			
			$this->db->select('countries_id,countries_name');
			$this->db->from('countries');
			$data['countries']=$this->db->where('status',1)->order_by('countries_name', 'ASC')->get()->result_array();
			
			$where = array('role'=>5,'under_insititution'=>0);
			$data['insititution'] = $this->user->get_record_by_multi_field_name('tbl_user',$where);
			
			$this->db->select('cat_name');
			$this->db->order_by('cat_name', 'ASC');
			$this->db->from('tbl_category');
			$data['professions']=$this->db->get()->result_array();	
			

			if(count($data)>0)
			{
			
				$result['currency']="$";
				$result['data']=$data;
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
	
	public function update_profile()
	{
			/*header('Content-type: application/json');
			 $json_file=file_get_contents('php://input');
			$jsonvalue = json_decode($json_file,true);  */
			$jsonvalue=$_POST;
			$user_id     = $jsonvalue['user_id']; 

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
				$result['success']='false';
				$result['error']="1";
				$result['msg']=$error;
					echo json_encode($result);
					exit;
					die;
			}  
			$data['image'] = $imageName;
			}
			if(isset($_FILES["backImageUpload"]) && !empty($_FILES["backImageUpload"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext1 = explode('.',$_FILES["backImageUpload"]["name"]);        
			$imageName1 = 'IMG_'.time().'.'.end($ext1);
			$config['file_name'] = $imageName1;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('backImageUpload'))
			{
				$error = array('error' => $this->upload->display_errors()); 
				$result['success']='false';
				$result['error']="1";
				$result['msg']=$error;
					echo json_encode($result);
					exit;
					die;
			}  
			$data['backimage'] = $imageName1;
			}
			
			$data['name'] = $jsonvalue['name'];
			$data['profession'] = $jsonvalue['profession'];
			$data['country'] = $jsonvalue['location'];
			$data['licence'] = $jsonvalue['licence']; 
			$data['licence_validity'] = $jsonvalue['licence_validity'];
			$res = $this->user->update('tbl_user',$data,'id',$user_id);
			if($res)
			{
				$result['currency']="$";
				$result['success']='true';
				$result['error']="0";
				$result['msg']='Profile Successfully Updated'; 
			}
			else
			{
				$result['success']='false';
				$result['error']="1";
				$result['msg']='Data Not Updated ';

			}
			echo json_encode($result);
			
	}
	
	public function sendcertificate()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue = json_decode($json_file,true);  
			
			$user_id     = $jsonvalue['user_id']; 
			$send_to     = $jsonvalue['send_to']; 
			$user_id     = $jsonvalue['user_id']; 
			$subject     = $jsonvalue['subject']; 
			$jsonvalue['date']=date("d-m-Y");
			
			
			$receipt=rand();
			
			$certificate_id     = $jsonvalue['cetificate_id'];
			$cer_data=$this->db->get_where('tbl_existing_certificate',array('id'=>$certificate_id ))->row_array();
			
			$userdata=$this->db->get_where('tbl_user',array('id'=>$user_id ))->row_array();
			
			$jsonvalue['certificate_no']=$cer_data['certificate_id'];
			$jsonvalue['recept_no']=$receipt;

			$retdata['cetificate_no']=$cer_data['certificate_id'];
			$retdata['send_to']=$jsonvalue['send_to']; 
			$retdata['recept_no']=$receipt;
			
			
			
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('mails@ceonpoint.com');
			//$this->email->to('deepak.1999.kumar@gmail.com');
			$this->email->to($send_to );
			$this->email->subject($subject);
			$this->email->message($subject);
			$this->email->attach('assets/upload/pdf/'.$cer_data['certificate']);
			


			if($this->email->send())
			{ 
				$this->db->insert('tbl_send_certificate',$jsonvalue);
				
				$result['currency']="$";
				$result['data']=$retdata;
				$result['success']='true';
				$result['error']="0";
				$result['msg']='Certificate successfully send !'; 
			
			}
			else
			{ 
				$result['currency']="$";
				$result['success']='fail';
				$result['error']="1";
				$result['msg']='Certificate not successfully send. Try Again !';
		

			}
			echo json_encode($result);
	}
	
	public function alredysendto()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue = json_decode($json_file,true); 
			$user_id=$jsonvalue['user_id'];
			$id=$jsonvalue['course_id'];
			
			$this->db->select('send_to,date,id,certificate_no,recept_no');
			$this->db->where(array('user_id'=>$user_id ,'cetificate_id'=>$id));
			$this->db->from('tbl_send_certificate');
			$sentto=$this->db->order_by('id','DESC')->get()->result_array();
	
		if(count($sentto)>0)
			{
				
				$result['currency']="$";
				$result['data']=$sentto;
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
	
	public function notification(){
		header('Content-type: application/json');
		$json_file =file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true); 
		$user_id   = $jsonvalue['user_id'];

		$notification = $this->db->where(array('to'=>$user_id))->get('tbl_notification')->num_rows();
	 		
 		$this->db->select('n.*,u.name sender_name'); 
		$this->db->from('tbl_notification n');
		$this->db->join('tbl_user u','n.from = u.id');
 		$this->db->where('n.to',$user_id);
 		$this->db->where('n.status',1);
		$this->db->order_by('n.id','desc');
		$query = $this->db->get();
		$total_notification  = $query->result_array();

	 	$this->db->select('n.*, u.name sender_name');
	 	$this->db->from('tbl_notification n');
	 	$this->db->join('tbl_user u','n.from = u.id','left');
	 	$this->db->where('n.to',$user_id);
	 	$this->db->where('n.status',0);
	 	$this->db->order_by('n.id','DESC');
	 	$queryr = $this->db->get();
	 	$read_notification = $queryr->result_array();
	 	 
		if(count($notification)>0){
			$result['count'] 	= $notification;
			$result['inbox'] 	= $total_notification;
			$result['read']  	= $read_notification;
			$result['success'] 	= true;
			$result['msg']     	= 'Data Found'; 
		}else{
			$result['success'] 	= false;
			$result['msg']		= 'Data Not Found';
		}
		echo json_encode($result);
	}
	

	public function getmessage(){		
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true); 
		$id=$jsonvalue['id'];
		$this->db->select('message');
		$this->db->where(array('id'=>$id));
		$this->db->from('tbl_notification');
		$notification=$this->db->order_by('id','DESC')->get()->row_array();
		 
		if(!empty($notification)){
			$this->db->where(array('id'=>$id));
			$this->db->update('tbl_notification',array('status'=>0));
			$result['currency']	=	"$";
			$result['data']		=	$notification;
			$result['success']	=	'true';
			$result['error']	=	"0";
			$result['msg']		=	'Data Found'; 
		}else{
			$result['success']	=	'false';
			$result['error']	=	"1";
			$result['msg']		=	'Data Not Found';
		}
			echo json_encode($result);
	}
	
	
	public function update_notification(){
		header('Content-type: application/json');
		$json_file 	=	file_get_contents('php://input');
		$jsonvalue 	= 	json_decode($json_file,true); 
		$id   		= 	$jsonvalue['id'];

		$this->db->where('id',$id);
		$update = $this->db->update('tbl_notification',array('status'=>0));
		if($update){
			$result['success']	=	true;
		}else{
			$result['success']	=	false;
		}
			echo json_encode($result);
	}
	
	
/* -----------------------apt---------------- */

	// public function notification(){
	// 	$data['notification'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_notification','status',1);
	// 	$this->load->frontAdmin('professional/notification',$data);
	// }

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
		
		} 
		else
		{




			$under_institution = $this->input->post('under_institution');
			//if($under_institution==1){
			 $institution      = $this->input->post('institution');
			 $institution_code = $this->input->post('institution_code');

				$where =array('id'=>$institution,'insititution_id'=>$institution_code);
				$insititution = $this->user->get_record_by_multi_field_name('tbl_user',$where); 
				
			 

				if(empty($insititution)){ 
					$this->session->set_flashdata('response', '<div class="alert alert-danger">Invalid institution code.</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');

				}
				else
				{ 
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


 /* public function course_list($c_id=false)
	{
	    if($c_id==""){
	    	$data1 = $this->session->userdata('logged_in');
	    	$profession = $data1['profession'];
	    	$courseId   = $this->db->get_where('tbl_category',array('cat_name'=>$profession))->row_array();
	    	$cid = $courseId['id'];
	    } 
		else
		{
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
	    die;
		$this->load->frontAdmin('professional/course_list',$data);
	}
*/





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



  /* public function existing()
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
	} */

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

	public function show_package_strip()
	{
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		$uid     = $jsonvalue['user_id']; 

		// $userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
		// $uemail = $userdata['username'];
		// $under_insititution = $userdata['under_insititution']; 
		// $role = $userdata['role'];

        $plansArr 			= $this->professional_model->planlisting(2);
        $basicplansArr 		= $this->professional_model->planlisting(1);
        $premiumplansArr 	= $this->professional_model->planlisting(3);
        $checkactiveplanArr = $this->professional_model->checkactiveplan($uid);

		$expiry		= strtotime($checkactiveplanArr->plan_expiry_at);
		$today		= strtotime(date('Y-m-d'));
		$remaindays	=  $expiry - $today;
		$dayreamaining = floor($remaindays / (60 * 60 * 24));
		
		if($checkactiveplanArr->payment_status == 'n' ){
			$result['new_user'] = true; // free pro version yes
		}else{
			$result['new_user'] = false; // free pro version no
		} 

		if($dayreamaining > 0 ){ 
			$result['package_exp'] = false; // expired no 
		}else{
			$result['package_exp'] = true; // expired yes 
		}
		$result['remaindays'] = $dayreamaining;

		echo json_encode($result);
	}
	public function package_plan()
	{
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 

        $plansArr 			= $this->professional_model->planlisting(2);
        $basicplansArr 		= $this->professional_model->planlisting(1);
        $premiumplansArr 	= $this->professional_model->planlisting(3);

        foreach($plansArr as $key => $value){
        	$planAr = explode(",", $value['pro_plan_features']);
        	$plan_discription = $this->db->where_in('ppf_id',$planAr)->get('tbl_professional_plan_features')->result_array();
        	$plan_discription1 = array_column($plan_discription,'features_name');
			$palndata[] = array(
				'propla_id'				=>	$value['propla_id'],
				'plan_id'				=>	$value['plan_id'],
				'pro_package_name'		=>	$value['pro_package_name'],
				'pro_package_amount'	=>	$value['pro_package_amount'],
				'pro_plan_features'		=>	$plan_discription1,
			);
        }
        foreach($basicplansArr as $key => $value){
        	$planAr = explode(",", $value['pro_plan_features']);
        	$plan_discription = $this->db->where_in('ppf_id',$planAr)->get('tbl_professional_plan_features')->result_array();
        	$plan_discription1 = array_column($plan_discription,'features_name');
			$basicdata[] = array(
				'propla_id'				=>	$value['propla_id'],
				'plan_id'				=>	$value['plan_id'],
				'pro_package_name'		=>	$value['pro_package_name'],
				'pro_package_amount'	=>	$value['pro_package_amount'],
				'pro_plan_features'		=>	$plan_discription1,
			);
        }
        foreach($premiumplansArr as $key => $value){
        	$planAr = explode(",", $value['pro_plan_features']);
        	$plan_discription = $this->db->where_in('ppf_id',$planAr)->get('tbl_professional_plan_features')->result_array();
        	$plan_discription1 = array_column($plan_discription,'features_name');
			$premiumdata[] = array(
				'propla_id'				=>	$value['propla_id'],
				'plan_id'				=>	$value['plan_id'],
				'pro_package_name'		=>	$value['pro_package_name'],
				'pro_package_amount'	=>	$value['pro_package_amount'],
				'pro_plan_features'		=>	$plan_discription1,
			);
        }

		$result['plan'] = $palndata;
		$result['basicplans'] = $basicdata;
		// $result['premiumplans'] = $premiumdata;

		echo json_encode($result);
	}


public function institute_course_list()
	{
			header('Content-type: application/json');
			$json_file=file_get_contents('php://input');
			$jsonvalue= json_decode($json_file,true); 
			$user_id     = $jsonvalue['user_id']; 
			
		
			$condition['insititution_id']="0";
			
			$this->db->limit(10);
			$this->db->order_by('paid_status','DESC');
			$this->db->where($condition);
			$course_lists = $this->db->get('tbl_course')->result_array();
			
		 /* echo $this->db->last_query();
		exit;  */

			$courses=array();

			
			foreach($course_lists as $course_list)
			{
				$data['id']=$course_list['id'];
				$data['course_title']=$course_list['course_title'];
				$data['course_photo']="https://ceonpoint.com/assets/images/uploads/".$course_list['course_photo'];
				$data['price']=$course_list['price'];
				
				$data['by']=$this->db->get_where('tbl_user',array('id'=>$course_list['user_id']))->row_array()['name'];
				$data['rating']=$course_list['rating'];
				$data['total_revew']=$this->db->get_where('tbl_course_review',array('course_id'=>$course_list['id']))->num_rows();
				$courses[]=$data;
			}
			

			if(count($course_lists)>0)
			{
				$result['courses']=$courses;
				$result['category']=$category;
				$result['success']='true';
				$result['currency']="$";
				$result['current_cat']=$cat_id;
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

	public function archive_list()
	{
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		$user_id     = $jsonvalue['user_id']; 
		
		
		if(!isset($_REQUEST['ex_added_on']) && $_REQUEST['ex_added_on']=="")
		{

		$result['previous_certificate1'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$user_id,'archive'=>2),'');

		$result['specific1'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'specific','archive'=>2),'');

		$result['general1'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'general','archive'=>2),'');
		}
		else
		{	
			$date = explode('/', $_REQUEST['ex_added_on']);
			$to_date = $date[0];
			$from_date = $date[1]; 

			$this->db->where('added_on >=', $to_date);
			$this->db->where('added_on <=', $from_date);
			$this->db->order_by('id','DESC');
			$result['previous_certificate1'] = $this->db->get_where('tbl_existing_certificate',array('user_id'=>$user_id,'archive'=>2))
			->result_array();
			
			$this->db->where('added_on >=', $to_date);
			$this->db->where('added_on <=', $from_date);
			$this->db->order_by('id','DESC');
			$result['specific1'] = $this->db->get_where('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'specific','archive'=>2))
			->result_array();

			$this->db->where('added_on >=', $to_date);
			$this->db->where('added_on <=', $from_date);
			$this->db->order_by('id','DESC');
			$result['general1'] = $this->db->get_where('tbl_existing_certificate',array('user_id'=>$user_id,'category'=>'general','archive'=>2))
			->result_array();
		}	
		$result['currentplanArr'] = $this->professional_model->checkactiveplan($user_id);
		echo json_encode($result);
	}

	public function terms()
	{
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		// $user_id     = $jsonvalue['user_id']; 
		$result['terms']	= $this->dashboards_model->get_terms('professional');
		echo json_encode($result);
	}	

	public function course_history()
	{ 
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true); 
		$user_id     = $jsonvalue['user_id']; 

		$this->db->select('	e.added_on added_on,
							co.id cid,
							co.price amount,
							co.course_title course_name,
							co.passing_marks,
							e.certificate_id certificate_id,
							e.data,
							e.percentages,
							co.units units');
		$this->db->from('tbl_exam e');
		$this->db->join('tbl_course co','co.id = e.course_id');
		$this->db->where('e.user_id',$user_id);
		// $this->db->where('e.archive','1');
		$this->db->group_by('e.certificate_id');
		$this->db->order_by('e.id','desc');
		$result['purchase_list'] = $this->db->get()->result_array();

		$this->db->select('	tb.added_on added_on,
							tb.training_seminar_id tid,
							tb.amount amount,
							t.title course_name,
							tb.certificate_id certificate_id,
							t.units units');
		$this->db->from('tbl_training_book tb');
		$this->db->join('tbl_training t','t.id = tb.training_seminar_id');
		$this->db->where('tb.user_id',$user_id);
		$this->db->group_by('tb.certificate_id');
		$this->db->order_by('tb.id','desc');
		$result['training_list'] = $this->db->get()->result_array();
		
		echo json_encode($result);
	}
	
	public function contact_us()
	{
		header('Content-type: application/json');
		$json_file  = file_get_contents('php://input');
		$jsonvalue  = json_decode($json_file,true); 
		// $jsonvalue  = $_POST;
		$etype     	= $jsonvalue['type']; 
		$email  	= $jsonvalue['email']; 
		$first_name = $jsonvalue['first_name']; 
		$subject    = $jsonvalue['subject']; 
		$message    = $jsonvalue['message']; 
		
		$enquirydata = array(
				'first_name' 	=> $first_name,
				'email' 		=> $email,
				'subject' 		=> $subject,
				'message' 		=> $message,
				'etype' 		=> $etype,
			);	
			
		    $res = $this->user->save('tbl_enquiry',$enquirydata); 
		    if($res > 0){
		    	$result['success']='true';
				$result['msg']= 'Thank you for your message.';
		    }else{
		    	$result['success']='false';
				$result['msg']= 'There is some error please try again';
		    }
		echo json_encode($result);
	}

	public function settings()
	{
		header('Content-type: application/json');
		$json_file  	= file_get_contents('php://input');
		$jsonvalue  	= json_decode($json_file,true); 
		$provider_id  	= $jsonvalue['provider_id']; 
		$provider_code  = $jsonvalue['provider_code']; 
		$staff_code  	= $jsonvalue['staff_code'];  
		$uid  			= $jsonvalue['uid'];  
		$uemail  		= $jsonvalue['uemail'];  

		$uprovider_id = $this->db->get_where('tbl_user',array('id'=>$provider_id))->row_array()['under_provider'];

		$fetchpro = $this->db->get_where('tbl_user',array('id'=>$provider_id))->row_array()['insititution_id'];
		
		$fetchstaff_code = $this->db
		->get_where('tbl_institution_staff',array('email'=>$uemail,'insititution_id'=>$provider_id))
		->row_array()['staff_code'];
		
		if(!empty($provider_id)){
			if($provider_code == $fetchpro){
				$update['under_provider']   = $provider_code;
				if(!empty($staff_code)){
					if($staff_code == $fetchstaff_code){
						$status['status'] = '1';
						$status['prof_id'] = $uid; 
						$insStaff = $this->user->update('tbl_institution_staff',$status,'email',$uemail);
						$userResult = $this->user->update('tbl_user',$update,'id',$uid);
						if($insStaff==true && $userResult==true){
							$result['success']= true;
							$result['msg']= 'Settings successfully updated.';
						}else{
							$result['success']= false;
							$result['msg']= 'Something went wrong, Please try again!';
						}
					}else{
						$result['success']= false;
						$result['msg']= 'Wrong CE Staff Code! ';
					}
				}
			}else{
				$result['success']= false;
				$result['msg']= 'Wrong Provider Code! ';
			}
		}
		
		echo json_encode($result);
	}
	
	public function settings_view() {
	    header('Content-type: application/json');
		$json_file  	= file_get_contents('php://input');
		$jsonvalue  	= json_decode($json_file,true);  
		$uid  			= $jsonvalue['uid'];
		
		$insStaffRow = $this->db->select('staff_code, insititution_id, insititution_code,activated')->get_where('tbl_institution_staff',array('prof_id'=>$uid))->row_array();
		
		$provideArray = $this->db->select('id ,name, insititution_id')->get_where('tbl_user',array("role"=>2, "under_insititution"=>1))->result_array();
		$result['provider'] = $provideArray;
		if($insStaffRow) {
		    $result['data'] = $insStaffRow;
		    $result['success'] = true;

		    if($insStaffRow['activated']==1){
		    	$result['data']['staf_paid'] = true;
		    }else{
		    	$result['data']['staf_paid'] = false;
		    }
		} else {
		    $result['success'] = false;
		}
		
		echo json_encode($result);
	}
	
	public function provider_list() {
    	header('Content-type: application/json');
    	$json_file=file_get_contents('php://input');
    	$jsonvalue= json_decode($json_file,true); 
    	// $user_id     = $jsonvalue['user_id'];
    	$result['institutions'] = $this->db->select('id ,name, insititution_id')->get_where('tbl_user',array("role"=>5))->result_array();
        $result['provider'] = $this->db->select('id ,name, insititution_id')->get_where('tbl_user',array("role"=>2, "under_insititution"=>1))->result_array();
        echo json_encode($result);
    }

    public function course_evaluation_question()
	{
		header('Content-type: application/json');
		$json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true); 
		
		$user_id   = $jsonvalue['user_id'];
		$course_id = $jsonvalue['course_id'];
		$evaluation = $this->provider_model->get_result_array('tbl_evaluation',array('course_id'=>$course_id));
		$checkReview = $this->provider_model->get_row_array('tbl_course_review',array('course_id'=>$course_id,'user_id'=>$user_id));
		if(empty($checkReview)){
			if($evaluation){
				$result['success'] 	= true;
				$result['data'] 	= $evaluation;

			}else{
				$result['success'] 	= false;
			}
		}else{
				$result['msg'] 	= 'You have already submitted course evaluation!';
				$result['success'] 	= false;
		}
        echo json_encode($result);
	}

	public function course_evaluation()
	{
		header('Content-type: application/json');
		$json_file =file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true); 
		
		$evaluation  = $jsonvalue['evaluation'];
		$user_id     = $evaluation[0]['user_id'];
		$course_id   = $evaluation[0]['course_id'];
		
		$purchase = $this->db->get_where('tbl_purchase_llis',array('user_id'=>$user_id ,'item_name'=>$course_id))->num_rows();
		
		if($purchase>0){
			$result['purchase']=1;
		}else{
			$result['purchase']=0;
		}
		
		$pre_attempt = $this->provider_model->get_result_array('tbl_exam',array('user_id'=>$user_id ,'course_id'=>$course_id));
		
		if(count($pre_attempt[0])>0){
			$result['pre_attempt']='1';
		}else{
			$result['pre_attempt']='0';
		}

		$course_lists = $this->provider_model->get_row_array('tbl_course',array('id'=>$course_id));	
		if($pre_attempt[0]['percentages'] >= $course_lists['passing_marks']){
			$result['pre_exam_res']='1';
		}else{
			$result['pre_exam_res']='0';
		}

		foreach($evaluation as $key => $value){
		   $item=array();
		   $item['course_id']   = $course_id;
		   $item['user_id']     = $user_id;
		   $item['question_id'] = $value['question_id'];
		if($value['evaluation_type']==1){
		   $item['star_mark']   = $value["ratting"];
		}else{
		   $item['comments']    = $value['comments'];
		   }
		$res = $this->user->save('tbl_course_review',$item);
		}
		
		if($res){
			$result['currency']	= "$";
			$result['success']	= true;
			$result['error']	= false;
			$result['msg']		= 'Data Save'; 
		}else{
			$result['success']	= false;
			$result['error']	= true;
			$result['msg']		= 'Data Not Save';
		}
			echo json_encode($result);
	}
	
	public function planpurchase()
    {	
    	//echo'Plan Purchase';die;
 		header('Content-type: application/json');
		$json_file  	= file_get_contents('php://input');
		$jsonvalue  	= json_decode($json_file,true);
		// print_r($jsonvalue);die;
		$email  				= $jsonvalue['email'];
		$user_id  				= $jsonvalue['user_id'];
		$item_number  			= $jsonvalue['plan_id'];
		$item_name  			= $jsonvalue['plan_name'];
		$payment_date  			= $jsonvalue['payment_date'];
		$payment_transtion_id 	= $jsonvalue['txn_id'];
		$payment_amount  		= $jsonvalue['payment_amount'];

		if($_REQUEST){
			$existingplandetails = $this->user->getusetdetails('professional_pce_plan','user_id',$user_id);
			$userexpiryDate = $existingplandetails->plan_expiry_at;
			if($item_number == 1){
				$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +1 month");
			}
			if($item_number == 2){ 
				$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +6 month");
			}
			if($item_number == 3){
				$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +12 month");
			}
			if($item_number == 4){
				$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +36 month");
			}
			
			$requestupdate = array(
				'user_id' 				=> $user_id,
				'payment_transtion_id' 	=> $payment_transtion_id,
				'payment_amount' 		=> $payment_amount,
				'pce_plan_name' 		=> $item_name,
				'pce_plan_id' 			=> $item_number,
				'payment_date' 			=> $payment_date,
				'verify_sign' 			=> $verify_sign,
				'payment_at' 			=> date('Y-m-d H:i:s'),
				'plan_active_date' 		=> date('Y-m-d'),
				'plan_expiry_date' 		=> date('Y-m-d',$expirydate)
			);
			$result = $this->user->save('professional_pce_plan_payment_history',$requestupdate);
			$lastpaymentid = $this->db->insert_id();
			if($result){
				
				$upateplan = array(
				'version_type' 			=> '2',
				'plan_duration' 		=> $item_name,
				'payment_status' 		=> 'y',
				'plan_active_at' 		=> date('Y-m-d'),
				'plan_expiry_at' 		=> date('Y-m-d',$expirydate),
				'payment_recieved_id' 	=> $lastpaymentid,
				'payment_recieved_at' 	=> date('Y-m-d')
				);
				$this->user->update('professional_pce_plan',$upateplan,'user_id',$user_id);
				
			}
			$subject = "PCE-MC Plan purchased.";
			$message .= "<br/><br/> Thank you, <br/><br/> Team CEonpoint";

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('mails@ceonpoint.com');
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->set_mailtype("html");	
			if($this->email->send())
			{ 
				$success['mail']	=	true;
			}
			else
			{
				$success['mail']	=	false;
			}

		if($result > 0 ){
			$success['success']	=	true;
			$success['msg']		=	'PCE-MS Plan purchased. Thankyou...!'; 
		}else{
			$success['success']	=	false;
			$success['msg']		=	'Something went wrong, Please try again!';
			
		}
		echo json_encode($success);	
      }	
    }	
    
    public function planpurchase1() {	
        header('Content-type: application/json');
		$json_file  	= file_get_contents('php://input');
		$jsonvalue  	= json_decode($json_file,true);
		
		$user_id  			= $jsonvalue['user_id'];
		$requestupdate['payment_transtion_id'] = $user_id;
		$result = $this->user->save('professional_pce_plan_payment_history',$requestupdate);
		echo json_encode($result);
    }
    
    public function coursepurchase() {	
        header('Content-type: application/json');
		$json_file  	= file_get_contents('php://input');
		$jsonvalue  	= json_decode($json_file,true);
		
		$email  				= $jsonvalue['email'];
		$user_id  				= $jsonvalue['user_id'];
		$course_id  			= $jsonvalue['course_id'];
		$course_name  			= $jsonvalue['course_name'];
		$tax  					= $jsonvalue['tax'];
		$amount  				= $jsonvalue['amount'];
		$payment_date  			= $jsonvalue['payment_date'];
		$payment_transtion_id 	= $jsonvalue['txn_id'];
		$add = array(
			'user_id'			=> $user_id,
			'item_name'			=> $course_id,
			'quantity'			=> 1,
			'tax'				=> $tax,
			'amount'			=> $amount,
			'txn_id'			=> $payment_transtion_id,
			'paypal_payment_date'=> $payment_date,
			'status'			=> 1,
			'added_on'			=> date('y-m-d h:i:s'),
			'payment_at'		=> date('y-m-d h:i:s'),
			'transaction_details'=> json_encode($jsonvalue)
		);
		$res = $this->user->save('tbl_purchase_llis',$add);
        // echo $this->db->last_query(); die;
		if($res){
		$subject = "Online Course - ".$course_name;
		$message .= "<br/><br/>Thankyou for Purchasing ".$course_name." online course., <br/><br/> Team CEonpoint";

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('mails@ceonpoint.com');
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->set_mailtype("html");	
			if($this->email->send())
			{ 
				$success['mail']	=	true;
			}else{
				$success['mail']	=	false;
			}
		}	
		if($res > 0 ){
			$success['success']	=	true;
			$success['msg']		=	'Course purchased!'; 
		}else{
			$success['success']	=	false;
			$success['msg']		=	'Something went wrong, Please try again!';
			
		}
		echo json_encode($success);
    }

     public function trainingpurchase() {	
        header('Content-type: application/json');
		$json_file  	= file_get_contents('php://input');
		$jsonvalue  	= json_decode($json_file,true);
		
		$email  				= $jsonvalue['email'];
		$name  					= $jsonvalue['name'];
		$user_id  				= $jsonvalue['user_id'];
		$training_id  			= $jsonvalue['training_id'];
		$training_name  		= $jsonvalue['training_name'];
		$tax  					= $jsonvalue['tax'];
		$amount  				= $jsonvalue['amount'];
		$payment_date  			= $jsonvalue['payment_date'];
		$payment_transtion_id 	= $jsonvalue['txn_id'];
		// print_r($jsonvalue);die;
		$data = array(
			'training_seminar_id' => $training_id,
			'user_id' 			  => $uid,
			'name' 				  => $name,
			'email' 			  => $email,
			'tax' 		  		  => $tax,
			'amount' 			  => $amount,
			'txn_id' 			  => $payment_transtion_id,
			'status' 			  => 1,
			'added_on' 			  => date('y-m-d h:i:s'),
			'transaction_details' => json_encode($jsonvalue)
		);
		$where = array('email'=>$email,'training_seminar_id'=>$training_id);
	    $exist  = $this->user->get_record_by_field_name_all_record11('tbl_training_book',$where);
	    if(!empty($exist)){
	    	$success['error'] = 'Email id is already registered with us.';
	    }else{
	    	$result = $this->user->save('tbl_training_book',$data);
	    }
	    if($result > 0 ){
		$subject = "Training - ".$training_name;
		$message .= "<br/><br/>Thankyou for Purchasing ".$training_name." training., <br/><br/> Team CEonpoint";

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('mails@ceonpoint.com');
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->set_mailtype("html");	
			if($this->email->send())
			{ 
				$success['mail']	=	true;
			}else{
				$success['mail']	=	false;
			}
		}
	    if($result > 0 ){
			$success['success']	=	true;
			$success['msg']		=	'Training Booked'; 
		}else{
			$success['success']	=	false;
			$success['msg']		=	'Something went wrong, Please try again!';
		}
			
	    echo json_encode($success);
	}

    public function subscription_history() {	
        header('Content-type: application/json');
		$json_file  	= file_get_contents('php://input');
		$jsonvalue  	= json_decode($json_file,true);
		$user_id  		= $jsonvalue['user_id'];
		$data['currentplanArr'] = $this->professional_model->checkactiveplan($user_id);
		$data['planpaymenthistoryArr'] = $this->professional_model->planpaymenthistory($user_id,$data['currentplanArr']->payment_recieved_id);
		if($data['currentplanArr'] > 0 ){
			$success['data']	=	$data; 
			$success['success']	=	true;
		}else{
			$success['success']	=	false;
			$success['msg']		=	'Please check User ID, this user haven\'t purchase any plan!';
		}
		echo json_encode($success);
    }

}
