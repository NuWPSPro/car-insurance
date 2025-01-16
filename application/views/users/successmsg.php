<section class="succes_bg"
	style="background-image: url(<?php echo ASSETS_URL.'images/car-insurance-bg.jpg';?>); background-repeat: no-repeat;background-size: cover;">
<div class="container">
    <div class="row my-5">
        <div class="col-sm-12">
             
          <!--   <div class="clearfix login-grid" style="text-align: center; font-size: 15px;"> 
                <?php echo $this->session->flashdata('response');
	                       $url = $_SERVER['HTTP_REFERER'];     ?> 
            </div> -->
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<center style="border: 1px solid #007ded; padding: 25px 25px 5px 25px; border-radius: 5px;">
		                <div class="site-logo__link" style="width: 34%;">
		                    <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
		                </div>
		                <h6><?php echo $this->session->flashdata('response'); ?></h6>
		                	<?php $url = $_SERVER['HTTP_REFERER'];  ?>
		            </center>
				</div>
				<div class="col-sm-2"></div>
			</div>

        </div>
    </div>
</div>
</section>


 