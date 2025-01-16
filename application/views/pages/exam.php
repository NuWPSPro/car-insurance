<!-- <?php// print_r($_SESSION['excid']); ?> -->
<?php if(!empty($_SESSION['excid']) || $_SESSION['excid'] > 0)
{
    $getexcertificate = $this->db->get_where('tbl_existing_certificate',array('id'=>$_SESSION['excid']))->row_object();
    if(isset($getexcertificate->certificate_id) && file_exists('assets/upload/course-pdf/'.$getexcertificate->certificate_id.'.pdf'))
    {
        // print_r($getexcertificate);
        $from = '/home1/n6fbcdjk/public_html/assets/upload/course-pdf/'.$getexcertificate->certificate_id.'.pdf';
        $to   = '/home1/n6fbcdjk/public_html/RBoard/assets/uploads/pdf/'.$getexcertificate->certificate_id.'.pdf';
        copy($from,$to); // this function helps us to copy pdf from one domain to another domain.
    }
}   ?>
<?php $uid = $this->session->userdata('logged_in')['id'];
        $cid = $this->uri->segment(3);
        $course = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
        $ins_id = $course[0]['insititution_id'];

        $insCourseId = end(explode('-', $course[0]['insititution_id']));
        $insName = $this->db->get_where('tbl_user',array('id'=>$insCourseId))->row_array()['name'];   

        $purchased = $this->db->get_where('tbl_purchase_llis',array('item_name'=>$cid,'user_id'=>$uid,'status'=>1,'archive'=>'0'))->row_array();   
        $underins = $this->session->userdata('logged_in')['under_insititution']; 

    $users_datas = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
    $user_ins_id = $users_datas['insititution_id'];    
        $exam_details = $this->user->get_exam_detail($cid,$uid);
        $passing_marks = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();

        $this->db->where(array('course_id'=>$cid,'user_id'=>$uid,'archive'=>'1'));
        $this->db->order_by('id','Desc');
        $exam_results = $this->db->get('tbl_exam');
        $exam_result = $exam_results->result_array();

        $someArray = json_decode($exam_result[0]['data'], true); 
        $count = count($someArray);
        for($i=0;$i<$count;$i++){
            if($someArray[$i]['ans']==$all_question[$i]['correct_answere']){$correct=1;}else{$correct=0;}
            $correctAnswer += $correct; 
            // print_r($someArray[$i]['ans'].'=='.$all_question[$i]['correct_answere']);
        }  

    $courseData = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();
    $coursecreator = $this->db->get_where('tbl_course',array('id'=>$cid,'user_id'=>$uid))->row_array();     
    $checkevaluation = $this->db->get_where('tbl_course_review',array('course_id'=>$cid ,'user_id'=>$uid))->row_array(); 

    $role = $this->session->userdata('logged_in')['role']; 
    $provider_id = end(explode('-',$users_datas['under_provider']));
    $ins = $this->db->get_where('tbl_institution_staff_payment',array('provider_id'=>$provider_id))->row_array(); 
    $profArr = explode(',',$ins['prof_id']);

    $con = array_search($uid,$profArr);
    if($profArr[$con] == ''){ 
        $cons = 2; 
    }else{ 
        $cons = 1; 
    } ?>

