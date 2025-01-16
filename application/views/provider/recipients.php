<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
           <?php $this->load->view('provider/sidebar'); ?>
            <div class="col-sm-8">
                <h3 class="border-title text-left"><?php echo $training[0]['title'];?></h3>
                <h3 class="border-title text-left">Generate Certificate</h3>
                    
                <div class="step-wise-query provider-overview">
                    <?php echo $this->session->flashdata('response');?>
                    <div class="modal-body">
                    <?php $uid = $this->session->userdata('logged_in')['id'];
                          $udata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
                          $tid = $this->uri->segment(3);
                        ?>
                    <ul class="nav-tabs hidden-xs">
                        <li><a href="<?php echo site_url('provider/template/').$tid;?>">Template</a></li>
                        <li class="active"><a href="<?php echo site_url('provider/recipients/').$tid;?>">Recipients</a></li>  
                        <li><a href="<?php echo site_url('provider/total_bill/').$tid;?>">Total Bill</a></li>
                        <li><a href="<?php echo site_url('provider/payment/').$tid;?>">Payment</a></li> 
                        <li><a href="<?php echo site_url('provider/generate_certificate/').$tid;?>">Certificate</a></li> 
                    </ul>
                <?php 
                $purchased_plan = $this->user->get_record_by_field_name_all_record('tbl_template_plan','id',$udata[0]['template_plan']);
                $misc       = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);?>
                <!-- <p style="font-weight: bold;">Price Per Certificate: <input type="button" name="next" value="$<?php echo $misc[0]['price_certificate'];?>" class="btn btn-primary"></p> -->

                 




                <?php 
                $idd = $this->uri->segment(3);
                ?>
                <form action="<?php echo site_url('provider/total_bill/'.$idd.'');?>" method="post" name="frm" id="frm">
                <div class="col-sm-12">
                <!-- <a href="javascript:void(0)" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createcertificate">Create Certificate</a> -->
                <p style="font-weight: bold;"> Total Participants Selected: <span id="totalchecked"></span></p>
                <?php 
                $tid = $this->uri->segment(3);
                ?>
                 
                
                <p><span style="font-size: 12px;">You have 50 certificate free from the PRO version Package.</span></p>
                <h3 class="border-title text-left pull-left">Participants <span style="font-size: 12px;">(Check number of participants who will be the Recipients of Training Certificate)</span></h3>

                <div class="step-wise-query">

                    <?php echo $this->session->flashdata('response');?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="selectall" value="<?php echo $value['id']; ?>" id="ckbCheckAll"></th>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                               <!--  <th>Phone</th>  -->
                            </tr>
                        </thead>
                        <tbody>
            <?php   //echo $training[0]['id'];
           $datas = $this->user->get_reciepient($training[0]['id']); 
           $count = 1;
           foreach ($datas as $key => $value) {  ?>
                        <tr>
                            <td><input class="checkBoxClass" type="checkbox" name="checked[]" onclick="myFunction()" value="<?php echo $value['id']; ?>"></td>
                            <td>
                                <?php echo $count; ?>
                            </td>
                            <td>
                                <?php echo $value['name']; ?>
                            </td>
                            <td>
                                <?php echo $value['email']; ?>
                            </td>
                          <!--   <td>
                                <?php //echo $value['phone']; ?>
                            </td> -->
                        </tr>
                <?php $count++; } ?>       
                        </tbody>
                    </table>
           <!--      <?php if(empty($datas)){ ?>
                        <p>Sorry no records founds.</p>
                <?php }  ?> -->

         <!-- <a href="<?php //echo site_url()?>/provider/total_bill/<?php //echo $tid;?>"> -->
            <input type="button" name="next" value="NEXT" class="btn btn-primary" onclick="saveform();">
            <!-- </a> -->

                </div>
            </div>
</form>


<script type="text/javascript">
    function saveform(){
        var totalchecked = $('.checkBoxClass:checkbox:checked').length;
        if(totalchecked == 0){
            alert("Please select atleast one participants.");
        } else {
            document.getElementById('frm').submit();
        }
       
    }


function myFunction() {
  var checkBox = $('.checkBoxClass:checkbox:checked').length;
  $('#totalchecked').html(checkBox);
  // alert(checkBox);
}
</script>               
 
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
  


<script type="text/javascript">
    $("#ckbCheckAll").click(function () {
    $(".checkBoxClass").prop('checked', $(this).prop('checked'));
});
</script>



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