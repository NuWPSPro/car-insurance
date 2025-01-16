<?php $this->load->view('template/picture_author'); ?>


 <div class="innerContent author-purchase-list">
	  <div class="container">
      <div class="row">
      <?php  $this->load->view('author/sidebar');  ?>  
      <?php 
              $common =array(); 
               foreach($course_promotion as $value){ 
                  $txn_details = json_decode($value['transaction_details']);
                  // echo'<pre>';print_r($txn_details);
                  // if($value['package_end_date'] >= date('Y-m-d') ){
                  $common[] = array(
                    'id'        => $value['id'],
                    'name'      => $txn_details->item_name1,
                    'type'      => 'Course Promotion',
                    'quantity'  => 1,
                    'txn_id'    => $txn_details->txn_id,
                    'added_on'  => date('Y-m-d',strtotime($value['added_on'])),
                    'amount'    => $value['amount'],
                  ); 
                // } 
                }

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


        ?>      

       <div class="col-sm-9">
            <h3 class="border-title text-left">Purchase List</h3>
              <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
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
                <?php 
                 $tot=0;
                 $count = 1;
                 foreach ($common as $key => $value) {
                  $tot = $tot+$value['amount'];  ?>
                <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $value['name'];;?></td>
                    <td><?php echo $value['type'];?></td>
                    <td><?php echo $value['quantity'];?></td>
                    <td><?php echo $value['txn_id'];?></td>
                    <td><?php echo $value['added_on'];?></td>                                
                    <td class="text-right">$<?php echo $value['amount'];?></td>
                    <td class="text-center"><a href="javascript:void(0)" onclick="showBill('<?php echo $value['id'];?>','<?php echo $value['type'];?>')" class="text-primary"><i title="View Receipt" class="fa fa-file-text-o"></i></a></td>
                </tr>
                <?php  $count++; } ?>
                <tr class="bg-info">
                    <td colspan="6" class="text-right text-primary">Total</td>
                    <td class="text-right text-primary">$<?php echo $tot;?></td>
                    <td></td>
                </tr>
            </table>
          </div>
        </div>
       </div>
	</div>
	</div>

            <!-- Modal -->
  <div class="modal fade" id="myModal11" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Receipt No. <span id="rid"></span></h4>
        </div>
          <p style="color: red; text-align: center; display: none;" id="waitmessage">Please wait.... </p>
          
        <div class="modal-body">
            <span id="responseData"></span>
        </div>            
      </div>
    </div>
  </div>
  <a href="#" id="scroll" style="display: block;"><span></span></a>

<script type="text/javascript">
    function showBill(idd,type){
      var receipt_type = type.substring(0, 3).toUpperCase();
        $('#rid').html(receipt_type +' '+ idd);
        $('#waitmessage').show();
        //jQuery.noConflict();     
        $("#myModal11").modal('show');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url()."share/showBill";?>',
            data: {idd:idd,type:type}
          }).done(function( result ) {
          //alert(result);
          $('#waitmessage').hide();
          $("#responseData").html( result );
          });              
      return false;   
    }
</script>

