<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $CatagoryName = $_POST['name'];
    $CatagoryDescription = $_POST['description'];
    $updatesql = "UPDATE catagory SET CatagoryName = '$CatagoryName' , CatagoryDescription = '$CatagoryDescription' WHERE CatagoryName = '$CatagoryName'";
    $updatedDataCatagory = mysqli_query($conn, $updatesql);    
    mysqli_close($conn);
?>