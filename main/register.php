<?php
    
$showAlert = false; 
$showError = false; 
$exists=false;
    
if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    include '../includes/connect.php';   
    
    $prov_fname = $_POST["fname"];
    $prov_lname = $_POST["lname"];
    $prov_email = $_POST["email"];
    $password = $_POST["password"]; 
    $cpassword = $_POST["cpassword"];
    $catArray = $_POST["category"];
    $category = implode(',',$catArray);      
    
    $sql = "SELECT * FROM tbl_provider WHERE prov_email='$prov_email'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0) {
        if(($password == $cpassword) && $exists==false) {
            if(empty($catArray)){
                $showError = "Checkbox category empty.";
            }else{

                include '../includes/email.php';
                $email_subject = 'Confirmation Email';
                $code = uniqid();
                $email = $prov_email;
                $folder = "main";
                $email_content = email($code,$email,$folder);
                $result = composeEmail($email,$email_subject,$email_content);
                if (strpos($result, 'Mailer Error') !== false) {
                    $showError = $result;
                } else {

                    $hash = password_hash($password, PASSWORD_DEFAULT);
                        
                    // Password Hashing is used here.
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `tbl_provider`(`prov_firstname`, `prov_lastname`, `prov_category`, `prov_password`, `prov_email`,`code`) 
                    VALUES ('$prov_fname','$prov_lname','$category','$hash','$prov_email','$code')";
                    $results = mysqli_query($conn, $sql);

                    if ($results) {
                        $showAlert = true;
                        $prov_fname = "";
                        $prov_lname = "";
                        $prov_email = "";
                        $password = "";
                        $cpassword = "";
                        $catArray = "";
                        
                    }
                }
            }
        } 
        else { 
            $showError = "Passwords do not match"; 
        }      
    }
    
   if($num>0) 
   {
      $exists="Email already exist. Sign-in instead."; 
   }
   
    
}else{
    $prov_fname = "";
    $prov_lname = "";
    $prov_email = "";
    $password = "";
    $cpassword = "";
    $catArray = "";
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
        Provider Sign Up | Handy Manong
    </title>
    <!--     Fonts and icons     -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700"
        rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link rel="stylesheet" href="main.css">
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav
                    class="navbar navbar-expand-lg blur border-radius-sm top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid px-1">
                        <a class="navbar-brand ms-lg-0 " href="../">
                            Handy <strong>Manong</strong>
                        </a>
                        
                        <div class="collapse navbar-collapse" id="navigation" style="justify-content:flex-end;">
                            
                            <ul class="navbar-nav d-lg-block d-none" >
                                <li class="nav-item">
                                    <a href="../auth/signup.php"
                                        class="btn btn-sm mb-0 bg-gradient-dark">Finder Sign Up</a>
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
    
            <strong>Success!</strong> Email Verification Sent! 
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
        
    if($exists) {
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert">
    
        <strong>Error!</strong> '. $exists.'
        <button type="button" class="close-danger" on>
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
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 start-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute d-flex fixed-top ms-auto h-100 z-index-0 bg-cover me-n8"
                                    style="background-image:url('../assets/images/register.png')">
                                    <div class="my-auto text-start max-width-350 ms-7">
                                        <h1 class="mt-3 text-white font-weight-bolder">Start your <br> new journey.</h1>
                                        <p class="text-white text-lg mt-4 mb-4">Register and create endless possibilities with us.</p>
                                    </div>
                                    <div class="text-start position-absolute fixed-bottom ms-7">
                                        <h6 class="text-white text-sm mb-5">Copyright © 2023 Handy <strong>Manong</strong></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-7">
                                <div class="card-header px-0 py-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6">Register</h3>
                                    <p class="mb-0">Nice to meet you! Please enter your details.</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="post" action="register.php">
                                        <label>First Name</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Enter your name"
                                                aria-label="Name" aria-describedby="name-addon" name="fname" required value="<?php echo $prov_fname?>">
                                        </div>
                                        <label>Last Name</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Enter your name" aria-label="Name"
                                                aria-describedby="name-addon" name="lname" required value="<?php echo $prov_lname?>">
                                        </div>
                                        <label>Email Address</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control"
                                                placeholder="Enter your email address" aria-label="Email"
                                                aria-describedby="email-addon" name="email" required value="<?php echo $prov_email?>">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" minlength="8" class="form-control passwordToCheck" placeholder="Create a password"
                                                aria-label="Password" aria-describedby="password-addon" name="password"
                                                required value="<?php echo $password?>">
                                                <span class="passwordCheck"></span>
                                        </div>
                                        <label>Confirm Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control"
                                                placeholder="Confirm your password" aria-label="Password"
                                                aria-describedby="password-addon" minlength="8" name="cpassword" required value="<?php echo $cpassword?>">
                                        </div>
                                        <div class="row justify-content-center">
                                            <label>I am a...</label>
                                            <p id="emailHelp" class="form-text">
                                                Select category that applies.
                                            </p>
                                            <div>
                                                <ul class="ks-cboxtags" style="padding-top:0;padding-left:0;padding-right:0;margin-bottom:0;">
                                                    <li>
                                                        <input type="checkbox" class="acb" id="checkboxOne" value="Carpenter" name="category[]" onclick="deRequire('acb')" required>
                                                        <label for="checkboxOne">Carpenter</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" class="acb" id="checkboxTwo" value="Plumber" name="category[]" onclick="deRequire('acb')" required>
                                                        <label for="checkboxTwo">Plumber</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" class="acb" id="checkboxThree" value="Painter" name="category[]" onclick="deRequire('acb')" required>
                                                        <label for="checkboxThree">Painter</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" class="acb" id="checkboxFour" value="Electrician" name="category[]" onclick="deRequire('acb')" required>
                                                        <label for="checkboxFour">Electrician</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" class="acb" id="checkboxFive" value="Driver" name="category[]" onclick="deRequire('acb')" required>
                                                        <label for="checkboxFive">Driver</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" class="acb" id="checkboxSix" value="Welder" name="category[]" onclick="deRequire('acb')" required>
                                                        <label for="checkboxSix">Welder</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" class="acb" id="checkboxSeven" value="House Keeper" name="category[]" onclick="deRequire('acb')" required>
                                                        <label for="checkboxSeven">House Keeper</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" class="acb" id="checkboxEight" value="Glass Worker" name="category[]" onclick="deRequire('acb')" required>
                                                        <label for="checkboxEight">Glass Worker</label>
                                                    </li>
                                                    <li>
                                                        <style>
                                                            input.acbi{
                                                                border-radius: 50px;
                                                                border: 1.5px solid rgba(139, 139, 139, 0.3);
                                                                
                                                                padding: 8px 12px;
                                                                font-size: 0.8125rem;
                                                            }
                                                            input.acbi::placeholder{
                                                                color: rgba(139, 139, 139, 0.3);
                                                            }
                                                            
                                                        </style>
                                                        <input type="text" class='acbi' placeholder="Others..." id="otherCat" name="category[]">
                                                        <!-- <label for="checkboxEight">Others...</label> -->
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-dark w-100 mb-3 acbii" id="buttonSubmit">Sign up</button>
                                            
                      
                                        </div>
                                        <script>
                                            const fverifier = document.querySelector('.passwordCheck');
                                            const finputPassword = document.querySelector('.passwordToCheck');
                                            const buttonSubmit= document.getElementById('buttonSubmit');
                                            
                                            function hasNumber(str) {
                                                return /[0-9]/.test(str) && /[^A-Za-z0-9]/.test(str);
                                            }
                                            const interval = setInterval(function() {
                                                if(finputPassword.value.length >= 8 && hasNumber(finputPassword.value)){
                                                    fverifier.innerHTML = "Password Valid"
                                                    fverifier.style.color = "green";
                                                    fverifier.style.fontSize = "12px";
                                                    
                                                }else{
                                                    fverifier.innerHTML = "Must contain 8 characters, 1 number, & 1 special character";
                                                    fverifier.style.color = "red";
                                                    fverifier.style.fontSize = "12px";
                                                    
                                                }
                                            }, 3000)
                                        </script>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto">
                                        Already have an account?
                                        <a href="login.php" class="text-dark font-weight-bold">Sign in</a>
                                    </p>
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
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/corporate-ui-dashboard.min.js?v=1.0.0"></script>
    <script>
        const button = document.querySelector('.close-danger');
        button.addEventListener('click', closeAlert, false);
        function closeAlert() {
            const closeDanger = document.querySelector('.alert');
            closeDanger.classList.add('close');
        }
    </script>
    <script>
        let checking = false;
        function check(){
            const otherCat = document.querySelector('#otherCat');
            if(otherCat.value.length > 0){
                otherCat.required = true;
                checking = true;
                deRequire('acb',checking);
                console.log('not empty');
            }else{
                otherCat.required = false;
                deRequire('acb');
                console.log('empty');
            }
        }
        setInterval(check, 1000);

        function deRequire(elClass,checks){
            el = document.getElementsByClassName(elClass);
            var atLeastOneChecked = false; //at least one cb is checked
            for (i = 0; i < el.length; i++) {
                if (el[i].checked === true) {
                    atLeastOneChecked = true;
                    console.log('true');
                }              
            }

            if (atLeastOneChecked === true || checks === true) {
                for (i = 0; i < el.length; i++) {
                    el[i].required = false;
                }
            } else {
                for (i = 0; i < el.length; i++) {
                    el[i].required = true;
                }
            }
        }

        // function checker(){
        //     if(inputStatus.value.length > 0){
        //         // if(deRequire('acbi') === true){
        //         //     input.disabled = false;
        //         // }
        //         input.disabled = false;
                
        //     }else{
        //         setInterval(deRequire,1000);
        //     }
        // }
        // setInterval(deRequire,1000);
        // setInterval(checker,1000);
        // function deRequire() {
        
       
        // var atLeastOneChecked = false; //at least one cb is checked
        // for (i = 0; i < el.length; i++) {
        //     if (el[i].checked === true) {
        //         atLeastOneChecked = true;
        //         console.log('true');
        //     }              
        // }

        //     if (atLeastOneChecked === true) {
        //         for (i = 0; i < el.length; i++) {
        //             input.disabled = false;
        //             el[i].required = false;
        //         }
        //         clearInterval(deRequire);
                
        //     } else {
        //         for (i = 0; i < el.length; i++) {
        //             input.disabled = true;
        //             el[i].required = true;
        //         }
                
        //         checker();
        //     }
        // }
        
    </script>
</body>

</html>