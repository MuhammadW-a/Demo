<?php  
    $conn = mysqli_connect("localhost", "root", "", "demo");
    session_start();
    if(!isset($_SESSION['USERNAME_SESSION'])){
?>
<script>
    location.replace("../Login");
</script>
<?php
    }

//////////////////////////////////////////////////

function fetch_data() {  
    $output = '';  
    $connect = mysqli_connect("localhost", "root", "", "demo");  
    $sql = "SELECT * FROM temp_sales_tbl";  
    $result = mysqli_query($connect, $sql);  
    $sum = 0;
    while($row = mysqli_fetch_array($result))  
    {       
    $output .= '<tr>    
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["UnitWeight"].'</td>  
                        <td>'.$row["Saleprice"].'</td>  
                        <td>'.$row["BoughtUnit"].'</td>  
                        <td>'.$row["Total"].'</td>  
                        <td>'.$row["Saledate"].'</td>  
                   </tr>  
                        ';  
      $sum = $sum + $row["Total"];                 
    }  

    $output .= '<tr>  
          <td>'."".'</td>
          <td>'."".'</td>  
          <td>'."".'</td>  
          <td>'."".'</td>  
          <td>'.$sum.'</td>  
          <td>'."".'</td>  
    </tr>  
    '; 
    mysqli_close($connect);

    return $output;  
}  
if(isset($_POST["create_pdf"]))  {
  require_once('tcpdf/tcpdf.php');  
  $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
  $obj_pdf->SetCreator(PDF_CREATOR);  
  $obj_pdf->SetTitle("Sales Invoice");  
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
  
  $connect1 = mysqli_connect("localhost", "root", "", "demo");  
  $sql1 = "SELECT * FROM temp_sales_tbl";  
  $result1 = mysqli_query($connect1, $sql1); 
  $rowdata = mysqli_fetch_array($result1);
  $INVOICE_NUMBER = $rowdata['Invoice'];
  
  $content .= '  
  <h3 align="center">Sale Invoice : '.$INVOICE_NUMBER.'</h3><br /><br />  
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
  $obj_pdf->Output($INVOICE_NUMBER.'.pdf', 'I');

  mysqli_close($connect1);


            $EConn = mysqli_connect("localhost", "root", "", "demo");
            $XXX = mysqli_query($EConn, "TRUNCATE TABLE temp_sales_tbl");
            mysqli_close($EConn);
                 
          
}

/////////////////////////////////////////////////

?>


<?php


function fetchDataToJson(){
    $conn = mysqli_connect("localhost", "root", "", "demo");
    $sql = "SELECT * FROM product";
    $data = mysqli_query($conn, $sql);

    $Customer_Data_Array = array();

    while ($rowdata = mysqli_fetch_array($data)) {
        $Customer_Data_Array[] = array(
            'name' => $rowdata["name"],
            'catagory' => $rowdata["catagory"],
            'In_Stock_Units' => $rowdata["Purchased_unit"],
            'weight' => $rowdata["unit"],
            'sale_per_unit' => $rowdata["sale_per_unit"]
        );
    }
    return json_encode($Customer_Data_Array);
} // end of fetchDataToJson
$filename = "dbtojson.json";
file_put_contents($filename, fetchDataToJson());



?>


























