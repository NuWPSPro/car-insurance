<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
    <div class="container">
        <h2 class="border-title text-left">Dashboard</h2>
        <div class="row">
            <?php 

		$this->load->view('admin/sidebar');

		?>
            <div class="col-sm-8">
                <h3 class="border-title text-left">Edit Institution Category</h3>
                <?php echo $this->session->flashdata('response');?>
                <?php 

         $cid = $this->uri->segment('3');

        ?>
        <div class="alert alert-info clearfix">
                <form action="<?php echo site_url();?>/admin/category_institution_edit/<?php echo $cid;?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="col-md-5 form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" class="form-control" id="cat_name" name="cat_name" aria-describedby="emailHelp" placeholder="Enter category name" value="<?php echo $category[0]['cat_name'];?>">
                        <span class="error"><?php echo  form_error('cat_name'); ?></span>
                    </div>
                    <div class="col-md-3">
                    	<label style="display: block;">&nbsp;</label>
	                    <button type="submit" class="btn btn-primary">Update Category</button>
	                </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>