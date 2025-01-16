<?php $this->load->view('admin/picture'); ?>

<div class="innerContent admin-professionalpanel">

	<div class="container">
    <!--  -->
		<div class="row">
		<?php     $this->load->view('admin/sidebar');
                  $this->load->view('admin/users_work'); ?>	

<!-- <div class="">
    <?php $total = count($professiona); ?>
    <h4 class="text-left"> Professional Listing ( <?php echo $total;?> Users)</h4> 
</div>	 -->	
        <?php echo $this->session->flashdata('response');
              $profession = $this->uri->segment(3); ?>

<div class="row">
    <div class="form-group col-md-4">
        <form action="" method="post" name="frm">
            <select name="profession" id="profession" class="form-control">
                <option value="">Profession</option>
                <?php 
                $professionList = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
                foreach ($professionList as $key => $value) {
                    ?>
                <option <?php if($profession==$value['cat_name']){ echo "selected"; }?> value="<?php echo $value['cat_name'];?>"><?php echo $value['cat_name'];?></option>
                <?php }  ?>
            </select>
        </form>
    </div>

    <div class="form-group col-md-2">
        <input type="button" name="filter" value="FILTER" class="btn btn-primary" onclick="filtedata()">
    </div>

    <div class="form-group col-md-6">
    <a href="<?php echo BASE_URL . 'admin/professional/?filter=4'; ?>" class="btn btn-primary">Free Trail <?php if($_REQUEST['filter']==4){ echo '('.count($users).')'; } ?></a>
    <a href="<?php echo BASE_URL . 'admin/professional/?filter=2'; ?>" class="btn btn-success">Pro PCE-MS <?php if($_REQUEST['filter']==2){ echo '('.count($users).')'; } ?></a>
    <a href="<?php echo BASE_URL . 'admin/professional/?filter=1'; ?>" class="btn btn-info">Basic <?php if($_REQUEST['filter']==1){ echo '('.count($users).')'; } ?></a>
    </div>
</div>


<div class="table-responsive">
<table id="prof-list" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>PCE-MS Version</th>
                <th>Countdown</th>
                <!-- <th>User Type</th> -->
                <th>Profession</th>
                <th>Country</th>
                <!-- <th>Address</th> -->
                <th>Email</th>
                <th>Date Registered</th>
                <th>Status</th>
                <th>Access</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php 
             foreach ($users as $key => $value) {  
                $plan_details = $this->db->get_where('professional_pce_plan',array('user_id'=>$value['id']))->row_array(); 
                if($value['status']==1 && $value['disabled_by']==0){ 
                    $status = '<span style="color:green;">Active</span>'; 
                    $access = '<span style="color:green;">Enable</span>'; 
                }elseif($value['status']==0 && $value['disabled_by'] > 0){ 
                    $status = '<span style="color:red;">Inactive<span>'; 
                    $access = '<span style="color:red;">Disable<span>'; 
                }else{ 
                    $status = '<span style="color:red;">Pending<span>'; 
                    $access = '<span style="color:red;">Inactive<span>'; 
                }
                if($plan_details['plan_expiry_at']){
                    $expiry    = strtotime($plan_details['plan_expiry_at']);
                    $today     = strtotime(date('Y-m-d'));
                    $remaindays =  $expiry - $today;
                    $remainingDays = floor($remaindays / (60 * 60 * 24));
                    if($remainingDays > 0){
                        $countdown = $remainingDays;
                    }else{
                        $countdown = 0;
                    }
                }else{
                    $countdown = '--';
                }

                // echo $your_date;
                $pceversion = $this->professional_model->checkactiveplan($value['id']);
                if($pceversion && $pceversion->payment_status=='y'){ 
                    if($pceversion->version_type == 1){
                        $pceversionname =  'Basic Version';
                      }
                      if($pceversion->version_type == 2){
                        $pceversionname =  'PRO-Version';
                      }
                      if($pceversion->version_type == 3){
                        $pceversionname =  'Premium Version';
                      }
                }elseif($pceversion==''){
                    $pceversionname = '--';
                }else{
                    if($pceversion->version_type == 1){
                        $pceversionname =  'Basic Version';
                    }else{
                        $pceversionname = 'PRO-Version ( Free-Trail )';
                    } 
                } ?>

            <tr>

                <td><?php echo $key+1;?></td> 
                <td><?php echo $value['name'];?></td>
                <td><?php echo $pceversionname;?></td>
                <td><?php echo $countdown; ?></td>
                <td><?php echo $value['profession'];?></td> 
                <td><?php echo $value['countries_name'];?></td> 
                <td><?php echo $value['username_email'];?></td> 
                <td><?php echo $value['added_on'];?></td>  

                    <!-- <a href="<?php echo BASE_URL.'admin/changestatus/'.$value['id'].'/'.$value['status'].''?>" style="color: <?php echo $color; ?>"><?php echo $stts;?></a>  -->
                <td><?php echo $status; ?></td>
                <td><?php echo $access; ?></td>
                <td>
                    <a class="btn btn-default" title="Edit" href="javascript:void(0)" onclick="showeditform('<?=$value['name']; ?>','<?=$value['status']; ?>','<?=$value['id']; ?>','<?=$value['role']; ?>','<?=$value['activation_id']; ?>')" ><i class="fa fa-pencil"></i></a>
                    <a target="_blank" href="<?php echo site_url('share/viewprofile/'.$value['id'].'');?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a> &nbsp;
                </td>

            </tr>

            <?php } ?>

            

        </tbody>

    </table>
            </div>
			

		</div>

		</div>

	</div>

</div>




<!-- Modal  Register Sub institutions-->
    <div id="editproform" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change User's status</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/changestatus'); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <p>
                            <label>User Name</label>
                            <input type="text" name="name" id="pname" class="form-control" readonly="">
                            <input type="hidden" name="ins_name" class="form-control" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
                            <input type="hidden" name="id" id="pid" >
                            <input type="hidden" name="role" id="prole" >
                            <input type="hidden" name="activate_id" id="activate_id" >
                        </p>
                        <p>
                            <label>Change Status</label>
                            <select name="status" class="form-control" id="pstatus">
                                <option value="1" selected>Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-primary" value="Update" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>




<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#prof-list').DataTable();
    } );

    function showeditform(pname,status,id,role,activate_id){
        $('#editproform').modal('show');
        $('#pname').val(pname);
        $('#pstatus').val(status);
        $('#prole').val(role);
        $('#pid').val(id);
        $('#activate_id').val(activate_id);
    }

    function filtedata(){
        var profession = jQuery('#profession').val();
        var path = "<?php echo site_url();?>/admin/professional/";
        window.location=path+profession;
    }

    function setval(){
        var profession =  "<?php echo urldecode($this->uri->segment(3));?>";
        jQuery('#profession').val(profession);
    }
    setval();

</script>



