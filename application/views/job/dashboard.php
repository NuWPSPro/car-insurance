<?php $this->load->view('template/picture'); ?>

<div class="innerContent">
	<div class="container">
		
		<div class="row">
			<div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
			</div>
			<div class="col-sm-3 user-nav">
				<ul class="navlist">
					<li  class="active"><a href="#"><i class="fa fa-book"></i>Upload Job</a></li>
					<li ><a href="#"><i class="fa fa-list-ol"></i> Jobs Listing</a></li>
					<li ><a href="#"><i class="fa fa-list-ol"></i> Active Ads</a></li>
					<li ><a href="#"><i class="fa fa-list-ol"></i> Active Permotions</a></li>
					<li ><a href="#"><i class="fa fa-list-ol"></i> Purchase History </a></li>
					<li ><a href="#"><i class="fa fa-list-ol"></i> Notifications</a></li>
					<li ><a href="#"><i class="fa fa-list-ol"></i> Terms</a></li>
					<li ><a href="#"><i class="fa fa-list-ol"></i> Edit Profile</a></li>
				</ul>
			</div>

			<div class="col-sm-9">
				<h3 class="border-title text-left">Job Listing</h3>
				<!-- Job Listing Dashboard page Html start -->
				<div class="text-left">
					<p>Year :
						<select>
							<option>2018</option>
							<option>2017</option>
							<option>2016</option>
						</select>
					</p>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<th>No.</th>
							<th>Job Title</th>
							<th>Country</th>
							<th>Location</th>
							<th>Principal</th>
							<th>Job Order</th>
							<th>Expiration</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						<tr>
							<td>1.</td>
							<td>Hotel Mannager</td>
							<td>Dubai</td>
							<td>AI Bourje</td>
							<td>KSA Hotel</td>
							<td>#12345</td>
							<td>12-02-2019</td>
							<td>Enable</td>
							<td class="action">
								<a href="#" title="view"><i class="fa fa-eye"></i></a> 
								<a href="#" title="Download"><i class="fa fa-pencil-square"></i></a>
								<a href="#" title="Download"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
						<tr>
							<td>1.</td>
							<td>Hotel Mannager</td>
							<td>Dubai</td>
							<td>AI Bourje</td>
							<td>KSA Hotel</td>
							<td>#12345</td>
							<td>12-02-2019</td>
							<td>Enable</td>
							<td class="action">
								<a href="#" title="view"><i class="fa fa-eye"></i></a> 
								<a href="#" title="Download"><i class="fa fa-pencil-square"></i></a>
								<a href="#" title="Download"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
						<tr>
							<td>1.</td>
							<td>Hotel Mannager</td>
							<td>Dubai</td>
							<td>AI Bourje</td>
							<td>KSA Hotel</td>
							<td>#12345</td>
							<td>12-02-2019</td>
							<td>Enable</td>
							<td class="action">
								<a href="#" title="view"><i class="fa fa-eye"></i></a> 
								<a href="#" title="Download"><i class="fa fa-pencil-square"></i></a>
								<a href="#" title="Download"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
						<tr>
							<td>1.</td>
							<td>Hotel Mannager</td>
							<td>Dubai</td>
							<td>AI Bourje</td>
							<td>KSA Hotel</td>
							<td>#12345</td>
							<td>12-02-2019</td>
							<td>Enable</td>
							<td class="action">
								<a href="#" title="view"><i class="fa fa-eye"></i></a> 
								<a href="#" title="Download"><i class="fa fa-pencil-square"></i></a>
								<a href="#" title="Download"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
						<tr>
							<td>1.</td>
							<td>Hotel Mannager</td>
							<td>Dubai</td>
							<td>AI Bourje</td>
							<td>KSA Hotel</td>
							<td>#12345</td>
							<td>12-02-2019</td>
							<td>Enable</td>
							<td class="action">
								<a href="#" title="view"><i class="fa fa-eye"></i></a> 
								<a href="#" title="Download"><i class="fa fa-pencil-square"></i></a>
								<a href="#" title="Download"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					</table>
				</div>
				<!-- Job Listing Dashboard page Html End -->

				<!-- Job over view page Html start -->
				<div class="step-wise-query provider-overview">
                    <ul class="nav-tabs hidden-xs">
                        <li class="active"><a href="#">Overview</a></li>
                        <li><a href="#">Job Details</a></li>
                        <li><a href="#">Promotion</a></li>
                        <li><a href="#">Upload</a></li>
					</ul>
					<div class="tab-content steps-detail">
						<a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
						<div id="step1" class="tab-pane fade in active">
							<h3>Job Overview Field</h3>
							<form action="#" method="post" name="form1" id="form1">
								<div class="row">
									<div class="col-sm-12 form-group">
                                        <label>Job Title <sup>*</sup></label>
                                        <input type="text" class="form-control" name="course_title" id="course_title" value="">
									</div>
									<div class="col-sm-12 form-group">
                                        <label>Salary <sup>*</sup></label>
                                        <input type="text" class="form-control" name="course_title" id="course_title" value="">
									</div>
									<div class="col-sm-12 form-group">
                                        <label>Country <sup>*</sup></label>
                                        <input type="text" class="form-control" name="course_title" id="course_title" value="">
                                    </div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Job over view page Html End -->

			</div>

		</div>
	</div>
</div>