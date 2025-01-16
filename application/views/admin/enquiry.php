<?php $this->load->view('admin/picture'); ?>
 <div class="innerContent admin-enquirypanel">
	<div class="container">	
	
		<div class="row">
		<?php 
		$this->load->view('admin/sidebar');
		?>	
		<div class="col-sm-9">
			<h3 class="border-title text-center">ENQUIRY</h3> 
			<?php
			//print_r($enquiry);
			if(count($enquiry) > 0){
				echo '<div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
					 <thead>
                            <tr>
                                <th>no.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>';
						
					foreach($enquiry as $enq){
						echo '<tr>
						            <td><?php echo $key+1;?></td> 
									<td>'.$enq['first_name'].'</td>
									<td>'.$enq['email'].'</td>
									<td>'.$enq['subject'].'</td>
									<td>'.$enq['date'].'</td>
									<td><a class="text-primary" href="javascript:void(0);" onclick="showMessage('.$enq['id'].')">message ...</a></td>
									
									<td>'.$enq['etype'].'</td>
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

<script type="text/javascript">
function showMessage(idd)
{
 
    jQuery('#rid').html(idd);
    jQuery('#waitmessage').show();

    jQuery.noConflict(); 
    
    jQuery("#myModal11").modal('show');

 

jQuery.ajax({
type: "POST",
url: '<?php echo base_url()."admin/showMessage";?>',
data: {idd:idd}
}).done(function( result ) {
  //alert(result);
    jQuery('#waitmessage').hide();
  jQuery("#responseData").html( result );
});              
return false;   
}
</script>
<script type="text/javascript">
    
$(document).ready(function() {
    $('#example').DataTable();
} );



</script>

 <!-- Modal -->
            <div class="modal fade" id="myModal11" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">message</h4>
                </div>
                <p style="color: red; text-align: center; display: none;" id="waitmessage">Please wait.... </p>
                <div class="modal-body">
                <span id="responseData"></span>
				</div>            
              </div>
            </div>
            </div>