<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style type="text/css">
        body {
            background-image: url("Register_Background.jpg");
            background-size: cover;
            background-attachment: fixed;
        }

        #MAIN {
            padding: 10px;
        }
        #Done{
            float : right;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><i class="fas fa-money-bill-wave-alt"></i> Sales</a>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../menu"><i class="fas fa-th-list"></i> Main Menu<span
                        class="sr-only"></span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="Todayssale"><i class="fas fa-calendar-week"></i> Today's Sale</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="CheckSale"><i class="fas fa-calendar-week"></i> Check Sale day</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="checkSaleMonth"><i class="fas fa-calendar-week"></i> Check Sale Month</a>
            </li>

        </ul>
    </nav>

    <div id="MAIN">

        <br><br><br><br>
        <button type="button" class="btn btn-success" id="open_insert"><i class="fas fa-plus-square"></i>
            insert</button> <br><br>
            <form method="post">  
                <input type="submit" class="btn btn-dark"  id = "Done" name="create_pdf" value="Generate Sale" />  
            </form>
        <br><br>
        <table class="table table-bordered table-dark" id="Main_Table">
            <tr>
                <th><i class="fas fa-sort-numeric-down"></i> Invoice</th>
                <th><i class="fas fa-signature"></i> Name</th>
                <th><i class="fas fa-th-list"></i> Catagory</th>
                <th><i class="fas fa-balance-scale"></i> Unit Weight</th>
                <th><i class="fas fa-money-bill-wave-alt"></i> Price Per Unit</th>
                <th><i class="fas fa-sort-numeric-down"></i> Bought Units</th>
                <th><i class="fas fa-money-bill-wave-alt"></i> Total</th>
                <th><i class="fas fa-clock"></i> Date</th>
                <th>View</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <tbody id="data">
                <?php
        $sql = "SELECT * FROM temp_sales_tbl";
        $data = mysqli_query($conn, $sql);
        while ($rowdata = mysqli_fetch_assoc($data)) {
        ?>
                <tr>
                    <td><?php echo $rowdata['Invoice']?></td>
                    <td><?php echo $rowdata['Name']?></td>
                    <td><?php echo $rowdata['Catagory']?></td>
                    <td><?php echo $rowdata['UnitWeight']?></td>
                    <td><?php echo $rowdata['Saleprice']?></td>
                    <td><?php echo $rowdata['BoughtUnit']?></td>
                    <td><?php echo $rowdata['Total']?></td>
                    <td><?php echo $rowdata['Saledate']?></td>
                    <td><button type="button" class="btn btn-info"
                            onclick="viewDetails(  '<?php echo $rowdata['Invoice']; ?>'  ,  '<?php echo $rowdata['Name']; ?>'  ,  '<?php echo $rowdata['Catagory']; ?>' ,  '<?php echo $rowdata['UnitWeight']; ?>' , '<?php echo $rowdata['Saleprice']; ?>'  ,  '<?php echo $rowdata['BoughtUnit']; ?>' , '<?php echo $rowdata['Total']; ?>' , '<?php echo $rowdata['Saledate']; ?>'  )"><i
                                class="far fa-eye"></i> View</button></td>
                    <td><button type="button" class="btn btn-warning"
                            onclick="updateDetails(  '<?php echo $rowdata['Invoice']; ?>'  ,  '<?php echo $rowdata['Name']; ?>'  ,  '<?php echo $rowdata['Catagory']; ?>' ,  '<?php echo $rowdata['UnitWeight']; ?>' , '<?php echo $rowdata['Saleprice']; ?>'  ,  '<?php echo $rowdata['BoughtUnit']; ?>' , '<?php echo $rowdata['Total']; ?>' , '<?php echo $rowdata['Saledate']; ?>' )"><i
                                class="fas fa-edit"></i> Update</button></td>
                    <td><button type="button" class="btn btn-danger"
                            onclick="deleteDetails(   '<?php echo $rowdata['Invoice']; ?>'  ,  '<?php echo $rowdata['Name']; ?>'  ,  '<?php echo $rowdata['Catagory']; ?>' ,  '<?php echo $rowdata['UnitWeight']; ?>' , '<?php echo $rowdata['Saleprice']; ?>'  ,  '<?php echo $rowdata['BoughtUnit']; ?>' , '<?php echo $rowdata['Total']; ?>' , '<?php echo $rowdata['Saledate']; ?>'  )"><i
                                class="fas fa-trash"></i> delete</button></td>
                </tr>
                <?php        
            }
            
        ?>



       
            </tbody>
        </table>
    </div>

    <!-----------Insert Modal------------>
    <div class="modal" tabindex="-1" role="dialog" id="Insert_Modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!--------------------->
                    <lable>Name : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Product</label>
                        </div>
                        <select class="custom-select" id="Cb_Product">
                        <option>Chose...</option>

                        </select>
                    </div>
                    <!--------------------->
                    <lable>Catagory : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="ICatagory">
                            
                    </div>

                    <!--------------------->

                    <!--------------------->
<lable>Unit Weight : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="IWeight">
                    </div>

                    <!--------------------->

                    <!--------------------->
<lable>Price Per Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="IPrice">
                    </div>

                    <!--------------------->

                    <!--------------------->
<lable>Bought Units : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Add Purchase Quantity"
                            aria-label="Username" aria-describedby="basic-addon1" id="IBoughtUnits">

                    </div>

                    <!--------------------->

                    <!--------------------->
