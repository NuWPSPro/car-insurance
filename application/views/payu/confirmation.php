<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>payu money</title>
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
	<a href="#" class="navbar-brand">PayUMoney Gateway</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

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
<?php //echo $udf6.'<br>'.$udf7; exit; ?>
	

<div class="container mt-5">
	<div class="row">
        <div class="col-md-2"></div>  
        <div class="col-md-8">
        	<div class="card">
        		<h5 class="card-header bg-success text-white">Checkout Confirmation</h5>
        		<div class="card-body">
        			<form action="<?php echo $action; ?>/_payment" method="post" id="payuForm" name="payuForm">
		                <input type="hidden" name="key" value="<?php echo $mkey; ?>" />
		                <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
		                <input type="hidden" name="txnid" value="<?php echo $tid; ?>" />
		                <input type="hidden" name="udf1" value="<?php echo $udf1; ?>" />
		                <input type="hidden" name="udf2" value="<?php echo $udf2; ?>" />
		                <input type="hidden" name="udf3" value="<?php echo $udf3; ?>" />
		                <input type="hidden" name="udf4" value="<?php echo $udf4; ?>" />
		                <input type="hidden" name="udf5" value="<?php echo $udf5; ?>" />
						<input type="hidden" name="country" value="<?php echo $udf6; ?>" />
						<?php if($udf7 != ''){ ?>
							<input type="hidden" name="zipcode" value="<?php echo $udf7; ?>" />
						<?php } ?>
		                <div class="form-group">
		                    <label class="control-label">Total Payable Amount</label>
		                    <input class="form-control" name="amount" value="<?php echo $amount; ?>"  readonly/>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Your Name</label>
		                    <input class="form-control" name="firstname" id="firstname" value="<?php echo $name; ?>" readonly/>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Email</label>
		                    <input class="form-control" name="email" id="email" value="<?php echo $mailid; ?>" readonly/>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Phone</label>
		                    <input class="form-control" name="phone" value="<?php echo $phoneno; ?>" readonly />
		                </div>
		                <div class="form-group">
		                    <label class="control-label"> Booking Info</label>
		                    <textarea class="form-control" name="productinfo" readonly><?php echo $productinfo; ?></textarea>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Address</label>
		                    <input class="form-control" name="address1" value="<?php echo $address; ?>" readonly/>     
		                </div>
		                <div class="form-group">
		                    <input name="surl" value="<?php echo $sucess; ?>" size="64" type="hidden" />
		                    <input name="furl" value="<?php echo $failure; ?>" size="64" type="hidden" />  
		                    <!--for test environment comment  service provider   -->
		                    <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
		                    <input name="curl" value="<?php echo $cancel; ?> " type="hidden" />
		                </div>
		                <div class="form-group float-right">
		                	<input type="submit" value="Pay Now" class="btn btn-success" />
		                </div>
		            </form> 
        		</div>
        	</div>
        	                                   
        </div>
        <div class="col-md-2"></div>
    </div>
	
	<!-- Footer -->
	<hr>
	<footer>
		<p>Copyright &copy; <?php echo date('Y'); ?>  
			<span class="float-right">PayU Money</span></p>
	</footer>
</div> 

</body>
</html>