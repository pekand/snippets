@extends('tickets/templates/template')

@section('body')

    <header>@yield('header', View::make('tickets/parts/header'))</header>

    <main>
        @section('main')
            <h1>Main section</h1>
        @show
    </main>

    <footer">@yield('footer', View::make('tickets/parts/footer'))</footer> {{-- second parameter is default template --}}
@endsection


