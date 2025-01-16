<?php 
	$this->load->view('template/picture_provider'); 
	$idd = $this->uri->segment(3);
	$tdetails = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);

	if($tdetails[0]['training_type'] == 0){
			$_SESSION['service_type'] = "free";
			$version = "Basic Version";
		} else {
			$_SESSION['service_type'] = "paid";
		    $version = "Pro Version";
		} ?>

<div class="innerContent">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="step-wise-query provider-overview">
		 	 
				

<div class="tab-content steps-detail">
	<div id="step1" class="tab-pane fade in active">
		<div class="row" style="text-align: center;">
		<h3 style="color: red;"><?php echo $tdetails[0]['title']; ?></h3>
		<?php echo $this->session->flashdata('response');?>	
			<div class="col-sm-12 form-group">
				<a href="javascript:void(0)" onclick="alert('Your Training has been Published successfully.');">
				<input type="submit" class="btn btn-danger btn-lg" value="Published"></a>
			</div>		
			<div class="col-sm-12 form-group">
				<p style="color: red; font-size: 17px;"> Congratulations you have successfully published the <b><?php echo $tdetails[0]['title']; ?></b>.
					<br> Please click the link below to view your training. 
					<br>
				<a style="color: blue;" href="<?php echo base_url('pages/training_details/'.$trid);?>">Click here to View</a></p>
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