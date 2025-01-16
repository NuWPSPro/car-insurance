<?php $this->load->view('template/picture_author'); ?>

<div class="innerContent author-profile">
	<div class="container">
		<div class="row">
		<?php $this->load->view('author/sidebar'); ?>
		<div class="col-sm-9">
            <h3 class="border-title text-left">Profile</h3>
            <div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<td width="30%">Name</td>
					<td><?php echo $profile[0]['name'];?></td>
				</tr>
				<tr>
					<td>Profession</td>
					<td><?php echo $profile[0]['profession'];?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><?php echo $profile[0]['username_email'];?></td>
				</tr>
				<tr>
					<td>Country</td><?php $country = $this->db->get_where('countries',array('countries_id'=>$profile[0]['country']))->row_array()['countries_name'];?>
					<td><?php echo $country;?></td>
				</tr>
				<tr>
					<td>Registered Date</td>
					<td><?php echo $profile[0]['added_on'];?></td>
				</tr>

                <tr>
                    <td>Date of Approval</td>
                    <td><?php echo $profile[0]['approval_date'];?></td>
                </tr>

            </table>
        </div>
            <hr style="border-top: 2px solid #eee;">

    <form action="<?php echo BASE_URL;?>author/profile" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <?php echo $this->session->flashdata('response');?> 
    <h3 class="border-title text-left">Edit Profile</h3>

            <div class="col-sm-12 mb-3">
                <label>Name <span class="required"> * </span> </label>
                <input name="name" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['name'];?>" required>
                <span class="error"><?php echo  form_error('name'); ?></span>
            </div>

            <div class="col-sm-12 mb-3">
                <label>Nationality <span class="required"> * </span> </label>
                <select name="location" id="location" class="form-control">
                    <option value="">Select Country</option>
                    <?php foreach ($country_list as $key => $value){ if($profile[0]['location'] == $value['countries_id']){ $condition ='selected'; }else{ $condition =''; } ?>
                    <option value="<?php echo $value['countries_id']; ?>" <?=$condition?> ><?php echo $value['countries_name']; ?>
                    </option><?php  } ?>
                </select>
                <span class="error"><?php echo  form_error('location'); ?></span>
            </div>

            <div class="col-sm-6 mb-3">
                <label>Country of Residence <span class="required"> * </span> </label>
                <select required name="country" id="country" class="form-control">
                    <option value="">Select Country</option>
                    <?php foreach ($country_list as $key => $value) { if($profile[0]['country'] == $value['countries_id']){ $condition ='selected'; }else{ $condition =''; } ?>
                    <option value="<?php echo $value['countries_id']; ?>" <?=$condition?> ><?php echo $value['countries_name']; ?></option>
                    <?php }  ?>
                </select>
            </div>

            <div class="col-sm-6 mb-3">
                <label>State </label> 
                    <input type="text" name="state" id="state" class="form-control" value="<?php echo set_value('state',$profile[0]['state']); ?>"> 
            </div>

            <div class="col-sm-6 mb-3">
                <label>City </label> 
                <input type="text" name="city" id="city" class="form-control" value="<?php echo set_value('city',$profile[0]['city']); ?>"> 
            </div>

            <div class="col-sm-6 mb-3">
                <label>Telephone No. <span class="required"> * </span> </label>
                <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo set_value('mobile',$profile[0]['mobile']); ?>" required>
            </div>

            <div class="col-sm-12 mb-3">
                <label>Address </label>
                <textarea rows="5" cols="5" name="address" id="address" class="form-control"><?php echo $profile[0]['address'];?></textarea>
            </div>
          <!--   <div class="col-sm-6">
                <label>Street </label> 
                <input type="text" name="street" id="street" class="form-control" value="<?php echo set_value('street',$profile[0]['street']); ?>">
            </div> -->

            

            <div class="col-sm-6 mb-3">
                <label>Skype Name <span class="required"> * </span> </label>
                <input type="text" name="skype" id="skype" class="form-control" value="<?php echo set_value('skype',$profile[0]['skype']); ?>" required>
            </div>

           <div class="col-sm-6 mb-3">
            <label>Profession <span class="required"> * </span> </label>
                <select class="form-control" name="category" id="category" required>
                    <option value="">Select</option>
                    <?php foreach ($profession_list as $key => $value) { ?>
                    <option <?php if($profile[0]['profession']==$value['cat_name']){ echo "selected";} ?> value="<?php echo $value['cat_name'];?>"><?php echo $value['cat_name'];?></option>
                   	 <?php } ?>
                </select>
            </div>

            <div class="col-sm-6 mb-3">
                <label>Licence Number <span class="required"> * </span> </label>
                <input required name="licence" id="licence" class="form-control" value="<?php echo set_value('licence',$profile[0]['licence']); ?>" size="20" type="text">
            </div>

            <div class="col-sm-6 mb-3">
                <label>Licence Issued <span class="required"> * </span> </label>
                <input required name="licence_issued" id="licence_issued" class="form-control" value="<?php echo set_value('licence_issued',$profile[0]['licence_issued']); ?>" size="20" type="date">
            </div>

            <div class="col-sm-6 mb-3">
                <label>Issuing Institution <span class="required"> * </span> </label>
                <input required name="issuing_institution" id="issuing_institution" class="form-control" value="<?php echo set_value('issuing_institution',$profile[0]['issuing_institution']); ?>" size="20" type="text">
            </div>

            <div class="col-sm-6 mb-3">
                <label>Issuing Country <span class="required"> * </span> </label>
                <select required name="issuing_country" id="issuing_country" class="form-control">
                    <option value="">Select Country</option>
                    <?php foreach ($country_list as $key => $value){ if($profile[0]['issuing_country'] == $value['countries_id']){ $condition ='selected'; }else{ $condition =''; } ?>
                    <option value="<?php echo $value['countries_id']; ?>" <?=$condition?> ><?php echo $value['countries_name']; ?></option><?php } ?>
                </select>
            </div>

            <div class="col-sm-6 mb-3">
                <label>Profile Image </label>
                <input class="form-control" name="image" type="file">
                <span class="error"><?php echo form_error('image'); ?></span>
            </div>
            <div class="col-sm-6 mb-3">
                <img src="<?php echo ASSETS_URL.'images/uploads/'.$profile[0]['image']; ?>" width="90">
            </div>
                            
            <div class="col-sm-12 submit alignleft">
                <input class="btn btn-primary" value="Update" type="submit" name="save">
            </div>

        </form>

            </div>
		</div>
	</div>
</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>