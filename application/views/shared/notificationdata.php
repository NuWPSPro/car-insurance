

	<div class="order-receipt">

		<div class="row"> 

			<div class="col-sm-12">

				<p><?php echo $notification['message']; ?></p>

			</div>

			<div class="col-sm-12">

				<center>

				<a href="javascript:void(0)" onclick="replyForm()" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true" title="REPLY"></i></a>

				</center>

			</div>

		</div>	

	</div>	

		
	<script>
		function replyForm(){
		    jQuery("#notificationPopup").modal('hide');
		    jQuery("#replyenquery").modal('show');
		}
	</script>