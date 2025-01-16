<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
    <div class="container">
        <h2 class="border-title text-left">Dashboard</h2>
        <div class="row">
            <?php  $this->load->view('provider/sidebar');  ?>
            <div class="col-sm-8">
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
                    <span>$<?php echo $today_total;?></span>
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
                <span>$<?php echo $month_total;?></span>
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
            <span>$<?php echo $year_total;?></span>
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
        <span>$<?php echo $total_total;?></span>
        <strong>TOTAL INCOME</strong>
    </div>

</div>
<?php 

$month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

?>
<div class="col-sm-6 form-group">
    <label>Month <sup>*</sup></label>
    <select name="month" id="month" class="form-control">
        <option value="" selected>...Select...</option>
        <?php 

        foreach ($month as $key => $value) {

          ?>
          <option value="<?php echo $key;?>">
            <?php echo $value;?>
        </option>
        <?php 

    }

    ?>
</select>
<span class="error"></span>
</div>
<div class="col-sm-6 form-group">
    <label>Year <sup>*</sup></label>
    <select name="year" id="year" class="form-control">
        <?php 

        $year = date('Y');

        for ($i=2015; $i <=$year ; $i++) { 

          ?>
          <option <?php if($year==$i){ echo "selected";} ?> value"
            <?php echo $i;?>">
            <?php echo $i;?>
        </option>
        <?php 

    }

    ?>
</select>
<span class="error"></span>
</div>
<div class="col-sm-6 form-group">
    <input type="submit" class="btn btn-primary btn-lg" value="Filter" onclick="searchdata()">
</div>
<?php 

if(!empty($_REQUEST['year'])){
  $month1    =  $_REQUEST['month'];
  $year1     =  $_REQUEST['year'];
  $totalData =  $this->user->getpay1($month1,$year1);
}


$month1 = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

$month = $_REQUEST['month'];

if($month!="") { 



    for ($i=1; $i <= 31; $i++) { 



      $date = "2018-".$_REQUEST['month']."-".$i;

      $sumdata = $this->user->getSum1($date);



      if($sumdata[0]['amount']!=""){

          $tot = $sumdata[0]['amount'];

      } else {

          $tot = 1;

      }



      $array[] =  array("label"=> $i, "y"=> $tot);



  }

//echo '<pre>';  print_r($array); die;

} else {



  foreach ($month1 as $key => $value) {



   $start_date = "2018-".$key."-01";

   $end_date   = "2018-".$key."-31";



   $sumdata = $this->user->getSumBetween1($start_date,$end_date);



   if($sumdata[0]['amount']!=""){

    $tot = $sumdata[0]['amount'];

} else {

    $tot = 1;

}
  $array[] =  array("label"=> $value, "y"=> $tot);    
}
}

$dataPoints1 = $array;





if(!empty($totalData)){

    ?>

    <div class="col-sm-12 form-group" style="margin-bottom: 50px;">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </div>
    <div class="col-sm-12 form-group">
    	<p><b>Details Income Report</b></p>
    	<p>
    	
       <a href="<?php echo BASE_URL?>admin/income_report?month=&year=<?php echo date('Y');?>">
    <input type="button" value="Course Sale Income" class="btn">
  </a>
    
    <a href="<?php echo BASE_URL?>admin/income_report?month=&year=<?php echo date('Y');?>&otri=1">
    <input type="button" value="Online Training Registraion Income" class="btn-primary">
  </a>
 

    	</p>
    		<p>Online Training Registraion Income</p>
       <table class="table table-striped">
                <tr>
                    <th>S.No</th>
                    <th>Course Title</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Purchase Date</th>
                </tr>
                <?php 
                $sum = 0;
                foreach ($totalData as $key => $value) {
                    $sum = $sum+$value['amount'];
                    ?>
                 
                 <tr>
                        <td>
                            <?php echo $key+1;?>
                        </td>
                        <td>
                            <?php echo $value['item_name'];?>
                        </td>
                        <td>
                            <?php echo $value['amount'];?>
                        </td>
                        <td>
                            1
                        </td>
                        <td>
                            <?php echo $value['amount'];?>
                        </td>
                        <td>
                         <?php echo date("jS F, Y", strtotime($value['added_on'])); ?>
                        </td>
                    </tr>

                <?php } ?> 
                <tr>
                    <td>&nbsp;</td>
                    <td><strong>TOTAL</strong> </td>
                    <td>&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-right"><strong>$<?php echo $sum;?></strong></td>
                </tr>
            </table>
        </div>
        <?php } ?>
    </div>
</div>
</div>
</div>
</div>


<script type="text/javascript">
    function searchdata() {

        var month = jQuery('#month').val();
        var year  = jQuery('#year').val();
        var constval = "month=" + month + "&year=" + year;
        var base_url = "<?php echo base_url()."admin/income_report?";?>";

    var fullurl = base_url + constval+'&otri=1';
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
    jQuery(document).ready(function() {
        jQuery('#example').DataTable();
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