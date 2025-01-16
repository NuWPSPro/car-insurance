<?php $this->load->view('template/picture_author'); ?>


 <div class="innerContent author-terms">
	<div class="container">
        <div class="row">
           <?php  $this->load->view('author/sidebar');  ?>  
           <div class="col-sm-9">
                <div style="height: 700px; overflow: auto;">
                    <h3 class="border-title text-left"><?=$terms['title'];?></h3>
                    <?=$terms['discription'];?>
                </div>
            </div>  
        </div>
	</div>
</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>