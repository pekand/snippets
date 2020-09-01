@extends('dev/layouts/empty')

@section('main')

    @push('scripts')
        <script src="example1.js"></script>
    @endpush

    @push('scripts')
        <script src="example2.js"></script>
    @endpush

    @prepend('scripts')
        <script src="example3.js"></script>
    @endprepend

    @stack('scripts')

@endsection


