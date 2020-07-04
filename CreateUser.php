<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

    $token = bin2hex(random_bytes(15));


    $sqlCheckUser = "SELECT * from users where email = '$email'";
    $data = mysqli_query($conn, $sqlCheckUser);
    $records = mysqli_num_rows($data);

    if ($records > 0) {
        $myfile = fopen("User_Presence.txt", "w") or die("Unable to open file!");
        $txt = "yes";
        fwrite($myfile, $txt);
    } else {
        $myfile = fopen("User_Presence.txt", "w") or die("Unable to open file!");
        $txt = "no";
        fwrite($myfile, $txt);

        $insertUserSql = "INSERT INTO users(username, phone, email, password, cpassword, token, status) VALUES ('$username','$phone','$email','$pass','$cpass','$token','inactive')";
        $dataOnInsert = mysqli_query($conn, $insertUserSql);
        if ($dataOnInsert) {
            
            $subject = "Email Activation";
            $body = "Hi, $username. Click Here to activate your Account http://localhost/Demo/activate.php?token=$token";
            $header = "From: pythoning7@gmail.com";
            $_SESSION['EMAIL'] = $email;
            
            mail($email, $subject, $body, $header);
            
        } else {
            //data is not inserted   
        }
    }
?>

