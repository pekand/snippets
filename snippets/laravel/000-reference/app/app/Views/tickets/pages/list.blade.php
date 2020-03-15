@extends('tickets/layouts/layout')

@section('title', 'List')

@section('main')
    <a href="/tickets/ticket/create">Add</a><br>
    @foreach ($tickets as $ticket)
        <a href="/tickets/ticket/view/{{ $ticket->id }}">{{ $ticket->name }}</a><br>
    @endforeach
@endsection
