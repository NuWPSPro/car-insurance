<?php $this->load->view('template/picture_provider');
      $uemail = $this->session->userdata('logged_in')['username']; 
      $uid = $this->session->userdata('logged_in')['id']; ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
        <?php $this->load->view('provider/sidebar'); ?>

    <div class="col-sm-9">
        <?php echo $this->session->flashdata('response');?>
        <div class="card">
            <div class="card-header">
                <h3 class="border-title text-left">Connect To RBoard</h3>
            </div>

            <div class="card-body">
                <form action="<?php echo current_url();?>" method="post" id="formconnect" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <div class="alert alert-danger" style="display:none;" id="error"></div>
                        <div class="form-group">
                           <!-- <?php echo '<pre>'; print_r($connected_rboard); ?> -->
                            <label>Please Select Regulatory Board</label> 
                            <select name="rboard" id="rboard" class="form-control" required>
                                <option value="0">Choose Rboard</option>
                                <?php foreach($rboard_list as $value){ ?>
                                <option  data-id="<?=$value['id'];?>"  value="<?=$value['rb_id'];?>" data-domain="<?=$value['website'];?>" <?php if($connected_rboard->rboard_id == $value['id']){ echo 'selected'; } ?>><?=$value['name'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <span id="rboard_code" style="display: none;">
                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <label>Enter RBoard code </label>
                                <input type="text" name="rboard_code" class="form-control" value="" required> 
                            </div>
                        </div> -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Enter Unique CPD Code <span class="text-danger">*</span></label>
                                <input type="text" name="cpd_code" id="cpd_code" class="form-control" value="" required> 
                            </div>
                        </div>
                    </span>
                    <p class="col-sm-12 submit alignleft">
                        <input type="hidden" name="user_id" value="<?php echo $uid; ?>"> 
                        <input type="hidden" name="user_email" id="user_email"  value="<?php echo $uemail; ?>"> 
                        <input type="hidden" name="domain" id="domain" value=""> 
                        <input type="hidden" name="rboard_id" id="rboard_id" value=""> 
                        <!-- <input class="btn btn-primary" value="Submit" type="submit" name="submit"> -->
                        <input class="btn btn-primary" value="Submit"  id="ConnectToRBoard" type="button" name="submit">
                    </p>
                </div>
                </form>

                <?php if(isset($connected_rboard) && $connected_rboard->rboard_id){ ?>
                    <div class="jumbotron text-center">
                        <h1 class="display-4"><i class="text-success">Congratulations!</i></h1>
                        <p class="lead">You are successfully connected with <b><?=$connected_rboard->rboard_name?></p>
                        <hr class="my-4">
                        <p>Now your user's certificate will send to <?=$connected_rboard->rboard_name?> automatically.</p>
                    </div>
                <?php } ?>

            </div>
        </div>
               
     </div>
                        
          
        </div>
    </div>
</div>


<!--Modal: CEP modalPush-->
<div class="modal fade" id="congoModalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-info" role="document">
    <div class="modal-content text-center">
      <div class="modal-body">

        <?php if(isset($connected_rboard) && $connected_rboard->rboard_id){ ?>
            <div class="jumbotron text-center mb-0">
                <h1 class="display-4"><i class="text-success">Congratulations!</i></h1>
                <p class="lead">You are successfully connected with <b><?=$connected_rboard->rboard_name?></p>
                <hr class="my-4">
                <p>Now your user's certificate will send to <?=$connected_rboard->rboard_name?> automatically.</p>
            </div>
        <?php } ?>

      </div>
    </div>
  </div>
</div>
<!--Modal: modalPush-->   
    
<script type="text/javascript">
$('#ConnectToRBoard').on('click',function(){
    var email = $('#user_email').val();
    var cpd_code = $('#cpd_code').val();
    var rbid = $(this).find(':selected').attr('data-id');
    var domain = $(this).find(':selected').attr('data-domain');
    if(cpd_code != ''){
        $.ajax({
            type: "POST",
            // url: domain +'admin/api/validateProfessionalCode',
            url: 'https://ceonpoint.com/RBoard/admin/api/validateCPDCode',
            dataType: 'json',
            data: { email : email , cpd_code : cpd_code },
                success: function(result) {
                    // console.log(result);
                    if(result.error == true){
                        $('#error').html(result.msg).show();
                    }
                    if(result.error == false && result.code == 200){
                        $('#formconnect').submit();
                    }
                }
            });
    }else{
        alert('Please Enter CPD Code!');
    }
  });

  $('#rboard').on('change',function(){
      var value = $(this).find(':selected').attr('data-id');
      if(value > 0){
        var domain = $(this).find(':selected').attr('data-domain');
        $('#rboard_code').show();
        $('#rboard_id').val(value);
        $('#domain').val(domain);
      }else{
        $('#rboard_code').hide();
        $('#rboard_id').val('');
        $('#domain').val('');
      }
  });

  function showCongratulationsPop(){
    $('#congoModalShow').modal('show');
  }

</script>