<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-adslistspanel">
    <div class="container">
	
        <div class="row">
            <?php 
        $this->load->view('admin/sidebar');
		$inactivelist='';
        ?>
				
             <form method="POST" action="<?php echo BASE_URL('admin/adslists');?>" id="traningfilterform">
				    <div class="form-group col-sm-2">
						<select name="country" class="form-control">
							<option value="" >Country:</option>
							<?php foreach($countries as $count){
								?>
							   <option value="<?php echo $count['countries_id']; ?>" <?php if($_POST['country']==$count['countries_id']){echo'selected';} ?> ><?php echo $count['countries_name']; ?></option>
							<?php
							} ?>
					    </select>
					</div>
         
                   <div class="form-group col-sm-3">
				        <select name="advertiser" class="form-control" id="advertiser">									
							<option value="" >Select an Advertiser</option>
								<?php foreach ($advertisers as $key => $advertise) { ?>
									<option <?php if($advertise['id']==$_REQUEST['advertiser']){ echo "selected"; } ?> value="<?php echo $advertise['id']?>">
									<?php echo $advertise['name'];?>
									</option>
								<?php } ?> 							
					    </select>
					</div>	   
					
					 <div class="form-group col-sm-2">
				  
						<select name="location" class="form-control">
							<option value="" >Location:</option>
							<?php foreach($locations as $location){	?>
							
							<option value="<?php echo $location['location_name']; ?>" <?php if($_POST['location']==$location['location_name']){echo'selected';} ?> ><?php echo $location['location_name']; ?></option>
							<?php	} ?>
					    </select>
					</div>
					
                   <div class="form-group col-sm-2">
				  
						<select name="size" class="form-control">
							<option value="" >Size:</option>
							<?php foreach($banner_size as $size){							
								
								$bnsize=$size['size_width'].'x'.$size['size_height'];
								
								?>
							
							   <option value="<?php echo $bnsize; ?>" <?php if($_POST['size']==$bnsize){echo'selected';} ?> ><?php echo $bnsize; ?></option>
							<?php
							} ?>
					    </select>
					</div>
                 
				     <div class="form-group col-sm-2">
							<input type="number" name="view" class="form-control" value="<?php echo set_value('view')?>" placeholder="View">
					</div>

					<div class="form-group col-sm-2">
							<input type="date" name="date" class="form-control" value="<?php echo set_value('date')?>">
					</div>
					<div class="form-group col-sm-1">
						
						<input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
					</div>
					
				</form>
   <!-- New Html Start 28.12.2018 -->
         
            <div class="col-sm-9">    
			<div class="mob-tablescroll">    
            <?php echo $this->session->flashdata('response');?>
                    <table class="table table-condensed adv_table">
                      <thead>
                        <tr>
                          <th>S.N.</th>
                          <th>Package Name</th>
						  <th>Location</th> 
						  <th>Size</th>
                          <th>Views Bought</th>                         
                          <th>Countdown</th>  
                          <th>Start</th>                            
                          <th>End</th>                            
                          <th>Image</th>						  
						  <th>Advertiser</th>
						  <th>Country</th>
                          <th>Status</th>  
						  <!-- <th>Action</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						$Sn=1;
						
						//print_r($adv[0] );
						
                        foreach ($adv as $key => $value) {
                      
                       
                        if($value['status']==1){
                          $stts = "Enabled";
                          $col = "green";   
                        } else {
                          $stts = "Disabled";
                          $col = "red";  
                        }                               
                       $advertiser = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 
                        
						if($value['total_view']>=$value['no_of_view'])
							{
								
								$inactivelist.='<tr>';
								$inactivelist.='<td>'.$Sn.'</td>';
								$inactivelist.='<td>'.$value['package_name'].'</td>';
								$inactivelist.='<td>'.$value['location'].'</td>';
								$inactivelist.='<td>'.$value['size'].'</td>';
								$inactivelist.='<td>'.$value['no_of_view'].'</td>';
								$inactivelist.='<td>'.$value['total_view'].'</td>';
								$inactivelist.='<td>'.$value['purchased_on'].'</td>';															
								$inactivelist.='<td>'.$value['package_end_date'].'</td>';															
								$inactivelist.='<td><img src="'.BASE_URL.'/assets/upload/'.$value['banner_image'].'" style="width: 50px; width: 50px;"></td>';								
								
								
								$inactivelist.='<td>'.$advertiser[0]['name'].'</td>';
								$inactivelist.='<td>'.$value['countries_name'].'</td>';
								
								$inactivelist.='<td><a style="color: '.$col.'" href="'. site_url().'/admin/adstatus/'. $value['id'].'/'. $value['status'].'">'.$stts.'</a> </td>';					
								// $inactivelist.='<td><a target="_blank" href="#" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>';					
								
								$inactivelist.='</tr>';
								
								continue;
								
							}
						
						?>
						
                        <tr>
                          <th><?php echo $Sn;?></th>
                          <td><?php echo $value['package_name'];?></td>
						  <td><?php echo $value['location'];?></td>
						  <td><?php echo $value['size'];?></td>
                          <td><?php echo $value['no_of_view'];?></td> 
						  <td><?php echo $value['total_view'];?></td>
						  <td><?php echo $value['purchased_on'];?></td>
						  <td><?php echo $value['package_end_date'];?></td>
						 <td><img src="<?php echo BASE_URL;?>/assets/upload/<?php echo $value['banner_image'];?>" style="width: 50px; width: 50px;"></td>
                          
                          <td><?php echo $advertiser[0]['name'];?></td>
                          <td><?php echo $value['countries_name'];?></td>
						<td>
                            <a style="color: <?php echo $col;?>" href="<?php echo site_url();?>/admin/adstatus/<?php echo $value['id'];?>/<?php echo $value['status'];?>"><?php echo $stts;?></a> </td>
                        <!-- <td><a target="_blank" href="#" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a></td> -->
						</tr>
                        <?php  $Sn++; } ?>
                      </tbody>
                    </table>
                    <?php 
                    if(empty($adv)){
                      echo "<p>Sorry no records found.</p>";
                    }
					 
                    ?>                 

				</div>
			</div>

 
              <div class="col-sm-9">            
                <h3 class="border-title text-left pull-left">Completed Ads</h3>
             </div> 
            <div class="col-sm-9">               
				<div class="mob-tablescroll"> 
                    <table class="table table-condensed adv_table">
                      <thead>
                        <tr>
                          <th>S.N.</th>
                          <th>Package Name</th>
						  <th>Location</th> 
						  <th>Size</th>
                          <th>Views Bought</th>                         
                          <th>Countdown</th>  
                          <th>Start</th>                            
                          <th>End</th>                            
                          <th>Image</th>
						
						  <th>Advertiser</th>
						  <th>Country</th>
                          <th>Status</th>
						  <!-- <th>Action</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						echo $inactivelist;
                        ?>
                      </tbody>
                    </table>
                  </div>
				</div>
	  </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready( function () {
    $('#adv_table').DataTable();
} );
</script>


 