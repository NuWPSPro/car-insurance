<?php $this->load->view('institution/picture'); ?>


 <div class="innerContent">
	<div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div>
            <?php  $this->load->view('institution/sidebar');  ?>  
            <div class="col-sm-9">
                <div style="height: 700px; overflow: auto;">
                    <h3 class="border-title text-left"><?=$terms['title'];?></h3>
                    <?=$terms['discription'];?>
                </div>
            </div> 
        </div>
	</div>
</div>