<?php
$uid = $this->session->userdata('logged_in')['id'];
$parentid = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['parent_insititution']; 
$insid = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['insititution_id']; 
$uins = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_insititution'];  
$userdetailsa = $this->user->get_latest_training_date($parentid);
 
$noticationCount = $this->db->get_where('tbl_notification',array('to'=>$uid,'status'=>1))->result_array();
$ncount = count($noticationCount);

$yrdata   = strtotime($userdetailsa[0]['start_date']);
$strtdate = date('M d, Y', $yrdata);
$yrdata1  = strtotime($userdetailsa[0]['end_date']);
$enddate  = date('M d, Y', $yrdata1); 

$user_loggedin = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['logged_in']; 
$profuserdata = $this->db->get_where('tbl_professionals',array('user_id'=>$uid))->row_array();
$insNameRow = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
$insName = $insNameRow['under_provider'];
$citationsgetdata = $this->db
            ->get_where('tbl_citations_list',array('pro_id'=>$profuserdata['pro_id']))
            ->result_array();
        $this->db->where('e.added_on >=',$userdetailsa[0]['start_date']);
        $this->db->where('e.added_on <=',$userdetailsa[0]['end_date']);
        $course_certificate 	= $this->provider_model->exam_list($uid);
        
        $this->db->where('tb.added_on >=',$userdetailsa[0]['start_date']);
        $this->db->where('tb.added_on <=',$userdetailsa[0]['end_date']);
        $training_certificate 	= $this->provider_model->training_list($uid);
        $currentUser    = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);

        $this->db->where(array('role'=>6,'status'=>1));
        $total_author = $this->user->get_record_by_field_name_all_record('tbl_user','under_provider',$currentUser[0]['insititution_id']);

        $this->db->select('is.*,u.id as pid');
        $this->db->from('tbl_institution_staff is');
        $this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
        $this->db->where(array('is.insititution_code'=>$insid,'is.status'=>'1','is.activated'=>'1'));
        $staff_list = $this->db->get()->result_array();

            $practicegetdata = $this->db
            ->get_where('tbl_practice_list',array('pro_id'=>$profuserdata['pro_id']))
            ->result_array();
                $affiliationgetdata = $this->db
                ->get_where('tbl_affiliation_list',array('pro_id'=>$profuserdata['pro_id']))
                ->result_array();
                    $uploadedimg = $this->db
                    ->get_where('tbl_user_docutments',array('user_id'=>$uid,'filetype'=>'img'))
                    ->result_array();
                        $uploadedvideo = $this->db
                        ->get_where('tbl_user_docutments',array('user_id'=>$uid,'filetype'=>'video'))
                        ->result_array();
$where = array('tbl_user_subscription_buy.user_id'=>$uid,'tbl_user_subscription_buy.sub_status'=>'1');
$join = array('tbl_user_subscription_packages', 'tbl_user_subscription_packages.subs_id=tbl_user_subscription_buy.subs_id');
$subscriptionimg = $this->db->join($join[0], $join[1])->get_where('tbl_user_subscription_buy',$where)->row_array();

