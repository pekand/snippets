@extends('dev/layouts/empty')

@section('main')

    @inject('ticketRepository', 'App\Lib\Repositories\TicketRepository')

    <div>
        {{ $ticketRepository->getTickets() }}
    </div>

@endsection


