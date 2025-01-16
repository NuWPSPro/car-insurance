<?php $this->load->view('template/picture_provider'); ?>
<?php $id = $this->uri->segment(3); ?>

<div class="innerContent">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="step-wise-query provider-overview">
                    <?php $this->load->view('provider/training_menu_edit'); ?>
                    <div class="tab-content steps-detail">
                        <?php $id = $this->uri->segment(3); ?>
				<?php $training_types = ($trainig_data[0]['training_type']==1)?'pro':'free'; ?>
                
                        <form method="post" action="<?php echo site_url('provider/training_committee_edit_save'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                            <?php echo $this->session->flashdata('response');?>
                            <div class="after-add-more">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Committee Member's Name<sup>*</sup></label>
                                        <input type="hidden" name="tidd" id="tidd" value="<?php echo $this->uri->segment(3); ?>">
                                        <input type="text" class="form-control" name="committee_name[]"  placeholder="Enter committee name" required> 
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Designation<sup>*</sup></label>
                                        <input type="text" class="form-control" name="degination[]"  placeholder="Enter degination name" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Committee Image<sup>*</sup></label>
                                        <input type="file" class="form-control" name="userfile[]" required> 
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
                                <div class="form-group change">
                                    <label for="">&nbsp;</label><br/>
                                    <button type="submit" name="submit" value="save" class="btn btn-info">Save</button>
                                    <button type="submit" name="submit" value="save_next" class="btn btn-success"> Save & Next</button>
                                </div>
                            </div>
                        </form>

                    </div>
                        <div class="card mt-2">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Committee Name</th>  
                                            <th>Degination</th>  
                                            <th>Image</th>  
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody class="row_position">
                                        <?php  $comittee = $this->user->get_record_by_field_name_all_record('tbl_training_committee','training_id', $this->uri->segment(3));
                                        
                                        foreach ($comittee as $key => $value) { ?>
                                        <tr>
                                            <td><?php echo $key+1; ?>.</td> 
                                            <td><?php echo $value['committee_name']; ?></td>  
                                            <td><?php echo $value['degination']; ?></td> 
                                            <td><img style="height: 50px; width: 50px;" src="<?php echo BASE_URL.'assets/images/uploads/'.$value['committee_image']; ?>"></td> 
                                            <td>
                                                <a class="btn btn-primary" title="Edit" onclick="editinfo('<?php echo $value['id']; ?>')" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>

                                                <a class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/committee_delete/'.$value['id'].'/'.$id.'');?>"><i class="fa fa-trash"></i></a></td> 
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


<div class="modal fade" id="myModalCommittee" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Committee Member's detail</h4>
        </div>
        <div class="modal-body">
        <div id="CommitteeContent"></div>
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
            $(html).find(".change").html("<div style='margin-top: 33px;' class='d-flex'><a class='btn btn-success add-more'>+ Add</a><a class='btn btn-danger remove'>- Remove</a></div>");
            $(".after-add-more").last().after(html);
        });
        $("body").on("click", ".remove", function() {
            $(this).parents(".after-add-more").remove();
        });
    });

    $(".row_position").sortable({
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
            url:"http://ceonpoint.com/index.php/provider/sponsor_sequence",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }

    function editinfo(idd){ 
        var tid = "<?php echo $this->uri->segment(3); ?>";
        $("#myModalCommittee").modal()
        $.ajax({
            type: "POST",
            url: '<?php echo site_url('provider/updateCommittee');?>',
            data: {idd:idd,tid:tid}
        }).done(function( result ) { 
            $("#CommitteeContent").html( result );
        });
        return false;
    }

</script>

