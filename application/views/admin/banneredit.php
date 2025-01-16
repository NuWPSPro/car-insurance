<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
	<div class="container">
	
		<div class="row">

		<?php  $this->load->view('admin/sidebar'); ?> 
		<div class="col-sm-8">
			 
        <h2 class="mt-4"><?php echo $page_title; ?></h2>
        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_banner','enctype' => 'multipart/form-data')); //echo "<pre>"; print_r($cms); echo "</pre>";  ?>	
							<?php echo form_hidden('bnr_id', isset($cms->bnr_id)?$cms->bnr_id:'');?>
							
							<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Banner Main Title</label>
								<div class="col-sm-10">
									<input name="title" value="<?php echo isset($cms->title)?$cms->title:''; ?>" id="title" class="form-control" type="text" required>
								</div>
							</div>
							<div class="form-group">
								<label for="sub_title" class="col-sm-2 control-label">Banner Sub Title</label>
								<div class="col-sm-10">
									<input name="sub_title" value="<?php echo isset($cms->sub_title)?$cms->sub_title:''; ?>" id="title" class="form-control" type="text" required>
								</div>
							</div>
							
							<!--<div class="form-group">
								<label for="url" class="col-sm-2 control-label">URL</label>
								<div class="col-sm-10">
									<input name="url" value="<?php echo isset($cms->url)?$cms->url:''; ?>" id="url" class="form-control" type="url" required>
								</div>
							</div>-->
							
                           <div class="form-group">
								<label for="display_position" class="col-sm-2 control-label">Display Position</label>
								<div class="col-sm-10">
									<input name="display_position" value="<?php echo isset($cms->display_position)?$cms->display_position:''; ?>" id="display_position" class="form-control" type="number" required>
								</div>
							</div>
							<div class="form-group">
								<label for="banner" class="col-sm-2 control-label">Banner</label>
								<div class="col-sm-10">
									<input name="banner" id="banner" class="form-control" type="file" >
									<input name="old_banner" id="old_banner" class="form-control" type="hidden" value="<?php echo isset($cms->banner)?$cms->banner:''; ?>">
									<?php 
										if(isset($cms->banner) && $cms->banner !=""){
											if(file_exists('./assets/images/banner/'.$cms->banner)){
												echo '<br><img src="'.base_url().'assets/images/banner/'.$cms->banner.'"  height="100">';
											}
										}
									?>
								</div>
							</div>
							<!--<div class="form-group">
								<label for="bannertext" class="col-sm-2 control-label">Banner Text</label>
								<div class="col-sm-10">
									<textarea name="bannertext" id="bannertext" class="form-control" rows="4"><?php echo isset($cms->bannertext)?$cms->bannertext:''; ?></textarea>
								</div>
							</div>-->
                            <div class="form-group">
								<label for="bnr_status" class="col-sm-2 control-label">Status</label>
								<div class="col-sm-10">
									<label class="radio-inline">
										<input type="radio" name="bnr_status" id="bnr_status1" value="1" <?php echo (isset($cms->bnr_status) && $cms->bnr_status==1)? 'checked="checked"':''; ?>> Active
									</label>
									<label class="radio-inline">
										<input type="radio" name="bnr_status" id="bnr_status0" value="0" <?php echo (isset($cms->bnr_status) && $cms->bnr_status !=1)? 'checked="checked"':''; ?>> Inactive
									</label>
								</div>
							</div>
                            
                            <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="btn-group">
										<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
										<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
										<?php echo anchor('admin/banner', 'Cancel', array('class' => 'btn btn-primary btn-flat')); ?>
									</div>
								</div>
							</div>
						<?php echo form_close();?>
		</div>
	</div>
</div>
</div>
