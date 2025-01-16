<?php $this->load->view('template/picture_provider'); ?>
<?php //echo'<pre>'; print_r($training_list);
      $commanarray=array();

      if($exam_list == 0){
        $exam_count = 0;
      }else{
        $exam_count = count($exam_list);
          foreach ($exam_list as $key => $value){
          $commanarray[] = array(
            'name'            =>$value['name'],
            'course_title'    =>$value['course_title'],
            'units'           =>$value['units'],
            'type'            =>'Online Course',
            'certificate_id'  =>$value['certificate_id'],
            'barcode'         =>$value['barcode'],
            'added_on'        =>$value['added_on'],
            'countries_name'  =>$value['countries_name'],
            'user_id'         =>$value['user_id'],
          );
        }
      }
      if($training_list == 0){
        $training_count = 0;
      }else{
        $training_count = count($training_list);
         foreach ($training_list as $key => $value){
          $commanarray[] = array(
            'name'            =>$value['name'],
            'course_title'    =>$value['title'],
            'units'           =>$value['units'],
            'type'            =>'Training',
            'certificate_id'  =>$value['certificate_id'],
            'barcode'         =>$value['barcode'],
            'added_on'        =>$value['added_on'],
            'countries_name'  =>$value['countries_name'],
            'user_id'         =>$value['user_id'],
          );
        }
      }

?>
<div class="innerContent">
  <div class="container">
    <div class="row">
      <?php  $this->load->view('provider/sidebar');  ?>

      <div class="col-sm-9">
        <h3 class="border-title text-left">Certificate List
          <?php echo '( '.($exam_count + $training_count).' )'; ?></h3>

        <div class="panel-heading">
          <button type="button" class="btn btn-success" id="btn_all" onclick="getdata('all');">All
            <?php echo '( '.($exam_count + $training_count).' )'; ?></button>
          <button type="button" class="btn" id="btn_course" onclick="getdata('course');">Online Course Certificate
            (<?php echo $exam_count; ?>)</button>
          <button type="button" class="btn" id="btn_training" onclick="getdata('training');">Training Certificate
            (<?php echo $training_count; ?>) </button>
        </div>

        <div class="all" id="all">
          <div class="table-responsive">
            <table class="table dataTable  table-striped table-bordered cerdata" style="width:100%">
              <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Name</th>
                  <th>Course/Training</th>
                  <th>CE Unints</th>
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
                      foreach ($commanarray as $key => $value){ ?>
                <tr>
                  <td><?php echo $tot; ?></td>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['course_title']; ?></td>
                  <td><?php echo $value['units']; ?></td>
                  <td><?php echo $value['type']; ?></td>
                  <td><?php echo $value['certificate_id']; ?></td>
                  <td><?php if(empty($value['barcode'])){ echo "N/A"; }else {  ?><img
                      src="<?php echo ASSETS_URL?>images/uploads/<?php echo $value['barcode']; ?>"><?php } ?></td>

                  <td><?php echo date('Y-m-d',strtotime($value['added_on'])); ?></td>
                  <td><?php echo $value['countries_name']; ?></td>

                  <td>
                    <a class="btn btn-default" href="javascript:void(0);"
                      onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i
                        class="fa fa-eye"></i></a>
                  
                    <a class="btn btn-default" href="javascript:void(0);"
                      onclick="resend_certificate('<?php echo $value['certificate_id'];?>','<?php echo $value['user_id'];?>','<?php echo $value['course_title'];?>')" title="Resend certificate to user as email."><i
                        class="fa fa-send-o"></i></a>
                  </td>
                </tr>
                <?php $tot++; } ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="course" id="course" style="display: none;">
          <div class="table-responsive">
            <table class="table dataTable  table-striped table-bordered cerdata" style="width:100%">
              <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Name</th>
                  <th>Course</th>
                  <th>CE Unints</th>
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
                      foreach ($exam_list as $key => $value){ ?>
                <tr>
                  <td><?php echo $tot; ?></td>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['course_title']; ?></td>
                  <td><?php echo $value['units']; ?></td>
                  <td>Online Course</td>
                  <td><?php echo $value['certificate_id']; ?></td>

                  <td><?php if(empty($value['barcode'])){ echo "NA"; }else {  ?><img
                      src="<?php echo ASSETS_URL?>images/uploads/<?php echo $value['barcode']; ?>"><?php } ?></td>

                  <td><?php echo $value['added_on']; ?></td>
                  <td><?php echo $value['countries_name']; ?></td>
                  <td><a class="btn btn-default" href="javascript:void(0);"
                      onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i
                        class="fa fa-eye"></i></a></td>
                </tr>
                <?php  $tot++; } ?>
              </tbody>
            </table>
          </div>
        </div>
        

        <div class="training" id="training" style="display:none;">
          <div class="table-responsive">
            <table class="table dataTable  table-striped table-bordered cerdata" style="width:100%;">
              <thead>
                <tr>
                   <th>S.N.</th>
                  <th>Name</th>
                  <th>Training</th>
                  <th>CE Unints</th>
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
                        foreach ($training_list as $key => $value){ ?>
                <tr>
                  <td><?php echo $tot; ?></td>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['title']; ?></td>
                  <td><?php echo $value['units']; ?></td>
                  <td>Training</td>
                  <td><?php echo $value['certificate_id']; ?></td>
                  <td><?php if(empty($value['barcode'])){ echo "N/A"; }else {  ?><img
                      src="<?php echo ASSETS_URL?>images/uploads/<?php echo $value['barcode']; ?>"><?php } ?></td>

                  <td><?php echo date('Y-m-d',strtotime($value['added_on'])); ?></td>
                  <td><?php echo $value['countries_name']; ?></td>

                  <td><a class="btn btn-default" href="javascript:void(0);"
                      onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i
                        class="fa fa-eye"></i></a></td>
                </tr>
                <?php  $tot++; } ?>
              </tbody>
            </table>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

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

<script type="text/javascript">
  $(document).ready(function () {
    $('.cerdata').DataTable();
  });

  function preview_certificate(certifiacte_no) {
    $('#dashboardcertificate').modal('show');
    $.ajax({
      type: "POST",
      url: '<?php echo base_url()."users/certificate_download";?>',
      data: { certifiacte_no: certifiacte_no },
      beforeSend: function () {
        $("#certificatehtml").html("");
      }

    }).done(function (result) {
      // alert(result);
      $("#certificatehtml").html(result);
    });
    return false;

  }

  function resend_certificate(certifiacte_no,user_id,title) {
    $.ajax({
      type: "POST",
      url: '<?php echo base_url()."share/resend_certificate";?>',
      data: { certifiacte_no: certifiacte_no, user_id: user_id, title: title  },
      beforeSend: function () {
        $("#certificatehtml").html("");
      }

    }).done(function (result) {
      alert(result);
      // $('#').modal('show');
      // $("#").html(result);
    });
    return false;

  }

  function getdata(value) {
    // alert(value);
    $("#all").hide();
    $("#course").hide();
    $("#training").hide();

    $('#btn_all').removeClass('btn-success');
    $('#btn_course').removeClass('btn-success');
    $('#btn_training').removeClass('btn-success');

    $('#' + value).show();
    $('#btn_' + value).addClass("btn-success");

  }
</script>