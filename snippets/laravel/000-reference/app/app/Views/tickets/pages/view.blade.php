@extends('tickets/layouts/layout')

@section('title', 'List')

@section('main')
    <form name="ticket" class="form1" method="POST" action="{{ $action }}">
        @csrf
        @method('POST')

        @if ($type == 'update')
            <input name="id" type="hidden" value="{{ $ticket->id }}">
        @endif

        @error('name', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <input name="name" placeholder="Name" type="text" class="@error('name', 'ticket') is-invalid @enderror" value="{{ $ticket->name }}">
        </div>

        @error('ticket_status_id', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <select name="ticket_status_id" placeholder="Name" type="text" class="@error('ticket_status_id', 'ticket') is-invalid @enderror" value="{{ $ticket->name }}">
                @foreach ($status as $option)
                    <option value="{{ $option->id }}" @if($type == 'update' && $option->id === $ticket->status->id) selected @endif>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>

        @error('description', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
            <div><textarea name="description" placeholder="Description" type="text" class="@error('description', 'ticket') is-invalid @enderror">{{ $ticket->description }}</textarea>
            </div>

        <input type="submit" value="Submit">
    </form>

    @if ($type == 'update')
        <a href="/tickets/ticket/delete/{{ $ticket->id }}">Delete ticket</a><br>
    @endif

    
@endsection
