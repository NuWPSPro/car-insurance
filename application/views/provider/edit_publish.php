<?php 
		$cid  = $this->uri->segment(3);
		$uid = $this->session->userdata('logged_in')['id'];
		if(!empty($cid)){ $course_id = $cid; }else{ $course_id = $id;}
		$course_details = $this->user->get_record_by_field_name_all_record('tbl_course','id',$course_id);
		$getdc =   $this->provider_model->get_usage_of_subscribed_digital_package($uid);
		$getAllSubscripedPackages =   $this->provider_model->subscriped_packages($uid);
		$noOfUsedCertificate = ($getdc!='')?count($getdc):0;
		$noOfCertificateInSubscripedPackages = ($getAllSubscripedPackages!='')?count($getAllSubscripedPackages):0;
		if($noOfCertificateInSubscripedPackages - $noOfUsedCertificate > 0){
			$subscriptionStatus = 'y';
		}else{
			$subscriptionStatus = 'n';
		}

$this->load->view('template/picture_provider'); ?>

<div class="innerContent">
	<div class="container">
		<div class="row">
		<?php  $this->load->view('provider/sidebar');	?>	

	<div class="col-sm-9">
	<h3 class="mt-1"><?php echo $course[0]['course_title']; ?></h3>
		<div class="clearfix">
			<h3 class="border-title pull-left">Edit Publish</h3>
			<a href="<?=base_url('provider/course_listing')?>" class="btn btn-primary pull-right">Back to Online Course Listing</a>
		</div>

		<div class="step-wise-query">
 				<ul class="nav-tabs hidden-xs">
					<li><a href="<?php echo site_url('provider/course_edit/').$cid;?>">Overview</a></li>
					<li><a href="<?php echo site_url('provider/lesson_edit/').$cid;?>">Lessons</a></li>
					<li><a href="<?php echo site_url('provider/edit_quiz/').$cid;?>">Quiz</a></li>
					<li><a href="<?php echo site_url('provider/edit_certificate/').$cid;?>">Certificate</a></li>
					<li><a href="<?php echo site_url('provider/edit_evaluation/').$cid;?>">Evaluation</a></li>
					<?php if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ ?>
            		<li ><a href="<?php echo site_url('provider/edit_promotion/').$cid;?>">Promotion</a></li>
            		<?php } ?>
					<li class="active"><a  href="<?php echo site_url('provider/edit_publish/').$cid;?>">Publish</a></li>
				</ul>
				
			<div class="tab-content steps-detail">
				<div id="step1" class="tab-pane fade in active">
					
					<div class="row">
						<?php echo $this->session->flashdata('response');
						$course = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array(); ?> 
						
						<div class="col-sm-2 form-group">
						<?php if($course['status'] != 1){ ?>
							<a href="<?php echo site_url('provider/save/'.$cid);?>"><input type="submit" class="btn btn-success btn-lg" value="SAVE ONLY">
							</a>
						<?php }else{ ?>
						<a href="javascript:void(0)" onclick="alert('This course is already Published,You can not change it\'s status. Please contact to Administrator!');"><input type="submit" class="btn btn-success btn-lg" value="SAVE ONLY"></a>
					<?php } ?>
						</div> 
						
						<div class="col-sm-2 form-group">
						<?php 
						//$course['status'] != 1 
						if($course['status'] != 1){ 
								if($subscriptionStatus != 'y' && $this->session->userdata('logged_in')['under_insititution']=='1'){ ?>
									<a href="javascript:void(0);" class="btn btn-info btn-lg buyDigiPrepaid">Publish</a>
						<?php 	}else{ 
									if($course_details[0]['course_acceditation_number'] !='' && $course_details[0]['course_acceditation_number'] != 0){ ?>
										<form method="post" action ="<?php echo site_url('provider/edit_publish/'.$cid);?>">
											<input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
										</form>
							<?php	}else{
										// Your course Don\'t have Acceditation Number.
										// echo '<a href="javascript:void(0)" onclick="updateAcc();" class="btn btn-primary btn-lg">Publish</a>';
										echo '<a href="javascript:void(0)" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#accreditationModal">Publish</a>';
									}	
								}
							}else{ ?>
							<a href="javascript:void(0)" onclick="alert('This course is already Published,You can not change it\'s status. Please contact to Administrator!');"><input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish"></a>
						<?php } ?>
						</div>
						
						

					</div>
						<!-- <div class="col-sm-2 form-group">
							<a href="<?php echo site_url('provider/save_submit/'.$cid);?>"> -->
								<!--<input type="submit" class="btn btn-success btn-lg publishsave" value="Save and submit for Accreditation" onclick="alert('Coming Soon!');">-->
							<!-- </a> 
						</div>-->
					
				</div>
			</div>
		</div>
	</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="accreditationModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" style="top: 65%;transform: translate(0, -85%);">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Accreditation Deatils</h4>
      </div>

	<form action="<?php echo base_url('provider/addocAccreditation'); ?>" method="post">
		<div class="modal-body">
			<p>Your course Don\'t have Acceditation Number. Please fill this to publish the course </p>
			<div class="form-group">
				<label for="accreditation_num">Accreditation number <sup>*</sup></label>
				<input type="text" class="form-control" id="accreditation_num" name="accreditation_num" required>
				<input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
				<input type="hidden" name="provider_id" value="<?php echo $course_details[0]['user_id']; ?>">
				<input type="hidden" name="course_name" value="<?php echo $course_details[0]['course_title']; ?>">
			</div>
			<div class="form-group">
				<label for="accreditation_validity">Accreditation validity <sup>*</sup></label>
				<input type="date" class="form-control" id="accreditation_validity" name="accreditation_validity" required>
			</div>
			<!-- <div class="form-group">
				<label for="issued_by">Issued By <sup>*</sup></label>
				<input type="text" class="form-control" id="issued_by" name="issued_by" required>
			</div> -->
		</div>

	  	<div class="modal-footer text-center">
			<div class="text-center">
				<button type="submit" class="btn btn-primary" name="save_accreditation" value="Save Accreditation">Submit</button>
			</div>
		</div>
		
	  </form>
    </div>

  </div>
