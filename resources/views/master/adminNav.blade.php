<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #ffffff !important;">
    <div class="container-fluid">
                <img src="{{ asset('/logo/logo.JPG')}}"
                width="95"
                height="45"
                class="rounded-circle"
                alt="">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @if(Auth::guard('admin')->check())
            <li class="nav-item">
                <a class="nav-link" href="/admin">Tableau de bord</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.create')}}">Ajouter une catégorie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.create')}}">Ajouter un produit</a>
            <li class="nav-item">
            <li class="nav-item">
                <a class ="nav-link" href="{{ route('shop.register')}}"> Ajouter une  pharmacie</a>
            </li>
                <a class="nav-link" href="{{ route('admin.logout') }}">Déconnexion</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.login') }}">Connexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{url('/')}}">YAMID Shop <span class="sr-only">(current)</span></a>
              </li>
        @endif
        </ul>

    </div>
    </div>
</nav>
