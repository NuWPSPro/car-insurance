<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Certificate Landscape</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Tangerine&display=swap" rel="stylesheet">
        <style type="text/css">@font-face{font-family:Tangerine;font-style:normal;src:local('Tangerine Bold'),local('Tangerine-Bold'),url(<?php echo ASSETS_URL.'fonts/Tangerine-Bold.ttf'?>) format('truetype')}</style>
    </head>

<body>
    <?php $namearray = explode('##', $certificate[0]['name']);
          $postionarray = explode('##', $certificate[0]['position']);
          $filesarray = explode('##', $certificate[0]['signature']);
          $num = count($namearray);
        if($certificate[0]['bg_image']==''){
            $img3 = ASSETS_URL.('images/certificate_images/certificate.png'); 
            $text_certificate = ASSETS_URL.('images/certificate_images/certificat-text.png');
        }else{
            $img3 = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['bg_image']); 
            $text_certificate = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['text_image']);
        } 
        $logo1 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1'];
        $logo2 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2'];
        $barcode = ASSETS_URL.'images/uploads/'.$cust_data[0]['barcode']; 
        $ceonpointlogo  = ASSETS_URL.('images/certificate_images/footer-logo.png'); ?>
    
    <table width="100%" align="center" border="0" style="background: url(<?php echo showimage($img3); ?>); background-size: cover;  background-position: inherit;">
        <tbody>
        <tr>
        <td>
        <table style="margin: 0 auto;text-align: center;font-family: 'Montserrat', sans-serif;width: 89%;">
            <tbody>
            <tr>
                <td width="25%"></td>
                <td style="padding-top: 35px; width: 55%;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td align="center">
                                    <span style="color: #0d0d0d; font-weight: 600; font-size: 14px; margin-right: 0; margin-top: 10;    line-height: 21px; width: 100%; text-align: center;"><?php echo $certificate[0]['header_line1']; if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2']; }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td  align="center">
                                    <img src="<?php echo  showimage($text_certificate); ?>" style="width: 250px;">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <h1 style="color: #dd8827;text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600;text-align: center; margin: 0;font-size: 15px; margin-top: 10px;margin-bottom: 15px;">
                                        <?php echo $certificate[0]['title']; ?></h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="font-weight: 600; color: #000; width: 20%; text-align: right; padding-right: 10px; padding-top: 15px;">
                    <span class="images"><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 70px; margin-bottom: 10px;"></span><br> 
                    <?php if($certificate[0]['logo2']!=''){ ?>
                    <span class="images"><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 70px;"></span><?php } ?>
                </td>
            </tr>
            </tbody>
        </table>
        </td>
        </tr>

        <tr>
        <td>    
            <table style="width: 100%;margin-left: 8px;">
                <tbody>
                    <tr style="text-align: center; ">
                        <td>
                            <h1 style="font-family: 'Tangerine', cursive; font-size: 30px;font-weight: 500; margin: 0; "><?php echo ucwords($profile[0]['name']); ?></h1>

                            <span style=" border-top: 2px solid #000;width: 36%;height: 1px;display: block;margin: 0 auto;margin-top: 0px;"></span>

                            <p style="font-size: 15px;color: #0d0d0d;font-weight: 300;font-family: 'Montserrat', sans-serif;margin: 2px 0 0 0;">
                                <?php echo $certificate[0]['intro_text']; ?></p>
                           <p style="font-size: 20px;color: #2e85c1;font-family: 'Montserrat', sans-serif;font-weight: 400;margin: auto;max-width: 55%;line-height: 1;">
                                <?php echo $certificate[0]['training_title']; ?></p>
                            <p style="margin-top: 5px;font-size: 15px;font-family: 'Montserrat', sans-serif;margin-bottom: 4px;line-height: 1;">
                                <?php echo date("F d, Y", strtotime($cust_data[0]['added_on'])); ?></p>
                           <p style="color: #2e85c1;font-size: 18px;font-family: 'Montserrat', sans-serif;font-weight: 400;margin-bottom: 0;"> Mount Royal Auditorium,<br> Delaware, USA </p>
                            <!-- <p style="color: #2e85c1;font-size: 14px;font-family: 'Montserrat', sans-serif;font-weight: 400;margin-top: -7px; margin-bottom: 0;"> 
                                <?php echo $certificate[0]['location'];?></p> -->
                           <p style="margin-top: 20px;font-size: 15px;font-weight: 500;font-family: 'Montserrat', sans-serif;margin: 0 0 0 0;">
                                CE Units: <?php echo $certificate[0]['units']; ?></p>

                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
        </tr>

        <tr>
        <td>
           <table style="padding-top: 32px;width: 100%;margin-top: 11px;">
                <tbody>
                    <tr>
                        <td style="text-align: right; width: 100%; padding-right: 15px;">
                            <img src="<?php echo showimage($barcode); ?>" alt="" style="width: 50px;">
                            <p style="color: #fff; font-size: 13px; margin: 0px  0; font-family: 'Montserrat', sans-serif;">
                                Certificate Number</p>
                            <p style="color: #f2cd1f; font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;"><?php echo $cust_data[0]['certificate_id'];?></p>
                            <p style=" color: #fff; font-size: 13px; margin: 0px 0; font-family: 'Montserrat', sans-serif; ">
                                Validate this certificate at:</p>
                            <a href="#" style="color: #f2cd1f; font-size: 13px; font-family: 'Montserrat', sans-serif; ">https://ceonpoint.com/pages/cfvalidation</a>
                            
                            <p style="color: #fff; font-size: 13px; margin: 6px 0; font-family: 'Montserrat', sans-serif; line-height: 1em;">Accreditation Number</p>
                            <p style="color: #f2cd1f;font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0; line-height: 1.5em;" >CERTI987654321</p>
                            <p style=" color: #fff; font-size: 13px; margin: 15px 0 6px; font-family: 'Montserrat', sans-serif; line-height: 1em;">validate this accreditation no. at:</p>
                            <a href="#" style="color: #f2cd1e; font-size: 13px; font-family: 'Montserrat', sans-serif; line-height: 1.5em; display: block">https://ceonpoint.com/RBoard/license/search</a>
                        </td>
                        
                    </tr>
                <tr>
                <td>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>       
                               <td style="width: 78%;padding: 2px 0 19px 20px;">
                                    <table style="">
                                        <tbody>
                                            <tr>
                                            <?php for($i=0;$i<$num;$i++)
                                                    { 
                                                        if($filesarray[$i]!='')
                                                        {
                                                            $singnature[$i]  = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i];
                                                        }else{
                                                            $singnature[$i]  = ASSETS_URL.'upload/certificate/logo/no-image.png';
                                                        } ?>
                                                <td>
                                                    <div style="background-color: #ededec; border-radius: 3px; padding:0 10px 0 10px; text-align: center; margin-right: 5px;">
                                                    <img src="<?php echo showimage($singnature[$i]); ?>" alt="" style="width: 50px; height: 20px;">
                                                    <p style="margin: 0; color: #7c7c7c; font-size: 10px;"><strong><?php echo ucwords($namearray[$i]) ?></strong></p>
                                                    <p style=" margin: 0; color: #7c7c7c;font-size: 10px;"><?php echo ucwords($postionarray[$i]); ?></p>
                                                    </div>
                                                </td>
                                                <?php } ?>
                                                
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>

                                <?php  $ceonpointlogo  = ASSETS_URL.('images/certificate_images/footer-logo.png'); ?>
                                <td align="right" style=" padding-right:20px;">
                                    <img src="<?php echo showimage($ceonpointlogo); ?>" alt="" style="float: right; width: 150px;">
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
            // $imageData = base64_encode(file_get_contents($image));
            // $src = 'data:image/jpeg;base64,'.$imageData;
            $src = $image;
            return $src; } ?>

</body>
</html>

