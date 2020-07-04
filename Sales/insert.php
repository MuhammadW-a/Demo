<?php
   
    error_reporting(0);
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $name = $_POST['name'];    
    $catagory = $_POST['catagory'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    $boughtUnits = $_POST['boughtUnits'];
    $total = $_POST['total'];
    $date = $_POST['date'];
    $year = date("yy");
    $month = date("m");





    $txt = file_get_contents('Invoice.txt');
    if ($txt == '') {
        $Invoice  = 1;
        $myfilew = fopen("Invoice.txt", "w") or die("Unable to open file!");
        fwrite($myfilew, $Invoice);
    } else {
        $Invoice = (int)$txt;
    }
    $Str = (string)$Invoice;
    $finalInvoice = "P-0000000".$Str;
    $check_Sale = "SELECT * FROM temp_sales_tbl WHERE Name = '$name'";
    $runSelect = mysqli_query($conn, $check_Sale);
    $numofrows = mysqli_num_rows($runSelect);
    if($numofrows > 0){
        $Sale_Is_Present = fopen("Sale_Is_Present.txt", "w") or die("Unable to open file!");
        $status = "yes";
        fwrite($Sale_Is_Present, $status);
    } else {
        $Sale_Is_Present = fopen("Sale_Is_Present.txt", "w") or die("Unable to open file!");
        $status = "no";
        fwrite($Sale_Is_Present, $status);
        


        $selectFromProducts = "SELECT * from product WHERE name = '$name'";
        $runSelectProducts = mysqli_query($conn, $selectFromProducts);
        $numofrowsProducts = mysqli_num_rows($runSelectProducts);
        if($numofrowsProducts > 0){
            $rowdata = mysqli_fetch_assoc($runSelectProducts);
            $x = $rowdata['Purchased_unit'];          
            $BU = fopen("MBU.txt", "w") or die("Unable to open file!");
            fwrite($BU, $x);

            if((int)$boughtUnits < 1 || (int)$boughtUnits > (int)$x){
                fwrite($BU, 'no');
            } else {
                $sqlInsert = "INSERT INTO temp_sales_tbl(Invoice,Name, Catagory, UnitWeight, Saleprice, BoughtUnit, Total, Saledate, year, month) VALUES ('$finalInvoice','$name','$catagory','$weight','$price','$boughtUnits','$total','$date','$year','$month')";
                $runInsert = mysqli_query($conn, $sqlInsert);
            }


                
            
        } 
    }
    fclose($myfile);
?>