<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
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
		$this->load->model('Certificate_model','certificate_model'); 
		$this->load->model('professional_model','professional_model'); 
		$this->load->model('dashboards_model');  
		$this->load->model('Share_model','share'); 
    }

	public function index()
	{
	  	// $uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
	  	// $up_id = end(explode('-', $uprovider)); 
	  	// $uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
	 
		$data['latestprofessionallist'] = $this->user->get_record_by_field_name_all_record('tbl_professionals',array('pro_status'=>'1','status'=>'1','user_type'=>'1'),'');
		// $this->db->where(array('user_role'=>'10','country'=>999));
		$this->db->where(array('user_role'=>'10'));
		$this->db->order_by('id','DESC');
		$data['blogs'] = $this->user->get_record_by_field_name_all_record('tbl_blog','status','1');
		$wherea = array('under_insititution'=>'0','status'=>'1');
		$data['authors'] = $this->user->getAuthors($wherea);
		$this->load->view('template/header_home');
		// $data['freecourse'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','status',1);

		$data['provider_promote'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_promoted_provider','status',1);
        $data['advertise_listing'] = $this->user->getadvertisement();
        $data['category'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category','status',1);
		$data['countries'] = $this->user->get_countries();
		$data['exam']  = $this->user->get_record_by_field_name_all_record_limit('tbl_guide','types','exam');
		$data['guide'] = $this->user->get_record_by_field_name_all_record_limit('tbl_guide','types','guide');

		$where = array();
		$whereflag = 0;
		if($cat){
		$where['course_category'] = $cat;  
		$whereflag = 1; 
		}
		if($country_id){
		$where['country_id'] = $country_id;
		$whereflag = 1;		 
		}  

		$data['param']=$where;

		if($whereflag==1){
		$where['tbl_course.insititution_id'] = '0';
		$where['tbl_course.paid_status']=2;   
		}else{
		$where['tbl_course.insititution_id'] = '0';
		$where['tbl_course.status']=1;  
		}
		$this->db->where('course_validity >=',date('Y-m-d')); 
		$this->db->order_by('tbl_course.paid_status','DESC'); 
		$data['freecourse'] = $this->user->get_courses($where);
		// echo '<pre>';print_r($data['freecourse']);
		$this->load->view('pages/home',$data);
		$this->load->view('template/footer_home');
	}

	public function viewer_counter(){
		$this->load->library('user_agent');
		// if ($this->agent->mobile()){
		//        echo $this->agent->mobile();
		// }
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
	
		$data['param'] =$where;		
		// if(empty($where['institute_title']))
		// {
        	$data['institutions'] = $this->user->getInstitutions($where); 
        // }else{
        // 	$data['institutions'] = $this->user->getInstitutions_like($wheres); 
        // }	
        // echo $this->db->last_query(); die;
		$this->load->view('template/header_home');
		$this->load->view('pages/Institutionspage',$data);
		$this->load->view('template/footer_home');
	}

	public function InstitutionCEPlatform(){ 
		$data['professional'] = $this->user->get_record_by_field_name_all_record('tbl_professionals','status',1);
		// $this->db->where('role',5);
		// $data['ins_list'] = $this->user->get_record_by_field_name_all_record('tbl_user','status',1);
		$data['ins_list'] = $this->user->getInstitutions('');
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
        
        $data['categorylist']  = $this->user->get_record_by_field_name_all_record('tbl_registration_category',array('status'=>'1','training_id'=>$id),'');
        $data['og_description'] =  strip_tags($seminar['sub_title']);
		$data['og_title'] 		=  $seminar['title'];
		$data['og_image'] 		=  base_url('assets/images/uploads/'.$seminar['image']);
		$data['og_url'] 		=  base_url('pages/training_details/'.$seminar['id']);
		$data['og_type'] 		=  'website';
		
		$numOfparticipants = explode(",", $data['training'][0]['participants']);

		$participants = $this->db->where_in('id',$numOfparticipants)->get('tbl_category')->result_array();
		foreach($participants as $key => $participant){
			$nameOfParticipants[] = $participants[$key]['cat_name'];
		}

		if(count($numOfparticipants) > 0){
		$string_version = implode(", ",(array)$nameOfParticipants);
		$data['training'][0]['participants'] = $string_version;
		}

		if($data['training'][0]['templates']==1 && $data['training'][0]['training_type']==1){
			$this->load->view('pages/template1',$data);
		}

		elseif($data['training'][0]['templates']==2 && $data['training'][0]['training_type']==1){
			$this->load->view('pages/template2',$data);
		}

		elseif($data['training'][0]['templates']==3 && $data['training'][0]['training_type']==1){
			$this->load->view('pages/template3',$data);	
		}
		elseif($data['training'][0]['templates']==4 && $data['training'][0]['training_type']==1){
			$this->load->view('pages/template4',$data);	
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
		// $profWithoutIns = $this->db->where(array('status'=>1,'role'=>2))->or_where(array('parent_insititution'=>0,'parent_insititution'=>NULL))->get('tbl_user')->result_array();
		// foreach($profWithoutIns as $arr => $a){ $ins[] = $profWithoutIns[$arr]["id"]; }
		// $this->db->where_in('user_id',$ins);
		// $data['training'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training','status',1); 
		$where['status'] = 2; //Published
        $where['end_date >='] = date('Y-m-d');
        $this->db->or_where(array('insititution_id'=>'0'));
        $data['training'] = $this->user->get_training($where);

        $this->db->order_by('cat_name','ASC');
        $data['category'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category','status',1);
        $this->db->order_by('countries_name','ASC');
		$data['countries'] = $this->user->get_countries();
	 
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
		
		if($country=="home"){
			$this->session->set_userdata('current_country', $country);			
			redirect('pages/index');			
		}
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



  public function courses($cat=false)
	{
         $cat = $this->input->get('category');	
         $course_title = $this->input->get('course_title');	
		 $country_id = $this->input->get('country');
		   if(!empty($this->session->userdata('current_country')) && $this->session->userdata('current_country')!='home')
		   {
			  $country_id = $this->session->userdata('current_country'); 
		   }
  
       $where=array();
	   $whereflag=0;
	   if($cat)
	   {
		 $where['course_category']=$cat;  
		 $whereflag=1;
	   }
	   if($country_id)
	   {
		 $where['country_id']=$country_id;
         $whereflag=1;		 
	   }
	    if($course_title)
	   {
		 $wheres['course_title']=$course_title;
           $whereflag=1;		 
	   }  
	    		
	 if($whereflag==1)
	   {
		 $where['tbl_course.paid_status']=2;   
	   }else
	   {
		 $where['tbl_course.status']=1;  
	   }
	if(empty($course_title)){
		$where['tbl_course.insititution_id'] = '0';
		$this->db->where('tbl_course.course_validity >=',date('Y-m-d')); 
		$this->db->order_by('tbl_course.paid_status','DESC'); 
		$data['featured'] = $this->user->get_courses($where);
	}else{
		$wheres['tbl_course.insititution_id'] = '0';
		$this->db->where('tbl_course.course_validity >=',date('Y-m-d')); 
		$this->db->order_by('tbl_course.paid_status','DESC'); 
		$data['featured'] = $this->user->get_courses_like($wheres); /*filter by title*/
		}

		$data['toplist'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc_page('tbl_course','paid_status',3,$cat);
		$data['premium'] = $this->user->get_record_by_field_name_all_record_order_by_id_desc_page('tbl_course','paid_status',4,$cat);
        
		$where['tbl_course.paid_status']=1;
		$this->db->where('tbl_course.course_validity >=',date('Y-m-d')); 
		$this->db->order_by('tbl_course.paid_status','DESC'); 
		$data['freecourse'] = $this->user->get_courses($where);
		$data['param']=$where; /*This param contain course_category, country*/ 
		// echo'<pre>';print_r($data);die;
		// echo $this->db->last_query();

		$this->load->view('template/header_home');
		$this->load->view('pages/courses',$data); 
		$this->load->view('template/footer_home');
	}



  	public function course_details($id)
	{
		$stts=1;
		
		$data['seminar'] = $this->user->get_record_by_field_name_all_record('tbl_training','status',$stts);
		$data['course'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
		$course = $this->share->get_row_array('tbl_course','id',$id);

		$data['og_description'] =  strip_tags($course['course_description']);
		$data['og_title'] 		=  $course['course_title'];
		$data['og_image'] 		=  base_url('assets/images/uploads/'.$course['course_photo']);
		$data['og_url'] 		=  base_url('pages/course_details/'.$course['id']);
		$data['og_type'] 		=  'Course';

		$this->load->view('template/header_home',$data);
		$this->load->view('pages/course_details',$data);
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
		




	public function exam($id,$exam_attempt = false)
	{
		
	// $isloggin = $this->session->userdata('logged_in')['id'];
	// if(empty($isloggin))
	// {
	// 	return redirect("users");	
	// }
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
		// print_r($this->db->last_query());die;

		$this->load->view('template/header_home');
		$this->load->view('pages/exam',$data);
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

	


  public function success()
	{ 
		// $uid = $this->session->userdata('logged_in')['id'];custom
		// $cid = $this->uri->segment(3);
		$uidTax = explode('_', $_REQUEST['custom']);
		$cid = $_REQUEST['item_number'];
		$result = 0;
		if(!empty($_REQUEST)){	
			$add = array(
				'user_id'			=> $uidTax[0],
				'payer_email'		=> $_REQUEST['payer_email'],
				'payer_id'			=> $_REQUEST['payer_id'],
				'payer_status'		=> $_REQUEST['payer_status'],
				'txn_id'			=> $_REQUEST['txn_id'],
				'item_name'			=> $_REQUEST['item_number'],
				'quantity'			=> $_REQUEST['quantity'],
				'tax'				=> $uidTax[1],
				'payment_fee'		=> $_REQUEST['payment_fee'],
				'txn_status'		=> $_REQUEST['payment_status'],
				'payment_type'		=> $_REQUEST['payment_type'],
				// 'pending_reason'	=> $_REQUEST['pending_reason'],
				'paypal_payment_date'=> $_REQUEST['payment_date'],
				'status'			=> 1,
				'added_on'			=> date('y-m-d h:i:s'),
				'payment_at'		=> date('y-m-d h:i:s'),
				'amount'			=> $_REQUEST['payment_gross'],
				'transaction_details'=> json_encode($_REQUEST),
			);
			// echo '<pre>';print_r($add);die; 
		}
			$result = $this->user->save('tbl_purchase_llis',$add);
			// echo $result;die;
		if($result){
			$data['txn_id'] = $_REQUEST['txn_id'];
			$this->load->view('template/header_home');
			$this->load->view('pages/thanks',$data);
			$this->load->view('template/footer_home');
			
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
	 		redirect('pages/course_details/'.$cid);
		}
	}
	// public function thankyou($data){
	// 	$this->load->view('template/header_home');
	// 	$this->load->view('pages/thanks',$data);
	// 	$this->load->view('template/footer_home');
	// }

	public function saveexam()
	{ 

		$correct = 0;
		$wrong   = 0;
	    $cid = $this->input->post('cid');
		$passmarrksData = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();
		$cepname = $this->db->get_where('tbl_user',array('id'=>$passmarrksData['user_id']))->row_array()['name'];
		$passmarks = $passmarrksData['passing_marks'];
		
		$all_question = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_quiz_question','course_id',$cid);
	
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

			$this->pdf($cid);
		}



		$data['user_id']            = $this->session->userdata('logged_in')['id'];
		$data['course_id']          = $cid;
		$data['status']             = 1;
		$data['percentages']        = $obtainedMarks;
  		$data['added_on']           = date('y-m-d h:i:s');
  		$data['data']           	= json_encode($qdata);
  		// print_r($data);die;
		$result = $this->user->save('tbl_exam',$data);
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
			'added_on'		=>	date('Y-m-d') 
		);
		$this->send_to_rboard($insert);
		$this->user->save('tbl_existing_certificate',$insert);
		
		redirect('pages/exam/'.$cid.'');
		// redirect('pages/certificate/'.$cid.'');
 
    	}

    public function send_to_rboard($data){
  		// $this->load->view('provider/rboard',$data);
		$uid = $data['user_id'];
		$course_name = $data['course_name'];
		$units = $data['units'];
		$start_date = $data['start_date'];
		$end_date = $data['end_date'];
		$certificate_id = $data['certificate_id'];
		$certificate = $data['certificate'];
		$category = $data['category'];
		$issue_date = $data['issue_date'];
		$issue_from = $data['issue_from'];
		$issue_by = $data['issue_by'];
		$cep_name = $data['cep_name'];
		$status = $data['status'];
		$added_on = $data['added_on'];
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		jQuery(document).ready(function($){
			var uid = '<?php echo $uid; ?>';
			var course_name = '<?php echo $course_name; ?>';
			var units = '<?php echo $units; ?>';
			var start_date = '<?php echo $start_date; ?>';
			var end_date = '<?php echo $end_date; ?>';
			var certificate_id = '<?php echo $certificate_id; ?>';
			var certificate = '<?php echo $certificate; ?>';
			var category = '<?php echo $category; ?>';
			var issue_date = '<?php echo $issue_date; ?>';
			var issue_from = '<?php echo $issue_from; ?>';
			var issue_by = '<?php echo $issue_by; ?>';
			var cep_name = '<?php echo $cep_name; ?>';
			var status = '<?php echo $status; ?>';
			var added_on = '<?php echo $added_on; ?>';
			var certificate_identify = 1;
			$.ajax({
		        url: 'https://ceonpoint.com/RBoard/Api/add_certificate',
		        type: 'POST',
		        data: JSON.stringify({
						user_id : uid, course_name : course_name, units : units, start_date : start_date,
					end_date : end_date, certificate_id :certificate_id, certificate : certificate, category : category, issue_date : issue_date, issue_from : issue_from, issue_by : issue_by, cep_name : cep_name, status : status, added_on : added_on, certificate_identify : certificate_identify
					}),
		        dataType: 'json',
		        success: function(result){
		        	// alert(result);
				}
			});
		});
	</script>
  		<?php
	}

	public function pdf($id){	

		$course_id = $id;
		$uid = $this->session->userdata('logged_in')['id'];
		$uemail = $this->session->userdata('logged_in')['username'];
		$name = $this->session->userdata('logged_in')['name'];
		 	
 		$data['course_details'] = $this->user->get_record_by_field_name_all_record('tbl_course','id',$id);
 		$data['profile'] = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);

 		$this->db->select('ct.id,ct.template_no,ct.bg_image,ct.text_image,uc.*');
		$this->db->from('tbl_user_certificate uc');
		$this->db->join('tbl_certificate_template ct', 'uc.templete_id = ct.id');  
		$this->db->where('uc.course_id ', $id); 
		$query = $this->db->get();
		$data['certificate'] = $query->result_array(); 

 		$ownerid = $data['course_details'][0]['user_id'];
 		$this->db->select('ct.countries_name as location,tu.address');
		$this->db->from('tbl_user tu');
		$this->db->join('countries ct', 'ct.countries_id = tu.location'); 
		$this->db->where('tu.id ', $ownerid); 
		$data['owner'] = $this->db->get()->result_array();

 		$data['exam_details'] = $this->user->get_exam_detail($course_id,$uid);
 		// update mail sent status in tbl_exam.
		$update['mail_sent']='1';
		$this->db->where('id',$data['exam_details'][0]['id']);
		$this->db->update('tbl_exam',$update);

 		$data['cust_data'] = $data['exam_details'];
		$data['certificate'][0]['training_title'] =  $data['course_details'][0]['course_title'];
		$data['certificate'][0]['units'] =  $data['course_details'][0]['units'];


       	// echo'<pre>';print_r($data['exam_details'][0]['certificate_id']);die;
 		//select path of template
 		$category = $data['certificate'][0]['category'];
		$temp = $data['certificate'][0]['template_no'];
		$path = $this->certificate_model->select_certificate_template_pdf($category,$temp);
		// echo $path;//die;
		$this->load->view($path,$data);
		// Get output html
		$html = $this->output->get_output();
		// print_r($path);die;
		$this->load->library('Dompdf_gen');

		$this->dompdf->load_html($html);

		if($data['certificate'][0]['category']=='Portrait'){
			$this->dompdf->set_paper('letter','portrait');
		}else{
			$this->dompdf->set_paper('letter','landscape');
		}
		$this->dompdf->render();
		$filename = $data['exam_details'][0]['certificate_id'];
		file_put_contents('assets/upload/course-pdf/'.$filename.'.pdf', $this->dompdf->output($html));
		if($this->input->post('submit')=='Download Certificate'){
			$this->dompdf->stream("certificate.pdf");
		}

		// $this->dompdf->stream("certificate.pdf", array("Attachment" => false));
		
		
	}



  	public function download_certificate($certificateNo=false){
		
		if($certificateNo==""){
			$certificateNo = $this->input->post('dcertificate');
		}
		$certificateData = $this->user->get_record_by_field_name_all_record('tbl_exam','certificate_id',$certificateNo);

		if($certificateData[0]['course_id'] != ""){
		$this->pdf($certificateData[0]['course_id']);
		$this->dompdf->stream("certificate.pdf");		
		}elseif($certificateNo && $certificateData[0]['course_id']==''){
			$base = ASSETS_URL;
			header("Location: ".$base."/upload/pdf/".$certificateNo.".pdf");			
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
			// echo $this->db->last_query();die;
		}	

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
	    $evaluation  = $this->user->get_record_by_field_name_all_record11('tbl_training_evaluation',$where);

	    $data['tr_id'] = $tr_id;
	    $data['type']  = $type;
	    $data['idd']   = $idd;
	    $data['evaluation'] = $evaluation;
	    // print_r($data);
	    
	    $this->load->view('pages/getcomment',$data);
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
		
		$data['govt'] = sprintf("%02d", 0);//this is dummy fig.

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

	public function check_user_rgistered(){
		$uid = $this->input->post('check');
		$tid = $this->input->post('tid');
		$result = $this->db->get_where('tbl_training_book',array('user_id'=>$uid,'training_seminar_id'=>$tid))->num_rows();
		// echo $this->db->last_query();
		echo $result;
	} 

	public function commentdata(){
		// print_r($this->input->post());die;
		$tr_id = $this->input->post('trid');
        $type  = $this->input->post('types');
        $idd   = $this->input->post('idd');

        if($type=='teacher'){
        	$type = 1;
        } else {
        	$type = 2;
        }
        $uid = $this->session->userdata('logged_in')['id'];
        $where = array('training_id'=>$tr_id,'evaluation_type'=>$type);
        $evaluation  = $this->user->get_record_by_field_name_all_record11('tbl_training_evaluation',$where);
        $evaluation_note  = $this->db->get_where('tbl_training',array('id'=>$tr_id))->row_array()['evaluation_note'];
        $check_evaluation_exsits  = $this->db->get_where('tbl_training_review',array('user_id'=>$uid,'training_id'=>$tr_id,'speaker_id'=>$idd))->row_array();?>
        <?php if(count($check_evaluation_exsits) > 0){ ?>
        	<div class="form-group mt-5">
        		<label>Thank you for your evaluation.</label>
        	</div>
        	<!-- // echo 'Thanks for your time'; 
        	// echo '<pre>'.$this->db->last_query();print_r($evaluation); -->
    <?php  }else{ ?>
    	<div class="front-evaluation-note"><?php echo $evaluation_note; ?></div>
        <form action="<?php echo site_url('pages/saverating'); ?>" method="post" id="evaluationsubmit">	
        		<span id="error"></span>			
				<input type="hidden" name="speaker_id" value="<?php echo $idd;?>">
				<input type="hidden" name="training_id" value="<?php echo $tr_id;?>">
				<input type="hidden" name="user_id" value="<?php echo $uid;?>">
			<?php foreach ($evaluation as $key => $value) {  ?>
				<input type="hidden" name="questionid[]" value="<?php echo $value['id'];?>">
				<input type="hidden" name="questiontype[]" value="<?php echo $value['question_type'];?>">
        		<h5><strong><?php echo $key+1;?>. <?php echo $value['evaluation_question']; ?></strong></h5>   
                <br>
                 <?php if($value['question_type']==1){ ?>
				<fieldset class="rating">
                  <input type="radio" id="field<?php echo $key+1;?>_star5" name="rating[<?php echo $value['id'];?>]" value="5" /><label class = "full" for="field<?php echo $key+1;?>_star5"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star4" name="rating[<?php echo $value['id'];?>]" value="4" /><label class = "full" for="field<?php echo $key+1;?>_star4"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star3" name="rating[<?php echo $value['id'];?>]" value="3" /><label class = "full" for="field<?php echo $key+1;?>_star3"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star2" name="rating[<?php echo $value['id'];?>]" value="2" /><label class = "full" for="field<?php echo $key+1;?>_star2"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star1" name="rating[<?php echo $value['id'];?>]" value="1" /><label class = "full" for="field<?php echo $key+1;?>_star1"></label>
                  </fieldset>
                  <br><br>
			     <?php } ?>
		<?php if($value['question_type']==2){  ?>
        <div class="form-group">
            <textarea class="form-control" name="comments[<?php echo $value['id'];?>]" id="comments" placeholder="Comments" required></textarea>
        </div>
      <?php	} }//break;  ?>
        <div class="form-group text-right">
            <input type="button" onclick="checklogin('<?php echo $tr_id;?>')" value="Submit Evaluation" class="btn btn-primary btn-lg">
        </div>
    </form>
	<?php } ?>
    <style type="text/css">
 @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
.rating { 
  border: none;
  float: right;
  margin:0px 0px 0px 28px;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin-top: 2px;
  padding:0px 5px 0px 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
    color: #fff; 
    float: right;
    margin:4px 1px 0px 0px;
    background-color:#D8D8D8;
    border-radius:15px;
  height:25px;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { 
    background-color:#7ED321 !important;
  cursor:pointer;
} /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { 
    background-color:#7ED321 !important;
  cursor:pointer;
} 
</style>

<script type="text/javascript">
 jQuery(document).ready(function($){      
  $("label").click(function(){
  $(this).parent().find("label").css({"background-color": "#D8D8D8"});
  $(this).css({"background-color": "#7ED321"});
  $(this).nextAll().css({"background-color": "#7ED321"});
});      
});
 	function checklogin(tid){
 	var check = "<?php echo $this->session->userdata('logged_in')['id']; ?>";
 	var role = "<?php echo $this->session->userdata('logged_in')['role']; ?>";
        if(check == ""){
        	$("#login_registration").modal('show');
           // var r = confirm("Please! \nLogin first!!");
           // if(r){
           //  window.location.href = "<?php echo base_url('users'); ?>";
           // }
        }else{
		    $.ajax({
		        url: '<?php echo site_url('pages/check_user_rgistered'); ?>',
		        type: 'POST',
		        data: {
		            check: check, tid: tid
		        },
		        dataType: 'json',
		        success: function(data) {
		            if(data > 0){
    					$("#evaluationsubmit").submit(); 
		            }else{
		            	$("#alertForRegistration").modal('show');
		          		// var b = confirm("Please register in this training first in order to do the evaluation.");
				        // if(b){
				        //     window.location.href = "<?php echo base_url('pages/training_details_evaluation/'); ?>"+tid+"<?php echo '?popup=123'?>";
				        //     // window.location.href = "<?php echo base_url('users/signup/professional') ?>";
				        // }
		            }
		        }
		    });
        }
 	}

</script>

<?php }	 
} 