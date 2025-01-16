
  <form method="post" action="<?php echo site_url('provider/training_evaluation_update'); ?>" enctype="multipart/form-data" name="evaluation_update" id="evaluation_update">
     
        <p>
                <label>Select Evaluation Type :</label>
                <input type="hidden" name="idd" value="<?php echo $evaluation[0]['id']; ?>">
                <input type="hidden" name="tid" value="<?php echo $evaluation[0]['training_id']; ?>">
                <input type="radio"  id="evaluation_type" name="evaluation_type" <?php if($evaluation[0]['evaluation_type']=='1'){ echo 'checked'; } ?> value="1">
                <span class="mode-span">Speaker<sup>*</sup></span>
                <input type="radio"  id="evaluation_type" name="evaluation_type" <?php if($evaluation[0]['evaluation_type']=='2'){ echo 'checked'; } ?> value="2">
                <span class="mode-span">Symposium/Training<sup>*</sup></span> 
        </p>

        <p>
                    <label>Select Question Type :</label>
                    <input type="radio" name="question_type" value="1" <?php if($evaluation[0]['question_type']=='1'){ echo 'checked'; } ?> > 
                    <span class="mode-span">Star Rating Question</span>
                    <input type="radio" name="question_type" value="2" <?php if($evaluation[0]['question_type']=='2'){ echo 'checked'; } ?> > 
                    <span class="mode-span">Text Answer Question</span>
        </p>
                        
        <p>
            <label>Evaluation Question :</label>
                <input type="text" class="form-control" id="evaluation_question" name="evaluation_question"  placeholder="Enter Evaluation Question" value="<?php echo $evaluation[0]['evaluation_question']; ?>" > 
        </p>
        <p>
            <button type="submit" class="btn btn-success" name="submit" value="Save_next">Update</button>
        </p>
            
  </form>