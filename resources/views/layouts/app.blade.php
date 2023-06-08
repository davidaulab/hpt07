<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <!-- link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" -->
    
    @vite(['resources/sass/app.scss', 'resources/css/app.css','resources/js/app.js'])
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>

    <!-- link href="{{ asset('css/app.css') }}" rel="stylesheet"-->
    @livewireStyles
</head>
<body>
   
    <div class="container">
        <!-- Content here -->
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset ('/img/logo.png') }}" alt="{{ env ('APP_NAME') }}" style="height: 3em;"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ route ('breweries') }}">Cervecerías</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route ('beers.index') }}">Cervezas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route ('contact.create') }}">Contacto</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route ('about') }}">Quienes somos</a>
              </li>
            </ul>
          </div>
          @if (Route::has('login'))
          <div>
            <ul class="navbar-nav">
              @if(Auth::check())
              <li class="nav-item">
                <a class="nav-link" href="javascript:document.getElementById('logout-form').submit();">
                    No soy {{ Auth::user()->name }}
                  </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                
            </li>
              @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Registro</a>
              </li>
              @endif
            </ul>
          </div>  
          @endif
          
        </div>
      </nav>
      <article >
        @yield('content')
      </article>
    <footer class="text-white py-2 fixed-bottom" style="height:100px">
        <div class="container bg-secondary " style="position:absolute; top:0px; bottom:0px; left:0px; right: 0px; margin:0px; max-width: 100%; opacity:0.7">
        
        </div>
        <div class="container" style="position:absolute; top:0px; bottom:0px; left:0px; right: 0px;">
          Pié de página 
          </div>
          
    </footer>
</div>

<!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script-->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>    
@livewireScripts
</body>
</html>