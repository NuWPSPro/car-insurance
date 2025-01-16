
  	<div class="banner">
		<div class="container">
			<div class="banner-left">  
				<h1>Insurance</h1>
			</div>
		</div>
	</div>

	<div class="innerContent">
		<div class="container">	
			
		<h3 class="border-title text-left">Insurance Listing</h3>
			<div class="search-date" style="display:block">
				<form id="courseform" class="form-inline" action="<?php echo base_url('pages/courses'); ?>" method="get">
					<input type="text" class="form-control" name="name" placeholder="SERACH BY NAME">
					<select name="insurance_type" id="toins" class="form-control">
						<option value="">Type of Insurance:</option>
						<option value="1" <?php if($_REQUEST['insurance_type']==1){ echo 'selected'; } ?> >Comprehensive</option>
						<option value="0" <?php if($_REQUEST['insurance_type']==0){ echo 'selected'; } ?> >Third Party</option>
					</select>
					
					<select name="range" id="prange" class="form-control">
						<option value="">Price Range:</option>
						<option value="lt10" <?php if($_REQUEST['range']=='lt10'){ echo 'selected'; } ?> >Less than $10</option>
						<option value="gt10" <?php if($_REQUEST['range']=='gt10'){ echo 'selected'; } ?> >Greater than $10</option>
					</select>
					
					<select name="company" id="inscomp" class="form-control">
						<option  value="">Insurance Comapany:</option>
						<?php if($company):
							foreach($company as $comp): ?>
							<option value="<?=$comp['id']; ?>" <?php if($_REQUEST['company']==$comp['id']){ echo 'selected'; } ?> ><?=$comp['name']; ?></option>
						<?php endforeach; endif; ?>
					</select>
					
					<button type="submit" onclick="jQuery('#courseform').submit();" class="btn btn-primary"> Search </button>
				</form>
			</div>

				<div class="row">
                    <div class="col-md-12">
						<?php if(count($insurance)) { 
                            foreach($insurance as $value): ?>
							<div class="col-md-3 col-sm-3 col-xs-2" >
								<div class="course-item">
									<div class="course-double">
										<a href="javascript:void(0)" data-id="<?=$value['company_id']?>" data-value="<?=$value['insur_id']; ?>"
										data-broker="<?=$value['broker_id']; ?>" class="buyCarInsurance-modal course-image">
											<img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>" alt="">
										</a>

										<div class="dt-sc-course-details">
											<a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><div class="course-price">$<?php echo floatval($value['price']); ?></div></a>

											<h5><a data-id="<?=$insu['user_id']?>" data-value="<?=$value['insur_id']; ?>" class="buyCarInsurance-modal" title="Car Isurance"><?=$value['course_title']?></a></h5>

											<div class="clear-line"> </div>

											<p class="text-center"> 
												Broker :  <?php echo ucwords($value['fname'].' '.$value['name'].' '.$value['lname']); ?><br>
												By : <?php echo $value['company_name']; ?> 
											</p>
											
										</div>
									</div>
								</div>
							</div>
					    <?php endforeach; } else { echo '<div class="pagi-above">Insurance not found.</div>'; } ?>
                    </div>
                </div>

		</div>
	</div>
			<!-- <div class="training-semi-slider-6 pagi-above">
				<?php // $this->load->view("pages/bottomfooterads")?>
			</div> -->
    </div>
</div>



