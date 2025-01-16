<style type="text/css">
    .input-box-select .form-control {
    	width: 215px;
	}
	.input-box-select span {
		display: none;
	}
	#ui-id-1 {
		    width: 200px;
    background-color: #fff;
	}
</style>
<div class="banner">
    <div class="container">
        <div class="banner-left">           
			<?php 
				$cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','id',$param['category']);
				$this->db->order_by('countries_name','ASC');
				$country = $this->user->get_record_by_field_name_all_record('countries','countries_id',$param['country_id']);
				// echo print_r($country);
			?>
		   <h1>BROKERS LISTING</h1>
           <ul class="breadcrumb">
	           <li><a href="#<?php //echo site_url();?>"><?php if(!empty($cat)){ echo $cat[0]['cat_name']; }else{ ?>All Brokers <?php } ?></a></li>
	           <li><?php if(!empty($country)){ echo $country[0]['countries_name']; }else{ ?>International<?php } ?></li>
           </ul>
        </div>
    </div>
</div>

<?php $this->load->view("pages/topheaderads")?>

<div class="innerContent">
	<div class="container">
		<div class="row displayflex">
           
            <div class="col-sm-8">
                <h3 class="border-title text-left">Brokers Listing</h3>
				<div class="search-date" style="display:block">
					<?php   $cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
							$this->db->order_by('countries_name','ASC');
							$countries = $this->user->get_countries(); ?>
       
	               		<form id="courseform" class="searchform" action="<?php echo base_url('pages/ceprovider'); ?>">
							<div class="input-box-select">
								<input type="text" name="ceprovider_title" id="ceprovider_title" class="form-control" placeholder="ENTER BROKER'S NAME" value="<?php echo $_REQUEST['ceprovider_title']; ?>">
							</div>
							<?php /*
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
							*/ ?>
							<div class="input-box-select">
								<a href="javascript:void(0)" onclick="jQuery('#courseform').submit();" class="btn search"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
							</div>
						</form>
				</div>

				
                
                <div class="row">
				 <?php   
                    if(count($authors))
					  {   foreach ($authors as $key => $value) { 
					  	$country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name'];  
						   if($value['image']==""){ $image = ASSETS_URL.'images/uploads/dummy-profile.jpg'; } else { $image = ASSETS_URL.'images/uploads/'.$value['image']; } ?> 				
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
						<?php if(date('Y-m-d') >=$value['featured_from'] and date('Y-m-d')<=$value['featured_to']) { ?>
							   <div class="corner"></div>
                               <span class="corner-text">featured</span>
						<?php } ?>
                            <a href="<?php echo site_url('share/viewprofile/'.$value['id'].'');?>">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img style="height:292px" src="<?php echo $image;?>" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title"><?php echo $value['name'];?></h5>
                                    <div class="training-box_text"><?php echo $country; ?></div>
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
                                        <a href="<?php echo site_url('share/viewprofile/'.$value['id'].'');?>">
                                            <div class="training-box_overlay"></div>
                                            <div class="training-box-image">
                                               
                                           <img  src="<?php echo ASSETS_URL.'images/uploads/'.$value['image'];?>" alt="" onError="this.onerror=null;this.src='<?php echo ASSETS_URL."images/ceprovider.png"; ?>';">
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
				<!-- <div class="elementor-widget-button text-center">
					<a href="#" class="bg-blue">REGISTER AS CE PROVIDER</a>
					<a href="#" class="bg-yellow">view ce provider platform</a>
				</div> -->


            </div>
            
            <?php  $this->load->view('pages/sidebar'); ?>
                    
			


		</div>
		    <div class="training-semi-slider-6 pagi-above">
				<?php $this->load->view("pages/bottomfooterads")?>
            </div>

	</div>

</div>

<?php 
$name = $this->db->select('name')->where(array('role'=>6,'status'=>'1','under_insititution'=>'0'))->get('tbl_user')->result_array(); 
$names = array_column($name, 'name');
// echo json_encode($names); ?>

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
 
	$(function() { 
		$( "#ceprovider_title" ).autocomplete({  
			source: <?php echo json_encode($names); ?>  
		});  
	});  
</script> 



