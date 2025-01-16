<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stripe Payment Gateway</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    </head>
    
    <body>
    
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                <img src="<?=base_url('assets/images/stripe_logo.png'); ?>" alt="" width="75" height="45" class="d-inline-block">
                Stripe Payment Gatway
                </a>
            </div>
        </nav> 

<div class="container pt-5">
	<div class="row">	


        <div class="col-md-4"></div>
        <div class="col-md-4">
            
            <div class="card">
                <h4 class="card-header bg-primary text-white">Stripe Payment Gateway</h4>
                <div class="card-body bg-light">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Oops!</strong>
                            <?php echo validation_errors() ;?> 
                        </div>  
                    <?php endif ?>
                    <div id="payment-errors"></div>  
                     <form method="post" id="paymentFrm" enctype="multipart/form-data" action="<?php echo base_url(); ?>stripe/check">
                        
                        <div class="mb-3">
                            <label for="cardHolderName" class="form-label">Card Holder Name</label>
                            <input type="text" name="name" class="form-control" id="cardHolderName" value="<?php echo set_value('name','puran'); ?>" required>
                        </div>  
                    
                        <div class="mb-3">
                            <label for="cardHolderEmail" class="form-label">Card Holder Email</label>
                            <input type="email" name="email" class="form-control" id="cardHolderEmail" value="<?php echo set_value('email','email@you.com'); ?>" required />
                        </div>

                        <div class="mb-3">
                            <label for="card_num" class="form-label">Card Number</label>
                            <input type="number" name="card_num" id="card_num" class="form-control" placeholder="Card Number" autocomplete="off" value="<?php echo set_value('card_num','4242424242424242'); ?>" required>
                        </div>
                       
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="card-expiry-month" class="form-label">Expiry Month</label>
                                            <input type="text" name="exp_month" maxlength="2" class="form-control" id="card-expiry-month" placeholder="MM" value="<?php echo set_value('exp_month','01'); ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="card-expiry-month" class="form-label">Expiry Year</label>
                                            <input type="text" name="exp_year" class="form-control" maxlength="4" id="card-expiry-year" placeholder="YYYY" required="" value="<?php echo set_value('exp_year','2023'); ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <label for="card-cvc" class="form-label">CVC</label>
                                    <input type="text" name="cvc" id="card-cvc" maxlength="3" class="form-control" autocomplete="off" placeholder="CVC" value="<?php echo set_value('cvc','012'); ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="amount" value="<?php echo $price; ?>"> 
                        <input type="hidden" name="tax" value="<?php echo $tax; ?>"> 
                        <input type='hidden' name='currency_code' value='USD'> 
                        <input type='hidden' name='item_name' value='<?php echo $name; ?>'> 
                        <input type='hidden' name='item_number' value='<?php echo $id; ?>'>
                        <input type='hidden' name='type' value='<?php echo $type; ?>'>
                        <input type='hidden' name='base_price' value='<?php echo $base_price; ?>'>
                        <input type='hidden' name='day' value='<?php echo $day; ?>'>
                        <input type='hidden' name='user_id' value='<?php echo $this->session->userdata('logged_in')['id']; ?>'>

                       

                        <div class="mb-3 float-end">
                            <!-- <button class="btn btn-secondary" type="reset">Reset</button> -->
                            <button type="submit" id="payBtn" class="btn btn-primary">Submit Payment</button>
                        </div>
                    </form>     
                </div>
            </div>
                 
        </div>
      <div class="col-md-4"></div>
       
    </div>
</div> 
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script> 
    //set your publishable key
    Stripe.setPublishableKey('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

    //callback to handle the response from stripe
    function stripeResponseHandler(status, response) {
        if (response.error) {
            //enable the submit button
            $('#payBtn').removeAttr("disabled");
            //display the errors on the form
            // $('#payment-errors').attr('hidden', 'false');
            $('#payment-errors').addClass('alert alert-danger');
            $("#payment-errors").html(response.error.message);
        } else {
            var form$ = $("#paymentFrm");
            //get token id
            var token = response['id'];
            //insert the token into the form
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            //submit form to the server
            form$.get(0).submit();
        }
    }
    $(document).ready(function() {
        //on form submit
        $("#paymentFrm").submit(function(event) {
            //disable the submit button to prevent repeated clicks
            $('#payBtn').attr("disabled", "disabled");
            
            //create single-use token to charge the user
            Stripe.createToken({
                number: $('#card_num').val(),
                cvc: $('#card-cvc').val(),
                exp_month: $('#card-expiry-month').val(),
                exp_year: $('#card-expiry-year').val()
            }, stripeResponseHandler);
            //submit from callback
            return false;
        });
    });
    </script>
   


   </body>
</html>