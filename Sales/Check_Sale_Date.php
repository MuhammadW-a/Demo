<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $date = file_get_contents('date_to_check_sale.txt');
    $sql = "SELECT * FROM sale WHERE Saledate = '$date'";
        $data = mysqli_query($conn, $sql);
        $sum = 0;
        while ($rowdata = mysqli_fetch_assoc($data)) {
        ?>
                <tr>
                    <td><?php echo $rowdata['Invoice']?></td>
                    <td><?php echo $rowdata['Name']?></td>
                    <td><?php echo $rowdata['Saleprice']?></td>
                    <td><?php echo $rowdata['BoughtUnit']?></td>
                    <td><?php echo $rowdata['Total']?></td>
                    <td><?php echo $rowdata['Saledate']?></td>
                </tr>
                <?php $sum = $sum + $rowdata['Total']?>
        <?php        
            }
        ?>    
            <tr>
                
                <td></td>
                <td></td>
                <td></td>
                <td><i class="fas fa-money-bill-wave-alt"></i> Total = </td>
                <td style="color:orange; , font-weight : bold;" ><?php echo $sum?></td>     
             </tr>
    






