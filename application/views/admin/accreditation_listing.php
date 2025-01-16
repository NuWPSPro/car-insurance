<?php $this->load->view('admin/picture'); ?>
<?php $profession = $this->uri->segment(3);?>

<div class="innerContent admin-insititutionpanel">
	<div class="container">
		<div class="row">
		<?php $this->load->view('admin/sidebar'); ?>
        <div class="col-sm-9">
            <div class="admin-titlebox">
                <h3 class="border-title text-left">Accreditation List</h3>
			</div>

           <div class="pb-2 button-list">
               <a href="<?=current_url();?>" id="all" class="btn btn-primary <?php if($_REQUEST['type']==''):echo 'active';endif;?>">All</a>
               <a href="<?=current_url().'?type=cep';?>" id="cep" class="btn btn-primary <?php if($_REQUEST['type']=='cep'):echo 'active';endif;?>">CE Provider</a>
               <a href="<?=current_url().'?type=oc';?>" id="oc" class="btn btn-primary <?php if($_REQUEST['type']=='oc'):echo 'active';endif;?>">Online Course</a>
               <a href="<?=current_url().'?type=tc';?>" id="tc" class="btn btn-primary <?php if($_REQUEST['type']=='tc'):echo 'active';endif;?>">Training Course</a>
            </div> 
            <?php echo $this->session->flashdata('response');?>

        <div class="table-responsive">
                <table id="ins-list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name/Title</th>
                            <th>User Email</th>
                            <th>Type</th>
                            <th>Accreditation No.</th>
                            <th>Validity Date</th>
                            <th>Website of RB</th>
                            <th>Added Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($list as $key => $value) {  
                            if($value->status=='1'){ 
                                $status = '<span style="color:green;">Approved</span>'; 
                            }elseif($value->status=='0'){ 
                                $status = '<span style="color:red;">Disapproved<span>'; 
                            }else{ 
                                $status = '<span style="color:red;">Pending<span>'; 
                            }   
                            if($value->type=='cep'){ 
                                $type = '<span>CEP</span>'; 
                            }elseif($value->type=='oc'){ 
                                $type = '<span>Online Course<span>'; 
                            }else{ 
                                $type = '<span>Training Course<span>'; 
                            }   
                            ?>
                        <tr>
                            <td><?php echo $key+1;?></td> 
                            <td><?php echo ($value->cepname !='')?$value->cepname:'--';?></td>
                            <td><?php echo ($value->user_email != '')?$value->user_email:'--';?></td>
                            <td><?php echo $type;?></td>
                            <td><?php echo $value->acc_number;?></td> 
                            <td><?php echo date('Y-m-d',strtotime($value->validity));?></td> 
                            <td><?php echo $value->website_of_rb;?></td> 
                            <td><?php echo $value->added_on;?></td> 
                            <td><?php echo $status; ?></td>
                            <td><a class="btn btn-default" title="Edit" href="javascript:void(0)" onclick="showeditform('<?php echo $value->cepname; ?>','<?php echo $value->status; ?>','<?php echo $value->aid; ?>','<?php echo $value->type; ?>')" ><i class="fa fa-pencil"></i></a>
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
                    <h4 class="modal-title">Manual Accreditation</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/manualAccreditation'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>CEP's Name</label>
                            <input type="text" name="name" id="pname" class="form-control" readonly="">
                            <input type="hidden" name="id" id="pid" >
                        </p>
                        <p>
                            <label>Change Accreditation Status</label>
                            <select name="status" class="form-control" id="pstatus">
                                <option value="1">Approved</option>
                                <option value="0">Disapproved</option>
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
    });

    function showeditform(pname,status,id,role){
        // alert('ok');
        $('#editinsform').modal('show');
        $('#pname').val(pname);
        $('#pstatus').val(status);
        $('#pid').val(id);
    }

    function filtedata(){
        var profession = jQuery('#profession').val();
        var path = "<?php echo site_url();?>/admin/professional/";
        window.location = path+profession;
    }
</script>



