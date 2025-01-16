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
    <?php  $namearray = explode('##', $certificate[0]['name']);
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
        $ceonpointlogo  = ASSETS_URL.('images/certificate_images/Logoblue.jpg'); ?>
 <table width="100%" align="center" border="0" style="background: url(<?php echo showimage($img3); ?>); background-repeat: no-repeat;background-size: 100%;">
    <tbody>
    <tr>
        <td>
            <table style="margin: 0 auto;text-align: center;font-family: 'Montserrat', sans-serif;width: 89%;">
                <tbody>
                <tr>
				<td width="25%"></td>
                    <td style="padding-top: 40px; width: 55%; ">
                        <span style="color: #0d0d0d; font-weight: 600; font-size: 13px; margin-right: 0; margin-top: 10;    line-height: 21px; width: 100%; text-align: center;"><?php echo $certificate[0]['header_line1']; if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2']; }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span>
                        <table style="margin: 0 auto;margin-top: 10px;">
                            <tr>
							
                                <td style="margin-top: 15px; text-align: left; width: 100%;">
                                    <img src="<?php echo showimage($text_certificate); ?>"style="width: 261px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h1 style="color: #2e85c1; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;  margin: 0; font-size: 16px;    margin-top: 6px;"> <?php echo $certificate[0]['title']; ?></h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="font-weight: 600; color: #000; width: 20%; text-align: right; padding-right: 10px; padding-top: 17px;">
                        <span class="images"><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 65px; margin-bottom: 2px;"></span><br> 
                        <?php if($certificate[0]['logo2']!=''){ ?>
                        <span class="images"><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 65px;"></span><?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>

    <tr>
        <td>    
            <table style="text-align: center;width: 90%;margin-left: 18px;margin-top: 7px;  margin:0 auto;">
                <tbody>
                    <tr style="text-align: center;">
                        <td>
                            <h1 style="font-family: 'Tangerine'; font-size: 30px;font-weight: 700; margin: 0 0 0 0; line-height: 7px; padding-top: 25px;"><?php echo ucwords($profile[0]['name']); ?></h1>
                            
                            <span style="border-top: 1px dotted #d2d2d2;width: 60%;height: 1px;display: block;margin: 0 auto;margin-top: 15px;"></span>

                            <p style="font-size: 15px;color: #0d0d0d;margin-top: 0px;margin-bottom: 0px;font-weight: 500;font-family: 'Montserrat', sans-serif;"><?php echo $certificate[0]['intro_text']; ?></p>
                                
                            <p style="font-size: 15px;color: #2e85c1;margin-top: 0px;font-family: 'Montserrat', sans-serif;font-weight: 600;margin-bottom: 0;"><?php echo $certificate[0]['training_title']; ?></p>
                        
                            <p style=" color: #2e85c1;  font-size: 15px;  margin-top: 0px; margin-bottom: 0px; font-family: 'Montserrat', sans-serif; font-weight: 600;">Mount Royal Auditorium, Delaware, USA </p>
                            
                            <p style=" margin-top: 0px; font-size: 15px; font-weight: 600; font-family: 'Montserrat', sans-serif; margin-bottom: 0px;"> CE Units: <?php echo $certificate[0]['units']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table align="center" style="border-radius: 3px; padding-top: 80px;margin-top: 10px;">
                <tr>
                    <?php for($i=0;$i<$num;$i++){
                         $singnature[$i]  = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>
                    <!-- <div style="background-color: #ededec; border-radius: 3px; padding:0 10px 0 10px; text-align: center; margin-right: 5px;"> -->
                    <td style="background-color: #ededec; padding: 5px 17px; margin-right: 10px; text-align: center; border-radius: 5px; display:inline-block;">
                        <img src="<?php echo showimage($singnature[$i]); ?>" style=" width: 45px;">
                         <strong><p style="margin: 0; margin-top: 0px; color: #7c7c7c; font-size: 12px;"><?php echo ucwords($namearray[$i]) ?></p></strong>
                        <p style=" margin: 0; margin-top: 0px;color: #7c7c7c;font-size: 10px;"><?php echo ucwords($postionarray[$i]); ?></p>
                    </td>
                   <!--  </div> -->
                    <?php } ?>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
         <td>
                <table style="width: 93%; margin: 0 auto; margin-top: 21px; margin-bottom: 24px;">
                    <tr>
                        <td style="text-align: left;width: 50%;">
                            <img src="<?php echo showimage($ceonpointlogo); ?>" style="width: 200px;height: 55px;object-fit: contain;">
                            <p
                                style="font-size: 14px; margin: 6px 0; font-family: 'Montserrat', sans-serif; line-height: 1em;">
                                Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0; line-height: 1.5em;" ><?php echo $cust_data[0]['certificate_id'];?></p>
                            <p
                                style="font-size: 13px; margin: 7px 0 6px; font-family: 'Montserrat', sans-serif; line-height: 1em;">
                                validate this certificate at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 14px; font-family: 'Montserrat', sans-serif; line-height: 1.5em; display: block">https://ceonpoint.com/pages/cfvalidation</a>
                        </td>
                        <td style="text-align: right; width: 50%;">
                        <img src="<?php echo showimage($barcode); ?>" style="width: 55px;height: 55px;object-fit: contain;">
                            <p
                                style="font-size: 14px; margin: 6px 0; font-family: 'Montserrat', sans-serif; line-height: 1em;">Accreditation Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0; line-height: 1.5em;" >CERTI987654321</p>
                                <p
                                style="font-size: 13px; margin: 7px 0 6px; font-family: 'Montserrat', sans-serif; line-height: 1em;">validate this accreditation no. at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 14px; font-family: 'Montserrat', sans-serif; line-height: 1.5em; display: block">https://ceonpoint.com/RBoard/license/search</a>
                        </td>
                        <!-- <td style="text-align: left;width: 60%;">
						<table>
						<tr>
							<td style="padding-top: 18px;padding-bottom: 5px;">
								 <img src="<?php echo showimage($ceonpointlogo); ?>" style=" padding-top: 0px;     width: 150px;     margin-left: -8px;">
                            <p
                                style="color: #000; font-size: 13px; margin:10px 0 0px 0; font-family: 'Montserrat', sans-serif;line-height: 1em;">
                                validate this certificate at:</p>
                            <a href="#"
                                style=" padding:0; color: #f2cd1e; font-size:  13px; font-family: 'Montserrat', sans-serif; line-height: 1.5em;">https://ceonpoint.com/index.php/pages/cfvalidation</a>
							</td>
						</tr>
						</table>
                   
                        </td> -->
                        <!-- <td style="text-align: right; width: 40%; padding-top: 0px;padding-bottom: 10px;">
						
                            <img src="<?php echo showimage($barcode); ?>" alt="barcode" style=" width: 50px; margin-top: -8px;">
                            <p
                                style="color: #f2cd1f; font-size: 13px; margin: 0px 0; font-family: 'Montserrat', sans-serif; line-height: 1em;">
                                Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0; line-height: 1.5em;"><?php echo $cust_data[0]['certificate_id'];?></p>
                        </td> -->
                    </tr>
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

