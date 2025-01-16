<?php $this->load->view('template/picture'); ?>


 <div class="innerContent professional-course_history">
      <div class="container">
      <div class="row">
      <?php  $this->load->view('professional/sidebar');  ?>  
      <?php 
                $tot=0;
                $sess_id = $this->session->userdata('logged_in')['id'];
                $commanArr = array();
                foreach($purchase_list as $key => $value ){
                  $ttq = $this->db->get_where('tbl_quiz_question',array('course_id'=>$value['cid']))->num_rows();
                  $arrydata = json_decode($value['data']);
                    $commanArr[] = array(
                            'id'             => $value['cid'],
                            'course_name'    => $value['course_name'],
                            'added_on'       => $value['added_on'],
                            'certificate_id' => $value['certificate_id'],
                            'type'           => 'course',
                            'exam_result'    => count($arrydata).'/'.$ttq,
                            'percentages'    => $value['percentages'].'%',
                            'amount'         => $value['amount']);
                    }
                        
                    foreach($training_list as $key => $value ){
                      $commanArr[] = array(
                            'id'             => $value['tid'],
                            'course_name'    => $value['course_name'],
                            'added_on'       => $value['added_on'],
                            'certificate_id' => $value['certificate_id'],
                            'type'           => 'trining',
                            'exam_result'    => 'N/A',
                            'percentages'    => 'N/A',
                            'amount'         => $value['amount']);
                    } ?>

       <div class="col-sm-9">
            <h3 class="border-title text-left">Course History</h3>
            <div class="table-responsive">
            <table class="table table-striped table-bordered" id="example">
                <tr>
                    <th>No.</th>
                    <th>Online Course/Training Name</th>
                    <th>Category</th>
                    <th>Certificate No.</th>
                    <th>Exam Result</th>
                    <th>Percentage(%)</th>
                    <th>Date Purchased</th>
                    <th>Action</th>
                    <!-- <th class="text-right">Amount</th> -->
                </tr>
                <?php 
                  $count = 1;  
                  foreach ($commanArr as $key => $value) {
                    if($value['certificate_id']){
                        $certificate = $value['certificate_id'];
                        $eresult = $value['exam_result'];
                        $percentages = $value['percentages'];
                    }else{
                        $certificate ='Pending';
                        $eresult = '--';
                        $percentages = '--';
                    }
                    if($value['type']=='course'){
                        $hyperlink = base_url('pages/course_details/').$value['id'];
                    }else{
                        $hyperlink = base_url('pages/training_details/').$value['id'];
                    }
                        $tot = $tot+$value['amount'];  ?>
                <tr>
                    <td><?php echo $count;?></td>
                    <td><a href="<?php echo $hyperlink; ?>" class="text-primary"> <?php echo $value['course_name'];?></a></td>
                    <td><?php echo $value['type'];?></td> 
					<td><?php echo $certificate;?></td>
                    <td><?php echo $eresult;?></td>                                
                    <td><?php echo $percentages;?></td>                                
                    <td><?php echo date('Y-m-d', strtotime($value['added_on']));?></td> 
                    <td class="action">
                    <?php if($value['certificate_id']){ ?>
                        <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" title="View"><i class="fa fa-eye"></i></a>
                    <?php }else{ ?>
                    	<a href="javascript:void(0);" onclick="alert('This Course is Pending!');" title="View"><i class="fa fa-eye"></i></a>
                    <?php }?>
                    </td>                               
                    <!-- <td class="text-right">$<?php echo $value['amount'];?></td> -->
                </tr>
                <?php $count++; } ?>
               <!--  <tr class="bg-info">
                    <td colspan="4" class="text-right text-primary">Total</td>
                    <td class="text-right text-primary">$<?php echo $tot;?></td>
                </tr> -->
            </table>
            </div>
            <?php 
              if(empty($commanArr)){
                  echo "<p style='color:red;'>Sorry no records found.</p>";
                 }
            ?>

        </div>
       </div>
    </div>
    </div>
    
	<!-- Modal -->
	<div id="coursehistorycertificate" class="modal fade modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
                    <button onclick="certificateFunction();" style="float: left;" type="button"><i class="fa fa-print"></i></button>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Certificate</h4>
				</div>
				<div class="modal-body">
					<div id="certificatehtml"></div>
				</div>
			</div>
		</div>
    </div>
    <a href="#" id="scroll" style="display: inline;"><span></span></a>

<script type="text/javascript">
	var certi = 0; 
	function preview_certificate(certifiacte_no) {
		// alert(certifiacte_no);
            certi = certifiacte_no;
		$('#coursehistorycertificate').modal('show');
		$.ajax({
			type: "POST",
			url: '<?php echo base_url()."users/certificate_download";?>',
			data: { certifiacte_no: certifiacte_no },
			beforeSend: function() {
			$("#certificatehtml").html("");
		}

		}).done(function(result) {
			$("#certificatehtml").html(result);
		});
		return false;
	}

	function certificateFunction() {
      // alert(certi);
      var x = confirm('Do you want to print it?, Please click on Yes.');
      if(x == true){
        var url = "<?php echo site_url('pages/download_certificate/')?>"+ certi;
      window.location.href = url;
      }

    }
</script>

