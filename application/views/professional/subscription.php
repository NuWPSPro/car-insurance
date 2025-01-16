<?php $this->load->view('template/picture'); ?>


 <div class="innerContent">
	<div class="container">
		  
        <div class="row">
        	<div class="col-sm-12">
        		<h3 class="border-title text-left">Dashboard</h3>
        	</div>
       <?php  $this->load->view('professional/sidebar');  ?>  
       

        <div class="col-sm-8">
            
            <h3 class="border-title text-left">Subscription </h3>
			<?php
				if($this->session->flashdata('subscriptionmsg') != ''){
					echo $this->session->flashdata('subscriptionmsg');	
				}
			?>
            <table class="plantable" id="packageTable">
			<tbody>
				<th>Packages</th>
				<th>No. photo</th>
				<th>No. video</th>
				<th>Price</th>
				<th>Action</th>
				<th></th>
			<?php
				//echo '<pre>';
				//print_r($advertisepackages);
				$count = 1;
				$photocount = 1;
				//exit;
				foreach($advertisepackages as $advpck){
					echo '<tr><td>'.$advpck['subscription_name'].'</td>
					<td>'.$advpck['subs_no_photo'].'</td>
					<td>'.$advpck['subs_no_video'].'</td>
					<td>$ '.$advpck['subs_charge'].'</td>
					<td>
					<form action="'.PAYAPAL_URL.'" method="post" name="frmPayPal1" id="frmPayPal1">
    <input type="hidden" name="business" value="'.PAYAPAL_ID.'">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="'.$advpck['subscription_name'].'">
    <input type="hidden" name="item_number" value="'.$advpck['subs_id'].'">
    <input type="hidden" name="credits" value="'.$advpck['subs_charge'].'">
    <input type="hidden" name="userid" value="'.$this->session->userdata('logged_in')['id'].'">
    <input type="hidden" name="amount" value="'.$advpck['subs_charge'].'">
    <!--     <input type="hidden" name="cpp_header_image" value="https://www.phpgang.com/wp-content/uploads/gang.jpg"> -->
    <input type="hidden" name="rm" value="2">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="'.site_url().'/professional/subscriptionpayment">
    <input type="hidden" name="return" value="'.site_url().'/professional/subscriptionpayment">
    <input type="submit" class="btn" value="Buy Now">
</form>
					
					
					</td></tr>';
				}	
			?>
    </tbody></table>
            
        </div>


    </div>
	</div>
	</div>
</div>