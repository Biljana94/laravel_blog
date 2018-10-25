<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 d-flex justify-content-end align-items-center">
            
            @if(auth()->check()) <!--proverava da li je korisnik ulogovan, ako jeste-->
                Hello, {{ auth()->user()->name }}. <!--napisi Hello user-->
                <a href="/logout">Logout</a> <!--i user moze da se izloguje-->
            @else
                <a href="/login">Login</a> <!--ako user nije ulogovan link ga vodi na log in-->
                <a class="btn btn-sm btn-outline-secondary" href="/register">Sign up</a>
            @endif
            </div>
    </div>
</header>
