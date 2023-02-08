@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h3>Lista degli Appartamenti</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Visibile</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->is_visible ? 'Sì' : 'No' }}</td>
                        <td class="d-flex">
                            <a class="btn btn-primary me-1" href="{{ route('admin.apartments.show', $apartment->slug) }}">
                                Visualizza
                            </a>
                            <form action="{{ route('admin.apartments.destroy', $apartment->slug) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <span>&cross;</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
