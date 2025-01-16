    <div class="col-sm-12"><h4>1. PERSONAL INFORMATION </h4></div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Name <span class="required"> * </span> </label>
            <input required name="name" id="name" class="form-control" value="<?=isset($_REQUEST['name'])?$_REQUET['name']:''; ?>" size="20" type="text">

            <input type="hidden" size="20" name="role" id="role" value="6" >
            <input type="hidden" name="under_institution" value="1" >
            <input type="hidden" name="website" id="website" value="">    
            <input type="hidden" name="representative" id="representative" value="">
            <input type="hidden" name="designation" id="designation" value="">
            <input type="hidden" name="issuing_date" id="issuing_date" value="00/00/0000">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Nationality <span class="required"> * </span> </label>
            <div class="selection-box">
                <?php $this->db->order_by('countries_name','ASC');
                $country = $this->user->get_record_by_field_name_all_record('countries','status',1);  ?>
                    
                <select name="location" id="location" class="form-control">
                    <option value="">Select Country</option>
                    <?php foreach ($country as $key => $value): ?>
                    <option value="<?=$value['countries_id']; ?>"><?=$value['countries_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="error"><?= form_error('location'); ?></span>
            </div>
        </div>
    </div>
                  
    <div class="col-sm-6">
        <div class="form-group">
            <label>Country of Residence <span class="required"> * </span> </label>
            <div class="selection-box">
                <select required name="country_name" id="country_name" class="form-control">
                    <option value="">Select Country</option>
                    <?php foreach ($country as $key => $value):?>
                        <option value="<?=$value['countries_id']; ?>"><?=$value['countries_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="error"><?= form_error('country_name'); ?></span>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>State </label> 
            <input type="text" name="state" id="state" class="form-control" value="<?=set_value('state'); ?>"> 
                <span class="error"><?= form_error('state'); ?></span>
        </div>
    </div>


        <div class="col-sm-6">
        <div class="form-group">
            <label>City </label> 
            <input type="text" name="city" id="city" class="form-control" value="<?=set_value('city'); ?>"> 
                <span class="error"><?= form_error('city'); ?></span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Street </label> 
                    <input type="text" name="street" id="street" class="form-control" value="<?=set_value('street'); ?>">
                <span class="error"><?= form_error('street'); ?></span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Telephone No. <span class="required"> * </span> </label>
            <input required name="telno" class="form-control" value="<?=set_value('telno'); ?>" size="20" type="number">
            <span class="error"><?= form_error('telno'); ?></span>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group">
            <label>Skype Name  </label>
            <input name="skype" id="skype" class="form-control" value="<?=set_value('skype'); ?>" size="20" type="text">
        </div>
    </div>


    <div class="col-sm-6">
        <div class="form-group">
            <label>Email: <span class="required"> * </span> </label>
            <input required name="company_email" id="company_email" class="form-control" type="text" value="<?=set_value('company_email'); ?>">
        </div>
    </div>

    <div class="col-sm-6 form-group">
        <label>Upload Photo for Author's Page</label>
        <input type="file" class="btn btn-primary" name="background_photo">
        <span class="error"><?= form_error('background_photo'); ?></span>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="exampleInputFile">Upload Photo <span class="required"> * </span></label>
            <input type="file" id="exampleInputFile" class="btn btn-primary" name="image" required>
            <span class="error"><?= form_error('image'); ?></span>
        </div>
    </div>


    <div class="col-sm-12"><h4> 2. PROFESSIONAL INFORMATION </h4></div>

    <div class="col-sm-6">
        <div class="form-group">
            <label> Profession <span class="required"> * </span> </label>
            <div class="selection-box">
                <select name="profession" id="profession" class="form-control" required>
                    <option value="">Select</option>
                    <?php foreach($profession as $key => $value): 
                        $selected = ($_REQUEST['profession']==$value['cat_name'])?'selected':'';
                        echo '<option value="'.$value['cat_name'].'" "'.$selected.'">'.$value['cat_name'].'</option>';
                        endforeach; ?>
                </select>
                <span class="error"><?= form_error('profession'); ?></span>
            </div>
        </div>
    </div>


    <div class="col-sm-6">
        <div class="form-group">
            <label>Years of Practice <span class="required"> * </span> </label>
            <div class="selection-box">
                <select name="years_of_practice" class="form-control" required>
                    <option value="">--Select--</option>
                    <?php for($i=1;$i<=50;$i++): echo '<option value="'.$i.'">'.$i.'</option>'; endfor; ?>
                </select>
            </div>
            <span class="error"><?= form_error('years_of_practice'); ?></span>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group">
            <label>Specialization <span class="required"> * </span> </label>
            <input type="text" name="specialization" value="<?php echo isset($_REQUEST['specialization'])?$_REQUET['specialization']:''; ?>" class="form-control" required>
            <span class="error"><?= form_error('specialization'); ?></span>
        </div>
    </div>


    <div class="col-sm-6">
        <div class="form-group">
            <label>Licence Number <span class="required"> * </span> </label>
            <input name="licence_number" id="licence_number" class="form-control" value="<?php echo isset($_REQUEST['licence_number'])?$_REQUET['licence_number']:''; ?>" size="20" type="text" required>
            <span class="error"><?= form_error('licence_number'); ?></span>
        </div>
    </div>
    
    <div class="col-sm-6" >
        <div class="form-group">
            <label>Licence Validity <span class="required"> * </span></label>
            <div class="selection-box">
                <select name="exp_date" id="exp_date" class="form-control" onchange="showfield()" required>
                <option value="">Please Select</option>
                <option value="exp_date">Expiry Date</option>
                <option value="life_time">Life Time</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-6" id="formshow" style="display: none;">
        <div class="form-group">
            <label>License Validity Date <span class="required"> * </span> </label>
            <div class="selection-box">
                <input name="validity" id="validity" class="form-control" value="<?=set_value('validity'); ?>" size="20" type="date" required>
                <span class="error"><?= form_error('validity'); ?></span>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Issuing Institution <span class="required"> * </span> </label>
            <input required name="issuing_institute" id="issuing_institute" class="form-control" value="<?=set_value('issuing_institute'); ?>" size="20" type="text">
            <span class="error"></span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Issuing Country <span class="required"> * </span> </label>
            <div class="selection-box">
                <select required name="issuing_country" id="issuing_country" class="form-control">
                    <option value="">Select Country</option>    
                    <?php foreach ($country as $key => $value):?>
                    <option value="<?=$value['countries_name']; ?>"><?=$value['countries_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <!-- <div class="col-sm-12"><h4>3. EDUCATIONAL BACKGROUND </h4></div>

    <div class="col-sm-6 form-group">
        <label>Elementary <span class="required"> * </span> </label>
        <input type="text" name="edu_elementary" value="<?=set_value('edu_elementary'); ?>" class="form-control" required>

        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" name="edu_elementary_s" value="<?=set_value('edu_elementary_s'); ?>" class="form-control" placeholder="Starting year" maxlength="4" required>    
            </div>
            <div class="col-md-6">
                <input type="text" name="edu_elementary_e" value="<?=set_value('edu_elementary_e'); ?>" class="form-control" placeholder="Ending year" maxlength="4" required>    
            </div>
        </div>
    </div>

    <div class="col-sm-6 form-group">
        <label>High School <span class="required"> * </span> </label>
        <input type="text" name="edu_high_school" value="<?=set_value('edu_high_school'); ?>" class="form-control" required>
        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" name="edu_high_school_s" value="<?=set_value('edu_high_school_s'); ?>" class="form-control" placeholder="Starting year" maxlength="4" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="edu_high_school_e" value="<?=set_value('edu_high_school_e'); ?>" class="form-control" placeholder="Ending year" maxlength="4" required>
            </div>
        </div>
    </div>

    <div class="col-sm-6 form-group">
        <label>College <span class="required"> * </span></label>
        <input type="text" name="edu_college" value="<?=set_value('edu_college'); ?>" class="form-control" required>
        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" name="edu_college_s" value="<?=set_value('edu_college_s'); ?>" class="form-control" placeholder="Starting year" maxlength="4" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="edu_college_e" value="<?=set_value('edu_college_e'); ?>" class="form-control" placeholder="Ending year" maxlength="4" required>
            </div>
        </div>
    </div>
    <div class="col-sm-6 form-group">
        <label>Masteral</label>
        <input type="text" name="edu_masteral" value="<?=set_value('edu_masteral'); ?>" class="form-control" required>
        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" name="edu_masteral_s" value="<?=set_value('edu_masteral_s'); ?>" class="form-control" placeholder="Starting year" maxlength="4" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="edu_masteral_e" value="<?=set_value('edu_masteral_e'); ?>" class="form-control" placeholder="Ending year" maxlength="4" required>
            </div>
        </div>
    </div>
    <div class="col-sm-6 form-group">
        <label>Doctoral</label>
        <input type="text" name="edu_doctoral" value="<?=set_value('edu_doctoral'); ?>" class="form-control" required>
        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" name="edu_doctoral_s" value="<?=set_value('edu_doctoral_s'); ?>" class="form-control" placeholder="Starting year" maxlength="4" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="edu_doctoral_e" value="<?=set_value('edu_doctoral_e'); ?>" class="form-control" placeholder="Ending year" maxlength="4" required>
            </div>
        </div>
    </div>
    
    <div class="col-sm-12"><h4>4. PROFESSIONAL PRACTICE</h4></div>

    <div class="col-sm-6 form-group">
        <label>Title</label>
        <input type="text" name="practice_title[]" class="form-control">
        <div class="row mt-3">
            <div class="col-sm-6">
                <input type="text" name="practice_year_s[]" value="" class="form-control" placeholder="Strat year" maxlength="4">
            </div>
            <div class="col-sm-6">
                <input type="text" name="practice_year_e[]" value="" class="form-control" placeholder="Ending year" maxlength="4">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <label>Name of Institution</label>
        <input type="text" name="practice_highlights[]" class="form-control">
    </div>
    <div class="col-sm-6 mt-3">
        <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="employmentaddmore">Add more</a>
    </div>
    <div id="divimploymentrecord"> </div>
    
    <div class="col-sm-12"><h4>5. PROFESSIONAL ACHIEVEMENTS</h4></div>

    <div class="col-sm-6 form-group">
        <label>Title</label>
        <input type="text" name="citations_title[]" class="form-control">
        <div class="row mt-3">
            <div class="col-sm-6">
                <input type="text" name="cit_year_s[]" value="" class="form-control" placeholder="Strat year" maxlength="4">
            </div>
            <div class="col-sm-6">
                <input type="text" name="cit_year_e[]" value="" class="form-control" placeholder="Ending year" maxlength="4">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <label>Name of Institution</label>
        <input type="text" name="cit_highlights[]" class="form-control">
    </div>
    <div class="col-sm-6 mt-3">
        <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="awardsaddmore">Add more</a>
    </div>
    <div id="divAwardsRecord"> </div>
    
    <div class="col-sm-12"><h4>6. PROFESSIONAL AFFILIATION</h4></div>

    <div class="col-sm-6 form-group">
        <label>Title</label>
        <input type="text" name="aff_title[]" class="form-control">
        <div class="row mt-3">
            <div class="col-sm-6">
                <input type="text" name="aff_title_s[]" value="" class="form-control" placeholder="Strat year" maxlength="4">
            </div>
            <div class="col-sm-6">
                <input type="text" name="aff_title_e[]" value="" class="form-control" placeholder="Ending year" maxlength="4">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <label>Name of Institution</label>
        <input type="text" name="aff_highlights[]" class="form-control">
    </div>
    <div class="col-sm-6 mt-3">
        <a href="javascript:void(0)" class="btn btn-primary anchor-addmore" id="affaddmore">Add more</a>
    </div>
    <div id="divAffHighlightsRecord"> </div> <h4>3. CPD Provider/Training Department AFFILIATION</h4> -->


    <div class="col-sm-12"><h4>3. Car Insurance Company AFFILIATION</h4></div>
        <!-- <div class="col-sm-4">
            <div class="form-group">
                <label>Choose Category </label> 
                <select name="choose_category" id="chooseCategory" class="form-control">
                    <option value="">Choose Category</option>
                    <option value="cpd" <?php if($_REQUEST['category'] == "cpd"){ echo 'selected'; } ?>>Accredited CPD Provider</option>
                    <option value="tdept">Training Dipartment</option>
                </select> 
            </div>
        </div> -->

    <span  id="cpdsection" style="display: none;">
        <div class="col-sm-4">
            <div class="form-group">
            <label>Choose Country</label>  
                <select name="cpd_country" id="cpd_country" class="form-control">
                    <option value="">Select Country</option>
                    <?php foreach ($country as $key => $value): ?>
                    <option value="<?=$value['countries_id']; ?>" <?php if($_REQUEST['country'] == $value['countries_id']){ echo'selected'; }?> ><?=$value['countries_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <?php $country = ($_REQUEST['country']!='')?$_REQUEST['country']:''; 
                    $bussinessCpd = $this->user->getCpd($country,0); ?>
                <label>CPD Provider </label>  
                <select  name="provider" id="cpdaProvider" class="form-control">
                    <option value="">Please Select Provider</option>
                    <?php foreach ($bussinessCpd as $key => $value) { ?>
                        <option value="<?=$value['id']; ?>"  <?php if($_REQUEST['provider'] == $value['id']){ echo'selected'; }?> ><?=$value['name']; ?></option>
                    <?php } ?>
                </select> 
            </div>
        </div>
    </span>
  
    
    <span  id="tdeptsection" style="">
        <div class="col-sm-4" id="ins_code" style="">
            <?php $carcompanies = $this->user->getCarInsuranceCompany(); ?>
            <div class="form-group">
                <label>Car Insurance Company</label> 
                <select  name="institution" id="tdepartment" class="form-control">
                    <option value="">Please Select</option>
                    <?php foreach ($carcompanies as $key => $value) { ?>
                        <option value="<?=$value['id']; ?>" ><?=$value['name']; ?></option>
                    <?php } ?>
                </select> 
            </div>
        </div>

        <div class="col-sm-4" id="" style="">
            <div class="form-group">
            <label>Code</label>  
                <input type="text" class="form-control" name="institution_code" id="tdepartment_code"  placeholder="Please enter compnay code">
            </div>
        </div>

      
    </span>

    <div class="col-sm-12"><h4>4. ACCESS TO ACCOUNT</h4></div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Username (email)<span class="required"> * </span> </label>
            <input required name="username" id="username" class="form-control" value="" size="20" type="text">
            <span class="error"><?= form_error('username'); ?></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Password <span class="required"> * </span> </label>
            <input required name="password" id="password" class="form-control" value="" size="20" type="password">
            <span class="error"><?= form_error('password'); ?></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Confirm Password <span class="required"> * </span> </label>
            <input required name="con_password" id="con_password" class="form-control" value="" size="20" type="password">
            <span class="error"><?= form_error('con_password'); ?></span>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <input required name="rememberme" class="mr-2" id="rememberme" value="forever" type="checkbox">&nbsp; By clicking Register, I agree to the &nbsp;&nbsp;
            <a href="javascript:void(0);" style="color: blue;" id="authorTermAndCondition" data-value="ceon" >Terms, Privacy Policy and Copyright policy </a>
        </div>
    </div>
  
    <?php $author = $this->db->get_where('tbl_terms_conditions',array('type'=>'authorCeonpoint','status'=>'1'))->row_array();  ?>
    <div id="termconditionpopups" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="tanctitle">
                       
                    </h4>
                </div>
                <div class="modal-body"> 
                    <div class="term" id="tancdescription"> 
                  
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
        var counter = 2;
        $('#employmentaddmore').on('click', function() {
            $('#divimploymentrecord').append('<div class="col-sm-12" id="emplomentrow' + counter + '">\
            <div class="col-sm-6 form-group"><label>Title</label><input type="text" name="practice_title[]" class="form-control">\
        <div class="row mt-3"><div class="col-sm-6"><input type="text" name="practice_year_s[]" value="" class="form-control" placeholder="Strating year" maxlength="4"></div><div class="col-sm-6"><input type="text" name="practice_year_e[]" value="" class="form-control" placeholder="Ending year" maxlength="4"></div></div></div><div class="col-sm-6"><label>Name of Institution</label><input type="text" name="practice_highlights[]" class="form-control"></div>\
                <div class="col-sm-6 mt-3"><a href="javascript:void(0)" onclick="removerow(\'emplomentrow' + counter + '\')" data-id="' + counter + '" class="btn btn-danger dismiss" title="Remove"><i class="fa fa-close"></i></a></div></div>');
            counter++;
        });
        
        $('#awardsaddmore').on('click', function() {
            $('#divAwardsRecord').append('<div class="col-sm-12" id="affrow' + counter + '">\
            <div class="col-sm-6 form-group"><label>Title</label><input type="text" name="citations_title[]" class="form-control">\
        <div class="row mt-3"><div class="col-sm-6"><input type="text" name="cit_year_s[]" value="" class="form-control" placeholder="Strating year" maxlength="4"></div><div class="col-sm-6"><input type="text" name="cit_year_e[]" value="" class="form-control" placeholder="Ending year" maxlength="4"></div></div></div><div class="col-sm-6"><label>Name of Institution</label><input type="text" name="cit_highlights[]" class="form-control"></div>\
                <div class="col-sm-6 mt-3"><a href="javascript:void(0)" onclick="removerow(\'affrow' + counter + '\')" data-id="' + counter + '" class="btn btn-danger dismiss" title="Remove"><i class="fa fa-close"></i></a></div></div>');
            counter++;
        });
        
        $('#affaddmore').on('click', function() {
            $('#divAffHighlightsRecord').append('<div class="col-sm-12" id="affrow' + counter + '">\
            <div class="col-sm-6 form-group"><label>Title</label><input type="text" name="aff_title[]" class="form-control">\
        <div class="row mt-3"><div class="col-sm-6"><input type="text" name="aff_title_s[]" value="" class="form-control" placeholder="Strating year" maxlength="4"></div><div class="col-sm-6"><input type="text" name="aff_title_e[]" value="" class="form-control" placeholder="Ending year" maxlength="4"></div></div></div><div class="col-sm-6"><label>Name of Institution</label><input type="text" name="practice_highlights[]" class="form-control"></div>\
                <div class="col-sm-6 mt-3"><a href="javascript:void(0)" onclick="removerow(\'affrow' + counter + '\')" data-id="' + counter + '" class="btn btn-danger dismiss" title="Remove"><i class="fa fa-close"></i></a></div></div>');
            counter++;
        });
    });

    function removerow(romoveid) {
        $('#' + romoveid).remove();
    }

    function change_provider(){
        provider = $("#institution").val();
        if(provider == 'authorUnderCeonpoint'){
            $('#institution_code').val('007-author-under-ceonpoint');
            $('#ins_code').hide();
        }else{
            $('#institution_code').val('');
            $('#ins_code').show();
            p = provider.split("-");
            $.session.set("session_provider", p[1]);  
        }
    } 

    function showsection(){
        var under_institution = 1;
        if(under_institution==1){
            $('#ins').show();
            $('#ins_code').show();

            $("#institution").attr("required", "true");
            $("#institution_code").attr("required", "true");

        } else {
            $('#ins').hide();
            $('#ins_code').hide();
            $("#institution").attr("required", "false");
            $("#institution_code").attr("required", "false");
        }
    }

    showsection();

    function showfield(){
        var types = $('#exp_date').val();
        if(types=="life_time"){
            $('#validity').val('1001-01-01'); //it means life time
            $('#formshow').hide();
        } else {
            $('#validity').val('');
            $('#formshow').show();
        }
    }


    /* New Author form signup page */

    $(function(){
        var cpd  = $('#chooseCategory').find(':selected').val();
        if(cpd=='cpd'){
            chooseCategory();
        }
    });

    function chooseCategory(){
        var cat = $('#chooseCategory').val();
        if(cat=='cpd'){
            $('#cpdsection').show();
            $('#tdeptsection').hide();
        }
        if(cat=='tdept'){
            $('#tdeptsection').show();
            $('#cpdsection').hide();
        }
        if(cat==''){
            $('#tdeptsection').hide();
            $('#cpdsection').hide();
        }
    } 

    $( "#chooseCategory" ).change(function() {
        var cat = $('#chooseCategory').val();
        if(cat=='cpd'){
            $('#authorTermAndCondition').attr('data-value','cpd');
            $('#cpdsection').show();
            $('#tdeptsection').hide();
        }
        if(cat=='tdept'){
            $('#authorTermAndCondition').attr('data-value','tdept');
            $('#tdeptsection').show();
            $('#cpdsection').hide();
        }
        if(cat==''){
            $('#authorTermAndCondition').attr('data-value','ceon');
            $('#tdeptsection').hide();
            $('#cpdsection').hide();
        }
    });
    
    $( "#authorTermAndCondition" ).click(function() {
        var term = $(this).attr('data-value');
        var type ='';
        if(term = 'ceon'){ 
            type = 'authorCeonpoint';  
            $('#termconditionpopups').modal('show');
        }else if(term = 'cpd'){ 
            type = 'authorBusiness'; 
        }else if(term = 'tdept'){ 
            type = 'authorInstitution';
        }else{ 
            type = ''; 
        } 
        $.ajax({
            type: 'POST',
            url: "<?=base_url('admin/getTermCondition'); ?>",
            data: { tandc : tandc },
            dataType: 'json',
            success: function(result){
                console.log(result);
                // $('#tanctitle').html(data.title);
                // $('#tancdescription').html(data.description);
                $('#termconditionpopups').modal('show');
            }
        });
    });

    $( "#cpd_country" ).change(function() {
        var country = $(this).val();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('pages/ceplistbycountry'); ?>",
            data: { country : country },
        })
        .done(function( data ) {
            $('#cpdaProvider').html(data);
        });
    });
    
    $( "#tdepartment" ).change(function() {
        var cpdid = $(this).val();
        var uins  = $(this).find(':selected').attr('data-uinsid');
        // var cpdcode  = $(this).find(':selected').attr('data-code');
        // $('#tdepartment_code').val(cpdcode);
        // alert(uins);
    });
</script>