<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
	<div class="container">
		
		<div class="row">
		    <?php  $this->load->view('provider/sidebar');  ?>
		
            <div class="col-sm-9">
                <div class="clearfix">
                    <h3 class="border-title pull-left"> Edit Webpage</h3>
                    <a href="<?php echo base_url('share/viewprofile/').$userdata->id;?>" target="_blank" class="btn btn-info pull-right" >View Your Webpage</a> 
                </div>

                <?php echo $this->session->flashdata('response');?> 
                <?php echo validation_errors();?> 
                
                <form action="<?php echo BASE_URL.'provider/editCEPWebpage'; ?>" method="post" enctype="multipart/form-data">      
                    <div class="form-group">
                        <label>Photo Background <sup>*</sup> (e.g 1500px X 400px)</label>
                        <input type="file" class="form-control" name="image" id="image" value="">
                        <span class="error"></span>
                    </div>

                     <div class="form-group">
                        <label>Name<sup>*</sup></label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $userdata->name; ?>" required>
                        <span class="error"></span>
                    </div>


                    <div class="form-group">
                        <label>Enter Tagline<sup>*</sup></label>
                        <input type="text" class="form-control" name="tagline" id="tagline" value="<?php echo $userdata->tag_line; ?>" required>
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <input class="btn btn-success" value="UPDATE" type="submit" name="save">
                    </div>
                </form>	

                <div id="slider">
                    <div id="slider-container" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="item"><img src="<?php echo BASE_URL.'assets/images/uploads/'.$userdata->backimage; ?>" alt="Back-Image"></div>
                        
                        </div>
                        <ol class="carousel-indicators">
                            <li data-target="#slider-container" data-slide-to="0" class="active"></li>
                        
                        </ol>
                    </div>
                    <div id="slider-search-container">
                        <div class="slider-search">
                            <h2><?php echo $userdata->name; ?></h2>
                            <h4 style="font-style: normal;"><?php echo $userdata->tag_line; ?></h4>
                            
                            <a href="#" class="commonBttn bg-blue">online courses</a>
                            <a href="#"  class="commonBttn bg-white">training/seminars</a>
                        </div>
                    </div>
                </div>
		</div>
	</div>
</div>
</div>