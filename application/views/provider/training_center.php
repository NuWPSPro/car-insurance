<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
          <!--   <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
                <?php 
                $this->load->view('provider/sidebar');
                ?>
            <div class="col-sm-9">
                <!-- new html code -->
                <div class="clearfix">
					<h3 class="border-title float-left">Update Training/Seminar</h3> 
					<a href="<?php echo base_url('provider/training_center_list'); ?>" class="btn btn-primary float-right">Back</a>
				</div>
                <div class="step-wise-query provider-overview newcertificate">
                    <div class="tab-content steps-detail">
                        <table class="table table-striped table-bordered version" style="width:100%">
                            <thead>
                            <tr>
                                <th class="bg-warning text-white text-center">FREE VERSION<br>NO FEE</th>
                                <th class="bg-danger text-white text-center">PROESSIONAL VERSION<br>$100.00</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <ul>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Registration</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Payment</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Evalution</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Social Media Share</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Digital Certificate (max 100)</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Website Layout</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Ready Traning Report</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Sponsor Section</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Committee Section</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Date and Time Countdown</li>
                                        </ul>
                                        
                                    </td>
                                    
                                    <td>
                                        <ul>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Registration</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Payment</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Evalution</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Social Media Share</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Digital Certificate (max 100)</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Website Layout</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Ready Traning Report</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Sponsor Section</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Committee Section</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Date and Time Countdown</li>
                                        </ul>
                                        
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="text-center"><a href="#"><input type="button" name="free" id="free" value="View" class="btn-info"></a></td>
                                    <td class="text-center"><a href="#"><input type="button" name="free" id="free" value="View" class="btn-info"></a></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a href="#"><input type="button" name="free" id="free" value="SELECT FREE VERSION" class="btn-primary "></a></td>
                                    <td class="text-center"><a href="#"><input type="button" name="free" id="free" value="SELECT PRO VERSION" class="btn-danger "></a></td>
                                </tr>
                            </tbody>    
                        </table>
                    </div>
                </div>

                <!-- new html code Choose Template-->
                <div class="step-wise-query provider-overview newcertificate">
                    <ul class="nav-tabs hidden-xs">
                        <li class="active"><a href="#">Choose Template</a></li>
                        <li class=""><a href="#">Choose Certificate</a></li>
                        <li class=""><a href="#">Upload Informations</a></li>
                    </ul> 
                    <div class="tab-content steps-detail">
                        
                        <form method="post" action="#" enctype="multipart/form-data" name="speakerform" id="speakerform">
                            <div class="form-group templatechoose">
                                                
                                <h4 for="exampleInputEmail1">Click Template to Choose</h4>
                                <span style="color: red;"></span>
                                <section>
                                    <div>
                                        <input type="radio" id="control_01" name="select" value="1">
                                        <label for="control_01">
                                            <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template1.jpg" alt="">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div>
                                    <div>
                                        <input type="radio" id="control_02" name="select" value="2">
                                        <label for="control_02">
                                            <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template2.jpg" alt="">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div>
                                    <div>
                                        <input type="radio" id="control_03" name="select" value="3">
                                        <label for="control_03">
                                            <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template3.jpg" alt="">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div>
                                </section>
                                
                            
                            </div>
                            <button type="submit" class="btn btn-primary">Save & Next</button>
                        </form>
                      
                    </div>    
                </div>

                <!-- new html code Choose Certificate-->
                <div class="step-wise-query provider-overview newcertificate">
                    <ul class="nav-tabs hidden-xs">
                        <li><a href="#">Choose Template</a></li>
                        <li class="active"><a href="#">Choose Certificate</a></li>
                        <li class=""><a href="#">Upload Informations</a></li>
                    </ul> 
                    <div class="tab-content steps-detail">
                        <div class="template-select mb-5">
                            <h4 for="exampleInputEmail1">Click Template to Choose</h4>
                            <label for="planchange1">
                            <input type="radio" name="planchange" id="planchange1" onchange="planchange('1')">
                            <img src="http://ceonpoint.com//assets/templates/template1/certificate.jpg" style="width: 100px;">
                            <i class="fa fa-check"></i>
                            </label>
                                            <label for="planchange2">
                            <input type="radio" name="planchange" id="planchange2" onchange="planchange('2')">
                            <img src="http://ceonpoint.com//assets/templates/template2/certificate.jpg" style="width: 117px;">
                            <i class="fa fa-check"></i>
                            </label>
                                            <label for="planchange3">
                            <input type="radio" name="planchange" id="planchange3" onchange="planchange('3')" checked="">
                            <img src="http://ceonpoint.com//assets/templates/template3/certificate.jpg" style="width: 117px;">
                            <i class="fa fa-check"></i>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Save &amp; Next</button>
                        
                      
                    </div>    
                </div>


                <!-- new html code Upload Informations-->
                <div class="step-wise-query provider-overview newcertificate">
                    <ul class="nav-tabs hidden-xs">
                        <li><a href="#">Choose Template</a></li>
                        <li><a href="#">Choose Certificate</a></li>
                        <li class="active"><a href="#">Upload Informations</a></li>
                    </ul> 
                    <div class="tab-content steps-detail">
                    <table class="table table-bordered" style="width:100%">
                        <tr>
                            <td style="padding: 0; background: #eee;">
                                <ul class="navlist newpanel">
                                    <li class="active"><a href="#">General Information</a></li>
                                    <li ><a href="#">Overview</a></li>
                                    <li ><a href="#">Speakers</a></li>
                                    <li ><a href="#">Schedule</a></li>
                                    <li ><a href="#">Evaluation</a></li>
                                    <li ><a href="#">Sponsor</a></li>
                                    <li ><a href="#">Committee</a></li>
                                    <li ><a href="#">Promotion</a></li>
                                    <li ><a href="#">Publish</a></li>
                                </ul>
                            </td>
                            <td>
                                <div class="newpanelRyt">
                                    <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template1.jpg">
                                </div>
                            </td>
                        </tr>
                    
                        
                    </table> 
                    </div> 
                </div>




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

                            

                            <?php 

				$totsubs = 0;
				foreach ($purchase_plan as $key => $value) {
					$totsubs = $totsubs+$value['no_of_subscription'];
				}
				

				if(count($training) <= 2 || $totsubs>2){
				?>
                            <form action="<?php echo site_url();?>/provider/training_center" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="row">
                                    <?php echo $this->session->flashdata('response');?>
                                    <div class="col-sm-12 form-group">
                                        <label>Category <sup>*</sup></label>
                                        <select class="form-control" name="category" id="category">
                                            <?php 
							foreach ($cat as $key => $value) {
							?>
                                            <option value="<?php echo $value['id'];?>">
                                                <?php echo $value['cat_name'];?>
                                            </option>
                                            <?php 
							}
							?>
                                        </select>
                                        <span class="error"><?php echo  form_error('category'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Start Date <sup>*</sup></label>
                                        <input type="text" class="form-control datepicker" name="start_date" id="start_date" value="<?php echo set_value('start_date'); ?>">
                                        <span class="error"><?php echo  form_error('start_date'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>End Date <sup>*</sup></label>
                                        <input type="text" class="form-control datepicker" name="end_date" id="end_date" value="<?php echo set_value('end_date'); ?>">
                                        <span class="error"><?php echo  form_error('end_date'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Start Time <sup>*</sup></label>
                                        <input type="time" class="form-control" name="start_time" id="start_time" value="<?php echo set_value('start_time'); ?>">
                                        <span class="error"><?php echo  form_error('start_time'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>End Time <sup>*</sup></label>
                                        <input type="time" class="form-control" name="end_time" id="end_time" value="<?php echo set_value('end_time'); ?>">
                                        <span class="error"><?php echo  form_error('end_time'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Units <sup>*</sup></label>
                                        <input type="text" class="form-control" name="units" id="units" value="<?php echo set_value('units'); ?>">
                                        <span class="error"><?php echo  form_error('units'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Location <sup>*</sup></label>
                                        <input type="text" class="form-control" name="location" id="location" value="<?php echo set_value('location'); ?>">
                                        <span class="error"><?php echo  form_error('location'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Speaker <sup>*</sup></label>
                                        <input type="text" class="form-control" name="speaker" id="speaker" value="<?php echo set_value('speaker'); ?>">
                                        <span class="error"><?php echo  form_error('speaker'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Ticket Price <sup>*</sup></label>
                                        <input type="text" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>">
                                        <span class="error"><?php echo  form_error('price'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Contact Person <sup>*</sup></label>
                                        <input type="text" class="form-control" name="c_person" id="c_person" value="<?php echo set_value('c_person'); ?>">
                                        <span class="error"><?php echo  form_error('c_person'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Email <sup>*</sup></label>
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>">
                                        <span class="error"><?php echo  form_error('email'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Phone Number <sup>*</sup></label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone'); ?>">
                                        <span class="error"><?php echo  form_error('phone'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>CP Number <sup>*</sup></label>
                                        <input type="text" class="form-control" name="cp_number" id="cp_number" value="<?php echo set_value('cp_number'); ?>">
                                        <span class="error"><?php echo  form_error('cp_number'); ?></span>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input type="submit" class="btn btn-primary btn-lg" value="NEXT">
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
<script type="text/javascript">
$(document).ready(function() {
    $("body").on("click", ".add-more", function() {
        var html = $(".after-add-more").first().clone();

        //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

        $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");


        $(".after-add-more").last().after(html);



    });

    $("body").on("click", ".remove", function() {
        $(this).parents(".after-add-more").remove();
    });
});
</script>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">BUY NOW</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
                    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="item_name" id="item_name">
                    <input type="hidden" name="item_number" id="item_number">
                    <input type="hidden" name="credits" id="credits" value="510">
                    <input type="hidden" name="userid" id="userid" value="1">
                    <input type="hidden" name="amount" id="amount">
                    <!--     <input type="hidden" name="cpp_header_image" value="https://www.phpgang.com/wp-content/uploads/gang.jpg"> -->
                    <input type='hidden' name='rm' value='2'>
                    <input type="hidden" name="no_shipping" value="1">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="handling" value="0">
                    <input type="hidden" name="cancel_return" value="<?php echo site_url()?>/provider/cancel_subscription">
                    <input type="hidden" name="return" value="<?php echo site_url()?>/provider/subscription_buy">
                </form>
                <form action="<?php echo site_url();?>/provider/subscription_buy" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="row">
                        <?php echo $this->session->flashdata('response');?>
                        <div class="col-sm-12 form-group">
                            <label>Subscription <sup>*</sup></label>
                            <select name="subscription" id="subscription" class="form-control" required>
                                <?php 
	 foreach ($plan as $key => $value) {
	 	?>
                                <option value="<?php echo $value['id'].'_'.$value['plan_price'].'_'.$value['allow_number'];?>">
                                    <?php echo $value['plan_name'];?>
                                </option>
                                <?php 
	 }
	?>
                            </select>
                        </div>
                        <div class="col-sm-12 form-group">
                            <input type="button" name="buy_now" value="BUY NOW" class="btn" onclick="paynowsubs()">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function paynowsubs() {
    var subscription = $('#subscription').val();
    var myarr = subscription.split("_");
    $('#item_name').val(myarr[0]);
    $('#amount').val(myarr[1]);
    $('#item_number').val(myarr[2]);
    document.getElementById("frmPayPal1").submit();
}
</script>