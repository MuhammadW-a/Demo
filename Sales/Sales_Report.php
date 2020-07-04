<?php
    error_reporting(0);
    $con = mysqli_connect("localhost", "root", "", "demo"); 
    $result = mysqli_query($con, $sql);
    $date = file_get_contents('date_to_check_sale.txt'); 
    $sql = "SELECT * FROM sale WHERE Saledate = '$date'";  

    $res = mysqli_query($conn, $sql);

    
    $html = '<table>';
    $html .= '<tr><td>Invoice</td><td>Name</td><td>Price Per Unit</td><td>Bought</td><td>Total</td><td>Date</td><tr>';
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= '<tr><td>'.$row['Invoice'].'</td><td>'.$row['Name'].'</td><td>'.$row['Saleprice'].'</td><td>'.$row['BoughtUnit'].'</td><td>'.$row['Total'].'</td><td>'.$row['Saledate'].'</td></tr>';
    }   
    $html .= '</table>';
    header('Content-Type:application.xls');
    header('Content-Disposition:attachment;filename = reports.xls');

?>