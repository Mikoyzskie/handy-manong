<!-- Modal Finder Create -->
<div class="modal fade" id="createFinder" tabindex="-1" aria-labelledby="createFinderLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered text-center d-flex justify-content-center modal-lg">
                <div class="modal-content w-75">
                    <div class="modal-body p-4">
                    <h2 class='card-title mb-3'>Create Finder Account</h2>
                    <form role="form" method="post" action="signup.php">
                        <label>Name</label>
                        <div class="mb-3">
                        <input type="text" class="form-control" value="" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon" name="name" required>
                        </div>
                        <label>Email Address</label>
                        <div class="mb-3">
                        <input type="email" class="form-control" value="" placeholder="Enter your email address" aria-label="Email" aria-describedby="email-addon" name="email" required>
                        </div>
                        <label>Password</label>
                        <div class="mb-3">
                        <input type="password" class="form-control" value="" placeholder="Create a password" aria-label="Password" aria-describedby="password-addon" name="password" required>
                        </div>
                        <label>Confirm Password</label>
                        <div class="mb-3">
                        <input type="password" class="form-control" value="" placeholder="Confirm your password" aria-label="Password" aria-describedby="password-addon" name="cpassword" required>
                        </div>
                        
                        <div class="text-center">
                        <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">Sign up</button>
                        </div>
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
                    <h2 class='card-title mb-3'>Create Finder Account</h2>
                        <form role="form" method="post" action="register.php">
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
                                    <input type="password" class="form-control" placeholder="Create a password"
                                        aria-label="Password" aria-describedby="password-addon" name="password"
                                        required value="">
                                </div>
                                <label>Confirm Password</label>
                                <div class="mb-3">
                                    <input type="password" class="form-control"
                                        placeholder="Confirm your password" aria-label="Password"
                                        aria-describedby="password-addon" name="cpassword" required value="">
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
                                            <input type="checkbox" class='acb' id="checkboxNine" value="Midwife" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxNine">Midwife</label>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-dark w-100 mb-3">Sign up</button>
                                </div>
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
                                    <a class="nav-link" href="finder.php">Tables</a>
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
                                    <a class="nav-link" href="provider.php">Tables</a>
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
                                    <a class="nav-link" href="admin.php">Tables</a>
                                    <a class="nav-link" href="create.php">Create</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Account Settings
                            </a>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Profile
                            </a>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>