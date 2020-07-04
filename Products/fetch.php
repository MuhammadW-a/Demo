<?php
        $conn = mysqli_connect("localhost", "root", "", "demo");
        $sql = "SELECT * FROM product";
        $data = mysqli_query($conn, $sql);
        while ($rowdata = mysqli_fetch_assoc($data)) {
        ?>
                <tr>
                    <td><?php echo $rowdata['name']?></td>
                    <td><?php echo $rowdata['catagory']?></td>
                    <td><?php echo $rowdata['Purchased_unit']?></td>
                    <td><?php echo $rowdata['unit']?></td>
                    <td><?php echo $rowdata['purchase_per_unit']?></td>
                    <td><?php echo $rowdata['sale_per_unit']?></td>
                    <td><?php echo $rowdata['status']?></td>
                    <td><?php echo $rowdata['discount_enable']?></td>
                    <td><?php echo $rowdata['expiry_Date']?></td>
                    <td><button type="button" class="btn btn-info" onclick="viewDetails(  '<?php echo $rowdata['name']; ?>'  ,  '<?php echo $rowdata['catagory']; ?>'  ,  '<?php echo $rowdata['Purchased_unit']; ?>' ,  '<?php echo $rowdata['unit']; ?>' , '<?php echo $rowdata['purchase_per_unit']; ?>'  ,  '<?php echo $rowdata['sale_per_unit']; ?>' , '<?php echo $rowdata['status']; ?>' ,  '<?php echo $rowdata['discount_enable']; ?>' , '<?php echo $rowdata['expiry_Date']; ?>' )"><i class="far fa-eye"></i> View</button></td>
                    <td><button type="button" class="btn btn-warning" onclick="updateDetails( '<?php echo $rowdata['name']; ?>'  ,  '<?php echo $rowdata['catagory']; ?>'  ,  '<?php echo $rowdata['Purchased_unit']; ?>' ,  '<?php echo $rowdata['unit']; ?>' , '<?php echo $rowdata['purchase_per_unit']; ?>'  ,  '<?php echo $rowdata['sale_per_unit']; ?>' , '<?php echo $rowdata['status']; ?>' ,  '<?php echo $rowdata['discount_enable']; ?>' , '<?php echo $rowdata['expiry_Date']; ?>'  )"><i class="fas fa-edit"></i> Update</button></td>
                    <td><button type="button" class="btn btn-danger" onclick="deleteDetails(  '<?php echo $rowdata['name']; ?>'  ,  '<?php echo $rowdata['catagory']; ?>'  ,  '<?php echo $rowdata['Purchased_unit']; ?>' ,  '<?php echo $rowdata['unit']; ?>' , '<?php echo $rowdata['purchase_per_unit']; ?>'  ,  '<?php echo $rowdata['sale_per_unit']; ?>' , '<?php echo $rowdata['status']; ?>' ,  '<?php echo $rowdata['discount_enable']; ?>' , '<?php echo $rowdata['expiry_Date']; ?>'  )"><i class="fas fa-trash"></i> delete</button></td>
                </tr>
        <?php        
            }


            function fetchDataToJson(){
                $conn2 = mysqli_connect("localhost", "root", "", "demo");
                $sql2 = "SELECT * FROM catagory";
                $data2 = mysqli_query($conn2, $sql2);
        
                $Customer_Data_Array = array();
        
                while ($rowdata = mysqli_fetch_array($data2)) {
                    $Customer_Data_Array[] = array(
                        'name' => $rowdata["CatagoryName"]
                    );
                }
                return json_encode($Customer_Data_Array);
            } // end of fetchDataToJson
            $filename = "Catagories.json";
            file_put_contents($filename, fetchDataToJson());














?>