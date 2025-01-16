<?php
// error_reporting(0);
//added by abhijeet on 18-aug2018
// echo '<pre>'; print_r($this->session->userdata('logged_in'));
$uid = $this->session->userdata('logged_in')['id']; 
$exam_list = $this->provider_model->author_exam_list($uid); 
$firstlogin = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['logged_in']; 
// echo $firstlogin; 
$profuserdata = $this->db->get_where('tbl_professionals',array('user_id'=>$uid))->row_array();
$userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();

$citationsgetdata = $this->db->get_where('tbl_citations_list',array('pro_id'=>$profuserdata['pro_id']))->result_array();

$certificate = $this->db->get_where('tbl_existing_certificate')->result_array();

$practicegetdata = $this->db->get_where('tbl_practice_list',array('pro_id'=>$profuserdata['pro_id']))->result_array();
$affiliationgetdata = $this->db->get_where('tbl_affiliation_list',array('pro_id'=>$profuserdata['pro_id']))->result_array();
$uploadedimg = $this->db->get_where('tbl_user_docutments',array('user_id'=>$uid,'filetype'=>'img'))->result_array();
$uploadedvideo = $this->db->get_where('tbl_user_docutments',array('user_id'=>$uid,'filetype'=>'video'))->result_array();
$where = array('tbl_user_subscription_buy.user_id'=>$uid,'tbl_user_subscription_buy.sub_status'=>'1');
$join = array('tbl_user_subscription_packages', 'tbl_user_subscription_packages.subs_id=tbl_user_subscription_buy.subs_id');
//$subscription = $this->join($join[0], $join[1])->get_where('tbl_user_subscription_buy', $where)->result_array();
$subscriptionimg = $this->db->join($join[0], $join[1])->get_where('tbl_user_subscription_buy',$where)->row_array();
//print_r($subscription);
//echo count($uploadedimg);
$dailyprices = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
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

    $uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
    $up_id = end(explode('-', $uprovider)); 
    $under_insititution = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 

    $noticationCount = $this->db->get_where('tbl_notification',array('to'=>$uid,'status'=>1))->result_array();
    $ncount = count($noticationCount);
    $parent_details = $this->db->get_where('tbl_user',array('id'=>$parentid))->row_array(); 


