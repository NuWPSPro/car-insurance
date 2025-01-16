<?php //$this->load->view('template/search'); ?>
<?php 
 
if($cnumber !=""){ ?>
    <div class="innerContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <iframe src="<?php echo ASSETS_URL.'upload/pdf/'.$cnumber; ?>.pdf" height="650" width="550"></iframe>
                </div>
            </div>
        </div>
    </div>
    <?php   die;  } ?>

<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
              <!--   <h3 class="border-title text-left pull-left"><?php echo $course[0]['course_title'];?></h3> -->
<!--                 <div class="training-price">$50 - Buy Now</div>
 -->                
            <?php 
            if($table_id  != ''){
                $this->db->where('id',$table_id);
                $query = $this->db->get('tbl_exam');
                $data['exam_details'] = $query->result_array(); 
                // print_r($table_id);die;    
            }else{
                $idd = $this->uri->segment(3);
                $uid = $this->session->userdata('logged_in')['id'];
                $data['exam_details'] = $this->user->get_exam_detail($idd,$uid);
            }
            
            // $idd = $certificate_id; 
            ?>
            <?php 
           ?> 
        <?php echo $this->session->flashdata('response');?>
        <div class="" style="width: 94%;">

        <?php if(empty($data['exam_details'])){ ?>
                <div class="alert alert-info">Invalid Certificate Number.</div>
        <?php  } else {  ?>
               <table style="  width:800px;    margin: 0 auto; background-image: url(<?php echo ASSETS_URL.('images/certificate_images/portrait-certificate.png');?>); background-repeat: no-repeat; background-size: cover; padding-top: 90px;">
        <tr>
            <th>
                <table style=" width: 590px;margin: 0 auto; text-align: center;font-family: 'Montserrat', sans-serif; ">
                    <tr>
                        <th>
                            <span class="images" style=" display: inline-block; vertical-align: middle; float: left; "><img src="<?php echo ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1']; ?>" alt="" style="width: 75px;"></span>
                        </th>
                        <th>
                            <span class="hesder-content" style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 19px; ">
                                <?php echo $certificate[0]['header_line1']; ?><br>
                            <?php if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2']; ?><br>
                            <?php }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span>
                        </th>
                        <th>
                            <?php if($certificate[0]['logo2']!=''){ ?>
                                <span class="images" style=" display: inline-block; vertical-align: middle; float: right; "><img src="<?php echo ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2']; ?>" alt="" style="width: 75px;">
                                </span>
                            <?php } ?>
                        </th>
                    </tr>
                </table>
            </th>

        </tr>
        <tr>
            <td>
                <table style="width: 461px;margin: 0 auto;margin-top: 6px;">

                    <tr>
                        <td><img src="<?php echo ASSETS_URL.('images/certificate_images');?>/baner-logo2.png" alt="certificate txt image" style=" width: 100%; "></td>

                    </tr>

                </table>
            </td>

        </tr>
        <tr>
            <td>
                <h1
                    style=" color: #dd8827; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;">
                    <?php echo $certificate[0]['title']; ?></h1>
            </td>
        </tr>
        <tr style="text-align: center;">
            <td>
                <h1 style="font-family: 'Tangerine', cursive; font-size: 48px;font-weight: 700; margin: 0; "><?php echo $profile[0]['name']; ?></h1>
                <span
                    style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top: 18px;"></span>

                <p
                    style=" font-size: 19px;color: #0d0d0d; margin-top: 20px; font-weight: 500; font-family: 'Montserrat', sans-serif;"><?php echo $certificate[0]['intro_text']; ?></p>
                <p
                    style="font-size: 23px;color: #2e85c1; margin-top: 13px; font-family: 'Montserrat', sans-serif; font-weight: 600;"><?php echo $certificate[0]['course_title']; ?></p>
                <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;"><?php echo date('F-d-Y',strtotime($certificate[0]['added_at'])); ?></p>
                <p
                    style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                    Mount Royal Auditorium, </p>
                <p
                    style=" color: #2e85c1; font-size: 16px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: -12px;">
                    Delaware, USA</p>
                <p style=" margin-top: 25px; font-size: 21px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
                    CE Units: <?php echo $course[0]['units']; ?></p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 540px; margin: 0 auto; margin-top: 25px; margin-bottom: 90px;">
                    <tr>
                        <?php for($i=0;$i<$num;$i++){ ?>
                        <td
                            style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                            <img src="<?php echo ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>" alt="signature" style=" width: 57px;">
                            <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;"><?php echo $namearray[$i] ?></p>
                            <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;"><?php echo $postionarray[$i]; ?></p>

                        </td>
                        <?php } ?>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="
                width: 90%; margin: 0 auto; padding-top: 30px; padding-bottom: 38px; ">
                    <tr>
                        <td style="text-align: left;width: 60%;">
                            <img src="<?php echo ASSETS_URL.('images/certificate_images/');?>footer-logo.png" alt="ceonpoint image" style=" padding-top: 19px; ">
                            <p
                                style=" color: #fff; font-size: 18px; margin: 9px 0; font-family: 'Montserrat', sans-serif; ">
                                validate this certificate at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 17px; font-family: 'Montserrat', sans-serif; ">https://ceonpoint.com/index.php/pages/cfvalidation</a>
                        </td>
                        <td style="text-align: right; width: 40%;">
                            <img src="<?php echo ASSETS_URL?>images/uploads/<?php echo $data['exam_details'][0]['barcode'];?>" alt="barcode" style=" width: 70px">
                            <p
                                style="color: #fff; font-size: 17px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 19px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;"><?php echo $data['exam_details'][0]['certificate_id'];?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
                    <!-- <div class="certificate">
                       <table style="width: 100%">
                            <tr><td colspan="2" align="right" class="header">
                                <span><img height="75" width="75" src="<?php echo ASSETS_URL?>images/logo.png"></span>
                                <span><img height="75" width="75" src="<?php echo ASSETS_URL?>images/uploads/<?php echo $owner[0]['logo']; ?>"></span>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top"><h1>Certificate11</h1></td>
                                <td align="right">
                                    <div class="cpd-profile">
                                        <img height="75" width="75" src="<?php echo ASSETS_URL?>images/uploads/<?php echo $profile[0]['image']; ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <h3 class="name"><?php echo $profile[0]['name'];?></h3>
                                    <div class="test">has successfully completed the</div>
                                    <h4 class="course"><?php echo $course_details[0]['course_title'];?> Course</h4>
                                    <div class="unit">CPD Unit
                                        <?php echo $course_details[0]['units'];?>
                                    </div>
                                    <h5 class="prof"><?php echo $course_details[0]['prof_name'];?></h5>

                                    <div class="certificate-no">
                                        <?php echo $data['exam_details'][0]['certificate_id'];?>
                                        <br>
                                        <span>Certificate Number</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="foot">
                            <div class="time">
                            <?php echo date("jS F, Y", strtotime($data['exam_details'][0]['added_on'])); ?>
                                <br>
                                <span>Date Completed</span>
                            </div>
                            <div class="barcode">
                                <img src="<?php echo ASSETS_URL?>images/uploads/<?php echo $data['exam_details'][0]['barcode'];?>">
                            </div>
                        </div>
                    </div> -->
        <?php    } ?>
                </div>

        <?php  if(empty($data['exam_details'])){ ?>

                <div class="panel panel-default" style="width: 492px; margin-left: 18%;">
                    <div class="panel-heading">
                        <form action="<?php echo BASE_URL;?>pages/download_certificate" method="post" enctype="multipart/form-data" name="form1" id="form1" class="flex-center justify-space-around">
                            <input required type="text" name="dcertificate" placeholder="Enter Certificate Number" class="form-control" style="margin-right: 15px;">
                           <input type="submit" class="btn btn-primary" value="Download Certificate">
                        </form>
                    </div>
               </div>
        <?php } ?>
        
        </div>
            <?php //$this->load->view('pages/sidebar'); ?>
        </div>
    </div>
</div>











