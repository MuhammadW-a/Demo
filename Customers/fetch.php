<?php
            $conn = mysqli_connect("localhost", "root", "", "demo");
            $sql = "SELECT * FROM customer";
            $data = mysqli_query($conn, $sql);
            while ($rowdata = mysqli_fetch_assoc($data)) {
?>
                    <tr>
                        <td><?php echo $rowdata['fullname']?></td>
                        <td><?php echo $rowdata['phone']?></td>
                        <td><?php echo $rowdata['email']?></td>
                        <td><?php echo $rowdata['Paid']?></td>
                        <td><?php echo $rowdata['Unpaid']?></td>
                        <td><button type="button" class="btn btn-info" onclick="viewDetails(  '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['Paid']; ?>' , '<?php echo $rowdata['Unpaid']; ?>' )"><i class="far fa-eye"></i> View</button></td>
                        <td><button type="button" class="btn btn-warning" onclick="updateDetails( '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['Paid']; ?>' , '<?php echo $rowdata['Unpaid']; ?>' )"><i class="fas fa-edit"></i> Update</button></td>
                        <td><button type="button" class="btn btn-danger" onclick="deleteDetails(  '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['Paid']; ?>' , '<?php echo $rowdata['Unpaid']; ?>' )"><i class="fas fa-trash"></i> delete</button></td>
                    </tr>
<?php        
                }
?>