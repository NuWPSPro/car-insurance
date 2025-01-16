   <?php
        $name = $this->session->userdata('logged_in')['name'];
        $email = $this->session->userdata('logged_in')['username'];
        $user_id  =  $this->session->userdata('logged_in')['id'];
        $country_id  =  $this->session->userdata('logged_in')['country'];
        $institutionRow = $this->db->get_where('tbl_user',array('id'=>$user_id))->row_array();
        $institutionId = $institutionRow['parent_insititution'];
        $tid = $this->uri->segment(3); 
        $taxAmount = number_format(floatval(($seminar[0]['price']*$seminar[0]['tax'])/100),2);  
        
        $seminar   = $this->share->get_row_array('tbl_training','id',$tid); 
        $uid = $seminar['user_id'];
        $parentid = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['parent_insititution']; 
        $parent_details = $this->db->get_where('tbl_user',array('id'=>$parentid))->row_array();
        if($parent_details['under_insititution'] == '0'){
            $back_webpage = $parent_details['insititution_id'];
        }else{
            $mainparent_details = $this->db->get_where('tbl_user',array('id'=>$parent_details['parent_insititution'],'under_insititution'=>'0'))->row_array(); 
            $back_webpage = $mainparent_details['insititution_id'];
        }?>
   <div class="training-btn-text">
      <?php $date = date('F d, Y',strtotime($training[0]['start_date']));?>
   	<h3 class="border-title text-left"><?php echo $training[0]['title']; ?></h3>
      
      <p class="text-left"><?php echo $training[0]['sub_title']; ?></p></br>

      <span>CE units/Contact Hours: <?php echo $training[0]['units']; ?></span></br>
      <span title="Start date"><i class="fa fa-calendar"></i> : <?php echo $date; ?></span></br>
      <span title="Venue"><i class="fa fa-location-arrow"></i> : <?php echo $training[0]['location']; ?></span>

      <div class="training-btn">
      	<input type="button" name="paynow" id="paynow" value="REGISTER NOW" class="btn btn-primary" onclick="openpopup(<?php echo $seminar[0]['total']; ?>);">
      	<?php if($back_webpage != '') { ?>
            <a href="<?php echo base_url('web/').$back_webpage; ?>" class="btn btn-primary ml-3">Back to webpage</a>
            <!-- <a href="<?php echo BASE_URL.'web/'.$training[0]['insititution_id']; ?>">
         		<input type="button" value="Back to Institution CE Webpage" class="btn btn-primary ml-3">
            </a> -->
      	<?php } ?>
	  </div>
	  
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

   <ul class="page-nav">
   	<?php $idd = $this->uri->segment(3); ?>
   	<li <?php if ($this->uri->segment(2) == "training_details") { ?>class="active" <?php } ?>><a href="<?php echo site_url('pages/training_details/' . $idd . ''); ?>">General Info</a></li>

   	<li <?php if ($this->uri->segment(2) == "training_details_overview") { ?>class="active" <?php } ?>><a href="<?php echo site_url('pages/training_details_overview/' . $idd . ''); ?>">Overview</a></li>

   	<li <?php if ($this->uri->segment(2) == "training_details_schedule") { ?>class="active" <?php } ?>><a href="<?php echo site_url('pages/training_details_schedule/' . $idd . ''); ?>">Schedule</a></li>

   	<li <?php if ($this->uri->segment(2) == "training_details_speaker") { ?>class="active" <?php } ?>><a href="<?php echo site_url('pages/training_details_speaker/' . $idd . ''); ?>">Speaker</a></li>

   	<li <?php if ($this->uri->segment(2) == "training_details_evaluation") { ?>class="active" <?php } ?>><a href="<?php echo site_url('pages/training_details_evaluation/' . $idd . ''); ?>">Evaluation</a></li>

   </ul>

  

   <div id="training_registration" class="modal fade" role="dialog">
   	<div class="modal-dialog">
   		<!-- Modal content-->
   		<div class="modal-content">
   			<div class="modal-header bg-primary">
   				<button type="button" class="close" data-dismiss="modal">&times;</button>
   				<h4 class="modal-title text-white">Book A Seminar Or Training</h4>
   			</div>
   			<form action="<?php echo BASE_URL.'pages/bookseminar'; ?>" method="post" enctype="multipart/form-data" name="bookseminar" id="bookseminar">
   			<div class="modal-body">
   					<input type="hidden" name="seminar_id" value="<?php echo $tid; ?>">
                  <input type="hidden" name="ttype" value="<?php echo $training[0]['training_type']; ?>">
                  <input type="hidden" name="payment_mode" id="trainig_type">
                  <input type="hidden" name="uid" value="<?php echo $user_id ; ?>">
                  <input type="hidden" name="country" value="<?php echo $country_id ; ?>">
   					<input type="hidden" name="tax" id="tax" value="<?php echo $taxAmount; ?>">
                  <input type="hidden" name="price" id="price" value="<?php echo $seminar[0]['total']; ?>">
   					<div class="form-group">
   						<label for="email">Name <span style="color: red;">*</span></label>
   						<input type="text" class="form-control" id="name" name="name" placeholder="Please put your complete name for Digital Certificate" value="<?=$name?>" required>
   					</div>
   					<div class="form-group">
   						<label for="email">Email <span style="color: red;">*</span></label>
   						<input type="email" class="form-control" id="email" name="email" placeholder="mymail@ceonpoint.com" value="<?=$email?>" required>
   					</div>
   					<div class="form-group">
   						<label for="email">Profession</label>
   						<div class="selection-box">
   							<select name="profession_id" class="form-control" id="profession_id">
   								<option value="" selected="">Choose Profession</option>
   								<?php
									$profession = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category', 'status', 1);
									foreach ($profession as $key => $value) { ?>
   									<option value="<?php echo $value['id']; ?>" <?php if($institutionRow['profession'] == $value['cat_name']){ echo 'Selected';} ?> ><?php echo $value['cat_name']; ?></option>
   								<?php } ?>
   							</select>
   						</div>
   					</div>
   					<div class="form-group" id="amountfield">
   						<label for="email">Registration Fee</label>
   						<input type="number" class="form-control" readonly value="<?php echo $seminar[0]['total']; ?>">
   					</div>
   				<div class="modal-footer">
   					<button type="button" class="btn btn-primary" id="savebutton" onclick="payfortraining('<?php echo $seminar[0]['total']; ?>')">Submit</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
   			</div>
   			</form>
   		</div>
   	</div>
   </div>
  <!-- ===================================================== -->

    <div id="successModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Success Message</h4>
                </div>

                <div class="modal-body" style="height: 40vh;">
                    <p id="queryMessage"></p>
                    <div class="row"> 
                        <div class="text-center" id="successContent" style="display: none;">
                        <h4 class="text-success mb-4">
                            You have successfully created your professional account.
                        </h4>
                        <p class="text-dark mb-3">Welcome to ceonpoint.com:<br>
                            "Home of Continuing Education to <br> All Professionals worldwide."</p>
                            <p class="text-dark mb-3"><strong>Please proceed to register for the training.</strong></p>
                            <p class="text-dark mb-3"><a class="btn btn-success" href="javascript:void(0);" onclick="goToNext();">Register</a></p>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer"></div> -->
            </div>
        </div>
    </div>