// echo '<pre>'; print_r($parent_details);
    $parentid = $userdata['parent_insititution'];
    if($parentid !=''){
        $mainInsDetails = $this->db->get_where('tbl_user',array('id'=>$parentid,'under_insititution'=>'0'))->row_array();
    }

    ?>
    <div class="professionals-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class="d-flex">
                        <?php 
                        $userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
                        //echo '<pre>';
                        ///print_r($userdata);
                        ///die;
                        ?>
                        <div class="author-thumb usertype<?php echo $this->session->userdata('logged_in')['role'] ?>">
                            <?php 
                            if($userdata['image']==""){
                                $src = ASSETS_URL.'images/staff-3.png';
                            } else {
                                $src = ASSETS_URL.'images/uploads/'.$userdata['image'];
                            } ?>
                            <img src="<?php echo $src; ?>" alt="author-pic">
                        <!-- <div class="pos">Registered Nurse</div> -->
                        </div>
                        <div class="profile-content">
                                <?php 
                               //echo '<pre>'; print_r($userdata); under_provider
                                $currentUser = $this->db->get_where('tbl_user',array('insititution_id'=>$userdata['under_provider']))->result_array();
                                //print_r($currentUser);

                                $date    = $userdata['added_on'];
                                $newdate = strtotime ( '+3 year' , strtotime ( $date ) ) ;
                                $newdate = date ( 'jS F, Y' , $newdate );
                                ?>
                                <h5><?php echo $userdata['name']?>
                                    <a href="<?php echo site_url('share/notification');?>">
                            <span class="notification-icon" style="position: relative;top:0px;">
                            <i class="fa fa-bell" title="Notification" aria-hidden="true" style="display: inline-block; font-size: 25px; color: #FFD700; vertical-align: middle; margin-right: 10px;"></i>
                            <span class="notification-no" style="    position: absolute;right: 0;background-color: #e83330; width: 15px;height: 15px;line-height: 15px;text-align: center; border-radius: 50%;font-size: 11px;box-shadow: -1px 3px 7px rgba(0, 0, 0, 0.3);top: 2px;color: #fff;"><?php if($ncount){ echo $ncount; }else{ echo 0; } ?></span>
                            </span></a>
                                </h5>
                                <p><strong>Profession :</strong> <?php echo $userdata['profession'];?></p>
                                <p><strong>Date Registered :</strong> <?php echo date ( 'jS F, Y' , strtotime ( $userdata['approval_date'] ) ) ;?></p>
                                <p><strong>CEP :</strong> <?php echo $currentUser[0]['name'];?></p>

                               <!--  <br>
                                Acceditation : <?php echo $userdata['prc_acceditation_number'];?> 
                                <br> Validity :
                                <?php echo $newdate; ?> -->
                        </div>
                    </div>
                    <div class="prof-btns">
                        <?php if($under_insititution=='0'){ ?>

                        <?php if($this->session->userdata('logged_in')['role'] == 1){   
                        echo '<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#promoteProfile">Promote Your Practice</a>';
                        } ?>
                        <?php if($this->session->userdata('logged_in')['role'] == 2){   
                        echo '<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#promoteYourCompany">Promote Your Company</a>';
                        } ?>
                    <?php } ?>
                    <?php if($mainInsDetails['insititution_id'] != ''){?>
                        <a href="<?php echo BASE_URL.'web/'.$mainInsDetails['insititution_id']; ?>" class="btn btn-info">Institution CE Webpage</a>
                    <?php } ?>
                    <div class="d-flex">
                        <a href="<?php echo site_url('share/viewprofile/'.$uid.'');?>" class="btn btn-success">View My Page</a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#editbg" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    </div>
                        <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#promoteProfile">Edit Author's Profile</a>
                       <!-- <br><br>
                        <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#promoteYourCompany">Feature Your Practice</a>-->
                    </div>
                </div>


                <?php 
                $uid         = $this->session->userdata('logged_in')['id'];     
                $totalIncome = $this->user->get_report('total',$uid);
                $totalCourse = $this->db->get_where('tbl_course',array('user_id'=>$uid,'status'=>'1'))->result_array();
                $totalPurchaseUsers = $this->db->get_where('tbl_purchase_llis',array('user_id'=>$uid))->result_array();
                $totalTraining = $this->db->get_where('tbl_training',array('user_id'=>$uid))->result_array();

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
                $course = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course',array('id'=>$value['course_id']));
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

            
                  $target_unit = $unit[0]['unit'];


                ?>


                <div class="col-md-9 col-sm-8">
                    <div class="row banner-count-desc">
                        


<?php 
$target = 0;
$uid2 = $this->session->userdata('logged_in')['id'];
$userdetails2 = $this->user->get_record_by_field_name_all_record('tbl_provider_set_target','user_id',$uid2);
foreach ($userdetails2 as $key => $value) {
  $target = $target + $value['target_number'];
}


