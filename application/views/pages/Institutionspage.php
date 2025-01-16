<style> .chosen-single{padding: 10px 0px 28px 19px !important;}.input-box-select .form-control {width: 216px;}</style>
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>newchoosen/chosen.css">

<div class="banner">
    <div class="container">
        <div class="banner-left">           
    			<?php $this->db->order_by('countries_name','ASC');
          $country = $this->user->get_record_by_field_name_all_record('countries','countries_id',$param['country']); ?>
          <h1>Institutions</h1>
          <ul class="breadcrumb">  
            <li> <?php if(!empty($country)){ echo $country[0]['countries_name']; }else{ ?>International<?php } ?> </li>
          </ul>
        </div>
    </div>
</div>

<?php $this->load->view("pages/topheaderads")?>


<div class="innerContent">
  <div class="container">
    <div class="row displayflex">
      <div class="col-sm-8"><h3 class="border-title text-left">Latest Institutions</h3>
        
        <div class="search-date" style="display:block">			
     			<form id="Institutionspageform" class="searchform" action="<?php echo base_url('pages/Institutionspage'); ?>">
            <div class="input-box-select">
							<!-- <div class="selection-box "> -->
							<select name="institution" data-placeholder="Enter Institution Name"  class="form-control" id="institution">
								<option value="" selected="">Name of institution</option>
								<?php foreach ($institution as $institute) { ?>
								<option  <?php if($institute['name'] == $_REQUEST['institution']){ echo "selected"; } ?> value="<?php echo $institute['name']?>">
									<?php echo $institute['name'];?>
								</option>
								<?php } ?> 							 					
							</select>
							 <!-- </div> -->
						</div>  

            <div class="input-box-select">
              <select name="categor"  class="form-control" id="categor">
                <option value="" selected="">Select Category</option>
                <?php foreach ($category as $key =>$value) { ?>
                  <option  <?php if($value['cat_name']== $_REQUEST['categor']){ echo "selected"; } ?> value="<?php echo $value['id']?>"> <?php echo $value['cat_name'];?> </option>
                <?php } ?>                        
              </select>
            </div>   
						   
						<div class="input-box-select">
							 <!-- <div class="selection-box "> -->
							<select name="country" class="form-control" id="country">
								<option value="" >Country</option>
									<?php foreach ($countries as $country) { ?>
									<option  <?php if($country['countries_id']==$param['country']){ echo "selected"; } ?> value="<?php echo $country['countries_id']?>">
									<?php echo $country['countries_name'];?>
									</option>
									<?php } ?> 							
							</select>
							<!-- </div> -->
						</div> 			   
							
						<div class="input-box-select">
							<a href="javascript:void(0)" onclick="jQuery('#Institutionspageform').submit();" class="btn search"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
						</div>
					</form>
				</div> 

        <div class="row">
				  <?php foreach($institutions as $institution){ 
                $country_name = $this->db->get_where('countries',array('countries_id'=>$institution['country']))->row_array()['countries_name']; ?>
            <div class="bolghome col-md-4 col-xs-6">
              <div class="new-training-box">
                <a href="<?php echo site_url('web/'.$institution['insititution_id'].'');?>">
                  <div class="training-box_overlay"></div>
                  <div class="training-box-image">
                    <?php if($institution['backimage']==""){ $img = ASSETS_URL.'images/uploads/placeholder.jpg'; } else { $img = ASSETS_URL.'images/uploads/'.$institution['backimage']; } ?>
                    <img src="<?php echo $img; ?>" alt="<?php echo $institution['backimage']; ?>" style="width: 272px;height: 382px;" title="<?php echo $institution['backimage']; ?>">
                  </div>
                  <div class="training-box-caption">
                      <h5 class="training-box_title"><?php echo $institution['name']; ?></h5>
                      <div class="training-box_text"><?php echo $institution['street']; ?> <?php echo $institution['city']; ?>, <?php echo $institution['state']; ?></div>
                      <div class="training-box_text"><?php echo $country_name;?></div>
                  </div>
                </a>
              </div>
            </div> 
					<?php } ?> 
        </div>

            <?php //$this->load->view("pages/middilsectionads")?>
            <div class="elementor-widget-button text-center">
              <a href="<?php echo base_url('users/signup/institution'); ?>" class="bg-blue">create institution ce webpage </a>
              <a href="<?php echo base_url('pages/InstitutionCEPlatform'); ?>" class="bg-yellow">view  FEATURES OF institution </a>
            </div>
            
            <h3 class="border-title text-left">Demo Institutions</h3>
            <div class="row">
              <?php if(!empty($demoinstitutions) && $demoinstitutions != ""){
                   foreach($demoinstitutions as $dinstitution){ 
                    $country_name = $this->db->get_where('countries',array('countries_id'=>$dinstitution['country']))->row_array()['countries_name']; ?>
                <div class="bolghome col-md-4 col-xs-6">
                  <div class="new-training-box">
                    <a href="<?php echo site_url('web/'.$dinstitution['insititution_id'].'');?>">
                      <div class="training-box_overlay"></div>
                      <div class="training-box-image">
                        <?php if($dinstitution['backimage']==""){ $img = ASSETS_URL.'images/uploads/placeholder.jpg'; } else { $img = ASSETS_URL.'images/uploads/'.$dinstitution['backimage']; } ?>
                        <img src="<?php echo $img; ?>" alt="<?php echo $dinstitution['backimage']; ?>" style="width: 272px;height: 382px;" title="<?php echo $dinstitution['backimage']; ?>">
                      </div>
                      <div class="training-box-caption">
                          <h5 class="training-box_title"><?php echo $dinstitution['name']; ?></h5>
                          <div class="training-box_text"><?php echo $dinstitution['street']; ?> <?php echo $dinstitution['city']; ?>, <?php echo $dinstitution['state']; ?></div>
                          <div class="training-box_text"><?php echo $country_name;?></div>
                      </div>
                    </a>
                  </div>
                </div> 
              <?php } }else{ echo '<div class="text-center">No data found!</div>'; } ?> 
            </div>

          </div>
          <?php  $this->load->view('pages/sidebar'); ?>
      </div>

      <div class="training-semi-slider-6 pagi-above"> <?php $this->load->view("pages/bottomfooterads")?> </div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<!-- <script src="<?php echo ASSETS_URL.'js/jquery-3.2.1.min.js'?>"></script> -->
<!-- <script src="<?php echo ASSETS_URL.'js/chosen.jquery.js'?>"></script> -->

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

<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>  
<?php 
$name = $this->db->select('name')->where(array('role'=>5,'status'=>1,'parent_insititution >'=>0))->get('tbl_user')->result_array(); 
$names = array_column($name, 'name');

// echo ASSETS_URL; ?>
 <script>  
  $(function() { 
    $( "#institute_title" ).autocomplete({  
     source: <?php echo json_encode($names); ?>  
    });  
  });  
</script> 

  <script src="<?php echo ASSETS_URL.'newchoosen/chosen.jquery.js'; ?>" type="text/javascript"></script>
  <script >
 $(document).ready(function() {

var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : { allow_single_deselect: true },
  '.chosen-select-no-single' : { disable_search_threshold: 10 },
  '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
  '.chosen-select-rtl'       : { rtl: true },
  '.chosen-select-width'     : { width: '95%' }
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}
   
});
</script>
