
    <?php 
	    $contactinfo = $this->db->get_where('tbl_contact_info',array('id'=>1))->row_array(); 
	    $uname = $this->session->userdata('logged_in')['name']; 
	    $uemail = $this->session->userdata('logged_in')['username'];
      ?>
      <div class="banner">
        <div class="container">
          <div class="banner-left"> 
          <h1>Contact Us</h1>
            <ul class="breadcrumb">
              <li>International</li>
            </ul>
          </div>
        </div>
      </div>
      <section class="vision-banner">
  	    <div class="container">
  	        <div class="row">
  	            <div class="col-md-8 col-sm-7 ftradd">
                  <!-- <h3 class="h3">CONTACT US</h3> -->

                  <form action="<?php echo site_url('pages/enquiry');?>" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
                  <div class="row">
                  <?php echo $this->session->flashdata('response');?>
  	                <div class="col-sm-6 form-group">
  	                  <label>Recipient:</label>
  	                  <b><input type="text" class="form-control" name="to" value="Administrator" disabled></b>
  	              	</div>
  	                <div class="col-sm-6 form-group">
  	                  <label>Please select category of Message: <sup>*</sup></label>
  	                      <select class="form-control" name="type">
  	                        <option value="">--Select--</option>
  	                        <option value="Testimonial">Testimonial</option>
  	                        <option value="Enquiry">Enquiry</option>
  	                        <option value="Complaint">Complaint</option>
  	                        <option value="Suggestion">Suggestion</option>
  	                      </select>
  	                    <span class="error"><?php echo  form_error('type'); ?></span>
  	                </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6 form-group">
                        <label>From <sup>*</sup></label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo $uname; ?>">
                        <span class="error"><?php echo  form_error('first_name'); ?></span>
                      </div>
                       <div class="col-sm-6 form-group">
                      <label>Email<sup>*</sup></label>
                      <input type="text" class="form-control" name="email" value="<?php echo $uemail; ?>">
                      <span class="error"><?php echo  form_error('email'); ?></span>
                    </div>
                  </div>
                  <div class="row">
                  </div>
                  <div class="form-group">
                  <label>Message</label>
                    <textarea class="form-control" placeholder="Please write your massage..." name="message"></textarea>
                    <span class="error"><?php echo  form_error('message'); ?></span>
                  </div>
                  <div class="form-group">
                   	<input type="submit" class="btn btn-primary btn-lg" value="Send Message">
                  </div>
                  </form>
              </div>
  	        </div>
  	    </div>
	   </section>
	   
