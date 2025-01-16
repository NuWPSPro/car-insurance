
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {
        $("input").on("change", function() {
            this.setAttribute(
              "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
                )
        }).trigger("change")
    });
</script>

<section class="ce-tracker training_management" style="background-image: url(http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/TMS-top-photo.jpg);">

	<div class="elementor-background-overlay"></div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="elementor-widget-wrap cfvalidation">
					<h2>Digital Certificate Validation</h2>
					<div class="col input-box">
					 <input class="form-control border-secondary border-right-0 rounded-0" type="search" placeholder="Enter Certificate Number" id="certifiacte_no" name="certifiacte_no">
					     <div class="col-auto secrch-icon" onclick="certifiacte()">
                   <button id="certi_button" class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="button">
                      <span>submit</span>
                   </button>
               </div>
          </div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="py-5">
	<div class="container">
		<div class="tms-pricing mb-4">
		    <div class="text-center">
    			<h2 class="text-uppercase fw-bold mb-0">DIGITAL CERTIFICATE SOFTWARE</h2>
    			<p>We make your certificate verifiable online for your <br>
professional license renewal, job applications and job performance appraisal.</p>
			</div>
		</div>
		<div class="row">
		    <div class="col-md-8 col-md-offset-2">
		        <div class="row">
		    <div class="col-md-6">
		        <img src="<?php echo ASSETS_URL.'images/dcm-img.png'?>">
		    </div>
		    <div class="col-md-6">
		        <h3 class="fw-bold">What makes your digital certificate authentic?</h3>
		        <ul style="padding-left: 17px;">
		            <li>It is issued by accredited CE Providers or duly established institution.</li>
                    <li>It has digital certificate number and bar code.</li>
                    <li>It is verifiable online on the website of the CEP Providers, institutions or website like ceonpoint.com.</li>
		        </ul>
		    </div>
		    </div>
		    </div>
		</div>
	</div>
</section>
<section class="tms-featurespanel tms-templatespanel">
	<div class="container">
		<div class="top-titlebox">
			<h2>HOW TO CREATE DIGITAL CERTIFICATE?</h2>
			
		</div>
		<div class="row">
		    <div class="col-md-4">
		        <h5 class="fw-bold text-white">CREATE ACCOUNT AT <br>
                ceonpoint.com as:</h5>
                <p>Certificate needed for
                 license renewal or job</p>
                 <p>Certificate for 
                institution’s use only
                
                </p>
		    </div>
		    <div class="col-md-4">
		        <h5 class="fw-bold text-white">CERTIFICATE FOR ONLINE COURSE</h5>
		        <ul>
		            <li>At your dashboard :</li>
                    <li>Click the tab “ Create online Course”</li>
                    <li>Fill up all the information that will include the certificate details.</li>
                    <li>Publish the online course.</li>
                    <li>When professionals or staff take the online course and pass the examination, the digital certificate is automatically generated.</li>
                    <li>It is sent to the email of the professional automatically.</li>
                    <li>It is also recorded in the CEP/institution, professional and admin account.</li>
		        </ul>
		    </div>
		    <div class="col-md-4">
		        <h5 class="fw-bold text-white">CERTIFICATE FOR TRAINING  (IN-PERSON OR VIRTUAL)</h5>
		        <ul>
		            <li>At your dashboard :</li>
                    <li>Click the tab “ Upload Training.”</li>
                    <li>Fill up the information including the Certificate details.</li>
                    <li>Publish the training.</li>
                    <li>Let participants register to the training.</li>
                    <li>At the back end, click the training eye icon</li>
                    <li>At the list of participants, go to action column.</li>
                    <li>Change the status from pending to present.</li>
                    <li>Go to the certificate tab and click generate certificate button.</li>
                    <li>Pay for the corresponding amount for the certificate.</li>
                    <li>Click the generate certificate button.</li>
                    <li>Certificate is now done and sent to the email of the professional automatically.</li>
                    <li>It is also recorded in the CEP/institution, professional and admin account.</li>
		        </ul>
		    </div>
		</div>
	</div>
</section>

<!-- <section class="What-Instant">
<div class="container">
	<div class="validation-centent">
    <img src="http://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/cetracker7-2.jpg" alt="">
	</div>
</div>
</section> -->

<div class="modal" id="myModalcertificate123">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Certificate</h4>
        <?php echo $this->session->flashdata('response'); ?>
        <button onclick="certificateFunction();" style="float: left;" type="button"><i class="fa fa-print"></i></button>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <div id="wwww">
            <div class="innerContent">
              <div class="container">
                <div class="row">
                  <div class="col-sm-7">
                  <!-- <?php  print_r(BASE_URL.'assets/upload/pdf/'.$_REQUEST['certificate'].'pdf'); ?> -->
                  <!-- <iframe src="https://ceonpoint.com/assets/upload/pdf/<?php echo $_REQUEST['certificate']; ?>.pdf" height="650" width="550"></iframe> -->

                  <iframe src="<?php echo ASSETS_URL.'upload/pdf/'.$_REQUEST['certificate']; ?>.pdf" height="650" width="550"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div id="verifyModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
        <button onclick="certificateFunction();" style="float: left;" type="button"><i class="fa fa-print"></i></button>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <button onclick="alert('Please Download this certificate to print!')" style="float: left;" type="button"><i class="fa fa-print"></i></button> -->
                <h4 class="modal-title">Certificate</h4>
            </div>
            <div class="modal-body">
                <div id="verifyCertificateData"></div>
            </div>
        </div>
    </div>
</div>

 
<?php 
if($_REQUEST['certificate'] !=""){
?>
 <script type="text/javascript">
     function showpdfs(){
        $('#myModalcertificate123').modal('show');
     }
     showpdfs();
 </script>

 <?php } ?>

 <script type="text/javascript">
  var certi = 0; 
    function certifiacte() {
      var certifiacte_no = $('#certifiacte_no').val().trim();
          certi = certifiacte_no;

        if (certifiacte_no == "") {
            document.getElementById('certifiacte_no').style.border = '1px solid #F00';
            return false;
        }
          $('#certi_button').text('Please wait...');

      $.ajax({
                type: "POST",
                url: '<?php echo base_url("users/certificate_download");?>',
                data: { certifiacte_no: certifiacte_no },
                beforeSend: function() {
                $("#verifyCertificateData").html("");
            }
            }).done(function(result) {
             
                $("#verifyCertificateData").html(result);
                $('#verifyModal').modal('show');
            });
            return false;
        }

      function certificateFunction() {
      // alert(certi);
      var x = confirm('Do you want to print it?, Please click on Yes.');
      if(x == true){
        var url = "<?php echo site_url('pages/download_certificate/')?>"+ certi;
      window.location.href = url;
      }

    }
</script>