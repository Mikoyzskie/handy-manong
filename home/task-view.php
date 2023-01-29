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
    </head>
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
                            <h2 class="card-title">Task Title</h2>
                            <hr>
                            <h2 class="card-title h4 position-relative">Category</h2>
                            <p>by: Handy Manong</p>
                            Status: <p class="badge rounded-pill bg-warning text-dark">Pending</p>
                            <p>Date Posted: <span class="small text-muted">January 1, 2022</span></p>
                            Description:
                            <p class="card-text ps-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Neque consectetur vitae tempore pariatur facere eligendi sint. Repudiandae, placeat. Beatae, debitis, eveniet eligendi blanditiis accusamus natus provident quia aspernatur nesciunt tempora placeat veritatis. Id ipsam aliquid ratione reiciendis, accusantium harum sequi aspernatur blanditiis molestiae doloribus inventore libero optio illum fugit, perferendis, vero labore itaque tempora asperiores voluptas magni accusamus amet ducimus maiores. Magnam suscipit laborum itaque ratione sequi repudiandae impedit, minima culpa atque dolor esse perspiciatis soluta quod repellat amet architecto necessitatibus quasi. A officia laudantium ut alias minima rerum repudiandae non, quibusdam libero, nostrum expedita nobis omnis dolorum molestiae veritatis!</p>
                            <p>Location: Lorem ipsum dolor sit amet consectetur.</p>
                            <p>Assigned to: <a href="#">Myk Test</a></p>
                            <a class="btn btn-primary" href="#!">Update</a>
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
                        <div class="col">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <!-- <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a> -->
                                <div class="card-body">
                                    <div class="small text-muted">January 1, 2022</div>
                                    <h2 class="card-title h4">Post Title</h2>
                                    <span class="badge rounded-pill bg-danger">Failed</span>
                                    <p class="card-text related">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla aut perferendis culpa voluptas alias sapiente aliquid corporis est eos, inventore earum ea dolor consectetur facere autem laudantium tenetur quam debitis!</p>
                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <!-- <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a> -->
                                <div class="card-body">
                                    <div class="small text-muted">January 1, 2022</div>
                                    <h2 class="card-title h4">Post Title</h2>
                                    <span class="badge rounded-pill bg-danger">Failed</span>
                                    <p class="card-text related">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam sunt est nulla hic reprehenderit recusandae explicabo voluptatem mollitia, accusantium ipsum ut totam quae minus dolorum ex culpa aliquid molestiae dolor?</p>
                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Chatter</div>
                        <div class="card-body">
                            <p>From <a href="#">Mikoy</a>: Interested. Check my profile.</p>
                            <p>From <a href="#">Mikoy</a>: Interested. Check my profile.</p>
                            <p>From <a href="#">Mikoy</a>: Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, dicta.</p>
                            <a class="btn btn-secondary" href="#!">View All →</a>
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
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Can't Decide From Service Connection? &#128549</div>
                        <div class="card-body">Create your own job posting and let service providers bid for your project &#128077
                            <br><br>
                        
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