$dailyprices = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
$providertax = $this->db->get_where('tbl_all_tax',array('id' => 1,'status' => 1 ))->row_array();
if($subscriptionimg['sub_status'] == '1'){
    $uploadnophoto = $subscriptionimg['subs_no_photo'];
    $uploadnovideo = $subscriptionimg['subs_no_video'];
    if(is_array($uploadedimg) && count($uploadedimg) >0){
        $uploadnophoto = $subscriptionimg['subs_no_photo']-count($uploadedimg);
        $uploadnovideo = $subscriptionimg['subs_no_video']-count($uploadedvideo);
    }
    if(is_array($uploadedvideo) && count($uploadedvideo) >0){
        $uploadnovideo = $subscriptionimg['subs_no_video']-count($uploadedvideo);
    }
}else{
    $uploadnophoto = 4;
    $uploadnovideo = 4;
}
$under_insititution = $this->session->userdata('logged_in')['under_insititution'];
?>
<section class="professionals-banner picprovider-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="d-flex">
                <?php   $uid = $this->session->userdata('logged_in')['id'];
                        $uemail = $this->session->userdata('logged_in')['username'];
                        $userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
                        $uinsid = end(explode('-', $userdata['under_provider'])); 
                        $uinsname = $this->db->get_where('tbl_user',array('id'=>$uinsid))->row_array()['name'];?>
                    <div class="author-thumb usertype<?php echo $this->session->userdata('logged_in')['role'] ?>">
                    <?php if($userdata['image']==""){ ?>
                        <img src="<?php echo ASSETS_URL.'images/staff-3.png'; ?> " alt="">
                    <?php } else { ?>
                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$userdata['image']; ?>" alt="">
                    <?php } ?>
                    <!-- <div class="pos">Registered Nurse</div> -->
                    </div>
                    <div class="profile-content">
                        <h5><?php echo $userdata['name']?>
                            <a href="<?php echo site_url('share/notification');?>">
                            <span class="notification-icon" style="position: relative;top:0px;">
                            <i class="fa fa-bell" title="Notification" aria-hidden="true" style="display: inline-block; font-size: 25px; color: #FFD700; vertical-align: middle; margin-right: 10px;"></i>
                            <span class="notification-no" style="    position: absolute;right: 0;background-color: #e83330; width: 15px;height: 15px;line-height: 15px;text-align: center; border-radius: 50%;font-size: 11px;box-shadow: -1px 3px 7px rgba(0, 0, 0, 0.3);top: 2px;color: #fff;"><?php if($ncount){ echo $ncount; }else{ echo 0; } ?></span>
                            </span></a>
                        </h5>
                        <p><strong>Profession :</strong> <?php echo $userdata['profession'];?></p>
                            <?php if(!empty($userdata['prc_acceditation_number'])){ ?>
                        <p><strong>Accreditation  :</strong> <?php echo $userdata['prc_acceditation_number'];?><?php } ?></p>
                            <?php if(!empty($userdata['under_provider'])){ ?>
                        <p><strong>Institution :</strong> <?php echo ucwords($uinsname);?><?php } ?></p>

                        <p><?php if($userdata['added_on'] != '0000-00-00'){
                            $date  = $userdata['added_on'];
                            $newdate = date ( 'jS F, Y' , strtotime($date));
                              echo '<strong>Registered Date :</strong>'.$newdate; } ?></p>
                    </div>
                </div>
                <div class="prof-btns">
                  <!--   <a href="http://govt.ceonpoint.com/accreditation/renewlicence"  class="btn btn-info" style="margin-bottom:15px;">Renew Accreditation</a> -->
                  <div class="viewprofile-editbox">
                    <a href="<?php echo site_url('share/viewprofile/'.$uid.'');?>" class="btn btn-success">View My Page</a>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#editbg">
                        <button class="btn btn-success" ><i class="fa fa-edit"></i></button></a>
                    </div>
                <?php if($under_insititution == 0){ ?>
                    <?php if($this->session->userdata('logged_in')['role'] == 1){   
                    echo '<a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#promoteProfile">Promote Your Practice</a>'; } ?>

                    <?php if($this->session->userdata('logged_in')['role'] == 2){   
                    echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#promoteYourCompany">Feature Your Company</a>'; } ?>

                <?php } else { ?>
                    <a href="<?php echo BASE_URL.'web/'.$insName; ?>" class="btn btn-info">Institution CE Webpage</a>
                    <a href="<?php echo site_url('provider/staffcerecords');?>" class="btn btn-warning">Staff CE Record</a>
                <?php } ?>

                <a href="javascript:void(0)" onclick="send_to_author()" class="btn btn-primary" >Send code to Author</a>
                  <!--    <a href="http://govt.ceonpoint.com/provider" class="btn btn-warning" style="margin-top:15px;">Renew License</a> -->
                </div>
            </div>


            <?php 
            $uid         = $this->session->userdata('logged_in')['id']; 
            // $this->db->where('status','3');
            // $this->db->where('user_id',$uid)->or_where('author_reference_id',$uid);
            $this->db->select('c.*, cat.cat_name');
            $this->db->from('tbl_course c' ); 
            $this->db->join('tbl_category cat', 'c.course_category = cat.id',LEFT);
            $this->db->order_by('id','desc');
            $this->db->group_start();
            $this->db->where('c.user_id',$uid)->or_where('c.author_reference_id',$uid);
            $this->db->group_end();
            $this->db->where('c.status','1');
            $totalCourse = $this->db->get()->result_array();
            // echo $this->db->last_query();
            
            foreach($totalCourse as $arr => $a){
                $courseid[] = $totalCourse[$arr]["id"];
            }
            $this->db->where_in('item_name',$courseid);
            $totalIncome = $this->db->get('tbl_purchase_llis')->result_array();
            // $totalIncome = $this->user->get_report('total',$uid);
            $totalPurchaseUsers = $this->db->get_where('tbl_purchase_llis',array('user_id'=>$uid))->result_array();
            $totalTraining = $this->db->get_where('tbl_training',array('user_id'=>$uid,'status'=>'2'))->result_array();

            $total_total = 0; 
            foreach ($totalIncome as $key => $value) {
            $amt = $value['amount'] * $value['quantity'];
            $total_total = $total_total + $amt;
            }


            $grandSome = 0;
            $sum  = 0;
            $sum1 = 0;
            $uid = $this->session->userdata('logged_in')['id'];
            $purchase_list1 = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_exam','user_id',$uid);
            
            $previous_certificate1 = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_existing_certificate',array('user_id'=>$uid,'archive'=>0),'');


            foreach ($purchase_list1 as $key => $value) {
            $course = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course',array('id'=>$value['course_id']),'');
            $sum = $sum+$course[0]['units'];
            }
            foreach ($previous_certificate1 as $key => $value1) {
            $sum1 = $sum1+$value1['units'];
            } 

            $grandSome = $sum+$sum1;

            // echo $this->session->userdata('logged_in')['profession'];
            $Idd = $this->session->userdata('logged_in')['id']; 

            $category = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category','cat_name',$this->session->userdata('logged_in')['profession']);
            $target_unit = $category[0]['target_units'];

            $unit = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_units','user_id',$Idd);

            $target_unit = $unit[0]['unit']; ?>


            <div class="col-md-9 col-sm-8">
                <div class="banner-count-desc">
                    <div class="row">
                        <?php 
                        if($this->session->userdata('logged_in')['role'] == 1){ 
                            ?> 

                        <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="background:#275bf4"><?php if($target_unit) { echo $target_unit;} else { echo "0";}?> <span>Staff</span></div>
                            <h2>Required CE Units/Contact Hours</h2>
                        </div>
                        

                        <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container"><?php echo $grandSome; ?> <span>Staff</span></div>
                            <h2>Total Units/Contact Hours Obtained</h2>
                        </div>
                    
                        <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="background:#a80693"><?php echo $target_unit - $grandSome; ?> <span>Staff</span></div>
                            <h2>Balance</h2>
                        </div>
                        <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="background:#43c300;">
                            <?php if($grandSome >= $target_unit){ 
                                echo 'Completed'; } else { echo 'On Completion'; } ?>
                            </div>
                            <h2>Status</h2>
                        </div>

            <?php  } else {   ?>


    <?php 
    $target = 0;
    $uid2 = $this->session->userdata('logged_in')['id'];
    $this->db->where('status',1);
    $userdetails2 = $this->user->get_record_by_field_name_all_record('tbl_provider_set_target','user_id',$uid2);

    foreach ($userdetails2 as $key => $value) {
    $target = $target + $value['target_number'];
    }

    $allstaff = $training_certificate + $course_certificate;  
    ?>

            <?php
            //print_r($this->session->userdata('logged_in')['under_insititution']);
            if($this->session->userdata('logged_in')['under_insititution']>0)
                    { ?>
                        <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="width: 170px;"><?php echo $target; ?> <br> Staff</div>
                            <h2>Target Staff <br>To be Trained</h2> 
                            
                        </div>

                        <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="width: 170px;"><?php echo $allstaff; ?><br> Staff</div>
                            <h2>Total Staff Trained</h2>
                        </div>

                        <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="width: 170px;"><?php echo $target - $allstaff; ?><br> Staff</div>
                            <h2>Balance</h2>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="width: 170px; background:#43c300;">
                                <?php if($target >= ($allstaff)){ 
                                    echo 'On Completion'; 
                                } else { 
                                    echo 'Completed'; } ?>
                            </div>
                            <h2>Status</h2>
                        </div>
                
            <?php   }else{  
                    $totalIncomeProvider = $this->provider_model->total_income($uid ,'month');
                ?>
                        <div class="col-sm-4 col-xs-12 text-center item">
                            <div class="icon-container">$<?php echo number_format(floatval($totalIncomeProvider),2); ?></div>
                            <h2>Month Earnings<br>(<?=date('F Y')?>)</h2>
                        </div> 
                    <?php } ?>
                    <?php if($under_insititution == '0'){ ?>    
                        <div class="col-sm-2 col-xs-6 text-center item">
                            <div class="icon-container" style="background:#275bf4"><?php echo count($totalCourse);?></div>
                            <h2>Total Courses</h2>
                        </div>
                        <div class="col-sm-2 col-xs-6 text-center item">
                            <div class="icon-container" style="background:#a80693"><?php echo count($totalTraining);?></div>
                            <h2>Total Training</h2>
                        </div>
                    <div class="col-sm-2 col-xs-6 text-center item">
                            <div class="icon-container" style="background:#ffa500"><?php echo $course_certificate + $training_certificate;?></div>
                            <h2>Total Certificates</h2>
                        </div>
                        <div class="col-sm-2 col-xs-6 text-center item">
                            <div class="icon-container" style="background:#2cdd17"><?php echo count($total_author); ?></div>
                            <h2>Total Authors</h2>
                        </div>
                <?php } ?>
        <?php } ?>
                
        <?php if($this->session->userdata('logged_in')['under_insititution']>0){ 
                if(!empty($target) && $allstaff > 0){
                    $persant = ((($allstaff)*100)/($target));
                }else{
                    $persant = 0;
                }?>            
                    <div class="col-md-12" style=" background: #fff; border: 1px #2d67eb solid; border-radius: 5px; height: 20px; margin-top:51px; padding:0px;">
                        <div class="traker" style="text-align:right; background:green; margin:0px;padding-right:7px;width:<?=round($persant)?>%;height:100%;" ><?=round($persant)?> %</div>
                    </div>
                    <div class="col-md-12 text-center">
                    <p style="color: red; font-size: 14px; font-weight: bold;margin-top: 16px;">TRAINING PERIOD : <?php if(!empty($userdetailsa)){ echo $strtdate.'-'.$enddate; }else{ echo 'Yet to set'; } ?></p>
                    </div>
                        
        <?php } ?>
                    </div>
               </div>
            </div> 

            <?php if($under_insititution == '1'){ ?>
            <div class="col-md-12">
                <div class="advcircle-box" style="padding-top: 15px;">
                <div class="row">
                    <div class="col-xs-2 text-center">
                        <span class="advcircle"><?php echo count($totalCourse);?></span><p class="advtext">Total Courses</p>
                    </div>
                    <div class="col-xs-2 text-center">
                        <span class="advcircle" ><?php echo count($totalTraining);?></span><p class="advtext">Total Training</p>
                    </div>
                    <div class="col-xs-2 text-center">
                        <span class="advcircle"><?php echo $course_certificate + $training_certificate;?></span>
                        <p class="advtext">Total Certificates</p>
                    </div>
                    <div class="col-xs-2 text-center">
                        <span class="advcircle" ><?php echo count($total_author); ?></span><p class="advtext">Total Authors</p>
                    </div>
                    <div class="col-xs-2 text-center">
                        <span class="advcircle" ><?php echo count($staff_list); ?></span><p class="advtext">Total Staff</p>
                    </div>
                </div>
                </div>
            </div>
            <?php } ?>  
        
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="editbg" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Edit Webpage Background and Profile</h4>
    </div>
    <?php echo form_open_multipart('provider/editbg'); ?>
    <div class="modal-body">
        <div class="row form-group">
            <p class="col-sm-6">
                <label>Profile Image</label>
                <input class="form-control" name="image" type="file">
                <span class="error"></span>
            </p>
            <p class="col-sm-6">
                <label>Background Image <small id="" class="form-text text-muted"> ( Size should be 1500 x 540 or less )</small></label>
                <input class="form-control" name="backimage" type="file">
                <span class="error"></span>
            </p>
        </div>
        <div class="row form-group">
            <p class="col-sm-6"><?php if($currentUser[0]['image'] != ''){ ?>
                <img src="<?php echo ASSETS_URL.'images/uploads/'.$currentUser[0]['image']; ?>" width="150">
            </p><?php } ?>
            <p class="col-sm-6"><?php if($currentUser[0]['backimage'] != ''){ ?>
                <img src="<?php echo ASSETS_URL.'images/uploads/'.$currentUser[0]['backimage']; ?>" width="200">
            </p><?php } ?>
        </div>
    </div>
    <div class="modal-footer">
        <input class="btn btn-primary" value="Update" name="submit" type="submit">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    <?php echo form_close(); ?>
  </div>
  
</div>
</div>

<div class="modal fade" id="promoteProfile" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content text-left">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Promote Your Profession</h4>
            </div>
            <div class="modal-body">
                <div class="promote-profile">
                    <?php echo form_open(current_url(), array('class' => '', 'enctype' => 'multipart/form-data', 'id' => 'form-create_package', 'enctype' => 'multipart/form-data')); ?>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Name <sup>*</sup></label>
                            <input type="hidden" name="pro_id" value="<?php echo $profuserdata['pro_id'];?>" class="form-control">
                            <input type="text" name="name" value="<?php echo $profuserdata['name'];?>" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Profession</label>
                            <input type="text" name="profession" value="<?php echo $profuserdata['profession'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Years of Practice</label>
                            <div class="selection-box">
                                <select name="years_of_practice" class="form-control">
                                    <option>--Select--</option>
                                    <?php 
                            for($i=1;$i<=50;$i++){
                                $selyr = ($profuserdata['years_of_practice'] == $i)?'selected':'';
                            echo '<option value="'.$i.'" '.$selyr.'>'.$i.'</option>';
                        } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Specialization</label>
                            <input type="text" name="specialization" value="<?php echo $profuserdata['specialization'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Masteral</label>
                            <input type="text" name="masteral" value="<?php echo $profuserdata['masteral'];?>" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Doctoral</label>
                            <input type="text" name="doctoral" value="<?php echo $profuserdata['doctoral'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Attached Profile photo</label>
                            <input type="file" name="profile_photo">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Attached Background photo</label>
                            <input type="file" name="background_photo">
                        </div>
                    </div>
                    <h3>Education</h3>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Elementary</label>
                            <input type="text" name="edu_elementary" value="<?php echo $profuserdata['edu_elementary'];?>" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>High School</label>
                            <input type="text" name="edu_high_school" value="<?php echo $profuserdata['edu_high_school'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>college</label>
                            <input type="text" name="edu_college" value="<?php echo $profuserdata['edu_college'];?>" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Masteral</label>
                            <input type="text" name="edu_masteral" value="<?php echo $profuserdata['edu_masteral'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Doctoral</label>
                            <input type="text" name="edu_doctoral" value="<?php echo $profuserdata['edu_doctoral'];?>" class="form-control">
                        </div>
                    </div>
                    <h3>Professional Practice / Employment Record :</h3>
                    <div class="clone-section">
                        <?php
            if(count($practicegetdata) > 0){
                foreach($practicegetdata as $prac){
                    echo '<div class="row">
            <div class="col-sm-12 form-group">
                <label>Title</label>
                <input type="text" name="practice_title[]" value="'.$prac['practice_title'].'" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label>Year</label>
                <input type="number" name="practice_year[]" value="'.$prac['practice_year'].'" class="form-control">
            </div>
            <div class="col-sm-6 form-group">
                <label>Highlights</label>
                <input type="text" name="practice_highlights[]" value="'.$prac['practice_highlights'].'" class="form-control">
            </div>
        </div>';
                }
            }else{
        ?>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label>Title</label>
                                    <input type="text" name="practice_title[]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Year</label>
                                    <input type="number" name="practice_year[]" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Highlights/Position</label>
                                    <input type="text" name="practice_highlights[]" class="form-control">
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                    <div id="divimploymentrecord">
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="employmentaddmore">Add more</a>
                    <h3>Awards/Citations/ Books</h3>
                    <div class="clone-section">
                        <?php
            if(count($citationsgetdata) > 0){
                foreach($citationsgetdata as $citat){
                    echo '<div class="row">
            <div class="col-sm-12 form-group">
                <label>Title</label>
                <input type="text" name="citations_title[]" value="'.$citat['citations_title'].'" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label>Year</label>
                <input type="number" name="cit_year[]" value="'.$citat['cit_year'].'" class="form-control">
            </div>
            <div class="col-sm-6 form-group">
                <label>Highlights</label>
                <input type="text" name="cit_highlights[]" value="'.$citat['cit_highlights'].'" class="form-control">
            </div>
        </div>';
                }
            }else{
        ?>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label>Title</label>
                                    <input type="text" name="citations_title[]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Year</label>
                                    <input type="number" name="cit_year[]" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Highlights</label>
                                    <input type="text" name="cit_highlights[]" class="form-control">
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                    <div id="divawards">
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="awardsaddmore">Add more</a>
                    <h3>Professional Affiliation:</h3>
                    <div class="clone-section">
                        <?php
            if(count($affiliationgetdata) > 0){
                foreach($affiliationgetdata as $aff){
                    echo '<div class="row">
            <div class="col-sm-12 form-group">
                <label>Title</label>
                <input type="text" name="aff_title[]" value="'.$aff['aff_title'].'" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label>Year</label>
                <input type="number" name="aff_year[]" value="'.$aff['aff_year'].'" class="form-control">
            </div>
            <div class="col-sm-6 form-group">
                <label>Highlights</label>
                <input type="text" name="aff_highlights[]" value="'.$aff['aff_highlights'].'" class="form-control">
            </div>
        </div>';
                }
            }else{
        ?>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="aff_title[]">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Year</label>
                                    <input type="number" class="form-control" name="aff_year[]">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Highlights</label>
                                    <input type="text" class="form-control" name="aff_highlights[]">
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                    <div id="divprofessional">
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="professionaladdmore">Add more</a>
                    <h3>Portfolio:</h3>
                    <div class="form-group">
                        <label>
                            <p class="small">(example: blueprint for architects, construction project for engineers, photo of citation/awards received (upload photo here, 4 photos free) (additional 10 photos $149.00)
                                <p>
                        </label>
                        <input type="file" name="portfolio[]">
                        <div id="portfoliophotodiv"></div>
                        <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="protfolioaddmore">Add more</a>
                    </div>
                    <h3>Portfolio video:</h3>
                    <div class="form-group">
                        <label>
                            <p class="small">(example: blueprint for architects, construction project for engineers, video of citation/awards received (upload video here, 4 videos free) (additional 10 videos $149.00)
                                <p>
                        </label>
                        <input type="file" name="portfoliovideo[]">
                        <div id="portfoliovideodiv"></div>
                        <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="videofolioaddmore">Add more</a>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Facebook Profile url </label>
                            <input type="url" name="facebook" value="<?php echo $profuserdata['facebook'];?>" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Linkedin Profile url </label>
                            <input type="url" name="linkedin" value="<?php echo $profuserdata['linkedin'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Google+ Profile url </label>
                            <input type="url" name="googleplus" value="<?php echo $profuserdata['googleplus'];?>" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Twitter Profile url </label>
                            <input type="url" name="twitter" value="<?php echo $profuserdata['twitter'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Youtube Profile url </label>
                            <input type="url" name="youtube" value="<?php echo $profuserdata['youtube'];?>" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Instagram Profile url </label>
                            <input type="url" name="instagram" value="<?php echo $profuserdata['instagram'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Pinterest Profile url </label>
                            <input type="url" name="pinterest" value="<?php echo $profuserdata['pinterest'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-primary btn-lg" value="Promote Profession">
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="innerContent" style="padding-bottom: 20px;">
        <div class="container"> 
            <a href="<?php echo site_url('provider/dashboard'); ?>" class="dashboard-btn">Dashboard</a>
        </div>
    </div> 
<!-- end modal -->
<script>
function removerow(romoveid) {
    //alert(romoveid);  
    $('#' + romoveid).remove();
}
$(document).ready(function() {

    var welcome ='<?php if($user_loggedin < 2 ){ ?>'+ $("#welcomeprovider").modal('show') + '<?php } ?>';
    var settarget = '<?php if($_REQUEST['id']=="success"){ ?>' + $("#welcomeprovider").modal('hide'); $("#Registersubinstitutions").modal('show'); + '<?php } ?>';

    var counter = 2;
    $('#employmentaddmore').on('click', function() {
        $('#divimploymentrecord').append('<div class="clone-section" id="emplomentrow' + counter + '"><div class="row"><div class="col-sm-12 form-group"><label>Title</label><input type="text" class="form-control" name="practice_title[]"></div></div><div class="row"><div class="col-sm-6 form-group"><label>Year</label><input type="number" class="form-control" name="practice_year[]"></div><div class="col-sm-6 form-group"><label>Highlights/Position</label><input type="text" class="form-control" name="practice_highlights[]"></div></div><a href="javascript:void(0)" onclick="removerow(\'emplomentrow' + counter + '\')" data-id="' + counter + '" class="btn btn-danger dismiss" title="Remove"><i class="fa fa-close"></i></a></div>');
        counter++;
    });
    $('#awardsaddmore').on('click', function() {
        $('#divawards').append('<div class="clone-section" id="awardsrow' + counter + '"><div class="row"><div class="col-sm-12 form-group"><label>Title</label><input type="text" class="form-control" name="citations_title[]"></div></div><div class="row"><div class="col-sm-6 form-group"><label>Year</label><input type="number" class="form-control" name="cit_year[]"></div><div class="col-sm-6 form-group"><label>Highlights/Position</label><input type="text" class="form-control" name="cit_highlights[]"></div></div><a href="javascript:void(0)" onclick="removerow(\'awardsrow' + counter + '\')" data-id="' + counter + '" class="btn btn-danger dismiss" title="Remove"><i class="fa fa-close"></i></a></div>');
        counter++;
    });
    $('#professionaladdmore').on('click', function() {
        $('#divprofessional').append('<div class="clone-section" id="professional' + counter + '"><div class="row"><div class="col-sm-12 form-group"><label>Title</label><input type="text" class="form-control" name="aff_title[]"></div></div><div class="row"><div class="col-sm-6 form-group"><label>Year</label><input type="number" class="form-control" name="aff_year[]"></div><div class="col-sm-6 form-group"><label>Highlights/Position</label><input type="text" class="form-control" name="aff_highlights[]"></div></div><a href="javascript:void(0)" onclick="removerow(\'professional' + counter + '\')" data-id="' + counter + '" class="btn btn-danger dismiss" title="Remove"><i class="fa fa-close"></i></a></div>');
        counter++;
    });

    $('#protfolioaddmore').on('click', function() {
        if (counter <= <?php echo $uploadnophoto;?>) {
            $('#portfoliophotodiv').append('<input type="file" name="portfolio[]">');
        } else {
            //alert('If you want to upload more than 4 photos then buy subscription.');
            //alert(counter);
            if (counter > <?php echo $uploadnophoto;?>) {
                alert('<?php echo $uploadnophoto;?> photo upload in your current subscription pack.');
                return false;
            } else {
                var r = confirm('If you want to upload more than 4 photos\n Do you want to buy subscription.');
                if (r == true) {
                    window.location.href = 'http://mycpd.paritechsolutions.com/index.php/professional/subscription';
                } else {
                    //txt = "You pressed Cancel!";
                }
            }

        }
        counter++;
    });
    $('#videofolioaddmore').on('click', function() {
        if (counter <= <?php echo $uploadnovideo;?>) {
            $('#portfoliovideodiv').append('<input type="file" name="portfoliovideo[]">');
        } else {
            //alert('If you want to upload more than 4 photos then buy subscription.');
            //alert(counter);
            if (counter > <?php echo $uploadnovideo;?>) {
                alert('<?php echo $uploadnovideo;?> video upload in your current subscription pack.');
                return false;
            } else {
                var r = confirm('If you want to upload more than 4 video\n Do you want to buy subscription.');
                if (r == true) {
                    window.location.href = 'http://mycpd.paritechsolutions.com/index.php/professional/subscription';
                } else {
                    //txt = "You pressed Cancel!";
                }
            }

        }
        counter++;
    });
});


// $(document).ready(function(){
//    
// }

</script>

<div class="modal fade" id="welcomeprovider"  role="dialog" data-backdrop="static" data-keyboard="false">
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
            <p><b>You have just activated your CE Provider's account using 
                </br>the Continuing Education Provider Management Software (CEP-MS).
                <!-- </br> Start using your CEP-MS by creating online course or uploading training. -->
                <?php if($uins > 0){ ?>
                </br>Set Your Annual Training Target by listing your online courses or training for the year.
                </br></br>But first,send your CEP Code to your Authors.
                <?php }else{ ?>
                </br></br>Please, send your CEP Code to your Authors.
                <?php } ?>
            </b></p>
            <br/>
                <a href="javascript:void(0)" onclick="send_to_author()" class="btn btn-success">Send Now!</a>
               <!--  <form action="<?php echo base_url('provider/send_to_author'); ?>" method="post">
                    <input type="submit" class="btn btn-success" name="send_to_author" value="Send Now!">
                </form> -->    
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
                <p><b>NOTE:<i> This information will be used by author as they register Under this CE Provider account.</i></b></p>
                <form action="<?php echo base_url('provider/send_to_author'); ?>" method="post">
                    <div class="row">
                        
                    <div class="col-sm-6">
                        <label>Name of CEP: </label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="cepname" value="<?php echo $insNameRow['name']; ?>">
                    </div>    
                    <div class="col-sm-6">
                        <label>Code of the CEP: </label>
                    </div>    
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="cepcode" value="<?php echo $insNameRow['insititution_id']; ?>">
                    </div>
                    <label><b>You can send multiple emails by using comma(,) separator. <i>Like:- abc@gmail.com, xyz@yahoo.com</i></b></label>
                    <div class="col-sm-6">
                        <label>Enter email of authors: </label>
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

<!-- Modal -->
<div id="promoteYourCompany" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Feature Your Company</h4>
            </div>
            <?php   $uid = $this->session->userdata('logged_in')['id'];
                    $userrole = $this->session->userdata('logged_in')['role'];
                    $user = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid); ?>
            <div class="modal-body promatecompany">
                <div class="author-thumb">
                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$user[0]['image']; ?>" alt="">
                </div>
                <form class="payform" id="payformdaily" action="<?php echo site_url('provider/dailypromoteprovider'); ?>" method="post" enctype="multipart/form-data" >
                <?php
                $pricewithtax = $providertax['total_amount'];
                $dailprice = $providertax['base_price'];
                $tax = $providertax['tax_amount'];
               
                ?>

                 <input type="hidden" id="dailyprice" name="dailyprice" value="<?php echo $dailprice; ?>"> 
                 <input type="hidden" name="tax" value="<?php echo $tax; ?>"> 
                 <input type="hidden" name="pricewithtax" id="cpricewithtax" value="<?php echo $pricewithtax; ?>"> 
                 <input type="hidden" name="uid" value="<?php echo $uid; ?>"> 
                 <input type="hidden" name="uname" value="<?php echo $user[0]['name']; ?>"> 
                
                    <div class="form-control"><a href="#">$<?php echo $pricewithtax; ?>/day</a></div>
                    <select class="form-control" id="day" name="day" onchange="setprice(this.value)">
                    <?php for($i=1; $i<=31;$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?> Day</option>
                    <?php } ?>
                    </select>
                    <div class="form-control btnpaynow">
                        <a href="javascript:void(0)" onclick="submitform()" id="pricehtml">$<?php echo $pricewithtax; ?> Pay Now</a>
                    </div>
                </form>
                <div class="clearfix"></div>
                <h5>Featured</h5>
                <p><?php echo $providertax['text'];?></p>

                <h3 class="border-title text-left">Featured promotion appearance</h3>
                <img src="<?php echo ASSETS_URL.'images/uploads/'.$providertax['image']; ?>" alt="" style="border:1px solid #000; border-radius: 5px;">
               
            </div>
        </div>
    </div>
</div>

<div id="featurepayby" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Choose Payment Option</h4>
        </div>
        <div class="modal-body"> 
          <a href="javascript:void(0)" onclick="payfeaturebypaypal();" class="btn btn-primary"> PayPal</a>
           <a href="javascript:void(0)" onclick="payfeaturebystrip();" class="btn btn-info"> Card</a>
        </div>
      </div>
    </div>
</div>

<form action="<?php echo base_url('stripe/index'); ?>" method="get" name="stripePay" id="fetureStripeBuyPlan">
    <input type="hidden" name="id" value="<?php echo $userrole; ?>" > <!-- here id is role of the user. -->
    <input type="hidden" name="name" id="" value="<?php echo $user[0]['name'].' - Company Promotion';?>">
    <input type="hidden" name="price" id="totalstripeprice" value="<?php echo $pricewithtax; ?>">
    <input type="hidden" name="tax" id="stripestripeTax" value="<?php echo $tax; ?>">
    <input type="hidden" name="day" id="stripeDay">
    <input type="hidden" name="base_price" value="<?php echo $dailprice; ?>">
    <input type="hidden" name="type" value="Promotion">
</form>

<script>
    function setprice(day){
        var pricewithtax = '<?php echo $pricewithtax; ?>';
        var tax = '<?php echo $tax; ?>';
        var pricetax ='';
        var totalprice = (pricewithtax*day).toFixed(2);
           jQuery('#stripestripeTax').val(tax);
           jQuery('#stripeDay').val(day);
       
        // var priceaddtax = parseFloat(totalprice).toFixed(2);

        // alert(totalprice+'+'+pricetax+'='+priceaddtax);
        if(day){
           jQuery('#pricehtml').html('$'+totalprice+' Pay Now');
           jQuery('#cpricewithtax').val(totalprice);
           jQuery('#totalstripeprice').val(totalprice);
        }else{
           jQuery('#pricehtml').html('');
        }
    }

    function submitform(){
        $("#featurepayby").modal("show"); 
        $("#promoteYourCompany").modal("hide"); 
        // jQuery('#payformdaily').submit();
    }

    function payfeaturebypaypal(){
        $("#payformdaily").submit();
    }

    function payfeaturebystrip(){
        $("#fetureStripeBuyPlan").submit();
    }

    function send_to_author(){ 
        $("#welcomeprovider").modal('hide');
        $("#send_code").modal('show');
    }
</script>



