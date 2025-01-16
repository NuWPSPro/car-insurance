
<?php //print_r($this->session->all_userdata());
        $idd = $this->uri->segment(3);
        $course = $this->user ->get_record_by_field_name_all_record('tbl_course','id',$idd);
        
        $insCourseId = end(explode('-', $course[0]['insititution_id']));
        $insName = $this->db->get_where('tbl_user',array('id'=>$insCourseId))->row_array()['name'];   
        if($course[0]['tax'] <= 0){
          $tax = 0;
        }else{
          $price = $course[0]['price'];
          $taxpercentage = $course[0]['tax'];
          $tax = ($price*$taxpercentage)/100;
        }
        
        $childIns = $this->user
        ->get_record_by_field_name_all_record('tbl_user','insititution_id',$this->session->userdata('logged_in')['insititution_id']);
        
        $parentIns = $this->user
        ->get_record_by_field_name_all_record('tbl_user','id',$childIns[0]['parent_insititution']);
        
        $purchaselist = $this->user
        ->purchaselist(['user_id'=>$this->session->userdata('logged_in')['id']]);
       
        $buybtn = $this->db
        ->where(array('user_id'=>$this->session->userdata('logged_in')['id'],'item_name'=>$idd,'archive'=>'0','status'=>1))
        ->get('tbl_purchase_llis')->row_array();
        // echo $this->db->last_query();
        // echo'<pre>';print_r($buybtn); 
        $provider_id = $course[0]['author_reference_id']!="" ? $course[0]['user_id']:'';
        $udata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$provider_id);
        $author_id = $udata[0]['id']; 
        $uid =$this->session->userdata('logged_in')['id'];
        $checkevaluation = $this->db->get_where('tbl_course_review',array('course_id'=>$idd  ,'user_id'=>$uid))->row_array();   ?>

        <h3 class="border-title text-left"><?php echo $course[0]['course_title'];?></h3>
         
        <div class="">
            <div class="course-unit"><strong>Credit Units/Contact Hours : </strong><?php echo $course[0]['units'];?>
            </div>
            
            <?php //print_r($course[0]['id']);
            if($buybtn == ''){
            if(empty($course[0]['insititution_id']) ){  ?>
              <a href="javascript:void(0)" onclick="pay_now();">
                <div class="training-price"> BUY $<?php echo $course[0]['total'];?> </div>
              </a>
                <!-- <a href="javascript:void(0)" onclick="paynowby();">
            <div class="training-price mb-0"> BUY $<?php echo floatval($course[0]['total']);?> </div>
            </a> -->
            
        <?php  } } ?>

            <?php if(!empty($course[0]['insititution_id']) ){ ?>
            <!-- <a href="#"  onclick="openpopup();">
            <div class="training-price" style="margin-left:10px"> Register</div>
            </a>-->
            <?php $insIformation = $this->user->get_user_record('tbl_user','insititution_id',$course[0]['insititution_id']); 
            if($insIformation->under_insititution == 1){
              $pinstitution = $this->user->get_user_record('tbl_user','id',$insIformation->parent_insititution); 
              if(!empty($pinstitution->insititution_id)):
                $inshref = base_url('web/').$pinstitution->insititution_id; 
              else:
                $inshref = ''; 
              endif;
            }else{
              $inshref = base_url('web/').$course[0]['insititution_id']; 
            }?> 
            <?php if($inshref): ?>
            <a href="<?php  echo $inshref; ?>">
            <div class="training-price" > BACK TO WEBPAGE</div>
            </a>
            <?php endif; ?>
            <?php  } ?>
             <div class="mob-social">
                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                    <a class="a2a_button_facebook"></a>
                    <a class="a2a_button_twitter"></a>
                    <a class="a2a_button_google_plus"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
            </div>
        </div>



        <div class="clear-line"></div>
        <ul class="page-nav" style="position:relative">       
            
            <li class="<?php if($this->uri->segment(2)=='course_details'){ echo 'active'; } ?>">
              <a href="<?php echo site_url('pages/course_details/').$idd; ?>">Overview</a>
            </li>
            
            <li class="<?php if($this->uri->segment(2)=='lesson'){ echo 'active'; } ?>">
              <a href="<?php echo site_url('pages/lesson/').$idd;?>">Lesson </a>
            </li>
            
            <li class="<?php if($this->uri->segment(2)=='exam'){ echo 'active';  } ?>">
              <a href="<?php echo site_url('pages/exam/').$idd;?>">Exam </a>
            </li>
            
          <?php if(count($checkevaluation) == 0){ ?>
            <li class="<?php if($this->uri->segment(2)=='certificate'){ echo 'active'; } ?>">
              <a href="<?php echo site_url('pages/evaluation/').$idd;?>" onclick="return alert('Please evaluate this course to see your Certificate.');">Certificate</a>
            </li>
          <?php }else{ ?>
            <li class="<?php if($this->uri->segment(2)=='certificate'){ echo 'active'; } ?>">
              <a href="<?php echo site_url('pages/certificate/').$idd;?>">Certificate</a>
            </li>
          <?php } ?>
            
            <li class="<?php if($this->uri->segment(2)=='evaluation'){ echo 'active'; } ?>">
              <a href="<?php echo site_url('pages/evaluation/').$idd;?>">Evaluation </a>
            </li> 

          <?php if($course[0]['author_reference_id'] != ""){ ?>
            <li class="<?php if($this->uri->segment(2)=='author'){ echo 'active'; } ?>">
              <a href="javascript:void(0)" onclick="author_detail('<?php echo $author_id; ?>')"> Author </a>
            </li>
          <?php } ?> 

            <li class="<?php if($this->uri->segment(2)=='report_abuse'){ echo 'active'; } ?>">
              <a href="<?php echo site_url('pages/report_abuse/').$idd;?>"> Report Abuse </a>
            </li>  
        </ul>

    <form action="<?php echo base_url('pages/paymentForCourse'); ?>" method="post" name="purCourse" id="purCourse">
        <input type="hidden" name="item_name" id="item_name" value="<?php echo $course[0]['course_title'];?>">
        <input type="hidden" name="item_number" value="<?php echo $course[0]['id'];?>">
        <input type="hidden" name="userid" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
        <input type="hidden" name="tax" value="<?php echo $tax; ?>">
        <input type="hidden" name="amount" id="amount" value="<?php echo floatval($course[0]['total']);?>">
    </form> 
    
