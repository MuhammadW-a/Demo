<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $date = file_get_contents('date_to_check_sale.txt');
    $sql = "SELECT * FROM sales_profit WHERE Datee = '$date'";
        $data = mysqli_query($conn, $sql);
        $sum = 0;
        while ($rowdata = mysqli_fetch_assoc($data)) {
        ?>
                <tr>
                    <td><?php echo $rowdata['Invoice']?></td>
                    <td><?php echo $rowdata['Profit']?></td>
                    <td><?php echo $rowdata['Datee']?></td>
                </tr>
                <?php $sum = $sum + $rowdata['Profit']?>
        <?php        
            }
        ?>    
            <tr>
                <td><i class="fas fa-money-bill-wave-alt"></i> Total = </td>
                <td style="color:orange; , font-weight : bold;" ><?php echo $sum?></td>     
             </tr>
    






