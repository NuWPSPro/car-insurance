<?php $this->load->view('template/search'); ?>

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


<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <center>
                                        
                    <a href="javascript:void(0);"><i style="font-size: 34px;width: 51px;" class="fa fa-calendar"></i><input type="date" name="calendar" data-date="" data-date-format="YYYY-MM-DD" value="<?php echo date('Y-m-d');?>" id="calendar"></a>    
                    <input type="button" name="search" value="SEARCH" onclick="searchdata()">    <br><br>  
                
                </center>

         <?php 
	 	 foreach ($seminar as $key => $value) {
	    	//echo '<pre>';	print_r($value); die;
	 	?>
                <div class="traning-seminar-wrap">
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="<?php echo site_url()?>/pages/training_details/<?php echo $value['id']?>"><img src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $value['image'];?>" alt=""></a>
                        </div>
                        <div class="col-sm-8">
                            <div class="splms-event-details">
                                <h3><a href="<?php echo site_url()?>/pages/training_details/<?php echo $value['id']?>"><?php echo $value['title'];?></a></h3>
                                <ul class="event-info-list">
                                    <li><i class="fa fa-calendar"></i>
                                        <?php echo $value['start_date'];?> @
                                        <?php echo $value['start_time'];?>
                                    </li>
                                    <li><i class="fa fa-map-marker"></i>
                                        <?php echo $value['location'];?>
                                    </li>
                                </ul>
                                <p>
                                    <?php echo substr($value['description'],0,150);?>...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- <ul class="pagination pagination-lg">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">Last</a></li>
                </ul> -->
            </div>
            <?php 
            $this->load->view('pages/sidebar');
            ?>
          <!--   <div class="col-sm-3">
                <div class="sidebar-box">
                    <h3 class="border-title text-left">Training Categories</h3>
                    <ul class="product-categories training-category">
                        <li><a href="#">Accountancy <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Aeronautical Engineering <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Agriculture <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Agriculture &amp; Biosystems Eng. <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Architecture <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Chemical Engineering <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Chemical Laboratory Technician <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Chemist <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Civil Engineering <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Criminology <span class="pull-right">(3)</span></a></li>
                        <li><a href="#">Customs Borkers <span class="pull-right">(3)</span></a></li>
                    </ul>
                </div>
            </div> -->


        </div>
    </div>
</div>



<script type="text/javascript">
    function searchdata(){
        var calendar = $('#calendar').val();
        var path = "<?php echo site_url('pages/training/');?>";
        window.location=path+calendar;
    }
</script>


<style type="text/css">
    input {
    position: relative;
    width: 150px; height: 32px;
    color: black;
}

input:before {
    position: absolute;
    top: 3px; left: 3px;
    content: attr(data-date);
    display: inline-block;
    color: black;
}

input::-webkit-datetime-edit, input::-webkit-inner-spin-button, input::-webkit-clear-button {
    display: none;
}

input::-webkit-calendar-picker-indicator {
    position: absolute;
    top: 3px;
    right: 0;
    color: black;
    opacity: 1;
}
</style>
