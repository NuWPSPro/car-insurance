<?php $this->load->view('admin/picture');
      $profession = $this->uri->segment(3); ?>
<div class="innerContent admin-provider-listingpanel">
	<div class="container">
    <!--  -->
		<div class="row">
     
		<?php 
    		$this->load->view('admin/sidebar');
            $this->load->view('admin/users_work'); ?>	
        <?php echo $this->session->flashdata('response'); ?>

            <div class="row">
                <div class="form-group col-md-6">
                    <form action="" method="get" name="frm">
                        <select name="profession" id="profession" class="form-control">
                            <option value="">Profession</option>
                            <?php $profession = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
                            foreach ($profession as $key => $value){ ?>
                            <option <?php if($profession==$value['cat_name']){ echo "selected"; }?> value="<?php echo $value['cat_name'];?>"><?php echo $value['cat_name'];?></option>
                            <?php }  ?>
                        </select>
                    </form>
                </div>

                <div class="form-group col-md-2">
                    <input type="button" name="filter" value="FILTER" class="btn btn-primary" onclick="filtedata()">
                </div>
            </div>

            <div class="table-responsive">
                <table id="pro-list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <!-- <th>User Type</th> -->
                            <th>Profession</th>
                            <th>Country</th>
                            <!-- <th>Address</th> -->
                            <th>Email</th>
                            <th>Affiliate</th>
                            <th>Accreditation No.</th>
                            <th>Validity of Accreditation</th>
                            <th>Accreditation Document</th>
                            <th>Regulatory Board</th>
                            <th>Website of Reg. Board</th>
                            <th>Date Registered</th>
                            <th>Status</th>
                            <th>Access</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($users as $key => $value) {  
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
                            $docpath = ASSETS_URL.'images/uploads/'.$value['accreditation_doc'];
                            $country_name = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name'];
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td> 
                            <td><?php echo $value['name'];?></td>
                            <!-- <td><?php echo "CPD Provider";?></td>  -->
                            <td><?php echo $value['profession'];?></td> 
                            <td><?php echo $country_name;?></td> 
                            <!-- <td><?php echo $value['address'];?></td>  -->
                            <td><?php echo $value['username_email'];?></td> 
                            <td>
                                <?php if($value['under_insititution'] == 1){ 
                                    $ins_name = $this->db->get_where('tbl_user',array('id'=>$value['parent_insititution']))->row_array()['name'];
                                    echo $ins_name; }else{ echo 'Bussiness';} ?>
                            </td>

                            <td><?php   if(!empty($value['prc_acceditation_number'])){ 
                                        echo $value['prc_acceditation_number'];
                                    }else{ echo'--'; } ?></td>
                            <td><?php   if(!empty($value['validity']) && $value['validity'] != '0000-00-00'){ 
                                        echo $value['validity'];
                                    }else{ echo'--'; } ?></td> 

                            <td class="text-center"><?php  if(!empty($value['accreditation_doc'])){ ?>
                                <a href="javascript:void(0)" onclick="acc_doc('<?php echo $docpath;?>')" title="View"><i class="fa fa-file" style="font-size:24px;color:red;"></i></a>
                                <?php }else{ echo'--'; } ?></td>

                            <td><?php if(!empty($value['accreditation_web'])){
                                     echo $value['accreditation_web']; 
                                 }else{ echo '--'; }?></td>
                                 
                            <td><?php if(!empty($value['website'])){
                                     echo $value['website']; 
                                 }else{ echo '--'; }?></td> 

                            <td><?php echo $value['added_on'];?></td> 
                                        
                            <!-- <td><a href="<?php echo BASE_URL.'admin/changestatus/'.$value['id'].'/'.$value['status'].''?>" style="color: <?php echo $color; ?>"><?php echo $stts;?></a></td>  -->
                            <td><?php echo $status; ?></td>
                            <td><?php echo $access; ?></td>

                            <td>
                                <a class="btn btn-default" title="Edit" href="javascript:void(0)" onclick="showeditform('<?=$value['name']; ?>','<?=$value['status']; ?>','<?=$value['id']; ?>','<?=$value['role']; ?>')" ><i class="fa fa-pencil"></i></a>
                                <a target="_blank" href="<?php echo site_url('share/viewprofile/'.$value['id'].'');?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a> &nbsp;
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>	
		</div>
		</div>
	</div>


    <div class="modal fade" id="accDocumentModal" role="dialog">
      <div class="modal-dialog lg">
        <!-- Modal content-->
        <div class="modal-content" id="myModalpreviewImage11">
          <div class="modal-header">
        <!-- <button onclick="myFunction()" style="float: left;" type="button"><i class="fa fa-print"></i></button> -->

            ACCREDITATION DOCUMENT
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <center>
              <iframe id="imagepreview" src="" width="100%" height="550" frameborder="0" allowfullscreen=""> </iframe>
            </center>
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
                    <h4 class="modal-title">Change Provider's status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/changeCepStatus'); ?>" method="post" enctype="multipart/form-data"
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
        jQuery('#pro-list').DataTable();
    } );

    function showeditform(pname,status,id,role){
        $('#editinsform').modal('show');
        $('#pname').val(pname);
        $('#pstatus').val(status);
        $('#prole').val(role);
        $('#pid').val(id);
    }

    function filtedata(){
        var profession = jQuery('#profession').val();
        var path = "<?php echo site_url('admin/provider_isting/'); ?>";
        window.location = path+profession;

    }

    function setval(){
        var profession =  "<?php echo urldecode($this->uri->segment(3));?>";
        jQuery('#profession').val(profession);
    }
    setval();

    function acc_doc(image) {
        // alert(image);
        $("#accDocumentModal").modal('show');
        document.getElementById('imagepreview').src = image;
    }


</script>





