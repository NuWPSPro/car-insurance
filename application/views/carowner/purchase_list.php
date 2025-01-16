<?php  $this->load->view('carowner/picture'); ?>

		<!-- Main body start -->
		<div class="col-sm-9">
			<?=$body_heading; ?>
                <div class="table-responsive">
                  <table class="table table-striped">
                      <tr>
                            <th>No.</th>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Item Qty.</th>
                            <th>Transaction Id</th>
                            <th>Date Purchased</th>
                            <th class="text-right">Amount</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <?php if(!empty($transaction)){
                                // echo '<pre>'; print_r($transaction); echo '</pre>'; 
                                foreach($transaction as $key => $buy):
                                if($buy['certificate_status']==1){ 
                                    $status ="<span class='text-success'>Genrated</span>";  
                                    $viewstyle = '';
                                    $comingstyle = 'none';
                                }else{
                                    $status ="<span class='text-danger'>Pending</span>";  
                                    $viewstyle = 'none';
                                    $comingstyle = '';
                                    }
                                    ?>
                                <td scope="row"><?php echo $key+1; ?>.</td>
                                <td><?php echo $buy['product_name'] ?></td>
                                <td><?php echo $buy['product_type']; ?></td>
                                <td>1</td>
                                <td><?php echo ($buy['txn_id']!='')?$buy['txn_id']:'--'; ?></td>
                                <td><?php echo $buy['added_on'] ?></td>
                                <td>$<?php echo $buy['paid_amount'] ?></td>
                                <td>   
                                <a href="javascript:void(0)" style="display:<?=$viewstyle;?>" onclick="alert('coming soon!');" style="display:<?=$vrbtn;?>" class="btn btn-primary m-1">View</a>    
                                <a href="javascript:void(0)" onclick="showBill('<?php echo $buy['id']; ?>','<?php echo $buy['type']; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o"></i></a>   
                                </td>
                        </tr>
                            <?php endforeach;
                           }else{
                            echo '<tr><th class="text-center" colspan="9">No Data Found!</th></tr>';
                           }  ?>

                    </table>
                </div>
        
		</div>
    <!-- Main body end -->


        <!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>

      <!-- Modal -->
      <div class="modal fade" id="myModal11" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <center><div class="site-logo__link" style="max-width: 34%;display: block; text-align: -webkit-center;">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
                </div></center>
              <h4 class="modal-title">Receipt No. <span id="rid"></span></h4>
            </div>
              <p style="color: red; text-align: center; display: none;" id="waitmessage">Please wait.... </p>
              
            <div class="modal-body">
                <span id="responseData"></span>
            </div>            
          </div>
        </div>
      </div>

<script>
  function showBill(idd,type)
    {
      var receipt_type = type.substring(0, 3).toUpperCase();
      $('#rid').html(receipt_type +' '+ idd);
      $('#waitmessage').show();
      //jQuery.noConflict();
      $("#myModal11").modal('show');
      $.ajax({
      type: "POST",
      url: '<?php echo base_url("share/showBill");?>',
      data: {idd:idd,type:type}
      }).done(function( result ){
        //alert(result);
          $('#waitmessage').hide();
        $("#responseData").html( result );
      });              
      return false;   
    }
</script>