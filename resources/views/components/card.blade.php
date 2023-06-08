@isset($claseCard)
<div class="{{ $claseCard }}">
@else
<div class="col-sm-6">
@endisset


    <div class="card w-100   mb-4" style="border-radius: 20px; padding: 10px; height: calc(100% - 1.5rem) !important">
       
        
        @isset($urlImg)
        
          @isset($urlImgs)

          @php
            $urls = explode (",", $urlImgs)
          @endphp
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

              <div class="carousel-item active">
                <img src="{{ $urlImg }}" class="d-block w-100" alt="{{ $name }}">
              </div>
              @foreach ($urls as $url)
              <div class="carousel-item">

                <img src="{{ $url }}" class="d-block w-100" alt="{{ $name }}">
              </div>     
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          @else 

        <img src="{{ $urlImg }}"  alt="{{ $name }}" class="shadow-lg bg-body-primary" style="border-radius: 10px"> 
          @endisset

        
        @else
          @isset($map)
          <div id="map" class="card-img-top" style="height: 250px"></div>
          @endisset
        @endisset
  
        <div class="card-body">
         <h5 class="card-title">{{ $name }}</h5>
         @isset($description)
         <p class="card-text">{{ $description }}</p>  
         @endisset
         
         @isset($badges)
         <p  class="card-text">{{ $badges }}</p>
         @endisset
         
         @isset($place)
         <p class="card-text">{!! $place !!}</p>  
         @endisset
         
         @isset($price)
         <p class="card-text text-success">{!! $price !!}</p>  
         @endisset

         @isset($autor)
         <p class="card-text text-primary">Cervecería creada por {{ $autor }}</p>  
         @endisset

         <div class="d-flex justify-content-around">
         @isset($urlView)
         <a href="{{ $urlView }}" class="btn btn-primary">Ver más</a>     
         @endisset   
         @isset($urlEdit)
         <a href="{{ $urlEdit }}" class="btn btn-secondary">Modificar</a>     
         @endisset   
         @isset($urlDelete)
         <form method="POST" action="{{ $urlDelete }}">
          @method('DELETE')
          @csrf
           <button type="submit" class="btn btn-danger">Borrar</button>     
         </form>
         @endisset 
        </div>
       </div>
       @if (isset($map) && isset($urlImg))
       <div id="map" class="card-img-top" style="height: 250px"></div>  
       @endif


     </div>
     @isset($urlBack)
     <div class="text-center">
        <a href="{{ $urlBack }}" class="btn btn-primary">Volver</a>
        </div>         
     @endisset
  
     @isset($map)
         <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
 integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
 crossorigin=""></script>

 <script>
    var map = L.map('map').setView([{{ $lat }},{{ $long }}], 14);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    L.marker([{{ $lat }}, {{ $long }}]).addTo(map);

    var circle = L.circle([{{ $lat }}, {{ $long }}], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 500
}).addTo(map);

    </script>
     @endisset
   </div>