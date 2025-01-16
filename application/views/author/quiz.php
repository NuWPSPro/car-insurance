<?php $this->load->view('template/picture_author'); ?>
<?php 
        $uid = $this->session->userdata('logged_in')['id']; 
        $uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
        $up_id = end(explode('-', $uprovider)); 
        $uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
        ?>
<div class="innerContent author-quiz">
    <div class="container">
        <div class="row">
            <?php 
        $this->load->view('author/sidebar');
        ?>
            <div class="col-sm-9">
                <h3 class="border-title text-left">Create Course</h3>
                <div class="step-wise-query provider-overview">
                    <ul class="nav-tabs hidden-xs">
                        <li><a href="<?php echo site_url('author/overview'); ?>">Overview</a></li>
                        <li><a href="<?php echo site_url('author/lesson'); ?>">Lessons</a></li>
                        <li class="active"><a href="<?php echo site_url('author/quiz'); ?>">Quiz</a></li>
                        <li><a href="<?php echo site_url('author/certificate'); ?>">Certificate</a></li>
                        <li><a href="<?php echo site_url('author/evaluation'); ?>">Evaluation</a></li>
                        <?php if($uins == '0'){ ?>
                        <li><a href="<?php echo site_url('author/promotion'); ?>">Promotion</a></li>
                        <?php } ?>
                        <li><a href="<?php echo site_url('author/publish'); ?>">Publish</a></li>
                    </ul>
                    <form action="<?php echo site_url('author/quiz'); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <?php echo $this->session->flashdata('response');?>
                        <div class="tab-content steps-detail">
                            <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                            <div id="step1" class="tab-pane fade in active">
                                <h3>Course Quiz</h3>
                                <div class="row">


                                    <div class="col-sm-12 form-group">
                                        <label>Quiz Note <sup>*</sup></label>
                                         <textarea class="form-control text_editor" name="quiz_description"><?php echo set_value('quiz_description'); ?></textarea>
                                        <span class="error"><?php echo  form_error('quiz_description'); ?></span>
                                    </div>



                                    <div class="col-sm-12 form-group">
                                        <label>Quiz Retake <sup>*</sup></label>
                                        <select class="form-control" name="retek" id="retek" required>
                                            <?php 
                                         for ($i=1; $i <=10 ; $i++) { 
                                         ?>
                                            <option value="<?php echo $i;?>">
                                                <?php echo $i;?>
                                            </option>
                                            <?php     
                                         }
                                        ?>
										<option value="-1">Unilimited</option>
                                        </select>
                                        <span class="error"><?php echo  form_error('retek'); ?></span>
                                    </div>




                                    <div class="col-sm-12 form-group">
                                        <label>Passing Marks ( % ) <sup>*</sup></label>
                                        <select class="form-control" name="passing_marks" id="passing_marks" required>
                                            <?php 
                                         for ($i=80; $i <=100 ; $i++) { 
                                         ?>
                                            <option value="<?php echo $i;?>">
                                                <?php echo $i;?>
                                            </option>
                                            <?php     
                                         }
                                        ?>
                                        </select>
                                        <span class="error"><?php echo  form_error('passing_marks'); ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="after-add-more count-q">
                                            <div class="row">
                                                <div style="display: flex; align-items: center;">
                                                    <div class="form-group col-md-8">
                                                        <label for="inputEmail4">Question Title </label>&nbsp;<span class="char">1</span>
                                                        <input required type="text" class="form-control" name="question_title[]" placeholder="Question Title">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group change">
                                                            <label for="">&nbsp;</label>
                                                            <br/>
                                                            <a class="btn btn-success add-more">+ Add</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <p>Please fill all four answer choices<sup>*</sup></p>        
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">Answer 1</label>
                                                    <input required type="text" class="form-control" name="answere1[]">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">Answer 2</label>
                                                    <input required type="text" class="form-control" name="answere2[]">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">Answer 3</label>
                                                    <input required type="text" class="form-control" name="answere3[]">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">Answer 4</label>
                                                    <input required type="text" class="form-control" name="answere4[]">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4">Correct Answer</label>
                                                    <select required class="form-control" name="correct_answere[]">
                                                        <option value="" selected>Select Answer</option>
                                                        <option value="1">Answer One</option>
                                                        <option value="2">Answer Two</option>
                                                        <option value="3">Answer Three</option>
                                                        <option value="4">Answer Four</option>
                                                    </select>
                                                </div>
												<div class="col-sm-12 form-group">
													<label>Rationale</label>
													 <textarea class="form-control text_editor" name="rational[]"></textarea>
													<span class="error"></span>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-primary btn-lg" value="SAVE & NEXT">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>



<script type="text/javascript">

$(document).ready(function() {
    jQuery(function () {
        tinymce.init({
            selector: '.text_editor'
        });
    });
    var counter = 1;
    $("body").on("click", ".add-more", function() {
        counter++;
        // var totaleditor=jQuery('.text_editor').length;
        var html ='<div class="after-add-more'+counter+'"><div class="row"><div style="display: flex; align-items: center;"><div class="form-group col-md-8"><label for="inputEmail4">Question Title '+counter+'</label><input  type="text" class="form-control" name="question_title[]" placeholder="Question Title"></div><div class="col-md-4"><div class="form-group change"><label></label><a class="btn btn-success add-more" data-id="'+counter+'">+ Add</a>&nbsp;<a class="btn btn-danger remove" data-id="'+counter+'">- Remove</a></div></div></div><div class="col-md-12"><p>Please fill all four answer choices<sup>*</sup></p></div><div class="form-group col-md-2"><label for="inputPassword4">Answer 1</label><input required type="text" class="form-control" name="answere1[]"></div><div class="form-group col-md-2"><label for="inputPassword4">Answer 2</label><input required type="text" class="form-control" name="answere2[]"></div><div class="form-group col-md-2"><label for="inputPassword4">Answer 3</label><input required type="text" class="form-control" name="answere3[]"></div><div class="form-group col-md-2"><label for="inputPassword4">Answer 4</label><input required type="text" class="form-control" name="answere4[]"></div><div class="form-group col-md-4"><label for="inputPassword4">Correct Answer</label><select required class="form-control" name="correct_answere[]"><option value="">Choose Answer</option><option value="1">Answer One</option><option value="2">Answer Two</option><option value="3">Answer Three</option><option value="4">Answer Four</option></select></div><div class="col-sm-12 form-group"><label>Rationale</label><textarea class="form-control text_editor" id="editor'+counter+'" name="rational[]"></textarea><span class="error"></span></div></div></div>';

       // var html = $(".after-add-more").first().clone().find("input:text").val("").end().find(".froala-element").html("").end();     
       var numItems = $('.count-q').length+1;
        $(html).find(".char").html(+numItems);
        $(html).find(".change").html("<label for=''></label><a class='btn btn-success add-more'>+ Add</a>&nbsp;<a class='btn btn-danger remove'>- Remove</a>");
        $(".after-add-more").append(html);
    });

    $("body").on("click", ".remove", function() {
         var dataid = $(this).data("id");
         $('.after-add-more'+dataid).remove();
        // $(this).parents(".after-add-more").remove();
    });
});

</script>

