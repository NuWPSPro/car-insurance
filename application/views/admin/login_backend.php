<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-countrywebpage-panal">
	<div class="container">
    
		<div class="row">
		<?php  $this->load->view('admin/sidebar'); ?>	
		<div class="col-sm-9">
			<h3 class="border-title text-left">Login Page Backend</h3>
		 <!-- <?php $cont=$this->db->get_where('countries',array("countries_id"=>$this->uri->segment(3)))->row_array(); ?> -->

            <?php echo form_open_multipart('admin/login_backend/').$lb_id['id']; ?>
            <?php echo $this->session->flashdata('response');?> 
            <p>
                <label>Title: <span class="required"> * </span> </label>
				<input type="text" class="form-control" name="title" size="20" value="<?php echo $lb_row['title']; ?>" placeholder="Salute to professional" required>
				<input class="form-control" name="lbid" value="<?php echo $lb_row['id']; ?>"  type="hidden">
                <span class="error"><?php echo  form_error('title'); ?></span>
            </p>
            <p>
                <label>Sub-Title: <span class="required"> * </span> </label>
                <input type="text" class="form-control" name="sub_title" size="20" value="<?php echo $lb_row['sub_title']; ?>" placeholder="Please enter sub-title" required>
                <span class="error"><?php echo  form_error('sub_title'); ?></span>
            </p>

            <p>
                <label>Profession<span class="required"> * </span> </label>             
                <select name="profession" class="form-control" required>
                <option value="">Please select Profession</option>
                <?php foreach($category as $key => $value){ ?>
                <option value="<?=$value['id']; ?>" <?php if($lb_row['profession_id'] == $value['id']){ echo 'selected' ; } ?> ><?=$value['cat_name']; ?></option>
                <?php } ?>
                </select>
                <span class="error"><?php echo  form_error('profession'); ?></span>
            </p>
            
            <p>
                <label>Upload Background Image <span class="required"> * </span></label>
                <input class="form-control" name="background_image" type="file">
                <span class="error"><?php echo  form_error('background_image'); ?></span>
            </p>
        <?php if($this->uri->segment(3)!=''){
                 if($lb_row['background_image']){ ?>
                <label>Uploaded Background Image <span class="required"> * </span></label>
            <p>
                <img src="<?php echo ASSETS_URL.'upload/login_backend/'.$lb_row['background_image']; ?>" width="250" alt="Background Image">
            </p>
            <?php }else{
                    echo'No image found!';
                } 
            } ?>
            <p>
                <label>Status: <span class="required"> * </span> </label>
                <input type="radio" id="status1" name="status" value="1" <?php if($lb_row['status'] == '1' ){ echo 'checked'; } ?> required>
                <label for="status1"> Active </label>
                <input type="radio" id="status0" name="status" value="0" <?php if($lb_row['status'] == '0' ){ echo 'checked'; } ?> required>
                <label for="status0"> Inactive </label>
                <span class="error"><?php echo  form_error('status'); ?></span>
            </p>
            <p class="submit pull-right">
                <input class="btn btn-primary" value="Save" type="submit" name="save">
            </p>
            <?php echo form_close(); ?>

            <br>
            <br>
            <hr>
		<?php if($this->uri->segment(3)==''){ ?>
            <h3 class="border-title"> List of login Backend</h3>
            <?php if(count($login_backend_list)>0){ ?>
            <div class="table-responsive">
              <table id="login_backend_list" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sl.no.</th>
                    <th>Title</th>
                    <th>Sub-Title</th>
                    <th>Profession</th>
                    <th>Background-image</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                    <?php $count=1;
                    foreach($login_backend_list as $value){ ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $value['title'];?></td>
                      <td><?php echo $value['sub_title'];?></td>
                      <td><?php echo $value['profession_name'];?></td>
                      <td><img src="<?php echo ASSETS_URL.'upload/login_backend/'.$value['background_image']; ?>" alt="Background-image" width="150"></td>
                      <td><?php echo ($value['status'] == 1)?'<span class="badge badge-primary">Active</span>':'<span class="badge badge-info">Inactive</span>';?></td>
                      <td colspan="3">
                        <a href="<?php echo BASE_URL.'admin/login_backend/'.$value['id']; ?>" class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo BASE_URL.'admin/login_backend_delete/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure, Do you want to DELETE this!')" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $count++; } ?>
                  </tbody>
              </table>
            </div>
              <?php }else{ echo'<center>No Data Found!</center>';}?>
            <!-- </div> -->
          <?php } ?>


            </div>
 
		</div>
	</div>
</div>

<script>
    $(document).ready(function(){
        $('#login_backend_list').dataTable();
    });
</script>