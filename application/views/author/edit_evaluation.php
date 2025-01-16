<?php $this->load->view('template/picture_author'); ?>
<?php 
		$uid = $this->session->userdata('logged_in')['id']; 
	  	$uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
	  	$up_id = end(explode('-', $uprovider)); 
	  	$uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
	  	?>
<div class="innerContent author-edit-evaluation">
	<div class="container">
		<!-- <h2 class="border-title text-left">Dashboard</h2> -->
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
				<li><a  href="<?php echo site_url('author/edit_quiz/').$cid;?>">Quiz</a></li>
				<li><a  href="<?php echo site_url('author/edit_certificate/').$cid;?>">Certificate</a></li>
				<li class="active"><a  href="<?php echo site_url('author/edit_evaluation/').$cid;?>">Evaluation</a></li>
				<?php if($uins == '0'){ ?>
				    <li ><a href="<?php echo site_url('author/edit_promotion/').$cid;?>">Promotion</a></li>
				<?php } ?>
				<li><a  href="<?php echo site_url('author/edit_publish/').$cid;?>">Publish</a></li>
			</ul>

			<div class="tab-content steps-detail">
				<!-- <a class="title-mobile" data-toggle="tab" href="#step1">Edit Evaluation</a> -->
				<h3>Edit Evaluation</h3>
				<form action="<?php echo site_url('author/edit_evaluation');?>" method="post" enctype="multipart/form-data" name="form1" id="form1" class="mb-3">
					<div id="step1" class="tab-pane fade in active">
						<?php echo $this->session->flashdata('response');?>
						<?php $coursedatas = $this->user->get_record_by_field_name_all_record('tbl_course','id',$this->uri->segment(3)); ?>
					<div class="row">
						<input type="hidden" name="course_idd" id="course_idd" value="<?php echo $this->uri->segment(3);?>">
						<div class="form-group">
							<label>Evaluation Note </label>
							<textarea class="form-control text_editor" name="evaluation_description"><?php echo set_value('evaluation_description'); ?><?php echo $coursedatas[0]['course_evaluation_note']?></textarea>
							<span class="error"><?php echo  form_error('evaluation_description'); ?></span>
						</div>
					
					<?php  $count = 1;
					foreach ($evaluation as $key => $value){	?>
						<!-- <div class="col-sm-12">
							<div class="row"> -->
							<div style="display: flex; align-items: center;">
								<div class="form-group col-md-3">
									<label>Select Question Type :</label>
								</div>
								<div class="form-group col-md-3">
									<input type="hidden" name="id[]" value="<?=$value['id'];?>">
									<input type="radio" name="evaluation_type_old[<?=$key?>];?>" value="1" <?php if($value['evaluation_type']=='1'){ echo 'checked'; } ?>> <span class="mode-span">Star Rating Question</span>
								</div>
								<div class="form-group col-md-3">
									<input type="radio" name="evaluation_type_old[<?=$key?>];?>" value="2" <?php if($value['evaluation_type']=='2'){ echo 'checked'; } ?>> <span class="mode-span">Text Answer Question</span>
								</div>
							</div>
							<div style="display: flex; align-items: center;">
								<div class="form-group col-md-1">
									<label><b><?php echo $count; ?>.</b></label>
								</div> 
								<div class="form-group col-md-9">
									<input required type="text" name="question_old[]" class="form-control" placeholder="Enter Question" value="<?php echo $value['evaluation_question'];?>">
								</div>
								<div class="form-group col-md-2">
									<a onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/evaluationdelete/'.$value['id'].'/'.$value['course_id'].'');?>"><input type="button" class="btn-danger" value="Delete"></a>
								</div>	
								</div>
						<!-- 	</div>
						</div> -->
					<?php $count++; } ?>

						<div class="after-add-more">
							<!-- <div class="row"> -->
								<div style="display: flex; align-items: center;">
									<div class="form-group col-md-3">
										<label>Select Question Type :</label>
									</div>
									<div class="form-group col-md-3">
										<input type="radio" name="evaluation_type[0]" value="1" checked> <span class="mode-span">Star Rating Question</span>
									</div>
									<div class="form-group col-md-3">
										<input type="radio" name="evaluation_type[0]" value="2"> <span class="mode-span">Text Answer Question</span>
									</div>
								</div>
								<div style="display: flex; align-items: center;">
									<div class="form-group col-md-9">
										<input type="text" name="question[]" class="form-control" placeholder="Enter Evaluation Question Here">
									</div>
									<div class="form-group col-md-3 change">
										<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
									</div>
								</div>
							<!-- </div> -->
						</div>

						<p>
							<input type="submit" class="btn btn-primary btn-lg" name="submit" value="SAVE & NEXT">
						</p>

						<div class="form-group">
							<h3>Demo Evaluation on Ceonpoint</h3>
							<div style="border: 2px solid #0936b4;border-radius: 5px; margin: 5px 5px;">
								<img src="<?php echo ASSETS_URL.'images/evaluation_demo_img.png'?>">
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

<style type="text/css">
[type=radio]:checked + span {
    border: 2px solid rgb(32, 223, 128);
    box-shadow: 0 0 10px rgba(32,223,128,.4);
    position: relative;
}
.mode-span{
	padding: 5px;
}

</style>

<script type="text/javascript">

$(document).ready(function() {
    	var totaleditor = 1;
    $("body").on("click", ".add-more", function() {
    	totaleditor++;
    	var html = $(".after-add-more").append('<div style="display: flex; align-items: center;">\
								<div class="form-group col-md-3">\
									<label>Select Question Type :</label>\
								</div>\
								<div class="form-group col-md-3">\
									<input type="radio" name="evaluation_type['+ totaleditor +']" value="1" checked> <span class="mode-span">Star Rating Question</span>\
								</div>\
								<div class="form-group col-md-3">\
									<input type="radio" name="evaluation_type['+ totaleditor +']" value="2"> <span class="mode-span">Text Answer Question</span>\
								</div>\
							</div>\
							<div style="display: flex; align-items: center;">\
								<div class="form-group col-md-9">\
									<input type="text" name="question['+ totaleditor +']" class="form-control" placeholder="Enter Evaluation Question Here">\
								</div>\
								<div class="form-group col-md-3 change">\
									<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>\
								</div>\
							</div>');
    	// totaleditor++;
        // var html = $(".after-add-more").first().clone().find("input:text").val("").end();
        //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
        $(html).find(".change").html("<button class='btn btn-success add-more' type='button'><i class='glyphicon glyphicon-plus'></i> Add</button><a class='btn btn-danger remove' style='padding: 5px 10px;margin-left: 5px;'>Remove</a>");
        $(".after-add-more").last(html).after(html);
	});
    $("body").on("click", ".remove", function() {
        $(this).parents(".after-add-more").remove();
    });
});

</script>



