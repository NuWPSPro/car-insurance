<!-- Tracker data start -->
<?php 

    if(empty($current_subscription) && $current_subscription == ''){
        $no_of_certificates = 0; 
        $used_onlineapplication  = 0;
        $remaining_onlineapplication = 0; 
        $total_onlineapplication = 0; 
    }elseif($current_subscription->no_of_certificates == 0 && $current_subscription->dcp_id == 6){
        $no_of_certificates = 'Unlimited'; 
        $used_onlineapplication  = 0;
        $remaining_onlineapplication = 'Unlimited'; 
        $total_onlineapplication = $no_of_certificates; 
    }else{
        $no_of_certificates = $current_subscription->no_of_certificates;    
        $total_onlineapplication = $no_of_certificates;
        $used_onlineapplication  = 0;
        $remaining_onlineapplication = $total_onlineapplication - $used_onlineapplication;
    }
?>
<?php $this->load->view('template/picture_provider'); ?>
 <div class="innerContent">
	<div class="container">
      <div class="row">
       <?php  $this->load->view('provider/sidebar');  ?>
            <div class="col-sm-9">
                <h3 class="header-title"><?=$title;?></h3>

                    <div class="card">
                        <div class="card-body"> 
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row banner-count-desc d-flex">
                                        <div class="col-sm-3 text-center border">
                                            <div class="icon-container text-white"><?php echo $total_onlineapplication; ?></div>
                                            <h6>Subscription Package</h6>
                                        </div>
                                        <div class="col-sm-3 text-center border">
                                            <div class="icon-container text-white"><?php echo $used_onlineapplication; ?></div>
                                            <h6>Used Online Application</h6>
                                        </div>
                                        <div class="col-sm-3 text-center border">
                                            <div class="icon-container text-white"><?php echo $remaining_onlineapplication; ?></div>
                                            <h6>Remaining Online Application</h6>
                                        </div>
                                        <div class="col-sm-3 text-center border">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<hr>
                    <div class="card mt-5">
                        <h3 class="header-title"> Subscrition Log </h3>      
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Subscription Package</th>
                                    <th scope="col">No of Application</th>
                                    <th scope="col">Purchase Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($subscription) && $subscription !=''){
                                    $count = 1;
                                    $sumAllapplication = 0;
                                    foreach($subscription as $value){ 
                                        $sumAllapplication += $value->no_of_certificates; ?>
                                <tr>
                                    <th scope="row"><?=$count;?></th>
                                    <td><?=$value->subcription_name;?></td>
                                    <td><?=$value->no_of_certificates;?></td>
                                    <td><?=date('M d, Y',strtotime($value->added_at));?></td>
                                </tr>
                                <?php  $count++; } } ?>
                                </tbody>
                                </tfoot>
                                        <tr>
                                            <td></td>
                                            <th>Total</th>
                                            <th> <?=$sumAllapplication; ?> </th>
                                            <td></td>
                                        </tr>
                                </tfoot>
                            
                            </table>
                        </div>         
                    </div>
                </div>

                
            </div>
       </div>
	</div>
</div>
