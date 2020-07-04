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
    <title>Employees</title>
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
        <a class="navbar-brand" href="#"><i class="fas fa-users"></i> Employees</a>
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
                <th><i class="fas fa-map-marker-alt"></i> address</th>
                <th><i class="fas fa-users-cog"></i> designation</th>
                <th><i class="fas fa-money-bill-wave-alt"></i> Salary</th>
                <th>View</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <tbody id="data">
            <?php
            $sql = "SELECT * FROM employees";
            $data = mysqli_query($conn, $sql);
            while ($rowdata = mysqli_fetch_assoc($data)) {
            ?>
                    <tr>
                        <td><?php echo $rowdata['fullname']?></td>
                        <td><?php echo $rowdata['phone']?></td>
                        <td><?php echo $rowdata['email']?></td>
                        <td><?php echo $rowdata['address']?></td>
                        <td><?php echo $rowdata['designation']?></td>
                        <td><?php echo $rowdata['salary']?></td>
                        <td><button type="button" class="btn btn-info" onclick="viewDetails(  '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['address']; ?>' , '<?php echo $rowdata['designation']; ?>' , '<?php echo $rowdata['salary']; ?>' )"><i class="far fa-eye"></i> View</button></td>
                        <td><button type="button" class="btn btn-warning" onclick="updateDetails( '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['address']; ?>' , '<?php echo $rowdata['designation']; ?>' , '<?php echo $rowdata['salary']; ?>' )"><i class="fas fa-edit"></i> Update</button></td>
                        <td><button type="button" class="btn btn-danger" onclick="deleteDetails(  '<?php echo $rowdata['fullname']; ?>'  ,  '<?php echo $rowdata['phone']; ?>'  ,  '<?php echo $rowdata['email']; ?>' ,  '<?php echo $rowdata['address']; ?>' , '<?php echo $rowdata['designation']; ?>' , '<?php echo $rowdata['salary']; ?>' )"><i class="fas fa-trash"></i> delete</button></td>
                    </tr>
            <?php        
                }
            ?>
            </tbody>
        </table>
</div>



<!------------INsert MOdal --------->
<div class="modal" tabindex="-1" role="dialog" id = "modal_insert">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <div class="alert alert-danger" role="alert" id = "Error_Alert">
                <p id = "Error_Message"></p>
        </div>
        <div class="alert alert-success" role="alert" id = "Success_Alert">
                <p id = "Success_Message"></p>
        </div>








        <lable>Fullname : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Fullname" id = "fullname_insert">
      </div>

      <lable>Phone : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Phone" id = "phone_insert">
      </div>

      <lable>Email : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="email" class="form-control" placeholder="Email" id = "email_insert">
      </div>

      <lable>Address : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Address" id = "address_insert">
      </div>


      <lable>Designation : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Designation" id = "designation_insert">
      </div>

      <lable>Salary : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="number" class="form-control" placeholder="Salary" id = "salary_insert">
      </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id = "insert_data">Add</button>
      </div>
    </div>
  </div>
</div>
<!------------INsert MOdal --------->

<!------------View MOdal --------->
<div class="modal" tabindex="-1" role="dialog" id = "modal_view">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View Employee</h5>
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
        <input type="text" class="form-control"  readonly id = "fullname_view">
      </div>

      <lable>Phone : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control"  readonly id = "phone_view">
      </div>

      <lable>Email : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="email" class="form-control" readonly id = "email_view">
      </div>


      <lable>Address : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" readonly id = "address_view">
      </div>


      <lable>Designation : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" readonly id = "designation_view">
      </div>

      <lable>Salary : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="number" class="form-control" readonly id = "salary_view">
      </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<!------------View MOdal --------->

<!----------------Update Modal --------------->

<div class="modal" tabindex="-1" role="dialog" id = "Update_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      <div class="alert alert-success" role="alert" id = "Update_Success">
        <p id = "Message_US"></p>
      </div>
      <div class="alert alert-danger" role="alert" id = "Update_Danger">
        <p id = "Message_UD"></p>
      </div>




      <lable>Fullname : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control"  readonly id = "fullname_update">
      </div>

      <lable>Phone : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control"   id = "phone_update">
      </div>

      <lable>Email : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="email" class="form-control"  id = "email_update">
      </div>

      <lable>Address : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control"  id = "address_update">
      </div>


      <lable>Designation : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control"  id = "designation_update">
      </div>


      <lable>Salary : </lable><br>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="number" class="form-control"  id = "salary_update">
      </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id = "update_btn">Update</button>
      </div>
    </div>
  </div>
