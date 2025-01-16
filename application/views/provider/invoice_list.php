<?php $this->load->view('template/picture_provider'); ?>
<?php 

$uid = $this->session->userdata('logged_in')['id'];
$invoiceData = $this->db->get_where('tbl_invoice',array('month_name'=>$_REQUEST['year'].'-'.$_REQUEST['month'],'user_id'=>$uid))->row_array();

  if(!empty($_REQUEST['year'])){
        $month1    =  ($_REQUEST['month'] !="")?$_REQUEST['month']:'';
        $year1     =  $_REQUEST['year'];
        // $totalData =  $this->user->getpay($month1,$year1);
        $totalData =  $this->provider_model->course_income($uid,'','',$month1,$year1);
        // echo $this->db->last_query();
      }

  $month1 = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

  $month = $_REQUEST['month'];
  $years = $_REQUEST['year'];

  $totalAmount=0;

  $ss = 0;

  if($month!="") { 

      for ($i=1; $i <= 31; $i++) { 

        $date = $years."-".$month."-".$i;
        $sumdata = $this->provider_model->getSum($uid,$date);
  	    $ss = $ss + $sumdata['amount'];
        if($sumdata['amount']!=""){
            $tot = $sumdata['amount'];
        } else {
            $tot = 0;
        }
        $array2[] =  array("label"=> $i, "y"=> $tot);
    }
    $dataPoints2 = $array2;

    } else {

  	foreach ($month1 as $key => $value) {
  		$start_date = $years."-".$key."-01";
  		$end_date   = $years."-".$key."-31";

  		$sumdata = $this->provider_model->courseIncomereport($uid,$key,$years);
  		$totalAmount = $totalAmount+$sumdata['amount'];
  		$ss = $ss + $sumdata['amount'];
      // $ss = $ss + (($sumdata['amount']*70)/100);
  		if($sumdata['amount']!=""){
  		$tot = $sumdata['amount'];
  		} else {
  		$tot = 1;
  		}
  		$array2[] =  array("label"=> $value, "y"=> $tot);    
  		}
  		$dataPoints2 = $array2;

  } 

      if($_REQUEST['month'] !=""){
        $mm = $_REQUEST['month'];
      } else {
        //$mm = date('m');
        $mm = '';
      }

      if($_REQUEST['year'] !=""){
        $yy = $_REQUEST['year'];
      } else {
        $yy = date('Y');
      }  ?>
