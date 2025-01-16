<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertise extends CI_Controller {

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
			$this->load->model('dashboards_model');
			$this->load->model('user_model','user');
			/* $uid = $this->session->userdata('logged_in')['id'];
			if($uid==""){
				redirect('users');
			} */
	}



	public function index()
	{ 
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		$this->load->frontAdmin('advertise/advertise'); 
	}

	
	public function dashboard()
	{ 
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		$this->load->frontAdmin('advertise/dashboard'); 
	}



	public function addtocart($idd)
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
	if(empty($_SESSION['cart'])){
	//echo "empty";
	$datas = array();
	} else {
	///echo "Not empty";
	$datas = $_SESSION['cart'];
	}

	if (in_array($idd, $datas)){

	} else {
	array_push($datas, $idd);
	$_SESSION['cart'] = $datas;
	} 

	redirect('advertise/advertise');

}



function removecart($idd){

	if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
	unset($_SESSION['cart'][$idd]);
	redirect('advertise/advertise');

}



  public function add_advertise()
    {
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
    	$where1 = array('role'=>5,'status'=>1);
		$subinstitution1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
		$data['totalSubInstitute'] = sprintf("%02d", count($subinstitution1));


		$where2 = array('role'=>1,'status'=>1);
		$ceproviderlist = $this->user->get_record_by_multi_field_name('tbl_user',$where2);
		$data['totalCeProvider'] = sprintf("%02d", count($ceproviderlist));

		$where3 = array('role'=>5,'status'=>1);
		$authorlist = $this->user->get_record_by_multi_field_name('tbl_user',$where3);
		$data['totalAuthor'] = sprintf("%02d", count($authorlist));


		$where4 = array('role'=>1,'status'=>1);
		$professionallist = $this->user->get_record_by_multi_field_name('tbl_user',$where4);
		$data['totalProfessional'] = sprintf("%02d", count($professionallist));

		$where5 = array('status'=>1,'display'=>'Yes');
		$countryllist = $this->user->get_record_by_multi_field_name('countries',$where5);
		$data['totalCountries'] = sprintf("%02d", count($countryllist));

		$where = array('');
		$viewerlist = $this->user->get_record_by_multi_field_name('tbl_viewer_counter',$where);
		$data['totalViewers'] = sprintf("%02d", array_sum(array_column($viewerlist, 'count')));
        $data['country'] = $countryllist;  
        $data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',1); 
	    $this->load->frontAdmin('advertise/add_advertise',$data); 
    }

	public function advertise()
		{
			if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
			}
          	$user_id= $this->session->userdata('logged_in')['id']; 
            $data['advertise'] = $this->advertiseads->getAdvertiseAddsList($user_id);
             			 
			$this->load->frontAdmin('advertise/advertise',$data); 			 
		}

    public function success_ad_book(){
      /*  echo '<pre>';
        print_r($_REQUEST);*/
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
        if(!empty($_REQUEST)){

        foreach ($_SESSION['cart'] as $key => $value) {
            
            $data['package_id']      = $value; 
            $data['user_id']         = $this->session->userdata('logged_in')['id']; 
            $data['payment_status']  = 1; 
            $data['purchased_on']    =  date('Y-m-d'); 
            $result = $this->user->save('tbl_adv_package_purchased',$data); 

        }
      }

        unset($_SESSION['cart']);


        $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Package plan purchased successfully.</div>');
        redirect('advertise/add_advertise');

    }


    public function cancel_ad_book(){
			if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
            $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
                redirect('advertise/add_advertise');

    }
	
	
	

  public function paynow()
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		$userid = $this->session->userdata('logged_in')['id'];
		$post = $this->input->post();
		// print_r($post);die;
		$data = array(
			'user_id' 		=> $userid,
			'amount' 		=> $post['total_amount'],
			'package_id' 	=> $post['advertise_id'],
			'no_of_view' 	=> $post['no_of_view'],
			'website_url' 	=> $post['website_url'],
			'payment_status' => 0,
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
             $data['banner_image'] .= $imageName;
            }

			$result = $this->user->save('tbl_adv_package_purchased',$data);	
			// echo $result;die;
			$amount = $post['total_amount'];
			echo '<form action="'.PAYAPAL_URL.'" method="post" name="advertisement" id="advertisement">
				<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="item_name" id="item_name" value="advertise">
				<input type="hidden" name="item_number" value="'.$result.'">
				<input type="hidden" name="credits" value="510">
				<input type="hidden" name="userid" value="'.$userid.'">
				<input type="hidden" name="amount" id="amount" value="'.$amount.'">
				<input type="hidden" name="rm" value="2">
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="handling" value="0">
				<input type="hidden" name="cancel_return" value="'.site_url('advertise/fail_add_advertise').'">
				<input type="hidden" name="return" value="'.site_url('advertise/success_add_advertise').'">
			</form>

				<script type="text/javascript">
					document.getElementById("advertisement").submit();
				</script>
			';
		
	}
	
	function success_add_advertise()
	{	
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		// echo $this->session->userdata('logged_in')['id'];
		// echo'<pre>';print_r($_REQUEST);exit;
		
			//$item_id 					= $_REQUEST['item_name'];
			$item_id 					= $_REQUEST['item_number'];
			$data['txn_id']             = $_REQUEST['txn_id'];
			$data['txn_status']         = $_REQUEST['payment_status'];
			$data['purchased_on']  		= date('Y-m-d H:i:s');
			$data['amount']             = $_REQUEST['payment_gross'];
			$data['payment_status']		= 1;
			$data['payment_details']	= json_encode($_REQUEST);

			$data1['adv_id'] = $this->advertiseads->update('tbl_adv_package_purchased',$data,'id',$item_id);
			// $this->session->set_flashdata('response','');
		if($data1['adv_id']){
			$this->load->frontAdmin('advertise/thanku',$data1); 
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">There is some error. Please try again.</div>');
			$this->load->frontAdmin('advertise/add_advertise',$data); 
		}

		
	}
	function fail_add_advertise()
	{
		$this->session->set_flashdata('response','<div class="alert alert-danger">There is some error. Please try again.</div>');
		$this->load->frontAdmin('advertise/add_advertise'); 
	}
	
	public function updateimage()
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		
		if(isset($_FILES["banner_image"]) && !empty($_FILES["banner_image"]['name'])){
            $config['upload_path'] 	 = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] 	 = '200000';
            $config['max_width']  	 = '15000';
            $config['max_height']  	 = '8000';        
            $ext = explode('.',$_FILES["banner_image"]["name"]);        
            $imageName = 'ADD_'.time().'.'.end($ext);
            $config['file_name'] = $imageName;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('banner_image'))
            {
             $error = array('error' => $this->upload->display_errors()); 
			      
            }  
             $data['banner_image'] = $imageName;
			 
			 $advertise_id=$this->input->post('advertise_id');
			 $result = $this->advertiseads->update('tbl_adv_package_purchased',$data,'id',$advertise_id);
               
			   $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Successfully updated.</div>');
               redirect('advertise/advertise');
            }
		
	}
	
	
	 public function renew($id)
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		  $advertise = $this->user->get_record_by_field_name_all_record('tbl_adv_package_purchased','id',$id);
		 
		  if(count($advertise ))
		  {
		     $amount = $advertise[0]['amount'];
		 
		?>
			<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
				<input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="item_name" id="item_name" value="<?php echo $id;?>">
				<input type="hidden" name="item_number" value="1">
				<input type="hidden" name="credits" value="510">
				<input type="hidden" name="userid" value="1">
				<input type="hidden" name="amount" id="amount" value="<?php echo $amount; ?>">
				<input type='hidden' name='rm' value='2'>
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="handling" value="0">
				<input type="hidden" name="cancel_return" value="<?php echo site_url()?>/advertise/advertise">
				<input type="hidden" name="return" value="<?php echo site_url()?>/advertise/success_renew">
			</form>

				<script type="text/javascript">
					document.getElementById("frmPayPal1").submit();
				</script>           
		<?php 
		  }else
		  {
			  redirect('advertise/advertise');
		  }
		 
		
	}
	
	
	function success_renew()
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		if(!empty($_REQUEST)){
			
			$item_id = $_REQUEST['item_name'];			 
			$data['total_view']=0;
			$result = $this->advertiseads->update('tbl_adv_package_purchased',$data,'id',$item_id);
			$this->load->frontAdmin('advertise/thanku',$data); 
			
		} else {
			echo "There is some error. Please try again.";
		}
	}
	

	
	
	public function notification()
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>'); 
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{

			$this->load->frontAdmin('advertise/notification');
		
		}  else {  

			$uid = $this->session->userdata('logged_in')['id'];

			$data['subject'] 		= $this->input->post('subject');  
			$data['message'] 		= $this->input->post('message');  
			$data['user_id'] 		= $uid;  
			$data['added_on'] 		= date('y-m-d h:i:s');
			
		    $result = $this->user->save('tbl_notification',$data); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Notification sent.</div>');
				redirect('advertise/notification');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('advertise/notification');
			} 
		}
	}

	
	
	
	
	
	public function terms()
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		$data['terms']	= $this->dashboards_model->get_terms('advertiser');

		$this->load->frontAdmin('advertise/terms',$data);
	}

	public function enquiry()
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('type', 'Type', 'trim|required'); 
		$this->form_validation->set_rules('message', 'Message', 'trim|required');  

	 
		if($this->form_validation->run() == FALSE)
		{
			$this->load->frontAdmin('advertise/enquiry');
		}  
		else
		{ 
			$enquirydata = array(
				'etype' 		=> $this->input->post('type'),
				'email' 		=> $this->input->post('email'),
				'first_name' 	=> $this->input->post('first_name'),
				'subject' 		=> $this->input->post('type'),
				'message' 		=> $this->input->post('message')
			);	
			
		    $result = $this->user->save('tbl_enquiry',$enquirydata);  
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Thank you for your messgae.</div>');
				redirect('advertise/enquiry');
			}
			else
			{
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('advertise/enquiry');
			} 
		}
	}
	

	public function profile()
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		$uid = $this->session->userdata('logged_in')['id'];

		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
		$this->form_validation->set_rules('profession', 'Profession', 'trim|required'); 
		$this->form_validation->set_rules('location', 'Location', 'trim|required');  
		$this->form_validation->set_rules('address', 'Address', 'trim|required'); 

		$this->form_validation->set_rules('fb_url', 'Facebook Url', 'trim|required'); 
		$this->form_validation->set_rules('tw_url', 'Twitter Url', 'trim|required'); 
		$this->form_validation->set_rules('gpus_url', 'Google plus Url', 'trim|required'); 
		$this->form_validation->set_rules('insta_url', 'Instagram Url', 'trim|required'); 


		/*if (empty($_FILES['image']['name'])){
		$this->form_validation->set_rules('image', 'Image', 'trim|required'); 
		}*/

		if($this->form_validation->run() == FALSE)
		{

			$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
		    $this->load->frontAdmin('advertise/profile',$data);
		
		}  else {


			if(isset($_FILES["image"]['name']) && !empty($_FILES["image"]['name'])){
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["image"]["name"]);        
			$imageName = $ext[0].time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
			{
			   $error = array('error' => $this->upload->display_errors());                       
			   echo '<pre>';print_r($error); die;		
			}   
			
			  $data['image'] = $imageName;
			
			}



			if(isset($_FILES["logo"]['name']) && !empty($_FILES["logo"]['name'])){
				$ext="";
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '1500';
			$config['max_height']  = '800';        
			$ext = explode('.',$_FILES["logo"]["name"]);        
			$imageName = $ext[0].rand(9,99999999).'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('logo'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			} 
		    	$data['logo'] = $imageName;
			}
			
          if(isset($_FILES["backimage"]['name']) && !empty($_FILES["backimage"]['name'])){
				$ext="";
			$config['upload_path'] = './assets/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '200000';
			$config['max_width']  = '3000';
			$config['max_height']  = '1000';        
			$ext = explode('.',$_FILES["backimage"]["name"]);        
			$imageName = $ext[0].rand(9,99999999).'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('backimage'))
			{
			$error = array('error' => $this->upload->display_errors());                       
			} 
		    	$data['backimage'] = $imageName;
			}

			$data['name'] 		= $this->input->post('name'); 
			$data['role'] 	    = $this->input->post('profession'); 
			$data['profession'] 	= $this->input->post('category'); 
			//$data['price'] 		= $this->input->post('price'); 
			$data['location'] 	= $this->input->post('location');  
			$data['address'] 	= $this->input->post('address');  

			$data['fb_url'] 	= $this->input->post('fb_url');  
			$data['tw_url'] 	= $this->input->post('tw_url');  
			$data['gpus_url'] 	= $this->input->post('gpus_url');  
			$data['insta_url'] 	= $this->input->post('insta_url');  


			
		    $result = $this->user->update('tbl_user',$data,'id',$uid); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Profile updated successfully.</div>');
				redirect('advertise/profile');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('advertise/profile');
			} 
		}
	}

 public function tutorials()
	{
		if($this->session->userdata('logged_in')['id'] == ""){
				redirect('users');
		}
		// $data['misc'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_misc','status',1);
		$data['advertise'] 	= $this->dashboards_model->get_tutorial('advertise');
		$this->load->frontAdmin('advertise/tutorials',$data);
	}
	
	
}
