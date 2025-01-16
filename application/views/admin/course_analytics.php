 <?php $this->load->view('admin/picture'); ?>
 <div class="innerContent admin-course_analyticspanel">
	<div class="container">
        
		<div class="row">

		<?php $this->load->view('admin/sidebar'); ?>	

        <div class="col-sm-9">
            <h3 class="border-title text-left">Course Analytics</h3>
            <div class="step-wise-query">
             <?php echo $this->session->flashdata('response');?> 
             <div class="table-responsive">
             <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?php //echo '<pre>'; print_r($course); ?>
            <tr>
                <th>No.</th>
                <th>Course Title</th>  
                <th>User</th> 
                <th>Country</th> 
                <th>Units</th>  
                <th>Course Validity</th>  
                <th>Status</th>  
            </tr>
        </thead>
        <tbody>
           <?php 
                foreach ($course as $key => $value) {

                $before1month = date("Y-m-d", strtotime($value['course_validity']."-1 months"));
                if($value['status']==1){
                    if(date("Y-m-d")<=$before1month ){
                        $courseStts = "<strong class='text-success'>Valid</strong>";
                    }elseif(date("Y-m-d")>=$before1month && date("Y-m-d")<=$value['course_validity'])
                    {
                        $courseStts = "<strong class='text-warning blink'>Expiring</strong>";
                    }else{
                        $courseStts = "<strong  class='text-danger'>Expired</strong>";
                    }
                }elseif($value['status']==3 || $value['status']==0){
                        $courseStts = "--";
                }else{
                    $courseStts = "<strong class='text-danger'>Expired</strong>";
                } ?>
                <tr>
                    <td><?php echo $key+1; ?>.</td> 
                    <td><?php echo $value['course_title']; ?></td>  
                    <td><?php echo $value['name']; ?></td> 
                    <td><?php echo $value['countries_name']; ?></td> 
                    <td><?php echo $value['units']; ?></td>  
                    <td><?php echo $value['course_validity']; ?></td>  
                    <td><?php echo $courseStts; ?></td>                                        
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

<script type="text/javascript">
    
// $(document).ready(function() {
//     $('#example').DataTable();
// } );

</script>