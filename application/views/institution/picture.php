<?php
$insititution_id =  $userdata['insititution_id'];
$uid = $this->session->userdata('logged_in')['id'];
$fulldetails = $this->share->getuser_info($uid,5);

// echo '<pre>'; print_r($fulldetails);

$this->load->model('institution_modal','institution');  
$this->load->model('provider_model');  

if($fulldetails['details']->under_insititution == 0){ 
    $curr_training_date = $this->institution->get_latest_training_date($uid);
}else{
    $curr_training_date = $this->institution->get_latest_training_date($fulldetails['details']->parent_insititution);
}

$training_date = $this->user->get_latest_training_date($uid);
$noticationCount = $this->db->get_where('tbl_notification',array('to'=>$uid,'status'=>1))->result_array();
$ncount = count($noticationCount);

$insNameRow = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
$insName = $insNameRow['under_provider'];
//echo $uid;
$institutionIdArr = $this->user->get_record_by_multi_field_name('tbl_user',array('id'=>$uid));

if($fulldetails['details']->under_insititution==0){ 
    $institutionId = $fulldetails['details']->insititution_id;
    $insuserId = $fulldetails['details']->id;

    if($fulldetails['child_info']){
        $insArr = array_column($fulldetails['child_info'],'cinsititution_id');
        $insidArr = array_column($fulldetails['child_info'],'cid');
        $cepArr = array_column($fulldetails['cep_info'],'cepid');
        array_push($insArr ,$institutionId);
        array_push($insidArr ,$insuserId);
    }else{
        $insArr = array($institutionId);
        $insidArr = array($insuserId);
        $cepArr   = isset($fulldetails['cep_info'])?array_column($fulldetails['cep_info'],'cepid'):0;
    }

}else{
    $pinsid = $this->db->get_where('tbl_user',array('id'=>$uid))->row();
    $pdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$pinsid->parent_insititution); 
    // print_r($pdetails); die;
    $institutionId = $fulldetails['details']->insititution_id;
    $pinstitutionId = $fulldetails['parent_info']['pinsititution_id'];
    $cepArr   = isset($fulldetails['cep_info'])?array_column($fulldetails['cep_info'],'cepid'):0;
    $insArr = array($institutionId);
    $insidArr = array($fulldetails['details']->id);
}


$where1 = array('role'=>5,'status'=>1,'parent_insititution'=>$uid);
$subinstitution1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
// $totalSubInstitute =count($subinstitution1);
$totalSubInstitute = count($fulldetails['child_info']);

$where2 = array('role'=>2,'status'=>1,'parent_insititution'=>$uid);
$ceproviderlist = $this->user->get_record_by_multi_field_name('tbl_user',$where2);
// $totalCeProvider =  count($ceproviderlist);
$totalCeProvider =  count($fulldetails['cep_info']);

$where1 = array('parent_insititution'=>$uid,'status'=>1,'role'=>2);
$provider_under_ins = $this->user->get_record_by_multi_field_name('tbl_user',$where1); 

$where3 = array('role'=>6,'status'=>1,'under_provider'=>$provider_under_ins[0]['insititution_id']);
$authorlist = $this->user->get_record_by_multi_field_name('tbl_user',$where3);
// $totalAuthor = count($authorlist);
$totalAuthor = count($fulldetails['author_info']);
$staffArr = $this->share->get_staff_under_institution($cepArr);
$totalstaff = count($staffArr); 

$CourseArr = $this->share->get_course_under_institution($insArr);
$totalCourse_count = ($CourseArr != '')?count($CourseArr):0;

$trainingArr = $this->share->get_training_under_institution($insArr);
$totalTraining_count = ($trainingArr != '')?count($trainingArr):0;

$where4 = array('role'=>1,'status'=>1,'parent_insititution'=>$uid);
$professionallist = $this->user->get_record_by_multi_field_name('tbl_user',$where4);
$totalProfessional = count($professionallist);

$totallist = $this->share->getinstitution_tracker_data($insArr);
// print_r($totalcount); die;// 6-16-2021 4:00

$totalCourse = $totallist['course'];
$totalTraining = $totallist['training'];

$courseCertificate = $this->provider_model->course_certificate_list($insArr);
$trainingCertificate = $this->provider_model->training_certificate_list($insArr);
$totalCertificate = $trainingCertificate['num_rows'] + $courseCertificate['num_rows'];

// $persant=($totalProfessional+$totalAuthor+$totalCeProvider+$totalSubInstitute+$totalCourse+$totalTraining+$totalCertificate)*7/100;

