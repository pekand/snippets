@extends('dev/layouts/empty')

@section('main')
    
    <h1>Include</h1>

    @include('dev/parts/header')

    @include('dev/parts/footer', ['extraVariable' => 'value']) {{-- variables are not required, include has access to all parent variables --}}

    @includeIf('dev/parts/footer', []) {{-- dont throw error if template not exist --}}

    @includeWhen(true, 'dev/parts/footer', []) {{-- include only if first parameter is true --}}

    @includeUnless(false, 'dev/parts/footer', []) {{-- include only if first parameter is false --}}

    @includeFirst(['dev/parts/header', 'dev/parts/footer'], []) {{-- include first available template from array --}}

@endsection


