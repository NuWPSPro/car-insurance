<?php $this->load->view('template/search'); ?>
<div class="innerContent trainingdetails-panel">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <?php //echo $this->session->flashdata('response'); ?>

                <?php $this->load->view('template/trainingmenu'); ?>

                <div class="inner-detailImg"><img src="<?php echo ASSETS_URL.'images/uploads/'.$seminar[0]['thumb_img'];?>" ></div>
          
                <h3 class="border-title text-left pull-left">General Information</h3>
                <div class="clear-line"></div>
                <table class="table table-bordered">

                    <tr>
                        <td><strong>Title: </strong></td>
                        <td><?php echo $seminar[0]['title'];?></td>
                    </tr>

                    <tr>
                        <td><strong>Units: </strong></td>
                        <td><?php echo $seminar[0]['units'];?></td>
                    </tr>

                    <tr>
                        <td><strong>Date: </strong></td>
                        <?php if($seminar[0]['start_date'] == $seminar[0]['end_date']){
                                $date = date('F d, Y',strtotime($seminar[0]['start_date']));
                            }else{
                                $date = date('F d, Y',strtotime($seminar[0]['start_date'])).' to '.date('F d, Y',strtotime($seminar[0]['end_date']));
                            } ?>
                        <td><?php echo $date; ?></td>
                    </tr>

                    <tr>
                        <td><strong>Time: </strong></td>
                        <td>
                            <?php echo date('g:i a',strtotime($seminar[0]['start_time'])); ?> to
                            <?php echo date('g:i a',strtotime($seminar[0]['end_time']));?>
                        </td>
                    </tr>
                   
                
                      <tr>
                        <td><strong>Contact Person: </strong></td>
                        <td><?php echo $seminar[0]['contact_person'];?></td>
                    </tr>

                      <tr>
                        <td><strong>Contact Number: </strong></td>
                        <td><?php echo $seminar[0]['phone'];?></td>
                    </tr>

                     <tr>
                        <td><strong>Email: </strong></td>
                        <td><?php echo $seminar[0]['email'];?></td>
                    </tr>


                     <tr>
                        <td><strong>Location: </strong></td>
                        <td><?php echo $seminar[0]['location'];?></td>
                    </tr>


                    <tr>
                        <td><strong>Ticket Price: </strong></td>
                        <td><?php if($seminar[0]['total'] > 0){ echo '$ '.$seminar[0]['total']; }else{ echo 'Free'; } ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address: </strong></td>
                        <td><?php echo $seminar[0]['location'];?></td>
                    </tr>
                </table>
                <?php if(!empty($seminar[0]['venue_photo'])){ ?>
                <h3 class="border-title text-left">Venue Photo</h3> 
                <div class="venue_photobox"><img src="<?php echo ASSETS_URL.'images/uploads/'.$seminar[0]['venue_photo'];?>" alt="<?php echo $seminar[0]['venue_photo'];?>"></div><?php } ?>

                <h3 class="border-title text-left">Location</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423283.43556966283!2d-118.69193224149865!3d34.0207304939433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos+Angeles%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1532191566192" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                <?php   $provider_id = $seminar[0]['user_id'];
                        $udata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$provider_id); ?>
                <h3 class="border-title text-left">CE Provider</h3>

                <div class="row">
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
                            <a href="<?php echo site_url('provider/viewmypage/'.$udata[0]['id'].'');?>">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $udata[0]['image'];?>" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title"><?php echo ucfirst($udata[0]['name']);?></h5>
                                    <div class="training-box_text"><?php echo ucfirst($udata[0]['profession']);?></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('pages/sidebar'); ?>
        </div>
    </div>
</div>

<!-- Thank you modal-->
    <div id="thankyou" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="text-center">
                        <img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" style="max-width: 34%;margin-bottom:10px;" alt="logo">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h4 class="display-4">Successfully Registered</h1>
                            <p class="lead"><?php echo $this->session->flashdata('response'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


 <?php $is_login =  $this->session->userdata('logged_in'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        var success = "<?php if($_REQUEST['id']=='success'){ ?>"+  $("#training_registration").modal('hide'); $("#thankyou").modal(); +"<?php } ?>";
        var exist   = "<?php if($_REQUEST['id']=='exist'){ ?>"+ $("#thankyou").modal() +"<?php } ?>";
    });
</script>
