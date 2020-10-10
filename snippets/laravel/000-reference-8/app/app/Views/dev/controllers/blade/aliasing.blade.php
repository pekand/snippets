@extends('dev/layouts/empty')

@section('main')
    @header(['customParam' => 'value']) {{-- 'header' registred in BladeServiceProvider --}}
@endsection


