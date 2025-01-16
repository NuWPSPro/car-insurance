<?php   $where = array('training_id'=>$tr_id,'evaluation_type'=>$type);
        $this->db->order_by('id','ASC');
        $evaluation  = $this->user->get_record_by_field_name_all_record11('tbl_training_evaluation',$where);
        $evaluation_note  = $this->db->get_where('tbl_training',array('id'=>$tr_id))->row_array()['evaluation_note'];
        $check_evaluation_exsits  = $this->db->get_where('tbl_training_review',array('user_id'=>$uid,'training_id'=>$tr_id,'speaker_id'=>$idd))->row_array();?>
        <?php if(count($check_evaluation_exsits) > 0){ ?>
        	<div class="form-group mt-5">
        		<label>Thank you for your evaluation.</label>
        	</div>
    <?php  }else{ ?>
    	<div class="front-evaluation-note"><?php echo $evaluation_note; ?></div>
      <div class="rating-modal">
      <form action="<?php echo site_url('pages/saverating'); ?>" method="post" id="evaluationsubmit"> 
          <input type="hidden" name="speaker_id" value="<?php echo $value2['id'];?>">
          <input type="hidden" name="training_id" value="<?php echo $tid;?>">
          <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
          <div class="rating-box">
          <?php foreach ($evaluation as $key => $value) {  ?>
          <input type="hidden" name="questionid[]" value="<?php echo $value['id'];?>">
          <input type="hidden" name="questiontype[]" value="<?php echo $value['question_type'];?>">
              <p><?php echo $key+1;?>.<?php echo $value['evaluation_question']; ?></p>
          <?php if($value['question_type']==1){  ?>
              <div class="rate">
                  <input type="radio" id="field<?php echo $key+1;?>_star5" name="rating[<?php echo $value['id'];?>]" value="5" />
                  <label for="field<?php echo $key+1;?>_star5" title="Excellent">5 stars</label>
                  <input type="radio" id="field<?php echo $key+1;?>_star4" name="rating[<?php echo $value['id'];?>]" value="4" />
                  <label for="field<?php echo $key+1;?>_star4" title="Very Good">4 stars</label>
                  <input type="radio" id="field<?php echo $key+1;?>_star3" name="rating[<?php echo $value['id'];?>]" value="3"  />
                  <label for="field<?php echo $key+1;?>_star3" title="Good" >3 stars</label>
                  <input type="radio" id="field<?php echo $key+1;?>_star2" name="rating[<?php echo $value['id'];?>]" value="2" />
                  <label for="field<?php echo $key+1;?>_star2" title="Fair" >2 stars</label>
                  <input type="radio" id="field<?php echo $key+1;?>_star1" name="rating[<?php echo $value['id'];?>]" value="1" />
                  <label for="field<?php echo $key+1;?>_star1" title="Needs Improvement">1 star</label>
              </div>
          <?php } ?>
          <?php if($value['question_type']==2){  ?>
          <div class="evaluation-comment">
              <input type="text" class="form-control" name="comments[<?php echo $value['id'];?>]" id="comments<?php echo $value['id'];?>" placeholder="Comment Here">
          </div>
          <?php } } ?>
          </div>
          <div class="evulate-btn text-right">
              <a href="#" onclick="checklogin('<?php echo $value2['training_id'];?>','s')" >submit evaluation</a>
          </div>
          </form>
      </div>
	<?php } ?>
<style type="text/css">

.rating-box p {
    margin: 0;
    font-size: 20px;
}
.rating-modal .rate {
    height: 46px;
    padding: 0 10px;
    direction: unset;
    width: 100%;
    display: flex;
    align-items: center;
    flex-direction: row-reverse;
    justify-content: flex-end;
    margin-bottom: 17px;
}
.rating-modal .rate:not(:checked)>input {
    position: absolute;
    visibility: hidden;
}
.rating-modal .rate:not(:checked)>label {
    float: right;
    width: 30px;
    height: 30px;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 27px;
    color: #fff;
    border: 1px solid;
    background-color: #b7b7e5;
    line-height: 27px;
    margin: 0 3px;
    text-align: center;
    padding: 0 2px;
}
.rating-modal .rate>input:checked~label {
    color: #fff;
    background-color: #ffc700;
}
.rating-modal .rate:not(:checked)>label:before {
    content: '★ ';
}
.rating-modal .rate:not(:checked)>label:hover, .rating-modal .rate:not(:checked)>label:hover~label {
    color: #fff;
    background-color: #ffc700;
}
.evulate-btn a {
    padding: 14px 25px;
    text-transform: uppercase;
    font-weight: 500;
    border-radius: 4px;
    background-color: #ee891d;
    color: #fff;
    display: inline-block;
    letter-spacing: 1px;
}
</style>

<script type="text/javascript">
jQuery(document).ready(function($){      
    $("label").click(function(){
        $(this).parent().find("label").css({"background-color": "#D8D8D8"});
        $(this).css({"background-color": "#7ED321"});
        $(this).nextAll().css({"background-color": "#7ED321"});
    });      
});
 	function checklogin(tid){
 	var check = "<?php echo $this->session->userdata('logged_in')['id']; ?>";
 	var role = "<?php echo $this->session->userdata('logged_in')['role']; ?>";
        if(check == ""){
		    $("#evaluatenow_details").modal('hide');
        	$("#login_registration").modal('show');
        }else{
		    $.ajax({
		        url: '<?php echo site_url('pages/check_user_rgistered'); ?>',
		        type: 'POST',
		        data: {
		            check: check, tid: tid
		        },
		        dataType: 'json',
		        success: function(data) {
		        	// alert(data)
					 if(data != undefined && data != null){
					    console.log(data)
					    if(data.user_id > 0){
					        if(data.present_status > 0 && data.present_status == 1){
					            $("#evaluationsubmit").submit(); 
					            
					        }else{
					            alert('It seems like you are not present in the training, Please contact to organizer to do evaluation. ');
					        }
						}else{
		    				$("#evaluatenow_details").modal('hide');
							$("#login_registration").modal('show');
							
						}
					}
		        }
		    });
        }
 	}

</script>
