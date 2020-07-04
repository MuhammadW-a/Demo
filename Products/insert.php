<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
       
    $name = $_POST['name'];
    $catagory = $_POST['catagory'];
    $total_units = $_POST['total_units'];
    $unit = $_POST['unit']; 
    $purchase = $_POST['purchase']; 
    $sale = $_POST['sale']; 
    $status = $_POST['status']; 
    $discount = $_POST['discount']; 
    $expiry = $_POST['expiry'];
    



    $selectSql = "SELECT * FROM product WHERE name = '$name'";
    $data = mysqli_query($conn,$selectSql);
    $numrows = mysqli_num_rows($data);


    if($numrows > 0){
        $myfile = fopen("Product_ispresent.txt", "w") or die("Unable to open file!");
        $txt = "yes";
        fwrite($myfile, $txt);
    } else {
        $sqlinsert = "INSERT INTO product(name, catagory, Purchased_unit, unit, purchase_per_unit, sale_per_unit, status, discount_enable, expiry_Date) VALUES ('$name','$catagory','$total_units','$unit','$purchase','$sale','$status','$discount','$expiry')";
        $data = mysqli_query($conn,$sqlinsert);
        $myfile = fopen("Product_ispresent.txt", "w") or die("Unable to open file!");
        $txt = "no";
        fwrite($myfile, $txt);
    }
    mysqli_close($conn);

?>