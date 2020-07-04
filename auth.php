<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $SqlSelect = "SELECT * FROM users WHERE email = '$email'";
    $selectData = mysqli_query($conn, $SqlSelect);
    $NumRowCount = mysqli_num_rows($selectData);

    if($NumRowCount > 0){
        $myfile = fopen("Check_User_For_Login.txt", "w") or die("Unable to open file!");
        $txt = "yes";
        fwrite($myfile, $txt);


        $rowdata = mysqli_fetch_assoc($selectData);
        $emaill = $rowdata['email'];
        $passwordd = $rowdata['password'];
        $username = $rowdata['username'];
        $status = $rowdata['status'];
        if ($status == 'active') {
            $myfile1 = fopen("Verified_Email.txt", "w") or die("Unable to open file!");
            $txt1 = "yes";
            fwrite($myfile1, $txt1);
            $password_confirmation = password_verify($password, $passwordd);
            if($password_confirmation){
                $myfile2 = fopen("Login_Password_Match.txt", "w") or die("Unable to open file!");
                $txt2 = "yes";
                fwrite($myfile2, $txt2);
                $_SESSION['USERNAME_SESSION'] = $username;         
                $_SESSION['USEREMAIL_SESSION'] = $emaill;

            } else {
                $myfile2 = fopen("Login_Password_Match.txt", "w") or die("Unable to open file!");
                $txt2 = "no";
                fwrite($myfile2, $txt2);
            }
        } else {
            $myfile1 = fopen("Verified_Email.txt", "w") or die("Unable to open file!");
            $txt1 = "no";
            fwrite($myfile1, $txt1);
        }
    } else {
        //verify password
        $myfile = fopen("Check_User_For_Login.txt", "w") or die("Unable to open file!");
        $txt = "no";
        fwrite($myfile, $txt);
        
    }
?>