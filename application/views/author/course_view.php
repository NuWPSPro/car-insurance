<?php $this->load->view('template/picture_author'); ?>

<div class="innerContent author-course-view">
	<div class="container">
		<div class="row">
<!-- <div class="col-sm-12">
        		<a href="<?php echo base_url();?>author/overview"><h3 class="border-title text-left">Dashboard</h3></a>
        	</div> -->
		<?php 		//$this->load->view('author/sidebar');		?>	
		<div class="col-sm-12">
		<?php 		//echo '<pre>';print_r($course); ?>
		<?php 	$title = $course[0]['course_title']; ?>

			<h3 class="border-title text-left">Course Details ( <?php echo $title;?> )</h3>
			<div class="step-wise-query">
			<?php echo $this->session->flashdata('response');?> 
			<div class="table-responsive">
			<table id="example1" class="table table-striped table-bordered" style="width:100%">

        <thead>
			<tr>
					<th>No.</th>
					<th>Lesson Title</th> 
					<th>Units</th> 
					<th>Course <br>Accreditation Number</th> 
					<th>Course Photo</th> 
					<!-- <th>Prof Name</th>  -->
					<th>Passing Mark</th> 
					<th>Paid Status</th> 
					<th>Date Uploaded</th> 
					<th>Validity Date</th>
					<!-- <th>Countdown</th> -->
            </tr>
        </thead>

        <tbody>

           <?php foreach ($course as $key => $value) { ?>

				<tr>
					<td><?php echo $key+1; ?>.</td> 
					<td><?php echo $value['course_title']; ?></td>     
					<td><?php echo $value['units']; ?></td>     
					<td><?php echo $value['course_acceditation_number']; ?></td>     
					<td>
						<img style="height: 150px;width:150px;" src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo']; ?>">
					</td>     
					<!-- <td><?php //echo $value['prof_name']; ?></td>     --> 
					<td><?php echo $value['passing_marks']; ?></td>     
					<?php 
					/*1 Free, 2 Featured, 3Top List, 4 Premium*/
					if($value['paid_status']==0){
					 $cont = "Not Published";		
					} else if($value['paid_status']==1){
					 $cont = "Free";		
					} else if($value['paid_status']==2){
					 $cont = "Featured";		
					} else if($value['paid_status']==3){
					 $cont = "Top List";		
					} else if($value['paid_status']==4){
					 $cont = "Premium";		
					}  	
					?>
					<td><?php echo $cont; ?></td>   

					<td><?php echo $value['added_on']; ?></td>     

					<td><?php echo $value['course_validity']; ?></td>  

					<?php $start = strtotime($value['added_on']);
							$end = strtotime($value['expiry_on']);

					$days_between = ceil(abs($end - $start) / 86400); ?>

					<!-- <td><?php echo $days_between; ?></td>      -->

																			

				</tr>

				<?php } ?>

        </tbody>

	  </table>
	</div>

	</div>	

  </div>









 <h3 class="border-title text-left">Course Certificate</h3>

			<div class="step-wise-query">

			 <?php echo $this->session->flashdata('response');?> 
					
			<div class="table-responsive">
			<table id="example1" class="table table-striped table-bordered" style="width:100%">

          <thead>
          	<?php if(empty($exam)){
           			echo'No Certificate found';
           }else{ ?>
            <tr>

                <th>No.</th>  
                <th>Course Certificate Number</th>  
				<th>Date Issued</th> 
				<th>Issued To</th> 
                <!-- <th>Name of Signatory/ies</th>   -->
                <th>Action</th>                  

            </tr>

        </thead>

        <tbody>

        <?php
				foreach ($exam as $key => $value) { 

                 $userdata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']);				
				
				
				?>
				<tr>

					<td><?php echo $key+1; ?>.</td> 												
					<td><?php echo $value['certificate_id']; ?></td>	
                    <td><?php echo $value['added_on']; ?></td>
                    <td><?php echo $userdata[0]['name']; ?></td>					
					<!-- <td><?php echo $course[0]['prof_name']; ?></td> -->
					<td>
                       <a href="javascript:void(0);" onclick="preview_certificate('<?php echo $value['certificate_id'];?>')" class="btn btn-default" title="View" ><i class="fa fa-eye"></i></a>
                     </td>												
				</tr>

				<?php } } ?>

        </tbody>

	  </table>
	</div>

	</div>	











 <h3 class="border-title text-left">Quiz Question</h3>

			<div class="step-wise-query">

			 <?php echo $this->session->flashdata('response');?> 

			 <div class="table-responsive">
			<table id="example1" class="table table-striped table-bordered" style="width:100%">

          <thead>

            <tr>

                <th>No.</th>

					

					<th>Question Title</th>  

					<th>Answere1</th>  

					<th>Answere2</th>  

					<th>Answere3</th>  

					<th>Answere4</th>  

					<th>Correct Answere</th>  
                    <th>Rational</th>  
            </tr>

        </thead>

        <tbody>

           <?php  

             
				foreach ($quiz as $key => $value) {

					$correctans = "answere".$value['correct_answere'];

					 

				?>

				<tr>

					<td><?php echo $key+1; ?>.</td> 

					<td><?php echo $value['question_title']; ?></td>           

					<td><?php echo $value['answere1']; ?></td>           

					<td><?php echo $value['answere2']; ?></td>           

					<td><?php echo $value['answere3']; ?></td>           

					<td><?php echo $value['answere4']; ?></td>           

					<td><?php echo $value[$correctans]; ?></td>           
                    <td><?php echo $value['rational']; ?></td>           

																			

				</tr>

				<?php } ?>

        </tbody>

	  </table>
	</div>

	</div>	













		  <h3 class="border-title text-left">Lesson Details</h3>

			<div class="step-wise-query">

			 <?php echo $this->session->flashdata('response');?> 
			<div class="table-responsive">
			<table id="example1" class="table table-striped table-bordered" style="width:100%">

          <thead>

            <tr>

                <th>No.</th>

					

					<th>Lesson Title</th>  

					<th>Lesson Content</th>  

					<th>Case Study</th>  

					<th>Summary</th>  

					<th>Course References</th>  

            </tr>

        </thead>

        <tbody>

           <?php 

				foreach ($lesson as $key => $value) {

				?>

				<tr>

					<td><?php echo $key+1; ?>.</td> 

					<td><?php echo $value['lesson_title']; ?></td>      

					<td><?php echo $value['lesson_content']; ?></td>      

					<td><?php echo $value['case_study']; ?></td>      

					<td><?php echo $value['summary']; ?></td>      

					<td><?php echo $value['course_references']; ?></td>      

																			

				</tr>

				<?php } ?>

        </tbody>

      </table>
	</div>
	</div>	
		

	<h3 class="border-title text-left"> Report Abuse</h3>
	<div class="step-wise-query">
		<?php echo $this->session->flashdata('response');?> 

