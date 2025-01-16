<?php $this->load->view('template/picture'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
        	<div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
        	</div>
            <?php  $this->load->view('professional/sidebar');  ?>
            <div class="col-sm-8">
                <?php $editadvarr = $editadv[0]; ?>
                <h3 class="border-title text-left"><?php echo ($editadvarr['advlist_id'] !='')?'Update':'Upload'; ?> Advertise</h3>
                <?php echo form_open(current_url(), array('class' => '', 'enctype' => 'multipart/form-data', 'id' => 'form-create_package', 'enctype' => 'multipart/form-data')); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Title <sup>*</sup></label>
                            <input type="hidden" name="advlist_id" value="<?php echo $editadvarr['advlist_id'];?>" class="form-control">
                            <input type="hidden" name="adv_pck_id" value="" class="form-control">
                            <input type="hidden" name="adv_image_old" value="<?php echo $editadvarr['adv_image'];?>" class="form-control">
                            <input type="text" name="adv_title" value="<?php echo $editadvarr['adv_title'];?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Advertise image</label>
                            <input type="file" name="adv_image" value="" class="form-control">
                        </div>
                        <!--<div class="col-sm-12 form-group">
							<label>Status</label>
							<select name="adv_status" class="form-control">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>-->
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Upload">
                        </div>
                    </div>
                    <!--<div class="col-sm-12 form-group">
					<label>Url</label>
					<input type="url" name="adv_url" value="" class="form-control">
				</div>
				<div class="col-sm-12 form-group">
					<label>Display Position</label>
					<input type="number" name="adv_display_postion" value="" class="form-control">
				</div>-->
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
</div>