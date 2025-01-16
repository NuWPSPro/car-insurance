<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
         <!--    <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
        <?php $this->load->view('provider/sidebar'); ?>
            <div class="col-sm-9">
                <h3 class="border-title text-left">Create Course</h3>
                <div class="step-wise-query provider-overview">
                    <ul class="nav-tabs hidden-xs">
                        <li><a href="<?php echo site_url('provider/overview')?>">Overview</a></li>
                        <li class="active"><a href="<?php echo site_url('provider/lesson')?>">Lessons</a></li>
                        <li><a href="<?php echo site_url('provider/quiz')?>">Quiz</a></li>
                        <li><a href="<?php echo site_url('provider/certificate')?>">Certificate</a></li>
                        <li><a href="<?php echo site_url('provider/evaluation')?>">Evaluation</a></li>
                        <?php 
                         if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ ?>
                        <li><a href="<?php echo site_url('provider/promotion')?>">Promotion</a></li>
                        <?php } ?>
                        <li><a href="<?php echo site_url('provider/publish')?>">Publish</a></li>
                    </ul>
                    <div class="tab-content steps-detail">
                        <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                        <div id="step1" class="tab-pane fade in active">
                            <form action="<?php echo site_url('provider/lesson');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <?php echo $this->session->flashdata('response');?>
                                <h3>Course Lesson</h3>
                                <div class="row"><?php $count=1; ?>
                                    <div id="copycontent" class="clearfix col-sm-12">
                                        <div class="lesson-copy bg-gray p-20 mb-10">
                                            <div class="form-group">
                                                <label>Lessons Title <?php echo $count; ?><sup>*</sup></label>
                                                <input type="text" class="form-control" name="lesson_title[]" value="<?php echo set_value('lesson_title'); ?>">
                                                <span class="error"><?php echo  form_error('lesson_title'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached Video </label>
                                                <input type="file" class="form-control" name="lesson_video[]" value="<?php echo set_value('lesson_video'); ?>">
                                                <span class="error"><?php echo  form_error('lesson_video'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Lessons Content<sup>*</sup></label>
                                                <textarea class="form-control text_editor" name="lesson_content[]"><?php echo set_value('lesson_content'); ?></textarea>
                                                <span class="error"><?php echo  form_error('lesson_content'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Case Study</label>
                                                <textarea class="form-control text_editor" name="case_study[]"><?php echo set_value('case_study'); ?></textarea>
                                                <span class="error"><?php echo  form_error('case_study'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="copycontent1" class="clearfix col-sm-12"></div>
                                    
                                    <div class="col-sm-12 form-group">
                                        <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add Lesson</button>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Summary</label>
                                        <textarea class="form-control text_editor" name="summary" id="summary"><?php echo set_value('summary'); ?></textarea>
                                        <span class="error"><?php echo  form_error('summary'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>References</label>
                                        <textarea class="form-control text_editor" name="references" id="references"><?php echo set_value('references'); ?></textarea>
                                        <span class="error"><?php echo  form_error('references'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <input type="submit" class="btn btn-primary btn-lg" value="SAVE & NEXT">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- <table class="table table-striped">
                        <tr>
                            <th>No.</th>
                            <th>Lessons Title</th>
                            <th>Lessons Course</th>
                            <th>Lesson Video Url</th>
                            <th>Lessons Type</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                foreach ($lesson as $key => $value) {
                ?>
                        <tr>
                            <td>
                                <?php echo $key+1; ?>.</td>
                            <td>
                                <?php echo $value['lesson_title'];?>
                            </td>
                            <td>
                                <?php echo $value['course_title'];?>
                            </td>
                            <td>
                                <?php echo $value['lesson_video'];?>
                            </td>
                            <td>
                                <?php echo $value['lesson_type'];?>
                            </td>
                            <td>
                                <a href="">
                                    <input type="button" class="btn-danger" value="Delete">
                                </a>&nbsp;
                                <a href="">
                                    <input type="button" class="btn-warning" value="Edit">
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">

$(document).ready(function() {

    //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
      var lessioncount = 1;
    $("body").on("click",".add-more",function(){ 
        lessioncount++;
         var html = $("#copycontent").html();
         //alert(JSON.stringify(html));
         //$("#copycontent").after(html);        
         $("#copycontent").append('<span id="copycontent'+lessioncount+'"><div style="float:right"><button type="button" style="margin: 0px 5px 0px 10px;" class="btn btn-success add-more" title="Add Lesson" data-id="'+lessioncount+'"><i class="glyphicon glyphicon-plus"></i></button><a class="btn btn-danger remove" style="padding: 5px 10px;margin-left: 5px;" alt="remove" data-id="'+lessioncount+'">X</a></div><div class="col-sm-12 form-group"><label>Lessons Title '+lessioncount+'</label><input type="text"  class="form-control" name="lesson_title[]" value=""><span class="error"><?php echo  form_error("lesson_title"); ?></span></div><div class="col-sm-12 form-group"><label>Attached Video </label><input type="file"  class="form-control" name="lesson_video[]" value=""><span class="error"><?php echo  form_error("lesson_video"); ?></span></div><div class="col-sm-12 form-group"><label>Lessons Content <sup>*</sup></label><textarea  class="form-control text_editor" name="lesson_content[]"></textarea><span class="error"><?php echo  form_error("lesson_content"); ?></span></div><div class="col-sm-12 form-group"><label>Case Study</label><textarea  class="form-control text_editor" name="case_study[]"></textarea><span class="error"><?php echo  form_error("case_study"); ?></span></div></span>');
         // $('.text_editor').editable({ inlineMode: false, imageUploadURL: 'https://ceonpoint.com/uploadimage', imageUploadParams: { id: "text_editor" } });
         // $(".froala-wrapper").next().remove();
         // lessioncount++;
      });
    //here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
           //$(this).parents("#copycontent").remove();  
          var dataid = $(this).data("id");
         $('#copycontent'+dataid).remove();
      });

});
</script>