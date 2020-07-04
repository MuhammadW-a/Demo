<?php 
    $conn = mysqli_connect("localhost", "root", "", "demo");
    session_start();
    if(!isset($_SESSION['USERNAME_SESSION'])){
?>
<script>
    location.replace("../Login.php");
</script>
<?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Sales</title>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="sales"><i class="fas fa-money-bill-wave-alt"></i> Sales</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../menu"><i class="fas fa-th-list"></i> Main Menu<span
                        class="sr-only"></span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="#"><i class="fas fa-calendar-week"></i> Today's Sale</a>
            </li>
        </ul>
    </nav>
<br><br><br>

<div class="row">
    <div class="col-8">
    <div class = "container">
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th><i class="fas fa-sort-numeric-down"></i> Invoice</th>
                <th><i class="fas fa-signature"></i> Name</th>
                <th><i class="fas fa-money-bill-wave-alt"></i> Price Per Unit</th>
                <th><i class="fas fa-sort-numeric-down"></i> Bought Units</th>
                <th><i class="fas fa-money-bill-wave-alt"></i> Total</th>
                <th><i class="fas fa-clock"></i> Date</th>
            </tr>
        </thead>
        <tbody id="data">
        </tbody> 
    </table>
    </div>
    </div>

    <div class="col-4">
        <div class = "container">
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th><i class="fas fa-sort-numeric-down"></i> Invoice</th>
                    <th><i class="fas fa-money-bill-wave-alt"></i> Profit</th>
                </tr>
            </thead>
            <tbody id="data2">
            </tbody> 
        </table>
        </div>
    </div>
  </div>
</body>
</html>    

<script>
    $(document).ready(function () {
        setInterval(() => {
            $("#data").load("fetchDailySale.php");
        }, 1000);

        setInterval(() => {
            $("#data2").load("FetchDailyProfit.php");
        }, 1000);
    });
</script>
