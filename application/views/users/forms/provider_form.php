
                    <div class="col-sm-12">
                        <h4>
                            1. COMPANY PROFILE  
                        </h4>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Name <span class="required"> * </span> </label>
                            <input required name="name" id="name" class="form-control" value="<?php echo $_REQUEST['name'];?>" size="20" type="text">

                            <input name="role" id="role" class="form-control" value="2" size="20" type="hidden">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Website </label>
                            <input name="website" id="website" class="form-control" value="<?=$_REQUEST['website'];?>" size="20" type="text">
                            <!-- <span class="error"></span> -->
                        </div>
                    </div>
                  
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Country <span class="required"> * </span> </label>
                            <div class="selection-box">
                                <?php $this->db->order_by('countries_name','ASC');
                                $country = $this->user->get_record_by_field_name_all_record('countries','status',1);  ?>

                                <select required name="country_name" id="country_name" class="form-control">
                                    <option value="">Select Country</option>
                                    <?php foreach ($country as $key => $value){ ?>
                                         <option value="<?php echo $value['countries_id']; ?>" <?php if($_REQUEST['country_name']==$value['countries_id']){ echo 'selected'; } ?> >
                                            <?php echo $value['countries_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>State </label> 
                                 <input type="text" name="state" id="state" class="form-control" value="<?=$_REQUEST['state'];?>"> 
                        </div>
                    </div>


                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>City </label> 
                                 <input type="text" name="city" id="city" class="form-control" value="<?=$_REQUEST['city'];?>"> 
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Street </label> 
                                 <input type="text" name="street" id="street" class="form-control" value="<?=$_REQUEST['street'];?>"> 
                        </div>
                    </div>

              
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Representative <span class="required"> * </span> </label>
                            <input required name="representative" class="form-control" value="<?=$_REQUEST['representative'];?>" size="20" type="text">
                            <span class="error"></span>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Designation <span class="required"> * </span> </label>
                            <input required name="designation" class="form-control" value="<?=$_REQUEST['designation'];?>" size="20" type="text">
                            <span class="error"></span>
                        </div>
                    </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                            <label>Telephone No. <span class="required"> * </span> </label>
                            <input required name="mobile" class="form-control" value="<?=$_REQUEST['mobile'];?>" size="20" type="num">
                            <span class="error"></span>
                        </div>
                    </div>
                 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Skype Name </label>
                            <input name="skype" id="skype" class="form-control" value="<?=$_REQUEST['skype'];?>" size="20" type="text">
                            <span class="error"></span>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email: <span class="required"> * </span> </label>
                            <input required name="company_email" id="company_email" class="form-control" value="<?=$_REQUEST['company_email'];?>" type="text">
                            <span class="error" id="err_company_email"></span>
                        </div>
                    </div>

                    <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label>Focus Profession <span class="required"> * </span> </label>
                            <div class="selection-box">
                                <select name="profession" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach ($profession as $key => $value) { ?>
                                    <option value="<?php echo $value['cat_name'];?>" <?php if($_REQUEST['profession']==$value['cat_name']){ echo 'selected'; } ?>> <?php echo $value['cat_name'];?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <span class="error"><?php echo  form_error('profession'); ?></span>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Photo <span class="required"> * </span></label>
                            <input type="file" id="exampleInputFile" class="btn btn-primary" name="image" required>
                        </div>
                    </div>
                     <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label>Paypal (email)</label>
                            <input name="paypal_email" id="paypal_email" class="form-control" value="<?=$_REQUEST['paypal_email'];?>" size="20" type="text">
                            <span class="error"><?php echo  form_error('paypal_email'); ?></span>
                        </div>
                    </div> -->

                    <span id="accreditation" style="display: none;">
                    <div class="col-sm-12">
                        <h4> 2. ACCREDITATION  </h4>
                        <span id="err_accriditaion"></span>
                    </div>

                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Issuing Institution <span class="required"> * </span> </label>
                            <input name="issuing_institution" id="issuing_institution" class="form-control" size="20" value="<?=$_REQUEST['issuing_institution'];?>" type="text" >
                           
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Accreditation Number :<span class="required"> * </span> </label>
                            <input name="accreditation_num" id="accreditation_num" class="form-control" value="<?=$_REQUEST['accreditation_num'];?>" type="text" >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Validity : <span class="required"> * </span> </label>
                            <input name="validity" id="validity" class="form-control" value="<?=$_REQUEST['validity'];?>" type="date" >
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Website of Accrediting Body</label>
                            <input name="accreditation_web" class="form-control" size="20" value="<?=$_REQUEST['accreditation_web'];?>" type="text">
                           
                        </div>
                    </div>
                    
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label for="accreditation_doc">Accreditation Document<span class="required" style="font-size: 10px;">(You can attch pdf, docx, doc, png, jpg and jpeg files)</span></label>
                            <input type="file" id="accreditation_doc" class="btn btn-primary" name="accreditation_doc">
                        </div>
                    </div>

                    
                    </span>
                   


                    <div class="col-sm-12">
                        <h4 id="span"> 3. ACCESS TO ACCOUNT</h4>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Username (email)<span class="required"> * </span> </label>
                            <input required name="username" id="username" class="form-control" value="<?=$_REQUEST['username'];?>" size="20" type="text">
                            <span class="error"><?php echo  form_error('username'); ?></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Password <span class="required"> * </span> </label>
                            <input required name="password" id="password" class="form-control" value="" size="20" type="password">
                            <span class="error"><?php echo  form_error('password'); ?></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Confirm Password <span class="required"> * </span> </label>
                            <input required name="con_password" id="con_password" class="form-control" value="" size="20" type="password">
                            <span class="error"><?php echo  form_error('con_password'); ?></span>
                        </div>
                    </div>


                    <script type="text/javascript">
                        $('#accreditation_num').blur(function(){
                            var acc_code = $(this).val();
                            var company_email = $('#company_email').val();
                            if(company_email == ''){
                                $('#err_company_email').html('Company email shouldn\'t be blank!').css('color','red');
                                return false;
                            }else{
                                $('#err_company_email').hide();
                            }
                            var settings = {
                                "url": "https://ceonpoint.com/roadtraffic/admin/api/validateCarCompany",
                                "method": "POST",
                                "timeout": 0,
                                "headers": {
                                    "Content-Type": "application/json"
                                },
                                "data": JSON.stringify({
                                    "email": company_email,
                                    "cpd_code": acc_code
                                }),
                            };

                            $.ajax(settings).done(function (response) {
                                var obj = JSON.parse(response)
                                if(obj.error == true){
                                    $('#err_accriditaion').html(obj.msg).css('color','red');
                                    return false;
                                }else{
                                    $('#err_accriditaion').html(obj.msg).css('color','green');                                  
                                }
                                console.log(obj.error);
                            });
                        });
                        

                         function showsection(){
                             var under_institution = $('#under_institution').val(); 

                            // if(under_institution==1){
                            // $('#ins').show();
                            // $('#ins_code').show();
                            // } else {
                            // $('#ins').hide();
                            // $('#ins_code').hide();
                            // }

                             if(under_institution==0){
                                $('#accreditation').show();
                                $('#span').show();
                                $('#ins').hide();
                                $('#span1').hide();

                                $("#institution").val('').attr("required", false);
                                $("#institution_code").val('').attr("required", false);
                                $("#accreditation_num").val('').attr("required", true);
                                $("#validity").val('').attr("required", true);
                                $("#issuing_institution").val('').attr("required", true);

                             } else {

                                $('#accreditation').hide();
                                $('#span').hide();
                                $('#ins').show();
                                $('#span1').show();
                                
                                // $('#ins').hide();
                                //$('#ins_code').hide();
                                $("#institution").val('').attr("required", true);
                                $("#institution_code").val('').attr("required", true);
                                $("#accreditation_num").val('').attr("required", false);
                                $("#validity").val('').attr("required", false);
                                $("#issuing_institution").val('').attr("required", false);
                             }
                        }

                        $(document).ready(function(){
                             // alert('under_institution');
                            $('#accreditation').show();
                            $('#span').show();
                            $('#ins').hide();
                            $('#span1').hide();

                            $("#institution").val('').attr("required", false);
                            $("#institution_code").val('').attr("required", false);
                            $("#accreditation_num").val('').attr("required", true);
                            $("#validity").val('').attr("required", true);
                            $("#issuing_institution").val('').attr("required", true);   
                        });

                    </script>