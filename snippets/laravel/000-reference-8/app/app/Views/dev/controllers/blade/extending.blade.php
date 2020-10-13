@extends('dev/layouts/empty')

@section('main')
    <h1>Extend empty template with main section</h1>
    
    @datetime($time) {{-- defined in BladeServiceProvider --}}

<br>

    {{-- 'if' defined in BladeServiceProvider --}}

    @env('local')
        Env - Local <br>
    @elseenv('testing')
        Env - Testing <br>
    @else
        Env - other <br>
    @endenv

    @unlessenv('production')
        Env - Not Production <br>
    @endenv
@endsection


