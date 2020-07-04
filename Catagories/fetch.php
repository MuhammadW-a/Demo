<?php
         $conn = mysqli_connect("localhost", "root", "", "demo");
         $sql = "SELECT * FROM catagory";
         $data = mysqli_query($conn, $sql);
         while ($rowdata = mysqli_fetch_assoc($data)) {
?>
                 <tr>
                     
                     <td><?php echo $rowdata['CatagoryName']?></td>
                     <td><?php echo $rowdata['CatagoryDescription']?></td>
                     <td><button type="button" class="btn btn-info" onclick="viewDetails(  '<?php echo $rowdata['CatagoryName']; ?>'  ,  '<?php echo $rowdata['CatagoryDescription']; ?>' )"><i class="far fa-eye"></i> View</button></td>
                     <td><button type="button" class="btn btn-warning" onclick="updateDetails( '<?php echo $rowdata['CatagoryName']; ?>'  ,  '<?php echo $rowdata['CatagoryDescription']; ?>'  )"><i class="fas fa-edit"></i> Update</button></td>
                 </tr>
<?php        
             }
?>