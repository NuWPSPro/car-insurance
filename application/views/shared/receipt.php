<?php //echo '<pre>'; print_r($purchase_details);?>
<div class="order-receipt">
	<div class="row">
		<div class="col-sm-6">
			<div class="box-layout" style="height:175px;">
				<div class="box-title">Bill To</div>
					<div class="box-desc">
						<p><strong><?php echo $purchase_details['username']; ?></strong><br></p>
						<p><?php echo $purchase_details['countries_name']; ?></p>
					</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="box-layout" style="height:175px;">
			<div class="box-title">Invoice Date</div>
				<div class="box-desc">
					<p><strong><?php echo $purchase_details['added_on']; ?></strong><br></p>						 
				</div>
			</div>
		</div>
	</div>
	<table class="table table-bordered">
		<tr>
			<th>Description</th>
			<th width="10%">Qty</th>
			<th width="15%">Price</th>
			<th width="15%">Amount</th>
		</tr>
		<tr>
			<td>
			<?php echo $purchase_details['course_title']; ?>
				<div class="transaction-short-desc"> 
					Transaction id: <b><?php echo $purchase_details['txn_id']; ?></b>
				</div>
			</td> 
			<td class="text-center">1</td>
			<td class="text-right">$<?php echo number_format($purchase_details['amount'],2); ?></td>
			<td class="text-right">$<?php echo number_format($purchase_details['amount'],2); ?></td>								
		</tr>
		
		<tr>
			<td>Sales Tax </td>
			<td class="text-right" colspan="2">$<?php echo number_format($purchase_details['tax'],2); ?></td>
			<td class="text-right">$<?php echo number_format($purchase_details['tax'],2); ?></td>
		</tr>
	<!-- 	<tr>
			<td>Paypal Charges</td>
			<td class="text-right" colspan="2">$<?php echo $purchase_details['paypalCharge']; ?></td>
			<td class="text-right">$<?php echo $purchase_details['paypalCharge']; ?></td>
		</tr> -->
		<tr>
			<td>Thank you for using Ceonpoint.com! We would be glad if you can refer a friend to our website if you are satisfied with our service. If not ,please contact us at <b><?php echo EMAIL; ?></b> 
			and tell us how we can improve.</td>
			<?php $total = ($purchase_details['amount'] + $purchase_details['tax']); ?>
			<td class="text-right" colspan="2">Subtotal<br><br><strong>Total</strong></td>	
			<td class="text-right">$<?php echo number_format($total,2); ?><br> <br>
				<strong>$<?php echo number_format($total,2); ?></strong>
			</td>							
		</tr>
	</table>
</div>	