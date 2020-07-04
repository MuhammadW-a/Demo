<?php
    $conn = mysqli_connect("localhost", "root", "", "demo");
    session_start();
    if(!isset($_SESSION['USERNAME_SESSION'])){
        ?>
<script>
    location.replace("../Login.php");
</script>
<?php
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><i class="fas fa-shapes"></i> Products</a>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../menu"><i class="fas fa-th-list"></i> Main Menu<span
                        class="sr-only"></span></a>
            </li>
        </ul>
    </nav>

    <div id="MAIN">

        <br><br><br><br>
        <button type="button" class="btn btn-success" id="open_insert"><i class="fas fa-plus-square"></i>
            insert</button>
        <br><br>
        <table class="table table-bordered table-dark" id="Main_Table">
            <tr>
                <th><i class="fas fa-signature"></i> Name</th>
                <th><i class="fas fa-th-list"></i> Catagory</th>
                <th><i class="fas fa-sort-numeric-down"></i> Total Units</th>
                <th><i class="fas fa-balance-scale"></i> Unit Weight</th>
                <th><i class="fas fa-money-bill-wave-alt"></i> Purchase Per Unit</th>
                <th><i class="fas fa-money-bill-wave-alt"></i> Sale Per Unit</th>
                <th><i class="fas fa-question-circle"></i> Status</th>
                <th><i class="fas fa-tags"></i> Discount</th>
                <th><i class="fas fa-clock"></i> Expiry Date</th>
                <th>View</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <tbody id="data">
                <?php
        $sql = "SELECT * FROM product";
        $data = mysqli_query($conn, $sql);
        while ($rowdata = mysqli_fetch_assoc($data)) {
        ?>
                <tr>
                    <td><?php echo $rowdata['name']?></td>
                    <td><?php echo $rowdata['catagory']?></td>
                    <td><?php echo $rowdata['Purchased_unit']?></td>
                    <td><?php echo $rowdata['unit']?></td>
                    <td><?php echo $rowdata['purchase_per_unit']?></td>
                    <td><?php echo $rowdata['sale_per_unit']?></td>
                    <td><?php echo $rowdata['status']?></td>
                    <td><?php echo $rowdata['discount_enable']?></td>
                    <td><?php echo $rowdata['expiry_Date']?></td>
                    <td><button type="button" class="btn btn-info"
                            onclick="viewDetails(  '<?php echo $rowdata['name']; ?>'  ,  '<?php echo $rowdata['catagory']; ?>'  ,  '<?php echo $rowdata['Purchased_unit']; ?>' ,  '<?php echo $rowdata['unit']; ?>' , '<?php echo $rowdata['purchase_per_unit']; ?>'  ,  '<?php echo $rowdata['sale_per_unit']; ?>' , '<?php echo $rowdata['status']; ?>' ,  '<?php echo $rowdata['discount_enable']; ?>' , '<?php echo $rowdata['expiry_Date']; ?>' )"><i
                                class="far fa-eye"></i> View</button></td>
                    <td><button type="button" class="btn btn-warning"
                            onclick="updateDetails( '<?php echo $rowdata['name']; ?>'  ,  '<?php echo $rowdata['catagory']; ?>'  ,  '<?php echo $rowdata['Purchased_unit']; ?>' ,  '<?php echo $rowdata['unit']; ?>' , '<?php echo $rowdata['purchase_per_unit']; ?>'  ,  '<?php echo $rowdata['sale_per_unit']; ?>' , '<?php echo $rowdata['status']; ?>' ,  '<?php echo $rowdata['discount_enable']; ?>' , '<?php echo $rowdata['expiry_Date']; ?>'  )"><i
                                class="fas fa-edit"></i> Update</button></td>
                    <td><button type="button" class="btn btn-danger"
                            onclick="deleteDetails(  '<?php echo $rowdata['name']; ?>'  ,  '<?php echo $rowdata['catagory']; ?>'  ,  '<?php echo $rowdata['Purchased_unit']; ?>' ,  '<?php echo $rowdata['unit']; ?>' , '<?php echo $rowdata['purchase_per_unit']; ?>'  ,  '<?php echo $rowdata['sale_per_unit']; ?>' , '<?php echo $rowdata['status']; ?>' ,  '<?php echo $rowdata['discount_enable']; ?>' , '<?php echo $rowdata['expiry_Date']; ?>'  )"><i
                                class="fas fa-trash"></i> delete</button></td>
                </tr>
                <?php        
            }

            function fetchDataToJson(){
                $conn2 = mysqli_connect("localhost", "root", "", "demo");
                $sql2 = "SELECT * FROM catagory";
                $data2 = mysqli_query($conn2, $sql2);
        
                $Customer_Data_Array = array();
        
                while ($rowdata = mysqli_fetch_array($data2)) {
                    $Customer_Data_Array[] = array(
                        'name' => $rowdata["CatagoryName"]
                    );
                }
                return json_encode($Customer_Data_Array);
            } // end of fetchDataToJson
            $filename = "Catagories.json";
            file_put_contents($filename, fetchDataToJson());
        ?>
            </tbody>
        </table>
    </div>

    <!---INSERT MODAL--->
    <div class="modal" tabindex="-1" role="dialog" id="Insert_Modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-square"></i> Insert Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-secondary" id="success_alert" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <p id="successMessage"></p>
                    </div>

                    <div class="alert alert-danger" id="warning_alert" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <p id="warningMessage"></p>
                    </div>


                    <lable>Name : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Name" id="name">
                    </div>
                    <!------------------------------->
                    <lable>Catagory : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Catagory</label>
                        </div>
                        <select class="custom-select" id="catagory">


                        </select>
                    </div>

                    <!----------------------------------->
                    <lable>Purchased Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Purchased Units" id="Purchased_unit">
                    </div>

                    <lable>Units[kg,oucs,grams] : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Unit in kg's, mg's, g's" id="unit">
                    </div>
                    <lable>Perchase Per Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Purchase Price Per Unit" id="purchase">
                    </div>

                    <lable>Sale Per Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Sale Price Per Unit" id="sale">
                    </div>


                    <lable>Status : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Status" id="status">
                    </div>

                    <lable>Discount : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Discount" id="discount">
                    </div>

                    <lable>Expiry Date : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="date" class="form-control" placeholder="Expiry Date" id="expiry">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="Insert_Product"><i class="fas fa-plus-square"></i>
                        Add</button>
                </div>
            </div>
        </div>
    </div>
    <!---INSERT MODAL--->
    <!-----UPDATE MODAL---->
    <div class="modal" tabindex="-1" role="dialog" id="update_Modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> Update Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-secondary" id="success_alert_Update" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <p id="successMessage_Update"></p>
                    </div>

                    <div class="alert alert-danger" id="warning_alert_Update" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <p id="warningMessage_Update"></p>
                    </div>


                    <lable>Name : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Name" readonly id="update_name">
                    </div>

                    <!--------------------------->
                    <lable>Catagory : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Catagory</label>
                        </div>
                        <select class="custom-select" id="update_catagory">


                        </select>
                    </div>

                    <!--------------------------->
                    <lable>Purchased Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Purchased Units"
                            id="update_Purchased_unit">
                    </div>


                    <lable>Units[kg,oucs,grams] : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Unit in kg's, mg's, g's" id="update_unit">
                    </div>

                    <lable>Perchase Per Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Purchase Price Per Unit"
                            id="update_purchase">
                    </div>

                    <lable>Sale Per Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Sale Price Per Unit" id="update_sale">
                    </div>


                    <lable>Status : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Status" id="update_status">
                    </div>

                    <lable>Discount : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Discount" id="update_discount">
                    </div>

                    <lable>Expiry Date : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="date" class="form-control" placeholder="Expiry Date" id="update_expiry">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="update_Product"><i class="fas fa-edit"></i>
                        Update</button>
                </div>
            </div>
        </div>
    </div>
    <!------Update Modal------>

    <!-----View Modal---->
    <div class="modal" tabindex="-1" role="dialog" id="View_Modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="far fa-eye"></i> View</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <lable>Name : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Name" readonly id="delete_name">
                    </div>
                    <lable>Catagory : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Catagory" readonly id="delete_catagory">
                    </div>

                    <lable>Purchased Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Purchased Units" readonly
                            id="delete_Purchased_unit">
                    </div>
                    <lable>Units[kg,oucs,grams] : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Unit in kg's, mg's, g's" readonly
                            id="delete_unit">
                    </div>
                    <lable>Perchase Per Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Purchase Price Per Unit" readonly
                            id="delete_purchase">
                    </div>

                    <lable>Sale Per Unit : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Sale Price Per Unit" readonly
                            id="delete_sale">
                    </div>

                    <lable>Status : </lable><br>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Status" readonly id="delete_status">
                    </div>

                    <lable>Discount : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Discount" readonly id="delete_discount">
                    </div>

                    <lable>Expiry Date : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="date" class="form-control" placeholder="Expiry Date" readonly id="delete_expiry">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-----View Modal---->





</body>

</html>
<script>
    $(document).ready(function () {
        setInterval(() => {
            $("#data").load("fetch.php");
        }, 1000);
    });


    $.getJSON("Catagories.json", function (obj) {
        $.each(obj, function (key, value) {
            $("#catagory").append("<option>" + value.name + "</option>")
        });
    });

    $.getJSON("Catagories.json", function (obj) {
        $.each(obj, function (key, value) {
            $("#update_catagory").append("<option>" + value.name + "</option>")
        });
    });





    $("#open_insert").click(function () {
        $("#Insert_Modal").modal("show");
        $("#warning_alert").hide();
        $("#success_alert").hide();
    });

    $("#Insert_Product").click(function () {
        var name = $("#name").val();
        var catagory = $("#catagory").val();
        var total_units = $("#Purchased_unit").val();
        var unit = $("#unit").val();
        var purchase = $("#purchase").val();
        var sale = $("#sale").val();
        var status = $("#status").val();
        var discount = $("#discount").val();
        var expiry = $("#expiry").val();

        if (name == '' || total_units == '' || catagory == '' || unit == '' || purchase == '' || sale == '' ||
            status == '' || discount == '' || expiry == '') {
           alert("All feilds are required");
        } else {
            $.ajax({
                url: "insert.php",
                type: "POST",
                data: {
                    name: name,
                    catagory: catagory,
                    total_units: total_units,
                    unit: unit,
                    purchase: purchase,
                    sale: sale,
                    status: status,
                    discount: discount,
                    expiry: expiry
                },
                success: function () {
                    $.get('Product_ispresent.txt', function (data) {
                        if (data == "no") {
                            $("#success_alert").show();
                            $("#successMessage").html("Data inserted successfully");
                            $("#name").val('');
                            $("#Purchased_unit").val('');
                            $("#unit").val('');
                            $("#purchase").val('');
                            $("#sale").val('');
                            $("#status").val('');
                            $("#discount").val('');
                            $("#expiry").val('');
                        } else {
                            alert("Product is already present");
                        }
                    });
                }
            });
        }
    });

    function updateDetails(name, catagory, Purchased_unit, unit, purchase_per_unit, sale_per_unit, status,
        discount_enable, expiry_Date) {
        $("#success_alert_Update").hide();
        $("#warning_alert_Update").hide();
        $("#update_Modal").modal("show");
        $("#update_name").val(name);
        $("#update_catagory").val(catagory);
        $("#update_Purchased_unit").val(Purchased_unit);
        $("#update_unit").val(unit);
        $("#update_purchase").val(purchase_per_unit);
        $("#update_sale").val(sale_per_unit);
        $("#update_status").val(status);
        $("#update_discount").val(discount_enable);
        $("#update_expiry").val(expiry_Date);

        $("#update_Product").click(function () {
            var name1 = $("#update_name").val();
            var catagory1 = $("#update_catagory").val();
            var total_units1 = $("#update_Purchased_unit").val();
            var unit1 = $("#update_unit").val();
            var purchase1 = $("#update_purchase").val();
            var sale1 = $("#update_sale").val();
            var status1 = $("#update_status").val();
            var discount1 = $("#update_discount").val();
            var expiry1 = $("#update_expiry").val();
            if (name1 == '' || total_units1 == '' || catagory1 == '' || unit1 == '' || purchase1 == '' ||
                sale1 == '' || status1 == '' || discount1 == '' || expiry1 == '') {
                $("#warning_alert_Update").show();
            } else {
                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: {
                        name1: name1,
                        catagory1: catagory1,
                        total_units1: total_units1,
                        unit1: unit1,
                        purchase1: purchase1,
                        sale1: sale1,
                        status1: status1,
                        discount1: discount1,
                        expiry1: expiry1
                    },
                    success: function () {
                        $.get('Update_Product_status.txt', function (data) {
                            if (data == "yes") {
                                $("#success_alert_Update").show();
                                $("#successMessage_Update").html(
                                    "Data updated successfully");
                            } else {
                                $("#warning_alert_Update").show();
                                $("#warningMessage_Update").html("Data not updated");
                            }
                        });

                    }
                });
            }
        });
    }

    function deleteDetails(name, catagory, Purchased_unit, unit, purchase_per_unit, sale_per_unit, status,
        discount_enable, expiry_Date) {

        $.ajax({
            url: "delete.php",
            type: "POST",
            data: {
                name: name
            },
            success: function () {
                alert("Data deleted Successfully");
            }
        });
    }

    function viewDetails(name, catagory, Purchased_unit, unit, purchase_per_unit, sale_per_unit, status,
        discount_enable, expiry_Date) {
        $("#View_Modal").modal("show");
        $("#delete_name").val(name);
        $("#delete_catagory").val(catagory);
        $("#delete_Purchased_unit").val(Purchased_unit);
        $("#delete_unit").val(unit);
        $("#delete_purchase").val(purchase_per_unit);
        $("#delete_sale").val(sale_per_unit);
        $("#delete_status").val(status);
        $("#delete_discount").val(discount_enable);
        $("#delete_expiry").val(expiry_Date);
    }
</script>