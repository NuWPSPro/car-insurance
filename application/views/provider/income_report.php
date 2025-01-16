
<style type="text/css">
.button{background-color:#4caf50;border:none;color:#fff;padding:20px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;margin:4px 2px}.button1{border-radius:2px}.button2{border-radius:4px}.button3{border-radius:8px}.button4{border-radius:12px}.button5{border-radius:50%}
</style>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php  $uid = $this->session->userdata('logged_in')['id']; 
      $providerins = $this->session->userdata('logged_in')['insititution_id']; 
      $authorList = $this->provider_model->author_list($providerins);
      if(isset($_REQUEST['year']) && !empty($_REQUEST['year'])){
        $title1     =  $_REQUEST['title'];
        $month1    =  ($_REQUEST['month'] !="")?$_REQUEST['month']:'';
        $year1     =  $_REQUEST['year'];
        // $totalData =  $this->user->getpay($month1,$year1);
        // $totalData =  $this->provider_model->course_income($uid,'',$title1,'',$month1,$year1);
      }else{
        // $totalData =  $this->provider_model->course_income($uid,'','','',date('m'),date('y'));
      } 
      
      $month1 = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
      $month = $_REQUEST['month'];
      $years = $_REQUEST['year'];
      $totalAmount=0;
      $ss = 0;

    if($month!="") 
    { 
      for ($i=1; $i <= 31; $i++) 
      { 
        $date = $years."-".$month."-".$i;
        //$sumdata = $this->user->getSum($this->session->userdata('logged_in')['id'],$date);
        $sumdata = $this->provider_model->getSum($uid,$date);
  	    // echo $i.'---'.$sumdata['amount'].'<br>';
  	    //echo '<pre>'; print_r($sumdata);

        $ss = $ss + $sumdata['amount'];
          if($sumdata['amount']!=""){
              $tot = $sumdata['amount'];
          } else {
              $tot = 0;
          }
          $array2[] =  array("label"=> $i, "y"=> $tot);
      }
    $dataPoints2 = $array2;

    } 
    else 
    {

      foreach ($month1 as $key => $value) 
      {
        $start_date = $years."-".$key."-01";
        $end_date   = $years."-".$key."-31";
        /* $sumdata = $this->user->getSumBetween($start_date,$end_date);
        $totalAmount = $totalAmount+$sumdata[0]['amount']; */

        $sumdata = $this->provider_model->courseIncomereport($uid,$key,$years);
        $totalAmount = $totalAmount+$sumdata['amount'];
        $ss = $ss + $sumdata['amount'];
        if($sumdata['amount']!=""){ $tot = $sumdata['amount']; } else { $tot = 1; }
        $array2[] =  array("label"=> $value, "y"=> $tot);    
  		}
  		$dataPoints2 = $array2;

  } ?>
<?php   if($_REQUEST['month'] !=""){ $mm = $_REQUEST['month']; } else { /*$mm = date('m');*/  $mm = ''; }
        if($_REQUEST['year'] !=""){ $yy = $_REQUEST['year']; } else { $yy = date('Y'); }  ?>

<?php $this->load->view('template/picture_provider');  ?>

        <div class="innerContent">
          <div class="container">
            <div class="row">

              <?php //$this->load->view('provider/sidebar');  ?>
              <div class="col-sm-12">
                <div class="clearfix">
                  <h3 class="border-title pull-left">Income Report</h3>
                  <a href="<?=base_url('provider/set_target');?>" class="dashboard-btn pull-right" style="width: 250px;">Dashboard</a>
                </div>
                <div class="col-sm-3 form-group"> 
                  <div class="circle-income text-center">
                      <span>$<?php echo number_format($todayIncome,2);?></span>
                      <strong>TODAY'S INCOME</strong>
                  </div>
                </div>
                <div class="col-sm-3 form-group">
                  <div class="circle-income text-center">
                      <span>$<?php echo number_format($monthIncome,2);?></span>
                      <strong>MONTH INCOME</strong>
                  </div>
                </div>
                  
                <div class="col-sm-3 form-group">
                  <div class="circle-income text-center">
                      <span>$<?php echo number_format($yearIncome,2);?></span>
                      <strong>YEAR INCOME</strong>
                  </div>
                </div>
                <div class="col-sm-3 form-group">
                  <div class="circle-income text-center">
                      <span>$<?php echo number_format($totalIncomeProvider,2);?></span>
                      <strong>LIFE TIME INCOME</strong>
                  </div>
                </div>
                <hr> 
                <div class="col-sm-3 form-group"> 
                  <div class="circle-income text-center">
                      <span>$<?php echo number_format(($todayIncome-$todayTax),2);?></span>
                      <strong>TODAY'S NET INCOME</strong>
                  </div>
                </div>
                <div class="col-sm-3 form-group">
                  <div class="circle-income text-center">
                      <span>$<?php echo number_format(($monthIncome-$monthTax),2);?></span>
                      <strong>MONTH NET INCOME</strong>
                  </div>
                </div>
                  
                <div class="col-sm-3 form-group">
                  <div class="circle-income text-center">
                      <span>$<?php echo number_format(($yearIncome-$yearTax),2);?></span>
                      <strong>YEAR NET INCOME</strong>
                  </div>
                </div>
                <div class="col-sm-3 form-group">
                  <div class="circle-income text-center">
                      <span>$<?php echo number_format(($totalIncomeProvider-$totalTax),2);?></span>
                      <strong>LIFE TIME NET INCOME</strong>
                  </div>
                </div>
              </div>
                  
              <div class="row col-sm-12">
                <div class="panel-body detail-income-report">
                  <h2 class="text-uppercase">Detailed Income Report</h2>
                  <p class="text-center">
                      <a class="btn btn-primary" href="<?php echo BASE_URL?>provider/income_report?month=&year=<?php echo date('Y');?>">
                          Course Course Income
                      </a>
                      <a class="btn btn-default" href="<?php echo BASE_URL?>provider/income_report?month=&year=<?php echo date('Y');?>&otri=1">
                          Training Online Registraion Income
                      </a>
                  </p> 
                </div>

                <div class="alert alert-info clearfix">
              
                  <div class="col-sm-6 form-group">
                      <label>Enter Title<sup>*</sup></label>
                      <input type="text" name="title" id="title" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>" class="form-control">  
                      <span class="error"></span>
                  </div>
              
                  <div class="col-sm-6 form-group">
                  
                      <label>Select Author<sup>*</sup></label>
                      <select name="author" id="author" class="form-control">
                        <option value="">Choose Author</option>
                      <?php
                      foreach($authorList as $value): 
                        if($value['id'] == $_REQUEST['author']){ $auselected = 'selected'; }else{ $auselected =  ''; } 
                      echo "<option value='".$value['id']."'".$auselected.">".$value['name']."</option>"; endforeach; ?>  
                      </select>  
                      <span class="error"></span>
                  </div>

                  <!-- <div class="col-sm-6 form-group">
                      <label>Income Source<sup>*</sup></label>
                      <select name="income_source" id="income_source" class="form-control">
                          <option value="" selected>...Select...</option>
                          <option value="online_course">Online Course</option>
                          <option value="training_registration">Training Registration</option>
                      </select>  
                      <span class="error"></span> 
                  </div>-->

                  <div class="col-sm-5 form-group">
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

                  <div class="col-sm-5 form-group">
                      <label>Year <sup>*</sup></label>
                      <select name="year" id="year" class="form-control">
                        <option value="">Choose Year</option>
                          <?php $year = date('Y');
                          for ($i=2015; $i <=$year ; $i++) { ?>
                              <option <?php if($year==$i){ echo "selected";} ?> value="<?php echo $i;?>">
                                  <?php echo $i;?>
                              </option>
                          <?php } ?>
                        </select>
                        <span class="error"></span>
                  </div>

                  <div class="col-sm-1 form-group">
                      <input style="margin-top: 34px;" type="submit" class="btn btn-primary" value="Filter" onclick="searchdata()">
                  </div>

                  <div class="col-sm-1 form-group">
                      <a href="<?php echo site_url('provider/income_report?month=&year='.date('Y').'');?>">    
                        <input style="margin-top: 34px;" type="submit" class="btn btn-primary" value="Reset">
                      </a>
                  </div>
                </div>
              </div>
              

              <div class="col-sm-12">
                <!-- <div class="panel panel-default"> -->
                  <div class="panel-body detail-income-report">
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
                          <th>Author</th>
                          <th>Purchase Date</th>
                          <th>Country</th>
                          <th>Channel</th>
                          <th>Action</th>
                        </tr>
                        <?php 
                        $sum = 0;
                        $count = 1;
                        foreach ($totalData as $key => $value)
                        {
                          // $commistion = round((round($value['price'])*5)/100);
                          $price = floatval($value['amount']);
                          $tax = floatval($value['tax']);
                          // $unitPrice1 = $price - floatval($commistion);
                          // $paypalCharge = round(($unitPrice1*5)/100);
                          // $paypalCharge = 0;
                          $unitPrice = $price - $tax;
                          $netIncome = $unitPrice;
                          $adminIncome = floatval(($unitPrice*30)/100);
                          $cepIncome = floatval(($unitPrice*70)/100);
                          $adminNetIncome = $adminIncome;
                          $buyer = $this->db->get_where('tbl_user',array('id'=>$value['pid']))->row_array();
                          if($value['author_reference_id']!=''){
                            $authorName = $this->db->get_where('tbl_course',array('user_id'=>$value['author_reference_id']))->row_array()['title'];
                          }else{
                            $authorName = 'n/a';
                          }
                            
                          $country = $this->db->get_where('countries',array('countries_id'=>$buyer['country']))->row_array()['countries_name']; 
                          $txn = mb_substr($value['txn_id'], 0, 5);
                          if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';} ?>
                          <tr>
                            <td class="text-center"><?php echo $count;?></td>
                            <td><?php echo $value['course_title'];?></td>
                            <td><?php echo $value['buyer'];?></td>
                            <td class="text-center"><?php echo $value['quantity'];?></td>
                            <td class="text-center"><?php echo number_format($unitPrice,2);?></td>
                            <td class="text-center"><?php echo $tax;?></td>
                            <!-- <td class="text-center"><?php echo $paypalCharge;?></td> -->
                            <td class="text-center"><?php echo number_format($price,2);?></td>
                            <td class="text-center"><?php echo number_format($netIncome,2);?></td>
                            <td class="text-center"><?php echo number_format($adminIncome,2); ?></td>
                            <td class="text-center"><?php echo number_format($cepIncome,2); ?></td>
                            <td class="text-center"><?php echo $authorName; ?></td>
                            <td><?php echo date("jS F, Y", strtotime($value['added_on'])); ?></td>
                            <td class="text-center"><?php echo $country; ?></td>
                            <td class="text-center"><?php echo $channel; ?></td>
                            
                            <td class="text-center">
                            <a style="color: blue;" href="javascript:void(0);" onclick="purchasedetails('<?php echo $value['pid'];?>','<?php echo 'Course'; ?>');" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a>
                            </td>

                          </tr>
                          <?php 
                            $sum += $price;
                            $unitSum += $unitPrice; 
                            $taxSum += $tax;  
                            $netIncomeSum += $netIncome; 
                            $adminIncomeSum += $adminIncome; 
                            $cepIncomeSum += $cepIncome; 
                            $adminnetIncomeSum += $adminNetIncome;
                          ?>

                          <?php $count++; 
                        } 
                        ?>
                        <tr>
                            <td colspan="4"><strong>TOTAL</strong> </td>
                            <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                            <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                            <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                            <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                            <td class="text-center"><strong>$<?php echo number_format(floatval($adminIncomeSum),2); ?></strong></td>
                            <td class="text-center"><strong>$<?php echo number_format(floatval($cepIncomeSum),2); ?></strong></td>
                            <!-- <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td> -->
                            <td colspan="4">&nbsp;</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                <!-- </div> -->
              </div>

              <div class="col-sm-12">
                <!-- <div class="panel panel-default"> -->
                  <div class="panel-body detail-income-report">
                  <?php //if($month != ""){ ?>	
                    <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                  <?php //}else{ ?>               
                  <?php //} ?>
                  </div>	
                <!-- </div>	 -->
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
          <?php 
            $adminIncome = $ss*30/100;
            $cpdIncome   = $ss-$adminIncome;
          ?>
          <table>
            <tr><td>CPD Income</td><td> : <?php echo round($cpdIncome);?> </td></tr>
            <tr><td>Admin Commission ( 30% )</td><td> : <?php echo round($adminIncome);?></td></tr>
            <tr><th>Total Income</th><th> : <?php echo round($ss);?></th></tr>
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

        <?php  $invdate = $_REQUEST['year'].'-'.$_REQUEST['month'].'-'.date('d'); ?>

        <input type="hidden" name="total_amount" value="<?php echo round($ss); ?>">
        <input type="hidden" name="adminIncome" value="<?php echo round($adminIncome); ?>">
        <input type="hidden" name="cpdIncome" value="<?php echo round($cpdIncome); ?>">
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

<script type="text/javascript">

   // $(document).ready(function() {
     //   $('#example').DataTable();
    //});

    function searchdata() {
        var title = $('#title').val();
        var month = $('#month').val();
        var author = $('#author').val();
        var year = $('#year').val();
        var constval = "title=" + title + "&month=" + month + "&author="+ author +"&year=" + year;
        var base_url = "<?php echo base_url()."provider/income_report?";?>";
        var fullurl = base_url + constval;
    //alert(fullurl);
    window.location = fullurl; 
    }

    window.onload = function() {
        /* var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: ""
            },
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
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render(); */
    var chart1 = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: ""
            },
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
		 $("#invoice").modal('show');
	}

	function checkform(){ 
		$('#bank').hide();
		$('#paypal').hide();
		var payment_method = $('#payment_method').val(); 
		$('#'+payment_method).show();
	}
</script>