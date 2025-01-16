<?php   $tid = $this->uri->segment(3);
        $uid = $this->session->userdata('logged_in')['id'];
        $result = $this->db->get_where('tbl_training',array('id'=>$tid,'user_id'=>$uid))->result_array(); ?>
        <?php $this->load->view('template/picture_provider'); ?>


<style type="text/css">
.textonimage{position:absolute;left:0;top:0;right:0;bottom:0;margin:auto;width:max-content;height:max-content;background:#4b1ac0;color:#fff;font-weight:500;font-size:32px}
</style> 

<div class="innerContent">
    <div class="container">
        <div class="row">
           <?php $_SESSION['service_type'] = 'paid'; ?>
            
            <div class="col-sm-12">
                <!-- <h3 class="border-title text-left">Upload Training/Seminar
                    <a href="<?php echo base_url('provider/training_center_list'); ?>" class="btn btn-primary pull-right">Back</a>
                </h3> -->
                    <div class="step-wise-query provider-overview">
                
                    <?php if($this->uri->segment(3)==''){
                        $this->load->view('provider/training_menu'); 
                    }else{
                        $this->load->view('provider/training_menu_edit'); 
                    } ?>

                    <div class="tab-content steps-detail">
                       <?php echo $this->session->flashdata('response'); ?>
                         
                        <form method="post" action="<?php echo site_url('provider/training_center_free/').$tid; ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                                            
                            <div class="form-group templatechoose">
                                <h4 for="exampleInputEmail1">Click Template to Choose</h4>
                                <span style="color: red;"><?php echo form_error('select'); ?></span>
                                 
                                <section class="free-training-banner">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="free-training-img">
                                                <input type="radio" id="control_01" name="select" value="1" <?php if($result[0]['templates']==1){ echo "checked"; } ?>>
                                                <label for="control_01">
                                                    <img src="<?php echo ASSETS_URL.'images/free-tag.jpg';?>" alt="" >
                                                </label>
                                                <a href="javascript:void(0);" class="btn btn-success" onclick="showdummy('free');">View Live Demo</a>
                                            </div>
                                        </div>
                                <!--     </div>

                                    <div class="row"> -->
                                        <!-- <div class="col-md-4">
                                            <div class="free-training-img">
                                                <input type="radio" id="control_02" name="select" value="1">
                                                <label for="control_02">
                                                    <img src="<?php echo ASSETS_URL.'images/uploads/template3.jpg';?>" alt="" >
                                                </label>
                                                <a href="javascript:void(0)" class="btn btn-success" onclick="upgradetopro();">
                                                <span class="textonimage">UPGRADE TO <br>PRO TEMPLATE</span>
                                                Go To Pro</a>
                                            </div>
                                        </div>
                                    </div> -->
                                   
                                <!--  <div>
                                        <input type="radio" id="control_01" name="select" value="1" <?php if($result[0]['templates']==1){ echo "checked"; } ?>>
                                        <label for="control_01">
                                            <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template1.jpg" alt="">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div> 
                                    <div>
                                        <input type="radio" id="control_02" name="select" value="2" <?php if($result[0]['templates']==2){ echo "checked"; } ?>>
                                        <label for="control_02">
                                            <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template2.jpg" alt="">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div>
                                    <div>
                                        <input type="radio" id="control_03" name="select" value="3" <?php if($result[0]['templates']==3){ echo "checked"; } ?>>
                                        <label for="control_03">
                                            <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/template3.jpg" alt="">
                                        </label>
                                        <a href="#" class="btn btn-success">View Live Demo</a>
                                    </div> -->
                                </section>
                                
                            </div>
                            <button type="submit" class="btn btn-primary">Save & Next</button>
                        </form>

                    </div>    
                </div>



            </div>
        </div>
    </div>
</div>
</div>
 

 <div class="modal fade" id="dummyTraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview of <span id="tversion"></span> Training page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" id="DummyTrainingImg">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function showdummy(version){
        $('#DummyTrainingImg').attr('src',"<?php echo ASSETS_URL.'images/training_dummy/dummy_free.png'; ?>");
        $('#tversion').html('Free');
        $('#dummyTraining').modal('show');  

    }
</script>