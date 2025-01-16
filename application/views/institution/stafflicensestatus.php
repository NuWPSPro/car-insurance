<?php $this->load->view('institution/picture'); ?>

	   <div class="innerContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="border-title text-left"></h3> 
                </div>

                <?php $this->load->view('institution/sidebar'); ?>

                <?php 
               /* echo '<pre>';
                print_r($userdata);
                die;*/
                ?>
			
 

<?php 
  $type = $_REQUEST['type'];
    if($_REQUEST['type']==""){
        $type = "all";
    } 
?>

<script type="text/javascript">
    function showgraph(){
            $("#myModal222").modal()
    }
</script>


                 <form action="<?php echo BASE_URL;?>institution/stafflicensestatus" method="post" enctype="multipart/form-data" name="form1">
                   <div class="col-sm-9">
                <?php $this->session->flashdata('response'); ?>
                    
                    <h3 class="border-title text-left"><a href="javascript:void(0)" onclick="showgraph()">STAFF LICENSE STATUS</a> <a href="javascript:void(0)" onclick="showgraph()"> ( GRAPH VIEW ) </a></h3>

                    <a href="<?php echo BASE_URL;?>institution/stafflicensestatus?type=all">
                    <button type="button" class="<?php if($type=="all"){ echo "btn btn-primary";} else { echo "btn btn-outline-primary";} ?> mr-md-3">ALL</button>
                    </a>
                    <a href="<?php echo BASE_URL;?>institution/stafflicensestatus?type=active">
                    <button type="button" class="<?php if($type=="active"){ echo "btn btn-primary";} else { echo "btn btn-outline-primary";} ?> mr-md-3">Active(90%)</button>
                    </a>
                    <a href="<?php echo BASE_URL;?>institution/stafflicensestatus?type=expired">
                    <button type="button" class="<?php if($type=="expired"){ echo "btn btn-primary";} else { echo "btn btn-outline-primary";} ?> mr-md-3">Expired(10%)</button>
                    </a>




    <?php 

    $uid = $this->session->userdata('logged_in')['id']; 
    $userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
    $where1 = array('issuing_institution'=>$userdetails[0]['insititution_id'],'role'=>'1');
    $userdetails1 = $this->user->get_licence_status('tbl_user',$where1,$type);



     $allUser     = $this->user->get_licence_status('tbl_user',$where1,'all');
     $activeUser  = $this->user->get_licence_status('tbl_user',$where1,'active');
     $expiredUser = $this->user->get_licence_status('tbl_user',$where1,'expired');
    
     if(count($allUser) <= 0){ $allUser = 1; }

      $activePercent  = (count($activeUser)/count($allUser)) * 100;
      $expiredPercent = (count($expiredUser)/count($allUser))* 100;


    ?>
                    <div class="tab-content steps-detail mt-5"> 


                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered all" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Name</th>
                                        <th>profession</th>
                                        <th>Status</th>
                                        <th>License Number</th>
                                        <th>Validity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  foreach ($userdetails1 as $key => $value) { 
                                $yrdata= strtotime($value['licence_validity']);

                                $currentDate = date('Y-m-d');

                                ?>
                                    <tr>
                                        <td><?php echo $key+1; ?>.</td> 
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['profession']; ?></td>
                                        <?php if($value['licence_validity'] >= $currentDate){ $status='<span style="color:green;">Active</span>'; }else{ $status='<span style="color:red;">Expired<span>'; } ?>
                                        <td><?php echo $status; ?></td> 
										
									 <td><?php echo $value['licence']; ?></td>
									 <td><?php echo date('d-M-Y', $yrdata); ?></td> 

                                        <td width="200">
                                            <a class="btn btn-default" target="_blank" title="View" href="<?php echo BASE_URL;?>professional/detail/<?php echo $value['id']; ?>"><i class="fa fa-eye"></i></a> 
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>  
              </form>
            </div>
        </div>
    </div>
   







<!-- The Modal -->
<div class="modal" id="myModal222">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
        <div id="chartContainer" style="height: 400px; width: 100%;"></div> 
      </div> 
    </div>
  </div>
</div>



<script>
window.onload = function () {

var options = {
    animationEnabled: true,
    data: [{
        type: "pie",
        startAngle: 40,
        toolTipContent: "<b>{label}</b>: {y}%",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - {y}%",
        dataPoints: [
            { y: <?php echo $activePercent; ?>, label: "Active License" },
            { y: <?php echo $expiredPercent; ?>, label: "Expired License" },
        ]
    }]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
  