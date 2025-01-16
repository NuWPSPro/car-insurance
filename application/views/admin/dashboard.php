<?php $this->load->view('admin/picture'); ?>
<div class="innerContent admin-dashboardpanel">
    <div class="container">
        <div class="row">
            <?php  $this->load->view('admin/sidebar');  ?>
            <div class="col-sm-9">
                <h3 class="border-title text-left">Income Report</h3>
                  <div class="col-sm-3 col-xs-6 form-group">
                      <?php $today_total = ($today >0)? $today:0; 

                      /* foreach ($today as $key => $value) {
                        $amt = $value['amount'] * $value['quantity'];
                        $today_total = $today_total + $amt;
                    } */

                    ?>
                    <div class="circle-income text-center">
                      <span>$<?php echo number_format(floatval($today_total),2);?></span>
                      <strong>TODAY'S INCOME</strong>
                    </div>
                  </div>
                  <div class="col-sm-3 col-xs-6 form-group">
                      <?php $month_total = $month;
                      /* foreach ($month as $key => $value) {
                                $amt = $value['amount'] * $value['quantity'];
                                $month_total = $month_total + $amt;
                      } */  ?>
                    <div class="circle-income text-center">
                      <span>$<?php echo number_format(floatval($month_total),2);?></span>
                      <strong>MONTH INCOME</strong>
                    </div>
                  </div>
                  <div class="col-sm-3 col-xs-6 form-group">
                      <?php  $year_total = $year;  
                    /*  foreach ($year as $key => $value) {
                        $amt = $value['amount'] * $value['quantity'];
                        $year_total = $year_total + $amt;
                    } */ ?>
                    <div class="circle-income text-center">
                      <span>$<?php echo number_format(floatval($year_total),2);?></span>
                      <strong>YEAR INCOME</strong>
                    </div>
                  </div>
                  <div class="col-sm-3 col-xs-6 form-group">
                      <?php

                      $total_total = $total; 

                    /*  foreach ($total as $key => $value) {
                        $amt = $value['amount'] * $value['quantity'];
                        $total_total = $total_total + $amt;
                    } */
                    ?>
                    <div class="circle-income text-center">
                      <span>$<?php echo number_format(floatval($total_total),2);?></span>
                      <strong>TOTAL INCOME</strong>
                    </div>
                  </div>
<?php 

$month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

if($_REQUEST['month'] !=""){
  $mm = $_REQUEST['month'];
} else {
  $mm = date('m');
}

if($_REQUEST['year'] !=""){
  $yy = $_REQUEST['year'];
} else {
  $yy = date('Y');
}

$uid = $_REQUEST['users'];

$country = $this->user->get_all_country();
?>

        <?php 
        $idd1 = $this->uri->segment(3);
        $cuntry1 = $this->db->get_where('countries',array('countries_id'=>$idd1,'display'=>'Yes'))->row_array(); 
        $cuntry13 = $this->db->get_where('countries',array('status'=>'1'))->result_array(); 
        $cnt = strtolower($cuntry1['countries_iso_code']);
        $idd1=$this->session->userdata('current_country'); ?> 


<div class="row">
  <div class="col-sm-12">
    <h2 class="text-center"><u>Detailed Income Report</u></h2>
    <h3 class="text-center"><?php echo date('F d, Y'); ?></h3>
      <div class="alert alert-info clearfix">

    <form action="<?php echo base_url('admin/dashboard'); ?>" method="get" name="filter22222" id="filter22222" > 
      <div class="col-sm-3 form-group">
            <label>Country<sup></sup></label>
          <select name="countrylist" id="country" class="form-control">
              <option value="">International</option>
            <?php foreach($cuntry13 as $c){ ?>
              <option <?php if($_REQUEST['countrylist']==$c['countries_id']){ echo "selected";}?> value="<?=$c['countries_id']?>" <?php if($idd1==$c['countries_id']){ echo "selected" ;} ?>>
                <?=$c['countries_name']?>
              </option>
            <?php } ?>
          </select>
        <span class="error"></span>
      </div>
   <script type="text/javascript">
          /*   function filter() 
			{
             
              var idd = $('#countrylist').val();
              
            } */
  </script>   
        <div class="col-sm-3 form-group">
              <label>User Role<sup></sup></label>
              <select name="role" id="roleselect" class="form-control" >
                  <option value="" >...All...</option>
                  <option  <?php if($_REQUEST['role']==1){ echo "selected";}?> value="1" >Professional</option>
                  <option  <?php if($_REQUEST['role']==2){ echo "selected";}?> value="2" >CPD Provider</option>
                  <option  <?php if($_REQUEST['role']==3){ echo "selected";}?> value="3" >Placement Agencies</option>
                  <option  <?php if($_REQUEST['role']==4){ echo "selected";}?> value="4" >Advertisers</option>
                  <option  <?php if($_REQUEST['role']==5){ echo "selected";}?>  value="5">Insititution</option>
              </select>
              <span class="error"></span>
        </div>

         <div class="col-sm-3 form-group">
              <label>Select User<sup></sup></label>
              <select name="users" id="userselectsss" class="form-control">
			  <option value="">Select Role First</option>
                
              </select>
              <span class="error"></span>
        </div>
  <!-- <div class="col-sm-3 form-group">
      <label>Date <sup>*</sup></label>
        <input type="date" name="date" class="form-control">
        <span class="error"></span>
    </div>  -->


<?php  $parameter = $_REQUEST; ?>

  <div class="col-sm-3 form-group">
      <label>Day <sup></sup></label>
        <select name="day" id="day" class="form-control" >
            <option value="" <?php if(!is_array($parameter) || $parameter['day']==""){echo "selected";} ?>>...Select...</option>
            <?php for ($i=1; $i<=31; $i++) { ?>
                <option  <?php if($_REQUEST['day']==$i){ echo "selected";}?>  value="<?php echo $i;?>">
                    <?php echo $i; ?>
                </option>
                <?php } ?>
        </select>
        <span class="error"></span>
    </div>



   <div class="col-sm-3 form-group">
      <label>Month <sup></sup></label>
        <select name="month" id="month" class="form-control" >
            <option value="" <?php if(!is_array($parameter) || $parameter['month']==""){echo "selected";} ?>>...Select...</option>
            <?php 
                foreach ($month as $key => $value) { ?>

                <option  <?php if($_REQUEST['month']==$key){ echo "selected";}?>  value="<?php echo $key;?>">
                    <?php echo $value; ?>
                </option>
                
                <?php } ?>

        </select>
        <span class="error"></span>
    </div>




 <div class="col-sm-3 form-group">
        <label>Year <sup></sup></label>
        <select name="year" id="year" class="form-control" >
            <?php 
            $year = date('Y');
            for ($i=2015; $i <=$year ; $i++) { 
            ?>
              <option <?php if($_REQUEST['year'] ==$i){ echo "selected";} ?> value="<?php echo $i;?>">
                <?php echo $i;?></option>
            <?php } ?>
    </select>
    <span class="error"></span>
</div> 


	<div class="col-sm-2 col-xs-2 form-group">
		<input style="margin-top: 30px;" type="submit" id="filterform" name="submit" class="btn btn-primary" value="Filter" >
	</div> 

	<div class="col-sm-2 col-xs-2 form-group">
		<a href="<?php echo site_url('admin/dashboard/?month=&year='.date('Y').'');?>">    
		<input style="margin-top: 30px;" type="submit" class="btn btn-primary" value="Reset">
	 </a>
	</div>

</form>
</div>
</div>
</div>
  <?php 
      // $cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','id',$param['course_category']);
      // $country = $this->user->get_record_by_field_name_all_record('countries','countries_id',$param['country_id']);
    ?>
