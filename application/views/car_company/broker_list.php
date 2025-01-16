
<?php  $this->load->view('car_company/picture'); ?>

        <!-- Main body start -->
        <div class="col-sm-9">
        <?=$body_heading; ?>

                <div class="table-responsive">
                    <table id="aut-list" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <!-- <th>User</th> -->
                                <th>Name</th>
                                <th>Profession</th>
                                <th>Image</th>
                                <th>Email</th> 
                                <th>Approval Date</th> 
                                <th>Status</th> 
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                    <?php foreach ($authors as $key => $value) {
                        $creater = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array(); ?>
                            <tr>
                                <td>
                                    <?php echo $key+1; ?>.</td> 
                                <td>
                                    <?php echo $value['name']; ?>
                                </td>
                                <td>
                                    <?php echo $value['profession']; ?>
                                </td>
                                <td><?php if(empty($value['image'])){ echo'No image found!'; }else{ ?>
                                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$value['image']; ?>" alt="" style="height: 50px; width: 50px;"><?php } ?> 
                                </td>
                                <td>
                                    <?php echo $value['username_email']; ?>
                                </td> 

                                <td><?php if(empty($value['approval_date'])){ echo'Not Approved'; }else{?>
                                    <?php echo $value['approval_date']; ?>
                                    <?php } ?>
                                </td> 
                                

                                <?php 
                                if($value['status']==1){
                                  $stts = "Approved";
                                  $col  = "green";
                                } else {
                                  $stts = "Pending";
                                  $col  = "red";
                                }
                                ?>
                                <td>
                                <?php if($value['status']==1){ ?>
                                    <a onclick="return confirm('Are you sure, you want to Deactivate this author?')" href="<?php echo site_url('provider/user_status/'.$value['id'].'/'.$value['status'].'');?>" style="color: <?php echo $col;?>"><?php echo $stts; ?></a>
                                <?php }else{ ?>    
                                    <a onclick="return confirm('Are you sure, you want to Approve this author?')" href="<?php echo site_url('provider/user_status/'.$value['id'].'/'.$value['status'].'');?>" style="color: <?php echo $col;?>"><?php echo $stts; ?></a>
                                <?php } ?>
                                </td> 

                                </td>

                                <td>
                                    <a class="btn btn-default" title="Edit" href="javascript:void(0)" onclick="showeditform('<?=$value['name']; ?>','<?=$value['status']; ?>','<?=$value['id']; ?>','<?=$value['role']; ?>')" ><i class="fa fa-pencil"></i></a>

                                    <!-- <a class="btn btn-default" title="View" href="<?php echo site_url('share/viewprofile/'.$value['id'].'');?>"><i class="fa fa-eye"></i></a> -->
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
     	<!-- Main body end -->
        
		<!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>


<!-- Modal  Register Sub institutions-->
<div id="editform" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Broker's status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('provider/change_author_status'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>Broker's Name</label>
                            <input type="text" name="name" id="pname" class="form-control" readonly="">
                            <input type="hidden" name="ins_name" class="form-control" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
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

<script type="text/javascript">
 $(document).ready(function() {
        $('#aut-list').dataTable();
    });

    function showeditform(pname,status,id,role){
        $('#editform').modal('show');
        $('#pname').val(pname);
        $('#pstatus').val(status);
        $('#prole').val(role);
        $('#pid').val(id);
    }
</script>