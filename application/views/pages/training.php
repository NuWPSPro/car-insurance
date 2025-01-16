<?php
$cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category', 'id', $param['category_id']);

$this->db->order_by('countries_name','ASC');
$country = $this->user->get_record_by_field_name_all_record('countries', 'countries_id', $param['country']);
$category = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category', 'status', 1);

$this->db->order_by('countries_name','ASC');
$countries = $this->user->get_countries(); ?>
<style type="text/css">
    .input-box-select .form-control {
    width: 161px;
    }
    .input-box-select span {
        display: none;
    }
    #ui-id-1 {
            width: 200px;
    background-color: #fff;
    }
</style>
    <div class="banner">
        <div class="container">
            <div class="banner-left"> 
            <h1>Training/Seminars/Symposia</h1>
                <ul class="breadcrumb">
                    <li><a href="#">
                        <?php if (!empty($cat)){ echo $cat[0]['cat_name']; }else{ echo'All Professions'; } ?></a>
                    </li>

                <?php if (!empty($param['start_date'])){ ?>
                    <li><?php echo date('F Y', strtotime($param['start_date'])) ?></li>
                <?php } ?>

                    <li>
                        <?php if (!empty($country)){ echo $country[0]['countries_name']; }else{ echo 'International'; } ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
        
<?php $this->load->view("pages/topheaderads") ?>
  
