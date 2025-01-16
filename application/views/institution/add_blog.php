<?php $this->load->view('institution/picture'); 
      $userCountry = $this->session->userdata('logged_in')['country']; ?>
<div class="innerContent">
	<div class="container">

		<!-- <h2 class="border-title text-left">Dashboard</h2> -->
		<div class="row">
      
		<?php $this->load->view('institution/sidebar'); ?>	
		<div class="col-sm-8">
		
			<h3 class="border-title text-left">Blog Page</h3>
        <form action="<?php echo BASE_URL.'institution/blog';?>" method="post" enctype="multipart/form-data" name="form100" id="form100">
        <?php echo $this->session->flashdata('response'); ?> 

                <div class="form-group">
                  <label>Country <span class="required"> * </span> </label>
                  <select name="country_l" id="country" class="form-control" disabled="">
                      <option value="" selected="">Choose Country</option>
                      <?php foreach ($country as $key => $value){ ?>
                      <option value="<?php echo $value['countries_id']; ?>" <?php if($userCountry == $value['countries_id']){echo 'selected'; } ?> ><?php echo $value['countries_name']; ?></option>
                      <?php } ?>
                  </select>
                  <input  name="country" id="country" class="form-control" size="20"  type="hidden" value="<?php echo $userCountry; ?>">
                  <span class="error"><?php echo  form_error('country'); ?></span>
               </div>

              <div class="form-group">
                  <label>Title <span class="required"> * </span> </label>
                  <input  name="title" id="title" class="form-control" size="20"  type="text" value="<?php echo $profile[0]['username_email']?>">
                  <span class="error"><?php echo  form_error('title'); ?></span>
              </div>
			   
              <div class="form-group">
                  <label for="email">Short Description</label>
                  <textarea class="form-control text_editor" name="st_desc" id="st_desc"></textarea>
                  <span class="error"><?php echo  form_error('st_desc'); ?></span>
              </div>
         			   
			   
              <div class="form-group">
                  <label for="email">Description</label>
                  <textarea class="form-control text_editor" name="des" id="des"></textarea>
                  <span class="error"><?php echo  form_error('des'); ?></span>
              </div>
  
              <div class="form-group">
                  <label>Image </label>
                  <input class="form-control" name="image" type="file" required >
                  <span class="error"><?php echo  form_error('image'); ?></span>
              </div>

              <p class="submit alignleft">
                  <input class="btn btn-success" value="Save" type="submit" name="save">
              </p>
        </form>
    </div>
		</div>

	</div>
</div>