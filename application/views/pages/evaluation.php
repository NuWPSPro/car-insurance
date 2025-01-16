<?php 

$idd = $this->session->userdata('logged_in')['id'];
$cid = $this->uri->segment(3);
$course = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid); 
$ins_id = $course[0]['insititution_id'];  

$insCourseId = end(explode('-', $course[0]['insititution_id']));
$insName = $this->db->get_where('tbl_user',array('id'=>$insCourseId))->row_array()['name'];

$users_datas = $this->db->get_where('tbl_user',array('id'=>$idd))->row_array(); 
$datas = $this->db->get_where('tbl_purchase_llis',array('item_name'=>$cid,'user_id'=>$idd,'status'=>1,'archive'=>'0'))->row_array();
$courseData = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();  
$checkevaluation = $this->db->order_by('id','DESC')->get_where('tbl_course_review',array('course_id'=>$cid ,'user_id'=>$idd))->result_array();

$coursecreator = $this->db->get_where('tbl_course',array('id'=>$cid,'user_id'=>$idd))->row_array();    
$role = $this->session->userdata('logged_in')['role']; 
$user_ins_id = $users_datas['insititution_id'];
  $provider_id = end(explode('-',$users_datas['under_provider']));
  $ins = $this->db->get_where('tbl_institution_staff_payment',array('provider_id'=>$provider_id))->row_array();  
  $profArr = explode(',',$ins['prof_id']);

  $con = array_search($idd,$profArr,true);
  if($profArr[$con] == ''){ 
      $cons = 2; 
  }else{ 
      $cons = 1; 
  }?>

