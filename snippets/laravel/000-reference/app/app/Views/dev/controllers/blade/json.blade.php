@extends('dev/layouts/empty')

@section('main')
    <script>
        var data = @json($data, JSON_PRETTY_PRINT);
    </script>
@endsection
