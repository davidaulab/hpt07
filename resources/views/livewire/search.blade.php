<div>
<div id="map" class="mb-4" style="height: 400px" wire:ignore></div> 
 <script>
     var map = L.map('map').setView([40.4073813,-3.6993874], 6);
     L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
     maxZoom: 19,
         attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
     }).addTo(map);
     var markers = [];
     </script> 

    <x-msgflash />

    <div class="row d-flex justify-content-between">
        <div class="d-flex justify-content-around my-4">
        @auth
        <a href="{{ route('breweries.create') }}" class="btn btn-warning">Nueva cervecería</a>   
        <a href="{{ route ('breweries.proposals') }}" class="btn btn-success">Ver mis propuestas</a>     
        @endauth    
    
        @guest
            Solamente los usuarios registrados pueden crear nuevas cervecerías
        @endguest

        </div>

        
   
    </div>

<div class="row d-flex justify-content-between">
    <div><input type="text" placeholder="Busca aquí tu cervecería..." class="form-control mb-4" wire:model="searchText"></div>
    @foreach ($breweries as $brewery)

    <x-card  name="{!! $brewery->name !!}" 
          description="{!! $brewery->description !!}"   
          place="{!! $brewery->place !!}"   
          
         urlView="{{ route('breweries.show', $brewery) }}"
         claseCard="col-sm-4">

         @isset ($brewery->user)             
         <x-slot:autor>
            {{ $brewery->user->name }}
         </x-slot:autor>       
         @endisset

         <x-slot:urlImg>
            @if( isset($brewery->img) && ($brewery->img != ''))
            {{ $brewery->img }}
            @else
            {{ asset('img/default.jpg') }}    
            @endif
        </x-slot:urlImg>
    </x-card>

          
          <input type="hidden" name="lat" value="{{ $brewery->latitude }}">
          <input type="hidden" name="long" value="{{ $brewery->longitude }}">
          
    @endforeach
<script>

    document.addEventListener ("DOMContentLoaded", () => {
        
        Livewire.hook ('element.updated', (el, component) => {
            map.eachLayer(function (layer) {
                if (layer && (typeof layer === 'object') && (layer instanceof L.Marker) &&  
                    (map.getBounds ().contains (layer.getLatLng()))) {
                        console.log ('Pasa por borrado');
                           layer.remove (); 
                    }     
            }); 
            setTimeout(() => {
                loadMarkers();      
            }, 100);
          
        } );
        loadMarkers (); 
    });

    function loadMarkers () {
        //alert('load Markers');
        let lat = document.getElementsByName ("lat");
        let long = document.getElementsByName ("long");
       

        let i = 0;
        while ((i < lat.length) && (i < long.length)) {
            var marker = L.marker([lat[i].value, long[i].value]).addTo(map);
            i++;
        }
        
          
    }
</script>    
</div>
</div>