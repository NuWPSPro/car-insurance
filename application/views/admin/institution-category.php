<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-institution-categorypanel">
    <div class="container">
    
        <div class="row">
            <?php 
        $this->load->view('admin/sidebar');
        ?>
            <div class="col-sm-9">
                <h3 class="border-title text-left">Institution Category Listing</h3>
                <?php echo $this->session->flashdata('response');?>
                <div class="alert alert-info clearfix">
                    <form action="<?php echo site_url();?>/admin/institution_category" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="col-md-5 form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <input type="text" class="form-control" id="cat_name" name="cat_name" aria-describedby="emailHelp" placeholder="Enter category name">
                            <span class="error"><?php echo form_error('cat_name'); ?></span>
                        </div>
                        <div class="col-md-3">
                            <label style="display: block;">&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             foreach ($category as $key => $value) {   
                
                                if($value['status']==1){
                                    $stts = "Enabled";
                                    $color = "green";
                                } else {
                                    $stts = "Disabled";
                                    $color = "red";
                                }
                
                            ?>
                            <tr>
                                <td>
                                    <?php echo $key+1;?>
                                </td>
                                <td>
                                    <?php echo $value['cat_name'];?>
                                </td>
                                <td><a href="<?php echo site_url('admin/category_institution_edit/'.$value['id'].'');?>" class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo site_url('admin/delete_category_institution/'.$value['id'].'');?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>