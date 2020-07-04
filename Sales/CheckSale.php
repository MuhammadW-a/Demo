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
    <title>Check Sales Day</title>
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
        <a class="navbar-brand" href="sales.php"><i class="fas fa-money-bill-wave-alt"></i> Sales</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../menu"><i class="fas fa-th-list"></i> Main Menu<span class="sr-only"></span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="#"><i class="fas fa-calendar-week"></i> Check Sale Of Day</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="checkSaleMonth"><i class="fas fa-calendar-week"></i> Check Sale Of Month</a>
            </li>

        </ul>
    </nav>
<br><br><br>

        <div class="container">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="date" id = "Datee" class="form-control">
            </div>
            <button type="button" class="btn btn-success" id = "ShowData">View Details</button>
            <br><br>
            <form action="PrintDaySale" method="post">
                <button type="submit" class="btn btn-light" id = "PrintData">Print Details</button>
            </form>
            <br><br>
        </div>




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

$("#Datee").change(function(){
    $("#PrintData").attr("disabled", true);
});

    $("#PrintData").attr("disabled", true);
    $("#ShowData").click(function () {
        var datex = $("#Datee").val();
        if(datex == ''){
            alert("Please Select Date");

        } else {
            $.ajax({
            url : "ProcessCheckSale.php",
            type : "POST",
            data : {
                datax : datex
            },
                success : function () {
                $.get('date_to_check_sale.txt', function (data) {
                    if(data == ''){
                        alert("No Sales Found At This Date");
                    } else { 
                        $("#PrintData").attr("disabled", false);
                    //    setInterval(() => {
                            $("#data").load("Check_Sale_Date.php");
                    //    }, 1000);
                     //   setInterval(() => {
                            $("#data2").load("Check_Profit_Date.php");
                    //    }, 1000);
                    }
                });
                }
            });
        }
    });


   $("#PrintData").click(function(){
    var datex = $("#Datee").val();
        if(datex == ''){
            alert("Please Select Date");
        } else {
            alert("ok");
        }
   });



</script>