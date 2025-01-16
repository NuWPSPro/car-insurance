 

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Name of Institution:</label>
                            <input name="name" id="name" class="form-control"  size="20" type="text" required value="<?php echo set_value('name'); ?>">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Country <span class="required"> * </span> </label>
                            <div class="selection-box">
                            <?php   $this->db->order_by('countries_name','ASC');
                            $country = $this->user->get_record_by_field_name_all_record('countries','status',1); ?>
                              <select required name="country_name" id="country_name" class="form-control">
                                  <option value="">Select Country</option>
                                  <?php foreach ($country as $key => $value) { ?>
                                  <option value="<?php echo $value['countries_id']; ?>"><?php echo $value['countries_name']; ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>State </label> 
                            <input type="text" name="state" id="state" class="form-control" value="<?php echo set_value('state'); ?>"> 
                        </div>
                    </div>


                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>City <span class="required"> * </span></label> 
                            <input required type="text" name="city" id="city" class="form-control" value="<?php echo set_value('city'); ?>"> 
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Street <span class="required"> * </span></label> 
                            <input required type="text" name="street" id="street" class="form-control" value="<?php echo set_value('street'); ?>"> 
                        </div>
                    </div>

                            <input type="hidden" name="role" id="role" value="5"> 

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name of Representative <span class="required"> * </span></label> 
                            <input required type="text" name="representative_name" id="representative_name" class="form-control" value="<?php echo set_value('representative_name'); ?>"> 
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Designation <span class="required"> * </span></label> 
                            <input required type="text" name="designation" id="designation" class="form-control" value="<?php echo set_value('designation'); ?>"> 
                        </div>
                    </div>



                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Telephone <span class="required"> * </span></label> 
                            <input required type="text" name="mobile" id="mobile" class="form-control" value="<?php echo set_value('mobile'); ?>"> 
                        </div>
                    </div> 


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Skype</label> 
                            <input type="text" name="skype" id="skype" class="form-control" value="<?php echo set_value('skype'); ?>"> 
                        </div>
                    </div>


                     <div class="col-sm-6">
                        <div class="form-group">
                            <label>Website </label> 
                            <input type="text" name="website" id="website" class="form-control" value="<?php echo set_value('website'); ?>"> 
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Institution Category <span class="required"> * </span> </label>
                            <div class="selection-box">
                            <?php   $this->db->order_by('cat_name','ASC');
                            $category = $this->user->get_record_by_field_name_all_record('tbl_category_institution','status',1); ?>
                              <select required name="profession" id="profession" class="form-control">
                                  <option value="">Select Category</option>
                                  <?php foreach ($category as $key => $value) { ?>
                                  <option value="<?php echo $value['id']; ?>"><?php echo $value['cat_name']; ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                        </div>
                    </div>



                      <div class="col-sm-4">
                        <div class="form-group">
                            <label>Are you under institution?</label> 
                           <select onchange="showsection()" name="under_institution" id="under_institution" class="form-control">
                               <option value="0" selected>No</option>
                               <option value="1">Yes</option>
                           </select> 
                        </div>
                    </div>

                    <span id="ins" style="display: none;">
                     <div class="col-sm-4">
                        <div class="form-group">
                        <?php $where = array('role'=>5,'under_insititution'=>0);
                              $this->db->order_by('name','ASC');
                              $insititution = $this->user->get_record_by_multi_field_name('tbl_user',$where); ?>
                          <label>Select institution </label> 
                          <select  name="institution" id="institution" class="form-control">
                            <option value="" selected>Please Select</option>
                            <?php foreach ($insititution as $key => $value){ ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php } ?>
                          </select> 
                        </div>
                    </div>

                     <div class="col-sm-4">
                        <div class="form-group">
                          <label>Enter institution code </label> 
                          <input type="text" name="institution_code" id="institution_code" class="form-control" value="<?php echo set_value('institution_code'); ?>"> 
                        </div>
                    </div>
                  </span>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Photo <span class="required"> * </span></label>
                            <input required name="photo" type="file" id="exampleInputFile" class="btn btn-primary">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Username (email)<span class="required"> * </span> </label>
                            <input required name="username" id="username" class="form-control"   size="20" type="text" value="<?php echo set_value('username'); ?>">
                            <span class="error"><?php echo  form_error('username'); ?></span>
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
                            <input required name="con_password" id="con_password" class="form-control" value="" size="20" type="password">
                            <span class="error"><?php echo  form_error('con_password'); ?></span>
                        </div>
                    </div>

                   
                   

                    <script type="text/javascript">
                        function showfield(){
                            var types = $('#exp_date').val();
                             
                            if(types=="life_time"){
                                $('#validity').val('life_time');
                                $('#formshow').hide();
                            } else {
                                $('#formshow').show();
                            }

                        }
                        $(document).ready(function(){
                            $('.purposeCE input').click(function(){
                                var radVal = $(this).val();
                                if(radVal == 'option1') {
                                    $('#datePerformance').hide();
                                } else {
                                    $('#datePerformance').show();
                                }
                            });
                        });



                        function showsection(){
                             var under_institution = $('#under_institution').val();
                             if(under_institution==1){
                                $('#ins').show();
                                $('#ins_code').show();

                                $("#institution").val('').attr("required", true);
                                $("#institution_code").val('').attr("required", true);

                             } else {
                                $('#ins').hide();
                                $('#ins_code').hide();
                                $("#institution").val('').attr("required", false);
                                $("#institution_code").val('').attr("required", false);
                             }
                        }

                         $(document).ready(function(){
                            $('#ins').hide();
                            $('#ins_code').hide();
                            $("#institution").val('').prop("required", false);
                            $("#institution_code").val('').prop("required", false);
                          });
                    </script>