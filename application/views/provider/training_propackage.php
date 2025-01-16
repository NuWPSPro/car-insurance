<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
           <!--  <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
            <?php 
		$this->load->view('provider/sidebar');
		?>
            <div class="col-sm-8">
                <h3 class="border-title text-left">Upload Training/Seminar</h3>
                <div class="step-wise-query provider-overview">
                    <?php $this->load->view('provider/training_menu'); ?>
                    <div class="tab-content steps-detail">



                        <?php 

                        if($_SESSION['service_type'] ==""){
                          $_SESSION['service_type'] = "free"; 
                        }

                        if($_REQUEST['type'] !=""){
                          $_SESSION['service_type'] = $_REQUEST['type'];
                          redirect('provider/training_propackage');
                        }
                        ?>

                                
                        <a href="<?php echo site_url('provider/training_center?type=free');?>">
                        <input type="button" name="free" id="free" value="FREE" class="btn-<?php if($_SESSION['service_type']=="free"){?>danger<?php } else {?>primary<?php } ?>">        
                        </a>
                        <a href="<?php echo site_url('provider/training_propackage?type=paid');?>">
                        <input type="button" name="free" id="free" value="UPGRADE TO PRO" class="btn-<?php if($_SESSION['service_type']=="paid"){?>danger<?php } else { ?>primary<?php } ?>">
                        </a>
                        <br><br>


                        
                        <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                        <div id="step1" class="tab-pane fade in active">
                           <!--  <ul class="nav-tabs hidden-xs">
                                <li><a href="<?php echo site_url()?>/provider/training_center">General Info</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_overview">Overview</a></li>

                                <li class="active"><a href="<?php echo site_url()?>/provider/training_speaker">Speaker</a></li>
                                
                                <li><a href="<?php echo site_url()?>/provider/training_schedule">Schedule</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_evaluation">Evaluation</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_promotion">Promotion</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_publish">Publish</a></li>
                            </ul> -->

                            

                            
                            <?php 

				$totsubs = 0;
				foreach ($purchase_plan as $key => $value) {
					$totsubs = $totsubs+$value['no_of_subscription'];
				}
				
 
				?>
                <p><h1>PRO PACKAGE $50.00</h1></p>
                <ul class="propackeg">
                    <li>1. Website Layout</li>
                    <li>2. Training Sponsors Section</li>
                    <li>3. Online Registration & Payment</li>
                    <li>4. Online Verifiable Certificate</li>
                    <li>5. Online Training Exam</li>
                    <li>6. Online Committee Members</li>
                    <li>7. Printable Training Report</li>
                </ul>
                <!-- <p>1. Website Layout</p>
                <p>2. Training Sponsors Section</p>
                <p>3. Online Registration & Payment</p>
                <p>4. Online Verifiable Certificate</p>
                <p>5. Online Training Exam</p>
                <p>6. Online Committee Members</p>
                <p>7. Printable Training Report</p> -->
		                          
				<form method="post" action="<?php echo site_url('provider/training_propackage'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
				<div class="form-group templatechoose">
					 <?php echo $this->session->flashdata('response');?>
				
                    <h4 for="exampleInputEmail1">Choose Any Template<sup>*</sup></h4>
                    <span style="color: red;"><?php echo form_error('select'); ?></span>
                    <section>
                        <div>
                            <input type="radio" id="control_01" name="select" value="1">
                            <label for="control_01">
                                <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template1.jpg" alt="">
                            </label>
                        </div>
                        <div>
                            <input type="radio" id="control_02" name="select" value="2">
                            <label for="control_02">
                                <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template2.jpg" alt="">
                            </label>
                        </div>
                        <div>
                            <input type="radio" id="control_03" name="select" value="3">
                            <label for="control_03">
                                <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template3.jpg" alt="">
                            </label>
                        </div>
                    </section>
                    
                    <!-- <div class="cc-selector-2">
                        <input id="template1" type="radio" name="template" value="template1" />
                        <label class="drinkcard-cc visa" for="template1" style="background-image:url(http://wps-dev.com/dev/mycpd/assets/images/uploads/template1.jpg);"></label>
                        <input id="template2" type="radio" name="template" value="template2" />
                        <label class="drinkcard-cc mastercard"for="template2"  style="background-image:url(http://wps-dev.com/dev/mycpd/assets/images/uploads/template2.jpg);"></label>
                        <input id="template3" type="radio" name="template" value="template3" />
                        <label class="drinkcard-cc mastercard"for="template3" style="background-image:url(http://wps-dev.com/dev/mycpd/assets/images/uploads/template3.jpg);"></label>
                    </div> -->

                    <!-- <p>1. Template 1 <input type="radio" name="template" id="template1"></p>
                    <p>1. Template 2 <input type="radio" name="template" id="template2"></p>
                    <p>1. Template 3 <input type="radio" name="template" id="template3"></p> -->
				</div>



				<button type="submit" class="btn btn-primary">Select Template</button>
				</form>

                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> 