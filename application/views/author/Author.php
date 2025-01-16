<style type="text/css">
    .input-box-select .form-control {
    width: 215px;
	}
</style>
<div class="banner">
    <div class="container">
        <div class="banner-left">           
			<?php 
				$cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','id',$param['category']);
				$country = $this->user->get_record_by_field_name_all_record('countries','countries_id',$param['country_id']);
				// echo print_r($country);
			?>
		   <h1>CE PROVIDERS</h1>
           <ul class="breadcrumb">
	           <li><a href="#<?php //echo site_url();?>"><?php if(!empty($cat)){ echo $cat[0]['cat_name']; }else{ ?>All Professions <?php } ?></a></li>
	           <li><?php if(!empty($country)){ echo $country[0]['countries_name']; }else{ ?>International<?php } ?></li>
           </ul>
        </div>
    </div>
</div>

<?php $this->load->view("pages/topheaderads")?>

<div class="innerContent author-panal">
	<div class="container">
		<div class="row displayflex">
            <!-- New thumb slider Html Start 28.12.2018 -->
            <!-- <div class="col-md-12">
                 <div class="thumbSliders">
                    <div class="owl-carousel-thumslider">
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog15-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog16-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog17-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog17-420x295.jpg" alt=""></div>
                    </div>
                </div>
            </div> -->
            <!-- New thumb slider Html Start 28.12.2018 -->
            <div class="col-sm-8">
                <h3 class="border-title text-left">
					<?php 
							if($flag==1)
							{ ?> 
								Featured CE Provider 
					<?php   }else{ ?>
								Latest CE Provider
					<?php   } ?>	
				</h3>
				<div class="search-date" style="display:block">
					<?php   $cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
							$countries = $this->user->get_countries(); ?>
       
	               		<form id="courseform" class="searchform" action="<?php echo base_url(); ?>pages/ceprovider">
							<div class="input-box-select">
								<input type="text" name="ceprovider_title" id="ceprovider_title" class="form-control" placeholder="ENTER CE PROVIDER NAME" value="<?php echo $_REQUEST['ceprovider_title']; ?>">
							</div>
							<div class="input-box-select">
								<!-- <div class="selection-box "> -->
								<select name="category" class="form-control" id="dropDown">
									<option value="" selected="">PROFESSION</option>
									<?php foreach ($cat as $key => $value) { ?>
									<option <?php if($value['cat_name']==$param['category']){ echo "selected"; } ?> value="<?php echo $value['cat_name']?>"><?php echo $value['cat_name'];?></option>
									<?php } ?>  					
								</select>
								<!-- </div> -->
							</div>   		   
							<div class="input-box-select">
								<!-- <div class="selection-box "> -->
									<select name="country" class="form-control" id="dropDown">
										<option value="" >COUNTRY</option>
										<?php foreach ($countries as $country) { ?>
										<option  <?php if($country['countries_id']==$param['country']){ echo "selected"; } ?> value="<?php echo $country['countries_id']?>"><?php echo $country['countries_name'];?></option>
										<?php } ?> 							
									</select>
								<!-- </div> -->
							</div> 

							<div class="input-box-select">
								<a href="javascript:void(0)" onclick="jQuery('#courseform').submit();" class="btn search"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
							</div>
						</form>
				</div>

				
                
                <div class="row">
				 <?php   
                    if(count($promoted_provider))
					  {
                       foreach ($promoted_provider as $key => $value) {
                        ?> 				
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
						<?php if(date('Y-m-d') >=$value['featured_from'] and date('Y-m-d')<=$value['featured_to']) { ?>
							   <div class="corner"></div>
                               <span class="corner-text">featured</span>
							   <?php
							  }
							   ?>
                            <a href="<?php echo site_url('users/profile/'.$value['id'].'');?>">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img style="height:292px" src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $value['image'];?>" alt="" onError="this.onerror=null;this.src='<?php echo ASSETS_URL."images/ceprovider.png"; ?>';">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title"><?php echo $value['name'];?></h5>
                                    <!--<div class="training-box_text">Address Here</div>-->
                                </div>
                            </a>
                        </div>
                    </div>
					  <?php } 
					 }else
					 {
						 
						 ?>
					   <p><center>No record found.</center></p>
					   <?php
					 }
					  ?> 
					  
                    
				</div>

				<?php $this->load->view("pages/middilsectionads")?> 

                <div class="row">
				<?php 
				if($flag==1)
				{
					?>
                    <div class="col-md-12">
                        <h3 class="border-title text-left">Regular Listing</h3>
                        <div class="training-semi-slider-6 pagi-above">
						 <?php   

                    foreach ($free_provider as $key => $value) {
						if(date('Y-m-d') >=$value['featured_from'] and date('Y-m-d')<=$value['featured_to']) {
							
						continue;
						}
                        ?> 
                            <div class="item">
                                <div class="training-semi">
                                    <div class="new-training-box">
                                        <a href="<?php echo site_url('users/profile/'.$value['id'].'');?>">
                                            <div class="training-box_overlay"></div>
                                            <div class="training-box-image">
                                               
                                           <img  src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $value['image'];?>" alt="" onError="this.onerror=null;this.src='<?php echo ASSETS_URL."images/ceprovider.png"; ?>';">
										   </div>
                                            <div class="training-box-caption">
                                                <h5 class="training-box_title"><?php echo $value['name'];?></h5>
                                                <div class="training-box_text"><?php echo $value['address'];?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
					         }
							?>
                        </div>
                    </div>
					<?php
					
				   }
					?>
                </div>
				<div class="elementor-widget-button text-center">
					<a href="#" class="bg-blue">REGISTER AS CE PROVIDER</a>
					<a href="#" class="bg-yellow">view ce provider platform</a>
				</div>


            </div>
            
            <?php  $this->load->view('pages/sidebar'); ?>
                    
			


		</div>
		    <div class="training-semi-slider-6 pagi-above">
				<?php $this->load->view("pages/bottomfooterads")?>
            </div>

	</div>

</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>

<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

<script type="text/javascript">

    $( document ).ready(function() {

        $("input").on("change", function() {

            this.setAttribute(

                "data-date",

                moment(this.value, "YYYY-MM-DD")

                .format( this.getAttribute("data-date-format") )

                )

        }).trigger("change")

    });

</script>

<?php 
$name = $this->db->select('name')->where('role',2)->get('tbl_user')->result_array(); 
$names = array_column($name, 'name');
// echo json_encode($names); ?>
 <script>  
  $(function() { 
    $( "#ceprovider_title" ).autocomplete({  
     source: <?php echo json_encode($names); ?>  
    });  
  });  
</script> 



