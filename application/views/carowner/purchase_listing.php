<?php  $this->load->view('carowner/picture'); ?>

		<!-- Main body start -->
		<div class="col-sm-9">
			<?=$body_heading; ?>
                <div class="table-responsive">
			        <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Insurance Package</th>
                            <th>Company Name</th>
                            <th>Broker Name</th>
                            <th>Price</th>
                            <th>Date Applied</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <?php if(!empty($buy_insurance)){
                                // echo '<pre>'; print_r($buy_insurance); echo '</pre>'; 
                                foreach($buy_insurance as $key => $buy):
                                if($buy['certificate_status']==1){ 
                                    $status ="<span class='text-success'>Genrated</span>";  
                                    $viewstyle = '';
                                    $comingstyle = 'none';
                                }else{
                                    $status ="<span class='text-danger'>Pending</span>";  
                                    $viewstyle = 'none';
                                    $comingstyle = '';
                                    }
                                    ?>
                                <td scope="row"><?php echo $key+1; ?>.</td>
                                <td><?php echo $buy['insur_name'] ?></td>
                                <td><?php echo $buy['first_name'].' '.$buy['middle_name'].' '.$buy['last_name']; ?></td>
                                <td><?php echo $buy['f_broker'].' '.$buy['m_broker'].' '.$buy['l_broker']; ?></td>
                                <td><?php echo $buy['price_insurance'] ?></td>
                                <td><?php echo $buy['added_on'] ?></td>
                                <td><?=$status; ?></td>
                                <td>   
                                <a href="javascript:void(0)" style="display:<?=$viewstyle;?>" onclick="alert('coming soon!');" style="display:<?=$vrbtn;?>" class="btn btn-primary m-1">View</a>    
                                <a href="javascript:void(0)" style="display:<?=$comingstyle;?>" style="display:<?=$vrbtn;?>" class="text-danger">Coming Soon</a>    
                                </td>
                        </tr>
                            <?php endforeach;
                           }else{
                            echo 'No Data Found!';
                           }  ?>

                    </table>
                </div>
        
		</div>
    <!-- Main body end -->


        <!-- these 3 div is starting in carowner pictuer -->
        </div>
    </div>
</div>


