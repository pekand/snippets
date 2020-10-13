@extends('dev/layouts/empty')

@section('main')
    <h1>Aliasing</h1>

    @header(['customParam' => 'value']) {{-- 'header' alias is registred in BladeServiceProvider --}}
@endsection


