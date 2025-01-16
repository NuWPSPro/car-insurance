<?php $this->load->view('template/picture_author'); ?>
<?php 
		$uid = $this->session->userdata('logged_in')['id']; 
	  	$uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
	  	$up_id = end(explode('-', $uprovider)); 
	  	$uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
	  	?>
<style>
	.text_editor{
		display: block;
	}
</style>
<div class="innerContent author-edit-quiz">
	<div class="container">
		<div class="row">
		
<?php   $this->load->view('author/sidebar');
		$cid = $this->uri->segment(3); ?>	

	<div class="col-sm-9">
			<h2><?php echo $course[0]['course_title']; ?></h2>
			<h3 class="border-title text-left">Edit Course</h3>
			<div class="step-wise-query">
				<ul class="nav-tabs hidden-xs">
				<li><a  href="<?php echo site_url('author/course_edit/').$cid;?>">Overview</a></li>
				<li><a  href="<?php echo site_url('author/lesson_edit/').$cid;?>">Lessons</a></li>
				<li class="active"><a  href="<?php echo site_url('author/edit_quiz/').$cid;?>">Quiz</a></li>
				<li><a  href="<?php echo site_url('author/edit_certificate/').$cid;?>">Certificate</a></li>
				<li><a  href="<?php echo site_url('author/edit_evaluation/').$cid;?>">Evaluation</a></li>
				
				<?php if($uins == '0'){ ?>
				<li><a href="<?php echo site_url('author/promotion/').$cid;?>">Promotion</a></li>
				<?php } ?>

				<li><a  href="<?php echo site_url('author/edit_publish/').$cid;?>">Publish</a></li>
				</ul>


			<div class="tab-content steps-detail">
				<div id="step1" class="tab-pane fade in active">
				<?php $qid =  $this->uri->segment(4); 
					 $qurl = ($qid != '') ? $qid :''; ?>

	<form action="<?php echo site_url('author/edit_quiz/').$cid.'/'.$qurl; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">

		<?php echo $this->session->flashdata('response');?>
			<a class="title-mobile" data-toggle="tab" href="#step1">Edit Quiz</a>
				<div id="step1" class="tab-pane fade in active">
                    <h3>Course Quiz</h3>
                <div class="row">
					<input type="hidden" name="course_idd" id="course_idd" value="<?php echo $this->uri->segment(3);?>">
					<?php $coursedatas = $this->user->get_record_by_field_name_all_record('tbl_course','id',$this->uri->segment(3));  ?>

					<div class="col-sm-12 form-group">
						<label>Quiz Note <sup>*</sup></label>
						<textarea class="form-control text_editor" name="quiz_description"><?php echo $course[0]['quiz_description']; ?><?php echo $coursedatas[0]['course_exam_note']?></textarea>
						<span class="error"><?php echo  form_error('quiz_description'); ?></span>
					</div>

					<div class="col-sm-12 form-group">
						<label>Quiz Retake <sup>*</sup></label>
						<select class="form-control" name="retek" id="retek" required>
						
							<?php for ($i=1; $i <=10 ; $i++) {  ?>
							<option <?php if($course[0]['quiz_retek']==$i){ echo "selected"; }?> value="<?php echo $i;?>">
							<?php echo $i;?></option><?php   } ?>
							
							<option <?php if($course[0]['quiz_retek']=='-1'){ echo "selected"; }?> value="-1">
							  Unilimited</option>
						</select>
						<span class="error"><?php echo  form_error('retek'); ?></span>
					</div>

					<div class="col-sm-12 form-group">
						<label>Passing Marks ( % ) <sup>*</sup></label>
						<select class="form-control" name="passing_marks" id="passing_marks" required>
							<?php  for ($i=80; $i <=100 ; $i++) {  ?>
							<option value="<?php echo $i;?>" <?php if($course[0]['passing_marks']==$i){ echo "selected"; }?>>
								<?php echo $i;?></option><?php  }?>
						</select>
						<span class="error"><?php echo  form_error('passing_marks'); ?></span>
					</div>
			
						<!----------------------------------------------------------------------->
				<?php if($qid != ''){
						$currentquize = $this->user->get_record_by_field_name_all_record('tbl_quiz_question','id',$qid);	
						//foreach ($quiz as $key => $value) {  ?>
					
                   
							<div class="form-group col-md-12">
								<label for="inputEmail4">Question Title</label>
								<input required type="text" class="form-control" name="uquestion_title" value="<?php echo $currentquize[0]['question_title'];?>" placeholder="Question Title" >
							</div>
							<div class="col-md-12">
                                <p>Please fill all four answer choices<sup>*</sup></p>        
                            </div>
							<div class="form-group col-md-2">
								<label for="inputPassword4">Answer 1</label>
								<input required type="text" class="form-control" name="uanswere1" value="<?php echo $currentquize[0]['answere1'];?>">
							</div>
							<div class="form-group col-md-2">
								<label for="inputPassword4">Answer 2</label>
								<input required type="text" class="form-control" name="uanswere2" value="<?php echo $currentquize[0]['answere2'];?>">
							</div>
							<div class="form-group col-md-2">
								<label for="inputPassword4">Answer 3</label>
								<input required type="text" class="form-control" name="uanswere3" value="<?php echo $currentquize[0]['answere3'];?>">
							</div>
							<div class="form-group col-md-2">
								<label for="inputPassword4">Answer 4</label>
								<input required type="text" class="form-control" name="uanswere4" value="<?php echo $currentquize[0]['answere4'];?>">
							</div>
							
							<div class="form-group col-md-4">
								<label for="inputPassword4">Correct Answer</label>
								<select required class="form-control" name="ucorrect_answere">
									<option value="1" <?php if($currentquize[0]['correct_answere']==1){ echo "selected";}?>>Answer One</option>
									<option value="2" <?php if($currentquize[0]['correct_answere']==2){ echo "selected";}?>>Answer Two</option>
									<option value="3" <?php if($currentquize[0]['correct_answere']==3){ echo "selected";}?>>Answer Three</option>
									<option value="4" <?php if($currentquize[0]['correct_answere']==4){ echo "selected";}?>>Answer Four</option>
								</select>
							</div>
												
							<div class="col-sm-12 form-group" >
								<label>Rationale</label>
								 <textarea class="form-control text_editor" id="editor1" name="urational"><?php echo $currentquize[0]['rational'];?></textarea>
								<span class="error"></span>
							</div>
						<?php  } ?>
							<!----------------------------------------------------------------------------------------------->	<?php if($qid==''){?>
                                    <div class="col-md-12">

                                        <div class="after-add-more count-q">

                                            <div class="row">

                                                <div style="display: flex; align-items: center;">

                                                    <div class="form-group col-md-8">

                                                        <label for="inputEmail4">Question Title</label>&nbsp;<span class="char">1</span>

                                                        <input  type="text" class="form-control" name="question_title[]" placeholder="Question Title">

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
                                                       <option value="">Choose Answer</option>
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
                                <?php } ?>
                                    <br>

                                    <br>

                                    <div class="col-md-12">

                                        <input type="submit" class="btn btn-primary btn-lg" value="SAVE & NEXT">

                                    </div>

                            </div>

                        </div>

                    </form>		
					


                    <div class="step-wise-query">
                    <!-- <?php echo $this->session->flashdata('response');?> -->
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Rationale</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                        <?php
                        foreach ($quiz as $key => $value) { 
                        	if($value['correct_answere']==1){ $correct = 'A'; }
                        	elseif($value['correct_answere']==2){ $correct = 'B'; }
                        	elseif($value['correct_answere']==3){ $correct = 'C'; }
                        	else{ $correct = 'D'; }?>                          
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value['question_title']; ?></td>
                                <td><?php echo $correct; ?></td>
                                <td><?php echo $value['rational']; ?></td>
                                <td>
                                    <a class="btn btn-default" title="Edit" href="<?php echo site_url('author/edit_quiz/'.$cid.'/'.$value['id'].'');?>"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-default" title="Delete" href="<?php echo site_url('author/delete_quiz/'.$cid.'/'.$value['id'].'');?>" onclick="return confirm('Are you sure, you want to delete it?')"><i class="fa fa-trash"></i></a>
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

</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>









<script type="text/javascript">

$(document).ready(function() {
	// jQuery(function () {
 //        tinymce.init({
 //            selector: 'textarea'
 //        });
 //    });
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

