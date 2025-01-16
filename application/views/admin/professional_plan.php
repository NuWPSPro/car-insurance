<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-professional-planpanal">
	<div class="container">
	
		<div class="row">
		<?php 
		$this->load->view('admin/sidebar');
		?>	


<div class="col-sm-9">
       <h3 class="border-title text-left">Professional Plan</h3>
			<div class="step-wise-query">
			
			 <?php echo $this->session->flashdata('response');?> 
			 <div class="table-responsive">
             <table id="example" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>No.</th>
							<th>Package Name</th> 
							<th>Package Amount</th> 
							<th>Package Type</th> 
							<th>Description</th> 
							<th>Status</th> 
							<th>Action</th> 
					</tr>
				</thead>
        <tbody>
	
           <?php 
                foreach ($planlistingArr as $key => $value) {					
					$plandesarr = $this->professional_model->plandetails($value['pro_plan_features']);
					$plafeatur = '';
					foreach($plandesarr as $pdes){
						$plafeatur .= '<li>'.$pdes['features_name'].'</li>';
					}
                ?>
                <tr>
                    <td><?php echo $key+1; ?>.</td> 
                    <td><?php echo $value['pro_package_name']; ?></td>  
					<td>$<?php echo $value['pro_package_amount']; ?></td>    
					<td><?php echo $value['pro_plan_type']; ?> Months</td>  
                    <td><?php echo $plafeatur; ?></td> 					
					<?php 
                    if($value['pro_plan_status']==1){
                        $stts = "Enabled";
                        $col  = "green";
                    } else {
                        $stts = "Disabled";
                        $col  = "red";
                    }
                    ?>
					<td><?php echo  $stts; ?></td>  
                    <td>
                        <a href="<?php echo site_url('admin/professionalplan_edit/'.$value['propla_id'].'');?>">Edit</a>
                      </td>                  
                </tr>
                <?php } ?>
            
        </tbody>
	</table>
   </div>
    </div>  
    </div>

		 
 
		</div>
	</div>
</div>



<script type="text/javascript">
jQuery(document).ready(function() {
   jQuery('#example').DataTable();
} );

function setStatus(status)
{
	jQuery('#trstatus').val(status);
	jQuery('#sbbtn').click();
	

}
</script>