<?php $this->load->view('template/picture_provider'); 
$idd = $this->uri->segment(3);
                $tidd = $this->session->userdata('current_training_id');
                $training = $this->user->getspeakers('tbl_training_speaker','training_id',$tidd); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
           <?php  $training_types = $this->session->userdata('training_types'); ?>
            <div class="col-sm-12">

                  <div class="pull-right">
                    <?php if($training_types=="pro"){ ?>
                        <a href="#"><input type="button" name="pro" id="pro" value="PROFESSIONAL VERSION" class="btn-danger"></a>
                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-primary"></a>
                    <?php }else{ ?>
                        <a href="#"><input type="button" name="free" id="free" value="FREE VERSION" class="btn-primary"></a>
                        <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-success"> </a>
                    <?php } ?>
                    </div>

                <h3 class="border-title text-left">Upload Training/Seminar</h3>
                        
                <div class="step-wise-query provider-overview">
                    <?php $this->load->view('provider/training_menu'); ?>
                    <div class="tab-content steps-detail">
                        <div id="step1" class="tab-pane fade in active">
		                          
			<form method="post" action="<?php echo site_url('provider/training_speaker'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                
				<?php echo $this->session->flashdata('response');?>
                <span style="color:red"><?php echo validation_errors(); ?></span>
				<div class="form-group">
				    <label for="exampleInputEmail1">Speaker Name<sup>*</sup></label>
				    <input type="text" class="form-control" id="speaker_name" name="speaker_name"  placeholder="Enter speaker name" required> 
				</div>

				<div class="form-group">
				    <label for="exampleInputEmail1">Speaker Image<sup>*</sup></label>
				    <input type="file" class="form-control" id="speaker_image" name="speaker_image" required> 
				</div> 

                <div class="form-group">
                    <label for="exampleInputEmail1">Position<sup>*</sup></label>
                    <input type="text" class="form-control" id="position" name="position" required> 
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Insititution<sup>*</sup></label>
                    <input type="text" class="form-control" id="insititution" name="insititution" required> 
                </div>

				<div class="form-group">
				    <label for="exampleInputEmail1">Description<sup>*</sup></label>
				    <textarea class="form-control text_editor" id="description" name="description"></textarea> 
                    <span id="description_error"></span>
				</div>

                <?php if($training_types!="pro"){ $display = 'disabled';  }else{ $display = ''; $onclick=''; }?>
                <div class="row"> 
                    <div class="input_fields_wrap col-sm-8">
                        <label for="exampleInputEmail1"><b>Upload speaker's presentation/lecture:</b>
                        <?php if($training_types!="pro"){ ?><span style="color: red;">(Available only at PRO-Version)<br>(To make the speaker's presentation or lecture accessible to participants both in mobile and website you can upload it here.)</span><?php } ?>
                        </label> 
                        <div class="speaker-add">
                            <input type="file" class="form-control" id="powerpoint" name="powerpoint[]" <?=$display?>> 
                            <button class="add_field_button btn btn-success" <?=$display?>>Add More</button> 
                        </div> 
                    </div>
                    <div class="col-sm-4">
                        <?php if($_SESSION['service_type']=="free"){ ?>
	<a href="javascript:void(0)" onclick="upgradetopro(<?=$idd?>);"><input type="button" name="button" value="Upgrade to Pro-Version" class="btn btn-primary" style="margin-top: 91px;">
	</a>
	<?php } ?>
                    </div>
                </div> 

                <div class="col-sm-12">
				    <button type="submit" name="submit" class="btn btn-info" value="save">Save & Add Speaker</button>
                    <button type="submit" name="submit" class="btn btn-success" value="save_next">Save & Next</button>
                </div>
            </form>

                <br>
                <br>
                <br>

            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Speaker Name</th>  
                    <th>Image</th>  
                    <th>Description</th>  
                    <th>Powerpoint</th>  
                    <th>Action</th> 
                  </tr>
                </thead>

                <tbody class="row_position">
                <?php foreach ($training as $key => $value){

                    $where = array('training_id'=>$tidd,'speaker_id'=>$value['id']);  
                    $powerpoint = $this->user->get_record_by_multi_field_name('tbl_speaker_powerpoint',$where); ?>

                <tr  id="<?php echo $value['id']; ?>">
                    <td><?php echo $key+1; ?>.</td> 
                    <td><?php echo $value['speaker_name']; ?></td>  
                    <td> 
                        <img style="height: 50px; width: 50px;" src="<?php echo BASE_URL.'assets/images/uploads/'.$value['speaker_image']; ?>"> 
                    </td> 
                    <td><?php echo substr($value['speaker_description'],0,150); ?></td> 
                    <td><?php if(!empty($powerpoint[0]['images'])){
                        $explodedData = explode('##', $powerpoint[0]['images']);
                        foreach ($explodedData as $key => $val1){ ?>
                        <img style="height: 50px; width: 50px;" src="<?php echo BASE_URL.'assets/images/uploads/'.$val1; ?>"> <?php } }else{ echo 'N/A';} ?>
                    </td>
                    <td>
                       <!--  <a class="btn btn-primary" title="Edit" href="<?php echo site_url('provider/training_speaker_update/'.$value['id'].'/'.$tidd); ?>"><i class="fa fa-pencil"></i></a>&nbsp;  -->
                        
                        <a class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/speaker_delete_addtime/'.$value['id'].'/'.$tidd.'');?>"><i class="fa fa-trash"></i></a> 
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
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append(' <div class="speaker-add"><input type="file" class="form-control" name="powerpoint[]"><a style="margin-top:7px;" href="#" class="remove_field btn btn-danger">Remove</a></div>'); //add input box
        }
    }); 
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });

    // $('#speakerform').submit(function () {
    //     var description = $("#description").val();
    //     if (description == "") {
    //         $('#description_error').html('Description is required field.').css('color','red');
    //         $('#description').focus();
    //         return false;
    //     }
    // });

   function upgradetopro(tid) {
        var r = confirm('Do you want to upgrade to Pro Version!');
        if (r == true) {
            window.location.href = "<?php echo base_url('provider/upgradetopro/'); ?>"+tid;
      	}
    }
</script>