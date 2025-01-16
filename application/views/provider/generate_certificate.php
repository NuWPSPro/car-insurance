<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <?php $this->load->view('provider/sidebar'); ?>
            <div class="col-sm-8">
                <h3 class="border-title text-left"><?php echo $training[0]['title'];?></h3>
                <h3 class="border-title text-left">Generate Certificate </h3>
                <div class="step-wise-query provider-overview">
                    <?php echo $this->session->flashdata('response');?>
                      <div class="modal-body">
                <?php 
                $uid = $this->session->userdata('logged_in')['id'];
                $udata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
                //if($udata[0]['template_plan']==0){
                ?>

                <?php 
                $tid = $this->uri->segment(3);
                ?>
                 <ul class="nav-tabs hidden-xs">
                        <li><a href="<?php echo site_url()?>/provider/template/<?php echo $tid;?>">Template</a></li>
                        <li><a href="<?php echo site_url()?>/provider/recipients/<?php echo $tid;?>">Recipients</a></li>  
                        <li><a href="<?php echo site_url()?>/provider/total_bill/<?php echo $tid;?>">Total Bill</a></li>
                        <li><a href="<?php echo site_url()?>/provider/payment/<?php echo $tid;?>">Payment</a></li> 
                        <li class="active"><a href="<?php echo site_url()?>/provider/generate_certificate/<?php echo $tid;?>">Certificate</a></li> 
                    </ul>


                
                <?php 
                   $purchased_plan = $this->user->get_record_by_field_name_all_record('tbl_template_plan','id',$udata[0]['template_plan']);
                   $misc           = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
                ?>
                 


                <h3 class="border-title text-left pull-left">Generate Certificate <span style="font-size: 12px;">(Click individual button of each recipient to Generate Certificate)</span></h3>
                <div class="step-wise-query">
                    <?php //echo $this->session->flashdata('response');?>
                    <table id="example11" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr> 
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <!-- <th>Phone</th>  -->
                                <th>Status</th> 
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
            $certId    = $this->session->userdata('current_certificate_id');
            $certData  = $this->user->get_record_by_field_name_all_record('tbl_training_certificate','id',$certId);
            $custId    = unserialize($certData[0]['customer_id']);
            $datas = $this->user->get_record_by_field_name_all_record('tbl_training_book','training_seminar_id',$training[0]['id']); 
            $uid = $this->session->userdata('logged_in')['id'];
            if(!empty($custId)){
            $count = 1;
            foreach ($custId as $key => $value1) {
            $value = $this->user->get_record_by_field_name_all_record('tbl_training_book','id',$value1); ?>
                            <tr><td><?php echo $count; ?></td>
                                <td><?php echo $value[0]['name']; ?></td>
                                <td><?php echo $value[0]['email']; ?></td>
                           <!-- <td><?php echo $value[0]['phone']; ?></td> -->
                                <td><?php if($value[0]['certificate_id']==""){
                                                echo "Pending";
                                            } else {
                                            echo $value[0]['certificate_id'];
                                            } ?>
                                </td>
                                <td><a target="_blank" class="btn btn-info" href="<?php echo site_url('provider/mypdf/'.$uid.'/'.$value1);?>">Generate Certificate</a></td>
                            </tr>
                            <?php $count++; } }else{ echo '<tr><center>Sorry no records founds.</center></tr>'; } ?>
                        </tbody>
                    </table>
                </div>
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