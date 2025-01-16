<?php 
$idd = $this->session->userdata('logged_in')['id'];
$cid = $this->uri->segment(3);
$users_datas = $this->db->get_where('tbl_user',array('id'=>$idd))->row_array();
$user_ins_id = $users_datas['insititution_id'];
$datas = $this->db->get_where('tbl_purchase_llis',array('item_name'=>$cid,'user_id'=>$idd,'status'=>1,'archive'=>'0'))->row_array();   
$courseData = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array(); 
$coursecreator = $this->db->get_where('tbl_course',array('id'=>$cid,'user_id'=>$idd))->row_array(); 
// echo $this->db->last_query();
$ins_id = $course[0]['insititution_id'];   

$insCourseId = end(explode('-', $course[0]['insititution_id']));
$insName = $this->db->get_where('tbl_user',array('id'=>$insCourseId))->row_array()['name'];

$role = $this->session->userdata('logged_in')['role']; 
    $provider_id = end(explode('-',$users_datas['under_provider']));
    $ins = $this->db->get_where('tbl_institution_staff_payment',array('provider_id'=>$provider_id))->row_array(); 
    $profArr = explode(',',$ins['prof_id']);
   
    $con = array_search($idd,$profArr);
   if($profArr[$con] == ''){ 
        $cons = 2; 
    }else{ 
        $cons = 1; 
    } ?>  

<?php $this->load->view('template/search'); ?>

<div class="innerContent">
  <div class="container">
    <div class="row">
                       
      <div class="col-sm-8">       
        <?php $this->load->view('template/coursemenu'); ?>
        <h3 class="border-title text-left"> Report Abuse</h3>
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
                        Please purchase this online course and access the report abuse section.
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
              <?php echo $this->session->flashdata('response-s'); ?>
              <form action="<?php echo site_url('pages/report_abuse/').$cid;?>" method="post" name="frm"> 
                <div class="form-group">
                  <textarea class="form-control" name="comment" id="comment" placeholder="Please write your comment..." required></textarea></div>
                <div class="form-group text-right">
                  <input type="submit" value="Report" class="btn btn-primary btn-lg">
                </div>
              </form>
            <?php }else{ ?>
                <?php if(!empty($ins_id)){ 
                 echo '<p class="text-center">
                        <div class="alert alert-info">This online course is accessible only by professionals under <br>Institution: <i>'.$insName.'</i>.<br>Please log-in or register to access this online course.</div>
                        </p>'; ?>
              <?php }else{ ?>
                <p class="text-center">
                  <div class="alert alert-info">Please purchase this online course and access the report abuse section.</div><button class="btn btn-primary"><a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?></a></button>
              </p><?php } ?>
            <?php } ?>
            <?php  }elseif($role == 2){ ?>
              <?php if($coursecreator['status'] == 1){
                  echo '<b>This course is Published</b>';
              }else{ ?>
              <h4 style="color: blue;">This is dummy of your course! you can not submit it.</h4>
              <form action="javascript:void(0);" method="post" name="frm"> 
                <div class="form-group">
                  <textarea class="form-control" name="comment" id="comment" placeholder="Please write your comment..." required></textarea></div>
                <div class="form-group text-right">
                  <input type="submit" value="Report" onclick="alert('This is dummy of your course! you can not submit it.');" class="btn btn-primary btn-lg">
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
          <?php  } ?>
          <?php  } ?>
        </div>
      </div>

       <?php $this->load->view('pages/sidebar'); ?>
    </div>
  </div>
</div>