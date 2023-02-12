<?php
session_start();

if(empty($_SESSION['id'])){
    header("location: login.php?error=loginrequired");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="main.css" rel="stylesheet" />
</head>
<style>
    .card-text {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* number of lines to show */
        line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Handy <strong>Manong</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="../auth/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page header with logo and tagline-->
    <header class="mt-5 py-5 bg-light border-bottom mb-4 text-white">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Service <em>Connection</em>!</h1>
                <p class="lead mb-0">Find manual job service provider in your area now!</p>
                <br>
                <div class="input-group" style="max-width:500px;margin:auto;">
                    <input class="form-control" type="text" placeholder="Search..." aria-label="Search..."
                        aria-describedby="button-search" style="background-color:rgba(255,255,255,0.5);color:#fff;" />
                    <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                </div>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Featured blog post-->
                <div class="card mb-4">
                    <!-- <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a> -->
                    <div class="card-body">
                        <!-- <div class="small text-muted">January 1, 2022</div> -->
                        <h2 class="card-title">Latest Connect</h2>
                        <hr>
                        <?php
                                require_once "../includes/connect.php";
                                $id = $_SESSION["id"];
                                $sql = "SELECT * FROM `tbl_task` WHERE task_finder = $id ORDER BY id DESC LIMIT 1 "; /* add where clause here */
                                $result = mysqli_query($conn, $sql);

                                $num = mysqli_num_rows($result); 
                                if($num == 0) {
                                    echo "<i>No related task.</i>";
                                }else{
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<h2 class=\"card-title h4 position-relative\">".$row['task_title']."</h2>";
                                        if($row['task_status']=='Pending'){
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
                                        $date=date_create($row['task_date']);
                                        echo "<div class=\"small text-muted\">".date_format($date,"F d, Y")."</div>";
                                        echo "<p class=\"card-text related\">".$row['task_desc']."</p>";
                                        echo "<a class=\"btn btn-primary\" href=\"task-view.php?uid=".$_SESSION["id"]."&tid=".$row['id']."&category=".$row['task_category']."\">View Task →</a>";
                                    }
                                }

                                
                            ?>


                    </div>
                </div>
                <!-- Nested row for non-featured blog posts-->
                <h2 class="card-title">Recent Connects</h2>
                <div class="row row-cols-1 row-cols-md-2">
                    <?php
                            require_once "../includes/connect.php";
                            $id = $_SESSION["id"];
                            $sql = "SELECT * FROM `tbl_task` WHERE task_finder = $id ORDER BY id DESC"; /* add where clause here */
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

                                        if($row['task_status']=='Pending'){
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
                                        echo "<a class=\"btn btn-primary\" href=\"task-view.php?uid=".$_SESSION["id"]."&tid=".$row['id']."&category=".$row['task_category']."\">Learn more →</a>"; /* add task id to this button to full view */
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                        ?>
                </div>
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
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search..." aria-label="Search..."
                                aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Capenter</a></li>
                                    <li><a href="#!">Plumber</a></li>
                                    <li><a href="#!">Painter</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Electrician</a></li>
                                    <li><a href="#!">Driver</a></li>
                                    <li><a href="#!">Welder</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">House Keeper</a></li>
                                    <li><a href="#!">Glass Worker</a></li>
                                    <li><a href="#!">Midwife</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Can't Decide From Service Connection? &#128549</div>
                    <div class="card-body">Create your own job posting and let service providers bid for your project
                        &#128077
                        <br><br>
                        <a class="btn btn-success" href="task-create.php">Create Now →</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-2 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>

</body>

</html>