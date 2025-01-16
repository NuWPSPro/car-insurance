<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PayUMoney</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/bootstrap.min.js" /> -->
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

	

<div class="container">
	<div class="row">	
        <div class="col-md-8">
        	<h4 class="display-5">Product Information <span class="text-danger hidden-md-up" style="font-size: 15px;">* All fields are required</span></h4>
        	
            <form method="post" id="product_info" enctype="multipart/form-data" action="<?php echo base_url(); ?>payu/check">                                                                  
                <div class="form-group">  
				   <label for="">Payable Amount : <b>₹ <?php echo $_REQUEST['price']; ?></b></label>                    
				   <input type="hidden" step="0.1" name="payble_amount" id="payble_amount" class="form-control" value="<?php echo $_REQUEST['price']; ?>" placeholder="Enter Payble Amount" required />
				   <input type="hidden" step="0.1" name="payble_tax" id="payble_tax" value="<?php echo $_REQUEST['tax']; ?>">
                </div>
                <div class="form-group">
					<label for="">Product Name : <b><?php echo $_REQUEST['name']; ?></b></label>                    
                    <input type="hidden" name="product_info" id="product_info" class="form-control" value="<?php echo $_REQUEST['name']; ?>" Placeholder="Product info name" required />
				   <input type="hidden" name="type" id="type" value="<?php echo $_REQUEST['type']; ?>">
				   <input type="hidden" name="product_id" id="product_id" value="<?php echo $_REQUEST['id']; ?>">
                </div>
               <div class="form-group">  
					<label for="">Customer Name : <b><?php echo $this->session->userdata('logged_in')['name']; ?></b></label>                      
                  <input type="hidden"  name="customer_name" id="customer_name" class="form-control" value="<?php echo $this->session->userdata('logged_in')['name']; ?>" placeholder="Full Name (Only alphabets)" required/>
                  <input type="hidden"  name="user_id" id="user_id" value="<?php echo $this->session->userdata('logged_in')['id']; ?>"/>
				  <input type="hidden"  name="country" id="country" value="<?php echo $this->session->userdata('logged_in')['country']; ?>"/>
				  <?php if(isset($_REQUEST['profession'])){ ?>
					<input type="hidden"  name="profession" id="profession" value="<?=$_REQUEST['profession']?>"/>
				  <?php } ?>
				  <?php if(isset($_REQUEST['day'])){ ?>
					<input type="hidden"  name="day" id="day" value="<?=$_REQUEST['day']?>"/>
				  <?php } ?>
				  <?php if(isset($_REQUEST['planid'])){ ?>
					<input type="hidden"  name="planid" id="planid" value="<?=$_REQUEST['planid']?>"/>
				  <?php } ?>
				  
                </div>
                <div class="form-group">  
					<label for="">Customer Email : <b><?php echo $this->session->userdata('logged_in')['username']; ?></b></label>                                   
					<input type="hidden"  name="customer_email" id="customer_email" class="form-control" value="<?php echo $this->session->userdata('logged_in')['username']; ?>" placeholder="Email" required/>
                </div>
                <div class="form-group">                                   
					<input type="number"  name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number(10 digits)" required/>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="customer_address" id="customer_address" placeholder="Address" required></textarea>
                </div>
                <div class="form-group text-right">
                  <button type="submit" class="btn btn-success">Submit</button>
                  <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>                 
        </div>
        <!-- <div class="col-md-4">
        	<div class="card">
        		<h6 class="card-header bg-primary text-white">
        			Some Help?
        		</h6>
        		<div class="card-body">
        			<p>Get some real help by browsing these guide from offical source.</p>
        			<ol>
        				<li> <a href="https://www.payumoney.com/dev-guide/" target="_blank">PayUMoney Dev Guide</a> </li>
        				<li> <a href="https://www.payumoney.com/pdf/PayUMoney-Technical-Integration-Document.pdf" target="_blank">PayUMoney Integration Guide</a></li>

        			</ol>
        		</div>
        	</div>

        </div> -->
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