<?php 
$uid = $this->session->userdata('logged_in')['id'];
$userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
$uemail = $userdata['username'];
$uname = $userdata['name'];
$this->load->model('professional_model','professional_model'); 
$currentplan = $currentplanArr->version_type;
if($currentplan==3){
	$activetab = '#nav-premium-tab';
	$activeplan = '#nav-premium';
}elseif($currentplan==2){
	$activetab = '#nav-premium-tab';
	$activeplan = '#nav-premium';
	// $activetab = '#nav-pro-tab';
	// $activeplan = '#nav-pro';
}else{
	$activetab = '#nav-pro-tab';
	$activeplan = '#nav-pro';
	// $activetab = '#nav-basic-tab';
	// $activeplan = '#nav-basic';
}
?>
<div class="banner">
    <div class="container">
        <div class="banner-left">           
			<?php $country = $this->user->get_record_by_field_name_all_record('countries','countries_id',$param['country']); ?>

               <h1>Plans</h1>
				    
                <ul class="breadcrumb">
					<li><?php if(!empty($country)){ echo $country[0]['countries_name']; 
								}else{ echo'International'; } ?>
                    </li>
                </ul>
        </div>
        
    </div>
</div>

<div class="innerContent plans-panel">
    <div class="container">
        <div class="row ">
            <div class="col-md-8">
                <h3 class="border-title text-left">Plans</h3>
                 <div class="modal-body">
					<div class="planstabssection">
						<?php $uesrrole = $this->session->userdata('logged_in')['role'];
						$purchageuser = ($uesrrole==1)?'planstabs':'loginusers'; ?>
						<nav>
						  <div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active in planstabs" id="nav-basic-tab" data-toggle="tab" href="#nav-basic" role="tab" aria-controls="nav-basic" aria-selected="true">Basic</a>
							<a class="nav-item nav-link active in planstabs" id="nav-pro-tab" data-toggle="tab" href="#nav-pro" role="tab" aria-controls="nav-pro" aria-selected="false">Pro</a>
							<a class="nav-item nav-link active in planstabs" id="nav-premium-tab" data-toggle="tab" href="#nav-premium" role="tab" aria-controls="nav-premium" aria-selected="false">Premium</a>
						  </div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
						  <div class="tab-pane fade active in" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab">
							<div class="basicplansecttion"><button class="planstabs btn btn-primary">BASIC FREE VERSION - LIMITED FEATURES<br>NO COST</button></div>
							<?php
							foreach($basicplansArr as $bplns){
								$plnsdesarr = $this->professional_model->plandetails($bplns['pro_plan_features']);
									if(count($plnsdesarr) > 0){
										echo '<ul>';
										foreach($plnsdesarr as $basicf){
											echo '<li>'.$basicf['features_name'].'</li>';
										}
										echo '</ul>';
										//if($plns['plan_id'] == 1){ 
										echo '<img src="'.ASSETS_URL.'images/basicfeatures.jpg" style="border: 1px solid #000;">';
										//}
									}
							}
							?>
						  </div>
						  <div class="tab-pane fade" id="nav-pro" role="tabpanel" aria-labelledby="nav-pro-tab">
							<?php
							//echo '<pre>';print_r($plansArr);
							$planbuttons = '';
							$btncount = 1;
							$plandescriptions = '';
							foreach($plansArr as $plns){
								if($plns['propla_id'] == 1){
									$planbuttonsbtn = '<div class="basicplansecttion"><button id="plan'.$plns['propla_id'].'" data-id="'.$plns['propla_id'].'" data-name="'.$plns['pro_package_name'].'" data-amount="'.$plns['pro_package_amount'].'" data-tax="'.$plns['tax'].'" class="'.$purchageuser.' btn btn-primary">$'.$plns['pro_package_amount'].'<br/>'.$plns['pro_package_name'].'</button></div>';
								}else{
									
									$saveprice = ($plns['pro_package_save_amt'] > 0)?'<br><div style="border:1px solid #000;background:yellow;color:red;" >Save $'.$plns['pro_package_save_amt'].'</div>':'';
									$planbuttonsbtn = '<button id="plan'.$plns['propla_id'].'" data-id="'.$plns['propla_id'].'" data-name="'.$plns['pro_package_name'].'" data-amount="'.$plns['pro_package_amount'].'" data-tax="'.$plns['tax'].'" class="'.$purchageuser.' btn btn-primary">$'.$plns['pro_package_amount'].'<br/>'.$plns['pro_package_name'].$saveprice.'</button>';
								}
								$opendiv = ($btncount == 2)?'<div class="plancenter text-center">':'';
								$closediv = ($btncount == 3)?'</div>':'';
								$planbuttons .= $opendiv.$planbuttonsbtn.$closediv;
								
								// if($plns['pro_plan_features'] != ""){
									$plandescriptions .= '<div id="plandescription'.$plns['propla_id'].'" class="plansdescr" style="display:none;">';
									$plnsdesarr = $this->professional_model->plandetails($plns['pro_plan_features']);
									if(count($plnsdesarr) > 0){
										$plandescriptions .= '<ul>';
										foreach($plnsdesarr as $sdf){
											$plandescriptions .= '<li>'.$sdf['features_name'].'</li>';
										}
										$plandescriptions .= '</ul>';
									}
									// if($plns['plan_id'] == 1){ 
										$plandescriptions .= '<img src="'.ASSETS_URL.'images/profeatures.jpg" style="border: 1px solid #000;">';
									// }
									$plandescriptions .= '</div>';
								//}
								$btncount++;	
							}
							echo $planbuttons.$plandescriptions;
						   ?>
						  
						  </div>
						  <div class="tab-pane fade" id="nav-premium" role="tabpanel" aria-labelledby="nav-premium-tab">
						  
						  <!-- <p>Comming Soon!</p> -->

						<?php //echo '<pre>';print_r($premiumplansArr);
							foreach($premiumplansArr as $bplns){
								if($connected_rboard->rboard_name ==''){
									echo '<div class="basicplansecttion"><button style="width:100%;" onclick = "alert(\'You are not connected with any Regularity Board\')"; class="btn btn-primary">$'.$bplns['pro_package_amount'].'/Year<br/>'.$bplns['pro_package_name'].'<br/><span class="btn btn-lg btn-info">PAY NOW</span></button></div>'; 
								}else{
									echo '<div class="basicplansecttion"><button id="plan'.$bplns['propla_id'].'" data-id="'.$bplns['propla_id'].'" data-name="'.$bplns['pro_package_name'].'" data-amount="'.$bplns['pro_package_amount'].'" data-tax="'.$bplns['tax'].'" class="'.$purchageuser.' btn btn-primary">$'.$bplns['pro_package_amount'].'/Year<br/>'.$bplns['pro_package_name'].'<br/><span class="btn btn-lg btn-info">PAY NOW</span></button></div>';	
								}
								$plnsdesarr = $this->professional_model->plandetails($bplns['pro_plan_features']);
									if(count($plnsdesarr) > 0){
										echo '<ul>';
										foreach($plnsdesarr as $basicf){
											echo '<li>'.$basicf['features_name'].'</li>';
										}
										echo '</ul>';
										echo '<p style="color:red;">3 STEPS PROCESS REQUIRED TO GET THIS FEATURES</p>
											  <ul>
												<li>Check if your Regulatory Board is partner with ceopoint</li>
												<li>Verify your Professional Registration</li>
												<li>Pay the PREMIUM plan</li>
											  </ul>';
										//if($plns['plan_id'] == 1){ 
										echo '<img src="'.ASSETS_URL.'images/profeatures.jpg" style="border: 1px solid #000;">';
										//}
									}
							}
							?>
						  </div>
						</div>
					</div>
					
					
				
                   
					</div> 
                </div> 

    <div class="col-md-4">
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
	

