@extends('layouts.app')

@section('title', 'Contacta con nosotros')

@section('content')
<style> body { background-color: #30A060}</style>
<div class="d-flex justify-content-center">
    <div class="col-sm-6  ">
        <h1>Contacta con nosotros</h1>

        <x-msgflash />


        <div id="contenedor" style="position: relative">
            <div id="fondo" style="position:absolute; top:0px; left: 0px; right: 0px; bottom:0px; z-index: -1; opacity: 0.5; background-color: white"> </div>

           <div id="contenido" class="p-4">

        <form method="POST" action="{{ route ('contact.store') }}" class="needs-validation"
            novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required />

                <div class="invalid-feedback">
                    El nombre es obligatorio
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required />

                <div class="invalid-feedback">
                    El email es obligatorio
                </div>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Tu consulta o sugerencia</label>
                <textarea class="form-control" id="message" name="message" required></textarea>


                <div class="invalid-feedback">
                    La consulta es obligatoria
                </div>
            </div>


            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                <label class="form-check-label" for="privacy">Acepto la política de privacidad</label>

                <div class="invalid-feedback">
                    Debes aceptar la política de privacidad
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Enviar</button>
        </form>
    </div> <!-- contenido -->
</div> <!-- contenedor -->
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
