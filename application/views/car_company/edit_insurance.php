<?php  $this->load->view('car_company/picture'); ?>

    <!-- Main body start -->
    <div class="col-sm-9">
        <?=$body_heading; ?>
            
            <div class="card">
                <?php echo validation_errors(); ?>
                <div class="card-body">
                    <div class="panel-group" id="accordion">
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->flashdata('response'); ?>
                        
                        <form action="<?php echo current_url(); ?>" method="post">
                            <i class="text-danger"> * All fields are required.</i>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-user"></i> Personal Information</a>
                                        <a href="<?=base_url('provider/insurance_listing'); ?>" class="btn btn-danger pull-right ml-1">Back</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="fname" class="col-form-label">First Name * :</label>
                                            <input type="text" name="fname" class="form-control" id="fname" value="<?=$row['fname']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Middle Name * :</label>
                                            <input type="text" name="name" class="form-control" id="name" value="<?=$row['name']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="lname" class="col-form-label">Family Name * :</label>
                                            <input type="text" name="lname" class="form-control" id="lname" value="<?=$row['lname']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-form-label">Address * :</label>
                                            <textarea class="form-control" name="address" id="address"><?=$row['address']; ?></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="dob" class="col-form-label">Date of Birth * :</label>
                                                <input type="date" name="dob" class="form-control" id="dob" value="<?=$row['dob']; ?>">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="nation" class="col-form-label">Nationality * :</label>
                                                <select name="nationality" class="form-control" id="nation">
                                                    <option value="">Choose one country</option>
                                                    <option value="99" <?php if($row['nationality'] == 99){ echo 'selected'; }?> >ind</option>
                                                    <option value="10" <?php if($row['nationality'] == 10){ echo 'selected'; }?> >usa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="age" class="col-form-label">Age * :</label>
                                                <input type="number" min="18" name="age" class="form-control" id="age" value="<?=$row['age']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="sex" class="col-form-label">Sex * :</label>
                                                
                                                <div class="form-group">
                                                    <input type="radio" name="sex" value="male" class="form-radio" id="sexm" <?php if($row['sex'] == 'male'){ echo 'checked'; }?> >
                                                    <label for="sexm" class="col-form-label">Male</label>
                                                    
                                                    <input type="radio" name="sex" value="female" class="form-radio" id="sexf" <?php if($row['sex'] == 'female'){ echo 'checked'; }?>>
                                                    <label for="sexf" class="col-form-label">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="cip" class="col-form-label">CiP Number * :</label>
                                                <input type="text" name="cip" class="form-control" id="cip" value="<?=$row['cip']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email" class="col-form-label">Email * :</label>
                                                <input type="email" name="email" class="form-control" id="email" value="<?=$row['email']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="pointer-events: none"><i class="fa fa-car"></i> Car Information</a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="mModel" class="col-form-label">Car Model * :</label>
                                            <input type="text" name="mModel" placeholder="Hundai/i10" class="form-control" id="mModel" value="<?=$row['mModel']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="regdate" class="col-form-label">Registration Date * :</label>
                                            <input type="date" name="regdate" class="form-control" id="regdate" value="<?=$row['regdate']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="fuel_type" class="col-form-label">Fuel Type * :</label>
                                            <select name="fuel_type" class="form-control" id="fuel_type">
                                                <option value="">Choose one type</option>
                                                <option value="petrol" <?php if($row['fuel_type'] == 'petrol'){ echo 'selected'; }?> >Petrol</option>
                                                <option value="cng" <?php if($row['fuel_type'] == 'cng'){ echo 'selected'; }?>>CNG</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="pointer-events: none"><i class="fa fa-info"></i> Insurance Information</a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        
                                        <i class="text-danger"> * This section can't be edit.</i>
                                        <div class="form-group">
                                            <label for="insurance_no" class="col-form-label">Insurance Number * :</label>
                                            <input type="text" name="insurance_no" class="form-control" id="insurance_no" value="<?=$row['insurance_no']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="issued" class="col-form-label">Issued Date * :</label>
                                            <input type="date" name="issued" class="form-control" id="issued" value="<?=$row['issued']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="validity" class="col-form-label">Validity Date * :</label>
                                            <input type="date" name="validity" class="form-control" id="validity" value="<?=$row['validity']; ?>" readonly>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="nation" class="col-form-label">Insu:</label>
                                            <select name="nationality" class="form-control" id="nation">
                                                <option value="">choose one country</option>
                                                <option value="99">ind</option>
                                                <option value="10">usa</option>
                                            </select>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="status" class="col-form-label">Status * :</label>
                                            <select name="status" class="form-control" id="status">
                                                <option value="1" <?php if($row['status'] == 1){ echo 'selected'; }?> >Save</option>
                                                <option value="2" <?php if($row['status'] == 2){ echo 'selected'; }?> >Publish</option>
                                                <option value="0" <?php if($row['status'] == 0){ echo 'selected'; }?> >Unpublish</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
                                        <input type="hidden" name="updated_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
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
