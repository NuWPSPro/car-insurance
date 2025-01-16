<?php $this->load->view('template/picture_provider');
    $idd = $this->uri->segment(3); ?>

<div class="innerContent">
    <div class="container">
        <div class="row">
          
            <div class="col-sm-12">
                <div class="step-wise-query provider-overview">
                    <?php $id = $this->uri->segment(3); ?>
                    <?php $this->load->view('provider/training_menu_edit'); ?>
					<?php $training_types = ($trainig_data[0]['training_type']==1)?'pro':'free'; ?>
		         
            <div class="tab-content steps-detail">                
				<form method="post" action="<?php echo site_url('provider/training_speaker_edit'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">
                    <?php echo $this->session->flashdata('response');?>
                    <span style="color:red"><?php echo validation_errors(); ?></span>
                    <div class="form-group">
                        <input type="hidden" name="tid" id="tid" value="<?php echo $id;?>"> 
                        <label for="exampleInputEmail1">Speaker Name<sup>*</sup></label>
                        <input type="text" class="form-control" id="speaker_name" name="speaker_name"  placeholder="Enter speaker name" required> 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Speaker email<sup>*</sup></label>
                        <input type="text" class="form-control" id="speaker_email" name="speaker_email"  placeholder="Enter speaker Email" required> 
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
                    <div class="form-group"> 
                        <div class="input_fields_wrap col-sm-12" >
                            <label for="exampleInputEmail1" ><b>Upload speaker's presentation/lecture:</b>    
                                <?php if($training_types!="pro"){ $display = 'disabled';  }else{ $display = ''; $onclick=''; }?>
                                <?php if($training_types!="pro"){ ?><span style="color: red;">(Available only at PRO-Version)<br>(To make the speaker's presentation or lecture accessible to participants both in mobile and website you can upload it here.)<?php } ?></span>
                                <?php if($training_types!="pro"){ ?>
                                    <a href="javascript:void(0)" onclick="upgradetopro(<?=$idd?>);"><input type="button" name="button" value="Upgrade to Pro-Version" class="btn btn-primary float-right">
                                </a>
                                <?php } ?>    
                            </label> 
                            <div class="speaker-add"> 
                                <input type="file" class="form-control" id="powerpoint" name="powerpoint[]" <?=$display?> > 
                                <button type="button" class="add_field_button btn btn-info" <?=$display?>>Add More</button>  
                            </div>
                        </div>
                    </div> 

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info" value="save">Save & Add Speaker</button>
                        <button type="submit" name="submit" class="btn btn-success" value="save_next">Save & Next</button>
                    </div>	
                        
                </form>
                <div class="mt-2">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Speaker Name</th>
                                    <th>Speaker email</th>  
                                    <th>Image</th>  
                                    <th>Description</th>
                                    <th>Powerpoint</th>    
                                    <th>Action</th> 
                                </tr>
                            </thead>

                            <tbody class="row_position">
                                <?php 
                                $tidd =  $this->uri->segment(3);
                                $training = $this->user->getspeakers('tbl_training_speaker','training_id',$this->uri->segment(3));
                                foreach ($training as $key => $value) {
                                    $where = array('training_id'=>$tidd,'speaker_id'=>$value['id']);  
                                    $powerpoint = $this->user->get_record_by_multi_field_name('tbl_speaker_powerpoint',$where);
                                    if($value['speaker_email']){
                                        $speaker_email = $value['speaker_email'];
                                    }else{
                                        $speaker_email = '--';
                                    } ?>
                                    <tr id="<?php echo $value['id']; ?>">
                                        <td><?php echo $key+1; ?>.</td> 
                                        <td><?php echo $value['speaker_name']; ?></td>  
                                        <td><?php echo $speaker_email; ?></td>  
                                        <td><img style="height: 50px; width: 50px;" src="<?php echo BASE_URL.'assets/images/uploads/'.$value['speaker_image']; ?>"></td> 
                                        <td><?php echo strip_tags(substr($value['speaker_description'],0,150)); ?></td> 

                                        <td class="d-flex"> 
                                        <?php if(!empty($powerpoint[0]['images'])){
                                            $pid = $powerpoint[0]['id'];
                                            $trid = $powerpoint[0]['training_id'];
                                            $explodedData = explode('##', $powerpoint[0]['images']);
                                        foreach ($explodedData as $key => $val1) { ?>
                                            <img style="height: 50px; width: 50px;" src="<?php echo BASE_URL.'assets/images/uploads/'.$val1; ?>"> <a class="btn-canecel" href="<?php echo base_url('provider/deletePowerpoint/'.$pid.'/'.$key.'/'.$trid);?>" onclick="delete_powerpoint()" title="Delete"><i class="fa fa-close" style="color: red;"></i></a>
                                        <?php  } }else{ echo 'N/A'; } ?> 
                                        </td>
                                    
                                        <td>
                                            <a class="btn btn-primary" title="Edit" href="<?php echo site_url('provider/training_speaker_update/'.$tidd.'/'.$value['id']); ?>"><i class="fa fa-pencil"></i></a>&nbsp; 
                                            <a class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/speaker_delete/'.$value['id'].'/'.$id.'');?>"><i class="fa fa-trash"></i></a> 
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(){ //on add input button click
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="speaker-add"><input type="file" class="form-control" name="powerpoint[]" style="margin-right: 10px;"><button style="margin-top:7px;" class="remove_field btn btn-danger">Remove</button></div>'); //add input box
            }
        }); 
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })

        // $('#speakerform').submit(function () {
        //     var description = $("#description").val();
        //     if (description == "") {
        //         $('#description_error').html('Description is required field.').css('color','red');
        //         $('#description').focus();
        //         return true;
        //     }
        // });  
    });

    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"<?php echo base_url('provider/sequence');?>",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }

    function delete_powerpoint(){
        // alert(pid);
        var doc; 
            var result = confirm('Are you sure, Do you want to delete it?'); 
            if (result == true) { 
                doc = 'Delete'; 
            }
    // <?php echo base_url('provider/deletePowerpoint/'.$powerpoint[0]['id'].'/'.$tidd)?>
        
    }
     

   function upgradetopro(tid) {
        var r = confirm('Do you want to upgrade to Pro Version!');
        if (r == true) {
            window.location.href = "<?php echo base_url('provider/upgradetopro/'); ?>"+tid;
      	}
    }
</script>