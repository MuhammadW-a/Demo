<?php
            $conn = mysqli_connect("localhost", "root", "", "demo");
            $sql = "SELECT * FROM employees";
            $data = mysqli_query($conn, $sql);
            while ($rowdata = mysqli_fetch_assoc($data)) {
?>
                    <tr>
                        <td><?php echo $rowdata['fullname']?></td>
                        <td><?php echo $rowdata['phone']?></td>
                        <td><?php echo $rowdata['email']?></td>
                        <td><?php echo $rowdata['address']?></td>
                        <td><?php echo $rowdata['designation']?></td>
                        <td><?php echo $rowdata['salary']?></td>
                        <td><button type="button" class="btn btn-info" onclick="viewDetails(  '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['address']; ?>' , '<?php echo $rowdata['designation']; ?>' , '<?php echo $rowdata['salary']; ?>' )"><i class="far fa-eye"></i> View</button></td>
                        <td><button type="button" class="btn btn-warning" onclick="updateDetails( '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['address']; ?>' , '<?php echo $rowdata['designation']; ?>' , '<?php echo $rowdata['salary']; ?>' )"><i class="fas fa-edit"></i> Update</button></td>
                        <td><button type="button" class="btn btn-danger" onclick="deleteDetails(  '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['address']; ?>' , '<?php echo $rowdata['designation']; ?>' , '<?php echo $rowdata['salary']; ?>' )"><i class="fas fa-trash"></i> delete</button></td>
                    </tr>
<?php        
                }
?>