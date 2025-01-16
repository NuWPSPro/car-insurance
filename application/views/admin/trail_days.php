<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-trail-dayspanal">
	<div class="container">
  
      <div class="row">
       <?php  $this->load->view('admin/sidebar');  ?>  
            <div class="col-sm-9">
                <h3 class="border-title text-left"><?php if($this->uri->segment(3)==''){ echo 'Countrywise Trial Days'; }else{ echo 'Edit Countrywise Trial Days';} ?></h3>
                <span>This functionality reflects over professional pakages <b>PCE-MS : PRO VERSION FREE TRIAL</b> Country Wise.</span>
                <?php if(empty($trail_edit['ctry_id'])){ $link = BASE_URL.'admin/countrywise_trail_days'; }else{ $link = BASE_URL.'admin/trailedit/'.$trail_edit['ctry_id']; }?>
                <form method="post" action="<?php echo $link;?>">
                <?php echo $this->session->flashdata('response');?> 

                <div class="form-group">
                  <label for="pwd">Country:</label>
                    <select class="form-control" name="country">
                      <option value="" >Please Select Country</option>
                      <?php foreach($country as $countries){ ?>
                        <option value="<?=$countries['countries_id'];?>" <?php if($countries['countries_id']==$trail_edit['country_id']){echo 'selected';} ?> ><?=$countries['countries_name'];?></option><?php } ?>
                    </select>
                    <span class="error" style="color: red;"><?php echo  form_error('country'); ?></span>
                </div>

                <div class="form-group">
                  <label for="pwd">No. of Trial Days </label>
                  <input type="number" name="trail_days" min="0" class="form-control" id="trail_days" required value="<?=$trail_edit['trail_days'];?>">
                  <input type="hidden" name="id" value="<?=$trail_edit['ctry_id'];?>">
                </div>

                <button type="submit" name="submit" class="btn btn-default">Submit</button>
                </form> 
            </div> 
            <?php if($this->uri->segment(3)==''){ ?>
            <div class="col-sm-8">
              <h4> List Of Trial Days</h4>
              <?php if(count($trail_days)>0){ ?>
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Sl.no.</th>
                    <th>Country Name</th>
                    <th>Trial Days</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                    <?php $count=1;
                    foreach($trail_days as $value){ ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $value['countries_name'];?></td>
                      <td><?php echo $value['trail_days'];?></td>
                      <td colspan="3">
                        <a href="<?php echo BASE_URL.'admin/trailedit/'.$value['ctry_id']; ?>" class="btn btn-primary" onclick="return confirm('Are you sure, Do you want to edit this!')" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo BASE_URL.'admin/traildelete/'.$value['ctry_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure, Do you want to DELETE this!')" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $count++; } ?>
                  </tbody>
              </table>
            </div>
              <?php }else{ echo'<center>No Data Found!</center>';}?>
            </div>
          <?php } ?>
    </div>
	</div>
</div>