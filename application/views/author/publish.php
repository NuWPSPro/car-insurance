<?php $this->load->view('template/picture_author'); ?>
<?php 
		$uid = $this->session->userdata('logged_in')['id']; 
	  	$uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
	  	$up_id = end(explode('-', $uprovider)); 
	  	$uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
	  	?>
<div class="innerContent author-publish">
	<div class="container">
		<div class="row">
		<?php $this->load->view('author/sidebar');
		if(empty($this->uri->segment(3))){
			$cid = $this->session->userdata('current_course_id');
		}else{
			$cid = $this->uri->segment(3);
		}	?>
	<div class="col-sm-9">
		
                <h2><?php echo $course[0]['course_title']; ?></h2>
			<h3 class="border-title text-left">Create Course</h3>
			<div class="step-wise-query provider-overview">
			<ul class="nav-tabs hidden-xs">
				<li><a  href="<?php echo site_url('author/overview')?>">Overview</a></li>
				<li><a  href="<?php echo site_url('author/lesson')?>">Lessons</a></li>
				<li><a  href="<?php echo site_url('author/quiz')?>">Quiz</a></li>
				<li><a  href="<?php echo site_url('author/certificate')?>">Certificate</a></li>
				<li><a  href="<?php echo site_url('author/evaluation')?>">Evaluation</a></li>
				<?php if($uins == '0'){ ?>
	            <li><a href="<?php echo site_url('author/promotion')?>">Promotion</a></li>
	            <?php } ?>
				<li class="active"><a href="<?php echo site_url('author/publish')?>">Publish</a></li>
			</ul>
				
			<div class="tab-content steps-detail">
			<div id="step1" class="tab-pane fade in active">
				<h3>Publish</h3>
				<div class="row">
				<?php echo $this->session->flashdata('response');?> 	 
					<div class="col-sm-2 form-group">
						<a href="<?php echo site_url('author/save/'.$cid);?>">
							<input type="submit" class="btn btn-info btn-lg publishsave" value="Save Only" style="background: orange;">
						</a>
					</div>
					<div class="col-sm-4 form-group">
						<a href="<?php echo site_url('author/success/'.$cid);?>">
						<input type="submit" class="btn btn-primary btn-lg" value="Submit To CE Provider">
						</a>
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









 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>