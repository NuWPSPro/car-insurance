<?php $this->load->view('template/search'); ?>
<div class="innerContent">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        
          <div class="panel panel-default">
                    <div class="panel-heading">
                        <form action="http://mycpd.paritechsolutions.com/pages/download_certificate" method="post" enctype="multipart/form-data" name="form1" id="form1" class="flex-center justify-space-around">
                            <input required="" type="text" name="certifiacte_no11" id="certifiacte_no11" placeholder="Enter Certificate Number" class="form-control" style="margin-right: 15px;">
                            <input type="button" class="btn btn-primary" value="Verify & Download" onclick="certifiacte()">
                        </form>
                    </div>
                </div>



  </div>
  
  <?php  $this->load->view('pages/sidebar'); ?>
 
</div>
</div>
</div>



 


<script type="text/javascript">
  function certifiacte(){
    //alert("caloing");
    var certifiacte_no = $('#certifiacte_no11').val(); 
    if(certifiacte_no==""){ 
        document.getElementById('certifiacte_no11').style.border='1px solid #F00';  
        return false;
    } 
    $('#myModal').modal('show'); 

    $('#certi_button').text('Verify & Download');
     if(certifiacte_no==""){
          return false;
        } else {
          $('#certi_button').text('Please wait...');
          $.ajax({
          type: "POST",
          url: '<?php echo base_url()."users/certificate_download";?>',
          data: {certifiacte_no:certifiacte_no}
          }).done(function( result ) {
           //alert(result);
           $('#certi_button').text('Verify & Download');
          $("#filteredData22").html( result );
          });              
          return false;   
        }

}
</script>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
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

