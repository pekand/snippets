@extends('dev/layouts/empty')

@section('content')

    @if (count($records) === 1)
        I have one record!<br>
    @elseif (count($records) > 1)
        I have multiple records!<br>
    @else
        I don't have any records!<br>
    @endif

<hr>

    @unless (count($records) > 0)  {{-- only else --}}
        I don't have any records!<br>
    @endunless

<hr>

    @isset($records)
        records is defined and is not null...<br>
    @endisset

<hr>

    @empty($records)
        rrecords is empty<br>
    @endempty

<hr>

    @auth
        The user is authenticated...<br>
    @endauth

<hr>

    @guest
        The user is not authenticated...<br>
    @endguest

<hr>

{{--
    @auth('admin')
        The user is authenticated...<br>
    @endauth

    @guest('admin')
        The user is not authenticated...<br>
    @endguest
--}}

<hr>

    @hasSection('navigation')
        Section is defined...<br>
    @endif

<hr>

    @switch($num)
        @case(1)
            First case...<br>
            @break

        @case(2)
            Second case...<br>
            @break

        @default
            Default case...<br>
    @endswitch

<hr>

    @for ($i = 0; $i < 10; $i++)
        @if ($i == 1)
            @continue
        @endif

        @continue($i === 2)

        The current value is {{ $i }}<br>

        @break($i === 3)

        @if ($i == 3)
            @break
        @endif
    @endfor

<hr>

    @foreach ($users as $key => $user)
        {{ $key }} This is user {{ $user->name }}
        {{ $loop->index }}   
        {{ $loop->iteration }}  {{-- index + 1 --}}
        {{ $loop->remaining }}  
        {{ $loop->count }}
        {{ $loop->first }}
        {{ $loop->last }}
        {{ $loop->even }}
        {{ $loop->odd }}
        {{ $loop->depth }}
        {{ $loop->parent }}<br>
    @endforeach

<hr>

    @foreach ($users as $user)
        User: {{ $user->name }}<br>
        @foreach ($user->tickets as $ticket)
            @if ($loop->parent->first)
                This is first iteration of the parent loop.<br>
            @endif

            Ticket: {{ $ticket->name }}<br>
        @endforeach
    @endforeach

<hr>

    @forelse ($records as $record)
        {{ $record }}<br>
    @empty
        No record<br>
    @endforelse

<hr>

    @php $counter = 5; @endphp
    @while ($counter)
        {{$counter}}<br>
        @php $counter--; @endphp
    @endwhile

@endsection


