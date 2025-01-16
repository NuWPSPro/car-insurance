<?php  $this->load->view('broker/picture'); ?>

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
            <?php echo $this->session->flashdata('response')['msg']; ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Family Name</th>
                            <th scope="col">Inurance Name</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date Applied</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($application): 
                            foreach($application as $list):
                            @$i++;
                            if($list['certificate_status']==1): 
                                $status = '<span class="text-success">Generated</span>';
                                $cstyle = 'none'; $vstyle = '';
                            else:
                                $status = '<span class="text-danger">Not generated</span>';
                                $cstyle = ''; $vstyle = 'none';
                            endif; 
                            ?>
                        <tr>
                            <th scope="row"><?=$i;?></th>
                            <td><?=$list['fname'];?></td>
                            <td><?=$list['lname'];?></td>
                            <td><?=$list['name'];?></td>
                            <td><?=$list['insur_name'];?></td>
                            <td><?=$list['first_name'];?> <?=$list['middle_name'];?> <?=$list['last_name'];?></td>
                            <td>$<?=$list['price_insurance'];?></td>
                            <td><?=$list['added_on'];?></td>
                            <td><?=$status;?></td>
                            <td>
                                <a href="javascript:void(0)" style="display:<?=$cstyle;?>;" data-id="<?=$list['bi_id']; ?>" class="createInsurance btn btn-success m-1">Generate Certificate</a>
                                <a href="javascript:void(0)" style="display:<?=$vstyle;?>;" data-id="<?=$list['insurance_id']; ?>" class="viewInsurance btn btn-primary m-1">View Insurance</a>
                                <!-- <a href="<?=base_url('provider/edit_insurance/'.$list['bi_id']); ?>" class="btn btn-primary m-1"><i class="fa fa-edit"></i></a> -->
                                <!-- <a href="<?=base_url('provider/delete_insurance/'.$list['bi_id']); ?>" onclick="return deleteInsurance();" class="btn btn-danger m-1"><i class="fa fa-trash"></i></a> -->
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
                <h5 class="modal-title text-white" id="labelInsurance">Certificate</h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('author/insurance_listing'); ?>" method="post">
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
                                    <span id="fnameerror"></span>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Middle Name * :</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                    <span id="mnameerror"></span>
                                </div>
                                <div class="form-group">
                                    <label for="lname" class="col-form-label">Family Name * :</label>
                                    <input type="text" name="lname" class="form-control" id="lname">
                                    <span id="lnameerror"></span>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-form-label">Address * :</label>
                                    <textarea class="form-control" name="address" id="address"></textarea>
                                    <span id="addresserror"></span>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="clientdob" class="col-form-label">Date of Birth * :</label>
                                        <input type="date" name="dob" class="form-control" id="clientdob">
                                        <span id="doberror"></span>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="nation" class="col-form-label">Nationality * :</label>
                                        <select name="nationality" class="form-control" id="nation">
                                        <option value="">Choose one country</option>
                                        <?php if($country_list !=''): foreach($country_list as $list):?>
                                            <option value="<?=$list['countries_id']; ?>"><?=$list['countries_name']; ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                        <span id="nationerror"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="age" class="col-form-label">Age * :</label>
                                        <input type="number" min="18" name="age" class="form-control" id="age">
                                        <span id="ageerror"></span> 
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sex" class="col-form-label">Sex * :</label>
                                        
                                        <div class="form-group">
                                            <input type="radio" name="sex" value="m" class="form-radio" id="sexm">
                                            <label for="sexm" class="col-form-label">Male</label>
                                            
                                            <input type="radio" name="sex" value="f" class="form-radio" id="sexf">
                                            <label for="sexf" class="col-form-label">Female</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email" class="col-form-label">Email * :</label>
                                        <input type="email" name="email" class="form-control" id="ss_email">
                                        <span id="emailerror"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mobile" class="col-form-label">Mobile * :</label>
                                        <input type="number" name="mobile" class="form-control" id="ss_mobile">
                                        <span id="mobileerror"></span>
                                    </div>
                                </div>
                                
                                <!-- <div class="form-group">
                                    <label for="cip" class="col-form-label">Telephone Number :</label>
                                    <input type="text" name="cip" class="form-control" id="cip">
                                </div> -->

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
                                    <label for="carmake" class="col-form-label">Car Make * :</label>
                                    <input type="text" name="carmake" placeholder="Hundai" class="form-control" id="carmake">
                                    <span id="makeerror"></span>
                                </div>
                                <div class="form-group">
                                    <label for="mModel" class="col-form-label">Car Model * :</label>
                                    <input type="text" name="mmodel" placeholder="Hundai Creta" class="form-control" id="mModel">
                                    <span id="modelerror"></span>
                                </div>
                                <div class="form-group">
                                    <label for="vin" class="col-form-label">VIN (vehicle identification number) * :</label>
                                    <input type="text" name="vin" class="form-control" id="vin">
                                    <span id="vinerror"></span>
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
                                
                                $return_code = "";
                                for ( $x=0; $x<=5; $x++ ) {
                                    $return_code .= $chary[rand(0, count($chary)-1)];
                                }
                                // $auth_code = $return_code;
                                $auth_code = '12345';
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
                                <!-- <div class="form-group">
                                    <label for="status" class="col-form-label">Status * :</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="1">Save</option>
                                        <option value="2">Publish</option>
                                    </select>
                                </div> -->
                                <input type="hidden" name="bi_id" id="pbi_id">
                                <input type="hidden" name="insurance_id" id="ss_insurance_id">
                                <input type="hidden" name="company_id" id="company_id">
                                <input type="hidden" name="auth_code" value="<?=$auth_code;?>">
                                <input type="hidden" name="buyer_id" id="buyer_id">
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


    <div class="modal fade" id="viewInsurance" tabindex="-1" role="dialog" aria-labelledby="labelInsurance" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title text-white" id="labelInsurance">Insurance Package Details</h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        
                        <div class="card-image">
                            <img src="" id="i_course_photo" width="150px" alt="">
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Insurance Name</th>
                                    <td><span id="i_title">Insurance Name</span></td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>$<span id="i_price">10</span></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td><span id="i_course_description">...</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#personalInfo').click(function(){
            
            if($('#fname').val() ==''){
                $('#fnameerror').html('First Name is required.').css('color','red');
                return false;
            }
            if($('#name').val() ==''){
                $('#mnameerror').html('Middle Name is required.').css('color','red');
                return false;
            }
            if($('#lname').val() ==''){
                $('#lnameerror').html('Last Name is required.').css('color','red');
                return false;
            }
            if($('#address').val() ==''){
                $('#addresserror').html('Address is required.').css('color','red');
                return false;
            }
            if($('#clientdob').val() ==''){
                $('#doberror').html('Date of birth is required.').css('color','red');
                return false;
            }
            if($('#nation').val() ==''){
                $('#nationerror').html('Country is required.').css('color','red');
                return false;
            }
            if($('#age').val() < 18){
                $('#ageerror').html('Age should be greater than or equal to 18 years!').css('color','red');
                return false;
            }
            if($('#ss_email').val() == ''){
                $('#emailerror').html('Email is required.').css('color','red');
                return false;
            }
            if($('#ss_mobile').val() == ''){
                $('#mobileerror').html('Mobile number is required.').css('color','red');
                return false;
            }

            $('#collapseOne').removeClass('in');
            $('#collapseTwo').addClass('in');
            $('#collapseTwo').css('pointer-events: auto');
            $('#collapseThree').removeClass('in');
        });
        $('#carInfo').click(function(){
            if($('#carmake').val() == ''){
                $('#makeerror').html('Car make is required').css('color','red');
                return false;
            }
            if($('#mModel').val() == ''){
                $('#modelerror').html('Model is required.').css('color','red');
                return false;
            }
            if($('#vin').val() == ''){
                $('#vinerror').html('VIN number is required.').css('color','red');
                return false;
            }
            $('#collapseOne').removeClass('in');
            $('#collapseTwo').removeClass('in');
            $('#collapseThree').addClass('in');
            $('#collapseThree').css('pointer-events: auto');
        });
        
        function deleteInsurance(){
            var x = confirm('Do you realy want to delete this?');
            if(x == true){ return true; }else{ return false; }
        }
        
        $('.createInsurance').click(function(){
            var insur_id = $(this).data("id");
            var settings = {
                "url": "<?php echo base_url()?>author/get_one_buy_insurance_details/"+insur_id,
                "headers": { "Content-Type": "application/json" },
            };

            $.ajax(settings).done(function (response) {
                console.log(response);
                var obj = JSON.parse(response); 
                $('#fname').val(obj.fname);
                $('#name').val(obj.name);
                $('#lname').val(obj.lname);
                $('#ss_email').val(obj.email);
                $('#buyer_id').val(obj.user_id);
                $('#pbi_id').val(obj.bi_id);
                $('#ss_insurance_id').val(obj.insurance_id);
                $('#company_id').val(obj.company_id);
                $('#ss_mobile').val(obj.mobile);
                $('#createInsurance').modal('show');
            });
        });
        
        $('.viewInsurance').click(function(){
            var id = $(this).data("id");
            var path  = "<?php echo base_url('author/get_one_insurance_package'); ?>";
            var settings = {
                "url": path + "/" + id,
                "method": "GET",
            };

            $.ajax(settings).done(function (response) {
                console.log(response);
                var obj = JSON.parse(response);
                var path = "<?php echo base_url('assets/images/uploads'); ?>" + "/" + obj.course_photo;
                $('#i_course_photo').attr('src',path);
                $('#i_title').html(obj.course_title);
                $('#i_price').html(obj.price);
                $('#i_course_description').html(obj.course_description);
                $('#pdfPath').attr('src',path)
                $('#viewInsurance').modal('show');
            });
        });
        
        $("#clientdob").on("change",function(){
            var selectedDate = $(this).val();
            var dob = new Date(selectedDate);
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#age').val(age);
            if(age < 18){
                $('#ageerror').html('Age should be greater than or equal to 18 years!').css('color','red');
            }else{
                $('#ageerror').html('');
            }

        });
       
    </script>