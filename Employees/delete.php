<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $fullname = $_POST['fullname'];
    $sqlDelete = "DELETE FROM employees WHERE fullname = '$fullname'";
    $Data = mysqli_query($conn, $sqlDelete);
    mysqli_close($conn);
?>
