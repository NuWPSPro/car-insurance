<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
	   <div class="container">
          <div class="row">
          <?php  $this->load->view('provider/sidebar');  ?> 
            <div class="col-sm-9">
            <h3 class="border-title text-left">Active Promotion</h3>
            <?php 
              $common = array();
              foreach($purchase_list as $value){
                if($value['paid_status']==0){
                    $cont = "Incomplete";    
                  } else if($value['paid_status']==1){
                    $cont = "Free";  
                  } else if($value['paid_status']==2){
                    $cont = "Featured";    
                  } else if($value['paid_status']==3){
                    $cont = "Top List";    
                  } else if($value['paid_status']==4){
                    $cont = "Premium";   
                  }
                if($value['expiry_on'] >= date('Y-m-d') ){ 
                $common[] = array(
                    'id'        => $value['id'],
                  'type'        =>'Course Promotion',
                  'name'        =>$value['name'],
                  'paid_status' =>$cont,
                  'duration'    =>($value['expiry_on']-$value['added_on']),
                  'added_on'    =>$value['added_on'],
                  'expiry_on'   =>$value['expiry_on'],
                  // 'amount'      =>'',
                );
                } }
              foreach($company_promotion as $value){
                $date = $value['promoted_day'];
                $exp = date('Y-m-d',strtotime($value['promoted_date'] .'+'. $date.'day'));
                if($exp >= date('Y-m-d') ){
                $common[] = array(
                  'type'        =>'Company Promotion',
                  'name'        =>$value['name'],
                  'paid_status' =>'Complete',
                  'duration'    =>$value['promoted_day'],
                  'added_on'    =>$value['promoted_date'],
                  'expiry_on'   =>$exp,
                  // 'amount'      =>$value['promoted_amount'],
                );
                } } ?>

            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                      <tr>
                        <th>No.</th>
                        <th>Type</th> 
                        <th>Title</th> 
                        <th>Duration</th> 
                        <th>Start Date</th> 
                        <th>End Date</th>  
                        <th>Action</th> 
                      </tr>
                  </thead>
                <?php if(!empty($common)){
                 $tot=0;
                 $count=1;
                 foreach ($common as $key => $value) {
                 //$tot = $tot+$value['amount'];   ?>
                <tr>
                  <td><?php echo $count; ?></td> 
                  <td><?php echo $value['type']; ?></td>
                  <td><?php echo $value['name']; ?></td>   
                  <td><?php echo $value['duration']; ?></td>   
                  <td><?php echo $value['added_on']; ?></td>  
                  <td><?php echo $value['expiry_on']; ?></td>   
                  <td><?php echo 'Renew'; ?></td>  
                </tr>
                <?php $count++; } }else{ echo'<p style="color: red;">Sorry no records found.</p>'; } ?>  
            </table>
                </div>        
        </div>

















<div class="col-sm-9">
            <h3 class="border-title text-left">Previous Promotion</h3>
            <?php 
              $common = array();
              foreach($purchase_list as $value){
                if($value['paid_status']==0){
                    $cont = "Incomplete";    
                  } else if($value['paid_status']==1){
                    $cont = "Free";  
                  } else if($value['paid_status']==2){
                    $cont = "Featured";    
                  } else if($value['paid_status']==3){
                    $cont = "Top List";    
                  } else if($value['paid_status']==4){
                    $cont = "Premium";   
                  }
                if($value['expiry_on'] < date('Y-m-d') ){ 
                $common[] = array(
                  'type'        =>'Course Promotion',
                  'name'        =>$value['name'],
                  'paid_status' =>$cont,
                  'duration'    =>($value['expiry_on']-$value['added_on']),
                  'added_on'    =>$value['added_on'],
                  'expiry_on'   =>$value['expiry_on'],
                  // 'amount'      =>'',
                );
                } }
              foreach($company_promotion as $value){
                $date = $value['promoted_day'];
                $exp = date('Y-m-d',strtotime($value['promoted_date'] .'+'. $date.'day'));
                if($exp < date('Y-m-d') ){
                $common[] = array(
                    'id'        => $value['id'],
                  'type'        =>'Company Promotion',
                  'name'        =>$value['name'],
                  'paid_status' =>'Complete',
                  'duration'    =>$value['promoted_day'],
                  'added_on'    =>$value['promoted_date'],
                  'expiry_on'   =>$exp,
                  // 'amount'      =>$value['promoted_amount'],
                );
                } } ?>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                      <tr>
                        <th>No.</th>
                        <th>Type</th> 
                        <th>Title</th> 
                        <th>Duration</th> 
                        <th>Start Date</th> 
                        <th>End Date</th>  
                        <th>Action</th> 
                      </tr>
                  </thead>
                <?php if(!empty($common)){
                 $tot=0;
                 $count=1;
                 foreach ($common as $key => $value) {
                 //$tot = $tot+$value['amount'];   ?>
                <tr>
                  <td><?php echo $count; ?></td> 
                  <td><?php echo $value['type']; ?></td>
                  <td><?php echo $value['name']; ?></td>   
                  <td><?php echo $value['duration']; ?></td>   
                  <td><?php echo $value['added_on']; ?></td>  
                  <td><?php echo $value['expiry_on']; ?></td>   
                  <td><?php echo 'Renew'; ?></td>  
                </tr>
                <?php $count++; } }else{ echo'<p style="color: red;">Sorry no records found.</p>'; } ?>  
            </table>
                </div>
       </div>
	</div>
	</div>

</div>

<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#companyPromotionSuccess">Open Modal</button> -->

<div class="modal fade" id="companyPromotionSuccess" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <div class="site-logo__link">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/popup-logo.png'; ?>" alt="logo"></a>
        </div>
          <!-- <h4 class="modal-title">Modal Header</h4> -->
        </div>
        <div class="modal-body">
          <h4 class="modal-title text-center" style="font-weight: bold;">
            <img src="<?php echo ASSETS_URL.'images/perfect-text.jpg'; ?>" alt="Perfect" width="175">
        </h4>
        <h6><?php echo $this->session->flashdata('response'); ?></h6>
        </div>
        <div class="modal-footer">
          <a href="<?php echo base_url('pages/ceprovider'); ?>" class="btn btn-primary">View CE Provider's Page</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function() {
 var pop = '<?php if($_REQUEST['id']=="done"){  ?>'+ $('#companyPromotionSuccess').modal('show') + '<?php } ?>';

    $('#example').DataTable();
    $('#example1').DataTable();
} );
</script>


