<?php   $this->load->view('template/picture_author'); 
		$cid = $this->uri->segment(3); 
		$lid =  $this->uri->segment(4);
		$currentlesson = $this->user->get_record_by_field_name_all_record('tbl_lesson','id',$lid);	?>
<?php 
        $uid = $this->session->userdata('logged_in')['id']; 
        $uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
        $up_id = end(explode('-', $uprovider)); 
        $uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
        ?>
<div class="innerContent author-lesson-edit">
	<div class="container">
		<div class="row">
			<?php $this->load->view('author/sidebar'); ?>	
		<div class="col-sm-9">
            <h2 class="mt-0"><?php  echo $course[0]['course_title']; ?></h2>
			<h3 class="border-title text-left">Edit Course</h3>
			<div class="step-wise-query provider-overview">

			<ul class="nav-tabs hidden-xs">
				<li><a  href="<?php echo site_url('author/course_edit/').$cid;?>">Overview</a></li>
				<li class="active"><a  href="<?php echo site_url('author/lesson_edit/').$cid;?>">Lessons</a></li>
				<li><a  href="<?php echo site_url('author/edit_quiz/').$cid;?>">Quiz</a></li>
				<li><a  href="<?php echo site_url('author/edit_certificate/').$cid;?>">Certificate</a></li>
				<li><a  href="<?php echo site_url('author/edit_evaluation/').$cid;?>">Evaluation</a></li>
			<?php if($uins == '0'){ ?>
				<li><a href="<?php echo site_url('author/promotion').$cid; ?>">Promotion</a></li>
		 	<?php } ?>
				<li><a  href="<?php echo site_url('author/edit_publish/').$cid;?>">Publish</a></li>
			</ul>


		<div class="tab-content steps-detail">

			<div id="step1" class="tab-pane fade in active">
				<h3>Edit Lesson 
					<?php if($this->uri->segment(4)==""){ ?>
						<button style="float:right" class="btn btn-success add-more" data-id="1" type="button"><i class="glyphicon glyphicon-plus"></i> Add Lesson</button>
					<?php } ?>
				</h3>
			<form action="<?php echo site_url('author/lesson_edit/').$cid;?>" method="post" enctype="multipart/form-data"> 
			<div class="row">
				<?php echo $this->session->flashdata('response');?>
                    
                
					<input type="hidden" name="lidd" value="<?php echo $lid;?>">		
					<div class="col-sm-12 form-group">
						<label>Lessons Title </label>
						<input type="text"  class="form-control" name="lesson_title[]" value="<?php echo $currentlesson[0]['lesson_title']; ?>">
						<span class="error"><?php echo  form_error('lesson_title'); ?></span>
					</div>

					<div class="col-sm-12 form-group">
						<label>Attached Video </label>
						<input type="file"  class="form-control" name="lesson_video[]" value="<?php echo set_value('lesson_video'); ?>">
						<span class="error"><?php echo  form_error('lesson_video'); ?></span>
					</div>

					<?php if($currentlesson[0]['lesson_video']){  ?>
					<div class="col-sm-12 form-group">
						<video id="myVideo" width="320" height="240" controls autoplay>
						<source src="<?php echo ASSETS_URL.'images/uploads/video/'.$currentlesson[0]['lesson_video']; ?>" type="video/mp4">
						<source src="<?php echo ASSETS_URL.'images/uploads/video/'.$currentlesson[0]['lesson_video']; ?>" type="video/ogg">
						Your browser does not support the video tag.
						</video>
				    </div>
					<?php	}?>
					<div class="col-sm-12 form-group">
						<label>Lessons Content</label>
						<textarea class="form-control text_editor" name="lesson_content[]"><?php echo $currentlesson[0]['lesson_content']; ?></textarea>
						<span class="error"><?php echo  form_error('lesson_content'); ?></span>
					</div>

					<div class="col-sm-12 form-group">
						<label>Case Study</label>
						<textarea class="form-control text_editor" name="case_study[]"><?php echo $currentlesson[0]['case_study']; ?></textarea>
						<span class="error"><?php echo  form_error('case_study'); ?></span>
					</div>

			<!-- 	<?php if($this->uri->segment(4)==""){ ?>
					<div class="col-sm-12 form-group">
						<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add Lesson</button>
					</div>
				<?php } ?> -->
				<span id="copycontent"></span>
				<div class="col-sm-12 form-group">
					<label>Summary <sup>*</sup> </label>
					<textarea  class="form-control text_editor" name="summary" id="summary"><?php echo $lesson[0]['summary']; ?></textarea>
		     		<span class="error"><?php echo  form_error('summary'); ?></span>
				</div>

				<div class="col-sm-12 form-group">
					<label>References </label>
					<textarea  class="form-control text_editor" name="references" id="references"><?php echo $lesson[0]['course_references']; ?></textarea>
					<span class="error"><?php echo  form_error('references'); ?></span>
				</div>

				<div class="col-sm-2 form-group">
					<input type="submit" class="btn btn-primary btn-lg" value="SAVE & NEXT">
				</div>
			</div>
			</form>
			</div>
		</div>



		<div class="table-responsive">
		<table class="table table-striped table-bordered">
		<tr>
			<th>No.</th>
			<th>Lessons Title</th>
			<th>Lessons Content</th> 
			<th>Lesson Video Url</th> 
			
			<th>Action</th> 
		</tr>
		<?php $count = 1;  
			foreach ($lesson as $key => $value){ ?>

		<tr>
			<td><?php echo $count; ?>.</td>
			<td><?php echo $value['lesson_title'];?></td>
			<td> <a  href="javascript:void(0);" onclick="showcontaint('<?php echo strip_tags($value['lesson_content']);?>')"> View </a></td>
			<td><a  href="javascript:void(0);" onclick="showvideo('<?php echo ASSETS_URL.'images/uploads/video/'.$value['lesson_video'];?>')"><?php echo $value['lesson_video'];?></a></td>
			
			<td><a onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('author/lesson_delete/'.$cid.'/'.$value['id'].'');?>"><input type="button" class="btn-danger" value="Delete"></a>
			<a href="<?php echo site_url('author/lesson_edit/'.$cid.'/'.$value['id'].'');?>">
			<input type="button" class="btn-warning" value="Edit"></a></td> 

		</tr>
	<?php $count++; } ?>	 
	</table>
	</div>

		</div>	
		  </div>
		</div>
	</div>
