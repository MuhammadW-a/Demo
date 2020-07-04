<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $datee = $_POST['datax'];

    $sqlsale = "SELECT * FROM sale WHERE Saledate = '$datee'";
    

    
    $firesqlSale = mysqli_query($conn, $sqlsale);
    $NumRows = mysqli_num_rows($firesqlSale);

    if ($NumRows > 0) {
        
        $myfile = fopen("date_to_check_sale.txt", "w") or die("Unable to open file!");
        $txt = $datee;
        fwrite($myfile, $txt);

    } else {
        $myfile = fopen("date_to_check_sale.txt", "w") or die("Unable to open file!");
        $txt = '';
        fwrite($myfile, $txt);
    }
    mysqli_close($conn);
?>