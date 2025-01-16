<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
        <?php $uid = $this->session->userdata('logged_in')['id'];
              $udata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
              $tid = $this->uri->segment(3);
              $segment = $this->uri->segment(4);
              $purchased_plan = $this->user->get_record_by_field_name_all_record('tbl_template_plan','id',$udata[0]['template_plan']);
              $misc           = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);  
              $training = $training[0]; 
              $certificateFee = $this->db->get_where('tbl_all_tax',array('id'=>7))->row_array(); ?>
        <?php $this->load->view('provider/sidebar'); ?>
        <div class="col-sm-9">
            <h3 class="border-title text-left mb-0">Generate Certificate</h3>
            <h4 class="border-title text-left"><?php echo $training['title'];?>
            <a href="<?php echo base_url('provider/training_view/'.$tid); ?>" class="btn btn-primary pull-right">Back to Training View Page</a></h4>
                <?php echo $this->session->flashdata('response');?>

    <div class="step-wise-query provider-overview" id="selector">
        <ul class="nav-tabs hidden-xs">
            <li class="active"><a data-toggle="tab" href="#template" aria-expanded="true">Template</a></li>
            <li class="rec"><a data-toggle="tab" href="#recipients" aria-expanded="fasle">Recipients</a></li>  
            <li class="tot"><a data-toggle="tab" href="#totalbill" aria-expanded="fasle">Total Bill</a></li>
            <li class="pay"><a data-toggle="tab" href="#payment" aria-expanded="fasle">Payment</a></li> 
            <li class="cer"><a data-toggle="tab" href="#certificate" aria-expanded="fasle">Certificate</a></li> 
        </ul>
        <div class="tab-content">
            <div id="template" class="tab-pane fade active in">
                <div class="template-select mb-5">
                    <?php $key=1; ?>
                    <div class="item">
                        <label for="planchange<?php echo $key;?>"> 
                            <div class="selectedimage">
                                <input type="radio" name="templete_id" id="planchange<?php echo $key;?>" onchange="planchange('<?php echo $key;?>')" value="<?php echo $templete['id'];?>" checked >
                                <img src="<?php echo ASSETS_URL.'upload/certificate_templete/';?><?php echo $templete['temppreview']; ?>" alt="<?php echo $templete['template_no'];?>" width="100">
                                <i class="fa fa-check"></i>
                            </div>
                            <br> 
                            <div class="text-center">
                                <button type="button" class="btn btn-primary certificateview" data-toggle="modal" data-target="#myModal" data-id="<?php echo ASSETS_URL.'upload/certificate_templete/'.$templete['temppreview']; ?>">View</button>
                                <a class="btn btn-info" href="<?php echo site_url('provider/choose_certificate_edit/').$tid;?>">Edit</a>
                            </div>
                        </label>
                    </div>
                </div>
                <a href="javascript:void(0);" class="btn btn-success" onclick="goToRecipients()" >Next</a>
            </div>

            <div id="recipients" class="tab-pane fade">
                <p>Total Participants Selected: <b><span id="totalchecked">0</span></b></p>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th><!-- <input type="checkbox" name="selectall" value="" id="ckbCheckAll"> --></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $count = 1;
                            $datas = $this->user->get_reciepient($tid); 
                            foreach ($datas as $key => $value) { 
                                if($value['present_status']=='1' && $value['certificate_id'] > 0){ 
                                    $status ='<span style="color:green;">Success</span>'; 
                                }else {
                                    $status ='<span style="color:red;">Pending</span>'; 
                                } 
                                $check_evaluation = $this->db->get_where('tbl_training_review', array('user_id' => $value['user_id'], 'training_id' => $value['training_seminar_id']))->num_rows(); 
                                //if ($check_evaluation > 0) { ?>
                            <tr style="padding: 0;list-style: none;" class="staffCheckbox">
                                <td><?php echo $count; ?>.</td> 
                                <td><input type="checkbox" class="checkBoxClass" value="<?php echo $certificateFee['total_amount']; ?>" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>"></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $status; ?></td>
                            </tr>
                        <?php $count++; } //} ?>
                        </tbody>
                    </table>
                </div>
                <a href="javascript:void(0);" class="btn btn-success" onClick="goToBill()" >Next</a>
            </div>

            <div id="totalbill" class="tab-pane fade">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <tbody>
                            <tr>
                                <th>Price Per Certificate: </th>
                                <td id="price_per_cert"></td>
                            </tr>
                            <tr>
                                <th>Total Number of Certificate:</th>
                                <td id="count_cert"></td>
                            </tr>
                            <tr>
                                <th>Total Certificate Price:</th>
                                <td id="total_cert_price"></td>
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
                <h4 class="bg-info p-3 rounded">Amount : $<span id="total">0</span> USD <button class="btn btn-primary pull-right mr-3" id="staffPay" onclick="certiPayment()">Pay</button> </h4>
            </div>

            <div id="payment" class="tab-pane fade">
                <?php echo $this->session->flashdata('response-res'); ?>
                <a href="javascript:void(0);" class="btn btn-primary" onClick="goToCertificate()">Next</a>
                <a href="javascript:void(0);" class="btn btn-primary pull-right" onClick="purchasedetails(<?php echo $segment;?>,'Certificate Issued')">View Receipt</a>
            </div>

            <div id="certificate" class="tab-pane fade">
                <p style="font-size: 12px;font-weight: bold;">(Click individual button of each recipient to Generate Certificate)</p>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Staff name</th>
                                <th>email</th>
                                <th>Status</th> 
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $certData  = $this->db->get_where('tbl_training_certificate',array('id'=>$segment))->row_array()['participate_cust_ids'];
                                // $custId    = unserialize($certData['customer_id']);
                                if(!empty($certData)){
                                $rowid    = explode(',',$certData);
                                $count = 1;
                                $tbdetails = $this->db->where_in('id',$rowid)->get('tbl_training_book')->result_array();

                                foreach ($tbdetails as $key => $value) {
                                // $rowid    = $value['participate_cust_ids'];
                                if($value['certificate_id']==""){
                                   $stats = '<span class="btn btn-danger">Pending</span>';
                                } else {
                                   $stats = $value['certificate_id'];
                                }?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td><?php echo $stats; ?></td>
                                    <td>
                                      <?php if($value['certificate_id']==""){ ?>
                                        <a target="_blank" class="btn btn-info" href="<?php echo site_url('provider/mypdf/'.$uid.'/'.$rowid[$key]);?>">Generate Certificate</a>
                                      <?php }else{ ?>
                                        <a class="btn btn-success" href="javascript:void(0)">Certificate Generated </a>
                                      <?php }?>
                                    </td>
                                </tr>
                            <?php $count++; } }else{ echo '<tr><td colspan="5">Sorry no records founds.</td></tr>'; } ?>
                        </tbody>
                    </table>
                    <a href="<?php echo base_url('provider/training_view/'.$tid); ?>" class="btn btn-primary pull-right">Back to Training View Page</a>
                </div>
            </div>
        </div>
    </div>
                
                
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="myModal" role="dialog" >
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Certificate Template</h4>
            </div>
            <div class="modal-body">

              <center>
                <img id="certificateimagelist" src="">
               </center>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>


