@extends('layouts.admin')

@section('content')
    <div class="container relative">
        <table class="table margin-200">
            <thead>
                <div class="row">

                    <div class="col-8">
                        <tr>
                            <th scope="col" class="d-none d-md-inline-block">Appartamento</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="d-none d-md-inline-block">Data</th>
                            <th scope="col">Azioni</th>
                        </tr>
            </thead>
            <tbody>
                @foreach ($messages as $key => $message)
                    <tr>
                        <td class="d-none d-md-inline-block">{{ $message->apartment_id }}</td>
                        <td>{{ $message->lead_first_name }}</td>
                        <td>{{ $message->lead_last_name }}</td>
                        <td>{{ $message->lead_email }}</td>
                        <td class="d-none d-md-inline-block">{{ $message->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.messages.show', $message->id) }}">
                                <button id="view-btn-{{ $key }}" message-text="{{ $message->text }}"
                                    class="btn btn-primary">View
                                </button>
                            </a>

                        </td>
                        <td>
                            <div>
                                <div id="text-{{ $key }}" class="d-none" id="preview-window">
                                    {{ $message->text }}</div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- </div> --}}

    </div>
    <div class="col-4">
        <!-- <div class="preview-mess">
                                        @foreach ($messages as $key => $message)
    <div id="text-{{ $key }}" class="d-none" id="preview-window">{{ $message->text }}</div>
    @endforeach
                                    </div> -->
    </div>
    </div>
    </div>

    </div>
    </div>
@endsection

@push('scripts')
    {{-- @vite('resources/js/view-btn.js') --}}
@endpush


<style lang="scss">
    .preview-mess {
        height: 200px;
        width: 100%;
        padding-bottom: 200px;
        position: absolute;
        z-index: 999;
        right: 0;
        border: 1px solid black;
    }

    /* .margin-200 {
        margin-top: 200px;
    } */

    .relative {
        position: relative;
    }

    .message {
        width: 220px;
    }
</style>
