 

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Name of Professional Regulatory Board/Council:</label>
                            <input name="name" id="name" class="form-control"  size="20" type="text" required value="<?php echo set_value('name'); ?>">
                            <input type="hidden" name="role" id="role" value="7"> 
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


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name of Representative <span class="required"> * </span></label> 
                            <input required type="text" name="representative" id="representative" class="form-control" value="<?php echo set_value('representative'); ?>"> 
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


                    <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label>Skype</label> 
                            <input type="text" name="skype" id="skype" class="form-control" value="<?php echo set_value('skype'); ?>"> 
                        </div>
                    </div> -->


                     <div class="col-sm-6">
                        <div class="form-group">
                            <label for="website">Domain (url) (Domain url should contain '/' in the last)</label> 
                            <input type="url" name="website" id="website" class="form-control" value="<?php echo set_value('website','https://www.'); ?>"> 
                        </div>
                    </div>

                    <!-- <div class="col-sm-12">
                        <div class="form-group">
                            <label for="registering_body">File Path (This path will store your data which is comming from another domain like user certificates as pdf) <br>
                            Like: /home1/n6fbcdjk/public_html/'DOMAIN NAME'/assets/uploads/pdf/</label>
                            <input name="registering_body" type="text" id="registering_body" class="form-control">
                        </div>
                    </div> -->

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

                   
                