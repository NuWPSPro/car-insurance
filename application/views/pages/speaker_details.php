  <?php  
                foreach ($sdata as $key => $value) {
                ?>
                <?php 
                if($value['speaker_image'] !=""){
                ?>
                
                <a href="javascript:void(0);" onclick="speaker_details('<?php echo $value['id']; ?>')">
                <img src="<?php echo base_url(); ?>/assets/images/uploads/<?php echo $value['speaker_image']; ?>" width="250">
                </a>

                <?php } ?>
                                
               <h4 class="speaker-title"><a onclick="speaker_details('<?php echo $value['id']; ?>')" href="javascript:void(0);"><?php echo $value['speaker_name']; ?></a></h4>
               <div class="description_popup">
                  <p>Position: <span><?php echo $value['position']; ?></span></p>
                  <p>Address: <span><?php echo $value['insititution']; ?></span></p>
               </div>
                
                <p><?php echo $value['speaker_description']; ?> </p>
                <?php 
                }
                ?>