        <form method="post" action="<?php echo site_url('provider/training_sponsors_update'); ?>" enctype="multipart/form-data">
                <input type="hidden" name="idd" id="idd" value="<?php echo $sponsor['id']; ?>">
                <input type="hidden" name="tid" id="tid" value="<?php echo $sponsor['training_id']; ?>">
                <p>
                    <label for="exampleInputEmail1">Sponsor Name<sup>*</sup></label>
                    <input type="text" class="form-control" name="sponsors_name"  placeholder="Enter sponsor name" value="<?php echo $sponsor['sponsors_name']; ?>"> 
                </p>
           
                <p>
                    <label for="exampleInputEmail1">Website<sup>*</sup></label>
                    <input type="url" class="form-control" name="urls"  placeholder="Enter sponsor url" value="<?php echo $sponsor['urls']; ?>"> 
                </p>
            
                <p>
                    <label for="exampleInputEmail1">Sponsor Image<sup>*</sup></label>
                    <input type="file" class="form-control" name="sponsors_image"> 
                </p>
                <p> 
                    <button type="submit" class="btn btn-primary" name="submit" value="update">Update</button> 
                </p>
         
        </form>