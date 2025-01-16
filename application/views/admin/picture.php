<div class="service-process admin-inner-banner">

<div class="container">

<h1 class="border-title text-center">Admin Status Report</h1>

<p class="text-center">Date: <?php echo date("jS F, Y", strtotime(date('Y-m-d'))); ?></p>

<div class="row">

	<?php 
		$total_total = 0;  $today_total = 0;  $month_total = 0;  $year_total  = 0; 
		$totalCourse 	= $this->db->get('tbl_course')->result_array();
		$tbl_training 	= $this->db->get('tbl_training')->result_array();
		$tbl_user 		= $this->db->where('role !=',10)->get('tbl_user')->result_array();
		$uid         	= $this->session->userdata('logged_in')['id'];
		/* $totalIncome = $this->user->get_report_admin('total',$uid);
		$todayIncome = $this->user->get_report_admin('today',$uid);
		$monthIncome = $this->user->get_report_admin('month',$uid);
		$yearIncome  = $this->user->get_report_admin('year',$uid); */
		
		$totalIncome = $this->user->dashboard_income_report('total',''); 
		$todayIncome = $this->user->dashboard_income_report('today','');
		$monthIncome = $this->user->dashboard_income_report('month','');
		$yearIncome  = $this->user->dashboard_income_report('year','');

		$totalTax = $this->user->dashboard_income_tax('total',''); 
		$todayTax = $this->user->dashboard_income_tax('today','');
		$monthTax = $this->user->dashboard_income_tax('month','');
		$yearTax  = $this->user->dashboard_income_tax('year','');
		// $total_tax = $totalTax + ($totalIncome*5)/100; 
		// $total_tax = $todayTax + ($todayIncome*5)/100; 
		// $total_tax = $monthTax + ($monthIncome*5)/100;  
		// $total_tax  = $yearTax + ($yearIncome*5)/100;  
		$total_total = number_format(floatval($totalIncome),2); 
		$today_total = number_format(floatval($todayIncome),2); 
		$month_total = number_format(floatval($monthIncome),2);  
		$year_total  = number_format(floatval($yearIncome),2);  


		$net_total_total = number_format(floatval($totalIncome - $totalTax),2); 
		$net_today_total = number_format(floatval($todayIncome - $todayTax),2); 
		$net_month_total = number_format(floatval($monthIncome - $monthTax),2);  
		$net_year_total  = number_format(floatval($yearIncome -  $yearTax),2);  	

		/* foreach ($totalIncome as $key => $value) {
			$amt = $value['amount'] * $value['quantity'];
			$total_total = $total_total + $amt;
		}
		foreach ($monthIncome as $key => $value) {
			$amt = $value['amount'] * $value['quantity'];
			$month_total = $month_total + $amt;
		}
		foreach ($yearIncome as $key => $value) {
			$amt = $value['amount'] * $value['quantity'];
			$year_total = $year_total + $amt;
		}
		foreach ($todayIncome as $key => $value) {
			$amt = $value['amount'] * $value['quantity'];
			$today_total = $today_total + $amt;
		} */
	?>

			<div class="col-sm-3 col-xs-6 counterNum" data="<?php echo $today_total;?>">

				<div class="count-icon"><i class="fa fa-usd" aria-hidden="true"></i></div>

				<span style="font-size:30px;"><?php echo $today_total;?></span><h5> Today's Income</h5>

			</div>

			<div class="col-sm-3 col-xs-6 counterNum" data="<?php echo $month_total;?>">

				<div class="count-icon"><i class="fa fa-usd" aria-hidden="true"></i></div>

				<span style="font-size:30px;"><?php echo $month_total;?></span><h5> Month Income</h5>

			</div>

			<div class="col-sm-3 col-xs-6 counterNum" data="<?php echo $year_total;?>">

				<div class="count-icon"><i class="fa fa-usd" aria-hidden="true"></i></div>

				<span style="font-size:30px;"><?php echo $year_total;?></span><h5> Year Income</h5>

			</div>

			<div class="col-sm-3 col-xs-6 counterNum" data="<?php echo $total_total;?>">

				<div class="count-icon"><i class="fa fa-usd" aria-hidden="true"></i></div>
				
				<span style="font-size:30px;"><?php echo $total_total;?></span><h5>Lifetime Income</h5>

			</div>

			<div class="col-sm-3 col-xs-6 counterNum" data="<?php echo $net_today_total; ?>">

				<div class="count-icon"><i class="fa fa-usd" aria-hidden="true"></i></div>

				<span style="font-size:30px;"><?php echo $net_today_total; ?></span><h5>Net Today Income</h5>

			</div>



			<div class="col-sm-3 col-xs-6 counterNum" data="<?php echo $net_month_total; ?>">

				<div class="count-icon"><i class="fa fa-usd" aria-hidden="true"></i></div>

				<span style="font-size:30px;"><?php echo $net_month_total; ?></span><h5>Net Month Income</h5>

			</div>

			<div class="col-sm-3 col-xs-6 counterNum" data="<?php echo $net_year_total; ?>">

				<div class="count-icon"><i class="fa fa-usd" aria-hidden="true"></i></div>

				<span style="font-size:30px;"><?php echo $net_year_total; ?></span><h5>Net Year Income</h5>

			</div>

			<div class="col-sm-3 col-xs-6 counterNum" data="<?php echo $net_total_total;?>">

				<div class="count-icon"><i class="fa fa-usd" aria-hidden="true"></i></div>

				<span style="font-size:30px;"><?php echo $net_total_total;?></span><h5>Net Lifetime Income</h5>

			</div>

		</div>

</div>

</div>