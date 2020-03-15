@extends('dev/layouts/empty')

@section('content')
    <script>
        var data = @json($data, JSON_PRETTY_PRINT);
    </script>
@endsection
