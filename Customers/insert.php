<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
       
    $fullname = $_POST['fullname']; 
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $paid = $_POST['paid'];
    $unpaid = $_POST['unpaid'];
    



    $selectSql = "SELECT * FROM customer WHERE fullname = '$fullname'";
    $data = mysqli_query($conn,$selectSql);
    $numrows = mysqli_num_rows($data);


    if($numrows > 0){
        $myfile = fopen("Customer_ispresent.txt", "w") or die("Unable to open file!");
        $txt = "yes";
        fwrite($myfile, $txt);
    } else {
        $sqlinsert = "INSERT INTO customer (fullname,phone,email,Paid,Unpaid) VALUES ('$fullname','$phone','$email','$paid','$unpaid')";
        $data = mysqli_query($conn,$sqlinsert);
        $myfile = fopen("Customer_ispresent.txt", "w") or die("Unable to open file!");
        $txt = "no";
        fwrite($myfile, $txt);
    }
    mysqli_close($conn);

?>