<style type="text/css">
.input-box-select .form-control {
    width: 215px;
}
.input-box-select span {
    display: none;
}
#ui-id-1 {
    width: 200px;
    background-color: #fff;
}
</style>

<?php   $category = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','id',$param['category']);
        $this->db->order_by('countries_name','ASC');
        $country = $this->user->get_record_by_field_name_all_record('countries','countries_id',$param['country_id']);
        // print_r($country); ?>

    <div class="banner">
        <div class="container">
            <div class="banner-left">           
               <h1>Professionals</h1>
                <ul class="breadcrumb">
                    <li><a href="javascript:void(0);"><?php if(!empty($category)){ echo $category[0]['cat_name']; }else{ ?>All Professions <?php } ?></a></li>
    				<li><?php if(!empty($country)){ echo $country[0]['countries_name']; }else{ ?>International<?php } ?></li>
                </ul>
            </div>
        </div>
    </div>

    <?php $this->load->view("pages/topheaderads");?>


<div class="innerContent">
    <div class="container">
        <div class="row displayflex">
            <div class="col-sm-8">
                <h3 class="border-title text-left">Latest Professionals</h3>
                <div class="search-date" style="display:block">
        	        <form id="professionalsform" class="searchform" action="<?php echo base_url('pages/latestprofessional');?>">
        				<div class="input-box-select">
                            <input type="text" name="professional_title" id="professional_title" class="form-control" placeholder="ENTER NAME" value="<?php echo $_REQUEST['professional_title']; ?>">
                        </div>
                        <div class="input-box-select">
                            <select name="category" class="form-control" id="dropDown">
                                <option value="" selected="">PROFESSION</option>
                                <?php foreach ($cat as $key => $value) { ?>
                                <option <?php if($value['id']==$param['category']){ echo "selected"; } ?> value="<?php echo $value['id']?>"><?php echo $value['cat_name'];?></option>
                                <?php } ?>
                            </select>
                        </div>   

        				<div class="input-box-select">
        					<select name="country" class="form-control" id="dropDown">
        						<option value="" >COUNTRY</option>
        						<?php foreach ($countries as $country) { ?>
        						<option  <?php if($country['countries_id']==$param['country']){ echo "selected"; } ?> value="<?php echo $country['countries_id']?>"><?php echo $country['countries_name'];?></option>
        						<?php } ?> 							
        					</select>
        				</div> 
        				<div class="input-box-select">
        					<a href="javascript:void(0)" onclick="jQuery('#professionalsform').submit();" class="btn search"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
        				</div>
        			</form>
				</div> 

                <div class="row">
				<?php if($professional){
                    // print_r($professional);
					foreach($professional as $latpro){	
                    $profileimg = $this->db->get_where('tbl_user',array('id'=>$latpro['user_id']))->row_array()['image']; 
                    if($profileimg==""){ $img = "placeholder.jpg"; } else { $img = $profileimg; } ?>
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
                        <?php   // $user_table = $this->db->get_where('tbl_user',array('id'=>$latpro['user_id']))->row_array(); 
                            if(date('Y-m-d') >=$latpro['featured_from'] and date('Y-m-d')<=$latpro['featured_to']){ ?>
                                <div class="corner"></div>
                                <span class="corner-text">featured</span>
                        <?php } ?> 
                            <a href="<?php echo site_url('share/viewprofile/').$latpro['user_id']; ?>">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image latest-proff">
                                    <img style="max-height: 382px;" src="<?php echo ASSETS_URL.'images/uploads/'.$img; ?>" alt="profile-img">
                                </div>
                                    <div class="training-box-caption">
                                        <h5 class="training-box_title"><?php echo $latpro['name']; ?></h5>
                                        <div class="training-box_text">
                                            <p class="author">Years of practice : <?php echo $latpro['years_of_practice']; ?> years
                                            <!-- <br> Country of Practice : N/A -->
                                            <br> Specialization : <?php echo $latpro['specialization']; ?>
                                            <?php if(!empty($latpro['edu_masteral'])){ ?>

                                            <br> Higher Educ : <?php echo $latpro['edu_masteral']; ?>
                                            <?php } ?>
                                            <?php if(!empty($latpro['edu_doctoral'])){ ?>
                                            <br> Doctoral : <?php echo $latpro['edu_doctoral']; ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                            </a>
                        </div>
                    </div>
				<?php } }else{ echo 'No Record Found!'; } ?>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="text-center">
    			            <a href="<?php echo base_url()?>users/signup/professional" class="btn btn-primary mr-3 text-uppercase">Get your free professional account</a>
    			            <a href="<?php echo base_url()?>pages/ceprovider" class="btn btn-success text-uppercase">View professional CE Platform</a>
    			        </div>
                    </div>
                </div>
                
                <?php // $this->load->view("pages/middilsectionads")?>
            </div>

            <?php  $this->load->view('pages/sidebar'); ?>
        </div>
                
        <div class="training-semi-slider-6 pagi-above">
            <?php $this->load->view("pages/bottomfooterads")?>
        </div>
    </div>
</div>


<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<?php 
$this->db->select('name')->where(array('user_type'=>'1','status'=>'1'));
$name = $this->db->get('tbl_professionals')->result_array(); 
$names = array_column($name, 'name');
// echo json_encode($names); ?>
<script>  
    $(function() { 
        $( "#professional_title" ).autocomplete({  
         source: <?php echo json_encode($names); ?>  
        });  
    });  

    $( document ).ready(function() {
        $("input").on("change", function(){
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
                )
        }).trigger("change")
    });
</script>





