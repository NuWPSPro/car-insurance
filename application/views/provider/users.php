 <div class="innerContent">
	<div class="container">
		<div class="row">
<!-- <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
		<?php 
		$this->load->view('provider/sidebar');
		?>	

		 


		<div class="col-sm-8">
		<h3 class="border-title text-center">PROFESSIONAL LISTING</h3> 
				 

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>User Type</th>
                <th>Profession</th>
                <th>Location</th>
                <th>Address</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($users as $key => $value) {  
            $type = "Professional";

            if($value['status']==1){
                    $stts = "Enabled";
                    $color = "green";
                } else {
                    $stts = "Disabled";
                    $color = "red";
                }

                
            ?>
            <tr>
                <td><?php echo $value['name'];?></td> 
                <td><?php echo $type;?></td> 
                <td><?php echo $value['profession'];?></td> 
                <td><?php echo $value['location'];?></td> 
                <td><?php echo $value['address'];?></td> 
                <td><?php echo $value['username_email'];?></td>  
                <td><a href="" style="color: <?php echo $color; ?>"><?php echo $stts;?></a></td> 
            </tr>
            <?php } ?>
            
        </tbody>
    </table>


	
			
		</div>
		</div>
	</div>
</div>