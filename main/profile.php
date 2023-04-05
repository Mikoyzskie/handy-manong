<?php
session_start();

if(empty($_SESSION['id'])){
    header("location: ../auth/signin.php?error=loginrequired");
}

$showAlert = false; 
$showError = false; 
$exists=false;

if(!empty($_GET['status']) && $_GET['status']=="passwordupdated"){
    $showAlert = "Password successfully updated."; 
}
if(!empty($_GET['status']) && $_GET['status']=="updatedbio"){
    $showAlert = "Bio successfully updated."; 
}
if(!empty($_GET['status']) && $_GET['status']=="nameupdated"){
    $showAlert = "Name successfully updated."; 
}
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
        <script src="https://kit.fontawesome.com/1b7409057b.js" crossorigin="anonymous"></script>
    </head>
    <style>
    .card-text{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* number of lines to show */
                line-clamp: 2; 
        -webkit-box-orient: vertical;
    }
    .prof_tasks{
        display:flex;
        flex-direction:column;
    }
    div.stats-container{
        display: flex;
        justify-content: space-around;
        text-align: center;
    }
    p.stats-item{
        display: flex;
        flex-direction: column;
    }
</style>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="timeline.php">Handy <strong>Manong</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="tasks.php">Tasks</a></li>
                        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="account.php">Account Settings</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="../auth/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="mt-5 py-5 bg-light border-bottom mb-4 text-white">
        
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
                <div class="text-center my-5">
                <style>
                        .profile{
                            height: 120px;
                            width: 120px;
                            background-color:#fff;
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
                        }
                    </style>

                    <div class="profile">
                    <?php
                        require_once "../includes/connect.php";
                        
                        if(empty($_GET['uid'])){
                            $id = $_SESSION["id"];
                            $sql = "SELECT * FROM tbl_provider WHERE id = $id";
                        }else{
                            $id = $_GET['uid'];
                            $sql = "SELECT * FROM tbl_finder WHERE finder_id = $id";
                        }
                        $result = mysqli_query($conn, $sql);

                        $num = mysqli_num_rows($result);
                        if(empty($num)){
                            header("location: profile.php?error=nouser");
                        }
                        else{
                            while($row = mysqli_fetch_array($result)){
                        
                    ?>
                    
                        <?php
                            if(empty($row['avatar'])):
                        ?>
                        <img src="../assets/images/avatar.jpg" alt="" srcset="">
                        <?php else:?>
                            <img src="../assets/images/uploads/<?php echo $row['avatar']?>" alt="" srcset="">
                        <?php endif;?>
                    
                        <?php
                            if(empty($_GET['uid'])){
                        ?>
                        <a href="account.php">
                            <span><i class="fa-solid fa-pen"></i></span>
                        </a>
                        <?php
                            }else{
                                /* This hides edit button */
                            }
                        ?>
                    </div>

                    <?php if(empty($_GET['uid'])):?>
                        <h3 class="fw-bolder"><?php echo $row["prov_firstname"]?> <?php echo $row["prov_lastname"]?></h3>
                        <p class="lead mb-0"><?php echo $row["prov_email"]?></p>
                        <p class="lead mb-0"><?php echo $row["prov_category"]?></p>
                        <p class="lead mb-0"><?php echo $row["prov_bio"]?></p>
                    <?php else:?>
                        <h3 class="fw-bolder"><?php echo $row["finder_name"];?></h3>
                        <p class="lead mb-0"><?php echo $row["finder_email"];?></p>
                    <?php endif;?>
                        
                    
                    
                    
                    
                    <?php
                            } 
                        };
                    ?>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                        

                        <!-- OWN PROFILE -->
                        <?php if(empty($_GET['uid'])):?>

                                <?php
                                
                                    require_once "../includes/connect.php";

                                    // Tasks Requested
                                    $id = $_SESSION["id"];
                                    $sql = "SELECT * FROM `request` WHERE prov_id = $id";
                                    $result = mysqli_query($conn, $sql);
                                    $num = mysqli_num_rows($result);


                                    // Tasks Completed
                                    $total_task = "SELECT * FROM tbl_task WHERE task_provider = $id AND task_status = 'Done'";
                                    $result_total = mysqli_query($conn, $total_task);
                                    $total = mysqli_num_rows($result_total);
                                ?>
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <h2 class="card-title">Task Highlights</h2>
                                            <hr>
                                            <div class="stats-container">
                                                <div class="stats-item">
                                                    <h2 class="stats-count"><?php echo $num?></h2>
                                                    <p class="stats-description">Tasks Requested</p>
                                                </div>
                                                <div class="stats-item">
                                                    <h2 class="stats-count"><?php echo $total;?></h2>
                                                    <p class="stats-description">Tasks Completed</p>
                                                </div>
                                                <!-- <div class="stats-item">
                                                    <h2 class="stats-count">12</h2>
                                                    <p class="stats-description">Tasks </p>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    //Finder/s Connected
                                    $total_finders = "SELECT DISTINCT('task_finder') FROM tbl_task WHERE task_provider = $id";
                                    $result_finders = mysqli_query($conn, $total_finders);
                                    $finders = mysqli_num_rows($result_finders);

                                    //Total Transactions
                                    $transactions_total = "SELECT * FROM tbl_task WHERE task_provider = $id";
                                    $result_transactions = mysqli_query($conn, $transactions_total);
                                    $transactions = mysqli_num_rows($result_transactions);

                                    //Finder Requests
                                    $all_requests = "SELECT * FROM finder_request WHERE assign = $id";
                                    $results_all_requests = mysqli_query($conn, $all_requests);
                                    $requests = mysqli_num_rows($results_all_requests);
                                    
                                ?>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h2 class="card-title">Service Connection Highlights</h2>
                                        <hr>
                                        <div class="stats-container">
                                            <div class="stats-item">
                                                <h2 class="stats-count"><?php echo $finders?></h2>
                                                <p class="stats-description">Finder/s Connected</p>
                                            </div>
                                            <div class="stats-item">
                                                <h2 class="stats-count"><?php echo $transactions?></h2>
                                                <p class="stats-description">Total Transactions</p>
                                            </div>
                                            <div class="stats-item">
                                                <h2 class="stats-count"><?php echo $requests?></h2>
                                                <p class="stats-description">Finder Task Request/s</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h2 class="card-title">Recent Completed Tasks</h2>
                                <hr>

                                <div class="row row-cols-1 row-cols-md-2 mb-5">
                                    
                                    <?php if($total == 0):?>
                                            <i mb-5>No related task to show.</i>
                                    <?php else:
                                        $i = 0;
                                        while($row = mysqli_fetch_array($result_total)){
                                            if($i == 4){
                                                break;
                                            }

                                    ?>

                                            <div class="col">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                    
                                                        <h2 class="card-title h4"><?php echo $row['task_title']?></h2>
                                                        <div class="small text-muted"><?php echo $row['task_desc']?></div>                           
                                                    </div>
                                                </div>
                                            </div>
                                                    
                                    
                                    <?php
                                            $i = $i + 1;
                                        } 
                                
                                        endif;
                                    ?>
                                    
                                </div>


                        <!-- IF CHECKSOUT FINDER PROFILE -->
                        <?php else:?>

                                <?php
                                
                                    require_once "../includes/connect.php";

                                    $id = $_GET['uid'];
                                    $sql = "SELECT * FROM `tbl_task` WHERE task_finder = $id AND task_status = 'Done' AND task_provider != 0 OR task_provider != NULL ORDER BY id DESC"; /* add where clause here */
                                    $result = mysqli_query($conn, $sql);
                                    $num = mysqli_num_rows($result);

                                    $total_task = "SELECT * FROM tbl_task WHERE task_finder = $id";
                                    $result_total = mysqli_query($conn, $total_task);
                                    $total = mysqli_num_rows($result_total);

                                    if($total == 0){
                                        header("location: profile.php?error=nouser");
                                    }
                                ?>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h2 class="card-title">Task Highlights</h2>
                                        <hr>
                                        <div class="stats-container">
                                            <div class="stats-item">
                                                <h2 class="stats-count"><?php echo $total?></h2>
                                                <p class="stats-description">Tasks Created</p>
                                            </div>
                                            <div class="stats-item">
                                                <h2 class="stats-count"><?php echo $num?></h2>
                                                <p class="stats-description">Tasks Completed</p>
                                            </div>
                                            <!-- <div class="stats-item">
                                                <h2 class="stats-count">12</h2>
                                                <p class="stats-description">Tasks </p>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    $rates_total = "SELECT `rate` FROM `tbl_task` WHERE task_finder = $id";

                                    /* AND task_status = 'Done' */
                                    $result_rates = mysqli_query($conn, $rates_total);
                                    $rates = mysqli_num_rows($result_rates);
                                    $sum_rate = 0;

                                    function format_number($num) {
                                        if ($num >= 1000000) {
                                        return round($num / 1000000, 1) . 'M';
                                        } else if ($num >= 1000) {
                                        return round($num / 1000, 1) . 'K';
                                        } else {
                                        return $num;
                                        }
                                    }
                                    while($rate = mysqli_fetch_array($result_rates)){
                                        $i = $rate['rate'];
                                        $sum_rate =+ $i;
                                    }
                                    
                                    $connects_total = "SELECT COUNT(DISTINCT `task_provider`) AS 'count' FROM `tbl_task` WHERE `task_finder`= $id AND `task_provider` != 0";
                                    $result_connects = mysqli_query($conn, $connects_total);
                                    $connects = mysqli_fetch_array($result_connects);

                                    $transactions_total = "SELECT COUNT(*) AS 'transactions' FROM `tbl_task` WHERE task_finder = $id AND task_status != 'Available'";
                                    $result_transactions = mysqli_query($conn, $transactions_total);
                                    $transactions = mysqli_fetch_array($result_transactions);
                                    
                                ?>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h2 class="card-title">Service Connection Highlights</h2>
                                        <hr>
                                        <div class="stats-container">
                                            <div class="stats-item">
                                                <h2 class="stats-count"><?php echo $connects['count']?></h2>
                                                <p class="stats-description">Provider/s Connected</p>
                                            </div>
                                            <div class="stats-item">
                                                <h2 class="stats-count"><?php echo $transactions['transactions']?></h2>
                                                <p class="stats-description">Total Transactions</p>
                                            </div>
                                            <div class="stats-item">
                                                <h2 class="stats-count">&#8369;<?php echo format_number($sum_rate);?></h2>
                                                <p class="stats-description">Total Payout</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h2 class="card-title">Recent Completed Tasks</h2>
                                <hr>

                                <div class="row row-cols-1 row-cols-md-2 mb-5">
                            
                                    <?php if($num == 0):?>
                                            <i mb-5>No related task to show.</i>
                                    <?php else:
                                        $i = 0;
                                        while($row = mysqli_fetch_array($result)){
                                            if($i == 4){
                                                break;
                                            }
                                            $user = $row['task_provider'];
                                            $query = "SELECT * FROM `tbl_provider` WHERE id = $user";
                                            $provider = mysqli_query($conn, $query);
                                        ?>

                                            <div class="col">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h2 class="card-title h4"><?php echo $row['task_title']?></h2>
                                                        <div class="small text-muted"><?php echo $row['task_desc']?></div>
                                                        <?php $select = mysqli_fetch_array($provider);?>
                                                        <p class="card-text related"><strong>Provider: </strong><?php echo $select['prov_firstname']?> <?php echo $select['prov_lastname']?></p>
                                                    </div>
                                                </div>
                                            </div>
                                                    
                                    
                                        <?php
                                            $i = $i + 1;
                                        } 
                                
                                        endif;
                                        ?>
                                </div>


                        <?php endif;?>
                    
                    
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Find Task</div>
                        <div class="card-body">
                        <form role="form" action="tasks.php" method="post">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search..." aria-label="Search..." aria-describedby="button-search" name="search" required/>
                                <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Connects</div>
                        <div class="card-body">
                            <!-- <div class="row">
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                    <form action="tasks.php" method="post">
                                        <li><input type="submit" value="Carpenter"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Plumber"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Painter"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                    </form>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                    <form action="tasks.php" method="post">
                                        <li><input type="submit" value="Electrician"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Driver"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Welder"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                    </form>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                    <form action="tasks.php" method="post">
                                        <li><input type="submit" value="House Keeper"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Glass Worker"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Midwife"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                    </form>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- Side widget-->
                    
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
