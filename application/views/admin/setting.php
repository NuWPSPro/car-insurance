<?php $this->load->view('admin/picture'); 
      $taxrate = $this->db->get_where('tbl_misc',array('status'=>1))->row_array()['set_percentage'];
      $staff = $this->db->get_where('tbl_all_tax',array('id'=>5,'status'=>1))->row_array();
      $tmsfee = $this->db->get_where('tbl_all_tax',array('id'=>6,'status'=>1))->row_array();
      $certificatefee = $this->db->get_where('tbl_all_tax',array('id'=>7,'status'=>1))->row_array();
      ?>
<div class="innerContent admin-settingpanal">
    <div class="container">
    
            <div class="row">
                <?php  $this->load->view('admin/sidebar');  ?>  
                <div class="col-sm-9">
                <h3 class="border-title text-left">Settings</h3>

<form method="post" action="<?php echo BASE_URL.'admin/setting';?>">
<?php echo $this->session->flashdata('response');?> 
  

<div class="form-group">
  <label for="pwd">Template Price ($):</label>
  <input type="number" maxlength="5" class="form-control" id="template_price" name="template_price" required value="<?php echo $misc[0]['template_price'];?>">
  </div>


<!--   <div class="form-group">
  <label for="pwd">Price Certificate ($):</label>
  <input type="number" maxlength="5" class="form-control" id="price_certificate" name="price_certificate" required value="<?php echo $misc[0]['price_certificate'];?>">
  </div>



  <div class="form-group">
  <label for="pwd">Training Publish Price ($):</label>
  <input type="number" maxlength="5" class="form-control" id="training_publish_price" name="training_publish_price" required value="<?php echo $misc[0]['training_publish_price'];?>">
  </div> -->

  <div class="form-group">
  <label for="pwd"> The Portfolio & Video price ($):</label>
  <input type="number" maxlength="5" class="form-control" id="portfolio_video_price" name="portfolio_video_price" required value="<?php echo $misc[0]['portfolio_video_price'];?>">
  </div>




<div class="form-group">
  <label for="pwd">Add Tax (In Percentage):</label>
  <input type="text" class="form-control" id="percentage" name="percentage" required value="<?php echo $misc[0]['set_percentage'];?>">
  </div>

  <div class="form-group">
  <label for="pwd">Target Unit:</label>
  <input type="text" class="form-control" id="unit" name="unit" required value="<?php echo $misc[0]['target_unit'];?>">
  </div>



 <!--  <div class="form-group">
  <label for="pwd">Professional Tutorial Video:</label>
  <input type="text" class="form-control" id="pvideo" name="pvideo" required value="<?php echo $misc[0]['professional_video'];?>">
  </div> -->


 <!--  <div class="form-group">
    <label for="email">Professional Terms of service:</label>
    <textarea class="form-control text_editor" name="pterms" id="pterms" required><?php echo $misc[0]['professional_terms'];?></textarea>
  </div> -->

<!-- 
  <div class="form-group">
  <label for="pwd">Provider Tutorial Video:</label>
  <input type="text" class="form-control" id="video" name="video" required value="<?php echo $misc[0]['video'];?>">
  </div> -->


  <!-- <div class="form-group">
    <label for="email">Provider Terms of service:</label>
    <textarea class="form-control text_editor" name="terms" id="terms" required><?php echo $misc[0]['terms'];?></textarea>
  </div>
  -->
  <button type="submit" class="btn btn-default">Submit</button>
</form>
<hr>

<div class="admin-setting-fildebox">
<h3 class="border-title text-left">Price Certificate Fee</h3>
<?php ?>
<?php echo form_open('admin/price_certificate_fee',['id'=>'certificateForm']);?>
<div class="form-group">
  <div class="d-flex">
  <div style="width: 35%;">
  <label>Price Certificate Fee</label>
  <input type="number" name="base_price" id="certificateprice" step="0.1" class="form-control" placeholder="Please enter price" value="<?php echo $certificatefee['base_price'];?>" required>
  <span id="certificatetax-error"></span>
  </div>
  <div style="width: 35%;  margin-left: 15px;">
  <label for="pwd">Tax (%)</label>
  <input type="number" name="tax_percentage" id="certificatetax" class="form-control" placeholder="Please enter tax in percentages" value="<?php echo $taxrate; ?>" step=".01" readonly>
  <input type="hidden" name="tax_amount" id="certificatetax_amount" value="<?php echo $certificatefee['tax_amount']; ?>">
  </div>
  <div style="width: 30%; margin-left: 15px;">
  <label> Fee + Tax </label>
  <button type="button" class="form-control btn btn-primary" onclick="certificatecalculation()">Calcualte Tax</button>
  </div>
  </div>

  <label for="pwd">Price Certificate Fee with Tax</label>
  <input type="text" maxlength="5" class="form-control" id="certificatetotal_amount" name="total_amount" required value="<?php echo $certificatefee['total_amount'];?>" readonly>
  </div>
    
  <div class="form-group">
   <input type="submit" class="btn btn-primary pull-right" name="certificatesubmit" value="submit">
  </div>
