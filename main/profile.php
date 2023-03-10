<?php
session_start();

if(empty($_SESSION['id'])){
    header("location: ../auth/signin.php?error=loginrequired");
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
                    <div class="profile"><img src="../assets/images/team-6.jpg" alt="" srcset="">
                        <a href="account.php">
                            <span><i class="fa-solid fa-pen"></i></span>
                        </a>
                    </div>
                    <?php
                        require_once "../includes/connect.php";
                        $id = $_SESSION["id"];
                        $sql = "SELECT * FROM tbl_provider WHERE id = $id";
                        $result = mysqli_query($conn, $sql);

                        $num = mysqli_num_rows($result);
                        if(empty($num)){
                            header("location: ../auth/signin.php?error=loginrequired");
                        }
                        else{
                            while($row = mysqli_fetch_array($result)){
                        
                    ?>
                        
                    <h3 class="fw-bolder"><?php echo $row["prov_firstname"]?> <?php echo $row["prov_lastname"]?></h3>
                    <p class="lead mb-0"><?php echo $row["prov_email"]?></p>
                    <p class="lead mb-0"><?php echo $row["prov_category"]?></p>
                    <p class="lead mb-0"><?php echo $row["prov_bio"]?></p>
                    
                    <!-- <br>
                    <div class="input-group" style="max-width:500px;margin:auto;">
                        <input class="form-control" type="text" placeholder="Search..." aria-label="Search..." aria-describedby="button-search" style="background-color:rgba(255,255,255,0.5);color:#fff;"/>
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                                <h6 class="mt-2">Service Connection</h6> -->
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
                    <?php
                    if(isset($_POST["search"])){
                        echo "<h2 class=\"card-title\">Task</h2>";
                    echo "<div class=\"row row-cols-1 row-cols-md-2\">";
                        
                            require_once "../includes/connect.php";
                            $id = $_SESSION["id"];
                            $search = $_POST['search'];
                            $sql = "SELECT * FROM `tbl_task` WHERE ((task_title LIKE '%$search%') OR (task_desc LIKE '%$search%')) AND task_finder = $id ORDER BY id DESC"; 
                            $result = mysqli_query($conn, $sql);

                                $num = mysqli_num_rows($result); 
                                if($num == 0) {
                                    echo "<i mb-5>No related task to show.</i>";
                                }else{
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<div class=\"col\">";
                                        echo "<div class=\"card mb-4\">";
                                        echo "<div class=\"card-body\">";
                                        $date=date_create($row['task_date']);
                                        echo "<h2 class=\"card-title h4\">".$row['task_title']."</h2>";
                                        echo "<div class=\"small text-muted\">".date_format($date,"F d, Y")."</div>";

                                        if($row['task_status']=='Available'){
                                            echo "<span class=\"badge rounded-pill bg-warning text-dark\">".$row['task_status']."</span>";
                                        }elseif($row['task_status']=='Assigned'){
                                            echo "<span class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</span>";
                                        }elseif($row['task_status']=='Rejected'){
                                            echo "<span class=\"badge rounded-pill bg-danger\">".$row['task_status']."</span>";
                                        }elseif($row['task_status']=='Done'){
                                            echo "<span class=\"badge rounded-pill bg-success\">".$row['task_status']."</span>";
                                        }else{
                                            header("location: finder.php?error=undefine");
                                        }
                                                    
                                        echo "<p class=\"card-text related\">".$row['task_desc']."</p>";
                                        echo "<a class=\"btn btn-primary\" href=\"task-view.php?uid=".$_SESSION["id"]."&tid=".$row['id']."&category=".$row['task_category']."\">Learn more ???</a>"; 
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                        
                    echo "</div>";
                    }else{
                        echo "<div class=\"card mb-4\">";
                        /* <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a> */
                        echo "<div class=\"card-body\">";
                            /* <div class="small text-muted">January 1, 2022</div> */
                            echo "<h2 class=\"card-title\">Recent Task</h2>";
                            echo "<hr>";
                             
                                require_once "../includes/connect.php";
                                $id = $_SESSION["id"];
                                $sql = "SELECT * FROM `tbl_task` WHERE task_finder = $id ORDER BY id DESC"; /* add where clause here */
                                $result = mysqli_query($conn, $sql);

                                $num = mysqli_num_rows($result); 
                                if($num == 0) {
                                    echo "<i>No related task.</i>";
                                }else{
                                    while($row = mysqli_fetch_array($result)){
                                        
                                       echo "<div class=\"prof_tasks\">";
                                       echo "<h2 class=\"card-title h4 position-relative\">".stripslashes($row['task_title'])."</h2>";
                                       /* if($row['task_status']=='Pending'){
                                           echo "<span class=\"badge rounded-pill bg-warning text-dark\">".$row['task_status']."</span>";
                                       }elseif($row['task_status']=='Assigned'){
                                           echo "<span class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</span>";
                                       }elseif($row['task_status']=='Rejected'){
                                           echo "<span class=\"badge rounded-pill bg-danger\">".$row['task_status']."</span>";
                                       }elseif($row['task_status']=='Done'){
                                           echo "<span class=\"badge rounded-pill bg-success\">".$row['task_status']."</span>";
                                       }else{
                                           header("location: finder.php?error=undefine");
                                       }
                                       echo "<a class=\"btn btn-primary mb-5\" href=\"task-view.php?uid=".$_SESSION["id"]."&tid=".$row['id']."&category=".$row['task_category']."\">View Task ???</a>"; */
                                       echo "</div>";
                                       echo "<hr/>";
                                    }
                                }
                        echo"</div>";
                    echo "</div>";
                    
                    }
                    ?>
                    <!-- Pagination-->
                    <!-- <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                            <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                        </ul>
                    </nav> -->
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
        
    </body>
</html>
