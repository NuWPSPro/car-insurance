<?php $this->load->view('template/picture_author'); ?>
<div class="innerContent author-course-listing">
    <div class="container">
        <div class="row">
          <!--   <div class="col-sm-12">
                <h3 class="border-title text-left">Dashboard</h3>
            </div> -->
            <?php 
		$this->load->view('author/sidebar');
		 $dailyprices = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
		?>
            <div class="col-sm-9">
                <h3 class="border-title text-left">Course Listing (<?php echo count($course); ?>)</h3>
				<a href="<?php echo site_url('author/course_listing/a'); ?>"><h3 style="margin: 0;" class="btn <?php if($filter == 'a' || $filter == ''){ echo "btn-primary";} else {echo "btn-default";}?>">All</h3></a>
                <a href="<?php echo site_url('author/course_listing/1'); ?>"><h3 style="margin: 0;" class="btn <?php if($filter == 1){ echo "btn-primary";} else {echo "btn-default";}?>">PUBLISHED</h3></a>
                <!--<a href="<?php echo site_url('author/course_listing'); ?>/2"><h3 class="btn btn-primary <?php if($filter==2){ echo "active";}?>">PENDING FOR ACCREDITATION</h3></a>-->
                <a href="<?php echo site_url('author/course_listing/2'); ?>"><h3 style="margin: 0;" class="btn <?php if($filter == 2){ echo "btn-primary";} else {echo "btn-default";}?>">Submitted to CEP</h3></a>
                <a href="<?php echo site_url('author/course_listing/3'); ?>"><h3 style="margin: 0;" class="btn <?php if($filter == 3){ echo "btn-primary";} else {echo "btn-default";}?>">Save Only</h3></a>
                <div class="step-wise-query">
                    <?php echo $this->session->flashdata('response');?>
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <!-- <th>User</th> -->
                                <th>Course Title</th>
                                <th>Units</th>
                                <th>Date Published</th>
                                <th>Validity Date</th>
                                <th>Promotion Status</th>
                                <th>Validity Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
				foreach ($course as $key => $value) {
				?>
                            <tr>
                                <td>
                                    <?php echo $key+1; ?>.</td>
                                <!-- <td><?php echo $value['name']; ?></td>  -->
                                <td>
	                            <a style="color: blue;" href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['course_title']; ?></a>
                                </td>
                                <td><?php echo $value['units']; ?></td>
                                <td><?php echo $value['added_on']; ?></td>
                                <td><?php if($value['course_validity'] != '0000-00-00' && $value['course_validity'] != ''){ echo $value['course_validity']; }else{ echo '--';} ?></td>
                                <td><?php if($value['paid_status']==2) { echo '<sapn class="btn btn-success">Featured</span>'; }else{ echo '<sapn class="btn btn-info">Free</span>'; }?></td> 
                                <td><?php 
                                $before1month=date("Y-m-d", strtotime($value['course_validity']."-1 months"));
                                //echo  $before1month.'/'.$value['expiry_date'];
                                if($value['status']==1)
                                {
                                    if(date("Y-m-d")<=$before1month )
                                    {
                                        echo "<strong class='text-success'>Active</strong>";
                                    }
                                    elseif(date("Y-m-d")>=$before1month && date("Y-m-d")<=$value['course_validity'])
                                    {
                                        echo "<strong class='text-warning blink'>Expiring</strong>";
                                    }
                                    else
                                    {
                                        echo "<strong  class='text-danger'>Expired</strong>";
                                    }
                                }elseif($value['status']==3 || $value['status']==0){
                                    echo"--";
                                }else{
                                    echo "<strong class='text-danger'>Expired</strong>";
                                } ?></td>
                                <?php 
					if($value['status']==1){
						$stts = "Published";
						$col  = "green";
					}
					else if($value['status']==3){
						$stts = "Save only";
						$col  = "orange";
					} else {
						$stts = "Submitted CEP";
						//$stts = "Save Only";
						$col  = "red";
					}
					?>
                                <!--<td><a onclick="return confirm('Are you sure, you want to change status?')" href="<?php echo site_url('author/course_status/'.$value['id'].'/'.$value['status'].'');?>" style="color: <?php echo $col;?>"><?php echo $stts; ?></a></td>-->
                                <td style="color: <?php echo $col;?>"><?php echo $stts; ?></td>
                                <td width="200">
                                    <a class="btn btn-default" title="View" href="<?php echo site_url('author/course_view/'.$value['id'].'');?>"><i class="fa fa-eye"></i></a>
                                  
								   <a class="btn btn-default" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('author/course_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a>
                                     <?php //if($stts != "Published"){ ?>
									<a class="btn btn-default" title="Edit" href="<?php echo site_url('author/course_edit/'.$value['id'].'');?>"><i class="fa fa-pencil"></i></a>
                                   <?php //} ?>
                                   <?php if($value['status']==1){ 
                                        if($value['paid_status'] != 2){ ?>
								   <a class="btn btn-default" title="Promote" onclick="openpopup('<?php echo $value['id'];?>')" class="btn" href="javascript:void(0)"><i class="fa fa-bullhorn"></i></a>
                                   <?php } ?>

                                     <a class="btn btn-default" title="Coupan" onclick="opencoupan('<?php echo $value['id'];?>')" class="btn" href="javascript:void(0)"><i class="fa fa-tag"></i></a>
                                   <?php } ?>

                                </td>
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
</div>


 <input type="hidden" name="item_coupan" id="item_coupan">

 <a href="#" id="scroll" style="display: block;"><span></span></a>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
});
</script>

