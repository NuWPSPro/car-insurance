
<?php 
$price 	  = $this->db->get_where('tbl_all_tax',array('id'=>6,'status'=>1))->row_array();
$trid     = $this->uri->segment(3);
$training = $this->user->get_record_by_field_name_all_record('tbl_training','id',$trid);
$training_details = $this->db->get_where('tbl_training',array('id' => $trid))->row_array();
$uid = $this->session->userdata('logged_in')['id'];
$userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
$under_insititution = $userdata['under_insititution']; 

$getdc =   $this->provider_model->get_usage_of_subscribed_digital_package($uid);
$getAllSubscripedPackages =   $this->provider_model->subscriped_packages($uid);
$noOfUsedCertificate = ($getdc!='')?count($getdc):0;
$noOfCertificateInSubscripedPackages = ($getAllSubscripedPackages!='')?count($getAllSubscripedPackages):0;
if($noOfCertificateInSubscripedPackages - $noOfUsedCertificate > 0){
    $subscriptionStatus = 'y';
}else{
    $subscriptionStatus = 'n';
}

// echo '<pre>'; print_r($current_subscription); ?>

<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
	<div class="container">
		<div class="row">
			<?php  $training_types = ($training_details['training_type']==1)?'pro':'free';   ?>
            <div class="col-sm-12">
				<div class="step-wise-query provider-overview">
					<?php $this->load->view('provider/training_menu_edit');  ?>
					<div class="tab-content steps-detail">
							
			<div class="row">
				<?php echo $this->session->flashdata('response'); ?>
				<div class="col-sm-2 form-group">
					<?php if($training_details['status'] != 2){ ?>
					<form method="post" action ="<?php echo site_url('provider/training_save/'.$trid);?>">
						<input type="submit" name="Save Only" class="btn btn-primary btn-lg" value="Save Only">
					</form>
					<?php }else{ ?>
					<a href="javascript:void(0)" onclick="alertmsg();"><input type="submit" class="btn btn-success btn-lg" value="SAVE ONLY"></a>
					<?php } ?>
				</div>
	
				<div class="col-sm-4 form-group" id="pay">
				<?php  if($training_details['status'] != 2)
						{
							if($this->session->userdata('logged_in')['under_insititution'] == 0)
							{ 
								if($training_details['accreditation_no'] !='' && $accreditation_no['accreditation_validity'] != 0)
								{ 
									if($training_types == 'pro')
									{ 
										echo '<span style="color: red;">TMS Pro Template Fee $'.$price['total_amount'].'</span>
											<a onclick="pay_now();" href="javascript:void(0);" class="btn btn-danger btn-lg"> Pay & Publish </a>';
									}
									else
									{ 
									echo '<form method="post" action ="'.site_url('provider/training_publish_edit/'.$trid).'">
											<input type="submit" class="btn btn-danger btn-lg" name="submit" value="Publish">
										</form>'; 
									} 
								}
								else
								{
									echo '<a href="javascript:void(0)" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#accreditationModal">Publish</a>';
								}	
							}
							else
							{ 
								if($subscriptionStatus != 'y' && $this->session->userdata('logged_in')['under_insititution']=='1'){ 
									echo '<a href="javascript:void(0);" class="btn btn-danger btn-lg buyDigiPrepaid">Publish</a>';
								}else{ 
									echo '<form method="post" action ="'.site_url('provider/training_publish_edit/'.$trid).'">
									<input type="submit" class="btn btn-danger btn-lg" name="submit" value="Publish">
									</form>'; 
								}
							} 
						}
						else
						{
							echo '<a href="javascript:void(0)" onclick="alertmsg()"><input type="submit" class="btn btn-danger btn-lg" name="submit" value="Publish"></a>';
						} ?>
				</div>
				<!-- <div class="col-sm-4 form-group">
					<a href="<?php echo site_url('provider/training_save_submit/'.$cid);?>">
						<input type="submit" class="btn btn-primary btn-lg publishsave" value="Save and submit for Accreditation" onclick="alert('Coming Soon!');">
					</a>
				</div> -->	
			</div> 
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<form action="<?php echo base_url('provider/paypal_training_publish'); ?>" method="post" name="publishTraining" id="publishTraining">
    <input type="hidden" name="item_name" id="item_name" value="">
    <input type="hidden" name="training_id" id="training_id" value="<?php echo $trid; ?>">
    <input type="hidden" name="training_type" id="training_type" value="1">
    <input type="hidden" name="amount" id="amount" value="<?php echo $price['total_amount']; ?>">
    <input type="hidden" name="base_price" id="base_price" value="<?php echo $price['base_price']; ?>">
    <input type="hidden" name="tax" id="tax" value="<?php echo $price['tax_amount']; ?>">
</form>

