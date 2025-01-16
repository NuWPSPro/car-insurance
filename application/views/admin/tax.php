<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-taxpanal">
	<div class="container">
      
      <div class="row">
       <?php  $this->load->view('admin/sidebar');  ?>  
            <div class="col-sm-9">

                <h3 class="border-title text-left"><?php if($this->uri->segment(3)==''){ echo 'Tax'; }else{ echo 'Edit TAX';} ?> </h3>
               
                <?php if(empty($tax_edit['countries_id'])){ $link = BASE_URL.'admin/tax'; }else{ $link = BASE_URL.'admin/taxedit/'.$tax_edit['countries_id']; }?>
                <form method="post" action="<?php echo $link;?>">
                <?php echo $this->session->flashdata('response');?> 

                <div class="form-group">
                  <label for="pwd">Country:</label>
                    <select class="form-control" name="countries_id">
                      <option value="" >Please Select Country</option>
                      <?php foreach($country as $countries){ ?>
                        <option value="<?=$countries['countries_id'];?>" <?php if($countries['countries_id']==$tax_edit['countries_id']){echo 'selected';} ?> ><?=$countries['countries_name'];?></option><?php } ?>
                    </select>
                    <span class="error" style="color: red;"><?php echo  form_error('country'); ?></span>
                </div>

                <div class="form-group">
                  <label for="pwd"> Add Tax (In Percentage): </label>
                  <input type="number" name="tax" min="0" step=".01" class="form-control" id="tax" required value="<?=$tax_edit['tax'];?>">
				  <span class="error" style="color: red;"><?php echo  form_error('tax'); ?></span>
                </div>

                <button type="submit" name="submit" class="btn btn-default">Submit</button>
                </form> 
            </div> 
            <?php  if($this->uri->segment(3)==''){ ?>
            <div class="col-sm-9">
              <h4> List Of Tax</h4>
              <?php if(count($trail_days)>0){ ?>
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Sl.no.</th>
                    <th>Country Name</th>
                    <th>Tax</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                    <?php $count=1;
                    foreach($trail_days as $value){ ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $value['countries_name'];?></td>
                      <td><?php echo $value['tax'];?> %</td>
                      <td colspan="3">
                        <a href="<?php echo BASE_URL.'admin/taxedit/'.$value['countries_id']; ?>" class="btn btn-primary"  title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo BASE_URL.'admin/taxdelete/'.$value['countries_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure, Do you want to DELETE this!')" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $count++; } ?>
                  </tbody>
              </table>
            </div>
              <?php }else{ echo'<center>No Data Found!</center>';}?>
            </div>
          <?php }?>
    </div>
	</div>
</div>