<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
    <div class="container">
        <h2 class="border-title text-left">Dashboard</h2>
        <div class="row">
        
        <?php 
        $this->load->view('admin/sidebar');
        ?>
           
        <!-- New Html Start 28.12.2018 -->

          <!--   <div class="col-sm-8">
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#addpackegs">Add Packegs</button>
                <h3 class="border-title text-left pull-left">Update Package</h3>
            </div> -->




            <div class="col-sm-9"> 
               
           


             <form action="<?php echo site_url();?>/admin/editadvertise" method="post" enctype="multipart/form-data" name="form1" id="form1">
              <?php echo $this->session->flashdata('response');?>
             
              <input type="hidden" name="idd" id="idd" value="<?php echo $advertise[0]['id'];?>">

              <div class="form-group">
                <label for="email">Name:</label>
                <input type="text" class="form-control" id="package_name" name="package_name" value="<?php echo $advertise[0]['package_name'];?>">
                 <span class="error"><?php echo  form_error('package_name'); ?></span>
              </div> 

           

               <div class="form-group">
                <label for="email">Location:</label> 
                <select name="location" id="location" class="form-control" onchange="setsize(this.value)">
                  <option value="" selected>Please Select</option>
				  <?php 
					foreach ($locations as $key => $value) {
					?>
					<option <?php if($advertise[0]['location']==$value['location_name']){ echo "selected";}?> value="<?php echo $value['location_name'];?>"><?php echo $value['location_name'];?></option>
					<?php
					}
					?>
                                    
                  </select>
                 <span class="error"><?php echo  form_error('location'); ?></span>
              </div>
			  
			   <div class="form-group">
                <label for="email">Size:</label> 
                <select name="size" id="size" class="form-control">
                  <option value="" selected>Please Select</option>
				  <?php 
					foreach ($banner_size as $key => $value) {
						if($value['location']!=$advertise[0]['location'])
						{
							continue;
						}
						$size=$value['size_width'].'x'.$value['size_height'];
					?>
					<option <?php if($advertise[0]['size']==$size){ echo "selected";}?> value="<?php echo $size;?>"><?php echo $size;?></option>
					<?php
					}
					?>
                                    
                  </select>
                 <span class="error"><?php echo  form_error('location'); ?></span>
              </div>


              <div class="form-group">
                <label for="email">Price:</label>
                <input type="text" class="form-control allownumericwithdecimal" id="price" name="price" value="<?php echo $advertise[0]['price'];?>">
                 <span class="error"><?php echo  form_error('price'); ?></span>
              </div> 

			  <div class="form-group">
                <label for="email">Minimum view:</label>
                <input type="text" class="form-control allownumericwithoutdecimal" id="minimum_view" name="minimum_view" value="<?php echo $advertise[0]['minimum_view'];?>">
                 <span class="error"><?php echo  form_error('minimum_view'); ?></span>
              </div> 

               <div class="form-group">
                <label for="email">Package Image:</label>
                <input type="file" class="form-control" id="package_image" name="package_image">
                 <span class="error"><?php echo  form_error('package_image'); ?></span>
                 <br>
                <img src="<?php echo BASE_URL;?>/assets/upload/<?php echo $advertise[0]['package_image'];?>" style="width: 75px; width: 75px;">
              </div> 
             
                
              <button type="submit" class="btn btn-primary">Update</button>
            </form>




            </div>
        </div>
    </div>
</div>

<script>
var banner_size=<?php echo json_encode($banner_size); ?>;
function setsize(location)
{
	var sizehtml=' <option value="" selected>Please Select</option>';
	for (i in banner_size) {
		  if(banner_size[i].location==location)
		  {
			 var sizedimension=banner_size[i].size_width+'x'+banner_size[i].size_height;
			 sizehtml+='<option value="'+sizedimension+'">'+sizedimension+'</option>'; 
		  }
		
		}
   jQuery('#size').html(sizehtml);		
		
}

$(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
	//this.value = this.value.replace(/[^0-9\.]/g,'');
$(this).val($(this).val().replace(/[^0-9\.]/g,''));
	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
});

$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
   $(this).val($(this).val().replace(/[^\d].+/, ""));
	if ((event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
});
</script>

 