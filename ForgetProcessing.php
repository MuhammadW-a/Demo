<?php
    session_start();     
     $conn = mysqli_connect("localhost", "root", "", "demo");
     $email = $_POST['email'];
     $password = $_POST['password'];
     $cpassword = $_POST['cpassword'];

    $sqlselect = "SELECT * FROM users WHERE email = '$email'";
    $FireSelect = mysqli_query($conn, $sqlselect);

    $ROws = mysqli_num_rows($FireSelect);

    if($ROws > 0){


        $myfile = fopen("EmailPresent.txt", "w") or die("Unable to open file!");
        $txt = "yes";
        fwrite($myfile, $txt);

        $_SESSION['SESS_EMAIL'] = $email;
        $_SESSION['SESS_PASS'] = $password;
        $_SESSION['SESS_CPASS'] = $cpassword;
        $subject = "Password Recovery";
        $body = "Click Here To Change Password http://localhost/Demo/RecMail.php";
        $header = "From: pythoning7@gmail.com";
        mail($email, $subject, $body, $header);

        
    } else {
        $myfile = fopen("EmailPresent.txt", "w") or die("Unable to open file!");
        $txt = "no";
        fwrite($myfile, $txt);
    }





?>