<?php $this->load->view('template/picture_provider'); ?>

<div class="innerContent">
	<div class="container">
		<div class="row">
		<?php $this->load->view('provider/sidebar'); ?>
		    <div class="col-sm-9">

        <form action="<?php echo BASE_URL;?>provider/settings" method="post" enctype="multipart/form-data">
        <h3 class="border-title text-left">Settings</h3>
        <?php echo $this->session->flashdata('response');?>

            <div class="row">
                <?php //print_r($prov_details);?>
                     <div class="col-sm-12">
                     <?php if($prov_details['under_insititution']==0){ $result = 'No'; $style = "Display:none"; }else{ $result = 'Yes'; $style = ""; } ?>
                        <div class="form-group">
                            <label>Are you Under Institution ?</label> 
                            <input type="text" name="under_ins" value="<?=$result;?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12" style="<?=$style;?>">
                        <div class="form-group">
                        <label>Select Institution </label>  
                            <select  name="institution" id="institution" class="form-control" onchange="return blank();" >
                                <?php// $ins_id = end(explode('-',$prov_details['insititution_id'])); ?>
                                <option value="" selected>Please Select</option>
                                <?php foreach($institution_list as $key => $value){ 
                                if($prov_details['parent_insititution'] == $value['id']){ $condition ='selected'; }else{ $condition =''; } ?>
                                <option value="<?=$value['id']; ?>" <?=$condition;?> ><?=$value['name']; ?></option>
                                <?php }?>
                            </select> 
                        </div>
                    </div>

                     <div class="col-sm-12" style="<?=$style;?>">
                        <div class="form-group">
                            <label>Enter Institution code </label>
                            <?php $ins_code = $this->db->get_where('tbl_user',array('id'=>$prov_details['parent_insititution']))->row_array()['insititution_id'];?> 
                            <input type="text" name="ins_code" id="ins_code" class="form-control" value="<?php echo set_value('ins_code',$ins_code); ?>" required> 
                        </div>
                    </div>
                </div>
                <hr style="border-top: 2px solid #eee;<?=$style?>">

            <?php if(0){ ?>
                <div class="row">                    
                    <div class="col-sm-12" style="<?=$style?>">
                        <label>Select Sub Institution </label>
                        <div class="form-group"> 
                        <select  name="sub_institution" id="sub_institution" class="form-control">
                                <?php //$ins_id = end(explode('-',$prov_details['insititution_id'])); ?>
                                <option value="" selected>Select Sub Institution</option>
                                <?php foreach($sub_institution_list as $key => $value){ 
                                if($prov_details['parent_insititution'] == $value['id']){ $condition ='selected'; }else{ $condition =''; } ?>
                                <option value="<?=$value['id']; ?>" <?=$condition;?> ><?=$value['name']; ?></option>
                                <?php }?>
                            </select> 
                        </div>
                    </div>

                     <div class="col-sm-12" style="<?=$style?>">
                        <div class="form-group">
                            <label>Enter Sub Institution code </label> 
                            <?php $sub_ins_code = $this->db->get_where('tbl_user',array('id'=>$prov_details['parent_insititution']))->row_array()['insititution_id'];?>
                            <input type="text" name="sub_ins_code" id="sub_ins_code" class="form-control" value="<?php echo set_value('sub_ins_code',$sub_ins_code); ?>"> 
                        </div>
                    </div>
                </div>

                <hr style="border-top: 2px solid #eee;<?=$style?>">
                <?php } ?>
            
                <div class="row">
                    
                    <div class="col-sm-12" id="prov_name_list">
                        <div class="form-group">
                        <label>CEP Provider </label> 
                        <input type="text" name="provider_name" id="provider_name" class="form-control" value="<?php echo $prov_details['name']; ?>" readonly>
                        </div>
                    </div>


                    <div class="col-sm-12" id="pro_code">
                        <div class="form-group">
                            <label>CEP Provider Code </label> 
                            <input type="text" name="provider_code" id="provider_code" class="form-control" value="<?php echo $prov_details['insititution_id']; ?>" readonly> 
                        </div>
                    </div>
                    <p class="col-sm-12 submit alignleft">
                        <input class="btn btn-primary" value="Update" type="submit" name="save">
                    </p>
                </div>
            </form>

            <!-- <?php if(isset($connected_rboard) && $connected_rboard != ''){ ?>
            <p class="text-danger" style="font-size: 22px;"><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="<?php echo BASE_URL.'provider/connectToRboard'; ?>">You are connected with <b><?=$connected_rboard->rboard_name; ?></b> Professioanl Regularity Board.</a></p>
            <?php }else{ ?>
            <p class="text-danger" style="font-size: 22px;"><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="<?php echo BASE_URL.'provider/connectToRboard'; ?>">Please click here to connect with Professioanl Regularity Board.</a></p>
            <?php } ?> -->
            
            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
    function blank(){
        $('#ins_code').val("");
    }
</script>

 

