<?php  $this->load->view('broker/picture'); ?>

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
                            <th scope="col">Sent Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($listing): 
                            foreach($listing as $list):
                            @$i++;
                            if($list['send_to_comp']==1): 
                                $send_to_comp = '<span class="text-success">Sent</span>';
                                $sentdate = $list['updated_at'];
                                $style = 'none';
                            else:
                                $send_to_comp = '<span class="text-danger">Not Sent</span>';
                                $sentdate='--';
                                $style = '';
                            endif; 
                            if($list['type'] == 1){
                                $type = 'Comprehensive';
                            }else{
                                $type = 'Third Party';
                            }
                            $sendST = $list['buy_fname'].' '.$list['buy_lname'].' '.$list['buy_name'].'|'.
                                $list['comp_fname'].' '.$list['comp_lname'].' '.$list['comp_name'].'|'.
                                $list['insurance_name'].'|'.$list['certificate_id'].'|'.$list['issue_date'].'|'.$list['validity'].'|'.$type.'|'.$list['user_id'].'|'.$list['company_id'];
                            ?>
                        <tr>
                            <th scope="row"><?=$i;?></th>
                            <td class="small"><?=$list['buy_fname'];?> <?=$list['buy_lname'];?> <?=$list['buy_name'];?></td>
                            <td class="small"><?=$list['comp_fname'];?> <?=$list['comp_lname'];?> <?=$list['comp_name'];?></td>
                            <td class="small"><?=$list['insurance_name'];?></td>
                            <td><?=$list['certificate_id'];?></td>
                            <td class="small"><?=$list['issue_date'];?></td>
                            <td class="small"><?=$list['validity'];?></td>
                            <td class="small"><?=$sentdate;?></td>
                            <td class="small"><?=$type;?></td>
                            <td class="small"><?=$send_to_comp;?></td>
                            <td>
                                <a href="javascript:void(0)" style="display:<?=$style?>" data-id="<?=$list['id']; ?>" data-value="<?=$sendST;?>" class="sendToCompany btn btn-primary m-1" title="Send to insurance company">Send to</a>
                                <a href="javascript:void(0)" data-id="<?=$list['certificate_id']; ?>" class="btn btn-primary m-1 viewInsurance">View</a>
                                <!-- <a href="<?=base_url('provider/delete_insurance/'.$list['insure_id']); ?>" onclick="return deleteInsurance();" class="btn btn-danger m-1"><i class="fa fa-trash"></i></a> -->
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


    <div class="modal fade" id="sendTOInsurance" tabindex="-1" role="dialog" aria-labelledby="labelInsurance" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title text-white" id="labelInsurance">Send to Insurance Company</h5>
                </div>
                <div class="modal-body">
                    <p>
                        <ul>
                            <li>Insurance Company: <span id="comp_fname"></span> </li>
                            <li>Buyer Name: <span id="buy_name"></span> </li>
                            <!-- <li>Insurance Name: <span id="insurance_name"></span> </li> -->
                            <li>Insurance Number: <span id="insurance_no"></span> </li>
                            <li>Issue Date: <span id="issue_date"></span> </li>
                            <li>Validity Date: <span id="validity"></span> </li>
                            <li>Type: <span id="type"></span> </li>
                        </ul> 
                    </p>    
                    
                    <a class="btn btn-primary" id="sendbutton">Send Certificate</a>
                
                </div>
            
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

    <script>
        function deleteInsurance(){
            var x = confirm('Do you realy want to delete this?');
            if(x == true){ return true; }else{ return false; }
        }

        $('.sendToCompany').click(function(){
            var certificateTbl_id = $(this).attr('data-id');
            var valueSt = $(this).attr('data-value');
            const valueArray = valueSt.split("|");
            // console.log(valueArray);
            var path = "<?php echo base_url('author/sendInsurance/') ?>";
            $('#buy_name').html($.trim(valueArray[0]));
            $('#comp_fname').html($.trim(valueArray[1]));
            $('#insurance_name').html($.trim(valueArray[2]));
            $('#insurance_no').html($.trim(valueArray[3]));
            $('#issue_date').html($.trim(valueArray[4]));
            $('#validity').html($.trim(valueArray[5]));
            $('#type').html($.trim(valueArray[6]));
            // $('#user_id').html($.trim(valueArray[7]));
            // $('#company_id').html($.trim(valueArray[8]));
            $('#sendbutton').attr('href',path + certificateTbl_id);
            $('#sendTOInsurance').modal('show');
        });

        $('.viewInsurance').click(function(){
            var insur_id = $(this).data("id");
            var insurance_num = '/'+ insur_id +'.pdf';
            var path = "<?php echo base_url('assets/upload/pdf');?>" + insurance_num;
            // alert(path);
            $('#pdfPath').attr('src',path);
            $('#viewInsurance').modal('show');
        });
    </script>