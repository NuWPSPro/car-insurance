<?php $this->load->view('template/picture_provider'); ?>
<?php $id = $this->uri->segment(3); 
	  $course = $this->db->get_where('tbl_training',array('id'=>$id))->row_array();  ?>

<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                
                <div class="step-wise-query provider-overview">
                    <?php $this->load->view('provider/training_menu_edit'); ?>
					<?php $training_types = ($trainig_data[0]['training_type']==1)?'pro':'free'; ?>
		 
            <div class="tab-content steps-detail">                        
                
                <form method="post" action="<?php echo site_url('provider/training_schedule_edit/'.$id); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                    <div class="col-sm-6 form-group">
                        <?php echo $this->session->flashdata('response');?>
                        <label for="exampleInputEmail1">Schedule Date<sup>*</sup></label>
                        <input type="hidden" name="tid" id="tid" value="<?php echo $id;?>">
                        <input type="date" class="form-control datepicker" id="schedule_date" name="schedule_date" value="<?php echo $course['start_date']; ?>" required> 
                    </div> 
                    <!-- *************************************************** -->
                    <div class="after-add-more">
                        <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Schedule Start Time<sup>*</sup></label>
                                <input type="time" class="form-control" id="schedule_start_time" name="schedule_start_time[]" required>
                                <?php echo form_error('schedule_start_time'); ?> 
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Schedule End Time<sup>*</sup></label>
                                <input type="time" class="form-control" id="schedule_end_time" name="schedule_end_time[]" required>
                                <?php echo form_error('schedule_end_time'); ?>  
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Topic/Event<sup>*</sup></label>
                                <input type="text" class="form-control" id="topic" name="topic[]" required placeholder="Topic"> 
                                <?php echo form_error('topic'); ?>  

                            </div>  
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group change">
                                <label for="">&nbsp;</label><br/>
                                <a class="btn btn-success add-more">+ Add</a>
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="exampleInputEmail1">Speaker/Person<sup>*</sup></label>
                            <select class="form-control speakerCol" id="speaker" name="speaker[]" required>
                                <option value="" selected>Please Select OR enter the name</option> 
                                <?php foreach ($speaker as $key => $value){ ?>
                                <option value="<?php echo $value['id'];?>"><?php echo $value['speaker_name'];?></option> 
                                <?php } ?>
                                <option value="0">Others</option> 
                            </select>
                            <?php echo form_error('speaker'); ?>  

                        </div>
                        <div class="col-sm-6 form-group" style="display: none;">
                            <lavel>Please add designation too with the name, eg. Sam Thomus-Accountant </lavel>
                            <input type="text" class="form-control" name="others[]" placeholder="Others"> 
                        </div>
                    </div>
                    <!-- *************************************************** -->
                    <div class="col-sm-6 form-group">
                        <button type="submit" class="btn btn-info" name="submit" value="Save">Save & Add Schedule</button>
                        <button type="submit" class="btn btn-success" name="submit" value="Save_next">Save & Next</button>
                    </div>
                </form>

                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Schedule Date</th>   
                                    <th>Start Time</th>  
                                    <th>End Time</th>  
                                    <th>Topic</th>  
                                    <th>Speaker Name</th>  
                                    <th>Action</th> 
                                </tr>
                                </thead>

                                <tbody class="row_position">
                                <?php 
                                $training = $this->user->get_record_by_field_name_all_record('tbl_training_schedule','training_id',$this->uri->segment(3));
                                foreach ($training as $key => $value) {
                                $speaker = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','id',$value['speaker_id']);
                                ?>

                                <tr>
                                    <td><?php echo $key+1; ?>.</td> 
                                    <td><?php echo $value['schedule_date']; ?></td> 
                                    <td><?php echo date('h:i A',strtotime($value['schedule_start_time'])); ?></td> 
                                    <td><?php echo date('h:i A',strtotime($value['schedule_end_time'])); ?></td> 
                                    <td><?php echo $value['topic']; ?></td>  
                                    <td> <?php
                                    if($speaker[0]['speaker_name']=="" || $value[0]['speaker_id']){
                                    echo $value['speaker_name']; 
                                    }  else {
                                    echo $speaker[0]['speaker_name']; 
                                    } ?> </td> 
                                    <td> <a class="btn btn-primary" title="Edit" onclick="editinfo('<?php echo $value['id']; ?>')" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
                                    &nbsp; 
                                    <a class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/schedule_delete/'.$value['id'].'/'.$id.'');?>"><i class="fa fa-trash"></i></a>
                                    &nbsp; 
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
</div>

    <div id="myModal11" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Schedule</h4>
        </div>
        <div class="modal-body">
            <div id="speakercontent">Please wait...</div>
        </div> 
        </div>

    </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $("body").on("click", ".add-more", function() {
            var html = $(".after-add-more").first().clone().find("input:text,#schedule_start_time,#schedule_end_time").val("").end();
            $(html).find(".change").html("<div style='margin-top: 33px;' class='d-flex'><a class='btn btn-success add-more'>+ Add</a><a class='btn btn-danger remove'>- Remove</a></div>");
            $(".after-add-more").last().after(html);
        });
        $("body").on("click", ".remove", function() {
            $(this).parents(".after-add-more").remove();
        });
    });

    $(document).on('change', '.speakerCol', function(){
        var speaker = $(this).val();
        console.log(speaker);
        if(speaker == 0){
            $(this).parent().next().show();
        } else {
            $(this).parent().next().hide();
        }
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
            url:"<?php echo base_url();?>provider/sponsor_sequence",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }

    function editinfo(idd){ 
        var tid = "<?php echo $this->uri->segment(3); ?>";
        $("#myModal11").modal()
        $.ajax({
            type: "POST",
            url: '<?php echo site_url('provider/updatespeaker');?>',
            data: {idd:idd,tid:tid}
        }).done(function( result ) { 
            $("#speakercontent").html( result );
        });
        return false;
    }
</script>

