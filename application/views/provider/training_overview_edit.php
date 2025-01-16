<style>
	.multiselect-container{
	     height: 300px;
	     overflow: scroll; 
	}
	button.multiselect.dropdown-toggle.btn.btn-default {
	    background-color: #007ded;
	    color: white;
	}
</style>

<?php $this->load->view('template/picture_provider'); ?>
<?php $id = $this->uri->segment(3); ?>
<?php $this->db->order_by('cat_name','asc');
      $cat = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
	  $explodedData = explode(',', $trainig_data[0]['participants']);
	 // echo '<pre>';print_r($trainig_data); die; ?>
	<div class="innerContent">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					
					<div class="step-wise-query provider-overview"> 
						<?php $this->load->view('provider/training_menu_edit'); ?>
						<?php $training_types = ($trainig_data[0]['training_type']==1)?'pro':'free'; ?>
					
						<div class="tab-content steps-detail">
							<form action="<?php echo site_url('provider/training_overview_edit/').$id;?>" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
								<div class="row">
									<?php echo $this->session->flashdata('response');?>
									<input type="hidden" name="training_id" id="training_id" value="<?php echo $this->uri->segment(3);?>">
									<div class="col-sm-12 form-group">
										<label for="description">Description <sup>*</sup></label>
										<textarea class="form-control text_editor" name="description" id="description"><?php echo $trainig_data[0]['description']; ?></textarea>
										<span class="error"><?php echo  form_error('description'); ?></span>
									</div>
									<div class="col-sm-12 form-group">
										<label for="objectives">Objectives <sup>*</sup></label>
										<textarea class="form-control text_editor" name="objectives" id="objectives"><?php echo $trainig_data[0]['objectives']; ?></textarea>
										<span class="error"><?php echo  form_error('objectives'); ?></span>
									</div>
									<div class="col-sm-12 form-group">
										<label for="methodologies">Methodologies <sup>*</sup></label>
										<textarea class="form-control text_editor" name="methodologies" id="methodologies"><?php echo $trainig_data[0]['methodologies']; ?></textarea>
										<span class="error"><?php echo  form_error('methodologies'); ?></span>
									</div>

									<?php if($training_types=="pro"){ ?>
									<div class="col-sm-12 form-group">
										<label for="background_image">Speaker's Page Background Image</label>
										<input type="file" class="form-control" id="background_image" name="background_image"> 
										<span class="error"><?php echo  form_error('background_image'); ?></span>
										<img src="<?php echo ASSETS_URL.'images/uploads/'.$trainig_data[0]['background_image']; ?>" width="150">
									</div>
									<?php } ?>

									<div class="col-sm-12 form-group">
										<label for="profession">Participants <sup>*</sup></label>
										<!-- <input type="text" class="form-control" name="participants" id="participants" value="<?php echo $trainig_data[0]['participants']; ?>"> -->
										
										<select multiple name="participants[]" id="profession" class="form-control" required>
											<option value="">Please Select</option>
											<?php foreach ($cat as $key => $value) {
											if(in_array($value['id'], $explodedData)){ ?>
											<option selected="selected" value="<?php echo $value['id']; ?>"><?php echo $value['cat_name']; ?></option>
											<?php } else { ?>
											<option value="<?php echo $value['id']; ?>"><?php echo $value['cat_name']; ?></option>
										<?php } 
											}?>
										</select>
										<span class="error"><?php echo  form_error('participants'); ?></span>
									</div> 
									<div class="col-sm-12 form-group">
										<label for="item" >Item/s to bring </label>
										<input type="text" class="form-control" name="item" id="item" value="<?php echo $trainig_data[0]['item_to_bring']; ?>">
										<span class="error"><?php echo  form_error('item'); ?></span>
									</div>
									<div class="col-sm-2 form-group">
										<input type="submit" class="btn btn-primary btn-lg" value="UPDATE & NEXT">
									</div> 
								</div> 
							</form>
						</div> 
					</div>		
				</div>	
      		</div>
		</div>
  	</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("body").on("click",".add-more",function(){ 
			var html = $(".after-add-more").first().clone();   
			$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>"); 
			$(".after-add-more").last().after(html);     
		});
		$("body").on("click",".remove",function(){ 
			$(this).parents(".after-add-more").remove();
		});
		
        $('#profession').multiselect();
	});
</script>
