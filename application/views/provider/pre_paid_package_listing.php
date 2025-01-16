<?php $this->load->view('template/picture_provider'); ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">
			<!-- left sidebar start -->
			<?php $this->load->view('provider/sidebar'); ?>
			<!-- left sidebar end -->

			<!-- right main body start -->
			<div class="col-sm-8">
				<h3 class="border-title text-left">Digital Certificate Subscription Package</h3>
				
				<div class="card">
					<div class="card-body">
						<div class="row">
								<?php if(isset($package_list) && !empty($package_list)){ 
									
									foreach($package_list as $value){?>
									<div class="col-sm-4 d-flex">
										<div class="subscrib-box">
											<h5 class="text-center"><?=$value->subcription_name;?></h5 class="text-center">
											<p>Number of certificates: <?=($value->no_of_certificates==0)?'UNLIMITED':$value->no_of_certificates;?></p>
											<p>Charges per certificate: $<?=number_format($value->charge_per_certificate);?></p>
											<div class="subc-dtl text-center p-2">
												<?=$value->subscription_details;?>
											</div>
											<!-- <p><?=$value->charge_per_certificate;?></p> -->
											<a href="javascript:void(0);" class="btn btn-info buynow" data-id="<?php echo $value->dcp_id;?>" data-value="<?php echo $value->charge_per_certificate;?>" data-name="<?=$value->subcription_name;?>">$<?php echo number_format($value->total_charges);?><br>Pay Now</a>
										</div>
									</div>
								<?php } }else{ echo 'No dat found!'; } ?>
								<form id="dcsubpayment" method="post" action="<?php echo base_url('provider/digital_certificate_payment');?>">
									<input type="hidden" name="dcp_id" id="dcp_id" value="">
									<input type="hidden" name="charge" id="charge" value="">
									<input type="hidden" name="name" id="name" value="">
									<input type="hidden" name="subs_type" id="subs_type" value="n">
								</form>
						</div>
					</div>
				</div>
			</div>
			<!-- right main body end -->

		</div>
	</div>
</div>
<script>

$(".buynow").click(function(){
 $('#dcp_id').val($(this).data("id"));
 $('#charge').val($(this).data("value"));
 $('#name').val($(this).data("name"));
 $('#dcsubpayment').submit();
 //alert(rbsp_id +'---'+charge);
 //$.post( "<?php echo base_url('rboard/subscription_payment');?>", { rbsp_id: rbsp_id, charge: charge } );
});
</script>