<?php $this->load->view('template/picture'); ?>


 <div class="innerContent professional-terms">
	<div class="container">
        <div class="row">
            <?php  $this->load->view('professional/sidebar');  ?>  
            <div class="col-sm-9">
                <div style="height: 700px; overflow: auto;">
                    <h3 class="border-title text-left"><?=$terms['title'];?></h3>
                    <?=$terms['discription'];?>
                </div>
            </div> 
        </div>
	</div>
</div>
<a href="#" id="scroll" style="display: inline;"><span></span></a>