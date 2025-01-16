<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-certificate-templetepanel">
    <div class="container">
        
        <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>
            <div class="col-sm-9">
                <div class="admin-titlebox">
                <h3 class="border-title text-left">Certificate Templete Listing</h3>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#AddCertificateTempleteModal">Add Certificate Templete</button>
                </div>
                <?php echo $this->session->flashdata('response');?>

				<form action="<?=base_url('admin/certificate_templete');?>" method="get" >
                      <button class="btn btn-info" type="submit" name="category" >All</button>
                      <button class="btn btn-info" type="submit" name="category" value="Portrait">Portrait</button>
                      <button class="btn btn-info" type="submit" name="category" value="Landscape">Landscape</button>
                </form>
                <br > 
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Templete no.</th>
                                <th>Category</th>
                                <th>No. of Signature</th>
                                <th>Preview</th>
                                <th>Status</th>
                                <th>Added On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
               
               <?php 

               foreach ($ctemp as $key => $value) { 

                         ?>
                            <tr>
                                <td><?php echo $key+1;?></td>

                                <td><?php echo $value['template_no'];?></td>

                                <td><?php echo $value['category'];?></td>

                                <td><?php echo $value['numberofsignature'];?></td>

                                <td class="imageprev"><?php // echo $value['temppreview'];?>
                                    <img src="<?php echo ASSETS_URL.'upload/certificate_templete/'.$value['temppreview']; ?>" width="100px">
                                </td>
                                <td><?php $status = ($value['status']==1)?'Active':'Inactive'; ?>
                                    <?php echo $status; ?>
                                </td>

                                <td><?php echo $value['added_on'];?></td>

                                <td>
                                    <a href="javascript:void(0)" onclick="edit_certtemp(<?php echo $value['id'];?>)" class="btn btn-primary" title="View"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo BASE_URL.'admin/certificate_templete_delete/'.$value['id'];?>" onclick="return confirm('Are you sure you want to delete it?')" class="btn btn-danger" title="View"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php }  ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="pagination pull-right">
                    <?php //  echo $this->pagination->create_links();?>
                </div> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function edit_certtemp(id) {
    // $('#editCertificateTempleteModal').modal('show');
    $.ajax({
        type: "POST",
        url: '<?php echo base_url()."admin/certificate_templete_edit";?>',
        data: { id: id }
    }).done(function(result) {
        obj = jQuery.parseJSON(result);
    	// alert(obj.id);
        $("#ct_id").val(obj.id);
        $("#etemplate_no").val(obj.template_no);
        $("#ecategory").val(obj.category);
        $("#enumberofsignature").val(obj.numberofsignature);
        if(obj.status == 1){
            $("#eastatus").attr("checked",true);
        }else{
            $("#eistatus").attr("checked",true);
        }

        var imgname = obj.temppreview;
        var src="<?=ASSETS_URL ?>upload/certificate_templete/"+imgname;
        $("#templetepreview").attr('src',src);
        
        $("#editCertificateTempleteModal").modal('show');
    });
    return false;
   

}
</script>

<!-- Modal -->
<div id="editCertificateTempleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Certificate Templete</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL;?>admin/update_certificate_templete" method="post" enctype="multipart/form-data" name="form1" id="form1">

                <div class="modal-body"> 
                    <p>
                        <label>Certificate Templete Number <span class="required text-danger"> * </span> </label>
                        <input name="template_no" id="etemplate_no" value="" size="20" type="text" readonly class="form-control" required>
                    </p>
                    <p>
                        <label>Category <span class="required text-danger"> * </span> </label>
                        <select name="category" id="ecategory"  class="form-control">
                            <option value="Portrait" selected="">Portrait</option>
                            <option value="Landscape">Landscape</option>
                       </select>    
                    </p>
                    <p>
                        <label>Number of Signature <span class="required text-danger"> * </span> </label>
                        <select name="numberofsignature" id="enumberofsignature" class="form-control">
                               <option value="1">1</option>
                               <option value="2" selected="">2</option>
                               <option value="3">3</option>
                               <option value="4">4</option>
                       </select>
                    </p>

                    <p class="temppreview">
                        <label>Upload Templete <span class="required text-danger"> * </span> </label>
                        <input onchange="readURL(this);" name="templetepreview" type="file" class="form-control">
                        <img id="templetepreview" class="temp-image" width="150">
                    </p>
                     <p class="temppreview">
                        <label>Upload Background<span class="required text-danger"> * </span> </label>
                        <input  name="bg_image" type="file" class="form-control">
                    </p>
                    <p class="temppreview">
                        <label>Upload Text Image (CERTIFICATE)<span class="required text-danger"> * </span> </label>
                        <input  name="text_image" type="file" class="form-control">
                    </p>
                   <input type="hidden" name="id" id="ct_id">
                   <p>
                        <label>Status <span class="required text-danger"> * </span> </label>
                        <label class="radio-inline"><input type="radio" name="status" id="eastatus" value="1" >Active </label>
                        <label class="radio-inline"><input type="radio" name="status" id="eistatus" value="0">Inactive </label>
                    </p>
                            
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="Update Templete" type="submit">
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<div id="AddCertificateTempleteModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              
                <h4 class="modal-title">Add Certificate Templete</h4>

            </div>

              <form action="<?php echo BASE_URL;?>admin/certificate_templete" method="post" enctype="multipart/form-data" name="form1" id="form1">

                <div class="modal-body"> 
                    <p>
                        <label>Certificate Templete Number <span class="required text-danger"> * </span> </label>
                        <input name="template_no" value="" size="20" type="text" class="form-control" required>
                        <span class="error"><?php echo  form_error('template_no'); ?></span>
                    </p>
                    <p>
                        <label>Category <span class="required text-danger"> * </span> </label>
                        <select name="category" class="form-control">
                               <option value="Portrait" selected="">Portrait</option>
                               <option value="Landscape">Landscape</option>
                       </select>
                        <span class="error"><?php echo  form_error('category'); ?></span>
                            
                    </p>
                    <p>
                        <label>Number of Signature <span class="required text-danger"> * </span> </label>
                        <select name="numberofsignature" class="form-control">
                               <option value="1">1</option>
                               <option value="2" selected="">2</option>
                               <option value="3">3</option>
                               <option value="4">4</option>
                       </select>
                        <span class="error"><?php echo  form_error('numberofsignature'); ?></span>
                    </p>

                    <p class="temppreview">
                        <label>Upload Templete <span class="required text-danger"> * </span> </label>
                        <input onchange="readURL(this);" name="templetepreview" type="file" class="form-control" required>
                        <img id="atempletepreview" class="temp-image" width="150">
                        <span class="error"><?php echo  form_error('templetepreview'); ?></span>
                    </p>

                    <p class="temppreview">
                        <label>Upload Background<span class="required text-danger"> * </span> </label>
                        <input  name="bg_image" type="file" class="form-control" required>
                        <!-- <img id="bg_image" class="temp-image"> -->
                        <span class="error"><?php echo  form_error('bg_image'); ?></span>
                    </p>
                    <p class="temppreview">
                        <label>Upload Text Image (CERTIFICATE)<span class="required text-danger"> * </span> </label>
                        <input  name="text_image" type="file" class="form-control" required>
                        <!-- <img id="bg_image" class="temp-image"> -->
                        <span class="error"><?php echo  form_error('text_image'); ?></span>
                    </p>
                   

                            
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="Add Templete" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#templetepreview').attr('src', e.target.result);
            }
            reader.onload = function (e) {
                $('#atempletepreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

