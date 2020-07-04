<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    
    
    $fullname = $_POST['fullname']; 
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];
    
    $sqlUpdate = "UPDATE employees SET phone = '$phone', email = '$email', address = '$address', designation = '$designation' , salary = '$salary' WHERE fullname = '$fullname'";
    $updatedData = mysqli_query($conn, $sqlUpdate);

    if ($updatedData) {
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