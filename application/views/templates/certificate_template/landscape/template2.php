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


     <table border="0" align="center" width="100%" style=" background-image: url(<?php echo showimage($img3); ?>); background-repeat: no-repeat; background-size: cover;">
		 <tr>
            <th style=" width:100%;" >
                <table style="width: 70%;margin: 0 auto;text-align:  center;font-family: 'Montserrat', sans-serif;margin-top: 51px;">
                    <tr style="">
                        <th style=" width: 15%;    text-align: center; ">
                            <span class="images" style=" display: inline-block;     vertical-align: middle; float: left;"><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 60px;"></span>
                        </th>
                        <th style="text-align: center;width: 70%;">
  
                            <span class="hesder-content" style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 14px; line-height: 17px; text-align: center;">
                                <?php echo $certificate[0]['header_line1']; ?><br>
                            <?php if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2']; ?><br>
                            <?php }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span>
                        </th>
                       <th style="width: 15%; text-align: center;">
                            <?php if($certificate[0]['logo2']!=''){ ?>
                                <span class="images" style=" display: inline-block; vertical-align: middle; float: right; "><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 60px;">
                                </span>
                            <?php }?>
                        </th>
                    </tr>
                </table>
            </th>

        </tr>
        <tr>
            <td>
                <table style="width: 300px; margin: 0 auto;margin-top: 12px; text-align: center;">

                    <tr>
                        <td><img src="<?php echo showimage($text_certificate); ?>" style=" width: 86%; "></td>

                    </tr>

                </table>
            </td>

        </tr>
        <tr>
            <td>
                <h1
                    style=" color: #dd8827; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;    margin:0; font-size:15px;">
                    <?php echo $certificate[0]['title']; ?></h1>
            </td>
        </tr>
        <tr style="text-align: center;">
            <td>
                <h1 style="font-family: 'Tangerine';font-size: 30px;font-weight: 700;margin: 16px 0 0 0;line-height: 7px;"><?php echo ucwords($profile[0]['name']); ?></h1>
                <span style="border-top: 1px dotted #d2d2d2;width: 60%;height: 1px;display: block;margin: 0 auto;margin-top: 9px;"></span>

               <p style="font-size: 13px;color: #0d0d0d;margin-top: 0;font-weight: 500;font-family: 'Montserrat', sans-serif;margin-bottom: 0;"><?php echo $certificate[0]['intro_text']; ?></p>
               <p style="font-size: 15px;color: #2e85c1;margin-top: 0px;font-family: 'Montserrat', sans-serif;font-weight: 600;margin-bottom: 0;"><?php echo $certificate[0]['training_title']; ?></p>
                <p style=" margin-top: 0px; font-size: 13px; font-family: 'Montserrat', sans-serif; margin-bottom: 0;"><?php echo date('F d, Y',strtotime($cust_data[0]['added_on'])); ?></p>
                <p style=" color: #2e85c1;  font-size: 13px; line-height: 1;  margin-top: 0px; font-family: 'Montserrat', sans-serif; font-weight: 600; margin-bottom: 0;"><?php echo $owner[0]['address']; ?>,</p>
                <p style=" color: #2e85c1; font-size: 15px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: 0px;  margin-bottom: 0;">Mount Royal Auditorium,<br>
                Delaware, USA </p>
                <p style=" margin-top: 0px; font-size: 15px; font-weight: 600; font-family: 'Montserrat', sans-serif; margin-bottom: 6px;">
                    CE Units: <?php echo $certificate[0]['units']; ?></p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <table style="margin: 0 auto; margin-top: 0px;">
                    <tr>
                        <?php if($num == 1){
                            $width = '100%';
                          }elseif($num == 2){
                            $width = '50%';
                          }elseif($num == 3){
                            $width = '33.3%';
                          }else{
                            $width = '25%';
                          }
                        for($i=0;$i<$num;$i++){ 
                           $sugnature[$i] = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>
                        <td
                            style="/* background-color: #ededec;*/width: <?=$width?>;padding: 6px 25px;margin-right: 10px;text-align: center;border-radius: 5px;">
                            <img src="<?php echo showimage($sugnature[$i]); ?>" alt="signature" style=" width: 50px;">
                             <strong>
							 <p style="margin: 0; margin-top: 0px; color: #7c7c7c; font-size: 13px;"><?php echo ucwords($namearray[$i]) ?></p></strong>
                            <p style=" margin: 0; margin-top: 0px;color: #7c7c7c;font-size: 13px;"><?php echo ucwords($postionarray[$i]); ?></p>

                        </td>
                        <?php } ?>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 90%; margin-top: 17px; margin-bottom: 0; margin-left:auto; margin-right:auto; padding-top: 0; padding-bottom: 0;">
                    <tr>
                        <td style="text-align: left;width: 60%;">
                            <img src="<?php echo showimage($ceonpointlogo); ?>" style=" padding-top: 0px; width: 130px; ">
                            <p
                                style=" color: #f2cd1e; font-size: 14px; margin: 0px 0; font-family: 'Montserrat', sans-serif; ">
                                validate this certificate at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 14px; font-family: 'Montserrat', sans-serif; ">https://ceonpoint.com/index.php/pages/cfvalidation</a>
                        </td>
                        <td style="text-align: right; width: 40%;">
                            <img src="<?php echo showimage($barcode); ?>" alt="barcode" style=" width: 40px">
                            <p
                                style="color: #f2cd1f; font-size: 14px; margin: 5px 0; font-family: 'Montserrat', sans-serif;">
                                Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 14px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;"><?php echo $cust_data[0]['certificate_id'];?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
                

    <?php function showimage($image){
         /*    $imageData = base64_encode(file_get_contents($image));
            $src = 'data:image/jpeg;base64,'.$imageData; */
            $src = $image;
            return $src; } ?>

</body>
</html>

