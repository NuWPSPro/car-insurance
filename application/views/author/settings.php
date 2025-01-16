<?php $this->load->view('template/picture_author'); ?>
<div class="innerContent pb-5 author-settings">
	<div class="container">
		<div class="row">
		<?php $this->load->view('author/sidebar'); ?>

		<div class="col-sm-9">
		<h3 class="border-title text-left">Affilition</h3>
        <?php echo $this->session->flashdata('response');?>		
			<form action="<?php echo BASE_URL;?>author/settings" method="post" enctype="multipart/form-data">
				<div class="row">
                <?php if(empty($author_details['under_provider'])){ $result = '0'; }else{ $result = '1'; } ?>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Are you under provider ?</label> 
                            <select name="under_provider" class="form-control" onchange="display()" id="myselect" readonly>
                                <option value="1" <?php if($result==1){echo'Selected';} ?> >Yes</option>
                                <option value="0" <?php if($result==0){echo'Selected';} ?> >No</option>
                            </select>
                        </div>
                    </div>

                    <?php $selectedprov = end(explode('-', $author_details['under_provider'])); ?>
                    <div id="selectprovider">
                    <div class="col-sm-12" id="provider_name">
                        <div class="form-group">
                        <label>Select Provider </label> 
                            <select  name="provider_name" id="provider_name" class="form-control" onchange="return blank();" readonly>
                                <option value="" selected>Please Select</option>
                                <?php foreach ($provider_list as $key => $value){  ?>
                                <option value="<?php echo $value['id']; ?>" <?php if($value['id'] == $selectedprov){ echo 'selected'; }?> ><?php echo $value['name'].' '.$value['username_email']; ?>
                                </option><?php  } ?>
                            </select> 
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Enter provider code </label> 
                            <input type="text" name="provider_code" id="provider_code" class="form-control" value="<?php echo $author_details['under_provider']; ?>" readonly> 
                        </div>
                    </div>
                    </div>
					<!-- <p class="col-sm-12 submit alignleft">
						<input class="btn btn-primary" value="Update" type="submit" name="save">
					</p> -->
				</div>
			</form>

           

		</div>
	</div>
</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>
<script type="text/javascript">
	function blank(){
		$('#provider_code').val("");
	}
    function display(){
       var value = $( "#myselect" ).val();
       if(value==1){
            $( "#selectprovider" ).show();
        }else{
            $( "#selectprovider" ).hide();
        }
    }
       
</script>