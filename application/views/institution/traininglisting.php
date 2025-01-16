<?php $this->load->view('institution/picture'); ?>

  
	  <div class="innerContent">
        <div class="container">
            <div class="row">
                <?php $this->load->view('institution/sidebar'); ?>
                
                <div class="col-sm-9">
                    <h3 class="border-title text-left"> Traning Listings (<?=count($trainin_list);?>)</h3>

                    <form action="<?=base_url('institution/traininglisting');?>" method="get">
				<div class="row pt-1">
                    <?php if($this->session->userdata('logged_in')['under_insititution']=='0'){ ?>
                    <div class="form-group col-md-3">
                        <select name="institution" class="form-control">
                            <option value="">Sub Institution:</option>
                            <?php foreach($insititutions as $inti){
                                if($inti['insititution_id']=='')
                                { continue; } ?>
                               <option value="<?php echo $inti['insititution_id']; ?>" <?php if($_GET['institution']==$inti['insititution_id']){echo'selected';} ?> ><?php echo $inti['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?>

                    <div class="form-group col-md-3">
                        <select name="ceprovider" class="form-control">
                            <option value="" >CE Provider:</option>
                            <?php foreach($ceplist as $cp){ ?>
                                <option value="<?php echo $cp['id']; ?>" <?php if($_GET['ceprovider']==$cp['id']){echo'selected';} ?> ><?php echo $cp['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                
					<!-- <div class="form-group col-md-3">
                    <select name="author" class="form-control">
                            <option value="" >Author:</option>
                            <?php foreach($authorlist as $cp){ ?>
                                <option value="<?php echo $cp['id']; ?>" <?php if($_GET['author']==$cp['id']){echo'selected';} ?> ><?php echo $cp['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div> -->
                
					<div class="form-group col-md-3">
							<input type="text" name="title" class="form-control" value="<?php echo set_value('title',$_GET['title'])?>" placeholder="Enter Course Title" >
					</div>
                
					<div class="form-group col-md-3">
							<input type="date" name="date" class="form-control" value="<?php echo set_value('date',$_GET['date'])?>">
					</div>
					<div class="form-group col-md-3">
						<input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
					</div>
				</div>
				</form>

                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>User</th> -->
                                        <th>Title</th>
                                        <th>Units</th>
                                        <!-- <th>Price</th> -->
                                        <th>Speaker</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Status</th> 
                                        <th>Sub-Institution</th>
                                        <th>CE Provider</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $key = 1;
                                	foreach ($trainin_list as $value) {
                                	$speaker = $this->db->get_where('tbl_training_speaker',array('training_id'=>$value['id']))->row_array();
                                    $provider = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
                                    $institution = $this->db->get_where('tbl_user',array('insititution_id'=>$value['insititution_id']))->row_array();
                                    
                                    $findSubIns = $this->db->get_where('tbl_user',array('id'=>$institution['id']));
                                    $findSubInsToggle = $findSubIns->row_array()['under_insititution'];
                                    // $findSubInsId = $findSubIns->row_array()['id'];
                                    // echo $findSubInsId;
                                    if ($findSubInsToggle) {
                                        $ins_name = $this->db->get_where('tbl_user',array('id'=>$findSubInsToggle))->row_array()['name'];
                                    } else {
                                        $ins_name = '--';
                                    }
                                    
                                    // echo $this->db->last_query();
                                    if($value['status']==0){ $status = '<i style="color:red;">Inactive</i>'; 
                                    }elseif($value['status']==1){ $status = '<i style="color:green;">Active</i>';
                                    }else{ $status = '<i style="color:Green;">Published</i>'; }
                                	?>
                                    <tr>
                                        <td><?php echo $key; ?>.</td> 
                                        <td><?php echo $value['title']; ?> </td>
                                        <td><?php echo $value['units']; ?> </td>
                                        <!-- <td>$<?php echo $value['price']; ?> </td> -->
                                        <td><?php echo $speaker['speaker_name']; ?> </td>
                                        <td><?php echo $value['start_date']; ?> </td>
                                        <td><?php echo $value['location']; ?> </td>
                                        <td><?php echo $status; ?></td> 
                                        <td><?php echo $ins_name; ?></td> 
                                        <td><?php echo $provider['name']; ?></td> 
                                        <td><a target="_blank" href="<?php echo base_url('pages/training_details/').$value['id']; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a></td> 
                                    </tr><?php $key++; 	} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


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
                    <form action="http://ceonpoint.com/provider/profile" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">



                        <p>
                            <label>Name <span class="required"> * </span> </label>
                            <input name="name" class="form-control" size="20" type="text">
                            <span class="error"></span>
                        </p>

                        <p>
                            <label>Acronym<span class="required"> * </span> </label>
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