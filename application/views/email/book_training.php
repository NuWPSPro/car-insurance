
Dear <?php echo ucwords($data['name']); ?>
<br>
<p>Thank you for registering in  “ <b><?php echo $details['title']; ?></b> ”.</p>
<p>Please find the following information for your guidance:</p>

<p>General Training Information 
	<br>Title :<b><?php echo $details['title']; ?></b> 
	<br>Theme : <b><?php echo $details['sub_title']; ?></b>
	<br>Date : <b><?php echo date('d F Y', strtotime($details['start_date'])); ?></b>
	<br>Time Starts: <b><?php echo date('g:iA',strtotime($details['start_time'])); ?></b>
	<br>Time Ends : <b><?php echo date('g:iA',strtotime($details['end_time'])); ?></b><br>
	<br>CE Units :<b><?php echo $details['units']; ?></b>
	<br>Contact person/s : <b><?php echo $details['contact_person']; ?></b>
	<br>Contact Number/s: <b><?php echo $details['phone']; ?></b>
	<br>Email : <b><?php echo $details['email']; ?></b>.
</p>
<p>
Training weblink : <a href="<?php echo base_url('pages/training_details/').$details['id']; ?>"><?php echo base_url('pages/training_details/').$details['id']; ?></a>
<br><br>
Virtual classroom link : <a href="<?php echo $details['add_link']; ?>"><?php echo $details['add_link']; ?></a>
</p>
<br>
<br>
Thank you.
<br>
<br>
Sincerely,
<br>
<?php echo $details['chairman']; ?> 
<br>
( <?php echo $details['position']; ?> )