<div class="table-responsive">
	<table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
				<th>Name</th>  
				<th>Comments</th>  
				<th>Date</th>  
            </tr>
        </thead>

        <tbody>
           <?php $count=1;
           foreach ($report as $key => $value) { 
		   $name 	= $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']);?>
				<tr>
					<td><?php echo $count; ?>.</td> 
					<td><?php echo strip_tags($name[0]['name']); ?></td> 
					<td><?php echo strip_tags($value['comment']); ?></td> 
					<td><?php echo strip_tags($value['added_on']); ?></td> 
				</tr>
			<?php $count++; } ?>
        </tbody>
      </table>
	</div>	
</div>	

			<h3 class="border-title text-left">Course Evaluation: (<?php  echo count($evaluation); ?> People Rate this course) </h3>
				<div class="step-wise-query">
					<table>
						
						<tr>
							<?php $count = $star[0]['star_mark'];
								echo '<strong> Average Rating : </strong>'; 

							for($i=1;$i<=$count;$i++){
								echo'<i class="fa fa-star" aria-hidden="true"></i>';
							}
							?>
            			</tr>
			        </table>
				</div>

				<h3 class="border-title text-left">Comments: ( <?php echo count($evaluation); ?> People Comment on this course) </h3>
				<div class="step-wise-query">
					<table>
						<?php foreach($evaluation as $key => $value){ ?>
						<tr>
							<th>Comments &nbsp; <?php echo $key+1;?> : </th>
							<td> <?php echo $value['comments']; ?></td>
            			</tr>
						<?php } ?>
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
	    $('#example1,#example').DataTable();
	} );

	function preview_certificate(certifiacte_no) {
	    $('#myModalcertificate').modal('show');
	    $.ajax({
	        type: "POST",
	        url: '<?php echo base_url()."users/certificate_download";?>',
	        data: { certifiacte_no: certifiacte_no }
	    }).done(function(result) {
	        $("#filteredData22").html(result);
	    });
	    return false;
	}

</script>