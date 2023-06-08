@extends('layouts.app')

@section('title', 'Nueva cerveceria')

@section('content')

<div class="d-flex justify-content-center">
    <div class="col-sm-6  ">
        <h1>Nueva cervecería</h1>

        <x-msgflash />

     
<form method="POST" action="{{ route ('breweries.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="name" name="name"  value="{{ old('name') }}" required />
      
      <div class="invalid-feedback">
        El nombre es obligatorio
      </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description" name="description"  required>{{ old ('description') }}</textarea>
      
          <div class="invalid-feedback">
            La descripción es obligatoria
          </div>
    </div>
    
    <div class="mb-3">
      <label for="place" class="form-label">Localidad</label>
      <input type="text" class="form-control" id="place" name="place"  value="{{ old ('place') }}" required />
      
      <div class="invalid-feedback">
        La localidad es obligatoria
      </div>
    </div>

    <div class="mb-3">
      <label for="longitude" class="form-label">Longitud</label>
      <input type="number" class="form-control" id="longitude" name="longitude"  step="0.001"  value="{{ old('longitude') }}" required />
      
      <div class="invalid-feedback">
        La longitud es obligatoria
      </div>
    </div>

    <div class="mb-3">
      <label for="latitude" class="form-label">Latitude</label>
      <input type="number" class="form-control" id="latitude" name="latitude" step="0.001" value="{{ old ('latitude') }}" required />
      
      <div class="invalid-feedback">
        La latitud es obligatoria
      </div>
    </div>
    <div class="mb-3 row">
      <label  class="form-label">Cervezas que sirve</label>
        @foreach ($beers as $beer)
        <div class="col-sm-6 form-check form-switch">
        
          <input class="form-check-input" type="checkbox" role="switch" id="beer_{{ $beer->id }}" value="{{ $beer->id }}" name="beers[]" >
          <label class="form-check-label" for="beer_{{ $beer->id }}">{{ $beer->brand }}</label>

        </div>
        @endforeach
    </div>
    <div class="mb-3">
      <label for="img" class="form-label">Imagen de portada</label>
      <input type="file" class="form-control" id="img" name="img" />
    </div>
    <div class="mb-3">
      <label for="images" class="form-label">Otras imágenes</label>
      <div class="d-flex row" id="contImages">
        <div class="d-flex">
        <input type="file" class="form-control" id="images_0" name="images[]" /> <a href="javascript:otraImg()" class="btn btn-success mx-2">+</a>
        </div>  
      </div>  
    </div>
    <button type="submit" class="btn btn-warning">Enviar</button>
  </form>
</div>
</div>
<script>

  function otraImg () {
    let contenedor = document.getElementById ('contImages');
    if (contenedor) {
      contenedor.insertAdjacentHTML ('beforeEnd', '<div class="d-flex"><input type="file" class="form-control" id="images_0" name="images[]" /> <a href="javascript:otraImg()" class="btn btn-success mx-2">+</a></div>');
    }   
    
  }
  // https://getbootstrap.com/docs/5.3/forms/validation/
  (function () {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  
  Array.from(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
       
      if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
      }
    
        form.classList.add('was-validated')
      }, false)
    })
  })()
  </script>
@endsection