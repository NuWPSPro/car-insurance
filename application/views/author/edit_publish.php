<?php $this->load->view('template/picture_author'); ?>
<?php 
		$uid = $this->session->userdata('logged_in')['id']; 
	  	$uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
	  	$up_id = end(explode('-', $uprovider)); 
	  	$uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
	  	?>
<div class="innerContent author-edit-publish">
	<div class="container">
		<div class="row">

		<?php $this->load->view('author/sidebar');
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
		<li><a  href="<?php echo site_url('author/edit_evaluation/').$cid;?>">Evaluation</a></li>
		<?php if($uins == '0'){ ?>
		<li ><a href="<?php echo site_url('author/edit_promotion/').$cid;?>">Promotion</a></li>
		<?php } ?>
		<li class="active"><a  href="<?php echo site_url('author/edit_publish/').$cid;?>">Publish</a></li>
	</ul>
	<div class="tab-content steps-detail">
			<div id="step1" class="tab-pane fade in active">
				<h3>Edit Publish</h3>		
			<div class="row">
			<?php echo $this->session->flashdata('response');
			$course = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();?> 	 
				
				<div class="col-sm-2">
				<?php if($course['status'] != 1){ ?>
					<a href="<?php echo site_url('author/save/'.$cid);?>">
					<input type="submit" class="btn btn-info btn-lg publishsave" value="Save Only" style="background: orange;"></a>
				<?php }else{ ?>
					<a href="javascript:void(0)" onclick="alert('This course is already Published,You can not change it\'s status. Please contact to Administrator!');">
					<input type="submit" class="btn btn-info btn-lg publishsave" value="Save Only" style="background: orange;"></a>
				<?php } ?>
				</div>
				<div class="col-sm-2">
				<?php if($course['status'] != 1){ ?>
					<a href="<?php echo site_url('author/successedit/'.$cid);?>"><input type="submit" class="btn btn-info btn-lg publishsave" value="Submit To CE Provider" style="background: green;">
					</a>
				<?php }else{ ?>
					<a href="javascript:void(0)" onclick="alert('This course is already Published,You can not change it\'s status. Please contact to Administrator!');"><input type="submit" class="btn btn-info btn-lg publishsave" value="Submit To CE Provider" style="background: green;"></a>
				<?php } ?>
				</div>
			</div>
			<!-- <div class="row mt-5">
			    <div class="col-sm-12">
					<a href="<?php echo site_url('author/overview/'.$cid);?>" class="mr-2"><input type="submit" class="btn btn-info btn-lg publishsave" value="Create New Online Course" style="background: orange;">
					</a>
					<a href="<?php echo site_url('author/course_listing/2/'.$cid);?>"><input type="submit" class="btn btn-info btn-lg publishsave" value="View The Submitted Online Course" style="background: orange;">
					</a>
				</div>
			</div> -->
			</div>
			</div>
			</div>
		</div>
		</div>
	</div>
</div>
</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>