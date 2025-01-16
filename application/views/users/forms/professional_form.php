
                    

    <div class="col-sm-12">
        <h4 class="mb-2 bg-primary p-2 px-4">CAR OWNER REGISTRATION</h4>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>First Name <span class="required"> * </span></label>
            <input name="fname" id="fname" class="form-control" value="" size="20" type="text" required>
            <span class="error"><?php echo  form_error('fname'); ?></span>
            <input type="hidden" name="redirect" class="form-control" value="<?php echo $_REQUEST['location']; ?>">
            <input type="hidden" name="role" value="1">
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>Middle Name <span class="required"> * </span></label>
            <input name="name" id="name" class="form-control" value="" size="20" type="text" required><span class="error">
            <?php echo  form_error('name'); ?></span>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            <label>Last Name <span class="required"> * </span></label>
            <input name="lname" id="lname" class="form-control" value="" size="20" type="text" required>
            <span class="error"><?php echo  form_error('lname'); ?></span>
        </div>
    </div>

<!--  <div class="col-sm-6">
        <div class="form-group">
            <label>Profession <span class="required"> * </span> </label>
            <div class="selection-box">
                <select name="profession" id="profession" class="form-control" required>
                    <option value="">Select</option>
                    <?php
                                foreach ($profession as $key => $value) {
                            ?>
                    <option value="<?php echo $value['cat_name'];?>">
                        <?php echo $value['cat_name'];?>
                    </option>
                    <?php 
                            }
                            ?>
                </select>
                <span class="error"><?php echo  form_error('profession'); ?></span>
            </div>
        </div>
    </div> -->

    <div class="col-sm-12">
        <div class="form-group">
            <label>Nationality <span class="required"> * </span> </label>
            <div class="selection-box">
            <?php   $this->db->order_by('countries_name','ASC');
                    $country = $this->user->get_record_by_field_name_all_record('countries','status',1); ?>
                <select name="country_name" id="country_name" class="form-control" required>
                    <option value="">Select Country</option>
                    <?php  foreach ($country as $key => $value) { ?>
                            <option value="<?php echo $value['countries_id']; ?>"><?php echo $value['countries_name']; ?></option>
                        <?php }  ?>
                </select>
                <span class="error"><?php echo  form_error('country_name'); ?></span>
            </div>
        </div>
    </div>


  <div class="col-sm-6">
        <div class="form-group">
            <label>License No <span class="required"> * </span> </label>
            <input name="licence_no" id="licence_no" class="form-control" value="" size="20" type="text" required>
            <span class="error" id="err_licence_no"><?php echo  form_error('licence_no'); ?></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Expiry Date<span class="required"> * </span> </label>
            <input name="exp_date" id="exp_date" class="form-control" value=""  type="date" required>
            <span class="error" id="err_lexp_date"><?php echo  form_error('exp_date'); ?></span>
        </div>
    </div>


    <!--  
    <div class="col-sm-6" id="formshow" style="display: none;">
        <div class="form-group">
            <label>License Validity Date <span class="required"> * </span> </label>
            <div class="selection-box">
                <input name="validity" id="validity" class="form-control" value="" size="20" type="date" required>
                <span class="error"><?php echo  form_error('location'); ?></span>
            </div>
        </div>
    </div> -->
    
<!-- <div class="col-sm-12">
        <div class="form-group">
            <label>Name of Professional Regulatory Board/Council  <span class="required"> * </span> </label>
            <input name="issuing_institution" class="form-control" value="" size="20" type="text" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Issuing Country <span class="required"> * </span> </label>
            <div class="selection-box">
                <select name="location" id="location" class="form-control" required>
                    <option value="">Select Country</option>
                    <?php  foreach ($country as $key => $value) 
                    { 
                    ?>
                        <option value="<?php echo $value['countries_id']; ?>"><?php echo $value['countries_name']; ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Issuing State </label>
            <div class="selection-box">
                    <input type="text" name="state" id="state" class="form-control">
            </div>
        </div>
    </div> -->


    <div class="col-sm-12">
        <span id="err_owner"></span>
        <div class="form-group">
            <label for="exampleInputFile">Upload Photo</label>
            <input type="file" id="exampleInputFile" class="btn btn-primary" name="photo">
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>Username (email)<span class="required"> * </span> </label>
            <input name="username" id="username" class="form-control" value="" size="20" type="text" required>
            <span class="error" id="err_username"><?php echo  form_error('username'); ?></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Password <span class="required"> * </span> </label>
            <input name="password" id="password" class="form-control" value="" size="20" type="password" required>
            <span class="error"><?php echo  form_error('password'); ?></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Confirm Password <span class="required"> * </span> </label>
            <input name="con_password" id="con_password" class="form-control" value="" size="20" type="password" required>
            <span class="error"><?php echo  form_error('con_password'); ?></span>
        </div>
    </div>


<script>

        $('#username').blur(function(){
            var licence_no = $('#licence_no').val();
            var exp_date = $('#exp_date').val();
            alert(exp_date)
            var username = $('#username').val();
            if(licence_no == ''){
                $('#err_licence_no').html('Licence number shouldn\'t be blank!').css('color','red');
                return false;
            }else{
                $('#err_licence_no').hide();
            }
            if(exp_date ==''){
                $('#err_lexp_date').html('Licence Expiry date shouldn\'t be blank!').css('color','red');
                return false;
            }else{
                $('#err_exp_date').hide();
            }

            if(username == ''){
                $('#err_username').html('Owner email shouldn\'t be blank!').css('color','red');
                return false;
            }else{
                $('#err_username').hide();
            }
            var settings = {
                "url": "https://ceonpoint.com/roadtraffic/admin/api/validateCarOwner",
                "method": "POST",
                "headers": {
                    "Content-Type": "application/json"
                },
                "data": JSON.stringify({
                    "email": username,
                    "licence_no": licence_no,
                    "exp_date": exp_date
                }),
            };

            $.ajax(settings).done(function (response) {
                var obj = JSON.parse(response)
                if(obj.error == true){
                    Swal.fire({
                        title: 'Failed!',
                        icon: 'danger',
                        text: obj.msg
                    });
                    $('#err_owner').html(obj.msg).css('color','red');
                    return false;
                }else{
                    $('#err_owner').html(obj.msg).css('color','green');                                  
                }
                console.log(obj.error);
            });
        });
        
</script>