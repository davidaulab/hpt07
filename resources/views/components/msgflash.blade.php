        @if( (null !== ($msg = Session::get('message') )) &&
             (null !== ($code = Session::get('code') )))
            @if (Session::get('code') == 0) 
            <div class="bg-success text-white">
            @else
            <div class="bg-danger text-white">
            @endif 
            {{ $msg}}
        </div>
        @endif

     @if( isset($errors) && (count($errors) >0) )
        @foreach ($errors->all () as $error)
          <p class="text-danger">{{ $error }}</p>
        @endforeach
      @endif