 <style>#toc_container {background: #f9f9f9 none repeat scroll 0 0;border: 1px solid #aaa;display: table;font-size: 95%;margin-bottom: 1em;padding: 20px;width: auto;}.toc_title {font-weight: 700;text-align: center;}#toc_container li, #toc_container ul, #toc_container ul li{list-style: outside none none !important;}.modal-body p {font-size: 14px;margin: 15px 0;color: #555;}.modal-body .question {margin-left: 35px;margin-top: -20px;}.star-checkbox{display:none;}.star-checkbox + label{display:inline-block;cursor: pointer;width:15px;}.star-checkbox + label:before {content: '\f005';font-family:'fontawesome';color:#000;background-color:#fff;}.star-checkbox:checked + label:before{background-color:#fff;color: #f9b111;transition: all .2s ease-in-out;}.form-check {margin-top: -5px;}.form-check label {margin: 0px 5px 0px;vertical-align: text-top;font-size: 12px;color: #000;letter-spacing: .5px;}.socials-icons{position:fixed;top:30%;left:0;z-index: 99999;}.socials-icons a {font-size: 25px;color: #fff;background:#4565a2;display: block;padding: 15px;width: 100%;text-align: center;text-decoration: none;}.socials-icons .socials-link2{background:#60b4f0;}.socials-icons .socials-link3{background:#bb1217;}.socials-icons .socials-link4{background:#e15641;}.socials-icons .socials-link5{background:#d3262c;}.socials-icons .socials-link6{background:#0a80bd;}.evaluate_now .nav-tabs>li.active>a{background-color: transparent;border: 1px solid transparent;}.evaluate_now .nav-tabs>li {margin-bottom: -1px;display: inline-block;float: none;width: 100%;}.evaluate_now .nav-tabs>li:last-child{background:#fff;}.evaluate_now .nav-tabs>li:last-child P{color:#000;}.evaluate_now .nav-tabs>li.active>a img {border: 3px solid rgba(256,256,256,0.8);}span#speaker_name {color: #92278f;}input#save {padding: 7px 20px;font-size: 16px;font-weight: normal;border-radius: 3px;background-color: #92278f;color: #fff;border: none;}.evaluate_now .nav-tabs {background-image:url(<?php echo ASSETS_URL.'images/templates/homet2-speaker-bg.jpg';?>);background-repeat: no-repeat;background-size: cover;text-align: center;background-position: 50% 32%;padding: 0 0;margin-bottom: 30px;display: flex;justify-content: space-around;}.evaluate_now .nav-tabs img {width: 60px;border-radius: 50%;height: 60px;object-fit: cover;border: 3px solid rgba(256,256,256,0.4);}.evaluate_now .nav-tabs P {color: #fff;font-size: 11px;margin: 10px 0;}.evaluate_now .nav-tabs a:hover {background: #000;color:#000;}.evaluate_now .nav-tabs>li>a:hover {border-color: #000;color:#000;}.evaluate_now .nav>li>a:focus, .evaluate_now .nav>li>a:hover {text-decoration: none;background-color: transparent;color:#000;border: transparent;}.evaluate_now{width:80%;}.evaluate_now .nav-tabs>li>a {height: 121px;}.icu_history {font-size: 20px;color: red;}@media (max-width:767px){.socials-icons a {font-size:20px;display: inline-block;padding: 15px;width: 72.6px;margin: -2px;}.socials-icons {top: 93%;width: 100%;}}</style>

<?php $this->load->view('template/picture_provider'); ?>

