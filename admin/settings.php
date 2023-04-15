<?php 
    include "../includes/connect.php";
    include "header.php";
    include "side.php";
    
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container px-4">
                        <h1 class="mt-4">Account Settings</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Addons</li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                        <div class="row">
                            <!-- Blog entries-->
                            <div class="col-lg-8">
                                <!-- Featured blog post-->
                                <div class="card mb-4 md-4">
                                    
                                    <style>
                                        .profile{
                                            height: 120px;
                                            width: 120px;
                                            background-color:#212529;
                                            margin:auto;
                                            border-radius:50%;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            position:relative;
                                        }
                                        .profile img{
                                            width:auto;
                                            height:110px;
                                            border-radius:50%;
                                            
                                        }
                                        .profile span{
                                            position:absolute;
                                            bottom:0;
                                            right: 5px;
                                            background-color:#fff;
                                            color:#000;
                                            border-radius:50%;
                                            height: 30px;
                                            width: 30px;
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            background-color:#212529;
                                            color:#fff;
                                        }
                                        .custom-file-upload:hover{
                                            cursor:pointer;
                                        }
                                        input[type="file"] {
                                            display: none;
                                        }
                                        .profile-form{
                                            display:flex;
                                            flex-direction:column;
                                            justify-content:center;
                                        }
                                        .profile-form button{
                                            width: fit-content;
                                            align-self: center;
                                        }
                                    </style>


                                    <div class="card-body">
                                        
                                        
                                    <form name="avatarForm" class="profile-form" action="update.php" method="post" enctype="multipart/form-data">
                                        <div class="profile">
                                        <?php
                                            require_once "../includes/connect.php";
                                            $id = $_SESSION["id"];
                                            $sql = "SELECT * FROM `admin` WHERE id = $id";
                                            $result = mysqli_query($conn, $sql);

                                            $num = mysqli_num_rows($result);
                                            if(empty($num)){
                                                header("location: ../auth/signin.php?error=loginrequired");
                                            }
                                            else{
                                                $row = mysqli_fetch_array($result);
                                                if(empty($row['avatar'])):
                                            
                                        ?>
                                            
                                                <img id="preview" src="../assets/images/avatar.jpg" alt="Preview Image" srcset="">
                                            <?php
                                                else:
                                            ?>
                                                <img id="preview" src="../assets/images/uploads/<?php echo $row['avatar']?>" alt="Preview Image" srcset="">
                                            <?php
                                                endif;
                                            ?>
                                            <span>
                                                <label class="custom-file-upload"><i class="fa-solid fa-pen"></i><label>
                                                <input id="file-upload" name="image" type="file" accept="image/jpeg,image/png,image/gif" onchange="previewImage(event)" required/>
                                            </span>
                                        
                                        </div>
                                        <button type="submit" name="avatarSubmit" class="btn btn-primary my-3">Update Profile</button>
                                    </form>
                            
                                    <form method = "post" action="update.php">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <div class="input-group">
                                            <input type="text" class="form-control" name="name" id="name_input"
                                                aria-describedby="emailHelp" required value="<?php echo $row['user']?>" disabled/>
                                                <button class="btn btn-primary" id="name" type="button" onclick="toggleName()">Edit</button>
                                                <button style="display:none;" class="btn btn-primary" id="name_submit" name="name_submit" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form method = "post" action="update.php">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Email</label>
                                            <div class="input-group">
                                            <input type="text" class="form-control" id="email_input"
                                                aria-describedby="emailHelp" name="email" required value="<?php echo $row['email']?>" disabled/>
                                                <button class="btn btn-primary" id="email" type="button" onclick="toggleEmail()">Edit</button>
                                                <button style="display:none;" class="btn btn-primary" id="email_submit" name="email_submit" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form method = "post" action="update.php">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Old Password</label>
                                            <div class="input-group">
                                            <input type="password" class="form-control" id="password_input"
                                                aria-describedby="emailHelp" name="old_pass" value="<?php echo $password_input_value?>" required disabled/>
                                                <button class="btn btn-primary" id="password" type="button" onclick="togglePassword()">Edit</button>
                                                
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">New Password</label>
                                            <div class="input-group">
                                            <input type="password" class="form-control" id="new_password"
                                                aria-describedby="emailHelp" name="new_pass" value="<?php echo $password_new_value?>" required disabled/>
                                                
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Confirm Password`</label>
                                            <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password"
                                                aria-describedby="emailHelp" name="confirm_pass" value="<?php echo $password_confirm_value?>" required disabled/>
                                                
                                            </div>
                                        </div>
                                        <div class="text-center"><button style="display:none; margin:auto;" id="password_submit"  type="submit" class="btn btn-primary" name="password_submit">Submit</button></div>
                                        
                                    </form>
                                    <?php
                                            }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Side widgets-->
<style>
div.avatar__container{
    position: relative;
    background-image: url(assets/img/admin.jpg);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 150px;
    border-radius: calc(0.375rem - 1px);
    transition: visibility 0s, opacity 0.5s linear;
}



div.avatar__circle{
    background-color: #fff;
    height: 100px;
    width: 100px;
    position: absolute;
    bottom: -50px;
    left: 30px;
    border: 5px solid #000;
    border-radius: 50px;
    z-index: 10;
}
div.details_display{
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: end;
    color: #fff;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0,0,0,0.5);
    padding: 20px;
    
    border-radius: calc(0.375rem - 1px);
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s, opacity 0.3s linear;
}
div.avatar__container:hover > div.details_display{
    visibility: visible;
    opacity: 1;
}
</style>
                            
                            <div class="col-lg-4">
                                    
                                <div>
                                    <h5>Contributors</h5>
                                </div>
                                <div class="card mb-5">
                                    
                                        <div class="card-body avatar__container">                                          
                                            <div class="avatar__circle mb-3">

                                            </div>
                                            <div class="details_display">
                                                <h3 class="name__contributor">Sheila Sabellano</h3>
                                                <p class="text-light">ssabellano@gmail.com</p>
                                            </div>
                                        </div>
                                </div>
                                <div class="card mb-5">
                                    
                                        <div class="card-body avatar__container">                                          
                                            <div class="avatar__circle mb-3">

                                            </div>
                                            <div class="details_display">
                                                <h3 class="name__contributor">Lovely Villa</h3>
                                                <p class="text-light">lvilla@gmail.com</p>
                                            </div>
                                        </div>
                                </div>
                                <div class="card mb-5">
                                    
                                        <div class="card-body avatar__container">                                          
                                            <div class="avatar__circle mb-3">

                                            </div>
                                            <div class="details_display">
                                                <h3 class="name__contributor">Myk Escala</h3>
                                                <p class="text-light">escalamykkenneth@gmail.com</p>
                                            </div>
                                        </div>
                                </div>
                                
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
        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('preview');
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }

        </script>
        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('preview');
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }
            function toggleName() {
                const x = document.getElementById("name");
                const y = document.getElementById("name_submit");
                const z = document.getElementById("name_input");
                
                x.style.display = (x.style.display === "none") ? "block" : "none";
                y.style.display = (y.style.display === "none") ? "block" : "none";
                z.disabled = !z.disabled;
            }

            function toggleEmail() {
                const x = document.getElementById("email");
                const y = document.getElementById("email_submit");
                const z = document.getElementById("email_input");
                
                x.style.display = (x.style.display === "none") ? "block" : "none";
                y.style.display = (y.style.display === "none") ? "block" : "none";
                z.disabled = !z.disabled;
            }

            function togglePassword() {
                const x = document.getElementById("password");
                const y = document.getElementById("password_submit");
                const z = document.getElementById("password_input");
                const a = document.getElementById("new_password");
                const b = document.getElementById("confirm_password");
                
                x.style.display = (x.style.display === "none") ? "block" : "none";
                y.style.display = (y.style.display === "none") ? "block" : "none";
                z.disabled = !z.disabled;
                a.disabled = !a.disabled;
                b.disabled = !b.disabled;
            }

            <?php
                if (!empty($password_input_value)) {
                    echo "togglePassword();";
                } else {
                    $password_input_value = "";
                }
            ?>
            
            
        
        </script>
    </body>
</html>
