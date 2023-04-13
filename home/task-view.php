<?php
session_start();

if(empty($_SESSION['id'])){
    header("location: ../signin.php?error=loginrequired");
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
                    <h1 class="fw-bolder">Try Service <em>Connection</em> instead?</h1>
                    <p class="lead mb-0">Find manual job service provider in your area now!</p>
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
                    <!-- Featured blog post-->
                    <div class="card mb-4 md-4">
                        <!-- <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a> -->
                        <div class="card-body">
                            <!-- <div class="small text-muted">January 1, 2022</div> -->
                            <?php
                                include "../includes/connect.php";
                                $uid = $_GET["uid"];
                                $id = $_GET["tid"];
                                if($uid != $_SESSION["id"]){
                                    header("location: finder.php?error=notask");
                                }
                                elseif(empty($id)){
                                    header("location: finder.php?error=notask");
                                }else{
                                    $sql = "SELECT * FROM `tbl_task` INNER JOIN `tbl_finder` ON tbl_task.task_finder = tbl_finder.finder_id WHERE id = $id"; /* add where clause here */
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
                                        if($row['task_status']=='Available'){
                                            echo "Status: <p class=\"badge rounded-pill bg-warning text-dark\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Working'){
                                            echo "Status: <p class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Assigned'){
                                            echo "Status: <p class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Requested'){
                                            echo "Status: <p class=\"badge rounded-pill bg-primary\">".$row['task_status']."</p>";
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
                                        echo "<p>Salary Rate: Php ".$row['rate']."</p>";
                                        $prov = $row['task_provider'];
                                        if(empty($prov)){

                                        }else{
                                            $userselect = "SELECT * FROM tbl_provider WHERE id = $prov";
                                            $results = mysqli_query($conn, $userselect);
                                            $rows = mysqli_fetch_array($results);
                                            echo "<p>Assigned to: <a href='profile.php?uid=$prov'>".$rows['prov_firstname']." ".$rows['prov_lastname']."</a></p>";
                                        }
                                        
                                        if($row['task_status']=='Assigned'){
                                            
                                        }elseif($row['task_status']=='Working'){
                                            
                                        }else{
                                            echo "<a class=\"btn btn-primary\" data-bs-toggle='modal' data-bs-target='#createFinder'>Update</a>"; /* add update function */
                                            echo "<a class=\"btn btn-danger mx-2\" href=\"delete.php?tid=$id\">Delete</a>";
                                        }
                                    
                            ?>
                        <!-- Modal Finder Create -->
                        <div class="modal fade" id="createFinder" tabindex="-1" aria-labelledby="createFinderLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center modal-lg">
                                <div class="modal-content w-75">
                                    <div class="modal-body p-4">
                                    <h2>Update Task</h2>
                                    <hr>
                                    <h3 class='card-title mb-3'><?php echo $row['task_title']?></h3>
                                    <form role="form" method="post" action="update.php">
                                        <label>Description</label>
                                        <div class="mb-3">
                                        <textarea name="description" style="width:100%;" required><?php echo nl2br($row['task_desc'])?></textarea>
                                        </div>
                                        <label>Location</label>
                                        <div class="mb-3">
                                        <input type="text" class="form-control" value="<?php echo $row['task_location']?>" placeholder="Enter task location" aria-label="Email" aria-describedby="email-addon" name="location" required>
                                        </div>
                                        <label>Salary</label>
                                        <div class="mb-3">
                                        <input type="number" class="form-control" value="<?php echo $row['rate']?>" placeholder="Enter salary" aria-label="Password" aria-describedby="password-addon" name="salary" required>
                                        </div>
                                        <input type="hidden" name = "taskid" value="<?php echo $row['id']?>"/>
                                        
                                        <div class="text-center">
                                        <button type="submit" name = "task_submit" class="btn btn-primary w-100 mt-4 mb-3">Update</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    }
                        ?>
                        </div>
                    </div>
                    <h2 class="card-title">Related Tasks</h2>
                            <style>
                                .card-text.related{
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2; /* number of lines to show */
                                            line-clamp: 2; 
                                    -webkit-box-orient: vertical;
                                }
                            </style>
                    <div class="row row-cols-1 row-cols-md-2">
                        <?php
                            require_once "../includes/connect.php";
                            $id = $_GET['tid'];
                            $category = $_GET['category'];
                            $sql = "SELECT * FROM `tbl_task` WHERE id <> $id AND `task_finder` = ".$_SESSION['id']." AND `task_category`= '".$category."' LIMIT 4";
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
                                        }elseif($row['task_status']=='Working'){
                                            echo "Status: <p class=\"badge rounded-pill bg-info text-dark\">".$row['task_status']."</p>";
                                        }elseif($row['task_status']=='Requested'){
                                            echo "Status: <p class=\"badge rounded-pill bg-primary\">".$row['task_status']."</p>";
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
                        <div class="card-body" style="overflow-x: hidden;overflow-y: auto;height:300px;">
                        <?php 
                        require_once "../includes/connect.php";
                        $id = $_GET['tid'];
                        $sql = "SELECT * FROM `messaging` JOIN tbl_finder ON messaging.user_id = tbl_finder.finder_id WHERE task_id = $id  ORDER BY messaging.id ASC";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);
                        if($num == 0) {
                            
                        }else{
                            while($row = mysqli_fetch_array($result)){
                                $type = $row['user_type'];
                                $message = $row['msg_content'];
                                $user = $row['user_id'];
                                if($type == "finder"){
                                    $sql = "SELECT * FROM tbl_finder WHERE finder_id = $user";
                                    $results = mysqli_query($conn, $sql);
                                    $rows = mysqli_fetch_array($results);
                                    echo "<p>From <span>".$rows['finder_name']."</span>: $message</p>";
                                }else{
                                    $sql = "SELECT * FROM tbl_provider WHERE id = $user";
                                    $results = mysqli_query($conn, $sql);
                                    $rows = mysqli_fetch_array($results);
                                    echo "<p>From <a href='profile.php?uid=$user'>".$rows['prov_firstname']." ".$rows['prov_lastname']."</a>: $message</p>";
                                }
                            }
                        }
                        ?>



                        </div>
                        <form role="form" method="post" action="messaging.php?tid=<?php echo $_GET['tid']?>">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter Message..." aria-label="Search..." aria-describedby="button-search" name="chat" required autocomplete="off"/>
                                <button class="btn btn-primary" id="button-search" type="submit" name="send"><img src="../assets/images/paper-plane.png" height="12" alt="" srcset=""></button>
                            </div>
                        </form>
                    </div>
                    <!-- Side widget-->
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
                                    $id = $_GET["tid"];
                                    $sql = "SELECT * FROM request WHERE task_id = $id AND `status` = 'Pending';";
                                    $result = mysqli_query($conn, $sql);
                                    $num = mysqli_num_rows($result);
                                    if($num == 0) {

                                    }else{
                                        while($row = mysqli_fetch_array($result)){
                                            $user_id = $row['prov_id'];
                                            $query = "SELECT * FROM tbl_provider WHERE id = $user_id";
                                            $results = mysqli_query($conn, $query);
                                            $rows = mysqli_fetch_array($results)
                                ?>
                                    <div class="my-2">
                                        
                                        <div class="avatar"><img src="../assets/images/team-1.jpg" alt="" height="50" width="50"><h5 class="name"><?php echo $rows['prov_firstname']." ".$rows['prov_lastname']?></h5>
                                        <br>
                                    
                                        <div class="btn-wrap">
                                            <?php $id = $_GET["tid"];?>
                                            <a class="btn btn-success" href="assign.php?tid=<?php echo $id?>&uid=<?php echo $row['prov_id']?>&action=assign">Accept</a>
                                            <a class="btn btn-secondary" href="assign.php?tid=<?php echo $id?>&uid=<?php echo $row['prov_id']?>&action=reject">Reject</a>
                                        </div>
                                        </div>
                                    </div>
                            <?php
                                        }
                                    }
                                ?>
                        </div>
                        
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                        <div class="row">
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                    <form action="search.php" method="post">
                                        <li><input type="submit" value="Carpenter"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Plumber"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Painter"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                    </form>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                    <form action="search.php" method="post">
                                        <li><input type="submit" value="Electrician"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Driver"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                        <li><input type="submit" value="Welder"  name="search" style="all:unset;color:#0D6EFD;cursor: pointer;"></li>
                                    </form>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                    <form action="search.php" method="post">
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
        <footer class="py-2 bg-dark mt-5">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Handy <strong>Manong</strong> 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        
    </body>
</html>