<?php $this->load->view('template/search'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php $this->load->view('template/coursemenu'); ?>

    <h3 class="border-title text-left"> Exam</h3>
    <div class="lesson-wrapper p-20">
        <?php echo $this->session->flashdata('response'); ?>

        <?php if(!$this->session->userdata('logged_in')){ ?>
            <?php if(!empty($ins_id) || $ins_id != 0  ){ ?>
                <p class="text-center">
                    <div class="alert alert-info">This online course is accessible only by professionals under <br>Institution: <i><?php echo $insName; ?></i>.<br>Please log-in or register to access this online course.</div>
                </p>
    
              <div class="header-register icons-header">
                <ul class="dt-sc-default-login">
                  <li>
                    <a href="<?php echo BASE_URL.'users';?>" class="lgn" title="Login" style="background: orange;"><i class="fa fa-user"></i>Login</a>
                    <a href="javascript:void(0);" onclick="register_now()" title="Register Now" class="register" style="background: #3d66b0;">Register</a>
                  </li>
                </ul>
              </div>
                
            <?php }else{ ?>
              <p class="text-center">
                    <div class="alert alert-info">
                        Please purchase this online course and access the exam section.
                    </div>
                    <button class="btn btn-primary">
                        <a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?>
                        </a>
                    </button>
                </p>
            <?php  } ?>  

        <?php }else{ ?>

        <?php if($role == 1){ ?>
            <?php if($purchased || $courseData['insititution_id'] == $user_ins_id){ ?>
              
            <?php 
                if(empty($this->uri->segment(4))):
                    if(empty($exam_result)): $res = FALSE; 
                    elseif($passing_marks['passing_marks'] > $exam_result[0]['percentages']): $res ='fail'; 
                    elseif($passing_marks['passing_marks'] <= $exam_result[0]['percentages']): $res = 'Congratulations'; 
                    elseif($courseData['insititution_id'] && $cons == 1): $res = FALSE; 
                    else: 
                    endif;
                else:
                    $res = 'reexam';
                endif;

            $conditions = $res;
            switch ($conditions){

            case 'Congratulations': ?>

                <h4 class="mb-0">
                    <strong>Congratulations!</strong>
                <?php if(count($checkevaluation) == 0){ ?>
                    <button class="btn btn-primary" style="margin-left: 296px;"><a href="<?php echo base_url('pages/evaluation/').$cid;?>" onclick="return alert('Please evaluate this course to see your Certificate.');" title="Certificate" style="color: #fff; ">Click here to view your Certificate</a></button><?php }else{ ?>
                    <button class="btn btn-primary" style="margin-left: 296px;"><a href="<?php echo base_url('pages/certificate/').$cid;?>"title="Certificate" style="color: #fff; ">Click here to view your Certificate</a></button><?php } ?></h4>
                <h6 style="color: green;">Your Score : <?php echo $correctAnswer.' outof '.count($all_question).' ( '.$exam_result[0]['percentages'];?> % ) </h6>
                <h6>Passing Marks : <?php echo $passing_marks['passing_marks']; ?>%</h6>

                    <?php  foreach ($all_question as $key => $value) {  ?>  
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8">
                                <h4 class="mt-0">
                                <?php echo $status = ($value['correct_answere']==$someArray[$key]['ans'])?'<span id="corect" style=" color:green;"><i class="fa fa-check-circle"></i></span>':'<span style=" color:red;"><i class="fa fa-times" aria-hidden="true"></i></span>';?>
                                <?php echo $value['question_title'];?> 
                                </h4>
                            <div class="qanswer">
                                <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" type="radio" disabled  value="1" 
                                <?php echo($someArray[$key]['ans']==1)?"checked":"";?> >
                                <span class="mode-span btn"><?php echo $value['answere1'];?></span> </label>
                                <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" type="radio" disabled  value="2" 
                                <?php echo($someArray[$key]['ans']==2)?"checked":"";?>>
                                <span class="mode-span btn"><?php echo $value['answere2'];?></span> </label>
                                <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" type="radio" disabled  value="3" 
                                <?php echo($someArray[$key]['ans']==3)?"checked":"";?>>
                                <span class="mode-span btn"><?php echo $value['answere3'];?></span> </label>
                                <label class="radio-inline">
                                <input name="ans-<?php echo $value['id']?>" type="radio" disabled value="4" 
                                <?php echo($someArray[$key]['ans']==4)?"checked":"";?>>
                                <span class="mode-span btn"><?php echo $value['answere4'];?></span> </label>
                                <!-- <label class="radio-inline"> </label> -->
                            </div>
                            </div>
                            <div class="col-md-12 p-4">
                                <?php if($value['correct_answere']!=$someArray[$key]['ans']){ ?>
                                    <div class="answer-rational" style="color: green;">
                                        <?php echo 'Correct Answer :Option '.$all_question[$key]['correct_answere'];?>   
                                    </div> 
                                <?php } ?>
                                <div class="answer-rational"> Rationale: <?php echo strip_tags($value['rational']);?> </div>
                            </div>
                             
                               
                        </div>
                    </div>
                    <?php } ?>
                    <?php if(count($checkevaluation) == 0){ ?>
                    <button class="btn btn-primary"><a href="<?php echo base_url('pages/evaluation/').$cid;?>" onclick="return alert('Please evaluate this course to see your Certificate.');" title="Certificate" style="color: #fff; ">Click here to view your Certificate</a></button><?php }else{ ?>
                    <button class="btn btn-primary"><a href="<?php echo base_url('pages/certificate/').$cid;?>"title="Certificate" style="color: #fff; ">Click here to view your Certificate</a></button><?php }
            break;
                    
            case 'fail': ?>
                <h4><strong>Please take Exam Again!</strong></h4>
                <h6 style="color: red;">Your Score : <?php echo $correctAnswer.' outof '.count($all_question).' ( '.$exam_result[0]['percentages'];?> % ) </h6>
                <h6>Passing Marks : <?php echo $passing_marks['passing_marks']; ?>%</h6>
                <h6><?php echo '<strong>Note: </strong>'.$courseData['course_exam_note'];?></h6>
                <h6><?php echo '<strong>Rest Retake: </strong>'.$rest_retake;?></h6>
                        <?php  $recount = 1;
                            foreach ($all_question as $key => $value) {  ?>

                                <div class="panel panel-info">
                                    <div class="panel-body">
                                    <div class="col-md-8">
                                        <h4 class="mt-0">
                                        <?php echo $status = ($value['correct_answere']==$someArray[$key]['ans'])?'<span id="corect" style=" color:green;"><i class="fa fa-check-circle"></i></span>':'<span style=" color:red;"><i class="fa fa-times" aria-hidden="true"></i></span>';?>
                                        <?php echo $recount .'. '. $value['question_title'];?> 
                                        </h4>
                                        <div class="qanswer">
                                            <label class="radio-inline">
                                            <input name="ans-<?php echo $value['id'];?>" type="radio" disabled  value="1" 
                                            <?php echo($someArray[$key]['ans']==1)?"checked":"";?> >
                                            <span class="mode-span btn"><?php echo $value['answere1'];?></span> </label>
                                            <label class="radio-inline">
                                            <input name="ans-<?php echo $value['id'];?>" type="radio" disabled  value="2" 
                                            <?php echo($someArray[$key]['ans']==2)?"checked":"";?>>
                                            <span class="mode-span btn"><?php echo $value['answere2'];?></span> </label>
                                            <label class="radio-inline">
                                            <input name="ans-<?php echo $value['id'];?>" type="radio" disabled  value="3" 
                                            <?php echo($someArray[$key]['ans']==3)?"checked":"";?>>
                                            <span class="mode-span btn"><?php echo $value['answere3'];?></span> </label>
                                            <label class="radio-inline">
                                            <input name="ans-<?php echo $value['id']?>" type="radio" disabled value="4" 
                                            <?php echo($someArray[$key]['ans']==4)?"checked":"";?>>
                                            <span class="mode-span btn"><?php echo $value['answere4'];?></span> </label>
                                        </div>
                                        </div>

                                        <div class="col-md-12 p-4">
                                            <?php if($value['correct_answere']!=$someArray[$key]['ans']){ ?>
                                                <div class="answer-rational" style="color: green;">
                                                    <?php echo 'Correct Answer :Option '.$all_question[$key]['correct_answere'];?>    
                                                </div> 
                                            <?php } ?>
                                            <div class="answer-rational"> Rationale: <?php echo strip_tags($value['rational']);?> </div> 
                                        </div>
                                    </div>
                                </div>
                                <?php $recount++; } ?>
                        <?php if($rest_retake >= 1){ ?>
                        <button class="btn btn-primary"><a href="<?php echo base_url('pages/exam/').$cid.'/'.$exam_attempt;?>"  title="Certificate" style="color: #fff; " onclick="return confirm('You have <?php echo $rest_retake;?> more retake, Do you want to countinue ?')">Start Exam Again</a></button>
                    <?php }else{ ?>
                        <button class="btn btn-primary"><a href="#"  title="Certificate" style="color: #fff; " onclick="repurchase();" >Start Exam Again</a></button>
                       
                    <?php }
            break;

            case FALSE: ?>
            <form action="<?php echo BASE_URL;?>pages/saveexam" method="post" enctype="multipart/form-data" name="saveform" id="saveform">
                <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                <h6>Passing Marks : <?php echo $passing_marks['passing_marks']; ?>%</h6>
                <h6><?php echo '<strong>Note: </strong>'.$courseData['course_exam_note'];?></h6>
                <h6><?php echo '<strong>Total Retake: </strong>'.$rest_retake;?></h6>
                <!-- <?php echo $this->session->flashdata('response');?>  -->
                <?php foreach ($all_question as $key => $value) { ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="mt-0"><?php echo $value['question_title'];?> <span class="required"> * </span></h4>
                        <div class="qanswer">
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" size="20"  type="radio" value="1" required>
                                <span class="mode-span btn"><?php echo $value['answere1'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" size="20"  type="radio" value="2" required>
                                <span class="mode-span btn"><?php echo $value['answere2'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" size="20"  type="radio" value="3" required>
                                <span class="mode-span btn"><?php echo $value['answere3'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id']?>" size="20"  type="radio" value="4" required>
                                <span class="mode-span btn"><?php echo $value['answere4'];?></span> </label>
                        </div>
                    </div>
                </div>
                <?php } ?> 

                <div class="form-group">
                    <input class="btn btn btn-primary btn-lg" value="Submit Answers" type="submit" name="save">
                </div>
            </form><?php
            break;

            case 'reexam': ?>

            <form action="<?php echo BASE_URL;?>pages/saveexam" method="post" enctype="multipart/form-data" name="reexamform" id="reexamform">
                <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                <h6>Passing Marks : <?php echo $passing_marks['passing_marks']; ?>%</h6>
                <h6><?php echo '<strong>Note: </strong>'.$courseData['course_exam_note'];?></h6>
                <h6><?php echo '<strong>Total Retake: </strong>'.$rest_retake;?></h6>
                <!-- <?php echo $this->session->flashdata('response');?>  -->
                <?php foreach ($all_question as $key => $value) { ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="mt-0"><?php echo $value['question_title'];?> <span class="required"> * </span></h4>
                        <div class="qanswer">
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" size="20"  type="radio" value="1" required>
                                <span class="mode-span btn"><?php echo $value['answere1'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" size="20"  type="radio" value="2" required>
                                <span class="mode-span btn"><?php echo $value['answere2'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" size="20"  type="radio" value="3" required>
                                <span class="mode-span btn"><?php echo $value['answere3'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id']?>" size="20"  type="radio" value="4" required>
                                <span class="mode-span btn"><?php echo $value['answere4'];?></span> </label>
                        </div>
                    </div>
                </div>
                <?php } ?> 

                <div class="form-group">
                    <input class="btn btn btn-primary btn-lg" value="Submit Answers" type="submit" name="save">
                </div>
            </form><?php
            } //end of switch ?>   

            <?php }else{ ?>
                <?php if(!empty($ins_id)){ 
                 echo '<p class="text-center">
                        <div class="alert alert-info">
                    <div class="alert alert-info">This online course is accessible only by professionals under <br>Institution: <i>'.$insName.'</i>.<br>Please log-in or register to access this online course.</div>
                        </p>'; ?>
              <?php }else{ ?>
                <p class="text-center">
                  <div class="alert alert-info">Please purchase this online course and access the exam section.</div><button class="btn btn-primary"><a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?></a></button>
              </p><?php } ?>
            <?php } ?>

        <?php  }elseif($role == 2 || $role == 6 ){ ?>
            <?php if($coursecreator['status'] == 1){
                            echo '<b>This course is Published</b>';
                    }else{ ?>
            <h4 style="color: blue;">This is dummy of your course! you can not submit it.</h4>
                <form action="javascript:void(0)" method="post" enctype="multipart/form-data" name="nullform" id="nullform">
                <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                <h6>Passing Marks : <?php echo $passing_marks['passing_marks']; ?>%</h6>
                <h6><?php echo '<strong>Note: </strong>'.$courseData['course_exam_note'];?></h6>
                <h6><?php echo '<strong>Total Retake: </strong>'.$rest_retake;?></h6>
                <!-- <?php echo $this->session->flashdata('response');?>  -->
                <?php $qcount = 1;
                foreach ($all_question as $key => $value) { ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="mt-0"><?php echo $qcount.'. '.$value['question_title'];?> <span class="required"> * </span></h4>
                        <div class="qanswer">
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" size="20"  type="radio" value="1" required>
                                <span class="mode-span btn"><?php echo $value['answere1'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" size="20"  type="radio" value="2" required>
                                <span class="mode-span btn"><?php echo $value['answere2'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" size="20"  type="radio" value="3" required>
                                <span class="mode-span btn"><?php echo $value['answere3'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id']?>" size="20"  type="radio" value="4" required>
                                <span class="mode-span btn"><?php echo $value['answere4'];?></span> </label>
                        </div>
                    </div>
                </div>
                <?php $qcount++; } ?> 
                <div class="form-group">
                    <input class="btn btn btn-primary btn-lg" value="Submit Answers" onclick="alert('This is dummy of your course! you can not submit it.');" type="button" name="save">
                </div>
            </form>
                <?php } ?> 

                <?php }else{ 
                    if(!empty($ins_id)){ 
                 	echo '<p class="text-center">
                        <div class="alert alert-info">This online course is accessible only by professionals under <br>Institution: <i>'.$insName.'</i>.<br>Please log-in or register to access this online course.</div>
                        </p>'; 
                }else{ ?>
                <p class="text-center">
                	<div class="alert alert-info">Please purchase this online course and access the evaluation section.</div>
                	<button class="btn btn-primary"><a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?></a></button>
              	</p> 
            <?php } } ?> 
    <?php } //end of if ?>
    
            </div>
        </div>
        <?php $this->load->view('pages/sidebar'); ?>
    </div>
    </div>
</div>

    <div class="modal fade" id="rePurchaseModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Re-Purchase course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center">
                    <strong style="font-size: 15px;">Please Click on BUY button to purchase this course.</strong>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">
                        <a style="color: #ffff;" href="javascript:void(0)" onclick="movetoarchive();">BUY $<?php echo floatval($course[0]['total']);?>
                        </a>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


<?php
if(!empty($_SESSION['excid'])){
    $uuid 		 = $getexcertificate->user_id;
    $uemail      = $this->session->userdata('logged_in')['username'];
    $course_name = $getexcertificate->course_name;
    $units 		 = $getexcertificate->units;
    $start_date  = $getexcertificate->start_date;
    $end_date 	 = $getexcertificate->end_date;
    $certificate_id = $getexcertificate->certificate_id;
    $certificate = $getexcertificate->certificate;
    $category 	 = $getexcertificate->category;
    $issue_date  = $getexcertificate->issue_date;
    $issue_from  = $getexcertificate->issue_from;
    $issue_by 	 = $getexcertificate->issue_by;
    $cep_name  	 = $getexcertificate->cep_name;
    $status 	 = $getexcertificate->status;
    $added_on 	 = $getexcertificate->added_on;
    $domain 	 = $_SESSION['excdomain'];
}
?>

<style type="text/css">[type=radio]:checked + span { border: 2px solid rgb(32, 223, 128); box-shadow: 0 0 10px rgba(32,223,128,.4); position: relative; }.mode-span{padding: 5px;} </style>

<script>
    $( document ).ready(function() {
        var srb = "<?php if(!empty($_SESSION['excid'])){ ?>"+ send_to_rboard(); +"<?php } ?>";
    }); 
    
    function repurchase(){
        var re = confirm('You have used all <?php echo $course[0]['quiz_retek']; ?> retakes, Please Purchase this course again.');
        if(re){
            $('#rePurchaseModel').modal('show');
        }
    }    

    function movetoarchive(){
        var cid = '<?=$cid;?>';
        var uid = '<?=$uid;?>';
        // alert(uid);
        $.ajax({
            url: "<?php echo base_url("pages/course_archive");?>",
            type: "POST",
            cache: false,
            data: { cid : cid , uid : uid},
            success: function(data){
                // alert(data);
                pay_now();
            }
        });
    }
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>
    function send_to_rboard(){
        var uemail = '<?php echo $uemail; ?>';
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
        var domain = '<?php echo $domain; ?>';
        var certificate_identify = 1;
        var rbdata = JSON.stringify({
                    user_email : uemail, course_name : course_name, units : units, start_date : start_date,
                end_date : end_date, certificate_id :certificate_id, certificate : certificate, category : category, issue_date : issue_date, issue_from : issue_from, issue_by : issue_by, cep_name : cep_name, status : status, added_on : added_on, certificate_identify : certificate_identify
                });
        // alert(rbdata);
        $.ajax({
            url: domain + '/admin/api/add_certificate',
            type: 'POST',
            data: rbdata,
            dataType: 'json',
            success: function(result){
                // alert(result);
                console.log(result);
            }
        });
    }

<?php unset($_SESSION['excid']); unset($_SESSION['excdomain']); ?>

</script>

