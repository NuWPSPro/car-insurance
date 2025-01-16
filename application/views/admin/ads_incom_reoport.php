<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div>
            <?php  $this->load->view('admin/sidebar');  ?>
            <div class="col-sm-8">
                <h3 class="border-title text-left">Ads Income Report</h3>
                <div class="col-sm-3 form-group">
                    <?php

                    $today_total = 0; 

                    foreach ($today as $key => $value) {
                      $amt = $value['amount'] ;
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
                  $amt = $value['amount'] ;
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
              $amt = $value['amount'] ;
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
          $amt = $value['amount'] ;
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

if($_REQUEST['month'] !=""){
  $mm = $_REQUEST['month'];
} else {
  $mm = date('m');
}

if($_REQUEST['year'] !=""){
  $yy = $_REQUEST['year'];
} else {
  $yy = date('Y');
}

$uid = $_REQUEST['users'];
?>
<div class="">
  <div class="col-sm-12">
      <div class="alert alert-info clearfix">

 

<div class="col-sm-3 form-group">
            <label>CPD Provider <sup>*</sup></label>
            <select name="users" id="users" class="form-control">
                <option value="" selected>...Select...</option>
                <?php 
                foreach ($users as $key => $value) { 
                 //echo '<pre>'; print_r($value); die;

                  ?>
                  <option <?php if($value['id']==$uid){ echo "selected";} ?> value="<?php echo $value['id'];?>"><?php echo $value['name']; ?></option>
                <?php } ?>
                
        </select>
        <span class="error"></span>
    </div>




        <div class="col-sm-3 form-group">
            <label>Month <sup>*</sup></label>
            <select name="month" id="month" class="form-control">
                <option value="" selected>...Select...</option>
                <?php 
                foreach ($month as $key => $value) { ?>

                  <option <?php if($key==$mm){ echo "selected"; } ?> value="<?php echo $key;?>">
                    <?php echo $value; ?>
                </option>
                
                <?php } ?>

        </select>
        <span class="error"></span>
    </div>




    <div class="col-sm-3 form-group">
        <label>Year <sup>*</sup></label>
        <select name="year" id="year" class="form-control">
            <?php 
            $year = date('Y');
            for ($i=2015; $i <=$year ; $i++) { 
            ?>
              <option <?php if($year==$i){ echo "selected";} ?> value"<?php echo $i;?>">
                <?php echo $i;?></option>
            <?php } ?>
    </select>
    <span class="error"></span>
</div>


<div class="col-sm-1 form-group">
    <input style="margin-top: 30px;" type="submit" class="btn btn-primary" value="Filter" onclick="searchdata()">
</div>

<div class="col-sm-2 form-group">
    <a href="<?php echo site_url('admin/dashboard/?month=&year='.date('Y').'');?>">    
    <input style="margin-top: 30px;" type="submit" class="btn btn-primary" value="Reset">
 </a>
</div>

</div>
</div>
</div>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


<?php 



if(!empty($_REQUEST['year'])){
  $month1    =  $_REQUEST['month'];
  $year1     =  $_REQUEST['year'];
  if($month1==""){
    $month1 = date('m');
  } 
   $totalData =  $this->user->getpayadmin($month1,$year1,$uid);
 

}





$month1 = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

$month = $_REQUEST['month'];
$years = $_REQUEST['year'];

$totalAmount=0;
foreach ($month1 as $key => $value) {
$start_date = $years."-".$key."-01";
$end_date   = $years."-".$key."-31";
$sumdata = $this->user->getSumBetweenAdmin($start_date,$end_date,$uid);
$totalAmount = $totalAmount+$sumdata[0]['amount'];
if($sumdata[0]['amount']!=""){
$tot = $sumdata[0]['amount'];
} else {
$tot = 0;
}
$array[] =  array("label"=> $value, "y"=> $tot);    
}
$dataPoints1 = $array;




$ss = 0;

if($month!="") { 


    for ($i=1; $i <= 31; $i++) { 

      $date = $years."-".$month."-".$i;
      $sumdata = $this->user->getSumAdmin($date,$uid);
      $ss = $ss + $sumdata[0]['amount'];
      if($sumdata[0]['amount']!=""){
          $tot = $sumdata[0]['amount'];
      } else {
          $tot = 0;
      }
      $array2[] =  array("label"=> $i, "y"=> $tot);
  }
  $dataPoints2 = $array2;

} else {


for ($i=1; $i <= 31; $i++) { 

$date = $years."-".date('m')."-".$i;
$sumdata = $this->user->getSumAdmin($date,$uid);
$ss = $ss + $sumdata[0]['amount'];
if($sumdata[0]['amount']!=""){
$tot = $sumdata[0]['amount'];

} else {

$tot = 1;
}
$array2[] =  array("label"=> $i, "y"=> $tot);
}
$dataPoints2 = $array2;
}
?>


<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-body">

<?php 
$sum2 =0;
foreach ($totalData as $key => $value) {
  $sum2 = $sum2+$value['amount'] ;
}
?>            


            
            <?php 
             if($uid !=""){ 

             foreach ($users as $key => $value) { 
 
                if($value['id']==$uid){
                ?>
                <center>
                <h2 class="text-uppercase" style="font-weight: bold;"><?php echo $value['name'];?></h2>
                </center>
                <?php    
                }
             }
             ?>
             <?php 
              }
             ?>
          

            <center>
                <h2 class="text-uppercase" style="font-weight: bold;">MONTHLY INCOME REPORT</h2>
              <p><?php echo $month1[$mm];?> <?php echo $yy;?></p>
              <p>Total Income <?php echo $ss;?></p>
            </center>

                <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
            </div>


        <div class="table-responsive">

            <div class="panel-body detail-income-report">
            <h2 class="text-uppercase">Details Income Report</h2>
             <p class="text-center">

                                <a class="btn btn-default" href="<?php echo site_url('admin/dashboard/?month=&year='.date('Y-m-d'));?>">Course Sale Income</a>								<a class="btn btn-primary" href="<?php echo site_url('admin/ads_income_report/?month=&year='.date('Y-m-d'));?>">Ads Income</a>
                                <a class="btn btn-default" href="#">Training Registraion Income</a>
                                <?php 
                                if($uid ==""){
                                ?>
                                <a class="btn btn-default" href="#">Promotion Income</a>
                                <a class="btn btn-default" href="#">Subscription Income</a>
                                <a class="btn btn-default" href="#">Advertisement Income</a>
                                <?php } ?>
                            </p>

 
        </div>


            <table class="table table-striped table-bordered">
                <tr>
                    <th>S.No</th>
                    <th>Course Title</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Purchase Date</th>
                    <th>Action</th>
                </tr>
                <?php 
                $sum = 0;
                foreach ($totalData as $key => $value) {
                  //  echo '<pre>';
                   // print_r($value);
                    $sum = $sum+$value['amount'] * $value['quantity'];
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $key+1;?>
                        </td>
                        <td>
                            <?php 
                            $datacourse = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
                            $puchselist = $this->user->get_record_by_field_name_all_record('tbl_purchase_llis','added_on',$value['added']);
                            
                            //echo '<pre>'; print_r($puchselist); die;
                            echo $datacourse[0]['course_title'];?>
                        </td>
                        <td class="text-center">
                            <?php echo $value['amount'];?>
                        </td>
                        <td class="text-center">
                            <?php echo count($puchselist);?>
                        </td>
                        <td class="text-center">
                            <?php echo $value['amount'] * $value['quantity'];?>
                        </td>
                        <td>
                            
                            <?php echo date("jS F, Y", strtotime($value['added'])); ?>
                           
                        </td>
                        
                        <td class="text-center">
                        <a style="color: blue;" href="javascript:void(0);" onclick="purchasedetails('<?php echo $value['added'];?>');">View Details</a>
                        </td>

                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo $ss;?></strong></td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

<?php // } ?>


    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-body detail-income-report">
            <h2 class="text-uppercase"><?php echo date('Y');?></h2>
            <h2 class="text-uppercase">MONTHLY INCOME REPORT</h2>
          

            <div class="panel-body">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>


        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    function searchdata() {

        var month = $('#month').val();
        var year = $('#year').val();
        var users = $('#users').val();
        var constval = "month=" + month + "&year=" + year + "&users="+users;
        var base_url = "<?php echo base_url()."admin/dashboard?";?>";
        var fullurl = base_url + constval;
    //alert(fullurl);
    window.location = fullurl; 

    }
</script>


<script>
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {

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

        chart.render();





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



<script type="text/javascript">
function purchasedetails(datedata){
    $("#myModalDetails").modal('show');

        $.ajax({
        type: "POST",
        url: '<?php echo base_url()."admin/purchasedetailsAdmin";?>',
        data: {datedata:datedata}
        }).done(function( result ) {
        //alert(result);
        $("#responsecontent").html( result );
        });              
        return false;   


}

</script>

<!-- Modal -->
  <div class="modal fade" id="myModalDetails" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Purchase Details</h4>
        </div>
        <div class="modal-body">
          <div id="responsecontent">  
          <p style="color: red;">Please wait...</p>
         </div>
        </div>
   
      </div>
      
    </div>
  </div>











 