</div>

<!----------------Update Modal --------------->






</body>
</html>
<script>
    $(document).ready(function () {
        setInterval(() => {
            $("#data").load("fetch.php");
        }, 1000);
    });

    $("#open_insert").click(function () {
        $("#Error_Alert").hide();
        $("#Success_Alert").hide();
        $("#modal_insert").modal("show");
    });

    $("#insert_data").click(function () {
        $("#Error_Alert").hide();
        $("#Success_Alert").hide();
        var fullname = $("#fullname_insert").val(); 
        var phone = $("#phone_insert").val();
        var email = $("#email_insert").val();
        var address = $("#address_insert").val();
        var designation = $("#designation_insert").val();
        var salary = $("#salary_insert").val();
        if(fullname == '' || phone == '' || email == '' || address == '' || designation == '' || salary == ''){
            $("#Error_Alert").show();
            $("#Error_Message").html("All Feilds Are Required");
        }else{
            $.ajax({
                url : "insert.php",
                type : "POST",
                data : {
                    fullname : fullname,
                    phone : phone,
                    email : email,
                    address : address,
                    designation : designation,
                    salary : salary
                },
                success : function () {
                    $("#fullname_insert").val('');
                    $("#phone_insert").val('');
                    $("#email_insert").val('');
                    $("#address_insert").val('');
                    $("#designation_insert").val('');
                    $("#salary_insert").val('');                    
                    $.get('Employee_ispresent.txt', function(data) {
                        if (data == "yes") {
                            $("#Error_Alert").show();
                            $("#Error_Message").html("Employee is Already Present");
                        } else {
                            $("#Success_Alert").show();
                            $("#Success_Message").html("Record Inserted Successfully");
                        }
                    });
                }
            });
        }
    });

    function viewDetails(fullname,phone,email,address,designation,salary){
        $("#modal_view").modal("show");
        $("#fullname_view").val(fullname);
        $("#phone_view").val(phone);
        $("#email_view").val(email);
        $("#address_view").val(address);
        $("#designation_view").val(designation);
        $("#salary_view").val(salary);
    }

    function updateDetails(fullname,phone,email,address,designation,salary){
        alert(fullname+" : "+phone+" : "+email+" : "+address+" : "+designation+" : "+salary);
        
        $("#Update_Success").hide();
        $("#Update_Danger").hide();
        
        $("#Update_Modal").modal("show");

        $("#fullname_update").val(fullname);
        $("#phone_update").val(phone);
        $("#email_update").val(email);
        $("#address_update").val(address);
        $("#designation_update").val(designation);
        $("#salary_update").val(salary);
        
        $("#update_btn").click(function () {
            
            var fullname = $("#fullname_update").val(); 
            var phone = $("#phone_update").val();
            var email = $("#email_update").val();
            var address = $("#address_update").val();
            var designation = $("#designation_update").val();
            var salary = $("#salary_update").val();
            
            if(phone == '' || email == '' || address == '' || designation == '' || salary == ''){
                $("#Update_Danger").show();
                $("#Message_UD").html("All Feilds Are Required");
            } else {
                $.ajax({
                    url : "update.php",
                    type : "POST",
                    data : {
                        fullname : fullname,
                        phone : phone,
                        email : email,
                        address : address,
                        designation : designation,
                        salary : salary
                    },
                    success : function () {
                        $.get('Update_Employee_status.txt', function(data) {
                            if(data == "yes"){
                                alert("Updated");
                                $("#Update_Success").show();
                                $("#Message_US").html("Employee Record Updated Successfully");
                            }else {
                                alert("Not Updated");
                                $("#Update_Danger").show();
                                $("#Message_UD").html("Employee Record Not Updated");
                            }
                        });
                    }
                });
            }
        });

    }

    function deleteDetails(fullname,phone,email,address,designation,salary){
        
        $.ajax({
            url : "delete.php",
            type : "POST",
            data : {
                fullname : fullname
            },
            success : function (){
                alert("Deleted Successfully");
            }
        });
    }
</script>