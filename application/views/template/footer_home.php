<?php 
$contactinfo = $this->db->get_where('tbl_contact_info',array('id'=>1))->row_array();
$pages = $this->db->get_where('tbl_pages',array('url'=>'about-us'))->row_array();
$role = $this->session->userdata('logged_in')['role'];  
$uins = $this->session->userdata('logged_in')['under_insititution'];  
    if($role == 1):  $cont = "professional/dashboard"; 
elseif($role == 2):  if($uins=='0'): $cont = "provider/dashboard"; else: $cont = "provider/set_target"; endif;      
elseif($role == 4):  $cont = "advertise/advertise";     
elseif($role == 5):  $cont = "institution/editwebpage"; 
elseif($role == 6):  if($uins=='0'): $cont = "author/overview"; else: $cont = "author/course_listing"; endif;  
elseif($role == 7):  $cont = "rboard/subscription_package"; 
elseif($role ==10):  $cont = "admin/dashboard";         endif; ?>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 ftrabout">
                <div class="h3"><img src="<?php echo ASSETS_URL.'images/logo-whitesmall.png'; ?>"></div>
                <?php   echo $pages['home_content'];  ?>
                <!-- <p><a href="#" title="" class="btn bg-yellow"> SIGN-UP NOW!</a></p> -->
                <div class="header-register icons-header">
                    <ul class="dt-sc-default-login">
                        <?php if(empty($this->session->userdata('logged_in'))){ ?>
                         <li>
                            <a href="<?php echo BASE_URL?>users" class="lgn" title="Login" style=" background: #3d66b0;"><i class="fa fa-user" ></i>Login</a>
                            <a href="javascript:void(0);" onclick="register_now()" title="Register Now" class="register" style=" background: orange;">Sign Up</a>
                        </li>
                    <?php }else{ ?>
                        <li><a href="<?php echo BASE_URL.$cont;?>" class="lgn" style=" background: #3d66b0;" title="My Account"><i class="fa fa-user"></i> My Account</a>
                            <a href="<?php echo BASE_URL?>users/logout" class="register" style=" background: orange;" title="Logout" >Logout</a></li>
                    <?php }  ?>
                    </ul> 
                </div>
            </div>
            <div class="col-sm-4 ftradd">
                <!-- <div class="h3"><img src="https://allenlandscaping.lighthousemedia3k.com/wp-content/uploads/2019/07/logolighthouse.png"></div> -->
                <div class="h3">COUNTACT US</div>
                <ul>
                    <li><i class="fa fa-location-arrow"></i><?php echo $contactinfo['address'];?></li>
                       <?php echo $contactinfo['phone'];?>
                    <!-- <li><i class="fa fa-envelope"></i><a href="mailto:<?php echo $contactinfo['email'];?>"><?php echo $contactinfo['email'];?></a></li> -->
                    <li><i class="fa fa-envelope"></i><a href="<?php echo site_url('pages/contactus');?>"><?php echo $contactinfo['email'];?></a></li>
                </ul>
            </div>
            <div class="col-sm-4 ftrnav">
                <div class="h3">MOBILE APP DOWNLOAD</div>
                <a href="<?php echo BASE_URL.'';?>">
                <img src="<?php echo ASSETS_URL.'/images/mobile_app_pop_up.png';?>" alt="">
                </a>
                <span style="color: #ffff;">Ceonpoint Mobile App</span>
            </div>
            <!-- <div class="col-sm-3 ftrnav">
                <div class="h3">Terms</div>
                <ul>
                    <li> <a href="#" title="">Website Development</a> </li>
                    <li> <a href="#" title="">Mobile App Development</a> </li>
                    <li> <a href="#" title="">Software Subscription</a> </li>
                    <li> <a href="#" title="">Marketing </a> </li>
                </ul>
            </div> -->
        </div>
    </div>
    <div class="graybg-ft">
        <div class="container">
            <div class="col-md-12">
                <div class="box-content">
                  <img src="<?=base_url('assets/images/logo.png')?>" alt="">
                   <span class="cp-text">Copyright © <?php echo date('Y'); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modal video HTML -->
<div id="videoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Introduction Video</h4>
            </div>
            <div class="modal-body">
                <iframe width="100%" height="515" src="https://www.youtube.com/embed/8VUZHnleP6Y" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<!-- The modal -->
