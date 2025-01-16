<?php $this->load->view('template/search'); ?>

<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
    <?php   $cid = $this->uri->segment(3);
            $uid = $this->session->userdata('logged_in')['id'];
            $course = $this->user->get_record_by_field_name_all_record('tbl_course','id',$cid);
            $ins_id = ($course[0]['insititution_id'] == '0' )? '' : $course[0]['insititution_id'];

        $insCourseId = end(explode('-', $course[0]['insititution_id']));
        $insName = $this->db->get_where('tbl_user',array('id'=>$insCourseId))->row_array()['name'];
        
        $users_datas = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
            $data['exam_details'] = $this->user->get_exam_detail($cid,$uid);  
            $datas = $this->db->get_where('tbl_purchase_llis',array('item_name'=>$cid,'user_id'=>$uid,'status'=>1,'archive'=>'0'))->row_array();   
        $courseData = $this->db->get_where('tbl_course',array('id'=>$cid))->row_array(); 

        $provider_id = end(explode('-',$users_datas['under_provider']));
        $ins = $this->db->get_where('tbl_institution_staff_payment',array('provider_id'=>$provider_id))->row_array(); 
        $profArr = explode(',',$ins['prof_id']);
       
        $con = array_search($uid,$profArr);
       if($profArr[$con] == ''){ 
            $cons = 2; 
        }else{ 
            $cons = 1; 
        } ?>
    <?php $this->load->view('template/coursemenu'); ?>
               
    <h3 class="border-title text-left">Certificate </h3>
        <div class="lesson-wrapper p-20">
        <?php echo $this->session->flashdata('response'); ?>
            
    <?php if(empty($data) && $cons = 2){
            if(empty($data)){
            $condition = $this->session->userdata('logged_in')['role'];
            // echo '--> '.$condition;
                switch ($condition){
                case "": ?>
                        <?php if(!empty($ins_id)){ ?>
                        <p class="text-center">
                            <div class="alert alert-info">This online course is accessible only by professionals under <br>Institution: <i><?php echo $insName; ?></i>.<br>Please log-in or register to access this online course.</div>
                        </p><?php }else{ ?>
                        <p class="text-center">
                            <div class="alert alert-info">
                                Please purchase this online course to access the examination section.
                            </div>
                            <button class="btn btn-primary">
                                <a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?>
                                </a>
                            </button>
                        </p><?php } ?><?php
                break;
                case ($condition != 1 ): ?>
                        <p class="text-center">
                            <div class="alert alert-info">This online course is accessible only by professionals under <br>Institution: <i><?php echo $insName; ?></i>.<br>Please log-in or register to access this online course.</div>

                        </p><?php
                break;
                case 1: ?>
                     <?php if(!empty($ins_id)){ ?>
                        <p class="text-center">
                            <div class="alert alert-info">This online course is accessible only by professionals under <br>Institution: <i><?php echo $insName; ?></i>.<br>Please log-in or register to access this online course.</div>
                        </p><?php }else{ ?>
                        <p class="text-center">
                            <div class="alert alert-info"><!-- This Online Course is accessible only by professionals under institution.<br>Please log-in or register to access this Online Course. -->
                                Please purchase this online course to access the examination section.
                            </div>
                            <button class="btn btn-primary">
                                <a style="color: #ffff;" href="javascript:void(0)" onclick="pay_now();">BUY $<?php echo floatval($course[0]['total']);?>
                                </a>
                            </button>
                        </p><?php } ?>
                        <?php
                break;
                // default:
                //     echo "Your favorite color is neither red, blue, nor green!";
                }
            }

        }else{ 

                switch ($data['exam_details']){
                case TRUE: ?>
                   
                    <div class="panel panel-default exampassed">
                        <div id="loader"></div>
                        <?php if(!empty($this->session->flashdata('mailsent'))){ ?>
                            <div class="panel-heading">
                                <?php echo $this->session->flashdata('mailsent'); ?>
                            </div> 
                        <?php } ?>
                        <!-- <div id="certinutan" class="certificate-exam"></div> -->
                        <iframe src="" id="certificateCreated" title="user_course_certificate" frameborder="0" height="850" width="750"></iframe>
                    </div>
                    <?php
                break;
                case FALSE: ?>
                    <p class="text-center">
                        <div class="alert alert-info">Sorry you are not qualify to get certificate. Try again</div>
                    </p><?php
                break;
                }
            } ?>

            </div>
        </div>
        <?php $this->load->view('pages/sidebar'); ?>
                
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        var uid = "<?php echo $uid;?>";
        var cid = "<?php echo $cid; ?>";
        var certificateid = "<?php echo $data['exam_details'][0]['certificate_id']; ?>";
        var path = 'https://ceonpoint.com/assets/upload/course-pdf/'+ certificateid +'.pdf';
        $('#certificateCreated').attr('src',path);

     $.ajax({
                type: "POST",
                url: '<?php echo base_url("pages/preview_course_certificate");?>',
                data: { uid : uid ,cid : cid },
                beforeSend: function(){
                    $("#loader").delay(1000).hide(0).fadeOut("slow");
                },
                success: function(result){
                // alert(result);
                    $('#certinutan').html(result);
                }
            });
    });
</script>

