<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
          <!--   <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
            <?php 
		//$this->load->view('provider/sidebar');
		?>
            <div class="col-sm-12">
                <h3 class="border-title text-left">Upload Training/Seminar</h3>
                <h4 style="color: red;"><?php echo $trainig_data[0]['title']; ?></h4>
                <div class="step-wise-query provider-overview">
                    <?php $this->load->view('provider/training_menu_edit'); ?>
                    <div class="tab-content steps-detail">
                        <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                        <div id="step1" class="tab-pane fade in active">
                            <!-- <ul class="nav-tabs hidden-xs">
                                <li><a href="<?php echo site_url()?>/provider/training_center">General Info</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_overview">Overview</a></li>

                                <li class="active"><a href="<?php echo site_url()?>/provider/training_speaker">Speaker</a></li>
                                
                                <li><a href="<?php echo site_url()?>/provider/training_schedule">Schedule</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_evaluation">Evaluation</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_promotion">Promotion</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_publish">Publish</a></li>
                            </ul> -->
                             
                             

                            <?php 

				$totsubs = 0;
				foreach ($purchase_plan as $key => $value) {
					$totsubs = $totsubs+$value['no_of_subscription'];
				}
				
 
				?>
		                          
				<form action="<?php echo site_url();?>/provider/training_exam_edit_save" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <?php echo $this->session->flashdata('response');?>
                        <div class="steps-detail">
                            <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                            <div id="step1" class="tab-pane fade in active">
                                <h3>Exam Question</h3>
                                <div class="row">


                                      
                                    <div class="col-md-12">
                                        <div class="after-add-more">
                                            <div class="row">


                                                <div style="display: flex; align-items: center;">
                                                    <div class="col-md-2">
                                                        <div class="form-group change">
                                                            <label for="">&nbsp;</label>
                                                            <br/>
                                                            <a class="btn btn-success add-more">+ Add</a>
                                                        </div>
                                                    </div>
                                                </div>




                                                <?php 
                                                $tid = $this->uri->segment(3);
                                                 $questions = $this->user->get_record_by_field_name_all_record('tbl_training_quiz_question','training_id',$tid); 
                                                ?>
                                                <input type="hidden" name="tidd" id="tidd" value="<?php echo $tid; ?>">
                                                
                                                <?php 
                                                foreach ($questions as $key => $value) {
                                                    
                                                ?>


                                                <div>
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4">Question Title</label>
                                                        <input required type="text" class="form-control" name="question_title[]" placeholder="Question Title" value="<?php echo $value['question_title']; ?>">
                                                    </div> 
                                                </div>



                                                

                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">Answere1</label>
                                                    <input required type="text" class="form-control" name="answere1[]" value="<?php echo $value['answere1']; ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">Answere2</label>
                                                    <input required type="text" class="form-control" name="answere2[]" value="<?php echo $value['answere2']; ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">Answere3</label>
                                                    <input required type="text" class="form-control" name="answere3[]" value="<?php echo $value['answere3']; ?>">
                                                </div> 
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">Answere4</label>
                                                    <input required type="text" class="form-control" name="answere4[]" value="<?php echo $value['answere4']; ?>">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4">Correct Answere</label>
                                                    <select required class="form-control" name="correct_answere[]">
                                                        <option value="1" <?php if($value['correct_answere']==1){ echo "selected"; } ?>>Answer One</option>
                                                        <option value="2" <?php if($value['correct_answere']==2){ echo "selected"; } ?>>Answer Two</option>
                                                        <option value="3" <?php if($value['correct_answere']==3){ echo "selected"; } ?>>Answer Three</option>
                                                        <option value="4" <?php if($value['correct_answere']==4){ echo "selected"; } ?>>Answer Four</option>
                                                    </select>
                                                </div>

                                                <?php 
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-primary btn-lg" value="NEXT">
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
</div>
</div> 





<script type="text/javascript">
$(document).ready(function() {
    $("body").on("click", ".add-more", function() {
        var html = $(".after-add-more").first().clone();

        //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

        $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");


        $(".after-add-more").last().after(html);



    });

    $("body").on("click", ".remove", function() {
        $(this).parents(".after-add-more").remove();
    });
});
</script>