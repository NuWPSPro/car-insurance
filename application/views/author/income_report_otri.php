<?php $this->load->view('template/picture_author'); ?>
<div class="innerContent author-income-report-otri">
    <div class="container">
        <div class="row">
            <!-- <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
            <?php  $this->load->view('author/sidebar');  ?>
            <div class="col-sm-9">
                <h3 class="border-title text-left">Income Report</h3>
                <div class="col-sm-3 form-group">
                    <?php
                    $today_total = 0; 
                    foreach ($today as $key => $value) {

                      $amt = $value['amount'];

                      $today_total = $today_total + $amt;

                  }
                  ?>
                    <div class="circle-income text-center">
                        <span>$<?php echo $todayIncome;?></span>
                        <strong>TODAY'S INCOME</strong>
                    </div>
                </div>
                <div class="col-sm-3 form-group">
                    <?php



                $month_total = 0; 

                foreach ($month as $key => $value) {

                  $amt = $value['amount'];

                  $month_total = $month_total + $amt;

              }



              ?>
                    <div class="circle-income text-center">
                        <span>$<?php echo $monthIncome;?></span>
                        <strong>MONTH INCOME</strong>
                    </div>
                </div>
                <div class="col-sm-3 form-group">
                    <?php



            $year_total = 0; 



            foreach ($year as $key => $value) {

              $amt = $value['amount'];

              $year_total = $year_total + $amt;

          }



          ?>
                    <div class="circle-income text-center">
                        <span>$<?php echo $yearIncome;?></span>
                        <strong>YEAR INCOME</strong>
                    </div>
                </div>
                <div class="col-sm-3 form-group">
                    <?php



        $total_total = 0; 



        foreach ($total as $key => $value) {

          $amt = $value['amount'];

          $total_total = $total_total + $amt;

      }

      ?>
                    <div class="circle-income text-center">
                        <span>$<?php echo $totalIncome;?></span>
                        <strong>TOTAL INCOME</strong>
                    </div>
                </div>
                <?php 


$month    	=  isset($_REQUEST['month'])?$_REQUEST['month'] :date('m');
$year1     	=  isset($_REQUEST['year'])?$_REQUEST['year'] :date('Y');
$montharr = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');



