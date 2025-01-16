<?php
  $uid = $this->session->userdata('logged_in')['id'];
  
        $this->db->from('tbl_adv_package_purchased'); 		
	    $this->db->where('user_id',$uid);
		$this->db->where('no_of_view >= total_view');    
        $this->db->where('payment_status',1);    
        $query = $this->db->get();
        $total_active = $query->num_rows();
		
		$this->db->select_sum('amount');
		$this->db->from('tbl_adv_package_purchased'); 		
	    $this->db->where('user_id',$uid);
		$this->db->where('payment_status',1);
	    $query = $this->db->get();
        $totalAmount = $query->row(); 
		
		
		$this->db->from('tbl_adv_package_purchased'); 		
	    $this->db->where('user_id',$uid);
		$this->db->where('payment_status',1);
		$this->db->where('status',1);
	    $query = $this->db->get();
        $total = $query->num_rows(); 
?>
    <div class="professionals-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="d-flex">
                        <?php 
                       
                        $userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array();
                        ?>
                        <div class="author-thumb usertype<?php echo $this->session->userdata('logged_in')['role'] ?>">
                            <?php 
                            if($userdata['image']==""){
                            ?>
                            <img src="<?php echo ASSETS_URL?>images/staff-3.png" alt="">
                            <?php 
                            } else {
                            ?>
                            <img src="<?php echo ASSETS_URL?>images/uploads/<?php echo $userdata['image'];?>" alt="">
                            <?php   
                            }
                            ?>
                        <!-- <div class="pos">Registered Nurse</div> -->
                        </div>
                        <div class="profile-content">
                            <p>
                                <?php 
                               //echo '<pre>'; print_r($userdata);
                                $date    = $userdata['added_on'];
                                $newdate = strtotime ( '+3 year' , strtotime ( $date ) ) ;
                                $newdate = date ( 'jS F, Y' , $newdate );
                                ?>
                                <?php echo $userdata['name']?>
                                <br>
                               	Country : <?php echo $this->db->get_where('countries',array('countries_id'=>$userdata['country']))->row_array()['countries_name'] ;?>
                                <br>
								Website : <?php echo $userdata['website'];?>
                                <br>
                                Licence : <?php echo $userdata['licence'];?>
                                <br> 
                                Validity : <?php echo $newdate; ?>
                            </p>
                        </div>
                    </div>
                    <div class="">
                        <?php if($this->session->userdata('logged_in')['role'] == 1){   
                        echo '<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#promoteProfile">Promote Your Practice</a>';
                        } ?>
                        <?php if($this->session->userdata('logged_in')['role'] == 2){   
                        echo '<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#promoteYourCompany">Promote Your Company</a>';
                        } ?>
                       <!-- <a href="<?php echo site_url('users/profile/'.$uid.'');?>" target="_blank" class="btn btn-success" style="margin-top:15px;">View My Page</a>-->
                    </div>
                </div>


                


                <div class="col-sm-8">
                    <div class="row banner-count-desc">
                     
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container"><?php echo $total_active; ?></div>
                            <h2>Active  Advertisement</h2>
                        </div>
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="background:#275bf4"><?php echo  $total;?></div>
                            <h2>Total Advertisement</h2>
                        </div>
                        <div class="col-xs-3 text-center item">
                            <div class="icon-container" style="background:#a80693"><?php echo $totalAmount->amount;?></div>
                            <h2>Total Cost</h2>
                        </div>
                       
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
       <!-- end modal -->
  