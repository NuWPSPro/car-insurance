
<style> .sertificate-box{display:flex;clear:both;margin-bottom:20px;text-align:center}.sertificate-iner-box{margin-right:10px}.sertificate-boxs .owl-buttons{justify-content:space-between;position:absolute;top:32%;width:100%;display:flex}.sertificate-boxs .owl-prev{font-size:0;margin-left:-15px}.sertificate-boxs .owl-next{font-size:0;margin-right:-15px}.sertificate-iner-box{height:200px;width:100%}.sertificate-btn{margin:6px auto;text-align:center}.after-label{padding-left:15px}.sertificat-choose .form-control{margin-bottom:10px}.after-add-more-box{display:flex}.after-add-more-box .after-label{padding-left:15px;width:100%}.after-add-more-box .form-group{width:100%;text-align:right}.certifiacte-changing{text-align:right}.error{color:#d14}[type=radio]{position:absolute;opacity:0;width:0;height:0}[type=radio]+img{cursor:pointer}[type=radio]:checked+img{border:2px solid #20df80;box-shadow:0 0 10px rgba(32,223,128,.4);position:relative}.templatechoose{height:auto;display:block;background:#fff;border:1px solid #eee;border-radius:0;padding:5px;text-align:center;position:relative}.sertificate-iner-box .fa{position:absolute;left:32%;top:42%;transform:translate(-50%,-50%);background:#0caa41;height:30px;width:30px;color:#fff;text-align:center;line-height:30px;border-radius:50%;display:none}.sertificate-boxs input:checked+img+.fa{display:block}
</style>

<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
        rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Baloo|Tangerine:400,700&display=swap&subset=devanagari,latin-ext,vietnamese"
        rel="stylesheet">

    <form action="<?php echo site_url();?>/provider/choose_certificate_edit/<?php echo $training_id; ?>" method="post" enctype="multipart/form-data" name="form1">
        <div class="row">
            <?php echo $this->session->flashdata('response');
            $uid = $this->session->userdata('logged_in')['id'];?> 
                <input type="hidden" name="idd" id="idd" value="<?php echo $certificate[0]['id']; ?>">             
                <input type="hidden" name="tid" id="tid" value="<?php echo $training_id; ?>">

                    <div class="col-sm-12 form-group">
                        <h4><strong>Upload Certificate</strong></h4><br>
                        <label>1) Choose Template : </label>
                    </div>

                    <!-- <div class="col-sm-12 form-group"> -->
                        <div class="col-sm-12 form-group">
                            <label>a) CATEGORY<sup>*</sup></label>
                            <select name="category" id="category" class="form-control showcategory" onchange="gettemplete()">
                                   <option value="Portrait" <?php if($certificate[0]['category']=='Portrait'){ echo 'selected'; } ?>>PORTRAIT</option>
                                   <option value="Landscape" <?php if($certificate[0]['category']=='Landscape'){ echo 'selected'; } ?> >LANDSCAPE</option>
                            </select>
                            <span class="error"><?php echo  form_error('category'); ?></span>
                        </div>
                       
                         <div class="col-sm-12 form-group">
                            <label>b) SIGNATURE<sup>*</sup></label>
                                <select name="numsignature" id="numsignature" class="form-control changecat" onchange="gettemplete()">
                                       <option value="1" <?php if($certificate[0]['num_signature']=='1'){ echo 'selected'; } ?> > Signature 1</option>
                                       <option value="2" <?php if($certificate[0]['num_signature']=='2'){ echo 'selected'; } ?>> Signature 2</option>
                                       <option value="3" <?php if($certificate[0]['num_signature']=='3'){ echo 'selected'; } ?> >Signature 3</option>
                                       <option value="4" <?php if($certificate[0]['num_signature']=='4'){ echo 'selected'; } ?> >Signature 4</option>
                                </select>
                            <span class="error"><?php echo  form_error('numsignature'); ?></span>
                        </div>
                <!-- </div> -->

                <div class="col-sm-12 form-group" >

                    <div id="loader"></div>
                    <label>c) Click Design<sup>*</sup></label>

                    <div class="new" id="templatechoose">
                    <div class="sertificate-boxs">
                        <?php foreach($templete as $temp): ?>
                            <div class="item">
                                <label> 
                                    <div class="sertificate-iner-box ">
                                        <input type="radio" name="templete_id" value="<?php echo $temp->id;?>" <?php if($certificate[0]['templete_id'] == $temp->id ){ echo 'CHECKED'; } ?> >
                                        <img src="<?php echo ASSETS_URL.'upload/certificate_templete/';?><?php echo $temp->temppreview; ?>" alt="<?php echo $temp->template_no; ?>" >
                                        <i class="fa fa-check"></i>
                                    </div>
                                </label>
                                   
                                <div class="sertificate-btn">
                                    <button type="button" class="btn btn-primary certificateview" data-toggle="modal" data-target="#myModal" data-id="<?php echo ASSETS_URL.'upload/certificate_templete/'.$temp->temppreview; ?>">View</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    </div>
                        <span class="error"><?php echo  form_error('templete_id'); ?></span>
                </div>  

                <div class="col-sm-12 form-group">
                    <label>
                        <strong>View Certificate Sample and labels</strong>
                    </label>
                    <button type="button" class="btn btn-primary" id="sample" data-toggle="modal" data-target="#myModalcertificatemodal">Click Here</button>
                </div>

                <div class="col-sm-12 form-group">
                    <label>2) Enter Contents : </label>
                </div>

                <div class="col-sm-12 form-group">
                        <label>Header Content<sup>*</sup></label>
                        <input type="text" class="form-control" placeholder="Enter first line" name="header_line1" id="header_line1" value="<?php echo $certificate[0]['header_line1']; ?>">
                        <input type="text" class="form-control" placeholder="Enter Second line" name="header_line2" id="header_line2" value="<?php echo $certificate[0]['header_line2']; ?>" >
                        <input type="text" class="form-control" placeholder="Enter third line" name="header_line3" id="header_line3" value="<?php echo $certificate[0]['header_line3']; ?>" >
                </div>

                <div class="col-sm-12 form-group" >
                    <div class="after-add-more-one">
                        <div class="row">
                            <div class="after-label">
                                   <label>Upload Logo<sup>*(Logo Should be 20KB to 50KB)</sup></label>
                            </div>
                            <div class="logocancel" style="display: flex; align-items: center;">
                                <a href="<?php echo site_url('provider/deletelogo/'.$certificate[0]['id'].'/'.$training_id.'/1'); ?>" class="cancel-mark" id="cancel" title="delete" onclick="return confirm('Are you sure? you want to delete it.')"><i class="fa fa-close"></i></a>
                                <div class="col-md-6 form-group">
                                    <?php $crlogo1 = ($certificate[0]['logo1']=='')?'no-image.png':$certificate[0]['logo1'];?>
                                    <input type="file" onchange="readURL(this);" class="form-control" name="logo1"
                                    multiple="multiple">
                                    <img  id="logo1" src="<?php echo ASSETS_URL.'upload/certificate/logo/'.$crlogo1; ?>" width="70">
                                </div>
                                <div class="col-md-6 form-group">
                                    <?php $crlogo2 = ($certificate[0]['logo2']=='')?'no-image.png':$certificate[0]['logo2'];?>
                                    <input type="file" onchange="readURL1(this);" class="form-control" name="logo2"
                                        multiple="multiple" id="file2">
                                    <img id="logo2" src="<?php echo ASSETS_URL.'upload/certificate/logo/'.$crlogo2; ?>" width="70">
                                </div>
                            </div>  
                            <span class="error"><?php echo form_error('logo1'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 form-group">
                        <label>Certificate Title<sup>*</sup> : </label>
                        <input type="text" class="form-control" name="certificatetitle" id="certificatetitle" value=" <?php echo $certificate[0]['title']; ?>" placeholder="OF COMPLETION" >
                        <span class="error"><?php echo  form_error('certificatetitle'); ?></span>
                </div> 

                <div class="col-sm-12 form-group">
                        <label>Intro Text<sup>*</sup> : </label>
                        <input type="text" class="form-control" name="introText" id="introText" value="<?php echo $certificate[0]['intro_text']; ?>" placeholder="has successfully completed the" >
                        <span class="error"><?php echo  form_error('introText'); ?></span>
                </div>
                 
                <?php
                    $namearray = explode('##', $certificate[0]['name']);
                    $postionarray = explode('##', $certificate[0]['position']);
                    $filesarray = explode('##', $certificate[0]['signature']);
                    $num = count($namearray); ?>
                    
                    <div class="col-sm-12 form-group" id="signloop">
                        <?php for($i=0;$i<$num;$i++){ ?>
                        <div class="after-add-more signature">
                            <div class="after-add-more-box">
                                <div class="after-label">
                                    <label>Signatory/ies<sup>*</sup></label>
                                </div>
                            </div>
                            <div class="form-group sertificat-choose">
                                <input type="text" class="form-control" name="name[]" placeholder="Name" multiple="multiple" value="<?php echo $namearray[$i] ?>" >
                                <input type="text" class="form-control" name="position[]"  placeholder="Position" multiple="multiple" value="<?php echo $postionarray[$i]; ?>">

                                <div style="display: flex; align-items: center;">
                                    <div class="form-group">
                                        <label>Upload Signature</label>
                                        <input type="file" class="form-control" name="files[]"  multiple="multiple">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    

                <div class="col-sm-2 form-group">
                    <input type="submit" class="btn btn-primary btn-lg" value="Update & Next" name="fileSubmit">
                </div>
                        

        </div>
    </form>
    <p>
        <strong>Certificate Preview</strong>
    </p>
    <p>
    <?php foreach($templete as $temp){ 
            if($certificate[0]['templete_id'] == $temp->id ){ 
                $bg_image = $temp->bg_image;
                $text_image = $temp->text_image; ?>
            <img style="max-width: 100%; height: auto;" src="<?php echo ASSETS_URL.'upload/certificate_templete/';?><?php echo $temp->temppreview; ?>" alt="<?php echo $temp->template_no.' * '.$temp->category; ?>" width="180" height="120" > 
        <?php } } ?>
    </p>
    <p>
        <input type="button" id="Preview_button" class="btn btn-primary btn-lg" value="Preview" onclick="preview_certificate('<?=$uid; ?>','<?=$training_id; ?>');">
    </p>
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>


 <script type="text/javascript">

        function gettemplete(){
          var category = $("select.showcategory").children("option:selected").val(); 
          var signature = $("select.changecat").children("option:selected").val(); 

          $.ajax({
                        type: "POST",
                        url: '<?php echo base_url("provider/get_certificate_temp");?>',
                        dataType: 'json',
                        data: { category : category , signature : signature}

                    }).done(function(result) {

                         var itemhtml ='<div class="sertificate-boxs">';
                            for (i in result) {
                            x = result[i];
                            console.log(x.id);
                            itemhtml += '<div class="item"><label><div class="sertificate-iner-box"><input type="radio" name="templete_id" value="'+x.id+'"><img src="https://www.ceonpoint.com/assets/upload/certificate_templete/'+x.temppreview+'" alt="'+x.template_no+'"><i class="fa fa-check"></i></div><div class="sertificate-btn"><button type="button" class="btn btn-primary certificateview" data-toggle="modal" data-target="#myModal" data-id="https://www.ceonpoint.com/assets/upload/certificate_templete/'+x.temppreview+'">View</button></div></label></div>';
                            }
                            itemhtml += '</div>';

                        $("#templatechoose").html(itemhtml);
                        $('.sertificate-boxs').owlCarousel({
                        loop: true,
                        margin: 12,
                        nav: true,
                        dots: false,
                        autoplay: false,
                        autoplayTimeout: 5000,
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 2
                            },
                            990: {
                                items: 2
                            },
                            1200: {
                                items: 5
                            }
                        }

                    });
                        $('.owl-carousel').show();
                        $(".owl-nav").attr('class', 'owl-buttons');
                        // $('.owl-nav').show();
                    });  
        }
         $(document).ready(function () {
           // var numberOfdiv = $('.sertificat-choose').children('div').length;
                // alert(numberOfdiv);
            $("select.changecat").change(function () { 
                var selectedCat = $(this).children("option:selected").val();
                    for(var i=0;i<selectedCat;i++){
                    
                    var html = $(".after-add-more").first().clone().find("input:text").val("").end();
                    $(html).find(".change").html("<a class='btn btn-danger remove' style='padding: 6px 10px;'>Remove</a>");
                   // $(".after-add-more").last(html).after(html);
                    if(i==0)
                    {
                        $("#signloop").html(html);
                    }
                    else
                    {
                       $(".after-add-more").last(html).after(html); 
                    }
                }
            });
            $("body").on("click", ".remove", function () {
                $(this).parents(".after-add-more").remove();
            });
        });

    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#logo1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
    }

    function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#logo2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
    }

    $('#cancel').click(function(){
    $('#logo2').attr('src',"");
    $('#file2').val("");
    }); 

    $("body").on("click",".certificateview",function(){
    // $('.certificateview').click(function(){
        var certificate = $(this).attr('data-id');
        $('#certificateimagelist').attr('src', certificate);
    });
    // });

    
     $('.sertificate-boxs').owlCarousel({
            loop: true,
            margin: 10,
            navigation: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                990: {
                    items: 2
                },
                1200: {
                    items: 5
                }
            }

        });

         $(document).ready(function () {
            
            $("#loader").delay(1000).hide(0).fadeOut("slow");
            
            $("select.changecat").change(function () { 
                var selectedCat = $(this).children("option:selected").val();
                    for(var i=0;i<selectedCat;i++){
                    
                    var html = $(".after-add-more").first().clone().find("input:text").val("").end();
                    $(html).find(".change").html("<a class='btn btn-danger remove' style='padding: 6px 10px;'>Remove</a>");
                   // $(".after-add-more").last(html).after(html);
                    if(i==0)
                    {
                        $("#signloop").html(html);
                    }
                    else
                    {
                       $(".after-add-more").last(html).after(html); 
                    }
                }
            });
            $("body").on("click", ".remove", function () {
                $(this).parents(".after-add-more").remove();
            });
        });
    </script>

    <div id="myModalcertificatemodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Sample Certificate</h4>
                </div>
                <div class="modal-body">
                    <div id="filteredData22"><center>
                    <img src="<?php echo base_url('assets/images/certificateimage.png'); ?>"
                        alt=""></center></div>
                </div>
            </div>
        </div>
    </div>
            
        <div class="modal fade" id="myModal" role="dialog" >
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Certificate Template</h4>
                </div>
                <div class="modal-body">

                  <center>
                    <img id="certificateimagelist" src="">
                   </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>


    <div class="modal fade modal-fullscreen" id="finalCertificate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-white">Preview of Your Certificate</h4>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
              <div class="Certificate-page" id="certinutan">
              </div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>
    </div> 
                        

<script>
    function preview_certificate(uid,tid){

         $.ajax({
                    type: "POST",
                    url: '<?php echo base_url("provider/preview_certificate");?>',
                    data: { tid : tid , uid : uid},
                    beforeSend: function(){
                        $('#Preview_button').val('Please wait...');
                    },
                    success: function(result){
                        $('#certinutan').html(result);
                        $('#finalCertificate').modal('show');
                        $('#Preview_button').val('Preview');
                    }
                    
                });
        }
</script>

                        