<lable>Total : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="ITotal">
                    </div>

                    <!--------------------->


                    <!--------------------->
<lable>Date : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="IDate">

                        <!--------------------->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="Insert_Sale">Add</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-----------Insert Modal------------>

        <!-----------View Modal------------>
        <div class="modal" tabindex="-1" role="dialog" id="Kill">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View Sale</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       
                       <!---------------------------->
<lable>Name : </lable><br>
                       <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" readonly aria-label="Username"
                                aria-describedby="basic-addon1" id="VName">
                        </div>
                       <!---------------------------->
                       <!---------------------------->
<lable>Catagory : </lable><br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" readonly aria-label="Username"
                                aria-describedby="basic-addon1" id="VCatagory">
                        </div>
                       <!---------------------------->
<lable>Unit Weight : </lable><br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" readonly aria-label="Username"
                                aria-describedby="basic-addon1" id="VWeight">
                        </div>
                        <!---------------------------->
                        <!---------------------------->
<lable>Price Per Unit : </lable><br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" readonly aria-label="Username"
                                aria-describedby="basic-addon1" id="VPrice">
                        </div>
                        <!---------------------------->
                        <!---------------------------->
<lable>Bought Units : </lable><br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" readonly aria-label="Username"
                                aria-describedby="basic-addon1" id="VBought">
                        </div>
                        <!---------------------------->
                        <!---------------------------->
<lable>Total : </lable><br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" readonly aria-label="Username"
                                aria-describedby="basic-addon1" id="VTotal">
                        </div>
                        <!---------------------------->
                        <!---------------------------->
                        <lable>Date : </lable><br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" readonly aria-label="Username"
                                aria-describedby="basic-addon1" id="VDate">
                        </div>
                        <!---------------------------->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
     <!-----------View Modal------------>











    <!---------Update------------>
    <div class="modal" tabindex="-1" role="dialog" id="Update_Modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Sale</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       
                    <!--------------------->
                    <lable>Name : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="UName">
                    </div>
                    <!--------------------->

                     <!--------------------->
<lable>Catagory : </lable><br>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="UCatagory">
                    </div>

                    <!--------------------->

                    <!--------------------->
<lable>Unit Weight : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="UWeight">
                    </div>

                    <!--------------------->

                    <!--------------------->
