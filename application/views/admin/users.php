    <?php $this->load->view('admin/picture'); ?>
    <div class="innerContent admin-userspanel">
        <div class="container">
            <div class="row">

                <?php   $this->load->view('admin/sidebar');
                    $this->load->view('admin/users_work'); ?>	

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>User Type</th>
                                <th>Profession</th>
                                <th>Country</th>
                                <!-- <th>Address</th> -->
                                <th>Email</th>
                                <th>Date Registered</th>
                                <th>Status</th>
                                <th>Access</th>
                                <th>Reset Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1;
                            foreach ($users as $key => $value) {  

                                if($value['role']==1){ $type = "Professional"; }
                                if($value['role']==2){ $type = "CPD Provider"; }
                                if($value['role']==3){ $type = "Placement Agencies"; }
                                if($value['role']==4){ $type = "Advertisers"; }
                                if($value['role']==5){ $type = "Insititution"; }
                                if($value['role']==6){ $type = "Authors"; }
                                if($value['role']==7){ $type = "RBoard"; }
                                if($value['role']==10){ $type = "Admin"; }

                                if($value['status']==1 && $value['disabled_by']==0){ 
                                    $status = '<span style="color:green;">Active</span>'; 
                                    $access = '<span style="color:green;">Enable</span>'; 
                                }elseif($value['status']==0 && $value['disabled_by'] > 0){ 
                                    $status = '<span style="color:red;">Inactive<span>'; 
                                    $access = '<span style="color:red;">Disable<span>'; 
                                }else{ 
                                    $status = '<span style="color:red;">Pending<span>'; 
                                    $access = '<span style="color:red;">Inactive<span>'; 
                                } 
                            ?>
                            <tr>
                                <td><?php echo $count;?></td> 
                                <td><?php echo $value['name'];?></td> 
                                <td><?php echo $type;?></td> 
                                <td><?php echo $value['profession'];?></td>
                                <td><?php echo $value['countries_name'];?></td> 
                                <!-- <td><?php echo $value['address'];?></td>  -->
                                <td><?php echo $value['username_email'];?></td>  
                                <td><?php echo $value['added_on'];?></td>  
                                <!-- <td><a href="<?php echo BASE_URL.'admin/change_user_status/'.$value['id'].'/'.$value['status'].''?>" style="color: <?php echo $color; ?>"><?php echo $stts;?></a></td>  --> 
                                <td><?php echo $status; ?></td>
                                <td><?php echo $access; ?></td>
                                <td>
                                    <a class="btn btn-success changePassword" title="Edit" href="javascript:void(0)" data-id="<?=$value['id']; ?>" data-name="<?=$value['name']; ?>" data-value="<?=$value['username_email']; ?>">Reset Password</a>
                                </td>
                                <td><?php if($value['role']==2){ ?>
                                    <a target="_blank" href="<?php echo BASE_URL.'share/viewprofile/'.$value['id']; ?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>
                                    <?php }else{ ?>
                                    <!-- <a target="_blank" href="<?php echo BASE_URL.'pages/Institutionspage'?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a> -->
                                    <a target="_blank" href="<?php echo BASE_URL.'web/'.$value['insititution_id']; ?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>
                                    <?php } ?>
                                    <a class="btn btn-danger deleteUser" title="Delete" href="javascript:void(0)" data-id="<?=$value['id']; ?>" data-name="<?=$value['name']; ?>" data-value="<?=$value['username_email']; ?>"><i class="fa fa-trash"></i></a>
                                </td>  
                            </tr>
                            <?php $count++; } ?>
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

<!-- </div> -->


    <!-- Modal  Register Sub institutions-->
    <div id="reset" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reset Password</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/resetpassword'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>User Name</label>
                            <input type="text" name="name" id="pname" class="form-control" readonly="">
                            <input type="hidden" name="id" id="pid">
                        </p>
                        <p>
                            <label>User email</label>
                            <input type="text" name="email" id="pemail" class="form-control" value="" readonly="">
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-success" value="Genrate Password" type="submit" name="genratepassword">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Soft Delete Users -->
    <div id="softDelete" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete User</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/softDelete'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>User Name : <strong id="dname"></strong></label>
                            <input type="hidden" name="id" id="did">
                        </p>
                        <p>
                            <label>User email : <strong id="demail"></strong></label>
                        </p>

                        <p>
                            <i>Are you sure to delete this user? Click SUBMIT to delete this.</i>
                        </p>
                        <p class="submit text-center">
                            <input class="btn btn-danger" value="Delete" type="submit" name="submit">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
    
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    $('.changePassword').on('click',function(){
        var id= $(this).attr("data-id");
        var pname= $(this).attr("data-name");
        var email= $(this).attr("data-value");
        $('#reset').modal('show');
        $('#pname').val(pname);
        $('#pemail').val(email);
        $('#pid').val(id);
    });

    $('.deleteUser').on('click',function(){
        var id= $(this).attr("data-id");
        var pname= $(this).attr("data-name");
        var email= $(this).attr("data-value");
        $('#dname').html(pname);
        $('#demail').html(email);
        $('#did').val(id);
        $('#softDelete').modal('show');
    });



</script>
