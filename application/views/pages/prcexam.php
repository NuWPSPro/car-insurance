<?php $this->load->view('template/search'); ?>

<div class="innerContent">

  <div class="container">

    <div class="row">

      <div class="col-md-8">

        <?php  

        if($idd==""){

        ?>

        <h3 class="border-title text-left">PRC Exam Result</h3>

        <ul class="list-group">

          <?php 



          foreach ($exam as $key => $value) {



          ?>

          <a class="list-group-item" href="<?php echo site_url('pages/prcexam/'.$value['id'].'');?>"><?php echo $value['title'];?></a>



            <?php 



          }



          ?> 



        </ul>



        <?php 



      } else {  



      ?> 

      <h3 class="border-title text-left"><?php echo $exam[0]['title'];?></h3>

      <?php  

      echo $exam[0]['description'];

    }
    ?>

    
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

  

  <?php  $this->load->view('pages/sidebar'); ?>

 

</div>

</div>

</div>