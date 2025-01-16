
<!DOCTYPE html>
<html lang="en">

    <head>
            <meta charset="utf-8">
            <title>Certificate Portrait 2</title>

            <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
            rel="stylesheet">
            <!-- <link href="https://fonts.googleapis.com/css?family=Tangerine&display=swap" rel="stylesheet"> -->
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

   
     <?php if(empty($certificate[0]['bg_image'])){
           
              $img3 = ASSETS_URL.('images/certificate_images/portrait-certificate.jpg'); 
              $text_certificate = ASSETS_URL.('images/certificate_images/baner-logo2.png');
        }else{
              $img3 = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['bg_image']); 
              $text_certificate = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['text_image']);
        } ?>

<?php $logo1 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1']; ?>
<?php $logo2 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2']; ?>

<?php $ceonpointlogo = ASSETS_URL.('images/certificate_images/Logoblue.jpg');?>
<?php $barcode = ASSETS_URL.'images/uploads/'.$cust_data[0]['barcode']; ?>
    <table width="720" cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 0 auto; background-image: url(<?php echo showimage($img3); ?>); background-repeat: no-repeat; ">
      <tbody>
    <tr>
        <td>
          <table style=" width: 540px;margin: 0 auto; text-align:  center;font-family: 'Montserrat', sans-serif; margin-top: 55px;">
                    <tr>
                        <td style=" width: 100px;    text-align: center;">
                            <span class="images" style=" display: inline-block;     vertical-align: middle; float: left;"><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 75px;"></span>
                        </td>
                        <td style="text-align: center;width: 406px;">
  
                            <span class="hesder-content" style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 16px; line-height: 21px; text-align: center;">
                                <?php echo $certificate[0]['header_line1']; ?><br>
                            <?php if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2']; ?><br>
                            <?php }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span>
                        </td>
                       <td style="width: 100px; text-align: center;">
                            <?php if($certificate[0]['logo2']!=''){ ?>
                                <span class="images" style=" display: inline-block; vertical-align: middle; float: right; "><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 75px;">
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
                        <td><img src="<?php echo showimage($text_certificate); ?>" border="0"style="width: 320px;height: 62px;" /></td>

                    </tr>

                </table> 
            
        </td>
     </tr>
     <tr>
        <td align="center">
            <h1 style="color: #075381;text-transform: uppercase;font-family: 'Montserrat', sans-serif;font-weight: 500;font-size: 20px;margin: 0px 0 0 0;">
                    <?php echo $certificate[0]['title']; ?></h1>
            
        </td>
     </tr>

      <tr>
        <td align="center">
                <p style="font-family: 'Tangerine';font-size: 38px;font-weight: 700;margin: 26px 0 0 0;line-height: 24px;"><?php echo ucwords($profile[0]['name']); ?></p>
                <span style="border-top: 1px dotted #d2d2d2;width: 70%;height: 0px;display: block;margin: 0 auto;margin-top: 9px;"></span>

                <p style="font-size: 17px;color: #0d0d0d;margin-top: 0px;font-weight: 500;font-family: 'Montserrat', sans-serif;margin-bottom: 0;"><?php echo $certificate[0]['intro_text']; ?></p>
                <p style="font-size: 23px;color: #2e85c1;margin-top: 0px;font-family: 'Montserrat', sans-serif;font-weight: 600;margin-bottom: 0;"><?php echo ucwords($certificate[0]['training_title']); ?></p>
                <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;"><?php echo date("F d, Y", strtotime(date('Y-m-d'))); ?></p>
                <p style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600; word-break: break-all; width: 100%;">
                <?php echo $certificate[0]['location']; ?> </p>
                <p style="margin-top: 0;font-size: 15px;font-weight: 600;font-family: 'Montserrat', sans-serif;">
                    CE Units: <?php echo $certificate[0]['units']; ?></p>
            
        </td>
     </tr> 

     <tr>
        <td align="center" >
            <table style="margin: 0 auto;margin-top: 0;margin-bottom: 0;">
                    <tr>
                        <?php 
                            if($num == 1){ $width = '100%'; }elseif($num == 2){ $width = '50%'; }elseif($num == 3){ $width = '33.3%';
                          }else{ $width = '25%'; }
                        for($i=0;$i<$num;$i++){
                        $signautreimg[$i] = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>
                        <td
                            style="padding: 12px 12px;margin-right: 10px;width: <?=$width;?>;text-align: center; border-right: 10px solid #fff;">
                            <img src="<?php echo showimage($signautreimg[$i]); ?>" alt="signature" style=" width: 60px;">
                            <strong><p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 1.1vw;"><?php echo ucwords($namearray[$i]) ?></p></strong>
                            <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size:0.5vw;"><?php echo ucwords($postionarray[$i]); ?></p>

                        </td>
                        <?php } ?>
                    </tr>

                </table>
            
        </td>
     </tr>

     <tr>
        <td>
                <table width="100%" style="width: 100%;margin: 0 auto;padding: 0 10px 0 52px;margin-top: 35px;margin-bottom: 50px;">
                    <tr>
                       
                        <td style="text-align: right;  padding-right: 32px;">
                            <img src="<?php echo showimage($barcode); ?>" style=" width: 70px;">
                            <p style="color: #000; font-size: 13px; margin: 6px  0; font-family: 'Montserrat', sans-serif;line-height: 1em;"> Certificate Number</p>
                            <p style="color: #f2cd1f;font-size: 13px;font-weight: 600;font-family: 'Montserrat', sans-serif;text-transform: uppercase;letter-spacing: 1.1px;margin: 0;line-height: 1.5em;"><?php echo $cust_data[0]['certificate_id'];?></p>
                            <p style="color: #000; font-size: 13px; margin: 6px  0; font-family: 'Montserrat', sans-serif;line-height: 1em;">validate this certificate at:</p>
                            <p style="color: #000; font-size: 13px; margin: 6px  0; font-family: 'Montserrat', sans-serif;line-height: 1em;">https://ceonpoint.com/index.php/pages/cfvalidation</p>

                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: end; padding: 20px 31px 0 0;">
                            <p style="color: #000;font-size: 13px;font-family: 'Montserrat', sans-serif;margin: 0;">
                            Accreditation Number</p>
                            <p style="color: #f2cd1f;font-size: 13px;font-weight: 600;font-family: 'Montserrat', sans-serif;text-transform: uppercase;letter-spacing: 1.1px;margin: 0;line-height: 1.5em;">CERTI987654321</p>
                            <p style="color: #000;font-size: 13px;font-family: 'Montserrat', sans-serif;margin: 0;">validate this accreditation no. at:</p>
                            <p style="color: #000;font-size: 13px;font-family: 'Montserrat', sans-serif;margin: 0;">https://ceonpoint.com/RBoard/license/search</p>
                        </td>
                    </tr>
                </table> 
            
        </td>
     </tr> 
     </tbody>  
    </table> 


<?php 

function showimage($image){
// $imageData = base64_encode(file_get_contents($image));
// $src = 'data:image/jpeg;base64,'.$imageData;
$src = $image;
return $src;
}
?>

</body>

</html>