<div class="row">
    <ul class="breadcrumb">
        <li>
		<?php
			//print_r($parameter);
			if(count($parameter) == 0 || $parameter['countrylist'] == ""){
				echo 'International';				
			}else{
				$matchcity = '';
				foreach($cuntry13 as $c){
					if($parameter['countrylist'] == $c['countries_id'] && $matchcity == ""){ 
						echo $c['countries_name'];
						$matchcity = $c['countries_name'];
					}
					
				}
			}
		?>
		</li>
        <li>
			<?php 
				if($parameter['role']==1){ 
					echo "Professional";
				}
				elseif($parameter['role']==2){ 
					echo "CPD Provider";
				}elseif($parameter['role']==3){ 
					echo "Placement Agencies";
				}elseif($parameter['role']==4){ 
					echo "Advertisers";
				}elseif($parameter['role']==5){ 
					echo "Insititution";
				}elseif($parameter['role']==6){ 
					echo "Author";
				}elseif($parameter['role']==7){ 
					echo "Rboard";
				}else{
					echo "All";
				}
			?>
		</li>
		<li>
			<?php 
				if(count($parameter) == 0){
					echo date('M-d-y');
				}else{
					$day = $parameter['day'];
          $month = $parameter['month'];
					$year = $parameter['year'];
					if($day && $month && $year){
          echo date('d-F-Y',strtotime($day.'-'.$month.'-'.$year));
					}elseif($month && $year){
					echo date('F-Y',strtotime('01-'.$month.'-'.$year));
          }else{
						echo $year;
					}
					
				}
			?>
		</li>
        <!-- <li><?php if(!empty($country)){ echo $country[0]['countries_name']; }else{ ?>International<?php } ?></li> -->
        
    </ul>
</div>





<div class="row">

