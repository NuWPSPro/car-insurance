<?php $this->load->view('template/picture_provider'); 
$uid = $this->session->userdata('logged_in')['id'];
$uname = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['name'];
$staffFee = $this->db->get_where('tbl_all_tax',array('id'=>5))->row_array(); ?>

<div class="innerContent">
    <div class="container">
        <div class="row">
        <?php $this->load->view('provider/sidebar'); ?>

        <div class="col-sm-9">
        <h3 class="border-title text-left mb-0">Staff Activation 
        <a href="<?php echo base_url('provider/staffcerecords'); ?>" class="btn btn-primary pull-right">Back to Staff CE Records</a></h3>
        <?php echo $this->session->flashdata('response'); ?>

    <div class="step-wise-query provider-overview" id="selector">
    <!-- <div class="modal-body"> -->
        <ul class="nav-tabs hidden-xs">
            <li class="active" style="width:170px;"><a data-toggle="tab" href="#numstaff" aria-expanded="true" >Number of Staff</a></li>
            <!-- <li class="amo"><a data-toggle="tab" href="#saffamount" aria-expanded="fasle" >Amount</a></li>  
            <li class="pay"><a data-toggle="tab" href="#payment" aria-expanded="fasle" >Payment</a></li> -->
            <li class="act" style="width:170px;"><a data-toggle="tab" href="#activation" aria-expanded="fasle" >Activated Staff</a></li> 
        </ul>
        <div class="tab-content">
        <div id="numstaff" class="tab-pane fade active in">
                <p>Total staff selected to activate: <b><span id="totalchecked">0</span></b></p>
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th><!-- <input type="checkbox" name="selectall" value="" id="ckbCheckAll"> --></th>
                            <th>Staff name</th>
                            <th>email</th>
                            <th>Activation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        foreach ($staff_list as $key => $value) { 
                            if($value['status']=='1' && $value['activated']=='1'){ 
                                $activated ='<span style="color:green;">Enabled</span>'; 
                            }elseif($value['status']=='1' && $value['activated']=='0' && $payment == ''){ 
                                $activated ='<span style="color:orange;">Pending</span>'; 
                            }elseif($value['status']=='2' && $value['activated']=='0'){ 
                                $activated ='<span style="color:orange;">Disabled</span>'; 
                            }else {
                                // $activated ='<span style="color:red;">Disabled</span>'; 
                            }?>
                        <tr style="padding: 0;list-style: none;" class="staffCheckbox">
                            <td><?php echo $count; ?>.</td> 
                            <td><input type="checkbox" class="checkBoxClass" value="<?php echo $staffFee['total_amount']; ?>" id="<?php echo $value['id']; ?>" name="<?php echo $value['prof_id']; ?>" title="Activate"></td>
                            <td><?php echo $value['staff_name']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $activated; ?></td>
                        </tr>
                    <?php $count++; } ?>
                    </tbody>
                </table>
                </div>
            <!-- </div> -->
                <a href="javascript:void(0);" class="btn btn-primary" onclick="goToNext()">Next</a>
        <!-- <h4 class="bg-info p-3 rounded">Amount : $<span id="total">0</span> USD <a href="javascript:void(0);" class="btn btn-primary pull-right mr-3" id="staffPay" onClick="StaffPayment()">Pay</a></h4> -->
        </div>

        <!-- <div id="saffamount" class="tab-pane fade">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <tbody>
                        <tr>
                            <th>Total Number of Staff :</th>
                            <td id="numberOfstaff"></td>
                        </tr>
                        <tr>
                            <th>Activation Fee (Per Staff):</th>
                            <td id="activationFee"></td>
                        </tr>
                        <tr>
                            <th>Tax (<span id="tax_percentage"></span>% of price per certificate,<span id="taxamount"></span>):</th>
                            <td id="totaltaxamount"></td>
                        </tr>
                        <tr>
                            <th>Total :</th>
                            <td id="amounttotal"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h4 class="bg-info p-3 rounded">Amount : $<span id="total">0</span> USD 
            <a href="javascript:void(0);" class="btn btn-primary pull-right mr-3" id="staffPay" onClick="StaffPayment()">Pay</a></h4>
        </div> -->

        <!-- <div id="payment" class="tab-pane fade">
            <?php echo $this->session->flashdata('response-res'); ?>
            <a href="javascript:void(0);" class="btn btn-primary" onClick="goToActive()">Next</a>
            <a href="javascript:void(0);" class="btn btn-primary pull-right" onClick="purchasedetails(<?php echo $_REQUEST['go'];?>,'Staff')">View Receipt</a>
        </div> -->

        <div id="activation" class="tab-pane fade">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Staff name</th>
                            <th>email</th>
                            <th>Activation</th>
                        </tr>
                    </thead>
                    <tbody id="updatedStaffBody">
                        <?php $count = 1;
                        // $staffActivated = $this->db->get_where('tbl_institution_staff_payment',array('id'=>$_REQUEST['go']))->row_array()['staff_id'];
                        // $staff_id = explode(',',$staffActivated);
                        // $staffList = $this->db->where_in('id',$staff_id)->get('tbl_institution_staff')->result_array();
                        //print_r($staffList);die;

                        foreach ($staff_list as $key => $value) { 
                            if($value['status']=='1' && $value['activated']=='1'){ 
                                $activated ='<span style="color:red;">Activated</span>'; 
                            }elseif($value['status']=='1' && $value['activated']=='0'){ 
                                $activated ='<span style="color:orange;">Pending</span>'; 
                            }elseif($value['status']=='2' && $value['activated']=='0'){ 
                                $activated ='<span style="color:orange;">Disabled</span>'; 
                            }else {
                                // $activated ='<span style="color:red;">Disabled</span>'; 
                            }?>
                        <tr style="padding: 0;list-style: none;">
                            <td><?php echo $count; ?>.</td> 
                            <td><?php echo $value['staff_name']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $activated; ?></td>
                        </tr>
                    <?php $count++; } ?>
                    </tbody>
                </table>
                <a href="<?php echo base_url('provider/staffcerecords'); ?>" class="btn btn-primary pull-right">Back to Staff CE Records</a>
            </div>
        </div>
        </div>
    </div>
                     
                    
            </div>
        </div>
    </div>