?>
                <div class="">
                    	<div class="panel-body detail-income-report">
							<h2 class="text-uppercase">Details Income Report</h2>
						<p class="text-center">
							<a class="btn btn-default" href="<?php echo BASE_URL?>provider/income_report?month=&year=<?php echo date('Y');?>">Course Sale Income</a>
							<!-- <a class="btn btn-primary"  href="<?php echo BASE_URL?>provider/income_report?month=&year=<?php echo date('Y');?>&otri=1">Online Training Registraion Income</a> -->
						</p>
					</div>
                    <div class="col-sm-12">
                        <div class="alert alert-info clearfix">
							
                            <div class="col-sm-5 form-group">
                                <label>Month <sup>*</sup></label>
                                <select name="month" id="month" class="form-control">
                                    <option value="" selected>...Select...</option>
                                    <?php 
									foreach ($montharr as $key => $value) { ?>
                                    <option value="<?php echo $key;?>" <?php if($month== $key){ echo "selected" ;} ?>>
                                        <?php echo $value;?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <span class="error"></span>
                            </div>
                            <div class="col-sm-5 form-group">
                                <label>Year <sup>*</sup></label>
                                <select name="year" id="year" class="form-control">
                                    <?php 



        $year = date('Y');



        for ($i=2015; $i <=$year ; $i++) { 



          ?>
                                    <option <?php if($year1==$i){ echo "selected" ;} ?> value"
                                        <?php echo $i;?>">
                                        <?php echo $i;?>
                                    </option>
                                    <?php 



    }



    ?>
                                </select>
                                <span class="error"></span>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input type="submit" style="margin-top: 34px;" class="btn btn-primary" value="Filter" onclick="searchdata()">
                            </div>
                        </div>
                    </div>
                </div>
<?php 
	
	//$totalData =  $this->user->getpay1($month1,$year1);
	$totalData =  $this->provider_model->training_income($this->session->userdata('logged_in')['id'],'','',$month,$year1);


$month1 = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

if($month != ""){ 
    for ($i=1; $i <= 31; $i++) { 
      $date = $year1."-".$_REQUEST['month']."-".$i;
      //$sumdata = $this->user->getSum1($date);
      $sumdata = $this->provider_model->daywiseTrainingIncome($this->session->userdata('logged_in')['id'],$date);
      if($sumdata['amount']!=""){
          $tot = $sumdata['amount'];
      } else {
		  $tot = 0;
      }
      $array[] =  array("label"=> $i, "y"=> $tot);
  }
//echo '<pre>';  print_r($array); die;
} else {
  foreach ($month1 as $key => $value) {
   $start_date = "2018-".$key."-01";
   $end_date   = "2018-".$key."-31";
   //$sumdata = $this->user->getSumBetween1($start_date,$end_date);
  // $sumdata = $this->user->getSumBetween1($start_date,$end_date);
   $sumdata = $this->provider_model->traingIncomereport($this->session->userdata('logged_in')['id'],$key,$year1);
	if($sumdata['amount']!=""){
		$tot = $sumdata['amount'];
	} else {
		$tot = 0;
	}
	$array[] =  array("label"=> $value, "y"=> $tot);  
	}

}
$dataPoints1 = $array;
//echo '<pre>'; print_r($totalData); exit;
if(!empty($totalData)){



    ?>	
				<div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body detail-income-report">
                            <h2 class="text-uppercase">Details Income Report</h2>
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th class="text-center">S.No</th>
                                    <th>Training</th>
                                    <th class="text-center">Unit Price</th>
                                     <th class="text-center">Amount</th>
                                    <th>Purchase Date</th>
                                </tr>
                                <?php 

                $sum = 0;

                foreach ($totalData as $key => $value) {

                    $sum = $sum+$value['amount'];

                    ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $key+1;?>
                                    </td>
                                    <td>
                                        <?php echo $value['title'];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $value['amount'];?>
                                    </td>
                                   
                                    <td class="text-center">
                                        <?php echo $value['amount'];?>
                                    </td>
                                    <td>
                                        <?php echo date("jS F, Y", strtotime($value['added_on'])); ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3"><strong>TOTAL</strong> </td>
                                    <td class="text-center"><strong>$<?php echo $sum;?></strong></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </div>
                
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>
<script type="text/javascript">
function searchdata() {
    var month = $('#month').val();
    var year = $('#year').val();
    var constval = "month=" + month + "&year=" + year;
	var base_url = "<?php echo base_url()."provider/income_report?";?>";
    var fullurl = base_url + constval + '&otri=1';
    window.location = fullurl;
    /*    $.ajax({
        type: "POST",
        url: '<?php //echo base_url()."provider/filter";?>',
        data: {month:month,year:year}
        }).done(function( result ) {
			console.log(result);
        $("#filteredData2").html( result );
        });            
        return false;  */
	}
</script>
<script>
window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
		theme: "light2",
        title: {
            text: "MONTHLY INCOME REPORT"
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
    chart.render();
    function toggleDataSeries(e) {
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        chart.render();
    }
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();

});
</script>
<style type="text/css">
.button {



    background-color: #4CAF50;



    border: none;



    color: white;



    padding: 20px;



    text-align: center;



    text-decoration: none;



    display: inline-block;



    font-size: 16px;



    margin: 4px 2px;
}







.button1 {

    border-radius: 2px;
}



.button2 {

    border-radius: 4px;
}



.button3 {

    border-radius: 8px;
}



.button4 {

    border-radius: 12px;
}



.button5 {

    border-radius: 50%;
}
</style>