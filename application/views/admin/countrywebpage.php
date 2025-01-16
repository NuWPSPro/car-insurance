<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-countrywebpage-panal">
	<div class="container">
		<div class="row">
		<?php $this->load->view('admin/sidebar'); ?>	
		<div class="col-sm-9">
			<h3 class="border-title text-left">Country Web Page</h3>
		 <?php $cont=$this->db->get_where('countries',array("countries_id"=>$this->uri->segment(3)))->row_array(); ?>

            <form action="<?php echo BASE_URL;?>admin/countrywebpage" method="post" enctype="multipart/form-data" name="form101" id="form101">

            <?php echo $this->session->flashdata('response'); ?> 

            <p>
                <label>Country <span class="required"> * </span> </label>
                <input readonly class="form-control" name="name" size="20" value="<?=$cont['countries_name']?>"  type="text">
                <input  class="form-control" name="cid" value="<?=$cont['countries_id']?>"  type="hidden">
                <span class="error"><?php echo  form_error('country'); ?></span>
            </p>

        <!-- <select name="cid" id="cid" class="form-control" >
                <option value="" selected="">Choose Country</option>
                <option value="16">Bahamas</option>
                <option value="99">India</option>
                <option value="168">Philippines</option>
                <option value="223">Unites countries</option>
            </select>-->

            <p>
                <label>Background Image </label>
                <input class="form-control" name="image" size="20"  type="file">
                <span class="error"><?php echo  form_error('image'); ?></span>
            </p>

            <p>
                <label>Heading <span class="required"> * </span> </label>
                <input  name="hedding" id="hedding" class="form-control" size="20"  type="text" value="<?=$cont['hedding']?>">
                <span class="error"><?php echo  form_error('hedding'); ?></span>
            </p>

            <p>
                <label>Sub heading<span class="required"> * </span> </label>
                <input  name="sub_hedding" id="sub_hedding" class="form-control" size="20"  type="text" value="<?=$cont['sub_hedding']?>">
                <span class="error"><?php echo  form_error('sub_hedding'); ?></span>
            </p>

            <p>
                <label>Name of photo</label>
                <input  name="name" id="name" class="form-control" type="text" value="<?=$cont['name']?>">
                <span class="error"><?php echo  form_error('name'); ?></span>
            </p>
            
            <p>
                <label>Link</label>
                <input  name="link" id="link" class="form-control" type="url" value="<?=$cont['link']?>">
                <span class="error"><?php echo  form_error('link'); ?></span>
            </p>
            
            <p>
                <label>Owner</label>
                <input  name="photo_owner" id="photo_owner" class="form-control" type="text" value="<?=$cont['photo_owner']?>">
                <span class="error"><?php echo  form_error('photo_owner'); ?></span>
            </p>

            <p>
                <label>Show on Choose Country<span class="required"> * </span> </label>				
                <select name="display" id="display" class="form-control" >
                    <option  <?php if($cont['display']=="No"){ echo "selected='selected'";} ?> value="No">No</option>
                    <option <?php if($cont['display']=="Yes"){ echo "selected='selected'";} ?> value="Yes">Yes</option>
                </select>
            </p>
            
            <p class="submit alignleft">
                <input class="btn btn-primary" value="Save" type="submit" name="save">
            </p>

        </form>
    </div>
        
    
		</div>
	</div>
</div>