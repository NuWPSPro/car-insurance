<?php $this->load->view('template/picture_provider'); 
      $uins = $this->session->userdata('logged_in')['under_insititution']; ?>
<div class="innerContent">
    <div class="container">
        <!-- <h2 class="border-title text-left">Dashboard</h2> -->
        <div class="row">
        <?php  $this->load->view('provider/sidebar');  ?>
            <div class="col-sm-9">
			<a href="<?php echo site_url('provider/blog');?>"   class="btn btn-info pull-right">Add Blog</a>
            <?php if($uins==0){ ?>
                <a href="<?php echo site_url('pages/blog');?>"   class="btn btn-primary pull-right mr-1">Back to Blog Page</a>
            <?php } ?>
              			  <h3  class="border-title text-left" style="width:200px !important;">News/Blog</h3>

                <?php echo $this->session->flashdata('response');?> 
                <br>
				
                <div class="table-responsive">
                    <table id="cep-blog-list" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Country</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Date Published</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
               
               <?php  foreach ($blog as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1;?></td>
                                <td>
                                    <?php echo $this->db->where('countries_id',$value['country'])->get("countries")->row_array()['countries_name'];?>
                                </td>
                                <td>
                                   <img src="<?=base_url('assets/upload/blog/'.$value['image'])?>" alt="" width="150">
                                </td>
                                <td>
                                   <a href="<?=base_url('pages/blog_details/'.$value['id'])?>"  ><?php echo $value['title'];?></a>
                                </td>
							    <td>
                                    <?php echo date('Y-m-d',strtotime($value['date']));?>
                                </td>
							    <td><?php if( $value['status']==1){
										echo '<span style="color:green;">Active</span>';
									}else{
										echo '<span style="color:red;">Deactive</span>';
									}?>
                                </td>
                              
							  <td>
							    <a href="<?php echo site_url('provider/edit_blog/'.$value['id'].'');?>" class="btn btn-primary" title="edit" style="margin: 2px;"><i class="fa fa-pencil"></i></a>
								<a onclick="delete_bog('<?php echo site_url('provider/blog_delete/'.$value['id'].'');?>');" href="javascript:void(0);" class="btn btn-primary" title="delete" style="margin: 2px;" ><i class="fa fa-trash"></i></a> 
								<a href="<?php echo site_url('pages/blog_details/'.$value['id'].'');?>" class="btn btn-primary" title="View" style="margin: 2px;"><i class="fa fa-eye"></i></a>
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

    $(document).ready(function() {
        $('#cep-blog-list').DataTable();
    });

    function delete_bog(url){
        var d = confirm('Do you want to DELETE it ?');
        if(d == true){
            window.location.href = url;
        }
    }    
</script>