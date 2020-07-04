<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    
    $CatagoryName = $_POST['name'];
    $CatagoryDescription = $_POST['description'];

    $sqlcheck = "SELECT * FROM catagory WHERE CatagoryName = '$CatagoryName'";
    $datacheck = mysqli_query($conn, $sqlcheck);
    $numOfRows = mysqli_num_rows($datacheck);
    if($numOfRows > 0){
        $myfile = fopen("Catagory_Check.txt", "w") or die("Unable to open file!");
        $txt = "yes";
        fwrite($myfile, $txt);
    } else {
        $sqlInsert = "INSERT INTO catagory (CatagoryName,CatagoryDescription) VALUES ('$CatagoryName','$CatagoryDescription')";
        $dataInsert = mysqli_query($conn,$sqlInsert);
        $myfile = fopen("Catagory_Check.txt", "w") or die("Unable to open file!");
        $txt = "no";
        fwrite($myfile, $txt);
    }
    mysqli_close($conn);
?>