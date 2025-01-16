<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-blogpanel">
    <div class="container">
        
        <div class="row">
            <?php 
        $this->load->view('admin/sidebar');
        ?>
            <div class="col-sm-9">
                <div class="admin-titlebox">
                <h3  class="border-title text-left">News/Blog</h3>
                <a href="<?php echo site_url('admin/blog');?>" class="btn btn-info">Add Blog</a>
                </div>

                <?php echo $this->session->flashdata('response');?> 
				
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>country</th>
                                <th>User Name</th>
                                <th>User Role</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Sort Desc</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
               
               <?php  foreach ($blog as $key => $value) { 
                            $user_det = $this->db->where('id',$value['user_id'])->get("tbl_user")->row_array(); 
                            if($value['user_role'] == 2){
                                $user_role = 'CE Provider';
                            }elseif($value['user_role'] == 5){
                                $user_role = 'Institution';
                            }else{
                                $user_role = 'Admin';
                            } ?>
                            <tr>
                                <td><?php echo $key+1;?></td>
                                <td>
                                    <?php echo $this->db->where('countries_id',$value['country'])->get("countries")->row_array()['countries_name'];?>
                                </td>
                                <td>
                                    <?php echo $user_det['name'];?>
                                </td>
                                <td>
                                    <?php echo $user_role;?>
                                </td>
                                <td>
                                   <img src="<?=base_url('assets/upload/blog/'.$value['image'])?>" alt="">
                                </td>
                                <td>
                                   <a href="<?=base_url('pages/blog_details/'.$value['id'])?>"  ><?php echo $value['title'];?></a>
                                </td>
							    <td>
                                    <?php echo $value['date'];?>
                                </td>
							    <td><?php if( $value['status']==1){
										echo '<span style="color:green;">Active</span>';
									}else{
										echo '<span style="color:red;">Deactive</span>';
									}?>
                                </td>
                              
							  <td>
							  <a href="<?php echo site_url('admin/edit_blog/'.$value['id'].'');?>" class="btn btn-primary" title="edit"><i class="fa fa-pencil"></i></a>
								<a onclick="delete_bog('<?php echo site_url('admin/blog_delete/'.$value['id'].'');?>');" href="javascript:void(0);" class="btn btn-primary" title="delete"><i class="fa fa-trash"></i></a> 
								<a href="<?php echo site_url('pages/blog_details/'.$value['id'].'');?>" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a>
						   </td>
							</tr>


                            <?php }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function delete_bog(url){
        var d = confirm('Do you want to DELETE it ?');
        if(d == true){
            window.location.href = url;
        }
    }    
</script>