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
        <style>
            header{
                background-image:url(../assets/images/prov_task.jpg)!important;
                background-repeat: no-repeat!important;
                background-size: cover!important;
                background-position: 50% 40%!important;
                position: relative;
            }
            header div.overlay{
                position: absolute;
                top:0;
                bottom:0;
                left:0;
                right:0;
                background-color: rgba(0,0,0,0.5);
                content: "";

            }
            header div.container{
                position: relative;
            }
        </style>
        <header class="mt-5 py-5 bg-light border-bottom mb-4 text-white">
            <div class="overlay"></div>
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Service <em>Connection</em>!</h1>
                    <p class="lead mb-0">Find manual job service provider in your area now!</p>
                    <br>
                    <form action="tasks.php" method="post">
                    <div class="input-group" style="max-width:500px;margin:auto;">
                        <input class="form-control" type="text" name="query" placeholder="Search..." aria-label="Search..." aria-describedby="button-search" style="background-color:rgba(255,255,255,0.5);color:#fff;"/>
                        <button class="btn btn-primary" id="button-search" name="submit" type="submit">Go!</button>
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
                    <!-- Featured blog post-->
                    <?php
                    if(isset($_POST["submit"]) || !empty($_GET['pages_no'])){
                        echo "<h2 class=\"card-title\">Task</h2>";
                        echo "<div class=\"row row-cols-1 row-cols-md-2\">";
                        
                            require_once "../includes/connect.php";

                            
                            if (isset($_GET['pages_no']) && $_GET['pages_no']!="") {
                                $page_no = $_GET['pages_no'];
                                $search  = $_SESSION['searching'];
                                
                            }else {
                                $page_no = 1;
                                $_SESSION['searching'] = $_POST["query"];
                                $search  = $_SESSION['searching'];
                            }
                            
                            $id = $_SESSION["id"];
                            
                            $total_records_per_page = 6;
                            $offset = ($page_no-1) * $total_records_per_page;
                            $previous_page = $page_no - 1;
                            $next_page = $page_no + 1;
                            $adjacents = "2"; 
                            
                            $category = $_SESSION['category'];
                            $arr = explode(',',$category);
                            $likeCat = "";
                            $x = 1;
                            
                            if(sizeof($arr) == 1){
                                foreach($arr as $i){
                                    $likeCat = "'$i'";
                                }
                            }else{
                                foreach($arr as $i){
                                    if(sizeof($arr) == $x){
                                        $likeCat = $likeCat."'$i'";
                                    }
                                    else{
                                        $likeCat = $likeCat."'$i' OR task_category LIKE ";
                                    }
                                    $x = $x + 1;
                                }
                            }
                            $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `tbl_task` WHERE ((task_title LIKE '%$search%') OR (task_desc LIKE '%$search%')) AND task_category like '%$likeCat%' AND task_status = 'Available'  AND task_status != 'Working' ORDER BY id DESC");
                            $total_records = mysqli_fetch_array($result_count);
                            $total_records = $total_records['total_records'];
                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                            $second_last = $total_no_of_pages - 1; // total page minus 1

                            $sql = "SELECT * FROM `tbl_task` WHERE ((task_title LIKE '%$search%') OR (task_desc LIKE '%$search%')) AND task_category like '%$likeCat%' AND task_status = 'Available' AND task_status != 'Working'  ORDER BY id DESC LIMIT $offset, $total_records_per_page"; /* add where clause here */
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
                                            echo "<span class=\"badge rounded-pill bg-danger\">".$row['task_status']."</span>";
                                        }
                                                    
                                        echo "<p class=\"card-text related\">".$row['task_desc']."</p>";
                                        echo "<a class=\"btn btn-primary\" href=\"task-view.php?tid=".$row['id']."\">Learn more →</a>"; /* add task id to this button to full view */
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                                
                        echo "</div>";
                    ?>
                    <!-- PAGINATION FOR IF CLAUSE -->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class='page-item' <?php if($page_no <= 1){ echo "class='page-item disabled'"; } ?>>
                                <a class='page-link'<?php if($page_no > 1){ echo "href='?pages_no=$previous_page'"; } ?>>Previous</a>
                            </li>
                        
                            <?php 
                                if ($total_no_of_pages <= 10){  	 
                                    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                                        if ($counter == $page_no) {
                                    echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                            }else{
                                    echo "<li class='page-item'><a class='page-link' href='?pages_no=$counter'>$counter</a></li>";
                                            }
                                    }
                                }elseif($total_no_of_pages > 10){
                                    if($page_no <= 4) {			
                                        for ($counter = 1; $counter < 8; $counter++){		 
                                            if ($counter == $page_no) {
                                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                            }else{
                                                echo "<li class='page-item'><a class='page-link' href='?pages_no=$counter'>$counter</a></li>";
                                            }
                                        }
                                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                        echo "<li class='page-item'><a class='page-link' href='?pages_no=$second_last'>$second_last</a></li>";
                                        echo "<li class='page-item'><a class='page-link' href='?pages_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                    }elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
                                        echo "<li class='page-item'><a class='page-link' href='?pages_no=1'>1</a></li>";
                                        echo "<li class='page-item'><a class='page-link' href='?pages_no=2'>2</a></li>";
                                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
                                            if ($counter == $page_no) {
                                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                            }else{
                                                echo "<li class='page-item'><a class='page-link' href='?pages_no=$counter'>$counter</a></li>";
                                            }                  
                                        }
                                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                        echo "<li class='page-item'><a class='page-link' href='?pages_no=$second_last'>$second_last</a></li>";
                                        echo "<li class='page-item'><a class='page-link' href='?pages_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
                                    }else {
                                        echo "<li class='page-item'><a class='page-link' href='?pages_no=1'>1</a></li>";
                                        echo "<li class='page-item'><a class='page-link' href='?pages_no=2'>2</a></li>";
                                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                
                                        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                            if ($counter == $page_no) {
                                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                            }else{
                                                echo "<li class='page-item'><a class='page-link' href='?pages_no=$counter'>$counter</a></li>";
                                            }                   
                                        }
                                    }
                                }
                            ?>
                        
                            <li class='page-item' <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
                                <a class='page-link' <?php if($page_no < $total_no_of_pages) { echo "href='?pages_no=$next_page'"; } ?>>Next</a>
                            </li>

                            <?php if($page_no < $total_no_of_pages){
                                    echo "<li class='page-item'><a class='page-link' href='?pages_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                                } 
                            ?>
                        </ul>
                    </nav>



                    <?php
                    }else{
                    
                    /* Nested row for non-featured blog posts */
                    echo "<h2 class=\"card-title mb-5\">Available Tasks For You</h2>";
                    echo "<div class=\"row row-cols-1 row-cols-md-2 mb-5\">";
                        
                            include "../includes/connect.php";
                            
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
                            $category = $_SESSION['category'];
                            $arr = explode(',',$category);
                            $likeCat = "";
                            $x = 1;
                            
                            if(sizeof($arr) == 1){
                                foreach($arr as $i){
                                    $likeCat = "'$i'";
                                }
                            }else{
                                foreach($arr as $i){
                                    if(sizeof($arr) == $x){
                                        $likeCat = $likeCat."'$i'";
                                    }
                                    else{
                                        $likeCat = $likeCat."'$i' OR task_category LIKE ";
                                    }
                                    $x = $x + 1;
                                }
                            }
                            
                            $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `tbl_task` WHERE task_status = 'Available' ORDER BY id DESC");
                            $total_records = mysqli_fetch_array($result_count);
                            $total_records = $total_records['total_records'];
                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                            $second_last = $total_no_of_pages - 1; // total page minus 1

                            $id = $_SESSION["id"];
                            
                            $sql = "SELECT * FROM `tbl_task` WHERE task_status = 'Available' ORDER BY `id` DESC LIMIT $offset, $total_records_per_page"; /* add where clause here */
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
                                            echo "<span class=\"badge rounded-pill bg-danger\">".$row['task_status']."</span>";
                                        }
                                                    
                                        echo "<p class=\"card-text related\">".$row['task_desc']."</p>";
                                        echo "<a class=\"btn btn-primary\" href=\"task-view.php?tid=".$row['id']."&category=".$row['task_category']."\">Learn more →</a>"; /* add task id to this button to full view */
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                    ?>
                    
                    <?php
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
                    }
                ?>
                    
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    
                    <style>
                        .avatar{
                            display: flex;
                            flex-direction:row;
                            justify-content:space-between;
                            align-items:center;
                        }
                        div.avatar img{
                            border-radius:50%;
                        }
                    </style>
                    <div class="card mb-4">
                        <div class="card-header">Connects</div>
                        <div class="card-body">
                                <?php
                                    $id = $_SESSION["id"];
                                    $sql = "SELECT * FROM finder_request INNER JOIN tbl_task ON tbl_task.id = finder_request.task WHERE finder_request.assign = $id AND `task_status` = 'Requested'";
                                    $result = mysqli_query($conn, $sql);
                                    $num = mysqli_num_rows($result);
                                    if($num == 0) {

                                    }else{
                                        while($row = mysqli_fetch_array($result)){
                                            $finder = $row['finder'];
                                            $query = "SELECT * FROM tbl_finder WHERE finder_id = $finder";
                                            $results = mysqli_query($conn, $query);
                                            $rows = mysqli_fetch_array($results)
                                ?>
                                    <div class="my-2">
                                        
                                        <div class="avatar">
                                        <?php if(empty($rows['avatar'])):?>
                                            <img src="../assets/images/avatar.jpg" alt="" height="50" width="50">
                                        <?php else:?>
                                            <img src="../assets/images/uploads/<?php echo $rows['avatar']?>" alt="" height="50" width="50">
                                        <?php endif;?>
                                        <h5 class="name"><?php echo $rows['finder_name']?></h5>
                                        <br>
                                        <div class="btn-wrap">
                                            
                                            <a class="btn btn-primary" href="task-view.php?tid=<?php echo $row['task']?>">View Task</a>
                                            
                                        </div>
                                       
                                        </div>
                                         
                                    </div>
                                    
                            <?php
                                        }
                                    }
                                ?>
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
        
    </body>
</html>
