<?php $this->load->view('admin/picture'); ?>
 <div class="innerContent admin-notificationpanal">
	<div class="container">	
	
		<div class="row">
		<?php 
		$this->load->view('admin/sidebar');
		?>	
		<div class="col-sm-9">
			<h3 class="border-title text-center">NOTIFICATION</h3> 
			<form action="<?php echo BASE_URL;?>admin/notification" method="post" enctype="multipart/form-data" name="form1" id="form1">

			<?php echo $this->session->flashdata('response');?> 

			<div class="form-group">
			<label>Subject <span class="required"> * </span> </label>
			<input name="subject" class="form-control" size="20"  type="text">
			<span class="error"><?php echo  form_error('subject'); ?></span>
			</div>
			<div class="form-group">
			<label>Message <span class="required"> * </span> </label>
			<input name="message" class="form-control" size="20"  type="text">
			<span class="error"><?php echo  form_error('message'); ?></span>
			</div>
			<div class="form-group">
			<input class="btn btn-primary btn-lg" value="Update" type="submit" name="save">
			<span class="error"><?php echo  form_error('message'); ?></span>
			</div>
			</form>	

			<?php
			//print_r($enquiry);
			if(count($notification) > 0){
				echo '<div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
					 <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Added Date </th>
                            </tr>
                        </thead>
                        <tbody>';
					foreach($notification as $enq){
						echo '<tr>
									<td>'.$enq['subject'].'</td>
									<td>'.$enq['message'].'</td>
									<td>'.$enq['added_on'].'</td>
								</tr>
							
						';
					}
				echo ' </tbody></table></div>';	
			}
			
		?>		
		</div>
		
		</div>
	</div>
</div>