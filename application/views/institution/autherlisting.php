<?php $this->load->view('institution/picture'); ?>
 
	  <div class="innerContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3>
                </div>
                <?php $this->load->view('institution/sidebar'); ?>
                
                <div class="col-sm-9">
                    <h3 class="border-title text-left"> Author listing(<?=count($authorlist);?>)</h3>
                
                <form action="<?=base_url('institution/autherlisting');?>" method="get">
				<div class="row pt-1">
                <?php if($this->session->userdata('logged_in')['under_insititution']=='0'){ ?>
                    <div class="form-group col-md-3">
                        <select name="institution" class="form-control" onchange="this.form.submit();">
                            <option value="">Select Sub Institution</option>
                            <?php if(isset($sub_ins) && $sub_ins!=''){ 
                                    foreach($sub_ins as $value){ ?>
                            <option value="<?=$value['cid']; ?>"><?=$value['cname']; ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                <?php } ?>  
                    <div class="form-group col-md-3">
                        <select name="ceprovider" class="form-control">
                            <option value="" >CE Provider:</option>
                            <?php foreach($ceplist as $cp){ ?>
                                <option value="<?php echo $cp['id']; ?>" <?php if($_GET['ceprovider']==$cp['id']){echo'selected';} ?> ><?php echo $cp['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
					<div class="form-group col-md-3">
							<input type="text" name="title" class="form-control" value="<?php echo set_value('title',$_GET['title'])?>" placeholder="Enter author's name">
					</div>
					<div class="form-group col-md-3">
						
						<input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
					</div>
				</div>
				</form>

                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="author-list" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Profession</th>
                                        <th>Image</th>
                                        <th>Email</th>
                                        <th>Date Registered</th>
                                        <th>Status</th>
                                        <th>Sub Institution</th>
                                        <th>CE Provider</th>
                                        <th>Approval Date</th>
                                        <th>Access</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php $key=1;
                                  foreach ($authorlist as $value) {

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

                                    $ins_id = $value['parent_insititution'];
                                    $uproid = end(explode('-', $value['under_provider']));
                                    $underProvider = $this->db->get_where('tbl_user',array('id'=>$uproid))->row_array();

                                    $checkins = $this->db->get_where('tbl_user',array('id'=>$ins_id))->row_array();

                                    if ($checkins['under_insititution'] > 0) {
                                        $subins = $this->db->get_where('tbl_user',array('id'=>$checkins['parent_insititution']))->row_array();
                                        $subIns_name = $subins['name'];
                                    } else {
                                        $subIns_name = '--';
                                    } ?>
                            <tr>
                                <td><?php echo $key; ?>.</td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['profession']; ?></td>
                                <td><?php if($value['image']) { ?><img src="<?php echo ASSETS_URL.'images/uploads/'.$value['image']; ?>" alt="" style="height: 50px; width: 50px;"> <?php } else {echo 'No Image!';} ?></td>
                                <td><?php echo $value['username_email']; ?></td>
                                <td><?php echo $value['added_on']; ?></td>
                                <td><?php echo $status; ?>
                                    <!-- <a onclick="return confirm('Are you sure, you want to change status?')" href="<?php echo site_url('author/user_status/'.$value['id'].'/'.$value['status'].'');?>" style="color: <?php echo $col;?>"><?php echo $stts; ?></a> -->
                                </td>
                                <td><?php echo $subIns_name; ?></td>
                                <td><?php echo $underProvider['name']; ?></td>
                                <td><?php echo $value['approval_date']; ?></td>
                                <td><?php echo $access; ?></td>
                               
                                <td>
                                    <a class="btn btn-default" title="Edit" href="javascript:void(0)" onclick="showeditform('<?=$value['name']; ?>','<?=$value['status']; ?>','<?=$value['id']; ?>','<?=$value['role']; ?>')" ><i class="fa fa-pencil"></i></a>

                                <?php if($value['status']==1 && $value['disabled_by']==0){?>
                                    <a class="btn btn-default" title="View" target="_blank" href="<?php echo site_url('share/viewprofile/'.$value['id'].'');?>"><i class="fa fa-eye"></i></a>
                                <?php } ?>
                                </td>
                            </tr>
                            <?php $key++;  	}  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
        // $('#author-list').dataTable();
    });

    function showeditform(pname,status,id,role){
        $('#editform').modal('show');
        $('#pname').val(pname);
        $('#pstatus').val(status);
        $('#prole').val(role);
        $('#pid').val(id);

    }
</script>


 


  <!-- Modal  Register Sub institutions-->
    <div id="editform" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Author's status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('institution/changeproviderstatus'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>Author's Name</label>
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