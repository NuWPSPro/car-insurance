<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-training_listpanel">
	<div class="container">
		<div class="row">
			<?php $this->load->view('admin/sidebar'); ?>	

			<div class="col-sm-9">
				<h3 class="border-title text-left">
					Training Listing <?php if($this->uri->segment(3)){ ?>( <?php echo $this->uri->segment(3); ?> ) <?php } ?></h3>
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

		<a href="<?php echo site_url('admin/training_center_list');?>"><input type="button" name="ongoing" id="ongoing" value="All" class="btn btn-info"></a>
		<a href="javascript:void(0)"><input type="button" onclick="setStatus('ongoing')" name="ongoing" id="ongoing" value="ON-GOING TRAINING" class="btn btn-info"></a>    
		<a href="javascript:void(0)"><input type="button" onclick="setStatus('upcoming')" name="ongoing" id="ongoing" value="FORTH COMING" class="btn btn-info"></a> 
		<a href="javascript:void(0)"><input type="button" onclick="setStatus('finished')" name="ongoing" id="ongoing" value="FINISHED" class="btn btn-info"></a>
		<a href="javascript:void(0)"><input type="button" onclick="setStatus('pending')" name="pending" id="pending" value="PENDING" class="btn btn-info"></a>
		<br><br>

		<div class="table-responsive">    
            <?php echo $this->session->flashdata('response');?> 
            <table id="training-lists" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Training Title</th> 
						<th>Units</th> 
						<th>CE Provider</th> 
						<th>Institution </th> 
						<th>Accreditation No.</th> 
						<th>Training Date</th> 
						<th>Fee</th> 
						<th>Date uploaded.</th> 
						<th>Target Pax</th> 
						<th>Actual Pax</th> 
						<th>Online Registration</th> 							
						<th>Country</th> 							
						<th>Location</th>  
                        <th>Status</th>  
                        <th>Accreditation Verification</th>  
                        <th>Access</th>  
                        <th>Action</th> 
					</tr>
				</thead>
		        <tbody>
		           <?php $count=1;
		                foreach ($training as $key => $value) {	
		                $exploded = explode('-', $value['insititution_id']);
						$ins_id = end($exploded);
						$ins_name = $this->db->get_where('tbl_user',array('id'=>$ins_id))->row_array()['name'];
						$datas = $this->db->get_where('tbl_training_book',array('training_seminar_id'=>$value['id']))->result_array();  
                        if($value['status'] == 2 && $value['disabled_by']==0){ 
                            $status = '<span style="color:green;">Active</span>'; 
                            $access = '<span style="color:green;">Enable</span>'; 
							$avstyle= 'display:none';
                        }elseif($value['status'] == 0 && $value['disabled_by'] > 0){ 
							$status = '<span style="color:red;">Inactive<span>'; 
                            $access = '<span style="color:red;">Disable<span>'; 
							$avstyle= '';
                        }elseif($value['status'] == 1 && $value['disabled_by'] == 0){ 
							$status = '<span style="color:orange;">Save Only<span>'; 
                            $access = '<span style="color:red;">Disable<span>'; 
							$avstyle= '';
                        }else{ 
							$status = '<span style="color:red;">Pending<span>'; 
                            $access = '<span style="color:red;">Inactive<span>'; 
							$avstyle= '';
                        }  
	                	
						if($ins_name != ''){ 
							$insititution = $ins_name;
						}else{ 
							$insititution = "--"; 
						}?>
		                <tr>
		                    <td><?php echo $count; ?>.</td> 
		                    <td><?php echo $value['title']; ?></td>  
							<td><?php echo $value['units']; ?></td>    
							<td><?php echo $value['cpname']; ?></td> 
 		                    <td><?php echo $insititution; ?></td> 
		                    <td><?php echo $value['cp_number']; ?></td> 
		                    <td><?php echo $value['start_date']; ?></td>
							<td>$ <?php echo $value['total']; ?></td>							
							<td><?php echo $value['start_date']; ?></td>  					
		                    <td>--</td>  
		                    <td>--</td>  
                        	<td class="text-center"><?php echo count($datas).'/'.$value['registration_limit'];?></td> 
							<td><?php echo $value['countries_name']; ?></td> 
		                    <td><?php echo $value['location']; ?></td> 					
							<td><?php echo $status; ?></td>
                            <td><a href="javascript:void(0)" id="accreditationVerificationDoc" data-value="<?php echo $value['accreditation_verification_doc']; ?>" title="Click here to view"><?php echo $value['accreditation_verification_doc']; ?></a></td>
                            <td><?php echo $access; ?></td>
		                    <td>
		                        <a class="btn btn-info" title="Edit" href="javascript:void(0)" onclick="showeditform('<?=$value['title']; ?>','<?=$value['user_id']; ?>','<?=$value['status']; ?>','<?=$value['id']; ?>')" ><i class="fa fa-pencil"></i></a>
		                        <a class="btn btn-info" target="_blank" href="<?php echo site_url('pages/training_details/'.$value['id'].'');?>" title="View" ><i class="fa fa-eye"></i></a>
								<a class="btn btn-success" style="<?=$avstyle;?>" onclick="return confirm('Are you sure you want to publish it?')"  href="<?php echo site_url('admin/verifingAccreditationDoc/'.$value['id'].'/'.$value['user_id'].'');?>" title="Verify and Publish"><i class="fa fa-check"></i></a>
								<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete it?')"  href="<?php echo site_url('admin/deletetraining/'.$value['id'].'');?>" title="Delete"><i class="fa fa-trash"></i></a>
		                    </td>                  
		                </tr>
		                <?php $count++; } ?>
		        </tbody>
    		</table>
    	</div>  
    </div>  
    </div>
        
        </div>
	</div>
</div>

<!-- Modal  Register Sub institutions-->
    <div id="editTrainingStatus" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Training Status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/changetrainingstatus'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">
                        <p>
                            <label>Training Name</label>
                            <input type="text" name="name" id="pname" class="form-control" readonly="">
                            <input type="hidden" name="disabled_by" class="form-control" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
                            <input type="hidden" name="id" id="pid" >
                            <input type="hidden" name="role" id="prole" >
                            <input type="hidden" name="create" id="pcreate" >
                        </p>
                        <p>
                            <label>Change Status</label>
                            <select name="status" class="form-control" id="pstatus">
                                <option value="1">Save Only</option>
                                <option value="2">Enable</option>
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

<script type="text/javascript">
	jQuery(document).ready(function() {
	   jQuery('#training-lists').DataTable();
	} );
	jQuery('#accreditationVerificationDoc').click(function() {
	   let value = $(this).attr('data-value');
	   let src = "<?php echo base_url('assets/images/uploads/'); ?>"+value;
	   $('#avDocContent').html('<iframe src="'+src+'" title="Accreditation Verification Doc" width="100%" height="450"></iframe>');
	   $('#accreditationVerificationDocModel').modal('show');
	} );

	function setStatus(status){
		jQuery('#trstatus').val(status);
		jQuery('#sbbtn').click();
	}

    function showeditform(cname,ccreate,cstatus,cid){
        $('#editTrainingStatus').modal('show');
        $('#pname').val(cname);
        $('#pcreate').val(ccreate);
        $('#pstatus').val(cstatus);
        $('#pid').val(cid);
    }
</script>