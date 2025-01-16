 <?php $this->load->view('admin/picture'); ?> 
 <div class="innerContent admin-active-promotionpanel">
	<div class="container">
	
		<div class="row">

		<?php 
		$this->load->view('admin/sidebar');
		?>	


		  <div class="col-sm-9">
            <h3 class="border-title text-left">Active Promotion</h3>
			
			<form method="POST" action="<?php echo BASE_URL('admin/active_promotion');?>" id="traningfilterform">
			 <div class="row">
				    <div class="form-group col-md-3">
						<select name="country" class="form-control">
							<option value="" >Country:</option>
							<?php foreach($countries as $count){
								?>
							   <option value="<?php echo $count['countries_id']; ?>" <?php if($_POST['country']==$count['countries_id']){echo'selected';} ?> ><?php echo $count['countries_name']; ?></option>
							<?php
							} ?>
					    </select>
					</div>
         
                   <div class="form-group col-md-3">
				        <select name="category" class="form-control" id="category">									
								<option value="" >Category</option>
								<option value="Online Course" >Online Course</option>
								<option value="Training" >Training</option>
								<option value="CE Provider" >CE Provider</option>
								<option value="Professional" >Professional</option>
															
									   
					    </select>
					</div>					

					<div class="form-group col-md-3">
							<input type="date" name="date" class="form-control" value="<?php echo set_value('date')?>">
					</div>
					<div class="form-group col-md-2">
						
						<input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
					</div>
					</div>
				</form>
            <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                <th>No.</th>
                <th>Promotion Name</th> 
                <th>Category</th> 
                <th>Day</th> 
                <th>Start Day</th> 
				<th>End Day</th> 
				<th>Countdown</th>
				<th>Country</th>
				<th>Status</th>
				<th>Action</th>
                </tr>
                <?php 
                 $tot=0;
                 foreach ($purchase_list as $key => $value) {
                 $tot = $tot+$value['amount'];   
                ?>
                <tr>
                  <td><?php echo $key+1; ?></td> 
                  <td><?php echo $value['course_title']; ?></td> 
                  <td>Online Course</td>  
                  <td><?php
				       $date1 = new DateTime($value['expiry_on']);
						$date2 = new DateTime($value['added_on']);
						echo $date1->diff($date2)->format("%d");
				  
				  ?></td>  
                  <td><?php echo $value['added_on']; ?></td>  
				  <td><?php echo $value['expiry_on']; ?></td>  
				  <td><?php
				       $date1 = new DateTime(date('Y-m-d'));
						$date2 = new DateTime($value['added_on']);
						echo $date1->diff($date2)->format("%d");
				  
				  ?></td> 
				  <td><?php echo $value['countries_name']; ?></td> 
				  <td>Active</td>
				  <td><a  href="#" class="btn btn-info" title="View"><i class="fa fa-eye"></i></td>
                </tr>
                <?php 
                 }
                ?>
                     
                
            </table>
                </div>
            <?php 
            if(empty($purchase_list)){
              ?>
               <p style="color: red;">Sorry no records found.</p>
              <?php 
            }
            ?>
        
        </div>
		</div>
	</div>
</div>