</div>

<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <!-- <input type="hidden" name="training_id" id="training_id" value="<?php echo $course_details[0]['id']; ?>"> -->
    <input type="hidden" name="item_name" id="item_name" value="<?php echo $course_details[0]['course_title']; ?>">
    <input type="hidden" name="item_number" id="item_number" value="<?php echo $cid; ?>">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="<?php echo $course_details[0]['user_id']; ?>">
    <input type="hidden" name="amount" id="amount" value="<?php echo $course_details[0]['price']; ?>">
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('provider/course_publish_cancel')?>">
    <input type="hidden" name="return" value="<?php echo site_url('provider/success/').$cid; ?>">
</form>

<!-- Modal -->
<div id="uploadAccreditationDoc" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Accreditation Verification</h4>
      </div>

	<form action="<?php echo base_url('provider/uploadOCAccreditationDoc'); ?>" method="post" enctype="multipart/form-data">
		<div class="modal-body">
		<?php echo $this->session->flashdata('response'); ?>
			<div class="form-group">
				<label for="accreditation_doc">Please upload your certificate of accreditation<sup>*</sup></label>
				<input type="file" class="form-control" id="accreditation_doc" name="accreditation_doc" required>
				<input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
				<input type="hidden" name="provider_id" value="<?php echo $course_details[0]['user_id']; ?>">
				<input type="hidden" name="course_name" value="<?php echo $course_details[0]['course_title']; ?>">
			</div>

			<div class="text-center">
				<p>Please allow 24 hours for admin to verify your document.</p>
				<?php if($course_details[0]['accreditation_verification_doc'] != ''):?>
					<button type="button" class="btn btn-warning" onclick="alert('Please wait for admin\'s reply. As you have already submitted the Accreditation verification doc.')">Upload</button>
				<?php else: ?>
					<button type="submit" class="btn btn-warning" name="upload_accreditation" value="Upload" onclick="unsetsessionAcc()">Upload</button>
				<?php endif; ?>
			</div>
		</div>
		
	  </form>
    </div>

  </div>
</div>

<!-- Publish Training Modal -->
<div id="publishCourse" role="dialog" class="modal fade in" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm " style="top: 50%;transform: translate(0, -85%);">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Publish</h4>
      </div>

		<div class="modal-body text-center">
		<?php echo $this->session->flashdata('response'); ?>
		<?php echo '<form method="post" action ="'.site_url('provider/edit_publish/'.$cid).'">
					<input type="submit" class="btn btn-danger btn-lg" name="submit" value="Publish" onclick="unsetsessionDigital()">
				</form>'; ?>
		</div>
    </div>

  </div>
</div>


<script type="text/javascript">
	$( document ).ready(function() {
		<?php if($_SESSION['digitallyocverified']=='Digitally Verified'): ?>
			$('#publishCourse').modal('show'); 
		<?php endif;?>
		<?php if($_SESSION['wrongocacc']=='Wrong Accreditation'): ?>
			$('#uploadAccreditationDoc').modal('show');
		<?php endif;?>
		$('.buyDigiPrepaid').click(function(){
			var c = confirm('Please buy Pre-paid Digital Certificate package to publish the course, click ok to go to packages page.');
			if(c == true){
				window.location.href = '<?php echo base_url('provider/pre_paid_package')?>';
			} 
		});
	});
	function unsetsessionAcc(){
		<?php unset($_SESSION['wrongocacc']); ?>
	}
	function unsetsessionDigital(){
		<?php unset($_SESSION['digitallyocverified']); ?>
	}
	function paynow(){
		document.getElementById("frmPayPal1").submit();
	}
	function updateAcc(){
		var x = confirm('Your course Don\'t have Acceditation Number. Click ok to put Acceditation Number.');
		if(x == true){
			// window.location.href="<?php // echo base_url('provider/') ?>";
			$('#accreditationModal').modal('show');

		}
	}
</script>


