<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
	<div class="container">
		
	
		<h2 class="border-title text-left">Dashboard</h2>
		<div class="row">

		<?php 
		$this->load->view('admin/sidebar');
		?>	

		 


		<div class="col-sm-8">
			<h3 class="border-title text-center">Advertisement Listing</h3> 
			
			 

<form action="<?php echo BASE_URL;?>admin/notification" method="post" enctype="multipart/form-data" name="form1" id="form1">

<?php echo $this->session->flashdata('response');?> 

<div class="form-group">
<label>Subject <span class="required"> * </span> </label>
<input name="subject" class="form-control" size="20"  type="text">
<span class="error"><?php echo  form_error('subject'); ?></span>
</div>
<div class="form-group">
<label>Message <span class="required"> * </span> </label>
<input name="message" class="form-control" size="20"  type="text">
<span class="error"><?php echo  form_error('message'); ?></span>
</div>
<div class="form-group">
<input class="btn btn-primary btn-lg" value="Update" type="submit" name="save">
<span class="error"><?php echo  form_error('message'); ?></span>
</div>

</form>


	
			
		</div>
		</div>
	</div>
</div>