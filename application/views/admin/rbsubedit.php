<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
	<div class="container">
		<div class="row">
		<?php $this->load->view('admin/sidebar');?>	
		<div class="col-sm-9">
		
			<h3 class="border-title text-left">Rb Subscription</h3>

          <form action="<?php echo BASE_URL.'admin/rbsubedit';?>" method="post" enctype="multipart/form-data" name="form100" id="form100">
            <?php echo $this->session->flashdata('response');?> 
              

              <div class="form-group">
                  <label>Name <span class="required"> * </span> </label>
                  <input  name="subcription_name" id="subcription_name" class="form-control" size="20"  type="text" value="<?php echo (isset($edit->subcription_name) && $edit->subcription_name!="")?$edit->subcription_name:set_value('subcription_name'); ?>" required>
				  <?php echo form_hidden('rbsp_id', isset($edit->rbsp_id)?$edit->rbsp_id:'');?>
                  <span class="error"><?php echo  form_error('hedding'); ?></span>
              </div> 
			  <div class="form-group">
                  <label>No. of applications <span class="required"> * </span> </label>
                  <input  name="no_of_applications" id="no_of_applications" class="form-control" size="20"  type="text" value="<?php echo (isset($edit->no_of_applications) && $edit->no_of_applications!="")?$edit->no_of_applications:set_value('no_of_applications'); ?>" required>
                  <span class="error"><?php echo  form_error('hedding'); ?></span>
              </div>
			   
              <div class="form-group">
                  <label for="email">Description</label>
                  <textarea class="form-control text_editor" name="subscription_details" id="subscription_details"><?php echo (isset($edit->subscription_details) && $edit->subscription_details!="")?$edit->subscription_details:set_value('subscription_details'); ?></textarea>
                  <span class="error"><?php echo  form_error('subscription_details'); ?></span>
              </div>
				<div class="form-group">
                  <label>Charge<span class="required"> * </span> </label>
                  <input  name="charge_per_application" id="charge_per_application" class="form-control" size="20"  type="text" value="<?php echo (isset($edit->charge_per_application) && $edit->charge_per_application!="")?$edit->charge_per_application:set_value('charge_per_application'); ?>" required>
                  <span class="error"><?php echo  form_error('hedding'); ?></span>
              </div>
			  <div class="form-group">
                  <label>Order by<span class="required"> * </span> </label>
                  <input  name="disp_position" id="disp_position" class="form-control" size="20"  type="text" value="<?php echo (isset($edit->disp_position) && $edit->disp_position!="")?$edit->disp_position:set_value('disp_position'); ?>" required>
                  <span class="error"><?php echo  form_error('hedding'); ?></span>
              </div>
         		<div class="form-group">
					<label class="input-labeltext">Status</label><br>
                    <label class="radio-content">
                    <input type="radio" name="rbsp_status" id="rbsp_status" value="1" <?php echo (isset($edit->rbsp_status) && $edit->rbsp_status == "1")?'checked':''; ?>> Active 
                        <span class="checkmark"></span>
                    </label>  
                    <span class="mx-2">|</span>  
                    <label class="radio-content">
                    <input type="radio" name="rbsp_status" id="rbsp_status1" value="0" <?php echo (isset($edit->rbsp_status) && $edit->rbsp_status == "0")?'checked':''; ?> > Inactive
                        <span class="checkmark"></span>
                    </label>

					
					
					<?php echo form_error('rbsp_status', '<div class="error">', '</div>'); ?>
				</div>	   
			   
             
              <p class="submit alignleft">
                  <input class="btn btn-primary" value="Save" type="submit" name="save">
              </p>

        </form>
    </div>
		</div>
	</div>
</div>