</div> 
</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">lesson Content </h4>
        </div>
        <div class="modal-body" id="cont-bd">
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">lesson Video </h4>
        </div>
        <div class="modal-body">
        	<center>
          	<video width="320" height="240" controls  >
		       <source src="" id="video" type="video/mp4">
		       <source src="" id="video" type="video/ogg">
		       Your browser does not support the video tag.
	       	</video>
        </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
         $("#copycontent").append('<span id="copycontent'+lessioncount+'"><div style="float:right"><button type="button" style="margin: 0px 5px 0px 10px;" class="btn btn-success add-more" title="Add Lesson" data-id="'+lessioncount+'"><i class="glyphicon glyphicon-plus"></i></button><a class="btn btn-danger remove" style="margin: 0px 15px 0px 0px;" title="Remove Lesson" data-id="'+lessioncount+'"><b>X</b></a></div><div class="col-sm-12 form-group"><label>Lessons Title '+lessioncount+'</label><input type="text"  class="form-control" name="lesson_title[]" value=""><span class="error"><?php echo  form_error("lesson_title"); ?></span></div><div class="col-sm-12 form-group"><label>Attached Video </label><input type="file"  class="form-control" name="lesson_video[]" value=""><span class="error"><?php echo  form_error("lesson_video"); ?></span></div><div class="col-sm-12 form-group"><label>Lessons Content</label><textarea  class="form-control text_editor" name="lesson_content[]"></textarea><span class="error"><?php echo  form_error("lesson_content"); ?></span></div><div class="col-sm-12 form-group"><label>Case Study</label><textarea  class="form-control text_editor" name="case_study[]"></textarea><span class="error"><?php echo  form_error("case_study"); ?></span></div></span>');
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

    function  showcontaint(cont)
	  {
		  $('#myModal').modal('show');
		  $("#cont-bd").html(cont);
	  }

	  function  showvideo(cont)
	  {
		  $('#myModal1').modal('show');
		  $("#video").attr('src',cont);
	  }

</script>