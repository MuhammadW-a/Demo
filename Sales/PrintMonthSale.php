<?php
function fetch_data() {  
    $output = '';  
        $connect = mysqli_connect("localhost", "root", "", "demo");  
        $month = file_get_contents("month.txt"); 
        $year = file_get_contents("year.txt");
        $sql = "SELECT * FROM sale WHERE year = '$year' AND month = '$month'";
        $result = mysqli_query($connect, $sql);
        $sum = 0;
        while($row = mysqli_fetch_array($result))  
        {       
        $output .= '<tr>    
                            <td>'.$row["Invoice"].'</td>
                            <td>'.$row["Name"].'</td>  
                            <td>'.$row["Saleprice"].'</td>  
                            <td>'.$row["BoughtUnit"].'</td>  
                            <td>'.$row["Total"].'</td>  
                            <td>'.$row["Saledate"].'</td>  
                    </tr>  
                            ';  
        $sum = $sum + $row["Total"];     
        $saledate = $row["Saledate"];            
        }  

        $output .= '<tr>  
            <td>'."".'</td>
            <td>'."".'</td>  
            <td>'."".'</td>  
            <td>Sales = </td>  
            <td>'.$sum.'</td>  
            <td>'."".'</td>  
        </tr>  
        '; 
        $output .= "<tr>
            <td></td>
            <td></td>
            <td>Profit Of Month = </td>
            <td>$month</td>
        </tr>";


        $sql2 = "SELECT * FROM sales_profit WHERE year = '$year' AND month = '$month'";
        $result2 = mysqli_query($connect, $sql2); 
        $sum2 = 0;
        while($row = mysqli_fetch_array($result2))  
        {       
        $output .= '<tr>    
                            <td>'.$row["Invoice"].'</td>
                            <td>'.$row["Profit"].'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    </tr>  
                ';  
        $sum2 = $sum2 + $row["Profit"];     
                
        }  

        $output .= '<tr>  
            
            <td>Profit = </td>  
            <td>'.$sum2.'</td>  
             
        </tr>  
        ';
    mysqli_close($connect);
    return $output;  
}  

require_once('tcpdf/tcpdf.php');  
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
$obj_pdf->SetCreator(PDF_CREATOR);  
$obj_pdf->SetTitle("Sales Report Of Month");  
$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
$obj_pdf->SetDefaultMonospacedFont('helvetica');  
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
$obj_pdf->setPrintHeader(false);  
$obj_pdf->setPrintFooter(false);  
$obj_pdf->SetAutoPageBreak(TRUE, 10);  
$obj_pdf->SetFont('helvetica', '', 12);  
$obj_pdf->AddPage();  
$content = '';  


$month = file_get_contents("month.txt"); 
$year = file_get_contents("year.txt");

$x = $month."-".$year;

$content .= '  
<h3 align="center">Sales Report Of Month : '.$month.' Year : '.$year.'</h3><br /><br />  
<table border="1" cellspacing="0" cellpadding="5">  
    <tr>   
         <th>Name</th>
         <th>Unit Weight</th>  
         <th>Price/Unit</th>  
         <th>Purchased Unit</th>  
         <th>Total</th>  
         <th>Date</th>  
    </tr>  
';  
$content .= fetch_data();  
$content .= '</table>';  
$obj_pdf->writeHTML($content);  
$obj_pdf->Output($x.'.pdf', 'I');

mysqli_close($connect1);


















?>