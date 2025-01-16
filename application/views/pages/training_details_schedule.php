<?php $this->load->view('template/search'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <?php echo $this->session->flashdata('response');?>
            <div class="col-md-8">
                <?php $this->load->view('template/trainingmenu'); ?>
                <h3 class="border-title text-left pull-left">Schedule</h3>
                <div class="clear-line"></div>
                <?php 
                $tid = $this->uri->segment(3);
                $scheduleUniqueDate     = $this->user->getschedule($tid); 
                ?>
                <div class="">
                    <div class="panel-group" id="accordion">
                        <?php 
                        foreach ($scheduleUniqueDate as $key => $value1) {
                        $scheduleUniqueDateAlll = $this->user->getscheduleAll($tid,$value1['schedule_date']);
                        $ss=0;
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" class="d-block" data-parent="#accordion" href="#home<?php echo $key+1;?>">
                                    <?php echo date("jS F, Y", strtotime($value1['schedule_date']));?>
                                        <i class="fa fa-plus pull-right mt-1"></i>
                                        <i class="fa fa-minus pull-right mt-1"></i>
                                    </a>
                              </h4>
                            </div>
                            <div id="home<?php echo $key+1;?>" class="panel-collapse collapse in">
                                <div class="panel-body p-0">
                                    <table class="table mb-0">
                                        <?php 
                                        if($ss==0){
                                        ?>
                                        <thead>
                                            <tr class="bg-warning"> 
                                                <th>Time</th>
                                                <th>Topic</th>
                                                <th>Speaker(s)</th>
                                            </tr>
                                        </thead>
                                        <?php } ?>
                                        <tbody>
                                            
                                            <?php 
											
                                            foreach ($scheduleUniqueDateAlll as $key => $value2) {
												
												if(!empty($value2['speaker_id']) || $value2['speaker_id']!=0)
												{
											      $speaker = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value2['speaker_id']);
											      $speakername = $speaker[0]['name'];
												}
												else{
													 $speakername = $value2['speaker_name'];
												  }
                                           
                                            $ss++;
                                            ?>
                                            <tr> 
                                                <td>
                                                    <?php echo $value2['schedule_start_time'];?> To
                                                    <?php echo $value2['schedule_end_time'];?>
                                                </td>
                                                <td>
                                                    <?php echo $value2['topic'];?>
                                                </td>
                                                <td>
                                                    <?php echo $speakername;?>
                                                </td>
                                            </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php $this->load->view('pages/sidebar'); ?>
        </div>
    </div>
</div>