<lable>Price Per Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="UPrice">
                    </div>

                    <!--------------------->

                    <!--------------------->
                    <lable>Bought Units : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control"  aria-label="Username"
                            aria-describedby="basic-addon1" id="UBought">
                    </div>

                    <!--------------------->

                     <!--------------------->
                        <lable>Total : </lable><br>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="UTotal">
                    </div>

                    <!--------------------->

                    <!--------------------->
                    <lable>Date : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly aria-label="Username"
                            aria-describedby="basic-addon1" id="UDate">
                    </div>

                    <!--------------------->
                       
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" id = "Btn_Update">Update</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <!---------Update------------>
</body>
<script>
    $(document).ready(function () {
       
            $.getJSON("dbtojson.json", function (obj) {
                $.each(obj, function (key, value) {
                    $("#Cb_Product").append("<option>"+value.name +"</option>");
                });
            });
       


        $("#Done").attr("disabled", false);

        setInterval(() => {
            $("#data").load("fetch.php");
        }, 1000);

       /* setInterval(() => {
            $.get("TotalBill.txt", function (data) {
                if (data == "0") {
                    $("#Done").attr("disabled", true);
                } else {
                    $("#Done").attr("disabled", false);
                }
            });
        }, 1000);
*/
    });


   











    $("#open_insert").click(function () {
        $("#Insert_Modal").modal("show");
        $("#Cb_Product").on("change", function () {
            $("#IBoughtUnits").val('');
            $("#ITotal").val('');
            var productName = $("#Cb_Product").val();
            var date = (new Date()).toISOString().split('T')[0];
            $.getJSON("dbtojson.json", function (obj) {
                $.each(obj, function (key, value) {
                    if (value.name == productName) {
                        $("#ICatagory").val(value.catagory);
                        $("#IWeight").val(value.weight);
                        $("#IPrice").val(value.sale_per_unit);
                        $("#IDate").val(date);
                        $("#IBoughtUnits").focusout(function () {
                            var x = $("#IBoughtUnits").val();
                            var priceperunit = $("#IPrice").val();
                            $("#IQty").val(value.In_Stock_Units);
                            $("#ITotal").val(priceperunit * x);
                        });
                    }
                });
            });
        });
    });


    $("#Insert_Sale").click(function () {
        var name = $("#Cb_Product").val();
        var catagory = $("#ICatagory").val();
        var weight = $("#IWeight").val();
        var price = $("#IPrice").val();
        var boughtUnits = $("#IBoughtUnits").val();
        var total = $("#ITotal").val();
        var date = $("#IDate").val();
        if (name == 'Chose...' || catagory == '' || weight == '' || price == '' || boughtUnits == '' || total == '' ||
            date == '') {
            alert("All Feilds Are Required");
        } else {
            $.ajax({
                url: "insert.php",
                type: "POST",
                data: {
                    name: name,
                    catagory: catagory,
                    weight: weight,
                    price: price,
                    boughtUnits: boughtUnits,
                    total: total,
                    date: date
                },
                success: function () {
                    $.get('Sale_Is_Present.txt', function (data) {
                        if (data == "yes") {
                            alert("Product Is Present Just Update");
                        } else {

                            $.get('MBU.txt', function (nu) {
                                if (nu == "no") {
                                    $("#IBoughtUnits").val('');
                                    $("#ITotal").val('');
                                    $("#ICatagory").val('');
                                    $("#IWeight").val('');
                                    $("#IPrice").val('');
                                    $("#IDate").val('');
                                    alert("Data Inserted");
                                } else {
                                    alert("Max Quantity Be : " + nu);
                                }
                            });
                        }
                    });
                }
            });
        }
    });

    function viewDetails(invoice, name, catagory, unitweight, salesprice, boughtunits, total, saledate) {
        $("#Kill").modal("show");
        $("#VName").val(name);
        $("#VCatagory").val(catagory);
        $("#VWeight").val(unitweight);
        $("#VPrice").val(salesprice);
        $("#VBought").val(boughtunits);
        $("#VTotal").val(total);
        $("#VDate").val(saledate);
    }

    function updateDetails(invoice, name, catagory, unitweight, salesprice, boughtunits, total, saledate) {
        $("#Update_Modal").modal("show");
        $("#UName").val(name);
        $("#UCatagory").val(catagory);
        $("#UWeight").val(unitweight);
        $("#UPrice").val(salesprice);
        $("#UDate").val(saledate);
        $("#UBought").val('');
        $("#UTotal").val('');
        
        $("#UBought").focusout(function () {
            var x = $("#UBought").val();
            var priceperunit = $("#UPrice").val();       
            $("#UTotal").val(priceperunit * x);
           
        });

        



        $("#Btn_Update").click(function () {
            
            var Name = $("#UName").val();
            var Catagory = $("#UCatagory").val();
            var Weight = $("#UWeight").val();
            var Price = $("#UPrice").val();
            var Bought = $("#UBought").val();
            var Total = $("#UTotal").val();
            var Datee = $("#UDate").val();


            if(Name == '' || Catagory == '' || Weight == '' || Price == '' || Bought == '' || Total == '' || Datee == ''){
                alert("All Feilds Are Required");
            } else {
                
                $.ajax({
                    url : "update.php",
                    type : "POST",
                    data : {
                        Name : Name,
                        Bought : Bought,
                        Total : Total
                    },
                    success : function () {
                        $.get('TTU.txt', function (nux) {
                                if (nux == "yes") {
                                    alert("Data Updated");
                                } else {
                                    alert("Max Quantity Be : " + nux);
                                }
                        });
                    }


                });
                
            }
        });
    }

    function deleteDetails(invoice, name, catagory, unitweight, salesprice, boughtunits, total, saledate) {
       $.ajax({
            url : "delete.php",
            type : "POST",
            data : {
                name : name
            },
            success : function () {
                              
            }
       });
    }







    $("#Done").click(function () {
        $.ajax({
            url : "Transaction.php",
            type : "POST",
            success : function () { 
                $.get('Check_Sale_Empty.txt', function(data) {
                    if (data == "yes") {
                        alert("No Sales Yet");
                    } else {  }
                });
            }
        });
    });

</script>