<?php $this->load->view('template/search'); ?>
<div class="innerContent">
  <div class="container">
    <div class="row">

      <div class="col-sm-8">       
        <?php $this->load->view('template/coursemenu'); ?>
        <h3 class="border-title text-left"> Evaluation</h3>
        <div class="lesson-wrapper p-20">
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
                        Please purchase this online course and access the evaluation section.
                    </div>
                    <button class="btn btn-primary">
                        <a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?>
                        </a>
                    </button>
                </p>
            <?php  } ?>

          <?php  }else{ ?>
              <?php if($role == 1){ ?>
                <?php if($datas || $courseData['insititution_id'] == $user_ins_id){ ?>
              
              <?php 
                if(empty($checkevaluation)){
               ?>
              <p><?php echo strip_tags($courseData['course_evaluation_note']);?></p>
              <?php echo $this->session->flashdata('response');?>

              <form action="<?php echo site_url('provider/savecourserating');?>" method="post" name="frm"> 

                <?php foreach ($evaluation as $key => $value) {  ?>
                  <input type="hidden" name="questionid[]" value="<?php echo $value['id'];?>">
                  <input type="hidden" name="cid" value="<?php echo $cid;?>">
                  <h5><strong><?php echo $key+1;?>. <?php echo $value['evaluation_question']; ?></strong></h5>   
                  <br>
                  <?php if($value['evaluation_type']==1){ ?>
                  <fieldset class="rating">
                  <input type="radio" id="field<?php echo $key+1;?>_star5" name="rating<?php echo $value['id'];?>" value="5" />
                  <label  title="Excellent" class = "full" for="field<?php echo $key+1;?>_star5"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star4" name="rating<?php echo $value['id'];?>" value="4" />
                  <label  title="Very Good" class = "full" for="field<?php echo $key+1;?>_star4"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star3" name="rating<?php echo $value['id'];?>" value="3" />
                  <label  title="Good" class = "full" for="field<?php echo $key+1;?>_star3"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star2" name="rating<?php echo $value['id'];?>" value="2" />
                  <label  title="Fair" class = "full" for="field<?php echo $key+1;?>_star2"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star1" name="rating<?php echo $value['id'];?>" value="1" />
                  <label  title="Needs Improvement" class = "full" for="field<?php echo $key+1;?>_star1"></label>
                  </fieldset>
                  <br><br>
                  <?php }else{  ?>
                <div class="form-group">
                    <textarea class="form-control" name="evaluation[]" id="evaluation" placeholder="Comments" required></textarea>
                </div>
                <?php } }  ?>
                <div class="form-group text-right">
                    <input type="submit" value="Submit Evaluation" class="btn btn-primary btn-lg">
                </div>
            </form>
              <?php  }else{ ?>
                <div class="alert alert-success"><p>Thank you for doing the evaluation.</br>Your responses will be kept confidential.</p></div>
                
                <button class="btn btn-primary"><a href="<?php echo base_url('pages/certificate/').$cid;?>"title="Certificate" style="color: #fff; ">Click here to view your Certificate</a></button>
              <?php } ?>

          <?php }else{ ?>
               <?php if(!empty($ins_id)){ 
                 echo '<p class="text-center">
                        <div class="alert alert-info">This online course is accessible only by professionals under <br>Institution: <i>'.$insName.'</i>.<br>Please log-in or register to access this online course.</div>
                        </p>'; ?>
              <?php }else{ ?>
                <p class="text-center">
                  <div class="alert alert-info">Please purchase this online course and access the evaluation section.</div><button class="btn btn-primary"><a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?></a></button>
              </p><?php } ?>
      <?php } ?>
      <?php  }elseif($role == 2){ ?>
              <?php if($coursecreator['status'] == 1){
                  echo '<b>This course is Published</b>';
              }else{ ?>
                <h4 style="color: blue;">This is dummy of your course! you can not submit it.</h4>
                  <form action="javascript:void(0);" method="post" name="frm"> 
                <?php foreach ($evaluation as $key => $value) {  ?>
                  <input type="hidden" name="questionid[]" value="<?php echo $value['id'];?>">
                  <input type="hidden" name="cid" value="<?php echo $cid;?>">
                  <h5><strong><?php echo $key+1;?>. <?php echo $value['evaluation_question']; ?></strong></h5>   
                  <br>
                  <?php if($value['evaluation_type']==1){ ?>
                  <fieldset class="rating">
                  <input type="radio" id="field<?php echo $key+1;?>_star5" name="rating<?php echo $value['id'];?>" value="5" /><label class = "full" for="field<?php echo $key+1;?>_star5"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star4" name="rating<?php echo $value['id'];?>" value="4" /><label class = "full" for="field<?php echo $key+1;?>_star4"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star3" name="rating<?php echo $value['id'];?>" value="3" /><label class = "full" for="field<?php echo $key+1;?>_star3"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star2" name="rating<?php echo $value['id'];?>" value="2" /><label class = "full" for="field<?php echo $key+1;?>_star2"></label>

                  <input type="radio" id="field<?php echo $key+1;?>_star1" name="rating<?php echo $value['id'];?>" value="1" /><label class = "full" for="field<?php echo $key+1;?>_star1"></label>
                  </fieldset><br><br>
                <?php  }else{  ?>
                <div class="form-group">
                    <textarea class="form-control" name="evaluation[]" id="evaluation" placeholder="Comments" required></textarea>
                </div>
                <?php  } } ?>
                <div class="form-group text-right">
                    <input type="submit" value="Submit Evaluation" onclick="alert('This is dummy of your course! you can not submit it.');" class="btn btn-primary btn-lg">
                </div>
            </form> 
          <?php  } ?>
                  
          <?php  }else{

          		if(!empty($ins_id)){ 
                 	echo '<p class="text-center">
                        <div class="alert alert-info">This online course is accessible only by professionals under <br>Institution: <i>'.$insName.'</i>.<br>Please log-in or register to access this online course.</div>
                        </p>'; 
                }else{ ?>
                <p class="text-center">
                	<div class="alert alert-info">Please purchase this online course and access the evaluation section.</div>
                	<button class="btn btn-primary"><a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?></a></button>
              	</p> 
            <?php } ?>

            <?php } ?>
          <?php } ?>
        </div>
      </div>

     <?php $this->load->view('pages/sidebar'); ?>
    </div>
  </div>
</div>

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
    /*background-color:#D8D8D8;*/
    background-color:#8ac2d1;
    border-radius:15px;
  height:25px;
}
p {
    word-break: break-all;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { 
    background-color:#7ED321 !important;
  cursor:pointer;
} /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label/* lighten current selection */ { 
    background-color:#7ED321 !important;
  cursor:pointer;
} 
</style>

<!-- <script type="text/javascript">
 jQuery(document).ready(function($){      
  $("label").click(function(){
  $(this).parent().find("label").css({"background-color": "#D8D8D8"});
  $(this).css({"background-color": "#7ED321"});
  $(this).nextAll().css({"background-color": "#7ED321"});
});      
});
 
</script> -->