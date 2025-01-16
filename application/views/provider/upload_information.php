<?php $this->load->view('template/picture_provider'); 
    $uid = $this->session->userdata('logged_in')['id'];
    $counrty = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['country'];
    $tax = $this->db->get_where('countries',array('countries_id'=>$counrty,'tax >'=>0))->row_array()['tax']; 
    if($tax){ $taxrate = $tax; }else{ $taxrate = 7; } //default taxrate ?>
<div class="innerContent">
    <div class="container">
        <div class="row">

            <?php 
                $_SESSION['service_type'] = 'paid';
                $training_types = $this->session->userdata('training_types');
            ?>
            <div class="col-sm-12">
               
                   <div class="pull-right">
                    <?php if($training_types=="pro"){ ?>
                        <a href="#"><input type="button" name="free" id="free" value="PROFESSIONAL VERSION" class="btn-danger"></a>
                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-primary"></a>
                    <?php }else{ ?>
                        <a href="#"><input type="button" name="free" id="free" value="FREE VERSION" class="btn-primary"></a>
                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-success"> </a>
                    <?php } ?>
                    </div>
                     <h3 class="border-title text-left pull-left">Upload Training/Seminar</h3>
                <div class="step-wise-query provider-overview">
                    <?php $this->load->view('provider/training_menu'); ?>
                    <div class="tab-content steps-detail">
                        <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                        <div id="step1" class="tab-pane fade in active">
            <?php $t_type = $this->session->userdata('training_types'); 
                      $totsubs = 0;
                foreach ($purchase_plan as $key => $value) {
                    $totsubs = $totsubs+$value['no_of_subscription'];
                }
                if($t_type == 'free'){
                    //$condition =count($training) <= 2 || $totsubs>2;
                    $condition = 1;
                }else{
                    $condition = 1;
                }

                if($condition){ ?>
                            <form action="<?php echo site_url('provider/upload_information');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="row">

                                    <?php echo $this->session->flashdata('response');?>

                                        <div class="col-sm-12 form-group">
                                        <label>Title <sup>*</sup></label>
                                        <input type="text" required class="form-control" name="titles" id="titles" value="<?php echo set_value('titles'); ?>">
                                        <span class="error"><?php echo  form_error('titles'); ?></span>
                                    </div>


                                      <div class="col-sm-12 form-group">
                                        <label>Sub Title</label>
                                        <input type="text" class="form-control" name="sub_title" id="sub_title" value="<?php echo set_value('sub_title'); ?>">
                                        <span class="error"><?php echo  form_error('sub_title'); ?></span>
                                    </div>


                                    <div class="col-sm-6 form-group">
                                        <label>Category <sup>*</sup></label>
                                        <select class="form-control" required name="category" id="category">
                                        <?php foreach ($cat as $key => $value) { ?>
                                            <option value="<?php echo $value['id'];?>"> <?php echo $value['cat_name'];?> </option>
                                        <?php } ?>
                                        </select>
                                        <span class="error"><?php echo  form_error('category'); ?></span>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label title="Number of seats available for participants.">Registration Limit<sup>*</sup></label>
                                        <input type="text" required class="form-control" name="registration_limit" id="registration_limit" value="<?php echo set_value('registration_limit'); ?>">
                                        <span class="error"><?php echo  form_error('registration_limit'); ?></span>
                                    </div>
                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Start Date <sup>*</sup></label>
                                        <input type="date" class="form-control" required name="start_date" id="start_date" value="<?php echo set_value('start_date'); ?>">
                                        <span class="error"><?php echo  form_error('start_date'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>End Date <sup>*</sup></label>
                                        <input type="date" class="form-control" required name="end_date" id="end_date" value="<?php echo set_value('end_date'); ?>">
                                        <span class="error"><?php echo  form_error('end_date'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Start Time <sup>*</sup></label>
                                        <input type="time" class="form-control" required name="start_time" id="start_time" value="<?php echo set_value('start_time'); ?>">
                                        <span class="error"><?php echo  form_error('start_time'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>End Time <sup>*</sup></label>
                                        <input type="time" class="form-control" required name="end_time" id="end_time" value="<?php echo set_value('end_time'); ?>">
                                        <span class="error"><?php echo  form_error('end_time'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Units <sup>*</sup></label>
                                        <input type="text" class="form-control" required name="units" id="units" value="<?php echo set_value('units'); ?>">
                                        <span class="error"><?php echo  form_error('units'); ?></span>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Virtual classroom link (Zoom, Google Meet,etc. ) </label>
                                        <input type="text" class="form-control" name="add_link" id="add_link" value="<?php echo set_value('add_link'); ?>" placeholder="Please add Zoom / Google Meet Link">
                                        <span class="error"><?php echo  form_error('add_link'); ?></span>
                                    </div>
                                    
                                    <div class="col-sm-12 form-group">
                                        <label>Location <sup>*</sup></label>
                                        <input type="text" class="form-control" required name="location" id="location" value="<?php echo set_value('location'); ?>" placeholder="Please enter the address here">
                                        <span class="error"><?php echo  form_error('location'); ?></span>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>Training Image <sup>*</sup></label>
                                        <input type="file" class="form-control" name="image" id="image" value="<?php echo set_value('image'); ?>">
                                        <span class="error"><?php echo  form_error('image'); ?></span>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>Thumbnail Image<sup>*</sup></label>
                                        <input type="file" class="form-control" name="thumb_img" id="thumb_img" value="<?php echo set_value('thumb_img'); ?>">
                                        <span class="error"><?php echo  form_error('thumb_img'); ?></span>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>Photo of Venue <sup>*</sup></label>
                                        <input type="file" class="form-control" name="venue_photo" id="venue_photo" value="<?php echo set_value('venue_photo'); ?>">
                                        <span class="error"><?php echo  form_error('venue_photo'); ?></span>
                                    </div>
                                   
                                    <div class="col-sm-12 form-group">
                                        <label>Venue Address<sup>*</sup></label> 
                                        <textarea class="form-control text_editor" id="venu_address" rows="15" name="venu_address"><?php echo set_value('venu_address'); ?></textarea> 
                                        <span class="error"><?php echo  form_error('venu_address'); ?></span>
                                    </div>

                                    <?php if($t_type != 'free'){ ?>
                                     <div class="col-sm-6 form-group">
                                        <label>Attached Background Photo <sup>*</sup></label>
                                        <input type="file" class="form-control" name="bannerimage" id="bannerimage">
                                        <span class="error"><?php echo  form_error('bannerimage'); ?></span>
                                    </div>


                                    <div class="col-sm-6 form-group">
                                        <label> Attached Promo Video (Only youtube video is allowed. Please send us your video at team@ceonpoint.com and we will upload it to ceonpoint youtube account for you. Contact Us if you need Promotional video for your training.)</label>
                                        <!-- <input type="file" class="form-control" name="video" id="video"> -->
                                        <input type="url" class="form-control" name="video" id="video" placeholder="Only youtube video URL is allowed." value="<?php echo $trainig_data[0]['video']; ?>"><span class="error"><?php echo  form_error('video'); ?></span>
                                    </div>
                                    <?php } ?>



                                    <div class="col-sm-12 form-group"> 
                                        <input type="hidden" class="form-control" name="speaker" id="speaker" value="speaker">
                                        <span class="error"><?php echo  form_error('speaker'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Registration Fee</label>
                                        <input type="text" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>" placeholder="10.00">
                                        <span class="error" id="tax-error"><?php echo  form_error('price'); ?></span>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>Tax (%)<sup>*</sup></label>
                                        <input type="number" class="form-control" name="tax" id="tax" value="<?php echo $taxrate; ?>" readonly>
                                       
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label> Price + Tax(%) </label>
                                        <button type="button" class="form-control btn btn-primary" onclick="taxcalculation()">Calcualte Tax</button>
                                    </div>
                                    <div class="col-sm-12 form-group" id="taxcal" style="display: none;">
                                        <label>Price with Tax<sup>*</sup></label>
                                        <input type="number" class="form-control" name="total" id="total" value="" readonly>
                                    </div>


                                    <div class="col-sm-12 form-group">
                                        <label>Host Name <sup>*</sup></label>
                                        <input type="text" class="form-control" required name="host" id="host" value="<?php echo set_value('host'); ?>">
                                        <span class="error"><?php echo  form_error('host'); ?></span>
                                    </div>  



                                    <?php if($t_type != 'free'){ ?>
                                    <div class="col-sm-12 form-group">
                                        <label>About Host <sup>*</sup></label>
                                       <textarea class="form-control text_editor" id="about_host" rows="15" name="about_host"><?php echo set_value('about_host'); ?></textarea> 
                                    <span class="error"><?php echo form_error('about_host'); ?></span>
                                    </div>


                                    <div class="col-sm-12 form-group">
                                        <label>Attach Logo <sup>*</sup></label>
                                       <input type="file" class="form-control" name="attach_logo" id="attach_logo" required> 
                                        <span class="error"><?php echo  form_error('attach_logo'); ?></span>
                                    </div>
                                    <?php } ?>

                                    <div class="col-sm-12 form-group">
                                        <label>Contact Person <sup>*</sup></label>
                                        <input type="text" class="form-control" required name="c_person" id="c_person" value="<?php echo set_value('c_person'); ?>">
                                        <span class="error"><?php echo  form_error('c_person'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Email <sup>*</sup></label>
                                        <input type="text" class="form-control" required name="email" id="email" value="<?php echo set_value('email'); ?>">
                                        <span class="error"><?php echo  form_error('email'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Phone Number <sup>*</sup></label>
                                        <input type="text" class="form-control" required name="phone" id="phone" value="<?php echo set_value('phone'); ?>">
                                        <span class="error"><?php echo  form_error('phone'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>CP Number <sup>*</sup></label>
                                        <input type="text" class="form-control" required name="cp_number" id="cp_number" value="<?php echo set_value('cp_number'); ?>">
                                        <span class="error"><?php echo  form_error('cp_number'); ?></span>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Name of (Training committee Chairman)<sup>*</sup></label>
                                        <input type="text" required class="form-control" name="chairman" id="chairman" value="<?php echo set_value('chairman'); ?>">
                                        <span class="error"><?php echo  form_error('chairman'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Position<sup>*</sup></label>
                                        <input type="text" required class="form-control" name="position" id="position" value="<?php echo set_value('position'); ?>">
                                        <span class="error"><?php echo  form_error('position'); ?></span>
                                    </div>

                                    
                                    <!-- Accriditation details  -->
                                    <div class="col-sm-6 form-group">
                                        <label for="accreditation_no">Accreditation Number</label>
                                        <input type="text" class="form-control" name="accreditation_no" id="accreditation_no" value="" readonly>
                                        <span class="error"><?php echo  form_error('accreditation_no'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="accreditation_validity">Accreditation Validity</label>
                                        <input type="text" class="form-control" name="accreditation_validity" id="accreditation_validity" value="" readonly>
                                        <span class="error"><?php echo  form_error('accreditation_validity'); ?></span>
                                    </div>

                                    <div class="col-sm-2 form-group">
                                        <input type="submit" class="btn btn-primary btn-lg" value="Save & Next">
                                    </div>
                                </div>
                            </form>
                            <?php 
				 } else {
				 	?>
                            <p>You have already created two seminars.Please purchase subscription now.<br><br>
                                <input type="button" name="paynow" class="btn" value="PAY NOW" data-toggle="modal" data-target="#myModal">
                            </p>
                            <?php 
				 }
 				?>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
</div>

 <script>
    $(document).ready(function() {
        $("#price").blur(function() {
            alert('Please click the Calculate Tax button.');
        });
    });

    function taxcalculation(){
        var price   = $('#price').val();
        if(price==''){
            $('#tax-error').html('Please fill Registration Fee!').css('color','red');
        }else{
            var tax     = $('#tax').val();
            var taxrate  = ((price * tax)/100).toFixed(2);
            var total  =  parseFloat(price) +  parseFloat(taxrate);
            $('#total').val(total);
            $('#taxcal').show();
        }
    }
 </script>