<section> 
	<div class="innerContent">
	    <div class="container">
	        <div class="row">
	            <?php  
	                	$provider_id = $this->session->userdata('logged_in')['id'];
	                	$training_id = $this->uri->segment(3);  ?>
	            <div class="col-sm-12">
	                   
	                <div class="step-wise-query provider-overview">
	                    <?php $this->load->view('provider/training_menu_edit'); ?>
	                    <div class="tab-content steps-detail">
	                    <a href="#" class="btn btn-warning pull-right" data-toggle="modal" data-target="#addRegistrationItem">Add Registration Item</a>
	                    	
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
                            
	                    	<?php echo form_open_multipart('provider/customize_registration_next/'.$training_id); ?>
	                    	<?php echo $this->session->flashdata('response'); ?>
                            <!-- =======================Other category ================= -->
                            <?php if($categorylist){ 
                            	// print_r($categorylist);die;
                            	foreach($categorylist as $key => $value){ 
                            		$checked_category = $this->db->get_where('tbl_registration_option',array('category_id'=>$value['id'],'added_by'=>$provider_id,'status'=>'1'))->num_rows();?>
                         
                            <div class="d-flex">
                                <div class="form-control">
								<label><?=$value['category_name'];?> <sup>*</sup></label>
									<label class="btn btn-info">
										On <input type="radio" id="id<?php echo $value['id']; ?>" data-id="<?php echo $value['id']; ?>" name="<?php echo $value['category_name']; ?>" value="1" onclick="getValue(this);" <?php if($checked_category > 0){ echo 'checked'; } ?> >
									</label>
									<label class="btn btn-info">
										Off <input type="radio" data-id="<?php echo $value['id']; ?>" name="<?php echo $value['category_name']; ?>" value="0" onclick="getValue(this);" <?php if($checked_category <= 0){ echo 'checked'; } ?>>
									</label>
                            	</div>
                                <div class="form-control" id="<?php echo $value['category_name'].$key; ?>Option" style="<?php if($checked_category <= 0){ echo 'display: none'; } ?>">

                                <?php if($value['type']=='o'){ ?>	
	                                <label>Option<sup>*</sup></label>
	                                <select name="">
										<?php $option = $this->provider_model->get_result_array('tbl_registration_option',array('category_id'=>$value['id'],'status'=>'1'));
											foreach ($option as $op){ ?>
											<option value="<?=$op['option_name']; ?>"><?=$op['option_name']; ?></option>
										<?php } ?>
	                                </select>
									
                            		<a href="javascript:void(0)" class="btn btn-info" onclick="showOptionPopup('<?php echo $value['id']; ?>')">Add Option</a>
								<?php } ?>

                            		<a href="javascript:void(0)" class="btn btn-primary" onclick="showEditOptionPopup('<?php echo $value['id']; ?>')">Edit</a>
	                                <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteCategory('<?php echo $value['id']; ?>');">Delete Category</a>
                            	</div>
                            </div>
							<?php } ?> 
								<p  class="mt-3"><input type="submit" class="btn btn-primary btn-lg" name="submit" value="SAVE & NEXT"></p>
							<?php }else{
								echo '<p class="mt-3"><a href="'.base_url('provider/training_speaker_edit/').$training_id.'" class="btn btn-success btn-lg">SAVE & NEXT</a></p>';
							}  ?> 
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
      <?php echo form_open('provider/add_registration_category/'.$training_id); ?>
      <div class="modal-body">
      	<!-- <p>
			<label>Category Name<sup>*</sup></label>
			<input type="text" name="item_name" value="" class="form-control">
			<span class="error"><?php echo  form_error('item_name'); ?></span>
		</p> -->
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
      	<p class="opItemReg" id="regf-option" style="display: none;">
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

