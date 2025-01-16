<section> 
	<div class="innerContent">
	    <div class="container">
	        <div class="row">
	            <?php   $_SESSION['service_type'] = 'paid';
	                	$training_types = $this->session->userdata('training_types');
	                	$provider_id = $this->session->userdata('logged_in')['id'];
	                	$training_id = $this->session->userdata('current_training_id');  ?>
	            <div class="col-sm-12">
	                   <!-- <div class="pull-right">
	                    <?php if($training_types=="pro"){ ?>
	                        <a href="#"><input type="button" name="free" id="free" value="PROFESSIONAL VERSION" class="btn-danger"></a>
	                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-primary"></a>
	                    <?php }else{ ?>
	                        <a href="#"><input type="button" name="free" id="free" value="FREE VERSION" class="btn-primary"></a>
	                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-success"> </a>
	                    <?php } ?>
	                    </div>
	                    <h3 class="border-title text-left pull-left">Customization of Registration</h3> -->
	                <div class="step-wise-query provider-overview">
	                    <?php $this->load->view('provider/training_menu'); ?>
	                    <div class="tab-content steps-detail">
	                    	<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addRegistrationItem">Add Registration Item</a>
	                    	
	                    	<div class="row">
	                    		<div class="form-group">
	                    			<label>Default Fields</label>
	                    			<ul>
	                    				<li> <label>Name <sup>*</sup></label></li>
	                    				<li> <label>Email <sup>*</sup></label></li>
	                    				<li> <label>Phone Number </label></li>
	                    				<li> <label>Profession <sup>*</sup></label></li>
	                    				<li> <label>Country <sup>*</sup></label></li>
	                    			</ul>
	                    		</div>
	                    	</div>

	                    	<?php echo form_open_multipart('provider/customize_registration_next'); ?>
	                    	<?php echo $this->session->flashdata('response'); ?>
                            <?php if($categorylist){ 
                            	// print_r($categorylist);die;
                            	foreach($categorylist as $key => $value){ ?>
                                <div class="d-flex">
									<div class="form-control">
										On <input type="radio" data-id="<?php echo $value['id']; ?>" name="<?php echo $value['category_name']; ?>" value="1" onclick="getValue(this);" required>
										Off <input type="radio" data-id="<?php echo $value['id']; ?>" name="<?php echo $value['category_name']; ?>" value="0" onclick="getValue(this);">
										<label><?=$value['category_name'];?> <sup>*</sup></label>
									</div>
									<div class="form-control" id="<?php echo $value['category_name']; ?>Option" style="display: none;">
										<label>Option<sup>*</sup></label>
										<?php $option = $this->provider_model->get_result_array('tbl_registration_option',array('category_id'=>$value['category_id'],'status'=>'1'));
											foreach ($option as $op){ ?>
											<option value="<?=$op['option_name']; ?>"><?=$op['option_name']; ?></option>
										<?php } ?>
										<a href="javascript:void(0)" class="btn btn-info" onclick="showOptionPopup('<?php echo $value['id']; ?>')">Add Option</a>
									</div>
                            	</div>
                            <?php } }else{ echo 'No category found!'; }  ?>
                            <input type="submit" class="btn btn-primary btn-lg" name="submit" value="SAVE & NEXT">
                            <?php echo form_close();?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>

<!-- Add Registration Item Modal -->
<div class="modal fade" id="addRegistrationItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Add Registration Item</h5>
      </div>
      <?php echo form_open('provider/add_registration_category'); ?>
      <div class="modal-body">
      	<input type="hidden" name="training_id" value="<?=$training_id;?>" class="form-control">
		<input type="hidden" name="provider_id" value="<?=$provider_id;?>" class="form-control">
		<p>
			<label>Type <sup>*</sup></label>
			<input type="radio" name="type" value="o" onclick="selecttype(this)">  <label>Multi Option</label>
			<input type="radio" name="type" value="f" onclick="selecttype(this)">  <label>Single Field</label>
		</p>
		<p class="opForReg">
			<!-- <span class="addOptionBtn btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></span> -->
			<label>Category Name <sup>*</sup></label>
			<input type="text" name="item_name" value="" class="form-control" required="">
			
			<input type="radio" name="mandatory" value="1" >  <label>Mandatory Field</label>
			<input type="radio" name="mandatory" value="0">  <label>Non Mandatory Field</label>
      	<p class="opItemReg">
			<span class="addItemBtn btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></span>
			<label>Option 1<sup>*</sup></label>
			<input type="text" name="option[1]" id="option" value="" class="form-control">
      	</p>
      	</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" value="save" class="btn btn-primary">Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- Add Option Item Modal -->
<div class="modal fade" id="addOptionItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Add Option Item</h5>
      </div>
      <?php echo form_open('provider/add_registration_option'); ?>
      <div class="modal-body">
			<input type="hidden" name="training_id" value="<?=$training_id;?>" class="form-control">
			<input type="hidden" name="provider_id" value="<?=$provider_id;?>" class="form-control">
		<p class="opItemReg">
			<label>Option 1<sup>*</sup></label>
			<input type="hidden" name="category" id="category" value="" class="form-control">

			<input type="text" name="option[1]" id="option" value="" class="form-control">
			<span class="addItemBtn btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></span>
			<span class="error"><?php echo  form_error('option'); ?></span>
      	</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" value="save" class="btn btn-primary">Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<script>
	$(document).ready(function() {
	    var max_fields      = 30; //maximum input boxes allowed
	    var wrapper         = $(".opForReg"); //Fields wrapper
	    var add_button      = $(".addOptionBtn"); //Add button ID
	    var wrapperItem     = $(".opItemReg"); //Fields wrapper Item
	    var add_button_item = $(".addItemBtn"); //Add Item button ID
	    
	    var y = 1; //initlal text box count
	    $('body').on("click",".addItemBtn", function(e){ //on add input button click
	        e.preventDefault();
	        if(y < max_fields){ //max input box allowed
	            y++; //text box increment
	        	$(wrapperItem).append('<p class="opItemReg"><a href="#" class="addItemBtn btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a> <a href="#" class="remove_item btn btn-danger pull-right"><i class="fa fa-minus" aria-hidden="true"></i></a><label>Option '+ y +'<sup>*</sup></label><input type="text" name="option['+ y +']" value="" class="form-control"><span class="error"><?php echo  form_error('option'); ?></span></p>'); //add input box
	        }
	    }); 
	    $(wrapperItem).on("click",".remove_item", function(e){ //user click on remove text on item
	        e.preventDefault(); $(this).parent('p').remove(); y--;
	    })
    });
	function showOptionPopup(category_id){
		$('#addOptionItem').modal('show');
		$('#category').val(category_id);
	}
	var currentValue = 0;
	var currentName = '';
    function getValue(myRadio){
	    // alert('Old value: ' + currentValue);
	    // alert('New value: ' + myRadio.value +' ** ' + myRadio.name);
	    currentValue = myRadio.value;
	    currentName = myRadio.name;
	    currentId = myRadio.data-id;
	    if(currentValue == 1){
	    	if(currentName == currentName){
	    		$('#'+currentName+'Option').show();
	    		$('#category').val(currentId);
	    	}
	    }
	    if(currentValue == 0){
	    	if(currentName == currentName){
	    		$('#'+currentName+'Option').hide();
	    		$('#category').val(0);
	    	}
	    }
    }
    
    function selecttype(get){
    	var selected = get.value
    	if(selected == 'o'){
    		$('#regf-option').show();
    	}else{
    		$('#regf-option').hide();
    	}
    }
</script>