<div class="modal fade" id="buyCarInsurance" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Want to buy Car Insurance?</h4>
            </div>
            <form action="<?php echo base_url('pages/buyCarInsurance'); ?>" method="post">
                <div class="modal-body">
                    <label for="">Please fill this form, we will contact you soon! </label>
                    <?php $loguser = $this->session->userdata('logged_in'); ?>
                    <div class="form-group">
                        <label for="first_name" class="sr-only">First Name *</label>
                        <input type="text" class="form-control" id="first_name" name="fname" value="<?php echo isset($loguser['fname'])?$loguser['fname']:''; ?>" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="middle_name" class="sr-only">Middle Name *</label>
                        <input type="text" class="form-control" id="middle_name" name="name" value="<?php echo isset($loguser['name'])?$loguser['name']:''; ?>" placeholder="Middle Name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="sr-only">Last Name *</label>
                        <input type="text" class="form-control" id="last_name" name="lname" value="<?php echo isset($loguser['lname'])?$loguser['lname']:''; ?>" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($loguser['username'])?$loguser['username']:''; ?>" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="sr-only">Mobile *</label>
                        <input type="number" class="form-control" id="mobile" name="mobile" value="<?php echo isset($loguser['mobile'])?$loguser['mobile']:''; ?>" placeholder="mobile" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="company_id" id="companyId">
                    <input type="hidden" name="insurance_id" id="insurance_id">
                    <input type="hidden" name="broker_id" id="broker_id">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo ASSETS_URL.'js/owlcarousel/owl.carousel.js'; ?>"></script>
<script src="<?php echo ASSETS_URL.'js/owlcarousel/owl.js'; ?>"></script>
<script src="<?php echo ASSETS_URL.'js/plugin.js'; ?>"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

 <script type="text/javascript">
    function showPicture() {
      var sourceOfPicture = "https://img.tesco.com/Groceries/pi/118/5000175411118/IDShot_90x90.jpg";
      var img = document.getElementById('bigpic')
      img.src = sourceOfPicture.replace('90x90', '225x225');
      img.style.display = "block";
    } 
</script>


<!-- <script src="<?php echo ASSETS_URL ?>editor/js/froala_editor.min.js"></script>
<script>
$(function() {
    $('.text_editor').editable({ inlineMode: false, imageUploadURL: '<?php echo site_url("uploadimage") ?>', imageUploadParams: { id: "text_editor" } })
});
$(window).load(function() {
    $(".froala-wrapper").next().remove();
});
</script> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="<?php echo ASSETS_URL.'js/bootstrap-select.min.js'; ?>"></script>
<script src="<?php echo ASSETS_URL.'js/countrypicker.js'; ?>"></script>


<script> 
<?php if($this->session->flashdata('response')['class'] == 'success' ){ ?>
    Swal.fire({
      title: 'Success',
      icon: 'success',
      text:"<?php echo $this->session->flashdata('response')['msg']; ?>"
    });
    <?php } ?>
    <?php if($this->session->flashdata('response')['class'] == 'danger' ){ ?>
    Swal.fire({
        title: 'Failed!',
        icon: 'danger',
        text:"<?php echo $this->session->flashdata('response')['msg']; ?>"
    });
<?php } ?>
</script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var date_input = $('input[class="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        //date_input.datepicker({
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        });

        $('.showSingle').click(function(){
            $('.targetDiv').hide();
            $('.showSingle').removeClass('active active1')
            if($(this).attr('target') === "1") {
                $(this).toggleClass('active');
            } else {
                $(this).toggleClass('active1');
            }
            $('#div'+$(this).attr('target')).show();
        });
    });
    // $(document).ready(function(){ 
    //     $(window).scroll(function(){ 
    //         if ($(this).scrollTop() > 100) { 
    //             $('#scroll').fadeIn(); 
    //         } else { 
    //             $('#scroll').fadeOut(); 
    //         } 
    //     }); 
    //     $('#scroll').click(function(){ 
    //         $("html, body").animate({ scrollTop: 0 }, 600); 
    //         return false; 
    //     }); 
    // });
</script>

<?php $current_country = $this->session->userdata('current_country'); ?>
<input type="hidden" value="<?=$current_country;?>" name="current_country" id="cccurrent_country">
<input type="hidden" value="<?=$this->uri->segment(1);?>" name="current_page" id="cccurrent_page">

