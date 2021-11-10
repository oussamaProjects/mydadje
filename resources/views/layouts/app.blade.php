<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EDMS') }}</title>

    {{-- <link rel="stylesheet" href="{{ asset('iconfont/material-icons.css') }}"> --}}
    <!-- Materialize css -->
    {{-- <link rel="stylesheet" href="{{ asset('materialize-css/css/materialize.min.css') }}"> --}}
    <!-- datatables -->
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <!-- app css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/storage/images/favicon.ico">

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
</head>

<body class="my-auto w-full" style="height: min-content;">


    @include('inc.notifications')

    <div>
        <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white text-black ">

            @include('inc.spinner')

            @include('inc.navbar')

            @yield('content')

            <!-- Floating Button -->
            @if (Auth::guest())
            @else
                {{-- <div class="fixed-action-btn">
                    <a href="#" class="btn btn-floating btn-large tooltipped" data-position="left" data-delay="50"
                        data-tooltip="Quick Access">
                        <i class="large material-icons">explore</i>
                    </a>
                    <ul>
                        <li>
                            <a href="/documents/create" class="btn-floating btn-large tooltipped" data-position="left"
                                data-delay="50" data-tooltip="File Upload">
                                <i class="large material-icons">file_upload</i>
                            </a>
                        </li>
                        <li class="hide-on-med-and-down">
                            <a href="" class="btn-floating btn-large button-collapse tooltipped"
                                data-activates="slide-out" data-position="left" data-delay="50" data-tooltip="Menu"><i
                                    class="large material-icons">menu</i>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            @endif


            @include('inc.footer')

            <!-- Scripts -->
            @include('inc.scripts')
            <!-- Right click context-menu -->
            {{-- <script src="{{ asset('js/context-menu.js') }}"></script> --}}
            <!-- MESSAGES -->
            @include('inc.messages')

        </div>
    </div>
</body>

</html>