<?php echo form_close();?>
</div>
<hr>

<div class="admin-setting-fildebox">
<h3 class="border-title text-left">TMS Pro Template Fee</h3>
<?php ?>
<?php echo form_open('admin/tmstemplate_fee',['id'=>'tmsForm']);?>
<div class="form-group">
  <div class="d-flex">
  <div style="width: 35%;">
  <label>TMS Pro Template Fee</label>
  <input type="number" name="base_price" id="tmsprice" step="0.1" class="form-control" placeholder="Please enter price" value="<?php echo $tmsfee['base_price'];?>" required>
  <span id="tmstax-error"></span>
  </div>
  <div style="width: 35%;  margin-left: 15px;">
  <label for="pwd">Tax (%)</label>
  <input type="number" name="tax_percentage" id="tmstax" class="form-control" placeholder="Please enter tax in percentages" value="<?php echo $taxrate; ?>" step=".01" readonly>
  <input type="hidden" name="tax_amount" id="tmstax_amount" value="<?php echo $tmsfee['tax_amount']; ?>">
  </div>
  <div style="width: 30%; margin-left: 15px;">
  <label> Fee + Tax </label>
  <button type="button" class="form-control btn btn-primary" onclick="tmstaxcalculation()">Calcualte Tax</button>
  </div>
  </div>

  <label for="pwd">TMS Pro Template Fee with Tax</label>
  <input type="text" maxlength="5" class="form-control" id="tmstotal_amount" name="total_amount" required value="<?php echo $tmsfee['total_amount'];?>" readonly>
  </div>
    
  <div class="form-group">
   <input type="submit" class="btn btn-primary pull-right" name="tmssubmit" value="submit">
  </div>
<?php echo form_close();?>
</div>
<hr>

<div class="admin-setting-fildebox">
<h3 class="border-title text-left">Staff Activation Fee</h3>
<?php ?>
<?php echo form_open('admin/staff_fee');?>
<div class="form-group">
  <div class="d-flex">
  <div style="width: 35%;">
  <label>Staff Activation Fee</label>
  <input type="number" name="base_price" id="price1" step="0.1" class="form-control" placeholder="Please enter price" value="<?php echo $staff['base_price'];?>" required>
  <span id="tax-error1"></span>
  </div>
  <div style="width: 35%;  margin-left: 15px;">
  <label for="pwd">Tax (%)</label>
  <input type="number" name="tax_percentage" id="tax1" class="form-control" placeholder="Please enter tax in percentages" value="<?php echo $taxrate; ?>" step=".01" readonly>
  <input type="hidden" name="tax_amount" id="tax_amount" value="<?php echo $staff['tax_amount']; ?>">
  </div>
  <div style="width: 30%; margin-left: 15px;">
  <label> Fee + Tax </label>
  <button type="button" class="form-control btn btn-primary" onclick="taxcalculation()">Calcualte Tax</button>
  </div>
  </div>

  <label for="pwd">Staff Activation Fee with Tax</label>
  <input type="text" maxlength="5" class="form-control" id="total_amount" name="total_amount" required value="<?php echo $staff['total_amount'];?>" readonly>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary pull-right" name="submit" value="submit">
  </div>
<?php echo form_close();?>
</div>

              
    </div> 
    </div>
	</div>
	</div>
</div>

<script>
  function certificatecalculation(){
    var price = $('#certificateprice').val();
    var tax   = $('#certificatetax').val();

    if(price=='' || tax==''){
        $('#certificatetax-error').html('Please fill the Fee and Tax.').css('color','red');
    }else{
        var taxrate  = ((price * tax)/100).toFixed(2);
        var total    =  parseFloat(price) +  parseFloat(taxrate);

        $('#certificatetax_amount').val(taxrate);
        $('#certificatetotal_amount').val(total);
    }
  }
  function tmstaxcalculation(){
    var price = $('#tmsprice').val();
    var tax   = $('#tmstax').val();

    if(price=='' || tax==''){
        $('#tmstax-error').html('Please fill the Fee and Tax.').css('color','red');
    }else{
        var taxrate  = ((price * tax)/100).toFixed(2);
        var total    =  parseFloat(price) +  parseFloat(taxrate);

        $('#tmstax_amount').val(taxrate);
        $('#tmstotal_amount').val(total);
    }
  }

  function taxcalculation(){
    var price = $('#price1').val();
    var tax   = $('#tax1').val();

    if(price=='' || tax==''){
        $('#tax-error1').html('Please fill the Fee and Tax.').css('color','red');
    }else{
        var taxrate  = ((price * tax)/100).toFixed(2);
        var total    =  parseFloat(price) +  parseFloat(taxrate);

        $('#tax_amount').val(taxrate);
        $('#total_amount').val(total);
    }
  }
</script>