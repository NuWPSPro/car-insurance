<?php $this->load->view('template/picture_provider'); ?>
<?php $coursedatas = $this->user->get_record_by_field_name_all_record('tbl_course','id',$this->uri->segment(3)); ?>

<div class="innerContent">
	<div class="container">
		<div class="row">
		<?php   $this->load->view('provider/sidebar');
				$cid = $this->uri->segment(3); ?>	
		<div class="col-sm-9">
			<h3 class="mt-1"><?php echo $course[0]['course_title']; ?></h3>
                <div class="clearfix">
                    <h3 class="border-title pull-left">Edit Evaluation</h3>
                    <a href="<?=base_url('provider/course_listing')?>" class="btn btn-primary pull-right">Back to Online Course Listing</a>
                </div>

			<div class="step-wise-query">
			<ul class="nav-tabs hidden-xs">
				<li><a  href="<?php echo site_url('provider/course_edit/').$cid;?>">Overview</a></li>
				<li><a  href="<?php echo site_url('provider/lesson_edit/').$cid;?>">Lessons</a></li>
				<li><a  href="<?php echo site_url('provider/edit_quiz/').$cid;?>">Quiz</a></li>
				<li><a  href="<?php echo site_url('provider/edit_certificate/').$cid;?>">Certificate</a></li>
				<li class="active"><a  href="<?php echo site_url('provider/edit_evaluation/').$cid;?>">Evaluation</a></li>

			<?php if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ ?>
    			<li ><a href="<?php echo site_url('provider/edit_promotion/').$cid;?>">Promotion</a></li>
			<?php } ?>

				<li><a  href="<?php echo site_url('provider/edit_publish/').$cid;?>">Publish</a></li>
			</ul>
			<div class="tab-content steps-detail">
				<div id="step1" class="tab-pane fade in active">
				
				<?php echo validation_errors(); ?> 	
				<form action="<?php echo site_url('provider/edit_evaluation');?>" method="post" enctype="multipart/form-data">
				<?php echo $this->session->flashdata('response');?>
					<div class="row">
						<input type="hidden" name="course_idd" id="course_idd" value="<?php echo $this->uri->segment(3);?>">
						<div class="form-group">
							<label>Evaluation Note </label>
							<textarea class="form-control text_editor" name="evaluation_description"><?php echo set_value('evaluation_description'); ?><?php echo $coursedatas[0]['course_evaluation_note']?></textarea>
							<span class="error"><?php echo  form_error('evaluation_description'); ?></span>
						</div>
					</div>
					<!-- <?php $count = 1;
						foreach ($evaluation as $key => $value){	?>
						<div class="row d-flex">
							<div class="form-group col-sm-4">
								<label>Select Question Type :</label>
							</div>
							<div class="form-group col-sm-6">
								<input type="hidden" name="id[]" value="<?=$value['id'];?>">
								<input type="radio" name="evaluation_type_old[<?=$key?>];?>" value="1" <?php if($value['evaluation_type']=='1'){ echo 'checked'; } ?>> <span class="mode-span">Star Rating Question</span>
								<input type="radio" name="evaluation_type_old[<?=$key?>];?>" value="2" <?php if($value['evaluation_type']=='2'){ echo 'checked'; } ?>> <span class="mode-span">Text Answer Question</span>
							</div>
						</div>
						<div class="row d-flex">
							<div class="form-group col-sm-8"> 
								<?php echo '<b>'.$count.'. </b> '.$value['evaluation_question'];?>
							</div>
							<div class="form-group col-sm-4">
								<a class="btn btn-danger pull-right deleteEvaluation" data-id="<?php echo $value['id']; ?>" data-value="<?php echo $value['course_id']; ?>" href="javascript:void(0);">Delete</a>
								<a class="btn btn-primary pull-right editEvaluation" data-id="<?php echo $value['id']; ?>" data-value="<?php echo $value['course_id']; ?>" data-question="<?php echo $value['evaluation_question']; ?>" data-type="<?php echo $value['evaluation_type']; ?>" data-status="<?php echo $value['status']; ?>"  href="javascript:void(0);">Edit</a>
							</div>	
						</div>
						<hr>
					<?php $count++;	} ?> -->
					<div class="row">
						<div class="after-add-more">
							<!-- <div class="row"> -->
							<div class="d-flex">
								<div class="form-group col-sm-4">
									<label>Select Question Type :</label>
								</div>
								<div class="form-group col-sm-6">
									<input type="radio" name="evaluation_type[0]" value="1" checked> <span class="mode-span">Star Rating Question</span>
									<input type="radio" name="evaluation_type[0]" value="2"> <span class="mode-span">Text Answer Question</span>
								</div>
							</div>
							<div class="d-flex">
								<div class="form-group col-sm-8">
									<input type="text" name="question[0]" class="form-control" placeholder="Enter Evaluation Question Here">
								</div>
								<div class="form-group col-sm-4">
									<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
								</div>
							</div>
							<!-- </div> -->
						</div>

						<p>
							<input type="submit" class="btn btn-primary btn-lg" value="SAVE & NEXT">
						</p>
							
						<div class="form-group">
							<h3>Demo Evaluation on Ceonpoint</h3>
							<div style="border: 2px solid #0936b4;border-radius: 5px; margin: 5px 5px;">
								<img src="<?php echo ASSETS_URL.'images/evaluation_demo_img.png'?>">
							</div>
						</div>
					</div>
				</div>
				</form>
					<div class="row">
						
			<div class="card">
				<div class="card-body">
					<div class="responsive-table">
						<table class="table">
							<thead>
								<tr>
									<th>Sl.no.</th>
									<th>Type</th>
									<th>Question</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 1;
									foreach($evaluation as $key => $value): ?>
								<tr>
									<td><?=$count; ?></td>
									<td><?=($value['evaluation_type']=='1')?'Rating':'Text Box'; ?></td>
									<td><?=$value['evaluation_question']; ?></td>
									<td><?=($value['status']=='1')?'Active':'Inactive'; ?></td>
									<td>
										<a class="btn btn-primary editEvaluation" data-id="<?php echo $value['id']; ?>" data-value="<?php echo $value['course_id']; ?>" data-question="<?php echo $value['evaluation_question']; ?>" data-type="<?php echo $value['evaluation_type']; ?>" data-status="<?php echo $value['status']; ?>"  href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
										<a class="btn btn-danger deleteEvaluation" data-id="<?php echo $value['id']; ?>" data-value="<?php echo $value['course_id']; ?>" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php $count++; endforeach; ?>
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
</div>
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

