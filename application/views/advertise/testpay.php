<form action="<?php echo PAYAPAL_URL;?>" method="post" name="frmPayPal1" id="frmPayPal1">
<input type="hidden" name="business" value="abhijeetkuma-facilitator@gmail.com">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="item_name" value="products">
<input type="hidden" name="item_number" value="1">
<input type="hidden" name="userid" value="<?php echo $userid;?>">
<input type="hidden" name="amount" value="1">
<!--     
<input type="hidden" name="cpp_header_image" value="https://www.phpgang.com/wp-content/uploads/gang.jpg"> 
<input type="hidden" name="rm" value="2">
<input type="hidden" name="credits" value="510">
-->
<input type="text" name="rm" value="2">
<input type="hidden" name="no_shipping" value="0">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="handling" value="0">
<input type="text" name="cancel_return" value="<?php echo site_url("testpayment/add_advertise");?>">
<input type="text" name="return" value="<?php echo site_url("testpayment/success");?>">
<input type="submit" name="submit" value="submit">
<!--<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">-->
</form>