<?php $this->load->view('template/search'); ?>
<div class="innerContent trainingoverview-panel">
    <div class="container">
        <div class="row">
            <?php echo $this->session->flashdata('response');?>
            <div class="col-md-8">

                <?php $this->load->view('template/trainingmenu'); ?>

                
               
                <h3 class="border-title text-left pull-left">Overview</h3>
                <div class="clear-line"></div>
                <div class="table-responsive">
                <table class="table table-bordered">

                     <tr>
                        <td><strong>Training Overview : </strong></td>
                        <td><?php echo $seminar[0]['description'];?></td>
                    </tr>

                    <tr>
                        <td><strong>Training Objectives : </strong></td>
                        <td><?php echo $seminar[0]['objectives'];?></td>
                    </tr>

                    <tr>
                        <td><strong>Participants : </strong></td>
                        <td><?php echo $seminar[0]['participants'];?></td>
                    </tr>

                    <tr>
                        <td><strong>Methodologies : </strong></td>
                        <td><?php echo $seminar[0]['methodologies'];?></td>
                    </tr>  


                    <tr>
                        <td><strong>Item to bring : </strong></td>
                        <td><?php echo $seminar[0]['item_to_bring'];?></td>
                    </tr>
                    
                </table> 
                </div>
              
            </div>
            <?php $this->load->view('pages/sidebar'); ?>
        </div>
    </div>
</div> 