
<?php $this->load->view('template/picture_provider'); ?>

<style>
        .sertificate-box {
            display: flex;
            clear: both;
            margin-bottom: 20px;
            text-align: center;
        }
        .sertificate-boxs .owl-buttons{ 
            justify-content: space-between;
            position: absolute;
            top: 32%;
            width: 100%;
            display: flex;
        }
        .sertificate-boxs .owl-prev{
            font-size: 0;
            margin-left: -15px;
        }
        .sertificate-boxs .owl-next{
            font-size: 0;
            margin-right: -15px;
        }

        .sertificate-iner-box {
            margin-right: 10px;
        }

        .sertificate-iner-box {
            height: 200px;
            width: 100%;
        }

        .sertificate-btn {
            margin: 6px auto;
            text-align: center;
        }

        .after-label {
            padding-left: 15px;
        }

        .sertificat-choose .form-control {
            margin-bottom: 10px;
        }

        .after-add-more-box {
            display: flex;
        }

        .after-add-more-box .after-label {
            padding-left: 15px;
            width: 100%;
        }

        .after-add-more-box .form-group {
            width: 100%;
            text-align: right;
        }

        .certifiacte-changing {
            text-align: right;
        }
        .error {
            color:#d14;
        }
        [type=radio] { 
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
        }
        /* CHECKED STYLES */
        [type=radio]:checked + img {
                border: 2px solid rgb(32, 223, 128);
                box-shadow: 0 0 10px rgba(32,223,128,.4);
                position: relative;
        }
        .templatechoose{
            height: auto;
            display: block;
            background: white;
            border: 1px solid #eee;
            border-radius: 0;
            padding: 5px;
            /* margin-bottom: 1rem; */
            text-align: center;
            /* box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5); */
            position: relative;
        }
        .sertificate-iner-box  .fa {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background: #0caa41;
        height: 30px;
        width: 30px;
        color: #fff;
        text-align: center;
        line-height: 30px;
        border-radius: 50%;
        display: none;
        }
        .sertificate-boxs input:checked+img+.fa {
        display: block;
        }
</style>

