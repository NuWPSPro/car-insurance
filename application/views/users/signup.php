<?php $role = $this->uri->segment(3); ?>
<div class="container">
    <div class="row my-5">
        <div class="col-sm-8">
            

            <div class="clearfix login-grid">
                <div class="row signup-features">
                    <div class="col-md-3">
                        <div class="professionals-icons">

                            <?php if($role=="provider"){ ?>
                            <img src="https://w7.pngwing.com/pngs/240/672/png-transparent-car-vehicle-insurance-insurance-policy-life-insurance-insurance-text-logo-monochrome-thumbnail.png" alt="car-insurance-company">
                            <?php     
                            } else if($role=="professional"){
                            ?>
                            <img src="https://www.shareicon.net/data/512x512/2015/09/15/641035_man_512x512.png" alt="car-owner">
                            <?php     
                            } else if($role=="authors"){
                            ?>
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpPwUwBc7D6SN2XbhDq1tj8-i-7Q8YC1RSHg&usqp=CAU" alt="broker">
                            <?php     
                            } else if($role=="institution"){
                            ?>
                            <img src="<?php echo ASSETS_URL.'images/institution.png'; ?>">
                            <?php     
                            } else if($role=="advertisers"){
                            ?>
                            <img src="<?php echo ASSETS_URL.'images/advertisers.png'; ?>">
                            <?php     
                            }else if($role=="rboard"){
                            ?>
                            <img src="<?php echo ASSETS_URL.'images/boards.png'; ?>">
                            <?php     
                            }
                            ?>
                            <span class="text-info"> <?php 
							if($role=="provider"){
							    echo strtoupper('Car Insurance Company');
							} elseif($role=="rboard") {
								echo strtoupper('Govt. Prof. Reg. Board');
							} elseif($role=="professional") {
								echo strtoupper('Car Owner');
							} else {
								echo strtoupper($role);
							}
							?></span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="signup-bullet-points">
					<?php
					
					  if($role=="advertisers"){
						  
						  ?>
						  <h3>ADVERTISEMENT PACKAGE</h3>
							<ul>
								<li>Page Exposure:All Pages</li>
								<li>Hours of exposure/day: 24 hours</li>
								<li>Views: 1,000 view per day</li>
								<li>Prices depending on the ads placement & size</li>
								<li>View Ads statistics in your dashboard</li>
								<li>Receive Ads Performance Report after completion</li>
								
							</ul>
						  <?php }else if($role=="authors"){ ?>

                        <h3>What we offer to Authors of continuing education?</h3>
                        <div class="p-3 text-center bg-white rounded mb-4">
                             <h4 class="mb-0"><strong>ACE Platform</strong></h4>
                            <h5 class="text-uppercase"><span class="text-danger">A</span>uthor of <span class="text-danger">C</span>ONTINUING <span class="text-danger">E</span>DUCATION (ACE) Platform</h5>
                            <p>"Work as author under CED Provider to provide Online Courses"</p>
                            <a href="<?php echo base_url('pages/cpAauthor'); ?>" class="btn btn-primary">Learn More</a>
                            <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#authorDModal">Brief info</a>

                            <div class="modal fade" id="authorDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="mb-0 mt-3 text-uppercase"><strong>3 Components of ACE-MS</strong></h4>
                                  </div>
                                    
                                  <div class="modal-body">
                            <div class="ice-components-box">
                                <a href="#latest-cetrackerpanel">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img5.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>ICE <br> Software</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadMobile">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img1.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>ICE MOBILE <br> APP</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadWebpage">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img6.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>ICE  <br>  WEBPAGE</span>
                                    </div>
                                </a>
                            </div>
                            <h5>Author of Continuing Education Management Software (ACE-MS) with following Capabilities: </h5>
                          
                            <ul style="text-align: left;">
                                <li>Align yourself to your Accredited CE Provider</li>
                                <li>Unlimited upload of Online CE Courses</li>
                                <!-- <li>CE required vs CE obtained standing.</li> -->
                                <li>Promote yourself as Author at Author's page</li>
                                <li>Promote your Online Courses for more sales</li>
                                <li>Use digital certificate for online courses</li>
                                <li>Have your own Profile page</li>                                
                            </ul>
                            </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
            <?php  }else if($role=="institution"){ 	?>

					  	<h3>WHAT WE OFFER TO INSTITUTIONS?</h3>
                        <div class="p-3 text-center bg-white rounded mb-4">
                             <h4 class="mb-0"><strong>ICE PLATFORM</strong></h4>
                            <h5><span class="text-danger">I</span>NSTITUTION <span class="text-danger">C</span>ONTINUING <span class="text-danger">E</span>DUCATION (ICE) PLATFORM</h5>
                            <p>"Empowering staff through continuing education to deliver quality service."</p>
                            <a href="<?php echo base_url('pages/InstitutionCEPlatform/provider'); ?>" class="btn btn-primary">Learn More</a>
                            <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#instituionDModal">Brief info</a>

                            <div class="modal fade" id="instituionDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="mb-0 mt-3 text-uppercase"><strong>3 Components of ICE Platform</strong></h4>
                                  </div>
                                  <div class="modal-body">

                            <div class="ice-components-box">
                                <a href="#latest-cetrackerpanel">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img5.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>ICE <br> Software</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadMobile">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img1.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>ICE MOBILE <br> APP</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadWebpage">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img6.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>ICE  <br>  WEBPAGE</span>
                                    </div>
                                </a>
                            </div>

                     <h5>Institution Continuing Education Management Software <br/><b>(ICE-MS)</b> with following Capabilities: </h5>

                    <ul style="text-align: left;">
                        <li>Instant CE webpage of your institution</li>
                        <li>Set annual training target</li>
                        <li>View real-time accomplishments</li>
                        <li>Register unlimited sub-institutions</li>
                        <li>Register unlimited CE Providers and authors</li>
                        <li class="more1">Register unlimited staff</li>
                        <li class="more1">Track CE compliance of staff</li>
                        <li class="more1">Unlimited uploads of online courses and training</li>
                        <li class="more1">Issue digital certificates for online courses & training</li>
                        <li class="more1">Use Training Management Software (TMS)</li> 
                        <li class="more1">Archive your previous annual target and accomplishment</li>
                        <a class="read-more" onclick="readmore()" id="myBtn">Read more</a>
                    </ul>
                        </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>

					<?php  }else if($role=="provider"){  ?>

                        <h3 class="mb-2">WHAT WE OFFER TO CAR INSURANCE COMPANY?</h3>
                        <div class="p-3 text-center bg-white rounded mb-4">
                             <h4 class="mb-0"><strong>CEP PLATFORM</strong></h4>
                            <h5> <span class="text-danger">C</span>ONTINUING <span class="text-danger">E</span>DUCATION <span class="text-danger">P</span>ROVIDER PLATFORM</h5>
                            <p>"Share your professional expertise through online courses or training to all professionals worldwide and earn passive income."</p>
                            <a href="<?php echo base_url('pages/ceprovideplateform/provider'); ?>" class="btn btn-primary">Learn More</a>
                            <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#providerDModal">Brief info</a>

                            <div class="modal fade" id="providerDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="mb-0 mt-3 text-uppercase modal-title"><strong>5 Components of CEP Platform</strong></h4>
                                    <h5 class="mb-0 mt-3 text-uppercase"><strong>Our free support</strong></h5>
                                  </div>
                                  <div class="modal-body">
                            <h5>Ceonpoint provide you with the tools and platform to achieve your goal <br/> the share expertise and earn passive income <span style="color: red;">FOR FREE.</span><br>we only earn when you earn from the sale of your online courses.</h5>
                            <div class="ice-components-box">
                                <a href="#cetracker-coursepanel">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img4.jpg';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>CEP-MS <br>Software </span>
                                    </div>
                                </a>
                                <a href="#latest-cetrackerpanel">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img5.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>CEP <br>Webpage</span>
                                    </div>
                                </a>
                                <a href="#pcs-ms-box">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img5.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>Local & Global<br>Plateform</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadMobile">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img1.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>MOBILE <br> APP</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadWebpage">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img6.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>Passive <br>Income</span>
                                    </div>
                                </a>
                        </div>
                         <h5>Continuing Education Provider Management Software <br/><b>(CEP-MS)</b> with the following capabilities:</h5>

                        <ul style="text-align: left;">
                            <li>Unlimited upload of Online courses and training details.</li>
                            <li>Social Media marketing tool to promote online courses or training.</li>
                            <li>Real time Income report & invoice system.</li>
                            <li class="more1">Digital Certificate in all online courses and training.</li>
                            <li class="more1">Training Management Software (FREE and PRO Version).</li>
                            <li class="more1">Automated reporting system of certificate, exam result and evaluation & other document to the government regulatory board or institution.</li>
                            <li class="more1">NO monthly subscription fee, no hosting fee, no Maintenance fee.</li>
							<li class="more1">Receive monthly Sales Revenue.</li>
							<li class="more1">Approve unlimited authors under CEP.</li>
							<li class="more1">Receive unlimited Online Courses from authors.</li>
                        </ul>
                        <a class="read-more" onclick="readmore()" id="myBtn">Read more</a>
                            </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                        </div>
                        </div>
                            
                   <?php   }else if($role=="rboard"){  ?>

                        <h3 class="mb-2">WHAT WE OFFER TO PROFESSIONAL REGULATORY BOARD?</h3>
                        <div class="p-3 text-center bg-white rounded mb-4">
                             <h4 class="mb-0"><strong>PRB ONLINE PLATFORM</strong></h4>
                            <h5> PROFESSIONAL REGULATORY BOARD (PRB) ONLINE PLATFORM</h5>
                            <p>"Automated Service Delivery System open 24/7, worldwide."</p>
                            
                            <a href="<?php echo base_url('rboard/index'); ?>" class="btn btn-primary">Learn More</a>
                            <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#">Brief info</a>
                            <a href="<?php echo base_url('pages/rboards'); ?>" class="btn btn-primary">Reg. Boards</a>

                            <div class="modal fade" id="providerDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="mb-0 mt-3 text-uppercase modal-title"><strong>5 Components of CEP Platform</strong></h4>
                                    <h5 class="mb-0 mt-3 text-uppercase"><strong>Our free support</strong></h5>
                                  </div>
                                  <div class="modal-body">
                            <h5>Ceonpoint provide you with the tools and platform to achieve your goal <br/> the share expertise and earn passive income <span style="color: red;">FOR FREE.</span><br>we only earn when you earn from the sale of your online courses.</h5>
                            <div class="ice-components-box">
                                <a href="#cetracker-coursepanel">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img4.jpg';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>CEP-MS <br>Software </span>
                                    </div>
                                </a>
                                <a href="#latest-cetrackerpanel">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img5.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>CEP <br>Webpage</span>
                                    </div>
                                </a>
                                <a href="#pcs-ms-box">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img5.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>Local & Global<br>Plateform</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadMobile">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img1.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>MOBILE <br> APP</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadWebpage">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img6.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>Passive <br>Income</span>
                                    </div>
                                </a>
                        </div>
                         <h5>Continuing Education Provider Management Software <br/><b>(CEP-MS)</b> with the following capabilities:</h5>

                        <ul style="text-align: left;">
                            <li>Unlimited upload of Online courses and training details.</li>
                            <li>Social Media marketing tool to promote online courses or training.</li>
                            <li>Real time Income report & invoice system.</li>
                            <li class="more1">Digital Certificate in all online courses and training.</li>
                            <li class="more1">Training Management Software (FREE and PRO Version).</li>
                            <li class="more1">Automated reporting system of certificate, exam result and evaluation & other document to the government regulatory board or institution.</li>
                            <li class="more1">NO monthly subscription fee, no hosting fee, no Maintenance fee.</li>
							 <li class="more1">Receive monthly Sales Revenue.</li>
							  <li class="more1">Approve unlimited authors under CEP.</li>
							   <li class="more1">Receive unlimited Online Courses from authors.</li>
							    
                        </ul>
                        <a class="read-more" onclick="readmore()" id="myBtn">Read more</a>
                            </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                        </div>
                        </div>
                            
                   <?php   }else{ ?>

                         <h3 class="mb-2">WHAT WE OFFER TO CAR OWNER?</h3>
                         <div class="p-3 text-center bg-white rounded mb-4">
                             <h4 class="mb-0"><strong>PCE PLATFORM</strong></h4>
                            <h5><span class="text-danger">P</span>ROFESSIONAL <span class="text-danger">C</span>ONTINUING <span class="text-danger">E</span>DUCATION PLATFORM</h5>
                            <p>"We focus on helping professionals to become ready for license renewal or job performance appraisal."</p>
                            <a href="<?php echo base_url('pages/ocms/professional'); ?>" class="btn btn-primary">Learn More</a>
                            <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#professionalDModal">Brief info</a>

                            <!-- Modal -->
							<div class="modal fade" id="professionalDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							        <h4 class="mb-0 mt-3 text-uppercase modal-title" id="exampleModalLabel"><strong>5 Components of PCE Platform</strong></h4>
							      </div>
							      <div class="modal-body">
							        
                            
                            <div class="ice-components-box">
                                <a href="#cetracker-coursepanel">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img4.jpg';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>Global <br> CE COURSES </span>
                                    </div>
                                </a>
                                <a href="#latest-cetrackerpanel">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img5.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>Institution <br> CE Courses</span>
                                    </div>
                                </a>
                                <a href="#pcs-ms-box">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img5.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>professional ce <br> mng't. software</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadMobile">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img1.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>MOBILE <br> APP</span>
                                    </div>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#quadWebpage">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img6.png';?>">
                                    <div class="ice-components-boxinfo">
                                    <span>professional  <br>  WEBPAGE</span>
                                    </div>
                                </a>
                        </div>
                         
                        <ul style="text-align: left;">
                            <li>Set your Required CE Units or Contact Hours and calendar</li>
                            <li>Auto-recording of all your digital certificates from online courses and / or training of ceonpoint</li>
                            <li class="more1">Unlimited Upload of your paper Certificates </li>
                            <li class="more1">Automated Calculator of your OBTAINED CE Units/Contact hours against your REQUIRED Units and your NEEDED Units</li>
                            <li class="more1">Track anytime your CE Units/Contact Hours compliance status</li>
                            <li class="more1">Get pop-up notification of 100% completion</li>
                            <li class="more1">Reset your CE Units/Contact Hours & calender after completion     </li>

                            <li class="more1">Archive all your completion certificates</li>
                            <li class="more1">Unlimited storage of digital certificates & data</li>
                            <li class="more1">Unlimited Upload of cards & Lincenses</li>
                            <li class="more1">Auto-notification of expiration  & renewal</li>
                            <li class="more1">Backup you certificates, documents and data</li>
                            <li class="more1">Have your own professional page</li>
                            <li class="more1">Promote your professional Practise</li>
                            <li class="more1">Get Access to your Institutions' free Online Courses & Training (once your institution use ICE-MS of ceonpoint)</li>
                            <li class="more1">Electronic Reporting & Verification of Digital Certificate to your employer/institution using ICE-MS</li>
                            <li class="more1">Electronic reporting of certificate to regulatory board ( once your Regulatory Board uses RB-CEMS of ceonpoint)</li>
                            <li class="more1">Online application button for License Renewal linked to Regulatory Board (once your Regulatory Board uses RB-CEMS of ceonpoint) </li>
                        </ul>
                        <a class="read-more" onclick="readmore()" id="myBtn">Read more</a>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
                            
						</div>
					<?php  } ?>

                        </div>
                    </div>

                        <div class="col-sm-12 text-center">
                          <h4 class="bg-danger p-2 px-4" style="color: #fff; border-radius: 5px;">CREATE YOUR FREE ACCOUNT</h4>
                        </div>
                </div>
                <!-- <div class=""> <h3 class="mt-0">Institution:</h3> </div> -->
            <style> .more1{display:none}.read-more{border:1px solid #000;padding:6px 10px;border-radius:4px;margin-top:5px;display:inline-block;cursor:pointer} </style>
                <script type="text/javascript">

                function readmore(){
                    if ($(".more1").is(':hidden')) {
                        $(".more1").toggle('slow');
                        $(".read-more").html('Read less');
                      } else {
                        $(".more1").toggle('slow');
                        $(".read-more").html('Read more');
                         }
                }
                function selectrole(){
                    var role = $('#role').val(); 
                    if(role==1){
                        role = "professional";
                    }
                    if(role==2){
                        role = "provider";
                    }

                    if(role==4){
                        role = "advertisers";
                    }

                    if(role==6){
                        role = "authors";
                    }
                    
                    if(role==7){
                        role = "rboard";
                    }

                    var path = "<?php echo site_url('users/signup/'); ?>"+role;
                    window.location = path;
                }    
                </script>

                
				
				 
				<form action="<?php echo BASE_URL;?>users/signup<?php if($role=="advertisers"){ echo'advertisers'; }  ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" class="row">
                    <?php 
						echo $this->session->flashdata('response');
                   
                        if($role=="advertisers"){ 
                            
                            $this->load->view('users/forms/advertisers_form');
                        }if($role=="professional") {
                          
                            $this->load->view('users/forms/professional_form');
                        }if($role=="provider"){
                           
                            $this->load->view('users/forms/provider_form');
                        }if($role=="institution"){
                           
                            $this->load->view('users/forms/institution_form');
                        }if($role=="authors"){
                           
                            $this->load->view('users/forms/author_form');
                        }if($role=="rboard"){
                           
                            $this->load->view('users/forms/rboard_form');
                        }

                    ?>

                    <input type="hidden" name="address" id="address" value="">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Captcha</label>
                            <div class="img-responsive">
                                <?php echo $captcha_image; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="">Please enter captcha text</label>
                            <input type="text" name="captcha_text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <?php if($role != "authors"){ ?>
                        <div class="form-group">
                        	<!-- <p><i>If you need website for your institution we can do it for you. email us at welcometo.lighthousemedia3k.com or call what's up 1242-5659121)</i></p> -->
                            
                            <input required name="rememberme" class="mr-2" id="rememberme" value="forever" type="checkbox">&nbsp; By clicking Register, I agree to the &nbsp;&nbsp;
							<a href="javascript:void(0);" style="color: blue;" onclick="termconditionpopups('<?php echo $role; ?>');" >Terms, Privacy Policy and Copyright policy </a>
                            <span class="error"><?php echo  form_error('rememberme'); ?></span>
                        </div>
                        <?php } ?>
                        <div class="form-group clearfix">
                            <input class="btn btn-lg col-xs-12 btn-primary" value="Register" type="submit" name="save">
                        </div>

                        <div class="text-center"><a href="<?php echo site_url('users');?>">I already have an account.</a></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="dt-sc-ico-content mb-5">
                <div class="login-slider">
                    <div class="login-slider-ryt-content">
                        

                       
         <div class="blog-categories mt-0">  
        <a class="btn btn-primary" href="<?php echo base_url('users/signup/professional'); ?>" style="margin-bottom: 5px;">REGISTER AS PROFESIONAL</a>
        <a class="btn btn-success" href="<?php echo base_url('users/signup/provider'); ?>" style="margin-bottom: 5px;">REGISTER AS CE PROVIDER</a>
        <a class="btn btn-warning" href="<?php echo base_url('users/signup/institution'); ?>" style="margin-bottom: 5px;">REGISTER AS INSTITUTION</a>
        <a class="btn btn-info"    href="<?php echo base_url('users/signup/authors'); ?>" style="margin-bottom: 5px;">REGISTER AS AUTHOR</a>
        <a class="btn btn-danger"    href="<?php echo base_url('users/signup/rboard'); ?>" style="margin-bottom: 5px;">REGISTER AS RBOARD</a>
        </div>
                        
                        
                         


                		<!--<?php 
                		if($role=="institution"){
                		?>
                        <h3 class="mt-0">What You Offer To Instituitons?</h3>
                        <ul>
                            <li>Have Your own CE pages.</li>
                            <li>Unlimited Upload of Online Courses.</li>
                            <li>Unlimited Upload of training / symposium etc.</li>
                            <li>Online registration for Training symposium</li>
                            <li>Ready to training report for printing or submission.</li>
                            <li>tracking System of staff compliance to CE.</li>
                        </ul>
                        <?php 
                    	}
                        ?>

                        <?php 
                		if($role=="advertisers"){
                		?>
                        <h3 class="mt-0">What You Offer To Advertisers?</h3>
                        <ul>
                            <li>Have Your own CE pages.</li>
                            <li>Unlimited Upload of Online Courses.</li>
                            <li>Unlimited Upload of training / symposium etc.</li>
                            <li>Online registration for Training symposium</li>
                            <li>Ready to training report for printing or submission.</li>
                            <li>tracking System of staff compliance to CE.</li>
                        </ul>
                        <?php 
                    	}
                        ?> 

                        <?php 
                		if($role=="provider"){
                		?>
                        <h3 class="mt-0">What You Offer To Provider?</h3>
                        <ul>
                            <li>Have Your own CE pages.</li>
                            <li>Unlimited Upload of Online Courses.</li>
                            <li>Unlimited Upload of training / symposium etc.</li>
                            <li>Online registration for Training symposium</li>
                            <li>Ready to training report for printing or submission.</li>
                            <li>tracking System of staff compliance to CE.</li>
                        </ul>
                        <?php 
                    	}
                        ?>

                        <?php 
                		if($role=="professional"){
                		?>
                        <h3 class="mt-0">What You Offer To Professional?</h3>
                        <ul>
                            <li>Have Your own CE pages.</li>
                            <li>Unlimited Upload of Online Courses.</li>
                            <li>Unlimited Upload of training / symposium etc.</li>
                            <li>Online registration for Training symposium</li>
                            <li>Ready to training report for printing or submission.</li>
                            <li>tracking System of staff compliance to CE.</li>
                        </ul>
                        <?php 
                    	}
                        ?>-->


                        <div class="sidebar-box">
                            <h3 class="border-title text-left">Advertise</h3>
                            <div class="owl-carousel-111">
							 <?php 						
									 $topbanner = $this->advertiseads->getAdvertiserBanner('Register Side');					
									  if(count($topbanner))
									  {
										  foreach($topbanner as $banner)
										  {
											  $this->advertiseads->updateCount($banner['id']); 
											  ?>
											  <div class="item">
											 <a href="<?php if($banner['website_url']){ echo $banner['website_url'];}else{ echo "#";}?>">
												<img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image'];?>" alt="">
										   </a>
											   </div>
											  <?php
											  break;
										  }
									  }else
									  {
									?>
                                        <div class="item">
                                            <!-- <img src="<?php echo BASE_URL;?>/assets/images/blog15-420x295.jpg"> -->
                                            <img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg'; ?>" alt="">
                                        </div>
					  
										<?php
										
										}
										?>
                               
							</div>
                        </div>

                    </div>


                
                     <?php 
                    foreach ($adv as $key => $value) {
                    ?> 

                    <div class="item"><img src="<?php echo ASSETS_URL.'upload/'.$value['package_image'];?>"></div>
                    
                    <?php 
                    }
                    ?>

                    

                <!--<div class="item"><img src="<?php //echo BASE_URL;?>/assets/images/login-ads.jpg"></div>
                    <div class="item"><img src="<?php //echo BASE_URL;?>/assets/images/login-ads.jpg"></div>
                    <div class="item"><img src="<?php //echo BASE_URL;?>/assets/images/login-ads.jpg"></div>
                    <div class="item"><img src="<?php //echo BASE_URL;?>/assets/images/login-ads.jpg"></div>
                 -->
                </div>
            </div>
            <div class="login-ads dt-sc-ico-content">
                 <div class="login-slider">
				
				   <?php 
						
						 $topbanner = $this->advertiseads->getAdvertiserBanner('Register Side');					
						  if(count($topbanner))
						  {
							  foreach($topbanner as $banner)
							  {
								  $this->advertiseads->updateCount($banner['id']); 
								  ?>
								  <div class="item">
                                 
                                    <img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image'];?>" alt="">
                               
                                   </div>
								  <?php
								  break;
							  }
						  }else
						  {
						?>
                            <div class="item">
                                <!-- <img src="<?php echo BASE_URL;?>/assets/images/login-ads.jpg"> -->
                                <img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg'; ?>" alt="">
                            </div>
          
							<?php
							
							}
							?>
                    
                    
                </div>
            </div></br>
			      <div class="login-ads dt-sc-ico-content">
                 <div class="login-slider">
				
				   <?php 
						
						 $topbanner2 = $this->advertiseads->getAdvertiserBanner('Register Side');					
						  if(count($topbanner2))
						  {
							  foreach($topbanner2 as $banner2)
							  {
								  $this->advertiseads->updateCount($banner2['id']); 
								  ?>
								  <div class="item">
                                 
                                    <img src="<?php echo ASSETS_URL.'upload/'.$banner2['banner_image'];?>" alt="">
                               
                                   </div>
								  <?php
								  break;
							  }
						  }else
						  {
						?>
                            <div class="item">
                                <!-- <img src="<?php echo BASE_URL;?>/assets/images/login-ads.jpg"> -->
                                <img src="<?php echo ASSETS_URL.'images/advertise/new-788-x-365.jpg'; ?>" alt="">
                            </div>
          
							<?php
							
							}
							?>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!--- provider popup------------>

