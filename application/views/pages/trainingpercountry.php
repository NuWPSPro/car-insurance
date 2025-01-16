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

                <h3 class="border-title text-left">Featured (NURSING/Agraba/)</h3>

                <div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-2">
							<div class="course-item">
								<div class="course-double">
									<a href="http://ceonpoint.com/index.php/pages/course_details/1" class="course-image">
									<img src="http://ceonpoint.com/assets/images/uploads/IMG_1560995024.png" alt="">

									</a><div class="dt-sc-course-details"><a href="http://ceonpoint.com/index.php/pages/course_details/1">

										<div class="course-price">$235</div>

										</a><h5><a href="http://ceonpoint.com/index.php/pages/course_details/1"></a><a href="http://ceonpoint.com/index.php/pages/course_details/1" title="website development">website development</a></h5>

										<div class="clear-line"> </div>

										<p>By : Intensive Care Unit - Princess Margaret Hospital, Nassau Bahamas</p>

										<ul class="course-meta">
											<li><a href="http://ceonpoint.com/index.php/pages/course_details/1">Law</a></li>
											<li>4 Lessons</li>
										</ul>

										<div class="course-data">
											<div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units 1</div>
											<div class="post-ratings">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
											</div>
										</div>

									</div>

								</div>
							</div>
							<div class="course-item">
								<div class="course-double">
									<a href="http://ceonpoint.com/index.php/pages/course_details/1" class="course-image">
									<img src="http://ceonpoint.com/assets/images/uploads/IMG_1560995024.png" alt="">

									</a><div class="dt-sc-course-details"><a href="http://ceonpoint.com/index.php/pages/course_details/1">

										<div class="course-price">$235</div>

										</a><h5><a href="http://ceonpoint.com/index.php/pages/course_details/1"></a><a href="http://ceonpoint.com/index.php/pages/course_details/1" title="website development">website development</a></h5>

										<div class="clear-line"> </div>

										<p>By : Intensive Care Unit - Princess Margaret Hospital, Nassau Bahamas</p>

										<ul class="course-meta">
											<li><a href="http://ceonpoint.com/index.php/pages/course_details/1">Law</a></li>
											<li>4 Lessons</li>
										</ul>

										<div class="course-data">
											<div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units 1</div>
											<div class="post-ratings">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
											</div>
										</div>

									</div>

								</div>
							</div>
							<div class="course-item">
								<div class="course-double">
									<a href="http://ceonpoint.com/index.php/pages/course_details/1" class="course-image">
									<img src="http://ceonpoint.com/assets/images/uploads/IMG_1560995024.png" alt="">

									</a><div class="dt-sc-course-details"><a href="http://ceonpoint.com/index.php/pages/course_details/1">

										<div class="course-price">$235</div>

										</a><h5><a href="http://ceonpoint.com/index.php/pages/course_details/1"></a><a href="http://ceonpoint.com/index.php/pages/course_details/1" title="website development">website development</a></h5>

										<div class="clear-line"> </div>

										<p>By : Intensive Care Unit - Princess Margaret Hospital, Nassau Bahamas</p>

										<ul class="course-meta">
											<li><a href="http://ceonpoint.com/index.php/pages/course_details/1">Law</a></li>
											<li>4 Lessons</li>
										</ul>

										<div class="course-data">
											<div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units 1</div>
											<div class="post-ratings">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
											</div>
										</div>

									</div>

								</div>
							</div>
							<div class="course-item">
								<div class="course-double">
									<a href="http://ceonpoint.com/index.php/pages/course_details/1" class="course-image">
									<img src="http://ceonpoint.com/assets/images/uploads/IMG_1560995024.png" alt="">

									</a><div class="dt-sc-course-details"><a href="http://ceonpoint.com/index.php/pages/course_details/1">

										<div class="course-price">$235</div>

										</a><h5><a href="http://ceonpoint.com/index.php/pages/course_details/1"></a><a href="http://ceonpoint.com/index.php/pages/course_details/1" title="website development">website development</a></h5>

										<div class="clear-line"> </div>

										<p>By : Intensive Care Unit - Princess Margaret Hospital, Nassau Bahamas</p>

										<ul class="course-meta">
											<li><a href="http://ceonpoint.com/index.php/pages/course_details/1">Law</a></li>
											<li>4 Lessons</li>
										</ul>

										<div class="course-data">
											<div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units 1</div>
											<div class="post-ratings">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
											</div>
										</div>

									</div>

								</div>
							</div>
							<div class="course-item">
								<div class="course-double">
									<a href="http://ceonpoint.com/index.php/pages/course_details/1" class="course-image">
									<img src="http://ceonpoint.com/assets/images/uploads/IMG_1560995024.png" alt="">

									</a><div class="dt-sc-course-details"><a href="http://ceonpoint.com/index.php/pages/course_details/1">

										<div class="course-price">$235</div>

										</a><h5><a href="http://ceonpoint.com/index.php/pages/course_details/1"></a><a href="http://ceonpoint.com/index.php/pages/course_details/1" title="website development">website development</a></h5>

										<div class="clear-line"> </div>

										<p>By : Intensive Care Unit - Princess Margaret Hospital, Nassau Bahamas</p>

										<ul class="course-meta">
											<li><a href="http://ceonpoint.com/index.php/pages/course_details/1">Law</a></li>
											<li>4 Lessons</li>
										</ul>

										<div class="course-data">
											<div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units 1</div>
											<div class="post-ratings">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
											</div>
										</div>

									</div>

								</div>
							</div>
							<div class="course-item">
								<div class="course-double">
									<a href="http://ceonpoint.com/index.php/pages/course_details/1" class="course-image">
									<img src="http://ceonpoint.com/assets/images/uploads/IMG_1560995024.png" alt="">

									</a><div class="dt-sc-course-details"><a href="http://ceonpoint.com/index.php/pages/course_details/1">

										<div class="course-price">$235</div>

										</a><h5><a href="http://ceonpoint.com/index.php/pages/course_details/1"></a><a href="http://ceonpoint.com/index.php/pages/course_details/1" title="website development">website development</a></h5>

										<div class="clear-line"> </div>

										<p>By : Intensive Care Unit - Princess Margaret Hospital, Nassau Bahamas</p>

										<ul class="course-meta">
											<li><a href="http://ceonpoint.com/index.php/pages/course_details/1">Law</a></li>
											<li>4 Lessons</li>
										</ul>

										<div class="course-data">
											<div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units 1</div>
											<div class="post-ratings">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
												<i class="fa fa-star-o" aria-hidden="true"></i>
											</div>
										</div>

									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
                    <div class="col-md-12">
                        <h3 class="border-title text-left">Regular Listing</h3>
                        <div class="training-semi-slider-6 pagi-above">
                            <div class="item">
                                <div class="training-semi">
                                    <div class="new-training-box">
                                        <a href="#">
                                            <div class="training-box_overlay"></div>
                                            <div class="training-box-image">
                                                <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/instituion-1.png" alt="">
                                            </div>
                                            <div class="training-box-caption">
                                                <h5 class="training-box_title">CE Provider</h5>
                                                <div class="training-box_text">Address Here</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="training-semi">
                                    <div class="new-training-box">
                                        <a href="#">
                                            <div class="training-box_overlay"></div>
                                            <div class="training-box-image">
                                                <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/instituion-1.png" alt="">
                                            </div>
                                            <div class="training-box-caption">
                                                <h5 class="training-box_title">CE Provider</h5>
                                                <div class="training-box_text">Address Here</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="training-semi">
                                    <div class="new-training-box">
                                        <a href="#">
                                            <div class="training-box_overlay"></div>
                                            <div class="training-box-image">
                                                <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/instituion-1.png" alt="">
                                            </div>
                                            <div class="training-box-caption">
                                                <h5 class="training-box_title">CE Provider</h5>
                                                <div class="training-box_text">Address Here</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				

            </div>
            
            <?php  $this->load->view('pages/sidebar'); ?>
                    
			


		</div>
		

	</div>

</div>







