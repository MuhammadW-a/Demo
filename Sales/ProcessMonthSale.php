<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $year = $_POST['y'];
    $month = $_POST['m'];
    $sql = "SELECT * FROM sale WHERE year = '$year' AND month = '$month'";
    $Fire = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($Fire);

    if($rows > 0){
        $myfile2 = fopen("year.txt", "w") or die("Unable to open file!");
        $txt2 = $year;
        fwrite($myfile2, $txt2);

        $myfile3 = fopen("month.txt", "w") or die("Unable to open file!");
        $txt3 = $month;
        fwrite($myfile3, $txt3);


    } else {
        $myfile2 = fopen("year.txt", "w") or die("Unable to open file!");
        $txt2 = '';
        fwrite($myfile2, $txt2);

        $myfile3 = fopen("month.txt", "w") or die("Unable to open file!");
        $txt3 = '';
        fwrite($myfile3, $txt3);
    }


?>