<div class="innerContent">
  <div class="container">
    <div class="row">
      <?php  $this->load->view('provider/sidebar');  ?>
        <div class="col-sm-9">
          <?php echo $this->session->flashdata('response');?> 
            <h3 class="border-title text-left">Create Invoice</h3>
	
  <div class="col-sm-12">
    <div class="alert alert-info clearfix">
      <div class="col-sm-4 form-group">
          <label>Month <sup>*</sup></label>
          <select name="month" id="month" class="form-control">
              <option value="" selected>...Select...</option>
              <?php foreach ($month1 as $key => $value) { ?>
                <option <?php if($key==$mm){ echo "selected"; } ?> value="<?php echo $key;?>">
                  <?php echo $value; ?>
              </option>
              <?php } ?>
          </select>
          <span class="error"></span>
      </div>

      <div class="col-sm-4 form-group">
          <label>Year <sup>*</sup></label>
          <select name="year" id="year" class="form-control">
              <?php $year = date('Y');
              for ($i=2015; $i <=$year ; $i++) { ?>
                  <option <?php if($year==$i){ echo "selected";} ?> value="<?php echo $i;?>">
                      <?php echo $i;?>
                  </option>
              <?php } ?>
            </select>
            <span class="error"></span>
      </div>

      <div class="col-sm-2 form-group">
          <input style="margin-top: 34px;" type="submit" class="btn btn-primary" value="Filter" onclick="searchdata()">
      </div>

      <div class="col-sm-2 form-group">
          <a href="<?php echo site_url('provider/invoice_list?month=&year='.date('Y').'');?>">    
            <input style="margin-top: 34px;" type="submit" class="btn btn-primary" value="Reset">
          </a>
      </div>

      <?php if($_REQUEST['month'] !=""){ ?>
        <div class="col-sm-8 form-group">
          <p style="font-weight: bold;">Total Income : $<?php echo  number_format(floatval($ss),2);?></p>
        </div>

        <div class="col-sm-4 form-group">
          <input style="" type="button" class="btn btn-primary" value="Create Invoice" onclick="create_invoice()">
        </div> 
      <?php } ?>
    </div>
    <?php if($_REQUEST['month'] !=""){ ?>
    <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <tr>
              <th>S.No</th>
              <th>Course Title</th>
              <th>User Name</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Tax</th>
              <!-- <th>Paypal Charge</th> -->
              <th>Amount</th>
              <th>Net Income</th>
              <th>Admin(30%)</th>
              <th>CEP(70%)</th>
              <th>Purchase Date</th>
              <th>Action</th>
            </tr>
            <?php 
            $sum = 0;
            $count = 1;
            foreach ($totalData as $key => $value) {
              $price = number_format(floatval($value['amount']),2);
              $tax = floatval($value['tax']);
              $unitPrice = $price - $tax;
              $netIncome = $unitPrice;
              $adminIncome = floatval(($unitPrice*30)/100);
              $cepIncome = floatval(($unitPrice*70)/100);
              $adminNetIncome = $adminIncome;
              $sum = $sum + $value['amount']; 
              $uprice = $uprice + $unitPrice; 
              $getpayment = $getpayment + $cepIncome; 
              ?>
              <tr>
                <td class="text-center"><?php echo $count;?></td>
                <td><?php echo $value['course_title'];?></td>
                <td><?php echo $value['buyer'];?></td>
                <td class="text-center"><?php echo $value['quantity'];?></td>
                <td class="text-center"><?php echo $unitPrice;?></td>
                <td class="text-center"><?php echo $tax;?></td>
                <!-- <td class="text-center"><?php echo $paypalCharge;?></td> -->
                <td class="text-center"><?php echo $price;?></td>
                <td class="text-center"><?php echo $netIncome;?></td>
                <td class="text-center"><?php echo $adminIncome; ?></td>
                <td class="text-center"><?php echo $cepIncome; ?></td>
                <td><?php echo date("jS F, Y", strtotime($value['added_on'])); ?></td>
                
                <td class="text-center">
                <a style="color: blue;" href="javascript:void(0);" onclick="purchasedetails('<?php echo $value['pid'];?>','<?php echo 'Course'; ?>');">View Details</a>
                </td>

              </tr>
              <?php $count++; } ?>
              <tr>
                <td colspan="4">&nbsp;</td>
                <td><b>$<?php echo number_format(floatval($uprice),2);?></b></td>
                <td><b>TOTAL<b></td>
                <td class="text-center"><b>$<?php echo number_format(floatval($sum),2);?></b></td>
                <td>&nbsp;</td>
                <td><b>CEP Income</b></td>
                <td class="text-center"><b>$<?php echo number_format(floatval($getpayment),2);?></b></td>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table>
        </div>
    <?php } ?>
  <!-- </div> -->

  <!-- <div class="col-sm-12"> -->
    <h3 class="border-title text-left">Invoice List</h3>
    <!-- <div class="panel panel-default"> -->
      <!-- <div class="panel-body detail-income-report"> -->
        <div class="table-responsive">
          <table id="invoice-list" class="table table-striped table-bordered">
            <tr>
              <th>S.No</th>
              <th>Month Name</th>
              <th>Payment Method</th>
              <th>Total Amount</th>
              <th>Tax Amount</th>
              <th>Admin Amount</th>
              <th>CPD Amount</th>
              <th>Paypal ID</th>
              <th>Bank Account</th>
              <th>Bank Code</th>
              <th>Bank Name</th>
              <th>Swift Code</th>
              <th>Transaction ID</th>
              <th>Status</th>
            </tr>
          <?php 
              if($invoice_list){
              $count = 1;
              foreach($invoice_list as $key => $value){ 
                  if($value['status']==2){
                    $status = '<span style="color:green">Paid</span>';
                  }else{
                    $status = '<span style="color:red">Request</span>';
                  } ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $value['month_name']; ?></td>
              <td><?php echo $value['payment_method']; ?></td>
              <td><?php echo $value['total_amount']; ?></td>
              <td><?php echo $value['tax']; ?></td>
              <td><?php echo $value['admin_amount']; ?></td>
              <td><?php echo $value['cpd_amount']; ?></td>
              <td><?php echo $value['paypal_id']; ?></td>
              <td><?php echo $value['bank_account']; ?></td>
              <td><?php echo $value['bank_code']; ?></td>
              <td><?php echo $value['bank_name']; ?></td>
              <td><?php echo $value['swift_code']; ?></td>
              <td><?php echo $value['transaction_id']; ?></td>
              <td><?php echo $status; ?></td>
            </tr>
          <?php $count++; } }else{ echo'<tr><td colspan="13">No Data Found!</td></tr>'; } ?>
          </table>
        </div>
      <!-- </div> -->
    <!-- </div> -->
  <!-- </div> -->

      </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
  <div class="modal fade" id="invoice" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Invoice</h4>
        </div>

        <div class="modal-body"> 
            <?php   $tax         = $ss - $uprice; 
                    $adminIncome = ($uprice * 30)/100;
                    $cpdIncome   = $ss - $adminIncome - $tax; ?>

          <table class="table table-striped">
            <tr>
              <th>Month & Year</th><td> :<span id="monthyear"></span></td>
            </tr>
         <!--    <tr>
              <th>Start Date & End Date</th><td> : 1st to 30th june 2020</td>
            </tr>
 -->
            <tr>
              <th>Total Income</th><td> : <?php echo number_format(floatval($ss),2);?></td>
            </tr>
            <tr>
              <th>Tax </th><td> : <?php echo number_format(floatval($tax),2);?></td>
            </tr>
            <tr>
              <th>Admin Commission ( 30% )</th><td> : <?php echo number_format(floatval($adminIncome),2);?></td>
            </tr>
            <tr>
              <th>CPD Income</th><td> : <?php echo number_format(floatval($cpdIncome),2);?> </td>
            </tr>
          </table>
            
            

        <form action="<?php echo site_url('provider/create_invoice');?>" id="create_inv" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="form-group">
              <label for="email">Payment Method:</label>
              <select name="payment_method" id="payment_method" class="form-control" required onchange="checkform()">
                <option value="" selected>Select Payment Method</option>
                <option value="paypal">Receive via Paypal</option>
                <option value="bank">Receive via Bank transfer</option>
              </select>
            </div>

          <?php //$invdate = $_REQUEST['year'].'-'.$_REQUEST['month'].'-'.date('d');  ?>
          <?php $invdate = $_REQUEST['year'].'-'.$_REQUEST['month'];  ?>
          <input type="hidden" name="total_amount" value="<?php echo number_format(floatval($ss),2); ?>">
          <input type="hidden" name="adminIncome" value="<?php echo number_format(floatval($adminIncome),2); ?>">
          <input type="hidden" name="cpdIncome" value="<?php echo number_format(floatval($cpdIncome),2); ?>">
          <input type="hidden" name="tax" value="<?php echo number_format(floatval($tax),2); ?>">
          <input type="hidden" name="invoice_date" value="<?php echo $invdate; ?>">

          <div class="form-group" id="paypal" style="display: none;">
             <label for="email">Enter Paypal Details: <span style="color: red;">*</span></label>
             <input type="text" class="form-control" id="paypalId" name="paypalId">
          </div>

          <div id="bank" style="display: none;">
            <div class="form-group">
             <label for="email">Bank A/C: <span style="color: red;">*</span></label>
             <input type="text" class="form-control" id="bank_account" name="bank_account">
            </div>

            <div class="form-group">
             <label for="email">Bank Code: <span style="color: red;">*</span></label>
             <input type="text" class="form-control" id="bank_code" name="bank_code">
            </div>

            <div class="form-group">
             <label for="email">Branch Name: <span style="color: red;">*</span></label>
             <input type="text" class="form-control" id="branch_name" name="branch_name">
            </div>  

            <div class="form-group">
             <label for="email">Swift Code: <span style="color: red;">*</span></label>
             <input type="text" class="form-control" id="swift_code" name="swift_code">
            </div>
          </div>

          <button type="button" class="btn btn-default" onclick="saveform()">Request to Admin</button>
        </form>
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

  
<script type="text/javascript">
  $(document).ready( function () {
    $('#invoice-list').DataTable();
  } );

  function searchdata() {
      var month = $('#month').val();
      var year = $('#year').val();
      var constval = "month=" + month + "&year=" + year;
      var base_url = "<?php echo base_url()."provider/invoice_list?";?>";
      var fullurl = base_url + constval;
  //alert(fullurl);
  window.location = fullurl; 
  }

  window.onload = function() {
      var chart1 = new CanvasJS.Chart("chartContainer1", {
          animationEnabled: true,
          theme: "light2",
          title: { text: "" },
          legend: {
              cursor: "pointer",
              verticalAlign: "center",
              horizontalAlign: "right",
              itemclick: toggleDataSeries
          },
          data: [{
              type: "column",
              name: "Real Trees",
              indexLabel: "{y}",
              yValueFormatString: "$#0.##",
              showInLegend: true,
              dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
          }]
      });
    chart1.render();
        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart.render();
            chart1.render();
        }
    }

    function saveform(){
    var payment_method = $('#payment_method').val();
    if(payment_method=="paypal"){
      var paypal_id = $('#paypalId').val();
      if(paypal_id==""){
        document.getElementById('paypalId').style.border='1px solid #F00';
        return false;
      } else {
        document.getElementById('create_inv').submit();
      }
    }

    if(payment_method=="bank"){
      var bank_account = $('#bank_account').val();
      var bank_code    = $('#bank_code').val();
      var branch_name  = $('#branch_name').val();
      var swift_code   = $('#swift_code').val();
      var error = 1;
      if(bank_account==""){
          document.getElementById('bank_account').style.border='1px solid #F00';
          error = 0;
      }

      if(bank_code==""){
          document.getElementById('bank_code').style.border='1px solid #F00';
          error = 0;
      }

      if(branch_name==""){
          document.getElementById('branch_name').style.border='1px solid #F00';
          error = 0;
      }

      if(swift_code==""){
          document.getElementById('swift_code').style.border='1px solid #F00';
          error = 0;
      }

      if(error==0){
        return false;
      } else {
         document.getElementById('create_inv').submit();
      }
    }
  }




	function create_invoice(){
    if('<?=$invoiceData;?>'){
      alert('This month and year is for invoice is already created and can not be generated anymore.');
    }else{
      var selcetedDate = "<?=$_REQUEST['year'].'-'.$_REQUEST['month'].'-'.date('d');?>";
      var fixDate = "<?=date('Y').'-'.date("m").'-'.'25';?>";
       if(selcetedDate <= fixDate){
        var selectedm = "<?= $_REQUEST['month'].', '.$_REQUEST['year']; ?>";
		    $("#monthyear").html(selectedm);
        $("#invoice").modal('show');
      }else{
        alert('You can generate invoice in the last week of the current month or after it.');
      }
    }
	}

	function checkform(){ 
		$('#bank').hide();
		$('#paypal').hide();
		var payment_method = $('#payment_method').val(); 
		$('#'+payment_method).show();
	}

  function purchasedetails(idd,type){
  // alert(id +'*'+ type);
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

</script>