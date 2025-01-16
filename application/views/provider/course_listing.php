<?php   $this->load->view('template/picture_provider');
        $institution = $this->session->userdata('logged_in')['under_insititution'];
        $uid = $this->session->userdata('logged_in')['id'];  ?>

<div class="innerContent">
    <div class="container">
        <div class="row">
            <?php 
            $this->load->view('provider/sidebar');
            $dailyprices = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
            $coursetax = $this->db->get_where('tbl_all_tax',array('id' => 3,'status' => 1 ))->row_array();

            $filter = $this->uri->segment(3);
            ?>
            <div class="col-sm-9">
			
                <h3 class="border-title text-left">Online Course Listing (<?php echo count($course)-count($coursewithsaveonly); ?>)</h3>
                <a href="<?php echo site_url('provider/course_listing/'); ?>"><h3 style="margin: 0;" class="btn <?php if($filter == ''){ echo "btn-primary";} else {echo "btn-default";}?>">All</h3></a>
                <a href="<?php echo site_url('provider/course_listing/1'); ?>"><h3 style="margin: 0;" class="btn <?php if($filter == 1){ echo "btn-primary";} else {echo "btn-default";}?>">PUBLISHED</h3></a>
                <!--<a href="<?php echo site_url('provider/course_listing'); ?>/2"><h3 class="btn btn-primary <?php if($filter==2){ echo "active";}?>">PENDING FOR ACCREDITATION</h3></a>-->
                <a href="<?php echo site_url('provider/course_listing/2'); ?>"><h3 style="margin: 0;" class="btn <?php if($filter == 2){ echo "btn-primary";} else {echo "btn-default";}?>">Submitted Online Course</h3></a>
                <a href="<?php echo site_url('provider/course_listing/3'); ?>"><h3 style="margin: 0;" class="btn <?php if($filter == 3){ echo "btn-primary";} else {echo "btn-default";}?>">Save Only</h3></a>
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
                                <th>Status</th>
                                <th>Date Published</th>
                                <th>Validity Date</th>
                                <th>Validity Status</th>
                                <th>Promotion Status</th>
                                <th>Created By</th>
                                <th>No. of Certificates Issued</th>
                                <th>Course PDF</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1;
								foreach ($course as $key => $value){
								$creater = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
								$this->db->where('certificate_id !=', '');
								$certificate_count = $this->db->get_where('tbl_exam',array('course_id'=>$value['id']))->num_rows();
                                if($value['status'] == 1){
                                    $stts = "Published";
                                    $class  = "text-success";
                                    $text = "This course is already Published.";
                                    $href = "javascript:void(0)";
                                }elseif($value['status'] == 3){
                                    $stts = "Save only";
                                    $class  = "text-danger";
                                    $text = "Are you sure you want to publish this course?";
                                    $href = base_url('provider/onclickpublish/').$value['id'];
                                }else{
                                    $stts = "Submitted";
                                    $class  = "text-danger";
                                    $text = "Are you sure you want to publish this course?";
                                    $href = base_url('provider/onclickpublish/').$value['id'];
                                }

                        if($value['course_for'] =='a' && $value['status'] !=3 || $value['course_for'] =='p'){ ?>
                            <tr>
                                <td>
                                    <?php echo $count; ?>.</td>
                                <!-- <td><?php echo $value['name']; ?></td>  -->
                                <td><a style="color: blue;" href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['course_title']; ?></a></td>
                                <td><?php echo $value['units']; ?></td>
                                <td><!-- <a onclick="return confirm('Are you sure, you want to change status?')" href="<?php echo site_url('provider/course_status/'.$value['id'].'/'.$value['status'].'');?>" style="color: <?php echo $col;?>"><?php echo $stts; ?></a> -->
                                <a onclick="onclickpublish('<?php echo $text; ?>','<?php echo $href; ?>');" href="javascript:void(0)" class="<?php echo $class;?>"><?php echo $stts; ?></a></td>
                                <td><?php echo ($value['publish_date'] != '0000-00-00')?$value['publish_date']:$value['added_on']; ?></td>
                                <td><?php if($value['course_validity'] != '0000-00-00' && $value['course_validity'] !=''){ echo $value['course_validity']; }else{ echo'--'; } ?></td>
                                
                                <td><?php 
                                $before1month = date("Y-m-d", strtotime($value['course_validity']."-1 months"));
                                // echo  date("Y-m-d").'<='.$before1month;
                                if($value['status']==1){
                                    if(date("Y-m-d")<=$before1month ){
                                        echo "<strong class='text-success'>Active</strong>";
                                    }elseif(date("Y-m-d")>=$before1month && date("Y-m-d")<=$value['course_validity'])
                                    {
                                        echo "<strong class='text-warning blink'>Expiring</strong>";
                                    }else{
                                        echo "<strong  class='text-danger'>Expired</strong>";
                                    }
                                }elseif($value['status']==3 || $value['status']==0){
                                    echo"--";
                                }else{
                                    echo "<strong class='text-danger'>Expired</strong>";
                                } ?>
                                </td>
                                <td><?php if($value['paid_status']==2) { echo '<sapn class="text-success">Featured</span>'; }else{ echo '<sapn class="text-info">Free</span>'; }?></td> 

                                <td><?php if($creater['role'] == 2){ echo 'Provider'.' - '.$creater['name']; }else{ echo 'Author'.' - '.$creater['name']; } ?></td>
                                <td align="center"><?php echo $certificate_count; ?></td>
                                
                                <td><?php if($value['course_pdf_url']!=''){ ?><a target="_blank" href="<?php echo $value['course_pdf_url'];?>">View PDF</a><?php }else{ echo 'no pdf found!'; } ?></td>
                                
                                <td width="200">
                                    <a class="btn btn-info pt-1" title="View" href="<?php echo site_url('provider/course_view/'.$value['id'].'');?>"><i class="fa fa-eye"></i></a>
                                   
                                <?php if($value['status']!=1){ ?>
                                    <a class="btn btn-info pt-1" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/course_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a>
                                <?php }
								 echo '<a class="btn btn-info" title="Edit" href="'.site_url('provider/course_edit/'.$value['id'].'').'"><i class="fa fa-pencil"></i></a>';
                                if($institution != 1) { 
                                    if($value['status']==1){ ?>   
                                    <a class="btn btn-info pt-1" title="Promote" onclick="openpopup('<?php echo $value['id'];?>','<?php echo $value['course_title'];?>')" href="javascript:void(0)"><i class="fa fa-bullhorn"></i></a>

                                     <a class="btn btn-info pt-1" title="Coupan" onclick="opencoupan('<?php echo $value['id'];?>')" href="javascript:void(0)"><i class="fa fa-tag"></i></a>

                                     <?php $encrypted_course_id = base64_encode($value['id']); ?>
                                     <a target="_blank" class="btn btn-info pt-1" title="Renew Course" href="<?php echo GOVT_URL;?>course/profile/<?php echo $encrypted_course_id;?>"><i class="fa fa-repeat" aria-hidden="true"></i></a>
                                    <?php } ?>
                                <?php } ?>
                                <!-- <a onclick="send_course_rboard('<?php echo $value['id'];?>')" href="javascript:void(0);" class="btn btn-info" title="Send to RBoard"><i class="fa fa-university"></i></a> -->
                                <a href="<?php echo base_url('provider/get_course_pdf/').$value['id'];?>" class="btn btn-info pt-1" title="Create PDF file"><i class="fa fa-file-pdf-o"></i></a>
                                <a href="javascript:void(0);" data-id="<?php echo $value['id'];?>" class="btn btn-info pt-1 duplicateCourse" title="Duplicate Course"><i class="fa fa-files-o"></i></a>
                                </td>
                            </tr>
                            <?php $count++; }  } ?>
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

  <!--   <form action="<?php echo PAYAPAL_URL; ?>" method="post" name="coursePromostion" id="coursePromostion">
        <input type="text" name="business" value="<?php echo PAYAPAL_ID; ?>">
        <input type="text" name="cmd" value="_xclick">
        <input type="text" name="item_name" id="item_name">
        <input type="text" name="item_number" id="item_number">
        <input type="text" name="credits" value="510">
        <input type="text" name="userid" value="<?php echo $uid; ?>">
        <input type="text" name="amount" id="amount" value="<?php echo  $pricewithtax; ?>">
        <input type='text' name='rm' value='2'>
        <input type="text" name="no_shipping" value="1">
        <input type="text" name="currency_code" value="USD">
        <input type="text" name="handling" value="0">
        <input type="text" name="cancel_return" value="<?php echo site_url('provider/course_listing'); ?>">
        <input type="text" name="return" value="<?php echo site_url('provider/course_promotion_paypal'); ?>">
    </form> -->

    <div id="courseLisingPromote" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Promote Your Online Course</h4>
                </div>
                <?php  $user = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid); ?>
                <div class="modal-body promatecompany">
                    <div class="author-thumb">
                    <?php if($user[0]['image']){?>
                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$user[0]['image']; ?>" alt="">
                    <?php }else{ ?>
                        <img src="<?php echo ASSETS_URL.'images/uploads/dummy-profile.jpg'; ?>" alt="">
                    <?php }?>
                    </div>
                <form class="payform" id="coursepro" action="<?php echo base_url('provider/coursepromote');?>" method="post" enctype="multipart/form-data">
    				<?php
                        $pricewithtax = $coursetax['total_amount'];
                        $dailprice = $coursetax['base_price'];
                        $tax = $coursetax['tax_amount'];
                       ?>
                    <input type="hidden" id="dailyprice" name="dailyprice" value="<?php echo $dailprice; ?>"> 
                    <input type="hidden" name="tax" value="<?php echo $tax; ?>"> 
                    <input type="hidden" name="pricewithtax" id="pricewithtax" value="<?php echo $pricewithtax; ?>"> 
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>"> 
                    <input type="hidden" name="item_name" id="item_name">
                    <input type="hidden" name="custom" id="custom">
    			    <!-- <input type="hidden" id="course_dailyprice" name="course_dailyprice" value="<?php echo $dailprice; ?>">  -->
                    <div class="form-control"><a href="#"><?php echo '$'.$pricewithtax.'/day'; ?></a></div>
                    <select class="form-control" id="course_day" name="course_day" onchange="course_setprice(this.value)">
                        <?php for($i=1; $i<=31;$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?> Day</option>
    					<?php } ?>
                    </select>
                    <div class="form-control btn-success">
                        <a href="javascript:void(0)" onclick="submitcourseform()" id="course_pricehtml">$<?php echo $pricewithtax; ?> Pay Now</a>
                    </div>
                </form>
                    <div class="clearfix"></div>
                    <h5>Featured</h5>
                    <p><?php echo $dailyprices[0]['text_course'];?></p>

                    <h3 class="border-title text-left">Featured promotion appearance</h3>
                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$dailyprices[0]['coursesimage']; ?>" alt="">
                </div>
            </div>
        </div>
    </div>

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

    <div id="promotionpayby" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Choose Payment Option</h4>
            </div>
            <div class="modal-body"> 
                <a href="javascript:void(0)" onclick="paypromotionbypaypal();" class="btn" role="button"><img src="<?=base_url('assets/images/paypallogo.png') ?>" style="height:40px; width:100px;"></a>
                <a href="javascript:void(0)" onclick="paypromotionbystrip();" class="btn" role="button"><img src="<?=base_url('assets/images/OIP.jpg') ?>" style="height:40px; width:100px;"></a>
                <a href="javascript:void(0)" onclick="paypromotionbypayu();" class="btn" role="button"><img src="<?=base_url('assets/images/payu.jpg') ?>" style="height:40px; width:100px;"></a>
            </div>
          </div>
        </div>
    </div>

    <form action="<?php echo base_url('stripe/index'); ?>" method="get" name="stripePay" id="promotionStripeBuy">
        <input type="hidden" name="id" id="courseid"> <!-- here id is courseid. -->
        <input type="hidden" name="name" id="coursename">
        <input type="hidden" name="price" id="totalpromotionprice" value="<?php echo $pricewithtax; ?>">
        <input type="hidden" name="tax" id="stripepromotionTax" value="<?php echo $tax; ?>">
        <input type="hidden" name="day" id="totalpromotionday" value="1">
        <input type="hidden" name="base_price" id="stripepromotionBase" value="<?php echo $dailprice; ?>">
        <input type="hidden" name="type" value="Course Promotion">
    </form>

    <form action="<?php echo base_url('payu/index'); ?>" method="get" name="stripePay" id="promotionpayuBuy">
        <input type="hidden" name="id" id="courseidpayu"> <!-- here id is courseid. -->
        <input type="hidden" name="name" id="coursenamepayu">
        <input type="hidden" name="price" id="totalpromotionpricepayu" value="<?php echo $pricewithtax; ?>">
        <input type="hidden" name="tax" id="payupromotionTax" value="<?php echo $tax; ?>">
        <input type="hidden" name="day" id="totalpromotiondaypayu" value="1">
        <!--<input type="hidden" name="base_price" id="stripepromotionBase" value="<?php echo $dailprice; ?>">-->
        <input type="hidden" name="type" value="Course Promotion">
    </form>
	
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    function commonshare(){
        var provider_id = "<?php echo $encr; ?>";
        var courceId = $('#item_coupan').val();
        var path = "<?php echo site_url().'/pages/course_details/' ?>"+courceId+'/'+provider_id;
        return path;
    }
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

    function openpopup(id,course_name) {
        $('#custom').val(id);
        $('#courseid').val(id); //for stripe payments
        $('#courseidpayu').val(id); //for payu payments
        $('#item_name').val(course_name +' - Course Promotion');
        $('#coursename').val(course_name +' - Course Promotion');//for stripe payments
        $('#coursenamepayu').val(course_name +' - Course Promotion');//for payu payments
        $("#courseLisingPromote").modal()
    }

    function opencoupan(val) {
        $('#item_coupan').val(val);
        $("#coupanpopup").modal()
    }

    function course_setprice(day){
		var pricewithtax='<?php echo $pricewithtax; ?>';
        var dailprice = '<?php echo $dailprice; ?>';
        var tax = '<?php echo $tax; ?>';
        var totaltax = tax * day;
		var pricetax ='';
        var totalprice = (pricewithtax*day).toFixed(2);
        jQuery('#stripepromotionTax').val(tax);
        jQuery('#payupromotionTax').val(totaltax);
        jQuery('#totalpromotionday').val(day);
        jQuery('#totalpromotiondaypayu').val(day);
        jQuery('#stripepromotionBase').val(dailprice);

		if(day){
	       jQuery('#course_pricehtml').html('$'+totalprice+' Pay Now');
           jQuery('#pricewithtax').val(totalprice);
           jQuery('#totalpromotionprice').val(totalprice);
           jQuery('#totalpromotionpricepayu').val(totalprice);
		}else{
		   jQuery('#course_pricehtml').html('');
		}
	}		

    function paynow() {
    	var dailprice = '<?php echo $dailprice; ?>';
        var tax = '<?php echo $tax; ?>';
        var day = jQuery('#course_day').val();
        var pricetax ='';
        var totalprice = (dailprice*day);
        if(tax <= 0){
            // tax = 1;
            pricetax = totalprice;
        }else{
            pricetax = ((totalprice*tax)/100);
        }
        var priceaddtax = (parseInt(totalprice) + parseInt(pricetax)).toFixed(2);
        // var dailprice='<?php echo $dailprice; ?>';	
        // var totalprice=dailprice*day;
    	jQuery('#amount').val(priceaddtax);	 	
        document.getElementById("coursePromostion").submit();
    }

    function onclickpublish(text,hrefurl){
        var x = confirm(text);
        if(x==true){
            window.location.href = hrefurl;
        }
    }
  
    function submitcourseform() { 
        $("#promotionpayby").modal("show"); 
        $("#courseLisingPromote").modal("hide"); 
        // jQuery('#coursepro').submit();
    }

    function paypromotionbypaypal() {
        $("#coursepro").submit();
    }

    function paypromotionbystrip() {
        $("#promotionStripeBuy").submit();
    }
    function paypromotionbypayu() {
        $("#promotionpayuBuy").submit();
    }

    // *** send course is no longer to send by API is will be a manual process, cep will download course pdf and simply go to RBoard on his account than he manually add course and upload this pdf. *** //

    function send_course_rboard(cid){
        var email = "<?php echo $this->session->userdata('logged_in')['username']; ?>";
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('rboard/get_course');?>',
            data: { cid:cid, email:email },
            success: function(result){
                var count   = Object.keys(result).length;
                if(count > 0){
                var obj  = JSON.parse(result);
                var json = JSON.stringify(obj); 
                // console.log(json);
                $.ajax({
                    url: 'https://ceonpoint.com/RBoard/admin/Api/add_course',
                    type: 'POST',
                    data: json,
                    dataType: 'json',
                    success: function(result){
                        var obj = JSON.parse(result);
                        console.log(obj);
                        if(obj.success==true){
                            alert(obj.msg);
                        }else{
                            alert(obj.msg);
                        }
                    }
                });

                }else{
                        alert('You have already sent that course to Regulatory Board.');
                }
            }
        });        
    }

    $('.duplicateCourse').on('click', function(){
        var c = confirm('Do you want to duplicate this course and all contents?');
        if(c == true){
            var id = $('.duplicateCourse').attr('data-id');
            var path = "<?php echo base_url(); ?>";
            window.location.href = path + 'provider/duplicateRecordCourse/'+id;
        }
    });

    /*
    var twitterShare = document.querySelector('[data-js="twitter-share"]');

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
</script>	

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