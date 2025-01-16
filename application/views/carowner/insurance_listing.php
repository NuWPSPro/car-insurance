<?php  $this->load->view('carowner/picture'); ?>

		<!-- Main body start -->
		<div class="col-sm-9">
			<?=$body_heading; ?>
                <div class="table-responsive">
			        <table class="table table-striped">
                        <tr>
                            <th>S no</th>
                            <th>Insurance Package</th>
                            <th>Insurance No.</th>
                            <th>Issued Date</th>
                            <th>Validity Date</th>
                            <th>Duration</th>
                            <th>Counter</th>
                            <th>Status</th>
                            <th>Sent to RT status</th>
                            <th>Sent Date</th>
                            <th>Refrance Id</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <?php if(!empty($buy_insurance)){
                                // echo '<pre>'; print_r($buy_insurance); echo '</pre>'; 
                                foreach($buy_insurance as $key => $buy):
                                if($buy['sent_status']==1){ $reportbtn ="none";  $sent_date = $buy['updated_at']; }else{ $reportbtn =""; $sent_date ='--'; }
                                    if($buy['status']=='1'){ 
                                        $vrbtn =""; 
                                        $date = strtotime($buy['validity']);
                                        $remaining = $date - time();
                                        $days_remaining = floor($remaining / 86400).' Days';
                                        $hours_remaining = floor(($remaining % 86400) / 3600);
                                    }else{ 
                                        $days_remaining = '--';
                                        $vrbtn ="none";  
                                    }
                                    ?>
                                <td scope="row"><?php echo $key+1; ?>.</td>
                                <td><?php echo $buy['insur_name'] ?></td>
                                <td><?php echo ($buy['insurance_no'] != '')?$buy['insurance_no']:'--'; ?></td>
                                <td><?php echo $buy['issue_date'] ?></td>
                                <td><?php echo $buy['validity'] ?></td>
                                <td><?php echo ($buy['status']=='1')?'1 YEAR':'--'; ?></td>
                                <td><?php echo $days_remaining ?>  </td>
                                <td><?php echo ($buy['status'] == '1')?'<span class="text-success">Certificate<br>Issued</span>':'<span class="text-danger">Pending</span>'; ?></td>
                                <td><?php echo ($buy['sent_status'] == 1)?'<span class="text-success">Sent</span>':'<span class="text-danger">Not Sent</span>'; ?></td>
                                <td><?php echo $sent_date; ?>  </td>
                                <td><?=($buy['ref_id'] != '')?$buy['ref_id']:'--';?></td>
                                <td>
                                <!-- <a href="javascript:void(0)" onclick="alert('coming soon!');" style="display:<?=$vrbtn;?>" class="btn btn-primary m-1">Renew</a>  -->
                                <a href="javascript:void(0)" data-id="<?=$buy['insurance_no']; ?>" style="display:<?=$vrbtn;?>" class="btn btn-primary m-1 viewInsurance">View</a> 
                                <a href="javascript:void(0)" style="display:<?=$reportbtn;?>" data-id="<?=$buy['insur_id']; ?>" data-value="<?=$buy['insurance_no']; ?>" class="btn btn-primary m-1 showRTInfo">Report To RT</a>    
                                </td>
                        </tr>
                            <?php endforeach;
                           }else{
                            echo 'No Data Found!';
                           }  ?>

                    </table>
                </div>
        
		</div>
    <!-- Main body end -->


        <!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>

    <div class="modal fade" id="viewInsurance" tabindex="-1" role="dialog" aria-labelledby="labelInsurance" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-white" id="labelInsurance">View Certificate</h5>
            </div>
            <div class="modal-body">
                <div style="text-align:center;"><iframe src="" id="pdfPath" style="height:800px;width:650px;" title="Insurance Certificate"></iframe></div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div id="sendCertificateToRboard" class="modal fade modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header p-3 bg-primary">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-uppercase text-center text-white sendCertificateTitle">Report Insurance</h4>
					</div>
					<div class="modal-body">
						<div class="card">
                            <div class="card-body">
                                <p class="card-text"> 
                                    <span class="sendToInsSection"></span>
                                    <label> To : <strong>Road Traffic</strong></label><br>
                                    <label> Recipient : <strong id="strb_car_owner"> <?php $user = $this->session->userdata('logged_in'); echo $user['fname'].' '.$user['lname'].' '.$user['name']; ?></strong></label><br>
                                    <label> Subject: <strong id="strb_subject">Digital Insurance</strong></label><br>
                                    <label> Insurance Number: <strong id="strb_certificate_no">CERT0123456</strong></label><br>
                                    <label> Date Issued: <strong id="strb_date_issued"> </strong></label><br>
                                </p>
                                <p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Pay $1 Now to send the insurance to Roadtraffic: </label>
                                            <form method="post" class="d-flex" id="validateForm">
                                                <input type="hidden" name="certificate_no" id="certificate_no">
                                                <button type="button" class="btn btn-primary payNowForInsurance">Pay Now</button>
                                            </form>
                                            <span id="inputError"></span>
                                        </div>
                                    </div>
                                </p>
                                <!-- <span id="sendCertificateToRT" style="display:none;">
                                    <button id="sendToRT" class="btn btn-success" data-id=""> Send insurance to Roadtraffic</button>
                                </span> -->
                                <span id="strb_sendCertificate"></span>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

        <form action="<?php echo PAYAPAL_URL ?>" method="post" name="payForSendInsuranceToRT" target="" id="payForSendInsuranceToRT">
			<input type="hidden" name="business" value="<?php echo PAYAPAL_ID ?>">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="item_name" id="item_name" value="Payment for Insurnace">
			<input type="hidden" name="item_number" id="item_number_sirt" value="">
			<input type="hidden" name="credits" value="510">
			<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
			<input type="hidden" name="custom" value="<?php echo $this->session->userdata('logged_in')['role']; ?>">
			<input type="hidden" name="amount" id="amount" value="1">
			<input type="hidden" name="tax" value="0">
			<input type="hidden" name="rm" value="2">
			<input type="hidden" name="no_shipping" value="1">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="handling" value="0">
			<input type="hidden" name="cancel_return" value="<?php echo site_url('professional/cancelInsurancePayment'); ?>">
			<input type="hidden" name="return" value="<?php echo site_url('professional/updateInsurancePayment'); ?>">
		</form>
          
            
    <script>
        $(document).on('click','.showRTInfo',function(){
        
            var insurance_id = $(this).attr('data-id');
            var insurance_no = $(this).attr('value');

            $.ajax({
                url: "<?php echo base_url('professional/get_insurance_details/'); ?>"+insurance_id,
                type: 'POST',
                // data: {id : insurance_id},
                success: function(getdata){
                    if(getdata!=''){

                        var obj = JSON.parse(getdata)
                        if(obj!=''){
                            // console.log(obj);
                            $('#strb_date_issued').html(obj.issue_date);
                            $('#strb_certificate_no').html(obj.certificate_id);
                            $('#certificate_no').val(obj.certificate_id);
                            $('#sendToRT').attr('data-id',insurance_id);
                            $('.sendCertificateTitle').html('Send Insurance to Road Traffic');
                            $('#sendCertificateToRboard').modal('show');
                            
                            // send_now(getdata);
                            // $.ajax({
                                //     url: 'https://ceonpoint.com/roadtraffic/admin/Api/report_insurance',
                                //     type: 'POST',
                                //     data: getdata, //data in json_encoded
                                //     dataType: 'json',
                                //     beforeSend: function() {
                                //         $('#strb_sendCertificate').html("<div class='w-100 text-primary'><h3>Please wait, the Digital Insurance is sending to Road traffic...</h3></div>");
                                //     },
                                //     success: function(result){
                                //         console.log(result);
                                //         var obj = JSON.parse(getdata)
                                //         console.log(obj.certificate_id,result.last_id);
                                //         if(result.success==true){
                                //             update_insurance(obj.certificate_id,result.last_id);
                                //             $('#strb_sendCertificate').html("<div class='w-100 alert alert-success'><h3>"+result.msg+"</h3></div>");
                                //         }else{
                                //             if(result.code == 401){
                                //                 $('#strb_sendCertificate').html("<div class='w-100 alert alert-danger'><h3> This insurance is sent already!</h3></div>");
                                //             }else{
                                //                 $('#strb_sendCertificate').html("<div class='w-100 alert alert-danger'><h3>"+result.msg+"</h3></div>");
                                //             }
                                //         }
                                //     }
                            // });
                        }else{                            
                            $('#strb_sendCertificate').html("<div class='w-100 alert alert-danger'><h3> something went wrong!!</h3></div>");
                        }
                    }else{
                        $('#strb_sendCertificate').html("<div class='w-100 alert alert-danger'><h3> something went wrong!!</h3></div>");
                    }
                },
                error: function(e){
                    alert('something went wrong!');
                }
            });
            
        });

        function sendToRT(insurance_id){
        // $('#sendToRT').click(function(){
        //     var insurance_id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo base_url('professional/get_insurance_details/'); ?>"+insurance_id,
                type: 'POST',
                // data: {id : insurance_id},
                success: function(getdata){
                    console.log(getdata);
                    
                    if(getdata!=''){
                            var path = "<?php echo ROAD_TRAFFIC_DOMAIN ?>"; 
                        $.ajax({
                            url: path + "admin/Api/report_insurance",
                            type: 'POST',
                            data: getdata, //data in json_encoded
                            dataType: 'json',
                            // beforeSend: function() {
                            //     $('#strb_sendCertificate').html("<div class='w-100 text-primary'><h3>Please wait, the Digital Insurance is sending to Road traffic...</h3></div>");
                            // },
                            success: function(result){
                                var obj = JSON.parse(getdata)
                                // console.log(obj.certificate_id,result.last_id);
                                if(result.success==true){
                                    alert(result.msg);
                                    update_insurance(obj.certificate_id,result.last_id);
                                    $('#strb_sendCertificate').html("<div class='w-100 alert alert-success'><h3>"+result.msg+"</h3></div>");
                                    setTimeout(function() { location.reload(); }, 3000);
                                }else{
                                    if(result.code == 401){
                                        $('#strb_sendCertificate').html("<div class='w-100 alert alert-danger'><h3> This insurance is sent already!</h3></div>");
                                    }else{
                                        $('#strb_sendCertificate').html("<div class='w-100 alert alert-danger'><h3>"+result.msg+"</h3></div>");
                                    }
                                }
                            }
                        });
                    }else{
                        $('#strb_sendCertificate').html("<div class='w-100 alert alert-danger'><h3> something went wrong!!</h3></div>");
                    }
                }

            });
        // });
        }

        $('.payNowForInsurance').click(function(){
            var certificate_no = $('#certificate_no').val();
            
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('professional/payNowForInsurance');?>',
                data: { certificate_no: certificate_no },
                success: function(result){
                    console.log(result);
                    var objr = JSON.parse(result)
                    if(objr.success == 1){
                        $('#item_number_sirt').val(objr.last_id);
                        $('#payForSendInsuranceToRT').submit()
                        // $('#sendCertificateToRT').show();
                        $('.payNowForInsurance').attr('disabled',true);
                        // $('#inputError').html('Payment successfully done.').css('color','green');
                    }else{
                        $('#inputError').html('Payment fail!').css('color','red');
                    }
                }
            }); 
        });

        function update_insurance(insurance_no,last_id){
            const d = new Date();
            let year = d.getFullYear();
            var ref = 'refo_'+ year + last_id;
            var path = "<?php echo CAR_INSURANCE_DOMAIN ?>";
            var settings = {
                "url":  path + "professional/insurance_sent_success/"+insurance_no+"/"+ref,
                "method": "POST",
                "headers": {
                    "Content-Type": "application/json"
                }
            };

            $.ajax(settings).done(function (response) {
                console.log(response);
            });
        }

        
        $('.viewInsurance').click(function(){
            var insur_id = $(this).data("id");
            var insurance_num = '/'+ insur_id +'.pdf';
            var path = "<?php echo base_url('assets/upload/pdf');?>" + insurance_num;
            // alert(path);
            $('#pdfPath').attr('src',path);
            $('#viewInsurance').modal('show');
        });
        
    </script>
    
    <!-- Modal -->
    <div id="finalySendCertficate" class="modal fade modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header p-3 bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-uppercase text-center text-white sendCertificateTitle">Don't refresh or close this popup!</h4>
                </div>
                <div class="modal-body">
                    <span id="sendCertificateToRT">
                        <button id="sendToRT" class="btn btn-success" data-id=""> Send insurance to Roadtraffic</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

<?php if(isset($_REQUEST['srti']) && $_REQUEST['srti'] == true && isset($_SESSION['insur_id'])){ ?> 
    <script>
        alert('ok')
        var insurance_id = "<?php echo $_SESSION['insur_id'] ?>";
        sendToRT(insurance_id);
       
        // $('#finalySendCertficate').show();
        // $('.payNowForInsurance').attr('disabled',true);
        // $('#inputError').html('Payment successfully done.').css('color','green');
    </script>
<?php  if(isset($_SESSION['insur_id'])){ unset($_SESSION['insur_id']); unset($_SESSION['last_id']); } } ?>