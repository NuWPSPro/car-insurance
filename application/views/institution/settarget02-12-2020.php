<?php $this->load->view('institution/picture'); ?>
<?php 
        $uid = $this->session->userdata('logged_in')['id'];
        $training_date = $this->user->get_latest_training_date($uid);
        
        $yrdata= strtotime($training_date[0]['start_date']);
        $strtdate =  date('M d, Y', $yrdata);

        $yrdata1= strtotime($training_date[0]['end_date']);
        $enddate =  date('M d, Y', $yrdata1); ?>

<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div>
            <?php $this->load->view('institution/sidebar'); ?>
            
            <div class="col-sm-9">
                <h3 class="border-title text-left">SET TARGET VS. ACCOMPLISHMENT
                <a onclick="setmaintarget()" class="btn btn-primary pull-right">SET TRAINING PERIOD</a></h3>
                <p style="color: red; font-size: 14px; font-weight: bold;">
                   SET TRAINING PERIOD : <?php if(!empty($training_date)){ echo $strtdate.'-'.$enddate; }else{ echo 'Yet to set'; } ?></p>
                
            <!-- </div> -->
           <!--  <div class="col-sm-9">
            <form action="<?php echo BASE_URL.'institution/settarget';?>" method="post" enctype="multipart/form-data"
                name="form1"> -->
                <?php echo $this->session->flashdata('response'); ?>
                    <?php  $userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
                    $where1 = array('parent_insititution'=>$userdetails[0]['id'],'role'=>2);
                    $userdetails1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
                    ?>
                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                <thead class="set-target">

                                    <tr>
                                        <th rowspan="2" >No.</th>
                                        <th rowspan="2">Name Of Courses</th>
                                        <th rowspan="2">Category</th>
                                        <th rowspan="2">Date of implementation</th>
                                        <th rowspan="2">CE Provider</th>
                                        <th rowspan="2">Author / Presenter</th>
                                        <th rowspan="2">Total Staff to be Trained</th>

                                        <th colspan="2">Targets</th>
                                        <th colspan="2">Accomplishment</th>

                                        <th rowspan="2">Action</th>
                                    </tr>
                                    <tr>
                                        
                                        <th>Number</th>
                                        <th>%</th>
                                        <th>Number</th>
                                        <th>%</th>
                                       
                                    </tr>


                                </thead>
                                <tbody>
                                    <?php $count=1;
                                        foreach ($set_target as $key => $value) { 
                                        $achievements = $this->db->get_where('tbl_purchase_llis',array('item_name'=>(int)$value['cource_name']))->result_array();
                                        $coursename = $this->db->get_where('tbl_course',array('id'=>$value['cource_name']))->row_array(); 
                                        $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['name'];      
                                        $percentage = ($value['target_number']*100)/$value['total_staff']; 
                                        $achievement_percentage = (count($achievements)*100)/count($value['target_number']); 
                                        $staff_sum += $value['total_staff'];
                                        $target_sum += $value['target_number'];
                                        $total_persentage = ($target_sum*100)/$staff_sum ;

                                        $acc_sum += count($achievements);
                                        $total_acc_persentage = ($acc_sum/$target_sum)*100;

                                        ?>
                                    <tr>
                                        <td><?php echo $count; ?>.</td>
                                        <td><?php echo $coursename['course_title']; ?></td>
                                        <td><?php echo $value['category']; ?></td>
                                        <td><?php echo $value['implementation_date']; ?></td>
                                        <td><?php echo $providername; ?></td>
                                        <td><?php 
                                        if($value['category']=='Course'){ 
                                            if($coursename['author_reference_id'] != ''){ 
                                                    echo 'Author';
                                                }else{
                                                    echo 'Presenter';  
                                                }
                                            }else{ echo '--'; } ?></td>
                                        <td><?php echo $value['total_staff']; ?></td>
                                        <td><?php echo $value['target_number']; ?></td>


                                        <td><?php echo ceil($percentage); ?>%</td>
                                        <!-- <td><?php echo 'sub_institution'; ?></td> -->
                                        <td><?php echo count($achievements); ?></td>
                                        <td><?php echo $achievement_percentage; ?> %</td>
                                        <td>
                                        <a onclick="setvalue('<?php echo $value['id'] ?>')" class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal" data-target="#Registersubinstitutions11"><i class="fa fa-pencil"></i></a> 
                                        <a class="btn btn-default" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/target_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $count++; } ?>
                                    <tr>
                                        <th colspan="5"></th>
                                        <th>Total</th>
                                        <th><?php echo $staff_sum; ?></th>
                                        <th><?php echo $target_sum; ?></th>
                                        <th><?php echo ceil($total_persentage); ?>%</th>
                                        <th><?php echo $acc_sum; ?></th>
                                        <th><?php echo ceil($total_acc_persentage); ?>%</th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            <!-- </form> -->
          <!--       </div>

