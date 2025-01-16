<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
    <div class="container">
    
        <div class="row">
        
        <?php 
        $this->load->view('admin/sidebar');
        ?>
           
        <!-- New Html Start 28.12.2018 -->
            <div class="col-sm-9"> 
                <div class="admin-titlebox">
                    <h3 class="border-title text-left">Ads Banner Location</h3>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addlocation">Add Location</button>
                </div>
                <?php echo $this->session->flashdata('response');?>
                <div class="table-responsive">
                    <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th>Name</th>
                           <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach ($locations as $key => $value) {
                        ?>
                        <tr>
                          <td><?php echo $value['location_name'];?></td>
                        
                          <td>
                           
                            <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo site_url();?>/admin/deletebanner_location/<?php echo $value['id'];?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
                    <?php 
                    if(empty($locations)){
                      echo "<p>Sorry no records found.</p>";
                    }
                    ?>
                    

            </div>
        </div>
    </div>
</div>






<div id="addlocation" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Location</h4>
            </div>
                <form action="<?php echo site_url();?>/admin/banner_location" method="post" enctype="multipart/form-data" name="form1" id="form1">
                 
                  <div class="modal-body">
                    <p>
                        <label>Location Name<span class="required text-danger"> * </span> </label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <span class="error"><?php echo  form_error('name'); ?></span>
                    </p>
                    

                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                </div>
            </form>
        </div>
    </div>
</div>
