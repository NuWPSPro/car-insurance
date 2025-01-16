<?php  $this->load->view('car_company/picture'); ?>

    <!-- Main body start -->
    <div class="col-sm-9">
        <?=$body_heading; ?>
            <div class="row text-center">
                <form class="form-inline" action="https://ceonpoint.com/car/">
                    <!-- <select name="" id="toins" class="form-control">
                        <option value="">Type of Insurance:</option>
                        <option value="">Insurance 1</option>
                        <option value="">Insurance 2</option>
                        <option value="">Insurance 3</option>
                    </select>
                    
                    <select name="" id="prange" class="form-control">
                        <option value="">Price Range:</option>
                        <option value="">Price 1</option>
                        <option value="">Price 2</option>
                        <option value="">Price 3</option>
                    </select>
                    
                    <select name="" id="inscomp" class="form-control">
                        <option value="">Insurance Comapany:</option>
                        <option value="">Comapny 1</option>
                        <option value="">Comapny 2</option>
                        <option value="">Comapny 3</option>
                    </select>
                    
                    <button type="button" class="btn btn-primary">
                        Search
                    </button> -->
                    <a href="<?=base_url('provider/index'); ?>" class="btn btn-danger pull-right ml-1">Back</a>
                    <!-- <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createInsurance" data-whatever="@getbootstrap">Create Insurance</a> -->
                </form>
            </div>
            <div class="table-responsive">
                
            <?php //echo validation_errors(); ?>
            <?php // echo $this->session->flashdata('response')['msg']; ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Buyer Name</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Insurance Name</th>
                            <th scope="col">Insurance No.</th>
                            <th scope="col">Date Issued</th>
                            <th scope="col">Validity</th>
                            <th scope="col">Type</th>
                            <th scope="col">Reference Id</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($listing): 
                            foreach($listing as $list):
                            @$i++;
                            if($list['send_to_rt']==1): 
                                $send_to_rt = '<span class="text-success">Sent</span>';
                                $style = 'none';
                            else:
                                $send_to_rt = '<span class="text-danger">Not Sent</span>';
                                $style = '';
                            endif; 
                            if($list['type'] == 1){
                                $type = 'Comprehensive';
                            }else{
                                $type = 'Third Party';
                            }
                            $sendST = $list['buy_fname'].' '.$list['buy_lname'].' '.$list['buy_name'].'|'.
                                $list['comp_fname'].' '.$list['comp_lname'].' '.$list['comp_name'].'|'.
                                $list['insurance_name'].'|'.$list['certificate_id'].'|'.$list['issue_date'].'|'.$list['validity'].'|'.$type;
                            ?>
                        <tr>
                            <th scope="row"><?=$i;?></th>
                            <td><?=$list['buy_fname'];?> <?=$list['buy_lname'];?> <?=$list['buy_name'];?></td>
                            <td><?=$list['comp_fname'];?> <?=$list['comp_lname'];?> <?=$list['comp_name'];?></td>
                            <td><?=$list['insurance_name'];?></td>
                            <td><?=$list['certificate_id'];?></td>
                            <td><?=$list['issue_date'];?></td>
                            <td><?=$list['validity'];?></td>
                            <td><?=$type;?></td>
                            <td><?=($list['ref_id']!='')?$list['ref_id']:'--';?></td>
                            <td><?=$send_to_rt;?></td>
                            <td>
                                <a href="javascript:void(0);" style="display:<?=$style;?>" data-id="<?=$list['insur_id']; ?>" data-value="<?=$list['certificate_id']; ?>" class="btn btn-primary m-1 showRTInfo" title="Send to Road Traffic"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)" data-id="<?=$list['certificate_id']; ?>" class="btn btn-primary m-1 viewInsurance">View</a>
                            </td>
                        </tr>
                        <?php endforeach; 
                        endif; ?>
                    </tbody>
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
                                    <label>Recipient : <strong id="strb_recipient"><?php echo $this->session->userdata('logged_in')['name']; ?></strong></label><br>
                                    <label>Subject: <strong id="strb_subject">Digital Insurance</strong></label><br>
                                    <!-- <label>Car Owner: <strong id="strb_car_owner"> ABC</strong></label><br> -->
                                    <label>Insurance Number: <strong id="strb_certificate_no">CERT0123456</strong></label><br>
                                    <label>Date Issued: <strong id="strb_date_issued"> </strong></label><br>
                                </p>
                                <p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Authentication code: </label>
                                            <form method="post" class="d-flex" id="validateForm">
                                                <input type="text" name="code" id="validateInput" class="form-control" placeholder="Please enter code" value="" required>
                                                <input type="hidden" name="certificate_no" id="certificate_no">
                                                <button type="button" class="btn btn-primary validateCode">Validate</button>
                                            </form>
                                            <span id="inputError"></span>
                                        </div>
                                    </div>
                                </p>
                                <span id="sendCertificateToRT" style="display:none;">
                                    <button id="sendToRT" class="btn btn-success" data-id=""> Send insurance to Roadtraffic</button>
                                </span>
                                <span id="strb_sendCertificate"></span>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

    <script>
        $(document).on('click','.showRTInfo',function(){
            
            var insurance_id = $(this).attr('data-id');
            var insurance_no = $(this).attr('value');
            $.ajax({
                url: "<?php echo base_url('provider/get_insurance_details'); ?>",
                type: 'POST',
                data: {id : insurance_id},
                success: function(getdata){
                    var obj = JSON.parse(getdata)
                    if(obj!=''){
                    // console.log(obj);
                        $('#strb_date_issued').html(obj.issue_date);
                        $('#strb_certificate_no').html(obj.certificate_id);
                        $('#certificate_no').val(obj.certificate_id);
                        $('#sendToRT').attr('data-id',insurance_id);
                        $('.sendCertificateTitle').html('Send Insurance to Road Traffic');
                        $('#sendCertificateToRboard').modal('show');                    
                    }else{
                        $('#strb_sendCertificate').html("<div class='w-100 alert alert-danger'><h3> something went wrong!!</h3></div>");
                    }
                }
            });
            
        });

        $('#sendToRT').click(function(){
            var insurance_id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo base_url('provider/get_insurance_details'); ?>",
                type: 'POST',
                data: {id : insurance_id},
                success: function(getdata){
                    var obj = JSON.parse(getdata)
                    if(obj!=''){
                        var path = '<?php echo ROAD_TRAFFIC_DOMAIN ?>';
                        $.ajax({
                            url:  path + 'admin/Api/add_insurance',
                            type: 'POST',
                            data: getdata, //data in json_encoded
                            dataType: 'json',
                            beforeSend: function() {
                                $('#strb_sendCertificate').html("<div class='w-100 text-primary'><h3>Please wait, the Digital Insurance is sending to Road traffic...</h3></div>");
                            },
                            success: function(result){
                                console.log(result);

                                // console.log(obj.certificate_id,result.last_id);
                                if(result.success==true){
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
        });
        $('.validateCode').click(function(){
            var authCode = $('#validateInput').val();
            var certificate_no = $('#certificate_no').val();
            $('#inputError').html(''); 
            if(authCode == ''){
                $('#inputError').html('Authentication code shouldn\'t be blank!').css('color','red');
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('provider/validate_insurance_code');?>',
                data: { authCode:authCode, certificate_no: certificate_no },
                success: function(number){
                    console.log(number);
                    if(number == 1){
                        $('#sendCertificateToRT').show();
                        $('#inputError').html('Authentication code matched successfully.').css('color','green');
                    }else{
                        $('#inputError').html('Wrong Authentication Code!').css('color','red');
                    }
                }
            }); 
        });

        function update_insurance(insurance_no,last_id){
            const d = new Date();
            let year = d.getFullYear();
            var ref = 'ref_'+ year + last_id;
            var path = '<?php echo CAR_INSURANCE_DOMAIN ?>';
            var settings = {
                "url": path + "provider/insurance_sent_success/"+insurance_no+"/"+ref,
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