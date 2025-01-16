<?php $this->load->view('template/picture_provider'); ?>
<div class="innerContent">
	<div class="container">
		<div class="row">
<!-- <div class="col-sm-12">
            <h3 class="border-title text-left">Dashboard</h3>
          </div> -->
		<?php $this->load->view('provider/sidebar'); ?>	
		<form action="<?php echo site_url();?>/provider/enquiry" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
    <?php  $this->load->view('shared/enquiry');  ?> 
    </form>	

   </div>
	</div>
  </div>
</div>





<script type="text/javascript">
	
	$(document).ready(function() {
    $("body").on("click",".add-more",function(){ 
        var html = $(".after-add-more").first().clone();
      
        //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
      
          $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
      
      
        $(".after-add-more").last().after(html);
      
     
       
    });

    $("body").on("click",".remove",function(){ 
        $(this).parents(".after-add-more").remove();
    });
});

</script>