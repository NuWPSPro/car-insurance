<?php  $this->load->view('broker/picture'); ?>

    <!-- Main body start -->
    <div class="col-sm-9">
        <?=$body_heading; ?>
            <div class="row text-center">
                <form class="form-inline" action="https://ceonpoint.com/car/">
                    <!-- <select name="" id="toins" class="form-control">
                        <option value="">Type of Insurance:</option>
                        <option value="">Insurance 1</option>
                        <option value="">Insurance 2</option>
                        <option value="">Insurance 3</option>
                    </select>
                    
                    <select name="" id="prange" class="form-control">
                        <option value="">Price Range:</option>
                        <option value="">Price 1</option>
                        <option value="">Price 2</option>
                        <option value="">Price 3</option>
                    </select>
                    
                    <select name="" id="inscomp" class="form-control">
                        <option value="">Insurance Comapany:</option>
                        <option value="">Comapny 1</option>
                        <option value="">Comapny 2</option>
                        <option value="">Comapny 3</option>
                    </select>
                    
                    <button type="button" class="btn btn-primary">
                        Search
                    </button> -->
                    <a href="<?=base_url('author/index'); ?>" class="btn btn-danger pull-right ml-1">Back</a>
                    <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createInsurance" data-whatever="@getbootstrap">Create Insurance Package</a>
                </form>
            </div>
            <div class="table-responsive">
                
            <?php echo validation_errors(); ?>
            <?php echo $this->session->flashdata('response'); ?>
                <table class="table table-striped">
                    <thead>
                        <tr>



                            <th scope="col">#</th>
                            <th scope="col">Insurance Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Insurance Type</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($listing): 
                            foreach($listing as $list):
                            @$i++;
                            if($list['status']==1): 
                                $status = '<span class="text-success">Publish</span>';
                            elseif($list['status']==3):
                                $status = '<span class="text-info">Save</span>';
                            else:
                                $status = '<span class="text-danger">Unpublish</span>';
                            endif; 
                            ?>
                        <tr>
                            <th scope="row"><?=$i;?></th>
                            <td><a href="<?=base_url('pages/courses/'); ?>"><?=$list['course_title'];?></a></td>
                            <td><img src="<?php echo ASSETS_URL.'images/uploads/'.$list['course_photo']; ?>" width="90"></td>
                            <td><?=$list['price'];?></td>
                            <td><?php if($list['insurance_type'] == '1'){echo 'Comprehensive';}else{echo 'Third Party';}?></td>
                            <td><?=$status;?></td>
                            <td>
                                <a href="<?=base_url('author/edit_insurance/'.$list['id']); ?>"  class="btn btn-primary m-1"><i class="fa fa-edit"></i></a>
                                <a href="<?=base_url('author/delete_insurance/'.$list['id']); ?>" onclick="return deleteInsurance();" class="btn btn-danger m-1"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; 
                        endif; ?>
                    </tbody>
                </table>
            </div>

    </div>
    <!-- Main body end -->


        <!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>


    <div class="modal fade" id="createInsurance" tabindex="-1" role="dialog" aria-labelledby="labelInsurance" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-white" id="labelInsurance">Create Insurance Package</h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('author/insurance_for_sale_add'); ?>" enctype="multipart/form-data" method="post">
                    <i class="text-danger"> * All fields are required.</i>
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('response'); ?>
                    
                    <div class="card">
                        <div class="card-body">
                        
                            <div class="form-group">
                                <label for="name" class="col-form-label">Insurance Name * :</label>
                                <input type="text" name="course_title" class="form-control" required id="name">
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-form-label">Price * :</label>
                                <input type="number" min="0" name="price" required class="form-control" id="price">
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">Image * :</label>
                                <input type="file" name="image" required class="form-control" id="image">
                            </div>
                            <div class="form-group">
                                <label for="insurance_type" class="col-form-label">Insurance Type * :</label>
                                <select name="insurance_type" required class="form-control" id="insurance_type">
                                    <option value="">Choose one type</option>
                                    <option value="1">Comprehensive</option>
                                    <option value="0">Third Party</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-form-label">Insurance Type * :</label>
                                <select name="status" required class="form-control" id="status">
                                    <option value="">Choose one type</option>
                                    <option value="1">Published</option>
                                    <option value="3">Save Only</option>
                                </select>
                            </div>
                                
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                   
                
                </form>
            </div>
            
            </div>
        </div>
    </div>

    <div class="modal fade" id="editInsurance" tabindex="-1" role="dialog" aria-labelledby="labelInsurance" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-white" id="labelInsurance">Create Insurance</h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('author/insurance_for_sale_add'); ?>" enctype="multipart/form-data" method="post">
                    <i class="text-danger"> * All fields are required.</i>
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('response'); ?>
                    
                    <div class="card">
                        <div class="card-body">
                        
                            <div class="form-group">
                                <label for="name" class="col-form-label">Insurance Name * :</label>
                                <input type="text" name="course_title" class="form-control" required id="name">
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-form-label">Price * :</label>
                                <input type="number" min="0" name="price" required class="form-control" id="price">
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">Image * :</label>
                                <input type="file" name="image" required class="form-control" id="image">
                            </div>
                            <div class="form-group">
                                <label for="nation" class="col-form-label">Insurance Type * :</label>
                                <select name="nationality" required class="form-control" id="nation">
                                    <option value="">Choose one type</option>
                                    <option value="1">Comprehensive</option>
                                    <option value="0">Third Party</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nation" class="col-form-label">Insurance Type * :</label>
                                <select name="status" required class="form-control" id="nation">
                                    <option value="">Choose one type</option>
                                    <option value="1">Published</option>
                                    <option value="3">Save Only</option>
                                </select>
                            </div>
                                
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                   
                
                </form>
            </div>
            
            </div>
        </div>
    </div>

    <script>
        $('#personalInfo').click(function(){
            $('#collapseOne').removeClass('in');
            $('#collapseTwo').addClass('in');
            $('#collapseTwo').css('pointer-events: auto');
            $('#collapseThree').removeClass('in');
        });
        $('#carInfo').click(function(){
            $('#collapseOne').removeClass('in');
            $('#collapseTwo').removeClass('in');
            $('#collapseThree').addClass('in');
            $('#collapseThree').css('pointer-events: auto');
        });
        var initial_url = window.location.href;
        var url = initial_url .split( '=' );
        if(url[url.length - 1]=='true'){ $('#createInsurance').modal('show'); }

        function deleteInsurance(){
            var x = confirm('Do you realy want to delete this?');
            if(x == true){ return true; }else{ return false; }
        }
        
    </script>