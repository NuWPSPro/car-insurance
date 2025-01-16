<?php 
    $professionId = $this->session->userdata('logged_in')['profession']; 
    $Idd = $this->session->userdata('logged_in')['id'];
    $uemail = $this->session->userdata('logged_in')['username'];
    $firstlogin = $this->db->get_where('tbl_user',array('id'=>$Idd))->row_array()['logged_in']; 

    $checkactiveplanArr = $this->professional_model->checkactiveplan($Idd);
    $unit = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_units','user_id',$Idd);
    $this->db->limit(10, 1);
    $units = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_units','user_id',$Idd);
    $unit = $unit[0]['unit'];
    $grandSome = 0;
    $sum  = 0;
    $sum1 = 0; 
    $currentplan = $currentplanArr->version_type; ?> 

<?php $this->load->view('template/picture'); ?>

<div class="innerContent dashboard-inner professional-dashboardpanal">
    <div class="container">
        <div class="row">
            <!-- <div class="col-sm-12">
                <a class="dashboard-btn" href="#">Dashboard</a>
            </div> -->
            <?php $this->load->view('professional/sidebar'); ?>
           
        <div class="col-sm-9">
            <?php   // $sum = array_sum(array_column($purchase_list,'units'));
                    $sum1 = array_sum(array_column($previous_certificate,'units'));
                    // $sum2 = array_sum(array_column($training_certificate,'units'));
                    // $sum3 = array_sum(array_column($course_certificate,'units'));
                    // $grandSome = $sum1+$sum2+$sum3;
                    $grandSome = $sum1; ?>

            <?php echo $this->session->flashdata('response'); ?>

                <div class="panel panel-default panel-defaulttable" style="overflow: scroll;">
                    <div class="panel-heading">
                        Pending Course / Training
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <tr>
                                <th>No.</th>
                                <th>Online Course/Training Title</th>
                                <th>Date Purchased/Registered</th>
                                <th></th>
                            </tr>
                            <?php // echo'<pre>'; print_r($training_list);
                            $pending = array_merge($training_list,$purchase_list);
							$flage=1;
                            $sl=1;
                       
                            foreach ($pending as $key => $value) {
                                     $this->db->where('user_id',$Idd);
                            $exam =  $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_exam','course_id',$value['cid']); 
                            // echo $this->db->last_query();
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
						<?php 
							if($currentplan > 1){
						?>
                        <div class="table-responsive" style="border:none;">
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

                                            <?php if($grandUnit <= 0 && $firstlogin < 2){ ?>
                                            <script type="text/javascript">
                                                window.setTimeout(function(){
                                                        //alert("nutan kumar"); 
                                                   $("#upgradeunit_new").modal('show'); 
                                                   $("#upgradeunit").modal('hide'); 
                                                   $("#edittarget").modal('hide'); 

                                                }, 6000); 
                                            </script>
                                            <?php }elseif($grandUnit <= 0){ ?>
                                            
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


        <div class="panel panel-default panel-table mb-0" style="height: 450px; overflow: scroll;">

            <div class="panel-heading"> 
                  <button type="button" class="btn btn-success" id="btn_all1" onclick="showrecords('all');">ALL</button>
                  <button type="button" class="btn" id="btn_specific" onclick="showrecords('specific');">SPECIFIC (<?=count($specific)?>)</button>
                  <button type="button" class="btn" id="btn_general" onclick="showrecords('general');">GENERAL (<?=count($general)?>)</button> 
                  <!-- <button type="button" class="btn" id="btn_general" onclick="showrecords('general');">ISSUED FROM (<?=count($general)?>)</button>  -->
                  <div class="dropdown">
                  <button class="dropbtn">ISSUED FROM (<?=count($previous_certificate); ?>)</button>
                  <div class="dropdown-content">
                    <a href="#" onclick="showrecords('onlinecourse');">Online Course</a>
                    <a href="#" onclick="showrecords('training');">Training</a>
                  </div>
                </div>
                <button type="button" class="btn btn-danger pull-right" onclick="homepopup();">Add Needed CE Units/C.Hours</button> 
				
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
                        // $value['certificate']
                        $commanArr[] = array(
                            'id'             => $value['id'],
                            'course_name'    => $value['course_name'],
                            'units'          => $value['units'],
                            'issue_by'       => $value['issue_by'],
                            'cep_name'       => $value['cep_name'],
                            'issue_from'     => $value['issue_from'],
                            'issue_date'     => date('Y-m-d', strtotime($value['issue_date'])),
                            'start_date'     => $value['start_date'],
                            'end_date'       => $value['end_date'],
                            'category'       => $category,
                            'certificate_id' => $value['certificate_id'],
                            'certificate'    => $value['certificate'],
                            'report'         => $value['report'],
                            'added_on'       => $value['added_on'],
                            'status'         => $value['status']);
                    }
                ?>

<!-- ********************************** All Certificate Listing ******************************************* -->
			<div id="all" style="color: black;">

		   <?php if(count($commanArr) > 0){ ?>
                 <div class="table-responsive">   
				<table class="table mb-0 table-bordered">
					<tr>
						<th width="">No.</th>
						<th width="">Report Status</th>
						<th width="">Course/Training Name</th>
						<th width="">Units</th>
						<th width="">Issued By</th>
						<th width="">Issued From</th>
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
                    if($value['issue_by'] == 'CEonpoint'){
                        $cepname = $value['cep_name'];
                    }else{
                        $cepname = $value['issue_by'];
                    } 
                        
            echo '<tr>
                    <td align="center">'.$count.'.</td>
                    <td align="center">'.$value['report'].'</td>
                    <td align="center">'.$value['course_name'].'</td>
                    <td align="center">'.$value['units'].'</td>
                    <td align="center">'.$cepname.'</td>
                    <td align="center">'.$value['issue_from'].'</td>
                    <td align="center">'.$value['start_date'].'</td>
					<td align="center">'.$value['category'].'</td>
                    <td align="center">'.$value['certificate_id'].'</td>';  ?>            
                    <td class="action">

                        <a href="javascript:void(0)" title="Change Category" data-value="<?=$value['id']; ?>" data-typeid="1" class="profchangecategory"><?=$fa_paper_plane; ?></a>
                        <a onclick="return confirm('Are you sure you want to delete it.')" href="<?=BASE_URL.'professional/ecertificate_delete/'.$value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                        <?php if($currentplan > 1){ ?>
                        <a href="javascript:void(0)" value="<?php echo $value['id'];?>" data-id="<?php echo $Idd; ?>" name="<?php echo $uemail; ?>" class="sendToInstitution" title="Send"><i class="fa fa-paper-plane"></i></a>
                        <?php }else{ ?>
                        <a onclick="return confirm('You need to upgrade your Plan!')" href="<?php echo site_url('pages/plans'); ?>" title="Send"><i class="fa fa-paper-plane"></i></a>
                        <?php } ?> 

                        <?php if($value['issue_by'] != 'CEonpoint'){ ?>
                            <a target="_blank" href="<?php echo BASE_URL.'professional/download_image/'.$value['certificate']; ?>" title="Download"><i class="fa fa-download"></i></a>
                            <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
                        <?php }else{ ?>
                             <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                             <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                        <?php } ?> 
                        
                        <?php if($currentplan == 3 && isset($connected_rboard) && $connected_rboard->rboard_id){ 
                            if($value['report']=='no'){ ?>
                        <a href="javascript:void(0)" value="<?php echo $value['id'];?>" data-id="<?php echo $Idd; ?>" name="<?php echo $uemail; ?>" class="sendToRboard" title="Send to RBoard" ><i class="fa fa-university"></i></a>
                        <?php }else{ echo '<button disabled="disabled" class="btn btn-danger">Reported</button>'; } } else{ ?>
                        <a onclick="return confirm('Please connect to your Professional Regulatory Board first in order to report this certificate.')" href="<?php echo site_url('professional/connectToRboard'); ?>" title="Send to RBoard"><i class="fa fa-university"></i></a>
                        <?php } ?>
                    </td>
                </tr>

            <?php $count++;  } ?>
                    <tr class="bg-info">
                        <td>&nbsp;</td>
                        <td  style="font-weight: bold;" class="text-primary">Total Units:</td>
                        <td style="font-weight: bold;" align="center" class="text-primary">
                            <?php echo $sum;?>
                        </td>
                        <td colspan="6"></td>
                    </tr>
                                 
                </table>
            </div>
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
                    <div class="table-responsive">
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
                            if($value['category'] == "--"){ 
                                $fa_paper_plane = '<i class="fa fa-list-alt blink" aria-hidden="true"></i>'; 
                            }else{ 
                                $fa_paper_plane = '<i class="fa fa-list-alt" aria-hidden="true"></i>'; }
                            // print_r($sum);
                 echo '<tr>
                            <td align="center">'.$count.'.</td>
                            <td>'.$value['course_name'].'</td>
                            <td align="center">'.$value['units'].'</td>
                            <td>'.$value['start_date'].'</td> 
                            <td>'.$value['certificate_id'].'</td>';
                            ?>
                            <td class="action">
                                <a href="javascript:void(0)" title="Change Category" data-value="<?=$value['id']; ?>" data-typeid="1" class="profchangecategory"><?=$fa_paper_plane; ?></a> 
                                <a onclick="return confirm('Are you sure you want to send it to Institution.')" href="<?php //echo site_url('professional/sendtoinstitution/'.$value['id']); ?>" title="Send">
                                    <i class="fa fa-paper-plane"></i></a> 
                                <?php if($value['issue_by'] != 'CEonpoint'){ ?>
                                    <a target="_blank" href="<?php echo BASE_URL.'professional/download_image/'.$value['certificate']; ?>" title="Download"><i class="fa fa-download"></i></a>
                                    <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
                                <?php }else{ ?>
                                     <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                                     <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                                <?php } ?>
                                <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete">
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
            </div>
            <?php } ?>
        </div>


