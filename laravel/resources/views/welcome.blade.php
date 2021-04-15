<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Quote System</title>

        <link rel="icon" href="https://image.flaticon.com/icons/png/512/2131/2131042.png">

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/carousel/">

        <link rel="stylesheet" href="/css/app.css">

        <!-- Custom styles for this template -->
        <link href="css/carousel.css" rel="stylesheet">
        <style>

            .carousel-caption h1 {
                font-size: 600%;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active"><a  class="nav-link active" href="/">Welcome</a></li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item"><a class="nav-link" href="/quotes">Quotes</a></li>
                                <li class="nav-item"><a class="nav-link" href="/orders">Orders</a></li>
                                <li class="nav-item"><a class="nav-link" href="/users">Users</a></li>
                                <li class="nav-item"><a class="nav-link" href="/customers">Customers</a></li>
                            @endauth
                        @endif
                    </ul>
                    <ul class="navbar-nav ml-auto class="mt-2 mt-md-0" style="float:right">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Sign In</a></li>
                        @endauth
                    @endif
                    </ul>
                </div>
            </nav>
        </header>
        <main role="main">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/img/cover-dark.jpg" width="100%" height="100%" />

                        <div class="container">
                            <div class="carousel-caption">
                                <h1>Quotes System</h1>
                                <p>Some representative placeholder content for the first slide of the carousel.</p>
                                <p><br/></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                    <img src="/img/cover-light.jpg" width="100%" height="100%" />

                        <div class="container">
                            <div class="carousel-caption" style="color:black;">
                                <h1>Quotes System</h1>
                                <p>Some representative placeholder content for the second slide of the carousel.</p>
                                <p><br/></p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Marketing messaging and featurettes
            ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->
            <div class="container marketing">
                <!-- Three columns of text below the carousel -->
                <div class="row">
                    <div class="col-lg-4">
                        <img class="rounded-circle" src="/img/writing.jpg" alt="Create" width="140" height="140">
                        <h2>Create</h2>
                        <p>Create, edit, and finalize quotes for customers. Add line items and notes.</p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img class="rounded-circle" src="/img/welding.jpg" alt="Review" width="140" height="140">
                        <h2>Review</h2>
                        <p>Review, update, and sanction finalized quotes.</p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img class="rounded-circle" src="/img/cash-register.jpg" alt="Convert" width="140" height="140">
                        <h2>Convert</h2>
                        <p>Convert quotes into purchase orders to be sent to an external processing system.</p>
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <!-- FOOTER -->
            <footer class="container">
                <p class="float-right"><a href="#">Back to top</a></p>
                <p>&copy; 2021 467 Group 2B, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </footer>
        </main>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-3.5.1.slim.min.js"><\/script>')</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>
