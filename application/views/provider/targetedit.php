
        <?php
        if($target[0]['category']=='Course'){
            $title = $this->db->get_where('tbl_course',array('id'=>$target[0]['cource_name']))->row_array()['course_title']; 
        }else{
            $title = $this->db->get_where('tbl_training',array('id'=>$target[0]['cource_name']))->row_array()['title']; 
        } ?>
    <input type="hidden" class="form-control" name="cource_id" id="cource_id" value="<?php echo $target[0]['id']; ?>">
        <p>
            <label>Category <span class="required"> * </span> </label>
            <input type="text" readonly name="category_name" value="<?=$target[0]['category'];?>" class="form-control">
            <span class="error"></span>
        </p>

        <p id="target_course">
            <label><?=$target[0]['category'];?> Name <span class="required"> * </span> </label>
            <input type="hidden" readonly name="cource_name" value="<?=$target[0]['cource_name'];?>" class="form-control">
            <input type="text" disabled name="" value="<?=$title;?>" class="form-control">
            
        </p>

         <p>
            <label>Total Staff to be Trained <span class="required"> * </span> </label>
            <input type="number" class="form-control" name="total_staff" id="total_staff" value="<?php echo $target[0]['total_staff']; ?>" min="1" requried >
            <span class="error"></span>
        </p>
          

        <p>
            <label>Target Number to be Trained <span class="required"> * </span> </label>
            <input type="number" class="form-control" name="target_number" id="target_number" value="<?php echo $target[0]['target_number']; ?>" min="1" requried>
            <span class="error"></span>
        </p>

        <p>
            <label>Date of Implementation<span class="required"> * </span> </label>
            <input type="date" class="form-control" name="added_on" id="added_on" value="<?php echo date('Y-m-d',strtotime($target[0]['implementation_date'])); ?>" required>
            <span class="error"></span>
        </p>

        <p class="submit alignleft">
            <input class="btn btn-primary" value="UPDATE" type="submit" name="save">
        </p>

               