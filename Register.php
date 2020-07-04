<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src = "js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<style type="text/css">
		body{
			background-image: url("Register_Background.jpg");
			background-size: cover;
			background-attachment: fixed;
		}
		.form-control{
			height: 50px;
			font-size: 20px;
			border: none;
			border-bottom: 2px solid #D3D3D3;
			border-radius: 0;
			border-size : auto;
		}
		.form-control:focus{
			box-shadow: none;
			border-bottom: 2px solid #D3D3D3;
		}
		button{
			position: center;
		}
		.login{
			float: center;
		}
		.forget{
			float: right;
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
			    <h3 class="text-center">REGISTER</h3>
				<br>
				  
				  <input type="text" class="form-control" placeholder="Username" id = "username">
				 
				  <input type="text" class="form-control" placeholder="Phone" id = "phone">
				  
				  <input type="text" class="form-control" placeholder="Email" id = "email">
				 
				  <input type="password" class="form-control" placeholder="password" id = "password">
				 
				  <input type="password" class="form-control" placeholder="confirm password" id = "cpassword">
				  
				  <br>
				
				<button type="button" id = "btn_register" class="btn btn-secondary"><i class="fas fa-sign-in-alt"></i> Register</button> | <a href="Login" class= "text-center login">Login</a>
				
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


<!------------Multipurpose Modal--------------->
<div class="modal" tabindex="-1" role="dialog" id = "Multi_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id = "Temp_Modal_Header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p  id = "Temp_Modal_Message"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!------------Multipurpose Modal--------------->
	
</body>
</html>
<script>
	$(document).ready(function () {
		$("#btn_register").click(function () {
			var username = $("#username").val();
			var phone = $("#phone").val();
			var email = $("#email").val();
			var password = $("#password").val();
			var cpassword = $("#cpassword").val();

			if(username == '' || phone == '' || email == '' || password == '' || cpassword == ''){
				$("#Multi_Modal").modal("show");
				$("#Temp_Modal_Header").html("Error");
				$("#Temp_Modal_Message").html("All Feilds Are Required");
			} else {
				if(password != cpassword){
					$("#Multi_Modal").modal("show");
					$("#Temp_Modal_Header").html("Error");
					$("#Temp_Modal_Message").html("Passwords Are Not Same");
				} else {
					$.ajax({
						url : "CreateUser.php",
						type : "POST",
						data : {
							username : username,
							phone : phone,
							email : email,
							password : password,
							cpassword : cpassword
						},
						success : function () {
							$.get('User_Presence.txt', function(data) {
								if (data == "yes") {
									$("#Multi_Modal").modal("show");
									$("#Temp_Modal_Header").html("Error");
									$("#Temp_Modal_Message").html("User Already Present");
								} if (data == "no") {
									
									$("#username").val("");
									$("#phone").val("");
									$("#email").val("");
									$("#password").val("");
									$("#cpassword").val("");
									$("#Multi_Modal").modal("show");
									$("#Temp_Modal_Header").html("Success");
									$("#Temp_Modal_Message").html("Check Email TO Verify Your Account : "+email);
									location.replace("Login");
								}
							});
						}




					});
				}
			}
		





		});




	});






</script>