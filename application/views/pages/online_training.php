<?php $this->load->view('template/search'); ?>
<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" id="amount">
    <input type="hidden" name="tax" value="10">
    <!--     <input type="hidden" name="cpp_header_image" value="https://www.phpgang.com/wp-content/uploads/gang.jpg"> -->
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="http://demo.phpgang.com/payment_with_paypal/cancel.php">
    <input type="hidden" name="return" value="<?php echo site_url()?>/pages/success">
    <!--  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"> -->
</form>
 
<!-- end html banner -->
<div class="innerContent">
    <div class="container">
        <div class="row">

             <!-- New thumb slider Html Start 28.12.2018 -->
             <div class="col-md-12">
                 <div class="thumbSliders">
                    <div class="owl-carousel-thumslider">
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog15-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog16-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog17-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog17-420x295.jpg" alt=""></div>
                    </div>
                </div>
            </div>
            <!-- New thumb slider Html Start 28.12.2018 -->

            <!-- New html btn-strip -->
                 <div class="col-md-12">
                <div class="panel panel-default btn-strip">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="or-text">or</div>
                            <div class="col-md-6">
                                <a href="<?php echo site_url('pages/courselist'); ?>" class="btn onlinecourse">Online Ce Courses</a>
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo site_url('pages/traininglist'); ?>" class="btn btn-primary ">Trainings/conventions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end html btn-strip -->

            <div class="col-md-8">
                <h3 class="border-title text-left">Latest Training/Conventions</h3>
                <div id="products" class="row view-group">
                    <?php 

                //for ($i=0; $i<10; $i++) { 

                foreach ($allcourse as $key => $value) {

                $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();

                $Lessons = $this->db->get_where('tbl_lesson',array('course_id'=>$value['id']))->result_array();

                ?>
                    <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="course-item">
                            <div class="course-double">
                                <?php if ($value['course_photo']) { ?>
                                <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>" class="course-image"><img src="<?php echo ASSETS_URL?>images/uploads/<?php echo $value['course_photo'];?>" alt=""><!-- <span class="badge-featured red">Featured</span> --></a>
                                <?php } else { ?>
                                    <img src="<?php echo ASSETS_URL?>images/dummy-profile.jpg" alt="">
                                <?php } ?>
                                <div class="dt-sc-course-details">
                                    <!-- <div class="course-price">$50</div> -->
                                    <div class="course-price" style="font-size: 18px;">$<?php echo $value['price'];?></div>
                                    <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['course_title'];?></a></h5>

                                    <div class="clear-line"></div>
                                    <p>By :
                                        <?php echo $providername['name'];?>
                                    </p>
                                    <ul class="course-meta">
                                        <li><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>">Law</a></li>
                                        <li>
                                            <?php echo count($Lessons);?> Lessons</li>
                                        <!-- <li>By <?php echo $value['prof_name'];?>
                                        </li> -->
                                    </ul>
                                    <div class="course-data">
                                        <div class="course-duration"><i class="fa fa-list-ol"> </i> CPD Unit
                                            <?php echo $value['units'];?>
                                        </div>
                                        <div class="post-ratings">
                                            <?php 
                                            for ($i=1; $i <= $value['rating']; $i++) { 
                                            ?>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php  
                                            }
                                            
                                            for ($j=1; $j <= 5-$value['rating']; $j++) { 
                                            ?>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <?php 
                                            }
                                            ?>

<!-- 
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
 -->
                                        </div>
                                    </div>
                                    <div class="price-btn">
                                        <?php 
                                         if($this->session->userdata('logged_in')['id']==""){
                                            ?>
                                        <a href="<?php echo site_url('users');?>">
                                            <input type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW">
                                        </a>
                                        <?php 
                                         } else {
                                        ?>
                                        <input onclick="paynow('<?php echo $value['id']; ?>','<?php echo $value['price']; ?>')" type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW">
                                        <?php 
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php  $this->load->view('pages/sidebar'); ?>
        </div>
    </div>
</div>


<script type="text/javascript">
function paynow(id, amount) {



    $('#item_name').val(id);

    $('#amount').val(amount);

    document.getElementById("frmPayPal1").submit();

}
</script>