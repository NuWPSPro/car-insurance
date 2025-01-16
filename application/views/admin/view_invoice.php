
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap&subset=cyrillic,latin-ext,vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">

<div style="background-color: #0e0e0e; font-family: 'Poppins', sans-serif;    padding: 0;margin: 0;box-sizing: border-box;">

    <table style="width: 650px;margin: 0 auto;background:#fff; padding:15px; display:block;" >
        <tr>
            <td>
                <table style="width: 100%;padding:15px; display: inline-block; border:1px solid #000;">
                  <tr>
                      <td>
                          <table style="width:100%">
                            <tr>
                                <td>
                                    <a href="#"><img src="https://ceonpoint.com/assets/images/logo.png" width="250px"  alt=""></a>
                                </td>
                                <td style="text-align: right;font-size: 30px;font-weight: 600;text-transform: uppercase;color: #4472c4;">
                                    invoice
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">
                                    <ul style="padding-left: 0px;list-style: none;">
                                        <li style="display: flex;font-size: 14px;font-weight: 400;color: #4a4949;padding-top: 10px;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Add:</strong>
                                            21 Mohawk Trail, Greenfield, Ma 01301, United States
                                        </li>
                                        <li style="display: flex;font-size: 14px;font-weight: 400;color: #4a4949;padding-top: 10px;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Phone:</strong>
                                            +(954) 988-0710<br>+(242) 565-9121
                                        </li>
                                        <li style="display: flex;font-size: 14px;font-weight: 400;color: #4a4949;padding-top: 10px;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Email:</strong>
                                            <a href="#">team@ceonpoint.com</a>
                                        </li>
                                    </ul>
                                </td>
                                <td style="width: 50%;">
                                    <ul style="padding-left: 0px;list-style: none;">
                                        <li style="display: block; text-align: right;font-size: 15px;font-weight: 400;color: #4a4949;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Date:</strong>
                                            <p style="display: inline-block; font-size: 13px;font-weight: 600;margin: 0;border: 1px solid #4472c4;padding: 4px 15px;min-width: 125px;text-align: center;"><?php echo $invoice->date; ?></p>
                                        </li>
                                        <li style="display: block; text-align: right;font-size: 15px;font-weight: 400;color: #4a4949;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Invoice #:</strong>
                                            <p style="display: inline-block; font-size: 13px;font-weight: 600;margin: 0;border: 1px solid #4472c4;padding: 4px 15px;min-width: 125px;text-align: center;">[<?php echo $invoice->invoice_number; ?>]</p>
                                        </li>
                                        <li style="display: block; text-align: right;font-size: 15px;font-weight: 400;color: #4a4949;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Customer Id:</strong>
                                            <p style="display: inline-block; font-size: 13px;font-weight: 600;margin: 0;border: 1px solid #4472c4;padding: 4px 15px;min-width: 125px;text-align: center;">[<?php echo $invoice->user_id; ?>]</p>
                                        </li>
                                        <li style="display: block; text-align: right;font-size: 15px;font-weight: 400;color: #4a4949;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Due Date:</strong>
                                            <p style="display: inline-block; font-size: 13px;font-weight: 600;margin: 0;border: 1px solid #d2d9ec;padding: 4px 15px;background:#d2d9ec;min-width: 125px;text-align: center;"><?php echo $invoice->due_date; ?></p>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <h2 style="font-size: 15px;margin-bottom: 15px;padding: 10px;background: #3b4e87;color: #fff;">BILL TO</h2>
                                    <ul style="padding-left: 0px;list-style: none;">
                                        <li style="display: flex;font-size: 15px;font-weight: 400;color: #4a4949;padding-bottom: 10px;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Name:</strong>
                                             <?php echo $invoice->recipient; ?>
                                        </li>
                                        <li style="display: flex;font-size: 15px;font-weight: 400;color: #4a4949;padding-bottom: 10px;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Position:</strong>
                                            <?php echo $invoice->position; ?>
                                        </li>
                                        <li style="display: flex;font-size: 15px;font-weight: 400;color: #4a4949;padding-bottom: 10px;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Company Name:</strong>
                                            <?php echo $invoice->company_name; ?>
                                        </li>
                                        <li style="display: flex;font-size: 15px;font-weight: 400;color: #4a4949;padding-bottom: 10px;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Street Address:</strong>
                                            <?php echo $invoice->address; ?>
                                        </li>
                                      <!--   <li style="display: flex;font-size: 15px;font-weight: 400;color: #4a4949;padding-bottom: 10px;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">City, ST ZIP</strong>
                                            United States
                                        </li> -->
                                    <?php if($invoice->phone !=''){ ?>
                                        <li style="display: flex;font-size: 15px;font-weight: 400;color: #4a4949;padding-bottom: 10px;">
                                            <strong style="font-size: 14px;padding-right: 8px;color: #000;">Phone</strong>
                                            <?php echo $invoice->phone; ?>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <th style="font-size: 14px;background: #4472c4;color: #fff;padding: 6px;">No.</th>
                                <th style="font-size: 14px;background: #4472c4;color: #fff;padding: 6px;">Item Decription</th>
                                <th style="font-size: 14px;background: #4472c4;color: #fff;padding: 6px;">Unit </th>
                                <th style="font-size: 14px;background: #4472c4;color: #fff;padding: 6px;">Unit Price</th>
                                <th style="font-size: 14px;background: #4472c4;color: #fff;padding: 6px;">Qty</th>
                                <th style="font-size: 14px;background: #4472c4;color: #fff;padding: 6px;">Amount</th>
                            </tr>

                        <?php $num = 1; 
                        foreach($items as $item){ ?>
                            <tr style="background: #cfd5ea;">
                                <td style="font-size: 14px;padding: 5px 15px;"><?php echo $num; ?>.</td>
                                <td style="font-size: 14px;padding: 5px 15px;"><?php echo $item->item_description;?></td>
                                <td style="font-size: 14px;padding: 5px 15px;"><?php echo $item->unit;?></td>
                                <td style="font-size: 14px;padding: 5px 15px;">$<?php echo $item->unit_price;?></td>
                                <td style="font-size: 14px;padding: 5px 15px;"><?php echo $item->quantity;?></td>
                                <td style="font-size: 14px;padding: 5px 15px;">$<?php echo $item->amount;?></td>
                            </tr>
                        <?php $num++; } ?>
                        </table>

                        <table style="width: 100%; background: #e6e6e6;padding: 20px;margin-top: 15px;">
                            <tr>
                                <td style="font-size: 14px;text-align: end;padding: 10px;">
                                    <p style="margin-bottom: 5px;" >Sub Total:   <strong style=" display: inline-block; font-size: 15px;color: #000; margin-left: 10px; min-width: 100px;">$<?php echo $invoice->amount; ?></strong></p>
                                    <p style="margin-bottom: 5px;">Discount:    <strong style=" display: inline-block; font-size: 15px;color: red; margin-left: 10px; min-width: 100px;">$<?php echo $invoice->discount; ?></strong></p>
                                    <p style="margin-bottom: 5px;">Tax:         <strong style=" display: inline-block; font-size: 15px;color: green; margin-left: 10px; min-width: 100px;">$<?php echo $invoice->tax; ?></strong></p>
                                    <p>Total:       <strong style=" display: inline-block; font-size: 18px;color: green; margin-left: 10px; min-width: 100px;" >$<?php echo $invoice->amount; ?></strong></p>
                                    <p>Please make all cheques payable to <?php echo $invoice->issued_to; ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px;text-align: center; background: #fff; padding: 10px;">
                                    <p>If you have questions about this invoice please contact us:  +(954) 988-0710 +(242) 565-9121 team@ceonpoint.com</p>
                                    <p style="font-size: 14px;font-weight: 600;">Thank you for patronizing our services.</p>
                                </td>
                            </tr>
                           

                        </table>


                      </td>
                  </tr>
                   
                </table>
            </td>
        </tr>

    </table>


</div>
