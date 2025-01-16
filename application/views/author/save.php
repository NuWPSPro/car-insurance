<?php $this->load->view('template/picture_author'); ?>



<div class="innerContent author-save">

	<div class="container">


		<div class="row">


		<?php 

		$this->load->view('author/sidebar');

		?>	

	<div class="col-sm-9"> 
			<div class="step-wise-query">
			<div class="tab-content steps-detail">

			<a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>

			<div id="step1" class="tab-pane fade in active">
				<?php if(!empty($this->session->userdata('current_course_id')))
				{
					$cid = $this->session->userdata('current_course_id');
				}else{
					$cid = $this->uri->segment(3); 
				}

					$result = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();
					//print_r($result);
				?>

				<h3>Congratulations!</h3>
				<p>Your online Course <strong><?php echo $result['course_title']; ?></strong> is Successfully <strong>Saved</strong>.</p>
				<p>Please click the link to view your online course.</p>
				<p>Click here : <a style="font-size: 20px;" href="<?php echo base_url('/pages/course_details/').$result['id']; ?>" title="view"  target="_blank"><?php echo base_url('/pages/course_details/').$result['id']; ?>.</a></p>

				

			 

			  </div>

			</div>

		  </div>

		</div>

		

		</div>

	</div>

</div>

  

</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>







 

 



 