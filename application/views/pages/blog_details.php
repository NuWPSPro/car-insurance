<style type="text/css">
  .blog-comment{
    position: relative;
  }
  .blog-date-time{
    position: absolute;
    right: 5px; 
    top: 2px;
    color: #dedede;
  }
  .user-details img{
    width: 40px;
    height: 40px;
  }
  .blog-details-image img {
    object-fit: contain;
  }
</style>
<div class="banner">
    <div class="container">
        <div class="banner-left"> 
      <?php $country = $this->user->get_record_by_field_name_all_record('countries','countries_id',$param); ?>
          <h1>News/Blog</h1>
          <ul class="breadcrumb">
  					<li>
              <?php if(!empty($country)){ echo $country[0]['countries_name']; }else{ ?>International<?php } ?>
            </li>
          </ul>
        </div>
        
    </div>
</div>
<?php $addedby = $this->db->get_where('tbl_user',array('id'=>$blog['user_id']))->row_array();
  if($addedby['under_insititution'] == 0){ 
      $blogins = $addedby['insititution_id']; 
      $url = base_url('web/').$addedby['insititution_id'];
    }else{ 
      $blogins = $addedby['under_provider']; 
      $url = base_url('share/viewprofile/').$addedby['id'];
    } 
      $ins_name = $this->db->get_where('tbl_user',array('id'=>$addedby['parent_insititution']))->row_array();
      $country_name = $this->db->get_where('countries',array('countries_id'=>$blog['country']))->row_array();
      $bid = $this->uri->segment(3); ?>
<div class="innerContent">
    <div class="container">
        <div class="row displayflex">
            <div class="col-md-8 col-offset-1">

                <h3 class="border-title text-left"><?=$blog['title']?>
                  <?php if($blog['under_ins'] == 1){ ?>
                    <div class="pull-right"><a href="<?php echo base_url('web/').$blogins; ?>" class="btn btn-success">BACK TO INSTITUTION <br/> CE WEBPAGE</a></div>
                  <?php } ?>
                </h3>

                <p>
                  <span class="text-left">
                    Published:  <b><?php echo date('jS F Y',strtotime($blog['date']))?></b><br>
                    Country:    <b><?php echo $country_name['countries_name']; ?></b>
                  </span>
                  <span class="pull-right">
                    By: <b><a style="color: blue;" href="<?php echo $url; ?>"><?=$addedby['name'];?></a><br>
                           <?=$ins_name['name'];?></b>
                  </span>
                </p>
                
                <div class="blog-details-image">
				          <img src="<?=base_url('assets/upload/blog/'.$blog['image'])?>" alt="">
				        </div>
                <p><?=$blog['des']?></p>

                <?php if($comments){ ?>
                <h4><p>Comments</p></h4>
                <?php foreach($comments as $key => $value){
                  $user = $this->db->get_where('tbl_user',array('id' =>$value['comment_by']))->row_array();
                  $remaining_time =$value['added_at'];
                  if(empty($user['image'])){
                    $src = ASSETS_URL.'images/staff-3.png';
                  }else{
                    $src = ASSETS_URL.'images/uploads/'.$user['image'];
                  } ?>

                  <!-- // $remaining_time = date('Y-m-d H:i:s') - $value['added_at']; -->
                   <p class="blog-comment">
                    <span class="user-details"><img src="<?php echo $src; ?>" title="<?php echo $user['name'];?>"></span>
                    <?php echo $value['comment']; ?>
                    <span class="blog-date-time"><?php echo date('M-d, H:i',strtotime($remaining_time)); ?>
                    </span>
                  </p>
                <?php } ?>
                <?php } ?>
                      
            <?php if($this->session->userdata('logged_in')){ ?>
            <form action="<?php echo site_url('pages/blog_comments/').$bid;?>" method="post" name="blogComment"> 
              <div class="form-group">
                <!-- <textarea class="form-control" name="comment" id="comment" placeholder="Please write your comment..." required></textarea> -->
                <input type="text" placeholder="Please write your comment..."  name="comment" class="form-control" required>
              </div>
              <div class="form-group text-right">
                <input type="submit" value="Comment" class="btn btn-primary" >
              </div>
            </form>

           <!--  <div class="fb-comments"  data-href="<?php echo site_url('pages/blog_comments/').$bid;?>" data-width="740" data-numposts="5"></div> -->

            <?php } ?>

            <div style="position: absolute;right: 10px;top: -34px;" class="mob-social">
                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                    <a class="a2a_button_facebook"></a>
                    <a class="a2a_button_twitter"></a>
                    <a class="a2a_button_google_plus"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
            </div>
  <hr>
            <?php if(count($blogs) > 0 ){ ?>
            <div class="training-semi-slider-6 pagi-above">
                <?php foreach ($blogs as $key => $value) { ?>
                    <div class="item">
                        <div class="training-semi">
                            <div class="new-training-box">
                                <a href="<?php echo base_url('pages/blog_details/').$value['id'];?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image author_images">
                                        <img src="<?=base_url('assets/upload/blog/'.$value['image'])?>" alt="">
                                    </div>
                                    <div class="training-box-caption">
                                        <h5 class="training-box_title"><?php echo $value['title']; ?></h5>
                                        <div class="training-box_text">Published: <b><?php echo date('jS F Y',strtotime($value['date']))?></b></div>
                                        <!-- <div class="training-box_text"> By: <b><a style="color: blue;" href="<?php echo $url; ?>"><?=$addedby['name'];?></a></b></div> -->
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
              <?php } ?>  
              </div>
              <?php } ?>  
        </div>

<div class="col-md-4">
  <div class="blog-right-box">
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
        <div class="login-ads dt-sc-ico-content">
          <div class="login-slider">
				  <?php 
				
						 $topbanner = $this->advertiseads->getAdvertiserBanner('Register Side');					
						  if(count($topbanner))
						  {
							  foreach($topbanner as $banner)
							  {
								  $this->advertiseads->updateCount($banner['id']); 
								  ?>
								  <div class="item">
                    <img src="<?php echo ASSETS_URL; ?>upload/<?php echo $banner['banner_image'];?>" alt="">
                  </div>
								  <?php
								  break;
							  }
						  }else{ ?>
              <img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg';?>">
          
							<?php } ?>
                    
                    
                </div>
            </div></br>
			      <div class="login-ads dt-sc-ico-content">
              <div class="login-slider">
				
      				   <?php 
      						  $topbanner2 = $this->advertiseads->getAdvertiserBanner('Register Side');					
      						  if(count($topbanner2))
      						  {
      							  foreach($topbanner2 as $banner2)
      							  {
      								  $this->advertiseads->updateCount($banner2['id']);  ?>
      								  <div class="item">
                          <img src="<?php echo ASSETS_URL.'upload/'.$banner2['banner_image'];?>" alt="">
                        </div>
      								  <?php
      								  break;
      							  }
      						  }else{ ?>
                        <img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg';?>">
                  <?php	} ?>
                    
              </div>
            </div>
       
	   </div>
	   </div>
	   </div>
    </div>
</div>
             
             
<!-- <div id="fb-root"></div> -->
<!--   <script>(function(d, s, id) {
  var js, fjs =  d.getElementsByTagName(s)[0];
  if  (d.getElementById(id)) return;
  js =  d.createElement(s); js.id = id;
  js.src =  "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script> -->

<!--                
                   
<script type="text/javascript">
function paynow(id,amount) {

    $('#item_name').val(id);
    $('#amount').val(amount);
    document.getElementById("frmPayPal1").submit();
}
</script> -->