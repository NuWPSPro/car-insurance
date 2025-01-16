<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function  __construct()
    {
        parent::__construct();
		$this->load->model('Certificate_model','certificate_model'); 
		$this->load->model('professional_model','professional_model'); 
		$this->load->model('dashboards_model');  
		$this->load->model('Share_model','share'); 
		$this->load->model('Pages_model'); 
		$this->load->model('Provider_model','provider'); 
		$this->load->model('Institution_model','institution'); 
    }

	public function index()
	{
		
		$data['company'] 	= $this->provider->getInsuranceCompany_list();
		$data['insurance'] 	= $this->provider->get_all_published_insurance_sale();
		$data['brokers'] 	= $this->provider->getBrokerList();
		// echo '<pre>'; print_r($data); die;
		$this->load->view('template/header_home');
		$this->load->view('pages/home',$data);
		$this->load->view('template/footer_home',$data);
	}

	public function courses()
	{
		$data['insurance'] = $this->user->get_all_published_insurance_sale();

		$this->load->view('template/header_home');
		$this->load->view('pages/courses',$data); 
		$this->load->view('template/footer_home');
	}



  	public function details($id)
	{
		
		$course = $this->share->get_row_array('tbl_course','id',$id);

		$data['og_description'] =  strip_tags($course['course_description']);
		$data['og_title'] 		=  $course['course_title'];
		$data['og_image'] 		=  base_url('assets/images/uploads/'.$course['course_photo']);
		$data['og_url'] 		=  base_url('pages/course_details/'.$course['id']);
		$data['og_type'] 		=  'Insurance Package';

		$this->load->view('template/header_home',$data);
		$this->load->view('pages/course_details',$data);
		$this->load->view('template/footer_home');
	}

	public function buyCarInsurance()
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($uid==""){ redirect('users'); }
		$check = $this->check_already_buy_car_insurance($this->input->post('insurance_id'),$uid);
		
		if($check==true){
			$this->session->set_flashdata('response', ['class'=>'danger','msg'=>'You have alraedy applied for this insurance.']);
			redirect(base_url()); die;
		}
		$insert = [
			'user_id'	=>	$uid,
			'fname'		=>  $this->input->post('fname'),
			'lname'		=>  $this->input->post('lname'),
			'name'		=>  $this->input->post('name'),
			'email'		=>  $this->input->post('email'),
			'mobile'	=>  $this->input->post('mobile'),
			'insurance_id'=>$this->input->post('insurance_id'),
			'company_id'=>  $this->input->post('company_id'),
			'broker_id'=>  $this->input->post('broker_id'),
			'added_on'	=>	date('Y-m-d')
		];

		$result = $this->user->save('tbl_buy_insurance',$insert);
		// echo $this->db->last_query(); die;
		if($result){
			$this->session->set_flashdata('response', ['class'=>'success','msg'=>'Query Sent successfully, we will let you soon.']);
		}else{
			$this->session->set_flashdata('response', ['class'=>'danger','msg'=>'There is some error please try again.']);
		}
		redirect(base_url());
	}

	public function check_already_buy_car_insurance($ins_id,$uid){
		$result = $this->db->get_where('tbl_buy_insurance',array('insurance_id'=>$ins_id,'user_id'=>$uid))->row();
		if($result != ''){
			return true;
		}else{
			return false;
		}
	} 

	public function viewer_counter()
	{
		$this->load->library('user_agent');
		// if ($this->agent->mobile()){ echo $this->agent->mobile(); }
		// echo $this->agent->browser();
		// echo $this->agent->version();
		// echo $this->agent->platform();
		
		$ip = $this->agent->version();
		$result = $this->db->get_where('tbl_viewer_counter',array('ip_address'=>$ip))->row_array();
		
		if(!empty($result)){
			$counts = $result['count'] + 1;
			$update = array(
				'count' => $counts,
				'added_on' => date('Y-m-d H:i:s')
			);
			$this->user->update('tbl_viewer_counter',$update,'ip_address',$ip);
		}else{
			$viewer = array(
				'count' 	 => 1,
				'ip_address' => $this->agent->version(),
				'added_on' 	 => date('Y-m-d H:i:s')
			);
			$this->user->save('tbl_viewer_counter',$viewer);
		}
		return true;
	}


	public function cpdprovider()
	{ 
		$data['provider_promote'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_promoted_provider','status',1);

		$this->load->view('template/header_home');
		$this->load->view('pages/cpdprovider',$data);
		$this->load->view('template/footer_home');
	}

	public function latestprofessional()
	{ 
		$param['category'] = $this->input->get('category');
		$param['country_id'] = $this->input->get('country');
		$wheres['name'] = $this->input->get('professional_title');
		$where = array();
		if(!empty($this->session->userdata('current_country'))&& $this->session->userdata('current_country')!='home')
		   {
			 $param['country_id'] = $this->session->userdata('current_country'); 
		   }
		if(!empty($wheres['name']))
		{
			$this->db->like('tp.name',$wheres['name'],'%');
			$data['professional'] = $this->professional_model->get_fetured_professionals($where);
		}else{
			if(!empty($param['country_id'])){ $this->db->where('tp.country_id',$param['country_id']); }
			$data['professional'] = $this->professional_model->get_fetured_professionals($where);
		}

		$data['param'] =$param;
		$data['cat'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
		$this->db->order_by('countries_name','ASC');
		$data['countries'] = $this->user->get_countries();
		$this->load->view('template/header_home');
		$this->load->view('pages/latestprofessional',$data);
		$this->load->view('template/footer_home');
	}

	public function ceprovider()
	{ 
		$country_id = $this->session->userdata('current_country');
		if($_GET){
			if(!empty($_GET['category'])){	$where['profession']	= $_GET['category'];}
			if(!empty($_GET['country'])){	$where['country'] 		= $_GET['country'];}
			if(!empty($_GET['ceprovider_title'])){	$wheres['name'] = $_GET['ceprovider_title'];
			$this->db->like('name',$wheres['name'],'%'); }
			$flag = 1;
		}else{
			if(!empty($country_id)&& $country_id!='home'){$where['country'] = $country_id;}
			$flag = 0;
		}
		$where['under_insititution'] = 0;
		$where['parent_insititution']= 0;

		$data['free_provider'] 	= $this->user->getProviders($where);

		// $where['featured_from <='] = date('Y-m-d');
		// $where['featured_to >='] = date('Y-m-d');
		$data['promoted_provider'] 	= $this->user->getProviders($where);
		$data['catategory'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
		$this->db->order_by('countries_name','ASC');
		$data['countries'] = $this->user->get_countries();
		$data['flag'] = $flag;
		$data['param'] = $where;
		$this->load->view('template/header_home');
		$this->load->view('pages/ceprovider',$data);
		$this->load->view('template/footer_home');
	}


	public function authors()
	{ 
		// ini_set('display_errors', 1);
		$param['category'] = $this->input->get('category');
		$param['country_id'] = $this->input->get('country');
		$param['name'] = $this->input->get('ceprovider_title');
		if(!empty($this->session->userdata('current_country')) && $this->session->userdata('current_country')!='home'){
			$param['country_id'] = $this->session->userdata('current_country'); 
		}
		$where=array();
		$flag=0;
		if(!empty($param['category'])){
			$where['profession']=$param['category'];
			$flag=1;
		}
		if(!empty($param['country_id'])){
			$where['country'] = $param['country_id'];
			$flag=1;
		}
		if(!empty($param['name'])){
			$wheres['name'] = $param['name'];
			$flag=1;
		}
		
		if($flag==1){
			$data['free_provider'] = $this->user->getAuthors($where);
			// $where['featured_from <=']=date('Y-m-d');
			// $where['featured_to >=']=date('Y-m-d');
		}

		if(empty($param['name'])){
			$this->db->where('tbl_user.under_insititution','0');
			$data['authors'] = $this->user->getAuthors($where);
		}else{
			$this->db->where('tbl_user.under_insititution','0');
			$data['authors'] = $this->user->getAuthors_like($wheres);
		}

        $data['param'] = $param;
		$data['flag'] = $flag;
		$this->load->view('template/header_home');
		$this->load->view('pages/author',$data);
		$this->load->view('template/footer_home');
	}

	public function cpAauthor(){
		$data = array(); 
		$filterOC[]='';
		$data['freecourse'] 	 = $this->share->get_online_course($filterOC);
		$data['faq_author_list'] = $this->user->get_record_by_multi_field_name('tbl_faq',array('role'=>'5','status'=>'1'));
		$where1 = array('role'=>2,'status'=>1);
		$this->db->order_by('name','ASC');
		$data['providers'] = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
		$data['countries'] = $this->user->get_countries();
		$this->load->view('template/header_home');
		$this->load->view('pages/cpaauthor',$data);
		$this->load->view('template/footer_home');
	}

	public function rboards()
	{ 
		// ini_set('display_errors', 1);
		$param['category'] = $this->input->get('category');
		$param['country_id'] = $this->input->get('country');
		$param['name'] = $this->input->get('ceprovider_title');
		if(!empty($this->session->userdata('current_country')) && $this->session->userdata('current_country')!='home'){
			$param['country_id'] = $this->session->userdata('current_country'); 
		}
		
		$data['rboards'] = $this->share->get_rboard();
        $data['param'] = $param;
		$this->load->view('template/header_home');
		$this->load->view('pages/rboard',$data);
		$this->load->view('template/footer_home');
	}




	public function cfvalidation()
	{ 
		$data['professional'] = $this->user->get_record_by_field_name_all_record('tbl_professionals','status',1);

		$this->load->view('template/header_home');
		$this->load->view('pages/cfvalidation',$data);
		$this->load->view('template/footer_home');
	}

	public function blog()
	{ 
		$country = $this->input->post('country');
		if(!empty($this->session->userdata('current_country'))&& $this->session->userdata('current_country')!='home')
		   {
			 $country = $this->session->userdata('current_country'); 
		   }

		$data['param'] = $country;
		if(!empty($country)){
			$this->db->where('country',$country);
		}
		$this->db->where(array('user_role !='=>'5','under_ins'=>'0'));
		$data['blog'] = $this->db->where('status','1')->get('tbl_blog')->result_array(); 

		$this->load->view('template/header_home');
		$this->load->view('pages/blog',$data);
		$this->load->view('template/footer_home');
	}

	public function blog_details($id="")
	{ 
	    $c_cnty=$this->session->userdata('current_country');
		$data['param'] = $c_cnty;
		$blog = $this->share->get_row_array('tbl_blog','id',$id);
		$data['blog'] = $blog;
		$data['blogs'] = $this->share->get_blogs_by_same_cep($blog['user_id'],$id);
		$this->db->where('status','1');
		$this->db->order_by('id','Desc');
		$data['comments'] = $this->user->get_record_by_field_name_all_record('tbl_blog_comments','blog_id',$id);
		// echo base_url('assets/upload/blog/'.$data['blog'][0]['image']); die;
		$data['og_description'] =  strip_tags($blog['st_desc']);
		$data['og_title'] 		=  $blog['title'];
		$data['og_image'] 		=  base_url('assets/upload/blog/').$blog['image'];
		$data['og_url'] 		=  base_url('pages/blog_details/').$blog['id'];
		$data['og_type'] 		= 'website';
		$this->load->view('template/header_home',$data);
		$this->load->view('pages/blog_details',$data);
		$this->load->view('template/footer_home');
	}
	
	
	public function blog_comments($bid)
	{
		$uid = $this->session->userdata('logged_in')['id'];
		if($this->input->post()){
			$insert = array(
				'blog_id' 		=> $bid,
				'comment_by' 	=> $uid,
				'comment' 		=> $this->input->post('comment'),
				'status' 		=> 1,
				'added_at' 		=> date('Y-m-d H:i:s'),
			);
		$result = $this->user->save('tbl_blog_comments',$insert);
		if($result){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Thankyou for your comment.</div>');
			redirect('pages/blog_details/'.$bid);
		}
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('pages/blog_details/'.$bid);
		}
	}
	public function advertise()
	{ 
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

		$this->db->group_by('country'); 
		$countryllist =  $this->db->get_where('tbl_user',array('status'=>1,'country !='=> 0))->result_array();
		$data['totalCountries'] = sprintf("%02d", count($countryllist));

		$where = array('');
		$viewerlist = $this->user->get_record_by_multi_field_name('tbl_viewer_counter',$where);
		$data['totalViewers'] = sprintf("%02d", array_sum(array_column($viewerlist, 'count')));
	  
		$data['advertise'] = $this->user->get_record_by_field_name_all_record('tbl_adv_package','status',1); 
		$this->load->view('template/header_home');
		$this->load->view('pages/advertise',$data);
		$this->load->view('template/footer_home');
	}
	
	public function plans(){ 
		$uid = $this->session->userdata('logged_in')['id'];
	  	$data['plansArr'] 			= $this->professional_model->planlisting(2);
        $data['basicplansArr']		= $this->professional_model->planlisting(1);
        $data['premiumplansArr'] 	= $this->professional_model->planlisting(3);
        $checkactiveplanArr 		= $this->professional_model->checkactiveplan($uid);
		$data['currentplanArr'] 	= $checkactiveplanArr;
		$data['connected_rboard'] = $this->professional_model->getConnnectedRboard($uid);
		
		$expiry		= strtotime($checkactiveplanArr->plan_expiry_at);
		$today		= strtotime(date('Y-m-d'));
		$remaindays	=  $expiry - $today;
		$data['dayreamaining'] = floor($remaindays / (60 * 60 * 24)); 
		$this->load->view('template/header_home');
		$this->load->view('pages/plans',$data);
		$this->load->view('template/footer_home');
	}

	public function cepercountry()
	{ 
		$data['professional'] = $this->user->get_record_by_field_name_all_record('tbl_professionals','status',1);

		$this->load->view('template/header_home');
		$this->load->view('pages/cepercountry',$data);
		$this->load->view('template/footer_home');
	}

	public function ceprovideplateform()
	{ 
		$data['professional'] = $this->user->get_record_by_field_name_all_record('tbl_professionals','status',1);

		$this->load->view('template/header_home');
		$this->load->view('pages/ceprovideplateform',$data);
		$this->load->view('template/footer_home');
	}

	public function cetracker(){ 

		$uid = $this->session->userdata('logged_in')['id'];
        $checkactiveplanArr 		= $this->professional_model->checkactiveplan($uid);
		$expiry		= strtotime($checkactiveplanArr->plan_expiry_at);
		$today		= strtotime(date('Y-m-d'));
		$remaindays	=  $expiry - $today;

		$filterOC[] = ''; 
		$filterT[] = '';

		$data['currentplanArr']  = $checkactiveplanArr;
	  	$data['plansArr'] 		 = $this->professional_model->planlisting(2);
        $data['basicplansArr']	 = $this->professional_model->planlisting(1);
        $data['premiumplansArr'] = $this->professional_model->planlisting(3);
		$data['dayreamaining'] 	 = floor($remaindays / (60 * 60 * 24));
		$data['freecourse'] 	 = $this->share->get_online_course($filterOC);
		$data['seminar'] 		 = $this->share->get_training($filterT);
		$data['professionals'] 	 = $this->share->get_professionals();
		$data['institutions'] 	 = $this->share->get_institutions();

		$this->load->view('template/header_home');
		$this->load->view('pages/cetracker',$data);
		$this->load->view('template/footer_home');
	}

	public function Institutionspage()
	{ 
		$this->db->order_by('countries_name','ASC');
		$data['countries']   = $this->user->get_countries();
		$data['institution'] = $this->user->getInstitutions();
        $data['category']    = $this->db->get_where('tbl_category_institution',array('status'=>'1'))->result_array(); 

		$where = array();
        if($_GET){
        	// print_r($_GET);die;
        	if(!empty($_GET['institution'])){	$where['name']		 = $_GET['institution'];}
			if(!empty($_GET['country']))	{	$where['country'] 	 = $_GET['country'];	}
			if(!empty($_GET['categor']))	{	$where['profession'] = $_GET['categor'];	}
			// if(!empty($_GET['institute_title'])){	$wheres['institute_title'] = $_GET['institute_title'];
			// $this->db->like('name',$wheres['institution'],'%'); }
			$flag = 1;
        }else{
			$flag = 0;
        }
			$c_country = $this->session->userdata('current_country');
			if(!empty($c_country ) && $c_country !='home'){ 
				$where['country'] = $c_country ;   
			}
	
		$data['param'] = $where;	
        $data['institutions'] = $this->user->getInstitutions($where); 
        $data['demoinstitutions'] = $this->institution->getDemoInstitutions(); 
		$this->load->view('template/header_home');
		$this->load->view('pages/Institutionspage',$data);
		$this->load->view('template/footer_home');
	}

	public function InstitutionCEPlatform(){ 
		$data['professional'] = $this->user->get_record_by_field_name_all_record('tbl_professionals','status',1);
		$data['ins_list'] 	  = $this->user->getInstitutions('');
		$data['package_list'] = $this->dashboards_model->get_dcpscriptions();
		// echo $this->db->last_query();
		$this->load->view('template/header_home');
		$this->load->view('pages/InstitutionCEPlatform',$data);
		$this->load->view('template/footer_home');
	}

	public function InstitutionCEwebpage()
	{ 
		$data['professional'] = $this->user->get_record_by_field_name_all_record('tbl_professionals','status',1);

		$this->load->view('template/header_home');
		$this->load->view('pages/InstitutionCEwebpage',$data);
		$this->load->view('template/footer_home');
	}
	public function Institutionspercountry()
	{ 
		$data['professional'] = $this->user->get_record_by_field_name_all_record('tbl_professionals','status',1);

		$this->load->view('template/header_home');
		$this->load->view('pages/Institutionspercountry',$data);
		$this->load->view('template/footer_home');
	}

	// public function trainingpercountry()
	// { 
	// 	$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','status',1);

	// 	$this->load->view('template/header_home');
	// 	$this->load->view('pages/trainingpercountry',$data);
	// 	$this->load->view('template/footer_home');
	// }




	public function checkcourselogin()
	{
		$courseid = $this->session->userdata('current_course_id');
		if($courseid==""){
		redirect('users');
		}
	}  

	public function training_old($date=false)
	{	
		// ini_set('display_errors', 1);
        $cat = $this->input->get('category');		
		$country_id = $this->input->get('country');
		$start_date = $this->input->get('start_date');
		$training_title = $this->input->get('training_title');
		if(!empty($this->session->userdata('current_country'))&& $this->session->userdata('current_country')!='home')
		   {
			 $country_id = $this->session->userdata('current_country'); 
		   }
        $where = array();
	    $whereflag = 0;
		if($cat)
			{
			  $where['category_id']=$cat;  
			  $whereflag=1;
			}
		if($start_date)
			{
			 $where['start_date']=$start_date; 
	         $whereflag=1;		 
			}
		if($training_title)
			{
			 $wheres['title']=$training_title; 
	         $whereflag=1;		 
			}
		if($country_id)
		   {
			 $where['country_id']=$country_id;
	         $whereflag=1;		 
		   }
		$profWithoutIns = $this->db
		->where(array('status'=>1,'role'=>2))
		->or_where(array('parent_insititution'=>0,'parent_insititution'=>NULL))
		->get('tbl_user')->result_array();
		foreach($profWithoutIns as $arr => $a){
                    $ins[] = $profWithoutIns[$arr]["id"];
                }
		$data['param']=$where;
		$data['whereflag']=$whereflag;
		
		if(empty($training_title)){
			$where['status']=1;
			$where['paid_status']=2;
			$where = array('start_date >='=>date('Y-m-d'));
			$this->db->where_in('user_id',$ins);
			$data['seminar'] = $this->user->get_training($where);
			// echo $this->db->last_query();
		}else{
			$where = array('status'=>1,'paid_status'=>2,'start_date >='=>date('Y-m-d'));
			$this->db->where($where);
			$this->db->where_in('user_id',$ins);
			$data['seminar'] = $this->user->get_training_like($wheres);
		}
			
		$where = array('status'=>1,'paid_status'=>1,'start_date >='=>date('Y-m-d'));
		$data['free_seminar'] = $this->user->get_training($where); 
		// echo'<pre>';print_r($this->db->last_query());die;
		$this->load->view('template/header_home');
		$this->load->view('pages/training',$data);
		$this->load->view('template/footer_home');
	}

	public function training($date=false)
	{	
		$country_id = $this->session->userdata('current_country');
		if($_GET){
			if(!empty($_GET['category']))		{	$where['category_id']	= $_GET['category'];	}
			if(!empty($_GET['country']))		{	$where['country'] 		= $_GET['country'];		}
			if(!empty($_GET['start_date']))		{	
				$date = explode('-',$_GET['start_date']);
				$this->db->where('YEAR(tbl_training.start_date) =',$date[0]); 
				$this->db->where('MONTH(tbl_training.start_date) =',$date[1]); 	
				// $where['start_date'] 	= $_GET['start_date'];	
			}
			if(!empty($_GET['training_title'])) {	$wheres['title'] 		= $_GET['training_title'];
			$this->db->like('title',$wheres['title'],'%'); }
			$flag = 1;
		}else{
			if($country_id && $country_id != 'home'){ $where['country'] = $country_id; }
			$flag = 0;
		}

		// $where['featured_from <='] = date('Y-m-d');
		$where['status'] = 2; //Published
		$where['end_date >='] = date('Y-m-d');
		$this->db->where('insititution_id','0');
		$data['seminar'] = $this->user->get_training($where);
		// echo $this->db->last_query();
		$this->db->where('insititution_id','0');
		$data['free_seminar'] = $this->user->get_training($where);

		$data['catategory'] = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
		$data['countries'] = $this->user->get_countries();
		$data['flag'] = $flag;
		$data['param'] = $where;
		$this->load->view('template/header_home');
		$this->load->view('pages/training',$data);
		$this->load->view('template/footer_home');
	}



	public function training_category($cat=false)
	{ 

		$data['free']     = $this->user->get_seminar_category('tbl_training','paid_status',1,$cat); 
		$data['featured'] = $this->user->get_seminar_category('tbl_training','paid_status',2,$cat); 
		$data['toplist']  = $this->user->get_seminar_category('tbl_training','paid_status',3,$cat); 
		$data['premium']  = $this->user->get_seminar_category('tbl_training','paid_status',4,$cat); 


		$this->load->view('template/header_home');
		$this->load->view('pages/training_category',$data);
		$this->load->view('template/footer_home');
	}


	public function training_details($id)
	{
		$data['seminar']   = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);
		$seminar   = $this->share->get_row_array('tbl_training','id',$id); 
		$data['training']  = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);
		$data['speaker']   = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$id);
		$data['schedule']  = $this->user->get_record_by_field_name_all_record('tbl_training_schedule','training_id',$id);
		$data['sponsors']  = $this->user->get_record_by_field_name_all_record('tbl_training_sponsors','training_id',$id);
		$data['committee'] = $this->user->get_record_by_field_name_all_record('tbl_training_committee','training_id',$id);

        $data['tprofessional']  = $this->user->get_record_by_field_name_all_record('tbl_user',array('role'=>1,'status'=>'1','disabled_by'=>'0'),'');
        $data['tprovider'] 	    = $this->user->get_record_by_field_name_all_record('tbl_user',array('role'=>2,'status'=>'1','disabled_by'=>'0'),'');
        $data['tInstitutions']  = $this->user->get_record_by_field_name_all_record('tbl_user',array('role'=>5,'status'=>'1','disabled_by'=>'0'),'');
        $data['tTotalAuthor']   = $this->user->get_record_by_field_name_all_record('tbl_user',array('role'=>6,'status'=>'1','disabled_by'=>'0'),'');
        $data['tTotalTraining'] = $this->user->getuniqecountryTraining();
        $data['tTotalCource']   = $this->user->getuniqecountryCountry();
        $data['ttraining']      = $this->db->where(array('status'=>2,'end_date >=',date('Y-m-d')))->get('tbl_training')->result_array();
        $data['tcourse']        = $this->db->where(array('status'=>1,'course_validity >=',date('Y-m-d')))->get('tbl_course')->result_array();
        $data['tCountry']        = $this->db->where(array('status'=>1,'display'=>'Yes'))->get('countries')->result_array();
				
		$uid = $seminar['user_id'];
		$parentid = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['parent_insititution']; 
		$parent_details = $this->db->get_where('tbl_user',array('id'=>$parentid))->row_array();
		if($parent_details['under_insititution'] == '0'){
			$data['back_webpage'] = $parent_details['insititution_id'];
		}else{
			$mainparent_details = $this->db->get_where('tbl_user',array('id'=>$parent_details['parent_insititution'],'under_insititution'=>'0'))->row_array(); 
			$data['back_webpage'] = $mainparent_details['insititution_id'];
		}
		
        $data['categorylist']  = $this->user->get_record_by_field_name_all_record('tbl_registration_category',array('status'=>'1','training_id'=>$id),'');
        $data['og_description'] =  strip_tags($seminar['sub_title']);
		$data['og_title'] 		=  $seminar['title'];
		$data['og_image'] 		=  base_url('assets/images/uploads/'.$seminar['thumb_img']);
		$data['og_url'] 		=  base_url('pages/training_details/'.$seminar['id']);
		$data['og_type'] 		=  'website';
		
		$data['ttprovider_id'] 	=  $uid;
		
		$numOfparticipants = explode(",",$data['training'][0]['category_id']);

		$participants = $this->db->where_in('id',$numOfparticipants)->get('tbl_category')->result_array();
		$nameOfParticipants = array_column($participants,'cat_name');
		$data['training'][0]['participants'] = implode(',',$nameOfParticipants);
		
		$tempno = $data['training'][0]['templates'];

		if($tempno > 0 && $data['training'][0]['training_type']==1){
			$this->load->view('pages/template'.$tempno.'',$data);
		} else {
		$this->load->view('template/header_home',$data);
		$this->load->view('pages/training_details',$data);
		$this->load->view('template/footer_home');

		}



	}

	public function trainingpercountry($cat=false)
	{

		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','status',1);
	 
		$this->load->view('template/header_home');
		$this->load->view('pages/trainingpercountry',$data);
		$this->load->view('template/footer_home');

	}


	public function trainingcountry($id)
	{
		
		$data = $this->db->where(array('country_id'=>$id))->get('tbl_training')->result_array();
		foreach ($data as  $value) {
	 		$res.="<option value=".$value['id'].">".$value['location']."</option>";
		}
		echo $res;
	}

	public function training_management($cat=false){  
		$where['status'] = 2; //Published
        $where['end_date >='] = date('Y-m-d');
        $data['training'] = $this->user->get_training($where);
        $this->db->order_by('cat_name','ASC');
        $data['category'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category','status',1);
        $this->db->order_by('countries_name','ASC');
		$data['countries'] = $this->user->get_countries();
		$data['tax'] = $this->share->get_all_tax(6);
		
		$this->load->view('template/header_home');
		$this->load->view('pages/training_management',$data);
		$this->load->view('template/footer_home');

	}



	public function training_details_overview($id)
	{

		$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id); 
		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);
	    $numOfparticipants = explode(",", $data['seminar'][0]['participants']);

		$participants = $this->db->where_in('id',$numOfparticipants)->get('tbl_category')->result_array();
		foreach($participants as $key => $participant){
			$nameOfParticipants[] = $participants[$key]['cat_name'];
		}
		if(count($numOfparticipants) > 0){
		$string_version = implode(",",(array)$nameOfParticipants);
		$data['seminar'][0]['participants'] = $string_version;
		}
		$this->load->view('template/header_home');
		$this->load->view('pages/training_details_overview',$data);
		$this->load->view('template/footer_home');

	}

	public function training_details_schedule($id)
	{

		$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id); 
		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);
	 
		$this->load->view('template/header_home');
		$this->load->view('pages/training_details_schedule',$data);
		$this->load->view('template/footer_home');

	}	


	public function training_details_speaker($id)
	{

		$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id); 
		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);
	 
		$this->load->view('template/header_home');
		$this->load->view('pages/training_details_speaker',$data);
		$this->load->view('template/footer_home');

	}	

	public function training_details_evaluation($id)
	{

		$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id); 
		$data['training'] = $this->user->get_record_by_field_name_all_record('tbl_training','id',$id);
	 
		$this->load->view('template/header_home');
		$this->load->view('pages/training_details_evaluation',$data);
		$this->load->view('template/footer_home');

	}

	public function country($country)
	{
		
		// if(isset($country) && $country=="home"){
		// 	$this->session->set_userdata('current_country', $country);			
		// 	redirect('pages/index');			
		// }
        $this->session->set_userdata('current_country', $country);	
		
		$data['latestprofessionallist'] = $this->user->get_record_by_field_name_all_record('tbl_professionals',array('pro_status'=>'1','user_type'=>'1','country_id'=>$country),'');
		$this->db->where('country',999);
		$this->db->or_where('country', $country);
		$this->db->order_by('id','DESC'); 
		$data['blogs'] = $this->user->get_record_by_field_name_all_record('tbl_blog',array('user_role'=>'10','status'=>'1'),'');
		$data['authors'] = $this->user->getAuthors(array('country'=>$country));		 
		$where = array('status'=>1,'country_id'=>$country);         
		$data['freecourse'] = $this->user->get_record_course_by_country('tbl_course',$where);
        $this->db->where('country_id',$country); 
        $data['seminar'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training','status',1); 
      
		$data['advertise_listing'] = $this->user->getadvertisement();
		//$data['freecourse'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','status',1);
		$data['provider_promote'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_promoted_provider','status',1);
		$data['exam']  = $this->user->get_record_by_field_name_all_record_limit('tbl_guide','types','exam');
		$data['guide'] = $this->user->get_record_by_field_name_all_record_limit('tbl_guide','types','guide');
		$data['country_id'] = $country; 
		$this->load->view('template/header_home');
		$this->load->view('pages/country_course',$data);
		$this->load->view('template/footer_home');
	}




  	public function courselist($cat=false)
	{
		$stts=1; 
		$data['allcourse'] = $this->user->courselisting('tbl_course','status',1,$cat);
		$this->load->view('template/header_home');
		$this->load->view('pages/courselist',$data);
		$this->load->view('template/footer_home');
	}


  	public function traininglist($cat=false)
	{
		$stts=1; 
		$data['allcourse'] = $this->user->courselisting('tbl_course','status',1,$cat);
		$this->load->view('template/header_home');
		$this->load->view('pages/courselist',$data);
		$this->load->view('template/footer_home');
	}




  public function lesson($id)
	{
// $isloggin = $this->session->userdata('logged_in')['id'];
// if(empty($isloggin))
// {
// 	return redirect("users");	
// }
		$stts=1;
		$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','status',$stts);
		$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
		
		$data['lesson'] = $this->user->get_record_by_field_name_all_record('tbl_lesson','course_id',$id);

		$this->load->view('template/header_home');
		$this->load->view('pages/lesson',$data);
		$this->load->view('template/footer_home');

	}



  public function lesson_details($id)
	{
	$isloggin = $this->session->userdata('logged_in')['id'];
	if(empty($isloggin))
	{
		return redirect("users");	
	}

		$id =  $idd = $this->uri->segment(4); 
	$data['lesson'] = $this->user->get_record_by_field_name_all_record('tbl_lesson','id',$id);

		$this->load->view('template/header_home');
		$this->load->view('pages/lesson_details',$data);
		$this->load->view('template/footer_home');

	}
	



  public function evaluation($id)
	{
		$isloggin = $this->session->userdata('logged_in')['id'];
		$stts=1;
		$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','status',$stts);
		$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
		$data['evaluation'] = $this->user->get_record_by_field_name_all_record('tbl_evaluation','course_id',$id);
		$this->load->view('template/header_home');
		$this->load->view('pages/evaluation',$data);
		$this->load->view('template/footer_home');
	}

	public function report_abuse($id)
	{
		// ini_set('display_startup_errors', 1);
		// ini_set('display_errors', 1);
		// error_reporting(-1);
		$isloggin = $this->session->userdata('logged_in')['id'];

		if($this->input->post('comment')){
			$report=array(
				'user_id'=>$isloggin,
				'course_id'=>$id,
				'comment'=>$this->input->post('comment'),
				'added_on'=>date('Y-m-d'),
			);
			$result = $this->user->save('tbl_abuse_report',$report);		
				if($result){
					$this->session->set_flashdata('response-s','<div class="alert alert-success" role="alert"> Your Report has been submmited successfully.</div>');
				}
		}
		$stts=1;
		$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','status',$stts);
		$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
		$data['evaluation'] = $this->user->get_record_by_field_name_all_record('tbl_evaluation','course_id',$id);	

		$this->load->view('template/header_home');
		$this->load->view('pages/report_abuse',$data);
		$this->load->view('template/footer_home');
	}
		

	public function certificate($id)
	{ 
		$uid = $this->session->userdata('logged_in')['id'];
		$uname = $this->session->userdata('logged_in')['name'];
		$uemail = $this->session->userdata('logged_in')['username'];
		$data['exam_details'] = $this->user->get_exam_detail($id,$uid);  
 		$data['course_details'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
 		if($data['exam_details'][0]['mail_sent']==0){
 		$filename = $data['exam_details'][0]['certificate_id'];
		// file_put_contents('assets/upload/course-pdf/'.$filename.'.pdf');

		$subject = "Congratulations for passing ".$data['course_details'][0]['course_title']." Course";
		$message = "Dear " .$uname;
		$message .= "<h4>Congratulations</h4> <p>You have successfully Passed ".$data['course_details'][0]['course_title'].". 
		</p><p> Your Certificate No. is <b>".$filename."</b>.</p> 
		<p> Please find the Attachment for your Certificate.</p>";
        $message .= "<p>Regards</p> <p>CEonpoint Team</p>";
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from(EMAIL);
		// $this->email->to('nutan2247@gmail.com');
		$this->email->to($uemail);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->set_mailtype("html");
		$this->email->attach('assets/upload/course-pdf/'.$filename.'.pdf');
			if($this->email->send())
			{ 
				$update['mail_sent']='1';
				$this->db->where('id',$data['exam_details'][0]['id']);
				$this->db->update('tbl_exam',$update);
				$this->session->set_flashdata('mailsent', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable"><h4><b>CONGRATULATIONS!</b></h4>
					Your certificate is now recorded in your account and sent to your email.</div>');
			}
			else
			{
				$this->session->set_flashdata('mailsent', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			}
 		}

		$this->load->view('template/header_home');
		$this->load->view('pages/certificate',$data);
		$this->load->view('template/footer_home');
	}


public  function preview_course_certificate(){ 

	$userid = $_POST['uid'];
	$courseid = $_POST['cid'];
	
	$data['course_details'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$courseid);
	// $data['owner'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$data['course_details'][0]['user_id'] );
	$ownerid = $data['course_details'][0]['user_id'];
 		$this->db->select('ct.countries_name as location,tu.address');
		$this->db->from('tbl_user tu');
		$this->db->join('countries ct', 'ct.countries_id = tu.location'); 
		$this->db->where('tu.id ', $ownerid); 

	$data['owner'] = $this->db->get()->result_array();
	$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$userid);
	$data['exam_details'] = $this->user->get_exam_detail($courseid,$userid);	
	$data['cust_data'] = $data['exam_details'];
	$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','status',1);
	$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$courseid);

	$this->db->select('ct.id,ct.template_no,ct.bg_image,ct.text_image,uc.*');
    $this->db->from('tbl_user_certificate uc');
    $this->db->join('tbl_certificate_template ct', 'uc.templete_id = ct.id');  
    $this->db->where('uc.course_id ', $courseid); 
    $query = $this->db->get();
   	$data['certificate'] = $query->result_array(); 
	$data['certificate'][0]['training_title'] =  $data['course_details'][0]['course_title'];
	$data['certificate'][0]['units'] =  $data['course_details'][0]['units'];

	// echo $this->db->last_query();
	// echo'<pre>';print_r($data['certificate']);
	$category = $data['certificate'][0]['category'];
	$temp = $data['certificate'][0]['template_no'];
	$path = $this->certificate_model->select_certificate_template($category,$temp);
	// echo $path;
	$html = $this->load->view($path,$data);
	return $html;
   }

	public function paymentForCourse(){
		$post = $this->input->post();
		$cid = $post['item_number'];
		$add = array(
			'user_id'		=> $post['userid'],
			'item_name'		=> $post['item_number'], //course id
			'quantity'		=> 1,
			'tax'			=> $post['tax'],
			'added_on'		=> date('y-m-d h:i:s'),
			'amount'		=> $post['amount'],
			);
		$result = $this->user->save('tbl_purchase_llis',$add); //last inserted id
		if($result > 0){
			echo'<p style="text-align:center;top:30px;">Please wait payment in process</p>
			<form action="'.PAYAPAL_URL.'" method="post" name="purCourse" id="purCourse">
			<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="item_name_1" id="item_name" value="'.$post['item_name'].'">
			<input type="hidden" name="item_number_1" value="'.$result.'">
			<input type="hidden" name="amount_1" id="amount" value="'.$post['amount'].'">
			<input type="hidden" name="quantity_1" value="1">
			<input type="hidden" name="custom" value="'.$post['userid'].'">
			<input type="hidden" name="credits" value="510">
			<input type="hidden" name="rm" value="2">	
			<input type="hidden" name="lc" value="US">	
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="handling" value="0">
			<input type="hidden" name="cancel_return" value="'.site_url('pages/cancelpayment/').$cid.'">
			<input type="hidden" name="return" value="'.site_url('pages/success').'">'.form_close();	
			echo '<script> document.getElementById("purCourse").submit(); </script>';
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('pages/course_details/'.$cid);
		}
   }
	


	public function success()
	{ 
		// echo '<pre>'; print_r($_REQUEST);die;
		$id = isset($_REQUEST['item_number'])?$_REQUEST['item_number']:$_REQUEST['item_number1'];
			if(!empty($_REQUEST)){	
				$updateTxn = array(
					'payer_email'		=> $_REQUEST['payer_email'],
					'payer_id'			=> $_REQUEST['payer_id'],
					'payer_status'		=> $_REQUEST['payer_status'],
					'txn_id'			=> $_REQUEST['txn_id'],
					'payment_fee'		=> $_REQUEST['payment_fee'],
					'txn_status'		=> $_REQUEST['payment_status'],
					'payment_type'		=> $_REQUEST['payment_type'],
					'paypal_payment_date'=> $_REQUEST['payment_date'],
					'status'			=> 1,
					'payment_at'		=> date('y-m-d h:i:s'),
					'transaction_details'=> json_encode($_REQUEST),
				);
			}
		$result = $this->user->update('tbl_purchase_llis',$updateTxn,'id',$id);
		
		// $this->session->unset_userdata('logged_in');
		// session_destroy();
		$row = $this->user->get_user_record('tbl_user','id',$_REQUEST['custom']);
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
			'logged_in'=> $row->logged_in
		);

		$this->session->set_userdata('logged_in', $sess_array);
		if($result){
			$data['txn_id'] = $_REQUEST['txn_id'];
			$this->load->view('template/header_home');
			$this->load->view('pages/thanks',$data);
			$this->load->view('template/footer_home');
		}
		
	}
	
	public function exam($id,$exam_attempt = false)
	{
		// echo FCPATH;
		if(!empty($exam_attempt))
		{
			$data['reexam'] = $exam_attempt;
		}
		$uid = $this->session->userdata('logged_in')['id'];
		$data['all_question'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_quiz_question','course_id',$id);
		$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','status',1);
		$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
		$data['exam_attempt'] = $this->db->get_where('tbl_exam',array('user_id'=>$uid,'course_id'=>$id,'archive'=>'1'))->num_rows();
		$data['rest_retake'] = ($data['course'][0]['quiz_retek'] - $data['exam_attempt']);
		$this->load->view('template/header_home');
		$this->load->view('pages/exam',$data);
		$this->load->view('template/footer_home');
		
	}

	public function saveexam()
	{ 
		$correct = 0;
		$wrong   = 0;
	    $cid = $this->input->post('cid');
		$provider_id = $this->db->get_where('tbl_course',array('id'=>$cid))->row()->user_id;
		$uid = $this->session->userdata('logged_in')['id'];
		$passmarrksData = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();
		$cepname = $this->db->get_where('tbl_user',array('id'=>$passmarrksData['user_id']))->row_array()['name'];
		$passmarks = $passmarrksData['passing_marks'];
		
		$all_question = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_quiz_question','course_id',$cid);
		$getdc =   $this->provider->get_usage_of_subscribed_digital_package($provider_id);
		$getAllSubscripedPackages =   $this->provider->subscriped_packages($provider_id);
		$noOfUsedCertificate = ($getdc!='')?count($getdc):0;
		$noOfCertificateInSubscripedPackages = ($getAllSubscripedPackages!='')?count($getAllSubscripedPackages):0;
		if($noOfCertificateInSubscripedPackages - $noOfUsedCertificate > 0){
			$subscriptionStatus = 'y';
		}else{
			$subscriptionStatus = 'n';
		}

		$qdata=array();
		//print_r($all_question );
		foreach ($all_question as $key => $value) {
			$qdata[$key]['qid']=$value['id'];
			$qdata[$key]['ans']=$this->input->post('ans-'.$value['id']);
			
			if($this->input->post('ans-'.$value['id'])==$value['correct_answere'])
			{
				$correct++;
			}else{
				$wrong++;
			}	
		}

		$toalMarks = count($all_question)*100;
		$totalCorrect = $correct*100;
		$obtainedMarks = $totalCorrect * 100 / $toalMarks;

		if($obtainedMarks >= $passmarks){
			// include('./third_party/library/phpqrcode/qrlib.php');
			include(APPPATH.'/third_party/phpqrcode/qrlib.php');  

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

		$data['user_id']            = $uid;
		$data['course_id']          = $cid;
		$data['status']             = 1;
		$data['percentages']        = $obtainedMarks;
  		$data['added_on']           = date('y-m-d h:i:s');
  		$data['data']           	= json_encode($qdata);

		$result = $this->user->save('tbl_exam',$data);
		
		if($result > 0 && $obtainedMarks >= $passmarks){
			
			// genrate PDF of passed exam start
			$this->pdf($cid);
			// genrate PDF of passed exam end

			$insertdc = array(
				'professional_id' => $uid,
				'course_id'		  => $cid,
				'provider_id'	  => $provider_id,
				'subscription' 	  => $subscriptionStatus,
				'added_at'		  => date('Y-m-d H:i:s')
			);
			$this->provider->insert_usage_of_subscribed_digital_package($insertdc);

		$insert = array(
			'user_id'		=>	$data['user_id'] , 
			'certificate_id'=>	$data['certificate_id'], 
			'course_name'	=>	$passmarrksData['course_title'], 
			'units'			=>	$passmarrksData['units'], 
			'start_date'	=>	date('Y-m-d'), 
			'end_date'		=>	date('Y-m-d'),
			'certificate'	=>	$data['certificate_id'], 
			'issue_date'	=>	date('Y-m-d'), 
			'issue_from'	=>	'Online Course', 
			'issue_by'		=>	'CEonpoint', 
			'cep_name'		=>	$cepname, 
			'status'		=>	1, 
			'archive'		=>	1, 
			'added_on'		=>	date('Y-m-d H:i:s') 
		);
		$res = $this->user->save('tbl_existing_certificate',$insert);
		// $getrbdetails = $this->provider->getRBProfDetails($uid);//professional connectivity
		$getrbdetails = $this->provider->getRBdetails($provider_id);//CEP connectivity
		if(isset($getrbdetails) && $getrbdetails != '' && $getrbdetails->domain !=''){
			if($obtainedMarks >= $passmarks){
				$_SESSION['excid'] = $res;
				$_SESSION['excdomain'] = $getrbdetails->domain;
			}
		}
	}
		redirect(base_url('pages/exam/'.$cid));
    }
 
	public function old_pdf(){	
		$this->load->view('demopdf');
		$html = $this->output->get_output();
		
		$this->load->library('Dompdf_gen');
		// $this->dompdf = new Dompdf();
		$this->dompdf_gen->loadHtml($html);
		$this->dompdf_gen->setPaper('A4', 'landscape');
		$this->dompdf_gen->render();
		$this->dompdf_gen->stream("welcome.pdf", array("Attachment"=>0));
	}

	public function pdf($course_id){	
		error_reporting(0);
		$uid = $this->session->userdata('logged_in')['id'];
		$uemail = $this->session->userdata('logged_in')['username'];
		$name = $this->session->userdata('logged_in')['name'];
		 	
 		$course_details = $this->share->getCourseDetails($course_id);
 		$certificate = $this->share->getCourseCertificate($course_id);
 		$profile = $this->share->getUserDetails($uid);
		
		$ownerid = $course_details['user_id'];
 		$owner = $this->share->getUserDetails($ownerid);
		 $exam_details = $this->user->get_exam_detail($course_id,$uid);
		 $coursehasacc = $this->user->get_accredition_detailsOC($course_id);
		//  echo '<pre>'; print_r($cephasacc);die;
		if(!empty($coursehasacc)):
			$data['has_acc'] = true;
			$data['acc_number'] = $coursehasacc->acc_number;
		else:
			$data['has_acc'] = false;
			$data['acc_number'] = '0000000000';
		endif;

 		$data['cust_data']						= $exam_details[0];
		$data['certificate']					= $certificate;
		$data['certificate']['user_name']		= $profile['name'];
		$data['certificate']['training_title'] 	= $course_details['course_title'];
		$data['certificate']['units'] 			= $course_details['units'];
		$data['certificate']['start_date'] 		= $exam_details[0]['added_on'];
		$data['certificate']['location'] 		= $profile['location'];

 		//select path of template
 		$category = $certificate['category'];
		$temp = $certificate['template_no'];
		$path = $this->certificate_model->select_certificate_template_pdf($category,$temp);

		$this->load->view($path,$data);
		// Get output html
		$html = $this->output->get_output();
		$this->load->library('Dompdf_gen');
		// print_r($html); die;
		$this->dompdf_gen->loadHtml($html);

		if($certificate['category']=='Portrait'){
			$this->dompdf_gen->setPaper('letter','portrait');
		}else{
			$this->dompdf_gen->setPaper('letter','landscape');
		}
		$this->dompdf_gen->render();
		
		$filename = $exam_details[0]['certificate_id'];
		file_put_contents('assets/upload/course-pdf/'.$filename.'.pdf', $this->dompdf_gen->output($html));
		
		// $this->dompdf_gen->stream("certificate.pdf", array("Attachment" =>0));die;
		// $this->dompdf_gen->stream("certificate.pdf");
		// return true;
	}



  	public function download_certificate($certificateNo=false){	
		if($certificateNo==""){
			$certificateNo = $this->input->post('dcertificate');
		}
		$certificateData = $this->user->get_record_by_field_name_all_record('tbl_exam','certificate_id',$certificateNo);

		$base = ASSETS_URL;
		if($certificateData[0]['course_id'] != ""){
			if(isset($certificateData[0]['certificate_id']) && file_exists('assets/upload/course-pdf/'.$certificateData[0]['certificate_id'].'.pdf')){
				header("Location: ".$base."upload/course-pdf/".$certificateData[0]['certificate_id'].".pdf");			
			}else{
				$this->pdf($certificateData[0]['course_id']);
						
			}
		}elseif($certificateNo && $certificateData[0]['course_id']==''){
			header("Location: ".$base."upload/pdf/".$certificateNo.".pdf");			
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

    public function bookseminar(){	
		// print_r($this->input->post());die;
		$uid = $this->input->post('uid');
 		$sid = $this->input->post('seminar_id');
		
		$where = array('email'=>$this->input->post('email'),'training_seminar_id'=>$sid);
	    $exist  = $this->user->get_record_by_field_name_all_record11('tbl_training_book',$where);
	    $tdetails  = $this->db->get_where('tbl_training',array('id'=>$sid))->row_array();
		if(!empty($exist)){
		 	$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Email id is already registered with us.</div>');
				redirect('pages/training_details/'.$sid.'?id=exist');
		}else{

				$bookTraining['training_seminar_id'] = $this->input->post('seminar_id');
				$bookTraining['user_id'] 		  = $this->input->post('uid');
				$bookTraining['name'] 			  = $this->input->post('name');
				$bookTraining['email'] 			  = $this->input->post('email');
				$bookTraining['phone'] 	  		  = $this->input->post('phone');
				$bookTraining['country'] 	  	  = $this->session->userdata('logged_in')['country'];
				$bookTraining['profession_id'] 	  = $this->input->post('profession_id');
				if($this->input->post('other')){
				$key = array_keys($this->input->post('other'));
				$value = array_values($this->input->post('other'));
				$array = array_combine($key,$value);
				// print_r(json_encode($array));die;
				$bookTraining['other'] 	  		= json_encode($array);
				}
				
				$bookTraining['payment_mode'] 	 = $this->input->post('payment_mode');
				$bookTraining['tax']	 	  	 = $this->input->post('tax');
				$bookTraining['amount'] 		 = $this->input->post('price');
				$bookTraining['payment_status']  = 0;
				$bookTraining['status'] 		 = 1;
				$bookTraining['quantity'] 		 = 1;
				$bookTraining['added_on'] 		 = date('Y-m-d');
				// echo'<pre>';print_r($bookTraining);die;
			$result = $this->user->save('tbl_training_book',$bookTraining);
		}	
		// echo $this->db->last_query();die;

		if($result){
			$this->trainingMailSent($bookTraining);
			$this->session->set_flashdata('response', '<label>You are successfully registered at:</label><div style="margin-left:-1px;text-align:center;" class="alert alert-success alert-dismissable"> 
				<ul style="list-style: none;">
				<li>'.$tdetails['title'].'</li>
				<li>'.$tdetails['sub_title'].'</li>
				<li>'.$tdetails['start_date'].'</li>
				<li>'.$tdetails['start_time'].'</li>
				<li>'.$tdetails['location'].'</li>
				</ul></div>
				<p>Details has been sent to your email and ceonpoint account.</p>');
			redirect('pages/training_details/'.$sid.'/?id=success');
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('pages/training_details/'.$sid.'');
		}
	}

 	public function trainingMailSent($bookTraining){
 		$data['data'] = $bookTraining;
 		$data['details'] = $this->db->get_where('tbl_training',array('id'=>$bookTraining['training_seminar_id']))->row_array();
 		// print_r($data);die;
 		$this->sendMail($bookTraining['email'],'You have successfully Booked a Training',$this->load->view('email/book_training',$data,true));
 		$notification = array(
		'subject'        	=> 'You have successfully Booked a Training', 
		'to' 				=> $bookTraining['user_id'] ,  
		'from' 				=> $data['details']['user_id'],  
		'message' 			=> $this->load->view('email/book_training',$data,true),  
		'status'     		=> 1,
		'added_on'     		=> date('Y-m-d H:i:s')
		); 
		$this->user->save('tbl_notification',$notification);
 		return true;
 	}

 	public function update_bookseminar(){
 		print_r($this->input->post());
 	}

 	public function user_exist(){
 		$tid = $this->input->post('tid');
 		$email = $this->input->post('email');
	    $result = $this->db->get_where('tbl_training_book',array('email'=>$email,'training_seminar_id'=>$tid))->num_rows();
	    echo json_encode($result);
	    // echo $this->db->last_query();
 	}



 	public function success_training_book()
	{	
		// echo'<pre>'; print_r($_REQUEST);die;
		$tid = $_REQUEST['item_number'];
		$uidTax = explode('_', $_REQUEST['custom']);
		$bookTraining = array(
			'training_seminar_id' => $_REQUEST['item_number'],
			'user_id' 			  => $uidTax[4],
			'name' 				  => $uidTax[0],
			'email' 			  => $uidTax[1],
			'profession_id' 	  => $uidTax[2],
			'payment_mode' 		  => $uidTax[3],
			'tax' 			 	  => $uidTax[5],
			'amount' 			  => $_REQUEST['mc_gross'],
			'txn_id' 			  => $_REQUEST['txn_id'],
			'payment_status' 	  => 1,
			'status' 			  => 1,
			'quantity' 			  => 1,
			'added_on' 			  => date('Y-m-d'),
			'transaction_details' => json_encode($_REQUEST)
		);
		$result = $this->user->save('tbl_training_book',$bookTraining);
		// echo $this->db->last_query();die;
		$data['data'] = $bookTraining;
		$data['info'] = $this->db->get_where('tbl_training_book',array('id'=>$result))->row_array();
		// $data['txn_id'] = $_REQUEST['txn_id'];
	 	$this->sendMail($bookTraining['email'],'You have successfully Booked a Training',$this->load->view('email/book_training',$data,true));
	 	if($result){
	 	// 	$this->load->view('template/header_home');
			// $this->load->view('pages/thanks',$data);
			// $this->load->view('template/footer_home');
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Seminar booked successfully. Details has been sent to email and professional account.</div>');
			redirect('pages/training_details/'.$tid.'?id=success');
		}else{
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('pages/training_details/'.$tid.'');
		}
	}


 	public function cancel_training_book($tid){
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		redirect('pages/training_details/'.$tid.'');
	}

	public function cancelpayment($id){
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		redirect('pages/course_details/'.$id.'');
	}

	public function plansuccess(){	
		// $uemail = $this->session->userdata('logged_in')['username'];	
		$uemail = $this->db->get_where('tbl_user',array('id'=>$_REQUEST['custom']))->row_array()['username'];
		// echo '<pre>'; print_r($_REQUEST); exit;
		if($_REQUEST){
			// $existingplandetails = $this->user->getusetdetails('professional_pce_plan','user_id',$this->session->userdata('logged_in')['id']);
			$existingplandetails = $this->user->getusetdetails('professional_pce_plan','user_id',$_REQUEST['custom']);
			$userexpiryDate = $existingplandetails->plan_expiry_at;
			if($_REQUEST['item_number'] == 1){
				//$expirydate = date('Y-m-d', strtotime("+30 days"));
				//$expirydate = date($userexpiryDate, strtotime("+30 days"));
				$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +1 month");
			}
			if($_REQUEST['item_number'] == 2){ 
				//$expirydate = date('Y-m-d', strtotime("+180 days"));
				$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +6 month");
			}
			if($_REQUEST['item_number'] == 3){
				//$expirydate = date('Y-m-d', strtotime("+365 days"));
				$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +12 month");
			}
			if($_REQUEST['item_number'] == 4){
				//$expirydate = date('Y-m-d', strtotime("+1095 days"));
				$expirydate = strtotime(date("Y-m-d", strtotime($userexpiryDate)) . " +36 month");
			}
			
			$requestupdate = array(
				'user_id' 				=> $_REQUEST['custom'],
				'payer_email' 			=> $_REQUEST['payer_email'],
				'payer_id' 				=> $_REQUEST['payer_id'],
				'payer_status' 			=> $_REQUEST['payer_status'],
				'first_name' 			=> $_REQUEST['first_name'],
				'last_name' 			=> $_REQUEST['last_name'],
				'payment_transtion_id' 	=> $_REQUEST['txn_id'],
				'mc_gross' 				=> $_REQUEST['mc_gross'],
				'payment_amount' 		=> $_REQUEST['payment_gross'],
				'payment_status' 		=> $_REQUEST['payment_status'],
				'pending_reason' 		=> $_REQUEST['pending_reason'],
				'pce_plan_name' 		=> $_REQUEST['item_name'],
				'pce_plan_id' 			=> $_REQUEST['item_number'],
				'payment_date' 			=> $_REQUEST['payment_date'],
				'verify_sign' 			=> $_REQUEST['verify_sign'],
				'payment_at' 			=> date('Y-m-d H:i:s'),
				'plan_active_date' 		=> date('Y-m-d'),
				'plan_expiry_date' 		=> date('Y-m-d',$expirydate),
			);
			$result = $this->user->save('professional_pce_plan_payment_history',$requestupdate);

			$lastpaymentid = $this->db->insert_id();
			if($result){
				
				$upateplan = array(
				'version_type' 			=> '2',
				'plan_duration' 		=> $_REQUEST['item_name'],
				'payment_status' 		=> 'y',
				'plan_active_at' 		=> date('Y-m-d'),
				'plan_expiry_at' 		=> date('Y-m-d',$expirydate),
				'payment_recieved_id' 	=> $lastpaymentid,
				'payment_recieved_at' 	=> date('Y-m-d')
				);
				// $this->user->update('professional_pce_plan',$upateplan,'user_id',$this->session->userdata('logged_in')['id']);
				$this->user->update('professional_pce_plan',$upateplan,'user_id',$_REQUEST['custom']);
				
			}
			$subject = "PCE-MC Plan purchaser.";
			// $message = "Seminar booked successfully. Please Click on the link to view Details.
			// <a href='.base_url("'pages/training_details/'").$tbookid;'>Click here</a>  ";
			$message .= "<br/><br/> Thank you, <br/> Team CEonpoint";

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('mails@ceonpoint.com');
			$this->email->to($uemail);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->set_mailtype("html");	
			if($this->email->send())
			{ 
				//echo 'Sent'; 
				// echo "<center><strong>MAil  successfully.</strong></center>";
			}
			else
			{
				//echo'Not-Sent'; 
			// show_error($this->email->print_debugger());
			}


			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Your plan has been successfully updated.</div>');
			redirect('professional/plan_subscription');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('professional/plan_subscription');
		}
	}


 public function plancancel()
	{
		// $tbookid = $_REQUEST['item_name'];
		$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		redirect('professional/plan_subscription');
		// echo '<pre>';
		// print_r($_REQUEST);
		// die;
	}





public function prcexam($id=null)
	{ 

		if($id==""){
		 $data['exam']  = $this->user->get_record_by_field_name_all_record('tbl_guide','types','exam');
        } else {
		 $data['exam']  = $this->user->get_record_by_field_name_all_record('tbl_guide','id',$id);
		 $data['idd']   = $id;
        }



		$this->load->view('template/header_home');
		$this->load->view('pages/prcexam',$data);
		$this->load->view('template/footer_home');
	}


public function guide($id=null)
	{ 

		//$data['guide'] = $this->user->get_record_by_field_name_all_record('tbl_guide','id',$id);

		if($id==""){
		 $data['guide']  = $this->user->get_record_by_field_name_all_record('tbl_guide','types','guide');
        } else {
		 $data['guide']  = $this->user->get_record_by_field_name_all_record('tbl_guide','id',$id);
		 $data['idd']   = $id;
        }


		$this->load->view('template/header_home');
		$this->load->view('pages/guide',$data);
		$this->load->view('template/footer_home');
	}



public function features($id=null)
	{  

		$this->load->view('template/header_home');
		$this->load->view('pages/features');
		$this->load->view('template/footer_home');
	}





	public function certificatevalidation()
	{ 
		$this->load->view('template/header_home');
		$this->load->view('pages/certificatevalidation');
		$this->load->view('template/footer_home');
	}

	public function template1()
	{
		$this->load->view('pages/template1');
	}


	public function template2()
	{
		$this->load->view('pages/template2');
	}



	public function template3()
	{
		$this->load->view('pages/template3');
	}



	public function speaker_details()
	{
		 $speakerid = $this->input->post('speaker_id');
		 $tdata['sdata'] = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','id',$speakerid);

		$this->load->view('pages/speaker_details',$tdata);
	}


	public function course_archive(){
		$courseid = $this->input->post('cid');
		$userid = $this->input->post('uid');
		$update = array(
			'archive' => '1'  //1 means old course
		);
		$this->db->where(array('item_name' => $courseid,'user_id' => $userid));
		$result = 	$this->db->update('tbl_purchase_llis',$update);

		$update1 = array(
			'archive' => '0'   //0 means old exam
		);
		$this->db->where(array('course_id' => $courseid,'user_id' => $userid));
		$result1 = 	$this->db->update('tbl_exam',$update1);
		// echo $this->db->last_query();
		if($result && $result1){
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public function getcomment(){
		// print_r($this->input->post());die;
		$tr_id = $this->input->post('trid');
		$type  = $this->input->post('types');
		$idd  = $this->input->post('idd');

		$where = array('training_id'=>$tr_id,'evaluation_type'=>$type);
		$this->db->order_by('id','ASC');
	    $evaluation  = $this->user->get_record_by_field_name_all_record11('tbl_training_evaluation',$where);

	    $data['tr_id'] = $tr_id;
	    $data['type']  = $type;
	    $data['idd']   = $idd;
	    $data['evaluation'] = $evaluation;
	    // print_r($data);
	    $this->load->view('pages/getcomment',$data);
	}

	public function getcoursecomment(){
		$cid = $this->input->post('cid');
		$this->db->order_by('id','ASC');
	    $evaluation  = $this->user->get_record_by_field_name_all_record11('tbl_evaluation',['course_id'=>$cid,'status'=>1]);
	    $data['cid']   = $cid;
	    $data['evaluation'] = $evaluation;
		// echo json_encode($evaluation);
	    $this->load->view('pages/getcoursecomment',$data);
	}
	
	public function aboutus(){ 
		$where4 = array('role'=>1,'status'=>1);
		$professionallist = $this->user->get_record_by_multi_field_name('tbl_user',$where4);
		$data['professionals'] = sprintf("%02d", count($professionallist));

		$where1 = array('role'=>2,'status'=>1);
		$providers = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
		$data['providers'] = sprintf("%02d", count($providers));

		$where3 = array('role'=>6,'status'=>1);
		$authorlist = $this->user->get_record_by_multi_field_name('tbl_user',$where3);
		$data['authors'] = sprintf("%02d", count($authorlist));

		$where2 = array('role'=>5,'status'=>1);
		$institutions = $this->user->get_record_by_multi_field_name('tbl_user',$where2);
		$data['institutions'] = sprintf("%02d", count($institutions));
		
		$where2 = array('role'=>7,'status'=>1);
		$rboards = $this->user->get_record_by_multi_field_name('tbl_user',$where2);
		$data['govt'] = sprintf("%02d", count($rboards));

		$this->load->view('template/header_home');
		$this->load->view('pages/aboutus',$data);
		//$this->load->view('template/footer_home');
	}

	public function contactus(){ 
		$this->load->view('template/header_home');
		$this->load->view('pages/contactus',$data);
		$this->load->view('template/footer_home');
	}

	public function faq(){ 
		$data['faq_professional_list'] = $this->user->get_record_by_multi_field_name('tbl_faq',array('role'=>'1','status'=>'1'));
		$data['faq_cepauthor_list'] = $this->user->get_record_by_multi_field_name('tbl_faq',array('role'=>'2','status'=>'1'));
		$data['faq_ins_list'] = $this->user->get_record_by_multi_field_name('tbl_faq',array('role'=>'3','status'=>'1'));
		
		// print_r($data);die;
		$data['tutorials_pro'] = $this->user->get_record_by_multi_field_name('tbl_tutorial',array('type'=>'professional','status'=>'1','show_on_faq'=>'1'));
		$data['tutorials_cepauthor'] = $this->user->get_record_by_multi_field_name('tbl_tutorial',array('type'=>'cepBusiness','status'=>'1','show_on_faq'=>'1'));
		$data['tutorials_ins'] = $this->user->get_record_by_multi_field_name('tbl_tutorial',array('type'=>'institution','status'=>'1','show_on_faq'=>'1'));
		
		$this->load->view('template/header_home');
		$this->load->view('pages/faq',$data);
		$this->load->view('template/footer_home');
	}

	public function faq_search(){
		$search = $this->input->post('search');
		$this->db->like('question',$search);
		$this->db->where('status','1');
		$data['faq_list'] = $this->db->get('tbl_faq')->result_array();

		$this->load->view('template/header_home');
		$this->load->view('pages/faq_search',$data);
		$this->load->view('template/footer_home');
	}

	public function privacy_policy(){
		$data = array(); 
		$this->load->view('template/header_home');
		$this->load->view('pages/privacy_policy',$data);
		$this->load->view('template/footer_home');
	}

	public function ocms(){
		$data = array(); 
		$filterOC[]='';
		$data['freecourse'] 	 = $this->share->get_online_course($filterOC);
		$this->load->view('template/header_home');
		$this->load->view('pages/ocms',$data);
		$this->load->view('template/footer_home');
	}

	public function terms(){
		$data = array(); 
		$data['professionals'] 		= $this->dashboards_model->get_terms('professional');
		$data['authorCeonpoint'] 	= $this->dashboards_model->get_terms('authorCeonpoint');
		$data['authorBusiness'] 	= $this->dashboards_model->get_terms('authorBusiness');
		$data['authorInstitution'] 	= $this->dashboards_model->get_terms('authorInstitution');
		$data['cepBusiness'] 		= $this->dashboards_model->get_terms('cepBusiness');
		$data['cepInstitutions']	= $this->dashboards_model->get_terms('cepInstitution');
		$data['institutions'] 		= $this->dashboards_model->get_terms('institution');
		$data['advertiser'] 		= $this->dashboards_model->get_terms('advertiser');
		$data['tutorials'] 			= $this->dashboards_model->get_terms();
		$this->load->view('template/header_home');
		$this->load->view('pages/terms',$data);
		$this->load->view('template/footer_home');
	}


	public function enquiry()
	{
		$this->form_validation->set_error_delimiters('<p class="help-block" style="color:red;">', '</p>');
		$this->form_validation->set_rules('type', 'Type', 'trim|required'); 
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');  
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');  
		$this->form_validation->set_rules('message', 'Message', 'trim|required'); 
	 
		if($this->form_validation->run() == FALSE)
		{
			$this->load->frontAdmin('pages/aboutus');
		}  else { 
			$enquirydata = array(
				'etype' 		=> $this->input->post('type'),
				'email' 		=> $this->input->post('email'),
				'first_name' 	=> $this->input->post('first_name'),
				'subject' 		=> $this->input->post('type'),
				'message' 		=> $this->input->post('message')
			);	
			
		    $result = $this->user->save('tbl_enquiry',$enquirydata); 
			if($result){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Thank you for your message.</div>');
				redirect('pages/aboutus');
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('pages/aboutus');
			} 
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
		 
		// Sending email

		/*$to = "deepak.1999.kumar@gmail.com";
		$subject = "Registration";
		$message = "Registration Successfully";  */  
 

		if(mail($to, $subject, $message, $headers)){ 
		    return true;
		} else{ 
		    return false;
		}

	}

	public function saverating(){ 
		// echo'<pre>'; print_r($this->input->post());die;
		$uid = $this->session->userdata('logged_in')['id'];
        $tid = $this->input->post('training_id');
		// echo '<pre>'; print_r($this->input->post());die;
        $training_type  = $this->db->get_where('tbl_training',array('id'=>$tid))->row_array()['training_type'];
        $count  = count($this->input->post('questionid'));
        $rating = $this->input->post();

        	$save['user_id']   		= $this->input->post('user_id');
        	$save['training_id']   	= $tid;
        	$save['speaker_id']   	= $this->input->post('speaker_id');
        for($i=0;$i<$count;$i++){
        	$qid   					= $this->input->post('questionid')[$i];
        	$save['question_id']   	= $qid;
        	if($this->input->post('questiontype')[$i] == 1){
        		$save['star_mark']   	= $this->input->post('rating')[$qid];
        	}else{
        		$save['comments']   	= $this->input->post('comments')[$qid];
        	}
        	$result = $this->user->save('tbl_training_review',$save);
        	// echo $this->db->last_query();die;
        	$save['comments'] 		= '';
        	$save['star_mark']  	= 0;
        }
		// echo $i; die;
	    if($training_type==1){
			redirect('pages/training_details/'.$tid.'?r=1');
	    }else{
			redirect('pages/training_details_evaluation/'.$tid.'?popup=123');
	    }
	}

	public function professional_signup(){
		if($this->input->post()){
			$this->load->library('upload');
			if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){
				$config1['upload_path'] = './assets/images/uploads/';	
				$config1['allowed_types'] = 'gif|jpg|png|jpeg';
				$ext = explode('.',$_FILES["photo"]["name"]);        
				$imageName = 'VID_'.time().'.'.end($ext);
				$config1['file_name'] = $imageName;
				$this->upload->initialize($config1);
				if ( ! $this->upload->do_upload('photo')) {
					$result['error'] = true;  
					$result['success'] = false;
					$result['message'] = $this->upload->display_errors();
				}  
			$image = $imageName;
			}

			$post = $this->input->post();
			$lastid = $this->Pages_model->save_professional($post,$image);		
						
			if($lastid > 0){
				$result['error']   = false;  
				$result['success'] = true;
				$result['message'] = 'Account created successfully';
			}else{
	 			$result['error']   = true;  
				$result['success'] = false;
				$result['message'] = 'Something went wrong!';
			}
		}
			echo json_encode($result);
	}
					

	public function check_user_rgistered(){
		$uid = $this->input->post('check');
		$tid = $this->input->post('tid');
		$result = $this->db->get_where('tbl_training_book',array('user_id'=>$uid,'training_seminar_id'=>$tid))->row();
		// echo $this->db->last_query();
		echo json_encode($result);
	} 

	public function get_termcondition(){
		$type = $this->input->post('type');
		$result = $this->Pages_model->get_termandcondition($type);
		// echo $this->db->last_query();
		echo json_encode($result);
	} 

	public function commentdata(){
		$tr_id = $this->input->post('trid');
        $type  = $this->input->post('types');
        $idd   = $this->input->post('idd');

        if($type=='teacher'){ $type = 1; } else { $type = 2; }
        $uid = $this->session->userdata('logged_in')['id'];
        $where = array('training_id'=>$tr_id,'evaluation_type'=>$type);
        $this->db->order_by('id','ASC');
        $data['evaluation']  = $this->user->get_record_by_field_name_all_record11('tbl_training_evaluation',$where);
        $data['evaluation_note']  = $this->db->get_where('tbl_training',array('id'=>$tr_id))->row_array()['evaluation_note'];
        $data['check_evaluation_exsits']  = $this->db->get_where('tbl_training_review',array('user_id'=>$uid,'training_id'=>$tr_id,'speaker_id'=>$idd))->row_array();
		$data['tr_id'] = $tr_id; 
		$data['type'] = $type; 
		$this->load->view('pages/training_evaluation_design',$data);
	}
	
	public function ceplistbycountry(){
		$country = $this->input->post('country');
		$where = array('role'=>2,'status'=>1,'country'=>$country,'under_insititution'=>0);
		$this->db->order_by('name','ASC');
		$providers = $this->user->get_record_by_multi_field_name('tbl_user',$where);
		if($providers !=''){
			$select = "<select name='provider' class='form-control' id='cpdaProvider'>";
			foreach($providers as $value):
				$select .= "<option value=".$value['id'].">".$value['name']."</option>";
			endforeach;
			$select .= "</select>";
			echo $select;
			die;
		}else{
			echo false;
		}
	}
} 