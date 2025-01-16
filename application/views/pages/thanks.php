<?php //$this->load->view('template/search'); ?>


<meta http-equiv="refresh" content="25;url=<?=BASE_URL.'professional/dashboard';?>" />
<div class="innerContent">
	<div class="container">
		<div class="row">
		<div class="col-sm-12">
			<center>
				<img src="<?php echo ASSETS_URL.'images/tick.png'; ?>" alt="" style="margin-bottom: 20px;">
	 			<h1>Your order is successful.</h1>
				<p>Transaction id : <?php echo $txn_id; ?></p>
				<a href="<?php echo BASE_URL.'professional/dashboard';?>" class="btn btn-primary">Click here to continue.</a>
			</center>

			
		</div> 
		</div>
	</div>
</div>