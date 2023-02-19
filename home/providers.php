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
                    <h1 class="fw-bolder">Providers Service Connection</h1>
                    <!-- <p class="lead mb-0">Find manual job service provider in your area now!</p> -->
                    <br>
                    <form action="providers.php" method="post">
                    <div class="input-group" style="max-width:500px;margin:auto;">
                        <input class="form-control" type="text" name="search" placeholder="Search..." aria-label="Search..." aria-describedby="button-search" style="background-color:rgba(255,255,255,0.5);color:#fff;"/>
                        <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                    </div>
                    </form>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    
                    <!-- Nested row for non-featured blog posts-->
                    <!-- <h2 class="card-title">Providers</h2> -->
                    <div class="row row-cols-1 row-cols-md-2 mb-5" style="overflow-x: hidden;overflow-y: auto;height:600px;">
                        <?php

                            if(isset($_POST["search"])){
                                require_once "../includes/connect.php";
                                $id = $_SESSION["id"];
                                $search = $_POST["search"];
                                $sql = "SELECT * FROM `tbl_provider` WHERE ((prov_category LIKE '%$search%') OR (prov_firstname LIKE '%$search%') OR (prov_lastname LIKE '%$search%'))"; /* add where clause here */
                                $result = mysqli_query($conn, $sql);
    
                                    $num = mysqli_num_rows($result); 
                                    if($num == 0) {
                                        echo "<i mb-5>No related searches to show.</i>";
                                    }else{
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<div class=\"col\">";
                                            echo "<div class=\"card mb-4\">";
                                            echo "<a href=\"#!\"><img class=\"card-img-top\" src=\"https://dummyimage.com/700x350/dee2e6/6c757d.jpg\" alt=\"...\" /></a>";
                                            echo "<div class=\"card-body\">";
                                            
                                            echo "<h2 class=\"card-title h4\">".$row['prov_firstname']." ".$row['prov_lastname']."</h2>";
                                            echo "<p class=\"card-text related\">".$row['prov_bio']."</p>";
                                            echo "<a class=\"btn btn-primary\" href=\"#\">Learn more →</a>"; /* add task id to this button to full view */
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                    }
                            }else{
                                require_once "../includes/connect.php";
                                $id = $_SESSION["id"];
                                
                                $sql = "SELECT * FROM `tbl_provider`"; /* add where clause here */
                                $result = mysqli_query($conn, $sql);
    
                                    $num = mysqli_num_rows($result); 
                                    if($num == 0) {
                                        echo "<i mb-5>No providers available to show.</i>";
                                    }else{
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<div class=\"col\">";
                                            echo "<div class=\"card mb-4\">";
                                            echo "<a href=\"#!\"><img class=\"card-img-top\" src=\"https://dummyimage.com/700x350/dee2e6/6c757d.jpg\" alt=\"...\" /></a>";
                                            echo "<div class=\"card-body\">";
                                            
                                            echo "<h2 class=\"card-title h4\">".$row['prov_firstname']." ".$row['prov_lastname']."</h2>";
                                            echo "<p class=\"card-text related\">".$row['prov_bio']."</p>";
                                            echo "<a class=\"btn btn-primary\" href=\"#\">Learn more →</a>"; /* add task id to this button to full view */
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
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
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Can't Decide From Service Connection? &#128549</div>
                        <div class="card-body">Create your own job posting and let service providers bid for your project &#128077
                            <br><br>
                        <a class="btn btn-success" href="task-create.php">Create Now →</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-2 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        
    </body>
</html>