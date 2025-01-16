<?php $this->load->view('template/picture'); ?>


 <div class="innerContent">
      <div class="container">
      <div class="row">
            <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div>
       <?php  $this->load->view('professional/sidebar');  ?>  
      

       <div class="col-sm-8">
            <h3 class="border-title text-left">PLAN SUBSCRIPTION</h3>
			<?php echo $this->session->flashdata('response'); ?>
			
			<?php 
				// echo '<pre>'; print_r($currentplanArr);
				//if($currentplanArr->payment_status == 'y' ){
				if(count($currentplanArr) >0 ){
						 //$planname 	= ($currentplanArr->version_type == 2)?'PRO-Version':'Basic';
						 if($currentplanArr->version_type == 1){
							// $planname =  'Basic';
							$planname =  'Free trail - Proversion';
						 }
						 if($currentplanArr->version_type == 2){
							$planname =  'PRO-Version';
						 }if($currentplanArr->version_type == 3){
							$planname =  'Premium';
						 }
						 $expiry	= strtotime($currentplanArr->plan_expiry_at);
						// $today		= strtotime($paythtry['plan_active_date']);
						 $today		= strtotime(date('Y-m-d'));
						 $remaindays	=  $expiry - $today;
						 $dayreamaining = floor($remaindays / (60 * 60 * 24));
						 if($dayreamaining < 0){ $dreamining = 'Expired'; }else{ $dreamining = $dayreamaining.' Days'; }
						echo '<h5>Active:</h5>
						<table class="table table-striped table-bordered">
						<tr>
							<th>No.</th>
							<th>Plan Name</th>
							<th>Duration</th>
							<th>Stating Date</th>
							<th>End Date</th>
							<th>Countdown</th>
							<th>Action</th>
						</tr>
						<tr>
							<td>1.</td>
							<td>'.$planname.'</td>
							<td>'.$currentplanArr->plan_duration.'</td>
							<td>'.$currentplanArr->plan_active_at.'</td>
							<td>'.$currentplanArr->plan_expiry_at.'</td>
							<td>'.$dreamining.'</td>
							<td>
							<!--<a class="btn btn-info" href="javascript:void(0);" title="View" onclick="showBill('.$currentplanArr->ppp_id.')"><i class="fa fa-eye"></i></a>--> 
							<a class="btn btn-info" href="javascript:void(0);" data-toggle="modal" data-target="#planlistingmodal" title="Renew" ><i class="fa fa-refresh"></i></a> 
							<a class="btn btn-info" href="javascript:void(0);" data-toggle="modal" data-target="#planlistingmodal" title="Upgrade"><i class="fa fa-level-up"></i></a> </td>
							
						</tr>
						</table>';
					}
				if(count($planpaymenthistoryArr) > 0){
					$count = 1;  	
					echo '
					<!--<div style="text-align:right;padding-bottom:10px;"><button data-toggle="modal" data-target="#planlistingmodal">Upgrade your Plan</button></div>-->';
					
					echo '<h5>Subscription History:</h5>
					<table class="table table-striped table-bordered">
					<tr>
						<th>No.</th>
						<th>Plan Name</th>
						<th>Duration</th>
						<th>Stating Date</th>
						<th>End Date</th>
						<th>Countdown</th>
						<th>Action</th>
					</tr>';  
					 foreach($planpaymenthistoryArr as $paythtry ){
							 //$planname = ($paythtry['version_type'] == 2)?'PRO-Version':'Basic';
							 if($currentplanArr->version_type == 1){
								$planname =  'Basic';
							 }
							 if($currentplanArr->version_type == 2){
								$planname =  'PRO-Version';
							 }if($currentplanArr->version_type == 3){
								$planname =  'Premium';
							 }
							 $expiry	= strtotime($paythtry['plan_expiry_date']);
							// $today		= strtotime($paythtry['plan_active_date']);
							 $today		= strtotime(date('Y-m-d'));
							 $remaindays	=  $expiry - $today;
							 $dayreamaining = floor($remaindays / (60 * 60 * 24));
							 if($dayreamaining < 0 ){
								$expirydate			= strtotime($paythtry['plan_expiry_date']);
								$activationdate		= strtotime($paythtry['plan_active_date']); 
								$planexpireddays	=  $expirydate - $activationdate;
								$totalplanday		= floor($planexpireddays / (60 * 60 * 24));
								$plandaycounter 	= $totalplanday.' Complited';
							 }else{
								$daytxt = ($dayreamaining >1)?' Days':' Day';
								$plandaycounter 	=  ($dayreamaining == 0)?'Plan expired today':$dayreamaining.$daytxt;
							 }
							 echo '<tr>
									<td>'.$count.'.</td>
									<td>'.$planname.'</td>
									<td>'.$currentplanArr->plan_duration.'</td>
									<td>'.$paythtry['plan_active_date'].'</td>
									<td>'.$paythtry['plan_expiry_date'].'</td>
									<td>'.$plandaycounter.'</td>
									<td>
							<!--<a class="btn btn-info" href="javascript:void(0);" title="View" onclick="showBill('.$paythtry['ppp_id'].')"><i class="fa fa-eye"></i></a>--> 
							<a class="btn btn-info" href="javascript:void(0);" data-toggle="modal" data-target="#planlistingmodal" title="Renew" ><i class="fa fa-refresh"></i></a> 
							<a class="btn btn-info" href="javascript:void(0);" data-toggle="modal" data-target="#planlistingmodal" title="Upgrade"><i class="fa fa-level-up"></i></a> </td>
							
								</tr>';
							 $count++;	
						
					}
					echo '</table>';             
				}else{
                  //echo "<p style='color:red;text-align:center;'>Sorry no subscription records found.</p>";
                }
            ?>
        </div>
       </div>
    </div>
    </div>

  <div class="modal fade" id="receipt" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Receipt No. <span id="rid"></span></h4>
        </div>
          <p style="color: red; text-align: center; display: none;" id="waitmessage">Please wait.... </p>
          
        <div class="modal-body">
            <span id="responseData"></span>
        </div>            
      </div>
    </div>
  </div>

<script type="text/javascript">
    $(document).ready(function() {
     var pop = '<?php if($_REQUEST['id']=="done"){  ?>'+ $('#PromotionPractiseSuccess').modal('show') + '<?php } ?>';
    } );
    function showBill(idd)
    {
    	var type = 'Plan';
      $('#rid').html(idd);
      $('#waitmessage').show();
      //jQuery.noConflict();
      $("#receipt").modal('show');
      $.ajax({
      type: "POST",
      url: '<?php echo base_url("professional/showBill");?>',
      data: {idd:idd,type:type}
      }).done(function( result ){
        //alert(result);
        $('#waitmessage').hide();
        $("#responseData").html( result );
      });              
      return false;   
    }
</script>

