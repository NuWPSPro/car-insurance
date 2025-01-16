<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Certificate</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Tangerine&display=swap" rel="stylesheet">
        <style type="text/css">
            @font-face {
              font-family: 'Tangerine';
              font-style: normal;
              src: local('Tangerine Bold'), local('Tangerine-Bold'), url(<?php echo ASSETS_URL.'fonts/Tangerine-Bold.ttf'?>) format('truetype');
            }
        </style>
    </head>

<body>
    <?php $namearray = explode('##', $certificate[0]['name']);
          $postionarray = explode('##', $certificate[0]['position']);
          $filesarray = explode('##', $certificate[0]['signature']);
          $num = count($namearray); ?>

    <?php if($certificate[0]['bg_image']==''){
          $img3 = ASSETS_URL.('images/certificate_images/certificate.png'); 
          $text_certificate = ASSETS_URL.('images/certificate_images/certificat-text.png');
    }else{
          $img3 = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['bg_image']); 
          $text_certificate = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['text_image']);
    } ?>


    <?php $logo1 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1'];  ?>
    <?php $logo2 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2'];  ?>
    <?php $barcode = ASSETS_URL.'images/uploads/'.$exam_details[0]['barcode']; ?>
    <?php $ceonpointlogo  = ASSETS_URL.('images/certificate_images/footer-logo.png'); ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 0 auto; background-image: url(<?php echo showimage($img3); ?>); background-repeat: no-repeat;padding-top: 36px;padding-bottom: 15px; ">
    <tbody>
    <tr>
        <td>
            <table style="margin: 0 auto;text-align: center;font-family: 'Montserrat', sans-serif;margin-right: 25px;">
                <tbody>
                <tr>
                    <td style="margin-right: 0; text-align: center;margin-top: 0;padding-right: 87px;display: block;">
                        <span style="color: #0d0d0d;font-weight: 600;font-size: 20px;  margin-right: 0;margin-top: 14px;line-height: 21px; width: 100%;text-align: center; display: inline-block;"><?php echo $certificate[0]['header_line1'].'<br>'; if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2'].'<br>'; }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span>
                    
                        <table style="margin-top: 18px; width: 300px; margin:0 auto; margin-top:15px;">
                            <tbody>
                            <tr>
                                <td style="margin-top: 18px;text-align: center;width: 100%;">
                                    <img src="<?php echo showimage($text_certificate); ?>"style="width: 300px;">
                                    <h1 style=" color: #dd8827;text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600;text-align: center; margin: 0;font-size: 20px;margin-top: 10px;margin-bottom: 15px;"> <?php echo $certificate[0]['title']; ?></h1>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="font-weight: 600; color: #000; width: 29%; text-align: right; padding-right: 15px; padding-top: 17px;">
                        <span style="display: block; margin-right:20px" ><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 80px; margin-bottom: 10px;"></span>
                        <?php if($certificate[0]['logo2']!=''){ ?>
                        <span style="display: block; margin-right:20px"><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 80px;"></span><?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>

    <tr>
        <td>    
            <table style="text-align: center; width: 300px ; margin: 0 auto;">
                <tbody>
                    <tr style="text-align: center; ">
                        <td>
                            <h1 style="font-family: 'Tangerine', cursive; font-size: 27px;font-weight: 700; margin: 0; "><?php echo ucwords($profile[0]['name']); ?></h1>

                            <span style="border-top: 2px solid #000;width: 100%;height: 1px;display: block;margin: 0 auto;margin-top: 0px;">
                            </span>

                             <p style="font-size: 12px;color: #0d0d0d;font-weight: 400;font-family: 'Montserrat', sans-serif;margin: 9px 0 0 0;">
                                <?php echo $certificate[0]['intro_text']; ?></p>
                            <p style="font-size: 17px;color: #2e85c1;font-family: 'Montserrat', sans-serif;font-weight: 500;margin: 12px 0 0 0;">
                                <?php echo $certificate[0]['course_title']; ?></p>
                           <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;">
                                <?php echo date("F d, Y", strtotime($exam_details[0]['added_on'])); ?></p>
                            <p style=" color: #2e85c1;  font-size: 14px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 500;">
                                <?php echo $owner[0]['address']; ?>,</p>
                            <p style=" color: #2e85c1; font-size: 14px;font-family: 'Montserrat', sans-serif; font-weight: 500; margin-top: -12px;">
                                <?php echo $owner[0]['location'];?></p>
                            <p style="margin-top: 25px;font-size: 19px;font-weight: 600;font-family: 'Montserrat', sans-serif;margin: 0 0 0 0;">
                                CE Units: <?php echo $course_details[0]['units']; ?></p>

                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    
    <tr>
        <td>
            <table style="padding: 0; width: 100%;">
                <tbody>
                    <tr>
                        <td style="text-align: right; width: 100%; padding-right: 15px;">
                            <img src="<?php echo showimage($barcode); ?>" alt="" style=" width: 50px; margin-right:15px;">
                            <p style="color: #fff; font-size: 10px; margin: 10px 0; font-family: 'Montserrat', sans-serif; margin-right10px;">
                                Certificate Number</p>
                            <p style="color: #ea8924;font-size: 10px; font-weight: 500; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;">
                                <?php echo $exam_details[0]['certificate_id'];?></p>
                            <p style=" color: #fff; font-size: 10px; margin: -1px 0; font-family: 'Montserrat', sans-serif; ">
                                Validate this certificate at:</p>
                            <a href="#" style="color: #ea8924; font-size: 11px; font-family: 'Montserrat', sans-serif; ">https://ceonpoint.com/index.php/pages/cfvalidation</a>
                        </td>
                    </tr>
					
                    <tr>
                        <td style="margin-bottom: 0;">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                                  
                                        <td style="width: 100%;">
                                          <table style="width: 200px; margin-top:15px">
                                                <tbody>
                                                    <tr>
                                                    <?php for($i=0;$i<$num;$i++){ 
                                                        $singnature[$i]  = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>
                                                        <td style="background-color: #ededec; padding: 0 0px;text-align: center; border-radius: 10px; width: 50px;">
                                                         <img src="<?php echo showimage($singnature[$i]); ?>" alt="" style="width: 70px;">
                                                        <strong><p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;"><?php echo ucwords($namearray[$i]) ?></p></strong>
                                                        <p style=" margin: 0; color: #7c7c7c;font-size: 13px;"><?php echo ucwords($postionarray[$i]); ?></p>
                                                        </td>
                                                        <?php } ?>
                                                        
                                                    </tr>

                                                </tbody>
                                            </table> 
                                        </td>

                                      
                                        <td style="text-align: right; width: 40%; padding-right: 19px;">
                                            <img src="<?php echo showimage($ceonpointlogo); ?>" alt="" style="padding-top: 0px;float: right;width: 150px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>      
                       
    </tbody>                    
</table> 
                

    <?php function showimage($image){
            $imageData = base64_encode(file_get_contents($image));
            $src = 'data:image/jpeg;base64,'.$imageData;
            return $src; } ?>

</body>
</html>

