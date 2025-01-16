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

<body>   

    <table width="700px" style="font-family: Arial, Helvetica, sans-serif; padding: 10px; background: #8b8889; margin: 0 auto;">
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
                                    <td style="text-align:center; padding:0px;" colspan="2">

                                        <p style=" color: #000; font-size: 15px;font-weight: 700;margin-bottom: 0; ">
                                            Public Hospitals Authority</p>
                                        <p style=" color: #000; font-size: 15px;font-weight: 700;margin: 5px 0 0; ">
                                       Princess Margaret Hospital</p>
                                        <h4 style="font-size: 25px; margin: 10px 0 0 0; color:#dc1425;">Intensive Care Unit</h4>

                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 30px;"  align="left">
                                        <h1 style="font-size: 35px;letter-spacing: 2.5px; margin-bottom: 0;">CERTIFICATE
                                        </h1>
                                        <p style="font-size: 30px;margin-top: 10px;">of Participation</p>
                                    </td>
                                    <td align="right">
                                        <?php 
                                            $icon1 = BASE_URL."assets/templates/template1/images/icon1.png";
                                            // $icon2 = BASE_URL."assets/templates/template1/images/icon2.png";
                                        ?> 

                                         <img src="<?php echo showimage($icon1);?>" style="" alt="">
                                         <!-- <img src="<?php //echo showimage($img2);?>" style="" alt=""> -->
                                    </td>
                                </tr>
                            </table>

                            

                            <table style="width: 100%">
                                <tr>
                                    <td style="padding: 0 15px;">
                                        <h1
                                            style="color:#36469f;font-family: Monotype Corsiva;margin-bottom: 0;font-size: 50px;">
                                            <?php echo ucwords($cust_data[0]['name']);?> </h1>
                                        <p
                                            style="color:#000; font-weight: 800;letter-spacing: -.5px; font-size: 12px;margin-top: 5px; color: #5d5d5d;padding-left: 70px;font-family: serif;">
                                            has Successfully completed the</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0 15px;">
                                        <p
                                            style="color:#000; margin-top:5px; font-size: 12px;font-weight: 800;letter-spacing: -.5px;">
                                            <?php echo $training_data[0]['title']?> 

                                        <br>
                                        <span style="padding-left: 125px;">    
                                        <?php echo date('M');?> <?php echo date('d');?>, <?php echo date('Y');?>
                                        </span>

                                        <br> 
                                        <span style="padding-left: 37px;">    
                                        <?php echo $training_data[0]['location']?>
                                        </span>
                                        <br> 
                                        <br> 

                                        <span style="padding-left: 125px;">  
                                        CPD Unit <?php echo $training_data[0]['units']?>
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

                           
 <table style="width:385px; text-align: center;" >
                                <tr>
                                    <td>
                                        <img src="<?php echo showimage($singnature); ?>" style="margin: 0 10px" alt="">
                                        <p style="margin: 0;font-size: 10px; font-weight: bold;">Patsy Morris, DPNO</br>Acting Principle Nursing Officer</p>
                                    </td>

                                    <td>  
                                        <img src="<?php echo showimage($singnature1); ?>" alt="" style="margin: 0 10px">
                                        <p style="margin: 0;font-size: 10px; font-weight: bold;">Malisa Hinsey-Trotman, RN</br> Chairperson - ICU Symposium 2019</p>
                                    </td>
                                </tr>
                               <!--  <tr>
                                    <td colspan="2" align="center">
                                        <img src="<?php //echo showimage($singnature2); ?>" style="margin: 0 10px" alt="">
                                        <p style="margin: 0;font-size: 10px; font-weight: bold;">Persephone Munnings, DNP, RN-BC, CM</br> Manager, Continuing Nursing Education</p>
                                    </td>
                                </tr> -->
                            </table>

                            
                            <!-- singnature section code commented -->


                           


                            <table style="width: 100%;">
                                <tr>
                                    <td style="vertical-align: bottom;padding-bottom: 42px;">
                                        <?php 
                                        $img3 = BASE_URL."assets/templates/template1/images/logo.png";
                                        ?>  
                                         <a href="#"><img src="<?php echo showimage($img3);?>" alt=""></a>
                                    </td>
                                    
                                    <td style="padding:0 30px 42px" align="right">
                                        <span>
                                        <?php 
                                            $img4 = BASE_URL."assets/templates/template1/barcode.png";
                                            ?> 
                                            <img src="<?php echo showimage($img4);?>" style="text-align: right;" alt="">
                                        </span>
                                       
                                          <p style="color: #fff;  font-size: 12px; ">CERTIFICATE NUMBER:</p>  
                                        <P style="color: #dad780; font-size: 15px;font-weight: 600;">   <?php echo $certificate_no;?></P>
                                         <!-- <?php 
                                            $img4 = BASE_URL."assets/templates/template1/barcode.png";
                                            ?> 

                                        <img src="<?php echo showimage($img4);?>" style="float: right;
                                           margin: -70px 15px 0 0;" alt=""> -->
                                        <a href="#" style="text-decoration: none;color:#fff;font-size:12px;">
                                            <p style="text-align: right; margin: 25px 0px 0 0; width: 252px;">Validate this certificate at : http://www.ceonpoint.com/certificatevalidation</p>
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