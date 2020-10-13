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

    {{-- component 'alert' is registred by BladeServiceProvider --}}
    <x-alert>
        Alert message 4
    </x-alert>

    <x-alert extraInfo="extraInfo" title='title'>
        Alert message 5
    </x-alert>

    <x-alert>
        <x-slot name="extraInfo">
            extraInfo
        </x-slot>
        <x-slot name="title">
            title
        </x-slot>
        Alert message 6
    </x-alert>

@endsection


