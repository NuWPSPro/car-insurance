<div class="service-process">
<div class="container">
<h1 class="border-title text-center">Admin Status Report</h1>
<p class="text-center">Date: ____________ (today's date will automatically show here_</p>
<div class="row">
			<div class="col-sm-2 col-xs-4 counterNum" data="200">
				<div class="count-icon"><i class="fa fa-money"></i></div>
				<span class="number">332</span><h5> Today's Income</h5>
			</div>
			<div class="col-sm-2 col-xs-4 counterNum" data="9000">
				<div class="count-icon"><i class="fa fa-money"></i></div>
				<span class="number">1403</span><h5> Month Income</h5>
			</div>
			<div class="col-sm-2 col-xs-4 counterNum" data="9000">
				<div class="count-icon"><i class="fa fa-money"></i></div>
				<span class="number">60</span><h5> Year Income</h5>
			</div>
			<div class="col-sm-2 col-xs-4 counterNum" data="5000">
				<div class="count-icon"><i class="fa fa-group"></i></div>
				<span class="number">120</span><h5> Total Users</h5>
			</div>
			<div class="col-sm-2 col-xs-4 counterNum" data="500">
				<div class="count-icon"><i class="fa fa-book"></i></div>
				<span class="number">120</span><h5> Total Courses</h5>
			</div>
			<div class="col-sm-2 col-xs-4 counterNum" data="500">
				<div class="count-icon"><i class="fa fa-bank"></i></div>
				<span class="number">120</span><h5> Trng Cntrs</h5>
			</div>
		</div>
</div>
</div>

<div class="innerContent">
	<div class="container">
		
	
		<h2 class="border-title text-left">Dashboard</h2>
		<div class="row">

		<?php 
		$this->load->view('provider/sidebar');
		?>	

		 

	<div class="col-sm-8">
			<h3 class="border-title text-left">Create Course</h3>
			<div class="step-wise-query">
			<ul class="nav-tabs hidden-xs">
			<li class="active"><a data-toggle="tab" href="#step1">Overview</a></li>
			<li><a data-toggle="tab" href="#step2">Lessons</a></li>
			<li><a data-toggle="tab" href="#step3">Test</a></li>
			<li><a data-toggle="tab" href="#step4">Certificate</a></li>
			<li><a data-toggle="tab" href="#step5">Evaluation</a></li>
			<li><a data-toggle="tab" href="#step6">Promotion</a></li>
			<li><a data-toggle="tab" href="#step7">Upload/Save</a></li>
			</ul>
			<div class="tab-content steps-detail">
			<a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
			<div id="step1" class="tab-pane fade in active">
				<h3>Course Overview</h3>
				
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>First Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<label>Last Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group"><label>Role <sup>*</sup></label>
					<div class="selection-box">
					<select class="form-control">
						<option>Select</option>
					</select>
					</div>
				</div>
				<div class="form-group"><label>Email <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Phone <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Message <sup>*</sup></label>
					<textarea class="form-control"></textarea>
				</div>
				<div class="form-group"><label>Qualification <sup>*</sup></label>
					<div class="option-group">
					<label><input type="checkbox"> 10th</label>
					<label><input type="checkbox"> 12th (Intermediate)</label>
					<label><input type="checkbox"> B.Sc(IT)</label>
					<label><input type="checkbox"> M.Sc(IT)</label>
					<label><input type="checkbox"> 10th</label>
					</div>
				</div>
				<div class="form-group">
					<a href="javascript:void(0)" class="btn btn-primary btn-lg">Next <i class="fa fa-angle-right"></i></a>
				</div>
				
				
			</div>
			<a class="title-mobile" data-toggle="tab" href="#step2">Lessons</a>
			<div id="step2" class="tab-pane fade">
				<h3>Create Lessons</h3>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>First Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<label>Last Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group"><label>Role <sup>*</sup></label>
					<div class="selection-box">
					<select class="form-control">
						<option>Select</option>
					</select>
					</div>
				</div>
				<div class="form-group"><label>Email <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Phone <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Message <sup>*</sup></label>
					<textarea class="form-control"></textarea>
				</div>
				<div class="form-group">
					<a href="javascript:void(0)" class="btn btn-primary btn-lg">Next <i class="fa fa-angle-right"></i></a>
				</div>
				
			</div>
			<a class="title-mobile" data-toggle="tab" href="#step3">Test</a>
			<div id="step3" class="tab-pane fade">
				<h3>Test</h3>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>First Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<label>Last Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group"><label>Role <sup>*</sup></label>
					<div class="selection-box">
					<select class="form-control">
						<option>Select</option>
					</select>
					</div>
				</div>
				<div class="form-group"><label>Email <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Phone <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">
					<a href="javascript:void(0)" class="btn btn-primary btn-lg">Next <i class="fa fa-angle-right"></i></a>
				</div>
				
			</div>
			<a class="title-mobile" data-toggle="tab" href="#step4">Certificate</a>
			<div id="step4" class="tab-pane fade">
				<h3>Update Certificate</h3>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>First Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<label>Last Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group"><label>Role <sup>*</sup></label>
					<div class="selection-box">
					<select class="form-control">
						<option>Select</option>
					</select>
					</div>
				</div>
				<div class="form-group"><label>Email <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Phone <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">
					<a href="javascript:void(0)" class="btn btn-primary btn-lg">Next <i class="fa fa-angle-right"></i></a>
				</div>
				
			</div>
			<a class="title-mobile" data-toggle="tab" href="#step5">Evaluation</a>
			<div id="step5" class="tab-pane fade">
				<h3>Evaluation</h3>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>First Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<label>Last Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group"><label>Role <sup>*</sup></label>
					<div class="selection-box">
					<select class="form-control">
						<option>Select</option>
					</select>
					</div>
				</div>
				<div class="form-group"><label>Email <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Phone <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Message <sup>*</sup></label>
					<textarea class="form-control"></textarea>
				</div>
				<div class="form-group"><label>Qualification <sup>*</sup></label>
					<div class="option-group">
					<label><input type="checkbox"> 10th</label>
					<label><input type="checkbox"> 12th (Intermediate)</label>
					<label><input type="checkbox"> B.Sc(IT)</label>
					<label><input type="checkbox"> M.Sc(IT)</label>
					<label><input type="checkbox"> 10th</label>
					</div>
				</div>
				<div class="form-group">
					<a href="javascript:void(0)" class="btn btn-primary btn-lg">Next <i class="fa fa-angle-right"></i></a>
				</div>
				
			</div>
			<a class="title-mobile" data-toggle="tab" href="#step6">Promotion</a>
			<div id="step6" class="tab-pane fade">
				<h3>Promotion</h3>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>First Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<label>Last Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group"><label>Role <sup>*</sup></label>
					<div class="selection-box">
					<select class="form-control">
						<option>Select</option>
					</select>
					</div>
				</div>
				<div class="form-group"><label>Email <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Phone <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Message <sup>*</sup></label>
					<textarea class="form-control"></textarea>
				</div>
				<div class="form-group"><label>Qualification <sup>*</sup></label>
					<div class="option-group">
					<label><input type="checkbox"> 10th</label>
					<label><input type="checkbox"> 12th (Intermediate)</label>
					<label><input type="checkbox"> B.Sc(IT)</label>
					<label><input type="checkbox"> M.Sc(IT)</label>
					<label><input type="checkbox"> 10th</label>
					</div>
				</div>
				<div class="form-group">
					<a href="javascript:void(0)" class="btn btn-primary btn-lg">Next <i class="fa fa-angle-right"></i></a>
				</div>
				
			</div>
			<a class="title-mobile" data-toggle="tab" href="#step7">Upload/Save</a>
			<div id="step7" class="tab-pane fade">
				<h3>Upload/Save</h3>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>First Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<label>Last Name <sup>*</sup></label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group"><label>Role <sup>*</sup></label>
					<div class="selection-box">
					<select class="form-control">
						<option>Select</option>
					</select>
					</div>
				</div>
				<div class="form-group"><label>Email <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Phone <sup>*</sup></label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group"><label>Message <sup>*</sup></label>
					<textarea class="form-control"></textarea>
				</div>
				<div class="form-group"><label>Qualification <sup>*</sup></label>
					<div class="option-group">
					<label><input type="checkbox"> 10th</label>
					<label><input type="checkbox"> 12th (Intermediate)</label>
					<label><input type="checkbox"> B.Sc(IT)</label>
					<label><input type="checkbox"> M.Sc(IT)</label>
					<label><input type="checkbox"> 10th</label>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary btn-lg" value="Save">
				</div>
				
			</div>
			</div>
			</div>
			
			
		</div>
		
		</div>
	</div>
</div>