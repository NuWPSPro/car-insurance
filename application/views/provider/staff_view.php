<?php 

        $firstlogin = $this->session->userdata('logged_in')['logged_in'];

        $professionId = $this->session->userdata('logged_in')['profession']; 

        $Idd = $this->session->userdata('logged_in')['id'];

        $professionalId = $this->uri->segment(3);

        $parent = $this->db->get_where('tbl_user',array('id'=>$professionalId))->row_array(); 

        $unit = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_units','user_id',$Idd);

        $this->db->limit(10, 1);

        $units = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_units','user_id',$Idd);

        // $units = $unit;

        // echo $this->db->last_query();

        $unit = $unit[0]['unit'];

        $grandSome = 0;

        $sum  = 0;

        $sum1 = 0; 

        $currentplan = $currentplanArr->version_type; 

        // $checkactiveplanArr = $this->professional_model->checkactiveplan($this->session->userdata('logged_in')['id']);   

        // $condition = ($checkactiveplanArr->version_type == 1)?'':'';

        //$this->load->view('template/picture');
       //print_r($unit_staff_list);

      // $sum = array_sum(array_column($purchase_list,'units'));

         $sum1 = array_sum(array_column($previous_certificate,'units'));

                    // $sum2 = array_sum(array_column($training_certificate,'units'));

                    // $sum3 = array_sum(array_column($course_certificate,'units'));

                    // $grandSome = $sum1+$sum2+$sum3;
        $specificCount = count(array_column($specific,'category'));
        $generalCount = count(array_column($general,'category'));
                    $grandSome = $sum1; ?>



