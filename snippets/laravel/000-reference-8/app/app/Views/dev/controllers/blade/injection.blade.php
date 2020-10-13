@extends('dev/layouts/empty')

@section('main')

    @inject('ticketRepository', 'App\Lib\Repositories\TicketRepository')

    <h1>Inject dependency (get tickets)</h1>

    <div>
        {{ $ticketRepository->getTickets() }}
    </div>
@endsection


