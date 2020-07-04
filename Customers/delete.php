<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $name = $_POST['name'];
    $sqlDelete = "DELETE FROM customer where fullname = '$name'";
    $Data = mysqli_query($conn, $sqlDelete);
    mysqli_close($conn);
?>