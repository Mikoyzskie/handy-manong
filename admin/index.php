<?php 
include "../includes/connect.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Dashboard | Handy Manong</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Handy <strong>Manong</strong></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> -->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-auto me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Modal Task Create-->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered text-center d-flex justify-content-center modal-xl">
                <div class="modal-content w-75">
                    <div class="modal-body p-4">
                    <h2 class='card-title mb-3'>Create Task</h2>
                    <form method = "post" action="task-create.php?assign=<?php if(!empty($_GET['assign'])){echo $_GET['assign'];}?>">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" name="title" required/>
                                <div id="emailHelp" class="form-text">
                                    Brief intro about the task. (eg Carpenter & Paintjob)
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Location</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="location" required/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Salary Rate(Php)</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" name="rate" required/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="exampleInputPassword1" rows="4" name="description" required></textarea>
                            </div>
                            <div class="row justify-content-center">
                                <div>Category</div>
                                <p id="emailHelp" class="form-text">
                                    Select category that applies.
                                </p>
                                <div>
                                    <ul class="ks-cboxtags" style="padding-top:0;">
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxCar" value="Carpenter" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxCar">Carpenter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxPlum" value="Plumber" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxPlum">Plumber</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxPaint" value="Painter" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxPaint">Painter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxElec" value="Electrician" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxElec">Electrician</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxDriv" value="Driver" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxDriv">Driver</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxWeld" value="Welder" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxWeld">Welder</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxHouse" value="House Keeper" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxHouse">House Keeper</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxGlass" value="Glass Worker" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxGlass">Glass Worker</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxMid" value="Midwife" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxMid">Midwife</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="text-center"><button type="submit" class="btn btn-primary" name="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Finder Create -->
        <div class="modal fade" id="createFinder" tabindex="-1" aria-labelledby="createFinderLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered text-center d-flex justify-content-center modal-lg">
                <div class="modal-content w-75">
                    <div class="modal-body p-4">
                    <h2 class='card-title mb-3'>Create Finder Account</h2>
                    <form role="form" method="post" action="signup.php">
                        <label>Name</label>
                        <div class="mb-3">
                        <input type="text" class="form-control" value="" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon" name="name" required>
                        </div>
                        <label>Email Address</label>
                        <div class="mb-3">
                        <input type="email" class="form-control" value="" placeholder="Enter your email address" aria-label="Email" aria-describedby="email-addon" name="email" required>
                        </div>
                        <label>Password</label>
                        <div class="mb-3">
                        <input type="password" class="form-control" value="" placeholder="Create a password" aria-label="Password" aria-describedby="password-addon" name="password" required>
                        </div>
                        <label>Confirm Password</label>
                        <div class="mb-3">
                        <input type="password" class="form-control" value="" placeholder="Confirm your password" aria-label="Password" aria-describedby="password-addon" name="cpassword" required>
                        </div>
                        
                        <div class="text-center">
                        <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">Sign up</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Provider Create -->
        <div class="modal fade" id="createProvider" tabindex="-1" aria-labelledby="createProviderLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered text-center d-flex justify-content-center modal-xl">
                <div class="modal-content w-75">
                    <div class="modal-body p-4">
                    <h2 class='card-title mb-3'>Create Finder Account</h2>
                        <form role="form" method="post" action="register.php">
                                <label>First Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Enter your name"
                                        aria-label="Name" aria-describedby="name-addon" name="fname" required value="">
                                </div>
                                <label>Last Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Enter your name" aria-label="Name"
                                        aria-describedby="name-addon" name="lname" required value="">
                                </div>
                                <label>Email Address</label>
                                <div class="mb-3">
                                    <input type="email" class="form-control"
                                        placeholder="Enter your email address" aria-label="Email"
                                        aria-describedby="email-addon" name="email" required value="">
                                </div>
                                <label>Password</label>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Create a password"
                                        aria-label="Password" aria-describedby="password-addon" name="password"
                                        required value="">
                                </div>
                                <label>Confirm Password</label>
                                <div class="mb-3">
                                    <input type="password" class="form-control"
                                        placeholder="Confirm your password" aria-label="Password"
                                        aria-describedby="password-addon" name="cpassword" required value="">
                                </div>
                                <div class="row justify-content-center">
                                    <label>I am a...</label>
                                    <p id="emailHelp" class="form-text">
                                        Select category that applies.
                                    </p>
                                    <div>
                                    <ul class="ks-cboxtags" style="padding-top:0;">
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxOne" value="Carpenter" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxOne">Carpenter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxTwo" value="Plumber" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxTwo">Plumber</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxThree" value="Painter" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxThree">Painter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxFour" value="Electrician" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxFour">Electrician</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxFive" value="Driver" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxFive">Driver</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxSix" value="Welder" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxSix">Welder</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxSeven" value="House Keeper" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxSeven">House Keeper</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxEight" value="Glass Worker" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxEight">Glass Worker</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxNine" value="Midwife" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxNine">Midwife</label>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-dark w-100 mb-3">Sign up</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>


        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal" style="width: 60%;align-self: center;">
                                <i class="fa-solid fa-circle-plus"></i> Create
                            </button>
                            <!-- <a class="nav-link" href="index.html" data-mdb-toggle="modal" data-bs-target="#createModal">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i></div>
                                Create Task
                            </a> -->
                            <div class="sb-sidenav-menu-heading">users</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFinders" aria-expanded="false" aria-controls="collapseFinders">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                                    Finders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseFinders" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="finder.php">Tables</a>
                                    <a class="nav-link btn" data-bs-toggle="modal" data-bs-target="#createFinder" style="border:none!important;">Create</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProviders" aria-expanded="false" aria-controls="collapseProviders">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-helmet-safety"></i></div>
                                    Providers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProviders" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="provider.php">Tables</a>
                                    <a class="nav-link btn" data-bs-toggle="modal" data-bs-target="#createProvider" style="border:none!important;">Create</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                    Administrators
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAdmin" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#">Tables</a>
                                    <a class="nav-link" href="#">Create</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Account Settings
                            </a>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Profile
                            </a>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">

                            

                        </div>
                        <div class="row">
                            <style>
                                div.stats-card{
                                    position: relative;
                                }
                                div.stats-card span{
                                    position: absolute;
                                    top: 20px;
                                    right: 20px;
                                    font-size: 30px;
                                }
                            </style>
                            <?php 
                                $sql = "SELECT COUNT(*) AS tasks FROM tbl_task";
                                $results = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($results);

                                $finder = "SELECT COUNT(*) AS finder FROM tbl_finder";
                                $results = mysqli_query($conn, $finder);
                                $finders = mysqli_fetch_array($results);

                                $provider = "SELECT COUNT(*) AS provider FROM tbl_provider";
                                $results = mysqli_query($conn, $provider);
                                $providers = mysqli_fetch_array($results);
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4 task-pill">
                                    <div class="card-body stats-card overlay">
                                        <h2><?php echo $row['tasks']?></h2>
                                        <p>Total Tasks</p>
                                        <span><i class="fa-solid fa-screwdriver-wrench"></i></span>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between overlay-foot">
                                        <a class="small text-white stretched-link" href="#tasks">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4 finder-pill">
                                    <div class="card-body stats-card overlay">
                                        <h2><?php echo $finders['finder']?></h2>
                                        <p>Total Finders</p>
                                        <span><i class="fa-solid fa-user-tie"></i></span>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between overlay-foot">
                                        <a class="small text-white stretched-link" href="finder.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4 provider-pill">
                                    <div class="card-body stats-card overlay">
                                        <h2><?php echo $providers['provider']?></h2>
                                        <p>Total Providers</p>
                                        <span><i class="fa-solid fa-helmet-safety"></i></span>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between overlay-foot">
                                        <a class="small text-white stretched-link" href="provider.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4 admin-pill">
                                    <div class="card-body stats-card overlay">
                                        <h2>0</h2>
                                        <p>Active Administrators</p>
                                        <span><i class="fa-solid fa-users"></i></i></span>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between overlay-foot">
                                        <a class="small text-white stretched-link" href="admin.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Tasks Count (last 10 days)
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-1"></i>
                                        Task Status
                                    </div>
                                    <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4" id="tasks">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tasks Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Finder</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Provider</th>
                                            <th>Location</th>
                                            <th>Salary</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php
                                        include "../includes/connect.php";
                                        $sql = "SELECT * FROM tbl_task";
                                        $results = mysqli_query($conn, $sql);
                                        
                                    ?>

                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($results)){
                                                
                                                $finder = $row['task_finder'];
                                                $query = "SELECT * FROM tbl_finder WHERE finder_id = $finder";
                                                $result = mysqli_query($conn, $query);
                                                $rows = mysqli_fetch_array($result);

                                                
                                            ?>
                                            <tr>
                                                <td><?php echo $row['id']?></td>
                                                <td><?php echo $rows['finder_name']?></td>
                                                <td><?php echo $row['task_category']?></td>
                                                <td>
                                                    <?php
                                                        if($row['task_status']=='Available'){
                                                            echo "<p class=\"badge rounded-pill bg-warning text-dark\">".$row['task_status']."</p>";
                                                        }elseif($row['task_status']=='Assigned'){
                                                            echo "<p class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</p>";
                                                        }elseif($row['task_status']=='Rejected'){
                                                            echo "<p class=\"badge rounded-pill bg-danger\">".$row['task_status']."</p>";
                                                        }elseif($row['task_status']=='Done'){
                                                            echo "<p class=\"badge rounded-pill bg-success\">".$row['task_status']."</p>";
                                                        }elseif($row['task_status']=='Requested'){
                                                            echo "<p class=\"badge rounded-pill bg-primary\">".$row['task_status']."</p>";
                                                        }else{
                                                            
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $provider = $row['task_provider'];
                                                        if(!empty($provider)){
                                                            $query = "SELECT * FROM `tbl_provider` WHERE id = $provider";
                                                            $result = mysqli_query($conn, $query);
                                                            $prov = mysqli_fetch_array($result);

                                                            echo $prov['prov_firstname']." ".$prov['prov_lastname'];
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $row['task_location']?></td>
                                                <td><?php echo $row['rate']?></td>
                                                <td class="centered">
                                                   

                                                    <button class="btn btn-primary">Update</button>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>


                <!-- Modal -->
                <div class="modal top fade" id="staticBackdrop5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
                        <div class="modal-dialog modal-dialog-centered text-center d-flex justify-content-center">
                            <div class="modal-content w-75">
                                <div class="modal-body p-4">
                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20%281%29.webp" alt="avatar" class="rounded-circle position-absolute top-0 start-50 translate-middle h-50" />
                                    <form>
                                        <div>
                                            <h5 class="pt-5 my-3">Maria Doe</h5>

                                            <!-- password input -->
                                            <div class="form-outline mb-4">
                                                <input type="password" id="password1" class="form-control" />
                                                <label class="form-label" for="password1">Password</label>
                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Modal -->

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Handy <strong>Manong</strong> 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>

                

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <script>
            <?php
                $sql = "SELECT DISTINCT(task_date) FROM tbl_task ORDER BY id ASC LIMIT 10";
                $results = mysqli_query($conn, $sql);
                $dates = array();
                $counts = array();
                while($rows = mysqli_fetch_array($results)){
                    $date_str = $rows['task_date'];
                    $date = date("M d", strtotime($date_str));
                    array_push($dates,$date);

                    $query = "SELECT COUNT(*) AS count FROM tbl_task WHERE task_date = '$date_str'" ;
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($result)){
                        array_push($counts,$row['count']);
                    }
                }
                $quoted = array();
                while ($row = array_shift($dates)) {
                    $quoted[] = '"' . $row . '"';
                }
                
            ?>

            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Area Chart Example
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php echo implode(', ', $quoted);?>],
                datasets: [{
                label: "Tasks",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [<?php echo implode(', ', $counts);?>],
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 15,
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });

        </script>
        <?php 
            $request = "SELECT COUNT(*) as count FROM tbl_task WHERE task_status = 'Requested'";
            $assign = "SELECT COUNT(*) as count FROM tbl_task WHERE task_status = 'Assigned'";
            $avail = "SELECT COUNT(*) as count FROM tbl_task WHERE task_status = 'Available'";
            $done = "SELECT COUNT(*) as count FROM tbl_task WHERE task_status = 'Done'";
            $counts = array();
            $query_array = array($request,$assign,$avail,$done);
            

            foreach($query_array as $query){
                $results = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($results);
                array_push($counts,$row['count']);
            }

            
        ?>
        <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Pie Chart Example
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Requested", "Assigned", "Available", "Done"],
                datasets: [{
                data: [<?php echo implode(', ',$counts);?>],
                backgroundColor: ['#007bff', '#0DCAF0', '#ffc107', '#28a745'],
                }],
            },
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
