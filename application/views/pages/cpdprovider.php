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
            <div class="col-sm-12">

                <div id="products" class="row view-group">

                    <?php   
                    foreach ($provider_promote as $key => $value) {
                        ?>    
                        <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="thumbnail card">
                                <div class="img-event">
                                 <a href="<?php echo site_url('users/profile/'.$value['id'].'');?>" class="course-image"><img src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $value['image'];?>" alt=""></a>
                             </div>
                             <div class="caption card-body">
                                <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['title'];?></a></h5>

                            </div>
                        </div>
                    </div>

                    <?php } ?> 

                </div>    


            </div>
            

        </div>
    </div>
</div>



