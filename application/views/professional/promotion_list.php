<?php $this->load->view('template/picture'); ?>
<div class="innerContent professional-promotion_list">
	   <div class="container">
          <div class="row">
          <?php  $this->load->view('professional/sidebar');  ?> 
            
            <div class="col-sm-9">
              <h3 class="border-title text-left">Promotion List</h3>
              <h3 class="border-title text-left">Active Promotion</h3>
            <?php 
              $common = array();

              foreach($promotion_practise as $value){
                $txn_id = json_decode($value['transaction_details']);
               $date = $value['promoted_day'];
               $exp = date("Y-m-d",strtotime($value['promoted_date'].'+'. $date.'day'));
                if($exp >= date("Y-m-d")){
                $common[] = array(
                  'id'          =>  $value['id'],
                  'type'        =>  'Promotion',
                  'name'        =>  $txn_id->item_name1,
                  'paid_status' =>  'Complete',
                  'duration'    =>  $value['promoted_day'],
                  'added_on'    =>  $value['promoted_date'],
                  'expiry_on'   =>  $exp,
                  // 'amount'      =>$value['promoted_amount'],
                );
                } 
              } ?>

            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                      <tr>
                        <th>No.</th>
                        <th>Title</th> 
                        <th>Type</th> 
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
                  <td><?php echo $value['name']; ?></td>   
                  <td><?php echo $value['type']; ?></td>
                  <td><?php echo $value['duration']; ?></td>   
                  <td><?php echo $value['added_on']; ?></td>  
                  <td><?php echo $value['expiry_on']; ?></td> 

                  <td><a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#promotepractice" title="Renew"><i class="fa fa-refresh"></i></a></td>  
                </tr>
                <?php $count++; } } ?>  
            </table>
                </div>        
        </div>



<div class="col-sm-9">
            <h3 class="border-title text-left">Previous Promotion</h3>
            <?php 
               $commons = array();

              foreach($promotion_practise as $value){
                $txn_id = json_decode($value['transaction_details']);
                $date = $value['promoted_day'];
                $exp = date('Y-m-d',strtotime($value['promoted_date'] .'+'. $date.'day'));
                if($exp < date('Y-m-d') ){
                $commons[] = array(
                  'id'          =>  $value['id'],
                  'type'        =>  'Promotion',
                  'name'        =>  $txn_id->item_name1,
                  'paid_status' =>  'Complete',
                  'duration'    =>  $value['promoted_day'],
                  'added_on'    =>  $value['promoted_date'],
                  'expiry_on'   =>  $exp,
                  // 'amount'      =>$value['promoted_amount'],
                );
              } 
            }?>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                      <tr>
                        <th>No.</th>
                        <th>Title</th> 
                        <th>Type</th> 
                        <th>Duration</th> 
                        <th>Start Date</th> 
                        <th>End Date</th>  
                        <th>Action</th> 
                      </tr>
                  </thead>
                <?php if(!empty($commons)){
                 $tot=0;
                 $count=1;
                 foreach ($commons as $key => $value) {
                 //$tot = $tot+$value['amount'];   ?>
                <tr>
                  <td><?php echo $count; ?></td> 
                  <td><?php echo $value['name']; ?></td>   
                  <td><?php echo $value['type']; ?></td>
                  <td><?php echo $value['duration']; ?></td>   
                  <td><?php echo $value['added_on']; ?></td>  
                  <td><?php echo $value['expiry_on']; ?></td>   
                  <td><a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#promotepractice" title="Renew"><i class="fa fa-refresh"></i></a></td>   
                </tr>
                <?php $count++; } }  ?>  
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
            <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
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
  <a href="#" id="scroll" style="display: inline;"><span></span></a>

<script type="text/javascript">
$(document).ready(function() {
 var pop = '<?php if($_REQUEST['id']=="done"){  ?>'+ $('#companyPromotionSuccess').modal('show') + '<?php } ?>';

    $('#example').DataTable();
    $('#example1').DataTable();
} );
</script>


