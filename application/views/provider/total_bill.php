<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
        <?php $this->load->view('provider/sidebar'); ?>
    <div class="col-sm-8">
        <h3 class="border-title text-left"><?php echo $training[0]['title'];?></h3>
                <h3 class="border-title text-left">Generate Certificate</h3>
        
        <div class="step-wise-query provider-overview">
            <?php echo $this->session->flashdata('response');
                        $tidd = $this->uri->segment(3); ?>
                                                                                                                

            <div class="modal-body">
                <?php 
                $uid    = $this->session->userdata('logged_in')['id'];
                $certId = $this->session->userdata('current_certificate_id');
                $udata  = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
				//print_r($udata);
                $certData  = $this->user->get_record_by_field_name_all_record('tbl_training_certificate','id',$certId); ?>

                <?php 
                $tid = $this->uri->segment(3);
                ?>
                 <ul class="nav-tabs hidden-xs">
                        <li><a href="<?php echo site_url()?>/provider/template/<?php echo $tid;?>">Template</a></li>
                        <li><a href="<?php echo site_url()?>/provider/recipients/<?php echo $tid;?>">Recipients</a></li>  
                        <li class="active"><a href="<?php echo site_url()?>/provider/total_bill/<?php echo $tid;?>">Total Bill</a></li>
                        <li><a href="<?php echo site_url()?>/provider/payment/<?php echo $tid;?>">Payment</a></li> 
                        <li><a href="<?php echo site_url()?>/provider/generate_certificate/<?php echo $tid;?>">Certificate</a></li> 
                    </ul>


                
                <?php 
				$training = $this->db->get_where('tbl_training',array('user_id'=> $uid ))->row_array();
                $purchased_plan = $this->user->get_record_by_field_name_all_record('tbl_template_plan','id',$udata[0]['template_plan']);
                $misc           = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
                
                   //$misc           = $this->user->get_record_by_field_name_all_record('tbl_training_certificate','id',1);

                   $arraydata = unserialize($certData[0]['customer_id']);
                   //print_r($arraydata);
				   if((count($arraydata)>100) && ($training['training_type']==1))
					{
						$feecertificate=100;
					}
					else
					{
						$feecertificate=0;
					}
                ?>
                <!-- <p style="font-weight: bold;">Price Template: $<?php echo $misc[0]['template_price'];?></p> -->
                <p style="font-weight: bold;">Price Per Certificate: $ <?php echo $misc[0]['price_certificate'];?></p>
                <p style="font-weight: bold;">Total Number of Certificate: <?php echo count($arraydata);?></p>
                <?php $total_price = $misc[0]['price_certificate'] * count($arraydata);?>
                <p style="font-weight: bold;">Total Certificate Price: $ <?php echo $total_price;?></p>
                <?php $addtax = (($total_price*10)/100);?>
                <p style="font-weight: bold;">Tax (10% Tax): $ <?php echo $addtax; ?></p>

                <p style="font-weight: bold;">Total Amount: $ <?php echo ( $addtax + $misc[0]['price_certificate'] * count($arraydata)) - $feecertificate; ?></p>
                           
        <?php if((count($arraydata)<=100) && ($training['training_type']==1))
                { ?>
                   <a href="<?php echo site_url()?>/provider/direct_create_certificate/<?php echo $tid;?>">   
        <?php   }else{ ?>
                    <a href="<?php echo site_url()?>/provider/payment/<?php echo $tid;?>">
        <?php   } ?>
                    <input type="button" name="next" value="PROCEED" class="btn btn-primary">
            </a>
            </div>

        </div>
    </div>
          
         
        </div>
    </div>
</div>
  


<script type="text/javascript">
function planchange(idd) {
    //alert(idd);

    $.ajax({
        type: "POST",
        url: '<?php echo base_url()."provider/setdefault";?>',
        data: { idd }
    }).done(function(result) {
        //alert(result);
        $("#filteredData2").html(result);
    });
    return false;


}
</script>
<script type="text/javascript">
function byplan(plan_id, tid, amount) {
    var item = plan_id + '_' + tid;
    $('#item_name').val(item);
    $('#amount').val(amount);
    document.getElementById("frmPayPal1").submit();
}
</script>
<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name" value="">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" id="amount" value="">
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url()?>/provider/cancel_provider_plan">
    <input type="hidden" name="return" value="<?php echo site_url()?>/provider/success_provider_plan">
</form>
<script type="text/javascript">
//document.getElementById("frmPayPal1").submit();
</script>