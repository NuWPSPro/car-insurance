<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-taxpanal">
	<div class="container">
      <div class="row">
       <?php  $this->load->view('admin/sidebar');  ?>  
            <div class="col-sm-9">
              <h4 class="border-title text-left">
                ICE Subscrition Package Listing
                <a onclick="add_package();" href="javascript:void(0)" class="btn btn-primary pull-right">Add Package</a>
              </h4>
          <?php echo validation_errors(); ?> 
          <?php echo $this->session->flashdata('response');?>
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Sl.no.</th>
                    <th>Package Name</th>
                    <th>Amount</th>
                    <th>Number of Staff</th>
                    <th>Package for</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
          <?php if(count($package_list)>0){ ?>
                    <?php $count=1;
                    foreach($package_list as $value){ 
                      if($value['status']==1){ 
                          $status = '<span class="text-success">Enabled</span>'; 
                      }else{
                          $status = '<span class="text-danger">Disabled</span>'; 
                      }  
                      if($value['ice_package_for']=='i'){ 
                        $package_for = 'Institution';
                      }else{
                        $package_for = 'CE Provider';
                      } ?>

                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $value['ice_pakage_name'];?></td>
                      <td><?php echo $value['amount'];?></td>
                      <td><?php echo $value['num_of_staff'];?></td>
                      <td><?php echo $package_for;?></td>
                      <td><?php echo $status;?></td>
                      <td>
                        <!-- <a onclick="changeStatus('<?php echo $value['ice_id']; ?>','<?php echo $value['date_paid']; ?>')" href="javascript:void(0);" class="btn btn-primary text-primary"  title="CHANGE STATUS"><i class="fa fa-refresh" aria-hidden="true"></i></a> -->
                        <!-- <a onclick="viewInvoice('<?php echo $value['ice_id']; ?>')"  href="javascript:void(0)" class="btn btn-primary text-primary"  title="VIEW"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                        <a onclick="edit_package('<?php echo $value['ice_id']; ?>')"  href="javascript:void(0)" class="btn btn-primary text-primary"  title="EDIT"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <a onclick="deletePackage('<?php echo $value['ice_id']; ?>')"  href="javascript:void(0)" class="btn btn-danger text-primary"  title="DELETE"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                    <?php $count++; } ?>
              <?php }else{ echo'<tr><td colspan="9"><center>No Data Found!</center></td></tr>';}?>
                  </tbody>
              </table>
            </div>
            </div>
    </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addIceModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">ICE Subscription Package</h5>
      </div>
      
      <form method="post" action="<?php echo BASE_URL.'admin/add_subscription_package';?>">
      <div class="modal-body mx-3">
        
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="ice_pakage_name">Package Name : </label>
          <input type="text" name="ice_pakage_name" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="num_of_staff">Number of Staff : </label>
          <input type="number" name="num_of_staff" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="amount">Amount : </label>
          <input type="text" name="amount" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="ice_package_for">Package For : </label>
          Institution <input type="radio" name="ice_package_for" value="i" class="validate">
          CE Provider <input type="radio" name="ice_package_for" value="p" class="validate">
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>  
      </form>

    </div>
  </div>
</div>

<!-- View invoice Modal -->
<div id="viewModalCenter" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invoice</h4>
        <button onclick="printData()" style="float: left;" type="button" title="Print"><i class="fa fa-print"></i></button>
        <button onclick="emailpopup()" style="float: left;" type="button" title="Email"><i class="fa fa-envelope"></i></button>
      </div>
      <div class="modal-body">
        <p id="view_invoice_content"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editpackageModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Edit ICE Subscription Package</h5>
      </div>
      
      <form method="post" action="<?php echo BASE_URL.'admin/add_subscription_package';?>">
      <div class="modal-body mx-3">
        
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="ice_pakage_name">Package Name : </label>
          <input type="text" name="ice_pakage_name" id="ice_pakage_name"  class="form-control validate">
          <input type="hidden" name="ice_id" id="ice_id"  class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="num_of_staff">Number of Staff : </label>
          <input type="number" name="num_of_staff" id="num_of_staff" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="amount">Amount : </label>
          <input type="text" name="amount" id="amount" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="ice_package_for">Package For : </label>
          Institution <input type="radio" name="ice_package_for" value="i" id="ice_package_fori" class="validate" checked>
          CE Provider <input type="radio" name="ice_package_for" value="p" id="ice_package_forp" class="validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="status">Status : </label>
          Enalbed <input type="radio" name="status" value="1" id="statuse" class="validate" checked>
          Disabled <input type="radio" name="status" value="0" id="statusd" class="validate">
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>  
      </form>

    </div>
  </div>
</div>
<script>
 
  function add_package(){
    $('#addIceModalCenter').modal('show');
  }
 
  function viewInvoice(id){
        // $('#viewModalCenter').modal('show');
    $.ajax({
      type: "POST", 
      url: "<?php echo BASE_URL.'admin/get_client_invoice'; ?>", 
      data: { id : id },
      // beforeSend: function () {
      //   $('#view_invoice_content').html("Please wait...");
      // },
      success: function(result){
        // alert(result);
        $('#view_invoice_content').html(result);
        $('#viewModalCenter').modal('show');
      }
    });
  }

  function deletePackage(id){
    var c = confirm('Do you want to delete this!');
    if(c==true){
      window.location.href = "<?php echo base_url('admin/delete_subscription_package/');?>"+id;
    }

  }

  function edit_package(id){
    $.ajax({
      type: "POST", 
      url: "<?php echo BASE_URL.'admin/get_one_package'; ?>", 
      data: { id : id },
      // beforeSend: function () {
      //   $('#view_invoice_content').html("Please wait...");
      // },
      success: function(result){
        // alert(result);
        var obj = JSON.parse(result);
        console.log(obj);
        $("#ice_pakage_name").val(obj.package.ice_pakage_name);
        $("#num_of_staff").val(obj.package.num_of_staff);
        $("#amount").val(obj.package.amount);
        $("#ice_package_fori").val(obj.package.ice_package_for);
        $("#ice_package_forp").val(obj.package.ice_package_for);

        if(obj.package.status > 0){
        $("#statuse").val(obj.package.status);
        }else{
        $("#statusd").val(obj.package.status);
        }
        $("#ice_id").val(obj.package.ice_id);

        $('#editpackageModalCenter').modal('show');
      }
    });
  }


</script>