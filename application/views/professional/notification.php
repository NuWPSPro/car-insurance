<?php $this->load->view('template/picture'); 
    //   $institution = $this->session->userdata('logged_in')['under_insititution']; ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">


		<div class="col-sm-9">
			
        <?php echo $this->session->flashdata('response');?> 
            <h3 class="border-title text-left"><?=$body_heading; ?></h3>
			<?php  $this->load->view('shared/notification');  ?>  
		

 


		</div>
	</div>
</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>
