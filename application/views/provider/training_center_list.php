    <?php $this->load->view('template/picture_provider');
      $institution = $this->session->userdata('logged_in')['under_insititution']; 
      $dailyprices = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
      $trainingtax = $this->db->get_where('tbl_all_tax',array('id'=>2,'status'=>1))->row_array();
      $filter = $this->uri->segment(3); ?>

<div class="innerContent">
	<div class="container">
		<div class="row">
		<?php $this->load->view('provider/sidebar'); ?>	
     	<div class="col-sm-9">
			<h3 class="border-title text-left">Training Listing (<?php echo count($training); ?>)</h3>
            
            <a href="<?php echo site_url('provider/training_center_list'); ?>"><h3 style="margin: 0;" class="btn <?php if($filter == 0){ echo "btn-primary";} else {echo "btn-default";}?>">All</h3></a>
            <!-- <a href="<?php echo site_url('provider/training_center_list'); ?>"><h3 class="btn btn-primary <?php if($filter==''){ echo "active";}?>">ALL</h3></a> -->
            <a href="<?php echo site_url('provider/training_center_list'); ?>/2"><h3 style="margin: 0;" class="btn <?php if($filter==2){ echo "btn-primary";} else {echo "btn-default";} ?>">PUBLISHED</h3></a>
            <!-- <a href="<?php echo site_url('provider/training_center_list'); ?>/0"><h3 class="btn btn-primary <?php if($filter <= 0){ echo "btn-primary";} else {echo "btn-default";} ?>">PENDING FOR ACCREDITATION</h3></a> -->
            <a href="<?php echo site_url('provider/training_center_list'); ?>/3"><h3 style="margin: 0;" class="btn <?php if($filter== 3){ echo "btn-primary";} else {echo "btn-default";} ?>">SAVED ONLY</h3></a> 


			<div class="step-wise-query">
			<?php echo $this->session->flashdata('response');?> 
			    <div class="table-responsive">
			         <table id="training-list" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th> 
                                <th>Units</th> 
                                <th>Starting Date</th> 
                                <th>Ending Date</th>  
                                <th>Promotion Status</th> 
                                <th>Status</th> 
                                <th>Date Published</th>
                                <th>Category</th> 
                                <th title="Online Registration">Online Reg.</th> 
                                <th>Training PDF</th>
                                <th>Action</th> 
                            </tr>
                        </thead>

                    <tbody>
                        <?php foreach ($training as $key => $value) { ?>
                            <?php 
                                if($value['status']==1){
                                    $stts   = "Saved Only";
                                    $class  = "text-info";
                                }elseif($value['status']==0){
                                    $stts   = "Unpublished";
                                    $class  = "text-danger";
                                }elseif($value['status']==2){
                                    $stts   = "Published";
                                    $class  = "text-success";
                                }

                                if($value['training_type']>0){
                                    $training_type = "<span class='text-primary'>Pro Version</span>"; 
                                }else{
                                    $training_type = "<span class='text-info'>Free Version</span>"; 
                                }

                                if($value['paid_status']==2) { 
                                    $promostion = "<span class='text-primary'>Featured</span>";
                                }elseif($value['paid_status']==1) { 
                                    $promostion = "<span class='text-info'>Basic</span>";
                                }else{
                                    $promostion = "<span class='text-danger'>Pending</span>";
                                }

                                $encrypted_course_id = base64_encode($value['id']);
                                $datas = $this->db->get_where('tbl_training_book',array('training_seminar_id'=>$value['id']))->result_array();  ?>
                        <tr>
                            <td><?php echo $key+1; ?>.</td> 
                            <td><a style="color: blue;" target="_blank" 
                                href="<?php echo site_url('pages/training_details/'.$value['id'].'');?>">
                            <?php echo ucwords($value['title']); ?></a>
                            </td>
                            <td><?php echo $value['units']; ?></td>  
                            <td><?php echo $value['start_date']; ?></td>  
                            <td><?php echo $value['end_date']; ?></td> 
                            <td><?php echo $promostion; ?></td> 
                                <?php if($value['status']==2) {  ?>
                            <td><a onclick="return confirm('You need to publish it from edit section.')" href="javascript:void(0);" class="<?php echo $class;?>"><?php echo $stts; ?></a></td> 
                                <?php  }else{ ?>
                            <td><a onclick="return confirm('Are you sure, you want to change status?')" href="<?php echo site_url('provider/taining_status/'.$value['id'].'/'.$value['status'].'');?>" class="<?php echo $class;?>"><?php echo $stts; ?></a></td>  
                                <?php  } ?> 
                            <td><?php echo ($value['publish_date'] != '0000-00-00')?$value['publish_date']:'--'; ?></td>
                            <td><?php echo $training_type; ?></td>
                            <td class="text-center"><?php echo count($datas).'/'.$value['registration_limit'];?></td>
                            <td><?php if($value['training_pdf_url']!=''){ ?><a target="_blank" href="<?php echo $value['training_pdf_url'];?>">View PDF</a><?php }else{ echo 'no pdf found!'; } ?></td>
                            <td class="no-wrap">
                                <?php// if($value['status']==1 && $value['start_date'] < date('Y-m-d')){ ?>
                                <?php if(0){ ?>
                                    <a class="btn btn-info" title="View" href="<?php echo site_url('provider/training_view/'.$value['id'].'');?>"><i class="fa fa-eye"></i></a>
                                <?php } else{ ?>
                                    <!-- <a target="_blank" class="btn btn-info" title="View" href="<?php echo site_url('provider/training_center_view/'.$value['id'].'');?>"><i class="fa fa-eye"></i></a> -->
                                    <a class="btn btn-info" title="View" href="<?php echo site_url('provider/training_view/'.$value['id'].'');?>"><i class="fa fa-eye"></i></a>
                                <?php if($value['training_type'] > 0){?>
                                    <a class="btn btn-info"  href="<?php echo site_url('provider/training_center_pro/'.$value['id'].'');?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                <?php }else{ ?>
                                    <a class="btn btn-info"  href="<?php echo site_url('provider/training_center_free/'.$value['id'].'');?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                <?php } ?>

                                    <a class="btn btn-info" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/training_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a> 

                                    <?php if($institution != 1) { ?>
                                    <a href="javascript:void(0)" class="btn btn-info" title="Promote" onclick="promotoTraining('<?php echo $value['id']; ?>','<?php echo $value['title']; ?>')"><i class="fa fa-bullhorn"></i></a>
                                    <br>
                                    <a target="_blank" class="btn btn-info" title="Renew Course"  class="btn" href="<?php echo GOVT_URL;?>training/profile/<?php echo $encrypted_course_id;?>"><i class="fa fa-repeat" aria-hidden="true"></i></a>
                                    <?php } ?>
                                    <a href="javascript:void(0)" class="btn btn-info" title="Registration Limit" onclick="setLimit('<?php echo $value['id']; ?>','<?php echo $value['title']; ?>','<?php echo $value['registration_limit']; ?>')"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                                <?php } ?>
                                <!-- <a onclick="send_training_rboard('<?php echo $value['id'];?>')" href="javascript:void(0);" class="btn btn-info" title="Send to RBoard"><i class="fa fa-university"></i></a> -->
                               
                                <a href="<?php echo base_url('provider/get_training_pdf/').$value['id'];?>" class="btn btn-info" title="Upload PDF"><i class="fa fa-file-pdf-o"></i></a>
                                <a href="javascript:void(0);" data-value="<?php echo $value['id'];?>" class="btn btn-info pt-1 duplicateTraining" title="Duplicate Training"><i class="fa fa-files-o"></i></a>
                            </td> 
                        </tr>
                        <?php } ?>
                    </tbody>
		          </table>
				</div>
			 </div>

		  </div>
		</div>
	</div>
  </div>

    <!-- Modal -->
    <div id="promotoTrainingModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Promote Your Training</h4>
                </div>
                <?php   $uid    = $this->session->userdata('logged_in')['id'];
                        $uname  = $this->session->userdata('logged_in')['name'];
                        $user   = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid); ?>

                <div class="modal-body promatecompany">
                    <div class="author-thumb">
                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$user[0]['image']; ?>" 
                        alt="Attach Logo">
                    </div>

                    <form class="payform" id="traning_payformdaily" action="<?php echo site_url('provider/dailypromotetraining');?>" method="post" enctype="multipart/form-data" >
    				<?php	
                        $priceWithTax   = $trainingtax['total_amount'];   
                        $dailprice      = $trainingtax['base_price'];	
                        $tax            = $trainingtax['tax_amount']; 
                    ?>
    				<input type="hidden" id="traning_dailyprice" name="traning_dailyprice" value="<?php echo $priceWithTax; ?>">
                    <input type="hidden" id="training_id" name="training_id" value=""> 
                    <div class="form-control"><a href="#">$<?php echo $priceWithTax; ?>/day</a></div>
                    <select class="form-control" id="traning_day" name="traning_day" onchange="traning_setprice(this.value)">
                        <?php for($i=1; $i<=31;$i++){ ?>
    						<option value="<?php echo $i; ?>"><?php echo $i; ?> Day</option>
    					<?php } ?>
                    </select>
                    <div class="form-control">
                        <a href="javascript:void(0)" onclick="submitTrainingForm()" id="traning_pricehtml">$<?php echo $priceWithTax; ?> Pay Now</a>
                    </div>
                    </form>
                        
                    <div class="clearfix"></div>
                    <h5>Featured</h5>
                    <p><?php echo $trainingtax['text'];?></p>
                    <p><img src="<?php echo ASSETS_URL.'images/uploads/'.$trainingtax['image']; ?>"></p>
                    
                </div>
            </div>
        </div>
    </div>

    <div id="Trainingpayby" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Choose Payment Option</h4>
            </div>
            <div class="modal-body"> 
              <a href="javascript:void(0)" onclick="trapromotionbypaypal();" class="btn" role="button"><img src="<?=base_url('assets/images/paypallogo.png') ?>" style="height:40px; width:100px;"></a>
               <a href="javascript:void(0)" onclick="trapromotionbystrip();" class="btn" role="button"><img src="<?=base_url('assets/images/OIP.jpg') ?>" style="height:40px; width:100px;"></a>
               <a href="javascript:void(0)" onclick="trapromotionbypayu();" class="btn" role="button"><img src="<?=base_url('assets/images/payu.jpg') ?>" style="height:40px; width:100px;"></a>
            </div>
          </div>
        </div>
    </div>

    <div id="set_limit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Set Training Registraion Limit</h4>
            </div>
            <?php echo form_open('provider/set_registration_limit'); ?>
            <div class="modal-body"> 
                <p>
                    <label>Tarining Name: </label>
                    <input class="form-control" type="text" name="name" value="" id="tname" disabled></p>
                    <input type="hidden" name="tid" value="" id="trainingid">
                <p>
                    <label>Set new registration limit [ e.g. 100 (original limlt )+12 (additional limit) = 112 (new registration limit) ] : </label>
                    <input class="form-control" type="number" name="limit" id="limit" value="" placeholder="Please enter new registration limit"></p>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary" type="submit" name="submit" value="submit">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> 
            <?php echo form_close(); ?>
          </div>
        </div>
    </div>

    <form action="<?php echo base_url('stripe/index'); ?>" method="get" name="stripePay" id="trapromotionStripeBuy">
        <input type="hidden" name="id" id="stripTid"> <!-- here id is training id. -->
        <input type="hidden" name="name" id="stripTname">
        <input type="hidden" name="price" id="totalpromotionprice" value="<?php echo $pricewithtax; ?>">
        <input type="hidden" name="tax"  value="<?php echo $tax; ?>">
        <input type="hidden" name="day" id="totalpromotionday" value="1">
        <input type="hidden" name="base_price" id="stripepromotionBase" value="<?php echo $dailprice; ?>">
        <input type="hidden" name="type" value="Training Promotion">
    </form>
    <form action="<?php echo base_url('payu/index'); ?>" method="get" name="stripePay" id="trapromotionPayuBuy">
        <input type="hidden" name="id" id="payuTid"> <!-- here id is training id. -->
        <input type="hidden" name="name" id="payuTname">
        <input type="hidden" name="price" id="totalpromotionpricepayu" value="<?php echo $pricewithtax; ?>">
        <input type="hidden" name="tax" id="totaltaxpayu" value="<?php echo $tax; ?>">
        <input type="hidden" name="day" id="totalpromotiondaypayu" value="1">
        <!--<input type="hidden" name="base_price" id="stripepromotionBase" value="<?php echo $dailprice; ?>">-->
        <input type="hidden" name="type" value="Training Promotion">
    </form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#training-list').DataTable();
    } );

    function traning_setprice(day){
        var priceWithTax = '<?php echo $priceWithTax; ?>';
        var tax = '<?php echo $tax; ?>';
        var totaltax = tax * day;
        var totalprice = (priceWithTax*day).toFixed(2);
        jQuery('#totalpromotionday').val(day);
        jQuery('#totalpromotiondaypayu').val(day);
        jQuery('#stripepromotionBase').val(priceWithTax);
        if(day){
            jQuery('#traning_pricehtml').html('$'+totalprice+' Pay Now');
            jQuery('#totalpromotionprice').val(totalprice);
            jQuery('#totalpromotionpricepayu').val(totalprice);
            jQuery('#totaltaxpayu').val(totaltax);
        }else{
            jQuery('#traning_pricehtml').html('');
        }
    }

    function traning_submitform(){
        jQuery('#traning_payformdaily').submit();
    }

    function promotoTraining(training_id,trainingname){
        $('#item_name').val(trainingname+'- Training Promotion');
        $('#item_number').val(training_id);
        $('#stripTid').val(training_id);
        $('#payuTid').val(training_id);
        $('#stripTname').val(trainingname+'- Training Promotion');
        $('#payuTname').val(trainingname+'- Training Promotion');
        $('#promotoTrainingModal').modal('show');
    }

    function trapromotionbypaypal(){
        var dailprice = '<?php echo $dailprice; ?>';    
        var tax = '<?php echo $tax; ?>';    
        var priceWithTax = '<?php echo $priceWithTax; ?>';    
        var day = jQuery('#traning_day').val(); 
        var totalprice = (priceWithTax*day).toFixed(2);
        jQuery('#amount').val(totalprice);  
        $('#custom').val(day+'_'+dailprice+'_'+tax);   
        $('#promo_training').submit();
    }

    function submitTrainingForm() { 
        $("#Trainingpayby").modal("show"); 
        $("#promotoTrainingModal").modal("hide"); 
    // jQuery('#coursepro').submit();
    }

    // function trapromotionbypaypal() {
    //     $("#promo_training").submit();
    // }
    
    function trapromotionbystrip() {
        $("#trapromotionStripeBuy").submit();
    }
    function trapromotionbypayu() {
        $("#trapromotionPayuBuy").submit();
    }
    function setLimit(tid,name,limit){
        $("#set_limit").modal("show"); 
        $("#tname").val(name); 
        $("#trainingid").val(tid); 
        $("#limit").val(limit); 

    }
    $('.duplicateTraining').on('click', function(){
        var c = confirm('Do you want to duplicate this training and all contents?');
        if(c == true){
            var tid = $(this).attr('data-value');
            var path = "<?php echo base_url(); ?>";
            window.location.href = path + 'provider/duplicateRecordTraining/'+tid;
        }
    });
</script>



<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="pramottraining" id="promo_training">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name">
    <input type="hidden" name="item_number" id="item_number">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="<?php echo $user_id; ?>">
    <input type="hidden" name="amount" id="amount">
    <input type="hidden" name="custom" id="custom"><!--  //days -->
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('provider/training_promote_fail/').$tid; ?>">
    <input type="hidden" name="return" value="<?php echo site_url('provider/training_promote_success/').$tid?>">   
</form>