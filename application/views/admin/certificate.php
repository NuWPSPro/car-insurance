<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-certificatepanel">
    <div class="container">
        <div class="row">
            <?php $this->load->view('admin/sidebar'); ?>
            <div class="col-sm-9">
                <h3 class="border-title text-left">Certificate Listing</h3>
                <?php echo $this->session->flashdata('response');?> 
				<form action="<?=base_url('admin/certificate');?>" method="post" >
				<div class="row">
				      <div class="form-group col-md-2">
						<select name="country" class="form-control">
							<option value="" >Country:</option>
							<?php foreach($countries as $count){
								?>
							   <option value="<?php echo $count['countries_id']; ?>" <?php if($_POST['country']==$count['countries_id']){echo'selected';} ?> ><?php echo $count['countries_name']; ?></option>
							<?php
							} ?>
					</select>
					</div>

         
                   <div class="form-group col-md-3">
				  
						<select name="ceprovider" class="form-control">
							<option value="" >CE Provider:</option>
							<?php foreach($cproviders as $cp){
								?>
							   <option value="<?php echo $cp['id']; ?>" <?php if($_POST['ceprovider']==$cp['id']){echo'selected';} ?> ><?php echo $cp['name']; ?></option>
							<?php
							} ?>
					</select>
					</div>
					
					 <div class="form-group col-md-3">
				  
						<select name="institution" class="form-control">
							<option value="" >Institution:</option>
							<?php foreach($insititutions as $inti){
								
								
								if($inti['insititution_id']=='')
								{
									continue;
								}
								
								?>
							
							   <option value="<?php echo $inti['insititution_id']; ?>" <?php if($_POST['institution']==$inti['insititution_id']){echo'selected';} ?> ><?php echo $inti['name']; ?></option>
							<?php
							} ?>
					    </select>
					</div>


					<div class="form-group col-md-3">
							<input type="date" name="date" class="form-control" value="<?php echo set_value('date')?>">
					</div>
					<div class="form-group col-md-1">
						
						<input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
					</div>
									
				</div>
				</form>

                <?php foreach($certificates as $key => $value){
                    $commanArray[] = array(
                        'certificate_id'    =>  $value['certificate_id'],
                        'start_date'        =>  $value['start_date'],
                        'units'             =>  $value['units'],
                        'name'              =>  $value['name'],
                        'type'              =>  'Training',
                        'barcode'           =>  $value['barcode'],
                        'course_title'      =>  $value['title'],
                        'cpname'            =>  $value['cpname'],
                        'insititution_id'   =>  $value['insititution_id'],
                        'countries_name'    =>  $value['countries_name'],
                    );
                }
                foreach($coursecertificates as $key => $value){
                        $name = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['name'];
                    $commanArray[] = array(
                        'certificate_id'    =>  $value['certificate_id'],
                        'start_date'        =>  $value['added_on'],
                        'units'             =>  $value['units'],
                        'name'              =>  $name,
                        'type'              =>  'Online Course',
                        'barcode'           =>  $value['barcode'],
                        'course_title'      =>  $value['course_title'],
                        'cpname'            =>  $value['cpname'],
                        'insititution_id'   =>  $value['insititution_id'],
                        'countries_name'    =>  $value['countries_name'],
                    );
                }
                ?>
                <div class="table-responsive">
                    <table id="certificateExample" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>Certificate No.</th>
                                <th>Date Issued</th>
                                <th>CE Units</th>
                                <th>Recipient</th>
                                <th>Category</th>
                                <th>Barcode</th>
                                <th>Course Title</th>
                                <th>CE Provider</th>
                                <th>Institution</th>
                                <th>Author</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
               
               <?php 
				if(count($commanArray) > 0){
               $count=1;
               foreach ($commanArray as $key => $value) { 
                    $exploded = explode('-', $value['insititution_id']);
                    $ins_id = end($exploded);
                    $ins_name = $this->db->get_where('tbl_user',array('id'=>$ins_id))->row_array()['name'];
                 
                         if($value['certificate_id'] !=""){
                         ?>
                            <tr>
                                <td><?php echo $count;?></td>

                                <td><?php echo $value['certificate_id'];?></td>

                                <td><?php echo date('Y-m-d',strtotime($value['start_date']));?></td>

                                <td><?php echo $value['units'];?></td>

                                <td><?php echo $value['name'];?></td>

                                <td><?php echo $value['type'];?></td>
                                
                                <td><?php if(empty($value['barcode'])){ echo "N/A"; }else {  ?><img src="<?php echo ASSETS_URL?>images/uploads/<?php echo $value['barcode']; ?>"><?php } ?></td>

                                <td><?php echo $value['course_title'];?></td>

                                <td><?php echo $value['cpname'];?></td>

                                <td><?php echo ($ins_name!='')?$ins_name:'--';?></td>
                                <th>--</th>

                                <td><?php echo $value['countries_name'];?></td>

                                <!-- <td><a href="<?php echo site_url('admin/category_edit/'.$value['id'].'');?>" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a>  -->
                                <td><a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a></td>
                            </tr>


                            <?php $count++; } } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    $('#certificateExample').dataTable( {
            language: { search: '', searchPlaceholder: "Search..." },
         } );
} );

function preview_certificate(certifiacte_no) {
    $('#myModalcertificate').modal('show');
    $.ajax({
        type: "POST",
        url: '<?php echo base_url()."users/certificate_download";?>',
        data: { certifiacte_no: certifiacte_no },
        beforeSend: function() {
        $("#filteredData22").html("");
    }
    }).done(function(result) {
    	// alert(result);
        $("#filteredData22").html(result);
    });
    return false;


    /*     $.ajax({
         type: "POST"
         url: 'http://wps-dev.com/mycpd/users/certificate_download'
         data: {certifiacte_no:certifiacte_no}
         }).done(function( result ) {  
         });             

         return false;  */
}
</script>
<!-- Modal -->
<div id="myModalcertificate" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Certificate</h4>
            </div>
            <div class="modal-body">
                <div id="filteredData22"></div>
            </div>
        </div>
    </div>
</div>
