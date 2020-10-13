@extends('dev/layouts/empty')

@section('main')
    
    <h1>Json</h1>
    
    <div id="jsonblock"></div>

    <script>
        var data = @json($data, JSON_PRETTY_PRINT);
        document.getElementById("jsonblock").innerHTML =  JSON.stringify(data);
    </script>
@endsection
