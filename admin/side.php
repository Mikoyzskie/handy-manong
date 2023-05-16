<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location: login.php?error=loginrequired");
}else{
    
}
?>      
        
        <!-- Modal Finder Create -->
        <div class="modal fade" id="createFinder" tabindex="-1" aria-labelledby="createFinderLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center modal-lg">
                <div class="modal-content w-75">
                    <div class="modal-body p-4">
                    <h2 class='card-title mb-3'>Create Finder Account</h2>
                    <form role="form" method="post" action="auth.php">
                        <label>First Name</label>
                        <div class="mb-3">
                        <input type="text" class="form-control" value="" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon" name="fname" required>
                        </div>
                        <label>Last Name</label>
                        <div class="mb-3">
                        <input type="text" class="form-control" value="" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon" name="lname" required>
                        </div>
                        <label>Email Address</label>
                        <div class="mb-3">
                        <input type="email" class="form-control" value="" placeholder="Enter your email address" aria-label="Email" aria-describedby="email-addon" name="email" required>
                        </div>
                        <label>Password</label>
                        <div class="mb-3">
                        <input type="password" class="form-control passwordToCheck" value="" placeholder="Create a password" aria-label="Password" aria-describedby="password-addon" name="password" required>
                        <span class="passwordCheck"></span>
                                         
                        </div>
                        
                        <label>Confirm Password</label>
                        <div class="mb-3">
                        <input type="password" class="form-control" value="" placeholder="Confirm your password" aria-label="Password" aria-describedby="password-addon" name="cpassword" required>
                        </div>
                        
                        <div class="text-center">
                        <button type="submit" name="finder_submit" class="btn btn-dark w-100 mt-4 mb-3" id="buttonSubmit">New Finder</button>
                        </div>
                        <script>
                            const ferifier = document.querySelector('.passwordCheck');
                            const finputPassword = document.querySelector('.passwordToCheck');
                            const buttonSubmit= document.getElementById('buttonSubmit');
                            buttonSubmit.disabled = true;
                            function hasNumber(str) {
                                return /[0-9]/.test(str) && /[^A-Za-z0-9]/.test(str);
                            }
                            const interval = setInterval(function() {
                                if(inputPassword.value.length >= 8 && hasNumber(finputPassword.value)){
                                    fverifier.innerHTML = "Password Valid"
                                    fverifier.style.color = "green";
                                    buttonSubmit.disabled = false;
                                }else{
                                    fverifier.innerHTML = "Must contain 8 characters, 1 number, & 1 special character";
                                    fverifier.style.color = "red";
                                    buttonSubmit.disabled = true;
                                }
                            }, 3000)
                        </script> 
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Finder Create -->
        <div class="modal fade" id="createAdmin" tabindex="-1" aria-labelledby="createAdminLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center modal-lg">
                <div class="modal-content w-75">
                    <div class="modal-body p-4">
                    <h2 class='card-title mb-3'>Create Admin Account</h2>
                    <form role="form" method="post" action="auth.php">
                        <label>User</label>
                        <div class="mb-3">
                        <input type="text" class="form-control" value="" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon" name="name" required>
                        </div>
                        <label>Email Address</label>
                        <div class="mb-3">
                        <input type="email" class="form-control" value="" placeholder="Enter your email address" aria-label="Email" aria-describedby="email-addon" name="email" required>
                        </div>
                        <label>Password</label>
                        <div class="mb-3">
                        <input type="password" class="form-control adminToCheck" value="" placeholder="Create a password" aria-label="Password" aria-describedby="password-addon" name="password" required minlength="8">
                        <span class="adminCheck"></span>    
                    </div>
                        <label>Confirm Password</label>
                        <div class="mb-3">
                        <input type="password" class="form-control" value="" placeholder="Confirm your password" aria-label="Password" aria-describedby="password-addon" name="cpassword" required minlength="8">
                        </div>
                        
                        <div class="text-center">
                        <button type="submit" name="admin_submit" class="btn btn-dark w-100 mt-4 mb-3" id="adminSubmit">New Admin</button>
                        </div>
                        <script>
                            const averifier = document.querySelector('.adminCheck');
                            const ainputPassword = document.querySelector('.adminToCheck');
                            const adminSubmit= document.getElementById('adminSubmit');
                            adminSubmit.disabled = true;
                            function hasNumber(str) {
                                return /[0-9]/.test(str) && /[^A-Za-z0-9]/.test(str);
                            }
                            const ainterval = setInterval(function() {
                                if(ainputPassword.value.length >= 8 && hasNumber(ainputPassword.value)){
                                    averifier.innerHTML = "Password Valid"
                                    averifier.style.color = "green";
                                    adminSubmit.disabled = false;
                                }else{
                                    averifier.innerHTML = "Must contain 8 characters, 1 number, & 1 special character";
                                    averifier.style.color = "red";
                                    adminSubmit.disabled = true;
                                }
                            }, 3000)
                        </script> 
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Provider Create -->
        <div class="modal fade" id="createProvider" tabindex="-1" aria-labelledby="createProviderLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered text-center d-flex justify-content-center modal-xl">
                <div class="modal-content w-75">
                    <div class="modal-body p-4">
                    <h2 class='card-title mb-3'>Create Provider Account</h2>
                        <form role="form" method="post" action="auth.php">
                                <label>First Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Enter your name"
                                        aria-label="Name" aria-describedby="name-addon" name="fname" required value="">
                                </div>
                                <label>Last Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Enter your name" aria-label="Name"
                                        aria-describedby="name-addon" name="lname" required value="">
                                </div>
                                <label>Email Address</label>
                                <div class="mb-3">
                                    <input type="email" class="form-control"
                                        placeholder="Enter your email address" aria-label="Email"
                                        aria-describedby="email-addon" name="email" required value="">
                                        
                                </div>
                                <label>Password</label>
                                <div class="mb-3">
                                    <input type="password" class="form-control provToCheck" placeholder="Create a password"
                                        aria-label="Password" aria-describedby="password-addon" name="password"
                                        required value="" minlength="8">
                                        <span class="provCheck"></span>   
                                </div>
                                <label>Confirm Password</label>
                                <div class="mb-3">
                                    <input type="password" class="form-control"
                                        placeholder="Confirm your password" aria-label="Password"
                                        aria-describedby="password-addon" name="cpassword" required value="" minlength="8">
                                </div>
                                <div class="row justify-content-center">
                                    <label>I am a...</label>
                                    <p id="emailHelp" class="form-text">
                                        Select category that applies.
                                    </p>
                                    <div>
                                    <ul class="ks-cboxtags" style="padding-top:0;">
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxOne" value="Carpenter" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxOne">Carpenter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxTwo" value="Plumber" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxTwo">Plumber</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxThree" value="Painter" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxThree">Painter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxFour" value="Electrician" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxFour">Electrician</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxFive" value="Driver" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxFive">Driver</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxSix" value="Welder" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxSix">Welder</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxSeven" value="House Keeper" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxSeven">House Keeper</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxEight" value="Glass Worker" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxEight">Glass Worker</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxEight" value="Others" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxEight">Others...</label>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" name="provider_submit" class="btn btn-dark w-100 mb-3" id="prov">New Provider</button>
                                </div>
                                <script>
                                    const pverifier = document.querySelector('.provCheck');
                                    const pinputPassword = document.querySelector('.provToCheck');
                                    const provSubmit= document.getElementById('prov');
                                    provSubmit.disabled = true;
                                    function hasNumber(str) {
                                        return /[0-9]/.test(str) && /[^A-Za-z0-9]/.test(str);
                                    }
                                    const pinterval = setInterval(function() {
                                        if(pinputPassword.value.length >= 8 && hasNumber(pinputPassword.value)){
                                            pverifier.innerHTML = "Password Valid"
                                            pverifier.style.color = "green";
                                            provSubmit.disabled = false;
                                        }else{
                                            pverifier.innerHTML = "Must contain 8 characters, 1 number, & 1 special character";
                                            pverifier.style.color = "red";
                                            provSubmit.disabled = true;
                                        }
                                    }, 3000)
                                </script> 
                            </form>
                    </div>
                </div>
            </div>
        </div>
        

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal" style="width: 60%;align-self: center;">
                                <i class="fa-solid fa-circle-plus"></i> Create
                            </button> -->
                            <!-- <a class="nav-link" href="index.html" data-mdb-toggle="modal" data-bs-target="#createModal">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i></div>
                                Create Task
                            </a> -->
                            <div class="sb-sidenav-menu-heading">users</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFinders" aria-expanded="false" aria-controls="collapseFinders">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                                    Finders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseFinders" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="finder.php">Table</a>
                                    <a class="nav-link btn" data-bs-toggle="modal" data-bs-target="#createFinder" style="border:none!important;">Create</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProviders" aria-expanded="false" aria-controls="collapseProviders">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-helmet-safety"></i></div>
                                    Providers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProviders" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="provider.php">Table</a>
                                    <a class="nav-link btn" data-bs-toggle="modal" data-bs-target="#createProvider" style="border:none!important;">Create</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                    Administrators
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAdmin" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="admin.php">Table</a>
                                    <a class="nav-link btn" data-bs-toggle="modal" data-bs-target="#createAdmin" style="border:none!important;">Create</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="settings.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                                Account Settings
                            </a>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['user']?>
                    </div>
                </nav>
            </div>