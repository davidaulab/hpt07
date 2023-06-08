@extends('layouts.app')


@section('title',  "Cervecería " . $brewery->name )


@section('content')
<h1>Detalle de cervecería</h1>

<div class="row d-flex justify-content-center">

<x-card  name="{!! $brewery->name!!}" 
         place="{!! $brewery->place !!}"   
         description="{!! $brewery->description !!}"

          
         urlBack="{{ route ('breweries') }}"
         map="S"
         lat="{{ $brewery->latitude }}"
         long="{{ $brewery->longitude }}">


         <x-slot:badges>

                @foreach ($brewery->beers as $beer)
                @if (($beer->id % 4) == 0 )    
                <a href="{{ route ('beers.show', $beer) }}"><span class="badge rounded-pill text-bg-primary"> {{ $beer->brand }}</span></a>
                @elseif (($beer->id % 4) == 1 )  
                <a href="{{ route ('beers.show', $beer) }}"><span class="badge rounded-pill text-bg-warning"> {{ $beer->brand }}</span></a>
                @elseif (($beer->id % 4) == 2 )  
                <a href="{{ route ('beers.show', $beer) }}"><span class="badge rounded-pill text-bg-danger"> {{ $beer->brand }}</span></a>
                @else
                <a href="{{ route ('beers.show', $beer) }}"><span class="badge rounded-pill text-bg-success"> {{ $beer->brand }}</span></a>
                @endif
                @endforeach
         </x-slot:badges>


         @isset ($brewery->user)             
         <x-slot:autor>
            {{ $brewery->user->name }}
         </x-slot:autor>       
         @endisset
      
        
         <x-slot:urlImg>
            @if(isset($brewery->img) && ($brewery->img != ''))
                {{ $brewery->img }}
            @else
                {{ asset('img/default.jpg') }} 
            @endif
         </x-slot:urlImg>
       
         @isset($brewery->images)
            @if (count($brewery->images) > 0)
         <x-slot:urlImgs>
            @php
                $imagenes = [];
                foreach ($brewery->images as $image) {
                    $imagenes[] = $image->img;
                }
     
            @endphp
          

            {{ implode (",", $imagenes) }}
         </x-slot:urlImgs> 
            @endif   
         @endisset
         


             @if ((!isset ($brewery->user) && (null !== Auth::user())) || 
             ((null !== Auth::user()) &&  isset ($brewery->user) && $brewery->user->id == Auth::user()->id))
                 
             <x-slot:urlEdit>{{ route('breweries.edit', $brewery->id) }}</x-slot:urlEdit>
             <x-slot:urlDelete>{{ route('breweries.delete', $brewery->id) }}</x-slot:urlDelete>           
                 
             @endif

           
       
      
</x-card>

</div>
       
@endsection

      