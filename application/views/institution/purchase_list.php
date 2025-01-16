<?php $this->load->view('institution/picture'); 
      $uid = $this->session->userdata('logged_in')['id']; ?>


 <div class="innerContent">
	  <div class="container">
      <div class="row">
        	<div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
        	</div>
      <?php  $this->load->view('institution/sidebar');  ?>  
      <div class="col-sm-9">
            <h3 class="border-title text-left">Purchase List</h3>
             <table class="table table-striped table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Provider</th>
                    <th>Type</th>
                    <th>Item Quantity</th>
                    <th>Transaction Id</th>
                    <!-- <th class="text-center">Receipt</th> -->
                    <th>Date Purchased</th>
                    <th class="text-right">Amount</th>
                    <th>Action</th>
                </tr>
                <?php  if(!empty($staff_payment)){
                  $tot = 0;
                  $count = 1;
                  foreach($staff_payment as $value){ 
                  $txn_details = json_decode($value['transaction_details']);
                  $provider_name = $this->db->get_where('tbl_user',array('id' =>$value['provider_id']))->row_array();
                  if($provider_name['parent_insititution'] == $uid){ ?>

                <tr><?php $tot += $value['amount']; ?>
                    <td><?php echo $count;?>.</td>
                    <td><?php echo $provider_name['name'];?></td>
                    <td><?php echo 'Staff Payment';?></td>
                    <td><?php echo 1;?></td>
                    <td><?php echo $txn_details->txn_id;?></td>
                    <!-- <td class="text-center"><a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']; ?>','<?php echo $value['type']; ?>')" class="text-primary"> <?php echo $value['txn_id'];?></a></td> -->
                    <td><?php echo date('Y-m-d',strtotime($value['added_on']));?></td> 
                    <td class="text-right">$<?php echo $value['amount'];?></td>
                    <td class="text-right"><a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']; ?>','<?php echo 'Staff Payment'; ?>')" class="text-primary">View Receipt</a></td>
                </tr>
                <?php  $count++; } } ?>
                <tr>
                    <td colspan="6" class="text-right">Total</td>
                    <td class="text-right">$<?php echo $tot;?></td>
                    <td></td>
                </tr>
              <?php }else{ echo'<p>No data Found!</p>';} ?>
            </table>
        </div>
       </div>
	</div>
	</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  function showBill(idd,type)
  {
   // alert(idd+type);
      $('#rid').html(idd);
      $('#waitmessage').show();
      jQuery.noConflict(); 

      $.ajax({
        type: "POST",
        url: "<?php echo base_url('institution/showBill');?>",
        data: {idd:idd,type:type}
      }).done(function( result ){
        //alert(result);
          $('#waitmessage').hide();
          $("#myModaIns").modal('show');
          $("#responseData").html( result );
      });              
      return false;   
  }
  </script>

  <!-- Modal -->
  <div class="modal fade" id="myModaIns" role="dialog">
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

