<?php $this->load->view('institution/picture'); ?>



	   <div class="innerContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3> 
                </div>

                <?php $this->load->view('institution/sidebar'); ?>
			

                 <form action="<?php echo BASE_URL.'institution/editwebpage';?>" method="post" enctype="multipart/form-data" name="ins-editwebpage">
                    
                 
                <div class="col-sm-9" >
                    <?php echo $this->session->flashdata('response'); ?>
                    <h3 class="border-title text-left z" tabindex="0">Edit Institution CE Webpage</h3>
					<a href="<?php echo base_url('web/').$userdata[0]['insititution_id'];?>" target="_blank" class="btn btn-info pull-right" >View Your Web Page</a>
                    <div class="form-group">
                        <label>Photo Background <sup>*</sup> (e.g 1500px X 400px)</label>
                        <input type="file" class="form-control" name="image" id="image" value="">
                        <span class="error"></span>

                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$userdata[0]['backimage'];?>" height="75" width="75">
                    </div>

                     <div class="form-group">
                        <label>Name of Institution<sup>*</sup></label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $userdata[0]['name']; ?>" required>
                        <span class="error"></span>
                    </div>


                    <div class="form-group">
                        <label>Enter Tagline<sup>*</sup></label>
                        <input type="text" class="form-control" name="tagline" id="tagline" value="<?php echo $userdata[0]['tag_line']; ?>" required>
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                    <input type="submit" name="save" id="save" value="UPDATE" class="btn btn-info">
                    </div>
                    <br>
                  <!--   <textarea class="form-control text_editor" name="course_description" id="course_description"
                        style="display: none;" placeholder="Type something"></textarea><br> -->

                    <h4>Your Reference for Editing Webpage</h4>

                    
					 <div id="slider">
        <div id="slider-container" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item"><img src="<?php echo BASE_URL.'assets/images/uploads/'.$userdata[0]['backimage']; ?>" alt="Back-Image"></div>
              
            </div>
            <ol class="carousel-indicators">
                <li data-target="#slider-container" data-slide-to="0" class="active"></li>
              
            </ol>
        </div>
        <div id="slider-search-container">
            <div class="slider-search">
                <h2><?php echo $userdata[0]['name']; ?></h2>
                <h4 style="font-style: normal;"><?php echo $userdata[0]['tag_line']; ?></h4>
                
                <a href="#" class="commonBttn bg-blue">online courses</a>
                <a href="#"  class="commonBttn bg-white">training/seminars</a>
            </div>
        </div>
    </div>
                    
            </form>
            </div>
        </div>
    </div>
    </div>

<div class="modal fade" id="rePurchaseModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">text</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <!--  <div class="modal-body text-center">
        <strong style="font-size: 15px;">Please Click on BUY button to purchase this course.</strong>
      </div>-->
      <div class="modal-footer">
      <!--  <button type="button" class="btn btn-primary">
            <a style="color: #ffff;" href="javascript:void(0)" onclick="paynow();">BUY $<?php echo $course[0]['price'];?>
            </a>
        </button>-->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).ready(function() {
		var first = '<?php if($firstlogin < 2){ ?>' +  $("#upgradeunit_new").modal('show'); +'<?php } ?>';
		var focus = '<?php if($_REQUEST['id'] == 'focus'){ ?>' + $('.z')[0].focus(); +'<?php } ?>';
	});

</script>
		 