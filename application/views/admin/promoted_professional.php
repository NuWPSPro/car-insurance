<?php $this->load->view('admin/picture'); ?>

<div class="innerContent admin-promoted_professionalpanel">

	<div class="container">
    
		<div class="row">
		<?php 

		$this->load->view('admin/sidebar');

		?>	
		<div class="col-sm-9">
			<h3 class="border-title">Promoted Professional</h3> 

<div class="table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>

            <tr>

                <th>Name</th>

                <th>Profession</th>

                <th>Years of Practice</th>

                <th>Specialization</th>

                <th>Action</th>

            </tr>

        </thead>

        <tbody>

            <?php 

             foreach ($pp as $key => $value) {  

            ?> 

            <tr>

                <td><?php echo $value['name'];?></td> 

                <td><?php echo $value['profession'];?></td> 

                <td><?php echo $value['years_of_practice'];?></td> 

                <td><?php echo $value['specialization'];?></td>  

                <td><!-- <a target="_blank" href="<?php echo BASE_URL.'professional/detail/'.$value['pro_id'].'/'?>">View</a> -->

                    <a href="<?php echo BASE_URL.'professional/detail/'.$value['pro_id'].'/'?>" class="btn btn-info" title="Delete"><i class="fa fa-eye"></i></a>

                </td> 

            </tr>

            <?php } ?>

            

        </tbody>

    </table>
             </div>




	

			

		</div>

		</div>

	</div>

</div>











<script type="text/javascript">

$(document).ready(function() {

    $('#example').DataTable();

} );



</script>