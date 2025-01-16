<!DOCTYPE html>
<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>My CPD Unit</title><?php $img9 = BASE_URL."assets/templates/template3/certificate.jpg"; ?>
    <style>
        .certificate,.certificate *{box-sizing:border-box}.certificate span,.cpd-profile{display:inline-block}.certificate{width:700px;border:1px solid #0e04d7;padding:1em;background:url(http://localhost/ci/assets/templates/template3/certificate.jpg) center center no-repeat;height:800px;position:relative;border-radius:5px;overflow:hidden;margin-bottom:10em;font-family:Verdana,Geneva,Tahoma,sans-serif}.certificate img{max-width:100%}.certificate .foot{position:absolute;bottom:10px;left:0;width:100%;padding:2em 2em 0}.certificate .foot .time{float:left;margin-top:50px}.certificate .foot .time span,.certificate-no span{font-size:12px}.certificate .foot .barcode{float:right}.certificate h1{color:#fff;margin-top:1.2em;text-transform:uppercase}.certificate h3{font-size:30px;margin-bottom:7px}.certificate h4{font-size:20px}.certificate h5{margin-bottom:70px;margin-top:0}.cpd-profile{border:2px solid #fff;margin-bottom:5em}.cpd-profile img{vertical-align:top}.certificate-no{font-size:16px}.header{text-align:right;padding-bottom:20px}.header span{margin-left:20px}
    </style>
</head>
<body><div class="certificate">
        <table style="width: 100%">
            <tr>
                <td colspan="2" align="right" class="header">
                    <span>
                        <?php 
                         $img = BASE_URL."assets/templates/template3/owner.png";
                        ?>
                        <img src="<?php echo showimage($img);?>" width="100">
                    </span>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <h1>Certificate</h1>
                </td>
                <td align="right">
                    <div class="cpd-profile">
                     <?php 
                         $img1 = BASE_URL."assets/templates/template3/profile.jpg";
                        ?>
                        <img src="<?php echo showimage($img1);?>"> 
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <h3 class="name">Puran Chand</h3>
                    <div class="test">has successfully completed the</div>
                    <h4 class="course">Rhythm online Course</h4>
                    <div class="unit">CPD Unit 4</div>
                       <?php $img2 = BASE_URL."assets/templates/template3/signature.png";?>
                    <div style="margin-top: 10px;"><img src="<?php echo showimage($img2);?>"> </div>
                    <h5 class="prof">Prof. Aman, Prof .Pankahj</h5>
                    <div class="certificate-no">sdfjdkf67868sdf
                        <br>
                        <span>Certificate Number</span>
                    </div>
                </td>
            </tr>
        </table>
        <div class="foot">
            <div class="time">
                March 05, 2018
                <br>
                <span>Date Completed</span>
                <span style="display: block; margin-top: 20px;">
                    <?php 
                    $img3 = BASE_URL."assets/templates/template3/cpd-logo.png";
                    ?> 
                    <img src="<?php echo showimage($img3);?>" width="150">
                </span>
            </div>
            <div class="barcode" style="margin-top: 40px;">
                <?php $img4 = BASE_URL."assets/templates/template3/barcode.png"; ?> 
                <img src="<?php echo showimage($img4);?>"> 
            </div>
            <div style="width: 100%; clear: both; font-size: 12px; text-align: center; color: #fff; padding-top: 12px; margin-bottom: -5px;">This certificate is online verification at www.mycpdunits.com/certificateverification</div>
        </div>
    </div>
</body>
<?php 
function showimage($image){
$imageData = base64_encode(file_get_contents($image));
$src = 'data:image/jpeg;base64,'.$imageData;
return $src;
}
?>
</html>