<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="certifictePay" id="certifictePay">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name" value="">
    <input type="hidden" name="item_number"id="item_number" >
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="<?php echo $uid; ?>">
    <input type="hidden" name="custom" id="custom">
    <input type="hidden" name="amount" id="amount">
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('provider/cancel_provider_plan/'.$tid); ?>">
    <input type="hidden" name="return" value="<?php echo site_url('provider/success_provider_plan/'.$tid); ?>">
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

    <div id="CertificatePayby" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Choose Payment Option</h4>
            </div>
            <div class="modal-body"> 
              <a href="javascript:void(0)" onclick="certificatebypaypal();" class="btn btn-primary"> PayPal</a>
               <a href="javascript:void(0)" onclick="certificatebystrip();" class="btn btn-info"> Card</a>
            </div>
          </div>
        </div>
    </div>

    <form action="<?php echo base_url('stripe/index'); ?>" method="get" name="stripePay" id="certificateStripeBuy">
        <input type="hidden" name="id" value="<?php echo $training['id'];?>"> <!-- here id is training id. -->
        <input type="hidden" name="name"  value="<?php echo $training['title'].' - Certificate Issued';?>">
        <input type="hidden" name="price" id="totalCprice">
        <input type="hidden" name="tax"  id="Ctax">
        <input type="hidden" name="day" id="Cparticipants"> <!-- participants Ids in arr-->
        <input type="hidden" name="base_price" id="CbasePrice">
        <input type="hidden" name="type" value="Certificate Issued">
    </form>

