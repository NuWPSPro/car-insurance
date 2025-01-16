<?php $this->load->view('rboard/picture'); ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">
			<!-- left sidebar start -->
			<?php $this->load->view('rboard/sidebar'); ?>

			<?php
				if(count($details) > 0 && $details->rb_sub_key != ''){
					$type = 'r'; //renew
				}else{
					$type = 'n'; //new
				}
				$this->session->set_userdata('payment_type', $type);
			?>
			<!-- left sidebar end -->

			<!-- right main body start -->
			<div class="col-sm-8">
				<div class="card">
					<div class="card-header">
        				<h3 class="border-title text-left">Subscription Package</h3>
					</div>
				
					<div class="card-body">
						<div class="row">
								<!-- <pre><?php print_r($details);?></pre> -->
								<?php if(isset($package_list) && !empty($package_list)){ 
									foreach($package_list as $value){?>
									<div class="col-sm-4 d-flex">
										<div class="subscrib-box">
												<h5 class="text-center"><?=$value->subcription_name;?></h5 class="text-center">
											<!-- <p>Number of applications: <?=$value->no_of_applications;?></p> -->
											<div class="subc-dtl">
											<?=$value->subscription_details;?>
											</div>
											<!-- <p><?=$value->charge_per_application;?></p> -->
											<a href="javascript:void(0);" class="btn btn-info buynow" data-id="<?php echo $value->rbsp_id;?>" data-value="<?php echo $value->charge_per_application;?>" data-name="<?=$value->subcription_name;?>">$<?php echo number_format($value->charge_per_application);?><br>Pay Now</a>
										</div>
									
								</div>
								<?php } }else{ echo 'No dat found!'; } ?>
								<form id="rbsubpayment" method="post" action="<?php echo base_url('rboard/subscription_payment');?>">
									<input type="hidden" name="rbsp_id" id="rbsp_id" value="">
									<input type="hidden" name="charge" id="charge" value="">
									<input type="hidden" name="name" id="name" value="">
									<input type="hidden" name="subs_type" id="subs_type" value="<?php echo $type; ?>">
								</form>
						</div>
					</div>
				</div>
			</div>
			<!-- right main body end -->

		</div>
	</div>
</div>
<?php //print_r($this->session->all_userdata()); exit; ?>
<div id="payby" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm modal-centered">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">Choose Payment Option</h4>
        </div>
        <div class="modal-body text-center">
			<a href="javascript:void(0)" onclick="paybypaypal();" class="btn btn-primary"> PayPal</a> 
          	<a href="javascript:void(0)" onclick="paybypayu();" class="btn btn-warning">PayU Money</a>
          
          <!-- <a href="javascript:void(0)" onclick="paybystrip('<?php echo $course[0]['total']; ?>');" class="btn btn-info"> Card</a> -->
        </div>
      </div>
    </div>
</div>
<script>

$(".buynow").click(function(){
 $('#rbsp_id').val($(this).data("id"));
 $('#charge').val($(this).data("value"));
 $('#name').val($(this).data("name"));
 $('#payby').modal('show');
 //$('#rbsubpayment').submit();
 //alert(rbsp_id +'---'+charge);
 //$.post( "<?php echo base_url('rboard/subscription_payment');?>", { rbsp_id: rbsp_id, charge: charge } );
});
function paybypaypal() {
  $("#rbsubpayment").submit();
}
function paybypayu(total) {
	var url = "<?php echo base_url('payu/index')?>";
	var id = $('#rbsp_id').val();
	var name = $('#name').val();
	var price = $('#charge').val();
	var tax = 0;
  	window.location.href =url+'?id='+id+'&&name='+name+'&&price='+price+'&&tax='+tax+'&&type=RBoard Subscription';
}
</script>