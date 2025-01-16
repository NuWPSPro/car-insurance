<?php   $professionId = $this->session->userdata('logged_in')['profession']; 
        $Idd = $this->session->userdata('logged_in')['id']; 
        $unit = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_units','user_id',$Idd);
        $unit = $unit[0]['unit'];
        $grandSome = 0;
        $sum  = 0;
        $sum1 = 0; 
        
$this->load->view('template/picture'); ?>
<style type="text/css">
    .dropbtn {
  background-color: #007ded;
  color: white;
  padding: 4px;
  font-size: 14px;
  border: none;
  border-radius: 3px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3d66b0;}

  .blink {
      animation: blink 2s steps(5, start) infinite;
      -webkit-animation: blink 1s steps(5, start) infinite;
    }
    @keyframes blink {
      to {
        visibility: hidden;
      }
    }
    @-webkit-keyframes blink {
      to {
        visibility: hidden;
      }
    }
</style>
<div class="innerContent dashboard-inner">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div>
            <?php $this->load->view('professional/sidebar'); ?>
           
        <div class="col-sm-8">
            <?php 
                // $sum = array_sum(array_column($purchase_list,'units'));
                $sum1 = array_sum(array_column($previous_certificate,'units'));
                $sum2 = array_sum(array_column($training_certificate,'units'));
                $sum3 = array_sum(array_column($course_certificate,'units'));
                // echo $sum3.'+'.$sum2.'+'.$sum1;
                $grandSome = $sum1+$sum2+$sum3; ?>

            <?php  if($this->session->flashdata('response') != '')
					{
                        echo $this->session->flashdata('response'); 
                    }  ?>


                <div class="panel panel-default panel-defaulttable">
                    <div class="panel-heading">
                        Pending Course / Training
                    </div>
                    <div class="">
                        <table class="table table-striped table-bordered mb-0">
                            <tr>
                                <th>No.</th>
                                <th>Course/Training Name</th>
                                <th>Date Purchased</th>
                                <th></th>
                            </tr>
                            <?php // echo'<pre>'; print_r($training_list);
                            $pending = array_merge($training_list,$purchase_list);
							$flage=1;
                            $sl=1;
                             // echo'<pre>'; print_r($pending);
                            foreach ($pending as $key => $value) {
                                     $this->db->where('user_id',$Idd);
                            $exam =  $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_exam','course_id',$value['cid']); 
                            
                            if($value['passing_marks'] > $exam[0]['percentages'] || empty($exam)){
							$flage++;	
                            ?>
                            <tr>
                                <td>
                                    <?php echo $sl;?>
                                </td>
                                <td>
                                    <?php echo $value['course_title'];?>
                                </td>
                                <td>
                                    <?php echo $value['added_on'];?>
                                </td>
                                <td>
                                    <?php if($value['passing_marks']){ ?>
                                        <a href="<?php echo site_url('pages/course_details/'.$value['cid'].'');?>" class="btn btn-info">Start Course</a>
                                    <?php }else{  
                                        echo '<a href="'.site_url('pages/training_details/'.$value['tid'].'').'" class="btn btn-primary">Training Info</a>';
                                     } ?>
                                </td>
                            </tr>
                            <?php $sl++; } ?>
                            <?php }  ?>
							<?php if($flage==1) { echo'<tr><th colspan="5">There is no pending course</tr>'; } ?>
                        </table>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-body bg-blue border-radius-5">
                    	<h3 class="mt-0 text-white text-left">MY CERTIFICATES RECORD</h3>
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
                                            <?php if($unit) {echo $unit;} else { echo "0";}?> Units</td>
                                        <td valign="middle">
                                            <?php echo $grandSome; ?> Units</td>
                                        <td valign="middle">
                                            <?php 
                                             $grandUnit = $unit - $grandSome;
                                             echo $grandUnit; ?> Units</td>

                                            <?php 
                                            if($grandUnit<=0){ 
                                            ?>
                                            <script type="text/javascript">
                                                
                                                $( document ).ready(function() {
                                                   $("#upgradeunit").modal();
												   
                                                });
                                            </script>
                                            <?php     
                                            }
                                            ?>

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
                      

                        <div class="text-center" style="display: none;">
                            <p>Year :
                                <select>
                                    <?php for($i=2015;$i<=date("Y");$i++){ 
                                    echo'<option>'.$i.'</option>';
                                    } ?>
                                    <!-- <option>2017</option>
                                    <option>2016</option> -->
                                </select>
                            </p>
                        </div>

						
                        <!-- <div class="panel panel-default panel-table" >
                            <div class="panel-heading">
                                1. ONLINE COURSES CERTIFICATES & UNITS
                            </div>
                            <div class="">
                                <?php
	                       // echo '<pre>';print_r($purchase_list);
                        if(count($purchase_list) > 0){
	                            ?>
                                <table class="table mb-0" style="color: #000;">
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="35%">Course Name</th>
                                        <th width="5%">Units</th>
                                        <th width="35%">Date Completed</th>
                                        <th width="35%">Certificate No</th>
                                        <th width="20%" class="text-center">Certificate</th>
                                    </tr>
                            <?php 
	                                   
	                                    $sum=0;
	                            foreach ($purchase_list as $key => $value) {

                                    $this->db->where('user_id',$value['user_id']);     
                                    $this->db->where('course_id',$value['cid']);     
                                    $this->db->order_by('id','DESC');     
                                    $exam = $this->db->get('tbl_exam')->result_array();                              
                                     // echo $this->db->last_query();
                                     // echo '<pre>';print_r($exam[0]['percentages']);
                                    $count = 1;
                                if($exam[0]['percentages'] >= $value['passing_marks']){
	                                   $sum = $sum+$value['units'];

	                                echo '<tr>
	                                    <td align="center">'.$count.'.</td>
	                                    <td>'.$value['course_title'].'</td>
	                                    <td align="center">'.$value['units'].'</td>
	                                    <td>'.$exam[0]['added_on'].'</td> 
	                                    <td>'.$exam[0]['certificate_id'].'</td>';
	                                    ?>
                                    <td class="action">
                                        <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $exam[0]['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                                        <a href="<?php echo site_url('pages/download_certificate/'.$exam[0]['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a></td>
                                    <?php 
	                                    ?>
                                    </tr>
                                    <?php  } ?>
                                    <?php $count++;  } ?>
                                    <tr class="bg-info">
                                        <td></td>
                                        <td style="font-weight: bold;" class="text-primary">Total Units:</td>
                                        <td style="font-weight: bold;" align="center" class="text-primary">
                                            <?php echo $sum;?>
                                        </td>
                                        <td colspan="3"></td>
                                    </tr>
                                </table>
                                <?php } ?>
                            </div>
                        </div> -->

        <div class="panel panel-default panel-table mb-0">

            <div class="panel-heading"> 
                  <button type="button" class="btn btn-success" id="btn_all" onclick="showrecords('all');">ALL</button>
                  <button type="button" class="btn" id="btn_specific" onclick="showrecords('specific');">SPECIFIC (<?=count($specific)?>)</button>
                  <button type="button" class="btn" id="btn_general" onclick="showrecords('general');">GENERAL (<?=count($general)?>)</button> 
                  <!-- <button type="button" class="btn" id="btn_general" onclick="showrecords('general');">ISSUED FROM (<?=count($general)?>)</button>  -->
                  <div class="dropdown">
                  <button class="dropbtn">ISSUED FROM (<?=count($course_certificate) + count($training_certificate); ?>)</button>
                  <div class="dropdown-content">
                    <a href="#" onclick="showrecords('onlinecourse');">Online Course (<?=count($course_certificate); ?>)</a>
                    <a href="#" onclick="showrecords('training');">Training (<?=count($training_certificate)?>)</a>
                  </div>
                </div>
                <button type="button" class="btn btn-danger pull-right" onclick="homepopup();">Add Needed CE Units/C.Hours</button> 
				<!--<button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#uploadCertificateModal">Add Cirtificate</button>-->
            </div>
                <?php
                    // $all = array_merge($course_certificate,$previous_certificate,$training_certificate);
                    // echo'<pre>'; print_r($previous_certificate);
                    $commanArr = array();
                    foreach($course_certificate as $key => $value ){
                        if($value['category']==1){
                            $category = 'Specific';
                        }elseif($value['category']==2){
                            $category = 'General';
                        }else{
                            $category = '--';
                        }


                        $commanArr[] = array(
                            'id'             => $value['id'],
                            'course_name'    => $value['course_name'],
                            'units'          => $value['units'],
                            'issue_by'       => 'CEonpoint',
                            'issue_from'     => 'Online Course',
                            'start_date'     => date('Y-m-d', strtotime($value['start_date'])),
                            'category'       => $category,
                            'certificate_id' => $value['certificate_id'],
                            'certificate'    => $value['certificate_id']);
                    }
                    foreach($previous_certificate as $key => $value ){
                        $commanArr[] = array(
                            'id'             => $value['id'],
                            'course_name'    => $value['course_name'],
                            'units'          => $value['units'],
                            'issue_by'       => $value['issue_by'],
                            'issue_from'     => $value['issue_from'],
                            'start_date'     => date('Y-m-d', strtotime($value['start_date'])),
                            'category'       => $value['category'],
                            'certificate_id' => $value['certificate_id'],
                            'certificate'    => $value['certificate']);
                    }
                    foreach($training_certificate as $key => $value ){
                        if($value['category']==1){
                            $category = 'Specific';
                        }elseif($value['category']==2){
                            $category = 'General';
                        }else{
                            $category = '--';
                        }

                      $commanArr[] = array(
                            'id'             => $value['id'],
                            'course_name'    => $value['course_name'],
                            'units'          => $value['units'],
                            'issue_by'       => 'CEonpoint',
                            'issue_from'     => 'Training',
                            'start_date'     => date('Y-m-d', strtotime($value['start_date'])),
                            'category'       => $category,
                            'certificate_id' => $value['certificate_id'],
                            'certificate'    => $value['certificate_id']);
                    }               
                   // echo'<pre>'; print_r($commanArr);
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
                        $fa_paper_plane = '<i class="fa fa-list-alt" aria-hidden="true"></i>'; }
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
                        <?php if($value['issue_by']!='CEonpoint'){ ?>

                        <a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','1')"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                        <a onclick="return confirm('Are you sure you want to send it to Institution.')" href="<?php echo site_url('professional/sendtoinstitution/'.$value['id']); ?>" title="Send"><i class="fa fa-paper-plane"></i></a> 
                        <a target="_blank" href="<?php echo BASE_URL;?>assets/images/uploads/<?php echo $value['certificate'];?>" title="Download"><i class="fa fa-download"></i></a>
                        <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a> 

                        <?php }else{ ?>
                           <?php if($value['issue_from']!='Training'){ ?>
                                 <a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','2')"><?php echo $fa_paper_plane; ?></a>
                            <?php    }else{ ?>
                                 <a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','3')"><?php echo $fa_paper_plane; ?></a>
                           <?php } ?>
                        <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                        <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>

                        <?php } ?>
                    </td>
                </tr>
            <?php $count++;  } ?>

            <!-- <?php   $uid = $this->session->userdata('logged_in')['username']; 
                    $where = array('email'=>$uid,'category_id'=>0);
                    $datas = $this->user->get_record_by_multi_field_name('tbl_training_book',$where);  
    			
                    foreach ($datas as $key => $value) {
                    $where1 = array('id'=>$value['training_seminar_id']); 
                    $trainingData = $this->user->get_record_by_multi_field_name('tbl_training',$where1); 
                    $sum = $sum + $trainingData[0]['units'];

                    if($value['certificate_id'] !=""){
                      $filename = $value['certificate_id'];
                    }

                echo '<tr>
                        <td align="center">'.$count.'.</td>
                        <td>'.$trainingData[0]['title'].'</td>
                        <td align="center">'.$trainingData[0]['units'].'</td>
						<td align="center">'.$this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_user','id',$value['user_id'])[0]['name'].'</td>
                        <td align="center">'.'Training'.'</td>
                        <td align="center">'.$value['start_date'].'</td>
                        <td align="center">'.$value['certificate_id'].'</td>
                        <td align="center">'.$value['category'].'</td>';
                        ?>
                        <td class="action">
                            <a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','2')"><i class="fa fa-list-alt" aria-hidden="true"></i></a> 
                            <a target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="Download"><i class="fa fa-download"></i></a>
                            <a  href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="View"><i class="fa fa-eye"></i></a>
                            <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete_training/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                             <a href="javascript:void(0)" onclick="myFunction()" title="Print"><i class="fa fa-print"></i></a>
                        </td>
                    </tr>
                <?php $count++; } ?>
 -->
                    <tr class="bg-info">
                        <td>&nbsp;</td>
                        <td  style="font-weight: bold;" class="text-primary">Total Units:</td>
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


            <div id="specific" style="display: none; color: black;" >
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
                                <a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','1')">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i></a> 
                                <a onclick="return confirm('Are you sure you want to send it to Institution.')" href="<?php echo site_url('professional/sendtoinstitution/'.$value['id']); ?>" title="Send">
                                    <i class="fa fa-paper-plane"></i></a> 
                                <a target="_blank" href="<?php echo BASE_URL;?>assets/images/uploads/<?php echo $value['certificate'];?>" title="Download">
                                    <i class="fa fa-download"></i></a>
                                <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View">
                                    <i class="fa fa-eye"></i></a>
                                <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete">
                                    <i class="fa fa-trash"></i></a>
                                <!--  <a href="#" title="Edit"><i class="fa fa-pencil"></i></a> -->
                            </td>
                        </tr>
                <?php $count++; } ?>


                <!-- <?php 
                        $uid = $this->session->userdata('logged_in')['username']; 
                        $where = array('email'=>$uid,'category_id'=>1);                 
                        $datas = $this->user->get_record_by_multi_field_name('tbl_training_book',$where);  
                        foreach ($datas as $key => $value) {
                         $where1 = array('id'=>$value['training_seminar_id']); 
                         $trainingData = $this->user->get_record_by_multi_field_name('tbl_training',$where1); 
                         $sum = $sum + $trainingData[0]['units'];
                        if($value['certificate_id'] !=""){
                          $filename = $value['certificate_id'];
                        }     

                 echo '<tr>
                            <td align="center">'.$count.'.</td>
                            <td>'.$trainingData[0]['title'].'</td>
                            <td align="center">'.$trainingData[0]['units'].'</td>
                            <td>'.$value['added_on'].'</td>
                            <td>'.$value['certificate_id'].'</td>';
                            ?>
                            <td class="action">
                                <a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','2')"><i class="fa fa-list-alt" aria-hidden="true"></i></a> 
                                <a target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="Download"><i class="fa fa-download"></i></a>
                                <a  href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="View"><i class="fa fa-eye"></i></a>
                                <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete_training/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                 <a href="javascript:void(0)" onclick="myFunction()" title="Print"><i class="fa fa-print"></i></a>
                            </td>
                        </tr>
                            <?php 
                            $count++;
                            } 
                            ?> -->
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

                                <a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','1')">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i></a> 
                                <a onclick="return confirm('Are you sure you want to send it to Institution.')" href="<?php // echo site_url('professional/sendtoinstitution/'.$value['id']); ?>" onclick="return alert('Coming Soon!'); " title="Send">
                                    <i class="fa fa-paper-plane"></i></a> 
                                <a target="_blank" href="<?php echo BASE_URL;?>assets/images/uploads/<?php echo $value['certificate'];?>" title="Download">
                                    <i class="fa fa-download"></i></a>
                                <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View">
                                    <i class="fa fa-eye"></i></a>
                                <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete">
                                    <i class="fa fa-trash"></i></a>
                            <!--  <a href="#" title="Edit"><i class="fa fa-pencil"></i></a> -->
                            </td>
                        </tr> <?php 
                                   $count++;
                                   } ?>



                       <!--  <?php 
                        $uid = $this->session->userdata('logged_in')['username']; 
                        $where = array('email'=>$uid,'category_id'=>2);                 
                        $datas = $this->user->get_record_by_multi_field_name('tbl_training_book',$where);  
                         foreach ($datas as $key => $value) {

                                

                         $where1 = array('id'=>$value['training_seminar_id']); 
                         $trainingData = $this->user->get_record_by_multi_field_name('tbl_training',$where1); 

                         $sum = $sum + $trainingData[0]['units'];

                         
                        if($value['certificate_id'] !=""){
                          $filename = $value['certificate_id'];
                        }
                                 

                        echo '<tr>
                            <td align="center">'.$count.'.</td>
                            <td>'.$trainingData[0]['title'].'</td>
                            <td align="center">'.$trainingData[0]['units'].'</td>
                            <td>'.$value['added_on'].'</td>
                            <td>'.$value['certificate_id'].'</td>';
                            ?>
                                    <td class="action">

                                         <a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','2')"><i class="fa fa-list-alt" aria-hidden="true"></i></a> 



                                        <a target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="Download"><i class="fa fa-download"></i></a>
                                        <a  href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="View"><i class="fa fa-eye"></i></a>
                                        <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete_training/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                     // <a href="javascript:void(0)" onclick="myFunction()" title="Print"><i class="fa fa-print"></i></a>
                                    </td>
                                    </tr>
                            <?php 
                            $count++;
                            } 
                            ?> -->

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
                            
			<?php if(count($course_certificate) > 0){ ?>
				<table class="table mb-0">
					<tr>
						<th width="5%">No.</th>
						<th width="30%">Course Name</th>
						<th width="5%">Units</th>
						<th width="15%">Date Started</th> 
						<th width="10%">Certificate No</th>
						<th width="15%">Action</th>
					</tr>
					<?php 
                            $count = 1;
                            $sum   = 0;
                            foreach ($course_certificate as $key => $value) {
                                $sum = $sum+$value['units'];
                                $start_date = date('Y-m-d', strtotime($value['start_date']));
                        echo '<tr>
                            <td align="center">'.$count.'.</td>
                            <td>'.$value['course_name'].'</td>
                            <td align="center">'.$value['units'].'</td>
                            <td>'.$start_date.'</td> 
                            <td>'.$value['certificate_id'].'</td>';
                            ?>
                            
                        <td class="action">
                            <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                            <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr> 
				<?php $count++; } ?>

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
                <?php if(count($training_certificate) > 0){ ?>
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
                        foreach ($training_certificate as $key => $value) {
                        $sum = $sum+$value['units'];
                        $start_date = date('Y-m-d', strtotime($value['start_date']));
                  echo '<tr>
                                <td align="center">'.$count.'.</td>
                                <td>'.$value['course_name'].'</td>
                                <td align="center">'.$value['units'].'</td>
                                <td>'.$start_date.'</td> 
                                <td>'.$value['certificate_id'].'</td>';
                                ?>
                            
                            <td class="action">
                                <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                                <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr> 
                        <?php $count++; } ?>
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






                <!-- <div class="panel panel-default panel-table mb-0" style="display: none;">
                <div class="panel-heading">
                3. TRAININGS  CERTIFICATES
                </div>
                <div class="">
                <?php

                $uid = $this->session->userdata('logged_in')['username']; 
                $where = array('email'=>$uid,'category_id'=>0);                 
                $datas = $this->user->get_record_by_multi_field_name('tbl_training_book',$where);  

                if(count($datas) > 0){

                ?>
                <table class="table mb-0">
                <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th> 
                <th>Certificate</th>
                </tr>



                <?php 
                foreach ($datas as $key => $value) {
                ?>
                <tr>
                <td>
                <?php echo $key+1; ?>
                </td>
                <td>
                <?php echo $value['name']; ?>
                </td>
                <td>
                <?php echo $value['email']; ?>
                </td> 

                <?php 
                if($value['certificate_id'] !=""){
                $filename = $value['certificate_id'];
                ?>
                <td> -->
                <!-- http://wps-dev.com/dev/mycpd/assets/upload/pdf/7720821545244805.pdf -->
                <!--  <a class="btn btn-primary" title="View Certificate" target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>"><i class="fa fa-file-pdf-o"></i></a></td>
                <?php 
                } else {
                ?>
                <td>N/A</td>
                <?php 
                }
                ?>
                </tr>
                <?php } ?>
                </tbody>
                </table>

                <?php } else {
                ?>
                <p>Sorry no records found.</p>
                <?php 
                } ?>
                </div>
                </div> -->



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    


			<div class="innerContent dashboard-inner" style="padding-top: 0em;">
				<div class="container">
					<div class="row">
					<div class="col-sm-4 user-nav"></div>
						<div class="col-sm-8">
							<div class="panel panel-default">
								<div class="panel-body bg-blue border-radius-5">
                                    <div class="col-sm-12">
                                        
									<h3 class="mt-0 text-white text-left">ARCHIVE LISTING <?php echo $_REQUEST['ex_year']; ?></h3> 
									<!-- <div class="">   -->
										<button type="button" class="btn btn-success" id="btn_all1" onclick="showrecords1('all1');">ALL</button>
										<button type="button" class="btn btn-warning" id="btn_specific1" onclick="showrecords1('specific1');">SPECIFIC</button>
										<button type="button" class="btn btn-warning" id="btn_general1" onclick="showrecords1('general1');">GENERAL</button>  
									<!-- </div> -->
									<div class="pull-right">  
										<form action="<?=BASE_URL;?>professional/dashboard" method="post">
											<select class="form-control" name="ex_year" onchange="javascript:form.submit()">
											<?php for($i=date('Y'); $i>=2015;$i--){ ?>
											<option value="<?=$i;?>" <?php if($_REQUEST['ex_year']== $i){echo'selected';} ?> > <?=$i;?> </option>
											<?php }	?>
											</select>
										</form>
									</div>
                                    </div>
								</div>

								<div id="all1" style="color: black;">
									<?php if(count($previous_certificate1) > 0){ ?>
									<table class="table mb-0 table-bordered">
										<tr>
											<th width="">No.</th>
											<th width="">Course Name</th>
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
									foreach ($previous_certificate1 as $key => $value) {
									$sum = $sum+$value['units'];

									echo '<tr>
											<td align="center">'.$count.'.</td>
											<td align="center">'.$value['course_name'].'</td>
											<td align="center">'.$value['units'].'</td>
											<td align="center">'.$value['issue_by'].'</td>
											<td align="center">'.$value['issue_from'].'</td>
											<td align="center">'.$value['start_date'].'</td>
											<td align="center">'.$value['category'].'</td>
											<td align="center">'.$value['certificate_id'].'</td>';	?>

											<td class="action">
												<a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','1')"><i class="fa fa-list-alt" aria-hidden="true"></i></a> 
												<a target="_blank" href="<?php echo BASE_URL;?>assets/images/uploads/<?php echo $value['certificate'];?>" title="Download"><i class="fa fa-download"></i></a>
												<a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
												<a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
											<!-- <a href="javascript:void(0)" onclick="myFunction()" title="Print"><i class="fa fa-print"></i></a> -->
											</td>
										</tr>
									<?php $count++; } ?>



									<?php 
									$uid = $this->session->userdata('logged_in')['username']; 
									$where = array('email'=>$uid,'category_id'=>0);                 
									$datas = $this->user->get_record_by_multi_field_name('tbl_training_book',$where);  
									foreach ($datas as $key => $value) {
										
									$where1 = array('id'=>$value['training_seminar_id']); 
									$trainingData = $this->user->get_record_by_multi_field_name('tbl_training',$where1); 

									$sum = $sum + $trainingData[0]['units'];
									if($value['certificate_id'] !=""){
									$filename = $value['certificate_id'];
									}


								echo '<tr>
											<td align="center">'.$count.'.</td>
											<td>'.$trainingData[0]['title'].'</td>
											<td align="center">'.$trainingData[0]['units'].'</td>
											<td>'.$value['added_on'].'</td>
											<td>'.$value['certificate_id'].'</td>';
											?>
											<td class="action" style="white-space:nowrap;">

											<a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','2')"><i class="fa fa-list-alt" aria-hidden="true"></i></a> 


											<a target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="Download"><i class="fa fa-download"></i></a>
											<a  href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="View"><i class="fa fa-eye"></i></a>
											<a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete_training/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
											<!-- <a href="javascript:void(0)" onclick="myFunction()" title="Print"><i class="fa fa-print"></i></a> -->
											</td>
										</tr>
									<?php $count++;	} ?>
										<tr class="bg-info">
											<td ></td>
											<td style="font-weight: bold;" class="text-primary">Total Units:</td>
											<td style="font-weight: bold;" align="center" class="text-primary">
											<?php echo $sum;?></td>
											<td colspan="6"></td>
										</tr>
									</table>
									<?php } ?>
								</div>


								<div id="specific1" style="display: none; color: black;" >

								<?php if(count($specific1) > 0){ ?>

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
									foreach ($specific1 as $key => $value) {
									$sum = $sum+$value['units'];
									echo '<tr>
										<td align="center">'.$count.'.</td>
										<td>'.$value['course_name'].'</td>
										<td align="center">'.$value['units'].'</td>
										<td>'.$value['start_date'].'</td> 
										<td>'.$value['certificate_id'].'</td>';
										?>
										<td class="action">
											<a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','1')"><i class="fa fa-list-alt" aria-hidden="true"></i></a> 
											<a target="_blank" href="<?php echo BASE_URL;?>assets/images/uploads/<?php echo $value['certificate'];?>" title="Download"><i class="fa fa-download"></i></a>
											<a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
											<a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
											<!--  <a href="#" title="Edit"><i class="fa fa-pencil"></i></a> -->
										</td>
									</tr>
									<?php 
									$count++;
									} ?>



									<?php 
									$uid = $this->session->userdata('logged_in')['username']; 
									$where = array('email'=>$uid,'category_id'=>1);                 
									$datas = $this->user->get_record_by_multi_field_name('tbl_training_book',$where);  
									foreach ($datas as $key => $value) {

									$where1 = array('id'=>$value['training_seminar_id']); 
									$trainingData = $this->user->get_record_by_multi_field_name('tbl_training',$where1); 
									$sum = $sum + $trainingData[0]['units'];

									if($value['certificate_id'] !=""){
									$filename = $value['certificate_id'];
									}
									echo '<tr>
										<td align="center">'.$count.'.</td>
										<td>'.$trainingData[0]['title'].'</td>
										<td align="center">'.$trainingData[0]['units'].'</td>
										<td>'.$value['added_on'].'</td>
										<td>'.$value['certificate_id'].'</td>';
										?>
										<td class="action">
											<a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','2')"><i class="fa fa-list-alt" aria-hidden="true"></i></a> 
											<a target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="Download"><i class="fa fa-download"></i></a>
											<a  href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="View"><i class="fa fa-eye"></i></a>
											<a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete_training/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
											<!--  <a href="javascript:void(0)" onclick="myFunction()" title="Print"><i class="fa fa-print"></i></a> -->
										</td>
									</tr>
									<?php 
									$count++;
									} 
									?>
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
								
								<div id="general1" style="display: none; color: black;">

								<?php if(count($general1) > 0){ ?>

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
								foreach ($general1 as $key => $value) {
								$sum = $sum+$value['units'];
								echo '<tr>
									<td align="center">'.$count.'.</td>
									<td>'.$value['course_name'].'</td>
									<td align="center">'.$value['units'].'</td>
									<td>'.$value['start_date'].'</td> 
									<td>'.$value['certificate_id'].'</td>';
									?>
									<td class="action">
										<a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','1')"><i class="fa fa-list-alt" aria-hidden="true"></i></a> 
										<a target="_blank" href="<?php echo BASE_URL;?>assets/images/uploads/<?php echo $value['certificate'];?>" title="Download"><i class="fa fa-download"></i></a>
										<a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
										<a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										<!--  <a href="#" title="Edit"><i class="fa fa-pencil"></i></a> -->
									</td>
								</tr>
								<?php $count++;	} ?>

								<?php 
								$uid = $this->session->userdata('logged_in')['username']; 
								$where = array('email'=>$uid,'category_id'=>2);                 
								$datas = $this->user->get_record_by_multi_field_name('tbl_training_book',$where);  
								foreach ($datas as $key => $value) {

								$where1 = array('id'=>$value['training_seminar_id']); 
								$trainingData = $this->user->get_record_by_multi_field_name('tbl_training',$where1); 

								$sum = $sum + $trainingData[0]['units'];

								if($value['certificate_id'] !=""){
								$filename = $value['certificate_id'];
								}

								echo '<tr>
									<td align="center">'.$count.'.</td>
									<td>'.$trainingData[0]['title'].'</td>
									<td align="center">'.$trainingData[0]['units'].'</td>
									<td>'.$value['added_on'].'</td>
									<td>'.$value['certificate_id'].'</td>';
									?>
									<td class="action">
										<a href="javascript:void(0)" title="Change Category" onclick="changecategory('<?php echo $value['id']; ?>','2')"><i class="fa fa-list-alt" aria-hidden="true"></i></a> 
										<a target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="Download"><i class="fa fa-download"></i></a>
										<a  href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>" title="View"><i class="fa fa-eye"></i></a>
										<a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete_training/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										<!--    <a href="javascript:void(0)" onclick="myFunction()" title="Print"><i class="fa fa-print"></i></a> -->
									</td>
								</tr>
								<?php $count++; } ?>

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

							</div>
						</div>
					</div>
				</div>
			</div>






		<div id="uploadCertificateModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
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
								<input name="course_unit" value="" size="20" type="text" class="form-control" required>
								<span class="error"><?php echo  form_error('course_unit'); ?></span>
							</p>

							<div class="row">
								<div class="col-md-12">
									<p>
										<label>Date Issued <span class="required text-danger"> * </span> </label>
										<input name="course_start_date" value="" size="20" type="text" class="form-control datepicker" required>
										<span class="error"><?php echo  form_error('course_start_date'); ?></span>
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<p>
										<label>Category<span class="required text-danger"> * </span> </label>
										<select name="category" id="category" class="form-control">
											<option value="" selected>Please Select</option>
											<option value="general">General</option>
											<option value="specific">Specific</option>
										</select>
										<span class="error"><?php echo  form_error('category'); ?></span>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p>
										<label>Issued By<span class="required text-danger"> * </span> </label>
										<input name="issue_by" value="" size="20" type="file" class="form-control" required>

										<span class="error"><?php echo  form_error('category'); ?></span>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p>
										<label>Issued From<span class="required text-danger"> * </span> </label>
										<select name="category" id="category" class="form-control">
											<option value="" selected>Please Select</option>
											<option value="Online Course">Online Course</option>
											<option value="Training">Training</option>
										</select>
										<span class="error"><?php echo  form_error('category'); ?></span>
									</p>
								</div>
							</div>


							<p>
								<label>Certificate <span class="required text-danger"> * </span> </label>
								<input name="certificate" value="" size="20" type="file" class="form-control" required>
								<span class="error"><?php echo  form_error('certificate'); ?></span>
							</p>
							<!-- <p class="submit alignleft">
								
							</p> -->
						</div>
						<div class="modal-footer">
							<input class="btn btn-primary" value="SAVE" type="submit" name="save">
						</div>
					</form>
				</div>
			</div>
		</div>



		<!-- <div id="uploadCardModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Upload Card</h4>
					</div>

					  <form action="<?php echo BASE_URL;?>professional/savecard" method="post" enctype="multipart/form-data" name="form1" id="form1">
						<div class="modal-body"> 
							<p>
								<label>Card No </label>
								<input name="card_no" value="" size="20" type="text" class="form-control">
								<span class="error"><?php echo  form_error('card_no'); ?></span>
							</p>
							<p>
								<label>Card Name <span class="required text-danger"> * </span> </label>
								<input name="card_name" value="" size="20" type="text" class="form-control" required>
								<span class="error"><?php echo  form_error('card_name'); ?></span>
							</p>
							<div class="row">
								<div class="col-md-12">
									<p>
										<label>Date Issued <span class="required text-danger"> * </span> </label>
										<input name="issued_date" value="" size="20" type="text" class="form-control datepicker" required>
										<span class="error"><?php echo  form_error('issued_date'); ?></span>
									</p>
								</div>
							</div>
							 <div class="row">
								<div class="col-md-12">
									<p>
										<label>Expiration Date <span class="required text-danger"> * </span> </label>
										<input name="expiry_date" value="" size="20" type="text" class="form-control datepicker" required>
										<span class="error"><?php echo  form_error('expiry_date'); ?></span>
									</p>
								</div>
							</div>
							 <p>
								<label>Upload Photo <span class="required text-danger"> * </span> </label>
								<input name="photos" value="" size="20" type="file" class="form-control" required>
								<span class="error"><?php echo  form_error('photos'); ?></span>
							</p>
						</div>
						<div class="modal-footer">
							<input class="btn btn-primary" value="SAVE" type="submit" name="save">
						</div>
					</form>
				</div>
			</div>
		</div> -->



		<div id="addpackegs" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create Ads Packages</h4>
					</div>
					<form action="<?php echo BASE_URL;?>professional/existing" method="post" enctype="multipart/form-data" name="form1" id="form1">
						<div class="modal-body">
							<p>
								<label>Package Name<span class="required text-danger"> * </span> </label>
								<input name="certi_no" value="" size="20" type="text" class="form-control" required>
								<span class="error"><?php echo  form_error('certi_no'); ?></span>
							</p>
							
							<div class="row">
								<div class="col-md-4">
									<p>
										<label>Category<span class="required text-danger"> * </span> </label>
										<div class="selection-box">
											<select class="form-control" name="type">
												<option value="">--Select--</option>
												<option>Category 1</option>
												<option>Category 2</option>
												<option>Category 3</option>
												<option>Category 4</option>
												<option>Category 5</option>
											</select>
										</div>
									</p>
								</div>
								<div class="col-md-4">
									<p>
										<label>Locations <span class="required text-danger"> * </span> </label>
										<div class="selection-box">
											<select class="form-control" name="type">
												<option value="">--Select--</option>
												<option>Locations 1</option>
												<option>Locations 2</option>
												<option>Locations 3</option>
												<option>Locations 4</option>
												<option>Locations 5</option>
											</select>
										</div>
									</p>
								</div>
								<div class="col-md-4">
									<p>
										<label>Size <span class="required text-danger"> * </span> </label>
										<div class="selection-box">
											<select class="form-control" name="type">
												<option value="">--Select--</option>
												<option>Size 1</option>
												<option>Size 2</option>
												<option>Size 3</option>
												<option>Size 4</option>
												<option>Size 5</option>
											</select>
										</div>
									</p>
								</div>
							</div>
							<p>
								<label>Photo Image <span class="required text-danger"> * </span> </label>
								<input name="certificate" value="" size="20" type="file" class="form-control" required>
								<span class="error"><?php echo  form_error('certificate'); ?></span>
							</p>
							<!-- <p class="submit alignleft">
								
							</p> -->
						</div>
						<div class="modal-footer">
							<input class="btn btn-primary" value="SAVE" type="submit" name="save">
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div id="myModalcertificate" class="modal fade modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


		<div class="modal fade" id="myModalpreviewImage" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content" id="myModalpreviewImage11">
					<div class="modal-header">
						<button onclick="myFunction()" style="float: left;" type="button"><i class="fa fa-print"></i></button>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<center>
							<img src="" id="imagepreview">
						</center>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="changecategoryDialog" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title">Change Category</h4>
					</div>
					<div class="modal-body">
					  
					  <form action="<?php echo BASE_URL;?>professional/changecategory" method="post" enctype="multipart/form-data" name="form1" id="form1">

						<input type="hidden" name="form_type" id="form_type">
						<input type="hidden" name="form_id" id="form_id">

						<p>
							<label>Category<span class="required text-danger"> * </span> </label>
							<select name="categoryid" id="categoryid" class="form-control">
								<option value="" selected="">Please Select</option>
								<option value="2">General</option>
								<option value="1">Specific</option>
							</select> 
						</p>
					 
						<p>
							<input type="submit" name="savecat" value="SAVE" class="btn btn-primary">
						</p>
					 </form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="upgradeunit" role="dialog" data-keyboard="false" data-backdrop="static">
			<div class="modal-dialog">
				<!-- Modal content first and second-->
				<div class="modal-content">
					<div class="modal-header">
					  <!--  <button type="button" class="close" data-dismiss="modal">&times;</button>-->
						<div class="site-logo__link">
							<a href="http://ceonpoint.com/"><img src="http://ceonpoint.com/assets/images/logo.png" alt="logo"></a>
						</div>
						  <h4 class="modal-title text-center" style="font-weight: bold;"><img src="http://ceonpoint.com/assets/images/Welcome-text.png" alt="welcome" width="175"> </h4>
						  <p class="text-center" style="font-weight: bold;">This section will help you track your CE Units or Contact Hours Compliance status</p>
					</div>
					<div class="modal-body">
					  
					<form action="<?php echo BASE_URL;?>professional/updateunit" method="post" enctype="multipart/form-data" name="form1" id="form1">
						<p class="text-center" ><strong style="color: red;">Please set Required Units or Contact Hours and calender year.</strong></p>
						
									   
						<div class="professionals-banner">
							<div class="row banner-count-desc">
								<div class="col-xs-6 col-md-12 text-center item">
									<div class="icon-container" style="background:#275bf4"><input type="text" name="units" required><span>Units</span></div>
									<h2>Enter Total Required CE Units</h2>
								</div>
								
								<div class="col-xs-6 col-md-6 text-center item">
									<div class="icon-container" style="background:#275bf4"><input type="text" name="specific_target" required><span>Units</span></div>
									<h2>Enter Specific Required CE Units</h2>
								</div>
								<div class="col-xs-6 col-md-6 text-center item">
									<div class="icon-container" style="background:#275bf4"><input type="text" name="gernal_target" required><span>Units</span></div>
									<h2>Enter General Required CE Units</h2>
								</div>
							</div>
						</div>
						<h4 class="text-center"><strong>Periode Covered</strong></h4>
								
						<div class="col-xs-6 col-md-6 text-center item">
							<span class="" style="font-size: 50px; display: block;">
								<i class="fa fa-calendar fa-10x" ></i>
							</span>
							<input type="date" name="to_date" required>
							<p><b>Enter To date CE Units</b></p>
						</div>

						<div class="col-xs-6 col-md-6 text-center item">
							<span class="" style="font-size: 50px; display: block;">
								<i class="fa fa-calendar fa-10x"></i>
							</span>
							<input type="date" name="from_date" required>
							<p><b>From Date Required CE Units</b></p>
						</div>

						<div class="purpose-div text-center">
							<h5>Purpose of CE Units / Contact Hours:</h5>
							<p><input type="radio" name="purpose" value="_Licence Renewal" required checked="checked"> _Licence Renewal</p>

							<p><input type="radio" name="purpose" value="_Performance Appraisal" required> _Performance Appraisal</p>

							<p><input type="radio" name="purpose" value="_Both" required>_Both</p>
						
							<p class="text-center">
								<input type="submit" name="savecat" value="SAVE" class="btn btn-primary" style="min-width: 100px;">
							</p>
						</div>
					 </form>
					</div>
				</div> 
			</div>
		</div>


		<div class="modal fade" id="upgradesuccess" role="dialog" data-keyboard="false" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
							<div class="site-logo__link">
								<a href="http://ceonpoint.com/"><img src="http://ceonpoint.com/assets/images/logo.png" alt="logo"></a>
							</div>

						<?php 
						$Idd = $this->session->userdata('logged_in')['id'];  
						$unit = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_units','user_id',$Idd);
						$target_unit = $unit[0]['unit'];
						?>
						  <h4 class="modal-title text-center">Your <span>New</span> Required CE Units/Contact Hours is <span><?php echo  $target_unit; ?></span></h4>
						  <p class="text-center">Start adding Your CE Units/Contact Hours by clicking one of the button!</p>
					</div>
					  
					<div class="modal-body">
						<form action="<?php echo BASE_URL;?>professional/changecategory1" method="post" enctype="multipart/form-data" name="form1" id="form1">
						<div class="model-btn-group">

						   <h4 class="modal-title" style="text-align: center;">ADD CE UNIT OR CONTACT HOURS</h4>
							<div class="row">
								<div class="col-md-3">
									<div class="online-box">
										<a href="<?php echo site_url('pages/courses'); ?>">
											<div class="online-img">
												<img src="<?php echo base_url('assets/images/online.jpg'); ?>" alt="Online Courses">
											</div>
											<div class="online-text-pop">
												<p>ONLINE <br>COURSE</p>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="online-box">
										<a href="<?php echo site_url('pages/training'); ?>">
											<div class="online-img">
												<img src="<?php echo base_url('assets/images/traning.jpg'); ?>" alt="Training">
											</div>
											<div class="online-text-pop">
												<p>TRANING/<br>SEMINARS</p>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="online-box">                       
										<a href="javascript:void(0)" onclick="checklogin();" style="text-decoration: none;">
											<div class="online-img">
												<img src="<?php echo base_url('assets/images/certificates.jpg'); ?>" alt="Certificates">
											</div>
											<div class="online-text-pop">
												<p>UPLOAD <br>CERTIFICATES</p>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="online-box">
										<a href="<?php echo site_url('pages/Institutionspage'); ?>">
											<div class="online-img">
												<img src="<?php echo base_url('assets/images/institute.jpg'); ?>" alt="Institutes">
											</div>
											<div class="online-text-pop">
												<p>INSTITUTION <br>CE WEBPAGE</p>
											</div>
										</a>
									</div>
								</div>                     
						 </div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>


 

        <?php if($_REQUEST['id']=="success"){  ?>
            <script type="text/javascript">

                $(document).ready(function() {
                    // alert('123');
                  $("#upgradesuccess").modal('show');
                });
            </script>  
        <?php } ?>


<script type="text/javascript">
    function changecategory(idd,types){
        $('#form_id').val(idd);
        $('#form_type').val(types);
        $("#changecategoryDialog").modal();
    }
	
   function uploadcerti(){ 
        $("#uploadCertificateModal").modal('show');
        $("#upgradesuccess").modal('hide');
    }

    function showrecords(cat){

        $('#all').hide();
        $('#general').hide();
        $('#specific').hide(); 
        $('#onlinecourse').hide();    
        $('#training').hide(); 

        $('#btn_all').removeClass('btn-success');
        $('#btn_general').removeClass('btn-success');
        $('#btn_specific').removeClass('btn-success');

        $('#'+cat).show();
        $('#btn_'+cat).addClass( "btn-success" ); 
    
    }

    function showrecords1(cat){

        $('#all1').hide();
        $('#general1').hide();
        $('#specific1').hide();
		
        $('#btn_all1').removeClass('btn-success');
        $('#btn_general1').removeClass('btn-success');
        $('#btn_specific1').removeClass('btn-success');

        $('#'+cat).show(); 
        $('#btn_'+cat).addClass( "btn-success" );
    
    }


	/* document.addEventListener('contextmenu', event => event.preventDefault()); */

	function myFunction() {
	  //window.print();
	  printData();
	}

	function printData()
	{
		var printContents = document.getElementById('myModalpreviewImage11').innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}


	function preview_image(image) {
		$("#myModalpreviewImage").modal()
		document.getElementById('imagepreview').src = image;
	}

	function preview_certificate(certifiacte_no) {
		// alert(certifiacte_no);
		$('#myModalcertificate').modal('show');
		$.ajax({
			type: "POST",
			url: '<?php echo base_url()."users/certificate_download";?>',
			data: { certifiacte_no: certifiacte_no },
			beforeSend: function() {
			$("#filteredData22").html("");
		}

		}).done(function(result) {
			$("#filteredData22").html(result);
		});
		return false;


		/*     $.ajax({
			 type: "POST"
			 url: 'http://wps-dev.com/mycpd/users/certificate_download'
			 data: {certifiacte_no:certifiacte_no}
			 }).done(function( result ) {  
			 });             

			 return false;  */
	}
</script>


 
 