<div class="professionals-banner first">
    <div class="container">
        <div class="row">
        <?php 
                if(isset($used_certificates) && !empty($used_certificates)){
                    // echo '<pre>'; print_r($used_certificates); die;
                    $uc = $used_certificates['number'];
                }else{
                    $uc = 0;
                }
            if(empty($current_subscription) && $current_subscription == ''){
                $no_of_certificates = 0; 
                $used_onlineapplication  = $uc;
                $remaining_onlineapplication = 0; 
                $total_onlineapplication = 0; 
            }elseif($current_subscription->no_of_certificates == 0 && $current_subscription->dcp_id == 6){
                $no_of_certificates = 'Unlimited'; 
                $used_onlineapplication  = $uc;
                $remaining_onlineapplication = 'Unlimited'; 
                $total_onlineapplication = $no_of_certificates; 
            }else{
                $no_of_certificates = $current_subscription->no_of_certificates;    
                $total_onlineapplication = $no_of_certificates;
                $used_onlineapplication  = $uc;
                $remaining_onlineapplication = $total_onlineapplication - $used_onlineapplication;
            }
        ?>
            <div class="col-md-3 col-sm-4">
                <div class="box text-center bg-primary rounded p-2">
                    <div class="author-thumb usertype1">
                        <img src="<?=base_url('assets/images/uploads/'.$details['image']);?>" alt="">
                    </div>
                    <p><?=$details['name'];?></p>
                    <p>Acc. no. : <?=$details['prc_acceditation_number'];?></p>
                    <p>Validity Date : <?=$details['validity'];?></p>
                </div>
            </div>      

            <div class="col-md-6 col-sm-4">
                <div class="row text-center text-primary">
                    <h3>Subscription Tracker</h3>
                </div>
                <div class="card">
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row banner-count-desc d-flex">
                                    <div class="col-sm-4 text-center border">
                                        <div class="icon-container text-white"><?php echo $total_onlineapplication; ?></div>
                                        <h6>Subscription Package</h6>
                                        <a href="" class="btn btn-success">Subscribe Now</a>
                                    </div>
                                    <div class="col-sm-4 text-center border">
                                        <div class="icon-container text-white"><?php echo $used_onlineapplication; ?></div>
                                        <h6>Used Insuracne Certificate</h6>
                                    </div>
                                    <div class="col-sm-4 text-center border">
                                        <div class="icon-container text-white"><?php echo $remaining_onlineapplication; ?></div>
                                        <h6>Remaining Insuracne Certificate</h6>
                                    </div>
                                    <!-- <div class="col-sm-3 text-center border">
                                        <div class="icon-container text-white" style="width: 100%;background:#43c300;">
                                        <?php if($used_onlineapplication > 0 && $remaining_onlineapplication == 0 && $total_onlineapplication == $used_onlineapplication){
                                            echo 'Completed'; 
                                        }elseif($remaining_onlineapplication != 0 && $remaining_onlineapplication > 0 && $total_onlineapplication == 0){
                                            echo 'On Completion';
                                        }else{
                                            echo 'Pending';
                                        } ?>
                                        </div>
                                        <h6>Status</h6>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                            
            </div>                          
            
            <div class="col-md-3 col-sm-4">
                <?php 
                    $date = strtotime($details['validity']);
                    $remaining = $date - time();
                    $days_remaining = floor($remaining / 86400);
                    $hours_remaining = floor(($remaining % 86400) / 3600);
                    if($days_remaining > 0){
                        if($days_remaining > 30){
                            $vali = 'Valid';
                        }else{
                            $vali = 'Expiring';
                        }   
                    }else{
                        $vali = 'Expired';
                    }    

                ?>
                <div class="box text-center bg-primary rounded p-2">
                    <div class="h3"><?=($days_remaining > 0)?$days_remaining:0;?></div>
                    <p>Days Remaining</p>
                    <p>Acc. Status : <?=$vali;?></p>
                </div>
                <a href="javascript:void(0)" onclick="send_to_author()" class="btn btn-primary" >Send code to Broker</a>
            </div>                                
                    

        </div>
    </div>
</div>
<div class="innerContent dashboard-inner professional-dashboardpanal">
    <div class="container">
        <div class="row">
            <?php  $this->load->view('car_company/sidebar'); ?>

            <div class="modal fade" id="send_code"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            <center>
                <div class="site-logo__link" style="max-width: 34%;">
                    <a href="<?php echo base_url();?>">
                        <img src="<?php echo ASSETS_URL.'images/logo.png';?>" alt="logo"></a>
                </div>
            </center>
            </div>
            <div class="modal-body">
                <p><b>NOTE:<i> This information will be used by broker as they register Under this Car Provider account.</i></b></p>
                <form action="<?php echo base_url('provider/send_to_broker'); ?>" method="post">
                    <div class="row">
                        
                    <div class="col-sm-6">
                        <label>Name of Car Company: </label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="cepname" value="<?php echo $details['name']; ?>">
                    </div>    
                    <div class="col-sm-6">
                        <label>Code of the Car Company: </label>
                    </div>    
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="cepcode" value="<?php echo $details['insititution_id']; ?>">
                    </div>
                    <label><b>You can send multiple emails by using comma(,) separator. <i>Like:- abc@gmail.com, xyz@yahoo.com</i></b></label>
                    <div class="col-sm-6">
                        <label>Enter email of brokers: </label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="cepemail" value="" required>    
                    </div>
                    </div>
                    
                    <input type="submit" class="btn btn-success mt-5" name="submit" value="Send Now!">
                </form>    
            </div>
        </div>
    </div>
</div>

<script>
     function send_to_author(){ 
        $("#welcomeprovider").modal('hide');
        $("#send_code").modal('show');
    }
</script>