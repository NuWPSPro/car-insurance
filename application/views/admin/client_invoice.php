<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-taxpanal">
	<div class="container">
      
      <div class="row">
       <?php  $this->load->view('admin/sidebar');  ?>  
            <div class="col-sm-9">
              <h4 class="border-title text-left">
                Client Invoice Listing
                <a onclick="add_client_invoice();" href="javascript:void(0)" class="btn btn-primary pull-right">Add Invoice</a>
              </h4>

          <?php echo $this->session->flashdata('response');?>
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Sl.no.</th>
                    <th>Invoice Number</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Recipient</th>
                    <th>Company Name</th>
                    <th>Date Paid</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
          <?php if(count($client_invoice_list)>0){ ?>
                    <?php $count=1;
                    foreach($client_invoice_list as $value){ 
                      if($value['status']==1){ 
                          $status = '<span class="text-success">PAID</span>'; 
                          $style  ='display: none';
                          $style1  = '';
                      }else{
                          $status = '<span class="text-danger">PENDING</span>'; 
                          $style  = '';
                          $style1  ='display: none';
                      } 
                      if($value['date_paid'] != ''){ 
                          $date_paid = $value['date_paid']; 
                      }else{
                          $date_paid = '--'; 
                      } ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $value['invoice_number'];?></td>
                      <td><?php echo $value['amount'];?></td>
                      <td><?php echo $value['date'];?></td>
                      <td><?php echo $value['recipient'];?></td>
                      <td><?php echo $value['company_name'];?></td>
                      <td><?php echo $date_paid;?></td>
                      <td><?php echo $status;?></td>
                      <td>
                        <a onclick="changeStatus('<?php echo $value['id']; ?>','<?php echo $value['date_paid']; ?>')" href="javascript:void(0);" class="btn btn-primary text-primary"  title="CHANGE STATUS"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        <a onclick="viewInvoice('<?php echo $value['id']; ?>')"  href="javascript:void(0)" class="btn btn-primary text-primary"  title="VIEW"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a style="<?php echo $style; ?>" onclick="editInvoice('<?php echo $value['id']; ?>')"  href="javascript:void(0)" class="btn btn-primary text-primary"  title="EDIT"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a style="<?php echo $style1; ?>" onclick="viewReceipt('<?php echo $value['id']; ?>')"  href="javascript:void(0)" class="btn btn-primary text-primary"  title="RECEIPT"><i class="fa fa-file-text" aria-hidden="true"></i></a>
                        <a onclick="deleteInvoice('<?php echo $value['id']; ?>')"  href="javascript:void(0)" class="btn btn-danger text-primary"  title="DELETE"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                    <?php $count++; } ?>
              <?php }else{ echo'<tr><td colspan="9"><center>No Data Found!</center></td></tr>';}?>
                  </tbody>
              </table>
            </div>
            </div>
    </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addClientModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Create Invoice</h5>
      </div>
      
      <form method="post" action="<?php echo BASE_URL.'admin/add_client_invoice';?>">
      <div class="modal-body mx-3">
        
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="date">Date : </label>
          <input type="date" name="date" class="form-control validate">
        </div>

        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="recipient">Name of Person : </label>
          <input type="text" name="recipient" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="position">Position : </label>
          <input type="text" name="position" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="company_name">Company Name : </label>
          <input type="text" name="company_name" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="address">Address : </label>
          <textarea name="address" class="form-control validate"></textarea>
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="address">Country : </label>
          <select name="country" id="country" class="form-control validate">
            <option>Please select a country</option>
            <?php foreach($country_list as $value){ ?>
            <option value="<?php echo $value->countries_id; ?>" data-id="<?php echo $value->tax; ?>"><?php echo $value->countries_name; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="phone">Tel. Number</label>
          <input type="number" name="phone" class="form-control validate">
        </div>
        <div class="md-form mb-4">
          <div class="table-responsive">
          <table class="table table-striped" id="tblProducts">
            <thead>
              <tr>
                <th>No.</th>
                <th>Item Description</th>
                <th>Unit</th>
                <th>Unit Price ($)</th>
                <th>Quantity</th>
                <th>Amount ($)</th>
                <th>--</th>
              </tr>
            </thead>
            <tbody class="opForItems">
                  
                <tr>
                  <td>1</td>
                  <td><input type="text" name="item_description[1]" style="width: 100px;"></td>
                  <td><input type="text"  name="unit[1]"style=" width: 75px;"></td>
                  <td><input type="number" step=".01" class="uclass" name="unit_price[1]" id="unitcal1"style=" width: 75px;"></td>
                  <td><input type="number" step=".01" class="qclass" name="quantity[1]" id="quantcal1"style=" width: 75px;"></td>
                  <td><input type="number" step=".01" class="aclass" name="amount[1]" id="sumcal1"style=" width: 75px;"></td>
                  <td><span class="addItemBtn btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></span></td>
                </tr>
            </tbody>
          </table>
          </div>
        </div>
        
        <p>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">SUB-TOTAL</strong> : <input type="number" step=".01" name="sub_total"> <br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">DISCOUNT</strong> : <input type="number" step=".01" name="discount" id="discount"> <br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">TAX (<span id="taxp"></span> %)</strong> : <input type="number" step=".01" name="tax" id="tax"> <br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">TOTAL</strong> : <input type="number" step=".01" name="total_amount" id="total_amount"> <br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">DUE DATE</strong> : <input type="date" name="due_date"><br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">Please make the cheque payable to</strong> :  <input type="text" name="issued_to"></p>
      
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>  
      </form>

    </div>
  </div>
</div>



<!-- change Status Modal -->
<div class="modal fade" id="statusModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Payment Status</h5>
      </div>
      
      <form method="post" action="<?php echo BASE_URL.'admin/client_invoice_change_status';?>">
      <div class="modal-body mx-3">
        
        <div class="md-form mb-5">
          <input type="radio" id="paid_check" name="paid_check" required>
          <label data-error="wrong" data-success="right" for="paid_check">Paid</label>
        </div>

        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="set_paid_date">Date Paid : </label>
          <input type="date" id="set_paid_date" name="set_paid_date" class="form-control validate" required>
          <input type="hidden" id="client_invoice_id" name="client_invoice_id" class="form-control validate">
        </div>

      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>  
      </form>

    </div>
    </div>
  </div>
</div>

<!-- View invoice Modal -->
<div id="viewModalCenter" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invoice</h4>
        <button onclick="printData()" style="float: left;" type="button" title="Print"><i class="fa fa-print"></i></button>
        <button onclick="emailpopup()" style="float: left;" type="button" title="Email"><i class="fa fa-envelope"></i></button>
      </div>
      <div class="modal-body">
        <p id="view_invoice_content"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- View Email Modal -->
<div id="emailpopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Mail</h4>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" id="emailAdderss" name="email" class="form-control">
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="emailData()" >Send</button>
      </div>
    </div>

  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editClientModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Invoice</h5>
      </div>
      
      <form method="post" action="<?php echo BASE_URL.'admin/edit_client_invoice';?>">
      <div class="modal-body mx-3">
        
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="date">Date : </label>
          <input type="date" name="date" id="edate" class="form-control validate">
          <input type="hidden" name="client_invoice_id" id="einvoice_id" class="form-control">
        </div>

        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="recipient">Name of Person : </label>
          <input type="text" name="recipient" id="erecipient" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="position">Position : </label>
          <input type="text" name="position" id="eposition" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="company_name">Company Name : </label>
          <input type="text" name="company_name" id="ecompany_name" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="address">Address : </label>
          <textarea name="address" id="eaddress" class="form-control validate"></textarea>
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="phone">Tel. Number</label>
          <input type="number" name="phone" id="ephone" class="form-control validate">
        </div>
        <div class="md-form mb-4">
          <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Item Description</th>
                <th>Unit</th>
                <th>Unit Price ($)</th>
                <th>Quantity</th>
                <th>Amount ($)</th>
                <th>--</th>
              </tr>
            </thead>
                  
            <tbody class="opForItems" id="eItemList">
                <tr>
                  <td>1</td>
                  <td><input type="text" name="item_description[1]" style="width: 100px;">
                    <input type="hidden" name="item_id[1]"></td>
                  <td><input type="text"  name="unit[1]" style="width: 12px;"></td>
                  <td><input type="number" step=".01" name="unit_price[1]" style="width: 12px;"></td>
                  <td><input type="number" step=".01" name="quantity[1]" style="width: 12px;"></td>
                  <td><input type="number" step=".01" name="amount[1]" style="width: 12px;"></td>
                  <td><span class="addItemBtn btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></span></td>
                </tr>
            </tbody>
          </table>
          </div>
        </div>
        
        <p>  
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">SUB-TOTAL</strong> : <input type="number" step=".01" name="sub_total" id="esub_total"> <br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">DISCOUNT</strong> : <input type="number" step=".01" name="discount" id="ediscount"> <br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">TAX (<span id="taxp"></span> %)</strong> : <input type="number" step=".01" name="tax" id="etax"> <br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">TOTAL</strong> : <input type="number" step=".01" name="total_amount" id="etotal_amount"> <br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">DUE DATE</strong> : <input type="date" name="edue_date" style="width: 170px;"><br>
          <strong style="display: inline-block; width: 250px; padding-bottom: 10px;">Please make the cheque payable to</strong> :  <input type="text" name="issued_to" id="eissued_to">
        </p>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>  
      </form>

    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
      var max_fields      = 30; //maximum input boxes allowed
      var wrapperItem     = $(".opForItems"); //Fields wrapper
      var add_button_item = $(".addItemBtn"); //Add Item button ID
      
      var y = 1; //initlal text box count
      $('body').on("click",".addItemBtn", function(e){ //on add input button click
          e.preventDefault();
          if(y < max_fields){ //max input box allowed
              y++; //text box increment
            $(wrapperItem).append('<tr class="after-add-more'+ y +'"><td>'+ y +'</td><td><input type="text" name="item_description['+ y +']" style=" width: 100px;"></td><td><input type="text" name="unit['+ y +']" style=" width: 75px;"></td><td><input type="number" step=".01" class="uclass" name="unit_price['+ y +']" style=" width: 75px;"></td><td><input type="number" class="qclass" step=".01" name="quantity['+ y +']" style=" width: 75px;"></td><td><input type="number" class="aclass" step=".01" name="amount['+ y +']" style=" width: 75px;"></td><td><span class="remove_item btn btn-danger pull-right" data-id="'+y+'"><i class="fa fa-minus" aria-hidden="true"></i></span></td></tr>');
          }
      }); 
      $(wrapperItem).on("click", ".remove_item", function() {
        var dataid = $(this).data("id");
        $('.after-add-more'+dataid).remove();
      });

      var tax = 0;
      $('#country').on('change',function(){
        var t = $(this).find(':selected').attr('data-id');
        // console.log(t);
        tax = isNaN(t) ? 0 : t;
        if(tax==null || tax==''){
          tax = 0;
        }
        $('#taxp').html(tax);
      });

      var tblrows = $("#tblProducts tbody tr");
      tblrows.each(function (index) {                         
          var tblrow = $(this);
       
          tblrow.find('.qclass').blur(function () {
          var qty = tblrow.find(".qclass").val();
          var price = tblrow.find(".uclass").val();
          var subTotal = parseInt(qty,10) * parseFloat(price);

          if (!isNaN(subTotal)) {
                tblrow.find('.aclass').val(subTotal.toFixed(2));
                var grandTotal = 0;
             
                $(".aclass").each(function () {
                    var stval = parseFloat($(this).val());
                    grandTotal += isNaN(stval) ? 0 : stval;
                });
             
                $('.total_amount').val(grandTotal.toFixed(2));
                $('.tax').val(tax);
            }          

          });
      });
      
    });

    function delete_item(id){
      var di = confirm('Do you realy want to delete this item!');

      if(di == true){
        $.ajax({
          type: "POST", 
          url: "<?php echo BASE_URL.'admin/delete_invoice_item/'; ?>"+id,
          success: function(result){
            alert(result);
            location.reload();
          }
        });
      }
  }

  function add_client_invoice(){
    $('#addClientModalCenter').modal('show');
  }

  function changeStatus(id,date_paid){
    if(date_paid!=''){
    $('#paid_check').attr('checked','checked');
    $('#set_paid_date').val(date_paid);
    }

    $('#client_invoice_id').val(id);
    $('#statusModalCenter').modal('show');
  }
    
  function viewInvoice(id){
        // $('#viewModalCenter').modal('show');
    $.ajax({
      type: "POST", 
      url: "<?php echo BASE_URL.'admin/get_client_invoice'; ?>", 
      data: { id : id },
      // beforeSend: function () {
      //   $('#view_invoice_content').html("Please wait...");
      // },
      success: function(result){
        // alert(result);
        $('#view_invoice_content').html(result);
        $('#viewModalCenter').modal('show');
      }
    });
  }

  function deleteInvoice(id){
    var c = confirm('Do you want to delete this!');
    if(c==true){
      window.location.href = "<?php echo base_url('admin/delete_client_invoice/');?>"+id;
    }

  }

  function printData(){
    var printContents = document.getElementById('view_invoice_content').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
  
  function emailpopup(){
    $('#emailpopup').modal('show');
    $('#viewModalCenter').modal('hide');
  }

  function emailData(){
    var email = $('#emailAdderss').val();
    var content = document.getElementById('view_invoice_content').innerHTML;
        var to = email;
        var subject = "INVOICE";
         $.ajax({
            type: "POST",
            url: '<?php echo base_url("admin/send_invoice_mail/"); ?>',
            data: { 
                to:to,
                subject:subject,
                content:content
            },
            success: function(result) {
                alert(result);
                
            }
        });
  }

  function editInvoice(id){
    $.ajax({
      type: "POST", 
      url: "<?php echo BASE_URL.'admin/get_one_invoice'; ?>", 
      data: { id : id },
      // beforeSend: function () {
      //   $('#view_invoice_content').html("Please wait...");
      // },
      success: function(result){
        // alert(result);
        var obj = JSON.parse(result);
        console.log(obj);
        $("#edate").val(obj.invoice.date);
        $("#erecipient").val(obj.invoice.recipient);
        $("#eposition").val(obj.invoice.position);
        $("#ecompany_name").val(obj.invoice.company_name);
        $("#eaddress").val(obj.invoice.address);
        $("#ephone").val(obj.invoice.phone);
        $("#etotal_amount").val(obj.invoice.amount);
        $("#esub_total").val(obj.invoice.sub_total);
        $("#edue_date").val(obj.invoice.due_date);
        $("#ediscount").val(obj.invoice.discount);
        $("#etax").val(obj.invoice.tax);
        $("#eissued_to").val(obj.invoice.issued_to);
        $("#einvoice_id").val(obj.invoice.id);

        var results = obj.items;
        var itemhtml ='<div class="sertificate-boxs">';
        var ec = 1;
            for (i in results) {
            x = results[i];
            console.log(x.id);
            itemhtml += '<tr><td>'+ ec +'</td><td><input type="text" value="'+ x.item_description +'" name="item_description['+ ec +']" style=" width: 100px;"><input type="hidden" value="'+ x.id +'" name="item_id['+ ec +']" style=" width: 75px;"></td><td><input type="text" value="'+ x.unit +'" name="unit['+ ec +']" style=" width: 75px;"></td><td><input type="number" step=".01" value="'+ x.unit_price +'" name="unit_price['+ ec +']" style=" width: 75px;"></td><td><input type="number" step=".01" value="'+ x.quantity +'" name="quantity['+ ec +']" style=" width: 75px;"></td><td><input type="number" step=".01" value="'+ x.amount +'" name="amount['+ ec +']" style=" width: 75px;"></td><td><a class="addItemBtn btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a><a onclick="delete_item('+ x.id +')" class="btn btn-danger pull-right"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
            ec++; }
            itemhtml += '</div>';
        $("#eItemList").html(itemhtml);

        $('#editClientModalCenter').modal('show');
      }
    });
  }

  function viewReceipt(id){
        // $('#viewModalCenter').modal('show');
    $.ajax({
      type: "POST", 
      url: "<?php echo BASE_URL.'admin/get_client_receipt'; ?>", 
      data: { id : id },
      // beforeSend: function () {
      //   $('#view_invoice_content').html("Please wait...");
      // },
      success: function(result){
        // alert(result);
        $('#view_invoice_content').html(result);
        $('#viewModalCenter').modal('show');
      }
    });
  }

</script>