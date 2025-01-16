<?php 

$this->load->view('template/header_home');

?>
<div class="container">
        <div class="row my-5">
            <div class="col-sm-8">


                <div class="clearfix login-grid">
                    <div class="row signup-features">
                        <div class="col-md-3">
                            <div class="professionals-icons">

                                <img src="images/professional.png">
                                <span> PROFESSIONAL</span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="signup-bullet-points">

                                <h3 class="mb-2">WHAT WE OFFER TO PROFESSIONALS?</h3>
                                <div class="p-3 text-center bg-white rounded mb-4">
                                    <h4 class=""><strong>PCE PLATFORM</strong></h4>
                                    <h5><span class="text-danger">P</span>ROFESSIONAL <span
                                            class="text-danger">C</span>ONTINUING <span
                                            class="text-danger">E</span>DUCATION PLATFORM</h5>
                                    <p>"We focus on helping professionals to become ready for license renewal or job
                                        performance appraisal."</p>
                                    <a href="#" class="btn btn-primary">Learn More</a>
                                    <a href="javascript:void(0);" class="btn btn-info">Brief info</a>
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-12 text-center">
                            <h4 class="profession_headign bg-danger p-2 px-4" style="color: #fff; border-radius: 5px;">CREATE YOUR FREE
                                ACCOUNT</h4>
                        </div>
                    </div>
                    <form action="#" method="post" enctype="multipart/form-data" name="form1" id="form1" class="row">

                        <div class="col-sm-12">
                            <h4 class="profession_headign mb-2 bg-primary p-2 px-4">PROFESSIONAL REGISTRATION</h4>
                            <div class="form-group">
                                <label>Name <span class="required"> * </span></label>
                                <input name="name" id="name" class="form-control" value="" size="20" type="text"
                                    required>
                                <input type="hidden" name="redirect" class="form-control" value="">
                            </div>
                        </div>

                        <input type="hidden" name="role" value="1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Profession <span class="required"> * </span> </label>
                                <div class="selection-box">
                                    <select name="profession" id="profession" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Accountancy">
                                            Accountancy </option>
                                        <option value="Advanced Registered Nurse Practitioner (ARNP)">
                                            Advanced Registered Nurse Practitioner (ARNP) </option>
                                        <option value="Aeronautical Engineering">
                                            Aeronautical Engineering </option>
                                        <option value="Agricultural & Biosystems Engineering">
                                            Agricultural & Biosystems Engineering </option>
                                        <option value="Agriculture">
                                            Agriculture </option>
                                        <option value="Architecture   -70 yrs old & above">
                                            Architecture -70 yrs old & above </option>
                                    </select>
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nationality <span class="required"> * </span> </label>
                                <div class="selection-box">


                                    <select name="country_name" id="country_name" class="form-control" required>
                                        <option value="">Select Country</option>
                                        <option value="240">Aaland Islands</option>
                                        <option value="1">Afghanistan</option>
                                        <option value="2">Albania</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">American Samoa</option>
                                        <option value="5">Andorra</option>
                                        <option value="6">Angola</option>
                                        <option value="7">Anguilla</option>
                                        <option value="8">Antarctica</option>
                                        <option value="9">Antigua and Barbuda</option>
                                    </select>
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12">
                            <div class="form-group">
                                <!-- <label>Issuing Institution <span class="required"> * </span> </label> -->
                                <label>Name of Professional Regulatory Board/Council <span class="required"> *
                                    </span> </label>
                                <input name="issuing_institution" class="form-control" value="" size="20" type="text"
                                    required>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Issuing Country <span class="required"> * </span> </label>
                                <div class="selection-box">

                                    <select name="location" id="location" class="form-control" required>
                                        <option value="">Select Country</option>
                                        <option value="240">Aaland Islands</option>
                                        <option value="1">Afghanistan</option>
                                        <option value="2">Albania</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">American Samoa</option>
                                        <option value="5">Andorra</option>
                                        <option value="6">Angola</option>
                                        <option value="7">Anguilla</option>
                                        <option value="8">Antarctica</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Issuing State </label>
                                <div class="selection-box">
                                    <input type="text" name="state" id="state" class="
                             form-control">
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Photo</label>
                                <input type="file" id="exampleInputFile" class="btn btn-primary" name="photo">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Username (email)<span class="required"> * </span> </label>
                                <input name="username" id="username" class="form-control" value="" size="20" type="text"
                                    required>
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Password <span class="required"> * </span> </label>
                                <input name="password" id="password" class="form-control" value="" size="20"
                                    type="password" required>
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Confirm Password <span class="required"> * </span> </label>
                                <input name="con_password" id="con_password" class="form-control" value="" size="20"
                                    type="password" required>
                                <span class="error"></span>
                            </div>
                        </div>
                        <input type="hidden" name="address" id="address" value="address">



                        <div class="col-sm-12">
                            <div class="form-group">

                                <input required name="rememberme" class="mr-2" id="rememberme" value="forever"
                                    type="checkbox">&nbsp; By clicking Register, I agree to the &nbsp;&nbsp;
                                <a href="javascript:void(0);" style="color: blue;">Terms, Privacy Policy and Copyright policy </a>
                                <span class="error"></span>
                            </div>

                            <div class="form-group clearfix">
                                <input class="btn btn-lg col-xs-12 btn-primary register_btn" value="Register" type="submit"
                                    name="save">
                            </div>

                            <div class="text-center"><a href="https://ceonpoint.com/users">I already have an
                                    account.</a></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="dt-sc-ico-content mb-5">
                    <div class="login-slider">
                        <div class="login-slider-ryt-content">
                            <div class="blog-categories">
                                <a class="btn btn-primary" href="#" style="margin-bottom: 5px;">REGISTER AS
                                    PROFESIONAL</a>
                                <a class="btn btn-success" href="#" style="margin-bottom: 5px;">REGISTER AS CE
                                    PROVIDER</a>
                                <a class="btn btn-warning" href="#" style="margin-bottom: 5px;">REGISTER AS
                                    INSTITUTION</a>
                                <a class="btn btn-info" href="#" style="margin-bottom: 5px;">REGISTER AS AUTHOR</a>
                            </div>
                        </div>
                    </div>
                    <div class="login-ads dt-sc-ico-content">
                        <div class="login-slider">

                            <div class="item">
                                <!-- <img src="https://ceonpoint.com//assets/images/login-ads.jpg"> -->
                                <img src="images/new-788-x-365.jpg" alt="">
                            </div>



                        </div>
                    </div></br>
                    <div class="login-ads dt-sc-ico-content">
                        <div class="login-slider">

                            <div class="item">
                                <!-- <img src="https://ceonpoint.com//assets/images/login-ads.jpg"> -->
                                <img src="images/new-788-x-365.jpg" alt="">
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>