<!-- Modal -->
<div class="modal fade" id="purchaseLessionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <?php if(empty($course[0]['insititution_id']) || $course[0]['insititution_id']=='0'){ ?>
        <strong style="font-size: 15px;">Please purchase this online course and access the lesson section.</strong>
      <?php }else{ ?>
          <strong style="font-size: 15px;">This online course is accessible only by professionals under <br>Institution: <i><?php echo $insName; ?></i>.
            <br>Please log-in or register to access this online course.</strong>
            
      <?php }?>
      </div>
      <div class="modal-footer">
         <?php if(empty($course[0]['insititution_id']) || $course[0]['insititution_id']=='0'){ ?>
    	    <button class="btn btn-primary">
              <a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?></a>
          </button>
        <?php }else{ ?>
          <button class="btn btn-primary" style="background: #3d66b0;">
            <a href="<?php echo BASE_URL.'users';?>" class="lgn" title="Login" style="color: #ffff;" ><i class="fa fa-user"></i> Login</a></button>
          <button class="btn btn-primary" style="background: orange;">
            <a href="javascript:void(0);" onclick="register_now()" title="Register Now" class="register" style="color: #ffff;">Register</a></button>
        <?php }?>
      </div>
   
    </div>
  </div>
</div>




<div class="modal fade" id="authordetailmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Author Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <?php 
        $profile = $this->db->get_where('tbl_user',array('id'=>$author_id))->row_array(); 
        $professionals = $this->db->get_where('tbl_professionals',array('user_id'=>$author_id))->row_array(); ?>
                <div class="user-profile-thumb" style="text-align: center; width: 220px;margin: 0 auto;">
                    <?php if($profile['image']) {?>
                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$profile['image'];?>" alt="<?php echo $profile['image'];?>">
                    <?php } else { ?>
                    <img src="<?php echo ASSETS_URL.'images/dummy-profile.jpg'; ?>" alt="dummy-profile">
                    <?php } ?>
                </div>
                <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <td><?php echo $profile['name'];?></td>
                </tr>
                <tr>
                    <th>Profession</th>
                    <td><?php echo $profile['profession'];?></td>
                </tr>
                <?php if(!empty($profile['location'])){ ?>
                <tr>
                    <th>Country</th> <?php $country_name = $this->db->get_where('countries',array('countries_id'=>$profile['location']))->row_array()['countries_name'] ;?>
                    <td><?php echo $country_name; ?></td>
                </tr>
                <?php } ?>
                <?php if(!empty($professionals['specialization'])){ ?>
                <tr>
                    <th>Specialization</th>
                    <td><?php echo $professionals['specialization'];?></td>
                </tr>
                <?php } ?>
                <?php if(!empty($professionals['years_of_practice'])){ ?>
                <tr>
                    <th>Practice</th>
                    <td><?php echo $professionals['years_of_practice'].' Yrs.';?></td>
                </tr>
                <?php } ?>
                <tr>
                    <th>Registered Date</th>
                    <td><?php echo $profile['added_on'];?></td>
                </tr>

               <!--  <tr>
                    <th>CP</th>
                    <td><?php echo $profile['under_provider'];?></td>
                </tr> -->
                <?php if(!empty($profile['mobile'])){ ?>
                <tr>
                    <th>Landline</th>
                    <td><?php echo $profile['mobile']; ?></td>
                </tr>
                <?php } ?>

                <?php if(!empty($profile['skype'])){ ?>

                 <tr>
                    <th>Skype</th>
                    <td><?php echo $profile['skype'];?></td>
                </tr>
                <?php } ?>

                            
            </table> 

      </div>
      <div class="modal-footer">
        <a href="<?php echo BASE_URL.'share/viewprofile/'.$author_id;?>" target="_blank" class="btn btn-primary">More Details</a>
        <!-- <button type="button"  target="_blank" class="btn btn-primary" onclick="checklogin('<?php echo $author_id; ?>')"> More Details </button> -->
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>


 <div id="myModal112" class="modal fade" role="dialog">
   	<div class="modal-dialog">
   		<!-- Modal content-->
   		<div class="modal-content">
   			<div class="modal-header">
   				<button type="button" class="close" data-dismiss="modal">&times;</button>
   				<h4 class="modal-title">Book Online Course</h4>
   			</div>
   			<div class="modal-body">
   				<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
   					<div class="form-group">
   						<label for="email">Name <span style="color: red;">*</span></label>
   						<input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
   					</div>
   					<div class="form-group">
   						<label for="email">Email <span style="color: red;">*</span></label>
   						<input type="email" class="form-control" id="email" name="email" placeholder="mymail@ceonpoint.com" value="" required>
   					</div>
   					
   					
   					<button type="submit" class="btn btn-primary" id="savebutton">Submit</button>
   				</form>
   			</div>
   		</div>
   	</div>
   </div>

   <div id="payby" class="modal fade" role="dialog">
    <div class="modal-dialog modal-centered">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-white">Choose Payment Option</h4>
        </div>
        <div class="modal-body text-center"> 
          <a href="javascript:void(0)" onclick="paybypaypal();" class="btn"><img src="<?=base_url('assets/images/paypallogo.png') ?>" style="height:40px; width:100px;"></a>
           <a href="javascript:void(0)" onclick="paybystrip('<?php echo $course[0]['total']; ?>');" class="btn"><img src="<?=base_url('assets/images/OIP.jpg') ?>" style="height:40px; width:100px;"></a>
          <!-- <a href="<?php echo base_url('stripe/index/').$course[0]['id'].'/'.$course[0]['total'].'/'.'course';?>" class="btn">Card</a> -->
          <a href="javascript:void(0)" onclick="paybypayu('<?php echo $course[0]['total']; ?>');" class="btn"><img src="<?=base_url('assets/images/payu.jpg') ?>" style="height:40px; width:100px;"></a>
        </div>
      </div>
    </div>
   </div>

     <div id="login_registration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ceonpoint Says:</h4>
                </div>
                <div class="modal-body"> 
                    <p>Please Log in or Sign up as a <b> Professional </b> to buy this Online Course.</p>
                </div>
                <div class="modal-footer">
                     <a href="<?php echo BASE_URL.'users/index?location='.urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-primary" title="Login">Login</a>
                                          
                      <a href="<?php echo BASE_URL.'users/signup/professional?location='.urlencode($_SERVER['REQUEST_URI']); ?>" title="Register on ceonpoint" class="btn btn-warning" >Register Now</a> 
                </div>
            </div>
        </div>
    </div>

