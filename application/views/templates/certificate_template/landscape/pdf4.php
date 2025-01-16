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
    <?php // $ceonpointlogo  = ASSETS_URL.('images/certificate_images/footer-logo.png'); ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 0 auto; background-image: url(<?php echo showimage($img3); ?>); background-repeat: no-repeat;padding-top: 30px;padding-bottom: 0px; background-size:cover;">
    <tbody>
   
    <tr>
            <th>
                <table style="width: 70%;margin: 0 auto;font-family: 'Montserrat', sans-serif;margin-top: 10px;">
                    <tr>
                        <th style=" width: 20%;    text-align: center;">
                            <span  style=" display: inline-block;     vertical-align: middle; float: left;"><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 75px;"></span>
                        </th>
                        <th style="text-align: left;width: 80%;">
  
                            <span class="hesder-content" style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 19px; line-height: 21px; text-align: left;">
                                <?php echo $certificate['header_line1']; ?><?php if($certificate['header_line2']!=''){ echo $certificate['header_line2']; ?><?php }if($certificate['header_line3']!=''){ echo $certificate['header_line3']; } ?></span>
                        </th>
                       <th style="width: 20%; text-align: center;">
                            <?php if($certificate['logo2']!=''){ ?>
                                <span class="images" style=" display: inline-block; vertical-align: middle; text-align:center float: right;"><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 75px;">
                                </span>
                            <?php }?>
                        </th>
                    </tr>
                </table>
            </th>

        </tr>
        <tr>
            <td>
               <table style="width: 250px; margin: 0 auto;margin-top: 10px; text-align: center;">

                     <tr>
                        <td><img src="<?php echo showimage($text_certificate); ?>" style=" width: 100%; "></td>

                    </tr>
					 <tr>
							<td>
                <h1
                    style=" color: #dd8827; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;    margin:5px 0 10px 0; font-size:16px;">
                    <?php echo $certificate['title']; ?></h1>
            </td>
					</tr>

                </table>
            </td>

        </tr>
       <tr>
			<td>    
				<table style="width: 100%;">
					<tbody>
						 <tr style="text-align: center;">
            <td>
                <h1 style="font-family: 'Tangerine'; font-size: 22px;font-weight: 700; margin: 0 0 0 0; line-height: 7px; "><?php echo ucwords($certificate['user_name']); ?></h1>
                <span
                    style="border-top: 1px dotted #d2d2d2;width: 60%;height: 1px;display: block;margin: 0 auto;margin-top: 10px;"></span>

                <p
                    style=" font-size: 13px;color: #0d0d0d; margin-top: 5px; margin-bottom: 5px; font-weight: 500; font-family: 'Montserrat', sans-serif;"><?php echo $certificate['intro_text']; ?></p>
                <p
                    style="font-size: 15px;color: #2e85c1; margin-top: 0px; margin-bottom: 5px; font-family: 'Montserrat', sans-serif; font-weight: 600;"><?php echo $certificate['training_title']; ?></p>
                <p style=" margin-top: 0px; margin-bottom: 5px; font-size: 13px; font-family: 'Montserrat', sans-serif;"><?php echo date('F d, Y',strtotime($cust_data['added_on'])); ?></p>
                <!-- <?php if(!empty( $owner['address'])){ ?>
                    <p style=" color: #2e85c1;  font-size: 15px;  margin-top: 0px; margin-bottom: 5px; font-family: 'Montserrat', sans-serif; font-weight: 600;"><?php echo $owner['address']; ?>,</p><?php }else{echo'<br><br><br>';}?> -->
                <p 
                    style=" color: #2e85c1; font-size: 15px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: 0px; margin-bottom: 5px;"><?php echo $owner['location'];?></p>
                <p style=" margin-top: 0px; font-size: 15px; font-weight: 600; font-family: 'Montserrat', sans-serif; margin-bottom: 5px;">
                    CE Units: <?php echo $course_details['units']; ?></p>
                </div>
            </td>
        </tr>
						<tr>
            <td>
                <table style="margin: 0 auto; margin-top: 0px;">
                    <tr>
                        <?php for($i=0;$i<$num;$i++){ 
                           $sugnature[$i] = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>
                        <td
                            style="/* background-color: #ededec; */ padding: 6px 25px;margin-right: 10px;text-align: center;border-radius: 5px;">
                            <img src="<?php echo showimage($sugnature[$i]); ?>" alt="signature" style=" width: 50px;">
                             <strong>
							 <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;"><?php echo ucwords($namearray[$i]) ?></p></strong>
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
                width: 95%; margin: 0 0; padding-top: 95px; padding-bottom: 23px; padding-left:40px; margin-top:0px; ">
                <tr>
                        <td style="text-align: left;width: 60%; padding-left:30px"> 
                            <img src="<?php echo showimage($ceonpointlogo); ?>" style="width: 150px;">
                            <?php //if($has_acc == true){ ?>
                            <?php if(1){ ?>
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
							<td>
								 <img src="<?php echo showimage($ceonpointlogo); ?>" style=" padding-top: 19px;     width: 150px; "> 
                            <p
                                style="color: #000; font-size: 14px; margin:40px 0 0px 0; font-family: 'Montserrat', sans-serif;">
                                validate this certificate at:</p>
                            <a href="#"
                                style=" padding:0; color: #f2cd1e; font-size:  14px; font-family: 'Montserrat', sans-serif; ">https://ceonpoint.com/index.php/pages/cfvalidation</a>
							</td>
						</tr>
						</table>
                   
                        </td>
                        <td style="text-align: right; width: 40%;">
					
						
						
						
                            <img src="<?php echo showimage($barcode); ?>" alt="barcode" style=" width: 50px">
                            <p
                                style="color: #f2cd1f; font-size: 14px; margin: 0px 0; font-family: 'Montserrat', sans-serif;">
                                Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 14px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;"><?php echo $cust_data['certificate_id'];?></p>
                        </td>
                    </tr> -->
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