<div class="innerContent dashboard-inner">

    <div class="container">

        <div class="row">

            <?php $this->load->view('provider/sidebar'); ?>

            <div class="col-sm-9">

            <div class="clearfix">
                <h3 class="border-title pull-left">Staff CE Record </h3>
                <a href="<?php echo base_url('provider/staffcerecords'); ?>" class="btn btn-primary pull-right">Back</a>
            </div>

            <div class="professionals-banner mb-5">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <?php $image = ASSETS_URL.'images/uploads/'.$parent['image']; ?>
                        <div class="image"> <img src="<?=$image;?>?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" class="rounded" width="155"> </div>
                        <div class="ml-3 w-100">
                            <h4 class="mb-0 mt-0"><?php echo $parent['name']; ?></h4>
                                <div class="d-flex flex-column text-danger"> Profession : <?=$parent['profession'];?> </div>
                        </div>
                    </div>
                </div>
                

                    <div class="">

                        <div class="row">


                            <div class="col-sm-12">

                                <div class="banner-count-desc p-3">

                                    <div class="mainbox">

                                        <div class="row ">

                                            <div class="col-md-3">

                                                <div class=" text-center item">

                                                    <div class="icon-container" style="width: 153px;">
                                                        <?php 
                                                        if(empty($unit_staff_list['unit'])){
                                                            echo 0;
                                                        }else{ 
                                                            echo $unit_staff_list['unit']; } ?>
                                                        <br> Units</div>
                                                    <h2>Total REQUIRED</h2>

                                                    <div class="col-md-6">

                                                        <div class="btn-primary">
                                                            <?php echo $unit_staff_list['specific_target']; ?>
                                                        </div>        

                                                        <span style="color:#000;">Specific</span>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="btn-primary">
                                                            <?php echo $unit_staff_list['gernal_target']; ?>
                                                        </div>
                                                          
                                                        <span style="color:#000;">General</span>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class=" text-center item">

                                                    <div class="icon-container" style="width: 153px;">

                                                       <?php echo $grandSome; ?>
                                                       <br> Units</div>

                                                    <h2>Total OBTAINED</h2>

                                                    <div class="col-md-6">

                                                        <div class="btn-primary"><?php echo $specificCount; ?></div>

                                                        <span style="color:#000;">Specific</span>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="btn-primary"><?php echo $generalCount; ?></div>

                                                        <span style="color:#000;">General</span>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class=" text-center item">

                                                    <div class="icon-container" style="width: 153px;">
                                                        <?php 
                                                     $grandUnit = $unit_staff_list['unit'] - $grandSome;

                                                     echo $grandUnit; ?>
                                                     <br> Units</div>

                                                    <h2>Total NEEDED</h2>

                                                    <div class="col-md-6">

                                                        <div class="btn-primary"><?php echo $unit_staff_list['specific_target'] - $specificCount; ?></div>

                                                        <span style="color:#000;">Specific</span>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="btn-primary"><?php echo $unit_staff_list['gernal_target']- $generalCount; ?></div>

                                                        <span style="color:#000;">General</span>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-3 text-center item">
                                                <div class="icon-container" style="background:#43c300;width: 160px;">
                                                    <?php if($unit_staff_list['unit'] > $grandSome ){
                                                        echo 'On Completion';
                                                    }else{
                                                        echo 'Completed';
                                                    }?>
                                                </div>

                                                <h2>Status</h2>

                                                <br>

                                            </div>

                                        </div>

                                        <!-- <div class="col-md-1">

                            <div class="text-center">

                                <button class="btn btn-primary" onclick="edittragetunins();"><i class="fa fa-pencil"

                                        aria-hidden="true"></i></button>

                            </div>

                        </div> -->

                        <div class="col-md-5">
                            <?php if($staff_date['startdate'] != '0000-00-00'){ ?>
                            <span style="color:#000; display: block; padding-top: 7px; width:500px;">Period Covered:
                            <b><?php echo date('jS F Y',strtotime($staff_date['startdate']));?> to 
                            <?php echo date('jS F Y',strtotime($staff_date['enddate'])); ?></b></span>
                            <?php } ?>
                        </div>



                         <!-- <div class="col-md-3">

                            <button class="btn btn-primary" onclick="homepopup();">ADD CE UNITS OR CONTACT

                                HOURS</button>

                        </div> -->

                                    </div>

                                    <!-- <div class="col-md-12" style=" background: #fff; border: 1px #2d67eb solid; border-radius: 5px; height: 20px;

                margin-top:51px; padding:0px;">

                        <div class="traker"

                            style="text-align:right; background:green; margin:0px;padding-right:7px;width:0%;height:100%;">

                            0 %</div>

                    </div> -->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <?php echo $this->session->flashdata('response'); ?>

                <div class="panel panel-default">

                    <div class="panel-body bg-blue border-radius-5">

                        <h3 class="mt-0 text-white text-left">MY CERTIFICATES RECORD
                        <a href="javascript:void(0)" class="btn btn-warning pull-right addProfCertificate">Add Certificate</a>
                        </h3>

                        <?php if($currentplan > 1){ ?>

                        <div class="">

                            <table class="table bg-white border-radius-5 overflow-hidden">

                                <thead>

                                    <tr>

                                        <th>Required CE Units/Contact Hours</th>

                                        <th>Total Units/Contact Hours Obtained</th>

                                        <th>Balance</th>

                                        <th>Status</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td valign="middle">

                                            <?php if($unit) { echo $unit; } else { echo "0"; } ?> Units</td>

                                        <td valign="middle">

                                            <?php echo $grandSome; ?> Units</td>

                                        <td valign="middle">

                                            <?php 

                                             $grandUnit = $unit - $grandSome;

                                             echo $grandUnit; ?> Units</td>



                                        <?php if($grandUnit <= 0 && $firstlogin == 0){ ?>

                                        <?php //if($grandUnit <= 0){ ?>

                                        <?php }elseif($grandUnit <= 0){ ?>

                                        <script type="text/javascript">

                                            $(document).ready(function () {

                                                $("#upgradeunit").modal();

                                            });

                                        </script>

                                        <?php }else{ } ?>



                                        <td>

                                            <?php if($grandSome >= $unit){ ?>

                                            <button class="btn btn-success">Completed</button>

                                            <?php } else { ?>

                                            <button class="btn btn-primary">On Completion</button>

                                            <?php } ?>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <?php } ?>





                        <div class="text-center" style="display: none;">

                            <p>Year :

                                <select>

                                    <?php for($i=2015;$i<=date("Y");$i++){ 

                                    echo'<option>'.$i.'</option>';

                                    } ?>

                                </select>

                            </p>

                        </div>





                        <div class="panel panel-default panel-table mb-0">



                            <div class="panel-heading">

                                <button type="button" class="btn btn-success" id="btn_all"

                                    onclick="showrecords('all');">ALL</button>

                                <button type="button" class="btn" id="btn_specific"

                                    onclick="showrecords('specific');">SPECIFIC (<?=count($specific)?>)</button>

                                <button type="button" class="btn" id="btn_general"

                                    onclick="showrecords('general');">GENERAL (<?=count($general)?>)</button>

                                <!-- <button type="button" class="btn" id="btn_general" onclick="showrecords('general');">ISSUED FROM (<?=count($general)?>)</button>  -->

                                <div class="dropdown">

                                    <button class="dropbtn">ISSUED FROM (<?=count($previous_certificate); ?>)</button>

                                    <div class="dropdown-content">

                                        <a href="#" onclick="showrecords('onlinecourse');">Online Course</a>

                                        <a href="#" onclick="showrecords('training');">Training</a>

                                    </div>

                                </div>

                            </div>

                            <?php

                    $commanArr = array();

                    foreach($previous_certificate as $key => $value ){

                         if($value['category']=='specific'){

                            $category = 'Specific';

                        }elseif($value['category']=='general'){

                            $category = 'General';

                        }else{

                            $category = '--';

                        }

                        $commanArr[] = array(

                            'id'             => $value['id'],

                            'course_name'    => $value['course_name'],

                            'units'          => $value['units'],

                            'issue_by'       => $value['issue_by'],

                            'issue_from'     => $value['issue_from'],

                            'start_date'     => date('Y-m-d', strtotime($value['start_date'])),

                            'category'       => $category,

                            'certificate_id' => $value['certificate_id'],

                            'certificate'    => $value['certificate']);

                    }

                ?>