<div class="innerContent">
	<div class="container">
		<div class="row">

	   <?php	$this->load->view('provider/sidebar');
		      $cid = $this->uri->segment(3); ?>	

            <div class="col-sm-9">
        		<h3 class="border-title text-left">Create Course</h3>
        		<div class="step-wise-query">
                    <ul class="nav-tabs hidden-xs">
                        <li><a  href="<?php echo site_url('provider/overview/').$cid;?>">Overview</a></li>
                        <li><a  href="<?php echo site_url('provider/lesson/').$cid;?>">Lessons</a></li>
                        <li><a  href="<?php echo site_url('provider/quiz/').$cid;?>">Quiz</a></li>
                        <li class="active"><a  href="<?php echo site_url('provider/certificate/').$cid;?>">Certificate</a></li>
                        <li><a  href="<?php echo site_url('provider/evaluation/').$cid;?>">Evaluation</a></li>
                        <?php 
                            if($this->session->userdata('logged_in')['under_insititution'] == 0 ){ ?>
                            <li><a href="<?php echo site_url('provider/promotion').$cid; ?>">Promotion</a></li>
                        <?php } ?>
                        <li><a  href="<?php echo site_url('provider/publish/').$cid;?>">Publish</a></li>
                    </ul>
                </div>
 
	<div class="tab-content steps-detail">
        		<!-- <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a> -->
        <div id="step1" class="tab-pane fade in active">
			<h3>Course Certificate</h3>

            <form action="<?php echo site_url();?>provider/certificate" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
                <div class="row">
                <?php echo $this->session->flashdata('response'); ?>
                <?php $userdetails = $this->user->get_user_record('tbl_course','id',$this->session->userdata('current_course_id')); ?>
                	<input type="hidden" name ="user_id" value ="<?php echo $userdetails->user_id; ?>">
                    <input type="hidden" name ="course_title" value ="<?php echo $userdetails->course_title; ?>">
                    <input type="hidden" name ="course_id" value ="<?php echo $userdetails->id; ?>">				
                   
                    <div class="col-sm-12 form-group">
                        <h4><strong>Upload Certificate</strong></h4><br>
                		<label>1) Choose Template : </label>
                    </div>
                    <div class="col-sm-12 form-group">
                        <label>a) CATEGORY <sup>*</sup></label>
                            <select name="category" id="category" class="form-control changecategory" onchange="gettemplete()" required="">
                                   <option value="">ALL - Choose Category</option>
                                   <option value="Portrait">PORTRAIT</option>
                                   <option value="Landscape">LANDSCAPE</option>
                            </select>
                            <span class="error"><?php echo  form_error('category'); ?></span>
                    </div>
                       
                    <div class="col-sm-12 form-group">
                        <label>b) SIGNATURE <sup>*</sup></label>
                            <select name="numsignature" id="numsignature" class="form-control changecat" onchange="gettemplete()" required="">
                                   <option value="">Choose number of Signature</option>
                                   <option value="1">Signature 1</option>
                                   <option value="2">Signature 2</option>
                                   <option value="3">Signature 3</option>
                                   <option value="4">Signature 4</option>
                            </select>
                        <span class="error"><?php echo  form_error('numsignature'); ?></span>
                    </div>

                <div class="col-sm-12 form-group">
                    <div id="loader"></div>
                    <label>c) Click Design <sup>*</sup></label>
                	<div class="sertificate-boxs" id="templatechoose">
                		<?php foreach($templete as $temp): ?>
                        <div class="item">
                            <label> 
                				<div class="sertificate-iner-box">
                                	<input type="radio" name="templete_id" value="<?php echo $temp->id;?>">
                                    <img src="<?php echo ASSETS_URL.'upload/certificate_templete/';?><?php echo $temp->temppreview; ?>" alt="<?php echo $temp->template_no;?>">
                                    <i class="fa fa-check"></i>
                				</div>
                        	   
                            <div class="sertificate-btn">
                                <button type="button" class="btn btn-primary certificateview" data-toggle="modal" data-target="#myModal" data-id="<?php echo ASSETS_URL.'upload/certificate_templete/'.$temp->temppreview; ?>">View</button>
                            </div>
                        </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                		<span class="error"><?php echo  form_error('templete_id'); ?></span>
                </div>	

                <div class="col-sm-12 form-group">
                    <label><strong>View Certificate Sample and labels</strong></label>
                    
                    <button type="button" class="btn btn-primary" id="sample"
                        data-toggle="modal" data-target="#myModalcertificatemodal">Click
                        Here</button>
                </div>

                <div class="col-sm-12 form-group">
                    <label>2) Enter Contents : </label>
                </div>

                <div class="col-sm-12 form-group">
                		<label>Header Content<sup>*</sup></label>
                		<input type="text" class="form-control" placeholder="Enter first line" name="header_line1" id="header_line1" required>
                        <input type="text" class="form-control" placeholder="Enter Second line" name="header_line2" id="header_line2">
                        <input type="text" class="form-control" placeholder="Enter third line" name="header_line3" id="header_line3">
                </div>

                 <div class="col-sm-12 form-group" >
                    <div class="after-add-more-one">
                        <div class="row">
                            <div class="after-label">
                                   <label>Upload Logo<sup>*(Logo Should be 20KB to 50KB)</sup></label>
                            </div>
                            <div class="logocancel" style="display: flex; align-items: center;"><span class="cancel-mark" id="cancel" title="cancel"><i class="fa fa-close"></i></span>
                                <div class="col-md-6 form-group">
                                    <input type="file" onchange="readURL(this);" class="form-control" name="logo1"
                                        multiple="multiple" required="">
                                    <img  id="logo1" width="70">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="file" onchange="readURL1(this);" class="form-control" name="logo2"
                                        multiple="multiple" id="file2">
                                    <img id="logo2" width="70">
                                </div>
                            </div>
                            <span class="error"><?php echo form_error('logo1'); ?></span>
                            <span class="error"><?php echo form_error('logo2'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 form-group">
                        <label>Certificate Title<sup>*</sup> : </label>
                        <input type="text" class="form-control" name="certificatetitle" id="certificatetitle" placeholder="OF COMPLETION" maxwidth="30" required>
                        <span class="error"><?php echo  form_error('certificatetitle'); ?></span>
                </div> 

                <div class="col-sm-12 form-group">
                        <label>Intro Text<sup>*</sup> : </label>
                        <input type="text" class="form-control" name="introText" id="introText" placeholder="has successfully completed the" maxwidth="30" required>
                        <span class="error"><?php echo  form_error('introText'); ?></span>
                </div>
                 

                <div class="row">
                    <div class="col-sm-12 form-group" id="signloop">
                        <div class="after-add-more signature">
                            <div class="after-add-more-box">
                                <div class="after-label">
                                    <label>Signatory/ies<sup>*</sup></label>
                                </div>
                            </div>
                        <div class="form-group sertificat-choose">
                            <input type="text" class="form-control" name="name[]" placeholder="Name" multiple="multiple" maxwidth="15" required>
                                <!-- <span class="error"><?php echo  form_error('name'); ?></span> -->
                            <input type="text" class="form-control" name="position[]" placeholder="Position" multiple="multiple" maxwidth="15" required>
                                <!-- <span class="error"><?php echo  form_error('position'); ?></span> -->

                                <div style="display: flex; align-items: center;">
                                    <div class="form-group">
                                        <label>Upload Signature</label>
                                        <input type="file" class="form-control" name="files[]" multiple="multiple" required>
                                         <!-- <img  id="sign" class="usignature"> -->
                                        <!-- <span class="error"><?php echo  form_error('files'); ?></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2 form-group">
                    <input type="submit" class="btn btn-primary btn-lg" value="Save & Next" name="fileSubmit">
                </div>
                </div>
            </form>
		</div>
	</div>

		</div>
		</div>
		</div>
	</div>
   
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
              

    <!-- Include Date Range Picker -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://ceonpoint.com/assets/js/bootstrap-select.min.js"></script>
    <script src="https://ceonpoint.com/assets/js/countrypicker.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />



    <!-- <script src="<?php echo ASSETS_URL.'editor/js/froala_editor.min.js'; ?>"></script> -->
    <script type="text/javascript" src="https://ceonpoint.com/assets/js/plugin.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <!-- <script src="https://ceonpoint.com/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="https://ceonpoint.com/assets/js/owlcarousel/owl.js"></script>
    <script src="https://ceonpoint.com/assets/css/owl.carousel.css"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script src="<?php echo ASSETS_URL.'js/certificate.js'; ?>"></script>
    <script type="text/javascript">

        function gettemplete(){
          var category = $("select.changecategory").children("option:selected").val(); 
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
                            // console.log(x.id);
                            itemhtml += '<div class="item"><label><div class="sertificate-iner-box"><input type="radio" name="templete_id" value="'+x.id+'"><img src="https://www.ceonpoint.com/assets/upload/certificate_templete/'+x.temppreview+'" alt="'+x.template_no+'"><i class="fa fa-check"></i></div><div class="sertificate-btn"><button type="button" class="btn btn-primary certificateview" data-toggle="modal" data-target="#myModal" data-id="https://www.ceonpoint.com/assets/upload/certificate_templete/'+x.temppreview+'">View</button></div></label></div>';
                            }
                            itemhtml += '</div>';

                        $("#templatechoose").html(itemhtml);
                        $('.sertificate-boxs').owlCarousel({
                            loop: true,
                            margin: 10,
                            nav: true,
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
                        $('.owl-carousel').show();
                        $(".owl-nav").attr('class', 'owl-buttons');
                        // $('.owl-nav').show();
                    });  
        }
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

    $('#cancel').click(function(){
        $('#logo2').attr('src',"");
        $('#file2').val("");
    }); 
    </script>


    
        