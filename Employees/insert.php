<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
       
    $fullname = $_POST['fullname']; 
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];



    $selectSql = "SELECT * FROM employees WHERE fullname = '$fullname'";
    $data = mysqli_query($conn,$selectSql);
    $numrows = mysqli_num_rows($data);


    if($numrows > 0){
        $myfile = fopen("Employee_ispresent.txt", "w") or die("Unable to open file!");
        $txt = "yes";
        fwrite($myfile, $txt);
    } else {
        $sqlinsert = "INSERT INTO employees (fullname,phone,email,address,designation,salary) VALUES ('$fullname','$phone','$email','$address','$designation','$salary')";
        $data = mysqli_query($conn,$sqlinsert);
        $myfile = fopen("Employee_ispresent.txt", "w") or die("Unable to open file!");
        $txt = "no";
        fwrite($myfile, $txt);
    }
    mysqli_close($conn);

?>