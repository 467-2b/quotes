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
            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
            }
            li {
                float: left;
                border-right: 1px solid #bbb;
                font-size:20px;
            }
            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }
            li a:hover {
                background-color: #111;
            }
            .active {
                background-color: #4CAF50;
            }
            li:last-child {
                border-right: none;
            }
            a.btn{
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 8px;
            }
            .carousel-caption h1 {
                font-size: 600%;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar-expand-md navbar-dark fixed-top bg-dark">
                <ul>
                    <li><a class="active" href="/">Welcome</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li><a href="/quotes">Quotes</a></li>
                            <li><a href="/orders">Orders</a></li>
                            <li><a href="/users">Users</a></li>
                            <li><a href="/customers">Customers</a></li>
                            <li style="float:right"><a href="{{ url('/home') }}">Home</a></li>
                        @else
                            <li style="float:right"><a href="{{ route('login') }}">Sign In</a></li>
                        @endauth
                    @endif
                </ul>
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
                        <img class="rounded-circle" src="https://cdn2.iconfinder.com/data/icons/computer-roundline/512/computer-512.png" alt="Generic placeholder image" width="140" height="140">
                        <h2>Create</h2>
                        <p>Create, edit, and finalize quotes for customers. Add line items and notes.</p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img class="rounded-circle" src="https://cdn2.iconfinder.com/data/icons/computer-roundline/512/computer-512.png" alt="Generic placeholder image" width="140" height="140">
                        <h2>Review</h2>
                        <p>Review, update, and sanction finalized quotes.</p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img class="rounded-circle" src="https://cdn2.iconfinder.com/data/icons/computer-roundline/512/computer-512.png" alt="Generic placeholder image" width="140" height="140">
                        <h2>Convert</h2>
                        <p>Convert quotes into purchase orders to be sent to an external processing system.</p>
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <!-- FOOTER -->
            <footer class="container">
                <p class="float-right"><a href="#">Back to top</a></p>
                <p>&copy; 2021 467 Group, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
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
