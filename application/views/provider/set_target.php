<?php $this->load->view('template/picture_provider'); ?>
<?php 
$uid = $this->session->userdata('logged_in')['id'];
$parentid = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['parent_insititution']; 

// echo'<pre>'; print_r($active_acc);die;

$parent_details = $this->db->get_where('tbl_user',array('id'=>$parentid))->row_array(); 

if($parent_details['under_insititution'] == '0'){
    $userdetailsa = $this->user->get_latest_training_date($parentid);
}else{
    $userdetailsa = $this->user->get_latest_training_date($parent_details['parent_insititution']);
}
$yrdata   = strtotime($userdetailsa[0]['start_date']);
$strtdate = date('M d, Y', $yrdata);
$yrdata1  = strtotime($userdetailsa[0]['end_date']);
$enddate  = date('M d, Y', $yrdata1); 

//$userdetails = $this->user->get_record_by_field_name_all_record('tbl_provider_set_target','user_id',$uid);
?>
  
	  <div class="innerContent">
        <div class="container">
            <div class="row">
              <!--   <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3>
                </div> -->
                <?php $this->load->view('provider/sidebar'); ?>

                <div class="col-sm-9">
                <h3 class="border-title text-left">SET TARGET VS. ACCOMPLISHMENT
                <?php if(!empty($userdetailsa)){ ?><a href="#" target="_blank"
                class="btn btn-danger btn-lg pull-right" data-toggle="modal"
                data-target="#Registersubinstitutions">CREATE <br>ONLINE COURSE OR TRAINING</a> <?php } ?></h3>

                <!-- <a href="<?php //echo site_url('provider/performance_report'); ?>" class="btn btn-warning pull-right">Performance Report</a> -->
                </div>
                
<div class="col-sm-9">
<?php echo $this->session->flashdata('response'); ?> 
<p style="color: red; font-size: 14px; font-weight: bold;">TRAINING PERIOD : <?php if(!empty($userdetailsa)){ echo $strtdate.'-'.$enddate; }else{ echo 'Yet to set'; } ?></p>


<div class="set-trget-box">
<div class="table-responsive">   
<table class="table table-bordered">
  <thead class="set-target">
    <tr>
      <th rowspan="2" >No.</th>
      <th rowspan="2" >Name of Courses</th>
      <th rowspan="2" >Category</th>
      <th rowspan="2" >Date of Implementation</th>
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
if(isset($active_acc) && $active_acc != ''){
$tot_staffs            = 0;
$tot_target_number     = 0;
$tot_percentage        = 0;
$count = 1;
foreach ($active_acc as $key => $value) {
  $achivement_percentage = ($value['achievements']/$value['target_number']) * 100;  
  $percentage         = ($value['target_number'] / $value['total_staff']) * 100 ;
  $tot_staffs         = $tot_staffs + $value['total_staff'];
  $tot_target_number  = $tot_target_number+$value['target_number']; 
  $tot_percentage     = $tot_percentage + $percentage; 
 ?>

 

		<tr class="table-color1">
		<td scope="row"><?php echo $count; ?>.</td> 
		<td><?php echo $value['title']; ?></td>
		<td><?php if($value['category']=='Course'){ echo'Online Course'; }else{ echo $value['category']; } ?></td> 
		<td><?php echo date('Y-m-d',strtotime($value['implementation_date'])); ?></td> 
		<td class="text-center"><?php echo $value['total_staff']; ?></td> 
		<td class="text-center"><?php echo $value['target_number']; ?></td> 
		
    <td class="text-center"><?php echo ceil($percentage); ?>%</td>  
    <td class="text-center"><?php echo $value['achievements']; ?></td> 
    <td class="text-center"><?php echo $achivement_percentage; ?>%</td> 
		<td width="200">


		<a onclick="setvalue('<?php echo $value['id'] ?>')" class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal" data-target="#Registersubinstitutions11"><i class="fa fa-pencil"></i></a> 
    <a class="btn btn-default" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/target_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a>
		</td>
		</tr>
	  <?php $count++; } ?>

    <td></td>
    <td></td>
    <td></td>
    <td style="color: red; text-align: center; font-weight: bold;">Total</td>
    <td style="color: red; text-align: center; font-weight: bold;"><?php echo $tot_staffs; ?></td>
    <td style="color: red; text-align: center; font-weight: bold;"><?php echo $tot_target_number; ?></td>
    <td style="color: red; text-align: center; font-weight: bold;"><?php echo ceil(( $tot_target_number / $tot_staffs)*100);?>%</td>
    <td></td>
    <td></td>
    <td></td>
  <?php  }else{ echo '<tr><td colspan="10" style="text-align: center; font-weight: bold;">No data Found!</td></tr>';}?>
  </tbody>
