   <div class="banner">
      <div class="container">
        <div class="banner-left"> 
        <h1>Terms</h1>
          <ul class="breadcrumb">
            <li>International</li>
          </ul>
        </div>
      </div>
    </div>
<div class="innerContent faq-panel">
    <div class="container">
        <div class="row ">
        <div class="col-sm-8">
          <!-- <h3 class="border-title text-left">Terms & Conditions</h3> -->
          <?php echo $this->session->flashdata('response'); ?>
          <ul class="nav nav-tabs tutorial-tab">
            <li class="active"><a data-toggle="tab" href="#professional">PROFESIONAL</a></li>
            <li><a data-toggle="tab" href="#authorCeonpoint">AUTHOR-CEONPOINT</a></li>
            <li><a data-toggle="tab" href="#authorBussiness">AUTHOR-BUSINESS</a></li>
            <li><a data-toggle="tab" href="#authorInstitution">AUTHOR-INSTITUTION</a></li>
            <li><a data-toggle="tab" href="#cepBussiness">CEP BUSINESS</a></li>
            <li><a data-toggle="tab" href="#cepInstitution">CEP INSTITUTION</a></li>
            <li><a data-toggle="tab" href="#institution">INSTITUTION</a></li>
            <li><a data-toggle="tab" href="#advertiser">ADVERTISER</a></li>
          </ul>

          <div class="tab-content">
            
            <div id="professional" class="tab-pane fade in active">
              <h4 class="tab-title">PROFESIONAL</h4>
              <div class="row">
                <div class="col-md-12">
                  <?php if(count($professionals)>0){ ?>
                        <p><?php echo $professionals['discription']; ?></p>    
                  <?php } else { ?>
                    <div class="pagi-above">Record not found.</div>
                  <?php } ?>
                </div>
              </div>
          </div>      

          <div id="authorCeonpoint" class="tab-pane fade">
            <h4 class="tab-title">AUTHOR-CEONPOINT</h4>
            <div class="row">
              <div class="col-md-12">
                <?php if(count($authorCeonpoint)>0){ ?>
                <p><?php echo $authorCeonpoint['discription']; ?></p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div> 
        </div>

        <div id="authorBussiness" class="tab-pane fade">
          <h4 class="tab-title">AUTHOR-BUSINESS</h4>
            <div class="row">
              <div class="col-md-12">
                <?php if(count($authorBusiness)>0){ ?>
                 <p><?php echo $authorBusiness['discription']; ?></p>   
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
        </div>

        <div id="authorInstitution" class="tab-pane fade">
        <h4 class="tab-title">AUTHOR-INSTITUTION</h4>
          <div class="row">
            <div class="col-md-12">
                <?php if(count($authorInstitution)>0){ ?>
                  <p><?php echo $authorInstitution['discription']; ?></p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div> 
        </div>


        <div id="cepBussiness" class="tab-pane fade">
          <h4 class="tab-title">CEP BUSINESS </h4>
            <div class="row">
              <div class="col-md-12">
                <?php if(count($cepBusiness)>0){ ?>
                  <p><?php echo $cepBusiness['discription']; ?></p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
        </div>

        <div id="cepInstitution" class="tab-pane fade">
            <h4 class="tab-title">CEP INSTITUTION </h4>
            <div class="row">
            <div class="col-md-12">
              <?php if(count($cepInstitutions)>0){ ?>
                <p><?php echo $cepInstitutions['discription']; ?></p>  
              <?php } else { ?>
              <div class="pagi-above">Record not found.</div>
              <?php } ?>
            </div>
          </div>
        </div>

        <div id="institution" class="tab-pane fade">
          <h4 class="tab-title">INSTITUTION </h4>
          <div class="row">
            <div class="col-md-12">
                <?php if(count($institutions)>0){ ?>
                  <p><?php echo $institutions['discription']; ?></p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
        </div>

        <div id="advertiser" class="tab-pane fade">
          <h4 class="tab-title">ADVERTISER </h4>
            <div class="row">
              <div class="col-md-12">
                <?php if(count($advertiser)>0){ ?>
                  <p><?php echo $advertiser['discription']; ?></p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
        </div>

          </div>
      </div> 
          
      <div class="col-sm-4">
            <div class="blog-right-box">
                <div class="serch-blogcategories">
                    <input class="form-control border-secondary border-right-0 rounded-0" type="search"  placeholder="search" id="example-search-input4">
                    <div class="col-auto secrch-icon">
                        <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="button"><i class="fa fa-search"></i></button>
                    </div>
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

   <style type="text/css">
  .nav-tabs>li>a{
      font-size: 11px;
      font-weight: 600;
  }
  .froala-box {
    position: relative;
    height: 350px;
    overflow: auto;
  }
  .nav-tabs.tutorial-tab>li.active>a {
  background: #00f;
  color: #fff;
  }
 
</style> 
