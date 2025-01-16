<?php $this->load->view('template/picture_provider'); ?>
	  <div class="innerContent">
        <div class="container">
            <div class="row">
             <!--    <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3>
                </div> -->
                    <?php $this->load->view('provider/sidebar'); ?>

                <div class="col-sm-9">
                    <div class="clearfix">
                        <h3 class="border-title pull-left">Staff CE Record (<?php echo count($staff_list); ?>) </h3>   
                        <a href="#" target="_blank" class="btn btn-warning pull-right" data-toggle="modal" data-target="#Registersubinstitutions">Register Staff</a>
                        <a href="<?php echo base_url('provider/staffpayment'); ?>" class="btn btn-primary pull-right mr-3">Activate Staff</a> 
                    </div>
                    
                    <!-- <button type="button" class="btn btn-primary" >ALL</button> -->
                    <?php echo $this->session->flashdata('response'); ?>

                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="example-staff" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Staff name</th>
                                        <th>email</th>
                                        <th>Code</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Connectivity </th> 
                                        <th>Activation</th> 
                                        <th>Access</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $count = 1;
                                	foreach ($staff_list as $key => $value) {
                                    $this->db->where_in('prof_id',$value['prof_id']);
                                    $query = $this->db->get('tbl_institution_staff_payment');
                                    $payment = $query->row_array();

                                    if($value['status']=='1' && $value['prof_id']!='0'){ 
                                        $connectstatus ='<span style="color:green;">Connected</span>'; 
                                    }else{ 
                                        $connectstatus ='<span style="color:orange;">Pending</span>'; 
                                    }
                                     if($value['status']=='1' && $value['activated']=='1'){ 
                                            $status ='<span style="color:red;">Activated</span>'; 
                                        }else{ 
                                            $status ='<span style="color:orange;">Pending</span>'; 
                                        }
                                    
                                    if($value['status']=='1' && $value['activated']=='1'){ 
                                        $activated ='<span style="color:green;">Enabled</span>'; 
                                    }elseif($value['status']=='1' && $value['activated']=='0' && $payment == ''){ 
                                        $activated ='<span style="color:orange;">Pending</span>'; 
                                    }elseif($value['status']=='0' && $value['activated']=='0'){ 
                                        $activated ='<span style="color:orange;">Disabled</span>'; 
                                    }else {
                                        // $activated ='<span style="color:red;">Disabled</span>'; 
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?>.</td> 
                                        <td><?php echo $value['staff_name']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <!-- <td><?php //echo base64_decode($value['staff_code']); ?></td> -->
                                        <td><?php echo $value['staff_code']; ?></td>
                                        <td><?php echo $value['startdate']; ?></td>
                                        <td><?php echo $value['enddate']; ?></td>
                                        <td><?php echo $connectstatus; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $activated; ?></td>

                                <td width="200">
                                <?php if($value['status']=='1' && $value['activated']=='1'){  ?>
                                    <a class="btn btn-default" title="View" href="<?php echo site_url('provider/staff_view/').$value['pid']; ?>" target="_blank"><i class="fa fa-eye"></i></a>
                                <?php } else { ?>
                                    <a class="btn btn-default" title="View" href="javascript:void(0);" data-toggle="modal" data-target="#activateTheStaff"><i class="fa fa-eye"></i></a>
                                <?php } ?>
                                    <a onclick="edit_staff('<?php echo $value['id'] ?>')" class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal"
                                data-target="#Registersubinstitutions11"><i class="fa fa-pencil"></i></a>
                                <?php if($value['status']=='1' && $value['activated']=='1'){  }else{?>
                                    <a class="btn btn-default" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/staff_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a>
                                <?php } ?>
                                </td>
                                    </tr>
                                <?php $count++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    
                    
                    <h3 class="border-title text-left mt-5">Staff Required Unit <a href="javascript:void(0);"
                            class="btn btn-primary pull-right mr-3" data-toggle="modal"
                            data-target="#setStaffRequired">Set Staff Required Unit</a>
                            </h3>
                    <?php echo $this->session->flashdata('staff-response'); ?>

                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="staff-list" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Profession</th>
                                        <th>Required</th>
                                        <th>Specific</th>
                                        <th>General</th> 
                                        <th>Action</th>
                                        <!-- <th>Start</th> -->
                                        <!-- <th>End</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; 
                                foreach($unit_staff as $key => $value){ ?>	
                                    <tr>
                                        <td><?=$count;?></td> 
                                        <td><?=$value['profession_name'];?></td>
                                        <td><?=$value['unit'];?></td>
                                        <td><?=$value['specific_target'];?></td>
                                        <td><?=$value['gernal_target'];?></td>
                                        <!-- <td>6/12/2020</td>
                                        <td>6/12/2020</td> -->
                                        <td>
                               <!--  <a class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal"
                                data-target="#setStaffRequired"><i class="fa fa-pencil"></i></a> -->
                                <a onclick="edit_staff_unit('<?php echo $value['id'] ?>')" class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal"
                                data-target="#editStaffRequired"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                <?php $count++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


  <!-- Modal  Register Sub institutions-->
    <div id="Registersubinstitutions" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Register Staff</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo site_url('provider/registerstaff'); ?>" method="post" enctype="multipart/form-data"
                        name="registerstaffform1" id="registerstaffform1">
                        <p>
                            <label>Staff Name<span class="required"> * </span> </label>
                            <input type="text" name="name" id="staff_name" class="form-control" required>
                            <!-- select class="form-control" name="name">
                                    <option value="" selected>Please Select</option>
                                    <?php foreach ($allprovider as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php  } ?></select> --> 
                            <span class="error"></span>
                        </p>

                        <p>
                            <label>Email<span class="required"> * </span></label>
                            <input type="email" name="email" class="form-control" required="">
                        </p>

                        <p>
                            <label>Staff Code<span class="required"> * </span> </label>
                            <input type="text" name="code" id="staff_code" class="form-control" value="<?php echo rand(99,9999); ?>" readonly>
                        </p>
                        <p>
                            <label>Start Date<span class="required"> * </span> </label>
                            <input type="date" name="startdate" id="startdate" class="form-control" required="">
                        </p>
                        <p>
                            <label>End Date<span class="required"> * </span> </label>
                            <input type="date" name="enddate" id="enddate" class="form-control" required="">
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
    <div id="edit_staff_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Staff</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo site_url('provider/updatestaff'); ?>" method="post" enctype="multipart/form-data"
                        name="updatestaffform1" id="updatestaffform1">
                        <p>
                            <label>Staff Name<span class="required"> * </span> </label>
                            <input type="text" name="name" id="ename" class="form-control" required>
                            <input type="hidden" name="id" id="id" >
                            <!--  <select class="form-control" name="name">
                                <option value="" selected>Please Select</option>
                                <?php foreach ($allprovider as $key => $value) { ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                <?php } ?>
                            </select> --> 
                            <span class="error"></span>
                        </p>
                        <p>
                            <label>Email<span class="required"> * </span></label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </p>
                        <p>
                            <label>Start Date<span class="required"> * </span> </label>
                            <input type="date" name="startdate" id="estartdate" class="form-control" value="">
                        </p>
                        <p>
                            <label>End Date<span class="required"> * </span> </label>
                            <input type="date" name="enddate" id="eenddate" class="form-control" value="">
                        </p>
                        <p>
                            <label>Status</label>
                            <select name="status" id="estatus" class="form-control">
                                <option value="1" >Active</option>
                                <option value="2" >Inctive</option>
                                <option value="0" >Disabled</option>
                            </select>
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-primary" value="UPDATE" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <!-- Set Staff Required Unit -->
    <div id="setStaffRequired" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <center><div class="site-logo__link" style="width:34%; ">
                    <a href="<?php echo base_url();?>"><img src="<?php echo ASSETS_URL.'images/logo.png';?>"
                            alt="logo"></a>
                </div></center>
            </div>
    <div class="modal-body">
        <h3 class="text-center"><strong>Required CE Units/Contact Hours:</strong></h3>
        
        <form action="<?php echo base_url('provider/unit_staff');?>" method="post" enctype="multipart/form-data" name="unitStaffForm" id="unitStaffForm">
            <div class="professionals-banner">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-6 col-form-label">1. Choose Profession:</label>
                    <div class="col-sm-6">
                        <select name="profession_id" class="form-control" id="profession_id">
                        <?php foreach($profession as $key => $value){ ?>
                            <option value="<?php echo $value['id'].'-'.$value['cat_name'];?>"><?php echo $value['cat_name'];?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                            
                <div class="row banner-count-desc">
                    
                <label for="staticEmail" class="col-sm-6 col-form-label">2. Set Required Units:</label>
                    <div class="col-xs-6 col-md-12 text-center item">
                        <div class="icon-container" style="background:#275bf4">
                            <input type="text" name="units" id="units" value="" required=""><span>Units</span>
                        </div>
                        <h2>Enter Total Required CE Units</h2>
                    </div>

                    <div class="col-xs-6 col-md-6 text-center item">
                        <div class="icon-container" style="background:#275bf4">
                            <input type="text" name="specific_target" id="specific_target" value=""><span>Units</span>
                        </div>
                        <h2>Enter Specific Required CE Units</h2>
                    </div>
                    <div class="col-xs-6 col-md-6 text-center item">
                        <div class="icon-container" style="background:#275bf4">
                            <input type="text" name="gernal_target" id="gernal_target" value=""><span>Units</span>
                            </div>
                        <h2>Enter General Required CE Units</h2>
                    </div>
                </div>
            </div>
            <p class="text-center">
                <input type="submit" name="savecat" value="SAVE" class="btn btn-primary" style="min-width: 100px;">
            </p>
        </div>
            </form>
        </div>
    </div>
    </div>
</div>

    <!-- Edit Staff Required Unit -->
    <div id="editStaffRequired" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <center><div class="site-logo__link" style="width:34%; ">
                    <a href="<?php echo base_url();?>"><img src="<?php echo ASSETS_URL.'images/logo.png';?>"
                            alt="logo"></a>
                </div></center>
            </div>
    <div class="modal-body">
        <form action="<?php echo base_url('provider/edit_unit_staff');?>" method="post" enctype="multipart/form-data"
            name="edit_unit_staffform1" id="edit_unit_staffform1">

            <h3 class="text-center"><strong>Edit Required CE Units/Contact Hours:</strong></h3>
            <div class="col-md-6">
                <label>Profession: </label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="profession_name" id="eprofession_name" value="" readonly>
                <input type="hidden" name="id" id="eid" value="">
            </div>
            <div class="professionals-banner">
                <div class="row banner-count-desc">
                    <div class="col-xs-6 col-md-12 text-center item">
                        <div class="icon-container" style="background:#275bf4">
                            <input type="text" name="units" id="eunits" value="" required=""><span>Units</span>
                        </div>
                        <h2>Enter Total Required CE Units</h2>
                    </div>

                    <div class="col-xs-6 col-md-6 text-center item">
                        <div class="icon-container" style="background:#275bf4">
                            <input type="text" name="specific_target" id="especific_target" value=""><span>Units</span>
                        </div>
                        <h2>Enter Specific Required CE Units</h2>
                    </div>
                    <div class="col-xs-6 col-md-6 text-center item">
                        <div class="icon-container" style="background:#275bf4">
                            <input type="text" name="gernal_target" id="egernal_target" value=""><span>Units</span>
                            </div>
                        <h2>Enter General Required CE Units</h2>
                    </div>
                </div>
            </div>
                <p class="text-center">
                    <input type="submit" name="savecat" value="Update" class="btn btn-primary" style="min-width: 100px;">
                </p>
            </form>
        </div>
    </div>
    </div>
</div>

<div id="activateTheStaff" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h6 class="m-0">Activate the staff</h6>
            </div>
            <div class="modal-body">
                <!-- <p>Please activate this staff first to view the account details.</p> -->    
                <p>The Staff is already connected but not yet activated.</p>
                <p>Please wait for activation to open the staff CE record</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?php echo base_url('provider/staffpayment'); ?>" class="btn btn-primary">Activate the staff</a>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            $('#staff-list,#example-staff').DataTable();
        });
        function edit_staff(id){
            $.ajax({
                  type: "POST",
                  url: '<?php echo base_url("provider/getstaff");?>',
                  data: { id : id},
                  success: function(result){
                    obj = jQuery.parseJSON(result);
                      $('#edit_staff_modal').modal('show');
                      $('#ename').val(obj.staff_name);
                      $('#id').val(obj.id);
                      $('#email').val(obj.email);
                      $('#estartdate').val(obj.startdate);
                      $('#eenddate').val(obj.enddate);
                      $('#estatus').val(obj.status);
                  }
                });
        }
        function edit_staff_unit(id){
            $.ajax({
                  type: "POST",
                  url: '<?php echo base_url("provider/getstaffunit");?>',
                  data: { id : id},
                  success: function(result){
                    obj = jQuery.parseJSON(result);
                      $('#editStaffRequired').modal('show');
                      $('#eid').val(obj.id);
                      $('#eprofession_name').val(obj.profession_name);
                      $('#eunits').val(obj.unit);
                      $('#egernal_target').val(obj.gernal_target);
                      $('#especific_target').val(obj.specific_target);
                  }
                });
        }
    </script>

