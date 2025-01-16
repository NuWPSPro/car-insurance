<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-invoice-listingpanel">
    <div class="container">
    
        <div class="row">
            <?php 
        $this->load->view('admin/sidebar');
        ?>
            <div class="col-sm-9">
                <h3 class="border-title text-left">Invoice Listing</h3>
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
                <div class="row">
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
                            <input type="month" name="added_on" class="form-control" value="<?php echo set_value('added_on')?>">
                    </div>
                    <div class="form-group col-md-2">
                        
                        <input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
                    </div>
                </form>
            </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>CPD Name</th> 
                                <th>Email</th> 
                                <th>Month Covered</th> 
                                <th>Net Income</th> 
                                <th>Tax Amount</th> 
                                <th>Admin Amount</th> 
                                <th>CPD Amount</th> 
                                <th>Country</th> 
                                <th>Status</th> 
                                <th>Paid Amount</th> 
                                <th>Date Paid</th> 
                                <th>Transactions Id</th> 
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($invoice as $key => $value) {    
                                    $udata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 
                                    $countryName = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name']; 

                                    if($value['status']==1){
                                        $stts = "Pending";
                                        $col  = "red";
                                    } 

                                    if($value['status']==2){
                                        $stts = "Paid";
                                        $col="green";
                                    } 

                            ?>
                            <tr>
                                <td>
                                    <?php echo $key+1;?>
                                </td>
                                <td>
                                    <?php echo $udata[0]['name'];?>
                                </td>
                                <td>
                                    <?php echo $udata[0]['username_email'];?>
                                </td> 
 
                                <td><?php echo date('F , Y',strtotime($value['month_name']));?></td> 
                                <td><?php if($value['total_amount'] !=""){?>$<?php } ?><?php echo $value['total_amount'];?></td> 
                                <td><?php if($value['tax'] !=""){?>$<?php } ?><?php echo $value['tax'];?></td> 
                                <td><?php if($value['admin_amount'] !=""){?>$<?php } ?><?php echo $value['admin_amount'];?></td> 
                                <td><?php if($value['cpd_amount'] !=""){?>$<?php } ?><?php echo $value['cpd_amount'];?></td> 
                                <td><?php echo $countryName; ?></td> 
                                <td style="color: <?php echo $col;?>"><?php echo $stts;?></td> 
                                <td><?php if($value['paid_amount'] !=""){?>$<?php } ?><?php echo $value['paid_amount'];?></td> 
                                <td><?php echo $value['added_on'];?></td> 
                                <td><?php echo $value['transaction_id'];?></td> 
                                <td><?php if($value['status'] != 2){?>
                                    <a style="color: blue;" href="javascript:void(0);" onclick="paynow('<?php echo $value['id'];?>','<?php echo $value['cpd_amount'];?>')">Pay Now</a>
                                    <?php }else {?>
                                    <a style="color: blue;" href="<?php echo base_url('admin/invoice_receipt/'.$value['id']);?>">View Receipt</a><?php } ?></td> 

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	function paynow(idd,amount){

		$('#idd').val(idd);
		$('#amount').val(amount);

        $("#myModal111").modal();
	}
</script>

<div class="modal fade" id="myModal111" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pay Now</h4>
        </div>
        <div class="modal-body">


			<form action="<?php echo site_url('admin/paynow');?>" method="post" name="frm">

				<input type="hidden" name="idd" id="idd">

					<div class="form-group">
					<label for="email">Transactions Id:</label>
					<input type="text" class="form-control" id="transactions_id" name="transactions_id" required>
					</div>
					<div class="form-group">
					<label for="pwd">Paid Amount:</label>
					$<input type="number" class="form-control" id="amount" name="amount" required>
					</div> 
					<button type="submit" class="btn btn-default">Submit</button>
			</form>


        </div>
         
      </div>
      
    </div>
  </div>
  
</div>

