<?php $this->load->view('template/picture'); 
    //   $institution = $this->session->userdata('logged_in')['under_insititution']; ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">


		<div class="col-sm-9">
			
        <?php echo $this->session->flashdata('response');?> 
            <h3 class="border-title text-left"><?=$body_heading; ?></h3>
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
                                <!--    <p>

                                        <label>Username (email)<span class="required"> * </span> </label>

                                        <input readonly name="username" id="username" class="form-control" size="20"  type="text" value="<?php echo $details['username_email']?>">

                                        <span class="error"><?php echo  form_error('username'); ?></span>

                                    </p>




<p>
<label>Facebook Url<span class="required"> * </span> </label>
<input name="fb_url" id="fb_url" class="form-control" size="20"  type="text" value="<?php echo $details['fb_url']?>">
<span class="error"><?php echo  form_error('fb_url'); ?></span>
</p>


<p>
<label>Twitter Url<span class="required"> * </span> </label>
<input name="tw_url" id="tw_url" class="form-control" size="20"  type="text" value="<?php echo $details['tw_url']?>">
<span class="error"><?php echo  form_error('tw_url'); ?></span>
</p>



<p>
<label>Google Plus Url<span class="required"> * </span> </label>
<input name="gpus_url" id="gpus_url" class="form-control" size="20"  type="text" value="<?php echo $details['gpus_url']?>">
<span class="error"><?php echo  form_error('gpus_url'); ?></span>
</p>



<p>
<label>Instagram Url<span class="required"> * </span> </label>
<input name="insta_url" id="insta_url" class="form-control" size="20"  type="text" value="<?php echo $details['insta_url']?>">
<span class="error"><?php echo  form_error('insta_url'); ?></span>
</p> -->
                
                </form>

            </div>

 


		</div>
	</div>
</div>