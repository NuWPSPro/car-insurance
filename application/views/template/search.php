<?php  if($this->uri->segment(2) != "courselist" && $this->uri->segment(2) != "traininglist"){ ?>

<?php if($this->uri->segment(2) == "courses"){
        	$pagename = "Online Courses";
        } else if($this->uri->segment(2) == "training"){
        	$pagename = "CPD Training/Seminars";
        }  else if($this->uri->segment(2) == "prcexam"){
            $pagename = "PRC Exam Result";
        }  else if($this->uri->segment(2) == "guide"){
        $pagename = "CPD Guide";
        }  else {
            $pagename = "ONLINE CE COURSES";
        }

        if($this->uri->segment(1) == "job"){
        	$pagename = "job";
            $slug = $this->uri->segment(1);
        } else {
            $slug = $this->uri->segment(2);
        } ?>
 

<?php   $cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
        $pageInfo = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_pages','url',$slug);
        // echo'<pre>';print_r($pageInfo);
        $pagename = $pageInfo[0]['title'];
        //print_r($pageInfo); ?>

<?php foreach ($cat as $key => $value) { 
    if($value['id']==$this->uri->segment(3)){ $catname = $value['cat_name'];  } } ?>           

<!-- ( <?php echo $catname;?> ) -->

<div class="banner">
    <div class="container">
        <div class="banner-left">
                <h1><?php echo $pagename; ?></h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url();?>">Home</a></li>
                    <li>
                        <?php echo $pagename;?>
                    </li>
                </ul>
        </div>
        <?php if($this->uri->segment(2) !== "prcexam" && $this->uri->segment(2) !== "guide"){ ?>
        <div class="header-search">
            <form class="searchform">
                <div class="selection-box">
        
                    <?php 
                    if($this->uri->segment(2)=="training" || $this->uri->segment(2)=="training_details" || $this->uri->segment(2)=="training_category")
                    {
                    ?>
                    <select name="searchtype" class="form-control" id="dropDown" onchange="redirect1();">
                    <?php 
                    } else {
                    ?>
                    <select name="searchtype" class="form-control" id="dropDown" onchange="redirect();">
                    <?php     
                    }
                    ?>

                        <option value="" selected>Please Select</option>
                        <?php foreach ($cat as $key => $value) { ?>
			            <option <?php if($value['id']==$this->uri->segment(3)){ echo "selected"; } ?> value="<?php echo $value['id']?>">
			                <?php echo $value['cat_name'];?>
			            </option>
			            <?php } ?>           
			        </select>
                </div>
                <!-- <input class="text_input" placeholder="Search" type="text">
                <input type="submit" class="btn btn-primary"> -->


            </form>
        </div>
    <?php } ?>
    </div>
</div>

<?php 
}
?>



<script type="text/javascript">



function redirect(){
var path = "<?php echo site_url('pages/courses/');?>"; 
var dropDownValue = document.getElementById("dropDown").value;
window.location.href = path+dropDownValue;
}

function redirect1(){
var path = "<?php echo site_url('pages/training_category/');?>"; 
var dropDownValue = document.getElementById("dropDown").value;
window.location.href = path+dropDownValue;
}
 

</script>