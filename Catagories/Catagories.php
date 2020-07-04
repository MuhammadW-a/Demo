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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catagories</title>
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
        <a class="navbar-brand" href="#"><i class="fas fa-shapes"></i> Catagories</a>
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
            <th><i class="fas fa-th-list"></i> Catagory</th>
            <th><i class="fas fa-sort-numeric-down"></i> Discription</th>
            <th>View</th>
            <th>Update</th>
    </tr>
    <tbody id="data">
            <?php
        $sql = "SELECT * FROM catagory";
        $data = mysqli_query($conn, $sql);
        while ($rowdata = mysqli_fetch_assoc($data)) {
        ?>
                <tr>
                    
                    <td><?php echo $rowdata['CatagoryName']?></td>
                    <td><?php echo $rowdata['CatagoryDescription']?></td>
                    <td><button type="button" class="btn btn-info" onclick="viewDetails(  '<?php echo $rowdata['CatagoryName']; ?>'  ,  '<?php echo $rowdata['CatagoryDescription']; ?>' )"><i class="far fa-eye"></i> View</button></td>
                    <td><button type="button" class="btn btn-warning" onclick="updateDetails( '<?php echo $rowdata['CatagoryName']; ?>'  ,  '<?php echo $rowdata['CatagoryDescription']; ?>'  )"><i class="fas fa-edit"></i> Update</button></td>
                </tr>
        <?php        
            }
        ?>
        </tbody>
    </table>
</div>

<!---------INSERT MODAL--------->
<div class="modal" tabindex="-1" role="dialog" id = "Insert_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Catagory</h5>
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
        <input type="text" class="form-control" placeholder="Name" id = "CName" aria-label="Username" aria-describedby="basic-addon1">
        </div>

<!--------------------->
        <lable>Discription : </lable><br>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Description" id = "CDescription" aria-label="Username" aria-describedby="basic-addon1">
        </div>
<!--------------------->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id = "Insert_Catagory">Add</button>
      </div>
    </div>
  </div>
</div>
<!---------INSERT MODAL--------->


<!----------View Modal--------------->
<div class="modal" tabindex="-1" role="dialog" id = "View_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View Catagory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-------------->
        <lable>Name : </lable><br>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Name" readonly id = "VCName" aria-label="Username" aria-describedby="basic-addon1">
        </div>

<!-------------->
        <lable>Discription : </lable><br>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Description" readonly id = "VCDescription" aria-label="Username" aria-describedby="basic-addon1">
        </div>
<!--------------------->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!----------View Modal--------------->


<!----------Update Modal------------->

<div class="modal" tabindex="-1" role="dialog" id = "Update_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-------------->
        <lable>Name : </lable><br>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Name" readonly id = "UCName" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <!-------------->
        <lable>Discription : </lable><br>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Description" id = "UCDescription" aria-label="Username" aria-describedby="basic-addon1">
        </div>
      </div>
        <!-------------->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id = "Update_Catagory">Update</button>
      </div>
    </div>
  </div>
</div>


<!----------Update Modal------------->





















</body>

<script>
    
    $(document).ready(function () {
        setInterval(() => {
            $("#data").load("fetch.php");
        }, 1000);
    });

    $("#open_insert").click(function name() {
        $("#Insert_Modal").modal("show");
    });
    
    
    
    $("#Insert_Catagory").click(function () {
        var name = $("#CName").val();
        var description = $("#CDescription").val();
        if(name == '' || description == ''){
            alert("All Feilds Are Required");
        } else {
            $.ajax({
                url : "insert.php",
                type : "POST",
                data : {
                    name : name,
                    description : description
                },
                success : function () {
                    $.get('Catagory_Check.txt',function (data) {
                        if(data == "no"){
                            $("#CName").val('');
                            $("#CDescription").val('');
                            alert("data inserted successfully");
                            $("#Insert_Modal").modal("hide");
                            $("#CName").val('');
                            $("#CDescription").val('');
                        } else {
                            alert("This catagory is already present");
                        }
                    });
                }
            });
        }
    });




    function viewDetails(catagory, description) {
        $('#View_Modal').modal("show");
        $('#VCName').val(catagory);
        $('#VCDescription').val(description);
    }


    function updateDetails(catagory, description) {
        alert(catagory+" : "+description);
        
        $('#Update_Modal').modal("show");
        $('#UCName').val(catagory);
        $('#UCDescription').val(description);

        var aname = $('#UCName').val();
        var adescription = $('#UCDescription').val();


        $("#Update_Catagory").click(function () {
           
           
           var name = $('#UCName').val();
           var description = $('#UCDescription').val();
           
            if (name == '' || description == '') {
                alert("All Feilds Are Required"); 
            } 
            else if (description == adescription) {
                alert("You've Changed Nothing");
            }
            else {
                 
                    $.ajax({
                        url : "Update.php",
                        type : "POST",
                        data : {
                            name : name,
                            description : description
                        },
                        success : function(){
                            $.get('Catagory_Check_Update.txt',function (data) {
                            if(data == "yes"){
                                $("#UCName").val('');
                                $("#UCDescription").val('');
                                $('#Update_Modal').modal("hide");
                            } else {
                                
                            }
                        });
                        }
                    });
                
            }



        });


    }

   



</script>