<?php $this->load->view('template/picture_provider'); ?>



<div class="innerContent">

	<div class="container">

		<div class="row">

<!-- <div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
        	</div> -->

		<?php 

		//$this->load->view('provider/sidebar');

		?>	



		 



	<div class="col-sm-12">





			<h3 class="border-title text-left">Training Registration Detais</h3>

			<div class="step-wise-query">

			 <?php echo $this->session->flashdata('response');?> 

			 <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>

            <tr>

                <th>No.</th>

					<th>Title</th> 

					<th>Start Date</th> 

					<th>Start Time</th> 

					<th>Location</th> 

					<th>Speaker</th> 

					<th>Price</th> 

					<th>User Person</th> 

					<th>User Phone</th> 

					<th>User Email</th> 

            </tr>

        </thead>

        <tbody>

           <?php 

				foreach ($registration as $key => $value1) {

					 $value = $this->user->get_record_by_field_name_all_record('tbl_training','id',$value1['training_seminar_id']);	

				?>

				<tr>

					<td><?php echo $key+1; ?>.</td> 

					<td><?php echo $value[0]['title']; ?></td>     

					<td><?php echo $value[0]['start_date'].' - '.$value[0]['end_date']; ?></td>  

					<td><?php echo $value[0]['start_time'].' - '.$value[0]['end_time']; ?></td>  

					<td><?php echo $value[0]['location']; ?></td>  

					<td><?php echo $value[0]['speaker']; ?></td>  

					<td><?php echo $value[0]['price']; ?></td>  

					<td><?php echo $value1['name']; ?></td>  

					<td><?php echo $value1['phone']; ?></td>  

					<td><?php echo $value1['email']; ?></td>   

									

										

				</tr>

				<?php } ?>

            

        </tbody>

       

    </table>

			 



			 







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