</div>

<form action="" method="post" name="payment_for_staff" id="payment_for_staff">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="type" id="stypetype" value="Staff">
    <input type="hidden" name="id" id="sid" value="1">
    <input type="hidden" name="item_name" value="<?php echo $uname; ?> - Staff Activation">
    <!-- <input type="hidden" name="prof_id"  value=""> -->
    <input type="hidden" name="item_number" id="prof_id" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" id="amount" value="">
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <!-- <input type="hidden" name="custom" value="<?php echo $staffFee['tax_percentage'].'-'.$staffFee['tax_amount']; ?>"> -->
    <input type="hidden" name="custom" id="custom">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('provider/cancel_staffpayment'); ?>">
    <input type="hidden" name="return" value="<?php echo site_url('provider/success_staffpayment/'.$uid.''); ?> ">
</form>


<!-- Modal -->
  <div class="modal fade" id="myModalDetails" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center>
            <div class="site-logo__link" style="max-width: 34%;">
              <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
            </div>
          </center>
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

  <input type="hidden" name="staffarr" id="staffArr" value="">
  <input type="hidden" name="profarr" id="profArr" value="">
   <script>
        $(document).ready(function(){
            // alert('<?php echo $_REQUEST['go']; ?>');
            var payed = '<?php if($_REQUEST['go'] > 0){ ?>'+ $('.nav-tabs li.pay a').tab('show'); + '<?php }?>';
            $('.staffCheckbox input:checkbox').change(function () {
                  var total = 0;
                  var itemId = [];
                  var prof_id = [];
                  var count = 0;
                  var checkBox = $('.checkBoxClass:checkbox:checked').length;
                    $('#totalchecked').html(checkBox);
                  var tax    = parseFloat('<?php echo $staffFee['tax_amount'];?>');
                  var taxper = parseFloat('<?php echo $staffFee['tax_percentage'];?>');
                  var fee    = parseFloat('<?php echo $staffFee['base_price'];?>');
                  $('.staffCheckbox td input:checkbox:checked').each(function(){ // iterate through each checked element.
                    total += isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
                    count++;
                    if(isNaN(parseFloat($(this).val()))) {
                        var x = itemId.indexOf($(this).attr('id'));
                        itemId.splice(x, 1);
                        var x1 = prof_id.indexOf($(this).attr('name'));
                        prof_id.splice(x1, 1);
                    } else {
                        itemId.push($(this).attr('id'));
                        prof_id.push($(this).attr('name'));
                    }
                  });  
                  
                  $("#staffArr").val(itemId);
                  $("#profArr").val(prof_id);
                  
                  $("#total").html(total.toFixed(2));
                  $("#numberOfstaff").html(count);
                  $("#activationFee").html('$ '+fee);
                  $("#taxamount").html('$ '+tax);
                  $("#totaltaxamount").html('$ '+(tax * count));
                  $("#amounttotal").html('$ '+total.toFixed(2));
                  $("#tax_percentage").html(taxper);
                  if(total === 0) {
                      //alert("Please select atleast one participants.");
                      $('#staffPay').addClass('disabled');
                      $('#staffPayByCard').addClass('disabled');
                  } else {
                      $('#staffPay').removeClass('disabled');
                      // $('#item_name').val(itemId);
                      $('#custom').val(tax+'_'+itemId);
                      $('#prof_id').val(prof_id);
                      $('#amount').val(total);
                      
                  }
                  
            });
            
        });
        
        function StaffPayment() { 
            var url = '<?php echo PAYAPAL_URL; ?>';
            $('#stypetype').attr('disabled',true);
            $('#sid').attr('disabled',true);
            $('#payment_for_staff').attr('action',url);
            document.getElementById('payment_for_staff').submit();
        }
            
        function paybystripe() {
            var url = '<?php echo base_url('stripe/index'); ?>';
            $('#payment_for_staff').attr('action',url);
            document.getElementById('payment_for_staff').submit();
        }
                
        function goToNext(){
            var arr = $('#staffArr').val();
            var profarr = $('#profArr').val();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url("provider/activate_staff");?>',
                data: {arr:arr,profarr:profarr}
            }).done(function(result) {
                    $('#updatedStaffBody').html(result);
                    $('.nav-tabs li.act a').tab('show');
                });              
            return false; 
            // $('.nav-tabs li.amo a').tab('show');
        } 

        function goToActive(){
            $('.nav-tabs li.act a').tab('show');
        }

        function purchasedetails(idd,type){
          var receipt_type = type.substring(0, 3).toUpperCase();
          $('#rid').html(receipt_type +' '+ idd);
          $("#myModalDetails").modal('show');
            $.ajax({
              type: "POST",
              url: '<?php echo base_url("share/showBill");?>',
              data: {idd:idd,type:type}
            }).done(function( result ) {
              //alert(result);
              $("#responsecontent").html( result );
            });              
            return false; 
        }

        // $("#ckbCheckAll").click(function () {
        //     $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        // });
        

        // function byplan(plan_id, tid, amount) {
        //     var item = plan_id + '_' + tid;
        //     $('#item_name').val(item);
        //     $('#amount').val(amount);
        //     document.getElementById("frmPayPal1").submit();
        // }
  </script>