<div class="col-sm-9"> -->
<h3 class="border-title text-left">Archive List</h3>

<!-- <div class="set-trget-box"> -->
 <div class="table-responsive">   
<table class="table table-bordered">
  <thead class="set-target">
    <tr>
      <th rowspan="2" >No.</th>
      <th rowspan="2" >Name of Courses</th>
      <th rowspan="2" >Category</th>
      <th rowspan="2" >Date of Implementation</th>
      <th rowspan="2">CE Provider</th>
      <th rowspan="2">Author / Presenter</th>
      <th rowspan="2" >Total Staff to be Trained</th>
      <th colspan="2" >Target Numbers to be Trained</th>
      <!-- <th rowspan="2" >Percentage</th> -->

      <th colspan="2" >Accomplishment</th>
      <!-- <th colspan="2" >Accomplishment In %</th> -->

      <th rowspan="2" >Action</th>
    </tr>

    <tr>
      <th>Number</th>
      <th>%</th>
      <th>Number</th>
      <th>%</th>
    </tr>
  </thead>
  <tbody>

<?php 

$where1 = array('user_id'=>$uid,'status'=>2);
$userdetails2 = $this->user->get_record_by_field_name_all_record11('tbl_provider_set_target',$where1);
$tot_staffs1 = 0;
$tot_target_number = 0;
$tot_percentage1 = 0;
$count1 = count($userdetails2);
if(!empty($userdetails2)){
foreach ($userdetails2 as $key => $value) {
 $achievements = $this->db->get_where('tbl_purchase_llis',array('item_name'=>(int)$value['cource_name']))->result_array();
$coursename = $this->db->get_where('tbl_course',array('id'=>$value['cource_name']))->row_array(); 
$providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['name'];      
$percentage = ($value['target_number']*100)/$value['total_staff']; 
$achievement_percentage = (count($achievements)*100)/count($value['target_number']); 
$staff_sum += $value['total_staff'];
$target_sum += $value['target_number'];
$total_persentage = ($target_sum*100)/$staff_sum ;

$acc_sum += count($achievements);
$total_acc_persentage = ($acc_sum/$target_sum)*100;
?>

 

        <tr class="table-color1">
        <td><?php echo $count1; ?>.</td>
        <td><?php echo $coursename['course_title']; ?></td>
        <td><?php echo $value['category']; ?></td>
        <td><?php echo $value['implementation_date']; ?></td>
        <td><?php echo $providername; ?></td>
        <td><?php 
        if($value['category']=='Course'){ 
            if($coursename['author_reference_id'] != ''){ 
                    echo 'Author';
                }else{
                    echo 'Presenter';  
                }
            }else{ echo '--'; } ?></td>
        <td><?php echo $value['total_staff']; ?></td>
        <td><?php echo $value['target_number']; ?></td>


        <td><?php echo ceil($percentage); ?>%</td>
        <!-- <td><?php echo 'sub_institution'; ?></td> -->
        <td><?php echo count($achievements); ?></td>
        <td><?php echo $achievement_percentage; ?> %</td>
        <td>
        <a onclick="setvalue('<?php echo $value['id'] ?>')" class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal" data-target="#Registersubinstitutions11"><i class="fa fa-pencil"></i></a> 
        <a class="btn btn-default" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/target_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a></td>
        </tr>
    <?php } ?>
    <td></td>
    <td></td>
    <td style="color: red; text-align: center; font-weight: bold;">Total</td>
    <td></td>
    <td style="color: red; text-align: center; font-weight: bold;"><?php echo $tot_staffs1; ?></td>
    <td style="color: red; text-align: center; font-weight: bold;"><?php echo $tot_target_number1; ?></td>
    <td style="color: red; text-align: center; font-weight: bold;"><?php echo ceil(($tot_target_number1 / $tot_staffs1)*100);?>%</td>
    <td></td>
    <td></td>
  <?php  }else{ echo '<tr><td colspan="10" style="text-align: center; font-weight: bold;">No data Found!</td></tr>';}?>
   
  </tbody>
