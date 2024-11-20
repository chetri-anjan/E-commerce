<header>
    <!-- Top bar with contact info -->
    <nav class="navbar">
        <div class="logo">
            <a href="#">Mountain Artisan Collective</a>
        </div>
        <div class="nav-left">
            <div class="menu-toggle">☰</div>
        </div>
        <div class="sub-nav">
            <ul class="nav-links">
                <li><a href="{{route('home')}}">Home</a></li>
                @auth
                @if(auth()->user()->role == 2)
                <li><a href="{{route('add_products')}}">Add Product</a></li>
                @endif
                <li>Gifts: {{ auth()->user()->points }}</li>
                @endauth
                <li><a href="{{route('products')}}">Products</a></li>
                <li><a href="{{route('contact')}}">Contact Us</a></li>
                <li><a href="{{route('about')}}">About Us</a></li>
                <!-- <li><a href="#">About Us</a></li> -->
                <li>My<a href="{{ route('cart.index') }}"> Cart</a></li>
                @auth
                @if(auth()->user()->role == 2)
                <li><a href="{{ url('/adminpanel') }}">Admin Profile</a></li>
                @else
                <li><a href="{{ url('/userpanel') }}">Profile</a></li>
                @endif
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <li><a href="{{ route('login') }}">Log in</a></li>
                @if (Route::has('register'))
                <li><a href="{{ route('register') }}">Register</a></li>
                @endif
                @endauth
            </ul>
        </div>
    </nav>
</header>

<script>
    document.querySelector('.menu-toggle').addEventListener('click', function() {
        document.querySelector('.sub-nav').classList.toggle('active');
    });
</script>
