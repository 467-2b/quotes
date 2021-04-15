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