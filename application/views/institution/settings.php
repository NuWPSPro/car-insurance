<?php $this->load->view('institution/picture'); ?>

<div class="innerContent">
	<div class="container">
		<div class="row">
		<?php $this->load->view('institution/sidebar'); ?>
		      <div class="col-sm-9">
        <h3 class="border-title text-left">Settings</h3>       
        <?php if($ins_details['under_insititution']==0){ $result = 'No'; $style = "Display:none"; }else{ $result = 'Yes'; $style = ""; } ?>
        <?php echo $this->session->flashdata('response');?>
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <label>Institution Name </label>
                    <input type="text" name="Name" id="" class="form-control" value="<?php echo $ins_details['name']; ?>" readonly> 
                </div></div>

                <div class="col-sm-6">
                <div class="form-group">
                    <label>Institution code </label>
                    <input type="text" name="code" id="" class="form-control" value="<?php echo $ins_details['insititution_id']; ?>" readonly> 
                </div></div>
            </div>
        
        <div class="ins-form" style="<?=$style?>">
        <form action="<?php echo BASE_URL;?>institution/settings" method="post" enctype="multipart/form-data">
        <hr style="border-top: 2px solid #eee;">
            <div class="row">
                <?php //print_r($prof_details);?>
                     <div class="col-sm-12">
                        <div class="form-group">
                            <label>Are you Under Institution ?</label> 
                            <input type="text" name="under_ins" value="<?=$result;?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                        <label>Select Institution </label>  
                            <select  name="institution" id="institution" class="form-control" onchange="return blank();">
                                <?php //$ins_id = end(explode('-',$ins_details['parent_insititution'])); ?>
                                <option value="" selected>Please Select</option>
                                <?php foreach($institution_list as $key => $value){ 
                                if($ins_details['parent_insititution'] == $value['id']){ $condition ='selected'; }else{ $condition =''; } ?>
                                <option value="<?=$value['id']; ?>" <?=$condition;?> ><?=$value['name']; ?></option>
                                <?php }?>
                            </select> 
                        </div>
                    </div>

                     <div class="col-sm-12" >
                        <div class="form-group">
                            <label>Enter Institution code </label>
                            <?php $ins_code = $this->db->get_where('tbl_user',array('id'=>$ins_details['parent_insititution']))->row_array()['insititution_id'];?> 
                            <input type="text" name="ins_code" id="ins_code" class="form-control" value="<?php echo set_value('ins_code',$ins_code); ?>"> 
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <p class="col-sm-12 submit alignleft">
                        <input class="btn btn-primary" value="Update" type="submit" name="save" onclick="return confirm('Do You want Update Institution ?');">
                    </p>
                </div>
            </form>
            <div>

            </div>
		</div>
	</div>
</div>
</div>
</div>

<script type="text/javascript">
    function blank(){
        $('#ins_code').val("");
    }
</script>