<!-- <form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPaypalBuyPlan">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="paypalPlannane" value="">
    <input type="hidden" name="item_number" id="paypalPlanId" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="custom" value="<?php echo $uid; ?>">
    <input type="hidden" name="userid" value="<?php echo $this->session->userdata('logged_in')['id'];?>">
    <input type="hidden" name="amount" id="paypalAmountpaypalAmount" value="">
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('professional/plancancel/'); ?>">
    <input type="hidden" name="return" value="<?php echo site_url('professional/plansuccess/'.$uid.''); ?>">
</form> -->

<?php echo form_open(site_url('professional/paypal_payment_subscription'),['id'=>'frmPaypalBuyPlan','name'=>'frmPayPal1']);?>
    <input type="hidden" name="item_name" id="paypalPlannane" value="">
    <input type="hidden" name="item_number" id="paypalPlanId" value="0"> 
    <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
    <input type="hidden" name="tax" id="paypalTax" value="0">
    <input type="hidden" name="base_price" id="paypalBase" value="0">
    <input type="hidden" name="amount" id="paypalAmount" value="0">
<?php echo form_close();?>
<form action="<?php echo base_url('payu/index'); ?>" method="get" name="PayuPay" id="frmPayupayment">
    <input type='hidden' name='id' id='' value="<?php echo $uid; ?>">
    <input type='hidden' name='planid' id='payuPlanId'>
    <input type="hidden" name="name" id="payuPlannane">
    <input type="hidden" name="price" id="payuAmount">
    <input type="hidden" name="tax" id="payuTax" value="0">
    <!--<input type="hidden" name="base_price" id="stripeBase">-->
    <input type="hidden" name="type" value="PCE-MS">
