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
            <div class="col-sm-9">
                <div class="search-date">
                    <div class="date-box">
                        <i class="fa fa-calendar"></i>
                        <input type="text" class="input-calender datepicker form-control" name="calendar" value="<?php echo date('Y-m-d');?>" id="calendar">
                    </div>
                    <div class="search-box">
                        <input type="button" class="btn btn-primary" name="search" value="SEARCH" onclick="searchdata()">
                    </div>
                </div>
                <div class="row training-list">
                <?php 
                 foreach ($seminar as $key => $value) {
                    //echo '<pre>'; print_r($value); die;
                ?>
                <div class="item col-xs-4 col-lg-4">
                    <div class="course-item">
                        <div class="course-double">
                            <a class="training-image" href="<?php echo site_url()?>/pages/training_details/<?php echo $value['id']?>"><img src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $value['image'];?>" alt=""></a>
                            <div class="dt-sc-course-details">
                                <!-- <div class="course-price">$50</div> -->
                                <h5><a href="<?php echo site_url()?>/pages/training_details/<?php echo $value['id']?>"><?php echo $value['title'];?></a></h5>
                                <div class="clear-line"></div>
                                <ul class="course-meta">
                                    <li><i class="fa fa-calendar"></i>
                                        <?php echo $value['start_date'];?> @
                                        <?php echo $value['start_time'];?></li>
                                    </ul>
                                    <ul class="course-meta pb-10">
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                        <?php echo $value['location'];?>
                                        </li>
                                </ul>
                                <p><?php echo substr($value['description'],0,150);?>...</p>
                                <!-- <div class="price-btn">
                                    <a href="http://mycpd.paritechsolutions.com/index.php/users">
                                        <input class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW" type="button">
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <?php } ?>
                <!-- <ul class="pagination pagination-lg">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">Last</a></li>
                </ul> -->
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