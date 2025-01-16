 <table class="table table-bordered" style="width:100%">
                        <tr>

                            <td style="padding: 0; background: #eee;">
                                <ul class="navlist newpanel">
                                    <li class="active"><a href="<?php echo site_url('provider/upload_information'); ?>">General Information</a></li>
                                    <li ><a href="<?php echo site_url('provider/upload_information/overview'); ?>">Overview</a></li>
                                    <li ><a href="#">Speakers</a></li>
                                    <li ><a href="#">Schedule</a></li>
                                    <li ><a href="#">Evaluation</a></li>
                                    <li ><a href="#">Sponsor</a></li>
                                    <li ><a href="#">Committee</a></li>
                                    <li ><a href="#">Promotion</a></li>
                                    <li ><a href="#">Publish</a></li>
                                </ul>
                            </td>
                            <td>
                                <div class="newpanelRyt" style="width: 534px;">
                    <?php 

                    $totsubs = 0;
                    foreach ($purchase_plan as $key => $value) {
                        $totsubs = $totsubs+$value['no_of_subscription'];
                    }
                    

                    if(count($training) <= 2 || $totsubs>2){
                    ?>
                            <form action="<?php echo site_url();?>/provider/training_center" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="row">
                                    <?php echo $this->session->flashdata('response');?>
                                    <div class="col-sm-12 form-group">
                                        <label>Category <sup>*</sup></label>
                                        <select class="form-control" name="category" id="category">
                                            <?php 
                            foreach ($cat as $key => $value) {
                            ?>
                                            <option value="<?php echo $value['id'];?>">
                                                <?php echo $value['cat_name'];?>
                                            </option>
                                            <?php 
                            }
                            ?>
                                        </select>
                                        <span class="error"><?php echo  form_error('category'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Start Date <sup>*</sup></label>
                                        <input type="text" class="form-control datepicker" name="start_date" id="start_date" value="<?php echo set_value('start_date'); ?>">
                                        <span class="error"><?php echo  form_error('start_date'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>End Date <sup>*</sup></label>
                                        <input type="text" class="form-control datepicker" name="end_date" id="end_date" value="<?php echo set_value('end_date'); ?>">
                                        <span class="error"><?php echo  form_error('end_date'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Start Time <sup>*</sup></label>
                                        <input type="time" class="form-control" name="start_time" id="start_time" value="<?php echo set_value('start_time'); ?>">
                                        <span class="error"><?php echo  form_error('start_time'); ?></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>End Time <sup>*</sup></label>
                                        <input type="time" class="form-control" name="end_time" id="end_time" value="<?php echo set_value('end_time'); ?>">
                                        <span class="error"><?php echo  form_error('end_time'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Units <sup>*</sup></label>
                                        <input type="text" class="form-control" name="units" id="units" value="<?php echo set_value('units'); ?>">
                                        <span class="error"><?php echo  form_error('units'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Location <sup>*</sup></label>
                                        <input type="text" class="form-control" name="location" id="location" value="<?php echo set_value('location'); ?>">
                                        <span class="error"><?php echo  form_error('location'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Speaker <sup>*</sup></label>
                                        <input type="text" class="form-control" name="speaker" id="speaker" value="<?php echo set_value('speaker'); ?>">
                                        <span class="error"><?php echo  form_error('speaker'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Ticket Price <sup>*</sup></label>
                                        <input type="text" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>">
                                        <span class="error"><?php echo  form_error('price'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Contact Person <sup>*</sup></label>
                                        <input type="text" class="form-control" name="c_person" id="c_person" value="<?php echo set_value('c_person'); ?>">
                                        <span class="error"><?php echo  form_error('c_person'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Email <sup>*</sup></label>
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>">
                                        <span class="error"><?php echo  form_error('email'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Phone Number <sup>*</sup></label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone'); ?>">
                                        <span class="error"><?php echo  form_error('phone'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>CP Number <sup>*</sup></label>
                                        <input type="text" class="form-control" name="cp_number" id="cp_number" value="<?php echo set_value('cp_number'); ?>">
                                        <span class="error"><?php echo  form_error('cp_number'); ?></span>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input type="submit" class="btn btn-primary btn-lg" value="NEXT">
                                    </div>
                                </div>
                            </form>
                            <?php 
                 } else {
                    ?>
                            <p>You have already created two seminars.Please purchase subscription now.<br><br>
                                <input type="button" name="paynow" class="btn" value="PAY NOW" data-toggle="modal" data-target="#myModal">
                            </p>
                            <?php 
                 }
                ?>
                                </div>
                            </td>
                        </tr>
                    
                        
                    </table> 