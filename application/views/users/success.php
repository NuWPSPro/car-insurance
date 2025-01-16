<section class="succes_bg"
	style="background-image: url(<?php echo ASSETS_URL.'images/car-insurance-bg.jpg';?>); background-repeat: no-repeat;background-size: cover;">
	<div class="container">
			<!--   <div class="clearfix login-grid" style="text-align: center; font-size: 15px;"> 
			<?php echo $this->session->flashdata('response');
	                       $url = $_SERVER['HTTP_REFERER'];     ?> 
            </div> -->
				<div class="succes_main_box">
					<div class="succes_inner_box">
						<div class="site-logo__link">
							<a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>"
									alt="logo"></a>
						</div>
						<h4 class="modal-title text-center" style="font-weight: bold;">
							<img src="<?php echo ASSETS_URL.'images/Welcome-text.png'; ?>" alt="welcome" width="175">
						</h4>
						<h6 class="text-center" >
							<?php echo $this->session->flashdata('response'); ?>
							<!-- <a href="<?=base_url('users');?>" class="btn btn-primary text-center">Login</a> -->
							<?php $url = $_SERVER['HTTP_REFERER'];  ?>
						</h6>
						<p class="text-center">
							<a href="microsoft-edge:<?=base_url('users');?>"><img width="100" src="<?=base_url('assets/images/edge.png'); ?>" alt="Edge" title="Edge"></a>
							<a href="<?=base_url('users');?>"><img width="100" src="<?=base_url('assets/images/chrome.png'); ?>" alt="Chrome" title="Chrome"></a>
							<a href="<?=base_url('users');?>"><img width="100" src="<?=base_url('assets/images/opers.png'); ?>" alt="Opera" title="Opera"></a>
							<a href="<?=base_url('users');?>"><img width="100" src="<?=base_url('assets/images/safari.png'); ?>" alt="Safari" title="Safari"></a>
						</p>
					</div>
				</div>
				
	</div>
</section>