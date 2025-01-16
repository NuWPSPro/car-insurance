<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-profileppanal">
	<div class="container">
	
		<div class="row">

		<?php 
		$this->load->view('admin/sidebar');
		?>	


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
					<td>Location</td>
					<td>
						<?php //echo $profile[0]['location'];?>
						<?php echo $locationname[0]['countries_name'];?>
					</td>
				</tr>
				<tr>
					<td>Registered Date</td>
					<td><?php echo $profile[0]['added_on'];?></td>
				</tr>

			 				
			</table>
			</div>
			
			<hr>
			<!-- <h3 class="border-title text-left">Basic Setting</h3>
			<table class="table table-striped">
				<tr>
					<td  width="30%">Editor</td>
					<td>No Informations Entered</td>
				</tr>
				<tr>
					<td>Time Zone</td>
					<td>No Informations Entered</td>
				</tr>
				<tr>
					<td>Frontend Language</td>
					<td>No Informations Entered</td>
				</tr>
				<tr>
					<td>Backend Template Language</td>
					<td>No Informations Entered</td>
				</tr>
				<tr>
					<td>Backend Language</td>
					<td>No Informations Entered</td>
				</tr>				
			</table> -->
		




		 

                                 <form action="<?php echo BASE_URL;?>admin/profile" method="post" enctype="multipart/form-data" name="form1" id="form1">

                                 <?php echo $this->session->flashdata('response');?> 

                                    <p>
                                        <label>Name <span class="required"> * </span> </label>
                                        <input name="name" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['name'];?>">
                                        <span class="error"><?php echo  form_error('name'); ?></span>
                                    </p>

                                    <p>
                                        <label>Profile Image </label>
                                        <input class="form-control" name="image" size="20"  type="file">
                                        <span class="error"><?php echo  form_error('image'); ?></span>
                                    </p>

                                    <p>
                                       <label>Logo</label>
                                       <input class="form-control" name="logo" size="20"  type="file">
                                       <span class="error"><?php echo  form_error('logo'); ?></span>
                                    </p>


                                    <p>

                                        <label>Profession <span class="required"> * </span> </label>
                                         <div class="selection-box">
                                            <select class="form-control" name="profession" id="profession">

                                                <option value="">Select</option>

                                                <option <?php if($profile[0]['profession']=="Professional"){ echo "selected";} ?>  value="Professional">Professional</option>

                                                <option <?php if($profile[0]['profession']=="CPD Provider"){ echo "selected";} ?> value="CPD Provider">CPD Provider </option>

                                                <option <?php if($profile[0]['profession']=="Placement Agencies"){ echo "selected";} ?> value="Placement Agencies">Placement Agencies</option>

                                                <option <?php if($profile[0]['profession']=="Advertisers"){ echo "selected";} ?> value="Advertisers">Advertisers</option>
                                            </select>

                                            <span class="error"><?php echo form_error('profession'); ?></span>

                                        </div>
                                    </p>

                                    <p>
                                       <label>Country of Location <span class="required"> * </span> </label>

                                        <div class="selection-box">
                                            <select name="location" id="location" class="form-control">
                                                <option value="">Select</option>

                                                <option <?php if($profile[0]['location']=="India"){ echo "selected";} ?> value="India">India</option>

                                                <option <?php if($profile[0]['location']=="United States"){ echo "selected";} ?> value="United States">United States</option> 

                                            </select>

                                            <span class="error"><?php echo  form_error('location'); ?></span>

                                        </div>

                                    </p>

                                    <p>

                                        <label>Phillipines Address <span class="required"> * </span> </label>

                                        <p>

                                            <textarea rows="5" cols="5" name="address" id="address" class="form-control"><?php echo $profile[0]['address']?></textarea>

                                            <span class="error"><?php echo  form_error('address'); ?></span>

                                        </>

                                    </p>

                                    <p>

                                        <label>Username (email)<span class="required"> * </span> </label>

                                        <input readonly name="username" id="username" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['username_email']?>">

                                        <span class="error"><?php echo  form_error('username'); ?></span>

                                    </p>

                                    
                                    <p class="submit alignleft">
                                        <input class="btn" value="Update" type="submit" name="save">
                                    </p>

                                </form>

                            </div>
		 
 
		</div>
	</div>
</div>