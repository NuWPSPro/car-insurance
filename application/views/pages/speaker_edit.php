<form method="post" action="<?php echo site_url('provider/training_schedule_update'); ?>" enctype="multipart/form-data" name="speakerform" id="speakerform">

      <input type="hidden" name="tid1" id="tid1" value="<?php echo $schedule[0]['id']; ?>">
      <input type="hidden" name="training_id" id="training_id" value="<?php echo $training_id;?>">



         <div class="form-group">
          
          <?php echo $this->session->flashdata('response');?>

        

        <label for="exampleInputEmail1">Schedule Date<sup>*</sup></label>
        <input type="text" class="form-control datepicker" id="schedule_date1" name="schedule_date1" required placeholder="Schedule Date" value="<?php echo $schedule[0]['schedule_date']; ?>"> 
      </div> 

      <div class="form-group">
        <label for="exampleInputEmail1">Schedule Start Time<sup>*</sup></label>
        <input type="time" class="form-control" id="schedule_start_time1" name="schedule_start_time1" required value="<?php echo $schedule[0]['schedule_start_time']; ?>"> 
      </div>   

      <div class="form-group">
        <label for="exampleInputEmail1">Schedule End Time<sup>*</sup></label>
        <input type="time" class="form-control" id="schedule_end_time1" name="schedule_end_time1" required value="<?php echo $schedule[0]['schedule_end_time']; ?>"> 
      </div>  


        <div class="form-group">
        <label for="exampleInputEmail1">Topic/Event<sup>*</sup></label>
        <input type="text" class="form-control" id="topic1" name="topic1" required placeholder="Topic" value="<?php echo $schedule[0]['topic']; ?>"> 
      </div> 



      <div class="form-group">
         
        <label for="exampleInputEmail1">Speaker/Person<sup>*</sup></label>
       <select class="form-control" id="speaker1" name="speaker1" required onchange="others11()">
             <option value="" selected>Please Select</option> 
             <?php 
             foreach ($speaker as $key => $value) {
                if($value['id']==$schedule[0]['speaker_id']){ $display = 'display: none'; $selected = ''; }else{ $display = ''; $selected = 'selected'; }?>
            
             <option <?php  if($value['id']==$schedule[0]['speaker_id']){ echo 'selected'; } ?> value="<?php echo $value['id'];?>"><?php echo $value['speaker_name'];?></option> 
             <?php } ?>
         <option <?=$selected?> value="0">Others</option> 
       </select> 
           <br>
            <input style="<?=$display?>" type="text" class="form-control" id="others1" name="others1" placeholder="Others"   value="<?php echo $schedule[0]['speaker_name']; ?>"> 
      </div>

      <button type="submit" class="btn btn-primary">Update Schedule</button>
    </form>





<script type="text/javascript">
    function others11(){
        var speaker1 = $('#speaker1').val();
   
        if(speaker1==0){
            $('#others1').show();
        } else {
            $('#others1').hide();
        }
    }
</script>
