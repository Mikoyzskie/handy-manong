<?php
session_start();


    if (isset($_SESSION["old_input_value"])) {
        $password_input_value = $_SESSION["old_input_value"];
        unset($_SESSION["old_input_value"]);
        $password_new_value = $_SESSION["new_input_value"];
        unset($_SESSION["new_input_value"]);
        $password_confirm_value = $_SESSION["confirm_input_value"];
        unset($_SESSION["confirm_input_value"]);
    } else {
        $password_input_value = "";
        $password_new_value = "";
        $password_confirm_value = "";
    }
        

if(empty($_SESSION['id'])){
    header("location: ../signin.php?error=loginrequired");
}

$showAlert = false; 
$showError = false; 
$exists=false;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Handy Manong</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="styles.css" rel="stylesheet" />
        <link href="main.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/1b7409057b.js" crossorigin="anonymous"></script>
        <script>
            
        </script>
    </head>
<style>
    ul.ks-cboxtags {
        list-style: none;
        padding: 20px;
    }

    ul.ks-cboxtags li {
        display: inline;
    }

    ul.ks-cboxtags li label {
        display: inline-block;
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(139, 139, 139, 0.3);
        color: #adadad;
        border-radius: 25px;
        white-space: nowrap;
        margin: 3px 0px;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
        -webkit-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        font-weight: 400;
    }

    ul.ks-cboxtags li label {
        padding: 8px 12px;
        cursor: pointer;
    }

    ul.ks-cboxtags li label::before {
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        font-family: "FontAwesome";
        font-weight: 400;
        font-size: 12px;
        padding: 2px 6px 2px 2px;
        content: "\f067";
        -webkit-transition: -webkit-transform .3s ease-in-out;
        transition: -webkit-transform .3s ease-in-out;
        -o-transition: transform .3s ease-in-out;
        transition: transform .3s ease-in-out;
        transition: transform .3s ease-in-out, -webkit-transform .3s ease-in-out;
    }

    ul.ks-cboxtags li input[type="checkbox"]:checked+label::before {
        content: "\f00c";
        -webkit-transform: rotate(-360deg);
        -ms-transform: rotate(-360deg);
        transform: rotate(-360deg);
        -webkit-transition: -webkit-transform .3s ease-in-out;
        transition: -webkit-transform .3s ease-in-out;
        -o-transition: transform .3s ease-in-out;
        transition: transform .3s ease-in-out;
        transition: transform .3s ease-in-out, -webkit-transform .3s ease-in-out;
    }

    ul.ks-cboxtags li input[type="checkbox"]:checked+label {
        border: 1px solid #fec771;
        background-color: #fec771;
        color: #fff;
        -webkit-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
    }

    ul.ks-cboxtags li input[type="checkbox"] {
        display: absolute;
    }

    ul.ks-cboxtags li input[type="checkbox"] {
        position: absolute;
        opacity: 0;
    }
