<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <?php  $training_types = $this->session->userdata('training_types');	?>
            <div class="col-sm-12">

                  <div class="pull-right">
                    <?php if($training_types=="pro"){ ?>
                        <a href="#"><input type="button" name="free" id="free" value="PROFESSIONAL VERSION" class="btn-danger"></a>
                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-primary"></a>
                    <?php }else{ ?>
                        <a href="#"><input type="button" name="free" id="free" value="FREE VERSION" class="btn-primary"></a>
                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-success"> </a>
                    <?php } ?>
                    </div>

                    
                <h3 class="border-title text-left">Training Overview</h3>

                <div class="step-wise-query provider-overview">
                    <?php $this->load->view('provider/training_menu'); ?>
                    <div class="tab-content steps-detail">
                        <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                        <div id="step1" class="tab-pane fade in active">
                            <!-- <ul class="nav-tabs hidden-xs">
                                <li><a href="<?php echo site_url()?>/provider/training_center">General Info</a></li>
                                <li class="active"><a href="<?php echo site_url()?>/provider/training_overview">Overview</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_speaker">Speaker</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_schedule">Schedule</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_evaluation">Evaluation</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_promotion">Promotion</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_publish">Publish</a></li>
                            </ul> -->

                            
                            
                            <form action="<?php echo site_url();?>/provider/training_overview" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="row">
                                    <?php echo $this->session->flashdata('response');?>
                                   <!--  <div class="col-sm-12 form-group">
                                        <label>Title <sup>*</sup></label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>">
                                        <span class="error"><?php echo  form_error('title'); ?></span>
                                    </div> -->
                                   
                                    <div class="col-sm-12 form-group">
                                        <label>Training Overview <sup>*</sup></label>
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
                                    <?php if($training_types=="pro"){ ?>
                                    <div class="col-sm-12 form-group">
                                        <label for="exampleInputEmail1">Speaker's Page Background Image<sup>*</sup></label>
                                        <input type="file" class="form-control" id="background_image" name="background_image" required> 
                                        <span class="error"><?php echo  form_error('background_image'); ?></span>
                                    </div>
                                    <?php } ?>
                                    <div class="col-sm-12 form-group">
                                        <label>Who can attend this training? <sup>*</sup></label>
                                        <?php 
                                        $this->db->order_by('cat_name','asc');
                                        $cat = $this->user->get_record_by_field_name_all_record('tbl_category','status',1);
                                        ?>
                                        <select multiple name="participants[]" id="profession" class="form-control">
                                            <option value="" selected>Please Select</option>
                                            <?php 
                                            foreach ($cat as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['cat_name']; ?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                        <span class="error"><?php echo  form_error('participants'); ?></span>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label>Item/s to bring <sup>*</sup></label>
                                        <input type="text" class="form-control" name="item" id="item" value="<?php echo set_value('item'); ?>">
                                        <span class="error"><?php echo  form_error('item'); ?></span>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input type="submit" class="btn btn-primary btn-lg" value="Save & Next">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("body").on("click", ".add-more", function() {
        var html = $(".after-add-more").first().clone();
        $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
        $(".after-add-more").last().after(html);
    });

    $("body").on("click", ".remove", function() {
        $(this).parents(".after-add-more").remove();
    });
});
</script>


 <style>
 .multiselect-container{
         height: 300px;
         overflow: scroll; 
 }

button.multiselect.dropdown-toggle.btn.btn-default {
    background-color: #007ded;
    color: white;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#profession').multiselect();
    });
</script>