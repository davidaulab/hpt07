
@for ($i = 0; $i < 5; $i++)

    @if ($valor >= (($step * $i) + ($step /2)))
        <img src="{{ asset('img/icono.png') }}" style="height: 1.5em" title="{{ $valor }}">
    @else
    
        <img src="{{ asset('img/icono.png') }}" style="height: 1.5em; opacity: 0.4;  filter: grayscale(100%);">
    
    @endif
@endfor