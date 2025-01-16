<div><?php

if (!empty($this->session->flashdata('message'))) {
  
	  echo $this->session->flashdata('message');
} elseif (!empty($this->session->flashdata('error'))) {

 
    echo $this->session->flashdata('error');
}

?></div>
<div class="col-sm-12">
                        <div class="form-group">
                            <label>Business/Company Name</label>
                            <input name="name" id="name" class="form-control" value="" size="20" type="text" required>
							 <span class="error"><?php echo  form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="col-sm-6" style="display: none;">
                        <div class="form-group">
                            <label>Role<span class="required"> * </span> </label>
                            <div class="selection-box">
                                <select name="role" id="role" class="form-control" onchange="selectrole()">
                                    <option value="">Select</option>
                                    <option <?php if($role=="advertisers"){ echo "selected";} ?> value="4">Advertisers</option>
                                    <option <?php if($role=="provider" ){ echo "selected" ;} ?> value="2">CPD Provider </option>
                                    <option <?php if($role=="professional" ){ echo "selected" ;} ?> value="1">Professional</option>
                                      <option <?php if($role=="institution" ){ echo "selected" ;} ?> value="5">Institution</option>
                                    <!-- <option <?php if($role=="agency"){ echo "selected";} ?> value="3">Placement Agencies</option> -->
                                    <option <?php if($role=="advertisers"){ echo "selected";} ?> value="4">Advertisers</option> 
                                </select>
                                <span class="error"><?php echo  form_error('role'); ?></span>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Country <span class="required"> * </span> </label>
                            <div class="selection-box">

                                <?php 
                                //$country = $this->db->get_where('countries',array('status'=>1))->row_array();
                                $country = $this->user->get_record_by_field_name_all_record('countries','status',1);  
                                ?>

                                <select name="country_name" id="country_name" class="form-control" required>
                                    <option value="">Select Country</option>
                                    <?php 
                                    foreach ($country as $key => $value) {
                                        ?>
                                         <option value="<?php echo $value['countries_id']; ?>"><?php echo $value['countries_name']; ?></option>
                                        <?php 
                                    }
                                    ?>
                            
                                </select>
                                <span class="error"><?php echo  form_error('location'); ?></span>
                            </div>
                        </div>
                    </div>

                           
<div class="col-sm-6">
    <div class="form-group">
        <label>Address <span class="required"> * </span> </label>
        <input name="address1" id="address" class="form-control" value="" size="20" type="text" required>
        <span class="error"></span>
    </div>
</div>


<div class="col-sm-6">
    <div class="form-group">
        <label>Contact Persion. <span class="required"> * </span> </label>
        <input name="mobile" id="mobile" class="form-control" value="" size="20" type="text" required>
        <span class="error"></span>
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        <label>Position <span class="required"> * </span> </label>
        <input name="position" id="position" class="form-control" value="" size="20" type="text" required>
        <span class="error"></span>
    </div>
</div>

         
<div class="col-sm-6">
    <div class="form-group">
        <label>Skype Name  </label>
        <input name="skype" id="skype" class="form-control" value="" size="20" type="text">
        <span class="error"></span>
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        <label>What's up </label>
        <input name="watsup" id="watsup" class="form-control" value="" size="20" type="text">
        <span class="error"></span>
    </div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<label for="exampleInputFile">Upload Photo</label>
		<input type="file" id="exampleInputFile" class="btn btn-primary">
	</div>
</div>

  <div class="col-sm-12">
    <div class="form-group">
        <label>Website</label>
        <input name="website" id="website" class="form-control" value="" size="20" type="text">
        <span class="error"></span>
    </div>
</div>



<div class="col-sm-4">
	<div class="form-group">
		<label>Username (email)<span class="required"> * </span> </label>
		<input name="username" id="username" class="form-control" value="" size="20" type="text" required>
		<span class="error"><?php echo  form_error('username'); ?></span>
	</div>
</div>
<div class="col-sm-4">
	<div class="form-group">
		<label>Password <span class="required"> * </span> </label>
		<input name="password" id="password" class="form-control" value="" size="20" type="password" required>
		<span class="error"><?php echo  form_error('password'); ?></span>
	</div>
</div>
<div class="col-sm-4">
	<div class="form-group">
		<label>Confirm Password <span class="required"> * </span> </label>
		<input name="con_password" id="con_password" class="form-control" value="" size="20" type="password" required>
		<span class="error"><?php echo  form_error('con_password'); ?></span>
	</div>
</div>
                    