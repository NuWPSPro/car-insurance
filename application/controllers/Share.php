<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Share extends CI_Controller {

	/** 
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */



	public function  __construct()
	{
        parent::__construct();
		// $uid = $this->session->userdata('logged_in')['id'];
		// if($uid==""){ redirect('users'); }
		$this->load->model('provider_model');  
		$this->load->model('dashboards_model');
		$this->load->model('professional_model');
		$this->load->model('Rboard_model','rboard'); 
		// $this->load->model('Share_model','share'); //this one is already autoloaded in config.
		$this->load->model('institution_model','institution');  
	}

	public function advertisement()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		$urole = $this->session->userdata('logged_in')['role'];
		if($urole==1){
			$redirect = 'professional';
		}elseif($urole==2){
			$redirect = 'provider';
		}elseif($urole==3){
			$redirect = 'placement';
		}elseif($urole==4){
			$redirect = 'advertise';
		}elseif($urole==5){
			$redirect = 'institution';
		}elseif($urole==6){
			$redirect = 'author';
		}elseif($urole==10){
			$redirect = 'admin';
		}
		$where1 = array('role'=>5,'status'=>1,'disabled_by'=>'0');
		$subinstitution1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
		$data['totalSubInstitute'] = sprintf("%02d", count($subinstitution1));
		
		$where4 = array('role'=>1,'status'=>1,'disabled_by'=>'0');
		$professionallist = $this->user->get_record_by_multi_field_name('tbl_user',$where4);
		$data['totalProfessional'] = sprintf("%02d", count($professionallist));
		
		$this->db->group_by('country'); 
		$countryllist =  $this->db->get_where('tbl_user',array('status'=>1,'country !='=> 0))->result_array();
		$data['totalCountries'] = sprintf("%02d", count($countryllist));

		$where = array('');
		$viewerlist = $this->user->get_record_by_multi_field_name('tbl_viewer_counter',$where);
		$data['totalViewers'] = sprintf("%02d", array_sum(array_column($viewerlist, 'count')));
		
		$uid = $this->session->userdata('logged_in')['id'];
		$data['totalIncomeProvider'] = $this->provider_model->total_income($uid,'month');
		$data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',1);  
		$this->db->where('display','Yes');
		$data['country'] = $this->user->get_countries();
		// echo'<pre>';print_r($data);die;
		$this->load->frontAdmin(''.$redirect.'/add_advertise',$data);
	}

	public function paynow()
	{	
		if($this->session->userdata('logged_in')['id'] == ""){
			redirect('users');
		}
		$userid 	= $this->session->userdata('logged_in')['id'];
		$userrole 	= $this->session->userdata('logged_in')['role'];
		$post 		= $this->input->post();
		$user_name  = $post['user_name'];
		// print_r($post);die;
		$data = array(
			'user_id' 		=> $userid,
			'user_role' 	=> $userrole,
			'amount' 		=> $post['total_amount'],
			'package_id' 	=> $post['advertise_id'],
			'no_of_view' 	=> $post['no_of_view'],
			'website_url' 	=> $post['website_url'],
			'payment_status'=> 0,
			'status' 		=> 1,
			'country' 		=> $post['country'],
		);

		 if(isset($_FILES["banner_image"]) && !empty($_FILES["banner_image"]['name'])){
            $config['upload_path'] = './assets/upload/advertise/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '200000';
            $config['max_width']  = '15000';
            $config['max_height']  = '8000';        
            $ext = explode('.',$_FILES["banner_image"]["name"]);        
            $imageName = 'ADD_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('banner_image'))
            {
             $error = array('error' => $this->upload->display_errors());       
              die(  $error);          
            }  
             // $data['package_image'] .= $imageName;
             $data['banner_image'] .= $imageName;
            }

			// $result = $this->user->save('tbl_adv_package_purchased',$data);	
			$this->db->insert('tbl_adv_package_purchased',$data);
			$result = $this->db->insert_id();
			// echo $this->db->last_query();die;
			// echo $result;die;
		if($result){
			$amount = $post['total_amount'];
			echo '<form action="'.PAYAPAL_URL.'" method="post" name="advertisement" id="advertisement">
				<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="item_name" id="item_name" value="'.$user_name.' - Advertisment">
				<input type="hidden" name="item_number" value="'.$result.'">
				<input type="hidden" name="credits" value="510">
				<input type="hidden" name="userid" value="'.$userid.'">
				<input type="hidden" name="amount" id="amount" value="'.$amount.'">
				<input type="hidden" name="rm" value="2">
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="handling" value="0">
				<input type="hidden" name="cancel_return" value="'.site_url('share/fail_add_advertise').'">
				<input type="hidden" name="return" value="'.site_url('share/success_add_advertise').'">
			</form>

				<script type="text/javascript">
					document.getElementById("advertisement").submit();
				</script>
			';
		}
	}
	
	public function success_add_advertise()
	{	
		$urole = $this->session->userdata('logged_in')['role'];
		// if($this->session->userdata('logged_in')['id'] == ""){
		// 		redirect('users');
		// }
			$item_id = $_REQUEST['item_number'];
			$update  = array(
				'txn_id' 		  => $_REQUEST['txn_id'],
				'txn_status' 	  => $_REQUEST['payment_status'],
				'purchased_on' 	  => date("Y-m-d H:i:s"),
				'package_end_date'=> date("Y-m-d",strtotime("+ 7 days")),
				'amount' 		  => $_REQUEST['payment_gross'],
				'payment_status'  => 1,
				'transaction_details' => json_encode($_REQUEST),
			);
			$result = $this->advertiseads->update('tbl_adv_package_purchased',$update,'id',$item_id);
			// echo $result;die;
		if($urole==1){
			$data['role'] = 'professional';
			$data['template'] = 'template/picture'; 
		}elseif($urole==2){
			$data['role'] = 'provider';
			$data['template'] = 'template/picture_provider'; 
		}elseif($urole==3){
			$data['role'] = 'placement';
			$data['template'] = 'template/placement'; 
		}elseif($urole==4){
			$data['role'] = 'advertise';
			$data['template'] = 'advertise/advertise_head'; 
		}elseif($urole==5){
			$data['role'] = 'institution';
			$data['template'] = 'institution/picture'; 
		}elseif($urole==6){
			$data['role'] = 'author';
			$data['template'] = 'template/picture_author'; 
		}
			// echo $data['role'];die;
		if($result){
			$data['advdetails'] = $this->share->get_row_array('tbl_adv_package_purchased','id',$item_id);
			$data['advname'] = $this->share->get_row_array('tbl_adv_package','id',$data['advdetails']['package_id']);
			$this->load->frontAdmin('shared/thanku',$data); 
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">There is some error. Please try again.</div>');
			redirect('share/advertisement',$data); 
		}
	}

		
	public function fail_add_advertise()
	{
		$this->session->set_flashdata('response','<div class="alert alert-danger">There is some error. Please try again.</div>');
		redirect('share/advertisement'); 
	}

	public function tutorials()
	{
		$urole = $this->session->userdata('logged_in')['role'];
		$uid = $this->session->userdata('logged_in')['id'];
		$udetails = $this->share->get_row_array('tbl_user','id',$uid);
		if($urole==1){
			$redirect = 'professional';
			$data['usertutorials'] 	= $this->dashboards_model->get_tutorial('professional');
		}elseif($urole==2){
			$redirect = 'provider';
			if($udetails['under_insititution'] == '1'){
				$data['usertutorials']	= $this->dashboards_model->get_tutorial('cepInstitution');
			}else{
				$data['usertutorials'] 	= $this->dashboards_model->get_tutorial('cepBusiness');
			}
		}
		elseif($urole==3){
			$redirect = 'placement';
		}
		elseif($urole==4){
			$redirect = 'advertise';
			$data['usertutorials'] 	= $this->dashboards_model->get_tutorial('advertiser');
		}elseif($urole==5){
			$redirect = 'institution';
			$data['usertutorials'] 	= $this->dashboards_model->get_tutorial('institution');
		}elseif($urole==6){
			$redirect = 'author';
			// if($udetails['under_insititution'] == '1' && !empty($udetails['under_provider'])){
			// 	$data['usertutorials'] 	= $this->dashboards_model->get_tutorial('authorCeonpoint');
			// }else
			if($udetails['under_insititution'] == '1'){
				$data['usertutorials']  = $this->dashboards_model->get_tutorial('authorInstitutions');
			}else{
				$data['usertutorials'] 	= $this->dashboards_model->get_tutorial('authorBusiness');
			}
		}elseif($urole==7){
			$redirect = 'rboard';
			$data['usertutorials'] 	= $this->dashboards_model->get_tutorial('regulatoryBoard');
		}
		$this->load->frontAdmin(''.$redirect.'/tutorials',$data); 
	}

	public function viewprofile($uid)
	{
		$data['userdetails'] = $this->share->get_row_array('tbl_user','id',$uid);
		$data['profile']     = $this->share->get_row_array('tbl_professionals','user_id',$uid);
		// echo $this->db->last_query();
		$pid = $data['profile']['pro_id'];
		if($data['userdetails']['role']==1){
			$role = 'professional';
		}elseif($data['userdetails']['role']==2){
			$role = 'provider';
		}elseif($data['userdetails']['role']==3){
			$role = 'placement';
		}elseif($data['userdetails']['role']==4){
			$role = 'advertise';
		}elseif($data['userdetails']['role']==5 && $data['userdetails']['under_insititution']=='1'){
			$role = 'institution';
		}elseif($data['userdetails']['role']==6){
			$role = 'author';
		}
		if(!empty($data['profile']['profile_photo'])){
			$ogimage = $data['profile']['profile_photo'];
		}else{
			$ogimage = $data['userdetails']['image'];
		}

		// $data['og_description'] =  'Ceopoint '.$role;
		$data['og_title'] 		=  $data['userdetails']['name'];
		$data['og_image'] 		=  base_url('assets/images/uploads/'.$ogimage);
		$data['og_url'] 		=  base_url('share/viewprofile/'.$uid);
		$data['og_type'] 		=  'website';

		// echo'<pre>';print_r($data['userdetails']); 
		$data['citationsgetdata']  = $this->share->get_result_array('tbl_citations_list','pro_id',$pid);
		$data['practicegetdata']   = $this->share->get_result_array('tbl_practice_list','pro_id',$pid);
		$data['affiliationgetdata']= $this->share->get_result_array('tbl_affiliation_list','pro_id',$pid);
		$data['professionfiles']   = $this->share->get_result_array('tbl_user_docutments','user_id',$uid);

		$currentUser    	= $this->share->get_row_array('tbl_user','id',$uid);
		$data['review'] 	= $this->share->get_result_array('tbl_user_review','to_user',$uid);

		if($data['userdetails']['role'] == 2 && $data['userdetails']['under_insititution'] == '1'){
			$this->db->where('user_id',$uid)->or_where('author_reference_id',$uid);
			$data['allcourse'] 	= $this->share->get_result_array('tbl_course','status', '1');
			
			$this->db->where('status', '2');
			// $this->db->where('end_date >=',date('Y-m-d'));
			$data['seminar'] 	= $this->share->get_result_array('tbl_training','user_id',$uid);

			$this->db->where(array('role'=>6,'status'=>1));
			$data['authors']	= $this->share->get_result_array('tbl_user','under_provider',$currentUser['insititution_id']);
			
			$this->db->where('user_id',$uid);
			$data['blogs'] 	= $this->share->get_result_array('tbl_blog','status', '1');
			
		}elseif($data['userdetails']['role'] == 5 && $data['userdetails']['under_insititution'] == '1'){
			$fulldetails 		= $this->share->getuser_info($uid,5);
			if($fulldetails['child_info']){
				$insArr = array_column($fulldetails['child_info'],'cinsititution_id');
				array_push($insArr ,$currentUser['insititution_id']);
				$insidArr = array_column($fulldetails['child_info'],'cid');
				array_push($insidArr ,$currentUser['id']);
			}else{
				$insArr = array($currentUser['insititution_id']);
				$insidArr = array($currentUser['id']);
			}
			$data['allcourse']	= $this->share->get_course_under_institution($insArr);
			$data['seminar']	= $this->share->get_training_under_institution($insArr);
			$data['provider']	= $this->share->get_provider_under_institution($insidArr);
			$data['authors']	= $this->share->get_author_under_institution($insidArr);
			
		}else{

			$this->db->where('status','1'); 
			// $this->db->where('course_validity >=',date('Y-m-d')); 
			$this->db->where('user_id',$uid)->or_where('author_reference_id',$uid);
			$data['allcourse'] 	= $this->share->get_result_array('tbl_course','status','1');

			$this->db->where('user_id',$uid);
			$data['blogs'] 	= $this->share->get_result_array('tbl_blog','status', '1');
			
			$this->db->where('status', '2');
			// $this->db->where('end_date >=',date('Y-m-d'));
			$data['seminar'] 	= $this->share->get_result_array('tbl_training','user_id',$uid);

			$this->db->where(array('role'=>6,'status'=>1));
			$data['authors']	= $this->share->get_result_array('tbl_user','under_provider',$currentUser['insititution_id']);
		}

		if($data['userdetails']['role'] == 2 && $data['userdetails']['under_insititution'] == '0'){
			
			$this->load->frontAdmin('shared/cep_business_page',$data); 
			// echo 'cep Business new template';
		}else{
			$this->load->frontAdmin('shared/viewmypage',$data); 
		}
	}

	public function showBill(){
		if($this->session->userdata('logged_in')['role'] !=10){
			$uid 	= $this->session->userdata('logged_in')['id'];
			$urole  = $this->session->userdata('logged_in')['role'];
		}
	   	
	   	$idd =  $this->input->post('idd');
	   	$type =  $this->input->post('type');
		// echo $idd.'***'.$type;die;
		switch ($type) {
			
		case 'Digital Certificate Subscription':
			$dataArray = $this->share->get_result_array('tbl_payment_transaction','id',$idd);
		// 	echo'<pre>';print_r($dataArray[0]);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray[0]['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			$returnarray = array();
			$json 		  = json_decode($dataArray[0]['transaction_details']);
			$price 		  = floatval($json->payment_gross);
			$tax 		  = $dataArray[0]['tax'];
			$netprice   = $price - floatval($tax);
			// $paypalCharge = floatval(($unitPrice1*5)/100);
			// $netprice 	  = floatval($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray[0]['product_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= 'Digital Certificate Subscription';
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
		// 	// $returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		    break;
		case 'Advertise':
		    $this->db->where('app.id',$idd);
	    	$dataArray = $this->share->getAdvertiseAddsList($uid,$urole);
			$fetchtax = $this->share->get_row_array_where('tbl_misc',array('id'=>1));
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray[0]['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = floatval($json->payment_gross);
				$tax 		  = $fetchtax['set_percentage']; // it will be amount of tax not pesentage.
        		$unitPrice1   = $price - floatval($tax);
        		$netprice 	  = floatval($unitPrice1);
			// $returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= $dataArray[0]['title'];
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			// $returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		    break;
		case 'Promotion': //company promotion and practise promotion
			$this->db->where('ppt.id',$idd);
			$dataArray = $this->share->get_active_promoted_provider($uid);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray[0]['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			// $fetchtax = $this->share->get_row_array_where('tbl_misc',array('id'=>1));
			$returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = $dataArray[0]['promoted_amount'];
				$taxForOneDay = $dataArray[0]['tax'];
				$day 		  = $dataArray[0]['promoted_day'];
				$tax 		  = $taxForOneDay*$day;
        		$netprice     = $price - floatval($tax);
        		// $paypalCharge = floatval(($unitPrice1*5)/100);
        		// $netprice 	  = floatval($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray[0]['promoted_date']));
			$returnarray['course_title'] 	= $json->item_name;
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['txn_id'] 			= $dataArray[0]['txn_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 		= $returnarray;
		    break;
		case 'Course Promotion':
			$this->db->where('cp.id',$idd);
			$dataArray = $this->share->get_active_course_promotion($uid);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray[0]['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			$returnarray = array();
			$json 		  = json_decode($dataArray[0]['transaction_details']);
			$price 		  = floatval($dataArray[0]['amount']);
			$day 		  = $dataArray[0]['no_of_day'];
			$taxForOneDay = $dataArray[0]['tax'];
			$tax 		  = $taxForOneDay*$day;
			$netprice     = $price - floatval($tax);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray[0]['added_on']));
			$returnarray['course_title'] 	= $json->item_name;
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['txn_id'] 			= $dataArray[0]['txn_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		    break;

		case 'Training Promotion':
			$dataArray = $this->share->get_active_training_promotion($uid,$idd);
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray[0]['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = floatval($dataArray[0]['amount']);
				$day 		  = $dataArray[0]['no_of_day'];
				$taxForOneDay = floatval($dataArray[0]['tax']);
				$tax 		  = ($taxForOneDay * $day);
        		$netprice     = $price - floatval($tax);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray[0]['added_on']));
			$returnarray['course_title'] 	= $dataArray[0]['item_name'];
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 		= $returnarray;
		    break;
		case 'TMS Pro':
			$this->db->where('tpub.id',$idd);
			$dataArray = $this->share->get_training_publish($uid);
			// $fetchtax = $this->share->get_row_array_where('tbl_misc',array('id'=>1));
			// echo'<pre>';print_r($dataArray[0]);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray[0]['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			  $returnarray = array();
				$json 		  = json_decode($dataArray[0]['transaction_details']);
				$price 		  = floatval($dataArray[0]['amount']);
				$tax 		  = $dataArray[0]['tax'];
        		$netprice     = $price - floatval($tax);

			$returnarray['item_name'] 		= $dataArray[0]['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($json->payment_date));
			$returnarray['course_title'] 	= $dataArray[0]['title'];
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			// $returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		    break;
		case 'Course':
			$dataArray = $this->share->receipt_courses($idd);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			// echo'<pre>';print_r($dataArray);die;
			  $returnarray = array();
				$price 		  = floatval($dataArray['amount']);
				$tax 		  = floatval($dataArray['tax']);
        		$netprice     = $price - floatval($tax);
        		// $paypalCharge = floatval(($unitPrice1*5)/100);
        		// $netprice 	  = floatval($unitPrice1 - $paypalCharge);

			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray['added_on']));
			$returnarray['course_title'] 	= $dataArray['course_title'];
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			// $returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $dataArray['txn_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 		= $returnarray;
		    break;
		case 'Training':
			$dataArray = $this->share->receipt_tmss($idd);
			// echo'<pre>';print_r($dataArray);die;
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			$returnarray = array();
				$json 		  = json_decode($dataArray['transaction_details']);
				$price 		  = floatval($dataArray['amount']);
				$tax 		  = floatval($dataArray['tax']);
        		$netprice     = $price - floatval($tax);
        		// $paypalCharge = floatval(($unitPrice1*5)/100);
        		// $netprice 	  = floatval($unitPrice1 - $paypalCharge);
        
			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray['added_on']));
			$returnarray['course_title'] 	= $json->item_name;
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			// $returnarray['paypalCharge'] 	= $paypalCharge;
			$returnarray['txn_id'] 			= $dataArray['txn_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 	= $returnarray;
		    break;
		case 'Certificate Issued':
			$dataArray = $this->share->receipt_certificate($idd);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			$fetchtax = $this->share->get_row_array_where('tbl_misc',array('id'=>1));
			// echo'<pre>';print_r($json);
			  $returnarray = array();
				$json 		  = json_decode($dataArray['transaction_details']);
				$price 		  = floatval($dataArray['amount']);
				$tax 		  = floatval($dataArray['tax']*$dataArray['num_of_participants']);
        		$netprice     = $price - floatval($tax);

			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray['added_on']));
			$returnarray['course_title'] 	= $dataArray['course_title'];
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['txn_id'] 			= $dataArray['txn_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 		= $returnarray;
			break;
		case 'Staff Payment':
			$dataArray = $this->share->receipt_staff($idd);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			// $fetchtax = $this->share->get_row_array_where('tbl_misc',array('id'=>1));
			// echo'<pre>';print_r($dataArray);
			  $returnarray = array();
				$json 		  = json_decode($dataArray['transaction_details']);
				$price 		  = floatval($dataArray['price']);
				$tax 		  = floatval($dataArray['tax'])*$dataArray['num_of_prof'];
        		$netprice     = $price - floatval($tax);

			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray['added_on']));
			$returnarray['course_title'] 	= $json->item_name;
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['txn_id'] 			= $json->txn_id;
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 		= $returnarray;
			break;
		case 'Pcems':
			$dataArray = $this->share->receipt_pcems($idd);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray['user_id']));
			$country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			// $fetchtax = $this->share->get_row_array_where('tbl_misc',array('id'=>1));
			// echo'<pre>';print_r($dataArray);
			  $returnarray = array();
				// $json 		  = json_decode($dataArray['transaction_details']);
				$price 		  = floatval($dataArray['price']);
				$tax 		  = $dataArray['tax']; 
        		$netprice     = $price - floatval($tax);

			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray['added_on']));
			$returnarray['course_title'] 	= $dataArray['item_name'];
			$returnarray['username'] 		= $uname['name'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$country['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['txn_id'] 			= $dataArray['txn_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 		= $returnarray;
			break;
		case 'RBoard':
			$dataArray = $this->share->receipt_rboard($idd);
			$uname = $this->share->get_row_array_where('tbl_user',array('id'=>$dataArray['user_id']));
			// $country = $this->share->get_row_array_where('countries',array('countries_id'=>$uname['country']));
			// $fetchtax = $this->share->get_row_array_where('tbl_misc',array('id'=>1));
			// echo'<pre>';print_r($dataArray);
			  $returnarray = array();
				// $json 		  = json_decode($dataArray['transaction_details']);
				$price 		  = floatval($dataArray['price']);
				$tax 		  = $dataArray['tax']; 
        		$netprice     = $price - floatval($tax);

			$returnarray['item_name'] 		= $dataArray['item_name'];
			$returnarray['added_on'] 		= date("jS F, Y", strtotime($dataArray['added_on']));
			$returnarray['course_title'] 	= $dataArray['item_name'].' ('.$dataArray['product_name'].')';
			$returnarray['username'] 		= $dataArray['username'];
			$returnarray['countries_name'] 	= $uname['street'].' '.$uname['city'].' '.$uname['state'].'<br/>'.$uname['address'].',<br/> country: '.$dataArray['countries_name'];
			$returnarray['tax'] 			= $tax;
			$returnarray['txn_id'] 			= $dataArray['txn_id'];
			$returnarray['amount'] 			= $netprice;
			$data['purchase_details'] 		= $returnarray;
			break;
		
		// default:
		//     echo "Bar\n";
		//     break;

		}
	   $this->load->view('shared/receipt',$data);
	}

	public function notification(){
		$urole  = $this->session->userdata('logged_in')['role'];
		$uid 	= $this->session->userdata('logged_in')['id'];
		// echo $urole.'**'.$uid;die;
		if($urole !=10){
			$this->db->where('to',$uid);
		}
		$data['inbox'] = $this->share->get_result_array('tbl_notification','status',1);
		if($urole !=10){
			$this->db->where('to',$uid);
		}
		$data['read'] = $this->share->get_result_array('tbl_notification','status',0);
		if($urole==1){
			$redirect = 'professional';
		}elseif($urole==2){
			// $redirect = 'provider';
			$redirect = 'car_company';
			// $data['details'] = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
			$data['body_heading'] = '<div class="admin-titlebox"><h3 class="border-title text-left">Notification</h3></div>';
			
		}elseif($urole==3){
			$redirect = 'placement';
		}elseif($urole==4){
			$redirect = 'advertise';
		}elseif($urole==5){
			$redirect = 'institution';
		}elseif($urole==6){
			$redirect = 'author';
		}elseif($urole==7){
			$redirect = 'rboard';
			$data['userdata'] = $this->rboard->get_rboard_info($uid);
		}elseif($urole==10){
			$redirect = 'admin';
		}
	    $this->load->frontAdmin(''.$redirect.'/notification',$data); 
	}

	public function delete_notification($id){
		$result = $this->share->delete('tbl_notification',$id);
		if($result==true){
			$this->session->set_flashdata('response','<div class="alert alert-success">Notification deleted successfully!</div>');
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong please try again!</div>');
		}
		redirect('share/notification');	
	}

	public function showMessage(){
		$idd =  $this->input->post('idd');

	    $data['notification'] = $this->share->get_row_array_where('tbl_notification',array('id'=>$idd));
	  
		$this->db->where('id',$idd);
		$this->db->update('tbl_notification',array('status'=>0));
	    $this->load->view('shared/notificationdata',$data); 
	}

	public function enquiry()
	{
		$enquirydata = array(
			'etype' 		=> $this->input->post('type'),
			'email' 		=> $this->input->post('email'),
			'first_name' 	=> $this->input->post('first_name'),
			'subject' 		=> $this->input->post('type'),
			'message' 		=> $this->input->post('message')
		);
		$result = $this->user->save('tbl_enquiry',$enquirydata); 
		if($result > 0){
			$this->session->set_flashdata('response','<div class="alert alert-success">Reply sent successfully.</div>');
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong please try again!</div>');
		}
		redirect('share/notification');	
	}

	public function powerpoint(){
	  	$training_id     = $this->input->post('training_id'); 
	  	$speaker_id      = $this->input->post('speaker_id'); 
	  	
	  	$datas = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_speaker_powerpoint',array('training_id'=>$training_id,'speaker_id'=>$speaker_id),'');
		$explodedData = explode('##', $datas[0]['images']); 
			foreach ($explodedData as $key => $val1) {
				if($val1 !=''){
			echo '<div class="col-md-2">
						<div class="img-box">
							<a data-fancybox="images" href="'.ASSETS_URL.'images/uploads/'.$val1.'">
				  			<img class="img-fluid" src="'.ASSETS_URL.'images/uploads/'.$val1.'?auto=compress&cs=tinysrgb&dpr=1&w=500" alt=""></a>
						</div>
					</div>';
				} 
			} 
	}

	public function resend_certificate(){
		$certifiacte_no = $this->input->post('certifiacte_no');
		$userid = $this->input->post('user_id');
		$title = $this->input->post('title');
		$user_details = $this->share->get_row_array_where('tbl_user',array('id'=>$userid));
		if($user_details){
			$subject = "Training Certificate";
			$uid = $this->session->userdata('logged_in')['id'];
			$data3['user_name'] 	= $user_details['name'];
			$data3['training'] 		= $title;
			$data3['certficate_no'] = $certifiacte_no;
				$user = $this->db->get_where('tbl_user',array('username_email'=>$user_details['username_email']))->row_array();
				if($user){ $userid = $user['id']; }else{ $userid = 0; }
				$notification = array(
				'subject'        	=> $subject,   
				'to' 				=> $userid,  
				'from' 				=> $uid,  
				'message' 			=> $this->load->view('email/get_certifiate_mail',$data3,true),  
				'status'     		=> 1,
				'added_on'     		=> date('Y-m-d H:i:s')
				); 
				$this->user->save('tbl_notification',$notification);
			$this->sendMail($user_details['username_email'],$subject,$this->load->view('email/get_certifiate_mail',$data3,true));
			echo 'email sent successfully to '.$user_details['username_email'].'.';
		}else{
			echo 'Please check the user\'s e-mail id.';
		}
	}

	public function sendMail($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE){ 
		$from = EMAIL;
		$fromName = "MYCPD";
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
		    'Reply-To: '.$from."\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		 
		// Compose a simple HTML email message
 		if(mail($to, $subject, $message, $headers)){ 
		    return true;
		} else{ 
		    return false;
		}
	}

}

?>
