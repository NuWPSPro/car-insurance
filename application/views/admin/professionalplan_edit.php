<?php $this->load->view('admin/picture'); 
//print_r($planleditArr);
$taxrate = $this->db->get_where('tbl_misc',array('status'=>1))->row_array()['set_percentage'];
?>
<div class="innerContent">
    <div class="container">
        <h2 class="border-title text-left">Dashboard</h2>
        <div class="row">
            <?php 

		$this->load->view('admin/sidebar');

		?>
            <div class="col-sm-8">
                <h3 class="border-title text-left">Professonal Plan Edit</h3>
                <?php echo $this->session->flashdata('response');?>
               
			<form action="<?php echo site_url();?>/admin/professionalplan_edit/<?php echo $planleditArr->propla_id;?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
				<p>
					<label>Plan Name <span class="required"> * </span> </label>
					<input name="propla_id" value="<?php echo $planleditArr->propla_id;?>" class="form-control" size="20" type="hidden" >
					<input name="pro_package_name" value="<?php echo $planleditArr->pro_package_name;?>" class="form-control" size="20" type="text" >
					<span class="error"></span>
				</p> 
				<div class="d-flex">
				<p style="width: 35%;">
					<label>Price ($) <span class="required"> * </span> </label>
					<input name="base_price" id="price" value="<?php echo $planleditArr->base_price;?>" class="form-control" size="20" type="text" >
					<span class="error" id="tax-error"></span>
				</p>
				<p style="width: 35%;  margin-left: 15px;">
				<label for="pwd">Tax (%)</label>
				<input type="number" name="tax_percentage" id="tax" class="form-control" placeholder="Please enter tax in percentages" value="<?php echo $taxrate; ?>" step=".01" readonly>
				<input type="hidden" name="tax_amount" id="tax_amount" value="<?php echo $planleditArr->tax; ?>">
				</p>
				<p style="width: 30%; margin-left: 15px;">
				<label> Price + Tax </label>
				<button type="button" class="form-control btn btn-primary" onclick="taxcalculation()">Calcualte Tax</button>
				</p>
				</div>
				<p>
					<label for="pwd">Price with Tax</label>
  					<input type="text" maxlength="5" class="form-control" id="pro_package_amount" name="pro_package_amount" required value="<?php echo $planleditArr->pro_package_amount;?>" readonly></p>
				<p>
					<label>Plan Type <span class="required"> * </span> </label>
					<select name="pro_plan_type" class="form-control">
					<option value="1" <?php echo ($planleditArr->pro_plan_type == '1')?'selected':'';?>>1 Month</option>
					<option value="6" <?php echo ($planleditArr->pro_plan_type == '6')?'selected':'';?>>6 Months</option>
					<option value="12" <?php echo ($planleditArr->pro_plan_type == '12')?'selected':'';?>>1 Year</option>
					<option value="36" <?php echo ($planleditArr->pro_plan_type == '36')?'selected':'';?>>3 Years</option>
					</select>
					<span class="error"></span>
				</p> 
				<p>
					<label>Plan Features <span class="required"> * </span> </label>
					<?php  
					$assingfeaturs = explode(',',$planleditArr->pro_plan_features);
					$plandesarr = $this->professional_model->plandetails();
					$plafeatur = '<ul>';
					foreach($plandesarr as $pdes){
						$featurchecked = (in_array($pdes['ppf_id'],$assingfeaturs))?'checked':'';
						$plafeatur .= '<li style="list-style:none;"><input type="checkbox" name="pro_plan_features[]" value="'.$pdes['ppf_id'].'" '.$featurchecked.'> '.$pdes['features_name'].'</li>';
					}
					$plafeatur .= '</ul>';
					echo $plafeatur;
					 ?>
					
					<span class="error"></span>
				</p> 
				<p class="submit alignleft">
					<input class="btn" value="Update" type="submit" name="save">
					<a class="btn" href="<?php echo base_url('admin/professionalplan'); ?>">Cancel</a>
				</p>	
			</form>          
            </div>
        </div>
    </div>
</div>

<script>
	function taxcalculation(){
	    var price = $('#price').val();
	    var tax   = $('#tax').val();

	    if(price=='' || tax==''){
	        $('#tax-error').html('Please fill the Price and Tax.').css('color','red');
	    }else{
	        var taxrate  = ((price * tax)/100).toFixed(2);
	        var total    =  parseFloat(price) +  parseFloat(taxrate);

	        $('#tax_amount').val(taxrate);
	        $('#pro_package_amount').val(total);
	    }
	 }
</script>