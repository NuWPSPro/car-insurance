<?php $this->load->view('template/search'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <?php echo $this->session->flashdata('response');?>
            <div class="col-md-8">
                <?php $this->load->view('template/trainingmenu'); ?>
                <h3 class="border-title text-left pull-left">Speaker</h3>
                <div class="clear-line"></div>
                <div style="height: 650px; overflow: scroll;">
                <?php 
                $tid = $this->uri->segment(3);
                $speaker = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$tid); 
				
                foreach ($speaker as $key => $value) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="<?php echo BASE_URL.'assets/images/uploads/'.$value['speaker_image'];?>"/>
                            </div>
                            <div class="col-md-9">
                                <h3 class="mt-0"><?php echo $value['speaker_name'];?></h3>
								 <p>Position: <?php echo $value['position'];?></p>
								  <p>Institution: <?php echo $value['insititution'];?></p>
                                <p><?php echo $value['speaker_description'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  }  ?>
                </div>
                </div>
                <?php $this->load->view('pages/sidebar'); ?>
            </div>
        </div>
    </div>