<!-- **********************************  General Certificate Listing ******************************************* -->


                            <div id="general" style="display: none; color: black;">
                            
                            <?php if(count($general) > 0){ ?>
                                <div class="table-responsive">
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
                                if($value['category'] == "--"){ 
                                    $fa_paper_plane = '<i class="fa fa-list-alt blink" aria-hidden="true"></i>'; 
                                }else{ 
                                    $fa_paper_plane = '<i class="fa fa-list-alt" aria-hidden="true"></i>'; }
                        echo '<tr>
                            <td align="center">'.$count.'.</td>
                            <td>'.$value['course_name'].'</td>
                            <td align="center">'.$value['units'].'</td>
                            <td>'.$value['start_date'].'</td> 
                            <td>'.$value['certificate_id'].'</td>';
                            ?>
                            
                            <td class="action">

                            <a href="javascript:void(0)" title="Change Category" data-value="<?=$value['id']; ?>" data-typeid="1" class="profchangecategory"><?=$fa_paper_plane; ?></a>
                                <a onclick="return confirm('Are you sure you want to send it to Institution.')" href="<?php // echo site_url('professional/sendtoinstitution/'.$value['id']); ?>" onclick="return alert('Coming Soon!'); " title="Send"><i class="fa fa-paper-plane"></i></a> 
                                <?php if($value['issue_by'] != 'CEonpoint'){ ?>
                                    <a target="_blank" href="<?php echo BASE_URL.'professional/download_image/'.$value['certificate']; ?>" title="Download"><i class="fa fa-download"></i></a>
                                    <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
                                <?php }else{ ?>
                                     <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                                     <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                                <?php } ?>
                                <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete">
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
                                </div>
                                <?php } ?>
                            </div>
