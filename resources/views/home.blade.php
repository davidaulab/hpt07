@extends('layouts.app')

@section('title', 'Bienvenido al portal de cervecerías')

@section('content')
  
<h1>Bienvenido al portal de cervecerías</h1>

@isset($joke)
<h2>Chuck Norris diría:</h2>
<p class="text-primary">{{ $joke }}</p>  
@endisset


<form method="post">
  @csrf

  @isset($counter)
  <h1>{{ $counter }}</h1>  
  @endisset
  
  <button type="submit">Sumar 1</button>
</form>


<livewire:counter />

<form>
  <input type="text">
  <textarea></textarea>
</form>
<br>
Hola  
@isset($nombre)  
{{ $nombre  }}  
@endisset


<br>
Me han dicho que estás en el curso 
@isset($curso)
{{ $curso }}
@endisset 
<br>

Estas son nuestras cervecerías favoritas:<br>
<ul>
  @isset($breweries)
      @foreach ($breweries as $brewery)

      <li>{{ $brewery["nombre"] }} ({{ $brewery["poblacion"] }})</li>
        
    @endforeach    
  @endisset

 </ul>

    <br>&nbsp;<br>    
<img src="{{ asset ('/img/vasos.jpg') }}" width="50%"><br>

@endsection