<?php $this->load->view('advertise/advertise_head'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="border-title text-left">DASHBOARD </h3>
            </div>
            <?php  $this->load->view('advertise/sidebar');  ?>
             
            <div class="col-sm-9">

            <div class="row text-center">
            <div class="col-md-12">
            	<h3>Website Data for Marketing</h3>
		        <div class="col-md-3">
		            <span class="advcircle"><?=$totalViewers?></span><p class="advtext">Total Visitors</p>
		        </div>
		        <div class="col-md-3">
		            <span class="advcircle"><?=$totalProfessional?></span><p class="advtext">Professionals</p>
		        </div>
		        <div class="col-md-3">
		            <span class="advcircle"><?=$totalCountries?></span><p class="advtext">Countries</p>
		        </div>
		        <div class="col-md-3">
		            <span class="advcircle"><?=$totalSubInstitute?></span><p class="advtext">Institutions</p>
		        </div>
				
				<div class="ce-provider-detil">
                    <div class="ce-provider-detil-midil">	
                      <h3>Advertisement Packages</h3>								
		                <div class="row">								
		            <?php foreach ($advertise as $key => $value){ ?>
					    <div class="col-lg-3">
							<div class="icon-container">
							<div class="ce-provider-img-detil">
										<h4><?php echo $value['location'];?></h4>
										<P>$ <?php echo $value['price'];?>/View</P>
										<p>Minimum View: <?php echo $value['minimum_view'];?></p>
									</div>
							   
								<div class="ce-provider-detil-img" onclick="showPackage(<?php echo $value['id'];?>,'<?php echo $value['package_name'];?>','<?php echo $value['package_image'];?>','<?php echo $value['price'];?>','<?php echo $value['minimum_view'];?>','<?php echo $value['size'];?>')">
									<img src="<?php echo BASE_URL;?>/assets/upload/<?php echo $value['package_image'];?>">
								   
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
		      <img id="pkgsrc" src="http://ceonpoint.com//assets/upload/IMG_1568287512.png">
		     </div>
		   </div>
		   <div class="col-md-4">
		     <div class="provider-right-content">
			  <a href="javascript:void(0)" class="provid-link package_name"></a>
				<p class="package_price"></p>
				<a href="javascript:void(0)" class="provid-link">Your Ads detail</a>
		     
		    <!------Checkout form---------->
			<form action="<?php echo BASE_URL;?>advertise/paynow" method="post" enctype="multipart/form-data" name="form1" id="form1" class="row">
				<?php echo $this->session->flashdata('response'); ?>
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
				 <select name="country"  class="form-control" required>
                    <option value="" selected="">Choose Country</option>
                    <?php foreach($country as $value){ ?>
                        <option value="<?=$value['countries_id']?>"><?php echo $value['countries_name']; ?></option><?php } ?>
                    <!-- <option value="16">Bahamas</option>
                    <option value="99">India</option>
                    <option value="168">Philippines</option>
                    <option value="223">United State</option> -->
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
                    <img id="PreviewPicture" src="<?=base_url()?>/assets/images/banner-rajan.png"/>
              </div>
										
			 <div class="right-total">
				<P>total</P>
				<p id="pricehtml">$00</p>
				<!-- <p id="adpricehtml">$00</p> -->
              </div>
			</div>

			<div>
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



<script type="text/javascript">
  var asseturl="<?php echo BASE_URL;?>/assets/upload/";  
function addtocart(pid)
{
    //alert(pid);
    $.ajax({
    type: "POST",
    url: '<?php echo base_url()."advertise/addtocart";?>',
    data: {pid:pid}
    }).done(function( result ) {
    alert(result);
    $("#filteredData2").html( result );
    });              
    return false;   
  

}

function showPackage(id,name,image,price,minimum_view,size)
{
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

function selectView(view)
{
	var discount = jQuery('#no_of_view option:selected').attr('discount');
	
	var base_price= jQuery('#base_price').val();
	var totalprice=base_price*view;
	var discountprice=(totalprice*discount)/100;	
	var finalprice=totalprice-discountprice;
	    totalprice='$'+finalprice;	
	jQuery('#pricehtml').html(totalprice);	
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
  <style>
        .ce-provider-head-box {
            width: 50%;
        }

        .ce-provider-head {
            display: flex;
            background-color: #002060;
            padding: 10px;
        }

        .ce-provider-head-box h3 {
            color: #fff;
            font-size: 18px;
            margin: 0;
        }

        .ce-provider-head-box p {
            margin: 0;
            color: #fff;
            margin-top: 9px;
        }

        .ce-provider-head-box2-iner p {
            color: #000;
            margin: 0;
            font-size: 16px;

        }

        .ce-provider-head-box2-iner {
            background-color: #fff;
        }

        .ce-provider-head-box2-iner-box p {
            color: #fff;
            margin: 0;
            line-height: 17px;
            text-align: center;
            font-size: 11px;
            margin-top: 5px;
        }

        .ce-provider-head-box2 {
            display: flex;
            width: 50%;
        }

        .ce-provider-head-box2-main {
            margin-right: 10px;
            text-align: center;
        }

        .ce-provider-box2 {
            background-color: #ffffb3;
            padding-top: 1px;
            display: flex;
        }

        .ce-provider-box-two h3 {
            padding-left: 10px;
            margin: 10px 0 0 0;
            text-decoration: underline;
        }

        .ce-provider-box-two {
            width: 70%;
        }

        .ce-provider-box-img {
            width: 30%;
            padding: 10px;
        }

        .ce-provider {
            border: 1px solid #2f5290;
        }

        .ce-provider-detil-midil h3 {
            text-decoration: underline;
        }

        .ce-provider-detil-img img {
            max-height: 100%;
            width: 100%;
        }

        .ce-provider-detil-img {
            width: 100%;
            height: 334px;
            border: 2px solid #214d8f;
        }

        .ce-provider-img-detil {
            text-align: center;
            background-color: #0070c0;
            border-radius: 7px;
            border: 2px solid #214d8f;
            margin-bottom: 5px;
        }

        .ce-provider-img-detil h4 {
            font-size: 15px;
            margin: 0;
            color: #fff;
            text-decoration: underline;
        }

        .ce-provider-img-detil p {
            margin: 0;
            color: #fff;
        }

        .provider-right-content .input-box-select .selection-box {
            width: 100%;
            margin-top: 10px;
        }

        .provid-link {
            background-color: #007ded;
            padding: 10px;
            display: block;
            color: #fff;
            margin-bottom: 10px;
        }

        .provid-link:hover {
            color: #000;
        }

        .provider-right-content p {
            margin-bottom: 8px;
            color: #000;
            font-weight: 500;
        }

        .file-upoad {
            border: 1px solid #dfdfdf;
            margin-top: 20px;
            padding: 10px;
        }

        .right-img-box {
            width: 100%;
            height: 250px;
        }

        .right-img-box img {
            width: 100%;
            max-width: 100%;
            height: 100%;
        }

        .right-total {
            text-align: center;
            margin-top: 10px;
        }

        .right-total p {
            margin: 0;
            text-transform: capitalize;
            color: #007ded;
            line-height: 17px;
        }
        .provider-right-content .btn.btn-success {
    width: 100%;
    margin-top: 20px;
    background-color: #d90c0c;
}
    </style>
</div>
</div>
</div>
</div>    










