<?php
     $conn = mysqli_connect("localhost", "root", "", "demo");
     $name = $_POST['name'];
     $sqldelete = "DELETE FROM temp_sales_tbl WHERE name = '$name'";
     $runDelete = mysqli_query($conn, $sqldelete);
     mysqli_close($conn);
?>