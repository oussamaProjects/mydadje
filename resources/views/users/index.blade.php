@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-14 md:ml-64">
        <!-- Statistics Cards -->
        <div class="flex p-4 gap-4">

            <form action="/search" method="post" id="search-form" class="bg-white flex items-center w-full max-w-xl  4 p-2">
                {{ csrf_field() }}
                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="text" name="search" id="search" placeholder="Recherche ..."
                    class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
            </form>

            <button id="buttonmodal"
                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-auto">
                Ajouter un utilisateur
            </button>

            @can('upload')
            @endcan

        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-4 p-4 gap-4">
            <div class="col-span-3">
                <div class="flex flex-col text-center w-full mb-6">
                    <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-900">Tous les utilisateurs</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Utilisateurs
                    </p>
                </div>
                <div class="w-full">
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    Name
                                </th>
                                <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    Role
                                </th>
                                <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    Department
                                </th>
                                <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($users) > 0)
                                @foreach ($users as $user)
                                    @if (!$user->hasRole('Root'))
                                        <tr>
                                            <td class="px-4 py-3 text-sm">{{ $user->name }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $user->roles()->pluck('name')->implode(' ') }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $user->department['dptName'] }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <!-- DELETE using link -->
                                                {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'DELETE', 'id' => 'form-delete-users-' . $user->id, 'class' => 'flex']) !!}
                                                <a href="#" class="left">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="/users/{{ $user->id }}/edit" class="center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <a href="" class="right data-delete" data-form="users-{{ $user->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <h5 class="teal-text">No User has been added</h5>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="">

                <svg class="w-5/6 mx-auto" xmlns="http://www.w3.org/2000/svg" id="f080dbb7-9b2b-439b-a118-60b91c514f72"
                    data-name="Layer 1" viewBox="0 0 528.71721 699.76785">
                    <title>Connexion</title>
                    <rect y="17.06342" width="444" height="657" fill="#535461" />
                    <polygon points="323 691.063 0 674.063 0 17.063 323 0.063 323 691.063" fill="#7f9cf5" />
                    <circle cx="296" cy="377.06342" r="4" fill="#535461" />
                    <polygon
                        points="296 377.66 298.773 382.463 301.545 387.265 296 387.265 290.455 387.265 293.227 382.463 296 377.66"
                        fill="#535461" />
                    <polygon points="337 691.063 317.217 691 318 0.063 337 0.063 337 691.063" fill="#7f9cf5" />
                    <g opacity="0.1">
                        <polygon points="337.217 691 317.217 691 318.217 0 337.217 0 337.217 691" fill="#fff" />
                    </g>
                    <circle cx="296" cy="348.06342" r="13" opacity="0.1" />
                    <circle cx="296" cy="346.06342" r="13" fill="#535461" />
                    <line x1="52.81943" y1="16.10799" x2="52.81943" y2="677.15616" fill="none" stroke="#000"
                        stroke-miterlimit="10" stroke-width="2" opacity="0.1" />
                    <line x1="109.81943" y1="12.10799" x2="109.81943" y2="679.15616" fill="none" stroke="#000"
                        stroke-miterlimit="10" stroke-width="2" opacity="0.1" />
                    <line x1="166.81943" y1="9.10799" x2="166.81943" y2="683" fill="none" stroke="#000"
                        stroke-miterlimit="10" stroke-width="2" opacity="0.1" />
                    <line x1="223.81943" y1="6.10799" x2="223.81943" y2="687.15616" fill="none" stroke="#000"
                        stroke-miterlimit="10" stroke-width="2" opacity="0.1" />
                    <line x1="280.81943" y1="3.10799" x2="280.81943" y2="688" fill="none" stroke="#000"
                        stroke-miterlimit="10" stroke-width="2" opacity="0.1" />
                    <ellipse cx="463.21721" cy="95.32341" rx="39.5" ry="37" fill="#2f2e41" />
                    <path d="M683.8586,425.93948l-10,14s-48,10-30,25,44-14,44-14l14-18Z"
                        transform="translate(-335.6414 -100.11607)" fill="#ffb8b8" />
                    <path d="M735.8586,266.93948s-13,0-16,18-6,78-6,78-42,55-35,62,15,20,20,18,48-61,48-61Z"
                        transform="translate(-335.6414 -100.11607)" fill="#7f9cf5" />
                    <path d="M735.8586,266.93948s-13,0-16,18-6,78-6,78-42,55-35,62,15,20,20,18,48-61,48-61Z"
                        transform="translate(-335.6414 -100.11607)" opacity="0.1" />
                    <path d="M775.8586,215.93948s-1,39-13,41-8,15-8,15,39,23,65,0l5-12s-18-13-10-31Z"
                        transform="translate(-335.6414 -100.11607)" fill="#ffb8b8" />
                    <path
                        d="M708.8586,455.93948s-59,110-37,144,55,104,60,104,33-14,31-23-32-76-40-82-4-22-3-23,34-54,34-54-1,84,3,97-1,106,4,110,28,11,32,5,16-97,8-118l15-144Z"
                        transform="translate(-335.6414 -100.11607)" fill="#2f2e41" />
                    <path d="M762.8586,722.93948l-25,46s-36,26-11,30,40-6,40-6l22-16v-46Z"
                        transform="translate(-335.6414 -100.11607)" fill="#2f2e41" />
                    <path
                        d="M728.8586,696.93948l13,31s5,13,0,16-19,21-10,23a29.29979,29.29979,0,0,0,5.49538.5463,55.56592,55.56592,0,0,0,40.39768-16.43936l8.10694-8.10694s-27.77007-63.94827-27.385-63.47414S728.8586,696.93948,728.8586,696.93948Z"
                        transform="translate(-335.6414 -100.11607)" fill="#2f2e41" />
                    <circle cx="465.21721" cy="105.82341" r="34" fill="#ffb8b8" />
                    <path
                        d="M820.3586,253.43948l-10.5,10.5s-32,12-47,0c0,0,5.5-11.5,5.5-10.5s-43.5,7.5-47.5,25.5,3,49,3,49-28,132-17,135,114,28,113,9,8-97,8-97l35-67s-5-22-17-29S820.3586,253.43948,820.3586,253.43948Z"
                        transform="translate(-335.6414 -100.11607)" fill="#7f9cf5" />
                    <path d="M775.8586,448.93948l-13,8s-50,34-24,40,41-24,41-24l10-12Z"
                        transform="translate(-335.6414 -100.11607)" fill="#ffb8b8" />
                    <path
                        d="M849.8586,301.93948l9,9s6,84-6,101-67,63-70,60-22-18-18-20,57.18287-57.56942,57.18287-57.56942l-4.18287-77.43058Z"
                        transform="translate(-335.6414 -100.11607)" opacity="0.1" />
                    <path
                        d="M853.8586,298.93948l9,9s6,84-6,101-67,63-70,60-22-18-18-20,57.18287-57.56942,57.18287-57.56942l-4.18287-77.43058Z"
                        transform="translate(-335.6414 -100.11607)" fill="#7f9cf5" />
                    <path
                        d="M786.797,157.64461s-11.5575-4.20273-27.31774,4.72807l8.40546,2.10136s-12.60819,1.05068-14.18421,17.8616h5.77875s-3.67739,14.70955,0,18.91228l2.364-4.4654,6.82943,13.65887,1.576-6.82944,3.15205,1.05069,2.10137-11.03217s5.25341,7.88012,9.45614,8.40546V195.2065s11.5575,13.13352,15.23489,12.60818l-5.25341-7.35477,7.35477,1.576-3.152-5.25341,18.91228,5.25341-4.20273-5.25341,13.13352,4.20273,6.3041,2.6267s8.9308-20.4883-3.67739-34.67251S798.61712,151.60318,786.797,157.64461Z"
                        transform="translate(-335.6414 -100.11607)" fill="#2f2e41" />
                </svg>
            </div>
        </div>

    </div>

    <div id="modal"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <div class="bg-white w-1/2 p-4">
            <button id="closebutton" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <div>
                <h2 class="text-gray-900 text-xl mb-8 font-medium title-font">
                    Ajouter un utilisateur
                </h2>


                <div class="mb-4 relative">
                    <label for="name" class="text-xs opacity-75 scale-75">
                        Nom</label>
                    {{ Form::text('name', '', ['id' => 'name', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}

                </div>

                <div class="mb-4 relative">
                    <label for="email" class="text-xs opacity-75 scale-75">
                        Adresse e-mail</label>
                    {{ Form::email('email', '', ['id' => 'email', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}

                </div>

                <div class="mb-4 relative">
                    <label for="email" class="text-xs opacity-75 scale-75">Department</label>
                    <select name="department_id" id="department_id"
                        class="peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent">
                        <option value="" disabled selected>Choisissez le d??partement</option>
                        @if (count($depts) > 0)
                            @if (Auth::user()->hasRole('Root'))
                                @foreach ($depts as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->dptName }}</option>
                                @endforeach
                            @elseif(Auth::user()->hasRole('Admin'))
                                <option value="{{ Auth::user()->department_id }}">
                                    {{ Auth::user()->department['dptName'] }}</option>
                            @endif
                        @endif
                    </select>
                </div>

                <div class="mb-4 relative">
                    <label for="email" class="text-xs opacity-75 scale-75">Role</label>
                    <select name="role" id="role"
                        class="peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent">
                        <option value="" disabled selected>Attribuer un r??le</option>
                        @if (count($roles) > 0)
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>


                <div class="mb-4 relative">
                    <label for="password" class="text-xs opacity-75 scale-75">Password</label>
                    {{ Form::password('password', ['id' => 'password', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}
                </div>

                <div class="mb-4 relative">
                    <label for="password-confirm" class="text-xs opacity-75 scale-75">Confirm
                        Mot de passe
                    </label>
                    {{ Form::password('password_confirmation', ['id' => 'password-confirm', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}
                </div>

            </div>
        </div>
        <div class="flex">
            {{ Form::submit('Envoyer', ['class' => 'focus:outline-none py-2 px-4 bg-gray-900 text-white bg-opacity-75 ml-auto']) }}
        </div>
        {!! Form::close() !!}
    </div>



    <script>
        const button = document.getElementById('buttonmodal')
        const closebutton = document.getElementById('closebutton')
        const modal = document.getElementById('modal')

        button.addEventListener('click', () => modal.classList.add('scale-100'))
        closebutton.addEventListener('click', () => modal.classList.remove('scale-100'))
    </script>
@endsection
