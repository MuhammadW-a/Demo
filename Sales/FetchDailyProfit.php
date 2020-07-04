<?php
        $conn = mysqli_connect("localhost", "root", "", "demo");
        $datee = date("Y-m-d");
        $sql = "SELECT * FROM sales_profit WHERE Datee = '$datee'";
        $data = mysqli_query($conn, $sql);
        $sum = 0;
        while ($rowdata = mysqli_fetch_assoc($data)) {
        ?>
                <tr>
                    <td><?php echo $rowdata['Invoice']?></td>
                    <td><?php echo $rowdata['Profit']?></td>
                </tr>
                <?php $sum = $sum + $rowdata['Profit']?>
        <?php        
            }
        ?>    
            <tr>
                <td><i class="fas fa-money-bill-wave-alt"></i> Total = </td>
                <td style="color:orange; , font-weight : bold;" ><?php echo $sum?></td>     
             </tr>