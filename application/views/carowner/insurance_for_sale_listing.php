<?php  $this->load->view('carowner/picture'); ?>

		<!-- Main body start -->
		<div class="col-sm-9">
			<?=$body_heading; ?>
						
			<div class="card">
				<div class="card-body">
					<div class="row">
							<?php if(isset($insurance) && !empty($insurance)){ 
								
								foreach($insurance as $value){?>
								<div class="col-md-4 col-sm-4 col-xs-4" >
								<div class="course-item">
									<div class="course-double">
										<a href="javascript:void(0)" data-id="<?=$value['company_id']?>" data-value="<?=$value['insur_id']; ?>"
										data-broker="<?=$value['broker_id']; ?>" class="buyCarInsurance-user course-image">
											<img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>" alt="">
										</a>

										<div class="dt-sc-course-details">
											<a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><div class="course-price">$<?php echo floatval($value['price']); ?></div></a>

											<h5><a data-id="<?=$insu['user_id']?>" data-value="<?=$value['insur_id']; ?>" class="buyCarInsurance-user" title="Car Isurance"><?=$value['course_title']?></a></h5>

											<div class="clear-line"> </div>

											<p class="text-center"> 
												Broker :  <?php echo ucwords($value['fname'].' '.$value['name'].' '.$value['lname']); ?><br>
												By : <?php echo $value['company_name']; ?> 
											</p>
											
										</div>
									</div>
								</div>
							</div>
							<?php } }else{ echo 'No data found!'; } ?>
							
					</div>
				</div>
			</div>
	
		</div>
    	<!-- Main body end -->
        <script>
			$('.buyCarInsurance-user').click(function(){
				
				var compid = $(this).attr('data-id');
				var insid = $(this).attr('data-value');
				var broid = $(this).attr('data-broker');
				$('#companyId').val(compid);
				$('#insurance_id').val(insid);
				$('#broker_id').val(broid);
				$('#buyCarInsurance').modal('show');
						
			});
			</script>
		<!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>