<?php   $cepBussiness = $this->db->get_where('tbl_terms_conditions',array('type'=>'cepBusiness','status'=>'1'))->row_array();  ?>
<div id="providersignup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$cepBussiness['title']; ?></h4>
            </div>
                <div class="modal-body"> 
				    <div class="term">
                        <?=$cepBussiness['discription']; ?>
				    </div>
                </div>
                <div class="modal-footer">
				
                </div>
        </div>
    </div>
</div>
<!--- ends------------>


<!--- institution popup------------>

<?php   $institution = $this->db->get_where('tbl_terms_conditions',array('type'=>'institution','status'=>'1'))->row_array();  ?>
<div id="institutionsignup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$institution['title']; ?></h4>
            </div>
                <div class="modal-body"> 
				    <div class="term">
                        <?=$institution['discription']; ?>
				    </div>
                </div>
                <div class="modal-footer">
				
                </div>
        </div>
    </div>
</div>
<!--- ends------------>



<!--- professional popup------------>
<?php   $professionals = $this->db->get_where('tbl_terms_conditions',array('type'=>'professional','status'=>'1'))->row_array();  ?>
<div id="professionalsignup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$professionals['title'];?></h4>
            </div>
                <div class="modal-body"> 
                    <div class="term"> 
                        <?=$professionals['discription'];?>
    				</div>
                </div>
                <div class="modal-footer">
				
                </div>
        </div>
    </div>
