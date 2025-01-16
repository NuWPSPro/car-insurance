<?php $this->load->view('institution/picture'); ?>

  
	  <div class="innerContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3>
                </div>
                    <?php $this->load->view('professional/sidebar'); ?>
                

                
                <div class="col-sm-8">
                    <h3 class="border-title text-left">Staff CE Record   <a href="#" target="_blank"
                            class="btn btn-danger pull-right" data-toggle="modal"
                            data-target="#Registersubinstitutions">Register Staff</a>  </h3>
                    <!-- <button type="button" class="btn btn-primary" >ALL</button> -->


<?php 
  $uid = $this->session->userdata('logged_in')['id'];
$userdetails = $this->user->get_record_by_field_name_all_record('tbl_institution_staff','insititution_id',$uid);
?>

                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>User</th> -->
                                        <th>Name</th>
                                        <th>Status</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	foreach ($userdetails as $key => $value) {
                                	
                                	?>
                                    <tr>
                                        <td>
                                            <?php echo $key+1; ?>.</td> 
                                        <td>
                                            <?php echo $value['staff_name']; ?>
                                        </td>

                                        <td> Inactive </td> 
                                    </tr>

                                    <?php 
                                	}
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


 


<?php 
    $uid = $this->session->userdata('logged_in')['id']; 
    $profile = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
    

     $parent_insititution = $profile[0]['parent_insititution'];

   

    $where =array('role'=>2,'parent_insititution'=>$parent_insititution);
    $allprovider = $this->user->get_record_by_multi_field_name('tbl_user',$where); 


    
     
?>

  <!-- Modal  Register Sub institutions-->
    <div id="Registersubinstitutions" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Register Staff</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo site_url('professional/registerstaff'); ?>" method="post" enctype="multipart/form-data"
                        name="form1" id="form1">



                        <p>
                            <label>Select Staff <span class="required"> * </span> </label>
                            
                            <select class="form-control" name="name">
                                <option value="" selected>Please Select</option>
                                <?php 
                                foreach ($allprovider as $key => $value) {
                                ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select> 
                            
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