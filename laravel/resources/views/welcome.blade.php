<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Quote System</title>

        <link rel="icon" href="https://image.flaticon.com/icons/png/512/2131/2131042.png">

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/carousel/">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

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
            div.row {
                column-count: 3;
            }
            div.gallery:hover {
                border: 1px solid #777;
            }
            div.gallery img {
                width: 100%;
                height: auto;
            }
            div.desc {
                padding: 15px;
                text-align: center;
            }
            a.btn{
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 8px;
            }
            div.col-lg-4 {
                text-align:center;

                display: block;
            }
            .top-left {
                position: absolute;
                top: 200px;
                font-size:300px;
                left: 100px;
                letter-spacing: 3px;
                text-shadow: 10px 10px purple;
            }
            .mySlides {
                display:none;
            }
            .responsive {
                width: 100%;
                max-width: 400px;
                height: auto;
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
            <div class="w3-content w3-section" style="max-width:2000px">
                <div class="top-left">Quote System</div>
                <img class="mySlides w3-animate-left" src="https://www.aggreko.com/-/media/aggreko/images/case-studies/2017-02-nuclear-power-plant-night.jpg?w=1500&hash=3DA63748CB025D8BB1E657F93FAD4527" class="responsive" style="width:100%">
                <img class="mySlides w3-animate-left" src="https://bramble-energy.com/wp-content/uploads/2018/06/nuclear_power_plant.jpg"    class="responsive" style="width:100%">
                <img class="mySlides w3-animate-left" src="https://upload.wikimedia.org/wikipedia/commons/2/29/Nuclear_power_plant_Isar_at_night.jpg"    class="responsive" style="width:100%">
            </div>
            <p></p>
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
                        <p><a class="btn" href="#" role="button">View details &raquo;</a></p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img class="rounded-circle" src="https://cdn2.iconfinder.com/data/icons/computer-roundline/512/computer-512.png" alt="Generic placeholder image" width="140" height="140">
                        <h2>Review</h2>
                        <p>Review, update, and sanction finalized quotes.</p>
                        <p><a class="btn" href="#" role="button">View details &raquo;</a></p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img class="rounded-circle" src="https://cdn2.iconfinder.com/data/icons/computer-roundline/512/computer-512.png" alt="Generic placeholder image" width="140" height="140">
                        <h2>Convert</h2>
                        <p>Convert quotes into purchase orders to be sent to an external processing system.</p>
                        <p><a class="btn" href="#" role="button">View details &raquo;</a></p>
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
        <script>
            var myIndex = 0;
            carousel();
            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";    
                }
                myIndex++;
                if (myIndex > x.length) {myIndex = 1}        
                x[myIndex-1].style.display = "block";    
                setTimeout(carousel, 2500);        
            }
        </script>
    </body>
</html>
