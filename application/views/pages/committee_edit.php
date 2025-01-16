    <form method="post" action="<?php echo site_url('provider/training_committee_update'); ?>" enctype="multipart/form-data">
                 
        <input type="hidden" name="idd" value="<?php echo $committee['id']; ?>">
        <input type="hidden" name="tid" value="<?php echo $committee['training_id']; ?>">
        <p>
            <label for="exampleInputEmail1">Committee Member's Name<sup>*</sup></label>
            <input type="text" class="form-control" name="committee_name"  placeholder="Enter committee name" value="<?php echo $committee['committee_name']; ?>"> 
        </p>

        <p>
            <label for="exampleInputEmail1">Designation<sup>*</sup></label>
            <input type="text" class="form-control" name="degination"  placeholder="Enter degination name" value="<?php echo $committee['degination']; ?>">
        </p>

        <p>
            <label for="exampleInputEmail1">Committee Image<sup>*</sup></label>
            <input type="file" class="form-control" name="committee_image">    
        </p>

        <p>
            <button type="submit" name="submit" value="save" class="btn btn-info">Update</button>
        </p>

    </form>