<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {
	public function  __construct(){
		parent::__construct();
		$this->load->model('Certificate_model','certificate_model'); 
		$this->load->model('Users_model','users_model');
		header('Access-Control-Allow-Origin: *');
	}
  
	public function training_list() {	
		header('Content-type: application/json');
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);

		// Filter training by
		$training_title = $jsonvalue['training_title'];
		$cat 			= $jsonvalue['category_id'];		
		$month 	        = $jsonvalue['month'];
		$year       	= $jsonvalue['year'];
		$location 		= $jsonvalue['location_name'];
		$country_id 	= $jsonvalue['country_id'];	

		$this->db->select('*,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", image) AS image,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", venue_photo) AS photo,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", background_image) AS background_image,'
		, FALSE);
		$this->db->from('tbl_training');
		// $this->db->where('end_date >=', date('Y-m-d')); 
		$this->db->where('insititution_id','0');
		$this->db->where('status',2);

		if($training_title != ""){ $this->db->like('tbl_training.title',$training_title); }
		if($cat!=""){ $this->db->where('tbl_training.category_id',$cat); }
		if($month != "" && $year != ""){
		    $this->db->where('YEAR(tbl_training.start_date) =',$year);
            $this->db->where('MONTH(tbl_training.start_date) =',$month);  
		}
		if($location != ""){ $this->db->like('tbl_training.location',$location); }
		if($country_id!=""){ $this->db->where('tbl_training.country_id',$country_id); }
		$this->db->order_by('id','Desc');
		$data['training'] = $this->db->get()->result_array();
	    
        $cwhere = array('status'=>1);
		$this->db->select("countries_id,countries_name");
	    $data['country'] = $this->user->get_record_by_multi_field_name('countries',$cwhere);
	    $data['profession']  = $this->db->select('id ,cat_name')->order_by('cat_name', 'ASC')->get_where('tbl_category',array("status"=>1))->result_array();
		
		if(!empty($data['training']))
		{
			$result['success']	= true;
			$result['error']	= 0;
			$result['data']		= $data; 
			$result['msg']		= 'Record found !'; 
		}else{
			$result['success']	= false;
			$result['error']	= 1;
			$result['msg']		= 'No Record Found!';
		}
		echo json_encode($result);
	}

	public function institution_training_list()
	{
		header('Content-type: application/json');
		$json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true);
		$user_id   = $jsonvalue['user_id'];		
		$ins_id    = $jsonvalue['insititution_id'];	//provider under insititution_id

		// Filter ins_training by
		$training_title = $jsonvalue['training_title'];
		$cat 			= $jsonvalue['category_id'];		
		$month 	        = $jsonvalue['month'];
		$year       	= $jsonvalue['year'];
		$location 		= $jsonvalue['location_name'];
		$country_id 	= $jsonvalue['country_id'];

		$user = $this->db->get_where('tbl_user',array('id'=>$user_id))->row_array(); //user under provider
		$this->db->select('*');
		$this->db->from('tbl_institution_staff');
		$this->db->where('prof_id',$user_id);
		$this->db->where('insititution_code',$user['under_provider']);
		$user_uins = $this->db->get()->row_array();
		// echo $this->db->last_query();
		$this->db->select('*,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", image) AS image,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", venue_photo) AS photo,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", background_image) AS background_image,'
		, FALSE);
		$this->db->from('tbl_training');
		// $this->db->where('end_date >=', date('Y-m-d'));
		$this->db->where('insititution_id',$ins_id);

		if($training_title != ""){ $this->db->like('tbl_training.title',$training_title); }
		if($cat != ""){ $this->db->where('tbl_training.category_id',$cat); }
		if($month != "" && $year != ""){
		    $this->db->where('YEAR(tbl_training.start_date) =',$year);
            $this->db->where('MONTH(tbl_training.start_date) =',$month);  
		}
		if($location != ""){ $this->db->like('tbl_training.location',$location); }
		if($country_id != ""){ $this->db->where('tbl_training.country_id',$country_id); }

		$this->db->order_by('id','Desc');
		$data['training'] = $this->db->get()->result_array();
		$data['profession']  = $this->db->select('id ,cat_name')->order_by('cat_name', 'ASC')->get_where('tbl_category',array("status"=>1))->result_array();
		$data['country'] = $this->user->get_record_by_multi_field_name('countries',array('status'=>1));

		if($data['training'] > 0){
			$result['success']	= true;
			$result['data']		= $data; 
			$result['msg']		= 'Record found.'; 
			
			if($user['insititution_id'] == $ins_id && $user_uins['activated'] == "1"){
				$result['paid']		= true;
			}else{
				$result['paid']		= false;
			} 
		}else{
			$result['success']	= false; 
			$result['msg']		= 'No Record found!!';
		}
		
		echo json_encode($result);
	}


	public function check_training_book(){
	
		header('Content-type: application/json');
		$json_file		= file_get_contents('php://input');
		$jsonvalue		= json_decode($json_file,true);
		$email 			= $jsonvalue['email'];		
		$training_id 	= $jsonvalue['training_id'];
	    $exist  = $this->db->get_where('tbl_training_book',array('email'=>$email,'training_seminar_id'=>$training_id))->num_rows();
		 if($exist > 0){
		 	$result['success'] 	= false;
			$result['msg'] 		= 'Email id is already registered with us.';
		 }else{
		 	$result['success'] 	= true; 
			$result['msg']		= 'You can book the training.'; 
		 }	
		 echo json_encode($result);		
	}

	public function training_details()
	{	
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true);
		$id = $jsonvalue['id'];		
		
		$schedule = array();
		$scheduleUniqueDate     = $this->user->getschedule($id); 
		foreach ($scheduleUniqueDate as $key => $value) {
           $schedule[] = $this->user->getscheduleAll($id,$value['schedule_date']);
        }
        $data['schedule'] = $schedule ;	

		$data['provider'] = $this->db->select("name,id")->from('tbl_user')
		->where(array('status'=>1,'role'=>2))
		->or_where(array('parent_insititution'=>0,'parent_insititution'=>NULL))
		->get()->result_array(); 
		
	
		$cwhere = array('status'=>1);
		$this->db->select("countries_id,countries_name");
	    $data['country'] = $this->user->get_record_by_multi_field_name('countries',$cwhere);
		$this->db->select('*,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", image) AS image,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", venue_photo) AS photo,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", background_image) AS background_image,'
		, FALSE);
		
		$this->db->from('tbl_training');
		$this->db->where('id',$id);
		$data['training'] = $this->db->order_by('paid_status','desc')->get()->row_array();
		
		$providerDetailList = $this->db->get_where('tbl_user',array('id'=>$data['training']['user_id']))->row_array();
				
		$providerDetail['name'] = $providerDetailList['name'];
		$providerDetail['profession'] = $providerDetailList['profession'];
		$providerDetail['country'] = $providerDetailList['country'];
		$providerDetail['representative'] = $providerDetailList['representative'];
		$providerDetail['position'] = $providerDetailList['position'];
		$providerDetail['username_email'] = $providerDetailList['username_email'];
		$providerDetail['image'] = $providerDetailList['image'];
		
		$data['provider_details']=$providerDetail;
	

		$this->db->from('tbl_training_speaker');
		$this->db->where('training_id',$id);
		$data['speaker'] = $this->db->get()->result_array();

		
		if(!empty($data))
		{
			
			$result['success']='true';
			$result['error']="0";
			$result['data']=$data; 
			$result['msg']='Record found !'; 
		}
		else
		{
			$result['success']='false';
			$result['error']="1";
			$result['msg']='No Record Found!';

		} 
		
		echo json_encode($result);
	}
	
			
	public function book_training() {
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true);
		
		$data['training_seminar_id'] =  $jsonvalue['training_id'];
    	if($jsonvalue['user_id']){
    		$data['user_id']    = $jsonvalue['user_id'];
    	}
 		$data['name'] 			= $jsonvalue['name'];
 		$data['email'] 			= $jsonvalue['email'];
 		$data['phone'] 			= $jsonvalue['phone'];
 		$data['address'] 		= $jsonvalue['address'];

		$data['memberstatus'] 	= $jsonvalue['memberstatus'];
		$data['profession_id'] 	= $jsonvalue['profession_id'];

	if($jsonvalue['institution'] == 0){
		$data['institution'] 	= $jsonvalue['other_institution'];
	}else{
		$data['institution'] 	= $jsonvalue['institution'];
	}
		$data['position'] 	  	= $jsonvalue['position'];
		$data['island'] 	  	= $jsonvalue['island'];

 		$data['payment_mode'] 	= $jsonvalue['type'];
 		$data['amount']     	= $jsonvalue['price'];
 		$data['payment_status'] = 0; 
		$data['status']         = 1;
		$data['added_on']       = date('y-m-d h:i:s');

	
		$where = array('email'=>$jsonvalue['email'],'training_seminar_id'=>$jsonvalue['training_id']);

	    $exist  = $this->user->get_record_by_field_name_all_record11('tbl_training_book',$where);

		if(empty($exist)){
			$results = $this->user->save('tbl_training_book',$data);
			
			if($results)
			{
				
				$resultMP['success']=true;
				$resultMP['results']=$results;
				$resultMP['error']=0;
				$resultMP['msg']='Seminar booked successfully. Details has been sent on email.';
			
			} 
			else 
			{
				$resultMP['success']=false;
				$resultMP['error']=1;
				$resultMP['results']=$results;
				$resultMP['msg']='There is some error please try again.';
			
			}
			echo json_encode($resultMP);
		}else
			{
			$resultMP['success']='false';
			$resultMP['error']="1";
			$resultMP['msg']='Already booked and details has been sent on your mail!';
			echo json_encode($resultMP);
			exit();
			}
		
		if($jsonvalue['type']=="Online") { ?>

	<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
	    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
	    <input type="hidden" name="cmd" value="_xclick">
	    <input type="hidden" name="item_name" id="item_name" value="<?php echo $results;?>">
	    <input type="hidden" name="item_number" value="1">
	    <input type="hidden" name="credits" value="510">
	    <input type="hidden" name="userid" value="1">
	    <input type="hidden" name="amount" id="amount" value="<?php echo $jsonvalue['price']; ?>">
	    <input type='hidden' name='rm' value='2'>
	    <input type="hidden" name="no_shipping" value="1">
	    <input type="hidden" name="currency_code" value="USD">
	    <input type="hidden" name="handling" value="0">
	    <input type="hidden" name="cancel_return" value="<?php echo site_url()?>/pages/cancel_training_book">
	    <input type="hidden" name="return" value="<?php echo site_url()?>/pages/success_training_book">
	</form>

	<script type="text/javascript">
		document.getElementById("frmPayPal1").submit();
	</script>

		<?php 
		 
		} 
		else
		{

			
		} 
	
	}
	
	
	public function success_training_book()
	{
		$this->db->where('id',$_REQUEST['item_name']);
		$this->db->update('tbl_training_book',array('payment_status'=>1));
		$result['success']='true';
		$result['error']="0";
		$result['msg']='Seminar booked successfully. Details has been sent on email.';
		echo json_encode($result);
	}


	public function cancel_training_book()
	{
		$result['success']='false';
		$result['error']="1";
		$result['msg']='Payment fails!';
		echo json_encode($result);
	}

	public function pro_training_details(){
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true);
		$tid = $jsonvalue['id'];

		$this->db->select('*, TIME_FORMAT("start_time", "%r") AS start_time, TIME_FORMAT("end_time", "%r") AS end_time,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", image) AS image,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", venue_photo) AS photo,
		CONCAT("https://ceonpoint.com/assets/images/uploads/", background_image) AS background_image,'
		, FALSE);
		$this->db->from('tbl_training');
		$this->db->where('id',$tid);
		$this->db->order_by('paid_status','desc');
		$query = $this->db->get();
		$details = $query->row_array();
		$data['details'] = $details;
		$this->db->select('tp.id id, tp.speaker_name speaker_name,tp.position position,tp.insititution insititution,
			CONCAT("https://ceonpoint.com/assets/images/uploads/", tp.speaker_image) AS speaker_image,
			tp.speaker_description description');
		$this->db->from('tbl_training_speaker tp');
		$this->db->where('training_id',$tid);
		$query1 = $this->db->get();
		$data['speaker_details'] = $query1->result_array();

		$schedule = array();
		$scheduleUniqueDate     = $this->user->getschedule($tid); 
		foreach ($scheduleUniqueDate as $key => $value) {
           $schedule[] = $this->user->getscheduleAll($tid,$value['schedule_date']);
        }
        $data['schedule'] = $schedule ;	
        $data['sponsors'] = $this->user->get_record_by_field_name_all_record('tbl_training_sponsors','training_id',$tid);
        $data['genral_info'] = array(
        	'title'			=> $details['title'],
        	'sub_title'		=> $details['sub_title'],
        	'units'			=> $details['units'],
        	'start_date'	=> $details['start_date'],
        	'end_date'		=> $details['end_date'],
        	'start_time'	=> $details['start_time'],
        	'end_time'		=> $details['end_time'],
        	'location'		=> $details['location'],
        	'participants'	=> $details['participants'],
        	'price'			=> $details['price'],
        	'contact_person'=> $details['contact_person'],
        	'email'			=> $details['email'],
        	'phone'			=> $details['phone']
        );
        $data['overview'] = array(
        	'objectives'	=> $details['objectives'],
        	'methodologies'	=> $details['methodologies'],
        	'item_to_bring'	=> $details['item_to_bring'],
        	'description'	=> $details['description']
        );
        $data['lesson'] = array();

		$this->db->from('tbl_training_evaluation');
		$this->db->where('training_id',$tid);
		$query2 = $this->db->get();
		$data['evaluation_question'] = $query2->result_array();

		$this->db->select('tc.committee_name committee_name,tc.degination degination,
			CONCAT("https://ceonpoint.com/assets/images/uploads/", tc.committee_image) AS committee_image');
		$this->db->from('tbl_training_committee tc');
		$this->db->where('training_id',$tid);
		$query3 = $this->db->get();
		$data['committee'] = $query3->result_array();

		if($details!=''){
			$result['msg'] = 'success';
			$result['data'] = $data;
		}else{
			$result['msg'] = 'Wrong training id!';
		}

		echo json_encode($result);

	}

	public function training_speaker_details(){
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true);
		$id = $jsonvalue['id']; // tbl_training_speaker's id

		$this->db->select('tp.speaker_name speaker_name,tp.position position,tp.insititution insititution,
			CONCAT("https://ceonpoint.com/assets/images/uploads/", tp.speaker_image) AS speaker_image,
			tp.speaker_description description');
		$this->db->from('tbl_training_speaker tp');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$details = $query->row_array();
		if($details!=''){
			$result['msg'] = 'success';
			$result['data'] = $details;
		}else{
			$result['msg'] = 'Wrong training speaker id!';
		}

		echo json_encode($result);
	}

	
	public function speaker_powerpoint(){
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true);
		$tid = $jsonvalue['training_id'];
		$sid = $jsonvalue['speaker_id']; 

		// $this->db->select('CONCAT("https://ceonpoint.com/assets/images/uploads/", tsp.images) AS ppt_image');
		$this->db->select('tsp.images ppt_image');
		$this->db->from('tbl_speaker_powerpoint tsp');
		$this->db->where('training_id',$tid);
		$this->db->where('speaker_id',$sid);
		$query = $this->db->get();
		$details = $query->result_array();
		if($details!=''){
			$result['msg'] = 'success';
			$result['data'] = $details;
		}else{
			$result['msg'] = 'Please check training id and speaker id!';
		}
		echo json_encode($result);
	}

	public function training_evaluation(){
		header('Content-type: application/json');
		$json_file=file_get_contents('php://input');
		$jsonvalue= json_decode($json_file,true);
		$tid = $jsonvalue['training_id'];
		$sid = $jsonvalue['speaker_id']; 
		$uid = $jsonvalue['user_id']; 

		$training_speakers  = $this->db->get_where('tbl_training_speaker',array('training_id'=>$tid))->result_array();
		$evaluation_question = $this->db->get_where('tbl_training_evaluation',array('training_id'=>$tid))->result_array();
		$check_evaluation_exsits  = $this->db->get_where('tbl_training_review',array('user_id'=>$uid,'training_id'=>$tid,'speaker_id'=>$sid))->num_rows();
			if($check_evaluation_exsits>0){
				$user_evaluation = 1;	
			}else{
				$user_evaluation = 0;	
			}

		if($training_speakers!=''){
			$result['speakers'] = $training_speakers;
			$result['evaluation_question'] = $evaluation_question;
			$result['check_evaluation'] = $user_evaluation;
		}else{
			$result['msg'] = 'Please check training id!';
		}
		echo json_encode($result);
	}
	
	public function training_evaluation_submit(){
		header('Content-type: application/json');
		$json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true);
	// { "training_id": "2","speaker_id":"2","user_id":"2","question_data":
	//     [
	//         { "questionid":"2","question_ans":"5","gueastion_type":"1"},
	//         { "questionid":"3","question_ans":"good","gueastion_type":"2"}
	//     ]
	// } data coming like this.

		$user_id   		= $jsonvalue['user_id'];
        $training_id   	= $jsonvalue['training_id'];
        $speaker_id   	= $jsonvalue['speaker_id'];

		$save['user_id']   		= $user_id;
        $save['training_id']   	= $training_id;
        $save['speaker_id']   	= $speaker_id;
        $queationData   		= $jsonvalue['question_data'];
        $check_evaluation_exsits  = $this->db->get_where('tbl_training_review',array('user_id'=>$user_id,'training_id'=>$training_id,'speaker_id'=>$speaker_id))->row_array();
        // echo $this->db->last_query();
        // print_r($check_evaluation_exsits); die;

        if($check_evaluation_exsits==''){
        $count  = count($queationData);
			for($i=0;$i<$count;$i++){
				$qid   					= $queationData[$i]['questionid'];
				$save['question_id']   	= $qid;
				if($queationData[$i]['question_type'] == 1){
					$save['star_mark']  = $queationData[$i]['question_ans'];
				}else{
					$save['comments']   = $queationData[$i]['question_ans'];
				}
				$added = $this->user->save('tbl_training_review',$save);
				$save['comments'] 		= '';
				$save['star_mark']  	= 0;
			}
		}
		// print_r($queationData);
		// echo'nutan kumar';
		// echo $queationData[1]['questionid'];
		if($added){
			$result['msg'] = 'Thank You for your time to evaluate it';
			$result['alredy_submit'] = false;
			$result['status'] = true;
		}else{
			if($check_evaluation_exsits==''){
				$result['msg'] = 'Something went wrong please try again!';
				$result['alredy_submit'] = false;
				$result['status'] = false;
			}else{
				$result['msg'] = 'You have already submitted this evaluation.';
				$result['alredy_submit'] = true;
				$result['status'] = false;
			}
		}
		echo json_encode($result);
	}
		

}