<div class="innerContent">
	<div class="container">
		<div class="row">
			<h3 class="border-title text-left"><?php echo $course[0]['course_title'];?><span style="color: #478bca; font-weight: bold; margin-left: 12px;">(<?php echo 'Course Details'; ?>)</span>
                <a class="btn btn-primary pull-right" href="<?php echo site_url('provider/course_listing');?>">Back</a>
            </h3>

            <div class="step-wise-query provider-overview" id="selector">
	            <ul class="nav-tabs hidden-xs">
	                <!-- <li><a data-toggle="tab" href="#course-table_content" aria-expanded="true" >Table of Content</a></li> -->
	                <li class="active"><a data-toggle="tab" href="#course-overview" aria-expanded="true" >Overview</a></li>
	                <li><a data-toggle="tab" href="#course-lessons" aria-expanded="fasle" >Lessons</a></li> 
	                <li><a data-toggle="tab" href="#course-quiz" aria-expanded="fasle" >Quiz</a></li>
                    <li><a data-toggle="tab" href="#course-report_abuse" aria-expanded="fasle" >Report Abuse</a></li>
	                <li><a data-toggle="tab" href="#course-certificate" aria-expanded="fasle" >Certificate</a></li> 
	                <li><a data-toggle="tab" href="#course-evaluation" aria-expanded="fasle" >Evaluation</a></li>
	                <li><a data-toggle="tab" href="#course-promotion" aria-expanded="fasle" >Promotion</a></li> 
	                <li><a data-toggle="tab" href="#course-publish" aria-expanded="fasle" >Publish</a></li>
	                <!-- <li><a data-toggle="tab" href="#tra-print" aria-expanded="fasle" style="font-size: 10px;">Print Course</a></li>  -->
	            </ul>

	            <div class="tab-content">
	                <div id="course-cover_page" class="tab-pane fade">
	                    <div style="background-image:url(<?php echo base_url('assets/images/uploads/').$training[0]['image']; ?>);">
	                       <div class="container">
	                            <div class="countdown-text-wrap">
	                                <div id="countdown"></div>
	                                <h2><?php echo $training[0]['title']; ?></h2>
	                                <?php   $start_date = date($training[0]['start_date']);
	                                        $new_date = date('d F Y', strtotime($start_date));

	                                        $end_date = date($training[0]['end_date']);
	                                        $end_date = date('d F Y', strtotime($end_date)); ?>
	                                <h3 style="font-size: 40px;"><?php echo $training[0]['sub_title']; ?></h3>
	                                   <?php if ($new_date == $end_date){  $date = $new_date;  }else{  $date = $new_date.' - '.$end_date; }?>
	                                <h3>
	                                    <?php echo $date; ?>, 
	                                    <br><br><?php echo $training[0]['location']; ?>
	                                    <br><br><?php echo $training[0]['units']; ?> Credit Units
	                                </h3>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	                <div id="course-table_content" class="tab-pane fade">
	                    <div class="container">
	                        <div class="col-md-4 col-md-push-4" >
	                            <img class="thumbnail" src="<?php echo ASSETS_URL.'images/uploads/'.$training[0]['image']; ?>" alt="Card image cap">
	                            <p class="toc_title">Table of Content</p>
	                                <ol class="toc_list">
	                                    <li>Overview</li>
	                                    <li>Lessons</li>
	                                    <li>Quiz</li>
	                                    <li>Certificate</li>
	                                    <li>Evaluation</li>
	                                    <li>Promotion</li>
	                                    <li>Publish</li>
	                                </ol>
	                        </div>
	                    </div>
	                </div>

	                <div id="course-overview" class="tab-pane fade active in">
	                    <h3 class="border-title text-left">Overview</h3>
	                    <div class="table-responsive">
		                    <table class="table table-striped table-bordered" style="width:100%">
								<tr>
									<th>Lesson Title</th> 
									<td><?php echo $course[0]['course_title'];?></td> 
								</tr>
								<tr>
									<th>Units</th> 
									<td><?php echo $course[0]['units'];?></td> 
								</tr>
								<tr>
									<th>Course Accreditation Number</th> 
									<td><?php echo $course[0]['course_acceditation_number'];?></td> 
								</tr>	
								<tr>
									<th>Course Photo</th> 
									<td><?php if($course[0]['course_photo'] != ''){ ?>
										<img height="50" width="50" src="<?php echo ASSETS_URL.'images/uploads/'.$course[0]['course_photo']; ?>">
										<?php }else{ echo '--'; } ?>
									</td>
								</tr>	
								<tr>
									<th>Passing Mark</th> 
									<td><?php echo $course[0]['passing_marks']; ?></td> 
								</tr>
								<tr>
									<th>Promostion Status</th> 
										<?php /*1 Free, 2 Featured, 3Top List, 4 Premium*/
										if($course[0]['paid_status']==0){
										 $cont = '<span class="btn btn-danger">Pending</span>';		
										} else if($course[0]['paid_status']==1){
										 $cont = '<span class="btn btn-primary">Free</span>';		
										} else if($course[0]['paid_status']==2){
										 $cont = '<span class="btn btn-success">Featured</span>';
										}  ?>
									<td><?php echo $cont; ?></td>
								</tr>

							<?php if($course[0]['paid_status']==2 && $course[0]['featured_from'] != ''){ ?>
								<tr>
									<th>Promotion Duration</th>
									<td><?php echo date('d F Y',strtotime($course[0]['featured_from'])) .' to '. date('d F Y',strtotime($course[0]['featured_to'])); ?></td>
								</tr>
								<tr>
									<th>Promotion Countdown</th>
									<?php 	$start = strtotime($course[0]['featured_from']);
											$end = strtotime($course[0]['featured_to']);
											$days_between = ceil(abs($end - $start) / 86400); ?>
									<td><?php echo $days_between; ?></td>
								</tr>
							<?php } ?>
								<tr>
									<th>Date Uploaded</th> 
									<td><?php echo date('d F Y',strtotime($course[0]['added_on'])); ?></td>
								</tr>
								<tr>
									<th>Validity Date</th>
                                	<td><?php if($course[0]['course_validity'] != '0000-00-00' && $course[0]['course_validity'] !=''){ 
                                		echo date('d F Y',strtotime($course[0]['course_validity'])); }else{ echo'--'; } ?></td>
								</tr>
		                    </table>
	                    </div>
	                </div>

	                <div id="course-lessons" class="tab-pane fade">
	                    <h3 class="border-title text-left">Lessons</h3>
	                    <div class="table-responsive">
	                        <table class="table table-striped table-bordered course-fillter" style="width:100%">

                            <thead>
                                <tr>
									<th>No.</th>
									<th>Lessons Title</th>
									<th>Lessons Content</th> 
                                    <th>Case Study</th>  
                                    <th>Summary</th>  
                                    <th>Course References</th>  
									<th>Lesson Video Url</th> 
                                </tr>
                            </thead>
										 
	                        <tbody class="row_position">
	                        <?php  foreach ($lesson as $key => $value) { ?>
								<tr>
									<td><?php echo $key+1; ?>.</td>
									<td><?php echo $value['lesson_title'];?></td>
									<td> <a  href="javascript:void(0);" onclick="showcontaint('<?php echo strip_tags($value['lesson_content']);?>')"> View </a></td>
                                    <td><?php echo strip_tags($value['case_study']); ?></td>
                                    <td><?php echo strip_tags($value['summary']); ?></td> 
                                    <td><?php echo strip_tags($value['course_references']); ?></td>     
									<td><?php if($value['lesson_video'] != '' ){ ?>
										<a  href="javascript:void(0);" onclick="showvideo('<?php echo ASSETS_URL.'images/uploads/video/'.$value['lesson_video'];?>')"><?php echo $value['lesson_video'];?></a>
										<?php }else{ echo'--'; } ?>
									</td>
								</tr>
							<?php } ?>
	                        </tbody>

	                        </table> 
	                    </div> 
	                </div>

                    <div id="course-quiz" class="tab-pane fade">
                        <h3 class="border-title text-left">Quiz</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered course-fillter" style="width:100%">

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Rationale</th> 
                                </tr>
                            </thead>
                                         
                            <tbody> 
                            <?php foreach ($quiz as $key => $value) { 
                                if($value['correct_answere']==1){ 
                                    $correct = 'A'; 
                                }elseif($value['correct_answere']==2){ 
                                    $correct = 'B'; 
                                }elseif($value['correct_answere']==3){ 
                                    $correct = 'C'; 
                                }else{ $correct = 'D'; } ?>                          
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value['question_title']; ?></td>
                                <td><?php echo $correct; ?></td>
                                <td><?php echo $value['rational']; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            </table> 
                        </div> 
                    </div>

                    <div id="course-report_abuse" class="tab-pane fade">
                        <h3 class="border-title text-left">Report Abuse</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered course-fillter" style="width:100%">

                            <thead>
                                <tr>
                                    <th>No.</th>  
                                    <th>Name</th> 
                                    <th>Comments</th>  
                                    <th>Date</th> 
                                </tr>
                            </thead>
                                         
                            <tbody> 
                            <?php  foreach ($report as $key => $value) {  
                                $userdata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']);  ?>

                            <tr>
                                <td><?php echo $key+1; ?>.</td> 
                                <td><?php echo $userdata[0]['name']; ?></td>      
                                <td><?php echo strip_tags($value['comment']); ?></td>      
                                <td><?php echo date('d F Y',strtotime($value['added_on'])); ?></td>    
                            </tr>
                            <?php } ?>
                            </tbody>
                            </table> 
                        </div> 
                    </div>

                    <div id="course-certificate" class="tab-pane fade">
                        <h3 class="border-title text-left">Certificate</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered course-fillter" style="width:100%">

                            <thead>
                                <tr>
                                    <th>No.</th>  
                                    <th>Course Certificate Number</th>  
                                    <th>Date Issued</th> 
                                    <th>Issued To</th> 
                                    <th>Action</th> 
                                </tr>
                            </thead>
                                         
                            <tbody> 
                            <?php  foreach ($exam as $key => $value) {  
                                $userdata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']);  ?>

                            <tr>
                                <td><?php echo $key+1; ?>.</td>                                                 
                                <td><?php echo $value['certificate_id']; ?></td>    
                                <td><?php echo date('d F Y',strtotime($value['added_on'])); ?></td>
                                <td><?php echo $userdata[0]['name']; ?></td> 
                                <td><a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" class="btn btn-default" title="View" ><i class="fa fa-eye"></i></a></td>   
                            </tr>
                            <?php } ?>
                            </tbody>
                            </table> 
                        </div> 
                    </div>

	                <div id="course-evaluation" class="tab-pane fade">
	                    <h3 class="border-title text-left">Evaluation</h3>
                        <div id="coursereview"> </div>
                    </div>
                    <div id="course-promotion" class="tab-pane fade">
                        <h3 class="border-title text-left">Promotion</h3>
                        <?php if($course[0]['paid_status']==2){ ?>
                        <?php   $dailyprices = $this->db->get_where('tbl_all_tax',array('status'=>1,'id'=>3))->row_array();  
                                $dailprice = $dailyprices['total_amount']; ?>
                            <div class="clearfix"></div>
                            <h5>Featured</h5>
                            <?php echo $dailyprices['text']; ?>
                            
                            <h3 class="border-title text-left">Featured promotion appearance</h3>
                            <img src="<?php echo ASSETS_URL.'images/uploads/'.$dailyprices['image']; ?>" alt="">
                        <?php }elseif($course[0]['paid_status']==1){ ?>

                                <h5>Regular promotion appearance</h5>
                                <img src="<?php echo ASSETS_URL.'images/regular-promotion.png';?>" alt="">
                        <?php }else{ echo '<span class="btn btn-danger">Pending</span>'; } ?>
                    </div>

                    <div id="course-publish" class="tab-pane fade">
                        <h3 class="border-title text-left">Publish Status</h3>
                        <?php if($course[0]['status'] == 3){ 
                                echo'<span class="btn btn-info">Save Only</span>';
                              }elseif($course[0]['status'] == 1){ 
                                echo'<span class="btn btn-success">Published</span>';
                              }else{ 
                                echo '<span class="btn btn-danger">Pending</span>'; 
                              } ?>
                    </div>
                        

	        </div>
		 </div>
	</div>
</div>

  
<div id="myModalcertificate" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Certificate</h4>
            </div>
            <div class="modal-body">
                <div id="filteredData22"></div>
            </div>
        </div>
    </div>
</div>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">lesson Content </h4>
        </div>
        <div class="modal-body" id="cont-bd">
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">lesson Video </h4>
        </div>
        <div class="modal-body">
        	<center>
          	<video width="320" height="240" controls  >
		       <source src="" id="video" type="video/mp4">
		       <source src="" id="video" type="video/ogg">
		       Your browser does not support the video tag.
	       	</video>
        </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">

	$(document).ready(function() {
        $('.course-fillter').DataTable();
        
        var cid = "<?php echo $course[0]['id'];?>";
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('pages/getcoursecomment'); ?>",
            data: {cid:cid},
            success: function(result) { 
                $("#coursereview").html(result); 
            }
        });
        
	});

	function preview_certificate(certifiacte_no) {
	    $('#myModalcertificate').modal('show');
	    $.ajax({
	        type: "POST",
	        url: '<?php echo base_url()."users/certificate_download";?>',
	        data: { certifiacte_no: certifiacte_no }
	    }).done(function(result) {
	        $("#filteredData22").html(result);
	    });
	    return false;
	}

	function  showcontaint(cont){
	  $('#myModal').modal('show');
	  $("#cont-bd").html(cont);
	}

	function  showvideo(cont){
	  $('#myModal1').modal('show');
	  $("#video").attr('src',cont);
	}

</script>
