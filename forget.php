<!DOCTYPE html>
<html>

<head>
	<title></title>
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

		.form-control {
			height: 50px;
			font-size: 20px;
			border: none;
			border-bottom: 2px solid #D3D3D3;
			border-radius: 0;
			border-size: auto;
		}

		.form-control:focus {
			box-shadow: none;
			border-bottom: 2px solid #D3D3D3;
		}

		button {
			position: center;
		}
	</style>
</head>

<body>
	<br>
	<br><br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm">
			</div>
			<div class="col-sm">


				<div class="card" style="width: 22rem;">
					<div class="card-body">
						<br>
						<h3 class="text-center">Recover Password</h3>
						<br>
						<input  type="text" class="form-control" placeholder="Email" id = "email">
						<input type="password" class="form-control" placeholder="password" id = "password">
                        <input type="password" class="form-control" placeholder="password" id = "cpassword">
						<br>
						<button type="button" class="btn btn-secondary" id = "Btn_Update_Password"><i class="fas fa-edit"></i>  Change</button>
						<br><br>					
						<br>
						<br>
						<br>
					</div>
				</div>



			</div>
			<div class="col-sm">

			</div>
		</div>
	</div>





<!-------------------Temp Modal------------------------->
<div class="modal" tabindex="-1" role="dialog" id = "Temp_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id = "ModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id = "Message"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-------------------Temp Modal------------------------->
</body>

</html>
<script>
	


    $("#Btn_Update_Password").click(function () {
        var email = $("#email").val();
        var password = $("#password").val();
        var cpassword = $("#cpassword").val();

        if (email == '' || password == '' || cpassword == '') {
            $("#Temp_Modal").modal("show");
            $("#ModalTitle").html("Error");
            $("#Message").html("All Feilds Are Required");
        } else {
            if(password != cpassword){
                $("#Temp_Modal").modal("show");
                $("#ModalTitle").html("Error");
                $("#Message").html("Password Does not match");
            } else {
                $.ajax({
                    url : "ForgetProcessing.php",
                    type : "POST",
                    data : {
                        email : email,
                        password : password,
                        cpassword : cpassword
                    },
                    success : function () {
                        $.get('EmailPresent.txt', function(data) {
							if(data == "no"){
								alert("No email found");
							} else {
								alert("check mail : "+email+" to change password");
								$("#email").val('');
								$("#password").val('');
								$("#cpassword").val('');
							}
						});
                    }



                });



            }




        }








    
    });






</script>