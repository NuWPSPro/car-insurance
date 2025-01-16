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


<section class="ce-tracker">
<div class="elementor-background-overlay"></div>
 <div class="contaner">
	 <div class="row">
		 <div class="col-md-6 offset-md-6">
	 <div class="elementor-widget-wrap">
		 <h2>CE Tracker</h2>
		 <p>Your online list of all your certificates from <br>
            online courses and training.</p>
		 <p>CE Units or Contact Hours automatically <br>
				sum up to keep you on track.</p>

		<div class="elementor-widget-button">
			<a href="#">UPLOAD CERTIFICATE</a>
			<a href="#" class="widget-button">SIGN-UP NOW!</a>
		</div>
	 </div>
	 </div>
	 </div>
 </div>
</section>

<section class="company-info">
	<div class="container">
		<div class="row">
			<div class="col-md-3 offset-md-3">
				<div class="elementor-column">
				<div class="elementor-icon-wrapper">
					<div class="elementor-icon">
					<i class="fa fa-graduation-cap" aria-hidden="true"></i>
					</div>
					</div>
				
				<div class="elementor-counter">
					<div class="elementor-counter-number-wrapper">
						<span data-duration="2000" data-to-value="100" data-delimiter=" ">100</span>
					</div>
							<div class="elementor-counter-title">PROFESSIONALS</div>
					</div>
					</div>
			</div>

			<div class="col-md-3">
				<div class="elementor-column">
				<div class="elementor-icon-wrapper">
					<div class="elementor-icon">
					<i class="fa fa-flag-checkered" aria-hidden="true"></i>
					</div>
					</div>
				
				<div class="elementor-counter">
					<div class="elementor-counter-number-wrapper">
						<span data-duration="2000" data-to-value="100" data-delimiter=" ">100</span>
					</div>
							<div class="elementor-counter-title">COUNTRIES</div>
					</div>
					</div>
			</div>

			<div class="col-md-3">
				<div class="elementor-column">
				<div class="elementor-icon-wrapper">
					<div class="elementor-icon">
					<i class="fa fa-certificate" aria-hidden="true"></i>
					</div>
					</div>
				
				<div class="elementor-counter">
					<div class="elementor-counter-number-wrapper">
						<span data-duration="2000" data-to-value="100" data-delimiter=" ">100</span>
					</div>
							<div class="elementor-counter-title">RECORDED CERTIFICATES</div>
					</div>
					</div>
			</div>
		</div>
	</div>

</section>

<section class="tracker-offers">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="tracker-offers-left">
					<h1>In 2 minutes :</h1>
					<p>Learn what <br>CE Tracker <br>offers for FREE<br>to all Professionals!</p>
					<i class="fa fa-thumbs-up" aria-hidden="true"></i>
				</div>
			</div>

			<div class="col-md-8">
			<div class="elementor-wrapper">
			<iframe class="elementor-video-iframe" allowfullscreen="" src="https://www.youtube.com/embed/XHOmBV4js_E?feature=oembed&amp;start&amp;end&amp;wmode=opaque&amp;loop=0&amp;controls=1&amp;mute=0&amp;rel=0&amp;modestbranding=0"></iframe>
			</div>
			</div>
			</div>
		</div>
	</div>
</section>

<section class="features-tracker">
<div class="elementor-background-overlay"></div>
<div class="container">
<div class="row">
	<div class="col-md-7">
		<div class="features-info-left">
		  <h2>Features of CE Tracker</h2>
		  <div class="elementor-icon-box-wrapper">
					<div class="elementor-icon-box-icon">
				<span class="elementor-icon elementor-animation-">
				<i class="fa fa-star" aria-hidden="true"></i>
				</span>
			</div>
				<div class="elementor-icon-box-content">
				<h3>
						It's FREE!
				</h3>
				<p>Get your own CE Tracker for FREE!</p>
			</div>
		</div>

		<div class="elementor-icon-box-wrapper">
					<div class="elementor-icon-box-icon">
				<span class="elementor-icon elementor-animation-">
				<i class="fa fa-star" aria-hidden="true"></i>
				</span>
			</div>
						<div class="elementor-icon-box-content">
				<h3 class="elementor-icon-box-title">
					<span>CE Status Board</span>
				</h3>
				<p class="elementor-icon-box-description">You can see your total CE Units or Contact hours against your required units/hours and your balance.  Your status will show if your are completed or on-completion.</p>
			</div>
		</div>

		<div class="elementor-icon-box-wrapper">
					<div class="elementor-icon-box-icon">
				<span class="elementor-icon elementor-animation-">
				<i class="fa fa-star" aria-hidden="true"></i>
				</span>
			</div>
						<div class="elementor-icon-box-content">
				<h3 class="elementor-icon-box-title">
					<span>Auto-summation of CE Units</span>
				</h3>
				<p class="elementor-icon-box-description">All your CE Units/contact hours will be added to show your total.</p>
			</div>
		</div>

		<div class="elementor-icon-box-wrapper">
					<div class="elementor-icon-box-icon">
				<span class="elementor-icon elementor-animation-">
				<i class="fa fa-star" aria-hidden="true"></i>
				</span>
			</div>
						<div class="elementor-icon-box-content">
				<h3 class="elementor-icon-box-title">
					<span>Auto-recording of Certificates from Online course &amp; Training</span>
				</h3>
				<p class="elementor-icon-box-description">All online courses taken at ceonpoint will automatically record to your account. Certificates from training issued using our digital certificates will also automatically recorded.</p>
			</div>
		</div>

		<div class="elementor-icon-box-wrapper">
					<div class="elementor-icon-box-icon">
				<span class="elementor-icon elementor-animation-">
				<i class="fa fa-star" aria-hidden="true"></i>
				</span>
			</div>
						<div class="elementor-icon-box-content">
				<h3 class="elementor-icon-box-title">
					<span>Upload manually your certificates</span>
				</h3>
				<p class="elementor-icon-box-description">Yes you can manually upload your certificates and it will be added to your list.</p>
			</div>
		</div>

		<div class="elementor-icon-box-wrapper">
					<div class="elementor-icon-box-icon">
				<span class="elementor-icon elementor-animation-">
				<i class="fa fa-star" aria-hidden="true"></i>
				</span>
			</div>
						<div class="elementor-icon-box-content">
				<h3 class="elementor-icon-box-title">
					<span>Notification of your License Renewal and more</span>
				</h3>
				<p class="elementor-icon-box-description">A reminder will be sent to your email and notification tab about your license renewal, performance appraisal, CE completion status, heart card renewal and more</p>
			</div>
		</div>
		</div>
	</div>

	<div class="col-md-5">
	<div class="elementor-widget-button px-0">
			<a href="#">UPLOAD <br> CERTIFICATE</a>
			<a href="#" class="widget-button">SIGN-UP <br> NOW!</a>
		</div>
	</div>
</div>
</div>

</section>





 








