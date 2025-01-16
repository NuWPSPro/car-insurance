<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEONPOINT Unit</title>


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

<body>   

    <table width="700px" style="font-family: Arial, Helvetica, sans-serif; margin: 0 auto;">
        <tr>
            <td>
                <table
    
                    <?php 
                    $img3 = BASE_URL."assets/templates/template1/images/bg-img.jpg";
                    ?>  

                    style="background-image:url('<?php echo showimage($img3);?>'); background-repeat: no-repeat; width: 100%; height:800px;">
                    <tr>
                        <td>
                            <table style="width:485px">
                                <tr>
                                    <td style="padding:150px 30px 0 50px" align="left">
                                        <h1 style="font-size: 35px;letter-spacing: 2.5px; margin-bottom: 0;">CERTIFICATE
                                        </h1>
                                        <p style="font-size: 30px;margin-top: 5px;">of Participation</p>
                                    </td>
                                </tr>
                            </table>

                            

                            <table style="width:435px;text-align: center;">
                                <tr>
                                    <td style="padding: 0 15px;">
                                        <h1 style="color:#36469f;font-family: Monotype Corsiva;margin-bottom: 0;font-size: 45px;">
                                            <?php echo ucwords($cust_data[0]['name']);?> </h1>
                                        <p style="font-size: 14px;margin-top: 5px; font-family: serif;">
                                            has successfully completed the</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0 15px;">
                                        <p
                                            style="color:#000; margin-top:5px; font-size: 12px;font-weight: 800;letter-spacing: -.5px;">
                                            <?php echo $training_data[0]['title']?> 

                                        <br>
                                        <span>    
                                        <?php echo date("jS \of F Y", strtotime($training_data[0]['end_date'])); ?>
                                        </span>

                                        <br> 
                                        <span>    
                                        <?php echo $training_data[0]['location']?>
                                        </span>
                                        <br> 
                                        <br> 

                                        <span>  
                                        CE Units <?php echo $training_data[0]['units']?>
                                        </span>

                                        </p> 


                                    </td>
                                </tr>
                            </table>



                        <?php 
                        $singnature = BASE_URL."assets/templates/template1/images/singnature.png"; 
                        $singnature1 = BASE_URL."assets/templates/template1/images/singnature1.png";
                        $singnature2 = BASE_URL."assets/templates/template1/images/singnature2.png"; 
                        ?>

                            <!-- singnature section code commented -->

                           
                           <table style="width:410px; text-align: center; " align="left">
                                <tr>
                                    <td>
                                        <img src="<?php echo showimage($singnature); ?>" style="margin: 0 10px" alt="">
                                        <p style="margin: 0;font-size: 10px; font-weight: bold;">Patsy Morris, DPNO</p>
                                        <p style="margin: 0;font-size: 10px; font-weight: bold;"> Acting Principal Nursing Officer</p>
                                    </td>

                                    <td>  
                                        <img src="<?php echo showimage($singnature1); ?>" alt="" style="margin: 0 10px">
                                        <p style="margin: 0;font-size: 10px; font-weight: bold;">Malisa Hinsey-Trotman, RN</p>
                                        <p style="margin: 0;font-size: 10px; font-weight: bold;"> Chairperson - ICU Symposium 2019</p>
                                    </td>
                                </tr>
                                 <tr>
                                    <td colspan="2" align="center">
                                        <img src="<?php echo showimage($singnature2); ?>" style="margin: 0 10px" alt="">
                                        <p style="margin: 0;font-size: 10px; font-weight: bold;">Persephone Munnings, DNP, RN-BC, CM</p>
                                        <p style="margin: 0;font-size: 10px; font-weight: bold;">  Manager, Continuing Nursing Education</p>
                                    </td>
                                </tr>
                            </table>

                            
                            <!-- singnature section code commented -->


                           


                            <table style="width:260; padding-top: 0" align="right">
                                <tr>
                                   
                                    
                                    <td style="padding:0 50px 0 0" align="right">
                                        <span>
                                        <?php 
                                            $img4 = BASE_URL."assets/templates/template1/barcode.png";
                                            ?> 
                                            <img src="<?php echo showimage($img4);?>" style="text-align: right;" alt="">
                                        </span>
                                       
                                        <p style="color: #fff;  font-size: 12px; ">CERTIFICATE NUMBER:</p>  
                                        <P style="color: #dad780; font-size: 15px;font-weight: 600;">   <?php echo $certificate_no;?></P>
                                            
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