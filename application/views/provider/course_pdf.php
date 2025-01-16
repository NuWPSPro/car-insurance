<!DOCTYPE html>

<html lang="en">



    <head>

            <meta charset="utf-8">

            <title>Online Course Details</title>

		    <link rel="icon" href="<?php echo ASSETS_URL.'images/favicon.png'; ?>" type="image/x-icon">

		    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

            <script src="<?php echo ASSETS_URL.'js/jquery.min.js'; ?>"></script>

    		<script src="<?php echo ASSETS_URL.'js/bootstrap.min.js'; ?>"></script>

		    <link rel="stylesheet" href="<?php echo ASSETS_URL.'css/font-awesome.min.css';?>" type="text/css">

		    <link rel="stylesheet" href="<?php echo ASSETS_URL.'css/bootstrap.min.css';?>" type="text/css">

            <style type="text/css">

            @font-face {

              font-family: 'Tangerine';

              font-style: normal;

              src: local('Tangerine Bold'), local('Tangerine-Bold'), url(<?php echo ASSETS_URL.'fonts/Tangerine-Bold.ttf'?>) format('truetype');

            }

			.card table {

					margin: 0 auto;

					width: 100% !important;

				}

			</style>

    </head>



    <body>

    <?php $course_image = ASSETS_URL.'images/uploads/'.$details->course_photo; ?>

  	<div class="container">

  		<h2 style="padding-bottom: 20px;">Online Course Details <a href="<?php echo base_url('provider/genrate_pdf/').$details->id.'/'.$details->user_id; ?>" class="btn btn-primary pull-right">Download PDF</a>

  			<a href="<?php echo base_url('provider/course_listing'); ?>" class="btn btn-info pull-right">Back</a></h2>

  		<div class="row">

	  		<div class="card">

				<div class="card-header text-center">

					<img src="<?php echo showimage($course_image); ?>" height="100" width="100">

				</div>

				<div class="card-body">

					<h3 class="card-title mb-3" style="padding-bottom: 20px;"> 

			            1. Course Overview

			        </h3>

		            <table class="table table-bordered" style="width:700px ">
					
		            	<tbody>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Course Title</th>

		            			<td  style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo  $details->course_title; ?></td>

		            		</tr>

		            		<!-- <tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Unit/s</th>

		            			<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo  $details->units; ?></td>

		            		</tr> -->

		            		<!-- <tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Price (with tax)</th>

		            			<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo  $details->total; ?></td>

		            		</tr>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Course Accreditation Number</th>

		            			<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo  isset($details->acceditation_no)?$details->acceditation_no:'--'; ?></td>

		            		</tr>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Course Validity</th>

		            			<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo  date('F d,Y',strtotime($details->course_validity)); ?></td>

		            		</tr> -->

		            		<tr style="text-align: left;">
							<?php 
							$professionArr = $details->profession;

							$profession = $this->db->where_in('id',$professionArr)->get('tbl_category')->result_array();
							$nameOfprofession = array_column($profession,'cat_name');
							$allprofession = implode(',',$nameOfprofession);
							?>
		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Other professions who can use this course</th>

		            			<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo $allprofession; ?></td>

		            		</tr>

		            		<!-- <tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Course Video</th>

		            			<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo isset($details->video)?$details->video:'--'; ?></td>

		            		</tr> -->

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Course Description</th>

		            			<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo $details->course_description; ?></td>

		            		</tr>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Course Objectives</th>

		            			<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo $details->objective; ?></td>

		            		</tr>

		            	</tbody>

		            </table>

		        </div>



		    </div>

	    </div>



  		<div class="row">

	  		<div class="card">

				<div class="card-body">

					<h3 class="card-title" style="padding-bottom: 20px;">

			            2. Course Lessons

			        </h3>

			        <?php if(!empty($lessons)){ ?>

		            <table class="table table-bordered">

		            	<thead>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:5%; text-align: left; padding: 8px 10px;">S.no.</th>

		            			<th style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;">Lesson Title</th>

		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Lessons Content</th>

		            			<th style="border: 1px solid #f1f1f1; width:20%; text-align: left; padding: 8px 10px;">Lesson Video Url</th>

		            			<th style="border: 1px solid #f1f1f1; width:15%; text-align: left; padding: 8px 10px;">Lesson Case Study</th>

		            			</tr>

		            	</thead>

		            	<tbody>

		            	<?php  $count = 1;

		            		foreach ($lessons as $key => $value){ ?>

		            		<tr style="text-align: left;">

		            			<td style="border: 1px solid #f1f1f1; width:5%; text-align: left; padding: 8px 10px;"><?php echo $count; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;"><?php echo $value->lesson_title; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo $value->lesson_content; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:20%; text-align: left; padding: 8px 10px;"><?php echo ($value->lesson_video!='')?$value->lesson_video:'--'; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:15%; text-align: left; padding: 8px 10px;"><?php echo ($value->case_study !='')?$value->case_study:'--'; ?></td>

		            		</tr>

		            	<?php $count++; }  ?>

		            	</tbody>

		            </table>

		            <table class="table table-bordered" style="padding-top: 5px;">
		            	<tbody>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:15%; text-align: left; padding: 8px 10px;">Summary</th>

		            			<td style="border: 1px solid #f1f1f1; width:85%; text-align: left; padding: 8px 10px;"><?php echo  $lessons[0]->summary; ?></td>

		            		</tr>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:15%; text-align: left; padding: 8px 10px;">References</th>

		            			<td style="border: 1px solid #f1f1f1; width:85%; text-align: left; padding: 8px 10px;"><?php echo  $lessons[0]->course_references; ?></td>

		            		</tr>

		            	</tbody>

		            </table>

		        <?php } else{ echo '<b>No data Found!</b>'; } ?>

		        </div>



		    </div>

	    </div>



    	<div class="row">

	  		<div class="card">

				<div class="card-body">

					<h3 class="card-title" style="padding-bottom: 20px;">

			            3. Course Question Paper

			        </h3>



		            <table class="table table-bordered" style="padding-bottom: 5px;">

		            	<tbody>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:15%; text-align: left; padding: 8px 10px;">Quiz Note</th>

		            			<td style="border: 1px solid #f1f1f1; width:85%; text-align: left; padding: 8px 10px;"><?php echo($details->course_exam_note != '')?$details->course_exam_note:'--'; ?></td>

		            		</tr>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;">Quiz Retake</th>

		            			<td style="border: 1px solid #f1f1f1; width:85%; text-align: left; padding: 8px 10px;"><?php echo ($details->quiz_retek != '')?$details->quiz_retek:'--'; ?></td>

		            		</tr>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:15%; text-align: left; padding: 8px 10px;">Passing Mark</th>

		            			<td style="border: 1px solid #f1f1f1; width:85%; text-align: left; padding: 8px 10px;"><?php echo ($details->passing_marks!='')?$details->passing_marks:'--'; ?></td>

		            		</tr>

		            	</tbody>

		            </table>



		            <table class="table table-bordered">

		            	<thead>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:5%; text-align: left; padding: 8px 10px;">S.no.</th>

		            			<th style="border: 1px solid #f1f1f1; width:20%; text-align: left; padding: 8px 10px;">Question</th>

		            			<th style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;">Option 1</th>

		            			<th style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;">Option 2</th>

		            			<th style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;">Option 3</th>

		            			<th style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;">Option 4</th>

		            			<th style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;">Answer</th>

		            			<th style="border: 1px solid #f1f1f1; width:25%; text-align: left; padding: 8px 10px;">Rationale</th>

		            			</tr>

		            	</thead>

			        <?php if(!empty($question)){ ?>

		            	<tbody>

		            	<?php  $count = 1;

		            		foreach ($question as $key => $value){ 

		            			if($value->correct_answere=='1'): $correct_answere = $value->answere1; 
								elseif($value->correct_answere=='2'): $correct_answere = $value->answere2; 
								elseif($value->correct_answere=='3'): $correct_answere = $value->answere3; 
								elseif($value->correct_answere=='4'): $correct_answere = $value->answere4; 
								else: $correct_answere = '--'; 
								endif; ?>

		            		<tr style="text-align: left;">

		            			<td style="border: 1px solid #f1f1f1; width:5%; text-align: left; padding: 8px 10px;"><?php echo $count; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;"><?php echo $value->question_title; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;"><?php echo $value->answere1; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;"><?php echo $value->answere2; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;"><?php echo $value->answere3; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;"><?php echo $value->answere4; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;"><?php echo $correct_answere; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;"><?php echo ($value->rational!='')?$value->rational:'--'; ?></td>

		            		</tr>

		            	<?php $count++; }  ?>

		            	</tbody>

		        	<?php } else{ echo '<tr><td colspan="8">No data Found!</td></tr>'; } ?>

		            </table>

		        </div>

		    </div>

	    </div>



	    <div class="row">

	  		<div class="card">

				<div class="card-body">

					<h3 class="card-title" style="padding-bottom: 20px;">

			            4. Course Evaluation

			        </h3>

			        

		            <table class="table table-bordered" style="padding-bottom: 5px;">

		            	<tbody>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:15%; text-align: left; padding: 8px 10px;">Evaluation Note</th>

		            			<td style="border: 1px solid #f1f1f1; width:85%; text-align: left; padding: 8px 10px;"><?php echo($details->course_evaluation_note !='')?$details->course_evaluation_note:'--'; ?></td>

		            		</tr>

		            	</tbody>

		            </table>



		            <table class="table table-bordered">

		            	<thead>

		            		<tr style="text-align: left;">

		            			<th style="border: 1px solid #f1f1f1; width:15%; text-align: left; padding: 8px 10px;">S.no.</th>

		            			<th style="border: 1px solid #f1f1f1; width:45%; text-align: left; padding: 8px 10px;">Evaluation Type</th>

		            			<th style="border: 1px solid #f1f1f1; width:40%; text-align: left; padding: 8px 10px;">Evaluation Question</th>

		            		</tr>

		            	</thead>

			        <?php if(!empty($evaluation)){ ?>

		            	<tbody>

		            	<?php  $count = 1;

		            		foreach ($evaluation as $key => $value){ 

		            			if($value->evaluation_type=='1'){ $type = 'Star Rating Question'; }elseif($value->evaluation_type=='2'){ $type = 'Text Answer Question'; }else{ $type = '--';} ?>

		            		<tr style="text-align: left;">

		            			<td style="border: 1px solid #f1f1f1; width:15%; text-align: left; padding: 8px 10px;"><?php echo $count; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:45%; text-align: left; padding: 8px 10px;"><?php echo $type; ?></td>

		            			<td style="border: 1px solid #f1f1f1; width:40%; text-align: left; padding: 8px 10px;"><?php echo $value->evaluation_question; ?></td>

		            		</tr>

		            	<?php $count++; }  ?>

		            	</tbody>

		        	<?php } else{ echo '<tr><td colspan="5">No data Found!</td></tr>'; } ?>

		            </table>

			    </div>

			</div>

		</div>


	    <div class="row  pb-5">

	  		<div class="card">

				<div class="card-body">

					<h3 class="card-title" style="padding-bottom: 20px;">

			            5. Course Certificate

			        </h3>

			        <div><?php if(!empty($certificate)){ ?>

			        	<?php $certificate = ASSETS_URL.'upload/certificate_templete/'.$certificate->temppreview; ?>

			        		<img src="<?php echo showimage($certificate); ?>" width="750">

			        	<?php }else{ echo 'No data Found!'; } ?>

			        </div>

			    </div>

			</div>

		</div>

		<?php if($author != ''):  ?>
	    <div class="row pb-5">

	  		<div class="card">

				<div class="card-body">

					<h3 class="card-title" style="padding-bottom: 20px;">

			            6. Author's Details

			        </h3>
					
					<table class="table table-bordered" style="width:700px ">
						<tbody>

							<tr style="text-align: left;">

								<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Author's Name</th>

								<td  style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo  $author[0]['name']; ?></td>

							</tr>
							<tr style="text-align: left;">

								<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Author's Email</th>

								<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo $author[0]['username_email']; ?></td>

							</tr>

							<tr style="text-align: left;">
								<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Professions</th>

								<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo $author[0]['profession']; ?></td>

							</tr>

							<tr style="text-align: left;">
								<?php $countryname = $this->db->get_where('countries',array('countries_id'=>$author[0]['country']))->row()->countries_name; ?>
								<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Country </th>

								<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo $countryname; ?></td>

							</tr>

							<tr style="text-align: left;">

								<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Registered Date</th>

								<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo $author[0]['added_on']; ?></td>

							</tr>

							<tr style="text-align: left;">

								<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Validity</th>

								<td style="border: 1px solid #f1f1f1; width:70%; text-align: left; padding: 8px 10px;"><?php echo $author[0]['licence_validity']; ?></td>

							</tr>


						</tbody>

					</table>
			    </div>

			</div>

		</div>
		<?php endif; ?>

	                

    </div>



	<?php  function showimage($image){

		$imageData = base64_encode(file_get_contents($image));

		$src = 'data:image/jpeg;base64,'.$imageData;

		return $src;

	} ?>



	</body>



</html>

