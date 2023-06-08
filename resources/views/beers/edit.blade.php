@extends('layouts.app')

@section('title', 'Modificar cerveza')

@section('content')

<div class="d-flex justify-content-center">
    <div class="col-sm-6  ">
        <h1>Modificar cerveza</h1>

        <x-msgflash />


<form method="POST" action="{{ route ('beers.update', $beer) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
    @method('PUT')
    @csrf
    <div class="mb-3">
      <label for="brand" class="form-label">Marca</label>
      <input type="text" class="form-control" id="brand" name="brand"  value="{{ $beer->brand }}" required />
      
      <div class="invalid-feedback">
        La marca es obligatoria
      </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description" name="description"  required>{{ $beer->description }}</textarea>
          <div class="invalid-feedback">
            La descripción es obligatoria
          </div>
    </div>
    
    <div class="mb-3">
      <label for="price" class="form-label">Precio orientativo</label>
      <input type="number" class="form-control" id="price" name="price" step="0.01"   value="{{ $beer->price }}" required />
      
      <div class="invalid-feedback">
        El precio orientativo es obligatorio
      </div>
    </div>    



    <div class="mb-3">
      <label for="vol" class="form-label">Graduación alcohólica</label>
      <input type="number" class="form-control" id="vol" name="vol" step="0.01"   value="{{ $beer->vol }}" required />
      
      <div class="invalid-feedback">
        La graduación es obligatoria
      </div>
    </div>

    <div class="mb-3 row">
      <label class="form-label">Cervecerías que la sirven</label>
      @foreach ($breweries as $brewery)

      <div class="form-check form-switch col-sm-6">
        <input class="form-check-input" type="checkbox" role="switch" id="brewery_{{ $brewery->id }}" name="breweries[]" value="{{ $brewery->id }}"
        @if ($beer->breweries->find ($brewery->id))
          checked  
        @endif
        >
        <label class="form-check-label" for="brewery_{{ $brewery->id }}">{{ $brewery->name }}</label>
      </div>
        
      @endforeach
    </div>

    <div class="mb-3">
        <label for="img" class="form-label">Imagen de la cerveza</label>
        <input type="file" class="form-control" id="img" name="img" />
      </div>
    <button type="submit" class="btn btn-warning">Enviar</button>
  </form>
</div>
</div>
<script>
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