<?php $this->load->view('template/picture_provider'); ?>

  
      <div class="innerContent">
        <div class="container">
            <div class="row">
              <!--   <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3>
                </div> -->
                    <?php $this->load->view('provider/sidebar'); ?>
                

<div class="col-sm-8">
 <h3 class="border-title text-left"> PERFORMANCE REPORT   <!-- <a href="<?php //echo site_url('provider/set_target'); ?>" class="btn btn-danger pull-right">TARGET SETTING </a> -->  </h3>

                           <!-- <a href="<?php //echo site_url('provider/performance_report'); ?>" class="btn btn-warning pull-right">Performance Report</a> -->
                       </div>
                
                <div class="col-sm-8"> 

<?php 
$uid = $this->session->userdata('logged_in')['id'];
$userdetails = $this->user->get_record_by_field_name_all_record('tbl_training','user_id',$uid);
?>

<div class="set-trget-box">
    
<table class="table table-bordered">
  <thead class="set-target">
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Name of Courses/Training</th>
      <th scope="col">Category</th>
      <th scope="col">Total Staff to be Trained</th>
      <th scope="col">Numbers of Staff Trained</th>
      <th scope="col">Percentage</th> 
    </tr>
  </thead>
  <tbody>

<?php 
foreach ($userdetails as $key => $value) {
$uname = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['staff_name']); 

$AllStaff = $this->user->get_record_by_field_name_all_record('tbl_training_book','training_seminar_id',$value['id']); 

$where1 = array('present_status'=>1,'training_seminar_id'=>$value['id']);
$AllStaffTrained = $this->user->get_record_by_field_name_all_record11('tbl_training_book',$where1); 

$percentage = count($AllStaffTrained) * 100 / count($AllStaff);

if($percentage>0){
  $percentage = $percentage;
} else {
  $percentage = 0;
}
?>


        <tr class="table-color1">
        <td scope="row"><?php echo $key+1; ?>.</td> 
        <td><?php echo $value['title']; ?></td>
        <td>Training</td> 
        <td class="text-center"><?php echo count($AllStaff); ?></td> 
        <td class="text-center"><?php echo count($AllStaffTrained); ?></td> 
        <td class="text-center"><?php echo $percentage; ?>%</td> 
     
        </tr>

    <?php 
    }
    ?> 
  </tbody>
</table>

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


<script type="text/javascript">
    
    function setvalue(vals){
        $('#staff_id11').val(vals);
    }

</script>


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
                    <form action="<?php echo site_url('provider/settarget'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">



                        <p>
                            <label>Cource Name <span class="required"> * </span> </label>
                            <input type="text" class="form-control" name="cource_name" id="cource_name" required>
                            <span class="error"></span>
                        </p>


                        <p>
                            <label>Category <span class="required"> * </span> </label>
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                            <span class="error"></span>
                        </p>


                        <p>
                            <label>Total Staff to be Trained <span class="required"> * </span> </label>
                            <input type="number" class="form-control" name="total_staff" id="total_staff">
                            <span class="error"></span>
                        </p>
                          

                        <p>
                            <label>Target Number to be Trained <span class="required"> * </span> </label>
                            <input type="number" class="form-control" name="target_number" id="target_number">
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
                     <form action="<?php echo site_url('provider/updatesettarget'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">



                        <p>
                            <label>Cource Name <span class="required"> * </span> </label>
                            <input type="text" class="form-control" name="cource_name" id="cource_name" required>
                            <span class="error"></span>
                        </p>


                        <p>
                            <label>Category <span class="required"> * </span> </label>
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                            <span class="error"></span>
                        </p>


                        <p>
                            <label>Total Staff to be Trained <span class="required"> * </span> </label>
                            <input type="number" class="form-control" name="total_staff" id="total_staff">
                            <span class="error"></span>
                        </p>
                          

                        <p>
                            <label>Target Number to be Trained <span class="required"> * </span> </label>
                            <input type="number" class="form-control" name="target_number" id="target_number">
                            <span class="error"></span>
                        </p>

                         


                        <p class="submit alignleft">
                            <input class="btn btn-primary" value="UPDATE" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>