$target = 0;
$target_list = $this->share->provider_set_target_staff_to_be_trained($insidArr);
if(isset($target_list) && !empty($target_list)){
    $targetArr = array_column($target_list,'target_number');
    $target = array_sum($targetArr);
}
$under_ins = $this->db->get_where('tbl_user',array('parent_insititution'=>$uid,'role'=>2))->result_array();
if($under_ins){
    $user_ins_id = array_column($under_ins,'insititution_id');
    $this->db->select('is.*,u.profession,u.id as pid');
    $this->db->from('tbl_institution_staff is');
    $this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
    $this->db->where_in('is.insititution_code',$user_ins_id);
    $this->db->where('is.activated',1);
    $staff = $this->db->get()->result_array();
    if($staff !=""){
        $staff_list = count($staff);
    }else{
        $staff_list = 0;
    }
}else{
    $staff_list = 0;
}

$allstaff = $totalCertificate; 
    if(!empty($target) && $allstaff > 0){
        $persant = ($allstaff / $target) * 100;
    }else{
        $persant = 0;
    }

// foreach ($filteredArray as $key => $value) {
//     $where1 = array('present_status'=>1,'training_seminar_id'=>$value['id']);
//     $Alltraining = $this->user->get_record_by_field_name_all_record11('tbl_training_book',$where1); 
//     $count = $count + count($Alltraining);
// }

// foreach ($filteredArray1 as $key => $value) {
//     // $where = array('item_name'=>$value['id'],'archive'=>'0','status'=>1);
//     // $Allpurchase = $this->user->get_record_by_field_name_all_record11('tbl_purchase_llis',$where); 
//     // $count1 = $count1 + count($Allpurchase);
//     $allcertificates = $this->db->get_where('tbl_exam',array('course_id'=>$value['id'],'status'=>1))->result_array();
//     $count1 = $count1 + count($allcertificates);
//     // echo $this->db->last_query().'<br>';
// }
// // echo $count.' + '.$count1;
//     $allstaff = $count + $count1;
?>
<div class="professionals-banner">
    <div class="container">
        <div class="row">

                <div class="col-sm-3">
                    <div class="d-flex">
                        <?php 
                        $uid = $this->session->userdata('logged_in')['id'];
                        $userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
                        ?>
                        <div class="author-thumb usertype<?php echo $this->session->userdata('logged_in')['role'] ?>">
                            <?php 
                            if($userdata['image']==""){
                                $src = ASSETS_URL.'images/staff-3.png';
                            }else{
                                $src = ASSETS_URL.'images/uploads/'.$userdata['image']; 
                            } ?>
                            <img src="<?php echo $src; ?>" alt="institution-image">
                        </div>
                        <div class="profile-content">
                        <?php $insprofession = $this->db->get_where('tbl_category_institution',array('id'=>$userdata['profession']))->row_array()['cat_name'];?>
                        <?php $country_name = $this->db->get_where('countries',array('status'=>1, 'countries_id'=>$userdata['country']))->row_array()['countries_name'];
                            $date    = $userdata['added_on'];
                            $newdate = strtotime ( '+3 year' , strtotime ( $date ) ) ;
                            $newdate = date ( 'jS F, Y' , $newdate ); ?>
                            <p><?php echo $userdata['name'];?>
                            <a href="<?php echo site_url('share/notification');?>">
                            <span class="notification-icon" style="position: relative;top:0px;">
                            <i class="fa fa-bell" title="Notification" aria-hidden="true" style="display: inline-block; font-size: 25px; color: #FFD700; vertical-align: middle; margin-right: 10px;"></i>
                            <span class="notification-no" style="    position: absolute;right: 0;background-color: #e83330; width: 15px;height: 15px;line-height: 15px;text-align: center; border-radius: 50%;font-size: 11px;box-shadow: -1px 3px 7px rgba(0, 0, 0, 0.3);top: 2px;color: #fff;"><?php if($ncount){ echo $ncount; }else{ echo 0; } ?></span>
                            </span></a><br/>
                                Category : <?php echo $insprofession; ?><br/>
                                Country : <?php echo $country_name; ?><br/>
                                Insititutuon Id : <?php echo $userdata['insititution_id']; ?></p>
                        </div>
                    </div>
                     
                    <div class="">
                        <?php if($fulldetails['details']->under_insititution==0){
                            $href =base_url('web/').$institutionId; ?>
                            <a href="<?php echo $href; ?>" class="btn btn-info" style="margin-top:15px;">INSTITUTION WEBPAGE</a>
                            <a href="<?php echo BASE_URL.'institution/staffcerecords';?>" class="btn btn-primary" style="margin-top:15px;">Staff CE Record</a>
                        <?php }else{ 
                            $href =base_url('web/').$pinstitutionId; 
                            $subhref = base_url('share/viewprofile/').$uid;  ?>
                            <a href="<?php echo $href; ?>" class="btn btn-info" style="margin-top:15px;">INSTITUTION WEBPAGE</a>
                            <a href="<?php echo $subhref; ?>" class="btn btn-primary" style="margin-top:15px;">SUB INSTITUTION WEBPAGE</a>
                            
                        <?php } ?>
                        <!-- <a href="<?php echo BASE_URL.'institution/stafflicensestatus';?>" class="btn btn-success" style="margin-top:15px;">STAFF LICENSE STATUS  </a> -->
                        
                        <a href="javascript:void(0)" onclick="send_to_cep()" class="btn btn-info" style="margin-top:15px;">Send Code</a>


                    </div>
                </div>


               <div class="col-sm-9">
                    <div class="row banner-count-desc d-flex">
                       <!--  <div class="col-xs-3 text-center item">
                            <div class="icon-container">0</div>
                            <h2>Online Courses</h2>
                        </div> -->
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="width: 170px;background:##FF0000"><?php echo $target; ?></div>
                            <h2>Target No. of Staff to be trained</h2>
                        </div>
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="width: 170px;background:##FF0000"><?php echo $allstaff; ?></div>
                            <h2>Number of Staff Trained </h2>
                        </div>
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="width: 170px;background:##FF0000"><?php echo $target - $allstaff; ?></div>
                            <h2>Needed Staff To be Trained</h2>
                        </div>
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="width: 170px; background:#43c300;">
                            <?php if($target >= ($allstaff)){ 
                                    echo 'On Completion'; 
                                } else { 
                                    echo 'Completed'; } ?>
                            </div>
                            <h2>Status</h2>
                        </div>
                    </div>
                </div>
                
			
                <div class="col-sm-9" style=" background: #fff; border: 1px #2d67eb solid; border-radius: 5px; height: 20px;
                    margin-top:51px; padding:0px;">
                    <div class="traker" style="text-align:right; background:green; margin:0px;padding-right:7px;width:<?=round($persant)?>%;height:100%;" ><?=round($persant)?> %</div>
                </div>
            <!-- </div> -->
            <div class="col-sm-9 text-center mt-4">
                <p class="text-danger"><b>
                   SET TRAINING PERIOD : <?php if(!empty($curr_training_date)){ 

                    $yrdata= strtotime($curr_training_date->start_date);
                    $strtdate =  date('M d, Y', $yrdata);

                    $yrdata1= strtotime($curr_training_date->end_date);
                    $enddate =  date('M d, Y', $yrdata1);
                        echo $strtdate.'-'.$enddate; 
                        if($fulldetails['details']->under_insititution==0){ 
                            echo '<button data-value="'.$curr_training_date->start_date.'" data-name="'.$curr_training_date->end_date.'" id="settrainingperiode2" data-id="'.$curr_training_date->id.'"  class="btn btn-primary pull-right">EDIT TRAINING PERIOD</button>';
                        }
                    }else{ 
                        echo 'Yet to set'; 
                        if($fulldetails['details']->under_insititution==0){ 
                        echo '<a onclick="setmaintarget()" class="btn btn-primary">SET TRAINING PERIOD</a>'; 
                        }
                    } ?></b></p>
            </div>
		</div>
    </div>