<!-- ********************************** All Certificate Listing ******************************************* -->

                            <div id="all" style="color: black;">
                                <?php if(count($commanArr) > 0){ ?>
                                <table class="table mb-0 table-bordered">
                                    <tr>

                                        <th width="">No.</th>

                                        <th width="">Course/Training Name</th>

                                        <th width="">Units</th>

                                        <th width="">Issue By</th>

                                        <th width="">Issue From</th>

                                        <th width="">Date Issued</th>

                                        <th width="">Category</th>

                                        <th width="">Certificate No</th>

                                        <th width="">Action</th>

                                    </tr>

                                    <?php 

                            $count = 1;

                            $sum   = 0;

                            foreach ($commanArr as $key => $value) {

                                $sum = $sum+$value['units'];

                    if($value['category'] == "--"){ 

                        $fa_paper_plane = '<i class="fa fa-list-alt blink" aria-hidden="true"></i>'; 

                    }else{ 

                        $fa_paper_plane = '<i class="fa fa-list-alt" aria-hidden="true"></i>'; 

                    }

            echo '<tr>

                    <td align="center">'.$count.'.</td>

                    <td align="center">'.$value['course_name'].'</td>

                    <td align="center">'.$value['units'].'</td>

                    <td align="center">'.$value['issue_by'].'</td>

                    <td align="center">'.$value['issue_from'].'</td>

                    <td align="center">'.$value['start_date'].'</td>

                    <td align="center">'.$value['category'].'</td>

                    <td align="center">'.$value['certificate_id'].'</td>';  ?>

                                    <td class="action">

                                        <?php if($value['issue_by'] != 'CEonpoint'){ ?>

                                        <a target="_blank"

                                            href="<?php echo BASE_URL.'professional/download_image/'.$value['certificate']; ?>"

                                            title="Download"><i class="fa fa-download"></i></a>

                                        <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')"

                                            href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>

                                        <?php }else{ ?>

                                        <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>"

                                            title="Download"><i class="fa fa-download"></i></a>

                                        <a href="javascript:void(0);"

                                            onclick="preview_certificate('<?php echo $value['certificate_id'];?>')"

                                            title="View"><i class="fa fa-eye"></i></a>

                                        <?php } ?>

                                    </td>

                                    </tr>



                                    <?php $count++;  } ?>

                                    <tr class="bg-info">

                                        <td>&nbsp;</td>

                                        <td style="font-weight: bold;" class="text-primary">Total Units:</td>

                                        <td style="font-weight: bold;" align="center" class="text-primary">

                                            <?php echo $sum;?>

                                        </td>

                                        <td colspan="6"></td>

                                    </tr>



                                </table>

                                <?php } ?>

                            </div>



                            <script>

                                function myFunction() {

                                    window.print();

                                }

                            </script>





                            <!-- ********************************** Specific Certificate Listing ******************************************* -->





                            <div id="specific" style="display: none; color: black;">

                                <?php if(count($specific) > 0){ ?>

                                <table class="table mb-0">

                                    <tr>

                                        <th width="5%">No.</th>

                                        <th width="30%">Training Name</th>

                                        <th width="5%">Units</th>

                                        <th width="15%">Date Started</th>

                                        <th width="10%">Certificate No</th>

                                        <th width="15%">Action</th>

                                    </tr>

                                    <?php   $count = 1;

                        $add   = 0;

                        foreach ($specific as $key => $value) {

                            $add = $add+$value['units'];

                            // print_r($sum);

                 echo '<tr>

                            <td align="center">'.$count.'.</td>

                            <td>'.$value['course_name'].'</td>

                            <td align="center">'.$value['units'].'</td>

                            <td>'.$value['start_date'].'</td> 

                            <td>'.$value['certificate_id'].'</td>';

                            ?>

                                    <td class="action">

                                        <a href="javascript:void(0)" title="Change Category"

                                            onclick="changecategory('<?php echo $value['id']; ?>','1')">

                                            <i class="fa fa-list-alt" aria-hidden="true"></i></a>

                                        <a onclick="return confirm('Are you sure you want to send it to Institution.')"

                                            href="<?php //echo site_url('professional/sendtoinstitution/'.$value['id']); ?>"

                                            title="Send">

                                            <i class="fa fa-paper-plane"></i></a>

                                        <?php if($value['issue_by'] != 'CEonpoint'){ ?>

                                        <a target="_blank"

                                            href="<?php echo BASE_URL.'professional/download_image/'.$value['certificate']; ?>"

                                            title="Download"><i class="fa fa-download"></i></a>

                                        <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')"

                                            href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>

                                        <?php }else{ ?>

                                        <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>"

                                            title="Download"><i class="fa fa-download"></i></a>

                                        <a href="javascript:void(0);"

                                            onclick="preview_certificate('<?php echo $value['certificate_id'];?>')"

                                            title="View"><i class="fa fa-eye"></i></a>

                                        <?php } ?>

                                        <a onclick="return confirm('Are you sure you want to delete it.')"

                                            href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>"

                                            title="Delete">

                                            <i class="fa fa-trash"></i></a>

                                        <!--  <a href="#" title="Edit"><i class="fa fa-pencil"></i></a> -->

                                    </td>

                                    </tr>

                                    <?php $count++; } ?>

                                    <tr class="bg-info">

                                        <td></td>

                                        <td style="font-weight: bold;" class="text-primary">Total Units:</td>

                                        <td style="font-weight: bold;" align="center" class="text-primary">

                                            <?php echo $add;?>

                                        </td>

                                        <td colspan="4"></td>

                                    </tr>

                                </table>

                                <?php } ?>

                            </div>





                            <!-- **********************************  General Certificate Listing ******************************************* -->





                            <div id="general" style="display: none; color: black;">



                                <?php if(count($general) > 0){ ?>



                                <table class="table mb-0">

                                    <tr>

                                        <th width="5%">No.</th>

                                        <th width="30%">Training Name</th>

                                        <th width="5%">Units</th>

                                        <th width="15%">Date Started</th>

                                        <th width="10%">Certificate No</th>

                                        <th width="15%">Action</th>

                                    </tr>

                                    <?php 

                            $count = 1;

                            $sum   = 0;

                            foreach ($general as $key => $value) {

                                $sum = $sum+$value['units'];

                        echo '<tr>

                            <td align="center">'.$count.'.</td>

                            <td>'.$value['course_name'].'</td>

                            <td align="center">'.$value['units'].'</td>

                            <td>'.$value['start_date'].'</td> 

                            <td>'.$value['certificate_id'].'</td>';

                            ?>



                                    <td class="action">



                                        <a href="javascript:void(0)" title="Change Category"

                                            onclick="changecategory('<?php echo $value['id']; ?>','1')">

                                            <i class="fa fa-list-alt" aria-hidden="true"></i></a>

                                        <a onclick="return confirm('Are you sure you want to send it to Institution.')"

                                            href="<?php // echo site_url('professional/sendtoinstitution/'.$value['id']); ?>"

                                            onclick="return alert('Coming Soon!'); " title="Send"><i

                                                class="fa fa-paper-plane"></i></a>

                                        <?php if($value['issue_by'] != 'CEonpoint'){ ?>

                                        <a target="_blank"

                                            href="<?php echo BASE_URL.'professional/download_image/'.$value['certificate']; ?>"

                                            title="Download"><i class="fa fa-download"></i></a>

                                        <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')"

                                            href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>

                                        <?php }else{ ?>

                                        <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>"

                                            title="Download"><i class="fa fa-download"></i></a>

                                        <a href="javascript:void(0);"

                                            onclick="preview_certificate('<?php echo $value['certificate_id'];?>')"

                                            title="View"><i class="fa fa-eye"></i></a>

                                        <?php } ?>

                                        <i class="fa fa-eye"></i></a>

                                        <a onclick="return confirm('Are you sure you want to delete it.')"

                                            href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>"

                                            title="Delete">

                                            <i class="fa fa-trash"></i></a>

                                        <!--  <a href="#" title="Edit"><i class="fa fa-pencil"></i></a> -->

                                    </td>

                                    </tr> <?php 

                                   $count++;

                                   } ?>

                                    <tr class="bg-info">

                                        <td></td>

                                        <td style="font-weight: bold;" class="text-primary">Total Units:</td>

                                        <td style="font-weight: bold;" align="center" class="text-primary">

                                            <?php echo $sum;?>

                                        </td>

                                        <td colspan="4"></td>

                                    </tr>

                                </table>

                                <?php } ?>

                            </div>

                            <!-- **********************************  Online course Certificate Listing ******************************************* -->



                            <div id="onlinecourse" style="display: none; color: black;">



                                <?php // if(count($course_certificate) > 0){ ?>

                                <?php if(count($previous_certificate) > 0){ ?>

                                <table class="table mb-0">

                                    <tr>

                                        <th width="5%">No.</th>

                                        <th width="30%">Course Name</th>

                                        <th width="5%">Units</th>

                                        <th width="15%">Date Started</th>

                                        <th width="15%">Category</th>

                                        <th width="10%">Certificate No</th>

                                        <th width="15%">Action</th>

                                    </tr>

                                    <?php 

                            $count = 1;

                            $sum   = 0;

                            foreach ($previous_certificate as $key => $value) {

                            if($value['issue_from']=='Online Course'){

                                if($value['category']==1 || $value['category']=='specific'){

                                    $category = 'Specific';

                                }elseif($value['category']==2 || $value['category']=='general'){

                                    $category = 'General';

                                }else{

                                    $category = '--';

                                }

                                if($category == "--"){ 

                                    $fa_paper_plane = '<i class="fa fa-list-alt blink" aria-hidden="true"></i>'; 

                                }else{ 

                                    $fa_paper_plane = '<i class="fa fa-list-alt" aria-hidden="true"></i>'; }

                                $sum = $sum+$value['units'];

                                $start_date = date('Y-m-d', strtotime($value['start_date']));



                        echo '<tr>

                            <td align="center">'.$count.'.</td>

                            <td>'.$value['course_name'].'</td>

                            <td align="center">'.$value['units'].'</td>

                            <td>'.$start_date.'</td> 

                            <td>'.$category.'</td> 

                            <td>'.$value['certificate_id'].'</td>';

                            ?>



                                    <td class="action">

                                        <a href="javascript:void(0)" title="Change Category"

                                            onclick="changecategory('<?php echo $value['id']; ?>','1')"><?php echo $fa_paper_plane; ?></a>

                                        <a onclick="return confirm('Are you sure you want to send it to Institution.')"

                                            href="<?php // echo site_url('professional/sendtoinstitution/'.$value['id']); ?>"

                                            onclick="return alert('Coming Soon!'); " title="Send">

                                            <i class="fa fa-paper-plane"></i></a>

                                        <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>"

                                            title="Download"><i class="fa fa-download"></i></a>

                                        <a href="javascript:void(0);"

                                            onclick="preview_certificate('<?php echo $value['certificate_id'];?>')"

                                            title="View"><i class="fa fa-eye"></i></a>

                                    </td>

                                    </tr>

                                    <?php $count++; } } ?>



                                    <tr class="bg-info">

                                        <td></td>

                                        <td style="font-weight: bold;" class="text-primary">Total Units:</td>

                                        <td style="font-weight: bold;" align="center" class="text-primary">

                                            <?php echo $sum;?>

                                        </td>

                                        <td colspan="4"></td>

                                    </tr>

                                </table>

                                <?php } ?>

                            </div>



                            <!-- **********************************  Training Certificate Listing ******************************************* -->



                            <div id="training" style="display: none; color: black;">

                                <?php if(count($previous_certificate) > 0){ ?>

                                <table class="table mb-0">

                                    <tr>

                                        <th width="5%">No.</th>

                                        <th width="30%">Training Name</th>

                                        <th width="5%">Units</th>

                                        <th width="15%">Date Started</th>

                                        <th width="15%">Category</th>

                                        <th width="10%">Certificate No</th>

                                        <th width="15%">Action</th>

                                    </tr>

                                    <?php 

                        $count = 1;

                        $sum   = 0;

                        foreach ($previous_certificate as $key => $value) {

                        if($value['issue_from']=='Training'){

                            if($value['category']==1 || $value['category']=='specific'){

                                    $category = 'Specific';

                                }elseif($value['category']==2 || $value['category']=='general'){

                                    $category = 'General';

                                }else{

                                    $category = '--';

                                }

                            if($category == "--"){ 

                                $fa_paper_plane = '<i class="fa fa-list-alt blink" aria-hidden="true"></i>'; 

                            }else{ 

                                $fa_paper_plane = '<i class="fa fa-list-alt" aria-hidden="true"></i>'; }

                        $sum = $sum+$value['units'];

                        $start_date = date('Y-m-d', strtotime($value['start_date']));

                  echo '<tr>

                                <td align="center">'.$count.'.</td>

                                <td>'.$value['course_name'].'</td>

                                <td align="center">'.$value['units'].'</td>

                                <td>'.$start_date.'</td> 

                                <td>'.$category.'</td> 

                                <td>'.$value['certificate_id'].'</td>';

                                ?>



                                    <td class="action">

                                        <a href="javascript:void(0)" title="Change Category"

                                            onclick="changecategory('<?php echo $value['id']; ?>','1')"><?php echo $fa_paper_plane; ?></a>

                                        <a onclick="return confirm('Are you sure you want to send it to Institution.')"

                                            href="<?php // echo site_url('professional/sendtoinstitution/'.$value['id']); ?>"

                                            onclick="return alert('Coming Soon!'); " title="Send">

                                            <i class="fa fa-paper-plane"></i></a>

                                        <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>"

                                            title="Download"><i class="fa fa-download"></i></a>

                                        <a href="javascript:void(0);"

                                            onclick="preview_certificate('<?php echo $value['certificate_id'];?>')"

                                            title="View"><i class="fa fa-eye"></i></a>

                                    </td>

                                    </tr>

                                    <?php $count++; } } ?>

                                    <tr class="bg-info">

                                        <td></td>

                                        <td style="font-weight: bold;" class="text-primary">Total Units:</td>

                                        <td style="font-weight: bold;" align="center" class="text-primary">

                                            <?php echo $sum;?></td>

                                        <td colspan="4"></td>

                                    </tr>

                                </table>

                                <?php } ?>

                            </div>



                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div id="uploadCertificatebrcep" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Upload Certificate on behalf of Staff (Professional)</h4>
					</div>
					  <form action="<?php echo base_url('provider/upload_certificate/').$this->uri->segment(3); ?>" method="post" enctype="multipart/form-data" name="ucexisting" id="ucexisting">
						<div class="modal-body"> 

							<p>
								<label>Certificate No </label>
								<input name="certi_no" value="" size="20" type="text" class="form-control">
								<span class="error"></span>
							</p>
							<p>
								<label>Course Title <span class="required text-danger"> * </span> </label>
								<input name="course_name" value="" size="20" type="text" class="form-control" required>
								<span class="error"></span>
							</p>
							<p>
								<label>Course Units <span class="required text-danger"> * </span> </label>
								<input name="course_unit" value="" size="20" type="number" class="form-control" required>
								<span class="error"></span>
							</p>

                            <div class="row" >
                                <div class="col-md-12" >
                                    <p >
                                        <label >Date Issued <span class="required text-danger" > * </span> </label>
                                        <input name="course_start_date" value="" max="2021-07-06" type="date" class="form-control" required="" >
                                        <span class="error" ></span>
                                    </p>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-md-6" >
                                    <p >
                                        <label >Category</label>
                                        <select name="category" id="category1" class="form-control" >
                                            <option value="" selected="" >Please Select</option>
                                            <option value="general" >General</option>
                                            <option value="specific" >Specific</option>
                                        </select>
                                        <span class="error" ></span>
                                    </p>
                                </div>
                                <div class="col-md-6" >
                                    <p >
                                        <label >Issued From<span class="required text-danger" > * </span> </label>
                                        <select name="issue_from" id="issue_from" class="form-control" required="" >
                                            <option value="" selected="" >Please Select</option>
                                            <option value="Online Course" >Online Course</option>
                                            <option value="Training" >Training</option>
                                        </select>
                                        <span class="error" ></span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="row" >
                                <div class="col-md-6" >
                                    <p >
                                        <label >Issued By<span class="required text-danger" > * </span> </label>
                                        <input name="issue_by" value="" type="text" class="form-control" required="" >

                                        <span class="error" ></span>
                                    </p>
                                </div>
                                <div class="col-md-6" >
                                    <p >
                                <label >Certificate <span class="required text-danger" > * </span> </label>
                                <input name="certificate" value="" size="20" type="file" class="form-control" required="" >
                                <span class="error" ></span>
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

    <!-- Modal -->
    <div id="myCertificateModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button onclick="myFunction()" style="float: left;" type="button"><i class="fa fa-print"></i></button> -->
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Certificate</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="" id="imagepreview" alt="Certificate Image">
                    </div>
                </div>
            </div>
        </div>
    </div>

