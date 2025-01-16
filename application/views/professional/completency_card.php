<?php $this->load->view('template/picture'); ?>


 <div class="innerContent professional-completencycard">
	<div class="container">
        <div class="row">
       <?php  $this->load->view('professional/sidebar');  ?>  
       <div class="col-sm-9">
        <?php echo  $this->session->flashdata('response'); ?>
           <div class="panel panel-default">
                    <div class="panel-body bg-blue border-radius-5">
                        <h3 class="mt-0 text-white text-left">Card
                        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#uploadCardModal">UPLOAD CARD</button>
                        </h3> 
                        <div class="table-responsive">  

                            <table class="table bg-white border-radius-5 overflow-hidden">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Card No</th>
                                        <th>Card Name</th>
                                        <th>Date Issued</th>
                                        <th> Issues By </th>
										 
                                        <th>Exiration Date</th> 
                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    

                        <?php 
                        $uid = $this->session->userdata('logged_in')['username']; 
                        $where = array('status'=>1,'user_id'=>$this->session->userdata('logged_in')['id']);                 
                        $datas = $this->user->get_record_by_multi_field_name('tbl_card',$where);  
                        

                        foreach ($datas as $key => $value) {

                         $where1 = array('id'=>$value['training_seminar_id']); 
                         $trainingData = $this->user->get_record_by_multi_field_name('tbl_training',$where1); 

                         $sum = $sum + $trainingData[0]['units'];

                         
                        if($value['certificate_id'] !=""){
                          $filename = $value['certificate_id'];
                        }
                        
                        $sno = $key+1;

                        echo '<tr> 
                            <td>'.$sno.'</td> 
                            <td>'.$value['card_no'].'</td> 
                            <td>'.$value['card_name'].'</td> 
                            <td>'.$value['date_issued'].'</td>';
                            ?>  
							
							<td><?=$value['issue_by']?></td>
							<td><?=$value['expiry_date']?></td>
							<td><?php 
							    $before1month=date("Y-m-d", strtotime($value['expiry_date']."-1 months"));
						        //echo	$before1month.'/'.$value['expiry_date'];
        						if($value['status']==1)
        						{
        							if(date("Y-m-d")<=$before1month )
        							{
        								echo "<strong class='text-success'>Active</strong>";
        							}
        							elseif(date("Y-m-d")>=$before1month && date("Y-m-d")<=$value['expiry_date'])
        							{
        								echo "<strong class='text-warning blink'>Expiring</strong>";
        							}
        							else
        							{
        								echo "<strong  class='text-danger'>Expired</strong>";
        							}
        						}
        						else
        						{
        							echo "<strong class='text-danger'>Expired</strong>";
        						} ?>
                            </td>
                        
                                    <td class="action">
									   <a href="<?php echo BASE_URL.'professional/download_image/'.$value['photo']; ?>"  title="Download"><i class="fa fa-download"></i></a>
                                       <!-- <a target="_blank" href="<?php echo BASE_URL;?>assets/images/uploads/<?php echo $value['photo'];?>" title="Download"><i class="fa fa-download"></i></a> -->
										<a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['photo'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
                                        <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete_card/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                <!--    <a href="javascript:void(0)" onclick="myFunction()" title="Print"><i class="fa fa-print"></i></a> -->
                                    </td>
                                    </tr>
                            <?php 
                            $count++;
                            } 
                            ?>


                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
           

<?php 
              if(empty($datas)){
                  echo "<p style='color:red;'>Sorry no records found.</p>";
                 }
            ?>




            
        
        </div>


       </div>
	</div>
	</div>
</div>


<div id="uploadCardModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Card</h4>
            </div>



              <form action="<?php echo BASE_URL;?>professional/savecard" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <div class="modal-body"> 

                    <p>
                        <label>Card No </label>
                        <input name="card_no" value="" size="20" type="text" class="form-control">
                        <span class="error"><?php echo  form_error('card_no'); ?></span>
                    </p>
                    <p>
                        <label>Card Name <span class="required text-danger"> * </span> </label>
                        <input name="card_name" value="" size="20" type="text" class="form-control" required>
                        <span class="error"><?php echo  form_error('card_name'); ?></span>
                    </p>
                   

                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label>Date Issued <span class="required text-danger"> * </span> </label>
                                <input name="issued_date" value="" size="20" type="text" class="form-control datepicker" required>
                                <span class="error"><?php echo  form_error('issued_date'); ?></span>
                            </p>
                        </div>
                    </div>
	

                     <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label>Expiration Date <span class="required text-danger"> * </span> </label>
                                <input name="expiry_date" value="" size="20" type="text" class="form-control datepicker" required>
                                <span class="error"><?php echo  form_error('expiry_date'); ?></span>
                            </p>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-12">
                            <p>
                                <label>Issue By (Name of company) <span class="required text-danger"> * </span> </label>
                                <input name="issue_by" value="" size="20" type="text" class="form-control " required>
                                <span class="error"><?php echo  form_error('issue_by'); ?></span>
                            </p>
                        </div>
                    </div>


                     <p>
                        <label>Upload Photo <span class="required text-danger"> * </span> </label>
                        <input name="photos" value="" size="20" type="file" class="form-control" required>
                        <span class="error"><?php echo  form_error('photos'); ?></span>
                    </p>
                    

 
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalpreviewImage" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content" id="myModalpreviewImage11">
					<div class="modal-header">
						<button onclick="myFunction()" style="float: left;" type="button"><i class="fa fa-print"></i></button>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<center>
							<img src="" id="imagepreview">
						</center>
					</div>
				</div>
			</div>
        </div>
        
<a href="#" id="scroll" style="display: inline;"><span></span></a>

<script type="text/javascript">

function showBill(idd)
{
 
    $('#rid').html(idd);
    $('#waitmessage').show();

    //jQuery.noConflict(); 
    
    $("#myModal11").modal('show');


$.ajax({
type: "POST",
url: '<?php echo base_url()."professional/showBill";?>',
data: {idd:idd}
}).done(function( result ) {
  //alert(result);
    $('#waitmessage').hide();
  $("#responseData").html( result );
});              
return false;   
}
function preview_image(image) {
		$("#myModalpreviewImage").modal()
		document.getElementById('imagepreview').src = image;
	}
    function myFunction() {
	  //window.print();
	  printData();
	}
	function printData()
	{
		var printContents = document.getElementById('myModalpreviewImage11').innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
      
</script>

