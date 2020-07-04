<?php
  session_start();
  if(!isset($_SESSION['USERNAME_SESSION'])){
    ?>
      <script>
        location.replace("Login");
      </script>
    <?php
  }
?>
<!DOCTYPE html>
<html>

<head>
  <title>Main Menu</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

  <style type="text/css">
    
  #Unh{
    margin-left: 80px;
  }


    body{
			background-image: url("Register_Background.jpg");
			background-size: cover;
			background-attachment: fixed;
		}
     .sidebar {
      height: 100%;
      /* 100% Full-height */
      width: 0;
      /* 0 width - change this with JavaScript */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Stay on top */
      top: 0;
      left: 0;
     background-color : grey;
      overflow-x: hidden;
      /* Disable horizontal scroll */
      padding-top: 60px;
      /* Place content 60px from the top */
      transition: 0.5s;
      /* 0.5 second transition effect to slide in the sidebar */
    }

    /* The sidebar links */
    .sidebar a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 15px;
      color: white;
      display: block;
      transition: 0.3s;
    }

    /* When you mouse over the navigation links, change their color */
    .sidebar a:hover {
      color: #f1f1f1;
    }

    /* Position and style the close button (top right corner) */
    .sidebar .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }

    /* The button used to open the sidebar */
    .openbtn {
      font-size: 20px;
      cursor: pointer;
      background-color: #111;
      color: white;
      padding: 10px 15px;
      border: none;
    }

    .openbtn:hover {
      background-color: #444;
    }

    /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
    #main {
      transition: margin-left .5s;
      /* If you want a transition effect */
      padding: 20px;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
      .sidebar {
        padding-top: 15px;
      }

      .sidebar a {
        font-size: 15px;
      }
    }

    .btn-danger {
      float: right;
    }
    
  </style>

</head>

<body>
  
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">Main Menu</a>
    
    <button type="button" class="btn btn-danger" id = "logoutbtn"><i class="fas fa-sign-out-alt"></i> Logout
      <a href="Logout.php"></a>
    </button>
  </nav>
  <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<br>
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
      <div class="card-header"><i class="fas fa-user"></i> <?php echo $_SESSION['USERNAME_SESSION']?></div>
      <div class="card-body">
        <p class="card-text"><i class="fas fa-envelope-square"></i> <?php echo $_SESSION['USEREMAIL_SESSION']?></p>
      </div>
    </div>

    <a href="#"> <i class="fa fa-home"></i>  Home</a>
    <hr>
    <a href="#"><i class="fab fa-servicestack"></i> Services</a>
    <hr>
    <a href="#"><i class="fas fa-address-book"></i> Contact</a>
    <hr>
    <a href="Sales/sales"><i class="fas fa-money-bill-wave-alt"></i> Sales</a>
    <hr>
    <a href="#" id = "SupMenu"><i class="far fa-sticky-note"></i> Reports  <i class="fas fa-arrow-down" id = "Unh"></i></a>
    <hr>

<div id = "ChildMenu">
    <ul>
      <a href="Products/products"><i class="fab fa-product-hunt"></i> Products</a>
      <hr>
      <a href="Catagories/catagories"><i class="fas fa-th-list"></i> Catagories</a>
      <hr>
      <a href="Employees/employees"><i class="fas fa-users"></i> Employees</a>
      <hr>
      <a href="Customers/customers"><i class="fas fa-users"></i> Customers</a>
      <hr>
    </ul>
</div>


  </div>

  <div id="main">
    <button class="openbtn" onclick="openNav()">&#9776; </button>
  </div>
  <div class="container">
    <br><br>
    <div class="row">
      <div class="col-sm">
                  <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                  <div class="card-header"><i class="fab fa-product-hunt"></i> Products</div>
                  <div class="card-body">
                    <h5 class="card-title">Products Information</h5>
                    
                  </div>
                </div>
      </div>
      <div class="col-sm">
              <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
              <div class="card-header"><i class="fas fa-users"></i> Employess</div>
              <div class="card-body">
                <h5 class="card-title">Employees Information</h5>
              </div>
              </div>
      </div>
      <div class="col-sm">
              <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
              <div class="card-header"><i class="fas fa-users"></i> Customers</div>
              <div class="card-body">
                <h5 class="card-title">Customers Information</h5>
              </div>
            </div>
      </div>
    </div>
  </div>
</body>

</html>
<script type="text/javascript">



  $("#SupMenu").click(function(){
    $("#ChildMenu").toggle("slow");
  });






 




    $("#logoutbtn").click(function () {
      location.replace("Logout.php");
    });
    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }

    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
    }
</script>