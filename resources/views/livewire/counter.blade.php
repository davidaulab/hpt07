<div class="bg-primary text-white">
    {{-- Be like water. --}}
    Este es el contador 
    
        @csrf
        
        @isset($counter)
        <h1>{{ $counter }}</h1>  
        <h2> <x-stars valor="{{ $counter }}" step="1"></x-stars> </h2>   
        @endisset
        <button wire:click="counter" >Sumar 1</button>
     
</div>
