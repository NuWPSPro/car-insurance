<?php $this->load->view('template/picture'); ?>

<div class="innerContent professional-course_listpanal">
    <div class="container">
        <div class="row">
            <?php  $this->load->view('professional/sidebar');  ?>

            <div class="col-sm-9">
                    <div class="admin-titlebox">
                        <h3 class="border-title text-left">TRAINING/SEMINAR LISTING</h3>
                        <select name="catlist" id="catlist" class="form-control" onchange="filtercourse();">
                        <?php foreach ($category as $key => $value) { ?>
                            <option <?php if($this->uri->segment(3)==$value['id']){ echo "selected";} ?> value="<?php echo $value['id'];?>"><?php echo $value['cat_name'];?></option>
                        <?php } ?>
                        </select>
                    </div>  
                   
                <h4 class="border-title text-left">Latest Training List</h4>
                <hr>
                <?php if(!empty($latesttraining)){ ?>
                <div class="owl-carousel-12">
                <?php foreach ($latesttraining as $key => $value) {
                    $profession = $this->db->get_where('tbl_category',array('id'=>$value['category_id']))->row_array()['cat_name']; 
                    if($value['image']){
                        $image = ASSETS_URL.'images/uploads/'.$value['image'];
                    }else{
                        $image = ASSETS_URL.'images/uploads/no-image.png';
                    } ?>

                    <div class="course-item">
                        <div class="course-double">
                            <?php if ($value['paid_status'] == 2){ ?> <!-- Red corner on Training list -->
                            <div class="corner"></div>
                            <span class="corner-text">Featured</span>
                            <?php } ?>
                            <a class="training-image" href="<?php echo site_url('pages/training_details/').$value['id'];?>">
                                <img src="<?php echo $image; ?>" alt="<?php $value['title']; ?>">
                            </a>
                            <div class="dt-sc-course-details">
                                <h5><a href="<?php echo site_url('pages/training_details/').$value['id'];?>">
                                    <?php echo $value['title'];?></a>
                                </h5>
                                <div class="clear-line"></div>
                                    <ul class="course-meta">
                                        <li><i class="fa fa-calendar"></i>
                                            <?php echo $value['start_date'];?> @ <?php echo $value['start_time'];?></li>
                                    </ul>
                                    <ul class="course-meta pb-10">
                                        <li><i class="fa fa-map-marker"></i>
                                            <?php echo $value['location'];?></li>
                                    </ul>
                                <p>Profession : <?php echo $profession;?></p>
                                <p>CE Unit : <?php echo $value['units'];?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <?php } else{ echo'<div class="alert alert-info">No records found with your profession.</div>'; } ?> 

                <h4 class="border-title text-left">Featured Training List</h4>
                    <hr>    
                <?php if(!empty($featured)){ ?>
                <div class="owl-carousel-12">
                    <?php foreach ($featured as $key => $value) {
                        $profession = $this->db->get_where('tbl_category',array('id'=>$value['category_id']))->row_array()['cat_name']; 
                        if($value['image']){
                            $image = ASSETS_URL.'images/uploads/'.$value['image'];
                        }else{
                            $image = ASSETS_URL.'images/uploads/no-image.png';
                        } ?>

                        <div class="course-item">
                            <div class="course-double">
                                <?php if ($value['paid_status'] == 2){ ?> <!-- Red corner on Training list -->
                                <div class="corner"></div>
                                <span class="corner-text">Featured</span>
                                <?php } ?>
                                <a class="training-image" href="<?php echo site_url('pages/training_details/').$value['id'];?>">
                                    <img src="<?php echo $image; ?>" alt="<?php $value['title']; ?>">
                                </a>
                                <div class="dt-sc-course-details">
                                    <h5><a href="<?php echo site_url('pages/training_details/').$value['id'];?>">
                                        <?php echo $value['title'];?></a>
                                    </h5>
                                    <div class="clear-line"></div>
                                        <ul class="course-meta">
                                            <li><i class="fa fa-calendar"></i>
                                                <?php echo $value['start_date'];?> @ <?php echo $value['start_time'];?></li>
                                        </ul>
                                        <ul class="course-meta pb-10">
                                            <li><i class="fa fa-map-marker"></i>
                                                <?php echo $value['location'];?></li>
                                        </ul>
                                    <p>Profession : <?php echo $profession;?></p>
                                    <p>CE Unit : <?php echo $value['units'];?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                <?php }else{ echo'<div class="alert alert-info">Sorry no records found.</div>'; } ?>
    
        
                <h4 class="border-title text-left">Regular Listing</h4>
                <?php if(!empty($freetraining)){ ?>
                <div class="owl-carousel-12">
                    <?php foreach ($freetraining as $key => $value) {
                        $profession = $this->db->get_where('tbl_category',array('id'=>$value['category_id']))->row_array()['cat_name']; 
                        if($value['image']){
                            $image = ASSETS_URL.'images/uploads/'.$value['image'];
                        }else{
                            $image = ASSETS_URL.'images/uploads/no-image.png';
                        } ?>

                        <div class="course-item">
                            <div class="course-double">
                                <a class="training-image" href="<?php echo site_url('pages/training_details/').$value['id'];?>">
                                    <img src="<?php echo $image; ?>" alt="<?php $value['title']; ?>">
                                </a>
                                <div class="dt-sc-course-details">
                                    <h5><a href="<?php echo site_url('pages/training_details/').$value['id'];?>">
                                        <?php echo $value['title'];?></a>
                                    </h5>
                                    <div class="clear-line"></div>
                                        <ul class="course-meta">
                                            <li><i class="fa fa-calendar"></i>
                                                <?php echo $value['start_date'];?> @ <?php echo $value['start_time'];?></li>
                                        </ul>
                                        <ul class="course-meta pb-10">
                                            <li><i class="fa fa-map-marker"></i>
                                                <?php echo $value['location'];?></li>
                                        </ul>
                                    <p>Profession : <?php echo $profession;?></p>
                                    <p>CE Unit : <?php echo $value['units'];?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                <?php }else{ echo'<div class="alert alert-info">Sorry no records found.</div>'; } ?>

            </div> 
        </div>
    </div>
</div>
<a href="#" id="scroll" style="display: inline;"><span></span></a>

<script type="text/javascript">
        function filtercourse() {
            var catlistId = $('#catlist').val();
            var url = "<?php echo site_url('professional/training_list/');?>" + catlistId;
        //alert(url);
        window.location = url;
    }
    </script>