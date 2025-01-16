 
<table class="table table-striped table-bordered">
                <tr>
                    <th>S.No</th>
                    <th>Course Title</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    
                    <th>Buyer</th> 
                    <th>Country</th> 
                    <th>Receipt No.</th> 
                    <th>Channel</th> 
					<th>Purchase Date</th> 

                </tr>
                <?php 
                $sum = 0;
                foreach ($totalData as $key => $value) {
                  //  echo '<pre>';
                   // print_r($value);
                    $sum = $sum+$value['amount'] * $value['quantity'];
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $key+1;?>
                        </td>
                        <td>
                            <?php 
                            $datacourse = $this->user->get_record_by_field_name_all_record('tbl_course','id',$value['item_name']);
                                //echo course_title '<pre>'; print_r($datacourse);
                            echo $datacourse[0]['course_title'];?>
                        </td>
                        <td class="text-center">
                            <?php echo $value['amount'];?>
                        </td>
                        <td class="text-center">
                            <?php echo $value['quantity'];?>
                        </td>
                        <td class="text-center">
                            <?php echo $value['amount'] * $value['quantity'];?>
                        </td>
						 <td class="text-center">
                            <?php echo $value['name'];?>
                        </td>
						<td class="text-center">
                            <?php echo $value['countries_name']?>
                        </td>
						 <td class="text-center">
                            <?php echo $value['txn_id'];?>
                        </td>
						 
						 <td class="text-center">
                            <?php echo $value['purchase_device']?>
                        </td>
                        <td>
                            
                            <?php echo date("jS F, Y", strtotime($value['added'])); ?>
                           
                        </td> 

                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4"><strong>TOTAL</strong> </td>
                        <td class="text-center"><strong>$<?php echo $sum;?></strong></td>
                        <td>&nbsp;</td>
                    </tr>
                </table>