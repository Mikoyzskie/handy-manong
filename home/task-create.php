<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Handy Manong</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="styles.css" rel="stylesheet" />
        <link href="main.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<style>
ul.ks-cboxtags {
    list-style: none;
    padding: 20px;
}

ul.ks-cboxtags li {
    display: inline;
}

ul.ks-cboxtags li label {
    display: inline-block;
    background-color: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(139, 139, 139, 0.3);
    color: #adadad;
    border-radius: 25px;
    white-space: nowrap;
    margin: 3px 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    -webkit-transition: all .2s;
    -o-transition: all .2s;
    transition: all .2s;
    font-weight: 400;
}

ul.ks-cboxtags li label {
    padding: 8px 12px;
    cursor: pointer;
}

ul.ks-cboxtags li label::before {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-family: "FontAwesome";
    font-weight: 400;
    font-size: 12px;
    padding: 2px 6px 2px 2px;
    content: "\f067";
    -webkit-transition: -webkit-transform .3s ease-in-out;
    transition: -webkit-transform .3s ease-in-out;
    -o-transition: transform .3s ease-in-out;
    transition: transform .3s ease-in-out;
    transition: transform .3s ease-in-out, -webkit-transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked+label::before {
    content: "\f00c";
    -webkit-transform: rotate(-360deg);
    -ms-transform: rotate(-360deg);
    transform: rotate(-360deg);
    -webkit-transition: -webkit-transform .3s ease-in-out;
    transition: -webkit-transform .3s ease-in-out;
    -o-transition: transform .3s ease-in-out;
    transition: transform .3s ease-in-out;
    transition: transform .3s ease-in-out, -webkit-transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked+label {
    border: 1px solid #fec771;
    background-color: #fec771;
    color: #fff;
    -webkit-transition: all .2s;
    -o-transition: all .2s;
    transition: all .2s;
}

ul.ks-cboxtags li input[type="checkbox"] {
    display: absolute;
}

ul.ks-cboxtags li input[type="checkbox"] {
    position: absolute;
    opacity: 0;
}
</style>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#!">Handy <strong>Manong</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Blog</a></li>
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
                    <div class="input-group" style="max-width:500px;margin:auto;">
                        <input class="form-control" type="text" placeholder="Search..." aria-label="Search..." aria-describedby="button-search" style="background-color:rgba(255,255,255,0.5);color:#fff;"/>
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
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
                            <h2 class="card-title">Create Task</h2>
                            <hr>
                            <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" />
                                <div id="emailHelp" class="form-text">
                                    Brief intro about the task. (eg Carpenter & Paintjob)
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Location</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="exampleInputPassword1" rows="4"></textarea>
                            </div>
                            <div class="row justify-content-center">
                                <div>Category</div>
                                <p id="emailHelp" class="form-text">
                                    Select category that applies.
                                </p>
                                <div>
                                    <ul class="ks-cboxtags" style="padding-top:0;">
                                        <li>
                                            <input type="checkbox" id="checkboxOne" value="Carpenter">
                                            <label for="checkboxOne">Carpenter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="checkboxTwo" value="Plumber">
                                            <label for="checkboxTwo">Plumber</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="checkboxThree" value="Painter">
                                            <label for="checkboxThree">Painter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="checkboxFour" value="Electrician">
                                            <label for="checkboxFour">Electrician</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="checkboxFive" value="Driver">
                                            <label for="checkboxFive">Driver</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="checkboxSix" value="Welder">
                                            <label for="checkboxSix">Welder</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="checkboxSeven" value="House Keeper">
                                            <label for="checkboxSeven">House Keeper</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="checkboxEight" value="Glass Worker">
                                            <label for="checkboxEight">Glass Worker</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="checkboxNine" value="Midwife">
                                            <label for="checkboxNine">Midwife</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
                        </form>
                        </div>
                    </div>

                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Find Task</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search..." aria-label="Search..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">Capenter</a></li>
                                        <li><a href="#!">Plumber</a></li>
                                        <li><a href="#!">Painter</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">Electrician</a></li>
                                        <li><a href="#!">Driver</a></li>
                                        <li><a href="#!">Welder</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">House Keeper</a></li>
                                        <li><a href="#!">Glass Worker</a></li>
                                        <li><a href="#!">Midwife</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-2 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        

    </body>
</html>