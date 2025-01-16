 <?php $this->load->view('admin/picture'); ?>
 <div class="innerContent admin-course_listingpanel">
	<div class="container"> 
		<div class="row">

		<?php $this->load->view('admin/sidebar'); ?>	

            <div class="col-sm-9">
            <h3 class="border-title text-left">Online Course Listing</h3>
                <?php echo $this->session->flashdata('response');?> 
                <form method="POST" action="<?php echo BASE_URL('admin/training_center_list');?>" id="traningfilterform"class="form-inline">
						<div class="form-group">
						<label for="first_name" class="sr-only">Country</label>
						<select name="country" class="form-control" style="width:200px;">
								<option value="" >Choose any country</option>
								<?php foreach($countries as $count){ ?>
								<option value="<?php echo $count['countries_id']; ?>" <?php if($_POST['country']==$count['countries_id']){echo'selected';} ?> ><?php echo $count['countries_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
						<label for="last_name" class="sr-only">CE Provider</label>
						<select name="ceprovider" class="form-control" style="width:200px;">
								<option value="" >Choose any CE provider</option>
								<?php foreach($cproviders as $cp){ ?>
								<option value="<?php echo $cp['id']; ?>" <?php if($_POST['ceprovider']==$cp['id']){echo'selected';} ?> ><?php echo $cp['name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
						<label for="last_name" class="sr-only">Institution</label>
						<select name="institution" class="form-control" style="width:200px;">
								<option value="" >Choose any institution</option>
								<?php foreach($insititutions as $inti){
										if($inti['insititution_id']==''){ continue; } ?>
								<option value="<?php echo $inti['insititution_id']; ?>" <?php if($_POST['institution']==$inti['insititution_id']){echo'selected';} ?> ><?php echo $inti['name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="last_name" class="sr-only">Date</label>
							<input type="date" name="date" class="form-control" style="width:200px;" value="<?php echo set_value('date')?>">
							<input type="hidden" name="status" id="trstatus" value="">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">Submit</button>
						</div>
					</form>

                <div class="step-wise-query">
    			  
                <div class="table-responsive">
                    <table id="cor-list" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Course Title</th> 
                                <th>Units</th> 					
                                <th>Author</th> 
                				<th>CE Provider</th> 
                				<th>Institution</th> 
                				<th>Accreditation No.</th>                      
                                <th>Course Validity</th>  
                                <th>Date Uploaded</th> 
                				<th>Country</th>  
                                <th>Status</th> 
                                <th>Accreditation Verification</th>   
                                <th>Access</th>  
                                <th>Action</th>  
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($course as $key => $value){ ?>
                                    <?php 
                                    if($value['status'] == 1 && $value['disabled_by']==0){ 
                                        $status = '<span style="color:green;">Active</span>'; 
                                        $access = '<span style="color:green;">Enable</span>'; 
                                        $vastyle = 'display:none';
                                    }elseif($value['status'] == 0 && $value['disabled_by'] > 0){ 
                                        $status = '<span style="color:red;">Inactive<span>'; 
                                        $access = '<span style="color:red;">Disable<span>'; 
                                        $vastyle = '';
                                    }elseif($value['status'] == 3 && $value['disabled_by'] == 0){ 
                                        $status = '<span style="color:orange;">Save Only<span>'; 
                                        $access = '<span style="color:red;">Disable<span>'; 
                                        $vastyle = '';
                                    }else{ 
                                        $status = '<span style="color:red;">Pending<span>'; 
                                        $access = '<span style="color:red;">Inactive<span>'; 
                                        $vastyle = '';
                                    }  ?>
                                <tr>
                                    <td><?php echo $key+1; ?>.</td> 
                                    <td><?php echo $value['course_title']; ?></td>  
                					<td><?php echo $value['units']; ?></td>  
                					<?php if(!empty($value['author_reference_id'])){ $author= $value['name'];}else {$author= "--"; }?> 
                                    <td><?php echo $author; ?></td> 
                					<?php $providerofauthor = $this->db->get_where('tbl_user',array('id'=>$value['author_reference_id']))->row_array()['name']; ?>
                					<?php if(!empty($value['author_reference_id'])){ $provider= $providerofauthor;}else {$provider= $value['name']; }?>
                                    <td><?php echo $provider; ?></td>
                					<?php $ins_id = end(explode('-', $value['insititution_id'])); ?>
                					<?php $ins_name = $this->db->get_where('tbl_user',array('id'=>$ins_id))->row_array()['name'];?> 
                					<?php if($ins_name != ''){ $insititution = $ins_name; }else { $insititution = "--"; } ?> 
                                    <td><?php echo $insititution; ?></td> 
                                    <td><?php echo $value['course_acceditation_number']; ?></td> 
                					<td><?php echo $value['course_validity']; ?></td>  
                                    <td><?php echo $value['added_on']; ?></td>  
                                    <td><?php echo $value['countries_name']; ?></td>  
                                    <!-- <td><a style="color: <?php echo $col;?>;" href="<?php echo site_url('admin/change_course_status/'.$value['id'].'/'.$value['status'].'');?>" title="Change Status"><?php echo $stts; ?></a> -->
                                    <td><?php echo $status; ?></td>
                                    <td><a href="javascript:void(0)" id="accreditationVerificationDoc" data-value="<?php echo $value['accreditation_verification_doc']; ?>" title="Click here to view"><?php echo $value['accreditation_verification_doc']; ?></a></td>
                                    <td><?php echo $access; ?></td>

                                    <td>
                                        <a class="btn btn-info" title="Edit" href="javascript:void(0)" onclick="showeditform('<?=$value['course_title']; ?>','<?=$value['user_id']; ?>','<?=$value['status']; ?>','<?=$value['id']; ?>')" ><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-info" target="_blank" href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"  title="View"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-success" style="<?=$avstyle;?>" onclick="return confirm('Are you sure you want to publish it?')"  href="<?php echo site_url('admin/verifingAccreditationCODoc/'.$value['id'].'/'.$value['user_id'].'');?>" title="Verify and Publish"><i class="fa fa-check"></i></a>
                                        <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete it?')"  href="<?php echo site_url('admin/deletecourse/'.$value['id'].'');?>" title="Delete"><i class="fa fa-trash"></i></a>    
                                        <!-- <a class="btn btn-info" title="Coupan" onclick="opencoupan('<?php echo $value['id'];?>')"  href="javascript:void(0)"><i class="fa fa-tag"></i></a> -->
                                    </td>                 
                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
             
            </div>  
          </div>
 
		</div>
	</div>
</div>


    <div id="coupanpopup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Share Coupan</h4>
                </div>
                
                <div class="modal-body promatecompany">
                    <a href="javascript:void(0)" onclick="fbshare()"><i class="fa fa-facebook-square" aria-hidden="true"></i>
                    Facebook Share</a> <br>
                    <a href="javascript:void(0)" onclick="twittershare()"><i class="fa fa-twitter-square" aria-hidden="true"></i>
                    Twitter Share</a><br>
                    <a href="javascript:void(0)" onclick="gplusshare()"><i class="fa fa-google-plus-square" aria-hidden="true"></i>
                    Google Plus Share</a>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal  Register Sub institutions-->
    <div id="editCourseStatus" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Course Status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/changecoursestatus'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>Course Name</label>
                            <input type="text" name="name" id="pname" class="form-control" readonly="">
                            <input type="hidden" name="disabled_by" class="form-control" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
                            <input type="hidden" name="id" id="pid" >
                            <input type="hidden" name="role" id="prole" >
                            <input type="hidden" name="create" id="pcreate" >
                        </p>
                        <p>
                            <label>Change Status</label>
                            <select name="status" class="form-control" id="pstatus">
                                <option value="3">Save Only</option>
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-primary" value="Update" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Accreditation Verification Doc-->
    <div id="accreditationVerificationDocModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Accreditation Verification Doc</h4>
                </div>
                <div class="modal-body">
                    <p id="avDocContent"></p>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $('#cor-list').DataTable();

        var date_input = $('input[class="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
       
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        });
        
        $('#accreditationVerificationDoc').click(function() {
            let value = $(this).attr('data-value');
            let src = "<?php echo base_url('assets/images/uploads/'); ?>"+value;
            $('#avDocContent').html('<iframe src="'+src+'" title="Accreditation Verification Doc" width="100%" height="450"></iframe>');
            $('#accreditationVerificationDocModel').modal('show');
        } );
    })

    function showeditform(cname,ccreate,cstatus,cid){
        $('#editCourseStatus').modal('show');
        $('#pname').val(cname);
        $('#pcreate').val(ccreate);
        $('#pstatus').val(cstatus);
        $('#pid').val(cid);
    }

    function fbshare(){
        var path = commonshare();
        var facebookWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + path, 'facebook-popup', 'height=350,width=600');
        if(facebookWindow.focus) { facebookWindow.focus(); }
        return false;
    }
   
    function twittershare(){
        var path = commonshare();
        var twitterWindow = window.open('https://twitter.com/share?url=' + path, 'twitter-popup', 'height=350,width=600');
        if(twitterWindow.focus) { twitterWindow.focus(); }
            return false;
    }   

    function gplusshare(){
        var path = commonshare();
        var twitterWindow = window.open('https://plus.google.com/share?url='+path, 'height=350,width=600');
        return false; 
    }

    function openpopup(val) {
        $('#item_number').val(val);
        $("#courseLisingPromote").modal()
    }

    function opencoupan(val) {
        $('#item_coupan').val(val);
        $("#coupanpopup").modal()
    }
</script>