<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
	<div class="container">
		<div class="row">
	<div class="col-sm-12">
		<!-- <div class="pull-right">
			<a href="#"> <input type="button" name="free" id="free" value="PROFESSIONAL VERSION" class="btn btn-danger"> </a> 
			<a href="#"> <input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn  btn-primary"> </a>
		</div> -->
		<div class="clearfix">
			<h3 class="border-title pull-left">Training / Seminar</h3>
        	<a href="<?php echo base_url('provider/training_center_list'); ?>" class="btn btn-primary pull-right">Back</a>
		</div>
			<div class="step-wise-query provider-overview">
				<?php //$this->load->view('provider/training_menu'); ?>
			<div class="tab-content steps-detail">
				<h3>Training Publish</h3>
				<div class="row">
				<?php echo $this->session->flashdata('response');?> 	 
					<div class="col-sm-2 form-group">
						<a href="<?php // echo site_url('provider/training_save');?>" onclick="alert('Your Training has been saved successfully.');">	<input type="submit" class="btn btn-primary btn-lg" value="SAVE ONLY"></a>
				   </div>

			    <?php $name = $this->db->get_where('tbl_training',array('id'=>$trid))->row_array(); ?>

					<div class="col-sm-12 form-group">
						<br><br>
						<p style="color: red; font-size: 17px;"> Congratulations you have successfully saved the <b><?php echo $name['title']; ?></b>. <br>Please click the link below to view your training. 
						 	<br><br>
						 	<a style="color: blue;" href="<?php echo base_url('pages/training_details/').$trid; ?>">
						 		<?php echo base_url('pages/training_details/').$trid; ?>
						 	</a>
						</p>		
					</div>
				</div> 
			</div>
			</div>
		</div>
		</div>
	</div>
</div>
</div>