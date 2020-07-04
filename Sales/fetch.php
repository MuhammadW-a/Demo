<?php








        $conn = mysqli_connect("localhost", "root", "", "demo");
        $sql = "SELECT * FROM temp_sales_tbl";
        $data = mysqli_query($conn, $sql);
        $sum = 0;
        while ($rowdata = mysqli_fetch_assoc($data)) {
        ?>
                <tr>
                    <td><?php echo $rowdata['Invoice']?></td>
                    <td><?php echo $rowdata['Name']?></td>
                    <td><?php echo $rowdata['Catagory']?></td>
                    <td><?php echo $rowdata['UnitWeight']?></td>
                    <td><?php echo $rowdata['Saleprice']?></td>
                    <td><?php echo $rowdata['BoughtUnit']?></td>
                    <td><?php echo $rowdata['Total']?></td>
                    <td><?php echo $rowdata['Saledate']?></td>
                    <td><button type="button" class="btn btn-info" onclick="viewDetails(  '<?php echo $rowdata['Invoice']; ?>'  ,  '<?php echo $rowdata['Name']; ?>'  ,  '<?php echo $rowdata['Catagory']; ?>' ,  '<?php echo $rowdata['UnitWeight']; ?>' , '<?php echo $rowdata['Saleprice']; ?>'  ,  '<?php echo $rowdata['BoughtUnit']; ?>' , '<?php echo $rowdata['Total']; ?>' , '<?php echo $rowdata['Saledate']; ?>'  )"><i class="far fa-eye"></i> View</button></td>
                    <td><button type="button" class="btn btn-warning" onclick="updateDetails(  '<?php echo $rowdata['Invoice']; ?>'  ,  '<?php echo $rowdata['Name']; ?>'  ,  '<?php echo $rowdata['Catagory']; ?>' ,  '<?php echo $rowdata['UnitWeight']; ?>' , '<?php echo $rowdata['Saleprice']; ?>'  ,  '<?php echo $rowdata['BoughtUnit']; ?>' , '<?php echo $rowdata['Total']; ?>' , '<?php echo $rowdata['Saledate']; ?>' )"><i class="fas fa-edit"></i> Update</button></td>
                    <td><button type="button" class="btn btn-danger" onclick="deleteDetails(   '<?php echo $rowdata['Invoice']; ?>'  ,  '<?php echo $rowdata['Name']; ?>'  ,  '<?php echo $rowdata['Catagory']; ?>' ,  '<?php echo $rowdata['UnitWeight']; ?>' , '<?php echo $rowdata['Saleprice']; ?>'  ,  '<?php echo $rowdata['BoughtUnit']; ?>' , '<?php echo $rowdata['Total']; ?>' , '<?php echo $rowdata['Saledate']; ?>'  )"><i class="fas fa-trash"></i> delete</button></td>
                </tr>
                <?php $sum = $sum + $rowdata['Total']?>
                





        <?php        
            }
        ?>    
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><i class="fas fa-money-bill-wave-alt"></i> Total = </td>
                <td style="color:orange; , font-weight : bold;" ><?php echo $sum?></td>     
                <?php
                    if($sum == 0){
                        $myfile = fopen("TotalBill.txt", "w") or die("Unable to open file!");
                        $txt = "0";
                        fwrite($myfile, $txt);
                    } else {
                        $myfile = fopen("TotalBill.txt", "w") or die("Unable to open file!");
                        $txt = "1";
                        fwrite($myfile, $txt);
                    }
                ?>





             </tr>
            