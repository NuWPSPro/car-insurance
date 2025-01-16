<?php $this->load->view('template/picture_author'); ?>
<?php 
        $uid = $this->session->userdata('logged_in')['id']; 
        $uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
        $up_id = end(explode('-', $uprovider)); 
        $uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
        ?>
<div class="innerContent author-evaluation">
    <div class="container">
        <div class="row">
            <?php $this->load->view('author/sidebar'); ?>
            <div class="col-sm-9">
                <h3 class="border-title text-left">Create Course</h3>
                <div class="step-wise-query provider-overview">
                    <ul class="nav-tabs hidden-xs">
                        <li><a href="<?php echo site_url('author/overview')?>">Overview</a></li>
                        <li><a href="<?php echo site_url('author/lesson')?>">Lessons</a></li>
                        <li><a href="<?php echo site_url('author/quiz')?>">Quiz</a></li>
                        <li><a href="<?php echo site_url('author/certificate')?>">Certificate</a></li>
                        <li class="active"><a href="<?php echo site_url('author/evaluation')?>">Evaluation</a></li>
                        <?php if($uins == '0'){ ?>
                        <li><a href="<?php echo site_url('author/promotion')?>">Promotion</a></li>
                        <?php } ?>
                        <li><a href="<?php echo site_url('author/publish')?>">Publish</a></li>
                    </ul>
                    <div class="tab-content steps-detail">
                        <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                        <div id="step1" class="tab-pane fade in active">
                            <h3>Course Evaluation</h3>
                            <div class="row">
                                <?php echo $this->session->flashdata('response');?>
                                <form action="<?php echo site_url('author/evaluation');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">

                                <div class="form-group">
                                    <label>Evaluation Note</label>
                                    <textarea class="form-control text_editor" name="evaluation_description"><?php echo set_value('evaluation_description'); ?></textarea>
                                    <span class="error"><?php echo  form_error('evaluation_description'); ?></span>
                                </div>

                                <div class="after-add-more">
                                    <!-- <div class="row"> -->
                                        <div style="display: flex; align-items: center;">
                                            <div class="form-group col-md-3">
                                                <label>Select Question Type :</label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <input type="radio" name="evaluation_type[0]" value="1" checked> <span class="mode-span">Star Rating Question</span>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <input type="radio" name="evaluation_type[0]" value="2"> <span class="mode-span">Text Answer Question</span>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center;">
                                            <div class="form-group col-md-10">
                                                <input required type="text" name="question[0]" class="form-control" placeholder="Enter Evaluation Question here">
                                            </div>
                                          <div class="form-group col-md-2">
                                                <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <div class="col-sm-12 form-group">
                                    <input type="submit" class="btn btn-primary btn-lg" value="SAVE & NEXT">
                                </div>
                                <div class="col-md-12">
                                    <h3>Demo Evaluation on Ceonpoint</h3>
                                    <div style="border: 2px solid #0936b4;border-radius: 5px; margin: 5px 5px;">
                                        <img src="<?php echo ASSETS_URL.'images/evaluation_demo_img.png'?>">
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
<a href="#" id="scroll" style="display: block;"><span></span></a>

<style type="text/css">
[type=radio]:checked + span {
    border: 2px solid rgb(32, 223, 128);
    box-shadow: 0 0 10px rgba(32,223,128,.4);
    position: relative;
}
.mode-span{
    padding: 5px;
}

</style>

<script type="text/javascript">

$(document).ready(function() {
        var totaleditor = 1;
    $("body").on("click", ".add-more", function() {
        totaleditor++;
        var html = $(".after-add-more").append('<div style="display: flex; align-items: center;">\
                                <div class="form-group col-md-3">\
                                    <label>Select Question Type :</label>\
                                </div>\
                                <div class="form-group col-md-3">\
                                    <input type="radio" name="evaluation_type['+ totaleditor +']" value="1" checked> <span class="mode-span">Star Rating Question</span>\
                                </div>\
                                <div class="form-group col-md-3">\
                                    <input type="radio" name="evaluation_type['+ totaleditor +']" value="2"> <span class="mode-span">Text Answer Question</span>\
                                </div>\
                            </div>\
                            <div style="display: flex; align-items: center;">\
                                <div class="form-group col-md-9">\
                                    <input type="text" name="question['+ totaleditor +']" class="form-control" placeholder="Enter Evaluation Question Here">\
                                </div>\
                                <div class="form-group col-md-3 change">\
                                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>\
                                </div>\
                            </div>');

        $(html).find(".change").html("<button class='btn btn-success add-more' type='button'><i class='glyphicon glyphicon-plus'></i> Add</button><a class='btn btn-danger remove' style='padding: 5px 10px;margin-left: 5px;'>Remove</a>");
        $(".after-add-more").last(html).after(html);
    });
    $("body").on("click", ".remove", function() {
        $(this).parents(".after-add-more").remove();
    });
});

</script>