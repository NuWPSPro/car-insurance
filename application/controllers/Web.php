<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function  __construct()
    {
        parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->model('Users_model','users_model');
		$this->load->model('institution_model','institution');  
		// $this->load->model('Share_model','share'); //already in autoload 
		$this->data = $this->get_data();
    }


	public function _remap($method,$submethod=NULL)
	{
		if (method_exists($this, $method))
		{  
			$this->$method();
		}
		else { 
			$this->index($method,$submethod);
		}
	}

	public function index($method,$submethod)
	{  
		
		$iid = $this->uri->segment(2);
		$insid = end(explode('-',$method)); 
		$certificateData = $this->user->get_record_by_field_name_all_record('tbl_user','id',$insid);
		$facebookshare = $this->share->get_row_array('tbl_user','id',$insid);
		// echo $this->db->last_query();
		// print_r($certificateData);
		if(empty($certificateData)){
			redirect(BASE_URL, 'refresh');
		} else {
		  	$data['certificateData'] = $certificateData;

			$data['og_description'] =  $facebookshare['tag_line'];
			$data['og_title'] 		=  $facebookshare['name'];
			$data['og_image'] 		=  base_url('assets/images/uploads/'.$facebookshare['backimage']);
			$data['og_url'] 		=  base_url('web/'.$facebookshare['insititution_id']);
			$data['og_type'] 		=  'website';

			$insArr 	= $this->data['insArr'];
			$insidArr 	= $this->data['insidArr'];
			$user_id 	= $this->data['fulldetails']['details']->id;
			$blogwhere 	= $this->data['blogwhere'];
			$data['course_list'] 	= $this->institution->getcourseUnderIns($insArr);
			$data['trainin_list'] 	= $this->institution->gettrainingUnderIns($insArr);
			$data['ceproviders'] 	= $this->share->get_provider_under_institution($insidArr);
			$data['authorlist']     = $this->share->get_author_under_institution($insidArr);
			$data['subinss'] 		= $this->institution->getsubInstitutions($user_id);
			$data['blogs'] 			= $this->share->get_blog_under_institution($blogwhere);
			// echo $this->db->last_query();die;
			$this->load->frontAdmin('pages/webpage',$data);
 		}
	}


	
	public function filter()
	{	
		$iid = $this->uri->segment(2);
		$method = $_REQUEST['method'];
		$insid = end(explode('-',$method)); 
		$certificateData = $this->user->get_record_by_field_name_all_record('tbl_user','id',$insid);
		$facebookshare = $this->share->get_row_array('tbl_user','id',$insid);
		/* echo 'heloo'; */	
		$data['certificateData'] = $certificateData;	
	
		$data['og_description'] =  $facebookshare['tag_line'];
		$data['og_title'] 		=  $facebookshare['name'];
		$data['og_image'] 		=  base_url('assets/images/uploads/'.$facebookshare['backimage']);
		$data['og_url'] 		=  base_url('web/'.$facebookshare['insititution_id']);
		$data['og_type'] 		=  'website';

		$insArr 	= $this->data['insArr'];
		$insidArr 	= $this->data['insidArr'];
		$user_id 	= $this->data['fulldetails']['details']->id;
		$blogwhere 	= $this->data['blogwhere'];
		$data['course_list'] 	= $this->institution->getcourseUnderIns($insArr);
		$data['trainin_list'] 	= $this->institution->gettrainingUnderIns($insArr);
		$data['ceproviders'] 	= $this->share->get_provider_under_institution($insidArr);
		$data['authorlist']     = $this->share->get_author_under_institution($insidArr);
		$data['subinss'] 		= $this->institution->getsubInstitutions($user_id);
		$data['blogs'] 			= $this->share->get_blog_under_institution($blogwhere);
		
	  	$this->load->frontAdmin('pages/webpage',$data);
	}

	public function get_data(){
				 
		$segment = $this->uri->segment(2);
		$uid = end(explode('-',$segment)); 
		$fulldetails 	= $this->share->getuser_info($uid,5);
		$data[] = '';
		$data['fulldetails'] 	= $fulldetails;

		// echo '<pre>'; print_r($data);die;
		if($fulldetails['child_info']){
			$data['insidArr'] = array_column($fulldetails['child_info'],'cid');
			array_push($data['insidArr'] ,$uid);
			$data['insArr'] = array_column($fulldetails['child_info'],'cinsititution_id');
			array_push($data['insArr'] ,$fulldetails['details']->insititution_id);
		}else{
			$data['insidArr'] = array($uid);
			$data['insArr'] = array($fulldetails['details']->insititution_id);
		}

		if(isset($fulldetails['cep_info']) && $fulldetails['cep_info'] !=''){
			$cepArr 	= array_column($fulldetails['cep_info'],'cepid');
			$data['blogwhere'] 	= array_merge($data['insidArr'],$cepArr);
		}else{
			$data['blogwhere'] 	= $data['insidArr'];
		}
		return $data;
	}
	 
}
?>