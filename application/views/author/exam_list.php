<?php $this->load->view('template/picture_author'); ?>

 <div class="innerContent author-exam-list">
	<div class="container">
        <div class="row">

          <?php  $this->load->view('author/sidebar');  ?>  
  
            <div class="col-sm-9">
                <h3 class="border-title text-left course">Certificate List <?php echo '( '.count($exam_list).' )'; ?></h3>
                <div class="course">
                <div class="table-responsive">
                    <table id="example" class="table dataTable  table-striped table-bordered" style="width:100%" >
                      <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Name</th> 
                            <!-- <th>Category Training</th>  -->
                            <th>Course</th> 
                            <th>CE Unints</th> 
                            <!--<th>Percentages</th> -->
                            <th>Category</th> 
                            <th>Certificate ID</th> 
                            <th>Barcode</th> 
                            <th>Date</th>  
                            <th>Country</th>  
                            <th>Action</th> 
                          </tr>
                      </thead>
                      <tbody>
                  <?php $tot=1;
                        foreach ($exam_list as $key => $value){
                      ?>
                            <tr>
                              <td><?php echo $tot++; ?></td> 
                              <td><?php echo $value['name']; ?></td> 
                              <td><?php echo $value['course_title']; ?></td> 
                              <td><?php echo $value['units']; ?></td> 
                              <!--<td><?php echo $value['percentages']; ?></td> -->
                              <td>Online Course</td>  
                              <td><?php echo $value['certificate_id']; ?></td>  
                              
                              <td><?php if(empty($value['barcode'])){ echo "NA"; }else {  ?><img src="<?php echo ASSETS_URL?>images/uploads/<?php echo $value['barcode']; ?>"><?php } ?></td>  

                              <td><?php echo date('Y-m-d',strtotime($value['added_on'])); ?></td>  
                              <td><?php echo $value['countries_name']; ?></td>  
                             <!--  <td><a class="btn btn-default" title="View" href="<?php echo BASE_URL.''; ?>"><i class="fa fa-eye"></i></a></td> -->
                             <td><a class="btn btn-default" href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a></td>               
                          </tr>
						<?php } ?>
                      </tbody>
                    </table>
                </div>
            </div>
            </div>

        </div>
</div>
</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
});
</script>

<script type="text/javascript">
function preview_certificate(certifiacte_no) {
    $('#dashboardcertificate').modal('show');
    $.ajax({
        type: "POST",
        url: '<?php echo base_url()."users/certificate_download";?>',
        data: { certifiacte_no: certifiacte_no },
        beforeSend: function() {
      $("#certificatehtml").html("");
    }
    }).done(function(result) {
      // alert(result);
        $("#certificatehtml").html(result);
    });
    return false;

}
</script>
<!-- Modal -->
<div id="dashboardcertificate" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="alert('Please Download this certificate to print!')" style="float: left;" type="button"><i class="fa fa-print"></i></button>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Certificate</h4>
            </div>
            <div class="modal-body">
                <div id="certificatehtml"></div>
            </div>
        </div>
    </div>
</div>