<?php $this->load->view('template/picture'); ?>


 <div class="innerContent professional-purchase_list">
	  <div class="container">
      <div class="row">
        	<!-- <div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
        	</div> -->
       <?php  $this->load->view('professional/sidebar');  ?>  
      <?php $common = array();
      foreach($practise_promotion as $value){
        $txn_id = json_decode($value['transaction_details']);
        // print_r($txn_id);
        $common[] = array(
          'id'        =>  $value['id'],
          'quantity'  =>  1,
          'title'     =>  $txn_id->item_name,
          'type'      =>  'Promotion', //practise promotion
          'txn_id'    =>  $txn_id->txn_id,
          'added_on'  =>  date('Y-m-d',strtotime($txn_id->payment_date)),
          'amount'    =>  floatval($value['promoted_amount'])
        );
      } 
      foreach($purchase_list as $value){
        $resData =  $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','id',$value['item_name']);
        $common[] = array(
          'id'        =>  $value['id'],
          'quantity'  =>  1,
          'title'     =>  $resData[0]['course_title'],
          'type'      =>  'Course',
          'txn_id'    =>  $value['txn_id'],
          'added_on'  =>  $value['added_on'],
          'amount'    =>  floatval($value['amount'])
        );
      } 
       foreach($training_list as $value){
        $resData =  $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training','id',$value['training_seminar_id']);
        $txn_details = json_decode($value['transaction_details']);
        $common[] = array(
          'id'        =>  $value['id'],
          'quantity'  =>  1,
          'title'     =>  $txn_details->item_name,
          'type'      =>  'Training',
          'txn_id'    =>  $value['txn_id'],
          'added_on'  =>  $value['added_on'],
          'amount'    =>  floatval($value['amount'])
        );
      }
       foreach($advertise as $value){
        $txn_details = json_decode($value['transaction_details']);
        $common[] = array(
          'id'        => $value['id'],
          'quantity'  => 1,
          'title'     => $value['title'],
          'type'      => 'Advertise',
          'txn_id'    => $txn_details->txn_id,
          'added_on'  => date('Y-m-d',strtotime($value['purchased_on'])),
          'amount'    => floatval($txn_details->payment_gross)
        );
      }
         
        foreach($planpaymenthistoryArr as $value){
          if($value['version_type'] == 1){
            $plan_name =  'Basic';
          }
          if($value['version_type'] == 2){
            $plan_name =  'PRO-Version';
          }
          if($value['version_type'] == 3){
            $plan_name =  'Premium';
          }
         $common[] = array(
          'id'        =>  $value['id'],
          'quantity'  =>  1,
          'title'     =>  $plan_name,
          'type'      =>  'Pcems',
          'txn_id'    =>  $value['payment_transtion_id'],
          'added_on'  =>  $value['payment_at'],
          'amount'    =>  floatval($value['payment_amount'])
        ); }
      ?>

       <div class="col-sm-9">
            <h3 class="border-title text-left">Purchase List</h3>
            <div class="table-responsive">
            <table class="table table-striped table-bordered">
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
              <?php  if($currentplanArr->version_type == 1){
                        $planname =  'Basic';
                      }
                      if($currentplanArr->version_type == 2){
                        $planname =  'PRO-Version';
                      }
                      if($currentplanArr->version_type == 3){
                        $planname =  'Premium';
                      } ?>  
              <?php if($currentplanArr->id){ ?> 
                  <tr>
                <?php if(!empty($planpaymenthistory->payment_transtion_id)){ ?>
                    <td>..</td>
                    <td style="color: red;"><?=$planname?>(Current Plan)</td>
                    <td>Plan (PCE-MS)</td>
                    <td>1</td>
                    <td><?=$planpaymenthistory->payment_transtion_id?></td>
                    <td class="text-right"><?=$planpaymenthistory->payment_recieved_at?></td>
                    <td class="text-right">$<?=$planpaymenthistory->payment_amount?></td>
                    <td class="text-right"><a href="javascript:void(0)" onclick="showBill('<?php echo $planpaymenthistory->pppph_id; ?>','<?php echo 'Pcems'; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o"></i></a></td>
                    <!-- <td class="text-center"><?=$planpaymenthistory->payment_transtion_id?></td> -->
                <?php }else{ echo '<td style="color: red; text-align: center;" colspan="7">'.$planname.' ( Free-Trail )</td>'; } ?>  
                  </tr>
              <?php } ?>
                <?php $tot=0; $count=1;
                  foreach ($common as $key => $value) {
                  $tot = $tot + $value['amount']; ?>
                <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $value['title'];?></td>

                    <td><?php if($value['type']=='Company Promotion'){
                      echo 'Promotion';
                    }elseif($value['type']=='Course'){
                      echo 'Online Course';
                    }else{
                      echo $value['type'];
                    } ?></td>

                    <td><?php echo $value['quantity'];?></td>
                    <td><?php echo $value['txn_id'];?></td>
                    <td class="text-right"><?php echo $value['added_on'];?></td>                                
                    <td class="text-right">$<?php echo $value['amount'];?></td>
                    <td class="text-right"><a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']; ?>','<?php echo $value['type']; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o"></i></a></td>
                    <!-- <td class="text-center"><a href="javascript:void(0)" onclick="showBill('<?php echo $value['id'];?>','<?php echo $value['type'];?>')" class="text-primary"> <?php echo $value['txn_id'];?></a></td> -->
                </tr>
                <?php  $count++; } ?>
                <tr class="bg-info">
                    <td colspan="6" class="text-right text-primary">Total</td>
                    <td class="text-right text-primary">$<?php echo $tot + $planpaymenthistory->payment_amount;?></td>
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

<div class="modal fade" id="PromotionPractiseSuccess" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <center><div class="site-logo__link" style="max-width: 34%;display: block; text-align: -webkit-center;">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
            </div></center>
          <!-- <h4 class="modal-title">Modal Header</h4> -->
        </div>
        <div class="modal-body">
          <h4 class="modal-title text-center" style="font-weight: bold;">
            <img src="<?php echo ASSETS_URL.'images/perfect-text.jpg'; ?>" alt="Perfect" width="175">
          </h4>
          <h6><?php echo $this->session->flashdata('response'); ?></h6>
        </div>
        <div class="modal-footer">
          <a href="<?php echo base_url('pages/latestprofessional'); ?>" class="btn btn-primary">View Your Promotion</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<a href="#" id="scroll" style="display: inline;"><span></span></a>

<script type="text/javascript">
    $(document).ready(function() {
     var pop = '<?php if($_REQUEST['id']=="done"){  ?>'+ $('#PromotionPractiseSuccess').modal('show') + '<?php } ?>';
    } );
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

