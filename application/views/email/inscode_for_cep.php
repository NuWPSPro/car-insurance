Dear Sir/Madam,
<br/>
<br/>
<b>The following information comes from your institution for your registration at the <a href="<?php echo base_url(); ?>">ceonpoint.com</a> at the affiliation section.</b>
<br/>
<br/>
<br/>
<p>Please Choose the name of your institution and enter the institution code to the field provided. These data will connect your account to your institution.</p>
<br/>
<br/>
<p>Here are details of institution information:</p>
<table border="1">
	<tr>
		<th>Institution Name</th>
		<td><?=$insname;?></td>
	</tr>
	<tr>
		<th>Institution Code</th>
		<td><b><?=$inscode;?></b></td>
	</tr>
</table>
<?php if($send_to=='provider'){ 
			$url = base_url('users/signup/provider'); 
		}else{ 
			$url = base_url('users/signup/institution'); 
		} ?>
<br/> 
Please click <a href="<?php echo $url; ?>"> here </a>to register.
<br/>
<br/> 
<br/> 
Best Regards,
<br/>
CEonpoint Team