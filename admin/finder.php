<?php 
    include "../includes/connect.php";
    include "header.php";
    include "side.php";
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Finders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted">Users</li>
                            <li class="breadcrumb-item active">Finders</li>
                        </ol>
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
                                        <a class="small text-white stretched-link" href="index.php#tasks">View Details</a>
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
                                        <a class="small text-white stretched-link" href="#">View Details</a>
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
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Finders Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Task Count</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Task Count</th> 
                                            <th>Action</th>                                          
                                        </tr>
                                    </tfoot>

                                        <?php
                                            include "../includes/connect.php";
                                            $sql = "SELECT * FROM tbl_finder";
                                            $results = mysqli_query($conn, $sql);
                                            
                                        ?>

                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($results)):?>
                                        <tr>
                                            <td><?php echo $row['finder_id']?></td>
                                            <td><?php echo $row['finder_name']?></td>
                                            <td><?php echo $row['finder_email']?></td>
                                            <td>
                                                <?php if($row['unicode'] == 'verified' && !empty($row['unicode'])):?>
                                                    <p class="badge rounded-pill bg-success">Verified</p>
                                                <?php else:?>
                                                    <p class="badge rounded-pill bg-warning">Pending</p>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <?php
                                                    $id = $row['finder_id'];
                                                    $query = "SELECT COUNT(*) AS count FROM tbl_task WHERE task_finder = $id";
                                                    $result = mysqli_query($conn, $query);
                                                    $count = mysqli_fetch_array($result);
                                                    echo $count['count'];
                                                ?>
                                            </td>
                                            <td class="centered">
                                                <!-- Button to trigger the modal -->
                                                 <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $id?>">Update</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="viewModal<?php echo $id?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered text-center d-flex justify-content-center">
                                                        <div class="modal-content w-75">
                                                            <div class="modal-body p-4">
                                                                <img src="../assets/images/<?php if(empty($row['avatar'])){
                                                                        echo 'avatar.jpg';
                                                                    }else{
                                                                        echo 'uploads/'.$row['avatar'];
                                                                    }
                                                                
                                                                ?>" alt="avatar" class="rounded-circle position-absolute top-0 start-50 translate-middle" style="height:120px;"/>
                                                                <form>
                                                                    <div>
                                                                        <h5 class="pt-5 my-3"><?php echo $row['finder_name']?></h5>

                                                                        
                                                                        <button type="submit" class="btn btn-link text-decoration-none">
                                                                            <a class="fw-bold text-danger text-end text-decoration-none" href="update.php?action=delete&user=finder&id=<?php echo $id?>">Delete</a>
                                                                        </button>
                                                                        <?php if($row['unicode'] != 'verified'):?>
                                                                        <button type="submit" class="btn btn-success">Verify</button>
                                                                        <?php endif;?>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                            
                                        </tr>
                                        <?php endwhile;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
<?php include "footer.php";?>         