@extends('layouts.app')

@section('title','Listado de cervecerías')

@section('content')
  

    <h1>Listado de cervecerias</h1>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
 integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
 crossorigin=""></script>

 
    <livewire:search />

  
  @endsection
      