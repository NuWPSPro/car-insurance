<?php $this->load->view('institution/picture'); ?>

  
	  <div class="innerContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3>
                </div>
                    <?php $this->load->view('institution/sidebar'); ?>
                
                <div class="col-sm-9">
                    <h3 class="border-title text-left">Sub institutions (<?=count($subinss);?>)</h3>
                    <form action="<?=base_url('institution/subinsititution');?>" method="get">
                        <div class="row pt-1">
                            <div class="form-group col-md-4">
                                <select name="subins" class="form-control" onchange="this.form.submit();">
                                    <option value="">Select Sub Institution</option>
                                    <?php if(isset($sub_ins) && $sub_ins!=''){ 
                                            foreach($sub_ins as $value){ ?>
                                    <option value="<?=$value['cid']; ?>"><?=$value['cname']; ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
						
                            <div class="form-group col-md-3">
                                <input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
                            </div>
                        </div>
                    </form>
                    <?php echo $this->session->flashdata('response'); ?>

                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>User</th> -->
                                        <th>Name</th>
                                        <th>Date Registered</th>
                                        <th>Username</th>
                                        <th>CEPs</th>
                                        <th>Authors</th>
                                        <th>Staff</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	foreach ($subinss as $key => $value) {
                                	   if($value['status']==1){
                                        $stts = '<span style="color:green;">Approve</span>';
                                       } else {
                                        $stts = '<span style="color:red;">Pending</span>';
                                       }

                                       $user_id = $value['id'];

                                    $where1 = array('role'=>5,'parent_insititution'=>$user_id);
                                    $subinstitution1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
                                    $totalSubInstitute = sprintf("%02d", count($subinstitution1));


                                    $where2 = array('role'=>2,'parent_insititution'=>$user_id);
                                    $ceproviderlist = $this->user->get_record_by_multi_field_name('tbl_user',$where2);
                                    $totalCeProvider = sprintf("%02d", count($ceproviderlist));

                                    $where3 = array('role'=>5,'parent_insititution'=>$user_id);
                                    $authorlist = $this->user->get_record_by_multi_field_name('tbl_user',$where3);
                                    $totalAuthor = sprintf("%02d", count($authorlist));


                                    $where4 = array('insititution_id'=>$user_id);
                                    $stafflist = $this->user->get_record_by_multi_field_name('tbl_institution_staff',$where4);
                                    $totalStaff = sprintf("%02d", count($stafflist));


                                    


                                    if($totalCeProvider=="00"){
                                        $totalCeProvider = 0;
                                    }

                                    if($totalAuthor=="00"){
                                        $totalAuthor = 0;
                                    }
                                    
                                    if($totalStaff=="00"){
                                        $totalStaff = 0;
                                    }
                                    


                                	?>
                                    <tr>
                                        <td> <?php echo $key+1; ?>.</td> 
                                        <td> <?php echo $value['name']; ?> </td> 
                                        <td> <?php echo $value['added_on']; ?> </td> 
										 <td> <?php echo $value['username_email']; ?> </td>
                                        <td> <?php echo $totalCeProvider; ?> </td> 
                                        <td> <?php echo $totalAuthor; ?> </td> 
                                        <td> <?php echo $totalStaff; ?> </td> 
                                        <td><?php echo $stts; ?></td> 
                                        <td> 
                                        <!-- <a class="btn btn-info" href="<?php echo base_url('institution/approve/').$value['id']?>" title="Change Status"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>  -->
                                        <a class="btn btn-info mb-1 showeditform" title="Edit" href="javascript:void(0)" data-name="<?php echo $value['name']; ?>" data-status="<?php echo $value['status']; ?>" data-id="<?php echo $value['id']; ?>" data-role="<?php echo $value['role']; ?>" ><i class="fa fa-pencil"></i></a>

                                        <a class="btn btn-info mb-1" href="<?php echo BASE_URL.'share/viewprofile/'.$value['id'];?>" target="_blank"><i class="fa fa-eye"></i></a> 
                                        </td> 
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
    </div>


  <!-- Modal  Register Sub institutions-->
  <div id="editinsform" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Sub Institution's status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('institution/changeInsStatus'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>Provider's Name</label>
                            <input type="text" name="name" id="pname" class="form-control" readonly="">
                            <input type="hidden" name="disabled_by" class="form-control" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
                            <input type="hidden" name="id" id="pid" >
                            <input type="hidden" name="role" id="prole" >
                        </p>
                        <p>
                            <label>Change Status</label>
                            <select name="status" class="form-control" id="pstatus">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-primary" value="Update" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    $('.showeditform').on('click',function(){
        var pname = $(this).attr('data-name');
        var status = $(this).attr('data-status');
        var id = $(this).attr('data-id');
        var role = $(this).attr('data-role');
        $('#pname').val(pname);
        $('#pstatus').val(status);
        $('#pid').val(id);
        $('#prole').val(role);
        $('#editinsform').modal('show');
    });
</script>