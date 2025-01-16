<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payu extends CI_Controller {
	public function  __construct(){
		parent::__construct();
		
		$this->load->model('provider_model');  
		$this->load->model('dashboards_model');  
		$this->load->model('Rboard_model','rboard');  
		$this->load->model('Users_model','users_model'); 
	}

	public function index()
	{
		//print_r($_REQUEST);exit;
		if($this->session->userdata('logged_in')['id'] == ''){
			redirect('users');
		}
		$this->load->view('payu/product_form');		
	}

	public function check()
	{ 
		//echo '<pre>'; print_r($this->input->post());die;
		$amount =  $this->input->post('payble_amount');
	    $product_info = substr($this->input->post('product_info'),0,100);
	    $customer_name = substr($this->input->post('customer_name'),0,20);
	    $customer_emial = $this->input->post('customer_email');
	    $customer_mobile = $this->input->post('mobile_number');
	    $customer_address = $this->input->post('customer_address');
	    $udf1 = $this->input->post('type');
		$udf2 = $this->input->post('user_id');
		$udf3 = $this->input->post('product_id');
		$udf4 = $this->input->post('payble_tax');
		$country = $this->input->post('country');
		if($country == 99){
			$udf5 = 'INR';
		}else{
			$udf5 = 'USD';
		}
		$udf6 = $this->input->post('country');
		if(isset($_POST['profession'])){
			$udf7 = $this->input->post('profession');
		}else if(isset($_POST['day'])){
			$udf7 = $this->input->post('day');
		}else if(isset($_POST['planid'])){
			$udf7 = $this->input->post('planid');
		}else{$udf7 = '';}
		//echo $udf6.'<br>'.$udf7;exit;
		//payumoney details
	    
		$MERCHANT_KEY = "rjQUPktU"; //change  merchant with yours
		$SALT = "e5iIg1jwi8";  //change salt with yours 

		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		//optional udf values 
		$udf1 = $udf1;
        $udf2 = $udf2;
        $udf3 = $udf3;
        $udf4 = $udf4;
        $udf5 = $udf5;
		$udf6 = $udf6;
		$udf7 = $udf7;

		$hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
		$hash = strtolower(hash('sha512', $hashstring));
			
		$success = base_url() . 'payu/successStatus';  
		$fail = base_url() . 'payu/failStatus';
		$cancel = base_url() . 'payu/cancelStatus';
		
		
		$data = array(
			'mkey' => $MERCHANT_KEY,
			'tid' => $txnid,
			'hash' => $hash,
			'amount' => $amount,           
			'name' => $customer_name,
			'productinfo' => $product_info,
			'mailid' => $customer_emial,
			'phoneno' => $customer_mobile,
			'address' => $customer_address,
			'action' => "https://test.payu.in", //for live change action  https://secure.payu.in
			'sucess' => $success,
			'failure' => $fail,
			'cancel' => $cancel,
			'udf1' => $udf1,
			'udf2' => $udf2,
			'udf3' => $udf3,
			'udf4' => $udf4,
			'udf5' => $udf5,
			'udf6' => $udf6, // for country
			'udf7' => $udf7 // for profession
		);
		//echo '<pre>'; print_r($data);exit;
		$this->load->view('payu/confirmation', $data);   
     
	}

	public function help()
	{
		$this->load->view('payu/help');
	}
	
	public function failStatus()
	{	$data = array(
			'txnid' 	=> $this->session->flashdata('pay_array')['txnid'],
			'status' 	=> $this->session->flashdata('pay_array')['status']
		);	
		$this->load->view('payu/failure', $data);
	}
	
	public function cancelStatus()
	{	
		$this->load->view('payu/cancel');
	}
	
	public function payment_success()
	{	
		$data = array(
			'insertID'  => $this->session->flashdata('pay_array')['insert_id'],
			'txnid' 	=> $this->session->flashdata('pay_array')['txnid'],
			'status' 	=> $this->session->flashdata('pay_array')['status'],
			'amount' 	=> $this->session->flashdata('pay_array')['amount']
		);
		$this->load->view('payu/success',$data);
	}

	public function successStatus()
	{
		//print_r ($this->session->all_userdata());
		//print_r($_POST);exit;
		/*if(isset($_SESSION['payment_type'])){
			$paytype = $_SESSION['payment_type'];
		}else{
			$paytype = 'n';
		} */
		$dataDB = array(
			'buyer_name' 		=> $_POST['firstname'].' '.$_POST['lastname'],
			'buyer_email' 		=> $_POST['email'], 
			'card_number' 		=> $_POST['cardnum'], 
			'product_type' 		=> $_POST['udf1'], 
			'user_id' 			=> $_POST['udf2'], 
			'product_name' 		=> $_POST['productinfo'], 
			'product_id' 		=> $_POST['udf3'], 
			'tax' 				=> $_POST['udf4'], 
			'currency' 			=> $_POST['udf5'], 
			'paid_amount' 		=> $_POST['amount'], 
			'txn_id' 			=> $_POST['txnid'], 
			'payment_status' 	=> $_POST['status'],
			//'payment_type'		=> $paytype,
			'token'				=> $_POST['payuMoneyId'],
			'added_on' 			=> date('Y-m-d H:i:s'),
			'transaction_details' => json_encode($_POST)
		);
		$type = $_POST['udf1'];
		
		$insert_id = $this->user->save('tbl_payment_transaction',$dataDB);
		
		// insert data into payment_log Table in database
		$paylog = array(
			'user_id' 			=> $_POST['udf2'],
			'product_name' 		=> $_POST['productinfo'],
			'product_id' 		=> $_POST['udf3'],
			'product_type' 		=> $_POST['udf1'],
			'buyer_name' 		=> $_POST['firstname'].' '.$_POST['lastname'],
			'buyer_email' 		=> $_POST['email'],
			'txn_id' 			=> $_POST['txnid'], 
			'card_number' 		=> $_POST['cardnum'], 
			//'card_exp_month' 	=> $card_exp_month, 
			//'card_exp_year' 	=> $card_exp_year, 
			'tax' 				=> $_POST['udf4'],
			'paid_amount' 		=> $_POST['amount'],
			'currency' 			=> $_POST['udf5'], 
			'payment_status' 	=> $_POST['status'],
			'payment_by'		=> 'payu',
			'added_on' 			=> date('Y-m-d H:i:s'),
		);
		$inserted = $this->user->save('payment_log', $paylog);
		//echo $inserted;exit;
		$redirectdata = array(
			'insertID'  => $insert_id,
			'txnid' 	=> $_POST['txnid'],
			'status' 	=> $_POST['status'],
			'amount' 	=> $_POST['amount'],
			'user_id' 	=> $_POST['udf2']
		);
		$this->session->set_flashdata('pay_array', $redirectdata);
		// unset user
		$this->session->unset_userdata('LOGGED_USER');
		$uid = $this->session->flashdata('pay_array')['user_id'];
		$row = $this->user->get_user_record('tbl_user','id',$uid);
		if($type != "RBoard Subscription"){
			$sess_array = array(
				'id' 		=> $row->id,
				'username' 	=> $row->username_email,
				'name' 		=> $row->name,  
				'role' 		=> $row->role,  
				'profession'=> $row->profession,  
				'location' 	=> $row->location,  
				'address' 	=> $row->address,
				'country' 	=> $row->country,
				'insititution_id' 	=> $row->insititution_id,
				'under_insititution'=> $row->under_insititution,
				'logged_in' => $row->logged_in
				);

			$this->session->set_userdata('logged_in', $sess_array);
		}
		if ($insert_id > 0) {

			switch ($type) {
			  case "course":
				$addcourse = array(
					'user_id'			=> $_POST['udf2'],
					'payer_email'		=> $_POST['email'],
					'txn_id'			=> $_POST['txnid'],
					'item_name'			=> $_POST['udf3'],
					'quantity'			=> 1,
					'tax'				=> $_POST['udf4'],
					'payment_fee'		=> $_POST['amount'],
					'txn_status'		=> $_POST['status'],
					// 'payment_type'		=> $type,
					'status'			=> 1,
					'added_on'			=> date('y-m-d h:i:s'),
					'payment_at'		=> date('Y-m-d H:i:s'),
					'amount'			=> $_POST['amount'],
					'transaction_details'=> json_encode($_POST)
				);
				$result = $this->user->save('tbl_purchase_llis',$addcourse);
				break;

			  case "training":
				$addtrainig = array(
					'user_id'			=> $_POST['udf2'],
					'training_seminar_id' => $_POST['udf3'],
					'payment_status' 	=> 1,
					'payment_mode' 		=> 'Online',
					'txn_id'			=> $_POST['txnid'],
					'tax'				=> $_POST['udf4'],
					'amount'			=> $_POST['amount'],
					'name' 				=> $_POST['firstname'].' '.$_POST['lastname'],
					'email' 			=> $_POST['email'],
					'country'			=> $_POST['country'],
					'profession_id'		=> $_POST['zipcode'],
					'quantity'			=> 1,
					'status'			=> 1,
					'added_on'			=> date('Y-m-d'),
					'transaction_details'=> json_encode($_POST)
				);
				//print_r($addtrainig);exit;
				$result = $this->user->save('tbl_training_book',$addtrainig);
				break;

			  case "training publish":
				$base_price = $_POST['amount'] - $_POST['udf4'];
				$addtrainigpublish = array(
					'user_id'			=> $_POST['udf2'],
					'training_id' 		=> $_POST['udf3'],
					'training_types' 	=> 1,
					'tax'				=> $_POST['udf4'],
					'base_price'		=> $base_price,
					'amount'			=> $_POST['amount'],
					'txn_id'			=> $_POST['txnid'],
					'txn_status'		=> $_POST['status'],
					'status'			=> 1,
					'txn_type'			=> 'cart',
					'transaction_details'=> json_encode($_POST),
					'added_on'			=> date('Y-m-d')
					
				);
				//print_r($addtrainigpublish);exit;
				$lastId = $this->user->save('tbl_training_published',$addtrainigpublish);
				//echo $result;exit;
				$trainingDetails = $this->db->get_where('tbl_training_published',array('id'=>$lastId))->row_array(); 
				$tid = $trainingDetails['training_id'];

				$data1['status'] = 2;
				$this->user->update('tbl_training',$data1,'id',$tid);
				break;

			  case "PCE-MS":
				
				$existingplandetails = $this->user->getusetdetails('professional_pce_plan','user_id',$post['user_id']);
				$userexpiryDate = $existingplandetails->plan_expiry_at;
				$propla_id = $_POST['zipcode'];// zipcode is planid
				$plan_details = $this->share->get_pcemsplan_details($propla_id);
				$planid = $plan_details->plan_id;
				$duration = $plan_details->pro_plan_type;
				$expirydate = date('Y-m-d', strtotime("+".$duration." months", strtotime($userexpiryDate)));
				$base_price = $_POST['amount'] - $_POST['udf4'];
					$requestupdate = array(
						'user_id' 				=> $_POST['udf2'],
						'tax' 					=> $_POST['udf4'],
						'base_price' 			=> $base_price,
						'payment_amount' 		=> $_POST['amount'],
						'pce_plan_name' 		=> $_POST['productinfo'],
						'pce_plan_id' 			=> $planid,
						'payment_at' 			=> date("Y-m-d H:i:s"),
						'plan_active_date' 		=> date("Y-m-d"),
						'plan_expiry_date' 		=> date("Y-m-d",strtotime($expirydate)),
					);
				//print_r($_POST);exit;
				$itemnumber = $this->user->save('professional_pce_plan_payment_history',$requestupdate);
				$uemail = $this->db->get_where('tbl_user',array('id'=>$_POST['udf2']))->row_array()['username'];
				if($itemnumber){
					$requestupdate = array(
						'payer_email' 			=> $_POST['email'],
						'payer_id' 				=> $_POST['udf2'],
						//'payer_status' 			=> ,
						'first_name' 			=> $_POST['firstname'],
						'last_name' 			=> $_POST['lastname'],
						'payment_transtion_id' 	=> $_POST['txnid'],
						//'mc_gross' 				=> $_REQUEST['mc_gross'],
						'payment_status' 		=> $_POST['status'],
						'payment_date' 			=> date('Y-m-d'),
						//'verify_sign' 			=> $_REQUEST['verify_sign'],
					);
					// $result = $this->user->save('professional_pce_plan_payment_history',$requestupdate);
					$result = $this->user->update('professional_pce_plan_payment_history',$requestupdate,'pppph_id',$itemnumber);
					$pcehistory = $this->db->get_where('professional_pce_plan_payment_history',array('pppph_id'=>$itemnumber))->row();
					if($result){
						$upateplan = array(
						'version_type' 			=> $pcehistory->pce_plan_id,
						'plan_duration' 		=> $pcehistory->pce_plan_name,
						'payment_status' 		=> 'y',
						'plan_active_at' 		=> date('Y-m-d'),
						'plan_expiry_at' 		=> $pcehistory->plan_expiry_date,
						'payment_recieved_id' 	=> $itemnumber,
						'payment_recieved_at' 	=> date('Y-m-d')
						);
						$this->user->update('professional_pce_plan',$upateplan,'user_id',$_REQUEST['custom']);
					}
				}
				/*$existingplandetails = $this->user->getusetdetails('professional_pce_plan','user_id',$user_id);
				$userexpiryDate = $existingplandetails->plan_expiry_at;
				$itemTaxBase = explode('_', $_REQUEST['item_number']);
				$planPcems = explode('*', $_REQUEST['item_name']);
				if($itemNumber == 1){
					$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +1 month");
				}
				if($itemNumber == 2){ 
					$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +6 month");
				}
				if($itemNumber == 3){
					$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +12 month");
				}
				if($itemNumber == 4){
					$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +36 month");
				}
				$requestupdate = array(
					'user_id' 				=> $user_id,
					'payer_email' 			=> $buyeremail,
				// 'payer_id' 				=> $_REQUEST['payer_id'],
				// 'payer_status' 			=> $_REQUEST['payer_status'],
					'first_name' 			=> $buyername,
				// 'last_name' 			=> $_REQUEST['last_name'],
					'payment_transtion_id' 	=> $balance_transaction,
					'mc_gross' 				=> $amount,
					'tax' 					=> $_POST['tax'],
					'base_price' 			=> $_POST['base_price'],
					'payment_amount' 		=> $amount,
					'payment_status' 		=> $status,
				// 'pending_reason' 		=> $_REQUEST['pending_reason'],
					'pce_plan_name' 		=> $itemName,
					'pce_plan_id' 			=> $itemNumber,
					'payment_date' 			=> $date,
				// 'verify_sign' 			=> $_REQUEST['verify_sign'],
					'payment_at' 			=> date("Y-m-d H:i:s"),
					'plan_active_date' 		=> date("Y-m-d"),
					'plan_expiry_date' 		=> date("Y-m-d",$expirydate),
				);
				$resultPCE = $this->user->save('professional_pce_plan_payment_history',$requestupdate);
				// echo $this->db->last_query(); echo $result; die;
				$lastpaymentid = $this->db->insert_id();
				if($resultPCE){
					$upateplan = array(
						'version_type' 			=> '2',
						'plan_duration' 		=> $itemName,
						'payment_status' 		=> 'y',
						'plan_active_at' 		=> date('Y-m-d'),
						'plan_expiry_at' 		=> date('Y-m-d',$expirydate),
						'payment_recieved_id' 	=> $lastpaymentid,
						'payment_recieved_at' 	=> date('Y-m-d')
					);
				$this->user->update('professional_pce_plan',$upateplan,'user_id',$user_id);
				}*/
				break;  

			  case "Promotion": //cep promotion
				$base_price = $_POST['amount'] - $_POST['udf4'];
				$day = $_POST['zipcode'];
				$promotedData = array(
					'user_id' 			=> $_POST['udf2'],
					'role' 				=> $_POST['udf3'],
					'promoted_date' 	=> date('Y-m-d'),
					'promoted_day' 		=> $day,
					'tax' 			    => $_POST['udf4'],
					'base_price' 		=> $base_price,
					'promoted_amount' 	=> $_POST['amount'],
					'txn_id' 			=> $_POST['txnid'],
					'transaction_details'=> json_encode($_POST),
				);
				//print_r($promotedData); exit;
				$promotresult = $this->user->save('tbl_promoted_provider_transaction',$promotedData);
				$featuredData['featured_from'] = date('Y-m-d');
				$featuredData['featured_to'] = date('Y-m-d', strtotime(date('Y-m-d') . '+ '.$day.'days'));
				$result = $this->user->update('tbl_user',$featuredData,'id',$_POST['udf2']);
				if($result > 0 && $promotresult > 0){
					$this->session->set_flashdata('response', '<h4>Your company is now listed as fetured at the CE Provider\'s Page.</ch4>');
					redirect('provider/active_promotion?id=done');
				} else {
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
					redirect('provider/dashboard');
				}
				break;  
			  case "Professional Promotion": //cep promotion
					$base_price = $_POST['amount'] - $_POST['udf4'];
					$day = $_POST['zipcode'];
					$promotedData = array(
						'user_id' 			=> $_POST['udf2'],
						'role' 				=> $_POST['udf3'],
						'promoted_date' 	=> date('Y-m-d'),
						'promoted_day' 		=> $day,
						'tax' 			    => $_POST['udf4'],
						'base_price' 		=> $base_price,
						'promoted_amount' 	=> $_POST['amount'],
						'txn_id' 			=> $_POST['txnid'],
						'transaction_details'=> json_encode($_POST),
					);
					//print_r($promotedData); exit;
					$promotresult = $this->user->save('tbl_promoted_provider_transaction',$promotedData);
					$featuredData['featured_from'] = date('Y-m-d');
					$featuredData['featured_to'] = date('Y-m-d', strtotime(date('Y-m-d') . '+ '.$day.'days'));
					$result = $this->user->update('tbl_user',$featuredData,'id',$_POST['udf2']);
					if($result > 0 && $promotresult > 0){
						$this->session->set_flashdata('response', '<h4>Your Profession in now listed as fetured at the Professional\'s Page.</h4>');
						redirect('professional/purchase_list?id=done');
					} else {
						$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
						redirect('professional/dashboard');
					}
					break;
			  case "Course Promotion":
				$base_price = $_POST['amount'] - $_POST['udf4'];
				$day = $_POST['zipcode'];
				$addpromotion = array(
					'user_id' 		=> $_POST['udf2'],
					'plan_name'    	=> $_POST['productinfo'],
					'item_name'    	=> $_POST['productinfo'],
					'txn_id'        => $_POST['txnid'],
					'txn_status'    => $_POST['status'],
					'status'        => 1,
					'added_on'      => date('Y-m-d'),
					'no_of_day' 	=> $day,
					'tax'        	=> $_POST['udf4'],
					'base_price'    => $base_price,
					'amount'        => $_POST['amount'],
					'course_id'     => $_POST['udf3'],
					'transaction_details'=> json_encode($_POST),
				);
				//print_r($addpromotion);exit;
				$result = $this->user->save('tbl_course_promotion',$addpromotion);
				if($result){
					$featuredData['featured_from'] = date('Y-m-d');
					$featuredData['featured_to'] = date('Y-m-d', strtotime(date('Y-m-d') . '+ '.$day.'days'));
					$this->user->update('tbl_course',$featuredData,'id',$_POST['udf3']);
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable"><h4>Your Course in now listed as fetured at the Course\'s Page.</h4></div>');
   	   	  			redirect('provider/active_promotion?id=done1');
				}else{
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
   	   	  			redirect('provider/dashboard');
				}
				break;

			  case "Training Promotion":
				$training = $this->db->get_where('tbl_training',array('id'=>$_POST['udf3']))->row_array();
				$base_price = $_POST['amount'] - $_POST['udf4'];
				$day = $_POST['zipcode'];
				$addpromotion = array(
					'user_id' 		=> $_POST['udf2'],
					'training_types'=> $training['training_type'],
					'item_name'    	=> $_POST['productinfo'],
					'txn_id'        => $_POST['txnid'],
					'txn_status'    => $_POST['status'],
					'status'        => 1,
					'added_on'      => date('Y-m-d'),
					'no_of_day' 	=> $day,
					'tax'        	=> $_POST['udf4'],
					'base_price'    => $base_price,
					'amount'        => $_POST['amount'],
					'training_id'   => $_POST['udf3'],
					'transaction_details'=> json_encode($_POST),
				);
				$result = $this->user->save('tbl_training_promotion',$addpromotion);
				if($result){
					$featuredData['featured_from'] = date('Y-m-d');
					$featuredData['featured_to'] = date('Y-m-d', strtotime(date('Y-m-d') . '+ '.$day.'days'));
					$uresult = $this->user->update('tbl_training',$featuredData,'id',$_POST['udf3']);
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Training Promotion success.</div>');
					redirect('provider/active_promotion?id=done1');
				}else{
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
					redirect('provider/dashboard');
				}
				break;

			  case "Certificate Issued":
			  	$num_of_participants = count(explode(',',$_POST['day']));
				$datas['user_id']       = $user_id;
				$datas['training_id']   = $itemNumber;
				$datas['participate_cust_ids'] = $_POST['day'];
				$datas['num_of_participants'] = $num_of_participants;
				$datas['tax'] 			= $_POST['tax'];
				$datas['base_price'] 	= $_POST['base_price'];
				$datas['amount']        = $amount;
				$datas['txn_id']        = $balance_transaction;
				$datas['status']        = 1;
				$datas['added_on']      = date('Y-m-d');
				$datas['transaction_details'] = json_encode($_POST);
				$datas['payment_status'] = 1;
				$result = $this->user->save('tbl_training_certificate',$datas);
				break;

			  case "Staff":
				$taxStaff_id = explode('_',$_REQUEST['custom']);
				$num_of_prof = count(explode(',',$_REQUEST['item_number']));
				$add = array(
					'provider_id' 			=> $uid,
					'prof_id'   			=> $_REQUEST['item_number'],
					'num_of_prof'   		=> $num_of_prof,
					'staff_id'     			=> $taxStaff_id[1],
					'tax'     				=> $taxStaff_id[0],
					'amount'        		=> $_REQUEST['payment_gross'],
					'transaction_details'	=> json_encode($_REQUEST),
					'added_on'      		=> date('Y-m-d H:i:s'),
				);
				$result = $this->user->save('tbl_institution_staff_payment',$add);

				if($result){
					// $staffIds = $_REQUEST['item_name'];
					$staffIds = $taxStaff_id[1];
					$staffIdsArr = explode(',', $staffIds);
					// print_r($staffIdsArr);die;
					$count = count($staffIdsArr);
		
					for($i=0; $i<$count; $i++){
						$stid = $staffIdsArr[$i];
						$data2['activated'] 	= 1;
						$this->user->update('tbl_institution_staff',$data2,'id',$stid);
					}
				}
				break;
				case "RBoard Subscription":
					$this->rboard_payment_success($insert_id);
				break;
			  // default:
			  //   echo "Your favorite color is neither red, blue, nor green!";
			}
	 
		//need to add one emailer which goes to user email id and Ceonpoint's notification. 
			
			if( $insert_id > 0 && $_POST['status'] == 'success'){
	
				if($type == "Certificate Issued"){
					$this->session->set_flashdata('response-res', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Payment has been completed successfully.</div>');
					redirect('provider/template/'.$itemNumber.'/'.$result.'');
				}elseif($type == "Staff"){
					$this->session->set_flashdata('response-res', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Staff Payment successfully Done.</div>');
					redirect('provider/staffpayment?go='.$result.'');
				}else{
					// echo '<pre>'; print_r($redirectdata);die;
					redirect('payu/payment_success');
				}
			}else{	
				$this->session->set_flashdata('response',"Transaction has been failed");
				redirect('payu/failStatus');
			}
		}else{
			$this->session->set_flashdata('response',"Transaction failed!");
			redirect('payu/failStatus');
		}
	}
	public function rboard_payment_success($payment_id){
		//$payment_id = $this->rboard->updatpayment($_POST);
		if($payment_id > 0){
			$userid = $this->rboard->get_userid($payment_id);
			//print_r($userid);exit;
			// login section 
			
			$result = $this->users_model->login_for_id($userid->user_id);
			$row =	$result;
			if($result['logged_in']==0){
				$datas1['logged_in'] = 1;
			} else {
				//$datas1['logged_in'] = 2;
				$datas1['logged_in'] = $row['logged_in']+1;
			}
			
			$datas1['logged_in_status'] = 1;
			$this->users_model->update('tbl_user',$datas1,'id',$row['id']);
			$sess_array = array(
				'id' 		=> $row['id'],
				'username' 	=> $row['username_email'],
				'name' 		=> $row['name'],  
				'role' 		=> $row['role'],  
				'profession'=> $row['profession'],  
				'location' 	=> $row['location'],  
				'address' 	=> $row['address'],
				'country' 	=> $row['country'],
				'domain' 	=> $row['website'],
				'filepath' 	=> $row['registering_body'],
				'insititution_id' 	=> $row['insititution_id'],
				'under_insititution'=> $row['under_insititution'],
				'logged_in'=> $row['logged_in']
				);

			$this->session->set_userdata('logged_in', $sess_array);
			//end login
			if($userid->payment_type == 'n' ){
				$subscriptionkey = md5($userid->user_id.$userid->product_id.$this->session->userdata('logged_in')['name'].$this->session->userdata('logged_in')['username_email']);
				$rbcode = md5($userid->user_id.$this->session->userdata('logged_in')['name'].$this->session->userdata('logged_in')['username_email']);
				$insert = array();
				$insert['subscription_id'] 	= $userid->product_id;
				$insert['user_id'] 			= $userid->user_id;
				$insert['templete_id'] 		= '1';
				$insert['rb_name']  		= $this->session->userdata('logged_in')['name'];
				$insert['domain']  			= $this->session->userdata('logged_in')['domain'];
				$insert['filepath']  		= $this->session->userdata('logged_in')['filepath'];
				$insert['rb_email']  		= $this->session->userdata('logged_in')['username'];
				$insert['rb_password']  	= '';
				$insert['rb_contact']  		= '';
				$insert['rb_country_id']  	= $this->session->userdata('logged_in')['country'];
				$insert['rb_status']  		= '1';
				$insert['added_at'] 		= date('Y-m-d H:i:s');
				$insert['rb_sub_key'] 		= $subscriptionkey;
				$insert['rb_code'] 			= $rbcode;
				$adddetail_id = $this->rboard->insert_rboard_details($insert);
				if($adddetail_id){
					// $to = 'abhijeetkuma@gmail.com';
					$to = $this->session->userdata('logged_in')['username'];
					$subject = 'Subscription Purchase';
					$message = 'Thank you for purchase subscription<br> Activation key:'.$subscriptionkey.'<br>Code:'.$rbcode;
					
				}
			}
			
			if($userid->payment_type == 'r' ){
				
				$updat['subscription_id'] 		= $userid->product_id;
				$updated = $this->rboard->update_rboard_details($updat,$rb_id);
				
					$package = $this->rboard->get_one_subscription_package($userid->product_id);
					$subscription_details = $this->rboard->get_rboard_subscription_details($userid->user_id);

					$to = $this->session->userdata('logged_in')['username'];
					$subject = 'Renewal of Subscription Purchase';
					$message = 'Thank you for purchase subscription <br> new application is added on your tracker.';
			?><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<script>
					jQuery(document).ready(function($){
						var domain = '<?php echo $this->session->userdata('logged_in')['domain']; ?>';
						var admin_email = '<?php echo $this->session->userdata('logged_in')['username']; ?>';
						var rb_name = '<?php echo $subscription_details->rb_name; ?>';
						var subscription_id = '<?php echo $userid->product_id; ?>';
						var subscription_name = '<?php echo $package->subcription_name; ?>';
						var no_of_applications = '<?php echo $package->no_of_applications; ?>';
						var rb_sub_key = '<?php echo $subscription_details->rb_sub_key; ?>';
						var rb_code = '<?php echo $subscription_details->rb_code; ?>';
						var added_on = '<?php echo date('Y-m-d H:i:s'); ?>';
							$.ajax({
							type: "POST",
							url: domain+'admin/api/update_admin_subscription_package',
							// url: "https://ceonpoint.com/RBoard/admin/api/update_admin_subscription_package",
							data: JSON.stringify({
									"domain":domain,
									"admin_email":admin_email,
									"rb_name":rb_name,
									"subscription_id":subscription_id,
									"subscription_name":subscription_name,
									"no_of_application":no_of_applications,
									"rb_sub_key":rb_sub_key,
									"rb_code":rb_code,
									"added_on":added_on
								}),
								success: function(result){
									console.log(result)
								}
							});  
					});  
				</script><?php  
			}
			$notification = array(
				'subject'        	=> $subject,   
				'to' 				=> $userid->user_id,  
				'message' 			=> $message,  
				'status'     		=> 1,
				'added_on'     		=> date('Y-m-d H:i:s')
			); 
			$this->user->save('tbl_notification',$notification);
			$this->sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE);
			// $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Success.</div>');
			echo '<script>
				window.location.href = "'.base_url().'rboard/purchase_history";
			</script>';
			// redirect('rboard/purchase_history','refresh');
		}
	}
	public function sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE)
	{ 
		$from = "mails@ceonpoint.com";
		$fromName = "Ceonpoint";
		 
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
}
