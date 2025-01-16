 <?php $this->load->view('admin/picture'); ?>
 <div class="innerContent">
	<div class="container">
		<div class="row">
		<?php $this->load->view('admin/sidebar'); ?>	
        
        <div class="col-sm-9">
            <div class="row">
                <form method="POST" action="<?php echo BASE_URL('admin/users');?>" >
                    <div class="form-group col-md-5">
                        <select name="country" class="form-control">
                            <option value="" >Country</option>
                            <?php foreach($country as $count){
                                ?>
                            <option value="<?php echo $count['countries_id']; ?>" <?php if($_POST['country']==$count['countries_id']){echo'selected';} ?> ><?php echo $count['countries_name']; ?></option>
                            <?php
                            } ?>
                    </select>
                    </div>

                    <div class="form-group col-md-5">
                            <input type="date" name="date" class="form-control" value="<?php echo set_value('date')?>">
                    </div>
                    <div class="form-group col-md-2">
                        <!-- <input type="hidden" name="professiona" value="<?php echo $this->uri->segment(2); ?>"> -->
                        <input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
                    </div>
                    <input type="hidden" name="role" id="user_role" value="">
                </form>
            </div>
                    <?php $filterAuthordata['role']=6;
                    $authors = $this->user->get_record_by_multi_field_name('tbl_user',$filterAuthordata);
                    ?>

            <div class="row">
                <div class="form-group col-md-5">
                    <?php  $total = count($authors); ?>
                    <h4 class="text-left"> Authors (<?php echo $total; ?>)</h4>
                </div>
            </div>



 
         <?php echo $this->session->flashdata('response'); ?>
            <div class="table-responsive">
            <table id="author-list" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <!-- <th>User</th> -->
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Image</th>
                        <th>Email</th> 
                        <th>Date Registered</th>
                        <th>Approval Date</th> 
                        <th>Status</th> 
                        <th>Access</th> 
                        <th>Action</th> 
                    </tr>
                    </thead>
                    <tbody>
                         <?php 
                            foreach ($authors as $key => $value) {
                            $creater = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array(); 
                             if($value['status']==1 && $value['disabled_by']==0){ 
                                $status = '<span style="color:green;">Active</span>'; 
                                $access = '<span style="color:green;">Enable</span>'; 
                            }elseif($value['status']==0 && $value['disabled_by'] > 0){ 
                                $status = '<span style="color:red;">Inactive<span>'; 
                                $access = '<span style="color:red;">Disable<span>'; 
                            }else{ 
                                $status = '<span style="color:red;">Pending<span>'; 
                                $access = '<span style="color:red;">Inactive<span>'; 
                            }  ?>
                            <tr>
                                <td><?php echo $key+1; ?>.</td> 
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['profession']; ?></td>
                                <td><?php if($value['image']){ ?>
                                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$value['image']; ?>" alt="" style="height: 50px; width: 50px;"><?php }else{ echo 'No Image!'; }?>
                                </td>
                                <td><?php echo $value['username_email']; ?></td> 
                                <td><?php echo $value['added_on']; ?></td>
                                <td><?php if($value['approval_date']){ echo $value['approval_date']; }else{ echo'Not Approved!'; } ?></td>

                                <!-- <td><a onclick="return confirm('Are you sure, you want to change status?')" href="<?php echo site_url('admin/user_status/'.$value['id'].'/'.$value['status'].'');?>" style="color: <?php echo $col;?>"><?php echo $stts; ?></a></td>  -->
                                <td><?php echo $status; ?></td>
                                <td><?php echo $access; ?></td>

                                <td>
                                    <a class="btn btn-default" title="Edit" href="javascript:void(0)" onclick="showeditform('<?=$value['name']; ?>','<?=$value['status']; ?>','<?=$value['id']; ?>','<?=$value['role']; ?>')" ><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-default" title="View" target="_blank" href="<?php echo site_url('share/viewprofile/'.$value['id'].'');?>"><i class="fa fa-eye"></i></a>
                                
                                </td>


                            </tr>
                            <?php } ?>
            
        </tbody>
    </table>
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
                    <h4 class="modal-title">Change Author's status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/changeAuthorStatus'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>Author's Name</label>
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



<script type="text/javascript">
    
    $(document).ready(function() {
        $('#author-list').DataTable();
    } );

    function showeditform(pname,status,id,role){
        $('#pname').val(pname);
        $('#pstatus').val(status);
        $('#prole').val(role);
        $('#pid').val(id);
        $('#editinsform').modal('show');
    }

</script>


