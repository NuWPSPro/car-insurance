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
    <?php  $namearray = explode('##', $certificate['name']);
        $postionarray = explode('##', $certificate['position']);
        $filesarray = explode('##', $certificate['signature']);
        $num = count($namearray);
        $logo1 = ASSETS_URL.'upload/certificate/logo/'.$certificate['logo1']; 
        $logo2 = ASSETS_URL.'upload/certificate/logo/'.$certificate['logo2'];
        $ceonpointlogo = ASSETS_URL.('images/certificate_images/Logoblue.jpg');
        $barcode = ASSETS_URL.'images/uploads/'.$cust_data['barcode']; 
        if(empty($certificate['bg_image'])){
            $img3 = ASSETS_URL.('images/certificate_images/portrait-certificate.jpg'); 
            $text_certificate = ASSETS_URL.('images/certificate_images/baner-logo2.png');
        }else{
            $img3 = ASSETS_URL.('upload/certificate_templete/'.$certificate['bg_image']); 
            $text_certificate = ASSETS_URL.('upload/certificate_templete/'.$certificate['text_image']);
        } ?>
 <table width="100%" align="center" border="0" style="background: url(<?php echo showimage($img3); ?>); background-repeat: no-repeat; background-size:cover;">
    <tbody>
    <tr>
        <td>
            <table style="margin: 0 0;text-align: center;font-family: 'Montserrat', sans-serif;width: 90%;">
                <tbody>
                <tr>
				<td width="25%"></td>
                    <td style="padding-top: 30px; width: 60%; ">
                        <span style="color: #0d0d0d; font-weight: 600; font-size: 16px; margin-right: 0; margin-top: 10;    line-height: 21px; width: 100%; text-align: center;"><?php echo $certificate['header_line1']; if($certificate['header_line2']!=''){ echo $certificate['header_line2']; }if($certificate['header_line3']!=''){ echo $certificate['header_line3']; } ?></span>
                        <table style="margin: 0 auto;margin-top: 36px;">
                            <tr>
							
                                <td style="margin-top: 0px; text-align: left; width: 100%;">
                                    <img src="<?php echo showimage($text_certificate); ?>"style="width: 250px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h1 style="color: #2e85c1; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;   font-size: 16px;    margin-top: 6px;"> <?php echo $certificate['title']; ?></h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="font-weight: 600; color: #000; width: 10%; text-align: right; padding-right: 10px; padding-top: 10px;">
                        <span class="images"><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 60px; margin-bottom: 10px;"></span><br> 
                        <?php if($certificate['logo2']!=''){ ?>
                        <span class="images"><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 60px;"></span><?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>

    <tr>
        <td>    
            <table style="text-align: center;width: 90%;margin-left: 25px;margin-top: 7px;  margin:0 auto;">
                <tbody>
                    <tr style="text-align: center; ">
                       <td>
                <h1 style="font-family: 'Tangerine'; font-size: 20px;font-weight: 700; margin: 0 0 0 0; line-height: 0px; "><?php echo ucwords($certificate['user_name']); ?></h1>
                <span
                    style="border-top: 1px dotted #d2d2d2;width: 60%;height: 1px;display: block;margin: 0 auto;margin-top: 10px;"></span>

                <p
                    style=" font-size: 13px;color: #0d0d0d; margin-top: 5px; margin-bottom: 5px; font-weight: 500; font-family: 'Montserrat', sans-serif;"><?php echo $certificate['intro_text']; ?></p>
                <p
                    style="font-size: 15px;color: #2e85c1; margin-top: 0px; margin-bottom: 5px; font-family: 'Montserrat', sans-serif; font-weight: 600;"><?php echo $certificate['training_title']; ?></p>
                <p style=" margin-top: 0px; margin-bottom: 5px; font-size: 13px; font-family: 'Montserrat', sans-serif;"><?php echo date('F d, Y',strtotime($cust_data['added_on'])); ?></p>
                <!-- <?php if(!empty($owner['address'])){ ?>
                <p style=" color: #2e85c1;  font-size: 15px;  margin-top: 0px; margin-bottom: 5px; font-family: 'Montserrat', sans-serif; font-weight: 600;"><?php echo $owner['address']; ?>,</p><?php }else{echo'<br><br><br>';}?> -->
                <p
                    style=" color: #2e85c1; font-size: 15px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: 0px; margin-bottom: 5px;"><?php echo $certificate['location'];?></p>
                <p style=" margin-top: 0px; font-size: 15px; font-weight: 600; font-family: 'Montserrat', sans-serif; margin-bottom: 5px;">
                    CE Units: <?php echo $course_details['units']; ?></p>
                </div>
            </td>
						
                    </tr>
					 <tr>
            <td>
                <table align="center" style="width: 100px; margin-top: 10px; margin-bottom: 0px; align: center;">
                    <tr>
                        <?php for($i=0;$i<$num;$i++){
							 $singnature[$i]  = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>
                        <td
                            style="background-color: #ededec;padding: 2px 10px;margin-right: 10px;text-align: center; border-right: 10px solid #fff;border-radius: 5px;">
                            <img src="<?php echo showimage($singnature[$i]); ?>" style=" width: 50px;">
                             <strong><p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;"><?php echo ucwords($namearray[$i]) ?></p></strong>
                            <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;"><?php echo ucwords($postionarray[$i]); ?></p>

                        </td>
						
						
                        <?php } ?>
                    </tr>

                </table>
            </td>
        </tr>
                </tbody>
            </table>
        </td>
    </tr>
    
    <tr>
         <td>
                <table style="
                width: 95%; margin: 0 0 0 30px; padding-top: 91px; padding-bottom: 0px;">
                    <tr>
                        <td style="text-align: left;width: 60%;"> 
                            <img src="<?php echo showimage($ceonpointlogo); ?>" style="width: 150px;">
                            <?php if($has_acc == true){ ?>
                            <?php //if(1){ ?>
                            <p
                                style="font-size: 14px; margin: 2px 0 0; font-family: 'Montserrat', sans-serif; line-height: 1em;">
                                Accreditation Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0; line-height: 1.5em;" ><?=$acc_number; ?></p>
                            <p
                                style="font-size: 13px; margin: 2px 0 0; font-family: 'Montserrat', sans-serif; line-height: 1em;">validate this accreditation no. at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 14px; font-family: 'Montserrat', sans-serif; line-height: 1.5em;">https://ceonpoint.com/RBoard/license/search</a>
                            <?php }else{ echo '<br/><br/><br/>...'; } ?>
                        </td>
                        <td style="text-align: right; width: 40%;">
                        <img src="<?php echo showimage($barcode); ?>" style="width: 50px;">
                            <p
                                style="font-size: 14px; margin: 2px 0 0; font-family: 'Montserrat', sans-serif; line-height: 1em;">Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0; line-height: 1.5em;" ><?php echo $cust_data['certificate_id'];?></p>
                                <p
                                style="font-size: 13px; margin: 2px 0 0; font-family: 'Montserrat', sans-serif; line-height: 1em;">
                                validate this certificate at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 14px; font-family: 'Montserrat', sans-serif; line-height: 1.5em;"> https://ceonpoint.com/pages/cfvalidation</a>
                        </td>
                    </tr>
                     <!-- <tr>
                        <td style="text-align: left;width: 60%;">
						<table>
						<tr>
							<td style="padding-bottom: 20px;">
								 <img src="<?php echo showimage($ceonpointlogo); ?>" style=" padding-top: 0px;     width: 150px;     margin-left: -20px;">
                            <p
                                style="color: #000; font-size: 13px; margin:20px 0 0px 0; font-family: 'Montserrat', sans-serif;line-height: 1em;">
                                validate this certificate at:</p>
                            <a href="#"
                                style=" padding:0; color: #f2cd1e; font-size:  13px; font-family: 'Montserrat', sans-serif; line-height: 1.5em;">https://ceonpoint.com/index.php/pages/cfvalidation</a>
							</td>
						</tr>
						</table>
                   
                        </td>
                        <td style="text-align: right; width: 40%; padding-top: 0px;padding-bottom: 10px;">
						
                            <img src="<?php echo showimage($barcode); ?>" alt="barcode" style=" width: 50px; margin-top: 10px;margin-right: 5px;">
                            <p
                                style="color: #f2cd1f; font-size: 13px; margin: 10px 0 0 0; font-family: 'Montserrat', sans-serif; line-height: 1em;">
                                Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0; line-height: 1.5em;"><?php echo $cust_data['certificate_id'];?></p>
                        </td>
                    </tr> -->
                </table>
            </td>
    </tr>      
                       
    </tbody>                    
    </table> 

    <?php 
        function showimage($image){
            $type = pathinfo($image, PATHINFO_EXTENSION);
            $data = file_get_contents($image);
            $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $logo;
        } ?>

</body>
</html>

