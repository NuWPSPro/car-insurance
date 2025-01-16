
<?php 
    $filterdata['role']=1;
	if($_POST['country']!='')
				{
					$filterdata['country']=$_POST['country'];
				
				}
    $professiona  = $this->user->get_record_by_multi_field_name('tbl_user',$filterdata);
    $alluser  = $this->user->get_users();
	$filterdata['role']=2;
    $provider     = $this->user->get_record_by_multi_field_name('tbl_user',$filterdata);
	$filterdata['role']=4;
    $advertiser   = $this->user->get_record_by_multi_field_name('tbl_user',$filterdata);
	$filterdata['role']=5;
    $insititution = $this->user->get_record_by_multi_field_name('tbl_user',$filterdata);

    $filterAuthordata['role']=6;
    $authors = $this->user->get_record_by_multi_field_name('tbl_user',$filterAuthordata);

    $rboard = $this->user->get_record_by_multi_field_name('tbl_user',array('role'=>7));


    

    $num1 = count($professiona);
    $num2 = count($provider);
    $num3 = count($alluser); // came from users_model/get_user function 
    $num4 = count($insititution);
	$num5 = count($advertiser);
    $num6 = count($authors);
    $num7 = count($rboard);
?>
<div class="col-sm-9">
<div class="users-workpanel">
<div class="row d-flex">
    <div class="col-md-2 col-sm-4 col-xs-6 form-group">
        <a href="javascript:void(0)<?php //echo site_url('admin/users');?>" onClick="setRole('')">
            <div class="circle-income text-center">
                <span><?php echo sprintf("%02d", $num1+$num2+$num4+$num5+$num6+$num7);?></span>
                <strong>TOTAL USERS</strong>
            </div>
        </a>
    </div>

    <div class="col-md-2 col-sm-4 col-xs-6 form-group">
        <a href="javascript:void(0)<?php //echo site_url('admin/professional');?>" onClick="setRole('1')">
            <div class="circle-income text-center">
                <span><?php echo sprintf("%02d", $num1);?></span>
                <strong>PROFESSIONAL</strong>
            </div>
        </a>
    </div>

    <div class="col-md-2 col-sm-4 col-xs-6 form-group">
        <a href="javascript:void(0)<?php //echo site_url('admin/provider_isting');?>" onClick="setRole('2')">
            <div class="circle-income text-center">
                <span><?php echo sprintf("%02d", $num2);?></span>
                <strong>PROVIDER</strong>
            </div>
        </a>
    </div>


    <div class="col-md-2 col-sm-4 col-xs-6 form-group">
    <!-- <a href="javascript:void(0);"> -->
        <a href="javascript:void(0)<?php //echo site_url('admin/insititution');?>" onClick="setRole('5')">
            <div class="circle-income text-center">
                <span><?php echo sprintf("%02d", $num4);?></span>
                <strong>INSTITUTION</strong>
            </div>
        </a>
    </div>

    <div class="col-md-2 col-sm-4 col-xs-6 form-group">
        <a href="javascript:void(0)<?php //echo site_url('admin/advertisers');?>" onClick="setRole('4')">
            <div class="circle-income text-center">
                <span><?php echo sprintf("%02d", count($advertiser));?></span>
                <strong>ADVERTISER</strong>
            </div>
        </a>
    </div>


    <div class="col-md-2 col-sm-4 col-xs-6 form-group">
        <a href="javascript:void(0)<?php //echo site_url('admin/advertisers');?>" onClick="setRole('6')">
            <div class="circle-income text-center">
                <span><?php echo sprintf("%02d", count($authors));?></span>
                <strong>AUTHORS</strong>
            </div>
        </a>
    </div>

    <div class="col-md-2 col-sm-4 col-xs-6 form-group">
        <a href="javascript:void(0)<?php //echo site_url('admin/advertisers');?>" onClick="setRole('7')">
            <div class="circle-income text-center">
                <span><?php echo sprintf("%02d", count($rboard));?></span>
                <strong>RBoard</strong>
            </div>
        </a>
    </div>

 </div>

</div>


    <div class="row">
    <form method="GET" action="<?php echo BASE_URL('admin/users');?>" >
        <div class="form-group col-md-5">
            <select name="country" class="form-control">
                <option value="" >Country</option>
                <?php foreach($country as $count){?>
                    <option value="<?php echo $count['countries_id']; ?>" <?php if($_POST['country']==$count['countries_id']){echo'selected';} ?> >
                    <?php echo $count['countries_name']; ?>
                    </option>
				<?php } ?>
            </select>
        </div>

        <div class="form-group col-md-5">
            <input type="date" name="date" class="form-control" value="<?php echo set_value('date')?>">
        </div>
        <div class="form-group col-md-2">
            <!-- <input type="hidden" name="professiona" value="<?php echo $this->uri->segment(2); ?>"> -->
            <input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
        </div>
		<input type="hidden" name="role" id="user_role" value="">
    </form>
    </div>

    <div class="row">
        <div class="form-group col-md-5">
            <?php 
            // print_r($this->uri->segment(2));
            $total = $num1+$num2+$num4+$num5+$num6+$num7;
            if($this->uri->segment(2)=='professional')
                {
                  echo '<h4 class="text-left"> Professional ( '.count($professiona).' Users)</h4>'; 
                }
            else if($this->uri->segment(2)=='provider_isting')
                {
                  echo '<h4 class="text-left"> CPD Provider Listing ( '.count($provider).' Users)</h4>'; 
                }
            else if($this->uri->segment(2)=='insititution')
                {
                  echo '<h4 class="text-left"> Institution Listing ( '.count($insititution).' Users)</h4>'; 
                }
            else if($this->uri->segment(2)=='advertisers')
                {
                  echo '<h4 class="text-left"> Advertisers Listing ( '.count($advertiser).' Users)</h4>'; 
                }
            else if($this->uri->segment(2)=='authors')
                {
                  echo '<h4 class="text-left"> Author Listing ( '.count($authors).' Users)</h4>'; 
                }
            else if($this->uri->segment(2)=='rboard')
                {
                  echo '<h4 class="text-left"> RBoard Listing ( '.count($rboard).' Users)</h4>'; 
                }
            else
                {
                  echo '<h4 class="text-left"> International ( '.$total.' Users)</h4>'; 
                } 
          ?>
            <!-- <h4 class="text-left"> International ( <?php echo $total;?> Users) </h4>  -->
        </div>
    </div>

<script>

$(document).ready(function() {
    var date_input = $('input[class="date"]'); //our date input has the name "date"
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
   
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    });

   
});

function setRole(role)
{
	jQuery('#user_role').val(role);
	jQuery('#sbbtn').click();
	
}
</script>
