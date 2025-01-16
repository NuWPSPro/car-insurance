<?php $this->load->view('template/picture_provider'); ?>



<div class="innerContent">
	<div class="container">
		<div class="row">
			<?php $this->load->view('provider/sidebar'); ?>	

	<div class="col-sm-8"> 
		<div class="step-wise-query"> 
		<div class="tab-content steps-detail">
			<a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
			<div id="step1" class="tab-pane fade in active">
				<?php if($this->uri->segment(3))
						{
							$cid = $this->uri->segment(3); 
						}else{
							$cid = $this->session->userdata('current_course_id');
						} 	// $result = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array(); ?>

				<h3>Congratulations!</h3>
				<p>Your online course <strong><?php echo $result['course_title']; ?></strong> is successfully <strong>saved</strong>.</p>
				<p>Please click the link to view your online course.</p>
				<p>Click here : 
					<a style="font-size: 20px;" href="<?php echo base_url('pages/course_details/').$cid; ?>" title="view"><?php echo base_url('pages/course_details/').$cid; ?>.</a></p>	 
			</div>
		</div>
		</div>
	</div>

		

		</div>

	</div>

</div>

  

</div>







 

 



 