<html>
    <body>
        
<?php


$uid 		 = $data['user_id'];
$course_name = $data['course_name'];
$units 		 = $data['units'];
$start_date  = $data['start_date'];
$end_date 	 = $data['end_date'];
$certificate_id = $data['certificate_id'];
$certificate = $data['certificate'];
$category 	 = $data['category'];
$issue_date  = $data['issue_date'];
$issue_from  = $data['issue_from'];
$issue_by 	 = $data['issue_by'];
$cep_name  	 = $data['cep_name'];
$status 	 = $data['status'];
$added_on 	 = $data['added_on'];


// error_reporting(E_ALL);
// ini_set("display_errors", 0);	
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
     var uid = '<?php echo $uid; ?>';
     var course_name = '<?php echo $course_name; ?>';
    var units = '<?php echo $units; ?>';
    var start_date = '<?php echo $start_date; ?>';
    var end_date = '<?php echo $end_date; ?>';
    var certificate_id = '<?php echo $certificate_id; ?>';
    var certificate = '<?php echo $certificate; ?>';
    var category = '<?php echo $category; ?>';
    var issue_date = '<?php echo $issue_date; ?>';
    var issue_from = '<?php echo $issue_from; ?>';
    var issue_by = '<?php echo $issue_by; ?>';
    var cep_name = '<?php echo $cep_name; ?>';
    var status = '<?php echo $status; ?>';
    var added_on = '<?php echo $added_on; ?>';
    var domain = '<?php echo $domain; ?>';
    var certificate_identify = 1;
        $.ajax({
            url: 'https://ceonpoint.com/nursingcouncil/admin/api/add_certificate',
            type: 'POST',
            data: JSON.stringify({
                    user_id : uid, course_name : course_name, units : units, start_date : start_date,
                end_date : end_date, certificate_id :certificate_id, certificate : certificate, category : category, issue_date : issue_date, issue_from : issue_from, issue_by : issue_by, cep_name : cep_name, status : status, added_on : added_on, certificate_identify : certificate_identify
                }),
            dataType: 'json',
            success: function(result){
                alert(result);
            }
        });
    });
  </script>
  
  </body>
</html>