<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="border-title text-left">
                    <?php 

                    if($flag == 0){
                            echo 'Latest Training/Seminars';
                        }else{ 
                            echo' Featured Training/Seminars'; 
                        } ?>
                </h3>

                <div class="search-date" style="display:block;">   
                    <form id="trainingform" class="searchform" action="<?php echo base_url('pages/training'); ?>">
                        <div class="input-box-select">
                            <input class="form-control" name="training_title" id="training_title" placeholder="ENTER TITLE" value="<?php echo $_REQUEST['training_title']; ?>">
                        </div>                        
                        <div class="input-box-select">  
                             <!-- <div class="selection-box "> -->
                                <select name="category" class="form-control" id="dropDown">
                                    <option value="" selected="">PROFESSION</option>
                                    <?php foreach ($category as $key => $value){ ?>
                                    <option <?php if ($value['id'] == $param['category_id']){
                                    echo "selected";
                                    } ?> value="<?php echo $value['id'] ?>">
                                    <?php echo $value['cat_name']; ?></option><?php } ?> 
                               </select>
                             <!-- </div> -->
                        </div>   

                        <div class="input-box-select"> 
                          <!-- <div class="text-box "> -->
                             <input type="month"  name="start_date" class="form-control" id="start_date" value="<?php echo $param['start_date']; ?>" placeholder="START DATE " autocomplete="off" >
                          <!-- </div> -->
                       </div>
                       
                        <div class="input-box-select">
                            <!-- <div class="selection-box "> -->
                                <select name="country" class="form-control" id="country">
                                <option value="" >COUNTRY</option>
                                    <?php foreach ($countries as $country){ ?>
                                    <option <?php if ($country['countries_id'] == $param['country_id']){
                                        echo "selected"; } ?> value="<?php echo $country['countries_id'] ?>">
                                        <?php echo $country['countries_name']; ?>
                                    </option>
                                    <?php } ?>                            
                                </select>
                             <!-- </div> -->
                        </div> 

                    <div class="input-box-select">
                      <a href="javascript:void(0)" onclick="jQuery('#trainingform').submit();" class="btn search"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
                    </div>
                </form>
       
                </div>
    <div class="row training-list">
    <?php if ($flag == 0){ ?>
      <?php   
      if (count($seminar))
            { 
            foreach ($seminar as $key => $value) { ?>
        <?php  if($value['thumb_img'] != ""){ $images =  $value['thumb_img']; }else{ $images = 'no-image.png'; } ?>
        <?php  $ceprovider = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['name'];
        $numOfparticipants = explode(",", $value['participants']);
        $participants = $this->db->where_in('id',$numOfparticipants)->get('tbl_category')->result_array();
            foreach($participants as $key => $participant){
                $nameOfParticipants[] = $participants[$key]['cat_name'];
            }
        if(count($numOfparticipants) > 0){
            $string_version = implode(", ",(array)$nameOfParticipants);
            $Profession = $string_version;
        } ?>

            <div class="item col-md-4">
                <div class="course-item">
                    <div class="course-double">
                    <?php if ($value['paid_status'] == 2){ ?> <!-- Red corner on Training list -->
                            <div class="corner"></div>
                            <span class="corner-text">Featured</span>
                    <?php } ?>
                <a <?php if($value['training_type']==1){ echo 'target="_blank"';} ?> 
                    class="training-image" 
                    href="<?php echo site_url('/pages/training_details/').$value['id']; ?>">
                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$images; ?>" 
                    alt="<?php echo $images; ?>">
                </a>
                            <div class="dt-sc-course-details">
                                <!-- <div class="course-price">$50</div> -->
                <h5><a <?php if($value['training_type']==1){ ?> 
                    target="_blank" <?php } ?> 
                    href="<?php echo site_url('/pages/training_details/'.$value['id']); ?>">
                    <?php echo $value['title']; ?></a>
                </h5>
                                <div class="clear-line"></div>
                                    <ul class="course-meta">
                                        <li><i class="fa fa-calendar"></i>
                                            <?php echo $value['start_date']; ?> @ <?php echo $value['start_time']; ?>
                                        </li>
                                    </ul>
                                    <ul class="course-meta pb-10">
                                        <li><i class="fa fa-map-marker"></i>
                                            <?php echo $value['location']; ?>
                                        </li>
                                    </ul>
                                <!--  <p><?php echo strip_tags(substr($value['description'], 0, 50)); ?></p> -->
                                <p title="<?php echo $Profession; ?>">Professions : <?php echo substr($Profession,0,10); ?></p>
                                <p title="<?php echo $ceprovider; ?>">CEprovider : <?php echo $ceprovider; ?></p>
                                <p>CE Unit : <?php echo $value['units']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
    <?php   }      }else { echo'<p><center>No record found.</center></p>'; } ?>
    <?php } ?>
    <?php if ($flag == 1){ ?>
    <?php   
      if (count($seminar))
            { 
            foreach ($seminar as $key => $value){
                if($value['paid_status']==2){ ?>
        <?php  if($value['thumb_img'] != ""){ $images =  $value['thumb_img']; }else{ $images = 'no-image.png'; } ?>
        <?php  $ceprovider = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['name'];
                $numOfparticipants = explode(",", $value['participants']);
        $participants = $this->db->where_in('id',$numOfparticipants)->get('tbl_category')->result_array();
            foreach($participants as $key => $participant){
                $nameOfParticipants[] = $participants[$key]['cat_name'];
            }
        if(count($numOfparticipants) > 0){
            $string_version = implode(", ",(array)$nameOfParticipants);
            $Profession = $string_version;
        } ?>

            <div class="item col-md-4">
                <div class="course-item">
                    <div class="course-double">
                    <?php if ($value['paid_status'] == 2){ ?> <!-- Red corner on Training list -->
                            <div class="corner"></div>
                            <span class="corner-text">Featured</span>
                    <?php } ?>
                <a <?php if($value['training_type']==1){ echo 'target="_blank"';} ?> 
                    class="training-image" 
                    href="<?php echo site_url('/pages/training_details/').$value['id']; ?>">
                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$images; ?>" 
                    alt="<?php echo $images; ?>">
                </a>
                            <div class="dt-sc-course-details">
                                <!-- <div class="course-price">$50</div> -->
                <h5><a <?php if($value['training_type']==1){ ?> 
                    target="_blank" <?php } ?> 
                    href="<?php echo site_url('/pages/training_details/'.$value['id']); ?>">
                    <?php echo $value['title']; ?></a>
                </h5>
                                <div class="clear-line"></div>
                                    <ul class="course-meta">
                                        <li><i class="fa fa-calendar"></i>
                                            <?php echo $value['start_date']; ?> @ <?php echo $value['start_time']; ?>
                                        </li>
                                    </ul>
                                    <ul class="course-meta pb-10">
                                        <li><i class="fa fa-map-marker"></i>
                                            <?php echo $value['location']; ?>
                                        </li>
                                    </ul>
                                <p title="<?php echo $Profession; ?>">Professions : <?php echo substr($Profession,0,10); ?></p>
                                <p title="<?php echo $ceprovider; ?>">CEprovider : <?php echo $ceprovider; ?></p>
                                <p>CE Unit : <?php echo $value['units']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
    <?php   } }     }else { echo'<p><center>No record found.</center></p>'; }  ?>
     
    <?php } ?>                            
    </div>
    <?php $this->load->view("pages/middilsectionads") ?>

    <?php if ($flag == 1){ ?>
    <hr>
        <div class="row">
            <div class="col-md-12">
                <h3 class="border-title text-left">Regular Listing</h3>
    <?php if (count($free_seminar)){

                foreach ($free_seminar as $key => $value){ 
                    if($value['paid_status']==1){ ?> 
        <?php  if($value['image'] != ""){ $images =  $value['image']; }else{ $images = 'no-image.png'; } ?>
        <?php  $ceprovider = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['name'];
                $numOfparticipants = explode(",", $value['participants']);
        $participants = $this->db->where_in('id',$numOfparticipants)->get('tbl_category')->result_array();
            foreach($participants as $key => $participant){
                $nameOfParticipants[] = $participants[$key]['cat_name'];
            }
        if(count($numOfparticipants) > 0){
            $string_version = implode(", ",(array)$nameOfParticipants);
            $Profession = $string_version;
        } ?>

            <div class="item col-xs-12 col-md-4">
                <div class="course-item">
                    <div class="course-double">
                <a <?php if($value['training_type']==1){ echo 'target="_blank"';} ?> 
                    class="training-image" 
                    href="<?php echo site_url('/pages/training_details/').$value['id']; ?>">
                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$images; ?>" 
                    alt="<?php echo $images; ?>" height="235">
                </a>
                <div class="dt-sc-course-details">
                            <!-- <div class="course-price">$50</div> -->
                <h5><a target="_blank" href="<?php echo site_url('/pages/training_details/').$value['id']; ?>"><?php echo $value['title']; ?></a>
                </h5>
                    <div class="clear-line"></div>
                        
                    <div class="conyain">
                        <ul class="course-meta">
                            <li><i class="fa fa-calendar"></i>
                                <?php echo $value['start_date']; ?> @ <?php echo $value['start_time']; ?>
                            </li>
                        </ul>
                        <ul class="course-meta pb-10">
                            <li><i class="fa fa-map-marker"></i>
                                <?php echo $value['location']; ?>
                            </li>
                        </ul>
                        <p title="<?php echo $Profession; ?>">Professions: <?php echo substr($Profession,0,10); ?></p>
                        <p title="<?php echo $ceprovider; ?>">CEprovider : <?php echo $ceprovider; ?></p>
                        <p>CE Unit : <?php echo $value['units']; ?></p>
                    </div>
                   
                </div>
                    </div>
                </div>
            </div>
<?php   } }   }else { echo'<p><center>No record found.</center></p>'; } ?>
                
            </div>
        </div>
    <?php  } ?>
    </div> <!--closing of col md 9-->
    
    <?php $this->load->view('pages/sidebar'); ?>
                

    </div> <!--closing main row -->
        <div class="training-semi-slider-6 pagi-above">
            <?php $this->load->view("pages/bottomfooterads") ?>
        </div>
    </div>
</div>

<?php 
$this->db->select('title')->where(array('insititution_id'=>'0','status'=>'1'));
$name = $this->db->get('tbl_training')->result_array(); 
$names = array_column($name, 'title'); ?>

<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>   
<script type="text/javascript">
    function searchdata() {
        var calendar = $('#calendar').val();
        var path = "<?php echo site_url('pages/training/'); ?>";
        window.location = path + calendar;
    }

    $(function() { 
        $( "#training_title" ).autocomplete({  
         source: <?php echo json_encode($names); ?>  
        });  
    });  
</script> 