<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name">
    <input type="hidden" name="item_number" id="item_number">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" id="amount">
    <!--     <input type="hidden" name="cpp_header_image" value="https://www.phpgang.com/wp-content/uploads/gang.jpg"> -->
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url()?>/author/course_listing">
    <input type="hidden" name="return" value="<?php echo site_url()?>/author/course_promote_success?id=1">
</form>
<?php /* 
<div class="modal fade" id="courseLisingPromote" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Promote Now</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 form-group">
                    <label>Promote <sup>*</sup></label>
                    <select class="form-control" name="promote" id="promote" onchange="showbutton()">
                        <option value="" selected>Please Select</option>
                        <!-- <option value="0_1">Free</option> -->
                        <option value="10_2">Featured Courses</option>
                        <option value="20_3">Top List Courses</option>
                        <option value="30_4">Premium List Courses</option>
                    </select>
                    <input type="hidden" name="cid" id="cid">
                </div>
                <div class="col-sm-2 form-group" id="paynow">
                    <input type="button" class="btn btn-primary btn-lg" value="PAY NOW" onclick="paynow()">
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
*/ ?>

<div id="courseLisingPromote" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Promote Your Online Course</h4>
                </div>
                <?php 
                        $uid = $this->session->userdata('logged_in')['id'];
                         $user = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid); ?>
                <div class="modal-body promatecompany">
                    <div class="author-thumb">
                        <img src="http://ceonpoint.com/assets/images/uploads/<?php echo $user[0]['image']?>" alt="">
                    </div>
                     <form class="payform" id="course_payformdaily" action="#" method="post" enctype="multipart/form-data" >
					<?php	
                    				
					$dailprice=$dailyprices[0]['courses_daily_price'];	
					
					?>
					 <input type="hidden" id="course_dailyprice" name="course_dailyprice" value="<?php echo $dailprice; ?>"> 
					<input type="hidden" id="course_id" name="course_id" value=""> 
					
                        <div class="form-control"><a href="#">$<?php echo $dailprice; ?>/day</a></div>
                        <select class="form-control" id="course_day" name="course_day" onchange="course_setprice(this.value)">
                          <?php for($i=1; $i<=31;$i++){ ?>
							
                            <option value="<?php echo $i; ?>"><?php echo $i; ?> Day</option>
							<?php
							
							}
							?>
                           
                        </select>
                        <div class="form-control"><a href="javascript:void(0)" onclick="paynow()" id="course_pricehtml">$<?php echo $dailprice; ?> Pay Now</a></div>
                    </form>
                    <div class="clearfix"></div>
                    <h5>Featured</h5>
                    <p>Intensive Care Unit - Princess Margaret Hospital Nassau Bahamas Profession Nursing Licence Validity 17th July, 2021</p>

                    <h3 class="border-title text-left">Featured promotion appearance</h3>
                    <img src="<?php echo ASSETS_URL?>/images/upload/training/<?php echo $dailyprices[0]['trainingimage']; ?>" alt="">
                </div>
            </div>
        </div>
    </div>



