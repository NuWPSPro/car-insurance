<?php $this->load->view('institution/picture'); ?>


 <div class="innerContent">
	<div class="container">
        <div class="row">
           <!--  <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
       <?php $this->load->view('institution/sidebar'); ?>
          
        <div class="col-sm-9">
            <h3 class="border-title text-left">Blog
            
          <a href="<?php echo base_url('institution/blog'); ?>"   class="btn btn-info pull-right">Add Blog</a>  </h3>

            <form action="<?=base_url('institution/blog_list');?>" method="get">
				<div class="row pt-1">
                    <?php if($this->session->userdata('logged_in')['under_insititution']=='0'){ ?>
                    
					<div class="form-group col-md-3">
							<input type="text" name="title" class="form-control" value="<?php echo set_value('title',$_GET['title'])?>" placeholder="Enter Course Title" >
					</div>

                    <div class="form-group col-md-3">
                        <select name="institution" class="form-control">
                            <option value="">Sub Institution:</option>
                            <?php foreach($insititutions as $inti){
                                if($inti['insititution_id']=='')
                                { continue; } ?>
                               <option value="<?php echo $inti['insititution_id']; ?>" <?php if($_GET['institution']==$inti['insititution_id']){echo'selected';} ?> ><?php echo $inti['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?>

                    <div class="form-group col-md-3">
                        <select name="ceprovider" class="form-control">
                            <option value="" >CE Provider:</option>
                            <?php foreach($ceplist as $cp){ ?>
                                <option value="<?php echo $cp['id']; ?>" <?php if($_GET['ceprovider']==$cp['id']){echo'selected';} ?> ><?php echo $cp['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                
					<div class="form-group col-md-3">
							<input type="date" name="date" class="form-control" value="<?php echo set_value('date',$_GET['date'])?>">
					</div>

					<div class="form-group col-md-3">
						<input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
					</div>
				</div>
				</form>
            <div class="table-responsive">
                <table id="blog-list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>country</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Sort Desc</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
               
                   <?php $count=1; 
                   foreach ($blog as $key => $value) { 
                    if( $value['status']==1){  
                        $status = '<span style="color:green;">Active</span>'; 
                    }else{ 
                        $status = '<span style="color:red;">Deactive</span>'; } ?>
                        <tr>
                            <td><?php echo $count;?></td>

                            <td><?php echo $this->db->where('countries_id',$value['country'])->get("countries")->row_array()['countries_name'];?></td>
                            
                            <td sty><img style="width: 200px;" src="<?=base_url('assets/upload/blog/'.$value['image'])?>" alt="Blog-image"></td>
                            
                            <td><a style="color: blue;" href="<?=base_url('pages/blog_details/'.$value['id'])?>"  ><?php echo $value['title'];?></a></td>
                           
                            <td><?php echo date('Y-m-d',strtotime($value['date']));?></td>
                           
                            <td><?php echo $status; ?></td>
                          
                            <td>
                              <a href="<?php echo site_url('institution/edit_blog/'.$value['id'].'');?>" class="btn btn-primary mb-1" title="edit"><i class="fa fa-pencil"></i></a>
                              <a href="<?php echo site_url('institution/countrydelet/'.$value['id'].'');?>" class="btn btn-primary mb-1" title="delete"><i class="fa fa-trash"></i></a> 
                              <a href="<?php echo site_url('pages/blog_details/'.$value['id'].'');?>" class="btn btn-primary mb-1" title="View"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php $count++; }  ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
	</div>
</div>

<script>
    $(document).ready(function() {
        // $('#blog-list').DataTable();
    });
</script>