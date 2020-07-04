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
    <title>Customers</title>
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
        #MAIN{
            padding : 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><i class="fas fa-users"></i> Customers</a>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../menu"><i class="fas fa-th-list"></i> Main Menu<span class="sr-only"></span></a>
            </li>
        </ul>
    </nav>

    <div id = "MAIN">

        <br><br><br><br>
        <button type="button" class="btn btn-success" id="open_insert"><i class="fas fa-plus-square"></i> insert</button>
        <br><br>
        <table class="table table-bordered table-dark" id="Main_Table">
            <tr>
                <th><i class="fas fa-signature"></i> Fullname</th>
                <th><i class="fas fa-address-card"></i> Phone</th>
                <th><i class="fas fa-envelope"></i> Email</th>
                <th><i class="fas fa-money-bill-wave-alt"></i> Paid</th>
                <th><i class="fas fa-money-bill-wave-alt"></i> Unpaid</th>
                <th>View</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <tbody id="dataCUM">
            <?php
            $sql = "SELECT * FROM customer";
            $data = mysqli_query($conn, $sql);
            while ($rowdata = mysqli_fetch_assoc($data)) {
            ?>
                    <tr>
                        <td><?php echo $rowdata['fullname']?></td>
                        <td><?php echo $rowdata['phone']?></td>
                        <td><?php echo $rowdata['email']?></td>
                        <td><?php echo $rowdata['Paid']?></td>
                        <td><?php echo $rowdata['Unpaid']?></td>
                        <td><button type="button" class="btn btn-info" onclick="viewDetails(  '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['Paid']; ?>' , '<?php echo $rowdata['Unpaid']; ?>' )"><i class="far fa-eye"></i> View</button></td>
                        <td><button type="button" class="btn btn-warning" onclick="updateDetails( '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['Paid']; ?>' , '<?php echo $rowdata['Unpaid']; ?>' )"><i class="fas fa-edit"></i> Update</button></td>
                        <td><button type="button" class="btn btn-danger" onclick="deleteDetails(  '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['Paid']; ?>' , '<?php echo $rowdata['Unpaid']; ?>' )"><i class="fas fa-trash"></i> delete</button></td>
                    </tr>
            <?php        
                }
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


                    <lable>Fullname : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Fullname" id="fullname">
                    </div>

                    <lable>Phone : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Phone" id="phone">
                    </div>

                    <lable>Email : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="email" class="form-control" placeholder="Email" id="email">
                    </div>

                   
                    <lable>Paid : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Paid" id="paid">
                    </div>

                    <lable>Unpaid : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Unpaid" id="unpaid">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="Insert_Customer"><i class="fas fa-plus-square"></i>
                        Add</button>
                </div>
            </div>
        </div>
    </div>
    <!---INSERT MODAL--->







    <!-----View Modal---->
<div class="modal" tabindex="-1" role="dialog" id = "View_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="far fa-eye"></i> View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <lable>Fullname : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly id="view_fullname">
                    </div>

                    <lable>Phone : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly id="view_phone">
                    </div>

                    <lable>Email : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="email" class="form-control" readonly id="view_email">
                    </div>

                    <lable>Paid : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" readonly id="view_paid">
                    </div>

                    <lable>Unpaid : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" readonly id="view_unpaid">
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-----View Modal---->



<!-----Update Modal---->
<div class="modal" tabindex="-1" role="dialog" id = "Update_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <div class="alert alert-danger" role="alert" id = "UPDATE_ALERT">
                <p id = "Danger_Message_Update"></p>
      </div>
        <div class="alert alert-success" role="alert" id = "UPDATE_SUCCESS">
            <p id = "Success_Message_Update"></p>
        </div>


        <h5 class="modal-title"><i class="far fa-edit"></i> Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                        <lable>Fullname : </lable><br>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" readonly  id="Update_fullname">
                    </div>

                    <lable>Phone : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder = "Phone" id="Update_phone">
                    </div>

                    <lable>Email : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="email" class="form-control" placeholder = "Email" id="Update_email">
                    </div>

                    <lable>Paid : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control"placeholder = "Paid"  id="Update_paid">
                    </div>


                    <lable>Unpaid : </lable><br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="number" class="form-control" placeholder = "Unpaid" id="Update_unpaid">
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id = "Update_Data"><i class="fas fa-edit"></i> Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-----Update Modal---->

</body>
</html>
<script>
    $(document).ready(function () {
        setInterval(() => {
            $("#dataCUM").load("fetch.php");
        }, 1000);
    });

    $("#open_insert").click(function () {
        $("#Insert_Modal").modal("show");
        $("#success_alert").hide();
        $("#warning_alert").hide();
    });

    $("#Insert_Customer").click(function () {
        var fullname = $("#fullname").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var paid = $("#paid").val();
        var unpaid = $("#unpaid").val();
        
        if (fullname == '' || phone == '' || email == '' || paid == '' || unpaid == '') {
            $("#warning_alert").show();
            $("#warningMessage").html("Must Fill All Feilds");
        } else {
            $.ajax({
                url: "insert.php",
                type: "POST",
                data: {
                    fullname : fullname,
                    phone : phone,
                    email : email,
                    paid : paid,
                    unpaid : unpaid
                },
                success: function () {
                    $.get('Customer_ispresent.txt', function (data) {
                        if (data == "no") {
                            $("#success_alert").show();
                            $("#successMessage").html("Data inserted successfully");
                        } else {
                            $("#warning_alert").show();
                            $("#warningMessage").html("Customer already present");
                        }
                    });
                }
            });
        }
    });

    function deleteDetails(name,phone,email,paid,unpaid) {
        $.ajax({
            url : "delete.php",
            type : "POST",
            data : {
                name : name
            },
            success : function () {
                alert("Data deleted Successfully");
            }
        });
    }

    function viewDetails(name,phone,email,paid,unpaid) {
        $("#View_Modal").modal("show");
        $('#view_fullname').val(name);
        $('#view_phone').val(phone);
        $('#view_email').val(email);
        $('#view_paid').val(paid);
        $('#view_unpaid').val(unpaid);
    }

    function updateDetails(name,phone,email,paid,unpaid) {
        $("#UPDATE_ALERT").hide();
        $("#UPDATE_SUCCESS").hide();
        $("#Update_Modal").modal("show");
        $('#Update_fullname').val(name);
        $("#Update_phone").val(phone);
        $("#Update_email").val(email);
        $("#Update_paid").val(paid);
        $("#Update_unpaid").val(unpaid);




        
        $("#Update_Data").click(function () {
            
            var name = $("#Update_fullname").val();
            var phone = $("#Update_phone").val();
            var email = $("#Update_email").val();
            var paid = $("#Update_paid").val();
            var unpaid = $("#Update_unpaid").val();
            
            if (phone == '' || email == '' || paid == '' || unpaid  == '' ) {
                $("#UPDATE_ALERT").show();
                 $("#Danger_Message_Update").html("All Feilds Are Required");
            } else {
            $.ajax({
                url: "update.php",
                type: "POST",
                data: {
                    name : name,
                    phone : phone,
                    email : email,
                    paid : paid,
                    unpaid : unpaid
                },
                success: function () {
                    $.get('Update_Customer_status.txt', function (data) {
                        if (data == "yes") {
                            $("#UPDATE_SUCCESS").show();
                            $("#Success_Message_Update").html("Customer Updated");
                        } else {
                            $("#UPDATE_ALERT").show();
                            $("#Danger_Message_Update").html("Customer Not Updated");
                        }
                    });

                }
            });
        }
        });
    }


</script>