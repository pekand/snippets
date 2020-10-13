@extends('dev/layouts/empty')

@section('main')
    <h1>Include alert component to template</h1>
    
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
        Alert message 3
    @endalert
@endsection


