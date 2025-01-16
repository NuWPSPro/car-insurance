<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Certificate of title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head><body>
<div id="carTicket">
    <?php 
        $sinature1 = base_url('assets/images/sinature.png'); 
        $sinature2 = base_url('assets/images/sinature.png'); 
        $sinature3 = base_url('assets/images/sinature.png');
        $ticketbg = base_url('assets/images/car-bg4.jpg');
        $arrowimage = base_url('assets/images/bahamas.jpg');
        //$qrimage = base_url('assets/qrcode/'.$details->reg_qr_code);
    ?>
    <div style="width:100%; height:900px; padding:20px; text-align:center; border: 10px solid #787878">
        <div style="width:100%; height:850px; padding:20px; text-align:center; border: 5px solid #787878">
            <span style="font-size:50px; font-weight:bold">Car Insurance Certificate</span>
            <br><br>
            <span style="font-size:15px">This is to CERTIFY: that the vehical with the following descriptions,<br>Insured with <a href="<?=base_url(); ?>">Car Inurance Compnay</a>.</span>
            <!-- <span style="font-size:25px"><i></i></span> -->
            <br><br>
            <span style="font-size:10px; text-align:center;">
            <table style="width: 540px;margin: 0 auto;margin-top: 0px; margin-bottom: 60px;">
                <tr>
                    <th>Insurance Number</th>
                    <td><?=$insurance_no; ?></td>
                </tr>
                <tr>
                    <th>Assured</th>
                    <td><?=$owner; ?></td>
                </tr>
                <tr>
                    <th>Make</th>
                    <td><?=$make; ?></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><?=$model; ?></td>
                </tr>
                <tr>
                    <th>VIN</th>
                    <td><?=$vin; ?></td>
                </tr>
                <tr>
                    <th>Issue Date</th>
                    <td><?=$issue_date; ?></td>
                </tr>
                <tr>
                    <th>Validity</th>
                    <td><?=$validity; ?></td>
                </tr>
            </table>
            </span><br/><br/>
            <span style="font-size:20px">This certification is issued upon the request of the assured/client for insurance clain purpose.</b></span><br/><br/>
            <span style="font-size:25px"><i>Insurance Number </i>: <?=$insurance_no; ?></span><br>
            
            <span style="font-size:30px"></span>
            <table style="width: 540px;margin: 0 auto;margin-top: 0px; margin-bottom: 60px;">
                <tr>
                    <td
                        style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                        <img src="<?php echo showimage($sinature1); ?>" alt="" style=" width: 57px;">
                        <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan
                        </p>
                        <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                    </td>
                    <td
                        style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                        <img src="<?php echo showimage($sinature2); ?>" alt="" style=" width: 57px;">
                        <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan
                        </p>
                        <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                    </td>
                    <td
                        style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                        <img src="<?php echo showimage($sinature3); ?>" alt="" style=" width: 57px;">
                        <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan
                        </p>
                        <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                    </td>

                </tr>

            </table>
        </div>
    </div>
    <?php 
        function showimage($image){
            $type = pathinfo($image, PATHINFO_EXTENSION);
            $data = file_get_contents($image);
            $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $logo;
        }
    ?>
</div>
</body></html>