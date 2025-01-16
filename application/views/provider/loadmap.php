  <?php 
  for ($i=1; $i <= 31; $i++) { 
    $array[] =  array("label"=> $i, "y"=> $i);
  }
  $dataPoints1 = $array;
  ?>



<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


<br>
<br>

<div class="col-sm-12 form-group">

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>

                <th>S.NO</th>
                <th>Course Title</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Amount</th> 
            </tr>
        </thead>
        <tbody>
           

            <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
            </tr>
      
          </tbody>
        </table>

</div>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "MONTHLY INCOME REPORT"
  },
  legend:{
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
 
function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chart.render();
}
 
}
</script>