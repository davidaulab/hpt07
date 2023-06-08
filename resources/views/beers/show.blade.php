@extends('layouts.app')

@section('title', 'Detalle de cerveza')

@section('content')
<h1>Detalle de cerveza</h1>

<x-msgflash />

<div class="row d-flex justify-content-center">

   
           
    <x-card  name="{!! $beer->brand !!}" 
        description="{!! $beer->description !!}"   
        
        urlBack="{{ route ('beers.index') }}"
        urlEdit="{{ route ('beers.edit', $beer) }}"
        urlDelete="{{ route ('beers.destroy', $beer) }}"
       >
       @isset($beer->price)
       <x-slot:price>
       <table>
        <tr><td>Precio orientativo:</td><td class="text-end">
            <x-currency amount="{{ $beer->price }}" currency="EUR"></x-currency> 
    
            </td></tr>
    
        @foreach($exchanges as $key => $exchange)
            <tr><td class="text-end" colspan="2"><x-currency amount="{{ $exchange }}" currency="{{ $key }}" /></td></tr>
        @endforeach    
       </table>
        </x-slot:price>
       @endisset
       <x-slot:badges>
            @foreach ($beer->breweries as $brewery)
                @if (($brewery->id % 4) == 0)
                <a href="{{ route ('breweries.show', $brewery->id) }}"><span class="badge rounded-pill text-bg-primary">{{ $brewery->name }}</span></a>
                @elseif (($brewery->id % 4) == 1)    
                <a href="{{ route ('breweries.show', $brewery->id) }}"><span class="badge rounded-pill text-bg-success">{{ $brewery->name }}</span></a>
                @elseif (($brewery->id % 4) == 2)    
                <a href="{{ route ('breweries.show', $brewery->id) }}"><span class="badge rounded-pill text-bg-danger">{{ $brewery->name }}</span></a>
                @else   
                <a href="{{ route ('breweries.show', $brewery->id) }}"><span class="badge rounded-pill text-bg-warning">{{ $brewery->name }}</span></a>
                @endif    
            @endforeach
            
       </x-slot:badges>
       
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

        
  
    
</div>
@endsection