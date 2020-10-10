@extends('tickets/layouts/layout')

@section('title', 'List')

@section('main')
    <a href="/tickets">back</a><br>

    @if ($type == 'update')
        <a href="/tickets/ticket/delete/{{ $ticket->id }}">Delete ticket</a><br>
    @endif

    @if ($type == 'create')
        <h2>New ticket</h2>
    @endif

    @if ($type == 'update')
        <h2>Ticket - {{ $ticket->name }}</h2>
    @endif

    @if(Session::has('status'))
        {{ Session::get('status') }} </p>
    @endif

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
            Name: <input name="name" placeholder="Name" type="text" class="@error('name', 'ticket') is-invalid @enderror" value="{{ old('name', $ticket->name) }}">
        </div>

        @error('ticket_status_id', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            Status: <select name="ticket_status_id" type="text" class="@error('ticket_status_id', 'ticket') is-invalid @enderror" value="{{ $ticket->name }}">
                @foreach ($status as $option)
                    <option value="{{ $option->id }}" @if($option->id == old('ticket_status_id', $currentStatusId)) selected @endif>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>

        @error('assigned_id', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            Assigned: <select name="assigned_id" type="text" class="@error('assigned_id', 'ticket') is-invalid @enderror" value="{{ $ticket->name }}">
                <option>Select user assigned to ticket</option>
                @foreach ($users as $option)
                    <option value="{{ $option->id }}" @if($option->id == old('assigned_id',  $currentAssignedUserId)) selected @endif>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>

        @error('description', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
            Description:<br>
            <div><textarea name="description" placeholder="Description" type="text" class="@error('description', 'ticket') is-invalid @enderror">{{ old('description', $ticket->description) }}</textarea>
            </div>

        <h3>Watchers</h3>

        @error('ticket_watchers', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            @foreach ($users as $option)
                <input type="checkbox" name="ticket_watchers[]" value="{{ $option->id }}" @if(in_array($option->id, $watchers)) checked @endif>{{ $option->name }}<br>
            @endforeach
        </div>
        <br><br>
        <input type="submit" value="Submit">
    </form>
    
@endsection
