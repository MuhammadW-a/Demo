<?php 
    $conn = mysqli_connect("localhost", "root", "", "demo");
    session_start();
    if(!isset($_SESSION['USERNAME_SESSION'])){
?>
<script>
    location.replace("../Login");
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
    <title>Check Sales Monthly</title>
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
                <a class="nav-link" href="../menu"><i class="fas fa-th-list"></i> Main Menu<span class="sr-only"></span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="CheckSale"><i class="fas fa-calendar-week"></i> Check Sale Of Day</a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="#"><i class="fas fa-calendar-week"></i> Check Sale Of Month</a>
            </li>

        </ul>
    </nav>
<br><br><br>

        <div class="container">
        

        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Select Year</label>
        </div>
        <select class="custom-select" id="yearselect">
            <option selected>Choose...</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
        </select>
        </div>




        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Select Month</label>
        </div>
        <select class="custom-select" id="monthselect">
            <option selected>Choose...</option>
            <option value="01">Jan</option>
            <option value="02">Feb</option>
            <option value="03">Mar</option>
            <option value="04">Apr</option>
            <option value="05">May</option>
            <option value="06">Jun</option>
            <option value="07">July</option>
            <option value="08">Aug</option>
            <option value="09">Sept</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
        </select>
        </div>
            <button type="button" class="btn btn-success" id = "ShowData">View Details</button>
            <br><br>
            <form action="PrintMonthSale" method="post">
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
    $("#PrintData").attr("disabled", true);
    $("#yearselect").change(function () {
        $("#PrintData").attr("disabled", true);
    });
    $("#monthselect").change(function () {
        $("#PrintData").attr("disabled", true);
    });




    $("#ShowData").click(function () {
       var y = $("#yearselect").val();
       var m = $("#monthselect").val();

       if(y == 'Choose...' || m == 'Choose...'){
           alert("Please Select Both Month and year");
       } else {
           alert(y+" : "+m); 
           $.ajax({
                url : "ProcessMonthSale.php",
                type : "POST",
                data : {
                    y : y,
                    m : m
                },
                success : function(){
                    $.get('year.txt', function (data) {
                        if(data == ''){
                            alert("Sorry No data found at this month and year");
                        } else {

                           
                            $("#data").load("fetch_monthly_sale.php");
                            
                            
                                $("#data2").load("fetch_monthly_profit.php");
                           
                            $("#PrintData").attr("disabled", false);
                        }
                    });
                }
           });
       }
    });

</script>