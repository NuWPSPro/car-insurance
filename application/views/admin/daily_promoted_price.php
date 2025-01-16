<?php $this->load->view('admin/picture'); 
      $taxrate = $this->db->get_where('tbl_misc',array('status'=>1))->row_array()['set_percentage'];
      $providertax = $this->db->get_where('tbl_all_tax',array('id'=>1,'status'=>1))->row_array(); 
      $trainingtax = $this->db->get_where('tbl_all_tax',array('id'=>2,'status'=>1))->row_array();
      $coursetax = $this->db->get_where('tbl_all_tax',array('id'=>3,'status'=>1))->row_array(); 
      $professionaltax = $this->db->get_where('tbl_all_tax',array('id'=>4,'status'=>1))->row_array();  ?>
<div class="innerContent admin-daily_promoted_pricepanel">
	<div class="container">
  
      <div class="row">
       <?php  $this->load->view('admin/sidebar');  ?>  
        <div class="col-sm-9">
            
            <h3 class="border-title text-left">Daily Price Setting </h3>
            <?php echo $this->session->flashdata('response'); ?>
            <div class="row">
              <div class="col-md-12">
                <div class="panel-group" id="accordion1">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1" class="" aria-expanded="true">Provider Daily Price ($)</a></h4> 
                    </div>
                       
                    <div id="collapse1" class="panel-collapse collapse" aria-expanded="true" style="">
                      <div class="panel-body"> 
                        <div class="lesson-details">
                          <form method="post" action="<?php echo BASE_URL.'admin/daily_promoted_price';?>"  enctype="multipart/form-data">
                        <div class="form-group">
                          <div class="d-flex">
                          <div style="width: 35%;">
                          <label for="pwd">Price ($)</label>
                          <input type="number" name="provider_base_price" id="price1" class="form-control" placeholder="Please enter price" value="<?php echo $providertax['base_price'];?>" required>
                          <span id="tax-error1"></span>
                          </div>
                          <div style="width: 35%;  margin-left: 15px;">
                          <label for="pwd">Tax (%)</label>
                          <input type="number" name="tax_on_provider" id="tax1" class="form-control" placeholder="Please enter tax in percentages" value="<?php echo $taxrate; ?>" step=".01" readonly>
                          <input type="hidden" name="taxamount_on_provider" id="tax_amount_provider" value="<?php echo $providertax['tax_amount']; ?>">
                          </div>
                          <div style="width: 30%; margin-left: 15px;">
                          <label> Price + Tax </label>
                          <button type="button" class="form-control btn btn-primary" onclick="taxcalculation1()">Calcualte Tax</button>
                          </div>
                          </div>

                          <label for="pwd">Provider Daily Price ($):</label>
                          <input type="text" maxlength="5" class="form-control" id="provider_daily_price" name="provider_daily_price" required value="<?php echo $providertax['total_amount'];?>" readonly>
                         

                          <label for="pwd">Description</label>
                          <textarea name="text_provider" class="form-control text_editor" required placeholder="Please description it here"> <?php echo $providertax['text'];?> </textarea>

                          <label for="pwd">Provider Promotion Image:</label>
                          <input type="file" class="form-control" id="providerimage" name="providerimage" >
                        </div>
                          <input type="submit" class="btn btn-primary pull-right" name="submit" value="submit">
                          </form>
                          <?php if($providertax['image']!=''){ ?>
                          <div class="img-templatebox">
                            <img src="<?php echo ASSETS_URL.'images/uploads/'.$providertax['image']; ?>" alt="Provider image">
                          </div>
                          <?php } ?>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel-group" id="accordion2">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse2" class="" aria-expanded="true">Training Daily Price ($)</a></h4>
                    </div>
                       
                    <div id="collapse2" class="panel-collapse collapse" aria-expanded="true" style="">
                      <div class="panel-body"> 
                        <div class="lesson-details">
                          <form method="post" action="<?php echo BASE_URL.'admin/daily_promoted_price';?>"  enctype="multipart/form-data">
                          <div class="form-group">
                          <div class="d-flex">
                          <div style="width: 35%;">
                          <label for="pwd">Price ($)</label>
                          <input type="number" name="training_base_price" id="price2" class="form-control" value="<?php echo $trainingtax['base_price'];?>" placeholder="Please enter price" required>
                          <span id="tax-error2"></span>
                          </div>
                          <div style="width: 35%;  margin-left: 15px;">
                          <label for="pwd">Tax (%)</label>
                          <input type="number" name="tax_on_training" id="tax2" class="form-control" placeholder="Please enter tax in percentages" value="<?php echo $taxrate; ?>" step=".01" readonly>
                          <input type="hidden" name="taxamount_on_training" id="tax_amount" value="<?php echo $trainingtax['tax_amount']; ?>">
                          </div>
                          <div style="width: 30%; margin-left: 15px;">
                          <label> Price + Tax </label>
                          <button type="button" class="form-control btn btn-primary" onclick="taxcalculation2()">Calcualte Tax</button>
                          </div>
                          </div>

                          <label for="pwd">Training Daily Price ($)</label>
                          <input type="text" maxlength="5" class="form-control" id="training_daily_price" name="training_daily_price" value="<?php echo $trainingtax['total_amount'];?>" readonly>
                        

                          <label for="pwd">Description</label>
                          <textarea name="text_training" class="form-control text_editor" required placeholder="Please description it here"> <?php echo $trainingtax['text'];?> </textarea>
                          
                          <label for="pwd">Training Promotion Image:</label>
                          <input type="file" class="form-control" id="trainingimage" name="trainingimage" >
                          </div>
                          <input type="submit" class="btn btn-primary pull-right" name="submit" value="submit">
                          </form>
                          <?php if($trainingtax['image']!=''){ ?>
                          <div class="img-templatebox">
                            <img src="<?php echo ASSETS_URL.'images/uploads/'.$trainingtax['image']; ?>" alt="Provider image">
                          </div>
                          <?php } ?>
                        </div> 
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel-group" id="accordion3">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion3" href="#collapse3" class="" aria-expanded="true">Courses Daily Price ($) </a></h4>
                    </div>
                       
                    <div id="collapse3" class="panel-collapse collapse" aria-expanded="true" style="">
                      <div class="panel-body"> 
                        <div class="lesson-details">
                          <form method="post" action="<?php echo BASE_URL.'admin/daily_promoted_price';?>"  enctype="multipart/form-data">
                          <div class="form-group">
                          <div class="d-flex">
                          <div style="width: 35%;">
                          <label for="pwd">Price ($)</label>
                          <input type="number" name="course_base_price" id="price3" class="form-control" value="<?php echo $coursetax['base_price'];?>" placeholder="Please enter price" required>
                          <span id="tax-error3"></span>
                          </div>
                          <div style="width: 35%;  margin-left: 15px;">
                          <label for="pwd">Tax (%)</label>
                          <input type="number" name="tax_on_course" id="tax3" class="form-control" placeholder="Please enter tax in percentages" value="<?php echo $taxrate; ?>" step=".01" readonly>
                          <input type="hidden" name="taxamount_on_course" id="tax_amount_course" value="<?php echo $coursetax['tax_amount']; ?>">
                          </div>
                          <div style="width: 30%; margin-left: 15px;">
                          <label> Price + Tax </label>
                          <button type="button" class="form-control btn btn-primary" onclick="taxcalculation3()">Calcualte Tax</button>
                          </div>
                          </div>
                          <label for="pwd">Courses Daily Price ($):</label>
                          <input type="text" maxlength="5" class="form-control" id="courses_daily_price" name="courses_daily_price" value="<?php echo $coursetax['total_amount'];?>" readonly>
                         
                          <label for="pwd">Description</label>
                          <textarea name="text_course" class="form-control text_editor" required placeholder="Please description it here"> <?php echo $coursetax['text'];?> </textarea>

                          <label for="pwd">Courses Promotion Image:</label>
                          <input type="file" class="form-control" id="coursesimage" name="coursesimage" >
                          </div>
                          <input type="submit" class="btn btn-primary pull-right" name="submit" value="submit">
                          </form>
                          <?php if($coursetax['image']!=''){ ?>
                          <div class="img-templatebox">
                            <img src="<?php echo ASSETS_URL.'images/uploads/'.$coursetax['image']; ?>" alt="Provider image">
                          </div>
                          <?php } ?>
                        </div> 
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel-group" id="accordion4">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion4" href="#collapse4" class="" aria-expanded="true">Professional Daily Price ($)</a></h4>
                    </div>
                       
                    <div id="collapse4" class="panel-collapse collapse" aria-expanded="true" style="">
                      <div class="panel-body"> 
                        <div class="lesson-details">
                          <form method="post" action="<?php echo BASE_URL.'admin/daily_promoted_price';?>"  enctype="multipart/form-data">
                          <div class="form-group">
                         

                          <div class="d-flex">
                          <div style="width: 35%;">
                          <label for="pwd">Price ($)</label>
                          <input type="number" name="prof_base_price" id="price4" class="form-control" value="<?php echo $professionaltax['base_price'];?>" placeholder="Please enter price" required>
                          <span id="tax-error"></span>
                          </div>
                          <div style="width: 35%;  margin-left: 15px;">
                          <label for="pwd">Tax (%)</label>
                          <input type="number" name="tax_on_professional" id="tax4" class="form-control" placeholder="Please enter tax in percentages" value="<?php echo $taxrate; ?>" step=".01" readonly>
                          <input type="hidden" name="taxamount_on_professional" id="tax_amount_professional" value="<?php echo $professionaltax['tax_amount']; ?>">
                          </div>
                          <div style="width: 30%; margin-left: 15px;">
                          <label> Price + Tax($) </label>
                          <button type="button" class="form-control btn btn-primary" onclick="taxcalculation4()">Calcualte Tax</button>
                          </div>
                          </div>

                          <label for="pwd">Professional Daily Price ($):</label>
                          <input type="text" maxlength="5" class="form-control" id="professional_daily_price" name="professional_daily_price" value="<?php echo $professionaltax['total_amount'];?>" readonly>

                          <label for="pwd">Description</label>
                          <textarea name="text_professional" class="form-control text_editor" required placeholder="Please description it here"> <?php echo $professionaltax['text'];?> </textarea>
                          
                          <label for="pwd">Professional Promotion Image:</label>
                          <input type="file" class="form-control" id="professionalimage" name="professionalimage" >
                          </div>
                          <input type="submit" class="btn btn-primary pull-right" name="submit" value="submit">
                          </form>
                          <?php if($professionaltax['image']!=''){ ?>
                          <div class="img-templatebox">
                          <img src="<?php echo ASSETS_URL.'images/uploads/'.$professionaltax['image']; ?>" alt="Provider image">
                          </div>
                          <?php } ?>
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
</div>

