<?php 
$cid     = $this->session->userdata('current_course_id');
if(!empty($cid)){ $course_id = $cid; }else{ $course_id = $id;}
$uid = $this->session->userdata('logged_in')['id'];

$course_details = $this->user->get_record_by_field_name_all_record('tbl_course','id',$course_id);

$getdc =   $this->provider_model->get_usage_of_subscribed_digital_package($uid);
//echo '<pre>'; print_r($getdc); echo $uid;die;
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
		<?php $this->load->view('provider/sidebar'); ?>	

	<div class="col-sm-9">
			<h2><?php echo $course[0]['course_title']; ?></h2>	
			<h3 class="border-title text-left">Create Promotion</h3>
			<div class="step-wise-query provider-overview">
				<ul class="nav-tabs hidden-xs">
					<li><a  href="<?php echo site_url('provider/overview')?>">Overview</a></li>
					<li><a  href="<?php echo site_url('provider/lesson')?>">Lessons</a></li>
					<li><a  href="<?php echo site_url('provider/quiz')?>">Quiz</a></li>
					<li><a  href="<?php echo site_url('provider/certificate')?>">Certificate</a></li>
					<li><a  href="<?php echo site_url('provider/evaluation')?>">Evaluation</a></li>
					<?php 
		             if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ ?>
		            <li><a href="<?php echo site_url('provider/promotion')?>">Promotion</a></li>
		            <?php } ?>
					<li class="active"><a  href="<?php echo site_url('provider/publish')?>">Publish</a></li>
				</ul>
			<div class="tab-content steps-detail">
			<div id="step1" class="tab-pane fade in active">
				<h3>Publish</h3>
				<div class="row">
				<?php echo $this->session->flashdata('response');?> 	

					<div class="col-sm-2 form-group">
						<a href="<?php echo site_url('provider/save/'.$cid);?>"><input type="submit" class="btn btn-info btn-lg publishsave" value="Save Only" style="background: orange;">
						</a>
					</div>
					
					<div class="col-sm-2 form-group">
					<?php if($subscriptionStatus != 'y' && $this->session->userdata('logged_in')['under_insititution']=='1'){ ?>
						<a href="javascript:void(0);" class="btn btn-info btn-lg buyDigiPrepaid">Publish</a>
					<?php }else{ 
						if($course_details[0]['course_acceditation_number'] !='' && $course_details[0]['course_acceditation_number'] != 0){ ?>
						<form method="post" action ="<?php echo site_url('provider/publish/'.$cid);?>">
							<input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
						</form>
					<?php }else{
								// Your course Don\'t have Acceditation Number.
								echo '<a href="javascript:void(0)" onclick="updateAcc();" class="btn btn-primary btn-lg">Publish</a>';
							}	
						} ?>
					</div>

					
					<!-- <div class="col-sm-2 form-group">
						<a href="<?php echo site_url('provider/save_submit/'.$cid);?>"> -->
							<!--<input type="submit" class="btn btn-success btn-lg publishsave" value="Save and submit for Accreditation" onclick="alert('Coming Soon!');">-->
						<!-- </a>
					</div> -->

				</div>  
			</div>

			 
			</div>
			</div>
			
			
		</div>
		
		</div>
	</div>
</div>


<script type="text/javascript">
    function paynow(){
   	 	document.getElementById("frmPayPal1").submit();
   	}

	function updateAcc(){
		var x = confirm('Your course Don\'t have Acceditation Number. Click ok to put accr. number.');
		if(x == true){
			// window.location.href="<?php // echo base_url('provider/') ?>";
			$('#accreditationModal').modal('show');

		}
	}
</script>

<!-- Modal -->
<div id="accreditationModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Accreditation Deatils</h4>
      </div>

	<form action="<?php echo base_url('provider/addocAccreditation'); ?>" method="post">
		<div class="modal-body">
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
		</div>

	  	<div class="modal-footer text-center">
			<div class="text-center">
				<button type="submit" class="btn btn-primary" name="save_accreditation" value="Save Accreditation">Save Accreditation</button>
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
    <input type="hidden" name="cancel_return" value="<?php echo site_url()?>/provider/course_publish_cancel">
    <input type="hidden" name="return" value="<?php echo site_url('/provider/success/').$cid; ?>">
</form>