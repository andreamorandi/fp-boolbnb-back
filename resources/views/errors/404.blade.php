@extends('layouts.admin')

@section('content')
    <div class="container text-center mt-5">

        <body>
            <h1>404 - Not Found</h1>
            <p>La pagina che stai cercando non è stata trovata.</p>
        </body>
        <div>
            <a class="btn btn-primary" href="{{ route('admin.apartments.index') }}">Ritorna alla tua lista</a>
        </div>
    </div>
@endsection
