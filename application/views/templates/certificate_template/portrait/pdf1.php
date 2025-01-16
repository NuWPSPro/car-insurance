<!DOCTYPE html>
<html lang="en">
    <head><meta charset="utf-8"/>
            <title>Certificate Portrait 2</title>
            <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
            rel="stylesheet">
            <style type="text/css">@font-face{font-family:Tangerine;font-style:normal;src:local('Tangerine Bold'),local('Tangerine-Bold'),url(<?php echo ASSETS_URL.'fonts/Tangerine-Bold.ttf'?>) format('truetype')}</style>
    </head>
    <body>
    <?php   
        $namearray = explode('##', $certificate['name']);
        $postionarray = explode('##', $certificate['position']);
        $filesarray = explode('##', $certificate['signature']);
        $num = count($namearray);
        $logo1 = ASSETS_URL.'upload/certificate/logo/'.$certificate['logo1']; 
        $logo2 = ASSETS_URL.'upload/certificate/logo/'.$certificate['logo2'];
        $ceonpointlogo = ASSETS_URL.('images/certificate_images/footer-logo.png');
        $barcode = ASSETS_URL.'images/uploads/'.$cust_data['barcode']; 
        if(empty($certificate['bg_image'])){
            $img3 = ASSETS_URL.('images/certificate_images/portrait-certificate.jpg'); 
            $text_certificate = ASSETS_URL.('images/certificate_images/baner-logo2.png');
        }else{
            $img3 = ASSETS_URL.('upload/certificate_templete/'.$certificate['bg_image']); 
            $text_certificate = ASSETS_URL.('upload/certificate_templete/'.$certificate['text_image']);
        } 
        ?>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 0 auto; background-image: url(<?=showimage($img3);?>); background-repeat: no-repeat; ">
      <tbody>
    <tr>
        <td>
           <table style=" width:80%; margin: 0 auto; text-align:  center;font-family: 'Montserrat', sans-serif; margin-top: 74px;">
                    <tr>
                        <td style="width: 15%; text-align: center;">
                            <span class="images" style="display: inline-block;vertical-align: middle; float: left;"><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 70px;"></span>
                        </td>
                        <td style="text-align: center;width: 70%;">
                            <span class="hesder-content" style="display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 16px; line-height: 21px; text-align: center;">
                                <?php echo $certificate['header_line1']; ?>
                            <?php if($certificate['header_line2']!=''){ echo $certificate['header_line2']; ?>
                            <?php }if($certificate['header_line3']!=''){ echo $certificate['header_line3']; } ?></span>
                        </td>
                       <td style="width: 15%; text-align: center;">
                            <?php if($certificate['logo2']!=''){ ?>
                                <span class="images" style=" display:inline-block; vertical-align: middle; float: right; "><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 70px;">
                                </span>
                            <?php }?>
                        </td>
                    </tr>
                </table>
        </td>
     </tr>  
     <tr>
        <td>
           <table width="100%" align="center" style=" margin: 0 auto;margin-top: 12px; text-align: center;">
                    <tr>
                        <td><img src="<?php echo showimage($text_certificate); ?>" border="0" width="400"/></td>
                    </tr>
                </table> 
        </td>
     </tr>
     <tr>
        <td align="center">
            <h1 style="color: #075381;text-transform: uppercase;font-family: 'Montserrat', sans-serif;font-weight: 500;font-size: 20px;margin: 0px 0 0 0;">
                    <?php echo $certificate['title']; ?></h1>
        </td>
     </tr>
      <tr>
        <td align="center">
                <p style="font-family: 'Tangerine';font-size: 38px;font-weight: 700;margin: 26px 0 0 0;line-height: 24px;"><?php echo ucwords($certificate['user_name']); ?></p>
                <span style="border-top: 1px dotted #d2d2d2;width: 70%;height: 0px;display: block;margin: 0 auto;margin-top: 9px;"></span>
                
                <p style=" font-size: 17px;color: #0d0d0d; margin-top: 5px; font-weight: 500; font-family: 'Montserrat', sans-serif; margin-bottom:0;"><?php echo $certificate['intro_text']; ?></p>

                <p style="font-size: 23px;color: #2e85c1;margin-top: 0px;font-family: 'Montserrat', sans-serif;font-weight: 600;margin-bottom: 0;"><?php echo ucwords($certificate['training_title']); ?></p>

                <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;"><?php echo date("F d, Y", strtotime($certificate['start_date'])); ?></p>
                <p style="color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600; word-break: break-all; width: 100%;"><?php echo $certificate['location']; ?> </p>
                <p style="margin-top: 0;font-size: 15px;font-weight: 600;font-family: 'Montserrat', sans-serif;">
                    CE Units: <?php echo $certificate['units']; ?></p>
        </td>
     </tr> 
     <tr>
        <td align="center" >
            <table style="margin: 0 auto;margin-top: 0;margin-bottom: 0;">
                    <tr>
                        <?php for($i=0;$i<$num;$i++){
                          if($num == 1){ $width = '100%'; }elseif($num == 2){ $width = '50%'; }elseif($num == 3){ $width = '33.3%'; }else{ $width = '25%'; }
                        $signautreimg[$i] = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>
                        <td
                            style="padding: 12px 12px;margin-right: 10px;width: <?=$width;?>;text-align: center; border-right: 10px solid #fff;">
                            <img src="<?php echo showimage($signautreimg[$i]); ?>" alt="signature" style=" width: 60px;">
                            <strong><p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 1.1vw;"><?php echo ucwords($namearray[$i]) ?></p></strong>
                            <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 0.5vw;"><?php echo ucwords($postionarray[$i]); ?></p>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
        </td>
     </tr>
     <tr>
        <td>
                <!-- <table  width="100%" style="width: 100%;margin: 0 auto;padding: 0 10px 0 52px;margin-top: 5px;margin-bottom: 50px;">
                    <tr>
                        <td style="text-align: left; padding: 0 0 0 9px;">
                        <img src="<?php echo showimage($ceonpointlogo); ?>" style=" padding-top: 19px; width:200px;padding-left:20px; ">
                        <?php // if($has_acc == true){ ?>
                            <p style="color: #000;font-size: 13px;font-family: 'Montserrat', sans-serif;margin: 0;">
                            Accreditation Number</p>
                            <p style="color: #f2cd1f;font-size: 13px;font-weight: 600;font-family: 'Montserrat', sans-serif;text-transform: uppercase;letter-spacing: 1.1px;margin: 0;line-height: 1.5em;"><?php echo $cust_data['certificate_id'];?><?php // echo $acc_number; ?></p>
                            <p style="color: #000;font-size: 13px;font-family: 'Montserrat', sans-serif;margin: 0;">validate this accreditation no. at:</p>
                            <p style="color: #000;font-size: 13px;font-family: 'Montserrat', sans-serif;margin: 0;">https://ceonpoint.com/RBoard/license/search</p> <?php // }else{ echo '<br/><br/><br/>...'; } ?>
                        </td>
                    </tr>
                    <tr>
                       <td style="text-align: right;padding: 0 31px 0 0;">
                        <img src="<?php echo showimage($barcode); ?>" style="width: 70px;">
                        <p style="color: #000;font-size: 13px;font-family: 'Montserrat', sans-serif;margin: 0;"> Certificate Number</p>
                        <p style="color: #f2cd1f;font-size: 13px;font-weight: 600;font-family: 'Montserrat', sans-serif;text-transform: uppercase;letter-spacing: 1.1px;margin: 0;line-height: 1.5em;"><?php echo $cust_data['certificate_id'];?></p>
                        <p style="color: #000;font-size: 13px;font-family: 'Montserrat', sans-serif;margin: 0;">validate this certificate at:</p>
                        <p style="color: #000;font-size: 13px;font-family: 'Montserrat', sans-serif;margin: 0;">https://ceonpoint.com/index.php/pages/cfvalidation</p>
                        </td>
                    </tr>
                    
                </table>  -->
                <table width="100%" style="width: 100%;margin: 0 auto;padding: 0 10px;margin-top: 130px;margin-bottom: 5px;">
                    <tr>
                        <td style="text-align: left; padding: 0 0 10px 10px;">
                            
                            <img src="<?php echo showimage($ceonpointlogo); ?>" style="width: 200px; ">
                            <p
                                style="color: #fff; font-size: 14px; margin: 3px 0 0;  font-family: 'Montserrat', sans-serif;">
                                Certificate Number & Validtion Link</p>
                            <p
                                style="color: #f2cd1f;font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;" ><?php echo $cust_data['certificate_id'];?></p>
                            <!-- <p
                                style=" color: #fff; font-size: 13px; margin: 6px 0 0px; font-family: 'Montserrat', sans-serif;">
                                validate this certificate at:</p> -->
                            <a href="#"
                                style="color: #f2cd1e; font-size: 14px; font-family: 'Montserrat', sans-serif; display: block">https://ceonpoint.com/pages/cfvalidation</a>
                        </td>
                        <td style="text-align: right;  padding: 0 10px 10px 0px;">
                            <img src="<?php echo showimage($barcode); ?>" style=" width: 55px">
                            <?php if($has_acc == true){ ?>
                            <p style="color: #fff; font-size: 14px; margin: 3px 0 0; font-family: 'Montserrat', sans-serif;">
                                Certificate Number & Validtion Link</p>
                            <p style="color: #f2cd1f;font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;" ><?=$acc_number; ?></p>
                            <!-- <p style=" color: #fff; font-size: 13px; margin: 5px 0 0px; font-family: 'Montserrat', sans-serif; ">
                                validate this certificate at:</p> -->
                            <a href="#" style="color: #f2cd1e; font-size: 14px; font-family: 'Montserrat', sans-serif; display: block">https://ceonpoint.com/pages/cfvalidation</a>
                            <?php }else{ echo '<br/><br/><br/>...'; } ?>
                        </td>
                    </tr>
                </table> 
        </td>
     </tr> 
     </tbody>  
    </table> 
    <?php function showimage($image){
            $type = pathinfo($image, PATHINFO_EXTENSION);
            $data = file_get_contents($image);
            $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $logo;
        } ?>
</body>
</html>