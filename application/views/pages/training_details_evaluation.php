<?php $this->load->view('template/search');
 $tid = $this->uri->segment(3); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <?php echo $this->session->flashdata('response');?>
            <div class="col-md-8">
                <?php $this->load->view('template/trainingmenu'); ?>
                <h3 class="border-title text-left pull-left">Evaluation</h3>
                <div class="clear-line"></div>

<div class="content evaluation-panel"> 
    <ul class="nav nav-tabs">

    <?php 
    $training_speakers  = $this->user->get_record_by_field_name_all_record('tbl_training_speaker','training_id',$tid);
    $first_speaker = $training_speakers[0];
    foreach ($training_speakers as $key => $value1) {

          $key = $key+1; 
          if($value1['speaker_image'] !=""){  ?>

        <li onclick="speaker_name('<?php echo $value1['speaker_name']; ?>','<?php echo $value1['id']; ?>')" class="tra <?php if($key==1){ echo "active";} ?>">
            <a data-toggle="tab" href="#menu<?php echo $key; ?>">
                <img style="border-radius: 50%;height: 82px; width: 82px;" src="<?php echo base_url('assets/images/uploads/').$value1['speaker_image']; ?>" alt="speaker-image" style="width: 207px; height: 120px;">
                <p><?php echo $value1['speaker_name']; ?></p>
            </a>
        </li><?php } ?>
    <?php } ?>

        <li onclick="speaker_name('SYMPOSIUM','s_<?php echo $tid; ?>')" class="tra">
            <a data-toggle="tab" href="#menu555"><img src="<?php echo base_url('assets/images/uploads/symposium.png'); ?>" style="border-radius: 50%;height: 82px; width: 82px;" alt="SYMPOSIUM-image">
            <!-- <p>SYMPOSIUM</p> -->
            <p style="width: 85px;text-align: center;">TRAINING</p>
            </a>
        </li>    
    </ul>
</div>
<h3 id="speaker_name"><?php echo $first_speaker; ?></h3>
<div id="commentdata"></div>

<!--     <form action="<?php echo site_url('provider/saverating');?>" method="post" name="frm">
    <?php  $tid = $this->uri->segment(3);
           $evaluation = $this->user->get_record_by_field_name_all_record('tbl_training_evaluation','training_id',$tid); 
          // print_r($evaluation[0]);die; ?>
    <?php foreach ($evaluation as $key => $value){ ?>

      <input type="hidden" name="tid" value="<?php echo $tid;?>">
      <input type="hidden" name="questionid[]" value="<?php echo $value['id'];?>">
      <input type="hidden" name="question_type[]" value="<?php echo $value['question_type'];?>">
    <h5><strong><?php echo $key+1;?>. <?php echo $value['evaluation_question']; ?></strong></h5>
    &nbsp;&nbsp;
    <?php if($value['question_type']==1){ ?>
    <fieldset class="rating">
        <input type="radio" id="field<?php echo $key+1;?>_star5" name="rating<?php echo $value['id'];?>" value="5" /><label class = "full" for="field<?php echo $key+1;?>_star5"></label>

        <input type="radio" id="field<?php echo $key+1;?>_star4" name="rating<?php echo $value['id'];?>" value="4" /><label class = "full" for="field<?php echo $key+1;?>_star4"></label>

        <input type="radio" id="field<?php echo $key+1;?>_star3" name="rating<?php echo $value['id'];?>" value="3" /><label class = "full" for="field<?php echo $key+1;?>_star3"></label>

        <input type="radio" id="field<?php echo $key+1;?>_star2" name="rating<?php echo $value['id'];?>" value="2" /><label class = "full" for="field<?php echo $key+1;?>_star2"></label>

        <input type="radio" id="field<?php echo $key+1;?>_star1" name="rating<?php echo $value['id'];?>" value="1" /><label class = "full" for="field<?php echo $key+1;?>_star1"></label>
        </fieldset>
    <br><br>     
    <?php }else{  ?> 
    <div class="form-group">
        <textarea class="form-control" name="comments[]" id="comments" placeholder="Comments" required></textarea>
    </div> 
    <?php } } ?> 
    <div class="form-group text-right">
    <input type="submit" name="rating" id="rating" value="SUBMIT" class="btn btn-primary btn-lg">
    </div>
    </form> -->

            </div>
            <?php $this->load->view('pages/sidebar'); ?>
        </div>
    </div>
</div> 


  <div id="succespopup" class="modal fade thank-modal-pop-up" role="dialog">
      <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header thank-logo text-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <!-- <h2 class="modal-title">Thank you for your review</h2> -->
                  <img src="<?php echo ASSETS_URL.'images/popup-logo.png'; ?>" alt="logo">
              </div>
              <div class="modal-body thank-modal text-center">
                  <img src="<?php echo ASSETS_URL.'images/thank.jpg'; ?>" alt="Thnaks">
                  <h4>for your time to do the evaluation.</h4>
                  <h4>Your responses will be kept with utmost confidentiality.</h4>
              </div>
          </div>
      </div>
  </div>





 <style type="text/css">
 @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
.rating { 
  border: none;
  float: right;
  margin:0px 0px 0px 28px;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin-top: 2px;
  padding:0px 5px 0px 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
    color: #fff; 
    float: right;
    margin:4px 1px 0px 0px;
    background-color:#D8D8D8;
    border-radius:15px;
  height:25px;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { 
    background-color:#7ED321 !important;
  cursor:pointer;
} /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { 
    background-color:#7ED321 !important;
  cursor:pointer;
} 
.tra.active a { background-color: rgb(188 138 220) !important; }
.evaluation-panel .nav-tabs {
    display:flex;
    flex-wrap: wrap;
  
}
.evaluation-panel .nav-tabs>li{
    width: 20%;
    text-align: center;
    float: none;
}
}

</style>

<script type="text/javascript">
 jQuery(document).ready(function($){  
 // var p = "<?php if($_REQUEST['popup']=='123'){ ?>"+ $('.nav-tabs li.tra a').tab('show');  $('#training_registration').modal('show');  +"<?php } ?>";    
  $("label").click(function(){
  $(this).parent().find("label").css({"background-color": "#D8D8D8"});
  $(this).css({"background-color": "#7ED321"});
  $(this).nextAll().css({"background-color": "#7ED321"});
});      
});

  function speaker_name(speaker_name,idd){
        if(speaker_name=="SYMPOSIUM"){
            types = "symposium";
        }else{
            types = "teacher";
        }
        // $.noConflict();
        $('#speaker_name').html(speaker_name);
        $('#commentdata').html('Please wait...');
        var trid = "<?php echo $tid; ?>";

        $.ajax({
        type: "POST",
        url : "<?php echo base_url('pages/commentdata');?>",
        data: { types:types, trid:trid, idd:idd }
        }).done(function( result ) {
           //alert(result);
        $("#commentdata").html( result );
        });
        return false;
    }
    speaker_name('<?php echo $sdata[0]['speaker_name']; ?>','<?php echo $tid;?>');
</script>