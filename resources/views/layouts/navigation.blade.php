<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Multivendor</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <ul class="navbar-nav">

            <li class="nav-item">
                <a href="{{ route('cart.index') }}" class="nav-link p-0 m-0">
                    <i class="fa fa-cart-arrow-down text-info fa-2x" aria-hidden="true">

                    </i>
                    @auth
                        <div class="badge badge-danger">
                            {{ \Cart::session(auth()->id())->getTotalQuantity() }}
                        </div>
                    @else
                        <div class="badge badge-danger">
                            0
                        </div>
                    @endauth

                </a>
            </li>
            @auth
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name ?? '' }}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">logout</a>
                        </form>
                        <div class=" dropdown-divider">
                        </div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link p-0 m-0 mr-2">
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link p-0 m-0 mr-5">
                        Register
                    </a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
