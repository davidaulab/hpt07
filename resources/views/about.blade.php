@extends('layouts.app')

@section('title', 'Quienes somos')

@section('content')
 
<h1>Quienes somos</h1>

<div class="d-flex justify-content-center">

  <x-card  name="Cervelab" 
  map="S"
  lat="39.4688349"
  long="-0.3782953" >

 <x-slot:description>
  Somos un agregador de las mejores cervecerías de España y parte del extranjero
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a href="tel:34666777888" target="_system" class="contacto">Teléfono +34 666 777 888</a></li>
    <li class="list-group-item"><a href="mailto:david.martinez@aulab.es" target="_system"  class="contacto">Email: david.martinez@aulab.es</a></li>
    <li class="list-group-item"><div id="whatsapp" aria-describedby="tooltip"><a href="https://wa.me?34666777888" target="_system"  class="contacto">Whatsapp  +34 666 777 888</a></div></li>
  </ul>
</x-slot:description> 
</x-card>
<div id="tooltip" role="tooltip">
  Envíame un Whatsapp mejor...
  <div id="arrow" data-popper-arrow></div>
</div>


<script>

  </script>

</div>
@endsection