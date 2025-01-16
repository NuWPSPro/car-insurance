<?php 

      $uname = $this->session->userdata('logged_in')['name']; 
      $uemail = $this->session->userdata('logged_in')['username']; ?>


            <div class="col-sm-9">
                <h3 class="border-title text-left">Contact Us</h3>

               
                <div class="row">
                <?php echo $this->session->flashdata('response');?>
                  <div class="col-sm-6 form-group">

                  <label>Recipient: <b> Administrator</b></label>
                  <label>Please select category of Message: <sup>*</sup></label>
                    <div class="selection-box">
                      <select class="form-control" name="type" required="">
                        <option value="">--Select--</option>
                        <option value="Testimonial">Testimonial</option>
                        <option value="Enquiry">Enquiry</option>
                        <option value="Complaint">Complaint</option>
                        <option value="Suggestion">Suggestion</option>
                      </select>
                    <span class="error"><?php echo  form_error('type'); ?></span>
                    </div>
                  </div>
                </div>
                    <input type="hidden" class="form-control" name="first_name" value="<?php echo $uname; ?>">
                    <input type="hidden" class="form-control" name="email" value="<?php echo $uemail; ?>">
                
                <div class="form-group">
                <label>Message</label>
                  <textarea class="form-control" placeholder="Please write your massage..." name="message" required=""></textarea>
                  <span class="error"><?php echo  form_error('message'); ?></span>
                </div>
                <div class="form-group">
                 <input type="submit" class="btn btn-primary btn-lg" value="Send Message">
                </div>
            </div>











 