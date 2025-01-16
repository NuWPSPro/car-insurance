<?php $this->load->view('institution/picture'); ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">

          <?php  $this->load->view('institution/sidebar');  ?>


		<div class="col-sm-9">
			
			<h3 class="border-title text-left">Profile</h3>
		 
			<table class="table table-striped">
				<tr>
					<td width="30%">Name</td>
					<td><?php echo $profile[0]['name'];?></td>
				</tr>
				<tr>
					<td>Category</td>
                    <?php $insprofession = $this->db->get_where('tbl_category_institution',array('id'=>$profile[0]['profession']))->row_array()['cat_name'];?>
					<td><?php echo $insprofession;?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><?php echo $profile[0]['username_email'];?></td>
				</tr>
				<tr>
					<td>Location</td>
                    <td><?php echo $country_name[0]['countries_name'];?></td>
				</tr>
				<tr>
					<td>Registered Date</td>
					<td><?php echo $profile[0]['added_on'];?></td>
				</tr>
			</table>

            <h3 class="border-title text-left">Affilition</h3>
            <?php if(!empty($ins_name[0]['name'])){ ?>
    			<table class="table table-striped">
                <tr>
                    <td>Name of Institution</td>
                    <!-- <td><?php echo $profile[0]['issuing_institution'];?></td> -->
                    <td><?php echo $ins_name[0]['name'];?></td>
                </tr>
                <tr>
                    <td>Institution Code</td>
                    <!-- <td><?php echo $profile[0]['insititution_id'];?></td>  -->
                    <td><?php echo $ins_name[0]['insititution_id'];?></td> 
                    </tr>
                </table>	
                <?php }
                if(empty($ins_name[0]['name'])){ echo'Not Under Institute.';} ?>			
			
			<hr style="border-top: 2px solid #eee;">

	

                <form action="<?php echo BASE_URL;?>institution/profile" method="post" enctype="multipart/form-data" name="form1" id="form1">
				<h3 class="border-title text-left">Edit Profile</h3>

                <?php echo $this->session->flashdata('response');?> 
                <div class="col-sm-12">
                    <p>
                        <label>Name <span class="required"> * </span> </label>
                        <input name="name" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['name'];?>">
                        <span class="error"><?php echo  form_error('name'); ?></span>
                    </p>
				</div>
					
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Website </label>
                        <input name="website" id="website" class="form-control" value="<?php echo $profile[0]['accreditation_web'];?>" size="20" type="text">
                        <!-- <span class="error"></span> -->
                    </div>
                </div>
									
									
                <div class="col-sm-6"><p>
                <label> Category <span class="required"> * </span> </label>
                <?php $category = $this->user->get_record_by_field_name_all_record('tbl_category_institution','status',1); ?>
                <select class="form-control" name="profession" id="category">
                    <option value="">Select</option>
                    <?php foreach ($category as $key => $value) { ?>
                            <option <?php if($profile[0]['profession']==$value['id']){ echo "selected";} ?> value="<?php echo $value['id'];?>"><?php echo $value['cat_name'];?>
                                
                            </option><?php } ?>
                </select>
                <span class="error"><?php echo form_error('profession'); ?></span>
                <!-- </div>--></p>
                </div>

				<div class="col-sm-6"><p>
                <?php $country = $this->user->get_record_by_field_name_all_record('countries','status',1); ?>
                   <label>Country<span class="required"> * </span> </label>
                   <!-- <div class="selection-box">-->
                        <select name="country" id="location" class="form-control">
                            <option value="">Select</option>
                            <?php foreach ($country as $key => $value) {?>
                            <option value="<?php echo $value['countries_id']; ?>"<?php if($profile[0]['country']==$value['countries_id']){ echo "selected";} ?> ><?php echo $value['countries_name']; ?></option>
                        <? }?>
                        </select>
                        <span class="error"><?php echo  form_error('country'); ?></span>
                  <!--  </div>--></p>
              </div>
                                 <div class="col-sm-6">
                        <div class="form-group">
                            <label>State </label> 
                                 <input type="text" name="state" id="state" class="form-control" value="<?php echo $profile[0]['state'];?>"> 
                        </div>
                    </div>
					<div class="col-sm-6">
                        <div class="form-group">
                            <label>City </label> 
                                 <input type="text" name="city" id="city" class="form-control" value="<?php echo $profile[0]['city'];?>"> 
                        </div>
                    </div>
					
					<div class="col-sm-6">
                        <div class="form-group">
                            <label>Street </label> 
                                 <input type="text" name="street" id="street" class="form-control" value="<?php echo $profile[0]['street'];?>"> 
                        </div>
                    </div>
					
					<div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Representative <span class="required"> * </span> </label>
                            <input required="" name="representative" class="form-control" value="<?php echo $profile[0]['representative'];?>" size="20" type="text">
                            <span class="error"></span>
                        </div>
                    </div>
					
					<div class="col-sm-6">
                        <div class="form-group">
                            <label>Designation <span class="required"> * </span> </label>
                            <input required="" name="designation" class="form-control" value="<?php echo $profile[0]['position'];?>" size="20" type="text">
                            <span class="error"></span>
                        </div>
                    </div>
					
					<div class="col-sm-6">
                        <div class="form-group">
                            <label>Telephone No. <span class="required"> * </span> </label>
                            <input required="" name="mobile" class="form-control" value="<?php echo $profile[0]['mobile'];?>" size="20" type="num">
                            <span class="error"></span>
                        </div>
                    </div>
					
					<div class="col-sm-6">
                        <div class="form-group">
                            <label>Facebook Url </label>
                            <input name="fb_url" id="fb_url" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['fb_url']?>">
                            <span class="error"><?php echo  form_error('fb_url'); ?></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Skype Name </label>
                            <input name="skype" id="skype" class="form-control" value="<?php echo $profile[0]['skype'];?>" size="20" type="text">
                            <span class="error"></span>
                        </div>
                    </div>
					
					<div class="col-sm-6">
			<!-- <p>
                        <label>Role <span class="required"> * </span> </label>
                       <div class="selection-box">
                            <select class="form-control" name="role" id="role" onchange="alert('Do You realy want to cahange your Role? ')">
                                <option value="">Select</option>
                                <option <?php if($profile[0]['role']=="1"){ echo "selected";} ?>  value="1">Professional</option>
                                <option <?php if($profile[0]['role']=="2"){ echo "selected";} ?> value="2">CPD Provider </option>
                            </select>
                            <span class="error"><?php echo form_error('role'); ?></span>
                       </div>
                    </p> -->
					</div>
					 
					 <div class="col-sm-12">
                        <div class="form-group">
                            <label>Email: <span class="required"> * </span> </label>
                            <input required="" name="username_email" id="username_email" class="form-control" value="<?php echo $profile[0]['username_email'];?>" type="text" readonly>
                            <span class="error"></span>
                        </div>
                    </div>
					
					<div class="col-sm-12">
                    <p>
                        <label>Address <span class="required"> * </span> </label>
                        <textarea rows="5" cols="5" name="address" id="address" class="form-control"><?php echo $profile[0]['address']?></textarea>
                        <span class="error"><?php echo  form_error('address'); ?></span>
                    </p>
                    </div> 
                 <!--   <div class="col-sm-6">                  
                         <p>
                            <?php $warning = (empty($profile[0]['paypal_email']))?'<i class="fa fa-warning" style="color:red"></i>':''; ?>
                            <label>Paypal (email) <?php echo $warning; ?></label>
                            <input name="paypal_email" id="paypal_email" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['paypal_email']?>">
                            <span class="error"><?php echo  form_error('paypal_email'); ?></span>
                        </p>
                    </div>-->
									
                     <div class="col-sm-12">
                        <p>
                            <label>Profile Image <small id="" class="form-text text-muted"><!-- ( Size should be 170 x 170 or less ) --></small></label>
                            <input class="form-control" name="image" type="file">
                            <span class="error"><?php echo form_error('image'); ?></span>
                        </p>
					</div>	
					
                    <div class="col-sm-6">
                        <p>
                            <label>Background Image <small id="" class="form-text text-muted"> ( Size should be 1500 x 540 or less )</small></label>
                            <input class="form-control" name="backimage" type="file">
                            <span class="error"><?php echo  form_error('backimage'); ?></span>
                        </p>
                     </div>
					 <div class="col-sm-6">
                        <p>
                           <label>Logo <small id="" class="form-text text-muted">( Size should be 350 x 350 or less )</small></label>
                           <input class="form-control" name="logo" type="file">
                           <span class="error"><?php echo  form_error('logo'); ?></span>
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

 


		</div>
	</div>
</div>