 
  <?php 
        $idd = $this->session->userdata('logged_in')['id'];
        $cid = $this->uri->segment(3);
        $datas = $this->db->get_where('tbl_purchase_llis',array('item_name'=>$cid,'user_id'=>$idd))->row_array();   
        
        $course_datas = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();   
        $users_datas = $this->db->get_where('tbl_user',array('id'=>$idd))->row_array();  

        $parent_users_datas = $this->db->get_where('tbl_user',array('id'=>$users_datas['parent_insititution']))->row_array();
        // $u_inst_id = ($parent_users_datas['insititution_id']== NULL) ? 0 : $parent_users_datas['insititution_id']; 
        $u_inst_id = ($users_datas['under_insititution'] == 0) ? 0 : $users_datas['under_insititution']; 
        $c_inst_id = ($course_datas['insititution_id'] == NULL) ? 0 : $course_datas['insititution_id']; 
        $user_ins_id = $users_datas['insititution_id'];
        $provider_id = end(explode('-',$users_datas['under_provider']));
        $ins = $this->db->get_where('tbl_institution_staff_payment',array('provider_id'=>$provider_id))->row_array(); 
        $profArr = explode(',',$ins['prof_id']);
        // echo '<pre>';print_r($users_datas); 
        $con = array_search($idd,$profArr);
       if($profArr[$con] == ''){ 
            $cons = 2; 
        }else{ 
            $cons = 1; 
        }

        if($u_inst_id != 0 || $u_inst_id != ''){
             if($c_inst_id == $user_ins_id)
              {
                $datass = array('lock'=>'unlock');
              } 
              // elseif(!empty($course_datas) && !empty($parent_users_datas))
              // {
              // // echo'3';
              //   $datass = array('lock'=>'unlock');
              // }
              else
              {
              // echo'4';
                $datass = array();
              }
        }else{
          // echo '5';
           $datass = array();
        } ?>  

<?php $this->load->view('template/search'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
      <!--  <h3 class="border-title text-left pull-left"><?php echo $course[0]['course_title'];?></h3>
            <div class="training-price">$50 - Buy Now</div>
            <div class="clear-line"></div>
              <ul class="page-nav">
                  <?php $idd = $this->uri->segment(3);?>
                  <li><a href="<?php echo site_url('pages/course_details/'.$idd.'');?>">Overview</a></li>
                  <li class="active"><a href="<?php echo site_url('pages/lesson/'.$idd.'');?>">Lesson </a></li>
                  <li><a href="<?php echo site_url('pages/exam/'.$idd.'');?>">Exam </a></li>
                  <li><a href="<?php echo site_url('pages/certificate/'.$idd.'');?>">Certificate</a></li>
                  <li><a href="<?php echo site_url('pages/evaluation/'.$idd.'');?>">Evaluation </a></li>
              </ul> -->
  

 <?php $this->load->view('template/coursemenu'); ?>
<div class="panel-group" id="accordion">
<?php	
    $firstshow = false;
    foreach ($lesson as $key => $value) { ?>
    <div class="panel panel-default">

      <div class="panel-heading">
        <h4 class="panel-title">
          <?php if(empty($datas) && empty($datass)){
                			if($firstshow==false){
                				$sss="toggle";
                				$firstshow=true;
                				$icon="unlock";
                			}else{
                				$sss="toggle1";
                				$icon="lock";
                			}
              		}else{
              			$sss="toggle";
              			$icon="unlock";
              		} ?> 
        <?php if($icon!="lock"){ ?>            
          <a data-<?php echo $sss;?>="collapse" data-parent="#accordion" href="#collapse<?php echo $key+1;?>">
  		      <i class="fa fa-<?=$icon?>"></i> 
  		      Lesson No <?php echo $key+1;?> : <?php echo $value['lesson_title'];?>
          </a>
        <?php }else{ ?>
            <a data-toggle="modal" data-target="#purchaseLessionModal">
                <i class="fa fa-<?=$icon?>"></i> 
                Lesson No <?php echo $key+1;?> : <?php echo $value['lesson_title'];?>
            </a>
        <?php } ?>
        </h4>
      </div>
         
      <div id="collapse<?php echo $key+1;?>" class="panel-collapse collapse">
          <div class="panel-body"> 
            <div class="lesson-details">
              <p><strong>Description</strong></p>
              <p><?php echo $value['lesson_content'];?></p>

              <p><strong>Case Study</strong></p>
              <p><?php echo $value['case_study'];?></p>

              <?php if(!empty($value['lesson_video'])){ ?>
              <p><strong>Course Video</strong></p>
              <p><video width="700" height="300" controls="controls" autoplay preload="auto" poster="path-to-poster.jpg">
                  <source src="<?php echo BASE_URL.'assets/images/uploads/'.$value['lesson_video'];?>" type="video/mp4" />
                  <source src="path-to-webm.webm" type="video/webm" />
                  <source src="path-to-ogv.ogv" type="video/ogg" />
                </video></p><?php } ?>
            </div> 
          </div>
      </div>
    </div>
   <?php } ?>

            <br><br>
            <?php if(!empty($value['summary'])){ ?>
                <div class="summary-dicpritionbox" style="display:inline-block;width: 100%;"><p><strong>Summary</strong><?php echo $value['summary'];?></p></div>
            <?php } ?>
            <?php if(!empty($value['course_references'])){ ?>
                <div class="summary-dicpritionbox" style="display:inline-block;width: 100%;"><strong>Course References</strong><?php echo $value['course_references'];?></p></div>
            <?php } ?>
</div>
          </div>
  <?php  $this->load->view('pages/sidebar');  ?>
        </div>
    </div>
</div>


