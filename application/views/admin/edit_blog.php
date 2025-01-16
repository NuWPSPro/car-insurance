<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
	<div class="container">
		
	
		<h2 class="border-title text-left">Dashboard</h2>
		<div class="row">

		<?php  $this->load->view('admin/sidebar'); ?> 
		<div class="col-sm-8">
			 
			<h3 class="border-title text-left"> Edit Blog Page</h3> 
                 <form action="<?php echo BASE_URL.'admin/edit_blog/'.$blog[0]['id']; ?>" method="post" enctype="multipart/form-data" name="form100" id="form100">      
                 	<?php echo $this->session->flashdata('response');?> 
	                 <div class="form-group">
	                        <label>Country <span class="required"> * </span> </label>
	                        <select name="country" id="country" class="form-control" required>
								<option value="" selected="">Choose Country</option>
                      			<option value="999">International</option>
								<?php foreach ($country as $key => $value){ ?>
								<option value="<?php echo $value['countries_id']; ?>" <?php if($blog[0]['country']==$value['countries_id']){ echo 'selected'; } ?>><?php echo $value['countries_name']; ?></option>
								<?php } ?>
							</select>
	                    <span class="error"><?php echo  form_error('country'); ?></span>
	                 </div>
																		
					<div class="form-group">
						<label>Title <span class="required"> * </span> </label>
						<input  name="title" id="title" class="form-control" size="20"  type="text" value="<?php echo $blog[0]['title']?>" required>
						<span class="error"><?php echo  form_error('title'); ?></span>
					</div>
			   
				    <div class="form-group">
					    <label for="email">Sort Description</label>
					    <textarea class="form-control text_editor" name="st_desc" id="st_desc"><?php echo $blog[0]['st_desc'];?></textarea>
					    <span class="error"><?php echo  form_error('st_desc'); ?></span>
				  	</div>

			   
				  <div class="form-group">
				    <label for="email">Description</label>
				    <textarea class="form-control text_editor" name="des" id="des"><?php echo $blog[0]['des'];?></textarea>
				    <span class="error"><?php echo  form_error('des'); ?></span>
				  </div>
		  
				<div class="form-group">
					<label>Image </label>
						<input class="form-control" name="image" size="20"  type="file">
					<span class="error"><?php echo  form_error('image'); ?></span>
				</div>
		
				<div class="form-group">
					<label for="email">Status</label>
					<select name="status" class="form-control" >
						<option value="1" <?php if($blog[0]['status'] == 1){echo 'selected';} ?> >Active</option>
						<option value="2" <?php if($blog[0]['status'] == 2){echo 'selected';} ?> >Deactive</option>
					</select>
					<span class="error"><?php echo  form_error('status'); ?></span>
				</div>
                <p class="submit alignleft">
                    <input class="btn btn-success" value="Save" type="submit" name="save">
                </p>

			</form>	
		</div>
	</div>
</div>
</div>