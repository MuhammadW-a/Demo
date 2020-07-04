<?php
    if(!isset($_SESSION['SESS_EMAIL'])){
?>
    <script>
        location.replace("Login.php");
    </script>
<?php
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style type="text/css">
        body {
            background-image: url("Register_Background.jpg");
            background-size: cover;
            background-attachment: fixed;
        }
    </style>    
</head>
<body>
    <h5 id = "Message" class = "text-center"></h5>
</body>
</html>
<?php
    session_start();     
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $email = $_SESSION['SESS_EMAIL'];
    $password = $_SESSION['SESS_PASS'];
    $cpassword = $_SESSION['SESS_CPASS'];
    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);
    $sqlUpdate = "UPDATE users SET password = '$pass' , cpassword = '$cpass' WHERE email = '$email'";
    $FIREUpdate = mysqli_query($conn, $sqlUpdate);

    if ($FIREUpdate) {
        ?>
        <script>
            $("#Message").html("Updated Successfully");
        </script>
        <?php
    } else {
        ?>
        <script>
            $("#Message").html("Not Updated");
        </script>
        <?php
    }
    session_destroy();
?>