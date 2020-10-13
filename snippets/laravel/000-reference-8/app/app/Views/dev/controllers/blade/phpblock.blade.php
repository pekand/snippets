@extends('dev/layouts/empty')

@section('main')

    <h1>PHP block</h1>

    @php
        for($i=0;$i<10; $i++){
            echo "executed php ({$i}) ";
        }
    @endphp
@endsection


