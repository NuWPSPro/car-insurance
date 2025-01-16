<?php $this->load->view('template/search'); ?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

<script type="text/javascript">

    $( document ).ready(function() {

        $("input").on("change", function() {

            this.setAttribute(

                "data-date",

                moment(this.value, "YYYY-MM-DD")

                .format( this.getAttribute("data-date-format") )

                )

        }).trigger("change")

    });

</script>





<div class="innerContent">

    <div class="container">

        <div class="row displayflex">

            <!-- New thumb slider Html Start 28.12.2018 -->
            <!-- <div class="col-md-12">
                 <div class="thumbSliders">
                    <div class="owl-carousel-thumslider">
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog15-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog16-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog17-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog17-420x295.jpg" alt=""></div>
                    </div>
                </div>
            </div> -->
            <!-- New thumb slider Html Start 28.12.2018 -->

            <div class="col-sm-8">

                <h3 class="border-title text-left">Latest Upload</h3>

                <div class="row">
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
                            <a href="#">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/prof4.png" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title">Name of Institution</h5>
                                    <div class="training-box_text">Address Here</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
                            <a href="#">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/prof3.png" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title">Name of Institution</h5>
                                    <div class="training-box_text">Address Here</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
                            <a href="#">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/prof-1.png" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title">Name of Institution</h5>
                                    <div class="training-box_text">Address Here</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
                            <a href="#">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/prof4.png" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title">Name of Institution</h5>
                                    <div class="training-box_text">Address Here</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
                            <a href="#">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/prof3.png" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title">Name of Institution</h5>
                                    <div class="training-box_text">Address Here</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
                            <a href="#">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/prof-1.png" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title">Name of Institution</h5>
                                    <div class="training-box_text">Address Here</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
               


            </div>
            
            <?php  $this->load->view('pages/sidebar'); ?>
                    



                </div>

            </div>

        </div>







