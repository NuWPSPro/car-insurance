<?php 
$contactinfo = $this->db->get_where('tbl_contact_info',array('id'=>1))->row_array();
$pages = $this->db->get_where('tbl_pages',array('url'=>'about-us'))->row_array();
?>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 ftrabout">
                <div class="h3">About us</div>
              <?php 
              echo $pages['home_content'];
              ?>
                <p><a href="#" title="" class="btn btn-default"> Start Learning Now </a></p>
            </div>
            <div class="col-sm-3 ftradd">
                <div class="h3">Contact us</div>
                
                <ul>
                    <li><i class="fa fa-location-arrow"></i><?php echo $contactinfo['address'];?>
                       <?php //echo $contactinfo['address'];?>
                       <?php echo $contactinfo['phone'];?>
                    <li><i class="fa fa-envelope"></i><a href="mailto:<?php echo $contactinfo['email'];?>"><?php echo $contactinfo['email'];?></a></li>
                </ul>

            </div>
            <div class="col-sm-3 ftrnav">
                <div class="h3">Quick Links</div>
                <ul>
                    <li> <a href="#" title="">Online CPD Course Posting </a> </li>
                    <li> <a href="#" title="">Training/Seminar Posting </a> </li>
                    <li> <a href="#" title="">Professional Listing </a> </li>
                    <li> <a href="#" title="">Job Posting </a> </li>
                    <li> <a href="#" title="">Advertisement </a> </li>
                    <li> <a href="#" title="">Terms of Use </a> </li>
                    <li> <a href="#" title="">Privacy Policy </a> </li>
                </ul>
            </div>
            <div class="col-sm-3 ftrnav">
                <div class="h3">Terms</div>
                <ul>
                    <li> <a href="#" title="">Website Development</a> </li>
                    <li> <a href="#" title="">Mobile App Development</a> </li>
                    <li> <a href="#" title="">Software Subscription</a> </li>
                    <li> <a href="#" title="">Marketing </a> </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="copyright-info">Copyright © 2018 All Rights Reserved | Mycpdunits.com is owned & operated by SmartMedia3K Ltd</div>
            <div class="social">
                <ul>
                    <li><a href="#" target="_blank"><span class="fa fa-twitter"></span></a></li>
                    <li><a href="#" target="_blank"><span class="fa fa-youtube"></span></a></li>
                    <li><a href="#" target="_blank"><span class="fa fa-facebook"></span></a></li>
                    <li><a href="#" target="_blank"><span class="fa fa-skype"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>js/owlcarousel/owl.carousel.js"></script>
<script>
jQuery(document).ready(function($) {
    $('.login-slider').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 450,
        autoplay: true,
        autoplayTimeout: 5000,
        margin: 30,
        responsive: {
            320: { items: 1 },
            480: { items: 1 },
            600: { items: 1 },
            960: { items: 1 },
            1200: { items: 1 }
        }

    });
});
</script>
</body>

</html>