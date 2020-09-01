@extends('dev/layouts/empty')

@section('main')
    @component('dev/components/alert', ['extraInfo' => 'extra info'])
        @slot('title')
            info
        @endslot
       Alert message
    @endcomponent

    {{-- select first available template for component --}}
    @componentfirst(['alert', 'dev/components/alert'], ['extraInfo' => 'extra info']) 
        @slot('title')
            info
        @endslot
       Alert message 2
    @endcomponentfirst

    {{-- component registred by BladeServiceProvider --}}
    @alert(['extraInfo' => 'extra info'])
        @slot('title')
            info
        @endslot
        You are not allowed to access this resource!
    @endalert
@endsection


