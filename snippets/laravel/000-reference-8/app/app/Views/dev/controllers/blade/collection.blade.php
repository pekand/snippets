@extends('dev/layouts/empty')

@section('main')
    <h1>Colection</h1>

    @each('dev/components/userView', $users, 'user') {{-- render collection, dont inherit variables from perent --}}

    @each('dev/components/userView', [], 'user', 'dev/components/userViewEmpty') {{-- render template for empty array --}}
@endsection


