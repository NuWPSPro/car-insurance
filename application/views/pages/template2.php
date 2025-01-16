<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo ASSETS_URL . 'images/favicon.png'; ?>" type="image/x-icon">
    <title>CEONPOINT Event</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL . 'templates/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_URL . 'templates/css/font-awesome.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_URL . 'templates/css/owl.carousel.css'; ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_URL . 'templates/css/style.css'; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="<?php echo $og_title; ?>" />
    <meta property="og:site_name" content="CEONPOINT" />
    <meta property="og:description" content="<?php echo (!empty($og_description)) ? $og_description : ''; ?>" />
    <meta property="og:url" content="<?php echo $og_url; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?php echo $og_image; ?>" />
    <meta property="og:image:secure_url" content="<?php echo $og_image; ?>" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <style>
        .rating {
            border: none !important;
            float: left !important;
            margin: 0 !important;
            display: flex;
            flex-direction: row-reverse;
        }

        .rating>label {
            color: #fff;
            float: left !important;
            margin: 1px 3px !important;
            background-color: #D8D8D8;
            border-radius: 15px;
            height: 25px !important;
            width: 25px;
            text-align: center;
            line-height: 25px;
        }

        .rating>label:before {
            margin-top: 0 !important;
            padding: 0 !important;
            font-size: 15px !important;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .evaluate_now .nav>li>a {
            position: relative;
            display: block;
            padding: 10px 15px;
        }
    </style>

</head>

<body>
    <header class="header fixed-top">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL . '/images/logo-whitesmall.png'; ?>" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample07">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#myCarousel">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#venue">Venue</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#speaking">Speakers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#eventum-schedule">Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#event-sponsor">Sponsors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#gen-information">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#event-committee">Committee</a>
                        </li>

                    </ul>
                </div>
                <div class="Register-box">
                    <!-- <a class="Register-btn" href="javascript:void(0);" onclick="openpopup('<?php echo $training[0]['total']; ?>');">Register</a> -->
                    <a href="<?php echo base_url('web/').$back_webpage; ?>"class="Register-btn" >Back to webpage</a>
                </div>
            </nav>
        </div>
    </header>

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
    <?php $start_date = date($training[0]['start_date']);
    $new_date = date('d F Y', strtotime($start_date));

    $end_date = date($training[0]['end_date']);
    $end_date = date('d F Y', strtotime($end_date));

    $day  = date('d', strtotime($end_date));
    $mon  = date('M', strtotime($end_date));
    $year = date('Y', strtotime($end_date));

    if ($training[0]['end_date'] < date('Y-m-d')) {
        $mon  = 00;
        $day  = 00;
        $year = 00;
    }

    $dts = $mon . ',' . $day . ',' . $year;
    //echo "Nov, 01, 2020"; 
    $name = $this->session->userdata('logged_in')['name'];
    $email = $this->session->userdata('logged_in')['username'];
    $user_id  =  $this->session->userdata('logged_in')['id'];
    $institutionRow = $this->db->get_where('tbl_user', array('id' => $user_id))->row_array();
    // print_r($institutionRow);
    $tid = $this->uri->segment(3);
    $taxAmount = number_format(floatval(($training[0]['price'] * $training[0]['tax']) / 100), 2); ?>

    <section class="annual-nursespanel" id="myCarousel" style="background: url('<?php echo ASSETS_URL . 'images/uploads/' . $training[0]['image']; ?>') no-repeat;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php if ($new_date == $end_date) {
                    $date = $new_date.'<br/>'.date('g:i A',strtotime($start_time)).' - '.date('g:i A',strtotime($end_time)).', EST';
                } else {
                    $date = $new_date.' - '.$end_date.'<br/>'.date('g:i A',strtotime($start_time)).' - '.date('g:i A',strtotime($end_time)).', EST';
                } ?>
                    <div id="countdown">
                        <ul>
                            <li><span id="days">0<sup>:</sup></span>days</li>
                            <li><span id="hours">0<sup>:</sup></span>Hours</li>
                            <li><span id="minutes">0<sup>:</sup></span>Minutes</li>
                            <li><span id="seconds">0</span>Seconds</li>
                        </ul>
                    </div>

                    <div class="annual-textinfo">
                        <h1><?php echo $training[0]['title']; ?></h1>
                        <h2><?php echo $training[0]['sub_title']; ?><strong><?php echo $training[0]['units']; ?> Credit
                                Units</strong></h2>
                    </div>

                    <div class="register-evaluationbox">
                        <?php if ($training[0]['video']) { ?>
                            <a class="play-btn" href="#" data-toggle="modal" data-target="#videoModalPromo"><img src="<?php echo ASSETS_URL . 'templates/images/play-btn.png'; ?>" alt="" title="Click here to play video"></a>
                        <?php } ?>
                        <a class="order-btn" href="javascript:void(0);" onclick="openpopup('<?php echo $training[0]['total']; ?>');">Register Now</a>
                        <a class="order-btn" href="javascript:void(0);" onclick="evaluatenow_details();">Evaluation</a>
                    </div>

                    <div class="annual-info">
                        <ul>
                            <li>
                                <p>Date & TIme</p><?php echo $date; ?>
                            </li>
                            <li>
                                <?php if ($training[0]['add_link']) { ?>
                                    <p>Virtual Classroom Link:</p> <a href="<?php echo $training[0]['add_link']; ?>" target="_blank"><?php echo $training[0]['add_link']; ?></a>
                                <?php } else { ?>
                                    <p>Zoom Platform</p>
                                <?php } ?>
                            </li>
                            <li>
                                <p>Venue Address</p><?php echo $training[0]['location']; ?>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="speakingslider-panel" id="speaking">
                        <h1>Who's Speaking?</h1>
                        <p>View Our All Speakers and Choose Your One if You Need</p>

                        <div class="speakingslider">
                            <?php $sdata1 = $speaker;
                            foreach ($speaker as $key => $value) { ?>
                                <div class="item">
                                    <div class="speakings-box">
                                        <div class="speakings-imgbox">
                                            <img src="<?php echo base_url('assets/images/uploads/') . $value['speaker_image']; ?>" alt="">
                                            <div class="speakings-namebox">
                                                <?php echo $value['speaker_name']; ?><br>
                                                <?php echo $value['position']; ?>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" onclick="speaker_details('<?php echo $value['id']; ?>')">Profile</a>
                                        <a href="javascript:void(0);" onclick="speaker_details('<?php echo $value['id']; ?>')">Presentation</a>
                                    </div>
                                </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="nurses-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="nurses-box">
                        <div class="nurses-logobox">
                            <img src="<?php echo ASSETS_URL . 'images/uploads/' . $training[0]['attach_logo']; ?>" alt="">
                        </div>
                        <div class="nurses-info">
                            <h2><?php echo ucwords($training[0]['host']); ?></h2>
                            <p><?php echo $training[0]['about_host']; ?></p>
                            <a class="yellow-btn" href="<?php echo BASE_URL . 'share/viewprofile/' . $training[0]['user_id']; ?>">View Host Page</a>
                            <a class="blue-btn" href="javascript:void(0);" onclick="openpopup('<?php echo $training[0]['total']; ?>');">Register</a>
                            <a class="" href="javascript:void(0);" onclick="evaluatenow_details();">Evaluation</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="nurses-imgbox"><img src="<?php echo ASSETS_URL . 'templates/images/nurses-img.png'; ?>" alt=""></div>
                </div>

                <div class="col-md-12" id="event-sponsor">
                    <div class="event-sponsorsbox">
                        <h2>Our Event Sponsors</h2>
                        <p>Check Who Makes This Event Possible!</p>
                        <?php foreach ($sponsors as $key => $value) { ?>
                            <a target="_blank" class="sponsors-logobox" href="<?php echo $value['urls']; ?>" title="<?php echo $value['sponsors_name']; ?>"><img src="<?php echo ASSETS_URL . 'images/uploads/' . $value['sponsors_image']; ?>" alt=""></a>
                        <?php } ?>
                      
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="new-temp-eventum" id="venue">
        <div class="container">
            <div class="venue-heading">
                <h1>VENUE</h1>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="temp-eventum-heading">
                        <h3><?php echo ucwords($training[0]['location']); ?></h3>
                    </div>
                    <?php if($training[0]['add_link']){ ?>
                    <p class="zoom-link">Virtual Classroom Link: <a href="<?php echo $training[0]['add_link']; ?>" target="_blank"><?php echo $training[0]['add_link']; ?></a></p>
                    <?php } ?>
                    <?php if($training[0]['venu_address']){ ?>
                        <p class="zoom-link">Venue Address: <?php echo $training[0]['venu_address']; ?></p>
                    <?php } ?>
                    <div class="new-tem-eventum-img">
                        <img src="<?php echo base_url('assets/images/uploads/').$training[0]['venue_photo']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="temp-eventum-heading">
                        <h3>The Map</h3>
                    </div>

                    <div class="new-temmap_iframe">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7443211.221913146!2d-80.46171889900646!3d24.368064137673187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d69a3bb2480f3d%3A0x133eb4836ac779e5!2sThe%20Bahamas!5e0!3m2!1sen!2sin!4v1600951899083!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

<!--     <section class="nurses-supportpanel">
        <div class="container">
            <ul>
                <li>
                    <p><strong>Anytime,<br>Anywhere</strong> Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy.</p>
                </li>
                <li>
                    <p><strong>24/7<br>Support</strong>Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been
                        the industry's standard dummy.</p>
                </li>
                <li>
                    <p><strong>Anytime,<br>Reservations</strong>Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy.</p>
                </li>
            </ul>
        </div>
    </section> -->

    <section class="events-schedule" id="eventum-schedule" style="background-image: url('<?php echo ASSETS_URL . 'templates/images/enent-bg.png'; ?>');">
        <div class="container">
            <div class="events-schedule-heding">
                <h2>Event Schedule</h2>
                <p>This is sample of page tagline and you can set it up using page option</p>
            </div>
            <div class="events-date-schedule">
                <ul id="tabs" class="nav nav-tabs events-date-tab" role="tablist">
                    <?php $this->db->group_by("schedule_date");
                        $trainings = $this->user->get_record_by_field_name_all_record('tbl_training_schedule', 'training_id', $tid);
                        $alldates = array_unique(array_column($trainings, 'schedule_date'));
                        $count = count($alldates);

                        for ($i = 0; $i < $count; $i++) {
                            $noOfDay = $i + 1;
                            if ($i == 0) {  $act = 'active';  } else {  $act = ''; } ?>
                    <li class="nav-item">
                        <a id="tab-<?php echo $i; ?>" href="#pane-<?= $i; ?>" class="nav-link <?php echo $act; ?>" data-toggle="tab" role="tab"><span>Day
                                <?= $noOfDay ?></span> <?php echo date('F d, Y', strtotime($alldates[$i])); ?></a>
                    </li>
                <?php } ?>
                </ul>

                <div id="content" class="tab-content" role="tablist">
                <?php for ($j = 0; $j < $count; $j++) 
                    {
                        $day = $j + 1;
                        $schedule = $this->user->get_record_by_field_name_all_record('tbl_training_schedule', array('training_id' => $tid, 'schedule_date' => $alldates[$j]), '');
                        if ($j == 0) { $active = 'active';  } else { $active = ''; } ?>
                    <div id="pane-<?php echo $j; ?>" class="card tab-pane fade show <?php echo $active; ?>" role="tabpanel" aria-labelledby="tab-<?php echo $j; ?>">
                        <div class="card-header" role="tab" id="heading-<?php echo $j; ?>">
                            <h5 class="mb-0">
                                <!-- Note: `data-parent` removed from here -->
                                <a class="new-temp-accodian" data-toggle="collapse" href="#collapse-<?php echo $j; ?>"
                                    aria-expanded="true" aria-controls="collapse-<?php echo $j; ?>">
                                    <span>Day <?=$day;?></span> <?php echo date('g:iA', strtotime($value['schedule_start_time'])) . ' - ' . date('g:iA', strtotime($value['schedule_end_time'])); ?>
                                </a>
                            </h5>
                        </div>

                        <!-- Note: New place of `data-parent` -->
                        <div id="collapse-<?php echo $i; ?>" class="collapse show" data-parent="#content" role="tabpanel"
                            aria-labelledby="heading-<?php echo $i; ?>">
                            <div class="card-body">
                                <div class="event-tab-content">
                                    <?php $counte = 1;
                                foreach ($schedule as $key => $value) {
                                    $speaker = $this->user->get_record_by_field_name_all_record('tbl_training_speaker', 'id', $value['speaker_id']);
                                    if ($speaker[0]['speaker_name'] == "" || $value[0]['speaker_id']) {
                                        $speaker_name = $value['speaker_name'] . '-' . $value['position'];
                                    } else {
                                        $speaker_name = $speaker[0]['speaker_name'];
                                    }

                                    if ($speaker[0]['speaker_image']) {
                                        $image = ASSETS_URL . 'images/uploads/' . $speaker[0]['speaker_image'];
                                    } else {
                                        $image = ASSETS_URL . 'images/dummy-speaker.jpg';
                                    } ?>
                                    <div class="event-main-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="event-tab-profile">
                                                    <p>
                                                        <span>Session <?php echo $counte; ?> :</span> 
                                                    </p>
                                                    <div class="event-profile">
                                                        <!-- <img src="<?php echo $image; ?>" alt=""> -->
                                                    </div>
                                                    <div class="event-profile-dtl">
                                                        <p> <?php echo $value['topic']; ?></p>
                                                        <span class="event-time"><?php echo date('g:iA', strtotime($value['schedule_start_time'])) . ' - ' . date('g:iA', strtotime($value['schedule_end_time'])); ?></span>
                                                        <!-- <a class="event-speaker" href="#">Speaker(s)</a> -->
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="e-user-dtl">
                                                    <p><?php echo $speaker_name; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php $counte++; } ?>  
                               
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                                        
                </div>

            </div>
        </div>

    </section>

    <section class="general-info" id="gen-information">
        <div class="container">
            <nav>
                <div class="general-ifo-tab">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link gen-info active" id="nav-general-tab" data-toggle="tab" href="#gen-nav-general" role="tab" aria-controls="nav-general" aria-selected="true">GENERAL INFORMATION
                        </a>
                        <a class="nav-link gen-over" id="nav-overview-tab" data-toggle="tab" href="#gen-nav-overview" role="tab" aria-controls="nav-overview" aria-selected="false">TRAINING OVERVIEW</a>
                        <a class="nav-link gen-less" id="nav-lesson-tab" data-toggle="tab" href="#gen-nav-lesson" role="tab" aria-controls="nav-lesson" aria-selected="false">LESSON</a>
                    </div>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="gen-nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                    <div class="gen-info-content">
                        <h3 class="gen-info-heading">General Information</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <tbody>
                                    <tr>
                                        <td>Title:</td>
                                        <td><?php echo $training[0]['title']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sub-title:</td>
                                        <td><?php echo $training[0]['sub_title']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>CE Units:</td>
                                        <td><?php echo $training[0]['units'];
                                            if ($training[0]['units'] == 0) {
                                                echo " CNE Units will be awarded on the symposium";
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date:</td>
                                        <td class="gen-date"><?php echo $date; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Time:</td>
                                        <td class="gen-date"><?php echo date('g:iA', strtotime($training[0]['start_time'])); ?> - <?php echo date('g:iA', strtotime($training[0]['end_time'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Venue:</td>
                                        <td><?php echo $training[0]['location']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Who can attend this training?</td>
                                        <td><?php echo $training[0]['participants']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Registration Fee:</td>
                                        <td><?php if ($training[0]['total'] > 0) {
                                                echo '$' . $training[0]['total'];
                                            } else {
                                                echo 'Free';
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Contact Person:</td>
                                        <td><?php echo $training[0]['contact_person']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><?php echo $training[0]['email']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Phone:</td>
                                        <td><?php echo $training[0]['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Name of (Training committee chairman):</td>
                                        <td><?php echo $training[0]['chairman']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Position:</td>
                                        <td><?php echo $training[0]['position']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="gen-nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
                    <div class="gen-info-content">
                        <h3 class="gen-info-heading">Training Overview</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <tbody>
                                    <tr>
                                        <td>Training Overview:</td>
                                        <td><?php echo strip_tags($training[0]['description']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Traning Objectives:</td>
                                        <td><?php echo strip_tags($training[0]['objectives']); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Methodologies:</td>
                                        <td><?php echo strip_tags($training[0]['methodologies']); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Item/s to bring:</td>
                                        <td><?php echo strip_tags($training[0]['item_to_bring']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade <?php if ($_REQUEST['lesson'] == "1") {
                                                echo "in active";
                                            } ?>" id="gen-nav-lesson" role="tabpanel" aria-labelledby="nav-lesson-tab">
                    <div class="gen-info-content">
                        <h3 class="gen-info-heading">Lesson</h3>
                        <div class="row">
                            <?php $tdata22 = $this->user->get_record_by_field_name_all_record('tbl_training_speaker', 'training_id', $training[0]['id']);
                            $tr_idd = $training[0]['id'];
                            foreach ($tdata22 as $key => $value1) {
                                $key = $key + 1;
                                if ($value1['speaker_image'] != "") { ?>
                                    <div class="col-md-2 col-xs-6">
                                        <div class="lession-thumnel">
                                            <div class="thumbnail <?php if ($_REQUEST['ppt'] == $value1['id']) {
                                                                        echo 'selected-ppt';
                                                                    } ?>" style="height: 86px; width: 96px;">
                                                <a href="#" onclick="powerpoint('<?php echo $tr_idd; ?>','<?php echo $value1['id']; ?>')">
                                                    <img style="width: 75px; height: 75px;" src="<?php echo base_url('/assets/images/uploads/') . $value1['speaker_image']; ?>" alt="Lights" style="width:100%">
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
                        <span style="display: none; color: red; text-align: center;" id="loaders">Loading...</span>
                        <div class="bannergroup mt-5" id="powerpoints" style="display: none;">
                            <div class="row">
                                <div id="responsesata"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="evaluation" style="background-image: url('<?php echo ASSETS_URL . 'templates/images/evelution-bg.png'; ?>');">
        <div class="evaluation-content">
            <h1>Evaluation</h1>
            <p>Your Input will helps us to improve more our services.</p>
            <a class="evaluate-btn" href="javascript:void(0);" onclick="evaluatenow_details()">Evaluate Now</a>
        </div>
    </section>


    <section class="the-committeepanel" id="event-committee">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="speakingslider-panel Committeeslider-panel">
                        <h1>The Committee</h1>
                        <p>This is sample of page tagline and you can set it up using page option</p>

                        <div class="committeeslider">
                            <?php foreach ($committee as $key => $value) { ?>
                                <div class="item">
                                    <div class="speakings-box">
                                        <div class="speakings-imgbox">
                                            <img src="<?php echo ASSETS_URL . 'images/uploads/' . $value['committee_image']; ?>" alt="<?= $value['committee_name'] ?>">
                                        </div>
                                        <div class="Committees-info">
                                            <h2><?php echo $value['committee_name']; ?></h2>
                                            <p><?php echo $value['degination']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="footer-logostrip">
            <img src="<?php echo ASSETS_URL . 'templates/images/logo.png'; ?>" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-cmsbox">
                        <div class="footer-cmsinfo">
                            <div class="footer-cmsimg">
                                <a target="_blank" href="<?php echo site_url('pages/courses'); ?>"><img src="<?php echo ASSETS_URL . 'templates/images/online-courceicon.png'; ?>" alt=""></a>
                            </div>
                            <p>Online Cource</p>
                        </div>
                        <div class="footer-cmsinfo">
                            <div class="footer-cmsimg">
                                <a target="_blank" href="<?php echo site_url('pages/training'); ?>"><img src="<?php echo ASSETS_URL . 'templates/images/training-seminaricon.png'; ?>" alt=""></a>
                            </div>
                            <p>Training Seminar</p>
                        </div>
                        <div class="footer-cmsinfo">
                            <div class="footer-cmsimg">
                                <a href="javascript:void(0)" onclick="checklogin();"><img src="<?php echo ASSETS_URL . 'templates/images/upload-certificateicon.png'; ?>" alt=""></a>
                            </div>
                            <p>Upload Certificate</p>
                        </div>
                        <div class="footer-cmsinfo">
                            <div class="footer-cmsimg">
                                <a target="_blank" href="<?php echo site_url('pages/Institutionspage'); ?>"><img src="<?php echo ASSETS_URL . 'templates/images/institution-webpageicon.png'; ?>" alt=""></a>
                            </div>
                            <p>Institution CE Webpage</p>
                        </div>
                    </div>

                    <div class="foter-btnbox">
                        <?php if ($this->session->userdata('logged_in') == FALSE) { ?>
                            <a class="yellow-btn" href="<?php echo site_url('users'); ?>">Login</a>
                        <?php } ?>

                        <a class="blue-btn" href="<?php echo site_url('users'); ?>?register=1">Sign Up</a>
                    </div>

                    <div class="footer-counter">
                        <ul>
                            <li>
                                <span><?php echo count($tcourse); ?></span>
                                <p>Online Course </p>
                            </li>
                            <li>
                                <span><?php echo count($ttraining); ?></span>
                                <p>Training / Seminars</p>
                            </li>
                            <li>
                                <span><?php echo count($tprofessional); ?></span>
                                <p>Professionals </p>
                            </li>
                            <li>
                                <span><?php echo count($tprovider); ?></span>
                                <p>CE Providers</p>
                            </li>
                            <li>
                                <span><?php echo count($tInstitutions); ?></span>
                                <p>Institutions</p>
                            </li>
                            <li>
                                <span><?php echo count($tTotalAuthor); ?></span>
                                <p>Author</p>
                            </li>
                            <li>
                                <span><?php echo count($tCountry); ?></span>
                                <p>Countries</p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php $tidd = $this->uri->segment(3);
    $url = "http://ceonpoint.com/pages/training_details/" . $tidd;
    $facebookUrl   = "http://www.facebook.com/sharer.php?u=" . $url;
    $twitterUrl    = "http://twitter.com/share?url=" . $url;
    $pinterestUrl  = "http://pinterest.com/pin/create/button/?url=" . $url;
    $googlePlusUrl = "https://plus.google.com/share?url=" . $url;
    $linkedInUrl   = "http://www.linkedin.com/shareArticle?mini=true&url=" . $url;
    ?>


    <div id="training_registration" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Book A Seminar Or Training</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo BASE_URL . 'pages/bookseminar'; ?>" method="post" enctype="multipart/form-data" name="bookseminar" id="bookseminar">
                        <span id="traerror"></span>
                        <input type="hidden" name="seminar_id" value="<?php echo $tid; ?>">
                        <input type="hidden" name="ttype" value="<?php echo $training[0]['training_type']; ?>">
                        <input type="hidden" name="payment_mode" id="trainig_type">
                        <input type="hidden" name="uid" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="tax" id="tax" value="<?php echo $taxAmount; ?>">
                        <input type="hidden" name="price" id="price" value="<?php echo $seminar[0]['total']; ?>">
                        <div class="form-group">
                            <label for="email">Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Please put your complete name for Digital Certificate" value="<?= $name ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span style="color: red;">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="mymail@ceonpoint.com" value="<?= $email ?>" readonly>
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

                         <?php if($categorylist){ 
                                foreach($categorylist as $key => $value){ ?>
                            <div class="form-group">
                            <label for="<?php echo $value['category_name']; ?>"><?php echo $value['category_name']; ?> <span style="color: red;"><?php if($value['mandatory']=='1'){ echo'*'; } ?></span></label>
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
                            <input type="number" class="form-control" readonly name="price" value="<?php echo $seminar[0]['total']; ?>">
                        </div>
                        <button type="button" class="btn btn-info" id="savebutton" onclick="payoption('<?php echo $seminar[0]['total']; ?>')">Register now</button>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================================================== -->
    <form action="<?php echo PAYAPAL_URL; ?>" method="post" name="bookTraining" id="bookTraining">
        <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" id="item_name" value="<?php echo $training[0]['title'] . ' - Training Booked'; ?>">
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
        <input type="hidden" name="cancel_return" value="<?php echo site_url('pages/cancel_training_book/') . $tid; ?>">
        <input type="hidden" name="return" value="<?php echo site_url('pages/success_training_book'); ?>">
    </form>
    <!-- ===================================================== -->

    <div id="payby" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Choose Payment Option</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <a href="javascript:void(0)" onclick="paybypaypal('<?php echo $seminar[0]['total']; ?>');" class="btn btn-primary"> PayPal</a>
                    <!-- <?php $details = array('id' => $tidd, 'name' => $training[0]['title'], 'price' => $training[0]['total'], 'tax' => $taxAmount, 'type' => 'training'); ?> -->
                    <a href="javascript:void(0)" onclick="paybystrip('<?php echo $seminar[0]['total']; ?>');" class="btn btn-info"> Card</a>
                    <!-- <a href="<?php echo base_url('stripe/index') . '?id=' . $tidd . '&&name=' . $training[0]['title'] . '-Training Booked&&price=' . $training[0]['total'] . '&&tax=' . $taxAmount . '&&type=training'; ?>" class="btn btn-primary">Card</a> -->
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
                <div class="modal-header text-center" style="background-color: #315594;">
                    <h5 class="modal-title text-light">Invailad Registration</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                <div class="modal-header text-center" style="background-color: #315594;">
                    <h5 class="modal-title text-light">Training Registration</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group thankumsg">
                        <p><?php echo $this->session->flashdata('response'); ?></p>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary">Check Email</button>
                            <button type="button" class="btn btn-warning"><a href="<?php echo base_url('professional/dashboard'); ?>">My Account</a></button>
                            <button type="button" class="btn btn-success close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================speaking-modal================== -->
    
    <div id="speaker_details" class="modal fade speaker-modal mbd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Speaker Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="filteredData2">Loading....</div>              
                <div class="evulate-btn speaker-lession">
                    <a id="speaker_presntation" href="#">Click here</a><span>to view the lession/lectures</span>
                </div>
            </div>
          </div>
        </div>
      </div>

    <!-- ===================================================== -->

    <div id="alertpupop" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alert</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <p>Please log-in or register as a <b> professional </b> to store your certificate in your account</p>

                    <div class="logincheck">
                        <a href="<?php echo BASE_URL ?>users" class="btn btn-primary" title="Login">Login</a>

                        <a href="javascript:void(0);" onclick="register_now()" title="Register Now" class="btn btn-success">Sign Up</a>
                    </div>
                </div>
                <!-- <div class="modal-footer"></div> -->
            </div>
        </div>
    </div>

    <!-- ===================================================== -->
<!--     <div id="login_registration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ceonpoint Says:</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <p>Please Log in or Sign up as a <b> Professional </b> to register in the training.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo BASE_URL . 'users/index?location=' . urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-primary" title="Login">Login</a>

                    <a href="<?php echo BASE_URL . 'users/signup/professional?location=' . urlencode($_SERVER['REQUEST_URI']); ?>" title="Register on ceonpoint" class="btn btn-warning">Sign Up</a>
                </div>
            </div>
        </div>
    </div> -->

    <!-- ===================================================== -->
    <div id="alertForRegistration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ceonpoint Says:</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please Log in or Sign up as a <b> Professional </b> to register in the training.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo base_url('pages/training_details/' . $tid . '?popup=123'); ?>" title="Register on Training" class="btn btn-primary">Sign Up</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================================================== -->
    <div class="modal fade" id="videoModalPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Training Introduction Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php $get_name = end(explode('v=', $training[0]['video']));
                    $url = 'https://www.youtube.com/embed/' . $get_name; ?>
                    <iframe width="100%" height="415" src="<?php echo $url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ==============Evaluation-modal======================= -->
   
    <div id="evaluatenow_details" class="modal evaluation-modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Evaluate Now</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php $training_speakers  = $this->user->get_record_by_field_name_all_record('tbl_training_speaker', 'training_id', $tid); 
                      $training_speakers_content = $training_speakers; ?>
                <div class="modal-body evaluation-modal-body">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <?php $count = 1;
                        foreach ($training_speakers as $key => $value1) {
                            if($value1['speaker_image']){ $speakerImg = ASSETS_URL.'images/uploads/'.$value1['speaker_image'];
                            }else{ $speakerImg = ASSETS_URL.'images/uploads/dummy-speaker.jpg'; } ?>
                        <li class="nav-item">
                            <a id="tab-modal-<?php echo $count; ?>" href="#pane-modal-<?php echo $count; ?>" class="nav-link <?php if($count==1){ echo "active";} ?>" data-toggle="tab" role="tab">
                             <div class="modal-evulate-user">
                                 <div class="modal-evulate-profile">
                                     <img src="<?php echo $speakerImg; ?>" alt=""></div>
                                 <div class="modal-evulate-dtl">
                                     <p><?php echo $value1['speaker_name']; ?></p>
                                 </div>
                             </div>
                                
                            </a>
                        </li>
                        <?php $count++; } ?>
                        
                        <li class="nav-item">
                            <a id="tab-modal-F" href="#pane-modal-F" class="nav-link" data-toggle="tab" role="tab">
                                <div class="modal-evulate-user">
                                    <div class="modal-evulate-profile">
                                        <img src="<?php echo ASSETS_URL.'images/uploads/symposium.png'; ?>" alt="">
                                    </div>
                                    <div class="modal-evulate-dtl">
                                        <p>TRAINING</p>
                                    </div>
                                </div>
                                
                            </a>
                        </li>
                    </ul>

                    <div id="modal-content" class="tab-content" role="tablist">

                        <?php $number = 1;
                            foreach ($training_speakers_content as $skey => $value2) { 
                            if($value2['speaker_image']){ $speakerImgs = ASSETS_URL.'images/uploads/'.$value2['speaker_image'];
                            }else{ $speakerImgs = ASSETS_URL.'images/uploads/dummy-speaker.jpg'; } ?>

                        <div id="pane-modal-<?php echo $number; ?>" class="card tab-pane fade <?php if($number == 1){ echo 'show active'; } ?>" role="tabpanel" aria-labelledby="tab-modal-<?php echo $number; ?>">
                            <div class="card-header" role="tab" id="heading-modal-<?php echo $number; ?>">
                                <h5 class="mb-0">
                                    <!-- Note: `data-parent` removed from here -->
                                    <?php if($number == 1){ $expand = 'true'; $class = ''; $mview = 'show'; }else{ $expand = 'false'; $class='collapsed'; $mview = 'hide'; } ?>
                                    <a data-toggle="collapse" href="#collapse-modal-<?php echo $number; ?>" aria-expanded="<?php echo $expand; ?>" aria-controls="collapse-modal-<?php echo $number; ?>" class="<?php echo $class; ?>">
                                        <div class="modal-evulate-user">
                                            <div class="modal-evulate-profile">
                                                <img src="<?php echo $speakerImgs; ?>" alt=""></div>
                                            <div class="modal-evulate-dtl">
                                                <p><?php echo $value2['speaker_name']; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </h5>
                            </div>
                            <?php  $where = array('training_id'=>$tid,'evaluation_type'=>1);
                            $this->db->order_by('id','ASC');
                            $evaluation  = $this->user->get_record_by_field_name_all_record11('tbl_training_evaluation',$where);
                            $evaluation_note  = $this->db->get_where('tbl_training',array('id'=>$tid))->row_array()['evaluation_note'];
                            $check_evaluation_exsits  = $this->db->get_where('tbl_training_review',array('user_id'=>$user_id,'training_id'=>$tid,'speaker_id'=>$value2['id']))->row_array();   ?>
                            <!-- Note: New place of `data-parent` -->
                            <div id="collapse-modal-<?php echo $number; ?>" class="collapse <?php echo $mview; ?>" data-parent="#modal-content" role="tabpanel" aria-labelledby="heading-modal-<?php echo $number; ?>">
                                <div class="card-body">
                                <?php if(count($check_evaluation_exsits) > 0){ ?>
                                        <div class="form-group mt-5">
                                            <label>Thank you for your evaluation.</label>
                                        </div>
                                <?php  }else{ ?>
                                    <div class="card-text"><?php echo $evaluation_note; ?></div>
                                    <form action="<?php echo site_url('pages/saverating'); ?>" method="post" id="evaluationsubmit"> 
                                    <input type="hidden" name="speaker_id" value="<?php echo $value2['id'];?>">
                                    <input type="hidden" name="training_id" value="<?php echo $tid;?>">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                                    <div class="rating-box">
                                    <?php foreach ($evaluation as $key => $value) {  ?>
                                    <input type="hidden" name="questionid[]" value="<?php echo $value['id'];?>">
                                    <input type="hidden" name="questiontype[]" value="<?php echo $value['question_type'];?>">
                                        <p><?php echo $key+1;?>.<?php echo $value['evaluation_question']; ?></p>
                                    <?php if($value['question_type']==1){  ?>
                                       <div class="rate">
                                           <input type="radio" id="field<?php echo $key+1;?>_star5" name="rating[<?php echo $value['id'];?>]" value="5" />
                                           <label for="field<?php echo $key+1;?>_star5" title="Excellent">5 stars</label>
                                           <input type="radio" id="field<?php echo $key+1;?>_star4" name="rating[<?php echo $value['id'];?>]" value="4" />
                                           <label for="field<?php echo $key+1;?>_star4" title="Very Good">4 stars</label>
                                           <input type="radio" id="field<?php echo $key+1;?>_star3" name="rating[<?php echo $value['id'];?>]" value="3"  />
                                           <label for="field<?php echo $key+1;?>_star3" title="Good" >3 stars</label>
                                           <input type="radio" id="field<?php echo $key+1;?>_star2" name="rating[<?php echo $value['id'];?>]" value="2" />
                                           <label for="field<?php echo $key+1;?>_star2" title="Fair" >2 stars</label>
                                           <input type="radio" id="field<?php echo $key+1;?>_star1" name="rating[<?php echo $value['id'];?>]" value="1" />
                                           <label for="field<?php echo $key+1;?>_star1" title="Needs Improvement">1 star</label>
                                        </div>
                                    <?php } ?>
                                    <?php if($value['question_type']==2){  ?>
                                    <div class="evaluation-comment">
                                        <input type="text" class="form-control" name="comments[<?php echo $value['id'];?>]" id="comments<?php echo $value['id'];?>" placeholder="Comment Here">
                                    </div>
                                    <?php } } ?>
                                    </div>
                                    <div class="evulate-btn">
                                        <a href="#" onclick="checkLoginTraining('<?php echo $value2['training_id'];?>','s')" >submit evaluation</a>
                                    </div>
                                    </form>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php $number++; } ?>
                        <div id="pane-modal-F" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-modal-F">
                            <div class="card-header" role="tab" id="heading-modal-F">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapse-modal-F" aria-expanded="false" aria-controls="collapse-modal-F">
                                        <div class="modal-evulate-user">
                                            <div class="modal-evulate-profile">
                                                <img src="<?php echo ASSETS_URL.'images/uploads/symposium.png'; ?>" alt="">
                                            </div>
                                            <div class="modal-evulate-dtl">
                                                <p>TRAINING</p>
                                            </div>
                                        </div>
                                    </a>
                                </h5>
                            </div>
                            <?php  $where = array('training_id'=>$tr_idd,'evaluation_type'=>2);
                            $this->db->order_by('id','ASC');
                            $evaluation  = $this->user->get_record_by_field_name_all_record11('tbl_training_evaluation',$where);
                            $evaluation_note  = $this->db->get_where('tbl_training',array('id'=>$tr_idd))->row_array()['evaluation_note'];
                             $check_evaluation_exsits  = $this->db->get_where('tbl_training_review',array('user_id'=>$user_id,'training_id'=>$tid,'speaker_id'=>$value2['id']))->row_array();  ?>
                            <div id="collapse-modal-F" class="collapse" role="tabpanel" data-parent="#modal-content" aria-labelledby="heading-modal-F">
                                <div class="card-body">
                                <?php if(count($check_evaluation_exsits) > 0){ ?>
                                        <div class="form-group mt-5">
                                            <label>Thank you for your evaluation.</label>
                                        </div>
                                <?php  }else{ ?>
                                    <div class="card-text"><?php echo $evaluation_note; ?></div>
                                    <form action="<?php echo site_url('pages/saverating'); ?>" method="post" id="evaluationTrainingSubmit"> 
                                    <input type="hidden" name="speaker_id" value="0"> <!-- This section is for all kind of over all training review -->
                                    <input type="hidden" name="training_id" value="<?php echo $tid;?>">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                                    <div class="rating-box">
                                    <?php foreach ($evaluation as $key => $value) {  ?>
                                    <input type="hidden" name="questionid[]" value="<?php echo $value['id'];?>">
                                    <input type="hidden" name="questiontype[]" value="<?php echo $value['question_type'];?>">
                                        <p><?php echo $key+1;?>.<?php echo $value['evaluation_question']; ?></p>
                                    <?php if($value['question_type']==1){  ?>
                                       <div class="rate">
                                           <input type="radio" id="star<?php echo $key+1;?>5" name="rating[<?php echo $value['id'];?>]" value="5" />
                                           <label for="star<?php echo $key+1;?>5" title="5 star">5 stars</label>
                                           <input type="radio" id="star<?php echo $key+1;?>4" name="rating[<?php echo $value['id'];?>]" value="4" />
                                           <label for="star<?php echo $key+1;?>4" title="4 star">4 stars</label>
                                           <input type="radio" id="star<?php echo $key+1;?>3" name="rating[<?php echo $value['id'];?>]" value="3" />
                                           <label for="star<?php echo $key+1;?>3" title="3 star">3 stars</label>
                                           <input type="radio" id="star<?php echo $key+1;?>2" name="rating[<?php echo $value['id'];?>]" value="2" />
                                           <label for="star<?php echo $key+1;?>2" title="2 star">2 stars</label>
                                           <input type="radio" id="star<?php echo $key+1;?>1" name="rating[<?php echo $value['id'];?>]" value="1" />
                                           <label for="star<?php echo $key+1;?>1" title="1 star">1 star</label>
                                        </div>
                                    <?php } ?>
                                    <?php if($value['question_type']==2){  ?>
                                    <div class="evaluation-comment">
                                        <input type="text" class="form-control" name="comments[<?php echo $value['id'];?>]" id="comments<?php echo $value['id'];?>" placeholder="Comment Here">
                                    </div>
                                    <?php } }?>
                                    </div>
                                    <div class="evulate-btn">
                                        <a href="#" onclick="checkLoginTraining('<?php echo $tr_idd;?>','t')" >submit evaluation</a>
                                    </div>
                                    </form>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div id="successModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            
            <div class="modal-content">
                <div class="modal-header" style="background-color: #315594;">
                    <h4 class="modal-title text-light">Success Message</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                    
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

<div class="modal fade login_registration" id="login_registration" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
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
    <div class="modal-content" style="height: 650px;overflow: scroll;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Signup as Professional</h5>
      </div>
    <?php echo form_open_multipart('javascript:void(0)', array('name' => 'prof-signup','id' => 'prof-form')); ?>      
    <div class="modal-body">
        <div class="row">
        
            <div class="col-sm-12">
                <h4 class="mb-2 bg-primary p-2 px-4">PROFESSIONAL REGISTRATION</h4>
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

            <div class="col-sm-12">
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
            </div>

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
                <input required="" name="rememberme" class="mr-2" id="rememberme" value="forever" type="checkbox">&nbsp; By clicking Register, I agree to the &nbsp;&nbsp;
                <a href="javascript:void(0);" style="color: blue;" onclick="
                termconditionpopups('professional')                         
                ">Terms, Privacy Policy and Copyright policy </a>
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
    <!-- ==============Script======================= -->


    <script src="<?php echo ASSETS_URL . 'templates/js/jquery.js'; ?>"></script>
    <script src="<?php echo ASSETS_URL . 'templates/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo ASSETS_URL . 'templates/js/owl.carousel.js'; ?>"></script>
    <script>
        $('.speakingslider').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: true,
            autoplay: true,
            autoplaySpeed: 2000,
            dotsSpeed: 2000,
            responsive: {
                320: {
                    items: 1
                },

                360: {
                    items: 2
                },

                580: {
                    items: 2
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
        $('.committeeslider').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            autoplay: true,
            autoplaySpeed: 2000,
            dotsSpeed: 2000,
            responsive: {
                320: {
                    items: 1
                },

                360: {
                    items: 2
                },

                580: {
                    items: 2
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });

        $(window).scroll(function() {
            if ($(window).scrollTop() >= 100) {
                $('.header').addClass('fixed-header');
            } else {
                $('.header').removeClass('fixed-header');
            }
        });

        // $(window).scroll(function(){
        //     if ($(window).scrollTop() >= 250) {
        //         $('nav').addClass('fixed-header');
        //     }
        //     else {
        //         $('nav').removeClass('fixed-header');
        //     }
        // });

        var tid = '';
        var spid = '';
        $(document).ready(function() {
            tid = '<?php echo $training[0]['id'] ?>';
            spid = '<?php echo $_REQUEST['ppt'] ?>';
            var ppt = "<?php if ($_REQUEST['lesson'] > 0 && $_REQUEST['ppt'] > 0) { ?>" + powerpoint(tid, spid) + "<?php } ?>";
            var p = "<?php if ($_REQUEST['popup'] == '123') { ?>" + $('#training_registration').modal('show'); + "<?php } ?>";
            var success = "<?php if ($_REQUEST['id'] == 'success') { ?>" + $("#success_registration").modal() + "<?php } ?>";
            var exist = "<?php if ($_REQUEST['id'] == 'exist') { ?>" + $("#thankyou").modal() + "<?php } ?>";
            var r = "<?php if ($_REQUEST['r'] == 1) { ?>" + $("#succespopup").modal() + "<?php } ?>";
            var lesson = "<?php if ($_REQUEST['lesson'] == 1) { ?>" +
                $(document).ready(function() {
                    window.scrollTo({
                        top: $('#gen-information').offset().top,
                        left: 0,
                        behavior: 'smooth'
                    })
                }); +
            "<?php } ?>";

            // $('a[href*="#"]').on('click', function(e) {
            //     e.preventDefault();

            //     $('html, body').animate({
            //         scrollTop: $($(this).attr('href')).offset().top
            //     }, 500, 'linear');
            // });

             var resgiration_popup = "<?php if ($user_id != '') { ?>"  
            if(localStorage.getItem('popState') != 'shown<?php echo $tid;?>'){ 
                $('#training_registration').modal('show'); 
                localStorage.setItem('popState','shown<?php echo $tid;?>'); 
            } 
                + "<?php } ?>";
        });


        $(document).on('change', '.otherCol', function() {
            var speaker = $(this).val();
            console.log(speaker);
            if (speaker == 0) {
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
        setInterval(function() {

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


            if (!days) {
                days = 00;
            }

            if (!hours) {
                hours = 00;
            }

            if (!minutes) {
                minutes = 00;
            }

            if (!seconds) {
                seconds = 00;
            }
            // format countdown string + set tag value
            countdown.innerHTML = '<ul><li><span id="days">' + days + '<sup>:</sup></span>days</li> <li><span id="hours">' + hours + ' <sup>:</sup></span>Hours</li> <li><span id="minutes">' + minutes + '<sup>:</sup></span>Minutes</li> <li><span id="seconds">' + seconds + ' </span>Seconds</li></ul>';
        }, 1000);



        function powerpoint(training_id, speaker_id) {
            $('#loaders').show();
            $.ajax({
                type: "POST",
                // url: '<?php echo site_url('provider/powerpoint'); ?>',
                url: '<?php echo site_url('share/powerpoint'); ?>',
                data: {
                    training_id: training_id,
                    speaker_id: speaker_id
                }
            }).done(function(result) {
                //alert(result);
                console.log(result);
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

        function speaker_details(speaker_id) {
            $("#speaker_details").modal();
            $("#filteredData2").html('');

            $.ajax({
                type: "POST",
                url: '<?php echo site_url('pages/speaker_details'); ?>',
                data: {
                    speaker_id: speaker_id
                }
            }).done(function(result) {
                $("#filteredData2").html(result);
                var url = "<?php echo site_url('/pages/training_details/') . $tidd1 . '?lesson=1&&ppt=' ?>" + speaker_id;
                $('#speaker_presntation').attr('href', url);
            });
            return false;
        }

        function close_alert_modal() {
            $('#alertForRegistration').modal('hide');
        }

        function evaluatenow_details() {
            $("#evaluatenow_details").modal();
        }

        function icu_model() {
            $("#icu_model").modal();
        }

        function checklogin() {
            <?php if (isset($_SESSION['logged_in']) &&  $_SESSION['logged_in']['role'] == 1) { ?>
                $('#uploadCertificateModal').modal('show');
                $('#homepopup').modal('hide');
            <?php } else { ?>
                $('#alertpupop').modal('show');
                $('#homepopup').modal('hide');
            <?php } ?>
        }

        function speaker_name(speaker_name, idd) {
            if (speaker_name == "SYMPOSIUM") {
                types = "symposium";
            } else {
                types = "teacher";
            }
            // $.noConflict();
            $('#speaker_name').html(speaker_name);
            $('#commentdata').html('Please wait...');
            var trid = "<?php echo $tr_idd; ?>";

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('pages/commentdata'); ?>",
                data: {
                    types: types,
                    trid: trid,
                    idd: idd
                }
            }).done(function(result) {
                //alert(result);
                $("#commentdata").html(result);
            });
            return false;
        }
        speaker_name('<?php echo $speaker[0]['speaker_name']; ?>', '<?php echo $speaker[0]['id']; ?>');



        <?php $is_login =  $this->session->userdata('logged_in');
        $role = $this->session->userdata('logged_in')['role']; ?>

        function openpopup(idd) {
            // $.noConflict();
            if ('<?= $is_login ?>') {
                if ('<?= $role ?>' == 1) {
                    // $('#type').val(idd);
                    $("#training_registration").modal();
                    var ttype = '<?php echo $training[0]['training_type']; ?>';
                    var amount = '<?php echo $training[0]['total']; ?>';
                    // alert(idd+'-'+ttype+' '+amount);
                    if (idd != 0 && ttype == 1) {
                        $('#amountfield').show();
                        // $('#savebutton').html('Pay Now!');
                        $('#savebutton').html('Register Now!');
                        $('#trainig_type').val('Online');

                        var name = $('#name').val();
                        var email = $('#email').val();
                        var profession_id = $('#profession_id').val();
                        var ueridTax = '<?php echo $user_id . '_' . $taxAmount; ?>';
                        $('#custom').val(name + '_' + email + '_' + profession_id + '_Online_' + ueridTax);
                    } else {
                        $('#amountfield').hide();
                        $('#savebutton').html('Register Now!');
                        $('#trainig_type').val('Ofline');
                    }
                } else {
                    // alert('Please log in as a professional to register in this training!');
                    $("#login_registration").modal('show');
                }
            } else {
                $("#login_registration").modal('show');
                // var r = confirm('Please logged in first!');
                // if(r == true){
                //     window.location.href = "<?php echo BASE_URL; ?>users";
                // }
            }
        }

        function payoption(amount) {
            var status = $('#status').val();
            var profession_id = $('#profession_id').val();
            var institution = $('#institution').val();
            var position = $('#position').val();
            var island = $('#island').val();
            if (status == '') {
                $('#traerror').html('Please select Membership Status.').css('color', 'red');
                return false;
            }
            if (profession_id == '') {
                $('#traerror').html('Please select Profession.').css('color', 'red');
                return false;
            }
            if (institution == '') {
                $('#traerror').html('Please enter institution name.').css('color', 'red');
                return false;
            }
            if (position == '') {
                $('#traerror').html('Please enter Position (Job Title).').css('color', 'red');
                return false;
            }
            if (island == '') {
                $('#traerror').html('Please enter Island (New Providence).').css('color', 'red');
                return false;
            } else {
                if (amount > 0) {
                    $('#training_registration').modal('hide');
                    $('#payby').modal('show');
                    return true;
                } else {
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
                url: "<?php echo base_url('pages/user_exist'); ?>",
                data: {
                    tid: tid,
                    email: email
                }
            }).done(function(result) {
                // alert(result);
                if (result == 0) {
                    if (total > 0 && ttype == 1) {
                        $('#bookTraining').submit(); //Paypal Payment
                    } else {
                        $('#bookseminar').submit(); //Free
                    }
                } else {
                    alert('Email id is already registered with us.');
                }
            });
            return false;
        }

        function paybystrip(total) {
            var ttype = '<?php echo $training[0]['training_type']; ?>';
            var email = $('#email').val();
            var tid = '<?php echo $tid; ?>';
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('pages/user_exist'); ?>",
                data: {
                    tid: tid,
                    email: email
                }
            }).done(function(result) {
                // alert(result);
                if (result == 0) {
                    window.location.href = '<?php echo base_url('stripe/index') . '?id=' . $tidd . '&&name=' . $training[0]['title'] . '-Training Booked&&price=' . $training[0]['total'] . '&&tax=' . $taxAmount . '&&type=training'; ?>';
                } else {
                    alert('Email id is already registered with us.');
                }
            });
            return false;
        }

        $('.thumbnail').click(function() {
            if ($(this).hasClass('selected-ppt')) {
                $(this).removeClass('selected-ppt');
            } else {
                $('.thumbnail.selected-ppt').removeClass('selected-ppt');
                $(this).addClass('selected-ppt');
            }
        });

        function goBackToEvaluation() {
            $('#succespopup').modal('hide');
            $('#evaluatenow_details').modal('show');
        }

         function checkLoginTraining(tid,type){
        var check = "<?php echo $this->session->userdata('logged_in')['id']; ?>";
        var role = "<?php echo $this->session->userdata('logged_in')['role']; ?>";
            if(check == ""){
                $("#evaluatenow_details").modal('hide');
                $("#login_registration").modal('show');
            }else{
                $.ajax({
                    url: '<?php echo site_url('pages/check_user_rgistered'); ?>',
                    type: 'POST',
                    data: {
                        check: check, tid: tid
                    },
                    dataType: 'json',
                    success: function(data) {
                        // alert(data);
                        if(data != undefined && data != null){
                        console.log(data)
                            if(data.user_id > 0){
                                if(data.present_status > 0 && data.present_status == 1){
                                    if(type=='s'){
                                        $("#evaluationsubmit").submit(); 
                                    }
                                    if(type=='t'){
                                        $("#evaluationTrainingSubmit").submit(); 
                                    }
                                }else{
                                    alert('It seems like you are not present in the training, Please contact to organizer to do evaluation. ');
                                }
                            }else{
                                $("#evaluatenow_details").modal('hide');
                                $("#login_registration").modal('show');
                            }
                        }
                    }
                });
            }
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
    </script>
</body>

</html>