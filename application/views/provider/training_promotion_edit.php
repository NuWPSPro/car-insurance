<?php 
$user_id        = $this->session->userdata('logged_in')['id'];
$institutionRow = $this->db->get_where('tbl_user',array('id'=>$user_id))->row_array();
$institutionId  = $institutionRow['parent_insititution'];
      $tid 		= $this->uri->segment(3);
      $trainingname = $this->db->get_where('tbl_training',array('id'=>$tid))->row_array(); ?>

<?php $this->load->view('template/picture_provider'); ?>

<div class="innerContent">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
					<div class="step-wise-query provider-overview">
						<?php $id = $this->uri->segment(3);?>

					<?php $this->load->view('provider/training_menu_edit'); ?>
				<?php $training_types = ($trainig_data[0]['training_type']==1)?'pro':'free'; ?>

		<div class="tab-content steps-detail">
		<form action="<?php echo site_url('provider/training_promotion_edit'); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
		<div class="row">
			<?php echo $this->session->flashdata('response');?>
			<div class="col-sm-12 form-group">
				<label>Promote <sup>*</sup></label>
				<select class="form-control" name="promote" id="promote" onchange="showbutton()">
					<option value="" >Please Select</option>
					<option value="0_1" <?php if($training[0]['paid_status']=='1'){echo'selected';}?>> Regular Promotion (Free) </option>
					<?php //if($institutionId) { ?>
					<option value="10_2" <?php if($training[0]['paid_status']=='2'){echo'selected';}?>>Featured Promotion</option>
				<?php //} ?>
				</select> 
				<input type="hidden" name="cid" id="cid" value="<?php echo $tid;?>">	
			</div>
			<div class="col-sm-2 form-group" id="next" style="display: none;">
				<button type="submit" class="btn btn-success" name="submit" value="Save_next">Save & Next</button>
			</div>
			<div class="col-sm-2 form-group" id="paynow" style="display: none;">
				<input type="button" class="btn btn-primary btn-lg" value="PAY NOW" onclick="paynows()">
			</div>

			<br>
			<br>
			<div class="col-sm-12 form-group" id="featured" style="display: none;">
				<div class="payform" >
					<?php	$dailyprices = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);			
					$dailprice=$dailyprices[0]['training_daily_price'];	?>
					<input type="hidden" id="course_dailyprice" name="course_dailyprice" value="<?php echo $dailprice; ?>"> 
					<div class="form-control"><a href="javascript:void(0)">$<?php echo $dailprice; ?>/day</a></div>
						<select class="form-control" id="traning_day" name="traning_day" onchange="traning_setprice(this.value)">
						<?php for($i=1; $i<=31;$i++){ ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?> Day</option>
						<?php } ?>
						</select>
					<div class="form-control" style="background-color: green;"><a href="javascript:void(0)" onclick="paynows()" id="traning_pricehtml">$<?php echo $dailprice; ?> Pay Now</a></div>
					<div class="clearfix"></div>
					<h5>Featured</h5>
					<p><?php echo $dailyprices[0]['text_training']?></p>
					<h3 class="border-title text-left">Featured promotion appearance</h3>
					<img src="<?php echo ASSETS_URL.'images/uploads/'.$dailyprices[0]['trainingimage']; ?>" alt="">
				</div>
			</div>

			<div class="col-sm-12 form-group" id="free" style="display: none;">
				<!-- <p style="font-weight: bold;">Regular Promotion (Free)</p> -->
				<h3 class="border-title text-left">Regular Promotion Appearance</h3>
				<img src="<?php echo ASSETS_URL.'images/regularlisting.png'; ?>" alt="">
			</div>
		</div> 
			</form>	

			<div class="col-sm-12 form-group" id="proversion" style="display: none;">
				<div class="col-sm-10">
					<span>Publish this training to Feature.</span>
				</div>
				<div class="col-sm-2">
					<?php if($institutionRow['under_insititution'] == 0){ 
						$redirect = base_url('provider/training_sponsors_edit/').$tid;  
					}else{ 
						$redirect = base_url('provider/training_publish_edit/').$tid;
					} ?>
					<a href="<?php echo $redirect; ?>" class="btn btn-success">Save & Next</a>
				</div>
				<div style="text-align: center;">
				<?php	$dailyprices = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);			
						$dailprice   = $dailyprices[0]['training_daily_price'];	?>
					<h5>Featured</h5>
					<p><?php echo $dailyprices[0]['text_training']?></p>
					<h3 class="border-title">Featured promotion appearance</h3>
					<img src="<?php echo ASSETS_URL.'images/uploads/'.$dailyprices[0]['trainingimage']; ?>" alt="">
				</div>
			</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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

<script type="text/javascript">
	$( document ).ready(function() {
		var option = $('#promote').val();
		var ttype = '<?php echo $trainingname['training_type']; ?>';

		if(ttype == 'free'){
			if(option=='0_1'){
				$('#free').show();
				document.getElementById("next").style.display='none';
				document.getElementById("proversion").style.display='none';
			}else{
				$('#featured').show();
				document.getElementById("paynow").style.display='block';
				document.getElementById("proversion").style.display='none';
			}
		}else{
			// $('#free').show();
			document.getElementById("form1").style.display='none';
			document.getElementById("proversion").style.display='block';
		}
	});
	function showbutton(){
		var quiz_course = $('#promote').val();
		$('#free').hide();
		$('#featured').hide();
		if(quiz_course=='0_1'){
			$('#free').show();
			document.getElementById("next").style.display='block';
			document.getElementById("paynow").style.display='none';
		} else {
			if(quiz_course=='10_2'){
				$('#featured').show();
			}	
		document.getElementById("next").style.display='none';
		document.getElementById("paynow").style.display='block';
		}
	}

   function paynows(){
   	// alert('ok');
     var dailprice = '<?php echo $dailprice; ?>';	
     var day = jQuery('#traning_day').val();	
     var totalprice = (dailprice*day).toFixed(2);
	 jQuery('#amount').val(totalprice);  
     var item_name = '<?php echo $trainingname['title']; ?> - Training Promotion';	 
	 $('#custom').val(day);  
	 $('#item_name').val(item_name);  
   	 jQuery('#trainingPromotion').submit();
   }

  function traning_setprice(day)
	{
		var dailprice='<?php echo $dailprice; ?>';		
		var totalprice=(dailprice*day).toFixed(2);
		if(day){
		    jQuery('#traning_pricehtml').html('$'+totalprice+' Pay Now');
		}else{
			jQuery('#traning_pricehtml').html('');
		}
	}
</script>

<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="trainingPromotion" id="trainingPromotion">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name">
    <input type="hidden" name="item_number" id="item_number" value="<?php echo $tid; ?>">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="<?php echo $user_id; ?>">
    <input type="hidden" name="amount" id="amount">
    <input type="hidden" name="custom" id="custom"><!--  //days -->
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('provider/training_promote_fail/').$tid; ?>">
    <input type="hidden" name="return" value="<?php echo site_url('provider/training_promote_success/').$tid; ?>">   
</form>
