<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
	<div class="container">
		<div class="row">
		    <?php $this->load->view('admin/sidebar');?>	

            <div class="col-sm-9">
                <div class="admin-titlebox">
                    <h3 class="border-title text-left">Digital Insurance Package</h3>
                    <a href="<?php echo site_url('admin/digital_insurance_package');?>" class="btn btn-info">Back</a>
                </div>	
                <?php echo $this->session->flashdata('response');?> 
            
                <form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" name="form100" id="form100">

                    <div class="form-group">
                        <label>Name <span class="required"> * </span> </label>
                        <input  name="subcription_name" id="subcription_name" class="form-control" size="20"  type="text" value="<?php echo (isset($edit->subcription_name) && $edit->subcription_name!="")?$edit->subcription_name:set_value('subcription_name'); ?>" required>
                        <?php echo form_hidden('dcp_id', isset($edit->dcp_id)?$edit->dcp_id:'');?>
                    </div> 
                    <div class="form-group">
                        <label>Charges per certificate<span class="required"> * </span> </label>
                        <input  name="charge_per_certificate" id="charge_per_certificate" class="form-control" size="20"  type="text" value="<?php echo (isset($edit->charge_per_certificate) && $edit->charge_per_certificate!="")?$edit->charge_per_certificate:set_value('charge_per_certificate'); ?>" required>
                        <span class="error"><?php echo  form_error('charge_per_certificate'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Total Charges<span class="required"> * </span> </label>
                        <input  name="total_charges" id="total_charges" class="form-control" size="20"  type="text" value="<?php echo (isset($edit->total_charges) && $edit->total_charges!="")?$edit->total_charges:set_value('total_charges'); ?>" required>
                        <span class="error"><?php echo  form_error('total_charges'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>No. of Certificates <span class="required"> * </span> </label>
                        <input  name="no_of_certificates" id="no_of_certificates" class="form-control" size="20"  type="text" value="<?php echo (isset($edit->no_of_certificates) && $edit->no_of_certificates!="")?$edit->no_of_certificates:set_value('no_of_certificates'); ?>" required>
                        <span class="error"><?php echo  form_error('no_of_certificates'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Description</label>
                        <textarea class="form-control text_editor" name="subscription_details" id="subscription_details"><?php echo (isset($edit->subscription_details) && $edit->subscription_details!="")?$edit->subscription_details:set_value('subscription_details'); ?></textarea>
                        <span class="error"><?php echo  form_error('subscription_details'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Order by<span class="required"> * </span> </label>
                        <input  name="disp_position" id="disp_position" class="form-control" size="20"  type="text" value="<?php echo (isset($edit->disp_position) && $edit->disp_position!="")?$edit->disp_position:set_value('disp_position'); ?>" required>
                        <span class="error"><?php echo  form_error('disp_position'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="input-labeltext">Status</label><br>
                        <label class="radio-content">
                        <input type="radio" name="dcp_status" id="dcp_status" value="1" <?php echo (isset($edit->dcp_status) && $edit->dcp_status == "1")?'checked':''; ?>> Active 
                            <span class="checkmark"></span>
                        </label>  
                        <span class="mx-2">|</span>  
                        <label class="radio-content">
                        <input type="radio" name="dcp_status" id="dcp_status1" value="0" <?php echo (isset($edit->dcp_status) && $edit->dcp_status == "0")?'checked':''; ?> > Inactive
                            <span class="checkmark"></span>
                        </label>
                        
                        <?php echo form_error('dcp_status', '<div class="error">', '</div>'); ?>
                    </div>	 
                        
                    <p class="submit alignleft">
                        <input class="btn btn-primary" value="Save" type="submit" name="save">
                    </p>
                    
                </form>

            </div>
		</div>
	</div>
</div>