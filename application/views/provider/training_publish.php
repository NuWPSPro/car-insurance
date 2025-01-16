
<?php 
$price 	  = $this->db->get_where('tbl_all_tax',array('id'=>6,'status'=>1))->row_array();
$trid     = $this->session->userdata('current_training_id');
$training = $this->user->get_record_by_field_name_all_record('tbl_training','id',$trid);
if(!empty($trid)){ $training_id = $trid; }else{ $training_id = $id;}
$training_details = $this->db->get_where('tbl_training',array('id' => $training_id))->row_array();?>

<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
	<div class="container">
		<div class="row">
		<?php  $training_types = $this->session->userdata('training_types');	?>
            <div class="col-sm-12">

                  <div class="pull-right">
                    <?php if($training_types=="pro"){ ?>
                        <a href="#"><input type="button" name="free" id="free" value="PROFESSIONAL VERSION" class="btn-danger"></a>
                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-primary"></a>
                    <?php }else{ ?>
                        <a href="#"><input type="button" name="free" id="free" value="FREE VERSION" class="btn-primary"></a>
                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-success"> </a>
                    <?php } ?>
                    </div>

			<h3 class="border-title text-left">Create Training / Seminar</h3>

			<div class="step-wise-query provider-overview">
				<?php 
					if(empty($id)){
						$this->load->view('provider/training_menu');
					}else{
						$this->load->view('provider/training_menu_edit'); 
					}  ?>


				<div class="tab-content steps-detail">
		 			<a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
						<div id="step1" class="tab-pane fade in active">
							<h3>Course Publish</h3>
							<div class="row">
								<?php echo $this->session->flashdata('response');?> 
						
					<!-- 	<div class="col-sm-4 form-group" id="save">
							<a href="<?php echo site_url('provider/training_save');?>">
								<input type="submit" class="btn btn-primary btn-lg" value="SAVE ONLY"></a>
					   </div> -->
					   	<div class="col-sm-2 form-group">
							<span>  </span>
							<?php if($training_details['status'] != 2){ ?>
							<form method="post" action ="<?php echo site_url('provider/training_save/'.$training_id);?>">
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
									// Your Training Don\'t have Acceditation Number.
									echo '<a href="javascript:void(0)" onclick="updateAcc();" class="btn btn-primary btn-lg">Publish</a>';
								}	
							}
							else
							{ 
								if($training_types=='pro')
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
						}
						else
						{
							echo '<a href="javascript:void(0)" onclick="alertmsg()"><input type="submit" class="btn btn-danger btn-lg" name="submit" value="Publish"></a>';
						} ?>
						</div>
							
						
						<!-- <div class="col-sm-2 form-group">
								<span>  </span>
								<a href="<?php echo site_url('provider/training_save_submit/'.$cid);?>">
									<input type="submit" class="btn btn-primary btn-lg publishsave" value="Save and submit for Accreditation" onclick="alert('Coming Soon!');">
								</a> 
							</div>-->
							
							</div> 
						</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

function paynoww(){
   	var amount = '<?php echo $price['total_amount']; ?>';
   	var uid 	= '<?php echo $uid; ?>';
   	var item_number 	= '<?php echo $training_id; ?>';
   	var item_name 	= '<?php echo $training_details[0]['title'].' - TMS Pro Template'; ?>';
   	// alert(amount +' - '+ uid +' - '+item_number  +' - '+ item_name);
   	$('#item_name').val(item_name);
   	$('#item_number').val(item_number);
   	$('#amount').val(amount);
   	$('#userid').val(uid);
   	$("#publishTraining").submit();
}
function alertmsg(){
	alert('This Training is already Published,You can not change it\'s status. Please contact to Administrator!');
}
</script>


<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="publishTraining" id="publishTraining">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name" value="">
    <input type="hidden" name="item_number" id="item_number" value="">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" id="userid" value="">
    <input type="hidden" name="amount" id="amount" value="">
    <input type="hidden" name="custom" id="custom" value="<?php echo $price['tax_amount'].'_'.$price['base_price']; ?>">
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('provider/training_promote_cancel/').$training_id?>">
    <input type="hidden" name="return" value="<?php echo site_url('provider/training_success'); ?>">
</form>