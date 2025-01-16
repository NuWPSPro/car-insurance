<?php $this->load->view('template/picture'); ?>





 <div class="innerContent">

	<div class="container">

		  

        <div class="row">
<div class="col-sm-12">
            <h3 class="border-title text-left">Dashboard</h3>
          </div>
       <?php  $this->load->view('professional/sidebar');  ?>  

      



       <div class="col-sm-9">

            

            <h3 class="border-title text-left">Exame List</h3>
            <div class="table-responsive">
        <table id="example" class="table dataTable  table-striped table-bordered" style="width:100%" >

          <thead>

                <tr>

                <th>S.N.</th>
                <th>Name</th> 
                <!-- <th>Category Training</th>  -->
                <th>Course</th> 
                <th>Percentages</th> 
                <th>Certificate ID</th> 
                <th>Barcode</th> 
                <th>Date</th> 
                <th>Action</th> 



                </tr>

            </thead>

                <?php 

                 $tot=1;

                 foreach ($exam_list as $key => $value)
				 {

                

                ?>

                <tr>

                  <td><?php echo $tot++; ?></td> 
                  <td><?php echo $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['name']; ?></td>  

                  <td><?php echo $this->db->get_where('tbl_course',array('id'=>$value['course_id']))->row_array()['course_title']; ?></td> 

                <td><?php echo $value['percentages']; ?></td> 


                  <td><?php echo $value['certificate_id']; ?></td>  

                  <td>
				  <?php
				 if(empty($value['barcode']))
				 {
					 echo "NA";
				 }
				 else
				 {
				  ?>
				  <img src="<?php echo ASSETS_URL?>images/uploads/<?php echo $value['barcode']; ?>">
<?php
				 }
?>
				  </td>  

                  <td><?php echo $value['added_on']; ?></td>  
                  <td><a href="<?php echo site_url('pages/pdf/'.$value['user_id'].'');?>">
                            <input type="button" class="btn" value="Download Certificate">
                        </a></td>  

                  

                </tr>

                <?php 

                 }

                ?>

                     

           

            </table>
                </div>
            <?php 

            if(empty($exam_list)){

              ?>

               <p style="color: red;">Sorry no records found.</p>

              <?php 

            }

            ?>

                       

            

        </div>



        </div>




</div>


































       </div>

	</div>

	</div>

</div>




<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
});
</script>


</script>

