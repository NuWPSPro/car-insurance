<?php $this->load->view('institution/picture'); ?>

  
	  <div class="innerContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="border-title text-left">Dashboard</h3>
                </div>
                    <?php $this->load->view('institution/sidebar'); ?>
                

                
                <div class="col-sm-9">
                    <h3 class="border-title text-left">Sub institutions <!-- <a href="#" target="_blank"
                            class="btn btn-danger pull-right" data-toggle="modal"
                            data-target="#Registersubinstitutions">Register Sub institutions</a> --></h3>
                    <!-- <button type="button" class="btn btn-primary" >ALL</button> -->


<?php 
$uid = $this->session->userdata('logged_in')['id'];
$userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);

$where1 = array('parent_insititution'=>$userdetails[0]['id'],'role'=>5);
$userdetails1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);

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
                                	foreach ($userdetails1 as $key => $value) {
                                	
                                	?>
                                    <tr>
                                        <td>
                                            <?php echo $key+1; ?>.</td> 
                                        <td>
                                            <?php echo $value['name']; ?>
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