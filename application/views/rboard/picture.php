<!-- User information start -->
    <?php 
    $uid = $this->session->userdata('logged_in')['id']; 

    // this function is also used in share controller/notification if we done any changes here than we need to do changes there also.
    $userdata = $this->rboard->get_rboard_info($uid);
    $noticationCount = $this->rboard->get_rboard_notification($uid);
    $ncount = count($noticationCount);
    if($userdata->image==""){
        $src = ASSETS_URL.'images/staff-3.png';
    }else{
        $src = ASSETS_URL.'images/uploads/'.$userdata->image; 
    } ?>
<!-- User information end -->

<div class="professionals-banner">
    <div class="container">
        <div class="row">
                <div class="col-sm-3">
                    <div class="d-flex">
                        <div class="author-thumb usertype">
                            <img src="<?php echo $src; ?>" alt="Reg.Board-image">
                        </div>
                        <div class="profile-content">
                            <p><?php echo $userdata->name;?>
                           <br/>
                                Date Registered : <?php echo date('M d, Y',strtotime($userdata->added_on)); ?>
                        </div>
                    </div>
                     
                    <div class="mb-md-4 mb-3">
                        <a href="<?php echo base_url(); ?>" class="btn btn-info">View Website</a>
                    </div>
                    <a href="<?php echo site_url('share/notification');?>">
                            <span class="notification-icon" style="position: relative;top:0px;">
                            <i class="fa fa-bell" title="Notification" aria-hidden="true" style="display: inline-block; font-size: 25px; color: #FFD700; vertical-align: middle; margin-right: 10px;"></i>
                            <span class="notification-no" style="    position: absolute;right: 0;background-color: #e83330; width: 15px;height: 15px;line-height: 15px;text-align: center; border-radius: 50%;font-size: 11px;box-shadow: -1px 3px 7px rgba(0, 0, 0, 0.3);top: 2px;color: #fff;"><?php if($ncount){ echo $ncount; }else{ echo 0; } ?></span>
                            </span></a>
                </div>

            <!-- Tracker data start -->
            <?php   $total_onlineapplication = 1500;
                    $used_onlineapplication = 500;
                    $remaining_onlineapplication = $total_onlineapplication - $used_onlineapplication;
                    $persant = ($used_onlineapplication/$total_onlineapplication)*100;
            ?>
            <!-- Tracker data end -->
            
               <!-- <div class="col-sm-9">
                    <div class="row banner-count-desc d-flex">
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="width: 170px;background:##FF0000"><?php echo $total_onlineapplication; ?></div>
                            <h2>Subscription Package</h2>
                        </div>
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="width: 170px;background:##FF0000"><?php echo $used_onlineapplication; ?></div>
                            <h2>Used Online Application</h2>
                        </div>
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="width: 170px;background:##FF0000"><?php echo $remaining_onlineapplication; ?></div>
                            <h2>Remaining Online Application</h2>
                        </div>
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="width: 170px; background:#43c300;">
                            <?php if($remaining_onlineapplication > 1){ 
                                    echo 'On Completion'; 
                                } else { 
                                    echo 'Completed'; } ?>
                            </div>
                            <h2>Status</h2>
                        </div>
                    </div> -->
                
			
                <!-- <div class="col-sm-9" style=" background: #fff; border: 1px #2d67eb solid; border-radius: 5px; height: 20px;
                    margin-top:51px; padding:0px;">
                    <div class="traker" style="text-align:right; background:green; margin:0px;padding-right:7px;width:<?=round($persant)?>%;height:100%;" ><?=round($persant)?> %</div>
                </div> -->
                </div>
          
		</div>
    </div>


</div>     
		
