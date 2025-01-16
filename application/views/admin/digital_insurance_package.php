<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-subscription-listpanel">
	<div class="container">
		   <?php 
        $idd1 = $this->uri->segment(3);
        $cuntry1 = $this->db->get_where('countries',array('countries_id'=>$idd1,'display'=>'Yes'))->row_array(); 
        $cuntry13 = $this->db->get_where('countries',array('display'=>'Yes'))->result_array(); 
        $cnt = strtolower($cuntry1['countries_iso_code']);
        $idd1=$this->session->userdata('current_country'); ?>
	
		<div class="row">

		<?php $this->load->view('admin/sidebar'); ?>

	    <div class="col-sm-9">
            <?php  $month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
            if($_REQUEST['month'] !=""){ $mm = $_REQUEST['month']; } else { $mm = date('m'); } 
            if($_REQUEST['year'] !=""){ $yy = $_REQUEST['year']; } else { $yy = date('Y'); } 
            $uid = $_REQUEST['users']; 
            $country = $this->user->get_all_country(); ?>
            <div class="admin-titlebox">
                <h3 class="border-title text-left">Digital Insurance Package List</h3>
                <a href="<?php echo site_url('admin/dcpackageedit');?>" class="btn btn-info">Add New Package</a>
			</div>			
		</div>
       
		<div class="col-sm-9">
            <?php echo $this->session->flashdata('response');?>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Package Name</th>
                        <th>Price <br/>(per certificate)</th>
                        <th>Number of <br/>Certificates</th>
                        <th>Total Price</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr> 
                    <?php 
                        $tot=1;
                        foreach ($subs_list as $sub) {
                        $status = ($sub->dcp_status)?'Active':'Inactive';
                    ?>
                    <tr>
                        <td><?php echo $tot++;?>.</td>
                        <td><?php echo $sub->subcription_name;?></td>
                        <td>$ <?php echo $sub->charge_per_certificate;?></td>
                        <td><?php echo ($sub->no_of_certificates==0)?'Unlimited':$sub->no_of_certificates;?></td>
                        <td>$ <?php echo $sub->total_charges;?></td>
                        <td><?php echo $sub->subscription_details;?></td>
                        <td><?php echo $status;?></td>
                        <td>
                            <a href="<?php echo base_url('admin/dcpackageedit/'.$sub->dcp_id);?>" class="btn btn-primary mb-1"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="<?php echo base_url('admin/dcpdelet/'.$sub->dcp_id);?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                
            
            </div>
        </div>
		 
 
		</div>
	</div>
</div>