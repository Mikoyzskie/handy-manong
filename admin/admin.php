<?php 
    include "../includes/connect.php";
    include "header.php";
    include "side.php";
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Administrators</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                            <li class="breadcrumb-item active">Admins</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Administrators
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Avatar</th>                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Avatar</th>
                                        </tr>
                                    </tfoot>
                                    <?php
                                            include "../includes/connect.php";
                                            $sql = "SELECT * FROM `admin`";
                                            $results = mysqli_query($conn, $sql);
                                            
                                        ?>

                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($results)):?>
                                        <tr>
                                            <?php $id = $row['id']?>
                                            <td><?php echo $row['id']?></td>
                                            <td><?php echo $row['user']?></td>
                                            <td><?php echo $row['email']?></td>
                                            <td>
                                                <!-- Button to trigger the modal -->
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $id?>">View</button>

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
                                                                        <h5 class="pt-5 my-3"><?php echo $row['user']?></h5>

                                                                        <p><?php echo $row['email']?></p>
                                                                        
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