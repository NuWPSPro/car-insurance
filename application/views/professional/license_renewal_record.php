<?php $this->load->view('template/picture'); ?>


 <div class="innerContent">
	  <div class="container">
      <div class="row">
        	<!-- <div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
        	</div> -->
       <?php  $this->load->view('professional/sidebar');  ?>  
     
       <div class="col-sm-8">
            <h3 class="border-title text-left mb-0">Professional Identification Card(PIC) Renewal Record</h3>
            <a href="javascript:void(0)" class="btn btn-primary pull-right" style="margin-bottom: 10px; " onclick="alert('Comming Soon!!')">Renew License</a>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>No.</th>
                    <th>License No.</th>
                    <th>Date Issued</th>
                    <th>Validity</th>
                    <th>Issued by</th>
                    <th>Countdown</th>
                    <th>Country</th>
                    <th>Status</th>
                    <!-- <th>Action</th> -->
                </tr>
              
                <?php if(!empty($license)){
                   echo $value['licence_validity'];// print_r($license);
                  $count=1;
                  foreach ($license as $key => $value){ 
                    if($value['licence_validity']=='1001-01-01')
                    { 
                      $validity = 'Life Time'; 
                      $countdown = 'Life Time';
                    }else{ 
                      $validity = $value['licence_validity']; 
                      $date1 = date_create(date("Y-m-d"));
                      $date2 = date_create($value['licence_validity']);
                      $diff = date_diff($date1,$date2);
                      $countdown =  $diff->format("%R%a days");
                    }
                    $country = $this->db->get_where('countries',array('countries_id'=>$value['location']))->row_array()['countries_name'];  
                   // $docpath = ASSETS_URL.'images/uploads/'.$value['accreditation_doc']; ?>
                <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $value['licence_prc'];?></td>
                    <td><?php echo $value['licence_issued'];?></td>
                    <td><?php echo $validity;?></td>
                    <td><?php echo $value['issuing_institution'];?></td>
                    <td><?php echo $countdown;?></td>
                    <td><?php echo $country;?></td>
                    <td><?php $before1month = date("Y-m-d", strtotime($value['licence_issued']."-1 months"));
                    //echo  $before1month.'/'.$value['expiry_date'];
                    if($value['status']==1)
                    {
                      if($value['licence_validity']='1001-01-01'){
                        echo "<strong class='text-success'>Active</strong>";
                      }
                      elseif(date("Y-m-d")<=$before1month )
                      {
                        echo "<strong class='text-success'>Active</strong>";
                      }
                      elseif(date("Y-m-d")>=$before1month && date("Y-m-d")<=$value['expiry_date'])
                      {
                        echo "<strong class='text-warning blink'>Expiring</strong>";
                      }
                      else
                      {
                        echo "<strong  class='text-danger'>Expired</strong>";
                      }
                    }
                    else
                    {
                      echo "<strong class='text-danger'>Expired</strong>";
                    } ?></td>
                   <!--  <td><a href="javascript:void(0)" onclick="acc_doc('<?php echo $docpath;?>')" title="View"><i class="fa fa-file" style="font-size:24px;color:red;"></i></a></td> -->                  
                </tr>
                <?php  $count++; } 
                 } else{ echo "<p style='color:red;'>Sorry no records found.</p>"; } ?>
            </table>
        </div>
       </div>
	</div>
</div>



<div class="modal fade" id="accDocumentModal" role="dialog">
      <div class="modal-dialog lg">
        <!-- Modal content-->
        <div class="modal-content" id="myModalpreviewImage11">
          <div class="modal-header">
            <!-- <button onclick="myFunction()" style="float: left;" type="button"><i class="fa fa-print"></i></button> -->
            ACCREDITATION DOCUMENT
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <center>
              <iframe id="imagepreview" src="" width="100%" height="500" frameborder="0" allowfullscreen=""> </iframe>
            </center>
          </div>
        </div>
      </div>
</div>

<script type="text/javascript">
  function acc_doc(image) {
    // alert(image);
    $("#accDocumentModal").modal('show');
    document.getElementById('imagepreview').src = image;
  }
</script>