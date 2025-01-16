<?php $this->load->view('template/picture_provider'); ?>



<div class="innerContent">

	<div class="container">

		<div class="row">

<!-- <div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
        	</div> -->

		<?php 

		$this->load->view('provider/sidebar');

		?>	



		 



	<div class="col-sm-8">





			<h3 class="border-title text-left">Training Registration Listing</h3>

			<div class="step-wise-query">

			 <?php echo $this->session->flashdata('response');?> 
			 <div class="table-responsive">
			 <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>

            <tr>

                <th>No.</th>

					<th>Training Seminar Name</th>  

					<th>Payment Mode</th>  

					<th>Amount</th>  

					<th>User Name</th>  

					<th>User Email</th> 

					<th>Action</th> 

            </tr>

        </thead>

        <tbody>



           <?php 	

           $sum1 = 0;

           $sum2 = 0;

				

				foreach ($registration as $key => $value) {

				  $rdata = $this->user->get_record_by_field_name_all_record('tbl_training','id',$value['training_seminar_id']);	



				  if($value['payment_mode']=="Online"){

				  	$on = "Online";

				  	$sum1 = $sum1+$value['amount'];

				  } else {

				  	$on = "Offline";

				  	$sum2 = $sum2+$value['amount'];

				  } 



				?>



				<tr>

					<td><?php echo $key+1; ?>.</td> 

					<td><?php echo $rdata[0]['title']; ?></td> 

					<td><?php echo $on; ?></td> 

					<td><?php echo '$'.$value['amount']; ?></td>  

					<td><?php echo $value['name']; ?></td>  

					<td><?php echo $value['email']; ?></td>  

					  

					<td>

						<a target="_blank" class="btn btn-primary" title="View" href="<?php echo site_url('provider/training_registration_view/'.$value['id'].'');?>"><i class="fa fa-eye"></i></a>

					</td> 

										

				</tr>



				<?php } ?>

            

        </tbody>

<p style="font-weight: bold;">

Online Total  &nbsp;&nbsp;&nbsp;<?php echo '$'.$sum1; ?><br>

Offine Total  &nbsp;&nbsp;&nbsp;  <?php echo '$'.$sum2; ?>

</p>

    </table>
</div>
			 



			 







			</div>	

		  </div>

		</div>

	</div>

</div>

  

</div>



<script type="text/javascript">

	

$(document).ready(function() {

    $('#example').DataTable();

} );



</script>