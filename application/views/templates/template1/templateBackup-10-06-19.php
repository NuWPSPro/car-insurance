<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>My CPD Unit</title>

        <?php 
        $img9 = BASE_URL."assets/templates/template1/certificate.jpg";
        ?>
        

    <style>
        .certificate {
            width: 700px;
            border: 1px solid #0e04d7;
            padding: 1em;
            background: url(http://ceonpoint.com/assets/templates/template1/certificate.jpg) no-repeat center center;
            height: 800px;
            position: relative;
            box-sizing: border-box;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 10em;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 14px;
        }

        /* .certificate * {
            box-sizing: border-box;
        } */

        .certificate img {
            max-width: 100%;
        }

        .certificate span {
            display: inline-block;
        }

        .certificate .foot {
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 100%;
            padding: 2em 2em 0;
        }

        .certificate .foot .time {
            float: left;
            margin-top: 50px;
        }

        .certificate .foot .time span {
            font-size: 12px;
        }

        .certificate .foot .barcode {
            float: right;
        }

        .certificate h1 {
            color: #fff;
            margin-top: 3.2em;
            text-transform: uppercase
        }

        .certificate h3 {
            font-size: 30px;
            margin-bottom: 7px;
        }

        .certificate h4 {
            font-size: 20px;
        }

        .certificate h5 {
            margin-bottom: 40px;
            margin-top: 0;
        }

        .cpd-profile {
            display: inline-block;
            border: 2px solid #fff;
            margin-bottom: 5em;
        }

        .cpd-profile img {
            vertical-align: top;
        }

        .certificate-no {
            font-size: 16px;
        }

        .certificate-no span {
            font-size: 12px;
        }

        .header {
            text-align: right;
            padding-bottom: 20px;
        }

        .header span {
            margin-left: 20px;
        }
    </style>
</head>

<body>

<?php 
function showimage($image){
// Read image path, convert to base64 encoding
$imageData = base64_encode(file_get_contents($image));
// Format the image SRC:  data:{mime};base64,{data};
$src = 'data:image/jpeg;base64,'.$imageData;
// Echo out a sample image
return $src;
}
?>
 


<?php 
/*echo '<pre>';
print_r($cust_data);
echo "======================================";
echo '<pre>';
print_r($cpd_data);
echo "======================================";
echo '<pre>';
print_r($training_data);*/
?>


    <div class="certificate">
    <table style="width: 100%">
            <tr>
                <td valign="top">
                    <h1>Certificate</h1>
                </td>
                <td align="right">
                    <div style="margin-bottom: 30px;">
                        <?php 
                            $img = BASE_URL."assets/images/uploads/".$cpd_data[0]['image'];
                           ?>
                        <img src="<?php echo showimage($img);?>" width="100">
                    </div>
                    <div class="cpd-profile">
                        <?php 
                            $img1 = BASE_URL."assets/templates/template1/profile.jpg";
                           ?>
                        <img src="<?php echo showimage($img1);?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <h3 class="name"><?php echo $cust_data[0]['name']?></h3>
                    <div class="test">has successfully completed the</div>
                    <h4 class="course"><?php echo $training_data[0]['title']?></h4>
                    <div class="unit">CPD Unit <?php echo $training_data[0]['units']?></div>
                    <?php 
                            $img2 = BASE_URL."assets/templates/template1/signature.png";
                        ?>

                    <div style="margin-top: 10px;"><img src="<?php echo showimage($img2);?>"> </div>
                    <h5 class="prof">Prof. Aman, Prof .Pankahj</h5>
                    <div class="certificate-no"><?php echo $certificate_no;?>
                        <br>
                        <span>Certificate Number</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <table width="100%">
                        <tr>
                            <td>
                                <div class="time">
                                    <?php echo date('M');?> <?php echo date('d');?>, <?php echo date('Y');?>
                                    <br>
                                    <span>Date Completed</span>
                                    <span style="display: block; margin-top: 20px;">
                                        <?php 
                                                $img3 = BASE_URL."assets/templates/template1/cpd-logo.png";
                                                ?>
                                        <img src="http://ceonpoint.com/assets/images/logo.png" width="150">
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="barcode" style="margin-top: 40px;">
                                    <?php 
                                            $img4 = BASE_URL."assets/templates/template1/barcode.png";
                                            ?>
                                    <img src="<?php echo showimage($img4);?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div
                                    style="width: 100%; clear: both; font-size: 10px; text-align: center; color: #fff; padding-top: 12px; margin-bottom: -5px;">
                                    This certificate is online verification at
                                    www.mycpdunits.com/certificateverification</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- <div class="foot">
            <div class="time">
                <?php echo date('M');?> <?php echo date('d');?>, <?php echo date('Y');?>
                <br>
                <span>Date Completed</span>
                <span style="display: block; margin-top: 20px;">
                    <?php 
                    $img3 = BASE_URL."assets/templates/template1/cpd-logo.png";
                    ?> 
                    <img src="<?php echo showimage($img3);?>" width="150">
                </span>
            </div>
            <div class="barcode" style="margin-top: 40px;">
                    <?php 
                    $img4 = BASE_URL."assets/templates/template1/barcode.png";
                    ?> 
                    <img src="<?php echo showimage($img4);?>"> 
            </div>
            <div style="width: 100%; clear: both; font-size: 12px; text-align: center; color: #fff; padding-top: 12px; margin-bottom: -5px;">This certificate is online verification at www.mycpdunits.com/certificateverification</div>
        </div> -->
        
    </div>
</body>

</html>