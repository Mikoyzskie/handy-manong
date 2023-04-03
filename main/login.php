<?php
session_start();
  $showAlert = false; 
  $showError = false; 
  $exists=false;
  $password_login_value = "";
  $email_login_value = "";
if (empty($_SESSION["id"])) {
  if(!empty($_GET['error']) && ($_GET['error']=="incorrectpass")){
    $showError = "Email or password incorrect.";
  }
  if(!empty($_GET['error']) && ($_GET['error']=="verify")){
    $showError = "Please verify first.";
  }
  if(!empty($_GET['notif']) && ($_GET['notif']=="verified")){
    $showAlert = true; 
  }
  if(!empty($_GET['error']) && ($_GET['error']=="nouser")){
    $showError = "User does not exist. Signup instead.";
  }
  if(isset($_SESSION["password_login_failed"])) {
    $password_login_value = $_SESSION["password_login_failed"];
    unset($_SESSION["password_login_failed"]);
    $email_login_value = $_SESSION["email_login_failed"];
    unset($_SESSION["email_login_failed"]);
  } else {
    $password_login_value = "";
    $email_login_value = "";
  }
}else{
  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/x-icon" href="../assets/images/hard-hat.png" />
  <title>
    Provider Sign In | Handy Manong
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-sm top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid px-1">
            <a class="navbar-brand ms-lg-0 " href="../">
              Handy <strong>Manong</strong>
            </a>
            <div class="collapse navbar-collapse" id="navigation" style="justify-content:flex-end;">
              
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="../auth/signin.php" class="btn btn-sm mb-0 bg-gradient-dark">Finder Login</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <style>
        div.alert{
            position: absolute!important;
            top: 20px!important;
            right: 20px!important;
            z-index: 2000!important;
        }
        div.alert.close{
            display:none;
        }
        button.close-danger{
            border: 2px solid #8C2F25;
            color: #8C2F25;
            background: transparent;
            margin-left: 40px;
            border-radius: 5px;
        }
        button.close-success{
            border: 2px solid #3E7423;
            color: #3E7423;
            background: transparent;
            margin-left: 40px;
            border-radius: 5px;
        }
    </style>
  <?php
    
    if($showAlert) {
    
        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> Account Created & Verified. 
            <button type="button" class="close-success">
            x
        </button> 
        </div> '; 
    }
    
    if($showError) {
    
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
        <strong>Error!</strong> '. $showError.'
    
       <button type="button" class="close-danger">
            x
        </button>
     </div> '; 
   }
   ?>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-black text-dark display-6">Welcome back</h3>
                  <p class="mb-0">Welcome back! Please enter your details.</p>
                </div>
                <div class="card-body">
                  <form role="form" method="post" action="../auth/prov_login.php">
                    <!-- <label>Name</label>
                    <div class="mb-3">
                      <input type="text" class="form-control" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon">
                    </div> -->
                    <label>Email Address</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" placeholder="Enter your email address" aria-label="Email" aria-describedby="email-addon" name="email" required>
                    </div>
                    <label>Password</label>
                    <div class="d-flex mb-3">
                      <style>
                        
                        #password {
                        -webkit-text-security: disc;
                        -moz-text-security: disc;
                        text-security: disc;
                        }
                        .pass-input{
                          border-top-right-radius:0;
                          border-bottom-right-radius:0;
                        }
                        .pass-btn{
                          border-top-left-radius:0;
                          border-bottom-left-radius:0;
                        }
                        #password.show-password {
                        -webkit-text-security: none;
                        -moz-text-security: none;
                        text-security: none;
                        
                        }
                      </style>
                      <input type="password" id="myInput" value="" class="form-control pass-input" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" name="password" required>
                      <button class="btn pass-btn btn-outline-secondary toggle-password mb-0" type="button" onclick="myFunction()">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    <div class="d-flex align-items-center">
                      <!-- <div class="form-check form-check-info text-left mb-0">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="font-weight-normal text-dark mb-0" for="flexCheckDefault">
                          Remember for 14 days
                        </label>
                      </div> -->
                      <a href="forgot.php" class="text-xs font-weight-bold ms-auto text-dark">Forgot password</a>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-dark w-100 mt-4 mb-3" name="submit">Sign in</button>
                      <!-- <button type="button" class="btn btn-white btn-icon w-100 mb-3">
                        <span class="btn-inner--icon me-1">
                          <img class="w-5" src="../assets/img/logos/google-logo.svg" alt="google-logo" />
                        </span>
                        <span class="btn-inner--text">Sign in with Google</span>
                      </button> -->
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-xs mx-auto">
                    Don't have an account?
                    <a href="register.php" class="text-dark font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8" style="background-image:url('../assets/images/login.jpg')">
                  <div class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                    <h2 class="mt-3 text-dark font-weight-bold">Build a community with us.</h2>
                    <h6 class="text-dark text-sm mt-5">Copyright © 2023 Handy <strong>Manong</strong></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/corporate-ui-dashboard.min.js?v=1.0.0"></script>

  <script>
    const togglePassword = document.querySelector('.toggle-password');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
      /* const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type); */
      this.querySelector('i').classList.toggle('bi-eye');
      this.querySelector('i').classList.toggle('bi-eye-slash');
    });
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <script>
    const button = document.querySelector('.close-danger');
    button.addEventListener('click', closeAlert, false);
    function closeAlert(){
        const closeDanger = document.querySelector('.alert');
        closeDanger.classList.add('close');
    }
  </script>
</body>

</html>