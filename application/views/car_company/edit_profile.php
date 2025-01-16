<?php  $this->load->view('car_company/picture'); ?>
    
    <!-- Main body start -->
 
    <div class="col-sm-9">
        <h1>Profile</h1>
            <?php echo $this->session->flashdata('response'); ?>
            

<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<td width="30%">Name</td>
					<td><?php echo $profile[0]['name'];?></td>
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

            </table>
        </div>
            <hr style="border-top: 2px solid #eee;">

    <form action="<?php echo BASE_URL;?>Provider/profile" method="post" enctype="multipart/form-data" name="form1" id="form1">
   
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
                <label>Designation  <span class="required"> * </span> </label>
                <input type="text" name="designation" id="designation" class="form-control" value="<?php echo set_value('position',$profile[0]['position']); ?>" required>
            </div>

           

            <div class="col-sm-6 mb-3">
                <label>Accreditation Number<span class="required"> * </span> </label>
                <input required name="accreditation_num" id="accreditation_num" class="form-control" value="<?php echo set_value('prc_acceditation_number',$profile[0]['prc_acceditation_number']); ?>" size="20" type="text">
            </div>

            <div class="col-sm-6 mb-3">
                <label>Website of Accrediting Body<span class="required"> * </span> </label>
                <input required name="website" id="issuing_institution" class="form-control" value="<?php echo set_value('accreditation_web',$profile[0]['accreditation_web']); ?>" size="20" type="text">
            </div>

            <div class="col-sm-6 mb-3">
                <label>Issuing Institution <span class="required"> * </span> </label>
                <input required name="issuing_institution" id="issuing_institution" class="form-control" value="<?php echo set_value('issuing_institution',$profile[0]['issuing_institution']); ?>" size="20" type="text">
            </div>

            <div class="col-sm-6 mb-3">
                <label>Validity <span class="required"> * </span> </label>
                <input required name="validity" id="validity" class="form-control" value="<?php echo set_value('validity',$profile[0]['validity']); ?>" size="20" type="date">
            </div>

            <div class="col-sm-6 mb-3">
           <label for="accreditation_doc">Accreditation Document<span class="required" style="font-size: 10px;">(You can attch pdf, docx, doc, png, jpg and jpeg files)</span></label>
          <input type="file" id="accreditation_doc" class="form-control" name="accreditation_doc" value="<?php echo set_value('accreditation_doc',$profile[0]['accreditation_doc']); ?>" >
                      
            </div>

            <div class="col-sm-6 mb-3">
                <a href="<?php echo ASSETS_URL.'images/uploads/'.$profile[0]['accreditation_doc']; ?>" class="btn btn-primary">View Doc</a>
                <!-- <img src="" width="90"> -->
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
    <!-- Main body end -->

        <!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>

