<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-tutorialspanal">
	<div class="container">

    <div class="row">
      <?php  $this->load->view('admin/sidebar');  ?>  
      <div class="col-sm-9">
          <h3 class="border-title text-left">TUTORIALS VIDEOS</h3>
          <?php echo $this->session->flashdata('response');?>
          <ul class="nav nav-tabs tutorial-tab">
            <li class="active"><a data-toggle="tab" href="#all">ALL</a></li>
            <li><a data-toggle="tab" href="#professional">PROFESIONAL</a></li>
            <li><a data-toggle="tab" href="#authorCeonpoint">AUTHOR-CEONPOINT</a></li>
            <li><a data-toggle="tab" href="#authorBusiness">AUTHOR-BUSINESS</a></li>
            <li><a data-toggle="tab" href="#authorInstitution">AUTHOR-INSTITUTION</a></li>
            <li><a data-toggle="tab" href="#cepBusiness">CEP BUSINESS</a></li>
            <li><a data-toggle="tab" href="#cepInstitution">CEP INSTITUTION</a></li>
            <li><a data-toggle="tab" href="#institution">INSTITUTION</a></li>
            <li><a data-toggle="tab" href="#advertiser">ADVERTISER</a></li>
            <li><a data-toggle="tab" href="#regulatoryBoard">RB</a></li>
          </ul>

          <div class="tab-content">
            <div id="all" class="tab-pane fade in active">
              <h4 class="tab-title">ALL </h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($tutorials)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($tutorials as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                    <div class="item">
                      <div class="training-semi">
                        <div class="new-training-box">

                          <?php echo $value['type'];?>
                          <div class="training-box-image">
                            <video width="320" height="240" controls>
                              <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                              <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                              Your browser does not support the video tag.
                            </video>
                          </div>
                          <?php echo $value['title'];?>
                        </div>
                      </div>
                    </div>
                  <?php } ?> 
                  <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            </div>

            <div id="professional" class="tab-pane fade">
              <h4 class="tab-title">PROFESIONAL <a href="javascript:void(0)" onclick="popAddTutorial('professional');" class="btn tutorialbtn">UPLOAD FILE</a></h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($professionals)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($professionals as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                    <div class="item">
                      <div class="training-semi">
                        <div class="new-training-box">

                          <?php echo $value['type'];?>
                          <div class="training-box-image">
                            <video width="320" height="240" controls>
                              <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                              <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                              Your browser does not support the video tag.
                            </video>
                          </div>
                          <?php echo $value['title'];?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            </div>

            <div id="authorCeonpoint" class="tab-pane fade">
              <h4 class="tab-title">AUTHOR-CEONPOINT<a href="javascript:void(0)" onclick="popAddTutorial('authorCeonpoint');" class="btn tutorialbtn">UPLOAD FILE</a></h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($authorCeonpoints)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($authorCeonpoints as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                    
                        <div class="item">
                            <div class="training-semi">
                              <div class="new-training-box">

                                <?php echo $value['type'];?>
                                <div class="training-box-image">
                                  <video width="320" height="240" controls>
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                  </video>
                                </div>
                                <?php echo $value['title'];?>
                              </div>
                            </div>
                        </div>
                        
                  <?php } ?> 
                  <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div> 
            </div>

            <div id="authorBusiness" class="tab-pane fade">
              <h4 class="tab-title">AUTHOR-BUSINESS<a href="javascript:void(0)" onclick="popAddTutorial('authorBusiness');" class="btn tutorialbtn">UPLOAD FILE</a></h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($authorBusinesss)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($authorBusinesss as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                    
                        <div class="item">
                            <div class="training-semi">
                              <div class="new-training-box">

                                <?php echo $value['type'];?>
                                <div class="training-box-image">
                                  <video width="320" height="240" controls>
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                  </video>
                                </div>
                                <?php echo $value['title'];?>
                              </div>
                            </div>
                        </div>
                        
                  <?php } ?> 
                <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div> 
            </div>

            <div id="authorInstitution" class="tab-pane fade">
              <h4 class="tab-title">AUTHOR-INSTITUTION<a href="javascript:void(0)" onclick="popAddTutorial('authorInstitutions');" class="btn tutorialbtn">UPLOAD FILE</a></h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($authorInstitutionss)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($authorInstitutionss as $key => $value) { ?>
                    <?php if(!empty($value['uploadvideo'])){ ?> 
                    
                        <div class="item">
                            <div class="training-semi">
                              <div class="new-training-box">

                                <?php echo $value['type'];?>
                                <div class="training-box-image">
                                  <video width="320" height="240" controls>
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                  </video>
                                </div>
                                <?php echo $value['title'];?>
                              </div>
                            </div>
                        </div>
                        
                  <?php } ?>
                <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div> 
            </div>


            <div id="cepBusiness" class="tab-pane fade">
              <h4 class="tab-title">CEP BUSINESS <a href="javascript:void(0)" onclick="popAddTutorial('cepBusiness');" class="btn tutorialbtn">UPLOAD FILE</a></h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($cepbussinesss)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($cepbussinesss as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                   
                        <div class="item">
                            <div class="training-semi">
                              <div class="new-training-box">

                                <?php echo $value['type'];?>
                                <div class="training-box-image">
                                  <video width="320" height="240" controls>
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                  </video>
                                </div>
                                <?php echo $value['title'];?>
                              </div>
                            </div>
                        </div>
                        
                  <?php } ?>
                <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            </div>

            <div id="cepInstitution" class="tab-pane fade">
              <h4 class="tab-title">CEP INSTITUTION <a href="javascript:void(0)" onclick="popAddTutorial('cepInstitution');" class="btn tutorialbtn">UPLOAD FILE</a></h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($cepinstitutions)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($cepinstitutions as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                    
                        <div class="item">
                            <div class="training-semi">
                              <div class="new-training-box">

                                <?php echo $value['type'];?>
                                <div class="training-box-image">
                                  <video width="320" height="240" controls>
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                  </video>
                                </div>
                                <?php echo $value['title'];?>
                              </div>
                            </div>
                        </div>
                        
                  <?php } ?> 
                  <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            </div>

            <div id="institution" class="tab-pane fade">
              <h4 class="tab-title">INSTITUTION <a href="javascript:void(0)" onclick="popAddTutorial('institution');" class="btn tutorialbtn">UPLOAD FILE</a></h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($institutions)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($institutions as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                    
                        <div class="item">
                            <div class="training-semi">
                              <div class="new-training-box">

                                <?php echo $value['type'];?>
                                <div class="training-box-image">
                                  <video width="320" height="240" controls>
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                  </video>
                                </div>
                                <?php echo $value['title'];?>
                              </div>
                            </div>
                        </div>
                        
                  <?php } ?> 
                  <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            </div>

            <div id="advertiser" class="tab-pane fade">
              <h4 class="tab-title">ADVERTISER <a href="javascript:void(0)" onclick="popAddTutorial('advertiser');" class="btn tutorialbtn">UPLOAD FILE</a></h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($advertiser)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($advertiser as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                    
                        <div class="item">
                            <div class="training-semi">
                              <div class="new-training-box">

                                <?php echo $value['type'];?>
                                <div class="training-box-image">
                                  <video width="320" height="240" controls>
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                  </video>
                                </div>
                                <?php echo $value['title'];?>
                              </div>
                            </div>
                        </div>
                        
                  <?php } ?> 
                  <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            </div>

            <div id="regulatoryBoard" class="tab-pane fade">
              <h4 class="tab-title">Regulatory Board <a href="javascript:void(0)" onclick="popAddTutorial('regulatoryBoard');" class="btn tutorialbtn">UPLOAD FILE</a></h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($reg)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($reg as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                    
                        <div class="item">
                            <div class="training-semi">
                              <div class="new-training-box">

                                <?php echo $value['type'];?>
                                <div class="training-box-image">
                                  <video width="320" height="240" controls>
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo']; ?>" type="video/mp4">
                                    <source src="<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                  </video>
                                </div>
                                <?php echo $value['title'];?>
                              </div>
                            </div>
                        </div>
                        
                  <?php } ?> 
                  <?php } ?> 
                  </div>
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            </div>

          </div>
          <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl.no.</th>
                                <th>Subject</th> 
                                <th>Title</th> 
                                <th>Discription</th> 
                                <th>Video</th> 
                                <th>Url</th> 
                                <th>Type</th> 
                                <th>Status</th> 
                                <th>Show on Support page</th> 
                                <th>Added on</th> 
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1;
             foreach ($tutorials as $key => $value) {  
                    if($value['status']==1){
                      $stts = "Active";
                      $col  = "green";
                    }else{
                      $stts = "Inactive";
                      $col  = "red";
                    } 
                    if($value['show_on_faq']==1){
                      $show   = "Yes";
                      $color  = "green";
                    }else{
                      $show = "No";
                      $color  = "red";
                    } 

                    if(strpos($value['url'], 'youtube') > 0){
                      $explodeurl = explode('=',$value['url']);
                      $url = $explodeurl[1];
                      $urlt = '<i class="btn btn-danger fa fa-play" title="Play"></i>';
                    }else{
                      $url = 'Not a Youtube Url';
                      $urlt = 'Not a Youtube Url';
                    }
                    if(!empty($value['uploadvideo'])){
                      $video = ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];
                      $vid = '<i class="btn btn-info fa fa-play" title="Play"></i>'; 
                    }else{
                      $video = '--';
                      $vid = '--';
                    }

            ?>
                            <tr>
                                <td><?php echo $count;?></td>
                                <td><?php if($value['subject']!=''){ echo $value['subject']; }else{ echo'--'; } ?></td>
                                <td><?php echo $value['title'];?></td>
                                <td><?php echo substr($value['discription'],0,200);?>...</td> 
                                <td><a href="javascript:void(0)" onclick="play('<?php echo $video; ?>')"><?php echo $vid; ?></a></td> 
                                <td><a href="javascript:void(0)" onclick="playvideo('<?php echo $url;?>')"><?php echo $urlt;?></a></td> 
                                <td><?php echo $value['type'];?></td> 
                                <td style="color: <?php echo $col;?>"><?php echo $stts;?></td>  
                                <td style="color: <?php echo $color;?>"><?php echo $show;?></td>   
                                <td><?php echo $value['added_on'];?></td> 
                                <td colspan="3">
                                  <!--   <a class="btn btn-primary viewt" href="javascript:void(0)" onclick="play('<?php echo ASSETS_URL.'upload/tutorial/'.$value['uploadvideo'];?>')">
                                    <i class="fa fa-play"></i></a> -->
                                  <a href="javascript:void(0)" class="btn btn-primary" onclick="editTutorial('<?=$value['id']?>')" title="Edit"><i class="fa fa-pencil"></i></a>
                                  <a href="<?php echo BASE_URL.'admin/tutorialdelete/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure, Do you want to DELETE this!')" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>

      </div> 
    </div>
	</div>
</div>

    


<div id="addTutorial" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Tutorial Videos for <span id="upload" style="text-transform: capitalize;"></span></h4>
            </div>

              <form action="<?php echo BASE_URL.'admin/addTutorialVideo';?>" method="post" enctype="multipart/form-data" name="tutorial">
                <?php echo validation_errors(); ?>  
                <div class="modal-body"> 
                    <p>
                        <label>Subject <span class="required text-danger"> * </span> </label>
                        <input name="subject" value="" size="20" type="text" class="form-control" required>
                        <span class="error"><?php echo  form_error('subject'); ?></span>
                    </p> 
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="" size="20" type="text" class="form-control" required>
                        <input name="type" value="" id="type" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    </p>
                   <!--  <p>
                        <label>Thumbnail Photo</label>
                        <input name="thumbphoto" value="" size="20" type="file" class="form-control">
                        <span class="error"><?php echo  form_error('thumbphoto'); ?></span>
                    </p> -->
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" class="form-control" placeholder="Write Some Lines about this Video..." required></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>
                            
                    </p>
                    <p class="temppreview">
                        <label>Upload Video</label>
                        <input name="uploadvideo" type="file" class="form-control">
                        <span class="error"><?php echo  form_error('uploadvideo'); ?></span>
                    </p>
                    <p class="temppreview">
                        <label>Youtube Video Url</label>
                        <input name="url" type="url" class="form-control" id="">
                        <span class="error"><?php echo  form_error('url'); ?></span>
                    </p>    
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="Upload" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editTutorial" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Tutorial Videos</h4>
            </div>

              <form action="<?php echo BASE_URL.'admin/editTutorialVideo';?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <?php echo validation_errors(); ?>  
                <div class="modal-body"> 
                    <p>
                        <label>Type</label>
                        <input name="type" value="" id="etype" type="text" class="form-control" readonly>
                    </p>
                    <p>
                        <label>Subject <span class="required text-danger"> * </span> </label>
                        <input name="subject" value="" id="esubject" size="20" type="text" class="form-control" required>
                        <span class="error"><?php echo  form_error('subject'); ?></span>
                    </p> 
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    </p>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="ediscription" class="form-control" placeholder="Write Some Lines about this Video..." required></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>
                    <p>
                        <label>Show on support page</label>
                        <select name="show_on_faq" class="form-control" id="eshow_on_faq">
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>
                    <p class="temppreview">
                        <label>Upload New Video</label>
                        <input name="uploadvideo" type="file" class="form-control" >
                       <!--  <video width="320" height="240" controls>
                            <source id="euploadvideo"  src="" type="video/mp4">
                            <source  id="euploadvideo" src="" type="video/ogg">
                            Your browser does not support the video tag.
                        </video> -->
                        <span class="error"><?php echo  form_error('uploadvideo'); ?></span>
                    </p> 
                    <p class="temppreview">
                        <label>Youtube Video Url</label>
                        <input name="url" type="url" class="form-control" id="eurl">
                        <span class="error"><?php echo  form_error('url'); ?></span>
                    </p>   
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="Upload" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <div id="platTutorialvideo" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Play Video</h4>
            </div>
            <div class="modal-body text-center"> 
              
            <embed width="320" height="240" id="playvideo" src="" ></embed> 
               <video width="320" height="240" controls>
                  <source  id="playvideo" src="" type="video/mp4">
                  <source  id="playvideo" src="" type="video/ogg">
                  Your browser does not support the video tag.
                </video>     
            </div>
        </div>
    </div>
</div> -->

<div id="playceonpointvideo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ceonpoint Video</h4>
            </div>
            <div class="modal-body text-center" id="urlcevideo">
            <!--<embed width="420" height="315" id="urlcevideo" src="" ></embed> -->
                <!-- <iframe width="420" height="315" id="urlvideo" src="" frameborder="0" allowfullscreen><p>Your browser does not support iframes.</p></iframe>      -->
            </div>
        </div>
    </div>
</div>

<div id="playurlvideo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Video</h4>
            </div>
            <div class="modal-body text-center" id='videotutorial'>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function playvideo(url){
		$('#videotutorial').html('<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+url+'" frameborder="0" allowfullscreen ></iframe>');
		$('#playurlvideo').modal('show');
    }

    function play(url){
	   $('#urlcevideo').html('<iframe width="100%" height="315" src="'+url+'" frameborder="0" allowfullscreen ></iframe>');
		$('#playurlvideo').modal('hide');
      $('#playceonpointvideo').modal('show'); 	
      /*$('#urlcevideo').attr('src',url);
      $('#playurlvideo').modal('hide');
      $('#playceonpointvideo').modal('show'); */
    }

     function popAddTutorial(upload) {
      // alert(upload);
      $('#addTutorial').modal('show');
      $('#upload').html(upload);
      $('#type').val(upload);

    }

    function editTutorial(id) {
      // $('#editTutorial').modal('show');
      // $('#id').val(id);
      $.ajax({
              type: "POST",
              url: '<?php echo base_url("admin/getTutorialVideo");?>',
              data: { id : id},
              success: function(result){
                obj = jQuery.parseJSON(result);
                // alert(obj.title);
                var link = '<?php echo ASSETS_URL?>upload/tutorial/';
                  // $('#certinutan').html(result);
                  $('#editTutorial').modal('show');
                  $('#esubject').val(obj.subject);
                  $('#etitle').val(obj.title);
                  $('#id').val(obj.id);
                  $('#ediscription').val(obj.discription);
                  $('#euploadvideo').attr('src',link+obj.uploadvideo);
                  $('#etype').val(obj.type);
                  $('#estatus').val(obj.status);
                  $('#eshow_on_faq').val(obj.show_on_faq);
                  $('#eurl').val(obj.url);
              }
          });
    }
</script>
