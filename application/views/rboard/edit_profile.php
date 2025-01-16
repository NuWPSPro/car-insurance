<?php $this->load->view('rboard/picture'); ?>

 <div class="innerContent professional-profile">
	<div class="container">
        <div class="row">
            <?php  $this->load->view('rboard/sidebar');  ?> 
            
            <div class="col-sm-8">
	        <?php echo $this->session->flashdata('response');?> 
                <div class="card">
                    <div class="card-header">
                        <h3 class="border-title text-left">Edit Profile</h3>
                    </div>
                    
                    <div class="card-body">
                    <!-- <pre><?php print_r($profile);?></pre> -->
                        <form action="<?php echo BASE_URL;?>rboard/edit_profile" method="post" enctype="multipart/form-data" name="form1" id="form1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name of Professional Regulatory Board/Council: <span class="required"> * </span></label>
                                    <input name="name" id="name" class="form-control" value="<?php echo $profile->name;?>" size="20" type="text">
                                    <input name="user_id" class="form-control" value="<?php echo $profile->id;?>"type="hidden">
                                        <span class="error"><?php echo form_error('name'); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Country : <span class="required"> * </span></label>
                                    <div class="selection-box">
                                        <?php $country = $this->user->get_record_by_field_name_all_record('countries','status',1); ?>
                                        <select name="country_name" id="country_name" class="form-control" required>
                                            <option value="">Select Country</option>
                                            <?php foreach ($country as $key => $value){ ?>
                                            <option value="<?php echo $value['countries_id']; ?>" <?php if($profile->country==$value['countries_id']){ echo "selected";} ?>><?php echo $value['countries_name']; ?></option>
                                            <?php  } ?>
                                        </select>
                                        <span class="error"><?php echo  form_error('country_name'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State :  <span class="required"> * </span> </label>
                                    <input name="state" class="form-control" value="<?php echo $profile->state; ?>" size="20" type="text" required>
                                    <span class="error"><?php echo  form_error('state'); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>city :  <span class="required"> * </span> </label>
                                    <input name="city" class="form-control" value="<?php echo $profile->city; ?>" size="20" type="text" required>
                                    <span class="error"><?php echo  form_error('city'); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Street :  <span class="required"> * </span> </label>
                                    <input name="street" class="form-control" value="<?php echo $profile->street; ?>" size="20" type="text" required>
                                    <span class="error"><?php echo  form_error('street'); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name of Representative :  <span class="required"> * </span> </label>
                                    <input name="representative" class="form-control" value="<?php echo $profile->representative; ?>" size="20" type="text" required>
                                    <span class="error"><?php echo  form_error('representative'); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Designation :  <span class="required"> * </span> </label>
                                    <input name="position" class="form-control" value="<?php echo $profile->position; ?>" size="20" type="text" required>
                                    <span class="error"><?php echo  form_error('position'); ?></span>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Telephone :  <span class="required"> * </span> </label>
                                    <input name="mobile" class="form-control" value="<?php echo $profile->mobile; ?>" size="20" type="text" required>
                                    <span class="error"><?php echo  form_error('mobile'); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Photo</label>
                                    <input type="file" id="exampleInputFile" class="btn btn-primary" name="image">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php if(!empty($profile->image)){  $path = ASSETS_URL.'images/uploads/'.$profile->image; }else{ $path = ASSETS_URL.'images/staff-3.png'; }  ?>
                                    <img src="<?php echo $path;?>" style="width:150px; padding-top: 10px;">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group"> 
                                    <p class="submit alignleft">
                                        <input class="btn btn-success" value="Update" type="submit" name="save">
                                    </p>
                                </div>
                            </div>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







