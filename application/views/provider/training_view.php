<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<style> @font-face {font-family: 'fontawesome3';src: url('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/fonts/fontawesome-webfont.ttf?v=4.6.1') format('truetype');font-weight: normal;font-style: normal;}.fa3 {display: inline-block;font: normal normal normal 14px/1 fontawesome3;text-rendering: auto;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}.modal-body p {font-size: 14px;margin: 15px 0;color: #555;}.modal-body .question {margin-left: 35px;margin-top: -20px;}.star-checkbox {display: none;}.star-checkbox+label {display: inline-block;cursor: pointer;width: 15px;}.star-checkbox+label:before {content: '\f005';font-family: 'fontawesome';color: #000;background-color: #fff;}.star-checkbox:checked+label:before {background-color: #fff;color: #f9b111;transition: all .2s ease-in-out;}.form-check {margin-top: -5px;}.form-check label {margin: 0px 5px 0px;vertical-align: text-top;font-size: 12px;color: #000;letter-spacing: .5px;}.socials-icons {position: fixed;top: 30%;left: 0;z-index: 99999;}.socials-icons a {font-size: 25px;color: #fff;background: #4565a2;display: block;padding: 15px;width: 100%;text-align: center;text-decoration: none;}.socials-icons .socials-link2 {background: #60b4f0;}.socials-icons .socials-link3 {background: #bb1217;}.socials-icons .socials-link4 {background: #e15641;}.socials-icons .socials-link5 {background: #d3262c;}.socials-icons .socials-link6 {background: #0a80bd;}.evaluate_now .nav-tabs>li.active>a {background-color: transparent;border: 1px solid transparent;padding: 10px;}.evaluate_now .nav-tabs>li {margin-bottom: -1px;display: inline-block;float: none;width: 21%;}.evaluate_now .nav-tabs>li:last-child {z-index: 1;}.evaluate_now .nav-tabs>li:last-child:after {content: '';width: 50%;top: 0;right: 0;bottom: 0;background: #fff;z-index: -1;position: absolute;}.evaluate_now .nav-tabs>li.active:last-child:after {background: transparent;}.evaluate_now .nav-tabs>li.active>a img {border: 3px solid rgba(256, 256, 256, 0.8);}span#speaker_name {color: #92278f;}input#save {padding: 7px 20px;font-size: 16px;font-weight: normal;border-radius: 3px;background-color: #92278f;color: #fff;border: none;}.evaluate_now .nav-tabs {background-image: url(https://ceonpoint.com/assets/images/templates/homet2-speaker-bg.jpg);background-repeat: no-repeat;background-size: cover;text-align: center;background-position: 50% 32%;padding: 0 0;margin-bottom: 30px;display: inline-block;justify-content: space-around;overflow: auto;white-space: nowrap;height: 149px;}.evaluate_now .nav-tabs img {width: 60px;border-radius: 50%;height: 60px;object-fit: cover;border: 3px solid rgba(256, 256, 256, 0.4);}.evaluate_now .nav-tabs P {color: #fff;font-size: 14px !important;margin: 0;line-height: 24px;}.evaluate_now .nav-tabs a:hover {background: #000;color: #000;}.evaluate_now .nav-tabs>li>a:hover {border-color: #000;color: #000;}.evaluate_now .nav>li>a:focus, .evaluate_now .nav>li>a:hover, {text-decoration: none;background-color: transparent;color: #000;border: transparent;}.evaluate_now .nav>li:focus li:after, .evaluate_now .nav>li:hover li:after {text-decoration: none;background-color: transparent;color: #000;border: transparent;}.evaluate_now {width: 80%;}.evaluate_now .nav-tabs>li>a {height: auto;padding: 10px;}.icu_history {font-size: 20px;color: red;}.dataTables_filter {margin-bottom: 13px;}.speaker-det {list-style: none;display: inline-block;text-align: center;}@media (max-width:767px) {.socials-icons a {font-size: 20px;display: inline-block;padding: 15px;width: 72.6px;margin: -2px;}.socials-icons {top: 93%;width: 100%;}}</style>
    
<?php $this->load->view('template/picture_provider');
    // $datas = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training_book','training_seminar_id',$training[0]['id']);
    $userid  = $this->session->userdata('logged_in')['id'];
    $userdata = $this->db->get_where('tbl_user',array('id'=>$userid))->row_array(); 
    $under_insititution = $userdata['under_insititution']; 

    $registration_status = $training[0]['registration_status'];
    $total_limit = $training[0]['registration_limit'];
    $training_image = $training[0]['image'];

    $start_date = date($training[0]['start_date']);
    $new_date = date('d F Y', strtotime($start_date));

    $end_date = date($training[0]['end_date']);
    $end_date = date('d F Y', strtotime($end_date));
    if ($new_date == $end_date) {
        $training_date = $new_date;
    } else {
        $training_date = $new_date . ' - ' . $end_date;
    }
    $start_time = date('g:iA', strtotime($training[0]['start_time']));
    $end_time = date('g:iA', strtotime($training[0]['end_time']));

    if ($training[0]['training_type'] == 0) {
        $version = "Basic Version";
    } else {
        $version = "Pro Version";
    }

    $tid = $this->uri->segment(3); ?>
<?php $tspeaker = $this->user->get_record_by_field_name_all_record('tbl_training_speaker', 'training_id', $tid); ?>
<div class="innerContent" id="evaluation_printsection">
    <div class="container">
        <div class="row">
            <!-- <p class="col-sm-12"> -->
            <h3 class="border-title text-left">
                <?php echo $training[0]['title']; ?><span style="color: #478bca; font-weight: bold; margin-left: 12px;">(
                    <?php echo $version; ?>)
                </span>
                <?php   if($under_insititution =='0'){ 
                            $cont = "provider/dashboard"; 
                        }else{ 
                            $cont = "provider/set_target"; 
                        } ?>
                <a class="btn btn-primary pull-right" href="<?php echo site_url().$cont; ?>">Back</a>
                <?php // if($training[0]['training_type']==1){ 
                    ?>
                <!--  <a href="#" class="btn btn-primary pull-right mr-2" data-toggle="modal" data-target="#trainingReport">Training Report
                </a> -->
            </h3>
            <?php // } 
                ?>
            <!-- </p> -->

            <div class="step-wise-query provider-overview" id="selector">
                <ul class="nav-tabs hidden-xs">
                    <!-- <li><a data-toggle="tab" href="#tra-cover_page" aria-expanded="true" >Cover Page</a></li> -->
                    <li class="active"><a data-toggle="tab" href="#tra-participants" aria-expanded="true">Participants</a></li>
                    <li><a data-toggle="tab" href="#tra-demographics" aria-expanded="fasle">Demographics</a></li>
                    <li><a data-toggle="tab" href="#tra-certificate" aria-expanded="fasle">Certificate</a></li>
                    <li><a data-toggle="tab" href="#tra-evaluation" aria-expanded="fasle">Evaluation</a></li>
                    <li><a data-toggle="tab" href="#tra-genral" aria-expanded="fasle">General Info</a></li>
                    <li><a data-toggle="tab" href="#tra-overview" aria-expanded="fasle">Overview</a></li>
                    <li><a data-toggle="tab" href="#tra-speaker" aria-expanded="fasle">Speakers</a></li>
                    <li><a data-toggle="tab" href="#tra-schedule" aria-expanded="fasle">Schedule</a></li>
                    <?php if($under_insititution == '0'){ ?>
                    <li><a data-toggle="tab" href="#tra-promotion" aria-expanded="fasle">Promotion</a></li>
                    <?php } ?>
                    <li><a data-toggle="tab" href="#tra-template" aria-expanded="fasle">Template</a></li>
                    <?php if ($training[0]['training_type'] == 1) { ?>
                    <li><a data-toggle="tab" href="#tra-sponsor" aria-expanded="fasle">Sponsors</a></li>
                    <li><a data-toggle="tab" href="#tra-committee" aria-expanded="fasle">Committee</a></li>
                    <?php } ?>
                    <li><a data-toggle="tab" href="#tra-print" aria-expanded="fasle" style="font-size: 10px;">Print
                            Training</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tra-cover_page" class="tab-pane fade">

                        <div style="background-color: #0e0e0e; font-family: 'Poppins', sans-serif;    padding: 0;margin: 0;box-sizing: border-box;">

                            <table style="width: 600px;margin: 0 auto;background:url('<?php echo base_url('assets/images/pdf-cover-image.png'); ?>');background-repeat: no-repeat;background-color: #5b3991;">
                                <tr>
                                    <td>
                                        <table style="width: 100%;padding:15px 15px 0;background:url('<?php echo base_url('assets/images/uploads/') . $training[0]['image']; ?>');background-repeat: no-repeat;background-size: 100%;border:1px solid #000;">
                                            <tr>
                                                <td>
                                                    <table style="width:100%;margin-bottom: 315px;">
                                                        <tr>
                                                            <td style="text-align: right;font-size: 14px;font-weight: 600;text-transform: uppercase;color: #0e009e;">
                                                                <?php echo $training[0]['host']; ?><img src="<?php echo base_url('assets/images/uploads/') . $training[0]['attach_logo']; ?>" alt="" style="width: 60px;vertical-align: middle;">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;font-family: 'Yellowtail', cursive;padding-left: 75px;">
                                                                <h1 style="    font-size: 30px;font-weight:400;color: #fb0508;margin: 0;">
                                                                    <?php echo $training[0]['title']; ?>
                                                                </h1>
                                                                <p style="font-size: 20px;margin: 0;color: #fb0508;">"
                                                                    <?php echo $training[0]['sub_title']; ?>"
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>


                                                    <!--  <table style="width: 60%;float: left;">
                                                            <tr>
                                                                <td style="font-size: 18px; font-weight:500; color: #fff;text-decoration: underline;padding-top: 50px;">
                                                                     Speakers:
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <?php if ($tspeaker[0]['speaker_image']) { ?>
                                                                    <td style="font-size: 14px;font-weight: 600;display: flex;align-items: center; line-height: 16px;">
                                                                        <img src="<?php echo base_url('assets/images/uploads/') . $tspeaker[0]['speaker_image']; ?>" alt="" style="width: 65px;height: 65px;float: left;border-radius: 50%;border: 3px solid #000;margin-right: 15px;"> <?php echo $tspeaker[0]['speaker_name']; ?><br><?php echo substr($tspeaker[0]['position'],0,35); ?><br> <?php echo $tspeaker[0]['insititution']; ?>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>

                                                            <tr>
                                                                <?php if ($tspeaker[1]['speaker_image']) { ?>
                                                                    <td style="font-size: 14px;font-weight: 600;display: flex;align-items: center; line-height: 16px;padding-left: 18px;">
                                                                        <img src="<?php echo base_url('assets/images/uploads/') . $tspeaker[1]['speaker_image']; ?>" alt="" style="width: 65px;height: 65px;float: left;border-radius: 50%;border: 3px solid #000;margin-right: 15px;"> <?php echo $tspeaker[1]['speaker_name']; ?><br><?php echo substr($tspeaker[1]['position'],0,35); ?><br> <?php echo $tspeaker[1]['insititution']; ?>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                            <tr>
                                                                <?php if ($tspeaker[2]['speaker_image']) { ?>
                                                                    <td style="font-size: 14px;font-weight: 600;display: flex;align-items: center; line-height: 16px;padding-left: 45px;">
                                                                        <img src="<?php echo base_url('assets/images/uploads/') . $tspeaker[2]['speaker_image']; ?>" alt="" style="width: 65px;height: 65px;float: left;border-radius: 50%;border: 3px solid #000;margin-right: 15px;"> <?php echo $tspeaker[2]['speaker_name']; ?><br><?php echo substr($tspeaker[2]['position'],0,35); ?><br> <?php echo $tspeaker[2]['insititution']; ?>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr> 
                                                        </table>-->

                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="text-align: center;color: #fff;">
                                                                <h2 style="color: #fff; font-size: 22px;margin: 25px 0 0;">
                                                                    <?php echo $training_date; ?>
                                                                </h2>
                                                                <p style="font-size: 15px;margin: 5px;font-weight: 600;">
                                                                    <?php echo $start_time . ' to ' . $end_time; ?>
                                                                </p>
                                                                <span style="font-size: 15px;">
                                                                    <?php echo $training[0]['location']; ?>
                                                                </span>
                                                                <h4 style="font-size: 15px; color: #fff;">
                                                                    <?php echo $training[0]['units']; ?><br>CREDIT UNITS
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: center;color: #fff;">
                                                                <p style="font-size: 17px;margin: 0px;font-weight: 400;font-family: 'Yellowtail', cursive;">
                                                                    Salutted by.</p>
                                                                <span style="font-size: 12px;">
                                                                    <?php echo $training[0]['chairman']; ?><br>
                                                                    <?php echo $training[0]['position']; ?>
                                                                </span>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>

                            </table>


                        </div>
                    </div>
                    <div id="tra-table_content" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-table_content');"><i class="fa fa-print"
                                        aria-hidden="true"></i></a>
                                <div class="tra-table_content-border" style="border: 1px solid #f1f1f1; padding-left:20px;">
                                    <p class="toc_title" style="text-align: center; font-size:20px;">Table of Contents
                                    </p>
                                    <ol class="toc_list" style="padding: 0;">
                                        <li style="list-style: none; margin-right: 25px;">Participants & Certificates
                                            <span class="number-count" style="float: right;">1</span></li>
                                        <li style="list-style: none; margin-right: 25px;">Certificate Template<span class="number-count" style="float: right;">2</span></li>
                                        <li style="list-style: none; margin-right: 25px;">Evaluation <span class="number-count" style="float: right;">3</span></li>
                                        <li style="list-style: none;  margin-right: 25px;">Genral Info <span class="number-count" style="float: right;">4</span></li>
                                        <li style="list-style: none; margin-right: 25px;">Overview <span class="number-count" style="float: right;">5</span></li>
                                        <li style="list-style: none;  margin-right: 25px;">Speakers <span class="number-count" style="float: right;">5</span></li>
                                        <li style="list-style: none;  margin-right: 25px;">Schedule <span class="number-count" style="float: right;">6</span></li>
                                        <li style="list-style: none;  margin-right: 25px;">Promotion <span class="number-count" style="float: right;">7</span></li>
                                        <!-- <li style="list-style: none;  margin-right: 25px;">Template <span class="number-count" style="float: right;">8</span></li> -->
                                        <?php if ($training[0]['training_type'] == 1) { ?>
                                        <li style="list-style: none;  margin-right: 25px;">Sponsors <span class="number-count" style="float: right;">9</span></li>
                                        <li style="list-style: none;  margin-right: 25px;">Committee <span class="number-count" style="float: right;">10</span></li>
                                        <?php } ?>
                                    </ol>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div id="tra-participants" class="tab-pane fade active in">
                        <?php echo $this->session->flashdata('response-tl'); ?>
                        <h3 class="border-title text-left">Participants
                            <a href="javascript:void(0)" class="btn btn-warning" style="padding: 7px 14px;border: 1px solid #000;text-decoration: none;">Target (
                                <?php echo $total_limit; ?>)
                            </a>
                            <a href="<?php echo BASE_URL . 'provider/training_view/' . $training[0]['id'] . '?filter=3'; ?>" class="btn btn-primary" style="padding: 7px 14px;border: 1px solid #000;text-decoration: none;">Registered (
                                <?php echo count($registered); ?>)
                            </a>
                            <a href="<?php echo BASE_URL . 'provider/training_view/' . $training[0]['id'] . '?filter=1'; ?>" class="btn btn-success" style="padding: 7px 14px;border: 1px solid #000;text-decoration: none;">Present (
                                <?php echo count($present); ?>)
                            </a>
                            <a href="<?php echo BASE_URL . 'provider/training_view/' . $training[0]['id'] . '?filter=2'; ?>" class="btn btn-danger" style="padding: 7px 14px;border: 1px solid #000;text-decoration: none;">Absent (
                                <?php echo count($absent); ?>)
                            </a>
                            <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-participants');"><i class="fa fa-print"
                                    aria-hidden="true"></i></a>
                            <i class="pull-right">
                                <span class="btn" style="background-color: yellow;color:#ff0000;">Registration</span>
                                <span class="btn" id="title-for-registration"></span>
                                <a id="reg-btn"
                                    onclick="changeRegisrationStatus('<?php echo $training[0]['id']; ?>','<?php echo $registration_status; ?>');"
                                    href="javascript:void(0);" class="btn btn-info pull-right ml-2"><i
                                        class="fa fa-edit"></i></a>
                            </i>
                        </h3>

                        <div class="table-responsive">
                            <table class="table table-striped tra-fillter" style="width: 100%; max-width: 100%; margin-bottom: 1rem;">
                                <thead>
                                    <tr>
                                        <th style=" border-bottom: 1px solid black;">No.</th>
                                        <th style=" border-bottom: 1px solid black;">Name</th>
                                        <th style=" border-bottom: 1px solid black;">Country</th>
                                        <th style=" border-bottom: 1px solid black;">Profession</th>
                                        <th style=" border-bottom: 1px solid black;">Email</th>
                                        <th style=" border-bottom: 1px solid black;">Contact Number</th>
                                        <th style=" border-bottom: 1px solid black;">Certificate Number</th>
                                        <th style=" border-bottom: 1px solid black;">Certificate</th>
                                        <th style=" border-bottom: 1px solid black;">Attendance</th>
                                        <th style=" border-bottom: 1px solid black;">Evaluation</th>
                                        <th style=" border-bottom: 1px solid black;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //print_r($datas[0]); 
                                        foreach ($datas as $key => $value) {
                                            if($value['phone']){ 
                                                $phone = $value['phone']; 
                                            }else{ 
                                                $phone = '--'; 
                                            } 
                                            if ($value['certificate_id'] != "") {
                                                $certificate_id = $value['certificate_id'];
                                            }else{
                                                $certificate_id = '--';
                                            }
                                            $check_evaluation = $this->db->get_where('tbl_training_review', array('user_id' => $value['user_id'], 'training_id' => $value['training_seminar_id']))->num_rows();
                                            //echo $this->db->last_query(); 
                                        ?>
                                    <tr>
                                        <td style="border-bottom: 1px solid black;">
                                            <?php echo $key + 1; ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            <?php echo $value['name']; ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            <?php echo $value['countries_name']; ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            <?php echo $value['profession']; ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            <?php echo $value['email']; ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            <?php echo $phone; ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            <?php echo $certificate_id; ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black; text-decoration: none;">
                                            <?php if ($value['certificate_id'] != "") {
                                                        $filename = $value['certificate_id']; ?>
                                            <!-- http://wps-dev.com/dev/mycpd/assets/upload/pdf/7720821545244805.pdf -->
                                            <a class="btn btn-primary" title="View Certificate" target="_blank" href="<?php echo BASE_URL . 'assets/upload/pdf/' . $filename . '.pdf'; ?>" style="text-decoration: none;">Pdf</a>
                                            <?php } else {
                                                        echo 'N/A';
                                                    } ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            <?php if ($value['present_status'] == 0) {
                                                        echo '<span class="btn btn-warning">Pending</span>';
                                                    } else {
                                                        echo '<span class="btn btn-success">Present</span>';
                                                    } ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            <?php if ($check_evaluation > 0) {
                                                        echo '<span class="btn btn-success" title="User evaluated ' . $check_evaluation . ' speakers and training."> Yes </span>';
                                                    } else {
                                                        echo '<span class="btn btn-danger" title="User evaluated ' . $check_evaluation . ' speakers and training."> No </span>';
                                                    } ?>
                                        </td>
                                        <td style="border-bottom: 1px solid black;">
                                            <a href="javascript:void(0)" onclick="markAttendance('<?php echo $value['id']; ?>','<?php echo $tid; ?>','<?php echo $value['present_status']; ?>')" class="btn btn-primary" title="Edit attendance" style="text-decoration: none;">Edit</a>
                                        </td>
                                        <!-- <td>
                                        <a onclick="return confirm('Are you sure? you want to delete it.')"  class="btn btn-danger" title="Delete" href="<?php echo site_url('provider/deletecerti/' . $value['id'] . '/' . $tid . ''); ?>"><i class="fa fa-trash"></i></a>
                                    </td> -->
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="tra-demographics" class="tab-pane fade">
                        <h3 class="border-title text-left">Participant's Demographics
                            <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-demographics');"><i class="fa fa-print"
                                    aria-hidden="true"></i></a>
                        </h3>
                        <?php // echo'<pre>'; print_r($demographics); ?>
                        <?php   $total = count($demographics);
                                    $otherArr = array_diff(array_column($demographics, 'other'),['']);
                                    $loopcount = count($otherArr);
                                    $decode = array();
                                    if($otherArr){
                                        foreach($otherArr as $key => $value){
                                            $obj = json_decode($value);
                                            $decode[] = json_decode($value);
                                        }
                                            // print_r($decode[0]);
                                            // foreach($decode as $dkey => $dvalue){
                                            //     print_r($dvalue[$dkey]); 
                                            // }
                                        $catArr = array_values($decode);
                                        $total_other = count($otherArr);
                                    }
                                	//    echo'<pre>'; print_r($otherArr);
                                    $memberArr = array_diff(array_column($demographics, 'memberstatus'),['']);
                                    // $memberArr = array_column($demographics, 'memberstatus');
                                    $countmember = array_count_values($memberArr);   
                                    $total_member = count($memberArr);
                                    $member = $countmember[0];   
                                    $nonmember = $countmember[1];   // print_r($pprofession_list);

                                    $professionArr = array_diff(array_column($demographics, 'profession'),['']); 
                                    $countprofession = array_count_values($professionArr); 
                                    $total_profession = count($professionArr);

                                    $countryArr = array_diff(array_column($demographics, 'countries_name'),['']); 
                                    $countcountry = array_count_values($countryArr); 
                                    $total_country = count($countryArr);

                                    $institutionArr = array_diff(array_column($demographics, 'institution'),['']); 
                                    $countinstitution = array_count_values($institutionArr); 
                                    $total_institution = count($institutionArr);

                                    $positionArr = array_diff(array_column($demographics, 'position'),['']); 
                                    $countposition = array_count_values($positionArr); 
                                    $total_position = count($positionArr);

                                    $islandArr = array_diff(array_column($demographics, 'island'),['']); 
                                    $countisland = array_count_values($islandArr);   
                                    $total_island = count($islandArr);

                                    ?>
                        <div class="card">
                            <?php  //echo'<pre>'; print_r(array_count_values($professionArr)); ?>
                            <ol>
                                <?php if($total_country){ ?>
                                 <li>Country (Total : <strong>
                                        <?=$total_country?>
                                    </strong>)
                                    <ul>
                                        <?php foreach($countcountry as $key => $value){ ?>
                                        <li>
                                            <?=$key;?> :<strong>
                                                <?=$value;?>
                                            </strong>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <br>
                                <?php } ?>
                                <?php if($total_profession){ ?>
                                 <li>Profession (Total : <strong>
                                        <?=$total_profession?>
                                    </strong>)
                                    <ul>
                                        <?php foreach($countprofession as $key => $value){ ?>
                                        <li>
                                            <?=$key;?> :<strong>
                                                <?=$value;?>
                                            </strong>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <br>
                                <?php } ?>

                                <?php if($total_member){ ?>
                                <li>Membership (Total : <strong>
                                        <?=$total_member?>
                                    </strong>)
                                    <ul>
                                        <li>Member : <strong>
                                                <?=$member;?>
                                            </strong></li>
                                        <li>Non-Member : <strong>
                                                <?=$nonmember;?>
                                            </strong></li>
                                    </ul>
                                </li>
                                <br>
                                <?php } ?>
                               
                                <?php if($total_institution){ ?>
                                <li>Institution (Total : <strong>
                                        <?=$total_institution?>
                                    </strong>)
                                    <ul>
                                        <?php foreach($countinstitution as $key => $value){ 
                                            if($key != '' || $key != 0){?>
                                        <li>
                                            <?=$key;?> : <strong>
                                                <?=$value;?>
                                            </strong>
                                        </li>
                                        <?php } } ?>
                                    </ul>
                                </li>
                                <br>
                                <?php } ?>

                                <?php if($total_position){ ?>
                                <li>Position (Total : <strong>
                                        <?=$total_position?>
                                    </strong>)
                                    <ul>
                                        <?php foreach($countposition as $key => $value){ ?>
                                        <li>
                                            <?=$key;?> : <strong>
                                                <?=$value;?>
                                            </strong>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <br>
                                <?php } ?>

                                <?php if($total_island){ ?>
                                <li>Island (Total : <strong>
                                        <?=$total_island?>
                                    </strong>)
                                    <ul>
                                        <?php foreach($countisland as $key => $value){ ?>
                                        <li>
                                            <?=$key;?> : <strong>
                                                <?=$value;?>
                                            </strong>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                
                                <!-- <?php if($total_other){ ?>
                                <li>Island (Total : <strong>
                                        <?=$total_other?>
                                    </strong>)
                                    <ul>
                                        <?php foreach($decode as $key => $value){ ?>
                                        <li>
                                            <?=$key;?> : <strong><?=$value;?></strong>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?> -->
                                <!-- <li>Total : <strong><?=$total;?></strong>
                                    </li> -->
                            </ol>

                        </div>
                    </div>

                    <div id="tra-certificate" class="tab-pane fade">
                        <?php   $certificates = array_column($datas, 'certificate_id');
                                    $certificates1 = array_filter($certificates); 
                                    $count_certificates = count($certificates1); ?>
                        <h3 class="border-title text-left">Certificate (
                            <?=$count_certificates;?>)
                                <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-certificate');"><i class="fa fa-print"
                                    aria-hidden="true"></i></a>
                                <a href="<?php echo site_url('provider/template/' . $tid); ?>" class="btn btn-danger" style="padding: 7px 14px;border: 1px solid #000;text-decoration: none; position: absolute; right: 0px;">Generate
                                Certificate</a>
                        </h3>
                        <div class="card">
                            <div class="p-1">
                                <h5 class="alert alert-info">Please click the button to see the Certificate.</h5>
                            </div>
                            <div class="card-body">
                                <a href="javascript:void(0)" onclick="preview_certificate()" class="btn btn-success" style="padding: 7px 14px;border: 1px solid #000;text-decoration: none;">Preview
                                    Certificate</a>
                                <!-- <p id="certificate-preview"></p> -->
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered tra-fillter" style="width: 100%; max-width: 100%; margin-bottom: 1rem;">
                                <thead>
                                    <tr>
                                        <th style="border-bottom: 1px solid black;">No.</th>
                                        <th style="border-bottom: 1px solid black;text-align: left;">Name</th>
                                        <th style="border-bottom: 1px solid black;text-align: center;">Certificate Number
                                        </th>
                                        <th style="border-bottom: 1px solid black;text-align: center;">Certificate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $count = 1; 
                                             foreach ($datas as $key => $value) {
                                            if($value['certificate_id']){ ?>
                                        <tr>
                                            <td style="border-bottom: 1px solid black;">
                                                <?php echo $count; ?>
                                            </td>
                                            <td style="border-bottom: 1px solid black;text-align: left;">
                                                <?php echo $value['name']; ?>
                                            </td>
                                            <td style="border-bottom: 1px solid black;text-align: center;">
                                                <?php if ($value['certificate_id'] != "") {
                                                            echo $value['certificate_id'];
                                                        } else {
                                                            echo '--';
                                                        } ?>
                                            </td>
                                            <td style="border-bottom: 1px solid black;text-align: center;">
                                                <?php if ($value['certificate_id'] != "") {
                                                        $filename = $value['certificate_id']; ?>
                                                <!-- http://wps-dev.com/dev/mycpd/assets/upload/pdf/7720821545244805.pdf -->
                                                <a class="btn btn-primary" title="View Certificate" target="_blank" href="<?php echo BASE_URL . 'assets/upload/pdf/' . $filename . '.pdf'; ?>">Pdf</a>
                                                <?php } else {
                                                        echo 'N/A';
                                                    } ?>
                                            </td>
                                        </tr>
                                        <?php  $count++; } } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div id="tra-evaluation" class="tab-pane fade">
                        <h3 class="border-title text-left">Evaluation
                            <!-- <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-evaluation');"><i class="fa fa-print" aria-hidden="true"></i></a> -->
                        </h3>
                        <?php $this->db->group_by('user_id');
                            $count_review = $this->db->get_where('tbl_training_review', array('training_id' => $tid))->num_rows(); ?>
                        <span>Total Respondent: <b>
                                <?=$count_review;?>
                            </b></span>
                        <div class="evaluate_now" style="width: 100%; clear: both;">
                            <div class="content">
                                <ul class="nav nav-tabs">
                                    <?php foreach ($tspeaker as $key => $value1) {
                                            $key = $key + 1;
                                            if ($value1['speaker_image'] != "") { ?>
                                    <li id="speaker_print<?=$value1['id']; ?>" class="speaker-det <?php if($key==1){ echo 'active'; } ?>" onclick="speaker_name('<?php echo $value1['speaker_name']; ?>','<?php echo $value1['speaker_email']; ?>','<?php echo $value1['id']; ?>')">
                                        <a data-toggle="tab" href="#menu<?php echo $key; ?>">
                                            <div class="committee-img">
                                                <img style=" border-radius: 50%; border: 5px solid #313c34; box-sizing: border-box; width: 60px;" src="<?php echo base_url('assets/images/uploads/') . $value1['speaker_image']; ?>" alt="">
                                            </div>
                                            <div class="committee">
                                                <p style="font-size: 12px; color: #fff; font-weight: 600;" title="<?=$value1['speaker_name']?>">
                                                    <?php echo substr($value1['speaker_name'], 0, 20); ?>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } } ?>
                                    <li class="speaker-det" onclick="speaker_name('SYMPOSIUM','<?php echo $userdata['username_email']; ?>','<?php echo $tid; ?>')">
                                        <a data-toggle="tab" href="#menu555">
                                            <div class="committee-img">
                                                <img style=" border-radius: 50%; border: 5px solid #313c34; box-sizing: border-box; width: 60px;" src="<?php echo base_url('assets/images/uploads/symposium.png'); ?>" alt="">
                                            </div>
                                            <div class="committee">
                                                <p style="font-size: 12px; color: #fff; font-weight: 600;">Training</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div id="evaluation-report">
                                    <div class="title-box">
                                        <h4><span id="speaker_name">
                                                <?php echo $tspeaker[0]['speaker_name']; ?>
                                            </span></h4>
                                    </div>
                                    <div class="evaluate-note">
                                        <?php echo $training[0]['evaluation_note']; ?>
                                    </div>

                                    <div id="speaker_section"></div>
                                    <div id="email_evaluation"></div>
                                    <div id="commentdata" style="clear: both;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- </div> -->
                        <?php// } ?>
                    </div>

                    <div id="tra-genral" class="tab-pane fade">
                        <h3 class="border-title text-left">General Information
                            <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-genral');"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </h3>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <tr>
                                    <th style="width:25%; text-align: left;">Title</th>
                                    <td><b>
                                            <?php echo $training[0]['title']; ?>
                                        </b></td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Sub Title</th>
                                    <td>
                                        <?php echo $training[0]['sub_title']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Category</th>
                                    <td>
                                        <?php
                                            $category = $this->db->get_where('tbl_category', array('id' => $training[0]['category_id']))->row_array()['cat_name'];
                                            echo $category; ?>
                                    </td>
                                </tr>
                                <tr style="width:25%; text-align: left;">
                                    <th>Registration Limit</th>
                                    <td>
                                        <?php echo $training[0]['registration_limit']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Start Date & End Date</th>
                                    <td>
                                        <?php echo $training_date; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Start Time & End Time</th>
                                    <td>
                                        <?php echo $start_time . ' to ' . $end_time; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Units</th>
                                    <td>
                                        <?php echo $training[0]['units']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Registration Fee (Base Price + Tax)</th>
                                    <td>
                                        <?php if ($training[0]['total'] > 0) {
                                                echo $training[0]['total'] . '  (' . $training[0]['price'] . '+' . $training[0]['tax'] . ')';
                                            } else {
                                                echo 'Free Training';
                                            } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Location</th>
                                    <td>
                                        <?php echo $training[0]['location']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Training Image</th>
                                    <td>
                                        <?php if ($training[0]['image'] != '') { ?>
                                        <img src="<?php echo ASSETS_URL . 'images/uploads/' . $training[0]['image']; ?>" height="50" width="50">
                                        <?php } else {
                                                echo '--';
                                            } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Photo of Venue</th>
                                    <td>
                                        <?php if ($training[0]['venue_photo'] != '') { ?>
                                        <img src="<?php echo ASSETS_URL . 'images/uploads/' . $training[0]['venue_photo']; ?>" height="50" width="50">
                                        <?php } else {
                                                echo '--';
                                            } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Host Name</th>
                                    <td>
                                        <?php echo $training[0]['host']; ?>
                                    </td>
                                </tr>
                                <?php if ($training[0]['training_type'] == 1) { ?>
                                <tr>
                                    <th style="width:25%; text-align: left;">About Host</th>
                                    <td>
                                        <?php echo $training[0]['about_host']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Attach Logo </th>
                                    <td>
                                        <?php if ($training[0]['attach_logo'] != '') { ?>
                                        <img src="<?php echo ASSETS_URL . 'images/uploads/' . $training[0]['attach_logo']; ?>" height="50" width="50">
                                        <?php } else {
                                                    echo '--';
                                                } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Attached Background Photo</th>
                                    <td>
                                        <?php if ($training[0]['background_image'] != '') { ?>
                                        <img src="<?php echo ASSETS_URL . 'images/uploads/' . $training[0]['background_image']; ?>" height="50" width="50">
                                        <?php } else {
                                                    echo '--';
                                                } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Attached Promo Video</th>
                                    <td>
                                        <?php if ($training[0]['video'] != '') { ?>
                                        <!-- <img src="<?php echo ASSETS_URL . 'images/uploads/' . $training[0]['video']; ?>" height="50" width="50"> -->
                                        <a target="_blank" href="<?php echo $training[0]['video']; ?>"><i
                                                title="Click here to play video" style="font-size: 30px;"
                                                class="fa fa-youtube-play btn btn-danger" aria-hidden="true"></i></a>
                                        <?php } else {
                                                    echo '--';
                                                } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th style="width:25%; text-align: left;">Contact Person</th>
                                    <td>
                                        <?php echo $training[0]['contact_person']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Email</th>
                                    <td>
                                        <?php echo $training[0]['email']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Phone Number</th>
                                    <td>
                                        <?php echo $training[0]['phone']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">CP Number</th>
                                    <td>
                                        <?php echo $training[0]['cp_number']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Name of (Training committee Chairman)</th>
                                    <td>
                                        <?php echo $training[0]['chairman']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Position</th>
                                    <td>
                                        <?php echo $training[0]['position']; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div id="tra-overview" class="tab-pane fade">
                        <h3 class="border-title text-left">Overview
                            <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-overview');"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <tr>
                                    <th style="width:25%; text-align: left;">Description</th>
                                    <td>
                                        <?php echo $training[0]['description']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Objectives</th>
                                    <td>
                                        <?php echo $training[0]['objectives']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Methodologies</th>
                                    <td>
                                        <?php echo $training[0]['methodologies']; ?>
                                    </td>
                                </tr>
                                <?php if ($training[0]['training_type'] == 1 && $training[0]['background_image'] != '') { ?>
                                <tr>
                                    <th style="width:25%; text-align: left;">Speaker's Page Background Image</th>
                                    <td><img src="<?php echo ASSETS_URL . 'images/uploads/' . $training[0]['background_image']; ?>" width="150"></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th style="width:25%; text-align: left;">Participants</th>
                                    <?php $catArrid = explode(',', $training[0]['participants']);
                                        $catArrName = $this->db->where_in('id', $catArrid)->get('tbl_category')->result_array();
                                        $abc = array_column($catArrName, 'cat_name');
                                        $catStrName = implode(', ', $abc); ?>
                                    <td>
                                        <?php echo $catStrName; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:25%; text-align: left;">Item/s to bring</th>
                                    <td>
                                        <?php echo $training[0]['item_to_bring']; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div id="tra-speaker" class="tab-pane fade">
                        <h3 class="border-title text-left">Speakers
                            <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-speaker');"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </h3>
                        <?php $training = $this->user->getspeakers('tbl_training_speaker', 'training_id', $tid);
                                foreach ($training as $key => $value){ 
                                	$this->db->where('speaker_id',$value['id']);
                            $schedules = $this->user->get_record_by_field_name_all_record('tbl_training_schedule', 'training_id', $tid);?>

                        <div class="speaker-box" style="clear: both; padding-top: 40px;">
                            <div class="speaker-main">
                                <div class="speaker-profile" style="width: 20%;float: left; height:200px">
                                    <img style="width: 100%; height: 100%; object-fit: cover; object-position: top;" src="<?php echo base_url('/assets/images/uploads/').$value['speaker_image']; ?>" alt="">
                                </div>
                                <div class="speaker-profile-dtl" style="width: 70%;  float: left; padding-left: 36px;">
                                    <div class="table-responsive">
                                        <table class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <td style="border:none; font-size: 18px;"> <strong> Topic:</strong>
                                                    </td>
                                                    <td style="border:none; font-size: 18px;">
                                                        <?php echo $schedules[0]['topic']; ?>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td style="border:none; font-size: 18px;"><strong>Name:</strong>
                                                    </td>
                                                    <td style="border:none; font-size: 18px;">
                                                        <?php echo $value['speaker_name']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border:none; font-size: 18px;"><strong>email:</strong>
                                                    </td>
                                                    <td style="border:none; font-size: 18px;">
                                                        <?php if($value['speaker_email']){ echo $value['speaker_email']; }else{ echo '--'; } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border:none; font-size: 18px;"><strong>Position:</strong>
                                                    </td>
                                                    <td style="border:none; font-size: 18px;">
                                                        <?php echo $value['position']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border:none; font-size: 18px;">
                                                        <strong>Institution:</strong></td>
                                                    <td style="border:none; font-size: 18px;">
                                                        <?php echo $value['insititution']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border:none; font-size: 18px;"><strong>Profile:</strong>
                                                    </td>
                                                    <td style="border:none; font-size: 18px;">
                                                        <?php echo $value['speaker_description']; ?>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="speaker-profile-img" style="width: 100%; clear: both; padding-top:50px;">
                                <?php $where = array('training_id' => $tid, 'speaker_id' => $value['id']);
                                        $powerpoint = $this->user->get_record_by_multi_field_name('tbl_speaker_powerpoint', $where); 
                                      
                                        if (!empty($powerpoint[0]['images'])) {
                                            $pid = $powerpoint[0]['id'];
                                            $trid = $powerpoint[0]['training_id'];
                                            $explodedData = explode('##', $powerpoint[0]['images']);
                                            foreach ($explodedData as $key => $val1) { ?>

                                <div class="speaker-profile-img-dtl" style="width: 23%; height:200px; float:left; margin-right: 12px; margin-bottom: 20px;">
                                    <img style="width: 100%; height:100%;  object-fit: cover; object-position: top;" src="<?php echo BASE_URL . 'assets/images/uploads/' . $val1; ?>" alt="">
                                </div>
                                <?php } } else { echo 'No Presentation Found!'; } ?>
                            </div>
                        </div>

                        <?php } ?>

                    </div>

                    <div id="tra-schedule" class="tab-pane fade">
                        <h3 class="border-title text-left">Training Schedule<a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-schedule');"><i
                                    class="fa fa-print" aria-hidden="true"></i></a></h3>

                        <?php $this->db->group_by("schedule_date");
                            $trainings = $this->user->get_record_by_field_name_all_record('tbl_training_schedule', 'training_id', $tid);
                            $alldates = array_column($trainings, 'schedule_date');
                            $count = count($alldates);

                            for ($i = 0; $i < $count; $i++) {
                                $day = $i + 1;
                                $training = $this->user->get_record_by_field_name_all_record('tbl_training_schedule', array('training_id' => $tid, 'schedule_date' => $alldates[$i]), '');
                            ?>
                        <?php if($count = 1){ ?>
                        <h4 class="border-title text-left">Schedule
                            <?php echo '(' . date('F d, Y', strtotime($alldates[$i])) . ')'; ?>
                        </h4>
                        <?php }else{ ?>
                        <h4 class="border-title text-left">Schedule day
                            <?php echo $day . '(' . date('F d, Y', strtotime($alldates[$i])) . ')'; ?>
                        </h4>
                        <?php } ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered tra-fillter" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style=" border-bottom: 1px solid black;">No.</th>
                                        <th style=" border-bottom: 1px solid black;text-align: left;">Schedule Date</th>
                                        <th style=" border-bottom: 1px solid black;text-align: center;">Start Time</th>
                                        <th style=" border-bottom: 1px solid black;text-align: center;">End Time</th>
                                        <th style=" border-bottom: 1px solid black;text-align: center;">Topic</th>
                                        <th style=" border-bottom: 1px solid black;text-align: center;">Speaker Name
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="row_position">
                                    <?php
                                            // echo'<pre>';print_r($training);die;
                                            foreach ($training as $key => $value) {
                                                $speaker = $this->user->get_record_by_field_name_all_record('tbl_training_speaker', 'id', $value['speaker_id']);
                                            ?>

                                        <tr>
                                            <td style=" border-bottom: 1px solid black;">
                                                <?php echo $key + 1; ?>.
                                            </td>
                                            <td style=" border-bottom: 1px solid black;text-align: left;">
                                                <?php echo $value['schedule_date']; ?>
                                            </td>
                                            <td style=" border-bottom: 1px solid black;text-align: center;">
                                                <?php echo date('H:i a', strtotime($value['schedule_start_time'])); ?>
                                            </td>
                                            <td style=" border-bottom: 1px solid black;text-align: center;">
                                                <?php echo date('H:i a', strtotime($value['schedule_end_time'])); ?>
                                            </td>
                                            <td style=" border-bottom: 1px solid black;text-align: center;">
                                                <?php echo $value['topic']; ?>
                                            </td>
                                            <td style=" border-bottom: 1px solid black;text-align: center;">
                                                <?php
                                                        if ($speaker[0]['speaker_name'] == "" || $value[0]['speaker_id']) {
                                                            echo $value['speaker_name'];
                                                        } else {
                                                            echo $speaker[0]['speaker_name'];
                                                        } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } ?>
                    </div>

                    <div id="tra-promotion" class="tab-pane fade">
                        <h3 class="border-title text-left">Promotion
                            <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-promotion');"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </h3>
                        <p>Your training will be labeled as featured at the training listing page.<br> It will appear like this: </p>

                        <div class="card" style="width: 25%; position: relative;">
                            <div class="corner" style="width: 0; height: 0; position: absolute; right: 0; border-top: 100px solid red; border-left: 100px solid transparent; z-index: 2;">
                            </div>
                            <span class="corner-text" style="position: absolute; top: 27px; right: -14px; width: 100px; text-transform: uppercase; color: white; text-align: center; font-size: 12px; letter-spacing: .5px; font-weight: 500; transform: rotate(45deg); display: block;z-index: 2;">Featured</span>
                            <img class="card-img-top" style="width: 100%" src="<?php echo ASSETS_URL . 'images/uploads/' . $training_image; ?>" alt="Training image cap">
                            <!-- <div class="card-body"><p class="card-text"></p></div> -->
                        </div>
                        <?php if ($training[0]['paid_status'] == 1) { ?>
                        <div class="col-sm-12 form-group" id="free">
                            <h3 class="border-title text-left">Regular Promotion Appearance</h3>
                            <img src="<?php echo ASSETS_URL . 'images/regularlisting.png'; ?>" alt="">
                        </div>
                        <?php } else { ?>
                        <div class="col-sm-12 form-group" id="featured">
                            <?php $dailyprices = $this->db->get_where('tbl_all_tax', array('id' => 2, 'status' => 1))->row_array();   ?>
                            <h5>Featured</h5>
                            <p>
                                <?php echo $dailyprices['text'] ?>
                            </p>
                            <h3 class="border-title text-left">Featured promotion appearance</h3>
                            <img src="<?php echo ASSETS_URL . 'images/uploads/' . $dailyprices['image']; ?>" alt="">
                        </div>
                        <?php } ?>
                    </div>

                    <div id="tra-template" class="tab-pane fade">
                        <h3 class="border-title text-left">Template
                            <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-template');"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </h3>
                        <?php if ($training[0]['training_type'] == 1) { ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="free-training-img">
                                    <input type="radio" id="control_01" name="select" value="1" checked>
                                    <label for="control_01">
                                        <img src="<?php echo ASSETS_URL . 'images/free-tag.jpg'; ?>" alt="">
                                    </label>
                                </div>
                                <a href="javascript:void(0);" class="btn btn-success" style="padding: 10px;border: 1px solid #000;text-decoration: none;" onclick="showdummy('free');">View Live Demo</a>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="free-training-img">
                                    <input type="radio" id="control_02" name="select" value="1" checked>
                                    <label for="control_01">
                                        <img src="<?php echo ASSETS_URL . 'images/uploads/template1.jpg'; ?>" alt="">
                                    </label>
                                </div>
                                <a href="javascript:void(0);" style="padding: 5px;border: 1px solid #000;text-decoration: none;" class="btn btn-success" onclick="showdummy('pro');">View Template Design &
                                    Sections</a>
                                <a href="<?php echo BASE_URL . 'pages/training_details/' . $training[0]['id']; ?>" style="padding: 5px;border: 1px solid #000;text-decoration: none;" class="btn btn-warning">View Live Training</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div id="tra-sponsor" class="tab-pane fade">
                        <h3 class="border-title text-left">Sponsors
                            <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-sponsor');"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </h3>

                        <div class="sponsor-main-box">
                            <ul style="padding:10px; border: 1px solid #f1f1f1;">
                                <?php $sponsor = $this->user->get_record_by_field_name_all_record('tbl_training_sponsors', 'training_id', $tid);
                                        foreach ($sponsor as $key => $value) { 
                                            if($key != 4){ $style = "margin-right: 17px;"; } else{ $style = ""; } ?>
                                <li style="list-style: none; display: inline-block; <?=$style;?> text-align: center;">
                                    <div class="committee-img" style="width: 200px; height: 200px; margin: 0 auto;">
                                        <img style=" border-radius: 50%; border: 5px solid #313c34; box-sizing: border-box; width: 100%; height: 100%; object-fit: cover; object-position: top;" src="<?php echo BASE_URL . 'assets/images/uploads/' . $value['sponsors_image']; ?>" alt="">
                                    </div>
                                    <div class="sponsor">
                                        <h4>
                                            <?php echo $value['sponsors_name']; ?>
                                        </h4>
                                        <p>
                                            <?php echo $value['urls']; ?>
                                        </p>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <div id="tra-committee" class="tab-pane fade">
                        <h3 class="border-title text-left">Committee
                            <a href="javascript:void(0);" class="btn btn-default" title="Print" onclick="printElem('tra-committee');"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </h3>

                        <div class="committee-main-box">
                            <ul style="padding:10px; border: 1px solid #f1f1f1">
                                <?php $comittee = $this->user->get_record_by_field_name_all_record('tbl_training_committee', 'training_id', $tid);
                                        foreach ($comittee as $key => $value) { 
                                            if($key != 4){ $style = "margin-right: 17px;"; } else{ $style = ""; } ?>
                                <li style="list-style: none; display: inline-block; <?=$style;?> text-align: center;">
                                    <div class="committee-img" style="width: 200px; height: 200px;">
                                        <img style=" border-radius: 50%; border: 5px solid #313c34; box-sizing: border-box; width: 100%; height: 100%; object-fit: cover; object-position: top;" src="<?php echo BASE_URL . 'assets/images/uploads/' . $value['committee_image']; ?>" alt="">
                                    </div>
                                    <div class="committee">
                                        <h4>
                                            <?php echo $value['committee_name']; ?>
                                        </h4>
                                        <p>
                                            <?php echo $value['degination']; ?>
                                        </p>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>

                    <div id="tra-print" class="tab-pane fade">
                        <h3 class="border-title text-left">Printable Training Report</h3>
                        <!-- <p><b>Print this hole training by clicking on <a href="javascript:void(0);" class="btn btn-primary" onclick="printElem('selector');"><i class="fa fa-print" aria-hidden="true"></i></a> icon.</b></p> -->
                        <div class="table-responsive">
                            <table class="table ">
                                <tr>
                                    <th>Cover Page : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-cover_page');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <tr>
                                    <th>Table of contents : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-table_content');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <tr>
                                    <th>Participants : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-participants');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <!-- <tr>
                                        <th>Demographics : </th><td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-demographics');"><i class="fa fa-print" aria-hidden="true"></i> Print</a></td>
                                    </tr> -->
                                <tr>
                                    <th>Certificate : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-certificate');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <tr>
                                    <th>Evaluation : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('evaluation-report');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <tr>
                                    <th>General Information : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-genral');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <tr>
                                    <th>Overview : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-overview');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <tr>
                                    <th>Speaker & Lessons: </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-speaker');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <tr>
                                    <th>Schedule : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-schedule');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <?php if($under_insititution == '0'){ ?>
                                <tr>
                                    <th>Promotion : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-promotion');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th>Template : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-template');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <?php if ($training[0]['training_type'] == 1) { ?>
                                <tr>
                                    <th>Sponsor : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-sponsor');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <tr>
                                    <th>Committee : </th>
                                    <td><a href="javascript:void(0);" class="btn btn-primary mb-1" onclick="printElem('tra-committee');"><i class="fa fa-print"
                                                aria-hidden="true"></i> Print</a></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="dummyTraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel"><span id="tversion"></span></h5>
            </div>
            <div class="modal-body">
                <img src="" id="DummyTrainingImg">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="finalCertificate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">view training certificate</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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

<div class="modal fade modal-fullscreen" id="changeRegisrationStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Registration Status</h4>
            </div>
            <?php echo form_open('provider/registraition_status'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <p class="modal-radio">
                        <label>Open
                            <input type="radio" name="status" value="1" <?php if ($registration_status==1) {
                                echo 'checked' ; } ?>>
                            <input type="hidden" name="tid" value="<?php echo $tid; ?>">
                        </label>
                    </p>
                    <p class="modal-radio">
                        <label>Close
                            <input type="radio" name="status" value="0" <?php if ($registration_status==0) {
                                echo 'checked' ; } ?>>
                        </label>
                    </p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="submit">OK</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="markAttendance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Attendance</h4>
            </div>
            <?php echo form_open('provider/presentstatus'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <p class="modal-radio">
                        <label>Present
                            <input type="radio" name="status" value="1" id="pstatus" <?php //if(true){ echo'checked'; }
                                ?>>
                            <input type="hidden" name="tid" id="tid" value="">
                            <input type="hidden" name="tableid" id="tableid" value="">
                        </label>
                    </p>
                    <p class="modal-radio">
                        <label>Pending (Absent)
                            <input type="radio" name="status" value="0" id="astatus" <?php //if(true){ echo'checked'; }
                                ?>>
                        </label>
                    </p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="submit">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.tra-fillter').DataTable({
            "pageLength": 50
        });
        $('.input-sm').css("float", "right");
        $('.previous').css("float", "right");
        $('.paginate_button').css("float", "right");
        $('.next').css("float", "right");

        var status = '<?php echo $registration_status; ?>';
        // alert(status);
        if (status === 1) {
            $('#title-for-registration').html('Open');
            $('#title-for-registration').addClass('btn-success');
        } else {
            $('#title-for-registration').html('Close');
            $('#title-for-registration').addClass('btn-danger');
        }



        $('#email_evaluation').on('click', '.get-speaker-email', function() {
            var speakerEmail = $(this).attr('id');
            var content = document.getElementById('evaluation-report').innerHTML;
            var to = speakerEmail;
            var subject = "Training Evaluation Report";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url("Provider/sendEvaluationMail/"); ?>',
                data: {
                    to: to,
                    subject: subject,
                    content: content
                },
                success: function(result) {
                    alert(result);

                }
            });
        });


    });

    function preview_certificate(uid, tid) {
        var tid = '<?php echo $tid; ?>';
        var uid = '<?php echo $userid; ?>';
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("provider/preview_certificate"); ?>',
            data: {
                tid: tid,
                uid: uid
            },
            beforeSend: function() {
                $('#Preview_button').val('Please wait...');
            },
            success: function(result) {
                $('#certinutan').html(result);
                // $('#certificate-preview').html(result);
                $('#finalCertificate').modal('show');

            }
        });

    }

    function speaker_name(speaker_name, email, idd) {
        // alert(speaker_name +','+ email +','+ idd);
        var speakerEmail = email;
        if (speaker_name == "SYMPOSIUM") {
            types = 2;
        } else {
            types = 1;
        }

        $('#speaker_name').html(speaker_name);
        $('#commentdata').html('Please wait...');
        var trid = "<?php echo $tid; ?>";

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('pages/getcomment'); ?>",
            data: {
                types: types,
                trid: trid,
                idd: idd
            },
            success: function(result) {
                $("#commentdata").html(result);
                $("#speaker_section").html('<a href="javascript:void(0);" class="btn btn-default pull-right" title="Print" onclick="printElem(\'evaluation-report\');"><i class="fa fa-print" aria-hidden="true"></i></a>');
                $("#email_evaluation").html('<a href="javascript:void(0);" class="btn btn-default pull-right get-speaker-email" title="Email" id="' + email + '"><i class="fa fa-envelope" aria-hidden="true"></i></a>');
            }
        });
        return false;
    }
    speaker_name('<?php echo $tspeaker[0]['
        speaker_name ']; ?>', '<?php echo $tspeaker[0]['
        speaker_email ']; ?>', '<?php echo $tspeaker[0]['
        id ']; ?>');

    function showdummy(version) {
        if (version == 'free') {
            $('#DummyTrainingImg').attr('src', "<?php echo ASSETS_URL . 'images/training_dummy/dummy_free.png'; ?>");
            $('#tversion').html('Preview of FREE Training page');
        } else {
            $('#DummyTrainingImg').attr('src', "<?php echo ASSETS_URL . 'images/training_dummy/dummy_pro.png'; ?>");
            $('#tversion').html('Pro Version Template Design and Sections');
        }
        $('#dummyTraining').modal('show');
    }

    function printElem(divId) {
        var content = document.getElementById(divId).innerHTML;
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        mywindow.close();
        return true;
    }

    function changeRegisrationStatus(tid, status) {
        var total_limit = '<?php echo $total_limit; ?>';
        var registered = '<?php echo count($registered); ?>';
        var additionalp = parseInt(total_limit) - parseInt(registered);
        // alert(additionalp);
        $('#changeRegisrationStatus').modal('show');
        $('#registered').html(additionalp);
    }

    function markAttendance(id, tid, status) {
        // alert(id+', '+tid+', '+status)
        $('#markAttendance').modal('show');
        $('#tableid').val(id);
        $('#tid').val(tid);
        if (status == 1) {
            $('#pstatus').val(status).attr('checked', 'checked');
        } else {
            $('#astatus').val(status).attr('checked', 'checked');
        }
    }
</script>