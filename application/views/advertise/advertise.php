<style type="text/css">
	.input-box-select .form-control {
    width: 201px;
}
</style>
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
		      <img id="pkgsrc" src="<?php echo ASSETS_URL?>upload/IMG_1568287512.png">
		     </div>
		   </div>
		   <div class="col-md-4">
		     <div class="provider-right-content">
			  <a href="javascript:void(0)" class="provid-link package_name"></a>
				<p class="package_price"></p>
				<a href="javascript:void(0)" class="provid-link">Your Ads detail</a>
		     
		    <!------Checkout form---------->
			<form action="<?php echo BASE_URL;?>provider/paynow" method="post" enctype="multipart/form-data" name="form1" id="form1" class="row">
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
                                            <img id="PreviewPicture" src="<?=base_url()?>/assets/images/banner-rajan.png"/>
											
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