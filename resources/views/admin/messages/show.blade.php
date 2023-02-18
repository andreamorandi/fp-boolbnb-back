@extends('layouts.admin')

@section('content')
    <a class="btn btn-success mt-2 mb-2" href="{{ route('admin.messages.index') }}">Indietro</a>
    <h2>
        Messaggio di {{ $message->lead_first_name }} {{ $message->lead_last_name }}
        @foreach ($apartments as $apartment)
            @if ($apartment->id === $message->apartment_id)
                <span>per {{ $apartment->title }}</span>
            @endif
        @endforeach
    </h2>
    <p>Inviato il {{ $message->created_at }}</p>
    <strong>
        <p class="mt-5">Da: {{ $message->lead_email }}</p>
    </strong>
    <div class="border-top border-bottom border-success border-3 w-50 p-3">
        <p class="fst-italic">{{ $message->text }}</p>
    </div>
@endsection
