<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PayUMoney Gateway</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/js/bootstrap.min.js" /> -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- minified jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- minified Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>

<!-- Bootstrap 4 Navbar  -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	<a href="<?php echo base_url(); ?>" class="navbar-brand">PayUMoney Gateway</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
	<?php   $role = $this->session->userdata('logged_in')['role'];
			if($role==1){
				$redirect = 'professional/dashboard';
			}

			if($role==2){
				if($uins =='0'){
					$redirect = 'provider/overview';
				}else{
					$redirect = 'provider/set_target';
				}
			}

			if($role==3){
				$redirect = 'placement/dashboard';
			}

			if($role==4){
				$redirect = 'advertise/advertise';
			}

			if($role==5){
				$redirect = 'institution/settarget';
			}
			
			if($role==6){
				if($uins =='0'){
					$redirect = 'author/overview';
				}else{
					$redirect = 'author/course_listing';
				}
			}
			
			if($role==7){
				$redirect = 'rboard/subscription_package';
			} ?>
	<!-- <div class="collapse navbar-collapse" id="navbarsExampleDefault">

		<ul class="navbar-nav ml-auto">

			<li class="nav-item ">
				<a href="https://facebook.com/anburocky3" class="nav-link" target="_blank">#Developer</a>
			</li>

			<li class="nav-item">
				<a href="<?php echo base_url(); ?>Welcome/help" class="nav-link">Help Article</a>
			</li>

			<li class="nav-item">
				<a href="https://facebook.com/cdudenetworks" class="nav-link" target="_blank">Support</a>
			</li>

		</ul>

	</div> -->
	
</nav>
<!-- End Bootstrap 4 Navbar -->

	

<div class="container mt-5">
	<div class="row">
        <div class="col-md-2"></div>  
        <div class="col-md-8">
        	<div class="card">
        		<h4 class="card-header">Transaction <label for="Success" class="badge badge-success">Success</label></h4>
        		<div class="card-body">
        			<?php 
		                echo "<p>Thank You. Your order status is ". $status .".</br>";
		                echo "Your Transaction ID for this transaction is ".$txnid."</br>";
		                echo "We have received a payment of Rs. " . $amount . ". Your order  will dispatch soon.</p>";
		            ?>
					<a href="<?php echo base_url().$redirect; ?>" class="btn btn-primary"> Go to Dashboard</a>
        		</div>
        	</div>
            
         </div> 
        <div class="col-md-2">
			<?php unset($_SESSION['pay_array']); ?>
		</div>
    </div>
	<!-- Footer -->
	
	<footer style="position: absolute;bottom:0; width: 90%;">
		<hr>
		<p>Copyright &copy; <?php echo date('Y'); ?>  
			<span class="float-right">PayU Money</span></p>
	</footer>
</div> 

</body>
</html>