<?php $this->load->view('template/picture_provider'); 
      $price = $this->db->get_where('tbl_all_tax',array('id'=>6))->row_array()['total_amount'];  ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
           <!--  <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
                <?php 
                $this->load->view('provider/sidebar');
                ?>
            <div class="col-sm-9">
                <!-- new html code -->
                <h3 class="border-title text-left">UPLOAD TRAINING/SEMINAR</h3>
                <div class="step-wise-query provider-overview newcertificate">
                    <div class="tab-content steps-detail">
                     <label style="font-size: 20px"><b>Choose Training Version</b></label>
                        <table class="table table-striped table-bordered version" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="bg-warning text-white text-center">FREE VERSION<br>NO FEE</th>
                                    <th class="bg-danger text-white text-center">PROFESSIONAL VERSION<br>$<?=$price?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <ul>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Registration</li>
                                          <!--  <li><i class="fa fa-check" aria-hidden="true"></i>Online Payment</li>-->
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Evalution</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Social Media Share</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Online Payment</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>FREE 100 Digital Certificate</li>
                                            <!-- <li><i class="fa fa-check" aria-hidden="true"></i>Digital Certificate (max 100)</li> -->
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Website Layout</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Ready Traning Report</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Sponsor Section</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Committee Section</li>
                                            <li><i class="fa fa-times" aria-hidden="true"></i>Date and Time Countdown</li>
                                        </ul>
                                        
                                    </td>
                                    
                                    <td>
                                        <ul>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Registration</li>
                                          <!--  <li><i class="fa fa-check" aria-hidden="true"></i>Online Payment</li>-->
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Evalution</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Social Media Share</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Online Payment</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>FREE 100 Digital Certificate</li>
                                            <!-- <li><i class="fa fa-check" aria-hidden="true"></i>Digital Certificate (max 100)</li> -->
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Website Layout</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Ready Traning Report</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Sponsor Section</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Committee Section</li>
                                            <li><i class="fa fa-check" aria-hidden="true"></i>Date and Time Countdown</li>
                                        </ul>
                                        
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="text-center"><a href="javascript:void(0);" class="btn btn-primary" onclick="showdummy('free');">View Template</a></td>
                                    <td class="text-center"><a href="javascript:void(0);" class="btn btn-primary" onclick="showdummy('pro');">View Template</a></td>
                                </tr>
                                <tr>
                                   <!--  <td class="text-center"><a href="<?php echo site_url('provider/upload_information'); ?>"><input type="button" name="free" id="free" value="SELECT FREE VERSION" class="btn-primary "></a></td> -->
                                    <td class="text-center"><a href="<?php echo site_url('provider/training_center_free'); ?>"><input type="button" name="free" id="free" value="SELECT FREE VERSION" class="btn-primary "></a></td>
                                    <!-- <td class="text-center"><a href="<?php echo site_url('provider/training_center_pro'); ?>"><input type="button" name="free" id="free" value="SELECT PRO VERSION" class="btn-danger "></a></td> -->
                                    <td class="text-center"><a href="<?php echo site_url('provider/training_center_pro'); ?>"><input type="button" name="pro" id="pro" value="SELECT PRO VERSION" class="btn-danger "></a></td>
                                </tr>
                            </tbody>    
                        </table>
                    </div>
                </div>

            
 
 

 
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="dummyTraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview of <span id="tversion"></span> Training page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" id="DummyTrainingImg">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    function showdummy(version){
        if(version =='free'){
            $('#DummyTrainingImg').attr('src',"<?php echo ASSETS_URL.'images/training_dummy/dummy_free.png'; ?>");
            $('#tversion').html('Free');
        }else{
            $('#DummyTrainingImg').attr('src',"<?php echo ASSETS_URL.'images/training_dummy/dummy_pro.png'; ?>");
            $('#tversion').html('Pro');
        }
        $('#dummyTraining').modal('show');  

    }
</script>