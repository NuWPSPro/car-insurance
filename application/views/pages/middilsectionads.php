<?php /*		 <section class="bottome-addspace">
                 <?php 
                 if(!empty($current_country)){$this->db->where('tbl_adv_package_purchased.country',$this->session->userdata('current_country'));}
				$middlebanner = $this->advertiseads->getAdvertiserBanner('Middle Body');						
				//$middlebanner = '';						
						
						  if(count($middlebanner))
						   {
							  foreach($middlebanner as $banner)
							  {
								  
								  $this->advertiseads->updateCount($banner['id']);
								  $size=explode('x',$banner['size']);
								  ?>
									<div class="item">
										<div class="container">
											<div class="bottome-addspace-box">
												<a href="<?php if($banner['website_url']){ echo $banner['website_url'];}else{ echo "#";}?>"><img src="<?php echo ASSETS_URL; ?>upload/<?php echo $banner['banner_image'];?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" alt=""></a>
											</div>
										</div>
									</div>
							<?php
							     break;
							  }
						   }else
						   {
							   ?>
							   <div class="item">
										<div class="container" style="padding: 10px 10px;">
											<div class="bottome-addspace-box" >
												<!-- <img src="<?php echo ASSETS_URL; ?>images/advertise/new-1230-x-200.jpg"  alt=""> -->
												<img src="<?php echo ASSETS_URL; ?>images/advertise/new-800-x-150.jpg"  alt="">
											</div>
										</div>
									</div>
							   <?php
						   }
							?>		
 			</section> */ ?>
