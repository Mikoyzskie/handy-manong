<?php
session_start();

if(isset($_POST['submit'])){
    include "../includes/connect.php";
    $email = $_POST["email"];
    $sql = "Select * from tbl_finder where finder_email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result); 

    if($num == 0){
        header("location: signin.php?error=nouser");
    }else{
        include "../includes/email.php";
        $email_subject = 'Confirmation Email';
        $code = uniqid();
        $email_content = email($code);
        $finder_email = $email;
        $result = composeEmail($finder_email,$email_subject,$email_content);
        if (strpos($result, 'Mailer Error') !== false) {
            echo "Test passed: exception was caught";
        } else {
        $showAlert = true;
        $finder_name = "";
        $finder_email = "";
        $password = ""; 
        $cpassword = "";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <!-- <link rel="icon" type="image/png" href="../assets/img/favicon.png"> -->
  <title>
    Finder Sign In | Handy Manong
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
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-4">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-black text-dark display-6">Forgot Password</h3>
                  <p class="mb-0">Enter email address for password reset link.</p>
                </div>
                <div class="card-body">
                  <?php if(empty($_GET['action'])):?>
                    <form role="form" method="post" action="forgot.php">
                    <!-- <label>Name</label>
                    <div class="mb-3">
                      <input type="text" class="form-control" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon">
                    </div> -->
                    <label>Email Address</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" placeholder="Enter your email address" aria-label="Email" aria-describedby="email-addon" name="email" required autocomplete="off"/>
                    </div>
                   
                    <div class="d-flex align-items-center">
                      <a href="signin.php" class="text-xs font-weight-bold ms-auto">Sign In Instead</a>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-dark w-100 mt-4 mb-3" name="submit">Submit</button>
                      
                    </div>
                  </form>
                  <?php else:?>
                    <form role="form" method="post" action="forgot.php">
                    <!-- <label>Name</label>
                    <div class="mb-3">
                      <input type="text" class="form-control" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon">
                    </div> -->
                    <label>New Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" placeholder="Enter new password" aria-label="Email" aria-describedby="email-addon" name="password" required autocomplete="off"/>
                    </div>
                    <label>Confirm Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Email" aria-describedby="email-addon" name="cpassword" required autocomplete="off"/>
                    </div>
                   
                    <div class="d-flex align-items-center">
                      <a href="signin.php" class="text-xs font-weight-bold ms-auto">Sign In Instead?</a>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-dark w-100 mt-4 mb-3" name="submit">Reset</button>
                      
                    </div>
                  </form>
                  <?php endif;?>
                </div>
                
              </div>
            </div>
            <div class="col-md-6">
              <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8" style="background-image:url('../assets/images/forgot.jpg')">
                  
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
  
 
</body>

</html>