<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-countrywebpagelist-panel">
    <div class="container">
        <div class="row">
            <?php $this->load->view('admin/sidebar'); 
                  $filter = $this->uri->segment(3);  ?>
            <div class="col-sm-9">
                <!--<a href="<?php echo site_url('admin/countrywebpage');?>" class="btn btn-info pull-right">Add Country Page</a>-->  
                <h3 class="border-title text-left" style="width:200px !important;">Country Web Page</h3>
                <?php echo $this->session->flashdata('response');?> 
               
                <a href="<?php echo site_url('admin/countrywebpagelist'); ?>"><span  class="btn <?php if($filter == ''){ echo "btn-primary";} else {echo "btn-default";}?>">All Web Page</span></a>
                <a href="<?php echo site_url('admin/countrywebpagelist/1'); ?>"><sapn  class="btn <?php if($filter == 1){ echo "btn-primary";} else {echo "btn-default";}?>">Active Web Page</span></a>
                <a href="<?php echo site_url('admin/countrywebpagelist/2'); ?>"><span  class="btn <?php if($filter == 2){ echo "btn-primary";} else {echo "btn-default";}?>">In-active Web Page</span></a>    
                <br><br>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Hedding</th>
                                <th>Sub Hedding</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
               
               <?php 
	
               foreach ($country as $key => $value) { 

                         ?>
                            <tr>
                                <td><?php echo $key+1;?></td>
                                <td><?php echo $value['countries_name'];?></td>
                                <td>
                                    <img src="<?=base_url('assets/upload/country/'.$value['banner_image'])?>" alt="" style="object-fit: contain;height: 200px;width: 100%;"> 
                                </td>
                                <td><?php echo $value['hedding'];?></td>
                                <td><?php echo $value['sub_hedding'];?></td>
                                <td><?php echo $value['status'];?></td>
                                <td>
								<!--<a href="<?php echo site_url('admin/countrydelet/'.$value['countries_id'].'');?>" class="btn btn-primary" title="View"><i class="fa fa-trash"></i></a> -->
								<a target="_blank" href="<?php echo site_url('/pages/country/'.$value['countries_id'].'');?>" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a>
								<a href="<?php echo site_url('admin/countrywebpage/'.$value['countries_id']);?>" class="btn btn-primary" title="View"><i class="fa fa-pencil"></i></a>
						   		</td>
							</tr>


                            <?php }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

