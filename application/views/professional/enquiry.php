<?php $this->load->view('template/picture'); 
      $uname = $this->session->userdata('logged_in')['name']; 
      $uemail = $this->session->userdata('logged_in')['username']; ?>

<div class="innerContent professional-enquiry">
    <div class="container">
		    <div class="row">
           <!--  <div class="col-sm-12">
              <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
        <?php  $this->load->view('professional/sidebar');  ?> 
         <form action="<?php echo site_url();?>/professional/enquiry" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
        <?php  $this->load->view('shared/enquiry');  ?> 
        </form>
         
        </div>
    </div>
</div>
<a href="#" id="scroll" style="display: inline;"><span></span></a>










 