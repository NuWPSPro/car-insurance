<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <!-- <div class="col-sm-12">
                <a href="<?php echo site_url('provider/dashboard'); ?>"> <h3 class="border-title text-left">Dashboard</h3></a>
            </div> -->
            <?php 
            //$this->load->view('provider/sidebar');
            ?>
            <div class="col-sm-12">


                 <div class="pull-right">
                    <a href="#">
                        <input type="button" name="free" id="free" value="PROFESSIONAL VERSION" class="btn btn-danger"> </a> 

                    <a href="#">
                        <input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn  btn-primary"> </a>
                    </div>

                    
                <h3 class="border-title text-left">Upload Training/Seminar</h3>

                 


                <div class="step-wise-query provider-overview">
                    <?php $this->load->view('provider/training_menu'); ?>
                    <div class="tab-content steps-detail">
                        <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                        <div id="step1" class="tab-pane fade in active">
                            <!-- <ul class="nav-tabs hidden-xs">
                                <li><a href="<?php echo site_url()?>/provider/training_center">General Info</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_overview">Overview</a></li>

                                <li class="active"><a href="<?php echo site_url()?>/provider/training_speaker">Speaker</a></li>
                                
                                <li><a href="<?php echo site_url()?>/provider/training_schedule">Schedule</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_evaluation">Evaluation</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_promotion">Promotion</a></li>
                                <li><a href="<?php echo site_url()?>/provider/training_publish">Publish</a></li>
                            </ul> -->

                             
<!-- 
                            <?php 

                $totsubs = 0;
                foreach ($purchase_plan as $key => $value) {
                    $totsubs = $totsubs+$value['no_of_subscription'];
                }
                
 
                ?> -->

                <div class="row field_wrapper">
                                  
                <form method="post" action="<?php echo site_url('provider/training_sponsors_save'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                
                <?php echo $this->session->flashdata('response');?>
                

 

                <div class="after-add-more">
                <div class="col-sm-2">
                <div class="form-group">
                <label for="exampleInputEmail1">Sponsor Name<sup>*</sup></label>
                <input type="text" class="form-control" name="sponsor_name[]"  placeholder="Enter sponsor name" required> 
                </div>
               </div>


                <div class="col-sm-3">
                <div class="form-group">
                <label for="exampleInputEmail1">Website<sup>*</sup></label>
                <input type="text" class="form-control" name="sponsor_url[]"   pattern="https?://.+" 
               title="Include http://" placeholder="Enter sponsor url" required> 
                </div>
               </div>
                

                <div class="col-sm-4">
                <div class="form-group">
                <label for="exampleInputEmail1">Sponsor Image<sup>*</sup></label>
                <input type="file" class="form-control" name="userfile[]" required> 
                </div>  
                </div>

                <div class="col-sm-3">
                <div class="form-group change">
                <label for="">&nbsp;</label>
                <br/>
                <a class="btn btn-success add-more">+ Add</a>
                </div>
                </div>


               </div>


                <div class="col-sm-6">
                <div class="form-group change">
                <label for="">&nbsp;</label>
                <br/>
                <!-- <a class="btn btn-success add-more">+ Add</a> -->
                <button type="submit" class="btn btn-primary">Save & Next</button>
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
        var html = $(".after-add-more").first().clone().find("input:text,input:file").val("").end();
        //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
        $(html).find(".change").html("<div style='margin-top: 33px;' class='d-flex'><a class='btn btn-success add-more'>+ Add</a><a class='btn btn-danger remove'>- Remove</a></div>");
        $(".after-add-more").last().after(html);
    });
    $("body").on("click", ".remove", function() {
        $(this).parents(".after-add-more").remove();
    });
});
</script>



<!-- 
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="appendcontent"><div class="col-sm-5"><div class="form-group"><label for="exampleInputEmail1">sponsor Name<sup>*</sup></label><input type="text" class="form-control" name="sponsor_name[]"  placeholder="Enter sponsor name" required></div></div><div class="col-sm-5"><div class="form-group"><label for="exampleInputEmail1">sponsor Image<sup>*</sup></label><input type="file" class="form-control" name="sponsor_image[]" required></div></div><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script> -->