<script type="text/javascript">
    $(document).ready(function(){
        autoPlayYouTubeModal();
        //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
        function autoPlayYouTubeModal() {
            var trigger = $("body").find('[data-toggle="modal"]');
            trigger.click(function () {
                var theModal = $(this).data("target"),
                    videoSRC = $(this).attr("data-theVideo"),
                    videoSRCauto = videoSRC + "?autoplay=1";
                $(theModal + ' iframe').attr('src', videoSRCauto);
                $(theModal + ' button.close').click(function () {
                    $(theModal + ' iframe').attr('src', videoSRC);
                });
            });
            // if($('#cccurrent_country').val() =='' && $('#cccurrent_page').val()=='' ){
            //     $('#countryPopUp').modal('show');
            // } 

        }
        
        $(window).scroll(function() {
            if ($(window).scrollTop() >= 250) {
                $('#header').addClass('fixed-header');
                // $('nav .navbar-brand').addClass('visible-title');
            } else {
                $('#header').removeClass('fixed-header');
                // $('nav .navbar-brand').removeClass('visible-title');
            }
        });
        
        // $('#completemoduleProfile').modal({backdrop:'static',keyboard:!1})
    });

    function paynow(id,amount) {
        $('#item_name').val(id);
        $('#amount').val(amount);
        document.getElementById("frmPayPal1").submit();
    }
    $(function() { 
        $( "#course_title" ).autocomplete({  
        source: <?php echo json_encode($names); ?>  
        });  
    }); 
    (function($){var pagify={items:{},container:null,totalPages:1,perPage:3,currentPage:0,createNavigation:function(){this.totalPages=Math.ceil(this.items.length/this.perPage);$('.pagination',this.container.parent()).remove();var pagination=$('<div class="pagination"></div>').append('<a class="nav prev disabled" data-next="false"><</a>');for(var i=0;i<this.totalPages;i++){var pageElClass="page";if(!i)
    pageElClass="page current";var pageEl='<a class="'+pageElClass+'" data-page="'+(i+1)+'">'+(i+1)+"</a>";pagination.append(pageEl)}
    pagination.append('<a class="nav next" data-next="true">></a>');this.container.after(pagination);var that=this;$("body").off("click",".nav");this.navigator=$("body").on("click",".nav",function(){var el=$(this);that.navigate(el.data("next"))});$("body").off("click",".page");this.pageNavigator=$("body").on("click",".page",function(){var el=$(this);that.goToPage(el.data("page"))})},navigate:function(next){if(isNaN(next)||next===undefined){next=!0}
    $(".pagination .nav").removeClass("disabled");if(next){this.currentPage++;if(this.currentPage>(this.totalPages-1))
    this.currentPage=(this.totalPages-1);if(this.currentPage==(this.totalPages-1))
    $(".pagination .nav.next").addClass("disabled")}else{this.currentPage--;if(this.currentPage<0)
    this.currentPage=0;if(this.currentPage==0)
    $(".pagination .nav.prev").addClass("disabled")}
    this.showItems()},updateNavigation:function(){var pages=$(".pagination .page");pages.removeClass("current");$('.pagination .page[data-page="'+(this.currentPage+1)+'"]').addClass("current")},goToPage:function(page){this.currentPage=page-1;$(".pagination .nav").removeClass("disabled");if(this.currentPage==(this.totalPages-1))
    $(".pagination .nav.next").addClass("disabled");if(this.currentPage==0)
    $(".pagination .nav.prev").addClass("disabled");this.showItems()},showItems:function(){this.items.hide();var base=this.perPage*this.currentPage;this.items.slice(base,base+this.perPage).show();this.updateNavigation()},init:function(container,items,perPage){this.container=container;this.currentPage=0;this.totalPages=1;this.perPage=perPage;this.items=items;this.createNavigation();this.showItems()}}

    // stuff it all into a jQuery method!
    $.fn.pagify=function(perPage,itemSelector){var el=$(this);var items=$(itemSelector,el);if(isNaN(perPage)||perPage===undefined){perPage=3}
    if(items.length<=perPage){return!0}
    pagify.init(el,items,perPage)}})(jQuery)
    $("#containerp").pagify(9, ".course-item");
    $('.accredited-schools-slider').owlCarousel({loop:!0,margin:0,nav:!0,dots:!1,autoplayHoverPause:!0,autoplay:!0,autoplaySpeed:2000,dotsSpeed:2000,responsive:{320:{items:1},360:{items:1},580:{items:1},768:{items:1},1000:{items:1}}})
    $('.banner-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        autoplaySpeed: 2000,
        dotsSpeed: 2000,
        responsive: {
            320: {
                items: 1
            },

            360: {
                items: 1
            },

            580: {
                items: 1
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // $('.buyCarInsurance-modal').click(function(){
    function buyCarInsurance(){
        if(islogin()==true){
            var compid = $(this).attr('data-id');
            var insid = $(this).attr('data-value');
            var broid = $(this).attr('data-broker');
            $('#companyId').val(compid);
            $('#insurance_id').val(insid);
            $('#broker_id').val(broid);
            $('#buyCarInsurance').modal('show');
        }else{
            var x = confirm('Please login first to fill the form!');

            if(x==true){
                var path = "<?php echo base_url();?>";
                window.location.href=path + "users";
            }
        }
    }
    // });

    function islogin(){
        var session = '<?php echo $this->session->userdata('logged_in')['id']; ?>';
        if(session != '')
        return true; 
    }

</script> 

</body>
</html>