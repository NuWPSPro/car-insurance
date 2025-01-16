<?php $this->load->view('admin/picture'); ?>

 <div class="innerContent admin-guidepanal">

	<div class="container">

		

	

	

		<div class="row">



		<?php 

		$this->load->view('admin/sidebar');

		?>	



		<div class="col-sm-9">

		<h3 class="border-title text-center">Manage Exam Result & Guide</h3> 



		<?php echo $this->session->flashdata('response');?>	

			 

<form action="<?php echo site_url();?>/admin/guide" method="post" enctype="multipart/form-data" name="form1" id="form1">

 

 

<!-- PRC exam result " and " Cpd guide

 -->

  <div class="form-group">

    <label for="email">Type:</label>

    <select class="form-control" id="type" name="type">

      <option value="" selected>Please Select</option>

      <option value="exam">PRC exam</option>

      <option value="guide">Cpd guide</option>

    </select> 

     <span class="error"><?php echo  form_error('type'); ?></span>

  </div>



  <div class="form-group">

    <label for="email">Title:</label>

    <input type="text" class="form-control" id="title" name="title">

     <span class="error"><?php echo  form_error('title'); ?></span>

  </div> 





  <div class="form-group admin-texteditbox">

    <label for="email">Description:</label>

    <textarea class="form-control text_editor" name="description" id="description"></textarea> 

     <span class="error"><?php echo  form_error('description'); ?></span>

  </div>

    

  <button type="submit" class="btn btn-primary">Submit</button>

</form>









	

			

		</div>

		</div>

	</div>

</div>