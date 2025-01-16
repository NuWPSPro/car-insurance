<?php $this->load->view('institution/picture'); ?>
  
	  <div class="innerContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3>
                </div>
                    <?php $this->load->view('institution/sidebar'); ?>
                
             <div class="col-sm-9">
                    <h3 class="border-title text-left">CE Provider (<?=count($ceproviders);?>)</h3>
                    <?php if(isset($sub_ins) && $sub_ins!=''){  ?>
                    <div class="row">
                        <div class="col-md-2 mt-3"><label>Filter by</label></div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <!--<label>Sub Institution</label>-->
                            <form action="<?php echo base_url('institution/ceproviders'); ?>" method="get">
                                <div class="selection-box">
                                    <select name="subins" class="form-control" onchange="this.form.submit();">
                                        <option value="">Select Sub Institution</option>
                                        <?php  foreach($sub_ins as $value){ ?>
                                        <option value="<?=$value['cid']; ?>"><?=$value['cname']; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div><?php } ?>
                <?php echo $this->session->flashdata('response'); ?>
                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="cep-list" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Name</th>
                                        <th>Profession</th>
                                        <th>Image</th>
                                        <th>Email</th>
                                        <th>Date Registered</th>
                                        <th>Status</th>
                                        <th>Approval Date</th>
                                        <th>Sub Institution</th>
                                        <th>No of Authors</th>
                                        <th>No of Staff</th>
                                        <th>Access</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if(isset($ceproviders) && $ceproviders != ''){
                                // echo '<pre>'; print_r($ceproviders[0]);
                                $count = 1; 
                                foreach ($ceproviders as $key => $value) { 
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
                                    //$ins = explode('-', $value['parent_insititution']);
                                    $ins_id = $value['parent_insititution'];
                                    $pro_id = $value['insititution_id'];

                                    $this->db->select('is.*,u.profession,u.id as pid');
                                    $this->db->from('tbl_institution_staff is');
                                    $this->db->join('tbl_user u', 'is.email = u.username_email','LEFT');
                                    $this->db->where('is.insititution_code',$pro_id);
                                    $this->db->where('is.status',1);
                                    $this->db->where('is.activated',1);
                                    $staff_list = $this->db->get()->num_rows();

                                    // $prof_id = array_column($staff_list, 'prof_id');

                                    $where = array('role'=>6,'status'=>1,'under_provider'=>$pro_id); 
                                    $userdetails = $this->user->get_record_by_field_name_all_record('tbl_user',$where,'');
                                    //print_r($userdetails);
                                    $findSubIns = $this->db->get_where('tbl_user',array('id'=>$ins_id));
                                    $findSubInsToggle = $findSubIns->row_array()['under_insititution'];
                                    // $findSubInsId = $findSubIns->row_array()['id'];
                                    // echo $findSubInsId;
                                    if ($findSubInsToggle) {
                                        $ins_name = $this->db->get_where('tbl_user',array('id'=>$ins_id))->row_array()['name'];
                                    } else {
                                        $ins_name = '--';
                                    }
                                   
                                    // $author_name = $this->db->get_where('tbl_user',array('id'=>$value['under_provider']))->row_array()['name'];  ?>
                                    <tr>
                                        <td><?php echo $count; ?>.</td> 
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['profession']; ?></td>
                                        <td><?php 
                                            if($value['image']){
                                                echo "<img src=".ASSETS_URL.'images/uploads/'.$value['image'].">";
                                            }else{
                                                echo 'No image';
                                            } ?>
                                        </td>
                                        <td><?php echo $value['username_email']; ?></td>
                                        <td><?php echo $value['added_on']; ?></td>
                                        <!-- <td><a href="<?php echo base_url('institution/approve/').$value['id']?>"><?php echo $status; ?></a></td> -->
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $value['approval_date']; ?></td>
                                        <td><?php echo $ins_name; ?></td>
                                        <td><?=count($userdetails);?></td>
                                        <td><?php echo $staff_list; ?></td>
                                        <td><?php echo $access; ?></td>
                                        <td width="200">
                                            <a class="btn btn-default" title="Edit" href="javascript:void(0)" onclick="showeditform('<?=$value['name']; ?>','<?=$value['status']; ?>','<?=$value['id']; ?>','<?=$value['role']; ?>')" ><i class="fa fa-pencil"></i></a>
                                        <?php // if($value['status']==1 && $value['disabled_by']==0){ ?>  
                                            <a class="btn btn-default" target="_blank" title="View" href="<?php echo site_url('share/viewprofile/').$value['id'];?>"><i class="fa fa-eye"></i></a>
                                            <!--<a class="btn btn-default" href="#"><i class="fa fa-trash"></i></a>-->
                                            <!--<a class="btn btn-default" class="btn" href="#"><i class="fa fa-envelope"></i></a>-->
                                        <?php // } ?>
                                        </td>
                                    </tr>
                                <?php $count++; } }else{ echo 'No data Found';}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $('#cep-list').dataTable();
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
                    <h4 class="modal-title">Change Provider's status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('institution/changeproviderstatus'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>Provider's Name</label>
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