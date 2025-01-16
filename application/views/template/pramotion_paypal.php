<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">

    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">

    <input type="hidden" name="cmd" value="_xclick">

    <input type="hidden" name="item_name" id="item_name">

    <input type="hidden" name="item_number" id="item_number" value="">

    <input type="hidden" name="credits" value="510">

    <input type="hidden" name="userid" value="1">

    <input type="hidden" name="amount" id="amount">

    <!--     <input type="hidden" name="cpp_header_image" value="https://www.phpgang.com/wp-content/uploads/gang.jpg"> -->

    <input type='hidden' name='rm' value='2'>

    <input type="hidden" name="no_shipping" value="1">

    <input type="hidden" name="currency_code" value="USD">

    <input type="hidden" name="handling" value="0">

    <input type="hidden" name="cancel_return" value="<?php echo site_url()?>/provider/training_center_list">

    <input type="hidden" name="return" value="<?php echo site_url()?>/provider/training_promote_success">

    

</form>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );

function traning_setprice(day)
    {
        var dailprice='<?php echo $dailprice; ?>';
        
        var totalprice=dailprice*day;
        if(day)         
            {
             jQuery('#traning_pricehtml').html('$'+totalprice+' Pay Now');
            }else
            {
                jQuery('#traning_pricehtml').html('');
            }
        
    }
    function traning_submitform()
    {
        jQuery('#traning_payformdaily').submit();
    }
 function promotoTraining(training_id)
 {
     jQuery('#item_number').val(training_id);
     
     jQuery('#training_id').val(training_id);

    $.ajax({
        type:"post",
        url:"<?php echo base_url('provider/training_center_list1'); ?>",
        data: {id:training_id},
        dataType: "json",

        success:function(respons)
        {
        // alert(respons.title);
        $('#titlepro').html(respons.title);
        // $('#imagepro').html(respons.image);
    }
    });
     // return val(training_id);
 } 
 
  function paynow(){
     var dailprice='<?php echo $dailprice; ?>'; 
     var day=jQuery('#traning_day').val();  
     var totalprice=dailprice*day;
     jQuery('#amount').val(totalprice);  
     var item_name='2-'+day;     
     $('#item_name').val(item_name);  
     document.getElementById("frmPayPal1").submit();

   }
</script>