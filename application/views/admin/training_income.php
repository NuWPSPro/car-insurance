<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-training_incomepanel">
	<div class="container">
      <div class="row">
       <?php  $this->load->view('admin/sidebar');  ?>  
          <div class="col-sm-9">
            <div class="clearfix">
              <h3 class="border-title pull-left">Training Income : CEP Bussiness </h3>
              <div class="d-flex pull-right">
              <form action="<?php echo current_url(); ?>" method="get">
                  <input type="text" placeholder="CEP Name" name="cep_name">
                  <input type="text" placeholder="Training Name" name="training_name">

                  <select name="country_id" id="" >
                    <option value="">Plese choose country</option>
                    <?php foreach($country as $ct): echo '<option value="'.$ct['countries_id'].'">'.$ct['countries_name'].'</option>'; endforeach; ?>
                  </select> 

                  <input type="date" title="Choose date" name="date">
                 
                  <select name="month" id="" >
                    <option value="">Plese choose month</option>
                    <?php $start = $month = strtotime('2020-12-01');
                  $end = strtotime('2021-12-01');
                  while($month < $end){ 
                    $month = strtotime("+1 month", $month);
                    echo '<option value="'.date('m', $month).'">'.date('F', $month).'</option>';    
                  } ?>
                  </select> 

                  <select name="year" id="" >
                    <option value="">Plese choose year</option>
                    <?php for($i=2020; $i<=date('Y'); $i++){ echo '<option value="'.$i.'">'.$i.'</option>'; } ?>
                  </select> 
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <a href="<?php echo base_url('admin/training_income'); ?>" class="btn btn-primary" >Reset</a>
                </form>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered trainin_income">
                   <tr>
                      <th>No.</th>
                      <th>User Name</th>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Tax</th>
                      <th>Amount</th>
                      <th>Net Income</th>
                      <th>Course Owner</th>
                      <th>Purchased Date </th>
                      <th>Country</th>
                      <th>Channel</th>
                      <th>Action</th>
                  </tr>
                <?php 
                $sum = 0; $unitSum = 0;  $taxSum = 0; $paypalSum = 0;  $netIncomeSum = 0;  $adminIncomeSum = 0;  $cepIncomeSum = 0;  $adminnetIncomeSum = 0; 

              if(count($training_cep) > 0){  
                foreach ($training_cep as $key => $value) { 

                $course_name = $this->user->get_record_by_field_name_all_record('tbl_training','id',$value['item_name']);
                $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['owner']); 

                if($value['role']==1){ $category = 'Professional'; }
                elseif($value['role']==2){ $category = 'CPD Provider'; }
                elseif($value['role']==3){ $category = 'Placement Agencies'; }
                elseif($value['role']==4){ $category = 'Advertisers'; }
                else{ $category = 'Insititution'; }
                $price = number_format(floatval($value['price']),2);
                $tax = $value['tax'];
                $unitPrice = number_format(floatval($price - $tax),2);
                $netIncome = $unitPrice;
                $txn = mb_substr($value['txn_id'], 0, 5);
                if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
                ?>
                  <tr>
                    <td class="text-center"> <?php echo $key+1;?>  </td>
                    <td class="text-center"> <?php echo  $value['username']; ?> </td> 
                    <td class="text-center">  <?php echo $value['item_name'] ?> </td>
                    <td class="text-center">  1  </td>
                    <td class="text-center">  <?php echo $unitPrice;?> </td>                        
                    <td class="text-center"> <?php echo $tax;?> </td>
                    <td class="text-center"> <?php echo $price; ?>   </td>  
                    <td class="text-center"> <?php echo $netIncome; ?>  </td>
                    <td class="text-center"> <?php echo $user_details[0]['name']; ?></td>                        
                    <td> <?php echo $value['added_on']; ?> </td>
                    <td> <?php echo $value['countries_name']; ?></td>
                    <td> <?php echo $channel; ?></td>                        
                    <td> <a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']?>','Training')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td>  
                  </tr>                          
                      <?php 
                      $sum += $price;
                      $unitSum += $unitPrice; 
                      $taxSum += $tax;  
                      $netIncomeSum += $netIncome; 
                      ?>
                      <?php } } ?>
                      <tr>
                          <td colspan="4"><strong>TOTAL</strong> </td>
                          <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                          <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                          <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                          <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                          <td colspan="5">&nbsp;</td>
                      </tr>
                </table>
            </div>
              </div>
            </div>
           
           
            <h3 class="border-title text-left">Training Income : Institution </h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered trainin_income">
                   <tr>
                      <th>No.</th>
                      <th>User Name</th>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Tax</th>
                      <th>Amount</th>
                      <th>Net Income</th>
                      <th>Course Owner</th>
                      <th>Purchased Date </th>
                      <th>Country</th>
                      <th>Channel</th>
                      <th>Action</th>
                  </tr>
                <?php 
                $sum = 0; $unitSum = 0;  $taxSum = 0; $paypalSum = 0;  $netIncomeSum = 0;  $adminIncomeSum = 0;  $cepIncomeSum = 0;  $adminnetIncomeSum = 0; 

              if(count($training_ins) > 0){  
                foreach ($training_ins as $key => $value) { 

                $course_name = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
                $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['owner']); 

                if($value['role']==1){ $category = 'Professional'; }
                elseif($value['role']==2){ $category = 'CPD Provider'; }
                elseif($value['role']==3){ $category = 'Placement Agencies'; }
                elseif($value['role']==4){ $category = 'Advertisers'; }
                else{ $category = 'Insititution'; }
                $price = number_format(floatval($value['price']),2);
                $tax = $value['tax'];
                $unitPrice = number_format(floatval($price - $tax),2);
                $netIncome = $unitPrice;
                $txn = mb_substr($value['txn_id'], 0, 5);
                if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
                ?>
                     <tr>
                         <td class="text-center"> <?php echo $key+1;?>  </td>
                          <td class="text-center"> <?=$value['username']?> </td> 
                          <td class="text-center">  <?= $value['item_name'] ?> </td>
                          <td class="text-center"> 1  </td>
                          <td class="text-center">  <?php echo $unitPrice;?> </td>                        
                         <td class="text-center"> <?php echo $tax;?> </td>
                          <td class="text-center"> <?php echo $price; ?>   </td>  
                          <td class="text-center"> <?php echo $netIncome; ?>  </td>
                          <td class="text-center"> <?php echo $user_details[0]['name']; ?></td>                        
                          <td> <?php echo $value['added_on']; ?> </td>
                          <td> <?php echo $value['countries_name']; ?></td>
                          <td> <?php echo $channel; ?></td>                        
                          <td>
                            <a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']?>','Training')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a>
                          </td>
                        </tr>                          
                      <?php 
                      $sum += $price;
                      $unitSum += $unitPrice; 
                      $taxSum += $tax; 
                      $netIncomeSum += $netIncome; 
                      ?>
                      <?php } } ?>
                      <tr>
                          <td colspan="4"><strong>TOTAL</strong> </td>
                          <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                          <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                          <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                          <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                          <td colspan="5">&nbsp;</td>
                      </tr>
                </table>
            </div>
          </div>
	     </div>
  </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="myModalDetails" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><div class="site-logo__link" style="max-width: 34%;">
              <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
          </div></center>
          <h4 class="modal-title">Receipt No. <span id="rid"></span></h4>
        </div>
        <div class="modal-body">
          <div id="responsecontent">  
          <p style="color: red;">Please wait...</p>
         </div>
        </div>
   
      </div>
      
    </div>
  </div>
  
<script>

  function showBill(idd,type){
  var receipt_type = type.substring(0, 3).toUpperCase();
    $('#rid').html(receipt_type +' '+ idd);
    $("#myModalDetails").modal('show');
    $.ajax({
      type: "POST",
      url: '<?php echo base_url("share/showBill");?>',
      data: {idd:idd,type:type}
      }).done(function( result ) {
      $("#responsecontent").html( result );
    });              
    return false; 
  }

</script>