<?php $this->load->view('template/picture');  ?>
<div class="innerContent professional-course_list">
    <div class="container">
        <div class="row">
            <?php  $this->load->view('professional/sidebar');  ?>
            <div class="col-sm-9">
                    <div class="admin-titlebox">
                        <h3 class="border-title text-left">ONLINE COURSE LISTING</h3>
                        <select name="catlist" id="catlist" class="form-control" onchange="filtercourse();">
                            <?php foreach ($category as $key => $value){ ?>
                            <option <?php if($this->uri->segment(3)==$value['id']){ echo "selected";} ?> value="<?php echo $value['id'];?>">
                            <?php echo $value['cat_name'];?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                <h4 class="border-title text-left">Latest Course List</h4>
                <hr>
                <?php if(!empty($latestcourse)){ ?>
                <div class="owl-carousel-12">
                <?php foreach ($latestcourse as $key => $value) {
                    $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
                    $Lessons = $this->db->get_where('tbl_lesson',array('course_id'=>$value['id']))->result_array();
                    $buybtn = $this->db->where(array('user_id'=>$this->session->userdata('logged_in')['id'],'item_name'=>$value['id'],'archive'=>'0'))->get('tbl_purchase_llis')->row_array(); 
                    $country = $this->db->get_where('countries',array('countries_id'=>$value['country_id']))->row_array()['countries_name'];?> 
                    <div class="course-item">
                        <div class="course-double">
                            <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>" class="course-image">
                                <img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>" alt="">
                                <?php if($value['paid_status']==2){ ?><span class="badge-featured red">Featured</span><?php } ?></a>
                            <div class="dt-sc-course-details">
                                <div class="course-price">$<?php echo floatval($value['total']); ?></div>
                                <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['course_title'];?></a></h5>
                                <div class="clear-line"></div>
                                <p>By : <?php echo $providername['name'];?><br>
                                    Country :  <?php echo $country;?></p>
                                <ul class="course-meta">
                                    <li><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['cat_name']; ?></a></li>
                                    <li><?php echo count($Lessons);?> Lessons</li>
                                    <!-- <li>By <?php echo $value['prof_name'];?></li> -->
                                </ul>
                                <div class="course-data">
                                    <div class="course-duration"><i class="fa fa-list-ol"> </i> CPD Unit <?php echo $value['units'];?></div>
                                    <div class="post-ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="price-btn">
                                <?php if($this->session->userdata('logged_in')['id']==""){  ?>
                                    <a href="<?php echo site_url('users');?>"><input type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW"></a>
                                <?php }else{ 
                                    if($buybtn > 0){ ?>
                                        <a href="<?php echo base_url('pages/course_details/').$value['id']; ?>" class="btn btn-success col-xs-12">Purchased </a>
                                    <?php }else{ ?>
                                        <input onclick="paynow('<?php echo $value['id']; ?>','<?php echo floatval($value['total']); ?>')" type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW">
                                    <?php } ?>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <?php } else{ echo'<div class="alert alert-info">No records found with your profession.</div>'; } ?> 


                        <h4 class="border-title text-left">Featured Courses</h4>
                        <hr>
                <?php if(!empty($featured)){ ?>
                <div class="owl-carousel-12">
                <?php foreach ($featured as $key => $value) {
                    $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
                    $Lessons = $this->db->get_where('tbl_lesson',array('course_id'=>$value['id']))->result_array();
                    $buybtn = $this->db->where(array('user_id'=>$this->session->userdata('logged_in')['id'],'item_name'=>$value['id'],'archive'=>'0'))->get('tbl_purchase_llis')->row_array(); 
                    $country = $this->db->get_where('countries',array('countries_id'=>$value['country_id']))->row_array()['countries_name'];?> 

                    <div class="course-item">
                        <div class="course-double">
                            <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>" class="course-image">
                                <img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>" alt=""><span class="badge-featured red">Featured</span></a>
                            <div class="dt-sc-course-details">
                                <div class="course-price">$<?php echo floatval($value['total']); ?></div>
                                <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['course_title'];?></a></h5>
                                <div class="clear-line"></div>
                                <p>By : <?php echo $providername['name'];?><br>
                                    Country :  <?php echo $country;?></p>
                                <ul class="course-meta">
                                    <li><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['cat_name']; ?></a></li>
                                    <li><?php echo count($Lessons);?> Lessons</li>
                                    <!-- <li>By <?php echo $value['prof_name'];?></li> -->
                                </ul>
                                <div class="course-data">
                                    <div class="course-duration"><i class="fa fa-list-ol"> </i> CPD Unit <?php echo $value['units'];?></div>
                                    <div class="post-ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="price-btn">
                                <?php if($this->session->userdata('logged_in')['id']==""){  ?>
                                    <a href="<?php echo site_url('users');?>"><input type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW"></a>
                                <?php }else{ 
                                    if($buybtn > 0){ ?>
                                        <a href="<?php echo base_url('pages/course_details/').$value['id']; ?>" class="btn btn-success col-xs-12">Purchased </a>
                                    <?php }else{ ?>
                                        <input onclick="paynow('<?php echo $value['id']; ?>','<?php echo floatval($value['total']); ?>')" type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW">
                                    <?php } ?>
                                <?php }  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?> 
                </div>
                <?php } else{ echo'<div class="alert alert-info">No records found with your profession.</div>'; } ?>   

                        <h4 class="border-title text-left">Regular List</h4>
                        <hr>
                <?php if(!empty($freecourse)){ ?>
                <div class="owl-carousel-12">   
                <?php foreach ($freecourse as $key => $value) {
                    $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
                    $Lessons = $this->db->get_where('tbl_lesson',array('course_id'=>$value['id']))->result_array(); 
                    $buybtn = $this->db->where(array('user_id'=>$this->session->userdata('logged_in')['id'],'item_name'=>$value['id'],'archive'=>'0'))->get('tbl_purchase_llis')->row_array(); 
                    $country = $this->db->get_where('countries',array('countries_id'=>$value['country_id']))->row_array()['countries_name'];?> 

                    <div class="course-item">
                        <div class="course-double">
                            <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>" class="course-image">
                                <img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>" alt=""></a>
                            <div class="dt-sc-course-details">
                                <div class="course-price">$<?php echo floatval($value['total']); ?></div>
                                <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['course_title'];?></a></h5>
                                <div class="clear-line"></div>
                                <p>By : <?php echo $providername['name'];?><br>
                                    Country :  <?php echo $country;?></p>
                                <ul class="course-meta">
                                    <li><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['cat_name']; ?></a></li>
                                    <li><?php echo count($Lessons);?> Lessons</li>
                                    <!-- <li>By <?php echo $value['prof_name'];?></li> -->
                                </ul>
                                <div class="course-data">
                                    <div class="course-duration"><i class="fa fa-list-ol"> </i> CPD Unit <?php echo $value['units'];?></div>
                                    <div class="post-ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="price-btn">
                                <?php if($this->session->userdata('logged_in')['id']==""){  ?>
                                    <a href="<?php echo site_url('users');?>"><input type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW"></a>
                                <?php }else{ 
                                    if($buybtn > 0){ ?>
                                        <a href="<?php echo base_url('pages/course_details/').$value['id']; ?>" class="btn btn-success col-xs-12">Purchased </a>
                                    <?php }else{ ?>
                                        <input onclick="paynow('<?php echo $value['id']; ?>','<?php echo floatval($value['total']); ?>')" type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW">
                                    <?php } ?>
                                <?php }  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <?php } else{ echo'<div class="alert alert-info">No records found with your profession.</div>'; } ?> 

            </div> 
        </div>
    </div>
</div>
<a href="#" id="scroll" style="display: inline;"><span></span></a>
 
 
 <?php $is_login =  $this->session->userdata('logged_in'); ?>
 
<script type="text/javascript">
    function filtercourse() {
        var catlistId = $('#catlist').val();
        var url = "<?php echo site_url('professional/course_list/');?>" + catlistId;
        //alert(url);
        window.location = url;
    }

     function paynow(cid,price) {
            if('<?=$is_login ?>'){
                $('#item_name').val(cid);
                $('#amount').val(price);
                document.getElementById("course_pur").submit();
            }else{
                var r = confirm('Please logged in first!');
                if (r == true) {
                    window.location.href = "<?php echo BASE_URL.'users'; ?>";
                }
            }
        }
</script>

<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="course_pur" id="course_pur">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name" value="<?php echo $course[0]['course_title'];?>">
    <input type="hidden" name="item_number" value="<?php echo $course[0]['id'];?>">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
    <input type="hidden" name="custom" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
    <input type="hidden" name="amount" id="amount" value="<?php echo $course[0]['price'];?>">
    <input type="hidden" name="tax" value="<?php echo $tax; ?>"> 
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('pages/cancelpayment/').$idd;?>">
    <input type="hidden" name="return" value="<?php echo site_url('pages/success');?>"> 
</form> 