<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-subscription-listpanel">
	<div class="container">
		   <?php 
        $idd1 = $this->uri->segment(3);
        $cuntry1 = $this->db->get_where('countries',array('countries_id'=>$idd1,'display'=>'Yes'))->row_array(); 
        $cuntry13 = $this->db->get_where('countries',array('display'=>'Yes'))->result_array(); 
        $cnt = strtolower($cuntry1['countries_iso_code']);
        $idd1=$this->session->userdata('current_country'); ?>
	
   
		<div class="row">

		<?php 
		$this->load->view('admin/sidebar');
		?>	

<?php 

$month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

if($_REQUEST['month'] !=""){
  $mm = $_REQUEST['month'];
} else {
  $mm = date('m');
}

if($_REQUEST['year'] !=""){
  $yy = $_REQUEST['year'];
} else {
  $yy = date('Y');
}

$uid = $_REQUEST['users'];

$country = $this->user->get_all_country();
?>
	    <div class="col-sm-9">
             <?php echo $this->session->flashdata('response');?>
            <h3 class="border-title text-left">Subscription List</h3>
			<div class = "subscriptionfilter">
			      <form action="<?php echo base_url('admin/subscription'); ?>" method="get" name="filter22222" id="filter22222" > 
      <div class="col-sm-3 form-group">
            <label>Country<sup></sup></label>
          <select name="countrylist" id="country" class="form-control">
              <option value="">International</option>
            <?php foreach($cuntry13 as $c){ ?>
              <option <?php if($_REQUEST['countrylist']==$c['countries_id']){ echo "selected";}?> value="<?=$c['countries_id']?>" <?php if($idd1==$c['countries_id']){ echo "selected" ;} ?>>
                <?=$c['countries_name']?>
              </option>
            <?php } ?>
          </select>
        <span class="error"></span>
      </div>
   <script type="text/javascript">
          /*   function filter() 
			{
             
              var idd = $('#countrylist').val();
              
            } */
  </script>  
   <div class="col-sm-3 form-group">
      <label>Month <sup></sup></label>
        <select name="month" id="month" class="form-control" >
            <option value="" <?php if(!is_array($parameter) || $parameter['month']==""){echo "selected";} ?>>...Select...</option>
            <?php 
                foreach ($month as $key => $value) { ?>

                <option  <?php if($_REQUEST['month']==$key){ echo "selected";}?>  value="<?php echo $key;?>">
                    <?php echo $value; ?>
                </option>
                
                <?php } ?>

        </select>
        <span class="error"></span>
    </div>




 <div class="col-sm-3 form-group">
        <label>Year <sup></sup></label>
        <select name="year" id="year" class="form-control" >
            <?php 
            $year = date('Y');
            for ($i=2015; $i <=$year ; $i++) { 
            ?>
              <option <?php if($_REQUEST['year'] ==$i){ echo "selected";} ?> value="<?php echo $i;?>">
                <?php echo $i;?></option>
            <?php } ?>
    </select>
    <span class="error"></span>
</div> 


	<div class="col-sm-3 form-group">
    <input style="margin-top: 30px;" type="submit" class="btn btn-primary" value="Filter" >
    <a href="<?php echo base_url('admin/subscription');?>">    
		<input style="margin-top: 30px;" type="reset" class="btn btn-primary" value="Reset">
	 </a>
	</div> 
</form>
</div>
        <!--    <table class="table table-striped table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Plan Name</th>
                    <th>Plan Price</th>
                    <th>No of allowed upload seminar</th>
                    </tr>
                <?php 
                 $tot=0;
                 foreach ($subs_list as $key => $value) {
                  
                 $sdata = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','id',$value['plan_id']);

                ?>
                <tr>
                    <td><?php echo $key+1;?>.</td>
                    <td><?php echo $sdata[0]['plan_name'];?></td>
                    <td><?php echo $sdata[0]['plan_price'];?></td>
                    <td><?php echo $sdata[0]['allow_number'];?></td>
                </tr>
                <?php 
                 }
                ?>
                   
                
            </table>
            
            
            <!-- Modal 
            <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Receipt No. 12345</h4>
                </div>
                <div class="modal-body">
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>              
              </div>
            </div>
            </div>-->
            
            
        </div>
		
		
		
		
		
		 <div class="col-sm-9">
             <?php echo $this->session->flashdata('response');?>
          <h3 class="border-title text-left">Active Subscription :</h3>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              
			    
			    <tr>
                    <th>No.</th>
                    <th>Plan Name</th>
                    <th>Duration </th>
                    <th>Amount</th>
                    <th>Date Paid</th>
                    <th>Start Date</th>
                    <th>Ending Date</th>
                    <th>Countdown</th>
                    <th>Name of Prof.</th>
                    <th>Country</th>
                    </tr> 
					<?php 
                 $tot=0;
                 foreach ($subs_list as $key => $value) {
                  
                 $sdata = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','id',$value['plan_id']);

                ?>
                <tr>
                    <td><?php echo $key+1;?>.</td>
                    <td><?php echo $sdata[0]['plan_name'];?></td>
                    <td><?php echo $sdata[0]['duration'];?></td>
                    <td><?php echo $sdata[0]['plan_price'];?></td>
                    <td><?php echo $sdata[0]['date_paid'];?></td>
                    <td><?php echo $sdata[0]['date_on'];?></td>
                    <td><?php echo $sdata[0]['countdown'];?></td>
                    <td><?php echo $sdata[0]['name_prof'];?></td>
                    <td><?php echo $sdata[0]['country'];?></td>
                    
                </tr>
                <?php 
                 }
                ?>
        </table>
    </div>
      <h3 class="border-title text-left">In-Active Subscription :</h3>
      <div class="table-responsive">
			 <table class="table table-striped table-bordered">
			 <tr>
                    <th>No.</th>
                    <th>Plan Name</th>
                    <th>Duration </th>
                    <th>Amount</th>
                    <th>Date Paid</th>
                    <th>Start Date</th>
                    <th>Ending Date</th>
                    <th>Countdown</th>
                    <th>Name of Prof.</th>
                    <th>Country</th>
                    </tr> 
					<?php 
                 $tot=0;
                 foreach ($subs_list as $key => $value) {
                  
                 $sdata = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','id',$value['plan_id']);

                ?>
                <tr>
                    <td><?php echo $key+1;?>.</td>
                    <td><?php echo $sdata[0]['plan_name'];?></td>
                    <td><?php echo $sdata[0]['duration'];?></td>
                    <td><?php echo $sdata[0]['plan_price'];?></td>
                    <td><?php echo $sdata[0]['date_paid'];?></td>
                    <td><?php echo $sdata[0]['date_on'];?></td>
                    <td><?php echo $sdata[0]['countdown'];?></td>
                    <td><?php echo $sdata[0]['name_prof'];?></td>
                    <td><?php echo $sdata[0]['country'];?></td>
                    
                </tr>
                <?php 
                 }
                ?>
            
                   
                
            </table>
          </div>
            
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Receipt No. 12345</h4>
                </div>
                <div class="modal-body">
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>              
              </div>
            </div>
            </div>
            
            
        </div>
		 
 
		</div>
	</div>
</div>