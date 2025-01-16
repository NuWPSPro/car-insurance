<?php $this->load->view('template/picture_provider'); 
$datas = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_training_book','training_seminar_id',$training[0]['id']); ?>

<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-primary" href="<?php echo site_url('provider/training_center_list');?>">Back</a>
            <?php if($training[0]['training_type']==1){ ?>
                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#trainingReport">Training Report
                </a>
            <?php } ?> 
            </div>
               
            <div class="col-sm-12">
                    <?php echo $this->session->flashdata('response');?>
                <h3 class="border-title text-left"><?php echo $training[0]['title'];?></h3>
                <div class="step-wise-query">
                    <table id="" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>Start Time</th>
                                <th>Location</th>
                                <th>Speaker</th>
                                <th>Price</th>
                                <th>Contact Person</th>
                                <th>Contact Phone</th>
                                <th>Contact Email</th>
                                <th>CP Number</th>
                               <!--  <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                <?php  foreach ($training as $key => $value) { ?>
                            <tr>
                                <td>
                                    <?php echo $key+1; ?>
                                </td>
                                <td>
                                    <?php echo $value['title']; ?>
                                </td>
                                <td>
                                    <?php echo $value['start_date'].' '.$value['end_date']; ?>
                                </td>
                                <td>
                                    <?php echo $value['start_time'].' '.$value['end_time']; ?>
                                </td>
                                <td>
                                    <?php echo $value['location']; ?>
                                </td>
                                <td>
                                    <?php echo $value['speaker']; ?>
                                </td>
                                <td>
                                    <?php echo $value['price']; ?>
                                </td>
                                <td>
                                    <?php echo $value['contact_person']; ?>
                                </td>
                                <td>
                                    <?php echo $value['phone']; ?>
                                </td>
                                <td>
                                    <?php echo $value['email']; ?>
                                </td>
                                <td>
                                    <?php echo $value['cp_number']; ?>
                                </td>
                              <!--   <td>
                                    <a  class="btn btn-primary" title="View" href="#"><i class="fa fa-eye"></i></a>&nbsp; 
                                    <a href="#" class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;
                                    <a class="btn btn-danger" title="Delete" href="#"><i class="fa fa-trash"></i></a>&nbsp; 
                                </td> -->
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12">
            	<hr style="border-bottom: 2px solid #eee;">
            </div>






          
                <!-- <a href="javascript:void(0)" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createcertificate">Create Certificate</a> -->
                
                <?php 
                $tid = $this->uri->segment(3);
                ?>
                <div class="col-sm-12">
                    <div class="pull-right">
                    <?php if($datas){ ?>
                        <a target="_blank" href="<?php echo site_url('provider/template/'.$tid);?>" class="btn btn-primary">Create Certificate</a>
                    <?php }else{ ?>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="alert('You don\'t have Participats!!!')">Create Certificate</a>
                    <?php } ?>
                    </div>
                    <div class="pull-left">
                        <h3 class="border-title text-left">Participants</h3>
                    </div>
                </div>
                
            <div class="col-sm-12">

                <div class="step-wise-query">
                    <?php //echo $this->session->flashdata('response');?>

                    <table id="examples" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th> 
                                <th>Certificate</th>
                                <th>Attendance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
        <?php 
           if(!empty($datas)){
		   foreach ($datas as $key => $value){ ?>
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
                                <td>
                                <?php if($value['certificate_id'] !=""){
                                    $filename = $value['certificate_id']; ?>
                                <!-- http://wps-dev.com/dev/mycpd/assets/upload/pdf/7720821545244805.pdf -->
                                <a class="btn btn-primary" title="View Certificate" target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>"><i class="fa fa-file-pdf-o"></i></a>
                                
                                <?php }else{  echo'N/A'; } ?>
                                <td>
                            

                                <?php 
                                if($value['present_status']==0){
                                ?>
                                <a href="<?php echo site_url('provider/presentstatus/0/'.$value['id'].'/'.$tid); ?>" style="color: red;">Absent</a>    
                                <?php 
                                } else {
                                ?>
                                <a href="<?php echo site_url('provider/presentstatus/1/'.$value['id'].'/'.$tid); ?>" style="color: green;">Present</a>    
                                <?php 
                                }
                                ?>
                                </td>
                                <td><a onclick="return confirm('Are you sure? you want to delete it.')"  class="btn btn-danger" title="Delete" href="<?php echo site_url('provider/deletecerti/'.$value['id'].'/'.$tid.''); ?>"><i class="fa fa-trash"></i></a></td>
                                 

                            </tr>
                            <?php } }else{ echo '<th colspan="6"><center>Sorry no records foundsss.</center></th>'; } ?>
                        </tbody>
                    </table>
            </div>
        </div>

         <?php if($training[0]['training_type']==1){ ?>   
        <div class="col-sm-12">  
        <h3 class="border-title text-left pull-left" onclick="evaluatenow_details();">Evaluation</h3>
        <br><br>

        <div class="evaluate_now" style="width: 100%; clear: both;">
            <div class="content">
            <?php $tdata22 = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$this->uri->segment(3)); ?>
                <ul class="nav nav-tabs">
                <?php foreach ($tdata22 as $key => $value1){
                        $key = $key+1; 
                        if($value1['speaker_image'] !=""){ ?> 
                <li onclick="speaker_name('<?php echo $value1['speaker_name']; ?>','<?php echo $value1['id']; ?>')" class="<?php if($key==1){ echo "active";} ?>"><a data-toggle="tab" href="#menu<?php echo $key; ?>"><img src="<?php echo base_url('assets/images/uploads/').$value1['speaker_image']; ?>" alt="">
                <p><?php echo $value1['speaker_name']; ?></p>
                </a></li><?php } ?>
            <?php } ?>
                <li onclick="speaker_name('SYMPOSIUM','s_<?php echo $tr_id; ?>')"><a data-toggle="tab" href="#menu555"><img src="<?php echo base_url('assets/images/uploads/symposium.png'); ?>" alt=""><p>SYMPOSIUM</p></a></li> 
                </ul>

<div class="title-box">
    <h4><span id="speaker_name"><?php echo $tdata22[0]['speaker_name']; ?></span></h4>
</div>

<div class="tab-content">
    <div id="home" class="tab-pane fade in ">
        <h3>Q.1 How would rate overall the ICS Symposium 2019?</h3>
        <div class="Rating">
            <input type="radio" name="star" id="star1"><label for="star1"></label>
            <input type="radio" name="star" id="star2"><label for="star2"></label>
            <input type="radio" name="star" id="star3"><label for="star3"></label>
            <input type="radio" name="star" id="star4"><label for="star4"></label>
            <input type="radio" name="star" id="star5"><label for="star5"></label>

        </div>
    </div>
</div>
</div>

<?php $tr_id = $this->uri->segment(3); ?>
    
<script type="text/javascript">
function speaker_name(speaker_name,idd){

    if(speaker_name=="SYMPOSIUM"){
        types = 2;
    } else {
        types = 1;
    }

    $('#speaker_name').html(speaker_name);
    $('#commentdata').html('Please wait...');
    var trid = "<?php echo $tr_id; ?>";

    $.ajax({
    type: "POST",
    url: 'https://ceonpoint.com/index.php/pages/getcomment',
    data: {types:types,trid:trid,idd:idd}
    }).done(function( result ) {
    // alert(result);
    $("#commentdata").html( result );
    });
    return false;
}
speaker_name('<?php echo $tdata22[0]['speaker_name']; ?>','<?php echo $tr_id;?>');
</script> 
   <div id="commentdata"></div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
</div>



<!-- Modal -->
<div id="createcertificate" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Certificate</h4>
            </div>
            <div class="modal-body">
                <?php 
				$uid = $this->session->userdata('logged_in')['id'];
				$udata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
				 

				//if($udata[0]['template_plan']==0){

				?>
                <p style="font-weight: bold;">You have to choose plan to select templates for the certificate.</p>
                <p>
                    <?php 
					$plan = $this->user->get_record_by_field_name_all_record('tbl_template_plan','status',1);
					?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="bg-primary">
                                <th>No</th>
                                <th>Plan Name</th>
                                <th>No of Templates</th>
                                <th>Plan Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
						    $tid = $this->uri->segment(3);
						    foreach ($plan as $key => $value) {
						    ?>
                            <tr>
                                <td>
                                    <?php echo $key+1;?>
                                </td>
                                <td>
                                    <?php echo $value['plan_name'];?>
                                </td>
                                <td>
                                    <?php echo $value['allow_template'];?>
                                </td>
                                <td>$
                                    <?php echo $value['amount'];?>
                                </td>
                                <td><a class="btn btn-success" href="javascript:void(0);" target="_blank" onclick="byplan('<?php echo $value['id'];?>','<?php echo $tid;?>','<?php echo $value['amount'];?>');">Buy Now</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </p>
                <?php 


// } else {

$purchased_plan = $this->user->get_record_by_field_name_all_record('tbl_template_plan','id',$udata[0]['template_plan']);
 
?>
                <p style="font-weight: bold;">Please select the template to generate the certificate.</p>
                <div class="template-select mb-5">
                    <?php 
for ($i=1; $i <=$purchased_plan[0]['allow_template']; $i++) { 
	?>
                    <label for="planchange<?php echo $i;?>">
                    	<input type="radio" name="planchange" id="planchange<?php echo $i;?>" onchange="planchange('<?php echo $i;?>')" <?php if($udata[0]['default_template']==$i){ echo "checked" ;} ?>>
                    	<img src="<?php echo BASE_URL.'assets/templates/template'.$i.'/certificate.jpg'; ?>" style="width: 100px;">
                    	<i class="fa fa-check"></i>
                    </label>
                    <?php 
}
?>
                </div>
                <table id="example1" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

           $datas = $this->user->get_record_by_field_name_all_record('tbl_training_book','training_seminar_id',$training[0]['id']);	

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
                            <td>
                                <?php echo $value['phone']; ?>
                            </td>
                            <?php 
					$cpdid   = $uid;
					$cust_id = $value['id'];
					?>
                            <td><a target="_blank" class="btn btn-info" href="<?php echo site_url('provider/mypdf/'.$cpdid.'/'.$cust_id);?>">Generate Certificate</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php 
       if(empty($datas)){
       	?>
                <p>Sorry no records founds.</p>
                <?php 
       }

  // }
       ?>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">
$(document).ready(function() {
    $('#example,#example1').DataTable();
    $('#examples').DataTable();
});
</script>




<div class="modal fade" id="trainingReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog traningreport" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">TRAINING REPORT</h4>
            </div>
            <div class="modal-body">
                <!-- Tab panes -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">

                             <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">General Information</a></li>

                              <li role="presentation"><a href="#messages" aria-controls="messages"
                                    role="tab" data-toggle="tab">Overview</a></li> 


                            <li role="presentation"><a href="#tabvenue" aria-controls="tabvenue"
                                    role="tab" data-toggle="tab">Venue</a></li>

                           
                             <li role="presentation"><a href="#tabspeaker" aria-controls="tabspeaker" role="tab" data-toggle="tab">Speaker</a></li>    

                               <li role="presentation"><a href="#participants" aria-controls="participants"
                                    role="tab" data-toggle="tab">Participants</a></li>

                           

                            <li role="presentation"><a href="#settings" aria-controls="settings"
                                    role="tab" data-toggle="tab">Schedule</a></li>

                            <li role="presentation"><a href="#evaluation" aria-controls="evaluation"  role="tab" data-toggle="tab">Evaluation</a></li>

                            <li role="presentation"><a href="#tabsponsors" aria-controls="tabsponsors"  role="tab" data-toggle="tab">Sponsors</a></li>

                            <li role="presentation"><a href="#certificate_sample" aria-controls="certificate_sample"  role="tab" data-toggle="tab">Certificate Sample</a></li>


                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">



                        	<div role="tabpanel" class="tab-pane" id="participants">
                                <div class="row" id="tab_printsection">
                                    <div class="col-md-12" style="margin-top: 52px;">
                                        <div class="overview">
                                         <h3 class="border-title text-left">Participants</h3>

                                        <div class="pull-right icons">

                                        <a href="javascript:void(0);" onclick="printElem('tab_printsection');"> <i class="fa fa-print" aria-hidden="true"></i></a> 

                                        </div>


                                            <div class="table-responsive tabc">
							                     <table id="example11" class="table table-striped table-bordered" style="width:100%">
							<thead>
							<tr>
							    <th>No.</th>
							    <th>Name</th>
							    <th>Email</th> 
							    <th>Certificate</th>
							</tr>
							</thead>
							<tbody>
							<?php 

							$datas = $this->user->get_record_by_field_name_all_record('tbl_training_book','training_seminar_id',$training[0]['id']); 

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
							    <td>
							        <!-- http://wps-dev.com/dev/mycpd/assets/upload/pdf/7720821545244805.pdf -->
							        <a class="btn btn-primary" title="View Certificate" target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>"><i class="fa fa-file-pdf-o"></i></a></td>
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
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div role="tabpanel" class="tab-pane" id="tabvenue">
                                <div class="row" id="tab_printsection">
                                    <div class="col-md-12">
                                        <div class="overview">
                                         <h3 class="border-title text-left">Venue</h3>

                                        <div class="pull-right icons">

                                        <a href="javascript:void(0);" onclick="printElem('tab_printsection');"> <i class="fa fa-print" aria-hidden="true"></i></a> 

                                        </div>


                                            <div class="table-responsive tabc">
                                                <table class="table table-bordered">
                                                     
                                                    <tr> 
                                                        <td><?php echo $training[0]['location'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                          <h5>University of the Bahamas, Nursing Campus within the compound of the pirncess margaret hospital nassau, Bahamas</h5>
                                                      </td>
                                                  </tr>
                                                  <tr>
												<td>

												<img src="<?php echo base_url('assets/images/bhasmas-pic.png'); ?>" style="max-width: 100%;">
												</td>
											</tr>
											<tr>
												<td><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d464017.3661583873!2d-78.19046484520757!3d24.687862427033366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d69a3bb2480f3d%3A0x133eb4836ac779e5!2sThe+Bahamas!5e0!3m2!1sen!2sin!4v1558701918021!5m2!1sen!2sin" width="100%" height="480" frameborder="0" style="border:0" allowfullscreen></iframe></td>
											</tr> 
                                                     

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div role="tabpanel" class="tab-pane" id="tabspeaker">
                                <div class="row" id="tab_printsection">
                                    <div class="col-md-12">
                                        <div class="overview">
                                         <h3 class="border-title text-left">Speaker</h3>

                                        <div class="pull-right icons">

                                        <a href="javascript:void(0);" onclick="printElem('allspeaker');"> <i class="fa fa-print" aria-hidden="true"></i></a> 

                                        </div>


                                            <div class="table-responsive tabc">
                                                <table class="table table-bordered">
                                                     
                                                    <tr>
                                                    	  <?php 
                $tdata = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$training[0]['id']);
                $sdata = $tdata;
                foreach ($tdata as $key => $value) {
                ?>
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <div class="speaker">
                        <div class="speaker-image">
                            <div class="speaker-image-wrapper">
                                <?php 
                                if($value['speaker_image'] !=""){
                                ?>
                                
                                <a href="javascript:void(0);" onclick="speaker_details('<?php echo $value['id']; ?>')">
                                <img src="<?php echo base_url('assets/images/uploads/').$value['speaker_image']; ?>">
                                </a>

                                <?php } ?>
                            </div>
                        </div>
                        <h4 class="speaker-title"><a onclick="speaker_details('<?php echo $value['id']; ?>')" href="javascript:void(0);"><?php echo $value['speaker_name']; ?></a></h4>
                     <!--    <p class="speaker-designation">CEO, The Sage Group</p> -->
                    </div>
                </div>
                
                <?php 
                }
                ?> 
                                                    </tr>
                                                    
                                                     

                                                </table>
                                            </div>


<span id="allspeaker">
    <?php  

     $tdata = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$training[0]['id']);
                $sdata = $tdata;
        foreach ($tdata as $key => $value) {


     $speakerid = $value['id'];
     $sdata1    = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','id',$speakerid);

    foreach ($sdata1 as $key => $value) {
    ?>
        <?php 
        if($value['speaker_image'] !=""){
        ?>
        <div class="speaker-image-big">
            <a href="javascript:void(0);" onclick="speaker_details('<?php echo $value['id']; ?>')">
                <img src="<?php echo base_url('assets/images/uploads/').$value['speaker_image']; ?>">
            </a>
        

        <?php } ?>

        <h4 class="speaker-title"><a onclick="speaker_details('<?php echo $value['id']; ?>')" href="javascript:void(0);"><?php echo $value['speaker_name']; ?></a></h4>
        </div>
        <div class="description_popup">
        <p>Position: <span><?php echo $value['position']; ?></span></p>
        <p>Address: <span><?php echo $value['insititution']; ?></span></p>
        </div>

        <p><?php echo $value['speaker_description']; ?> </p>
    <?php 
    }
}
    ?>
</span>




                                        </div>
                                    </div>
                                </div>
                            </div>

                            




                             <div role="tabpanel" class="tab-pane" id="certificate_sample">
                                <div class="row" id="tab_tabsponsors">
                                    <div class="col-md-12">
                                        <div class="overview">
                                         <h3 class="border-title text-left">Certificate Sample</h3>

                                        <div class="pull-right icons">

                                        <a href="javascript:void(0);" onclick="printElem('tab_tabsponsors');"> <i class="fa fa-print" aria-hidden="true"></i></a> 

                                        </div>

                                            <div class="table-responsive tabc" style="text-align: center">

                                             <!-- <img src="http://ceonpoint.com/assets/images/certificateimage.png">  -->
                                            
                                            <?php foreach($templete as $temp){ 
                                            if($certificate['templete_id'] == $temp->id ){ 
                                            $bg_image = $temp->bg_image;
                                            $text_image = $temp->text_image; ?>
                                                <tr>      
                                                    <td>
                                                    <img style="width:100%;" src="<?php echo ASSETS_URL.'upload/certificate_templete/'.$temp->temppreview;?>" alt="<?php echo $temp->template_no.' * '.$temp->category; ?>" > 
                                                    </td> 
                                                </tr>
                                            <?php } } ?> 

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>






                            	<div role="tabpanel" class="tab-pane" id="tabsponsors">
                                <div class="row" id="tab_tabsponsors">
                                    <div class="col-md-12">
                                        <div class="overview">
                                         <h3 class="border-title text-left">Sponsors</h3>

                                        <div class="pull-right icons">

                                        <a href="javascript:void(0);" onclick="printElem('tab_tabsponsors');"> <i class="fa fa-print" aria-hidden="true"></i></a> 

                                        </div>


                                            <div class="table-responsive tabc">
                                                <table class="table table-bordered">
                                                     
                                                    <tr> 

                                                    	 <?php 

                        $tdata = $this->user->get_record_by_field_name_all_record('tbl_training_sponsors','training_id',$training[0]['id']);
                        foreach ($tdata as $key => $value) {
                        ?> 

 							
                            <td>
                           <a target="_blank" href="<?php echo $value['urls']; ?>">
                           	<img height="90" width="90" src="<?php echo base_url('assets/images/uploads/').$value['sponsors_image']; ?>" alt="" >
                           </a>
                            </td>

                            
                            <?php 
                            }
                            ?>  



                                                    </tr>
                                                     

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div role="tabpanel" class="tab-pane" id="home">

                                <div class="col-sm-12 table_msrgin" id="participants_printsection">
                                    <!-- <a href="javascript:void(0)" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createcertificate">Create Certificate</a> --> 

                                    <h3 class="border-title text-left pull-left">Participants</h3>

                                     <div class="pull-right icons">
                                    
                                    <a href="javascript:void(0);" onclick="printElem('participants_printsection');"> <i class="fa fa-print" aria-hidden="true"></i></a> 
                                </div>

                    <div class="step-wise-query">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Certificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

           $datas = $this->user->get_record_by_field_name_all_record('tbl_training_book','training_seminar_id',$training[0]['id']); 

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
                                <td>
                                    <?php echo $value['phone']; ?>
                                </td>
                                <?php 
                    if($value['certificate_id'] !=""){
                        $filename = $value['certificate_id'];
                        ?>
                                <td>
                                    <!-- http://wps-dev.com/dev/mycpd/assets/upload/pdf/7720821545244805.pdf -->
                                    <a class="btn btn-primary" title="View Certificate" target="_blank" href="<?php echo BASE_URL.'assets/upload/pdf/'.$filename.'.pdf';?>"><i class="fa fa-file-pdf-o"></i></a></td>
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
                <?php 
                if(empty($datas)){
                ?>
                <p>Sorry no records founds.</p>
                <?php 
                }
                ?>
                    

                                       
                                    </div>
                                </div>
                            </div>

                
                            <div role="tabpanel" class="tab-pane active" id="profile">
                                <section class="icons" id="printsection"> 
                                <div class="pull-right">
                                    
                                    <a href="javascript:void(0);" onclick="printElem('printsection');"> <i class="fa fa-print" aria-hidden="true"></i></a>

                                    <a href="#"> <i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                </div>
                                    <div class="table_msrgin">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- <img src="images/test.jpg" alt=""> -->
                                               <!--  <img src="<?php echo BASE_URL?>assets/images/test.jpg"> -->

                                                <img src="<?php echo base_url('assets/images/uploads/').$training[0]['image']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table_ourside_border">
                                                    <h3>general information</h3>
                                                    <div class="table-responsive tabc">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td>Title:</td>
                                                                <td><?php echo $training[0]['title'];?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>Unit:</td>
                                                                <td><?php echo $training[0]['units'];?></td>

                                                            </tr>
                                                            <tr>
                                                                <?php 
                                                            $sdate  = strtotime($training[0]['start_date']);
                                                            $stdate = date('d-M-Y', $sdate);

                                                            $edate  = strtotime($training[0]['end_date']);
                                                            $enddate = date('d-M-Y', $edate);

                                                                ?>
                                                                <td>Date:</td>
                                                                <td><?php echo $stdate;?> to <?php echo $enddate;?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>Time:</td>
                                                                <td><?php echo $training[0]['start_time'];?> to <?php echo $training[0]['end_time'];?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>Contact Person:</td>
                                                                <td><?php echo $training[0]['contact_person'];?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>contact number:</td>
                                                                <td><?php echo $training[0]['phone'];?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>Email:</td>
                                                                <td><?php echo $training[0]['email'];?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>Ticket Price:</td>
                                                                <td>$<?php echo $training[0]['price'];?></td>

                                                            </tr>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <h4>Location</h4>
                                                <!-- <img src="images/Homepage_Banner_World_Maps.jpg" alt=""> -->
                                                <img src="<?php echo BASE_URL.'assets/images/Homepage_Banner_World_Maps.jpg';?>">
                                            </div>

                                        </div>
                                    </div>


                                </section>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="messages">
                                <div class="row" id="overview_printsection">
                                    <div class="col-md-12" style="margin-top: 52px;">
                                        <div class="overview">
                                         <h3 class="border-title text-left">overview</h3>

                                        <div class="pull-right icons">

                                        <a href="javascript:void(0);" onclick="printElem('overview_printsection');"> <i class="fa fa-print" aria-hidden="true"></i></a> 

                                        </div>


                                            <div class="table-responsive tabc">
                                                <table class="table table-bordered">
                                                     
                                                    <tr>
                                                        <td><strong> Objective: </strong></td>
                                                        <td><?php echo $training[0]['objectives'];?></td>

                                                    </tr>
                                                    <tr>
                                                        <td><strong>Methodologives:</strong></td>
                                                        <td><?php echo $training[0]['methodologies'];?></td>

                                                    </tr>
                                                    <tr>
                                                        <td><strong>Item to bring:</strong></td>
                                                        <td><?php echo $training[0]['item_to_bring'];?></td>

                                                    </tr>
                                                    <tr>
                                                        <td><strong>Contact number:</strong></td>
                                                        <td><?php echo $training[0]['phone'];?></td>

                                                    </tr>

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div role="tabpanel" class="tab-pane" id="settings">
                            
                                <div class="row" id="schedule_printsection">
                                    <div class="col-md-12" style="margin-top: 52px;">
                                        <div class="overview">
                                         <h3 class="border-title text-left">Schedule</h3>

                                         <div class="pull-right icons">

                                        <a href="javascript:void(0);" onclick="printElem('schedule_printsection');"> <i class="fa fa-print" aria-hidden="true"></i></a> 

                                        </div>


                                            <div class="table-responsive tabc">
                                               

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Speaker</th>
                    <th>Topic</th>
                    <th>Schedule Date</th>
                    <th>Schedule Start Time</th>
                    <th>Schedule Start Time</th>
                </tr>
                </thead>
                <tbody>
                <?php 

                $datas = $this->user->get_record_by_field_name_all_record('tbl_training_schedule','training_id',$training[0]['id']); 

                foreach ($datas as $key => $value) {

                     $speakerd = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','id',$value['speaker_id']); 


                ?>
                <tr>
                    <td>
                        <?php echo $key+1; ?>
                    </td>

                    <td>
                        <?php echo $speakerd[0]['speaker_name']; ?>
                    </td>

                    <td>
                        <?php echo $value['topic']; ?>
                    </td>
                    <td>
                        <?php echo $value['schedule_date']; ?>
                    </td>
                    <td>
                        <?php echo $value['schedule_start_time']; ?>
                    </td>

                    <td>
                        <?php echo $value['schedule_end_time']; ?>
                    </td>

                    <?php 
                $cpdid   = $uid;
                $cust_id = $value['id'];
                ?> 
                <td></td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
                <?php 
                if(empty($datas)){
                ?>
                <p>Sorry no records founds.</p>
                <?php 
                }

                // }
                ?>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div role="tabpanel" class="tab-pane" id="evaluation">
                            
                                <div class="row" id="evaluation_printsection">
                                    <div class="col-md-12" style="margin-top: 52px;">
                                        <div class="overview">
                                         <h3 class="border-title text-left">Evaluation</h3>

                                           <div class="pull-right icons">

                                        <a href="javascript:void(0);" onclick="printElem('evaluation_printsection');"> <i class="fa fa-print" aria-hidden="true"></i></a> 

                                        </div>

                                          

                <div class="table-responsive tabc">
                Evaluation

                <!--  Speakers Section starts from here    -->   

                <?php 
                $tdata22 = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$this->uri->segment(3));

                ?> 
                <?php   

                foreach ($tdata22 as $key => $value1) {
                $key = $key+1;
                ?>

                <?php 
                if($value1['speaker_image'] !=""){
                ?> 

                <p><a data-toggle="tab" href="#menu<?php echo $key; ?>"><img src="<?php echo base_url('assets/images/uploads/').$value1['speaker_image']; ?>" alt="" style="height: 150px; width: 150px;">
                <p><?php echo ucfirst($value1['speaker_name']); ?></p>
                </a>

                <h3 class="border-title text-left">Rating</h3>


                <?php


                $tr_id = $tid;
                $type  = 1;
                $idd   = $this->input->post('idd');

                $where = array('training_id'=>$tr_id,'evaluation_type'=>$type);
                $evaluation  = $this->user->get_record_by_field_name_all_record11('tbl_training_evaluation',$where);

                $data['tr_id'] = $tr_id;
                $data['type']  = $type;
                $data['idd']   = $value1['id'];

                $data['evaluation'] = $evaluation;
                $this->load->view('pages/getcomment',$data);

                //echo '<pre>';
                //print_r($evaluation);
                ?>




               <!--  <h3 class="border-title text-left">Comments</h3> -->
                <?php  
                 //$where = array('speaker_id'=>$value1['id'],'training_id'=>$tid);
                 //$evaluation = $this->user->get_record_by_multi_field_name('tbl_training_review',$where); 


                //foreach ($evaluation as $key => $value) {

               // $key = $key+1;

                //if($value['comments'] !=""){
                //echo '<p>'.$key.'. '.$value['comments'].'</p>';
               /// }

                //}
                ?> 

                </p>

                <?php } } ?>

                <p><a data-toggle="tab" href="#menu555" aria-expanded="true">
                	<img src="<?php echo ASSETS_URL.'images/uploads/symposium.png'; ?>" alt="">
                <p>SYMPOSIUM</p>
                </a></p>


           
                <!--  Speakers Section ends from here    -->   






                                             
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>







<script type="text/javascript">
function planchange(idd) {
    //alert(idd);

    $.ajax({
        type: "POST",
        url: '<?php echo base_url()."provider/setdefault";?>',
        data: { idd }
    }).done(function(result) {
        //alert(result);
        $("#filteredData2").html(result);
    });
    return false;


}
</script>
<script type="text/javascript">
function byplan(plan_id, tid, amount) {
    var item = plan_id + '_' + tid;
    $('#item_name').val(item);
    $('#amount').val(amount);
    document.getElementById("frmPayPal1").submit();
}
</script>
<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name" value="">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" id="amount" value="">
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('provider/cancel_provider_plan'); ?>">
    <input type="hidden" name="return" value="<?php echo site_url('provider/success_provider_plan'); ?>">
</form>
<script type="text/javascript">
//document.getElementById("frmPayPal1").submit();
</script>



<script type="text/javascript">
    
    function printElem(divId) {
    var content = document.getElementById(divId).innerHTML;
    var mywindow = window.open('', 'Print', 'height=600,width=800');

    mywindow.document.write('<html><head><title>Print</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(content);
    mywindow.document.write('</body></html>');

    mywindow.document.close();
    mywindow.focus()
    mywindow.print();
    mywindow.close();
    return true;
}

</script>

	<style>
	.modal-body p {
	    font-size: 14px;
	    margin: 15px 0;
	    color: #555;
	}
	.modal-body .question {
	    margin-left: 35px;
	    margin-top: -20px;
	}
	.star-checkbox{
	    display:none;
	}
	.star-checkbox + label{
	    display:inline-block;
	    cursor: pointer;
	    width:15px;
	}

	.star-checkbox + label:before {
	    content: '\f005';
	    font-family:'fontawesome';
	    color:#000;

	    background-color:#fff;
	}
	.star-checkbox:checked + label:before{
	   background-color:#fff;
	   color: #f9b111;
	   transition: all .2s ease-in-out;
	 }

	.form-check {
	    margin-top: -5px;
	}
	.form-check label {
	    margin: 0px 5px 0px;
	    vertical-align: text-top;
	    font-size: 12px;
	    color: #000;
	    letter-spacing: .5px;
	}
	.socials-icons{
	    position:fixed;
	     top:30%;
	      left:0;
	      z-index: 99999;
	}

	.socials-icons a {
	    font-size: 25px;
	    color: #fff;
	    background:#4565a2;
	    display: block;
	    padding: 15px;
	    width: 100%;
	    text-align: center;
	    text-decoration: none;
	}

	.socials-icons .socials-link2{
	    background:#60b4f0;
	}

	.socials-icons .socials-link3{
	    background:#bb1217;
	}

	.socials-icons .socials-link4{
	    background:#e15641;
	}

	.socials-icons .socials-link5{
	    background:#d3262c;
	}

	.socials-icons .socials-link6{
	    background:#0a80bd; 
	    
	}
	.evaluate_now .nav-tabs>li.active>a{
	    background-color: transparent;
	    border: 1px solid transparent;
	}
	.evaluate_now .nav-tabs>li {
	    margin-bottom: -1px;
	    display: inline-block;
	    float: none;
	    width: 100%;
	}
	.evaluate_now .nav-tabs>li:last-child{
	    background:#fff;
	}
	.evaluate_now .nav-tabs>li:last-child P{
	    color:#000;
	}

	.evaluate_now .nav-tabs>li.active>a img {
	    border: 3px solid rgba(256,256,256,0.8);
	}
	span#speaker_name {
	    color: #92278f;
	}
	input#save {
	    padding: 7px 20px;
	    font-size: 16px;
	    font-weight: normal;
	    border-radius: 3px;
	    background-color: #92278f;
	    color: #fff;
	    border: none;
	}
	.evaluate_now .nav-tabs {
	    background-image:url(<?php echo ASSETS_URL.'images/templates/homet2-speaker-bg.jpg';?>);
	    background-repeat: no-repeat;
	    background-size: cover;
	    text-align: center;
	    background-position: 50% 32%;
	    padding: 0 0;
	    margin-bottom: 30px;
	    display: flex;
	    /* align-items: center; */
	    justify-content: space-around;
	}

	.evaluate_now .nav-tabs img {
	    width: 60px;
	    border-radius: 50%;
	    height: 60px;
	    object-fit: cover;
	    border: 3px solid rgba(256,256,256,0.4);
	}

	.evaluate_now .nav-tabs P {
	    color: #fff;
	    font-size: 11px;
	    margin: 10px 0;
	}

	.evaluate_now .nav-tabs a:hover {
	    background: #000;
	    color:#000;
	}

	.evaluate_now .nav-tabs>li>a:hover {
	    border-color: #000;
	    color:#000;
	}

	.evaluate_now .nav>li>a:focus,
	.evaluate_now .nav>li>a:hover {
	    text-decoration: none;
	    background-color: transparent;
	    color:#000;
	    border: transparent;
	}
	.evaluate_now{
	    width:80%;
	}
	.evaluate_now .nav-tabs>li>a {
	    height: 121px;
	}
	.icu_history {
	    font-size: 20px;
	    color: red;
	}
	@media (max-width:767px){
	.socials-icons a {
	font-size:20px;
	display: inline-block;
	padding: 15px;
	width: 72.6px;
	margin: -2px;
	}
	.socials-icons {
	top: 93%;
	width: 100%;
	}
	}
	</style>