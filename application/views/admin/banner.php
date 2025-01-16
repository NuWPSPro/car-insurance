<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-blogpanel">
    <div class="container">
        
        <div class="row">
            <?php 
        $this->load->view('admin/sidebar');
        ?>
            <div class="col-sm-9">
                <div class="admin-titlebox">
           <h4>Banner Listing (<?php echo count($cmss);?>)</h4>
                <a href="<?php echo base_url('admin/banneredit');?>" class="btn btn-info">Add Banner</a>
                </div>

                <?php echo $this->session->flashdata('response');?> 
				
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <!--<th>Banner Text</th>-->
                                <th>Display Position</th>
								<th>Banner</th>
								<th>Status</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($cmss)>0){
                                $count = 1; 
								foreach($cmss as $cms){
								$banner = "";
								if(isset($cms->banner) && $cms->banner !=""){
									if(file_exists('./assets/images/banner/'.$cms->banner)){
										$banner = '<img src="'.base_url().'assets/images/banner/'.$cms->banner.'" width="150">';
									}
								}									
                            ?>
                            <tr>
                                <td><?php echo $count++; ?>.</td>
                                <td><?php echo $cms->title; ?></td>
                                <td><?php echo $cms->sub_title; ?></td>
                                <!--<td><?php echo strip_tags($cms->bannertext); ?></td>-->
                                <td><?php echo $cms->display_position; ?></td>
									<td><?php echo $banner; ?></td>
									<td><?php echo ($cms->bnr_status) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?></td>
									<td>
										<?php echo anchor('admin/banneredit/'. $cms->bnr_id, 'Edit',array('class' => 'btn btn-primary')); ?>
										<a href="#" onclick="delete_banner()" class="btn btn-danger dltbnr" data-id="<?php echo $cms->bnr_id; ?>">Delete</a>
									</td>
                            </tr> 
                            <?php }
								

							}else{ echo'<tr>No Data Founds!</tr>'; }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.dltbnr').on('click', function(){
        var id = $(this).attr('data-id');
        var d = confirm('Do you want to DELETE it ?');
        if(d == true){
            var path = "<?php echo base_url('admin/bannerdelete/'); ?>";
            window.location.href = path + id;
        }
    });
        
</script>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
           <h4>Banner Listing (<?php echo count($cmss);?>)</h4>
			<div class="card-body">
					<div style="text-align:right; margin-bottom:10px;"><a href="<?php echo base_url('admin/banneredit');?>"><button type="button" class="btn btn-primary btn-flat">Add Banner</button></a></div>
					<div class="table-responsive">

                    <table class="table table-bordered" id="dataTabless" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <!--<th>Banner Text</th>-->
                                <th>Display Position</th>
								<th>Banner</th>
								<th>Status</th>
								<th>Action</th>
                            </tr>
                        </thead>

                        <!--   <tfoot>

                            </tfoot> -->
                        <tbody>
                            <?php if(count($cmss)>0){
                                $count = 1; 
								foreach($cmss as $cms){
								$banner = "";
								if(isset($cms->banner) && $cms->banner !=""){
									if(file_exists('./assets/images/banner/'.$cms->banner)){
										$banner = '<img src="'.base_url().'assets/images/banner/'.$cms->banner.'" height="150">';
									}
								}									
                            ?>
                            <tr>
                                <td><?php echo $count++; ?>.</td>
                                <td><?php echo $cms->title; ?></td>
                                <td><?php echo $cms->sub_title; ?></td>
                                <!--<td><?php echo strip_tags($cms->bannertext); ?></td>-->
                                <td><?php echo $cms->display_position; ?></td>
									<td><?php echo $banner; ?></td>
									<td><?php echo ($cms->bnr_status) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?></td>
									<td>
										<?php echo anchor('admin/banneredit/'. $cms->bnr_id, 'Edit'); ?>
									</td>
                            </tr> 
                            <?php }
								

							}else{ echo'<tr>No Data Founds!</tr>'; }?>
                        </tbody>
                    </table>
                </div>
				</div>
        </div>
    </main>