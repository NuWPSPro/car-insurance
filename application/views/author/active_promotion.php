<?php $this->load->view('template/picture_author'); ?>





 <div class="innerContent author-active-promotion">

	<div class="container">

		  

        <div class="row">
<!-- <div class="col-sm-12">
            <h3 class="border-title text-left">Dashboard</h3>
          </div> -->
       <?php  $this->load->view('author/sidebar');  ?>  

      



       <div class="col-sm-9">

            

            <h3 class="border-title text-left">Active Promotion</h3>
            <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">

          <thead>

                <tr>

                <th>No.</th>
                <th>Title</th> 
                <!-- <th>Category Training</th>  -->
                <th>Duration</th> 
                <th>Start Date</th> 
                <th>End Date</th> 
                <th>Countdown</th> 
                <th>Renew</th> 



                </tr>

            </thead>

                <?php 

                 $tot=0;

                 foreach ($purchase_list as $key => $value) {

                 $tot = $tot+$value['amount'];   



 

          /*1 Free, 2 Featured, 3Top List, 4 Premium*/



          if($value['paid_status']==0){



           $cont = "Incomplete";    



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

                <tr>

                  <td><?php echo $key+1; ?></td> 

                  <td><?php echo $value['name']; ?></td> 

                  <!-- <td><?php echo $value['course_title']; ?></td>   -->

                  <td><?php echo $value['units']; ?></td>  

                  <td><?php echo $cont; ?></td>  

                  <td>1 Months</td>  

                  <td><?php echo $value['added_on']; ?></td>  

                  <td><?php echo $value['expiry_on']; ?></td>  

                </tr>

                <?php 

                 }

                ?>

                     

                </tr>

            </table>
                </div>
            <?php 

            if(empty($purchase_list)){

              ?>

               <p style="color: red;">Sorry no records found.</p>

              <?php 

            }

            ?>

                       

            

        </div>

















<div class="col-sm-9">

            

            <h3 class="border-title text-left">Previous Promotion</h3>
            <div class="table-responsive">
        <table id="example1" class="table table-striped table-bordered" style="width:100%">

          <thead>

                <tr>

                <th>No.</th>
                <th>Title</th> 
                <!-- <th>Category Training</th>  -->
                <th>Duration</th> 
                <th>Start Date</th> 
                <th>End Date</th> 
                <th>Countdown</th> 
                <th>Renew</th> 



                </tr>

            </thead>

                <?php 

                 $tot=0;

                 foreach ($previous_list as $key => $value) {

                 $tot = $tot+$value['amount'];   



           if($value['paid_status']==0){



           $cont = "Incomplete";    



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

                <tr>

                  <td><?php echo $key+1; ?></td> 

                  <td><?php echo $value['name']; ?></td> 

                  <!-- <td><?php echo $value['course_title']; ?></td>   -->

                  <td><?php echo $value['units']; ?></td>  



                 <td><?php echo $cont; ?></td>  

                  <td>1 Months</td>  

                  <td><?php echo $value['added_on']; ?></td>  

                  <td><?php echo $value['expiry_on']; ?></td>  

                  <td><a class="btn btn-default" title="Promote" onclick="openpopup('30')" href="javascript:void(0)"><i class="fa fa-bullhorn"></i></a></td>  

                </tr>

                <?php 

                 }

                ?>

                     

                </tr>

            </table>
                </div>
            <?php 

            if(empty($purchase_list)){

              ?>

               <p style="color: red;">Sorry no records found.</p>

              <?php 

            }

            ?>

          

            

            

        </div>
        <a href="#" id="scroll" style="display: block;"><span></span></a>







































       </div>

	</div>

	</div>

</div>







<script type="text/javascript">

  

$(document).ready(function() {

    $('#example').DataTable();

    $('#example1').DataTable();

    //$('#example1').DataTable();

} );



</script>
<script type="text/javascript">
$(document).ready(function() {
 var pop = '<?php if($_REQUEST['id']=="done"){  ?>'+ $('#companyPromotionSuccess').modal('show') + '<?php } ?>';

    $('#example').DataTable();
    $('#example1').DataTable();
} );
</script>

