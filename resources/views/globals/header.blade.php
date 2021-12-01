<header class="main-header bg-dark" id="mainHeader">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <a class="navbar-brand" href="#highlight">
                <img
                    src="https://via.placeholder.com/180x50?text=Logo"
                    class="d-block"
                    alt=""
                />
            </a>

            <button
                class="navbar-toggler collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">

                <div class="hamburger-toggle">
                    <div class="hamburger">
                        <span class="bar"></span>
                    </div>
                </div>
            </button>

            <div class="collapse navbar-collapse pt-3 pt-lg-0" id="mainNavbar">
                <ul class="navbar-nav">
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Home</a>
                    </li>
                    @else                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    
                    @endif
                    @endauth
                    @endif
                   
                    <!-- <li class="nav-item">
                        <a class="nav-link call-to-action" href="#contact">
                            <button class="btn">
                                Contato
                            </button>
                        </a>
                    </li> -->
                    
                </ul>
            </div>
        </div>
    </nav>
</header>