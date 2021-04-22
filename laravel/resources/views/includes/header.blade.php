        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active"><a  class="nav-link active" href="/">Welcome</a></li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                                @can('edit user')
                                <li class="nav-item"><a class="nav-link" href="{{ route('users') }}">Users</a></li>
                                @endcan
                                <li class="nav-item"><a class="nav-link" href="{{ route('quotes.index') }}">Quotes</a></li>
                                @can('view processed order')
                                <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Orders</a></li>
                                @endcan
                                <li class="nav-item"><a class="nav-link" href="{{ route('customers') }}">Customers</a></li>
                            @endauth
                        @endif
                    </ul>
                    <ul class="navbar-nav ml-auto mt-2 mt-md-0" style="float:right">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Sign In</a></li>
                        @endauth
                    @endif
                    </ul>
                </div>
            </nav>
        </header>