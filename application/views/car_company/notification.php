<?php  $this->load->view('car_company/picture'); ?>

		<!-- Main body start -->
		<div class="col-sm-9">
			<?=$body_heading; ?>

			<?php echo $this->session->flashdata('response'); 
				$user_id = $this->session->userdata('logged_in')['id'];
				$user = $this->db->get_where('tbl_user',array('id'=>$user_id))->row_array();
				?>
			<div class="card">
				<div class="card-header">
					<h3 class="border-title text-left">Notification</h3>
				</div>
				
			<h4>Inbox</h4>
			<?php if($inbox){ ?>
			<div class="table-responsive">	
			<table class="table table-striped table-bordered notification-list">
				<thead>
				<tr>
					<th>No.</th>
					<th>Subject</th>
					<th>Message</th>
					<th>From</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
				</thead>
				<?php 
				 foreach ($inbox as $key => $value) {
				 	$udata = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
				 	// $to = $this->db->get_where('tbl_user',array('id'=>$value['to']))->row_array()['name'];
				 	$from = $this->db->get_where('tbl_user',array('id'=>$value['from']))->row_array();

				 
				    $role="";
				 	if($from['role']==1){
				 		$role="Professional";
				 	}
				 	if($from['role']==2){
				 		$role="CPD Provider";
				 	}
				 	if($from['role']==3){
				 		$from="Placement Agencies";
				 	}
				 	if($from['role']==4){
				 		$role="Advertisers";
				 	}	
				 	if($from['role']==10){
				 		$role="Admin";
				 	}

				?>
				<tr>
					<td><?php echo $key+1;?>.</td>
					<td><?php echo $value['subject'];?></td>
					<td><a class="text-primary" href="javascript:void(0);" onclick="showMessage('<?php echo $value['id']?>')"><?php echo substr($value['message'], 0,10);?> ...</a></td>					
					<!-- <td><?php echo $udata['name'];?> ( <?php echo $role;?> )</td>-->
					<td><?php if($from){ ?>
						<?php echo $from['name']; ?> ( <?php echo $role;?> )
						<?php }else{ echo'Admin'; } ?></td>		
					<td><?php echo date('Y-m-d',strtotime($value['added_on']));?></td>					
					<td><a href="javascript:void(0)" onclick="delete_message('<?php echo $value['id']; ?>')" class="btn btn-danger"><i class="fa fa-trash" title="Delete"></i></a></td>					
				</tr>
				<?php } ?>
			</table>
		</div>
			<?php }else{ echo '<p style="color:red;">Sorry no records found.</p>'; } ?>
			</div>

			<div class="card">
			<h4>Read Meassges</h4>
			<?php if($read){ ?>

		<div class="table-responsive">		
			<table class="table table-striped table-bordered notification-list">
				<tr>
					<th>No.</th>
					<th>Subject</th>
					<th>Message</th>
					<th>From</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
				<?php 
				 foreach ($read as $key => $value) {
				 	// $udata = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
				 	// $to = $this->db->get_where('tbl_user',array('id'=>$value['to']))->row_array()['name'];
				 	$from = $this->db->get_where('tbl_user',array('id'=>$value['from']))->row_array();

				 
				    $role="";
				 	if($from['role']==1){
				 		$role="Professional";
				 	}
				 	if($from['role']==2){
				 		$role="CPD Provider";
				 	}
				 	if($from['role']==3){
				 		$from="Placement Agencies";
				 	}
				 	if($from['role']==4){
				 		$role="Advertisers";
				 	}	
				 	if($from['role']==10){
				 		$role="Admin";
				 	}

				?>
				<tr>
					<td><?php echo $key+1;?>.</td>
					<td><?php echo $value['subject'];?></td>
					<td><a class="text-primary" href="javascript:void(0);" onclick="showMessage('<?php echo $value['id']?>')"><?php echo substr($value['message'], 0,10);?> ...</a></td>					
					<!-- <td><?php echo $udata['name'];?> ( <?php echo $role;?> )</td>-->
					<td><?php if($from){ ?>
						<?php echo $from['name']; ?> ( <?php echo $role;?> )
						<?php }else{ echo'Admin'; } ?></td>					
					<td><?php echo date('Y-m-d',strtotime($value['added_on']));?></td>					
					<td><a href="javascript:void(0)" onclick="delete_message('<?php echo $value['id']; ?>')" class="btn btn-danger"><i class="fa fa-trash" title="Delete"></i></a></td>				
				</tr>
				<?php } ?>
			</table>
			</div>
			<?php }else{ echo '<p style="color:red;">Sorry no records found.</p>'; } ?>
			</div>


		<!-- reply Modal -->
		<div class="modal fade" id="replyenquery" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">
			    <div class="modal-header">
			      <button type="button" class="close" data-dismiss="modal">&times;</button>
			      <h4 class="modal-title">Reply Message</h4>
			    </div>

				<?php echo form_open('share/enquiry'); ?>
			    <div class="modal-body">
<div class="card">
	<!-- <div class="form-group"> -->
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
	<!-- </div> -->
	<input type="hidden" class="form-control" name="first_name" value="<?php echo $user['name']; ?>">
	<input type="hidden" class="form-control" name="email" value="<?php echo $user['username_email']; ?>">

	<!-- <div class="form-group"> -->
		<label>Message</label>
		<textarea class="form-control" placeholder="Please write your massage..." name="message" required=""></textarea>
		<span class="error"><?php echo  form_error('message'); ?></span>
	<!-- </div> -->
	<!-- <div class="form-group"> -->
		<!-- <input type="submit" class="btn btn-primary" value="Send Message"> -->
	<!-- </div> -->
</div>
<div class="modal-footer">
		<button type="submit" class="btn btn-primary pull-left" >SEND <i class="fa fa-paper-plane" aria-hidden="true" title="Send Message"></i></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
			<?php echo form_close(); ?>

				</div>            
			  </div>
			</div>
		</div>

		<!-- notification Modal -->
		<div class="modal fade" id="notificationPopup" role="dialog">
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

		<script type="text/javascript">

			function delete_message(idd){
				var x = confirm('Do you really want to delete it.');
				if(x== true){
					window.location.href = '<?php echo base_url('share/delete_notification/'); ?>'+idd;
				}
			}

			function showMessage(idd)
			{
			    jQuery('#waitmessage').show();
			    jQuery.noConflict(); 
			    jQuery("#notificationPopup").modal('show');

				jQuery.ajax({
					type: "POST",
					url: '<?php echo base_url()."share/showMessage";?>',
					data: {idd:idd}
				}).done(function( result ) {
				   //alert(result);
				  jQuery('#waitmessage').hide();
				  jQuery("#responseData").html( result );
				});              
				return false;   
			}
		</script>





  
		
		</div>
    <!-- Main body end -->


        <!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>