<div class="nav nav-tabs" id="myTab" role="tablist">
  
		<?php 
		// echo '<pre>'; print_r($rboard); exit;
		$advc 			    = count($advs);
		$tmssc 			    = count($tmss);
    // $tmspublishc = count($tmspublish);
		$coursec 		    = count($courses);
		$promotionsc 	  = count($promotionscp) + count($promotionstp) + count($promotion);
		$certificatec 	= count($certificate); 
		$pcemscount 	  = count($pcems); 
    $staffcount     = count($staff); 
    $rboardcount     = count($rboard); 
		$sum = $advc + $tmssc + $coursec + $promotionsc + $certificatec + $pcemscount + $staffcount +$rboardcount; 
    // $tax = $this->db->get_where('tbl_misc',array('id'=>1))->row_array()['set_percentage']; ?>


    <!-- Calculation total proce -->
    <?php 
    $allData = array_merge($advs,$tmss,$courses,$promotionscp,$promotionstp,$promotion,$certificate,$pcems,$staff,$rboard);
    $allsum = 0;
    // foreach ($allData as $key => $value) {
    //    ///$commistion = ($value['price']*5)/100;
    //    //$price = $value['price'] + $commistion;
    //    // echo $key.'-->'.$value['price'].'<br>';
    //    $tax = $value['tax'];
    //    $price = $value['price'] - $tax;
    //    $allsum += $price;
    // }


    $onlinecoursesum = 0;
    foreach ($courses as $key => $value) {
       //$commistion = ($value['price']*5)/100;
       //$price = $value['price'] + $commistion;
       $tax = $value['tax'];
       $adminmargin = $value['price'] - $tax;
       $price = ($adminmargin*30)/100;
       $onlinecoursesum += $price;
    }

    $tmssSum = 0;
    foreach ($tmss as $key => $value) {
       //$commistion = ($value['price']*5)/100;
       //$price = $value['price'] + $commistion;
      $tax = $value['tax'];
      $price = $value['price'] - $tax;
      $tmssSum += $price;
    }

    $certificateSum = 0;
    foreach ($certificate as $key => $value) {
       //$commistion = ($value['price']*5)/100;
       //$price = $value['price'] + $commistion;
        $tax = ($value['tax'] * $value['num_of_participants']);
        $price = $value['price'] - $tax;
        $certificateSum += $price;
    } 


    $pcemsSum = 0;
    foreach ($pcems as $key => $value) {
       //$commistion = ($value['price']*5)/100;
       //$price = $value['price'] + $commistion;
       $tax = $value['tax'];
       $price = $value['price'] - $tax;
       $pcemsSum += $price;
    }
    
    $promotionSum = 0;
    $promo = array_merge($promotionscp,$promotionstp,$promotion);
    foreach ($promo as $key => $value) {

      $tax = $value['tax'];
      $price = $value['price'] - $tax;
      $promotionSum += $price;
    }

    $advsSum = 0;
    foreach ($advs as $key => $value) {
       //$commistion = ($value['price']*5)/100;
       //$price = $value['price'] + $commistion;
       $tax = $value['tax'];
       $price = $value['price'] - $tax;
       $advsSum += $price;
    }

    $staffSum = 0; 
    foreach ($staff as $key => $value) {
       //$commistion = ($value['price']*5)/100;
       //$price = $value['price'] + $commistion;
       
        $tax = ($value['tax'] * $value['num_of_prof']);
        $price = $value['price'] - $tax;
        $staffSum += $price;
    } 
  
    $rboardIncome = 0;
    foreach ($rboard as $key => $value) {
        // $tax = $value['tax'];
        $price = $value['price'];
        $rboardIncome += $price;
    } 
    $allsum = $onlinecoursesum + $tmssSum + $certificateSum + $pcemsSum + $promotionSum + $advsSum + $staffSum + $rboardIncome; ?>
    <!-- End calculation total proce -->
  <a id="contact-tab" data-toggle="tab" href="#all" role="tab" aria-controls="contact" aria-selected="true">
  <div class="col-sm-3 col-xs-6 form-group">
      <div class="circle-income text-center">
          <span>$<?php echo number_format(floatval($allsum),2); ?></span>
          <div style="color: blue;" >ALL</div>
      </div>
  </div>
  </a>

  <!-- <div class="col-sm-10"> -->
  <a id="contact-tab" data-toggle="tab" href="#online-course" role="tab" aria-controls="contact" aria-selected="false">
  <div class="col-sm-3 col-xs-6 form-group">
      <div class="circle-income text-center">
          <span>$<?php echo number_format(floatval($onlinecoursesum),2); ?></span>
          <div style="color: blue;">ONLINE COURSE</div>
      </div>
  </div>
  </a>

  <a id="contact-tab" data-toggle="tab" href="#tms" role="tab" aria-controls="contact" aria-selected="false">
  <div class="col-sm-3 col-xs-6 form-group">
      <div class="circle-income text-center">
          <span>$<?php echo number_format(floatval($tmssSum),2); ?></span>
          <!-- <div style="color: blue;">TMS</div> -->
          <div style="color: blue;">MTS PRO Template</div>
      </div>
  </div>
  </a>
 

  <a id="contact-tab" data-toggle="tab" href="#certificate" role="tab" aria-controls="contact" aria-selected="false">
  <div class="col-sm-3 col-xs-6 form-group">
      <div class="circle-income text-center">
          <span>$<?php echo number_format(floatval($certificateSum),2); ?></span>
          <div style="color: blue;">CERTIFICATES</div>
      </div>
  </div>
  </a>
 
 
  <a  id="contact-tab" data-toggle="tab" href="#promotion" role="tab" aria-controls="contact" aria-selected="false">
  <div class="col-sm-3 col-xs-6 form-group">
      <div class="circle-income text-center">
	     <span>$<?php echo number_format(floatval($promotionSum),2); ?></span>
          <div style="color: blue;">PROMOTION</div>
      </div>
  </div>
  </a>

    <a  id="contact-tab" data-toggle="tab" href="#advertisement" role="tab" aria-controls="contact" aria-selected="false">
	  <div class="col-sm-3 col-xs-6 form-group">
		  <div class="circle-income text-center">
			  <span>$<?php echo number_format(floatval($advsSum),2); ?></span>
			  <div style="color: blue;">ADVERTISMENT</div>
		  </div>
	  </div>
  </a>
 
  <a  id="contact-tab" data-toggle="tab" href="#pcems" role="tab" aria-controls="contact" aria-selected="false">
	  <div class="col-sm-3 col-xs-6 form-group">
		  <div class="circle-income text-center">
			  <span>$<?php echo number_format(floatval($pcemsSum),2); ?></span>
			  <div style="color: blue;">PCE-MS PRO</div>
		  </div>
	  </div>
  </a>

  <a  id="contact-tab" data-toggle="tab" href="#staff" role="tab" aria-controls="contact" aria-selected="false">
    <div class="col-sm-3 col-xs-6 form-group">
      <div class="circle-income text-center">
        <span>$<?php echo number_format(floatval($staffSum),2); ?></span>
        <!-- <div style="color: blue;">Staff</div> -->
        <div style="color: blue;">PCE-MS Premium</div>
      </div>
    </div>
  </a>

  <a  id="contact-tab" data-toggle="tab" href="#rboard" role="tab" aria-controls="contact" aria-selected="false">
    <div class="col-sm-3 col-xs-6 form-group">
      <div class="circle-income text-center">
        <span>$<?php echo number_format(floatval($rboardIncome),2); ?></span>
        <div style="color: blue;">RBoard</div>
      </div>
    </div>
  </a>
  <!-- </div> -->
  </div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 <div class="row">
  <div class="col-sm-12">      
    <div class="tab-content" id="myTabContent">
		<div class="tab-pane fade active in" id="all" role="tabpanel" aria-labelledby="home-tab">
			<h2>All Data</h2>	
			<?php 
        $all = array();
      foreach($advs as $value){
         $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $all[] = array(
            'id'          => $value['id'],
            'type'        => 'Advertise',
            'no_of_view'  => $value['no_of_view'],
            'quantity'    => 1,
            'added_on'    => $value['added_on'],
            'item_name'   => $value['item_name'],
            'amount'      => $value['amount'],
            'tax'         => $value['tax'],
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => '--',
            'channel'       => $channel, 
            'price'       => $value['price'] );

      }
       foreach($tmss as $value){
         $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $course_owner = $this->db->get_where('tbl_user',array('id'=>$value['owner_id']))->row_array()['name'];
        $all[] = array(
            'id'          => $value['id'],
            'type'        => 'TMS Pro',
            'no_of_view'  => $value['no_of_view'],
            'quantity'    => 1,
            'added_on'    => $value['added_on'],
            'item_name'   => $value['item_name'],
            'amount'      => $value['amount'],
            'tax'         => $value['tax'],
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => $course_owner,
            'channel'       => $channel, 
            'price'       => $value['price'] );

      }
      foreach($courses as $value){
         $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $course_owner = $this->db->get_where('tbl_user',array('id'=>$value['id']))->row_array()['name'];
        $all[] = array(
            'id'          => $value['pid'],
            'type'        => 'Course',
            'no_of_view'  => $value['no_of_view'],
            'quantity'    => 1,
            'added_on'    => $value['added_on'],
            'item_name'   => $value['item_name'],
            'tax'         => $value['tax'],
            'amount'      => $value['amount'],
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => $course_owner,
            'channel'       => $channel, 
            'price'       => $value['price'] );

      }
       foreach($promotionscp as $value){
         $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $all[] = array(
            'id'          => $value['id'],
            // 'type'        => 'Promotionscp',
            'type'        => 'Course Promotion',
            'no_of_view'  => $value['no_of_view'],
            'quantity'    => 1,
            'added_on'    => $value['added_on'],
            'item_name'   => $value['item_name'],
            'amount'      => $value['amount'],
            'tax'         => $value['tax'],
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => '--',
            'channel'       => $channel, 
            'price'       => $value['price'] );

      }
      foreach($promotionstp as $value){
         $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $all[] = array(
            'id'          => $value['id'],
            // 'type'        => 'Promotionstp',
            'type'        => 'Training Promotion',
            'no_of_view'  => $value['no_of_view'],
            'quantity'    => 1,
            'added_on'    => $value['added_on'],
            'item_name'   => $value['item_name'],
            'amount'      => $value['amount'],
            'tax'         => $value['tax'],
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => '--',
            'channel'       => $channel, 
            'price'       => $value['price'] );

      }
      foreach($promotion as $value){
         $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $json       = json_decode($value['transaction_details']);
        $all[] = array(
            'id'          => $value['id'],
            // 'type'        => 'Promotionsuser',
            'type'        => 'Promotion',
            'no_of_view'  => $value['no_of_view'],
            'quantity'    => 1,
            'added_on'    => $value['added_on'],
            'item_name'   => $json->item_name,
            'amount'      => $value['amount'],
            'tax'         => $value['tax'],
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => '--',
            'channel'       => $channel, 
            'price'       => $value['price'] );

      }
       foreach($certificate as $value){
         $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $all[] = array(
            'id'          => $value['id'],
            // 'type'        => 'Certificate Issued',
            'type'        => 'Digital Certificate Subscription',
            // 'no_of_view'  => $value['no_of_view'],
            'quantity'    => 1,
            'added_on'    => $value['added_on'],
            'item_name'   => $value['item_name'],
            'amount'      => $value['amount'],
            'tax'         => ($value['tax']*$value['num_of_participants']),
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => '--',
            'channel'       => $channel, 
            'price'       => $value['price'] );

      }
       foreach($pcems as $value){
         $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $all[] = array(
            'id'          => $value['iid'],
            'type'        => 'Pcems',
            'no_of_view'  => $value['no_of_view'],
            'quantity'    => 1,
            'added_on'    => $value['added_on'],
            'item_name'   => $value['item_name'],
            'amount'      => $value['amount'],
            'tax'         => $value['tax'],
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => '--',
            'channel'       => $channel, 
            'price'       => $value['price'] );
      }

      foreach($staff as $value){
        $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $json = json_decode($value['transaction_details']);
        $all[] = array( //Cepins900 - Staff Activation
            'id'            => $value['iid'],
            'type'          => 'Staff',
            'no_of_view'    => $value['no_of_view'],
            'quantity'      => 1,
            'added_on'      => $value['added_on'],
            'item_name'     => $json->item_name,
            'amount'        => $value['amount'],
            'tax'           => ($value['tax'] * $value['num_of_prof']),
            'role'          => $value['role'],
            'user_id'       => $value['user_id'],
            'username'      => $value['username'],
            'location'      => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title'  => $value['course_title'],
            'course_owner'  => '--',
            'channel'       => $channel, 
            'price'         => $value['price']);
      }

      foreach($rboard as $value){
        $txn = mb_substr($value['txn_id'], 0, 5);
        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
        $json = json_decode($value['transaction_details']);
        $all[] = array( 
            'id'            => $value['iid'],
            'type'          => 'RBoard',
            // 'no_of_view'    => $value['no_of_view'],
            'quantity'      => 1,
            'added_on'      => $value['added_on'],
            'item_name'     => $value['item_name'],
            'amount'        => $value['amount'],
            'tax'           => 0,
            'role'          => $value['role'],
            'user_id'       => $value['user_id'],
            'username'      => $value['username'],
            'location'      => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title'  => $value['course_title'],
            'course_owner'  => '--',
            'channel'       => $channel, 
            'price'         => $value['price']);
      }

       // echo'<pre>';print_r($all);
			// $all = array_merge($advs,$tmss,$courses,$promotionscp,$promotionstp,$certificate,$pcems);
      if(count($all) > 0){ ?>	
    <div class="mob-tablescroll"> 
			<table class="table table-striped table-bordered nktable" id="incomereport">
                <tr>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Item Name</th>
                    <th>Income Source</th>
                    <th>Quantity</th>
				           	<th>Unit Price</th>
                    <th>Tax</th>
                    <!-- <th>Paypal Charge</th> -->
                    <th>Amount</th>
                    <th>Net Income</th>
                    <th>Admin (30%)</th>
                    <th>CEP (70%)</th>
                    <th>Admin Net Income</th>
                    <th>Course Owner</th>
                    <th>Purchased Date </th>
                    <th>Country</th>
                    <th>Channel</th>
                    <th>Action</th>
                </tr>
                    <?php 
                    $sum = 0;
                    $unitSum = 0; 
                    $taxSum = 0; 
                    $paypalSum = 0; 
                  
                    $netIncomeSum = 0; 
                    $adminIncomeSum = 0; 
                    $cepIncomeSum = 0; 
                    $adminnetIncomeSum = 0; 
                      //$data = array_merge($filter,$filters); 
                      // echo '<pre>'.count($data); print_r($data);
                      
                      // echo '<pre>'.count($all); print_r($all); die;
                            foreach ($all as $key => $value) { 
                      $course_name = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
                      $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 
                      
                        $price = floatval($value['price']);

                        $tax = floatval($value['tax']);
                        
                        $unitPrice = number_format($price - $tax,2);

                        $netIncome = $unitPrice;
                        if($value['type']=='Course'){
                          $adminIncome    = ($unitPrice*30)/100;
                          $cepIncome      = ($unitPrice*70)/100;
                          $adminNetIncome = $adminIncome;
                        }else{
                          $adminIncome    = '--';
                          $cepIncome      = '--';
                          $adminNetIncome = $netIncome;
                        }
                        $txn = mb_substr($value['txn_id'], 0, 5);
                        if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}

                        
                      ?>
                    <tr>
                        <td class="text-center"> <?php echo $key+1;?>  </td>

                        <td class="text-center"> <?= $value['username'] ?> </td> 

					             	<td class="text-center">  <?= $value['item_name'] ?> </td>

                        <td class="text-center">  <?= $value['type'] ?> </td>

                        <td class="text-center">  <?php echo $value['quantity'];?>  </td>

  						          <td class="text-center">  <?php echo $unitPrice;?> </td>
                        
                        <td class="text-center"> <?php echo $tax;?> </td>

                        <!-- <td class="text-center">  <?php echo $paypalCharge;?> </td> -->

                        <td class="text-center"> <?php echo $price; ?>   </td>  

                        <td class="text-center"> <?php echo $netIncome; ?>  </td>

                        <td class="text-center"><?php echo $adminIncome; ?></td>

                        <td class="text-center"> <?php echo $cepIncome; ?>  </td>

                        <td class="text-center"> <?php echo $adminNetIncome; ?>  </td>

                        <td class="text-center"> <?php echo $value['course_owner']; ?> </td>
                        
                        <td> <?php echo $value['added_on']; ?> </td>

                        <td> <?php echo $value['countries_name']; ?></td>

                        <td><?php echo $value['channel']; ?></td>
                        
                        <td> <a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']?>','<?php echo $value['type']; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td>  
                          
                        
                    </tr>
                           
                        <?php 
                        $sum += $price;


                        $unitSum += $unitPrice; 
                        $taxSum += $tax; 
                        $paypalSum += $paypalCharge;  
                        $netIncomeSum += $netIncome; 
                        // $adminIncomeSum += $adminIncome; 
                        // $cepIncomeSum += $cepIncome; 
                        $adminIncomeSum = 0; 
                        $cepIncomeSum = 0; 
                        $adminnetIncomeSum += $adminNetIncome;


                        ?>

                        <?php } ?>
                    <tr>
                        <td colspan="5"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($cepIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
      </table>
    </div>
				<?php }else{
					echo '<p>No purchase records found.</p>';
				} ?>

		</div>
 
 
	 <div class="tab-pane fade" id="online-course" role="tabpanel" aria-labelledby="home-tab">
				<h2>Online Course</h2>
       <?php if(count($courses) > 0){ ?>	
        
    <div class="mob-tablescroll">
			<table class="table table-striped table-bordered" id="incomereport">
                 <tr>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Tax</th>
                    <!-- <th>Paypal Charge</th> -->
                    <th>Amount</th>
                    <th>Net Income</th>
                    <th>Admin (30%)</th>
                    <th>CEP (70%)</th>
                    <th>Admin Net Income</th>
                    <th>Course Owner</th>
                    <th>Purchased Date </th>
                    <th>Country</th>
                    <th>Channel</th>
                    <th>Action</th>
                </tr>
                  <?php 
                  $sum = 0;
                  $unitSum = 0; 
                  $taxSum = 0; 
                  $paypalSum = 0; 
                
                  $netIncomeSum = 0; 
                  $adminIncomeSum = 0; 
                  $cepIncomeSum = 0; 
                  $adminnetIncomeSum = 0; 
              
                    foreach ($courses as $key => $value) { 
                    $txn = mb_substr($value['txn_id'], 0, 5);
                    if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
                    $course_owner = $this->db->get_where('tbl_user',array('id'=>$value['owner']))->row_array()['name'];
                    $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 


                      $price = number_format(floatval($value['price']),2);
                      $tax = $value['tax'];
                      
                      $unitPrice = number_format(floatval($price - $tax),2);

                      $netIncome = $unitPrice;
                      $adminIncome = number_format(floatval(($unitPrice*30)/100),2);
                      $cepIncome = number_format(floatval(($unitPrice*70)/100),2);
                      $adminNetIncome = $adminIncome;
                      
                    ?>
                    <tr>
                        <td class="text-center"> <?php echo $key+1;?>  </td>

                        <td class="text-center"> <?= $value['username'] ?> </td> 

                        <td class="text-center">  <?= $value['item_name'] ?> </td>

                        <td class="text-center">  <?php echo $value['quantity'];?>  </td>

                        <td class="text-center">  <?php echo $unitPrice;?> </td>
                        
                        <td class="text-center"> <?php echo $tax;?> </td>

                        <!-- <td class="text-center">  <?php echo $paypalCharge;?> </td> -->

                        <td class="text-center"> <?php echo $price; ?>   </td>  

                        <td class="text-center"> <?php echo $netIncome; ?>  </td>

                        <td class="text-center"><?php echo $adminIncome; ?></td>

                        <td class="text-center"> <?php echo $cepIncome; ?>  </td>

                        <td class="text-center"> <?php echo $adminNetIncome; ?>  </td>

                        <td class="text-center"> <?php echo $course_owner; ?></td>
                        
                        <td> <?php echo $value['added_on']; ?> </td>

                        <td> <?php echo $value['countries_name']; ?></td>

                        <td><?php echo $channel; ?></td>
                        
                        <td><a href="javascript:void(0)" onclick="showBill('<?php echo $value['pid']?>','<?php echo 'Course'; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td>  
                          
                        
                    </tr>
                           
                    <?php 
                    $sum += $price;


                    $unitSum += $unitPrice; 
                    $taxSum += $tax; 
                    $paypalSum += $paypalCharge;  
                    $netIncomeSum += $netIncome; 
                    $adminIncomeSum += $adminIncome; 
                    $cepIncomeSum += $cepIncome; 
                    $adminnetIncomeSum += $adminNetIncome;


                    ?>

                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                        <!-- <td class="text-center"><strong>$<?php echo number_format(floatval($paypalSum),2); ?></strong></td> -->
                        <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($cepIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
        </table>
      </div>
				<?php }else{
					echo '<p>No purchase records found.</p>';
				} ?>
 


		</div>
	  
      <div class="tab-pane fade" id="tms" role="tabpanel" aria-labelledby="contact-tab">
		<h2>TMS</h2>
     <?php if(count($tmss) > 0){ ?>
      
  <div class="mob-tablescroll">
		<table class="table table-striped table-bordered" id="incomereport">
                <tr>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Tax</th>
                    <!-- <th>Paypal Charge</th> -->
                    <th>Amount</th>
                    <th>Net Income</th>
                   <!--  <th>Admin (30%)</th>
                    <th>CEP (70%)</th> -->
                    <th>Admin Net Income</th>
                    <th>Training Owner</th>
                    <th>Purchased Date </th>
                    <th>Country</th>
                    <th>Channel</th>
                    <th>Action</th>
                </tr>
    <?php 
    $sum = 0;
    $unitSum = 0; 
    $taxSum = 0; 
    $paypalSum = 0; 
   
    $netIncomeSum = 0; 
    $adminIncomeSum = 0; 
    $cepIncomeSum = 0; 
    $adminnetIncomeSum = 0; 
            foreach ($tmss as $key => $value) { 
      $txn = mb_substr($value['txn_id'], 0, 5);
      if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
			$training_name = $this->db->get_where('tbl_user',array('id'=>$value['owner_id']))->row_array()['name'];
      $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 


        $price = floatval($value['price']);

        $tax = floatval($value['tax']);
        
        $unitPrice = number_format($price - $tax,2);
          
        $netIncome = $unitPrice;
        
        $adminNetIncome = $netIncome;
      ?>
        
                    <tr>
                        <td class="text-center"> <?php echo $key+1;?>  </td>

                        <td class="text-center"> <?php echo $value['username'] ?> </td> 

                        <td class="text-center">  <?php echo $value['item_name'] ?> </td>

                        <td class="text-center">  1  </td>

                        <td class="text-center">  <?php echo $unitPrice;?> </td>
                        
                        <td class="text-center"> <?php echo $tax;?> </td>

                        <td class="text-center"> <?php echo $price; ?>   </td>  

                        <td class="text-center"> <?php echo $netIncome; ?>  </td>

                        <td class="text-center"> <?php echo $adminNetIncome; ?>  </td>

                        <td class="text-center"> <?php echo $training_name; ?> </td>
                        
                        <td> <?php echo $value['added_on']; ?> </td>

                        <td> <?php echo $value['countries_name']; ?></td>

                        <td><?php echo $channel; ?></td>
                        
                        <td> <a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']?>','<?php echo 'Training'; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td>  
                          
                        
                    </tr>
                           
                    <?php 
                    $sum += $price;


                    $unitSum += $unitPrice; 
                    $taxSum += $tax; 
                    $paypalSum += $paypalCharge;  
                    $netIncomeSum += $netIncome; 
                    $adminIncomeSum += $adminIncome; 
                    $cepIncomeSum += $cepIncome; 
                    $adminnetIncomeSum += $adminNetIncome;


                    ?>

                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
        </table>
      </div>
				<?php }else{
					echo '<p>No purchase records found.</p>';
				} ?>

 
	  </div>
      <div class="tab-pane fade" id="certificate" role="tabpanel" aria-labelledby="contact-tab">
	  <h2>Certificate</h2>
    <?php if(count($certificate) > 0){ ?>	
  <div class="mob-tablescroll">
	  <table class="table table-striped table-bordered" id="incomereport">
       <tr>
          <th>No.</th>
          <th>User Name</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Tax</th>
          <th>Amount</th>
          <th>Net Income</th>
          <!-- <th>Admin Net Income</th> -->
          <th>Purchased Date </th>
          <th>Country</th>
          <th>Channel</th>
          <th>Action</th>
      </tr>
      <?php 
      $sum = 0;
      $unitSum = 0; 
      $taxSum = 0; 
      $paypalSum = 0; 

      $netIncomeSum = 0; 
      $adminIncomeSum = 0; 
      $cepIncomeSum = 0; 
      $adminnetIncomeSum = 0; 


            foreach ($certificate as $key => $value) { 
      $txn = mb_substr($value['txn_id'], 0, 5);
      if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
			$course_name = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
      $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 
      
      
        $price = floatval($value['price']);

        $tax = floatval($value['tax']*$value['num_of_participants']);
        
        $unitPrice = number_format(($price - $tax),2);

        $netIncome = number_format($unitPrice,2);
        
        $adminNetIncome = number_format($netIncome,2);
        
      ?>
                    <tr>
                        <td class="text-center"> <?php echo $key+1;?>  </td>

                        <td class="text-center"> <?php echo $value['username'] ?> </td> 

                        <td class="text-center">  <?php echo $value['item_name'] ?> </td>

                        <td class="text-center">  1  </td>

                        <td class="text-center">  <?php echo $unitPrice;?> </td>
                        
                        <td class="text-center"> <?php echo $tax;?> </td>

                        <td class="text-center"> <?php echo $price; ?>   </td>  

                        <td class="text-center"> <?php echo $netIncome; ?>  </td>

                        <!-- <td class="text-center"> <?php echo $adminNetIncome; ?>  </td> -->
                        
                        <td> <?php echo $value['added_on']; ?> </td>

                        <td> <?php echo $value['countries_name']; ?></td>

                        <td><?php  echo $channel; ?></td>
                        
                        <td> <a href="javascript:void(0)" onclick="showBill('<?php echo $value['id']?>','<?php echo 'Digital Certificate Subscription'; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td>  
                          
                        
                    </tr>
                           
                    <?php 
                    $sum += $price;
                    $unitSum += $unitPrice; 
                    $taxSum += $tax;   
                    $netIncomeSum += $netIncome; 
                    $adminnetIncomeSum += $adminNetIncome;
                    ?>

                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
        </table>
      </div>
				<?php }else{
					echo '<p>No purchase records found.</p>';
				} ?>

	  </div>
      <div class="tab-pane fade" id="promotion" role="tabpanel" aria-labelledby="contact-tab">
	  <h2>Promotion</h2>
	  <?php $promotions = array();
     foreach($promotionscp as $value){
        $promotions[] = array(
            'id'          => $value['id'],
            'type'        => 'Course Promotion',
            'no_of_view'  => $value['no_of_view'],
            'added_on'    => $value['added_on'],
            'item_name'   => $value['item_name'],
            'amount'      => $value['amount'],
            'tax'         => $value['tax'],
            'txn_id'      => $value['txn_id'],
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => $value['course_owner'],
            'price'       => $value['price'] );

      }
      foreach($promotionstp as $value){
        $promotions[] = array(
            'id'          => $value['id'],
            'type'        => 'Training Promotion',
            'no_of_view'  => $value['no_of_view'],
            'added_on'    => $value['added_on'],
            'item_name'   => $value['item_name'],
            'amount'      => $value['amount'],
            'tax'         => $value['tax'],
            'txn_id'      => $value['txn_id'],
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => $value['course_owner'],
            'price'       => $value['price'] );

      }
       foreach($promotion as $value){
        $json = json_decode($value['transaction_details']);
        $promotions[] = array(
            'id'          => $value['id'],
            'type'        => 'Promotion',
            'no_of_view'  => $value['no_of_view'],
            'added_on'    => $value['added_on'],
            'item_name'   => $json->item_name,
            'amount'      => $value['amount'],
            'tax'         => $value['tax'],
            'txn_id'      => $json->txn_id,
            'role'        => $value['role'],
            'user_id'     => $value['user_id'],
            'username'    => $value['username'],
            'location'    => $value['location'],
            'countries_name' => $value['countries_name'],
            'course_title' => $value['course_title'],
            'course_owner' => $value['course_owner'],
            'price'       => $value['price'] );

      }
	  // $promotions = array_merge($promotionscp,$promotionstp);
    if(count($promotions) > 0){ ?>	
  <div class="mob-tablescroll">
	  <table class="table table-striped table-bordered" id="incomereport">
                 <tr>
          <th>No.</th>
          <th>User Name</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Tax</th>
          <!-- <th>Paypal Charge</th> -->
          <th>Amount</th>
          <th>Net Income</th>
         <!--  <th>Admin (30%)</th>
          <th>CEP (70%)</th> -->
          <th>Admin Net Income</th>
          <th>Course Owner</th>
          <th>Purchased Date </th>
          <th>Country</th>
          <th>Channel</th>
          <th>Action</th>
      </tr>
      <?php 
      $sum = 0;
      $unitSum = 0; 
      $taxSum = 0; 
      $paypalSum = 0; 

      $netIncomeSum = 0; 
      $adminIncomeSum = 0; 
      $cepIncomeSum = 0; 
      $adminnetIncomeSum = 0; 

            foreach ($promotions as $key => $value) { 
      $txn = mb_substr($value['txn_id'], 0, 5);
      if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
			$course_name = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
      $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 
            

        $price = floatval($value['price']);

        $tax = floatval($value['tax']);
        
        $unitPrice = number_format($price - $tax,2);

        $netIncome = $unitPrice;

        $adminNetIncome = $netIncome;
        
      ?>
                    <tr>
                        <td class="text-center"> <?php echo $key+1;?>  </td>

                        <td class="text-center"> <?php echo $value['username'] ?> </td> 

                        <td class="text-center">  <?php echo $value['item_name'] ?> </td>

                        <td class="text-center">  1 </td>

                        <td class="text-center">  <?php echo $unitPrice;?> </td>
                        
                        <td class="text-center"> <?php echo $tax;?> </td>

                        <!-- <td class="text-center">  <?php echo $paypalCharge;?> </td> -->

                        <td class="text-center"> <?php echo $price; ?>   </td>  

                        <td class="text-center"> <?php echo $netIncome; ?>  </td>

                      <!--   <td class="text-center"><?php echo $adminIncome; ?></td>

                        <td class="text-center"> <?php echo $cepIncome; ?>  </td> -->

                        <td class="text-center"> <?php echo $adminNetIncome; ?>  </td>

                        <td class="text-center"> <?php echo $value['username']; ?> </td>
                        
                        <td> <?php echo $value['added_on']; ?> </td>

                        <td> <?php echo $value['countries_name']; ?></td>

                        <td><?php echo $channel; ?></td>
                        
                        <td> <a href="javascript:void(0)" onclick="showBill('<?php echo $value['id'];?>','<?php echo $value['type']; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td>  
                          
                        
                    </tr>
                           
                    <?php 
                    $sum += $price;


                    $unitSum += $unitPrice; 
                    $taxSum += $tax; 
                    // $paypalSum += $paypalCharge;  
                    $netIncomeSum += $netIncome; 
                    $adminIncomeSum += $adminIncome; 
                    $cepIncomeSum += $cepIncome; 
                    $adminnetIncomeSum += $adminNetIncome;


                    ?>

                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                        <!-- <td class="text-center"><strong>$<?php echo number_format(floatval($paypalSum),2); ?></strong></td> -->
                        <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                      <!--   <td class="text-center"><strong>$<?php echo number_format(floatval($adminIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($cepIncomeSum),2); ?></strong></td> -->
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
        </table>
      </div>
				<?php }else{
					echo '<p>No purchase records found.</p>';
				} ?>

	  </div>
	   <div class="tab-pane fade" id="advertisement" role="tabpanel" aria-labelledby="contact-tab">
		<h2>Advertisement</h2>
    <?php if(count($advs) > 0){ ?>	
  <div class="mob-tablescroll">
		<table class="table table-striped table-bordered" id="incomereport">
                 <tr>
          <th>No.</th>
          <th>User Name</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Tax</th>
          <th>Amount</th>
          <th>Net Income</th>
          <th>Admin Net Income</th>
          <th>Purchased Date </th>
          <th>Country</th>
          <th>Channel</th>
          <th>Action</th>
      </tr>
      <?php 
      $count = 1;
      $sum = 0;
      $unitSum = 0; 
      $taxSum = 0; 
      $paypalSum = 0; 

      $netIncomeSum = 0; 
      $adminIncomeSum = 0; 
      $cepIncomeSum = 0; 
      $adminnetIncomeSum = 0; 

			// print_r($advs[0]);
          foreach ($advs as $key => $value) { 
             $txn = mb_substr($value['txn_id'], 0, 5);
      if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
			$course_name = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
      $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 


        $price = floatval($value['price']);

        $tax = floatval($value['tax']);       
        
        $unitPrice = number_format($price - $tax,2);

        $netIncome = $unitPrice;        
        $adminNetIncome = $netIncome;
        
      ?>
                    <tr>
                        <td class="text-center"> <?php echo $count;?>  </td>

                        <td class="text-center"> <?php echo $value['username'] ?> </td> 

                        <td class="text-center">  <?php echo $value['item_name'] ?> </td>

                        <td class="text-center">  1  </td>

                        <td class="text-center">  <?php echo $unitPrice;?> </td>
                        
                        <td class="text-center"> <?php echo $tax;?> </td>

                        <td class="text-center"> <?php echo $price; ?>   </td>  

                        <td class="text-center"> <?php echo $netIncome; ?>  </td>

                        <td class="text-center"> <?php echo $adminNetIncome; ?>  </td>
                        
                        <td> <?php echo date('Y-m-d',strtotime($value['added_on'])); ?> </td>

                        <td> <?php echo $value['countries_name']; ?></td>

                        <td> <?php echo $channel; ?></td>
                        
                        <td> <a href="javascript:void(0)" onclick="showBill('<?php echo $value['id'];?>','<?php echo 'Advertise'; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td> 
                          
                        
                    </tr>
                           
                    <?php 
                    $sum += $price;

                    $unitSum += $unitPrice; 
                    $taxSum += $tax;  
                    $netIncomeSum += $netIncome; 
                    $adminnetIncomeSum += $adminNetIncome;
                    ?>

                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
  </table>
</div>
			<?php }else{
				echo '<p>No purchase records found.</p>';
			} ?>
	  </div>
	  <div class="tab-pane fade" id="pcems" role="tabpanel" aria-labelledby="contact-tab">
		<h2>PCE-MS</h2>
    <?php if(count($pcems) > 0){ ?>	
  <div class="mob-tablescroll">
		<table class="table table-striped table-bordered" id="incomereport">
                 <tr>
          <th>No.</th>
          <th>User Name</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Tax</th>
          <th>Amount</th>
          <th>Net Income</th>
          <th>Admin Net Income</th>
          <!-- <th>Course Owner</th> -->
          <th>Purchased Date </th>
          <th>Country</th>
          <th>Channel</th>
          <th>Action</th>
      </tr>
      <?php 
      $sum = 0;
      $unitSum = 0; 
      $taxSum = 0; 
      $paypalSum = 0; 

      $netIncomeSum = 0; 
      $adminIncomeSum = 0; 
      $cepIncomeSum = 0; 
      $adminnetIncomeSum = 0; 

			// print_r($pcems[1]);
            foreach ($pcems as $key => $value) { 
            $txn = mb_substr($value['txn_id'], 0, 5);
      if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
			$course_name = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
      $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 
   
        $price = $value['price'];
        $tax = $value['tax'];

        
        $unitPrice = number_format(floatval($price - $tax),2);

        $netIncome = $unitPrice;

        $adminNetIncome = $netIncome;
      ?>
                    <tr>
                        <td class="text-center"> <?php echo $key+1;?>  </td>

                        <td class="text-center"> <?php echo $value['username'] ?> </td> 

                        <td class="text-center">  <?php echo $value['item_name'] ?> </td>

                        <td class="text-center">  1  </td>

                        <td class="text-center">  <?php echo $unitPrice;?> </td>
                        
                        <td class="text-center"> <?php echo $tax;?> </td>

                        <td class="text-center"> <?php echo $price; ?>   </td>  

                        <td class="text-center"> <?php echo $netIncome; ?>  </td>

                        <td class="text-center"> <?php echo $adminNetIncome; ?>  </td>

                        <!-- <td class="text-center"> <?php echo $value['username'] ?> </td> -->
                        
                        <td> <?php echo date('Y-m-d',strtotime($value['added_on'])); ?> </td>

                        <td> <?php echo $value['countries_name']; ?></td>

                        <td> <?php echo $channel; ?> </td>
                        
                        <td> <a href="javascript:void(0)" onclick="showBill('<?php echo $value['iid'];?>','<?php echo 'Pcems'; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td>  
                          
                        
                    </tr>
                           
                    <?php 
                    $sum += $price;


                    $unitSum += $unitPrice; 
                    $taxSum += $tax; 
                    $paypalSum += $paypalCharge;  
                    $netIncomeSum += $netIncome; 
                    $adminIncomeSum += is_numeric($adminIncome) ? $adminIncome : 0; 
                    $cepIncomeSum += is_numeric($cepIncome) ? $cepIncome : 0;
                    $adminnetIncomeSum += $adminNetIncome;


                    ?>

                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
  </table>
</div>
			<?php }else{
				echo '<p>No purchase records found.</p>';
			} ?>
	  </div>
    <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="contact-tab">
    <h2>STAFF</h2>
    <?php if(count($staff) > 0){ ?> 
  <div class="mob-tablescroll">
    <table class="table table-striped table-bordered" id="incomereport">
        <tr>
          <th>No.</th>
          <th>User Name</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Tax</th>
          <th>Amount</th>
          <th>Net Income</th>
          <th>Admin Net Income</th>
          <!-- <th>Course Owner</th> -->
          <th>Purchased Date </th>
          <th>Country</th>
          <th>Channel</th>
          <th>Action</th>
      </tr>
      <?php 
      $sum = 0;
      $unitSum = 0; 
      $taxSum = 0; 
      $paypalSum = 0; 

      $netIncomeSum = 0; 
      $adminIncomeSum = 0; 
      $cepIncomeSum = 0; 
      $adminnetIncomeSum = 0; 

      
    foreach ($staff as $key => $value) { 
      $txn = mb_substr($value['txn_id'], 0, 5);
      $json = json_decode($value['transaction_details']);
      if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
      $prof_name = $this->db->get_where('tbl_user',array('id'=>$json->item_number))->row()->name;
      // echo $this->db->last_query();die;
      $course_name = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
      $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 
      

        $price = floatval($value['price']);
        
        $tax = floatval($value['tax'] * $value['num_of_prof']);
        
        $unitPrice = number_format($price - $tax,2);
         
        $netIncome = $unitPrice;

        $adminNetIncome = $netIncome;
        
      ?>
                    <tr>
                        <td class="text-center"> <?php echo $key+1;?>  </td>

                        <!-- <td class="text-center"> <?php echo $value['username'] ?> </td>  -->
                        <td class="text-center"> <?php echo isset($prof_name)?$prof_name:$value['username']; ?> </td> 

                        <td class="text-center">  <?php echo $json->item_name; ?> </td>

                        <td class="text-center">  1  </td>

                        <td class="text-center">  <?php echo $unitPrice;?> </td>
                        
                        <td class="text-center"> <?php echo $tax;?> </td>

                        <td class="text-center"> <?php echo $price; ?>   </td>  

                        <td class="text-center"> <?php echo $netIncome; ?>  </td>

                        <td class="text-center"> <?php echo $adminNetIncome; ?>  </td>

                        <!-- <td class="text-center"> <?php echo $value['course_owner']; ?></td> -->
                        
                        <td> <?php echo $value['added_on']; ?> </td>

                        <td> <?php echo $value['countries_name']; ?></td>

                        <td> <?php echo $channel; ?> </td>
                        
                        <td> <a href="javascript:void(0)" onclick="showBill('<?php echo $value['iid'];?>','<?php echo 'Staff Payment'; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td>  
                          
                        
                    </tr>
                           
                    <?php 
                    $sum += $price;
                    $unitSum += $unitPrice; 
                    $taxSum += $tax; 
                    $paypalSum += $paypalCharge;  
                    $netIncomeSum += $netIncome; 
                    $adminIncomeSum += is_numeric($adminIncome) ? $adminIncome : 0; 
                    $cepIncomeSum += is_numeric($cepIncome) ? $cepIncome : 0; 
                    $adminnetIncomeSum += $adminNetIncome;


                    ?>

                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
  </table>
</div>
      <?php }else{ echo '<p>No purchase records found.</p>'; } ?>
    </div>

    <div class="tab-pane fade" id="rboard" role="tabpanel" aria-labelledby="contact-tab">
    <h2>RBoard</h2>
    <?php if(count($rboard) > 0){ ?> 
  <div class="mob-tablescroll">
    <table class="table table-striped table-bordered" id="incomereport">
        <tr>
          <th>No.</th>
          <th>User Name</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Tax</th>
          <th>Amount</th>
          <th>Net Income</th>
          <th>Admin Net Income</th>
          <!-- <th>Course Owner</th> -->
          <th>Purchased Date </th>
          <th>Country</th>
          <th>Channel</th>
          <th>Action</th>
      </tr>
      <?php 
      $sum = 0;
      $unitSum = 0; 
      $taxSum = 0; 
      $paypalSum = 0; 

      $netIncomeSum = 0; 
      $adminIncomeSum = 0; 
      $cepIncomeSum = 0; 
      $adminnetIncomeSum = 0; 

      
    foreach ($rboard as $key => $value) { 
      $txn = mb_substr($value['txn_id'], 0, 5);
      // $json = json_decode($value['transaction_details']);
      if($txn == 'PAYID'){ $channel = 'Mobile App'; }else{ $channel = 'Website';}
      $prof_name = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row()->name;
      // echo $this->db->last_query();die;
      $course_name = $value['course_title'];
      $user_details = $this->user->get_record_by_field_name_all_record('tbl_user','id',$value['user_id']); 
      

        $price = floatval($value['price']);
        
        // $tax = floatval($value['tax'] * $value['num_of_prof']);
        $tax = 0;
        
        $unitPrice = number_format($price - $tax,2);
         
        $netIncome = $unitPrice;

        $adminNetIncome = $netIncome;
        
      ?>
                    <tr>
                        <td class="text-center"> <?php echo $key+1;?>  </td>

                        <!-- <td class="text-center"> <?php echo $value['username'] ?> </td>  -->
                        <td class="text-center"> <?php echo isset($prof_name)?$prof_name:$value['username']; ?> </td> 

                        <td class="text-center">  <?php echo $value['item_name']; ?> </td>

                        <td class="text-center">  1  </td>

                        <td class="text-center">  <?php echo $unitPrice;?> </td>
                        
                        <td class="text-center"> <?php echo $tax;?> </td>

                        <td class="text-center"> <?php echo $price; ?>   </td>  

                        <td class="text-center"> <?php echo $netIncome; ?>  </td>

                        <td class="text-center"> <?php echo $adminNetIncome; ?>  </td>

                        <!-- <td class="text-center"> <?php echo $value['course_owner']; ?></td> -->
                        
                        <td> <?php echo $value['added_on']; ?> </td>

                        <td> <?php echo $value['countries_name']; ?></td>

                        <td> <?php echo $channel; ?> </td>
                        
                        <td> <a href="javascript:void(0)" onclick="showBill('<?php echo $value['iid'];?>','<?php echo 'RBoard'; ?>')" class="btn btn-primary"><i title="View Receipt" class="fa fa-file-text-o" style="color: #ffff;"></i></a></td>  
                          
                        
                    </tr>
                           
                    <?php 
                    $sum += $price;
                    $unitSum += $price; 
                    $taxSum += $tax; 
                    $paypalSum += $paypalCharge;  
                    $netIncomeSum += $price; 
                    $adminnetIncomeSum += $price;


                    ?>

                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($unitSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($taxSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($sum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($netIncomeSum),2); ?></strong></td>
                        <td class="text-center"><strong>$<?php echo number_format(floatval($adminnetIncomeSum),2); ?></strong></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
  </table>
</div>
      <?php }else{
        echo '<p>No purchase records found.</p>';
      } ?>
    </div>
    </div>
  </div>
</div> 


<?php 
  if(!empty($_REQUEST['year'])){
    $month1    =  $_REQUEST['month'];
    $year1     =  $_REQUEST['year'];
    if($month1==""){ $month1 = date('m'); } 
    
    $totalData =  $this->user->getpayadmin($month1,$year1,$uid); 
  }

  $month1 = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

  $month = $_REQUEST['month'];
  $years = $_REQUEST['year'];

  $totalAmount=0;
  /* foreach ($month1 as $key => $value) {
  $start_date = $years."-".$key."-01";
  $end_date   = $years."-".$key."-31";
  $sumdata = $this->user->getSumBetweenAdmin($start_date,$end_date,$uid);
  $totalAmount = $totalAmount+$sumdata[0]['amount'];
  if($sumdata[0]['amount']!=""){
  $tot = $sumdata[0]['amount'];
  } else {
  $tot = 0;
  }
  $array[] =  array("label"=> $value, "y"=> $tot);    
  }
  $dataPoints1 = $array; */


  $ss = 0;
  if($_REQUEST['month'] == "") { 
    foreach ($month1 as $key => $value) {
      $start_date = $years."-".$key."-01";
      $end_date   = $years."-".$key."-31";
      $sumdata = $this->user->getSumBetweenAdmin('',$key,$years);
      $totalAmount = $totalAmount+ $sumdata['amount']  + ($sumdata['amount']*5)/100;
      if($sumdata['amount']!=""){
      $tot = $sumdata['amount']  + ($sumdata['amount']*5)/100;
      } else {
      $tot = 0;
      }
      $array[] =  array("label"=> $value, "y"=> $tot);    
    }
      $dataPoints1 = $array; 

  }else{
    
    for ($i=1; $i <= 31; $i++) {
      //$date = $years."-".date('m')."-".$i;
      $month = ($_REQUEST['month'] !="")?$_REQUEST['month']:date('m');
      $date = $years."-".$month."-".$i;
      $sumdata = $this->user->getSumBetweenAdmin($date,'','');
      $ss = $ss + $sumdata['amount']  + ($sumdata['amount']*5)/100;
      if($sumdata['amount']!=""){
        $tot = $sumdata['amount']  + ($sumdata['amount']*5)/100;
      } else {
        $tot = 0;
      }
      $array[] =  array("label"=> $i, "y"=> $tot);
    }
  $dataPoints1 = $array;
  } ?>


<!-- <div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-body">

<?php 
$sum2 =0;
foreach ($totalData as $key => $value) {
  $sum2 = $sum2+$value['amount'] * $value['quantity'];
}

	 if($uid !=""){ 

	 foreach ($users as $key => $value) { 

		if($value['id']==$uid){
		?>
		<center>
		<h2 class="text-uppercase" style="font-weight: bold;"><?php echo $value['name'];?></h2>
		</center>
		<?php    
		}
	 }
	 ?>
	 <?php 
	  }
	 ?>
          

            <center>
                <h2 class="text-uppercase" style="font-weight: bold;">MONTHLY INCOME REPORT</h2>
              <p><?php echo $month1[$mm];?> <?php echo $yy;?></p>
              <p>Total Income <?php echo $ss;?></p>
            </center>

                <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
            </div>


        <div class="table-responsive">

            <div class="panel-body detail-income-report">
            <h2 class="text-uppercase">Details Income Report</h2>
             <p class="text-center">

                                <a class="btn btn-primary" href="<?php echo site_url('admin/dashboard/?month=&year='.date('Y-m-d'));?>">Course Sale Income</a>                                <a class="btn btn-default" href="<?php echo site_url('admin/ads_income_report/?month=&year='.date('Y-m-d'));?>">Ads Income</a>
                                <a class="btn btn-default" href="#">Training Registraion Income</a>
                                <?php 
                                if($uid ==""){
                                ?>
                                <a class="btn btn-default" href="#">Promotion Income</a>
                                <a class="btn btn-default" href="#">Subscription Income</a>
                                <a class="btn btn-default" href="#">Advertisement Income</a>
                                <?php } ?>
                            </p>

 
        </div>


            <table class="table table-striped table-bordered">
                <tr>
                    <th>S.No</th>
                    <th>Course Title</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Purchase Date</th>
                    <th>Action</th>
                </tr>
                <?php 
                $sum = 0;
                foreach ($totalData as $key => $value) {
                  //  echo '<pre>';
                   // print_r($value);
                    $sum = $sum+$value['amount'] * $value['quantity'];
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $key+1;?>
                        </td>
                        <td>
                            <?php 
                            $datacourse = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
                            $puchselist = $this->user->get_record_by_field_name_all_record('tbl_purchase_llis','added_on',$value['added']);
                            
                            //echo '<pre>'; print_r($puchselist); die;
                            echo $datacourse[0]['course_title'];?>
                        </td>
                        <td class="text-center">
                            <?php echo $value['amount'];?>
                        </td>
                        <td class="text-center">
                            <?php echo count($puchselist);?>
                        </td>
                        <td class="text-center">
                            <?php echo $value['amount'] * $value['quantity'];?>
                        </td>
                        <td>
                            
                            <?php echo date("jS F, Y", strtotime($value['added'])); ?>
                           
                        </td>
                        
                        <td class="text-center">
                        <a style="color: blue;" href="javascript:void(0);" onclick="purchasedetails('<?php echo $value['added'];?>');">View Details</a>
                        </td>

                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo $ss;?></strong></td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

<?php // } ?> -->


        <div class="col-sm-12 mt-3">
          <div class="panel panel-default">
            <div class="panel-body detail-income-report">
              <h2 class="text-uppercase"><?php echo date('Y');?></h2>
              <h2 class="text-uppercase">MONTHLY INCOME REPORT</h2>
              <div class="panel-body">
                <div id="chartContainer" style="height: 370px; width: 100%;">
                </div>
              </div>
            </div>
          </div>
        </div> 
</div>
</div>
</div>
</div>


<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.jqueryui.min.js"></script> -->

<!-- <script type="text/javascript">
  function purchasedetails(datedata)
  {
    $("#myModalDetails").modal('show');
        $.ajax({
          type: "POST",
          url: '<?php echo base_url()."admin/purchasedetailsAdmin";?>',
          data: {datedata:datedata}
        }).done(function( result ){
            $("#responsecontent").html(result);
          });              
          return false;   
  }
</script> -->
  
  <!-- Receipt No Modal -->
  <div class="modal fade" id="myModal11" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><div class="site-logo__link" style="max-width: 34%;">
              <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
          </div></center>
          <h4 class="modal-title">Receipt No. <span id="rid"></span></h4>
        </div>
          <p style="color: red; text-align: center; display: none;" id="waitmessage">Please wait.... </p>
          
        <div class="modal-body">
            <span id="responseData"></span>
        </div>            
      </div>
    </div>
  </div>

<!-- Purchase Details Modal -->
  <div class="modal fade" id="myModalDetails" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Purchase Details</h4>
        </div>
        <div class="modal-body">
          <div id="responsecontent">  
          <p style="color: red;">Please wait...</p>
         </div>
        </div>   
      </div>      
    </div>
  </div>

<style type="text/css">
.button{backgfloatval-color:#4caf50;border:none;color:#fff;padding:20px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;margin:4px 2px}.button1{border-radius:2px}.button2{border-radius:4px}.button3{border-radius:8px}.button4{border-radius:12px}.button5{border-radius:50%}
</style>

<script type="text/javascript">
  $(document).ready(function(){
      // $('#incomereport,#exmple').DataTable();
      $(".nktable").DataTable();
  });

  function showBill(idd,type)
  {
    var receipt_type = type.substring(0, 3).toUpperCase();
    $('#rid').html(receipt_type +' '+ idd);
    $('#waitmessage').show();
    $("#myModal11").modal('show');

    $.ajax({
      type: "POST",
      url: '<?php echo base_url("share/showBill");?>',
      data: {idd:idd,type:type}
    }).done(function( result ) {
        $('#waitmessage').hide();
        $("#responseData").html(result);
      });              
    return false;   
  }

	getrolesdata();
	function getrolesdata()
  {
		var users = "<?php echo $parameter['users'];?>";
		var id = $('#roleselect').val();
		if(id != "")
    {			
      $.ajax({
      type: 'POST',
      url: "<?php echo base_url('admin/filteruser/'); ?>"+id,
      data: { 'id' : id },
        success:function(result)
        {				  
          $("#userselectsss").html(result);
            if(users !='')
            {
              $("#userselectsss").val(users);
            }
        }
      });
		}
	}
	
  $('#roleselect').change(function(){ 
    var id = $(this).val();
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url('admin/filteruser/'); ?>"+id,
      data: { 'id' : id },
        success:function(result)
        {
          $("#userselectsss").html(result);
        }
    });
  });

  /* function searchdata() {
    var month = $('#month').val();
    var year = $('#year').val();
    var users = $('#users').val();
    var constval = "month=" + month + "&year=" + year + "&users="+users;
    var base_url = "<?php echo base_url()."admin/dashboard?";?>";
    var fullurl = base_url + constval;
    window.location = fullurl; 
  } */

  window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: ""
        },
        legend: {
            cursor: "pointer",
            verticalAlign: "center",
            horizontalAlign: "right",
            itemclick: toggleDataSeries
        },
        data: [{
            type: "column",
            name: "Real Trees",
            indexLabel: "{y}",
            yValueFormatString: "$#0.##",
            showInLegend: true,
            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

      /* var chart1 = new CanvasJS.Chart("chartContainer1", {
          animationEnabled: true,
          theme: "light2",
          title: {
              text: ""
          },
          legend: {
              cursor: "pointer",
              verticalAlign: "center",
              horizontalAlign: "right",
              itemclick: toggleDataSeries
          },
          data: [{
              type: "column",
              name: "Real Trees",
              indexLabel: "{y}",
              yValueFormatString: "$#0.##",
              showInLegend: true,
              dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
          }]
      });
      chart1.render(); */

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
               e.dataSeries.visible = true;
           }
           chart.render();
           chart1.render();
       }
    }
</script>