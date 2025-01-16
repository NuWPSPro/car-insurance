<?php $this->load->view('template/picture'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
        <?php $this->load->view('professional/sidebar'); ?>

        <div class="col-sm-8">
        <form action="<?php echo BASE_URL;?>professional/cestaff" method="post" enctype="multipart/form-data">
	        <h3 class="border-title text-left">CE Staff</h3>
	        <?php echo $this->session->flashdata('response');?>

            <div class="row">
             	<p class="col-sm-12">
             		<label>Please Enter Staff Code</label>
             		<input type="text" name="staff_code" class="form-control" required>
             	</p>
                <p class="col-sm-12 submit alignleft">
                    <input class="btn btn-primary" value="Update" type="submit" name="save">
                </p>
            </div>
        </form>
        </div>

		</div>
    </div>
</div>

<script type="text/javascript">
    function blank(){
        $('#provider_code').val("");
    }

     function showsection(){
         var under_institution = $('#under_provider').val();
         if(under_institution == 'Yes'){
            $('#prov_name_list').show();
            $('#pro_code').show();
        } else {
            $('#prov_name_list').hide();
            $('#pro_code').hide();
        }
    }
    showsection();
</script>