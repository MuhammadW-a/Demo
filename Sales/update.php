<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $Name = $_POST['Name'];
    $Bought = $_POST['Bought'];
    $Total = $_POST['Total'];    

    $selectFromProducts = "SELECT * from product WHERE name = '$Name'";
    $runSelectProducts = mysqli_query($conn, $selectFromProducts);
    $numofrowsProducts = mysqli_num_rows($runSelectProducts);
    if($numofrowsProducts > 0){
        $rowdata = mysqli_fetch_assoc($runSelectProducts);
        $x = $rowdata['Purchased_unit'];          
        $BU = fopen("TTU.txt", "w") or die("Unable to open file!");
        
        if((int)$Bought < 1 || (int)$Bought > (int)$x){
            fwrite($BU, $x);
        } else {
            fwrite($BU, 'yes');
            $sqlUpdate = "UPDATE temp_sales_tbl SET BoughtUnit = '$Bought' , Total = '$Total' WHERE Name = '$Name';";
            $runUpdate = mysqli_query($conn, $sqlUpdate);
        }
    }
?>