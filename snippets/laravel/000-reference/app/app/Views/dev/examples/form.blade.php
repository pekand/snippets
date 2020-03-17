@extends('dev/layouts/empty')

@section('main')

    <h1>Add ticket</h1>
    <form name="ticket" class="form1" method="POST" action="/dev/blade/form">
        @csrf
        @method('POST')  {{-- hidden element for PUT, PATCH, or DELETE --}}

        <input name="id" type="hidden" value="{{ $ticket->id }}">

        @error('name', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input name="name" type="text" class="@error('name', 'ticket') is-invalid @enderror" value="{{ $ticket->name }}">

        @error('description', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input name="description" type="text" class="@error('description', 'ticket') is-invalid @enderror" value="{{ $ticket->description }}">

        <input type="submit" value="Submit">
    </form>

    <h1>Add ticket comment</h1>
    <form name="ticket-comment" class="form2" method="POST" action="/dev/blade/form2">
        @csrf

        @error('message', 'ticket-comment')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input name="message" type="text" class="@error('message', 'ticket-comment') is-invalid @enderror" value="{{ $ticketComment->message }}">

        <input type="submit" value="Submit">
    </form>
@endsection
