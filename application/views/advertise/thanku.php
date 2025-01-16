<?php $this->load->view('advertise/advertise_head'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
        <div class="col-sm-12">
            <h3 class="border-title text-left">Thank you  </h3>
        </div>
        <?php  $this->load->view('advertise/sidebar');  ?>
            <div class="col-sm-8">			
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="ce-provider">
                            <div class="ce-provider-head">
                                <div class="ce-provider-head-box thank-img">
                                    <!-- <h3>Thank You</h3> -->
                                    <img src="<?php echo ASSETS_URL.'/images/thank.png';?>" width="200">
                                </div>                                   
                            </div>
                            <div class="ce-provider-box2">
                               
                                <div id="step1" class="tab-pane fade in active thank-text">
                               
                                <h3>Thank you for purchase!</h3>

                                <p>You Successfully Purchased one advartisment</p>
                                <button class="btn btn-primary"><a href="<?php echo BASE_URL.'advertise/advertise'; ?>">Click here to Continue</a></button>
                               
                                </div>                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   


<style>
    .thank-text, .ce-provider-head-box.thank-img {
        width: 100%;
        text-align: center;
    }
    .thank-text {
        padding-bottom: 20px;
    }
    .thank-text .btn a {
        color: #fff;
    }
</style>







