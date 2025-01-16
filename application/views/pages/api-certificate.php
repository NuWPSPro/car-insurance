
                    
                  <?php
				 
        $namearray = explode('##', $certificate[0]['name']);
        $postionarray =  explode('##', $certificate[0]['position']);
        $filesarray = explode('##', $certificate[0]['signature']);
       
        $num = count($namearray); ?>
      

 <?php  $img3 = ASSETS_URL.('images/certificate_images/blue-bg-temp.jpg'); ?>
       <table style="  width:740px;    margin: 0 auto; background-image: url(<?php echo showimage($img3); ?>); background-repeat: no-repeat; background-size: cover;">
        <tr>
            <th>
                <table style=" width: 540px;margin: 0 auto; text-align:  center;font-family: 'Montserrat', sans-serif; margin-top: 74px;">
                    <tr><?php  $logo1 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1']; ?>
                        <th style=" width: 100px;    text-align: center;">
                            <span class="images" style=" display: inline-block;     vertical-align: middle; float: left;"><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 75px;"></span>
                        </th>
                        <th style="text-align: center;width: 406px;">
  
                            <span class="hesder-content" style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 19px; line-height: 21px; text-align: center;">
                                <?php echo $certificate[0]['header_line1']; ?><br>
                            <?php if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2']; ?><br>
                            <?php }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span>
                        </th><?php  $logo2 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2']; ?>
                       <th style="width: 100px; text-align: center;">
                            <?php if($certificate[0]['logo2']!=''){ ?>
                                <span class="images" style=" display: inline-block; vertical-align: middle; float: right; "><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 75px;">
                                </span>
                            <?php }?>
                        </th>
                    </tr>
                </table>
            </th>

        </tr>
        <tr>
            <td>
                <table style="width: 380px; margin: 0 auto;margin-top: 12px; text-align: center;">

                    <tr><?php $bannerimg = ASSETS_URL.('images/certificate_images').'/baner-logo2.png'; ?>
                        <td><img src="<?php echo showimage($bannerimg); ?>" alt="certificate txt image" style=" width: 100%; "></td>

                    </tr>

                </table>
            </td>

        </tr>
        <tr>
            <td>
                <h1
                    style=" color: #dd8827; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;    margin: 24px 0 27px 0;">
                    <?php echo $certificate[0]['title']; ?></h1>
            </td>
        </tr>
        <tr style="text-align: center;">
            <td>
                <h1 style="font-family: 'Tangerine', cursive; font-size: 48px;font-weight: 700; margin: 0; line-height: 7px; "><?php echo ucwords($profile[0]['name']); ?></h1>
                <span
                    style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top: 22px;"></span>

                <p
                    style=" font-size: 19px;color: #0d0d0d; margin-top: 10px; font-weight: 500; font-family: 'Montserrat', sans-serif;"><?php echo $certificate[0]['intro_text']; ?></p>
                <p
                    style="font-size: 23px;color: #2e85c1; margin-top: 13px; font-family: 'Montserrat', sans-serif; font-weight: 600;"><?php echo $certificate[0]['course_title']; ?></p>
                <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;"><?php echo date('F d, Y',strtotime($certificate[0]['added_at'])); ?></p>
                <p
                    style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                    Mount Royal Auditorium, </p>
                <p
                    style=" color: #2e85c1; font-size: 16px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: -12px;">
                    Delaware, USA</p>
                <p style=" margin-top: 25px; font-size: 21px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
                    CE Units: <?php echo $course_details[0]['units']; ?></p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 540px; margin: 0 auto; margin-top: 25px; margin-bottom: 90px;">
                    <tr>
                        <?php for($i=0;$i<$num;$i++){ ?>
                            <?php $signautreimg[$i] = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>
                        <td
                            style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                            <img src="<?php echo showimage($signautreimg[$i]); ?>" alt="signature" style=" width: 57px;">
                            <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;"><?php echo ucwords($namearray[$i]) ?></p>
                            <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;"><?php echo ucwords($postionarray[$i]); ?></p>

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
                            <?php $ceonpointlogo = ASSETS_URL.('images/certificate_images/footer-logo.png');?>
                            <img src="<?php echo showimage($ceonpointlogo); ?>" alt="ceonpoint image" style=" padding-top: 19px; ">
                            <p
                                style=" color: #fff; font-size: 18px; margin: 9px 0; font-family: 'Montserrat', sans-serif; ">
                                validate this certificate at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 17px; font-family: 'Montserrat', sans-serif; ">https://ceonpoint.com/index.php/pages/cfvalidation</a>
                        </td>
                        <td style="text-align: right; width: 40%;">
                            <?php $barcode = ASSETS_URL.'images/uploads/'.$exam_details[0]['barcode']; ?>
                            <img src="<?php echo showimage($barcode); ?>" alt="barcode" style=" width: 70px">
                            <p
                                style="color: #fff; font-size: 17px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 19px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;"><?php echo $exam_details[0]['certificate_id'];?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


<?php 

function showimage($image){
$imageData = base64_encode(file_get_contents($image));
$src = 'data:image/jpeg;base64,'.$imageData;
return $src;
}
?>