<style type="text/css">
.dropbtn{background-color:#007ded;color:#fff;padding:4px;font-size:14px;border:none;border-radius:3px}.dropdown{position:relative;display:inline-block}.dropdown-content{display:none;position:absolute;background-color:#f1f1f1;min-width:160px;box-shadow:0 8px 16px 0 rgba(0,0,0,.2);z-index:1}.dropdown-content a{color:#000;padding:12px 16px;text-decoration:none;display:block}.dropdown-content a:hover{background-color:#ddd}.dropdown:hover .dropdown-content{display:block}.dropdown:hover .dropbtn{background-color:#3d66b0}
</style>

<script type="text/javascript">

    $(document).ready(function () {
        var first = '<?php if($firstlogin == 0){ ?>' + $("#upgradeunit").modal('hide');
        $("#upgradeunit_new").modal('show'); + '<?php } ?>';
        var pop = '<?php if($_REQUEST['
        success ']!=""){ ?>' + $("#promoteprofeesion").modal('show') + '<?php } ?>';
        var pop2 = '<?php if($_REQUEST['
        id ']=="success"){ ?>' + $("#uploadCertificateModal").modal('hide');
        $("#upgradesuccess").modal('show'); + '<?php } ?>';
    });
    $('.addProfCertificate').on('click',function(){
        $('#uploadCertificatebrcep').modal('show');
    });

    function changecategory(idd, types) {
        $('#form_id').val(idd);
        $('#form_type').val(types);
        $("#changecategoryDialog").modal();
    }

    function uploadcerti() { // this is not working go to header home and find checklogin
        $("#upgradesuccess").modal('hide');
        $("#uploadCertificateModal").modal('show');
    }

    function showrecords(cat) {
        $('#all').hide();
        $('#general').hide();
        $('#specific').hide();
        $('#onlinecourse').hide();
        $('#training').hide();
        $('#btn_all').removeClass('btn-success');
        $('#btn_general').removeClass('btn-success');
        $('#btn_specific').removeClass('btn-success');
        $('#' + cat).show();
        $('#btn_' + cat).addClass("btn-success");
    }

    function showrecords1(cat) {
        $('#all1').hide();
        $('#general1').hide();
        $('#specific1').hide();
        $('#btn_all1').removeClass('btn-success');
        $('#btn_general1').removeClass('btn-success');
        $('#btn_specific1').removeClass('btn-success');
        $('#' + cat).show();
        $('#btn_' + cat).addClass("btn-success");
    }
    /* document.addEventListener('contextmenu', event => event.preventDefault()); */

    function myFunction() {
        //window.print();
        printData();
    }

    function printData() {
        var printContents = document.getElementById('myModalpreviewImage11').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
       document.body.innerHTML = originalContents;
    }

    function preview_image(image) {
        document.getElementById('imagepreview').src = image;
        $("#myCertificateModal").modal()
    }





    function preview_certificate(certifiacte_no) {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()."users/certificate_download";?>',
                data: {
                    certifiacte_no: certifiacte_no
                },
                beforeSend: function () {
                    $("#filteredData22").html("");
                }

            }).done(function (result) {
                $("#filteredData22").html(result);
                $('#myModalcertificate').modal('show');
            });
        return false;
    }

</script>