<div class="container">
        <div class="row" style="padding-top: 15px;">
        <div class="d-flex">
            <?php if($fulldetails['details']->under_insititution==0){ ?>
            <div class="col-md-2 text-center">
                <span class="advcircle"><?php echo $totalSubInstitute; ?></span><p class="advtext">SUB INSTITUTION</p>
            </div>
            <?php } ?>
            <div class="col-md-2 text-center">
                <span class="advcircle" ><?php echo $totalCeProvider; ?></span><p class="advtext">CE PROVIDERS</p>
            </div>
            <div class="col-md-2 text-center">
                <span class="advcircle"><?php echo $totalAuthor; ?></span><p class="advtext">AUTHORS</p>
            </div>
            <div class="col-md-2 text-center">
                <span class="advcircle" ><?php echo $totalstaff; ?></span><p class="advtext">STAFF</p>
            </div>
            <div class="col-md-2 text-center">
                <span class="advcircle" ><?php echo $totalCourse_count; ?></span><p class="advtext">ONLINE COURSES</p>
            </div>
            <div class="col-md-2 text-center">
                <span class="advcircle" ><?php echo $totalTraining_count; ?></span><p class="advtext">TRAINING/SEMINARS</p>
            </div>
            <div class="col-md-2 text-center">
                <span class="advcircle" ><?php echo $totalCertificate; ?></span><p class="advtext">CERTIFICATES</p>
            </div>
            <!-- <div class="col-md-2 text-center">
                <span class="advcircle" ><?php echo $totalProfessional; ?></span><p class="advtext">PROFESSIONALS</p>
            </div> -->
        </div>
        <?php 
        //}
        ?>  
        </div>
</div>

