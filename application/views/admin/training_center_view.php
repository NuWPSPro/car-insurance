<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
	<div class="container">
		
	
		<h2 class="border-title text-left">Dashboard</h2>
		<div class="row">

		<?php 
		//$this->load->view('admin/sidebar');
		?>	


	<div class="col-sm-12">


            <h3 class="border-title text-left">Training Center</h3>
            <div class="step-wise-query">
             <?php echo $this->session->flashdata('response');?> 
             <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                    <th>Title</th> 
                    <th>Start Date</th> 
                    <th>Start Time</th> 
                    <th>Location</th> 
                    <th>Speaker</th> 
                    <th>Price</th> 
                    <th>Contact Person</th> 
                    <th>Contact Phone</th> 
                    <th>Contact Email</th>
                    <th>CP Number</th>
            </tr>
        </thead>
        <tbody>
           <?php 
                foreach ($training as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $key+1; ?>.</td> 
                    <td><?php echo $value['title']; ?></td>     
                    <td><?php echo $value['start_date'].' - '.$value['end_date']; ?></td>  
                    <td><?php echo $value['start_time'].' - '.$value['end_time']; ?></td>  
                    <td><?php echo $value['location']; ?></td>  
                    <td><?php echo $value['speaker']; ?></td>  
                    <td><?php echo $value['price']; ?></td>  
                    <td><?php echo $value['contact_person']; ?></td>  
                    <td><?php echo $value['phone']; ?></td>  
                    <td><?php echo $value['email']; ?></td>  
                    <td><?php echo $value['cp_number']; ?></td>  
                                    
                                        
                </tr>
                <?php } ?>
            
        </tbody>
       
    </table>
             

             



            </div>  
          </div>
		 
 
		</div>
	</div>
</div>