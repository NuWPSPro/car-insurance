<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-advertisepanel">
    <div class="container">
		
        <div class="row">
        
        <?php 
        $this->load->view('admin/sidebar');
        ?>
           
        <!-- New Html Start 28.12.2018 -->

            <div class="col-sm-9">
                <div class="admin-titlebox">
                <h3 class="border-title">Ads Package</h3>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addpackegs">Add Packegs</button>
               
                </div>
            </div>




            <div class="col-sm-9">
                <div class="mob-tablescroll"> 
                <?php echo $this->session->flashdata('response');?>
                    <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th>S.N.</th>                         
                          <th>Name</th>                         
                          <th>Location</th> 
						  <th>Size</th>
                          <th>Price per view</th>						  
                          <th>Minimum view</th>
                          <th>Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						$sn=1;
                        foreach ($advertise as $key => $value) {
                        ?>
                        <tr>
                          <th><?php echo $sn++;?></th>                         
                          <td><?php echo $value['package_name'];?></td>                         
                          <td><?php echo $value['location'];?></td>
						  <td><?php echo $value['size'];?>px</td>
                          <td><?php echo $value['price'];?> cents</td>
						  <td><?php echo $value['minimum_view'];?> views</td>
                          <td><img src="<?php echo BASE_URL;?>/assets/upload/<?php echo $value['package_image'];?>" style="width: 50px; width: 50px;"></td>
                          <td>
                            <a href="<?php echo site_url();?>/admin/editadvertise/<?php echo $value['id'];?>">Edit</a> &nbsp;&nbsp; 
                            <a onclick="return confirm('Are you sure you want to delete it.')" href="<?php echo site_url();?>/admin/deleteadvertise/<?php echo $value['id'];?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <?php 
                    if(empty($advertise)){
                      echo "<p>Sorry no records found.</p>";
                    }
                    ?>
                    </div>
                    

            </div>
        </div>
    </div>
</div>






<div id="addpackegs" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Ads Packages</h4>
            </div>
                <form action="<?php echo site_url();?>/admin/addadvertise" method="post" enctype="multipart/form-data" name="form1" id="form1">
                 
                  <div class="modal-body">
                    <p>
                        <label>Name<span class="required text-danger"> * </span> </label>
                        <input type="text" class="form-control" id="package_name" name="package_name" required>
                        <span class="error"><?php echo  form_error('package_name'); ?></span>
                    </p>
                    

                    <div class="row">
                       
                        <div class="col-md-3">
                            
                                <label>Locations <span class="required text-danger"> * </span> </label>
                                <div class="selection-box">
                                    <select name="location" id="location" class="form-control" onchange="setsize(this.value)" required>
                                    <option value="" selected>Please Select</option>
                                    <?php 
										foreach ($locations as $key => $value) {
										?>
										<option value="<?php echo $value['location_name'];?>"><?php echo $value['location_name'];?></option>
										<?php
										}
										?>
                                    
                                    </select>
                                    <span class="error"><?php echo  form_error('location'); ?></span>
                                </div>
                           
                        </div>
                         
                          <div class="col-md-3">
                          
                                <label>Size<span class="required text-danger"> * </span> </label>
                                <div class="selection-box">
                                    <select name="size" id="size" class="form-control" required>
                                    <option value="" selected>Please Select</option>
                                    
                                    </select>
                                    <span class="error"><?php echo  form_error('size'); ?></span>
                                </div>
                           
                        </div> 


                        <div class="col-md-3">
                           
                                <label>Price Per View <span class="required text-danger"> * </span> </label> 
                                <input type="text" class="form-control allownumericwithdecimal" id="price" name="price" required>
                                <span class="error"><?php echo  form_error('price'); ?></span>
                            
                        </div> 
						<div class="col-md-3">
                           
                                <label>Minimum View <span class="required text-danger"> * </span> </label> 
                                <input type="text" class="form-control allownumericwithoutdecimal" id="minimum_view" name="minimum_view" value="500" required>
                                <span class="error"><?php echo  form_error('minimum_view'); ?></span>
                            
                        </div>
                    </div>


                    <p>
                        <label>Photo Image <span class="required text-danger"> * </span> </label>
                        <input type="file" class="form-control" id="package_image" name="package_image" required>
                        <span class="error"><?php echo  form_error('package_image'); ?></span>
                    </p>
                    <!-- <p class="submit alignleft">
                        
                    </p> -->
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                </div>
            </form>
        </div>
    </div>
</div>




<script type="text/javascript">
    
function addtocart(pid)
{
 alert(pid);
$.ajax({
type: "POST",
url: '<?php echo base_url()."cart/addtocart";?>',
data: {pid:pid}
}).done(function( result ) {
  alert(result);
$("#filteredData2").html( result );
});              
return false;   
  

}

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