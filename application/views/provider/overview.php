<?php $this->load->view('template/picture_provider'); 
    $uid = $this->session->userdata('logged_in')['id'];
    $counrty = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['country'];
    $tax = $this->db->get_where('countries',array('countries_id'=>$counrty,'tax >'=>0))->row_array()['tax']; 
    if($tax){ $taxrate = $tax; }else{ $taxrate = 7; } //default taxrate 
?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <?php  $this->load->view('provider/sidebar');  ?>

            <div class="col-sm-9">
            <?php echo $this->session->flashdata('response');?>
                <h3 class="border-title text-left">Create Online Course</h3>
                <div class="step-wise-query provider-overview">

                    <ul class="nav-tabs hidden-xs">
                        <li class="active"><a href="<?php echo site_url('provider/overview')?>">Overview</a></li>
                        <li><a href="<?php echo site_url('provider/lesson'); ?>">Lessons</a></li>
                        <li><a href="<?php echo site_url('provider/quiz'); ?>">Quiz</a></li>
                        <li><a href="<?php echo site_url('provider/certificate'); ?>">Certificate</a></li>
                        <li><a href="<?php echo site_url('provider/evaluation'); ?>">Evaluation</a></li>
                    <?php 
                         if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ ?>
                        <li><a href="<?php echo site_url('provider/promotion'); ?>">Promotion</a></li>
                    <?php } ?>
                        <li><a href="<?php echo site_url('provider/publish'); ?>">Publish</a></li>
                    </ul>

                    <div class="tab-content steps-detail">
                        <div id="step1" class="tab-pane fade in active">
                            <h3>Course Overview</h3>
                            <?php //echo $this->session->userdata('edit_current_course_id');?>
                            <form action="<?php echo site_url('provider/overview');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="row">
                                    <?php //echo $this->session->flashdata('response');?>
                                    <div class="col-sm-12 form-group">
                                        <label>Course Title <sup>*</sup></label>
                                        <input type="text" class="form-control" name="course_title" id="course_title" value="<?php echo set_value('course_title'); ?>" required>
                                        <span class="error"><?php echo  form_error('course_title'); ?></span>
                                    </div>

                                   

                                <?php if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ ?>
                                    <div class="col-sm-6 form-group">
                                        <label>Price <sup>*</sup></label>
                                        <input type="number" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>" placeholder="10.00" readonly>
                                        <span class="error" id="tax-error"><?php echo  form_error('price'); ?></span>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>Tax (%)<sup>*</sup></label>
                                        <input type="number" class="form-control" name="tax" id="tax" value="<?php echo $taxrate; ?>" readonly>
                                       
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label> Price + Tax(%) </label>
                                        <button type="button" class="form-control btn btn-primary" onclick="taxcalculation()">Calcualte Tax</button>
                                    </div>
                                    <div class="col-sm-12 form-group" id="taxcal" style="display: none;">
                                        <label>Price with Tax<sup>*</sup></label>
                                        <input type="number" class="form-control" name="total" id="total" value="" readonly>
                                    </div>
                                <?php } ?>   
                                
                                    <div class="col-sm-12 form-group">
                                        <label>Unit/s <sup>*</sup></label>
                                        <select class="form-control" name="units" id="units" readonly>
                                        <?php for ($i=1; $i <=10 ; $i++) {     ?>
                                            <option value="<?php echo $i;?>"> <?php echo $i;?> </option>
                                        <?php  }  ?>
                                        </select>
                                        <span class="error"><?php echo form_error('units'); ?></span>
                                    </div>  

                                    <div class="col-sm-12 form-group">
                                        <label>Course Accreditation Number<sup>*</sup></label>
                                        <input type="text" class="form-control"placeholder="To be filled up by the CE Provider or Regulatory Board " name="acceditation_no" id="acceditation_no" value="<?php echo set_value('acceditation_no'); ?>" readonly>
                                        <span class="error"><?php echo  form_error('acceditation_no'); ?></span>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label>Course Validity<sup>*</sup></label>
                                        <input type="date" class="form-control" name="course_validity" id="course_validity" value="<?php echo set_value('course_validity'); ?>" readonly>
                                        <span class="error"><?php echo  form_error('course_validity'); ?></span>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label>Other professions who can use this course <sup>*</sup></label>
                                        <select name="profession[]" id="profession" class="form-control" multiple required>
                                            <?php foreach ($profession as $key => $value){  ?>
                                            <option value="<?php echo $value['id'];?>">
                                                <?php echo $value['cat_name'];?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <span class="error"><?php echo  form_error('profession'); ?></span>
                                    </div>
                               
                            <?php $idd = $this->session->userdata('logged_in')['id']; 
                                  $currentUdata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$idd); ?>    

                                <input type="hidden" readonly class="form-control" name="category" id="category" value="<?php echo $userdetails[0]['profession']; ?>">

                                <input type="hidden" readonly class="form-control" name="cpdprovider" id="cpdprovider" value="<?php echo $this->session->userdata('logged_in')['profession']; ?>">    

                                <input type="hidden" class="form-control" name="prc_acceditation_no" id="prc_acceditation_no" value="<?php echo $currentUdata[0]['prc_acceditation_number']; ?>">

                                <input type="hidden" class="form-control" name="acceditation_validity" id="acceditation_validity" value="<?php echo $currentUdata[0]['added_on']; ?>">
                               
                                    <div class="col-sm-6 form-group">
                                        <label>Attach Photo <sup>*</sup><span id="cancel1" title='Cancel'>X</span></label>
                                        <input type="file" class="form-control" name="image" id="image" value="<?php echo set_value('image'); ?>" required>
                                        <!-- <span class="error"><?php echo  form_error('image'); ?></span> -->
                                    </div>

                                     <div class="col-sm-6 form-group">
                                        <label>Attach Video <span style="color:#808080;">Please add mp4 only of size (less than 3MB) </span><span id="cancel" title='Cancel'>X</span></label>
                                        <input type="file" class="form-control" name="video" id="video">
                                        <!-- <span class="error"><?php echo  form_error('video'); ?></span> -->
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label>Course Description <sup>*</sup></label>
                                        <textarea class="form-control text_editor" name="course_description" id="course_description"><?php echo set_value('course_description'); ?></textarea>
                                        <span class="error"><?php echo  form_error('course_description'); ?></span>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label>Course Objectives<sup>*</sup> </label>
                                        <textarea class="form-control text_editor" name="objective" id="objective"><?php echo set_value('objective'); ?></textarea>
                                    </div>
                                       
                                    <div class="col-sm-12 form-group">
                                        <input type="submit" class="btn btn-primary btn-lg" value="SAVE & NEXT">
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
<div class="copy-fields hide">
    <div class="control-group input-group row" style="display: flex; align-items: center; margin-top: 10px;">
        <div class="col-md-9">
            <input type="text" name="objective[]" class="form-control">
        </div>
        <div class="col-md-3">
            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-minus"></i> Remove</button>
        </div>
    </div>
