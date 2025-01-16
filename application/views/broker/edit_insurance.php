<?php  $this->load->view('broker/picture'); ?>

    <!-- Main body start -->
    <div class="col-sm-9">
        <?=$body_heading; ?>
            
            <div class="card">
                <?php echo validation_errors(); ?>
                <div class="card-body">
                    <div class="panel-group" id="accordion">
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->flashdata('response'); ?>
                        
                        <form action="<?php echo base_url('author/edit_insurance'); ?>" enctype="multipart/form-data" method="post">
                    <i class="text-danger"> * All fields are required.</i>
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('response'); ?>
                    
                    <div class="card">
                        <div class="card-body">
                        
                            <div class="form-group">
                                <label for="name" class="col-form-label">Insurance Name * :</label>
                                <input type="text" name="course_title" class="form-control" required id="name" value="<?php echo $row['course_title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-form-label">Price * :</label>
                                <input type="number" min="0" name="price" required class="form-control" id="price" value="<?php echo $row['price']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">Image * :</label>
                                <input type="file" name="image"  class="form-control" id="image">
                            </div>
                            <div class="form-group">
                            <img src="<?php echo ASSETS_URL.'images/uploads/'.$row['course_photo']; ?>" width="90">
                            </div>
                            <div class="form-group">
                                <label for="nation" class="col-form-label">Insurance Type * :</label>
                                <select name="insurance_type" required class="form-control" >
                                    <option value="">Choose one type</option>
                                    <option value="1" <?php if($row['insurance_type'] == '1'){echo 'selected';} ?>>Comprehensive</option>
                                    <option value="0" <?php if($row['insurance_type'] == '0'){echo 'selected';} ?>>Third Party</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nation" class="col-form-label">Insurance Type * :</label>
                                <select name="status" required class="form-control" >
                                    <option value="">Choose one type</option>
                                    <option value="1" <?php if($row['status'] == 1){echo 'selected';} ?>>Published</option>
                                    <option value="3" <?php if($row['status'] == 3){echo 'selected';} ?>>Save Only</option>
                                    <option value="0" <?php if($row['status'] == 0){echo 'selected';} ?>>Unpublish</option>
                                </select>
                            </div>
                            <input type="hidden" name="id"  class="form-control" value="<?php echo $row['id']; ?>" >
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                   
                
                </form>
                </div>
                
            </div>

    </div>
    <!-- Main body end -->


        <!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>
