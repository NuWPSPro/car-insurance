<?php $this->load->view('admin/picture'); ?>
<?php $profession = $this->uri->segment(3);?>

<div class="innerContent admin-insititutionpanel">
	<div class="container">
    
		<div class="row">
		<?php $this->load->view('admin/sidebar');
              $this->load->view('admin/users_work'); ?>

        <?php echo $this->session->flashdata('response');?> 

        <div class="table-responsive">
                <table id="ins-list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>User Type</th>
                            <th>Profession</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>Date Registered</th>
                            <th>Status</th>
                            <th>Access</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($users as $key => $value) {  
                            $insCat = $this->db->get_where('tbl_category_institution',array('id'=>$value['profession']))->row_array()['cat_name'];

                            if($value['status']==1 && $value['disabled_by']==0){ 
                                $status = '<span style="color:green;">Active</span>'; 
                                $access = '<span style="color:green;">Enable</span>'; 
                            }elseif($value['status']==0 && $value['disabled_by'] > 0){ 
                                $status = '<span style="color:red;">Inactive<span>'; 
                                $access = '<span style="color:red;">Disable<span>'; 
                            }else{ 
                                $status = '<span style="color:red;">Pending<span>'; 
                                $access = '<span style="color:red;">Inactive<span>'; 
                            }   ?>
                        <tr>
                            <td><?php echo $key+1;?></td> 
                            <td><?php echo $value['name'];?></td>
                            <td><?php echo 'Insititution';?></td> 
                            <td><?php echo $insCat;?></td> 
                            <td><?php echo $value['countries_name'];?></td> 
                            <td><?php echo $value['username_email'];?></td> 
                            <td><?php echo $value['added_on'];?></td> 

                            <!-- <td><a href="<?php echo BASE_URL.'admin/changestatus/'.$value['id'].'/'.$value['status'].''?>" style="color: <?php echo $color; ?>"><?php echo $stts;?></a></td>  -->
                            <td><?php echo $status; ?></td>
                            <td><?php echo $access; ?></td>
                            <td><?php $name = addslashes($value['name']); ?>
                                <a class="btn btn-default" title="Edit" href="javascript:void(0)" onclick="showeditform('<?php echo $name; ?>','<?php echo $value['status']; ?>','<?php echo $value['id']; ?>','<?php echo $value['role']; ?>')" ><i class="fa fa-pencil"></i></a>
                                <a target="_blank" href="<?php echo site_url('share/viewprofile/'.$value['id'].'');?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a> &nbsp;</td>
                        </tr>
                        <?php } ?>
                            
                    </tbody>
                </table>
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
                    <h4 class="modal-title">Change Institution's status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/changeInsStatus'); ?>" method="post" enctype="multipart/form-data"
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


<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#ins-list').DataTable();
    } );

    function showeditform(pname,status,id,role){
        // alert('ok');
        $('#editinsform').modal('show');
        $('#pname').val(pname);
        $('#pstatus').val(status);
        $('#pid').val(id);
        $('#prole').val(role);
    }

    function filtedata(){
        var profession = jQuery('#profession').val();
        var path = "<?php echo site_url();?>/admin/professional/";
        window.location = path+profession;
    }

    function setval(){
        var profession =  "<?php echo urldecode($this->uri->segment(3));?>";
        jQuery('#profession').val(profession);
    }
    setval();
</script>



