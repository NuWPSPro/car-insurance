<?php $this->load->view('institution/picture'); ?>

  
	  <div class="innerContent">
        <div class="container">
            <div class="row">
            <?php $this->load->view('institution/sidebar'); ?>
                <div class="col-sm-9">
                <h3 class="border-title text-left">Staff CE Record <?php if($staff_list == 0 ){ echo '(0)'; }else{ echo'('.count($staff_list).')'; }?></h3>

                <form action="<?=base_url('institution/staffcerecords');?>" method="post" >
				<div class="row">                
                    
                    <?php if(isset($sub_ins) && $sub_ins!=''){ ?> 
                    <div class="form-group col-md-3">
                        <select name="institution" class="form-control" onchange="this.form.submit();">
                            <option value="">Select Sub Institution</option>
                            <?php foreach($sub_ins as $value){ ?>
                            <option value="<?=$value['cid']; ?>"><?=$value['cname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?>

                   <div class="form-group col-md-3">
						<select name="ceprovider" class="form-control">
							<option value="" >CE Provider:</option>
							<?php foreach($ceplist as $cp){ ?>
							   <option value="<?php echo $cp['id']; ?>" <?php if($_POST['ceprovider']==$cp['id']){echo'selected';} ?> ><?php echo $cp['name']; ?></option>
							<?php } ?>
					    </select>
					</div>
					
					<div class="form-group col-md-3">
							<input type="text" name="title" class="form-control" value="<?php echo set_value('title')?>" placeholder="Enter Employee Name">
					</div>
					<div class="form-group col-md-3">
						
						<input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
					</div>
									
				</div>
				</form>
                
                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="cepStaff-list" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>User</th> -->
                                        <th>Name</th> 
                                        <th>Profession</th>
                                        <th>email</th> 
                                        <th>code</th> 
                                        <th>Start Date</th> 
                                        <th>End Date</th> 
                                        <!-- <th>Sub-Institution</th>   -->
                                        <th>CE Provider</th>  
                                        <th>Connectivity</th> 
                                        <th>Activation</th> 
                                        <th>Access</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                    if( isset($staff_list) && $staff_list !=''){
                                    $key=1; 
                                	foreach ($staff_list as $value) {	
                                        $this->db->where_in('prof_id',$value['prof_id']);
                                        $query = $this->db->get('tbl_institution_staff_payment');
                                        $payment = $query->row_array();

                                        $provider_id = end(explode('-',$value['insititution_code']));
                                        $provider = $this->db->get_where('tbl_user',array('id'=>$provider_id))->row_array();
                                        if($provider['parent_insititution'] != 0){
                                        $subins = $this->db->get_where('tbl_user',array('id'=>$provider['parent_insititution']))->row_array();
                                            $subinstitution =  $subins['name'];  
                                        }else{
                                            $subinstitution =  '--';   
                                        }
                                         if($value['status']=='1' && $value['prof_id']!='0'){ 
                                            $connectstatus ='<span style="color:green;">Connected</span>'; 
                                        }else{ 
                                            $connectstatus ='<span style="color:orange;">Pending</span>'; 
                                        }
                                        if($value['status']=='1' && $value['activated']=='1' && $payment > 0){ 
                                            $status ='<span style="color:red;">Activated</span>'; 
                                        }else{ 
                                            $status ='<span style="color:orange;">Pending</span>'; 
                                        }
                                        
                                         if($value['status']=='1' && $value['activated']=='1'){ 
                                            $activated ='<span style="color:green;">Enabled</span>'; 
                                        }elseif($value['status']=='1' && $value['activated']=='0' && $payment == ''){ 
                                            $activated ='<span style="color:orange;">Pending</span>'; 
                                        }elseif($value['status']=='2' && $value['activated']=='0'){ 
                                            $activated ='<span style="color:orange;">Disabled</span>'; 
                                        }else {
                                            // $activated ='<span style="color:red;">Disabled</span>'; 
                                        }  ?>
                                    <tr>
                                        <td> <?php echo $key; ?>.</td> 
                                        <td> <?php echo $value['staff_name']; ?> </td> 
                                        <td> <?php echo $value['profession']; ?> </td> 
                                        <td> <?php echo $value['email']; ?> </td> 
                                        <td> <?php echo $value['staff_code']; ?> </td> 
                                        <td> <?php echo $value['startdate']; ?> </td>  
                                        <td> <?php echo $value['enddate']; ?> </td>  
                                        <!-- <td> <?php echo $subinstitution ?> </td>  -->
                                        <td> <?php echo $provider['name']; ?> </td> 
                                         <td><?php echo $connectstatus; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $activated; ?></td>
                                         <td width="200">
                                <?php if($value['status']=='1' && $value['activated']=='1'){  ?>
                                    <a class="btn btn-default" title="View" href="<?php echo site_url('institution/staff_view/').$value['pid']; ?>" target="_blank"><i class="fa fa-eye"></i></a>
                                <?php } else { ?>
                                    <a class="btn btn-default" title="View" href="javascript:void(0);" data-toggle="modal" data-target="#activateTheStaff"><i class="fa fa-eye"></i></a>
                                <?php } ?>
                                   <!--  <a onclick="edit_staff('<?php echo $value['id'] ?>')" class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal"
                                data-target="#Registersubinstitutions11"><i class="fa fa-pencil"></i></a> -->

                                    <!-- <a class="btn btn-default" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/staff_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a> -->

                                </td>
                                    </tr>
                                    <?php $key++; } }else{ echo '<tr><td colspan="12"> No data Found! </td></tr>'; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- 
 <script>
     $(document).ready(function() {
        $('#cepStaff-list').dataTable();
    });
 </script> -->

 <div id="activateTheStaff" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h6 class="m-0">Need to activate the staff</h6>
            </div>
            <div class="modal-body">
                <p>The Staff is already connected but not yet activated.</p>
                <p>Please wait for activation to open the staff CE record</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

  <!-- Modal  Register Sub institutions-->
    <div id="Registersubinstitutions" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Register Sub institutions</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo site_url('institution/registerstaff'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">



                        <p>
                            <label>Name <span class="required"> * </span> </label>
                            <input name="name" class="form-control" size="20" type="text">
                            <span class="error"></span>
                        </p>

                         


                        <p class="submit alignleft">
                            <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>