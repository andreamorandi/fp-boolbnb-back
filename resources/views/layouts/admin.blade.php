<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="icon" type="" href="{{ asset('BeBr-logo-scheda.svg') }}" />
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/maps/maps.css" />
    <link rel="stylesheet" type="text/css"
        href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css" />
    <!-- SCRIPT -->
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/maps/maps-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/services/services-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js">
    </script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js">
    </script>

</head>


@vite(['resources/js/app.js'])
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.2/axios.min.js"
    integrity="sha512-NCiXRSV460cHD9ClGDrTbTaw0muWUBf/zB/yLzJavRsPNUl9ODkUVmUHsZtKu17XknhsGlmyVoJxLg/ZQQEeGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-fixed">
        <div class="container-fluid">
            <img id="logo" src="{{ asset('images/bebr.png') }}" alt="">
            {{-- <a class="navbar-brand" href="#">BOOLBNB</a> --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link mx-3" aria-current="page"
                            href="{{ route('admin.apartments.index') }}">Appartamenti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.apartments.create') }}">Aggiungi un nuovo
                            appartamento</a>
                    </li>

                </ul>
            </div>
            <div>
                <div class="d-inline-block">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

        </div>
    </nav>

    <div class="container-fluid vh-100">
        <div class="row h-100">
            <nav id="sidebarMenu" class="col-1 col-md-3 col-lg-2 d-block bg-dark navbar-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link p-0 d-inline-block text-white {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-secondary' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> <span
                                    class="d-none d-md-inline-block">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link mt-3 mb-3 p-1 d-inline-block text-white {{ Route::currentRouteName() == 'admin.apartments.index' ? 'bg-secondary' : '' }}"
                                href="{{ route('admin.apartments.index') }}">
                                <i class="fa-solid fa-building"></i> <span
                                    class=" d-none d-md-inline-block">Appartamenti</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-1 d-inline-block text-white {{ Route::currentRouteName() == 'admin.messages.index' ? 'bg-secondary' : '' }}"
                                href="{{ route('admin.messages.index') }}">
                                <i class="fa-solid fa-message"></i> <span
                                    class="d-none d-md-inline-block">Messaggi</span>
                            </a>
                        </li>
                    </ul>


                </div>
            </nav>

            <main class="col-10 col-md-9 col-lg-10 ">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>

<style lang="scss"scoped>
    .nav-link,
    .fa-solid,
    span {
        color: #c9e265;
    }
</style>
