<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #ffffff !important;">
    <div class="container-fluid">
        <img src="{{ asset('/logo/logo.JPG')}}"
        width="95"
        height="45"
        class="rounded-circle"
        alt="">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Accueil</a>
          </li>
        @if(Auth()->user())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart.index') }}">
                    <i style='font-size:18px' class='fas'>&#xf217;</i>
                    Panier
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Connexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Inscription</a>
            </li>
        @endif



        </ul>
      </div>
    </div>
  </nav>