</div>
<!--- ends------------>
<!--- advertiser popup------------>
<?php   $advertisers = $this->db->get_where('tbl_terms_conditions',array('type'=>'advertiser','status'=>'1'))->row_array();  ?>
<div id="advertiserssignup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$advertisers['title'];?></h4>
            </div>
                <div class="modal-body"> 
				    <div class="term"> 
                        <?=$advertisers['discription'];?>
                    </div>
				</div>
                </div>
                <div class="modal-footer">
				
                </div>
        </div>
    </div>
</div>
<!--- ends------------>

<!--- author popup------------>
<!-- <?php   //$author = $this->db->get_where('tbl_terms_conditions',array('type'=>'authorBusiness','status'=>'1'))->row_array();  ?> -->
<?php $type = (isset($_REQUEST['type']) && $_REQUEST['type'] == 'authorCeonpoint')?'authorCeonpoint':'authorBusiness';  
    $author = $this->db->get_where('tbl_terms_conditions',array('type'=>$type,'status'=>'1'))->row_array();  ?>
<div id="authorsignup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$author['title'];?></h4>
            </div>
                <div class="modal-body"> 
                    <div class="term"> 
                        <?=$author['discription'];?>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                
                </div>
        </div>
    </div>
</div>
<!--- ends------------>

<!--- rboard popup------------>
<?php   $rboard = $this->db->get_where('tbl_terms_conditions',array('type'=>'rboard','status'=>'1'))->row_array();  ?>
<div id="rboardsignup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$author['title'];?></h4>
            </div>
                <div class="modal-body"> 
                    <div class="term"> 
                        <?=$author['discription'];?>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                
                </div>
        </div>
    </div>
</div>
<!--- ends------------>

<script type="text/javascript">
  function termconditionpopups(val)
  {
	  	if(val=="advertisers")
		{	
		    $('#advertiserssignup').modal('show');
		}		
		if(val=="professional")
		{
		    $('#professionalsignup').modal('show');
		}
		if(val=="provider")
		{
		    $('#providersignup').modal('show');
		}
		if(val=="institution")
		{
		    $('#institutionsignup').modal('show');
		}
		if(val=="authors")
        {
            // $('#authorsignup').modal('show'); // For tempraraily basis
        }
		if(val=="rboard")
        {
            $('#rboardsignup').modal('show'); // For tempraraily basis
        }
		
  }
</script>
 