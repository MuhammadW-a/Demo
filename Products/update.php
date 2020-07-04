<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
       
    

    $name1 = $_POST['name1'];
    $catagory1 = $_POST['catagory1'];
    $total_units1 = $_POST['total_units1'];
    $unit1 = $_POST['unit1'];
    $purchase1 = $_POST['purchase1'];
    $sale1 = $_POST['sale1'];
    $status1 = $_POST['status1'];
    $discount1 = $_POST['discount1'];
    $expiry1 = $_POST['expiry1'];   
    

    $sqlUpdate = "UPDATE product SET catagory = '$catagory1',
                                     Purchased_unit = '$total_units1',
                                     unit = '$unit1',
                                     purchase_per_unit = '$purchase1',
                                     sale_per_unit = '$sale1',
                                     status = '$status1',
                                     discount_enable = '$discount1',
                                     expiry_Date = '$expiry1'
                                     WHERE name = '$name1'";
    $updatedData = mysqli_query($conn, $sqlUpdate);

    if ($sqlUpdate) {
        $myfile = fopen("Update_Product_status.txt", "w") or die("Unable to open file!");
        $txt = "yes";
        fwrite($myfile, $txt);

    } else {
        $myfile = fopen("Update_Product_status.txt", "w") or die("Unable to open file!");
        $txt = "no";
        fwrite($myfile, $txt);
    }
    mysqli_close($conn);
?>