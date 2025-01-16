<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">

                <div class="pull-right">
                    <a href="#"><input type="button" name="free" id="free" value="PROFESSIONAL VERSION" class="btn btn-danger"> </a> 

                    <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn  btn-primary"> </a>
                </div>


                <h3 class="border-title text-left">Upload Training/Seminar</h3>


                <div class="step-wise-query provider-overview">
                    <?php $this->load->view('provider/training_menu'); ?>
                    <div class="tab-content steps-detail">
                        <div id="step1" class="tab-pane fade in active">
                    


                <div class="row field_wrapper">
                                  
                  <form method="post" action="<?php echo site_url('provider/training_committee_save'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                
                <?php echo $this->session->flashdata('response');?>
                

 

                <div class="after-add-more">
                <div class="col-sm-3">
                <div class="form-group">
                <label for="exampleInputEmail1">Committee Member's Name<sup>*</sup></label>
                <input type="text" class="form-control" name="committee_name[]"  placeholder="Enter committee name" required> 
                </div>
               </div>


                <div class="col-sm-3">
                <div class="form-group">
                <label for="exampleInputEmail1">Designation<sup>*</sup></label>
                <input type="text" class="form-control" name="degination[]"  placeholder="Enter degination name" required> 
                </div>
               </div>
                

                <div class="col-sm-4">
                <div class="form-group">
              <label for="exampleInputEmail1">Committee Image<sup>*</sup></label>
                <input type="file" class="form-control" name="userfile[]" required> 
                </div>  
                </div>

                <div class="col-sm-2">
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
                <!-- <button type="submit" name="submit" value="save" class="btn btn-info">Save</button> -->
                <button type="submit" name="submit" value="save_next" class="btn btn-success"> Save & Next</button>
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
        $(html).find(".change").html("<div style='margin-top: 33px;' class='d-flex'><a class='btn btn-success add-more'>+ Add</a><a class='btn btn-danger remove'>- Remove</a></div>");
        $(".after-add-more").last().after(html);
    });
    $("body").on("click", ".remove", function() {
        $(this).parents(".after-add-more").remove();
    });
});
</script>
