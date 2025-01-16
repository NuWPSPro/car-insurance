<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
	<div class="container">
	     <h2 class="border-title text-left">Dashboard</h2>
	<div class="row">

    		<?php 
    		$this->load->view('admin/sidebar');
            $this->load->view('admin/users_work');
    		?>	

		<!-- <div class="col-sm-8">
			<h3 class="border-title text-center">Advertisers Listing</h3> 
			 -->
                <?php 
                    echo $this->session->flashdata('response');
                    $profession = $this->uri->segment(3);
                ?>
	
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Profession</th>
                    <th>Country</th>
                    <!-- <th>Address</th> -->
                    <th>Email</th>
                    <th>Date Registered</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                 foreach ($users as $key => $value) {  

                 	if($value['role']==1){
                   	  $type = "Professional";
                 	}

                 	if($value['role']==2){
                   	  $type = "CPD Provider";
                 	}

                 	if($value['role']==3){
                   	  $type = "Placement Agencies";
                 	}

                 	if($value['role']==4){
                   	  $type = "Advertisers";
                 	}

                 	if($value['role']==10){
                   	  $type = "Admin";
                 	}

                 	if($value['status']==1){
                 		$stts = "Enabled";
                 		$color = "green";
                 	} else {
                 		$stts = "Disabled";
                 		$color = "red";
                 	}

                ?>
                <tr>
                    <td><?php echo $key+1;?></td> 
                    <td><?php echo $value['name'];?></td>
                    <td><?php echo $type;?></td> 
                    <td><?php echo $value['profession'];?></td> 
                    <td><?php echo $value['location'];?></td> 
                    <!-- <td><?php echo $value['address'];?></td>  -->
                    <td><?php echo $value['username_email'];?></td> 
                    <td><?php echo $value['added_on'];?></td> 

                    <td><a href="<?php echo BASE_URL.'admin/changestatus/'.$value['id'].'/'.$value['status'].''?>" style="color: <?php echo $color; ?>"><?php echo $stts;?></a></td> 
                    <td><a target="_blank" href="<?php echo site_url('users/profile/'.$value['id'].'');?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a> &nbsp;</td>
                </tr>
                <?php } ?>
                    
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>

			



<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#example').DataTable();
} );

function filtedata(){
    var profession = jQuery('#profession').val();
    var path = "<?php echo site_url();?>/admin/provider_isting/";
    window.location=path+profession;
}

function setval(){
    var profession =  "<?php echo urldecode($this->uri->segment(3));?>";
    jQuery('#profession').val(profession);

}
setval();

</script>


