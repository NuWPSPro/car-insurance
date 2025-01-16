<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-faqpanal">
	<div class="container">
  
      <div class="row">
       <?php  $this->load->view('admin/sidebar');  ?>  
            <div class="col-sm-9">
                <h3 class="border-title text-left">Frequently Asked Questions (FAQ)</h3>
                <?php echo $this->session->flashdata('response');?>

                <?php echo form_open_multipart('admin/faq');  ?>
                <?php echo form_hidden('id', isset($edit['id'])?$edit['id']:'');?>

                <div class="form-group">
                  <label for="pwd">Role</label>
                  <select name="role" class="form-control" id="role" required>
                    <option value="" <?php if($edit['role']==''){ echo 'selected'; }?>>Choose a Role</option>
                    <option value="1" <?php if($edit['role']==1){ echo 'selected'; }?> >Professional</option>
                    <option value="2" <?php if($edit['role']==2){ echo 'selected'; } ?> >CEP Providers & Authors</option>
                    <option value="5" <?php if($edit['role']==5){ echo 'selected'; } ?> >Author(s) Under Ceonpoint</option>
                    <option value="3" <?php if($edit['role']==3){ echo 'selected'; } ?> >Institution</option>
                    <option value="4" <?php if($edit['role']==4){ echo 'selected'; } ?> >RBoard</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="pwd">Question</label>
                  <input type="text" name="question" class="form-control" id="question" required value="<?php echo isset($edit['question'])?$edit['question']:''; ?>">
                </div>

                <div class="form-group admin-texteditbox">
                  <label for="pwd">Answer</label>
                  <textarea name="answer" id="answer" class="form-control text_editor"><?php echo isset($edit['answer'])?$edit['answer']:''; ?></textarea>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
                <?php echo form_close(); ?>
            </div> 

            <div class="col-sm-9">
              <h4> List Of FAQ's</h4>
              <div class="row">
              <?php echo form_open('admin/faq',['method'=>'get']); ?>
              <div class="form-group col-sm-4">
                <select name="role" class="form-control">
                  <option value="">Select role</option>
                  <option value="1">Professional</option>
                  <option value="2">CEP and Author</option>
                  <option value="5">Author(s) Under Ceonpoint</option>
                  <option value="3">Institution</option>
                  <option value="4">RBoard</option>
                </select>
              </div>
              <div class="form-group col-sm-4">
                <input type="text" name="question" value="" placeholder="Enter question" class="form-control">
              </div>
              <div class="form-group col-sm-4">
                <input type="submit" name="submit" value="Search" class="btn btn-primary mr-2"> 
                <a href="<?php echo base_url('admin/faq'); ?>" class="btn btn-primary">Reset</a>
              </div>
              <?php echo form_close(); ?>
              </div>
              <?php if(count($faq_list)>0){ ?>
              <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="example">
                <thead>
                  <tr>
                    <th>Sl.no.</th>
                    <th>Role</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Added date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                    <?php $count=1;
                    foreach($faq_list as $value){ 
                      if($value['role']==1){
                        $role = 'Professional'; 
                      }elseif($value['role']==2){ 
                        $role = 'CEP Providers & Authors'; 
                      }elseif($value['role']==3){
                        $role = 'Institution'; 
                      }elseif($value['role']==5){
                        $role = 'Author(s) Under Ceonpoint'; 
                      }else{
                        $role = 'RBoard'; 
                      } ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $role;?></td>
                      <td><?php echo $value['question'];?></td>
                      <td><?php echo strip_tags($value['answer']); ?></td>
                      <td><?php echo $value['added_on'];?></td>
                      <td colspan="3">
                        <a href="<?php echo BASE_URL.'admin/faq/'.$value['id']; ?>" class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo BASE_URL.'admin/faq_delete/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure, Do you want to DELETE this!')" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $count++; } ?>
                  </tbody>
              </table>
             </div>
              <?php }else{ echo'<center>No Data Found!</center>';}?>
            </div>
    </div>
	</div>
</div>

