<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
  <div class="container">

    <div class="row">
      <?php  $this->load->view('provider/sidebar');  ?>
      <div class="col-sm-9">
        <h3 class="border-title text-left">Active Advertisement</h3>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <tr>
              <th>No.</th>
              <th>Ads Package</th>
              <th>Duration</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Countdown</th>
              <th>Amount</th>
              <th class="text-center">Image</th>
              <th class="text-center">Action</th>
            </tr>
            <?php 
                  $tot=0;
                  foreach ($purchase_list as $key => $value) {
                  $tot = $tot+$value['amount'];   
                  $resData =  $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_course','id',$value['item_name']);
                  ?>
            <tr>
              <td><?php echo $key+1;?>.</td>
              <td><?php echo $resData[0]['course_title'];?></td>
              <td><?php echo $value['quantity'];?></td>
              <td><?php echo $value['txn_id'];?></td>
              <td class="text-center"><a href="javascript:void(0)" onclick="showBill('<?php echo $value['id'];?>')"
                  class="text-primary"> <?php echo $value['txn_id'];?></a></td>
              <td><?php echo $value['added_on'];?></td>
              <td class="text-right">$<?php echo $value['amount'];?></td>
            </tr>
            <?php } ?>
            <td></td>
            <td></td>
            <td colspan="5" class="text-right">Total</td>
            <!-- <td class="text-right">$<?php echo $tot;?></td> -->
            <td class="imgbox-adv">
              <img src="<?php echo ASSETS_URL ?>images/uploads/slider81562780356.png" alt="">
            </td>
            <td class="text-right">
              <a target="_blank" class="btn btn-primary" title="View" href="#"><i class="fa fa-eye"></i></a>
              <a target="_blank" class="btn btn-primary" title="View" href="#"><i class="fa fa-refresh"></i></a>
            </td>
            </tr>
          </table>
        </div>
        <?php 
            if(empty($purchase_list)){

              ?>

        <p style="color: red;">Sorry no records found.</p>

        <?php 

            }

            ?>


    <div class="panel panel-default">
            <div class="panel-heading">
              <h4 style="margin:0;" data-toggle="collapse" data-target="#demo">Previous Advestisment <a href="javascript:void(0);" class="pull-right">View</a></h4>
            </div>
            <div class="panel-body collapse" id="demo" >
            Sorry no records found.
            </div>
    </div>
        <div class="advertismentBoxdetail">
          <a href="#" class="btn btn-danger" style="margin-right:15px;margin-bottom: 20px;">Advertise Now! Choose Ads
            Packages</a>
          <a href="#" class="btn btn-primary" style="margin-right:15px;margin-bottom: 20px;">View Website Analytics</a>
          <h3 class="border-title text-left">Home Page</h3>
          <div class="row">

            <div class="col-md-3">
              <div class="packegBox">
                <a href="#" data-toggle="modal" data-target="#myModalnew">
                  <img src="http://ceonpoint.com/assets/images/uploads/slider81562780356.png" alt="">
                  <h5 class="packegname">Packages A-1</h5>
                </a>
              </div>
            </div>
            <div class="col-md-3">
              <div class="packegBox">
                <a href="#">
                  <img src="http://ceonpoint.com/assets/images/uploads/slider81562780356.png" alt="">
                  <h5 class="packegname">Packages A-2</h5>
                </a>
              </div>
            </div>
            <div class="col-md-3">
              <div class="packegBox">
                <a href="#">
                  <img src="http://ceonpoint.com/assets/images/uploads/slider81562780356.png" alt="">
                  <h5 class="packegname">Packages A-3</h5>
                </a>
              </div>
            </div>
            <div class="col-md-3">
              <div class="packegBox">
                <a href="#">
                  <img src="http://ceonpoint.com/assets/images/uploads/slider81562780356.png" alt="">
                  <h5 class="packegname">Packages A-4</h5>
                </a>
              </div>
            </div>
            <div class="col-md-12">
              <h3 class="border-title text-left">All Pages (Except Home Page)</h3>
            </div>
            <div class="col-md-3">
              <div class="packegBox">
                <a href="#">
                  <img src="http://ceonpoint.com/assets/images/uploads/slider81562780356.png" alt="">
                  <h5 class="packegname">Packages B-1</h5>
                </a>
              </div>
            </div>
            <div class="col-md-3">
              <div class="packegBox">
                <a href="#">
                  <img src="http://ceonpoint.com/assets/images/uploads/slider81562780356.png" alt="">
                  <h5 class="packegname">Packages B-2</h5>
                </a>
              </div>
            </div>
            <div class="col-md-3">
              <div class="packegBox">
                <a href="#">
                  <img src="http://ceonpoint.com/assets/images/uploads/slider81562780356.png" alt="">
                  <h5 class="packegname">Packages B-3</h5>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- myModalnew start-->
        <div id="myModalnew" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content myModalnewBox">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Packages A-1</h4>
              </div>
              <div class="modal-body">
                <div class="row">

                  <div class="col-md-8">
                    <div class="advert_img_box">
                      <img src="http://ceonpoint.com/assets/images/uploads/package-1.png">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="advert_summery_box sidebar-box">
                      <div class="panel-group">
                        <div class="panel panel-default">
                          <div class="panel-heading">Packages A-1</div>
                          <div class="panel-body">
                            <div class="price-per-day">$5.00 / Day</div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading">Your Ads Details</div>
                          <div class="panel-body">
                            <form action="/action_page.php">
                              <div class="form-group">
                                <label>Select Days</label>
                                <div class="selection-box">
                                  <select class="form-control" name="profession" id="profession">
                                    <option value="">10 Days</option>
                                    <option value="1">15 days</option>
                                    <option selected value="2">25 days</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Select Date</label>
                                <div class='input-group date' id='datetimepicker1'>
                                  <input type='text' class="form-control" />
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Upload Photo</label>
                                <input class="form-control" name="logo" size="20" type="file">
                              </div>
                            </form>

                            <div class="author-thumb">
                              <img src="http://ceonpoint.com/assets/images/uploads/slider81562780356.png" alt="">
                            </div>
                            <div class="total_payment">
                              <p>Total</p>
                              <span>$50.00 </span>
                              <a href="#">Pay now</a>
                            </div>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              </div>

            </div>

          </div>
        </div>
        <!-- myModalnew End-->






        <!-- Modal -->

        <div class="modal fade" id="myModal" role="dialog">

          <div class="modal-dialog">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Receipt No. 12345</h4>

              </div>

              <div class="modal-body">
                <div class="order-receipt">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="box-layout" style="height:175px;">
                        <div class="box-title">Bill To</div>
                        <div class="box-desc">
                          <p><strong>Ralph Noel Botin</strong><br>
                            Yonder Road
                          </p>
                          <p>Address Here</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="box-layout">
                            <div class="box-title">Terms</div>
                            <div class="box-desc">
                              Due on receipt
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="box-layout">
                            <div class="box-title">Dues Date</div>
                            <div class="box-desc">
                              15-Aug, 2018
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="box-layout">
                            <div class="box-title">Customer Number</div>
                            <div class="box-desc">
                              #98765432
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="box-layout">
                            <div class="box-title">Invoice Date</div>
                            <div class="box-desc">
                              15-Aug, 2018
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th>Description</th>
                        <th width="10%">Qty</th>
                        <th width="15%">Price</th>
                        <th width="15%">Amount</th>
                      </tr>
                      <tr>
                        <td>1 Year Unlimited Certificates

                          <div class="transaction-short-desc">Last four of credit Card: 8019<br>
                            Transaction id: 60701412650
                          </div>
                        </td>
                        <td>1</td>
                        <td class="text-right">$30.00</td>
                        <td class="text-right">$30.00</td>
                      </tr>
                      <tr>
                        <td>Thank you using CEUFast.com! Please tell a frind about our website if you were happy with
                          our service. If not, please contact us at CEUFast.com/Support and let us know how we can
                          improve.
                        </td>
                        <td class="text-right" colspan="2">
                          Subtotal<br>
                          SaleTax<br>
                          Total Shiping <br>
                          Total<br>
                          Payments<br>
                          <strong>Balance Dues</strong>
                        </td>
                        <td class="text-right">
                          $30.00<br>
                          $0.00<br>
                          $0.00<br>
                          $0.00<br>
                          $0.00<br>
                          <strong>$30.00</strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>

          </div>

        </div>





      </div>





    </div>


  </div>

</div>

</div>




<script type="text/javascript">
  function showBill(idd) {
    // alert("ddd");
    $('#rid').html(idd);
    $('#waitmessage').show();

    jQuery.noConflict();

    $("#myModal11").modal('show');


    $.ajax({
      type: "POST",
      url: '<?php echo base_url()."provider/showBill";?>',
      data: { idd: idd }
    }).done(function (result) {
      //alert(result);
      $('#waitmessage').hide();
      $("#responseData").html(result);
    });
    return false;
  }
</script>




<!-- Modal -->
<div class="modal fade" id="myModal11" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Receipt No. <span id="rid"></span></h4>
      </div>
      <p style="color: red; text-align: center; display: none;" id="waitmessage">Please wait.... </p>
      <div class="modal-body">

        <span id="responseData"></span>

      </div>
    </div>
  </div>
</div>