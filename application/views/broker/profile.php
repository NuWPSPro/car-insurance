<?php  $this->load->view('broker/picture'); ?>

<div class="innerContent author-profile">
	<div class="container">
		<div class="row">
		
		<div class="col-sm-9">
        <?php echo $this->session->flashdata('response');?> 
            <h3 class="border-title text-left"><?=$body_heading; ?></h3>
            <div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<td width="30%">Name</td>
					<td><?php echo $details['name'];?></td>
				</tr>
				<tr>
					<td>Profession</td>
					<td><?php echo $details['profession'];?></td>
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

                <tr>
                    <td>Date of Approval</td>
                    <td><?php echo $details['approval_date'];?></td>
                </tr>

            </table>
        </div>
    <hr style="border-top: 2px solid #eee;">

<form action="<?php echo BASE_URL;?>author/profile" method="post" enctype="multipart/form-data" name="form1" id="form1">

<h3 class="border-title text-left">Edit Profile</h3>

        <div class="col-sm-12 mb-3">
            <label>Name <span class="required"> * </span> </label>
            <input name="name" class="form-control" size="20"  type="text" value="<?php echo $details['name'];?>" required>
            <span class="error"><?php echo  form_error('name'); ?></span>
        </div>

        <div class="col-sm-12 mb-3">
            <label>Nationality <span class="required"> * </span> </label>
            <select name="location" id="location" class="form-control">
                <option value="">Select Country</option>
                <?php foreach ($country_list as $key => $value){ if($details['location'] == $value['countries_id']){ $condition ='selected'; }else{ $condition =''; } ?>
                <option value="<?php echo $value['countries_id']; ?>" <?=$condition?> ><?php echo $value['countries_name']; ?>
                </option><?php  } ?>
            </select>
            <span class="error"><?php echo  form_error('location'); ?></span>
        </div>

        <div class="col-sm-6 mb-3">
            <label>Country of Residence <span class="required"> * </span> </label>
            <select required name="country" id="country" class="form-control">
                <option value="">Select Country</option>
                <?php foreach ($country_list as $key => $value) { if($details['country'] == $value['countries_id']){ $condition ='selected'; }else{ $condition =''; } ?>
                <option value="<?php echo $value['countries_id']; ?>" <?=$condition?> ><?php echo $value['countries_name']; ?></option>
                <?php }  ?>
            </select>
        </div>

        <div class="col-sm-6 mb-3">
            <label>State </label> 
                <input type="text" name="state" id="state" class="form-control" value="<?php echo set_value('state',$details['state']); ?>"> 
        </div>

        <div class="col-sm-6 mb-3">
            <label>City </label> 
            <input type="text" name="city" id="city" class="form-control" value="<?php echo set_value('city',$details['city']); ?>"> 
        </div>

        <div class="col-sm-6 mb-3">
            <label>Telephone No. <span class="required"> * </span> </label>
            <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo set_value('mobile',$details['mobile']); ?>" required>
        </div>

        <div class="col-sm-12 mb-3">
            <label>Address </label>
            <textarea rows="5" cols="5" name="address" id="address" class="form-control"><?php echo $details['address'];?></textarea>
        </div>
      <!--   <div class="col-sm-6">
            <label>Street </label> 
            <input type="text" name="street" id="street" class="form-control" value="<?php echo set_value('street',$details['street']); ?>">
        </div> -->

        

        <div class="col-sm-6 mb-3">
            <label>Skype Name <span class="required"> * </span> </label>
            <input type="text" name="skype" id="skype" class="form-control" value="<?php echo set_value('skype',$details['skype']); ?>" required>
        </div>

       <div class="col-sm-6 mb-3">
        <label>Profession <span class="required"> * </span> </label>
            <select class="form-control" name="category" id="category" required>
                <option value="">Select</option>
                <?php foreach ($profession_list as $key => $value) { ?>
                <option <?php if($details['profession']==$value['cat_name']){ echo "selected";} ?> value="<?php echo $value['cat_name'];?>"><?php echo $value['cat_name'];?></option>
                    <?php } ?>
            </select>
        </div>

        <div class="col-sm-6 mb-3">
            <label>Licence Number <span class="required"> * </span> </label>
            <input required name="licence" id="licence" class="form-control" value="<?php echo set_value('licence',$details['licence']); ?>" size="20" type="text">
        </div>

        <div class="col-sm-6 mb-3">
            <label>Licence Issued <span class="required"> * </span> </label>
            <input required name="licence_issued" id="licence_issued" class="form-control" value="<?php echo set_value('licence_issued',$details['licence_issued']); ?>" size="20" type="date">
        </div>

        <div class="col-sm-6 mb-3">
            <label>Issuing Institution <span class="required"> * </span> </label>
            <input required name="issuing_institution" id="issuing_institution" class="form-control" value="<?php echo set_value('issuing_institution',$details['issuing_institution']); ?>" size="20" type="text">
        </div>

        <div class="col-sm-6 mb-3">
            <label>Issuing Country <span class="required"> * </span> </label>
            <select required name="issuing_country" id="issuing_country" class="form-control">
                <option value="">Select Country</option>
                <?php foreach ($country_list as $key => $value){ if($details['issuing_country'] == $value['countries_id']){ $condition ='selected'; }else{ $condition =''; } ?>
                <option value="<?php echo $value['countries_id']; ?>" <?=$condition?> ><?php echo $value['countries_name']; ?></option><?php } ?>
            </select>
        </div>

        <div class="col-sm-6 mb-3">
            <label>Profile Image </label>
            <input class="form-control" name="image" type="file">
            <span class="error"><?php echo form_error('image'); ?></span>
        </div>
        <div class="col-sm-6 mb-3">
            <img src="<?php echo ASSETS_URL.'images/uploads/'.$details['image']; ?>" width="90">
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
        </div>
    </div>
</div>