</table>

</div>                
</div>                



<h3 class="border-title text-left">Archive List</h3>

<div class="set-trget-box">
 <div class="table-responsive">   
<table class="table table-bordered">
  <thead class="set-target">
    <tr>
      <th rowspan="2" >No.</th>
      <th rowspan="2" >Name of Courses</th>
      <th rowspan="2" >Category</th>
      <th rowspan="2" >Date of Implementation</th>
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
if(isset($archive_acc) && $archive_acc != ''){
$tot_staffs1        = 0;
$tot_target_number1 = 0;
$tot_percentage1    = 0;
$num = 1;
foreach ($archive_acc as $key => $value) {
  $achivement_percentage = ($value['achievements']/$value['target_number']) * 100;  
  $percentage          = ($value['target_number'] / $value['total_staff']) * 100 ;
  $tot_staffs1         = $tot_staffs1 + $value['total_staff'];
  $tot_target_number1  = $tot_target_number1 + $value['target_number']; 
  $tot_percentage1     = $tot_percentage1 + $percentage; 
?>

 

        <tr class="table-color1">
        <td scope="row"><?php echo $num; ?>.</td> 
        <td><?php echo $titlep; ?></td>
        <td><?php if($value['category']=='Course'){ echo'Online Course'; }else{ echo $value['category']; } ?></td> 
        <td><?php echo date('Y-m-d',strtotime($value['implementation_date'])); ?></td> 
        <td class="text-center"><?php echo $value['total_staff']; ?></td> 
        <td class="text-center"><?php echo $value['target_number']; ?></td> 
        <td class="text-center"><?php echo ceil($percentages); ?>%</td> 
        <td class="text-center"><?php echo $value['achievements']; ?></td> 
        <td class="text-center"><?php echo $achivement_percentage1; ?></td> 
    
        <td width="200">        

        <!-- <a onclick="setvalue('<?php echo $value['id'] ?>')" class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal"
        data-target="#Registersubinstitutions11"><i class="fa fa-pencil"></i></a> --> 
        <a class="btn btn-default" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/target_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a>

        </td>
        </tr>
    <?php $num++; } ?>
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
</div> 



                </div>
            </div>
        </div>
    </div>


 


<?php 
    $uid = $this->session->userdata('logged_in')['id']; 
    $profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);

    $parent_insititution = $profile[0]['parent_insititution'];

    $where =array('role'=>1,'parent_insititution'=>$parent_insititution);
    $allprovider = $this->user->get_record_by_multi_field_name('tbl_user',$where); 

