<?php $this->load->view('institution/picture'); ?>

	   <div class="innerContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3> 
                </div>

                <?php $this->load->view('institution/sidebar'); ?>

                <?php 
               /* echo '<pre>';
                print_r($userdata);
                die;*/
                ?>
			

                 <form action="<?php echo BASE_URL;?>institution/mendetorytraining" method="post" enctype="multipart/form-data" name="form1">
                    
                 
              <div class="col-sm-9">
                <?php $this->session->flashdata('response'); ?>
                    <h3 class="border-title text-left"> MENDETORY TRAINING STATUS</h3>
                    <button type="button" class="btn btn-primary mr-md-3" >BLS(90%)</button>
                    <button type="button" class="btn btn-outline-primary mr-md-3">ACLS(10%)</button>
                    <button type="button" class="btn btn-outline-primary mr-md-3">PALS(10%)</button>
                    <button type="button" class="btn btn-outline-primary">HEART CODE(10%)</button>


    <?php 
    $uid = $this->session->userdata('logged_in')['id'];
    $userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);

    $where1 = array('parent_insititution'=>$userdetails[0]['id'],'role'=>2);
    $userdetails1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
    ?>
                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                       <th>No.</th> 
                                        <th>Name</th>
                                        <th>profession</th>
                                        <th>Status</th>
                                        <th>License Number</th>
                                        <!--<th>Validity</th>-->
                                        <th>Issued By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  foreach ($userdetails1 as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $key+1; ?>.</td> 
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['profession']; ?></td>
                                        <?php if($value['status']==1){ $status='<span style="color:green;">Active</span>'; }else{ $status='<span style="color:red;">Inactive<span>'; } ?>
                                        <td><?php echo $status; ?></td> 
										
									 <td><?php echo $value['license_no']; ?></td>
									 <!--<td><?php echo $value['validity']; ?></td>-->
									 <td><?php echo $value['issued_by']; ?></td>

                                        <td width="200">
                                            <a class="btn btn-default" title="View" href="#"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-default" href="#"><i class="fa fa-trash"></i></a>
                                         <!--   <a class="btn btn-default" title="Edit" href="javascript:void(0)" onclick="showeditform('<?=$value['name']; ?>','<?=$value['status']; ?>','<?=$value['id']; ?>')" ><i class="fa fa-pencil"></i></a>-->
                                            <a class="btn btn-default" class="btn" href="#"><i class="fa fa-envelope"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				
            </form>
            </div>
        </div>
    </div>
 


		 