<!-- The modal -->
<div class="modal fade" id="editEvaluationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modalLabel">Edit Evaluation Question</h4>
			</div>
			<form action="<?php echo site_url('provider/update_one_evaluation'); ?>" method="post">
			<div class="modal-body">
				<div class="row d-flex">
					<div class="form-group col-sm-4">
						<label>Select Question Type :</label>
					</div>
					<div class="form-group col-sm-6">
						<input type="hidden" name="id" id="pid" value="">
						<input type="hidden" name="cid" id="pcid" value="">
						<input type="radio" name="evaluation_type" id="pevaluation_type1" value="1"> <span class="mode-span">Star Rating Question</span>
						<input type="radio" name="evaluation_type" id="pevaluation_type2"  value="2"> <span class="mode-span">Text Answer Question</span>
					</div>
				</div>
				<div class="row d-flex">
					<div class="form-group col-sm-4">
						<label>Evaluation Question :</label>
					</div>
					<div class="form-group col-sm-8"> 
						<input type="text" class="form-control" name="evaluation_question" id="pevaluation_question" value="">
					</div>	
				</div>
				<div class="row d-flex">
					<div class="form-group col-sm-4">
						<label>Status :</label>
					</div>
					<div class="form-group col-sm-6">
						<input type="radio" name="status" id="pstatus1" value="1"> <span class="mode-span">Active</span>
						<input type="radio" name="status" id="pstatus0"  value="0"> <span class="mode-span">Inactive</span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Update</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
    	var totaleditor = 1;
    $("body").on("click", ".add-more", function() {
    	totaleditor++;
    	var html = $(".after-add-more").append('<div class="d-flex">\
								<div class="form-group col-sm-4">\
									<label>Select Question Type :</label>\
								</div>\
								<div class="form-group col-sm-6">\
									<input type="radio" name="evaluation_type['+ totaleditor +']" value="1" checked> <span class="mode-span">Star Rating Question</span>\
									<input type="radio" name="evaluation_type['+ totaleditor +']" value="2"> <span class="mode-span">Text Answer Question</span>\
								</div>\
							</div>\
							<div class="d-flex">\
								<div class="form-group col-sm-8">\
									<input type="text" name="question['+ totaleditor +']" class="form-control" placeholder="Enter Evaluation Question Here">\
								</div>\
								<div class="form-group col-sm-4 change">\
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

$('.deleteEvaluation').on('click', function(){
	var q = confirm('Are you sure, you want to delete it?');
	if(q == true){
		var path = "<?php echo base_url('provider/evaluationdelete/');?>";
		var id = $('.deleteEvaluation').attr('data-id');  
		var cid = $('.deleteEvaluation').attr('data-value');
		window.location.href = path+'/'+id+'/'+cid;
	}
});

$('.editEvaluation').on('click', function(){
	var id = $('.editEvaluation').attr('data-id');  
	var cid = $('.editEvaluation').attr('data-value');
	var question = $('.editEvaluation').attr('data-question');
	var type = $('.editEvaluation').attr('data-type');
	var status = $('.editEvaluation').attr('data-status');

	$('#pid').val(id);
	$('#pcid').val(cid);
	if(type == 1){
		$('#pevaluation_type1').val(type).prop('checked', true);
	}else{
		$('#pevaluation_type2').val(type).prop('checked', true);
	}
	if(status == 1){
		$('#pstatus1').val(status).prop('checked', true);
	}else{
		$('#pstatus0').val(status).prop('checked', true);
	}

	$('#pevaluation_question').val(question);
	$('#editEvaluationModal').modal('show');
});
</script>