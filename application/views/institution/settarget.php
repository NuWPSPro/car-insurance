<?php $this->load->view('institution/picture'); ?>
<?php //print_r($this->session->userdata('logged_in')); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <?php $this->load->view('institution/sidebar'); ?>
            
            <div class="col-sm-9">
                <h3 class="border-title text-left">SUMMARY OF SET TARGET Vs. ACCOMPLISHMENT</h3>
                <h6 class="text-danger"><b>
                   SET TRAINING PERIOD : <?php if(!empty($training_date)){ 

                    $yrdata= strtotime($training_date->start_date);
                    $strtdate =  date('M d, Y', $yrdata);

                    $yrdata1= strtotime($training_date->end_date);
                    $enddate =  date('M d, Y', $yrdata1);
                        echo $strtdate.'-'.$enddate; 
                        if($fulldetails['details']->under_insititution==0){ 
                        echo '<button data-value="'.$training_date->start_date.'" data-name="'.$training_date->end_date.'" id="settrainingperiode" data-id="'.$training_date->id.'"  class="btn btn-primary pull-right">EDIT TRAINING PERIOD</button>';
                        }
                    }else{ 
                        echo 'Yet to set'; 
                        if($fulldetails['details']->under_insititution==0){ 
                        echo '<a onclick="setmaintarget()" class="btn btn-primary pull-right">SET TRAINING PERIOD</a>'; 
                        }
                    } ?></b></h6>
               
                <form action="<?=base_url('institution/settarget');?>" method="get">
				<div class="row pt-1">
                    <?php if($this->session->userdata('logged_in')['under_insititution']=='0'){ ?>
                    <div class="form-group col-md-3">
                        <select name="institution" class="form-control">
                            <option value="">Sub Institution:</option>
                            <?php foreach($insititutions as $inti){
                                if($inti['insititution_id']=='')
                                { continue; } ?>
                               <option value="<?php echo $inti['insititution_id']; ?>" <?php if($_GET['institution']==$inti['insititution_id']){echo'selected';} ?> ><?php echo $inti['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php }else{ ?>
                    <div class="form-group col-md-3">
                        <select name="ceprovider" class="form-control">
                            <option value="" >CE Provider:</option>
                            <?php foreach($ceplist as $cp){ ?>
                                <option value="<?php echo $cp['id']; ?>" <?php if($_GET['ceprovider']==$cp['id']){echo'selected';} ?> ><?php echo $cp['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?>
                    <div class="form-group col-md-3">
						<select name="authorpresenter" class="form-control">
							<option value="" >Author / Presenter</option>
							   <option value="a" <?php if($_GET['authorpresenter']=='a'){ echo 'selected'; } ?> >Author</option>
							   <option value="P" <?php if($_GET['authorpresenter']=='p'){ echo 'selected'; } ?> >Presenter</option>
						</select>
					</div>
                
					<div class="form-group col-md-3">
							<input type="Month" name="monthdate" class="form-control" value="<?php echo set_value('monthdate')?>">
					</div>
					<div class="form-group col-md-3">
						
						<input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">
					</div>
				</div>
				</form>
									
                <?php echo $this->session->flashdata('response'); ?>
                    <?php  $userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid);
                    $where1 = array('parent_insititution'=>$userdetails[0]['id'],'role'=>2);
                    $userdetails1 = $this->user->get_record_by_multi_field_name('tbl_user',$where1);
                    ?>
                    <div class="tab-content steps-detail mt-5">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                <thead class="set-target">

                                    <tr>
                                        <th rowspan="2" >No.</th>
                                        <th rowspan="2">Name Of Courses</th>
                                        <th rowspan="2">Category</th>
                                        <th rowspan="2">Date of implementation</th>
                                        <th rowspan="2">CE Provider</th>
                                        <th rowspan="2">Author / Presenter</th>
                                        <th rowspan="2">Total Staff to be Trained</th>

                                        <th colspan="2">Targets</th>
                                        <th colspan="2">Accomplishment</th>

                                        <!-- <th rowspan="2">Action</th> -->
                                    </tr>
                                    <tr>
                                        
                                        <th>Number</th>
                                        <th>%</th>
                                        <th>Number</th>
                                        <th>%</th>
                                       
                                    </tr>


                                </thead>
                                <tbody>
                                    <?php $count=1;
                                        foreach ($set_target as $key => $value) { 
                                        $achievementsc = $this->db->get_where('tbl_purchase_llis',array('item_name'=>(int)$value['cource_name']))->num_rows();
                                        $this->db->from('tbl_exam e');
                                        $this->db->join('tbl_course c' ,'e.course_id = c.id');		
                                        $this->db->where('e.course_id',(int)$value['cource_name']);
                                        $this->db->group_start();
                                        $this->db->where('e.certificate_id !=' ,"");
                                        $this->db->group_end();
                                        $query = $this->db->get();
                                        $achievementst = $query->num_rows();
                                         
                                        if($value['category']=='Training'){
                                            $coursename = $this->db->get_where('tbl_training',array('id'=>$value['cource_name']))->row_array()['title']; 
                                            $author_reference_id = ''; 
                                        }else{
                                            $coursename = $this->db->get_where('tbl_course',array('id'=>$value['cource_name']))->row_array()['course_title']; 
                                            $author_reference_id = $this->db->get_where('tbl_course',array('id'=>$value['cource_name']))->row_array()['author_reference_id']; 
                                        }

                                        $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['name'];      
                                        $percentage = ($value['target_number']/$value['total_staff'])*100; 
                                        $countcourse = isset($achievementsc)?$achievementsc:0;
                                        $counttraining = isset($achievementst)?$achievementst:0;
                                        $countsum = $countcourse + $counttraining;
                                        $achievement_percentage = ($countsum/count($value['target_number']))*100; 
                                        $staff_sum += $value['total_staff'];
                                        $target_sum += $value['target_number'];
                                        $total_persentage = ($target_sum/$staff_sum)*100;

                                        $acc_sum += $countsum;
                                        $total_acc_persentage = ($acc_sum/$target_sum)*100;

                                        ?>
                                    <tr>
                                        <td><?php echo $count; ?>.</td>
                                        <td><?php echo $coursename; ?></td>
                                        <td><?php echo $value['category']; ?></td>
                                        <td><?php echo $value['implementation_date']; ?></td>
                                        <td><?php echo $providername; ?></td>
                                        <td><?php 
                                        if($value['category']=='Course'){ 
                                            if($author_reference_id != ''){ 
                                                    echo 'Author';
                                                }else{
                                                    echo 'Presenter';  
                                                }
                                            }else{ echo '--'; } ?></td>
                                        <td><?php echo $value['total_staff']; ?></td>
                                        <td><?php echo $value['target_number']; ?></td>


                                        <td><?php echo ceil($percentage); ?>%</td>
                                        <!-- <td><?php echo 'sub_institution'; ?></td> -->
                                        <td><?php echo $countsum; ?></td>
                                        <td><?php echo $achievement_percentage; ?> %</td>
                                       <!--  <td>
                                        <a onclick="setvalue('<?php echo $value['id'] ?>')" class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal" data-target="#Registersubinstitutions11"><i class="fa fa-pencil"></i></a> 
                                        <a class="btn btn-default" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/target_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a></td> -->
                                    </tr>
                                    <?php $count++; } ?>
                                    <tr>
                                        <th colspan="5"></th>
                                        <th>Total</th>
                                        <th><?php echo $staff_sum; ?></th>
                                        <th><?php echo $target_sum; ?></th>
                                        <th><?php echo ceil($total_persentage); ?>%</th>
                                        <th><?php echo $acc_sum; ?></th>
                                        <th><?php echo ceil($total_acc_persentage); ?>%</th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

            <div class="col-sm-9"> 
            <h3 class="border-title text-left">Archive List</h3>
            
            <!-- <div class="set-trget-box"> -->
            <div class="table-responsive">   
            <table class="table table-bordered">
            <thead class="set-target">
                <tr>
                <th rowspan="2" >No.</th>
                <th rowspan="2" >Name of Courses</th>
                <th rowspan="2" >Category</th>
                <th rowspan="2" >Date of Implementation</th>
                <th rowspan="2">CE Provider</th>
                <th rowspan="2">Author / Presenter</th>
                <th rowspan="2" >Total Staff to be Trained</th>
                <th colspan="2" >Target Numbers to be Trained</th>
                <!-- <th rowspan="2" >Percentage</th> -->

                <th colspan="2" >Accomplishment</th>
                <!-- <th colspan="2" >Accomplishment In %</th> -->

                <th rowspan="2" >Action</th>
                </tr>

                <tr>
                <th>Number</th>
                <th>%</th>
                <th>Number</th>
                <th>%</th>
                </tr>
            </thead>
            <tbody>

        <?php 
        $tot_staffs1 = 0;
        $tot_target_number = 0;
        $tot_percentage1 = 0;
        $count1 = count($archive_set_target);
        if(!empty($archive_set_target)){
        foreach ($archive_set_target as $key => $value) {

            $achievements1 = $this->db->get_where('tbl_purchase_llis',array('item_name'=>(int)$value['cource_name']))->result_array();
            $achievements1 += $this->db->get_where('tbl_training_book',array('training_seminar_id'=>(int)$value['cource_name']))->result_array();

            if($value['category']=='Training'){
                $coursename = $this->db->get_where('tbl_training',array('id'=>$value['cource_name']))->row_array()['title']; 
                $author_reference_id = ''; 
            }else{
                $coursename = $this->db->get_where('tbl_course',array('id'=>$value['cource_name']))->row_array()['course_title']; 
                $author_reference_id = $this->db->get_where('tbl_course',array('id'=>$value['cource_name']))->row_array()['author_reference_id']; 
            }
                $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['name'];      
                $percentage1 = ($value['target_number']/$value['total_staff'])*100; 
                $achievement_percentage1 = (count($achievements1)/count($value['target_number']))*100; 
                $staff_sum1 += $value['total_staff'];
                $target_sum1 += $value['target_number'];
                $total_persentage1 = ($target_sum1/$staff_sum1)*100;

                $acc_sum1 += count($achievements1);
                $total_acc_persentage1 = ($acc_sum1/$target_sum1)*100;
        ?>

        

                <tr class="table-color1">
                <td><?php echo $count1; ?>.</td>
                <td><?php echo $coursename; ?></td>
                <td><?php echo $value['category']; ?></td>
                <td><?php echo $value['implementation_date']; ?></td>
                <td><?php echo $providername; ?></td>
                <td><?php 
                if($value['category']=='Course'){ 
                    if($author_reference_id != ''){ 
                            echo 'Author';
                        }else{
                            echo 'Presenter';  
                        }
                    }else{ echo '--'; } ?></td>
                <td><?php echo $value['total_staff']; ?></td>
                <td><?php echo $value['target_number']; ?></td>


                <td><?php echo ceil($percentage1); ?>%</td>
                <!-- <td><?php echo 'sub_institution'; ?></td> -->
                <td><?php echo count($achievements1); ?></td>
                <td><?php echo $achievement_percentage; ?> %</td>
                <td>
                <!-- <a onclick="setvalue('<?php echo $value['id'] ?>')" class="btn btn-default" title="Edit" href="javascript:void(0)" data-toggle="modal" data-target="#Registersubinstitutions11"><i class="fa fa-pencil"></i></a> --> 
                <a class="btn btn-default" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')" href="<?php echo site_url('provider/target_delete/'.$value['id'].'');?>"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php } ?>
            <tr>
                <th colspan="5"></th>
                <th>Total</th>
                <th><?php echo $staff_sum1; ?></th>
                <th><?php echo $target_sum1; ?></th>
                <th><?php echo ceil($total_persentage1); ?>%</th>
                <th><?php echo $acc_sum1; ?></th>
                <th><?php echo ceil($total_acc_persentage1); ?>%</th>
                <th></th>
            </tr>
        <?php  }else{ echo '<tr><td colspan="10" style="text-align: center; font-weight: bold;">No data Found!</td></tr>';}?>
        
        </tbody>
        </table>

        </div> 
        <!-- </div>  -->
        </div> 
        </div>
    </div>
</div>


    <!-- Modal  Register Sub institutions-->
    <div id="set_target_first" class="modal fade" role="dialog" style="margin-top: 200px;" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    <?php if($_REQUEST['id']=="success"){ ?><p class="alert alert-success">Mail sent to CEP.</p><?php } ?>
                    <h4 class="modal-title">Please set your Training Period.</h4>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo site_url('institution/settargetdate'); ?>" method="post" enctype="multipart/form-data" name="settargetdateform1" id="settargetdateform1">
                        <p>
                            <label>Starting Date <span class="required"> * </span> </label>
                            <input type="date" class="form-control" name="start_date" id="start_date" required >
                            <span class="error"></span>
                        </p>

                        <p>
                            <label>Ending Date <span class="required"> * </span> </label>
                            <input type="date" class="form-control" name="end_date" id="end_date" required >
                            <span class="error"></span>
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-primary mt-5" value="Save" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal  edit_webpage_btn -->
    <div id="edit_webpage_btn" class="modal fade" role="dialog" style="margin-top: 200px;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">SUCCESS</h4>
                </div>
                <div class="modal-body text-center">
                    <p><b><?php echo$this->session->flashdata('response-set'); ?></b></p>
                    <h4><b>Please edit your "Institution CE Webpage".</b></h4>
                    <a href="<?php echo base_url('institution/editwebpage?id=focus');?>" class="btn btn-default">Edit Webpage</a>
                    <!-- <input type="button" onclick="focus();" value="test focus" /> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    

<script type="text/javascript">
     $(document).ready(function() {
        var x ='<?php if($_REQUEST['id']=="success"){ ?>'+  $("#set_target_first").modal("show") + '<?php } ?>';       
        var y ='<?php if($_REQUEST['id']=="target"){ ?>'+  $("#edit_webpage_btn").modal("show") + '<?php } ?>';    
        });

     $('#settrainingperiode').on('click', function(){
        var start = $("#settrainingperiode").attr('data-value');
        var end = $("#settrainingperiode").attr('data-name');
        var id = $("#settrainingperiode").attr('data-id');

        // alert(id+' , '+start+' , '+end);
        $("#training_periode_id").val(id);
        $("#training_periode_sdate").val(start);
        $("#training_periode_edate").val(end);
        $("#set_target").modal("show");
    });

     function setmaintarget(){
        $("#set_target").modal("show");
     }


</script>