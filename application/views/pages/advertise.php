<style type="text/css">
	.input-box-select .form-control {
    width: 201px;
}
</style>
	<div class="banner">
	    <div class="container">
	        <div class="banner-left">           
				<?php $country = $this->user->get_record_by_field_name_all_record('countries','countries_id',$param['country']); ?>
	            <h1>Advertisement</h1>
	            <ul class="breadcrumb">
					<li><?php if(!empty($country)){ echo $country[0]['countries_name']; }else{ echo'International'; } ?></li>
	            </ul>
	        </div>
	    </div>
	</div>

<div class="innerContent advertise-panel">
    <div class="container">
        <div class="row ">
		<div class="col-sm-8">
			<div class="col-sm-12">
				<h2 class="adv-header"><u>Website Data for Marketing</u></h2>
				<a href="<?php echo base_url('users/signup/advertisers')?>" class="btn btn-info pull-right">REGISTER AS ADVERTISER</a>
			</div>
		        
		    <div class="row text-center">
		    	<div class="col-md-3 col-sm-3 col-xs-3">
		            <span class="advcircle"><?=$totalViewers?></span><p class="advtext">Total Visitors</p>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		            <span class="advcircle"><?=$totalProfessional?></span><p class="advtext">Professionals</p>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		            <span class="advcircle"><?=$totalCountries?></span><p class="advtext">Countries</p>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		            <span class="advcircle"><?=$totalSubInstitute?></span><p class="advtext">Institutions</p>
		        </div>
		    <div class="col-md-12"> <hr></div>

		        <div class="col-md-12"> 
		            <div class="ce-provider-detil">
		                <div class="ce-provider-detil-midil">	
		                    <h3>Advertisement Packages</h3>								
		                <div class="row">								
				            <?php foreach ($advertise as $key => $value){ ?>
				            <div class="col-lg-3 col-sm-6 col-xs-6">
				                <div class="icon-container">
				                    <div class="ce-provider-img-detil">
				            			<h4><?php echo $value['location'];?></h4>
				            			<P>$ <?php echo $value['price'];?>/View</P>
				            			<p>Minimum View: <?php echo $value['minimum_view'];?></p>
				            		</div>
				                	<div class="ce-provider-detil-img" onclick="showPackage(<?php echo $value['id'];?>,'<?php echo $value['package_name'];?>','<?php echo $value['package_image'];?>','<?php echo $value['price'];?>','<?php echo $value['minimum_view'];?>','<?php echo $value['size'];?>')">
				                		<img src="<?php echo BASE_URL.'assets/upload/'.$value['package_image'];?>">
				                	</div>
				                </div>
				            </div>
				            <?php } ?>	  
		                </div>
		                </div>
		            </div>	
		        </div>
		    </div>
		</div>


	    <div class="col-md-4 col-sm-4">
	        <div class="blog-right-box">
	            <div class="col">
	                <input class="form-control border-secondary border-right-0 rounded-0" type="search"  placeholder="search" id="example-search-input4">
	            </div>
	            <div class="col-auto secrch-icon">
	                <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="button"><i class="fa fa-search"></i></button>
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
							  <div class="item"><img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image']; ?>" alt="">
		                      </div>
							  <?php  break;
						  }
					  }else{ ?>
		                    <div class="item">
		                    	<img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg';?>">
		                    </div>
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
		                        <img src="<?php echo ASSETS_URL.'upload/'.$banner2['banner_image']; ?>" alt="">
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


<div id="addpackage" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="packagename"></h4>
      </div>
      <div class="modal-body" style="">
	  <div class="provider-popup">
         <div class="row">
		   <div class="col-md-7">
		     <div class="provider-popup-content">
		      <img id="pkgsrc" src="<?php echo ASSETS_URL.'upload/IMG_1568287512.png'; ?>">
		     </div>
		   </div>
		   <div class="col-md-4">
		     <div class="provider-right-content">
			  <a href="javascript:void(0)" class="provid-link package_name"></a>
				<p class="package_price"></p>
				<a href="javascript:void(0)" class="provid-link">Your Ads detail</a>
		     
		    <!------Checkout form---------->
			<form action="<?php echo BASE_URL.'provider/paynow';?>" method="post" enctype="multipart/form-data" name="form1" id="form1" class="row">
		      <input type="hidden" value="" id="base_price" name="base_price">
			 
				
			 <div class="form-group">
                <label>Select View<span class="required"> * </span> </label>
                <div class="selection-box">
                    <select name="no_of_view" id="no_of_view" class="form-control" onchange="selectView(this.value)" required>
                       <option value="">Select</option>
					   <option value="5000" discount="0">5,000 (0% discount)</option>
					   <option value="15000" discount="3">15,000 (3% discount)</option>
					   <option value="25000" discount="6">25,000 (6% discount)</option>
					   <option value="35000" discount="9">35,000 (9% discount)</option>
					   <option value="45000" discount="12">45,000 (12% discount)</option>
					   <option value="55000" discount="15">55,000 (15% discount)</option>
					   <option value="65000" discount="18">65,000 (18% discount)</option>
					   <option value="75000" discount="21">75,000 (21% discount)</option>
					   <option value="85000" discount="24">85,000 (24% discount)</option>
					   <option value="95000" discount="27">95,000 (27% discount)</option>
					   <option value="100000" discount="30">100,000 (30% discount)</option>
					</select>
                </div>
            </div>
			<div class="form-group">
					<label >Country </label>
					 <select name="contry"  class="form-control" required>
                        <option value="" selected="">Choose Country</option>
                        <option value="16">Bahamas</option>
                        <option value="99">India</option>
                        <option value="168">Philippines</option>
                        <option value="223">Unites State</option>
								</select>
				</div>		
					<div class="form-group">
					<label >Business Website URL </label>
					 		      <input type="text" value="" class="form-control" name="website_url">

				</div>	

				 <div class="file-upoad">
					<label >Upload Photo <span id="uploadphotosize"></span></label>
					<input type="file" id="banner_image" name="banner_image"  required>
				</div>				
				<div class="provider-right-img">
				  <div class="right-img-box">
                                            <img id="PreviewPicture" src="<?=base_url('assets/images/banner-rajan.png')?>"/>
											
                                        </div>
				 <div class="right-total">
					<P>total</P>
					<p id="adpricehtml">$00</p>
                  </div>
				   </div>
				<div >
				   <input type="submit" class="btn btn-success" value="Pay Now" name="paynow">
				</div>
				<input type="hidden" id="bnnrsize" name="bnnrsize" value=""/>
				<input type="hidden" id="advertise_id" name="advertise_id" value=""/>
				<input type="hidden" id="total_amount" name="total_amount" value=""/>
			</form>
			<!------Checkout form---------->
		   </div>
		   </div>		 
		 </div> 
		 </div>
      </div>
     
    </div>

	</div>
</div>

<?php $logincheck = $this->session->userdata('logged_in');  ?>
                   
<script type="text/javascript">
function paynow(id,amount) {

    $('#item_name').val(id);
    $('#amount').val(amount);
    document.getElementById("frmPayPal1").submit();
}

var asseturl="<?php echo BASE_URL.'assets/upload/';?>";  
function addtocart(pid)
{
    //alert(pid);
    $.ajax({
    type: "POST",
    url: '<?php echo base_url("advertise/addtocart");?>',
    data: {pid:pid}
    }).done(function( result ) {
    alert(result);
    $("#filteredData2").html( result );
    });              
    return false;   
  

}

function showPackage(id,name,image,price,minimum_view,size)
{	var check = '<?=$logincheck;?>';
	if(check==''){
		alert('Please Login First!');
		window.location.href = "<?php echo site_url('users'); ?>";
	}else{
		jQuery('#uploadphotosize').html(size+'px');
		jQuery('#bnnrsize').val(size);
		jQuery('#advertise_id').val(id);
		
		jQuery('#packagename').html(name);
		jQuery('.package_name').html(name);
		jQuery('.package_price').html('$'+price+' cents/view');
		jQuery('#base_price').val(price);
		jQuery('#pkgsrc').attr('src',asseturl+image);
		jQuery('#addpackage').modal('show');
	}
}

function selectView(view)
{
	var discount = jQuery('#no_of_view option:selected').attr('discount');
	
	var base_price= jQuery('#base_price').val();
	var totalprice=base_price*view;
	var discountprice=(totalprice*discount)/100;	
	var finalprice=totalprice-discountprice;
	    totalprice='$'+finalprice;	
	jQuery('#adpricehtml').html(totalprice);	
	jQuery('#total_amount').val(finalprice);
	
}

 $('#banner_image').change(function () {
  var file = $(this)[0].files[0];
	 var _URL = window.URL || window.webkitURL;
	  img = new Image();
	  var imgwidth = 0;
	  var imgheight = 0;
	  
	  img.src = _URL.createObjectURL(file);
	  img.onload = function() {
	   imgwidth = this.width;
	   imgheight = this.height;	   
	   var size=imgwidth+'x'+imgheight;
	   
	 var bnnrsize= jQuery('#bnnrsize').val();
	   if(bnnrsize!=size)
	   {
	        alert('please select valid width*hieght of image');	
            jQuery('#banner_image').val('');	

			
	   }else
	   {
		   
		     var PreviewIMG = document.getElementById('PreviewPicture'); 
			 var UploadFile    =  document.getElementById('banner_image').files[0]; 
			 var ReaderObj  =  new FileReader(); 
			 ReaderObj.onloadend = function () { 
				PreviewIMG.src  = ReaderObj.result;
			  } 
			 if (UploadFile) { 
				ReaderObj.readAsDataURL(UploadFile);
			  } else { 
				 PreviewIMG.src  = "";
			  }  
	   } 
	      
	   
	   }
	 
	 })
</script>