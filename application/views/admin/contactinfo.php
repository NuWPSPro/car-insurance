<?php $this->load->view('admin/picture'); ?>

 <div class="innerContent admin-contactinfopanal">

	<div class="container">
  
		<div class="row">
		<?php 

		$this->load->view('admin/sidebar');

		?>	
		<div class="col-sm-9">

		<h3 class="border-title text-left">Manage Contact Info</h3> 

		<?php echo $this->session->flashdata('response');?>	

			 

      



 <form action="<?php echo site_url();?>/admin/contactinfo" method="post" enctype="multipart/form-data" name="form1" id="form1">

  <?php //echo $this->session->flashdata('response');?>

 

    <div class="form-group">

    <label for="email">email:</label>

    <input type="email" class="form-control" id="email" name="email" value="<?php echo $contactinfo[0]['email'];?>">

     <span class="error"><?php echo  form_error('email'); ?></span>

  </div>



  <div class="form-group admin-texteditbox">

    <label for="email">Phone:</label>

    <textarea class="form-control text_editor" id="phone" name="phone"><?php echo $contactinfo[0]['phone'];?></textarea>

     <span class="error"><?php echo  form_error('course_title'); ?></span>

  </div> 





  <div class="form-group admin-texteditbox">

    <label for="email">Address:</label>

    <textarea class="form-control text_editor" name="address" id="address"><?php echo $contactinfo[0]['address'];?></textarea>

     <span class="error"><?php echo  form_error('address'); ?></span>

  </div>

    

  <button type="submit" class="btn btn-primary">Submit</button>

</form>



			

		</div>

		</div>

	</div>

</div>