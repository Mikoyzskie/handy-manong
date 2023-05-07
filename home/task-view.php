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
        <link href="main.css?v=<?php echo time();?>" rel="stylesheet" />
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
                                            echo "Status: <p class=\"badge rounded-pill bg-danger\">".$row['task_status']."</p>";
                                        }

                                        $date=date_create($row['task_date']);
                                        
                                        echo "<p>Date Posted: <span class=\"small text-muted\">".date_format($date,"F d, Y")."</span></p>";
                                        if(empty($row['start_date'])){

                                        }else{
                                            $starting=date_create($row['start_date']);
                                            echo "<p>Date Started: <span class=\"small text-muted\">".date_format($starting,"F d, Y")."</span></p>"; /* fix date format */
                                        }
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
                                            
                                        }elseif($row['task_status']=='Done'){
                                            if(!empty($row['ratings'])){
                                                echo "<p>Rating: ".$row['ratings']."/5</p>";
                                                echo "<a class=\"btn btn-warning\" data-bs-toggle='modal' data-bs-target='#rate'>Re-rate</a>";
                                            }else{
                                                echo "<a class=\"btn btn-warning\" data-bs-toggle='modal' data-bs-target='#rate'>Rate</a>";
                                            }
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
                    <!-- Modal ratings -->
                    <div class="modal fade" id="rate" tabindex="-1" aria-labelledby="rate" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center modal-lg">
                                <div class="modal-content w-75">
                                    <div class="modal-body p-4">
                                    <h2>Rate</h2>
                                    <hr>
                                    <div class="container">
                                        <form action="update.php?tid=<?php echo $_GET['tid']?>" method="post">
                                        <div class="feedback">
                                            <div class="rating">
                                            
                                            <input type="radio" name="rating" value="5" id="rating-5">
                                            <label for="rating-5"></label>
                                            <input type="radio" name="rating" value="4" id="rating-4">
                                            <label for="rating-4"></label>
                                            <input type="radio" name="rating" value="3" id="rating-3">
                                            <label for="rating-3"></label>
                                            <input type="radio" name="rating" value="2" id="rating-2">
                                            <label for="rating-2"></label>
                                            <input type="radio" name="rating" value="1" id="rating-1" required>
                                            <label for="rating-1"></label>
                                            <div class="emoji-wrapper">
                                                <div class="emoji">
                                                <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
                                                <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
                                                <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
                                                <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                                <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
                                                <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
                                                <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                                <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
                                                </svg>
                                                <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347"/>
                                                <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534"/>
                                                <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff"/>
                                                <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347"/>
                                                <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff"/>
                                                <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534"/>
                                                <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff"/>
                                                <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347"/>
                                                <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff"/>
                                                </svg>
                                                <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347"/>
                                                <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff"/>
                                                <circle cx="340" cy="260.4" r="36.2" fill="#3e4347"/>
                                                <g fill="#fff">
                                                    <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10"/>
                                                    <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z"/>
                                                </g>
                                                <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347"/>
                                                <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff"/>
                                                </svg>
                                                <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347"/>
                                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                            <g fill="#fff">
                                            <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z"/>
                                            <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81"/>
                                            </g>
                                            <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                            <g fill="#fff">
                                            <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1"/>
                                            <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81"/>
                                            </g>
                                            <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                            <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff"/>
                                        </svg>
                                                <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                                <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f"/>
                                                <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                                <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                                <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f"/>
                                                <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                                <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347"/>
                                                <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b"/>
                                                </svg>
                                                <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <g fill="#ffd93b">
                                                    <circle cx="256" cy="256" r="256"/>
                                                    <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z"/>
                                                </g>
                                                <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4"/>
                                                <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea"/>
                                                <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88"/>
                                                <g fill="#38c0dc">
                                                    <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z"/>
                                                </g>
                                                <g fill="#d23f77">
                                                    <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z"/>
                                                </g>
                                                <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347"/>
                                                <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b"/>
                                                <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2"/>
                                                </svg>
                                                </div>
                                            </div>
                                            </div>
                                            <button class="btn btn-danger mx-3 mt-3" type="submit" name="rate_submit">Submit</a>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    
                                </div>
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
                                            echo "<span class=\"badge rounded-pill bg-danger\">".$row['task_status']."</span>";
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
                        <form role="form" method="post" action="messaging.php?tid=<?php echo $_GET['tid']?>&<?php echo $_GET['category']?>">
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
                                        
                                        <div class="avatar">
                                        <?php if(empty($rows['avatar'])):?>
                                            <img src="../assets/images/avatar.jpg" alt="" height="50" width="50">
                                        <?php else:?>
                                            <img src="../assets/images/uploads/<?php echo $rows['avatar']?>" alt="" height="50" width="50">
                                        <?php endif;?>
                                        <h5 class="name"><?php echo $rows['prov_firstname']." ".$rows['prov_lastname']?></h5>
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
