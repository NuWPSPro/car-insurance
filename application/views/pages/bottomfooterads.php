<?php /* <div class="col-md-12">
<h3 class="text-left" style="font-size: 19px;">Advertisement:</h3>
    <div class="footer-add">
        <div class="main-addspace">
            <div class="container">						
                <div class="main-addspace-box">
                <?php if(!empty($current_country)){$this->db->where('tbl_adv_package_purchased.country',
                    $this->session->userdata('current_country'));}
                $bottombanner = $this->advertiseads->getAdvertiserBanner('Bottom Body');

                if (count($bottombanner)){
                    $i = 1;
                    foreach ($bottombanner as $banner)
                    {
                        if ($i > 4){ break; }$i++;
                    $this->advertiseads->updateCount($banner['id']);
                    $size = explode('x', $banner['size']); ?>
                    <!-- <div class="col-md-3"> -->
                        <a href="#">
                        <div class="item">
                            <div class="main-addspace-iner-box">
                                <a href="<?php if ($banner['website_url']){
                                    echo $banner['website_url'];
                                    } else { echo "#"; } ?>">
                                    <img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image']; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" alt="">
                                </a>
                            </div>
                        </div>
                        </a>
                    <!-- </div> -->
            <?php   }
                }else { ?>

                    <!-- <div class="col-md-3"> -->
                        <a href="#">
                        <div class="item">
                            <div class="main-addspace-iner-box">
                                <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                            </div>
                        </div>
                        </a>
                    <!-- </div> -->

                    <!-- <div class="col-md-3"> -->
                        <a href="#">
                        <div class="item">
                            <div class="main-addspace-iner-box">
                                <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                            </div>
                        </div>
                        </a>
                    <!-- </div> -->
                    
                    <!-- <div class="col-md-3"> -->
                        <a href="#">
                        <div class="item">
                            <div class="main-addspace-iner-box">
                                <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                            </div>
                        </div>
                        </a>
                    <!-- </div> -->
                    
                    <!-- <div class="col-md-3"> -->
                        <a href="#">
                        <div class="item">
                            <div class="main-addspace-iner-box">
                                <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                            </div>
                        </div>
                    </a>
                    <!-- </div> -->
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

*/ ?>