</form>  
             
	<div id="professionalNopaymentmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
					<center style="border:1px solid #007ded; padding: 25px 25px 5px 25px; border-radius: 5px;">
					   <div class="site-logo__link">
						   <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
					   </div>
					   <h4 class="modal-title text-center" style="font-weight: bold;">
						   <img src="<?php echo ASSETS_URL.'images/thank.jpg'; ?>" alt="thank" width="175">
					   </h4>
					   <p>for choosing ceonpoint for your continuing education</p>
						<p>You 14-days FREE trial of Professional Version of Professional Countinuing Education Manamement Software (PEC-MS) was over.</p>
						<p>You will now be given the BASIC FREE Version of PCE-MS at No COST but with limited features.</p>
						<p>To continue your use of Professional Version of PCE-MS Please click the llink below to subscribe.</p>
						<p style="text-align:center;"><button id="freetoprobtn">PRO VERSION of PCE-MS</button></p>
				   </center>
					
                </div>
            </div>
        </div>
    </div>

	<div id="payby" class="modal fade" role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Choose Payment Option</h4>
			</div>
			<div class="modal-body"> 
			<a href="javascript:void(0)" onclick="paybypaypal();" class="btn" role="button" ><img src="<?=base_url('assets/images/paypallogo.png') ?>" style="height:40px; width:100px;"></a>
			<!-- <a href="javascript:void(0)" onclick="paybystrip();" class="btn btn-info"><img src="<?=base_url('assets/images/OIP.jpg') ?>" style="height:40px; width:100px;"></a> -->
			<a href="javascript:void(0)" onclick="paybypayu();" class="btn"><img src="<?=base_url('assets/images/payu.jpg') ?>" style="height:40px; width:100px;"></a>

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


	$(".planstabs").click(function() {
        var pcems       = '<?php echo $uname.' - PCE-MS'; ?>';
        var planId 		= $(this).data("id");
        var planName 	= $(this).data("name");
        var tax         = $(this).data("tax");
        var basePrice   = $(this).data("base");
        var planAmount 	= $(this).data("amount");
        // alert(planId+'_'+tax+'_'+basePrice);
		if(planAmount > 0){
			$('#paypalPlanId').val(planId);
			$('#paypalPlannane').val(planName);
			$('#paypalTax').val(tax);
			$('#paypalBase').val(basePrice);
			$('#paypalAmount').val(planAmount);

            $('#stripePlanId').val(planId);
            $('#stripePlannane').val(pcems+' '+planName);
            $('#stripeAmount').val(planAmount);
            $('#stripeTax').val(tax);
            $('#stripeBase').val(basePrice);

			$('#payuPlanId').val(planId);
			$('#payuTax').val(tax);
			$('#payuAmount').val(planAmount);
			$('#payuPlannane').val(planName);

            $("#payby").modal("show");   
            $("#planlistingmodal").modal("hide");   
			// $('#frmPaypalBuyPlan').submit();
		}
		//alert(planId+planName+planAmount);		
		//$(".plansdescr").hide();
		//$("#plandescription"+planid).show();
		$("#plandescription3").show();
    });
	
	$("#plandescription3").show();

	$('#freetoprobtn').on('click', function() {
		$("#professionalNopaymentmodal").modal("hide");
		$("#planlistingmodal").modal("show");	
		/* $('#professionalNopaymentmodal').modal({
			show: false
		}); 
		$('#planlistingmodal').modal({
			show: true
		});  */
	});

	$('.planstabs').on('click', function() {
		$('.planstabs').removeClass('active in');
		$(this).addClass('active in');
	});
	$(document).ready(function(){
		$('.planstabs,.tab-pane').removeClass('active in');
		$('<?=$activetab?>').addClass('active in');
		$('<?=$activeplan?>').addClass('active in');
	});
	$(".loginusers").click(function() {
	alert('Please login with your professional\'s account and Purchase it.');
	return false;
	});


	function paybypaypal() {
      $("#frmPaypalBuyPlan").submit();
    }

  function paybystrip() {
    $("#frmStripeBuyPlan").submit();
  }
  function paybypayu() {
      $("#frmPayupayment").submit();
    }

</script>

<!-- $(".loginusers").click(function() {
alert('Please login your account and purchage it.');
return false;

}); -->

<!-- $purchageuser = ($uesrid)?'planstabs':'loginusers'; -->