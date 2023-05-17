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
        <link rel="icon" type="image/x-icon" href="../assets/images/hard-hat.png" />
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
    a.dropdown-toggle::after{
        display:none;
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
                        <!-- <li class="nav-item"><a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-solid fa-bell"></i></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </li> -->
                        <style>
                            i.fa-solid.fa-bell{
                                position: relative;
                            }
                            i.fa-solid.fa-bell:after{
                                position: absolute;
                                top:-5px;
                                right:-5px;
                                background-color: red;
                                height: 10px;
                                width: 10px;
                                content:"";
                                display: block;
                                border-radius: 10px;
                            }
                            ul.navbar-nav{
                                position: relative;
                            }
                            ul.dropdown-menu[data-bs-popper] {
                                top: 100%;
                                right: 0;
                                width: 250px;
                                left: unset;
                            }
                        </style>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <style>
            header{
                background-image:url(../assets/images/finder_hero.jpg)!important;
                background-repeat: no-repeat!important;
                background-size: cover!important;
                background-position: 50% 40%!important;
            }

        </style>
        <header class="mt-5 py-5 bg-light border-bottom mb-4 text-white">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Service <em>Connections</em>!</h1>
                    <p class="lead mb-0">Find manual job service provider in your area now!</p>
                    <br>
                    <form action="providers.php" method="post">
                    <div class="input-group" style="max-width:500px;margin:auto;">
                        <input class="form-control" type="text" name="search" placeholder="Search..." aria-label="Search..." aria-describedby="button-search" style="background-color:rgba(255,255,255,0.7);color:#fff;"/>
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
                
                    <!-- Featured blog post-->
                    <?php

                        if(!empty($_GET["sortby"])){

                            $sort = $_GET["sortby"];
                            echo "<div class='col-lg-8'>";
                        echo "<div class=\"card mb-4\">";
                        /* <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a> */
                        echo "<div class=\"card-body\">";
                            /* <div class="small text-muted">January 1, 2022</div> */
                            echo "<h2 class=\"card-title\">Recent Task</h2>";
                            echo "<hr>";
                             
                                require_once "../includes/connect.php";
                                $id = $_SESSION["id"];
                                $sql = "SELECT * FROM `tbl_task` WHERE task_finder = $id AND task_status = '$sort' ORDER BY id DESC LIMIT 1 "; /* add where clause here */
                                $result = mysqli_query($conn, $sql);

                                $num = mysqli_num_rows($result); 
                                if($num == 0) {
                                    echo "<i>No related task.</i>";
                                }else{
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<h2 class=\"card-title h4 position-relative\">".stripslashes($row['task_title'])."</h2>";
                                        if($row['task_status']=='Available'){
                                            echo "<span class=\"badge rounded-pill bg-warning text-dark\">".$row['task_status']."</span>";
                                        }elseif($row['task_status']=='Assigned'){
                                            echo "<span class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</span>";
                                        }elseif($row['task_status']=='Working'){
                                            echo "Status: <p class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Requested'){
                                            echo "Status: <p class=\"badge rounded-pill bg-primary\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Rejected'){
                                            echo "<span class=\"badge rounded-pill bg-danger\">".$row['task_status']."</span>";
                                        }elseif($row['task_status']=='Done'){
                                            echo "<span class=\"badge rounded-pill bg-success\">".$row['task_status']."</span>";
                                        }else{
                                            echo "<span class=\"badge rounded-pill bg-danger\">".$row['task_status']."</span>";
                                        }
                                        $date=date_create($row['task_date']);
                                        echo "<div class=\"small text-muted\">".date_format($date,"F d, Y")."</div>";
                                        echo "<p class=\"card-text related\">Php ".$row['rate']."</p>";
                                        echo "<a class=\"btn btn-primary\" href=\"task-view.php?uid=".$_SESSION["id"]."&tid=".$row['id']."&category=".$row['task_category']."\">View Task →</a>";
                                    }
                                }
                        echo"</div>";
                        echo "</div>";
                        /* Nested row for non-featured blog posts */
                        echo "<h2 class=\"card-title\">All Tasks</h2>";
                        echo "<div class=\"row row-cols-1 row-cols-md-2 mb-5\">";
                            
                        require_once "../includes/connect.php";
                    
                        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                            $page_no = $_GET['page_no'];
                        }else {
                            $page_no = 1;
                        }
                            
                        $total_records_per_page = 6;
                        $offset = ($page_no-1) * $total_records_per_page;
                        $previous_page = $page_no - 1;
                        $next_page = $page_no + 1;
                        $adjacents = "2"; 

                        $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM tbl_task WHERE task_finder = $id AND task_status = '$sort'");
                        $total_records = mysqli_fetch_array($result_count);
                        $total_records = $total_records['total_records'];
                        $total_no_of_pages = ceil($total_records / $total_records_per_page);
                        $second_last = $total_no_of_pages - 1; // total page minus 1
                                
                            
                            $id = $_SESSION["id"];
                            $sql = "SELECT * FROM `tbl_task` WHERE task_finder = $id AND task_status = '$sort' ORDER BY id DESC LIMIT $offset, $total_records_per_page"; /* add where clause here */
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
                                        }elseif($row['task_status']=='Working'){
                                            echo "Status: <p class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Assigned'){
                                            echo "<span class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</span>";
                                        }elseif($row['task_status']=='Rejected'){
                                            echo "<span class=\"badge rounded-pill bg-danger\">".$row['task_status']."</span>";
                                        }elseif($row['task_status']=='Requested'){
                                            echo "Status: <p class=\"badge rounded-pill bg-primary\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Done'){
                                            echo "<span class=\"badge rounded-pill bg-success\">".$row['task_status']."</span>";
                                        }else{
                                            echo "<span class=\"badge rounded-pill bg-danger\">".$row['task_status']."</span>";
                                        }
                                                    
                                        echo "<p class=\"card-text related\">Php ".$row['rate']."</p>";
                                        echo "<a class=\"btn btn-primary\" href=\"task-view.php?uid=".$_SESSION["id"]."&tid=".$row['id']."&category=".$row['task_category']."\">Learn more →</a>"; /* add task id to this button to full view */
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                                echo "</div>";
                            ?>

                <nav aria-label="Pagination">
                        <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
    
                        <li class='page-item' <?php if($page_no <= 1){ echo "class='page-item disabled'"; } ?>>
                            <a class='page-link'<?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
                        </li>
                        
                        <?php 
                            if ($total_no_of_pages <= 10){  	 
                                for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                                    if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                        }else{
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                        }
                                }
                            }
                        elseif($total_no_of_pages > 10){
                            
                        if($page_no <= 4) {			
                            for ($counter = 1; $counter < 8; $counter++){		 
                                if ($counter == $page_no) {
                                    echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                }else{
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                            echo "<li class='page-item'><a class='page-link'>...</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                        }elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item'><a class='page-link'>...</a></li>";
                            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
                            if ($counter == $page_no) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                    }else{
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }                  
                        }
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
                                }
                            
                            else {
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item'><a class='page-link'>...</a></li>";
                    
                            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                            if ($counter == $page_no) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                    }else{
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }                   
                                    }
                                }
                        }
                    ?>
                        
                        <li class='page-item' <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
                        <a class='page-link' <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
                        </li>
                        <?php if($page_no < $total_no_of_pages){
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                            } ?>
                    </ul>
                </nav>


                         <?php       
                                echo "</div>";
                        }else{
                            header("location: finder.php");
                        }

                    ?>

                
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Find Task</div>
                        <div class="card-body">
                        <form role="form" action="finder.php" method="post">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search..." aria-label="Search..." aria-describedby="button-search" name="query" required/>
                                <button class="btn btn-primary" id="button-search" type="submit" name="search">Go!</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Sort</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="sorts.php?sortby=Done" rel="noopener noreferrer"><span class="badge rounded-pill bg-success text-white">Done</span></a></li>
                                        <li><a href="sorts.php?sortby=Requested" rel="noopener noreferrer"><span class="badge rounded-pill bg-primary text-white">Requested</span></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                <ul class="list-unstyled mb-0">
                                        <li><a href="sorts.php?sortby=Assigned" rel="noopener noreferrer"><span class="badge rounded-pill bg-info text-dark">Assigned</span></a></li>
                                        <li><a href="sorts.php?sortby=Available" rel="noopener noreferrer"><span class="badge rounded-pill bg-warning text-dark">Available</span></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                <ul class="list-unstyled mb-0">
                                        <li><a href="sorts.php?sortby=Working" rel="noopener noreferrer"><span class="badge rounded-pill bg-secondary text-white">Working</span></a></li>
                                        <li><a href="sorts.php?sortby=For Validation" rel="noopener noreferrer"><span class="badge rounded-pill bg-danger text-white">For Validation</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">Search Providers by Categories</div>
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
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Handy <strong>Manong</strong> 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/1b7409057b.js" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        
    </body>
</html>