<div class="modal fade" id="login_registration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="loginModalLabel">Please log in or signup to register in this training.</h5>
      </div>
      <div class="modal-body p-5">
        <div class="row">
            <div class="col sm-4">
                <p>Please log in if you already have an account at ceonpoint.com. </p>
                <a href="<?php echo BASE_URL . 'users/index?location=' . urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-primary" title="Login">Login</a>
            </div>
            <div class="vl"></div>
            <div class="col sm-8">
                <p>Please SIGN UP if you DON'T have an account at ceonpoint.com.</p>
                <p><label>What do you get when you signup at ceonpoint.com?</label>
                    <ul>
                        <li>Automatic recording of your digital certificates.</li>
                        <li>Unlimited upload and stronge of all your certificates online.</li>
                        <li>Tracking system of your required CE units for license renewal or job performance appraisel.</li>
                        <li>Access to local and international online courses and training.</li>
                        <li>Electronic reporting of digital certificate to regulatroy board (coming soon).</li>
                    </ul>
                </p>
                <a href="javascript:void(0)" onclick="signupOnPage();" title="Register on ceonpoint" class="btn btn-warning">Sign Up</a>
            </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
    <!-- ===================================================== -->

<div class="modal fade" id="signupByPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="height: 650px;overflow: scroll;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Signup as Professional</h5>
      </div>
    <?php echo form_open_multipart('javascript:void(0)', array('name' => 'prof-signup','id' => 'prof-form')); ?>      
    <div class="modal-body">
        <div class="row">
        
            <div class="col-sm-12">
                <h4 class="mb-2 bg-primary p-2 px-4">PROFESSIONAL REGISTRATION</h4>
                <span class="sign-error text-center w-100 p-3 alert alert-danger" style="display: none;"></span>
                <div class="form-group">
                    <label>Name <span class="required"> * </span></label>
                    <input name="name" id="sign-name" class="form-control" value="" size="20" type="text" required>
                </div>
            </div>
                     
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Profession <span class="required"> * </span> </label>
                    <div class="selection-box">
                        <select name="profession" id="sign-profession" class="form-control" required>
                            <option value="">Select</option>
                            <?php  $profession = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category', 'status', 1);
                                foreach ($profession as $key => $value) { ?>
                            <option value="<?php echo $value['cat_name'];?>">
                                <?php echo $value['cat_name'];?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
                  
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Nationality <span class="required"> * </span> </label>
                    <div class="selection-box">
                        <?php $this->db->order_by('countries_name','ASC');
                        $country = $this->user->get_record_by_field_name_all_record('countries','status',1); ?>
                    <select name="country_name" id="sign-country-name" class="form-control" required>
                        <option value="">Select Country</option>
                        <?php  foreach ($country as $key => $value) { ?>
                            <option value="<?php echo $value['countries_id']; ?>"><?php echo $value['countries_name']; ?></option>
                        <?php }  ?>
                    </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Name of Professional Regulatory Board/Council  <span class="required"> * </span> </label>
                    <input name="issuing_institution" id="sign-institution" class="form-control" value="" size="20" type="text" required>
                   
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Issuing Country <span class="required"> * </span> </label>
                    <div class="selection-box">
                        <select name="location" id="sign-issuing-country" class="form-control" required>
                            <option value="">Select Country</option>
                            <?php foreach ($country as $key => $value) { ?>
                                 <option value="<?php echo $value['countries_id']; ?>"><?php echo $value['countries_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Issuing State </label>
                    <div class="selection-box">
                         <input type="text" name="state" id="sign-state" class="
                         form-control">
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="exampleInputFile">Upload Photo</label>
                    <input type="file" id="exampleInputFile" class="btn btn-primary" name="photo">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Username (email)<span class="required"> * </span> </label>
                    <input name="username" id="sign-username" class="form-control" value="" size="20" type="text" required>
                </div>
            </div>
                    
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Password <span class="required"> * </span> </label>
                    <input name="password" id="sign-password" class="form-control" value="" size="20" type="password" required>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Confirm Password <span class="required"> * </span> </label>
                    <input name="con_password" id="sign-conf-password" class="form-control" value="" size="20" type="password" required>
                </div>
            </div>

        </div>
    </div>
      <div class="modal-footer">
        <!-- <button type="button" onclick="get_form_data()" class="btn btn-primary">Register</button> -->
        <button type="button" onclick="validate_data()" class="btn btn-primary">Register</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
    
      <div id="alertForRegistration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ceonpoint Says:</h4>
                </div>
                <div class="modal-body"> 
                    <p>Please Log in or Sign up as a <b> Professional </b> to register in the training.</p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" onclick="close_alert_modal()" data-toggle="modal" data-target="#training_registration" title="Register on Training" class="btn btn-primary" >Register Now</a> 
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>                    
                </div>
            </div>
        </div>
    </div>
<!-- ===================================================== -->
    <form action="<?php echo PAYAPAL_URL; ?>" method="post" name="bookTraining" id="bookTraining">
        <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" id="item_name" value="<?php echo $training[0]['title'].' - Training Booked'; ?>">
        <input type="hidden" name="item_number" value="<?php echo $tid; ?>">
        <input type="hidden" name="credits" value="510">
        <input type="hidden" name="userid" value="<?php echo $user_id; ?>">
        <input type="hidden" name="custom" value="<?php echo $user_id.'_'.$taxAmount; ?>"> <!-- uid + tax -->
        <input type="hidden" name="amount" id="amount" value="<?php echo $training[0]['total']; ?>">
        <input type='hidden' name='rm' value='2'>
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="handling" value="0">
        <!-- <input type="hidden" name="bn" id="nameEmailPros" value=""> -->
        <input type="hidden" name="cancel_return" value="<?php echo site_url('pages/cancel_training_book/').$tid; ?>">
        <input type="hidden" name="return" value="<?php echo site_url('pages/success_training_book/').$tid; ?>">
    </form>
<!-- ===================================================== -->

 <?php $is_login =  $this->session->userdata('logged_in');
         $role = $this->session->userdata('logged_in')['role'];?>
   <script type="text/javascript">

      function openpopup(idd) {
         // $.noConflict();
      if('<?=$is_login ?>'){
         if('<?=$role ?>'== 1){
            $('#type').val(idd);
            $("#training_registration").modal();
             var ttype = '<?php echo $training[0]['training_type']; ?>';
            // alert(idd +'-'+ttype);
            if (idd != 0 && ttype == 1) {
               $('#amountfield').show();
               $('#savebutton').html('Pay Now!');
               $('#trainig_type').val('Online');
               var name = $('#name').val();
               var email = $('#email').val();
               var profession_id = $('#profession_id').val();
               $('#nameEmailPros').val(name+'_'+email+'_'+profession_id+'_'+ttype);
            }else{
               $('#amountfield').hide();
               $('#savebutton').html('Register Now!');
               $('#trainig_type').val('Ofline');
            }
         }else{
            alert('Please log in as a professional to register in this training!');
         }
      }else{
          $("#login_registration").modal('show');
             // var r = confirm('Please logged in first!');
             // if (r == true) {
             //     window.location.href = "<?php echo BASE_URL; ?>users";
             // }
         }
      }

      function payfortraining(total) {
          var ttype = '<?php echo $training[0]['training_type']; ?>';

         if(total > 0 && ttype == 1){
            $('#bookTraining').submit(); //Paypal Payment
         }else{
            $('#bookseminar').submit(); //Free
         }
      }

      function close_alert_modal(){
        $('#alertForRegistration').modal('hide');
      }

      
        function signupOnPage(){
            $("#signupByPopup").modal('show');
            $("#login_registration").modal('hide');
            
        }

        function get_form_data(){
            var frm = $('#prof-form');
            var formData = new FormData(frm[0]);
            formData.append('file', $('input[type=file]')[0].files[0]);
          
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>pages/professional_signup",
                data: formData,
                processData: false,
                contentType: false,
            }).done(function(result) {
                // alert(result);
                if(result!=''){
                    var obj = JSON.parse(result);
                        console.log(obj);
                    if(obj.success==true){
                        $('#successContent').show();
                        $("#signupByPopup").modal('hide');
                    }else{
                        $('#queryMessage').html(obj.message).css('color','red');
                    }   
                    $('#successModal').modal('show');
                }
            });
        }

        function goToNext(){
            sessionStorage.reloadAfterPageLoad = true;
            window.location.reload();
        } 

        $( function () {
            if ( sessionStorage.reloadAfterPageLoad ) {
                openpopup('<?php echo $training[0]['total']; ?>');
                sessionStorage.reloadAfterPageLoad = false;
            }
        });

        function validate_data(){
            var name       = $('#sign-name').val();
            var profession  = $('#sign-profession').val();
            var country     = $('#sign-country-name').val();
            var institute   = $('#sign-institution').val();
            var i_country   = $('#sign-issuing-country').val();
            var username    = $('#sign-username').val();
            var password    = $('#sign-password').val();
            var confpassword = $('#sign-conf-password').val();
            
            if(name==''){
              $('.sign-error').css('display','block').html('Name can\'t be blank!');
              return false;
            }else if(profession==''){
              $('.sign-error').css('display','block').html('Profession can\'t be blank!');
              return false;
            }else if(country==''){
              $('.sign-error').css('display','block').html('Country can\'t be blank!');
              return false;
            }else if(institute==''){
              $('.sign-error').css('display','block').html('Institution can\'t be blank!');
              return false;
            }else if(i_country==''){
              $('.sign-error').css('display','block').html('Issuing Country can\'t be blank!');
              return false;
            }else if(username==''){
              $('.sign-error').css('display','block').html('Username can\'t be blank!');
              return false;
            }else if(password==''){
              $('.sign-error').css('display','block').html('Password can\'t be blank!');
              return false;
            }else if(confpassword==''){
              $('.sign-error').css('display','block').html('Confirm Password can\'t be blank!');
              return false;
            }else{
              get_form_data();
              return true;
            }
        }
   </script>

<style type="text/css">
	.training-btn-text {
		margin-bottom: 30px;
	}
	.training-btn-text h3.border-title {
		display: inline-block;
		padding: 0;
		margin: 0;
	}
	.training-btn-text p {
		margin-top: 10px;
		margin-bottom: 0;
		font-size: 15px;
		font-weight: 500;
		letter-spacing: 0.5px;
	}
	.training-btn {
		display: inline-block;
		float: right;
	}
  .required{
    color: red;
  }
</style>