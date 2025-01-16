 <table class="table table-bordered" style="width:100%">
                        <tr>

                            <td style="padding: 0; background: #eee;">
                                <ul class="navlist newpanel">
                                    <li><a href="<?php echo site_url('provider/upload_information'); ?>">General Information</a></li>
                                    <li class="active"><a href="<?php echo site_url('provider/upload_information/overview'); ?>">Overview</a></li>
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
                                      <form action="<?php echo site_url();?>/provider/training_overview" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="row">
                                    <?php echo $this->session->flashdata('response');?>
                                    <div class="col-sm-12 form-group">
                                        <label>Title <sup>*</sup></label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>">
                                        <span class="error"><?php echo  form_error('title'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Attached Photo <sup>*</sup></label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        <span class="error"><?php echo  form_error('image'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Attached Promo Video</label>
                                        <input type="file" class="form-control" name="video" id="video">
                                        <span class="error"><?php echo  form_error('video'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Description <sup>*</sup></label>
                                        <textarea class="form-control text_editor" name="description" id="description"><?php echo set_value('description'); ?></textarea>
                                        <span class="error"><?php echo  form_error('description'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Objectives <sup>*</sup></label>
                                        <textarea class="form-control text_editor" name="objectives" id="objectives"><?php echo set_value('objectives'); ?></textarea>
                                        <span class="error"><?php echo  form_error('objectives'); ?></span>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Methodologies <sup>*</sup></label>
                                        <textarea class="form-control text_editor" name="methodologies" id="methodologies"><?php echo set_value('methodologies'); ?></textarea>
                                        <span class="error"><?php echo  form_error('methodologies'); ?></span>
                                    </div>
                                    
                                    <div class="col-sm-12 form-group">
                                        <label>Participants <sup>*</sup></label>

                                        <?php 
                                        $cat = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
                                        ?>
                                        <select name="participants" id="participants" class="form-control">
                                            <option value="" selected>Please Select</option>
                                            <?php 
                                            foreach ($cat as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['cat_name']; ?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <!--     <input type="text" class="form-control" name="participants" id="participants" value="<?php //echo set_value('participants'); ?>"> -->
                                        <span class="error"><?php echo  form_error('participants'); ?></span>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label>Item to bring <sup>*</sup></label>
                                        <input type="text" class="form-control" name="item" id="item" value="<?php echo set_value('item'); ?>">
                                        <span class="error"><?php echo  form_error('item'); ?></span>
                                    </div>


                                    <div class="col-sm-2 form-group">
                                        <input type="submit" class="btn btn-primary btn-lg" value="NEXT">
                                    </div>
                                </div>
                            </form>
                                </div>
                            </td>
                        </tr>
                    
                        
                    </table> 