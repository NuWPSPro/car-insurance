<?php $this->load->view('template/picture_author'); 
	  $cid = $this->uri->segment(3);?>
		
<?php 
		$uid = $this->session->userdata('logged_in')['id']; 
	  	$uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
	  	$up_id = end(explode('-', $uprovider)); 
	  	$uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
	  	?>
<div class="innerContent author-edit-promotion">
	<div class="container">
		<div class="row">
		<?php 	$this->load->view('author/sidebar');?>	

	<div class="col-sm-9">
			<h2><?php echo $course[0]['course_title']; ?></h2>
			<h3 class="border-title text-left">Edit Course</h3>

			<div class="step-wise-query">
		<ul class="nav-tabs hidden-xs">
			<li><a  href="<?php echo site_url('author/course_edit/').$cid;?>">Overview</a></li>
			<li><a  href="<?php echo site_url('author/lesson_edit/').$cid;?>">Lessons</a></li>
			<li><a  href="<?php echo site_url('author/edit_quiz/').$cid;?>">Quiz</a></li>
			<li><a  href="<?php echo site_url('author/edit_certificate/').$cid;?>">Certificate</a></li>
			<li><a  href="<?php echo site_url('author/edit_evaluation/').$cid;?>">Evaluation</a></li>
			<?php if($uins == '0'){ ?>
			<li class="active"><a href="<?php echo site_url('author/edit_promotion/').$cid;?>">Promotion</a></li>
			<?php } ?>
			<li><a  href="<?php echo site_url('author/edit_publish/').$cid;?>">Publish</a></li>
		</ul>

			<div class="tab-content steps-detail">
			<a class="title-mobile" data-toggle="tab" href="#step1">Overview</a>
			<div id="step1" class="tab-pane fade in active">
				<h3>Edit Promotion</h3>

			<form action="<?php echo site_url('author/edit_promotion'); ?>" method="post" enctype="multipart/form-data" name="author-promostion" id="author-promostion"> 
				<div class="row">
					<?php echo $this->session->flashdata('response');?>
				<div class="col-sm-12 form-group">
						<label>Promote <sup>*</sup></label>
						<select class="form-control" name="promote" id="promote" onchange="showbutton()">
						<option value="" selected>Please Select</option>
						<option value="0_1">Regular</option>
							 <option value="10_2">Featured Courses</option> 
							<!-- <option value="20_3">Top List Courses</option>
							<option value="30_4">Premium List Courses</option> -->
						</select> 
					<input type="hidden" name="cid" id="cid" value="<?php echo $this->session->userdata('current_course_id');?>">	
					</div>

				<div class="col-sm-2 form-group" id="next" style="display: none;">
					<input type="submit" class="btn btn-primary btn-lg" value="SAVE & NEXT">

				</div>
		<!-- 	<div class="col-sm-2 form-group" id="paynow" style="display: none;">
				<input type="button" class="btn btn-primary btn-lg" value="PAY NOW" onclick="paynow()">
				</div> -->
		<br>
		<br>

		<div class="col-sm-12 form-group promatecompany" id="featured" style="display: none;">
	 <div class="payform">
					<?php	
                     $dailyprices = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);			
					$dailprice=$dailyprices[0]['courses_daily_price'];	
					
					?>
					 <input type="hidden" id="course_dailyprice" name="course_dailyprice" value="<?php echo $dailprice; ?>"> 
					
                        <div class="form-control"><a href="javascript:void(0)">$<?php echo $dailprice; ?>/day</a></div>
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
                    <img src="<?php echo ASSETS_URL?>/images/promotion.jpg" alt="">

		</div>



    </div>

		<div class="col-sm-12 form-group" id="toplist" style="display: none;">

		<p style="font-weight: bold;">About Toplist</p>

		<p>

		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	

		</p>

		<p>

		<img src="<?php echo BASE_URL?>/assets/images/toplist.png">

	</p>

		</div>







		<div class="col-sm-12 form-group" id="premium" style="display: none;">

		<p style="font-weight: bold;">About Premium</p>

		<p>

		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	

		</p>

		<p><img src="<?php echo BASE_URL?>/assets/images/premium.png"></p>

		</div>







		<div class="col-sm-12 form-group" id="free" style="display: none;">

		<p style="font-weight: bold;">About Free</p>

		<p>

		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	

		</p>
		<h3 class="border-title text-left">Regular promotion appearance</h3>
		<img src="<?php echo ASSETS_URL?>/images/regular-promotion.png" alt="">

		</div>



			 </div> 

			 </form>	





			</div>



			 

			</div>

			</div>

		</div>





		

		</div>

	</div>

</div> 

</div>
<a href="#" id="scroll" style="display: block;"><span></span></a>











<script type="text/javascript">
	function showbutton(){
		var quiz_course = $('#promote').val();
		//alert(quiz_course);
		$('#free').hide();
		$('#featured').hide();
		$('#toplist').hide();
		$('#premium').hide();

		if(quiz_course=='0_1'){
			document.getElementById("next").style.display='block';
			document.getElementById("paynow").style.display='none';
			$('#free').show();
		} else {	
		
			if(quiz_course=='10_2'){
				$('#featured').show();
			} 
			if(quiz_course=='20_3'){
				$('#toplist').show();
			}
			if(quiz_course=='30_4'){
				$('#premium').show();
			}
			document.getElementById("next").style.display='none';
			document.getElementById("paynow").style.display='block';
		}
	}

	function paynow(){   	
		var dailprice='<?php echo $dailprice; ?>';	
		var day=jQuery('#course_day').val();	
		var totalprice=dailprice*day;
		jQuery('#amount').val(totalprice);  
		var item_name='2-'+day;	 
		$('#item_name').val(item_name);  
		document.getElementById("frmPayPal1").submit();
	}


	function course_setprice(day)
	{
		var dailprice='<?php echo $dailprice; ?>';
		var totalprice=dailprice*day;
		if(day)			
		{
		    jQuery('#course_pricehtml').html('$'+totalprice+' Pay Now');
		}else{
			jQuery('#course_pricehtml').html('');
		}
	}
</script>











<form action="<?php echo PAYAPAL_URL; ?>" method="post" name="frmPayPal1" id="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" id="item_name" value="2">
    <input type="hidden" name="item_number" id="item_number" value="<?php echo $cid;?>">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" id="amount">
    <!--     <input type="hidden" name="cpp_header_image" value="https://www.phpgang.com/wp-content/uploads/gang.jpg"> -->
    <input type='hidden' name='rm' value='2'>
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo site_url('author/edit_promotion/').$cid; ?>">
    <input type="hidden" name="return" value="<?php echo site_url('author/course_promote_success')?>">   
</form>