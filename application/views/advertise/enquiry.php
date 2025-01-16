<?php $this->load->view('advertise/advertise_head'); ?>
 <div class="innerContent">
	<div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div>
       <?php  $this->load->view('advertise/sidebar');  ?>  
        <form action="<?php echo site_url();?>/advertise/enquiry" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
        <?php  $this->load->view('shared/enquiry');  ?> 
        </form>      
   
    </div>
	</div>
	</div>








