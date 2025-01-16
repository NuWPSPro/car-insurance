<?php $this->load->view('template/search'); ?>
<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" id="amount">
    <input type="hidden" name="tax" value="10">
    <!--     <input type="hidden" name="cpp_header_image" value="https://www.phpgang.com/wp-content/uploads/gang.jpg"> -->
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="http://demo.phpgang.com/payment_with_paypal/cancel.php">
    <input type="hidden" name="return" value="<?php echo site_url()?>/pages/success">
    <!--  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"> -->
</form>

<!-- New html banner -->
<div class="banner banner-newpanel" style="background-image:url(http://wps-dev.com/dev/mycpd/assets/images/fullscreen-slider.jpg);">
    <div class="container">
        <div class="banner-center center">
            
            <h1>Find online Courses and training/conventions</h1>
            <p>Start adding units or contact hours in your list.</P>
        </div>
        <div class="header-searchPart">
            <form class="searchform">
                <div class="selection-box">
        
                    <select name="searchtype" class="form-control" id="dropDown" onchange="redirect();">
                    	<?php 
                    	$cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
                    	?>
                        <option value="" selected="">Find Courses: Choose Profession</option>
                    	<?php 
                    	foreach ($cat as $key => $value) {
                    	?>
                        
                           <option <?php if($value['id']==$this->uri->segment(3)){ echo "selected"; } ?> value="<?php echo $value['id']?>">
			                <?php echo $value['cat_name'];?>
			            </option>
			            
			            <?php 
			        	}
			            ?>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>
 


<?php  
if($this->uri->segment(2) != "courselist"){

 $this->load->view('pages/online_training');

} elseif ($this->uri->segment(2) != "traininglist") {

 $this->load->view('pages/online_course');

}
?>



<script type="text/javascript">
function paynow(id, amount) {



    $('#item_name').val(id);

    $('#amount').val(amount);

    document.getElementById("frmPayPal1").submit();

}
</script>