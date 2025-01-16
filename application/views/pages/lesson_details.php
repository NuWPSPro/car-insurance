<?php $this->load->view('template/search'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <ul class="page-nav">
                    <?php $idd = $this->uri->segment(3);?>
                    <li><a href="<?php echo site_url('pages/course_details/'.$idd.'');?>">Overview</a></li>
                    <li class="active"><a href="<?php echo site_url('pages/lesson/'.$idd.'');?>">Lesson </a></li>
                    <li><a href="<?php echo site_url('pages/evaluation/'.$idd.'');?>">Evaluation </a></li>
                    <li><a href="<?php echo site_url('pages/exam/'.$idd.'');?>">Exam </a></li>
                    <li><a href="<?php echo site_url('pages/certificate/'.$idd.'');?>">Certificate</a></li>
                </ul>
                <div class="lesson-wrapper">
                    <h3 class="border-title text-left"> Lesson</h3>
                    <ol class="lessons-list">
                        <?php 

                         foreach ($lesson as $key => $value) {

                        

                        ?>
                        <li>
                            <h2> <a href="<?php echo site_url('pages/lesson_details/'.$value['id'].'');?>"><?php echo $value['lesson_title'];?></a> </h2>
                            <div class="lesson-metadata">
                                <p> <i class="fa fa-clock-o"> </i>30 mins</p>
                                <p> <i class="fa fa-user"> </i><a href="#">Damie Glendell</a></p>
                            </div>
                            <div class="lesson-details">
                                <p>Description</p>
                                <p>
                                    <?php echo $value['lesson_content'];?>
                                </p>
                                <p>Case Study</p>
                                <p>
                                    <?php echo $value['case_study'];?>
                                </p>
                                <p>Summary</p>
                                <p>
                                    <?php echo $value['summary'];?>
                                </p>
                            </div>
                        </li>
                        <?php 

                        }

                       ?>
                    </ol>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="sidebar-box">
                    <h3 class="border-title text-left">Top Rated Courses</h3>
                    <ul class="rated-product">
                        <li>
                            <div class="thumb"><a href="#"><img src="<?php echo ASSETS_URL?>images/light-book.jpg" alt=""></a></div>
                            <h5><a href="#">Security Systems</a></h5>
                            <div class="rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <strong>$20.00</strong>
                        </li>
                        <li>
                            <div class="thumb"><a href="#"><img src="<?php echo ASSETS_URL?>images/light-book.jpg" alt=""></a></div>
                            <h5><a href="#">Security Systems</a></h5>
                            <div class="rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <strong>$20.00</strong>
                        </li>
                        <li>
                            <div class="thumb"><a href="#"><img src="<?php echo ASSETS_URL?>images/light-book.jpg" alt=""></a></div>
                            <h5><a href="#">Security Systems</a></h5>
                            <div class="rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <strong>$20.00</strong>
                        </li>
                        <li>
                            <div class="thumb"><a href="#"><img src="<?php echo ASSETS_URL?>images/light-book.jpg" alt=""></a></div>
                            <h5><a href="#">Security Systems</a></h5>
                            <div class="rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <strong>$20.00</strong>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-box">
                    <h3 class="border-title text-left">Course Categories</h3>
                    <ul class="product-categories">
                        <li><a href="#">Accountancy</a></li>
                        <li><a href="#">Aeronautical Engineering</a></li>
                        <li><a href="#">Agriculture</a></li>
                        <li><a href="#">Agriculture &amp; Biosystems Eng.</a></li>
                        <li><a href="#">Architecture</a></li>
                        <li><a href="#">Chemical Engineering</a></li>
                        <li><a href="#">Chemical Laboratory Technician</a></li>
                        <li><a href="#">Chemist</a></li>
                        <li><a href="#">Civil Engineering</a></li>
                        <li><a href="#">Criminology</a></li>
                        <li><a href="#">Customs Borkers</a></li>
                    </ul>
                </div>
                <?php /*
                <div class="sidebar-box">
                    <h3 class="border-title text-left">Advertise</h3>
                    <div class="owl-carousel-1">
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog15-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog16-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog17-420x295.jpg" alt=""></div>
                    </div>
                </div>
                */ ?>
            </div>
        </div>
    </div>
</div>