<div id="payby" class="modal fade" role="dialog">
    <div class="modal-dialog modal-centered">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">Choose Payment Option</h4>
        </div>
        <div class="modal-body text-center">
			<a href="javascript:void(0)" onclick="paybypaypal();" class="btn"><img src="<?=base_url('assets/images/paypallogo.png') ?>" style="height:40px; width:100px;"></a>
            <a href="javascript:void(0)" onclick="paybystrip();" class="btn"><img src="<?=base_url('assets/images/OIP.jpg') ?>" style="height:40px; width:100px;">(Card)</a>
            <a href="javascript:void(0)" onclick="paybypayu();" class="btn"><img src="<?=base_url('assets/images/payu.jpg') ?>" style="height:40px; width:100px;"></a>
			<!-- <a href="javascript:void(0)" onclick="paybypaypal();" class="btn btn-primary"> PayPal</a>  -->
        	<!-- <a href="javascript:void(0)" onclick="paybypayu();" class="btn btn-warning">PayU Money</a> -->
          	<!-- <a href="javascript:void(0)" onclick="paybystrip('<?php echo $course[0]['total']; ?>');" class="btn btn-info"> Card</a> -->
        </div>
      </div>
    </div>
</div>


<!-- Modal -->
<div id="accreditationModal" class="modal fade in" role="dialog">
  <div class="modal-dialog modal-sm" style="top: 65%;transform: translate(0, -85%);">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Accreditation Verification</h4>
      </div>

	<form action="<?php echo base_url('provider/addtcAccreditation'); ?>" method="post">
	
	<p>Your training Don\'t have Acceditation Number. Please fill this to publish the training. </p>
		<div class="modal-body">
			<div class="form-group">
				<label for="accreditation_num">Accreditation number <sup>*</sup></label>
				<input type="text" class="form-control" id="accreditation_num" name="accreditation_num" required>
				<input type="hidden" name="training_id" value="<?php echo $trid; ?>">
				<input type="hidden" name="provider_id" value="<?php echo $training_details['user_id']; ?>">
				<input type="hidden" name="training_name" value="<?php echo $training_details['title']; ?>">
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

<!-- Modal -->
<div id="uploadAccreditationDoc" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Accreditation Verification</h4>
      </div>

	<form action="<?php echo base_url('provider/uploadTCAccreditationDoc'); ?>" method="post" enctype="multipart/form-data">
		<div class="modal-body">
		<?php echo $this->session->flashdata('response'); ?>
			<div class="form-group">
				<label for="accreditation_doc">Please upload your certificate of accreditation<sup>*</sup></label>
				<input type="file" class="form-control" id="accreditation_doc" name="accreditation_doc" required>
				<input type="hidden" name="training_id" value="<?php echo $trid; ?>">
				<input type="hidden" name="provider_id" value="<?php echo $training_details['user_id']; ?>">
				<input type="hidden" name="training_name" value="<?php echo $training_details['title']; ?>">
			</div>

			<div class="text-center">
				<p>Please allow 24 hours for admin to verify your document.</p>
				<?php if($training_details['accreditation_verification_doc'] != ''):?>
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
<div id="publishTraining" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm" style="top: 50%;transform: translate(0, -85%);">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
        <h4 class="modal-title text-center">Publish</h4>
      </div>

		<div class="modal-body text-center">
		<?php echo $this->session->flashdata('response'); ?>
		<?php echo '<form method="post" action ="'.site_url('provider/training_publish_edit/'.$trid).'">
					<input type="submit" class="btn btn-danger btn-lg" name="submit" value="Publish" onclick="unsetsessionDigital()">
				</form>'; ?>
		</div>
    </div>

  </div>
</div>




<?php $trainingname	= $training_details['title'].' - TMS Pro Template'; ?>
<script type="text/javascript">
	
	$( document ).ready(function() {
		<?php if($_SESSION['wrongtcacc']=='Wrong Accreditation'){ ?>
			$('#uploadAccreditationDoc').modal('show');
		<?php } ?>

		<?php if($_SESSION['digitallyverified']=='Digitally Verified'): ?>
			alert('digitallyverified');
			$('#publishTraining').modal('show');
		<?php endif;?>
		$('.buyDigiPrepaid').click(function(){
			var c = confirm('Please buy Pre-paid Digital Certificate package to publish the training, click ok to go to packages page.');
			if(c == true){
				window.location.href = '<?php echo base_url('provider/pre_paid_package')?>';
			} 
		});
	});
	function unsetsessionAcc(){
		<?php unset($_SESSION['wrongtcacc']); ?>
	}
	function unsetsessionDigital(){
		<?php unset($_SESSION['digitallyverified']); ?>
	}
	function paybypaypal(){
		var item_name 	= '<?php echo $training_details['title'].' - TMS Pro Template'; ?>';
		$('#item_name').val(item_name);
		$("#publishTraining").submit();
	}
	function pay_now() {
		$('#payby').modal('show');
	}
	
	function alertmsg(){
		alert('This Training is already Published,You can not change it\'s status. Please contact to Administrator!');
	}
		
	function paybypayu() {
    	window.location.href ='<?php echo base_url('payu/index').'?id='.$trid.'&&name='.$trainingname.'&&price='.$price['total_amount'].'&&tax='.$price['tax_amount'].'&&type=training publish';?>';
  	}

	function paybystrip() {
		window.location.href ='<?php echo base_url('stripe/index').'?id='.$trid.'&&name='.$trainingname.'&&price='.$price['total_amount'].'&&tax='.$price['tax_amount'].'&&type=Training Publish';?>';
	}
	function updateAcc(){
		var x = confirm('Your training Don\'t have Acceditation Number. Click ok to put Acceditation Number.');
		if(x == true){
			// window.location.href="<?php // echo base_url('provider/') ?>";
			$('#accreditationModal').modal('show');
		}
	}
</script>