<script type="text/javascript">
            $(document).ready(function(){
            // alert('<?php echo $_REQUEST['go']; ?>');
            var payed = '<?php if($segment != '' && $segment > 0){ ?>'+ $('.nav-tabs li.pay a').tab('show'); + '<?php }?>';
            $('.staffCheckbox input:checkbox').change(function () {
                  var total = 0;
                  var itemId = [];
                  var itemName = [];
                  var count = 0;
                  var trainingname = "<?php echo $training['title'].' - Certificate Issued';?>";
                  var trainingid = "<?php echo $training['id'];?>";
                  var checkBox = $('.checkBoxClass:checkbox:checked').length;
                    $('#totalchecked').html(checkBox);
                  var tax = parseFloat('<?php echo $certificateFee['tax_amount'];?>');
                  var taxper = parseFloat('<?php echo $certificateFee['tax_percentage'];?>');
                  var fee = parseFloat('<?php echo $certificateFee['base_price'];?>');
                  $('.staffCheckbox td input:checkbox:checked').each(function(){ // iterate through each checked element.
                    total += isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
                    count++;
                    if(isNaN(parseFloat($(this).val()))) {
                        var x = itemId.indexOf($(this).attr('id'));
                        itemId.splice(x, 1);
                        var x1 = itemName.indexOf($(this).attr('name'));
                        itemName.splice(x1, 1);
                    } else {
                        itemId.push($(this).attr('id')); //tbl_training_book's id 
                        itemName.push($(this).attr('name'));
                    }
                  }); 
                  // var count_cert = '$ '+;    
                  $("#total").html(total.toFixed(2));
                  $("#count_cert").html(count);
                  $("#total_cert_price").html('$ '+(count * fee));
                  $("#price_per_cert").html('$ '+fee);
                  $("#taxamount").html('$ '+tax);
                  $("#totaltaxamount").html('$ '+(count * tax));
                  $("#amounttotal").html('$ '+total.toFixed(2));
                  $("#tax_percentage").html(taxper);
                  if(total === 0) {
                      $('#staffPay').addClass('disabled');
                  }else{
                      $('#staffPay').removeClass('disabled');
                      $('#item_number').val(itemId);
                      $('#item_name').val(trainingname);
                      $('#custom').val(tax+'_'+fee+'_'+trainingid); //tax + base price + training id
                      $('#amount').val(total);
                      $('#totalCprice').val(total); //stripe payment
                      $('#Ctax').val(tax); //stripe payment
                      $("#Cparticipants").val(itemId);//stripe payment
                      $("#CbasePrice").val(fee);//stripe payment
                  }
            });
        });

    function planchange(idd) {
        //alert(idd);
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("provider/setdefault");?>',
            data: { idd }
        }).done(function(result) {
            //alert(result);
            $("#filteredData2").html(result);
        });
        return false;
    }

    function certiPayment() { 
      $("#CertificatePayby").modal("show"); 
    // jQuery('#coursepro').submit();
    }

    // function certiPayment() {
    //     $("#certifictePay").submit();
    // }
    function certificatebypaypal(){
        $("#certifictePay").submit();
    }

    function certificatebystrip() {
        $("#certificateStripeBuy").submit();
    }

    $('.certificateview').click(function(){
        var certificate = $(this).attr('data-id');
        $('#certificateimagelist').attr('src', certificate);
    });

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

    function goToRecipients(){
        // alert('alert');
        $('.nav-tabs li.rec a').tab('show');
    }
    function goToBill(){
        // alert('alert');
        $('.nav-tabs li.tot a').tab('show');
    } 
    function goToCertificate(){
        // alert('alert');
        $('.nav-tabs li.cer a').tab('show');
    } 
</script>

