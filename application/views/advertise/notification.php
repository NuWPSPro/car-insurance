<?php $this->load->view('advertise/advertise_head'); ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">
			<div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
        	</div>
		 <?php  $this->load->view('advertise/sidebar');  ?>  
		<div class="col-sm-9">
			
			<h3 class="border-title text-left">Notification</h3>
			<table class="table table-striped table-bordered">
				<tr>
					<th>No.</th>
					<th>Subject</th>
					<th>Message</th>
					<th>From</th>
					<th>Date</th>
				</tr>
				<?php 
				
				$notification = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_notification','status',1);

				
				 foreach ($notification as $key => $value) {
				 	$udata = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();

				 
				    $role="";
				 	if($udata['role']==1){
				 		$role="Professional";
				 	}
				 	if($udata['role']==2){
				 		$role="CPD Provider";
				 	}
				 	if($udata['role']==3){
				 		$role="Placement Agencies";
				 	}
				 	if($udata['role']==4){
				 		$role="Advertisers";
				 	}	
				 	if($udata['role']==10){
				 		$role="Admin";
				 	}

				?>
				<tr>
					<td><?php echo $key+1;?>.</td>
					<td><?php echo $value['subject'];?></td>
					<td><a class="text-primary" href="javascript:void(0);" onclick="showMessage('<?php echo $value['id']?>')"><?php echo substr($value['message'], 0,10);?> ...</a></td>					
					<td><?php echo $udata['name'];?> ( <?php echo $role;?> )</td>					
					<td><?php echo $value['added_on'];?></td>					
													
				</tr>
				 <?php 
				  }
				 ?>
				 <?php 
              if(empty($notification)){
                  echo "<tr><td colspan='5'><p style='color:red;'>Sorry no records found.</p></td></tr>";
                 }
            ?>
			</table>



			
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







