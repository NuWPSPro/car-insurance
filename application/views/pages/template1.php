<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo ASSETS_URL.'images/favicon.png'; ?>" type="image/x-icon">
        <link rel="icon" href="<?php echo ASSETS_URL.'images/favicon.png'; ?>" type="image/x-icon">
        <title>CEONPOINT Event</title>

        <link href="<?php echo base_url('assets/css/templates/template1.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/templates/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/templates/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/templates/lightbox.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/templates/owl.carousel.css'); ?>" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Exo:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="<?php echo $og_title; ?>" /> 
        <meta property="og:site_name" content="CEONPOINT"/>
        <meta property="og:description" content="<?php echo (!empty($og_description))?$og_description:'';?>"/>
        <meta property="og:url" content="<?php echo $og_url;?>" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="<?php echo $og_image; ?>" />
        <meta property="og:image:secure_url" content="<?php echo $og_image; ?>" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="400" />
        <meta property="og:image:height" content="300" />
       	<style>
    	.img-box { width: 100%; text-align: center; }
    	.img-box img { width: 100%; }
    	.img-box a .caption { padding: 9px; color: #333; }
    	.user-register { padding: 20px 0 5px 0; padding: 20px 0 5px 0; width: 232px;  float: center; margin-left: 39%; height: 62px; }
        .socials-icons{ position:fixed; top:30%; left:0; z-index: 99999;}
        .socials-icons a { font-size: 25px; color: #fff; background:#4565a2; display: block; padding: 15px; width: 100%; text-align: center; text-decoration: none; }
        .socials-icons .socials-link2{ background:#60b4f0; }
        .socials-icons .socials-link3{ background:#bb1217; }
        .socials-icons .socials-link4{ background:#e15641; }
        .socials-icons .socials-link5{ background:#d3262c; }
        .socials-icons .socials-link6{ background:#0a80bd; }
        .evaluate_now{ width:80%; }
        .carousel-after { position: relative; }
        .carousel-after::after { content: ''; position: absolute; display: block; background: rgba(0, 0, 0, 0.35); width: 100%; height: 100%; top: 0; left: 0; }
        @media (max-width:767px){ 
        .socials-icons a { font-size:20px; display: inline-block; padding: 15px; width: 72.6px;     margin: -2px; }
        .socials-icons { top: 93%; width: 100%; }
        }
        .tra.active a { background-color: rgb(188 138 220) !important; }
        .thumbnail.selected-ppt { background-color: rgb(188 138 220) !important; }
        .socials-icons a .a2a_s_facebook {background: transparent !important;display: block;margin: 8px 10px;}
        </style>
    </head>
  <body class="template1">

    <div class="navbar-wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logo-whitesmall.png'); ?>"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#myCarousel">      Home        </a></li>
                        <li><a href="#venue">           Venue       </a></li>
                        <li><a href="#speaking">        Speakers    </a></li>
                        <li><a href="#eventum-schedule">Schedule    </a></li>
                        <li><a href="#event-sponsor">   Sponsors    </a></li>
                        <li><a href="#gen-information"> Information </a></li>
                        <li><a href="#course-reg">      Committee   </a></li>
                        <li class="menu-button">
                            <!-- <a href="javascript:void(0);" onclick="openpopup('<?php echo $training[0]['total']; ?>');" class="btn btn-info">Register</a> -->
                            <?php if($back_webpage):?>
                                <a href="<?php echo base_url('web/').$back_webpage; ?>" class="btn btn-info">Back to webpage</a>
                                <?php else: ?>
                                <a href="<?php echo base_url('share/viewprofile/').$ttprovider_id; ?>" class="btn btn-info">Back to webpage</a>
                                <?php endif; ?>
                        </li>
					</ul>
                </div>
            </div>
        </nav>
    </div>
    <?php

        date_default_timezone_set('US/Eastern');
        // echo date_default_timezone_get();
        $stime = $training[0]['start_time'];
        list($hrs,$mins,$secs,$msecs) = explode(':',$stime);
        $start_time = "$hrs:$mins:$secs\n";

        $etime = $training[0]['end_time'];
        list($hrs,$mins,$secs,$msecs) = explode(':',$etime);
        $end_time = "$hrs:$mins:$secs\n";

    ?>
 <?php  $start_date = date($training[0]['start_date']);
    	$new_date = date('d F Y', strtotime($start_date));

    	$end_date = date($training[0]['end_date']);
    	$end_date = date('d F Y', strtotime($end_date));
    	
        $day  = date('d', strtotime($end_date));
    	$mon  = date('M', strtotime($end_date));
    	$year = date('Y', strtotime($end_date));

        if($training[0]['end_date']<date('Y-m-d')){
            $mon  = 00;
            $day  = 00;
            $year = 00;
        } 

    	$dts = $mon.',' .$day.',' .$year;
    	// echo $dts; 
    $name = $this->session->userdata('logged_in')['name'];
    $email = $this->session->userdata('logged_in')['username'];
    $user_id  =  $this->session->userdata('logged_in')['id']; 
    $institutionRow = $this->db->get_where('tbl_user',array('id'=>$user_id))->row_array(); 
    // print_r($institutionRow);
    $tid = $this->uri->segment(3); 
    $taxAmount = number_format(floatval(($training[0]['price']*$training[0]['tax'])/100),2);
    
    $training_speakers  = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$tid);
                      
    ?>
<header id="myCarousel" class="carousel slide">
        <div class="container">
            <div class="countdown-text-wrap">
                <div id="countdown"></div>
                <h2 class="sppb-addon-title countdown-timer-title">"<?php echo $training[0]['title']; ?>"</h2>
                <h3 class="countdown-timer-subtitle" style="font-size: 40px;"><?php echo $training[0]['sub_title']; ?></h3>
               <?php if ($new_date == $end_date){
				   $date = $new_date;
			   }
			   else{
				   $date = $new_date.' - '.$end_date;
			   }?>
                <h3 class="countdown-timer-subtitle">
                    <?php echo $date; ?>, <br>
                    <?php echo date('g:i A',strtotime($start_time)).' - '.date('g:i A',strtotime($end_time)); ?>, EST
                    <br><br><?php echo $training[0]['location']; ?>
                    <br><br><?php echo $training[0]['units']; ?> Contact Hours
                </h3>
            <?php if($training[0]['video']){ ?>
                <div class="tem-play-icon">
                    <a href="#" data-toggle="modal" data-target="#videoModalPromo"><i title="Click here to play video" style="font-size: 30px;" class="fa fa-youtube-play btn btn-danger"  aria-hidden="true"></i></a>
                </div>
            <?php } ?>
                <div class="menu-button tem-2-register-btn">
                    <a href="javascript:void(0);" onclick="openpopup('<?php echo $training[0]['total']; ?>');" class="btn btn-info">Register Now</a>
                    <a href="javascript:void(0);" class="btn btn-info" onclick="evaluatenow_details();" style="background-color: #3d66b0;padding: 8px 20px 8px 20px;" >Evaluation</a>
                </div>
            </div>
        </div>

        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <!--<li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li> -->
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="carousel-item carousel-after" style="background-image:url(<?php echo base_url('assets/images/uploads/').$training[0]['image']; ?>);"></div>
            </div>
           <!--  <div class="item">
                <div class="carousel-item " style="background-image:url(<?php //echo base_url('assets/images/templates/home2-countdown-bg.jpg'); ?>);"></div>
            </div>
            <div class="item">
                <div class="carousel-item " style="background-image:url(<?php //echo base_url('assets/images/templates/home2-countdown-bg.jpg'); ?>);"></div>
            </div> -->
        </div>
    </header>

    <section id="business-conference" class="business-conference">
        <div class="container">
            <div class="row">
				<div class="col-md-4 text-center">
					<div class="businesslogo business_logo">
						<!-- <img class="" src="<?php echo base_url(); ?>/assets/images/templates/eventum-home-logo.jpg" alt="" title=""> -->
                        <!--  style="height: 250px; width: 350px; border-radius: 50%"-->
                        <img class="" src="<?php echo base_url('assets/images/uploads/').$training[0]['attach_logo']; ?>" alt="businesslogo" title="logo">
					</div>
				</div>

                <div class="col-md-8 text-left">
					<h3 class="sppb-addon-title"><?php echo ucwords($training[0]['host']); ?>
                    <a href="<?php echo BASE_URL.'share/viewprofile/'.$training[0]['user_id']; ?>" class="btn btn-info pull-right" style="background: #ffa500;">View Host Page</a>               
                    </h3>
					<div class="addon-content" style="height: 400px; overflow: auto;">
                    <?php if($this->uri->segment(3)==34){ ?><img src="<?php echo ASSETS_URL.'images/CarribeanNursesOrganization.png';?>" alt="Carribean Nurses Organization"><?php } ?>
						<p><?php echo $training[0]['about_host']; ?></p>
					</div>
                    
                    <div class="addon-content">
                        <a href="javascript:void(0);" class="btn" onclick="openpopup('<?php echo $training[0]['total']; ?>');" >Register</a>
                        <a href="javascript:void(0);" class="btn btn-info" onclick="evaluatenow_details();" style="background-color: #3d66b0;" >Evaluation</a>
                    </div>
				</div>
            </div>
        </div>
    </section>

    <section id="venue" class="eventum">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="eventum-schedule">
                        <div class="section-title text-center">
                            <h2 class="title-heading">Venue</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 zoom_link">
                                <h3><?php echo ucwords($training[0]['location']); ?></h3>
                                <?php if($training[0]['add_link']){ ?>
                                    Virtual Classroom Link: <a href="<?php echo $training[0]['add_link']; ?>" target="_blank"><?php echo $training[0]['add_link']; ?></a>
                                <?php } ?>
                                <?php if($training[0]['venu_address']){ ?>
                                    <p class="zoom-link">Venue Address: <?php echo $training[0]['venu_address']; ?></p>
                                <?php } ?>
                                <div class="eventum-venue zoom_img">
                                    <img src="<?php echo base_url('assets/images/uploads/').$training[0]['venue_photo']; ?>" width="500">
                                </div>
                            </div>
                                    
                            <div class="col-md-6">
                            <h3>The Map</h3>
                            <div class="map_iframe">
                                <!-- <iframe width="600" height="500" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15505673.80395667!2d-81.33180237677018!3d18.41264352244224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8eb9e309d5a038b7%3A0xc67ecf32cac5dbdc!2sCaribbean!5e0!3m2!1sen!2sin!4v1619705010210!5m2!1sen!2sin" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe> -->
                                <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=&t=&z=1&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>


    <?php if($training[0]['background_image']==""){ 
                $url = base_url('assets/images/templates/home-speaker-bg.jpg');
            }else{ 
                $url = base_url('assets/images/uploads/').$training[0]['background_image'];
            } ?>

    <section id="speaking" class="speaking" style="background-image: url(<?php echo $url; ?>);" >

        <div class="container">
            <div class="section-title text-center">
                <h3 class="title-heading">Who's Speaking?</h3>
            </div>
            
            <div class="row">
                <?php  $sdata1 = $speaker;
                    $spcount = count($speaker);
				foreach($speaker as $key => $value) { 
                    if($spcount == 1){ $spclass = 'col-md-12'; }else{ $spclass = 'col-md-3'; } ?>
                <div class="<?=$spclass;?> col-xs-6">
                    <div class="speaker">
                        <div class="speaker-image">
                            <div class="speaker-image-wrapper">
                            	<?php if($value['speaker_image'] !=""){ ?>
                                <img onclick="speaker_details('<?php echo $value['id']; ?>')" src="<?php echo base_url('assets/images/uploads/').$value['speaker_image']; ?>"><?php } ?>
                            </div>
                        </div>
                        <h4 class="speaker-title"><a href="javascript:void(0);" onclick="speaker_details('<?php echo $value['id']; ?>')"><?php echo $value['speaker_name']; ?></a>
                            </h4>
                        <p class="speaker-designation text-center"><?php echo $value['position']; ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

    </section>
	
	<!-- <section class="eventum" style="background-image: url(https://ceonpoint.com//assets/images/templates/color-bg-left-bottom.png), url(images/color-bg-right-bottom.png), url(https://ceonpoint.com//assets/images/templates/color-bg-right-top.png);"> -->
	
    <section class="eventum" id="eventum-schedule">
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <div class="eventum-schedule">
                    <div class="section-title text-center">
                        <h3 class="title-heading">Event Schedule</h3>
                    </div>
				<?php $this->db->group_by("schedule_date");
				$trainings = $this->user->get_record_by_field_name_all_record('tbl_training_schedule','training_id',$tid);
				$alldates = array_unique(array_column($trainings, 'schedule_date'));
				$count = count($alldates);

				for($i=0;$i<$count;$i++){ 
				$day = $i+1;
				$schedule = $this->user->get_record_by_field_name_all_record('tbl_training_schedule',array('training_id'=>$tid,'schedule_date'=>$alldates[$i]),''); 
				?>
				<h4 class="border-title text-left">Schedule day <?php echo $day.'('.date('F d, Y',strtotime($alldates[$i])).')'; ?></h4>
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><p>#</p></th>
                            <th><p>Session</p></th>
                            <th><p>Speaker(s)</p></th>
                            <th width="160"><p>Time</p></th> 
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php $counte = 1; 
                    foreach ($schedule as $key => $value) {
                          $speaker = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','id',$value['speaker_id']); ?>
                        <tr>
                            <td scope="row"><p><?php echo $counte; ?></p></td>
                            <td><p><?php echo $value['topic']; ?></p></td>
                            <!-- <td><?php echo $speaker_name; ?></td> -->
                            <td><p><?php
                                if($speaker[0]['speaker_name']=="" || $value[0]['speaker_id']){
                                echo $value['speaker_name']; 
                                }  else {
                                echo $speaker[0]['speaker_name']; 
                                } ?> </p>
                            </td>
                            <td><p><?php echo date('g:iA',strtotime($value['schedule_start_time'])).' - '.date('g:iA',strtotime($value['schedule_end_time'])); ?></p></td>
                        </tr>
                        <?php $counte++; } ?>          
                    </tbody>
                </table>
                </div>
                <?php } ?>
                </div>
            </div>
		</div>
	</div>
	</section>
	
	
    <section id="event-sponsor" class="event-sponsor" style="background-image: url(<?php echo base_url('assets/images/templates/home-sponsors-bg.jpg'); ?>);">
        <div class="container">
            <div class="row">
                <div class="section-title text-center">
                    <h2 class="title-heading">Our Event Sponsors</h2>
                    <p class="title-subheading">Check Who Makes This Event Possible!</p>
                </div>
                

                <div class="addon-content">
                   <!--  <h3 class="addon-title">Platinum Sponsors</h3> -->
                    <div class="bannergroup">
                        <div class="row">
						<?php foreach ($sponsors as $key => $value){
                             // if (strpos($value['urls'],'http://') === false){
                                 // $value['urls'] = 'http://'.$value['urls']; } ?>

                            <div class="col-sm-3 col-xs-6">
                                <div class="banneritem" style="padding: 10px 0 10px 0;">
                                    <a target="_blank" href="<?php echo $value['urls']; ?>"><img src="<?php echo base_url('assets/images/uploads/').$value['sponsors_image']; ?>" alt="sponsors-img"></a>
                                </div>
                            </div>
                        <?php } ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="gen-information" class="gen-information">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="<?php if($_REQUEST['lesson']==""){ echo 'active' ; } ?>" ><a data-toggle="tab" href="#general">General Information</a></li>
                        <li><a data-toggle="tab" href="#traning">Training Overview</a></li>
                         <li class="<?php if($_REQUEST['lesson']==1){ echo 'active'; } ?>" ><a data-toggle="tab" href="#lesson">Lesson</a></li>
                    <!-- <li><a data-toggle="tab" href="#lesson">Lesson</a></li>
                         <li><a data-toggle="tab" href="#exam">Exam</a></li> -->
                    </ul>

                    <div class="tab-content">
                        <div id="general" class="tab-pane fade in <?php if($_REQUEST['lesson']==""){ echo "active"; } ?>">
                            <h3>General Information</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    
                                    <tbody>
                                        <tr>
                                            <th><p>Title:</p></th>
                                            <td><p><?php echo $training[0]['title']; ?></p></td>
                                        </tr>
                                        <tr>
                                            <th><p>Sub-title:</p></th>
                                            <td><p><?php echo $training[0]['sub_title']; ?></p></td>
                                        </tr>
                                        <tr>
                                            <th><p>CE Units:</p></th>
                                            <td><p><?php echo $training[0]['units']; if($training[0]['units']==0){ echo " CNE Units will be awarded on the symposium";} ?></p></td>
                                        </tr>
                                        <tr>
                                            <th><p>Date:</p></th>
                                            <td><p><?php echo $date; ?></p></td>
                                        </tr>
                                        <tr>
                                            <th><p>Time:</p></th>
                                            <td><p><?php echo date('g:iA',strtotime($training[0]['start_time'])); ?> - <?php echo date('g:iA',strtotime($training[0]['end_time'])); ?></p></td>
                                        </tr> 
                                        <tr>
                                            <th><p>Venue:</p></th>
                                            <td><p><?php echo $training[0]['location']; ?></p></td>
                                        </tr> 
                                        <tr>
                                            <th><p>Who can attend this training?</p></th>
                                            <td><p><?php echo $training[0]['participants']; ?></p></td>
                                        </tr> 
                                        <tr>
                                            <th><p>Registration Fee:</p></th>
                                            <td><p>$<?php echo $training[0]['total']; ?></p></td>
                                        </tr> 
                                        <tr>
                                            <th><p>Contact Person:</p></th>
                                            <td><p><?php echo $training[0]['contact_person']; ?></p></td>
                                        </tr> 

                                        <tr>
                                            <th><p>Email:</p></th>
                                            <td><p><?php echo $training[0]['email']; ?></p></td>
                                        </tr> 

                                        <tr>
                                            <th><p>Phone:</p></th>
                                            <td><p><?php echo $training[0]['phone']; ?></p></td>
                                        </tr> 
                                        <tr>
                                            <th><p>Name of (Training committee chairman):</p></th>
                                            <td><p><?php echo $training[0]['chairman']; ?></p></td>
                                        </tr> 
                                        <tr>
                                            <th><p>Position:</p></th>
                                            <td><p><?php echo $training[0]['position']; ?></p></td>
                                        </tr> 
                                    </tbody>

                                    
                                </table>
                            </div>
                            <!-- <h3 class="location">Location Information</h3>
                            <div class="map">
                                <img src="<?php echo base_url(); ?>/assets/images/templates/map.jpg">
                            </div> -->
                        </div>
                        <div id="traning" class="tab-pane fade">
                            <h3>Training Overview</h3>
                            <div class="table-responsive">
                            	 <table class="table table-bordered">
                                   <tbody>
                                        <tr>
                                            <th><p>Traning Overview:</p></th>
                                            <td><p><?php echo $training[0]['description']; ?></p></td>
                                        </tr> 
                                        <tr>
                                            <th><p>Traning Objectives:</p></th>
                                            <td><p><?php echo $training[0]['objectives']; ?>  </p></td>
                                        </tr>
                                        <tr>
                                            <th><p>Methodologies:</p></th>
                                            <td><p><?php echo $training[0]['methodologies']; ?>  </p></td>
                                        </tr>
                                        <tr>
                                            <th><p>Item/s to bring:</p></th>
                                            <td><p><?php echo $training[0]['item_to_bring']; ?></p></td>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                        </div>

        <div id="lesson" class="tab-pane fade <?php if($_REQUEST['lesson']=="1"){ echo "in active"; } ?>">
            <h3>Lesson</h3>
            <div class="container">
		        <div class="row">
                <?php $tdata22 = $this->user->get_record_by_field_name_all_record('tbl_training_speaker', 'training_id', $training[0]['id']);
                         $tr_idd = $training[0]['id'];
                             foreach ($tdata22 as $key => $value1) {
                             $key = $key + 1;
                                if ($value1['speaker_image'] != "") { ?>
                                <div class="col-md-2 col-xs-6">
                                   <div class="lession-thumnel">
                                   <div class="thumbnail <?php if($_REQUEST['ppt']==$value1['id']){ echo 'selected-ppt'; } ?>" style="height: 86px; width: 96px;">
                                        <a href="javascript:void(0)" onclick="powerpoint('<?php echo $tr_idd; ?>','<?php echo $value1['id']; ?>')">
                                            <img style="width: 75px; height: 75px;" src="<?php echo base_url('/assets/images/uploads/').$value1['speaker_image']; ?>" alt="Lights" style="width:100%">
                                            <div class="caption">
                                                <p><?php echo $value1['speaker_name']; ?></p>
                                            </div>
                                        </a>
                                    </div>
                                   </div>
                                </div>
                            <?php }
                            } ?>
                 </div>
            </div>
            <br><br><br><br><br><br><br>

            <span style="display: none; color: red; text-align: center;" id="loaders">Loading...</span>  
            <div class="bannergroup mt-5" id="powerpoints" style="display: none;"> 
                <div class="row"> 
                    <div id="responsesata"></div> 
                </div>
            </div>
        </div>
                           
                        <div id="exam" class="tab-pane fade">
                            <h3>Exam Information</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><p>Title</p></th>
                                            <th><p>Moradabad Railway</p></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th><p>Unit</p></th>
                                            <th><p>444</p></th>
                                        </tr>
                                        <tr>
                                            <th><p>Date</p></th>
                                            <th><p>2018-09-30 To 2018-11-14</p></th>
                                        </tr>
                                        <tr>
                                            <th><p>Time</p></th>
                                            <th><p>14:01:00</p></th>
                                        </tr>
                                        <tr>
                                            <th><p>Contact Person</p></th>
                                            <th><p>Ravi Singh</p></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="course-reg" class="course-reg" style="background-image: url(<?php echo base_url('assets/images/templates/home2-countdown-bg.jpg'); ?>);">
        <div class="overlaybg">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="section-title text-left">
                            <p class="title-subheading">Your feedback are valuable to us</p>
                            <h2 class="title-heading">To IMPROVE more our TRAINING!</h2>
                            <p class="title-subheading">Thank you!</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="addon-content">
                            <!-- <a href="#" class="btn">Evaluate Now</a> -->
                             <a href="javascript:void(0);" onclick="evaluatenow_details()" class="btn">Evaluate Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="committee" class="committee">
        <div class="container">
            <div class="row">
                <div class="section-title text-center">
                    <h2 class="title-heading">The committee</h2>
                </div>
                <div class="MultiCarousel" data-items="1,3,5,7" data-slide="1" id="MultiCarousel"  data-interval="1000">
                    <div class="MultiCarousel-inner">
					                        
					<?php foreach ($committee as $key => $value) { ?>
                        <div class="item">
                            <div class="speaker">
                                <div class="speaker-image">
                                    <div class="speaker-image-wrapper">
                                        <img src="<?php echo base_url(); ?>/assets/images/uploads/<?php echo $value['committee_image']; ?>" alt="Rickey D. Ng">
                                    </div>
                                </div>
                                <h4 class="speaker-title"><a href="#"><?php echo $value['committee_name']; ?></a></h4>
                                <p class="speaker-designation text-center"><?php echo $value['degination']; ?></p>
                            </div>
                        </div>
                    <?php }	?>  
                                    
                    </div>
                    <button class="btn btn-primary leftLst"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                    <button class="btn btn-primary rightLst"><i class="fa fa-arrow-right" aria-hidden="true"></i></button> 
                </div>
            </div>
        </div>
    </section>
 
   <footer id="footer" class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="column ">
                        <img class="footer-logo" src="<?php echo base_url('assets/images/logo-whitesmall.png'); ?>" alt="footer-logo">
                    </div>
                    <ul class="social-icons">
                        <li>
                            <a target="_blank" href="<?php echo site_url('pages/courses');?>"><img src="<?php echo ASSETS_URL.'images/online.jpg'; ?>" style="height: 60px; border-radius: 50%;">
                            <span>Online Cource</span></a>
                        </li>
                        
                        <li>
                            <a target="_blank" href="<?php echo site_url('pages/training');?>"><img src="<?php echo ASSETS_URL.'images/traning.jpg'; ?>" style="height: 60px; border-radius: 50%;">
                            <span>Training Seminar</span></a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" onclick="checklogin();"><img src="<?php echo ASSETS_URL.'images/certificates.jpg'; ?>" style="height: 60px; border-radius: 50%;">
                            <span>Upload Certificate</span></a>
                        </li>
                            
                        <li>
                            <a target="_blank" href="<?php echo site_url('pages/Institutionspage');?>"><img src="<?php echo ASSETS_URL.'images/institute.jpg'; ?>" style="height: 60px; border-radius: 50%;">
                            <span>Institution CE Webpage</span></a>
                        </li>

                        <div class="social-list-header user-register">
                            <?php if($this->session->userdata('logged_in')==FALSE){ ?>
                            <a style="margin-top: -5px;" href="<?php echo site_url('users'); ?>" class="btn btn-info"><i class="fa fa-user"></i> Login</a><?php } ?>
                            <a style="margin-top: -5px;" href="<?php echo site_url('users'); ?>?register=1" class="btn btn-warning"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign Up</a>
                        </div>
                    </ul>
                        
                    
                    <ul class="social-icons original-rsult">
                        <li><?php echo count($tcourse); ?> <span>Online Course</span></li>
                        <li><?php echo count($ttraining); ?> <span>Training / Seminars</span></li>
                        <li><?php echo count($tprofessional); ?> <span>Professionals</span></li>
                        <li><?php echo count($tprovider); ?><span>CE Providers</span></li>
                        <li><?php echo count($tInstitutions); ?><span>Institutions</span></li>
                        <li><?php echo count($tTotalAuthor); ?><span>Author</span></li>
                        <!-- <li><?php echo count($tTotalTraining) + count($tTotalCource); ?><span>Countries</span></li> -->
                        <li><?php echo count($tCountry); ?><span>Countries</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    
<?php   $tidd = $this->uri->segment(3);
        $url  = "http://ceonpoint.com/pages/training_details/".$tidd; 
        $facebookUrl   = "http://www.facebook.com/sharer.php?u=".$url;
        $twitterUrl    = "http://twitter.com/share?url=".$url;
        $pinterestUrl  = "http://pinterest.com/pin/create/button/?url=".$url;
        $googlePlusUrl = "https://plus.google.com/share?url=".$url;
        $linkedInUrl   = "http://www.linkedin.com/shareArticle?mini=true&url=".$url;
?>


    <div class="socials-icons">
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
        <a target="_blank" href="#" class="socials-link a2a_button_facebook"></a>
            <!-- <a target="_blank" class="a2a_button_facebook"></a> -->
            <script async src="https://static.addtoany.com/menu/page.js"></script>
        </div>
        <!-- <a target="_blank" href="<?php echo $facebookUrl; ?>" class="fa fa-facebook socials-link"></a> -->
        <a target="_blank" href="<?php echo $twitterUrl; ?>" class="fa fa-twitter socials-link2"></a>
        <!-- <a href="#" class="fa fa-youtube socials-link3"></a> -->
        <!-- <a target="_blank" href="<?php echo $googlePlusUrl; ?>" class="fa fa-google-plus socials-link4"></a> -->
        <a target="_blank" href="<?php echo $pinterestUrl; ?>" class="fa fa-pinterest socials-link5"></a>
        <a target="_blank" href="<?php echo $linkedInUrl; ?>" class="fa fa-linkedin socials-link6"></a>
    </div>


    <div id="training_registration" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594; color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Book A Seminar Or Training</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo BASE_URL.'pages/bookseminar'; ?>" method="post" enctype="multipart/form-data" name="bookseminar" id="bookseminar">
                        <span id="traerror"></span>
                        <input type="hidden" name="seminar_id" value="<?php echo $tid; ?>">
                        <input type="hidden" name="ttype" value="<?php echo $training[0]['training_type']; ?>">
                        <input type="hidden" name="payment_mode" id="trainig_type">
                        <input type="hidden" name="uid" value="<?php echo $user_id ; ?>">
                        <input type="hidden" name="tax" id="tax" value="<?php echo $taxAmount; ?>">
                        <input type="hidden" name="price" id="price" value="<?php echo $seminar[0]['total']; ?>">
                        <div class="form-group">
                            <label for="email">Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Please put your complete name for Digital Certificate" value="<?=$name?>" readonly >
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span style="color: red;">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="mymail@ceonpoint.com" value="<?=$email?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="0123456789" value="">
                        </div>

                        <div class="form-group">
                        <label for="email">Profession <span style="color: red;">*</span></label>
                            <div class="selection-box">
                                <select name="profession_id" class="form-control" id="profession_id">
                                    <option value="" selected="">Choose Profession</option>
                                    <?php
                                    $profession = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category', 'status', 1);
                                    foreach ($profession as $key => $value) { 
                                        if ($institutionRow['profession'] == $value['cat_name']){ 
                                            $selected = 'Selected'; }else{ $selected = ''; } ?>
                                        <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?> > <?php echo $value['cat_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="email">Country <span style="color: red;">*</span></label>
                            <div class="selection-box">
                                <select name="country" class="form-control" id="country">
                                    <option value="" selected="">Choose country</option>
                                    <?php $this->db->order_by('countries_name','ASC');
                                    $usercountry = $this->user->get_record_by_field_name_all_record('countries','status',1);
                                     foreach ($usercountry as $key => $value) { 
                                        if ($institutionRow['profession'] == $value['countries_id']){ 
                                            $selected = 'Selected'; }else{ $selected = ''; } ?>
                                        <option value="<?php echo $value['countries_id']; ?>" <?php echo $selected; ?> > <?php echo $value['countries_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                         <?php if($categorylist){ 
                                foreach($categorylist as $key => $value){ ?>
                            <div class="form-group">
                            <label for="<?php echo $value['category_name']; ?>"><?php echo $value['category_name']; ?> 
                            <span style="color: red;"><?php if($value['mandatory']=='1'){ echo'*'; } ?></span></label>
                            <?php if($value['type']=='o'){ ?>
                                <div class="selection-box">
                                    <select name="other[<?php echo $value['id']; ?>]" class="form-control" id="<?php echo $value['id']; ?>" <?php if($value['mandatory']=='1'){ echo 'required'; } ?>>
                                        <option value="" selected="">Choose an option</option>
                                        <?php $option = $this->db->get_where('tbl_registration_option',array('category_id'=>$value['id'],'status'=>'1'))->result_array();
                                        foreach ($option as $op){ ?>
                                        <option value="<?=$op['option_name']; ?>"><?=$op['option_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php }else{ ?>
                                <input type="text" class="form-control" id="other[<?php echo $value['id']; ?>]" name="other[<?php echo $value['id']; ?>]" placeholder="Please enter text here..." value="">
                                
                            <?php } ?>
                            </div>                            
                        <?php  }
                            } ?>

                        
                        <div class="form-group" id="amountfield" style="display: none;">
                            <label for="email"> Registration Fee</label>
                            <input type="number" class="form-control" readonly name="price" value="<?php echo $seminar[0]['total'];?>">
                        </div>
                        <?php if($seminar[0]['total'] > 0){ ?>
                        <button type="button" class="btn btn-info" id="savebutton" onclick="payoption('<?php echo $seminar[0]['total'];?>')" >Register now</button>
                    <?php }else{ ?>
                        <button type="submit" class="btn btn-info" id="savebutton" >Register now</button>
                    <?php } ?>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================================================== -->
        <form action="<?php echo PAYAPAL_URL; ?>" method="post" name="bookTraining" id="bookTraining">
            <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="item_name" id="item_name" value="<?php echo $training[0]['title'].' - Training Booked'; ?>">
            <input type="hidden" name="item_number" value="<?php echo $tid; ?>">
            <input type="hidden" name="credits" value="510">
            <input type="hidden" name="userid" value="<?php echo $user_id; ?>">
            <input type="hidden" name="custom" id="custom" value=""> <!-- uid + tax -->
            <input type="hidden" name="amount" id="amount" value="<?php echo $training[0]['total']; ?>">
            <input type='hidden' name='rm' value='2'>
            <input type="hidden" name="no_shipping" value="1">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="handling" value="0">
            <!-- <input type="hidden" name="bn" id="nameEmailPros" value=""> -->
            <input type="hidden" name="cancel_return" value="<?php echo site_url('pages/cancel_training_book/').$tid; ?>">
            <input type="hidden" name="return" value="<?php echo site_url('pages/success_training_book'); ?>">
        </form>
    <!-- ===================================================== -->

    <div id="payby" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm modal-centered">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594; color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Choose Payment Option</h4>
                </div>
                <div class="modal-body"> 
                    <a href="javascript:void(0)" onclick="paybypaypal('<?php echo $seminar[0]['total']; ?>');" class="btn btn-primary"> PayPal</a>
                    <!-- <?php $details = array('id'=>$tidd,'name'=>$training[0]['title'],'price'=>$training[0]['total'],'tax'=>$taxAmount,'type'=>'training');?> -->
                    <a href="javascript:void(0)" onclick="paybystrip('<?php echo $seminar[0]['total']; ?>');" class="btn btn-info"> Stripe</a>
                    <!-- <a href="<?php echo base_url('stripe/index').'?id='.$tidd.'&&name='.$training[0]['title'].'-Training Booked&&price='.$training[0]['total'].'&&tax='.$taxAmount.'&&type=training';?>" class="btn btn-primary">Card</a> -->
                    <a href="javascript:void(0)" onclick="paybypayu('<?php echo $seminar[0]['total']; ?>');" class="btn btn-warning">PayU Money</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================================================== -->
    <div id="succespopup" class="modal fade thank-modal-pop-up" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header thank-logo text-center">
                    <img src="<?php echo ASSETS_URL . 'images/popup-logo.png'; ?>" alt="logo">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h2 class="modal-title">Thank you for your review</h2> -->
                    
                </div>
                <div class="modal-body thank-modal text-center">
                    <img src="<?php echo ASSETS_URL . 'images/thank.jpg'; ?>" alt="Thnaks">
                    <p>for your time to do the evaluation.</p>
                    <p>Your responses will be kept with utmost confidentiality.</p>
                    <?php if ($_REQUEST['r'] != '') { ?>
                        <a href="javascript:void(0);" onclick="goBackToEvaluation()" class="btn btn-success">Back to Evaluation</a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <!-- ===================================================== -->
     <div id="thankyou" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header text-center" style="background-color: #315594; color: #fff;">
                    <h5 class="modal-title text-light">Invailad Registration</h5>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group thankumsg">
                        <p><?php echo $this->session->flashdata('response'); ?></p>
                        <div class="text-center">
                            <button type="button" class="btn btn-warning"><a href="<?php echo base_url('professional/dashboard'); ?>">My Account</a></button>
                            <button type="button" class="btn btn-success close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div id="success_registration" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header text-center" style="background-color: #315594; color: #fff;">
                    <h5 class="modal-title text-light">Training Registration</h5>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group thankumsg">
                        <p><?php echo $this->session->flashdata('response'); ?></p>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary">Check Email</button>
                            <a href="<?php echo base_url('professional/dashboard'); ?>" class="btn btn-warning">My Account</a>
                            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================================================== -->
    <div id="speaker_details" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594; color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Speaker Details</h4>
                </div>
                <div class="modal-body">
                    <div id="filteredData2" style="text-align: center;">
                    Loading....
                </div>
                <?php $tidd1 = $this->uri->segment(3); ?>
                <p style="text-align: center;font-size: 16px;font-weight: bold;">
                    <a class="btn btn-primary" id="speaker_presntation" href="">Click here</a> 
                to view the Lessons / Lectures</p>
                <!-- href="<?php echo site_url('/pages/training_details/').$tidd1.'?lesson=1&&ppt=' ?>" -->
                </div>
            </div>
        </div>
    </div>

    <div id="evaluatenow_details" class="modal fade temp-evaluate-now-modal" role="dialog">
        <div class="modal-dialog evaluate_now">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594; color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Evaluate Now</h4>
                </div>
                <div class="modal-body" style="overflow: scroll;">
                    <div class="content"> 
                        <ul class="nav nav-tabs">

                        <?php foreach ($training_speakers as $key => $value1) {

                              $key = $key+1; 
                              if($value1['speaker_image'] !=""){  ?>

                            <!-- type=speaker , SpeakerId = 1 -->
                            <li onclick="speaker_name('<?php echo $value1['speaker_name']; ?>','<?php echo $value1['id']; ?>')" class="tra <?php if($key==1){ echo "active";} ?>">
                                <a data-toggle="tab" href="#menu<?php echo $key; ?>">
                                    <img style="border-radius: 50%;height: 82px; width: 82px;" src="<?php echo base_url('assets/images/uploads/').$value1['speaker_image']; ?>" alt="speaker-image" style="width: 207px; height: 120px;">
                                    <p><?php echo $value1['speaker_name']; ?></p>
                                </a>
                            </li><?php } ?>
                        <?php } ?>
                            <!-- type=SYMPOSISM , SpeakerId = 0 -->
                            <li onclick="speaker_name('SYMPOSIUM',0)" class="tra <?php if($training_speakers == ''){ echo 'active';} ?>">
                                <a data-toggle="tab" href="#menu555"><img src="<?php echo base_url('assets/images/uploads/symposium.png'); ?>" style="border-radius: 50%;height: 82px; width: 82px;" alt="SYMPOSIUM-image">
                                <!-- <p>SYMPOSIUM</p> -->
                                <p>TRAINING</p>
                                </a>
                            </li>    
                        </ul>
                    </div>
           
                    <div id="commentdata" style="padding:0 20px;"></div>
               </div>
            </div>
        </div>
    </div>

    <div id="uploadCertificateModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594; color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Upload Certificate</h4>
                </div>
                <form action="<?php echo BASE_URL;?>professional/existing" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="modal-body"> 

                        <p>
                            <label>Certificate No </label>
                            <input name="certi_no" value="" size="20" type="text" class="form-control">
                            <span class="error"><?php echo  form_error('certi_no'); ?></span>
                        </p>
                        <p>
                            <label>Course Title <span class="required text-danger"> * </span> </label>
                            <input name="course_name" value="" size="20" type="text" class="form-control" required>
                            <span class="error"><?php echo  form_error('course_name'); ?></span>
                        </p>
                        <p>
                            <label>Course Units <span class="required text-danger"> * </span> </label>
                            <input name="course_unit" value="" size="20" type="number" class="form-control" required>
                            <span class="error"><?php echo  form_error('course_unit'); ?></span>
                        </p>

                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <label>Date Issued <span class="required text-danger"> * </span> </label>
                                    <input name="course_start_date" value="" size="20" type="date" class="form-control datepicker" required>
                                    <span class="error"><?php echo  form_error('course_start_date'); ?></span>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <label>Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="" selected>Please Select</option>
                                        <option value="general">General</option>
                                        <option value="specific">Specific</option>
                                    </select>
                                    <span class="error"><?php echo  form_error('category'); ?></span>
                                </p>
                            </div>
                             <div class="col-md-6">
                                <p>
                                    <label>Issued From<span class="required text-danger"> * </span> </label>
                                    <select name="issue_from" id="issue_from" class="form-control" required>
                                        <option value="" selected>Please Select</option>
                                        <option value="Online Course">Online Course</option>
                                        <option value="Training">Training</option>
                                    </select>
                                    <span class="error"><?php echo  form_error('issue_from'); ?></span>
                                </p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <label>Issued By<span class="required text-danger"> * </span> </label>
                                    <input name="issue_by" value=""  type="text" class="form-control" required>

                                    <span class="error"><?php echo  form_error('issue_by'); ?></span>
                                </p>
                            </div>
                             <div class="col-md-6">
                                 <p>
                            <label>Certificate <span class="required text-danger"> * </span> </label>
                            <input name="certificate" value="" size="20" type="file" class="form-control" required>
                            <span class="error"><?php echo  form_error('certificate'); ?></span>
                        </p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="alertpupop" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594; color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Alert</h4>
                </div>
                <div class="modal-body"> 
                    <p>Please log-in or register as a <b> professional </b> to store your certificate in your account</p>
                      
                      <div class="logincheck">
                      <a href="<?php echo BASE_URL?>users" class="btn btn-primary" title="Login">Login</a>
                                          
                      <a href="javascript:void(0);" onclick="register_now()" title="Register Now" class="btn btn-success">Sign Up</a>  
                    </div>
                </div>
                <!-- <div class="modal-footer"></div> -->
            </div>
        </div>
    </div>

 <div class="modal fade login_registration" id="login_registration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #2e6da4; color: #fff;">
        <button type="button" style=" color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
        <h5 class="modal-title" id="loginModalLabel">Please log in or signup to register in this training.</h5>
      </div>
      <div class="modal-body p-5">
        <div class="row">
            <div class="col-sm-5">
                <p>Please log in if you already have an account at ceonpoint.com. </p>
                <a href="<?php echo BASE_URL . 'users/index?location=' . urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-primary" title="Login">Login</a>
            </div>
            <div class="col-sm-7 border-left">
                <p>Please SIGN UP if you DON'T have an account at ceonpoint.com.</p>
                <p><label>What do you get when you signup at ceonpoint.com?</label>
                    <ul class="login_registration_list">
                        <li>Automatic recording of your digital certificates.</li>
                        <li>Unlimited upload and stronge of all your certificates online.</li>
                        <li>Tracking system of your required CE units for license renewal or job performance appraisel.</li>
                        <li>Access to local and international online courses and training.</li>
                        <li>Electronic reporting of digital certificate to regulatroy board (coming soon).</li>
                    </ul>
                </p>
                <a href="javascript:void(0)" onclick="signupOnPage();" title="Register on ceonpoint" class="btn btn-warning">Sign Up</a>
            </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
    <div id="alertForRegistration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594; color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ceonpoint Says:</h4>
                </div>
                <div class="modal-body"> 
                    <p>Please Log in or Sign up as a <b> Professional </b> to register in the training.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo base_url('pages/training_details/'.$tid.'?popup=123'); ?>" title="Register on Training" class="btn btn-primary" >Sign Up</a> 
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>                    
                </div>
            </div>
        </div>
    </div>

    <div id="videoModalPromo" class="modal fade temp-play-modal" tabindex="-1" role="dialog" aria-labelledby="videoModalPromo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #315594; color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Training Introduction Video</h4>
            </div>
            <div class="modal-body">
            	<?php $get_name = end(explode('v=',$training[0]['video']));
            	$url = 'https://www.youtube.com/embed/'.$get_name; ?>
                <iframe width="100%" height="415" src="<?php echo $url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>


      <div id="successModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594; color: #fff;">
                    <h4 class="modal-title text-light">Success Message</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">x</button>
                    
                </div>

                <div class="modal-body">
                    <p id="queryMessage"></p>
                    <div class="row"> 
                        <div class="text-center" id="successContent" style="display: none;">
                        <img src="<?php echo ASSETS_URL . 'images/congratulations.png'; ?>" alt="congratulations">
                        <h5 class="text-success mb-4">
                            You have successfully created your professional account.
                        </h5>
                        <p class="text-dark mb-3">Welcome to ceonpoint.com:<br>
                            "Home of Continuing Education to <br> All Professionals worldwide."</p>
                            <p class="text-dark mb-3"><strong>Please proceed to register for the training.</strong></p>
                            <p class="text-dark mb-3"><a class="btn btn-success" href="javascript:void(0);" onclick="goToNext();">Register</a></p>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer"></div> -->
            </div>
        </div>
    </div>
<div class="modal fade" id="login_registration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #315594; color: #fff;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="loginModalLabel">Please log in or signup to register in this training.</h5>
      </div>
      <div class="modal-body p-5">
        <div class="row">
            <div class="col sm-4">
                <p>Please log in if you already have an account at ceonpoint.com. </p>
                <a href="<?php echo BASE_URL . 'users/index?location=' . urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-primary" title="Login">Login</a>
            </div>
            <div class="vl"></div>
            <div class="col sm-8">
                <p>Please SIGN UP if you DON'T have an account at ceonpoint.com.</p>
                <p><label>What do you get when you signup at ceonpoint.com?</label>
                    <ul>
                        <li>Automatic recording of your digital certificates.</li>
                        <li>Unlimited upload and stronge of all your certificates online.</li>
                        <li>Tracking system of your required CE units for license renewal or job performance appraisel.</li>
                        <li>Access to local and international online courses and training.</li>
                        <li>Electronic reporting of digital certificate to regulatroy board (coming soon).</li>
                    </ul>
                </p>
                <a href="javascript:void(0)" onclick="signupOnPage();" title="Register on ceonpoint" class="btn btn-warning">Sign Up</a>
            </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
    <!-- ===================================================== -->

<div class="modal fade" id="signupByPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="height: 550px;">
      <div class="modal-header" style="background-color: #315594; color: #fff;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Signup as Professional</h5>
      </div>
    <?php echo form_open_multipart('javascript:void(0)', array('name' => 'prof-signup','id' => 'prof-form')); ?>      
    <div class="modal-body">
        <div class="row">
        
            <div class="col-sm-12">
                <h4 class="text-center">PROFESSIONAL REGISTRATION</h4>
                <span class="sign-error text-center w-100 p-3 alert alert-danger" style="display: none;"></span>
                <div class="form-group">
                    <label>Name <span class="required"> * </span></label>
                    <input name="name" id="sign-name" class="form-control" value="" size="20" type="text" required>
                </div>
            </div>
                     
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Profession <span class="required"> * </span> </label>
                    <div class="selection-box">
                        <select name="profession" id="sign-profession" class="form-control" required>
                            <option value="">Select</option>
                            <?php  $profession = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category', 'status', 1);
                                foreach ($profession as $key => $value) { ?>
                            <option value="<?php echo $value['cat_name'];?>">
                                <?php echo $value['cat_name'];?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
                  
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Nationality <span class="required"> * </span> </label>
                    <div class="selection-box">
                        <?php $this->db->order_by('countries_name','ASC');
                        $country = $this->user->get_record_by_field_name_all_record('countries','status',1); ?>
                    <select name="country_name" id="sign-country-name" class="form-control" required>
                        <option value="">Select Country</option>
                        <?php  foreach ($country as $key => $value) { ?>
                            <option value="<?php echo $value['countries_id']; ?>"><?php echo $value['countries_name']; ?></option>
                        <?php }  ?>
                    </select>
                    </div>
                </div>
            </div>

            <!-- <div class="col-sm-12">
                <div class="form-group">
                    <label>Name of Professional Regulatory Board/Council  <span class="required"> * </span> </label>
                    <input name="issuing_institution" id="sign-institution" class="form-control" value="" size="20" type="text" required>
                   
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Issuing Country <span class="required"> * </span> </label>
                    <div class="selection-box">
                        <select name="location" id="sign-issuing-country" class="form-control" required>
                            <option value="">Select Country</option>
                            <?php foreach ($country as $key => $value) { ?>
                                 <option value="<?php echo $value['countries_id']; ?>"><?php echo $value['countries_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Issuing State </label>
                    <div class="selection-box">
                         <input type="text" name="state" id="sign-state" class="
                         form-control">
                    </div>
                </div>
            </div> -->

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="exampleInputFile">Upload Photo</label>
                    <input type="file" id="exampleInputFile" class="btn btn-primary" name="photo">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Username (email)<span class="required"> * </span> </label>
                    <input name="username" id="sign-username" class="form-control" value="" size="20" type="text" required>
                </div>
            </div>
                    
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Password <span class="required"> * </span> </label>
                    <input name="password" id="sign-password" class="form-control" value="" size="20" type="password" required>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Confirm Password <span class="required"> * </span> </label>
                    <input name="con_password" id="sign-conf-password" class="form-control" value="" size="20" type="password" required>
                </div>
            </div>
              <div class="col-sm-12">
            <div class="form-group">
                <input required="" name="rememberme" class="mr-2" id="rememberme" value="forever" type="checkbox">&nbsp; By clicking Register, 
                I agree to the <a href="javascript:void(0);" style="color: blue;" onclick="opentandc('professional')">Terms, Privacy Policy and Copyright policy </a>
                <span class="error"></span>
            </div>
            </div>
        </div>
    </div>
      <div class="modal-footer">
        <!-- <button type="button" onclick="get_form_data()" class="btn btn-primary">Register</button> -->
        <button type="button" onclick="validate_data()" class="btn btn-primary">Register</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>

   <div id="tandcModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="height: 650px;overflow: scroll;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594; color: #fff;">
                    <button type="button"  class="close" onclick="closetandcmodal()">x</button>
                    <h4 class="modal-title">Terms and Conditions</h4>
                    <h5 class="text-center" id="tandctitle"></h5>
                </div>
                <div class="modal-body"> 

                    <p id="tandccontent">Please wait..</p>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('assets/js/templates/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/templates/multiCarousel.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/lightbox-plus-jquery.min.js'); ?>"></script>
    <script>
        	$('.MultiCarousel-inner').owlCarousel({
				center: true,
				loop: true,
				margin: 10,
				nav: true,
				dots: false,
				autoplay: true,
				autoplaySpeed: 3000,
				dotsSpeed: 3000,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				responsive: {

					0: {
						items: 2
					},
					580: {
						items: 3
					},
					767: {
						items: 4
					},
					992: {
						items: 4
					},
					1000: {
						items: 4
					}
				}
			});
    </script>
    <script>
        var tid = '';
        var spid = '';
        $(document).ready(function(){
            $('body').tooltip({
                selector: '.rating label'
            });
                tid = '<?php echo $training[0]['id'] ?>';
                spid = '<?php echo $_REQUEST['ppt'] ?>';
            var ppt = "<?php if ($_REQUEST['lesson'] > 0 && $_REQUEST['ppt'] > 0) { ?>" + powerpoint(tid,spid) +"<?php } ?>";
            var p = "<?php if($_REQUEST['popup']=='123'){ ?>"+ $('#training_registration').modal('show'); +"<?php } ?>";
            var success = "<?php if($_REQUEST['id']=='success'){ ?>"+ $("#success_registration").modal() +"<?php } ?>";
            var exist   = "<?php if($_REQUEST['id']=='exist'){ ?>"+ $("#thankyou").modal() +"<?php } ?>";
            var r = "<?php if ($_REQUEST['r'] == 1) { ?>" + $("#succespopup").modal() + "<?php } ?>";     
            var lesson = "<?php if ($_REQUEST['lesson'] == 1) { ?>" + 
                $(document).ready(function() {
                    window.scrollTo({
                        top: $('#gen-information').offset().top,
                        left: 0,
                        behavior: 'smooth'
                    })
                }); 
                + "<?php } ?>";
            $(window).scroll(function(){
                if ($(window).scrollTop() >= 250) {
                    $('nav').addClass('fixed-header');
                }
                else {
                    $('nav').removeClass('fixed-header');
                }
            });
             var resgiration_popup = "<?php if ($user_id != '') { ?>"  
            if(localStorage.getItem('popState') != 'shown<?php echo $tid;?>'){ 
                $('#training_registration').modal('show'); 
                localStorage.setItem('popState','shown<?php echo $tid;?>'); 
            } 
                + "<?php } ?>";
        });


        $(document).on('change', '.otherCol', function(){
            var speaker = $(this).val();
            console.log(speaker);
            if(speaker == 0){
                $(this).parent().next().show();
            } else {
                $(this).parent().next().hide();
            }
        });

        // set the date we're counting down to
        var dts = "<?php echo $dts; ?>";
        var target_date = new Date(dts).getTime();
        
        // variables for time units
        var days, hours, minutes, seconds;
        
        // get tag element
        var countdown = document.getElementById('countdown');
        
        // update the tag with id "countdown" every 1 second
        setInterval(function () {
        
            // find the amount of "seconds" between now and target
            var current_date = new Date().getTime();
            var seconds_left = (target_date - current_date) / 1000;
        
            // do some time calculations
            days = parseInt(seconds_left / 86400);
            seconds_left = seconds_left % 86400;
            
            hours = parseInt(seconds_left / 3600);
            seconds_left = seconds_left % 3600;
            
            minutes = parseInt(seconds_left / 60);
            seconds = parseInt(seconds_left % 60);


             if(!days){
                days = 00;
            }

             if(!hours){
                hours = 00;
            }

             if(!minutes){
                minutes = 00;
            }

             if(!seconds){
                seconds = 00;
            }
                        
            // format countdown string + set tag value
            countdown.innerHTML = '<span class="days">' + days +  ' <b>Days</b></span> <span class="hours">' + hours + ' <b>Hours</b></span> <span class="minutes">'
            + minutes + ' <b>Minutes</b></span> <span class="seconds">' + seconds + ' <b>Seconds</b></span>';  
        
        }, 1000);


    function powerpoint(training_id,speaker_id){
        $('#loaders').show();
        $.ajax({
        type: "POST",
        // url: '<?php echo site_url('provider/powerpoint'); ?>',
        url: '<?php echo site_url('share/powerpoint'); ?>',
        data: {training_id:training_id,speaker_id:speaker_id}
        }).done(function( result ) {
        // alert(result);
        // console.log(result);
        if(result)
        {
            $('#powerpoints').show();
            $('#loaders').hide();
            $("#responsesata").html(result);
        } else {
            //document.getElementById('powerimage').src = "https://ceonpoint.com/assets/images/uploads/"+result;
            $('#powerpoints').show();
            $('#loaders').hide();
            $("#responsesata").html('No Data Found!');
        }
        });
            return false;
    }

    function speaker_details(speaker_id){
        $("#speaker_details").modal();

        $.ajax({
        type: "POST",
        url: '<?php echo site_url('pages/speaker_details'); ?>',
        data: {speaker_id:speaker_id}
        }).done(function( result ) {
        // alert(result);
       // console.log(result);
        $("#filteredData2").html( result );
        var url = "<?php echo site_url('/pages/training_details/').$tidd1.'?lesson=1&&ppt=' ?>"+speaker_id;
        $('#speaker_presntation').attr('href',url);
        });
        return false;
    }

    function close_alert_modal(){
        $('#alertForRegistration').modal('hide');
    }

    function evaluatenow_details(){
        
        var emptySpeaker = '<?php if($training_speakers == ''): ?>'+ speaker_name('SYMPOSIUM',0) +'<?php endif ?>';
        $("#evaluatenow_details").modal();
    }

    function icu_model(){
        $("#icu_model").modal();
    }

    function checklogin(){
    <?php if(isset($_SESSION['logged_in']) &&  $_SESSION['logged_in']['role']==1){ ?>   
            $('#uploadCertificateModal').modal('show');
                $('#homepopup').modal('hide');
        <?php }else{ ?>
             $('#alertpupop').modal('show');
             $('#homepopup').modal('hide');
        <?php } ?>
    }
   
    function speaker_name(speaker_name,idd){
        if(speaker_name=="SYMPOSIUM"){
            types = "symposium";
        }else{
            types = "teacher";
        }
        // $.noConflict();
        $('#speaker_name').html(speaker_name);
        $('#commentdata').html('Please wait...');
        var trid = "<?php echo $tr_idd; ?>";
        // alert('types:'+types+'trid:'+trid+'idd:'+idd);
        $.ajax({
        type: "POST",
        url : "<?php echo base_url('pages/commentdata');?>",
        data: { types:types, trid:trid, idd:idd }
        }).done(function( result ) {
           //alert(result);
        $("#commentdata").html( result );
        });
        return false;
    }
    speaker_name('<?php echo $speaker[0]['speaker_name']; ?>','<?php echo $speaker[0]['id'];?>');

       
    
<?php   $is_login =  $this->session->userdata('logged_in');
        $role = $this->session->userdata('logged_in')['role']; ?>
    
    function openpopup(idd) {
        if('<?=$is_login ?>'){
            if('<?=$role ?>'== 1){
            $("#training_registration").modal();
            var ttype = '<?php echo $training[0]['training_type']; ?>';
            var amount = '<?php echo $training[0]['total']; ?>';
                if (idd != 0 && ttype == 1) {
                   $('#amountfield').show();
                   $('#savebutton').html('Register Now!');
                   $('#trainig_type').val('Online');
                   
                   var name = $('#name').val();
                   var email = $('#email').val();
                   var profession_id = $('#profession_id').val();
                   var ueridTax = '<?php echo $user_id.'_'.$taxAmount; ?>';
                   $('#custom').val(name+'_'+email+'_'+profession_id+'_Online_'+ueridTax);
                }else{
                   $('#amountfield').hide();
                   $('#savebutton').html('Register Now!');
                   $('#trainig_type').val('Ofline');
                }
            }else{
                $("#login_registration").modal('show');
            }
        }else{
            $("#login_registration").modal('show');
        }
    }

    function payoption(amount){
        var status = $('#status').val();
        var profession_id = $('#profession_id').val();
        var institution = $('#institution').val();
        var position = $('#position').val();
        var island = $('#island').val();
        if(status==''){
            $('#traerror').html('Please select Membership Status.').css('color','red');
            return false;
        }
        if(profession_id==''){
            $('#traerror').html('Please select Profession.').css('color','red');
            return false;
        }
        if(institution==''){
            $('#traerror').html('Please enter institution name.').css('color','red');
            return false;
        }
        if(position==''){
            $('#traerror').html('Please enter Position (Job Title).').css('color','red');
            return false;
        }
        if(island==''){
            $('#traerror').html('Please enter Island (New Providence).').css('color','red');
            return false;
        }else{
            if(amount > 0){
                $('#training_registration').modal('hide');
                $('#payby').modal('show');
                return true;
            }else{
                $('#bookseminar').submit();
                return true;
            }

        }
    }
    // function paybypaypal(){
    //     $('#booktraining').submit();
    // }

     function paybypaypal(total) {
        var ttype = '<?php echo $training[0]['training_type']; ?>';
        var email = $('#email').val();
        var tid = '<?php echo $tid; ?>';
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('pages/user_exist');?>",
            data: { tid:tid, email:email }
            }).done(function( result ) {
               // alert(result);
            if(result == 0){
                if(total > 0 && ttype == 1){
                    $('#bookTraining').submit(); //Paypal Payment
                }else{
                    $('#bookseminar').submit(); //Free
                }
            }else{
                  alert('Email id is already registered with us.');  
            }
        });
        return false;
    }

    function paybystrip(total) {
        var ttype = '<?php echo $training[0]['training_type']; ?>';
        var email = $('#email').val();
        var tid = '<?php echo $tid; ?>';
        var ttitle = '<?php echo str_replace( array( '\'', '"',',' , ';', '<', '>' ), '', $training[0]['title']);?>';
        var ttotal = '<?php echo $training[0]['total']; ?>';
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('pages/user_exist');?>",
            data: { tid:tid, email:email }
            }).done(function( result ) {
               // alert(result);
            if(result == 0){
                window.location.href ='<?php echo base_url('stripe/index').'?id='.$tidd.'&&name='.$ttitle.'-Training Booked&&price='.$ttotal.'&&tax='.$taxAmount.'&&type=training';?>';
            }else{
                
                alert('Email id is already registered with us.');  
            }
        });
        return false;
    }

    function paybypayu(total) {
        var ttype = '<?php echo $training[0]['training_type']; ?>';
        var email = $('#email').val();
        var tid = '<?php echo $tid; ?>';
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('pages/user_exist');?>",
            data: { tid:tid, email:email }
            }).done(function( result ) {
               // alert(result);
            if(result == 0){
                var uid = "<?= $tidd ?>";
                var ttitle = "<?php echo str_replace( array( '\'', '"',',' , ';', '<', '>' ), '', $training[0]['title']);?>";
                var name = ttitle + '-Training Booked';
                var price = "<?= $training[0]['total'] ?>";
                var tax = "<?= $taxAmount ?>";
                var url = "<?php echo base_url('payu/index')?>";
                var profession = $('#profession_id').val();
                //var country = $('#country').val();
                window.location.href =url+'?id='+uid+'&&name='+name+'&&price='+price+'&&tax='+tax+'&&profession='+profession+'&&type=training';
            }else{
                alert('Email id is already registered with us.');
            }
        });
        return false;
    }

     $('.thumbnail').click(function () {
		if ($(this).hasClass('selected-ppt')) {
			$(this).removeClass('selected-ppt');
		} else {
			$('.thumbnail.selected-ppt').removeClass('selected-ppt');
			$(this).addClass('selected-ppt');
		}
	});

    function goBackToEvaluation(){
        $('#succespopup').modal('hide');
        $('#evaluatenow_details').modal('show');
    }

    function signupOnPage(){
        $("#signupByPopup").modal('show');
        $("#login_registration").modal('hide');
        
    }

        function get_form_data(){
            var frm = $('#prof-form');
            var formData = new FormData(frm[0]);
            formData.append('file', $('input[type=file]')[0].files[0]);
          
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>pages/professional_signup",
                data: formData,
                processData: false,
                contentType: false,
            }).done(function(result) {
                // alert(result);
                if(result!=''){
                    var obj = JSON.parse(result);
                        console.log(obj);
                    if(obj.success==true){
                        $('#successContent').show();
                        $("#signupByPopup").modal('hide');
                    }else{
                        $('#queryMessage').html(obj.message).css('color','red');
                    }   
                    $('#successModal').modal('show');
                }
            });
        }

        function goToNext(){
            sessionStorage.reloadAfterPageLoad = true;
            window.location.reload();
        } 

        $( function () {
            
            sessionStorage.reloadAfterPageLoad = true;
            console.log(sessionStorage.reloadAfterPageLoad);
            if ( sessionStorage.reloadAfterPageLoad ) {
                openpopup('<?php echo $training[0]['total']; ?>');
                sessionStorage.reloadAfterPageLoad = false;
            }
        });
        function validate_data(){
            var name       = $('#sign-name').val();
            var profession  = $('#sign-profession').val();
            var country     = $('#sign-country-name').val();
            var institute   = $('#sign-institution').val();
            var i_country   = $('#sign-issuing-country').val();
            var username    = $('#sign-username').val();
            var password    = $('#sign-password').val();
            var confpassword = $('#sign-conf-password').val();
            var rememberme = $('#rememberme').val();
            
            if(name==''){
              $('.sign-error').css('display','block').html('Name can\'t be blank!');
              return false;
            }else if(profession==''){
              $('.sign-error').css('display','block').html('Profession can\'t be blank!');
              return false;
            }else if(country==''){
              $('.sign-error').css('display','block').html('Country can\'t be blank!');
              return false;
            }else if(institute==''){
              $('.sign-error').css('display','block').html('Institution can\'t be blank!');
              return false;
            }else if(i_country==''){
              $('.sign-error').css('display','block').html('Issuing Country can\'t be blank!');
              return false;
            }else if(username==''){
              $('.sign-error').css('display','block').html('Username can\'t be blank!');
              return false;
            }else if(password==''){
              $('.sign-error').css('display','block').html('Password can\'t be blank!');
              return false;
            }else if(confpassword==''){
              $('.sign-error').css('display','block').html('Confirm Password can\'t be blank!');
              return false;
            }else if(password != confpassword){
              $('.sign-error').css('display','block').html('Confirm Password can\'t be diffrent from password.');
              return false;
            }else if(rememberme==''){
              $('.sign-error').css('display','block').html('Pleae check the checkbox.');
              return false;
            }else{
              get_form_data();
              return true;
            }
        }

        function opentandc(type){
            // alert(type)
              $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>pages/get_termcondition",
                data: { type : type },
                dataType: 'json',
                success: function(response) {
                    $('#signupByPopup').modal('hide');
                    // console.log(response.title);
                    $('#tandctitle').html(response.title);
                    $('#tandccontent').html(response.discription);
                    $('#tandcModal').modal('show');
                  },
            });
        }

        function closetandcmodal(){
            $('#signupByPopup').modal('show');
            $('#tandcModal').modal('hide');
        }
    </script>

</body>
</html>