$allstaff = 0;  
$userdetails3 = $this->user->get_record_by_field_name_all_record('tbl_training','user_id',$uid2);
foreach ($userdetails3 as $key => $value) {

$where1 = array('present_status'=>1,'training_seminar_id'=>$value['id']);
$AllStaffTrained = $this->user->get_record_by_field_name_all_record11('tbl_training_book',$where1); 


    $allstaff = $allstaff + count($AllStaffTrained);
}
?>

                    
                    <?php if($under_insititution == '0'){ 
                        $totalIncomeAuthor = $this->provider_model->total_income($uid,'total');?>
                        <div class="col-md-3 col-sm-6 text-center item" >
                          <div class="icon-container" style="width: 170px;">$ <?php echo number_format(floatval($totalIncomeAuthor),2); ?></div>
                          <h2>Today's Income</h2>
                        </div>
                    <?php } ?> 
                        <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="background:#275bf4"><?php echo count($totalCourse);?></div>
                            <h2>Total Courses</h2>
                        </div>
                       <!--  <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="background:#a80693"><?php echo count($totalTraining);?></div>
                            <h2>Total Training</h2>
                        </div> -->
                       <div class="col-md-3 col-sm-6 text-center item">
                            <div class="icon-container" style="background:#a80693"><?php echo count($exam_list); ?></div>
                            <h2>Total Certificates</h2>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--      <div class="innerContent" style="padding: 20px;">
        <div class="container"> 
            <a href="<?php echo site_url('author/overview'); ?>" class="btn btn-primary">Dashboard</a>
        </div>
    </div>  -->
        
    <!-- Modal -->
    <div class="modal fade" id="promoteProfile" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content text-left">

                <?php //if($profuserdata['pro_id'] !=""){ ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Author's Profile</h4>
                </div>
                <?php //} ?>

                <?php  

                if($profuserdata['name']==""){
                    $names = $userdata['name'];
                }else{
                    $names = $profuserdata['name'];
                }

                if($profuserdata['profession']==""){
                    $profession = $userdata['profession'];
                }else{
                    $profession = $profuserdata['profession'];
                } ?>
                <div class="modal-body">
                        <div class="promote-profile">
                        <?php echo form_open(base_url('author/updateinfo'), array('class' => '', 'enctype' => 'multipart/form-data', 'id' => 'form_updateinformation', 'enctype' => 'multipart/form-data')); ?>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Name <sup>*</sup></label>
                                <input type="hidden" name="pro_id" value="<?php echo $profuserdata['pro_id'];?>" class="form-control">
                                <input type="text" name="name" value="<?php echo $names;?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Profession</label>
                                <input type="text" name="profession" value="<?php echo $profession;?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Years of Practice</label>
                                <div class="selection-box">
                                    <select name="years_of_practice" class="form-control" required>
                                        <option value="">--Select--</option>
                                        <?php   for($i=1;$i<=50;$i++){
                                        $selyr = ($profuserdata['years_of_practice'] == $i)?'selected':'';
                                        echo '<option value="'.$i.'" '.$selyr.'>'.$i.'</option>'; } ?>
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
                                <label>Attached Profile photo</label>
                                <input type="file" class="form-control" name="profile_photo" >
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Attached Background photo</label>
                                <input type="file" class="form-control" name="background_photo" >
                            </div>
                        </div>
                        <h3>Education</h3>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Elementary</label>
                                <input type="text" name="edu_elementary" value="<?php if(!empty($profuserdata['edu_elementary'])){echo $profuserdata['edu_elementary']; } ?>" class="form-control" placeholder="Name of Elementary School">

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" name="edu_elementary_s" value="<?php if(!empty($profuserdata['edu_elementary_s'])){echo $profuserdata['edu_elementary_s']; } ?>" class="form-control" placeholder="Strat year" maxlength="4">    
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="edu_elementary_e" value="<?php if(!empty($profuserdata['edu_elementary_e'])){echo $profuserdata['edu_elementary_e']; } ?>" class="form-control" placeholder="End year" maxlength="4">    
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>High School</label>
                                <input type="text" name="edu_high_school" value="<?php if(!empty($profuserdata['edu_high_school'])){echo $profuserdata['edu_high_school']; } ?>" class="form-control" placeholder="Name of High School">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" name="edu_high_school_s" value="<?php if(!empty($profuserdata['edu_high_school_s'])){echo $profuserdata['edu_high_school_s']; } ?>" class="form-control" placeholder="Strat year" maxlength="4">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="edu_high_school_e" value="<?php if(!empty($profuserdata['edu_high_school_e'])){echo $profuserdata['edu_high_school_e'];}?>" class="form-control" placeholder="End year" maxlength="4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>College</label>
                                <input type="text" name="edu_college" value="<?php if(!empty($profuserdata['edu_college'])){echo $profuserdata['edu_college']; } ?>" class="form-control"  placeholder="Name of College">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" name="edu_college_s" value="<?php if(!empty($profuserdata['edu_college_s'])){echo $profuserdata['edu_college_s']; } ?>" class="form-control" placeholder="Strat year" maxlength="4">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="edu_college_e" value="<?php if(!empty($profuserdata['edu_college_e'])){echo $profuserdata['edu_college_e']; }?>" class="form-control" placeholder="End year" maxlength="4">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Masteral</label>
                                <input type="text" name="edu_masteral" value="<?php if(!empty($profuserdata['edu_masteral'])){echo $profuserdata['edu_masteral']; } ?>" class="form-control"  placeholder="Name of Masteral Institution">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" name="edu_masteral_s" value="<?php if(!empty($profuserdata['edu_masteral_s'])){echo $profuserdata['edu_masteral_s']; } ?>" class="form-control" placeholder="Strat year" maxlength="4">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="edu_masteral_e" value="<?php if(!empty($profuserdata['edu_masteral_e'])){echo $profuserdata['edu_masteral_e']; }?>" class="form-control" placeholder="End year" maxlength="4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Doctoral</label>
                                <input type="text" name="edu_doctoral" value="<?php if(!empty($profuserdata['edu_doctoral'])){ echo $profuserdata['edu_doctoral']; } ?>" class="form-control" placeholder="Name of Doctoral Institution">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" name="edu_doctoral_s" value="<?php if(!empty($profuserdata['edu_doctoral_s'])){echo $profuserdata['edu_doctoral_s']; }?>" class="form-control" placeholder="Strat year" maxlength="4">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="edu_doctoral_e" value="<?php if(!empty($profuserdata['edu_doctoral_e'])){ echo $profuserdata['edu_doctoral_e']; } ?>" class="form-control" placeholder="End year" maxlength="4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>Professional Practice / Employment Record :</h3>
                        <div class="clone-section">
                            <?php
                if(count($practicegetdata) > 0){
                    foreach($practicegetdata as $i => $prac){
                        echo '<div class="row">
                <div class="col-sm-12 form-group">
                    <label>Title</label>
                    <input type="text" name="practice_title[]" value="'.$prac['practice_title'].'" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label>Year</label>'; ?>
                    <div class="d-flex">
                        <input type="text" name="practice_year_s[]" value="<?php echo $prac['practice_year_s'];?>" class="form-control" placeholder="Strat year" maxlength="4">
                        <input type="text" name="practice_year_e[]" value="<?php echo $prac['practice_year_e'];?>" class="form-control" placeholder="End year" maxlength="4">
                    </div>
                   <?php echo '</div>
                    <div class="col-sm-6 form-group">
                        <label>Name of Institution</label>
                        <input type="text" name="practice_highlights[]" value="'.$prac['practice_highlights'].'" class="form-control">
                    </div>
                </div>';   }
                    }else{ ?>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Title</label>
                                <input type="text" name="practice_title[]" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Year</label>
                                <div class="d-flex">
                                <input type="text" name="practice_year_s[]" value="" class="form-control" placeholder="Strat year" maxlength="4">
                                <input type="text" name="practice_year_e[]" value="" class="form-control" placeholder="End year" maxlength="4">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name of Institution</label>
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
                <?php if(count($citationsgetdata) > 0){
                    foreach($citationsgetdata as $citat){
                        echo '<div class="row">
                <div class="col-sm-12 form-group">
                    <label>Title</label>
                    <input type="text" name="citations_title[]" value="'.$citat['citations_title'].'" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label>Year</label>'; ?>
                    <div class="d-flex">
                    <input type="text" name="cit_year_s[]" value="<?php echo $citat['cit_year_s'];?>" class="form-control" placeholder="Strat year" maxlength="4">
                    <input type="text" name="cit_year_e[]" value="<?php echo $citat['cit_year_e'];?>" class="form-control" placeholder="End year" maxlength="4">
                    </div>
                    <?php echo' </div>
                    <div class="col-sm-6 form-group">
                        <label>Name of Institution</label>
                        <input type="text" name="cit_highlights[]" value="'.$citat['cit_highlights'].'" class="form-control">
                    </div>
                </div>'; }
                    }else{ ?>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label>Title</label>
                                    <input type="text" name="citations_title[]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Year</label>
                                    <div class="d-flex">
                                    <input type="text" name="cit_year_s[]" value="" class="form-control" placeholder="Strat year" maxlength="4">
                                    <input type="text" name="cit_year_e[]" value="" class="form-control" placeholder="End year" maxlength="4">
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Name of Institution</label>
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
                    <?php if(count($affiliationgetdata) > 0){
                        foreach($affiliationgetdata as $aff){
                            echo '<div class="row">
                <div class="col-sm-12 form-group">
                    <label>Title</label>
                    <input type="text" name="aff_title[]" value="'.$aff['aff_title'].'" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label>Year</label>'; ?>
                    <div class="d-flex">
                    <input type="text" name="aff_year_s[]" value="<?php echo $aff['aff_year_s'];?>" class="form-control" placeholder="Strat year" maxlength="4">
                    <input type="text" name="aff_year_e[]" value="<?php echo $aff['aff_year_e'];?>" class="form-control" placeholder="End year" maxlength="4">
                    </div>
                        <?php echo '</div>
                        <div class="col-sm-6 form-group">
                            <label>Name of Institution</label>
                            <input type="text" name="aff_highlights[]" value="'.$aff['aff_highlights'].'" class="form-control">
                        </div>
                    </div>'; }
                        }else{ ?>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="aff_title[]">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Year</label>
                                    <div class="d-flex">
                                    <input type="text" name="aff_year_s[]" value="" class="form-control" placeholder="Strat year" maxlength="4">
                                    <input type="text" name="aff_year_e[]" value="" class="form-control" placeholder="End year" maxlength="4">
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Name of Institution</label>
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
                                <p class="small">(example: blueprint for architects, construction project for engineers, photo of citation/awards received (upload photo here, 4 photos free) 
                                    <!-- <b>(additional 10 photos $<?php echo $dailyprices[0]['portfolio_video_price'] ;?>)</b> -->
                                    <p>
                            </label>

                            <input type="file" class="form-control" name="portfolio[]" id="portfolio">
                            <a href="javascript:void(0)" id="cancel" class=" pull-right" title="Remove"><i class="fa fa-close"></i></a>

                            <div id="portfoliophotodiv"></div>

                        </div>
                            <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="protfolioaddmore">Add more</a>
                          
                        <h3>Portfolio video:</h3>
                        <div class="form-group">
                            <label>
                                <p class="small">(example: blueprint for architects, construction project for engineers, video of citation/awards received (upload video here, 4 videos free) 
                                    <!-- <b>(additional 10 videos $<?php echo $dailyprices[0]['portfolio_video_price'] ;?>)</b> -->
                                    <p>
                            </label>
                            
                            <input type="file" class="form-control" name="portfoliovideo[]" id="portfoliovideo">
                            <a href="javascript:void(0)" id="cancel1" class=" pull-right" title="Remove"><i class="fa fa-close"></i></a>
                            <div id="portfoliovideodiv"></div>
                        </div>
                            <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="videofolioaddmore">Add more</a>

                            <h3>Social Media Accounts:</h3>
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
							<input type="submit" class="btn btn-primary btn-lg" value="Promote Authorship">
                        </div>
							
                        <?php echo form_close();?>

                    </div>
                </div>
            </div>
        </div>
    </div>

	
	<!-- Modal completemoduleProfile-->
    <div class="modal fade" id="completemoduleProfile"  role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content text-center">
				 <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><div class="site-logo__link" style="max-width: 34%;">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
                    </div></center>
				</div>
                <div class="modal-body">
					<h4 class="modal-title text-center" style="font-weight: bold;"><img src="<?php echo ASSETS_URL.'images/congratulations.png';?>" alt="congratulations" width="175"> </h4>
					<p><b>You have just activated your author's account using the <br>
						Author Continuing Education Management Software (ACE-MS).</b>
					</p>
					<p><b>Please complete your Author's profile.</b><p>
					<button type="button" id="gotocompauthorprofile" class="btn btn-success">COMPLETE AUTHOR'S PROFILE</button>
                </div>
            </div>
        </div>
    </div>
	<!-- end Modal completemoduleProfile-->
	<!-- Modal successmoduleProfile-->
    <div class="modal fade" id="successmoduleProfile"  role="dialog">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><div class="site-logo__link" style="max-width: 34%;display: block; text-align: -webkit-center;">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
                </div></center>
                </div> 
				<div class="modal-body">
					<h4 class="modal-title text-center" style="font-weight: bold;"><img src="<?php echo ASSETS_URL.'images/congratulations.png';?>" alt="congratulations" width="175"> </h4>
					<p><b>You have posted your Author's profile into the <br>Author page.</b></p>
					<p><b>Your profile and online courses can be see by professionals.</b><p>
					<p><b>Please click the link below to check your name or <br>you can view your profile page.</b><p>
					<!-- <a href="<?php echo site_url('author/overview');?>" class="btn btn-primary">Authors Page</a> -->
					<a href="<?php echo site_url('share/viewprofile/'.$uid.'');?>" class="btn btn-success">View Profile Page</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editbg" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Webpage Background and Profile</h4>
        </div>
        <?php echo form_open_multipart('author/editbg'); ?>
        <div class="modal-body">
            <div class="row form-group">
                <p class="col-sm-6">
                    <label>Profile Image</label>
                    <input class="form-control" name="image" type="file">
                    <span class="error"></span>
                </p>
              <!--   <p class="col-sm-6">
                    <label>Background Image <small id="" class="form-text text-muted"> ( Size should be 1500 x 540 or less )</small></label>
                    <input class="form-control" name="backimage" type="file">
                    <span class="error"></span>
                </p> -->
            <!-- </div>
            <div class="row form-group"> -->
                <p class="col-sm-6"><?php if($userdata['image'] != ''){ ?>
                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$userdata['image']; ?>" width="150">
                </p><?php } ?>
               <!--  <p class="col-sm-6"><?php if($userdata['backimage'] != ''){ ?>
                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$userdata['backimage']; ?>" width="200">
                </p><?php } ?> -->
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
  
<script>
    function removerow(romoveid) {
        //alert(romoveid);  
        $('#' + romoveid).remove();
    }
   
    $(document).ready(function() {
        // var first = '<?php if($firstlogin < 2){ ?>' + $("#promoteProfile").modal('hide');  $("#completemoduleProfile").modal('show'); +'<?php } ?>';
        var first = '<?php if($firstlogin < 2){ ?>' + $("#completemoduleProfile").modal('show') +'<?php } ?>';
        var pop2 = '<?php if($_REQUEST['id']=="success"){ ?>' + $("#completemoduleProfile").modal('hide'); $("#successmoduleProfile").modal('show'); + '<?php } ?>';
      
        $('#cancel').click(function(){$('#portfolio').val(""); });
        $('#cancel1').click(function(){$('#portfoliovideo').val(""); }); 
      
      
        var counter = 2;
        var photoCounter = 2;
        var videoCounter = 2;
       
        $('#employmentaddmore').on('click', function() {
           $('#divimploymentrecord').append('<div class="clone-section" id="emplomentrow' + counter + '">\
               <div class="row"><div class="col-sm-12 form-group"><label>Title</label><input type="text" name="practice_title[]" class="form-control"></div></div><div class="row"><div class="col-sm-6 form-group"><label>Year</label><div class="d-flex"><input type="text" name="practice_year_s[]" value="" class="form-control" placeholder="Strat year" maxlength="4"><input type="text" name="practice_year_e[]" value="" class="form-control" placeholder="End year" maxlength="4"></div></div><div class="col-sm-6 form-group"><label>Name of Institution</label><input type="text" name="practice_highlights[]" class="form-control"></div></div>\
               <a href="javascript:void(0)" onclick="removerow(\'emplomentrow' + counter + '\')" data-id="' + counter + '" class="btn btn-danger dismiss" title="Remove"><i class="fa fa-close"></i></a></div>');
           counter++;
       });
        
        $('#awardsaddmore').on('click', function() {
           $('#divawards').append('<div class="clone-section" id="awardsrow' + counter + '">\
               <div class="row"><div class="col-sm-12 form-group"><label>Title</label><input type="text" name="citations_title[]" class="form-control"></div></div><div class="row"><div class="col-sm-6 form-group"><label>Year</label><div class="d-flex"><input type="text" name="cit_year_s[]" value="" class="form-control" placeholder="Strat year" maxlength="4"><input type="text" name="cit_year_e[]" value="" class="form-control" placeholder="End year" maxlength="4"></div></div><div class="col-sm-6 form-group"><label>Name of Institution</label><input type="text" name="cit_highlights[]" class="form-control"></div></div>\
               <a href="javascript:void(0)" onclick="removerow(\'awardsrow' + counter + '\')" data-id="' + counter + '" class="btn btn-danger dismiss" title="Remove"><i class="fa fa-close"></i></a></div>');
           counter++;
       });

        $('#professionaladdmore').on('click', function() {
           $('#divprofessional').append('<div class="clone-section" id="professional' + counter + '">\
               <div class="row"><div class="col-sm-12 form-group"><label>Title</label><input type="text" class="form-control" name="aff_title[]"></div></div><div class="row"><div class="col-sm-6 form-group"><label>Year</label><div class="d-flex"><input type="text" name="aff_year_s[]" value="" class="form-control" placeholder="Strat year" maxlength="4"><input type="text" name="aff_year_e[]" value="" class="form-control" placeholder="End year" maxlength="4"></div></div><div class="col-sm-6 form-group"><label>Name of Institution</label><input type="text" class="form-control" name="aff_highlights[]"></div></div>\<a href="javascript:void(0)" onclick="removerow(\'professional' + counter + '\')" data-id="' + counter + '" class="btn btn-danger dismiss" title="Remove"><i class="fa fa-close"></i></a></div>');
           counter++;
       });
        

        $('#protfolioaddmore').on('click', function() {
            if (photoCounter <= <?php echo $uploadnophoto;?>) {
                $('#portfoliophotodiv').append('<input type="file" name="portfolio[]" id="portfolio" class="form-control"><a href="javascript:void(0)" id="cancel" class=" pull-right" title="Remove"><i class="fa fa-close"></i></a>');
            } else {
                //alert('If you want to upload more than 4 photos then buy subscription.');
                //alert(counter);
                if (photoCounter > <?php echo $uploadnophoto;?>) {
                    alert('You can upload <?php echo $uploadnophoto;?> photos only.');
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
            photoCounter++;
        });
        $('#videofolioaddmore').on('click', function() {
            if (videoCounter <= <?php echo $uploadnovideo;?>) {
                $('#portfoliovideodiv').append('<input type="file" name="portfoliovideo[]"  id="portfoliovideo" class="form-control"><a href="javascript:void(0)" id="cancel1" class=" pull-right" title="Remove"><i class="fa fa-close"></i></a>');
            } else {
                //alert('If you want to upload more than 4 photos then buy subscription.');
                //alert(counter);
                if (videoCounter > <?php echo $uploadnovideo;?>) {
                    alert('You can uload <?php echo $uploadnovideo;?> videos only.');
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
            videoCounter++;
        });
    });

    function setprice(day)
    {
        var dailprice='<?php echo $dailprice; ?>';
        
        var totalprice=dailprice*day;
        if(day)         
            {
             jQuery('#pricehtml').html('$'+totalprice+' Pay Now');
            }else
            {
                jQuery('#pricehtml').html('');
            }
        
    }
    function submitform()
    {
        jQuery('#payformdaily').submit();
    }
    
$("#btnupdateinformation").click(function(){                
    $.ajax({
        type:'post',
        url: '<?php echo base_url()?>author/ajaxupdateinfo',
        data: $('#form_updateinformation').serialize(),
        dataType: 'json',
        cache: 'false',
        beforeSend: function(){
            $('#btnupdateinformation').val('Please wait...');
        },
        success: function(result){ 
            if(result){
                $( "#promoteProfile").modal('hide');    
                $( "#successmoduleProfile").modal('show');  
            }else{
                alert('Please try again.');
            }               
        } 
    }); 
});


$("#gotocompauthorprofile").click(function() {
      $("#completemoduleProfile").modal('hide');
      $("#promoteProfile").modal('show');
      $('.modal').css('overflow-y', 'auto');
});       
</script>

