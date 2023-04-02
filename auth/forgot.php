<?php
session_start();

if(!empty($_GET['email']) && $_GET['email']=='sent'){
  $showAlert = 'Email Sent';
}else if(!empty($_GET['password']) && $_GET['password']=='reset'){
  $showAlert = 'Password Changed';
}else{
  $showAlert = false;
}

// if(empty($_GET['email']) && empty($_GET['unicode'])){
//   header('location: forgot.php?actio=submit');
// }

  $passCode = 

$showError = false; 
if(isset($_POST['pass'])){
    include "../includes/connect.php";
    $email = $_POST["email"];
    $sql = "Select * from tbl_finder where finder_email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result); 

    if($num == 0){
        header("location: signin.php?error=nouser");
    }else{
        include "../includes/email.php";
        $email_subject = 'Reset Password';
        $code = uniqid();
        $email_content = forgot($code,$email);
        $finder_email = $email;
        $result = composeEmail($finder_email,$email_subject,$email_content);
          if (strpos($result, 'Mailer Error') !== false) {
              echo "Test passed: exception was caught";
          } else {
          include "../includes/connect.php";
          $query = "UPDATE tbl_finder SET `forgot_unicode` = '$code' WHERE finder_email = '$email'";
          $results = mysqli_query($conn, $query);
          if($results){
            header("location: forgot.php?email=sent");
          }
        }
        
    }
}

if(isset($_POST['reset'])){
  $email = $_POST['email'];
  $passCode = $_POST['code'];
  
  include "../includes/connect.php";
  $sql = "SELECT * FROM tbl_finder WHERE finder_email='$email' AND forgot_unicode = '$passCode'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result); 

    if($num == 0){
      header("location: forgot.php?error=nouser");
    }else{
      $password = $_POST['password'];
      $cpassword = $_POST['cpassword'];

      if($password == $cpassword){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE tbl_finder SET `forgot_unicode` = null,finder_password = '$hash' WHERE finder_email = '$email'";
        $results = mysqli_query($conn, $query);
          if($result){
            header("location: forgot.php?password=reset");
          }
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
  <link rel="icon" type="image/x-icon" href="../assets/images/hard-hat.png" />
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
        div.alert-success.close{
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
    
            <strong>Success!</strong> '.$showAlert.'
            <button type="button" onclick = "closeAlert();" class="close-success">
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
                      <button type="submit" class="btn btn-dark w-100 mt-4 mb-3" name="pass">Submit</button>
                      
                    </div>
                  </form>
                  <?php endif;?>
                  <?php if(!empty($_GET['action'] ) && $_GET['action'] == 'reset'):?>
                    <form role="form" method="post" action="forgot.php">
                    <!-- <label>Name</label>
                    <div class="mb-3">
                      <input type="text" class="form-control" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon">
                    </div> -->
                    
                      <input type="hidden" name="email" value = "<?php echo $_GET['email']?>">
                      <input type="hidden" name="code" value = "<?php echo $_GET['unicode']?>">
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
                      <button type="submit" class="btn btn-dark w-100 mt-4 mb-3" name="reset">Reset</button>
                      
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
  <script>
    const button = document.querySelector('.close-danger');
    button.addEventListener('click', closeAlert, false);

    const close = document.querySelector('.close-success');
    close.addEventListener('click', closeAlert, false)
    
    function closeAlert(){
        const closeDanger = document.querySelector('.alert');
        closeDanger.classList.add('close');
    }
    
    
  </script>
 
</body>

</html>