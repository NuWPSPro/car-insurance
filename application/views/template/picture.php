<div class="professionals-banner first">
    <div class="container">
        <div class="row">
        <?php // echo '<pre>'; print_r($details); ?>
            <div class="col-md-3 col-sm-4">
                <div class="box text-center bg-primary rounded p-2">
                    <div class="author-thumb usertype1">
                        <img src="<?=base_url('assets/images/uploads/'.$details['image']);?>" alt="">
                    </div>
                    <p><?=$details['fname'];?> <?=$details['name'];?> <?=$details['lname'];?></p>
                    <!-- <p>Acc. no. : <?=$details['prc_acceditation_number'];?></p> -->
                    <p>Register Date : <?php echo $details['added_on'];?></p>
                </div>
            </div>      

            <div class="col-md-6 col-sm-4">

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
            </div>                                
                    

        </div>
    </div>
</div>
<div class="innerContent dashboard-inner professional-dashboardpanal">
    <div class="container">
        <div class="row">
            <?php  $this->load->view('broker/sidebar'); ?>