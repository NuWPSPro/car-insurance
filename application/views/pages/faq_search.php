<style type="text/css">
  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
      background-color: #2f5597;
      color: #fff;
  }
  .nav-tabs>li a{
    background-color: #ddd;
  }
</style>
    <div class="banner">
        <div class="container">
            <div class="text-center">           
                <h1>Can we help you?</h1>
                <?php echo form_open('pages/faq_search'); ?>
                <input style="border: 1px solid #bdbdbd; border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;color: #0000;" type="text" name="search" value="<?php echo $_REQUEST['search'];?>" placeholder="Enter your query here?" required>
                <button type="submit" name="submit" class="btn btn-success" id="basic-text1"><i class="fa fa-search text-grey"
                        aria-hidden="true"></i></button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

<div class="innerContent">
    <div class="container">
        <div class="row ">
            <div class="col-sm-8">
                <?php echo $this->session->flashdata('response');?>
            <!-- <div class="tab-content"> -->
              <!-- <div id="professional" class="tab-pane fade in active"> -->
                <h3 class="tab-title">Frequently Asked Questions?</h3>
                <h4 class="tab-title">Search Result</h4>
                <div class="row">
                <div class="col-md-12">
                  <?php if(count($faq_list)>0){ 
                      foreach($faq_list as $key => $value){ ?>
                  <div class="panel-group" id="accordion<?=$key?>">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion<?=$key?>" href="#collapse<?=$key?>" class="" aria-expanded="true">  
                          Q<?=$key+1?>. <?=$value['question'];?></a></h4>
                      </div>
                         
                      <div id="collapse<?=$key?>" class="panel-collapse collapse" aria-expanded="true" style="">
                          <div class="panel-body"> 
                            <div class="lesson-details">
                            <?=$value['answer']; ?>
                            </div> 
                          </div>
                      </div>
                    </div>
                  </div>

                  <?php } 
                  } else { ?>
                  <div class="pagi-above">Record not found.</div>
                  <?php } ?>
                </div>
              </div>

              <!-- </div> -->

            <!-- </div> -->
            </div>

            <div class="col-md-4">
                <div class="blog-right-box">
                    <div class="col">
                        <input class="form-control border-secondary border-right-0 rounded-0" type="search"  placeholder="search" id="example-search-input4">
                    </div>
                    <div class="col-auto secrch-icon">
                        <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="button"><i class="fa fa-search"></i></button>
                    </div>

                    <div class="blog-categories">  
                        <a class="btn btn-primary" href="<?php echo base_url('users/signup/professional'); ?>">
                        REGISTER AS PROFESIONAL</a><br>
                        <a class="btn btn-success" href="<?php echo base_url('users/signup/provider'); ?>">
                        REGISTER AS CE PROVIDER</a><br>
                        <a class="btn btn-warning" href="<?php echo base_url('users/signup/institution'); ?>">
                        REGISTER AS INSTITUTION</a>
                        <a class="btn btn-info" href="<?php echo base_url('users/signup/authors'); ?>">
                        REGISTER AS AUTHOR</a>
                    </div>

                    <h3 class="border-title text-left">Advertise</h3>
                    <div class="login-ads dt-sc-ico-content">
                        <div class="login-slider">
                        <?php $topbanner = $this->advertiseads->getAdvertiserBanner('Register Side');                   
                            if(count($topbanner)){  
                                foreach($topbanner as $banner){
                                    $this->advertiseads->updateCount($banner['id']); ?>
                                    <div class="item"><img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image']; ?>" alt="">
                                    </div>
                          <?php break; }
                            }else{ ?>
                                <div class="item">
                                    <img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg';?>">
                                </div>
                        <?php } ?>
                        </div>
                    </div></br>
                          
                    <div class="login-ads dt-sc-ico-content">
                        <div class="login-slider">
                        <?php $topbanner2 = $this->advertiseads->getAdvertiserBanner('Register Side');                    
                            if(count($topbanner2)){
                                foreach($topbanner2 as $banner2){
                                    $this->advertiseads->updateCount($banner2['id']); ?>
                                    <div class="item">
                                        <img src="<?php echo ASSETS_URL.'upload/'.$banner2['banner_image']; ?>" alt="">
                                    </div>
                        <?php  break; }
                            }else{ ?>
                                <img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg';?>">
                    <?php   } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

