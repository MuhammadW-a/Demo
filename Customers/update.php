<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");

    $fullname = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $paid = $_POST['paid'];
    $unpaid = $_POST['unpaid'];
    
    $sqlUpdate = "UPDATE customer SET phone = '$phone', email = '$email', Paid = '$paid', Unpaid = '$unpaid' WHERE fullname = '$fullname'";
    $updatedData = mysqli_query($conn, $sqlUpdate);

    if ($sqlUpdate) {
        $myfile = fopen("Update_Employee_status.txt", "w") or die("Unable to open file!");
        $txt = "yes";
        fwrite($myfile, $txt);
    } else {
        $myfile = fopen("Update_Employee_status.txt", "w") or die("Unable to open file!");
        $txt = "no";
        fwrite($myfile, $txt);
    }
    mysqli_close($conn);
?>