<?php $this->load->view('admin/picture'); ?>
<div class="innerContent">
    <div class="container">
        <h2 class="border-title text-left">Dashboard</h2>
        <div class="row">
            <?php 
        $this->load->view('admin/sidebar');
        ?>
            <div class="col-sm-8">
                <h3 class="border-title text-left">Invoice Receipt</h3>
                <?php echo $this->session->flashdata('response');?>
               <!--  <div class="alert alert-info clearfix">
                    <form action="#" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="col-md-9 form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <input type="text" class="form-control" id="cat_name" name="cat_name" aria-describedby="emailHelp" placeholder="Enter category name">
                            <span class="error"><?php echo  form_error('cat_name'); ?></span>
                        </div> 
                        <div class="col-md-3">
                            <label style="display: block;">&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div> -->
                <!-- <br>
                <br> -->
               <!--  <div class="row">
                <form method="POST" action="<?php echo BASE_URL('admin/invoice_listing');?>" id="traningfilterform">
                    <div class="form-group col-md-3">
                        <select name="country" class="form-control">
                            <option value="" >Country:</option>
                            <?php foreach($countries as $count){
                                ?>
                               <option value="<?php echo $count['countries_id']; ?>" <?php if($_POST['country']==$count['countries_id']){echo'selected';} ?> ><?php echo $count['countries_name']; ?></option>
                            <?php
                            } ?>
                    </select>
                    </div>

         
                   <div class="form-group col-md-3">
                  
                        <select name="ceprovider" class="form-control">
                            <option value="" >CE Provider:</option>
                            <?php foreach($cproviders as $cp){
                                ?>
                               <option value="<?php echo $cp['id']; ?>" <?php if($_POST['ceprovider']==$cp['id']){echo'selected';} ?> ><?php echo $cp['name']; ?></option>
                            <?php
                            } ?>
                    </select>
                    </div>

                    <div class="form-group col-md-3">
                            <input type="date" name="added_on" class="form-control" value="<?php echo set_value('date')?>">
                    </div>
                    <div class="form-group col-md-2">
                        
                        <input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
                    </div>
                </form>
            </div> -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%">
                        <?php $udata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$invoice[0]['user_id']); 
                            if($invoice[0]['status']==1){
                                $stts = "Pending";
                                $col  = "red";
                            } 

                            if($invoice[0]['status']==2){
                                $stts = "Paid";
                                $col="green";
                            } ?>
                            <tr>
                                <th>CPD Name</th> 
                                <td>
                                    <?php echo $udata[0]['name'];?>
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th> 
                                 <td>
                                    <?php echo $udata[0]['username_email'];?>
                                </td> 
                            </tr>
                            <tr>
                                <th>Month</th> 
                                <td><?php echo $invoice[0]['month_name'];?></td> 
                            </tr>
                            <tr>
                                <th>Total Amount</th> 
                                <td><?php if($invoice[0]['total_amount'] !=""){?>$<?php } ?><?php echo $invoice[0]['total_amount'];?></td>
                            </tr>
                            <tr>
                                <th>Admin Amount</th>
                                <td><?php if($invoice[0]['admin_amount'] !=""){?>$<?php } ?><?php echo $invoice[0]['admin_amount'];?></td> 
                            </tr>
                            <tr>
                                <th>CPD Amount</th> 
                                <td><?php if($invoice[0]['cpd_amount'] !=""){?>$<?php } ?><?php echo $invoice[0]['cpd_amount'];?></td> 
                            </tr>
                            <tr>
                                <th>Status</th> 
                                <td style="color: <?php echo $col;?>"><?php echo $stts;?></td> 
                            </tr>
                            <tr>
                                <th>Paid Amount</th> 
                                <td><?php if($invoice[0]['paid_amount'] !=""){?>$<?php } ?><?php echo $invoice[0]['paid_amount'];?></td> 
                            </tr>
                            <tr>
                                <th>Date Paid</th> 
                                <td><?php echo $invoice[0]['added_on'];?></td> 
                            </tr>
                            <tr>
                                <th>Transactions Id</th> 
                                <td><?php echo $invoice[0]['transaction_id'];?></td> 
                            </tr>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>


