Dear <?php echo ucwords($user_name); ?>,
<br/>
<p>Congratulations!</p>
<p>Thank you for participating in the <b><?=$training;?></b>.</p>
<p>Please click the link below to view, print & download your certficate.</p>
<br/>
<p><a href="<?php echo ASSETS_URL.'upload/pdf/'.$certficate_no; ?>.pdf"><?php echo ASSETS_URL.'upload/pdf/'.$certficate_no; ?>.pdf</a></p>
<br/> 
Best Regards,
<br/>CEonpoint Team 