<?php  $this->load->view('carowner/picture'); ?>

		<!-- Main body start -->
		<div class="col-sm-9">
			<?=$body_heading; ?>
            <div class="table-responsive">
			<table class="table table-striped">
                                <tr>
                                    <td width="30%">Name</td>
                                    <td><?php echo $details['fname'];?> <?php echo $details['name'];?> <?php echo $details['lname'];?> </td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $details['username_email'];?></td>
                                </tr>
                                <tr>
                                    <td>Country</td><?php $country = $this->db->get_where('countries',array('countries_id'=>$details['country']))->row_array()['countries_name'];?>
                                    <td><?php echo $country;?></td>
                                </tr>
                                <tr>
                                    <td>Registered Date</td>
                                    <td><?php echo $details['added_on'];?></td>
                                </tr>

                            </table>
                            <hr style="border-top: 2px solid #eee;">
                                <form action="<?php echo BASE_URL.'professional/profile';?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <h3 class="border-title text-left">Edit Profile</h3>
                            <div class="col-sm-12">
                                <p>
                                    <label>First Name <span class="required"> * </span> </label>
                                    <input name="f_name" class="form-control" size="20"  type="text" value="<?php echo $details['fname'];?>">
                                    <span class="error"><?php echo  form_error('f_name'); ?></span>
                                </p>
                            </div>
                            <div class="col-sm-12">
                                <p>
                                    <label>Middle Name <span class="required"> * </span> </label>
                                    <input name="m_name" class="form-control" size="20"  type="text" value="<?php echo $details['name'];?>">
                                    <span class="error"><?php echo  form_error('m_name'); ?></span>
                                </p>
                            </div>
                            <div class="col-sm-12">
                                <p>
                                    <label>Last Name <span class="required"> * </span> </label>
                                    <input name="l_name" class="form-control" size="20"  type="text" value="<?php echo $details['lname'];?>">
                                    <span class="error"><?php echo  form_error('l_name'); ?></span>
                                </p>
                            </div>
                                
                            <div class="col-sm-6"><p>
                            <label>Country<span class="required"> * </span> </label>
                                    <select name="country_name" id="country_name" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach ($country_list as $key => $value) { ?>
                                        <option value="<?php echo $value['countries_id']; ?>"<?php if($details['country']==$value['countries_id']){ echo "selected"; } ?> ><?php echo $value['countries_name']; ?></option><?php } ?>
                                    </select>
                                    <span class="error"><?php echo  form_error('country_name'); ?></span>
                            </p>
                            </div>

                    
                            <div class="col-sm-6">
                                <p>
                                    <label>Profile Image <small id="" class="form-text text-muted"></small></label>
                                    <input class="form-control" name="image" type="file">
                                    <span class="error"><?php echo form_error('image'); ?></span>
                                </p>
                            </div>	
                            
                            <div class="col-sm-12">
                                <p class="submit alignleft">
                                    <input class="btn btn-primary" value="Update" type="submit" name="save">
                                </p>
                            </div>
</div>

</form>



  
		
		</div>
    <!-- Main body end -->


        <!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>