<?php 
function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}

$encr = my_simple_crypt('provider_'.$this->session->userdata('logged_in')['id'], 'e' );
$decr = my_simple_crypt($encr, 'd' );


?>


<div id="coupanpopup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Share Coupan</h4>
                </div>
                
                <div class="modal-body promatecompany">
                    <a href="javascript:void(0)" onclick="fbshare()"><i class="fa fa-facebook-square" aria-hidden="true"></i>
                    Facebook Share</a> <br>
                    <a href="javascript:void(0)" onclick="twittershare()"><i class="fa fa-twitter-square" aria-hidden="true"></i>
                    Twitter Share</a><br>
                    <a href="javascript:void(0)" onclick="gplusshare()"><i class="fa fa-google-plus-square" aria-hidden="true"></i>
                    Google Plus Share</a>
                </div>
            </div>
        </div>
    </div>
                     
                    
                    
                

                     




    


	
<script type="text/javascript">


function commonshare(){

    var provider_id = "<?php echo $encr; ?>";
    var courceId = $('#item_coupan').val();
    var path = "<?php echo site_url().'/pages/course_details/' ?>"+courceId+'/'+provider_id;
    return path;
}




/*var twitterShare = document.querySelector('[data-js="twitter-share"]');

twitterShare.onclick = function(e) {
  e.preventDefault();
  var twitterWindow = window.open('https://twitter.com/share?url=' + document.URL, 'twitter-popup', 'height=350,width=600');
  if(twitterWindow.focus) { twitterWindow.focus(); }
    return false;
  }

var facebookShare = document.querySelector('[data-js="facebook-share"]');

facebookShare.onclick = function(e) {
  e.preventDefault();
  var facebookWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + document.URL, 'facebook-popup', 'height=350,width=600');
  if(facebookWindow.focus) { facebookWindow.focus(); }
    return false;
}
*/


function fbshare(){
   var path = commonshare();
   var facebookWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + path, 'facebook-popup', 'height=350,width=600');
    if(facebookWindow.focus) { facebookWindow.focus(); }
    return false;
}

function twittershare(){
    var path = commonshare();
     var twitterWindow = window.open('https://twitter.com/share?url=' + path, 'twitter-popup', 'height=350,width=600');
     if(twitterWindow.focus) { twitterWindow.focus(); }
        return false;
    
}

function gplusshare(){

 var path = commonshare();
     var twitterWindow = window.open('https://plus.google.com/share?url='+path, 'height=350,width=600');
    return false; 




}




function openpopup(val) {
    $('#item_number').val(val);
    $("#courseLisingPromote").modal()
}

function opencoupan(val) {
    $('#item_coupan').val(val);
    $("#coupanpopup").modal()
}



function course_setprice(day)
	{
		var dailprice='<?php echo $dailprice; ?>';
		
		var totalprice=dailprice*day;
		if(day)			
			{
		     jQuery('#course_pricehtml').html('$'+totalprice+' Pay Now');
			}else
			{
				jQuery('#course_pricehtml').html('');
			}
		
	}



function paynow() {
	
    var dailprice='<?php echo $dailprice; ?>';	
    var day=jQuery('#course_day').val();	
    var totalprice=dailprice*day;
	jQuery('#amount').val(totalprice);
    
    var item_name='2-'+day;	 
	 $('#item_name').val(item_name); 	
    document.getElementById("frmPayPal1").submit();
}
</script>	