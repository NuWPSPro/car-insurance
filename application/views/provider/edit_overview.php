<?php $this->load->view('template/picture_provider');  
    $cid = $this->uri->segment(3);
    $author = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array();

    if($author['author_reference_id'] > 0){
        $uid = $author['user_id'];
    }else{
        $uid = $this->session->userdata('logged_in')['id'];
    }

    $counrty = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['country'];

    $tax = $this->db->get_where('countries',array('countries_id'=>$counrty,'tax >'=>0))->row_array()['tax']; 
    if($tax){ $taxrate = $tax; }else{ $taxrate = 0; } //default taxrate ?>


<div class="innerContent">
    <div class="container">
        <div class="row">
            
            <?php 	$this->load->view('provider/sidebar'); ?>

            <div class="col-sm-9">
                <h3 class="mt-1"><?php echo $course[0]['course_title']; ?></h3>
                <div class="clearfix">
                    <h3 class="border-title pull-left">Edit Overview</h3>
                    <a href="<?=base_url('provider/course_listing')?>" class="btn btn-primary pull-right">Back to Online Course Listing</a>
                </div>

                <div class="step-wise-query provider-overview">

                    <ul class="nav-tabs hidden-xs">
                        <li class="active"><a  href="<?php echo site_url('provider/course_edit/').$cid; ?>">Overview</a></li>
                        <li><a  href="<?php echo site_url('provider/lesson_edit/').$cid; ?>">Lessons</a></li>
                        <li><a  href="<?php echo site_url('provider/edit_quiz/').$cid; ?>">Quiz</a></li>
                        <li><a  href="<?php echo site_url('provider/edit_certificate/').$cid; ?>">Certificate</a></li>
                        <li><a  href="<?php echo site_url('provider/edit_evaluation/').$cid; ?>">Evaluation</a></li>
                        <?php if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ ?>
                        <li><a href="<?php echo site_url('provider/edit_promotion/').$cid; ?>">Promotion</a></li>
                        <?php } ?>
                        <li><a  href="<?php echo site_url('provider/edit_publish/').$cid; ?>">Publish</a></li>
                    </ul>

                    <div class="tab-content steps-detail">

                        <a class="title-mobile" data-toggle="tab" href="#step1">Course Overview</a>

                        <div id="step1" class="tab-pane fade in active">

                            <?php echo $this->session->userdata('edit_current_course_id');
                                  //echo validation_errors()  ?>

                            <form action="<?php echo site_url('provider/course_edit/').$cid; ?>" method="post" enctype="multipart/form-data" name="editoverview" id="editoverview">

                                <div class="row">

                                    <?php echo $this->session->flashdata('response');?>

                                    <div class="col-sm-12 form-group">

                                        <label>Course Title <sup>*</sup></label>

                                        <input type="text" class="form-control" name="course_title" id="course_title" value="<?php echo $course[0]['course_title']; ?>" required>

                                        <span class="error"><?php echo  form_error('course_title'); ?></span>

                                    </div>


                                <?php  if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ ?>
                                     <div class="col-sm-6 form-group">
                                        <label>Price <sup>*</sup></label>
                                        <input type="number" class="form-control" name="price" id="price" value="<?php echo $course[0]['price']; ?>" placeholder="10.00" readonly>
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
                                    <div class="col-sm-12 form-group" id="taxcal" >
                                        <label>Price with Tax<sup>*</sup></label>
                                        <input type="number" class="form-control" name="total" id="total" value="<?php echo $course[0]['total']; ?>" readonly>
                                    </div>
                                <?php } ?>

                                    <div class="col-sm-12 form-group">
                                        <label>Unit/s <sup>*</sup></label>
                                        <select class="form-control" name="units" id="units" readonly>
                                            <?php for ($i=1; $i <=10 ; $i++) { ?>
                                                <option <?php if($course[0]['units']==$i){ echo "selected";} ?> value="<?php echo $i;?>">
                                                <?php echo $i;?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <span class="error"><?php echo  form_error('units'); ?></span>
                                    </div>


                                    <div class="col-sm-12 form-group">

                                        <label>Course Acceditation Number </label>

                                        <input type="text" class="form-control" name="acceditation_no" id="acceditation_no" value="<?php echo $course[0]['course_acceditation_number']; ?>" readonly>

                                        <span class="error"><?php echo  form_error('acceditation_no'); ?></span>

                                    </div>

                                    <div class="col-sm-12 form-group">

                                        <label>Course Validity </label>

                                        <input type="date" class="form-control" name="course_validity" id="course_validity" value="<?php echo $course[0]['course_validity']; ?>" readonly>

                                        <span class="error"><?php echo  form_error('course_validity'); ?></span>

                                    </div>

                    <div class="col-sm-12 form-group">
                        <label>Other Professions who can take this course<sup>*</sup></label>
                        <?php  $professiondata = explode(', ',$course[0]['profession']);
                       // echo '<pre>'; print_r($professiondata); ?>
                        <select name="profession[]" id="profession" class="form-control" multiple required>
                            <?php  foreach ($profession as $key => $value) { ?>
                            <option <?php if (in_array($value['id'], $professiondata)){ 
                                echo "selected";} ?> value="<?php echo $value['id'];?>">
                                <?php echo $value['cat_name'];?>
                            </option>
                            <?php } ?>
                        </select>
                        <span class="error"><?php echo  form_error('profession'); ?></span>
                    </div>

                    <div class="col-sm-12 form-group">
                        <label>Course Category <sup>*</sup></label>
                            <select name="category" id="category" class="form-control" required>            
                            <?php foreach ($profession as $key => $value){ ?>
                            <option <?php if($userdetails[0]['profession']==$value[ 'cat_name']){ echo "selected";} ?> value="<?php echo $value['id'];?>"><?php echo $value['cat_name'];?></option>
                            <?php } ?>
                        </select>
                        <span class="error"><?php echo  form_error('category'); ?></span>
                    </div>

                    <div class="col-sm-6 form-group">

                        <label>Attach Course Photo <sup>*</sup><span id="cancel1" title='Cancel'>X</span></label>

                        <input type="file" class="form-control" name="image" id="image" value="<?php echo set_value('image'); ?>">

                        <span class="error"><?php echo form_error('image'); ?></span><br>

                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$course[0]['course_photo']; ?>" height="50" width="50">

                    </div>
									
                <div class="col-sm-6 form-group">
                    <label>Attach Video <sup>Please add mp4 only of size (less than 10MB) </sup><span id="cancel" title='Cancel'>X</span></label>
                    <input type="file" class="form-control" name="video" id="video" value="">
                    <span class="error"><?php echo  form_error('video'); ?></span>
                    
                </div>


                <div class="col-sm-12 form-group">
                    <label>Course Description <sup>*</sup></label>
                        <textarea class="form-control text_editor" name="course_description" id="course_description">
                            <?php echo $course[0]['course_description']; ?>
                        </textarea>
                        <span class="error"><?php echo  form_error('course_description'); ?></span>
                </div>

                <div class="col-sm-12 form-group">
                    <label>Course Objectives </label>
                    <!--  <div class="control-group input-group row" id="morefield" style="display: flex; align-items: center;"> -->
                        <textarea class="form-control text_editor" name="objective" id="objective"><?php echo $course[0]['objective']; ?></textarea>
                    </div>
                </div>


                                         



                                   <div class="col-md-9">

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
<script type="text/javascript">

    $(document).ready(function() {
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
        }
    }

</script>