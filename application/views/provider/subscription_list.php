<?php $this->load->view('template/picture_provider'); ?>





 <div class="innerContent">

	<div class="container">


        <div class="row">
<div class="col-sm-12">
            <h3 class="border-title text-left">Dashboard</h3>
          </div>
       <?php  $this->load->view('provider/sidebar');  ?>  

      



       <div class="col-sm-8">

             <?php echo $this->session->flashdata('response');?>

            <h3 class="border-title text-left">Subscription List</h3>

            <table class="table table-striped table-bordered">

                <tr>

                    <th>No.</th>

                    <th>Plan Name</th>

                    <th>Plan Price</th>

                    <th>No of allowed upload seminar</th>

                    </tr>

                <?php 

                 $tot=0;

                 foreach ($subs_list as $key => $value) {

                  

                 $sdata = $this->user->get_record_by_field_name_all_record('tbl_provider_subscription_plan','id',$value['plan_id']);



                ?>

                <tr>

                    <td><?php echo $key+1;?>.</td>

                    <td><?php echo $sdata[0]['plan_name'];?></td>

                    <td><?php echo $sdata[0]['plan_price'];?></td>

                    <td><?php echo $sdata[0]['allow_number'];?></td>

                </tr>

                <?php 

                 }

                ?>

                   

                </tr>

            </table>

            

            

            <!-- Modal -->

            <div class="modal fade" id="myModal" role="dialog">

            <div class="modal-dialog">

              <div class="modal-content">

                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                  <h4 class="modal-title">Receipt No. 12345</h4>

                </div>

                <div class="modal-body">

                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                </div>              

              </div>

            </div>

            </div>

            

            

        </div>





       </div>

	</div>

	</div>

</div>