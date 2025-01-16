<?php $this->load->view('template/picture_author'); ?>
<div class="innerContent author-advertise">
    <div class="container">
        <div class="row">
        <?php  $this->load->view('author/sidebar'); $inactivelist='';  ?>
          <div class="col-sm-9">
				  <?php echo $this->session->flashdata('response');?>
            <div class="row">
              <div class="col-md-12"> 
                <h3>My ADS List</h3>
                <div class="table-responsive">
                  <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th>Package Name</th>
                          <th>Views Bought</th>
                          <th>Countdown</th>
                          <th>Start</th>
						              <th>Ends</th>                         
                          <th>Image</th>
						              <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						
                        foreach ($advertise as $key => $value) {
                            $idd = $value['id'];
							
							if($value['total_view']>=$value['no_of_view'])
							{
								
								$inactivelist.='<tr>';
								$inactivelist.='<td>'.$value['package_name'].'</td>';
								$inactivelist.='<td>'.$value['no_of_view'].'</td>';
								$inactivelist.='<td>'.$value['total_view'].'</td>';
								$inactivelist.='<td>'.$value['purchased_on'].'</td>';
								$inactivelist.='<td>'.$value['package_end_date'].'</td>';								
								$inactivelist.='<td><img src="'.BASE_URL.'/assets/upload/'.$value['package_image'].'" style="width: 50px; width: 50px;"></td>';								
								$inactivelist.='<td>$'.$value['amount'].'</td>';								
								$inactivelist.='<td><a href="javascript:void(0)" onclick="showEditform('. $idd.')">Edit</a><br>
								                     <a href="'.BASE_URL.'/provider/renew/'.$idd.'">Renew</a><br>
													 <a href="#">View Report</a>
								                   </td>';					
								
								$inactivelist.='</tr>';
								
								continue;
								
							}
                        ?>
                        <tr>
                          <td><?php echo $value['package_name'];?></td>
                          <td><?php echo $value['no_of_view'];?></td>
						  <td><?php echo $value['total_view'];?></td>
                          <td><?php echo $value['purchased_on'];?></td>
                          <td>--</td>
                         
                          <td><img src="<?php echo BASE_URL;?>/assets/upload/<?php echo $value['package_image'];?>" style="width: 50px; width: 50px;"></td>
						   <td>$<?php echo $value['amount'];?></td>
                          <td>
                            <a href="javascript:void(0)" onclick="showEditform(<?php echo $idd; ?>)">Edit</a>
							 <a href="#">View Report</a>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
              </div>
                    <?php 
                    if(empty($advertise)){
                      echo "<p>Sorry no records found.</p>";
                    }
                    ?>
            </div>
			
			  <div class="col-md-12"> 
         <h3>IN-Active ADS List</h3>
                  <div class="table-responsive">
                    <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th>Package Name</th>
                          <th>Views Bought</th>
                          <th>Countdown</th>
                          <th>Start</th>
						              <th>Ends</th>                         
                          <th>Image</th>
						              <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                  </div>
                        <?php 
						  echo $inactivelist;
                         ?>
                      </tbody>
                    </table>
                    
            </div>
			
            </div>
            </div>


</div>
</div>
</div>
</div>    


<a href="#" id="scroll" style="display: block;"><span></span></a>
<script>
function showEditform(id)
{
	
	jQuery('#advertise_id').val(id);	
	jQuery('#addpackage').modal('show');
	
}
</script>


<div id="addpackage" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="packagename">Edit image</h4>
      </div>
      <div class="modal-body">
	  <div class="provider-popup">
         <div class="row">
		  
		   <div class="col-md-12">
		     <div class="provider-right-content">

			<form action="<?php echo BASE_URL;?>provider/updateimage" method="post" enctype="multipart/form-data" name="form1" id="form1">
		     
			
				 <div class="form-group">
					<label >Upload Photo <span id="uploadphotosize"></span></label>
					<input type="file" id="banner_image" name="banner_image"  required>
				</div>				
				<div class="form-group">
				  <div class="right-img-box">
                                            <img id="PreviewPicture" src=""/>
					</div>
				
				   </div>
				<div class="form-group">
				   <input type="submit" class="btn btn-success" value="UPDATE" name="update">
				</div>
				
				<input type="hidden" id="advertise_id" name="advertise_id" value=""/>
				
			</form>
			<!------Checkout form---------->
		   </div>
		   </div>		 
		 </div> 
		 </div>
      </div>
     
    </div>

  </div>
</div>






