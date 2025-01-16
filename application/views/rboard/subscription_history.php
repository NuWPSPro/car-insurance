<?php $this->load->view('rboard/picture'); ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">
			<!-- left sidebar start -->
			<?php $this->load->view('rboard/sidebar'); ?>
			<!-- left sidebar end -->

			<!-- right main body start -->
			<div class="col-sm-8">
				<div class="card">
					<div class="card-header">
        				<h3 class="border-title text-left">Subscription History</h3>
					</div>
				
					<div class="card-body">
							<div class="table-responsive">
								<!-- <pre><?php print_r($purchase_history);?></pre> -->
								<?php if(isset($purchase_history) && !empty($purchase_history)){ 
										echo '<table class="table table-bordered">
												<tr>
													<th>SL No.</th>
													<th>Package Name</th>
													<th># of Online Services</th>
													<th>Date Purchased</th>
													<th>Action</th>
												</tr>';
										$count = 1;		
									foreach($purchase_history as $value){
										echo '<tr>
												<td>'.$count++.'.</td>
												<td>'.$value->product_name.'</td>
												<td>'.$value->no_of_applications.'</td>
												<td>'.date('M d, Y',strtotime($value->added_on)).'</td>
												<td><a href="'.base_url('rboard/subscription_package').'">Renew</a></td>
											</tr>';
									 } 
									 echo '</table>';
									 }else{ echo 'No data found!'; } ?>
							</div>
								<form id="rbsubpayment" method="post" action="<?php echo base_url('rboard/subscription_payment');?>">
									<input type="hidden" name="rbsp_id" id="rbsp_id" value="">
									<input type="hidden" name="charge" id="charge" value="">
									<input type="hidden" name="name" id="name" value="">
								</form>
					</div>
				</div>
			</div>
			<!-- right main body end -->

		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="rbBill" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><div class="site-logo__link" style="max-width: 34%;">
			<a href="<?php echo BASE_URL; ?>"><img src="<?php echo ASSETS_URL;?>/images/logo.png" alt="logo"></a>
		</div></center>
		<h4 class="modal-title">Receipt No. <span id="rid"></span></h4>
		</div>
		<p style="color: red; text-align: center; display: none;" id="waitmessage">Please wait.... </p>
		
		<div class="modal-body">
			<span id="responseData"></span>
		</div>            
	</div>
	</div>
</div>

<script>

$(".buynow").click(function(){
	$('#rbsp_id').val($(this).data("id"));
	$('#charge').val($(this).data("value"));
	$('#name').val($(this).data("name"));
	$('#rbsubpayment').submit();
	//alert(rbsp_id +'---'+charge);
	//$.post( "<?php echo base_url('rboard/subscription_payment');?>", { rbsp_id: rbsp_id, charge: charge } );
});

$(".showBill").click(function(){
	var idd = $(this).attr('data-id');
	var type = $(this).attr('data-value');
  	var receipt_type = type.substring(0,3).toUpperCase();
    $('#rid').html(receipt_type +' '+ idd);
    $('#waitmessage').show();
    $("#rbBill").modal('show');

    $.ajax({
    type: "POST",
    url: '<?php echo BASE_URL?>share/showBill',
    data: {idd:idd,type:type}
    }).done(function( result ) {
      //alert(result);
        $('#waitmessage').hide();
      $("#responseData").html( result );
    });              
    return false;   
});
</script>