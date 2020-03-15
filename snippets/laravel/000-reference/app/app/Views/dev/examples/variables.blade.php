@extends('dev/layouts/empty')

@section('content')
    <h1>{{ $pageHeader }}</h1> {{-- use htmlspecialchars --}}  

    <h2>{{ now() }}</h2>

    @{{ name }} {{-- escape --}}  

    {{-- escape  block --}}  
    @verbatim 
        <div>
            {{ name }}.
        </div>
    @endverbatim
@endsection


