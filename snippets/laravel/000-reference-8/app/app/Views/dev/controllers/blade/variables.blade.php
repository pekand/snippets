@extends('dev/layouts/empty')

@section('main')
    <h1>{{ $pageHeader }}</h1> {{-- use htmlspecialchars --}}  

    <h2>{!! $pageHeader2 !!}</h2> {{-- raw string --}} 

    <h2>{{ now() }}</h2>

    @{{ text with brackets }} {{-- escape brackets--}}  

    {{-- escape brackets in block --}}  
    @verbatim 
        <div>
            {{ text with brackets }}.
        </div>
    @endverbatim
@endsection