<!-- Edit Registration Category and option Modal -->
<div class="modal fade" id="editRegistrationItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Edit Registration Item</h5>
      </div>
      <?php echo form_open('provider/edit_registration_category/'.$training_id); ?>
      <div class="modal-body">
		<input type="hidden" name="training_id" value="<?=$training_id;?>" class="form-control">
		<input type="hidden" name="provider_id" value="<?=$provider_id;?>" class="form-control">
		<input type="hidden" name="category_id" id="edit_category_id" value="" class="form-control">
		<p class="opForReg">
			<!-- <span class="addOptionBtn btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></span> -->
			<label>Category Name</label>
			<input type="text" name="item_name" id="category_name" value="" class="form-control" required="">
      	</p>
		
		<p class="opForReg">
		<label>Mandatory</label>
		<span class="form-control">
			<input type="radio" name="mandatory" id="category_mandatory" value="1" >  <label>Mandatory Field</label>
			<input type="radio" name="mandatory" id="category_non_mandatory" value="0">  <label>Non Mandatory Field</label>
		</span></p>	
		
		<p class="opForReg">
		<label>Status</label>
		<span class="form-control">
			<input type="radio" name="status" id="active_status" value="1" >  <label>Active</label>
			<input type="radio" name="status" id="inactive_status" value="0">  <label>Inactive</label>
		</span><p>

      	<p class="opItemReg" id="DBoption">
			<span class="addItemBtn btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></span>
			<label>Option 1</label>
			<input type="text" name="option[1]" id="option" value="" class="form-control">
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
      <?php echo form_open('provider/add_registration_option/'.$training_id); ?>
      <div class="modal-body">
		<p class="opItemReg">
			<input type="hidden" name="training_id" value="<?=$training_id;?>" class="form-control">
			<input type="hidden" name="provider_id" value="<?=$provider_id;?>" class="form-control">

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

    function showEditOptionPopup(category_id){
    	var id =  category_id;
    	var uid =  '<?php echo $provider_id ?>';
    	var tid =  '<?php echo $training_id ?>';
		        // alert(id+' * '+uid+' * '+tid);
		$.ajax({
		        type: "POST",
		        url: '<?php echo base_url("provider/get_category");?>',
		        data: { id : id , uid : uid, tid : tid},
		        // beforeSend: function(){
		        //     $('#Preview_button').val('Please wait...');
		        // },
		        success: function(result){
		        	var obj = JSON.parse(result);
		        	// alert(obj.category['type']);
                	var option ='<p class="opItemReg">';
                	var num = 1;

					if(obj.category['type']!='f')
					{
						for (i in obj.options) 
						{
							result = obj.options[i];
							option += '<label>Option '+ num +'<sup>*</sup></label><input type="text" name="option_name['+ result.id +']" value="'+ result.option_name +'" class="form-control"><input type="hidden" name="option['+ num +']" value="'+ result.id +'" class="form-control">';
							num++; 
						}
							option +='</p>';
							$('#DBoption').html(option);
					}
					$('#DBoption').css("display","none");
		            $('#category_name').val(obj.category['category_name']);
		            $('#edit_category_id').val(obj.category['id']);
		            if (obj.category['mandatory'] == 1) {
		                $('#category_mandatory').val(obj.category['mandatory']).attr('checked', 'checked');
		            } else {
		                $('#category_non_mandatory').val(obj.category['mandatory']).attr('checked', 'checked');
		            }
		            if (obj.category['status'] == 1) {
		                $('#active_status').val(obj.category['status']).attr('checked', 'checked');
		            } else {
		                $('#inactive_status').val(obj.category['status']).attr('checked', 'checked');
		            }
    				$('#editRegistrationItem').modal('show');
		        }
		        
		    });
    }
    function deleteCategory(category_id){
    	var x = confirm('Are You Sure, you want to delete this category!');
    	var tid = '<?php echo $training_id;?>';
    	if(x == true){
    		window.location.href = "<?php echo BASE_URL.'provider/delete_category/'?>"+category_id+'/'+tid;
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