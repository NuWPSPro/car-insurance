<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
          
            <div class="col-sm-12">
                <h3 class="border-title text-left">Upload Training/Seminar</h3>
                <div class="step-wise-query">
                    <div class="tab-content steps-detail">
                        <a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
                        <div id="step1" class="tab-pane fade in active">
              
                <?php  $training_types = $this->session->userdata('training_types'); 
                $id  = $this->uri->segment(4);
                $tid = $this->uri->segment(3);

                $speaker = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','id',$id);

                $this->load->view('provider/training_menu_edit'); 
                ?>
		                          
				<form method="post" action="<?php echo site_url('provider/training_speaker_update'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
				<div class="form-group">
					 <?php echo $this->session->flashdata('response');?>

                <input type="hidden" name="tid" id="tid" value="<?php echo $tid;?>"> 
                <input type="hidden" name="sid" id="sid" value="<?php echo $id;?>"> 

				<label for="exampleInputEmail1">Speaker Name<sup>*</sup></label>
				<input type="text" class="form-control" id="speaker_name" name="speaker_name"  placeholder="Enter speaker name" required value="<?php echo $speaker[0]['speaker_name']; ?>"> 
				</div>

				<div class="form-group">
                    <label for="exampleInputEmail1">Speaker Email<sup>*</sup></label>
                <input type="text" class="form-control" id="speaker_email" name="speaker_email"  placeholder="Enter speaker email" required value="<?php echo $speaker[0]['speaker_email']; ?>"> 
                </div>

                <div class="form-group">
				<label for="exampleInputEmail1">Speaker Image<sup>*</sup></label>
				<input type="file" class="form-control" id="speaker_image" name="speaker_image"> 
                <br>
                <img style="height: 50px; width: 50px;" src="<?php echo BASE_URL.'assets/images/uploads/'.$speaker[0]['speaker_image']; ?>"> 
				</div>  


                <div class="form-group">
                <label for="exampleInputEmail1">Position<sup>*</sup></label>
                <input type="text" class="form-control" id="position" name="position" required value="<?php echo $speaker[0]['position']; ?>"> 
                </div>



                <div class="form-group">
                <label for="exampleInputEmail1">Insititution<sup>*</sup></label>
                <input type="text" class="form-control" id="insititution" name="insititution" required value="<?php echo $speaker[0]['insititution']; ?>"> 
                </div>



				<div class="form-group">
				<label for="exampleInputEmail1">Description<sup>*</sup></label>
				<textarea class="form-control text_editor" id="description" name="description"><?php echo $speaker[0]['speaker_description']; ?></textarea> 
				</div>

            <?php   $where = array('training_id'=>$tid,'speaker_id'=>$id);  
                    $powerpoint = $this->user->get_record_by_multi_field_name('tbl_speaker_powerpoint',$where);  ?>

                <?php if($training_types!="pro"){ $display = 'disabled';  }else{ $display = ''; $onclick=''; }?>
                <div class="row"> 
                    <div class="input_fields_wrap col-sm-8">
                        <label for="exampleInputEmail1"><b>Upload speaker's presentation/lecture:</b>
                            <?php if($training_types!="pro"){ ?><span style="color: red;">(Available only at PRO-Version)<br>(To make the speaker's presentation or lecture accessible to participants both in mobile and website you can upload it here.)<?php } ?></span></label> 
                        <div class="speaker-add">
                            <input type="file" class="form-control" id="powerpoint" name="powerpoint[]" <?=$display?>> 
                            <button class="add_field_button btn btn-info" <?=$display?> >Add More</button>  
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <?php  if(!empty($powerpoint[0]['images'])){
                                $pid = $powerpoint[0]['id'];
                               $trid = $powerpoint[0]['training_id'];
                               $explodedData = explode('##', $powerpoint[0]['images']);
                    foreach ($explodedData as $key => $val1) { ?>
                        <img style="height: 50px; width: 50px;" src="<?php echo BASE_URL.'assets/images/uploads/'.$val1; ?>"> <a class="btn-canecel" href="<?php echo base_url('provider/deletePowerpoint/'.$pid.'/'.$key.'/'.$trid);?>" onclick="delete_powerpoint()" title="Delete"><i class="fa fa-close" style="color: red;"></i></a>
                    <?php  } }else{ echo 'N/A'; } ?> 
                    </div>
                </div> 


                <div class="col-sm-12">
				    <button type="submit" class="btn btn-primary" value="save">Update Speaker</button>
                    <button type="submit" name="submit" class="btn btn-success" value="save_next">Save & Next</button>
                </div>
                    
				</form>

                

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
    var max_fields      = 30; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append(' <div class="speaker-add"><input type="file" class="form-control" name="powerpoint[]"><button class="add_field_button btn btn-info" >Add More</button><a style="margin-top:7px;" href="#" class="remove_field btn btn-danger">Remove</a></div>'); //add input box
        }
    }); 
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
    });
    function delete_powerpoint()
    {
        // alert(pid);
        var doc; 
            var result = confirm('Are you sure, Do you want to delete it?'); 
            if (result == true) { 
                doc = 'Delete'; 
            }
        
        // <?php echo base_url('provider/deletePowerpoint/'.$powerpoint[0]['id'].'/'.$tidd)?>
    
    }
</script>