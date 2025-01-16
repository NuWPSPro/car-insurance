<?php /* 
<section class="main-addspace">
        <div class="container">
            <div class="main-addspace-box">
            	<!-- <div class="row"> -->
			   		<?php if(!empty($current_country)){$this->db->where('tbl_adv_package_purchased.country',$this->session->userdata('current_country'));}
		     			$topbanner = $this->advertiseads->getAdvertiserBanner('Top Body');						
						  if(count($topbanner))
						   {
							   $i=1;
							  foreach($topbanner as $banner)
							  {
								  if($i>4){  break;  }
								   $i++;
								   
								    $this->advertiseads->updateCount($banner['id']);
								    $size=explode('x',$banner['size']); ?>
								    <!-- <div class="col-md-3"> -->
								    	<a href="#">
										<div class="item">							
											<div class="main-addspace-iner-box">
												<a href="<?php if($banner['website_url']){ 
													echo $banner['website_url'];
												}else{ 
													echo "#";
												}?>">
												<img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image']; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" alt=""></a>
											</div>							
										</div>
										</a>
									<!-- </div> -->
					<?php	 }
						   }else
						   { ?>

			<!-- <div class="col-md-3"> -->
                <a href="#"> 
					<div class="item">
						<div class="main-addspace-iner-box">
							<img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
						</div>
					</div>
				</a>
			<!-- </div> -->
			<!-- <div class="col-md-3"> -->
				<a href="#"> 
					<div class="item">
						<div class="main-addspace-iner-box">
							<img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
						</div>
					</div>
				</a>
			<!-- </div> -->
			<!-- <div class="col-md-3"> -->
				<a href="#"> 
					<div class="item">
						<div class="main-addspace-iner-box">
							<img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
						</div>
					</div>
				</a>
			<!-- </div> -->
			<!-- <div class="col-md-3"> -->
				<a href="#"> 
					<div class="item">
						<div class="main-addspace-iner-box">
							<img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
						</div>
					</div>
				</a>
			<!-- </div> -->
			<?php } ?>
            <!-- </div> -->
           </div>
        </div>
    </section>
    
    */ ?>
