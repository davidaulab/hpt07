@extends('layouts.app')

@section('title', 'Listado de cervezas')

@section('content')
<h1>Listado de cervezas</h1>

<x-msgflash />

<div class="row d-flex justify-content-between">
    <div class="d-flex justify-content-center my-4">
    @auth
    <a href="{{ route('beers.create') }}" class="btn btn-warning">Nueva cerveza</a>        
    @endauth    

    @guest
        Solamente los usuarios registrados pueden crear nuevas cervezas
    @endguest

    </div>
    <div id="infiniteScroll" class="row d-flex justify-content-between">
    @foreach ($beers as $beer)

    <x-card  name="{!! $beer->brand !!}" 
        description="{!! $beer->description !!}"   
       
        
       urlView="{{ route('beers.show', $beer) }}"
       claseCard="col-sm-4">
       <x-slot:place>
       
        <x-stars valor="{{ $beer->vol }}" step="2" />

       </x-slot:place> 
       <x-slot:urlImg>
          @if( isset($beer->img) && ($beer->img != ''))
          {{ $beer->img }}
          @else
          {{ asset('img/default.jpg') }}    
          @endif
      </x-slot:urlImg>
  </x-card>

        
    @endforeach
</div>
</div>
<div id="loading" class="text-center d-none" ><img src="{{ asset('img/loading.gif') }}"></div>
<!-- a href="javascript:window.loadData()">Infinite Scroll</a -->
<!-- div class="d-flex justify-content-center">{{ $beers->links () }}</div-->

<script>
window.page = 1;
window.contenedor = "infiniteScroll";
window.finScroll = false;
window.divLoading = 'loading';
window.loadData = ( () => {
        if (window.finScroll == false) {
            $('#' + window.divLoading).removeClass ('d-none');
            window.finScroll = true;
            window.page++;
            urlInfiniteScroll = '?page=' + window.page;
            $.ajax (
                {
                    url: urlInfiniteScroll,
                    type: 'get',
                }
            )
            .done (function (data) {
                
                if (data.beers == '') {
                    $('#' + window.contenedor).append ('<p class="text-warning">Has llegado al final del listado</p>');
                }
                else {
                    $('#' + window.contenedor).append (data.beers);
                    window.finScroll = false;
                
                }
                $('#' + window.divLoading).addClass ('d-none');
                
            }

            )
            .fail (function (jqXHR, ajaxOptions, thrownError) {
                $('#' + window.contenedor).append ('<p class="text-danger">Ha ocurrido un error</p>');
                $('#' + window.divLoading).addClass ('d-none');
            });
        }
        
    }

);

window.addEventListener ('scroll', function () {
    if ($(window).scrollTop + $(window).height >= $('#' + window.contenedor).scrollTop + $('#' + window.contenedor).height) {
            window.loadData ();
        }
});


</script>
@endsection