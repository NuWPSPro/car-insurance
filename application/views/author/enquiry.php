<?php $this->load->view('template/picture_author'); ?>
<div class="innerContent">
	<div class="container author-enquiry">
		<div class="row">
		<?php $this->load->view('author/sidebar'); ?>	
		<form action="<?php echo site_url();?>/author/enquiry" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
    <?php  $this->load->view('shared/enquiry');  ?> 
    </form>

   </div>
	</div>
  </div>
</div>




<a href="#" id="scroll" style="display: block;"><span></span></a>
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