
       
            <h4 class="border-title text-left tab-title">TUTORIALS</h4>
            <div class="row">
              <div class="col-md-12">
                <?php if(count($usertutorials)>0){ ?>
                  <div class="training-semi-slider-6 pagi-above">
                  <?php foreach ($usertutorials as $key => $value) { ?> 
                    <?php if(!empty($value['uploadvideo'])){ ?>
                    <div class="item">
                      <div class="training-semi">
                        <div class="new-training-box">

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
           
			
			      <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10%">No.</th>
                                <th width="30%">Title</th> 
                                <th width="40%">Discription</th> 
                                <th width="10%">Video</th> 
                                <th width="10%">Url</th>  
                                <!-- <th width="9%">Published on</th>  -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1;
             foreach ($usertutorials as $key => $value) {  

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
                                <td width="10%"><?php echo $count;?></td>
                                <td width="30%"><?php echo $value['title'];?></td>
                                <td width="40%"><?php echo $value['discription'];?></td> 
                                <td width="10%"><a href="javascript:void(0)" onclick="play('<?php echo $video; ?>')"><?php echo $vid; ?></a></td> 
                                <td width="10%"><a href="javascript:void(0)" onclick="playvideo('<?php echo $url;?>')"><?php echo $urlt;?></a></td> 
                                <!-- <td width="9%"><?php echo $value['added_on'];?></td>  -->
                            </tr>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>



<div id="platTutorialvideo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Play Video</h4>
            </div>
            <div class="modal-body text-center"> 
                <video width="320" height="240" controls>
                  <source  id="playvideo" src="" type="video/mp4">
                  <source  id="playvideosss" src="" type="video/ogg">
                  Your browser does not support the video tag.
                </video>      
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
            <div class="modal-body text-center" id="urlcevideo">
            </div>
        </div>
    </div>
</div>

<div id="playceonpointvideo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ceonpoint Video</h4>
            </div>
            <div class="modal-body text-center" id="videotutorial">
            
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  function playvideo(url){
    $('#videotutorial').html('<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+url+'" frameborder="0" allowfullscreen ></iframe>');
    $('#playceonpointvideo').modal('show');
  }

  function play(url){
    $('#urlcevideo').html('<iframe width="100%" height="315" src="'+url+'" frameborder="0" allowfullscreen ></iframe>');
    $('#playceonpointvideo').modal('hide');   
    $('#playurlvideo').modal('show');
  }
</script>

 
