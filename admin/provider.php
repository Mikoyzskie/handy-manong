<?php 
    include "../includes/connect.php";
    include "header.php";
    include "side.php";
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
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
                                        <a class="small text-white stretched-link" href="provider.php">View Details</a>
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
                                        <a class="small text-white stretched-link" href="#">View Details</a>
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
                                            <th>Done Tasks</th> 
                                            <th>Action</th>                                          
                                        </tr>
                                    </tfoot>

                                        <?php
                                            include "../includes/connect.php";
                                            $sql = "SELECT * FROM tbl_provider";
                                            $results = mysqli_query($conn, $sql);
                                            
                                        ?>

                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($results)):?>
                                        <tr>
                                            <td><?php echo $row['id']?></td>
                                            <td><?php echo $row['prov_firstname'].' '.$row['prov_lastname']?></td>
                                            <td><?php echo $row['prov_email']?></td>
                                            <td>
                                                <?php if($row['code'] = 'verified' && !empty($row['code'])):?>
                                                    <p class="badge rounded-pill bg-success">Verified</p>
                                                <?php else:?>
                                                    <p class="badge rounded-pill bg-warning text-dark">Pending</p>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <?php
                                                    $id = $row['id'];
                                                    $query = "SELECT COUNT(*) AS count FROM tbl_task WHERE task_provider = $id AND task_status = 'Done'";
                                                    $result = mysqli_query($conn, $query);
                                                    $count = mysqli_fetch_array($result);
                                                    echo $count['count'];
                                                ?>
                                            </td>
                                            <td class="centered">
                                                <!-- Button to trigger the modal -->
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $id?>">View</button>

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
                                                                
                                                                ?>" alt="avatar" class="rounded-circle position-absolute top-0 start-50 translate-middle h-50" />
                                                                <form>
                                                                    <div>
                                                                        <h5 class="pt-5 my-3">Maria Doe</h5>

                                                                        <!-- password input -->
                                                                        <div class="form-outline mb-4">
                                                                            <input type="password" id="password1" class="form-control" />
                                                                            <label class="form-label" for="password1">Password</label>
                                                                        </div>

                                                                        <!-- Submit button -->
                                                                        <button type="submit" class="btn btn-primary">Login</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        <?php endwhile;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Handy <strong>Manong</strong> 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
    </body>
</html>