<style type="text/css">
  table#text_provider_tbl{
    width: 100% !important;
  } 
  table#text_training_tbl{
    width: 100% !important;
  } 
  table#text_course_tbl{
    width: 100% !important;
  } 
  table#text_professional_tbl{
    width: 100% !important;
  }
</style>

<script>
  function taxcalculation1(){
    var price = $('#price1').val();
    var tax   = $('#tax1').val();
    // alert(price+'*'+tax);
    if(price=='' || tax==''){
        $('#tax-error1').html('Please fill the price and tax.').css('color','red');
    }else{
        var taxrate  = ((price * tax)/100).toFixed(2);
        // var taxrate  =  tax;
        var total    =  parseFloat(price) +  parseFloat(taxrate);

        // $('#tax1').val(taxrate);
        $('#tax_amount_provider').val(taxrate);
        $('#provider_daily_price').val(total);
    }
  }
  function taxcalculation2(){
    var price   = $('#price2').val();
    var tax   = $('#tax2').val();
    if(price=='' || tax==''){
        $('#tax-error2').html('Please fill the price and tax.').css('color','red');
    }else{
        var taxrate  = ((price * tax)/100).toFixed(2);
         // var taxrate  =  tax;
        var total    =  parseFloat(price) +  parseFloat(taxrate);
         $('#tax_amount_training').val(taxrate);
        $('#training_daily_price').val(total);
    }
  }
  function taxcalculation3(){
    var price   = $('#price3').val();
    var tax   = $('#tax3').val();
    if(price=='' || tax==''){
        $('#tax-error3').html('Please fill the price and tax.').css('color','red');
    }else{
        var taxrate  = ((price * tax)/100).toFixed(2);
         // var taxrate  =  tax;
        var total    =  parseFloat(price) +  parseFloat(taxrate);
        $('#tax_amount_course').val(taxrate);
        $('#courses_daily_price').val(total);
    }
  }
  function taxcalculation4(){
    var price   = $('#price4').val();
    var tax   = $('#tax4').val();
    if(price=='' || tax==''){
        $('#tax-error4').html('Please fill the price and tax.').css('color','red');
    }else{
        var taxrate  = ((price * tax)/100).toFixed(2);
         // var taxrate  =  tax;
        var total    =  parseFloat(price) +  parseFloat(taxrate);
        $('#tax_amount_professional').val(taxrate);
        $('#professional_daily_price').val(total);
    }
  }
</script>