<?php  $is_login =  (int)$this->session->userdata('logged_in')['id']; ?>
<script type="text/javascript">
  function pay_now() {
    // alert('ok');
        if('<?=$is_login ?>' > 0){
          $('#payby').modal('show');
            // document.getElementById("frmPayPal1").submit();
        }else{
            $("#purchaseLessionModal").modal('hide');
            $("#login_registration").modal('show');
            // var r = confirm('Please logged in first!');
            // if (r == true) {
            //     window.location.href = "<?php echo BASE_URL.'users'; ?>";
            // }
        }
    }


  function checklogin(author_id){
    if('<?=$is_login ?>' > 0){
        window.location.href = "<?php echo BASE_URL.'author/author_profile/'; ?>"+author_id;
    }else{
        // alert('Please log in first!');
         $("#purchaseLessionModal").modal('hide');
         $("#login_registration").modal('show');
    }
  }

  function author_detail(author_id){
    $('#authordetailmodel').modal('show');
  }

  function openpopup() {
    $("#myModal112").modal();
  }

  function paybypaypal() {
      $("#purCourse").submit();
    }

  function paybystrip(total) {
    window.location.href ='<?php echo base_url('stripe/index').'?id='.$idd.'&&name='.$course[0]['course_title'].'&&price='.$course[0]['total'].'&&tax='.$tax.'&&type=course';?>';
  }

  function paybypayu(total) {
    window.location.href ='<?php echo base_url('payu/index').'?id='.$idd.'&&name='.$course[0]['course_title'].'&&price='.$course[0]['total'].'&&tax='.$tax.'&&type=course';?>';
  }  
          
</script>