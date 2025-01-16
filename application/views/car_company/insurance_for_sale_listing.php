<?php  $this->load->view('car_company/picture'); ?>

    <!-- Main body start -->
    <div class="col-sm-9">
        <?=$body_heading; ?>
            <div class="row text-center">
                <form class="form-inline" action="https://ceonpoint.com/car/">
                    <!-- <select name="" id="toins" class="form-control">
                        <option value="">Type of Insurance:</option>
                        <option value="">Insurance 1</option>
                        <option value="">Insurance 2</option>
                        <option value="">Insurance 3</option>
                    </select>
                    
                    <select name="" id="prange" class="form-control">
                        <option value="">Price Range:</option>
                        <option value="">Price 1</option>
                        <option value="">Price 2</option>
                        <option value="">Price 3</option>
                    </select>
                    
                    <select name="" id="inscomp" class="form-control">
                        <option value="">Insurance Comapany:</option>
                        <option value="">Comapny 1</option>
                        <option value="">Comapny 2</option>
                        <option value="">Comapny 3</option>
                    </select>
                    
                    <button type="button" class="btn btn-primary">
                        Search
                    </button> -->
                    <a href="<?=base_url('provider/index'); ?>" class="btn btn-danger pull-right ml-1">Back</a>
                    <!-- <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createInsurance" data-whatever="@getbootstrap">Create Insurance</a> -->
                </form>
            </div>
            <div class="table-responsive">
                
            <?php echo validation_errors(); ?>
            <?php echo $this->session->flashdata('response'); ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Insurance Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Insurance Type</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($listing): 
                            foreach($listing as $list):
                            @$i++;
                            if($list['status']==1): 
                                $status = '<span class="text-success">Publish</span>';
                            elseif($list['status']==3):
                                $status = '<span class="text-info">Save</span>';
                            else:
                                $status = '<span class="text-danger">Unpublish</span>';
                            endif; 
                            ?>
                        <tr>
                            <th scope="row"><?=$i;?></th>
                            <td><?=$list['course_title'];?></td>
                            <td><img src="<?php echo ASSETS_URL.'images/uploads/'.$list['course_photo']; ?>" width="90"></td>
                            <td><?=$list['price'];?></td>
                            <td><?php if($list['insurance_type'] == '1'){echo 'Comprehensive';}else{echo 'Third Party';}?></td>
                            <td><?=$status;?></td>
                            <td>
                                <a href="<?=base_url('author/edit_insurance/'.$list['id']); ?>"  class="btn btn-primary m-1"><i class="fa fa-edit"></i></a>
                                <a href="<?=base_url('author/delete_insurance/'.$list['id']); ?>" onclick="return deleteInsurance();" class="btn btn-danger m-1"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; 
                        endif; ?>
                    </tbody>
                </table>
            </div>

    </div>
    <!-- Main body end -->


        <!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>


    <div class="modal fade" id="createInsurance" tabindex="-1" role="dialog" aria-labelledby="labelInsurance" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-white" id="labelInsurance">Create Insurance</h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('provider/insurance_listing'); ?>" method="post">
                <div class="panel-group" id="accordion">
                    <i class="text-danger"> * All fields are required.</i>
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('response'); ?>
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-user"></i> Personal Information</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="fname" class="col-form-label">First Name * :</label>
                                    <input type="text" name="fname" class="form-control" id="fname">
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Middle Name * :</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="lname" class="col-form-label">Family Name * :</label>
                                    <input type="text" name="lname" class="form-control" id="lname">
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-form-label">Address * :</label>
                                    <textarea class="form-control" name="address" id="address"></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="dob" class="col-form-label">Date of Birth * :</label>
                                        <input type="date" name="dob" class="form-control" id="dob">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="nation" class="col-form-label">Nationality * :</label>
                                        <select name="nationality" class="form-control" id="nation">
                                            <option value="">Choose one country</option>
                                            <option value="99">ind</option>
                                            <option value="10">usa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="age" class="col-form-label">Age * :</label>
                                        <input type="number" min="18" name="age" class="form-control" id="age">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sex" class="col-form-label">Sex * :</label>
                                        
                                        <div class="form-group">
                                            <input type="radio" name="sex" value="male" class="form-radio" id="sexm">
                                            <label for="sexm" class="col-form-label">Male</label>
                                            
                                            <input type="radio" name="sex" value="female" class="form-radio" id="sexf">
                                            <label for="sexf" class="col-form-label">Female</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="cip" class="col-form-label">CiP Number * :</label>
                                        <input type="text" name="cip" class="form-control" id="cip">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email" class="col-form-label">Email * :</label>
                                        <input type="email" name="email" class="form-control" id="email">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success" id="personalInfo">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="pointer-events: none"><i class="fa fa-car"></i> Car Information</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="mModel" class="col-form-label">Car Model * :</label>
                                    <input type="text" name="mModel" placeholder="Hundai/i10" class="form-control" id="mModel">
                                </div>
                                <div class="form-group">
                                    <label for="regdate" class="col-form-label">Registration Date * :</label>
                                    <input type="date" name="regdate" class="form-control" id="regdate">
                                </div>
                                <div class="form-group">
                                    <label for="fuel_type" class="col-form-label">Fuel Type * :</label>
                                    <select name="fuel_type" class="form-control" id="fuel_type">
                                        <option value="">Choose one type</option>
                                        <option value="petrol">Petrol</option>
                                        <option value="cng">CNG</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-success" id="carInfo">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="pointer-events: none"><i class="fa fa-info"></i> Insurance Information</a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <?php 
                            
                                $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z","0", "1", "2", "3", "4", "5", "6", "7", "8", "9","A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
                                $return_str = "";
                                for ( $x=0; $x<=10; $x++ ) {
                                    $return_str .= $chary[rand(0, count($chary)-1)];
                                }
                                
                                $insurance_number = 'ci'.date('y').$return_str;
                                $issued_date = date('Y-m-d');
                                $validity_date = date('Y-m-d', strtotime('+1 year'.$issued_date));
                            ?>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="insurance_no" class="col-form-label">Insurance Number * :</label>
                                    <input type="text" name="insurance_no" class="form-control" id="insurance_no" value="<?=$insurance_number;?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="issued" class="col-form-label">Issued Date * :</label>
                                    <input type="date" name="issued" class="form-control" id="issued" value="<?=$issued_date;?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="validity" class="col-form-label">Validity Date * :</label>
                                    <input type="date" name="validity" class="form-control" id="validity" value="<?=$validity_date;?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Status * :</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="1">Save</option>
                                        <!-- <option value="0">Unpublish</option> -->
                                        <option value="2">Publish</option>
                                    </select>
                                </div>
                                <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
                                <input type="hidden" name="added_date" value="<?php echo date('Y-m-d'); ?>">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                </form>
            </div>
            
            </div>
        </div>
    </div>

    <script>
        $('#personalInfo').click(function(){
            $('#collapseOne').removeClass('in');
            $('#collapseTwo').addClass('in');
            $('#collapseTwo').css('pointer-events: auto');
            $('#collapseThree').removeClass('in');
        });
        $('#carInfo').click(function(){
            $('#collapseOne').removeClass('in');
            $('#collapseTwo').removeClass('in');
            $('#collapseThree').addClass('in');
            $('#collapseThree').css('pointer-events: auto');
        });
        var initial_url = window.location.href;
        var url = initial_url .split( '=' );
        if(url[url.length - 1]=='true'){ $('#createInsurance').modal('show'); }

        function deleteInsurance(){
            var x = confirm('Do you realy want to delete this?');
            if(x == true){ return true; }else{ return false; }
        }
        
    </script>