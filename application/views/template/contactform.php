
<div class="col-sm-8">
			
			<h3 class="border-title text-left">Contact Us</h3>
			<form action="<?php echo site_url();?>/<?=$this->uri->segment(1);?>/enquiry" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
				<div class="row">
				<?php echo $this->session->flashdata('response');?>
				<div class="col-sm-6 form-group">
					<label>Please select category of Message: <sup>*</sup></label>
					<div class="selection-box">
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
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>First Name <sup>*</sup></label>
						<input type="text" class="form-control" name="first_name">
						<span class="error"><?php echo  form_error('first_name'); ?></span>
					</div>
					<div class="col-sm-6 form-group">
						<label>Last Name <sup>*</sup></label>
						<input type="text" class="form-control" name="last_name">
						<span class="error"><?php echo  form_error('last_name'); ?></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>Email<sup>*</sup></label>
						<input type="text" class="form-control" name="email">
						<span class="error"><?php echo  form_error('email'); ?></span>
					</div>
					<div class="col-sm-6 form-group">
						<label>Subject<sup>*</sup></label>
						<input type="text" class="form-control" name="subject">
						<span class="error"><?php echo  form_error('subject'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label>Message</label>
					<textarea class="form-control" placeholder="Tell about us" name="message"></textarea>
					<span class="error"><?php echo  form_error('message'); ?></span>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary btn-lg" value="Send Message">
				</div>
			</form>
			
			
		</div>