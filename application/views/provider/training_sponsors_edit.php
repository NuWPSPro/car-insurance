<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="step-wise-query provider-overview">
                        <?php $this->load->view('provider/training_menu_edit'); ?>
                    <div class="tab-content steps-detail">
                        <?php $id = $this->uri->segment(3); ?>
				<?php $training_types = ($trainig_data[0]['training_type']==1)?'pro':'free'; ?>

                        <form method="post" action="<?php echo site_url('provider/training_sponsors_edit_save'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                            <?php echo $this->session->flashdata('response');?>
                            <div class="after-add-more">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sponsor Name<sup>*</sup></label>
                                        <input type="hidden" name="tidd" id="tidd" value="<?php echo $id; ?>">
                                        <input type="text" class="form-control" id="blank" name="sponsor_name[]"  placeholder="Enter sponsor name" required> 
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Website<sup>*</sup></label>
                                        <input type="text" class="form-control" id="blank" name="sponsor_url[]"  pattern="https?://.+" title="Include http://" placeholder="Enter sponsor url" required> 
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sponsor Image<sup>*</sup></label>
                                        <input type="file" class="form-control" id="blank" name="userfile[]" required> 
                                    </div>  
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group change">
                                        <label for="">&nbsp;</label><br/>
                                        <a class="btn btn-success add-more">+ Add</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <br/>
                                    <!-- <a class="btn btn-success add-more">+ Add</a> -->
                                    <!-- <button type="submit" class="btn btn-primary">Next</button> -->
                                    <button type="submit" class="btn btn-primary" name="submit" value="Save">Save</button>
                                    <button type="submit" class="btn btn-success" name="submit" value="Save_next">Save & Next</button>
                                </div>
                            </div>
                        </form>

                        <div class="col-sm-12 mt-2">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Sponsors Name</th>  
                                            <th>Url</th>  
                                            <th>Image</th>  
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody class="row_position">
                                    <?php 
                                    $sponsor = $this->user->get_record_by_field_name_all_record('tbl_training_sponsors','training_id',$this->uri->segment(3));
                                    foreach ($sponsor as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $key+1; ?>.</td> 
                                                <td> 
                                                    <?php echo $value['sponsors_name']; ?>  
                                                </td>  
                                                <td> 
                                                    <?php echo $value['urls']; ?>  
                                                </td> 
                                                <td> 
                                                    <img style="height: 50px; width: 50px;" src="<?php echo BASE_URL.'assets/images/uploads/'.$value['sponsors_image']; ?>"> 
                                                </td> 
                                                <td>
                                                <!--  <a class="btn btn-info" title="edit" href="javascript:void(0)" data-toggle="modal" data-target="#myModalSponsore" data-id="<?=$value['id']?>"><i class="fa fa-edit"></i>
                                                    </a>&nbsp; -->
                                                    <a class="btn btn-primary" title="Edit" onclick="editinfo('<?php echo $value['id']; ?>')" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>

                                                    <a class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/sponsors_delete/'.$value['id'].'/'.$id.'');?>"><i class="fa fa-trash"></i>
                                                    </a>
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

        </div>
    </div>
</div>

<div class="modal fade" id="myModalSponsore" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Sponsores</h4>
        </div>
        <div class="modal-body">
        <div id="SponsoreContent"></div>
        </div>
      </div>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("body").on("click", ".add-more", function() {
            var html = $(".after-add-more").first().clone().find("input:text,input:file").val("").end();
            //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
            $(html).find(".change").html("<div style='margin-top: 33px;' class='d-flex'><a class='btn btn-success add-more'>+ Add</a><a class='btn btn-danger remove'>- Remove</a></div>");
            $(".after-add-more").last().after(html);
        });
        $("body").on("click", ".remove", function() {
            $(this).parents(".after-add-more").remove();
        });
    });
    
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });

    function updateOrder(data) {
        $.ajax({
            url:"<?php echo base_url('provider/sponsor_sequence'); ?>",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }
    
    function editinfo(idd){ 
        var tid = "<?php echo $this->uri->segment(3); ?>";
        $("#myModalSponsore").modal()
            $.ajax({
            type: "POST",
            url: '<?php echo site_url('provider/updateSponsours');?>',
            data: {idd:idd,tid:tid}
            }).done(function( result ) { 
            $("#SponsoreContent").html( result );
            });
            return false;
    }
</script>


