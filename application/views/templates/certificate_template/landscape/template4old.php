<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Certificate Landscape</title>
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
        // echo'1';die;
          $img3 = ASSETS_URL.('images/certificate_images/certificate.png'); 
          $text_certificate = ASSETS_URL.('images/certificate_images/certificat-text.png');
    }else{
        // echo'2';die;
          $img3 = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['bg_image']); 
          $text_certificate = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['text_image']);
    } ?>


    <?php $logo1 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1'];  ?>
    <?php $logo2 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2'];  ?>
    <?php $barcode = ASSETS_URL.'images/uploads/'.$cust_data[0]['barcode']; ?>
    <?php $ceonpointlogo  = ASSETS_URL.('images/certificate_images/footer-logo.png'); ?>

<table cellpadding="0" cellspacing="0" border="0" align="center"  style="  width:850px; margin: 0 auto; background-image: url(<?php echo $img3; ?>); background-repeat: no-repeat; background-size: cover;">
        <tr>
            <th>
                <table style=" width: 540px;margin: 0 auto; text-align:  center;font-family: 'Montserrat', sans-serif; margin-top: 74px;">
                    <tr>
                        <th style=" width: 100px;    text-align: center;">
                            <span class="images" style=" display: inline-block;     vertical-align: middle; float: left;"><img src="<?php echo ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1']; ?>" alt="" style="width: 75px;"></span>
                        </th>
                        <th style="text-align: center;width: 406px;">
  
                            <span class="hesder-content" style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 19px; line-height: 21px; text-align: center;">
                                <?php echo $certificate[0]['header_line1']; ?><br>
                            <?php if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2']; ?><br>
                            <?php }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span>
                        </th>
                       <th style="width: 100px; text-align: center;">
                            <?php if($certificate[0]['logo2']!=''){ ?>
                                <span class="images" style=" display: inline-block; vertical-align: middle; float: right; "><img src="<?php echo ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2']; ?>" alt="" style="width: 75px;">
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

                    <tr>
                        <td><img src="<?php echo  $text_certificate; ?>" style=" width: 100%; "></td>

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
                <h1 style="font-family: 'Tangerine'; font-size: 48px;font-weight: 700; margin: 0; line-height: 7px; "><?php echo ucwords($profile[0]['name']); ?></h1>
                <span
                    style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top: 22px;"></span>

                <p
                    style=" font-size: 19px;color: #0d0d0d; margin-top: 10px; font-weight: 500; font-family: 'Montserrat', sans-serif;"><?php echo $certificate[0]['intro_text']; ?></p>
                <p
                    style="font-size: 23px;color: #2e85c1; margin-top: 13px; font-family: 'Montserrat', sans-serif; font-weight: 600;"><?php echo $certificate[0]['training_title']; ?></p>
                <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;"><?php echo date('F d, Y',strtotime($cust_data[0]['added_on'])); ?></p>
                <p
                    style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;"><?php echo $owner[0]['address']; ?>,</p>
                <p
                    style=" color: #2e85c1; font-size: 16px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: -12px;"><?php echo $owner[0]['location'];?></p>
                <p style=" margin-top: 25px; font-size: 21px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
                    CE Units: <?php echo $certificate[0]['units']; ?></p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 540px; margin: 0 auto; margin-top: 25px; margin-bottom: 90px;">
                    <tr>
                        <?php for($i=0;$i<$num;$i++){ ?>
                        <td
                            style="background-color: #ededec;padding: 6px 25px;margin-right: 10px;text-align: center; border-right: 10px solid #fff;border-radius: 5px;">
                            <img src="<?php echo ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>" alt="signature" style=" width: 62px;">
                             <strong><p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;"><?php echo ucwords($namearray[$i]) ?></p></strong>
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
                            <!-- <img src="<?php echo showimage($ceonpointlogo); ?>" style=" padding-top: 19px; "> -->
                            <p
                                style=" color: #f2cd1e; font-size: 18px; margin: 9px 0; font-family: 'Montserrat', sans-serif; ">
                                validate this certificate at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 17px; font-family: 'Montserrat', sans-serif; ">https://ceonpoint.com/index.php/pages/cfvalidation</a>
                        </td>
                        <td style="text-align: right; width: 40%;">
                            <img src="<?php echo showimage($barcode); ?>" alt="barcode" style=" width: 70px">
                            <p
                                style="color: #f2cd1f; font-size: 17px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 19px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;"><?php echo $cust_data[0]['certificate_id'];?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
                

    <?php function showimage($image){
            $imageData = base64_encode(file_get_contents($image));
            $src = 'data:image/jpeg;base64,'.$imageData;
            return $src; } ?>

</body>


</html>