?>
  <!-- Modal  Register Sub institutions-->
    <div id="Registersubinstitutions" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set Target</h4>
                </div>
                <div class="modal-body promatecompany">
                    <?php echo $this->session->flashdata('response-author'); ?>    
                    <form action="<?php echo site_url('provider/settarget'); ?>" method="post" enctype="multipart/form-data"name="form1" id="form1">
                        <p>
                            <label>Category <span class="required"> * </span> </label>
                            <select class="form-control" name="category_name" id="category_name" required onchange="selectcategory()"> 
                                <option value="" selected>Choose Category</option>
                                <option value="Course">Online Course</option>
                                <option value="Training">Training</option>
                            </select>
                            <span class="error"></span>
                        </p>

                        <p id="target_course" style="display: none;">
                            <label>Course Name <span class="required"> * </span> </label>
                            <input type="text" class="form-control" name="cource_name" id="cource_name">
                            <span class="error"></span>
                         <label>(This online course will be listed under CEP if no author is selected.)</label>
                        </p>

                        <p id="authors" style="display: none;">
                            <label>Author <span class="required"> * </span> </label>
                            <select class="form-control" name="author" id="author"> 
                                <option value="" selected>Choose Author</option>
                              <?php foreach($authors as $value){ ?>
                                <option value="<?=$value['id'];?>"><?=$value['name'];?></option>
                              <?php } ?>
                            </select> 
                            <span class="error"></span>
                        </p>


                        <p id="target_training" style="display: none;">
                            <label>Training Name <span class="required"> * </span> </label>
                            <input type="text" class="form-control" name="training_name" id="training_name">
                           <!--  <select class="form-control" name="cource_name[]" id="training_name"> 
                              <option value="" selected>Choose Training</option>
                            <?php foreach($traininglist as $value){ ?>
                            <option value="<?=$value['id'];?>"><?=$value['title'];?></option>
                            <?php } ?>
                            </select> -->
                            <span class="error"></span>
                        </p>

                        <p>
                            <label>Total Staff to be Trained <span class="required"> * </span> </label>
                            <input type="number" class="form-control" name="total_staff" id="total_staff" min="1" required>
                            <span class="error"></span>
                        </p>

                        <p>
                            <label>Target Number to be Trained <span class="required"> * </span> </label>
                            <input type="number" class="form-control" name="target_number" id="target_number" min="1" required>
                            <span class="error"></span>
                        </p>

                        <p>
                            <label>Date of Implementation<span class="required"> * </span> </label>
                            <input type="date" class="form-control" name="implementation_date" id="implementation_date" required>
                            <span class="error"></span>
                        </p>

                        <p class="submit alignleft">
                            <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>



  <!-- Modal  Register Sub institutions-->
    <div id="Registersubinstitutions11" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Set Target</h4>
                </div>
                <div class="modal-body promatecompany">
                     <form action="<?php echo site_url('provider/updatesettarget'); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <span id="contentreplace">Please wait...</span>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="target_set_success" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h4 class="modal-title">Update Set Target</h4> -->
                  <h4 class="modal-title text-center" style="color: red; font-weight: bold;font-family: cursive; font-size: 31px;"><a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/congratulations.png'; ?>" alt="congratulations"><span><i>!</i></span></a></h4>
                </div>
                <div class="modal-body promatecompany">
                  <?php echo $this->session->flashdata('response'); 
                  $target = $this->db->order_by('id','desc')->get_where('tbl_provider_set_target',array('user_id'=>$uid))->row_array(); 
                  if($target['category']=="Course"){
                      $name = $this->db->get_where('tbl_course',array('id'=>$target['cource_name']))->row_array()['course_title']; 
                  }else{
                      $name = $this->db->get_where('tbl_training',array('id'=>$target['cource_name']))->row_array()['title']; 
                  } ?>


                  <div class="row">
                     <div class="col-sm-6 text-right"><label>CE Course Title : </label></div>
                     <div class="col-sm-6 text-left"><label><?php echo $name; ?></label></div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 text-right"><label>Category : </label></div>
                     <div class="col-sm-6 text-left"><label><?php if($target['category']=='Course'){ echo 'Online Course'; }else{ echo $target['category']; } ?></label></div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 text-right"><label>Total number of Staff : </label></div>
                     <div class="col-sm-6 text-left"><label><?php echo $target['total_staff']; ?></label></div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 text-right"><label>Target number of staff to be trained : </label></div>
                     <div class="col-sm-6 text-left"><label><?php echo $target['target_number']; ?></label></div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 text-right"><label>Date of Implementaion  : </label></div>
                     <div class="col-sm-6 text-left"><label><?php echo date('Y-m-d',strtotime($target['implementation_date'])); ?></label></div>
                  </div>
                  <div class="row text-center">
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="set_new_target()">Set Another Target</a>   
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">  
                  </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
    $(document).ready(function() {
        var pop2 = '<?php if($_REQUEST['id']=="done"){ ?>' + $("#Registersubinstitutions").modal('hide'); $("#target_set_success").modal('show'); + '<?php } ?>';
    });
    function set_new_target(){
      $("#target_set_success").modal('hide');
      $("#Registersubinstitutions").modal('show'); 
    }
    function setvalue(vals){
    $.ajax({
    type: "POST",
    url: '<?php echo site_url('provider/setformdata'); ?>',
    data: {vals:vals}
    }).done(function( result ) {
    // alert(result);
    $("#contentreplace").html( result );
    });
    return false;  
    }

    function selectcategory(){
      var category = $('#category_name').val();
       // alert(category);
        if(category=='Course'){
          $('#target_course').show();
          $('#target_training').hide();
          $('#authors').show();
          $("#cource_name").val('').attr("required", true);
           $("#training_name").val('').attr("required", false);
        }else if(category=='Training'){
          $('#target_training').show();
          $('#target_course').hide();
          $('#authors').hide();
          $("#cource_name").val('').attr("required", false);
          $("#training_name").val('').attr("required", true);
        }else{
          $('#target_training').hide();
          $('#target_course').hide();
          $('#authors').hide();
          $("#cource_name").val('').attr("required", false);
          $("#training_name").val('').attr("required", false);
        }

    }
</script>