</div>
 <style>
 .multiselect-container{
	     height: 300px;
         overflow: scroll;
 }
 </style>

   <!-- Modal  Register Sub institutions-->
    <div id="send_success" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Success</h4>
                </div>

                <div class="modal-body">
                    <?php echo $this->session->flashdata('response-a'); ?> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
                                       
$(document).ready(function() {
    var sendsuccess = '<?php if($_REQUEST['id']=="success"){ ?>' + $("#send_success").modal('show'); + '<?php } ?>';
    //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
    $(".add-more").click(function() {
        var html = $(".copy-fields").html();
        $("#morefield").after(html);
    });
    //here it will remove the current value of the remove button which has been pressed
    $("body").on("click", ".remove", function() {
        $(this).parents(".control-group").remove();
    });

    $("#price").blur(function() {
        alert('Please click the Calculate Tax button.');
    });

    $('#cancel').click(function(){$('#video').val("");});
    $('#cancel1').click(function(){$('#image').val("");});
	$('#profession').multiselect();
});

function taxcalculation(){
    var price   = $('#price').val();
    if(price==''){
        $('#tax-error').html('Please fill the price.').css('color','red');
    }else{
        var tax     = $('#tax').val();
        var taxrate  = ((price * tax)/100).toFixed(2);
        var total  =  parseFloat(price) +  parseFloat(taxrate);

        $('#total').val(total);
        $('#taxcal').show();
    }
}

</script>