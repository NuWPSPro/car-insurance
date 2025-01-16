<style type="text/css">
	.input-box-select .form-control {
    	width: 201px;
	}
	.blog-box .dt-sc-course-details {
	   height: 150px;
	}
	.course-item img {
   /* height: 200px;
    width: 100%;*/
    object-fit: cover;
	}
</style>
<div class="banner">
    <div class="container">
        <div class="banner-left">           
		<?php $countryy = $this->user->get_record_by_field_name_all_record('countries','countries_id',$param); ?>
           <h1>News/Blog</h1>
            <ul class="breadcrumb">		    
				<li><?php if($countryy[0]['countries_name']){ echo $countryy[0]['countries_name']; 
							}else{ echo'International'; } ?>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="innerContent blog-panel">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h3 class="border-title text-left">News / Blog</h3>

                <div class="search-date" style="display:block">
					<?php $countries = $this->user->get_countries(); ?>
       
	               <form id="blogform" method="post" class="searchform" action="<?php echo base_url('pages/blog'); ?>">
                     <div class="input-box-select">
						<!-- <div class="selection-box "> -->
							<select name="country" onchange="this.form.submit()" class="form-control" id="dropDown">
								<option value="" >--SELECT COUNTRY--</option>
										 <?php foreach ($countries as $country) { ?>
								<option  <?php if($country['countries_id'] == $param){ echo "selected"; } ?> value="<?php echo $country['countries_id']?>">
									<?php echo $country['countries_name'];?>
								</option>
								<?php } ?> 							
							</select>
						<!-- </div> -->
					</div> 
					<div class="input-box-select">
						<a href="javascript:void(0)" onclick="jQuery('#blogform').submit();" class="btn search"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
					</div>
				</form>
				</div> 
                
            	<div class="row" id="containerp">
				<?php 
					if($blog){
					foreach($blog as $b){ ?>

                    <div class="col-md-4 col-sm-6">
                        <div class="course-item blog-box">
                            <div class="course-double mb-0 ">
                              <a href="<?=base_url('pages/blog_details/'.$b['id'])?>" >
                                <img src="<?=base_url('assets/upload/blog/'.$b['image'])?>" alt="" class="provider_images">
                                <div class="dt-sc-course-details">
                                	<h5><?=$b['title']?></h5>
                                    <div class="clear-line"> </div>
                                    <p><?=substr(strip_tags($b['st_desc']),0,30); ?></p>
                                    <a href="<?=base_url('pages/blog_details/'.$b['id'])?>" class="read-button">Read More</a>
                                </div>
                              </a>
                            </div>
                        </div>
                    </div>
				<?php } }else{ echo 'No Data Found!'; } ?>
	            </div>
            </div>



    <div class="col-md-4 col-sm-4">
        <div class="blog-right-box">
              
                 <div class="col">
                     <input class="form-control border-secondary border-right-0 rounded-0" type="search"  placeholder="search" id="example-search-input4">
                </div>
                 <div class="col-auto secrch-icon">
                     <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="button">
                         <i class="fa fa-search"></i>
                     </button>
                </div>

        <div class="blog-categories">  
        	<a class="btn btn-primary" href="<?php echo base_url('users/signup/professional'); ?>">
        	REGISTER AS PROFESIONAL</a><br>
        	<a class="btn btn-success" href="<?php echo base_url('users/signup/provider'); ?>">
        	REGISTER AS CE PROVIDER</a><br>
        	<a class="btn btn-warning" href="<?php echo base_url('users/signup/institution'); ?>">
        	REGISTER AS INSTITUTION</a>
        	<a class="btn btn-info" href="<?php echo base_url('users/signup/authors'); ?>">
        	REGISTER AS AUTHOR</a>
        </div>
        <h3 class="border-title text-left">Advertise</h3>

	   	<div class="login-ads dt-sc-ico-content">
			<div class="login-slider">
			<?php $topbanner = $this->advertiseads->getAdvertiserBanner('Register Side');					
				  if(count($topbanner))
				  {  
				  	foreach($topbanner as $banner)
					  {
						  $this->advertiseads->updateCount($banner['id']); 
						  ?>
						  <div class="item">
	                        <img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image'];?>" alt="">
	                       </div>
						  <?php
						  break;
					  }
				  }else{ ?>
	                     <img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg';?>">
				<?php	}	?>
	        </div>
	    </div></br>
				      
		<div class="login-ads dt-sc-ico-content">
	     	<div class="login-slider">
			<?php 
				$topbanner2 = $this->advertiseads->getAdvertiserBanner('Register Side');					
				if(count($topbanner2))
				  {
					  foreach($topbanner2 as $banner2)
					  {
						  $this->advertiseads->updateCount($banner2['id']); 
						  ?>
						  <div class="item">
	                        <img src="<?php echo ASSETS_URL.'upload/'.$banner2['banner_image'];?>" alt="">
	                      </div>
						  <?php
						  break;
					  }
				  }else
				  { ?>
	                 <img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg';?>">
			<?php } ?>
	    	</div>
	    </div>
	</div>
</div>
</div>
</div>
</div>
	
       
             


               
                   
<script type="text/javascript">
function paynow(id,amount) {

    $('#item_name').val(id);
    $('#amount').val(amount);
    document.getElementById("frmPayPal1").submit();
}
</script>