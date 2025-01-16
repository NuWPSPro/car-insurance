<?php $this->load->view('template/search'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {





    $("input").on("change", function() {

        this.setAttribute(

            "data-date",

            moment(this.value, "YYYY-MM-DD")

            .format(this.getAttribute("data-date-format"))

        )

    }).trigger("change")

});
</script>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="search-date">
                    <div class="date-box">
                        <a href="javascript:void(0);">

                            <i class="fa fa-calendar"></i>

                            <input type="text" class="input-calender datepicker" name="calendar" value="<?php echo date('Y-m-d');?>" id="calendar">

                        </a>
                    </div>
                    <div class="search-box">
                        <input type="button" class="btn btn-primary" name="search" value="SEARCH" onclick="searchdata()">
                    </div>
                </div>
                <h3 class="border-title text-left">Featured Training</h3>
                <?php 

if(empty($featured)){

?>
                <div class="alert alert-info">Sorry no featured records found!</div>
                <?php  

}

?>
                <?php 

         foreach ($featured as $key => $value) {

            //echo '<pre>'; print_r($value); die;

        ?>
                <div class="traning-seminar-wrap">
                    <div class="row course-item">
                        <div class="col-sm-4 course-image">
                            <a href="<?php echo site_url()?>/pages/training_details/<?php echo $value['id']?>"><img src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $value['image'];?>" alt=""></a>
                            <span class="badge-featured red">Featured</span>
                        </div>
                        <div class="col-sm-8">
                            <div class="splms-event-details">
                                <h3><a href="<?php echo site_url()?>/pages/training_details/<?php echo $value['id']?>"><?php echo $value['title'];?></a></h3>
                                <ul class="event-info-list">
                                    <li><i class="fa fa-calendar"></i>
                                        <?php echo $value['start_date'];?> @
                                        <?php echo $value['start_time'];?>
                                    </li>
                                    <li><i class="fa fa-map-marker"></i>
                                        <?php echo $value['location'];?>
                                    </li>
                                </ul>
                                <p>
                                    <?php echo substr($value['description'],0,150);?>...</p>
                            </div>
                        </div>
                    </div>
                </div>
        
                <?php } ?>
                <h3 class="border-title text-left">Free Training</h3>
                <?php 

if(empty($free)){

?>
                <div class="alert alert-info">Sorry no free records found!</div>
                <?php  

}

?>
<div class="training-semi-slider-6 pagi-above">
                <?php 

         foreach ($free as $key => $value) {

            //echo '<pre>'; print_r($value); die;

        ?>

            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="training-semi-slider-6 pagi-above">
                        <div class="item">
                            <div class="training-semi">
                                <div class="new-training-box">
                                    <a href="<?php echo site_url()?>/pages/training_details/<?php echo $value['id']?>">
                                        <div class="training-box_overlay"></div>
                                        <div class="training-box-image">
                                            <img src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $value['image'];?>" alt="">
                                        </div>
                                        <div class="training-box-caption">
                                            <h5 class="training-box_title"><?php echo $value['title'];?></h5>
                                            <div class="training-box_text"><?php echo substr($value['description'],0,50);?>...</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> -->












             
             
                <div class="item">
                    <div class="training-semi">
                        <div class="new-training-box">
                            <a href="<?php echo site_url()?>/pages/training_details/<?php echo $value['id']?>">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $value['image'];?>" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title"><?php echo $value['title'];?></h5>
                                    <div class="training-box_text"><?php echo substr($value['description'],0,50);?>...</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
           
               
                <?php } ?>
            </div>
            </div>
            <?php 

            $this->load->view('pages/sidebar');

            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
function searchdata() {

    var calendar = $('#calendar').val();

    var path = "<?php echo site_url('pages/training/');?>";

    window.location = path + calendar;

}
</script>