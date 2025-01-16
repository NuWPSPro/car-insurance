
<?php  $this->load->view('car_company/picture'); ?>

      <!-- Main body start -->
      <div class="col-sm-9">
        <?=$body_heading; ?>
        
          <?php //echo'<pre>';print_r($staff_payment[0]);
              $common =array(); 
               foreach($course_promotion as $value){ 
                  $txn_details = json_decode($value['transaction_details']);
                  // echo'<pre>';print_r($txn_details);
                  // if($value['package_end_date'] >= date('Y-m-d') ){
                  $common[] = array(
                    'id'        => $value['id'],
                    'name'      => $txn_details->item_name,
                    'type'      => 'Course Promotion',
                    'quantity'  => 1,
                    'txn_id'    => $value['txn_id'],
                    'added_on'  => date('Y-m-d',strtotime($value['added_on'])),
                    'amount'    => $value['amount'],
                  ); 
                // } 
                }
                foreach($training_promotion as $value){ 
                  $txn_details = json_decode($value['transaction_details']);
                  // echo'<pre>';print_r($txn_details);
                  // if($value['package_end_date'] >= date('Y-m-d') ){
                  $common[] = array(
                    'id'        => $value['id'],
                    'name'      => $value['item_name'],
                    'type'      => 'Training Promotion',
                    'quantity'  => 1,
                    'txn_id'    => $value['txn_id'],
                    'added_on'  => date('Y-m-d',strtotime($value['added_on'])),
                    'amount'    => $value['amount'],
                  ); 
                // } 
                }
                foreach($training_publish as $value){ 
                  $txn_details = json_decode($value['transaction_details']);
                  // echo'<pre>';print_r($txn_details);
                  // if($value['package_end_date'] >= date('Y-m-d') ){
                  $common[] = array(
                    'id'        => $value['id'],
                    'name'      => $value['title'],
                    'type'      => 'TMS Pro',
                    'quantity'  => 1,
                    'txn_id'    => $txn_details->txn_id,
                    'added_on'  => date('Y-m-d',strtotime($value['added_on'])),
                    'amount'    => $value['amount'],
                  ); 
                // } 
                }
                foreach($staff_payment as $value){ 
                  $txn_details = json_decode($value['transaction_details']);
                  // if($value['package_end_date'] >= date('Y-m-d') ){
                  $common[] = array(
                    'id'        => $value['id'],
                    'name'      => 'Staff',
                    'type'      => 'Staff Payment',
                    'quantity'  => 1,
                    'txn_id'    => $txn_details->txn_id,
                    'added_on'  => date('Y-m-d',strtotime($value['added_on'])),
                    'amount'    => $value['amount'],
                  ); 
                // } 
                }
                // print_r($certificate_payment[0]);
                foreach($certificate_payment as $value){ 
                  $txn_details = json_decode($value['transaction_details']);
                  // if($value['package_end_date'] >= date('Y-m-d') ){
                  $common[] = array(
                    'id'        => $value['id'],
                    'name'      => $txn_details->item_name,
                    'type'      => 'Certificate Issued',
                    'quantity'  => 1,
                    'txn_id'    => $value['txn_id'],
                    'added_on'  => date('Y-m-d',strtotime($value['added_on'])),
                    'amount'    => $value['amount'],
                  ); 
                // } 
                }
                // echo'<pre>'; print_r($advertise[0]);
                foreach($advertise as $value){ 
                  $txn_details = json_decode($value['transaction_details']);
                  // echo'<pre>';print_r($txn_details);
                  // if($value['package_end_date'] >= date('Y-m-d') ){
                  $common[] = array(
                    'id'        => $value['id'],
                    'name'      => 'Adv',
                    'type'      => 'Advertise',
                    'quantity'  => 1,
                    'txn_id'    => $txn_details->txn_id,
                    'added_on'  => date('Y-m-d',strtotime($value['purchased_on'])),
                    'amount'    => $txn_details->payment_gross,
                  ); 
                // } 
                } 
                foreach($company_promotion as $value){ 
                  $date = $value['promoted_day'];
                  $exp = date('Y-m-d',strtotime($value['promoted_date'].'+ '.$date.'day'));
                  $txn_details = json_decode($value['transaction_details']);
                  // echo'<pre>';print_r($txn_details);
                  // if($exp >= date('Y-m-d') ){
                  $common[] = array(
                    'id'        => $value['id'],
                    'name'      => $txn_details->item_name,
                    'type'      => 'Promotion',
                    'quantity'  => 1,
                    'txn_id'    => $value['txn_id'],
                    'added_on'  => date('Y-m-d',strtotime($value['promoted_date'])),
                    'amount'    => $value['promoted_amount'],
                  ); 
                // } 
                }
                
                // echo'<pre>'; print_r($purchase_list);
                foreach($purchase_list as $value){ 
                  $txn_details = json_decode($value['transaction_details']);
                  $common[] = array(
                    'id'        => $value['id'],
                    'name'      => $txn_details->item_name1,
                    'type'      => 'Digital Certificate Subscription',
                    'quantity'  => 1,
                    'txn_id'    => $value['txn_id'],
                    'added_on'  => date('Y-m-d',strtotime($value['added_on'])),
                    'amount'    => $value['paid_amount'],
                  ); 
                  
                } ?>
              <div class="table-responsive">
                <table id="cep-list" class="table table-striped table-bordered" >
                  <thead>
                    <tr>
                        <th>No.</th>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Item Qty.</th>
                        <th>Transaction Id</th>
                        <!-- <th class="text-center">Receipt</th> -->
                        <th>Date Purchased</th>
                        <th class="text-right">Amount</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <?php  if(!empty($common)){
                      // asort($common); 
                      $tot = 0;
                      $count = 1;
                    foreach ($common as $key => $value) {
                    $tot = $tot+$value['amount'];  ?>
                  <tbody>
                    <tr>
                        <td><?php echo $count;?>.</td>
                        <td><?php echo $value['name'];?></td>
                        <td><?php echo $value['type'];?></td>
                        <td><?php echo $value['quantity'];?></td>
                        <td><?php echo $value['txn_id'];?></td>
                        <!-- <td class="text-center"><a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']; ?>','<?php echo $value['type']; ?>')" class="text-primary"> <?php echo $value['txn_id'];?></a></td> -->
                        <td><?php echo $value['added_on'];?></td> 
                        <td class="text-right">$<?php echo $value['amount'];?></td>
                        <td class="text-right"><a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']; ?>','<?php echo $value['type']; ?>')" class="btn btn-primary" ><i title="View Receipt" class="fa fa-file-text-o"></i></a></td>
                    </tr>
                    <?php  $count++; } ?>
                    <tr>
                        <th colspan="6" class="text-right">Total</th>
                        <th class="text-right">$<?php echo $tot;?></th>
                        <th></th>
                    </tr>
                  </tbody>
                  <?php }else{ echo'<p>No data Found!</p>';} ?>
                </table>
              </div>

            </div>
    	<!-- Main body end -->
        
		<!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>

  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
  
    function showBill(idd,type){
    // alert(idd+type);
      var receipt_type = type.substring(0, 3).toUpperCase();
        $('#rid').html(receipt_type +' '+ idd);
        // $('#rid').html(idd);
        $('#waitmessage').show();
        jQuery.noConflict(); 

      $.ajax({
          type: "POST",
          url: "<?php echo base_url('share/showBill');?>",
          data: {idd:idd,type:type}
      }).done(function( result ){
        //alert(result);
        $('#waitmessage').hide();
        $("#myModal11").modal('show');
        $("#responseData").html( result );
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
          <center><div class="site-logo__link" style="max-width: 34%;">
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