</table>

</div> 
<!-- </div>  -->
</div> 
        </div>
    </div>
</div>


    <!-- Modal  Register Sub institutions-->
    <div id="set_target_first" class="modal fade" role="dialog" style="margin-top: 200px;" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    <?php if($_REQUEST['id']=="success"){ ?><p class="alert alert-success">Mail sent to CEP.</p><?php } ?>
                    <h4 class="modal-title">Please set your Training Period.</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo site_url('institution/settargetdate'); ?>" method="post" enctype="multipart/form-data" name="settargetdateform1" id="settargetdateform1">
                        <p>
                            <label>Starting Date <span class="required"> * </span> </label>
                            <input type="text" class="form-control datepicker" name="start_date" id="start_date" required >
                            <span class="error"></span>
                        </p>

                        <p>
                            <label>Ending Date <span class="required"> * </span> </label>
                            <input type="text" class="form-control datepicker" name="end_date" id="end_date" required >
                            <span class="error"></span>
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-primary mt-5" value="SAVE" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  Register Sub institutions-->
    <div id="set_target" class="modal fade" role="dialog" style="margin-top: 200px;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <?php if($_REQUEST['id']=="success"){ ?><p class="alert alert-success">Mail sent to CEP.</p><?php } ?>
                    <h4 class="modal-title">Please set your Training Period.</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo site_url('institution/settargetdate'); ?>" method="post" enctype="multipart/form-data"
                        name="form1settargetdate" id="form1settargetdate">
                        <p>
                            <label>Starting Date <span class="required"> * </span> </label>
                            <input type="text" class="form-control datepicker" name="start_date" id="start_date" required >
                            <span class="error"></span>
                        </p>

                        <p>
                            <label>Ending Date <span class="required"> * </span> </label>
                            <input type="text" class="form-control datepicker" name="end_date" id="end_date" required >
                            <span class="error"></span>
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-primary mt-5" value="SAVE" type="submit" name="save">
                        </p>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  edit_webpage_btn -->
    <div id="edit_webpage_btn" class="modal fade" role="dialog" style="margin-top: 200px;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">SUCCESS</h4>
                </div>
                <div class="modal-body text-center">
                    <p><b><?php echo$this->session->flashdata('response-set'); ?></b></p>
                    <h4><b>Please edit your "Institution CE Webpage".</b></h4>
                    <a href="<?php echo base_url('institution/editwebpage?id=focus');?>" class="btn btn-default">Edit Webpage</a>
                    <!-- <input type="button" onclick="focus();" value="test focus" /> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">
     $(document).ready(function() {
     	// $('#myTable').DataTable( {
        // "processing": true,
        // "serverSide": true,
        // "ajax": "../server_side/scripts/server_processing.php"
	    // } );
        var x ='<?php if($_REQUEST['id']=="success"){ ?>'+  $("#set_target_first").modal("show") + '<?php } ?>';       
        var y ='<?php if($_REQUEST['id']=="target"){ ?>'+  $("#edit_webpage_btn").modal("show") + '<?php } ?>';    
        });
    function setmaintarget(){
        // alert('ok');
        $("#set_target").modal("show");
    }  
</script>