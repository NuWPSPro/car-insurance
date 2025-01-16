<?php $this->load->view('advertise/advertise_head'); ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">
			<div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
        	</div>
		 <?php  $this->load->view('advertise/sidebar');  ?>  
		

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
                    <?php $country_name = $this->db->get_where('countries',array('countries_id'=>$profile[0]['location']))->row_array()['countries_name'] ;?>
					<td><?php echo $country_name;?></td>
				</tr>
				<tr>
					<td>Registered Date</td>
					<td><?php echo $profile[0]['added_on'];?></td>
				</tr>

			 				
			</table>
			
			<hr><h3 class="border-title text-left">Edit Profile</h3>
                                 <form action="<?php echo BASE_URL;?>provider/profile" method="post" enctype="multipart/form-data" name="form1" id="form1">

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
                                        <label>Background Image </label>
                                        <input class="form-control" name="backimage" size="20"  type="file">
                                        <span class="error"><?php echo  form_error('backimage'); ?></span>
                                    </p>

                                    <p>
                                       <label>Logo</label>
                                       <input class="form-control" name="logo" size="20"  type="file">
                                       <span class="error"><?php echo  form_error('logo'); ?></span>
                                    </p>


                                    <p>

                                        <label>Role <span class="required"> * </span> </label>
                                         <div class="selection-box">
                                            <select class="form-control" name="profession" id="profession">

                                                <option value="">Select</option>

                                                <option <?php if($profile[0]['role']=="1"){ echo "selected";} ?>  value="1">Professional</option>

                                                <option <?php if($profile[0]['role']=="2"){ echo "selected";} ?> value="2">CPD Provider </option>

                                               <!--  <option <?php if($profile[0]['role']=="3"){ echo "selected";} ?> value="3">Placement Agencies</option>

                                                <option <?php if($profile[0]['role']=="4"){ echo "selected";} ?> value="4">Advertisers</option> -->
                                            </select>

                                            <span class="error"><?php echo form_error('profession'); ?></span>

                                        </div>
                                    </p>


                                       <p>

                                        <label>Profession <span class="required"> * </span> </label>
                                         <div class="selection-box">
                                            <select class="form-control" name="category" id="category">

                                                <option value="">Select</option>
                                                <?php
                                                $cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1); 
                                                foreach ($cat as $key => $value) {
                                               	 ?>
                                                <option <?php if($profile[0]['profession']==$value['cat_name']){ echo "selected";} ?> value="<?php echo $value['cat_name'];?>"><?php echo $value['cat_name'];?></option>
                                               	 <?php  		
                                                }
                                                ?>
                                            </select>

                                            <span class="error"><?php echo form_error('category'); ?></span>

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

                                        <label>Address <span class="required"> * </span> </label>

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
</p>

                                    
                    <p class="submit alignleft">
                        <input class="btn btn-primary" value="Update" type="submit" name="save">
                    </p>

                </form>

            </div>

 
 
		</div>
	</div>
</div>









<script type="text/javascript">
function showMessage(idd)
{
 
    jQuery('#rid').html(idd);
    jQuery('#waitmessage').show();

    jQuery.noConflict(); 
    
    jQuery("#myModal11").modal('show');

 

jQuery.ajax({
type: "POST",
url: '<?php echo base_url()."professional/showMessage";?>',
data: {idd:idd}
}).done(function( result ) {
  //alert(result);
    jQuery('#waitmessage').hide();
  jQuery("#responseData").html( result );
});              
return false;   
}
</script>




    <!-- Modal -->
            <div class="modal fade" id="myModal11" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Notification Message</h4>
                </div>
                <p style="color: red; text-align: center; display: none;" id="waitmessage">Please wait.... </p>
                <div class="modal-body">
                <span id="responseData"></span>
				</div>            
              </div>
            </div>
            </div>







