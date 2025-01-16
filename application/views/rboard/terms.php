<?php $this->load->view('rboard/picture'); ?>


 <div class="innerContent">
	<div class="container">
        <div class="row">
			<!-- left sidebar start -->
			<?php $this->load->view('rboard/sidebar'); ?>
			<!-- left sidebar end -->

            <!-- right main body start -->
			<div class="col-sm-8">
                <div class="card">
					<div class="card-header">
                        <h3 class="border-title text-left"><?=$terms['title'];?></h3>
                    </div>
					<div class="card-body">
                        <div style="height: 700px; overflow: auto;">
                            <?=$terms['discription'];?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
	</div>
</div>