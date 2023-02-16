@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Appartamento</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Data</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $key => $message)
                            <tr>
                                <td>{{ $message->apartment_id }}</td>
                                <td>{{ $message->lead_first_name }}</td>
                                <td>{{ $message->lead_last_name }}</td>
                                <td>{{ $message->lead_email }}</td>
                                <td>{{ $message->created_at }}</td>
                                <td>
                                    <button id="view-btn-{{ $key }}" message-text="{{ $message->text }}"
                                        class="btn btn-primary">View
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($messages as $key => $message)
                    <div class="col-2">
                        <div id="text-{{ $key }}" class="d-none" id="preview-window"
                            style="padding: 1rem; background-color: aqua">
                            {{ $key }}{{ $message->text }}
                        </div>
                @endforeach
            </div>
        </div>

    </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/view-btn.js')
@endpush
