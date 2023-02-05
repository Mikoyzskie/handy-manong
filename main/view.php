<?php
session_start();

if(empty($_SESSION['id'])){
    header("location: ../login.php?error=loginrequired");
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

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="finder.php">Handy <strong>Manong</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="finder.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page header with logo and tagline-->
    <header class="mt-5 py-5 bg-light border-bottom mb-4 text-white">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Try Service <em>Connection</em> instead?</h1>
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
                <div class="card mb-4 md-4">
                    <!-- <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a> -->
                    <div class="card-body">
                        <!-- <div class="small text-muted">January 1, 2022</div> -->
                        <?php
                                require_once "../includes/connect.php";
                                $uid = $_GET["uid"];
                                $id = $_GET["tid"];
                                if($uid != $_SESSION["id"]){
                                    header("location: finder.php?error=notask");
                                }
                                elseif(empty($id)){
                                    header("location: finder.php?error=notask");
                                }else{
                                    $sql = "SELECT `id`, `task_date`, `task_finder`, `task_category`, `task_status`, `task_title`, `task_desc`, `task_location`, `task_provider`,`finder_name` FROM `tbl_task` INNER JOIN `tbl_finder` ON tbl_task.task_finder = tbl_finder.finder_id WHERE id = $id"; /* add where clause here */
                                    $result = mysqli_query($conn, $sql);
                                    $num = mysqli_num_rows($result);
                                    if($num == 0){
                                        header("location: finder.php?error=notask");
                                    }
                                    while($row = mysqli_fetch_array($result)){
                                        
                                        echo "<h2 class=\"card-title\">". $row['task_title']."</h2>";
                                        echo "<hr>";
                                        echo "<h2 class=\"card-title h4 position-relative\">".$row['task_category']."</h2>";
                                        echo "<p>by: ".$row['finder_name']."</p>"; /* union with table finder to get name */
                                        if($row['task_status']=='Pending'){
                                            echo "Status: <p class=\"badge rounded-pill bg-warning text-dark\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Assigned'){
                                            echo "Status: <p class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Rejected'){
                                            echo "Status: <p class=\"badge rounded-pill bg-danger\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Done'){
                                            echo "Status: <p class=\"badge rounded-pill bg-success\">".$row['task_status']."</p>";
                                        }else{
                                            header("location: finder.php?error=undefine");
                                        }

                                        $date=date_create($row['task_date']);

                                        echo "<p>Date Posted: <span class=\"small text-muted\">".date_format($date,"F d, Y")."</span></p>"; /* fix date format */
                                        echo "Description:";
                                        echo "<p class=\"card-text ps-4\">".nl2br($row['task_desc'])."</p>"; /* fix formating do not remove spacing */
                                        echo "<p>Location: ".$row['task_location']."</p>";
                                        echo "<p>Assigned to: <a href=\"#\">".$row['task_provider']."</a></p>"; /* add functiona link of the profile + provider proper name + function if empty */
                                    }
                                }
                                
                            ?>

                        <a class="btn btn-primary" href="#!">Update</a> <!-- add update function -->
                        <a class="btn btn-danger" href="#!">Delete</a>
                        <!-- add function if task is assigned, unable to delete unless completed -->
                    </div>
                </div>
                <h2 class="card-title">Related Tasks</h2>
                <style>
                    .card-text.related {
                        overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                        /* number of lines to show */
                        line-clamp: 2;
                        -webkit-box-orient: vertical;
                    }
                </style>
                <div class="row row-cols-1 row-cols-md-2">
                    <?php
                            require_once "../includes/connect.php";
                            $id = $_GET['tid'];
                            $category = $_GET['category'];
                            $sql = "SELECT * FROM `tbl_task` WHERE id <> $id AND `task_finder` = ".$_SESSION['id']." AND `task_category`= '".$category."'";
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
                                        echo "<a class=\"btn btn-primary\" href=\"task-view.php?uid=".$_SESSION["id"]."&tid=".$row['id']."&category=".$row['task_category']."\">Read more →</a>"; /* add task id to this button to full view */
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                        ?>
                </div>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Chatter</div>
                    <div class="card-body">
                        <p>From <a href="#">Mikoy</a>: Interested. Check my profile.</p>
                        <p>From <a href="#">Mikoy</a>: Interested. Check my profile.</p>
                        <p>From <a href="#">Mikoy</a>: Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea,
                            dicta.</p>
                        <a class="btn btn-secondary" href="#!">View All →</a>
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
    <footer class="py-2 bg-dark mt-5">
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