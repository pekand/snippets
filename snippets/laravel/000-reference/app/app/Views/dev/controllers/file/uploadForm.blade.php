@extends('dev/layouts/empty')

@section('main')

    <h1>Upload file</h1>
    <form name="ticket" class="form1" method="POST" action="/dev/examples/file/upload" enctype="multipart/form-data">
        @csrf
        @method('POST')

        @error('file', 'ticket')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input name="file" type="file" class="@error('name', 'ticket') is-invalid @enderror"><br>

        <input type="submit" value="Submit">
    </form>
@endsection


