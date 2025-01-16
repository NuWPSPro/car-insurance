<?php $this->load->view('admin/picture'); ?>
<style type="text/css">
  .nav-tabs>li>a{
      font-size: 11px;
      font-weight: 600;
  }
  .froala-box {
    position: relative;
    height: 350px;
    overflow: auto;
  }
  .nav-tabs.tutorial-tab>li.active>a {
  background: #00f;
  color: #fff;
  }
 
</style>
<div class="innerContent admin-termspanal">
  <div class="container">
  <a class="dashboard-btn" href="https://www.ceonpoint.com/admin/dashboard">Dashboard</a>
    <div class="row">
      <?php  $this->load->view('admin/sidebar');  ?>  
      <div class="col-sm-9">
          <h3 class="border-title text-left">Terms & Conditions</h3>
          <?php echo $this->session->flashdata('response'); ?>
          <ul class="nav nav-tabs tutorial-tab">
            <li class="active"><a data-toggle="tab" href="#professional">PROFESIONAL</a></li>
            <li><a data-toggle="tab" href="#authorCeonpoint">AUTHOR-CEONPOINT</a></li>
            <li><a data-toggle="tab" href="#authorBussiness">AUTHOR-BUSINESS</a></li>
            <li><a data-toggle="tab" href="#authorInstitution">AUTHOR-INSTITUTION</a></li>
            <li><a data-toggle="tab" href="#cepBussiness">CEP BUSINESS</a></li>
            <li><a data-toggle="tab" href="#cepInstitution">CEP INSTITUTION</a></li>
            <li><a data-toggle="tab" href="#institution">INSTITUTION</a></li>
            <li><a data-toggle="tab" href="#advertiser">ADVERTISER</a></li>
          </ul>

          <div class="tab-content">
            <div id="professional" class="tab-pane fade in active">
          <form action="<?php echo BASE_URL;?>admin/editTerms" method="post" enctype="multipart/form-data" name="professionalform1" id="professionalform1"> 
              <h4 class="tab-title">PROFESIONAL</h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($professionals)>0){ ?>
                    <p>
                        <label>Type</label>
                        <input name="type" value="<?php echo $professionals['type']; ?>" id="etype" type="text" class="form-control" readonly>
                        <span class="error"><?php echo  form_error('type'); ?></span>
                    </p>
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="<?php echo $professionals['title']; ?>" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="<?php echo $professionals['id']; ?>" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    </p>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" placeholder="Write Some Lines about this Video..." required><?php echo $professionals['discription']; ?></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>    
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1" <?php if($professionals['status'] == 1){ echo 'selected'; } ?> >Active</option>
                          <option value="0" <?php if($professionals['status'] == 0){ echo 'selected'; } ?> >Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>  
                    
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            <p>  
              <input class="btn btn-primary" value="Update" name="pro-submit" type="submit">
            </p>
          </form>
        </div>

            <div id="authorCeonpoint" class="tab-pane fade">
              <form action="<?php echo BASE_URL;?>admin/editTerms" method="post" enctype="multipart/form-data" name="authorform2" id="authorform2">
              <h4 class="tab-title">AUTHOR-CEONPOINT</h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($authorCeonpoint)>0){ ?>
                <p>
                        <label>Type</label>
                        <input name="type" value="<?php echo $authorCeonpoint['type']; ?>" id="etype" type="text" class="form-control" readonly>
                        <span class="error"><?php echo  form_error('type'); ?></span>
                    </p>
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="<?php echo $authorCeonpoint['title']; ?>" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="<?php echo $authorCeonpoint['id']; ?>" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" placeholder="Write Some Lines about this Video..." required><?php echo $authorCeonpoint['discription']; ?></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>    
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1" <?php if($professionals['status'] == 1){ echo 'selected'; } ?> >Active</option>
                          <option value="0" <?php if($professionals['status'] == 0){ echo 'selected'; } ?> >Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div> 
             <p>  
              <input class="btn btn-primary" value="Update" type="submit">
          </p>
          </form>
        </div>

            <div id="authorBussiness" class="tab-pane fade">
              <form action="<?php echo BASE_URL;?>admin/editTerms" method="post" enctype="multipart/form-data" name="authorBform3" id="authorBform3">
              <h4 class="tab-title">AUTHOR-BUSINESS</h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($authorBusiness)>0){ ?>
                 <p>
                        <label>Type</label>
                        <input name="type" value="<?php echo $authorBusiness['type']; ?>" id="etype" type="text" class="form-control" readonly>
                        <span class="error"><?php echo  form_error('type'); ?></span>
                    </p>
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="<?php echo $authorBusiness['title']; ?>" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="<?php echo $authorBusiness['id']; ?>" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" placeholder="Write Some Lines about this Video..." required><?php echo $authorBusiness['discription']; ?></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>    
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1" <?php if($authorBusiness['status'] == 1){ echo 'selected'; } ?> >Active</option>
                          <option value="0" <?php if($authorBusiness['status'] == 0){ echo 'selected'; } ?> >Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>   
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
             <p>  
              <input class="btn btn-primary" value="Update" type="submit">
          </p>
          </form> 
            </div>

            <div id="authorInstitution" class="tab-pane fade">
              <form action="<?php echo BASE_URL;?>admin/editTerms" method="post" enctype="multipart/form-data" name="authorIform4" id="authorIform4">
              <h4 class="tab-title">AUTHOR-INSTITUTION</h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($authorInstitution)>0){ ?>
                  <p>
                        <label>Type</label>
                        <input name="type" value="<?php echo $authorInstitution['type']; ?>" id="etype" type="text" class="form-control" readonly>
                        <span class="error"><?php echo  form_error('type'); ?></span>
                    </p>
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="<?php echo $authorInstitution['title']; ?>" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="<?php echo $authorInstitution['id']; ?>" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" placeholder="Write Some Lines about this Video..." required><?php echo $authorInstitution['discription']; ?></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>    
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1" <?php if($authorInstitution['status'] == 1){ echo 'selected'; } ?> >Active</option>
                          <option value="0" <?php if($authorInstitution['status'] == 0){ echo 'selected'; } ?> >Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div> 
            <p>  
              <input class="btn btn-primary" value="Update" type="submit">
          </p>
          </form>
            </div>


            <div id="cepBussiness" class="tab-pane fade">
               <form action="<?php echo BASE_URL;?>admin/editTerms" method="post" enctype="multipart/form-data" name="cepBform5" id="cepBform5">
              <h4 class="tab-title">CEP BUSINESS </h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($cepBusiness)>0){ ?>
                  <p>
                        <label>Type</label>
                        <input name="type" value="<?php echo $cepBusiness['type']; ?>" id="etype" type="text" class="form-control" readonly>
                        <span class="error"><?php echo  form_error('type'); ?></span>
                    </p>
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="<?php echo $cepBusiness['title']; ?>" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="<?php echo $cepBusiness['id']; ?>" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" placeholder="Write Some Lines about this Video..." required><?php echo $cepBusiness['discription']; ?></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>    
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1" <?php if($cepBusiness['status'] == 1){ echo 'selected'; } ?> >Active</option>
                          <option value="0" <?php if($cepBusiness['status'] == 0){ echo 'selected'; } ?> >Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
             <p>  
              <input class="btn btn-primary" value="Update" type="submit">
          </p>
          </form>
            </div>

            <div id="cepInstitution" class="tab-pane fade">
              <form action="<?php echo BASE_URL;?>admin/editTerms" method="post" enctype="multipart/form-data" name="cepIform6" id="cepIform6">
              <h4 class="tab-title">CEP INSTITUTION </h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($cepInstitutions)>0){ ?>
                  <p>
                        <label>Type</label>
                        <input name="type" value="<?php echo $cepInstitutions['type']; ?>" id="etype" type="text" class="form-control" readonly>
                        <span class="error"><?php echo  form_error('type'); ?></span>
                    </p>
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="<?php echo $cepInstitutions['title']; ?>" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="<?php echo $cepInstitutions['id']; ?>" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" placeholder="Write Some Lines about this Video..." required><?php echo $cepInstitutions['discription']; ?></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>    
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1" <?php if($cepInstitutions['status'] == 1){ echo 'selected'; } ?> >Active</option>
                          <option value="0" <?php if($cepInstitutions['status'] == 0){ echo 'selected'; } ?> >Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            <p>  
              <input class="btn btn-primary" value="Update" type="submit">
          </p>
          </form>
            </div>

            <div id="institution" class="tab-pane fade">
              <form action="<?php echo BASE_URL;?>admin/editTerms" method="post" enctype="multipart/form-data" name="institutionform7" id="institutionform7">
              <h4 class="tab-title">INSTITUTION </h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($institutions)>0){ ?>
                  <p>
                        <label>Type</label>
                        <input name="type" value="<?php echo $institutions['type']; ?>" id="etype" type="text" class="form-control" readonly>
                        <span class="error"><?php echo  form_error('type'); ?></span>
                    </p>
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="<?php echo $institutions['title']; ?>" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="<?php echo $institutions['id']; ?>" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" placeholder="Write Some Lines about this Video..." required><?php echo $institutions['discription']; ?></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>    
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1" <?php if($institutions['status'] == 1){ echo 'selected'; } ?> >Active</option>
                          <option value="0" <?php if($institutions['status'] == 0){ echo 'selected'; } ?> >Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
            <p>  
              <input class="btn btn-primary" value="Update" type="submit">
          </p>
          </form>
            </div>

            <div id="advertiser" class="tab-pane fade">
               <form action="<?php echo BASE_URL;?>admin/editTerms" method="post" enctype="multipart/form-data" name="advertiserform8" id="advertiserform8">
              <h4 class="tab-title">ADVERTISER </h4>
              <div class="row">
              <div class="col-md-12">
                <?php if(count($advertiser)>0){ ?>
                  <p>
                        <label>Type</label>
                        <input name="type" value="<?php echo $advertiser['type']; ?>" id="etype" type="text" class="form-control" readonly>
                        <span class="error"><?php echo  form_error('type'); ?></span>
                    </p>
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="<?php echo $advertiser['title']; ?>" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="<?php echo $advertiser['id']; ?>" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" placeholder="Write Some Lines about this Video..." required><?php echo $advertiser['discription']; ?></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>    
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1" <?php if($advertiser['status'] == 1){ echo 'selected'; } ?> >Active</option>
                          <option value="0" <?php if($advertiser['status'] == 0){ echo 'selected'; } ?> >Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>  
                <?php } else { ?>
                <div class="pagi-above">Record not found.</div>
                <?php } ?>
              </div>
            </div>
             <p>  
              <input class="btn btn-primary" value="Update" type="submit">
          </p>
          </form>
            </div>

          </div>
          

      </div> 
    </div>
  </div>
</div>

    




<script type="text/javascript">

    function editTerms(id) {
      // $('#editTutorial').modal('show');
      // $('#id').val(id);
      $.ajax({
              type: "POST",
              url: '<?php echo base_url("admin/getTutorialVideo");?>',
              data: { id : id},
              success: function(result){
                obj = jQuery.parseJSON(result);
                // alert(obj.title);
                var link = '<?php echo ASSETS_URL?>upload/tutorial/';
                  // $('#certinutan').html(result);
                  $('#editTutorial').modal('show');
                  $('#etitle').val(obj.title);
                  $('#id').val(obj.id);
                  $('#ediscription').val(obj.discription);
                  $('#euploadvideo').attr('src',link+obj.uploadvideo);
                  $('#etype').val(obj.type);
                  $('#estatus').val(obj.status);
              }
              
          });

    }
</script>
