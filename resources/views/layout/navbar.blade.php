<nav class="navbar sticky-top navbar-expand-lg" style="background-color: seagreen">
    <div class="container">
        <a class="navbar-brand" href="/">My Cart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @hasrole('admin')
                <li class="nav-item">
                    <a class="nav-link" href="/product"><span class="{{$title == 'product' ? 'text-warning' : ''}}">Produk</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/discount"><span class="{{$title == 'discount' ? 'text-warning' : ''}}">Diskon</span></a>
                </li>
                @endhasrole

                @hasrole('customer')
                <li class="nav-item">
                    <a class="nav-link" href="/cart"><span class="{{$title == 'cart' ? 'text-warning' : ''}}">Keranjang</span></a>
                </li>
                @endhasrole

                @hasanyrole('admin|customer')
                <div class="nav-item">
                    <a href="/order" class="nav-link"><span class="{{$title == 'order' ? 'text-warning' : ''}}">Order</span></a>
                </div>
                @endhasanyrole
            </ul>
            @hasanyrole('admin|customer')
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form action="/auth/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                    </form>
                </li>
            </ul>
            @else
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <button class="btn btn-sm btn-outline-light" type="button">
                        <a href="/auth/login" class="nav-link">Login</a>
                    </button>
                </li>
            </ul>
            @endhasanyrole
        </div>
    </div>
</nav>
<style>
    .navbar a{
        color: white;
    }

    .navbar a:hover{
        color: gold;
    }
    
</style>