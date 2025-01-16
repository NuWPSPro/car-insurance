<?php $this->load->view('template/picture_provider'); 
      $institution = $this->session->userdata('logged_in')['under_insititution']; ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">
		<?php $this->load->view('provider/sidebar'); ?>


		<div class="col-sm-9">
			
			<h3 class="border-title text-left">Profile</h3>
		 
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
					<td>Location</td>
                    <td><?php echo $country_name[0]['countries_name'];?></td>
				</tr>
				<tr>
					<td>Registered Date</td>
					<td><?php echo $profile[0]['added_on'];?></td>
				</tr>
			</table>		
			
			<hr style="border-top: 2px solid #eee;">
                <form action="<?php echo BASE_URL.'provider/profile';?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
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
                    </div>
                </div>
									
				<?php // print_r($profile[0]); ?>					
                <div class="col-sm-6">
                    <p>
                    <label> Focus Profession <span class="required"> * </span> </label>
                    <select class="form-control" name="category" id="category">
                        <option value="">Select</option>
                            <?php  foreach ($cat as $key => $value) { ?><option <?php if($profile[0]['profession']==$value['cat_name']){ echo "selected";} ?> value="<?php echo $value['cat_name'];?>"><?php echo $value['cat_name'];?></option><?php } ?>
                    </select>
                    <span class="error"><?php echo form_error('category'); ?></span>
                    </p>
                </div>

				<div class="col-sm-6"><p>
                   <label>Country<span class="required"> * </span> </label>
                        <select name="country_name" id="country_name" class="form-control">
                            <option value="">Select</option>
                            <?php foreach ($country as $key => $value) { ?>
                            <option value="<?php echo $value['countries_id']; ?>"<?php if($profile[0]['country']==$value['countries_id']){ echo "selected"; } ?> ><?php echo $value['countries_name']; ?></option><?php } ?>
                        </select>
                        <span class="error"><?php echo  form_error('country_name'); ?></span>
                  </p>
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

                    <?php if($institution > 0){$required=''; $text=''; }else{ $required='required'; $text='<span class="required"> * </span>';} ?>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Skype Name  <?=$text;?></label>
                            <input <?=$required;?> name="skype" id="skype" class="form-control" value="<?php echo $profile[0]['skype'];?>" size="20" type="text">
                            <span class="error"></span>
                        </div>
                    </div>
					
					 
					 <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Email: <span class="required"> * </span> </label>
                            <input required="" name="company_email" id="company_email" class="form-control" value="<?php echo $profile[0]['company_email'];?>" type="text" readonly>
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
                    <?php if($institution != 1){ ?>
                  <div class="col-sm-6">                  
                         <p>
                            <?php $warning = (empty($profile[0]['paypal_email']))?'<i class="fa fa-warning" style="color:red"></i>':''; ?>
                            <label>Paypal (email) <?php echo $warning; ?></label>
                            <input name="paypal_email" id="paypal_email" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['paypal_email']?>">
                            <span class="error"><?php echo  form_error('paypal_email'); ?></span>
                        </p>
                    </div> 
                    <div class="col-sm-6">
                        <p>
                           <label>Logo <small id="" class="form-text text-muted">( Size should be 350 x 350 or less )</small></label>
                           <input class="form-control" name="logo" type="file">
                           <span class="error"><?php echo  form_error('logo'); ?></span>
                        </p>
                    </div> 
                    <?php } ?>
                     <div class="col-sm-6">
                        <p>
                            <label>Profile Image <small id="" class="form-text text-muted"></small></label>
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

                    <?php if($institution != 1){ ?>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Accreditation Number :<span class="required"> * </span> </label>
                            <input name="accreditation_num" id="prc_acceditation_number" class="form-control" type="text" value="<?php if($profile[0]['prc_acceditation_number']!=''){ echo $profile[0]['prc_acceditation_number'];}else{echo '';}?>" required>
                           
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Validity : <span class="required"> * </span> </label>
                            <input name="validity" id="validity" class="form-control"  type="date" value="<?php if($profile[0]['validity']!=''){ echo $profile[0]['validity'];}else{echo '';}?>">
                           
                        </div>
                    </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                            <label>Issuing Institution <span class="required"> * </span> </label>
                            <input name="issuing_institution" id="issuing_institution" class="form-control" size="20" type="text" value="<?php if($profile[0]['issuing_institution']!=''){ echo $profile[0]['issuing_institution'];}else{echo '';}?>">
                           
                        </div>
                    </div> 

                     <div class="col-sm-6">
                        <div class="form-group">
                            <label for="accreditation_doc">Accreditation Document<span class="required" style="font-size: 10px;">(Only pdf, docx and doc files allowed)</span> <?php echo ($profile[0]['issuing_institution']!='')?'<i class="btn btn-success fa fa-check" title="Doc uploaded"></i>':'<i class="btn btn-danger fa fa-times" title="Doc didn\'t uploaded"></i>'; ?> </label>
                            <input type="file" id="accreditation_doc" class="btn btn-primary" name="accreditation_doc">
                        </div>
                        
                    </div>
                    <?php if(!empty($profile[0]['accreditation_doc'])){ ?>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="accreditation_doc"></label>
                            <a href="<?php echo ASSETS_URL.'images/uploads/'.$profile[0]['accreditation_doc']; ?>"></a>
                            <!-- <input type="file" id="accreditation_doc" class="btn btn-primary" name="accreditation_doc"> -->
                        </div>
                    </div><?php } ?>
                    <?php } ?>
					<div class="col-sm-12">
                        <div class="form-group">
                            <label>Website of Accrediting Body</label>
                            <input name="accreditation_web" class="form-control" size="20" type="text" value="<?php if($profile[0]['accreditation_web']!=''){ echo $profile[0]['accreditation_web'];}else{echo '';}?>">
                        </div>
                    </div>

                    
					<div class="col-sm-12">
						<p class="submit alignleft">
							<input class="btn btn-primary" value="Update" type="submit" name="save">
						</p>
					</div>
				</div>
                                <!--    <p>

                                        <label>Username (email)<span class="required"> * </span> </label>

                                        <input readonly name="username" id="username" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['username_email']?>">

                                        <span class="error"><?php echo  form_error('username'); ?></span>

                                    </p>




<p>
<label>Facebook Url<span class="required"> * </span> </label>
<input name="fb_url" id="fb_url" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['fb_url']?>">
<span class="error"><?php echo  form_error('fb_url'); ?></span>
</p>


<p>
<label>Twitter Url<span class="required"> * </span> </label>
<input name="tw_url" id="tw_url" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['tw_url']?>">
<span class="error"><?php echo  form_error('tw_url'); ?></span>
</p>



<p>
<label>Google Plus Url<span class="required"> * </span> </label>
<input name="gpus_url" id="gpus_url" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['gpus_url']?>">
<span class="error"><?php echo  form_error('gpus_url'); ?></span>
</p>



<p>
<label>Instagram Url<span class="required"> * </span> </label>
<input name="insta_url" id="insta_url" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['insta_url']?>">
<span class="error"><?php echo  form_error('insta_url'); ?></span>
</p> -->
                
                </form>

            </div>

 


		</div>
	</div>
</div>