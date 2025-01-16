<?php
$namearray = explode('##', $certificate[0]['name']);
$postionarray =  explode('##', $certificate[0]['position']);
$filesarray = explode('##', $certificate[0]['signature']);
$num = count($namearray); ?>
<?php  $img3 = ASSETS_URL.('images/certificate_images/blue-bg-temp.jpg'); ?>
<?php  $logo1 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1']; ?>
<?php  $logo2 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2']; ?>
<?php $bannerimg = ASSETS_URL.('images/certificate_images').'/baner-logo2.png'; ?>
<?php $ceonpointlogo = ASSETS_URL.('images/certificate_images/footer-logo.png');?>
<?php $barcode = ASSETS_URL.'images/uploads/'.$exam_details[0]['barcode']; 
?>
<table style="width:100%; min-height: 100vh; background-image: url(<?php echo showimage($img3); ?>); background-repeat: no-repeat; background-size: 100% 100%;">
		<tr>
			<td>
				<table
					style=" width:75%;margin:20px auto 0;text-align: center;font-family: 'Montserrat', sans-serif; ">
					<tr>
						<th><span class="images"
								style=" display: inline-block; vertical-align: middle; float: left; "><img
									src="<?php echo showimage($logo1); ?>" alt=""
									style="width:25px;"></span></th>
						<th><span class="hesder-content"
								style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 11px;padding-top: 15px;"><?php echo $certificate[0]['header_line1']; ?><br>
                            <?php if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2']; ?><br>
                            <?php }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span></th>
						<th>
						<?php if($certificate[0]['logo2']!=''){ ?>
                            <span class="images"
								style=" display: inline-block; vertical-align: middle; float: right;"><img
									src="<?php echo showimage($logo2); ?>" alt=""
									style="width:25px;"></span>
								
                            <?php }?></th>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td>
				<table style="width:60%;margin: 0 auto;margin-top: 6px;">
					<tr>
						<td><img src="<?php echo showimage($bannerimg); ?>" alt=""
								style=" width: 100%; "></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td>
				<h1
					style=" color: #dd8827; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;font-size: 12px;margin:10px 0 5px;">
					<?php echo $certificate[0]['title']; ?></h1>
			</td>
		</tr>

		<tr style="text-align: center;">
			<td>
				<h1
					style="font-family: 'Tangerine', cursive; font-size:16px;font-weight: 700; margin: 0; ">
					<?php echo ucwords($profile[0]['name']); ?></h1>
				<span
					style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top:10px;"></span>

				<p
					style=" font-size: 12px;color: #0d0d0d; margin-top: 10px;margin-bottom: 0; font-weight: 500; font-family: 'Montserrat', sans-serif;">
					<?php echo $certificate[0]['intro_text']; ?></p>
				<p
					style="font-size: 12px;color: #2e85c1; margin-top:3px;margin-bottom: 10px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
					<?php echo $certificate[0]['course_title']; ?></p>
				<p
					style=" margin: 5px 0 0; font-size: 12px; font-family: 'Montserrat', sans-serif;">
					<?php echo date('F d, Y',strtotime($certificate[0]['added_at'])); ?></p>
				<p
					style=" color: #2e85c1;  font-size:12px;  margin:3px 0 0; font-family: 'Montserrat', sans-serif; font-weight: 600;">
					<?php echo $ceprovider[0]['address']; ?>, </p>
				<p
					style=" color: #2e85c1; font-size: 12px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin:0px;">
					<?php echo $ceprovider[0]['state']; ?>, <?php echo $ceprovider[0]['location']; ?></p>
				<p
					style=" margin-top:5px; font-size: 13px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
					CE Units: <?php echo $course[0]['units']; ?></p>

			</td>
		</tr>

		<tr>
			<td>
				<table style="width:100%; margin: 0 auto; margin-top:0px; margin-bottom: 60px;">
					<tr	style="padding: 0 20px 10px 10px;display: flex;align-items: center;justify-content: center;">

					  <?php 
					for($i=0;$i<$num;$i++){ ?>
                            <?php $signautreimg[$i] = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; 
							?>
						<td	style="background-color: #ededec;padding: 12px 5px;margin-left: 10px;width: 50%;text-align: center;">

							<img src="<?php echo showimage($signautreimg[$i]); ?>" alt=""
								style=" width: 57px;">
							<p
								style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 12px;">
								<?php  echo ucwords($namearray[$i]) ?></p>
							<p
								style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 11px;">
								<?php  echo $postionarray[$i] ; ?> </p>
						</td>

						
						<?php
						 	if($i==1)
							{
							?>
					
					</tr>
					<tr	style="padding: 0 20px 10px 10px;display: flex;align-items: center;justify-content: center;">
							<?php }  ?>
					
					 <?php }  ?>
					 </tr>

			
				</table>
			</td>
		</tr>

		<tr>
			<td>
				<table style="width: 100%; padding-top: 30px; padding-bottom: 38px; ">
					<tr>
						<td style="text-align: left;padding: 0px 5px 15px;">
							<img src="<?php echo showimage($ceonpointlogo); ?>" alt=""
								style="width:150px;">
							<p
								style=" color: #fff; font-size: 13px; margin: 5px 0; font-family: 'Montserrat', sans-serif; ">
								validate this certificate at:</p>
							<a href="#" style="color: #f2cd1e; font-size: 12px; font-family: 'Montserrat', sans-serif;line-height: 17px;width: 150px;word-break: break-all;display: block;">
								https://ceonpoint.com/index.php/pages/cfvalidation</a>
						</td>
						<td style="text-align: right;padding: 0px 5px 15px;">
							<img src="<?php echo showimage($barcode); ?>" alt="" style=" width: 50px">
							<p
								style="color: #fff; font-size: 12px; margin:6px 0; font-family: 'Montserrat', sans-serif;">
								Certificate Number</p>
							<p
								style="color: #f2cd1f;font-size: 12px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;">
								<?php echo $exam_details[0]['certificate_id'];?></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>


<?php 

/* function showimage($image){
$imageData = base64_encode(file_get_contents($image));
$src = 'data:image/jpeg;base64,'.$imageData;
return $src;
} */

 function showimage($image){

return $image;
} 
?>