</div>     
		

    <div class="modal fade" id="welcomeinstitution"  role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <center>
                        <div class="site-logo__link" style="max-width: 34%;">
                            <a href="<?php echo base_url();?>">
                                <img src="<?php echo ASSETS_URL.'images/logo.png';?>" alt="logo"></a>
                        </div>
                    </center>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title text-center" style="font-weight: bold;">
                        <img src="<?php echo ASSETS_URL.'images/congratulations.png';?>" alt="congratulations" width="175"><span><i>!</i></span>
                    </h4>
                <p><b>You have just activated your Institution's account using 
                    </br>Institution Continuing Education Management Software (ICE-MS)
                    
                    <?php if($fulldetails['details']->under_insititution==1){ echo '</br>Please set your training start date and end date.'; } ?>
                    
                    </br></br>But first to Please, send your Instituion Code to your CE Providers.
                </b></p>
                    <br/>
                    <a href="javascript:void(0)" onclick="send_to_cep()" class="btn btn-success">Send Now!</a>
                      
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="send_code"  role="dialog">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <div class="site-logo__link" style="max-width: 34%;">
                        <a href="<?php echo base_url();?>">
                            <img src="<?php echo ASSETS_URL.'images/logo.png';?>" alt="logo"></a>
                    </div>
                </center>
                </div>
                <div class="modal-body">
                    <p><b>NOTE:<i> This information will be used by sub-institution and CE Provider as they register under this institution account.</i></b></p>
                    <form action="<?php echo base_url('institution/send_to_cep'); ?>" method="post">
                        <div class="row">
                            
                        <div class="col-sm-6">
                            <label>Name of Institution: </label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="insname" value="<?php echo $insNameRow['name']; ?>">
                        </div>    
                        <div class="col-sm-6">
                            <label>Code of the Institution: </label>
                        </div>    
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="inscode" value="<?php echo $insNameRow['insititution_id']; ?>">
                        </div>
                        <label><b>You can send multiple emails by using comma(,) separator. <i>Like: abc@gmail.com, xyz@yahoo.com</i></b></label>
                        <div class="col-sm-6">
                            <label>Mail send to: </label>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control" name="send_to">
                                <option value="provider" selected >CEP Provider</option>
                                <?php  if($fulldetails['details']->under_insititution==0){ ?>
                                <option value="sub_institution">Sub Institution</option>
                                <?php } ?>
                            </select>    
                        </div>
                        <div class="col-sm-6">
                            <label>Enter email of CE Provider: </label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="cepemail" value="" required>    
                        </div>
                        </div>
                        
                        <input type="submit" class="btn btn-success mt-5" name="submit" value="Send Now!">
                    </form>    
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal  Update set target in institution-->
    <div id="set_target" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <?php if($_REQUEST['id']=="success"){ ?><p class="alert alert-success">Mail sent to CEP.</p><?php } ?>
                    <h4 class="modal-title">Please set your Training Period.</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo site_url('institution/settargetdate'); ?>" method="post" enctype="multipart/form-data"
                        name="form1settargetdate" id="form1settargetdate">
                        <p>
                            <label>Starting Date <span class="required"> * </span> </label>
                            <input type="date" class="form-control" name="start_date" id="training_periode_sdate" required >
                            <input type="hidden" class="form-control" name="id" id="training_periode_id">
                            <span class="error"></span>
                        </p>

                        <p>
                            <label>Ending Date <span class="required"> * </span> </label>
                            <input type="date" class="form-control" name="end_date" id="training_periode_edate" required >
                            <span class="error"></span>
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-primary mt-5" value="Update" type="submit" name="save">
                            <button type="button" class="btn btn-info mt-5" data-dismiss="modal">Close</button>
                        </p>

                    </form>
                </div>
                <!-- <div class="modal-footer">
                </div> -->
            </div>
        </div>
    </div>


<script>

    $(document).ready(function() {
        var welcome ='<?php if($insNameRow['logged_in'] < 2){ ?>'+ $("#welcomeinstitution").modal('show') + '<?php } ?>';
        // var settarget = '<?php if($_REQUEST['id']=="success"){ ?>' + $("#welcomeinstitution").modal('hide'); $("#set_target").modal('show'); + '<?php } ?>'; //we can use it as pop for set target in ins... 
    });

     function send_to_cep()
    { 
        $("#welcomeinstitution").modal('hide');
        $("#send_code").modal('show');
    }        
   
   $('#settrainingperiode2').on('click', function(){
        var start = $("#settrainingperiode2").attr('data-value');
        var end = $("#settrainingperiode2").attr('data-name');
        var id = $("#settrainingperiode2").attr('data-id');
        // alert(id+' , '+start+' , '+end);
        $("#training_periode_id").val(id);
        $("#training_periode_sdate").val(start);
        $("#training_periode_edate").val(end);
        $("#set_target").modal("show");
    });
</script>
      