<?php $this->load->view('template/picture_provider'); 
      $price = $this->db->get_where('tbl_misc',array('id'=>1))->row_array()['training_publish_price']; ?>
<div class="innerContent">
    <div class="container">
        <div class="row">

            <?php $_SESSION['service_type'] = 'paid'; ?>

        <div class="col-sm-12">

            <!-- <h3 class="border-title text-left">Upload Training/Seminar 
                <a href="<?php echo base_url('provider/training_center_list'); ?>" class="btn btn-primary pull-right">Back</a>
            </h3> -->
                   <!-- <div class="step-wise-query provider-overview newcertificate"> -->
                   <div class="step-wise-query provider-overview">
                   

                    <?php if($this->uri->segment(3)==''){
                        $this->load->view('provider/training_menu'); 
                    }else{
                        $this->load->view('provider/training_menu_edit'); 
                    } ?>

                    <div class="tab-content steps-detail">
                     <?php 
                        $tid = $this->uri->segment(3);
                        $uid = $this->session->userdata('logged_in')['id'];
                        $result = $this->db->get_where('tbl_training',array('id'=>$tid,'user_id'=>$uid))->result_array();
                        echo $this->session->flashdata('response');
                        ?> 
                        <form method="post" action="<?php echo site_url('provider/training_center_pro/').$tid; ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                            <div class="form-group templatechoose">
                                            
                                <?php if($this->uri->segment(3)!=''){ echo '<h3>Edit Template</h3>'; } ?> 
                                <h4 for="exampleInputEmail1">Click Template to Choose</h4>
                                 <span style="color: red;"><?php echo form_error('select'); ?></span>
                                <section>
                                    <div>
                                        <input type="radio" id="control_01" name="select" value="1" <?php if($result[0]['templates']==1){ echo "checked"; } ?>>
                                        <label for="control_01">
                                            <img src="<?php echo ASSETS_URL.'images/uploads/template1.jpg'; ?>" alt="template 1">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div>
                                    <div>
                                        <input type="radio" id="control_02" name="select" value="2" <?php if($result[0]['templates']==2){ echo "checked"; } ?>>
                                        <label for="control_02">
                                            <img src="<?php echo ASSETS_URL.'images/uploads/temp2-image.png'; ?>" alt="template 2">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div>
                                    <div>
                                        <input type="radio" id="control_03" name="select" value="3" <?php if($result[0]['templates']==3){ echo "checked"; } ?>>
                                        <label for="control_03">
                                            <img src="<?php echo ASSETS_URL.'images/uploads/temp3-image.png'; ?>" alt="template 3">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div>
                                    <div>
                                        <input type="radio" id="control_04" name="select" value="4" <?php if($result[0]['templates']==4){ echo "checked"; } ?>>
                                        <label for="control_04">
                                            <img src="<?php echo ASSETS_URL.'images/uploads/temp4-image.png'; ?>" alt="template 4">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div>
                                    <div>
                                        <input type="radio" id="control_06" name="select" value="5" <?php if($result[0]['templates']==5){ echo "checked"; } ?>>
                                        <label for="control_06">
                                            <img src="<?php echo ASSETS_URL.'images/uploads/temp5-image.png'; ?>" alt="template 5">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo 5</a>
                                    </div>
                                </section>
                                
                            
                            </div>
                            <button type="submit" class="btn btn-primary">Save & Next</button>
                        </form>

                            <?php if($this->session->userdata('training_types')=="pro"){ ?>
                                <div class="training-logo">
                                    <h2>What do you get from Training Pro-version ?</h2>
                                    <!-- <a class="pro-version" href="#">PRO-VERSION <span class="doler-pro"> $<?=$price?> </span></a> -->
                                        
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo14.jpeg" alt="">
                                    <span class="instant-content">instant Website  for your Training</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo13.jpeg" alt="">
                                    <span class="instant-content">Choose Website Template</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo7.jpeg" alt="">
                                    <span class="instant-content">Training Link As Digital Invitation</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo15.jpeg" alt="">
                                    <span class="instant-content">Online<br> Registration</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo12.jpeg" alt="">
                                    <span class="instant-content">Online<br> Payment</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo9.jpeg" alt="">
                                    <span class="instant-content">Training <br> Schedule</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo11.jpeg" alt="">
                                    <span class="instant-content">Training <br> Overview</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo10.jpeg" alt="">
                                    <span class="instant-content">Speaker's Profile & Lecture</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo8.jpeg" alt="">
                                    <span class="instant-content">Event Sponsor (Advertisement)</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo4.jpeg" alt="">
                                    <span class="instant-content">Digital Certificates <br> (Online Verifiable)</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo5.jpeg" alt="">
                                    <span class="instant-content">Online Evaluation <br> of Speakers & Training</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo6.jpeg" alt="">
                                    <span class="instant-content">Instant <br> Trng. Report</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo1.jpeg" alt="">
                                    <span class="instant-content">Venue <br> Section</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo3.jpeg" alt="">
                                    <span class="instant-content">The Host <br> Section</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/logo14.jpeg" alt="">
                                    <span class="instant-content">Featured <br> Listing</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/zoom.png" alt="">
                                    <span class="instant-content">Zoom</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/email.png" alt="">
                                    <span class="instant-content">Automail of Training Details <br> to Participants</span>
                                </div>
                                <div class="training-logo-box">
                                    <img src="<?php echo base_url();?>assets/images/play.png" alt="">
                                    <span class="instant-content">Upload <br>Promotional Video</span>
                                </div>
                            <?php } ?>
                    </div>    
                </div>



            </div>
        </div>
    </div>
</div>
</div>
 