<?php $this->load->view('template/search'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row">
            <div class="col-sm-8"> 
                <div class=""> 
                <div class="">
               
                    <?php  
                    if($idd==""){
                    ?>
                    <h3 class="border-title text-left"><a href="javascript:void(0);"> CPD Guide </a></h3>
        

                    <ul class="list-group">
                    <?php 
                    foreach ($guide as $key => $value) {
                    ?>
                    <li class="list-group-item"><?php echo $key+1;?>. <a href="<?php echo site_url('pages/guide/'.$value['id'].'');?>"><?php echo $value['title'];?></li>
                    <?php 
                    }
                    ?> 
                    </ul>
                    <?php 
                    } else {  
                    ?> 


                    

                    <h4><a href="javascript:void(0);"> <?php echo $guide[0]['title'];?> </a></h4> 
                    <p>
                    <?php  
                    echo $guide[0]['description'];
                    }
                    ?> 
                    </p>
                 </div> 
                 </div> 

                 <?php 
                 if($idd!=""){
                 ?>
                  <div style="margin-top:0px;" class="mob-social">
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_google_plus"></a>
                    </div>
                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                </div>
                <?php } ?>
                                
            </div>


             <?php $this->load->view('pages/sidebar'); ?>
        </div>
    </div>
</div>


