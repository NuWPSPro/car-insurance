<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My CPD Unit</title>


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
 
 

</head>

<body>

   

    <table width="600px" style="font-family: Arial, Helvetica, sans-serif; padding: 10px; background: #8b8889;margin: 0 auto;">
        <tr>
            <td>
                <table

                    <?php 
                    $img3 = BASE_URL."assets/templates/template1/images/bg-img.jpg";
                    ?>  

                    style="background-image:url('<?php echo showimage($img3);?>'); background-repeat: no-repeat;  background-size: cover; width: 100%;  ">
                    <tr>
                        <td>
                            <table style="width: 100%">
                                <tr>
                                    <td style="text-align:center; padding:0px; position: relative;">

                                        <p style=" color: #000; font-size: 15px;font-weight: 700;margin-bottom: 0; ">
                                            Public Hospitals Authority</p>
                                        <p style=" color: #000; font-size: 15px;font-weight: 700;margin: 5px 0 0; ">
                                           <?php echo $training_data[0]['title']?></p>
                                        <h4 style="font-size: 25px; margin: 10px; color:#dc1425;">Intensive Care Unit
                                        </h4>

                                    <!-- <?php 
                                    $icon1 = BASE_URL."assets/templates/template1/images/icon1.png";
                                    $icon2 = BASE_URL."assets/templates/template1/images/icon2.png";
                                    ?>  -->

                                         <img src="<?php echo showimage($icon1);?>" style="position: absolute;right: 26px;  top: 45px;width: 18%;" alt="">
                                         <img src="<?php echo showimage($img2);?>" style="position: absolute;right: 21px;  top: 175px;width: 22%;" alt="">
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%">
                                <tr>
                                    <td style="padding: 0 30px;">
                                        <h1 style="font-size: 35px;letter-spacing: 2.5px; margin-bottom: 0;">CERTIFICATE
                                        </h1>
                                        <p style="font-size: 30px;margin-top: 10px;">of participation</p>
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%">
                                <tr>
                                    <td style="padding: 0 15px;">
                                        <h1
                                            style="color:#36469f;font-family: Monotype Corsiva;margin-bottom: 0;font-size: 50px;">
                                            <?php echo $cust_data[0]['name']?> </h1>
                                        <p
                                            style="font-size: 14px;margin-top: 5px; color: #5d5d5d;padding-left: 70px;font-family: serif;">
                                            has Successfully completed the</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0 15px;">
                                        <p
                                            style="color:#000; margin-top:5px; font-size: 12px;font-weight: 800;letter-spacing: -.5px;">
                                            <?php echo $training_data[0]['title']?> </p>
                                        <p
                                            style="font-size: 14px;margin-top: 20px; color: #5d5d5d;padding-left: 125px;">
                                            CPD Unit <?php echo $training_data[0]['units']?></p>
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td style="padding: 0px 50px;">


                                        <?php 
                                    $singnature = BASE_URL."assets/templates/template1/images/singnature.png"; 
                                        ?>

                                        <img src="<?php echo showimage($singnature); ?>" style="margin-right: 20px" alt="">
                                        <img src="<?php echo showimage($singnature); ?>" alt="">
                                    </td>


                                </tr>
                                <tr>
                                    <td style="padding: 0px 50px;">
                                        <img src="<?php echo showimage($singnature); ?>" style="margin-left:  60px" alt="">

                                    </td>


                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td style="padding-top: 100px;">
                                    <?php 
                                    $img3 = BASE_URL."assets/templates/template1/images/logo.png";
                                    ?>  
                                    

                                    <a href="#"><img src="<?php echo showimage($img3);?>" alt=""></a>
                                    </td>
                                    <td style="padding: 60px 5px 20px;">
                                        <p style="color: #fff;  font-size: 12px; margin: 0 100px;"><?php echo date('M');?> <?php echo date('d');?>, <?php echo date('Y');?></p>
                                        <p style="color: #fff;  font-size: 12px; margin: 2px 90px;"><?php echo $training_data[0]['location']?></p>
                                        <P style="color: #dad780; font-size: 15px;font-weight: 600;margin: 10px 60px 0 40px;">CERT NO <?php echo $certificate_no;?></P>
                                         <?php 
                                            $img4 = BASE_URL."assets/templates/template1/barcode.png";
                                            ?> 

                                        <img src="<?php echo showimage($img4);?>" style="float: right;
                                           margin: -70px 15px 0 0;" alt="">
                                        <a href="#" style="text-decoration: none;color:#fff;font-size:12px;">
                                            <p style="text-align: right; margin: 25px 15px 0;">Validate this certificate at : ceonpoint.com/certificateverification</p>
                                        </a>   
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>