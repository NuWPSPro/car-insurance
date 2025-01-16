<!DOCTYPE html>
<html lang="en">

    <head>
            <meta charset="utf-8">
            <title>Training pdf formate</title>
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
	<?php $training_image = ASSETS_URL.'images/uploads/'.$details->image; 
		  $training_venue = ASSETS_URL.'images/uploads/'.$details->venue_photo; ?>
  	<div class="container">
  		<h2 style="padding-bottom: 20px;">Training PDF Formate <a href="<?php echo base_url('provider/genrate_training_pdf/').$details->id.'/'.$details->user_id; ?>" class="btn btn-primary pull-right">Upload PDF</a>
  			<a href="<?php echo base_url('provider/training_center_list'); ?>" class="btn btn-info pull-right">Back</a></h2>
  		<div class="row">
	  		<div class="card">
				<div class="card-header text-center">
					<img src="<?php echo showimage($training_image); ?>" height="100" width="100">
				</div>
				<div class="card-body">
					<h3 class="card-title mb-3" style="padding-bottom: 20px;"> 
			            1. General Information
			        </h3>
		            <table class="table table-bordered" style="width:700px ">
		            	<tbody>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Training Title</th>
		            			<td  style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  $details->title; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Training Sub-Title</th>
		            			<td  style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  isset($details->sub_title)?$details->sub_title:'N/A'; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Unit/s</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  $details->units; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Price (with tax)</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">$ <?php echo  $details->total; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Training Accreditation Number</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  isset($details->acceditation_no)?$details->acceditation_no:'--'; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Training Accreditation Validity</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  isset($details->acceditation_validity)?date('F d,Y',strtotime($details->acceditation_validity)):'--'; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Registration Limit</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo isset($details->registration_limit)?$details->registration_limit:'--'; ?></td>
		            		</tr>
							<tr style="text-align: left;">
								<?php 
									$start_date = date($details->start_date);
									$new_date = date('d F Y', strtotime($start_date));
									
									$end_date = date($details->end_date);
									$end_date = date('d F Y', strtotime($end_date));
									if ($new_date == $end_date) {
										$training_date = $new_date;
									} else {
										$training_date = $new_date . ' - ' . $end_date;
									}?>
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Start Date & End Date</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo $training_date; ?></td>
		            		</tr>
							<tr style="text-align: left;">
							<?php $start_time = date('g:iA', strtotime($details->start_time));
    							  $end_time = date('g:iA', strtotime($details->end_time));?>
								<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Start Time & End Time</th>
								<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo $start_time.' to '.$end_time ; ?></td>
							</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Location</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo isset($details->location)?$details->location:'--'; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Photo of Venue</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><img src="<?php echo showimage($training_venue); ?>" height="100" width="100"></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Host Name</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo $details->host; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Contact Person</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo $details->contact_person; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Contact Person's Email</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo $details->email; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Contact Person's Phone</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo $details->phone; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">CP Number</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo isset($details->cp_number)?$details->cp_number:'--'; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Name of (Training committee Chairman)</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo isset($details->chairman)?$details->chairman:'N/A'; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Position</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo isset($details->position)?$details->position:'N/A'; ?></td>
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
			            2. Trining Overview 
			        </h3>
			        <?php if(!empty($details)){ ?>
		            <table class="table table-bordered">
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:5%; text-align: left; padding: 8px 10px;">Description</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  $details->description; ?></td>
							</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Objectives</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  $details->objectives; ?></td>
							</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Methodologies</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  $details->methodologies; ?></td>
		            		<tr style="text-align: left;">
							<?php $catArrid = explode(',',$details->participants);
                                        $catArrName = $this->db->where_in('id', $catArrid)->get('tbl_category')->result();
                                        $abc = array_column($catArrName, 'cat_name');
                                        $catStrName = implode(', ', $abc); ?>
		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Participants</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  $catStrName; ?></td>
		            		</tr>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Item/s to bring</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo  $details->item_to_bring; ?></td>
		            		</tr>
		            </table>
		        <?php } else{ echo '<b>No data Found!</b>'; } ?>
		        </div>

		    </div>
	    </div>

    	<div class="row">
	  		<div class="card">
				<div class="card-body">
					<h3 class="card-title" style="padding-bottom: 20px;">
			            3. Trianing Schedule
			        </h3>

					<div class="col-md-12">
							<?php	$scheduleUniqueDate     = $this->user->getschedule($details->id); 
								if(!empty($scheduleUniqueDate)){ ?>
							<div class="">
								<div class="panel-group" id="accordion">
									<?php 
									foreach ($scheduleUniqueDate as $key => $value1) {
									$scheduleUniqueDateAlll = $this->user->getscheduleAll($details->id,$value1['schedule_date']);
									$ss=0;
									?>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" class="d-block" data-parent="#accordion" href="#home<?php echo $key+1;?>">
												<?php echo date("jS F, Y", strtotime($value1['schedule_date']));?>
													<i class="fa fa-plus pull-right mt-1"></i>
													<i class="fa fa-minus pull-right mt-1"></i>
												</a>
										</h4>
										</div>
										<div id="home<?php echo $key+1;?>" class="panel-collapse collapse in">
											<div class="panel-body p-0">
												<table class="table table-bordered" style="padding-bottom: 5px;">
													<?php if($ss==0){ ?>
													<thead>
														<!-- <tr class="bg-warning">  -->
														<tr style="text-align: left;">
															<th style="border: 1px solid #f1f1f1; width:20%; text-align: left; padding: 8px 10px;">Time</th>
															<th style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">Topic</th>
															<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Speaker(s)</th>
														</tr>
													</thead>
													<?php } ?>
													
													<tbody>
													<?php 
														foreach ($scheduleUniqueDateAlll as $key => $value2) {
															
															if(!empty($value2['speaker_id']) || $value2['speaker_id']!=0)
															{
															$speaker = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value2['speaker_id']);
															$speakername = $speaker[0]['name'];
															}
															else{
																$speakername = $value2['speaker_name'];
															}
													
														$ss++;
														?>
														<tr style="text-align: left;">
															<td style="border: 1px solid #f1f1f1; width:20%; text-align: left; padding: 8px 10px;">
																<?php echo $value2['schedule_start_time'];?> To
																<?php echo $value2['schedule_end_time'];?>
															</td>
															<td style="border: 1px solid #f1f1f1; width:30%; text-align: left; padding: 8px 10px;">
																<?php echo $value2['topic'];?>
															</td>
															<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">
																<?php echo $speakername;?>
															</td>
														</tr>
															<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
		        		<?php } else{ echo '<p>No data Found!</p>'; } ?>
					</div>
		        </div>
		    </div>
	    </div>

	    <div class="row">
	  		<div class="card">
				<div class="card-body">
					<h3 class="card-title" style="padding-bottom: 20px;">
			            4. Training Speaker
			        </h3>
					
					<div class="col-md-12">
			        <?php 
						$speaker = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$details->id); 
						if(!empty($speaker)){
						foreach ($speaker as $key => $value) { ?>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-3" style="width:30%; text-align: left; padding: 8px 10px;">
										<?php $speakerImg = showimage(BASE_URL.'assets/images/uploads/'.$value['speaker_image']); ?>
										<img src="<?php echo $speakerImg;?>" width="250" alt="<?php echo $value['speaker_name'];?>"/>
									</div>
									<div class="col-md-9" style="width:70%; text-align: left; padding: 8px 10px;">
										<h3 class="mt-0"><?php echo $value['speaker_name'];?></h3>
										<p>Position: <?php echo $value['position'];?></p>
										<p>Institution: <?php echo $value['insititution'];?></p>
										<p><?php echo $value['speaker_description'];?></p>
									</div>
								</div>
							</div>
						</div>
						<?php  } }else{ echo '<p>No data Found!</p>'; }  ?>
					</div>
			    </div>
			</div>
		</div>

		
	    <div class="row">
	  		<div class="card">
				<div class="card-body">
					<h3 class="card-title" style="padding-bottom: 20px;">
			            5. Training Evaluation
			        </h3>
			        
		            <table class="table table-bordered" style="padding-bottom: 5px;">
		            	<tbody>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Evaluation Note</th>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo isset($details->evaluation_note)?$details->evaluation_note:'--'; ?></td>
		            		</tr>
		            	</tbody>
		            </table>

		            <table class="table table-bordered">
		            	<thead>
		            		<tr style="text-align: left;">
		            			<th style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;">S.no.</th>
		            			<th style="border: 1px solid #f1f1f1; width:20%; text-align: left; padding: 8px 10px;">Evaluation for</th>
		            			<th style="border: 1px solid #f1f1f1; width:20%; text-align: left; padding: 8px 10px;">Evaluation Type</th>
		            			<th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Evaluation Question</th>
		            		</tr>
		            	</thead>
			        <?php if(!empty($evaluation)){ ?>
		            	<tbody>
		            	<?php  $count = 1;
		            		foreach ($evaluation as $key => $value){ 
		            			if($value->evaluation_type=='1'){ $for = 'Speaker'; }elseif($value->evaluation_type=='2'){ $for = 'Training/Symposium'; }else{ $for = '--';} 
		            			if($value->question_type==1){ $type = 'Star Rating Question'; }elseif($value->evaluation_type==2){ $type = 'Text Answer Question'; }else{ $type = '--';} ?>
		            		<tr style="text-align: left;">
		            			<td style="border: 1px solid #f1f1f1; width:10%; text-align: left; padding: 8px 10px;"><?php echo $count; ?></td>
		            			<td style="border: 1px solid #f1f1f1; width:20%; text-align: left; padding: 8px 10px;"><?php echo $for; ?></td>
		            			<td style="border: 1px solid #f1f1f1; width:20%; text-align: left; padding: 8px 10px;"><?php echo $type; ?></td>
		            			<td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo $value->evaluation_question; ?></td>
		            		</tr>
		            	<?php $count++; }  ?>
		            	</tbody>
		        	<?php } else{ echo '<tr><td colspan="5">No data Found!</td></tr>'; } ?>
		            </table>
			    </div>
			</div>
		</div>

	    <div class="row">
	  		<div class="card">
				<div class="card-body">
					<h3 class="card-title" style="padding-bottom: 20px;">
			            6. Training Certificate
			        </h3>
			        <div><?php if(!empty($certificate)){ ?>
			        	<?php $certificate = ASSETS_URL.'upload/certificate_templete/'.$certificate->temppreview; ?>
			        		<img src="<?php echo showimage($certificate); ?>" width="750">
			        	<?php }else{ echo 'No data Found!'; } ?>
			        </div>
			    </div>
			</div>
		</div>
	                
    </div>

	<?php  function showimage($image){
		$imageData = base64_encode(file_get_contents($image));
		$src = 'data:image/jpeg;base64,'.$imageData;
		return $src;
	} ?>

	</body>

</html>
