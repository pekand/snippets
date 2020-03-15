@extends('dev/templates/template')

@section('body')

    <header>@yield('header')</header>
        
    @hasSection('navigation')
        <side>@yield('navigation')</side>
    @endif

    <main>
        @section('main')
            <h1>Main section</h1>
        @show {{-- show - define and yield --}} 
    </main>

    <footer">@yield('footer', View::make('dev/parts/footer'))</footer> {{-- second parameter is default template --}}
@endsection