<!-- **********************************  Online course Certificate Listing ******************************************* -->

        <div id="onlinecourse" style="display: none; color: black;">
                            
			<?php // if(count($course_certificate) > 0){ ?>
            <?php if(count($previous_certificate) > 0){ ?>
                <div class="table-responsive">
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
                        <a href="javascript:void(0)" title="Change Category" data-value="<?=$value['id']; ?>" data-typeid="1" class="profchangecategory"><?=$fa_paper_plane; ?></a>
                        <a onclick="return confirm('Are you sure you want to send it to Institution.')" href="<?php // echo site_url('professional/sendtoinstitution/'.$value['id']); ?>" onclick="return alert('Coming Soon!'); " title="Send">
                                    <i class="fa fa-paper-plane"></i></a>
                        <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                        <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
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
            </div>
				<?php } ?>
			</div>

<!-- **********************************  Training Certificate Listing ******************************************* -->

            <div id="training" style="display: none; color: black;">
                <?php if(count($previous_certificate) > 0){ ?>
                    <div class="table-responsive">
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
                                <a href="javascript:void(0)" title="Change Category" data-value="<?=$value['id']; ?>" data-typeid="1" class="profchangecategory"><?=$fa_paper_plane; ?></a>
                                <a onclick="return confirm('Are you sure you want to send it to Institution.')" href="<?php // echo site_url('professional/sendtoinstitution/'.$value['id']); ?>" onclick="return alert('Coming Soon!'); " title="Send"><i class="fa fa-paper-plane"></i></a>
                                <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                                <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
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
                </div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>

    <div class="archive-lisingbox panel panel-default">
        <div class="panel-body bg-blue border-radius-5">
            <div class="col-sm-12">
                <h3 class="mt-0 text-white text-left">ARCHIVE LISTING </h3> 
                <button type="button" class="btn btn-success" id="btn_all1" onclick="showrecords1('all1');">ALL</button>
                <button type="button" class="btn btn-warning" id="btn_specific1" onclick="showrecords1('specific1');">SPECIFIC</button>
                <button type="button" class="btn btn-warning" id="btn_general1" onclick="showrecords1('general1');">GENERAL</button>  
                
                <?php $checkactiveplanArr = $this->professional_model->checkactiveplan($this->session->userdata('logged_in')['id']); ?>
                <?php if($checkactiveplanArr->version_type != 1){ ?>
                    <div class="pull-right"> 
                        <form action="<?=BASE_URL;?>professional/dashboard" method="post">
                            <select class="form-control" name="ex_added_on" onchange="javascript:form.submit()">
                            <option value="">Select Period Covered</option>    
                            <?php foreach($units as $key => $previous_unit){ 
                                $to = date('F d, Y',strtotime($previous_unit['to_date']));
                                $from = date('F d, Y',strtotime($previous_unit['from_date'])); ?>
                            <option value="<?php echo  $previous_unit['to_date'].'/'.$previous_unit['from_date']; ?>" ><?php echo  $to.' to '.$from; ?> </option>
                            <?php  } ?>
                            </select>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
                
    <?php   $date = explode('/', $_REQUEST['ex_added_on']); 
            $sdate = $date[0];
            $edate = $date[1]; 
        if(count($previous_certificate1)>0): $style = "height: 350px; overflow: scroll;"; else: $style =''; endif; ?>
            <div id="all1" style="color: black; <?php echo $style; ?>">
                <?php if(count($previous_certificate1) > 0){ ?>
                    <div class="table-responsive">
                    <table class="table mb-0 table-bordered">
                        <tr><th colspan="2">Covered Period : </th>
                            <td colspan="3" ><?php if(!empty($_REQUEST['ex_added_on'])){ echo $sdate.' to '.$edate;}else{ echo "All Data"; } ?></td>
                        </tr>
                        <tr>
                            <th width="">No.</th>
                            <th width="">Course Name</th>
                            <th width="">Units</th>
                            <th width="">Issued By</th>
                            <th width="">Issued From</th>
                            <th width="">Date Issued</th>
                            <th width="">Category</th>
                            <th width="">Certificate No</th>
                            <th width="">Action</th>
                        </tr>
                        <?php   $count = 1; $sum   = 0;
                                foreach ($previous_certificate1 as $key => $value) {
                                $sum = $sum+$value['units']; 
                                if($value['category'] == "--"){ 
                                    $fa_paper_plane = '<i class="fa fa-list-alt blink" aria-hidden="true"></i>'; 
                                }else{ 
                                    $fa_paper_plane = '<i class="fa fa-list-alt" aria-hidden="true"></i>'; 
                                }
                                if($value['issue_by'] == 'CEonpoint'){
                                    $cepname = $value['cep_name'];
                                }else{
                                    $cepname = $value['issue_by'];
                                } ?>
                            <tr>
                                <td align="center"><?=$count;?>.</td>
                                <td align="center"><?=$value['course_name'];?></td>
                                <td align="center"><?=$value['units'];?></td>
                                <td align="center"><?=$value['issue_by'];?></td>
                                <td align="center"><?=$value['issue_from'];?></td>
                                <td align="center"><?=$value['start_date'];?></td>
                                <td align="center"><?=$value['category'];?></td>
                                <td align="center"><?=$value['certificate_id'];?></td>
                                <td class="action">
                                    <a href="javascript:void(0)" title="Change Category" data-value="<?=$value['id']; ?>" data-typeid="1" class="profchangecategory"><?=$fa_paper_plane; ?></a>
                                    <a onclick="return confirm('Are you sure you want to delete it.')" href="<?=BASE_URL.'professional/ecertificate_delete/'.$value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                    <?php if($currentplan > 1){ ?>
                                    <a onclick="return confirm('You can send your certificate to your institution\'s data base to be added to your account.')" href="<?php echo site_url('professional/sendtoinstitution/'.$value['id']); ?>" title="Send"><i class="fa fa-paper-plane"></i></a>
                                    <?php }else{ ?>
                                    <a onclick="return confirm('You need to upgrade your Plan!')" href="<?php echo site_url('pages/plans'); ?>" title="Send"><i class="fa fa-paper-plane"></i></a>
                                    <?php } ?> 

                                    <?php if($value['issue_by'] != 'CEonpoint'){ ?>
                                        <a target="_blank" href="<?php echo BASE_URL.'professional/download_image/'.$value['certificate']; ?>" title="Download"><i class="fa fa-download"></i></a>
                                        <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
                                    <?php }else{ ?>
                                        <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                                        <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                                    <?php } ?> 
                                    
                                    <?php if($currentplan == 3 && isset($connected_rboard) && $connected_rboard->rboard_id){ 
                                        if($value['report']=='no'){ ?>
                                    <a href="javascript:void(0)" value="<?php echo $value['id'];?>" data-id="<?php echo $Idd; ?>" name="<?php echo $uemail; ?>" class="sendToRboard" title="Send to RBoard" ><i class="fa fa-university"></i></a>
                                    <?php }else{ echo '<button disabled="disabled" class="btn btn-danger">Reported</button>'; } } else{ ?>
                                    <a onclick="return confirm('Please connect to your Professional Regulatory Board first in order to report this certificate.')" href="<?php echo site_url('professional/connectToRboard'); ?>" title="Send to RBoard"><i class="fa fa-university"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $count++; } ?>

                            <tr class="bg-info">
                                <td ></td>
                                <td style="font-weight: bold;" class="text-primary">Total Units:</td>
                                <td style="font-weight: bold;" align="center" class="text-primary">
                                <?php echo $sum;?></td>
                                <td colspan="6"></td>
                            </tr>
                        </table>
                    </div>
                        <?php }else{ echo '<center>No Data Found!</center>'; } ?>
                    </div>


            <div id="specific1" style="display: none; color: black; <?=$style;?>" >
            <?php if(count($specific1) > 0){ ?>
            <div class="table-responsive">
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
                        
                        <?php if($value['issue_by'] != 'CEonpoint'){ ?>
                            <a target="_blank" href="<?php echo BASE_URL.'professional/download_image/'.$value['certificate']; ?>" title="Download"><i class="fa fa-download"></i></a>
                            <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
                        <?php }else{ ?>
                                <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                                <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                        <?php } ?>
                        <!-- <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a> -->
                        <!--  <a href="#" title="Edit"><i class="fa fa-pencil"></i></a> -->
                    </td>
                </tr>
                <?php $count++; } ?>
                                
                <tr class="bg-info">
                    <td></td>
                    <td style="font-weight: bold;" class="text-primary">Total Units:</td>
                    <td style="font-weight: bold;" align="center" class="text-primary"> <?php echo $sum;?> </td>
                    <td colspan="4"></td>
                </tr>
                </table>
            </div>
                                    <?php }else{ echo '<center>No Data Found!</center>';} ?>
                                </div>
                                
                                <div id="general1" style="display: none; color: <?=$style;?>">

                                <?php if(count($general1) > 0){ ?>
                            <div class="table-responsive">
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
                                        
                                        <?php if($value['issue_by'] != 'CEonpoint'){ ?>
                                            <a target="_blank" href="<?php echo BASE_URL.'professional/download_image/'.$value['certificate']; ?>" title="Download"><i class="fa fa-download"></i></a>
                                            <a onclick="preview_image('<?php echo BASE_URL.'assets/images/uploads/'.$value['certificate'];?>')" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>
                                        <?php }else{ ?>
                                             <a href="<?php echo site_url('pages/download_certificate/'.$value['certificate_id']);?>" title="Download"><i class="fa fa-download"></i></a>
                                             <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                                        <?php } ?>
                                        <!-- <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo BASE_URL;?>professional/ecertificate_delete/<?php echo $value['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a> -->
                                        <!--  <a href="#" title="Edit"><i class="fa fa-pencil"></i></a> -->
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
                            </div>
                                    <?php }else{ echo '<center>No Data Found!</center>';} ?>
                                </div>

                            </div>
                    

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
					  <form action="<?php echo BASE_URL;?>professional/existing" method="post" enctype="multipart/form-data" name="ucexisting" id="ucexisting">
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
								<div class="col-md-12">
									<p>
										<label>Category</label>
										<select name="category" id="cat" class="form-control">
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

										<span class="error"><?php echo  form_error('issue_by'); ?></span>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p>
										<label>Issued From<span class="required text-danger"> * </span> </label>
										<select name="issued_from" id="issued_from" class="form-control">
											<option value="" selected>Please Select</option>
											<option value="Online Course">Online Course</option>
											<option value="Training">Training</option>
										</select>
										<span class="error"><?php echo  form_error('issued_from'); ?></span>
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


		<!-- Modal -->
		<div id="dashboardcertificate" class="modal fade modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
                    <!-- <button onclick="certificateFunction();" style="float: left;" type="button"><i class="fa fa-print"></i></button> -->
                        <span id="printCertificateBtn" class="pull-left"></span>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Certificate</h4>
					</div>
					<div class="modal-body">
						<div id="certificatehtml"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div id="sendCertificateToRboard" class="modal fade modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header p-3 bg-primary">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-uppercase text-center text-white sendCertificateTitle">Report Certificate</h4>
					</div>
					<div class="modal-body">
						<div class="card">
                            <div class="card-body">
                                <p class="card-text"> 
                                    <span class="sendToInsSection"></span>
                                    <label> To : <strong><?php echo $connected_rboard->rboard_name;?></strong></label><br>
                                    <label>Recipient : <strong id="strb_recipient"><?php echo $this->session->userdata('logged_in')['name']; ?></strong></label><br>
                                    <!-- <label>Receipt No: <strong id="strb_receipt_no"></strong></label><br> -->
                                    <label>Subject: <strong id="strb_subject">Certificate</strong></label><br>
                                    <!-- <label>Content: <strong id="strb_content">--</strong></label><br> -->
                                    <label>Certificate Name: <strong id="strb_certificate_name"> Certificate of completion</strong></label><br>
                                    <label>Certificate Number: <strong id="strb_certificate_no"> CERT0123456</strong></label><br>
                                    <label>CE Units: <strong id="strb_units"> </strong></label><br>
                                    <label>Date Issued: <strong id="strb_date_issued"> </strong></label><br>
                                    <label>Issued By: <strong id="strb_issued_by"> </strong></label><br>
                                    <label>Category: <strong id="strb_category"> </strong></label><br>
                                    <!-- <label>File: <strong id="strb_file">--</strong></label><br> -->
                                </p>
                                <!-- <a href="#" onclick="sendCertificate()" class="btn btn-primary">Report</a> -->
                                <span id="strb_sendCertificate"></span>
                            </div>
                        </div>
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
					  
					  <form action="<?php echo BASE_URL.'professional/changecategory';?>" method="post" enctype="multipart/form-data" name="changecategory" id="changecategory">

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

		<div class="modal fade" id="upgradeunit" role="dialog" data-keyboard="false" data-backdrop="static" style="overflow: auto;height: auto;">
			<div class="modal-dialog">
				<!-- Modal content first and second-->
				<div class="modal-content">
					<div class="modal-header">
					  <center><div class="site-logo__link" style="max-width: 34%;">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
                    </div></center>
						<?php if($firstlogin == 1){ ?>
                          <h4 class="modal-title text-center" style="font-weight: bold;"><img src="<?php echo ASSETS_URL.'images/Welcome-text.png';?>" alt="welcome" width="175"> </h4>
                          <p class="text-center" style="font-weight: bold;">This section will help you track your Required, Obtained and Needed CE Units or Contacts Hours</br> for your License Renewal or Job Performance Appraisal.</p>
                        <?php }elseif($grandSome < $unit){ ?>

                         <!--  <h4 class="modal-title text-center" style="font-weight: bold;"><img src="<?php echo ASSETS_URL.'images/congratulations.png';?>" alt="congratulations" width="175"> </h4> -->
                          <p class="text-center" style="font-weight: bold;"> This section will help you track your Required, Obtained and Needed CE Units or Contacts Hours</br> for your License Renewal or Job Performance Appraisal.</p>
                        <?php }else{ ?>
                          <h4 class="modal-title text-center" style="font-weight: bold;"><img src="<?php echo ASSETS_URL.'images/congratulations.png';?>" alt="congratulations" width="175"><span><i>!</i></span></h4>
                          <br/>
                          <p class="text-center" style="font-weight: bold;">You have now COMPLETED (100%)
                            <br/>your Required CE Units
                            <br/>for License Renewal/Job Performance Appraisal. 
                            <br/>Your Certificates will now be stored at the Archive section.
                            <br/><br/>Please set your New Required CE Units/Contact Hours and Period Covered.</p>
					    <?php } ?>
                    </div>
					<div class="modal-body">
					  
					<form action="<?php echo BASE_URL;?>professional/updateunit" method="post" enctype="multipart/form-data" name="updateunit" id="updateunit">
						<p class="text-center" ><strong style="color: red;">REQUIRED UNITS OR CONTACT HOURS.</strong></p>
						
									   
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
						<h4 class="text-center"><strong>PERIOD COVERED</strong></h4>
								
						<div class="col-xs-6 col-md-6 text-center item">
							<span class="" style="font-size: 50px; display: block;">
								<i class="fa fa-calendar fa-10x" ></i>
							</span>
							<input type="date" name="to_date" required>
							<!-- <p><b>Enter To date CE Units</b></p> -->
                            <p><b>Starting Date</b></p>
						</div>

						<div class="col-xs-6 col-md-6 text-center item">
							<span class="" style="font-size: 50px; display: block;">
								<i class="fa fa-calendar fa-10x"></i>
							</span>
							<input type="date" name="from_date" required>
							<!-- <p><b>From Date Required CE Units</b></p> -->
                            <p><b>Ending Date</b></p>
						</div>

						<div class="purpose-div text-center">
							<h5>Purpose of CE Units / Contact Hours:</h5>
							<p><input type="radio" name="purpose" value="_Licence Renewal" required checked="checked"> Licence Renewal</p>

							<p><input type="radio" name="purpose" value="_Performance Appraisal" required> Performance Appraisal</p>

							<p><input type="radio" name="purpose" value="_Both" required>Both</p>
						
							<p class="text-center">
							<input type="submit" name="savecat" value="SAVE" class="btn btn-primary" style="min-width: 100px;">
							</p>
						</div>
					 </form>
					</div>
				</div> 
			</div>
		</div>

    <div class="modal fade" id="upgradeunit_new" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center><div class="site-logo__link" style="max-width: 34%;">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
                    </div></center>
                  <h4 class="modal-title text-center" style="color: red; font-weight: bold;font-family: cursive; font-size: 31px;"><a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/congratulations.png'; ?>" alt="congratulations"><span><i>!</i></span></a></h4>
            </div> 
            <div class="modal-body">
                <h4 class="text-center">This is your professional account. You can do the following:</h4>
                <ul>
                    <li>Store unlimated digital and non-digital certificates for FREE.</li>
                    <li>Access to online courses from global authors.</li>
                    <li>Register to training offered by your institution or accredited CPD providers.</li>
                    <li>Track your CE units against required CE units for Professional Identification Card (PIC) renewal or Performance appraisal.(Subscription)</li>
                    <li>Report your digital certificates to your Professional Regularity Board.(Subscription)</li>
                    <li>Promote your professional page to show your profesional services.</li>
                    <li>Use your professional page for employment.</li>
                </ul>
                <!-- <p class="text-center">You have just activated your professional account using the </br> Professional Continuing Education Management Software (PCE-MS) PRO-Version for <b><?php echo strtoupper($checkactiveplanArr->plan_duration); ?></b> Free trial.</p>
                <p class="text-center">Please set your Required CE Units or Contract Hours and Calendar Year</br> for Your License Renewal and/ or Job Performance Appraisal.</br></br> -->

                <div class="text-center">
                    <a class="btn btn-success" onclick="ser_new_target()">Set Required Number and Calendar Year</a></p>
                </div>
                <script type="text/javascript">
                    function ser_new_target() {
                        $("#upgradeunit").modal('show');
                        $("#edittarget").modal('hide');
                        $("#upgradeunit_new").modal('hide');
					    $('.modal').css('overflow-y', 'auto');
                    }
                </script>
                                                   

            </div>
        </div> 
    </div>
</div>

		<div class="modal fade" id="upgradesuccess" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
							<center><div class="site-logo__link" style="max-width: 34%;">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
                    </div></center>
				<?php   $Idd = $this->session->userdata('logged_in')['id'];  
						$unit = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_units','user_id',$Idd);
						$target_unit = $unit[0]['unit']; ?>
						</br>  <h4 class="modal-title text-center">Your <span>New</span> Required CE Units/Contact Hours is <span><?php echo  $target_unit; ?></span></h4>
						  <p class="text-center">Start adding Your CE Units/Contact Hours by clicking one of the buttons!</p>
					</div>
					  
					<div class="modal-body">
						<form action="<?php echo BASE_URL.'professional/changecategory1';?>" method="post" enctype="multipart/form-data" name="changecategory1" id="changecategory1">
						<div class="model-btn-group">

						   <h4 class="modal-title" style="text-align: center;"><span>ADD CE UNITS OR CONTACT HOURS</span></h4>
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

<div class="modal fade" id="promoteprofeesion" role="dialog" data-keyboard="false" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><div class="site-logo__link" style="max-width: 34%;">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
                    </div></center>
                  <h4 class="modal-title text-center" style="color: red; font-weight: bold;font-family: cursive; font-size: 31px;"> <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/congratulations.png'; ?>" alt="congratulations"><span><i>!</i></span></a></h4>
            </div> 
            <div class="modal-body">

                <p class="text-center">You have posted your professional profile into the Professional Page.</p>
                
                <p class="text-center">Your profile can be seen by prospective employer for possible employment locally and abroad.</br>
                    Likewise, your profile will be visible to possible clients seeking your professional services or business.</br>
    				Please click the link below to check your name or you can view your profile page
				</p>
                
                
                <!-- <p style="text-align: center;"><a class="btn btn-success" href="<?php echo base_url('pages/latestprofessional/'); ?>">Professional Listing Page</a> -->
                <p style="text-align: center;"><a class="btn btn-info" href="<?php echo base_url('share/viewprofile/').$_REQUEST['success']; ?>">View Profile Page</a>
            </p>    
                                                   

            </div>
        </div> 
    </div>
</div>

<style type="text/css">
.dropbtn{background-color:#007ded;color:#fff;padding:4px;font-size:14px;border:none;border-radius:3px}.dropdown{position:relative;display:inline-block}.dropdown-content{display:none;position:absolute;background-color:#f1f1f1;min-width:160px;box-shadow:0 8px 16px 0 rgba(0,0,0,.2);z-index:1}.dropdown-content a{color:#000;padding:12px 16px;text-decoration:none;display:block}.dropdown-content a:hover{background-color:#ddd}.dropdown:hover .dropdown-content{display:block}.dropdown:hover .dropbtn{background-color:#3d66b0}
</style>

<?php   $connected_rboard = $this->professional_model->getConnnectedRboard($this->session->userdata('logged_in')['id']); 
// echo '<pre>'; print_r($connected_rboard);
        $domain = $connected_rboard->domain;  
        $filepath = $connected_rboard->filepath; ?>

<a href="#" id="scroll" style="display: inline;"><span></span></a>
<input type="text" hidden id="dummyone">

<script type="text/javascript">

    $(document).ready(function() {
        var first = '<?php if($firstlogin < 2){ ?>' + $("#upgradeunit").modal('hide');  $("#upgradeunit_new").modal('show'); $("#edittarget").modal('hide'); +'<?php } ?>';
        var pop = '<?php if($_REQUEST['success']!=""){ ?>' + $("#promoteprofeesion").modal('show') + '<?php } ?>';
        var pop2 = '<?php if($_REQUEST['id']=="success"){ ?>' + $("#uploadCertificateModal").modal('hide'); $("#upgradesuccess").modal('show'); + '<?php } ?>';

        $('#printCertificateBtn').on('click', '.get-certificate-print', function(){
            var certi = $(this).attr('id');
            var x = confirm('Do you want to print it?, Please click on OK.');
            if(x == true){
                var url = "<?php echo site_url('pages/download_certificate/')?>"+ certi;
                window.location.href = url;
            }
        });
        $('.profchangecategory').on('click', function(){
            var value = $(this).attr('data-value');
            var typeid = $(this).attr('data-typeid');
            $('#form_id').val(value);
            $('#form_type').val(typeid);
            $("#changecategoryDialog").modal();
        });

    });

   function uploadcerti(){ 
       // this is not working go to header home and find checklogin
        $("#upgradesuccess").modal('hide');
        $("#uploadCertificateModal").modal('show');
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


	function preview_image(image) 
    {
		$("#myModalpreviewImage").modal()
		document.getElementById('imagepreview').src = image;
	}
    var certi = 0; 
	function preview_certificate(certifiacte_no) 
    {
        certi = certifiacte_no;
		$('#dashboardcertificate').modal('show');
		$.ajax({
			type: "POST",
			url: '<?php echo base_url()."users/certificate_download";?>',
			data: { certifiacte_no: certifiacte_no },
			beforeSend: function() {
			$("#certificatehtml").html("Loading...");
		}

		}).done(function(result) {
			$("#certificatehtml").html(result);
            $("#printCertificateBtn").html('<a href="javascript:void(0);" class="btn btn-default get-certificate-print" title="Print" id="'+ certi +'"><i class="fa fa-print"></i></a>');
		});
		return false;
	}
     
    function send_rboard(id,uid,uemail)
    {
        alert(id);
        // var uid = '<?php echo $Idd; ?>';
        // var uemail = '<?php echo $uemail; ?>';
        // var certificate_identify = 0;
        // $.ajax({
        //     url: 'https://ceonpoint.com/RBoard/admin/Api/user_certificate',
        //     type: 'POST',
        //     data: JSON.stringify({
        //             user_id : uemail, course_name : course_name, units : units, start_date : start_date,
        //         end_date : end_date, certificate_id :certificate_id, certificate : certificate_id, category : category, issue_date : issue_date, issue_from : issue_from, issue_by : issue_by, cep_name : cep_name, status : status, added_on : added_on, certificate_identify : certificate_identify
        //         }),
        //     dataType: 'json',
        //     success: function(result){
        //         if(result){
        //             alert('Thanks for sending the certificate to Regulatory Board.');
        //         }else{
        //             alert('Something went wrong!');
        //         }
        //     }
        // });
    }

  
    $(document).on('click','.sendToRboard',function()
    {
        var id = $(this).attr('value');
        var uid = $(this).attr('data-id');
        var uemail = $(this).attr('name');
        $.ajax({
            url: "<?php echo base_url('professional/get_one_certificate'); ?>",
            type: 'POST',
            data: {id : id},
            success: function(getdata){
                console.log(getdata); 
                if(getdata!=''){
                    var obj = JSON.parse(getdata);
                    // alert(obj);
                    var user_email  = uemail;
                    var certificate_id = obj.certificate_id;
                    var course_name = obj.course_name;
                    var units       = obj.units;
                    var certificate = obj.certificate; // it will contain the path of pdf  
                    var category    = obj.category;
                    var issue_date  = obj.issue_date;
                    var issue_from  = obj.issue_from;
                    var issue_by    = obj.issue_by;
                    var cep_name    = obj.cep_name;
                    var domain      = '<?php echo $domain; ?>';
                    var year        = "<?php echo date('Y'); ?>";
                    // sendCertificate(domain,user_email,certificate_id,course_name,units,category,issue_date,issue_from,issue_by)   

                    $('#strb_receipt_no').html(id+'-'+year);
                    $('#strb_certificate_no').html(certificate_id);
                    $('#strb_units').html(units);
                    $('#strb_date_issued').html(issue_date);
                    $('#strb_issued_by').html(issue_by);
                    $('#strb_category').html(issue_from);
                    var multivar = {
                        'domain': domain,
                        'user_email': user_email,
                        'certificate_id': certificate_id,
                        'certificate': certificate,
                        'course_name': course_name,
                        'units': units,
                        'category': category,
                        'cep_name': cep_name,
                        'issue_date': issue_date,
                        'issue_from': issue_from,
                        'issue_by': issue_by
                    };
                    var multiValue = JSON.stringify(multivar);
                    $('#dummyone').val(multiValue);
                    $('.sendToInsSection').html('');
                    $('.sendCertificateTitle').html('Report Certificate');
                    $('#sendCertificateToRboard').modal('show');
                    $('#strb_sendCertificate').html("<a href='#' onclick='sendCertificate()' class='btn btn-primary'>Report</a>");
                }
            }
        });
    });
  
    $(document).on('click','.sendToInstitution',function()
    {
        var id = $(this).attr('value');
        var uid = $(this).attr('data-id');
        var uemail = $(this).attr('name');
        $.ajax({
            url: "<?php echo base_url('professional/get_one_certificate'); ?>",
            type: 'POST',
            data: {id : id},
            success: function(getdata){
                var content = '<div class="row"><div class="form-group col-md-6"><label for="exampleInputEmail1">Choose Recipiet</label><input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"></div><div class="form-group col-md-6"><label for="exampleInputPassword1">Password</label><input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"></div></div>';
                $('.sendToInsSection').html(content);
                $('.sendCertificateTitle').html('Send Certificate');
                $('#sendCertificateToRboard').modal('show');
            }
        });
        
    });

    function sendCertificate()
    {
        var getValue = $('#dummyone').val();
        var obj = JSON.parse(getValue);
        var domain = obj.domain; // domain url should contain '/' in the last
        var rbname = '<?php echo $connected_rboard->rboard_name; ?>';
        // console.log(obj.domain);
        $.ajax({
            url: domain+'/admin/Api/user_certificate',
            type: 'POST',
            data: getValue,
            success: function(result){
                // console.log(result);
                finalobj = JSON.parse(result)
                if(finalobj.success== true){
                    updateCertificate(obj.certificate_id,finalobj.report);
                    // alert(finalobj.msg);
                    alert('This Certificate is now successfully reported to '+ rbname +'.');
                    location.reload();
                }else{
                    alert(finalobj.msg);
                }
            }
        });
    }

    function updateCertificate(id,report)
    {
        var baurl = '<?php echo base_url(); ?>';
        $.ajax({
            url: baurl + 'professional/update_report',
            type: 'POST',
            data: {id : id, report : report },
            success: function(result){
                console.log(result);
            }
        });
    }
    // function changecategory()
    // {
    //     alert('ok');
    //     $('#form_id').val(idd);
    //     $('#form_type').val(types);
    //     $("#changecategoryDialog").modal();
    // }
</script>


 
 