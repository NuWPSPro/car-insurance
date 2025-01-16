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
        				<h3 class="border-title text-left">Settings</h3>
					</div>
				
					<div class="card-body">
	        <?php echo $this->session->flashdata('response');?> 
						<div class="row">
						<form action="<?php echo BASE_URL;?>rboard/settings" method="post" enctype="multipart/form-data" name="settings" id="settings">
                            <!-- <div class="col-sm-12">
								<div class="form-group">
									<label>Website Url : <span class="required"> * </span></label>
                                    <input name="website" id="website" class="form-control" value="" size="20" type="url">
									
                                </div>
                            </div> -->

							<div class="col-sm-12">
                                <div class="form-group">
                                    <label for="website">Domain (url) :  <span class="required"> * </span> (Domain url should contain '/' in the last)</label>
                                    <input  id="website"  name="website" class="form-control" value="<?php echo $profile->website; ?>" size="20" type="url" required>
                                    <span class="error"><?php echo  form_error('website'); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="registering_body">File Path (This path will store your data which is comming from another domain like user certificates as pdf) <br>
                                    Like: /home1/n6fbcdjk/public_html/'DOMAIN NAME'/assets/uploads/pdf/</label>
                                    <input name="registering_body" type="text" id="registering_body" value="<?php echo $profile->registering_body; ?>" class="form-control">
                                </div>
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
<script>

$(".buynow").click(function(){
 $('#rbsp_id').val($(this).data("id"));
 $('#charge').val($(this).data("value"));
 $('#name').val($(this).data("name"));
 $('#rbsubpayment').submit();
 //alert(rbsp_id +'---'+charge);
 //$.post( "<?php echo base_url('rboard/subscription_payment');?>", { rbsp_id: rbsp_id, charge: charge } );
});
</script>