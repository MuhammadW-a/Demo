<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "demo");
    if(isset($_SESSION['EMAIL'])){
        $emaill = $_SESSION['EMAIL'];
        if(isset($_GET['token'])){
            $token = $_GET['token'];
            $sqlUpdate = "UPDATE users SET status = 'active' WHERE token = '$token'";
            $data = mysqli_query($conn, $sqlUpdate);
            if($data){
                ?>
                    <script>
                        location.replace("Login");
                    </script>
                
                <?php
            }
        }
    } else {
                ?>
                    <script>
                        location.replace("Register");
                    </script>
                
                <?php
    }
    session_destroy();
?>