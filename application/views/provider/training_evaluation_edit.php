<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="step-wise-query provider-overview">
                <?php $id = $this->uri->segment(3);?>
                <?php $this->load->view('provider/training_menu_edit'); ?>
				<?php $training_types = ($trainig_data[0]['training_type']==1)?'pro':'free'; ?>

            <div class="tab-content steps-detail">                
                <form method="post" action="<?php echo site_url('provider/training_evaluation_add'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                    <div class="form-group">
                        <?php echo $this->session->flashdata('response');?>
                        <label>Evaluation Note<sup>*</sup>(<i>Please fill evaluation note by your-self or you can copy this one also</i>)</label>
                        <div class="improvment-evaluation mb-2" style="border: 1px solid #c8baba; border-radius: 5px;">
                            <p><strong> TYPE-1: Please evaluate the speakers and confrence with the following guide:</strong>
                                <ul>
                                    <li>5 stars : Excellent</li>
                                    <li>4 stars : Best</li>
                                    <li>3 stars : Better</li>
                                    <li>2 stars : Good</li>
                                    <li>1 star : Needs Improvment</li>
                                </ul>
                            </p>
                        </div>
                        <div class="improvment-evaluation mb-2" style="border: 1px solid #c8baba; border-radius: 5px;">
                            <p><strong>TYPE-2: Please evaluate the speakers and confrence with the following guide:</strong>
                                <ul>
                                    <li>5 stars : Strongly Agree</li>
                                    <li>4 stars : Agree</li>
                                    <li>3 stars : Disagree</li>
                                    <li>2 stars : Strongly Disagree</li>
                                    <li>1 star : No Comments</li>
                                </ul>
                            </p>
                        </div>
                        <textarea class="form-control text_editor" name="evaluation_note" id="evaluation_note"><?php echo set_value('evaluation_note'); ?><?php if($training['evaluation_note']!=''){ echo  $training['evaluation_note']; }else{ echo 'Please enter your evaluation reminder here.'; } ?></textarea>
                        <span class="error"><?php echo  form_error('evaluation_note'); ?></span>
                    </div>

                    <div class="after-add-more">
                        <div class="row">
                            <div style="display: flex; align-items: center;">
                                <div class="form-group col-md-3">
                                    <label>Select Evaluation Type :</label>
                                </div>
                                <input type="hidden" name="tid" value="<?php echo $id;?>">
                                <div class="form-group col-md-3">
                                    <input type="radio"  id="evaluation_question_type1" name="evaluation_question_type[0]" required checked value="1">
                                    <span class="mode-span">Speaker<sup>*</sup></span>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="radio"  id="evaluation_question_type2" name="evaluation_question_type[0]" required value="2">
                                    <span class="mode-span">Symposium/Training<sup>*</sup></span> 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div style="display: flex; align-items: center;">
                                <div class="form-group col-md-3">
                                    <label>Select Question Type :</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="radio" name="question_type[0]" value="1" required checked> 
                                    <span class="mode-span">Star Rating Question<sup>*</sup></span>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="radio" name="question_type[0]" value="2" required> 
                                    <span class="mode-span">Text Answer Question<sup>*</sup></span>
                                </div>
                            </div>
                        </div>
                                
                        <div style="display: flex; align-items: center;">
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" id="evaluation_name" name="evaluation_name[0]"  placeholder="Enter Evaluation Question" required> 
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit" value="Save">Save & Add Evaluation</button>
                    <button type="submit" class="btn btn-success" name="submit" value="Save_next">Save & Next</button>
                </form>

                <div class="mt-2">
                    <div class="table-responsive">
                        <table id="tra-eval-list" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Evaluation Type</th>    
                                    <th>Title</th>  
                                    <th>Question Type</th>    
                                    <th>Action</th> 
                                </tr>
                            </thead>



                            <tbody>
                                <?php 
                                $this->db->order_by('id','DESC');
                                $evaluation = $this->user->get_record_by_field_name_all_record('tbl_training_evaluation','training_id',$this->uri->segment(3));
                                foreach ($evaluation as $key => $value) {

                                if($value['evaluation_type']==1){
                                    $evaluation_type = "Speaker";
                                } else {
                                    $evaluation_type = "Symposium";
                                } ?>
                                
                                <tr>
                                    <td><?php echo $key+1; ?>.</td> 
                                    <td><?php echo $evaluation_type; ?></td> 
                                    <td><?php echo $value['evaluation_question']; ?></td> 
                                    <td><?php if($value['question_type']==1){
                                            echo 'Ratting'; }else{ echo 'Text'; } ?></td> 
                                    <td>
                                        <a class="btn btn-primary" title="Edit" onclick="editinfo('<?php echo $value['id']; ?>')" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>

                                        <a class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/evaluation_delete/'.$value['id'].'/'.$id.'');?>"><i class="fa fa-trash"></i></a>&nbsp; 
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

    
<div id="evaluationContentModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Evaluation Question</h4>
      </div>
      <div class="modal-body">
        <div id="evaluationcontent">Please wait...</div>
      </div> 
    </div>

  </div>
</div>


<style type="text/css">
[type=radio]:checked+span{border:2px solid #20df80;box-shadow:0 0 10px rgba(32,223,128,.4);position:relative}.mode-span{padding:5px}
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tra-eval-list').dataTable();
            var totaleditor = 1;
        
        $("body").on("click", ".add-more", function() {
        totaleditor++;
        var html = $(".after-add-more").append('\
            <div class="row"><div style="display: flex; align-items: center;"><div class="form-group col-md-3"><label>Select Evaluation Type :</label></div><input type="hidden" name="tid" value="<?php echo $id;?>"><div class="form-group col-md-3"><input type="radio"  id="evaluation_question_type'+ totaleditor +'" name="evaluation_question_type['+ totaleditor +']" required checked value="1"><span class="mode-span">Speaker<sup>*</sup></span></div><div class="form-group col-md-3"><input type="radio"  id="evaluation_question_type'+ totaleditor +'" name="evaluation_question_type['+ totaleditor +']" required value="2"><span class="mode-span">Symposium/Training<sup>*</sup></span></div></div>\
            </div>\
            <div class="row"><div style="display: flex; align-items: center;"><div class="form-group col-md-3"><label>Select Question Type :</label></div><div class="form-group col-md-3"><input type="radio" name="question_type['+ totaleditor +']" value="1" required checked><span class="mode-span">Star Rating Question</span></div><div class="form-group col-md-3"><input type="radio" name="question_type['+ totaleditor +']" value="2" required><span class="mode-span">Text Answer Question</span></div></div>\
            </div>\
            <div style="display: flex; align-items: center;"><div class="form-group col-md-9"><input type="text" class="form-control"  id="evaluation_name'+ totaleditor +'" name="evaluation_name['+ totaleditor +']" placeholder="Enter Evaluation Question" required></div><div class="form-group col-md-3 change"><button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button></div>\
            </div>\
            ');
        $(html).find(".change").html("<button class='btn btn-success add-more' type='button'><i class='glyphicon glyphicon-plus'></i> Add</button><a class='btn btn-danger remove' style='padding: 5px 10px;margin-left: 5px;'>Remove</a>");
        $(".after-add-more").last(html).after(html);
    });
    $("body").on("click", ".remove", function() {
        $(this).parents(".after-add-more").remove();
    });
});

    function editinfo(idd){ 
        var tid = "<?php echo $this->uri->segment(3); ?>";
        $("#evaluationContentModal").modal()
            $.ajax({
            type: "POST",
            url: '<?php echo site_url('provider/updateevaluation');?>',
            data: {idd:idd,tid:tid}
            }).done(function( result ) { 
            $("#evaluationcontent").html( result );
            });
            return false;
    }

</script>