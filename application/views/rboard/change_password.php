<?php $this->load->view('rboard/picture'); ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">
			<!-- left sidebar start -->
			<?php $this->load->view('rboard/sidebar'); ?>
			<!-- left sidebar end -->

			<!-- right main body start -->
			<div class="col-sm-8">
	        
				<div class="card">
					<div class="card-header">
        				<h3 class="border-title text-left">Change Password</h3>
					</div>
					<?php echo $this->session->flashdata('response');?> 
					<div class="card-body">
						<div class="row">
						<form action="<?php echo BASE_URL;?>rboard/change_password" method="post" enctype="multipart/form-data" name="change_password" id="change_password">
                            <div class="col-sm-8">
								<div class="form-group">
									<label>Old Password : <span class="required"> * </span></label>
                                    <input name="old_password" id="old_password" class="form-control" value="" size="20" type="password">
                                </div>
								<?php echo form_error('old_password', '<div class="alert alert-danger">', '</div>'); ?>
                            </div>
                            <div class="col-sm-8">
								<div class="form-group">
									<label>New Password : <span class="required"> * </span></label>
                                    <input name="new_password" id="new_password" class="form-control" value="" size="20" type="password">
                                </div>
								<?php echo form_error('new_password', '<div class="alert alert-danger">', '</div>'); ?>
                            </div>
                            <div class="col-sm-8">
								<div class="form-group">
									<label>Confirm Password : <span class="required"> * </span></label>
                                    <input name="conf_password" id="conf_password" class="form-control" value="" size="20" type="password">
                                </div>
								<?php echo form_error('conf_password', '<div class="alert alert-danger">', '</div>'); ?>
                            </div>
							
							<div class="col-sm-12">
                                <div class="form-group"> 
                                    <p class="submit alignleft">
                                        <input class="btn btn-success" value="Submit" type="submit" name="submit">
                                    </p>
                                </div>
                            </div>
						</form>
						</div>
					</div>
				</div>
			</div>
			<!-- right main body end -->

		</div>
	</div>
</div>