</style>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="finder.php">Handy <strong>Manong</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!-- <li class="nav-item"><a class="nav-link active" href="#">Home</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="providers.php">Providers</a></li>
                        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="account.php">Account Settings</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="../auth/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="mt-5 py-5 bg-light border-bottom mb-4 text-white">
            <div class="container">
                <div class="text-center my-5">

                    <h1 class="fw-bolder">Account Settings</h1>
                    
                </div>
            </div>
        </header>
        <!-- Page content-->

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
    </style>
  <?php
    
    if($showAlert) {
    
        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> Profile Updated.
            <button type="button">
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

        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4 md-4">
                        <!-- <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a> -->
                        <div class="card-body">
                            <!-- <div class="small text-muted">January 1, 2022</div> -->
                            <h2 class="card-title">Update Profile</h2>
                            <hr>
                            <style>
                        .profile{
                            height: 120px;
                            width: 120px;
                            background-color:#212529;
                            margin:auto;
                            border-radius:50%;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            position:relative;
                        }
                        .profile img{
                            width:auto;
                            height:110px;
                            border-radius:50%;
                            
                        }
                        .profile span{
                            position:absolute;
                            bottom:0;
                            right: 5px;
                            background-color:#fff;
                            color:#000;
                            border-radius:50%;
                            height: 30px;
                            width: 30px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            background-color:#212529;
                            color:#fff;
                        }
                        .custom-file-upload:hover{
                            cursor:pointer;
                        }
                        input[type="file"] {
                            display: none;
                        }
                        .profile-form{
                            display:flex;
                            flex-direction:column;
                            justify-content:center;
                        }
                        .profile-form button{
                            width: fit-content;
                            align-self: center;
                        }
                    </style>
                    <form name="avatarForm" class="profile-form" action="update.php" method="post" enctype="multipart/form-data">
                        <div class="profile">
                        <?php
                            require_once "../includes/connect.php";
                            
                            if(empty($_GET['uid'])){
                                $id = $_SESSION["id"];
                                $sql = "SELECT * FROM tbl_finder WHERE finder_id = $id";
                            }else{
                                $id = $_GET['uid'];
                                $sql = "SELECT * FROM tbl_provider WHERE id = $id";
                            }
                            $result = mysqli_query($conn, $sql);

                            $num = mysqli_num_rows($result);
                            if(empty($num)){
                                header("location: ../auth/signin.php?error=loginrequired");
                            }
                            else{
                                $row = mysqli_fetch_array($result);
                                if(empty($row['avatar'])):
                            
                        ?>
                            
                                <img id="preview" src="../assets/images/avatar.jpg" alt="Preview Image" srcset="">
                            <?php
                                else:
                            ?>
                                <img id="preview" src="../assets/images/uploads/<?php echo $row['avatar']?>" alt="Preview Image" srcset="">
                            <?php
                                endif;
                            ?>
                            <span>
                                <label class="custom-file-upload"><i class="fa-solid fa-pen"></i><label>
                                <input id="file-upload" name="image" type="file" accept="image/jpeg,image/png,image/gif" onchange="previewImage(event)" required/>
                            </span>
                        
                        </div>
                        <button type="submit" name="avatarSubmit" class="btn btn-primary my-3">Update Profile</button>
                    </form>
                    
                        <form method = "post" action="update.php">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <div class="input-group">
                                <input type="text" class="form-control" name="name" id="name_input"
                                    aria-describedby="emailHelp" required value="<?php echo $row['finder_name']?>" disabled/>
                                    <button class="btn btn-primary" id="name" type="button" onclick="toggleName()">Edit</button>
                                    <button style="display:none;" class="btn btn-primary" id="name_submit" name="name_submit" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                        <form method = "post" action="update.php">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email</label>
                                <div class="input-group">
                                <input type="text" class="form-control" id="email_input"
                                    aria-describedby="emailHelp" name="email" required value="<?php echo $row['finder_email']?>" disabled/>
                                    <button class="btn btn-primary" id="email" type="button" onclick="toggleEmail()">Edit</button>
                                    <button style="display:none;" class="btn btn-primary" id="email_submit" name="email_submit" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                        <form method = "post" action="update.php">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Old Password</label>
                                <div class="input-group">
                                <input type="password" class="form-control" id="password_input"
                                    aria-describedby="emailHelp" name="old_pass" value="<?php echo $password_input_value?>" required disabled/>
                                    <button class="btn btn-primary" id="password" type="button" onclick="togglePassword()">Edit</button>
                                    
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">New Password</label>
                                <div class="input-group">
                                <input type="password" class="form-control" id="new_password"
                                    aria-describedby="emailHelp" name="new_pass" value="<?php echo $password_new_value?>" required disabled/>
                                    
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Confirm Password`</label>
                                <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password"
                                    aria-describedby="emailHelp" name="confirm_pass" value="<?php echo $password_confirm_value?>" required disabled/>
                                    
                                </div>
                            </div>
                            <div class="text-center"><button style="display:none; margin:auto;" id="password_submit"  type="submit" class="btn btn-primary" name="password_submit">Submit</button></div>
                            
                        </form>
                        <?php
                                }
                        ?>
                    </div>
                </div>
            </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Find Task</div>
                        <div class="card-body">
                        <form role="form" action="finder.php" method="post">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search..." aria-label="Search..." aria-describedby="button-search" name="search" required/>
                                <button class="btn btn-primary" id="button-search" type="submit" name="submit">Go!</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                        <div class="row">
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                    <form action="providers.php" method="post">
                                        <li><input type="submit" value="Carpenter"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Plumber"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Painter"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                    </form>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                    <form action="providers.php" method="post">
                                        <li><input type="submit" value="Electrician"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Driver"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Welder"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                    </form>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                    <form action="providers.php" method="post">
                                        <li><input type="submit" value="House Keeper"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Glass Worker"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Midwife"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                    </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Footer-->
        <!-- <footer class="py-2 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer> -->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('preview');
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }
            function toggleName() {
                const x = document.getElementById("name");
                const y = document.getElementById("name_submit");
                const z = document.getElementById("name_input");
                
                x.style.display = (x.style.display === "none") ? "block" : "none";
                y.style.display = (y.style.display === "none") ? "block" : "none";
                z.disabled = !z.disabled;
            }

            function toggleEmail() {
                const x = document.getElementById("email");
                const y = document.getElementById("email_submit");
                const z = document.getElementById("email_input");
                
                x.style.display = (x.style.display === "none") ? "block" : "none";
                y.style.display = (y.style.display === "none") ? "block" : "none";
                z.disabled = !z.disabled;
            }

            function togglePassword() {
                const x = document.getElementById("password");
                const y = document.getElementById("password_submit");
                const z = document.getElementById("password_input");
                const a = document.getElementById("new_password");
                const b = document.getElementById("confirm_password");
                
                x.style.display = (x.style.display === "none") ? "block" : "none";
                y.style.display = (y.style.display === "none") ? "block" : "none";
                z.disabled = !z.disabled;
                a.disabled = !a.disabled;
                b.disabled = !b.disabled;
            }

            <?php
                if (!empty($password_input_value)) {
                    echo "togglePassword();";
                } else {
                    $password_input_value = "";
                }
            ?>
            
            
        
        </script>

    </body>
</html>
