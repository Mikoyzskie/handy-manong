<?php 
    include "../includes/connect.php";
    include "header.php";
    include "side.php";
    
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
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
                                        
                                        
                                        <form name="avatarForm" class="profile-form" action="" method="post" enctype="multipart/form-data">
                                            <div class="profile">
                                           
                                                
                                                
                                                    <img id="preview" src="../assets/images/avatar.jpg" alt="Preview Image" srcset="">
                                                
                                                <span>
                                                    <label class="custom-file-upload"><i class="fa-solid fa-pen"></i><label>
                                                    <input id="file-upload" name="image" type="file" accept="image/jpeg,image/png,image/gif" onchange="previewImage(event)" required/>
                                                </span>
                                            
                                            </div>
                                            
                                        
                                
                                        
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                                <div class="input-group">
                                                <input type="text" class="form-control" name="name" id="name_input"
                                                    aria-describedby="emailHelp" required value="" />
                                                    
                                                </div>
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Email</label>
                                                <div class="input-group">
                                                <input type="text" class="form-control" id="email_input"
                                                    aria-describedby="emailHelp" name="email" required value="" />
                                                    
                                                </div>
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Old Password</label>
                                                <div class="input-group">
                                                <input type="password" class="form-control" id="password_input"
                                                    aria-describedby="emailHelp" name="old_pass" value="" required />
                                                    
                                                    
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">New Password</label>
                                                <div class="input-group">
                                                <input type="password" class="form-control" id="new_password"
                                                    aria-describedby="emailHelp" name="new_pass" value="" required />
                                                    
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Confirm Password`</label>
                                                <div class="input-group">
                                                <input type="password" class="form-control" id="confirm_password"
                                                    aria-describedby="emailHelp" name="confirm_pass" value="" required />
                                                    
                                                </div>
                                            </div>
                                            <div class="text-center"><button style="display:none; margin:auto;" id="password_submit"  type="submit" class="btn btn-primary" name="password_submit">Submit</button></div>
                                            
                                        
                                        <button type="submit" name="avatarSubmit" class="btn btn-success my-3">New Admin</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Side widgets-->
                            <div class="col-lg-4">
                                    
                                <div>
                                    <h5>Contributors</h5>
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
    </body>
</html>
