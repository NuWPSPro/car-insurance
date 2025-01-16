<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
        <?php $training_types = ($training_type[0]['training_type']==1)?'pro':'free';  ?>
            <div class="col-sm-12">
                <!-- new html code -->
                   <div class="step-wise-query provider-overview">
                      <?php 
                       if($training_id != $this->uri->segment(3) || $this->uri->segment(3)== "" )
                            {  
                                $this->load->view('provider/training_menu'); 
                            }else{
                                $this->load->view('provider/training_menu_edit');
                            } ?>     
                        <div class="tab-content steps-detail">
                            <?php if($this->uri->segment(3)!=''){ echo '<h3>Edit Certificate</h3>'; } ?> 
                            <?php if($training_id != $this->uri->segment(3) || $this->uri->segment(3) == '')
                            { 
                                $this->load->view('provider/training_certificate'); 
                            }else{
                                $this->load->view('provider/training_certificate_edit',$training_id);
                            } ?>
                      
                        </div>    
                </div>



            </div>
        </div>
    </div>
</div>
</div>
 

<style type="text/css">
    img {
    max-width: 60%;
}
</style> 